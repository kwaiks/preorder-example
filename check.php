<!-- <?php
  include('conne.php');
  $getinvoice = $dblink->query("SELECT order_list.invoice, nama, order_list.nim, total, `status`, order_date, order_list.kode, harga, item, ukuran, kontak FROM `order_list` INNER JOIN invoice_list ON invoice_list.invoice = order_list.invoice INNER JOIN item_list ON item_list.kode = order_list.kode WHERE order_list.invoice='$invoiceid'");
    
    $dbinvoice = array();
    
    //Fetch into associative array
    while ( $row = $getinvoice->fetch_assoc())  {
        $dbinvoice[]=$row;
    }
?> -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width= device-width, initial-scale = 1">
    <title>Order</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/app.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style>
    form {
  /* This bit sets up the horizontal layout */
  display:flex;
  flex-direction:row;
  background-color: white;
  
  /* This bit draws the box around it */
  /* I've used padding so you can see the edges of the elements. */
  padding:2px;
}

input {
  /* Tell the input to use all the available space */
  flex-grow:2;
  /* And hide the input's outline, so the form looks like the outline */
  border:none;
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
                    <a href="#" class="nav-item nav-link">Order</a>
                    <a href="#" class="nav-item nav-link active">Check Invoice</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container mb-5 bg-light rounded">
      <div class="row pt-4 mb-4 pb-4">
        <div class="col-12 mx-auto">
            <form class="form-inline">
                <input class="form-control form-control-sm w-75" type="text" placeholder="Search"
              aria-label="Search">
                <button type="button" class="btn btn-light btn-sm">
                    <span class="fas fa-search"></span> 
                  </button>
              </form>
        </div>
      </div>
      <div class="container pb-4" style="display: block">
      <div id="result" class="row text-dark">
          <div class="col-6 float-left">
              Nama<br>
              Alexander Jacquelline<br>
              NIM:<br>
              201511264<br>
              Kontak:<br>
              awaw  
            </div> 
        <div class="col-6 text-right">
          No Invoice:<br>
          #pbadada<br>
          Tanggal Order:<br>
          23012031<br>
          Status Pembayaran:<br>
          Lunas<br>
        </div> 
      </div>
      <div class="row pt-4">
          <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
      </div>
    </div>
    </div>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/order.js"></script>
</body>

</html>