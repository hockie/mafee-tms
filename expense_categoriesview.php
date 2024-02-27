<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "expense_categoriesinfo.php" ?>
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
$expense_categories_view = new cexpense_categories_view();
$Page =& $expense_categories_view;

// Page init
$expense_categories_view->Page_Init();

// Page main
$expense_categories_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($expense_categories->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expense_categories_view = new ew_Page("expense_categories_view");

// page properties
expense_categories_view.PageID = "view"; // page ID
expense_categories_view.FormID = "fexpense_categoriesview"; // form ID
var EW_PAGE_ID = expense_categories_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expense_categories_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expense_categories_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expense_categories_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expense_categories_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expense_categories->TableCaption() ?>
<br><br>
<?php if ($expense_categories->Export == "") { ?>
<a href="<?php echo $expense_categories_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expense_categories_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $expense_categories_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expense_categories_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $expense_categories_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expense_categories_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expense_categories->id->Visible) { // id ?>
	<tr<?php echo $expense_categories->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->id->FldCaption() ?></td>
		<td<?php echo $expense_categories->id->CellAttributes() ?>>
<div<?php echo $expense_categories->id->ViewAttributes() ?>><?php echo $expense_categories->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->category_name->Visible) { // category_name ?>
	<tr<?php echo $expense_categories->category_name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->category_name->FldCaption() ?></td>
		<td<?php echo $expense_categories->category_name->CellAttributes() ?>>
<div<?php echo $expense_categories->category_name->ViewAttributes() ?>><?php echo $expense_categories->category_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->cost->Visible) { // cost ?>
	<tr<?php echo $expense_categories->cost->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->cost->FldCaption() ?></td>
		<td<?php echo $expense_categories->cost->CellAttributes() ?>>
<div<?php echo $expense_categories->cost->ViewAttributes() ?>><?php echo $expense_categories->cost->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->internal_reference->Visible) { // internal_reference ?>
	<tr<?php echo $expense_categories->internal_reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->internal_reference->FldCaption() ?></td>
		<td<?php echo $expense_categories->internal_reference->CellAttributes() ?>>
<div<?php echo $expense_categories->internal_reference->ViewAttributes() ?>><?php echo $expense_categories->internal_reference->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->re_invoice_expenses->Visible) { // re_invoice_expenses ?>
	<tr<?php echo $expense_categories->re_invoice_expenses->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->re_invoice_expenses->FldCaption() ?></td>
		<td<?php echo $expense_categories->re_invoice_expenses->CellAttributes() ?>>
<div<?php echo $expense_categories->re_invoice_expenses->ViewAttributes() ?>><?php echo $expense_categories->re_invoice_expenses->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->vendor_taxes->Visible) { // vendor_taxes ?>
	<tr<?php echo $expense_categories->vendor_taxes->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->vendor_taxes->FldCaption() ?></td>
		<td<?php echo $expense_categories->vendor_taxes->CellAttributes() ?>>
<div<?php echo $expense_categories->vendor_taxes->ViewAttributes() ?>><?php echo $expense_categories->vendor_taxes->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->customer_taxes->Visible) { // customer_taxes ?>
	<tr<?php echo $expense_categories->customer_taxes->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->customer_taxes->FldCaption() ?></td>
		<td<?php echo $expense_categories->customer_taxes->CellAttributes() ?>>
<div<?php echo $expense_categories->customer_taxes->ViewAttributes() ?>><?php echo $expense_categories->customer_taxes->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->created->Visible) { // created ?>
	<tr<?php echo $expense_categories->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->created->FldCaption() ?></td>
		<td<?php echo $expense_categories->created->CellAttributes() ?>>
<div<?php echo $expense_categories->created->ViewAttributes() ?>><?php echo $expense_categories->created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->modified->Visible) { // modified ?>
	<tr<?php echo $expense_categories->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->modified->FldCaption() ?></td>
		<td<?php echo $expense_categories->modified->CellAttributes() ?>>
<div<?php echo $expense_categories->modified->ViewAttributes() ?>><?php echo $expense_categories->modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->user_id->Visible) { // user_id ?>
	<tr<?php echo $expense_categories->user_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->user_id->FldCaption() ?></td>
		<td<?php echo $expense_categories->user_id->CellAttributes() ?>>
<div<?php echo $expense_categories->user_id->ViewAttributes() ?>><?php echo $expense_categories->user_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($expense_categories->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$expense_categories_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpense_categories_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'expense_categories';

	// Page object name
	var $PageObjName = 'expense_categories_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expense_categories;
		if ($expense_categories->UseTokenInUrl) $PageUrl .= "t=" . $expense_categories->TableVar . "&"; // Add page token
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
		global $objForm, $expense_categories;
		if ($expense_categories->UseTokenInUrl) {
			if ($objForm)
				return ($expense_categories->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expense_categories->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpense_categories_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expense_categories)
		$GLOBALS["expense_categories"] = new cexpense_categories();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expense_categories', TRUE);

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
		global $expense_categories;

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
			$this->Page_Terminate("expense_categorieslist.php");
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
		global $Language, $expense_categories;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$expense_categories->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $expense_categories->id->QueryStringValue;
			} else {
				$sReturnUrl = "expense_categorieslist.php"; // Return to list
			}

			// Get action
			$expense_categories->CurrentAction = "I"; // Display form
			switch ($expense_categories->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "expense_categorieslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "expense_categorieslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$expense_categories->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expense_categories;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$expense_categories->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$expense_categories->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $expense_categories->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$expense_categories->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$expense_categories->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$expense_categories->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expense_categories;
		$sFilter = $expense_categories->KeyFilter();

		// Call Row Selecting event
		$expense_categories->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expense_categories->CurrentFilter = $sFilter;
		$sSql = $expense_categories->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$expense_categories->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expense_categories;
		$expense_categories->id->setDbValue($rs->fields('id'));
		$expense_categories->category_name->setDbValue($rs->fields('category_name'));
		$expense_categories->cost->setDbValue($rs->fields('cost'));
		$expense_categories->internal_reference->setDbValue($rs->fields('internal_reference'));
		$expense_categories->re_invoice_expenses->setDbValue($rs->fields('re_invoice_expenses'));
		$expense_categories->vendor_taxes->setDbValue($rs->fields('vendor_taxes'));
		$expense_categories->customer_taxes->setDbValue($rs->fields('customer_taxes'));
		$expense_categories->created->setDbValue($rs->fields('created'));
		$expense_categories->modified->setDbValue($rs->fields('modified'));
		$expense_categories->user_id->setDbValue($rs->fields('user_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expense_categories;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($expense_categories->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($expense_categories->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($expense_categories->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($expense_categories->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($expense_categories->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($expense_categories->id->CurrentValue);
		$this->AddUrl = $expense_categories->AddUrl();
		$this->EditUrl = $expense_categories->EditUrl();
		$this->CopyUrl = $expense_categories->CopyUrl();
		$this->DeleteUrl = $expense_categories->DeleteUrl();
		$this->ListUrl = $expense_categories->ListUrl();

		// Call Row_Rendering event
		$expense_categories->Row_Rendering();

		// Common render codes for all row types
		// id

		$expense_categories->id->CellCssStyle = ""; $expense_categories->id->CellCssClass = "";
		$expense_categories->id->CellAttrs = array(); $expense_categories->id->ViewAttrs = array(); $expense_categories->id->EditAttrs = array();

		// category_name
		$expense_categories->category_name->CellCssStyle = ""; $expense_categories->category_name->CellCssClass = "";
		$expense_categories->category_name->CellAttrs = array(); $expense_categories->category_name->ViewAttrs = array(); $expense_categories->category_name->EditAttrs = array();

		// cost
		$expense_categories->cost->CellCssStyle = ""; $expense_categories->cost->CellCssClass = "";
		$expense_categories->cost->CellAttrs = array(); $expense_categories->cost->ViewAttrs = array(); $expense_categories->cost->EditAttrs = array();

		// internal_reference
		$expense_categories->internal_reference->CellCssStyle = ""; $expense_categories->internal_reference->CellCssClass = "";
		$expense_categories->internal_reference->CellAttrs = array(); $expense_categories->internal_reference->ViewAttrs = array(); $expense_categories->internal_reference->EditAttrs = array();

		// re_invoice_expenses
		$expense_categories->re_invoice_expenses->CellCssStyle = ""; $expense_categories->re_invoice_expenses->CellCssClass = "";
		$expense_categories->re_invoice_expenses->CellAttrs = array(); $expense_categories->re_invoice_expenses->ViewAttrs = array(); $expense_categories->re_invoice_expenses->EditAttrs = array();

		// vendor_taxes
		$expense_categories->vendor_taxes->CellCssStyle = ""; $expense_categories->vendor_taxes->CellCssClass = "";
		$expense_categories->vendor_taxes->CellAttrs = array(); $expense_categories->vendor_taxes->ViewAttrs = array(); $expense_categories->vendor_taxes->EditAttrs = array();

		// customer_taxes
		$expense_categories->customer_taxes->CellCssStyle = ""; $expense_categories->customer_taxes->CellCssClass = "";
		$expense_categories->customer_taxes->CellAttrs = array(); $expense_categories->customer_taxes->ViewAttrs = array(); $expense_categories->customer_taxes->EditAttrs = array();

		// created
		$expense_categories->created->CellCssStyle = ""; $expense_categories->created->CellCssClass = "";
		$expense_categories->created->CellAttrs = array(); $expense_categories->created->ViewAttrs = array(); $expense_categories->created->EditAttrs = array();

		// modified
		$expense_categories->modified->CellCssStyle = ""; $expense_categories->modified->CellCssClass = "";
		$expense_categories->modified->CellAttrs = array(); $expense_categories->modified->ViewAttrs = array(); $expense_categories->modified->EditAttrs = array();

		// user_id
		$expense_categories->user_id->CellCssStyle = ""; $expense_categories->user_id->CellCssClass = "";
		$expense_categories->user_id->CellAttrs = array(); $expense_categories->user_id->ViewAttrs = array(); $expense_categories->user_id->EditAttrs = array();
		if ($expense_categories->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expense_categories->id->ViewValue = $expense_categories->id->CurrentValue;
			$expense_categories->id->CssStyle = "";
			$expense_categories->id->CssClass = "";
			$expense_categories->id->ViewCustomAttributes = "";

			// category_name
			$expense_categories->category_name->ViewValue = $expense_categories->category_name->CurrentValue;
			$expense_categories->category_name->CssStyle = "";
			$expense_categories->category_name->CssClass = "";
			$expense_categories->category_name->ViewCustomAttributes = "";

			// cost
			$expense_categories->cost->ViewValue = $expense_categories->cost->CurrentValue;
			$expense_categories->cost->ViewValue = ew_FormatNumber($expense_categories->cost->ViewValue, 2, -2, -2, -2);
			$expense_categories->cost->CssStyle = "";
			$expense_categories->cost->CssClass = "";
			$expense_categories->cost->ViewCustomAttributes = "";

			// internal_reference
			$expense_categories->internal_reference->ViewValue = $expense_categories->internal_reference->CurrentValue;
			$expense_categories->internal_reference->CssStyle = "";
			$expense_categories->internal_reference->CssClass = "";
			$expense_categories->internal_reference->ViewCustomAttributes = "";

			// re_invoice_expenses
			if (strval($expense_categories->re_invoice_expenses->CurrentValue) <> "") {
				switch ($expense_categories->re_invoice_expenses->CurrentValue) {
					case "yes":
						$expense_categories->re_invoice_expenses->ViewValue = "At Invoice";
						break;
					case "no":
						$expense_categories->re_invoice_expenses->ViewValue = "No";
						break;
					default:
						$expense_categories->re_invoice_expenses->ViewValue = $expense_categories->re_invoice_expenses->CurrentValue;
				}
			} else {
				$expense_categories->re_invoice_expenses->ViewValue = NULL;
			}
			$expense_categories->re_invoice_expenses->CssStyle = "";
			$expense_categories->re_invoice_expenses->CssClass = "";
			$expense_categories->re_invoice_expenses->ViewCustomAttributes = "";

			// vendor_taxes
			$expense_categories->vendor_taxes->ViewValue = $expense_categories->vendor_taxes->CurrentValue;
			$expense_categories->vendor_taxes->CssStyle = "";
			$expense_categories->vendor_taxes->CssClass = "";
			$expense_categories->vendor_taxes->ViewCustomAttributes = "";

			// customer_taxes
			$expense_categories->customer_taxes->ViewValue = $expense_categories->customer_taxes->CurrentValue;
			$expense_categories->customer_taxes->CssStyle = "";
			$expense_categories->customer_taxes->CssClass = "";
			$expense_categories->customer_taxes->ViewCustomAttributes = "";

			// created
			$expense_categories->created->ViewValue = $expense_categories->created->CurrentValue;
			$expense_categories->created->ViewValue = ew_FormatDateTime($expense_categories->created->ViewValue, 6);
			$expense_categories->created->CssStyle = "";
			$expense_categories->created->CssClass = "";
			$expense_categories->created->ViewCustomAttributes = "";

			// modified
			$expense_categories->modified->ViewValue = $expense_categories->modified->CurrentValue;
			$expense_categories->modified->ViewValue = ew_FormatDateTime($expense_categories->modified->ViewValue, 6);
			$expense_categories->modified->CssStyle = "";
			$expense_categories->modified->CssClass = "";
			$expense_categories->modified->ViewCustomAttributes = "";

			// user_id
			$expense_categories->user_id->ViewValue = $expense_categories->user_id->CurrentValue;
			$expense_categories->user_id->CssStyle = "";
			$expense_categories->user_id->CssClass = "";
			$expense_categories->user_id->ViewCustomAttributes = "";

			// id
			$expense_categories->id->HrefValue = "";
			$expense_categories->id->TooltipValue = "";

			// category_name
			$expense_categories->category_name->HrefValue = "";
			$expense_categories->category_name->TooltipValue = "";

			// cost
			$expense_categories->cost->HrefValue = "";
			$expense_categories->cost->TooltipValue = "";

			// internal_reference
			$expense_categories->internal_reference->HrefValue = "";
			$expense_categories->internal_reference->TooltipValue = "";

			// re_invoice_expenses
			$expense_categories->re_invoice_expenses->HrefValue = "";
			$expense_categories->re_invoice_expenses->TooltipValue = "";

			// vendor_taxes
			$expense_categories->vendor_taxes->HrefValue = "";
			$expense_categories->vendor_taxes->TooltipValue = "";

			// customer_taxes
			$expense_categories->customer_taxes->HrefValue = "";
			$expense_categories->customer_taxes->TooltipValue = "";

			// created
			$expense_categories->created->HrefValue = "";
			$expense_categories->created->TooltipValue = "";

			// modified
			$expense_categories->modified->HrefValue = "";
			$expense_categories->modified->TooltipValue = "";

			// user_id
			$expense_categories->user_id->HrefValue = "";
			$expense_categories->user_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expense_categories->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expense_categories->Row_Rendered();
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
