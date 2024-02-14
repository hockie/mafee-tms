<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "bookingsinfo.php" ?>
<?php include "clientsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$bookings_view = new cbookings_view();
$Page =& $bookings_view;

// Page init
$bookings_view->Page_Init();

// Page main
$bookings_view->Page_Main();
?>
<?php include "header.php" ?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php if ($bookings->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var bookings_view = new ew_Page("bookings_view");

// page properties
bookings_view.PageID = "view"; // page ID
bookings_view.FormID = "fbookingsview"; // form ID
var EW_PAGE_ID = bookings_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
bookings_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
bookings_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
bookings_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $bookings->TableCaption() ?>
<br><br>
<?php if ($bookings->Export == "") { ?>
<a href="<?php echo $bookings_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $bookings_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $bookings_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $bookings_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('file_uploads')) { ?>
<a href="file_uploadslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=bookings&id=<?php echo urlencode(strval($bookings->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("file_uploads", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('expenses')) { ?>
<a href="expenseslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=bookings&id=<?php echo urlencode(strval($bookings->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("expenses", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('booking_helpers')) { ?>
<a href="booking_helperslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=bookings&id=<?php echo urlencode(strval($bookings->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("booking_helpers", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
<a href="#" id="topdf"> Save to PDF </a>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$bookings_view->ShowMessage();
?>
<?php
//Billing Invoice start
?>
<?php 
		$date_today = date("Y-m-d");
		
		// get company info
		$sSql = "SELECT Company_Name, Main_Address, Contact_No, Email_Address, Website, TIN_No FROM company";
        $rswrk = $conn->Execute($sSql);
        $Company_Name = $rswrk->fields('Company_Name');
		$Main_Address = $rswrk->fields('Main_Address');
		$Contact_No = $rswrk->fields('Contact_No');
		$Email_Address = $rswrk->fields('Email_Address');
		$Website = $rswrk->fields('Website');
		$TIN_No = $rswrk->fields('TIN_No');
		
		//get accounts information
		$iSql = "SELECT id, Account_No, Client_Name, Address, Contact_No, Email_Address, TIN_No, Contact_Person FROM clients where id = " . $bookings->Client_ID->CurrentValue ;
		$irswrk = $conn->Execute($iSql);
		$client_id = $irswrk->fields('id');
		$Account_No = $irswrk->fields('Account_No');
		$Client_Name = $irswrk->fields('Client_Name');
		$Client_Address = $irswrk->fields('Address');
		$Client_Contact_No = $irswrk->fields('Contact_No');
		$Client_Email_Address = $irswrk->fields('Email_Address');
		$Client_TIN_No = $irswrk->fields('TIN_No');
		$Client_Contact_Person = $irswrk->fields('Contact_Person');
		
		//get billing list
		$bSql = "SELECT `Booking ID`, `Booking Date`, `Booking Number`, `Date Delivered`, `Origin`, `Customer`, `Destination`, `Reference Number`, `Plate Number`, `Truck_Type`, `Freight`, `Remarks`  FROM billinglist where `Booking ID` = " . $bookings->id->CurrentValue ;
		$brswrk = $conn->Execute($bSql);
		$booking_id = $brswrk->fields('Booking ID');
		
	
		//Expenses naman! nice.
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
" . $bookings->id->CurrentValue ;

		$crswrk = $conn->Execute($cSql);
		$crwrk = $crswrk->GetRows();		

	// get payment period
	$ppSql = "SELECT payment_period FROM client_payment_period where client_id = " . $bookings->Client_ID->CurrentValue . " order by id limit 1";
    $ppswrk = $conn->Execute($ppSql);
	$Payment_Period = $ppswrk->fields('payment_period');
	
	if(isset($Payment_Period)){
		$Payment_Period = date("m/d/Y", strtotime($date_today . '	+ '. $Payment_Period .' days'));
	}else{
		$Payment_Period = "<span style='color:red; font-weight:bold;' >Warning: No payment period is set</span>";
	}
			
		
?>
<div class="container fs-6" id="billingstatement">
<img src="./images/header_01.png" alt="Lights" style="width:100%">
<br />
<h2 class="uppercase">Billing Invoice</h2>
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
			<p><strong>Account Name: </strong><?php echo $bookings->Client_ID->ViewValue ?>
			<br />
			<strong>Address:</strong> <?php echo $Client_Address; ?>
			<br />
			<strong>Contact No.: </strong><?php echo $Client_Contact_No; ?>
			<br />
			<strong>Contact Person: </strong><?php echo $Client_Contact_Person; ?>
			<br />
			<strong>TIN No.:</strong><?php echo $Client_TIN_No; ?>
			<br />
		</div>
 
		<div class="col-4">
			<p><strong>Date: </strong><?php echo date("m/d/Y",strtotime($date_today)); ?>
			<br />
			<strong>Invoice No.: </strong>INV-<?php echo date("mdY",strtotime($date_today)); ?>-<?php echo $bookings->id->ViewValue; ?></strong>
			 <br />
			<strong>Booking No.:</strong> <?php echo $bookings->Booking_Number->ViewValue ?>
			<br />
			<strong>Due Date:</strong> <?php echo  $Payment_Period; ?>
			<br />
			<strong>Origin:</strong> <?php echo $bookings->Origin_ID->ViewValue ?>
			<br />
			<strong>Destination:</strong> <?php echo $bookings->Origin_ID->ViewValue ?>
			<br />
			<strong>Consignee:</strong> <?php echo $bookings->Customer_ID->ViewValue; ?>
			<br />
			<strong>Status:</strong> <?php echo $bookings->Status_ID->ViewValue ?></p>
		</div>
	</div>
	
	<div class="w3-horizontal-line"><hr /></div>
	<div class="row">
		<div class="col">
			<h3 class="uppercase">Details:	</h3>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<table class="table"> 
				<thead class="table-secondary">
					<tr>
					  <th>Booking Date</th>
					  <th>Date Delivered</th>
					  <th>Ref No./Description</th>
					  <th>Quantity</th>
					  <th>Unit</th>
					  <th>Freight</th>
						<th>Vat</th>
					  <th>WTax</th>
					  <th>Total Amount Due</th>
					  <th>Remarks</th>			  
					</tr>			
				</thead>
				<tr>
					<td><?php echo $bookings->Date->ViewValue ?></td>
					<td><?php echo $bookings->Date_Delivered->ViewValue ?></td>
					<td><?php echo $bookings->Doc_Reference_Number->ViewValue ?></td>
					<td><?php echo $bookings->Quantity->ViewValue ?></td>
					<td><?php echo $bookings->Unit_ID->ViewValue ?></td>
					<td>P<?php echo $bookings->Freight->ViewValue ?></td>
					<td>P<?php echo $bookings->Vat->ViewValue ?></td>
					<td>P<?php echo $bookings->Wtax->ViewValue ?></td>
					<td>P<?php echo $bookings->Total_Amount_Due->ViewValue ?></td>
					<td>&nbsp;</td><!-- Remarks -->
				</tr>
		<?php
		//get total
		$tfreight = $bookings->Freight->CurrentValue;
		$tVat = $bookings->Vat->CurrentValue;
		$tWtax_ = $bookings->Wtax->CurrentValue;
		$tTotal_Amount_Due = $bookings->Total_Amount_Due->CurrentValue;
		//$tfreight = $bookings->Freight->ViewValue;
		$tGT =0;

		if(count($crwrk)>0){
			
		for( $i= 0; $i< count($crwrk); $i++){
			
			$Description = $crwrk[$i]['Description'];
			$Amount = $crwrk[$i]['Amount'];
			$Vat = $crwrk[$i]['Vat'];
			$Wtax = $crwrk[$i]['WTax'];
			$Total_Amount_Due = $crwrk[$i]['Total_Amount_Due'];
			$Remarks = $crwrk[$i]['Remarks']; 
			
			//sum it all
			$tfreight += $Amount;
			$tVat += $Vat;
			$tWtax_ += $Wtax;
			$tTotal_Amount_Due += $Total_Amount_Due;
			$tGT = $tfreight+$tVat+$tWtax_+$tTotal_Amount_Due;

		?>	
			<tr>
				
				<td>&nbsp;</td> <!-- Date -->
				<td>&nbsp;</td><!-- Date Delivered-->
				<td><?php echo $Description; ?></td>		
				<td>&nbsp;</td><!-- Quantity -->
				<td>&nbsp;</td><!-- Unit ID -->
				<td>P<?php echo number_format($Amount, 2, '.',','); ?></td>
				<td>P<?php echo number_format($Vat, 2, '.',','); ?></td>
				<td>P<?php echo number_format($Wtax, 2, '.',','); ?></td>
				<td>P<?php echo number_format($Total_Amount_Due, 2, '.',','); ?></td>
				<td><?php echo $Remarks; ?></td>
			</tr>
			<?php
			}
			}
			?>
			<tr>
			<td colspan=10>&nbsp;</td>
			</tr>
			<tr class="table-secondary">
			<?php

			$tfreight = number_format($tfreight, 2, '.',',');
			$tVat = number_format($tVat, 2, '.',',');
			$tWtax_ = number_format($tWtax_, 2, '.',',');
			$tTotal_Amount_Due = number_format($tTotal_Amount_Due, 2, '.',',');

			//$tGT = $tfreight+$tVat+$tWtax_+$tTotal_Amount_Due;
			$tGT = number_format($tGT, 2, '.',',');

			?>
					<td>&nbsp;</td> <!-- Date -->
					<td>&nbsp;</td><!-- Date Delivered-->
					<td>&nbsp;</td><!-- Description -->
					<td>&nbsp;</td><!-- Quantity -->
					<td>TOTAL:</td>
					<td>P<?php echo $tfreight; ?></td>
					<td>P<?php echo $tVat; ?></td>
					<td>P<?php echo $tWtax_; //number_format($WTax, 2, '.',','); ?></td>
					<td>P<?php echo $tTotal_Amount_Due; //number_format($Total_Amount_Due, 2, '.',','); ?></td>
					<td>&nbsp;</td>
			</tr>
			</table>
			
		<div class="container pt-5">
			<div class="row ">
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">TOTAL FREIGHT:</div>
				<div class="col-3"> P<?php echo $tfreight; ?></div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">PLUS VAT 12%:</div>
				<div class="col-3"> P<?php echo $tVat; ?></div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">LESS WTAX 2%:</div>
				<div class="col-3"> P<?php echo $tWtax_;?></div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">TOTAL AMOUNT DUE:</div>
				<div class="col-3">P<?php echo $tTotal_Amount_Due; ?></div>
				</div>
			</div>
		
		<div class="container pt-5">
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
				<div class="col-3 text-end">Account Name:</div>
				<div class="col-3">MAFEE LOGISTICS INC.</div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">Account No.:</div>
				<div class="col-3">137500013260</div>
				<div class="col-3">Received by:</div>
				<div class="col-3">Date:</div>
				<div class="col-3 text-end">Account Type:</div>
				<div class="col-3">Checking</div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">Bank Name: </div>
				<div class="col-3">Chinabank</div>
				<div class="col-6">&nbsp;</div>
				<div class="col-3 text-end">Bank Branch:</div>
				<div class="col-3">Cavite - Molino</div>
			</div>
		</div>
			</div>
		</div>
		<div class="row">
				<div class="col-12">
					<hr />
				</div>
		</div>
		<div class="text-center">
			<div class="row">
				<div class="col-12">
					<hr />
					<p>THANK YOU FOR YOUR BUSINESS!</p>
				</div>
			</div>
		</div>
		<div class="text-center">
			<div class="row">
				<div class="col-12">
					<hr />
					<p>Mafee Transport Management System V.1.0</p>
				</div>
			</div>
		</div>
		
	</div>
<hr />

<p>
<?php if ($bookings->Export == "") { ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script language="JavaScript" type="text/javascript">
$(function(){
	
	$("#topdf").on("click", function(){
		//alert('pdf');
		html2canvas($('#billingstatement')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("INV-<?php echo $bookings->Booking_Number->ViewValue; ?>.pdf");
                }
            }); 
});
});
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>

<?php } ?>
<?php include "footer.php" ?>
<?php
$bookings_view->Page_Terminate();
?>


<?php

//
// Page class
//
class cbookings_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'bookings';

	// Page object name
	var $PageObjName = 'bookings_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $bookings;
		if ($bookings->UseTokenInUrl) $PageUrl .= "t=" . $bookings->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $bookings;
		if ($bookings->UseTokenInUrl) {
			if ($objForm)
				return ($bookings->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($bookings->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbookings_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (bookings)
		$GLOBALS["bookings"] = new cbookings();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'bookings', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $bookings;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("bookingslist.php");
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $bookings;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$bookings->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $bookings->id->QueryStringValue;
			} else {
				$sReturnUrl = "bookingslist.php"; // Return to list
			}

			// Get action
			$bookings->CurrentAction = "I"; // Display form
			switch ($bookings->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "bookingslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "bookingslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$bookings->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $bookings;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$bookings->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$bookings->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $bookings->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$bookings->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$bookings->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$bookings->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $bookings;
		$sFilter = $bookings->KeyFilter();

		// Call Row Selecting event
		$bookings->Row_Selecting($sFilter);

		// Load SQL based on filter
		$bookings->CurrentFilter = $sFilter;
		$sSql = $bookings->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$bookings->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $bookings;
		$bookings->id->setDbValue($rs->fields('id'));
		$bookings->Booking_Number->setDbValue($rs->fields('Booking_Number'));
		$bookings->Date->setDbValue($rs->fields('Date'));
		$bookings->Client_ID->setDbValue($rs->fields('Client_ID'));
		$bookings->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$bookings->Customer_ID->setDbValue($rs->fields('Customer_ID'));
		$bookings->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$bookings->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$bookings->Truck_ID->setDbValue($rs->fields('Truck_ID'));
		$bookings->ETD->setDbValue($rs->fields('ETD'));
		$bookings->ETA->setDbValue($rs->fields('ETA'));
		$bookings->Billing_Type_ID->setDbValue($rs->fields('Billing_Type_ID'));
		$bookings->Doc_Reference_Number->setDbValue($rs->fields('Doc_Reference_Number'));
		$bookings->Truck_Driver_ID->setDbValue($rs->fields('Truck_Driver_ID'));
		$bookings->Status_ID->setDbValue($rs->fields('Status_ID'));
		$bookings->Unit_ID->setDbValue($rs->fields('Unit_ID'));
		$bookings->Quantity->setDbValue($rs->fields('Quantity'));
		$bookings->Freight->setDbValue($rs->fields('Freight'));
		$bookings->Vat->setDbValue($rs->fields('Vat'));
		$bookings->Total_Sales->setDbValue($rs->fields('Total_Sales'));
		$bookings->Wtax->setDbValue($rs->fields('Wtax'));
		$bookings->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$bookings->Date_Delivered->setDbValue($rs->fields('Date_Delivered'));
		$bookings->Date_Updated->setDbValue($rs->fields('Date_Updated'));
		$bookings->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $bookings;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($bookings->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($bookings->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($bookings->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($bookings->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($bookings->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($bookings->id->CurrentValue);
		$this->AddUrl = $bookings->AddUrl();
		$this->EditUrl = $bookings->EditUrl();
		$this->CopyUrl = $bookings->CopyUrl();
		$this->DeleteUrl = $bookings->DeleteUrl();
		$this->ListUrl = "./accounts_receivablelist.php";//$bookings->ListUrl();

		// Call Row_Rendering event
		$bookings->Row_Rendering();

		// Common render codes for all row types
		// id

		$bookings->id->CellCssStyle = ""; $bookings->id->CellCssClass = "";
		$bookings->id->CellAttrs = array(); $bookings->id->ViewAttrs = array(); $bookings->id->EditAttrs = array();

		// Booking_Number
		$bookings->Booking_Number->CellCssStyle = ""; $bookings->Booking_Number->CellCssClass = "";
		$bookings->Booking_Number->CellAttrs = array(); $bookings->Booking_Number->ViewAttrs = array(); $bookings->Booking_Number->EditAttrs = array();

		// Date
		$bookings->Date->CellCssStyle = ""; $bookings->Date->CellCssClass = "";
		$bookings->Date->CellAttrs = array(); $bookings->Date->ViewAttrs = array(); $bookings->Date->EditAttrs = array();

		// Client_ID
		$bookings->Client_ID->CellCssStyle = ""; $bookings->Client_ID->CellCssClass = "";
		$bookings->Client_ID->CellAttrs = array(); $bookings->Client_ID->ViewAttrs = array(); $bookings->Client_ID->EditAttrs = array();

		// Origin_ID
		$bookings->Origin_ID->CellCssStyle = ""; $bookings->Origin_ID->CellCssClass = "";
		$bookings->Origin_ID->CellAttrs = array(); $bookings->Origin_ID->ViewAttrs = array(); $bookings->Origin_ID->EditAttrs = array();

		// Customer_ID
		$bookings->Customer_ID->CellCssStyle = ""; $bookings->Customer_ID->CellCssClass = "";
		$bookings->Customer_ID->CellAttrs = array(); $bookings->Customer_ID->ViewAttrs = array(); $bookings->Customer_ID->EditAttrs = array();

		// Destination_ID
		$bookings->Destination_ID->CellCssStyle = ""; $bookings->Destination_ID->CellCssClass = "";
		$bookings->Destination_ID->CellAttrs = array(); $bookings->Destination_ID->ViewAttrs = array(); $bookings->Destination_ID->EditAttrs = array();

		// Subcon_ID
		$bookings->Subcon_ID->CellCssStyle = ""; $bookings->Subcon_ID->CellCssClass = "";
		$bookings->Subcon_ID->CellAttrs = array(); $bookings->Subcon_ID->ViewAttrs = array(); $bookings->Subcon_ID->EditAttrs = array();

		// Truck_ID
		$bookings->Truck_ID->CellCssStyle = ""; $bookings->Truck_ID->CellCssClass = "";
		$bookings->Truck_ID->CellAttrs = array(); $bookings->Truck_ID->ViewAttrs = array(); $bookings->Truck_ID->EditAttrs = array();

		// ETD
		$bookings->ETD->CellCssStyle = ""; $bookings->ETD->CellCssClass = "";
		$bookings->ETD->CellAttrs = array(); $bookings->ETD->ViewAttrs = array(); $bookings->ETD->EditAttrs = array();

		// ETA
		$bookings->ETA->CellCssStyle = ""; $bookings->ETA->CellCssClass = "";
		$bookings->ETA->CellAttrs = array(); $bookings->ETA->ViewAttrs = array(); $bookings->ETA->EditAttrs = array();

		// Billing_Type_ID
		$bookings->Billing_Type_ID->CellCssStyle = ""; $bookings->Billing_Type_ID->CellCssClass = "";
		$bookings->Billing_Type_ID->CellAttrs = array(); $bookings->Billing_Type_ID->ViewAttrs = array(); $bookings->Billing_Type_ID->EditAttrs = array();

		// Doc_Reference_Number
		$bookings->Doc_Reference_Number->CellCssStyle = ""; $bookings->Doc_Reference_Number->CellCssClass = "";
		$bookings->Doc_Reference_Number->CellAttrs = array(); $bookings->Doc_Reference_Number->ViewAttrs = array(); $bookings->Doc_Reference_Number->EditAttrs = array();

		// Truck_Driver_ID
		$bookings->Truck_Driver_ID->CellCssStyle = ""; $bookings->Truck_Driver_ID->CellCssClass = "";
		$bookings->Truck_Driver_ID->CellAttrs = array(); $bookings->Truck_Driver_ID->ViewAttrs = array(); $bookings->Truck_Driver_ID->EditAttrs = array();

		// Status_ID
		$bookings->Status_ID->CellCssStyle = ""; $bookings->Status_ID->CellCssClass = "";
		$bookings->Status_ID->CellAttrs = array(); $bookings->Status_ID->ViewAttrs = array(); $bookings->Status_ID->EditAttrs = array();

		// Unit_ID
		$bookings->Unit_ID->CellCssStyle = ""; $bookings->Unit_ID->CellCssClass = "";
		$bookings->Unit_ID->CellAttrs = array(); $bookings->Unit_ID->ViewAttrs = array(); $bookings->Unit_ID->EditAttrs = array();

		// Quantity
		$bookings->Quantity->CellCssStyle = ""; $bookings->Quantity->CellCssClass = "";
		$bookings->Quantity->CellAttrs = array(); $bookings->Quantity->ViewAttrs = array(); $bookings->Quantity->EditAttrs = array();

		// Freight
		$bookings->Freight->CellCssStyle = ""; $bookings->Freight->CellCssClass = "";
		$bookings->Freight->CellAttrs = array(); $bookings->Freight->ViewAttrs = array(); $bookings->Freight->EditAttrs = array();

		// Vat
		$bookings->Vat->CellCssStyle = ""; $bookings->Vat->CellCssClass = "";
		$bookings->Vat->CellAttrs = array(); $bookings->Vat->ViewAttrs = array(); $bookings->Vat->EditAttrs = array();

		// Total_Sales
		$bookings->Total_Sales->CellCssStyle = ""; $bookings->Total_Sales->CellCssClass = "";
		$bookings->Total_Sales->CellAttrs = array(); $bookings->Total_Sales->ViewAttrs = array(); $bookings->Total_Sales->EditAttrs = array();

		// Wtax
		$bookings->Wtax->CellCssStyle = ""; $bookings->Wtax->CellCssClass = "";
		$bookings->Wtax->CellAttrs = array(); $bookings->Wtax->ViewAttrs = array(); $bookings->Wtax->EditAttrs = array();

		// Total_Amount_Due
		$bookings->Total_Amount_Due->CellCssStyle = ""; $bookings->Total_Amount_Due->CellCssClass = "";
		$bookings->Total_Amount_Due->CellAttrs = array(); $bookings->Total_Amount_Due->ViewAttrs = array(); $bookings->Total_Amount_Due->EditAttrs = array();

		// Date_Delivered
		$bookings->Date_Delivered->CellCssStyle = ""; $bookings->Date_Delivered->CellCssClass = "";
		$bookings->Date_Delivered->CellAttrs = array(); $bookings->Date_Delivered->ViewAttrs = array(); $bookings->Date_Delivered->EditAttrs = array();

		// Date_Updated
		$bookings->Date_Updated->CellCssStyle = ""; $bookings->Date_Updated->CellCssClass = "";
		$bookings->Date_Updated->CellAttrs = array(); $bookings->Date_Updated->ViewAttrs = array(); $bookings->Date_Updated->EditAttrs = array();

		// Remarks
		$bookings->Remarks->CellCssStyle = ""; $bookings->Remarks->CellCssClass = "";
		$bookings->Remarks->CellAttrs = array(); $bookings->Remarks->ViewAttrs = array(); $bookings->Remarks->EditAttrs = array();
		if ($bookings->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$bookings->id->ViewValue = $bookings->id->CurrentValue;
			$bookings->id->CssStyle = "";
			$bookings->id->CssClass = "";
			$bookings->id->ViewCustomAttributes = "";

			// Booking_Number
			$bookings->Booking_Number->ViewValue = $bookings->Booking_Number->CurrentValue;
			$bookings->Booking_Number->CssStyle = "";
			$bookings->Booking_Number->CssClass = "";
			$bookings->Booking_Number->ViewCustomAttributes = "";

			// Date
			$bookings->Date->ViewValue = $bookings->Date->CurrentValue;
			$bookings->Date->ViewValue = ew_FormatDateTime($bookings->Date->ViewValue, 10);
			$bookings->Date->CssStyle = "";
			$bookings->Date->CssClass = "";
			$bookings->Date->ViewCustomAttributes = "";

			// Client_ID
			if (strval($bookings->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$bookings->Client_ID->ViewValue = $bookings->Client_ID->CurrentValue;
				}
			} else {
				$bookings->Client_ID->ViewValue = NULL;
			}
			$bookings->Client_ID->CssStyle = "";
			$bookings->Client_ID->CssClass = "";
			$bookings->Client_ID->ViewCustomAttributes = "";

			// Origin_ID
			if (strval($bookings->Origin_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Origin_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Origin` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Origin_ID->ViewValue = $rswrk->fields('Origin');
					$rswrk->Close();
				} else {
					$bookings->Origin_ID->ViewValue = $bookings->Origin_ID->CurrentValue;
				}
			} else {
				$bookings->Origin_ID->ViewValue = NULL;
			}
			$bookings->Origin_ID->CssStyle = "";
			$bookings->Origin_ID->CssClass = "";
			$bookings->Origin_ID->ViewCustomAttributes = "";

			// Customer_ID
			if (strval($bookings->Customer_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Customer_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Customer_Name` FROM `consignees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Customer_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Customer_ID->ViewValue = $rswrk->fields('Customer_Name');
					$rswrk->Close();
				} else {
					$bookings->Customer_ID->ViewValue = $bookings->Customer_ID->CurrentValue;
				}
			} else {
				$bookings->Customer_ID->ViewValue = NULL;
			}
			$bookings->Customer_ID->CssStyle = "";
			$bookings->Customer_ID->CssClass = "";
			$bookings->Customer_ID->ViewCustomAttributes = "";

			// Destination_ID
			if (strval($bookings->Destination_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Destination_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Destination_ID->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$bookings->Destination_ID->ViewValue = $bookings->Destination_ID->CurrentValue;
				}
			} else {
				$bookings->Destination_ID->ViewValue = NULL;
			}
			$bookings->Destination_ID->CssStyle = "";
			$bookings->Destination_ID->CssClass = "";
			$bookings->Destination_ID->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($bookings->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$bookings->Subcon_ID->ViewValue = $bookings->Subcon_ID->CurrentValue;
				}
			} else {
				$bookings->Subcon_ID->ViewValue = NULL;
			}
			$bookings->Subcon_ID->CssStyle = "";
			$bookings->Subcon_ID->CssClass = "";
			$bookings->Subcon_ID->ViewCustomAttributes = "";

			// Truck_ID
			if (strval($bookings->Truck_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Truck_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Plate_Number` FROM `trucks`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Plate_Number` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Truck_ID->ViewValue = $rswrk->fields('Plate_Number');
					$rswrk->Close();
				} else {
					$bookings->Truck_ID->ViewValue = $bookings->Truck_ID->CurrentValue;
				}
			} else {
				$bookings->Truck_ID->ViewValue = NULL;
			}
			$bookings->Truck_ID->CssStyle = "";
			$bookings->Truck_ID->CssClass = "";
			$bookings->Truck_ID->ViewCustomAttributes = "";

			// ETD
			$bookings->ETD->ViewValue = $bookings->ETD->CurrentValue;
			$bookings->ETD->ViewValue = ew_FormatDateTime($bookings->ETD->ViewValue, 6);
			$bookings->ETD->CssStyle = "";
			$bookings->ETD->CssClass = "";
			$bookings->ETD->ViewCustomAttributes = "";

			// ETA
			$bookings->ETA->ViewValue = $bookings->ETA->CurrentValue;
			$bookings->ETA->ViewValue = ew_FormatDateTime($bookings->ETA->ViewValue, 6);
			$bookings->ETA->CssStyle = "";
			$bookings->ETA->CssClass = "";
			$bookings->ETA->ViewCustomAttributes = "";

			// Billing_Type_ID
			if (strval($bookings->Billing_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Billing_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Billing_Types` FROM `billing_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Billing_Type_ID->ViewValue = $rswrk->fields('Billing_Types');
					$rswrk->Close();
				} else {
					$bookings->Billing_Type_ID->ViewValue = $bookings->Billing_Type_ID->CurrentValue;
				}
			} else {
				$bookings->Billing_Type_ID->ViewValue = NULL;
			}
			$bookings->Billing_Type_ID->CssStyle = "";
			$bookings->Billing_Type_ID->CssClass = "";
			$bookings->Billing_Type_ID->ViewCustomAttributes = "";

			// Doc_Reference_Number
			$bookings->Doc_Reference_Number->ViewValue = $bookings->Doc_Reference_Number->CurrentValue;
			$bookings->Doc_Reference_Number->CssStyle = "";
			$bookings->Doc_Reference_Number->CssClass = "";
			$bookings->Doc_Reference_Number->ViewCustomAttributes = "";

			// Truck_Driver_ID
			if (strval($bookings->Truck_Driver_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Truck_Driver_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Driver` FROM `truck_drivers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Truck_Driver_ID->ViewValue = $rswrk->fields('Truck_Driver');
					$rswrk->Close();
				} else {
					$bookings->Truck_Driver_ID->ViewValue = $bookings->Truck_Driver_ID->CurrentValue;
				}
			} else {
				$bookings->Truck_Driver_ID->ViewValue = NULL;
			}
			$bookings->Truck_Driver_ID->CssStyle = "";
			$bookings->Truck_Driver_ID->CssClass = "";
			$bookings->Truck_Driver_ID->ViewCustomAttributes = "";

			// Status_ID
			if (strval($bookings->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$bookings->Status_ID->ViewValue = $bookings->Status_ID->CurrentValue;
				}
			} else {
				$bookings->Status_ID->ViewValue = NULL;
			}
			$bookings->Status_ID->CssStyle = "";
			$bookings->Status_ID->CssClass = "";
			$bookings->Status_ID->ViewCustomAttributes = "";

			// Unit_ID
			if (strval($bookings->Unit_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Unit_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Units` FROM `units`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Unit_ID->ViewValue = $rswrk->fields('Units');
					$rswrk->Close();
				} else {
					$bookings->Unit_ID->ViewValue = $bookings->Unit_ID->CurrentValue;
				}
			} else {
				$bookings->Unit_ID->ViewValue = NULL;
			}
			$bookings->Unit_ID->CssStyle = "";
			$bookings->Unit_ID->CssClass = "";
			$bookings->Unit_ID->ViewCustomAttributes = "";

			// Quantity
			$bookings->Quantity->ViewValue = $bookings->Quantity->CurrentValue;
			$bookings->Quantity->ViewValue = ew_FormatNumber($bookings->Quantity->ViewValue, 2, -2, -2, -2);
			$bookings->Quantity->CssStyle = "";
			$bookings->Quantity->CssClass = "";
			$bookings->Quantity->ViewCustomAttributes = "";

			// Freight
			$bookings->Freight->ViewValue = $bookings->Freight->CurrentValue;
			$bookings->Freight->ViewValue = ew_FormatNumber($bookings->Freight->ViewValue, 2, -2, -2, -2);
			$bookings->Freight->CssStyle = "";
			$bookings->Freight->CssClass = "";
			$bookings->Freight->ViewCustomAttributes = "";

			// Vat
			$bookings->Vat->ViewValue = $bookings->Vat->CurrentValue;
			$bookings->Vat->ViewValue = ew_FormatNumber($bookings->Vat->ViewValue, 2, -2, -2, -2);
			$bookings->Vat->CssStyle = "";
			$bookings->Vat->CssClass = "";
			$bookings->Vat->ViewCustomAttributes = "";

			// Total_Sales
			$bookings->Total_Sales->ViewValue = $bookings->Total_Sales->CurrentValue;
			$bookings->Total_Sales->ViewValue = ew_FormatNumber($bookings->Total_Sales->ViewValue, 2, -2, -2, -2);
			$bookings->Total_Sales->CssStyle = "";
			$bookings->Total_Sales->CssClass = "";
			$bookings->Total_Sales->ViewCustomAttributes = "";

			// Wtax
			$bookings->Wtax->ViewValue = $bookings->Wtax->CurrentValue;
			$bookings->Wtax->ViewValue = ew_FormatNumber($bookings->Wtax->ViewValue, 2, -2, -2, -2);
			$bookings->Wtax->CssStyle = "";
			$bookings->Wtax->CssClass = "";
			$bookings->Wtax->ViewCustomAttributes = "";

			// Total_Amount_Due
			$bookings->Total_Amount_Due->ViewValue = $bookings->Total_Amount_Due->CurrentValue;
			$bookings->Total_Amount_Due->ViewValue = ew_FormatNumber($bookings->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$bookings->Total_Amount_Due->CssStyle = "";
			$bookings->Total_Amount_Due->CssClass = "";
			$bookings->Total_Amount_Due->ViewCustomAttributes = "";

			// Date_Delivered
			$bookings->Date_Delivered->ViewValue = $bookings->Date_Delivered->CurrentValue;
			$bookings->Date_Delivered->ViewValue = ew_FormatDateTime($bookings->Date_Delivered->ViewValue, 10);
			$bookings->Date_Delivered->CssStyle = "";
			$bookings->Date_Delivered->CssClass = "";
			$bookings->Date_Delivered->ViewCustomAttributes = "";

			// Date_Updated
			$bookings->Date_Updated->ViewValue = $bookings->Date_Updated->CurrentValue;
			$bookings->Date_Updated->ViewValue = ew_FormatDateTime($bookings->Date_Updated->ViewValue, 6);
			$bookings->Date_Updated->CssStyle = "";
			$bookings->Date_Updated->CssClass = "";
			$bookings->Date_Updated->ViewCustomAttributes = "";

			// Remarks
			$bookings->Remarks->ViewValue = $bookings->Remarks->CurrentValue;
			$bookings->Remarks->CssStyle = "";
			$bookings->Remarks->CssClass = "";
			$bookings->Remarks->ViewCustomAttributes = "";

			// id
			$bookings->id->HrefValue = "";
			$bookings->id->TooltipValue = "";

			// Booking_Number
			$bookings->Booking_Number->HrefValue = "";
			$bookings->Booking_Number->TooltipValue = "";

			// Date
			$bookings->Date->HrefValue = "";
			$bookings->Date->TooltipValue = "";

			// Client_ID
			$bookings->Client_ID->HrefValue = "";
			$bookings->Client_ID->TooltipValue = "";

			// Origin_ID
			$bookings->Origin_ID->HrefValue = "";
			$bookings->Origin_ID->TooltipValue = "";

			// Customer_ID
			$bookings->Customer_ID->HrefValue = "";
			$bookings->Customer_ID->TooltipValue = "";

			// Destination_ID
			$bookings->Destination_ID->HrefValue = "";
			$bookings->Destination_ID->TooltipValue = "";

			// Subcon_ID
			$bookings->Subcon_ID->HrefValue = "";
			$bookings->Subcon_ID->TooltipValue = "";

			// Truck_ID
			$bookings->Truck_ID->HrefValue = "";
			$bookings->Truck_ID->TooltipValue = "";

			// ETD
			$bookings->ETD->HrefValue = "";
			$bookings->ETD->TooltipValue = "";

			// ETA
			$bookings->ETA->HrefValue = "";
			$bookings->ETA->TooltipValue = "";

			// Billing_Type_ID
			$bookings->Billing_Type_ID->HrefValue = "";
			$bookings->Billing_Type_ID->TooltipValue = "";

			// Doc_Reference_Number
			$bookings->Doc_Reference_Number->HrefValue = "";
			$bookings->Doc_Reference_Number->TooltipValue = "";

			// Truck_Driver_ID
			$bookings->Truck_Driver_ID->HrefValue = "";
			$bookings->Truck_Driver_ID->TooltipValue = "";

			// Status_ID
			$bookings->Status_ID->HrefValue = "";
			$bookings->Status_ID->TooltipValue = "";

			// Unit_ID
			$bookings->Unit_ID->HrefValue = "";
			$bookings->Unit_ID->TooltipValue = "";

			// Quantity
			$bookings->Quantity->HrefValue = "";
			$bookings->Quantity->TooltipValue = "";

			// Freight
			$bookings->Freight->HrefValue = "";
			$bookings->Freight->TooltipValue = "";

			// Vat
			$bookings->Vat->HrefValue = "";
			$bookings->Vat->TooltipValue = "";

			// Total_Sales
			$bookings->Total_Sales->HrefValue = "";
			$bookings->Total_Sales->TooltipValue = "";

			// Wtax
			$bookings->Wtax->HrefValue = "";
			$bookings->Wtax->TooltipValue = "";

			// Total_Amount_Due
			$bookings->Total_Amount_Due->HrefValue = "";
			$bookings->Total_Amount_Due->TooltipValue = "";

			// Date_Delivered
			$bookings->Date_Delivered->HrefValue = "";
			$bookings->Date_Delivered->TooltipValue = "";

			// Date_Updated
			$bookings->Date_Updated->HrefValue = "";
			$bookings->Date_Updated->TooltipValue = "";

			// Remarks
			$bookings->Remarks->HrefValue = "";
			$bookings->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($bookings->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$bookings->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {
		
		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}
}

?>
