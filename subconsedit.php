<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$subcons_edit = new csubcons_edit();
$Page =& $subcons_edit;

// Page init
$subcons_edit->Page_Init();

// Page main
$subcons_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subcons_edit = new ew_Page("subcons_edit");

// page properties
subcons_edit.PageID = "edit"; // page ID
subcons_edit.FormID = "fsubconsedit"; // form ID
var EW_PAGE_ID = subcons_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
subcons_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Subcon_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subcons->Subcon_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Subcon_Name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subcons->Subcon_Name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Address"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subcons->Address->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ContactNo"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subcons->ContactNo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Email_Address"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subcons->Email_Address->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_TIN_No"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subcons->TIN_No->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ContactPerson"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subcons->ContactPerson->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_File_Upload"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
subcons_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subcons_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subcons_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subcons_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subcons->TableCaption() ?><br><br>
<a href="<?php echo $subcons->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subcons_edit->ShowMessage();
?>
<form name="fsubconsedit" id="fsubconsedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return subcons_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="subcons">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subcons->id->Visible) { // id ?>
	<tr<?php echo $subcons->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->id->FldCaption() ?></td>
		<td<?php echo $subcons->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $subcons->id->ViewAttributes() ?>><?php echo $subcons->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($subcons->id->CurrentValue) ?>">
</span><?php echo $subcons->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->Subcon_ID->Visible) { // Subcon_ID ?>
	<tr<?php echo $subcons->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Subcon_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subcons->Subcon_ID->CellAttributes() ?>><span id="el_Subcon_ID">
<input type="text" name="x_Subcon_ID" id="x_Subcon_ID" title="<?php echo $subcons->Subcon_ID->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->Subcon_ID->EditValue ?>"<?php echo $subcons->Subcon_ID->EditAttributes() ?>>
</span><?php echo $subcons->Subcon_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->Subcon_Name->Visible) { // Subcon_Name ?>
	<tr<?php echo $subcons->Subcon_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Subcon_Name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subcons->Subcon_Name->CellAttributes() ?>><span id="el_Subcon_Name">
<input type="text" name="x_Subcon_Name" id="x_Subcon_Name" title="<?php echo $subcons->Subcon_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->Subcon_Name->EditValue ?>"<?php echo $subcons->Subcon_Name->EditAttributes() ?>>
</span><?php echo $subcons->Subcon_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->Address->Visible) { // Address ?>
	<tr<?php echo $subcons->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Address->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subcons->Address->CellAttributes() ?>><span id="el_Address">
<input type="text" name="x_Address" id="x_Address" title="<?php echo $subcons->Address->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $subcons->Address->EditValue ?>"<?php echo $subcons->Address->EditAttributes() ?>>
</span><?php echo $subcons->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->ContactNo->Visible) { // ContactNo ?>
	<tr<?php echo $subcons->ContactNo->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->ContactNo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subcons->ContactNo->CellAttributes() ?>><span id="el_ContactNo">
<input type="text" name="x_ContactNo" id="x_ContactNo" title="<?php echo $subcons->ContactNo->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->ContactNo->EditValue ?>"<?php echo $subcons->ContactNo->EditAttributes() ?>>
</span><?php echo $subcons->ContactNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->Email_Address->Visible) { // Email_Address ?>
	<tr<?php echo $subcons->Email_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Email_Address->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subcons->Email_Address->CellAttributes() ?>><span id="el_Email_Address">
<input type="text" name="x_Email_Address" id="x_Email_Address" title="<?php echo $subcons->Email_Address->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->Email_Address->EditValue ?>"<?php echo $subcons->Email_Address->EditAttributes() ?>>
</span><?php echo $subcons->Email_Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->TIN_No->Visible) { // TIN_No ?>
	<tr<?php echo $subcons->TIN_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->TIN_No->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subcons->TIN_No->CellAttributes() ?>><span id="el_TIN_No">
<input type="text" name="x_TIN_No" id="x_TIN_No" title="<?php echo $subcons->TIN_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->TIN_No->EditValue ?>"<?php echo $subcons->TIN_No->EditAttributes() ?>>
</span><?php echo $subcons->TIN_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->ContactPerson->Visible) { // ContactPerson ?>
	<tr<?php echo $subcons->ContactPerson->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->ContactPerson->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subcons->ContactPerson->CellAttributes() ?>><span id="el_ContactPerson">
<input type="text" name="x_ContactPerson" id="x_ContactPerson" title="<?php echo $subcons->ContactPerson->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->ContactPerson->EditValue ?>"<?php echo $subcons->ContactPerson->EditAttributes() ?>>
</span><?php echo $subcons->ContactPerson->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $subcons->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->File_Upload->FldCaption() ?></td>
		<td<?php echo $subcons->File_Upload->CellAttributes() ?>><span id="el_File_Upload">
<div id="old_x_File_Upload">
<?php if ($subcons->File_Upload->HrefValue <> "" || $subcons->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $subcons->File_Upload->HrefValue ?>"><?php echo $subcons->File_Upload->EditValue ?></a>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<?php echo $subcons->File_Upload->EditValue ?>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_File_Upload">
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $subcons->File_Upload->EditAttrs["onchange"] = "this.form.a_File_Upload[2].checked=true;" . @$subcons->File_Upload->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_File_Upload" id="a_File_Upload" value="3">
<?php } ?>
<input type="file" name="x_File_Upload" id="x_File_Upload" title="<?php echo $subcons->File_Upload->FldTitle() ?>" size="30"<?php echo $subcons->File_Upload->EditAttributes() ?>>
</div>
</span><?php echo $subcons->File_Upload->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subcons->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $subcons->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Remarks->FldCaption() ?></td>
		<td<?php echo $subcons->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $subcons->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $subcons->Remarks->EditAttributes() ?>><?php echo $subcons->Remarks->EditValue ?></textarea>
</span><?php echo $subcons->Remarks->CustomMsg ?></td>
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
$subcons_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csubcons_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'subcons';

	// Page object name
	var $PageObjName = 'subcons_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subcons;
		if ($subcons->UseTokenInUrl) $PageUrl .= "t=" . $subcons->TableVar . "&"; // Add page token
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
		global $objForm, $subcons;
		if ($subcons->UseTokenInUrl) {
			if ($objForm)
				return ($subcons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subcons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubcons_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subcons)
		$GLOBALS["subcons"] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subcons', TRUE);

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
		global $subcons;

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
			$this->Page_Terminate("subconslist.php");
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
		global $objForm, $Language, $gsFormError, $subcons;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$subcons->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$subcons->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subcons->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$subcons->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$subcons->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($subcons->id->CurrentValue == "")
			$this->Page_Terminate("subconslist.php"); // Invalid key, return to list
		switch ($subcons->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subconslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$subcons->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $subcons->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$subcons->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$subcons->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subcons;

		// Get upload data
			if ($subcons->File_Upload->Upload->UploadFile()) {

				// No action required
			} else {
				echo $subcons->File_Upload->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subcons;
		$subcons->id->setFormValue($objForm->GetValue("x_id"));
		$subcons->Subcon_ID->setFormValue($objForm->GetValue("x_Subcon_ID"));
		$subcons->Subcon_Name->setFormValue($objForm->GetValue("x_Subcon_Name"));
		$subcons->Address->setFormValue($objForm->GetValue("x_Address"));
		$subcons->ContactNo->setFormValue($objForm->GetValue("x_ContactNo"));
		$subcons->Email_Address->setFormValue($objForm->GetValue("x_Email_Address"));
		$subcons->TIN_No->setFormValue($objForm->GetValue("x_TIN_No"));
		$subcons->ContactPerson->setFormValue($objForm->GetValue("x_ContactPerson"));
		$subcons->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subcons;
		$this->LoadRow();
		$subcons->id->CurrentValue = $subcons->id->FormValue;
		$subcons->Subcon_ID->CurrentValue = $subcons->Subcon_ID->FormValue;
		$subcons->Subcon_Name->CurrentValue = $subcons->Subcon_Name->FormValue;
		$subcons->Address->CurrentValue = $subcons->Address->FormValue;
		$subcons->ContactNo->CurrentValue = $subcons->ContactNo->FormValue;
		$subcons->Email_Address->CurrentValue = $subcons->Email_Address->FormValue;
		$subcons->TIN_No->CurrentValue = $subcons->TIN_No->FormValue;
		$subcons->ContactPerson->CurrentValue = $subcons->ContactPerson->FormValue;
		$subcons->Remarks->CurrentValue = $subcons->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subcons;
		$sFilter = $subcons->KeyFilter();

		// Call Row Selecting event
		$subcons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subcons->CurrentFilter = $sFilter;
		$sSql = $subcons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subcons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subcons;
		$subcons->id->setDbValue($rs->fields('id'));
		$subcons->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$subcons->Subcon_Name->setDbValue($rs->fields('Subcon_Name'));
		$subcons->Address->setDbValue($rs->fields('Address'));
		$subcons->ContactNo->setDbValue($rs->fields('ContactNo'));
		$subcons->Email_Address->setDbValue($rs->fields('Email_Address'));
		$subcons->TIN_No->setDbValue($rs->fields('TIN_No'));
		$subcons->ContactPerson->setDbValue($rs->fields('ContactPerson'));
		$subcons->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$subcons->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subcons;

		// Initialize URLs
		// Call Row_Rendering event

		$subcons->Row_Rendering();

		// Common render codes for all row types
		// id

		$subcons->id->CellCssStyle = ""; $subcons->id->CellCssClass = "";
		$subcons->id->CellAttrs = array(); $subcons->id->ViewAttrs = array(); $subcons->id->EditAttrs = array();

		// Subcon_ID
		$subcons->Subcon_ID->CellCssStyle = ""; $subcons->Subcon_ID->CellCssClass = "";
		$subcons->Subcon_ID->CellAttrs = array(); $subcons->Subcon_ID->ViewAttrs = array(); $subcons->Subcon_ID->EditAttrs = array();

		// Subcon_Name
		$subcons->Subcon_Name->CellCssStyle = ""; $subcons->Subcon_Name->CellCssClass = "";
		$subcons->Subcon_Name->CellAttrs = array(); $subcons->Subcon_Name->ViewAttrs = array(); $subcons->Subcon_Name->EditAttrs = array();

		// Address
		$subcons->Address->CellCssStyle = ""; $subcons->Address->CellCssClass = "";
		$subcons->Address->CellAttrs = array(); $subcons->Address->ViewAttrs = array(); $subcons->Address->EditAttrs = array();

		// ContactNo
		$subcons->ContactNo->CellCssStyle = ""; $subcons->ContactNo->CellCssClass = "";
		$subcons->ContactNo->CellAttrs = array(); $subcons->ContactNo->ViewAttrs = array(); $subcons->ContactNo->EditAttrs = array();

		// Email_Address
		$subcons->Email_Address->CellCssStyle = ""; $subcons->Email_Address->CellCssClass = "";
		$subcons->Email_Address->CellAttrs = array(); $subcons->Email_Address->ViewAttrs = array(); $subcons->Email_Address->EditAttrs = array();

		// TIN_No
		$subcons->TIN_No->CellCssStyle = ""; $subcons->TIN_No->CellCssClass = "";
		$subcons->TIN_No->CellAttrs = array(); $subcons->TIN_No->ViewAttrs = array(); $subcons->TIN_No->EditAttrs = array();

		// ContactPerson
		$subcons->ContactPerson->CellCssStyle = ""; $subcons->ContactPerson->CellCssClass = "";
		$subcons->ContactPerson->CellAttrs = array(); $subcons->ContactPerson->ViewAttrs = array(); $subcons->ContactPerson->EditAttrs = array();

		// File_Upload
		$subcons->File_Upload->CellCssStyle = ""; $subcons->File_Upload->CellCssClass = "";
		$subcons->File_Upload->CellAttrs = array(); $subcons->File_Upload->ViewAttrs = array(); $subcons->File_Upload->EditAttrs = array();

		// Remarks
		$subcons->Remarks->CellCssStyle = ""; $subcons->Remarks->CellCssClass = "";
		$subcons->Remarks->CellAttrs = array(); $subcons->Remarks->ViewAttrs = array(); $subcons->Remarks->EditAttrs = array();
		if ($subcons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$subcons->id->ViewValue = $subcons->id->CurrentValue;
			$subcons->id->CssStyle = "";
			$subcons->id->CssClass = "";
			$subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			$subcons->Subcon_ID->ViewValue = $subcons->Subcon_ID->CurrentValue;
			$subcons->Subcon_ID->CssStyle = "";
			$subcons->Subcon_ID->CssClass = "";
			$subcons->Subcon_ID->ViewCustomAttributes = "";

			// Subcon_Name
			$subcons->Subcon_Name->ViewValue = $subcons->Subcon_Name->CurrentValue;
			$subcons->Subcon_Name->CssStyle = "";
			$subcons->Subcon_Name->CssClass = "";
			$subcons->Subcon_Name->ViewCustomAttributes = "";

			// Address
			$subcons->Address->ViewValue = $subcons->Address->CurrentValue;
			$subcons->Address->CssStyle = "";
			$subcons->Address->CssClass = "";
			$subcons->Address->ViewCustomAttributes = "";

			// ContactNo
			$subcons->ContactNo->ViewValue = $subcons->ContactNo->CurrentValue;
			$subcons->ContactNo->CssStyle = "";
			$subcons->ContactNo->CssClass = "";
			$subcons->ContactNo->ViewCustomAttributes = "";

			// Email_Address
			$subcons->Email_Address->ViewValue = $subcons->Email_Address->CurrentValue;
			$subcons->Email_Address->CssStyle = "";
			$subcons->Email_Address->CssClass = "";
			$subcons->Email_Address->ViewCustomAttributes = "";

			// TIN_No
			$subcons->TIN_No->ViewValue = $subcons->TIN_No->CurrentValue;
			$subcons->TIN_No->CssStyle = "";
			$subcons->TIN_No->CssClass = "";
			$subcons->TIN_No->ViewCustomAttributes = "";

			// ContactPerson
			$subcons->ContactPerson->ViewValue = $subcons->ContactPerson->CurrentValue;
			$subcons->ContactPerson->CssStyle = "";
			$subcons->ContactPerson->CssClass = "";
			$subcons->ContactPerson->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->ViewValue = $subcons->File_Upload->Upload->DbValue;
			} else {
				$subcons->File_Upload->ViewValue = "";
			}
			$subcons->File_Upload->CssStyle = "";
			$subcons->File_Upload->CssClass = "";
			$subcons->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$subcons->Remarks->ViewValue = $subcons->Remarks->CurrentValue;
			$subcons->Remarks->CssStyle = "";
			$subcons->Remarks->CssClass = "";
			$subcons->Remarks->ViewCustomAttributes = "";

			// id
			$subcons->id->HrefValue = "";
			$subcons->id->TooltipValue = "";

			// Subcon_ID
			$subcons->Subcon_ID->HrefValue = "";
			$subcons->Subcon_ID->TooltipValue = "";

			// Subcon_Name
			$subcons->Subcon_Name->HrefValue = "";
			$subcons->Subcon_Name->TooltipValue = "";

			// Address
			$subcons->Address->HrefValue = "";
			$subcons->Address->TooltipValue = "";

			// ContactNo
			$subcons->ContactNo->HrefValue = "";
			$subcons->ContactNo->TooltipValue = "";

			// Email_Address
			$subcons->Email_Address->HrefValue = "";
			$subcons->Email_Address->TooltipValue = "";

			// TIN_No
			$subcons->TIN_No->HrefValue = "";
			$subcons->TIN_No->TooltipValue = "";

			// ContactPerson
			$subcons->ContactPerson->HrefValue = "";
			$subcons->ContactPerson->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $subcons->File_Upload->UploadPath) . ((!empty($subcons->File_Upload->ViewValue)) ? $subcons->File_Upload->ViewValue : $subcons->File_Upload->CurrentValue);
				if ($subcons->Export <> "") $subcons->File_Upload->HrefValue = ew_ConvertFullUrl($subcons->File_Upload->HrefValue);
			} else {
				$subcons->File_Upload->HrefValue = "";
			}
			$subcons->File_Upload->TooltipValue = "";

			// Remarks
			$subcons->Remarks->HrefValue = "";
			$subcons->Remarks->TooltipValue = "";
		} elseif ($subcons->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$subcons->id->EditCustomAttributes = "";
			$subcons->id->EditValue = $subcons->id->CurrentValue;
			$subcons->id->CssStyle = "";
			$subcons->id->CssClass = "";
			$subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			$subcons->Subcon_ID->EditCustomAttributes = "";
			$subcons->Subcon_ID->EditValue = ew_HtmlEncode($subcons->Subcon_ID->CurrentValue);

			// Subcon_Name
			$subcons->Subcon_Name->EditCustomAttributes = "";
			$subcons->Subcon_Name->EditValue = ew_HtmlEncode($subcons->Subcon_Name->CurrentValue);

			// Address
			$subcons->Address->EditCustomAttributes = "";
			$subcons->Address->EditValue = ew_HtmlEncode($subcons->Address->CurrentValue);

			// ContactNo
			$subcons->ContactNo->EditCustomAttributes = "";
			$subcons->ContactNo->EditValue = ew_HtmlEncode($subcons->ContactNo->CurrentValue);

			// Email_Address
			$subcons->Email_Address->EditCustomAttributes = "";
			$subcons->Email_Address->EditValue = ew_HtmlEncode($subcons->Email_Address->CurrentValue);

			// TIN_No
			$subcons->TIN_No->EditCustomAttributes = "";
			$subcons->TIN_No->EditValue = ew_HtmlEncode($subcons->TIN_No->CurrentValue);

			// ContactPerson
			$subcons->ContactPerson->EditCustomAttributes = "";
			$subcons->ContactPerson->EditValue = ew_HtmlEncode($subcons->ContactPerson->CurrentValue);

			// File_Upload
			$subcons->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->EditValue = $subcons->File_Upload->Upload->DbValue;
			} else {
				$subcons->File_Upload->EditValue = "";
			}

			// Remarks
			$subcons->Remarks->EditCustomAttributes = "";
			$subcons->Remarks->EditValue = ew_HtmlEncode($subcons->Remarks->CurrentValue);

			// Edit refer script
			// id

			$subcons->id->HrefValue = "";

			// Subcon_ID
			$subcons->Subcon_ID->HrefValue = "";

			// Subcon_Name
			$subcons->Subcon_Name->HrefValue = "";

			// Address
			$subcons->Address->HrefValue = "";

			// ContactNo
			$subcons->ContactNo->HrefValue = "";

			// Email_Address
			$subcons->Email_Address->HrefValue = "";

			// TIN_No
			$subcons->TIN_No->HrefValue = "";

			// ContactPerson
			$subcons->ContactPerson->HrefValue = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $subcons->File_Upload->UploadPath) . ((!empty($subcons->File_Upload->EditValue)) ? $subcons->File_Upload->EditValue : $subcons->File_Upload->CurrentValue);
				if ($subcons->Export <> "") $subcons->File_Upload->HrefValue = ew_ConvertFullUrl($subcons->File_Upload->HrefValue);
			} else {
				$subcons->File_Upload->HrefValue = "";
			}

			// Remarks
			$subcons->Remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($subcons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subcons->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subcons;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($subcons->File_Upload->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($subcons->File_Upload->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $subcons->File_Upload->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($subcons->Subcon_ID->FormValue) && $subcons->Subcon_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subcons->Subcon_ID->FldCaption();
		}
		if (!is_null($subcons->Subcon_Name->FormValue) && $subcons->Subcon_Name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subcons->Subcon_Name->FldCaption();
		}
		if (!is_null($subcons->Address->FormValue) && $subcons->Address->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subcons->Address->FldCaption();
		}
		if (!is_null($subcons->ContactNo->FormValue) && $subcons->ContactNo->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subcons->ContactNo->FldCaption();
		}
		if (!is_null($subcons->Email_Address->FormValue) && $subcons->Email_Address->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subcons->Email_Address->FldCaption();
		}
		if (!is_null($subcons->TIN_No->FormValue) && $subcons->TIN_No->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subcons->TIN_No->FldCaption();
		}
		if (!is_null($subcons->ContactPerson->FormValue) && $subcons->ContactPerson->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subcons->ContactPerson->FldCaption();
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
		global $conn, $Security, $Language, $subcons;
		$sFilter = $subcons->KeyFilter();
		$subcons->CurrentFilter = $sFilter;
		$sSql = $subcons->SQL();
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
			$subcons->Subcon_ID->SetDbValueDef($rsnew, $subcons->Subcon_ID->CurrentValue, NULL, FALSE);

			// Subcon_Name
			$subcons->Subcon_Name->SetDbValueDef($rsnew, $subcons->Subcon_Name->CurrentValue, NULL, FALSE);

			// Address
			$subcons->Address->SetDbValueDef($rsnew, $subcons->Address->CurrentValue, NULL, FALSE);

			// ContactNo
			$subcons->ContactNo->SetDbValueDef($rsnew, $subcons->ContactNo->CurrentValue, NULL, FALSE);

			// Email_Address
			$subcons->Email_Address->SetDbValueDef($rsnew, $subcons->Email_Address->CurrentValue, NULL, FALSE);

			// TIN_No
			$subcons->TIN_No->SetDbValueDef($rsnew, $subcons->TIN_No->CurrentValue, NULL, FALSE);

			// ContactPerson
			$subcons->ContactPerson->SetDbValueDef($rsnew, $subcons->ContactPerson->CurrentValue, NULL, FALSE);

			// File_Upload
			$subcons->File_Upload->Upload->SaveToSession(); // Save file value to Session
						if ($subcons->File_Upload->Upload->Action == "2" || $subcons->File_Upload->Upload->Action == "3") { // Update/Remove
			$subcons->File_Upload->Upload->DbValue = $rs->fields('File_Upload'); // Get original value
			if (is_null($subcons->File_Upload->Upload->Value)) {
				$rsnew['File_Upload'] = NULL;
			} else {
				$rsnew['File_Upload'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $subcons->File_Upload->UploadPath), $subcons->File_Upload->Upload->FileName);
			}
			}

			// Remarks
			$subcons->Remarks->SetDbValueDef($rsnew, $subcons->Remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $subcons->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($subcons->File_Upload->Upload->Value)) {
				$subcons->File_Upload->Upload->SaveToFile($subcons->File_Upload->UploadPath, $rsnew['File_Upload'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($subcons->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($subcons->CancelMessage <> "") {
					$this->setMessage($subcons->CancelMessage);
					$subcons->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$subcons->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// File_Upload
		$subcons->File_Upload->Upload->RemoveFromSession(); // Remove file value from Session
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
