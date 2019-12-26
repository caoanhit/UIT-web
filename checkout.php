<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <title>Checkout</title>
    </head>

    <body>
        <div class="px-4 px-lg-0">
            <!-- For demo purpose -->
            <div class="container text-white py-5 text-center">
                <h1 class="display-4">Bootstrap 4 shopping cart</h1>
                <p class="lead mb-0">Build a fully structred shopping cart page using Bootstrap 4. </p>
                <p class="lead">Snippet by <a href="https://bootstrapious.com/snippets" class="text-white font-italic">
                        <u>Bootstrapious</u></a>
                </p>
            </div>
            <!-- End -->

            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                            <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 text-uppercase">Product</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-uppercase">Price</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-uppercase">Quantity</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-uppercase">Remove</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    include "./data/Database.php";
                                    include "./presentation/orderP.php";
                                    include "./presentation/productP.php";
                                    $ob = new OrderB();
                                    if ($ob->ItemCount() == 0) {
                                        header('Location: index.php');
                                    }
                                    $op = new OrderP();
                                    $total_price = $op->ShowAllItems();

                                    ?>


                                    </tbody>
                                </table>
                            </div>
                            <!-- End -->
                        </div>
                    </div>

                    <div class="row py-5 p-4 bg-white rounded shadow-sm">

                        <div class="col-lg-6">

                            <div class="p-4">

                                <ul class="list-unstyled mb-4">

                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                            class="text-muted">Total</strong>
                                        <h5 class="font-weight-bold"><?php
                                                                    $total_price = number_format($total_price, 0, ",", ".") . " đ";
                                                                    echo $total_price ?></h5>
                                    </li>
                                </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to
                                    checkout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </body>

</html>