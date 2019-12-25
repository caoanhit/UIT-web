<?php include "./business/productB.php" ?>
<?php include "./business/inventoryB.php" ?>
<?php include "./business/productAnalysisB.php" ?>
<?php
class ProductP
{
    private $from = "2019-08-01";
    private $to = "2019-12-30";
    private $MAX_PRODUCT = 3;

    public function ShowItem()
    {
        $product_id = $this->GetProduct();

        $pb = new ProductB();
        $pa = new ProductAnalysisB();
        $result = $pb->GetProductsByID($product_id);
        $row = mysqli_fetch_array($result);

        if ($pa->CheckIfHighView($row['product_id'], $this->from, $this->to))
            $this->ShowSingleSaleProduct($row['product_name'], $row['product_price'], $row['product_price'] * 0.9, $row['product_img']);

        else
            $this->ShowSingleProduct($row['product_name'], $row['product_price'], $row['product_img']);

        $pab = new ProductAnalysisB();
        $pab->UpdateViewOfProduct($product_id);
    }

    public function GetProduct()
    {
        $product_id = 1;
        if (!isset($_GET['product_id']))
            $product_id = 0;
        else {
            $product_id = $_GET['product_id'];
        }
        return $product_id;
    }

    public function ShowSingleProduct($name, $price, $img)
    {
        $price = number_format($price, 0, ",", ".") . " đ";
        $product = <<<DELIMITER
            <div class="col-sm-12">
                <div class="card" >
                    <img class="card-img-top" src="include/images/{$img}" alt="Card image">
                    <div class="card-body >
                        <h4 class="card-title">{$name}</h4>
                        <p class="card-text">{$price}</p>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            
            DELIMITER;
        echo $product;
    }
    public function ShowSingleSaleProduct($name, $price_original, $price, $img)
    {
        $price = number_format($price, 0, ",", ".") . " đ";
        $price_original = number_format($price_original, 0, ",", ".") . " đ";
        $product = <<<DELIMITER
            <div class="col-sm-12">
                <div class="card" >
                    <img class="card-img-top" src="include/images/{$img}" alt="Card image">
                    <div class="card-body >
                        <h4 class="card-title">{$name}</h4>
                        <p class="card-text" style="font-size: smaller;"> <del>{$price_original}</del>  -10%</p>
                        <p class="card-text">{$price}</p>
                        <a href="#" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            
            DELIMITER;
        echo $product;
    }

    public function VarForProductName($cat_id, $page_id, $product_name, $count)
    {
        $session_name = $cat_id . "_" . $page_id . "_" . $product_name . "_" . $count;
        $_SESSION["{$session_name}"] = $product_name;
    }

    public function ShowProduct($name, $price, $id, $img)
    {
        $price = number_format($price, 0, ",", ".") . " đ";
        $product = <<<DELIMITER
        <div class="col-sm-4">
            <div class="card" >
                <a href="item.php?product_id={$id}">
                    <img class="card-img-top" src="include/images/{$img}" alt="Card image">
                </a>
                <div class="card-body >
                    <h4 class="card-title">{$name}</h4>
                    <p class="card-text"  style="font-size: smaller"><br></p>
                    <p class="card-text">{$price}</p>
                    <a href="#" class="btn btn-primary">Add to cart</a>
                </div>
            </div>
        </div>
        
        DELIMITER;
        echo $product;
    }
    public function ShowSaleProduct($name, $price_original, $price, $id, $img)
    {
        $price = number_format($price, 0, ",", ".") . " đ";
        $price_original = number_format($price_original, 0, ",", ".") . " đ";
        $product = <<<DELIMITER
        <div class="col-sm-4">
            <div class="card" >
                <a href="item.php?product_id={$id}">
                    <img class="card-img-top" src="include/images/{$img}" alt="Card image">
                </a>
                <div class="card-body >
                    <h4 class="card-title">{$name}</h4>
                    <p class="card-text" style="font-size: smaller;"> <del>{$price_original}</del>  -10%</p>
                    <p class="card-text">{$price}</p>
                    <a href="#" class="btn btn-primary">Add to cart</a>
                </div>
            </div>
        </div>
        
        DELIMITER;
        echo $product;
    }

    public function ShowFeaturedProduct()
    {
        $ib = new InventoryB();
        $featuredList = $ib->GetPoorPerformanceList($this->from, $this->to);

        foreach ($featuredList as $x => $x_value) {
            $pb = new ProductB();
            $result = $pb->GetProductsByID($x);
            $row = mysqli_fetch_array($result);
            $product = $this->ShowProduct($row['product_name'], $row['product_price'], $row['product_id'], $row['product_img']);
        }
    }

    public function ShowProductsByUser()
    {
        $cp = new CategoryP();
        $cat_id = $cp->GetCategory();
        if ($cat_id == 0) {
            $this->ShowFeaturedProduct();
        } else {
            $this->ShowProductsInCategory($cat_id);
        }
    }

    public function ShowProductsInCategory($cat_id)
    {
        $cb = new CategoryB();
        $cp = new CategoryP();
        $cat_id = $cp->GetCategory();
        $page = $cp->GetPage();
        $pa = new ProductAnalysisB();

        $saved = false;
        for ($i = 0; $i < $this->MAX_PRODUCT; $i++) {
            $session_name = "listProducts_" . $cat_id . "_" . $page . "_" . $i;
            if (isset($_SESSION["{$session_name}"])) {

                $saved = true;
                $row = $_SESSION["{$session_name}"];

                if ($pa->CheckIfHighView($row['product_id'], $this->from, $this->to))
                    $this->ShowSaleProduct($row['product_name'], $row['product_price'], $row['product_price'] * 0.9, $row['product_id'], $row['product_img']);

                else
                    $this->ShowProduct($row['product_name'], $row['product_price'], $row['product_id'], $row['product_img']);
            }
        }
        if ($saved) {
            return;
        }

        $result = $cb->GetProductsInGroup($cat_id, $page);
        for ($i = 0; $i < $this->MAX_PRODUCT; $i++) {
            if (array_key_exists($i, $result)) {
                $row = $result[$i];

                if ($pa->CheckIfHighView($row['product_id'], $this->from, $this->to))
                    $this->ShowSaleProduct($row['product_name'], $row['product_price'], $row['product_price'] * 0.9, $row['product_id'], $row['product_img']);

                else
                    $this->ShowProduct($row['product_name'], $row['product_price'], $row['product_id'], $row['product_img']);
            }
        }
    }
}
?>