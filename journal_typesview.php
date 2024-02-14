<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "journal_typesinfo.php" ?>
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
$journal_types_view = new cjournal_types_view();
$Page =& $journal_types_view;

// Page init
$journal_types_view->Page_Init();

// Page main
$journal_types_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($journal_types->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var journal_types_view = new ew_Page("journal_types_view");

// page properties
journal_types_view.PageID = "view"; // page ID
journal_types_view.FormID = "fjournal_typesview"; // form ID
var EW_PAGE_ID = journal_types_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
journal_types_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
journal_types_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
journal_types_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
journal_types_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $journal_types->TableCaption() ?>
<br><br>
<?php if ($journal_types->Export == "") { ?>
<a href="<?php echo $journal_types_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $journal_types_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $journal_types_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $journal_types_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$journal_types_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($journal_types->id->Visible) { // id ?>
	<tr<?php echo $journal_types->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_types->id->FldCaption() ?></td>
		<td<?php echo $journal_types->id->CellAttributes() ?>>
<div<?php echo $journal_types->id->ViewAttributes() ?>><?php echo $journal_types->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_types->Journal_Name->Visible) { // Journal_Name ?>
	<tr<?php echo $journal_types->Journal_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_types->Journal_Name->FldCaption() ?></td>
		<td<?php echo $journal_types->Journal_Name->CellAttributes() ?>>
<div<?php echo $journal_types->Journal_Name->ViewAttributes() ?>><?php echo $journal_types->Journal_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_types->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $journal_types->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_types->Remarks->FldCaption() ?></td>
		<td<?php echo $journal_types->Remarks->CellAttributes() ?>>
<div<?php echo $journal_types->Remarks->ViewAttributes() ?>><?php echo $journal_types->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_types->created->Visible) { // created ?>
	<tr<?php echo $journal_types->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_types->created->FldCaption() ?></td>
		<td<?php echo $journal_types->created->CellAttributes() ?>>
<div<?php echo $journal_types->created->ViewAttributes() ?>><?php echo $journal_types->created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_types->modified->Visible) { // modified ?>
	<tr<?php echo $journal_types->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_types->modified->FldCaption() ?></td>
		<td<?php echo $journal_types->modified->CellAttributes() ?>>
<div<?php echo $journal_types->modified->ViewAttributes() ?>><?php echo $journal_types->modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_types->User_ID->Visible) { // User_ID ?>
	<tr<?php echo $journal_types->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_types->User_ID->FldCaption() ?></td>
		<td<?php echo $journal_types->User_ID->CellAttributes() ?>>
<div<?php echo $journal_types->User_ID->ViewAttributes() ?>><?php echo $journal_types->User_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($journal_types->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$journal_types_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cjournal_types_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'journal_types';

	// Page object name
	var $PageObjName = 'journal_types_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $journal_types;
		if ($journal_types->UseTokenInUrl) $PageUrl .= "t=" . $journal_types->TableVar . "&"; // Add page token
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
		global $objForm, $journal_types;
		if ($journal_types->UseTokenInUrl) {
			if ($objForm)
				return ($journal_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($journal_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cjournal_types_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (journal_types)
		$GLOBALS["journal_types"] = new cjournal_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'journal_types', TRUE);

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
		global $journal_types;

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
			$this->Page_Terminate("journal_typeslist.php");
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
		global $Language, $journal_types;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$journal_types->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $journal_types->id->QueryStringValue;
			} else {
				$sReturnUrl = "journal_typeslist.php"; // Return to list
			}

			// Get action
			$journal_types->CurrentAction = "I"; // Display form
			switch ($journal_types->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "journal_typeslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "journal_typeslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$journal_types->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $journal_types;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$journal_types->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$journal_types->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $journal_types->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$journal_types->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$journal_types->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$journal_types->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $journal_types;
		$sFilter = $journal_types->KeyFilter();

		// Call Row Selecting event
		$journal_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$journal_types->CurrentFilter = $sFilter;
		$sSql = $journal_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$journal_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $journal_types;
		$journal_types->id->setDbValue($rs->fields('id'));
		$journal_types->Journal_Name->setDbValue($rs->fields('Journal_Name'));
		$journal_types->Remarks->setDbValue($rs->fields('Remarks'));
		$journal_types->created->setDbValue($rs->fields('created'));
		$journal_types->modified->setDbValue($rs->fields('modified'));
		$journal_types->User_ID->setDbValue($rs->fields('User_ID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $journal_types;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($journal_types->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($journal_types->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($journal_types->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($journal_types->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($journal_types->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($journal_types->id->CurrentValue);
		$this->AddUrl = $journal_types->AddUrl();
		$this->EditUrl = $journal_types->EditUrl();
		$this->CopyUrl = $journal_types->CopyUrl();
		$this->DeleteUrl = $journal_types->DeleteUrl();
		$this->ListUrl = $journal_types->ListUrl();

		// Call Row_Rendering event
		$journal_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$journal_types->id->CellCssStyle = ""; $journal_types->id->CellCssClass = "";
		$journal_types->id->CellAttrs = array(); $journal_types->id->ViewAttrs = array(); $journal_types->id->EditAttrs = array();

		// Journal_Name
		$journal_types->Journal_Name->CellCssStyle = ""; $journal_types->Journal_Name->CellCssClass = "";
		$journal_types->Journal_Name->CellAttrs = array(); $journal_types->Journal_Name->ViewAttrs = array(); $journal_types->Journal_Name->EditAttrs = array();

		// Remarks
		$journal_types->Remarks->CellCssStyle = ""; $journal_types->Remarks->CellCssClass = "";
		$journal_types->Remarks->CellAttrs = array(); $journal_types->Remarks->ViewAttrs = array(); $journal_types->Remarks->EditAttrs = array();

		// created
		$journal_types->created->CellCssStyle = ""; $journal_types->created->CellCssClass = "";
		$journal_types->created->CellAttrs = array(); $journal_types->created->ViewAttrs = array(); $journal_types->created->EditAttrs = array();

		// modified
		$journal_types->modified->CellCssStyle = ""; $journal_types->modified->CellCssClass = "";
		$journal_types->modified->CellAttrs = array(); $journal_types->modified->ViewAttrs = array(); $journal_types->modified->EditAttrs = array();

		// User_ID
		$journal_types->User_ID->CellCssStyle = ""; $journal_types->User_ID->CellCssClass = "";
		$journal_types->User_ID->CellAttrs = array(); $journal_types->User_ID->ViewAttrs = array(); $journal_types->User_ID->EditAttrs = array();
		if ($journal_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$journal_types->id->ViewValue = $journal_types->id->CurrentValue;
			$journal_types->id->CssStyle = "";
			$journal_types->id->CssClass = "";
			$journal_types->id->ViewCustomAttributes = "";

			// Journal_Name
			$journal_types->Journal_Name->ViewValue = $journal_types->Journal_Name->CurrentValue;
			$journal_types->Journal_Name->CssStyle = "";
			$journal_types->Journal_Name->CssClass = "";
			$journal_types->Journal_Name->ViewCustomAttributes = "";

			// Remarks
			$journal_types->Remarks->ViewValue = $journal_types->Remarks->CurrentValue;
			$journal_types->Remarks->CssStyle = "";
			$journal_types->Remarks->CssClass = "";
			$journal_types->Remarks->ViewCustomAttributes = "";

			// created
			$journal_types->created->ViewValue = $journal_types->created->CurrentValue;
			$journal_types->created->ViewValue = ew_FormatDateTime($journal_types->created->ViewValue, 6);
			$journal_types->created->CssStyle = "";
			$journal_types->created->CssClass = "";
			$journal_types->created->ViewCustomAttributes = "";

			// modified
			$journal_types->modified->ViewValue = $journal_types->modified->CurrentValue;
			$journal_types->modified->ViewValue = ew_FormatDateTime($journal_types->modified->ViewValue, 6);
			$journal_types->modified->CssStyle = "";
			$journal_types->modified->CssClass = "";
			$journal_types->modified->ViewCustomAttributes = "";

			// User_ID
			$journal_types->User_ID->ViewValue = $journal_types->User_ID->CurrentValue;
			$journal_types->User_ID->CssStyle = "";
			$journal_types->User_ID->CssClass = "";
			$journal_types->User_ID->ViewCustomAttributes = "";

			// id
			$journal_types->id->HrefValue = "";
			$journal_types->id->TooltipValue = "";

			// Journal_Name
			$journal_types->Journal_Name->HrefValue = "";
			$journal_types->Journal_Name->TooltipValue = "";

			// Remarks
			$journal_types->Remarks->HrefValue = "";
			$journal_types->Remarks->TooltipValue = "";

			// created
			$journal_types->created->HrefValue = "";
			$journal_types->created->TooltipValue = "";

			// modified
			$journal_types->modified->HrefValue = "";
			$journal_types->modified->TooltipValue = "";

			// User_ID
			$journal_types->User_ID->HrefValue = "";
			$journal_types->User_ID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($journal_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$journal_types->Row_Rendered();
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
