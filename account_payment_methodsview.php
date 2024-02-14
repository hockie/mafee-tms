<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "account_payment_methodsinfo.php" ?>
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
$account_payment_methods_view = new caccount_payment_methods_view();
$Page =& $account_payment_methods_view;

// Page init
$account_payment_methods_view->Page_Init();

// Page main
$account_payment_methods_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($account_payment_methods->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var account_payment_methods_view = new ew_Page("account_payment_methods_view");

// page properties
account_payment_methods_view.PageID = "view"; // page ID
account_payment_methods_view.FormID = "faccount_payment_methodsview"; // form ID
var EW_PAGE_ID = account_payment_methods_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
account_payment_methods_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
account_payment_methods_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
account_payment_methods_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
account_payment_methods_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $account_payment_methods->TableCaption() ?>
<br><br>
<?php if ($account_payment_methods->Export == "") { ?>
<a href="<?php echo $account_payment_methods_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $account_payment_methods_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $account_payment_methods_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $account_payment_methods_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payment_methods_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($account_payment_methods->id->Visible) { // id ?>
	<tr<?php echo $account_payment_methods->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payment_methods->id->FldCaption() ?></td>
		<td<?php echo $account_payment_methods->id->CellAttributes() ?>>
<div<?php echo $account_payment_methods->id->ViewAttributes() ?>><?php echo $account_payment_methods->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payment_methods->Payment_Method->Visible) { // Payment_Method ?>
	<tr<?php echo $account_payment_methods->Payment_Method->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payment_methods->Payment_Method->FldCaption() ?></td>
		<td<?php echo $account_payment_methods->Payment_Method->CellAttributes() ?>>
<div<?php echo $account_payment_methods->Payment_Method->ViewAttributes() ?>><?php echo $account_payment_methods->Payment_Method->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payment_methods->created->Visible) { // created ?>
	<tr<?php echo $account_payment_methods->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payment_methods->created->FldCaption() ?></td>
		<td<?php echo $account_payment_methods->created->CellAttributes() ?>>
<div<?php echo $account_payment_methods->created->ViewAttributes() ?>><?php echo $account_payment_methods->created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payment_methods->modified->Visible) { // modified ?>
	<tr<?php echo $account_payment_methods->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payment_methods->modified->FldCaption() ?></td>
		<td<?php echo $account_payment_methods->modified->CellAttributes() ?>>
<div<?php echo $account_payment_methods->modified->ViewAttributes() ?>><?php echo $account_payment_methods->modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($account_payment_methods->User_ID->Visible) { // User_ID ?>
	<tr<?php echo $account_payment_methods->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payment_methods->User_ID->FldCaption() ?></td>
		<td<?php echo $account_payment_methods->User_ID->CellAttributes() ?>>
<div<?php echo $account_payment_methods->User_ID->ViewAttributes() ?>><?php echo $account_payment_methods->User_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($account_payment_methods->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$account_payment_methods_view->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payment_methods_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'account_payment_methods';

	// Page object name
	var $PageObjName = 'account_payment_methods_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $account_payment_methods;
		if ($account_payment_methods->UseTokenInUrl) $PageUrl .= "t=" . $account_payment_methods->TableVar . "&"; // Add page token
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
		global $objForm, $account_payment_methods;
		if ($account_payment_methods->UseTokenInUrl) {
			if ($objForm)
				return ($account_payment_methods->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($account_payment_methods->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caccount_payment_methods_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (account_payment_methods)
		$GLOBALS["account_payment_methods"] = new caccount_payment_methods();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'account_payment_methods', TRUE);

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
		global $account_payment_methods;

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
			$this->Page_Terminate("account_payment_methodslist.php");
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
		global $Language, $account_payment_methods;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$account_payment_methods->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $account_payment_methods->id->QueryStringValue;
			} else {
				$sReturnUrl = "account_payment_methodslist.php"; // Return to list
			}

			// Get action
			$account_payment_methods->CurrentAction = "I"; // Display form
			switch ($account_payment_methods->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "account_payment_methodslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "account_payment_methodslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$account_payment_methods->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $account_payment_methods;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$account_payment_methods->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$account_payment_methods->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $account_payment_methods->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$account_payment_methods->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$account_payment_methods->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$account_payment_methods->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $account_payment_methods;
		$sFilter = $account_payment_methods->KeyFilter();

		// Call Row Selecting event
		$account_payment_methods->Row_Selecting($sFilter);

		// Load SQL based on filter
		$account_payment_methods->CurrentFilter = $sFilter;
		$sSql = $account_payment_methods->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$account_payment_methods->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $account_payment_methods;
		$account_payment_methods->id->setDbValue($rs->fields('id'));
		$account_payment_methods->Payment_Method->setDbValue($rs->fields('Payment_Method'));
		$account_payment_methods->created->setDbValue($rs->fields('created'));
		$account_payment_methods->modified->setDbValue($rs->fields('modified'));
		$account_payment_methods->User_ID->setDbValue($rs->fields('User_ID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $account_payment_methods;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($account_payment_methods->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($account_payment_methods->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($account_payment_methods->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($account_payment_methods->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($account_payment_methods->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($account_payment_methods->id->CurrentValue);
		$this->AddUrl = $account_payment_methods->AddUrl();
		$this->EditUrl = $account_payment_methods->EditUrl();
		$this->CopyUrl = $account_payment_methods->CopyUrl();
		$this->DeleteUrl = $account_payment_methods->DeleteUrl();
		$this->ListUrl = $account_payment_methods->ListUrl();

		// Call Row_Rendering event
		$account_payment_methods->Row_Rendering();

		// Common render codes for all row types
		// id

		$account_payment_methods->id->CellCssStyle = ""; $account_payment_methods->id->CellCssClass = "";
		$account_payment_methods->id->CellAttrs = array(); $account_payment_methods->id->ViewAttrs = array(); $account_payment_methods->id->EditAttrs = array();

		// Payment_Method
		$account_payment_methods->Payment_Method->CellCssStyle = ""; $account_payment_methods->Payment_Method->CellCssClass = "";
		$account_payment_methods->Payment_Method->CellAttrs = array(); $account_payment_methods->Payment_Method->ViewAttrs = array(); $account_payment_methods->Payment_Method->EditAttrs = array();

		// created
		$account_payment_methods->created->CellCssStyle = ""; $account_payment_methods->created->CellCssClass = "";
		$account_payment_methods->created->CellAttrs = array(); $account_payment_methods->created->ViewAttrs = array(); $account_payment_methods->created->EditAttrs = array();

		// modified
		$account_payment_methods->modified->CellCssStyle = ""; $account_payment_methods->modified->CellCssClass = "";
		$account_payment_methods->modified->CellAttrs = array(); $account_payment_methods->modified->ViewAttrs = array(); $account_payment_methods->modified->EditAttrs = array();

		// User_ID
		$account_payment_methods->User_ID->CellCssStyle = ""; $account_payment_methods->User_ID->CellCssClass = "";
		$account_payment_methods->User_ID->CellAttrs = array(); $account_payment_methods->User_ID->ViewAttrs = array(); $account_payment_methods->User_ID->EditAttrs = array();
		if ($account_payment_methods->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$account_payment_methods->id->ViewValue = $account_payment_methods->id->CurrentValue;
			$account_payment_methods->id->CssStyle = "";
			$account_payment_methods->id->CssClass = "";
			$account_payment_methods->id->ViewCustomAttributes = "";

			// Payment_Method
			$account_payment_methods->Payment_Method->ViewValue = $account_payment_methods->Payment_Method->CurrentValue;
			$account_payment_methods->Payment_Method->CssStyle = "";
			$account_payment_methods->Payment_Method->CssClass = "";
			$account_payment_methods->Payment_Method->ViewCustomAttributes = "";

			// created
			$account_payment_methods->created->ViewValue = $account_payment_methods->created->CurrentValue;
			$account_payment_methods->created->ViewValue = ew_FormatDateTime($account_payment_methods->created->ViewValue, 6);
			$account_payment_methods->created->CssStyle = "";
			$account_payment_methods->created->CssClass = "";
			$account_payment_methods->created->ViewCustomAttributes = "";

			// modified
			$account_payment_methods->modified->ViewValue = $account_payment_methods->modified->CurrentValue;
			$account_payment_methods->modified->ViewValue = ew_FormatDateTime($account_payment_methods->modified->ViewValue, 6);
			$account_payment_methods->modified->CssStyle = "";
			$account_payment_methods->modified->CssClass = "";
			$account_payment_methods->modified->ViewCustomAttributes = "";

			// User_ID
			$account_payment_methods->User_ID->ViewValue = $account_payment_methods->User_ID->CurrentValue;
			$account_payment_methods->User_ID->CssStyle = "";
			$account_payment_methods->User_ID->CssClass = "";
			$account_payment_methods->User_ID->ViewCustomAttributes = "";

			// id
			$account_payment_methods->id->HrefValue = "";
			$account_payment_methods->id->TooltipValue = "";

			// Payment_Method
			$account_payment_methods->Payment_Method->HrefValue = "";
			$account_payment_methods->Payment_Method->TooltipValue = "";

			// created
			$account_payment_methods->created->HrefValue = "";
			$account_payment_methods->created->TooltipValue = "";

			// modified
			$account_payment_methods->modified->HrefValue = "";
			$account_payment_methods->modified->TooltipValue = "";

			// User_ID
			$account_payment_methods->User_ID->HrefValue = "";
			$account_payment_methods->User_ID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($account_payment_methods->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$account_payment_methods->Row_Rendered();
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
