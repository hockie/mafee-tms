<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "vendor_billinfo.php" ?>
<?php include "subconsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "vendor_bill_itemsinfo.php" ?>
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
$vendor_bill_view = new cvendor_bill_view();
$Page =& $vendor_bill_view;

// Page init
$vendor_bill_view->Page_Init();

// Page main
$vendor_bill_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($vendor_bill->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var vendor_bill_view = new ew_Page("vendor_bill_view");

// page properties
vendor_bill_view.PageID = "view"; // page ID
vendor_bill_view.FormID = "fvendor_billview"; // form ID
var EW_PAGE_ID = vendor_bill_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
vendor_bill_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
vendor_bill_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
vendor_bill_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
vendor_bill_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $vendor_bill->TableCaption() ?>
<br><br>
<?php if ($vendor_bill->Export == "") { ?>
<a href="<?php echo $vendor_bill_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $vendor_bill_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $vendor_bill_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $vendor_bill_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $vendor_bill_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('vendor_bill_items')) { ?>
<a href="vendor_bill_itemslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=vendor_bill&id=<?php echo urlencode(strval($vendor_bill->id->CurrentValue)) ?>&vendor_ID=<?php echo urlencode(strval($vendor_bill->vendor_ID->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("vendor_bill_items", "TblCaption") ?>
<?php echo str_replace("%c", $vendor_bill_view->lvendor_bill_items_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$vendor_bill_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($vendor_bill->id->Visible) { // id ?>
	<tr<?php echo $vendor_bill->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->id->FldCaption() ?></td>
		<td<?php echo $vendor_bill->id->CellAttributes() ?>>
<div<?php echo $vendor_bill->id->ViewAttributes() ?>><?php echo $vendor_bill->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->vendor_ID->Visible) { // vendor_ID ?>
	<tr<?php echo $vendor_bill->vendor_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->vendor_ID->FldCaption() ?></td>
		<td<?php echo $vendor_bill->vendor_ID->CellAttributes() ?>>
<div<?php echo $vendor_bill->vendor_ID->ViewAttributes() ?>><?php echo $vendor_bill->vendor_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->vendor_Number->Visible) { // vendor_Number ?>
	<tr<?php echo $vendor_bill->vendor_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->vendor_Number->FldCaption() ?></td>
		<td<?php echo $vendor_bill->vendor_Number->CellAttributes() ?>>
<div<?php echo $vendor_bill->vendor_Number->ViewAttributes() ?>><?php echo $vendor_bill->vendor_Number->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Billing_Date->Visible) { // Billing_Date ?>
	<tr<?php echo $vendor_bill->Billing_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Billing_Date->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Billing_Date->CellAttributes() ?>>
<div<?php echo $vendor_bill->Billing_Date->ViewAttributes() ?>><?php echo $vendor_bill->Billing_Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Due_Date->Visible) { // Due_Date ?>
	<tr<?php echo $vendor_bill->Due_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Due_Date->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Due_Date->CellAttributes() ?>>
<div<?php echo $vendor_bill->Due_Date->ViewAttributes() ?>><?php echo $vendor_bill->Due_Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Total_Vat->Visible) { // Total_Vat ?>
	<tr<?php echo $vendor_bill->Total_Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Total_Vat->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Total_Vat->CellAttributes() ?>>
<div<?php echo $vendor_bill->Total_Vat->ViewAttributes() ?>><?php echo $vendor_bill->Total_Vat->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Total_WTax->Visible) { // Total_WTax ?>
	<tr<?php echo $vendor_bill->Total_WTax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Total_WTax->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Total_WTax->CellAttributes() ?>>
<div<?php echo $vendor_bill->Total_WTax->ViewAttributes() ?>><?php echo $vendor_bill->Total_WTax->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Total_Freight->Visible) { // Total_Freight ?>
	<tr<?php echo $vendor_bill->Total_Freight->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Total_Freight->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Total_Freight->CellAttributes() ?>>
<div<?php echo $vendor_bill->Total_Freight->ViewAttributes() ?>><?php echo $vendor_bill->Total_Freight->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<tr<?php echo $vendor_bill->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $vendor_bill->Total_Amount_Due->ViewAttributes() ?>><?php echo $vendor_bill->Total_Amount_Due->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Bill_Reference->Visible) { // Bill_Reference ?>
	<tr<?php echo $vendor_bill->Bill_Reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Bill_Reference->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Bill_Reference->CellAttributes() ?>>
<div<?php echo $vendor_bill->Bill_Reference->ViewAttributes() ?>><?php echo $vendor_bill->Bill_Reference->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->payment_method_id->Visible) { // payment_method_id ?>
	<tr<?php echo $vendor_bill->payment_method_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->payment_method_id->FldCaption() ?></td>
		<td<?php echo $vendor_bill->payment_method_id->CellAttributes() ?>>
<div<?php echo $vendor_bill->payment_method_id->ViewAttributes() ?>><?php echo $vendor_bill->payment_method_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Payment_Status->Visible) { // Payment_Status ?>
	<tr<?php echo $vendor_bill->Payment_Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Payment_Status->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Payment_Status->CellAttributes() ?>>
<div<?php echo $vendor_bill->Payment_Status->ViewAttributes() ?>><?php echo $vendor_bill->Payment_Status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Status->Visible) { // Status ?>
	<tr<?php echo $vendor_bill->Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Status->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Status->CellAttributes() ?>>
<div<?php echo $vendor_bill->Status->ViewAttributes() ?>><?php echo $vendor_bill->Status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $vendor_bill->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Remarks->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Remarks->CellAttributes() ?>>
<div<?php echo $vendor_bill->Remarks->ViewAttributes() ?>><?php echo $vendor_bill->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->User_ID->Visible) { // User_ID ?>
	<tr<?php echo $vendor_bill->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->User_ID->FldCaption() ?></td>
		<td<?php echo $vendor_bill->User_ID->CellAttributes() ?>>
<div<?php echo $vendor_bill->User_ID->ViewAttributes() ?>><?php echo $vendor_bill->User_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->created->Visible) { // created ?>
	<tr<?php echo $vendor_bill->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->created->FldCaption() ?></td>
		<td<?php echo $vendor_bill->created->CellAttributes() ?>>
<div<?php echo $vendor_bill->created->ViewAttributes() ?>><?php echo $vendor_bill->created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->modified->Visible) { // modified ?>
	<tr<?php echo $vendor_bill->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->modified->FldCaption() ?></td>
		<td<?php echo $vendor_bill->modified->CellAttributes() ?>>
<div<?php echo $vendor_bill->modified->ViewAttributes() ?>><?php echo $vendor_bill->modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($vendor_bill->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$vendor_bill_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cvendor_bill_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'vendor_bill';

	// Page object name
	var $PageObjName = 'vendor_bill_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $vendor_bill;
		if ($vendor_bill->UseTokenInUrl) $PageUrl .= "t=" . $vendor_bill->TableVar . "&"; // Add page token
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
		global $objForm, $vendor_bill;
		if ($vendor_bill->UseTokenInUrl) {
			if ($objForm)
				return ($vendor_bill->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($vendor_bill->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cvendor_bill_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (vendor_bill)
		$GLOBALS["vendor_bill"] = new cvendor_bill();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (vendor_bill_items)
		$GLOBALS['vendor_bill_items'] = new cvendor_bill_items();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'vendor_bill', TRUE);

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
		global $vendor_bill;

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
			$this->Page_Terminate("vendor_billlist.php");
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
	var $lvendor_bill_items_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $vendor_bill;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$vendor_bill->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $vendor_bill->id->QueryStringValue;
			} else {
				$sReturnUrl = "vendor_billlist.php"; // Return to list
			}

			// Get action
			$vendor_bill->CurrentAction = "I"; // Display form
			switch ($vendor_bill->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "vendor_billlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "vendor_billlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$vendor_bill->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $vendor_bill;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$vendor_bill->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$vendor_bill->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $vendor_bill->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$vendor_bill->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$vendor_bill->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$vendor_bill->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $vendor_bill;
		$sFilter = $vendor_bill->KeyFilter();

		// Call Row Selecting event
		$vendor_bill->Row_Selecting($sFilter);

		// Load SQL based on filter
		$vendor_bill->CurrentFilter = $sFilter;
		$sSql = $vendor_bill->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$vendor_bill->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $vendor_bill;
		$vendor_bill->id->setDbValue($rs->fields('id'));
		$vendor_bill->vendor_ID->setDbValue($rs->fields('vendor_ID'));
		$vendor_bill->vendor_Number->setDbValue($rs->fields('vendor_Number'));
		$vendor_bill->Billing_Date->setDbValue($rs->fields('Billing_Date'));
		$vendor_bill->Due_Date->setDbValue($rs->fields('Due_Date'));
		$vendor_bill->Total_Vat->setDbValue($rs->fields('Total_Vat'));
		$vendor_bill->Total_WTax->setDbValue($rs->fields('Total_WTax'));
		$vendor_bill->Total_Freight->setDbValue($rs->fields('Total_Freight'));
		$vendor_bill->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$vendor_bill->Bill_Reference->setDbValue($rs->fields('Bill_Reference'));
		$vendor_bill->payment_method_id->setDbValue($rs->fields('payment_method_id'));
		$vendor_bill->Payment_Status->setDbValue($rs->fields('Payment_Status'));
		$vendor_bill->Status->setDbValue($rs->fields('Status'));
		$vendor_bill->Remarks->setDbValue($rs->fields('Remarks'));
		$vendor_bill->User_ID->setDbValue($rs->fields('User_ID'));
		$vendor_bill->created->setDbValue($rs->fields('created'));
		$vendor_bill->modified->setDbValue($rs->fields('modified'));
		$sDetailFilter = $GLOBALS["vendor_bill_items"]->SqlDetailFilter_vendor_bill();
		$sDetailFilter = str_replace("@vendor_bill_id@", ew_AdjustSql($vendor_bill->id->DbValue), $sDetailFilter);
		$sDetailFilter = str_replace("@vendor_id@", ew_AdjustSql($vendor_bill->vendor_ID->DbValue), $sDetailFilter);
		$this->lvendor_bill_items_Count = $GLOBALS["vendor_bill_items"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $vendor_bill;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($vendor_bill->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($vendor_bill->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($vendor_bill->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($vendor_bill->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($vendor_bill->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($vendor_bill->id->CurrentValue);
		$this->AddUrl = $vendor_bill->AddUrl();
		$this->EditUrl = $vendor_bill->EditUrl();
		$this->CopyUrl = $vendor_bill->CopyUrl();
		$this->DeleteUrl = $vendor_bill->DeleteUrl();
		$this->ListUrl = $vendor_bill->ListUrl();

		// Call Row_Rendering event
		$vendor_bill->Row_Rendering();

		// Common render codes for all row types
		// id

		$vendor_bill->id->CellCssStyle = ""; $vendor_bill->id->CellCssClass = "";
		$vendor_bill->id->CellAttrs = array(); $vendor_bill->id->ViewAttrs = array(); $vendor_bill->id->EditAttrs = array();

		// vendor_ID
		$vendor_bill->vendor_ID->CellCssStyle = ""; $vendor_bill->vendor_ID->CellCssClass = "";
		$vendor_bill->vendor_ID->CellAttrs = array(); $vendor_bill->vendor_ID->ViewAttrs = array(); $vendor_bill->vendor_ID->EditAttrs = array();

		// vendor_Number
		$vendor_bill->vendor_Number->CellCssStyle = ""; $vendor_bill->vendor_Number->CellCssClass = "";
		$vendor_bill->vendor_Number->CellAttrs = array(); $vendor_bill->vendor_Number->ViewAttrs = array(); $vendor_bill->vendor_Number->EditAttrs = array();

		// Billing_Date
		$vendor_bill->Billing_Date->CellCssStyle = ""; $vendor_bill->Billing_Date->CellCssClass = "";
		$vendor_bill->Billing_Date->CellAttrs = array(); $vendor_bill->Billing_Date->ViewAttrs = array(); $vendor_bill->Billing_Date->EditAttrs = array();

		// Due_Date
		$vendor_bill->Due_Date->CellCssStyle = ""; $vendor_bill->Due_Date->CellCssClass = "";
		$vendor_bill->Due_Date->CellAttrs = array(); $vendor_bill->Due_Date->ViewAttrs = array(); $vendor_bill->Due_Date->EditAttrs = array();

		// Total_Vat
		$vendor_bill->Total_Vat->CellCssStyle = ""; $vendor_bill->Total_Vat->CellCssClass = "";
		$vendor_bill->Total_Vat->CellAttrs = array(); $vendor_bill->Total_Vat->ViewAttrs = array(); $vendor_bill->Total_Vat->EditAttrs = array();

		// Total_WTax
		$vendor_bill->Total_WTax->CellCssStyle = ""; $vendor_bill->Total_WTax->CellCssClass = "";
		$vendor_bill->Total_WTax->CellAttrs = array(); $vendor_bill->Total_WTax->ViewAttrs = array(); $vendor_bill->Total_WTax->EditAttrs = array();

		// Total_Freight
		$vendor_bill->Total_Freight->CellCssStyle = ""; $vendor_bill->Total_Freight->CellCssClass = "";
		$vendor_bill->Total_Freight->CellAttrs = array(); $vendor_bill->Total_Freight->ViewAttrs = array(); $vendor_bill->Total_Freight->EditAttrs = array();

		// Total_Amount_Due
		$vendor_bill->Total_Amount_Due->CellCssStyle = ""; $vendor_bill->Total_Amount_Due->CellCssClass = "";
		$vendor_bill->Total_Amount_Due->CellAttrs = array(); $vendor_bill->Total_Amount_Due->ViewAttrs = array(); $vendor_bill->Total_Amount_Due->EditAttrs = array();

		// Bill_Reference
		$vendor_bill->Bill_Reference->CellCssStyle = ""; $vendor_bill->Bill_Reference->CellCssClass = "";
		$vendor_bill->Bill_Reference->CellAttrs = array(); $vendor_bill->Bill_Reference->ViewAttrs = array(); $vendor_bill->Bill_Reference->EditAttrs = array();

		// payment_method_id
		$vendor_bill->payment_method_id->CellCssStyle = ""; $vendor_bill->payment_method_id->CellCssClass = "";
		$vendor_bill->payment_method_id->CellAttrs = array(); $vendor_bill->payment_method_id->ViewAttrs = array(); $vendor_bill->payment_method_id->EditAttrs = array();

		// Payment_Status
		$vendor_bill->Payment_Status->CellCssStyle = ""; $vendor_bill->Payment_Status->CellCssClass = "";
		$vendor_bill->Payment_Status->CellAttrs = array(); $vendor_bill->Payment_Status->ViewAttrs = array(); $vendor_bill->Payment_Status->EditAttrs = array();

		// Status
		$vendor_bill->Status->CellCssStyle = ""; $vendor_bill->Status->CellCssClass = "";
		$vendor_bill->Status->CellAttrs = array(); $vendor_bill->Status->ViewAttrs = array(); $vendor_bill->Status->EditAttrs = array();

		// Remarks
		$vendor_bill->Remarks->CellCssStyle = ""; $vendor_bill->Remarks->CellCssClass = "";
		$vendor_bill->Remarks->CellAttrs = array(); $vendor_bill->Remarks->ViewAttrs = array(); $vendor_bill->Remarks->EditAttrs = array();

		// User_ID
		$vendor_bill->User_ID->CellCssStyle = ""; $vendor_bill->User_ID->CellCssClass = "";
		$vendor_bill->User_ID->CellAttrs = array(); $vendor_bill->User_ID->ViewAttrs = array(); $vendor_bill->User_ID->EditAttrs = array();

		// created
		$vendor_bill->created->CellCssStyle = ""; $vendor_bill->created->CellCssClass = "";
		$vendor_bill->created->CellAttrs = array(); $vendor_bill->created->ViewAttrs = array(); $vendor_bill->created->EditAttrs = array();

		// modified
		$vendor_bill->modified->CellCssStyle = ""; $vendor_bill->modified->CellCssClass = "";
		$vendor_bill->modified->CellAttrs = array(); $vendor_bill->modified->ViewAttrs = array(); $vendor_bill->modified->EditAttrs = array();
		if ($vendor_bill->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$vendor_bill->id->ViewValue = $vendor_bill->id->CurrentValue;
			$vendor_bill->id->CssStyle = "";
			$vendor_bill->id->CssClass = "";
			$vendor_bill->id->ViewCustomAttributes = "";

			// vendor_ID
			if (strval($vendor_bill->vendor_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill->vendor_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill->vendor_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$vendor_bill->vendor_ID->ViewValue = $vendor_bill->vendor_ID->CurrentValue;
				}
			} else {
				$vendor_bill->vendor_ID->ViewValue = NULL;
			}
			$vendor_bill->vendor_ID->CssStyle = "";
			$vendor_bill->vendor_ID->CssClass = "";
			$vendor_bill->vendor_ID->ViewCustomAttributes = "";

			// vendor_Number
			$vendor_bill->vendor_Number->ViewValue = $vendor_bill->vendor_Number->CurrentValue;
			$vendor_bill->vendor_Number->CssStyle = "";
			$vendor_bill->vendor_Number->CssClass = "";
			$vendor_bill->vendor_Number->ViewCustomAttributes = "";

			// Billing_Date
			$vendor_bill->Billing_Date->ViewValue = $vendor_bill->Billing_Date->CurrentValue;
			$vendor_bill->Billing_Date->ViewValue = ew_FormatDateTime($vendor_bill->Billing_Date->ViewValue, 6);
			$vendor_bill->Billing_Date->CssStyle = "";
			$vendor_bill->Billing_Date->CssClass = "";
			$vendor_bill->Billing_Date->ViewCustomAttributes = "";

			// Due_Date
			$vendor_bill->Due_Date->ViewValue = $vendor_bill->Due_Date->CurrentValue;
			$vendor_bill->Due_Date->ViewValue = ew_FormatDateTime($vendor_bill->Due_Date->ViewValue, 6);
			$vendor_bill->Due_Date->CssStyle = "";
			$vendor_bill->Due_Date->CssClass = "";
			$vendor_bill->Due_Date->ViewCustomAttributes = "";

			// Total_Vat
			$vendor_bill->Total_Vat->ViewValue = $vendor_bill->Total_Vat->CurrentValue;
			$vendor_bill->Total_Vat->CssStyle = "";
			$vendor_bill->Total_Vat->CssClass = "";
			$vendor_bill->Total_Vat->ViewCustomAttributes = "";

			// Total_WTax
			$vendor_bill->Total_WTax->ViewValue = $vendor_bill->Total_WTax->CurrentValue;
			$vendor_bill->Total_WTax->CssStyle = "";
			$vendor_bill->Total_WTax->CssClass = "";
			$vendor_bill->Total_WTax->ViewCustomAttributes = "";

			// Total_Freight
			$vendor_bill->Total_Freight->ViewValue = $vendor_bill->Total_Freight->CurrentValue;
			$vendor_bill->Total_Freight->CssStyle = "";
			$vendor_bill->Total_Freight->CssClass = "";
			$vendor_bill->Total_Freight->ViewCustomAttributes = "";

			// Total_Amount_Due
			$vendor_bill->Total_Amount_Due->ViewValue = $vendor_bill->Total_Amount_Due->CurrentValue;
			$vendor_bill->Total_Amount_Due->CssStyle = "";
			$vendor_bill->Total_Amount_Due->CssClass = "";
			$vendor_bill->Total_Amount_Due->ViewCustomAttributes = "";

			// Bill_Reference
			$vendor_bill->Bill_Reference->ViewValue = $vendor_bill->Bill_Reference->CurrentValue;
			$vendor_bill->Bill_Reference->CssStyle = "";
			$vendor_bill->Bill_Reference->CssClass = "";
			$vendor_bill->Bill_Reference->ViewCustomAttributes = "";

			// payment_method_id
			if (strval($vendor_bill->payment_method_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill->payment_method_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Payment_Method` FROM `account_payment_methods`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill->payment_method_id->ViewValue = $rswrk->fields('Payment_Method');
					$rswrk->Close();
				} else {
					$vendor_bill->payment_method_id->ViewValue = $vendor_bill->payment_method_id->CurrentValue;
				}
			} else {
				$vendor_bill->payment_method_id->ViewValue = NULL;
			}
			$vendor_bill->payment_method_id->CssStyle = "";
			$vendor_bill->payment_method_id->CssClass = "";
			$vendor_bill->payment_method_id->ViewCustomAttributes = "";

			// Payment_Status
			if (strval($vendor_bill->Payment_Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill->Payment_Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill->Payment_Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$vendor_bill->Payment_Status->ViewValue = $vendor_bill->Payment_Status->CurrentValue;
				}
			} else {
				$vendor_bill->Payment_Status->ViewValue = NULL;
			}
			$vendor_bill->Payment_Status->CssStyle = "";
			$vendor_bill->Payment_Status->CssClass = "";
			$vendor_bill->Payment_Status->ViewCustomAttributes = "";

			// Status
			if (strval($vendor_bill->Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill->Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill->Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$vendor_bill->Status->ViewValue = $vendor_bill->Status->CurrentValue;
				}
			} else {
				$vendor_bill->Status->ViewValue = NULL;
			}
			$vendor_bill->Status->CssStyle = "";
			$vendor_bill->Status->CssClass = "";
			$vendor_bill->Status->ViewCustomAttributes = "";

			// Remarks
			$vendor_bill->Remarks->ViewValue = $vendor_bill->Remarks->CurrentValue;
			$vendor_bill->Remarks->CssStyle = "";
			$vendor_bill->Remarks->CssClass = "";
			$vendor_bill->Remarks->ViewCustomAttributes = "";

			// User_ID
			$vendor_bill->User_ID->ViewValue = $vendor_bill->User_ID->CurrentValue;
			$vendor_bill->User_ID->CssStyle = "";
			$vendor_bill->User_ID->CssClass = "";
			$vendor_bill->User_ID->ViewCustomAttributes = "";

			// created
			$vendor_bill->created->ViewValue = $vendor_bill->created->CurrentValue;
			$vendor_bill->created->ViewValue = ew_FormatDateTime($vendor_bill->created->ViewValue, 6);
			$vendor_bill->created->CssStyle = "";
			$vendor_bill->created->CssClass = "";
			$vendor_bill->created->ViewCustomAttributes = "";

			// modified
			$vendor_bill->modified->ViewValue = $vendor_bill->modified->CurrentValue;
			$vendor_bill->modified->ViewValue = ew_FormatDateTime($vendor_bill->modified->ViewValue, 6);
			$vendor_bill->modified->CssStyle = "";
			$vendor_bill->modified->CssClass = "";
			$vendor_bill->modified->ViewCustomAttributes = "";

			// id
			$vendor_bill->id->HrefValue = "";
			$vendor_bill->id->TooltipValue = "";

			// vendor_ID
			$vendor_bill->vendor_ID->HrefValue = "";
			$vendor_bill->vendor_ID->TooltipValue = "";

			// vendor_Number
			$vendor_bill->vendor_Number->HrefValue = "";
			$vendor_bill->vendor_Number->TooltipValue = "";

			// Billing_Date
			$vendor_bill->Billing_Date->HrefValue = "";
			$vendor_bill->Billing_Date->TooltipValue = "";

			// Due_Date
			$vendor_bill->Due_Date->HrefValue = "";
			$vendor_bill->Due_Date->TooltipValue = "";

			// Total_Vat
			$vendor_bill->Total_Vat->HrefValue = "";
			$vendor_bill->Total_Vat->TooltipValue = "";

			// Total_WTax
			$vendor_bill->Total_WTax->HrefValue = "";
			$vendor_bill->Total_WTax->TooltipValue = "";

			// Total_Freight
			$vendor_bill->Total_Freight->HrefValue = "";
			$vendor_bill->Total_Freight->TooltipValue = "";

			// Total_Amount_Due
			$vendor_bill->Total_Amount_Due->HrefValue = "";
			$vendor_bill->Total_Amount_Due->TooltipValue = "";

			// Bill_Reference
			$vendor_bill->Bill_Reference->HrefValue = "";
			$vendor_bill->Bill_Reference->TooltipValue = "";

			// payment_method_id
			$vendor_bill->payment_method_id->HrefValue = "";
			$vendor_bill->payment_method_id->TooltipValue = "";

			// Payment_Status
			$vendor_bill->Payment_Status->HrefValue = "";
			$vendor_bill->Payment_Status->TooltipValue = "";

			// Status
			$vendor_bill->Status->HrefValue = "";
			$vendor_bill->Status->TooltipValue = "";

			// Remarks
			$vendor_bill->Remarks->HrefValue = "";
			$vendor_bill->Remarks->TooltipValue = "";

			// User_ID
			$vendor_bill->User_ID->HrefValue = "";
			$vendor_bill->User_ID->TooltipValue = "";

			// created
			$vendor_bill->created->HrefValue = "";
			$vendor_bill->created->TooltipValue = "";

			// modified
			$vendor_bill->modified->HrefValue = "";
			$vendor_bill->modified->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($vendor_bill->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$vendor_bill->Row_Rendered();
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
