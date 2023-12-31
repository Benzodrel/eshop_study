<?php
session_start();
require_once 'repositories/database_repository.php';
require_once 'repositories/config.php';
require_once 'classes/Product.php';
require_once 'classes/CartOperations.php';
require_once 'classes/ProductCollection.php';
require_once 'classes/Presenter.php';
require_once 'classes/Controller.php';


$connect = new MysqlRepository(HOST, DATA_BASE_NAME, USERNAME, PASSWORD);
$present = new Presenter($connect->getProductAll());
$controller = new Controller($present);


if (isset($_POST['plus'])) {
     $controller->actionPlus();
}
if (isset($_POST['minus'])) {
     $controller->actionMinus();
}
if ( isset($_POST['clean'])) {
    $controller->actionClean();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class='container'>
    <div class='row'>
        <div class='col'>
            <h1>Товары</h1>
            <table class="table table-bordered table-dark table-hover">
                <?php

                foreach (($present->getListArray()) as $product) {

                    echo "<thead><tr>";
                    echo "<th scope='col'> Название товара: {$product->getName()}</th>";
                    echo "<th scope='col'>Описание: {$product->getDescription()}</th>";
                    echo "<th scope='col'>Цена: {$product->getPrice()}</th>";
//                    if (isset($product["color"])) {
//                        echo "<th scope='col'>цвет: {$product["name"]}</th>";
//                    }
//                    if (isset($product["material"])) {
//                        echo "<th scope='col'>материал: {$product["material"]}</th>";
//                    }
                    echo "<th scope='col'>
                    <form action = '' method = 'post'> <input type='submit' class='btn btn-danger' name ='plus' value = '{$product->getName()}' >В корзину</form>
                          </th>";


                }

                ?>
            </table>

        </div>
        <div class='col'>
            <h1>Корзина</h1>
            <table class="table table-bordered table-dark table-hover">
                <?php
                $totalSum = 0;
                if (!empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        echo "<thead><tr>";
                        echo "<th scope='col'> {$item['name']} </th>";
                        echo "<th scope='col'> {$item['price']} </th>";
                        echo "<th scope='col'> {$item['quantity']} </th>";
                        echo "<th scope='col'> {$item['sum']} </th>";
                        echo "<th scope='col'> <form action = '' method = 'post'><input type = 'submit' class = 'btn btn-danger' name ='minus' value ='{$item['name']}'></form></th>";
                        $totalSum += $item['sum'];

                    }
                } else {
                    echo "Пусто";
                }
                ?>
            </table>
            <?="<th scope='col'>Сумма заказа {$totalSum} </th>";?>
            </table>
            <form action='' method='post'><input type='submit' class='btn btn-danger' name='order' value='order'></form>
            <form action='' method='post'><input type='submit' class='btn btn-danger' name='clean'
                                                             value='clean'></form>
        </div>

    </div>
</div>
</body>

</html>