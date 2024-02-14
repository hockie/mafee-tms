<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "customer_invoicesinfo.php" ?>
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
$customer_invoices_view = new ccustomer_invoices_view();
$Page =& $customer_invoices_view;

// Page init
$customer_invoices_view->Page_Init();

// Page main
$customer_invoices_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($customer_invoices->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var customer_invoices_view = new ew_Page("customer_invoices_view");

// page properties
customer_invoices_view.PageID = "view"; // page ID
customer_invoices_view.FormID = "fcustomer_invoicesview"; // form ID
var EW_PAGE_ID = customer_invoices_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
customer_invoices_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
customer_invoices_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
customer_invoices_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customer_invoices_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $customer_invoices->TableCaption() ?>
<br><br>
<?php if ($customer_invoices->Export == "") { ?>
<a href="<?php echo $customer_invoices_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $customer_invoices_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $customer_invoices_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $customer_invoices_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$customer_invoices_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($customer_invoices->id->Visible) { // id ?>
	<tr<?php echo $customer_invoices->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->id->FldCaption() ?></td>
		<td<?php echo $customer_invoices->id->CellAttributes() ?>>
<div<?php echo $customer_invoices->id->ViewAttributes() ?>><?php echo $customer_invoices->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Payment_ID->Visible) { // Payment_ID ?>
	<tr<?php echo $customer_invoices->Payment_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Payment_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Payment_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->Payment_ID->ViewAttributes() ?>>
<?php if ($customer_invoices->Payment_ID->HrefValue <> "" || $customer_invoices->Payment_ID->TooltipValue <> "") { ?>
<a href="./account_paymentslist.php?x_id=<?php echo $customer_invoices->Payment_ID->HrefValue ?>" target="_self"><?php echo $customer_invoices->Payment_ID->ViewValue ?></a>
<?php } else { ?>
<?php echo $customer_invoices->Payment_ID->ViewValue ?>
<?php } ?>
</div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Invoice_ID->Visible) { // Invoice_ID ?>
	<tr<?php echo $customer_invoices->Invoice_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Invoice_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Invoice_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->Invoice_ID->ViewAttributes() ?>>
<?php if ($customer_invoices->Invoice_ID->HrefValue <> "" || $customer_invoices->Invoice_ID->TooltipValue <> "") { ?>
<a href="./invoiceslist.php?x_id=<?php echo $customer_invoices->Invoice_ID->HrefValue ?>" target="_self"><?php echo $customer_invoices->Invoice_ID->ViewValue ?></a>
<?php } else { ?>
<?php echo $customer_invoices->Invoice_ID->ViewValue ?>
<?php } ?>
</div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Invoice_Bill_Date->Visible) { // Invoice_Bill_Date ?>
	<tr<?php echo $customer_invoices->Invoice_Bill_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Invoice_Bill_Date->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Invoice_Bill_Date->CellAttributes() ?>>
<div<?php echo $customer_invoices->Invoice_Bill_Date->ViewAttributes() ?>><?php echo $customer_invoices->Invoice_Bill_Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Due_Date->Visible) { // Due_Date ?>
	<tr<?php echo $customer_invoices->Due_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Due_Date->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Due_Date->CellAttributes() ?>>
<div<?php echo $customer_invoices->Due_Date->ViewAttributes() ?>><?php echo $customer_invoices->Due_Date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<tr<?php echo $customer_invoices->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $customer_invoices->Total_Amount_Due->ViewAttributes() ?>><?php echo $customer_invoices->Total_Amount_Due->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Payment_Status_ID->Visible) { // Payment_Status_ID ?>
	<tr<?php echo $customer_invoices->Payment_Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Payment_Status_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Payment_Status_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->Payment_Status_ID->ViewAttributes() ?>><?php echo $customer_invoices->Payment_Status_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Status_ID->Visible) { // Status_ID ?>
	<tr<?php echo $customer_invoices->Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Status_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Status_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->Status_ID->ViewAttributes() ?>><?php echo $customer_invoices->Status_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->created->Visible) { // created ?>
	<tr<?php echo $customer_invoices->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->created->FldCaption() ?></td>
		<td<?php echo $customer_invoices->created->CellAttributes() ?>>
<div<?php echo $customer_invoices->created->ViewAttributes() ?>><?php echo $customer_invoices->created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->modified->Visible) { // modified ?>
	<tr<?php echo $customer_invoices->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->modified->FldCaption() ?></td>
		<td<?php echo $customer_invoices->modified->CellAttributes() ?>>
<div<?php echo $customer_invoices->modified->ViewAttributes() ?>><?php echo $customer_invoices->modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->User_ID->Visible) { // User_ID ?>
	<tr<?php echo $customer_invoices->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->User_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->User_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->User_ID->ViewAttributes() ?>><?php echo $customer_invoices->User_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $customer_invoices->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Remarks->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Remarks->CellAttributes() ?>>
<div<?php echo $customer_invoices->Remarks->ViewAttributes() ?>><?php echo $customer_invoices->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($customer_invoices->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$customer_invoices_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccustomer_invoices_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'customer_invoices';

	// Page object name
	var $PageObjName = 'customer_invoices_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customer_invoices;
		if ($customer_invoices->UseTokenInUrl) $PageUrl .= "t=" . $customer_invoices->TableVar . "&"; // Add page token
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
		global $objForm, $customer_invoices;
		if ($customer_invoices->UseTokenInUrl) {
			if ($objForm)
				return ($customer_invoices->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customer_invoices->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccustomer_invoices_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (customer_invoices)
		$GLOBALS["customer_invoices"] = new ccustomer_invoices();

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
			define("EW_TABLE_NAME", 'customer_invoices', TRUE);

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
		global $customer_invoices;

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
			$this->Page_Terminate("customer_invoiceslist.php");
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
		global $Language, $customer_invoices;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$customer_invoices->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $customer_invoices->id->QueryStringValue;
			} else {
				$sReturnUrl = "customer_invoiceslist.php"; // Return to list
			}

			// Get action
			$customer_invoices->CurrentAction = "I"; // Display form
			switch ($customer_invoices->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "customer_invoiceslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "customer_invoiceslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$customer_invoices->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $customer_invoices;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$customer_invoices->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$customer_invoices->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $customer_invoices->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$customer_invoices->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$customer_invoices->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$customer_invoices->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customer_invoices;
		$sFilter = $customer_invoices->KeyFilter();

		// Call Row Selecting event
		$customer_invoices->Row_Selecting($sFilter);

		// Load SQL based on filter
		$customer_invoices->CurrentFilter = $sFilter;
		$sSql = $customer_invoices->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$customer_invoices->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $customer_invoices;
		$customer_invoices->id->setDbValue($rs->fields('id'));
		$customer_invoices->Payment_ID->setDbValue($rs->fields('Payment_ID'));
		$customer_invoices->Invoice_ID->setDbValue($rs->fields('Invoice_ID'));
		$customer_invoices->Client_ID->setDbValue($rs->fields('Client_ID'));
		$customer_invoices->Invoice_Bill_Date->setDbValue($rs->fields('Invoice_Bill_Date'));
		$customer_invoices->Due_Date->setDbValue($rs->fields('Due_Date'));
		$customer_invoices->Invoice_Number->setDbValue($rs->fields('Invoice_Number'));
		$customer_invoices->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$customer_invoices->Payment_Status_ID->setDbValue($rs->fields('Payment_Status_ID'));
		$customer_invoices->Status_ID->setDbValue($rs->fields('Status_ID'));
		$customer_invoices->created->setDbValue($rs->fields('created'));
		$customer_invoices->modified->setDbValue($rs->fields('modified'));
		$customer_invoices->User_ID->setDbValue($rs->fields('User_ID'));
		$customer_invoices->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $customer_invoices;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($customer_invoices->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($customer_invoices->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($customer_invoices->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($customer_invoices->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($customer_invoices->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($customer_invoices->id->CurrentValue);
		$this->AddUrl = $customer_invoices->AddUrl();
		$this->EditUrl = $customer_invoices->EditUrl();
		$this->CopyUrl = $customer_invoices->CopyUrl();
		$this->DeleteUrl = $customer_invoices->DeleteUrl();
		$this->ListUrl = $customer_invoices->ListUrl();

		// Call Row_Rendering event
		$customer_invoices->Row_Rendering();

		// Common render codes for all row types
		// id

		$customer_invoices->id->CellCssStyle = ""; $customer_invoices->id->CellCssClass = "";
		$customer_invoices->id->CellAttrs = array(); $customer_invoices->id->ViewAttrs = array(); $customer_invoices->id->EditAttrs = array();

		// Payment_ID
		$customer_invoices->Payment_ID->CellCssStyle = ""; $customer_invoices->Payment_ID->CellCssClass = "";
		$customer_invoices->Payment_ID->CellAttrs = array(); $customer_invoices->Payment_ID->ViewAttrs = array(); $customer_invoices->Payment_ID->EditAttrs = array();

		// Invoice_ID
		$customer_invoices->Invoice_ID->CellCssStyle = ""; $customer_invoices->Invoice_ID->CellCssClass = "";
		$customer_invoices->Invoice_ID->CellAttrs = array(); $customer_invoices->Invoice_ID->ViewAttrs = array(); $customer_invoices->Invoice_ID->EditAttrs = array();

		// Invoice_Bill_Date
		$customer_invoices->Invoice_Bill_Date->CellCssStyle = ""; $customer_invoices->Invoice_Bill_Date->CellCssClass = "";
		$customer_invoices->Invoice_Bill_Date->CellAttrs = array(); $customer_invoices->Invoice_Bill_Date->ViewAttrs = array(); $customer_invoices->Invoice_Bill_Date->EditAttrs = array();

		// Due_Date
		$customer_invoices->Due_Date->CellCssStyle = ""; $customer_invoices->Due_Date->CellCssClass = "";
		$customer_invoices->Due_Date->CellAttrs = array(); $customer_invoices->Due_Date->ViewAttrs = array(); $customer_invoices->Due_Date->EditAttrs = array();

		// Total_Amount_Due
		$customer_invoices->Total_Amount_Due->CellCssStyle = ""; $customer_invoices->Total_Amount_Due->CellCssClass = "";
		$customer_invoices->Total_Amount_Due->CellAttrs = array(); $customer_invoices->Total_Amount_Due->ViewAttrs = array(); $customer_invoices->Total_Amount_Due->EditAttrs = array();

		// Payment_Status_ID
		$customer_invoices->Payment_Status_ID->CellCssStyle = ""; $customer_invoices->Payment_Status_ID->CellCssClass = "";
		$customer_invoices->Payment_Status_ID->CellAttrs = array(); $customer_invoices->Payment_Status_ID->ViewAttrs = array(); $customer_invoices->Payment_Status_ID->EditAttrs = array();

		// Status_ID
		$customer_invoices->Status_ID->CellCssStyle = ""; $customer_invoices->Status_ID->CellCssClass = "";
		$customer_invoices->Status_ID->CellAttrs = array(); $customer_invoices->Status_ID->ViewAttrs = array(); $customer_invoices->Status_ID->EditAttrs = array();

		// created
		$customer_invoices->created->CellCssStyle = ""; $customer_invoices->created->CellCssClass = "";
		$customer_invoices->created->CellAttrs = array(); $customer_invoices->created->ViewAttrs = array(); $customer_invoices->created->EditAttrs = array();

		// modified
		$customer_invoices->modified->CellCssStyle = ""; $customer_invoices->modified->CellCssClass = "";
		$customer_invoices->modified->CellAttrs = array(); $customer_invoices->modified->ViewAttrs = array(); $customer_invoices->modified->EditAttrs = array();

		// User_ID
		$customer_invoices->User_ID->CellCssStyle = ""; $customer_invoices->User_ID->CellCssClass = "";
		$customer_invoices->User_ID->CellAttrs = array(); $customer_invoices->User_ID->ViewAttrs = array(); $customer_invoices->User_ID->EditAttrs = array();

		// Remarks
		$customer_invoices->Remarks->CellCssStyle = ""; $customer_invoices->Remarks->CellCssClass = "";
		$customer_invoices->Remarks->CellAttrs = array(); $customer_invoices->Remarks->ViewAttrs = array(); $customer_invoices->Remarks->EditAttrs = array();
		if ($customer_invoices->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customer_invoices->id->ViewValue = $customer_invoices->id->CurrentValue;
			$customer_invoices->id->CssStyle = "";
			$customer_invoices->id->CssClass = "";
			$customer_invoices->id->ViewCustomAttributes = "";

			// Payment_ID
			$customer_invoices->Payment_ID->ViewValue = $customer_invoices->Payment_ID->CurrentValue;
			$customer_invoices->Payment_ID->CssStyle = "";
			$customer_invoices->Payment_ID->CssClass = "";
			$customer_invoices->Payment_ID->ViewCustomAttributes = "";

			// Invoice_ID
			if (strval($customer_invoices->Invoice_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customer_invoices->Invoice_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Invoice_Number` FROM `invoices`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Payment_Status`=" . 9 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Invoice_Number` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customer_invoices->Invoice_ID->ViewValue = $rswrk->fields('Invoice_Number');
					$rswrk->Close();
				} else {
					$customer_invoices->Invoice_ID->ViewValue = $customer_invoices->Invoice_ID->CurrentValue;
				}
			} else {
				$customer_invoices->Invoice_ID->ViewValue = NULL;
			}
			$customer_invoices->Invoice_ID->CssStyle = "";
			$customer_invoices->Invoice_ID->CssClass = "";
			$customer_invoices->Invoice_ID->ViewCustomAttributes = "";

			// Invoice_Bill_Date
			$customer_invoices->Invoice_Bill_Date->ViewValue = $customer_invoices->Invoice_Bill_Date->CurrentValue;
			$customer_invoices->Invoice_Bill_Date->ViewValue = ew_FormatDateTime($customer_invoices->Invoice_Bill_Date->ViewValue, 6);
			$customer_invoices->Invoice_Bill_Date->CssStyle = "";
			$customer_invoices->Invoice_Bill_Date->CssClass = "";
			$customer_invoices->Invoice_Bill_Date->ViewCustomAttributes = "";

			// Due_Date
			$customer_invoices->Due_Date->ViewValue = $customer_invoices->Due_Date->CurrentValue;
			$customer_invoices->Due_Date->ViewValue = ew_FormatDateTime($customer_invoices->Due_Date->ViewValue, 6);
			$customer_invoices->Due_Date->CssStyle = "";
			$customer_invoices->Due_Date->CssClass = "";
			$customer_invoices->Due_Date->ViewCustomAttributes = "";

			// Total_Amount_Due
			$customer_invoices->Total_Amount_Due->ViewValue = $customer_invoices->Total_Amount_Due->CurrentValue;
			$customer_invoices->Total_Amount_Due->ViewValue = ew_FormatNumber($customer_invoices->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$customer_invoices->Total_Amount_Due->CssStyle = "";
			$customer_invoices->Total_Amount_Due->CssClass = "";
			$customer_invoices->Total_Amount_Due->ViewCustomAttributes = "";

			// Payment_Status_ID
			if (strval($customer_invoices->Payment_Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customer_invoices->Payment_Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customer_invoices->Payment_Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$customer_invoices->Payment_Status_ID->ViewValue = $customer_invoices->Payment_Status_ID->CurrentValue;
				}
			} else {
				$customer_invoices->Payment_Status_ID->ViewValue = NULL;
			}
			$customer_invoices->Payment_Status_ID->CssStyle = "";
			$customer_invoices->Payment_Status_ID->CssClass = "";
			$customer_invoices->Payment_Status_ID->ViewCustomAttributes = "";

			// Status_ID
			if (strval($customer_invoices->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customer_invoices->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customer_invoices->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$customer_invoices->Status_ID->ViewValue = $customer_invoices->Status_ID->CurrentValue;
				}
			} else {
				$customer_invoices->Status_ID->ViewValue = NULL;
			}
			$customer_invoices->Status_ID->CssStyle = "";
			$customer_invoices->Status_ID->CssClass = "";
			$customer_invoices->Status_ID->ViewCustomAttributes = "";

			// created
			$customer_invoices->created->ViewValue = $customer_invoices->created->CurrentValue;
			$customer_invoices->created->ViewValue = ew_FormatDateTime($customer_invoices->created->ViewValue, 6);
			$customer_invoices->created->CssStyle = "";
			$customer_invoices->created->CssClass = "";
			$customer_invoices->created->ViewCustomAttributes = "";

			// modified
			$customer_invoices->modified->ViewValue = $customer_invoices->modified->CurrentValue;
			$customer_invoices->modified->ViewValue = ew_FormatDateTime($customer_invoices->modified->ViewValue, 6);
			$customer_invoices->modified->CssStyle = "";
			$customer_invoices->modified->CssClass = "";
			$customer_invoices->modified->ViewCustomAttributes = "";

			// User_ID
			$customer_invoices->User_ID->ViewValue = $customer_invoices->User_ID->CurrentValue;
			$customer_invoices->User_ID->CssStyle = "";
			$customer_invoices->User_ID->CssClass = "";
			$customer_invoices->User_ID->ViewCustomAttributes = "";

			// Remarks
			$customer_invoices->Remarks->ViewValue = $customer_invoices->Remarks->CurrentValue;
			$customer_invoices->Remarks->CssStyle = "";
			$customer_invoices->Remarks->CssClass = "";
			$customer_invoices->Remarks->ViewCustomAttributes = "";

			// id
			$customer_invoices->id->HrefValue = "";
			$customer_invoices->id->TooltipValue = "";

			// Payment_ID
			if (!ew_Empty($customer_invoices->Payment_ID->CurrentValue)) {
				$customer_invoices->Payment_ID->HrefValue = $customer_invoices->Payment_ID->CurrentValue;
				if ($customer_invoices->Export <> "") $customer_invoices->Payment_ID->HrefValue = ew_ConvertFullUrl($customer_invoices->Payment_ID->HrefValue);
			} else {
				$customer_invoices->Payment_ID->HrefValue = "";
			}
			$customer_invoices->Payment_ID->TooltipValue = "";

			// Invoice_ID
			if (!ew_Empty($customer_invoices->Invoice_ID->CurrentValue)) {
				$customer_invoices->Invoice_ID->HrefValue = $customer_invoices->Invoice_ID->CurrentValue;
				if ($customer_invoices->Export <> "") $customer_invoices->Invoice_ID->HrefValue = ew_ConvertFullUrl($customer_invoices->Invoice_ID->HrefValue);
			} else {
				$customer_invoices->Invoice_ID->HrefValue = "";
			}
			$customer_invoices->Invoice_ID->TooltipValue = "";

			// Invoice_Bill_Date
			$customer_invoices->Invoice_Bill_Date->HrefValue = "";
			$customer_invoices->Invoice_Bill_Date->TooltipValue = "";

			// Due_Date
			$customer_invoices->Due_Date->HrefValue = "";
			$customer_invoices->Due_Date->TooltipValue = "";

			// Total_Amount_Due
			$customer_invoices->Total_Amount_Due->HrefValue = "";
			$customer_invoices->Total_Amount_Due->TooltipValue = "";

			// Payment_Status_ID
			$customer_invoices->Payment_Status_ID->HrefValue = "";
			$customer_invoices->Payment_Status_ID->TooltipValue = "";

			// Status_ID
			$customer_invoices->Status_ID->HrefValue = "";
			$customer_invoices->Status_ID->TooltipValue = "";

			// created
			$customer_invoices->created->HrefValue = "";
			$customer_invoices->created->TooltipValue = "";

			// modified
			$customer_invoices->modified->HrefValue = "";
			$customer_invoices->modified->TooltipValue = "";

			// User_ID
			$customer_invoices->User_ID->HrefValue = "";
			$customer_invoices->User_ID->TooltipValue = "";

			// Remarks
			$customer_invoices->Remarks->HrefValue = "";
			$customer_invoices->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($customer_invoices->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$customer_invoices->Row_Rendered();
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
