<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "invoicesinfo.php" ?>
<?php include "clientsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "invoice_itemsinfo.php" ?>
<?php include "customer_invoicesinfo.php" ?>
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
$invoices_view = new cinvoices_view();
$Page =& $invoices_view;

// Page init
$invoices_view->Page_Init();

// Page main
$invoices_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($invoices->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var invoices_view = new ew_Page("invoices_view");

// page properties
invoices_view.PageID = "view"; // page ID
invoices_view.FormID = "finvoicesview"; // form ID
var EW_PAGE_ID = invoices_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
invoices_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoices_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoices_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoices_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoices->TableCaption() ?>
<br><br>
<?php if ($invoices->Export == "") { ?>
<a href="<?php echo $invoices_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $invoices_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $invoices_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $invoices_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $invoices_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('invoice_items')) { ?>
<a href="invoice_itemslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=invoices&id=<?php echo urlencode(strval($invoices->id->CurrentValue)) ?>&Client_ID=<?php echo urlencode(strval($invoices->Client_ID->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("invoice_items", "TblCaption") ?>
<?php echo str_replace("%c", $invoices_view->linvoice_items_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('customer_invoices')) { ?>
<a href="customer_invoiceslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=invoices&id=<?php echo urlencode(strval($invoices->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("customer_invoices", "TblCaption") ?>
<?php echo str_replace("%c", $invoices_view->lcustomer_invoices_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoices_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($invoices->id->Visible) { // id ?>
	<tr<?php echo $invoices->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->id->FldCaption() ?></td>
		<td<?php echo $invoices->id->CellAttributes() ?>>
<div<?php echo $invoices->id->ViewAttributes() ?>><?php echo $invoices->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Invoice_Number->Visible) { // Invoice_Number ?>
	<tr<?php echo $invoices->Invoice_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Invoice_Number->FldCaption() ?></td>
		<td<?php echo $invoices->Invoice_Number->CellAttributes() ?>>
<div<?php echo $invoices->Invoice_Number->ViewAttributes() ?>><?php echo $invoices->Invoice_Number->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Client_ID->Visible) { // Client_ID ?>
	<tr<?php echo $invoices->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Client_ID->FldCaption() ?></td>
		<td<?php echo $invoices->Client_ID->CellAttributes() ?>>
<div<?php echo $invoices->Client_ID->ViewAttributes() ?>><?php echo $invoices->Client_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Invoice_Date->Visible) { // Invoice_Date ?>
	<tr<?php echo $invoices->Invoice_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Invoice_Date->FldCaption() ?></td>
		<td<?php echo $invoices->Invoice_Date->CellAttributes() ?>>
<div<?php echo $invoices->Invoice_Date->ViewAttributes() ?>><?php echo $invoices->Invoice_Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Due_Date->Visible) { // Due_Date ?>
	<tr<?php echo $invoices->Due_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Due_Date->FldCaption() ?></td>
		<td<?php echo $invoices->Due_Date->CellAttributes() ?>>
<div<?php echo $invoices->Due_Date->ViewAttributes() ?>><?php echo $invoices->Due_Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->payment_period->Visible) { // payment_period ?>
	<tr<?php echo $invoices->payment_period->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->payment_period->FldCaption() ?></td>
		<td<?php echo $invoices->payment_period->CellAttributes() ?>>
<div<?php echo $invoices->payment_period->ViewAttributes() ?>><?php echo $invoices->payment_period->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Total_Vat->Visible) { // Total_Vat ?>
	<tr<?php echo $invoices->Total_Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Vat->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Vat->CellAttributes() ?>>
<div<?php echo $invoices->Total_Vat->ViewAttributes() ?>><?php echo $invoices->Total_Vat->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Total_WTax->Visible) { // Total_WTax ?>
	<tr<?php echo $invoices->Total_WTax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_WTax->FldCaption() ?></td>
		<td<?php echo $invoices->Total_WTax->CellAttributes() ?>>
<div<?php echo $invoices->Total_WTax->ViewAttributes() ?>><?php echo $invoices->Total_WTax->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Total_Freight->Visible) { // Total_Freight ?>
	<tr<?php echo $invoices->Total_Freight->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Freight->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Freight->CellAttributes() ?>>
<div<?php echo $invoices->Total_Freight->ViewAttributes() ?>><?php echo $invoices->Total_Freight->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<tr<?php echo $invoices->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $invoices->Total_Amount_Due->ViewAttributes() ?>><?php echo $invoices->Total_Amount_Due->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Payment_Reference->Visible) { // Payment_Reference ?>
	<tr<?php echo $invoices->Payment_Reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Payment_Reference->FldCaption() ?></td>
		<td<?php echo $invoices->Payment_Reference->CellAttributes() ?>>
<div<?php echo $invoices->Payment_Reference->ViewAttributes() ?>><?php echo $invoices->Payment_Reference->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Payment_Status->Visible) { // Payment_Status ?>
	<tr<?php echo $invoices->Payment_Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Payment_Status->FldCaption() ?></td>
		<td<?php echo $invoices->Payment_Status->CellAttributes() ?>>
<div<?php echo $invoices->Payment_Status->ViewAttributes() ?>><?php echo $invoices->Payment_Status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Status->Visible) { // Status ?>
	<tr<?php echo $invoices->Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Status->FldCaption() ?></td>
		<td<?php echo $invoices->Status->CellAttributes() ?>>
<div<?php echo $invoices->Status->ViewAttributes() ?>><?php echo $invoices->Status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Recipient_Bank->Visible) { // Recipient_Bank ?>
	<tr<?php echo $invoices->Recipient_Bank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Recipient_Bank->FldCaption() ?></td>
		<td<?php echo $invoices->Recipient_Bank->CellAttributes() ?>>
<div<?php echo $invoices->Recipient_Bank->ViewAttributes() ?>><?php echo $invoices->Recipient_Bank->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $invoices->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Remarks->FldCaption() ?></td>
		<td<?php echo $invoices->Remarks->CellAttributes() ?>>
<div<?php echo $invoices->Remarks->ViewAttributes() ?>><?php echo $invoices->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->User_ID->Visible) { // User_ID ?>
	<tr<?php echo $invoices->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->User_ID->FldCaption() ?></td>
		<td<?php echo $invoices->User_ID->CellAttributes() ?>>
<div<?php echo $invoices->User_ID->ViewAttributes() ?>><?php echo $invoices->User_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->created->Visible) { // created ?>
	<tr<?php echo $invoices->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->created->FldCaption() ?></td>
		<td<?php echo $invoices->created->CellAttributes() ?>>
<div<?php echo $invoices->created->ViewAttributes() ?>><?php echo $invoices->created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoices->modified->Visible) { // modified ?>
	<tr<?php echo $invoices->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->modified->FldCaption() ?></td>
		<td<?php echo $invoices->modified->CellAttributes() ?>>
<div<?php echo $invoices->modified->ViewAttributes() ?>><?php echo $invoices->modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($invoices->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$invoices_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoices_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'invoices';

	// Page object name
	var $PageObjName = 'invoices_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $invoices;
		if ($invoices->UseTokenInUrl) $PageUrl .= "t=" . $invoices->TableVar . "&"; // Add page token
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
		global $objForm, $invoices;
		if ($invoices->UseTokenInUrl) {
			if ($objForm)
				return ($invoices->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($invoices->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinvoices_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (invoices)
		$GLOBALS["invoices"] = new cinvoices();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoice_items)
		$GLOBALS['invoice_items'] = new cinvoice_items();

		// Table object (customer_invoices)
		$GLOBALS['customer_invoices'] = new ccustomer_invoices();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'invoices', TRUE);

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
		global $invoices;

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
			$this->Page_Terminate("invoiceslist.php");
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
	var $linvoice_items_Count;
	var $lcustomer_invoices_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $invoices;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$invoices->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $invoices->id->QueryStringValue;
			} else {
				$sReturnUrl = "invoiceslist.php"; // Return to list
			}

			// Get action
			$invoices->CurrentAction = "I"; // Display form
			switch ($invoices->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "invoiceslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "invoiceslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$invoices->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $invoices;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$invoices->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$invoices->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $invoices->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$invoices->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$invoices->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$invoices->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $invoices;
		$sFilter = $invoices->KeyFilter();

		// Call Row Selecting event
		$invoices->Row_Selecting($sFilter);

		// Load SQL based on filter
		$invoices->CurrentFilter = $sFilter;
		$sSql = $invoices->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$invoices->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $invoices;
		$invoices->id->setDbValue($rs->fields('id'));
		$invoices->Invoice_Number->setDbValue($rs->fields('Invoice_Number'));
		$invoices->Client_ID->setDbValue($rs->fields('Client_ID'));
		$invoices->Invoice_Date->setDbValue($rs->fields('Invoice_Date'));
		$invoices->Due_Date->setDbValue($rs->fields('Due_Date'));
		$invoices->payment_period->setDbValue($rs->fields('payment_period'));
		$invoices->Total_Vat->setDbValue($rs->fields('Total_Vat'));
		$invoices->Total_WTax->setDbValue($rs->fields('Total_WTax'));
		$invoices->Total_Freight->setDbValue($rs->fields('Total_Freight'));
		$invoices->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$invoices->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$invoices->Payment_Status->setDbValue($rs->fields('Payment_Status'));
		$invoices->Status->setDbValue($rs->fields('Status'));
		$invoices->Recipient_Bank->setDbValue($rs->fields('Recipient_Bank'));
		$invoices->Remarks->setDbValue($rs->fields('Remarks'));
		$invoices->User_ID->setDbValue($rs->fields('User_ID'));
		$invoices->created->setDbValue($rs->fields('created'));
		$invoices->modified->setDbValue($rs->fields('modified'));
		$sDetailFilter = $GLOBALS["invoice_items"]->SqlDetailFilter_invoices();
		$sDetailFilter = str_replace("@invoice_id@", ew_AdjustSql($invoices->id->DbValue), $sDetailFilter);
		$sDetailFilter = str_replace("@client_id@", ew_AdjustSql($invoices->Client_ID->DbValue), $sDetailFilter);
		$this->linvoice_items_Count = $GLOBALS["invoice_items"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["customer_invoices"]->SqlDetailFilter_invoices();
		$sDetailFilter = str_replace("@Invoice_ID@", ew_AdjustSql($invoices->id->DbValue), $sDetailFilter);
		$this->lcustomer_invoices_Count = $GLOBALS["customer_invoices"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $invoices;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($invoices->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($invoices->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($invoices->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($invoices->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($invoices->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($invoices->id->CurrentValue);
		$this->AddUrl = $invoices->AddUrl();
		$this->EditUrl = $invoices->EditUrl();
		$this->CopyUrl = $invoices->CopyUrl();
		$this->DeleteUrl = $invoices->DeleteUrl();
		$this->ListUrl = $invoices->ListUrl();

		// Call Row_Rendering event
		$invoices->Row_Rendering();

		// Common render codes for all row types
		// id

		$invoices->id->CellCssStyle = ""; $invoices->id->CellCssClass = "";
		$invoices->id->CellAttrs = array(); $invoices->id->ViewAttrs = array(); $invoices->id->EditAttrs = array();

		// Invoice_Number
		$invoices->Invoice_Number->CellCssStyle = ""; $invoices->Invoice_Number->CellCssClass = "";
		$invoices->Invoice_Number->CellAttrs = array(); $invoices->Invoice_Number->ViewAttrs = array(); $invoices->Invoice_Number->EditAttrs = array();

		// Client_ID
		$invoices->Client_ID->CellCssStyle = ""; $invoices->Client_ID->CellCssClass = "";
		$invoices->Client_ID->CellAttrs = array(); $invoices->Client_ID->ViewAttrs = array(); $invoices->Client_ID->EditAttrs = array();

		// Invoice_Date
		$invoices->Invoice_Date->CellCssStyle = ""; $invoices->Invoice_Date->CellCssClass = "";
		$invoices->Invoice_Date->CellAttrs = array(); $invoices->Invoice_Date->ViewAttrs = array(); $invoices->Invoice_Date->EditAttrs = array();

		// Due_Date
		$invoices->Due_Date->CellCssStyle = ""; $invoices->Due_Date->CellCssClass = "";
		$invoices->Due_Date->CellAttrs = array(); $invoices->Due_Date->ViewAttrs = array(); $invoices->Due_Date->EditAttrs = array();

		// payment_period
		$invoices->payment_period->CellCssStyle = ""; $invoices->payment_period->CellCssClass = "";
		$invoices->payment_period->CellAttrs = array(); $invoices->payment_period->ViewAttrs = array(); $invoices->payment_period->EditAttrs = array();

		// Total_Vat
		$invoices->Total_Vat->CellCssStyle = ""; $invoices->Total_Vat->CellCssClass = "";
		$invoices->Total_Vat->CellAttrs = array(); $invoices->Total_Vat->ViewAttrs = array(); $invoices->Total_Vat->EditAttrs = array();

		// Total_WTax
		$invoices->Total_WTax->CellCssStyle = ""; $invoices->Total_WTax->CellCssClass = "";
		$invoices->Total_WTax->CellAttrs = array(); $invoices->Total_WTax->ViewAttrs = array(); $invoices->Total_WTax->EditAttrs = array();

		// Total_Freight
		$invoices->Total_Freight->CellCssStyle = ""; $invoices->Total_Freight->CellCssClass = "";
		$invoices->Total_Freight->CellAttrs = array(); $invoices->Total_Freight->ViewAttrs = array(); $invoices->Total_Freight->EditAttrs = array();

		// Total_Amount_Due
		$invoices->Total_Amount_Due->CellCssStyle = ""; $invoices->Total_Amount_Due->CellCssClass = "";
		$invoices->Total_Amount_Due->CellAttrs = array(); $invoices->Total_Amount_Due->ViewAttrs = array(); $invoices->Total_Amount_Due->EditAttrs = array();

		// Payment_Reference
		$invoices->Payment_Reference->CellCssStyle = ""; $invoices->Payment_Reference->CellCssClass = "";
		$invoices->Payment_Reference->CellAttrs = array(); $invoices->Payment_Reference->ViewAttrs = array(); $invoices->Payment_Reference->EditAttrs = array();

		// Payment_Status
		$invoices->Payment_Status->CellCssStyle = ""; $invoices->Payment_Status->CellCssClass = "";
		$invoices->Payment_Status->CellAttrs = array(); $invoices->Payment_Status->ViewAttrs = array(); $invoices->Payment_Status->EditAttrs = array();

		// Status
		$invoices->Status->CellCssStyle = ""; $invoices->Status->CellCssClass = "";
		$invoices->Status->CellAttrs = array(); $invoices->Status->ViewAttrs = array(); $invoices->Status->EditAttrs = array();

		// Recipient_Bank
		$invoices->Recipient_Bank->CellCssStyle = ""; $invoices->Recipient_Bank->CellCssClass = "";
		$invoices->Recipient_Bank->CellAttrs = array(); $invoices->Recipient_Bank->ViewAttrs = array(); $invoices->Recipient_Bank->EditAttrs = array();

		// Remarks
		$invoices->Remarks->CellCssStyle = ""; $invoices->Remarks->CellCssClass = "";
		$invoices->Remarks->CellAttrs = array(); $invoices->Remarks->ViewAttrs = array(); $invoices->Remarks->EditAttrs = array();

		// User_ID
		$invoices->User_ID->CellCssStyle = ""; $invoices->User_ID->CellCssClass = "";
		$invoices->User_ID->CellAttrs = array(); $invoices->User_ID->ViewAttrs = array(); $invoices->User_ID->EditAttrs = array();

		// created
		$invoices->created->CellCssStyle = ""; $invoices->created->CellCssClass = "";
		$invoices->created->CellAttrs = array(); $invoices->created->ViewAttrs = array(); $invoices->created->EditAttrs = array();

		// modified
		$invoices->modified->CellCssStyle = ""; $invoices->modified->CellCssClass = "";
		$invoices->modified->CellAttrs = array(); $invoices->modified->ViewAttrs = array(); $invoices->modified->EditAttrs = array();
		if ($invoices->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$invoices->id->ViewValue = $invoices->id->CurrentValue;
			$invoices->id->CssStyle = "";
			$invoices->id->CssClass = "";
			$invoices->id->ViewCustomAttributes = "";

			// Invoice_Number
			$invoices->Invoice_Number->ViewValue = $invoices->Invoice_Number->CurrentValue;
			$invoices->Invoice_Number->CssStyle = "";
			$invoices->Invoice_Number->CssClass = "";
			$invoices->Invoice_Number->ViewCustomAttributes = "";

			// Client_ID
			if (strval($invoices->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Client_ID->CurrentValue) . "";
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
					$invoices->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$invoices->Client_ID->ViewValue = $invoices->Client_ID->CurrentValue;
				}
			} else {
				$invoices->Client_ID->ViewValue = NULL;
			}
			$invoices->Client_ID->CssStyle = "";
			$invoices->Client_ID->CssClass = "";
			$invoices->Client_ID->ViewCustomAttributes = "";

			// Invoice_Date
			$invoices->Invoice_Date->ViewValue = $invoices->Invoice_Date->CurrentValue;
			$invoices->Invoice_Date->ViewValue = ew_FormatDateTime($invoices->Invoice_Date->ViewValue, 6);
			$invoices->Invoice_Date->CssStyle = "";
			$invoices->Invoice_Date->CssClass = "";
			$invoices->Invoice_Date->ViewCustomAttributes = "";

			// Due_Date
			$invoices->Due_Date->ViewValue = $invoices->Due_Date->CurrentValue;
			$invoices->Due_Date->ViewValue = ew_FormatDateTime($invoices->Due_Date->ViewValue, 6);
			$invoices->Due_Date->CssStyle = "";
			$invoices->Due_Date->CssClass = "";
			$invoices->Due_Date->ViewCustomAttributes = "";

			// payment_period
			if (strval($invoices->payment_period->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->payment_period->CurrentValue) . "";
			$sSqlWrk = "SELECT `payment_period` FROM `client_payment_period`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->payment_period->ViewValue = $rswrk->fields('payment_period');
					$rswrk->Close();
				} else {
					$invoices->payment_period->ViewValue = $invoices->payment_period->CurrentValue;
				}
			} else {
				$invoices->payment_period->ViewValue = NULL;
			}
			$invoices->payment_period->CssStyle = "";
			$invoices->payment_period->CssClass = "";
			$invoices->payment_period->ViewCustomAttributes = "";

			// Total_Vat
			$invoices->Total_Vat->ViewValue = $invoices->Total_Vat->CurrentValue;
			$invoices->Total_Vat->ViewValue = ew_FormatNumber($invoices->Total_Vat->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Vat->CssStyle = "";
			$invoices->Total_Vat->CssClass = "";
			$invoices->Total_Vat->ViewCustomAttributes = "";

			// Total_WTax
			$invoices->Total_WTax->ViewValue = $invoices->Total_WTax->CurrentValue;
			$invoices->Total_WTax->ViewValue = ew_FormatNumber($invoices->Total_WTax->ViewValue, 2, -2, -2, -2);
			$invoices->Total_WTax->CssStyle = "";
			$invoices->Total_WTax->CssClass = "";
			$invoices->Total_WTax->ViewCustomAttributes = "";

			// Total_Freight
			$invoices->Total_Freight->ViewValue = $invoices->Total_Freight->CurrentValue;
			$invoices->Total_Freight->ViewValue = ew_FormatNumber($invoices->Total_Freight->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Freight->CssStyle = "";
			$invoices->Total_Freight->CssClass = "";
			$invoices->Total_Freight->ViewCustomAttributes = "";

			// Total_Amount_Due
			$invoices->Total_Amount_Due->ViewValue = $invoices->Total_Amount_Due->CurrentValue;
			$invoices->Total_Amount_Due->ViewValue = ew_FormatNumber($invoices->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Amount_Due->CssStyle = "";
			$invoices->Total_Amount_Due->CssClass = "";
			$invoices->Total_Amount_Due->ViewCustomAttributes = "";

			// Payment_Reference
			$invoices->Payment_Reference->ViewValue = $invoices->Payment_Reference->CurrentValue;
			$invoices->Payment_Reference->CssStyle = "";
			$invoices->Payment_Reference->CssClass = "";
			$invoices->Payment_Reference->ViewCustomAttributes = "";

			// Payment_Status
			if (strval($invoices->Payment_Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Payment_Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Payment_Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$invoices->Payment_Status->ViewValue = $invoices->Payment_Status->CurrentValue;
				}
			} else {
				$invoices->Payment_Status->ViewValue = NULL;
			}
			$invoices->Payment_Status->CssStyle = "";
			$invoices->Payment_Status->CssClass = "";
			$invoices->Payment_Status->ViewCustomAttributes = "";

			// Status
			if (strval($invoices->Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$invoices->Status->ViewValue = $invoices->Status->CurrentValue;
				}
			} else {
				$invoices->Status->ViewValue = NULL;
			}
			$invoices->Status->CssStyle = "";
			$invoices->Status->CssClass = "";
			$invoices->Status->ViewCustomAttributes = "";

			// Recipient_Bank
			if (strval($invoices->Recipient_Bank->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Recipient_Bank->CurrentValue) . "";
			$sSqlWrk = "SELECT `Bank_Name`, `Account_Number` FROM `banks_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Bank_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Recipient_Bank->ViewValue = $rswrk->fields('Bank_Name');
					$invoices->Recipient_Bank->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('Account_Number');
					$rswrk->Close();
				} else {
					$invoices->Recipient_Bank->ViewValue = $invoices->Recipient_Bank->CurrentValue;
				}
			} else {
				$invoices->Recipient_Bank->ViewValue = NULL;
			}
			$invoices->Recipient_Bank->CssStyle = "";
			$invoices->Recipient_Bank->CssClass = "";
			$invoices->Recipient_Bank->ViewCustomAttributes = "";

			// Remarks
			$invoices->Remarks->ViewValue = $invoices->Remarks->CurrentValue;
			$invoices->Remarks->CssStyle = "";
			$invoices->Remarks->CssClass = "";
			$invoices->Remarks->ViewCustomAttributes = "";

			// User_ID
			$invoices->User_ID->ViewValue = $invoices->User_ID->CurrentValue;
			$invoices->User_ID->CssStyle = "";
			$invoices->User_ID->CssClass = "";
			$invoices->User_ID->ViewCustomAttributes = "";

			// created
			$invoices->created->ViewValue = $invoices->created->CurrentValue;
			$invoices->created->ViewValue = ew_FormatDateTime($invoices->created->ViewValue, 6);
			$invoices->created->CssStyle = "";
			$invoices->created->CssClass = "";
			$invoices->created->ViewCustomAttributes = "";

			// modified
			$invoices->modified->ViewValue = $invoices->modified->CurrentValue;
			$invoices->modified->ViewValue = ew_FormatDateTime($invoices->modified->ViewValue, 6);
			$invoices->modified->CssStyle = "";
			$invoices->modified->CssClass = "";
			$invoices->modified->ViewCustomAttributes = "";

			// id
			$invoices->id->HrefValue = "";
			$invoices->id->TooltipValue = "";

			// Invoice_Number
			$invoices->Invoice_Number->HrefValue = "";
			$invoices->Invoice_Number->TooltipValue = "";

			// Client_ID
			$invoices->Client_ID->HrefValue = "";
			$invoices->Client_ID->TooltipValue = "";

			// Invoice_Date
			$invoices->Invoice_Date->HrefValue = "";
			$invoices->Invoice_Date->TooltipValue = "";

			// Due_Date
			$invoices->Due_Date->HrefValue = "";
			$invoices->Due_Date->TooltipValue = "";

			// payment_period
			$invoices->payment_period->HrefValue = "";
			$invoices->payment_period->TooltipValue = "";

			// Total_Vat
			$invoices->Total_Vat->HrefValue = "";
			$invoices->Total_Vat->TooltipValue = "";

			// Total_WTax
			$invoices->Total_WTax->HrefValue = "";
			$invoices->Total_WTax->TooltipValue = "";

			// Total_Freight
			$invoices->Total_Freight->HrefValue = "";
			$invoices->Total_Freight->TooltipValue = "";

			// Total_Amount_Due
			$invoices->Total_Amount_Due->HrefValue = "";
			$invoices->Total_Amount_Due->TooltipValue = "";

			// Payment_Reference
			$invoices->Payment_Reference->HrefValue = "";
			$invoices->Payment_Reference->TooltipValue = "";

			// Payment_Status
			$invoices->Payment_Status->HrefValue = "";
			$invoices->Payment_Status->TooltipValue = "";

			// Status
			$invoices->Status->HrefValue = "";
			$invoices->Status->TooltipValue = "";

			// Recipient_Bank
			$invoices->Recipient_Bank->HrefValue = "";
			$invoices->Recipient_Bank->TooltipValue = "";

			// Remarks
			$invoices->Remarks->HrefValue = "";
			$invoices->Remarks->TooltipValue = "";

			// User_ID
			$invoices->User_ID->HrefValue = "";
			$invoices->User_ID->TooltipValue = "";

			// created
			$invoices->created->HrefValue = "";
			$invoices->created->TooltipValue = "";

			// modified
			$invoices->modified->HrefValue = "";
			$invoices->modified->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($invoices->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$invoices->Row_Rendered();
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
