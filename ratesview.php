<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "ratesinfo.php" ?>
<?php include "clientsinfo.php" ?>
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
$rates_view = new crates_view();
$Page =& $rates_view;

// Page init
$rates_view->Page_Init();

// Page main
$rates_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($rates->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var rates_view = new ew_Page("rates_view");

// page properties
rates_view.PageID = "view"; // page ID
rates_view.FormID = "fratesview"; // form ID
var EW_PAGE_ID = rates_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
rates_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
rates_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
rates_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rates_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rates->TableCaption() ?>
<br><br>
<?php if ($rates->Export == "") { ?>
<a href="<?php echo $rates_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $rates_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $rates_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $rates_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $rates_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$rates_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($rates->id->Visible) { // id ?>
	<tr<?php echo $rates->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->id->FldCaption() ?></td>
		<td<?php echo $rates->id->CellAttributes() ?>>
<div<?php echo $rates->id->ViewAttributes() ?>><?php echo $rates->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Date->Visible) { // Date ?>
	<tr<?php echo $rates->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Date->FldCaption() ?></td>
		<td<?php echo $rates->Date->CellAttributes() ?>>
<div<?php echo $rates->Date->ViewAttributes() ?>><?php echo $rates->Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Client_ID->Visible) { // Client_ID ?>
	<tr<?php echo $rates->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Client_ID->FldCaption() ?></td>
		<td<?php echo $rates->Client_ID->CellAttributes() ?>>
<div<?php echo $rates->Client_ID->ViewAttributes() ?>><?php echo $rates->Client_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Area_ID->Visible) { // Area_ID ?>
	<tr<?php echo $rates->Area_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Area_ID->FldCaption() ?></td>
		<td<?php echo $rates->Area_ID->CellAttributes() ?>>
<div<?php echo $rates->Area_ID->ViewAttributes() ?>><?php echo $rates->Area_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Origin_ID->Visible) { // Origin_ID ?>
	<tr<?php echo $rates->Origin_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Origin_ID->FldCaption() ?></td>
		<td<?php echo $rates->Origin_ID->CellAttributes() ?>>
<div<?php echo $rates->Origin_ID->ViewAttributes() ?>><?php echo $rates->Origin_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Destination_ID->Visible) { // Destination_ID ?>
	<tr<?php echo $rates->Destination_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Destination_ID->FldCaption() ?></td>
		<td<?php echo $rates->Destination_ID->CellAttributes() ?>>
<div<?php echo $rates->Destination_ID->ViewAttributes() ?>><?php echo $rates->Destination_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Distance->Visible) { // Distance ?>
	<tr<?php echo $rates->Distance->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Distance->FldCaption() ?></td>
		<td<?php echo $rates->Distance->CellAttributes() ?>>
<div<?php echo $rates->Distance->ViewAttributes() ?>><?php echo $rates->Distance->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Truck_Type_ID->Visible) { // Truck_Type_ID ?>
	<tr<?php echo $rates->Truck_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Truck_Type_ID->FldCaption() ?></td>
		<td<?php echo $rates->Truck_Type_ID->CellAttributes() ?>>
<div<?php echo $rates->Truck_Type_ID->ViewAttributes() ?>><?php echo $rates->Truck_Type_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Unit_ID->Visible) { // Unit_ID ?>
	<tr<?php echo $rates->Unit_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Unit_ID->FldCaption() ?></td>
		<td<?php echo $rates->Unit_ID->CellAttributes() ?>>
<div<?php echo $rates->Unit_ID->ViewAttributes() ?>><?php echo $rates->Unit_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Freight_Rate->Visible) { // Freight_Rate ?>
	<tr<?php echo $rates->Freight_Rate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Freight_Rate->FldCaption() ?></td>
		<td<?php echo $rates->Freight_Rate->CellAttributes() ?>>
<div<?php echo $rates->Freight_Rate->ViewAttributes() ?>><?php echo $rates->Freight_Rate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Vat->Visible) { // Vat ?>
	<tr<?php echo $rates->Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Vat->FldCaption() ?></td>
		<td<?php echo $rates->Vat->CellAttributes() ?>>
<div<?php echo $rates->Vat->ViewAttributes() ?>><?php echo $rates->Vat->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Wtax->Visible) { // Wtax ?>
	<tr<?php echo $rates->Wtax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Wtax->FldCaption() ?></td>
		<td<?php echo $rates->Wtax->CellAttributes() ?>>
<div<?php echo $rates->Wtax->ViewAttributes() ?>><?php echo $rates->Wtax->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($rates->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $rates->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Remarks->FldCaption() ?></td>
		<td<?php echo $rates->Remarks->CellAttributes() ?>>
<div<?php echo $rates->Remarks->ViewAttributes() ?>><?php echo $rates->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($rates->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$rates_view->Page_Terminate();
?>
<?php

//
// Page class
//
class crates_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'rates';

	// Page object name
	var $PageObjName = 'rates_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rates;
		if ($rates->UseTokenInUrl) $PageUrl .= "t=" . $rates->TableVar . "&"; // Add page token
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
		global $objForm, $rates;
		if ($rates->UseTokenInUrl) {
			if ($objForm)
				return ($rates->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rates->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crates_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (rates)
		$GLOBALS["rates"] = new crates();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rates', TRUE);

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
		global $rates;

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
			$this->Page_Terminate("rateslist.php");
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
		global $Language, $rates;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$rates->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $rates->id->QueryStringValue;
			} else {
				$sReturnUrl = "rateslist.php"; // Return to list
			}

			// Get action
			$rates->CurrentAction = "I"; // Display form
			switch ($rates->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "rateslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "rateslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$rates->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $rates;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$rates->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$rates->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $rates->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$rates->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$rates->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$rates->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rates;
		$sFilter = $rates->KeyFilter();

		// Call Row Selecting event
		$rates->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rates->CurrentFilter = $sFilter;
		$sSql = $rates->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$rates->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $rates;
		$rates->id->setDbValue($rs->fields('id'));
		$rates->Date->setDbValue($rs->fields('Date'));
		$rates->Client_ID->setDbValue($rs->fields('Client_ID'));
		$rates->Area_ID->setDbValue($rs->fields('Area_ID'));
		$rates->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$rates->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$rates->Distance->setDbValue($rs->fields('Distance'));
		$rates->Truck_Type_ID->setDbValue($rs->fields('Truck_Type_ID'));
		$rates->Unit_ID->setDbValue($rs->fields('Unit_ID'));
		$rates->Freight_Rate->setDbValue($rs->fields('Freight_Rate'));
		$rates->Vat->setDbValue($rs->fields('Vat'));
		$rates->Wtax->setDbValue($rs->fields('Wtax'));
		$rates->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rates;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($rates->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($rates->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($rates->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($rates->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($rates->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($rates->id->CurrentValue);
		$this->AddUrl = $rates->AddUrl();
		$this->EditUrl = $rates->EditUrl();
		$this->CopyUrl = $rates->CopyUrl();
		$this->DeleteUrl = $rates->DeleteUrl();
		$this->ListUrl = $rates->ListUrl();

		// Call Row_Rendering event
		$rates->Row_Rendering();

		// Common render codes for all row types
		// id

		$rates->id->CellCssStyle = ""; $rates->id->CellCssClass = "";
		$rates->id->CellAttrs = array(); $rates->id->ViewAttrs = array(); $rates->id->EditAttrs = array();

		// Date
		$rates->Date->CellCssStyle = ""; $rates->Date->CellCssClass = "";
		$rates->Date->CellAttrs = array(); $rates->Date->ViewAttrs = array(); $rates->Date->EditAttrs = array();

		// Client_ID
		$rates->Client_ID->CellCssStyle = ""; $rates->Client_ID->CellCssClass = "";
		$rates->Client_ID->CellAttrs = array(); $rates->Client_ID->ViewAttrs = array(); $rates->Client_ID->EditAttrs = array();

		// Area_ID
		$rates->Area_ID->CellCssStyle = ""; $rates->Area_ID->CellCssClass = "";
		$rates->Area_ID->CellAttrs = array(); $rates->Area_ID->ViewAttrs = array(); $rates->Area_ID->EditAttrs = array();

		// Origin_ID
		$rates->Origin_ID->CellCssStyle = ""; $rates->Origin_ID->CellCssClass = "";
		$rates->Origin_ID->CellAttrs = array(); $rates->Origin_ID->ViewAttrs = array(); $rates->Origin_ID->EditAttrs = array();

		// Destination_ID
		$rates->Destination_ID->CellCssStyle = ""; $rates->Destination_ID->CellCssClass = "";
		$rates->Destination_ID->CellAttrs = array(); $rates->Destination_ID->ViewAttrs = array(); $rates->Destination_ID->EditAttrs = array();

		// Distance
		$rates->Distance->CellCssStyle = ""; $rates->Distance->CellCssClass = "";
		$rates->Distance->CellAttrs = array(); $rates->Distance->ViewAttrs = array(); $rates->Distance->EditAttrs = array();

		// Truck_Type_ID
		$rates->Truck_Type_ID->CellCssStyle = ""; $rates->Truck_Type_ID->CellCssClass = "";
		$rates->Truck_Type_ID->CellAttrs = array(); $rates->Truck_Type_ID->ViewAttrs = array(); $rates->Truck_Type_ID->EditAttrs = array();

		// Unit_ID
		$rates->Unit_ID->CellCssStyle = ""; $rates->Unit_ID->CellCssClass = "";
		$rates->Unit_ID->CellAttrs = array(); $rates->Unit_ID->ViewAttrs = array(); $rates->Unit_ID->EditAttrs = array();

		// Freight_Rate
		$rates->Freight_Rate->CellCssStyle = ""; $rates->Freight_Rate->CellCssClass = "";
		$rates->Freight_Rate->CellAttrs = array(); $rates->Freight_Rate->ViewAttrs = array(); $rates->Freight_Rate->EditAttrs = array();

		// Vat
		$rates->Vat->CellCssStyle = ""; $rates->Vat->CellCssClass = "";
		$rates->Vat->CellAttrs = array(); $rates->Vat->ViewAttrs = array(); $rates->Vat->EditAttrs = array();

		// Wtax
		$rates->Wtax->CellCssStyle = ""; $rates->Wtax->CellCssClass = "";
		$rates->Wtax->CellAttrs = array(); $rates->Wtax->ViewAttrs = array(); $rates->Wtax->EditAttrs = array();

		// Remarks
		$rates->Remarks->CellCssStyle = ""; $rates->Remarks->CellCssClass = "";
		$rates->Remarks->CellAttrs = array(); $rates->Remarks->ViewAttrs = array(); $rates->Remarks->EditAttrs = array();
		if ($rates->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$rates->id->ViewValue = $rates->id->CurrentValue;
			$rates->id->CssStyle = "";
			$rates->id->CssClass = "";
			$rates->id->ViewCustomAttributes = "";

			// Date
			$rates->Date->ViewValue = $rates->Date->CurrentValue;
			$rates->Date->ViewValue = ew_FormatDateTime($rates->Date->ViewValue, 6);
			$rates->Date->CssStyle = "";
			$rates->Date->CssClass = "";
			$rates->Date->ViewCustomAttributes = "";

			// Client_ID
			if (strval($rates->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$rates->Client_ID->ViewValue = $rates->Client_ID->CurrentValue;
				}
			} else {
				$rates->Client_ID->ViewValue = NULL;
			}
			$rates->Client_ID->CssStyle = "";
			$rates->Client_ID->CssClass = "";
			$rates->Client_ID->ViewCustomAttributes = "";

			// Area_ID
			if (strval($rates->Area_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Area_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Area` FROM `areas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Area_ID->ViewValue = $rswrk->fields('Area');
					$rswrk->Close();
				} else {
					$rates->Area_ID->ViewValue = $rates->Area_ID->CurrentValue;
				}
			} else {
				$rates->Area_ID->ViewValue = NULL;
			}
			$rates->Area_ID->CssStyle = "";
			$rates->Area_ID->CssClass = "";
			$rates->Area_ID->ViewCustomAttributes = "";

			// Origin_ID
			if (strval($rates->Origin_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Origin_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Origin` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Origin_ID->ViewValue = $rswrk->fields('Origin');
					$rswrk->Close();
				} else {
					$rates->Origin_ID->ViewValue = $rates->Origin_ID->CurrentValue;
				}
			} else {
				$rates->Origin_ID->ViewValue = NULL;
			}
			$rates->Origin_ID->CssStyle = "";
			$rates->Origin_ID->CssClass = "";
			$rates->Origin_ID->ViewCustomAttributes = "";

			// Destination_ID
			if (strval($rates->Destination_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Destination_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Destination_ID->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$rates->Destination_ID->ViewValue = $rates->Destination_ID->CurrentValue;
				}
			} else {
				$rates->Destination_ID->ViewValue = NULL;
			}
			$rates->Destination_ID->CssStyle = "";
			$rates->Destination_ID->CssClass = "";
			$rates->Destination_ID->ViewCustomAttributes = "";

			// Distance
			$rates->Distance->ViewValue = $rates->Distance->CurrentValue;
			$rates->Distance->CssStyle = "";
			$rates->Distance->CssClass = "";
			$rates->Distance->ViewCustomAttributes = "";

			// Truck_Type_ID
			if (strval($rates->Truck_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Truck_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Truck_Type_ID->ViewValue = $rswrk->fields('Truck_Type');
					$rswrk->Close();
				} else {
					$rates->Truck_Type_ID->ViewValue = $rates->Truck_Type_ID->CurrentValue;
				}
			} else {
				$rates->Truck_Type_ID->ViewValue = NULL;
			}
			$rates->Truck_Type_ID->CssStyle = "";
			$rates->Truck_Type_ID->CssClass = "";
			$rates->Truck_Type_ID->ViewCustomAttributes = "";

			// Unit_ID
			if (strval($rates->Unit_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Unit_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Units` FROM `units`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Unit_ID->ViewValue = $rswrk->fields('Units');
					$rswrk->Close();
				} else {
					$rates->Unit_ID->ViewValue = $rates->Unit_ID->CurrentValue;
				}
			} else {
				$rates->Unit_ID->ViewValue = NULL;
			}
			$rates->Unit_ID->CssStyle = "";
			$rates->Unit_ID->CssClass = "";
			$rates->Unit_ID->ViewCustomAttributes = "";

			// Freight_Rate
			$rates->Freight_Rate->ViewValue = $rates->Freight_Rate->CurrentValue;
			$rates->Freight_Rate->CssStyle = "";
			$rates->Freight_Rate->CssClass = "";
			$rates->Freight_Rate->ViewCustomAttributes = "";

			// Vat
			$rates->Vat->ViewValue = $rates->Vat->CurrentValue;
			$rates->Vat->CssStyle = "";
			$rates->Vat->CssClass = "";
			$rates->Vat->ViewCustomAttributes = "";

			// Wtax
			$rates->Wtax->ViewValue = $rates->Wtax->CurrentValue;
			$rates->Wtax->CssStyle = "";
			$rates->Wtax->CssClass = "";
			$rates->Wtax->ViewCustomAttributes = "";

			// Remarks
			$rates->Remarks->ViewValue = $rates->Remarks->CurrentValue;
			$rates->Remarks->CssStyle = "";
			$rates->Remarks->CssClass = "";
			$rates->Remarks->ViewCustomAttributes = "";

			// id
			$rates->id->HrefValue = "";
			$rates->id->TooltipValue = "";

			// Date
			$rates->Date->HrefValue = "";
			$rates->Date->TooltipValue = "";

			// Client_ID
			$rates->Client_ID->HrefValue = "";
			$rates->Client_ID->TooltipValue = "";

			// Area_ID
			$rates->Area_ID->HrefValue = "";
			$rates->Area_ID->TooltipValue = "";

			// Origin_ID
			$rates->Origin_ID->HrefValue = "";
			$rates->Origin_ID->TooltipValue = "";

			// Destination_ID
			$rates->Destination_ID->HrefValue = "";
			$rates->Destination_ID->TooltipValue = "";

			// Distance
			$rates->Distance->HrefValue = "";
			$rates->Distance->TooltipValue = "";

			// Truck_Type_ID
			$rates->Truck_Type_ID->HrefValue = "";
			$rates->Truck_Type_ID->TooltipValue = "";

			// Unit_ID
			$rates->Unit_ID->HrefValue = "";
			$rates->Unit_ID->TooltipValue = "";

			// Freight_Rate
			$rates->Freight_Rate->HrefValue = "";
			$rates->Freight_Rate->TooltipValue = "";

			// Vat
			$rates->Vat->HrefValue = "";
			$rates->Vat->TooltipValue = "";

			// Wtax
			$rates->Wtax->HrefValue = "";
			$rates->Wtax->TooltipValue = "";

			// Remarks
			$rates->Remarks->HrefValue = "";
			$rates->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($rates->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rates->Row_Rendered();
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
