<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "expenses_typesinfo.php" ?>
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
$expenses_types_edit = new cexpenses_types_edit();
$Page =& $expenses_types_edit;

// Page init
$expenses_types_edit->Page_Init();

// Page main
$expenses_types_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expenses_types_edit = new ew_Page("expenses_types_edit");

// page properties
expenses_types_edit.PageID = "edit"; // page ID
expenses_types_edit.FormID = "fexpenses_typesedit"; // form ID
var EW_PAGE_ID = expenses_types_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
expenses_types_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenses_types->id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses_types->id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
expenses_types_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
expenses_types_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenses_types_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenses_types->TableCaption() ?><br><br>
<a href="<?php echo $expenses_types->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expenses_types_edit->ShowMessage();
?>
<form name="fexpenses_typesedit" id="fexpenses_typesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return expenses_types_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="expenses_types">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expenses_types->id->Visible) { // id ?>
	<tr<?php echo $expenses_types->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses_types->id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenses_types->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $expenses_types->id->ViewAttributes() ?>><?php echo $expenses_types->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($expenses_types->id->CurrentValue) ?>">
</span><?php echo $expenses_types->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses_types->Expenses_Type->Visible) { // Expenses_Type ?>
	<tr<?php echo $expenses_types->Expenses_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses_types->Expenses_Type->FldCaption() ?></td>
		<td<?php echo $expenses_types->Expenses_Type->CellAttributes() ?>><span id="el_Expenses_Type">
<input type="text" name="x_Expenses_Type" id="x_Expenses_Type" title="<?php echo $expenses_types->Expenses_Type->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $expenses_types->Expenses_Type->EditValue ?>"<?php echo $expenses_types->Expenses_Type->EditAttributes() ?>>
</span><?php echo $expenses_types->Expenses_Type->CustomMsg ?></td>
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
$expenses_types_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenses_types_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'expenses_types';

	// Page object name
	var $PageObjName = 'expenses_types_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenses_types;
		if ($expenses_types->UseTokenInUrl) $PageUrl .= "t=" . $expenses_types->TableVar . "&"; // Add page token
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
		global $objForm, $expenses_types;
		if ($expenses_types->UseTokenInUrl) {
			if ($objForm)
				return ($expenses_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenses_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenses_types_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expenses_types)
		$GLOBALS["expenses_types"] = new cexpenses_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenses_types', TRUE);

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
		global $expenses_types;

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
			$this->Page_Terminate("expenses_typeslist.php");
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
		global $objForm, $Language, $gsFormError, $expenses_types;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$expenses_types->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$expenses_types->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$expenses_types->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$expenses_types->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$expenses_types->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($expenses_types->id->CurrentValue == "")
			$this->Page_Terminate("expenses_typeslist.php"); // Invalid key, return to list
		switch ($expenses_types->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("expenses_typeslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$expenses_types->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $expenses_types->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$expenses_types->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$expenses_types->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $expenses_types;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expenses_types;
		$expenses_types->id->setFormValue($objForm->GetValue("x_id"));
		$expenses_types->Expenses_Type->setFormValue($objForm->GetValue("x_Expenses_Type"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expenses_types;
		$this->LoadRow();
		$expenses_types->id->CurrentValue = $expenses_types->id->FormValue;
		$expenses_types->Expenses_Type->CurrentValue = $expenses_types->Expenses_Type->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenses_types;
		$sFilter = $expenses_types->KeyFilter();

		// Call Row Selecting event
		$expenses_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenses_types->CurrentFilter = $sFilter;
		$sSql = $expenses_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$expenses_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expenses_types;
		$expenses_types->id->setDbValue($rs->fields('id'));
		$expenses_types->Expenses_Type->setDbValue($rs->fields('Expenses_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenses_types;

		// Initialize URLs
		// Call Row_Rendering event

		$expenses_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$expenses_types->id->CellCssStyle = ""; $expenses_types->id->CellCssClass = "";
		$expenses_types->id->CellAttrs = array(); $expenses_types->id->ViewAttrs = array(); $expenses_types->id->EditAttrs = array();

		// Expenses_Type
		$expenses_types->Expenses_Type->CellCssStyle = ""; $expenses_types->Expenses_Type->CellCssClass = "";
		$expenses_types->Expenses_Type->CellAttrs = array(); $expenses_types->Expenses_Type->ViewAttrs = array(); $expenses_types->Expenses_Type->EditAttrs = array();
		if ($expenses_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expenses_types->id->ViewValue = $expenses_types->id->CurrentValue;
			$expenses_types->id->CssStyle = "";
			$expenses_types->id->CssClass = "";
			$expenses_types->id->ViewCustomAttributes = "";

			// Expenses_Type
			$expenses_types->Expenses_Type->ViewValue = $expenses_types->Expenses_Type->CurrentValue;
			$expenses_types->Expenses_Type->CssStyle = "";
			$expenses_types->Expenses_Type->CssClass = "";
			$expenses_types->Expenses_Type->ViewCustomAttributes = "";

			// id
			$expenses_types->id->HrefValue = "";
			$expenses_types->id->TooltipValue = "";

			// Expenses_Type
			$expenses_types->Expenses_Type->HrefValue = "";
			$expenses_types->Expenses_Type->TooltipValue = "";
		} elseif ($expenses_types->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$expenses_types->id->EditCustomAttributes = "";
			$expenses_types->id->EditValue = $expenses_types->id->CurrentValue;
			$expenses_types->id->CssStyle = "";
			$expenses_types->id->CssClass = "";
			$expenses_types->id->ViewCustomAttributes = "";

			// Expenses_Type
			$expenses_types->Expenses_Type->EditCustomAttributes = "";
			$expenses_types->Expenses_Type->EditValue = ew_HtmlEncode($expenses_types->Expenses_Type->CurrentValue);

			// Edit refer script
			// id

			$expenses_types->id->HrefValue = "";

			// Expenses_Type
			$expenses_types->Expenses_Type->HrefValue = "";
		}

		// Call Row Rendered event
		if ($expenses_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenses_types->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $expenses_types;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($expenses_types->id->FormValue) && $expenses_types->id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $expenses_types->id->FldCaption();
		}
		if (!ew_CheckInteger($expenses_types->id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expenses_types->id->FldErrMsg();
		}

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
		global $conn, $Security, $Language, $expenses_types;
		$sFilter = $expenses_types->KeyFilter();
		$expenses_types->CurrentFilter = $sFilter;
		$sSql = $expenses_types->SQL();
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

			// Expenses_Type
			$expenses_types->Expenses_Type->SetDbValueDef($rsnew, $expenses_types->Expenses_Type->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $expenses_types->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($expenses_types->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($expenses_types->CancelMessage <> "") {
					$this->setMessage($expenses_types->CancelMessage);
					$expenses_types->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$expenses_types->Row_Updated($rsold, $rsnew);
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
