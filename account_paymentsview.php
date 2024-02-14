<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "account_paymentsinfo.php" ?>
<?php include "clientsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "customer_invoicesinfo.php" ?>
<?php include "journal_accountsinfo.php" ?>
<?php include "all_file_uploadsinfo.php" ?>
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
$account_payments_view = new caccount_payments_view();
$Page =& $account_payments_view;

// Page init
$account_payments_view->Page_Init();

// Page main
$account_payments_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($account_payments->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var account_payments_view = new ew_Page("account_payments_view");

// page properties
account_payments_view.PageID = "view"; // page ID
account_payments_view.FormID = "faccount_paymentsview"; // form ID
var EW_PAGE_ID = account_payments_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
account_payments_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
account_payments_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
account_payments_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
account_payments_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $account_payments->TableCaption() ?>
<br><br>
<?php if ($account_payments->Export == "") { ?>
<a href="<?php echo $account_payments_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $account_payments_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $account_payments_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $account_payments_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->AllowList('journal_accounts')) { ?>
<a href="journal_accountslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=account_payments&Journal_Account_ID=<?php echo urlencode(strval($account_payments->Journal_Account_ID->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("journal_accounts", "TblCaption") ?>
<?php echo str_replace("%c", $account_payments_view->ljournal_accounts_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('customer_invoices')) { ?>
<a href="customer_invoiceslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=account_payments&id=<?php echo urlencode(strval($account_payments->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("customer_invoices", "TblCaption") ?>
<?php echo str_replace("%c", $account_payments_view->lcustomer_invoices_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php if ($Security->AllowList('all_file_uploads')) { ?>
<a href="all_file_uploadslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=account_payments&id=<?php echo urlencode(strval($account_payments->id->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("all_file_uploads", "TblCaption") ?>
<?php echo str_replace("%c", $account_payments_view->lall_file_uploads_Count, $Language->Phrase("DetailCount")) ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payments_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($account_payments->id->Visible) { // id ?>
	<tr<?php echo $account_payments->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->id->FldCaption() ?></td>
		<td<?php echo $account_payments->id->CellAttributes() ?>>
<div<?php echo $account_payments->id->ViewAttributes() ?>><?php echo $account_payments->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Date->Visible) { // Date ?>
	<tr<?php echo $account_payments->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Date->FldCaption() ?></td>
		<td<?php echo $account_payments->Date->CellAttributes() ?>>
<div<?php echo $account_payments->Date->ViewAttributes() ?>><?php echo $account_payments->Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Payment_Reference->Visible) { // Payment_Reference ?>
	<tr<?php echo $account_payments->Payment_Reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Reference->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Reference->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Reference->ViewAttributes() ?>><?php echo $account_payments->Payment_Reference->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Payment_Date->Visible) { // Payment_Date ?>
	<tr<?php echo $account_payments->Payment_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Date->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Date->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Date->ViewAttributes() ?>><?php echo $account_payments->Payment_Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Payment_Type->Visible) { // Payment_Type ?>
	<tr<?php echo $account_payments->Payment_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Type->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Type->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Type->ViewAttributes() ?>><?php echo $account_payments->Payment_Type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Journal_Type_ID->Visible) { // Journal_Type_ID ?>
	<tr<?php echo $account_payments->Journal_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Journal_Type_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Journal_Type_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Journal_Type_ID->ViewAttributes() ?>><?php echo $account_payments->Journal_Type_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Journal_Account_ID->Visible) { // Journal_Account_ID ?>
	<tr<?php echo $account_payments->Journal_Account_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Journal_Account_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Journal_Account_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Journal_Account_ID->ViewAttributes() ?>><?php echo $account_payments->Journal_Account_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Payment_Method_ID->Visible) { // Payment_Method_ID ?>
	<tr<?php echo $account_payments->Payment_Method_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Method_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Method_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Method_ID->ViewAttributes() ?>><?php echo $account_payments->Payment_Method_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Vendor_ID->Visible) { // Vendor_ID ?>
	<tr<?php echo $account_payments->Vendor_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Vendor_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Vendor_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Vendor_ID->ViewAttributes() ?>><?php echo $account_payments->Vendor_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Client_ID->Visible) { // Client_ID ?>
	<tr<?php echo $account_payments->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Client_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Client_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Client_ID->ViewAttributes() ?>><?php echo $account_payments->Client_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Amount->Visible) { // Amount ?>
	<tr<?php echo $account_payments->Amount->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Amount->FldCaption() ?></td>
		<td<?php echo $account_payments->Amount->CellAttributes() ?>>
<div<?php echo $account_payments->Amount->ViewAttributes() ?>><?php echo $account_payments->Amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Status_ID->Visible) { // Status_ID ?>
	<tr<?php echo $account_payments->Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Status_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Status_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Status_ID->ViewAttributes() ?>><?php echo $account_payments->Status_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Description->Visible) { // Description ?>
	<tr<?php echo $account_payments->Description->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Description->FldCaption() ?></td>
		<td<?php echo $account_payments->Description->CellAttributes() ?>>
<div<?php echo $account_payments->Description->ViewAttributes() ?>><?php echo $account_payments->Description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $account_payments->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Remarks->FldCaption() ?></td>
		<td<?php echo $account_payments->Remarks->CellAttributes() ?>>
<div<?php echo $account_payments->Remarks->ViewAttributes() ?>><?php echo $account_payments->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->User_ID->Visible) { // User_ID ?>
	<tr<?php echo $account_payments->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->User_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->User_ID->CellAttributes() ?>>
<div<?php echo $account_payments->User_ID->ViewAttributes() ?>><?php echo $account_payments->User_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Created->Visible) { // Created ?>
	<tr<?php echo $account_payments->Created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Created->FldCaption() ?></td>
		<td<?php echo $account_payments->Created->CellAttributes() ?>>
<div<?php echo $account_payments->Created->ViewAttributes() ?>><?php echo $account_payments->Created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Modified->Visible) { // Modified ?>
	<tr<?php echo $account_payments->Modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Modified->FldCaption() ?></td>
		<td<?php echo $account_payments->Modified->CellAttributes() ?>>
<div<?php echo $account_payments->Modified->ViewAttributes() ?>><?php echo $account_payments->Modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payments->total_invoice_items->Visible) { // total_invoice_items ?>
	<tr<?php echo $account_payments->total_invoice_items->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->total_invoice_items->FldCaption() ?></td>
		<td<?php echo $account_payments->total_invoice_items->CellAttributes() ?>>
<div<?php echo $account_payments->total_invoice_items->ViewAttributes() ?>><?php echo $account_payments->total_invoice_items->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($account_payments->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$account_payments_view->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payments_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'account_payments';

	// Page object name
	var $PageObjName = 'account_payments_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $account_payments;
		if ($account_payments->UseTokenInUrl) $PageUrl .= "t=" . $account_payments->TableVar . "&"; // Add page token
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
		global $objForm, $account_payments;
		if ($account_payments->UseTokenInUrl) {
			if ($objForm)
				return ($account_payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($account_payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caccount_payments_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (account_payments)
		$GLOBALS["account_payments"] = new caccount_payments();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (customer_invoices)
		$GLOBALS['customer_invoices'] = new ccustomer_invoices();

		// Table object (journal_accounts)
		$GLOBALS['journal_accounts'] = new cjournal_accounts();

		// Table object (all_file_uploads)
		$GLOBALS['all_file_uploads'] = new call_file_uploads();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'account_payments', TRUE);

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
		global $account_payments;

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
			$this->Page_Terminate("account_paymentslist.php");
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
	var $ljournal_accounts_Count;
	var $lcustomer_invoices_Count;
	var $lall_file_uploads_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $account_payments;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$account_payments->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $account_payments->id->QueryStringValue;
			} else {
				$sReturnUrl = "account_paymentslist.php"; // Return to list
			}

			// Get action
			$account_payments->CurrentAction = "I"; // Display form
			switch ($account_payments->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "account_paymentslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "account_paymentslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$account_payments->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $account_payments;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$account_payments->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$account_payments->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $account_payments->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$account_payments->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$account_payments->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$account_payments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $account_payments;
		$sFilter = $account_payments->KeyFilter();

		// Call Row Selecting event
		$account_payments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$account_payments->CurrentFilter = $sFilter;
		$sSql = $account_payments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$account_payments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $account_payments;
		$account_payments->id->setDbValue($rs->fields('id'));
		$account_payments->Date->setDbValue($rs->fields('Date'));
		$account_payments->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$account_payments->Payment_Date->setDbValue($rs->fields('Payment_Date'));
		$account_payments->Payment_Type->setDbValue($rs->fields('Payment_Type'));
		$account_payments->Journal_Type_ID->setDbValue($rs->fields('Journal_Type_ID'));
		$account_payments->Journal_Account_ID->setDbValue($rs->fields('Journal_Account_ID'));
		$account_payments->Payment_Method_ID->setDbValue($rs->fields('Payment_Method_ID'));
		$account_payments->Vendor_ID->setDbValue($rs->fields('Vendor_ID'));
		$account_payments->Client_ID->setDbValue($rs->fields('Client_ID'));
		$account_payments->Amount->setDbValue($rs->fields('Amount'));
		$account_payments->Status_ID->setDbValue($rs->fields('Status_ID'));
		$account_payments->Description->setDbValue($rs->fields('Description'));
		$account_payments->Remarks->setDbValue($rs->fields('Remarks'));
		$account_payments->User_ID->setDbValue($rs->fields('User_ID'));
		$account_payments->Created->setDbValue($rs->fields('Created'));
		$account_payments->Modified->setDbValue($rs->fields('Modified'));
		$account_payments->total_invoice_items->setDbValue($rs->fields('total_invoice_items'));
		$sDetailFilter = $GLOBALS["journal_accounts"]->SqlDetailFilter_account_payments();
		$sDetailFilter = str_replace("@id@", ew_AdjustSql($account_payments->Journal_Account_ID->DbValue), $sDetailFilter);
		$this->ljournal_accounts_Count = $GLOBALS["journal_accounts"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["customer_invoices"]->SqlDetailFilter_account_payments();
		$sDetailFilter = str_replace("@Payment_ID@", ew_AdjustSql($account_payments->id->DbValue), $sDetailFilter);
		$this->lcustomer_invoices_Count = $GLOBALS["customer_invoices"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["all_file_uploads"]->SqlDetailFilter_account_payments();
		$sDetailFilter = str_replace("@file_id@", ew_AdjustSql($account_payments->id->DbValue), $sDetailFilter);
		$this->lall_file_uploads_Count = $GLOBALS["all_file_uploads"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $account_payments;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($account_payments->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($account_payments->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($account_payments->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($account_payments->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($account_payments->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($account_payments->id->CurrentValue);
		$this->AddUrl = $account_payments->AddUrl();
		$this->EditUrl = $account_payments->EditUrl();
		$this->CopyUrl = $account_payments->CopyUrl();
		$this->DeleteUrl = $account_payments->DeleteUrl();
		$this->ListUrl = $account_payments->ListUrl();

		// Call Row_Rendering event
		$account_payments->Row_Rendering();

		// Common render codes for all row types
		// id

		$account_payments->id->CellCssStyle = ""; $account_payments->id->CellCssClass = "";
		$account_payments->id->CellAttrs = array(); $account_payments->id->ViewAttrs = array(); $account_payments->id->EditAttrs = array();

		// Date
		$account_payments->Date->CellCssStyle = ""; $account_payments->Date->CellCssClass = "";
		$account_payments->Date->CellAttrs = array(); $account_payments->Date->ViewAttrs = array(); $account_payments->Date->EditAttrs = array();

		// Payment_Reference
		$account_payments->Payment_Reference->CellCssStyle = ""; $account_payments->Payment_Reference->CellCssClass = "";
		$account_payments->Payment_Reference->CellAttrs = array(); $account_payments->Payment_Reference->ViewAttrs = array(); $account_payments->Payment_Reference->EditAttrs = array();

		// Payment_Date
		$account_payments->Payment_Date->CellCssStyle = ""; $account_payments->Payment_Date->CellCssClass = "";
		$account_payments->Payment_Date->CellAttrs = array(); $account_payments->Payment_Date->ViewAttrs = array(); $account_payments->Payment_Date->EditAttrs = array();

		// Payment_Type
		$account_payments->Payment_Type->CellCssStyle = ""; $account_payments->Payment_Type->CellCssClass = "";
		$account_payments->Payment_Type->CellAttrs = array(); $account_payments->Payment_Type->ViewAttrs = array(); $account_payments->Payment_Type->EditAttrs = array();

		// Journal_Type_ID
		$account_payments->Journal_Type_ID->CellCssStyle = ""; $account_payments->Journal_Type_ID->CellCssClass = "";
		$account_payments->Journal_Type_ID->CellAttrs = array(); $account_payments->Journal_Type_ID->ViewAttrs = array(); $account_payments->Journal_Type_ID->EditAttrs = array();

		// Journal_Account_ID
		$account_payments->Journal_Account_ID->CellCssStyle = ""; $account_payments->Journal_Account_ID->CellCssClass = "";
		$account_payments->Journal_Account_ID->CellAttrs = array(); $account_payments->Journal_Account_ID->ViewAttrs = array(); $account_payments->Journal_Account_ID->EditAttrs = array();

		// Payment_Method_ID
		$account_payments->Payment_Method_ID->CellCssStyle = ""; $account_payments->Payment_Method_ID->CellCssClass = "";
		$account_payments->Payment_Method_ID->CellAttrs = array(); $account_payments->Payment_Method_ID->ViewAttrs = array(); $account_payments->Payment_Method_ID->EditAttrs = array();

		// Vendor_ID
		$account_payments->Vendor_ID->CellCssStyle = ""; $account_payments->Vendor_ID->CellCssClass = "";
		$account_payments->Vendor_ID->CellAttrs = array(); $account_payments->Vendor_ID->ViewAttrs = array(); $account_payments->Vendor_ID->EditAttrs = array();

		// Client_ID
		$account_payments->Client_ID->CellCssStyle = ""; $account_payments->Client_ID->CellCssClass = "";
		$account_payments->Client_ID->CellAttrs = array(); $account_payments->Client_ID->ViewAttrs = array(); $account_payments->Client_ID->EditAttrs = array();

		// Amount
		$account_payments->Amount->CellCssStyle = ""; $account_payments->Amount->CellCssClass = "";
		$account_payments->Amount->CellAttrs = array(); $account_payments->Amount->ViewAttrs = array(); $account_payments->Amount->EditAttrs = array();

		// Status_ID
		$account_payments->Status_ID->CellCssStyle = ""; $account_payments->Status_ID->CellCssClass = "";
		$account_payments->Status_ID->CellAttrs = array(); $account_payments->Status_ID->ViewAttrs = array(); $account_payments->Status_ID->EditAttrs = array();

		// Description
		$account_payments->Description->CellCssStyle = ""; $account_payments->Description->CellCssClass = "";
		$account_payments->Description->CellAttrs = array(); $account_payments->Description->ViewAttrs = array(); $account_payments->Description->EditAttrs = array();

		// Remarks
		$account_payments->Remarks->CellCssStyle = ""; $account_payments->Remarks->CellCssClass = "";
		$account_payments->Remarks->CellAttrs = array(); $account_payments->Remarks->ViewAttrs = array(); $account_payments->Remarks->EditAttrs = array();

		// User_ID
		$account_payments->User_ID->CellCssStyle = ""; $account_payments->User_ID->CellCssClass = "";
		$account_payments->User_ID->CellAttrs = array(); $account_payments->User_ID->ViewAttrs = array(); $account_payments->User_ID->EditAttrs = array();

		// Created
		$account_payments->Created->CellCssStyle = ""; $account_payments->Created->CellCssClass = "";
		$account_payments->Created->CellAttrs = array(); $account_payments->Created->ViewAttrs = array(); $account_payments->Created->EditAttrs = array();

		// Modified
		$account_payments->Modified->CellCssStyle = ""; $account_payments->Modified->CellCssClass = "";
		$account_payments->Modified->CellAttrs = array(); $account_payments->Modified->ViewAttrs = array(); $account_payments->Modified->EditAttrs = array();

		// total_invoice_items
		$account_payments->total_invoice_items->CellCssStyle = ""; $account_payments->total_invoice_items->CellCssClass = "";
		$account_payments->total_invoice_items->CellAttrs = array(); $account_payments->total_invoice_items->ViewAttrs = array(); $account_payments->total_invoice_items->EditAttrs = array();
		if ($account_payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$account_payments->id->ViewValue = $account_payments->id->CurrentValue;
			$account_payments->id->CssStyle = "";
			$account_payments->id->CssClass = "";
			$account_payments->id->ViewCustomAttributes = "";

			// Date
			$account_payments->Date->ViewValue = $account_payments->Date->CurrentValue;
			$account_payments->Date->ViewValue = ew_FormatDateTime($account_payments->Date->ViewValue, 6);
			$account_payments->Date->CssStyle = "";
			$account_payments->Date->CssClass = "";
			$account_payments->Date->ViewCustomAttributes = "";

			// Payment_Reference
			$account_payments->Payment_Reference->ViewValue = $account_payments->Payment_Reference->CurrentValue;
			$account_payments->Payment_Reference->CssStyle = "";
			$account_payments->Payment_Reference->CssClass = "";
			$account_payments->Payment_Reference->ViewCustomAttributes = "";

			// Payment_Date
			$account_payments->Payment_Date->ViewValue = $account_payments->Payment_Date->CurrentValue;
			$account_payments->Payment_Date->ViewValue = ew_FormatDateTime($account_payments->Payment_Date->ViewValue, 6);
			$account_payments->Payment_Date->CssStyle = "";
			$account_payments->Payment_Date->CssClass = "";
			$account_payments->Payment_Date->ViewCustomAttributes = "";

			// Payment_Type
			if (strval($account_payments->Payment_Type->CurrentValue) <> "") {
				switch ($account_payments->Payment_Type->CurrentValue) {
					case "payment_send":
						$account_payments->Payment_Type->ViewValue = "Payment Send";
						break;
					case "payment_received":
						$account_payments->Payment_Type->ViewValue = "Payment Received";
						break;
					default:
						$account_payments->Payment_Type->ViewValue = $account_payments->Payment_Type->CurrentValue;
				}
			} else {
				$account_payments->Payment_Type->ViewValue = NULL;
			}
			$account_payments->Payment_Type->CssStyle = "";
			$account_payments->Payment_Type->CssClass = "";
			$account_payments->Payment_Type->ViewCustomAttributes = "";

			// Journal_Type_ID
			if (strval($account_payments->Journal_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Journal_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Journal_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Journal_Type_ID->ViewValue = $rswrk->fields('Journal_Name');
					$rswrk->Close();
				} else {
					$account_payments->Journal_Type_ID->ViewValue = $account_payments->Journal_Type_ID->CurrentValue;
				}
			} else {
				$account_payments->Journal_Type_ID->ViewValue = NULL;
			}
			$account_payments->Journal_Type_ID->CssStyle = "";
			$account_payments->Journal_Type_ID->CssClass = "";
			$account_payments->Journal_Type_ID->ViewCustomAttributes = "";

			// Journal_Account_ID
			if (strval($account_payments->Journal_Account_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Journal_Account_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Account_Reference_No` FROM `journal_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Business_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Journal_Account_ID->ViewValue = $rswrk->fields('Account_Reference_No');
					$rswrk->Close();
				} else {
					$account_payments->Journal_Account_ID->ViewValue = $account_payments->Journal_Account_ID->CurrentValue;
				}
			} else {
				$account_payments->Journal_Account_ID->ViewValue = NULL;
			}
			$account_payments->Journal_Account_ID->CssStyle = "";
			$account_payments->Journal_Account_ID->CssClass = "";
			$account_payments->Journal_Account_ID->ViewCustomAttributes = "";

			// Payment_Method_ID
			if (strval($account_payments->Payment_Method_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Payment_Method_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Payment_Method` FROM `account_payment_methods`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Payment_Method_ID->ViewValue = $rswrk->fields('Payment_Method');
					$rswrk->Close();
				} else {
					$account_payments->Payment_Method_ID->ViewValue = $account_payments->Payment_Method_ID->CurrentValue;
				}
			} else {
				$account_payments->Payment_Method_ID->ViewValue = NULL;
			}
			$account_payments->Payment_Method_ID->CssStyle = "";
			$account_payments->Payment_Method_ID->CssClass = "";
			$account_payments->Payment_Method_ID->ViewCustomAttributes = "";

			// Vendor_ID
			if (strval($account_payments->Vendor_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Vendor_ID->CurrentValue) . "";
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
					$account_payments->Vendor_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$account_payments->Vendor_ID->ViewValue = $account_payments->Vendor_ID->CurrentValue;
				}
			} else {
				$account_payments->Vendor_ID->ViewValue = NULL;
			}
			$account_payments->Vendor_ID->CssStyle = "";
			$account_payments->Vendor_ID->CssClass = "";
			$account_payments->Vendor_ID->ViewCustomAttributes = "";

			// Client_ID
			if (strval($account_payments->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$account_payments->Client_ID->ViewValue = $account_payments->Client_ID->CurrentValue;
				}
			} else {
				$account_payments->Client_ID->ViewValue = NULL;
			}
			$account_payments->Client_ID->CssStyle = "";
			$account_payments->Client_ID->CssClass = "";
			$account_payments->Client_ID->ViewCustomAttributes = "";

			// Amount
			$account_payments->Amount->ViewValue = $account_payments->Amount->CurrentValue;
			$account_payments->Amount->ViewValue = ew_FormatNumber($account_payments->Amount->ViewValue, 2, -2, -2, -2);
			$account_payments->Amount->CssStyle = "";
			$account_payments->Amount->CssClass = "";
			$account_payments->Amount->ViewCustomAttributes = "";

			// Status_ID
			if (strval($account_payments->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$account_payments->Status_ID->ViewValue = $account_payments->Status_ID->CurrentValue;
				}
			} else {
				$account_payments->Status_ID->ViewValue = NULL;
			}
			$account_payments->Status_ID->CssStyle = "";
			$account_payments->Status_ID->CssClass = "";
			$account_payments->Status_ID->ViewCustomAttributes = "";

			// Description
			$account_payments->Description->ViewValue = $account_payments->Description->CurrentValue;
			$account_payments->Description->CssStyle = "";
			$account_payments->Description->CssClass = "";
			$account_payments->Description->ViewCustomAttributes = "";

			// Remarks
			$account_payments->Remarks->ViewValue = $account_payments->Remarks->CurrentValue;
			$account_payments->Remarks->CssStyle = "";
			$account_payments->Remarks->CssClass = "";
			$account_payments->Remarks->ViewCustomAttributes = "";

			// User_ID
			$account_payments->User_ID->ViewValue = $account_payments->User_ID->CurrentValue;
			$account_payments->User_ID->CssStyle = "";
			$account_payments->User_ID->CssClass = "";
			$account_payments->User_ID->ViewCustomAttributes = "";

			// Created
			$account_payments->Created->ViewValue = $account_payments->Created->CurrentValue;
			$account_payments->Created->ViewValue = ew_FormatDateTime($account_payments->Created->ViewValue, 6);
			$account_payments->Created->CssStyle = "";
			$account_payments->Created->CssClass = "";
			$account_payments->Created->ViewCustomAttributes = "";

			// Modified
			$account_payments->Modified->ViewValue = $account_payments->Modified->CurrentValue;
			$account_payments->Modified->ViewValue = ew_FormatDateTime($account_payments->Modified->ViewValue, 6);
			$account_payments->Modified->CssStyle = "";
			$account_payments->Modified->CssClass = "";
			$account_payments->Modified->ViewCustomAttributes = "";

			// total_invoice_items
			$account_payments->total_invoice_items->ViewValue = $account_payments->total_invoice_items->CurrentValue;
			$account_payments->total_invoice_items->CssStyle = "";
			$account_payments->total_invoice_items->CssClass = "";
			$account_payments->total_invoice_items->ViewCustomAttributes = "";

			// id
			$account_payments->id->HrefValue = "";
			$account_payments->id->TooltipValue = "";

			// Date
			$account_payments->Date->HrefValue = "";
			$account_payments->Date->TooltipValue = "";

			// Payment_Reference
			$account_payments->Payment_Reference->HrefValue = "";
			$account_payments->Payment_Reference->TooltipValue = "";

			// Payment_Date
			$account_payments->Payment_Date->HrefValue = "";
			$account_payments->Payment_Date->TooltipValue = "";

			// Payment_Type
			$account_payments->Payment_Type->HrefValue = "";
			$account_payments->Payment_Type->TooltipValue = "";

			// Journal_Type_ID
			$account_payments->Journal_Type_ID->HrefValue = "";
			$account_payments->Journal_Type_ID->TooltipValue = "";

			// Journal_Account_ID
			$account_payments->Journal_Account_ID->HrefValue = "";
			$account_payments->Journal_Account_ID->TooltipValue = "";

			// Payment_Method_ID
			$account_payments->Payment_Method_ID->HrefValue = "";
			$account_payments->Payment_Method_ID->TooltipValue = "";

			// Vendor_ID
			$account_payments->Vendor_ID->HrefValue = "";
			$account_payments->Vendor_ID->TooltipValue = "";

			// Client_ID
			$account_payments->Client_ID->HrefValue = "";
			$account_payments->Client_ID->TooltipValue = "";

			// Amount
			$account_payments->Amount->HrefValue = "";
			$account_payments->Amount->TooltipValue = "";

			// Status_ID
			$account_payments->Status_ID->HrefValue = "";
			$account_payments->Status_ID->TooltipValue = "";

			// Description
			$account_payments->Description->HrefValue = "";
			$account_payments->Description->TooltipValue = "";

			// Remarks
			$account_payments->Remarks->HrefValue = "";
			$account_payments->Remarks->TooltipValue = "";

			// User_ID
			$account_payments->User_ID->HrefValue = "";
			$account_payments->User_ID->TooltipValue = "";

			// Created
			$account_payments->Created->HrefValue = "";
			$account_payments->Created->TooltipValue = "";

			// Modified
			$account_payments->Modified->HrefValue = "";
			$account_payments->Modified->TooltipValue = "";

			// total_invoice_items
			$account_payments->total_invoice_items->HrefValue = "";
			$account_payments->total_invoice_items->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($account_payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$account_payments->Row_Rendered();
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
