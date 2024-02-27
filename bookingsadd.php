<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "bookingsinfo.php" ?>
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
$bookings_add = new cbookings_add();
$Page =& $bookings_add;

// Page init
$bookings_add->Page_Init();

// Page main
$bookings_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var bookings_add = new ew_Page("bookings_add");

// page properties
bookings_add.PageID = "add"; // page ID
bookings_add.FormID = "fbookingsadd"; // form ID
var EW_PAGE_ID = bookings_add.PageID; // for backward compatibility

// extend page with ValidateForm function
bookings_add.ValidateForm = function(fobj) {
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
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Client_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Client_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Origin_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Origin_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Customer_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Customer_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Destination_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Destination_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Subcon_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Subcon_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Truck_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Truck_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ETD"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->ETD->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETA"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->ETA->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Truck_Driver_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Truck_Driver_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Unit_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Unit_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Quantity"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($bookings->Quantity->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Quantity"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Quantity->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
bookings_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
bookings_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
bookings_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
bookings_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $bookings->TableCaption() ?><br><br>
<a href="<?php echo $bookings->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$bookings_add->ShowMessage();
?>
<form name="fbookingsadd" id="fbookingsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return bookings_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="bookings">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($bookings->Date->Visible) { // Date ?>
	<tr<?php echo $bookings->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Date->FldCaption() ?></td>
		<td<?php echo $bookings->Date->CellAttributes() ?>><span id="el_Date">
<input type="text" name="x_Date" id="x_Date" title="<?php echo $bookings->Date->FldTitle() ?>" value="<?php echo $bookings->Date->EditValue ?>"<?php echo $bookings->Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date" name="cal_x_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date", // input field id
	showsTime: true, // show time
	ifFormat: "%m/%d/%Y %H:%M:%S", // date format
	button: "cal_x_Date" // button id
});
</script>
</span><?php echo $bookings->Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Client_ID->Visible) { // Client_ID ?>
	<tr<?php echo $bookings->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Client_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Client_ID->CellAttributes() ?>><span id="el_Client_ID">
<?php if ($bookings->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $bookings->Client_ID->ViewAttributes() ?>><?php echo $bookings->Client_ID->ViewValue ?></div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($bookings->Client_ID->CurrentValue) ?>">
<?php } else { ?>
<?php $bookings->Client_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Origin_ID','x_Client_ID',bookings_add.ar_x_Origin_ID);ew_UpdateOpt('x_Customer_ID','x_Client_ID',bookings_add.ar_x_Customer_ID);ew_UpdateOpt('x_Destination_ID','x_Client_ID',bookings_add.ar_x_Destination_ID); " . @$bookings->Client_ID->EditAttrs["onchange"]; ?>
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $bookings->Client_ID->FldTitle() ?>"<?php echo $bookings->Client_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Client_ID->EditValue)) {
	$arwrk = $bookings->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Client_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $bookings->Client_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Origin_ID->Visible) { // Origin_ID ?>
	<tr<?php echo $bookings->Origin_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Origin_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Origin_ID->CellAttributes() ?>><span id="el_Origin_ID">
<select id="x_Origin_ID" name="x_Origin_ID" title="<?php echo $bookings->Origin_ID->FldTitle() ?>"<?php echo $bookings->Origin_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Origin_ID->EditValue)) {
	$arwrk = $bookings->Origin_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Origin_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($bookings->Origin_ID->EditValue)) {
	$arwrk = $bookings->Origin_ID->EditValue;
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
bookings_add.ar_x_Origin_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $bookings->Origin_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Customer_ID->Visible) { // Customer_ID ?>
	<tr<?php echo $bookings->Customer_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Customer_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Customer_ID->CellAttributes() ?>><span id="el_Customer_ID">
<select id="x_Customer_ID" name="x_Customer_ID" title="<?php echo $bookings->Customer_ID->FldTitle() ?>"<?php echo $bookings->Customer_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Customer_ID->EditValue)) {
	$arwrk = $bookings->Customer_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Customer_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($bookings->Customer_ID->EditValue)) {
	$arwrk = $bookings->Customer_ID->EditValue;
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
bookings_add.ar_x_Customer_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $bookings->Customer_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Destination_ID->Visible) { // Destination_ID ?>
	<tr<?php echo $bookings->Destination_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Destination_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Destination_ID->CellAttributes() ?>><span id="el_Destination_ID">
<select id="x_Destination_ID" name="x_Destination_ID" title="<?php echo $bookings->Destination_ID->FldTitle() ?>"<?php echo $bookings->Destination_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Destination_ID->EditValue)) {
	$arwrk = $bookings->Destination_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Destination_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($bookings->Destination_ID->EditValue)) {
	$arwrk = $bookings->Destination_ID->EditValue;
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
bookings_add.ar_x_Destination_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $bookings->Destination_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Subcon_ID->Visible) { // Subcon_ID ?>
	<tr<?php echo $bookings->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Subcon_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Subcon_ID->CellAttributes() ?>><span id="el_Subcon_ID">
<?php $bookings->Subcon_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Truck_ID','x_Subcon_ID',bookings_add.ar_x_Truck_ID);ew_UpdateOpt('x_Truck_Driver_ID','x_Subcon_ID',bookings_add.ar_x_Truck_Driver_ID); " . @$bookings->Subcon_ID->EditAttrs["onchange"]; ?>
<select id="x_Subcon_ID" name="x_Subcon_ID" title="<?php echo $bookings->Subcon_ID->FldTitle() ?>"<?php echo $bookings->Subcon_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Subcon_ID->EditValue)) {
	$arwrk = $bookings->Subcon_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Subcon_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $bookings->Subcon_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Truck_ID->Visible) { // Truck_ID ?>
	<tr<?php echo $bookings->Truck_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Truck_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Truck_ID->CellAttributes() ?>><span id="el_Truck_ID">
<select id="x_Truck_ID" name="x_Truck_ID" title="<?php echo $bookings->Truck_ID->FldTitle() ?>"<?php echo $bookings->Truck_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Truck_ID->EditValue)) {
	$arwrk = $bookings->Truck_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Truck_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($bookings->Truck_ID->EditValue)) {
	$arwrk = $bookings->Truck_ID->EditValue;
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
bookings_add.ar_x_Truck_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $bookings->Truck_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->ETD->Visible) { // ETD ?>
	<tr<?php echo $bookings->ETD->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->ETD->FldCaption() ?></td>
		<td<?php echo $bookings->ETD->CellAttributes() ?>><span id="el_ETD">
<input type="text" name="x_ETD" id="x_ETD" title="<?php echo $bookings->ETD->FldTitle() ?>" value="<?php echo $bookings->ETD->EditValue ?>"<?php echo $bookings->ETD->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_ETD" name="cal_x_ETD" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_ETD", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_ETD" // button id
});
</script>
</span><?php echo $bookings->ETD->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->ETA->Visible) { // ETA ?>
	<tr<?php echo $bookings->ETA->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->ETA->FldCaption() ?></td>
		<td<?php echo $bookings->ETA->CellAttributes() ?>><span id="el_ETA">
<input type="text" name="x_ETA" id="x_ETA" title="<?php echo $bookings->ETA->FldTitle() ?>" value="<?php echo $bookings->ETA->EditValue ?>"<?php echo $bookings->ETA->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_ETA" name="cal_x_ETA" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_ETA", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_ETA" // button id
});
</script>
</span><?php echo $bookings->ETA->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Doc_Reference_Number->Visible) { // Doc_Reference_Number ?>
	<tr<?php echo $bookings->Doc_Reference_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Doc_Reference_Number->FldCaption() ?></td>
		<td<?php echo $bookings->Doc_Reference_Number->CellAttributes() ?>><span id="el_Doc_Reference_Number">
<textarea name="x_Doc_Reference_Number" id="x_Doc_Reference_Number" title="<?php echo $bookings->Doc_Reference_Number->FldTitle() ?>" cols="35" rows="4"<?php echo $bookings->Doc_Reference_Number->EditAttributes() ?>><?php echo $bookings->Doc_Reference_Number->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Doc_Reference_Number", function() {
	var oCKeditor = CKEDITOR.replace('x_Doc_Reference_Number', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $bookings->Doc_Reference_Number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Truck_Driver_ID->Visible) { // Truck_Driver_ID ?>
	<tr<?php echo $bookings->Truck_Driver_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Truck_Driver_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Truck_Driver_ID->CellAttributes() ?>><span id="el_Truck_Driver_ID">
<select id="x_Truck_Driver_ID" name="x_Truck_Driver_ID" title="<?php echo $bookings->Truck_Driver_ID->FldTitle() ?>"<?php echo $bookings->Truck_Driver_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Truck_Driver_ID->EditValue)) {
	$arwrk = $bookings->Truck_Driver_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Truck_Driver_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($bookings->Truck_Driver_ID->EditValue)) {
	$arwrk = $bookings->Truck_Driver_ID->EditValue;
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
bookings_add.ar_x_Truck_Driver_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $bookings->Truck_Driver_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Unit_ID->Visible) { // Unit_ID ?>
	<tr<?php echo $bookings->Unit_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Unit_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Unit_ID->CellAttributes() ?>><span id="el_Unit_ID">
<select id="x_Unit_ID" name="x_Unit_ID" title="<?php echo $bookings->Unit_ID->FldTitle() ?>"<?php echo $bookings->Unit_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Unit_ID->EditValue)) {
	$arwrk = $bookings->Unit_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Unit_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php if (AllowAdd("units")) { ?>
&nbsp;<a name="aol_x_Unit_ID" id="aol_x_Unit_ID" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:bookings_add,lnk:'aol_x_Unit_ID',el:'x_Unit_ID',hdr:this.innerHTML, url:'unitsaddopt.php',lf:'x_id',df:'x_Units',df2:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $bookings->Unit_ID->FldCaption() ?></a>
<?php } ?>
</span><?php echo $bookings->Unit_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Quantity->Visible) { // Quantity ?>
	<tr<?php echo $bookings->Quantity->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Quantity->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $bookings->Quantity->CellAttributes() ?>><span id="el_Quantity">
<input type="text" name="x_Quantity" id="x_Quantity" title="<?php echo $bookings->Quantity->FldTitle() ?>" size="30" value="<?php echo $bookings->Quantity->EditValue ?>"<?php echo $bookings->Quantity->EditAttributes() ?>>
</span><?php echo $bookings->Quantity->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($bookings->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $bookings->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Remarks->FldCaption() ?></td>
		<td<?php echo $bookings->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $bookings->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $bookings->Remarks->EditAttributes() ?>><?php echo $bookings->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $bookings->Remarks->CustomMsg ?></td>
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
ew_UpdateOpts([['x_Origin_ID','x_Client_ID',bookings_add.ar_x_Origin_ID],
['x_Customer_ID','x_Client_ID',bookings_add.ar_x_Customer_ID],
['x_Destination_ID','x_Client_ID',bookings_add.ar_x_Destination_ID],
['x_Truck_ID','x_Subcon_ID',bookings_add.ar_x_Truck_ID],
['x_Truck_Driver_ID','x_Subcon_ID',bookings_add.ar_x_Truck_Driver_ID]]);

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
$bookings_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cbookings_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'bookings';

	// Page object name
	var $PageObjName = 'bookings_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $bookings;
		if ($bookings->UseTokenInUrl) $PageUrl .= "t=" . $bookings->TableVar . "&"; // Add page token
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
		global $objForm, $bookings;
		if ($bookings->UseTokenInUrl) {
			if ($objForm)
				return ($bookings->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($bookings->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbookings_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (bookings)
		$GLOBALS["bookings"] = new cbookings();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'bookings', TRUE);

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
		global $bookings;

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
			$this->Page_Terminate("bookingslist.php");
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
		global $objForm, $Language, $gsFormError, $bookings;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $bookings->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $bookings->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$bookings->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $bookings->CurrentAction = "C"; // Copy record
		  } else {
		    $bookings->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($bookings->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("bookingslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$bookings->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $bookings->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$bookings->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $bookings;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $bookings;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $bookings;
		$bookings->Date->setFormValue($objForm->GetValue("x_Date"));
		$bookings->Date->CurrentValue = ew_UnFormatDateTime($bookings->Date->CurrentValue, 10);
		$bookings->Client_ID->setFormValue($objForm->GetValue("x_Client_ID"));
		$bookings->Origin_ID->setFormValue($objForm->GetValue("x_Origin_ID"));
		$bookings->Customer_ID->setFormValue($objForm->GetValue("x_Customer_ID"));
		$bookings->Destination_ID->setFormValue($objForm->GetValue("x_Destination_ID"));
		$bookings->Subcon_ID->setFormValue($objForm->GetValue("x_Subcon_ID"));
		$bookings->Truck_ID->setFormValue($objForm->GetValue("x_Truck_ID"));
		$bookings->ETD->setFormValue($objForm->GetValue("x_ETD"));
		$bookings->ETD->CurrentValue = ew_UnFormatDateTime($bookings->ETD->CurrentValue, 6);
		$bookings->ETA->setFormValue($objForm->GetValue("x_ETA"));
		$bookings->ETA->CurrentValue = ew_UnFormatDateTime($bookings->ETA->CurrentValue, 6);
		$bookings->Doc_Reference_Number->setFormValue($objForm->GetValue("x_Doc_Reference_Number"));
		$bookings->Truck_Driver_ID->setFormValue($objForm->GetValue("x_Truck_Driver_ID"));
		$bookings->Unit_ID->setFormValue($objForm->GetValue("x_Unit_ID"));
		$bookings->Quantity->setFormValue($objForm->GetValue("x_Quantity"));
		$bookings->Date_Updated->setFormValue($objForm->GetValue("x_Date_Updated"));
		$bookings->Date_Updated->CurrentValue = ew_UnFormatDateTime($bookings->Date_Updated->CurrentValue, 6);
		$bookings->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$bookings->User->setFormValue($objForm->GetValue("x_User"));
		$bookings->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $bookings;
		$bookings->id->CurrentValue = $bookings->id->FormValue;
		$bookings->Date->CurrentValue = $bookings->Date->FormValue;
		$bookings->Date->CurrentValue = ew_UnFormatDateTime($bookings->Date->CurrentValue, 10);
		$bookings->Client_ID->CurrentValue = $bookings->Client_ID->FormValue;
		$bookings->Origin_ID->CurrentValue = $bookings->Origin_ID->FormValue;
		$bookings->Customer_ID->CurrentValue = $bookings->Customer_ID->FormValue;
		$bookings->Destination_ID->CurrentValue = $bookings->Destination_ID->FormValue;
		$bookings->Subcon_ID->CurrentValue = $bookings->Subcon_ID->FormValue;
		$bookings->Truck_ID->CurrentValue = $bookings->Truck_ID->FormValue;
		$bookings->ETD->CurrentValue = $bookings->ETD->FormValue;
		$bookings->ETD->CurrentValue = ew_UnFormatDateTime($bookings->ETD->CurrentValue, 6);
		$bookings->ETA->CurrentValue = $bookings->ETA->FormValue;
		$bookings->ETA->CurrentValue = ew_UnFormatDateTime($bookings->ETA->CurrentValue, 6);
		$bookings->Doc_Reference_Number->CurrentValue = $bookings->Doc_Reference_Number->FormValue;
		$bookings->Truck_Driver_ID->CurrentValue = $bookings->Truck_Driver_ID->FormValue;
		$bookings->Unit_ID->CurrentValue = $bookings->Unit_ID->FormValue;
		$bookings->Quantity->CurrentValue = $bookings->Quantity->FormValue;
		$bookings->Date_Updated->CurrentValue = $bookings->Date_Updated->FormValue;
		$bookings->Date_Updated->CurrentValue = ew_UnFormatDateTime($bookings->Date_Updated->CurrentValue, 6);
		$bookings->Remarks->CurrentValue = $bookings->Remarks->FormValue;
		$bookings->User->CurrentValue = $bookings->User->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $bookings;
		$sFilter = $bookings->KeyFilter();

		// Call Row Selecting event
		$bookings->Row_Selecting($sFilter);

		// Load SQL based on filter
		$bookings->CurrentFilter = $sFilter;
		$sSql = $bookings->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$bookings->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $bookings;
		$bookings->id->setDbValue($rs->fields('id'));
		$bookings->Booking_Number->setDbValue($rs->fields('Booking_Number'));
		$bookings->Date->setDbValue($rs->fields('Date'));
		$bookings->Client_ID->setDbValue($rs->fields('Client_ID'));
		$bookings->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$bookings->Customer_ID->setDbValue($rs->fields('Customer_ID'));
		$bookings->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$bookings->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$bookings->Truck_ID->setDbValue($rs->fields('Truck_ID'));
		$bookings->ETD->setDbValue($rs->fields('ETD'));
		$bookings->ETA->setDbValue($rs->fields('ETA'));
		$bookings->Billing_Type_ID->setDbValue($rs->fields('Billing_Type_ID'));
		$bookings->Doc_Reference_Number->setDbValue($rs->fields('Doc_Reference_Number'));
		$bookings->Truck_Driver_ID->setDbValue($rs->fields('Truck_Driver_ID'));
		$bookings->Status_ID->setDbValue($rs->fields('Status_ID'));
		$bookings->Unit_ID->setDbValue($rs->fields('Unit_ID'));
		$bookings->Quantity->setDbValue($rs->fields('Quantity'));
		$bookings->Freight->setDbValue($rs->fields('Freight'));
		$bookings->Vat->setDbValue($rs->fields('Vat'));
		$bookings->Total_Sales->setDbValue($rs->fields('Total_Sales'));
		$bookings->Wtax->setDbValue($rs->fields('Wtax'));
		$bookings->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$bookings->Date_Delivered->setDbValue($rs->fields('Date_Delivered'));
		$bookings->Date_Updated->setDbValue($rs->fields('Date_Updated'));
		$bookings->Remarks->setDbValue($rs->fields('Remarks'));
		$bookings->User->setDbValue($rs->fields('User'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $bookings;

		// Initialize URLs
		// Call Row_Rendering event

		$bookings->Row_Rendering();

		// Common render codes for all row types
		// Date

		$bookings->Date->CellCssStyle = ""; $bookings->Date->CellCssClass = "";
		$bookings->Date->CellAttrs = array(); $bookings->Date->ViewAttrs = array(); $bookings->Date->EditAttrs = array();

		// Client_ID
		$bookings->Client_ID->CellCssStyle = ""; $bookings->Client_ID->CellCssClass = "";
		$bookings->Client_ID->CellAttrs = array(); $bookings->Client_ID->ViewAttrs = array(); $bookings->Client_ID->EditAttrs = array();

		// Origin_ID
		$bookings->Origin_ID->CellCssStyle = ""; $bookings->Origin_ID->CellCssClass = "";
		$bookings->Origin_ID->CellAttrs = array(); $bookings->Origin_ID->ViewAttrs = array(); $bookings->Origin_ID->EditAttrs = array();

		// Customer_ID
		$bookings->Customer_ID->CellCssStyle = ""; $bookings->Customer_ID->CellCssClass = "";
		$bookings->Customer_ID->CellAttrs = array(); $bookings->Customer_ID->ViewAttrs = array(); $bookings->Customer_ID->EditAttrs = array();

		// Destination_ID
		$bookings->Destination_ID->CellCssStyle = ""; $bookings->Destination_ID->CellCssClass = "";
		$bookings->Destination_ID->CellAttrs = array(); $bookings->Destination_ID->ViewAttrs = array(); $bookings->Destination_ID->EditAttrs = array();

		// Subcon_ID
		$bookings->Subcon_ID->CellCssStyle = ""; $bookings->Subcon_ID->CellCssClass = "";
		$bookings->Subcon_ID->CellAttrs = array(); $bookings->Subcon_ID->ViewAttrs = array(); $bookings->Subcon_ID->EditAttrs = array();

		// Truck_ID
		$bookings->Truck_ID->CellCssStyle = ""; $bookings->Truck_ID->CellCssClass = "";
		$bookings->Truck_ID->CellAttrs = array(); $bookings->Truck_ID->ViewAttrs = array(); $bookings->Truck_ID->EditAttrs = array();

		// ETD
		$bookings->ETD->CellCssStyle = ""; $bookings->ETD->CellCssClass = "";
		$bookings->ETD->CellAttrs = array(); $bookings->ETD->ViewAttrs = array(); $bookings->ETD->EditAttrs = array();

		// ETA
		$bookings->ETA->CellCssStyle = ""; $bookings->ETA->CellCssClass = "";
		$bookings->ETA->CellAttrs = array(); $bookings->ETA->ViewAttrs = array(); $bookings->ETA->EditAttrs = array();

		// Doc_Reference_Number
		$bookings->Doc_Reference_Number->CellCssStyle = ""; $bookings->Doc_Reference_Number->CellCssClass = "";
		$bookings->Doc_Reference_Number->CellAttrs = array(); $bookings->Doc_Reference_Number->ViewAttrs = array(); $bookings->Doc_Reference_Number->EditAttrs = array();

		// Truck_Driver_ID
		$bookings->Truck_Driver_ID->CellCssStyle = ""; $bookings->Truck_Driver_ID->CellCssClass = "";
		$bookings->Truck_Driver_ID->CellAttrs = array(); $bookings->Truck_Driver_ID->ViewAttrs = array(); $bookings->Truck_Driver_ID->EditAttrs = array();

		// Unit_ID
		$bookings->Unit_ID->CellCssStyle = ""; $bookings->Unit_ID->CellCssClass = "";
		$bookings->Unit_ID->CellAttrs = array(); $bookings->Unit_ID->ViewAttrs = array(); $bookings->Unit_ID->EditAttrs = array();

		// Quantity
		$bookings->Quantity->CellCssStyle = ""; $bookings->Quantity->CellCssClass = "";
		$bookings->Quantity->CellAttrs = array(); $bookings->Quantity->ViewAttrs = array(); $bookings->Quantity->EditAttrs = array();

		// Date_Updated
		$bookings->Date_Updated->CellCssStyle = ""; $bookings->Date_Updated->CellCssClass = "";
		$bookings->Date_Updated->CellAttrs = array(); $bookings->Date_Updated->ViewAttrs = array(); $bookings->Date_Updated->EditAttrs = array();

		// Remarks
		$bookings->Remarks->CellCssStyle = ""; $bookings->Remarks->CellCssClass = "";
		$bookings->Remarks->CellAttrs = array(); $bookings->Remarks->ViewAttrs = array(); $bookings->Remarks->EditAttrs = array();

		// User
		$bookings->User->CellCssStyle = ""; $bookings->User->CellCssClass = "";
		$bookings->User->CellAttrs = array(); $bookings->User->ViewAttrs = array(); $bookings->User->EditAttrs = array();
		if ($bookings->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$bookings->id->ViewValue = $bookings->id->CurrentValue;
			$bookings->id->CssStyle = "";
			$bookings->id->CssClass = "";
			$bookings->id->ViewCustomAttributes = "";

			// Booking_Number
			$bookings->Booking_Number->ViewValue = $bookings->Booking_Number->CurrentValue;
			$bookings->Booking_Number->CssStyle = "";
			$bookings->Booking_Number->CssClass = "";
			$bookings->Booking_Number->ViewCustomAttributes = "";

			// Date
			$bookings->Date->ViewValue = $bookings->Date->CurrentValue;
			$bookings->Date->ViewValue = ew_FormatDateTime($bookings->Date->ViewValue, 10);
			$bookings->Date->CssStyle = "";
			$bookings->Date->CssClass = "";
			$bookings->Date->ViewCustomAttributes = "";

			// Client_ID
			if (strval($bookings->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Client_ID->CurrentValue) . "";
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
					$bookings->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$bookings->Client_ID->ViewValue = $bookings->Client_ID->CurrentValue;
				}
			} else {
				$bookings->Client_ID->ViewValue = NULL;
			}
			$bookings->Client_ID->CssStyle = "";
			$bookings->Client_ID->CssClass = "";
			$bookings->Client_ID->ViewCustomAttributes = "";

			// Origin_ID
			if (strval($bookings->Origin_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Origin_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Origin` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Origin` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Origin_ID->ViewValue = $rswrk->fields('Origin');
					$rswrk->Close();
				} else {
					$bookings->Origin_ID->ViewValue = $bookings->Origin_ID->CurrentValue;
				}
			} else {
				$bookings->Origin_ID->ViewValue = NULL;
			}
			$bookings->Origin_ID->CssStyle = "";
			$bookings->Origin_ID->CssClass = "";
			$bookings->Origin_ID->ViewCustomAttributes = "";

			// Customer_ID
			if (strval($bookings->Customer_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Customer_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Customer_Name` FROM `consignees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Customer_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Customer_ID->ViewValue = $rswrk->fields('Customer_Name');
					$rswrk->Close();
				} else {
					$bookings->Customer_ID->ViewValue = $bookings->Customer_ID->CurrentValue;
				}
			} else {
				$bookings->Customer_ID->ViewValue = NULL;
			}
			$bookings->Customer_ID->CssStyle = "";
			$bookings->Customer_ID->CssClass = "";
			$bookings->Customer_ID->ViewCustomAttributes = "";

			// Destination_ID
			if (strval($bookings->Destination_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Destination_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Destination` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Destination_ID->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$bookings->Destination_ID->ViewValue = $bookings->Destination_ID->CurrentValue;
				}
			} else {
				$bookings->Destination_ID->ViewValue = NULL;
			}
			$bookings->Destination_ID->CssStyle = "";
			$bookings->Destination_ID->CssClass = "";
			$bookings->Destination_ID->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($bookings->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$bookings->Subcon_ID->ViewValue = $bookings->Subcon_ID->CurrentValue;
				}
			} else {
				$bookings->Subcon_ID->ViewValue = NULL;
			}
			$bookings->Subcon_ID->CssStyle = "";
			$bookings->Subcon_ID->CssClass = "";
			$bookings->Subcon_ID->ViewCustomAttributes = "";

			// Truck_ID
			if (strval($bookings->Truck_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Truck_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Plate_Number` FROM `trucks`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Plate_Number` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Truck_ID->ViewValue = $rswrk->fields('Plate_Number');
					$rswrk->Close();
				} else {
					$bookings->Truck_ID->ViewValue = $bookings->Truck_ID->CurrentValue;
				}
			} else {
				$bookings->Truck_ID->ViewValue = NULL;
			}
			$bookings->Truck_ID->CssStyle = "";
			$bookings->Truck_ID->CssClass = "";
			$bookings->Truck_ID->ViewCustomAttributes = "";

			// ETD
			$bookings->ETD->ViewValue = $bookings->ETD->CurrentValue;
			$bookings->ETD->ViewValue = ew_FormatDateTime($bookings->ETD->ViewValue, 6);
			$bookings->ETD->CssStyle = "";
			$bookings->ETD->CssClass = "";
			$bookings->ETD->ViewCustomAttributes = "";

			// ETA
			$bookings->ETA->ViewValue = $bookings->ETA->CurrentValue;
			$bookings->ETA->ViewValue = ew_FormatDateTime($bookings->ETA->ViewValue, 6);
			$bookings->ETA->CssStyle = "";
			$bookings->ETA->CssClass = "";
			$bookings->ETA->ViewCustomAttributes = "";

			// Billing_Type_ID
			if (strval($bookings->Billing_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Billing_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Billing_Types` FROM `billing_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Billing_Type_ID->ViewValue = $rswrk->fields('Billing_Types');
					$rswrk->Close();
				} else {
					$bookings->Billing_Type_ID->ViewValue = $bookings->Billing_Type_ID->CurrentValue;
				}
			} else {
				$bookings->Billing_Type_ID->ViewValue = NULL;
			}
			$bookings->Billing_Type_ID->CssStyle = "";
			$bookings->Billing_Type_ID->CssClass = "";
			$bookings->Billing_Type_ID->ViewCustomAttributes = "";

			// Doc_Reference_Number
			$bookings->Doc_Reference_Number->ViewValue = $bookings->Doc_Reference_Number->CurrentValue;
			$bookings->Doc_Reference_Number->CssStyle = "";
			$bookings->Doc_Reference_Number->CssClass = "";
			$bookings->Doc_Reference_Number->ViewCustomAttributes = "";

			// Truck_Driver_ID
			if (strval($bookings->Truck_Driver_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Truck_Driver_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Driver` FROM `truck_drivers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Truck_Driver` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Truck_Driver_ID->ViewValue = $rswrk->fields('Truck_Driver');
					$rswrk->Close();
				} else {
					$bookings->Truck_Driver_ID->ViewValue = $bookings->Truck_Driver_ID->CurrentValue;
				}
			} else {
				$bookings->Truck_Driver_ID->ViewValue = NULL;
			}
			$bookings->Truck_Driver_ID->CssStyle = "";
			$bookings->Truck_Driver_ID->CssClass = "";
			$bookings->Truck_Driver_ID->ViewCustomAttributes = "";

			// Status_ID
			if (strval($bookings->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$bookings->Status_ID->ViewValue = $bookings->Status_ID->CurrentValue;
				}
			} else {
				$bookings->Status_ID->ViewValue = NULL;
			}
			$bookings->Status_ID->CssStyle = "";
			$bookings->Status_ID->CssClass = "";
			$bookings->Status_ID->ViewCustomAttributes = "";

			// Unit_ID
			if (strval($bookings->Unit_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Unit_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Units` FROM `units`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->Unit_ID->ViewValue = $rswrk->fields('Units');
					$rswrk->Close();
				} else {
					$bookings->Unit_ID->ViewValue = $bookings->Unit_ID->CurrentValue;
				}
			} else {
				$bookings->Unit_ID->ViewValue = NULL;
			}
			$bookings->Unit_ID->CssStyle = "";
			$bookings->Unit_ID->CssClass = "";
			$bookings->Unit_ID->ViewCustomAttributes = "";

			// Quantity
			$bookings->Quantity->ViewValue = $bookings->Quantity->CurrentValue;
			$bookings->Quantity->ViewValue = ew_FormatNumber($bookings->Quantity->ViewValue, 2, -2, -2, -2);
			$bookings->Quantity->CssStyle = "";
			$bookings->Quantity->CssClass = "";
			$bookings->Quantity->ViewCustomAttributes = "";

			// Freight
			$bookings->Freight->ViewValue = $bookings->Freight->CurrentValue;
			$bookings->Freight->ViewValue = ew_FormatNumber($bookings->Freight->ViewValue, 2, -2, -2, -2);
			$bookings->Freight->CssStyle = "";
			$bookings->Freight->CssClass = "";
			$bookings->Freight->ViewCustomAttributes = "";

			// Vat
			$bookings->Vat->ViewValue = $bookings->Vat->CurrentValue;
			$bookings->Vat->ViewValue = ew_FormatNumber($bookings->Vat->ViewValue, 2, -2, -2, -2);
			$bookings->Vat->CssStyle = "";
			$bookings->Vat->CssClass = "";
			$bookings->Vat->ViewCustomAttributes = "";

			// Total_Sales
			$bookings->Total_Sales->ViewValue = $bookings->Total_Sales->CurrentValue;
			$bookings->Total_Sales->ViewValue = ew_FormatNumber($bookings->Total_Sales->ViewValue, 2, -2, -2, -2);
			$bookings->Total_Sales->CssStyle = "";
			$bookings->Total_Sales->CssClass = "";
			$bookings->Total_Sales->ViewCustomAttributes = "";

			// Wtax
			$bookings->Wtax->ViewValue = $bookings->Wtax->CurrentValue;
			$bookings->Wtax->ViewValue = ew_FormatNumber($bookings->Wtax->ViewValue, 2, -2, -2, -2);
			$bookings->Wtax->CssStyle = "";
			$bookings->Wtax->CssClass = "";
			$bookings->Wtax->ViewCustomAttributes = "";

			// Total_Amount_Due
			$bookings->Total_Amount_Due->ViewValue = $bookings->Total_Amount_Due->CurrentValue;
			$bookings->Total_Amount_Due->ViewValue = ew_FormatNumber($bookings->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$bookings->Total_Amount_Due->CssStyle = "";
			$bookings->Total_Amount_Due->CssClass = "";
			$bookings->Total_Amount_Due->ViewCustomAttributes = "";

			// Date_Delivered
			$bookings->Date_Delivered->ViewValue = $bookings->Date_Delivered->CurrentValue;
			$bookings->Date_Delivered->ViewValue = ew_FormatDateTime($bookings->Date_Delivered->ViewValue, 10);
			$bookings->Date_Delivered->CssStyle = "";
			$bookings->Date_Delivered->CssClass = "";
			$bookings->Date_Delivered->ViewCustomAttributes = "";

			// Date_Updated
			$bookings->Date_Updated->ViewValue = $bookings->Date_Updated->CurrentValue;
			$bookings->Date_Updated->ViewValue = ew_FormatDateTime($bookings->Date_Updated->ViewValue, 6);
			$bookings->Date_Updated->CssStyle = "";
			$bookings->Date_Updated->CssClass = "";
			$bookings->Date_Updated->ViewCustomAttributes = "";

			// Remarks
			$bookings->Remarks->ViewValue = $bookings->Remarks->CurrentValue;
			$bookings->Remarks->CssStyle = "";
			$bookings->Remarks->CssClass = "";
			$bookings->Remarks->ViewCustomAttributes = "";

			// User
			if (strval($bookings->User->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->User->CurrentValue) . "";
			$sSqlWrk = "SELECT `username` FROM `users`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$bookings->User->ViewValue = $rswrk->fields('username');
					$rswrk->Close();
				} else {
					$bookings->User->ViewValue = $bookings->User->CurrentValue;
				}
			} else {
				$bookings->User->ViewValue = NULL;
			}
			$bookings->User->CssStyle = "";
			$bookings->User->CssClass = "";
			$bookings->User->ViewCustomAttributes = "";

			// Date
			$bookings->Date->HrefValue = "";
			$bookings->Date->TooltipValue = "";

			// Client_ID
			$bookings->Client_ID->HrefValue = "";
			$bookings->Client_ID->TooltipValue = "";

			// Origin_ID
			$bookings->Origin_ID->HrefValue = "";
			$bookings->Origin_ID->TooltipValue = "";

			// Customer_ID
			$bookings->Customer_ID->HrefValue = "";
			$bookings->Customer_ID->TooltipValue = "";

			// Destination_ID
			$bookings->Destination_ID->HrefValue = "";
			$bookings->Destination_ID->TooltipValue = "";

			// Subcon_ID
			$bookings->Subcon_ID->HrefValue = "";
			$bookings->Subcon_ID->TooltipValue = "";

			// Truck_ID
			$bookings->Truck_ID->HrefValue = "";
			$bookings->Truck_ID->TooltipValue = "";

			// ETD
			$bookings->ETD->HrefValue = "";
			$bookings->ETD->TooltipValue = "";

			// ETA
			$bookings->ETA->HrefValue = "";
			$bookings->ETA->TooltipValue = "";

			// Doc_Reference_Number
			$bookings->Doc_Reference_Number->HrefValue = "";
			$bookings->Doc_Reference_Number->TooltipValue = "";

			// Truck_Driver_ID
			$bookings->Truck_Driver_ID->HrefValue = "";
			$bookings->Truck_Driver_ID->TooltipValue = "";

			// Unit_ID
			$bookings->Unit_ID->HrefValue = "";
			$bookings->Unit_ID->TooltipValue = "";

			// Quantity
			$bookings->Quantity->HrefValue = "";
			$bookings->Quantity->TooltipValue = "";

			// Date_Updated
			$bookings->Date_Updated->HrefValue = "";
			$bookings->Date_Updated->TooltipValue = "";

			// Remarks
			$bookings->Remarks->HrefValue = "";
			$bookings->Remarks->TooltipValue = "";

			// User
			$bookings->User->HrefValue = "";
			$bookings->User->TooltipValue = "";
		} elseif ($bookings->RowType == EW_ROWTYPE_ADD) { // Add row

			// Date
			$bookings->Date->EditCustomAttributes = "";
			$bookings->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($bookings->Date->CurrentValue, 10));

			// Client_ID
			$bookings->Client_ID->EditCustomAttributes = "";
			if ($bookings->Client_ID->getSessionValue() <> "") {
				$bookings->Client_ID->CurrentValue = $bookings->Client_ID->getSessionValue();
			if (strval($bookings->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($bookings->Client_ID->CurrentValue) . "";
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
					$bookings->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$bookings->Client_ID->ViewValue = $bookings->Client_ID->CurrentValue;
				}
			} else {
				$bookings->Client_ID->ViewValue = NULL;
			}
			$bookings->Client_ID->CssStyle = "";
			$bookings->Client_ID->CssClass = "";
			$bookings->Client_ID->ViewCustomAttributes = "";
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
			$bookings->Client_ID->EditValue = $arwrk;
			}

			// Origin_ID
			$bookings->Origin_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Origin`, '' AS Disp2Fld, `Client` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Origin` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$bookings->Origin_ID->EditValue = $arwrk;

			// Customer_ID
			$bookings->Customer_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Customer_Name`, '' AS Disp2Fld, `client_id` FROM `consignees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Customer_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$bookings->Customer_ID->EditValue = $arwrk;

			// Destination_ID
			$bookings->Destination_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Destination`, '' AS Disp2Fld, `Client` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Destination` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$bookings->Destination_ID->EditValue = $arwrk;

			// Subcon_ID
			$bookings->Subcon_ID->EditCustomAttributes = "";
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
			$bookings->Subcon_ID->EditValue = $arwrk;

			// Truck_ID
			$bookings->Truck_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Plate_Number`, '' AS Disp2Fld, `Sub_Con_ID` FROM `trucks`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Plate_Number` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$bookings->Truck_ID->EditValue = $arwrk;

			// ETD
			$bookings->ETD->EditCustomAttributes = "";
			$bookings->ETD->EditValue = ew_HtmlEncode(ew_FormatDateTime($bookings->ETD->CurrentValue, 6));

			// ETA
			$bookings->ETA->EditCustomAttributes = "";
			$bookings->ETA->EditValue = ew_HtmlEncode(ew_FormatDateTime($bookings->ETA->CurrentValue, 6));

			// Doc_Reference_Number
			$bookings->Doc_Reference_Number->EditCustomAttributes = "";
			$bookings->Doc_Reference_Number->EditValue = ew_HtmlEncode($bookings->Doc_Reference_Number->CurrentValue);

			// Truck_Driver_ID
			$bookings->Truck_Driver_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Truck_Driver`, '' AS Disp2Fld, `Subcon_ID` FROM `truck_drivers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Truck_Driver` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$bookings->Truck_Driver_ID->EditValue = $arwrk;

			// Unit_ID
			$bookings->Unit_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Units`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `units`";
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
			$bookings->Unit_ID->EditValue = $arwrk;

			// Quantity
			$bookings->Quantity->EditCustomAttributes = "";
			$bookings->Quantity->EditValue = ew_HtmlEncode($bookings->Quantity->CurrentValue);

			// Date_Updated
			// Remarks

			$bookings->Remarks->EditCustomAttributes = "";
			$bookings->Remarks->EditValue = ew_HtmlEncode($bookings->Remarks->CurrentValue);

			// User
		}

		// Call Row Rendered event
		if ($bookings->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$bookings->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $bookings;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckUSDate($bookings->Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $bookings->Date->FldErrMsg();
		}
		if (!is_null($bookings->Client_ID->FormValue) && $bookings->Client_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Client_ID->FldCaption();
		}
		if (!is_null($bookings->Origin_ID->FormValue) && $bookings->Origin_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Origin_ID->FldCaption();
		}
		if (!is_null($bookings->Customer_ID->FormValue) && $bookings->Customer_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Customer_ID->FldCaption();
		}
		if (!is_null($bookings->Destination_ID->FormValue) && $bookings->Destination_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Destination_ID->FldCaption();
		}
		if (!is_null($bookings->Subcon_ID->FormValue) && $bookings->Subcon_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Subcon_ID->FldCaption();
		}
		if (!is_null($bookings->Truck_ID->FormValue) && $bookings->Truck_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Truck_ID->FldCaption();
		}
		if (!ew_CheckUSDate($bookings->ETD->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $bookings->ETD->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->ETA->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $bookings->ETA->FldErrMsg();
		}
		if (!is_null($bookings->Truck_Driver_ID->FormValue) && $bookings->Truck_Driver_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Truck_Driver_ID->FldCaption();
		}
		if (!is_null($bookings->Unit_ID->FormValue) && $bookings->Unit_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Unit_ID->FldCaption();
		}
		if (!is_null($bookings->Quantity->FormValue) && $bookings->Quantity->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $bookings->Quantity->FldCaption();
		}
		if (!ew_CheckNumber($bookings->Quantity->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $bookings->Quantity->FldErrMsg();
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
		global $conn, $Language, $Security, $bookings;
		$rsnew = array();

		// Date
		$bookings->Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($bookings->Date->CurrentValue, 10, FALSE), NULL);

		// Client_ID
		$bookings->Client_ID->SetDbValueDef($rsnew, $bookings->Client_ID->CurrentValue, NULL, FALSE);

		// Origin_ID
		$bookings->Origin_ID->SetDbValueDef($rsnew, $bookings->Origin_ID->CurrentValue, NULL, FALSE);

		// Customer_ID
		$bookings->Customer_ID->SetDbValueDef($rsnew, $bookings->Customer_ID->CurrentValue, NULL, FALSE);

		// Destination_ID
		$bookings->Destination_ID->SetDbValueDef($rsnew, $bookings->Destination_ID->CurrentValue, NULL, FALSE);

		// Subcon_ID
		$bookings->Subcon_ID->SetDbValueDef($rsnew, $bookings->Subcon_ID->CurrentValue, NULL, FALSE);

		// Truck_ID
		$bookings->Truck_ID->SetDbValueDef($rsnew, $bookings->Truck_ID->CurrentValue, NULL, FALSE);

		// ETD
		$bookings->ETD->SetDbValueDef($rsnew, ew_UnFormatDateTime($bookings->ETD->CurrentValue, 6, FALSE), NULL);

		// ETA
		$bookings->ETA->SetDbValueDef($rsnew, ew_UnFormatDateTime($bookings->ETA->CurrentValue, 6, FALSE), NULL);

		// Doc_Reference_Number
		$bookings->Doc_Reference_Number->SetDbValueDef($rsnew, $bookings->Doc_Reference_Number->CurrentValue, NULL, FALSE);

		// Truck_Driver_ID
		$bookings->Truck_Driver_ID->SetDbValueDef($rsnew, $bookings->Truck_Driver_ID->CurrentValue, NULL, FALSE);

		// Unit_ID
		$bookings->Unit_ID->SetDbValueDef($rsnew, $bookings->Unit_ID->CurrentValue, NULL, FALSE);

		// Quantity
		$bookings->Quantity->SetDbValueDef($rsnew, $bookings->Quantity->CurrentValue, NULL, FALSE);

		// Date_Updated
		$bookings->Date_Updated->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['Date_Updated'] =& $bookings->Date_Updated->DbValue;

		// Remarks
		$bookings->Remarks->SetDbValueDef($rsnew, $bookings->Remarks->CurrentValue, NULL, FALSE);

		// User
		$bookings->User->SetDbValueDef($rsnew, CurrentUserID(), NULL);
		$rsnew['User'] =& $bookings->User->DbValue;

		// Call Row Inserting event
		$bInsertRow = $bookings->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($bookings->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($bookings->CancelMessage <> "") {
				$this->setMessage($bookings->CancelMessage);
				$bookings->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$bookings->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $bookings->id->DbValue;

			// Call Row Inserted event
			$bookings->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $bookings;
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
				$this->sDbMasterFilter = $bookings->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $bookings->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$bookings->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$bookings->Client_ID->setSessionValue($bookings->Client_ID->QueryStringValue);
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
			$bookings->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$bookings->setStartRecordNumber($this->lStartRec);
			$bookings->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$bookings->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($bookings->Client_ID->QueryStringValue == "") $bookings->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $bookings->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $bookings->getDetailFilter(); // Restore detail filter
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
