<?php include "./business/categoryB.php" ?>
<?php

class CategoryP
{
    public function ShowAllCategories()
    {
        $cb = new CategoryB();
        $result = $cb->GetAllCategories();

        $count = 1;

        while ($row = mysqli_fetch_array($result)) {
            $style = $this->SetStyleForCurrentCategory($count);
            $category = <<<DELIMITER
                <a href="index.php?category={$count}" class="list-group-item list-group-item-action {$style}" >{$row['cat_name']}</a>
                DELIMITER;
            echo $category;
            $count++;
        }
    }
    public function ShowPages()
    {
        $cat_id = $this->GetCategory();
        $page_num = $this->GetPage();
        $cb = new CategoryB();
        $page_count = $cb->CalculatNumberOfLinks($cat_id);
        if ($page_count > 1) {
            for ($i = 1; $i <= $page_count; $i++) {
                if ($i != $page_num) {
                    $page_link = <<< DELIMITER
                    <li class="page-item "><a class="page-link" href="index.php?category={$cat_id}&page={$i}">{$i}</a></li>
                    DELIMITER;
                    echo $page_link;
                } else {
                    $page_link = <<< DELIMITER
                    <li class="page-item active"><a class="page-link" href="index.php?category={$cat_id}&page={$i}">{$i}</a></li>
                    DELIMITER;
                    echo $page_link;
                }
            }
        }
    }
    public function SetStyleForCurrentCategory($count)
    {
        $cat_id = $this->GetCategory();
        $style = "";
        if ($count == $cat_id) {
            $style = "active";
        }
        return $style;
    }
    public function GetCategory()
    {
        $cat_id = 1;
        if (!isset($_GET['category']))
            $cat_id = 0;
        else
            $cat_id = $_GET['category'];
        return $cat_id;
    }
    public function GetPage()
    {
        $page_num = 1;
        if (!isset($_GET['page']))
            $page_num = 1;
        else
            $page_num = $_GET['page'];
        return $page_num;
    }
}
?>