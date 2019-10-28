<?php include "./data/database.php" ?>
<?php
class CategoryB
{
    public function GetAllCategories()
    {
        $sql = "SELECT * FROM Category";
        $db = new Database();
        $result = $db->select($sql);

        return $result;
    }
}
?>