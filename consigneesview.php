<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "consigneesinfo.php" ?>
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
$consignees_view = new cconsignees_view();
$Page =& $consignees_view;

// Page init
$consignees_view->Page_Init();

// Page main
$consignees_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($consignees->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var consignees_view = new ew_Page("consignees_view");

// page properties
consignees_view.PageID = "view"; // page ID
consignees_view.FormID = "fconsigneesview"; // form ID
var EW_PAGE_ID = consignees_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
consignees_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
consignees_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consignees_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $consignees->TableCaption() ?>
<br><br>
<?php if ($consignees->Export == "") { ?>
<a href="<?php echo $consignees_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $consignees_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $consignees_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $consignees_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$consignees_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($consignees->id->Visible) { // id ?>
	<tr<?php echo $consignees->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->id->FldCaption() ?></td>
		<td<?php echo $consignees->id->CellAttributes() ?>>
<div<?php echo $consignees->id->ViewAttributes() ?>><?php echo $consignees->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consignees->client_id->Visible) { // client_id ?>
	<tr<?php echo $consignees->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->client_id->FldCaption() ?></td>
		<td<?php echo $consignees->client_id->CellAttributes() ?>>
<div<?php echo $consignees->client_id->ViewAttributes() ?>><?php echo $consignees->client_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consignees->Customer_No->Visible) { // Customer_No ?>
	<tr<?php echo $consignees->Customer_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Customer_No->FldCaption() ?></td>
		<td<?php echo $consignees->Customer_No->CellAttributes() ?>>
<div<?php echo $consignees->Customer_No->ViewAttributes() ?>><?php echo $consignees->Customer_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consignees->Customer_Name->Visible) { // Customer_Name ?>
	<tr<?php echo $consignees->Customer_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Customer_Name->FldCaption() ?></td>
		<td<?php echo $consignees->Customer_Name->CellAttributes() ?>>
<div<?php echo $consignees->Customer_Name->ViewAttributes() ?>><?php echo $consignees->Customer_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consignees->Address->Visible) { // Address ?>
	<tr<?php echo $consignees->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Address->FldCaption() ?></td>
		<td<?php echo $consignees->Address->CellAttributes() ?>>
<div<?php echo $consignees->Address->ViewAttributes() ?>><?php echo $consignees->Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consignees->Contact_Person->Visible) { // Contact_Person ?>
	<tr<?php echo $consignees->Contact_Person->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Contact_Person->FldCaption() ?></td>
		<td<?php echo $consignees->Contact_Person->CellAttributes() ?>>
<div<?php echo $consignees->Contact_Person->ViewAttributes() ?>><?php echo $consignees->Contact_Person->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consignees->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $consignees->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Contact_No->FldCaption() ?></td>
		<td<?php echo $consignees->Contact_No->CellAttributes() ?>>
<div<?php echo $consignees->Contact_No->ViewAttributes() ?>><?php echo $consignees->Contact_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($consignees->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $consignees->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Remarks->FldCaption() ?></td>
		<td<?php echo $consignees->Remarks->CellAttributes() ?>>
<div<?php echo $consignees->Remarks->ViewAttributes() ?>><?php echo $consignees->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($consignees->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$consignees_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cconsignees_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'consignees';

	// Page object name
	var $PageObjName = 'consignees_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $consignees;
		if ($consignees->UseTokenInUrl) $PageUrl .= "t=" . $consignees->TableVar . "&"; // Add page token
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
		global $objForm, $consignees;
		if ($consignees->UseTokenInUrl) {
			if ($objForm)
				return ($consignees->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($consignees->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconsignees_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (consignees)
		$GLOBALS["consignees"] = new cconsignees();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consignees', TRUE);

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
		global $consignees;

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
			$this->Page_Terminate("consigneeslist.php");
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
		global $Language, $consignees;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$consignees->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $consignees->id->QueryStringValue;
			} else {
				$sReturnUrl = "consigneeslist.php"; // Return to list
			}

			// Get action
			$consignees->CurrentAction = "I"; // Display form
			switch ($consignees->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "consigneeslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "consigneeslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$consignees->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $consignees;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$consignees->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$consignees->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $consignees->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$consignees->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$consignees->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$consignees->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $consignees;
		$sFilter = $consignees->KeyFilter();

		// Call Row Selecting event
		$consignees->Row_Selecting($sFilter);

		// Load SQL based on filter
		$consignees->CurrentFilter = $sFilter;
		$sSql = $consignees->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$consignees->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $consignees;
		$consignees->id->setDbValue($rs->fields('id'));
		$consignees->client_id->setDbValue($rs->fields('client_id'));
		$consignees->Customer_No->setDbValue($rs->fields('Customer_No'));
		$consignees->Customer_Name->setDbValue($rs->fields('Customer_Name'));
		$consignees->Address->setDbValue($rs->fields('Address'));
		$consignees->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$consignees->Contact_No->setDbValue($rs->fields('Contact_No'));
		$consignees->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $consignees;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($consignees->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($consignees->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($consignees->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($consignees->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($consignees->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($consignees->id->CurrentValue);
		$this->AddUrl = $consignees->AddUrl();
		$this->EditUrl = $consignees->EditUrl();
		$this->CopyUrl = $consignees->CopyUrl();
		$this->DeleteUrl = $consignees->DeleteUrl();
		$this->ListUrl = $consignees->ListUrl();

		// Call Row_Rendering event
		$consignees->Row_Rendering();

		// Common render codes for all row types
		// id

		$consignees->id->CellCssStyle = ""; $consignees->id->CellCssClass = "";
		$consignees->id->CellAttrs = array(); $consignees->id->ViewAttrs = array(); $consignees->id->EditAttrs = array();

		// client_id
		$consignees->client_id->CellCssStyle = ""; $consignees->client_id->CellCssClass = "";
		$consignees->client_id->CellAttrs = array(); $consignees->client_id->ViewAttrs = array(); $consignees->client_id->EditAttrs = array();

		// Customer_No
		$consignees->Customer_No->CellCssStyle = ""; $consignees->Customer_No->CellCssClass = "";
		$consignees->Customer_No->CellAttrs = array(); $consignees->Customer_No->ViewAttrs = array(); $consignees->Customer_No->EditAttrs = array();

		// Customer_Name
		$consignees->Customer_Name->CellCssStyle = ""; $consignees->Customer_Name->CellCssClass = "";
		$consignees->Customer_Name->CellAttrs = array(); $consignees->Customer_Name->ViewAttrs = array(); $consignees->Customer_Name->EditAttrs = array();

		// Address
		$consignees->Address->CellCssStyle = ""; $consignees->Address->CellCssClass = "";
		$consignees->Address->CellAttrs = array(); $consignees->Address->ViewAttrs = array(); $consignees->Address->EditAttrs = array();

		// Contact_Person
		$consignees->Contact_Person->CellCssStyle = ""; $consignees->Contact_Person->CellCssClass = "";
		$consignees->Contact_Person->CellAttrs = array(); $consignees->Contact_Person->ViewAttrs = array(); $consignees->Contact_Person->EditAttrs = array();

		// Contact_No
		$consignees->Contact_No->CellCssStyle = ""; $consignees->Contact_No->CellCssClass = "";
		$consignees->Contact_No->CellAttrs = array(); $consignees->Contact_No->ViewAttrs = array(); $consignees->Contact_No->EditAttrs = array();

		// Remarks
		$consignees->Remarks->CellCssStyle = ""; $consignees->Remarks->CellCssClass = "";
		$consignees->Remarks->CellAttrs = array(); $consignees->Remarks->ViewAttrs = array(); $consignees->Remarks->EditAttrs = array();
		if ($consignees->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$consignees->id->ViewValue = $consignees->id->CurrentValue;
			$consignees->id->CssStyle = "";
			$consignees->id->CssClass = "";
			$consignees->id->ViewCustomAttributes = "";

			// client_id
			if (strval($consignees->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($consignees->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$consignees->client_id->ViewValue = $consignees->client_id->CurrentValue;
				}
			} else {
				$consignees->client_id->ViewValue = NULL;
			}
			$consignees->client_id->CssStyle = "";
			$consignees->client_id->CssClass = "";
			$consignees->client_id->ViewCustomAttributes = "";

			// Customer_No
			$consignees->Customer_No->ViewValue = $consignees->Customer_No->CurrentValue;
			$consignees->Customer_No->CssStyle = "";
			$consignees->Customer_No->CssClass = "";
			$consignees->Customer_No->ViewCustomAttributes = "";

			// Customer_Name
			$consignees->Customer_Name->ViewValue = $consignees->Customer_Name->CurrentValue;
			$consignees->Customer_Name->CssStyle = "";
			$consignees->Customer_Name->CssClass = "";
			$consignees->Customer_Name->ViewCustomAttributes = "";

			// Address
			if (strval($consignees->Address->CurrentValue) <> "") {
				$sFilterWrk = "`Destination` = '" . ew_AdjustSql($consignees->Address->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->Address->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$consignees->Address->ViewValue = $consignees->Address->CurrentValue;
				}
			} else {
				$consignees->Address->ViewValue = NULL;
			}
			$consignees->Address->CssStyle = "";
			$consignees->Address->CssClass = "";
			$consignees->Address->ViewCustomAttributes = "";

			// Contact_Person
			$consignees->Contact_Person->ViewValue = $consignees->Contact_Person->CurrentValue;
			$consignees->Contact_Person->CssStyle = "";
			$consignees->Contact_Person->CssClass = "";
			$consignees->Contact_Person->ViewCustomAttributes = "";

			// Contact_No
			$consignees->Contact_No->ViewValue = $consignees->Contact_No->CurrentValue;
			$consignees->Contact_No->CssStyle = "";
			$consignees->Contact_No->CssClass = "";
			$consignees->Contact_No->ViewCustomAttributes = "";

			// Remarks
			$consignees->Remarks->ViewValue = $consignees->Remarks->CurrentValue;
			$consignees->Remarks->CssStyle = "";
			$consignees->Remarks->CssClass = "";
			$consignees->Remarks->ViewCustomAttributes = "";

			// id
			$consignees->id->HrefValue = "";
			$consignees->id->TooltipValue = "";

			// client_id
			$consignees->client_id->HrefValue = "";
			$consignees->client_id->TooltipValue = "";

			// Customer_No
			$consignees->Customer_No->HrefValue = "";
			$consignees->Customer_No->TooltipValue = "";

			// Customer_Name
			$consignees->Customer_Name->HrefValue = "";
			$consignees->Customer_Name->TooltipValue = "";

			// Address
			$consignees->Address->HrefValue = "";
			$consignees->Address->TooltipValue = "";

			// Contact_Person
			$consignees->Contact_Person->HrefValue = "";
			$consignees->Contact_Person->TooltipValue = "";

			// Contact_No
			$consignees->Contact_No->HrefValue = "";
			$consignees->Contact_No->TooltipValue = "";

			// Remarks
			$consignees->Remarks->HrefValue = "";
			$consignees->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($consignees->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$consignees->Row_Rendered();
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
