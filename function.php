<?php
session_start();

require_once 'repositories/database_repository.php';
require_once 'repositories/config.php';
require_once 'classes/product.php';
require_once 'classes/cartOperations.php';

$connect = new MysqlRepository(HOST, DATA_BASE_NAME, USERNAME, PASSWORD);
$objectArray = [];
foreach (($connect->getProductAll()) as $product) {
    $obj = new Product($product['id'], $product["name"], $product["description"], $product["price"]);
    $objectArray[$product["name"]] = $obj;
}
if (isset($_POST['plus']) || isset($_POST['minus'])) {
    if (array_key_exists($_POST['plus'], $objectArray)) {
        $add = new CartOperations($objectArray[$_POST['plus']]);
        $add->addToCart();
    }
    if (array_key_exists($_POST['minus'], $objectArray)) {
        $remove = new CartOperations($objectArray[$_POST['minus']]);
        $remove->removeFromCart();
    }
}
if (isset($_POST['clean'])){
    session_unset();
}
//    foreach ($objectArray as $item) {
//        if ($item->getName() === $_POST['plus']) {
//            $add = new CartOperations($item);
//            $add->addToCart();
//        }
//    }
//
//    foreach ($objectArray as $item) {
//        if ($item->getName() === $_POST['minus']) {
//            $remove = new CartOperations($item);
//            $remove->removeFromCart();
//        }
//}

header('Location: index.php');


