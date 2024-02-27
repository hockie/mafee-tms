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
$account_payments_search = new caccount_payments_search();
$Page =& $account_payments_search;

// Page init
$account_payments_search->Page_Init();

// Page main
$account_payments_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var account_payments_search = new ew_Page("account_payments_search");

// page properties
account_payments_search.PageID = "search"; // page ID
account_payments_search.FormID = "faccount_paymentssearch"; // form ID
var EW_PAGE_ID = account_payments_search.PageID; // for backward compatibility

// extend page with validate function for search
account_payments_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Payment_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Payment_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Amount"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Amount->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_User_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->User_ID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Created"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Created->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Modified"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Modified->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_total_invoice_items"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->total_invoice_items->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
account_payments_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
account_payments_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
account_payments_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
account_payments_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $account_payments->TableCaption() ?><br><br>
<a href="<?php echo $account_payments->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payments_search->ShowMessage();
?>
<form name="faccount_paymentssearch" id="faccount_paymentssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return account_payments_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="account_payments">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $account_payments->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->id->FldCaption() ?></td>
		<td<?php echo $account_payments->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $account_payments->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $account_payments->id->FldTitle() ?>" value="<?php echo $account_payments->id->EditValue ?>"<?php echo $account_payments->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Date->FldCaption() ?></td>
		<td<?php echo $account_payments->Date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Date" id="z_Date" value="="></span></td>
		<td<?php echo $account_payments->Date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Date" id="x_Date" title="<?php echo $account_payments->Date->FldTitle() ?>" value="<?php echo $account_payments->Date->EditValue ?>"<?php echo $account_payments->Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date" name="cal_x_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Payment_Reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Reference->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Reference->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Payment_Reference" id="z_Payment_Reference" value="LIKE"></span></td>
		<td<?php echo $account_payments->Payment_Reference->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Payment_Reference" id="x_Payment_Reference" title="<?php echo $account_payments->Payment_Reference->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $account_payments->Payment_Reference->EditValue ?>"<?php echo $account_payments->Payment_Reference->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Payment_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Date->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Payment_Date" id="z_Payment_Date" value="BETWEEN"></span></td>
		<td<?php echo $account_payments->Payment_Date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Payment_Date" id="x_Payment_Date" title="<?php echo $account_payments->Payment_Date->FldTitle() ?>" value="<?php echo $account_payments->Payment_Date->EditValue ?>"<?php echo $account_payments->Payment_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Payment_Date" name="cal_x_Payment_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Payment_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Payment_Date" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw1_Payment_Date" name="btw1_Payment_Date">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_Payment_Date" name="btw1_Payment_Date">
<input type="text" name="y_Payment_Date" id="y_Payment_Date" title="<?php echo $account_payments->Payment_Date->FldTitle() ?>" value="<?php echo $account_payments->Payment_Date->EditValue2 ?>"<?php echo $account_payments->Payment_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_Payment_Date" name="cal_y_Payment_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_Payment_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_y_Payment_Date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Payment_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Type->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Type->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Payment_Type" id="z_Payment_Type" value="LIKE"></span></td>
		<td<?php echo $account_payments->Payment_Type->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_Payment_Type" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_Payment_Type" id="x_Payment_Type" title="<?php echo $account_payments->Payment_Type->FldTitle() ?>" value="{value}"<?php echo $account_payments->Payment_Type->EditAttributes() ?>></label></div>
<div id="dsl_x_Payment_Type" repeatcolumn="5">
<?php
$arwrk = $account_payments->Payment_Type->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Payment_Type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Journal_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Journal_Type_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Journal_Type_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Journal_Type_ID" id="z_Journal_Type_ID" value="="></span></td>
		<td<?php echo $account_payments->Journal_Type_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php $account_payments->Journal_Type_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Journal_Account_ID','x_Journal_Type_ID',account_payments_search.ar_x_Journal_Account_ID); " . @$account_payments->Journal_Type_ID->EditAttrs["onchange"]; ?>
<select id="x_Journal_Type_ID" name="x_Journal_Type_ID" title="<?php echo $account_payments->Journal_Type_ID->FldTitle() ?>"<?php echo $account_payments->Journal_Type_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Journal_Type_ID->EditValue)) {
	$arwrk = $account_payments->Journal_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Journal_Type_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Journal_Account_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Journal_Account_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Journal_Account_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Journal_Account_ID" id="z_Journal_Account_ID" value="="></span></td>
		<td<?php echo $account_payments->Journal_Account_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Journal_Account_ID" name="x_Journal_Account_ID" title="<?php echo $account_payments->Journal_Account_ID->FldTitle() ?>"<?php echo $account_payments->Journal_Account_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Journal_Account_ID->EditValue)) {
	$arwrk = $account_payments->Journal_Account_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Journal_Account_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
account_payments_search.ar_x_Journal_Account_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Payment_Method_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Payment_Method_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Payment_Method_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Payment_Method_ID" id="z_Payment_Method_ID" value="="></span></td>
		<td<?php echo $account_payments->Payment_Method_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Payment_Method_ID" name="x_Payment_Method_ID" title="<?php echo $account_payments->Payment_Method_ID->FldTitle() ?>"<?php echo $account_payments->Payment_Method_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Payment_Method_ID->EditValue)) {
	$arwrk = $account_payments->Payment_Method_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Payment_Method_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Vendor_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Vendor_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Vendor_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Vendor_ID" id="z_Vendor_ID" value="="></span></td>
		<td<?php echo $account_payments->Vendor_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Vendor_ID" name="x_Vendor_ID" title="<?php echo $account_payments->Vendor_ID->FldTitle() ?>"<?php echo $account_payments->Vendor_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Vendor_ID->EditValue)) {
	$arwrk = $account_payments->Vendor_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Vendor_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Client_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Client_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td<?php echo $account_payments->Client_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $account_payments->Client_ID->FldTitle() ?>"<?php echo $account_payments->Client_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Client_ID->EditValue)) {
	$arwrk = $account_payments->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Client_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Amount->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Amount->FldCaption() ?></td>
		<td<?php echo $account_payments->Amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Amount" id="z_Amount" value="="></span></td>
		<td<?php echo $account_payments->Amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Amount" id="x_Amount" title="<?php echo $account_payments->Amount->FldTitle() ?>" size="30" value="<?php echo $account_payments->Amount->EditValue ?>"<?php echo $account_payments->Amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Status_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->Status_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Status_ID" id="z_Status_ID" value="="></span></td>
		<td<?php echo $account_payments->Status_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Status_ID" name="x_Status_ID" title="<?php echo $account_payments->Status_ID->FldTitle() ?>"<?php echo $account_payments->Status_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Status_ID->EditValue)) {
	$arwrk = $account_payments->Status_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Status_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Description->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Description->FldCaption() ?></td>
		<td<?php echo $account_payments->Description->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Description" id="z_Description" value="LIKE"></span></td>
		<td<?php echo $account_payments->Description->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Description" id="x_Description" title="<?php echo $account_payments->Description->FldTitle() ?>" cols="35" rows="4"<?php echo $account_payments->Description->EditAttributes() ?>><?php echo $account_payments->Description->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Description", function() {
	var oCKeditor = CKEDITOR.replace('x_Description', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Remarks->FldCaption() ?></td>
		<td<?php echo $account_payments->Remarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE"></span></td>
		<td<?php echo $account_payments->Remarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $account_payments->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $account_payments->Remarks->EditAttributes() ?>><?php echo $account_payments->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->User_ID->FldCaption() ?></td>
		<td<?php echo $account_payments->User_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_User_ID" id="z_User_ID" value="="></span></td>
		<td<?php echo $account_payments->User_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_User_ID" id="x_User_ID" title="<?php echo $account_payments->User_ID->FldTitle() ?>" size="30" value="<?php echo $account_payments->User_ID->EditValue ?>"<?php echo $account_payments->User_ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Created->FldCaption() ?></td>
		<td<?php echo $account_payments->Created->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Created" id="z_Created" value="="></span></td>
		<td<?php echo $account_payments->Created->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Created" id="x_Created" title="<?php echo $account_payments->Created->FldTitle() ?>" value="<?php echo $account_payments->Created->EditValue ?>"<?php echo $account_payments->Created->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->Modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->Modified->FldCaption() ?></td>
		<td<?php echo $account_payments->Modified->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Modified" id="z_Modified" value="="></span></td>
		<td<?php echo $account_payments->Modified->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Modified" id="x_Modified" title="<?php echo $account_payments->Modified->FldTitle() ?>" value="<?php echo $account_payments->Modified->EditValue ?>"<?php echo $account_payments->Modified->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $account_payments->total_invoice_items->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $account_payments->total_invoice_items->FldCaption() ?></td>
		<td<?php echo $account_payments->total_invoice_items->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_total_invoice_items" id="z_total_invoice_items" value="="></span></td>
		<td<?php echo $account_payments->total_invoice_items->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_total_invoice_items" id="x_total_invoice_items" title="<?php echo $account_payments->total_invoice_items->FldTitle() ?>" size="30" value="<?php echo $account_payments->total_invoice_items->EditValue ?>"<?php echo $account_payments->total_invoice_items->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_Journal_Account_ID','x_Journal_Type_ID',account_payments_search.ar_x_Journal_Account_ID]]);

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
$account_payments_search->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payments_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'account_payments';

	// Page object name
	var $PageObjName = 'account_payments_search';

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
	function caccount_payments_search() {
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
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $account_payments;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$account_payments->CurrentAction = $objForm->GetValue("a_search");
			switch ($account_payments->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $account_payments->UrlParm($sSrchStr);
						$this->Page_Terminate("account_paymentslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$account_payments->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $account_payments;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $account_payments->id); // id
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Date); // Date
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Payment_Reference); // Payment_Reference
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Payment_Date); // Payment_Date
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Payment_Type); // Payment_Type
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Journal_Type_ID); // Journal_Type_ID
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Journal_Account_ID); // Journal_Account_ID
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Payment_Method_ID); // Payment_Method_ID
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Vendor_ID); // Vendor_ID
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Client_ID); // Client_ID
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Amount); // Amount
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Status_ID); // Status_ID
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Description); // Description
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Remarks); // Remarks
	$this->BuildSearchUrl($sSrchUrl, $account_payments->User_ID); // User_ID
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Created); // Created
	$this->BuildSearchUrl($sSrchUrl, $account_payments->Modified); // Modified
	$this->BuildSearchUrl($sSrchUrl, $account_payments->total_invoice_items); // total_invoice_items
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $account_payments;

		// Load search values
		// id

		$account_payments->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$account_payments->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// Date
		$account_payments->Date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Date"));
		$account_payments->Date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Date");

		// Payment_Reference
		$account_payments->Payment_Reference->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Payment_Reference"));
		$account_payments->Payment_Reference->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Payment_Reference");

		// Payment_Date
		$account_payments->Payment_Date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Payment_Date"));
		$account_payments->Payment_Date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Payment_Date");
		$account_payments->Payment_Date->AdvancedSearch->SearchCondition = $objForm->GetValue("v_Payment_Date");
		$account_payments->Payment_Date->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_Payment_Date"));
		$account_payments->Payment_Date->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_Payment_Date");

		// Payment_Type
		$account_payments->Payment_Type->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Payment_Type"));
		$account_payments->Payment_Type->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Payment_Type");

		// Journal_Type_ID
		$account_payments->Journal_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Journal_Type_ID"));
		$account_payments->Journal_Type_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Journal_Type_ID");

		// Journal_Account_ID
		$account_payments->Journal_Account_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Journal_Account_ID"));
		$account_payments->Journal_Account_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Journal_Account_ID");

		// Payment_Method_ID
		$account_payments->Payment_Method_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Payment_Method_ID"));
		$account_payments->Payment_Method_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Payment_Method_ID");

		// Vendor_ID
		$account_payments->Vendor_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Vendor_ID"));
		$account_payments->Vendor_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Vendor_ID");

		// Client_ID
		$account_payments->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Client_ID"));
		$account_payments->Client_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Client_ID");

		// Amount
		$account_payments->Amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Amount"));
		$account_payments->Amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Amount");

		// Status_ID
		$account_payments->Status_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Status_ID"));
		$account_payments->Status_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Status_ID");

		// Description
		$account_payments->Description->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Description"));
		$account_payments->Description->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Description");

		// Remarks
		$account_payments->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Remarks"));
		$account_payments->Remarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Remarks");

		// User_ID
		$account_payments->User_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_User_ID"));
		$account_payments->User_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_User_ID");

		// Created
		$account_payments->Created->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Created"));
		$account_payments->Created->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Created");

		// Modified
		$account_payments->Modified->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Modified"));
		$account_payments->Modified->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Modified");

		// total_invoice_items
		$account_payments->total_invoice_items->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_total_invoice_items"));
		$account_payments->total_invoice_items->AdvancedSearch->SearchOperator = $objForm->GetValue("z_total_invoice_items");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $account_payments;

		// Initialize URLs
		// Call Row_Rendering event

		$account_payments->Row_Rendering();

		// Common render codes for all row types
		// id

		$account_payments->id->CellCssStyle = ""; $account_payments->id->CellCssClass = "";
		$account_payments->id->CellAttrs = array(); $account_payments->id->ViewAttrs = array(); $account_payments->id->EditAttrs = array();

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

		// Modified
		$account_payments->Modified->CellCssStyle = ""; $account_payments->Modified->CellCssClass = "";
		$account_payments->Modified->CellAttrs = array(); $account_payments->Modified->ViewAttrs = array(); $account_payments->Modified->EditAttrs = array();

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

			// id
			$account_payments->id->HrefValue = "";
			$account_payments->id->TooltipValue = "";

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

			// Modified
			$account_payments->Modified->HrefValue = "";
			$account_payments->Modified->TooltipValue = "";

			// total_invoice_items
			$account_payments->total_invoice_items->HrefValue = "";
			$account_payments->total_invoice_items->TooltipValue = "";
		} elseif ($account_payments->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$account_payments->id->EditCustomAttributes = "";
			$account_payments->id->EditValue = ew_HtmlEncode($account_payments->id->AdvancedSearch->SearchValue);

			// Date
			$account_payments->Date->EditCustomAttributes = "";
			$account_payments->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($account_payments->Date->AdvancedSearch->SearchValue, 6), 6));

			// Payment_Reference
			$account_payments->Payment_Reference->EditCustomAttributes = "";
			$account_payments->Payment_Reference->EditValue = ew_HtmlEncode($account_payments->Payment_Reference->AdvancedSearch->SearchValue);

			// Payment_Date
			$account_payments->Payment_Date->EditCustomAttributes = "";
			$account_payments->Payment_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($account_payments->Payment_Date->AdvancedSearch->SearchValue, 6), 6));
			$account_payments->Payment_Date->EditCustomAttributes = "";
			$account_payments->Payment_Date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($account_payments->Payment_Date->AdvancedSearch->SearchValue2, 6), 6));

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

			// Amount
			$account_payments->Amount->EditCustomAttributes = "";
			$account_payments->Amount->EditValue = ew_HtmlEncode($account_payments->Amount->AdvancedSearch->SearchValue);

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
			$account_payments->Description->EditValue = ew_HtmlEncode($account_payments->Description->AdvancedSearch->SearchValue);

			// Remarks
			$account_payments->Remarks->EditCustomAttributes = "";
			$account_payments->Remarks->EditValue = ew_HtmlEncode($account_payments->Remarks->AdvancedSearch->SearchValue);

			// User_ID
			$account_payments->User_ID->EditCustomAttributes = "";
			$account_payments->User_ID->EditValue = ew_HtmlEncode($account_payments->User_ID->AdvancedSearch->SearchValue);

			// Created
			$account_payments->Created->EditCustomAttributes = "";
			$account_payments->Created->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($account_payments->Created->AdvancedSearch->SearchValue, 6), 6));

			// Modified
			$account_payments->Modified->EditCustomAttributes = "";
			$account_payments->Modified->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($account_payments->Modified->AdvancedSearch->SearchValue, 6), 6));

			// total_invoice_items
			$account_payments->total_invoice_items->EditCustomAttributes = "";
			$account_payments->total_invoice_items->EditValue = ew_HtmlEncode($account_payments->total_invoice_items->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($account_payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$account_payments->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $account_payments;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($account_payments->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->id->FldErrMsg();
		}
		if (!ew_CheckUSDate($account_payments->Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($account_payments->Payment_Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->Payment_Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($account_payments->Payment_Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->Payment_Date->FldErrMsg();
		}
		if (!ew_CheckNumber($account_payments->Amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->Amount->FldErrMsg();
		}
		if (!ew_CheckInteger($account_payments->User_ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->User_ID->FldErrMsg();
		}
		if (!ew_CheckUSDate($account_payments->Created->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->Created->FldErrMsg();
		}
		if (!ew_CheckUSDate($account_payments->Modified->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->Modified->FldErrMsg();
		}
		if (!ew_CheckNumber($account_payments->total_invoice_items->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->total_invoice_items->FldErrMsg();
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $account_payments;
		$account_payments->id->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_id");
		$account_payments->Date->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Date");
		$account_payments->Payment_Reference->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Payment_Reference");
		$account_payments->Payment_Date->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Payment_Date");
		$account_payments->Payment_Date->AdvancedSearch->SearchValue2 = $account_payments->getAdvancedSearch("y_Payment_Date");
		$account_payments->Payment_Type->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Payment_Type");
		$account_payments->Journal_Type_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Journal_Type_ID");
		$account_payments->Journal_Account_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Journal_Account_ID");
		$account_payments->Payment_Method_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Payment_Method_ID");
		$account_payments->Vendor_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Vendor_ID");
		$account_payments->Client_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Client_ID");
		$account_payments->Amount->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Amount");
		$account_payments->Status_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Status_ID");
		$account_payments->Description->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Description");
		$account_payments->Remarks->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Remarks");
		$account_payments->User_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_User_ID");
		$account_payments->Created->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Created");
		$account_payments->Modified->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Modified");
		$account_payments->total_invoice_items->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_total_invoice_items");
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
