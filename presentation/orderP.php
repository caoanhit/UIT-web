<?php include "./business/orderB.php" ?>
<?php
class OrderP
{
    private $from = "2019-08-01";
    private $to = "2019-12-30";
    public function ShowItem($product_id, $quantity)
    {
        $pb = new ProductB();
        $pa = new ProductAnalysisB();

        $result = $pb->GetProductsByID($product_id);
        $row = mysqli_fetch_array($result);
        if ($pa->CheckIfHighView($product_id, $this->from, $this->to)) {
            $price = $row['product_price'] * 0.9;
        } else $price = $row['product_price'];
        $price_string = number_format($price, 0, ",", ".") . " đ";
        $item = <<<DELIMITER
        <tr>
            <th scope="row" class="border-0">
                <div class="p-2">
                    <img src="include/images/{$row['product_img']}"
                        alt="" width="70" class="img-fluid rounded shadow-sm">
                    <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#"
                                class="text-dark d-inline-block align-middle">{$row['product_name']}</a></h5><span
                            
                    </div>
                </div>
            </th>
            <td class="border-0 align-middle"><strong>{$price_string}</strong></td>
            <td class="border-0 align-middle"><strong>{$quantity}</strong></td>
            <td class="border-0 align-middle"><a href="removeitem.php?product_id={$product_id}" class="text-dark"><img
                        src="include/images/hiclipart.com.png"></img></a></td>
        </tr>
        DELIMITER;
        echo $item;
        return $price;
    }

    public function RemoveItem($product_id)
    {

        $order = $_SESSION["order"];
        unset($order[$product_id]);
        $_SESSION["order"] = $order;
    }
    public function ShowAllItems()
    {
        $total_price = 0;
        if (isset($_SESSION["order"])) {
            $order = $_SESSION["order"];
            foreach ($order as $product_id => $quantity) {
                $total_price += $this->ShowItem($product_id, $quantity) * $quantity;
            }
        }
        return $total_price;
    }
}