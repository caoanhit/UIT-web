<?php include "./data/database.php" ?>
<?php
class CategoryB
{
    private $cat_list = null;
    private $MAX_PRODUCT = 3;
    public function GetAllCategories()
    {
        $sql = "SELECT * FROM Category";
        $db = new Database();
        $result = $db->select($sql);

        return $result;
    }
    public function GetAmountOfProductInCategory($cat_id)
    {
        $sql = "SELECT COUNT(*) AS NUM FROM product WHERE cat_id={$cat_id}";
        $db = new Database();
        $result = $db->select($sql);
        $row = mysqli_fetch_array($result);
        $num = $row['NUM'];
        return $num;
    }
    public function CalculatNumberOfLinks($cat_id)
    {
        $session_name = "numPages_" . $cat_id;
        if (isset($_SESSION["{$session_name}"])) {
            $result = $_SESSION["{$session_name}"];
            return $result;
        }
        $num = $this->GetAmountOfProductInCategory($cat_id);
        $max = $this->MAX_PRODUCT;
        $result = (float) $num / $max;
        $result = ceil($result);
        $_SESSION["{$session_name}"] = $result;
        return $result;
    }
    public function GetProductsInGroup($cat_id, $link_num)
    {
        $result = [];
        $saved = false;
        for ($i = 0; $i < $this->MAX_PRODUCT; $i++) {
            $session_name = "listProducts_" . $cat_id . "_" . $link_num . "_" . $i;
            if (isset($_SESSION["{$session_name}"])) {
                $saved = true;
                $result[] = $_SESSION["{$session_name}"];
            }
        }
        if ($saved) return $result;

        $offset = ($link_num - 1) * $this->MAX_PRODUCT;
        $sql = "SELECT *FROM `product` WHERE `cat_id`={$cat_id} LIMIT {$offset},{$this->MAX_PRODUCT}";
        $db = new Database();

        $data = $db->select($sql);
        for ($i = 0; $i < $this->MAX_PRODUCT; $i++) {
            $session_name = "listProducts_" . $cat_id . "_" . $link_num . "_" . $i;
            if ($row = mysqli_fetch_array($data)) {
                $result[$i] = $row;
                $_SESSION["{$session_name}"] = $row;
            }
        }
        return $result;
    }
}
?>