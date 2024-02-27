<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "userlevelpermissionsinfo.php" ?>
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
$userlevelpermissions_view = new cuserlevelpermissions_view();
$Page =& $userlevelpermissions_view;

// Page init
$userlevelpermissions_view->Page_Init();

// Page main
$userlevelpermissions_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($userlevelpermissions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var userlevelpermissions_view = new ew_Page("userlevelpermissions_view");

// page properties
userlevelpermissions_view.PageID = "view"; // page ID
userlevelpermissions_view.FormID = "fuserlevelpermissionsview"; // form ID
var EW_PAGE_ID = userlevelpermissions_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
userlevelpermissions_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userlevelpermissions_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userlevelpermissions_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $userlevelpermissions->TableCaption() ?>
<br><br>
<?php if ($userlevelpermissions->Export == "") { ?>
<a href="<?php echo $userlevelpermissions_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $userlevelpermissions_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $userlevelpermissions_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $userlevelpermissions_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userlevelpermissions_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($userlevelpermissions->userlevelid->Visible) { // userlevelid ?>
	<tr<?php echo $userlevelpermissions->userlevelid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->userlevelid->FldCaption() ?></td>
		<td<?php echo $userlevelpermissions->userlevelid->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->userlevelid->ViewAttributes() ?>><?php echo $userlevelpermissions->userlevelid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($userlevelpermissions->ztablename->Visible) { // tablename ?>
	<tr<?php echo $userlevelpermissions->ztablename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->ztablename->FldCaption() ?></td>
		<td<?php echo $userlevelpermissions->ztablename->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->ztablename->ViewAttributes() ?>><?php echo $userlevelpermissions->ztablename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
	<tr<?php echo $userlevelpermissions->permission->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->permission->FldCaption() ?></td>
		<td<?php echo $userlevelpermissions->permission->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->permission->ViewAttributes() ?>><?php echo $userlevelpermissions->permission->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($userlevelpermissions->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$userlevelpermissions_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserlevelpermissions_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'userlevelpermissions';

	// Page object name
	var $PageObjName = 'userlevelpermissions_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) $PageUrl .= "t=" . $userlevelpermissions->TableVar . "&"; // Add page token
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
		global $objForm, $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) {
			if ($objForm)
				return ($userlevelpermissions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($userlevelpermissions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuserlevelpermissions_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (userlevelpermissions)
		$GLOBALS["userlevelpermissions"] = new cuserlevelpermissions();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'userlevelpermissions', TRUE);

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
		global $userlevelpermissions;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $Language, $userlevelpermissions;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["userlevelid"] <> "") {
				$userlevelpermissions->userlevelid->setQueryStringValue($_GET["userlevelid"]);
				$this->arRecKey["userlevelid"] = $userlevelpermissions->userlevelid->QueryStringValue;
			} else {
				$sReturnUrl = "userlevelpermissionslist.php"; // Return to list
			}
			if (@$_GET["ztablename"] <> "") {
				$userlevelpermissions->ztablename->setQueryStringValue($_GET["ztablename"]);
				$this->arRecKey["ztablename"] = $userlevelpermissions->ztablename->QueryStringValue;
			} else {
				$sReturnUrl = "userlevelpermissionslist.php"; // Return to list
			}

			// Get action
			$userlevelpermissions->CurrentAction = "I"; // Display form
			switch ($userlevelpermissions->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "userlevelpermissionslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "userlevelpermissionslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$userlevelpermissions->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $userlevelpermissions;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$userlevelpermissions->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$userlevelpermissions->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $userlevelpermissions->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$userlevelpermissions->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$userlevelpermissions->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$userlevelpermissions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $userlevelpermissions;
		$sFilter = $userlevelpermissions->KeyFilter();

		// Call Row Selecting event
		$userlevelpermissions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$userlevelpermissions->CurrentFilter = $sFilter;
		$sSql = $userlevelpermissions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$userlevelpermissions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $userlevelpermissions;
		$userlevelpermissions->userlevelid->setDbValue($rs->fields('userlevelid'));
		$userlevelpermissions->ztablename->setDbValue($rs->fields('tablename'));
		$userlevelpermissions->permission->setDbValue($rs->fields('permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $userlevelpermissions;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "userlevelid=" . urlencode($userlevelpermissions->userlevelid->CurrentValue) . "&ztablename=" . urlencode($userlevelpermissions->ztablename->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "userlevelid=" . urlencode($userlevelpermissions->userlevelid->CurrentValue) . "&ztablename=" . urlencode($userlevelpermissions->ztablename->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "userlevelid=" . urlencode($userlevelpermissions->userlevelid->CurrentValue) . "&ztablename=" . urlencode($userlevelpermissions->ztablename->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "userlevelid=" . urlencode($userlevelpermissions->userlevelid->CurrentValue) . "&ztablename=" . urlencode($userlevelpermissions->ztablename->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "userlevelid=" . urlencode($userlevelpermissions->userlevelid->CurrentValue) . "&ztablename=" . urlencode($userlevelpermissions->ztablename->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "userlevelid=" . urlencode($userlevelpermissions->userlevelid->CurrentValue) . "&ztablename=" . urlencode($userlevelpermissions->ztablename->CurrentValue);
		$this->AddUrl = $userlevelpermissions->AddUrl();
		$this->EditUrl = $userlevelpermissions->EditUrl();
		$this->CopyUrl = $userlevelpermissions->CopyUrl();
		$this->DeleteUrl = $userlevelpermissions->DeleteUrl();
		$this->ListUrl = $userlevelpermissions->ListUrl();

		// Call Row_Rendering event
		$userlevelpermissions->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$userlevelpermissions->userlevelid->CellCssStyle = ""; $userlevelpermissions->userlevelid->CellCssClass = "";
		$userlevelpermissions->userlevelid->CellAttrs = array(); $userlevelpermissions->userlevelid->ViewAttrs = array(); $userlevelpermissions->userlevelid->EditAttrs = array();

		// tablename
		$userlevelpermissions->ztablename->CellCssStyle = ""; $userlevelpermissions->ztablename->CellCssClass = "";
		$userlevelpermissions->ztablename->CellAttrs = array(); $userlevelpermissions->ztablename->ViewAttrs = array(); $userlevelpermissions->ztablename->EditAttrs = array();

		// permission
		$userlevelpermissions->permission->CellCssStyle = ""; $userlevelpermissions->permission->CellCssClass = "";
		$userlevelpermissions->permission->CellAttrs = array(); $userlevelpermissions->permission->ViewAttrs = array(); $userlevelpermissions->permission->EditAttrs = array();
		if ($userlevelpermissions->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$userlevelpermissions->userlevelid->ViewValue = $userlevelpermissions->userlevelid->CurrentValue;
			$userlevelpermissions->userlevelid->CssStyle = "";
			$userlevelpermissions->userlevelid->CssClass = "";
			$userlevelpermissions->userlevelid->ViewCustomAttributes = "";

			// tablename
			$userlevelpermissions->ztablename->ViewValue = $userlevelpermissions->ztablename->CurrentValue;
			$userlevelpermissions->ztablename->CssStyle = "";
			$userlevelpermissions->ztablename->CssClass = "";
			$userlevelpermissions->ztablename->ViewCustomAttributes = "";

			// permission
			$userlevelpermissions->permission->ViewValue = $userlevelpermissions->permission->CurrentValue;
			$userlevelpermissions->permission->CssStyle = "";
			$userlevelpermissions->permission->CssClass = "";
			$userlevelpermissions->permission->ViewCustomAttributes = "";

			// userlevelid
			$userlevelpermissions->userlevelid->HrefValue = "";
			$userlevelpermissions->userlevelid->TooltipValue = "";

			// tablename
			$userlevelpermissions->ztablename->HrefValue = "";
			$userlevelpermissions->ztablename->TooltipValue = "";

			// permission
			$userlevelpermissions->permission->HrefValue = "";
			$userlevelpermissions->permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($userlevelpermissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$userlevelpermissions->Row_Rendered();
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
