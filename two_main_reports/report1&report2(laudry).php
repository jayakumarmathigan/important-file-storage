<?php
$jobid=[goutjobid];
$srcitem=[gitemsrc];
//$srcitem='GUEST';
//$jobid=7;

if($srcitem=='INHOUSE'){
	
	$val='';$value='';$amount=0;$amount1=0;$costrate=0;$qty=0;
	
	$dbsql="SELECT
tbl_lau_outjob_header.propid,
tbl_lau_outjob_header.outjobno,
DATE_FORMAT(tbl_lau_outjob_header.lauoutjobdate, '%d-%m-%Y') as lauoutjobdate,
DATE_FORMAT(tbl_lau_outjob_header.lauoutjobexpected_deliverydate, '%d-%m-%Y') as lauoutjobexpected_deliverydate,
tbl_lau_outjob_header.ref,
tbl_pos_vendormaster.vendorcmpname,
tbl_lau_items_header.itemsrc,
tbl_lau_items_process_issueqty.itemcosttype,
tbl_lau_items_process_issueqty.costrate,
tbl_lau_items_process_issueqty.qty,
tbl_pos_items.itmname
FROM
	tbl_lau_outjob_header
INNER JOIN tbl_lau_items_header ON tbl_lau_items_header.outjobid = tbl_lau_outjob_header.lauoutjobid and tbl_lau_items_header.propid=tbl_lau_outjob_header.propid
LEFT JOIN tbl_lau_items_process_issueqty ON tbl_lau_items_process_issueqty.lauproheaderid = tbl_lau_items_header.lauproheaderid
INNER JOIN tbl_pos_items ON tbl_pos_items.itmid = tbl_lau_items_process_issueqty.itemid
INNER JOIN tbl_pos_vendormaster ON tbl_pos_vendormaster.vendorid=tbl_lau_outjob_header.lauoutjobvendid
WHERE
	tbl_lau_outjob_header.lauoutjobid =".$jobid;
	
	sc_select(dbrs,$dbsql);
	$i=1;
	if($dbrs->recordcount() > 0){
	while(!$dbrs->EOF)
	{
		$amount1 = $dbrs->fields['qty'] * $dbrs->fields['costrate'];
		$amount+=$amount1;
		$qty+=$dbrs->fields['qty'];
		$costrate+=$dbrs->fields['costrate'];
	$val.='<tr>
				<td style="text-align:center;">'.$i.'</td>
				<td>'.$dbrs->fields['itmname'].'</td>
				<td>'.$dbrs->fields['itemcosttype'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['qty'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['costrate'].'</td>
				<td style="text-align:center;">'.$amount1.'</td>
			</tr>';
		$i++;
		
		$value='<div class="col-md-5">
		  <div>
			<h6><span style="margin-right:76px;font-weight:600;">Job No</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['outjobno'].'</span></h6>
			<h6><span style="margin-right:16px;font-weight:600;">Laundry Vendor</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['vendorcmpname'].'</span></h6>
			<h6><span style="margin-right:32px;font-weight:600;">Laundry Type</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['itemsrc'].'</span></h6>
		  </div>	
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-5">
		  <div style="float: right;">
			<h6><span style="margin-right:29px;font-weight:600;">Job Date</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['lauoutjobdate'].'</span></h6>
			<h6><span style="font-weight:600;">Delivery Date</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['lauoutjobexpected_deliverydate'].'</span></h6>
			<h6><span style="margin-right:22px;font-weight:600;">Reference</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['ref'].'</span></h6>
		  </div>	
		</div>';
		
	$dbrs->movenext();
	}	
		}
	
}elseif($srcitem=='GUEST'){
	
	$val='';$value='';$amount=0;$amount1=0;$costrate=0;$qty=0;
	
	$dbval="SELECT
tbl_lau_outjob_header.propid,
tbl_lau_outjob_header.outjobno,
DATE_FORMAT(tbl_lau_outjob_header.lauoutjobdate, '%d-%m-%Y') as lauoutjobdate,
DATE_FORMAT(tbl_lau_outjob_header.lauoutjobexpected_deliverydate, '%d-%m-%Y') as lauoutjobexpected_deliverydate,
tbl_lau_outjob_header.ref,
tbl_pos_vendormaster.vendorcmpname,
tbl_lau_items_header.itemsrc,
tbl_lau_items_process_issueqty.itemcosttype,
tbl_lau_items_process_issueqty.costrate,
tbl_lau_items_process_issueqty.qty,
check_room_trans.roomguestname,
room_master.roomno,
tbl_pos_items.itmname
FROM
	tbl_lau_outjob_header
INNER JOIN tbl_lau_items_header ON tbl_lau_items_header.outjobid = tbl_lau_outjob_header.lauoutjobid and tbl_lau_items_header.propid=tbl_lau_outjob_header.propid
LEFT JOIN tbl_lau_items_process_issueqty ON tbl_lau_items_process_issueqty.lauproheaderid = tbl_lau_items_header.lauproheaderid
INNER JOIN tbl_pos_items ON tbl_pos_items.itmid = tbl_lau_items_process_issueqty.itemid
INNER JOIN tbl_pos_vendormaster ON tbl_pos_vendormaster.vendorid=tbl_lau_outjob_header.lauoutjobvendid
INNER JOIN room_master on tbl_lau_items_header.roomid = room_master.roomid
INNER JOIN check_room_trans on check_room_trans.checkinroomtrnid = tbl_lau_items_header.checkroomtrnid
WHERE
	tbl_lau_outjob_header.lauoutjobid =".$jobid;
	
	sc_select(dbrs,$dbval);
	$i=1;$roomno=0;$j=0;
	if($dbrs->recordcount() > 0){
	while(!$dbrs->EOF)
	{
		
		//$amount = $dbrs->fields['qty'] * $dbrs->fields['costrate'];
		
		$roomno1 = $dbrs->fields['roomno'];
		if($roomno!=$roomno1 && $j==0){
			
		$amount1 = $dbrs->fields['qty'] * $dbrs->fields['costrate'];
		$amount+=$amount1;
		$qty+=$dbrs->fields['qty'];
		$costrate+=$dbrs->fields['costrate'];
			
			$val.='<table style="width:100%;">
			<tr style="background: gray;color: #fff;">
				<th>&nbsp;Room No&nbsp;:-&nbsp;</th>
				<th>&nbsp;'.$dbrs->fields['roomno'].'</th>
				<th>&nbsp;Guest Name&nbsp;:-&nbsp;</th>
				<th colspan="3">&nbsp;'.$dbrs->fields['roomguestname'].'</th>
			</tr>
			<tr>
				<th style="text-align:center;">S.No</th>
				<th style="width:40%;">Item Name</th>
				<th>Type</th>
				<th style="text-align:center;">Qty</th>
				<th style="text-align:center;">Rate</th>
				<th style="text-align:center;">Amount</th>
			</tr><tr>
				<td style="text-align:center;">'.$i.'</td>
				<td>'.$dbrs->fields['itmname'].'</td>
				<td>'.$dbrs->fields['itemcosttype'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['qty'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['costrate'].'</td>
				<td style="text-align:center;">'.$amount1.'</td>
			</tr>';
		}elseif($roomno!=$roomno1 && $j!=0){
			$i=1;
			//$amount1 = $dbrs->fields['qty'] * $dbrs->fields['costrate'];
		//$amount+=$amount1;
		//$qty+=$dbrs->fields['qty'];
		//$costrate+=$dbrs->fields['costrate'];
			$val.='<tr>
				<td></td>
				<td></td>
				<td style="font-weight:600;text-align: right;">Total</td>
				<td style="text-align:center;">'.$qty.'</td>
				<td style="text-align:center;">'.$costrate.'</td>
				<td style="text-align:center;">'.$amount.'</td>
			</tr></table><table style="width:100%;margin-top:20px;">
			<tr style="background: gray;color: #fff;">
				<th>&nbsp;Room No&nbsp;:-&nbsp;</th>
				<th>&nbsp;'.$dbrs->fields['roomno'].'</th>
				<th>&nbsp;Guest Name&nbsp;:-&nbsp;</th>
				<th colspan="3">&nbsp;'.$dbrs->fields['roomguestname'].'</th>
			</tr>
			<tr>
				<th style="text-align:center;">S.No</th>
				<th style="width:40%;">Item Name</th>
				<th>Type</th>
				<th style="text-align:center;">Qty</th>
				<th style="text-align:center;">Rate</th>
				<th style="text-align:center;">Amount</th>
			</tr><tr>
				<td style="text-align:center;">'.$i.'</td>
				<td>'.$dbrs->fields['itmname'].'</td>
				<td>'.$dbrs->fields['itemcosttype'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['qty'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['costrate'].'</td>
				<td style="text-align:center;">'.$amount1.'</td>
			</tr>';
			
			$amount1 = $dbrs->fields['qty'] * $dbrs->fields['costrate'];
			$amount=0;$qty=0;$costrate=0;
			$amount+=$amount1;
			$qty+=$dbrs->fields['qty'];
			$costrate+=$dbrs->fields['costrate'];
		}else{
			$amount1 = $dbrs->fields['qty'] * $dbrs->fields['costrate'];
		$amount+=$amount1;
		$qty+=$dbrs->fields['qty'];
		$costrate+=$dbrs->fields['costrate'];
			$val.='<tr>
				<td style="text-align:center;">'.$i.'</td>
				<td>'.$dbrs->fields['itmname'].'</td>
				<td>'.$dbrs->fields['itemcosttype'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['qty'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['costrate'].'</td>
				<td style="text-align:center;">'.$amount1.'</td>
			</tr>';
		}
			$roomno=$dbrs->fields['roomno'];$j=1;
			
		/*}else{
			
			$val.='<tr>
				<td style="text-align:center;">'.$i.'</td>
				<td>'.$dbrs->fields['itmname'].'</td>
				<td>'.$dbrs->fields['itemcosttype'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['qty'].'</td>
				<td style="text-align:center;">'.$dbrs->fields['costrate'].'</td>
				<td style="text-align:center;">'.$amount.'</td>
			</tr>';
			
			$roomno=$dbrs->fields['roomno'];
			
		}*/
		
		$value='<div class="col-md-5">
		  <div>
			<h6><span style="margin-right:76px;font-weight:600;">Job No</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['outjobno'].'</span></h6>
			<h6><span style="margin-right:16px;font-weight:600;">Laundry Vendor</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['vendorcmpname'].'</span></h6>
			<h6><span style="margin-right:32px;font-weight:600;">Laundry Type</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['itemsrc'].'</span></h6>
		  </div>	
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-5">
		  <div style="float: right;">
			<h6><span style="margin-right:29px;font-weight:600;">Job Date</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['lauoutjobdate'].'</span></h6>
			<h6><span style="font-weight:600;">Delivery Date</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['lauoutjobexpected_deliverydate'].'</span></h6>
			<h6><span style="margin-right:22px;font-weight:600;">Reference</span>&nbsp;:-&nbsp;&nbsp;&nbsp;<span id="span">'.$dbrs->fields['ref'].'</span></h6>
		  </div>	
		</div>';
		
		$i++;
	$dbrs->movenext();
	}
		}
	
}


echo '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Laundry Details</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style>
body{font-family: "Roboto", sans-serif;}
table,td,th{border:1px solid #000;}
table{border-collapse:collapse;}
td,th{padding:5px;}
td{font-size: 14px;}
#span{font-weight: 400;font-size: 14px;}
</style>
</head>
<body>
<div class="container">
	<h3 style="text-align:center;font-weight:bold;margin-top: 10px;margin-bottom: 0px;">RPR Residency</h3>
	<p style="text-align:center">Mylapore,Chennai-4</p>
	<h5 style="text-align:center;font-weight:600;font-size: 18px;">Laundry Issue Job</h5>
</div>
<br/><br/>
<div class="container">
	<div class="row">';
		echo $value;
	echo '</div>
</div>
<br/>';

if($srcitem=='GUEST'){
	
echo '<div class="container">';
	
	echo $val;
	
echo '<tr>
				<td></td>
				<td></td>
				<td style="font-weight:600;text-align: right;">Total</td>
				<td style="text-align:center;">'.$qty.'</td>
				<td style="text-align:center;">'.$costrate.'</td>
				<td style="text-align:center;">'.$amount.'</td>
			</tr></table></div>';
	
}elseif($srcitem=='INHOUSE'){
	
	echo '<div class="container">
	<table style="width:100%;">
		<thead>
			<tr>
				<th style="text-align:center;">S.No</th>
				<th style="width:40%;">Item Name</th>
				<th>Type</th>
				<th style="text-align:center;">Qty</th>
				<th style="text-align:center;">Rate</th>
				<th style="text-align:center;">Amount</th>
			</tr>
		</thead>
		<tbody>';
	
			echo $val;
	
	echo'<tr>
				<td></td>
				<td></td>
				<td style="font-weight:600;text-align: right;">Total</td>
				<td style="text-align:center;">'.$qty.'</td>
				<td style="text-align:center;">'.$costrate.'</td>
				<td style="text-align:center;">'.$amount.'</td>
			</tr>	</tbody>
	</table>
</div>';
	
}
echo '</body>
</html>';
?>