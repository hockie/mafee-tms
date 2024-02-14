<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "truck_typesinfo.php" ?>
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
$truck_types_view = new ctruck_types_view();
$Page =& $truck_types_view;

// Page init
$truck_types_view->Page_Init();

// Page main
$truck_types_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($truck_types->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var truck_types_view = new ew_Page("truck_types_view");

// page properties
truck_types_view.PageID = "view"; // page ID
truck_types_view.FormID = "ftruck_typesview"; // form ID
var EW_PAGE_ID = truck_types_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
truck_types_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
truck_types_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
truck_types_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $truck_types->TableCaption() ?>
<br><br>
<?php if ($truck_types->Export == "") { ?>
<a href="<?php echo $truck_types_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $truck_types_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $truck_types_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $truck_types_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$truck_types_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($truck_types->id->Visible) { // id ?>
	<tr<?php echo $truck_types->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_types->id->FldCaption() ?></td>
		<td<?php echo $truck_types->id->CellAttributes() ?>>
<div<?php echo $truck_types->id->ViewAttributes() ?>><?php echo $truck_types->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($truck_types->Truck_Type->Visible) { // Truck_Type ?>
	<tr<?php echo $truck_types->Truck_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_types->Truck_Type->FldCaption() ?></td>
		<td<?php echo $truck_types->Truck_Type->CellAttributes() ?>>
<div<?php echo $truck_types->Truck_Type->ViewAttributes() ?>><?php echo $truck_types->Truck_Type->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($truck_types->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$truck_types_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctruck_types_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'truck_types';

	// Page object name
	var $PageObjName = 'truck_types_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $truck_types;
		if ($truck_types->UseTokenInUrl) $PageUrl .= "t=" . $truck_types->TableVar . "&"; // Add page token
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
		global $objForm, $truck_types;
		if ($truck_types->UseTokenInUrl) {
			if ($objForm)
				return ($truck_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($truck_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctruck_types_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (truck_types)
		$GLOBALS["truck_types"] = new ctruck_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'truck_types', TRUE);

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
		global $truck_types;

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
			$this->Page_Terminate("truck_typeslist.php");
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
		global $Language, $truck_types;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$truck_types->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $truck_types->id->QueryStringValue;
			} else {
				$sReturnUrl = "truck_typeslist.php"; // Return to list
			}

			// Get action
			$truck_types->CurrentAction = "I"; // Display form
			switch ($truck_types->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "truck_typeslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "truck_typeslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$truck_types->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $truck_types;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$truck_types->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$truck_types->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $truck_types->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$truck_types->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$truck_types->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$truck_types->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $truck_types;
		$sFilter = $truck_types->KeyFilter();

		// Call Row Selecting event
		$truck_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$truck_types->CurrentFilter = $sFilter;
		$sSql = $truck_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$truck_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $truck_types;
		$truck_types->id->setDbValue($rs->fields('id'));
		$truck_types->Truck_Type->setDbValue($rs->fields('Truck_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $truck_types;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($truck_types->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($truck_types->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($truck_types->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($truck_types->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($truck_types->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($truck_types->id->CurrentValue);
		$this->AddUrl = $truck_types->AddUrl();
		$this->EditUrl = $truck_types->EditUrl();
		$this->CopyUrl = $truck_types->CopyUrl();
		$this->DeleteUrl = $truck_types->DeleteUrl();
		$this->ListUrl = $truck_types->ListUrl();

		// Call Row_Rendering event
		$truck_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$truck_types->id->CellCssStyle = ""; $truck_types->id->CellCssClass = "";
		$truck_types->id->CellAttrs = array(); $truck_types->id->ViewAttrs = array(); $truck_types->id->EditAttrs = array();

		// Truck_Type
		$truck_types->Truck_Type->CellCssStyle = ""; $truck_types->Truck_Type->CellCssClass = "";
		$truck_types->Truck_Type->CellAttrs = array(); $truck_types->Truck_Type->ViewAttrs = array(); $truck_types->Truck_Type->EditAttrs = array();
		if ($truck_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$truck_types->id->ViewValue = $truck_types->id->CurrentValue;
			$truck_types->id->CssStyle = "";
			$truck_types->id->CssClass = "";
			$truck_types->id->ViewCustomAttributes = "";

			// Truck_Type
			$truck_types->Truck_Type->ViewValue = $truck_types->Truck_Type->CurrentValue;
			$truck_types->Truck_Type->CssStyle = "";
			$truck_types->Truck_Type->CssClass = "";
			$truck_types->Truck_Type->ViewCustomAttributes = "";

			// id
			$truck_types->id->HrefValue = "";
			$truck_types->id->TooltipValue = "";

			// Truck_Type
			$truck_types->Truck_Type->HrefValue = "";
			$truck_types->Truck_Type->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($truck_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$truck_types->Row_Rendered();
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
