<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "clientsinfo.php" ?>
<?php include "bookingsinfo.php" ?>
<?php include "ratesinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "invoicesinfo.php" ?>
<?php include "account_paymentsinfo.php" ?>
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
$clients_view = new cclients_view();
$Page =& $clients_view;

// Page init
$clients_view->Page_Init();

// Page main
$clients_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($clients->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var clients_view = new ew_Page("clients_view");

// page properties
clients_view.PageID = "view"; // page ID
clients_view.FormID = "fclientsview"; // form ID
var EW_PAGE_ID = clients_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
clients_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
clients_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
clients_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
clients_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $clients->TableCaption() ?>
<br><br>
<?php if ($clients->Export == "") { ?>
<a href="<?php echo $clients_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $clients_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $clients_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $clients_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('bookings')) { ?>
<a href="bookingslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=clients&id=<?php echo urlencode(strval($clients->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("bookings", "TblCaption") ?>
<?php echo str_replace("%c", $clients_view->lbookings_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('invoices')) { ?>
<a href="invoiceslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=clients&id=<?php echo urlencode(strval($clients->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("invoices", "TblCaption") ?>
<?php echo str_replace("%c", $clients_view->linvoices_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('rates')) { ?>
<a href="rateslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=clients&id=<?php echo urlencode(strval($clients->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("rates", "TblCaption") ?>
<?php echo str_replace("%c", $clients_view->lrates_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('account_payments')) { ?>
<a href="account_paymentslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=clients&id=<?php echo urlencode(strval($clients->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("account_payments", "TblCaption") ?>
<?php echo str_replace("%c", $clients_view->laccount_payments_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$clients_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($clients->id->Visible) { // id ?>
	<tr<?php echo $clients->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->id->FldCaption() ?></td>
		<td<?php echo $clients->id->CellAttributes() ?>>
<div<?php echo $clients->id->ViewAttributes() ?>><?php echo $clients->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->Account_No->Visible) { // Account_No ?>
	<tr<?php echo $clients->Account_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Account_No->FldCaption() ?></td>
		<td<?php echo $clients->Account_No->CellAttributes() ?>>
<div<?php echo $clients->Account_No->ViewAttributes() ?>><?php echo $clients->Account_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->Alias->Visible) { // Alias ?>
	<tr<?php echo $clients->Alias->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Alias->FldCaption() ?></td>
		<td<?php echo $clients->Alias->CellAttributes() ?>>
<div<?php echo $clients->Alias->ViewAttributes() ?>><?php echo $clients->Alias->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->Client_Name->Visible) { // Client_Name ?>
	<tr<?php echo $clients->Client_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Client_Name->FldCaption() ?></td>
		<td<?php echo $clients->Client_Name->CellAttributes() ?>>
<div<?php echo $clients->Client_Name->ViewAttributes() ?>><?php echo $clients->Client_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->Address->Visible) { // Address ?>
	<tr<?php echo $clients->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Address->FldCaption() ?></td>
		<td<?php echo $clients->Address->CellAttributes() ?>>
<div<?php echo $clients->Address->ViewAttributes() ?>><?php echo $clients->Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $clients->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Contact_No->FldCaption() ?></td>
		<td<?php echo $clients->Contact_No->CellAttributes() ?>>
<div<?php echo $clients->Contact_No->ViewAttributes() ?>><?php echo $clients->Contact_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->Email_Address->Visible) { // Email_Address ?>
	<tr<?php echo $clients->Email_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Email_Address->FldCaption() ?></td>
		<td<?php echo $clients->Email_Address->CellAttributes() ?>>
<div<?php echo $clients->Email_Address->ViewAttributes() ?>><?php echo $clients->Email_Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->TIN_No->Visible) { // TIN_No ?>
	<tr<?php echo $clients->TIN_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->TIN_No->FldCaption() ?></td>
		<td<?php echo $clients->TIN_No->CellAttributes() ?>>
<div<?php echo $clients->TIN_No->ViewAttributes() ?>><?php echo $clients->TIN_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->Contact_Person->Visible) { // Contact_Person ?>
	<tr<?php echo $clients->Contact_Person->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Contact_Person->FldCaption() ?></td>
		<td<?php echo $clients->Contact_Person->CellAttributes() ?>>
<div<?php echo $clients->Contact_Person->ViewAttributes() ?>><?php echo $clients->Contact_Person->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $clients->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->File_Upload->FldCaption() ?></td>
		<td<?php echo $clients->File_Upload->CellAttributes() ?>>
<?php if ($clients->File_Upload->HrefValue <> "" || $clients->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($clients->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $clients->File_Upload->HrefValue ?>"><?php echo $clients->File_Upload->ViewValue ?></a>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($clients->File_Upload->Upload->DbValue)) { ?>
<?php echo $clients->File_Upload->ViewValue ?>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($clients->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $clients->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Remarks->FldCaption() ?></td>
		<td<?php echo $clients->Remarks->CellAttributes() ?>>
<div<?php echo $clients->Remarks->ViewAttributes() ?>><?php echo $clients->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($clients->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$clients_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cclients_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'clients';

	// Page object name
	var $PageObjName = 'clients_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $clients;
		if ($clients->UseTokenInUrl) $PageUrl .= "t=" . $clients->TableVar . "&"; // Add page token
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
		global $objForm, $clients;
		if ($clients->UseTokenInUrl) {
			if ($objForm)
				return ($clients->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($clients->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclients_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (clients)
		$GLOBALS["clients"] = new cclients();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (rates)
		$GLOBALS['rates'] = new crates();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoices)
		$GLOBALS['invoices'] = new cinvoices();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'clients', TRUE);

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
		global $clients;

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
			$this->Page_Terminate("clientslist.php");
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
	var $lbookings_Count;
	var $linvoices_Count;
	var $lrates_Count;
	var $laccount_payments_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $clients;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$clients->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $clients->id->QueryStringValue;
			} else {
				$sReturnUrl = "clientslist.php"; // Return to list
			}

			// Get action
			$clients->CurrentAction = "I"; // Display form
			switch ($clients->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "clientslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "clientslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$clients->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $clients;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$clients->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$clients->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $clients->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$clients->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$clients->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$clients->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();

		// Call Row Selecting event
		$clients->Row_Selecting($sFilter);

		// Load SQL based on filter
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$clients->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $clients;
		$clients->id->setDbValue($rs->fields('id'));
		$clients->Account_No->setDbValue($rs->fields('Account_No'));
		$clients->Alias->setDbValue($rs->fields('Alias'));
		$clients->Client_Name->setDbValue($rs->fields('Client_Name'));
		$clients->Address->setDbValue($rs->fields('Address'));
		$clients->Contact_No->setDbValue($rs->fields('Contact_No'));
		$clients->Email_Address->setDbValue($rs->fields('Email_Address'));
		$clients->TIN_No->setDbValue($rs->fields('TIN_No'));
		$clients->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$clients->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$clients->Remarks->setDbValue($rs->fields('Remarks'));
		$sDetailFilter = $GLOBALS["bookings"]->SqlDetailFilter_clients();
		$sDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($clients->id->DbValue), $sDetailFilter);
		$this->lbookings_Count = $GLOBALS["bookings"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["invoices"]->SqlDetailFilter_clients();
		$sDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($clients->id->DbValue), $sDetailFilter);
		$this->linvoices_Count = $GLOBALS["invoices"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["rates"]->SqlDetailFilter_clients();
		$sDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($clients->id->DbValue), $sDetailFilter);
		$this->lrates_Count = $GLOBALS["rates"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["account_payments"]->SqlDetailFilter_clients();
		$sDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($clients->id->DbValue), $sDetailFilter);
		$this->laccount_payments_Count = $GLOBALS["account_payments"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $clients;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($clients->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($clients->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($clients->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($clients->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($clients->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($clients->id->CurrentValue);
		$this->AddUrl = $clients->AddUrl();
		$this->EditUrl = $clients->EditUrl();
		$this->CopyUrl = $clients->CopyUrl();
		$this->DeleteUrl = $clients->DeleteUrl();
		$this->ListUrl = $clients->ListUrl();

		// Call Row_Rendering event
		$clients->Row_Rendering();

		// Common render codes for all row types
		// id

		$clients->id->CellCssStyle = ""; $clients->id->CellCssClass = "";
		$clients->id->CellAttrs = array(); $clients->id->ViewAttrs = array(); $clients->id->EditAttrs = array();

		// Account_No
		$clients->Account_No->CellCssStyle = ""; $clients->Account_No->CellCssClass = "";
		$clients->Account_No->CellAttrs = array(); $clients->Account_No->ViewAttrs = array(); $clients->Account_No->EditAttrs = array();

		// Alias
		$clients->Alias->CellCssStyle = ""; $clients->Alias->CellCssClass = "";
		$clients->Alias->CellAttrs = array(); $clients->Alias->ViewAttrs = array(); $clients->Alias->EditAttrs = array();

		// Client_Name
		$clients->Client_Name->CellCssStyle = ""; $clients->Client_Name->CellCssClass = "";
		$clients->Client_Name->CellAttrs = array(); $clients->Client_Name->ViewAttrs = array(); $clients->Client_Name->EditAttrs = array();

		// Address
		$clients->Address->CellCssStyle = ""; $clients->Address->CellCssClass = "";
		$clients->Address->CellAttrs = array(); $clients->Address->ViewAttrs = array(); $clients->Address->EditAttrs = array();

		// Contact_No
		$clients->Contact_No->CellCssStyle = ""; $clients->Contact_No->CellCssClass = "";
		$clients->Contact_No->CellAttrs = array(); $clients->Contact_No->ViewAttrs = array(); $clients->Contact_No->EditAttrs = array();

		// Email_Address
		$clients->Email_Address->CellCssStyle = ""; $clients->Email_Address->CellCssClass = "";
		$clients->Email_Address->CellAttrs = array(); $clients->Email_Address->ViewAttrs = array(); $clients->Email_Address->EditAttrs = array();

		// TIN_No
		$clients->TIN_No->CellCssStyle = ""; $clients->TIN_No->CellCssClass = "";
		$clients->TIN_No->CellAttrs = array(); $clients->TIN_No->ViewAttrs = array(); $clients->TIN_No->EditAttrs = array();

		// Contact_Person
		$clients->Contact_Person->CellCssStyle = ""; $clients->Contact_Person->CellCssClass = "";
		$clients->Contact_Person->CellAttrs = array(); $clients->Contact_Person->ViewAttrs = array(); $clients->Contact_Person->EditAttrs = array();

		// File_Upload
		$clients->File_Upload->CellCssStyle = ""; $clients->File_Upload->CellCssClass = "";
		$clients->File_Upload->CellAttrs = array(); $clients->File_Upload->ViewAttrs = array(); $clients->File_Upload->EditAttrs = array();

		// Remarks
		$clients->Remarks->CellCssStyle = ""; $clients->Remarks->CellCssClass = "";
		$clients->Remarks->CellAttrs = array(); $clients->Remarks->ViewAttrs = array(); $clients->Remarks->EditAttrs = array();
		if ($clients->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$clients->id->ViewValue = $clients->id->CurrentValue;
			$clients->id->CssStyle = "";
			$clients->id->CssClass = "";
			$clients->id->ViewCustomAttributes = "";

			// Account_No
			$clients->Account_No->ViewValue = $clients->Account_No->CurrentValue;
			$clients->Account_No->CssStyle = "";
			$clients->Account_No->CssClass = "";
			$clients->Account_No->ViewCustomAttributes = "";

			// Alias
			$clients->Alias->ViewValue = $clients->Alias->CurrentValue;
			$clients->Alias->CssStyle = "";
			$clients->Alias->CssClass = "";
			$clients->Alias->ViewCustomAttributes = "";

			// Client_Name
			$clients->Client_Name->ViewValue = $clients->Client_Name->CurrentValue;
			$clients->Client_Name->CssStyle = "";
			$clients->Client_Name->CssClass = "";
			$clients->Client_Name->ViewCustomAttributes = "";

			// Address
			$clients->Address->ViewValue = $clients->Address->CurrentValue;
			$clients->Address->CssStyle = "";
			$clients->Address->CssClass = "";
			$clients->Address->ViewCustomAttributes = "";

			// Contact_No
			$clients->Contact_No->ViewValue = $clients->Contact_No->CurrentValue;
			$clients->Contact_No->CssStyle = "";
			$clients->Contact_No->CssClass = "";
			$clients->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$clients->Email_Address->ViewValue = $clients->Email_Address->CurrentValue;
			$clients->Email_Address->CssStyle = "";
			$clients->Email_Address->CssClass = "";
			$clients->Email_Address->ViewCustomAttributes = "";

			// TIN_No
			$clients->TIN_No->ViewValue = $clients->TIN_No->CurrentValue;
			$clients->TIN_No->CssStyle = "";
			$clients->TIN_No->CssClass = "";
			$clients->TIN_No->ViewCustomAttributes = "";

			// Contact_Person
			$clients->Contact_Person->ViewValue = $clients->Contact_Person->CurrentValue;
			$clients->Contact_Person->CssStyle = "";
			$clients->Contact_Person->CssClass = "";
			$clients->Contact_Person->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->ViewValue = $clients->File_Upload->Upload->DbValue;
			} else {
				$clients->File_Upload->ViewValue = "";
			}
			$clients->File_Upload->CssStyle = "";
			$clients->File_Upload->CssClass = "";
			$clients->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$clients->Remarks->ViewValue = $clients->Remarks->CurrentValue;
			$clients->Remarks->CssStyle = "";
			$clients->Remarks->CssClass = "";
			$clients->Remarks->ViewCustomAttributes = "";

			// id
			$clients->id->HrefValue = "";
			$clients->id->TooltipValue = "";

			// Account_No
			$clients->Account_No->HrefValue = "";
			$clients->Account_No->TooltipValue = "";

			// Alias
			$clients->Alias->HrefValue = "";
			$clients->Alias->TooltipValue = "";

			// Client_Name
			$clients->Client_Name->HrefValue = "";
			$clients->Client_Name->TooltipValue = "";

			// Address
			$clients->Address->HrefValue = "";
			$clients->Address->TooltipValue = "";

			// Contact_No
			$clients->Contact_No->HrefValue = "";
			$clients->Contact_No->TooltipValue = "";

			// Email_Address
			$clients->Email_Address->HrefValue = "";
			$clients->Email_Address->TooltipValue = "";

			// TIN_No
			$clients->TIN_No->HrefValue = "";
			$clients->TIN_No->TooltipValue = "";

			// Contact_Person
			$clients->Contact_Person->HrefValue = "";
			$clients->Contact_Person->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $clients->File_Upload->UploadPath) . ((!empty($clients->File_Upload->ViewValue)) ? $clients->File_Upload->ViewValue : $clients->File_Upload->CurrentValue);
				if ($clients->Export <> "") $clients->File_Upload->HrefValue = ew_ConvertFullUrl($clients->File_Upload->HrefValue);
			} else {
				$clients->File_Upload->HrefValue = "";
			}
			$clients->File_Upload->TooltipValue = "";

			// Remarks
			$clients->Remarks->HrefValue = "";
			$clients->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($clients->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$clients->Row_Rendered();
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
