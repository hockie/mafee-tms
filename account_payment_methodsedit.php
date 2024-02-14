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
$account_payment_methods_edit = new caccount_payment_methods_edit();
$Page =& $account_payment_methods_edit;

// Page init
$account_payment_methods_edit->Page_Init();

// Page main
$account_payment_methods_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var account_payment_methods_edit = new ew_Page("account_payment_methods_edit");

// page properties
account_payment_methods_edit.PageID = "edit"; // page ID
account_payment_methods_edit.FormID = "faccount_payment_methodsedit"; // form ID
var EW_PAGE_ID = account_payment_methods_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
account_payment_methods_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
account_payment_methods_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
account_payment_methods_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
account_payment_methods_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
account_payment_methods_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $account_payment_methods->TableCaption() ?><br><br>
<a href="<?php echo $account_payment_methods->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payment_methods_edit->ShowMessage();
?>
<form name="faccount_payment_methodsedit" id="faccount_payment_methodsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return account_payment_methods_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="account_payment_methods">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($account_payment_methods->id->Visible) { // id ?>
	<tr<?php echo $account_payment_methods->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payment_methods->id->FldCaption() ?></td>
		<td<?php echo $account_payment_methods->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $account_payment_methods->id->ViewAttributes() ?>><?php echo $account_payment_methods->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($account_payment_methods->id->CurrentValue) ?>">
</span><?php echo $account_payment_methods->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payment_methods->Payment_Method->Visible) { // Payment_Method ?>
	<tr<?php echo $account_payment_methods->Payment_Method->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payment_methods->Payment_Method->FldCaption() ?></td>
		<td<?php echo $account_payment_methods->Payment_Method->CellAttributes() ?>><span id="el_Payment_Method">
<input type="text" name="x_Payment_Method" id="x_Payment_Method" title="<?php echo $account_payment_methods->Payment_Method->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $account_payment_methods->Payment_Method->EditValue ?>"<?php echo $account_payment_methods->Payment_Method->EditAttributes() ?>>
</span><?php echo $account_payment_methods->Payment_Method->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$account_payment_methods_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payment_methods_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'account_payment_methods';

	// Page object name
	var $PageObjName = 'account_payment_methods_edit';

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
	function caccount_payment_methods_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (account_payment_methods)
		$GLOBALS["account_payment_methods"] = new caccount_payment_methods();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $account_payment_methods;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$account_payment_methods->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$account_payment_methods->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$account_payment_methods->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$account_payment_methods->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$account_payment_methods->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($account_payment_methods->id->CurrentValue == "")
			$this->Page_Terminate("account_payment_methodslist.php"); // Invalid key, return to list
		switch ($account_payment_methods->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("account_payment_methodslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$account_payment_methods->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $account_payment_methods->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$account_payment_methods->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$account_payment_methods->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $account_payment_methods;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $account_payment_methods;
		$account_payment_methods->id->setFormValue($objForm->GetValue("x_id"));
		$account_payment_methods->Payment_Method->setFormValue($objForm->GetValue("x_Payment_Method"));
		$account_payment_methods->modified->setFormValue($objForm->GetValue("x_modified"));
		$account_payment_methods->modified->CurrentValue = ew_UnFormatDateTime($account_payment_methods->modified->CurrentValue, 6);
		$account_payment_methods->User_ID->setFormValue($objForm->GetValue("x_User_ID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $account_payment_methods;
		$this->LoadRow();
		$account_payment_methods->id->CurrentValue = $account_payment_methods->id->FormValue;
		$account_payment_methods->Payment_Method->CurrentValue = $account_payment_methods->Payment_Method->FormValue;
		$account_payment_methods->modified->CurrentValue = $account_payment_methods->modified->FormValue;
		$account_payment_methods->modified->CurrentValue = ew_UnFormatDateTime($account_payment_methods->modified->CurrentValue, 6);
		$account_payment_methods->User_ID->CurrentValue = $account_payment_methods->User_ID->FormValue;
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
		// id

		$account_payment_methods->id->CellCssStyle = ""; $account_payment_methods->id->CellCssClass = "";
		$account_payment_methods->id->CellAttrs = array(); $account_payment_methods->id->ViewAttrs = array(); $account_payment_methods->id->EditAttrs = array();

		// Payment_Method
		$account_payment_methods->Payment_Method->CellCssStyle = ""; $account_payment_methods->Payment_Method->CellCssClass = "";
		$account_payment_methods->Payment_Method->CellAttrs = array(); $account_payment_methods->Payment_Method->ViewAttrs = array(); $account_payment_methods->Payment_Method->EditAttrs = array();

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

			// modified
			$account_payment_methods->modified->HrefValue = "";
			$account_payment_methods->modified->TooltipValue = "";

			// User_ID
			$account_payment_methods->User_ID->HrefValue = "";
			$account_payment_methods->User_ID->TooltipValue = "";
		} elseif ($account_payment_methods->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$account_payment_methods->id->EditCustomAttributes = "";
			$account_payment_methods->id->EditValue = $account_payment_methods->id->CurrentValue;
			$account_payment_methods->id->CssStyle = "";
			$account_payment_methods->id->CssClass = "";
			$account_payment_methods->id->ViewCustomAttributes = "";

			// Payment_Method
			$account_payment_methods->Payment_Method->EditCustomAttributes = "";
			$account_payment_methods->Payment_Method->EditValue = ew_HtmlEncode($account_payment_methods->Payment_Method->CurrentValue);

			// modified
			// User_ID
			// Edit refer script
			// id

			$account_payment_methods->id->HrefValue = "";

			// Payment_Method
			$account_payment_methods->Payment_Method->HrefValue = "";

			// modified
			$account_payment_methods->modified->HrefValue = "";

			// User_ID
			$account_payment_methods->User_ID->HrefValue = "";
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

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $account_payment_methods;
		$sFilter = $account_payment_methods->KeyFilter();
		$account_payment_methods->CurrentFilter = $sFilter;
		$sSql = $account_payment_methods->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Payment_Method
			$account_payment_methods->Payment_Method->SetDbValueDef($rsnew, $account_payment_methods->Payment_Method->CurrentValue, NULL, FALSE);

			// modified
			$account_payment_methods->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['modified'] =& $account_payment_methods->modified->DbValue;

			// User_ID
			$account_payment_methods->User_ID->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['User_ID'] =& $account_payment_methods->User_ID->DbValue;

			// Call Row Updating event
			$bUpdateRow = $account_payment_methods->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($account_payment_methods->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($account_payment_methods->CancelMessage <> "") {
					$this->setMessage($account_payment_methods->CancelMessage);
					$account_payment_methods->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$account_payment_methods->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
