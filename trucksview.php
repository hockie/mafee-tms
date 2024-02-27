<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "trucksinfo.php" ?>
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
$trucks_view = new ctrucks_view();
$Page =& $trucks_view;

// Page init
$trucks_view->Page_Init();

// Page main
$trucks_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($trucks->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trucks_view = new ew_Page("trucks_view");

// page properties
trucks_view.PageID = "view"; // page ID
trucks_view.FormID = "ftrucksview"; // form ID
var EW_PAGE_ID = trucks_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
trucks_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
trucks_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
trucks_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trucks_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $trucks->TableCaption() ?>
<br><br>
<?php if ($trucks->Export == "") { ?>
<a href="<?php echo $trucks_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $trucks_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $trucks_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $trucks_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('file_uploads_trucks')) { ?>
<a href="file_uploads_truckslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=trucks&id=<?php echo urlencode(strval($trucks->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("file_uploads_trucks", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$trucks_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($trucks->id->Visible) { // id ?>
	<tr<?php echo $trucks->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->id->FldCaption() ?></td>
		<td<?php echo $trucks->id->CellAttributes() ?>>
<div<?php echo $trucks->id->ViewAttributes() ?>><?php echo $trucks->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Sub_Con_ID->Visible) { // Sub_Con_ID ?>
	<tr<?php echo $trucks->Sub_Con_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Sub_Con_ID->FldCaption() ?></td>
		<td<?php echo $trucks->Sub_Con_ID->CellAttributes() ?>>
<div<?php echo $trucks->Sub_Con_ID->ViewAttributes() ?>><?php echo $trucks->Sub_Con_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Model->Visible) { // Model ?>
	<tr<?php echo $trucks->Model->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Model->FldCaption() ?></td>
		<td<?php echo $trucks->Model->CellAttributes() ?>>
<div<?php echo $trucks->Model->ViewAttributes() ?>><?php echo $trucks->Model->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Brand->Visible) { // Brand ?>
	<tr<?php echo $trucks->Brand->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Brand->FldCaption() ?></td>
		<td<?php echo $trucks->Brand->CellAttributes() ?>>
<div<?php echo $trucks->Brand->ViewAttributes() ?>><?php echo $trucks->Brand->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Truck_Types_ID->Visible) { // Truck_Types_ID ?>
	<tr<?php echo $trucks->Truck_Types_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Truck_Types_ID->FldCaption() ?></td>
		<td<?php echo $trucks->Truck_Types_ID->CellAttributes() ?>>
<div<?php echo $trucks->Truck_Types_ID->ViewAttributes() ?>><?php echo $trucks->Truck_Types_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Plate_Number->Visible) { // Plate_Number ?>
	<tr<?php echo $trucks->Plate_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Plate_Number->FldCaption() ?></td>
		<td<?php echo $trucks->Plate_Number->CellAttributes() ?>>
<div<?php echo $trucks->Plate_Number->ViewAttributes() ?>><?php echo $trucks->Plate_Number->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Series->Visible) { // Series ?>
	<tr<?php echo $trucks->Series->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Series->FldCaption() ?></td>
		<td<?php echo $trucks->Series->CellAttributes() ?>>
<div<?php echo $trucks->Series->ViewAttributes() ?>><?php echo $trucks->Series->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Truck_Body_Type->Visible) { // Truck_Body_Type ?>
	<tr<?php echo $trucks->Truck_Body_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Truck_Body_Type->FldCaption() ?></td>
		<td<?php echo $trucks->Truck_Body_Type->CellAttributes() ?>>
<div<?php echo $trucks->Truck_Body_Type->ViewAttributes() ?>><?php echo $trucks->Truck_Body_Type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Gross_Weight->Visible) { // Gross_Weight ?>
	<tr<?php echo $trucks->Gross_Weight->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Gross_Weight->FldCaption() ?></td>
		<td<?php echo $trucks->Gross_Weight->CellAttributes() ?>>
<div<?php echo $trucks->Gross_Weight->ViewAttributes() ?>><?php echo $trucks->Gross_Weight->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Net_Capacity->Visible) { // Net_Capacity ?>
	<tr<?php echo $trucks->Net_Capacity->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Net_Capacity->FldCaption() ?></td>
		<td<?php echo $trucks->Net_Capacity->CellAttributes() ?>>
<div<?php echo $trucks->Net_Capacity->ViewAttributes() ?>><?php echo $trucks->Net_Capacity->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Inland_Marine_Insurance->Visible) { // Inland_Marine_Insurance ?>
	<tr<?php echo $trucks->Inland_Marine_Insurance->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Inland_Marine_Insurance->FldCaption() ?></td>
		<td<?php echo $trucks->Inland_Marine_Insurance->CellAttributes() ?>>
<div<?php echo $trucks->Inland_Marine_Insurance->ViewAttributes() ?>><?php echo $trucks->Inland_Marine_Insurance->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->Expiration_Date->Visible) { // Expiration_Date ?>
	<tr<?php echo $trucks->Expiration_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Expiration_Date->FldCaption() ?></td>
		<td<?php echo $trucks->Expiration_Date->CellAttributes() ?>>
<div<?php echo $trucks->Expiration_Date->ViewAttributes() ?>><?php echo $trucks->Expiration_Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->LTFRB_Case_No->Visible) { // LTFRB_Case_No ?>
	<tr<?php echo $trucks->LTFRB_Case_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->LTFRB_Case_No->FldCaption() ?></td>
		<td<?php echo $trucks->LTFRB_Case_No->CellAttributes() ?>>
<div<?php echo $trucks->LTFRB_Case_No->ViewAttributes() ?>><?php echo $trucks->LTFRB_Case_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->LTFRB_Expiration->Visible) { // LTFRB_Expiration ?>
	<tr<?php echo $trucks->LTFRB_Expiration->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->LTFRB_Expiration->FldCaption() ?></td>
		<td<?php echo $trucks->LTFRB_Expiration->CellAttributes() ?>>
<div<?php echo $trucks->LTFRB_Expiration->ViewAttributes() ?>><?php echo $trucks->LTFRB_Expiration->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($trucks->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $trucks->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->File_Upload->FldCaption() ?></td>
		<td<?php echo $trucks->File_Upload->CellAttributes() ?>>
<?php if ($trucks->File_Upload->HrefValue <> "" || $trucks->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $trucks->File_Upload->HrefValue ?>"><?php echo $trucks->File_Upload->ViewValue ?></a>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<?php echo $trucks->File_Upload->ViewValue ?>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($trucks->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $trucks->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Remarks->FldCaption() ?></td>
		<td<?php echo $trucks->Remarks->CellAttributes() ?>>
<div<?php echo $trucks->Remarks->ViewAttributes() ?>><?php echo $trucks->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($trucks->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$trucks_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctrucks_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'trucks';

	// Page object name
	var $PageObjName = 'trucks_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trucks;
		if ($trucks->UseTokenInUrl) $PageUrl .= "t=" . $trucks->TableVar . "&"; // Add page token
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
		global $objForm, $trucks;
		if ($trucks->UseTokenInUrl) {
			if ($objForm)
				return ($trucks->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trucks->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctrucks_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (trucks)
		$GLOBALS["trucks"] = new ctrucks();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trucks', TRUE);

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
		global $trucks;

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
			$this->Page_Terminate("truckslist.php");
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
		global $Language, $trucks;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$trucks->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $trucks->id->QueryStringValue;
			} else {
				$sReturnUrl = "truckslist.php"; // Return to list
			}

			// Get action
			$trucks->CurrentAction = "I"; // Display form
			switch ($trucks->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "truckslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "truckslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$trucks->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $trucks;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$trucks->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$trucks->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $trucks->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$trucks->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$trucks->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$trucks->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trucks;
		$sFilter = $trucks->KeyFilter();

		// Call Row Selecting event
		$trucks->Row_Selecting($sFilter);

		// Load SQL based on filter
		$trucks->CurrentFilter = $sFilter;
		$sSql = $trucks->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$trucks->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $trucks;
		$trucks->id->setDbValue($rs->fields('id'));
		$trucks->Sub_Con_ID->setDbValue($rs->fields('Sub_Con_ID'));
		$trucks->Model->setDbValue($rs->fields('Model'));
		$trucks->Brand->setDbValue($rs->fields('Brand'));
		$trucks->Truck_Types_ID->setDbValue($rs->fields('Truck_Types_ID'));
		$trucks->Plate_Number->setDbValue($rs->fields('Plate_Number'));
		$trucks->Series->setDbValue($rs->fields('Series'));
		$trucks->Truck_Body_Type->setDbValue($rs->fields('Truck_Body_Type'));
		$trucks->Gross_Weight->setDbValue($rs->fields('Gross_Weight'));
		$trucks->Net_Capacity->setDbValue($rs->fields('Net_Capacity'));
		$trucks->Inland_Marine_Insurance->setDbValue($rs->fields('Inland_Marine_Insurance'));
		$trucks->Expiration_Date->setDbValue($rs->fields('Expiration_Date'));
		$trucks->LTFRB_Case_No->setDbValue($rs->fields('LTFRB_Case_No'));
		$trucks->LTFRB_Expiration->setDbValue($rs->fields('LTFRB_Expiration'));
		$trucks->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$trucks->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $trucks;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($trucks->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($trucks->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($trucks->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($trucks->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($trucks->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($trucks->id->CurrentValue);
		$this->AddUrl = $trucks->AddUrl();
		$this->EditUrl = $trucks->EditUrl();
		$this->CopyUrl = $trucks->CopyUrl();
		$this->DeleteUrl = $trucks->DeleteUrl();
		$this->ListUrl = $trucks->ListUrl();

		// Call Row_Rendering event
		$trucks->Row_Rendering();

		// Common render codes for all row types
		// id

		$trucks->id->CellCssStyle = ""; $trucks->id->CellCssClass = "";
		$trucks->id->CellAttrs = array(); $trucks->id->ViewAttrs = array(); $trucks->id->EditAttrs = array();

		// Sub_Con_ID
		$trucks->Sub_Con_ID->CellCssStyle = ""; $trucks->Sub_Con_ID->CellCssClass = "";
		$trucks->Sub_Con_ID->CellAttrs = array(); $trucks->Sub_Con_ID->ViewAttrs = array(); $trucks->Sub_Con_ID->EditAttrs = array();

		// Model
		$trucks->Model->CellCssStyle = ""; $trucks->Model->CellCssClass = "";
		$trucks->Model->CellAttrs = array(); $trucks->Model->ViewAttrs = array(); $trucks->Model->EditAttrs = array();

		// Brand
		$trucks->Brand->CellCssStyle = ""; $trucks->Brand->CellCssClass = "";
		$trucks->Brand->CellAttrs = array(); $trucks->Brand->ViewAttrs = array(); $trucks->Brand->EditAttrs = array();

		// Truck_Types_ID
		$trucks->Truck_Types_ID->CellCssStyle = ""; $trucks->Truck_Types_ID->CellCssClass = "";
		$trucks->Truck_Types_ID->CellAttrs = array(); $trucks->Truck_Types_ID->ViewAttrs = array(); $trucks->Truck_Types_ID->EditAttrs = array();

		// Plate_Number
		$trucks->Plate_Number->CellCssStyle = ""; $trucks->Plate_Number->CellCssClass = "";
		$trucks->Plate_Number->CellAttrs = array(); $trucks->Plate_Number->ViewAttrs = array(); $trucks->Plate_Number->EditAttrs = array();

		// Series
		$trucks->Series->CellCssStyle = ""; $trucks->Series->CellCssClass = "";
		$trucks->Series->CellAttrs = array(); $trucks->Series->ViewAttrs = array(); $trucks->Series->EditAttrs = array();

		// Truck_Body_Type
		$trucks->Truck_Body_Type->CellCssStyle = ""; $trucks->Truck_Body_Type->CellCssClass = "";
		$trucks->Truck_Body_Type->CellAttrs = array(); $trucks->Truck_Body_Type->ViewAttrs = array(); $trucks->Truck_Body_Type->EditAttrs = array();

		// Gross_Weight
		$trucks->Gross_Weight->CellCssStyle = ""; $trucks->Gross_Weight->CellCssClass = "";
		$trucks->Gross_Weight->CellAttrs = array(); $trucks->Gross_Weight->ViewAttrs = array(); $trucks->Gross_Weight->EditAttrs = array();

		// Net_Capacity
		$trucks->Net_Capacity->CellCssStyle = ""; $trucks->Net_Capacity->CellCssClass = "";
		$trucks->Net_Capacity->CellAttrs = array(); $trucks->Net_Capacity->ViewAttrs = array(); $trucks->Net_Capacity->EditAttrs = array();

		// Inland_Marine_Insurance
		$trucks->Inland_Marine_Insurance->CellCssStyle = ""; $trucks->Inland_Marine_Insurance->CellCssClass = "";
		$trucks->Inland_Marine_Insurance->CellAttrs = array(); $trucks->Inland_Marine_Insurance->ViewAttrs = array(); $trucks->Inland_Marine_Insurance->EditAttrs = array();

		// Expiration_Date
		$trucks->Expiration_Date->CellCssStyle = ""; $trucks->Expiration_Date->CellCssClass = "";
		$trucks->Expiration_Date->CellAttrs = array(); $trucks->Expiration_Date->ViewAttrs = array(); $trucks->Expiration_Date->EditAttrs = array();

		// LTFRB_Case_No
		$trucks->LTFRB_Case_No->CellCssStyle = ""; $trucks->LTFRB_Case_No->CellCssClass = "";
		$trucks->LTFRB_Case_No->CellAttrs = array(); $trucks->LTFRB_Case_No->ViewAttrs = array(); $trucks->LTFRB_Case_No->EditAttrs = array();

		// LTFRB_Expiration
		$trucks->LTFRB_Expiration->CellCssStyle = ""; $trucks->LTFRB_Expiration->CellCssClass = "";
		$trucks->LTFRB_Expiration->CellAttrs = array(); $trucks->LTFRB_Expiration->ViewAttrs = array(); $trucks->LTFRB_Expiration->EditAttrs = array();

		// File_Upload
		$trucks->File_Upload->CellCssStyle = ""; $trucks->File_Upload->CellCssClass = "";
		$trucks->File_Upload->CellAttrs = array(); $trucks->File_Upload->ViewAttrs = array(); $trucks->File_Upload->EditAttrs = array();

		// Remarks
		$trucks->Remarks->CellCssStyle = ""; $trucks->Remarks->CellCssClass = "";
		$trucks->Remarks->CellAttrs = array(); $trucks->Remarks->ViewAttrs = array(); $trucks->Remarks->EditAttrs = array();
		if ($trucks->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$trucks->id->ViewValue = $trucks->id->CurrentValue;
			$trucks->id->CssStyle = "";
			$trucks->id->CssClass = "";
			$trucks->id->ViewCustomAttributes = "";

			// Sub_Con_ID
			if (strval($trucks->Sub_Con_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Sub_Con_ID->CurrentValue) . "";
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
					$trucks->Sub_Con_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$trucks->Sub_Con_ID->ViewValue = $trucks->Sub_Con_ID->CurrentValue;
				}
			} else {
				$trucks->Sub_Con_ID->ViewValue = NULL;
			}
			$trucks->Sub_Con_ID->CssStyle = "";
			$trucks->Sub_Con_ID->CssClass = "";
			$trucks->Sub_Con_ID->ViewCustomAttributes = "";

			// Model
			$trucks->Model->ViewValue = $trucks->Model->CurrentValue;
			$trucks->Model->CssStyle = "";
			$trucks->Model->CssClass = "";
			$trucks->Model->ViewCustomAttributes = "";

			// Brand
			$trucks->Brand->ViewValue = $trucks->Brand->CurrentValue;
			$trucks->Brand->CssStyle = "";
			$trucks->Brand->CssClass = "";
			$trucks->Brand->ViewCustomAttributes = "";

			// Truck_Types_ID
			if (strval($trucks->Truck_Types_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Truck_Types_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Truck_Type` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$trucks->Truck_Types_ID->ViewValue = $rswrk->fields('Truck_Type');
					$rswrk->Close();
				} else {
					$trucks->Truck_Types_ID->ViewValue = $trucks->Truck_Types_ID->CurrentValue;
				}
			} else {
				$trucks->Truck_Types_ID->ViewValue = NULL;
			}
			$trucks->Truck_Types_ID->CssStyle = "";
			$trucks->Truck_Types_ID->CssClass = "";
			$trucks->Truck_Types_ID->ViewCustomAttributes = "";

			// Plate_Number
			$trucks->Plate_Number->ViewValue = $trucks->Plate_Number->CurrentValue;
			$trucks->Plate_Number->CssStyle = "";
			$trucks->Plate_Number->CssClass = "";
			$trucks->Plate_Number->ViewCustomAttributes = "";

			// Series
			$trucks->Series->ViewValue = $trucks->Series->CurrentValue;
			$trucks->Series->CssStyle = "";
			$trucks->Series->CssClass = "";
			$trucks->Series->ViewCustomAttributes = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->ViewValue = $trucks->Truck_Body_Type->CurrentValue;
			$trucks->Truck_Body_Type->CssStyle = "";
			$trucks->Truck_Body_Type->CssClass = "";
			$trucks->Truck_Body_Type->ViewCustomAttributes = "";

			// Gross_Weight
			$trucks->Gross_Weight->ViewValue = $trucks->Gross_Weight->CurrentValue;
			$trucks->Gross_Weight->ViewValue = ew_FormatNumber($trucks->Gross_Weight->ViewValue, 0, -2, -2, -2);
			$trucks->Gross_Weight->CssStyle = "";
			$trucks->Gross_Weight->CssClass = "";
			$trucks->Gross_Weight->ViewCustomAttributes = "";

			// Net_Capacity
			$trucks->Net_Capacity->ViewValue = $trucks->Net_Capacity->CurrentValue;
			$trucks->Net_Capacity->ViewValue = ew_FormatNumber($trucks->Net_Capacity->ViewValue, 0, -2, -2, -2);
			$trucks->Net_Capacity->CssStyle = "";
			$trucks->Net_Capacity->CssClass = "";
			$trucks->Net_Capacity->ViewCustomAttributes = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->ViewValue = $trucks->Inland_Marine_Insurance->CurrentValue;
			$trucks->Inland_Marine_Insurance->CssStyle = "";
			$trucks->Inland_Marine_Insurance->CssClass = "";
			$trucks->Inland_Marine_Insurance->ViewCustomAttributes = "";

			// Expiration_Date
			$trucks->Expiration_Date->ViewValue = $trucks->Expiration_Date->CurrentValue;
			$trucks->Expiration_Date->ViewValue = ew_FormatDateTime($trucks->Expiration_Date->ViewValue, 6);
			$trucks->Expiration_Date->CssStyle = "";
			$trucks->Expiration_Date->CssClass = "";
			$trucks->Expiration_Date->ViewCustomAttributes = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->ViewValue = $trucks->LTFRB_Case_No->CurrentValue;
			$trucks->LTFRB_Case_No->CssStyle = "";
			$trucks->LTFRB_Case_No->CssClass = "";
			$trucks->LTFRB_Case_No->ViewCustomAttributes = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->ViewValue = $trucks->LTFRB_Expiration->CurrentValue;
			$trucks->LTFRB_Expiration->ViewValue = ew_FormatDateTime($trucks->LTFRB_Expiration->ViewValue, 6);
			$trucks->LTFRB_Expiration->CssStyle = "";
			$trucks->LTFRB_Expiration->CssClass = "";
			$trucks->LTFRB_Expiration->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->ViewValue = $trucks->File_Upload->Upload->DbValue;
			} else {
				$trucks->File_Upload->ViewValue = "";
			}
			$trucks->File_Upload->CssStyle = "";
			$trucks->File_Upload->CssClass = "";
			$trucks->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$trucks->Remarks->ViewValue = $trucks->Remarks->CurrentValue;
			$trucks->Remarks->CssStyle = "";
			$trucks->Remarks->CssClass = "";
			$trucks->Remarks->ViewCustomAttributes = "";

			// id
			$trucks->id->HrefValue = "";
			$trucks->id->TooltipValue = "";

			// Sub_Con_ID
			$trucks->Sub_Con_ID->HrefValue = "";
			$trucks->Sub_Con_ID->TooltipValue = "";

			// Model
			$trucks->Model->HrefValue = "";
			$trucks->Model->TooltipValue = "";

			// Brand
			$trucks->Brand->HrefValue = "";
			$trucks->Brand->TooltipValue = "";

			// Truck_Types_ID
			$trucks->Truck_Types_ID->HrefValue = "";
			$trucks->Truck_Types_ID->TooltipValue = "";

			// Plate_Number
			$trucks->Plate_Number->HrefValue = "";
			$trucks->Plate_Number->TooltipValue = "";

			// Series
			$trucks->Series->HrefValue = "";
			$trucks->Series->TooltipValue = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->HrefValue = "";
			$trucks->Truck_Body_Type->TooltipValue = "";

			// Gross_Weight
			$trucks->Gross_Weight->HrefValue = "";
			$trucks->Gross_Weight->TooltipValue = "";

			// Net_Capacity
			$trucks->Net_Capacity->HrefValue = "";
			$trucks->Net_Capacity->TooltipValue = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->HrefValue = "";
			$trucks->Inland_Marine_Insurance->TooltipValue = "";

			// Expiration_Date
			$trucks->Expiration_Date->HrefValue = "";
			$trucks->Expiration_Date->TooltipValue = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->HrefValue = "";
			$trucks->LTFRB_Case_No->TooltipValue = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->HrefValue = "";
			$trucks->LTFRB_Expiration->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $trucks->File_Upload->UploadPath) . ((!empty($trucks->File_Upload->ViewValue)) ? $trucks->File_Upload->ViewValue : $trucks->File_Upload->CurrentValue);
				if ($trucks->Export <> "") $trucks->File_Upload->HrefValue = ew_ConvertFullUrl($trucks->File_Upload->HrefValue);
			} else {
				$trucks->File_Upload->HrefValue = "";
			}
			$trucks->File_Upload->TooltipValue = "";

			// Remarks
			$trucks->Remarks->HrefValue = "";
			$trucks->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($trucks->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$trucks->Row_Rendered();
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
