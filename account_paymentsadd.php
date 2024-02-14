<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "account_paymentsinfo.php" ?>
<?php include "clientsinfo.php" ?>
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
$account_payments_add = new caccount_payments_add();
$Page =& $account_payments_add;

// Page init
$account_payments_add->Page_Init();

// Page main
$account_payments_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var account_payments_add = new ew_Page("account_payments_add");

// page properties
account_payments_add.PageID = "add"; // page ID
account_payments_add.FormID = "faccount_paymentsadd"; // form ID
var EW_PAGE_ID = account_payments_add.PageID; // for backward compatibility

// extend page with ValidateForm function
account_payments_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($account_payments->Date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Payment_Date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($account_payments->Payment_Date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Payment_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Payment_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Payment_Type"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($account_payments->Payment_Type->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Payment_Method_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($account_payments->Payment_Method_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_total_invoice_items"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->total_invoice_items->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
account_payments_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
account_payments_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
account_payments_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
account_payments_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $account_payments->TableCaption() ?><br><br>
<a href="<?php echo $account_payments->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payments_add->ShowMessage();
?>
<form name="faccount_paymentsadd" id="faccount_paymentsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return account_payments_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="account_payments">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($account_payments->Date->Visible) { // Date ?>
	<tr<?php echo $account_payments->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $account_payments->Date->CellAttributes() ?>><span id="el_Date">
<input type="text" name="x_Date" id="x_Date" title="<?php echo $account_payments->Date->FldTitle() ?>" value="<?php echo $account_payments->Date->EditValue ?>"<?php echo $account_payments->Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date" name="cal_x_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Date" // button id
});
</script>
</span><?php echo $account_payments->Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Payment_Reference->Visible) { // Payment_Reference ?>
	<tr<?php echo $account_payments->Payment_Reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Reference->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Reference->CellAttributes() ?>><span id="el_Payment_Reference">
<input type="text" name="x_Payment_Reference" id="x_Payment_Reference" title="<?php echo $account_payments->Payment_Reference->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $account_payments->Payment_Reference->EditValue ?>"<?php echo $account_payments->Payment_Reference->EditAttributes() ?>>
</span><?php echo $account_payments->Payment_Reference->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Payment_Date->Visible) { // Payment_Date ?>
	<tr<?php echo $account_payments->Payment_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $account_payments->Payment_Date->CellAttributes() ?>><span id="el_Payment_Date">
<input type="text" name="x_Payment_Date" id="x_Payment_Date" title="<?php echo $account_payments->Payment_Date->FldTitle() ?>" value="<?php echo $account_payments->Payment_Date->EditValue ?>"<?php echo $account_payments->Payment_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Payment_Date" name="cal_x_Payment_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Payment_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Payment_Date" // button id
});
</script>
</span><?php echo $account_payments->Payment_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Payment_Type->Visible) { // Payment_Type ?>
	<tr<?php echo $account_payments->Payment_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Type->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $account_payments->Payment_Type->CellAttributes() ?>><span id="el_Payment_Type">
<div id="tp_x_Payment_Type" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_Payment_Type" id="x_Payment_Type" title="<?php echo $account_payments->Payment_Type->FldTitle() ?>" value="{value}"<?php echo $account_payments->Payment_Type->EditAttributes() ?>></label></div>
<div id="dsl_x_Payment_Type" repeatcolumn="5">
<?php
$arwrk = $account_payments->Payment_Type->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Payment_Type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_Payment_Type" id="x_Payment_Type" title="<?php echo $account_payments->Payment_Type->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $account_payments->Payment_Type->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $account_payments->Payment_Type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Journal_Type_ID->Visible) { // Journal_Type_ID ?>
	<tr<?php echo $account_payments->Journal_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Journal_Type_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Journal_Type_ID->CellAttributes() ?>><span id="el_Journal_Type_ID">
<?php $account_payments->Journal_Type_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Journal_Account_ID','x_Journal_Type_ID',account_payments_add.ar_x_Journal_Account_ID); " . @$account_payments->Journal_Type_ID->EditAttrs["onchange"]; ?>
<select id="x_Journal_Type_ID" name="x_Journal_Type_ID" title="<?php echo $account_payments->Journal_Type_ID->FldTitle() ?>"<?php echo $account_payments->Journal_Type_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Journal_Type_ID->EditValue)) {
	$arwrk = $account_payments->Journal_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Journal_Type_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $account_payments->Journal_Type_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Journal_Account_ID->Visible) { // Journal_Account_ID ?>
	<tr<?php echo $account_payments->Journal_Account_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Journal_Account_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Journal_Account_ID->CellAttributes() ?>><span id="el_Journal_Account_ID">
<select id="x_Journal_Account_ID" name="x_Journal_Account_ID" title="<?php echo $account_payments->Journal_Account_ID->FldTitle() ?>"<?php echo $account_payments->Journal_Account_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Journal_Account_ID->EditValue)) {
	$arwrk = $account_payments->Journal_Account_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Journal_Account_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$jswrk = "";
if (is_array($account_payments->Journal_Account_ID->EditValue)) {
	$arwrk = $account_payments->Journal_Account_ID->EditValue;
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
account_payments_add.ar_x_Journal_Account_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $account_payments->Journal_Account_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Payment_Method_ID->Visible) { // Payment_Method_ID ?>
	<tr<?php echo $account_payments->Payment_Method_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Method_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $account_payments->Payment_Method_ID->CellAttributes() ?>><span id="el_Payment_Method_ID">
<select id="x_Payment_Method_ID" name="x_Payment_Method_ID" title="<?php echo $account_payments->Payment_Method_ID->FldTitle() ?>"<?php echo $account_payments->Payment_Method_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Payment_Method_ID->EditValue)) {
	$arwrk = $account_payments->Payment_Method_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Payment_Method_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php if (AllowAdd("account_payment_methods")) { ?>
&nbsp;<a name="aol_x_Payment_Method_ID" id="aol_x_Payment_Method_ID" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:account_payments_add,lnk:'aol_x_Payment_Method_ID',el:'x_Payment_Method_ID',hdr:this.innerHTML, url:'account_payment_methodsaddopt.php',lf:'x_id',df:'x_Payment_Method',df2:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $account_payments->Payment_Method_ID->FldCaption() ?></a>
<?php } ?>
</span><?php echo $account_payments->Payment_Method_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Vendor_ID->Visible) { // Vendor_ID ?>
	<tr<?php echo $account_payments->Vendor_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Vendor_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Vendor_ID->CellAttributes() ?>><span id="el_Vendor_ID">
<select id="x_Vendor_ID" name="x_Vendor_ID" title="<?php echo $account_payments->Vendor_ID->FldTitle() ?>"<?php echo $account_payments->Vendor_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Vendor_ID->EditValue)) {
	$arwrk = $account_payments->Vendor_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Vendor_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $account_payments->Vendor_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Client_ID->Visible) { // Client_ID ?>
	<tr<?php echo $account_payments->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Client_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Client_ID->CellAttributes() ?>><span id="el_Client_ID">
<?php if ($account_payments->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $account_payments->Client_ID->ViewAttributes() ?>><?php echo $account_payments->Client_ID->ViewValue ?></div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($account_payments->Client_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $account_payments->Client_ID->FldTitle() ?>"<?php echo $account_payments->Client_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Client_ID->EditValue)) {
	$arwrk = $account_payments->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Client_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $account_payments->Client_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Amount->Visible) { // Amount ?>
	<tr<?php echo $account_payments->Amount->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Amount->FldCaption() ?></td>
		<td<?php echo $account_payments->Amount->CellAttributes() ?>><span id="el_Amount">
<input type="text" name="x_Amount" id="x_Amount" title="<?php echo $account_payments->Amount->FldTitle() ?>" size="30" value="<?php echo $account_payments->Amount->EditValue ?>"<?php echo $account_payments->Amount->EditAttributes() ?>>
</span><?php echo $account_payments->Amount->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Status_ID->Visible) { // Status_ID ?>
	<tr<?php echo $account_payments->Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Status_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Status_ID->CellAttributes() ?>><span id="el_Status_ID">
<select id="x_Status_ID" name="x_Status_ID" title="<?php echo $account_payments->Status_ID->FldTitle() ?>"<?php echo $account_payments->Status_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Status_ID->EditValue)) {
	$arwrk = $account_payments->Status_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Status_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $account_payments->Status_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Description->Visible) { // Description ?>
	<tr<?php echo $account_payments->Description->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Description->FldCaption() ?></td>
		<td<?php echo $account_payments->Description->CellAttributes() ?>><span id="el_Description">
<textarea name="x_Description" id="x_Description" title="<?php echo $account_payments->Description->FldTitle() ?>" cols="35" rows="4"<?php echo $account_payments->Description->EditAttributes() ?>><?php echo $account_payments->Description->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Description", function() {
	var oCKeditor = CKEDITOR.replace('x_Description', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $account_payments->Description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $account_payments->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Remarks->FldCaption() ?></td>
		<td<?php echo $account_payments->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $account_payments->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $account_payments->Remarks->EditAttributes() ?>><?php echo $account_payments->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $account_payments->Remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($account_payments->total_invoice_items->Visible) { // total_invoice_items ?>
	<tr<?php echo $account_payments->total_invoice_items->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->total_invoice_items->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $account_payments->total_invoice_items->CellAttributes() ?>><span id="el_total_invoice_items">
<input type="text" name="x_total_invoice_items" id="x_total_invoice_items" title="<?php echo $account_payments->total_invoice_items->FldTitle() ?>" size="30" value="<?php echo $account_payments->total_invoice_items->EditValue ?>"<?php echo $account_payments->total_invoice_items->EditAttributes() ?>>
</span><?php echo $account_payments->total_invoice_items->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_Journal_Account_ID','x_Journal_Type_ID',account_payments_add.ar_x_Journal_Account_ID]]);

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
$account_payments_add->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payments_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'account_payments';

	// Page object name
	var $PageObjName = 'account_payments_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $account_payments;
		if ($account_payments->UseTokenInUrl) $PageUrl .= "t=" . $account_payments->TableVar . "&"; // Add page token
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
		global $objForm, $account_payments;
		if ($account_payments->UseTokenInUrl) {
			if ($objForm)
				return ($account_payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($account_payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caccount_payments_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (account_payments)
		$GLOBALS["account_payments"] = new caccount_payments();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'account_payments', TRUE);

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
		global $account_payments;

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
			$this->Page_Terminate("account_paymentslist.php");
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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $account_payments;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $account_payments->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $account_payments->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$account_payments->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $account_payments->CurrentAction = "C"; // Copy record
		  } else {
		    $account_payments->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($account_payments->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("account_paymentslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$account_payments->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $account_payments->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$account_payments->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $account_payments;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $account_payments;
		$account_payments->total_invoice_items->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $account_payments;
		$account_payments->Date->setFormValue($objForm->GetValue("x_Date"));
		$account_payments->Date->CurrentValue = ew_UnFormatDateTime($account_payments->Date->CurrentValue, 6);
		$account_payments->Payment_Reference->setFormValue($objForm->GetValue("x_Payment_Reference"));
		$account_payments->Payment_Date->setFormValue($objForm->GetValue("x_Payment_Date"));
		$account_payments->Payment_Date->CurrentValue = ew_UnFormatDateTime($account_payments->Payment_Date->CurrentValue, 6);
		$account_payments->Payment_Type->setFormValue($objForm->GetValue("x_Payment_Type"));
		$account_payments->Journal_Type_ID->setFormValue($objForm->GetValue("x_Journal_Type_ID"));
		$account_payments->Journal_Account_ID->setFormValue($objForm->GetValue("x_Journal_Account_ID"));
		$account_payments->Payment_Method_ID->setFormValue($objForm->GetValue("x_Payment_Method_ID"));
		$account_payments->Vendor_ID->setFormValue($objForm->GetValue("x_Vendor_ID"));
		$account_payments->Client_ID->setFormValue($objForm->GetValue("x_Client_ID"));
		$account_payments->Amount->setFormValue($objForm->GetValue("x_Amount"));
		$account_payments->Status_ID->setFormValue($objForm->GetValue("x_Status_ID"));
		$account_payments->Description->setFormValue($objForm->GetValue("x_Description"));
		$account_payments->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$account_payments->User_ID->setFormValue($objForm->GetValue("x_User_ID"));
		$account_payments->Created->setFormValue($objForm->GetValue("x_Created"));
		$account_payments->Created->CurrentValue = ew_UnFormatDateTime($account_payments->Created->CurrentValue, 6);
		$account_payments->total_invoice_items->setFormValue($objForm->GetValue("x_total_invoice_items"));
		$account_payments->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $account_payments;
		$account_payments->id->CurrentValue = $account_payments->id->FormValue;
		$account_payments->Date->CurrentValue = $account_payments->Date->FormValue;
		$account_payments->Date->CurrentValue = ew_UnFormatDateTime($account_payments->Date->CurrentValue, 6);
		$account_payments->Payment_Reference->CurrentValue = $account_payments->Payment_Reference->FormValue;
		$account_payments->Payment_Date->CurrentValue = $account_payments->Payment_Date->FormValue;
		$account_payments->Payment_Date->CurrentValue = ew_UnFormatDateTime($account_payments->Payment_Date->CurrentValue, 6);
		$account_payments->Payment_Type->CurrentValue = $account_payments->Payment_Type->FormValue;
		$account_payments->Journal_Type_ID->CurrentValue = $account_payments->Journal_Type_ID->FormValue;
		$account_payments->Journal_Account_ID->CurrentValue = $account_payments->Journal_Account_ID->FormValue;
		$account_payments->Payment_Method_ID->CurrentValue = $account_payments->Payment_Method_ID->FormValue;
		$account_payments->Vendor_ID->CurrentValue = $account_payments->Vendor_ID->FormValue;
		$account_payments->Client_ID->CurrentValue = $account_payments->Client_ID->FormValue;
		$account_payments->Amount->CurrentValue = $account_payments->Amount->FormValue;
		$account_payments->Status_ID->CurrentValue = $account_payments->Status_ID->FormValue;
		$account_payments->Description->CurrentValue = $account_payments->Description->FormValue;
		$account_payments->Remarks->CurrentValue = $account_payments->Remarks->FormValue;
		$account_payments->User_ID->CurrentValue = $account_payments->User_ID->FormValue;
		$account_payments->Created->CurrentValue = $account_payments->Created->FormValue;
		$account_payments->Created->CurrentValue = ew_UnFormatDateTime($account_payments->Created->CurrentValue, 6);
		$account_payments->total_invoice_items->CurrentValue = $account_payments->total_invoice_items->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $account_payments;
		$sFilter = $account_payments->KeyFilter();

		// Call Row Selecting event
		$account_payments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$account_payments->CurrentFilter = $sFilter;
		$sSql = $account_payments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$account_payments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $account_payments;
		$account_payments->id->setDbValue($rs->fields('id'));
		$account_payments->Date->setDbValue($rs->fields('Date'));
		$account_payments->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$account_payments->Payment_Date->setDbValue($rs->fields('Payment_Date'));
		$account_payments->Payment_Type->setDbValue($rs->fields('Payment_Type'));
		$account_payments->Journal_Type_ID->setDbValue($rs->fields('Journal_Type_ID'));
		$account_payments->Journal_Account_ID->setDbValue($rs->fields('Journal_Account_ID'));
		$account_payments->Payment_Method_ID->setDbValue($rs->fields('Payment_Method_ID'));
		$account_payments->Vendor_ID->setDbValue($rs->fields('Vendor_ID'));
		$account_payments->Client_ID->setDbValue($rs->fields('Client_ID'));
		$account_payments->Amount->setDbValue($rs->fields('Amount'));
		$account_payments->Status_ID->setDbValue($rs->fields('Status_ID'));
		$account_payments->Description->setDbValue($rs->fields('Description'));
		$account_payments->Remarks->setDbValue($rs->fields('Remarks'));
		$account_payments->User_ID->setDbValue($rs->fields('User_ID'));
		$account_payments->Created->setDbValue($rs->fields('Created'));
		$account_payments->Modified->setDbValue($rs->fields('Modified'));
		$account_payments->total_invoice_items->setDbValue($rs->fields('total_invoice_items'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $account_payments;

		// Initialize URLs
		// Call Row_Rendering event

		$account_payments->Row_Rendering();

		// Common render codes for all row types
		// Date

		$account_payments->Date->CellCssStyle = ""; $account_payments->Date->CellCssClass = "";
		$account_payments->Date->CellAttrs = array(); $account_payments->Date->ViewAttrs = array(); $account_payments->Date->EditAttrs = array();

		// Payment_Reference
		$account_payments->Payment_Reference->CellCssStyle = ""; $account_payments->Payment_Reference->CellCssClass = "";
		$account_payments->Payment_Reference->CellAttrs = array(); $account_payments->Payment_Reference->ViewAttrs = array(); $account_payments->Payment_Reference->EditAttrs = array();

		// Payment_Date
		$account_payments->Payment_Date->CellCssStyle = ""; $account_payments->Payment_Date->CellCssClass = "";
		$account_payments->Payment_Date->CellAttrs = array(); $account_payments->Payment_Date->ViewAttrs = array(); $account_payments->Payment_Date->EditAttrs = array();

		// Payment_Type
		$account_payments->Payment_Type->CellCssStyle = ""; $account_payments->Payment_Type->CellCssClass = "";
		$account_payments->Payment_Type->CellAttrs = array(); $account_payments->Payment_Type->ViewAttrs = array(); $account_payments->Payment_Type->EditAttrs = array();

		// Journal_Type_ID
		$account_payments->Journal_Type_ID->CellCssStyle = ""; $account_payments->Journal_Type_ID->CellCssClass = "";
		$account_payments->Journal_Type_ID->CellAttrs = array(); $account_payments->Journal_Type_ID->ViewAttrs = array(); $account_payments->Journal_Type_ID->EditAttrs = array();

		// Journal_Account_ID
		$account_payments->Journal_Account_ID->CellCssStyle = ""; $account_payments->Journal_Account_ID->CellCssClass = "";
		$account_payments->Journal_Account_ID->CellAttrs = array(); $account_payments->Journal_Account_ID->ViewAttrs = array(); $account_payments->Journal_Account_ID->EditAttrs = array();

		// Payment_Method_ID
		$account_payments->Payment_Method_ID->CellCssStyle = ""; $account_payments->Payment_Method_ID->CellCssClass = "";
		$account_payments->Payment_Method_ID->CellAttrs = array(); $account_payments->Payment_Method_ID->ViewAttrs = array(); $account_payments->Payment_Method_ID->EditAttrs = array();

		// Vendor_ID
		$account_payments->Vendor_ID->CellCssStyle = ""; $account_payments->Vendor_ID->CellCssClass = "";
		$account_payments->Vendor_ID->CellAttrs = array(); $account_payments->Vendor_ID->ViewAttrs = array(); $account_payments->Vendor_ID->EditAttrs = array();

		// Client_ID
		$account_payments->Client_ID->CellCssStyle = ""; $account_payments->Client_ID->CellCssClass = "";
		$account_payments->Client_ID->CellAttrs = array(); $account_payments->Client_ID->ViewAttrs = array(); $account_payments->Client_ID->EditAttrs = array();

		// Amount
		$account_payments->Amount->CellCssStyle = ""; $account_payments->Amount->CellCssClass = "";
		$account_payments->Amount->CellAttrs = array(); $account_payments->Amount->ViewAttrs = array(); $account_payments->Amount->EditAttrs = array();

		// Status_ID
		$account_payments->Status_ID->CellCssStyle = ""; $account_payments->Status_ID->CellCssClass = "";
		$account_payments->Status_ID->CellAttrs = array(); $account_payments->Status_ID->ViewAttrs = array(); $account_payments->Status_ID->EditAttrs = array();

		// Description
		$account_payments->Description->CellCssStyle = ""; $account_payments->Description->CellCssClass = "";
		$account_payments->Description->CellAttrs = array(); $account_payments->Description->ViewAttrs = array(); $account_payments->Description->EditAttrs = array();

		// Remarks
		$account_payments->Remarks->CellCssStyle = ""; $account_payments->Remarks->CellCssClass = "";
		$account_payments->Remarks->CellAttrs = array(); $account_payments->Remarks->ViewAttrs = array(); $account_payments->Remarks->EditAttrs = array();

		// User_ID
		$account_payments->User_ID->CellCssStyle = ""; $account_payments->User_ID->CellCssClass = "";
		$account_payments->User_ID->CellAttrs = array(); $account_payments->User_ID->ViewAttrs = array(); $account_payments->User_ID->EditAttrs = array();

		// Created
		$account_payments->Created->CellCssStyle = ""; $account_payments->Created->CellCssClass = "";
		$account_payments->Created->CellAttrs = array(); $account_payments->Created->ViewAttrs = array(); $account_payments->Created->EditAttrs = array();

		// total_invoice_items
		$account_payments->total_invoice_items->CellCssStyle = ""; $account_payments->total_invoice_items->CellCssClass = "";
		$account_payments->total_invoice_items->CellAttrs = array(); $account_payments->total_invoice_items->ViewAttrs = array(); $account_payments->total_invoice_items->EditAttrs = array();
		if ($account_payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$account_payments->id->ViewValue = $account_payments->id->CurrentValue;
			$account_payments->id->CssStyle = "";
			$account_payments->id->CssClass = "";
			$account_payments->id->ViewCustomAttributes = "";

			// Date
			$account_payments->Date->ViewValue = $account_payments->Date->CurrentValue;
			$account_payments->Date->ViewValue = ew_FormatDateTime($account_payments->Date->ViewValue, 6);
			$account_payments->Date->CssStyle = "";
			$account_payments->Date->CssClass = "";
			$account_payments->Date->ViewCustomAttributes = "";

			// Payment_Reference
			$account_payments->Payment_Reference->ViewValue = $account_payments->Payment_Reference->CurrentValue;
			$account_payments->Payment_Reference->CssStyle = "";
			$account_payments->Payment_Reference->CssClass = "";
			$account_payments->Payment_Reference->ViewCustomAttributes = "";

			// Payment_Date
			$account_payments->Payment_Date->ViewValue = $account_payments->Payment_Date->CurrentValue;
			$account_payments->Payment_Date->ViewValue = ew_FormatDateTime($account_payments->Payment_Date->ViewValue, 6);
			$account_payments->Payment_Date->CssStyle = "";
			$account_payments->Payment_Date->CssClass = "";
			$account_payments->Payment_Date->ViewCustomAttributes = "";

			// Payment_Type
			if (strval($account_payments->Payment_Type->CurrentValue) <> "") {
				switch ($account_payments->Payment_Type->CurrentValue) {
					case "payment_send":
						$account_payments->Payment_Type->ViewValue = "Payment Send";
						break;
					case "payment_received":
						$account_payments->Payment_Type->ViewValue = "Payment Received";
						break;
					default:
						$account_payments->Payment_Type->ViewValue = $account_payments->Payment_Type->CurrentValue;
				}
			} else {
				$account_payments->Payment_Type->ViewValue = NULL;
			}
			$account_payments->Payment_Type->CssStyle = "";
			$account_payments->Payment_Type->CssClass = "";
			$account_payments->Payment_Type->ViewCustomAttributes = "";

			// Journal_Type_ID
			if (strval($account_payments->Journal_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Journal_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Journal_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Journal_Type_ID->ViewValue = $rswrk->fields('Journal_Name');
					$rswrk->Close();
				} else {
					$account_payments->Journal_Type_ID->ViewValue = $account_payments->Journal_Type_ID->CurrentValue;
				}
			} else {
				$account_payments->Journal_Type_ID->ViewValue = NULL;
			}
			$account_payments->Journal_Type_ID->CssStyle = "";
			$account_payments->Journal_Type_ID->CssClass = "";
			$account_payments->Journal_Type_ID->ViewCustomAttributes = "";

			// Journal_Account_ID
			if (strval($account_payments->Journal_Account_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Journal_Account_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Account_Reference_No` FROM `journal_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Business_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Journal_Account_ID->ViewValue = $rswrk->fields('Account_Reference_No');
					$rswrk->Close();
				} else {
					$account_payments->Journal_Account_ID->ViewValue = $account_payments->Journal_Account_ID->CurrentValue;
				}
			} else {
				$account_payments->Journal_Account_ID->ViewValue = NULL;
			}
			$account_payments->Journal_Account_ID->CssStyle = "";
			$account_payments->Journal_Account_ID->CssClass = "";
			$account_payments->Journal_Account_ID->ViewCustomAttributes = "";

			// Payment_Method_ID
			if (strval($account_payments->Payment_Method_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Payment_Method_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Payment_Method` FROM `account_payment_methods`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Payment_Method_ID->ViewValue = $rswrk->fields('Payment_Method');
					$rswrk->Close();
				} else {
					$account_payments->Payment_Method_ID->ViewValue = $account_payments->Payment_Method_ID->CurrentValue;
				}
			} else {
				$account_payments->Payment_Method_ID->ViewValue = NULL;
			}
			$account_payments->Payment_Method_ID->CssStyle = "";
			$account_payments->Payment_Method_ID->CssClass = "";
			$account_payments->Payment_Method_ID->ViewCustomAttributes = "";

			// Vendor_ID
			if (strval($account_payments->Vendor_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Vendor_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Vendor_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$account_payments->Vendor_ID->ViewValue = $account_payments->Vendor_ID->CurrentValue;
				}
			} else {
				$account_payments->Vendor_ID->ViewValue = NULL;
			}
			$account_payments->Vendor_ID->CssStyle = "";
			$account_payments->Vendor_ID->CssClass = "";
			$account_payments->Vendor_ID->ViewCustomAttributes = "";

			// Client_ID
			if (strval($account_payments->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$account_payments->Client_ID->ViewValue = $account_payments->Client_ID->CurrentValue;
				}
			} else {
				$account_payments->Client_ID->ViewValue = NULL;
			}
			$account_payments->Client_ID->CssStyle = "";
			$account_payments->Client_ID->CssClass = "";
			$account_payments->Client_ID->ViewCustomAttributes = "";

			// Amount
			$account_payments->Amount->ViewValue = $account_payments->Amount->CurrentValue;
			$account_payments->Amount->ViewValue = ew_FormatNumber($account_payments->Amount->ViewValue, 2, -2, -2, -2);
			$account_payments->Amount->CssStyle = "";
			$account_payments->Amount->CssClass = "";
			$account_payments->Amount->ViewCustomAttributes = "";

			// Status_ID
			if (strval($account_payments->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$account_payments->Status_ID->ViewValue = $account_payments->Status_ID->CurrentValue;
				}
			} else {
				$account_payments->Status_ID->ViewValue = NULL;
			}
			$account_payments->Status_ID->CssStyle = "";
			$account_payments->Status_ID->CssClass = "";
			$account_payments->Status_ID->ViewCustomAttributes = "";

			// Description
			$account_payments->Description->ViewValue = $account_payments->Description->CurrentValue;
			$account_payments->Description->CssStyle = "";
			$account_payments->Description->CssClass = "";
			$account_payments->Description->ViewCustomAttributes = "";

			// Remarks
			$account_payments->Remarks->ViewValue = $account_payments->Remarks->CurrentValue;
			$account_payments->Remarks->CssStyle = "";
			$account_payments->Remarks->CssClass = "";
			$account_payments->Remarks->ViewCustomAttributes = "";

			// User_ID
			$account_payments->User_ID->ViewValue = $account_payments->User_ID->CurrentValue;
			$account_payments->User_ID->CssStyle = "";
			$account_payments->User_ID->CssClass = "";
			$account_payments->User_ID->ViewCustomAttributes = "";

			// Created
			$account_payments->Created->ViewValue = $account_payments->Created->CurrentValue;
			$account_payments->Created->ViewValue = ew_FormatDateTime($account_payments->Created->ViewValue, 6);
			$account_payments->Created->CssStyle = "";
			$account_payments->Created->CssClass = "";
			$account_payments->Created->ViewCustomAttributes = "";

			// Modified
			$account_payments->Modified->ViewValue = $account_payments->Modified->CurrentValue;
			$account_payments->Modified->ViewValue = ew_FormatDateTime($account_payments->Modified->ViewValue, 6);
			$account_payments->Modified->CssStyle = "";
			$account_payments->Modified->CssClass = "";
			$account_payments->Modified->ViewCustomAttributes = "";

			// total_invoice_items
			$account_payments->total_invoice_items->ViewValue = $account_payments->total_invoice_items->CurrentValue;
			$account_payments->total_invoice_items->CssStyle = "";
			$account_payments->total_invoice_items->CssClass = "";
			$account_payments->total_invoice_items->ViewCustomAttributes = "";

			// Date
			$account_payments->Date->HrefValue = "";
			$account_payments->Date->TooltipValue = "";

			// Payment_Reference
			$account_payments->Payment_Reference->HrefValue = "";
			$account_payments->Payment_Reference->TooltipValue = "";

			// Payment_Date
			$account_payments->Payment_Date->HrefValue = "";
			$account_payments->Payment_Date->TooltipValue = "";

			// Payment_Type
			$account_payments->Payment_Type->HrefValue = "";
			$account_payments->Payment_Type->TooltipValue = "";

			// Journal_Type_ID
			$account_payments->Journal_Type_ID->HrefValue = "";
			$account_payments->Journal_Type_ID->TooltipValue = "";

			// Journal_Account_ID
			$account_payments->Journal_Account_ID->HrefValue = "";
			$account_payments->Journal_Account_ID->TooltipValue = "";

			// Payment_Method_ID
			$account_payments->Payment_Method_ID->HrefValue = "";
			$account_payments->Payment_Method_ID->TooltipValue = "";

			// Vendor_ID
			$account_payments->Vendor_ID->HrefValue = "";
			$account_payments->Vendor_ID->TooltipValue = "";

			// Client_ID
			$account_payments->Client_ID->HrefValue = "";
			$account_payments->Client_ID->TooltipValue = "";

			// Amount
			$account_payments->Amount->HrefValue = "";
			$account_payments->Amount->TooltipValue = "";

			// Status_ID
			$account_payments->Status_ID->HrefValue = "";
			$account_payments->Status_ID->TooltipValue = "";

			// Description
			$account_payments->Description->HrefValue = "";
			$account_payments->Description->TooltipValue = "";

			// Remarks
			$account_payments->Remarks->HrefValue = "";
			$account_payments->Remarks->TooltipValue = "";

			// User_ID
			$account_payments->User_ID->HrefValue = "";
			$account_payments->User_ID->TooltipValue = "";

			// Created
			$account_payments->Created->HrefValue = "";
			$account_payments->Created->TooltipValue = "";

			// total_invoice_items
			$account_payments->total_invoice_items->HrefValue = "";
			$account_payments->total_invoice_items->TooltipValue = "";
		} elseif ($account_payments->RowType == EW_ROWTYPE_ADD) { // Add row

			// Date
			$account_payments->Date->EditCustomAttributes = "";
			$account_payments->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($account_payments->Date->CurrentValue, 6));

			// Payment_Reference
			$account_payments->Payment_Reference->EditCustomAttributes = "";
			$account_payments->Payment_Reference->EditValue = ew_HtmlEncode($account_payments->Payment_Reference->CurrentValue);

			// Payment_Date
			$account_payments->Payment_Date->EditCustomAttributes = "";
			$account_payments->Payment_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($account_payments->Payment_Date->CurrentValue, 6));

			// Payment_Type
			$account_payments->Payment_Type->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("payment_send", "Payment Send");
			$arwrk[] = array("payment_received", "Payment Received");
			$account_payments->Payment_Type->EditValue = $arwrk;

			// Journal_Type_ID
			$account_payments->Journal_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Journal_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Journal_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$account_payments->Journal_Type_ID->EditValue = $arwrk;

			// Journal_Account_ID
			$account_payments->Journal_Account_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Account_Reference_No`, '' AS Disp2Fld, `journal_type_id` FROM `journal_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Business_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$account_payments->Journal_Account_ID->EditValue = $arwrk;

			// Payment_Method_ID
			$account_payments->Payment_Method_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Payment_Method`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `account_payment_methods`";
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
			$account_payments->Payment_Method_ID->EditValue = $arwrk;

			// Vendor_ID
			$account_payments->Vendor_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Subcon_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$account_payments->Vendor_ID->EditValue = $arwrk;

			// Client_ID
			$account_payments->Client_ID->EditCustomAttributes = "";
			if ($account_payments->Client_ID->getSessionValue() <> "") {
				$account_payments->Client_ID->CurrentValue = $account_payments->Client_ID->getSessionValue();
			if (strval($account_payments->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$account_payments->Client_ID->ViewValue = $account_payments->Client_ID->CurrentValue;
				}
			} else {
				$account_payments->Client_ID->ViewValue = NULL;
			}
			$account_payments->Client_ID->CssStyle = "";
			$account_payments->Client_ID->CssClass = "";
			$account_payments->Client_ID->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Client_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$account_payments->Client_ID->EditValue = $arwrk;
			}

			// Amount
			$account_payments->Amount->EditCustomAttributes = "";
			$account_payments->Amount->EditValue = ew_HtmlEncode($account_payments->Amount->CurrentValue);

			// Status_ID
			$account_payments->Status_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Status`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `statuses`";
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
			$account_payments->Status_ID->EditValue = $arwrk;

			// Description
			$account_payments->Description->EditCustomAttributes = "";
			$account_payments->Description->EditValue = ew_HtmlEncode($account_payments->Description->CurrentValue);

			// Remarks
			$account_payments->Remarks->EditCustomAttributes = "";
			$account_payments->Remarks->EditValue = ew_HtmlEncode($account_payments->Remarks->CurrentValue);

			// User_ID
			// Created
			// total_invoice_items

			$account_payments->total_invoice_items->EditCustomAttributes = "";
			$account_payments->total_invoice_items->EditValue = ew_HtmlEncode($account_payments->total_invoice_items->CurrentValue);
		}

		// Call Row Rendered event
		if ($account_payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$account_payments->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $account_payments;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($account_payments->Date->FormValue) && $account_payments->Date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $account_payments->Date->FldCaption();
		}
		if (!ew_CheckUSDate($account_payments->Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $account_payments->Date->FldErrMsg();
		}
		if (!is_null($account_payments->Payment_Date->FormValue) && $account_payments->Payment_Date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $account_payments->Payment_Date->FldCaption();
		}
		if (!ew_CheckUSDate($account_payments->Payment_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $account_payments->Payment_Date->FldErrMsg();
		}
		if ($account_payments->Payment_Type->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $account_payments->Payment_Type->FldCaption();
		}
		if (!is_null($account_payments->Payment_Method_ID->FormValue) && $account_payments->Payment_Method_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $account_payments->Payment_Method_ID->FldCaption();
		}
		if (!ew_CheckNumber($account_payments->Amount->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $account_payments->Amount->FldErrMsg();
		}
		if (!ew_CheckNumber($account_payments->total_invoice_items->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $account_payments->total_invoice_items->FldErrMsg();
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $account_payments;
		$rsnew = array();

		// Date
		$account_payments->Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($account_payments->Date->CurrentValue, 6, FALSE), NULL);

		// Payment_Reference
		$account_payments->Payment_Reference->SetDbValueDef($rsnew, $account_payments->Payment_Reference->CurrentValue, NULL, FALSE);

		// Payment_Date
		$account_payments->Payment_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($account_payments->Payment_Date->CurrentValue, 6, FALSE), NULL);

		// Payment_Type
		$account_payments->Payment_Type->SetDbValueDef($rsnew, $account_payments->Payment_Type->CurrentValue, NULL, FALSE);

		// Journal_Type_ID
		$account_payments->Journal_Type_ID->SetDbValueDef($rsnew, $account_payments->Journal_Type_ID->CurrentValue, NULL, FALSE);

		// Journal_Account_ID
		$account_payments->Journal_Account_ID->SetDbValueDef($rsnew, $account_payments->Journal_Account_ID->CurrentValue, NULL, FALSE);

		// Payment_Method_ID
		$account_payments->Payment_Method_ID->SetDbValueDef($rsnew, $account_payments->Payment_Method_ID->CurrentValue, NULL, FALSE);

		// Vendor_ID
		$account_payments->Vendor_ID->SetDbValueDef($rsnew, $account_payments->Vendor_ID->CurrentValue, NULL, FALSE);

		// Client_ID
		$account_payments->Client_ID->SetDbValueDef($rsnew, $account_payments->Client_ID->CurrentValue, NULL, FALSE);

		// Amount
		$account_payments->Amount->SetDbValueDef($rsnew, $account_payments->Amount->CurrentValue, NULL, FALSE);

		// Status_ID
		$account_payments->Status_ID->SetDbValueDef($rsnew, $account_payments->Status_ID->CurrentValue, NULL, FALSE);

		// Description
		$account_payments->Description->SetDbValueDef($rsnew, $account_payments->Description->CurrentValue, NULL, FALSE);

		// Remarks
		$account_payments->Remarks->SetDbValueDef($rsnew, $account_payments->Remarks->CurrentValue, NULL, FALSE);

		// User_ID
		$account_payments->User_ID->SetDbValueDef($rsnew, CurrentUserID(), NULL);
		$rsnew['User_ID'] =& $account_payments->User_ID->DbValue;

		// Created
		$account_payments->Created->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['Created'] =& $account_payments->Created->DbValue;

		// total_invoice_items
		$account_payments->total_invoice_items->SetDbValueDef($rsnew, $account_payments->total_invoice_items->CurrentValue, 0, TRUE);

		// Call Row Inserting event
		$bInsertRow = $account_payments->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($account_payments->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($account_payments->CancelMessage <> "") {
				$this->setMessage($account_payments->CancelMessage);
				$account_payments->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$account_payments->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $account_payments->id->DbValue;

			// Call Row Inserted event
			$account_payments->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $account_payments;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "clients") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $account_payments->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $account_payments->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$account_payments->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$account_payments->Client_ID->setSessionValue($account_payments->Client_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["clients"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["clients"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($GLOBALS["clients"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$account_payments->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$account_payments->setStartRecordNumber($this->lStartRec);
			$account_payments->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$account_payments->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($account_payments->Client_ID->QueryStringValue == "") $account_payments->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $account_payments->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $account_payments->getDetailFilter(); // Restore detail filter
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
