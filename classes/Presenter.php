<?php


class Presenter
{
    private $list;
    public function __construct(ProductCollection $list)
    {
        $this->list = $list;
    }

    function getListArray() :array {
        return $this->list->getList();
    }

//    function getListJson()  {
//        return json_encode($this->list, JSON_FORCE_OBJECT);
//    }

}