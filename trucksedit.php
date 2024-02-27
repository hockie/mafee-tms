<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "trucksinfo.php" ?>
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
$trucks_edit = new ctrucks_edit();
$Page =& $trucks_edit;

// Page init
$trucks_edit->Page_Init();

// Page main
$trucks_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var trucks_edit = new ew_Page("trucks_edit");

// page properties
trucks_edit.PageID = "edit"; // page ID
trucks_edit.FormID = "ftrucksedit"; // form ID
var EW_PAGE_ID = trucks_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
trucks_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Sub_Con_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Sub_Con_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Model"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Model->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Brand"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Brand->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Truck_Types_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Truck_Types_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Plate_Number"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Plate_Number->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Series"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Series->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Truck_Body_Type"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Truck_Body_Type->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Gross_Weight"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Gross_Weight->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Gross_Weight"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($trucks->Gross_Weight->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Net_Capacity"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Net_Capacity->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Net_Capacity"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($trucks->Net_Capacity->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Inland_Marine_Insurance"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->Inland_Marine_Insurance->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Expiration_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($trucks->Expiration_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_LTFRB_Case_No"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($trucks->LTFRB_Case_No->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_LTFRB_Expiration"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($trucks->LTFRB_Expiration->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_File_Upload"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
trucks_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
trucks_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
trucks_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trucks_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $trucks->TableCaption() ?><br><br>
<a href="<?php echo $trucks->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$trucks_edit->ShowMessage();
?>
<form name="ftrucksedit" id="ftrucksedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return trucks_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="trucks">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($trucks->id->Visible) { // id ?>
	<tr<?php echo $trucks->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->id->FldCaption() ?></td>
		<td<?php echo $trucks->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $trucks->id->ViewAttributes() ?>><?php echo $trucks->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($trucks->id->CurrentValue) ?>">
</span><?php echo $trucks->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Sub_Con_ID->Visible) { // Sub_Con_ID ?>
	<tr<?php echo $trucks->Sub_Con_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Sub_Con_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Sub_Con_ID->CellAttributes() ?>><span id="el_Sub_Con_ID">
<?php if ($trucks->Sub_Con_ID->getSessionValue() <> "") { ?>
<div<?php echo $trucks->Sub_Con_ID->ViewAttributes() ?>><?php echo $trucks->Sub_Con_ID->ViewValue ?></div>
<input type="hidden" id="x_Sub_Con_ID" name="x_Sub_Con_ID" value="<?php echo ew_HtmlEncode($trucks->Sub_Con_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Sub_Con_ID" name="x_Sub_Con_ID" title="<?php echo $trucks->Sub_Con_ID->FldTitle() ?>"<?php echo $trucks->Sub_Con_ID->EditAttributes() ?>>
<?php
if (is_array($trucks->Sub_Con_ID->EditValue)) {
	$arwrk = $trucks->Sub_Con_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trucks->Sub_Con_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $trucks->Sub_Con_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Model->Visible) { // Model ?>
	<tr<?php echo $trucks->Model->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Model->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Model->CellAttributes() ?>><span id="el_Model">
<input type="text" name="x_Model" id="x_Model" title="<?php echo $trucks->Model->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->Model->EditValue ?>"<?php echo $trucks->Model->EditAttributes() ?>>
</span><?php echo $trucks->Model->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Brand->Visible) { // Brand ?>
	<tr<?php echo $trucks->Brand->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Brand->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Brand->CellAttributes() ?>><span id="el_Brand">
<input type="text" name="x_Brand" id="x_Brand" title="<?php echo $trucks->Brand->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->Brand->EditValue ?>"<?php echo $trucks->Brand->EditAttributes() ?>>
</span><?php echo $trucks->Brand->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Truck_Types_ID->Visible) { // Truck_Types_ID ?>
	<tr<?php echo $trucks->Truck_Types_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Truck_Types_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Truck_Types_ID->CellAttributes() ?>><span id="el_Truck_Types_ID">
<select id="x_Truck_Types_ID" name="x_Truck_Types_ID" title="<?php echo $trucks->Truck_Types_ID->FldTitle() ?>"<?php echo $trucks->Truck_Types_ID->EditAttributes() ?>>
<?php
if (is_array($trucks->Truck_Types_ID->EditValue)) {
	$arwrk = $trucks->Truck_Types_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trucks->Truck_Types_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $trucks->Truck_Types_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Plate_Number->Visible) { // Plate_Number ?>
	<tr<?php echo $trucks->Plate_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Plate_Number->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Plate_Number->CellAttributes() ?>><span id="el_Plate_Number">
<input type="text" name="x_Plate_Number" id="x_Plate_Number" title="<?php echo $trucks->Plate_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->Plate_Number->EditValue ?>"<?php echo $trucks->Plate_Number->EditAttributes() ?>>
</span><?php echo $trucks->Plate_Number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Series->Visible) { // Series ?>
	<tr<?php echo $trucks->Series->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Series->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Series->CellAttributes() ?>><span id="el_Series">
<input type="text" name="x_Series" id="x_Series" title="<?php echo $trucks->Series->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->Series->EditValue ?>"<?php echo $trucks->Series->EditAttributes() ?>>
</span><?php echo $trucks->Series->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Truck_Body_Type->Visible) { // Truck_Body_Type ?>
	<tr<?php echo $trucks->Truck_Body_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Truck_Body_Type->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Truck_Body_Type->CellAttributes() ?>><span id="el_Truck_Body_Type">
<input type="text" name="x_Truck_Body_Type" id="x_Truck_Body_Type" title="<?php echo $trucks->Truck_Body_Type->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->Truck_Body_Type->EditValue ?>"<?php echo $trucks->Truck_Body_Type->EditAttributes() ?>>
</span><?php echo $trucks->Truck_Body_Type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Gross_Weight->Visible) { // Gross_Weight ?>
	<tr<?php echo $trucks->Gross_Weight->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Gross_Weight->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Gross_Weight->CellAttributes() ?>><span id="el_Gross_Weight">
<input type="text" name="x_Gross_Weight" id="x_Gross_Weight" title="<?php echo $trucks->Gross_Weight->FldTitle() ?>" size="30" value="<?php echo $trucks->Gross_Weight->EditValue ?>"<?php echo $trucks->Gross_Weight->EditAttributes() ?>>
</span><?php echo $trucks->Gross_Weight->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Net_Capacity->Visible) { // Net_Capacity ?>
	<tr<?php echo $trucks->Net_Capacity->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Net_Capacity->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Net_Capacity->CellAttributes() ?>><span id="el_Net_Capacity">
<input type="text" name="x_Net_Capacity" id="x_Net_Capacity" title="<?php echo $trucks->Net_Capacity->FldTitle() ?>" size="30" value="<?php echo $trucks->Net_Capacity->EditValue ?>"<?php echo $trucks->Net_Capacity->EditAttributes() ?>>
</span><?php echo $trucks->Net_Capacity->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Inland_Marine_Insurance->Visible) { // Inland_Marine_Insurance ?>
	<tr<?php echo $trucks->Inland_Marine_Insurance->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Inland_Marine_Insurance->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->Inland_Marine_Insurance->CellAttributes() ?>><span id="el_Inland_Marine_Insurance">
<input type="text" name="x_Inland_Marine_Insurance" id="x_Inland_Marine_Insurance" title="<?php echo $trucks->Inland_Marine_Insurance->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->Inland_Marine_Insurance->EditValue ?>"<?php echo $trucks->Inland_Marine_Insurance->EditAttributes() ?>>
</span><?php echo $trucks->Inland_Marine_Insurance->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Expiration_Date->Visible) { // Expiration_Date ?>
	<tr<?php echo $trucks->Expiration_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Expiration_Date->FldCaption() ?></td>
		<td<?php echo $trucks->Expiration_Date->CellAttributes() ?>><span id="el_Expiration_Date">
<input type="text" name="x_Expiration_Date" id="x_Expiration_Date" title="<?php echo $trucks->Expiration_Date->FldTitle() ?>" value="<?php echo $trucks->Expiration_Date->EditValue ?>"<?php echo $trucks->Expiration_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Expiration_Date" name="cal_x_Expiration_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Expiration_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Expiration_Date" // button id
});
</script>
</span><?php echo $trucks->Expiration_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->LTFRB_Case_No->Visible) { // LTFRB_Case_No ?>
	<tr<?php echo $trucks->LTFRB_Case_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->LTFRB_Case_No->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $trucks->LTFRB_Case_No->CellAttributes() ?>><span id="el_LTFRB_Case_No">
<input type="text" name="x_LTFRB_Case_No" id="x_LTFRB_Case_No" title="<?php echo $trucks->LTFRB_Case_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->LTFRB_Case_No->EditValue ?>"<?php echo $trucks->LTFRB_Case_No->EditAttributes() ?>>
</span><?php echo $trucks->LTFRB_Case_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->LTFRB_Expiration->Visible) { // LTFRB_Expiration ?>
	<tr<?php echo $trucks->LTFRB_Expiration->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->LTFRB_Expiration->FldCaption() ?></td>
		<td<?php echo $trucks->LTFRB_Expiration->CellAttributes() ?>><span id="el_LTFRB_Expiration">
<input type="text" name="x_LTFRB_Expiration" id="x_LTFRB_Expiration" title="<?php echo $trucks->LTFRB_Expiration->FldTitle() ?>" value="<?php echo $trucks->LTFRB_Expiration->EditValue ?>"<?php echo $trucks->LTFRB_Expiration->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_LTFRB_Expiration" name="cal_x_LTFRB_Expiration" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_LTFRB_Expiration", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_LTFRB_Expiration" // button id
});
</script>
</span><?php echo $trucks->LTFRB_Expiration->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $trucks->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->File_Upload->FldCaption() ?></td>
		<td<?php echo $trucks->File_Upload->CellAttributes() ?>><span id="el_File_Upload">
<div id="old_x_File_Upload">
<?php if ($trucks->File_Upload->HrefValue <> "" || $trucks->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $trucks->File_Upload->HrefValue ?>"><?php echo $trucks->File_Upload->EditValue ?></a>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<?php echo $trucks->File_Upload->EditValue ?>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_File_Upload">
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_File_Upload" id="a_File_Upload" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $trucks->File_Upload->EditAttrs["onchange"] = "this.form.a_File_Upload[2].checked=true;" . @$trucks->File_Upload->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_File_Upload" id="a_File_Upload" value="3">
<?php } ?>
<input type="file" name="x_File_Upload" id="x_File_Upload" title="<?php echo $trucks->File_Upload->FldTitle() ?>" size="30"<?php echo $trucks->File_Upload->EditAttributes() ?>>
</div>
</span><?php echo $trucks->File_Upload->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($trucks->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $trucks->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $trucks->Remarks->FldCaption() ?></td>
		<td<?php echo $trucks->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $trucks->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $trucks->Remarks->EditAttributes() ?>><?php echo $trucks->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $trucks->Remarks->CustomMsg ?></td>
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
$trucks_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctrucks_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'trucks';

	// Page object name
	var $PageObjName = 'trucks_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trucks;
		if ($trucks->UseTokenInUrl) $PageUrl .= "t=" . $trucks->TableVar . "&"; // Add page token
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
		global $objForm, $trucks;
		if ($trucks->UseTokenInUrl) {
			if ($objForm)
				return ($trucks->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trucks->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctrucks_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (trucks)
		$GLOBALS["trucks"] = new ctrucks();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trucks', TRUE);

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
		global $trucks;

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
			$this->Page_Terminate("truckslist.php");
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
		global $objForm, $Language, $gsFormError, $trucks;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$trucks->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$trucks->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$trucks->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$trucks->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$trucks->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($trucks->id->CurrentValue == "")
			$this->Page_Terminate("truckslist.php"); // Invalid key, return to list
		switch ($trucks->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("truckslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$trucks->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $trucks->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$trucks->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$trucks->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $trucks;

		// Get upload data
			if ($trucks->File_Upload->Upload->UploadFile()) {

				// No action required
			} else {
				echo $trucks->File_Upload->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $trucks;
		$trucks->id->setFormValue($objForm->GetValue("x_id"));
		$trucks->Sub_Con_ID->setFormValue($objForm->GetValue("x_Sub_Con_ID"));
		$trucks->Model->setFormValue($objForm->GetValue("x_Model"));
		$trucks->Brand->setFormValue($objForm->GetValue("x_Brand"));
		$trucks->Truck_Types_ID->setFormValue($objForm->GetValue("x_Truck_Types_ID"));
		$trucks->Plate_Number->setFormValue($objForm->GetValue("x_Plate_Number"));
		$trucks->Series->setFormValue($objForm->GetValue("x_Series"));
		$trucks->Truck_Body_Type->setFormValue($objForm->GetValue("x_Truck_Body_Type"));
		$trucks->Gross_Weight->setFormValue($objForm->GetValue("x_Gross_Weight"));
		$trucks->Net_Capacity->setFormValue($objForm->GetValue("x_Net_Capacity"));
		$trucks->Inland_Marine_Insurance->setFormValue($objForm->GetValue("x_Inland_Marine_Insurance"));
		$trucks->Expiration_Date->setFormValue($objForm->GetValue("x_Expiration_Date"));
		$trucks->Expiration_Date->CurrentValue = ew_UnFormatDateTime($trucks->Expiration_Date->CurrentValue, 6);
		$trucks->LTFRB_Case_No->setFormValue($objForm->GetValue("x_LTFRB_Case_No"));
		$trucks->LTFRB_Expiration->setFormValue($objForm->GetValue("x_LTFRB_Expiration"));
		$trucks->LTFRB_Expiration->CurrentValue = ew_UnFormatDateTime($trucks->LTFRB_Expiration->CurrentValue, 6);
		$trucks->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $trucks;
		$this->LoadRow();
		$trucks->id->CurrentValue = $trucks->id->FormValue;
		$trucks->Sub_Con_ID->CurrentValue = $trucks->Sub_Con_ID->FormValue;
		$trucks->Model->CurrentValue = $trucks->Model->FormValue;
		$trucks->Brand->CurrentValue = $trucks->Brand->FormValue;
		$trucks->Truck_Types_ID->CurrentValue = $trucks->Truck_Types_ID->FormValue;
		$trucks->Plate_Number->CurrentValue = $trucks->Plate_Number->FormValue;
		$trucks->Series->CurrentValue = $trucks->Series->FormValue;
		$trucks->Truck_Body_Type->CurrentValue = $trucks->Truck_Body_Type->FormValue;
		$trucks->Gross_Weight->CurrentValue = $trucks->Gross_Weight->FormValue;
		$trucks->Net_Capacity->CurrentValue = $trucks->Net_Capacity->FormValue;
		$trucks->Inland_Marine_Insurance->CurrentValue = $trucks->Inland_Marine_Insurance->FormValue;
		$trucks->Expiration_Date->CurrentValue = $trucks->Expiration_Date->FormValue;
		$trucks->Expiration_Date->CurrentValue = ew_UnFormatDateTime($trucks->Expiration_Date->CurrentValue, 6);
		$trucks->LTFRB_Case_No->CurrentValue = $trucks->LTFRB_Case_No->FormValue;
		$trucks->LTFRB_Expiration->CurrentValue = $trucks->LTFRB_Expiration->FormValue;
		$trucks->LTFRB_Expiration->CurrentValue = ew_UnFormatDateTime($trucks->LTFRB_Expiration->CurrentValue, 6);
		$trucks->Remarks->CurrentValue = $trucks->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trucks;
		$sFilter = $trucks->KeyFilter();

		// Call Row Selecting event
		$trucks->Row_Selecting($sFilter);

		// Load SQL based on filter
		$trucks->CurrentFilter = $sFilter;
		$sSql = $trucks->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$trucks->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $trucks;
		$trucks->id->setDbValue($rs->fields('id'));
		$trucks->Sub_Con_ID->setDbValue($rs->fields('Sub_Con_ID'));
		$trucks->Model->setDbValue($rs->fields('Model'));
		$trucks->Brand->setDbValue($rs->fields('Brand'));
		$trucks->Truck_Types_ID->setDbValue($rs->fields('Truck_Types_ID'));
		$trucks->Plate_Number->setDbValue($rs->fields('Plate_Number'));
		$trucks->Series->setDbValue($rs->fields('Series'));
		$trucks->Truck_Body_Type->setDbValue($rs->fields('Truck_Body_Type'));
		$trucks->Gross_Weight->setDbValue($rs->fields('Gross_Weight'));
		$trucks->Net_Capacity->setDbValue($rs->fields('Net_Capacity'));
		$trucks->Inland_Marine_Insurance->setDbValue($rs->fields('Inland_Marine_Insurance'));
		$trucks->Expiration_Date->setDbValue($rs->fields('Expiration_Date'));
		$trucks->LTFRB_Case_No->setDbValue($rs->fields('LTFRB_Case_No'));
		$trucks->LTFRB_Expiration->setDbValue($rs->fields('LTFRB_Expiration'));
		$trucks->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$trucks->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $trucks;

		// Initialize URLs
		// Call Row_Rendering event

		$trucks->Row_Rendering();

		// Common render codes for all row types
		// id

		$trucks->id->CellCssStyle = ""; $trucks->id->CellCssClass = "";
		$trucks->id->CellAttrs = array(); $trucks->id->ViewAttrs = array(); $trucks->id->EditAttrs = array();

		// Sub_Con_ID
		$trucks->Sub_Con_ID->CellCssStyle = ""; $trucks->Sub_Con_ID->CellCssClass = "";
		$trucks->Sub_Con_ID->CellAttrs = array(); $trucks->Sub_Con_ID->ViewAttrs = array(); $trucks->Sub_Con_ID->EditAttrs = array();

		// Model
		$trucks->Model->CellCssStyle = ""; $trucks->Model->CellCssClass = "";
		$trucks->Model->CellAttrs = array(); $trucks->Model->ViewAttrs = array(); $trucks->Model->EditAttrs = array();

		// Brand
		$trucks->Brand->CellCssStyle = ""; $trucks->Brand->CellCssClass = "";
		$trucks->Brand->CellAttrs = array(); $trucks->Brand->ViewAttrs = array(); $trucks->Brand->EditAttrs = array();

		// Truck_Types_ID
		$trucks->Truck_Types_ID->CellCssStyle = ""; $trucks->Truck_Types_ID->CellCssClass = "";
		$trucks->Truck_Types_ID->CellAttrs = array(); $trucks->Truck_Types_ID->ViewAttrs = array(); $trucks->Truck_Types_ID->EditAttrs = array();

		// Plate_Number
		$trucks->Plate_Number->CellCssStyle = ""; $trucks->Plate_Number->CellCssClass = "";
		$trucks->Plate_Number->CellAttrs = array(); $trucks->Plate_Number->ViewAttrs = array(); $trucks->Plate_Number->EditAttrs = array();

		// Series
		$trucks->Series->CellCssStyle = ""; $trucks->Series->CellCssClass = "";
		$trucks->Series->CellAttrs = array(); $trucks->Series->ViewAttrs = array(); $trucks->Series->EditAttrs = array();

		// Truck_Body_Type
		$trucks->Truck_Body_Type->CellCssStyle = ""; $trucks->Truck_Body_Type->CellCssClass = "";
		$trucks->Truck_Body_Type->CellAttrs = array(); $trucks->Truck_Body_Type->ViewAttrs = array(); $trucks->Truck_Body_Type->EditAttrs = array();

		// Gross_Weight
		$trucks->Gross_Weight->CellCssStyle = ""; $trucks->Gross_Weight->CellCssClass = "";
		$trucks->Gross_Weight->CellAttrs = array(); $trucks->Gross_Weight->ViewAttrs = array(); $trucks->Gross_Weight->EditAttrs = array();

		// Net_Capacity
		$trucks->Net_Capacity->CellCssStyle = ""; $trucks->Net_Capacity->CellCssClass = "";
		$trucks->Net_Capacity->CellAttrs = array(); $trucks->Net_Capacity->ViewAttrs = array(); $trucks->Net_Capacity->EditAttrs = array();

		// Inland_Marine_Insurance
		$trucks->Inland_Marine_Insurance->CellCssStyle = ""; $trucks->Inland_Marine_Insurance->CellCssClass = "";
		$trucks->Inland_Marine_Insurance->CellAttrs = array(); $trucks->Inland_Marine_Insurance->ViewAttrs = array(); $trucks->Inland_Marine_Insurance->EditAttrs = array();

		// Expiration_Date
		$trucks->Expiration_Date->CellCssStyle = ""; $trucks->Expiration_Date->CellCssClass = "";
		$trucks->Expiration_Date->CellAttrs = array(); $trucks->Expiration_Date->ViewAttrs = array(); $trucks->Expiration_Date->EditAttrs = array();

		// LTFRB_Case_No
		$trucks->LTFRB_Case_No->CellCssStyle = ""; $trucks->LTFRB_Case_No->CellCssClass = "";
		$trucks->LTFRB_Case_No->CellAttrs = array(); $trucks->LTFRB_Case_No->ViewAttrs = array(); $trucks->LTFRB_Case_No->EditAttrs = array();

		// LTFRB_Expiration
		$trucks->LTFRB_Expiration->CellCssStyle = ""; $trucks->LTFRB_Expiration->CellCssClass = "";
		$trucks->LTFRB_Expiration->CellAttrs = array(); $trucks->LTFRB_Expiration->ViewAttrs = array(); $trucks->LTFRB_Expiration->EditAttrs = array();

		// File_Upload
		$trucks->File_Upload->CellCssStyle = ""; $trucks->File_Upload->CellCssClass = "";
		$trucks->File_Upload->CellAttrs = array(); $trucks->File_Upload->ViewAttrs = array(); $trucks->File_Upload->EditAttrs = array();

		// Remarks
		$trucks->Remarks->CellCssStyle = ""; $trucks->Remarks->CellCssClass = "";
		$trucks->Remarks->CellAttrs = array(); $trucks->Remarks->ViewAttrs = array(); $trucks->Remarks->EditAttrs = array();
		if ($trucks->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$trucks->id->ViewValue = $trucks->id->CurrentValue;
			$trucks->id->CssStyle = "";
			$trucks->id->CssClass = "";
			$trucks->id->ViewCustomAttributes = "";

			// Sub_Con_ID
			if (strval($trucks->Sub_Con_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Sub_Con_ID->CurrentValue) . "";
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
					$trucks->Sub_Con_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$trucks->Sub_Con_ID->ViewValue = $trucks->Sub_Con_ID->CurrentValue;
				}
			} else {
				$trucks->Sub_Con_ID->ViewValue = NULL;
			}
			$trucks->Sub_Con_ID->CssStyle = "";
			$trucks->Sub_Con_ID->CssClass = "";
			$trucks->Sub_Con_ID->ViewCustomAttributes = "";

			// Model
			$trucks->Model->ViewValue = $trucks->Model->CurrentValue;
			$trucks->Model->CssStyle = "";
			$trucks->Model->CssClass = "";
			$trucks->Model->ViewCustomAttributes = "";

			// Brand
			$trucks->Brand->ViewValue = $trucks->Brand->CurrentValue;
			$trucks->Brand->CssStyle = "";
			$trucks->Brand->CssClass = "";
			$trucks->Brand->ViewCustomAttributes = "";

			// Truck_Types_ID
			if (strval($trucks->Truck_Types_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Truck_Types_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Truck_Type` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$trucks->Truck_Types_ID->ViewValue = $rswrk->fields('Truck_Type');
					$rswrk->Close();
				} else {
					$trucks->Truck_Types_ID->ViewValue = $trucks->Truck_Types_ID->CurrentValue;
				}
			} else {
				$trucks->Truck_Types_ID->ViewValue = NULL;
			}
			$trucks->Truck_Types_ID->CssStyle = "";
			$trucks->Truck_Types_ID->CssClass = "";
			$trucks->Truck_Types_ID->ViewCustomAttributes = "";

			// Plate_Number
			$trucks->Plate_Number->ViewValue = $trucks->Plate_Number->CurrentValue;
			$trucks->Plate_Number->CssStyle = "";
			$trucks->Plate_Number->CssClass = "";
			$trucks->Plate_Number->ViewCustomAttributes = "";

			// Series
			$trucks->Series->ViewValue = $trucks->Series->CurrentValue;
			$trucks->Series->CssStyle = "";
			$trucks->Series->CssClass = "";
			$trucks->Series->ViewCustomAttributes = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->ViewValue = $trucks->Truck_Body_Type->CurrentValue;
			$trucks->Truck_Body_Type->CssStyle = "";
			$trucks->Truck_Body_Type->CssClass = "";
			$trucks->Truck_Body_Type->ViewCustomAttributes = "";

			// Gross_Weight
			$trucks->Gross_Weight->ViewValue = $trucks->Gross_Weight->CurrentValue;
			$trucks->Gross_Weight->ViewValue = ew_FormatNumber($trucks->Gross_Weight->ViewValue, 0, -2, -2, -2);
			$trucks->Gross_Weight->CssStyle = "";
			$trucks->Gross_Weight->CssClass = "";
			$trucks->Gross_Weight->ViewCustomAttributes = "";

			// Net_Capacity
			$trucks->Net_Capacity->ViewValue = $trucks->Net_Capacity->CurrentValue;
			$trucks->Net_Capacity->ViewValue = ew_FormatNumber($trucks->Net_Capacity->ViewValue, 0, -2, -2, -2);
			$trucks->Net_Capacity->CssStyle = "";
			$trucks->Net_Capacity->CssClass = "";
			$trucks->Net_Capacity->ViewCustomAttributes = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->ViewValue = $trucks->Inland_Marine_Insurance->CurrentValue;
			$trucks->Inland_Marine_Insurance->CssStyle = "";
			$trucks->Inland_Marine_Insurance->CssClass = "";
			$trucks->Inland_Marine_Insurance->ViewCustomAttributes = "";

			// Expiration_Date
			$trucks->Expiration_Date->ViewValue = $trucks->Expiration_Date->CurrentValue;
			$trucks->Expiration_Date->ViewValue = ew_FormatDateTime($trucks->Expiration_Date->ViewValue, 6);
			$trucks->Expiration_Date->CssStyle = "";
			$trucks->Expiration_Date->CssClass = "";
			$trucks->Expiration_Date->ViewCustomAttributes = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->ViewValue = $trucks->LTFRB_Case_No->CurrentValue;
			$trucks->LTFRB_Case_No->CssStyle = "";
			$trucks->LTFRB_Case_No->CssClass = "";
			$trucks->LTFRB_Case_No->ViewCustomAttributes = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->ViewValue = $trucks->LTFRB_Expiration->CurrentValue;
			$trucks->LTFRB_Expiration->ViewValue = ew_FormatDateTime($trucks->LTFRB_Expiration->ViewValue, 6);
			$trucks->LTFRB_Expiration->CssStyle = "";
			$trucks->LTFRB_Expiration->CssClass = "";
			$trucks->LTFRB_Expiration->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->ViewValue = $trucks->File_Upload->Upload->DbValue;
			} else {
				$trucks->File_Upload->ViewValue = "";
			}
			$trucks->File_Upload->CssStyle = "";
			$trucks->File_Upload->CssClass = "";
			$trucks->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$trucks->Remarks->ViewValue = $trucks->Remarks->CurrentValue;
			$trucks->Remarks->CssStyle = "";
			$trucks->Remarks->CssClass = "";
			$trucks->Remarks->ViewCustomAttributes = "";

			// id
			$trucks->id->HrefValue = "";
			$trucks->id->TooltipValue = "";

			// Sub_Con_ID
			$trucks->Sub_Con_ID->HrefValue = "";
			$trucks->Sub_Con_ID->TooltipValue = "";

			// Model
			$trucks->Model->HrefValue = "";
			$trucks->Model->TooltipValue = "";

			// Brand
			$trucks->Brand->HrefValue = "";
			$trucks->Brand->TooltipValue = "";

			// Truck_Types_ID
			$trucks->Truck_Types_ID->HrefValue = "";
			$trucks->Truck_Types_ID->TooltipValue = "";

			// Plate_Number
			$trucks->Plate_Number->HrefValue = "";
			$trucks->Plate_Number->TooltipValue = "";

			// Series
			$trucks->Series->HrefValue = "";
			$trucks->Series->TooltipValue = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->HrefValue = "";
			$trucks->Truck_Body_Type->TooltipValue = "";

			// Gross_Weight
			$trucks->Gross_Weight->HrefValue = "";
			$trucks->Gross_Weight->TooltipValue = "";

			// Net_Capacity
			$trucks->Net_Capacity->HrefValue = "";
			$trucks->Net_Capacity->TooltipValue = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->HrefValue = "";
			$trucks->Inland_Marine_Insurance->TooltipValue = "";

			// Expiration_Date
			$trucks->Expiration_Date->HrefValue = "";
			$trucks->Expiration_Date->TooltipValue = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->HrefValue = "";
			$trucks->LTFRB_Case_No->TooltipValue = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->HrefValue = "";
			$trucks->LTFRB_Expiration->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $trucks->File_Upload->UploadPath) . ((!empty($trucks->File_Upload->ViewValue)) ? $trucks->File_Upload->ViewValue : $trucks->File_Upload->CurrentValue);
				if ($trucks->Export <> "") $trucks->File_Upload->HrefValue = ew_ConvertFullUrl($trucks->File_Upload->HrefValue);
			} else {
				$trucks->File_Upload->HrefValue = "";
			}
			$trucks->File_Upload->TooltipValue = "";

			// Remarks
			$trucks->Remarks->HrefValue = "";
			$trucks->Remarks->TooltipValue = "";
		} elseif ($trucks->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$trucks->id->EditCustomAttributes = "";
			$trucks->id->EditValue = $trucks->id->CurrentValue;
			$trucks->id->CssStyle = "";
			$trucks->id->CssClass = "";
			$trucks->id->ViewCustomAttributes = "";

			// Sub_Con_ID
			$trucks->Sub_Con_ID->EditCustomAttributes = "";
			if ($trucks->Sub_Con_ID->getSessionValue() <> "") {
				$trucks->Sub_Con_ID->CurrentValue = $trucks->Sub_Con_ID->getSessionValue();
			if (strval($trucks->Sub_Con_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Sub_Con_ID->CurrentValue) . "";
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
					$trucks->Sub_Con_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$trucks->Sub_Con_ID->ViewValue = $trucks->Sub_Con_ID->CurrentValue;
				}
			} else {
				$trucks->Sub_Con_ID->ViewValue = NULL;
			}
			$trucks->Sub_Con_ID->CssStyle = "";
			$trucks->Sub_Con_ID->CssClass = "";
			$trucks->Sub_Con_ID->ViewCustomAttributes = "";
			} else {
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
			$trucks->Sub_Con_ID->EditValue = $arwrk;
			}

			// Model
			$trucks->Model->EditCustomAttributes = "";
			$trucks->Model->EditValue = ew_HtmlEncode($trucks->Model->CurrentValue);

			// Brand
			$trucks->Brand->EditCustomAttributes = "";
			$trucks->Brand->EditValue = ew_HtmlEncode($trucks->Brand->CurrentValue);

			// Truck_Types_ID
			$trucks->Truck_Types_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Truck_Type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Truck_Type` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$trucks->Truck_Types_ID->EditValue = $arwrk;

			// Plate_Number
			$trucks->Plate_Number->EditCustomAttributes = "";
			$trucks->Plate_Number->EditValue = ew_HtmlEncode($trucks->Plate_Number->CurrentValue);

			// Series
			$trucks->Series->EditCustomAttributes = "";
			$trucks->Series->EditValue = ew_HtmlEncode($trucks->Series->CurrentValue);

			// Truck_Body_Type
			$trucks->Truck_Body_Type->EditCustomAttributes = "";
			$trucks->Truck_Body_Type->EditValue = ew_HtmlEncode($trucks->Truck_Body_Type->CurrentValue);

			// Gross_Weight
			$trucks->Gross_Weight->EditCustomAttributes = "";
			$trucks->Gross_Weight->EditValue = ew_HtmlEncode($trucks->Gross_Weight->CurrentValue);

			// Net_Capacity
			$trucks->Net_Capacity->EditCustomAttributes = "";
			$trucks->Net_Capacity->EditValue = ew_HtmlEncode($trucks->Net_Capacity->CurrentValue);

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->EditCustomAttributes = "";
			$trucks->Inland_Marine_Insurance->EditValue = ew_HtmlEncode($trucks->Inland_Marine_Insurance->CurrentValue);

			// Expiration_Date
			$trucks->Expiration_Date->EditCustomAttributes = "";
			$trucks->Expiration_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($trucks->Expiration_Date->CurrentValue, 6));

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->EditCustomAttributes = "";
			$trucks->LTFRB_Case_No->EditValue = ew_HtmlEncode($trucks->LTFRB_Case_No->CurrentValue);

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->EditCustomAttributes = "";
			$trucks->LTFRB_Expiration->EditValue = ew_HtmlEncode(ew_FormatDateTime($trucks->LTFRB_Expiration->CurrentValue, 6));

			// File_Upload
			$trucks->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->EditValue = $trucks->File_Upload->Upload->DbValue;
			} else {
				$trucks->File_Upload->EditValue = "";
			}

			// Remarks
			$trucks->Remarks->EditCustomAttributes = "";
			$trucks->Remarks->EditValue = ew_HtmlEncode($trucks->Remarks->CurrentValue);

			// Edit refer script
			// id

			$trucks->id->HrefValue = "";

			// Sub_Con_ID
			$trucks->Sub_Con_ID->HrefValue = "";

			// Model
			$trucks->Model->HrefValue = "";

			// Brand
			$trucks->Brand->HrefValue = "";

			// Truck_Types_ID
			$trucks->Truck_Types_ID->HrefValue = "";

			// Plate_Number
			$trucks->Plate_Number->HrefValue = "";

			// Series
			$trucks->Series->HrefValue = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->HrefValue = "";

			// Gross_Weight
			$trucks->Gross_Weight->HrefValue = "";

			// Net_Capacity
			$trucks->Net_Capacity->HrefValue = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->HrefValue = "";

			// Expiration_Date
			$trucks->Expiration_Date->HrefValue = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->HrefValue = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->HrefValue = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $trucks->File_Upload->UploadPath) . ((!empty($trucks->File_Upload->EditValue)) ? $trucks->File_Upload->EditValue : $trucks->File_Upload->CurrentValue);
				if ($trucks->Export <> "") $trucks->File_Upload->HrefValue = ew_ConvertFullUrl($trucks->File_Upload->HrefValue);
			} else {
				$trucks->File_Upload->HrefValue = "";
			}

			// Remarks
			$trucks->Remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($trucks->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$trucks->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $trucks;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($trucks->File_Upload->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($trucks->File_Upload->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $trucks->File_Upload->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($trucks->Sub_Con_ID->FormValue) && $trucks->Sub_Con_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Sub_Con_ID->FldCaption();
		}
		if (!is_null($trucks->Model->FormValue) && $trucks->Model->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Model->FldCaption();
		}
		if (!is_null($trucks->Brand->FormValue) && $trucks->Brand->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Brand->FldCaption();
		}
		if (!is_null($trucks->Truck_Types_ID->FormValue) && $trucks->Truck_Types_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Truck_Types_ID->FldCaption();
		}
		if (!is_null($trucks->Plate_Number->FormValue) && $trucks->Plate_Number->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Plate_Number->FldCaption();
		}
		if (!is_null($trucks->Series->FormValue) && $trucks->Series->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Series->FldCaption();
		}
		if (!is_null($trucks->Truck_Body_Type->FormValue) && $trucks->Truck_Body_Type->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Truck_Body_Type->FldCaption();
		}
		if (!is_null($trucks->Gross_Weight->FormValue) && $trucks->Gross_Weight->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Gross_Weight->FldCaption();
		}
		if (!ew_CheckInteger($trucks->Gross_Weight->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $trucks->Gross_Weight->FldErrMsg();
		}
		if (!is_null($trucks->Net_Capacity->FormValue) && $trucks->Net_Capacity->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Net_Capacity->FldCaption();
		}
		if (!ew_CheckInteger($trucks->Net_Capacity->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $trucks->Net_Capacity->FldErrMsg();
		}
		if (!is_null($trucks->Inland_Marine_Insurance->FormValue) && $trucks->Inland_Marine_Insurance->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->Inland_Marine_Insurance->FldCaption();
		}
		if (!ew_CheckUSDate($trucks->Expiration_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $trucks->Expiration_Date->FldErrMsg();
		}
		if (!is_null($trucks->LTFRB_Case_No->FormValue) && $trucks->LTFRB_Case_No->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $trucks->LTFRB_Case_No->FldCaption();
		}
		if (!ew_CheckUSDate($trucks->LTFRB_Expiration->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $trucks->LTFRB_Expiration->FldErrMsg();
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
		global $conn, $Security, $Language, $trucks;
		$sFilter = $trucks->KeyFilter();
		$trucks->CurrentFilter = $sFilter;
		$sSql = $trucks->SQL();
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

			// Sub_Con_ID
			$trucks->Sub_Con_ID->SetDbValueDef($rsnew, $trucks->Sub_Con_ID->CurrentValue, NULL, FALSE);

			// Model
			$trucks->Model->SetDbValueDef($rsnew, $trucks->Model->CurrentValue, NULL, FALSE);

			// Brand
			$trucks->Brand->SetDbValueDef($rsnew, $trucks->Brand->CurrentValue, NULL, FALSE);

			// Truck_Types_ID
			$trucks->Truck_Types_ID->SetDbValueDef($rsnew, $trucks->Truck_Types_ID->CurrentValue, NULL, FALSE);

			// Plate_Number
			$trucks->Plate_Number->SetDbValueDef($rsnew, $trucks->Plate_Number->CurrentValue, NULL, FALSE);

			// Series
			$trucks->Series->SetDbValueDef($rsnew, $trucks->Series->CurrentValue, NULL, FALSE);

			// Truck_Body_Type
			$trucks->Truck_Body_Type->SetDbValueDef($rsnew, $trucks->Truck_Body_Type->CurrentValue, NULL, FALSE);

			// Gross_Weight
			$trucks->Gross_Weight->SetDbValueDef($rsnew, $trucks->Gross_Weight->CurrentValue, NULL, FALSE);

			// Net_Capacity
			$trucks->Net_Capacity->SetDbValueDef($rsnew, $trucks->Net_Capacity->CurrentValue, NULL, FALSE);

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->SetDbValueDef($rsnew, $trucks->Inland_Marine_Insurance->CurrentValue, NULL, FALSE);

			// Expiration_Date
			$trucks->Expiration_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($trucks->Expiration_Date->CurrentValue, 6, FALSE), NULL);

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->SetDbValueDef($rsnew, $trucks->LTFRB_Case_No->CurrentValue, NULL, FALSE);

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->SetDbValueDef($rsnew, ew_UnFormatDateTime($trucks->LTFRB_Expiration->CurrentValue, 6, FALSE), NULL);

			// File_Upload
			$trucks->File_Upload->Upload->SaveToSession(); // Save file value to Session
						if ($trucks->File_Upload->Upload->Action == "2" || $trucks->File_Upload->Upload->Action == "3") { // Update/Remove
			$trucks->File_Upload->Upload->DbValue = $rs->fields('File_Upload'); // Get original value
			if (is_null($trucks->File_Upload->Upload->Value)) {
				$rsnew['File_Upload'] = NULL;
			} else {
				$rsnew['File_Upload'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $trucks->File_Upload->UploadPath), $trucks->File_Upload->Upload->FileName);
			}
			}

			// Remarks
			$trucks->Remarks->SetDbValueDef($rsnew, $trucks->Remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $trucks->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($trucks->File_Upload->Upload->Value)) {
				$trucks->File_Upload->Upload->SaveToFile($trucks->File_Upload->UploadPath, $rsnew['File_Upload'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($trucks->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($trucks->CancelMessage <> "") {
					$this->setMessage($trucks->CancelMessage);
					$trucks->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$trucks->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// File_Upload
		$trucks->File_Upload->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $trucks;
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
				$this->sDbMasterFilter = $trucks->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $trucks->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$trucks->Sub_Con_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$trucks->Sub_Con_ID->setSessionValue($trucks->Sub_Con_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["subcons"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Sub_Con_ID@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$trucks->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$trucks->setStartRecordNumber($this->lStartRec);
			$trucks->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$trucks->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($trucks->Sub_Con_ID->QueryStringValue == "") $trucks->Sub_Con_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $trucks->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $trucks->getDetailFilter(); // Restore detail filter
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
