<?php
// $test =new ProductAnalysisB();
// $test->UpdateViewOfProduct(1);
class ProductAnalysisB
{
    private $highview = 2;

    public function GetView($product_id, $from, $to)
    {
        $TO = "'" . $to . "'";
        $FROM = "'" . $from . "'";
        $sql = "SELECT COUNT(*) as NUM FROM product_analysis WHERE product_id={$product_id} AND visited_date>{$FROM} AND visited_date<{$TO}";
        $db = new Database();
        $result = $db->select($sql);
        $row = mysqli_fetch_array($result);
        return $row['NUM'];
    }

    public function UpdateViewOfProduct($product_id)
    {
        $now = "'" . date("Y-m-d H:i:s") . "'";
        $sql = "INSERT INTO `product_analysis`(`product_id`, `visited_date`) VALUES ({$product_id},{$now})";
        $db = new Database();
        $db->insert($sql);
    }
}