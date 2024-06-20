<?php
namespace Millennium;

class JsonConverter {
    public static function userToJson(User $user)
    {
        $jsonUser = [
            'userName' => $user->getName(),
            'order' => []
        ];

        if (count($user->getOrder()) > 0) {
            foreach ($user->getOrder() AS $product) {
                $jsonUser['order'][] = [
                    'title' => $product->getTitle(),
                    'price' => $product->getPrice()
                ];
            }
        }

        $data = [
            'success' => true,
            'data' => $jsonUser,
            'message' => 'user data received'
        ];

        return json_encode($data);
    }
}