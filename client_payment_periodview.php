<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "client_payment_periodinfo.php" ?>
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
$client_payment_period_view = new cclient_payment_period_view();
$Page =& $client_payment_period_view;

// Page init
$client_payment_period_view->Page_Init();

// Page main
$client_payment_period_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($client_payment_period->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var client_payment_period_view = new ew_Page("client_payment_period_view");

// page properties
client_payment_period_view.PageID = "view"; // page ID
client_payment_period_view.FormID = "fclient_payment_periodview"; // form ID
var EW_PAGE_ID = client_payment_period_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
client_payment_period_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
client_payment_period_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
client_payment_period_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $client_payment_period->TableCaption() ?>
<br><br>
<?php if ($client_payment_period->Export == "") { ?>
<a href="<?php echo $client_payment_period_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $client_payment_period_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $client_payment_period_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $client_payment_period_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $client_payment_period_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$client_payment_period_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($client_payment_period->id->Visible) { // id ?>
	<tr<?php echo $client_payment_period->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $client_payment_period->id->FldCaption() ?></td>
		<td<?php echo $client_payment_period->id->CellAttributes() ?>>
<div<?php echo $client_payment_period->id->ViewAttributes() ?>><?php echo $client_payment_period->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($client_payment_period->client_id->Visible) { // client_id ?>
	<tr<?php echo $client_payment_period->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $client_payment_period->client_id->FldCaption() ?></td>
		<td<?php echo $client_payment_period->client_id->CellAttributes() ?>>
<div<?php echo $client_payment_period->client_id->ViewAttributes() ?>><?php echo $client_payment_period->client_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($client_payment_period->payment_period->Visible) { // payment_period ?>
	<tr<?php echo $client_payment_period->payment_period->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $client_payment_period->payment_period->FldCaption() ?></td>
		<td<?php echo $client_payment_period->payment_period->CellAttributes() ?>>
<div<?php echo $client_payment_period->payment_period->ViewAttributes() ?>><?php echo $client_payment_period->payment_period->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($client_payment_period->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $client_payment_period->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $client_payment_period->Remarks->FldCaption() ?></td>
		<td<?php echo $client_payment_period->Remarks->CellAttributes() ?>>
<div<?php echo $client_payment_period->Remarks->ViewAttributes() ?>><?php echo $client_payment_period->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($client_payment_period->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$client_payment_period_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cclient_payment_period_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'client_payment_period';

	// Page object name
	var $PageObjName = 'client_payment_period_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $client_payment_period;
		if ($client_payment_period->UseTokenInUrl) $PageUrl .= "t=" . $client_payment_period->TableVar . "&"; // Add page token
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
		global $objForm, $client_payment_period;
		if ($client_payment_period->UseTokenInUrl) {
			if ($objForm)
				return ($client_payment_period->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($client_payment_period->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclient_payment_period_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (client_payment_period)
		$GLOBALS["client_payment_period"] = new cclient_payment_period();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'client_payment_period', TRUE);

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
		global $client_payment_period;

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
			$this->Page_Terminate("client_payment_periodlist.php");
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
		global $Language, $client_payment_period;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$client_payment_period->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $client_payment_period->id->QueryStringValue;
			} else {
				$sReturnUrl = "client_payment_periodlist.php"; // Return to list
			}

			// Get action
			$client_payment_period->CurrentAction = "I"; // Display form
			switch ($client_payment_period->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "client_payment_periodlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "client_payment_periodlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$client_payment_period->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $client_payment_period;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$client_payment_period->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$client_payment_period->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $client_payment_period->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$client_payment_period->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$client_payment_period->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$client_payment_period->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $client_payment_period;
		$sFilter = $client_payment_period->KeyFilter();

		// Call Row Selecting event
		$client_payment_period->Row_Selecting($sFilter);

		// Load SQL based on filter
		$client_payment_period->CurrentFilter = $sFilter;
		$sSql = $client_payment_period->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$client_payment_period->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $client_payment_period;
		$client_payment_period->id->setDbValue($rs->fields('id'));
		$client_payment_period->client_id->setDbValue($rs->fields('client_id'));
		$client_payment_period->payment_period->setDbValue($rs->fields('payment_period'));
		$client_payment_period->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $client_payment_period;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($client_payment_period->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($client_payment_period->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($client_payment_period->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($client_payment_period->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($client_payment_period->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($client_payment_period->id->CurrentValue);
		$this->AddUrl = $client_payment_period->AddUrl();
		$this->EditUrl = $client_payment_period->EditUrl();
		$this->CopyUrl = $client_payment_period->CopyUrl();
		$this->DeleteUrl = $client_payment_period->DeleteUrl();
		$this->ListUrl = $client_payment_period->ListUrl();

		// Call Row_Rendering event
		$client_payment_period->Row_Rendering();

		// Common render codes for all row types
		// id

		$client_payment_period->id->CellCssStyle = ""; $client_payment_period->id->CellCssClass = "";
		$client_payment_period->id->CellAttrs = array(); $client_payment_period->id->ViewAttrs = array(); $client_payment_period->id->EditAttrs = array();

		// client_id
		$client_payment_period->client_id->CellCssStyle = ""; $client_payment_period->client_id->CellCssClass = "";
		$client_payment_period->client_id->CellAttrs = array(); $client_payment_period->client_id->ViewAttrs = array(); $client_payment_period->client_id->EditAttrs = array();

		// payment_period
		$client_payment_period->payment_period->CellCssStyle = ""; $client_payment_period->payment_period->CellCssClass = "";
		$client_payment_period->payment_period->CellAttrs = array(); $client_payment_period->payment_period->ViewAttrs = array(); $client_payment_period->payment_period->EditAttrs = array();

		// Remarks
		$client_payment_period->Remarks->CellCssStyle = ""; $client_payment_period->Remarks->CellCssClass = "";
		$client_payment_period->Remarks->CellAttrs = array(); $client_payment_period->Remarks->ViewAttrs = array(); $client_payment_period->Remarks->EditAttrs = array();
		if ($client_payment_period->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$client_payment_period->id->ViewValue = $client_payment_period->id->CurrentValue;
			$client_payment_period->id->CssStyle = "";
			$client_payment_period->id->CssClass = "";
			$client_payment_period->id->ViewCustomAttributes = "";

			// client_id
			if (strval($client_payment_period->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($client_payment_period->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$client_payment_period->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$client_payment_period->client_id->ViewValue = $client_payment_period->client_id->CurrentValue;
				}
			} else {
				$client_payment_period->client_id->ViewValue = NULL;
			}
			$client_payment_period->client_id->CssStyle = "";
			$client_payment_period->client_id->CssClass = "";
			$client_payment_period->client_id->ViewCustomAttributes = "";

			// payment_period
			$client_payment_period->payment_period->ViewValue = $client_payment_period->payment_period->CurrentValue;
			$client_payment_period->payment_period->CssStyle = "";
			$client_payment_period->payment_period->CssClass = "";
			$client_payment_period->payment_period->ViewCustomAttributes = "";

			// Remarks
			$client_payment_period->Remarks->ViewValue = $client_payment_period->Remarks->CurrentValue;
			$client_payment_period->Remarks->CssStyle = "";
			$client_payment_period->Remarks->CssClass = "";
			$client_payment_period->Remarks->ViewCustomAttributes = "";

			// id
			$client_payment_period->id->HrefValue = "";
			$client_payment_period->id->TooltipValue = "";

			// client_id
			$client_payment_period->client_id->HrefValue = "";
			$client_payment_period->client_id->TooltipValue = "";

			// payment_period
			$client_payment_period->payment_period->HrefValue = "";
			$client_payment_period->payment_period->TooltipValue = "";

			// Remarks
			$client_payment_period->Remarks->HrefValue = "";
			$client_payment_period->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($client_payment_period->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$client_payment_period->Row_Rendered();
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
