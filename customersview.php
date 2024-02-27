<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "customersinfo.php" ?>
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
$customers_view = new ccustomers_view();
$Page =& $customers_view;

// Page init
$customers_view->Page_Init();

// Page main
$customers_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($customers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var customers_view = new ew_Page("customers_view");

// page properties
customers_view.PageID = "view"; // page ID
customers_view.FormID = "fcustomersview"; // form ID
var EW_PAGE_ID = customers_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
customers_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
customers_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customers_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $customers->TableCaption() ?>
<br><br>
<?php if ($customers->Export == "") { ?>
<a href="<?php echo $customers_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $customers_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $customers_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $customers_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$customers_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($customers->id->Visible) { // id ?>
	<tr<?php echo $customers->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->id->FldCaption() ?></td>
		<td<?php echo $customers->id->CellAttributes() ?>>
<div<?php echo $customers->id->ViewAttributes() ?>><?php echo $customers->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customers->client_id->Visible) { // client_id ?>
	<tr<?php echo $customers->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->client_id->FldCaption() ?></td>
		<td<?php echo $customers->client_id->CellAttributes() ?>>
<div<?php echo $customers->client_id->ViewAttributes() ?>><?php echo $customers->client_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customers->Customer_No->Visible) { // Customer_No ?>
	<tr<?php echo $customers->Customer_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Customer_No->FldCaption() ?></td>
		<td<?php echo $customers->Customer_No->CellAttributes() ?>>
<div<?php echo $customers->Customer_No->ViewAttributes() ?>><?php echo $customers->Customer_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customers->Customer_Name->Visible) { // Customer_Name ?>
	<tr<?php echo $customers->Customer_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Customer_Name->FldCaption() ?></td>
		<td<?php echo $customers->Customer_Name->CellAttributes() ?>>
<div<?php echo $customers->Customer_Name->ViewAttributes() ?>><?php echo $customers->Customer_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customers->Address->Visible) { // Address ?>
	<tr<?php echo $customers->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Address->FldCaption() ?></td>
		<td<?php echo $customers->Address->CellAttributes() ?>>
<div<?php echo $customers->Address->ViewAttributes() ?>><?php echo $customers->Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customers->Contact_Person->Visible) { // Contact_Person ?>
	<tr<?php echo $customers->Contact_Person->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Contact_Person->FldCaption() ?></td>
		<td<?php echo $customers->Contact_Person->CellAttributes() ?>>
<div<?php echo $customers->Contact_Person->ViewAttributes() ?>><?php echo $customers->Contact_Person->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customers->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $customers->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Contact_No->FldCaption() ?></td>
		<td<?php echo $customers->Contact_No->CellAttributes() ?>>
<div<?php echo $customers->Contact_No->ViewAttributes() ?>><?php echo $customers->Contact_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customers->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $customers->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Remarks->FldCaption() ?></td>
		<td<?php echo $customers->Remarks->CellAttributes() ?>>
<div<?php echo $customers->Remarks->ViewAttributes() ?>><?php echo $customers->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($customers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$customers_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccustomers_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'customers';

	// Page object name
	var $PageObjName = 'customers_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customers;
		if ($customers->UseTokenInUrl) $PageUrl .= "t=" . $customers->TableVar . "&"; // Add page token
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
		global $objForm, $customers;
		if ($customers->UseTokenInUrl) {
			if ($objForm)
				return ($customers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccustomers_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (customers)
		$GLOBALS["customers"] = new ccustomers();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customers', TRUE);

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
		global $customers;

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
			$this->Page_Terminate("customerslist.php");
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
		global $Language, $customers;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$customers->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $customers->id->QueryStringValue;
			} else {
				$sReturnUrl = "customerslist.php"; // Return to list
			}

			// Get action
			$customers->CurrentAction = "I"; // Display form
			switch ($customers->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "customerslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "customerslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$customers->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $customers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$customers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$customers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $customers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$customers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$customers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$customers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customers;
		$sFilter = $customers->KeyFilter();

		// Call Row Selecting event
		$customers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$customers->CurrentFilter = $sFilter;
		$sSql = $customers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$customers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $customers;
		$customers->id->setDbValue($rs->fields('id'));
		$customers->client_id->setDbValue($rs->fields('client_id'));
		$customers->Customer_No->setDbValue($rs->fields('Customer_No'));
		$customers->Customer_Name->setDbValue($rs->fields('Customer_Name'));
		$customers->Address->setDbValue($rs->fields('Address'));
		$customers->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$customers->Contact_No->setDbValue($rs->fields('Contact_No'));
		$customers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $customers;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($customers->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($customers->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($customers->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($customers->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($customers->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($customers->id->CurrentValue);
		$this->AddUrl = $customers->AddUrl();
		$this->EditUrl = $customers->EditUrl();
		$this->CopyUrl = $customers->CopyUrl();
		$this->DeleteUrl = $customers->DeleteUrl();
		$this->ListUrl = $customers->ListUrl();

		// Call Row_Rendering event
		$customers->Row_Rendering();

		// Common render codes for all row types
		// id

		$customers->id->CellCssStyle = ""; $customers->id->CellCssClass = "";
		$customers->id->CellAttrs = array(); $customers->id->ViewAttrs = array(); $customers->id->EditAttrs = array();

		// client_id
		$customers->client_id->CellCssStyle = ""; $customers->client_id->CellCssClass = "";
		$customers->client_id->CellAttrs = array(); $customers->client_id->ViewAttrs = array(); $customers->client_id->EditAttrs = array();

		// Customer_No
		$customers->Customer_No->CellCssStyle = ""; $customers->Customer_No->CellCssClass = "";
		$customers->Customer_No->CellAttrs = array(); $customers->Customer_No->ViewAttrs = array(); $customers->Customer_No->EditAttrs = array();

		// Customer_Name
		$customers->Customer_Name->CellCssStyle = ""; $customers->Customer_Name->CellCssClass = "";
		$customers->Customer_Name->CellAttrs = array(); $customers->Customer_Name->ViewAttrs = array(); $customers->Customer_Name->EditAttrs = array();

		// Address
		$customers->Address->CellCssStyle = ""; $customers->Address->CellCssClass = "";
		$customers->Address->CellAttrs = array(); $customers->Address->ViewAttrs = array(); $customers->Address->EditAttrs = array();

		// Contact_Person
		$customers->Contact_Person->CellCssStyle = ""; $customers->Contact_Person->CellCssClass = "";
		$customers->Contact_Person->CellAttrs = array(); $customers->Contact_Person->ViewAttrs = array(); $customers->Contact_Person->EditAttrs = array();

		// Contact_No
		$customers->Contact_No->CellCssStyle = ""; $customers->Contact_No->CellCssClass = "";
		$customers->Contact_No->CellAttrs = array(); $customers->Contact_No->ViewAttrs = array(); $customers->Contact_No->EditAttrs = array();

		// Remarks
		$customers->Remarks->CellCssStyle = ""; $customers->Remarks->CellCssClass = "";
		$customers->Remarks->CellAttrs = array(); $customers->Remarks->ViewAttrs = array(); $customers->Remarks->EditAttrs = array();
		if ($customers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customers->id->ViewValue = $customers->id->CurrentValue;
			$customers->id->CssStyle = "";
			$customers->id->CssClass = "";
			$customers->id->ViewCustomAttributes = "";

			// client_id
			if (strval($customers->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customers->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customers->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$customers->client_id->ViewValue = $customers->client_id->CurrentValue;
				}
			} else {
				$customers->client_id->ViewValue = NULL;
			}
			$customers->client_id->CssStyle = "";
			$customers->client_id->CssClass = "";
			$customers->client_id->ViewCustomAttributes = "";

			// Customer_No
			$customers->Customer_No->ViewValue = $customers->Customer_No->CurrentValue;
			$customers->Customer_No->CssStyle = "";
			$customers->Customer_No->CssClass = "";
			$customers->Customer_No->ViewCustomAttributes = "";

			// Customer_Name
			$customers->Customer_Name->ViewValue = $customers->Customer_Name->CurrentValue;
			$customers->Customer_Name->CssStyle = "";
			$customers->Customer_Name->CssClass = "";
			$customers->Customer_Name->ViewCustomAttributes = "";

			// Address
			if (strval($customers->Address->CurrentValue) <> "") {
				$sFilterWrk = "`Destination` = '" . ew_AdjustSql($customers->Address->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customers->Address->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$customers->Address->ViewValue = $customers->Address->CurrentValue;
				}
			} else {
				$customers->Address->ViewValue = NULL;
			}
			$customers->Address->CssStyle = "";
			$customers->Address->CssClass = "";
			$customers->Address->ViewCustomAttributes = "";

			// Contact_Person
			$customers->Contact_Person->ViewValue = $customers->Contact_Person->CurrentValue;
			$customers->Contact_Person->CssStyle = "";
			$customers->Contact_Person->CssClass = "";
			$customers->Contact_Person->ViewCustomAttributes = "";

			// Contact_No
			$customers->Contact_No->ViewValue = $customers->Contact_No->CurrentValue;
			$customers->Contact_No->CssStyle = "";
			$customers->Contact_No->CssClass = "";
			$customers->Contact_No->ViewCustomAttributes = "";

			// Remarks
			$customers->Remarks->ViewValue = $customers->Remarks->CurrentValue;
			$customers->Remarks->CssStyle = "";
			$customers->Remarks->CssClass = "";
			$customers->Remarks->ViewCustomAttributes = "";

			// id
			$customers->id->HrefValue = "";
			$customers->id->TooltipValue = "";

			// client_id
			$customers->client_id->HrefValue = "";
			$customers->client_id->TooltipValue = "";

			// Customer_No
			$customers->Customer_No->HrefValue = "";
			$customers->Customer_No->TooltipValue = "";

			// Customer_Name
			$customers->Customer_Name->HrefValue = "";
			$customers->Customer_Name->TooltipValue = "";

			// Address
			$customers->Address->HrefValue = "";
			$customers->Address->TooltipValue = "";

			// Contact_Person
			$customers->Contact_Person->HrefValue = "";
			$customers->Contact_Person->TooltipValue = "";

			// Contact_No
			$customers->Contact_No->HrefValue = "";
			$customers->Contact_No->TooltipValue = "";

			// Remarks
			$customers->Remarks->HrefValue = "";
			$customers->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($customers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$customers->Row_Rendered();
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
