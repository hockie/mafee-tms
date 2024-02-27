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
$bookings_search = new cbookings_search();
$Page =& $bookings_search;

// Page init
$bookings_search->Page_Init();

// Page main
$bookings_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var bookings_search = new ew_Page("bookings_search");

// page properties
bookings_search.PageID = "search"; // page ID
bookings_search.FormID = "fbookingssearch"; // form ID
var EW_PAGE_ID = bookings_search.PageID; // for backward compatibility

// extend page with validate function for search
bookings_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETD"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->ETD->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETA"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->ETA->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Quantity"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Quantity->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Freight"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Freight->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Vat"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Vat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Sales"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Total_Sales->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Wtax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Wtax->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Amount_Due"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Total_Amount_Due->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Date_Delivered"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Date_Delivered->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Date_Updated"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Date_Updated->FldErrMsg()) ?>");

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
bookings_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
bookings_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
bookings_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
bookings_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $bookings->TableCaption() ?><br><br>
<a href="<?php echo $bookings->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$bookings_search->ShowMessage();
?>
<form name="fbookingssearch" id="fbookingssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return bookings_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="bookings">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $bookings->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->id->FldCaption() ?></td>
		<td<?php echo $bookings->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $bookings->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $bookings->id->FldTitle() ?>" value="<?php echo $bookings->id->EditValue ?>"<?php echo $bookings->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Booking_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Booking_Number->FldCaption() ?></td>
		<td<?php echo $bookings->Booking_Number->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Booking_Number" id="z_Booking_Number" value="LIKE"></span></td>
		<td<?php echo $bookings->Booking_Number->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Booking_Number" id="x_Booking_Number" title="<?php echo $bookings->Booking_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $bookings->Booking_Number->EditValue ?>"<?php echo $bookings->Booking_Number->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Date->FldCaption() ?></td>
		<td<?php echo $bookings->Date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Date" id="z_Date" value="BETWEEN"></span></td>
		<td<?php echo $bookings->Date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
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
</span>
				<span class="ewSearchOpr" id="btw1_Date" name="btw1_Date">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_Date" name="btw1_Date">
<input type="text" name="y_Date" id="y_Date" title="<?php echo $bookings->Date->FldTitle() ?>" value="<?php echo $bookings->Date->EditValue2 ?>"<?php echo $bookings->Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_Date" name="cal_y_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_Date", // input field id
	showsTime: true, // show time
	ifFormat: "%m/%d/%Y %H:%M:%S", // date format
	button: "cal_y_Date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Client_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Client_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td<?php echo $bookings->Client_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php $bookings->Client_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Origin_ID','x_Client_ID',bookings_search.ar_x_Origin_ID);ew_UpdateOpt('x_Customer_ID','x_Client_ID',bookings_search.ar_x_Customer_ID);ew_UpdateOpt('x_Destination_ID','x_Client_ID',bookings_search.ar_x_Destination_ID); " . @$bookings->Client_ID->EditAttrs["onchange"]; ?>
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $bookings->Client_ID->FldTitle() ?>"<?php echo $bookings->Client_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Client_ID->EditValue)) {
	$arwrk = $bookings->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Client_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $bookings->Origin_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Origin_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Origin_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Origin_ID" id="z_Origin_ID" value="="></span></td>
		<td<?php echo $bookings->Origin_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Origin_ID" name="x_Origin_ID" title="<?php echo $bookings->Origin_ID->FldTitle() ?>"<?php echo $bookings->Origin_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Origin_ID->EditValue)) {
	$arwrk = $bookings->Origin_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Origin_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
bookings_search.ar_x_Origin_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Customer_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Customer_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Customer_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Customer_ID" id="z_Customer_ID" value="="></span></td>
		<td<?php echo $bookings->Customer_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Customer_ID" name="x_Customer_ID" title="<?php echo $bookings->Customer_ID->FldTitle() ?>"<?php echo $bookings->Customer_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Customer_ID->EditValue)) {
	$arwrk = $bookings->Customer_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Customer_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
bookings_search.ar_x_Customer_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Destination_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Destination_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Destination_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Destination_ID" id="z_Destination_ID" value="="></span></td>
		<td<?php echo $bookings->Destination_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Destination_ID" name="x_Destination_ID" title="<?php echo $bookings->Destination_ID->FldTitle() ?>"<?php echo $bookings->Destination_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Destination_ID->EditValue)) {
	$arwrk = $bookings->Destination_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Destination_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
bookings_search.ar_x_Destination_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Subcon_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="="></span></td>
		<td<?php echo $bookings->Subcon_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php $bookings->Subcon_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Truck_ID','x_Subcon_ID',bookings_search.ar_x_Truck_ID);ew_UpdateOpt('x_Truck_Driver_ID','x_Subcon_ID',bookings_search.ar_x_Truck_Driver_ID); " . @$bookings->Subcon_ID->EditAttrs["onchange"]; ?>
<select id="x_Subcon_ID" name="x_Subcon_ID" title="<?php echo $bookings->Subcon_ID->FldTitle() ?>"<?php echo $bookings->Subcon_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Subcon_ID->EditValue)) {
	$arwrk = $bookings->Subcon_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Subcon_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $bookings->Truck_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Truck_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Truck_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_ID" id="z_Truck_ID" value="="></span></td>
		<td<?php echo $bookings->Truck_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Truck_ID" name="x_Truck_ID" title="<?php echo $bookings->Truck_ID->FldTitle() ?>"<?php echo $bookings->Truck_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Truck_ID->EditValue)) {
	$arwrk = $bookings->Truck_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Truck_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
bookings_search.ar_x_Truck_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->ETD->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->ETD->FldCaption() ?></td>
		<td<?php echo $bookings->ETD->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETD" id="z_ETD" value="BETWEEN"></span></td>
		<td<?php echo $bookings->ETD->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ETD" id="x_ETD" title="<?php echo $bookings->ETD->FldTitle() ?>" value="<?php echo $bookings->ETD->EditValue ?>"<?php echo $bookings->ETD->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_ETD" name="cal_x_ETD" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_ETD", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_ETD" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw1_ETD" name="btw1_ETD">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_ETD" name="btw1_ETD">
<input type="text" name="y_ETD" id="y_ETD" title="<?php echo $bookings->ETD->FldTitle() ?>" value="<?php echo $bookings->ETD->EditValue2 ?>"<?php echo $bookings->ETD->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_ETD" name="cal_y_ETD" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_ETD", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_y_ETD" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->ETA->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->ETA->FldCaption() ?></td>
		<td<?php echo $bookings->ETA->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETA" id="z_ETA" value="BETWEEN"></span></td>
		<td<?php echo $bookings->ETA->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ETA" id="x_ETA" title="<?php echo $bookings->ETA->FldTitle() ?>" value="<?php echo $bookings->ETA->EditValue ?>"<?php echo $bookings->ETA->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_ETA" name="cal_x_ETA" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_ETA", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_ETA" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw1_ETA" name="btw1_ETA">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_ETA" name="btw1_ETA">
<input type="text" name="y_ETA" id="y_ETA" title="<?php echo $bookings->ETA->FldTitle() ?>" value="<?php echo $bookings->ETA->EditValue2 ?>"<?php echo $bookings->ETA->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_ETA" name="cal_y_ETA" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_ETA", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_y_ETA" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Billing_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Billing_Type_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Billing_Type_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Billing_Type_ID" id="z_Billing_Type_ID" value="="></span></td>
		<td<?php echo $bookings->Billing_Type_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Billing_Type_ID" name="x_Billing_Type_ID" title="<?php echo $bookings->Billing_Type_ID->FldTitle() ?>"<?php echo $bookings->Billing_Type_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Billing_Type_ID->EditValue)) {
	$arwrk = $bookings->Billing_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Billing_Type_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $bookings->Doc_Reference_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Doc_Reference_Number->FldCaption() ?></td>
		<td<?php echo $bookings->Doc_Reference_Number->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Doc_Reference_Number" id="z_Doc_Reference_Number" value="LIKE"></span></td>
		<td<?php echo $bookings->Doc_Reference_Number->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Doc_Reference_Number" id="x_Doc_Reference_Number" title="<?php echo $bookings->Doc_Reference_Number->FldTitle() ?>" cols="35" rows="4"<?php echo $bookings->Doc_Reference_Number->EditAttributes() ?>><?php echo $bookings->Doc_Reference_Number->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Doc_Reference_Number", function() {
	var oCKeditor = CKEDITOR.replace('x_Doc_Reference_Number', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Truck_Driver_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Truck_Driver_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Truck_Driver_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_Driver_ID" id="z_Truck_Driver_ID" value="="></span></td>
		<td<?php echo $bookings->Truck_Driver_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Truck_Driver_ID" name="x_Truck_Driver_ID" title="<?php echo $bookings->Truck_Driver_ID->FldTitle() ?>"<?php echo $bookings->Truck_Driver_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Truck_Driver_ID->EditValue)) {
	$arwrk = $bookings->Truck_Driver_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Truck_Driver_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
bookings_search.ar_x_Truck_Driver_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Status_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Status_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Status_ID" id="z_Status_ID" value="="></span></td>
		<td<?php echo $bookings->Status_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Status_ID" name="x_Status_ID" title="<?php echo $bookings->Status_ID->FldTitle() ?>"<?php echo $bookings->Status_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Status_ID->EditValue)) {
	$arwrk = $bookings->Status_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Status_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $bookings->Unit_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Unit_ID->FldCaption() ?></td>
		<td<?php echo $bookings->Unit_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Unit_ID" id="z_Unit_ID" value="="></span></td>
		<td<?php echo $bookings->Unit_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Unit_ID" name="x_Unit_ID" title="<?php echo $bookings->Unit_ID->FldTitle() ?>"<?php echo $bookings->Unit_ID->EditAttributes() ?>>
<?php
if (is_array($bookings->Unit_ID->EditValue)) {
	$arwrk = $bookings->Unit_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->Unit_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $bookings->Quantity->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Quantity->FldCaption() ?></td>
		<td<?php echo $bookings->Quantity->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Quantity" id="z_Quantity" value="="></span></td>
		<td<?php echo $bookings->Quantity->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Quantity" id="x_Quantity" title="<?php echo $bookings->Quantity->FldTitle() ?>" size="30" value="<?php echo $bookings->Quantity->EditValue ?>"<?php echo $bookings->Quantity->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Freight->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Freight->FldCaption() ?></td>
		<td<?php echo $bookings->Freight->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Freight" id="z_Freight" value="="></span></td>
		<td<?php echo $bookings->Freight->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Freight" id="x_Freight" title="<?php echo $bookings->Freight->FldTitle() ?>" size="30" value="<?php echo $bookings->Freight->EditValue ?>"<?php echo $bookings->Freight->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Vat->FldCaption() ?></td>
		<td<?php echo $bookings->Vat->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Vat" id="z_Vat" value="="></span></td>
		<td<?php echo $bookings->Vat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Vat" id="x_Vat" title="<?php echo $bookings->Vat->FldTitle() ?>" size="30" value="<?php echo $bookings->Vat->EditValue ?>"<?php echo $bookings->Vat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Total_Sales->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Total_Sales->FldCaption() ?></td>
		<td<?php echo $bookings->Total_Sales->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Sales" id="z_Total_Sales" value="="></span></td>
		<td<?php echo $bookings->Total_Sales->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Sales" id="x_Total_Sales" title="<?php echo $bookings->Total_Sales->FldTitle() ?>" size="30" value="<?php echo $bookings->Total_Sales->EditValue ?>"<?php echo $bookings->Total_Sales->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Wtax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Wtax->FldCaption() ?></td>
		<td<?php echo $bookings->Wtax->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Wtax" id="z_Wtax" value="="></span></td>
		<td<?php echo $bookings->Wtax->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Wtax" id="x_Wtax" title="<?php echo $bookings->Wtax->FldTitle() ?>" size="30" value="<?php echo $bookings->Wtax->EditValue ?>"<?php echo $bookings->Wtax->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $bookings->Total_Amount_Due->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Amount_Due" id="z_Total_Amount_Due" value="="></span></td>
		<td<?php echo $bookings->Total_Amount_Due->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $bookings->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $bookings->Total_Amount_Due->EditValue ?>"<?php echo $bookings->Total_Amount_Due->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Date_Delivered->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Date_Delivered->FldCaption() ?></td>
		<td<?php echo $bookings->Date_Delivered->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Date_Delivered" id="z_Date_Delivered" value="="></span></td>
		<td<?php echo $bookings->Date_Delivered->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Date_Delivered" id="x_Date_Delivered" title="<?php echo $bookings->Date_Delivered->FldTitle() ?>" value="<?php echo $bookings->Date_Delivered->EditValue ?>"<?php echo $bookings->Date_Delivered->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date_Delivered" name="cal_x_Date_Delivered" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date_Delivered", // input field id
	showsTime: true, // show time
	ifFormat: "%m/%d/%Y %H:%M:%S", // date format
	button: "cal_x_Date_Delivered" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Date_Updated->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Date_Updated->FldCaption() ?></td>
		<td<?php echo $bookings->Date_Updated->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Date_Updated" id="z_Date_Updated" value="="></span></td>
		<td<?php echo $bookings->Date_Updated->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Date_Updated" id="x_Date_Updated" title="<?php echo $bookings->Date_Updated->FldTitle() ?>" value="<?php echo $bookings->Date_Updated->EditValue ?>"<?php echo $bookings->Date_Updated->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $bookings->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->Remarks->FldCaption() ?></td>
		<td<?php echo $bookings->Remarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE"></span></td>
		<td<?php echo $bookings->Remarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $bookings->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $bookings->Remarks->EditAttributes() ?>><?php echo $bookings->Remarks->EditValue ?></textarea>
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
	<tr<?php echo $bookings->User->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $bookings->User->FldCaption() ?></td>
		<td<?php echo $bookings->User->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_User" id="z_User" value="="></span></td>
		<td<?php echo $bookings->User->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_User" name="x_User" title="<?php echo $bookings->User->FldTitle() ?>"<?php echo $bookings->User->EditAttributes() ?>>
<?php
if (is_array($bookings->User->EditValue)) {
	$arwrk = $bookings->User->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($bookings->User->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_Origin_ID','x_Client_ID',bookings_search.ar_x_Origin_ID],
['x_Customer_ID','x_Client_ID',bookings_search.ar_x_Customer_ID],
['x_Destination_ID','x_Client_ID',bookings_search.ar_x_Destination_ID],
['x_Truck_ID','x_Subcon_ID',bookings_search.ar_x_Truck_ID],
['x_Truck_Driver_ID','x_Subcon_ID',bookings_search.ar_x_Truck_Driver_ID]]);

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
$bookings_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cbookings_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'bookings';

	// Page object name
	var $PageObjName = 'bookings_search';

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
	function cbookings_search() {
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
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $bookings;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$bookings->CurrentAction = $objForm->GetValue("a_search");
			switch ($bookings->CurrentAction) {
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
						$sSrchStr = $bookings->UrlParm($sSrchStr);
						$this->Page_Terminate("bookingslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$bookings->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $bookings;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $bookings->id); // id
	$this->BuildSearchUrl($sSrchUrl, $bookings->Booking_Number); // Booking_Number
	$this->BuildSearchUrl($sSrchUrl, $bookings->Date); // Date
	$this->BuildSearchUrl($sSrchUrl, $bookings->Client_ID); // Client_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Origin_ID); // Origin_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Customer_ID); // Customer_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Destination_ID); // Destination_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Subcon_ID); // Subcon_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Truck_ID); // Truck_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->ETD); // ETD
	$this->BuildSearchUrl($sSrchUrl, $bookings->ETA); // ETA
	$this->BuildSearchUrl($sSrchUrl, $bookings->Billing_Type_ID); // Billing_Type_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Doc_Reference_Number); // Doc_Reference_Number
	$this->BuildSearchUrl($sSrchUrl, $bookings->Truck_Driver_ID); // Truck_Driver_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Status_ID); // Status_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Unit_ID); // Unit_ID
	$this->BuildSearchUrl($sSrchUrl, $bookings->Quantity); // Quantity
	$this->BuildSearchUrl($sSrchUrl, $bookings->Freight); // Freight
	$this->BuildSearchUrl($sSrchUrl, $bookings->Vat); // Vat
	$this->BuildSearchUrl($sSrchUrl, $bookings->Total_Sales); // Total_Sales
	$this->BuildSearchUrl($sSrchUrl, $bookings->Wtax); // Wtax
	$this->BuildSearchUrl($sSrchUrl, $bookings->Total_Amount_Due); // Total_Amount_Due
	$this->BuildSearchUrl($sSrchUrl, $bookings->Date_Delivered); // Date_Delivered
	$this->BuildSearchUrl($sSrchUrl, $bookings->Date_Updated); // Date_Updated
	$this->BuildSearchUrl($sSrchUrl, $bookings->Remarks); // Remarks
	$this->BuildSearchUrl($sSrchUrl, $bookings->User); // User
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
		global $objForm, $bookings;

		// Load search values
		// id

		$bookings->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$bookings->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// Booking_Number
		$bookings->Booking_Number->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Booking_Number"));
		$bookings->Booking_Number->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Booking_Number");

		// Date
		$bookings->Date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Date"));
		$bookings->Date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Date");
		$bookings->Date->AdvancedSearch->SearchCondition = $objForm->GetValue("v_Date");
		$bookings->Date->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_Date"));
		$bookings->Date->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_Date");

		// Client_ID
		$bookings->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Client_ID"));
		$bookings->Client_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Client_ID");

		// Origin_ID
		$bookings->Origin_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Origin_ID"));
		$bookings->Origin_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Origin_ID");

		// Customer_ID
		$bookings->Customer_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Customer_ID"));
		$bookings->Customer_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Customer_ID");

		// Destination_ID
		$bookings->Destination_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Destination_ID"));
		$bookings->Destination_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Destination_ID");

		// Subcon_ID
		$bookings->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Subcon_ID"));
		$bookings->Subcon_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Subcon_ID");

		// Truck_ID
		$bookings->Truck_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Truck_ID"));
		$bookings->Truck_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Truck_ID");

		// ETD
		$bookings->ETD->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ETD"));
		$bookings->ETD->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ETD");
		$bookings->ETD->AdvancedSearch->SearchCondition = $objForm->GetValue("v_ETD");
		$bookings->ETD->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_ETD"));
		$bookings->ETD->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_ETD");

		// ETA
		$bookings->ETA->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ETA"));
		$bookings->ETA->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ETA");
		$bookings->ETA->AdvancedSearch->SearchCondition = $objForm->GetValue("v_ETA");
		$bookings->ETA->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_ETA"));
		$bookings->ETA->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_ETA");

		// Billing_Type_ID
		$bookings->Billing_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Billing_Type_ID"));
		$bookings->Billing_Type_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Billing_Type_ID");

		// Doc_Reference_Number
		$bookings->Doc_Reference_Number->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Doc_Reference_Number"));
		$bookings->Doc_Reference_Number->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Doc_Reference_Number");

		// Truck_Driver_ID
		$bookings->Truck_Driver_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Truck_Driver_ID"));
		$bookings->Truck_Driver_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Truck_Driver_ID");

		// Status_ID
		$bookings->Status_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Status_ID"));
		$bookings->Status_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Status_ID");

		// Unit_ID
		$bookings->Unit_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Unit_ID"));
		$bookings->Unit_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Unit_ID");

		// Quantity
		$bookings->Quantity->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Quantity"));
		$bookings->Quantity->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Quantity");

		// Freight
		$bookings->Freight->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Freight"));
		$bookings->Freight->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Freight");

		// Vat
		$bookings->Vat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Vat"));
		$bookings->Vat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Vat");

		// Total_Sales
		$bookings->Total_Sales->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Sales"));
		$bookings->Total_Sales->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Sales");

		// Wtax
		$bookings->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Wtax"));
		$bookings->Wtax->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Wtax");

		// Total_Amount_Due
		$bookings->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Amount_Due"));
		$bookings->Total_Amount_Due->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Amount_Due");

		// Date_Delivered
		$bookings->Date_Delivered->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Date_Delivered"));
		$bookings->Date_Delivered->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Date_Delivered");

		// Date_Updated
		$bookings->Date_Updated->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Date_Updated"));
		$bookings->Date_Updated->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Date_Updated");

		// Remarks
		$bookings->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Remarks"));
		$bookings->Remarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Remarks");

		// User
		$bookings->User->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_User"));
		$bookings->User->AdvancedSearch->SearchOperator = $objForm->GetValue("z_User");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $bookings;

		// Initialize URLs
		// Call Row_Rendering event

		$bookings->Row_Rendering();

		// Common render codes for all row types
		// id

		$bookings->id->CellCssStyle = ""; $bookings->id->CellCssClass = "";
		$bookings->id->CellAttrs = array(); $bookings->id->ViewAttrs = array(); $bookings->id->EditAttrs = array();

		// Booking_Number
		$bookings->Booking_Number->CellCssStyle = ""; $bookings->Booking_Number->CellCssClass = "";
		$bookings->Booking_Number->CellAttrs = array(); $bookings->Booking_Number->ViewAttrs = array(); $bookings->Booking_Number->EditAttrs = array();

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

		// Billing_Type_ID
		$bookings->Billing_Type_ID->CellCssStyle = ""; $bookings->Billing_Type_ID->CellCssClass = "";
		$bookings->Billing_Type_ID->CellAttrs = array(); $bookings->Billing_Type_ID->ViewAttrs = array(); $bookings->Billing_Type_ID->EditAttrs = array();

		// Doc_Reference_Number
		$bookings->Doc_Reference_Number->CellCssStyle = ""; $bookings->Doc_Reference_Number->CellCssClass = "";
		$bookings->Doc_Reference_Number->CellAttrs = array(); $bookings->Doc_Reference_Number->ViewAttrs = array(); $bookings->Doc_Reference_Number->EditAttrs = array();

		// Truck_Driver_ID
		$bookings->Truck_Driver_ID->CellCssStyle = ""; $bookings->Truck_Driver_ID->CellCssClass = "";
		$bookings->Truck_Driver_ID->CellAttrs = array(); $bookings->Truck_Driver_ID->ViewAttrs = array(); $bookings->Truck_Driver_ID->EditAttrs = array();

		// Status_ID
		$bookings->Status_ID->CellCssStyle = ""; $bookings->Status_ID->CellCssClass = "";
		$bookings->Status_ID->CellAttrs = array(); $bookings->Status_ID->ViewAttrs = array(); $bookings->Status_ID->EditAttrs = array();

		// Unit_ID
		$bookings->Unit_ID->CellCssStyle = ""; $bookings->Unit_ID->CellCssClass = "";
		$bookings->Unit_ID->CellAttrs = array(); $bookings->Unit_ID->ViewAttrs = array(); $bookings->Unit_ID->EditAttrs = array();

		// Quantity
		$bookings->Quantity->CellCssStyle = ""; $bookings->Quantity->CellCssClass = "";
		$bookings->Quantity->CellAttrs = array(); $bookings->Quantity->ViewAttrs = array(); $bookings->Quantity->EditAttrs = array();

		// Freight
		$bookings->Freight->CellCssStyle = ""; $bookings->Freight->CellCssClass = "";
		$bookings->Freight->CellAttrs = array(); $bookings->Freight->ViewAttrs = array(); $bookings->Freight->EditAttrs = array();

		// Vat
		$bookings->Vat->CellCssStyle = ""; $bookings->Vat->CellCssClass = "";
		$bookings->Vat->CellAttrs = array(); $bookings->Vat->ViewAttrs = array(); $bookings->Vat->EditAttrs = array();

		// Total_Sales
		$bookings->Total_Sales->CellCssStyle = ""; $bookings->Total_Sales->CellCssClass = "";
		$bookings->Total_Sales->CellAttrs = array(); $bookings->Total_Sales->ViewAttrs = array(); $bookings->Total_Sales->EditAttrs = array();

		// Wtax
		$bookings->Wtax->CellCssStyle = ""; $bookings->Wtax->CellCssClass = "";
		$bookings->Wtax->CellAttrs = array(); $bookings->Wtax->ViewAttrs = array(); $bookings->Wtax->EditAttrs = array();

		// Total_Amount_Due
		$bookings->Total_Amount_Due->CellCssStyle = ""; $bookings->Total_Amount_Due->CellCssClass = "";
		$bookings->Total_Amount_Due->CellAttrs = array(); $bookings->Total_Amount_Due->ViewAttrs = array(); $bookings->Total_Amount_Due->EditAttrs = array();

		// Date_Delivered
		$bookings->Date_Delivered->CellCssStyle = ""; $bookings->Date_Delivered->CellCssClass = "";
		$bookings->Date_Delivered->CellAttrs = array(); $bookings->Date_Delivered->ViewAttrs = array(); $bookings->Date_Delivered->EditAttrs = array();

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

			// id
			$bookings->id->HrefValue = "";
			$bookings->id->TooltipValue = "";

			// Booking_Number
			$bookings->Booking_Number->HrefValue = "";
			$bookings->Booking_Number->TooltipValue = "";

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

			// Billing_Type_ID
			$bookings->Billing_Type_ID->HrefValue = "";
			$bookings->Billing_Type_ID->TooltipValue = "";

			// Doc_Reference_Number
			$bookings->Doc_Reference_Number->HrefValue = "";
			$bookings->Doc_Reference_Number->TooltipValue = "";

			// Truck_Driver_ID
			$bookings->Truck_Driver_ID->HrefValue = "";
			$bookings->Truck_Driver_ID->TooltipValue = "";

			// Status_ID
			$bookings->Status_ID->HrefValue = "";
			$bookings->Status_ID->TooltipValue = "";

			// Unit_ID
			$bookings->Unit_ID->HrefValue = "";
			$bookings->Unit_ID->TooltipValue = "";

			// Quantity
			$bookings->Quantity->HrefValue = "";
			$bookings->Quantity->TooltipValue = "";

			// Freight
			$bookings->Freight->HrefValue = "";
			$bookings->Freight->TooltipValue = "";

			// Vat
			$bookings->Vat->HrefValue = "";
			$bookings->Vat->TooltipValue = "";

			// Total_Sales
			$bookings->Total_Sales->HrefValue = "";
			$bookings->Total_Sales->TooltipValue = "";

			// Wtax
			$bookings->Wtax->HrefValue = "";
			$bookings->Wtax->TooltipValue = "";

			// Total_Amount_Due
			$bookings->Total_Amount_Due->HrefValue = "";
			$bookings->Total_Amount_Due->TooltipValue = "";

			// Date_Delivered
			$bookings->Date_Delivered->HrefValue = "";
			$bookings->Date_Delivered->TooltipValue = "";

			// Date_Updated
			$bookings->Date_Updated->HrefValue = "";
			$bookings->Date_Updated->TooltipValue = "";

			// Remarks
			$bookings->Remarks->HrefValue = "";
			$bookings->Remarks->TooltipValue = "";

			// User
			$bookings->User->HrefValue = "";
			$bookings->User->TooltipValue = "";
		} elseif ($bookings->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$bookings->id->EditCustomAttributes = "";
			$bookings->id->EditValue = ew_HtmlEncode($bookings->id->AdvancedSearch->SearchValue);

			// Booking_Number
			$bookings->Booking_Number->EditCustomAttributes = "";
			$bookings->Booking_Number->EditValue = ew_HtmlEncode($bookings->Booking_Number->AdvancedSearch->SearchValue);

			// Date
			$bookings->Date->EditCustomAttributes = "";
			$bookings->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($bookings->Date->AdvancedSearch->SearchValue, 10), 10));
			$bookings->Date->EditCustomAttributes = "";
			$bookings->Date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($bookings->Date->AdvancedSearch->SearchValue2, 10), 10));

			// Client_ID
			$bookings->Client_ID->EditCustomAttributes = "";
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
			$bookings->ETD->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($bookings->ETD->AdvancedSearch->SearchValue, 6), 6));
			$bookings->ETD->EditCustomAttributes = "";
			$bookings->ETD->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($bookings->ETD->AdvancedSearch->SearchValue2, 6), 6));

			// ETA
			$bookings->ETA->EditCustomAttributes = "";
			$bookings->ETA->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($bookings->ETA->AdvancedSearch->SearchValue, 6), 6));
			$bookings->ETA->EditCustomAttributes = "";
			$bookings->ETA->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($bookings->ETA->AdvancedSearch->SearchValue2, 6), 6));

			// Billing_Type_ID
			$bookings->Billing_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Billing_Types`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `billing_types`";
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
			$bookings->Billing_Type_ID->EditValue = $arwrk;

			// Doc_Reference_Number
			$bookings->Doc_Reference_Number->EditCustomAttributes = "";
			$bookings->Doc_Reference_Number->EditValue = ew_HtmlEncode($bookings->Doc_Reference_Number->AdvancedSearch->SearchValue);

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

			// Status_ID
			$bookings->Status_ID->EditCustomAttributes = "";
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
			$bookings->Status_ID->EditValue = $arwrk;

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
			$bookings->Quantity->EditValue = ew_HtmlEncode($bookings->Quantity->AdvancedSearch->SearchValue);

			// Freight
			$bookings->Freight->EditCustomAttributes = "";
			$bookings->Freight->EditValue = ew_HtmlEncode($bookings->Freight->AdvancedSearch->SearchValue);

			// Vat
			$bookings->Vat->EditCustomAttributes = "";
			$bookings->Vat->EditValue = ew_HtmlEncode($bookings->Vat->AdvancedSearch->SearchValue);

			// Total_Sales
			$bookings->Total_Sales->EditCustomAttributes = "";
			$bookings->Total_Sales->EditValue = ew_HtmlEncode($bookings->Total_Sales->AdvancedSearch->SearchValue);

			// Wtax
			$bookings->Wtax->EditCustomAttributes = "";
			$bookings->Wtax->EditValue = ew_HtmlEncode($bookings->Wtax->AdvancedSearch->SearchValue);

			// Total_Amount_Due
			$bookings->Total_Amount_Due->EditCustomAttributes = "";
			$bookings->Total_Amount_Due->EditValue = ew_HtmlEncode($bookings->Total_Amount_Due->AdvancedSearch->SearchValue);

			// Date_Delivered
			$bookings->Date_Delivered->EditCustomAttributes = "";
			$bookings->Date_Delivered->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($bookings->Date_Delivered->AdvancedSearch->SearchValue, 10), 10));

			// Date_Updated
			$bookings->Date_Updated->EditCustomAttributes = "";
			$bookings->Date_Updated->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($bookings->Date_Updated->AdvancedSearch->SearchValue, 6), 6));

			// Remarks
			$bookings->Remarks->EditCustomAttributes = "";
			$bookings->Remarks->EditValue = ew_HtmlEncode($bookings->Remarks->AdvancedSearch->SearchValue);

			// User
			$bookings->User->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `username`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `users`";
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
			$bookings->User->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($bookings->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$bookings->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $bookings;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($bookings->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->id->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->ETD->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->ETD->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->ETD->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->ETD->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->ETA->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->ETA->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->ETA->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->ETA->FldErrMsg();
		}
		if (!ew_CheckNumber($bookings->Quantity->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Quantity->FldErrMsg();
		}
		if (!ew_CheckNumber($bookings->Freight->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Freight->FldErrMsg();
		}
		if (!ew_CheckNumber($bookings->Vat->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($bookings->Total_Sales->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Total_Sales->FldErrMsg();
		}
		if (!ew_CheckNumber($bookings->Wtax->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Wtax->FldErrMsg();
		}
		if (!ew_CheckNumber($bookings->Total_Amount_Due->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Total_Amount_Due->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->Date_Delivered->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Date_Delivered->FldErrMsg();
		}
		if (!ew_CheckUSDate($bookings->Date_Updated->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $bookings->Date_Updated->FldErrMsg();
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
		global $bookings;
		$bookings->id->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_id");
		$bookings->Booking_Number->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Booking_Number");
		$bookings->Date->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Date");
		$bookings->Date->AdvancedSearch->SearchValue2 = $bookings->getAdvancedSearch("y_Date");
		$bookings->Client_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Client_ID");
		$bookings->Origin_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Origin_ID");
		$bookings->Customer_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Customer_ID");
		$bookings->Destination_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Destination_ID");
		$bookings->Subcon_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Subcon_ID");
		$bookings->Truck_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Truck_ID");
		$bookings->ETD->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_ETD");
		$bookings->ETD->AdvancedSearch->SearchValue2 = $bookings->getAdvancedSearch("y_ETD");
		$bookings->ETA->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_ETA");
		$bookings->ETA->AdvancedSearch->SearchValue2 = $bookings->getAdvancedSearch("y_ETA");
		$bookings->Billing_Type_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Billing_Type_ID");
		$bookings->Doc_Reference_Number->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Doc_Reference_Number");
		$bookings->Truck_Driver_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Truck_Driver_ID");
		$bookings->Status_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Status_ID");
		$bookings->Unit_ID->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Unit_ID");
		$bookings->Quantity->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Quantity");
		$bookings->Freight->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Freight");
		$bookings->Vat->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Vat");
		$bookings->Total_Sales->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Total_Sales");
		$bookings->Wtax->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Wtax");
		$bookings->Total_Amount_Due->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Total_Amount_Due");
		$bookings->Date_Delivered->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Date_Delivered");
		$bookings->Date_Updated->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Date_Updated");
		$bookings->Remarks->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_Remarks");
		$bookings->User->AdvancedSearch->SearchValue = $bookings->getAdvancedSearch("x_User");
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
