<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_typesinfo.php" ?>
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
$file_types_view = new cfile_types_view();
$Page =& $file_types_view;

// Page init
$file_types_view->Page_Init();

// Page main
$file_types_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($file_types->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var file_types_view = new ew_Page("file_types_view");

// page properties
file_types_view.PageID = "view"; // page ID
file_types_view.FormID = "ffile_typesview"; // form ID
var EW_PAGE_ID = file_types_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
file_types_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
file_types_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_types_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_types->TableCaption() ?>
<br><br>
<?php if ($file_types->Export == "") { ?>
<a href="<?php echo $file_types_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $file_types_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $file_types_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $file_types_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_types_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($file_types->id->Visible) { // id ?>
	<tr<?php echo $file_types->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_types->id->FldCaption() ?></td>
		<td<?php echo $file_types->id->CellAttributes() ?>>
<div<?php echo $file_types->id->ViewAttributes() ?>><?php echo $file_types->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_types->File_Type->Visible) { // File_Type ?>
	<tr<?php echo $file_types->File_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_types->File_Type->FldCaption() ?></td>
		<td<?php echo $file_types->File_Type->CellAttributes() ?>>
<div<?php echo $file_types->File_Type->ViewAttributes() ?>><?php echo $file_types->File_Type->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($file_types->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$file_types_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_types_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'file_types';

	// Page object name
	var $PageObjName = 'file_types_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_types;
		if ($file_types->UseTokenInUrl) $PageUrl .= "t=" . $file_types->TableVar . "&"; // Add page token
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
		global $objForm, $file_types;
		if ($file_types->UseTokenInUrl) {
			if ($objForm)
				return ($file_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_types_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_types)
		$GLOBALS["file_types"] = new cfile_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_types', TRUE);

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
		global $file_types;

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
			$this->Page_Terminate("file_typeslist.php");
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
		global $Language, $file_types;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$file_types->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $file_types->id->QueryStringValue;
			} else {
				$sReturnUrl = "file_typeslist.php"; // Return to list
			}

			// Get action
			$file_types->CurrentAction = "I"; // Display form
			switch ($file_types->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "file_typeslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "file_typeslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$file_types->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $file_types;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$file_types->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$file_types->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $file_types->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$file_types->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$file_types->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$file_types->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_types;
		$sFilter = $file_types->KeyFilter();

		// Call Row Selecting event
		$file_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_types->CurrentFilter = $sFilter;
		$sSql = $file_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_types;
		$file_types->id->setDbValue($rs->fields('id'));
		$file_types->File_Type->setDbValue($rs->fields('File_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_types;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($file_types->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($file_types->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($file_types->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($file_types->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($file_types->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($file_types->id->CurrentValue);
		$this->AddUrl = $file_types->AddUrl();
		$this->EditUrl = $file_types->EditUrl();
		$this->CopyUrl = $file_types->CopyUrl();
		$this->DeleteUrl = $file_types->DeleteUrl();
		$this->ListUrl = $file_types->ListUrl();

		// Call Row_Rendering event
		$file_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$file_types->id->CellCssStyle = ""; $file_types->id->CellCssClass = "";
		$file_types->id->CellAttrs = array(); $file_types->id->ViewAttrs = array(); $file_types->id->EditAttrs = array();

		// File_Type
		$file_types->File_Type->CellCssStyle = ""; $file_types->File_Type->CellCssClass = "";
		$file_types->File_Type->CellAttrs = array(); $file_types->File_Type->ViewAttrs = array(); $file_types->File_Type->EditAttrs = array();
		if ($file_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_types->id->ViewValue = $file_types->id->CurrentValue;
			$file_types->id->CssStyle = "";
			$file_types->id->CssClass = "";
			$file_types->id->ViewCustomAttributes = "";

			// File_Type
			$file_types->File_Type->ViewValue = $file_types->File_Type->CurrentValue;
			$file_types->File_Type->CssStyle = "";
			$file_types->File_Type->CssClass = "";
			$file_types->File_Type->ViewCustomAttributes = "";

			// id
			$file_types->id->HrefValue = "";
			$file_types->id->TooltipValue = "";

			// File_Type
			$file_types->File_Type->HrefValue = "";
			$file_types->File_Type->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($file_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_types->Row_Rendered();
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
