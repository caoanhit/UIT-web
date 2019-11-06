<?php include "./business/productB.php" ?>
<?php include "./business/inventoryB.php" ?>
<?php
class ProductP
{
    private $from = "2019-08-01";
    private $to = "2019-10-05";
    public function ShowSingleProduct($name, $price){
        $product_id = 1;
        if (!isset($_GET['product_id']))
            $product_id = 0;
        else{
            $product_id = $_GET['category'];
        }
        $pb = new ProductB();
        $result = $pb->GetProductsByID($x);
        $row = mysqli_fetch_array($result);

        $product = <<<DELIMITER
            <div class="col-sm-4">
                <div class="card" >
                    <img class="card-img-top" src="include/images/img.png" alt="Card image">
                    <div class="card-body >
                        <h4 class="card-title">{$row['product_name']}</h4>
                        <p class="card-text">{$row['product_price']}</p>
                        <a href="#" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
            
            DELIMITER;
        echo $product;
    }
    public function ShowProduct($name,$price){
        $product = <<<DELIMITER
        <div class="col-sm-4">
            <div class="card" >
                <img class="card-img-top" src="include/images/img.png" alt="Card image">
                <div class="card-body >
                    <h4 class="card-title">{$name}</h4>
                    <p class="card-text">{$price}</p>
                    <a href="#" class="btn btn-primary">Buy</a>
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
            $product = $this->ShowProduct($row['product_name'],$row['product_price']);
        }
    }

    public function ShowProductsByUser(){
        $cp = new CategoryP();
        $cat_id = $cp->GetCategory();
        if ($cat_id==0)
        {
            $this->ShowFeaturedProduct();
        }
        else{
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
            $product = $this->ShowProduct($row['product_name'],$row['product_price']);
        }
    }
}
?>