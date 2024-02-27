<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "companyinfo.php" ?>
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
$company_view = new ccompany_view();
$Page =& $company_view;

// Page init
$company_view->Page_Init();

// Page main
$company_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($company->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var company_view = new ew_Page("company_view");

// page properties
company_view.PageID = "view"; // page ID
company_view.FormID = "fcompanyview"; // form ID
var EW_PAGE_ID = company_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
company_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
company_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
company_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $company->TableCaption() ?>
<br><br>
<?php if ($company->Export == "") { ?>
<a href="<?php echo $company_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $company_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $company_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $company_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $company_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$company_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($company->id->Visible) { // id ?>
	<tr<?php echo $company->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->id->FldCaption() ?></td>
		<td<?php echo $company->id->CellAttributes() ?>>
<div<?php echo $company->id->ViewAttributes() ?>><?php echo $company->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($company->Company_Name->Visible) { // Company_Name ?>
	<tr<?php echo $company->Company_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Company_Name->FldCaption() ?></td>
		<td<?php echo $company->Company_Name->CellAttributes() ?>>
<div<?php echo $company->Company_Name->ViewAttributes() ?>><?php echo $company->Company_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($company->Main_Address->Visible) { // Main_Address ?>
	<tr<?php echo $company->Main_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Main_Address->FldCaption() ?></td>
		<td<?php echo $company->Main_Address->CellAttributes() ?>>
<div<?php echo $company->Main_Address->ViewAttributes() ?>><?php echo $company->Main_Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($company->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $company->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Contact_No->FldCaption() ?></td>
		<td<?php echo $company->Contact_No->CellAttributes() ?>>
<div<?php echo $company->Contact_No->ViewAttributes() ?>><?php echo $company->Contact_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($company->Email_Address->Visible) { // Email_Address ?>
	<tr<?php echo $company->Email_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Email_Address->FldCaption() ?></td>
		<td<?php echo $company->Email_Address->CellAttributes() ?>>
<div<?php echo $company->Email_Address->ViewAttributes() ?>><?php echo $company->Email_Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($company->Website->Visible) { // Website ?>
	<tr<?php echo $company->Website->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Website->FldCaption() ?></td>
		<td<?php echo $company->Website->CellAttributes() ?>>
<div<?php echo $company->Website->ViewAttributes() ?>><?php echo $company->Website->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($company->TIN_No->Visible) { // TIN_No ?>
	<tr<?php echo $company->TIN_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->TIN_No->FldCaption() ?></td>
		<td<?php echo $company->TIN_No->CellAttributes() ?>>
<div<?php echo $company->TIN_No->ViewAttributes() ?>><?php echo $company->TIN_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($company->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $company->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->File_Upload->FldCaption() ?></td>
		<td<?php echo $company->File_Upload->CellAttributes() ?>>
<?php if ($company->File_Upload->HrefValue <> "" || $company->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($company->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $company->File_Upload->HrefValue ?>"><?php echo $company->File_Upload->ViewValue ?></a>
<?php } elseif (!in_array($company->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($company->File_Upload->Upload->DbValue)) { ?>
<?php echo $company->File_Upload->ViewValue ?>
<?php } elseif (!in_array($company->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($company->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $company->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Remarks->FldCaption() ?></td>
		<td<?php echo $company->Remarks->CellAttributes() ?>>
<div<?php echo $company->Remarks->ViewAttributes() ?>><?php echo $company->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($company->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$company_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccompany_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'company';

	// Page object name
	var $PageObjName = 'company_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $company;
		if ($company->UseTokenInUrl) $PageUrl .= "t=" . $company->TableVar . "&"; // Add page token
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
		global $objForm, $company;
		if ($company->UseTokenInUrl) {
			if ($objForm)
				return ($company->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($company->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccompany_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (company)
		$GLOBALS["company"] = new ccompany();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'company', TRUE);

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
		global $company;

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
			$this->Page_Terminate("companylist.php");
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
		global $Language, $company;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$company->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $company->id->QueryStringValue;
			} else {
				$sReturnUrl = "companylist.php"; // Return to list
			}

			// Get action
			$company->CurrentAction = "I"; // Display form
			switch ($company->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "companylist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "companylist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$company->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $company;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$company->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$company->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $company->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$company->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$company->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$company->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $company;
		$sFilter = $company->KeyFilter();

		// Call Row Selecting event
		$company->Row_Selecting($sFilter);

		// Load SQL based on filter
		$company->CurrentFilter = $sFilter;
		$sSql = $company->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$company->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $company;
		$company->id->setDbValue($rs->fields('id'));
		$company->Company_Name->setDbValue($rs->fields('Company_Name'));
		$company->Main_Address->setDbValue($rs->fields('Main_Address'));
		$company->Contact_No->setDbValue($rs->fields('Contact_No'));
		$company->Email_Address->setDbValue($rs->fields('Email_Address'));
		$company->Website->setDbValue($rs->fields('Website'));
		$company->TIN_No->setDbValue($rs->fields('TIN_No'));
		$company->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$company->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $company;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($company->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($company->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($company->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($company->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($company->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($company->id->CurrentValue);
		$this->AddUrl = $company->AddUrl();
		$this->EditUrl = $company->EditUrl();
		$this->CopyUrl = $company->CopyUrl();
		$this->DeleteUrl = $company->DeleteUrl();
		$this->ListUrl = $company->ListUrl();

		// Call Row_Rendering event
		$company->Row_Rendering();

		// Common render codes for all row types
		// id

		$company->id->CellCssStyle = ""; $company->id->CellCssClass = "";
		$company->id->CellAttrs = array(); $company->id->ViewAttrs = array(); $company->id->EditAttrs = array();

		// Company_Name
		$company->Company_Name->CellCssStyle = ""; $company->Company_Name->CellCssClass = "";
		$company->Company_Name->CellAttrs = array(); $company->Company_Name->ViewAttrs = array(); $company->Company_Name->EditAttrs = array();

		// Main_Address
		$company->Main_Address->CellCssStyle = ""; $company->Main_Address->CellCssClass = "";
		$company->Main_Address->CellAttrs = array(); $company->Main_Address->ViewAttrs = array(); $company->Main_Address->EditAttrs = array();

		// Contact_No
		$company->Contact_No->CellCssStyle = ""; $company->Contact_No->CellCssClass = "";
		$company->Contact_No->CellAttrs = array(); $company->Contact_No->ViewAttrs = array(); $company->Contact_No->EditAttrs = array();

		// Email_Address
		$company->Email_Address->CellCssStyle = ""; $company->Email_Address->CellCssClass = "";
		$company->Email_Address->CellAttrs = array(); $company->Email_Address->ViewAttrs = array(); $company->Email_Address->EditAttrs = array();

		// Website
		$company->Website->CellCssStyle = ""; $company->Website->CellCssClass = "";
		$company->Website->CellAttrs = array(); $company->Website->ViewAttrs = array(); $company->Website->EditAttrs = array();

		// TIN_No
		$company->TIN_No->CellCssStyle = ""; $company->TIN_No->CellCssClass = "";
		$company->TIN_No->CellAttrs = array(); $company->TIN_No->ViewAttrs = array(); $company->TIN_No->EditAttrs = array();

		// File_Upload
		$company->File_Upload->CellCssStyle = ""; $company->File_Upload->CellCssClass = "";
		$company->File_Upload->CellAttrs = array(); $company->File_Upload->ViewAttrs = array(); $company->File_Upload->EditAttrs = array();

		// Remarks
		$company->Remarks->CellCssStyle = ""; $company->Remarks->CellCssClass = "";
		$company->Remarks->CellAttrs = array(); $company->Remarks->ViewAttrs = array(); $company->Remarks->EditAttrs = array();
		if ($company->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$company->id->ViewValue = $company->id->CurrentValue;
			$company->id->CssStyle = "";
			$company->id->CssClass = "";
			$company->id->ViewCustomAttributes = "";

			// Company_Name
			$company->Company_Name->ViewValue = $company->Company_Name->CurrentValue;
			$company->Company_Name->CssStyle = "";
			$company->Company_Name->CssClass = "";
			$company->Company_Name->ViewCustomAttributes = "";

			// Main_Address
			$company->Main_Address->ViewValue = $company->Main_Address->CurrentValue;
			$company->Main_Address->CssStyle = "";
			$company->Main_Address->CssClass = "";
			$company->Main_Address->ViewCustomAttributes = "";

			// Contact_No
			$company->Contact_No->ViewValue = $company->Contact_No->CurrentValue;
			$company->Contact_No->CssStyle = "";
			$company->Contact_No->CssClass = "";
			$company->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$company->Email_Address->ViewValue = $company->Email_Address->CurrentValue;
			$company->Email_Address->CssStyle = "";
			$company->Email_Address->CssClass = "";
			$company->Email_Address->ViewCustomAttributes = "";

			// Website
			$company->Website->ViewValue = $company->Website->CurrentValue;
			$company->Website->CssStyle = "";
			$company->Website->CssClass = "";
			$company->Website->ViewCustomAttributes = "";

			// TIN_No
			$company->TIN_No->ViewValue = $company->TIN_No->CurrentValue;
			$company->TIN_No->CssStyle = "";
			$company->TIN_No->CssClass = "";
			$company->TIN_No->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->ViewValue = $company->File_Upload->Upload->DbValue;
			} else {
				$company->File_Upload->ViewValue = "";
			}
			$company->File_Upload->CssStyle = "";
			$company->File_Upload->CssClass = "";
			$company->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$company->Remarks->ViewValue = $company->Remarks->CurrentValue;
			$company->Remarks->CssStyle = "";
			$company->Remarks->CssClass = "";
			$company->Remarks->ViewCustomAttributes = "";

			// id
			$company->id->HrefValue = "";
			$company->id->TooltipValue = "";

			// Company_Name
			$company->Company_Name->HrefValue = "";
			$company->Company_Name->TooltipValue = "";

			// Main_Address
			$company->Main_Address->HrefValue = "";
			$company->Main_Address->TooltipValue = "";

			// Contact_No
			$company->Contact_No->HrefValue = "";
			$company->Contact_No->TooltipValue = "";

			// Email_Address
			$company->Email_Address->HrefValue = "";
			$company->Email_Address->TooltipValue = "";

			// Website
			$company->Website->HrefValue = "";
			$company->Website->TooltipValue = "";

			// TIN_No
			$company->TIN_No->HrefValue = "";
			$company->TIN_No->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $company->File_Upload->UploadPath) . ((!empty($company->File_Upload->ViewValue)) ? $company->File_Upload->ViewValue : $company->File_Upload->CurrentValue);
				if ($company->Export <> "") $company->File_Upload->HrefValue = ew_ConvertFullUrl($company->File_Upload->HrefValue);
			} else {
				$company->File_Upload->HrefValue = "";
			}
			$company->File_Upload->TooltipValue = "";

			// Remarks
			$company->Remarks->HrefValue = "";
			$company->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($company->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$company->Row_Rendered();
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
