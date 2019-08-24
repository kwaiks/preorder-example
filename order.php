<?php
include('conne.php');

$list = $dblink->query("SELECT * FROM item_list");

$lists = array();

while ( $row = $list->fetch_assoc()){
    $lists[] = $row;
}

$dblink->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width= device-width, initial-scale = 1">
    <title>Order</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/app.css" />
    <style>
        .checkbox{
            width: 33%;
            display: inline-block;
        }
    </style>
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
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="#" class="nav-item nav-link active">Order</a>
                    <!-- <a href="#" class="nav-item nav-link">Check Invoice</a> -->
                </div>
            </div>
        </nav>
    </div>
    <div class="container mb-5">
        <div class="row">
            <!-- <div class="col-md-4 order-md-2 mb-4">
                              <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span>Your cart</span>
                              </h4>
                              <ul class="list-group mb-3" id="cart">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h6 class="my-0">Product name</h6>
                                    <small class="text-muted">Brief description</small>
                                  </div>
                                  <span class="text-muted">$12</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h6 class="my-0">Second product</h6>
                                    <small class="text-muted">Brief description</small>
                                  </div>
                                  <span class="text-muted">$8</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h6 class="my-0">Third item</h6>
                                    <small class="text-muted">Brief description</small>
                                  </div>
                                  <span class="text-muted">$5</span>
                                </li>
                              </ul>
                              <li class="list-group-item d-flex justify-content-between">
                                    <span>Total</span>
                                    <div>
                                            <strong>Rp </strong><strong>20.000</strong>
                                    </div>
                                    
                              </li>
                            </div> -->
            <div class="col-md-8 mx-auto order-md-1">
                <h4 class="mb-3">Pre-Order Sekarang</h4>
                <form action="invoice.php" method="post" id="myform">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama"><span id="nama-alert"
                            style="color:red;display:none">Mohon isi nama anda</span>
                    </div>

                    <div class="mb-3">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" name="nim" id="nim"><span id="nim-alert"
                            style="color:red;display:none">Mohon isi NIM anda</span>
                    </div>

                    <div class="mb-3">
                            <label for="contact">LINE/WA</label>
                            <input type="text" class="form-control" name="kontak" id="kontak"><span id="tak-alert"
                                style="color:red;display:none">Mohon sertakan kontak anda</span>
                        </div>

                    <label for="item">Item</label>
                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-3">
                            <?php
                                foreach($lists as $data){
                                    if($data['sandang']=="1"){
                                        echo '<div class="checkbox">
                                                <label><input class="sandang item" type="checkbox" name="kode[]" value="'.$data['kode'].'">
                                                    '.$data['item'].'</label>
                                                <input type="hidden" id="nilai'.$data['id'].'" value="'.$data['harga'].'">
                                            </div>';
                                    }else if(strpos($data['item'],'E-money')!== false){
                                        echo '<div class="checkbox">
                                            <label><input class="item" type="checkbox" name="kode[]" value="'.$data['kode'].'">
                                                '.substr($data['item'],0,7).' (Kode : '.strtoupper($data['kode']).')</label>
                                            <input type="hidden" id="nilai'.$data['id'].'" value="'.$data['harga'].'">
                                        </div>';
                                    }else{
                                        echo '<div class="checkbox">
                                            <label><input class="item" type="checkbox" name="kode[]" value="'.$data['kode'].'">
                                                '.$data['item'].'</label>
                                            <input type="hidden" id="nilai'.$data['id'].'" value="'.$data['harga'].'">
                                        </div>';
                                    }
                                    
                                };
                            ?>
                            <!-- <div class="checkbox">
                                <label><input class="sandang item" type="checkbox" name="kode[]" value="h1">
                                    Hoodie</label>
                                <input type="hidden" id="nilai1" value="180000">
                            </div>
                            <div class="checkbox">
                                <label><input class="sandang item" name="kode[]" type="checkbox" value="j1"> Jaket
                                    Bomber</label>
                            </div>
                            <div class="checkbox">
                                <label><input class="item" name="kode[]" type="checkbox" value="l1"> Lanyard</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="checkbox">
                                <label><input class="item" type="checkbox" name="kode[]" class="item" value="e1"> E-Money (Kode:
                                    E-1)</label>
                            </div>
                            <div class="checkbox">
                                <label><input class="item" type="checkbox" name="kode[]" class="item" value="e2"> E-Money (Kode:
                                    E-2)</label>
                            </div>
                            <div class="checkbox">
                                <label><input class="item" type="checkbox" name="kode[]" class="item" value="e3"> E-Money (Kode:
                                    E-3)</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="checkbox">
                                <label><input class="yas" type="checkbox" name="kode[]" class="item" value="e4"> E-Money (Kode:
                                    E-4)</label>
                            </div>
                        </div> -->
                            </div>
                    </div>
                    <span id="check-alert" style="color:red;display:none">Please check at least one item</span>
                    <div id="ukuran-list" class="row" style="display:none">
                        <div class="col-md-2 mb-3">
                            <label for="ukuran">Ukuran</label>
                            <select class="custom-select d-block w-100" id="ukuran" name="ukuran">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                            </select>
                        </div>
                    </div>
                </form>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" id="mdBtn">Checkout</button>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
            id="mi-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h5>Detail</h5>
                        <hr>
                        Nama : <span id="nama-mdl"></span><br>
                        NIM :<span id="nim-mdl"></span><br>
                        Kontak :<span id="tak-mdl"></span>
                        <hr>
                        <ul class="list-group" id="item-modal">
                        <?php
                                foreach($lists as $data1){
                                    if($data1['sandang']=="1"){
                                        echo '<li style="display:none" class="list-group-item justify-content-between" id="item-modal'.$data1['id'].'">
                                            <div class="d-flex justify-content-between">
                                                    <div>
                                                            <h6 class="my-0">'.$data1['item'].'</h6>
                                                            <small class="text-muted">Ukuran <span id="ui">S</span></small>
                                                        </div><span class="text-muted">Rp '.number_format($data1['harga'],0,",",".").'</span>
                                            </div>
                                        </li>';
                                    }else if(strpos($data1['item'],'E-money')!== false){
                                        echo '<li style="display:none" class="list-group-item justify-content-between" id="item-modal'.$data1['id'].'">
                                            <div class="d-flex justify-content-between">
                                                    <div>
                                                            <h6 class="my-0">'.substr($data['item'],0,7).'</h6>
                                                            <small class="text-muted">Kode : '.strtoupper($data1['kode']).'</small>
                                                        </div><span class="text-muted">Rp '.number_format($data1['harga'],0,",",".").'</span>
                                            </div>
                                        </li>';
                                    }else{
                                        echo '<li style="display:none" class="list-group-item justify-content-between" id="item-modal'.$data1['id'].'">
                                            <div class="d-flex justify-content-between">
                                                    <div>
                                                            <h6 class="my-0">'.$data1['item'].'</h6>
                                                            <small class="text-muted">Kode : '.strtoupper($data1['kode']).'</small>
                                                        </div><span class="text-muted">Rp '.number_format($data1['harga'],0,",",".").'</span>
                                            </div>
                                        </li>';
                                    }
                                    
                                }
                            ?>
                        
                        </ul>
                        <hr>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total</strong>
                            <div>
                                <strong>Rp </strong><strong id="total"></strong>
                            </div>
                        </li>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="modal-btn-b">Kembali</button>
                        <button type="button" class="btn btn-primary" id="submitBtn">Benar</button>
                    </div>
                </div>
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
    <script src="assets/js/order.js"></script>
    <script>
        
    </script>
</body>

</html>