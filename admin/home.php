<?php
    include('../conne.php');

    session_start();  
    if(!isset($_SESSION['userid'])){
        header('Location: index.php');
       }
       
       // logout
       if(isset($_POST['btn_logout'])){
        session_destroy();
       
        // Remove cookie variables
        $days = 30;
        setcookie ("rememberme","", time() - ($days * 24 * 60 * 60 * 1000));
       
        header('Location: index.php');
       }

    $getitem = $dblink->query("SELECT item,order_list.kode,count(*) as jumlah FROM `order_list` INNER JOIN item_list ON item_list.kode = order_list.kode GROUP BY order_list.kode");
    $gettotal = $dblink->query("SELECT count(*) as total FROM invoice_list");
    $inc = $dblink->query("SELECT SUM(harga) as total FROM `item_list` INNER JOIN order_list ON item_list.kode = order_list.kode GROUP BY order_list.kode");
    $prof = $dblink->query("SELECT SUM(modal) as total FROM `item_list` INNER JOIN order_list ON item_list.kode = order_list.kode GROUP BY order_list.kode");
    $unpaid = $dblink->query("SELECT count(*) as total FROM `invoice_list` WHERE `status` = 'Belum Bayar'");

    $profit = array();

    while ( $row = $prof->fetch_assoc())  {
        $profit[]=$row;
    }

    $income = array();

    while ( $row = $inc->fetch_assoc())  {
        $income[]=$row;
    }

    $itemlist = array();
    
    //Fetch into associative array
    while ( $row = $getitem->fetch_assoc())  {
        $itemlist[]=$row;
    }

    $laba = array_sum(array_column($income,'total')) - array_sum(array_column($profit,'total'));
    $totalcount = mysqli_fetch_array($gettotal);
    $unpaidcount = mysqli_fetch_array($unpaid);

    $dblink->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <img src="../assets/image/logo.png" class="rotate-n-15" width="50" height="50">
                <div class="sidebar-brand-text mx-2">Pre-Order</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="konfirmasi.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Konfirmasi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="cekdata.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Cek Data</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <? echo $_SESSION['userid']?></span>
                                <img class="img-profile rounded-circle" src="https://source.unsplash.com/random/60x60">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Total Item</h6>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <?php 
                        foreach($itemlist as $data){
                            echo '<div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'.$data['item'].'
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">'.$data['jumlah'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-tag fa-2x text-gray-300"></i>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        } 
                        ?>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pemasukan</h6>
                        </div>
                    </div>

                    <div class="row">

                    <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Order
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalcount['total'] ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-tag fa-2x text-gray-300"></i>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Perkiraan Pendapatan
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?php echo number_format(array_sum(array_column($income,'total')),0,",","."); ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Perkiraan Keuntungan
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?php echo number_format($laba,0,",","."); ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>

                    <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-danger shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Belum Bayar
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $unpaidcount['total'] ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-tag fa-2x text-gray-300"></i>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>

                    

                    <!-- Content Row -->

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; BEM KBM STT-PLN Kolaborasi 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">


                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method='post' action="">
                        <input type="submit" value="Logout" name="btn_logout" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>