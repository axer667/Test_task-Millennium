<?php

use Core\Database\BaseMysql;
use Millennium\Exception\InputException;

require_once ("../Autoloader.php");
Autoloader::getInstance();

if ($_POST) {
    $data = json_decode($_POST['data'], true);

    $values = "";
    foreach ($data AS $key => $product) {
        if (!isset($product['title']) || !isset($product['price'])){
            new InputException([$product['title'], $product['price']]);
        }
        $title = trim($product['title']);
        $price = floatval(trim($product['price']));

        if (!$title || !$price) {
            new InputException([$title, $price]);
        }

        $values .= "('{$title}', {$price})";
        if ($key+1 !== count($data)) {
            $values .= ',';
        }
    }

    $query = "
        INSERT INTO products 
            (title, price)
        VALUES 
            {$values}
    ";

    if (BaseMysql::freeQueryFeed($query)) {
        echo json_encode(['success' => 'true']);
    } else {
        echo json_encode(['success' => 'false']);
    }
}