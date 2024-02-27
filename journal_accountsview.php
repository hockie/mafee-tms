<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "journal_accountsinfo.php" ?>
<?php include "usersinfo.php" ?>
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
$journal_accounts_view = new cjournal_accounts_view();
$Page =& $journal_accounts_view;

// Page init
$journal_accounts_view->Page_Init();

// Page main
$journal_accounts_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($journal_accounts->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var journal_accounts_view = new ew_Page("journal_accounts_view");

// page properties
journal_accounts_view.PageID = "view"; // page ID
journal_accounts_view.FormID = "fjournal_accountsview"; // form ID
var EW_PAGE_ID = journal_accounts_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
journal_accounts_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
journal_accounts_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
journal_accounts_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
journal_accounts_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $journal_accounts->TableCaption() ?>
<br><br>
<?php if ($journal_accounts->Export == "") { ?>
<a href="<?php echo $journal_accounts_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $journal_accounts_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $journal_accounts_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $journal_accounts_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$journal_accounts_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($journal_accounts->id->Visible) { // id ?>
	<tr<?php echo $journal_accounts->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->id->FldCaption() ?></td>
		<td<?php echo $journal_accounts->id->CellAttributes() ?>>
<div<?php echo $journal_accounts->id->ViewAttributes() ?>><?php echo $journal_accounts->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->journal_type_id->Visible) { // journal_type_id ?>
	<tr<?php echo $journal_accounts->journal_type_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->journal_type_id->FldCaption() ?></td>
		<td<?php echo $journal_accounts->journal_type_id->CellAttributes() ?>>
<div<?php echo $journal_accounts->journal_type_id->ViewAttributes() ?>><?php echo $journal_accounts->journal_type_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Account_Name->Visible) { // Account_Name ?>
	<tr<?php echo $journal_accounts->Account_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Account_Name->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Account_Name->CellAttributes() ?>>
<div<?php echo $journal_accounts->Account_Name->ViewAttributes() ?>><?php echo $journal_accounts->Account_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Account_Reference_No->Visible) { // Account_Reference_No ?>
	<tr<?php echo $journal_accounts->Account_Reference_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Account_Reference_No->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Account_Reference_No->CellAttributes() ?>>
<div<?php echo $journal_accounts->Account_Reference_No->ViewAttributes() ?>><?php echo $journal_accounts->Account_Reference_No->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Business_Name->Visible) { // Business_Name ?>
	<tr<?php echo $journal_accounts->Business_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Business_Name->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Business_Name->CellAttributes() ?>>
<div<?php echo $journal_accounts->Business_Name->ViewAttributes() ?>><?php echo $journal_accounts->Business_Name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Address->Visible) { // Address ?>
	<tr<?php echo $journal_accounts->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Address->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Address->CellAttributes() ?>>
<div<?php echo $journal_accounts->Address->ViewAttributes() ?>><?php echo $journal_accounts->Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $journal_accounts->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Remarks->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Remarks->CellAttributes() ?>>
<div<?php echo $journal_accounts->Remarks->ViewAttributes() ?>><?php echo $journal_accounts->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->created->Visible) { // created ?>
	<tr<?php echo $journal_accounts->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->created->FldCaption() ?></td>
		<td<?php echo $journal_accounts->created->CellAttributes() ?>>
<div<?php echo $journal_accounts->created->ViewAttributes() ?>><?php echo $journal_accounts->created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->modified->Visible) { // modified ?>
	<tr<?php echo $journal_accounts->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->modified->FldCaption() ?></td>
		<td<?php echo $journal_accounts->modified->CellAttributes() ?>>
<div<?php echo $journal_accounts->modified->ViewAttributes() ?>><?php echo $journal_accounts->modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->User_ID->Visible) { // User_ID ?>
	<tr<?php echo $journal_accounts->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->User_ID->FldCaption() ?></td>
		<td<?php echo $journal_accounts->User_ID->CellAttributes() ?>>
<div<?php echo $journal_accounts->User_ID->ViewAttributes() ?>><?php echo $journal_accounts->User_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($journal_accounts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$journal_accounts_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cjournal_accounts_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'journal_accounts';

	// Page object name
	var $PageObjName = 'journal_accounts_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $journal_accounts;
		if ($journal_accounts->UseTokenInUrl) $PageUrl .= "t=" . $journal_accounts->TableVar . "&"; // Add page token
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
		global $objForm, $journal_accounts;
		if ($journal_accounts->UseTokenInUrl) {
			if ($objForm)
				return ($journal_accounts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($journal_accounts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cjournal_accounts_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (journal_accounts)
		$GLOBALS["journal_accounts"] = new cjournal_accounts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'journal_accounts', TRUE);

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
		global $journal_accounts;

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
			$this->Page_Terminate("journal_accountslist.php");
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
		global $Language, $journal_accounts;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$journal_accounts->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $journal_accounts->id->QueryStringValue;
			} else {
				$sReturnUrl = "journal_accountslist.php"; // Return to list
			}

			// Get action
			$journal_accounts->CurrentAction = "I"; // Display form
			switch ($journal_accounts->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "journal_accountslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "journal_accountslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$journal_accounts->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $journal_accounts;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$journal_accounts->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$journal_accounts->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $journal_accounts->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$journal_accounts->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$journal_accounts->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$journal_accounts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $journal_accounts;
		$sFilter = $journal_accounts->KeyFilter();

		// Call Row Selecting event
		$journal_accounts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$journal_accounts->CurrentFilter = $sFilter;
		$sSql = $journal_accounts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$journal_accounts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $journal_accounts;
		$journal_accounts->id->setDbValue($rs->fields('id'));
		$journal_accounts->journal_type_id->setDbValue($rs->fields('journal_type_id'));
		$journal_accounts->Account_Name->setDbValue($rs->fields('Account_Name'));
		$journal_accounts->Account_Reference_No->setDbValue($rs->fields('Account_Reference_No'));
		$journal_accounts->Business_Name->setDbValue($rs->fields('Business_Name'));
		$journal_accounts->Address->setDbValue($rs->fields('Address'));
		$journal_accounts->Remarks->setDbValue($rs->fields('Remarks'));
		$journal_accounts->created->setDbValue($rs->fields('created'));
		$journal_accounts->modified->setDbValue($rs->fields('modified'));
		$journal_accounts->User_ID->setDbValue($rs->fields('User_ID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $journal_accounts;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($journal_accounts->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($journal_accounts->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($journal_accounts->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($journal_accounts->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($journal_accounts->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($journal_accounts->id->CurrentValue);
		$this->AddUrl = $journal_accounts->AddUrl();
		$this->EditUrl = $journal_accounts->EditUrl();
		$this->CopyUrl = $journal_accounts->CopyUrl();
		$this->DeleteUrl = $journal_accounts->DeleteUrl();
		$this->ListUrl = $journal_accounts->ListUrl();

		// Call Row_Rendering event
		$journal_accounts->Row_Rendering();

		// Common render codes for all row types
		// id

		$journal_accounts->id->CellCssStyle = ""; $journal_accounts->id->CellCssClass = "";
		$journal_accounts->id->CellAttrs = array(); $journal_accounts->id->ViewAttrs = array(); $journal_accounts->id->EditAttrs = array();

		// journal_type_id
		$journal_accounts->journal_type_id->CellCssStyle = ""; $journal_accounts->journal_type_id->CellCssClass = "";
		$journal_accounts->journal_type_id->CellAttrs = array(); $journal_accounts->journal_type_id->ViewAttrs = array(); $journal_accounts->journal_type_id->EditAttrs = array();

		// Account_Name
		$journal_accounts->Account_Name->CellCssStyle = ""; $journal_accounts->Account_Name->CellCssClass = "";
		$journal_accounts->Account_Name->CellAttrs = array(); $journal_accounts->Account_Name->ViewAttrs = array(); $journal_accounts->Account_Name->EditAttrs = array();

		// Account_Reference_No
		$journal_accounts->Account_Reference_No->CellCssStyle = ""; $journal_accounts->Account_Reference_No->CellCssClass = "";
		$journal_accounts->Account_Reference_No->CellAttrs = array(); $journal_accounts->Account_Reference_No->ViewAttrs = array(); $journal_accounts->Account_Reference_No->EditAttrs = array();

		// Business_Name
		$journal_accounts->Business_Name->CellCssStyle = ""; $journal_accounts->Business_Name->CellCssClass = "";
		$journal_accounts->Business_Name->CellAttrs = array(); $journal_accounts->Business_Name->ViewAttrs = array(); $journal_accounts->Business_Name->EditAttrs = array();

		// Address
		$journal_accounts->Address->CellCssStyle = ""; $journal_accounts->Address->CellCssClass = "";
		$journal_accounts->Address->CellAttrs = array(); $journal_accounts->Address->ViewAttrs = array(); $journal_accounts->Address->EditAttrs = array();

		// Remarks
		$journal_accounts->Remarks->CellCssStyle = ""; $journal_accounts->Remarks->CellCssClass = "";
		$journal_accounts->Remarks->CellAttrs = array(); $journal_accounts->Remarks->ViewAttrs = array(); $journal_accounts->Remarks->EditAttrs = array();

		// created
		$journal_accounts->created->CellCssStyle = ""; $journal_accounts->created->CellCssClass = "";
		$journal_accounts->created->CellAttrs = array(); $journal_accounts->created->ViewAttrs = array(); $journal_accounts->created->EditAttrs = array();

		// modified
		$journal_accounts->modified->CellCssStyle = ""; $journal_accounts->modified->CellCssClass = "";
		$journal_accounts->modified->CellAttrs = array(); $journal_accounts->modified->ViewAttrs = array(); $journal_accounts->modified->EditAttrs = array();

		// User_ID
		$journal_accounts->User_ID->CellCssStyle = ""; $journal_accounts->User_ID->CellCssClass = "";
		$journal_accounts->User_ID->CellAttrs = array(); $journal_accounts->User_ID->ViewAttrs = array(); $journal_accounts->User_ID->EditAttrs = array();
		if ($journal_accounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$journal_accounts->id->ViewValue = $journal_accounts->id->CurrentValue;
			$journal_accounts->id->CssStyle = "";
			$journal_accounts->id->CssClass = "";
			$journal_accounts->id->ViewCustomAttributes = "";

			// journal_type_id
			if (strval($journal_accounts->journal_type_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($journal_accounts->journal_type_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$journal_accounts->journal_type_id->ViewValue = $rswrk->fields('Journal_Name');
					$rswrk->Close();
				} else {
					$journal_accounts->journal_type_id->ViewValue = $journal_accounts->journal_type_id->CurrentValue;
				}
			} else {
				$journal_accounts->journal_type_id->ViewValue = NULL;
			}
			$journal_accounts->journal_type_id->CssStyle = "";
			$journal_accounts->journal_type_id->CssClass = "";
			$journal_accounts->journal_type_id->ViewCustomAttributes = "";

			// Account_Name
			$journal_accounts->Account_Name->ViewValue = $journal_accounts->Account_Name->CurrentValue;
			$journal_accounts->Account_Name->CssStyle = "";
			$journal_accounts->Account_Name->CssClass = "";
			$journal_accounts->Account_Name->ViewCustomAttributes = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->ViewValue = $journal_accounts->Account_Reference_No->CurrentValue;
			$journal_accounts->Account_Reference_No->CssStyle = "";
			$journal_accounts->Account_Reference_No->CssClass = "";
			$journal_accounts->Account_Reference_No->ViewCustomAttributes = "";

			// Business_Name
			$journal_accounts->Business_Name->ViewValue = $journal_accounts->Business_Name->CurrentValue;
			$journal_accounts->Business_Name->CssStyle = "";
			$journal_accounts->Business_Name->CssClass = "";
			$journal_accounts->Business_Name->ViewCustomAttributes = "";

			// Address
			$journal_accounts->Address->ViewValue = $journal_accounts->Address->CurrentValue;
			$journal_accounts->Address->CssStyle = "";
			$journal_accounts->Address->CssClass = "";
			$journal_accounts->Address->ViewCustomAttributes = "";

			// Remarks
			$journal_accounts->Remarks->ViewValue = $journal_accounts->Remarks->CurrentValue;
			$journal_accounts->Remarks->CssStyle = "";
			$journal_accounts->Remarks->CssClass = "";
			$journal_accounts->Remarks->ViewCustomAttributes = "";

			// created
			$journal_accounts->created->ViewValue = $journal_accounts->created->CurrentValue;
			$journal_accounts->created->ViewValue = ew_FormatDateTime($journal_accounts->created->ViewValue, 6);
			$journal_accounts->created->CssStyle = "";
			$journal_accounts->created->CssClass = "";
			$journal_accounts->created->ViewCustomAttributes = "";

			// modified
			$journal_accounts->modified->ViewValue = $journal_accounts->modified->CurrentValue;
			$journal_accounts->modified->ViewValue = ew_FormatDateTime($journal_accounts->modified->ViewValue, 6);
			$journal_accounts->modified->CssStyle = "";
			$journal_accounts->modified->CssClass = "";
			$journal_accounts->modified->ViewCustomAttributes = "";

			// User_ID
			$journal_accounts->User_ID->ViewValue = $journal_accounts->User_ID->CurrentValue;
			$journal_accounts->User_ID->CssStyle = "";
			$journal_accounts->User_ID->CssClass = "";
			$journal_accounts->User_ID->ViewCustomAttributes = "";

			// id
			$journal_accounts->id->HrefValue = "";
			$journal_accounts->id->TooltipValue = "";

			// journal_type_id
			$journal_accounts->journal_type_id->HrefValue = "";
			$journal_accounts->journal_type_id->TooltipValue = "";

			// Account_Name
			$journal_accounts->Account_Name->HrefValue = "";
			$journal_accounts->Account_Name->TooltipValue = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->HrefValue = "";
			$journal_accounts->Account_Reference_No->TooltipValue = "";

			// Business_Name
			$journal_accounts->Business_Name->HrefValue = "";
			$journal_accounts->Business_Name->TooltipValue = "";

			// Address
			$journal_accounts->Address->HrefValue = "";
			$journal_accounts->Address->TooltipValue = "";

			// Remarks
			$journal_accounts->Remarks->HrefValue = "";
			$journal_accounts->Remarks->TooltipValue = "";

			// created
			$journal_accounts->created->HrefValue = "";
			$journal_accounts->created->TooltipValue = "";

			// modified
			$journal_accounts->modified->HrefValue = "";
			$journal_accounts->modified->TooltipValue = "";

			// User_ID
			$journal_accounts->User_ID->HrefValue = "";
			$journal_accounts->User_ID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($journal_accounts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$journal_accounts->Row_Rendered();
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
