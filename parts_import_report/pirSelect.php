<?php
include('../DBconfig.php');

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$query = "SELECT `date`,`invoice_no`,`purchase_by`,`supplier_address`,`supplier_name`,TRUNCATE(SUM(`amount`),3) AS amount
          FROM `purchased_product` WHERE `date` BETWEEN '$date1' AND '$date2' GROUP BY `invoice_no`";
?>
<thead>
  <tr>
    <th>Date</th>
    <th>Invoice</th>
    <th>Purchase By</th>
    <th>Supplier address </th>
    <th>Supplier name</th>
    <th>Amount</th>

  </tr>
</thead>
<tbody>
  <?php
  $q = mysqli_query($con, $query);
  if (mysqli_num_rows($q) > 0) {
    $totalAmount = 0;
    while ($row = mysqli_fetch_assoc($q)) {
      $totalAmount += $row['amount'];
      $newDate = date("d-m-Y", strtotime($row["date"]));
  ?>

      <tr>
        <td class="text-nowrap"><?php echo $newDate; ?></td>
        <td class="showInvo" data-id=<?php echo $row["invoice_no"]; ?> >
          <a style="text-decoration:none;" href="#"><?php echo $row["invoice_no"]; ?></a>
        </td>
        <td><?php echo $row["purchase_by"]; ?></td>
        <td><?php echo $row["supplier_address"]; ?></td>
        <td class="text-nowrap"><?php echo $row["supplier_name"]; ?></td>
        <td><?php echo $row["amount"]; ?></td>
      </tr>
    <?php

    }
    ?>
    <tr>
      <td colspan="5" style="text-align:center;font-weight: bold;color:red;"> Total : </td>
      <td style="font-weight: bold;color:red;"><?php echo number_format($totalAmount, 3); ?> </td>
    </tr>
</tbody>
<?php

  } else {
?>
  <tr>
    <td colspan="6">No record found</td>

  </tr>
  </tbody>
<?php
  }

?>