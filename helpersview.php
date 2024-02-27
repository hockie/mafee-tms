<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "helpersinfo.php" ?>
<?php include "subconsinfo.php" ?>
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
$helpers_view = new chelpers_view();
$Page =& $helpers_view;

// Page init
$helpers_view->Page_Init();

// Page main
$helpers_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($helpers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var helpers_view = new ew_Page("helpers_view");

// page properties
helpers_view.PageID = "view"; // page ID
helpers_view.FormID = "fhelpersview"; // form ID
var EW_PAGE_ID = helpers_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
helpers_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
helpers_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
helpers_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $helpers->TableCaption() ?>
<br><br>
<?php if ($helpers->Export == "") { ?>
<a href="<?php echo $helpers_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $helpers_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $helpers_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $helpers_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$helpers_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($helpers->id->Visible) { // id ?>
	<tr<?php echo $helpers->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->id->FldCaption() ?></td>
		<td<?php echo $helpers->id->CellAttributes() ?>>
<div<?php echo $helpers->id->ViewAttributes() ?>><?php echo $helpers->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($helpers->Helper_Name->Visible) { // Helper_Name ?>
	<tr<?php echo $helpers->Helper_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Helper_Name->FldCaption() ?></td>
		<td<?php echo $helpers->Helper_Name->CellAttributes() ?>>
<div<?php echo $helpers->Helper_Name->ViewAttributes() ?>><?php echo $helpers->Helper_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($helpers->Subcon_ID->Visible) { // Subcon_ID ?>
	<tr<?php echo $helpers->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $helpers->Subcon_ID->CellAttributes() ?>>
<div<?php echo $helpers->Subcon_ID->ViewAttributes() ?>><?php echo $helpers->Subcon_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($helpers->Address->Visible) { // Address ?>
	<tr<?php echo $helpers->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Address->FldCaption() ?></td>
		<td<?php echo $helpers->Address->CellAttributes() ?>>
<div<?php echo $helpers->Address->ViewAttributes() ?>><?php echo $helpers->Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($helpers->Phone->Visible) { // Phone ?>
	<tr<?php echo $helpers->Phone->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Phone->FldCaption() ?></td>
		<td<?php echo $helpers->Phone->CellAttributes() ?>>
<div<?php echo $helpers->Phone->ViewAttributes() ?>><?php echo $helpers->Phone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($helpers->Uploads->Visible) { // Uploads ?>
	<tr<?php echo $helpers->Uploads->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Uploads->FldCaption() ?></td>
		<td<?php echo $helpers->Uploads->CellAttributes() ?>>
<?php if ($helpers->Uploads->HrefValue <> "" || $helpers->Uploads->TooltipValue <> "") { ?>
<?php if (!empty($helpers->Uploads->Upload->DbValue)) { ?>
<a href="<?php echo $helpers->Uploads->HrefValue ?>"><?php echo $helpers->Uploads->ViewValue ?></a>
<?php } elseif (!in_array($helpers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($helpers->Uploads->Upload->DbValue)) { ?>
<?php echo $helpers->Uploads->ViewValue ?>
<?php } elseif (!in_array($helpers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($helpers->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $helpers->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Remarks->FldCaption() ?></td>
		<td<?php echo $helpers->Remarks->CellAttributes() ?>>
<div<?php echo $helpers->Remarks->ViewAttributes() ?>><?php echo $helpers->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($helpers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$helpers_view->Page_Terminate();
?>
<?php

//
// Page class
//
class chelpers_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'helpers';

	// Page object name
	var $PageObjName = 'helpers_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $helpers;
		if ($helpers->UseTokenInUrl) $PageUrl .= "t=" . $helpers->TableVar . "&"; // Add page token
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
		global $objForm, $helpers;
		if ($helpers->UseTokenInUrl) {
			if ($objForm)
				return ($helpers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($helpers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function chelpers_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (helpers)
		$GLOBALS["helpers"] = new chelpers();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'helpers', TRUE);

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
		global $helpers;

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
			$this->Page_Terminate("helperslist.php");
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
		global $Language, $helpers;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$helpers->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $helpers->id->QueryStringValue;
			} else {
				$sReturnUrl = "helperslist.php"; // Return to list
			}

			// Get action
			$helpers->CurrentAction = "I"; // Display form
			switch ($helpers->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "helperslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "helperslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$helpers->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $helpers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$helpers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$helpers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $helpers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$helpers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$helpers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$helpers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $helpers;
		$sFilter = $helpers->KeyFilter();

		// Call Row Selecting event
		$helpers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$helpers->CurrentFilter = $sFilter;
		$sSql = $helpers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$helpers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $helpers;
		$helpers->id->setDbValue($rs->fields('id'));
		$helpers->Helper_Name->setDbValue($rs->fields('Helper_Name'));
		$helpers->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$helpers->Address->setDbValue($rs->fields('Address'));
		$helpers->Phone->setDbValue($rs->fields('Phone'));
		$helpers->Uploads->Upload->DbValue = $rs->fields('Uploads');
		$helpers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $helpers;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($helpers->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($helpers->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($helpers->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($helpers->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($helpers->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($helpers->id->CurrentValue);
		$this->AddUrl = $helpers->AddUrl();
		$this->EditUrl = $helpers->EditUrl();
		$this->CopyUrl = $helpers->CopyUrl();
		$this->DeleteUrl = $helpers->DeleteUrl();
		$this->ListUrl = $helpers->ListUrl();

		// Call Row_Rendering event
		$helpers->Row_Rendering();

		// Common render codes for all row types
		// id

		$helpers->id->CellCssStyle = ""; $helpers->id->CellCssClass = "";
		$helpers->id->CellAttrs = array(); $helpers->id->ViewAttrs = array(); $helpers->id->EditAttrs = array();

		// Helper_Name
		$helpers->Helper_Name->CellCssStyle = ""; $helpers->Helper_Name->CellCssClass = "";
		$helpers->Helper_Name->CellAttrs = array(); $helpers->Helper_Name->ViewAttrs = array(); $helpers->Helper_Name->EditAttrs = array();

		// Subcon_ID
		$helpers->Subcon_ID->CellCssStyle = ""; $helpers->Subcon_ID->CellCssClass = "";
		$helpers->Subcon_ID->CellAttrs = array(); $helpers->Subcon_ID->ViewAttrs = array(); $helpers->Subcon_ID->EditAttrs = array();

		// Address
		$helpers->Address->CellCssStyle = ""; $helpers->Address->CellCssClass = "";
		$helpers->Address->CellAttrs = array(); $helpers->Address->ViewAttrs = array(); $helpers->Address->EditAttrs = array();

		// Phone
		$helpers->Phone->CellCssStyle = ""; $helpers->Phone->CellCssClass = "";
		$helpers->Phone->CellAttrs = array(); $helpers->Phone->ViewAttrs = array(); $helpers->Phone->EditAttrs = array();

		// Uploads
		$helpers->Uploads->CellCssStyle = ""; $helpers->Uploads->CellCssClass = "";
		$helpers->Uploads->CellAttrs = array(); $helpers->Uploads->ViewAttrs = array(); $helpers->Uploads->EditAttrs = array();

		// Remarks
		$helpers->Remarks->CellCssStyle = ""; $helpers->Remarks->CellCssClass = "";
		$helpers->Remarks->CellAttrs = array(); $helpers->Remarks->ViewAttrs = array(); $helpers->Remarks->EditAttrs = array();
		if ($helpers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$helpers->id->ViewValue = $helpers->id->CurrentValue;
			$helpers->id->CssStyle = "";
			$helpers->id->CssClass = "";
			$helpers->id->ViewCustomAttributes = "";

			// Helper_Name
			$helpers->Helper_Name->ViewValue = $helpers->Helper_Name->CurrentValue;
			$helpers->Helper_Name->CssStyle = "";
			$helpers->Helper_Name->CssClass = "";
			$helpers->Helper_Name->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($helpers->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($helpers->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$helpers->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$helpers->Subcon_ID->ViewValue = $helpers->Subcon_ID->CurrentValue;
				}
			} else {
				$helpers->Subcon_ID->ViewValue = NULL;
			}
			$helpers->Subcon_ID->CssStyle = "";
			$helpers->Subcon_ID->CssClass = "";
			$helpers->Subcon_ID->ViewCustomAttributes = "";

			// Address
			$helpers->Address->ViewValue = $helpers->Address->CurrentValue;
			$helpers->Address->CssStyle = "";
			$helpers->Address->CssClass = "";
			$helpers->Address->ViewCustomAttributes = "";

			// Phone
			$helpers->Phone->ViewValue = $helpers->Phone->CurrentValue;
			$helpers->Phone->CssStyle = "";
			$helpers->Phone->CssClass = "";
			$helpers->Phone->ViewCustomAttributes = "";

			// Uploads
			if (!ew_Empty($helpers->Uploads->Upload->DbValue)) {
				$helpers->Uploads->ViewValue = $helpers->Uploads->Upload->DbValue;
			} else {
				$helpers->Uploads->ViewValue = "";
			}
			$helpers->Uploads->CssStyle = "";
			$helpers->Uploads->CssClass = "";
			$helpers->Uploads->ViewCustomAttributes = "";

			// Remarks
			$helpers->Remarks->ViewValue = $helpers->Remarks->CurrentValue;
			$helpers->Remarks->CssStyle = "";
			$helpers->Remarks->CssClass = "";
			$helpers->Remarks->ViewCustomAttributes = "";

			// id
			$helpers->id->HrefValue = "";
			$helpers->id->TooltipValue = "";

			// Helper_Name
			$helpers->Helper_Name->HrefValue = "";
			$helpers->Helper_Name->TooltipValue = "";

			// Subcon_ID
			$helpers->Subcon_ID->HrefValue = "";
			$helpers->Subcon_ID->TooltipValue = "";

			// Address
			$helpers->Address->HrefValue = "";
			$helpers->Address->TooltipValue = "";

			// Phone
			$helpers->Phone->HrefValue = "";
			$helpers->Phone->TooltipValue = "";

			// Uploads
			if (!ew_Empty($helpers->Uploads->Upload->DbValue)) {
				$helpers->Uploads->HrefValue = ew_UploadPathEx(FALSE, $helpers->Uploads->UploadPath) . ((!empty($helpers->Uploads->ViewValue)) ? $helpers->Uploads->ViewValue : $helpers->Uploads->CurrentValue);
				if ($helpers->Export <> "") $helpers->Uploads->HrefValue = ew_ConvertFullUrl($helpers->Uploads->HrefValue);
			} else {
				$helpers->Uploads->HrefValue = "";
			}
			$helpers->Uploads->TooltipValue = "";

			// Remarks
			$helpers->Remarks->HrefValue = "";
			$helpers->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($helpers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$helpers->Row_Rendered();
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
