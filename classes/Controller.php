<?php


class Controller
{

    private $presenter;

    public function __construct(Presenter $presenter)
    {
        $this->presenter = $presenter;
    }

    public function actionPlus()
    {

        if (isset($_POST['plus'])) {
            if (array_key_exists($_POST['plus'], $this->presenter->getListArray())) {
                $add = new CartOperations($this->presenter->getListArray()[$_POST['plus']]);
                $add->addToCart();
            }
        }
    }

    public function actionMinus()
    {
        if (isset($_POST['minus'])) {
            if (array_key_exists($_POST['minus'], $this->presenter->getListArray())) {
                $remove = new CartOperations($this->presenter->getListArray()[$_POST['minus']]);
                $remove->removeFromCart();
            }
        }
    }

    public function actionClean()
    {
        if (isset($_POST['clean'])) {
            session_unset();
        }
    }
}