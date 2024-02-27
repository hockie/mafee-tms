<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "billing_typesinfo.php" ?>
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
$billing_types_edit = new cbilling_types_edit();
$Page =& $billing_types_edit;

// Page init
$billing_types_edit->Page_Init();

// Page main
$billing_types_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var billing_types_edit = new ew_Page("billing_types_edit");

// page properties
billing_types_edit.PageID = "edit"; // page ID
billing_types_edit.FormID = "fbilling_typesedit"; // form ID
var EW_PAGE_ID = billing_types_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
billing_types_edit.ValidateForm = function(fobj) {
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
billing_types_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
billing_types_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
billing_types_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $billing_types->TableCaption() ?><br><br>
<a href="<?php echo $billing_types->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$billing_types_edit->ShowMessage();
?>
<form name="fbilling_typesedit" id="fbilling_typesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return billing_types_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="billing_types">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($billing_types->id->Visible) { // id ?>
	<tr<?php echo $billing_types->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $billing_types->id->FldCaption() ?></td>
		<td<?php echo $billing_types->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $billing_types->id->ViewAttributes() ?>><?php echo $billing_types->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($billing_types->id->CurrentValue) ?>">
</span><?php echo $billing_types->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($billing_types->Billing_Types->Visible) { // Billing_Types ?>
	<tr<?php echo $billing_types->Billing_Types->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $billing_types->Billing_Types->FldCaption() ?></td>
		<td<?php echo $billing_types->Billing_Types->CellAttributes() ?>><span id="el_Billing_Types">
<input type="text" name="x_Billing_Types" id="x_Billing_Types" title="<?php echo $billing_types->Billing_Types->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $billing_types->Billing_Types->EditValue ?>"<?php echo $billing_types->Billing_Types->EditAttributes() ?>>
</span><?php echo $billing_types->Billing_Types->CustomMsg ?></td>
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
$billing_types_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cbilling_types_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'billing_types';

	// Page object name
	var $PageObjName = 'billing_types_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $billing_types;
		if ($billing_types->UseTokenInUrl) $PageUrl .= "t=" . $billing_types->TableVar . "&"; // Add page token
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
		global $objForm, $billing_types;
		if ($billing_types->UseTokenInUrl) {
			if ($objForm)
				return ($billing_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($billing_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbilling_types_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (billing_types)
		$GLOBALS["billing_types"] = new cbilling_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'billing_types', TRUE);

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
		global $billing_types;

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
			$this->Page_Terminate("billing_typeslist.php");
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
		global $objForm, $Language, $gsFormError, $billing_types;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$billing_types->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$billing_types->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$billing_types->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$billing_types->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$billing_types->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($billing_types->id->CurrentValue == "")
			$this->Page_Terminate("billing_typeslist.php"); // Invalid key, return to list
		switch ($billing_types->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("billing_typeslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$billing_types->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $billing_types->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$billing_types->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$billing_types->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $billing_types;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $billing_types;
		$billing_types->id->setFormValue($objForm->GetValue("x_id"));
		$billing_types->Billing_Types->setFormValue($objForm->GetValue("x_Billing_Types"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $billing_types;
		$this->LoadRow();
		$billing_types->id->CurrentValue = $billing_types->id->FormValue;
		$billing_types->Billing_Types->CurrentValue = $billing_types->Billing_Types->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $billing_types;
		$sFilter = $billing_types->KeyFilter();

		// Call Row Selecting event
		$billing_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$billing_types->CurrentFilter = $sFilter;
		$sSql = $billing_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$billing_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $billing_types;
		$billing_types->id->setDbValue($rs->fields('id'));
		$billing_types->Billing_Types->setDbValue($rs->fields('Billing_Types'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $billing_types;

		// Initialize URLs
		// Call Row_Rendering event

		$billing_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$billing_types->id->CellCssStyle = ""; $billing_types->id->CellCssClass = "";
		$billing_types->id->CellAttrs = array(); $billing_types->id->ViewAttrs = array(); $billing_types->id->EditAttrs = array();

		// Billing_Types
		$billing_types->Billing_Types->CellCssStyle = ""; $billing_types->Billing_Types->CellCssClass = "";
		$billing_types->Billing_Types->CellAttrs = array(); $billing_types->Billing_Types->ViewAttrs = array(); $billing_types->Billing_Types->EditAttrs = array();
		if ($billing_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$billing_types->id->ViewValue = $billing_types->id->CurrentValue;
			$billing_types->id->CssStyle = "";
			$billing_types->id->CssClass = "";
			$billing_types->id->ViewCustomAttributes = "";

			// Billing_Types
			$billing_types->Billing_Types->ViewValue = $billing_types->Billing_Types->CurrentValue;
			$billing_types->Billing_Types->CssStyle = "";
			$billing_types->Billing_Types->CssClass = "";
			$billing_types->Billing_Types->ViewCustomAttributes = "";

			// id
			$billing_types->id->HrefValue = "";
			$billing_types->id->TooltipValue = "";

			// Billing_Types
			$billing_types->Billing_Types->HrefValue = "";
			$billing_types->Billing_Types->TooltipValue = "";
		} elseif ($billing_types->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$billing_types->id->EditCustomAttributes = "";
			$billing_types->id->EditValue = $billing_types->id->CurrentValue;
			$billing_types->id->CssStyle = "";
			$billing_types->id->CssClass = "";
			$billing_types->id->ViewCustomAttributes = "";

			// Billing_Types
			$billing_types->Billing_Types->EditCustomAttributes = "";
			$billing_types->Billing_Types->EditValue = ew_HtmlEncode($billing_types->Billing_Types->CurrentValue);

			// Edit refer script
			// id

			$billing_types->id->HrefValue = "";

			// Billing_Types
			$billing_types->Billing_Types->HrefValue = "";
		}

		// Call Row Rendered event
		if ($billing_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$billing_types->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $billing_types;

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
		global $conn, $Security, $Language, $billing_types;
		$sFilter = $billing_types->KeyFilter();
		$billing_types->CurrentFilter = $sFilter;
		$sSql = $billing_types->SQL();
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

			// Billing_Types
			$billing_types->Billing_Types->SetDbValueDef($rsnew, $billing_types->Billing_Types->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $billing_types->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($billing_types->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($billing_types->CancelMessage <> "") {
					$this->setMessage($billing_types->CancelMessage);
					$billing_types->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$billing_types->Row_Updated($rsold, $rsnew);
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
