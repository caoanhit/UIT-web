<?php include "presentation/orderP.php" ?>
<?php
session_start();
if (isset($_GET['product_id'])) {
    $op = new OrderP();
    $op->RemoveItem($_GET['product_id']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>