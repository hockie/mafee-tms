<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "audittrailinfo.php" ?>
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
$audittrail_view = new caudittrail_view();
$Page =& $audittrail_view;

// Page init
$audittrail_view->Page_Init();

// Page main
$audittrail_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($audittrail->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var audittrail_view = new ew_Page("audittrail_view");

// page properties
audittrail_view.PageID = "view"; // page ID
audittrail_view.FormID = "faudittrailview"; // form ID
var EW_PAGE_ID = audittrail_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
audittrail_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
audittrail_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
audittrail_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $audittrail->TableCaption() ?>
<br><br>
<?php if ($audittrail->Export == "") { ?>
<a href="<?php echo $audittrail_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $audittrail_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $audittrail_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $audittrail_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $audittrail_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$audittrail_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($audittrail->id->Visible) { // id ?>
	<tr<?php echo $audittrail->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->id->FldCaption() ?></td>
		<td<?php echo $audittrail->id->CellAttributes() ?>>
<div<?php echo $audittrail->id->ViewAttributes() ?>><?php echo $audittrail->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->datetime->Visible) { // datetime ?>
	<tr<?php echo $audittrail->datetime->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->datetime->FldCaption() ?></td>
		<td<?php echo $audittrail->datetime->CellAttributes() ?>>
<div<?php echo $audittrail->datetime->ViewAttributes() ?>><?php echo $audittrail->datetime->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
	<tr<?php echo $audittrail->script->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->script->FldCaption() ?></td>
		<td<?php echo $audittrail->script->CellAttributes() ?>>
<div<?php echo $audittrail->script->ViewAttributes() ?>><?php echo $audittrail->script->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
	<tr<?php echo $audittrail->user->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->user->FldCaption() ?></td>
		<td<?php echo $audittrail->user->CellAttributes() ?>>
<div<?php echo $audittrail->user->ViewAttributes() ?>><?php echo $audittrail->user->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->action->Visible) { // action ?>
	<tr<?php echo $audittrail->action->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->action->FldCaption() ?></td>
		<td<?php echo $audittrail->action->CellAttributes() ?>>
<div<?php echo $audittrail->action->ViewAttributes() ?>><?php echo $audittrail->action->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->table->Visible) { // table ?>
	<tr<?php echo $audittrail->table->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->table->FldCaption() ?></td>
		<td<?php echo $audittrail->table->CellAttributes() ?>>
<div<?php echo $audittrail->table->ViewAttributes() ?>><?php echo $audittrail->table->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->zfield->Visible) { // field ?>
	<tr<?php echo $audittrail->zfield->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->zfield->FldCaption() ?></td>
		<td<?php echo $audittrail->zfield->CellAttributes() ?>>
<div<?php echo $audittrail->zfield->ViewAttributes() ?>><?php echo $audittrail->zfield->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->keyvalue->Visible) { // keyvalue ?>
	<tr<?php echo $audittrail->keyvalue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->keyvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->keyvalue->CellAttributes() ?>>
<div<?php echo $audittrail->keyvalue->ViewAttributes() ?>><?php echo $audittrail->keyvalue->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->oldvalue->Visible) { // oldvalue ?>
	<tr<?php echo $audittrail->oldvalue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->oldvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->oldvalue->CellAttributes() ?>>
<div<?php echo $audittrail->oldvalue->ViewAttributes() ?>><?php echo $audittrail->oldvalue->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($audittrail->newvalue->Visible) { // newvalue ?>
	<tr<?php echo $audittrail->newvalue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->newvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->newvalue->CellAttributes() ?>>
<div<?php echo $audittrail->newvalue->ViewAttributes() ?>><?php echo $audittrail->newvalue->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($audittrail->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$audittrail_view->Page_Terminate();
?>
<?php

//
// Page class
//
class caudittrail_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'audittrail';

	// Page object name
	var $PageObjName = 'audittrail_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $audittrail;
		if ($audittrail->UseTokenInUrl) $PageUrl .= "t=" . $audittrail->TableVar . "&"; // Add page token
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
		global $objForm, $audittrail;
		if ($audittrail->UseTokenInUrl) {
			if ($objForm)
				return ($audittrail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($audittrail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caudittrail_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (audittrail)
		$GLOBALS["audittrail"] = new caudittrail();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'audittrail', TRUE);

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
		global $audittrail;

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
			$this->Page_Terminate("audittraillist.php");
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
		global $Language, $audittrail;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$audittrail->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $audittrail->id->QueryStringValue;
			} else {
				$sReturnUrl = "audittraillist.php"; // Return to list
			}

			// Get action
			$audittrail->CurrentAction = "I"; // Display form
			switch ($audittrail->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "audittraillist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "audittraillist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$audittrail->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $audittrail;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$audittrail->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$audittrail->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $audittrail->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$audittrail->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$audittrail->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$audittrail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $audittrail;
		$sFilter = $audittrail->KeyFilter();

		// Call Row Selecting event
		$audittrail->Row_Selecting($sFilter);

		// Load SQL based on filter
		$audittrail->CurrentFilter = $sFilter;
		$sSql = $audittrail->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$audittrail->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $audittrail;
		$audittrail->id->setDbValue($rs->fields('id'));
		$audittrail->datetime->setDbValue($rs->fields('datetime'));
		$audittrail->script->setDbValue($rs->fields('script'));
		$audittrail->user->setDbValue($rs->fields('user'));
		$audittrail->action->setDbValue($rs->fields('action'));
		$audittrail->table->setDbValue($rs->fields('table'));
		$audittrail->zfield->setDbValue($rs->fields('field'));
		$audittrail->keyvalue->setDbValue($rs->fields('keyvalue'));
		$audittrail->oldvalue->setDbValue($rs->fields('oldvalue'));
		$audittrail->newvalue->setDbValue($rs->fields('newvalue'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $audittrail;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($audittrail->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($audittrail->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($audittrail->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($audittrail->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($audittrail->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($audittrail->id->CurrentValue);
		$this->AddUrl = $audittrail->AddUrl();
		$this->EditUrl = $audittrail->EditUrl();
		$this->CopyUrl = $audittrail->CopyUrl();
		$this->DeleteUrl = $audittrail->DeleteUrl();
		$this->ListUrl = $audittrail->ListUrl();

		// Call Row_Rendering event
		$audittrail->Row_Rendering();

		// Common render codes for all row types
		// id

		$audittrail->id->CellCssStyle = ""; $audittrail->id->CellCssClass = "";
		$audittrail->id->CellAttrs = array(); $audittrail->id->ViewAttrs = array(); $audittrail->id->EditAttrs = array();

		// datetime
		$audittrail->datetime->CellCssStyle = ""; $audittrail->datetime->CellCssClass = "";
		$audittrail->datetime->CellAttrs = array(); $audittrail->datetime->ViewAttrs = array(); $audittrail->datetime->EditAttrs = array();

		// script
		$audittrail->script->CellCssStyle = ""; $audittrail->script->CellCssClass = "";
		$audittrail->script->CellAttrs = array(); $audittrail->script->ViewAttrs = array(); $audittrail->script->EditAttrs = array();

		// user
		$audittrail->user->CellCssStyle = ""; $audittrail->user->CellCssClass = "";
		$audittrail->user->CellAttrs = array(); $audittrail->user->ViewAttrs = array(); $audittrail->user->EditAttrs = array();

		// action
		$audittrail->action->CellCssStyle = ""; $audittrail->action->CellCssClass = "";
		$audittrail->action->CellAttrs = array(); $audittrail->action->ViewAttrs = array(); $audittrail->action->EditAttrs = array();

		// table
		$audittrail->table->CellCssStyle = ""; $audittrail->table->CellCssClass = "";
		$audittrail->table->CellAttrs = array(); $audittrail->table->ViewAttrs = array(); $audittrail->table->EditAttrs = array();

		// field
		$audittrail->zfield->CellCssStyle = ""; $audittrail->zfield->CellCssClass = "";
		$audittrail->zfield->CellAttrs = array(); $audittrail->zfield->ViewAttrs = array(); $audittrail->zfield->EditAttrs = array();

		// keyvalue
		$audittrail->keyvalue->CellCssStyle = ""; $audittrail->keyvalue->CellCssClass = "";
		$audittrail->keyvalue->CellAttrs = array(); $audittrail->keyvalue->ViewAttrs = array(); $audittrail->keyvalue->EditAttrs = array();

		// oldvalue
		$audittrail->oldvalue->CellCssStyle = ""; $audittrail->oldvalue->CellCssClass = "";
		$audittrail->oldvalue->CellAttrs = array(); $audittrail->oldvalue->ViewAttrs = array(); $audittrail->oldvalue->EditAttrs = array();

		// newvalue
		$audittrail->newvalue->CellCssStyle = ""; $audittrail->newvalue->CellCssClass = "";
		$audittrail->newvalue->CellAttrs = array(); $audittrail->newvalue->ViewAttrs = array(); $audittrail->newvalue->EditAttrs = array();
		if ($audittrail->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$audittrail->id->ViewValue = $audittrail->id->CurrentValue;
			$audittrail->id->CssStyle = "";
			$audittrail->id->CssClass = "";
			$audittrail->id->ViewCustomAttributes = "";

			// datetime
			$audittrail->datetime->ViewValue = $audittrail->datetime->CurrentValue;
			$audittrail->datetime->ViewValue = ew_FormatDateTime($audittrail->datetime->ViewValue, 6);
			$audittrail->datetime->CssStyle = "";
			$audittrail->datetime->CssClass = "";
			$audittrail->datetime->ViewCustomAttributes = "";

			// script
			$audittrail->script->ViewValue = $audittrail->script->CurrentValue;
			$audittrail->script->CssStyle = "";
			$audittrail->script->CssClass = "";
			$audittrail->script->ViewCustomAttributes = "";

			// user
			$audittrail->user->ViewValue = $audittrail->user->CurrentValue;
			$audittrail->user->CssStyle = "";
			$audittrail->user->CssClass = "";
			$audittrail->user->ViewCustomAttributes = "";

			// action
			$audittrail->action->ViewValue = $audittrail->action->CurrentValue;
			$audittrail->action->CssStyle = "";
			$audittrail->action->CssClass = "";
			$audittrail->action->ViewCustomAttributes = "";

			// table
			$audittrail->table->ViewValue = $audittrail->table->CurrentValue;
			$audittrail->table->CssStyle = "";
			$audittrail->table->CssClass = "";
			$audittrail->table->ViewCustomAttributes = "";

			// field
			$audittrail->zfield->ViewValue = $audittrail->zfield->CurrentValue;
			$audittrail->zfield->CssStyle = "";
			$audittrail->zfield->CssClass = "";
			$audittrail->zfield->ViewCustomAttributes = "";

			// keyvalue
			$audittrail->keyvalue->ViewValue = $audittrail->keyvalue->CurrentValue;
			$audittrail->keyvalue->CssStyle = "";
			$audittrail->keyvalue->CssClass = "";
			$audittrail->keyvalue->ViewCustomAttributes = "";

			// oldvalue
			$audittrail->oldvalue->ViewValue = $audittrail->oldvalue->CurrentValue;
			$audittrail->oldvalue->CssStyle = "";
			$audittrail->oldvalue->CssClass = "";
			$audittrail->oldvalue->ViewCustomAttributes = "";

			// newvalue
			$audittrail->newvalue->ViewValue = $audittrail->newvalue->CurrentValue;
			$audittrail->newvalue->CssStyle = "";
			$audittrail->newvalue->CssClass = "";
			$audittrail->newvalue->ViewCustomAttributes = "";

			// id
			$audittrail->id->HrefValue = "";
			$audittrail->id->TooltipValue = "";

			// datetime
			$audittrail->datetime->HrefValue = "";
			$audittrail->datetime->TooltipValue = "";

			// script
			$audittrail->script->HrefValue = "";
			$audittrail->script->TooltipValue = "";

			// user
			$audittrail->user->HrefValue = "";
			$audittrail->user->TooltipValue = "";

			// action
			$audittrail->action->HrefValue = "";
			$audittrail->action->TooltipValue = "";

			// table
			$audittrail->table->HrefValue = "";
			$audittrail->table->TooltipValue = "";

			// field
			$audittrail->zfield->HrefValue = "";
			$audittrail->zfield->TooltipValue = "";

			// keyvalue
			$audittrail->keyvalue->HrefValue = "";
			$audittrail->keyvalue->TooltipValue = "";

			// oldvalue
			$audittrail->oldvalue->HrefValue = "";
			$audittrail->oldvalue->TooltipValue = "";

			// newvalue
			$audittrail->newvalue->HrefValue = "";
			$audittrail->newvalue->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($audittrail->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$audittrail->Row_Rendered();
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
