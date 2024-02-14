<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "booking_helpersinfo.php" ?>
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
$booking_helpers_view = new cbooking_helpers_view();
$Page =& $booking_helpers_view;

// Page init
$booking_helpers_view->Page_Init();

// Page main
$booking_helpers_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($booking_helpers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var booking_helpers_view = new ew_Page("booking_helpers_view");

// page properties
booking_helpers_view.PageID = "view"; // page ID
booking_helpers_view.FormID = "fbooking_helpersview"; // form ID
var EW_PAGE_ID = booking_helpers_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
booking_helpers_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
booking_helpers_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
booking_helpers_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $booking_helpers->TableCaption() ?>
<br><br>
<?php if ($booking_helpers->Export == "") { ?>
<a href="<?php echo $booking_helpers_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $booking_helpers_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $booking_helpers_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $booking_helpers_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$booking_helpers_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($booking_helpers->id->Visible) { // id ?>
	<tr<?php echo $booking_helpers->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $booking_helpers->id->FldCaption() ?></td>
		<td<?php echo $booking_helpers->id->CellAttributes() ?>>
<div<?php echo $booking_helpers->id->ViewAttributes() ?>><?php echo $booking_helpers->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($booking_helpers->Booking_ID->Visible) { // Booking_ID ?>
	<tr<?php echo $booking_helpers->Booking_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $booking_helpers->Booking_ID->FldCaption() ?></td>
		<td<?php echo $booking_helpers->Booking_ID->CellAttributes() ?>>
<div<?php echo $booking_helpers->Booking_ID->ViewAttributes() ?>><?php echo $booking_helpers->Booking_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($booking_helpers->Helper_ID->Visible) { // Helper_ID ?>
	<tr<?php echo $booking_helpers->Helper_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $booking_helpers->Helper_ID->FldCaption() ?></td>
		<td<?php echo $booking_helpers->Helper_ID->CellAttributes() ?>>
<div<?php echo $booking_helpers->Helper_ID->ViewAttributes() ?>><?php echo $booking_helpers->Helper_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($booking_helpers->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $booking_helpers->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $booking_helpers->Remarks->FldCaption() ?></td>
		<td<?php echo $booking_helpers->Remarks->CellAttributes() ?>>
<div<?php echo $booking_helpers->Remarks->ViewAttributes() ?>><?php echo $booking_helpers->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($booking_helpers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$booking_helpers_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cbooking_helpers_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'booking_helpers';

	// Page object name
	var $PageObjName = 'booking_helpers_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $booking_helpers;
		if ($booking_helpers->UseTokenInUrl) $PageUrl .= "t=" . $booking_helpers->TableVar . "&"; // Add page token
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
		global $objForm, $booking_helpers;
		if ($booking_helpers->UseTokenInUrl) {
			if ($objForm)
				return ($booking_helpers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($booking_helpers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbooking_helpers_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (booking_helpers)
		$GLOBALS["booking_helpers"] = new cbooking_helpers();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'booking_helpers', TRUE);

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
		global $booking_helpers;

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
			$this->Page_Terminate("booking_helperslist.php");
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
		global $Language, $booking_helpers;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$booking_helpers->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $booking_helpers->id->QueryStringValue;
			} else {
				$sReturnUrl = "booking_helperslist.php"; // Return to list
			}

			// Get action
			$booking_helpers->CurrentAction = "I"; // Display form
			switch ($booking_helpers->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "booking_helperslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "booking_helperslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$booking_helpers->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $booking_helpers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$booking_helpers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$booking_helpers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $booking_helpers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$booking_helpers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$booking_helpers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$booking_helpers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $booking_helpers;
		$sFilter = $booking_helpers->KeyFilter();

		// Call Row Selecting event
		$booking_helpers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$booking_helpers->CurrentFilter = $sFilter;
		$sSql = $booking_helpers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$booking_helpers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $booking_helpers;
		$booking_helpers->id->setDbValue($rs->fields('id'));
		$booking_helpers->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$booking_helpers->Helper_ID->setDbValue($rs->fields('Helper_ID'));
		$booking_helpers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $booking_helpers;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($booking_helpers->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($booking_helpers->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($booking_helpers->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($booking_helpers->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($booking_helpers->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($booking_helpers->id->CurrentValue);
		$this->AddUrl = $booking_helpers->AddUrl();
		$this->EditUrl = $booking_helpers->EditUrl();
		$this->CopyUrl = $booking_helpers->CopyUrl();
		$this->DeleteUrl = $booking_helpers->DeleteUrl();
		$this->ListUrl = $booking_helpers->ListUrl();

		// Call Row_Rendering event
		$booking_helpers->Row_Rendering();

		// Common render codes for all row types
		// id

		$booking_helpers->id->CellCssStyle = ""; $booking_helpers->id->CellCssClass = "";
		$booking_helpers->id->CellAttrs = array(); $booking_helpers->id->ViewAttrs = array(); $booking_helpers->id->EditAttrs = array();

		// Booking_ID
		$booking_helpers->Booking_ID->CellCssStyle = ""; $booking_helpers->Booking_ID->CellCssClass = "";
		$booking_helpers->Booking_ID->CellAttrs = array(); $booking_helpers->Booking_ID->ViewAttrs = array(); $booking_helpers->Booking_ID->EditAttrs = array();

		// Helper_ID
		$booking_helpers->Helper_ID->CellCssStyle = ""; $booking_helpers->Helper_ID->CellCssClass = "";
		$booking_helpers->Helper_ID->CellAttrs = array(); $booking_helpers->Helper_ID->ViewAttrs = array(); $booking_helpers->Helper_ID->EditAttrs = array();

		// Remarks
		$booking_helpers->Remarks->CellCssStyle = ""; $booking_helpers->Remarks->CellCssClass = "";
		$booking_helpers->Remarks->CellAttrs = array(); $booking_helpers->Remarks->ViewAttrs = array(); $booking_helpers->Remarks->EditAttrs = array();
		if ($booking_helpers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$booking_helpers->id->ViewValue = $booking_helpers->id->CurrentValue;
			$booking_helpers->id->CssStyle = "";
			$booking_helpers->id->CssClass = "";
			$booking_helpers->id->ViewCustomAttributes = "";

			// Booking_ID
			if (strval($booking_helpers->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$booking_helpers->Booking_ID->ViewValue = $booking_helpers->Booking_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Booking_ID->ViewValue = NULL;
			}
			$booking_helpers->Booking_ID->CssStyle = "";
			$booking_helpers->Booking_ID->CssClass = "";
			$booking_helpers->Booking_ID->ViewCustomAttributes = "";

			// Helper_ID
			if (strval($booking_helpers->Helper_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Helper_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Helper_Name` FROM `helpers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Helper_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Helper_ID->ViewValue = $rswrk->fields('Helper_Name');
					$rswrk->Close();
				} else {
					$booking_helpers->Helper_ID->ViewValue = $booking_helpers->Helper_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Helper_ID->ViewValue = NULL;
			}
			$booking_helpers->Helper_ID->CssStyle = "";
			$booking_helpers->Helper_ID->CssClass = "";
			$booking_helpers->Helper_ID->ViewCustomAttributes = "";

			// Remarks
			$booking_helpers->Remarks->ViewValue = $booking_helpers->Remarks->CurrentValue;
			$booking_helpers->Remarks->CssStyle = "";
			$booking_helpers->Remarks->CssClass = "";
			$booking_helpers->Remarks->ViewCustomAttributes = "";

			// id
			$booking_helpers->id->HrefValue = "";
			$booking_helpers->id->TooltipValue = "";

			// Booking_ID
			$booking_helpers->Booking_ID->HrefValue = "";
			$booking_helpers->Booking_ID->TooltipValue = "";

			// Helper_ID
			$booking_helpers->Helper_ID->HrefValue = "";
			$booking_helpers->Helper_ID->TooltipValue = "";

			// Remarks
			$booking_helpers->Remarks->HrefValue = "";
			$booking_helpers->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($booking_helpers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$booking_helpers->Row_Rendered();
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
