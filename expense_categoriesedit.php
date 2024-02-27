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
$expense_categories_edit = new cexpense_categories_edit();
$Page =& $expense_categories_edit;

// Page init
$expense_categories_edit->Page_Init();

// Page main
$expense_categories_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expense_categories_edit = new ew_Page("expense_categories_edit");

// page properties
expense_categories_edit.PageID = "edit"; // page ID
expense_categories_edit.FormID = "fexpense_categoriesedit"; // form ID
var EW_PAGE_ID = expense_categories_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
expense_categories_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_cost"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expense_categories->cost->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_vendor_taxes"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expense_categories->vendor_taxes->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_customer_taxes"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expense_categories->customer_taxes->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
expense_categories_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expense_categories_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expense_categories_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expense_categories_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expense_categories->TableCaption() ?><br><br>
<a href="<?php echo $expense_categories->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expense_categories_edit->ShowMessage();
?>
<form name="fexpense_categoriesedit" id="fexpense_categoriesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return expense_categories_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="expense_categories">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expense_categories->id->Visible) { // id ?>
	<tr<?php echo $expense_categories->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->id->FldCaption() ?></td>
		<td<?php echo $expense_categories->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $expense_categories->id->ViewAttributes() ?>><?php echo $expense_categories->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($expense_categories->id->CurrentValue) ?>">
</span><?php echo $expense_categories->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->company_id->Visible) { // company_id ?>
	<tr<?php echo $expense_categories->company_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->company_id->FldCaption() ?></td>
		<td<?php echo $expense_categories->company_id->CellAttributes() ?>><span id="el_company_id">
<select id="x_company_id" name="x_company_id" title="<?php echo $expense_categories->company_id->FldTitle() ?>"<?php echo $expense_categories->company_id->EditAttributes() ?>>
<?php
if (is_array($expense_categories->company_id->EditValue)) {
	$arwrk = $expense_categories->company_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expense_categories->company_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $expense_categories->company_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->category_name->Visible) { // category_name ?>
	<tr<?php echo $expense_categories->category_name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->category_name->FldCaption() ?></td>
		<td<?php echo $expense_categories->category_name->CellAttributes() ?>><span id="el_category_name">
<input type="text" name="x_category_name" id="x_category_name" title="<?php echo $expense_categories->category_name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $expense_categories->category_name->EditValue ?>"<?php echo $expense_categories->category_name->EditAttributes() ?>>
</span><?php echo $expense_categories->category_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->cost->Visible) { // cost ?>
	<tr<?php echo $expense_categories->cost->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->cost->FldCaption() ?></td>
		<td<?php echo $expense_categories->cost->CellAttributes() ?>><span id="el_cost">
<input type="text" name="x_cost" id="x_cost" title="<?php echo $expense_categories->cost->FldTitle() ?>" size="30" value="<?php echo $expense_categories->cost->EditValue ?>"<?php echo $expense_categories->cost->EditAttributes() ?>>
</span><?php echo $expense_categories->cost->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->internal_reference->Visible) { // internal_reference ?>
	<tr<?php echo $expense_categories->internal_reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->internal_reference->FldCaption() ?></td>
		<td<?php echo $expense_categories->internal_reference->CellAttributes() ?>><span id="el_internal_reference">
<input type="text" name="x_internal_reference" id="x_internal_reference" title="<?php echo $expense_categories->internal_reference->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $expense_categories->internal_reference->EditValue ?>"<?php echo $expense_categories->internal_reference->EditAttributes() ?>>
</span><?php echo $expense_categories->internal_reference->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->re_invoice_expenses->Visible) { // re_invoice_expenses ?>
	<tr<?php echo $expense_categories->re_invoice_expenses->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->re_invoice_expenses->FldCaption() ?></td>
		<td<?php echo $expense_categories->re_invoice_expenses->CellAttributes() ?>><span id="el_re_invoice_expenses">
<div id="tp_x_re_invoice_expenses" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_re_invoice_expenses" id="x_re_invoice_expenses" title="<?php echo $expense_categories->re_invoice_expenses->FldTitle() ?>" value="{value}"<?php echo $expense_categories->re_invoice_expenses->EditAttributes() ?>></label></div>
<div id="dsl_x_re_invoice_expenses" repeatcolumn="5">
<?php
$arwrk = $expense_categories->re_invoice_expenses->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expense_categories->re_invoice_expenses->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_re_invoice_expenses" id="x_re_invoice_expenses" title="<?php echo $expense_categories->re_invoice_expenses->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $expense_categories->re_invoice_expenses->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $expense_categories->re_invoice_expenses->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->vendor_taxes->Visible) { // vendor_taxes ?>
	<tr<?php echo $expense_categories->vendor_taxes->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->vendor_taxes->FldCaption() ?></td>
		<td<?php echo $expense_categories->vendor_taxes->CellAttributes() ?>><span id="el_vendor_taxes">
<input type="text" name="x_vendor_taxes" id="x_vendor_taxes" title="<?php echo $expense_categories->vendor_taxes->FldTitle() ?>" size="30" value="<?php echo $expense_categories->vendor_taxes->EditValue ?>"<?php echo $expense_categories->vendor_taxes->EditAttributes() ?>>
</span><?php echo $expense_categories->vendor_taxes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->customer_taxes->Visible) { // customer_taxes ?>
	<tr<?php echo $expense_categories->customer_taxes->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->customer_taxes->FldCaption() ?></td>
		<td<?php echo $expense_categories->customer_taxes->CellAttributes() ?>><span id="el_customer_taxes">
<input type="text" name="x_customer_taxes" id="x_customer_taxes" title="<?php echo $expense_categories->customer_taxes->FldTitle() ?>" size="30" value="<?php echo $expense_categories->customer_taxes->EditValue ?>"<?php echo $expense_categories->customer_taxes->EditAttributes() ?>>
</span><?php echo $expense_categories->customer_taxes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expense_categories->remarks->Visible) { // remarks ?>
	<tr<?php echo $expense_categories->remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expense_categories->remarks->FldCaption() ?></td>
		<td<?php echo $expense_categories->remarks->CellAttributes() ?>><span id="el_remarks">
<textarea name="x_remarks" id="x_remarks" title="<?php echo $expense_categories->remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $expense_categories->remarks->EditAttributes() ?>><?php echo $expense_categories->remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $expense_categories->remarks->CustomMsg ?></td>
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
$expense_categories_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpense_categories_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'expense_categories';

	// Page object name
	var $PageObjName = 'expense_categories_edit';

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
	function cexpense_categories_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expense_categories)
		$GLOBALS["expense_categories"] = new cexpense_categories();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("expense_categorieslist.php");
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
		global $objForm, $Language, $gsFormError, $expense_categories;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$expense_categories->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$expense_categories->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$expense_categories->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$expense_categories->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$expense_categories->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($expense_categories->id->CurrentValue == "")
			$this->Page_Terminate("expense_categorieslist.php"); // Invalid key, return to list
		switch ($expense_categories->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("expense_categorieslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$expense_categories->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $expense_categories->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$expense_categories->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$expense_categories->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $expense_categories;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expense_categories;
		$expense_categories->id->setFormValue($objForm->GetValue("x_id"));
		$expense_categories->company_id->setFormValue($objForm->GetValue("x_company_id"));
		$expense_categories->category_name->setFormValue($objForm->GetValue("x_category_name"));
		$expense_categories->cost->setFormValue($objForm->GetValue("x_cost"));
		$expense_categories->internal_reference->setFormValue($objForm->GetValue("x_internal_reference"));
		$expense_categories->re_invoice_expenses->setFormValue($objForm->GetValue("x_re_invoice_expenses"));
		$expense_categories->vendor_taxes->setFormValue($objForm->GetValue("x_vendor_taxes"));
		$expense_categories->customer_taxes->setFormValue($objForm->GetValue("x_customer_taxes"));
		$expense_categories->modified->setFormValue($objForm->GetValue("x_modified"));
		$expense_categories->modified->CurrentValue = ew_UnFormatDateTime($expense_categories->modified->CurrentValue, 6);
		$expense_categories->user_id->setFormValue($objForm->GetValue("x_user_id"));
		$expense_categories->remarks->setFormValue($objForm->GetValue("x_remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expense_categories;
		$this->LoadRow();
		$expense_categories->id->CurrentValue = $expense_categories->id->FormValue;
		$expense_categories->company_id->CurrentValue = $expense_categories->company_id->FormValue;
		$expense_categories->category_name->CurrentValue = $expense_categories->category_name->FormValue;
		$expense_categories->cost->CurrentValue = $expense_categories->cost->FormValue;
		$expense_categories->internal_reference->CurrentValue = $expense_categories->internal_reference->FormValue;
		$expense_categories->re_invoice_expenses->CurrentValue = $expense_categories->re_invoice_expenses->FormValue;
		$expense_categories->vendor_taxes->CurrentValue = $expense_categories->vendor_taxes->FormValue;
		$expense_categories->customer_taxes->CurrentValue = $expense_categories->customer_taxes->FormValue;
		$expense_categories->modified->CurrentValue = $expense_categories->modified->FormValue;
		$expense_categories->modified->CurrentValue = ew_UnFormatDateTime($expense_categories->modified->CurrentValue, 6);
		$expense_categories->user_id->CurrentValue = $expense_categories->user_id->FormValue;
		$expense_categories->remarks->CurrentValue = $expense_categories->remarks->FormValue;
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
		$expense_categories->company_id->setDbValue($rs->fields('company_id'));
		$expense_categories->category_name->setDbValue($rs->fields('category_name'));
		$expense_categories->cost->setDbValue($rs->fields('cost'));
		$expense_categories->internal_reference->setDbValue($rs->fields('internal_reference'));
		$expense_categories->re_invoice_expenses->setDbValue($rs->fields('re_invoice_expenses'));
		$expense_categories->vendor_taxes->setDbValue($rs->fields('vendor_taxes'));
		$expense_categories->customer_taxes->setDbValue($rs->fields('customer_taxes'));
		$expense_categories->created->setDbValue($rs->fields('created'));
		$expense_categories->modified->setDbValue($rs->fields('modified'));
		$expense_categories->user_id->setDbValue($rs->fields('user_id'));
		$expense_categories->remarks->setDbValue($rs->fields('remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expense_categories;

		// Initialize URLs
		// Call Row_Rendering event

		$expense_categories->Row_Rendering();

		// Common render codes for all row types
		// id

		$expense_categories->id->CellCssStyle = ""; $expense_categories->id->CellCssClass = "";
		$expense_categories->id->CellAttrs = array(); $expense_categories->id->ViewAttrs = array(); $expense_categories->id->EditAttrs = array();

		// company_id
		$expense_categories->company_id->CellCssStyle = ""; $expense_categories->company_id->CellCssClass = "";
		$expense_categories->company_id->CellAttrs = array(); $expense_categories->company_id->ViewAttrs = array(); $expense_categories->company_id->EditAttrs = array();

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

		// modified
		$expense_categories->modified->CellCssStyle = ""; $expense_categories->modified->CellCssClass = "";
		$expense_categories->modified->CellAttrs = array(); $expense_categories->modified->ViewAttrs = array(); $expense_categories->modified->EditAttrs = array();

		// user_id
		$expense_categories->user_id->CellCssStyle = ""; $expense_categories->user_id->CellCssClass = "";
		$expense_categories->user_id->CellAttrs = array(); $expense_categories->user_id->ViewAttrs = array(); $expense_categories->user_id->EditAttrs = array();

		// remarks
		$expense_categories->remarks->CellCssStyle = ""; $expense_categories->remarks->CellCssClass = "";
		$expense_categories->remarks->CellAttrs = array(); $expense_categories->remarks->ViewAttrs = array(); $expense_categories->remarks->EditAttrs = array();
		if ($expense_categories->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expense_categories->id->ViewValue = $expense_categories->id->CurrentValue;
			$expense_categories->id->CssStyle = "";
			$expense_categories->id->CssClass = "";
			$expense_categories->id->ViewCustomAttributes = "";

			// company_id
			if (strval($expense_categories->company_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expense_categories->company_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Company_Name` FROM `company`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Company_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expense_categories->company_id->ViewValue = $rswrk->fields('Company_Name');
					$rswrk->Close();
				} else {
					$expense_categories->company_id->ViewValue = $expense_categories->company_id->CurrentValue;
				}
			} else {
				$expense_categories->company_id->ViewValue = NULL;
			}
			$expense_categories->company_id->CssStyle = "";
			$expense_categories->company_id->CssClass = "";
			$expense_categories->company_id->ViewCustomAttributes = "";

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

			// remarks
			$expense_categories->remarks->ViewValue = $expense_categories->remarks->CurrentValue;
			$expense_categories->remarks->CssStyle = "";
			$expense_categories->remarks->CssClass = "";
			$expense_categories->remarks->ViewCustomAttributes = "";

			// id
			$expense_categories->id->HrefValue = "";
			$expense_categories->id->TooltipValue = "";

			// company_id
			$expense_categories->company_id->HrefValue = "";
			$expense_categories->company_id->TooltipValue = "";

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

			// modified
			$expense_categories->modified->HrefValue = "";
			$expense_categories->modified->TooltipValue = "";

			// user_id
			$expense_categories->user_id->HrefValue = "";
			$expense_categories->user_id->TooltipValue = "";

			// remarks
			$expense_categories->remarks->HrefValue = "";
			$expense_categories->remarks->TooltipValue = "";
		} elseif ($expense_categories->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$expense_categories->id->EditCustomAttributes = "";
			$expense_categories->id->EditValue = $expense_categories->id->CurrentValue;
			$expense_categories->id->CssStyle = "";
			$expense_categories->id->CssClass = "";
			$expense_categories->id->ViewCustomAttributes = "";

			// company_id
			$expense_categories->company_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Company_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `company`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Company_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$expense_categories->company_id->EditValue = $arwrk;

			// category_name
			$expense_categories->category_name->EditCustomAttributes = "";
			$expense_categories->category_name->EditValue = ew_HtmlEncode($expense_categories->category_name->CurrentValue);

			// cost
			$expense_categories->cost->EditCustomAttributes = "";
			$expense_categories->cost->EditValue = ew_HtmlEncode($expense_categories->cost->CurrentValue);

			// internal_reference
			$expense_categories->internal_reference->EditCustomAttributes = "";
			$expense_categories->internal_reference->EditValue = ew_HtmlEncode($expense_categories->internal_reference->CurrentValue);

			// re_invoice_expenses
			$expense_categories->re_invoice_expenses->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("yes", "At Invoice");
			$arwrk[] = array("no", "No");
			$expense_categories->re_invoice_expenses->EditValue = $arwrk;

			// vendor_taxes
			$expense_categories->vendor_taxes->EditCustomAttributes = "";
			$expense_categories->vendor_taxes->EditValue = ew_HtmlEncode($expense_categories->vendor_taxes->CurrentValue);

			// customer_taxes
			$expense_categories->customer_taxes->EditCustomAttributes = "";
			$expense_categories->customer_taxes->EditValue = ew_HtmlEncode($expense_categories->customer_taxes->CurrentValue);

			// modified
			// user_id
			// remarks

			$expense_categories->remarks->EditCustomAttributes = "";
			$expense_categories->remarks->EditValue = ew_HtmlEncode($expense_categories->remarks->CurrentValue);

			// Edit refer script
			// id

			$expense_categories->id->HrefValue = "";

			// company_id
			$expense_categories->company_id->HrefValue = "";

			// category_name
			$expense_categories->category_name->HrefValue = "";

			// cost
			$expense_categories->cost->HrefValue = "";

			// internal_reference
			$expense_categories->internal_reference->HrefValue = "";

			// re_invoice_expenses
			$expense_categories->re_invoice_expenses->HrefValue = "";

			// vendor_taxes
			$expense_categories->vendor_taxes->HrefValue = "";

			// customer_taxes
			$expense_categories->customer_taxes->HrefValue = "";

			// modified
			$expense_categories->modified->HrefValue = "";

			// user_id
			$expense_categories->user_id->HrefValue = "";

			// remarks
			$expense_categories->remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($expense_categories->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expense_categories->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $expense_categories;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckNumber($expense_categories->cost->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expense_categories->cost->FldErrMsg();
		}
		if (!ew_CheckNumber($expense_categories->vendor_taxes->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expense_categories->vendor_taxes->FldErrMsg();
		}
		if (!ew_CheckNumber($expense_categories->customer_taxes->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expense_categories->customer_taxes->FldErrMsg();
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
		global $conn, $Security, $Language, $expense_categories;
		$sFilter = $expense_categories->KeyFilter();
		$expense_categories->CurrentFilter = $sFilter;
		$sSql = $expense_categories->SQL();
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

			// company_id
			$expense_categories->company_id->SetDbValueDef($rsnew, $expense_categories->company_id->CurrentValue, NULL, FALSE);

			// category_name
			$expense_categories->category_name->SetDbValueDef($rsnew, $expense_categories->category_name->CurrentValue, NULL, FALSE);

			// cost
			$expense_categories->cost->SetDbValueDef($rsnew, $expense_categories->cost->CurrentValue, NULL, FALSE);

			// internal_reference
			$expense_categories->internal_reference->SetDbValueDef($rsnew, $expense_categories->internal_reference->CurrentValue, NULL, FALSE);

			// re_invoice_expenses
			$expense_categories->re_invoice_expenses->SetDbValueDef($rsnew, $expense_categories->re_invoice_expenses->CurrentValue, NULL, FALSE);

			// vendor_taxes
			$expense_categories->vendor_taxes->SetDbValueDef($rsnew, $expense_categories->vendor_taxes->CurrentValue, NULL, FALSE);

			// customer_taxes
			$expense_categories->customer_taxes->SetDbValueDef($rsnew, $expense_categories->customer_taxes->CurrentValue, NULL, FALSE);

			// modified
			$expense_categories->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['modified'] =& $expense_categories->modified->DbValue;

			// user_id
			$expense_categories->user_id->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['user_id'] =& $expense_categories->user_id->DbValue;

			// remarks
			$expense_categories->remarks->SetDbValueDef($rsnew, $expense_categories->remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $expense_categories->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($expense_categories->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($expense_categories->CancelMessage <> "") {
					$this->setMessage($expense_categories->CancelMessage);
					$expense_categories->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$expense_categories->Row_Updated($rsold, $rsnew);
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
