<?php
require_once ("../Autoloader.php");
Autoloader::getInstance();

use Core\Database\BaseMysql;
use Millennium\Exception\QueryGetUserIdException;
use Millennium\JsonConverter;
use Millennium\ProductFactory;
use Millennium\User;
use Millennium\UserRepository;

$userRepository = new UserRepository();
$productFactory = new ProductFactory();

// функция - анализатор данных из БД... нам эти данные нужно структурировать.
$dataAnalizer = function (array $data) use ($userRepository, $productFactory){
    // сначала проверяем, есть ли пользователь в репозитории.
    $user = $userRepository->foundUser($data['id']);
    if (!$user) { // если пользователя нет - создадим его и добавим в репозиторий
        $user = new User($data['id'], $data['user_name']);
        $userRepository->addUser($user);
    }
    // Добавляем товар к заказу пользователя
    if ($data['title'] && $data['price']) {
        $product = $productFactory->makeProduct($data['title'], floatval($data['price']));
        $user->addProductInOrder($product);
    }
};

if ($_GET['user_id']) {
    // идентификатор пользователя - всегда, целое число
    $userId = intval($_GET['user_id']);
    // Лишняя проверка? =\
    if (!is_integer($userId)) {
        new QueryGetUserIdException($_GET['user_id']);
    }

    $query = "
        SELECT
            u.id,
            CONCAT(u.second_name, ' ', u.first_name) AS user_name,
            p.title,
            p.price
        FROM
            user u INNER JOIN
            user_order uo ON uo.user_id = u.id LEFT JOIN
            products p ON uo.product_id = p.id 
        WHERE 
            u.id = {$userId}
        ORDER BY 
            p.title ASC, 
            p.price DESC
    ";

    $userData = BaseMysql::freeQueryDataback($query);

    if ($userData) {
        foreach ($userData as $data) {
            $dataAnalizer($data);
        }

        //$userOrder = json_decode(JsonConverter::userToJson($userRepository->getUser($_GET['user_id'])));
        echo JsonConverter::userToJson($userRepository->getUser($_GET['user_id']));
    } else {
        echo json_encode([
            'success' => false,
            'data' => ["error" => "В базе нет информации по запрашиваемому пользователю"],
            'message' => "В GET-параметре user_id передан идентификатор, по которому не возможно найти пользователя в БД"
        ]);
    }
}
?>
