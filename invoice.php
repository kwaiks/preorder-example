<?php
    include('conne.php');
include('assets/pdf/src/InvoicePrinter.php');
    /*database */
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kontak = $_POST['kontak'];
    if(isset($_POST['ukuran'])){
        $ukuran = $_POST['ukuran'];
    }else{
        $ukuran = "None";
    }
    $invoiceid = "#pb".unique_code(4);
    $total_query = "SELECT SUM(harga) as total FROM item_list WHERE kode IN (";
    $sql ="'";
    if (is_array($_POST['kode'])) {
        foreach($_POST['kode'] AS $value) {
            $sql =  $sql."{$value}"."'".","."'";
            if($value == 'h1' || $value == 'j1'){
                $result = $dblink->query("INSERT INTO `order_list`(`nim`, `kode`, `ukuran`, `invoice`) VALUES ('$nim','{$value}', '$ukuran', '$invoiceid')");
            }else{
                $result = $dblink->query("INSERT INTO `order_list`(`nim`, `kode`, `ukuran`, `invoice`) VALUES ('$nim','{$value}', 'None', '$invoiceid')");
            }
            
        }
    } else {
        echo "No column was selected<br /><br />";
    }
    
    $aww = substr($sql,0,-2);
    $total_query = $total_query.$aww.")";
    
    $query = mysqli_query($dblink, $total_query);
    
    $dbdata = array();
    
    //Fetch into associative array
    while ( $row = mysqli_fetch_assoc($query))  {
        $dbdata[]=$row;
    }
    
    $total = $dbdata[0]['total'];
    
    $result2 = $dblink->query("INSERT INTO `invoice_list`(`nama`, `nim`, `invoice`, `total`, `kontak`) VALUES ('$nama','$nim','$invoiceid','$total', '$kontak')");
    
    //Print array in JSON format
    
    function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
    /*end send data*/
    
    $getinvoice = $dblink->query("SELECT order_list.invoice, nama, order_list.nim, total, `status`, order_date, order_list.kode, harga, item, ukuran, kontak FROM `order_list` INNER JOIN invoice_list ON invoice_list.invoice = order_list.invoice INNER JOIN item_list ON item_list.kode = order_list.kode WHERE order_list.invoice='$invoiceid'");
    
    $dbinvoice = array();
    
    //Fetch into associative array
    while ( $row = $getinvoice->fetch_assoc())  {
        $dbinvoice[]=$row;
    }


    $date = strtotime($dbinvoice[0]['order_date']);

    
    $dblink->close();
    //end database
$invoice = new InvoicePrinter();
  /* Header Settings */
  $invoice->setLogo("assets/image/logo.png");
  $invoice->setColor("#203c7a");
  $invoice->setType("PRE-ORDER");
  $invoice->setReference($dbinvoice[0]['invoice']);
  $invoice->setDate(date('d-m-Y',$date));
  $invoice->setDue($dbinvoice[0]['status']);
    $invoice->setFrom(array($dbinvoice[0]['nama'],$dbinvoice[0]['nim'],$dbinvoice[0]['kontak']));
  /* Adding Items in table */
  foreach($dbinvoice as $data){
      if($data['ukuran']=="None"){
        $invoice->addItem($data['item'],"Kode: ".strtoupper($data['kode']),$data['harga']);
      }else{
        $invoice->addItem($data['item'],"Kode: ".strtoupper($data['kode'])." Ukuran: ".$data['ukuran'],$data['harga']);
      }
      
  }
  /* Add totals */
  $invoice->addTotal("Total",$dbinvoice[0]['total'],true);
  $invoice->addTitle("Penting");
    $invoice->addParagraph("Silahkan melengkapi pembayaran dengan mentransfer sejumlah Rp ".$dbinvoice[0]['total']." ke");
    $invoice->addParagraph("BNI : 00 a/n aww");
    $invoice->addParagraph("Mandiri : 00 a/n aww");
    $invoice->addParagraph("Atau langsung mendatangi Portacamp BEM");
    $invoice->addParagraph("");
    $invoice->addParagraph("Jika sudah melakukan pembayaran mohon mengkonfirmasi dengan melampirkan struk pembayaran ke");
    $invoice->addParagraph("WA  : 081818928312 atau");
    $invoice->addParagraph("LINE  : nhareva atau");
    $invoice->addParagraph("Email : bismitsttpln@gmail.com dengan judul \"Pre-Order_No Invoice\"");
  /* Render */
  $invoice->render('preorder_invoice.pdf','I'); /* I => Display on browser, D => Force Download, F => local path save, S => return document path */
?>
