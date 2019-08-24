<?php
include('conne.php');

$item = $dblink->query("SELECT `item`,`kode`,`harga`,`image` FROM item_list");

$items = array();

while ( $row = $item->fetch_assoc())  {
    $items[]=$row;
}

$dblink->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width= device-widht, initial-scale = 1">
        <title>Pre-Order KBM STT-PLN</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/app.css"/>  
    </head>
    <body>
    <div class="p-3 px-md-5 mb-3">
            <nav class="navbar navbar-expand-md">
                    <strong class="navbar-brand">Badan Bisnis dan Kemitraan</strong>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ml-auto">
                            <a href="#" class="nav-item nav-link active">Home</a>
                            <a href="order.php" class="nav-item nav-link">Order</a>
                            <!-- <a href="#" class="nav-item nav-link">Check Invoice</a> -->
                        </div>
                    </div>
                </nav>
            </div>
            <div class="container text-center">
                <div class="container p-3">
                <h1>PRE-ORDER</h1>
                <span>26 Agustus 2019 - 16 September 2019</span>
            </div>
                <div class="row mx-auto p-4 justify-content-center">
                    <?php
                       foreach($items as $data){
                           echo '<div class="col-sm-6 col-md-4 pb-4">
                                <img src="assets/image/'.$data['image'].'" class="img-thumbnail"><br>
                                <br>
                                <h5>'.$data['item'].'</h5>
                                <span>Kode : '.strtoupper($data['kode']).'</span><br>
                                <span>Rp '.number_format($data['harga'],0,",",".").'</span>
                            </div>';
                       };
                    ?>
                    </div>
                    <div class="row mx-auto p-5 text-center">
                        <div class="col-12">
                                <a href="order.php" class="btn btn-outline-light btn-lg" role="button">Pesan Sekarang</a>
                        </div>
                    </div>
                    
            </div>

            <hr>
            <div class="row justify-content-center pb-4">
            <span class="pr-2"> Contact Person : </span>
            <img src="assets/image/line.png" height="30" width="30">
            <span class="pl-2"> nhareva</span>
            <img class="ml-4" src="assets/image/wa.png" height="30" width="30">
            <span class="pl-2"> 081818928312</span>
            </div>

            <script src="assets/js/jquery-3.4.1.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>