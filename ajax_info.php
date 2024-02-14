<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "invoice_itemsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "invoicesinfo.php" ?>
<?php include "userfn7.php" ?>

<?php
$currency = 'PhP&nbsp';
$conn = ew_Connect();
$clientid_ = $_GET['clientid'];
$invoiceid_ = $_GET['invoiceid'];

$date_today = date("Y-m-d");
		
		// get company info
		$csSql = "SELECT Company_Name, Main_Address, Contact_No, Email_Address, Website, TIN_No FROM company";
       $rswrk = $conn->Execute($csSql);
       $Company_Name = $rswrk->fields('Company_Name');
		$Main_Address = $rswrk->fields('Main_Address');
		$Contact_No = $rswrk->fields('Contact_No');
		$Email_Address = $rswrk->fields('Email_Address');
		$Website = $rswrk->fields('Website');
		$TIN_No = $rswrk->fields('TIN_No');
		
		//get accounts information
		$iSql = "SELECT id, Account_No, Client_Name, Address, Contact_No, Email_Address, TIN_No, Contact_Person FROM clients where id = " . $clientid_;
		$irswrk = $conn->Execute($iSql);
		$client_id = $irswrk->fields('id');
		$Account_No = $irswrk->fields('Account_No');
		$Client_Name = $irswrk->fields('Client_Name');
		$Client_Address = $irswrk->fields('Address');
		$Client_Contact_No = $irswrk->fields('Contact_No');
		$Client_Email_Address = $irswrk->fields('Email_Address');
		$Client_TIN_No = $irswrk->fields('TIN_No');
		$Client_Contact_Person = $irswrk->fields('Contact_Person');
		
		//GET invoice details
	$invSql = "SELECT i.id, i.Invoice_Number , c.Client_Name, i.Payment_Reference, i.Invoice_Date, i.Due_Date, s.Status as 'Payment_Status', 
ss.Status as 'Status', p.payment_period as 'Payment_Period' FROM invoices i INNER JOIN clients c ON (c.id = i.Client_ID) 
INNER JOIN statuses s ON (s.id = i.Payment_Status) INNER JOIN statuses ss ON (ss.id = i.Status) INNER JOIN client_payment_period p ON (p.id = i.Payment_Period) 
WHERE i.id = " . $invoiceid_;
     $invwrk = $conn->Execute($invSql);
		//$client_id = $invwrk->fields('id');
		$invoice_number = $invwrk->fields('Invoice_Number');
		$payment_reference = $invwrk->fields('Payment_Reference');
		$Due_Date = $invwrk->fields('Due_Date');
		$Invoice_Date = $invwrk->fields('Invoice_Date');
		$Payment_Status = $invwrk->fields('Payment_Status');
		$Status = $invwrk->fields('Status');
		$Payment_Period = $invwrk->fields('Payment_Period');
		
	
	$ppSql = "SELECT payment_period FROM client_payment_period where client_id = " . $clientid_ . " order by id limit 1";
    $ppswrk = $conn->Execute($ppSql);
	$Payment_Period = $ppswrk->fields('payment_period');
	
	if(isset($Payment_Period)){
		$Payment_Period = date("m/d/Y", strtotime($date_today . '	+ '. $Payment_Period .' days'));
	}else{
		$Payment_Period = "<span style='color:red; font-weight:bold;' >Warning: No payment period is set</span>";
	}

//get booking details
$bookSql = "SELECT i.id, i.invoice_id,`Booking ID`, b.`Booking Date`, b.`Booking Number`, b.`Date Delivered`, b.`Origin`, b.`Customer`, b.`Destination`, b.`Reference Number`, b.`Plate Number`, b.`Truck_Type`, b.`Freight`, b.`Remarks`, b.`Units`, b.`Quantity`,b.`Vat`, b.`WTax`, b.`Total_Sales`, b.`Total_Amount_Due`  FROM `invoice_items` i
INNER JOIN billinglist b ON (i.booking_id = b.`Booking ID`)
WHERE i.invoice_id = " . $invoiceid_;
	$booksWrk = $conn->Execute($bookSql);
		$bookWrk = $booksWrk->GetRows();	

function getExpenses($bookId){
	$conn = ew_Connect();
$cSql = "SELECT 
e.id as 'ID',  
e.Reference_No as 'Reference_No',
e.Description as 'Description',
e.Amount as 'Amount',
e.Remarks as 'Remarks',
e.Date_Created as 'Date_Created',
e.Vat as 'Vat',
e.Wtax as 'WTax',
e.Total_Sales as 'Total_Sales',
e.Total_Amount_Due as 'Total_Amount_Due',
e.Add_To_Billing as 'Add_To_Billing',
t.Expenses_Type as 'Expenses_Type'

FROM expenses e
INNER JOIN expenses_types t ON (t.id = e.Expenses_Type_ID)
WHERE e.Add_To_Billing = 'YES' AND e.Booking_ID = 
" . $bookId;

		$crswrk = $conn->Execute($cSql);
		$crwrk = $crswrk->GetRows();	
		return $crwrk;
}	

function getBanks($invoiceId){
	$conn = ew_Connect();
	$cSql = "SELECT i.id, i.Recipient_Bank,b.Bank_Name,b.Branch,b.Address,b.Account_Name,b.Account_Number,b.Account_Type
FROM invoices i INNER JOIN banks_accounts b ON (i.Recipient_Bank = b.id) WHERE i.id = " . $invoiceId;

		$crswrk = $conn->Execute($cSql);
		//$crwrk = $crswrk->GetRows();	
		return $crswrk;
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<link rel="stylesheet" type="text/css" href="yui280/build/button/assets/skins/sam/button.css">
<link rel="stylesheet" type="text/css" href="yui280/build/container/assets/skins/sam/container.css">
<link rel="stylesheet" type="text/css" href="yui280/build/autocomplete/assets/skins/sam/autocomplete.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>								
<script>
$(function(){
	
		
		window.print();
	
});
</script>

<div class="container-fluid" id="billingstatement" >
<div id="printinvoice" >
<div class="row">
	<div class="col-12">
		<div class="inv-header"><img src="./images/header_01.png" alt="Lights"> </div>
	</div>
</div>
<div class="row">
	<div class="col-12">
	<h4 class="uppercase">Billing Invoice</h4>
	</div>
</div>

<br />
	<div class="row">
		<div class="col-4">
			<p class="uppercase"><strong>Bill From:</strong></p>
			<p><strong><?php echo $Company_Name; ?></strong>
			<br />
			<strong>TIN No.: </strong><?php echo $TIN_No; ?>
			<br />
			<strong>Office Address: </strong><?php echo $Main_Address; ?>
			<br />
			<strong>Email Address: </strong><?php echo $Email_Address; ?>
			<br />
			<strong>Contact No:</strong> <?php echo $Contact_No; ?>
			<br />
			<strong>Website:</strong> <?php echo $Website; ?>
			</p>
		</div>
		<div class="col-4">
			<p class="uppercase"><strong>Bill To:</strong></p>
			<p><strong>Account Name: </strong><?php echo $Client_Name; ?>
			<br />
			<strong>Address:</strong> <?php echo $Client_Address; ?>
			<br />
			
			<strong>TIN No.:</strong><?php echo $Client_TIN_No; ?>
			<br />
		</div>
		<div class="col-4">
			<p><strong>Date: </strong><?php echo date("m/d/Y",strtotime($date_today)); ?>
			<br />
			<strong>Invoice No.: </strong><?php echo $invoice_number; ?>
			 <br />
			<strong>Payment Reference No.:</strong> <?php echo $payment_reference; ?>
			<br />
			<strong>Invoice Date:</strong> <?php echo  $Invoice_Date; ?>
			<br />
			<strong>Due Date:</strong> <?php echo  $Due_Date; ?>
			<br />
			<strong>Payment Status:</strong> <?php echo  $Payment_Status; ?>
			
		</div>
	</div>
	<div class="w3-horizontal-line"><hr /></div>
	<div class="row">
		<div class="col-12">
			<h4 class="uppercase">Details:	</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<table class="table table-striped" style="font-size:large">
				<thead>
					<tr>
					    <th>Booking No</th>
					  <th>Date</th>
					  <th>Delivered</th>
					  <th>Origin</th>
					  <th>Dest</th>
					  <th>Ref No/Description</th>
					  <th>Truck</th>
					   <th>Unit</th>
					  <th>Quantity</th>					 
					  <th>Freight</th>
						<!-- <th>Vat</th>
					  <th>WTax</th>
					  <th>Total Amount Due</th> -->
					  <th>Remarks</th>			  
					</tr>			
				</thead>
				<?php
			$tFreight = 0;
			$tQuantity = 0;
			$tVat = 0;
			$Wtax = 0;
			$tWtax = 0;
			$tTotal_Sales = 0;
			$tTotal_Amount_Due = 0;
					if(count($bookWrk)>0){
			
		for( $i= 0; $i< count($bookWrk); $i++){
			$bookId = $bookWrk[$i]['Booking ID'];
		    $Booking_Number = $bookWrk[$i]['Booking Number'];
		   $Booking_Date = $bookWrk[$i]['Booking Date'];
            $Date_Delivered = $bookWrk[$i]['Date Delivered'];
			$Origin = $bookWrk[$i]['Origin'];
			$Destination = $bookWrk[$i]['Destination'];
		$Reference_Number = $bookWrk[$i]['Reference Number'];
			$Units = $bookWrk[$i]['Units'];
				$Freight = $bookWrk[$i]['Freight'];
				$tFreight +=  $Freight;
				$Quantity = $bookWrk[$i]['Quantity'];
				$tQuantity += $Quantity;
				$Vat = $bookWrk[$i]['Vat'];
				$tVat += $Vat;
			$Wtax = $bookWrk[$i]['Wtax'];
			$tWtax += $Wtax;
			$Total_Sales = $bookWrk[$i]['Total_Sales'];
			$tTotal_Sales += $Total_Sales;
			$Total_Amount_Due = $bookWrk[$i]['Total_Amount_Due']; 
			$tTotal_Amount_Due += $Total_Amount_Due;
			$Remarks = $bookWrk[$i]['Remarks'];
			$Plate_Number = $bookWrk[$i]['Plate Number'];
			$Truck_Type = $bookWrk[$i]['Truck_Type'];
		    ?>
				<tr>
				    <td><?php echo $Booking_Number; ?></td>
				    <td><?php echo $Booking_Date; ?></td>
				    <td><?php echo $Date_Delivered; ?></td>
					<td><?php echo $Origin; ?></td>
					<td><?php echo $Destination; ?></td>
				    <td><?php echo $Reference_Number; ?></td>
					<td><?php echo $Truck_Type . "<br />" . $Plate_Number; ?></td>
					<td><?php echo $Units; ?></td>
				    <td><?php echo number_format($Quantity, 2, '.',','); ?></td>
				    
				    <td><?php echo number_format($Freight, 2, '.',','); ?></td>
				  <!--  <td><?php echo number_format($Vat, 2, '.',','); ?></td>
				    <td><?php echo  number_format($Wtax, 2, '.',','); ?></td>
				    <td><?php echo  number_format($Total_Amount_Due, 2, '.',','); ?></td> -->
				    <td><?php echo  $Remarks; ?></td>
				    
				</tr>
				<?php
				//get expenses
				$exp = getExpenses($bookId);
				
				if(count($exp)>0){			
					for( $x= 0; $x< count($exp); $x++){
						
						$Reference_No = $exp[$x]['Reference_No'];
						$Description = $exp[$x]['Description'];
						$Amount = $exp[$x]['Amount'];
						$Vat = $exp[$x]['Vat'];
						$tVat += $Vat;
						$Wtax = $exp[$x]['WTax'];
					$tWtax += $Wtax;
					$Total_Sales = $exp[$x]['Total_Sales'];
					$tTotal_Sales += $Total_Sales;
						$Total_Amount_Due = $exp[$x]['Total_Amount_Due'];
						$tFreight += $Amount;
						$tTotal_Amount_Due +=  $Total_Amount_Due;
						$Remarks = $exp[$x]['Remarks']; 
						
					?>
					<tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
					 <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    <td><?php echo $Description . "/" . $Reference_No; ?></td>
					<td>&nbsp;</td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>

					<td><?php echo  number_format($Amount, 2, '.',','); ?></td>
				    <!-- <td><?php echo number_format($Vat, 2, '.',','); ?></td>
				    <td><?php echo  number_format($Wtax, 2, '.',','); ?></td>-->
				    
				    <td><?php echo  $Remarks; ?></td>
				    
				</tr>
			<?php	
					}
				}
				?>
			<?php
		}
		}
			?>
			<tr>
				<td colspan='8' style='text-align:right'>TOTAL</td>
				
				<td><?php echo  number_format($tQuantity, 2, '.',','); ?></td>
				<td><?php echo  number_format($tFreight, 2, '.',','); ?></td>
				<!-- <td><?php echo  $currency . number_format($tVat, 2, '.',','); ?></td>
				<td><?php echo  $currency . number_format($tWtax, 2, '.',','); ?></td>
				<td><?php echo  $currency . number_format($tTotal_Amount_Due, 2, '.',','); ?></td>-->
				<td><!--Remarks-->&nbsp;</td>
			</tr>
		 </table>
		 
    </div>
    </div>
	
	<div class="container pt-6" style="font-weight:bold;">
			<div class="row ">
				<div class="col-2">&nbsp;</div>
				<div class="col-8 text-end">TOTAL FREIGHT:</div>
				<div class="col-2"><?php echo  $currency .  number_format($tFreight, 2, '.',','); ?></div>
				<div class="col-2">&nbsp;</div>
				<div class="col-8 text-end">PLUS VAT 12%:</div>
				<div class="col-2"><?php echo  $currency . number_format($tVat, 2, '.',','); ?></div>
				<div class="col-2">&nbsp;</div>
				<div class="col-8 text-end">TOTAL SALES:</div>
				<div class="col-2"><?php echo  $currency . number_format($tFreight + $tVat, 2, '.',','); ?></div>
				<div class="col-2">&nbsp;</div>
				<div class="col-8 text-end">LESS WTAX 2%:</div>
				<div class="col-2"><?php echo  $currency . number_format($tWtax, 2, '.',','); ?></div>
				<div class="col-2">&nbsp;</div>
				<div class="col-8">&nbsp;</div>
				<div class="col-2"><hr></div>
				<div class="col-2">&nbsp;</div>
				<div class="col-8 text-end">TOTAL AMOUNT DUE:</div>
				<div class="col-2"><?php echo  $currency . number_format($tTotal_Amount_Due, 2, '.',','); ?></div>
				</div>
			</div>
  
   <hr />
		<div class="container pt-6">
		
			<div class="row ">
				<div class="col-3">Prepared by: <?php echo CurrentUserName(); ?> </div>
				<div class="col-3">Date: <?php echo date("m/d/Y",strtotime($date_today)); ?></div>
				<div class="col-3 text-end">Payment Options:</div>
				<div class="col-3">Cash/Check/Bank Transfer</div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end"><em><strong>BANK DETAILS</strong></em></div>
				<div class="col-3">&nbsp;</div>
				<div class="col-3">Approved by: <?php echo CurrentUserName(); ?></div>
				<div class="col-3">Date: <?php echo date("m/d/Y",strtotime($date_today)); ?></div>
				<?php 
				//banks_accounts
				$bnk = getBanks($invoiceid_);
				$Bank_Name = $bnk->fields('Bank_Name');
				$Account_Name = $bnk->fields('Account_Name');
				$Account_Number = $bnk->fields('Account_Number');
				$Account_Type = $bnk->fields('Account_Type');
				$Branch = $bnk->fields('Branch');
				?>
				<div class="col-3 text-end">Account Name:</div>
				<div class="col-3"><?php echo $Account_Name; ?></div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">Account No.:</div>
				<div class="col-3"><?php echo $Account_Number; ?></div>
				<div class="col-3">Received by:</div>
				<div class="col-3">Date:</div>
				<div class="col-3 text-end">Account Type:</div>
				<div class="col-3"><?php echo $Account_Type; ?></div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">Bank Name: </div>
				<div class="col-3"><?php echo $Bank_Name; ?></div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">Bank Branch:</div>
				<div class="col-3"><?php echo $Branch; ?></div>
			</div>
			
		</div>
			
		
</div>		
</div>		
	<!--test-->