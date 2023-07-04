<?php

interface Repository
{
    public function getProductAll();

}

class MysqlRepository implements Repository
{
    private $db;

    public function __construct(private $host,
                                private $dbname,
                                private $login,
                                private $password)
    {
        $this->db = new mysqli($this->host, $this->login, $this->password, $this->dbname);

        if ($this->db->connect_errno) {
            throw new Exception('Failed to connect to db');
        }
    }

    public function getProductAll(): array
    {
        $array = [];
        $sql = "SELECT * FROM `product`";
        $resultProd = $this->db->query($sql);
        while ($row = $resultProd->fetch_assoc()) {
            $resultAttribute = $this->db->query("SELECT `attribute`, `value` FROM product_attribute WHERE `product_id` = {$row["id"]}");
            while ($rowInner = $resultAttribute->fetch_row()) {
                $rowAlter = array($rowInner[0] => $rowInner[1]);
                $row = array_merge($row, $rowAlter);
            }
            $resultImagePath = $this->db->query("SELECT `image_url` FROM product_image WHERE product_id = {$row["id"]}");
            $imagePath = $resultImagePath->fetch_row();
            if ($imagePath === null) {
                $row['path'] = 'default';
            } else {
                $row['path'] = $imagePath[0];
            }
            $array[] = $row;
        }
        return $array;
    }


}