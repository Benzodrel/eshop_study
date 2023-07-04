<?php


class product
{
    public function __construct(private $id,
                                private $name,
//                                private $attributes,
                                private $description,
                                private $price,
                                )
    {
    }


    public
    function getId()
    {
        return $this->id;
    }

    public
    function getName()

    {
        return $this->name;
    }

//    public
//    function getAttributes()
//    {
//        return $this->attributes;
//    }


    public
    function getDescription()
    {
        return $this->description;
    }

    public
    function getPrice()
    {
        return $this->price;
    }

}