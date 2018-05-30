<?php
$fromdate='01/05/2018';
$todate='30/05/2018';
$vendorid='6';

// changing date format
$date = str_replace('/', '-', $fromdate);
$date1 = str_replace('/', '-', $todate);
$from1 = date('Y-m-d', strtotime($date));
$to1 = date('Y-m-d', strtotime($date1));
$date3 = new DateTime($from1); //inclusive
$date4 = new DateTime($to1); //exclusive
$diff = $date4->diff($date3);
$diff1 = $diff->format("%a"); //difference in number
$start_date=$from1;
$end_date=$to1;

//initialising values
$value='';$value1='';$value2='';$head_date='';$body_date='';$j=0;
$tot_date_item_qty=0;$tot_date_item_cost=0;$tot_date_amount=0;
$overall_qty=0;$overall_cost=0;$overall_amount=0;
$quan='';
//$cos='';$amoun='';
$value2='<h6><span style="margin-right:24px;font-weight:600;">To Date</span>&nbsp;:-&nbsp;<span id="span">'.$date1.'</span></h6>';//to date


$dbsql="select vendorcmpname from tbl_pos_vendormaster where vendorid=".$vendorid;
sc_select(dbrs,$dbsql);
$value='<h6><span style="font-weight:600;">Laundry Vendor</span>&nbsp;:-&nbsp;&nbsp;<span id="span">'.$dbrs->fields['vendorcmpname'].'</span></h6>';//vendor name
$value1='<span id="span">'.$date.'</span>';//from date

$dbsql5="select sum(tbl_lau_items_process_issueqty.qty) qty,sum(tbl_lau_items_process_issueqty.costrate) cost from tbl_lau_outjob_header INNER JOIN tbl_lau_items_header ON tbl_lau_items_header.outjobid = tbl_lau_outjob_header.lauoutjobid and tbl_lau_items_header.propid=tbl_lau_outjob_header.propid
LEFT JOIN tbl_lau_items_process_issueqty ON tbl_lau_items_process_issueqty.lauproheaderid = tbl_lau_items_header.lauproheaderid
INNER JOIN tbl_pos_items ON tbl_pos_items.itmid = tbl_lau_items_process_issueqty.itemid
INNER JOIN tbl_pos_vendormaster ON tbl_pos_vendormaster.vendorid=tbl_lau_outjob_header.lauoutjobvendid
WHERE
	tbl_pos_vendormaster.vendorid ='6' and date(tbl_lau_outjob_header.lauoutjobdate) between '".$from1."' and '".$to1."'";

sc_select(dvrs,$dbsql5);

$overall_qty = $dvrs->fields['qty'];//total qty
$overall_cost = $dvrs->fields['cost'];//total cost
$overall_amount = $overall_qty * $overall_cost;//total amount

//query to find total items available
$dbsql1="select tbl_pos_items.itmid,tbl_pos_items.itmname from tbl_lau_outjob_header INNER JOIN tbl_lau_items_header ON tbl_lau_items_header.outjobid = tbl_lau_outjob_header.lauoutjobid and tbl_lau_items_header.propid=tbl_lau_outjob_header.propid
LEFT JOIN tbl_lau_items_process_issueqty ON tbl_lau_items_process_issueqty.lauproheaderid = tbl_lau_items_header.lauproheaderid
INNER JOIN tbl_pos_items ON tbl_pos_items.itmid = tbl_lau_items_process_issueqty.itemid GROUP BY tbl_pos_items.itmid";

sc_select(dvsq,$dbsql1);

$quan.='<td></td>';

while(!$dvsq->EOF){
	
	$item_id=$dvsq->fields['itmid'];
	$item_val_name=$dvsq->fields['itmname'];
	$body_date.='<tr>
				<td class="font1">'.$dvsq->fields['itmname'].'</td>';
	
	//query to find total qty and cost for single row total dates
	$dbsql2="select sum(tbl_lau_items_process_issueqty.qty) qty,sum(tbl_lau_items_process_issueqty.costrate) cost from tbl_lau_outjob_header INNER JOIN tbl_lau_items_header ON tbl_lau_items_header.outjobid = tbl_lau_outjob_header.lauoutjobid and tbl_lau_items_header.propid=tbl_lau_outjob_header.propid
LEFT JOIN tbl_lau_items_process_issueqty ON tbl_lau_items_process_issueqty.lauproheaderid = tbl_lau_items_header.lauproheaderid
INNER JOIN tbl_pos_items ON tbl_pos_items.itmid = tbl_lau_items_process_issueqty.itemid
INNER JOIN tbl_pos_vendormaster ON tbl_pos_vendormaster.vendorid=tbl_lau_outjob_header.lauoutjobvendid
WHERE
	tbl_pos_vendormaster.vendorid ='".$vendorid."' and date(tbl_lau_outjob_header.lauoutjobdate) between '".$from1."' and '".$to1."' and tbl_pos_items.itmid=".$item_id;
	
	sc_select(dsqrvs,$dbsql2);
	
	//echo '<br><br>'.$dbsql2.'<br><br>';
	
	$tot_date_item_qty=$dsqrvs->fields['qty'];//row end qty
	$tot_date_item_cost=$dsqrvs->fields['cost'];//row end cost
	$tot_date_amount=$tot_date_item_qty * $tot_date_item_cost;//row end amount
	
	//echo $tot_date_item_qty;
	
	//$overall_qty=$overall_qty + $dsqrvs->fields['qty'];//total qty
	//$overall_cost+=$tot_date_item_cost;//total cost
	//$overall_amount+=$tot_date_amount;//total amount
	
	//echo $overall_qty;
	
	while (strtotime($start_date) <= strtotime($end_date)) {
		
		if($j==0){
			$start=strtotime($start_date);
			$start_from = date('j M ', $start);
			$head_date.='<th class="font" style="text-align:center;">'.$start_from.'</th>';
			//echo $head_date;
			if(strtotime($start_date) < strtotime($end_date)){
					$quan.='<td></td>';
				}else{
					$quan.='<td class="font2" style="text-align:right;font-weight:600;">Tot</td>';
			}
		}
		
		//query to find sum of qty for a single date
	$dbsql3="select tbl_pos_items.itmname,sum(tbl_lau_items_process_issueqty.qty) qty from tbl_lau_outjob_header INNER JOIN tbl_lau_items_header ON tbl_lau_items_header.outjobid = tbl_lau_outjob_header.lauoutjobid and tbl_lau_items_header.propid=tbl_lau_outjob_header.propid
LEFT JOIN tbl_lau_items_process_issueqty ON tbl_lau_items_process_issueqty.lauproheaderid = tbl_lau_items_header.lauproheaderid
INNER JOIN tbl_pos_items ON tbl_pos_items.itmid = tbl_lau_items_process_issueqty.itemid
INNER JOIN tbl_pos_vendormaster ON tbl_pos_vendormaster.vendorid=tbl_lau_outjob_header.lauoutjobvendid
WHERE
	tbl_pos_vendormaster.vendorid ='".$vendorid."' and date(tbl_lau_outjob_header.lauoutjobdate)='".$start_date."' and tbl_pos_items.itmid=".$item_id;

	sc_select(dsqr,$dbsql3);
		
		//echo '<br><br>'.$dbsql3.'<br><br>';

		$body_date.='
				<td class="font2" style="text-align:center;">'.$dsqr->fields['qty'].'</td>';


		$start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
	}
	$body_date.='<td class="font2" style="text-align:center;">'.$tot_date_item_qty.'</td>
				<td class="font2" style="text-align:center;">'.$tot_date_item_cost.'</td>
				<td class="font2" style="text-align:center;">'.$tot_date_amount.'</td>
			</tr>';
	if($j==0){
		$quan.='<td class="font2" style="text-align:center;font-weight:600;">'.$overall_qty.'</td>
				<td class="font2" style="text-align:center;font-weight:600;">'.$overall_cost.'</td>
				<td class="font2" style="text-align:center;font-weight:600;">'.$overall_amount.'</td>';
	}
	$start_date=$from1;$end_date=$to1;$j=1;
	$dvsq->movenext();
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
.font{font-size:10px;}
.font1{font-size:10px;}
.font2{font-size:12px;}
</style>
<style type="text/css" media="print">
@page
{
	size: landscape;
	margin: 2cm;
}
</style>
</head>
<body>
<div class="container">
	<h3 style="text-align:center;font-weight:bold;margin-top: 10px;margin-bottom: 0px;">RPR Residency</h3>
	<p style="text-align:center">Mylapore,Chennai-4</p>
	<h5 style="text-align:center;font-weight:600;font-size: 18px;">Laundry Issue Job</h5>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-5">
			<div>
			<h6></h6>'
	.$value.'		
			</div>
		</div>
		<div class="col-md-2"></div>
		<div class="col-md-5">
		  <div style="float: right;">
			<h6><span style="margin-right:5px;font-weight:600;">From Date</span>&nbsp;:-&nbsp;'.$value1.'</h6>
			'.$value2.'
		</div>
		</div>
	</div>

	<table style="width:100%;">
		<thead>
			<tr style="background:darkgrey;color:#fff;">
				<th class="font" style="text-align:left;">Item Name</th>
				'.$head_date.'
				<th class="font" style="text-align:center;">Qty</th>
				<th class="font" style="text-align:center;">Rate</th>
				<th class="font" style="text-align:center;">Amt</th>
			</tr>
		</thead>
		<tbody>
			'.$body_date.'
			<tr>
				'.$quan.'
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>';
?>