<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_uploadsinfo.php" ?>
<?php include "bookingsinfo.php" ?>
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
$file_uploads_view = new cfile_uploads_view();
$Page =& $file_uploads_view;

// Page init
$file_uploads_view->Page_Init();

// Page main
$file_uploads_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($file_uploads->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var file_uploads_view = new ew_Page("file_uploads_view");

// page properties
file_uploads_view.PageID = "view"; // page ID
file_uploads_view.FormID = "ffile_uploadsview"; // form ID
var EW_PAGE_ID = file_uploads_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
file_uploads_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
file_uploads_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
file_uploads_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_uploads_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_uploads->TableCaption() ?>
<br><br>
<?php if ($file_uploads->Export == "") { ?>
<a href="<?php echo $file_uploads_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $file_uploads_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $file_uploads_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $file_uploads_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_uploads_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($file_uploads->id->Visible) { // id ?>
	<tr<?php echo $file_uploads->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->id->FldCaption() ?></td>
		<td<?php echo $file_uploads->id->CellAttributes() ?>>
<div<?php echo $file_uploads->id->ViewAttributes() ?>><?php echo $file_uploads->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Booking_ID->Visible) { // Booking_ID ?>
	<tr<?php echo $file_uploads->Booking_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Booking_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads->Booking_ID->CellAttributes() ?>>
<div<?php echo $file_uploads->Booking_ID->ViewAttributes() ?>><?php echo $file_uploads->Booking_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Filename->Visible) { // Filename ?>
	<tr<?php echo $file_uploads->Filename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Filename->FldCaption() ?></td>
		<td<?php echo $file_uploads->Filename->CellAttributes() ?>>
<?php if ($file_uploads->Filename->HrefValue <> "" || $file_uploads->Filename->TooltipValue <> "") { ?>
<?php if (!empty($file_uploads->Filename->Upload->DbValue)) { ?>
<a href="<?php echo $file_uploads->Filename->HrefValue ?>"><?php echo $file_uploads->Filename->ViewValue ?></a>
<?php } elseif (!in_array($file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($file_uploads->Filename->Upload->DbValue)) { ?>
<?php echo $file_uploads->Filename->ViewValue ?>
<?php } elseif (!in_array($file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($file_uploads->File_Type_ID->Visible) { // File_Type_ID ?>
	<tr<?php echo $file_uploads->File_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->File_Type_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads->File_Type_ID->CellAttributes() ?>>
<div<?php echo $file_uploads->File_Type_ID->ViewAttributes() ?>><?php echo $file_uploads->File_Type_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Document_Pages->Visible) { // Document_Pages ?>
	<tr<?php echo $file_uploads->Document_Pages->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Document_Pages->FldCaption() ?></td>
		<td<?php echo $file_uploads->Document_Pages->CellAttributes() ?>>
<div<?php echo $file_uploads->Document_Pages->ViewAttributes() ?>><?php echo $file_uploads->Document_Pages->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Date_Received_Subcon->Visible) { // Date_Received_Subcon ?>
	<tr<?php echo $file_uploads->Date_Received_Subcon->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Date_Received_Subcon->FldCaption() ?></td>
		<td<?php echo $file_uploads->Date_Received_Subcon->CellAttributes() ?>>
<div<?php echo $file_uploads->Date_Received_Subcon->ViewAttributes() ?>><?php echo $file_uploads->Date_Received_Subcon->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Date_Submitted_Client->Visible) { // Date_Submitted_Client ?>
	<tr<?php echo $file_uploads->Date_Submitted_Client->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Date_Submitted_Client->FldCaption() ?></td>
		<td<?php echo $file_uploads->Date_Submitted_Client->CellAttributes() ?>>
<div<?php echo $file_uploads->Date_Submitted_Client->ViewAttributes() ?>><?php echo $file_uploads->Date_Submitted_Client->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $file_uploads->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Remarks->FldCaption() ?></td>
		<td<?php echo $file_uploads->Remarks->CellAttributes() ?>>
<div<?php echo $file_uploads->Remarks->ViewAttributes() ?>><?php echo $file_uploads->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($file_uploads->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$file_uploads_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_uploads_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'file_uploads';

	// Page object name
	var $PageObjName = 'file_uploads_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_uploads;
		if ($file_uploads->UseTokenInUrl) $PageUrl .= "t=" . $file_uploads->TableVar . "&"; // Add page token
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
		global $objForm, $file_uploads;
		if ($file_uploads->UseTokenInUrl) {
			if ($objForm)
				return ($file_uploads->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_uploads->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_uploads_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_uploads)
		$GLOBALS["file_uploads"] = new cfile_uploads();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_uploads', TRUE);

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
		global $file_uploads;

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
			$this->Page_Terminate("file_uploadslist.php");
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
		global $Language, $file_uploads;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$file_uploads->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $file_uploads->id->QueryStringValue;
			} else {
				$sReturnUrl = "file_uploadslist.php"; // Return to list
			}

			// Get action
			$file_uploads->CurrentAction = "I"; // Display form
			switch ($file_uploads->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "file_uploadslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "file_uploadslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$file_uploads->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $file_uploads;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$file_uploads->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$file_uploads->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $file_uploads->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$file_uploads->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$file_uploads->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$file_uploads->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_uploads;
		$sFilter = $file_uploads->KeyFilter();

		// Call Row Selecting event
		$file_uploads->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_uploads->CurrentFilter = $sFilter;
		$sSql = $file_uploads->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_uploads->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_uploads;
		$file_uploads->id->setDbValue($rs->fields('id'));
		$file_uploads->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$file_uploads->Filename->Upload->DbValue = $rs->fields('Filename');
		$file_uploads->File_Type_ID->setDbValue($rs->fields('File_Type_ID'));
		$file_uploads->Document_Pages->setDbValue($rs->fields('Document_Pages'));
		$file_uploads->Date_Received_Subcon->setDbValue($rs->fields('Date_Received_Subcon'));
		$file_uploads->Date_Submitted_Client->setDbValue($rs->fields('Date_Submitted_Client'));
		$file_uploads->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_uploads;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($file_uploads->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($file_uploads->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($file_uploads->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($file_uploads->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($file_uploads->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($file_uploads->id->CurrentValue);
		$this->AddUrl = $file_uploads->AddUrl();
		$this->EditUrl = $file_uploads->EditUrl();
		$this->CopyUrl = $file_uploads->CopyUrl();
		$this->DeleteUrl = $file_uploads->DeleteUrl();
		$this->ListUrl = $file_uploads->ListUrl();

		// Call Row_Rendering event
		$file_uploads->Row_Rendering();

		// Common render codes for all row types
		// id

		$file_uploads->id->CellCssStyle = ""; $file_uploads->id->CellCssClass = "";
		$file_uploads->id->CellAttrs = array(); $file_uploads->id->ViewAttrs = array(); $file_uploads->id->EditAttrs = array();

		// Booking_ID
		$file_uploads->Booking_ID->CellCssStyle = ""; $file_uploads->Booking_ID->CellCssClass = "";
		$file_uploads->Booking_ID->CellAttrs = array(); $file_uploads->Booking_ID->ViewAttrs = array(); $file_uploads->Booking_ID->EditAttrs = array();

		// Filename
		$file_uploads->Filename->CellCssStyle = ""; $file_uploads->Filename->CellCssClass = "";
		$file_uploads->Filename->CellAttrs = array(); $file_uploads->Filename->ViewAttrs = array(); $file_uploads->Filename->EditAttrs = array();

		// File_Type_ID
		$file_uploads->File_Type_ID->CellCssStyle = ""; $file_uploads->File_Type_ID->CellCssClass = "";
		$file_uploads->File_Type_ID->CellAttrs = array(); $file_uploads->File_Type_ID->ViewAttrs = array(); $file_uploads->File_Type_ID->EditAttrs = array();

		// Document_Pages
		$file_uploads->Document_Pages->CellCssStyle = ""; $file_uploads->Document_Pages->CellCssClass = "";
		$file_uploads->Document_Pages->CellAttrs = array(); $file_uploads->Document_Pages->ViewAttrs = array(); $file_uploads->Document_Pages->EditAttrs = array();

		// Date_Received_Subcon
		$file_uploads->Date_Received_Subcon->CellCssStyle = ""; $file_uploads->Date_Received_Subcon->CellCssClass = "";
		$file_uploads->Date_Received_Subcon->CellAttrs = array(); $file_uploads->Date_Received_Subcon->ViewAttrs = array(); $file_uploads->Date_Received_Subcon->EditAttrs = array();

		// Date_Submitted_Client
		$file_uploads->Date_Submitted_Client->CellCssStyle = ""; $file_uploads->Date_Submitted_Client->CellCssClass = "";
		$file_uploads->Date_Submitted_Client->CellAttrs = array(); $file_uploads->Date_Submitted_Client->ViewAttrs = array(); $file_uploads->Date_Submitted_Client->EditAttrs = array();

		// Remarks
		$file_uploads->Remarks->CellCssStyle = ""; $file_uploads->Remarks->CellCssClass = "";
		$file_uploads->Remarks->CellAttrs = array(); $file_uploads->Remarks->ViewAttrs = array(); $file_uploads->Remarks->EditAttrs = array();
		if ($file_uploads->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_uploads->id->ViewValue = $file_uploads->id->CurrentValue;
			$file_uploads->id->CssStyle = "";
			$file_uploads->id->CssClass = "";
			$file_uploads->id->ViewCustomAttributes = "";

			// Booking_ID
			if (strval($file_uploads->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Date` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$file_uploads->Booking_ID->ViewValue = $file_uploads->Booking_ID->CurrentValue;
				}
			} else {
				$file_uploads->Booking_ID->ViewValue = NULL;
			}
			$file_uploads->Booking_ID->CssStyle = "";
			$file_uploads->Booking_ID->CssClass = "";
			$file_uploads->Booking_ID->ViewCustomAttributes = "";

			// Filename
			if (!ew_Empty($file_uploads->Filename->Upload->DbValue)) {
				$file_uploads->Filename->ViewValue = $file_uploads->Filename->Upload->DbValue;
			} else {
				$file_uploads->Filename->ViewValue = "";
			}
			$file_uploads->Filename->CssStyle = "";
			$file_uploads->Filename->CssClass = "";
			$file_uploads->Filename->ViewCustomAttributes = "";

			// File_Type_ID
			if (strval($file_uploads->File_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads->File_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `File_Type` FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `File_Type` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads->File_Type_ID->ViewValue = $rswrk->fields('File_Type');
					$rswrk->Close();
				} else {
					$file_uploads->File_Type_ID->ViewValue = $file_uploads->File_Type_ID->CurrentValue;
				}
			} else {
				$file_uploads->File_Type_ID->ViewValue = NULL;
			}
			$file_uploads->File_Type_ID->CssStyle = "";
			$file_uploads->File_Type_ID->CssClass = "";
			$file_uploads->File_Type_ID->ViewCustomAttributes = "";

			// Document_Pages
			$file_uploads->Document_Pages->ViewValue = $file_uploads->Document_Pages->CurrentValue;
			$file_uploads->Document_Pages->CssStyle = "";
			$file_uploads->Document_Pages->CssClass = "";
			$file_uploads->Document_Pages->ViewCustomAttributes = "";

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->ViewValue = $file_uploads->Date_Received_Subcon->CurrentValue;
			$file_uploads->Date_Received_Subcon->ViewValue = ew_FormatDateTime($file_uploads->Date_Received_Subcon->ViewValue, 6);
			$file_uploads->Date_Received_Subcon->CssStyle = "";
			$file_uploads->Date_Received_Subcon->CssClass = "";
			$file_uploads->Date_Received_Subcon->ViewCustomAttributes = "";

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->ViewValue = $file_uploads->Date_Submitted_Client->CurrentValue;
			$file_uploads->Date_Submitted_Client->ViewValue = ew_FormatDateTime($file_uploads->Date_Submitted_Client->ViewValue, 6);
			$file_uploads->Date_Submitted_Client->CssStyle = "";
			$file_uploads->Date_Submitted_Client->CssClass = "";
			$file_uploads->Date_Submitted_Client->ViewCustomAttributes = "";

			// Remarks
			$file_uploads->Remarks->ViewValue = $file_uploads->Remarks->CurrentValue;
			$file_uploads->Remarks->CssStyle = "";
			$file_uploads->Remarks->CssClass = "";
			$file_uploads->Remarks->ViewCustomAttributes = "";

			// id
			$file_uploads->id->HrefValue = "";
			$file_uploads->id->TooltipValue = "";

			// Booking_ID
			$file_uploads->Booking_ID->HrefValue = "";
			$file_uploads->Booking_ID->TooltipValue = "";

			// Filename
			if (!ew_Empty($file_uploads->Filename->Upload->DbValue)) {
				$file_uploads->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads->Filename->UploadPath) . ((!empty($file_uploads->Filename->ViewValue)) ? $file_uploads->Filename->ViewValue : $file_uploads->Filename->CurrentValue);
				if ($file_uploads->Export <> "") $file_uploads->Filename->HrefValue = ew_ConvertFullUrl($file_uploads->Filename->HrefValue);
			} else {
				$file_uploads->Filename->HrefValue = "";
			}
			$file_uploads->Filename->TooltipValue = "";

			// File_Type_ID
			$file_uploads->File_Type_ID->HrefValue = "";
			$file_uploads->File_Type_ID->TooltipValue = "";

			// Document_Pages
			$file_uploads->Document_Pages->HrefValue = "";
			$file_uploads->Document_Pages->TooltipValue = "";

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->HrefValue = "";
			$file_uploads->Date_Received_Subcon->TooltipValue = "";

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->HrefValue = "";
			$file_uploads->Date_Submitted_Client->TooltipValue = "";

			// Remarks
			$file_uploads->Remarks->HrefValue = "";
			$file_uploads->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($file_uploads->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_uploads->Row_Rendered();
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
