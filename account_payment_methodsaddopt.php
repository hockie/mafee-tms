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
$account_payment_methods_addopt = new caccount_payment_methods_addopt();
$Page =& $account_payment_methods_addopt;

// Page init
$account_payment_methods_addopt->Page_Init();

// Page main
$account_payment_methods_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var account_payment_methods_addopt = new ew_Page("account_payment_methods_addopt");

// page properties
account_payment_methods_addopt.PageID = "addopt"; // page ID
account_payment_methods_addopt.FormID = "faccount_payment_methodsaddopt"; // form ID
var EW_PAGE_ID = account_payment_methods_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
account_payment_methods_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payment_methods_addopt->ShowMessage();
?>
<form name="faccount_payment_methodsaddopt" id="faccount_payment_methodsaddopt" action="account_payment_methodsaddopt.php" method="post" onsubmit="return account_payment_methods_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="account_payment_methods">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td><?php echo $account_payment_methods->Payment_Method->FldCaption() ?></td>
		<td><span id="el_Payment_Method">
<input type="text" name="x_Payment_Method" id="x_Payment_Method" title="<?php echo $account_payment_methods->Payment_Method->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $account_payment_methods->Payment_Method->EditValue ?>"<?php echo $account_payment_methods->Payment_Method->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
</form>
<?php
$account_payment_methods_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payment_methods_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'account_payment_methods';

	// Page object name
	var $PageObjName = 'account_payment_methods_addopt';

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
	function caccount_payment_methods_addopt() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (account_payment_methods)
		$GLOBALS["account_payment_methods"] = new caccount_payment_methods();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("account_payment_methodslist.php");
		}

		// Create form object
		$objForm = new cFormObj();

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $account_payment_methods;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$account_payment_methods->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$account_payment_methods->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$account_payment_methods->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($account_payment_methods->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$account_payment_methods->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_id", strval($account_payment_methods->id->DbValue));
					$XMLDoc->AddField("x_Payment_Method", strval($account_payment_methods->Payment_Method->FormValue));
					$XMLDoc->AddField("x_created", strval($account_payment_methods->created->FormValue));
					$XMLDoc->AddField("x_modified", strval($account_payment_methods->modified->FormValue));
					$XMLDoc->AddField("x_User_ID", strval($account_payment_methods->User_ID->FormValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$account_payment_methods->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $account_payment_methods;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $account_payment_methods;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $account_payment_methods;
		$account_payment_methods->Payment_Method->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Payment_Method")));
		$account_payment_methods->created->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_created")));
		$account_payment_methods->created->CurrentValue = ew_UnFormatDateTime($account_payment_methods->created->CurrentValue, 6);
		$account_payment_methods->modified->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_modified")));
		$account_payment_methods->modified->CurrentValue = ew_UnFormatDateTime($account_payment_methods->modified->CurrentValue, 6);
		$account_payment_methods->User_ID->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_User_ID")));
		$account_payment_methods->id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_id")));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $account_payment_methods;
		$account_payment_methods->id->CurrentValue = ew_ConvertToUtf8($account_payment_methods->id->FormValue);
		$account_payment_methods->Payment_Method->CurrentValue = ew_ConvertToUtf8($account_payment_methods->Payment_Method->FormValue);
		$account_payment_methods->created->CurrentValue = ew_ConvertToUtf8($account_payment_methods->created->FormValue);
		$account_payment_methods->created->CurrentValue = ew_UnFormatDateTime($account_payment_methods->created->CurrentValue, 6);
		$account_payment_methods->modified->CurrentValue = ew_ConvertToUtf8($account_payment_methods->modified->FormValue);
		$account_payment_methods->modified->CurrentValue = ew_UnFormatDateTime($account_payment_methods->modified->CurrentValue, 6);
		$account_payment_methods->User_ID->CurrentValue = ew_ConvertToUtf8($account_payment_methods->User_ID->FormValue);
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
		// Call Row_Rendering event

		$account_payment_methods->Row_Rendering();

		// Common render codes for all row types
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
		} elseif ($account_payment_methods->RowType == EW_ROWTYPE_ADD) { // Add row

			// Payment_Method
			$account_payment_methods->Payment_Method->EditCustomAttributes = "";
			$account_payment_methods->Payment_Method->EditValue = ew_HtmlEncode($account_payment_methods->Payment_Method->CurrentValue);

			// created
			// modified
			// User_ID

		}

		// Call Row Rendered event
		if ($account_payment_methods->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$account_payment_methods->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $account_payment_methods;

		// Initialize form error message
		$gsFormError = "";

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $account_payment_methods;
		$rsnew = array();

		// Payment_Method
		$account_payment_methods->Payment_Method->SetDbValueDef($rsnew, $account_payment_methods->Payment_Method->CurrentValue, NULL, FALSE);

		// created
		$account_payment_methods->created->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['created'] =& $account_payment_methods->created->DbValue;

		// modified
		$account_payment_methods->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['modified'] =& $account_payment_methods->modified->DbValue;

		// User_ID
		$account_payment_methods->User_ID->SetDbValueDef($rsnew, CurrentUserID(), NULL);
		$rsnew['User_ID'] =& $account_payment_methods->User_ID->DbValue;

		// Call Row Inserting event
		$bInsertRow = $account_payment_methods->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($account_payment_methods->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($account_payment_methods->CancelMessage <> "") {
				$this->setMessage($account_payment_methods->CancelMessage);
				$account_payment_methods->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$account_payment_methods->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $account_payment_methods->id->DbValue;

			// Call Row Inserted event
			$account_payment_methods->Row_Inserted($rsnew);
		}
		return $AddRow;
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

	// Custom validate event
	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
