<?php include "./business/categoryB.php" ?>
<?php
class CategoryP
{
    public function ShowAllCategories()
    {
        $cb = new CategoryB();
        $result = $cb->GetAllCategories();

        while ($row = mysqli_fetch_array($result)) {
            $category = <<<DELIMITER
                <a href="#" class="list-group-item list-group-item-action">{$row['cat_name']}</a>
                DELIMITER;
            echo $category;
        }
    }
}
?>