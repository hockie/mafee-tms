<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "subconsinfo.php" ?>
<?php include "bookingsinfo.php" ?>
<?php include "truck_driversinfo.php" ?>
<?php include "helpersinfo.php" ?>
<?php include "trucksinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "file_uploads_subconsinfo.php" ?>
<?php include "vendor_billinfo.php" ?>
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
$subcons_view = new csubcons_view();
$Page =& $subcons_view;

// Page init
$subcons_view->Page_Init();

// Page main
$subcons_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($subcons->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subcons_view = new ew_Page("subcons_view");

// page properties
subcons_view.PageID = "view"; // page ID
subcons_view.FormID = "fsubconsview"; // form ID
var EW_PAGE_ID = subcons_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subcons_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subcons_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subcons_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subcons_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subcons->TableCaption() ?>
<br><br>
<?php if ($subcons->Export == "") { ?>
<a href="<?php echo $subcons_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $subcons_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $subcons_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $subcons_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('truck_drivers')) { ?>
<a href="truck_driverslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=subcons&id=<?php echo urlencode(strval($subcons->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("truck_drivers", "TblCaption") ?>
<?php echo str_replace("%c", $subcons_view->ltruck_drivers_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('helpers')) { ?>
<a href="helperslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=subcons&id=<?php echo urlencode(strval($subcons->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("helpers", "TblCaption") ?>
<?php echo str_replace("%c", $subcons_view->lhelpers_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('file_uploads_subcons')) { ?>
<a href="file_uploads_subconslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=subcons&id=<?php echo urlencode(strval($subcons->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("file_uploads_subcons", "TblCaption") ?>
<?php echo str_replace("%c", $subcons_view->lfile_uploads_subcons_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('trucks')) { ?>
<a href="truckslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=subcons&id=<?php echo urlencode(strval($subcons->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("trucks", "TblCaption") ?>
<?php echo str_replace("%c", $subcons_view->ltrucks_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('vendor_bill')) { ?>
<a href="vendor_billlist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=subcons&id=<?php echo urlencode(strval($subcons->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("vendor_bill", "TblCaption") ?>
<?php echo str_replace("%c", $subcons_view->lvendor_bill_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('bookings')) { ?>
<a href="bookingslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=subcons&id=<?php echo urlencode(strval($subcons->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("bookings", "TblCaption") ?>
<?php echo str_replace("%c", $subcons_view->lbookings_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subcons_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subcons->id->Visible) { // id ?>
	<tr<?php echo $subcons->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->id->FldCaption() ?></td>
		<td<?php echo $subcons->id->CellAttributes() ?>>
<div<?php echo $subcons->id->ViewAttributes() ?>><?php echo $subcons->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subcons->Subcon_ID->Visible) { // Subcon_ID ?>
	<tr<?php echo $subcons->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $subcons->Subcon_ID->CellAttributes() ?>>
<div<?php echo $subcons->Subcon_ID->ViewAttributes() ?>><?php echo $subcons->Subcon_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subcons->Subcon_Name->Visible) { // Subcon_Name ?>
	<tr<?php echo $subcons->Subcon_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Subcon_Name->FldCaption() ?></td>
		<td<?php echo $subcons->Subcon_Name->CellAttributes() ?>>
<div<?php echo $subcons->Subcon_Name->ViewAttributes() ?>><?php echo $subcons->Subcon_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subcons->Address->Visible) { // Address ?>
	<tr<?php echo $subcons->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Address->FldCaption() ?></td>
		<td<?php echo $subcons->Address->CellAttributes() ?>>
<div<?php echo $subcons->Address->ViewAttributes() ?>><?php echo $subcons->Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subcons->ContactNo->Visible) { // ContactNo ?>
	<tr<?php echo $subcons->ContactNo->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->ContactNo->FldCaption() ?></td>
		<td<?php echo $subcons->ContactNo->CellAttributes() ?>>
<div<?php echo $subcons->ContactNo->ViewAttributes() ?>><?php echo $subcons->ContactNo->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subcons->Email_Address->Visible) { // Email_Address ?>
	<tr<?php echo $subcons->Email_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Email_Address->FldCaption() ?></td>
		<td<?php echo $subcons->Email_Address->CellAttributes() ?>>
<div<?php echo $subcons->Email_Address->ViewAttributes() ?>><?php echo $subcons->Email_Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subcons->TIN_No->Visible) { // TIN_No ?>
	<tr<?php echo $subcons->TIN_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->TIN_No->FldCaption() ?></td>
		<td<?php echo $subcons->TIN_No->CellAttributes() ?>>
<div<?php echo $subcons->TIN_No->ViewAttributes() ?>><?php echo $subcons->TIN_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subcons->ContactPerson->Visible) { // ContactPerson ?>
	<tr<?php echo $subcons->ContactPerson->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->ContactPerson->FldCaption() ?></td>
		<td<?php echo $subcons->ContactPerson->CellAttributes() ?>>
<div<?php echo $subcons->ContactPerson->ViewAttributes() ?>><?php echo $subcons->ContactPerson->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subcons->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $subcons->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->File_Upload->FldCaption() ?></td>
		<td<?php echo $subcons->File_Upload->CellAttributes() ?>>
<?php if ($subcons->File_Upload->HrefValue <> "" || $subcons->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $subcons->File_Upload->HrefValue ?>"><?php echo $subcons->File_Upload->ViewValue ?></a>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<?php echo $subcons->File_Upload->ViewValue ?>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($subcons->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $subcons->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Remarks->FldCaption() ?></td>
		<td<?php echo $subcons->Remarks->CellAttributes() ?>>
<div<?php echo $subcons->Remarks->ViewAttributes() ?>><?php echo $subcons->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($subcons->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$subcons_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csubcons_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'subcons';

	// Page object name
	var $PageObjName = 'subcons_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subcons;
		if ($subcons->UseTokenInUrl) $PageUrl .= "t=" . $subcons->TableVar . "&"; // Add page token
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
		global $objForm, $subcons;
		if ($subcons->UseTokenInUrl) {
			if ($objForm)
				return ($subcons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subcons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubcons_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subcons)
		$GLOBALS["subcons"] = new csubcons();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (truck_drivers)
		$GLOBALS['truck_drivers'] = new ctruck_drivers();

		// Table object (helpers)
		$GLOBALS['helpers'] = new chelpers();

		// Table object (trucks)
		$GLOBALS['trucks'] = new ctrucks();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (file_uploads_subcons)
		$GLOBALS['file_uploads_subcons'] = new cfile_uploads_subcons();

		// Table object (vendor_bill)
		$GLOBALS['vendor_bill'] = new cvendor_bill();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subcons', TRUE);

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
		global $subcons;

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
			$this->Page_Terminate("subconslist.php");
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
	var $ltruck_drivers_Count;
	var $lhelpers_Count;
	var $lfile_uploads_subcons_Count;
	var $ltrucks_Count;
	var $lvendor_bill_Count;
	var $lbookings_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $subcons;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$subcons->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $subcons->id->QueryStringValue;
			} else {
				$sReturnUrl = "subconslist.php"; // Return to list
			}

			// Get action
			$subcons->CurrentAction = "I"; // Display form
			switch ($subcons->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "subconslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "subconslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$subcons->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subcons;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$subcons->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$subcons->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $subcons->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$subcons->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$subcons->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$subcons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subcons;
		$sFilter = $subcons->KeyFilter();

		// Call Row Selecting event
		$subcons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subcons->CurrentFilter = $sFilter;
		$sSql = $subcons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subcons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subcons;
		$subcons->id->setDbValue($rs->fields('id'));
		$subcons->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$subcons->Subcon_Name->setDbValue($rs->fields('Subcon_Name'));
		$subcons->Address->setDbValue($rs->fields('Address'));
		$subcons->ContactNo->setDbValue($rs->fields('ContactNo'));
		$subcons->Email_Address->setDbValue($rs->fields('Email_Address'));
		$subcons->TIN_No->setDbValue($rs->fields('TIN_No'));
		$subcons->ContactPerson->setDbValue($rs->fields('ContactPerson'));
		$subcons->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$subcons->Remarks->setDbValue($rs->fields('Remarks'));
		$sDetailFilter = $GLOBALS["truck_drivers"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->ltruck_drivers_Count = $GLOBALS["truck_drivers"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["helpers"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->lhelpers_Count = $GLOBALS["helpers"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["file_uploads_subcons"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->lfile_uploads_subcons_Count = $GLOBALS["file_uploads_subcons"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["trucks"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Sub_Con_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->ltrucks_Count = $GLOBALS["trucks"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["vendor_bill"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@vendor_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->lvendor_bill_Count = $GLOBALS["vendor_bill"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["bookings"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->lbookings_Count = $GLOBALS["bookings"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subcons;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($subcons->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($subcons->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($subcons->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($subcons->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($subcons->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($subcons->id->CurrentValue);
		$this->AddUrl = $subcons->AddUrl();
		$this->EditUrl = $subcons->EditUrl();
		$this->CopyUrl = $subcons->CopyUrl();
		$this->DeleteUrl = $subcons->DeleteUrl();
		$this->ListUrl = $subcons->ListUrl();

		// Call Row_Rendering event
		$subcons->Row_Rendering();

		// Common render codes for all row types
		// id

		$subcons->id->CellCssStyle = ""; $subcons->id->CellCssClass = "";
		$subcons->id->CellAttrs = array(); $subcons->id->ViewAttrs = array(); $subcons->id->EditAttrs = array();

		// Subcon_ID
		$subcons->Subcon_ID->CellCssStyle = ""; $subcons->Subcon_ID->CellCssClass = "";
		$subcons->Subcon_ID->CellAttrs = array(); $subcons->Subcon_ID->ViewAttrs = array(); $subcons->Subcon_ID->EditAttrs = array();

		// Subcon_Name
		$subcons->Subcon_Name->CellCssStyle = ""; $subcons->Subcon_Name->CellCssClass = "";
		$subcons->Subcon_Name->CellAttrs = array(); $subcons->Subcon_Name->ViewAttrs = array(); $subcons->Subcon_Name->EditAttrs = array();

		// Address
		$subcons->Address->CellCssStyle = ""; $subcons->Address->CellCssClass = "";
		$subcons->Address->CellAttrs = array(); $subcons->Address->ViewAttrs = array(); $subcons->Address->EditAttrs = array();

		// ContactNo
		$subcons->ContactNo->CellCssStyle = ""; $subcons->ContactNo->CellCssClass = "";
		$subcons->ContactNo->CellAttrs = array(); $subcons->ContactNo->ViewAttrs = array(); $subcons->ContactNo->EditAttrs = array();

		// Email_Address
		$subcons->Email_Address->CellCssStyle = ""; $subcons->Email_Address->CellCssClass = "";
		$subcons->Email_Address->CellAttrs = array(); $subcons->Email_Address->ViewAttrs = array(); $subcons->Email_Address->EditAttrs = array();

		// TIN_No
		$subcons->TIN_No->CellCssStyle = ""; $subcons->TIN_No->CellCssClass = "";
		$subcons->TIN_No->CellAttrs = array(); $subcons->TIN_No->ViewAttrs = array(); $subcons->TIN_No->EditAttrs = array();

		// ContactPerson
		$subcons->ContactPerson->CellCssStyle = ""; $subcons->ContactPerson->CellCssClass = "";
		$subcons->ContactPerson->CellAttrs = array(); $subcons->ContactPerson->ViewAttrs = array(); $subcons->ContactPerson->EditAttrs = array();

		// File_Upload
		$subcons->File_Upload->CellCssStyle = ""; $subcons->File_Upload->CellCssClass = "";
		$subcons->File_Upload->CellAttrs = array(); $subcons->File_Upload->ViewAttrs = array(); $subcons->File_Upload->EditAttrs = array();

		// Remarks
		$subcons->Remarks->CellCssStyle = ""; $subcons->Remarks->CellCssClass = "";
		$subcons->Remarks->CellAttrs = array(); $subcons->Remarks->ViewAttrs = array(); $subcons->Remarks->EditAttrs = array();
		if ($subcons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$subcons->id->ViewValue = $subcons->id->CurrentValue;
			$subcons->id->CssStyle = "";
			$subcons->id->CssClass = "";
			$subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			$subcons->Subcon_ID->ViewValue = $subcons->Subcon_ID->CurrentValue;
			$subcons->Subcon_ID->CssStyle = "";
			$subcons->Subcon_ID->CssClass = "";
			$subcons->Subcon_ID->ViewCustomAttributes = "";

			// Subcon_Name
			$subcons->Subcon_Name->ViewValue = $subcons->Subcon_Name->CurrentValue;
			$subcons->Subcon_Name->CssStyle = "";
			$subcons->Subcon_Name->CssClass = "";
			$subcons->Subcon_Name->ViewCustomAttributes = "";

			// Address
			$subcons->Address->ViewValue = $subcons->Address->CurrentValue;
			$subcons->Address->CssStyle = "";
			$subcons->Address->CssClass = "";
			$subcons->Address->ViewCustomAttributes = "";

			// ContactNo
			$subcons->ContactNo->ViewValue = $subcons->ContactNo->CurrentValue;
			$subcons->ContactNo->CssStyle = "";
			$subcons->ContactNo->CssClass = "";
			$subcons->ContactNo->ViewCustomAttributes = "";

			// Email_Address
			$subcons->Email_Address->ViewValue = $subcons->Email_Address->CurrentValue;
			$subcons->Email_Address->CssStyle = "";
			$subcons->Email_Address->CssClass = "";
			$subcons->Email_Address->ViewCustomAttributes = "";

			// TIN_No
			$subcons->TIN_No->ViewValue = $subcons->TIN_No->CurrentValue;
			$subcons->TIN_No->CssStyle = "";
			$subcons->TIN_No->CssClass = "";
			$subcons->TIN_No->ViewCustomAttributes = "";

			// ContactPerson
			$subcons->ContactPerson->ViewValue = $subcons->ContactPerson->CurrentValue;
			$subcons->ContactPerson->CssStyle = "";
			$subcons->ContactPerson->CssClass = "";
			$subcons->ContactPerson->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->ViewValue = $subcons->File_Upload->Upload->DbValue;
			} else {
				$subcons->File_Upload->ViewValue = "";
			}
			$subcons->File_Upload->CssStyle = "";
			$subcons->File_Upload->CssClass = "";
			$subcons->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$subcons->Remarks->ViewValue = $subcons->Remarks->CurrentValue;
			$subcons->Remarks->CssStyle = "";
			$subcons->Remarks->CssClass = "";
			$subcons->Remarks->ViewCustomAttributes = "";

			// id
			$subcons->id->HrefValue = "";
			$subcons->id->TooltipValue = "";

			// Subcon_ID
			$subcons->Subcon_ID->HrefValue = "";
			$subcons->Subcon_ID->TooltipValue = "";

			// Subcon_Name
			$subcons->Subcon_Name->HrefValue = "";
			$subcons->Subcon_Name->TooltipValue = "";

			// Address
			$subcons->Address->HrefValue = "";
			$subcons->Address->TooltipValue = "";

			// ContactNo
			$subcons->ContactNo->HrefValue = "";
			$subcons->ContactNo->TooltipValue = "";

			// Email_Address
			$subcons->Email_Address->HrefValue = "";
			$subcons->Email_Address->TooltipValue = "";

			// TIN_No
			$subcons->TIN_No->HrefValue = "";
			$subcons->TIN_No->TooltipValue = "";

			// ContactPerson
			$subcons->ContactPerson->HrefValue = "";
			$subcons->ContactPerson->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $subcons->File_Upload->UploadPath) . ((!empty($subcons->File_Upload->ViewValue)) ? $subcons->File_Upload->ViewValue : $subcons->File_Upload->CurrentValue);
				if ($subcons->Export <> "") $subcons->File_Upload->HrefValue = ew_ConvertFullUrl($subcons->File_Upload->HrefValue);
			} else {
				$subcons->File_Upload->HrefValue = "";
			}
			$subcons->File_Upload->TooltipValue = "";

			// Remarks
			$subcons->Remarks->HrefValue = "";
			$subcons->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subcons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subcons->Row_Rendered();
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
