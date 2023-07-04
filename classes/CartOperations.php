<?php


class CartOperations
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        $name = $this->product->getName();
        $price = $this->product->getPrice();
        if (!isset($_SESSION['cart'][$name])) {
            $_SESSION['cart'][$name] = ['name' => $name, 'price' => $price, 'quantity' => 1];
        } else {
            $_SESSION['cart'][$name]['quantity'] += 1;
        }
        $_SESSION['cart'][$name]['sum'] = $_SESSION['cart'][$name]['quantity'] * $price;
    }

    public function removeFromCart()
    {
        $name = $this->product->getName();
        $price = $this->product->getPrice();
        if (isset($_SESSION['cart'][$name]) ) {
            $_SESSION['cart'][$name]['quantity'] --;
            $_SESSION['cart'][$name]['sum'] = $_SESSION['cart'][$name]['quantity'] * $price;
            if ($_SESSION['cart'][$name]['quantity'] === 0) {
                unset ($_SESSION['cart'][$name]);
            }
        }
    }


}