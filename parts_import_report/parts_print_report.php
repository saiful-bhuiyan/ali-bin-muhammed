<?php
include("../DBconfig.php");
$id=$_SESSION['id'];
$Query="SELECT *FROM `accounts` WHERE `id`='$id'";
$result=mysqli_query($con, $Query);
$row=mysqli_fetch_assoc($result);
$user=$row['id'];
$username=$row['first_name'];
if(!isset($_SESSION['id'])){
  header('Location: ../Account/Login.php');
}

$supAddress = "";
$supName = "";

$newDate1 = date("d-m-Y", strtotime($_GET['date1']));
$newDate2 = date("d-m-Y", strtotime($_GET['date2']));
if(isset($_GET['supAddress']) != "" && isset($_GET['supName']) != ""){
  $supAddress = $_GET['supAddress'];
  $supName = $_GET['supName'];
}


?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Parts Import Report</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src = "https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style type="text/css">
      
      label{
        color: white;
      }
      .headline{
        text-shadow: .5px .5px #000000;
        color: #fff;
      }
      .headline2{
        text-shadow: .5px .5px #000000;
        color: red;
      }
      .divScroll::-webkit-scrollbar {
        display: none;
      }

      body{
        font-size: 80%;
      }
 
      .table th, .table td{
        padding: 1.5px 7px 1.5px 7px; /* Apply cell padding */
        font-weight: bold;
      }
      .table th{
        font-size: 15px;
      }
      #table th{
        color: green;
      }
      #table2 th{
        color: red;
      }
      .tborder{
        border: 1px solid black;
      }
      .active-row{
        background-color: #8bc4cc;
      }
      @media print {
        table td:nth-child(7){
          display:none;
          visibility: hidden;
        }
      }

    </style>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
  <body>
  
    <div id="importReportDiv" class="container col-lg-10 rounded-3 text-center">

      <div class="row overflow-scroll divScroll">
        <table id="table" class="table table-striped table-bordered">
        	<h4 style="color:#130091;" class="headline2">ALI BIN MOHAMMED BAKHAIT BAIT MOBARAK TRAD . EST</h4>
        	<h4 style="color:#130091;" class="headline2">Sahalnoot Saniya , Salalah, Sultanate of Oman</h4>
          <div style="width:100%;" class="d-flex col-lg-12 col-md-12 col-sm-12 text-center">
            <h5 id="getDate1" class="headline2 col-lg-4" hidden><?php echo $_GET['date1']; ?></h5>
            <h5 id="getDate2" class="headline2 col-lg-4" hidden><?php echo $_GET['date2']; ?></h5>
            <h6 style="width:33%;" id="curDate" class="headline2 col-lg-4">Print Date : <?php echo $newDate1; ?></h6>
            <h6 style="width:33%;" id="curTime" class="headline2 col-lg-4">Print time : <?php echo $newDate2; ?></h6>
            <h6 style="width:33%;" class="headline2 col-lg-4">Operator : <?php echo $username; ?></h6>
          </div>
          <div style="width:100%;" class="d-flex col-lg-12 col-md-12 col-sm-12 text-center">
            <h6 style="width:50%;text-align: center;" id="getSupAddress" class="headline2 col-lg-4 dtoSize" hidden><?php echo $supAddress; ?></h6>
            <h6 style="width:50%;text-align: center;" id="getSupName" class="headline2 col-lg-4 dtoSize" hidden><?php echo $supName; ?></h6>
          </div>
        	<h3 class="headline3">Parts Import Report</h3>
          <div style="width:100%;" class="d-flex col-lg-12 col-md-12 col-sm-12 text-center">
            <h5 style="width:50%;text-align: center;" id="printSupAddress" class="headline2 col-lg-6">Address :</h5>
            <h5 style="width:50%;text-align: center;" id="printSupName" class="headline2 col-lg-6">Name : </h5>
          </div>
          <div style="width:100%;" class="d-flex col-lg-12 col-md-12 col-sm-12 mx-auto text-center">
            <h6 style="text-align: center;width: 100%;" id="slDate" class="headline2 searchDate col-lg-12 col-md-12 col-sm-12">
              Search Date : <?php echo $newDate1; ?> To : <?php echo $newDate2; ?></h6>
          </div>
          <thead>

          </thead>
          <tbody>
           
          </tbody>
        </table>
      </div>
    </div>

  
  <script src="../script.js"></script>
  <script>

     // Redirect to login page

    $('#adminRef').click(function(){
      window.open("../Account/admin.php");
    })

    $(document).ready(function(){
      $('#importReportDiv').hide();
    });

    var d = new Date();
    var currentDate = d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear();
    $('#curDate').text("Print Date : " + currentDate);

    var time = new Date();
    $('#curTime').text("Print Time : " + time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }));


	  $(document).ready(function(){
	  	var date1 = $('#getDate1').text();
      var date2 = $('#getDate2').text();
	  	var supAddress = $('#getSupAddress').text();
      var supName = $('#getSupName').text();

      var left = (screen.width - 1200) / 2;
      var top = (screen.height - 700) / 4;

	  	if(supAddress == "" && supName == "" && date1 != "" && date2 != ""){
        
	  		$.ajax({
					url : "pirSelect.php",
					type : "GET",
					data: { 
						'date1' : date1,
						'date2' : date2
					},
					success : function(data){
						$('table').html(data);
						$('.showInvo').on('click',function(){
						  	var invo=$(this).data('id');
  							var currentRow=$(this).closest("tr");
                var myWindow = window.open('purchase_memo.php?invoiceID='+ invo, 'Import Memo',
                    'resizable=yes, width=' + '1200' + ', height=' + '700' + ', top='
                    + top + ', left=' + left);
                
  						  });
					}
				});

        $('#importReportDiv').show();

        /********* Set Information ************/

        $('#printSupAddress').hide();
        $('#printSupName').hide();

			}else if(supAddress != "" && supName != "" && date1 != "" && date2 != ""){
        
				$.ajax({
					url : "pirSelect2.php",
					type : "GET",
					data: { 
						'date1' : date1,
						'date2' : date2,
						'supName' : supName,
						'supAddress' : supAddress
					},
					success : function(data){
						$('table').html(data);
						$('.showInvo').on('click',function(){
						  var invo=$(this).data('id');
							var currentRow=$(this).closest("tr");
							var myWindow = window.open('purchase_memo.php?invoiceID='+ invo, 'Import Memo',
                    'resizable=yes, width=' + '1200' + ', height=' + '700' + ', top='
                    + top + ', left=' + left);
						  });
					}
				});

        $('#importReportDiv').show();

        /********* Set Information ************/

        $('#printSupAddress').show();
        $('#printSupName').show();  

        $('#printSupAddress').text("Address : "+supAddress);
        $('#printSupName').text("Name : "+supName);

			}else{
        swal("Please select valid information")
      }
	  });

	  


      /************ Update logger info **************/

      function updateUserStatus(){
        jQuery.ajax({
          url:'update_user_stats.php',
          success:function(){
            
          }
        });
      }

      $('#table').on('click','tbody tr',function(){
        if($(this).hasClass('active-row')){
          $(this).removeClass('active-row');
        }
        else
        {
          $(this).addClass('active-row');
        }
      });

   

      setInterval(function(){
        updateUserStatus();
      },3000);
	  

	</script>
  

</body>
</html>
