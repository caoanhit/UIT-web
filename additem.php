<?php include "./presentation/orderP.php" ?>
<?php
session_start();
$ob = new OrderB();
if (isset($_GET['product_id'])) {
    $ob = new OrderB();
    $ob->AddItem($_GET['product_id']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>