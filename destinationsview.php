<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "destinationsinfo.php" ?>
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
$destinations_view = new cdestinations_view();
$Page =& $destinations_view;

// Page init
$destinations_view->Page_Init();

// Page main
$destinations_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($destinations->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var destinations_view = new ew_Page("destinations_view");

// page properties
destinations_view.PageID = "view"; // page ID
destinations_view.FormID = "fdestinationsview"; // form ID
var EW_PAGE_ID = destinations_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
destinations_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
destinations_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
destinations_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
destinations_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $destinations->TableCaption() ?>
<br><br>
<?php if ($destinations->Export == "") { ?>
<a href="<?php echo $destinations_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $destinations_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $destinations_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $destinations_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$destinations_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($destinations->id->Visible) { // id ?>
	<tr<?php echo $destinations->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $destinations->id->FldCaption() ?></td>
		<td<?php echo $destinations->id->CellAttributes() ?>>
<div<?php echo $destinations->id->ViewAttributes() ?>><?php echo $destinations->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($destinations->Destination->Visible) { // Destination ?>
	<tr<?php echo $destinations->Destination->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $destinations->Destination->FldCaption() ?></td>
		<td<?php echo $destinations->Destination->CellAttributes() ?>>
<div<?php echo $destinations->Destination->ViewAttributes() ?>><?php echo $destinations->Destination->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($destinations->Client->Visible) { // Client ?>
	<tr<?php echo $destinations->Client->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $destinations->Client->FldCaption() ?></td>
		<td<?php echo $destinations->Client->CellAttributes() ?>>
<div<?php echo $destinations->Client->ViewAttributes() ?>><?php echo $destinations->Client->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($destinations->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$destinations_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cdestinations_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'destinations';

	// Page object name
	var $PageObjName = 'destinations_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $destinations;
		if ($destinations->UseTokenInUrl) $PageUrl .= "t=" . $destinations->TableVar . "&"; // Add page token
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
		global $objForm, $destinations;
		if ($destinations->UseTokenInUrl) {
			if ($objForm)
				return ($destinations->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($destinations->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdestinations_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (destinations)
		$GLOBALS["destinations"] = new cdestinations();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'destinations', TRUE);

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
		global $destinations;

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
			$this->Page_Terminate("destinationslist.php");
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
		global $Language, $destinations;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$destinations->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $destinations->id->QueryStringValue;
			} else {
				$sReturnUrl = "destinationslist.php"; // Return to list
			}

			// Get action
			$destinations->CurrentAction = "I"; // Display form
			switch ($destinations->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "destinationslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "destinationslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$destinations->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $destinations;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$destinations->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$destinations->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $destinations->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$destinations->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$destinations->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$destinations->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $destinations;
		$sFilter = $destinations->KeyFilter();

		// Call Row Selecting event
		$destinations->Row_Selecting($sFilter);

		// Load SQL based on filter
		$destinations->CurrentFilter = $sFilter;
		$sSql = $destinations->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$destinations->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $destinations;
		$destinations->id->setDbValue($rs->fields('id'));
		$destinations->Destination->setDbValue($rs->fields('Destination'));
		$destinations->Client->setDbValue($rs->fields('Client'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $destinations;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($destinations->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($destinations->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($destinations->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($destinations->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($destinations->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($destinations->id->CurrentValue);
		$this->AddUrl = $destinations->AddUrl();
		$this->EditUrl = $destinations->EditUrl();
		$this->CopyUrl = $destinations->CopyUrl();
		$this->DeleteUrl = $destinations->DeleteUrl();
		$this->ListUrl = $destinations->ListUrl();

		// Call Row_Rendering event
		$destinations->Row_Rendering();

		// Common render codes for all row types
		// id

		$destinations->id->CellCssStyle = ""; $destinations->id->CellCssClass = "";
		$destinations->id->CellAttrs = array(); $destinations->id->ViewAttrs = array(); $destinations->id->EditAttrs = array();

		// Destination
		$destinations->Destination->CellCssStyle = ""; $destinations->Destination->CellCssClass = "";
		$destinations->Destination->CellAttrs = array(); $destinations->Destination->ViewAttrs = array(); $destinations->Destination->EditAttrs = array();

		// Client
		$destinations->Client->CellCssStyle = ""; $destinations->Client->CellCssClass = "";
		$destinations->Client->CellAttrs = array(); $destinations->Client->ViewAttrs = array(); $destinations->Client->EditAttrs = array();
		if ($destinations->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$destinations->id->ViewValue = $destinations->id->CurrentValue;
			$destinations->id->CssStyle = "";
			$destinations->id->CssClass = "";
			$destinations->id->ViewCustomAttributes = "";

			// Destination
			$destinations->Destination->ViewValue = $destinations->Destination->CurrentValue;
			$destinations->Destination->CssStyle = "";
			$destinations->Destination->CssClass = "";
			$destinations->Destination->ViewCustomAttributes = "";

			// Client
			if (strval($destinations->Client->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($destinations->Client->CurrentValue) . "";
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
					$destinations->Client->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$destinations->Client->ViewValue = $destinations->Client->CurrentValue;
				}
			} else {
				$destinations->Client->ViewValue = NULL;
			}
			$destinations->Client->CssStyle = "";
			$destinations->Client->CssClass = "";
			$destinations->Client->ViewCustomAttributes = "";

			// id
			$destinations->id->HrefValue = "";
			$destinations->id->TooltipValue = "";

			// Destination
			$destinations->Destination->HrefValue = "";
			$destinations->Destination->TooltipValue = "";

			// Client
			$destinations->Client->HrefValue = "";
			$destinations->Client->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($destinations->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$destinations->Row_Rendered();
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
