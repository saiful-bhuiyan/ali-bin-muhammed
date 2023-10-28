<?php
include('../DBconfig.php');

  /********* User auth start ***********/

$id=$_SESSION['id'];
$Query="SELECT *FROM `accounts` WHERE `id`='$id'";
$result=mysqli_query($con, $Query);
$row=mysqli_fetch_assoc($result);
$user=$row['id'];
$username=$row['first_name'];
if(!isset($_SESSION['id'])){
  header('Location: ../Account/Login.php');
}


  /********* User auth end ***********/

  $invoiceID = $_GET['invoiceID'];
  $query1="SELECT `invoice_no` FROM `parts_sales` WHERE `invoice_no` = '$invoiceID'";
  $q1=mysqli_query($con, $query1);
  if($q1){
    $row1=mysqli_fetch_assoc($q1);
    $invoice=$row1['invoice_no'];
    

  } 
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Sales Memo</title>
    <link rel="stylesheet" href="../../style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src = "https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <style type="text/css">

      p{
        margin: 0;
      }

    .headline{
      text-shadow: .5px .5px #000000;
      color: #fff;
    }
    .headline2{
      text-shadow: .5px .5px #000000;
      color: red;
    }
    }
    .title1{
      font-size: 28px;
      font-weight: bold;
      color: red;
    }
    .title2{
      font-size: 27px;
      font-weight: bold;
    }
    .title3{
      font-size: 22px;
      font-weight: bold;
      
    }
    .title4{
      font-size: 1.7rem;
      font-weight: bold;
      color: green;
      
    }
    .title5{
      font-size: 18px;
      font-weight: bold;
      
    }
    .tableScroll::-webkit-scrollbar{
    display: none;
    }
    .data-table{
       border-collapse: collapse;
    }
    .data-table td{
       border: 1px solid black;
       text-align: center;
    }
    .data-table th{
      border: 1px solid black;
      font-weight: bold;
    }


    </style>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
  <body>
  
  <div class="container col-lg-10 text-center">
    <p style="color:red;" class="fs-2">
    مؤسسة علي بن محمد بخيت بيت مبارك للتجارة
  </p>
  
  <p style="color:red;" class="title2">
    ALI BIN MOHAMMED BAKHAIT BAIT MOBARAK TRAD . EST
  </p>
  <p class="title3">
    Sahalnoot Saniya , Salalah, Sultanate of Oman

  </p>
  <p class="title3">
    قطع الغيار الجديدة والمستعملة للمركبات 

  </p>

  <p style="color:green;" class="title3">
    SALE OF NEW SPARE PARTS 

  </p>
  <p class="title3">
     Director: Mostafizur Rahman: 92830213 (Sayed) : 98973232

  </p>
  </div>

  <div style="margin-top:1rem" class=" col-lg-12 text-center d-flex">
    <div class="col-lg-4 col-md-4 col-sm-4 title5">
      <p id="curDate">Print Date :</p>
    </div>
    <div class="col-lg-4  col-md-4 col-sm-4 title5">
      <p id="Ptime">Print Time :</p>
    </div>
    <div class="col-lg-4  col-md-4 col-sm-4 title5">
      <p>Operator : <?php echo $username; ?></p>
    </div>
  </div>

  <div style="margin-top:1rem;" class="col-lg-12 col-md-12 col-sm-12 text-center title4">
    <p><u>Product Sales Memo</u></p>
  </div>

  <!-- Sales Date -->

  <div style="margin:2rem 0 0 0rem;" class="container text-center col-lg-12 d-flex">
    <div class="col-lg-5 col-md-5 col-sm-5 title5">
      <p>Sales Date : 
      <?php
      $query="SELECT `date` FROM `parts_sales` WHERE `invoice_no`='$invoice' GROUP BY `date`";
      $q=mysqli_query($con, $query);
      if($q){
        $data=mysqli_fetch_assoc($q);
        $Sdate=$data['date'];
        $newDate = date("d-m-Y", strtotime($Sdate));
      }
      echo $newDate;
     ?>
     </p>
    </div>

    <!-- Invoice No -->

    <div class="col-lg-4  col-md-4 col-sm-4 title5">
      <p>Invoice : <?php echo $invoiceID; ?></p>
    </div>
  </div>

  <div style="margin:1rem 0 0 0;" class="container text-center col-lg-12 d-flex">

    <!-- Supplier Name -->

    <div class="col-lg-6 col-md-6 col-sm-6 title5">
      <p>Customer Name : 
      <?php 
      $query="SELECT `customer_name` FROM `parts_sales` WHERE `invoice_no`='$invoice' GROUP BY `customer_name`";
      $q=mysqli_query($con, $query);
      if($q){
        $data=mysqli_fetch_assoc($q);
        $Sname=$data['customer_name'];
      }
      echo $Sname;
      ?>
      </p>
    </div>

    <!-- Supplier Address -->

    <div class="col-lg-3  col-md-3 col-sm-3 title5">
      <p>Customer Address : 
      <?php 
      $query="SELECT `customer_address` FROM `parts_sales` WHERE `invoice_no`='$invoice' GROUP BY `customer_address`";
      $q=mysqli_query($con, $query);
      if($q){
        $data=mysqli_fetch_assoc($q);
        $Saddress=$data['customer_address'];
      }
      echo $Saddress;
      ?>
      </p>
    </div>

    <!-- Mobile No -->

    <div class="col-lg-3 col-md-3 col-sm-3 title5">
      <p>Tel : 
      <?php 
      $query="SELECT `customer_name` FROM `parts_sales` WHERE `invoice_no`='$invoice' GROUP BY `customer_name` ";
      $q=mysqli_query($con, $query);
      if($q){
        $data=mysqli_fetch_assoc($q);
        $Gname=$data['customer_name'];
        $query2="SELECT `customer_mobile` FROM `customer_setup` WHERE `customer_name` = '$Gname' GROUP BY `customer_name`";
        $q2=mysqli_query($con, $query2);
        if($q2){
          $data2=mysqli_fetch_assoc($q2);
          
          if($data2){
            $Sname=$data2['customer_mobile'];
          }else{
            $Sname="";
          }
        }
      }
      echo $Sname;
      
      ?>
      </p>
    </div>
  </div>

  <div style="margin-top:1rem" class="container col-lg-10 text-center">
    <div class="row overflow-scroll tableScroll">
    <table id="table" class="data-table">
        <thead>
          <tr>
            <th>SL</th>
            <th width="10%">SALES BY</th>
            <th>PARTS NAME</th>
            <th>CATAGORY</th>
            <th>SIZE</th>
            <th>QTY</th>
            <th>AMOUNT(OMR)</th>
          </tr>
        </thead>
        <tbody>
           
          <?php
          

        $sel="SELECT `id`,`sales_by`,`parts_name`,`catagory`,`size`,`quantity`,`amount` FROM `parts_sales` WHERE `invoice_no`='$invoice'";
          $q=mysqli_query($con, $sel);
          $count=1;
            while($row=mysqli_fetch_assoc($q))
            {
              $a=$row['id'];
              $b=$row['sales_by'];
              $c=$row['parts_name'];
              $d=$row['catagory'];
              $e=$row['size'];
              $f=$row['quantity'];
              $g=$row['amount'];
        ?>
        <tr>
          <td align="center"><?php echo $a; ?></td>
          <td align="center"><?php echo $b; ?></td>
          <td align="center"><?php echo $c; ?></td>
          <td align="center"><?php echo $d; ?></td>
          <td align="center"><?php echo $e; ?></td>
          <td align="center"><?php echo $f; ?></td>
          <td align="center"><?php echo number_format($g,3); ?></td>
        </tr>
        <?php
        $count++;
        }
        ?>
        <tr>
          <td colspan="5" align="center" style="font-weight: bold;color: red;">TOTAL : </td>
          <td align="center" style="color: red;font-weight: bold;">
          <?php
            $query="SELECT SUM(`quantity`) FROM `parts_sales` WHERE `invoice_no`='$invoice'";
            $q=mysqli_query($con, $query);
            if($q){
              $data=mysqli_fetch_assoc($q);
              $Sqnt=$data['SUM(`quantity`)'];
            }
            echo $Sqnt;

           ?>
          </td>
          <td align="center" style="color: red;font-weight: bold;">
            <?php
            $query="SELECT SUM(`amount`) FROM `parts_sales` WHERE `invoice_no`='$invoice'";
            $q=mysqli_query($con, $query);
            if($q){
              $data=mysqli_fetch_assoc($q);
              $Samnt=$data['SUM(`amount`)'];
            }
            echo number_format($Samnt,3);

           ?>
          </td>
        </tr>

        </tbody>
      </table>
      <input type="text" id="numWord" value="<?php echo $Samnt; ?>" hidden>
    </div>
    
    
  </div>
  <div class="col-lg-12 container">
      <p class="col-lg-10 result title5">IN WORD :</p>
    </div>

    <div style="margin-top: 4rem;" class="container col-lg-12 d-flex title5">
      <P style="text-decoration: overline;" class="col-lg-10 col-md-8 col-sm-6">Manager Sign</P>
      <P style="text-decoration: overline;" class="col-lg-2 col-md-4 col-sm-6">Director Sign</P>

  </div> 


  
  <script src="../../script.js"></script>

  <script>
    //  Current date function
    var today = new Date();
    var dd = String(today. getDate()). padStart(2, 0);
    var mm = String(today. getMonth() + 1). padStart(2, 0); //January is 0!
    var yyyy = today. getFullYear();

    today = dd + '-' + mm + '-' + yyyy;

    $(document).ready(function(){
      $('#curDate').text("Print Date : "+ today)
      let current_time = moment().format("h:mm a");
      $('#Ptime').append(" "+current_time);

      var num = $('#numWord').val();
      // num = Number(num.toFixed(3));
      var text=inWords(num);
      $('.result').append(text+" OMR ONLY");
    })

    /****************** Num to text function ********************/

  function inWords (num) {
    
        var a = ['','ONE ','TWO ','THREE ','FOUR ', 'FIVE ','SIX ','SEVEN '       ,'EIGHT ','NINE ','TEN ','ELEVEN ','TWELVE ','THIRTEEN '         ,'FOURTEEN ','FIFTEEN ','SIXTEEN ','SEVENTEEN ','EIGHTEEN '      ,'NINETEEN '];
        var b = ['', '', 'TWENTY','THIRTY','FORTY','FIFTY', 'SIXTY','SEVENTY'      ,'EIGHTY','NINETY'];
        var dec = '';
     
        // this part of code is edited to support decimal point
    
        var s_num = num.toString()
        
        if (s_num.includes('.') && s_num.split('.')[0].length > 9){
        
          return num;
        
        }
        else if (!s_num.includes('.') && s_num.length > 9){
          return num;
        }

        else{

          if (num.toString().includes('.')){
            
            // used recursion to get decimal point value in words
            let tmp = num.toString().split('.');
            dec = 'RIAL AND ' + inWords(Number(tmp[1])) + 'BAISA';
            
            num = Number(tmp[0]);
        }
        // end of decimal point code part.
    
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        
        if (!n) return; var str = '';
        
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'CRORE ' : '';
    
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'LAKH ' : '';
        
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'THOUSAND ' : '';
        
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'HUNDRED ' : '';
        
        str += (n[5] != 0) ? ((str != '') ? 'AND ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]])  : '';
        
       
        return str + dec ;
      }
    
  }


      /************ Update logger info **************/

      function updateUserStatus(){
        jQuery.ajax({
          url:'update_user_stats.php',
          success:function(){
            
          }
        });
      }


      setInterval(function(){
        updateUserStatus();
      },3000);

  </script>
  
  
  
  

</body>
</html>
