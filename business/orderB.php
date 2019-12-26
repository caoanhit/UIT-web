<?php
class OrderB
{
    public function AddItem($product_id)
    {
        if (isset($_SESSION["order"])) {
            $items = $_SESSION["order"];
            if (array_key_exists($product_id, $items))
                $items[$product_id] = $items[$product_id] + 1;
            else
                $items[$product_id] = 1;
            $_SESSION["order"] = $items;
        } else {
            $items = array();
            $items[$product_id] = 1;
            $_SESSION["order"] = $items;
        }
    }

    public function GetSelectedItem()
    {
        if (isset($_GET['product_id']))
            return $_GET['product_id'];
    }

    public function CheckOut()
    {
        if (isset($_SESSION["order"])) {
            $saved = true;
            $result = $_SESSION["order"];
        }
    }

    public function ItemCount()
    {
        $result = array();
        if (isset($_SESSION["order"])) {
            $result = $_SESSION["order"];
        }
        $count = 0;
        foreach ($result as $product_id => $quantity) {
            $count += $quantity;
        }
        return $count;
    }
}