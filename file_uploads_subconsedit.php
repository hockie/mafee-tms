<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_uploads_subconsinfo.php" ?>
<?php include "subconsinfo.php" ?>
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
$file_uploads_subcons_edit = new cfile_uploads_subcons_edit();
$Page =& $file_uploads_subcons_edit;

// Page init
$file_uploads_subcons_edit->Page_Init();

// Page main
$file_uploads_subcons_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var file_uploads_subcons_edit = new ew_Page("file_uploads_subcons_edit");

// page properties
file_uploads_subcons_edit.PageID = "edit"; // page ID
file_uploads_subcons_edit.FormID = "ffile_uploads_subconsedit"; // form ID
var EW_PAGE_ID = file_uploads_subcons_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
file_uploads_subcons_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Filename"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_Modified"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($file_uploads_subcons->Modified->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
file_uploads_subcons_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
file_uploads_subcons_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
file_uploads_subcons_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_uploads_subcons_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_uploads_subcons->TableCaption() ?><br><br>
<a href="<?php echo $file_uploads_subcons->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_uploads_subcons_edit->ShowMessage();
?>
<form name="ffile_uploads_subconsedit" id="ffile_uploads_subconsedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return file_uploads_subcons_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="file_uploads_subcons">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($file_uploads_subcons->id->Visible) { // id ?>
	<tr<?php echo $file_uploads_subcons->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->id->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $file_uploads_subcons->id->ViewAttributes() ?>><?php echo $file_uploads_subcons->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($file_uploads_subcons->id->CurrentValue) ?>">
</span><?php echo $file_uploads_subcons->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Subcon_ID->Visible) { // Subcon_ID ?>
	<tr<?php echo $file_uploads_subcons->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Subcon_ID->CellAttributes() ?>><span id="el_Subcon_ID">
<?php if ($file_uploads_subcons->Subcon_ID->getSessionValue() <> "") { ?>
<div<?php echo $file_uploads_subcons->Subcon_ID->ViewAttributes() ?>><?php echo $file_uploads_subcons->Subcon_ID->ViewValue ?></div>
<input type="hidden" id="x_Subcon_ID" name="x_Subcon_ID" value="<?php echo ew_HtmlEncode($file_uploads_subcons->Subcon_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Subcon_ID" name="x_Subcon_ID" title="<?php echo $file_uploads_subcons->Subcon_ID->FldTitle() ?>"<?php echo $file_uploads_subcons->Subcon_ID->EditAttributes() ?>>
<?php
if (is_array($file_uploads_subcons->Subcon_ID->EditValue)) {
	$arwrk = $file_uploads_subcons->Subcon_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($file_uploads_subcons->Subcon_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $file_uploads_subcons->Subcon_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Filename->Visible) { // Filename ?>
	<tr<?php echo $file_uploads_subcons->Filename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Filename->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Filename->CellAttributes() ?>><span id="el_Filename">
<div id="old_x_Filename">
<?php if ($file_uploads_subcons->Filename->HrefValue <> "" || $file_uploads_subcons->Filename->TooltipValue <> "") { ?>
<?php if (!empty($file_uploads_subcons->Filename->Upload->DbValue)) { ?>
<a href="<?php echo $file_uploads_subcons->Filename->HrefValue ?>"><?php echo $file_uploads_subcons->Filename->EditValue ?></a>
<?php } elseif (!in_array($file_uploads_subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($file_uploads_subcons->Filename->Upload->DbValue)) { ?>
<?php echo $file_uploads_subcons->Filename->EditValue ?>
<?php } elseif (!in_array($file_uploads_subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_Filename">
<?php if (!empty($file_uploads_subcons->Filename->Upload->DbValue)) { ?>
<label><input type="radio" name="a_Filename" id="a_Filename" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_Filename" id="a_Filename" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_Filename" id="a_Filename" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $file_uploads_subcons->Filename->EditAttrs["onchange"] = "this.form.a_Filename[2].checked=true;" . @$file_uploads_subcons->Filename->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_Filename" id="a_Filename" value="3">
<?php } ?>
<input type="file" name="x_Filename" id="x_Filename" title="<?php echo $file_uploads_subcons->Filename->FldTitle() ?>" size="30"<?php echo $file_uploads_subcons->Filename->EditAttributes() ?>>
</div>
</span><?php echo $file_uploads_subcons->Filename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->File_Type_ID->Visible) { // File_Type_ID ?>
	<tr<?php echo $file_uploads_subcons->File_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->File_Type_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->File_Type_ID->CellAttributes() ?>><span id="el_File_Type_ID">
<select id="x_File_Type_ID" name="x_File_Type_ID" title="<?php echo $file_uploads_subcons->File_Type_ID->FldTitle() ?>"<?php echo $file_uploads_subcons->File_Type_ID->EditAttributes() ?>>
<?php
if (is_array($file_uploads_subcons->File_Type_ID->EditValue)) {
	$arwrk = $file_uploads_subcons->File_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($file_uploads_subcons->File_Type_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $file_uploads_subcons->File_Type_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Modified->Visible) { // Modified ?>
	<tr<?php echo $file_uploads_subcons->Modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Modified->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Modified->CellAttributes() ?>><span id="el_Modified">
<input type="text" name="x_Modified" id="x_Modified" title="<?php echo $file_uploads_subcons->Modified->FldTitle() ?>" value="<?php echo $file_uploads_subcons->Modified->EditValue ?>"<?php echo $file_uploads_subcons->Modified->EditAttributes() ?>>
</span><?php echo $file_uploads_subcons->Modified->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $file_uploads_subcons->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Remarks->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $file_uploads_subcons->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $file_uploads_subcons->Remarks->EditAttributes() ?>><?php echo $file_uploads_subcons->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $file_uploads_subcons->Remarks->CustomMsg ?></td>
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
$file_uploads_subcons_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_uploads_subcons_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'file_uploads_subcons';

	// Page object name
	var $PageObjName = 'file_uploads_subcons_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_uploads_subcons;
		if ($file_uploads_subcons->UseTokenInUrl) $PageUrl .= "t=" . $file_uploads_subcons->TableVar . "&"; // Add page token
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
		global $objForm, $file_uploads_subcons;
		if ($file_uploads_subcons->UseTokenInUrl) {
			if ($objForm)
				return ($file_uploads_subcons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_uploads_subcons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_uploads_subcons_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_uploads_subcons)
		$GLOBALS["file_uploads_subcons"] = new cfile_uploads_subcons();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_uploads_subcons', TRUE);

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
		global $file_uploads_subcons;

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
			$this->Page_Terminate("file_uploads_subconslist.php");
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
		global $objForm, $Language, $gsFormError, $file_uploads_subcons;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$file_uploads_subcons->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$file_uploads_subcons->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$file_uploads_subcons->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$file_uploads_subcons->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$file_uploads_subcons->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($file_uploads_subcons->id->CurrentValue == "")
			$this->Page_Terminate("file_uploads_subconslist.php"); // Invalid key, return to list
		switch ($file_uploads_subcons->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("file_uploads_subconslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$file_uploads_subcons->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $file_uploads_subcons->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$file_uploads_subcons->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$file_uploads_subcons->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $file_uploads_subcons;

		// Get upload data
			if ($file_uploads_subcons->Filename->Upload->UploadFile()) {

				// No action required
			} else {
				echo $file_uploads_subcons->Filename->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $file_uploads_subcons;
		$file_uploads_subcons->id->setFormValue($objForm->GetValue("x_id"));
		$file_uploads_subcons->Subcon_ID->setFormValue($objForm->GetValue("x_Subcon_ID"));
		$file_uploads_subcons->File_Type_ID->setFormValue($objForm->GetValue("x_File_Type_ID"));
		$file_uploads_subcons->Modified->setFormValue($objForm->GetValue("x_Modified"));
		$file_uploads_subcons->Modified->CurrentValue = ew_UnFormatDateTime($file_uploads_subcons->Modified->CurrentValue, 6);
		$file_uploads_subcons->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $file_uploads_subcons;
		$this->LoadRow();
		$file_uploads_subcons->id->CurrentValue = $file_uploads_subcons->id->FormValue;
		$file_uploads_subcons->Subcon_ID->CurrentValue = $file_uploads_subcons->Subcon_ID->FormValue;
		$file_uploads_subcons->File_Type_ID->CurrentValue = $file_uploads_subcons->File_Type_ID->FormValue;
		$file_uploads_subcons->Modified->CurrentValue = $file_uploads_subcons->Modified->FormValue;
		$file_uploads_subcons->Modified->CurrentValue = ew_UnFormatDateTime($file_uploads_subcons->Modified->CurrentValue, 6);
		$file_uploads_subcons->Remarks->CurrentValue = $file_uploads_subcons->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_uploads_subcons;
		$sFilter = $file_uploads_subcons->KeyFilter();

		// Call Row Selecting event
		$file_uploads_subcons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_uploads_subcons->CurrentFilter = $sFilter;
		$sSql = $file_uploads_subcons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_uploads_subcons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_uploads_subcons;
		$file_uploads_subcons->id->setDbValue($rs->fields('id'));
		$file_uploads_subcons->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$file_uploads_subcons->Filename->Upload->DbValue = $rs->fields('Filename');
		$file_uploads_subcons->File_Type_ID->setDbValue($rs->fields('File_Type_ID'));
		$file_uploads_subcons->Created->setDbValue($rs->fields('Created'));
		$file_uploads_subcons->Modified->setDbValue($rs->fields('Modified'));
		$file_uploads_subcons->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_uploads_subcons;

		// Initialize URLs
		// Call Row_Rendering event

		$file_uploads_subcons->Row_Rendering();

		// Common render codes for all row types
		// id

		$file_uploads_subcons->id->CellCssStyle = ""; $file_uploads_subcons->id->CellCssClass = "";
		$file_uploads_subcons->id->CellAttrs = array(); $file_uploads_subcons->id->ViewAttrs = array(); $file_uploads_subcons->id->EditAttrs = array();

		// Subcon_ID
		$file_uploads_subcons->Subcon_ID->CellCssStyle = ""; $file_uploads_subcons->Subcon_ID->CellCssClass = "";
		$file_uploads_subcons->Subcon_ID->CellAttrs = array(); $file_uploads_subcons->Subcon_ID->ViewAttrs = array(); $file_uploads_subcons->Subcon_ID->EditAttrs = array();

		// Filename
		$file_uploads_subcons->Filename->CellCssStyle = ""; $file_uploads_subcons->Filename->CellCssClass = "";
		$file_uploads_subcons->Filename->CellAttrs = array(); $file_uploads_subcons->Filename->ViewAttrs = array(); $file_uploads_subcons->Filename->EditAttrs = array();

		// File_Type_ID
		$file_uploads_subcons->File_Type_ID->CellCssStyle = ""; $file_uploads_subcons->File_Type_ID->CellCssClass = "";
		$file_uploads_subcons->File_Type_ID->CellAttrs = array(); $file_uploads_subcons->File_Type_ID->ViewAttrs = array(); $file_uploads_subcons->File_Type_ID->EditAttrs = array();

		// Modified
		$file_uploads_subcons->Modified->CellCssStyle = ""; $file_uploads_subcons->Modified->CellCssClass = "";
		$file_uploads_subcons->Modified->CellAttrs = array(); $file_uploads_subcons->Modified->ViewAttrs = array(); $file_uploads_subcons->Modified->EditAttrs = array();

		// Remarks
		$file_uploads_subcons->Remarks->CellCssStyle = ""; $file_uploads_subcons->Remarks->CellCssClass = "";
		$file_uploads_subcons->Remarks->CellAttrs = array(); $file_uploads_subcons->Remarks->ViewAttrs = array(); $file_uploads_subcons->Remarks->EditAttrs = array();
		if ($file_uploads_subcons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_uploads_subcons->id->ViewValue = $file_uploads_subcons->id->CurrentValue;
			$file_uploads_subcons->id->CssStyle = "";
			$file_uploads_subcons->id->CssClass = "";
			$file_uploads_subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($file_uploads_subcons->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads_subcons->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads_subcons->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$file_uploads_subcons->Subcon_ID->ViewValue = $file_uploads_subcons->Subcon_ID->CurrentValue;
				}
			} else {
				$file_uploads_subcons->Subcon_ID->ViewValue = NULL;
			}
			$file_uploads_subcons->Subcon_ID->CssStyle = "";
			$file_uploads_subcons->Subcon_ID->CssClass = "";
			$file_uploads_subcons->Subcon_ID->ViewCustomAttributes = "";

			// Filename
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->ViewValue = $file_uploads_subcons->Filename->Upload->DbValue;
			} else {
				$file_uploads_subcons->Filename->ViewValue = "";
			}
			$file_uploads_subcons->Filename->CssStyle = "";
			$file_uploads_subcons->Filename->CssClass = "";
			$file_uploads_subcons->Filename->ViewCustomAttributes = "";

			// File_Type_ID
			if (strval($file_uploads_subcons->File_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads_subcons->File_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `File_Type` FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads_subcons->File_Type_ID->ViewValue = $rswrk->fields('File_Type');
					$rswrk->Close();
				} else {
					$file_uploads_subcons->File_Type_ID->ViewValue = $file_uploads_subcons->File_Type_ID->CurrentValue;
				}
			} else {
				$file_uploads_subcons->File_Type_ID->ViewValue = NULL;
			}
			$file_uploads_subcons->File_Type_ID->CssStyle = "";
			$file_uploads_subcons->File_Type_ID->CssClass = "";
			$file_uploads_subcons->File_Type_ID->ViewCustomAttributes = "";

			// Created
			$file_uploads_subcons->Created->ViewValue = $file_uploads_subcons->Created->CurrentValue;
			$file_uploads_subcons->Created->ViewValue = ew_FormatDateTime($file_uploads_subcons->Created->ViewValue, 6);
			$file_uploads_subcons->Created->CssStyle = "";
			$file_uploads_subcons->Created->CssClass = "";
			$file_uploads_subcons->Created->ViewCustomAttributes = "";

			// Modified
			$file_uploads_subcons->Modified->ViewValue = $file_uploads_subcons->Modified->CurrentValue;
			$file_uploads_subcons->Modified->ViewValue = ew_FormatDateTime($file_uploads_subcons->Modified->ViewValue, 6);
			$file_uploads_subcons->Modified->CssStyle = "";
			$file_uploads_subcons->Modified->CssClass = "";
			$file_uploads_subcons->Modified->ViewCustomAttributes = "";

			// Remarks
			$file_uploads_subcons->Remarks->ViewValue = $file_uploads_subcons->Remarks->CurrentValue;
			$file_uploads_subcons->Remarks->CssStyle = "";
			$file_uploads_subcons->Remarks->CssClass = "";
			$file_uploads_subcons->Remarks->ViewCustomAttributes = "";

			// id
			$file_uploads_subcons->id->HrefValue = "";
			$file_uploads_subcons->id->TooltipValue = "";

			// Subcon_ID
			$file_uploads_subcons->Subcon_ID->HrefValue = "";
			$file_uploads_subcons->Subcon_ID->TooltipValue = "";

			// Filename
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads_subcons->Filename->UploadPath) . ((!empty($file_uploads_subcons->Filename->ViewValue)) ? $file_uploads_subcons->Filename->ViewValue : $file_uploads_subcons->Filename->CurrentValue);
				if ($file_uploads_subcons->Export <> "") $file_uploads_subcons->Filename->HrefValue = ew_ConvertFullUrl($file_uploads_subcons->Filename->HrefValue);
			} else {
				$file_uploads_subcons->Filename->HrefValue = "";
			}
			$file_uploads_subcons->Filename->TooltipValue = "";

			// File_Type_ID
			$file_uploads_subcons->File_Type_ID->HrefValue = "";
			$file_uploads_subcons->File_Type_ID->TooltipValue = "";

			// Modified
			$file_uploads_subcons->Modified->HrefValue = "";
			$file_uploads_subcons->Modified->TooltipValue = "";

			// Remarks
			$file_uploads_subcons->Remarks->HrefValue = "";
			$file_uploads_subcons->Remarks->TooltipValue = "";
		} elseif ($file_uploads_subcons->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$file_uploads_subcons->id->EditCustomAttributes = "";
			$file_uploads_subcons->id->EditValue = $file_uploads_subcons->id->CurrentValue;
			$file_uploads_subcons->id->CssStyle = "";
			$file_uploads_subcons->id->CssClass = "";
			$file_uploads_subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			$file_uploads_subcons->Subcon_ID->EditCustomAttributes = "";
			if ($file_uploads_subcons->Subcon_ID->getSessionValue() <> "") {
				$file_uploads_subcons->Subcon_ID->CurrentValue = $file_uploads_subcons->Subcon_ID->getSessionValue();
			if (strval($file_uploads_subcons->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads_subcons->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads_subcons->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$file_uploads_subcons->Subcon_ID->ViewValue = $file_uploads_subcons->Subcon_ID->CurrentValue;
				}
			} else {
				$file_uploads_subcons->Subcon_ID->ViewValue = NULL;
			}
			$file_uploads_subcons->Subcon_ID->CssStyle = "";
			$file_uploads_subcons->Subcon_ID->CssClass = "";
			$file_uploads_subcons->Subcon_ID->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Subcon_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$file_uploads_subcons->Subcon_ID->EditValue = $arwrk;
			}

			// Filename
			$file_uploads_subcons->Filename->EditCustomAttributes = "";
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->EditValue = $file_uploads_subcons->Filename->Upload->DbValue;
			} else {
				$file_uploads_subcons->Filename->EditValue = "";
			}

			// File_Type_ID
			$file_uploads_subcons->File_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `File_Type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$file_uploads_subcons->File_Type_ID->EditValue = $arwrk;

			// Modified
			$file_uploads_subcons->Modified->EditCustomAttributes = "";
			$file_uploads_subcons->Modified->EditValue = ew_HtmlEncode(ew_FormatDateTime($file_uploads_subcons->Modified->CurrentValue, 6));

			// Remarks
			$file_uploads_subcons->Remarks->EditCustomAttributes = "";
			$file_uploads_subcons->Remarks->EditValue = ew_HtmlEncode($file_uploads_subcons->Remarks->CurrentValue);

			// Edit refer script
			// id

			$file_uploads_subcons->id->HrefValue = "";

			// Subcon_ID
			$file_uploads_subcons->Subcon_ID->HrefValue = "";

			// Filename
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads_subcons->Filename->UploadPath) . ((!empty($file_uploads_subcons->Filename->EditValue)) ? $file_uploads_subcons->Filename->EditValue : $file_uploads_subcons->Filename->CurrentValue);
				if ($file_uploads_subcons->Export <> "") $file_uploads_subcons->Filename->HrefValue = ew_ConvertFullUrl($file_uploads_subcons->Filename->HrefValue);
			} else {
				$file_uploads_subcons->Filename->HrefValue = "";
			}

			// File_Type_ID
			$file_uploads_subcons->File_Type_ID->HrefValue = "";

			// Modified
			$file_uploads_subcons->Modified->HrefValue = "";

			// Remarks
			$file_uploads_subcons->Remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($file_uploads_subcons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_uploads_subcons->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $file_uploads_subcons;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($file_uploads_subcons->Filename->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($file_uploads_subcons->Filename->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $file_uploads_subcons->Filename->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckUSDate($file_uploads_subcons->Modified->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $file_uploads_subcons->Modified->FldErrMsg();
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
		global $conn, $Security, $Language, $file_uploads_subcons;
		$sFilter = $file_uploads_subcons->KeyFilter();
		$file_uploads_subcons->CurrentFilter = $sFilter;
		$sSql = $file_uploads_subcons->SQL();
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

			// Subcon_ID
			$file_uploads_subcons->Subcon_ID->SetDbValueDef($rsnew, $file_uploads_subcons->Subcon_ID->CurrentValue, NULL, FALSE);

			// Filename
			$file_uploads_subcons->Filename->Upload->SaveToSession(); // Save file value to Session
						if ($file_uploads_subcons->Filename->Upload->Action == "2" || $file_uploads_subcons->Filename->Upload->Action == "3") { // Update/Remove
			$file_uploads_subcons->Filename->Upload->DbValue = $rs->fields('Filename'); // Get original value
			if (is_null($file_uploads_subcons->Filename->Upload->Value)) {
				$rsnew['Filename'] = NULL;
			} else {
				$rsnew['Filename'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $file_uploads_subcons->Filename->UploadPath), $file_uploads_subcons->Filename->Upload->FileName);
			}
			}

			// File_Type_ID
			$file_uploads_subcons->File_Type_ID->SetDbValueDef($rsnew, $file_uploads_subcons->File_Type_ID->CurrentValue, NULL, FALSE);

			// Modified
			$file_uploads_subcons->Modified->SetDbValueDef($rsnew, ew_UnFormatDateTime($file_uploads_subcons->Modified->CurrentValue, 6, FALSE), NULL);

			// Remarks
			$file_uploads_subcons->Remarks->SetDbValueDef($rsnew, $file_uploads_subcons->Remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $file_uploads_subcons->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->Value)) {
				$file_uploads_subcons->Filename->Upload->SaveToFile($file_uploads_subcons->Filename->UploadPath, $rsnew['Filename'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($file_uploads_subcons->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($file_uploads_subcons->CancelMessage <> "") {
					$this->setMessage($file_uploads_subcons->CancelMessage);
					$file_uploads_subcons->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$file_uploads_subcons->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Filename
		$file_uploads_subcons->Filename->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $file_uploads_subcons;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "subcons") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $file_uploads_subcons->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $file_uploads_subcons->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$file_uploads_subcons->Subcon_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$file_uploads_subcons->Subcon_ID->setSessionValue($file_uploads_subcons->Subcon_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["subcons"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$file_uploads_subcons->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
			$file_uploads_subcons->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$file_uploads_subcons->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($file_uploads_subcons->Subcon_ID->QueryStringValue == "") $file_uploads_subcons->Subcon_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $file_uploads_subcons->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $file_uploads_subcons->getDetailFilter(); // Restore detail filter
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
