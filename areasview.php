<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "areasinfo.php" ?>
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
$areas_view = new careas_view();
$Page =& $areas_view;

// Page init
$areas_view->Page_Init();

// Page main
$areas_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($areas->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var areas_view = new ew_Page("areas_view");

// page properties
areas_view.PageID = "view"; // page ID
areas_view.FormID = "fareasview"; // form ID
var EW_PAGE_ID = areas_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
areas_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
areas_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
areas_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $areas->TableCaption() ?>
<br><br>
<?php if ($areas->Export == "") { ?>
<a href="<?php echo $areas_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $areas_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $areas_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $areas_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$areas_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($areas->id->Visible) { // id ?>
	<tr<?php echo $areas->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $areas->id->FldCaption() ?></td>
		<td<?php echo $areas->id->CellAttributes() ?>>
<div<?php echo $areas->id->ViewAttributes() ?>><?php echo $areas->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($areas->Area->Visible) { // Area ?>
	<tr<?php echo $areas->Area->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $areas->Area->FldCaption() ?></td>
		<td<?php echo $areas->Area->CellAttributes() ?>>
<div<?php echo $areas->Area->ViewAttributes() ?>><?php echo $areas->Area->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($areas->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$areas_view->Page_Terminate();
?>
<?php

//
// Page class
//
class careas_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'areas';

	// Page object name
	var $PageObjName = 'areas_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $areas;
		if ($areas->UseTokenInUrl) $PageUrl .= "t=" . $areas->TableVar . "&"; // Add page token
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
		global $objForm, $areas;
		if ($areas->UseTokenInUrl) {
			if ($objForm)
				return ($areas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($areas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function careas_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (areas)
		$GLOBALS["areas"] = new careas();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'areas', TRUE);

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
		global $areas;

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
			$this->Page_Terminate("areaslist.php");
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
		global $Language, $areas;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$areas->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $areas->id->QueryStringValue;
			} else {
				$sReturnUrl = "areaslist.php"; // Return to list
			}

			// Get action
			$areas->CurrentAction = "I"; // Display form
			switch ($areas->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "areaslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "areaslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$areas->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $areas;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$areas->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$areas->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $areas->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$areas->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$areas->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$areas->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $areas;
		$sFilter = $areas->KeyFilter();

		// Call Row Selecting event
		$areas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$areas->CurrentFilter = $sFilter;
		$sSql = $areas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$areas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $areas;
		$areas->id->setDbValue($rs->fields('id'));
		$areas->Area->setDbValue($rs->fields('Area'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $areas;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($areas->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($areas->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($areas->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($areas->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($areas->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($areas->id->CurrentValue);
		$this->AddUrl = $areas->AddUrl();
		$this->EditUrl = $areas->EditUrl();
		$this->CopyUrl = $areas->CopyUrl();
		$this->DeleteUrl = $areas->DeleteUrl();
		$this->ListUrl = $areas->ListUrl();

		// Call Row_Rendering event
		$areas->Row_Rendering();

		// Common render codes for all row types
		// id

		$areas->id->CellCssStyle = ""; $areas->id->CellCssClass = "";
		$areas->id->CellAttrs = array(); $areas->id->ViewAttrs = array(); $areas->id->EditAttrs = array();

		// Area
		$areas->Area->CellCssStyle = ""; $areas->Area->CellCssClass = "";
		$areas->Area->CellAttrs = array(); $areas->Area->ViewAttrs = array(); $areas->Area->EditAttrs = array();
		if ($areas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$areas->id->ViewValue = $areas->id->CurrentValue;
			$areas->id->CssStyle = "";
			$areas->id->CssClass = "";
			$areas->id->ViewCustomAttributes = "";

			// Area
			$areas->Area->ViewValue = $areas->Area->CurrentValue;
			$areas->Area->CssStyle = "";
			$areas->Area->CssClass = "";
			$areas->Area->ViewCustomAttributes = "";

			// id
			$areas->id->HrefValue = "";
			$areas->id->TooltipValue = "";

			// Area
			$areas->Area->HrefValue = "";
			$areas->Area->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($areas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$areas->Row_Rendered();
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
