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
$expenses_search = new cexpenses_search();
$Page =& $expenses_search;

// Page init
$expenses_search->Page_Init();

// Page main
$expenses_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expenses_search = new ew_Page("expenses_search");

// page properties
expenses_search.PageID = "search"; // page ID
expenses_search.FormID = "fexpensessearch"; // form ID
var EW_PAGE_ID = expenses_search.PageID; // for backward compatibility

// extend page with validate function for search
expenses_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Date_Created"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Date_Created->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_expense_date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->expense_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Booking_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Booking_ID->FldErrMsg()) ?>");
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
		elm = fobj.elements["x" + infix + "_modified"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->modified->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_user_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->user_id->FldErrMsg()) ?>");

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
expenses_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenses_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenses_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenses_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenses->TableCaption() ?><br><br>
<a href="<?php echo $expenses->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expenses_search->ShowMessage();
?>
<form name="fexpensessearch" id="fexpensessearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return expenses_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="expenses">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $expenses->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->id->FldCaption() ?></td>
		<td<?php echo $expenses->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $expenses->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $expenses->id->FldTitle() ?>" value="<?php echo $expenses->id->EditValue ?>"<?php echo $expenses->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Date_Created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Date_Created->FldCaption() ?></td>
		<td<?php echo $expenses->Date_Created->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Date_Created" id="z_Date_Created" value="="></span></td>
		<td<?php echo $expenses->Date_Created->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Date_Created" id="x_Date_Created" title="<?php echo $expenses->Date_Created->FldTitle() ?>" value="<?php echo $expenses->Date_Created->EditValue ?>"<?php echo $expenses->Date_Created->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date_Created" name="cal_x_Date_Created" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date_Created", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Date_Created" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->expense_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->expense_date->FldCaption() ?></td>
		<td<?php echo $expenses->expense_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_expense_date" id="z_expense_date" value="="></span></td>
		<td<?php echo $expenses->expense_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_expense_date" id="x_expense_date" title="<?php echo $expenses->expense_date->FldTitle() ?>" value="<?php echo $expenses->expense_date->EditValue ?>"<?php echo $expenses->expense_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_expense_date" name="cal_x_expense_date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_expense_date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_expense_date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->expense_category_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->expense_category_id->FldCaption() ?></td>
		<td<?php echo $expenses->expense_category_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_expense_category_id" id="z_expense_category_id" value="="></span></td>
		<td<?php echo $expenses->expense_category_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_expense_category_id" name="x_expense_category_id" title="<?php echo $expenses->expense_category_id->FldTitle() ?>"<?php echo $expenses->expense_category_id->EditAttributes() ?>>
<?php
if (is_array($expenses->expense_category_id->EditValue)) {
	$arwrk = $expenses->expense_category_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->expense_category_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Reference_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Reference_No->FldCaption() ?></td>
		<td<?php echo $expenses->Reference_No->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Reference_No" id="z_Reference_No" value="LIKE"></span></td>
		<td<?php echo $expenses->Reference_No->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Reference_No" id="x_Reference_No" title="<?php echo $expenses->Reference_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $expenses->Reference_No->EditValue ?>"<?php echo $expenses->Reference_No->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Booking_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Booking_ID->FldCaption() ?></td>
		<td<?php echo $expenses->Booking_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Booking_ID" id="z_Booking_ID" value="="></span></td>
		<td<?php echo $expenses->Booking_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="as_x_Booking_ID" style="z-index: 8940">
	<input type="text" name="sv_x_Booking_ID" id="sv_x_Booking_ID" value="<?php echo $expenses->Booking_ID->EditValue ?>" title="<?php echo $expenses->Booking_ID->FldTitle() ?>" size="30"<?php echo $expenses->Booking_ID->EditAttributes() ?>>&nbsp;<span id="em_x_Booking_ID" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_Booking_ID"></div>
</div>
<input type="hidden" name="x_Booking_ID" id="x_Booking_ID" value="<?php echo $expenses->Booking_ID->AdvancedSearch->SearchValue ?>">
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Description->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Description->FldCaption() ?></td>
		<td<?php echo $expenses->Description->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Description" id="z_Description" value="LIKE"></span></td>
		<td<?php echo $expenses->Description->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Description" id="x_Description" title="<?php echo $expenses->Description->FldTitle() ?>" cols="35" rows="4"<?php echo $expenses->Description->EditAttributes() ?>><?php echo $expenses->Description->EditValue ?></textarea>
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
	<tr<?php echo $expenses->Amount->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Amount->FldCaption() ?></td>
		<td<?php echo $expenses->Amount->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Amount" id="z_Amount" value="="></span></td>
		<td<?php echo $expenses->Amount->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Amount" id="x_Amount" title="<?php echo $expenses->Amount->FldTitle() ?>" size="30" value="<?php echo $expenses->Amount->EditValue ?>"<?php echo $expenses->Amount->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Vat->FldCaption() ?></td>
		<td<?php echo $expenses->Vat->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Vat" id="z_Vat" value="="></span></td>
		<td<?php echo $expenses->Vat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Vat" id="x_Vat" title="<?php echo $expenses->Vat->FldTitle() ?>" size="30" value="<?php echo $expenses->Vat->EditValue ?>"<?php echo $expenses->Vat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Total_Sales->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Total_Sales->FldCaption() ?></td>
		<td<?php echo $expenses->Total_Sales->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Sales" id="z_Total_Sales" value="="></span></td>
		<td<?php echo $expenses->Total_Sales->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Sales" id="x_Total_Sales" title="<?php echo $expenses->Total_Sales->FldTitle() ?>" size="30" value="<?php echo $expenses->Total_Sales->EditValue ?>"<?php echo $expenses->Total_Sales->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Wtax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Wtax->FldCaption() ?></td>
		<td<?php echo $expenses->Wtax->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Wtax" id="z_Wtax" value="="></span></td>
		<td<?php echo $expenses->Wtax->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Wtax" id="x_Wtax" title="<?php echo $expenses->Wtax->FldTitle() ?>" size="30" value="<?php echo $expenses->Wtax->EditValue ?>"<?php echo $expenses->Wtax->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $expenses->Total_Amount_Due->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Amount_Due" id="z_Total_Amount_Due" value="="></span></td>
		<td<?php echo $expenses->Total_Amount_Due->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $expenses->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $expenses->Total_Amount_Due->EditValue ?>"<?php echo $expenses->Total_Amount_Due->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->Expenses_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Expenses_Type_ID->FldCaption() ?></td>
		<td<?php echo $expenses->Expenses_Type_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Expenses_Type_ID" id="z_Expenses_Type_ID" value="="></span></td>
		<td<?php echo $expenses->Expenses_Type_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Expenses_Type_ID" name="x_Expenses_Type_ID" title="<?php echo $expenses->Expenses_Type_ID->FldTitle() ?>"<?php echo $expenses->Expenses_Type_ID->EditAttributes() ?>>
<?php
if (is_array($expenses->Expenses_Type_ID->EditValue)) {
	$arwrk = $expenses->Expenses_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->Expenses_Type_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $expenses->Add_To_Billing->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Add_To_Billing->FldCaption() ?></td>
		<td<?php echo $expenses->Add_To_Billing->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Add_To_Billing" id="z_Add_To_Billing" value="LIKE"></span></td>
		<td<?php echo $expenses->Add_To_Billing->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_Add_To_Billing" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_Add_To_Billing" id="x_Add_To_Billing" title="<?php echo $expenses->Add_To_Billing->FldTitle() ?>" value="{value}"<?php echo $expenses->Add_To_Billing->EditAttributes() ?>></label></div>
<div id="dsl_x_Add_To_Billing" repeatcolumn="5">
<?php
$arwrk = $expenses->Add_To_Billing->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->Add_To_Billing->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->approver->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->approver->FldCaption() ?></td>
		<td<?php echo $expenses->approver->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_approver" id="z_approver" value="="></span></td>
		<td<?php echo $expenses->approver->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php $expenses->approver->EditAttrs["onchange"] = "ew_UpdateOpt('x_employee_id','x_approver',expenses_search.ar_x_employee_id); " . @$expenses->approver->EditAttrs["onchange"]; ?>
<select id="x_approver" name="x_approver" title="<?php echo $expenses->approver->FldTitle() ?>"<?php echo $expenses->approver->EditAttributes() ?>>
<?php
if (is_array($expenses->approver->EditValue)) {
	$arwrk = $expenses->approver->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->approver->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->employee_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->employee_id->FldCaption() ?></td>
		<td<?php echo $expenses->employee_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_employee_id" id="z_employee_id" value="="></span></td>
		<td<?php echo $expenses->employee_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_employee_id" name="x_employee_id" title="<?php echo $expenses->employee_id->FldTitle() ?>"<?php echo $expenses->employee_id->EditAttributes() ?>>
<?php
if (is_array($expenses->employee_id->EditValue)) {
	$arwrk = $expenses->employee_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->employee_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
expenses_search.ar_x_employee_id = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->modified->FldCaption() ?></td>
		<td<?php echo $expenses->modified->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_modified" id="z_modified" value="="></span></td>
		<td<?php echo $expenses->modified->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_modified" id="x_modified" title="<?php echo $expenses->modified->FldTitle() ?>" value="<?php echo $expenses->modified->EditValue ?>"<?php echo $expenses->modified->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->user_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->user_id->FldCaption() ?></td>
		<td<?php echo $expenses->user_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></span></td>
		<td<?php echo $expenses->user_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_user_id" id="x_user_id" title="<?php echo $expenses->user_id->FldTitle() ?>" size="30" value="<?php echo $expenses->user_id->EditValue ?>"<?php echo $expenses->user_id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->payment_mode->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->payment_mode->FldCaption() ?></td>
		<td<?php echo $expenses->payment_mode->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_payment_mode" id="z_payment_mode" value="LIKE"></span></td>
		<td<?php echo $expenses->payment_mode->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_payment_mode" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_payment_mode" id="x_payment_mode" title="<?php echo $expenses->payment_mode->FldTitle() ?>" value="{value}"<?php echo $expenses->payment_mode->EditAttributes() ?>></label></div>
<div id="dsl_x_payment_mode" repeatcolumn="5">
<?php
$arwrk = $expenses->payment_mode->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->payment_mode->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $expenses->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->status->FldCaption() ?></td>
		<td<?php echo $expenses->status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_status" id="z_status" value="LIKE"></span></td>
		<td<?php echo $expenses->status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_status" name="x_status" title="<?php echo $expenses->status->FldTitle() ?>"<?php echo $expenses->status->EditAttributes() ?>>
<?php
if (is_array($expenses->status->EditValue)) {
	$arwrk = $expenses->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenses->status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $expenses->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $expenses->Remarks->FldCaption() ?></td>
		<td<?php echo $expenses->Remarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE"></span></td>
		<td<?php echo $expenses->Remarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $expenses->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $expenses->Remarks->EditAttributes() ?>><?php echo $expenses->Remarks->EditValue ?></textarea>
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
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_employee_id','x_approver',expenses_search.ar_x_employee_id]]);

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
$expenses_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenses_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'expenses';

	// Page object name
	var $PageObjName = 'expenses_search';

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
	function cexpenses_search() {
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
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $expenses;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$expenses->CurrentAction = $objForm->GetValue("a_search");
			switch ($expenses->CurrentAction) {
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
						$sSrchStr = $expenses->UrlParm($sSrchStr);
						$this->Page_Terminate("expenseslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$expenses->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $expenses;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $expenses->id); // id
	$this->BuildSearchUrl($sSrchUrl, $expenses->Date_Created); // Date_Created
	$this->BuildSearchUrl($sSrchUrl, $expenses->expense_date); // expense_date
	$this->BuildSearchUrl($sSrchUrl, $expenses->expense_category_id); // expense_category_id
	$this->BuildSearchUrl($sSrchUrl, $expenses->Reference_No); // Reference_No
	$this->BuildSearchUrl($sSrchUrl, $expenses->Booking_ID); // Booking_ID
	$this->BuildSearchUrl($sSrchUrl, $expenses->Description); // Description
	$this->BuildSearchUrl($sSrchUrl, $expenses->Amount); // Amount
	$this->BuildSearchUrl($sSrchUrl, $expenses->Vat); // Vat
	$this->BuildSearchUrl($sSrchUrl, $expenses->Total_Sales); // Total_Sales
	$this->BuildSearchUrl($sSrchUrl, $expenses->Wtax); // Wtax
	$this->BuildSearchUrl($sSrchUrl, $expenses->Total_Amount_Due); // Total_Amount_Due
	$this->BuildSearchUrl($sSrchUrl, $expenses->Expenses_Type_ID); // Expenses_Type_ID
	$this->BuildSearchUrl($sSrchUrl, $expenses->Add_To_Billing); // Add_To_Billing
	$this->BuildSearchUrl($sSrchUrl, $expenses->approver); // approver
	$this->BuildSearchUrl($sSrchUrl, $expenses->employee_id); // employee_id
	$this->BuildSearchUrl($sSrchUrl, $expenses->modified); // modified
	$this->BuildSearchUrl($sSrchUrl, $expenses->user_id); // user_id
	$this->BuildSearchUrl($sSrchUrl, $expenses->payment_mode); // payment_mode
	$this->BuildSearchUrl($sSrchUrl, $expenses->status); // status
	$this->BuildSearchUrl($sSrchUrl, $expenses->Remarks); // Remarks
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
		global $objForm, $expenses;

		// Load search values
		// id

		$expenses->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$expenses->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// Date_Created
		$expenses->Date_Created->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Date_Created"));
		$expenses->Date_Created->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Date_Created");

		// expense_date
		$expenses->expense_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_expense_date"));
		$expenses->expense_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_expense_date");

		// expense_category_id
		$expenses->expense_category_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_expense_category_id"));
		$expenses->expense_category_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_expense_category_id");

		// Reference_No
		$expenses->Reference_No->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Reference_No"));
		$expenses->Reference_No->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Reference_No");

		// Booking_ID
		$expenses->Booking_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Booking_ID"));
		$expenses->Booking_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Booking_ID");

		// Description
		$expenses->Description->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Description"));
		$expenses->Description->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Description");

		// Amount
		$expenses->Amount->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Amount"));
		$expenses->Amount->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Amount");

		// Vat
		$expenses->Vat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Vat"));
		$expenses->Vat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Vat");

		// Total_Sales
		$expenses->Total_Sales->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Sales"));
		$expenses->Total_Sales->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Sales");

		// Wtax
		$expenses->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Wtax"));
		$expenses->Wtax->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Wtax");

		// Total_Amount_Due
		$expenses->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Amount_Due"));
		$expenses->Total_Amount_Due->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Amount_Due");

		// Expenses_Type_ID
		$expenses->Expenses_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Expenses_Type_ID"));
		$expenses->Expenses_Type_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Expenses_Type_ID");

		// Add_To_Billing
		$expenses->Add_To_Billing->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Add_To_Billing"));
		$expenses->Add_To_Billing->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Add_To_Billing");

		// approver
		$expenses->approver->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_approver"));
		$expenses->approver->AdvancedSearch->SearchOperator = $objForm->GetValue("z_approver");

		// employee_id
		$expenses->employee_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_employee_id"));
		$expenses->employee_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_employee_id");

		// modified
		$expenses->modified->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_modified"));
		$expenses->modified->AdvancedSearch->SearchOperator = $objForm->GetValue("z_modified");

		// user_id
		$expenses->user_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_user_id"));
		$expenses->user_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user_id");

		// payment_mode
		$expenses->payment_mode->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_payment_mode"));
		$expenses->payment_mode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_payment_mode");

		// status
		$expenses->status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_status"));
		$expenses->status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_status");

		// Remarks
		$expenses->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Remarks"));
		$expenses->Remarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Remarks");
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

		// Date_Created
		$expenses->Date_Created->CellCssStyle = ""; $expenses->Date_Created->CellCssClass = "";
		$expenses->Date_Created->CellAttrs = array(); $expenses->Date_Created->ViewAttrs = array(); $expenses->Date_Created->EditAttrs = array();

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

			// Date_Created
			$expenses->Date_Created->HrefValue = "";
			$expenses->Date_Created->TooltipValue = "";

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
		} elseif ($expenses->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$expenses->id->EditCustomAttributes = "";
			$expenses->id->EditValue = ew_HtmlEncode($expenses->id->AdvancedSearch->SearchValue);

			// Date_Created
			$expenses->Date_Created->EditCustomAttributes = "";
			$expenses->Date_Created->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($expenses->Date_Created->AdvancedSearch->SearchValue, 6), 6));

			// expense_date
			$expenses->expense_date->EditCustomAttributes = "";
			$expenses->expense_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($expenses->expense_date->AdvancedSearch->SearchValue, 6), 6));

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
			$expenses->Reference_No->EditValue = ew_HtmlEncode($expenses->Reference_No->AdvancedSearch->SearchValue);

			// Booking_ID
			$expenses->Booking_ID->EditCustomAttributes = "";
			$expenses->Booking_ID->EditValue = ew_HtmlEncode($expenses->Booking_ID->AdvancedSearch->SearchValue);
			if (strval($expenses->Booking_ID->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->Booking_ID->AdvancedSearch->SearchValue) . "";
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
					$expenses->Booking_ID->EditValue = $expenses->Booking_ID->AdvancedSearch->SearchValue;
				}
			} else {
				$expenses->Booking_ID->EditValue = NULL;
			}

			// Description
			$expenses->Description->EditCustomAttributes = "";
			$expenses->Description->EditValue = ew_HtmlEncode($expenses->Description->AdvancedSearch->SearchValue);

			// Amount
			$expenses->Amount->EditCustomAttributes = "";
			$expenses->Amount->EditValue = ew_HtmlEncode($expenses->Amount->AdvancedSearch->SearchValue);

			// Vat
			$expenses->Vat->EditCustomAttributes = "";
			$expenses->Vat->EditValue = ew_HtmlEncode($expenses->Vat->AdvancedSearch->SearchValue);

			// Total_Sales
			$expenses->Total_Sales->EditCustomAttributes = "";
			$expenses->Total_Sales->EditValue = ew_HtmlEncode($expenses->Total_Sales->AdvancedSearch->SearchValue);

			// Wtax
			$expenses->Wtax->EditCustomAttributes = "";
			$expenses->Wtax->EditValue = ew_HtmlEncode($expenses->Wtax->AdvancedSearch->SearchValue);

			// Total_Amount_Due
			$expenses->Total_Amount_Due->EditCustomAttributes = "";
			$expenses->Total_Amount_Due->EditValue = ew_HtmlEncode($expenses->Total_Amount_Due->AdvancedSearch->SearchValue);

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
			$expenses->modified->EditCustomAttributes = "";
			$expenses->modified->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($expenses->modified->AdvancedSearch->SearchValue, 6), 6));

			// user_id
			$expenses->user_id->EditCustomAttributes = "";
			$expenses->user_id->EditValue = ew_HtmlEncode($expenses->user_id->AdvancedSearch->SearchValue);

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
			$expenses->Remarks->EditValue = ew_HtmlEncode($expenses->Remarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($expenses->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenses->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $expenses;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($expenses->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->id->FldErrMsg();
		}
		if (!ew_CheckUSDate($expenses->Date_Created->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->Date_Created->FldErrMsg();
		}
		if (!ew_CheckUSDate($expenses->expense_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->expense_date->FldErrMsg();
		}
		if (!ew_CheckInteger($expenses->Booking_ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->Booking_ID->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Amount->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->Amount->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Vat->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Total_Sales->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->Total_Sales->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Wtax->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->Wtax->FldErrMsg();
		}
		if (!ew_CheckNumber($expenses->Total_Amount_Due->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->Total_Amount_Due->FldErrMsg();
		}
		if (!ew_CheckUSDate($expenses->modified->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->modified->FldErrMsg();
		}
		if (!ew_CheckInteger($expenses->user_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $expenses->user_id->FldErrMsg();
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
		global $expenses;
		$expenses->id->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_id");
		$expenses->Date_Created->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Date_Created");
		$expenses->expense_date->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_expense_date");
		$expenses->expense_category_id->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_expense_category_id");
		$expenses->Reference_No->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Reference_No");
		$expenses->Booking_ID->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Booking_ID");
		$expenses->Description->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Description");
		$expenses->Amount->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Amount");
		$expenses->Vat->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Vat");
		$expenses->Total_Sales->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Total_Sales");
		$expenses->Wtax->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Wtax");
		$expenses->Total_Amount_Due->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Total_Amount_Due");
		$expenses->Expenses_Type_ID->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Expenses_Type_ID");
		$expenses->Add_To_Billing->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Add_To_Billing");
		$expenses->approver->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_approver");
		$expenses->employee_id->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_employee_id");
		$expenses->modified->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_modified");
		$expenses->user_id->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_user_id");
		$expenses->payment_mode->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_payment_mode");
		$expenses->status->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_status");
		$expenses->Remarks->AdvancedSearch->SearchValue = $expenses->getAdvancedSearch("x_Remarks");
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
