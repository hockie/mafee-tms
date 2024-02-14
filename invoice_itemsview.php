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
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$invoice_items_view = new cinvoice_items_view();
$Page =& $invoice_items_view;

// Page init
$invoice_items_view->Page_Init();

// Page main
$invoice_items_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($invoice_items->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var invoice_items_view = new ew_Page("invoice_items_view");

// page properties
invoice_items_view.PageID = "view"; // page ID
invoice_items_view.FormID = "finvoice_itemsview"; // form ID
var EW_PAGE_ID = invoice_items_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
invoice_items_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoice_items_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoice_items_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoice_items_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoice_items->TableCaption() ?>
<br><br>
<?php if ($invoice_items->Export == "") { ?>
<a href="<?php echo $invoice_items_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $invoice_items_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $invoice_items_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $invoice_items_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $invoice_items_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('expenses')) { ?>
<a href="expenseslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=invoice_items&booking_id=<?php echo urlencode(strval($invoice_items->booking_id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("expenses", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoice_items_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($invoice_items->id->Visible) { // id ?>
	<tr<?php echo $invoice_items->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->id->FldCaption() ?></td>
		<td<?php echo $invoice_items->id->CellAttributes() ?>>
<div<?php echo $invoice_items->id->ViewAttributes() ?>><?php echo $invoice_items->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoice_items->invoice_id->Visible) { // invoice_id ?>
	<tr<?php echo $invoice_items->invoice_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->invoice_id->FldCaption() ?></td>
		<td<?php echo $invoice_items->invoice_id->CellAttributes() ?>>
<div<?php echo $invoice_items->invoice_id->ViewAttributes() ?>><?php echo $invoice_items->invoice_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoice_items->client_id->Visible) { // client_id ?>
	<tr<?php echo $invoice_items->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->client_id->FldCaption() ?></td>
		<td<?php echo $invoice_items->client_id->CellAttributes() ?>>
<div<?php echo $invoice_items->client_id->ViewAttributes() ?>><?php echo $invoice_items->client_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($invoice_items->booking_id->Visible) { // booking_id ?>
	<tr<?php echo $invoice_items->booking_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->booking_id->FldCaption() ?></td>
		<td<?php echo $invoice_items->booking_id->CellAttributes() ?>>
<div<?php echo $invoice_items->booking_id->ViewAttributes() ?>>
<?php if ($invoice_items->booking_id->HrefValue <> "" || $invoice_items->booking_id->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_id=<?php echo $invoice_items->booking_id->HrefValue ?>"><?php echo $invoice_items->booking_id->ViewValue ?></a>
<?php } else { ?>
<?php echo $invoice_items->booking_id->ViewValue ?>
<?php } ?>
</div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($invoice_items->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$invoice_items_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoice_items_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'invoice_items';

	// Page object name
	var $PageObjName = 'invoice_items_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $invoice_items;
		if ($invoice_items->UseTokenInUrl) $PageUrl .= "t=" . $invoice_items->TableVar . "&"; // Add page token
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
		global $objForm, $invoice_items;
		if ($invoice_items->UseTokenInUrl) {
			if ($objForm)
				return ($invoice_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($invoice_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinvoice_items_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (invoice_items)
		$GLOBALS["invoice_items"] = new cinvoice_items();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoices)
		$GLOBALS['invoices'] = new cinvoices();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'invoice_items', TRUE);

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
		global $invoice_items;

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
			$this->Page_Terminate("invoice_itemslist.php");
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
		global $Language, $invoice_items;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$invoice_items->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $invoice_items->id->QueryStringValue;
			} else {
				$sReturnUrl = "invoice_itemslist.php"; // Return to list
			}

			// Get action
			$invoice_items->CurrentAction = "I"; // Display form
			switch ($invoice_items->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "invoice_itemslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "invoice_itemslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$invoice_items->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $invoice_items;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$invoice_items->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$invoice_items->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $invoice_items->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$invoice_items->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$invoice_items->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$invoice_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $invoice_items;
		$sFilter = $invoice_items->KeyFilter();

		// Call Row Selecting event
		$invoice_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$invoice_items->CurrentFilter = $sFilter;
		$sSql = $invoice_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$invoice_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $invoice_items;
		$invoice_items->id->setDbValue($rs->fields('id'));
		$invoice_items->invoice_id->setDbValue($rs->fields('invoice_id'));
		$invoice_items->client_id->setDbValue($rs->fields('client_id'));
		$invoice_items->booking_id->setDbValue($rs->fields('booking_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $invoice_items;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($invoice_items->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($invoice_items->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($invoice_items->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($invoice_items->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($invoice_items->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($invoice_items->id->CurrentValue);
		$this->AddUrl = $invoice_items->AddUrl();
		$this->EditUrl = $invoice_items->EditUrl();
		$this->CopyUrl = $invoice_items->CopyUrl();
		$this->DeleteUrl = $invoice_items->DeleteUrl();
		$this->ListUrl = $invoice_items->ListUrl();

		// Call Row_Rendering event
		$invoice_items->Row_Rendering();

		// Common render codes for all row types
		// id

		$invoice_items->id->CellCssStyle = ""; $invoice_items->id->CellCssClass = "";
		$invoice_items->id->CellAttrs = array(); $invoice_items->id->ViewAttrs = array(); $invoice_items->id->EditAttrs = array();

		// invoice_id
		$invoice_items->invoice_id->CellCssStyle = ""; $invoice_items->invoice_id->CellCssClass = "";
		$invoice_items->invoice_id->CellAttrs = array(); $invoice_items->invoice_id->ViewAttrs = array(); $invoice_items->invoice_id->EditAttrs = array();

		// client_id
		$invoice_items->client_id->CellCssStyle = ""; $invoice_items->client_id->CellCssClass = "";
		$invoice_items->client_id->CellAttrs = array(); $invoice_items->client_id->ViewAttrs = array(); $invoice_items->client_id->EditAttrs = array();

		// booking_id
		$invoice_items->booking_id->CellCssStyle = ""; $invoice_items->booking_id->CellCssClass = "";
		$invoice_items->booking_id->CellAttrs = array(); $invoice_items->booking_id->ViewAttrs = array(); $invoice_items->booking_id->EditAttrs = array();
		if ($invoice_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$invoice_items->id->ViewValue = $invoice_items->id->CurrentValue;
			$invoice_items->id->CssStyle = "";
			$invoice_items->id->CssClass = "";
			$invoice_items->id->ViewCustomAttributes = "";

			// invoice_id
			$invoice_items->invoice_id->ViewValue = $invoice_items->invoice_id->CurrentValue;
			$invoice_items->invoice_id->CssStyle = "";
			$invoice_items->invoice_id->CssClass = "";
			$invoice_items->invoice_id->ViewCustomAttributes = "";

			// client_id
			$invoice_items->client_id->ViewValue = $invoice_items->client_id->CurrentValue;
			$invoice_items->client_id->CssStyle = "";
			$invoice_items->client_id->CssClass = "";
			$invoice_items->client_id->ViewCustomAttributes = "";

			// booking_id
			if (strval($invoice_items->booking_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->booking_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Client_ID`=" . $invoice_items->client_id->ViewValue . " AND `Status_ID`=" . 2 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Booking_Number` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->booking_id->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$invoice_items->booking_id->ViewValue = $invoice_items->booking_id->CurrentValue;
				}
			} else {
				$invoice_items->booking_id->ViewValue = NULL;
			}
			$invoice_items->booking_id->CssStyle = "";
			$invoice_items->booking_id->CssClass = "";
			$invoice_items->booking_id->ViewCustomAttributes = "";

			// id
			$invoice_items->id->HrefValue = "";
			$invoice_items->id->TooltipValue = "";

			// invoice_id
			$invoice_items->invoice_id->HrefValue = "";
			$invoice_items->invoice_id->TooltipValue = "";

			// client_id
			$invoice_items->client_id->HrefValue = "";
			$invoice_items->client_id->TooltipValue = "";

			// booking_id
			if (!ew_Empty($invoice_items->booking_id->CurrentValue)) {
				$invoice_items->booking_id->HrefValue = $invoice_items->booking_id->CurrentValue;
				if ($invoice_items->Export <> "") $invoice_items->booking_id->HrefValue = ew_ConvertFullUrl($invoice_items->booking_id->HrefValue);
			} else {
				$invoice_items->booking_id->HrefValue = "";
			}
			$invoice_items->booking_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($invoice_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$invoice_items->Row_Rendered();
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
