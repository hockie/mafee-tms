<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "vendor_bill_itemsinfo.php" ?>
<?php include "usersinfo.php" ?>
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
$vendor_bill_items_view = new cvendor_bill_items_view();
$Page =& $vendor_bill_items_view;

// Page init
$vendor_bill_items_view->Page_Init();

// Page main
$vendor_bill_items_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($vendor_bill_items->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var vendor_bill_items_view = new ew_Page("vendor_bill_items_view");

// page properties
vendor_bill_items_view.PageID = "view"; // page ID
vendor_bill_items_view.FormID = "fvendor_bill_itemsview"; // form ID
var EW_PAGE_ID = vendor_bill_items_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
vendor_bill_items_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
vendor_bill_items_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
vendor_bill_items_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
vendor_bill_items_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $vendor_bill_items->TableCaption() ?>
<br><br>
<?php if ($vendor_bill_items->Export == "") { ?>
<a href="<?php echo $vendor_bill_items_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $vendor_bill_items_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $vendor_bill_items_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $vendor_bill_items_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $vendor_bill_items_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$vendor_bill_items_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($vendor_bill_items->id->Visible) { // id ?>
	<tr<?php echo $vendor_bill_items->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->id->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->id->ViewAttributes() ?>><?php echo $vendor_bill_items->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->vendor_bill_id->Visible) { // vendor_bill_id ?>
	<tr<?php echo $vendor_bill_items->vendor_bill_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->vendor_bill_id->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->vendor_bill_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->vendor_bill_id->ViewAttributes() ?>><?php echo $vendor_bill_items->vendor_bill_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->vendor_id->Visible) { // vendor_id ?>
	<tr<?php echo $vendor_bill_items->vendor_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->vendor_id->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->vendor_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->vendor_id->ViewAttributes() ?>><?php echo $vendor_bill_items->vendor_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->booking_id->Visible) { // booking_id ?>
	<tr<?php echo $vendor_bill_items->booking_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->booking_id->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->booking_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->booking_id->ViewAttributes() ?>>
<?php if ($vendor_bill_items->booking_id->HrefValue <> "" || $vendor_bill_items->booking_id->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_id=<?php echo $vendor_bill_items->booking_id->HrefValue ?>"><?php echo $vendor_bill_items->booking_id->ViewValue ?></a>
<?php } else { ?>
<?php echo $vendor_bill_items->booking_id->ViewValue ?>
<?php } ?>
</div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->remarks->Visible) { // remarks ?>
	<tr<?php echo $vendor_bill_items->remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->remarks->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->remarks->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->remarks->ViewAttributes() ?>><?php echo $vendor_bill_items->remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->user_id->Visible) { // user_id ?>
	<tr<?php echo $vendor_bill_items->user_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->user_id->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->user_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->user_id->ViewAttributes() ?>><?php echo $vendor_bill_items->user_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->created->Visible) { // created ?>
	<tr<?php echo $vendor_bill_items->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->created->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->created->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->created->ViewAttributes() ?>><?php echo $vendor_bill_items->created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->modified->Visible) { // modified ?>
	<tr<?php echo $vendor_bill_items->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->modified->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->modified->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->modified->ViewAttributes() ?>><?php echo $vendor_bill_items->modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($vendor_bill_items->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$vendor_bill_items_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cvendor_bill_items_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'vendor_bill_items';

	// Page object name
	var $PageObjName = 'vendor_bill_items_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $vendor_bill_items;
		if ($vendor_bill_items->UseTokenInUrl) $PageUrl .= "t=" . $vendor_bill_items->TableVar . "&"; // Add page token
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
		global $objForm, $vendor_bill_items;
		if ($vendor_bill_items->UseTokenInUrl) {
			if ($objForm)
				return ($vendor_bill_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($vendor_bill_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cvendor_bill_items_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (vendor_bill_items)
		$GLOBALS["vendor_bill_items"] = new cvendor_bill_items();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (vendor_bill)
		$GLOBALS['vendor_bill'] = new cvendor_bill();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'vendor_bill_items', TRUE);

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
		global $vendor_bill_items;

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
			$this->Page_Terminate("vendor_bill_itemslist.php");
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
		global $Language, $vendor_bill_items;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$vendor_bill_items->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $vendor_bill_items->id->QueryStringValue;
			} else {
				$sReturnUrl = "vendor_bill_itemslist.php"; // Return to list
			}

			// Get action
			$vendor_bill_items->CurrentAction = "I"; // Display form
			switch ($vendor_bill_items->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "vendor_bill_itemslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "vendor_bill_itemslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$vendor_bill_items->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $vendor_bill_items;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$vendor_bill_items->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$vendor_bill_items->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $vendor_bill_items->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $vendor_bill_items;
		$sFilter = $vendor_bill_items->KeyFilter();

		// Call Row Selecting event
		$vendor_bill_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$vendor_bill_items->CurrentFilter = $sFilter;
		$sSql = $vendor_bill_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$vendor_bill_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $vendor_bill_items;
		$vendor_bill_items->id->setDbValue($rs->fields('id'));
		$vendor_bill_items->vendor_bill_id->setDbValue($rs->fields('vendor_bill_id'));
		$vendor_bill_items->vendor_id->setDbValue($rs->fields('vendor_id'));
		$vendor_bill_items->booking_id->setDbValue($rs->fields('booking_id'));
		$vendor_bill_items->remarks->setDbValue($rs->fields('remarks'));
		$vendor_bill_items->user_id->setDbValue($rs->fields('user_id'));
		$vendor_bill_items->created->setDbValue($rs->fields('created'));
		$vendor_bill_items->modified->setDbValue($rs->fields('modified'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $vendor_bill_items;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($vendor_bill_items->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($vendor_bill_items->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($vendor_bill_items->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($vendor_bill_items->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($vendor_bill_items->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($vendor_bill_items->id->CurrentValue);
		$this->AddUrl = $vendor_bill_items->AddUrl();
		$this->EditUrl = $vendor_bill_items->EditUrl();
		$this->CopyUrl = $vendor_bill_items->CopyUrl();
		$this->DeleteUrl = $vendor_bill_items->DeleteUrl();
		$this->ListUrl = $vendor_bill_items->ListUrl();

		// Call Row_Rendering event
		$vendor_bill_items->Row_Rendering();

		// Common render codes for all row types
		// id

		$vendor_bill_items->id->CellCssStyle = ""; $vendor_bill_items->id->CellCssClass = "";
		$vendor_bill_items->id->CellAttrs = array(); $vendor_bill_items->id->ViewAttrs = array(); $vendor_bill_items->id->EditAttrs = array();

		// vendor_bill_id
		$vendor_bill_items->vendor_bill_id->CellCssStyle = ""; $vendor_bill_items->vendor_bill_id->CellCssClass = "";
		$vendor_bill_items->vendor_bill_id->CellAttrs = array(); $vendor_bill_items->vendor_bill_id->ViewAttrs = array(); $vendor_bill_items->vendor_bill_id->EditAttrs = array();

		// vendor_id
		$vendor_bill_items->vendor_id->CellCssStyle = ""; $vendor_bill_items->vendor_id->CellCssClass = "";
		$vendor_bill_items->vendor_id->CellAttrs = array(); $vendor_bill_items->vendor_id->ViewAttrs = array(); $vendor_bill_items->vendor_id->EditAttrs = array();

		// booking_id
		$vendor_bill_items->booking_id->CellCssStyle = ""; $vendor_bill_items->booking_id->CellCssClass = "";
		$vendor_bill_items->booking_id->CellAttrs = array(); $vendor_bill_items->booking_id->ViewAttrs = array(); $vendor_bill_items->booking_id->EditAttrs = array();

		// remarks
		$vendor_bill_items->remarks->CellCssStyle = ""; $vendor_bill_items->remarks->CellCssClass = "";
		$vendor_bill_items->remarks->CellAttrs = array(); $vendor_bill_items->remarks->ViewAttrs = array(); $vendor_bill_items->remarks->EditAttrs = array();

		// user_id
		$vendor_bill_items->user_id->CellCssStyle = ""; $vendor_bill_items->user_id->CellCssClass = "";
		$vendor_bill_items->user_id->CellAttrs = array(); $vendor_bill_items->user_id->ViewAttrs = array(); $vendor_bill_items->user_id->EditAttrs = array();

		// created
		$vendor_bill_items->created->CellCssStyle = ""; $vendor_bill_items->created->CellCssClass = "";
		$vendor_bill_items->created->CellAttrs = array(); $vendor_bill_items->created->ViewAttrs = array(); $vendor_bill_items->created->EditAttrs = array();

		// modified
		$vendor_bill_items->modified->CellCssStyle = ""; $vendor_bill_items->modified->CellCssClass = "";
		$vendor_bill_items->modified->CellAttrs = array(); $vendor_bill_items->modified->ViewAttrs = array(); $vendor_bill_items->modified->EditAttrs = array();
		if ($vendor_bill_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$vendor_bill_items->id->ViewValue = $vendor_bill_items->id->CurrentValue;
			$vendor_bill_items->id->CssStyle = "";
			$vendor_bill_items->id->CssClass = "";
			$vendor_bill_items->id->ViewCustomAttributes = "";

			// vendor_bill_id
			if (strval($vendor_bill_items->vendor_bill_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_bill_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `vendor_Number` FROM `vendor_bill`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `vendor_Number`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->vendor_bill_id->ViewValue = $rswrk->fields('vendor_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_bill_id->ViewValue = $vendor_bill_items->vendor_bill_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_bill_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_bill_id->CssStyle = "";
			$vendor_bill_items->vendor_bill_id->CssClass = "";
			$vendor_bill_items->vendor_bill_id->ViewCustomAttributes = "";

			// vendor_id
			if (strval($vendor_bill_items->vendor_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_id->CurrentValue) . "";
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
					$vendor_bill_items->vendor_id->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_id->ViewValue = $vendor_bill_items->vendor_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_id->CssStyle = "";
			$vendor_bill_items->vendor_id->CssClass = "";
			$vendor_bill_items->vendor_id->ViewCustomAttributes = "";

			// booking_id
			if (strval($vendor_bill_items->booking_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->booking_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Subcon_ID`=" . $vendor_bill_items->vendor_id->CurrentValue . " AND `billing_type_id`=" . 8 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->booking_id->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->booking_id->ViewValue = $vendor_bill_items->booking_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->booking_id->ViewValue = NULL;
			}
			$vendor_bill_items->booking_id->CssStyle = "";
			$vendor_bill_items->booking_id->CssClass = "";
			$vendor_bill_items->booking_id->ViewCustomAttributes = "";

			// remarks
			$vendor_bill_items->remarks->ViewValue = $vendor_bill_items->remarks->CurrentValue;
			$vendor_bill_items->remarks->CssStyle = "";
			$vendor_bill_items->remarks->CssClass = "";
			$vendor_bill_items->remarks->ViewCustomAttributes = "";

			// user_id
			$vendor_bill_items->user_id->ViewValue = $vendor_bill_items->user_id->CurrentValue;
			$vendor_bill_items->user_id->CssStyle = "";
			$vendor_bill_items->user_id->CssClass = "";
			$vendor_bill_items->user_id->ViewCustomAttributes = "";

			// created
			$vendor_bill_items->created->ViewValue = $vendor_bill_items->created->CurrentValue;
			$vendor_bill_items->created->ViewValue = ew_FormatDateTime($vendor_bill_items->created->ViewValue, 6);
			$vendor_bill_items->created->CssStyle = "";
			$vendor_bill_items->created->CssClass = "";
			$vendor_bill_items->created->ViewCustomAttributes = "";

			// modified
			$vendor_bill_items->modified->ViewValue = $vendor_bill_items->modified->CurrentValue;
			$vendor_bill_items->modified->ViewValue = ew_FormatDateTime($vendor_bill_items->modified->ViewValue, 6);
			$vendor_bill_items->modified->CssStyle = "";
			$vendor_bill_items->modified->CssClass = "";
			$vendor_bill_items->modified->ViewCustomAttributes = "";

			// id
			$vendor_bill_items->id->HrefValue = "";
			$vendor_bill_items->id->TooltipValue = "";

			// vendor_bill_id
			$vendor_bill_items->vendor_bill_id->HrefValue = "";
			$vendor_bill_items->vendor_bill_id->TooltipValue = "";

			// vendor_id
			$vendor_bill_items->vendor_id->HrefValue = "";
			$vendor_bill_items->vendor_id->TooltipValue = "";

			// booking_id
			if (!ew_Empty($vendor_bill_items->booking_id->CurrentValue)) {
				$vendor_bill_items->booking_id->HrefValue = $vendor_bill_items->booking_id->CurrentValue;
				if ($vendor_bill_items->Export <> "") $vendor_bill_items->booking_id->HrefValue = ew_ConvertFullUrl($vendor_bill_items->booking_id->HrefValue);
			} else {
				$vendor_bill_items->booking_id->HrefValue = "";
			}
			$vendor_bill_items->booking_id->TooltipValue = "";

			// remarks
			$vendor_bill_items->remarks->HrefValue = "";
			$vendor_bill_items->remarks->TooltipValue = "";

			// user_id
			$vendor_bill_items->user_id->HrefValue = "";
			$vendor_bill_items->user_id->TooltipValue = "";

			// created
			$vendor_bill_items->created->HrefValue = "";
			$vendor_bill_items->created->TooltipValue = "";

			// modified
			$vendor_bill_items->modified->HrefValue = "";
			$vendor_bill_items->modified->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($vendor_bill_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$vendor_bill_items->Row_Rendered();
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
