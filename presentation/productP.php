<?php include "./business/productB.php" ?>
<?php include "./business/inventoryB.php" ?>
<?php include "./business/productAnalysisB.php" ?>
<?php
class ProductP
{
    private $from = "2019-08-01";
    private $to = "2019-11-20";

    public function ShowItem()
    {
        $product_id = $this->GetProduct();

        $pb = new ProductB();
        $result = $pb->GetProductsByID($product_id);
        $row = mysqli_fetch_array($result);
        $this->ShowSingleProduct($row['product_name'], $row['product_price']);

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

    public function ShowSingleProduct($name, $price)
    {
        $product = <<<DELIMITER
            <div class="col-sm-12">
                <div class="card" >
                    <img class="card-img-top" src="include/images/img.png" alt="Card image">
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
    public function ShowProduct($name, $price, $id)
    {
        $product = <<<DELIMITER
        <div class="col-sm-4">
            <div class="card" >
                <a href="item.php?product_id={$id}">
                    <img class="card-img-top" src="include/images/img.png" alt="Card image">
                </a>
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

    public function ShowFeaturedProduct()
    {
        $ib = new InventoryB();
        $featuredList = $ib->GetPoorPerformanceList($this->from, $this->to);

        foreach ($featuredList as $x => $x_value) {
            $pb = new ProductB();
            $result = $pb->GetProductsByID($x);
            $row = mysqli_fetch_array($result);
            $product = $this->ShowProduct($row['product_name'], $row['product_price'], $row['product_id']);
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
        $pb = new ProductB();
        $cp = new CategoryP();
        $cat_id = $cp->GetCategory();
        $result = $pb->GetAllProductsFromCategory($cat_id);

        while ($row = mysqli_fetch_array($result)) {
            $product = $this->ShowProduct($row['product_name'], $row['product_price'], $row['product_id']);
        }
    }
}
?>