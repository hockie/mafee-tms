<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "userlevelpermissionsinfo.php" ?>
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
$userlevelpermissions_edit = new cuserlevelpermissions_edit();
$Page =& $userlevelpermissions_edit;

// Page init
$userlevelpermissions_edit->Page_Init();

// Page main
$userlevelpermissions_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var userlevelpermissions_edit = new ew_Page("userlevelpermissions_edit");

// page properties
userlevelpermissions_edit.PageID = "edit"; // page ID
userlevelpermissions_edit.FormID = "fuserlevelpermissionsedit"; // form ID
var EW_PAGE_ID = userlevelpermissions_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
userlevelpermissions_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_userlevelid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userlevelpermissions->userlevelid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_userlevelid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($userlevelpermissions->userlevelid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ztablename"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userlevelpermissions->ztablename->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_permission"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userlevelpermissions->permission->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_permission"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($userlevelpermissions->permission->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
userlevelpermissions_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userlevelpermissions_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userlevelpermissions_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $userlevelpermissions->TableCaption() ?><br><br>
<a href="<?php echo $userlevelpermissions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userlevelpermissions_edit->ShowMessage();
?>
<form name="fuserlevelpermissionsedit" id="fuserlevelpermissionsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return userlevelpermissions_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="userlevelpermissions">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($userlevelpermissions->userlevelid->Visible) { // userlevelid ?>
	<tr<?php echo $userlevelpermissions->userlevelid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->userlevelid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userlevelpermissions->userlevelid->CellAttributes() ?>><span id="el_userlevelid">
<div<?php echo $userlevelpermissions->userlevelid->ViewAttributes() ?>><?php echo $userlevelpermissions->userlevelid->EditValue ?></div><input type="hidden" name="x_userlevelid" id="x_userlevelid" value="<?php echo ew_HtmlEncode($userlevelpermissions->userlevelid->CurrentValue) ?>">
</span><?php echo $userlevelpermissions->userlevelid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userlevelpermissions->ztablename->Visible) { // tablename ?>
	<tr<?php echo $userlevelpermissions->ztablename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->ztablename->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userlevelpermissions->ztablename->CellAttributes() ?>><span id="el_ztablename">
<div<?php echo $userlevelpermissions->ztablename->ViewAttributes() ?>><?php echo $userlevelpermissions->ztablename->EditValue ?></div><input type="hidden" name="x_ztablename" id="x_ztablename" value="<?php echo ew_HtmlEncode($userlevelpermissions->ztablename->CurrentValue) ?>">
</span><?php echo $userlevelpermissions->ztablename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
	<tr<?php echo $userlevelpermissions->permission->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userlevelpermissions->permission->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userlevelpermissions->permission->CellAttributes() ?>><span id="el_permission">
<input type="text" name="x_permission" id="x_permission" title="<?php echo $userlevelpermissions->permission->FldTitle() ?>" size="30" value="<?php echo $userlevelpermissions->permission->EditValue ?>"<?php echo $userlevelpermissions->permission->EditAttributes() ?>>
</span><?php echo $userlevelpermissions->permission->CustomMsg ?></td>
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
$userlevelpermissions_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserlevelpermissions_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'userlevelpermissions';

	// Page object name
	var $PageObjName = 'userlevelpermissions_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) $PageUrl .= "t=" . $userlevelpermissions->TableVar . "&"; // Add page token
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
		global $objForm, $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) {
			if ($objForm)
				return ($userlevelpermissions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($userlevelpermissions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuserlevelpermissions_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (userlevelpermissions)
		$GLOBALS["userlevelpermissions"] = new cuserlevelpermissions();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'userlevelpermissions', TRUE);

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
		global $userlevelpermissions;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $objForm, $Language, $gsFormError, $userlevelpermissions;

		// Load key from QueryString
		if (@$_GET["userlevelid"] <> "")
			$userlevelpermissions->userlevelid->setQueryStringValue($_GET["userlevelid"]);
		if (@$_GET["ztablename"] <> "")
			$userlevelpermissions->ztablename->setQueryStringValue($_GET["ztablename"]);
		if (@$_POST["a_edit"] <> "") {
			$userlevelpermissions->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$userlevelpermissions->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$userlevelpermissions->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$userlevelpermissions->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($userlevelpermissions->userlevelid->CurrentValue == "")
			$this->Page_Terminate("userlevelpermissionslist.php"); // Invalid key, return to list
		if ($userlevelpermissions->ztablename->CurrentValue == "")
			$this->Page_Terminate("userlevelpermissionslist.php"); // Invalid key, return to list
		switch ($userlevelpermissions->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("userlevelpermissionslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$userlevelpermissions->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $userlevelpermissions->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$userlevelpermissions->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$userlevelpermissions->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $userlevelpermissions;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $userlevelpermissions;
		$userlevelpermissions->userlevelid->setFormValue($objForm->GetValue("x_userlevelid"));
		$userlevelpermissions->ztablename->setFormValue($objForm->GetValue("x_ztablename"));
		$userlevelpermissions->permission->setFormValue($objForm->GetValue("x_permission"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $userlevelpermissions;
		$this->LoadRow();
		$userlevelpermissions->userlevelid->CurrentValue = $userlevelpermissions->userlevelid->FormValue;
		$userlevelpermissions->ztablename->CurrentValue = $userlevelpermissions->ztablename->FormValue;
		$userlevelpermissions->permission->CurrentValue = $userlevelpermissions->permission->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $userlevelpermissions;
		$sFilter = $userlevelpermissions->KeyFilter();

		// Call Row Selecting event
		$userlevelpermissions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$userlevelpermissions->CurrentFilter = $sFilter;
		$sSql = $userlevelpermissions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$userlevelpermissions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $userlevelpermissions;
		$userlevelpermissions->userlevelid->setDbValue($rs->fields('userlevelid'));
		$userlevelpermissions->ztablename->setDbValue($rs->fields('tablename'));
		$userlevelpermissions->permission->setDbValue($rs->fields('permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $userlevelpermissions;

		// Initialize URLs
		// Call Row_Rendering event

		$userlevelpermissions->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$userlevelpermissions->userlevelid->CellCssStyle = ""; $userlevelpermissions->userlevelid->CellCssClass = "";
		$userlevelpermissions->userlevelid->CellAttrs = array(); $userlevelpermissions->userlevelid->ViewAttrs = array(); $userlevelpermissions->userlevelid->EditAttrs = array();

		// tablename
		$userlevelpermissions->ztablename->CellCssStyle = ""; $userlevelpermissions->ztablename->CellCssClass = "";
		$userlevelpermissions->ztablename->CellAttrs = array(); $userlevelpermissions->ztablename->ViewAttrs = array(); $userlevelpermissions->ztablename->EditAttrs = array();

		// permission
		$userlevelpermissions->permission->CellCssStyle = ""; $userlevelpermissions->permission->CellCssClass = "";
		$userlevelpermissions->permission->CellAttrs = array(); $userlevelpermissions->permission->ViewAttrs = array(); $userlevelpermissions->permission->EditAttrs = array();
		if ($userlevelpermissions->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$userlevelpermissions->userlevelid->ViewValue = $userlevelpermissions->userlevelid->CurrentValue;
			$userlevelpermissions->userlevelid->CssStyle = "";
			$userlevelpermissions->userlevelid->CssClass = "";
			$userlevelpermissions->userlevelid->ViewCustomAttributes = "";

			// tablename
			$userlevelpermissions->ztablename->ViewValue = $userlevelpermissions->ztablename->CurrentValue;
			$userlevelpermissions->ztablename->CssStyle = "";
			$userlevelpermissions->ztablename->CssClass = "";
			$userlevelpermissions->ztablename->ViewCustomAttributes = "";

			// permission
			$userlevelpermissions->permission->ViewValue = $userlevelpermissions->permission->CurrentValue;
			$userlevelpermissions->permission->CssStyle = "";
			$userlevelpermissions->permission->CssClass = "";
			$userlevelpermissions->permission->ViewCustomAttributes = "";

			// userlevelid
			$userlevelpermissions->userlevelid->HrefValue = "";
			$userlevelpermissions->userlevelid->TooltipValue = "";

			// tablename
			$userlevelpermissions->ztablename->HrefValue = "";
			$userlevelpermissions->ztablename->TooltipValue = "";

			// permission
			$userlevelpermissions->permission->HrefValue = "";
			$userlevelpermissions->permission->TooltipValue = "";
		} elseif ($userlevelpermissions->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// userlevelid
			$userlevelpermissions->userlevelid->EditCustomAttributes = "";
			$userlevelpermissions->userlevelid->EditValue = $userlevelpermissions->userlevelid->CurrentValue;
			$userlevelpermissions->userlevelid->CssStyle = "";
			$userlevelpermissions->userlevelid->CssClass = "";
			$userlevelpermissions->userlevelid->ViewCustomAttributes = "";

			// tablename
			$userlevelpermissions->ztablename->EditCustomAttributes = "";
			$userlevelpermissions->ztablename->EditValue = $userlevelpermissions->ztablename->CurrentValue;
			$userlevelpermissions->ztablename->CssStyle = "";
			$userlevelpermissions->ztablename->CssClass = "";
			$userlevelpermissions->ztablename->ViewCustomAttributes = "";

			// permission
			$userlevelpermissions->permission->EditCustomAttributes = "";
			$userlevelpermissions->permission->EditValue = ew_HtmlEncode($userlevelpermissions->permission->CurrentValue);

			// Edit refer script
			// userlevelid

			$userlevelpermissions->userlevelid->HrefValue = "";

			// tablename
			$userlevelpermissions->ztablename->HrefValue = "";

			// permission
			$userlevelpermissions->permission->HrefValue = "";
		}

		// Call Row Rendered event
		if ($userlevelpermissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$userlevelpermissions->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $userlevelpermissions;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($userlevelpermissions->userlevelid->FormValue) && $userlevelpermissions->userlevelid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userlevelpermissions->userlevelid->FldCaption();
		}
		if (!ew_CheckInteger($userlevelpermissions->userlevelid->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $userlevelpermissions->userlevelid->FldErrMsg();
		}
		if (!is_null($userlevelpermissions->ztablename->FormValue) && $userlevelpermissions->ztablename->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userlevelpermissions->ztablename->FldCaption();
		}
		if (!is_null($userlevelpermissions->permission->FormValue) && $userlevelpermissions->permission->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userlevelpermissions->permission->FldCaption();
		}
		if (!ew_CheckInteger($userlevelpermissions->permission->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $userlevelpermissions->permission->FldErrMsg();
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
		global $conn, $Security, $Language, $userlevelpermissions;
		$sFilter = $userlevelpermissions->KeyFilter();
		$userlevelpermissions->CurrentFilter = $sFilter;
		$sSql = $userlevelpermissions->SQL();
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

			// tablename
			// permission

			$userlevelpermissions->permission->SetDbValueDef($rsnew, $userlevelpermissions->permission->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $userlevelpermissions->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($userlevelpermissions->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($userlevelpermissions->CancelMessage <> "") {
					$this->setMessage($userlevelpermissions->CancelMessage);
					$userlevelpermissions->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$userlevelpermissions->Row_Updated($rsold, $rsnew);
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
