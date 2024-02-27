<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "originsinfo.php" ?>
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
$origins_view = new corigins_view();
$Page =& $origins_view;

// Page init
$origins_view->Page_Init();

// Page main
$origins_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($origins->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var origins_view = new ew_Page("origins_view");

// page properties
origins_view.PageID = "view"; // page ID
origins_view.FormID = "foriginsview"; // form ID
var EW_PAGE_ID = origins_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
origins_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
origins_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
origins_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
origins_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $origins->TableCaption() ?>
<br><br>
<?php if ($origins->Export == "") { ?>
<a href="<?php echo $origins_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $origins_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $origins_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $origins_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$origins_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($origins->id->Visible) { // id ?>
	<tr<?php echo $origins->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $origins->id->FldCaption() ?></td>
		<td<?php echo $origins->id->CellAttributes() ?>>
<div<?php echo $origins->id->ViewAttributes() ?>><?php echo $origins->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($origins->Client->Visible) { // Client ?>
	<tr<?php echo $origins->Client->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $origins->Client->FldCaption() ?></td>
		<td<?php echo $origins->Client->CellAttributes() ?>>
<div<?php echo $origins->Client->ViewAttributes() ?>><?php echo $origins->Client->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($origins->Origin->Visible) { // Origin ?>
	<tr<?php echo $origins->Origin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $origins->Origin->FldCaption() ?></td>
		<td<?php echo $origins->Origin->CellAttributes() ?>>
<div<?php echo $origins->Origin->ViewAttributes() ?>><?php echo $origins->Origin->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($origins->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$origins_view->Page_Terminate();
?>
<?php

//
// Page class
//
class corigins_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'origins';

	// Page object name
	var $PageObjName = 'origins_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $origins;
		if ($origins->UseTokenInUrl) $PageUrl .= "t=" . $origins->TableVar . "&"; // Add page token
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
		global $objForm, $origins;
		if ($origins->UseTokenInUrl) {
			if ($objForm)
				return ($origins->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($origins->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function corigins_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (origins)
		$GLOBALS["origins"] = new corigins();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'origins', TRUE);

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
		global $origins;

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
			$this->Page_Terminate("originslist.php");
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
		global $Language, $origins;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$origins->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $origins->id->QueryStringValue;
			} else {
				$sReturnUrl = "originslist.php"; // Return to list
			}

			// Get action
			$origins->CurrentAction = "I"; // Display form
			switch ($origins->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "originslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "originslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$origins->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $origins;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$origins->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$origins->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $origins->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$origins->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$origins->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$origins->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $origins;
		$sFilter = $origins->KeyFilter();

		// Call Row Selecting event
		$origins->Row_Selecting($sFilter);

		// Load SQL based on filter
		$origins->CurrentFilter = $sFilter;
		$sSql = $origins->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$origins->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $origins;
		$origins->id->setDbValue($rs->fields('id'));
		$origins->Client->setDbValue($rs->fields('Client'));
		$origins->Origin->setDbValue($rs->fields('Origin'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $origins;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($origins->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($origins->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($origins->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($origins->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($origins->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($origins->id->CurrentValue);
		$this->AddUrl = $origins->AddUrl();
		$this->EditUrl = $origins->EditUrl();
		$this->CopyUrl = $origins->CopyUrl();
		$this->DeleteUrl = $origins->DeleteUrl();
		$this->ListUrl = $origins->ListUrl();

		// Call Row_Rendering event
		$origins->Row_Rendering();

		// Common render codes for all row types
		// id

		$origins->id->CellCssStyle = ""; $origins->id->CellCssClass = "";
		$origins->id->CellAttrs = array(); $origins->id->ViewAttrs = array(); $origins->id->EditAttrs = array();

		// Client
		$origins->Client->CellCssStyle = ""; $origins->Client->CellCssClass = "";
		$origins->Client->CellAttrs = array(); $origins->Client->ViewAttrs = array(); $origins->Client->EditAttrs = array();

		// Origin
		$origins->Origin->CellCssStyle = ""; $origins->Origin->CellCssClass = "";
		$origins->Origin->CellAttrs = array(); $origins->Origin->ViewAttrs = array(); $origins->Origin->EditAttrs = array();
		if ($origins->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$origins->id->ViewValue = $origins->id->CurrentValue;
			$origins->id->CssStyle = "";
			$origins->id->CssClass = "";
			$origins->id->ViewCustomAttributes = "";

			// Client
			if (strval($origins->Client->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($origins->Client->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$origins->Client->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$origins->Client->ViewValue = $origins->Client->CurrentValue;
				}
			} else {
				$origins->Client->ViewValue = NULL;
			}
			$origins->Client->CssStyle = "";
			$origins->Client->CssClass = "";
			$origins->Client->ViewCustomAttributes = "";

			// Origin
			$origins->Origin->ViewValue = $origins->Origin->CurrentValue;
			$origins->Origin->CssStyle = "";
			$origins->Origin->CssClass = "";
			$origins->Origin->ViewCustomAttributes = "";

			// id
			$origins->id->HrefValue = "";
			$origins->id->TooltipValue = "";

			// Client
			$origins->Client->HrefValue = "";
			$origins->Client->TooltipValue = "";

			// Origin
			$origins->Origin->HrefValue = "";
			$origins->Origin->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($origins->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$origins->Row_Rendered();
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
