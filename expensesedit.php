<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "expensesinfo.php" ?>
<?php include "bookingsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "accounts_receivableinfo.php" ?>
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
$expenses_edit = new cexpenses_edit();
$Page =& $expenses_edit;

// Page init
$expenses_edit->Page_Init();

// Page main
$expenses_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expenses_edit = new ew_Page("expenses_edit");

// page properties
expenses_edit.PageID = "edit"; // page ID
expenses_edit.FormID = "fexpensesedit"; // form ID
var EW_PAGE_ID = expenses_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
expenses_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_expense_date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->expense_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_expense_category_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenses->expense_category_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Reference_No"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenses->Reference_No->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Booking_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Booking_ID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenses->Description->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Amount"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenses->Amount->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Vat"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Vat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Sales"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Total_Sales->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Wtax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Wtax->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Amount_Due"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Total_Amount_Due->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_File_Upload"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
expenses_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenses_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenses_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenses_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenses->TableCaption() ?><br><br>
<a href="<?php echo $expenses->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expenses_edit->ShowMessage();
?>
<form name="fexpensesedit" id="fexpensesedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return expenses_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="expenses">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expenses->id->Visible) { // id ?>
	<tr<?php echo $expenses->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->id->FldCaption() ?></td>
		<td<?php echo $expenses->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $expenses->id->ViewAttributes() ?>><?php echo $expenses->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($expenses->id->CurrentValue) ?>">
</span><?php echo $expenses->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->expense_date->Visible) { // expense_date ?>
	<tr<?php echo $expenses->expense_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->expense_date->FldCaption() ?></td>
		<td<?php echo $expenses->expense_date->CellAttributes() ?>><span id="el_expense_date">
<input type="text" name="x_expense_date" id="x_expense_date" title="<?php echo $expenses->expense_date->FldTitle() ?>" value="<?php echo $expenses->expense_date->EditValue ?>"<?php echo $expenses->expense_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_expense_date" name="cal_x_expense_date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_expense_date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_expense_date" // button id
});
</script>
</span><?php echo $expenses->expense_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->expense_category_id->Visible) { // expense_category_id ?>
	<tr<?php echo $expenses->expense_category_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->expense_category_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenses->expense_category_id->CellAttributes() ?>><span id="el_expense_category_id">
<select id="x_expense_category_id" name="x_expense_category_id" title="<?php echo $expenses->expense_category_id->FldTitle() ?>"<?php echo $expenses->expense_category_id->EditAttributes() ?>>
<?php
if (is_array($expenses->expense_category_id->EditValue)) {
	$arwrk = $expenses->expense_category_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->expense_category_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $expenses->expense_category_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Reference_No->Visible) { // Reference_No ?>
	<tr<?php echo $expenses->Reference_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Reference_No->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenses->Reference_No->CellAttributes() ?>><span id="el_Reference_No">
<input type="text" name="x_Reference_No" id="x_Reference_No" title="<?php echo $expenses->Reference_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $expenses->Reference_No->EditValue ?>"<?php echo $expenses->Reference_No->EditAttributes() ?>>
</span><?php echo $expenses->Reference_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Booking_ID->Visible) { // Booking_ID ?>
	<tr<?php echo $expenses->Booking_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Booking_ID->FldCaption() ?></td>
		<td<?php echo $expenses->Booking_ID->CellAttributes() ?>><span id="el_Booking_ID">
<?php if ($expenses->Booking_ID->getSessionValue() <> "") { ?>
<div<?php echo $expenses->Booking_ID->ViewAttributes() ?>><?php echo $expenses->Booking_ID->ViewValue ?></div>
<input type="hidden" id="x_Booking_ID" name="x_Booking_ID" value="<?php echo ew_HtmlEncode($expenses->Booking_ID->CurrentValue) ?>">
<?php } else { ?>
<div id="as_x_Booking_ID" style="z-index: 8940">
	<input type="text" name="sv_x_Booking_ID" id="sv_x_Booking_ID" value="<?php echo $expenses->Booking_ID->EditValue ?>" title="<?php echo $expenses->Booking_ID->FldTitle() ?>" size="30"<?php echo $expenses->Booking_ID->EditAttributes() ?>>&nbsp;<span id="em_x_Booking_ID" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_Booking_ID"></div>
</div>
<input type="hidden" name="x_Booking_ID" id="x_Booking_ID" value="<?php echo $expenses->Booking_ID->CurrentValue ?>">
<?php
$sSqlWrk = "SELECT `id`, `Booking_Number` FROM `bookings`";
$sWhereWrk = "`Booking_Number` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_Booking_ID" id="s_x_Booking_ID" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_Booking_ID = new ew_AutoSuggest("sv_x_Booking_ID", "sc_x_Booking_ID", "s_x_Booking_ID", "em_x_Booking_ID", "x_Booking_ID", "", false);
oas_x_Booking_ID.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_Booking_ID.ac.typeAhead = false;

//-->
</script>
<?php } ?>
</span><?php echo $expenses->Booking_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Description->Visible) { // Description ?>
	<tr<?php echo $expenses->Description->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Description->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenses->Description->CellAttributes() ?>><span id="el_Description">
<textarea name="x_Description" id="x_Description" title="<?php echo $expenses->Description->FldTitle() ?>" cols="35" rows="4"<?php echo $expenses->Description->EditAttributes() ?>><?php echo $expenses->Description->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Description", function() {
	var oCKeditor = CKEDITOR.replace('x_Description', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $expenses->Description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Amount->Visible) { // Amount ?>
	<tr<?php echo $expenses->Amount->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Amount->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenses->Amount->CellAttributes() ?>><span id="el_Amount">
<input type="text" name="x_Amount" id="x_Amount" title="<?php echo $expenses->Amount->FldTitle() ?>" size="30" value="<?php echo $expenses->Amount->EditValue ?>"<?php echo $expenses->Amount->EditAttributes() ?>>
</span><?php echo $expenses->Amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Vat->Visible) { // Vat ?>
	<tr<?php echo $expenses->Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Vat->FldCaption() ?></td>
		<td<?php echo $expenses->Vat->CellAttributes() ?>><span id="el_Vat">
<input type="text" name="x_Vat" id="x_Vat" title="<?php echo $expenses->Vat->FldTitle() ?>" size="30" value="<?php echo $expenses->Vat->EditValue ?>"<?php echo $expenses->Vat->EditAttributes() ?>>
</span><?php echo $expenses->Vat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Total_Sales->Visible) { // Total_Sales ?>
	<tr<?php echo $expenses->Total_Sales->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Total_Sales->FldCaption() ?></td>
		<td<?php echo $expenses->Total_Sales->CellAttributes() ?>><span id="el_Total_Sales">
<input type="text" name="x_Total_Sales" id="x_Total_Sales" title="<?php echo $expenses->Total_Sales->FldTitle() ?>" size="30" value="<?php echo $expenses->Total_Sales->EditValue ?>"<?php echo $expenses->Total_Sales->EditAttributes() ?>>
</span><?php echo $expenses->Total_Sales->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Wtax->Visible) { // Wtax ?>
	<tr<?php echo $expenses->Wtax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Wtax->FldCaption() ?></td>
		<td<?php echo $expenses->Wtax->CellAttributes() ?>><span id="el_Wtax">
<input type="text" name="x_Wtax" id="x_Wtax" title="<?php echo $expenses->Wtax->FldTitle() ?>" size="30" value="<?php echo $expenses->Wtax->EditValue ?>"<?php echo $expenses->Wtax->EditAttributes() ?>>
</span><?php echo $expenses->Wtax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<tr<?php echo $expenses->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $expenses->Total_Amount_Due->CellAttributes() ?>><span id="el_Total_Amount_Due">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $expenses->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $expenses->Total_Amount_Due->EditValue ?>"<?php echo $expenses->Total_Amount_Due->EditAttributes() ?>>
</span><?php echo $expenses->Total_Amount_Due->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $expenses->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->File_Upload->FldCaption() ?></td>
		<td<?php echo $expenses->File_Upload->CellAttributes() ?>><span id="el_File_Upload">
<div id="old_x_File_Upload">
<?php if ($expenses->File_Upload->HrefValue <> "" || $expenses->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($expenses->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $expenses->File_Upload->HrefValue ?>"><?php echo $expenses->File_Upload->EditValue ?></a>
<?php } elseif (!in_array($expenses->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($expenses->File_Upload->Upload->DbValue)) { ?>
<?php echo $expenses->File_Upload->EditValue ?>
<?php } elseif (!in_array($expenses->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_File_Upload">
<?php if (!empty($expenses->File_Upload->Upload->DbValue)) { ?>
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $expenses->File_Upload->EditAttrs["onchange"] = "this.form.a_File_Upload[2].checked=true;" . @$expenses->File_Upload->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_File_Upload" id="a_File_Upload" value="3">
<?php } ?>
<input type="file" name="x_File_Upload" id="x_File_Upload" title="<?php echo $expenses->File_Upload->FldTitle() ?>" size="30"<?php echo $expenses->File_Upload->EditAttributes() ?>>
</div>
</span><?php echo $expenses->File_Upload->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Expenses_Type_ID->Visible) { // Expenses_Type_ID ?>
	<tr<?php echo $expenses->Expenses_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Expenses_Type_ID->FldCaption() ?></td>
		<td<?php echo $expenses->Expenses_Type_ID->CellAttributes() ?>><span id="el_Expenses_Type_ID">
<select id="x_Expenses_Type_ID" name="x_Expenses_Type_ID" title="<?php echo $expenses->Expenses_Type_ID->FldTitle() ?>"<?php echo $expenses->Expenses_Type_ID->EditAttributes() ?>>
<?php
if (is_array($expenses->Expenses_Type_ID->EditValue)) {
	$arwrk = $expenses->Expenses_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->Expenses_Type_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $expenses->Expenses_Type_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Add_To_Billing->Visible) { // Add_To_Billing ?>
	<tr<?php echo $expenses->Add_To_Billing->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Add_To_Billing->FldCaption() ?></td>
		<td<?php echo $expenses->Add_To_Billing->CellAttributes() ?>><span id="el_Add_To_Billing">
<div id="tp_x_Add_To_Billing" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_Add_To_Billing" id="x_Add_To_Billing" title="<?php echo $expenses->Add_To_Billing->FldTitle() ?>" value="{value}"<?php echo $expenses->Add_To_Billing->EditAttributes() ?>></label></div>
<div id="dsl_x_Add_To_Billing" repeatcolumn="5">
<?php
$arwrk = $expenses->Add_To_Billing->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->Add_To_Billing->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_Add_To_Billing" id="x_Add_To_Billing" title="<?php echo $expenses->Add_To_Billing->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $expenses->Add_To_Billing->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $expenses->Add_To_Billing->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->approver->Visible) { // approver ?>
	<tr<?php echo $expenses->approver->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->approver->FldCaption() ?></td>
		<td<?php echo $expenses->approver->CellAttributes() ?>><span id="el_approver">
<?php $expenses->approver->EditAttrs["onchange"] = "ew_UpdateOpt('x_employee_id','x_approver',expenses_edit.ar_x_employee_id); " . @$expenses->approver->EditAttrs["onchange"]; ?>
<select id="x_approver" name="x_approver" title="<?php echo $expenses->approver->FldTitle() ?>"<?php echo $expenses->approver->EditAttributes() ?>>
<?php
if (is_array($expenses->approver->EditValue)) {
	$arwrk = $expenses->approver->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->approver->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $expenses->approver->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->employee_id->Visible) { // employee_id ?>
	<tr<?php echo $expenses->employee_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->employee_id->FldCaption() ?></td>
		<td<?php echo $expenses->employee_id->CellAttributes() ?>><span id="el_employee_id">
<select id="x_employee_id" name="x_employee_id" title="<?php echo $expenses->employee_id->FldTitle() ?>"<?php echo $expenses->employee_id->EditAttributes() ?>>
<?php
if (is_array($expenses->employee_id->EditValue)) {
	$arwrk = $expenses->employee_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->employee_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php
$jswrk = "";
if (is_array($expenses->employee_id->EditValue)) {
	$arwrk = $expenses->employee_id->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
expenses_edit.ar_x_employee_id = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $expenses->employee_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->payment_mode->Visible) { // payment_mode ?>
	<tr<?php echo $expenses->payment_mode->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->payment_mode->FldCaption() ?></td>
		<td<?php echo $expenses->payment_mode->CellAttributes() ?>><span id="el_payment_mode">
<div id="tp_x_payment_mode" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_payment_mode" id="x_payment_mode" title="<?php echo $expenses->payment_mode->FldTitle() ?>" value="{value}"<?php echo $expenses->payment_mode->EditAttributes() ?>></label></div>
<div id="dsl_x_payment_mode" repeatcolumn="5">
<?php
$arwrk = $expenses->payment_mode->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->payment_mode->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_payment_mode" id="x_payment_mode" title="<?php echo $expenses->payment_mode->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $expenses->payment_mode->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $expenses->payment_mode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->status->Visible) { // status ?>
	<tr<?php echo $expenses->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->status->FldCaption() ?></td>
		<td<?php echo $expenses->status->CellAttributes() ?>><span id="el_status">
<select id="x_status" name="x_status" title="<?php echo $expenses->status->FldTitle() ?>"<?php echo $expenses->status->EditAttributes() ?>>
<?php
if (is_array($expenses->status->EditValue)) {
	$arwrk = $expenses->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $expenses->status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenses->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $expenses->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Remarks->FldCaption() ?></td>
		<td<?php echo $expenses->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $expenses->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $expenses->Remarks->EditAttributes() ?>><?php echo $expenses->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $expenses->Remarks->CustomMsg ?></td>
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
ew_UpdateOpts([['x_employee_id','x_approver',expenses_edit.ar_x_employee_id]]);

//-->
</script>
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
$expenses_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenses_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'expenses';

	// Page object name
	var $PageObjName = 'expenses_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenses;
		if ($expenses->UseTokenInUrl) $PageUrl .= "t=" . $expenses->TableVar . "&"; // Add page token
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
		global $objForm, $expenses;
		if ($expenses->UseTokenInUrl) {
			if ($objForm)
				return ($expenses->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenses->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenses_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expenses)
		$GLOBALS["expenses"] = new cexpenses();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (accounts_receivable)
		$GLOBALS['accounts_receivable'] = new caccounts_receivable();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenses', TRUE);

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
		global $expenses;

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
			$this->Page_Terminate("expenseslist.php");
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
		global $objForm, $Language, $gsFormError, $expenses;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$expenses->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$expenses->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$expenses->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$expenses->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$expenses->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($expenses->id->CurrentValue == "")
			$this->Page_Terminate("expenseslist.php"); // Invalid key, return to list
		switch ($expenses->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("expenseslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$expenses->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $expenses->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$expenses->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$expenses->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $expenses;

		// Get upload data
			if ($expenses->File_Upload->Upload->UploadFile()) {

				// No action required
			} else {
				echo $expenses->File_Upload->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expenses;
		$expenses->id->setFormValue($objForm->GetValue("x_id"));
		$expenses->expense_date->setFormValue($objForm->GetValue("x_expense_date"));
		$expenses->expense_date->CurrentValue = ew_UnFormatDateTime($expenses->expense_date->CurrentValue, 6);
		$expenses->expense_category_id->setFormValue($objForm->GetValue("x_expense_category_id"));
		$expenses->Reference_No->setFormValue($objForm->GetValue("x_Reference_No"));
		$expenses->Booking_ID->setFormValue($objForm->GetValue("x_Booking_ID"));
		$expenses->Description->setFormValue($objForm->GetValue("x_Description"));
		$expenses->Amount->setFormValue($objForm->GetValue("x_Amount"));
		$expenses->Vat->setFormValue($objForm->GetValue("x_Vat"));
		$expenses->Total_Sales->setFormValue($objForm->GetValue("x_Total_Sales"));
		$expenses->Wtax->setFormValue($objForm->GetValue("x_Wtax"));
		$expenses->Total_Amount_Due->setFormValue($objForm->GetValue("x_Total_Amount_Due"));
		$expenses->Expenses_Type_ID->setFormValue($objForm->GetValue("x_Expenses_Type_ID"));
		$expenses->Add_To_Billing->setFormValue($objForm->GetValue("x_Add_To_Billing"));
		$expenses->approver->setFormValue($objForm->GetValue("x_approver"));
		$expenses->employee_id->setFormValue($objForm->GetValue("x_employee_id"));
		$expenses->modified->setFormValue($objForm->GetValue("x_modified"));
		$expenses->modified->CurrentValue = ew_UnFormatDateTime($expenses->modified->CurrentValue, 6);
		$expenses->user_id->setFormValue($objForm->GetValue("x_user_id"));
		$expenses->payment_mode->setFormValue($objForm->GetValue("x_payment_mode"));
		$expenses->status->setFormValue($objForm->GetValue("x_status"));
		$expenses->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expenses;
		$this->LoadRow();
		$expenses->id->CurrentValue = $expenses->id->FormValue;
		$expenses->expense_date->CurrentValue = $expenses->expense_date->FormValue;
		$expenses->expense_date->CurrentValue = ew_UnFormatDateTime($expenses->expense_date->CurrentValue, 6);
		$expenses->expense_category_id->CurrentValue = $expenses->expense_category_id->FormValue;
		$expenses->Reference_No->CurrentValue = $expenses->Reference_No->FormValue;
		$expenses->Booking_ID->CurrentValue = $expenses->Booking_ID->FormValue;
		$expenses->Description->CurrentValue = $expenses->Description->FormValue;
		$expenses->Amount->CurrentValue = $expenses->Amount->FormValue;
		$expenses->Vat->CurrentValue = $expenses->Vat->FormValue;
		$expenses->Total_Sales->CurrentValue = $expenses->Total_Sales->FormValue;
		$expenses->Wtax->CurrentValue = $expenses->Wtax->FormValue;
		$expenses->Total_Amount_Due->CurrentValue = $expenses->Total_Amount_Due->FormValue;
		$expenses->Expenses_Type_ID->CurrentValue = $expenses->Expenses_Type_ID->FormValue;
		$expenses->Add_To_Billing->CurrentValue = $expenses->Add_To_Billing->FormValue;
		$expenses->approver->CurrentValue = $expenses->approver->FormValue;
		$expenses->employee_id->CurrentValue = $expenses->employee_id->FormValue;
		$expenses->modified->CurrentValue = $expenses->modified->FormValue;
		$expenses->modified->CurrentValue = ew_UnFormatDateTime($expenses->modified->CurrentValue, 6);
		$expenses->user_id->CurrentValue = $expenses->user_id->FormValue;
		$expenses->payment_mode->CurrentValue = $expenses->payment_mode->FormValue;
		$expenses->status->CurrentValue = $expenses->status->FormValue;
		$expenses->Remarks->CurrentValue = $expenses->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenses;
		$sFilter = $expenses->KeyFilter();

		// Call Row Selecting event
		$expenses->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenses->CurrentFilter = $sFilter;
		$sSql = $expenses->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$expenses->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expenses;
		$expenses->id->setDbValue($rs->fields('id'));
		$expenses->Date_Created->setDbValue($rs->fields('Date_Created'));
		$expenses->expense_date->setDbValue($rs->fields('expense_date'));
		$expenses->expense_category_id->setDbValue($rs->fields('expense_category_id'));
		$expenses->Reference_No->setDbValue($rs->fields('Reference_No'));
		$expenses->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$expenses->Description->setDbValue($rs->fields('Description'));
		$expenses->Amount->setDbValue($rs->fields('Amount'));
		$expenses->Vat->setDbValue($rs->fields('Vat'));
		$expenses->Total_Sales->setDbValue($rs->fields('Total_Sales'));
		$expenses->Wtax->setDbValue($rs->fields('Wtax'));
		$expenses->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$expenses->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$expenses->Expenses_Type_ID->setDbValue($rs->fields('Expenses_Type_ID'));
		$expenses->Add_To_Billing->setDbValue($rs->fields('Add_To_Billing'));
		$expenses->approver->setDbValue($rs->fields('approver'));
		$expenses->employee_id->setDbValue($rs->fields('employee_id'));
		$expenses->modified->setDbValue($rs->fields('modified'));
		$expenses->user_id->setDbValue($rs->fields('user_id'));
		$expenses->payment_mode->setDbValue($rs->fields('payment_mode'));
		$expenses->status->setDbValue($rs->fields('status'));
		$expenses->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenses;

		// Initialize URLs
		// Call Row_Rendering event

		$expenses->Row_Rendering();

		// Common render codes for all row types
		// id

		$expenses->id->CellCssStyle = ""; $expenses->id->CellCssClass = "";
		$expenses->id->CellAttrs = array(); $expenses->id->ViewAttrs = array(); $expenses->id->EditAttrs = array();

		// expense_date
		$expenses->expense_date->CellCssStyle = ""; $expenses->expense_date->CellCssClass = "";
		$expenses->expense_date->CellAttrs = array(); $expenses->expense_date->ViewAttrs = array(); $expenses->expense_date->EditAttrs = array();

		// expense_category_id
		$expenses->expense_category_id->CellCssStyle = ""; $expenses->expense_category_id->CellCssClass = "";
		$expenses->expense_category_id->CellAttrs = array(); $expenses->expense_category_id->ViewAttrs = array(); $expenses->expense_category_id->EditAttrs = array();

		// Reference_No
		$expenses->Reference_No->CellCssStyle = ""; $expenses->Reference_No->CellCssClass = "";
		$expenses->Reference_No->CellAttrs = array(); $expenses->Reference_No->ViewAttrs = array(); $expenses->Reference_No->EditAttrs = array();

		// Booking_ID
		$expenses->Booking_ID->CellCssStyle = ""; $expenses->Booking_ID->CellCssClass = "";
		$expenses->Booking_ID->CellAttrs = array(); $expenses->Booking_ID->ViewAttrs = array(); $expenses->Booking_ID->EditAttrs = array();

		// Description
		$expenses->Description->CellCssStyle = ""; $expenses->Description->CellCssClass = "";
		$expenses->Description->CellAttrs = array(); $expenses->Description->ViewAttrs = array(); $expenses->Description->EditAttrs = array();

		// Amount
		$expenses->Amount->CellCssStyle = ""; $expenses->Amount->CellCssClass = "";
		$expenses->Amount->CellAttrs = array(); $expenses->Amount->ViewAttrs = array(); $expenses->Amount->EditAttrs = array();

		// Vat
		$expenses->Vat->CellCssStyle = ""; $expenses->Vat->CellCssClass = "";
		$expenses->Vat->CellAttrs = array(); $expenses->Vat->ViewAttrs = array(); $expenses->Vat->EditAttrs = array();

		// Total_Sales
		$expenses->Total_Sales->CellCssStyle = ""; $expenses->Total_Sales->CellCssClass = "";
		$expenses->Total_Sales->CellAttrs = array(); $expenses->Total_Sales->ViewAttrs = array(); $expenses->Total_Sales->EditAttrs = array();

		// Wtax
		$expenses->Wtax->CellCssStyle = ""; $expenses->Wtax->CellCssClass = "";
		$expenses->Wtax->CellAttrs = array(); $expenses->Wtax->ViewAttrs = array(); $expenses->Wtax->EditAttrs = array();

		// Total_Amount_Due
		$expenses->Total_Amount_Due->CellCssStyle = ""; $expenses->Total_Amount_Due->CellCssClass = "";
		$expenses->Total_Amount_Due->CellAttrs = array(); $expenses->Total_Amount_Due->ViewAttrs = array(); $expenses->Total_Amount_Due->EditAttrs = array();

		// File_Upload
		$expenses->File_Upload->CellCssStyle = ""; $expenses->File_Upload->CellCssClass = "";
		$expenses->File_Upload->CellAttrs = array(); $expenses->File_Upload->ViewAttrs = array(); $expenses->File_Upload->EditAttrs = array();

		// Expenses_Type_ID
		$expenses->Expenses_Type_ID->CellCssStyle = ""; $expenses->Expenses_Type_ID->CellCssClass = "";
		$expenses->Expenses_Type_ID->CellAttrs = array(); $expenses->Expenses_Type_ID->ViewAttrs = array(); $expenses->Expenses_Type_ID->EditAttrs = array();

		// Add_To_Billing
		$expenses->Add_To_Billing->CellCssStyle = ""; $expenses->Add_To_Billing->CellCssClass = "";
		$expenses->Add_To_Billing->CellAttrs = array(); $expenses->Add_To_Billing->ViewAttrs = array(); $expenses->Add_To_Billing->EditAttrs = array();

		// approver
		$expenses->approver->CellCssStyle = ""; $expenses->approver->CellCssClass = "";
		$expenses->approver->CellAttrs = array(); $expenses->approver->ViewAttrs = array(); $expenses->approver->EditAttrs = array();

		// employee_id
		$expenses->employee_id->CellCssStyle = ""; $expenses->employee_id->CellCssClass = "";
		$expenses->employee_id->CellAttrs = array(); $expenses->employee_id->ViewAttrs = array(); $expenses->employee_id->EditAttrs = array();

		// modified
		$expenses->modified->CellCssStyle = ""; $expenses->modified->CellCssClass = "";
		$expenses->modified->CellAttrs = array(); $expenses->modified->ViewAttrs = array(); $expenses->modified->EditAttrs = array();

		// user_id
		$expenses->user_id->CellCssStyle = ""; $expenses->user_id->CellCssClass = "";
		$expenses->user_id->CellAttrs = array(); $expenses->user_id->ViewAttrs = array(); $expenses->user_id->EditAttrs = array();

		// payment_mode
		$expenses->payment_mode->CellCssStyle = ""; $expenses->payment_mode->CellCssClass = "";
		$expenses->payment_mode->CellAttrs = array(); $expenses->payment_mode->ViewAttrs = array(); $expenses->payment_mode->EditAttrs = array();

		// status
		$expenses->status->CellCssStyle = ""; $expenses->status->CellCssClass = "";
		$expenses->status->CellAttrs = array(); $expenses->status->ViewAttrs = array(); $expenses->status->EditAttrs = array();

		// Remarks
		$expenses->Remarks->CellCssStyle = ""; $expenses->Remarks->CellCssClass = "";
		$expenses->Remarks->CellAttrs = array(); $expenses->Remarks->ViewAttrs = array(); $expenses->Remarks->EditAttrs = array();
		if ($expenses->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expenses->id->ViewValue = $expenses->id->CurrentValue;
			$expenses->id->CssStyle = "";
			$expenses->id->CssClass = "";
			$expenses->id->ViewCustomAttributes = "";

			// Date_Created
			$expenses->Date_Created->ViewValue = $expenses->Date_Created->CurrentValue;
			$expenses->Date_Created->ViewValue = ew_FormatDateTime($expenses->Date_Created->ViewValue, 6);
			$expenses->Date_Created->CssStyle = "";
			$expenses->Date_Created->CssClass = "";
			$expenses->Date_Created->ViewCustomAttributes = "";

			// expense_date
			$expenses->expense_date->ViewValue = $expenses->expense_date->CurrentValue;
			$expenses->expense_date->ViewValue = ew_FormatDateTime($expenses->expense_date->ViewValue, 6);
			$expenses->expense_date->CssStyle = "";
			$expenses->expense_date->CssClass = "";
			$expenses->expense_date->ViewCustomAttributes = "";

			// expense_category_id
			if (strval($expenses->expense_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->expense_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `internal_reference`, `category_name` FROM `expense_categories`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `category_name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->expense_category_id->ViewValue = $rswrk->fields('internal_reference');
					$expenses->expense_category_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('category_name');
					$rswrk->Close();
				} else {
					$expenses->expense_category_id->ViewValue = $expenses->expense_category_id->CurrentValue;
				}
			} else {
				$expenses->expense_category_id->ViewValue = NULL;
			}
			$expenses->expense_category_id->CssStyle = "";
			$expenses->expense_category_id->CssClass = "";
			$expenses->expense_category_id->ViewCustomAttributes = "";

			// Reference_No
			$expenses->Reference_No->ViewValue = $expenses->Reference_No->CurrentValue;
			$expenses->Reference_No->CssStyle = "";
			$expenses->Reference_No->CssClass = "";
			$expenses->Reference_No->ViewCustomAttributes = "";

			// Booking_ID
			$expenses->Booking_ID->ViewValue = $expenses->Booking_ID->CurrentValue;
			if (strval($expenses->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$expenses->Booking_ID->ViewValue = $expenses->Booking_ID->CurrentValue;
				}
			} else {
				$expenses->Booking_ID->ViewValue = NULL;
			}
			$expenses->Booking_ID->CssStyle = "";
			$expenses->Booking_ID->CssClass = "";
			$expenses->Booking_ID->ViewCustomAttributes = "";

			// Description
			$expenses->Description->ViewValue = $expenses->Description->CurrentValue;
			$expenses->Description->CssStyle = "";
			$expenses->Description->CssClass = "";
			$expenses->Description->ViewCustomAttributes = "";

			// Amount
			$expenses->Amount->ViewValue = $expenses->Amount->CurrentValue;
			$expenses->Amount->ViewValue = ew_FormatNumber($expenses->Amount->ViewValue, 2, -2, -2, -2);
			$expenses->Amount->CssStyle = "";
			$expenses->Amount->CssClass = "";
			$expenses->Amount->ViewCustomAttributes = "";

			// Vat
			$expenses->Vat->ViewValue = $expenses->Vat->CurrentValue;
			$expenses->Vat->ViewValue = ew_FormatNumber($expenses->Vat->ViewValue, 2, -2, -2, -2);
			$expenses->Vat->CssStyle = "";
			$expenses->Vat->CssClass = "";
			$expenses->Vat->ViewCustomAttributes = "";

			// Total_Sales
			$expenses->Total_Sales->ViewValue = $expenses->Total_Sales->CurrentValue;
			$expenses->Total_Sales->ViewValue = ew_FormatNumber($expenses->Total_Sales->ViewValue, 2, -2, -2, -2);
			$expenses->Total_Sales->CssStyle = "";
			$expenses->Total_Sales->CssClass = "";
			$expenses->Total_Sales->ViewCustomAttributes = "";

			// Wtax
			$expenses->Wtax->ViewValue = $expenses->Wtax->CurrentValue;
			$expenses->Wtax->ViewValue = ew_FormatNumber($expenses->Wtax->ViewValue, 2, -2, -2, -2);
			$expenses->Wtax->CssStyle = "";
			$expenses->Wtax->CssClass = "";
			$expenses->Wtax->ViewCustomAttributes = "";

			// Total_Amount_Due
			$expenses->Total_Amount_Due->ViewValue = $expenses->Total_Amount_Due->CurrentValue;
			$expenses->Total_Amount_Due->ViewValue = ew_FormatNumber($expenses->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$expenses->Total_Amount_Due->CssStyle = "";
			$expenses->Total_Amount_Due->CssClass = "";
			$expenses->Total_Amount_Due->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($expenses->File_Upload->Upload->DbValue)) {
				$expenses->File_Upload->ViewValue = $expenses->File_Upload->Upload->DbValue;
			} else {
				$expenses->File_Upload->ViewValue = "";
			}
			$expenses->File_Upload->CssStyle = "";
			$expenses->File_Upload->CssClass = "";
			$expenses->File_Upload->ViewCustomAttributes = "";

			// Expenses_Type_ID
			if (strval($expenses->Expenses_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->Expenses_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Expenses_Type` FROM `expenses_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->Expenses_Type_ID->ViewValue = $rswrk->fields('Expenses_Type');
					$rswrk->Close();
				} else {
					$expenses->Expenses_Type_ID->ViewValue = $expenses->Expenses_Type_ID->CurrentValue;
				}
			} else {
				$expenses->Expenses_Type_ID->ViewValue = NULL;
			}
			$expenses->Expenses_Type_ID->CssStyle = "";
			$expenses->Expenses_Type_ID->CssClass = "";
			$expenses->Expenses_Type_ID->ViewCustomAttributes = "";

			// Add_To_Billing
			if (strval($expenses->Add_To_Billing->CurrentValue) <> "") {
				switch ($expenses->Add_To_Billing->CurrentValue) {
					case "YES":
						$expenses->Add_To_Billing->ViewValue = "YES";
						break;
					case "NO":
						$expenses->Add_To_Billing->ViewValue = "NO";
						break;
					default:
						$expenses->Add_To_Billing->ViewValue = $expenses->Add_To_Billing->CurrentValue;
				}
			} else {
				$expenses->Add_To_Billing->ViewValue = NULL;
			}
			$expenses->Add_To_Billing->CssStyle = "";
			$expenses->Add_To_Billing->CssClass = "";
			$expenses->Add_To_Billing->ViewCustomAttributes = "";

			// approver
			if (strval($expenses->approver->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->approver->CurrentValue) . "";
			$sSqlWrk = "SELECT `FirstName`, `LastName` FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `FirstName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->approver->ViewValue = $rswrk->fields('FirstName');
					$expenses->approver->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('LastName');
					$rswrk->Close();
				} else {
					$expenses->approver->ViewValue = $expenses->approver->CurrentValue;
				}
			} else {
				$expenses->approver->ViewValue = NULL;
			}
			$expenses->approver->CssStyle = "";
			$expenses->approver->CssClass = "";
			$expenses->approver->ViewCustomAttributes = "";

			// employee_id
			if (strval($expenses->employee_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->employee_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `FirstName`, `LastName` FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `FirstName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->employee_id->ViewValue = $rswrk->fields('FirstName');
					$expenses->employee_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('LastName');
					$rswrk->Close();
				} else {
					$expenses->employee_id->ViewValue = $expenses->employee_id->CurrentValue;
				}
			} else {
				$expenses->employee_id->ViewValue = NULL;
			}
			$expenses->employee_id->CssStyle = "";
			$expenses->employee_id->CssClass = "";
			$expenses->employee_id->ViewCustomAttributes = "";

			// modified
			$expenses->modified->ViewValue = $expenses->modified->CurrentValue;
			$expenses->modified->ViewValue = ew_FormatDateTime($expenses->modified->ViewValue, 6);
			$expenses->modified->CssStyle = "";
			$expenses->modified->CssClass = "";
			$expenses->modified->ViewCustomAttributes = "";

			// user_id
			$expenses->user_id->ViewValue = $expenses->user_id->CurrentValue;
			$expenses->user_id->CssStyle = "";
			$expenses->user_id->CssClass = "";
			$expenses->user_id->ViewCustomAttributes = "";

			// payment_mode
			if (strval($expenses->payment_mode->CurrentValue) <> "") {
				switch ($expenses->payment_mode->CurrentValue) {
					case "reimburse":
						$expenses->payment_mode->ViewValue = "Employee (to reimburse)";
						break;
					case "company":
						$expenses->payment_mode->ViewValue = "Company";
						break;
					default:
						$expenses->payment_mode->ViewValue = $expenses->payment_mode->CurrentValue;
				}
			} else {
				$expenses->payment_mode->ViewValue = NULL;
			}
			$expenses->payment_mode->CssStyle = "";
			$expenses->payment_mode->CssClass = "";
			$expenses->payment_mode->ViewCustomAttributes = "";

			// status
			if (strval($expenses->status->CurrentValue) <> "") {
				switch ($expenses->status->CurrentValue) {
					case "for_approval":
						$expenses->status->ViewValue = "For Approval";
						break;
					case "approved":
						$expenses->status->ViewValue = "Approved";
						break;
					case "declined":
						$expenses->status->ViewValue = "Declined";
						break;
					case "done":
						$expenses->status->ViewValue = "Done";
						break;
					default:
						$expenses->status->ViewValue = $expenses->status->CurrentValue;
				}
			} else {
				$expenses->status->ViewValue = NULL;
			}
			$expenses->status->CssStyle = "";
			$expenses->status->CssClass = "";
			$expenses->status->ViewCustomAttributes = "";

			// Remarks
			$expenses->Remarks->ViewValue = $expenses->Remarks->CurrentValue;
			$expenses->Remarks->CssStyle = "";
			$expenses->Remarks->CssClass = "";
			$expenses->Remarks->ViewCustomAttributes = "";

			// id
			$expenses->id->HrefValue = "";
			$expenses->id->TooltipValue = "";

			// expense_date
			$expenses->expense_date->HrefValue = "";
			$expenses->expense_date->TooltipValue = "";

			// expense_category_id
			$expenses->expense_category_id->HrefValue = "";
			$expenses->expense_category_id->TooltipValue = "";

			// Reference_No
			$expenses->Reference_No->HrefValue = "";
			$expenses->Reference_No->TooltipValue = "";

			// Booking_ID
			$expenses->Booking_ID->HrefValue = "";
			$expenses->Booking_ID->TooltipValue = "";

			// Description
			$expenses->Description->HrefValue = "";
			$expenses->Description->TooltipValue = "";

			// Amount
			$expenses->Amount->HrefValue = "";
			$expenses->Amount->TooltipValue = "";

			// Vat
			$expenses->Vat->HrefValue = "";
			$expenses->Vat->TooltipValue = "";

			// Total_Sales
			$expenses->Total_Sales->HrefValue = "";
			$expenses->Total_Sales->TooltipValue = "";

			// Wtax
			$expenses->Wtax->HrefValue = "";
			$expenses->Wtax->TooltipValue = "";

			// Total_Amount_Due
			$expenses->Total_Amount_Due->HrefValue = "";
			$expenses->Total_Amount_Due->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($expenses->File_Upload->Upload->DbValue)) {
				$expenses->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $expenses->File_Upload->UploadPath) . ((!empty($expenses->File_Upload->ViewValue)) ? $expenses->File_Upload->ViewValue : $expenses->File_Upload->CurrentValue);
				if ($expenses->Export <> "") $expenses->File_Upload->HrefValue = ew_ConvertFullUrl($expenses->File_Upload->HrefValue);
			} else {
				$expenses->File_Upload->HrefValue = "";
			}
			$expenses->File_Upload->TooltipValue = "";

			// Expenses_Type_ID
			$expenses->Expenses_Type_ID->HrefValue = "";
			$expenses->Expenses_Type_ID->TooltipValue = "";

			// Add_To_Billing
			$expenses->Add_To_Billing->HrefValue = "";
			$expenses->Add_To_Billing->TooltipValue = "";

			// approver
			$expenses->approver->HrefValue = "";
			$expenses->approver->TooltipValue = "";

			// employee_id
			$expenses->employee_id->HrefValue = "";
			$expenses->employee_id->TooltipValue = "";

			// modified
			$expenses->modified->HrefValue = "";
			$expenses->modified->TooltipValue = "";

			// user_id
			$expenses->user_id->HrefValue = "";
			$expenses->user_id->TooltipValue = "";

			// payment_mode
			$expenses->payment_mode->HrefValue = "";
			$expenses->payment_mode->TooltipValue = "";

			// status
			$expenses->status->HrefValue = "";
			$expenses->status->TooltipValue = "";

			// Remarks
			$expenses->Remarks->HrefValue = "";
			$expenses->Remarks->TooltipValue = "";
		} elseif ($expenses->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$expenses->id->EditCustomAttributes = "";
			$expenses->id->EditValue = $expenses->id->CurrentValue;
			$expenses->id->CssStyle = "";
			$expenses->id->CssClass = "";
			$expenses->id->ViewCustomAttributes = "";

			// expense_date
			$expenses->expense_date->EditCustomAttributes = "";
			$expenses->expense_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($expenses->expense_date->CurrentValue, 6));

			// expense_category_id
			$expenses->expense_category_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `internal_reference`, `category_name`, '' AS SelectFilterFld FROM `expense_categories`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `category_name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$expenses->expense_category_id->EditValue = $arwrk;

			// Reference_No
			$expenses->Reference_No->EditCustomAttributes = "";
			$expenses->Reference_No->EditValue = ew_HtmlEncode($expenses->Reference_No->CurrentValue);

			// Booking_ID
			$expenses->Booking_ID->EditCustomAttributes = "";
			if ($expenses->Booking_ID->getSessionValue() <> "") {
				$expenses->Booking_ID->CurrentValue = $expenses->Booking_ID->getSessionValue();
			$expenses->Booking_ID->ViewValue = $expenses->Booking_ID->CurrentValue;
			if (strval($expenses->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$expenses->Booking_ID->ViewValue = $expenses->Booking_ID->CurrentValue;
				}
			} else {
				$expenses->Booking_ID->ViewValue = NULL;
			}
			$expenses->Booking_ID->CssStyle = "";
			$expenses->Booking_ID->CssClass = "";
			$expenses->Booking_ID->ViewCustomAttributes = "";
			} else {
			$expenses->Booking_ID->EditValue = ew_HtmlEncode($expenses->Booking_ID->CurrentValue);
			if (strval($expenses->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->Booking_ID->EditValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$expenses->Booking_ID->EditValue = $expenses->Booking_ID->CurrentValue;
				}
			} else {
				$expenses->Booking_ID->EditValue = NULL;
			}
			}

			// Description
			$expenses->Description->EditCustomAttributes = "";
			$expenses->Description->EditValue = ew_HtmlEncode($expenses->Description->CurrentValue);

			// Amount
			$expenses->Amount->EditCustomAttributes = "";
			$expenses->Amount->EditValue = ew_HtmlEncode($expenses->Amount->CurrentValue);

			// Vat
			$expenses->Vat->EditCustomAttributes = "";
			$expenses->Vat->EditValue = ew_HtmlEncode($expenses->Vat->CurrentValue);

			// Total_Sales
			$expenses->Total_Sales->EditCustomAttributes = "";
			$expenses->Total_Sales->EditValue = ew_HtmlEncode($expenses->Total_Sales->CurrentValue);

			// Wtax
			$expenses->Wtax->EditCustomAttributes = "";
			$expenses->Wtax->EditValue = ew_HtmlEncode($expenses->Wtax->CurrentValue);

			// Total_Amount_Due
			$expenses->Total_Amount_Due->EditCustomAttributes = "";
			$expenses->Total_Amount_Due->EditValue = ew_HtmlEncode($expenses->Total_Amount_Due->CurrentValue);

			// File_Upload
			$expenses->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($expenses->File_Upload->Upload->DbValue)) {
				$expenses->File_Upload->EditValue = $expenses->File_Upload->Upload->DbValue;
			} else {
				$expenses->File_Upload->EditValue = "";
			}

			// Expenses_Type_ID
			$expenses->Expenses_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Expenses_Type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `expenses_types`";
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
			$expenses->Expenses_Type_ID->EditValue = $arwrk;

			// Add_To_Billing
			$expenses->Add_To_Billing->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("YES", "YES");
			$arwrk[] = array("NO", "NO");
			$expenses->Add_To_Billing->EditValue = $arwrk;

			// approver
			$expenses->approver->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `FirstName`, `LastName`, '' AS SelectFilterFld FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `FirstName` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$expenses->approver->EditValue = $arwrk;

			// employee_id
			$expenses->employee_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `FirstName`, `LastName`, `manager` FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `FirstName` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$expenses->employee_id->EditValue = $arwrk;

			// modified
			// user_id
			// payment_mode

			$expenses->payment_mode->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("reimburse", "Employee (to reimburse)");
			$arwrk[] = array("company", "Company");
			$expenses->payment_mode->EditValue = $arwrk;

			// status
			$expenses->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("for_approval", "For Approval");
			$arwrk[] = array("approved", "Approved");
			$arwrk[] = array("declined", "Declined");
			$arwrk[] = array("done", "Done");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$expenses->status->EditValue = $arwrk;

			// Remarks
			$expenses->Remarks->EditCustomAttributes = "";
			$expenses->Remarks->EditValue = ew_HtmlEncode($expenses->Remarks->CurrentValue);

			// Edit refer script
			// id

			$expenses->id->HrefValue = "";

			// expense_date
			$expenses->expense_date->HrefValue = "";

			// expense_category_id
			$expenses->expense_category_id->HrefValue = "";

			// Reference_No
			$expenses->Reference_No->HrefValue = "";

			// Booking_ID
			$expenses->Booking_ID->HrefValue = "";

			// Description
			$expenses->Description->HrefValue = "";

			// Amount
			$expenses->Amount->HrefValue = "";

			// Vat
			$expenses->Vat->HrefValue = "";

			// Total_Sales
			$expenses->Total_Sales->HrefValue = "";

			// Wtax
			$expenses->Wtax->HrefValue = "";

			// Total_Amount_Due
			$expenses->Total_Amount_Due->HrefValue = "";

			// File_Upload
			if (!ew_Empty($expenses->File_Upload->Upload->DbValue)) {
				$expenses->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $expenses->File_Upload->UploadPath) . ((!empty($expenses->File_Upload->EditValue)) ? $expenses->File_Upload->EditValue : $expenses->File_Upload->CurrentValue);
				if ($expenses->Export <> "") $expenses->File_Upload->HrefValue = ew_ConvertFullUrl($expenses->File_Upload->HrefValue);
			} else {
				$expenses->File_Upload->HrefValue = "";
			}

			// Expenses_Type_ID
			$expenses->Expenses_Type_ID->HrefValue = "";

			// Add_To_Billing
			$expenses->Add_To_Billing->HrefValue = "";

			// approver
			$expenses->approver->HrefValue = "";

			// employee_id
			$expenses->employee_id->HrefValue = "";

			// modified
			$expenses->modified->HrefValue = "";

			// user_id
			$expenses->user_id->HrefValue = "";

			// payment_mode
			$expenses->payment_mode->HrefValue = "";

			// status
			$expenses->status->HrefValue = "";

			// Remarks
			$expenses->Remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($expenses->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenses->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $expenses;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($expenses->File_Upload->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($expenses->File_Upload->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $expenses->File_Upload->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckUSDate($expenses->expense_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expenses->expense_date->FldErrMsg();
		}
		if (!is_null($expenses->expense_category_id->FormValue) && $expenses->expense_category_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $expenses->expense_category_id->FldCaption();
		}
		if (!is_null($expenses->Reference_No->FormValue) && $expenses->Reference_No->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $expenses->Reference_No->FldCaption();
		}
		if (!ew_CheckInteger($expenses->Booking_ID->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expenses->Booking_ID->FldErrMsg();
		}
		if (!is_null($expenses->Description->FormValue) && $expenses->Description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $expenses->Description->FldCaption();
		}
		if (!is_null($expenses->Amount->FormValue) && $expenses->Amount->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $expenses->Amount->FldCaption();
		}
		if (!ew_CheckNumber($expenses->Amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expenses->Amount->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Vat->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expenses->Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Total_Sales->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expenses->Total_Sales->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Wtax->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expenses->Wtax->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Total_Amount_Due->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $expenses->Total_Amount_Due->FldErrMsg();
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
		global $conn, $Security, $Language, $expenses;
		$sFilter = $expenses->KeyFilter();
		$expenses->CurrentFilter = $sFilter;
		$sSql = $expenses->SQL();
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

			// expense_date
			$expenses->expense_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($expenses->expense_date->CurrentValue, 6, FALSE), NULL);

			// expense_category_id
			$expenses->expense_category_id->SetDbValueDef($rsnew, $expenses->expense_category_id->CurrentValue, NULL, FALSE);

			// Reference_No
			$expenses->Reference_No->SetDbValueDef($rsnew, $expenses->Reference_No->CurrentValue, NULL, FALSE);

			// Booking_ID
			$expenses->Booking_ID->SetDbValueDef($rsnew, $expenses->Booking_ID->CurrentValue, NULL, FALSE);

			// Description
			$expenses->Description->SetDbValueDef($rsnew, $expenses->Description->CurrentValue, NULL, FALSE);

			// Amount
			$expenses->Amount->SetDbValueDef($rsnew, $expenses->Amount->CurrentValue, NULL, FALSE);

			// Vat
			$expenses->Vat->SetDbValueDef($rsnew, $expenses->Vat->CurrentValue, NULL, FALSE);

			// Total_Sales
			$expenses->Total_Sales->SetDbValueDef($rsnew, $expenses->Total_Sales->CurrentValue, NULL, FALSE);

			// Wtax
			$expenses->Wtax->SetDbValueDef($rsnew, $expenses->Wtax->CurrentValue, NULL, FALSE);

			// Total_Amount_Due
			$expenses->Total_Amount_Due->SetDbValueDef($rsnew, $expenses->Total_Amount_Due->CurrentValue, NULL, FALSE);

			// File_Upload
			$expenses->File_Upload->Upload->SaveToSession(); // Save file value to Session
						if ($expenses->File_Upload->Upload->Action == "2" || $expenses->File_Upload->Upload->Action == "3") { // Update/Remove
			$expenses->File_Upload->Upload->DbValue = $rs->fields('File_Upload'); // Get original value
			if (is_null($expenses->File_Upload->Upload->Value)) {
				$rsnew['File_Upload'] = NULL;
			} else {
				$rsnew['File_Upload'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $expenses->File_Upload->UploadPath), $expenses->File_Upload->Upload->FileName);
			}
			}

			// Expenses_Type_ID
			$expenses->Expenses_Type_ID->SetDbValueDef($rsnew, $expenses->Expenses_Type_ID->CurrentValue, NULL, FALSE);

			// Add_To_Billing
			$expenses->Add_To_Billing->SetDbValueDef($rsnew, $expenses->Add_To_Billing->CurrentValue, NULL, FALSE);

			// approver
			$expenses->approver->SetDbValueDef($rsnew, $expenses->approver->CurrentValue, NULL, FALSE);

			// employee_id
			$expenses->employee_id->SetDbValueDef($rsnew, $expenses->employee_id->CurrentValue, NULL, FALSE);

			// modified
			$expenses->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['modified'] =& $expenses->modified->DbValue;

			// user_id
			$expenses->user_id->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['user_id'] =& $expenses->user_id->DbValue;

			// payment_mode
			$expenses->payment_mode->SetDbValueDef($rsnew, $expenses->payment_mode->CurrentValue, NULL, FALSE);

			// status
			$expenses->status->SetDbValueDef($rsnew, $expenses->status->CurrentValue, NULL, FALSE);

			// Remarks
			$expenses->Remarks->SetDbValueDef($rsnew, $expenses->Remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $expenses->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($expenses->File_Upload->Upload->Value)) {
				$expenses->File_Upload->Upload->SaveToFile($expenses->File_Upload->UploadPath, $rsnew['File_Upload'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($expenses->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($expenses->CancelMessage <> "") {
					$this->setMessage($expenses->CancelMessage);
					$expenses->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$expenses->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// File_Upload
		$expenses->File_Upload->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $expenses;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "bookings") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $expenses->SqlMasterFilter_bookings();
				$this->sDbDetailFilter = $expenses->SqlDetailFilter_bookings();
				if (@$_GET["id"] <> "") {
					$GLOBALS["bookings"]->id->setQueryStringValue($_GET["id"]);
					$expenses->Booking_ID->setQueryStringValue($GLOBALS["bookings"]->id->QueryStringValue);
					$expenses->Booking_ID->setSessionValue($expenses->Booking_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["bookings"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["bookings"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Booking_ID@", ew_AdjustSql($GLOBALS["bookings"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "accounts_receivable") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $expenses->SqlMasterFilter_accounts_receivable();
				$this->sDbDetailFilter = $expenses->SqlDetailFilter_accounts_receivable();
				if (@$_GET["id"] <> "") {
					$GLOBALS["accounts_receivable"]->id->setQueryStringValue($_GET["id"]);
					$expenses->Booking_ID->setQueryStringValue($GLOBALS["accounts_receivable"]->id->QueryStringValue);
					$expenses->Booking_ID->setSessionValue($expenses->Booking_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["accounts_receivable"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["accounts_receivable"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Booking_ID@", ew_AdjustSql($GLOBALS["accounts_receivable"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$expenses->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$expenses->setStartRecordNumber($this->lStartRec);
			$expenses->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$expenses->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "bookings") {
				if ($expenses->Booking_ID->QueryStringValue == "") $expenses->Booking_ID->setSessionValue("");
			}
			if ($sMasterTblVar <> "accounts_receivable") {
				if ($expenses->Booking_ID->QueryStringValue == "") $expenses->Booking_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $expenses->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $expenses->getDetailFilter(); // Restore detail filter
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
