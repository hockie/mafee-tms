<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "banks_accountsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "companyinfo.php" ?>
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
$banks_accounts_view = new cbanks_accounts_view();
$Page =& $banks_accounts_view;

// Page init
$banks_accounts_view->Page_Init();

// Page main
$banks_accounts_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($banks_accounts->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var banks_accounts_view = new ew_Page("banks_accounts_view");

// page properties
banks_accounts_view.PageID = "view"; // page ID
banks_accounts_view.FormID = "fbanks_accountsview"; // form ID
var EW_PAGE_ID = banks_accounts_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
banks_accounts_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
banks_accounts_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
banks_accounts_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banks_accounts_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banks_accounts->TableCaption() ?>
<br><br>
<?php if ($banks_accounts->Export == "") { ?>
<a href="<?php echo $banks_accounts_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $banks_accounts_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $banks_accounts_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $banks_accounts_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $banks_accounts_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$banks_accounts_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($banks_accounts->id->Visible) { // id ?>
	<tr<?php echo $banks_accounts->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->id->FldCaption() ?></td>
		<td<?php echo $banks_accounts->id->CellAttributes() ?>>
<div<?php echo $banks_accounts->id->ViewAttributes() ?>><?php echo $banks_accounts->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Bank_Name->Visible) { // Bank_Name ?>
	<tr<?php echo $banks_accounts->Bank_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Bank_Name->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Bank_Name->CellAttributes() ?>>
<div<?php echo $banks_accounts->Bank_Name->ViewAttributes() ?>><?php echo $banks_accounts->Bank_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Branch->Visible) { // Branch ?>
	<tr<?php echo $banks_accounts->Branch->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Branch->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Branch->CellAttributes() ?>>
<div<?php echo $banks_accounts->Branch->ViewAttributes() ?>><?php echo $banks_accounts->Branch->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Address->Visible) { // Address ?>
	<tr<?php echo $banks_accounts->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Address->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Address->CellAttributes() ?>>
<div<?php echo $banks_accounts->Address->ViewAttributes() ?>><?php echo $banks_accounts->Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Account_Name->Visible) { // Account_Name ?>
	<tr<?php echo $banks_accounts->Account_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Account_Name->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Account_Name->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Name->ViewAttributes() ?>><?php echo $banks_accounts->Account_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Account_Number->Visible) { // Account_Number ?>
	<tr<?php echo $banks_accounts->Account_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Account_Number->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Account_Number->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Number->ViewAttributes() ?>><?php echo $banks_accounts->Account_Number->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Account_Type->Visible) { // Account_Type ?>
	<tr<?php echo $banks_accounts->Account_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Account_Type->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Account_Type->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Type->ViewAttributes() ?>><?php echo $banks_accounts->Account_Type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $banks_accounts->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Remarks->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Remarks->CellAttributes() ?>>
<div<?php echo $banks_accounts->Remarks->ViewAttributes() ?>><?php echo $banks_accounts->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Company->Visible) { // Company ?>
	<tr<?php echo $banks_accounts->Company->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Company->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Company->CellAttributes() ?>>
<div<?php echo $banks_accounts->Company->ViewAttributes() ?>><?php echo $banks_accounts->Company->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($banks_accounts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$banks_accounts_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanks_accounts_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'banks_accounts';

	// Page object name
	var $PageObjName = 'banks_accounts_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banks_accounts;
		if ($banks_accounts->UseTokenInUrl) $PageUrl .= "t=" . $banks_accounts->TableVar . "&"; // Add page token
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
		global $objForm, $banks_accounts;
		if ($banks_accounts->UseTokenInUrl) {
			if ($objForm)
				return ($banks_accounts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banks_accounts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanks_accounts_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (banks_accounts)
		$GLOBALS["banks_accounts"] = new cbanks_accounts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (company)
		$GLOBALS['company'] = new ccompany();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banks_accounts', TRUE);

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
		global $banks_accounts;

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
			$this->Page_Terminate("banks_accountslist.php");
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
		global $Language, $banks_accounts;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$banks_accounts->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $banks_accounts->id->QueryStringValue;
			} else {
				$sReturnUrl = "banks_accountslist.php"; // Return to list
			}

			// Get action
			$banks_accounts->CurrentAction = "I"; // Display form
			switch ($banks_accounts->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "banks_accountslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "banks_accountslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$banks_accounts->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $banks_accounts;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$banks_accounts->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$banks_accounts->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $banks_accounts->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$banks_accounts->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$banks_accounts->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$banks_accounts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banks_accounts;
		$sFilter = $banks_accounts->KeyFilter();

		// Call Row Selecting event
		$banks_accounts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banks_accounts->CurrentFilter = $sFilter;
		$sSql = $banks_accounts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$banks_accounts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $banks_accounts;
		$banks_accounts->id->setDbValue($rs->fields('id'));
		$banks_accounts->Bank_Name->setDbValue($rs->fields('Bank_Name'));
		$banks_accounts->Branch->setDbValue($rs->fields('Branch'));
		$banks_accounts->Address->setDbValue($rs->fields('Address'));
		$banks_accounts->Account_Name->setDbValue($rs->fields('Account_Name'));
		$banks_accounts->Account_Number->setDbValue($rs->fields('Account_Number'));
		$banks_accounts->Account_Type->setDbValue($rs->fields('Account_Type'));
		$banks_accounts->Remarks->setDbValue($rs->fields('Remarks'));
		$banks_accounts->Company->setDbValue($rs->fields('Company'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banks_accounts;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($banks_accounts->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($banks_accounts->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($banks_accounts->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($banks_accounts->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($banks_accounts->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($banks_accounts->id->CurrentValue);
		$this->AddUrl = $banks_accounts->AddUrl();
		$this->EditUrl = $banks_accounts->EditUrl();
		$this->CopyUrl = $banks_accounts->CopyUrl();
		$this->DeleteUrl = $banks_accounts->DeleteUrl();
		$this->ListUrl = $banks_accounts->ListUrl();

		// Call Row_Rendering event
		$banks_accounts->Row_Rendering();

		// Common render codes for all row types
		// id

		$banks_accounts->id->CellCssStyle = ""; $banks_accounts->id->CellCssClass = "";
		$banks_accounts->id->CellAttrs = array(); $banks_accounts->id->ViewAttrs = array(); $banks_accounts->id->EditAttrs = array();

		// Bank_Name
		$banks_accounts->Bank_Name->CellCssStyle = ""; $banks_accounts->Bank_Name->CellCssClass = "";
		$banks_accounts->Bank_Name->CellAttrs = array(); $banks_accounts->Bank_Name->ViewAttrs = array(); $banks_accounts->Bank_Name->EditAttrs = array();

		// Branch
		$banks_accounts->Branch->CellCssStyle = ""; $banks_accounts->Branch->CellCssClass = "";
		$banks_accounts->Branch->CellAttrs = array(); $banks_accounts->Branch->ViewAttrs = array(); $banks_accounts->Branch->EditAttrs = array();

		// Address
		$banks_accounts->Address->CellCssStyle = ""; $banks_accounts->Address->CellCssClass = "";
		$banks_accounts->Address->CellAttrs = array(); $banks_accounts->Address->ViewAttrs = array(); $banks_accounts->Address->EditAttrs = array();

		// Account_Name
		$banks_accounts->Account_Name->CellCssStyle = ""; $banks_accounts->Account_Name->CellCssClass = "";
		$banks_accounts->Account_Name->CellAttrs = array(); $banks_accounts->Account_Name->ViewAttrs = array(); $banks_accounts->Account_Name->EditAttrs = array();

		// Account_Number
		$banks_accounts->Account_Number->CellCssStyle = ""; $banks_accounts->Account_Number->CellCssClass = "";
		$banks_accounts->Account_Number->CellAttrs = array(); $banks_accounts->Account_Number->ViewAttrs = array(); $banks_accounts->Account_Number->EditAttrs = array();

		// Account_Type
		$banks_accounts->Account_Type->CellCssStyle = ""; $banks_accounts->Account_Type->CellCssClass = "";
		$banks_accounts->Account_Type->CellAttrs = array(); $banks_accounts->Account_Type->ViewAttrs = array(); $banks_accounts->Account_Type->EditAttrs = array();

		// Remarks
		$banks_accounts->Remarks->CellCssStyle = ""; $banks_accounts->Remarks->CellCssClass = "";
		$banks_accounts->Remarks->CellAttrs = array(); $banks_accounts->Remarks->ViewAttrs = array(); $banks_accounts->Remarks->EditAttrs = array();

		// Company
		$banks_accounts->Company->CellCssStyle = ""; $banks_accounts->Company->CellCssClass = "";
		$banks_accounts->Company->CellAttrs = array(); $banks_accounts->Company->ViewAttrs = array(); $banks_accounts->Company->EditAttrs = array();
		if ($banks_accounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$banks_accounts->id->ViewValue = $banks_accounts->id->CurrentValue;
			$banks_accounts->id->CssStyle = "";
			$banks_accounts->id->CssClass = "";
			$banks_accounts->id->ViewCustomAttributes = "";

			// Bank_Name
			$banks_accounts->Bank_Name->ViewValue = $banks_accounts->Bank_Name->CurrentValue;
			$banks_accounts->Bank_Name->CssStyle = "";
			$banks_accounts->Bank_Name->CssClass = "";
			$banks_accounts->Bank_Name->ViewCustomAttributes = "";

			// Branch
			$banks_accounts->Branch->ViewValue = $banks_accounts->Branch->CurrentValue;
			$banks_accounts->Branch->CssStyle = "";
			$banks_accounts->Branch->CssClass = "";
			$banks_accounts->Branch->ViewCustomAttributes = "";

			// Address
			$banks_accounts->Address->ViewValue = $banks_accounts->Address->CurrentValue;
			$banks_accounts->Address->CssStyle = "";
			$banks_accounts->Address->CssClass = "";
			$banks_accounts->Address->ViewCustomAttributes = "";

			// Account_Name
			$banks_accounts->Account_Name->ViewValue = $banks_accounts->Account_Name->CurrentValue;
			$banks_accounts->Account_Name->CssStyle = "";
			$banks_accounts->Account_Name->CssClass = "";
			$banks_accounts->Account_Name->ViewCustomAttributes = "";

			// Account_Number
			$banks_accounts->Account_Number->ViewValue = $banks_accounts->Account_Number->CurrentValue;
			$banks_accounts->Account_Number->CssStyle = "";
			$banks_accounts->Account_Number->CssClass = "";
			$banks_accounts->Account_Number->ViewCustomAttributes = "";

			// Account_Type
			$banks_accounts->Account_Type->ViewValue = $banks_accounts->Account_Type->CurrentValue;
			$banks_accounts->Account_Type->CssStyle = "";
			$banks_accounts->Account_Type->CssClass = "";
			$banks_accounts->Account_Type->ViewCustomAttributes = "";

			// Remarks
			$banks_accounts->Remarks->ViewValue = $banks_accounts->Remarks->CurrentValue;
			$banks_accounts->Remarks->CssStyle = "";
			$banks_accounts->Remarks->CssClass = "";
			$banks_accounts->Remarks->ViewCustomAttributes = "";

			// Company
			if (strval($banks_accounts->Company->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($banks_accounts->Company->CurrentValue) . "";
			$sSqlWrk = "SELECT `Company_Name` FROM `company`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Company_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banks_accounts->Company->ViewValue = $rswrk->fields('Company_Name');
					$rswrk->Close();
				} else {
					$banks_accounts->Company->ViewValue = $banks_accounts->Company->CurrentValue;
				}
			} else {
				$banks_accounts->Company->ViewValue = NULL;
			}
			$banks_accounts->Company->CssStyle = "";
			$banks_accounts->Company->CssClass = "";
			$banks_accounts->Company->ViewCustomAttributes = "";

			// id
			$banks_accounts->id->HrefValue = "";
			$banks_accounts->id->TooltipValue = "";

			// Bank_Name
			$banks_accounts->Bank_Name->HrefValue = "";
			$banks_accounts->Bank_Name->TooltipValue = "";

			// Branch
			$banks_accounts->Branch->HrefValue = "";
			$banks_accounts->Branch->TooltipValue = "";

			// Address
			$banks_accounts->Address->HrefValue = "";
			$banks_accounts->Address->TooltipValue = "";

			// Account_Name
			$banks_accounts->Account_Name->HrefValue = "";
			$banks_accounts->Account_Name->TooltipValue = "";

			// Account_Number
			$banks_accounts->Account_Number->HrefValue = "";
			$banks_accounts->Account_Number->TooltipValue = "";

			// Account_Type
			$banks_accounts->Account_Type->HrefValue = "";
			$banks_accounts->Account_Type->TooltipValue = "";

			// Remarks
			$banks_accounts->Remarks->HrefValue = "";
			$banks_accounts->Remarks->TooltipValue = "";

			// Company
			$banks_accounts->Company->HrefValue = "";
			$banks_accounts->Company->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($banks_accounts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banks_accounts->Row_Rendered();
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
