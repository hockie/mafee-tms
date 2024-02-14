<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "expenses_typesinfo.php" ?>
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
$expenses_types_view = new cexpenses_types_view();
$Page =& $expenses_types_view;

// Page init
$expenses_types_view->Page_Init();

// Page main
$expenses_types_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($expenses_types->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expenses_types_view = new ew_Page("expenses_types_view");

// page properties
expenses_types_view.PageID = "view"; // page ID
expenses_types_view.FormID = "fexpenses_typesview"; // form ID
var EW_PAGE_ID = expenses_types_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expenses_types_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
expenses_types_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenses_types_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenses_types->TableCaption() ?>
<br><br>
<?php if ($expenses_types->Export == "") { ?>
<a href="<?php echo $expenses_types_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expenses_types_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $expenses_types_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $expenses_types_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expenses_types_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expenses_types->id->Visible) { // id ?>
	<tr<?php echo $expenses_types->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses_types->id->FldCaption() ?></td>
		<td<?php echo $expenses_types->id->CellAttributes() ?>>
<div<?php echo $expenses_types->id->ViewAttributes() ?>><?php echo $expenses_types->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expenses_types->Expenses_Type->Visible) { // Expenses_Type ?>
	<tr<?php echo $expenses_types->Expenses_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses_types->Expenses_Type->FldCaption() ?></td>
		<td<?php echo $expenses_types->Expenses_Type->CellAttributes() ?>>
<div<?php echo $expenses_types->Expenses_Type->ViewAttributes() ?>><?php echo $expenses_types->Expenses_Type->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($expenses_types->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$expenses_types_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenses_types_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'expenses_types';

	// Page object name
	var $PageObjName = 'expenses_types_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenses_types;
		if ($expenses_types->UseTokenInUrl) $PageUrl .= "t=" . $expenses_types->TableVar . "&"; // Add page token
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
		global $objForm, $expenses_types;
		if ($expenses_types->UseTokenInUrl) {
			if ($objForm)
				return ($expenses_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenses_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenses_types_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expenses_types)
		$GLOBALS["expenses_types"] = new cexpenses_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenses_types', TRUE);

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
		global $expenses_types;

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
			$this->Page_Terminate("expenses_typeslist.php");
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
		global $Language, $expenses_types;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$expenses_types->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $expenses_types->id->QueryStringValue;
			} else {
				$sReturnUrl = "expenses_typeslist.php"; // Return to list
			}

			// Get action
			$expenses_types->CurrentAction = "I"; // Display form
			switch ($expenses_types->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "expenses_typeslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "expenses_typeslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$expenses_types->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expenses_types;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$expenses_types->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$expenses_types->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $expenses_types->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$expenses_types->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$expenses_types->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$expenses_types->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenses_types;
		$sFilter = $expenses_types->KeyFilter();

		// Call Row Selecting event
		$expenses_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenses_types->CurrentFilter = $sFilter;
		$sSql = $expenses_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$expenses_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expenses_types;
		$expenses_types->id->setDbValue($rs->fields('id'));
		$expenses_types->Expenses_Type->setDbValue($rs->fields('Expenses_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenses_types;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($expenses_types->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($expenses_types->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($expenses_types->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($expenses_types->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($expenses_types->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($expenses_types->id->CurrentValue);
		$this->AddUrl = $expenses_types->AddUrl();
		$this->EditUrl = $expenses_types->EditUrl();
		$this->CopyUrl = $expenses_types->CopyUrl();
		$this->DeleteUrl = $expenses_types->DeleteUrl();
		$this->ListUrl = $expenses_types->ListUrl();

		// Call Row_Rendering event
		$expenses_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$expenses_types->id->CellCssStyle = ""; $expenses_types->id->CellCssClass = "";
		$expenses_types->id->CellAttrs = array(); $expenses_types->id->ViewAttrs = array(); $expenses_types->id->EditAttrs = array();

		// Expenses_Type
		$expenses_types->Expenses_Type->CellCssStyle = ""; $expenses_types->Expenses_Type->CellCssClass = "";
		$expenses_types->Expenses_Type->CellAttrs = array(); $expenses_types->Expenses_Type->ViewAttrs = array(); $expenses_types->Expenses_Type->EditAttrs = array();
		if ($expenses_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expenses_types->id->ViewValue = $expenses_types->id->CurrentValue;
			$expenses_types->id->CssStyle = "";
			$expenses_types->id->CssClass = "";
			$expenses_types->id->ViewCustomAttributes = "";

			// Expenses_Type
			$expenses_types->Expenses_Type->ViewValue = $expenses_types->Expenses_Type->CurrentValue;
			$expenses_types->Expenses_Type->CssStyle = "";
			$expenses_types->Expenses_Type->CssClass = "";
			$expenses_types->Expenses_Type->ViewCustomAttributes = "";

			// id
			$expenses_types->id->HrefValue = "";
			$expenses_types->id->TooltipValue = "";

			// Expenses_Type
			$expenses_types->Expenses_Type->HrefValue = "";
			$expenses_types->Expenses_Type->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expenses_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenses_types->Row_Rendered();
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
