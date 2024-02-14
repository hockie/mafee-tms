<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "all_file_uploadsinfo.php" ?>
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
$all_file_uploads_edit = new call_file_uploads_edit();
$Page =& $all_file_uploads_edit;

// Page init
$all_file_uploads_edit->Page_Init();

// Page main
$all_file_uploads_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var all_file_uploads_edit = new ew_Page("all_file_uploads_edit");

// page properties
all_file_uploads_edit.PageID = "edit"; // page ID
all_file_uploads_edit.FormID = "fall_file_uploadsedit"; // form ID
var EW_PAGE_ID = all_file_uploads_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
all_file_uploads_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_File_Name"];
		aelm = fobj.elements["a" + infix + "_File_Name"];
		var chk_File_Name = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_File_Name && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($all_file_uploads->File_Name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_File_Name"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_file_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($all_file_uploads->file_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
all_file_uploads_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
all_file_uploads_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
all_file_uploads_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
all_file_uploads_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 20;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {			
		var inst;			
		for (inst in CKEDITOR.instances)
			CKEDITOR.instances[inst].updateElement();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];		
		if (inst)
			inst.setData(inst.element.value);
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];	
		if (inst)
			inst.focus();
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $all_file_uploads->TableCaption() ?><br><br>
<a href="<?php echo $all_file_uploads->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$all_file_uploads_edit->ShowMessage();
?>
<form name="fall_file_uploadsedit" id="fall_file_uploadsedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return all_file_uploads_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="all_file_uploads">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($all_file_uploads->id->Visible) { // id ?>
	<tr<?php echo $all_file_uploads->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->id->FldCaption() ?></td>
		<td<?php echo $all_file_uploads->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $all_file_uploads->id->ViewAttributes() ?>><?php echo $all_file_uploads->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($all_file_uploads->id->CurrentValue) ?>">
</span><?php echo $all_file_uploads->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<input type="hidden" name="x_module" id="x_module" value="<?php echo ew_HtmlEncode($all_file_uploads->module->CurrentValue) ?>">
<?php if ($all_file_uploads->File_Name->Visible) { // File_Name ?>
	<tr<?php echo $all_file_uploads->File_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->File_Name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $all_file_uploads->File_Name->CellAttributes() ?>><span id="el_File_Name">
<div id="old_x_File_Name">
<?php if ($all_file_uploads->File_Name->HrefValue <> "" || $all_file_uploads->File_Name->TooltipValue <> "") { ?>
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<a href="<?php echo $all_file_uploads->File_Name->HrefValue ?>"><?php echo $all_file_uploads->File_Name->EditValue ?></a>
<?php } elseif (!in_array($all_file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<?php echo $all_file_uploads->File_Name->EditValue ?>
<?php } elseif (!in_array($all_file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_File_Name">
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<label><input type="radio" name="a_File_Name" id="a_File_Name" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_File_Name" id="a_File_Name" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_File_Name" id="a_File_Name" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $all_file_uploads->File_Name->EditAttrs["onchange"] = "this.form.a_File_Name[2].checked=true;" . @$all_file_uploads->File_Name->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_File_Name" id="a_File_Name" value="3">
<?php } ?>
<input type="file" name="x_File_Name" id="x_File_Name" title="<?php echo $all_file_uploads->File_Name->FldTitle() ?>" size="30"<?php echo $all_file_uploads->File_Name->EditAttributes() ?>>
</div>
</span><?php echo $all_file_uploads->File_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $all_file_uploads->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->Remarks->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $all_file_uploads->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $all_file_uploads->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $all_file_uploads->Remarks->EditAttributes() ?>><?php echo $all_file_uploads->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $all_file_uploads->Remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($all_file_uploads->file_id->Visible) { // file_id ?>
	<tr<?php echo $all_file_uploads->file_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $all_file_uploads->file_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $all_file_uploads->file_id->CellAttributes() ?>><span id="el_file_id">
<?php if ($all_file_uploads->file_id->getSessionValue() <> "") { ?>
<div<?php echo $all_file_uploads->file_id->ViewAttributes() ?>><?php echo $all_file_uploads->file_id->ViewValue ?></div>
<input type="hidden" id="x_file_id" name="x_file_id" value="<?php echo ew_HtmlEncode($all_file_uploads->file_id->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_file_id" id="x_file_id" title="<?php echo $all_file_uploads->file_id->FldTitle() ?>" size="30" value="<?php echo $all_file_uploads->file_id->EditValue ?>"<?php echo $all_file_uploads->file_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $all_file_uploads->file_id->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$all_file_uploads_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class call_file_uploads_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'all_file_uploads';

	// Page object name
	var $PageObjName = 'all_file_uploads_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $all_file_uploads;
		if ($all_file_uploads->UseTokenInUrl) $PageUrl .= "t=" . $all_file_uploads->TableVar . "&"; // Add page token
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
		global $objForm, $all_file_uploads;
		if ($all_file_uploads->UseTokenInUrl) {
			if ($objForm)
				return ($all_file_uploads->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($all_file_uploads->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function call_file_uploads_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (all_file_uploads)
		$GLOBALS["all_file_uploads"] = new call_file_uploads();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'all_file_uploads', TRUE);

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
		global $all_file_uploads;

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
			$this->Page_Terminate("all_file_uploadslist.php");
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
		global $objForm, $Language, $gsFormError, $all_file_uploads;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$all_file_uploads->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$all_file_uploads->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$all_file_uploads->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$all_file_uploads->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$all_file_uploads->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($all_file_uploads->id->CurrentValue == "")
			$this->Page_Terminate("all_file_uploadslist.php"); // Invalid key, return to list
		switch ($all_file_uploads->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("all_file_uploadslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$all_file_uploads->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $all_file_uploads->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$all_file_uploads->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$all_file_uploads->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $all_file_uploads;

		// Get upload data
			if ($all_file_uploads->File_Name->Upload->UploadFile()) {

				// No action required
			} else {
				echo $all_file_uploads->File_Name->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $all_file_uploads;
		$all_file_uploads->id->setFormValue($objForm->GetValue("x_id"));
		$all_file_uploads->module->setFormValue($objForm->GetValue("x_module"));
		$all_file_uploads->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$all_file_uploads->Modified->setFormValue($objForm->GetValue("x_Modified"));
		$all_file_uploads->Modified->CurrentValue = ew_UnFormatDateTime($all_file_uploads->Modified->CurrentValue, 6);
		$all_file_uploads->user_id->setFormValue($objForm->GetValue("x_user_id"));
		$all_file_uploads->file_id->setFormValue($objForm->GetValue("x_file_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $all_file_uploads;
		$this->LoadRow();
		$all_file_uploads->id->CurrentValue = $all_file_uploads->id->FormValue;
		$all_file_uploads->module->CurrentValue = $all_file_uploads->module->FormValue;
		$all_file_uploads->Remarks->CurrentValue = $all_file_uploads->Remarks->FormValue;
		$all_file_uploads->Modified->CurrentValue = $all_file_uploads->Modified->FormValue;
		$all_file_uploads->Modified->CurrentValue = ew_UnFormatDateTime($all_file_uploads->Modified->CurrentValue, 6);
		$all_file_uploads->user_id->CurrentValue = $all_file_uploads->user_id->FormValue;
		$all_file_uploads->file_id->CurrentValue = $all_file_uploads->file_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $all_file_uploads;
		$sFilter = $all_file_uploads->KeyFilter();

		// Call Row Selecting event
		$all_file_uploads->Row_Selecting($sFilter);

		// Load SQL based on filter
		$all_file_uploads->CurrentFilter = $sFilter;
		$sSql = $all_file_uploads->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$all_file_uploads->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $all_file_uploads;
		$all_file_uploads->id->setDbValue($rs->fields('id'));
		$all_file_uploads->module->setDbValue($rs->fields('module'));
		$all_file_uploads->File_Name->Upload->DbValue = $rs->fields('File_Name');
		$all_file_uploads->Remarks->setDbValue($rs->fields('Remarks'));
		$all_file_uploads->Created->setDbValue($rs->fields('Created'));
		$all_file_uploads->Modified->setDbValue($rs->fields('Modified'));
		$all_file_uploads->user_id->setDbValue($rs->fields('user_id'));
		$all_file_uploads->file_id->setDbValue($rs->fields('file_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $all_file_uploads;

		// Initialize URLs
		// Call Row_Rendering event

		$all_file_uploads->Row_Rendering();

		// Common render codes for all row types
		// id

		$all_file_uploads->id->CellCssStyle = ""; $all_file_uploads->id->CellCssClass = "";
		$all_file_uploads->id->CellAttrs = array(); $all_file_uploads->id->ViewAttrs = array(); $all_file_uploads->id->EditAttrs = array();

		// module
		$all_file_uploads->module->CellCssStyle = ""; $all_file_uploads->module->CellCssClass = "";
		$all_file_uploads->module->CellAttrs = array(); $all_file_uploads->module->ViewAttrs = array(); $all_file_uploads->module->EditAttrs = array();

		// File_Name
		$all_file_uploads->File_Name->CellCssStyle = ""; $all_file_uploads->File_Name->CellCssClass = "";
		$all_file_uploads->File_Name->CellAttrs = array(); $all_file_uploads->File_Name->ViewAttrs = array(); $all_file_uploads->File_Name->EditAttrs = array();

		// Remarks
		$all_file_uploads->Remarks->CellCssStyle = ""; $all_file_uploads->Remarks->CellCssClass = "";
		$all_file_uploads->Remarks->CellAttrs = array(); $all_file_uploads->Remarks->ViewAttrs = array(); $all_file_uploads->Remarks->EditAttrs = array();

		// Modified
		$all_file_uploads->Modified->CellCssStyle = ""; $all_file_uploads->Modified->CellCssClass = "";
		$all_file_uploads->Modified->CellAttrs = array(); $all_file_uploads->Modified->ViewAttrs = array(); $all_file_uploads->Modified->EditAttrs = array();

		// user_id
		$all_file_uploads->user_id->CellCssStyle = ""; $all_file_uploads->user_id->CellCssClass = "";
		$all_file_uploads->user_id->CellAttrs = array(); $all_file_uploads->user_id->ViewAttrs = array(); $all_file_uploads->user_id->EditAttrs = array();

		// file_id
		$all_file_uploads->file_id->CellCssStyle = ""; $all_file_uploads->file_id->CellCssClass = "";
		$all_file_uploads->file_id->CellAttrs = array(); $all_file_uploads->file_id->ViewAttrs = array(); $all_file_uploads->file_id->EditAttrs = array();
		if ($all_file_uploads->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$all_file_uploads->id->ViewValue = $all_file_uploads->id->CurrentValue;
			$all_file_uploads->id->CssStyle = "";
			$all_file_uploads->id->CssClass = "";
			$all_file_uploads->id->ViewCustomAttributes = "";

			// module
			$all_file_uploads->module->ViewValue = $all_file_uploads->module->CurrentValue;
			$all_file_uploads->module->CssStyle = "";
			$all_file_uploads->module->CssClass = "";
			$all_file_uploads->module->ViewCustomAttributes = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->ViewValue = $all_file_uploads->File_Name->Upload->DbValue;
			} else {
				$all_file_uploads->File_Name->ViewValue = "";
			}
			$all_file_uploads->File_Name->CssStyle = "";
			$all_file_uploads->File_Name->CssClass = "";
			$all_file_uploads->File_Name->ViewCustomAttributes = "";

			// Remarks
			$all_file_uploads->Remarks->ViewValue = $all_file_uploads->Remarks->CurrentValue;
			$all_file_uploads->Remarks->CssStyle = "";
			$all_file_uploads->Remarks->CssClass = "";
			$all_file_uploads->Remarks->ViewCustomAttributes = "";

			// Created
			$all_file_uploads->Created->ViewValue = $all_file_uploads->Created->CurrentValue;
			$all_file_uploads->Created->ViewValue = ew_FormatDateTime($all_file_uploads->Created->ViewValue, 6);
			$all_file_uploads->Created->CssStyle = "";
			$all_file_uploads->Created->CssClass = "";
			$all_file_uploads->Created->ViewCustomAttributes = "";

			// Modified
			$all_file_uploads->Modified->ViewValue = $all_file_uploads->Modified->CurrentValue;
			$all_file_uploads->Modified->ViewValue = ew_FormatDateTime($all_file_uploads->Modified->ViewValue, 6);
			$all_file_uploads->Modified->CssStyle = "";
			$all_file_uploads->Modified->CssClass = "";
			$all_file_uploads->Modified->ViewCustomAttributes = "";

			// user_id
			$all_file_uploads->user_id->ViewValue = $all_file_uploads->user_id->CurrentValue;
			$all_file_uploads->user_id->CssStyle = "";
			$all_file_uploads->user_id->CssClass = "";
			$all_file_uploads->user_id->ViewCustomAttributes = "";

			// file_id
			$all_file_uploads->file_id->ViewValue = $all_file_uploads->file_id->CurrentValue;
			$all_file_uploads->file_id->CssStyle = "";
			$all_file_uploads->file_id->CssClass = "";
			$all_file_uploads->file_id->ViewCustomAttributes = "";

			// id
			$all_file_uploads->id->HrefValue = "";
			$all_file_uploads->id->TooltipValue = "";

			// module
			$all_file_uploads->module->HrefValue = "";
			$all_file_uploads->module->TooltipValue = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->HrefValue = ew_UploadPathEx(FALSE, $all_file_uploads->File_Name->UploadPath) . ((!empty($all_file_uploads->File_Name->ViewValue)) ? $all_file_uploads->File_Name->ViewValue : $all_file_uploads->File_Name->CurrentValue);
				if ($all_file_uploads->Export <> "") $all_file_uploads->File_Name->HrefValue = ew_ConvertFullUrl($all_file_uploads->File_Name->HrefValue);
			} else {
				$all_file_uploads->File_Name->HrefValue = "";
			}
			$all_file_uploads->File_Name->TooltipValue = "";

			// Remarks
			$all_file_uploads->Remarks->HrefValue = "";
			$all_file_uploads->Remarks->TooltipValue = "";

			// Modified
			$all_file_uploads->Modified->HrefValue = "";
			$all_file_uploads->Modified->TooltipValue = "";

			// user_id
			$all_file_uploads->user_id->HrefValue = "";
			$all_file_uploads->user_id->TooltipValue = "";

			// file_id
			$all_file_uploads->file_id->HrefValue = "";
			$all_file_uploads->file_id->TooltipValue = "";
		} elseif ($all_file_uploads->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$all_file_uploads->id->EditCustomAttributes = "";
			$all_file_uploads->id->EditValue = $all_file_uploads->id->CurrentValue;
			$all_file_uploads->id->CssStyle = "";
			$all_file_uploads->id->CssClass = "";
			$all_file_uploads->id->ViewCustomAttributes = "";

			// module
			$all_file_uploads->module->EditCustomAttributes = "";

			// File_Name
			$all_file_uploads->File_Name->EditCustomAttributes = "";
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->EditValue = $all_file_uploads->File_Name->Upload->DbValue;
			} else {
				$all_file_uploads->File_Name->EditValue = "";
			}

			// Remarks
			$all_file_uploads->Remarks->EditCustomAttributes = "";
			$all_file_uploads->Remarks->EditValue = ew_HtmlEncode($all_file_uploads->Remarks->CurrentValue);

			// Modified
			// user_id
			// file_id

			$all_file_uploads->file_id->EditCustomAttributes = "";
			if ($all_file_uploads->file_id->getSessionValue() <> "") {
				$all_file_uploads->file_id->CurrentValue = $all_file_uploads->file_id->getSessionValue();
			$all_file_uploads->file_id->ViewValue = $all_file_uploads->file_id->CurrentValue;
			$all_file_uploads->file_id->CssStyle = "";
			$all_file_uploads->file_id->CssClass = "";
			$all_file_uploads->file_id->ViewCustomAttributes = "";
			} else {
			$all_file_uploads->file_id->EditValue = ew_HtmlEncode($all_file_uploads->file_id->CurrentValue);
			}

			// Edit refer script
			// id

			$all_file_uploads->id->HrefValue = "";

			// module
			$all_file_uploads->module->HrefValue = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->HrefValue = ew_UploadPathEx(FALSE, $all_file_uploads->File_Name->UploadPath) . ((!empty($all_file_uploads->File_Name->EditValue)) ? $all_file_uploads->File_Name->EditValue : $all_file_uploads->File_Name->CurrentValue);
				if ($all_file_uploads->Export <> "") $all_file_uploads->File_Name->HrefValue = ew_ConvertFullUrl($all_file_uploads->File_Name->HrefValue);
			} else {
				$all_file_uploads->File_Name->HrefValue = "";
			}

			// Remarks
			$all_file_uploads->Remarks->HrefValue = "";

			// Modified
			$all_file_uploads->Modified->HrefValue = "";

			// user_id
			$all_file_uploads->user_id->HrefValue = "";

			// file_id
			$all_file_uploads->file_id->HrefValue = "";
		}

		// Call Row Rendered event
		if ($all_file_uploads->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$all_file_uploads->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $all_file_uploads;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($all_file_uploads->File_Name->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($all_file_uploads->File_Name->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $all_file_uploads->File_Name->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($all_file_uploads->File_Name->Upload->Action == "3" && is_null($all_file_uploads->File_Name->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $all_file_uploads->File_Name->FldCaption();
		}
		if (!ew_CheckInteger($all_file_uploads->file_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $all_file_uploads->file_id->FldErrMsg();
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
		global $conn, $Security, $Language, $all_file_uploads;
		$sFilter = $all_file_uploads->KeyFilter();
		$all_file_uploads->CurrentFilter = $sFilter;
		$sSql = $all_file_uploads->SQL();
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

			// module
			$all_file_uploads->module->SetDbValueDef($rsnew, $all_file_uploads->module->CurrentValue, "", FALSE);

			// File_Name
			$all_file_uploads->File_Name->Upload->SaveToSession(); // Save file value to Session
						if ($all_file_uploads->File_Name->Upload->Action == "2" || $all_file_uploads->File_Name->Upload->Action == "3") { // Update/Remove
			$all_file_uploads->File_Name->Upload->DbValue = $rs->fields('File_Name'); // Get original value
			if (is_null($all_file_uploads->File_Name->Upload->Value)) {
				$rsnew['File_Name'] = NULL;
			} else {
				$rsnew['File_Name'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $all_file_uploads->File_Name->UploadPath), $all_file_uploads->File_Name->Upload->FileName);
			}
			}

			// Remarks
			$all_file_uploads->Remarks->SetDbValueDef($rsnew, $all_file_uploads->Remarks->CurrentValue, "", FALSE);

			// Modified
			$all_file_uploads->Modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['Modified'] =& $all_file_uploads->Modified->DbValue;

			// user_id
			$all_file_uploads->user_id->SetDbValueDef($rsnew, CurrentUserID(), 0);
			$rsnew['user_id'] =& $all_file_uploads->user_id->DbValue;

			// file_id
			$all_file_uploads->file_id->SetDbValueDef($rsnew, $all_file_uploads->file_id->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $all_file_uploads->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($all_file_uploads->File_Name->Upload->Value)) {
				$all_file_uploads->File_Name->Upload->SaveToFile($all_file_uploads->File_Name->UploadPath, $rsnew['File_Name'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($all_file_uploads->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($all_file_uploads->CancelMessage <> "") {
					$this->setMessage($all_file_uploads->CancelMessage);
					$all_file_uploads->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$all_file_uploads->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// File_Name
		$all_file_uploads->File_Name->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $all_file_uploads;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "account_payments") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $all_file_uploads->SqlMasterFilter_account_payments();
				$this->sDbDetailFilter = $all_file_uploads->SqlDetailFilter_account_payments();
				if (@$_GET["id"] <> "") {
					$GLOBALS["account_payments"]->id->setQueryStringValue($_GET["id"]);
					$all_file_uploads->file_id->setQueryStringValue($GLOBALS["account_payments"]->id->QueryStringValue);
					$all_file_uploads->file_id->setSessionValue($all_file_uploads->file_id->QueryStringValue);
					if (!is_numeric($GLOBALS["account_payments"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["account_payments"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@file_id@", ew_AdjustSql($GLOBALS["account_payments"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$all_file_uploads->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
			$all_file_uploads->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$all_file_uploads->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "account_payments") {
				if ($all_file_uploads->file_id->QueryStringValue == "") $all_file_uploads->file_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $all_file_uploads->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $all_file_uploads->getDetailFilter(); // Restore detail filter
		}
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
