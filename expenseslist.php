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
$expenses_list = new cexpenses_list();
$Page =& $expenses_list;

// Page init
$expenses_list->Page_Init();

// Page main
$expenses_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($expenses->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expenses_list = new ew_Page("expenses_list");

// page properties
expenses_list.PageID = "list"; // page ID
expenses_list.FormID = "fexpenseslist"; // form ID
var EW_PAGE_ID = expenses_list.PageID; // for backward compatibility

// extend page with validate function for search
expenses_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_Date_Created"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Date_Created->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_expense_date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->expense_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Booking_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenses->Booking_ID->FldErrMsg()) ?>");

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
expenses_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenses_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenses_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenses_list.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<?php if ($expenses->Export == "") { ?>
<?php
$gsMasterReturnUrl = "bookingslist.php";
if ($expenses_list->sDbMasterFilter <> "" && $expenses->getCurrentMasterTable() == "bookings") {
	if ($expenses_list->bMasterRecordExists) {
		if ($expenses->getCurrentMasterTable() == $expenses->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "bookingsmaster.php" ?>
<?php
	}
}
?>
<?php
$gsMasterReturnUrl = "accounts_receivablelist.php";
if ($expenses_list->sDbMasterFilter <> "" && $expenses->getCurrentMasterTable() == "accounts_receivable") {
	if ($expenses_list->bMasterRecordExists) {
		if ($expenses->getCurrentMasterTable() == $expenses->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "accounts_receivablemaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$expenses_list->lTotalRecs = $expenses->SelectRecordCount();
	} else {
		if ($rs = $expenses_list->LoadRecordset())
			$expenses_list->lTotalRecs = $rs->RecordCount();
	}
	$expenses_list->lStartRec = 1;
	if ($expenses_list->lDisplayRecs <= 0 || ($expenses->Export <> "" && $expenses->ExportAll)) // Display all records
		$expenses_list->lDisplayRecs = $expenses_list->lTotalRecs;
	if (!($expenses->Export <> "" && $expenses->ExportAll))
		$expenses_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $expenses_list->LoadRecordset($expenses_list->lStartRec-1, $expenses_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenses->TableCaption() ?>
<?php if ($expenses->Export == "" && $expenses->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $expenses_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $expenses_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $expenses_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($expenses->Export == "" && $expenses->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(expenses_list);" style="text-decoration: none;"><img id="expenses_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="expenses_list_SearchPanel">
<form name="fexpenseslistsrch" id="fexpenseslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return expenses_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="expenses">
<?php
if ($gsSearchError == "")
	$expenses_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$expenses->RowType = EW_ROWTYPE_SEARCH;

// Render row
$expenses_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->Date_Created->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Date_Created" id="z_Date_Created" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->expense_date->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_expense_date" id="z_expense_date" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->expense_category_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_expense_category_id" id="z_expense_category_id" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->Reference_No->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Reference_No" id="z_Reference_No" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Reference_No" id="x_Reference_No" title="<?php echo $expenses->Reference_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $expenses->Reference_No->EditValue ?>"<?php echo $expenses->Reference_No->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->Booking_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Booking_ID" id="z_Booking_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($expenses->Booking_ID->getSessionValue() <> "") { ?>
<div<?php echo $expenses->Booking_ID->ViewAttributes() ?>><?php echo $expenses->Booking_ID->ListViewValue() ?></div>
<input type="hidden" id="x_Booking_ID" name="x_Booking_ID" value="<?php echo ew_HtmlEncode($expenses->Booking_ID->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->Expenses_Type_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Expenses_Type_ID" id="z_Expenses_Type_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->Add_To_Billing->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Add_To_Billing" id="z_Add_To_Billing" value="LIKE"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->approver->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_approver" id="z_approver" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php $expenses->approver->EditAttrs["onchange"] = "ew_UpdateOpt('x_employee_id','x_approver',expenses_list.ar_x_employee_id); " . @$expenses->approver->EditAttrs["onchange"]; ?>
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
	<tr>
		<td><span class="phpmaker"><?php echo $expenses->employee_id->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_employee_id" id="z_employee_id" value="="></span></td>
		<td>			
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
expenses_list.ar_x_employee_id = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($expenses->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $expenses_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="expensessrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($expenses->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($expenses->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($expenses->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expenses_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($expenses->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($expenses->CurrentAction <> "gridadd" && $expenses->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expenses_list->Pager)) $expenses_list->Pager = new cPrevNextPager($expenses_list->lStartRec, $expenses_list->lDisplayRecs, $expenses_list->lTotalRecs) ?>
<?php if ($expenses_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expenses_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_list->PageUrl() ?>start=<?php echo $expenses_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expenses_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_list->PageUrl() ?>start=<?php echo $expenses_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expenses_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expenses_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_list->PageUrl() ?>start=<?php echo $expenses_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expenses_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_list->PageUrl() ?>start=<?php echo $expenses_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expenses_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expenses_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expenses_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expenses_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($expenses_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expenses_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expenses">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($expenses_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expenses_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expenses_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($expenses_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($expenses_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($expenses_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($expenses->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expenses_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expenses_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fexpenseslist, '<?php echo $expenses_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fexpenseslist" id="fexpenseslist" class="ewForm" action="" method="post">
<div id="gmp_expenses" class="ewGridMiddlePanel">
<?php if ($expenses_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $expenses->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$expenses_list->RenderListOptions();

// Render list options (header, left)
$expenses_list->ListOptions->Render("header", "left");
?>
<?php if ($expenses->id->Visible) { // id ?>
	<?php if ($expenses->SortUrl($expenses->id) == "") { ?>
		<td><?php echo $expenses->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Date_Created->Visible) { // Date_Created ?>
	<?php if ($expenses->SortUrl($expenses->Date_Created) == "") { ?>
		<td><?php echo $expenses->Date_Created->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Date_Created) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Date_Created->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->Date_Created->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Date_Created->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->expense_date->Visible) { // expense_date ?>
	<?php if ($expenses->SortUrl($expenses->expense_date) == "") { ?>
		<td><?php echo $expenses->expense_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->expense_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->expense_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->expense_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->expense_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->expense_category_id->Visible) { // expense_category_id ?>
	<?php if ($expenses->SortUrl($expenses->expense_category_id) == "") { ?>
		<td><?php echo $expenses->expense_category_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->expense_category_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->expense_category_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->expense_category_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->expense_category_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Reference_No->Visible) { // Reference_No ?>
	<?php if ($expenses->SortUrl($expenses->Reference_No) == "") { ?>
		<td><?php echo $expenses->Reference_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Reference_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Reference_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($expenses->Reference_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Reference_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Booking_ID->Visible) { // Booking_ID ?>
	<?php if ($expenses->SortUrl($expenses->Booking_ID) == "") { ?>
		<td><?php echo $expenses->Booking_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Booking_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Booking_ID->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($expenses->Booking_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Booking_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Description->Visible) { // Description ?>
	<?php if ($expenses->SortUrl($expenses->Description) == "") { ?>
		<td><?php echo $expenses->Description->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Description) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Description->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($expenses->Description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Amount->Visible) { // Amount ?>
	<?php if ($expenses->SortUrl($expenses->Amount) == "") { ?>
		<td><?php echo $expenses->Amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->Amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Vat->Visible) { // Vat ?>
	<?php if ($expenses->SortUrl($expenses->Vat) == "") { ?>
		<td><?php echo $expenses->Vat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Vat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Vat->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->Vat->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Vat->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Total_Sales->Visible) { // Total_Sales ?>
	<?php if ($expenses->SortUrl($expenses->Total_Sales) == "") { ?>
		<td><?php echo $expenses->Total_Sales->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Total_Sales) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Total_Sales->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->Total_Sales->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Total_Sales->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Wtax->Visible) { // Wtax ?>
	<?php if ($expenses->SortUrl($expenses->Wtax) == "") { ?>
		<td><?php echo $expenses->Wtax->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Wtax) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Wtax->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->Wtax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Wtax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<?php if ($expenses->SortUrl($expenses->Total_Amount_Due) == "") { ?>
		<td><?php echo $expenses->Total_Amount_Due->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Total_Amount_Due) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Total_Amount_Due->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->Total_Amount_Due->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Total_Amount_Due->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->File_Upload->Visible) { // File_Upload ?>
	<?php if ($expenses->SortUrl($expenses->File_Upload) == "") { ?>
		<td><?php echo $expenses->File_Upload->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->File_Upload) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->File_Upload->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->File_Upload->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->File_Upload->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Expenses_Type_ID->Visible) { // Expenses_Type_ID ?>
	<?php if ($expenses->SortUrl($expenses->Expenses_Type_ID) == "") { ?>
		<td><?php echo $expenses->Expenses_Type_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Expenses_Type_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Expenses_Type_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->Expenses_Type_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Expenses_Type_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Add_To_Billing->Visible) { // Add_To_Billing ?>
	<?php if ($expenses->SortUrl($expenses->Add_To_Billing) == "") { ?>
		<td><?php echo $expenses->Add_To_Billing->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Add_To_Billing) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Add_To_Billing->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->Add_To_Billing->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Add_To_Billing->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->approver->Visible) { // approver ?>
	<?php if ($expenses->SortUrl($expenses->approver) == "") { ?>
		<td><?php echo $expenses->approver->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->approver) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->approver->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->approver->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->approver->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->employee_id->Visible) { // employee_id ?>
	<?php if ($expenses->SortUrl($expenses->employee_id) == "") { ?>
		<td><?php echo $expenses->employee_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->employee_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->employee_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->employee_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->employee_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->modified->Visible) { // modified ?>
	<?php if ($expenses->SortUrl($expenses->modified) == "") { ?>
		<td><?php echo $expenses->modified->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->modified) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->modified->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->modified->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->modified->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->user_id->Visible) { // user_id ?>
	<?php if ($expenses->SortUrl($expenses->user_id) == "") { ?>
		<td><?php echo $expenses->user_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->user_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->user_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->user_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->user_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->payment_mode->Visible) { // payment_mode ?>
	<?php if ($expenses->SortUrl($expenses->payment_mode) == "") { ?>
		<td><?php echo $expenses->payment_mode->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->payment_mode) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->payment_mode->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->payment_mode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->payment_mode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->status->Visible) { // status ?>
	<?php if ($expenses->SortUrl($expenses->status) == "") { ?>
		<td><?php echo $expenses->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses->Remarks->Visible) { // Remarks ?>
	<?php if ($expenses->SortUrl($expenses->Remarks) == "") { ?>
		<td><?php echo $expenses->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses->SortUrl($expenses->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($expenses->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$expenses_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($expenses->ExportAll && $expenses->Export <> "") {
	$expenses_list->lStopRec = $expenses_list->lTotalRecs;
} else {
	$expenses_list->lStopRec = $expenses_list->lStartRec + $expenses_list->lDisplayRecs - 1; // Set the last record to display
}
$expenses_list->lRecCount = $expenses_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $expenses_list->lStartRec > 1)
		$rs->Move($expenses_list->lStartRec - 1);
}

// Initialize aggregate
$expenses->RowType = EW_ROWTYPE_AGGREGATEINIT;
$expenses_list->RenderRow();
$expenses_list->lRowCnt = 0;
while (($expenses->CurrentAction == "gridadd" || !$rs->EOF) &&
	$expenses_list->lRecCount < $expenses_list->lStopRec) {
	$expenses_list->lRecCount++;
	if (intval($expenses_list->lRecCount) >= intval($expenses_list->lStartRec)) {
		$expenses_list->lRowCnt++;

	// Init row class and style
	$expenses->CssClass = "";
	$expenses->CssStyle = "";
	$expenses->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($expenses->CurrentAction == "gridadd") {
		$expenses_list->LoadDefaultValues(); // Load default values
	} else {
		$expenses_list->LoadRowValues($rs); // Load row values
	}
	$expenses->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$expenses_list->RenderRow();

	// Render list options
	$expenses_list->RenderListOptions();
?>
	<tr<?php echo $expenses->RowAttributes() ?>>
<?php

// Render list options (body, left)
$expenses_list->ListOptions->Render("body", "left");
?>
	<?php if ($expenses->id->Visible) { // id ?>
		<td<?php echo $expenses->id->CellAttributes() ?>>
<div<?php echo $expenses->id->ViewAttributes() ?>><?php echo $expenses->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Date_Created->Visible) { // Date_Created ?>
		<td<?php echo $expenses->Date_Created->CellAttributes() ?>>
<div<?php echo $expenses->Date_Created->ViewAttributes() ?>><?php echo $expenses->Date_Created->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->expense_date->Visible) { // expense_date ?>
		<td<?php echo $expenses->expense_date->CellAttributes() ?>>
<div<?php echo $expenses->expense_date->ViewAttributes() ?>><?php echo $expenses->expense_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->expense_category_id->Visible) { // expense_category_id ?>
		<td<?php echo $expenses->expense_category_id->CellAttributes() ?>>
<div<?php echo $expenses->expense_category_id->ViewAttributes() ?>><?php echo $expenses->expense_category_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Reference_No->Visible) { // Reference_No ?>
		<td<?php echo $expenses->Reference_No->CellAttributes() ?>>
<div<?php echo $expenses->Reference_No->ViewAttributes() ?>><?php echo $expenses->Reference_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Booking_ID->Visible) { // Booking_ID ?>
		<td<?php echo $expenses->Booking_ID->CellAttributes() ?>>
<div<?php echo $expenses->Booking_ID->ViewAttributes() ?>><?php echo $expenses->Booking_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Description->Visible) { // Description ?>
		<td<?php echo $expenses->Description->CellAttributes() ?>>
<div<?php echo $expenses->Description->ViewAttributes() ?>><?php echo $expenses->Description->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Amount->Visible) { // Amount ?>
		<td<?php echo $expenses->Amount->CellAttributes() ?>>
<div<?php echo $expenses->Amount->ViewAttributes() ?>><?php echo $expenses->Amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Vat->Visible) { // Vat ?>
		<td<?php echo $expenses->Vat->CellAttributes() ?>>
<div<?php echo $expenses->Vat->ViewAttributes() ?>><?php echo $expenses->Vat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Total_Sales->Visible) { // Total_Sales ?>
		<td<?php echo $expenses->Total_Sales->CellAttributes() ?>>
<div<?php echo $expenses->Total_Sales->ViewAttributes() ?>><?php echo $expenses->Total_Sales->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Wtax->Visible) { // Wtax ?>
		<td<?php echo $expenses->Wtax->CellAttributes() ?>>
<div<?php echo $expenses->Wtax->ViewAttributes() ?>><?php echo $expenses->Wtax->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td<?php echo $expenses->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $expenses->Total_Amount_Due->ViewAttributes() ?>><?php echo $expenses->Total_Amount_Due->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->File_Upload->Visible) { // File_Upload ?>
		<td<?php echo $expenses->File_Upload->CellAttributes() ?>>
<?php if ($expenses->File_Upload->HrefValue <> "" || $expenses->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($expenses->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $expenses->File_Upload->HrefValue ?>"><?php echo $expenses->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($expenses->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($expenses->File_Upload->Upload->DbValue)) { ?>
<?php echo $expenses->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($expenses->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($expenses->Expenses_Type_ID->Visible) { // Expenses_Type_ID ?>
		<td<?php echo $expenses->Expenses_Type_ID->CellAttributes() ?>>
<div<?php echo $expenses->Expenses_Type_ID->ViewAttributes() ?>><?php echo $expenses->Expenses_Type_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Add_To_Billing->Visible) { // Add_To_Billing ?>
		<td<?php echo $expenses->Add_To_Billing->CellAttributes() ?>>
<div<?php echo $expenses->Add_To_Billing->ViewAttributes() ?>><?php echo $expenses->Add_To_Billing->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->approver->Visible) { // approver ?>
		<td<?php echo $expenses->approver->CellAttributes() ?>>
<div<?php echo $expenses->approver->ViewAttributes() ?>><?php echo $expenses->approver->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->employee_id->Visible) { // employee_id ?>
		<td<?php echo $expenses->employee_id->CellAttributes() ?>>
<div<?php echo $expenses->employee_id->ViewAttributes() ?>><?php echo $expenses->employee_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->modified->Visible) { // modified ?>
		<td<?php echo $expenses->modified->CellAttributes() ?>>
<div<?php echo $expenses->modified->ViewAttributes() ?>><?php echo $expenses->modified->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->user_id->Visible) { // user_id ?>
		<td<?php echo $expenses->user_id->CellAttributes() ?>>
<div<?php echo $expenses->user_id->ViewAttributes() ?>><?php echo $expenses->user_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->payment_mode->Visible) { // payment_mode ?>
		<td<?php echo $expenses->payment_mode->CellAttributes() ?>>
<div<?php echo $expenses->payment_mode->ViewAttributes() ?>><?php echo $expenses->payment_mode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->status->Visible) { // status ?>
		<td<?php echo $expenses->status->CellAttributes() ?>>
<div<?php echo $expenses->status->ViewAttributes() ?>><?php echo $expenses->status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses->Remarks->Visible) { // Remarks ?>
		<td<?php echo $expenses->Remarks->CellAttributes() ?>>
<div<?php echo $expenses->Remarks->ViewAttributes() ?>><?php echo $expenses->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$expenses_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($expenses->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$expenses->RowType = EW_ROWTYPE_AGGREGATE;
$expenses_list->RenderRow();
?>
<?php if ($expenses_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$expenses_list->RenderListOptions();

// Render list options (footer, left)
$expenses_list->ListOptions->Render("footer", "left");
?>
	<?php if ($expenses->id->Visible) { // id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->Date_Created->Visible) { // Date_Created ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->expense_date->Visible) { // expense_date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->expense_category_id->Visible) { // expense_category_id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->Reference_No->Visible) { // Reference_No ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->Booking_ID->Visible) { // Booking_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->Description->Visible) { // Description ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->Amount->Visible) { // Amount ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expenses->Amount->ViewAttributes() ?>><?php echo $expenses->Amount->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expenses->Vat->Visible) { // Vat ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expenses->Vat->ViewAttributes() ?>><?php echo $expenses->Vat->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expenses->Total_Sales->Visible) { // Total_Sales ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expenses->Total_Sales->ViewAttributes() ?>><?php echo $expenses->Total_Sales->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expenses->Wtax->Visible) { // Wtax ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expenses->Wtax->ViewAttributes() ?>><?php echo $expenses->Wtax->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expenses->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $expenses->Total_Amount_Due->ViewAttributes() ?>><?php echo $expenses->Total_Amount_Due->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($expenses->File_Upload->Visible) { // File_Upload ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->Expenses_Type_ID->Visible) { // Expenses_Type_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->Add_To_Billing->Visible) { // Add_To_Billing ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->approver->Visible) { // approver ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->employee_id->Visible) { // employee_id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->modified->Visible) { // modified ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->user_id->Visible) { // user_id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->payment_mode->Visible) { // payment_mode ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->status->Visible) { // status ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($expenses->Remarks->Visible) { // Remarks ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$expenses_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>	
<?php } ?>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($expenses_list->lTotalRecs > 0) { ?>
<?php if ($expenses->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($expenses->CurrentAction <> "gridadd" && $expenses->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expenses_list->Pager)) $expenses_list->Pager = new cPrevNextPager($expenses_list->lStartRec, $expenses_list->lDisplayRecs, $expenses_list->lTotalRecs) ?>
<?php if ($expenses_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expenses_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_list->PageUrl() ?>start=<?php echo $expenses_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expenses_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_list->PageUrl() ?>start=<?php echo $expenses_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expenses_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expenses_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_list->PageUrl() ?>start=<?php echo $expenses_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expenses_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_list->PageUrl() ?>start=<?php echo $expenses_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expenses_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expenses_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expenses_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expenses_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($expenses_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expenses_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expenses">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($expenses_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expenses_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expenses_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($expenses_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($expenses_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($expenses_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($expenses->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($expenses_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expenses_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expenses_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fexpenseslist, '<?php echo $expenses_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($expenses->Export == "" && $expenses->CurrentAction == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_employee_id','x_approver',expenses_list.ar_x_employee_id]]);

//-->
</script>
<?php } ?>
<?php if ($expenses->Export == "") { ?>
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
<?php } ?>
<?php include "footer.php" ?>
<?php
$expenses_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenses_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'expenses';

	// Page object name
	var $PageObjName = 'expenses_list';

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
	function cexpenses_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expenses)
		$GLOBALS["expenses"] = new cexpenses();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["expenses"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "expensesdelete.php";
		$this->MultiUpdateUrl = "expensesupdate.php";

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (accounts_receivable)
		$GLOBALS['accounts_receivable'] = new caccounts_receivable();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenses', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$expenses->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$expenses->Export = $_POST["exporttype"];
		} else {
			$expenses->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $expenses->Export; // Get export parameter, used in header
		$gsExportFile = $expenses->TableVar; // Get export file, used in header
		if ($expenses->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}

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

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $expenses;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$expenses->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($expenses->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $expenses->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$expenses->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$expenses->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$expenses->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $expenses->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $expenses->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $expenses->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($expenses->getMasterFilter() <> "" && $expenses->getCurrentMasterTable() == "bookings") {
			global $bookings;
			$rsmaster = $bookings->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$expenses->setMasterFilter(""); // Clear master filter
				$expenses->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($expenses->getReturnUrl()); // Return to caller
			} else {
				$bookings->LoadListRowValues($rsmaster);
				$bookings->RowType = EW_ROWTYPE_MASTER; // Master row
				$bookings->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($expenses->getMasterFilter() <> "" && $expenses->getCurrentMasterTable() == "accounts_receivable") {
			global $accounts_receivable;
			$rsmaster = $accounts_receivable->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$expenses->setMasterFilter(""); // Clear master filter
				$expenses->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($expenses->getReturnUrl()); // Return to caller
			} else {
				$accounts_receivable->LoadListRowValues($rsmaster);
				$accounts_receivable->RowType = EW_ROWTYPE_MASTER; // Master row
				$accounts_receivable->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$expenses->setSessionWhere($sFilter);
		$expenses->CurrentFilter = "";

		// Export data only
		if (in_array($expenses->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($expenses->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $expenses;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->lDisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->lDisplayRecs = -1;
				} else {
					$this->lDisplayRecs = 20; // Non-numeric, load default
				}
			}
			$expenses->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$expenses->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $expenses;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $expenses->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $expenses->Date_Created, FALSE); // Date_Created
		$this->BuildSearchSql($sWhere, $expenses->expense_date, FALSE); // expense_date
		$this->BuildSearchSql($sWhere, $expenses->expense_category_id, FALSE); // expense_category_id
		$this->BuildSearchSql($sWhere, $expenses->Reference_No, FALSE); // Reference_No
		$this->BuildSearchSql($sWhere, $expenses->Booking_ID, FALSE); // Booking_ID
		$this->BuildSearchSql($sWhere, $expenses->Description, FALSE); // Description
		$this->BuildSearchSql($sWhere, $expenses->Amount, FALSE); // Amount
		$this->BuildSearchSql($sWhere, $expenses->Vat, FALSE); // Vat
		$this->BuildSearchSql($sWhere, $expenses->Total_Sales, FALSE); // Total_Sales
		$this->BuildSearchSql($sWhere, $expenses->Wtax, FALSE); // Wtax
		$this->BuildSearchSql($sWhere, $expenses->Total_Amount_Due, FALSE); // Total_Amount_Due
		$this->BuildSearchSql($sWhere, $expenses->Expenses_Type_ID, FALSE); // Expenses_Type_ID
		$this->BuildSearchSql($sWhere, $expenses->Add_To_Billing, FALSE); // Add_To_Billing
		$this->BuildSearchSql($sWhere, $expenses->approver, FALSE); // approver
		$this->BuildSearchSql($sWhere, $expenses->employee_id, FALSE); // employee_id
		$this->BuildSearchSql($sWhere, $expenses->modified, FALSE); // modified
		$this->BuildSearchSql($sWhere, $expenses->user_id, FALSE); // user_id
		$this->BuildSearchSql($sWhere, $expenses->payment_mode, FALSE); // payment_mode
		$this->BuildSearchSql($sWhere, $expenses->status, FALSE); // status
		$this->BuildSearchSql($sWhere, $expenses->Remarks, FALSE); // Remarks

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($expenses->id); // id
			$this->SetSearchParm($expenses->Date_Created); // Date_Created
			$this->SetSearchParm($expenses->expense_date); // expense_date
			$this->SetSearchParm($expenses->expense_category_id); // expense_category_id
			$this->SetSearchParm($expenses->Reference_No); // Reference_No
			$this->SetSearchParm($expenses->Booking_ID); // Booking_ID
			$this->SetSearchParm($expenses->Description); // Description
			$this->SetSearchParm($expenses->Amount); // Amount
			$this->SetSearchParm($expenses->Vat); // Vat
			$this->SetSearchParm($expenses->Total_Sales); // Total_Sales
			$this->SetSearchParm($expenses->Wtax); // Wtax
			$this->SetSearchParm($expenses->Total_Amount_Due); // Total_Amount_Due
			$this->SetSearchParm($expenses->Expenses_Type_ID); // Expenses_Type_ID
			$this->SetSearchParm($expenses->Add_To_Billing); // Add_To_Billing
			$this->SetSearchParm($expenses->approver); // approver
			$this->SetSearchParm($expenses->employee_id); // employee_id
			$this->SetSearchParm($expenses->modified); // modified
			$this->SetSearchParm($expenses->user_id); // user_id
			$this->SetSearchParm($expenses->payment_mode); // payment_mode
			$this->SetSearchParm($expenses->status); // status
			$this->SetSearchParm($expenses->Remarks); // Remarks
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $expenses;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$expenses->setAdvancedSearch("x_$FldParm", $FldVal);
		$expenses->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$expenses->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$expenses->setAdvancedSearch("y_$FldParm", $FldVal2);
		$expenses->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $expenses;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $expenses->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $expenses->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $expenses->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $expenses->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $expenses->GetAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $expenses;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $expenses->Reference_No, $Keyword);
		if (is_numeric($Keyword)) $this->BuildBasicSearchSQL($sWhere, $expenses->Booking_ID, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expenses->Description, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expenses->File_Upload, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expenses->Add_To_Billing, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expenses->payment_mode, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expenses->status, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expenses->Remarks, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $expenses;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $expenses->BasicSearchKeyword;
		$sSearchType = $expenses->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$expenses->setSessionBasicSearchKeyword($sSearchKeyword);
			$expenses->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $expenses;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$expenses->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $expenses;
		$expenses->setSessionBasicSearchKeyword("");
		$expenses->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $expenses;
		$expenses->setAdvancedSearch("x_id", "");
		$expenses->setAdvancedSearch("x_Date_Created", "");
		$expenses->setAdvancedSearch("x_expense_date", "");
		$expenses->setAdvancedSearch("x_expense_category_id", "");
		$expenses->setAdvancedSearch("x_Reference_No", "");
		$expenses->setAdvancedSearch("x_Booking_ID", "");
		$expenses->setAdvancedSearch("x_Description", "");
		$expenses->setAdvancedSearch("x_Amount", "");
		$expenses->setAdvancedSearch("x_Vat", "");
		$expenses->setAdvancedSearch("x_Total_Sales", "");
		$expenses->setAdvancedSearch("x_Wtax", "");
		$expenses->setAdvancedSearch("x_Total_Amount_Due", "");
		$expenses->setAdvancedSearch("x_Expenses_Type_ID", "");
		$expenses->setAdvancedSearch("x_Add_To_Billing", "");
		$expenses->setAdvancedSearch("x_approver", "");
		$expenses->setAdvancedSearch("x_employee_id", "");
		$expenses->setAdvancedSearch("x_modified", "");
		$expenses->setAdvancedSearch("x_user_id", "");
		$expenses->setAdvancedSearch("x_payment_mode", "");
		$expenses->setAdvancedSearch("x_status", "");
		$expenses->setAdvancedSearch("x_Remarks", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $expenses;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Date_Created"] <> "") $bRestore = FALSE;
		if (@$_GET["x_expense_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_expense_category_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Reference_No"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Booking_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Description"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Amount"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Vat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Sales"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Wtax"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Amount_Due"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Expenses_Type_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Add_To_Billing"] <> "") $bRestore = FALSE;
		if (@$_GET["x_approver"] <> "") $bRestore = FALSE;
		if (@$_GET["x_employee_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_modified"] <> "") $bRestore = FALSE;
		if (@$_GET["x_user_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_payment_mode"] <> "") $bRestore = FALSE;
		if (@$_GET["x_status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$expenses->BasicSearchKeyword = $expenses->getSessionBasicSearchKeyword();
			$expenses->BasicSearchType = $expenses->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($expenses->id);
			$this->GetSearchParm($expenses->Date_Created);
			$this->GetSearchParm($expenses->expense_date);
			$this->GetSearchParm($expenses->expense_category_id);
			$this->GetSearchParm($expenses->Reference_No);
			$this->GetSearchParm($expenses->Booking_ID);
			$this->GetSearchParm($expenses->Description);
			$this->GetSearchParm($expenses->Amount);
			$this->GetSearchParm($expenses->Vat);
			$this->GetSearchParm($expenses->Total_Sales);
			$this->GetSearchParm($expenses->Wtax);
			$this->GetSearchParm($expenses->Total_Amount_Due);
			$this->GetSearchParm($expenses->Expenses_Type_ID);
			$this->GetSearchParm($expenses->Add_To_Billing);
			$this->GetSearchParm($expenses->approver);
			$this->GetSearchParm($expenses->employee_id);
			$this->GetSearchParm($expenses->modified);
			$this->GetSearchParm($expenses->user_id);
			$this->GetSearchParm($expenses->payment_mode);
			$this->GetSearchParm($expenses->status);
			$this->GetSearchParm($expenses->Remarks);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $expenses;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$expenses->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$expenses->CurrentOrderType = @$_GET["ordertype"];
			$expenses->UpdateSort($expenses->id); // id
			$expenses->UpdateSort($expenses->Date_Created); // Date_Created
			$expenses->UpdateSort($expenses->expense_date); // expense_date
			$expenses->UpdateSort($expenses->expense_category_id); // expense_category_id
			$expenses->UpdateSort($expenses->Reference_No); // Reference_No
			$expenses->UpdateSort($expenses->Booking_ID); // Booking_ID
			$expenses->UpdateSort($expenses->Description); // Description
			$expenses->UpdateSort($expenses->Amount); // Amount
			$expenses->UpdateSort($expenses->Vat); // Vat
			$expenses->UpdateSort($expenses->Total_Sales); // Total_Sales
			$expenses->UpdateSort($expenses->Wtax); // Wtax
			$expenses->UpdateSort($expenses->Total_Amount_Due); // Total_Amount_Due
			$expenses->UpdateSort($expenses->File_Upload); // File_Upload
			$expenses->UpdateSort($expenses->Expenses_Type_ID); // Expenses_Type_ID
			$expenses->UpdateSort($expenses->Add_To_Billing); // Add_To_Billing
			$expenses->UpdateSort($expenses->approver); // approver
			$expenses->UpdateSort($expenses->employee_id); // employee_id
			$expenses->UpdateSort($expenses->modified); // modified
			$expenses->UpdateSort($expenses->user_id); // user_id
			$expenses->UpdateSort($expenses->payment_mode); // payment_mode
			$expenses->UpdateSort($expenses->status); // status
			$expenses->UpdateSort($expenses->Remarks); // Remarks
			$expenses->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $expenses;
		$sOrderBy = $expenses->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($expenses->SqlOrderBy() <> "") {
				$sOrderBy = $expenses->SqlOrderBy();
				$expenses->setSessionOrderBy($sOrderBy);
				$expenses->Date_Created->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $expenses;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$expenses->getCurrentMasterTable = ""; // Clear master table
				$expenses->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$expenses->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$expenses->Booking_ID->setSessionValue("");
				$expenses->Booking_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$expenses->setSessionOrderBy($sOrderBy);
				$expenses->id->setSort("");
				$expenses->Date_Created->setSort("");
				$expenses->expense_date->setSort("");
				$expenses->expense_category_id->setSort("");
				$expenses->Reference_No->setSort("");
				$expenses->Booking_ID->setSort("");
				$expenses->Description->setSort("");
				$expenses->Amount->setSort("");
				$expenses->Vat->setSort("");
				$expenses->Total_Sales->setSort("");
				$expenses->Wtax->setSort("");
				$expenses->Total_Amount_Due->setSort("");
				$expenses->File_Upload->setSort("");
				$expenses->Expenses_Type_ID->setSort("");
				$expenses->Add_To_Billing->setSort("");
				$expenses->approver->setSort("");
				$expenses->employee_id->setSort("");
				$expenses->modified->setSort("");
				$expenses->user_id->setSort("");
				$expenses->payment_mode->setSort("");
				$expenses->status->setSort("");
				$expenses->Remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$expenses->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $expenses;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"expenses_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($expenses->Export <> "" ||
			$expenses->CurrentAction == "gridadd" ||
			$expenses->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $expenses;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($expenses->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $expenses;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expenses;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$expenses->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$expenses->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $expenses->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$expenses->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$expenses->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$expenses->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $expenses;
		$expenses->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$expenses->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $expenses;

		// Load search values
		// id

		$expenses->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$expenses->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Date_Created
		$expenses->Date_Created->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Date_Created"]);
		$expenses->Date_Created->AdvancedSearch->SearchOperator = @$_GET["z_Date_Created"];

		// expense_date
		$expenses->expense_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_expense_date"]);
		$expenses->expense_date->AdvancedSearch->SearchOperator = @$_GET["z_expense_date"];

		// expense_category_id
		$expenses->expense_category_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_expense_category_id"]);
		$expenses->expense_category_id->AdvancedSearch->SearchOperator = @$_GET["z_expense_category_id"];

		// Reference_No
		$expenses->Reference_No->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Reference_No"]);
		$expenses->Reference_No->AdvancedSearch->SearchOperator = @$_GET["z_Reference_No"];

		// Booking_ID
		$expenses->Booking_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Booking_ID"]);
		$expenses->Booking_ID->AdvancedSearch->SearchOperator = @$_GET["z_Booking_ID"];

		// Description
		$expenses->Description->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Description"]);
		$expenses->Description->AdvancedSearch->SearchOperator = @$_GET["z_Description"];

		// Amount
		$expenses->Amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Amount"]);
		$expenses->Amount->AdvancedSearch->SearchOperator = @$_GET["z_Amount"];

		// Vat
		$expenses->Vat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Vat"]);
		$expenses->Vat->AdvancedSearch->SearchOperator = @$_GET["z_Vat"];

		// Total_Sales
		$expenses->Total_Sales->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Sales"]);
		$expenses->Total_Sales->AdvancedSearch->SearchOperator = @$_GET["z_Total_Sales"];

		// Wtax
		$expenses->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Wtax"]);
		$expenses->Wtax->AdvancedSearch->SearchOperator = @$_GET["z_Wtax"];

		// Total_Amount_Due
		$expenses->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Amount_Due"]);
		$expenses->Total_Amount_Due->AdvancedSearch->SearchOperator = @$_GET["z_Total_Amount_Due"];

		// Expenses_Type_ID
		$expenses->Expenses_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Expenses_Type_ID"]);
		$expenses->Expenses_Type_ID->AdvancedSearch->SearchOperator = @$_GET["z_Expenses_Type_ID"];

		// Add_To_Billing
		$expenses->Add_To_Billing->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Add_To_Billing"]);
		$expenses->Add_To_Billing->AdvancedSearch->SearchOperator = @$_GET["z_Add_To_Billing"];

		// approver
		$expenses->approver->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_approver"]);
		$expenses->approver->AdvancedSearch->SearchOperator = @$_GET["z_approver"];

		// employee_id
		$expenses->employee_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_employee_id"]);
		$expenses->employee_id->AdvancedSearch->SearchOperator = @$_GET["z_employee_id"];

		// modified
		$expenses->modified->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_modified"]);
		$expenses->modified->AdvancedSearch->SearchOperator = @$_GET["z_modified"];

		// user_id
		$expenses->user_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_user_id"]);
		$expenses->user_id->AdvancedSearch->SearchOperator = @$_GET["z_user_id"];

		// payment_mode
		$expenses->payment_mode->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_mode"]);
		$expenses->payment_mode->AdvancedSearch->SearchOperator = @$_GET["z_payment_mode"];

		// status
		$expenses->status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_status"]);
		$expenses->status->AdvancedSearch->SearchOperator = @$_GET["z_status"];

		// Remarks
		$expenses->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$expenses->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expenses;

		// Call Recordset Selecting event
		$expenses->Recordset_Selecting($expenses->CurrentFilter);

		// Load List page SQL
		$sSql = $expenses->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expenses->Recordset_Selected($rs);
		return $rs;
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
		$this->ViewUrl = $expenses->ViewUrl();
		$this->EditUrl = $expenses->EditUrl();
		$this->InlineEditUrl = $expenses->InlineEditUrl();
		$this->CopyUrl = $expenses->CopyUrl();
		$this->InlineCopyUrl = $expenses->InlineCopyUrl();
		$this->DeleteUrl = $expenses->DeleteUrl();

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

		// Accumulate aggregate value
		if ($expenses->RowType <> EW_ROWTYPE_AGGREGATEINIT && $expenses->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($expenses->Amount->CurrentValue))
				$expenses->Amount->Total += $expenses->Amount->CurrentValue; // Accumulate total
			if (is_numeric($expenses->Vat->CurrentValue))
				$expenses->Vat->Total += $expenses->Vat->CurrentValue; // Accumulate total
			if (is_numeric($expenses->Total_Sales->CurrentValue))
				$expenses->Total_Sales->Total += $expenses->Total_Sales->CurrentValue; // Accumulate total
			if (is_numeric($expenses->Wtax->CurrentValue))
				$expenses->Wtax->Total += $expenses->Wtax->CurrentValue; // Accumulate total
			if (is_numeric($expenses->Total_Amount_Due->CurrentValue))
				$expenses->Total_Amount_Due->Total += $expenses->Total_Amount_Due->CurrentValue; // Accumulate total
		}
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
		} elseif ($expenses->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$expenses->Amount->Total = 0; // Initialize total
			$expenses->Vat->Total = 0; // Initialize total
			$expenses->Total_Sales->Total = 0; // Initialize total
			$expenses->Wtax->Total = 0; // Initialize total
			$expenses->Total_Amount_Due->Total = 0; // Initialize total
		} elseif ($expenses->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$expenses->Amount->CurrentValue = $expenses->Amount->Total;
			$expenses->Amount->ViewValue = $expenses->Amount->CurrentValue;
			$expenses->Amount->ViewValue = ew_FormatNumber($expenses->Amount->ViewValue, 2, -2, -2, -2);
			$expenses->Amount->CssStyle = "";
			$expenses->Amount->CssClass = "";
			$expenses->Amount->ViewCustomAttributes = "";
			$expenses->Amount->HrefValue = ""; // Clear href value
			$expenses->Vat->CurrentValue = $expenses->Vat->Total;
			$expenses->Vat->ViewValue = $expenses->Vat->CurrentValue;
			$expenses->Vat->ViewValue = ew_FormatNumber($expenses->Vat->ViewValue, 2, -2, -2, -2);
			$expenses->Vat->CssStyle = "";
			$expenses->Vat->CssClass = "";
			$expenses->Vat->ViewCustomAttributes = "";
			$expenses->Vat->HrefValue = ""; // Clear href value
			$expenses->Total_Sales->CurrentValue = $expenses->Total_Sales->Total;
			$expenses->Total_Sales->ViewValue = $expenses->Total_Sales->CurrentValue;
			$expenses->Total_Sales->ViewValue = ew_FormatNumber($expenses->Total_Sales->ViewValue, 2, -2, -2, -2);
			$expenses->Total_Sales->CssStyle = "";
			$expenses->Total_Sales->CssClass = "";
			$expenses->Total_Sales->ViewCustomAttributes = "";
			$expenses->Total_Sales->HrefValue = ""; // Clear href value
			$expenses->Wtax->CurrentValue = $expenses->Wtax->Total;
			$expenses->Wtax->ViewValue = $expenses->Wtax->CurrentValue;
			$expenses->Wtax->ViewValue = ew_FormatNumber($expenses->Wtax->ViewValue, 2, -2, -2, -2);
			$expenses->Wtax->CssStyle = "";
			$expenses->Wtax->CssClass = "";
			$expenses->Wtax->ViewCustomAttributes = "";
			$expenses->Wtax->HrefValue = ""; // Clear href value
			$expenses->Total_Amount_Due->CurrentValue = $expenses->Total_Amount_Due->Total;
			$expenses->Total_Amount_Due->ViewValue = $expenses->Total_Amount_Due->CurrentValue;
			$expenses->Total_Amount_Due->ViewValue = ew_FormatNumber($expenses->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$expenses->Total_Amount_Due->CssStyle = "";
			$expenses->Total_Amount_Due->CssClass = "";
			$expenses->Total_Amount_Due->ViewCustomAttributes = "";
			$expenses->Total_Amount_Due->HrefValue = ""; // Clear href value
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $expenses;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $expenses->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Initialize aggregates
		$expenses->RowType = EW_ROWTYPE_AGGREGATEINIT;
		$this->RenderRow();

		// Export all
		if ($expenses->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($expenses->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($expenses, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($expenses->id);
				$ExportDoc->ExportCaption($expenses->Date_Created);
				$ExportDoc->ExportCaption($expenses->expense_date);
				$ExportDoc->ExportCaption($expenses->expense_category_id);
				$ExportDoc->ExportCaption($expenses->Reference_No);
				$ExportDoc->ExportCaption($expenses->Booking_ID);
				$ExportDoc->ExportCaption($expenses->Amount);
				$ExportDoc->ExportCaption($expenses->Vat);
				$ExportDoc->ExportCaption($expenses->Total_Sales);
				$ExportDoc->ExportCaption($expenses->Wtax);
				$ExportDoc->ExportCaption($expenses->Total_Amount_Due);
				$ExportDoc->ExportCaption($expenses->File_Upload);
				$ExportDoc->ExportCaption($expenses->Expenses_Type_ID);
				$ExportDoc->ExportCaption($expenses->Add_To_Billing);
				$ExportDoc->ExportCaption($expenses->approver);
				$ExportDoc->ExportCaption($expenses->employee_id);
				$ExportDoc->ExportCaption($expenses->modified);
				$ExportDoc->ExportCaption($expenses->user_id);
				$ExportDoc->ExportCaption($expenses->payment_mode);
				$ExportDoc->ExportCaption($expenses->status);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$expenses->CssClass = "";
				$expenses->CssStyle = "";
				$expenses->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($expenses->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $expenses->id->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Date_Created', $expenses->Date_Created->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('expense_date', $expenses->expense_date->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('expense_category_id', $expenses->expense_category_id->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Reference_No', $expenses->Reference_No->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Booking_ID', $expenses->Booking_ID->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Amount', $expenses->Amount->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Vat', $expenses->Vat->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Total_Sales', $expenses->Total_Sales->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Wtax', $expenses->Wtax->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Total_Amount_Due', $expenses->Total_Amount_Due->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('File_Upload', $expenses->File_Upload->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Expenses_Type_ID', $expenses->Expenses_Type_ID->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('Add_To_Billing', $expenses->Add_To_Billing->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('approver', $expenses->approver->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('employee_id', $expenses->employee_id->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('modified', $expenses->modified->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('user_id', $expenses->user_id->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('payment_mode', $expenses->payment_mode->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
					$XmlDoc->AddField('status', $expenses->status->ExportValue($expenses->Export, $expenses->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($expenses->id);
					$ExportDoc->ExportField($expenses->Date_Created);
					$ExportDoc->ExportField($expenses->expense_date);
					$ExportDoc->ExportField($expenses->expense_category_id);
					$ExportDoc->ExportField($expenses->Reference_No);
					$ExportDoc->ExportField($expenses->Booking_ID);
					$ExportDoc->ExportField($expenses->Amount);
					$ExportDoc->ExportField($expenses->Vat);
					$ExportDoc->ExportField($expenses->Total_Sales);
					$ExportDoc->ExportField($expenses->Wtax);
					$ExportDoc->ExportField($expenses->Total_Amount_Due);
					$ExportDoc->ExportField($expenses->File_Upload);
					$ExportDoc->ExportField($expenses->Expenses_Type_ID);
					$ExportDoc->ExportField($expenses->Add_To_Billing);
					$ExportDoc->ExportField($expenses->approver);
					$ExportDoc->ExportField($expenses->employee_id);
					$ExportDoc->ExportField($expenses->modified);
					$ExportDoc->ExportField($expenses->user_id);
					$ExportDoc->ExportField($expenses->payment_mode);
					$ExportDoc->ExportField($expenses->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}

		// Export aggregates (non-XML and horizontal format only)
		if ($expenses->Export <> "xml" && $ExportDoc->Horizontal) {
			$expenses->RowType = EW_ROWTYPE_AGGREGATE;
			$this->RenderRow();
			$ExportDoc->BeginExportRow();
			$ExportDoc->ExportAggregate($expenses->id, '');
			$ExportDoc->ExportAggregate($expenses->Date_Created, '');
			$ExportDoc->ExportAggregate($expenses->expense_date, '');
			$ExportDoc->ExportAggregate($expenses->expense_category_id, '');
			$ExportDoc->ExportAggregate($expenses->Reference_No, '');
			$ExportDoc->ExportAggregate($expenses->Booking_ID, '');
			$ExportDoc->ExportAggregate($expenses->Amount, 'TOTAL');
			$ExportDoc->ExportAggregate($expenses->Vat, 'TOTAL');
			$ExportDoc->ExportAggregate($expenses->Total_Sales, 'TOTAL');
			$ExportDoc->ExportAggregate($expenses->Wtax, 'TOTAL');
			$ExportDoc->ExportAggregate($expenses->Total_Amount_Due, 'TOTAL');
			$ExportDoc->ExportAggregate($expenses->File_Upload, '');
			$ExportDoc->ExportAggregate($expenses->Expenses_Type_ID, '');
			$ExportDoc->ExportAggregate($expenses->Add_To_Billing, '');
			$ExportDoc->ExportAggregate($expenses->approver, '');
			$ExportDoc->ExportAggregate($expenses->employee_id, '');
			$ExportDoc->ExportAggregate($expenses->modified, '');
			$ExportDoc->ExportAggregate($expenses->user_id, '');
			$ExportDoc->ExportAggregate($expenses->payment_mode, '');
			$ExportDoc->ExportAggregate($expenses->status, '');
			$ExportDoc->EndExportRow();
		}
		if ($expenses->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($expenses->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($expenses->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($expenses->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($expenses->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
