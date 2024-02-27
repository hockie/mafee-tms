<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "all_file_uploadsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "account_paymentsinfo.php" ?>
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
$all_file_uploads_view = new call_file_uploads_view();
$Page =& $all_file_uploads_view;

// Page init
$all_file_uploads_view->Page_Init();

// Page main
$all_file_uploads_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($all_file_uploads->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var all_file_uploads_view = new ew_Page("all_file_uploads_view");

// page properties
all_file_uploads_view.PageID = "view"; // page ID
all_file_uploads_view.FormID = "fall_file_uploadsview"; // form ID
var EW_PAGE_ID = all_file_uploads_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
all_file_uploads_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
all_file_uploads_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
all_file_uploads_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
all_file_uploads_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $all_file_uploads->TableCaption() ?>
<br><br>
<?php if ($all_file_uploads->Export == "") { ?>
<a href="<?php echo $all_file_uploads_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $all_file_uploads_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $all_file_uploads_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $all_file_uploads_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$all_file_uploads_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($all_file_uploads->id->Visible) { // id ?>
	<tr<?php echo $all_file_uploads->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->id->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->id->ViewAttributes() ?>><?php echo $all_file_uploads->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->module->Visible) { // module ?>
	<tr<?php echo $all_file_uploads->module->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->module->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->module->CellAttributes() ?>>
<div<?php echo $all_file_uploads->module->ViewAttributes() ?>><?php echo $all_file_uploads->module->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->File_Name->Visible) { // File_Name ?>
	<tr<?php echo $all_file_uploads->File_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->File_Name->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->File_Name->CellAttributes() ?>>
<?php if ($all_file_uploads->File_Name->HrefValue <> "" || $all_file_uploads->File_Name->TooltipValue <> "") { ?>
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<a href="<?php echo $all_file_uploads->File_Name->HrefValue ?>"><?php echo $all_file_uploads->File_Name->ViewValue ?></a>
<?php } elseif (!in_array($all_file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<?php echo $all_file_uploads->File_Name->ViewValue ?>
<?php } elseif (!in_array($all_file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $all_file_uploads->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->Remarks->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->Remarks->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Remarks->ViewAttributes() ?>><?php echo $all_file_uploads->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->Created->Visible) { // Created ?>
	<tr<?php echo $all_file_uploads->Created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->Created->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->Created->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Created->ViewAttributes() ?>><?php echo $all_file_uploads->Created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->Modified->Visible) { // Modified ?>
	<tr<?php echo $all_file_uploads->Modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->Modified->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->Modified->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Modified->ViewAttributes() ?>><?php echo $all_file_uploads->Modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->user_id->Visible) { // user_id ?>
	<tr<?php echo $all_file_uploads->user_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->user_id->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->user_id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->user_id->ViewAttributes() ?>><?php echo $all_file_uploads->user_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->file_id->Visible) { // file_id ?>
	<tr<?php echo $all_file_uploads->file_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->file_id->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->file_id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->file_id->ViewAttributes() ?>><?php echo $all_file_uploads->file_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($all_file_uploads->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$all_file_uploads_view->Page_Terminate();
?>
<?php

//
// Page class
//
class call_file_uploads_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'all_file_uploads';

	// Page object name
	var $PageObjName = 'all_file_uploads_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $all_file_uploads;
		if ($all_file_uploads->UseTokenInUrl) $PageUrl .= "t=" . $all_file_uploads->TableVar . "&"; // Add page token
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
		global $objForm, $all_file_uploads;
		if ($all_file_uploads->UseTokenInUrl) {
			if ($objForm)
				return ($all_file_uploads->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($all_file_uploads->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function call_file_uploads_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (all_file_uploads)
		$GLOBALS["all_file_uploads"] = new call_file_uploads();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'all_file_uploads', TRUE);

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
		global $all_file_uploads;

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
			$this->Page_Terminate("all_file_uploadslist.php");
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
		global $Language, $all_file_uploads;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$all_file_uploads->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $all_file_uploads->id->QueryStringValue;
			} else {
				$sReturnUrl = "all_file_uploadslist.php"; // Return to list
			}

			// Get action
			$all_file_uploads->CurrentAction = "I"; // Display form
			switch ($all_file_uploads->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "all_file_uploadslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "all_file_uploadslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$all_file_uploads->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $all_file_uploads;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$all_file_uploads->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$all_file_uploads->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $all_file_uploads->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $all_file_uploads;
		$sFilter = $all_file_uploads->KeyFilter();

		// Call Row Selecting event
		$all_file_uploads->Row_Selecting($sFilter);

		// Load SQL based on filter
		$all_file_uploads->CurrentFilter = $sFilter;
		$sSql = $all_file_uploads->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$all_file_uploads->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $all_file_uploads;
		$all_file_uploads->id->setDbValue($rs->fields('id'));
		$all_file_uploads->module->setDbValue($rs->fields('module'));
		$all_file_uploads->File_Name->Upload->DbValue = $rs->fields('File_Name');
		$all_file_uploads->Remarks->setDbValue($rs->fields('Remarks'));
		$all_file_uploads->Created->setDbValue($rs->fields('Created'));
		$all_file_uploads->Modified->setDbValue($rs->fields('Modified'));
		$all_file_uploads->user_id->setDbValue($rs->fields('user_id'));
		$all_file_uploads->file_id->setDbValue($rs->fields('file_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $all_file_uploads;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($all_file_uploads->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($all_file_uploads->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($all_file_uploads->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($all_file_uploads->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($all_file_uploads->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($all_file_uploads->id->CurrentValue);
		$this->AddUrl = $all_file_uploads->AddUrl();
		$this->EditUrl = $all_file_uploads->EditUrl();
		$this->CopyUrl = $all_file_uploads->CopyUrl();
		$this->DeleteUrl = $all_file_uploads->DeleteUrl();
		$this->ListUrl = $all_file_uploads->ListUrl();

		// Call Row_Rendering event
		$all_file_uploads->Row_Rendering();

		// Common render codes for all row types
		// id

		$all_file_uploads->id->CellCssStyle = ""; $all_file_uploads->id->CellCssClass = "";
		$all_file_uploads->id->CellAttrs = array(); $all_file_uploads->id->ViewAttrs = array(); $all_file_uploads->id->EditAttrs = array();

		// module
		$all_file_uploads->module->CellCssStyle = ""; $all_file_uploads->module->CellCssClass = "";
		$all_file_uploads->module->CellAttrs = array(); $all_file_uploads->module->ViewAttrs = array(); $all_file_uploads->module->EditAttrs = array();

		// File_Name
		$all_file_uploads->File_Name->CellCssStyle = ""; $all_file_uploads->File_Name->CellCssClass = "";
		$all_file_uploads->File_Name->CellAttrs = array(); $all_file_uploads->File_Name->ViewAttrs = array(); $all_file_uploads->File_Name->EditAttrs = array();

		// Remarks
		$all_file_uploads->Remarks->CellCssStyle = ""; $all_file_uploads->Remarks->CellCssClass = "";
		$all_file_uploads->Remarks->CellAttrs = array(); $all_file_uploads->Remarks->ViewAttrs = array(); $all_file_uploads->Remarks->EditAttrs = array();

		// Created
		$all_file_uploads->Created->CellCssStyle = ""; $all_file_uploads->Created->CellCssClass = "";
		$all_file_uploads->Created->CellAttrs = array(); $all_file_uploads->Created->ViewAttrs = array(); $all_file_uploads->Created->EditAttrs = array();

		// Modified
		$all_file_uploads->Modified->CellCssStyle = ""; $all_file_uploads->Modified->CellCssClass = "";
		$all_file_uploads->Modified->CellAttrs = array(); $all_file_uploads->Modified->ViewAttrs = array(); $all_file_uploads->Modified->EditAttrs = array();

		// user_id
		$all_file_uploads->user_id->CellCssStyle = ""; $all_file_uploads->user_id->CellCssClass = "";
		$all_file_uploads->user_id->CellAttrs = array(); $all_file_uploads->user_id->ViewAttrs = array(); $all_file_uploads->user_id->EditAttrs = array();

		// file_id
		$all_file_uploads->file_id->CellCssStyle = ""; $all_file_uploads->file_id->CellCssClass = "";
		$all_file_uploads->file_id->CellAttrs = array(); $all_file_uploads->file_id->ViewAttrs = array(); $all_file_uploads->file_id->EditAttrs = array();
		if ($all_file_uploads->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$all_file_uploads->id->ViewValue = $all_file_uploads->id->CurrentValue;
			$all_file_uploads->id->CssStyle = "";
			$all_file_uploads->id->CssClass = "";
			$all_file_uploads->id->ViewCustomAttributes = "";

			// module
			$all_file_uploads->module->ViewValue = $all_file_uploads->module->CurrentValue;
			$all_file_uploads->module->CssStyle = "";
			$all_file_uploads->module->CssClass = "";
			$all_file_uploads->module->ViewCustomAttributes = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->ViewValue = $all_file_uploads->File_Name->Upload->DbValue;
			} else {
				$all_file_uploads->File_Name->ViewValue = "";
			}
			$all_file_uploads->File_Name->CssStyle = "";
			$all_file_uploads->File_Name->CssClass = "";
			$all_file_uploads->File_Name->ViewCustomAttributes = "";

			// Remarks
			$all_file_uploads->Remarks->ViewValue = $all_file_uploads->Remarks->CurrentValue;
			$all_file_uploads->Remarks->CssStyle = "";
			$all_file_uploads->Remarks->CssClass = "";
			$all_file_uploads->Remarks->ViewCustomAttributes = "";

			// Created
			$all_file_uploads->Created->ViewValue = $all_file_uploads->Created->CurrentValue;
			$all_file_uploads->Created->ViewValue = ew_FormatDateTime($all_file_uploads->Created->ViewValue, 6);
			$all_file_uploads->Created->CssStyle = "";
			$all_file_uploads->Created->CssClass = "";
			$all_file_uploads->Created->ViewCustomAttributes = "";

			// Modified
			$all_file_uploads->Modified->ViewValue = $all_file_uploads->Modified->CurrentValue;
			$all_file_uploads->Modified->ViewValue = ew_FormatDateTime($all_file_uploads->Modified->ViewValue, 6);
			$all_file_uploads->Modified->CssStyle = "";
			$all_file_uploads->Modified->CssClass = "";
			$all_file_uploads->Modified->ViewCustomAttributes = "";

			// user_id
			$all_file_uploads->user_id->ViewValue = $all_file_uploads->user_id->CurrentValue;
			$all_file_uploads->user_id->CssStyle = "";
			$all_file_uploads->user_id->CssClass = "";
			$all_file_uploads->user_id->ViewCustomAttributes = "";

			// file_id
			$all_file_uploads->file_id->ViewValue = $all_file_uploads->file_id->CurrentValue;
			$all_file_uploads->file_id->CssStyle = "";
			$all_file_uploads->file_id->CssClass = "";
			$all_file_uploads->file_id->ViewCustomAttributes = "";

			// id
			$all_file_uploads->id->HrefValue = "";
			$all_file_uploads->id->TooltipValue = "";

			// module
			$all_file_uploads->module->HrefValue = "";
			$all_file_uploads->module->TooltipValue = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->HrefValue = ew_UploadPathEx(FALSE, $all_file_uploads->File_Name->UploadPath) . ((!empty($all_file_uploads->File_Name->ViewValue)) ? $all_file_uploads->File_Name->ViewValue : $all_file_uploads->File_Name->CurrentValue);
				if ($all_file_uploads->Export <> "") $all_file_uploads->File_Name->HrefValue = ew_ConvertFullUrl($all_file_uploads->File_Name->HrefValue);
			} else {
				$all_file_uploads->File_Name->HrefValue = "";
			}
			$all_file_uploads->File_Name->TooltipValue = "";

			// Remarks
			$all_file_uploads->Remarks->HrefValue = "";
			$all_file_uploads->Remarks->TooltipValue = "";

			// Created
			$all_file_uploads->Created->HrefValue = "";
			$all_file_uploads->Created->TooltipValue = "";

			// Modified
			$all_file_uploads->Modified->HrefValue = "";
			$all_file_uploads->Modified->TooltipValue = "";

			// user_id
			$all_file_uploads->user_id->HrefValue = "";
			$all_file_uploads->user_id->TooltipValue = "";

			// file_id
			$all_file_uploads->file_id->HrefValue = "";
			$all_file_uploads->file_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($all_file_uploads->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$all_file_uploads->Row_Rendered();
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
