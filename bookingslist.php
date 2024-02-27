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
$bookings_list = new cbookings_list();
$Page =& $bookings_list;

// Page init
$bookings_list->Page_Init();

// Page main
$bookings_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($bookings->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var bookings_list = new ew_Page("bookings_list");

// page properties
bookings_list.PageID = "list"; // page ID
bookings_list.FormID = "fbookingslist"; // form ID
var EW_PAGE_ID = bookings_list.PageID; // for backward compatibility

// extend page with validate function for search
bookings_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETD"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->ETD->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETA"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($bookings->ETA->FldErrMsg()) ?>");

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
bookings_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
bookings_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
bookings_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
bookings_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($bookings->Export == "") { ?>
<?php
$gsMasterReturnUrl = "clientslist.php";
if ($bookings_list->sDbMasterFilter <> "" && $bookings->getCurrentMasterTable() == "clients") {
	if ($bookings_list->bMasterRecordExists) {
		if ($bookings->getCurrentMasterTable() == $bookings->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "clientsmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$bookings_list->lTotalRecs = $bookings->SelectRecordCount();
	} else {
		if ($rs = $bookings_list->LoadRecordset())
			$bookings_list->lTotalRecs = $rs->RecordCount();
	}
	$bookings_list->lStartRec = 1;
	if ($bookings_list->lDisplayRecs <= 0 || ($bookings->Export <> "" && $bookings->ExportAll)) // Display all records
		$bookings_list->lDisplayRecs = $bookings_list->lTotalRecs;
	if (!($bookings->Export <> "" && $bookings->ExportAll))
		$bookings_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $bookings_list->LoadRecordset($bookings_list->lStartRec-1, $bookings_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $bookings->TableCaption() ?>
<?php if ($bookings->Export == "" && $bookings->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $bookings_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $bookings_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $bookings_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($bookings->Export == "" && $bookings->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(bookings_list);" style="text-decoration: none;"><img id="bookings_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="bookings_list_SearchPanel">
<form name="fbookingslistsrch" id="fbookingslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return bookings_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="bookings">
<?php
if ($gsSearchError == "")
	$bookings_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$bookings->RowType = EW_ROWTYPE_SEARCH;

// Render row
$bookings_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Booking_Number->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Booking_Number" id="z_Booking_Number" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Booking_Number" id="x_Booking_Number" title="<?php echo $bookings->Booking_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $bookings->Booking_Number->EditValue ?>"<?php echo $bookings->Booking_Number->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Date->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Date" id="z_Date" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Client_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($bookings->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $bookings->Client_ID->ViewAttributes() ?>><?php echo $bookings->Client_ID->ListViewValue() ?></div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($bookings->Client_ID->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<?php $bookings->Client_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Origin_ID','x_Client_ID',bookings_list.ar_x_Origin_ID);ew_UpdateOpt('x_Customer_ID','x_Client_ID',bookings_list.ar_x_Customer_ID);ew_UpdateOpt('x_Destination_ID','x_Client_ID',bookings_list.ar_x_Destination_ID); " . @$bookings->Client_ID->EditAttrs["onchange"]; ?>
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Origin_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Origin_ID" id="z_Origin_ID" value="="></span></td>
		<td>			
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
bookings_list.ar_x_Origin_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Customer_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Customer_ID" id="z_Customer_ID" value="="></span></td>
		<td>			
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
bookings_list.ar_x_Customer_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Destination_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Destination_ID" id="z_Destination_ID" value="="></span></td>
		<td>			
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
bookings_list.ar_x_Destination_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Subcon_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
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
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->ETD->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETD" id="z_ETD" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->ETA->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETA" id="z_ETA" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Billing_Type_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Billing_Type_ID" id="z_Billing_Type_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $bookings->Status_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Status_ID" id="z_Status_ID" value="="></span></td>
		<td>			
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
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($bookings->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $bookings_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="bookingssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($bookings->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($bookings->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($bookings->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$bookings_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($bookings->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($bookings->CurrentAction <> "gridadd" && $bookings->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($bookings_list->Pager)) $bookings_list->Pager = new cPrevNextPager($bookings_list->lStartRec, $bookings_list->lDisplayRecs, $bookings_list->lTotalRecs) ?>
<?php if ($bookings_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($bookings_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $bookings_list->PageUrl() ?>start=<?php echo $bookings_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($bookings_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $bookings_list->PageUrl() ?>start=<?php echo $bookings_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $bookings_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($bookings_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $bookings_list->PageUrl() ?>start=<?php echo $bookings_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($bookings_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $bookings_list->PageUrl() ?>start=<?php echo $bookings_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $bookings_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $bookings_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $bookings_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $bookings_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($bookings_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($bookings_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="bookings">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($bookings_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($bookings_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($bookings_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($bookings_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($bookings_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($bookings_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($bookings->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $bookings_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($bookings_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fbookingslist, '<?php echo $bookings_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fbookingslist" id="fbookingslist" class="ewForm" action="" method="post">
<div id="gmp_bookings" class="ewGridMiddlePanel">
<?php if ($bookings_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $bookings->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$bookings_list->RenderListOptions();

// Render list options (header, left)
$bookings_list->ListOptions->Render("header", "left");
?>
<?php if ($bookings->Booking_Number->Visible) { // Booking_Number ?>
	<?php if ($bookings->SortUrl($bookings->Booking_Number) == "") { ?>
		<td><?php echo $bookings->Booking_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Booking_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Booking_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($bookings->Booking_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Booking_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Date->Visible) { // Date ?>
	<?php if ($bookings->SortUrl($bookings->Date) == "") { ?>
		<td><?php echo $bookings->Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Client_ID->Visible) { // Client_ID ?>
	<?php if ($bookings->SortUrl($bookings->Client_ID) == "") { ?>
		<td><?php echo $bookings->Client_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Client_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Client_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Client_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Client_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Origin_ID->Visible) { // Origin_ID ?>
	<?php if ($bookings->SortUrl($bookings->Origin_ID) == "") { ?>
		<td><?php echo $bookings->Origin_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Origin_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Origin_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Origin_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Origin_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Customer_ID->Visible) { // Customer_ID ?>
	<?php if ($bookings->SortUrl($bookings->Customer_ID) == "") { ?>
		<td><?php echo $bookings->Customer_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Customer_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Customer_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Customer_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Customer_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Destination_ID->Visible) { // Destination_ID ?>
	<?php if ($bookings->SortUrl($bookings->Destination_ID) == "") { ?>
		<td><?php echo $bookings->Destination_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Destination_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Destination_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Destination_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Destination_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Subcon_ID->Visible) { // Subcon_ID ?>
	<?php if ($bookings->SortUrl($bookings->Subcon_ID) == "") { ?>
		<td><?php echo $bookings->Subcon_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Subcon_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Subcon_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Subcon_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Subcon_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Truck_ID->Visible) { // Truck_ID ?>
	<?php if ($bookings->SortUrl($bookings->Truck_ID) == "") { ?>
		<td><?php echo $bookings->Truck_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Truck_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Truck_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Truck_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Truck_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->ETD->Visible) { // ETD ?>
	<?php if ($bookings->SortUrl($bookings->ETD) == "") { ?>
		<td><?php echo $bookings->ETD->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->ETD) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->ETD->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->ETD->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->ETD->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->ETA->Visible) { // ETA ?>
	<?php if ($bookings->SortUrl($bookings->ETA) == "") { ?>
		<td><?php echo $bookings->ETA->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->ETA) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->ETA->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->ETA->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->ETA->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Billing_Type_ID->Visible) { // Billing_Type_ID ?>
	<?php if ($bookings->SortUrl($bookings->Billing_Type_ID) == "") { ?>
		<td><?php echo $bookings->Billing_Type_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Billing_Type_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Billing_Type_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Billing_Type_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Billing_Type_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Doc_Reference_Number->Visible) { // Doc_Reference_Number ?>
	<?php if ($bookings->SortUrl($bookings->Doc_Reference_Number) == "") { ?>
		<td><?php echo $bookings->Doc_Reference_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Doc_Reference_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Doc_Reference_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($bookings->Doc_Reference_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Doc_Reference_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Truck_Driver_ID->Visible) { // Truck_Driver_ID ?>
	<?php if ($bookings->SortUrl($bookings->Truck_Driver_ID) == "") { ?>
		<td><?php echo $bookings->Truck_Driver_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Truck_Driver_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Truck_Driver_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Truck_Driver_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Truck_Driver_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Status_ID->Visible) { // Status_ID ?>
	<?php if ($bookings->SortUrl($bookings->Status_ID) == "") { ?>
		<td><?php echo $bookings->Status_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Status_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Status_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Status_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Status_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Unit_ID->Visible) { // Unit_ID ?>
	<?php if ($bookings->SortUrl($bookings->Unit_ID) == "") { ?>
		<td><?php echo $bookings->Unit_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Unit_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Unit_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Unit_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Unit_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Quantity->Visible) { // Quantity ?>
	<?php if ($bookings->SortUrl($bookings->Quantity) == "") { ?>
		<td><?php echo $bookings->Quantity->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Quantity) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Quantity->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Quantity->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Quantity->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Freight->Visible) { // Freight ?>
	<?php if ($bookings->SortUrl($bookings->Freight) == "") { ?>
		<td><?php echo $bookings->Freight->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Freight) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Freight->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Freight->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Freight->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Vat->Visible) { // Vat ?>
	<?php if ($bookings->SortUrl($bookings->Vat) == "") { ?>
		<td><?php echo $bookings->Vat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Vat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Vat->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Vat->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Vat->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Total_Sales->Visible) { // Total_Sales ?>
	<?php if ($bookings->SortUrl($bookings->Total_Sales) == "") { ?>
		<td><?php echo $bookings->Total_Sales->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Total_Sales) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Total_Sales->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Total_Sales->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Total_Sales->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Wtax->Visible) { // Wtax ?>
	<?php if ($bookings->SortUrl($bookings->Wtax) == "") { ?>
		<td><?php echo $bookings->Wtax->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Wtax) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Wtax->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Wtax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Wtax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<?php if ($bookings->SortUrl($bookings->Total_Amount_Due) == "") { ?>
		<td><?php echo $bookings->Total_Amount_Due->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Total_Amount_Due) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Total_Amount_Due->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Total_Amount_Due->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Total_Amount_Due->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Date_Delivered->Visible) { // Date_Delivered ?>
	<?php if ($bookings->SortUrl($bookings->Date_Delivered) == "") { ?>
		<td><?php echo $bookings->Date_Delivered->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Date_Delivered) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Date_Delivered->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Date_Delivered->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Date_Delivered->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Date_Updated->Visible) { // Date_Updated ?>
	<?php if ($bookings->SortUrl($bookings->Date_Updated) == "") { ?>
		<td><?php echo $bookings->Date_Updated->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Date_Updated) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Date_Updated->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->Date_Updated->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Date_Updated->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->Remarks->Visible) { // Remarks ?>
	<?php if ($bookings->SortUrl($bookings->Remarks) == "") { ?>
		<td><?php echo $bookings->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($bookings->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($bookings->User->Visible) { // User ?>
	<?php if ($bookings->SortUrl($bookings->User) == "") { ?>
		<td><?php echo $bookings->User->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $bookings->SortUrl($bookings->User) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $bookings->User->FldCaption() ?></td><td style="width: 10px;"><?php if ($bookings->User->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($bookings->User->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$bookings_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($bookings->ExportAll && $bookings->Export <> "") {
	$bookings_list->lStopRec = $bookings_list->lTotalRecs;
} else {
	$bookings_list->lStopRec = $bookings_list->lStartRec + $bookings_list->lDisplayRecs - 1; // Set the last record to display
}
$bookings_list->lRecCount = $bookings_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $bookings_list->lStartRec > 1)
		$rs->Move($bookings_list->lStartRec - 1);
}

// Initialize aggregate
$bookings->RowType = EW_ROWTYPE_AGGREGATEINIT;
$bookings_list->RenderRow();
$bookings_list->lRowCnt = 0;
while (($bookings->CurrentAction == "gridadd" || !$rs->EOF) &&
	$bookings_list->lRecCount < $bookings_list->lStopRec) {
	$bookings_list->lRecCount++;
	if (intval($bookings_list->lRecCount) >= intval($bookings_list->lStartRec)) {
		$bookings_list->lRowCnt++;

	// Init row class and style
	$bookings->CssClass = "";
	$bookings->CssStyle = "";
	$bookings->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($bookings->CurrentAction == "gridadd") {
		$bookings_list->LoadDefaultValues(); // Load default values
	} else {
		$bookings_list->LoadRowValues($rs); // Load row values
	}
	$bookings->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$bookings_list->RenderRow();

	// Render list options
	$bookings_list->RenderListOptions();
?>
	<tr<?php echo $bookings->RowAttributes() ?>>
<?php

// Render list options (body, left)
$bookings_list->ListOptions->Render("body", "left");
?>
	<?php if ($bookings->Booking_Number->Visible) { // Booking_Number ?>
		<td<?php echo $bookings->Booking_Number->CellAttributes() ?>>
<div<?php echo $bookings->Booking_Number->ViewAttributes() ?>><?php echo $bookings->Booking_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Date->Visible) { // Date ?>
		<td<?php echo $bookings->Date->CellAttributes() ?>>
<div<?php echo $bookings->Date->ViewAttributes() ?>><?php echo $bookings->Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Client_ID->Visible) { // Client_ID ?>
		<td<?php echo $bookings->Client_ID->CellAttributes() ?>>
<div<?php echo $bookings->Client_ID->ViewAttributes() ?>><?php echo $bookings->Client_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Origin_ID->Visible) { // Origin_ID ?>
		<td<?php echo $bookings->Origin_ID->CellAttributes() ?>>
<div<?php echo $bookings->Origin_ID->ViewAttributes() ?>><?php echo $bookings->Origin_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Customer_ID->Visible) { // Customer_ID ?>
		<td<?php echo $bookings->Customer_ID->CellAttributes() ?>>
<div<?php echo $bookings->Customer_ID->ViewAttributes() ?>><?php echo $bookings->Customer_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Destination_ID->Visible) { // Destination_ID ?>
		<td<?php echo $bookings->Destination_ID->CellAttributes() ?>>
<div<?php echo $bookings->Destination_ID->ViewAttributes() ?>><?php echo $bookings->Destination_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Subcon_ID->Visible) { // Subcon_ID ?>
		<td<?php echo $bookings->Subcon_ID->CellAttributes() ?>>
<div<?php echo $bookings->Subcon_ID->ViewAttributes() ?>><?php echo $bookings->Subcon_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Truck_ID->Visible) { // Truck_ID ?>
		<td<?php echo $bookings->Truck_ID->CellAttributes() ?>>
<div<?php echo $bookings->Truck_ID->ViewAttributes() ?>><?php echo $bookings->Truck_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->ETD->Visible) { // ETD ?>
		<td<?php echo $bookings->ETD->CellAttributes() ?>>
<div<?php echo $bookings->ETD->ViewAttributes() ?>><?php echo $bookings->ETD->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->ETA->Visible) { // ETA ?>
		<td<?php echo $bookings->ETA->CellAttributes() ?>>
<div<?php echo $bookings->ETA->ViewAttributes() ?>><?php echo $bookings->ETA->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Billing_Type_ID->Visible) { // Billing_Type_ID ?>
		<td<?php echo $bookings->Billing_Type_ID->CellAttributes() ?>>
<div<?php echo $bookings->Billing_Type_ID->ViewAttributes() ?>><?php echo $bookings->Billing_Type_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Doc_Reference_Number->Visible) { // Doc_Reference_Number ?>
		<td<?php echo $bookings->Doc_Reference_Number->CellAttributes() ?>>
<div<?php echo $bookings->Doc_Reference_Number->ViewAttributes() ?>><?php echo $bookings->Doc_Reference_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Truck_Driver_ID->Visible) { // Truck_Driver_ID ?>
		<td<?php echo $bookings->Truck_Driver_ID->CellAttributes() ?>>
<div<?php echo $bookings->Truck_Driver_ID->ViewAttributes() ?>><?php echo $bookings->Truck_Driver_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Status_ID->Visible) { // Status_ID ?>
		<td<?php echo $bookings->Status_ID->CellAttributes() ?>>
<div<?php echo $bookings->Status_ID->ViewAttributes() ?>><?php echo $bookings->Status_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Unit_ID->Visible) { // Unit_ID ?>
		<td<?php echo $bookings->Unit_ID->CellAttributes() ?>>
<div<?php echo $bookings->Unit_ID->ViewAttributes() ?>><?php echo $bookings->Unit_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Quantity->Visible) { // Quantity ?>
		<td<?php echo $bookings->Quantity->CellAttributes() ?>>
<div<?php echo $bookings->Quantity->ViewAttributes() ?>><?php echo $bookings->Quantity->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Freight->Visible) { // Freight ?>
		<td<?php echo $bookings->Freight->CellAttributes() ?>>
<div<?php echo $bookings->Freight->ViewAttributes() ?>><?php echo $bookings->Freight->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Vat->Visible) { // Vat ?>
		<td<?php echo $bookings->Vat->CellAttributes() ?>>
<div<?php echo $bookings->Vat->ViewAttributes() ?>><?php echo $bookings->Vat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Total_Sales->Visible) { // Total_Sales ?>
		<td<?php echo $bookings->Total_Sales->CellAttributes() ?>>
<div<?php echo $bookings->Total_Sales->ViewAttributes() ?>><?php echo $bookings->Total_Sales->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Wtax->Visible) { // Wtax ?>
		<td<?php echo $bookings->Wtax->CellAttributes() ?>>
<div<?php echo $bookings->Wtax->ViewAttributes() ?>><?php echo $bookings->Wtax->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td<?php echo $bookings->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $bookings->Total_Amount_Due->ViewAttributes() ?>><?php echo $bookings->Total_Amount_Due->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Date_Delivered->Visible) { // Date_Delivered ?>
		<td<?php echo $bookings->Date_Delivered->CellAttributes() ?>>
<div<?php echo $bookings->Date_Delivered->ViewAttributes() ?>><?php echo $bookings->Date_Delivered->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Date_Updated->Visible) { // Date_Updated ?>
		<td<?php echo $bookings->Date_Updated->CellAttributes() ?>>
<div<?php echo $bookings->Date_Updated->ViewAttributes() ?>><?php echo $bookings->Date_Updated->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->Remarks->Visible) { // Remarks ?>
		<td<?php echo $bookings->Remarks->CellAttributes() ?>>
<div<?php echo $bookings->Remarks->ViewAttributes() ?>><?php echo $bookings->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($bookings->User->Visible) { // User ?>
		<td<?php echo $bookings->User->CellAttributes() ?>>
<div<?php echo $bookings->User->ViewAttributes() ?>><?php echo $bookings->User->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bookings_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($bookings->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$bookings->RowType = EW_ROWTYPE_AGGREGATE;
$bookings_list->RenderRow();
?>
<?php if ($bookings_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$bookings_list->RenderListOptions();

// Render list options (footer, left)
$bookings_list->ListOptions->Render("footer", "left");
?>
	<?php if ($bookings->Booking_Number->Visible) { // Booking_Number ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Date->Visible) { // Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Client_ID->Visible) { // Client_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Origin_ID->Visible) { // Origin_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Customer_ID->Visible) { // Customer_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Destination_ID->Visible) { // Destination_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Subcon_ID->Visible) { // Subcon_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Truck_ID->Visible) { // Truck_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->ETD->Visible) { // ETD ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->ETA->Visible) { // ETA ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Billing_Type_ID->Visible) { // Billing_Type_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Doc_Reference_Number->Visible) { // Doc_Reference_Number ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Truck_Driver_ID->Visible) { // Truck_Driver_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Status_ID->Visible) { // Status_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Unit_ID->Visible) { // Unit_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Quantity->Visible) { // Quantity ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $bookings->Quantity->ViewAttributes() ?>><?php echo $bookings->Quantity->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($bookings->Freight->Visible) { // Freight ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $bookings->Freight->ViewAttributes() ?>><?php echo $bookings->Freight->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($bookings->Vat->Visible) { // Vat ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $bookings->Vat->ViewAttributes() ?>><?php echo $bookings->Vat->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($bookings->Total_Sales->Visible) { // Total_Sales ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $bookings->Total_Sales->ViewAttributes() ?>><?php echo $bookings->Total_Sales->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($bookings->Wtax->Visible) { // Wtax ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $bookings->Wtax->ViewAttributes() ?>><?php echo $bookings->Wtax->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($bookings->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $bookings->Total_Amount_Due->ViewAttributes() ?>><?php echo $bookings->Total_Amount_Due->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($bookings->Date_Delivered->Visible) { // Date_Delivered ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Date_Updated->Visible) { // Date_Updated ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->Remarks->Visible) { // Remarks ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($bookings->User->Visible) { // User ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$bookings_list->ListOptions->Render("footer", "right");
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
<?php if ($bookings_list->lTotalRecs > 0) { ?>
<?php if ($bookings->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($bookings->CurrentAction <> "gridadd" && $bookings->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($bookings_list->Pager)) $bookings_list->Pager = new cPrevNextPager($bookings_list->lStartRec, $bookings_list->lDisplayRecs, $bookings_list->lTotalRecs) ?>
<?php if ($bookings_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($bookings_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $bookings_list->PageUrl() ?>start=<?php echo $bookings_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($bookings_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $bookings_list->PageUrl() ?>start=<?php echo $bookings_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $bookings_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($bookings_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $bookings_list->PageUrl() ?>start=<?php echo $bookings_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($bookings_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $bookings_list->PageUrl() ?>start=<?php echo $bookings_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $bookings_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $bookings_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $bookings_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $bookings_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($bookings_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($bookings_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="bookings">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($bookings_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($bookings_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($bookings_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($bookings_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($bookings_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($bookings_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($bookings->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($bookings_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $bookings_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($bookings_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fbookingslist, '<?php echo $bookings_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($bookings->Export == "" && $bookings->CurrentAction == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_Origin_ID','x_Client_ID',bookings_list.ar_x_Origin_ID],
['x_Customer_ID','x_Client_ID',bookings_list.ar_x_Customer_ID],
['x_Destination_ID','x_Client_ID',bookings_list.ar_x_Destination_ID]]);

//-->
</script>
<?php } ?>
<?php if ($bookings->Export == "") { ?>
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
$bookings_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cbookings_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'bookings';

	// Page object name
	var $PageObjName = 'bookings_list';

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
	function cbookings_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (bookings)
		$GLOBALS["bookings"] = new cbookings();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["bookings"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "bookingsdelete.php";
		$this->MultiUpdateUrl = "bookingsupdate.php";

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'bookings', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$bookings->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$bookings->Export = $_POST["exporttype"];
		} else {
			$bookings->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $bookings->Export; // Get export parameter, used in header
		$gsExportFile = $bookings->TableVar; // Get export file, used in header
		if ($bookings->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $bookings;

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
			$bookings->Recordset_SearchValidated();

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
		if ($bookings->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $bookings->getRecordsPerPage(); // Restore from Session
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
		$bookings->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$bookings->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$bookings->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $bookings->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $bookings->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $bookings->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($bookings->getMasterFilter() <> "" && $bookings->getCurrentMasterTable() == "clients") {
			global $clients;
			$rsmaster = $clients->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$bookings->setMasterFilter(""); // Clear master filter
				$bookings->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($bookings->getReturnUrl()); // Return to caller
			} else {
				$clients->LoadListRowValues($rsmaster);
				$clients->RowType = EW_ROWTYPE_MASTER; // Master row
				$clients->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$bookings->setSessionWhere($sFilter);
		$bookings->CurrentFilter = "";

		// Export data only
		if (in_array($bookings->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($bookings->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $bookings;
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
			$bookings->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$bookings->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $bookings;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $bookings->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $bookings->Booking_Number, FALSE); // Booking_Number
		$this->BuildSearchSql($sWhere, $bookings->Date, FALSE); // Date
		$this->BuildSearchSql($sWhere, $bookings->Client_ID, FALSE); // Client_ID
		$this->BuildSearchSql($sWhere, $bookings->Origin_ID, FALSE); // Origin_ID
		$this->BuildSearchSql($sWhere, $bookings->Customer_ID, FALSE); // Customer_ID
		$this->BuildSearchSql($sWhere, $bookings->Destination_ID, FALSE); // Destination_ID
		$this->BuildSearchSql($sWhere, $bookings->Subcon_ID, FALSE); // Subcon_ID
		$this->BuildSearchSql($sWhere, $bookings->Truck_ID, FALSE); // Truck_ID
		$this->BuildSearchSql($sWhere, $bookings->ETD, FALSE); // ETD
		$this->BuildSearchSql($sWhere, $bookings->ETA, FALSE); // ETA
		$this->BuildSearchSql($sWhere, $bookings->Billing_Type_ID, FALSE); // Billing_Type_ID
		$this->BuildSearchSql($sWhere, $bookings->Doc_Reference_Number, FALSE); // Doc_Reference_Number
		$this->BuildSearchSql($sWhere, $bookings->Truck_Driver_ID, FALSE); // Truck_Driver_ID
		$this->BuildSearchSql($sWhere, $bookings->Status_ID, FALSE); // Status_ID
		$this->BuildSearchSql($sWhere, $bookings->Unit_ID, FALSE); // Unit_ID
		$this->BuildSearchSql($sWhere, $bookings->Quantity, FALSE); // Quantity
		$this->BuildSearchSql($sWhere, $bookings->Freight, FALSE); // Freight
		$this->BuildSearchSql($sWhere, $bookings->Vat, FALSE); // Vat
		$this->BuildSearchSql($sWhere, $bookings->Total_Sales, FALSE); // Total_Sales
		$this->BuildSearchSql($sWhere, $bookings->Wtax, FALSE); // Wtax
		$this->BuildSearchSql($sWhere, $bookings->Total_Amount_Due, FALSE); // Total_Amount_Due
		$this->BuildSearchSql($sWhere, $bookings->Date_Delivered, FALSE); // Date_Delivered
		$this->BuildSearchSql($sWhere, $bookings->Date_Updated, FALSE); // Date_Updated
		$this->BuildSearchSql($sWhere, $bookings->Remarks, FALSE); // Remarks
		$this->BuildSearchSql($sWhere, $bookings->User, FALSE); // User

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($bookings->id); // id
			$this->SetSearchParm($bookings->Booking_Number); // Booking_Number
			$this->SetSearchParm($bookings->Date); // Date
			$this->SetSearchParm($bookings->Client_ID); // Client_ID
			$this->SetSearchParm($bookings->Origin_ID); // Origin_ID
			$this->SetSearchParm($bookings->Customer_ID); // Customer_ID
			$this->SetSearchParm($bookings->Destination_ID); // Destination_ID
			$this->SetSearchParm($bookings->Subcon_ID); // Subcon_ID
			$this->SetSearchParm($bookings->Truck_ID); // Truck_ID
			$this->SetSearchParm($bookings->ETD); // ETD
			$this->SetSearchParm($bookings->ETA); // ETA
			$this->SetSearchParm($bookings->Billing_Type_ID); // Billing_Type_ID
			$this->SetSearchParm($bookings->Doc_Reference_Number); // Doc_Reference_Number
			$this->SetSearchParm($bookings->Truck_Driver_ID); // Truck_Driver_ID
			$this->SetSearchParm($bookings->Status_ID); // Status_ID
			$this->SetSearchParm($bookings->Unit_ID); // Unit_ID
			$this->SetSearchParm($bookings->Quantity); // Quantity
			$this->SetSearchParm($bookings->Freight); // Freight
			$this->SetSearchParm($bookings->Vat); // Vat
			$this->SetSearchParm($bookings->Total_Sales); // Total_Sales
			$this->SetSearchParm($bookings->Wtax); // Wtax
			$this->SetSearchParm($bookings->Total_Amount_Due); // Total_Amount_Due
			$this->SetSearchParm($bookings->Date_Delivered); // Date_Delivered
			$this->SetSearchParm($bookings->Date_Updated); // Date_Updated
			$this->SetSearchParm($bookings->Remarks); // Remarks
			$this->SetSearchParm($bookings->User); // User
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
		global $bookings;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$bookings->setAdvancedSearch("x_$FldParm", $FldVal);
		$bookings->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$bookings->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$bookings->setAdvancedSearch("y_$FldParm", $FldVal2);
		$bookings->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $bookings;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $bookings->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $bookings->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $bookings->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $bookings->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $bookings->GetAdvancedSearch("w_$FldParm");
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
		global $bookings;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $bookings->Booking_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $bookings->Doc_Reference_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $bookings->Remarks, $Keyword);
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
		global $Security, $bookings;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $bookings->BasicSearchKeyword;
		$sSearchType = $bookings->BasicSearchType;
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
			$bookings->setSessionBasicSearchKeyword($sSearchKeyword);
			$bookings->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $bookings;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$bookings->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $bookings;
		$bookings->setSessionBasicSearchKeyword("");
		$bookings->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $bookings;
		$bookings->setAdvancedSearch("x_id", "");
		$bookings->setAdvancedSearch("x_Booking_Number", "");
		$bookings->setAdvancedSearch("x_Date", "");
		$bookings->setAdvancedSearch("y_Date", "");
		$bookings->setAdvancedSearch("x_Client_ID", "");
		$bookings->setAdvancedSearch("x_Origin_ID", "");
		$bookings->setAdvancedSearch("x_Customer_ID", "");
		$bookings->setAdvancedSearch("x_Destination_ID", "");
		$bookings->setAdvancedSearch("x_Subcon_ID", "");
		$bookings->setAdvancedSearch("x_Truck_ID", "");
		$bookings->setAdvancedSearch("x_ETD", "");
		$bookings->setAdvancedSearch("y_ETD", "");
		$bookings->setAdvancedSearch("x_ETA", "");
		$bookings->setAdvancedSearch("y_ETA", "");
		$bookings->setAdvancedSearch("x_Billing_Type_ID", "");
		$bookings->setAdvancedSearch("x_Doc_Reference_Number", "");
		$bookings->setAdvancedSearch("x_Truck_Driver_ID", "");
		$bookings->setAdvancedSearch("x_Status_ID", "");
		$bookings->setAdvancedSearch("x_Unit_ID", "");
		$bookings->setAdvancedSearch("x_Quantity", "");
		$bookings->setAdvancedSearch("x_Freight", "");
		$bookings->setAdvancedSearch("x_Vat", "");
		$bookings->setAdvancedSearch("x_Total_Sales", "");
		$bookings->setAdvancedSearch("x_Wtax", "");
		$bookings->setAdvancedSearch("x_Total_Amount_Due", "");
		$bookings->setAdvancedSearch("x_Date_Delivered", "");
		$bookings->setAdvancedSearch("x_Date_Updated", "");
		$bookings->setAdvancedSearch("x_Remarks", "");
		$bookings->setAdvancedSearch("x_User", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $bookings;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Booking_Number"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["y_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Client_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Origin_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Customer_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Destination_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Subcon_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Truck_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ETD"] <> "") $bRestore = FALSE;
		if (@$_GET["y_ETD"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ETA"] <> "") $bRestore = FALSE;
		if (@$_GET["y_ETA"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Billing_Type_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Doc_Reference_Number"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Truck_Driver_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Status_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Unit_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Quantity"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Freight"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Vat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Sales"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Wtax"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Amount_Due"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Date_Delivered"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Date_Updated"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		if (@$_GET["x_User"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$bookings->BasicSearchKeyword = $bookings->getSessionBasicSearchKeyword();
			$bookings->BasicSearchType = $bookings->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($bookings->id);
			$this->GetSearchParm($bookings->Booking_Number);
			$this->GetSearchParm($bookings->Date);
			$this->GetSearchParm($bookings->Client_ID);
			$this->GetSearchParm($bookings->Origin_ID);
			$this->GetSearchParm($bookings->Customer_ID);
			$this->GetSearchParm($bookings->Destination_ID);
			$this->GetSearchParm($bookings->Subcon_ID);
			$this->GetSearchParm($bookings->Truck_ID);
			$this->GetSearchParm($bookings->ETD);
			$this->GetSearchParm($bookings->ETA);
			$this->GetSearchParm($bookings->Billing_Type_ID);
			$this->GetSearchParm($bookings->Doc_Reference_Number);
			$this->GetSearchParm($bookings->Truck_Driver_ID);
			$this->GetSearchParm($bookings->Status_ID);
			$this->GetSearchParm($bookings->Unit_ID);
			$this->GetSearchParm($bookings->Quantity);
			$this->GetSearchParm($bookings->Freight);
			$this->GetSearchParm($bookings->Vat);
			$this->GetSearchParm($bookings->Total_Sales);
			$this->GetSearchParm($bookings->Wtax);
			$this->GetSearchParm($bookings->Total_Amount_Due);
			$this->GetSearchParm($bookings->Date_Delivered);
			$this->GetSearchParm($bookings->Date_Updated);
			$this->GetSearchParm($bookings->Remarks);
			$this->GetSearchParm($bookings->User);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $bookings;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$bookings->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$bookings->CurrentOrderType = @$_GET["ordertype"];
			$bookings->UpdateSort($bookings->Booking_Number); // Booking_Number
			$bookings->UpdateSort($bookings->Date); // Date
			$bookings->UpdateSort($bookings->Client_ID); // Client_ID
			$bookings->UpdateSort($bookings->Origin_ID); // Origin_ID
			$bookings->UpdateSort($bookings->Customer_ID); // Customer_ID
			$bookings->UpdateSort($bookings->Destination_ID); // Destination_ID
			$bookings->UpdateSort($bookings->Subcon_ID); // Subcon_ID
			$bookings->UpdateSort($bookings->Truck_ID); // Truck_ID
			$bookings->UpdateSort($bookings->ETD); // ETD
			$bookings->UpdateSort($bookings->ETA); // ETA
			$bookings->UpdateSort($bookings->Billing_Type_ID); // Billing_Type_ID
			$bookings->UpdateSort($bookings->Doc_Reference_Number); // Doc_Reference_Number
			$bookings->UpdateSort($bookings->Truck_Driver_ID); // Truck_Driver_ID
			$bookings->UpdateSort($bookings->Status_ID); // Status_ID
			$bookings->UpdateSort($bookings->Unit_ID); // Unit_ID
			$bookings->UpdateSort($bookings->Quantity); // Quantity
			$bookings->UpdateSort($bookings->Freight); // Freight
			$bookings->UpdateSort($bookings->Vat); // Vat
			$bookings->UpdateSort($bookings->Total_Sales); // Total_Sales
			$bookings->UpdateSort($bookings->Wtax); // Wtax
			$bookings->UpdateSort($bookings->Total_Amount_Due); // Total_Amount_Due
			$bookings->UpdateSort($bookings->Date_Delivered); // Date_Delivered
			$bookings->UpdateSort($bookings->Date_Updated); // Date_Updated
			$bookings->UpdateSort($bookings->Remarks); // Remarks
			$bookings->UpdateSort($bookings->User); // User
			$bookings->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $bookings;
		$sOrderBy = $bookings->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($bookings->SqlOrderBy() <> "") {
				$sOrderBy = $bookings->SqlOrderBy();
				$bookings->setSessionOrderBy($sOrderBy);
				$bookings->Date->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $bookings;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$bookings->getCurrentMasterTable = ""; // Clear master table
				$bookings->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$bookings->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$bookings->Client_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$bookings->setSessionOrderBy($sOrderBy);
				$bookings->Booking_Number->setSort("");
				$bookings->Date->setSort("");
				$bookings->Client_ID->setSort("");
				$bookings->Origin_ID->setSort("");
				$bookings->Customer_ID->setSort("");
				$bookings->Destination_ID->setSort("");
				$bookings->Subcon_ID->setSort("");
				$bookings->Truck_ID->setSort("");
				$bookings->ETD->setSort("");
				$bookings->ETA->setSort("");
				$bookings->Billing_Type_ID->setSort("");
				$bookings->Doc_Reference_Number->setSort("");
				$bookings->Truck_Driver_ID->setSort("");
				$bookings->Status_ID->setSort("");
				$bookings->Unit_ID->setSort("");
				$bookings->Quantity->setSort("");
				$bookings->Freight->setSort("");
				$bookings->Vat->setSort("");
				$bookings->Total_Sales->setSort("");
				$bookings->Wtax->setSort("");
				$bookings->Total_Amount_Due->setSort("");
				$bookings->Date_Delivered->setSort("");
				$bookings->Date_Updated->setSort("");
				$bookings->Remarks->setSort("");
				$bookings->User->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$bookings->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $bookings;

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

		// "detail_file_uploads"
		$this->ListOptions->Add("detail_file_uploads");
		$item =& $this->ListOptions->Items["detail_file_uploads"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('file_uploads');
		$item->OnLeft = FALSE;

		// "detail_expenses"
		$this->ListOptions->Add("detail_expenses");
		$item =& $this->ListOptions->Items["detail_expenses"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('expenses');
		$item->OnLeft = FALSE;

		// "detail_booking_helpers"
		$this->ListOptions->Add("detail_booking_helpers");
		$item =& $this->ListOptions->Items["detail_booking_helpers"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('booking_helpers');
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"bookings_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($bookings->Export <> "" ||
			$bookings->CurrentAction == "gridadd" ||
			$bookings->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $bookings;
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

		// "detail_file_uploads"
		$oListOpt =& $this->ListOptions->Items["detail_file_uploads"];
		if ($Security->AllowList('file_uploads')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("file_uploads", "TblCaption");
			$oListOpt->Body = "<a href=\"file_uploadslist.php?" . EW_TABLE_SHOW_MASTER . "=bookings&id=" . urlencode(strval($bookings->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_expenses"
		$oListOpt =& $this->ListOptions->Items["detail_expenses"];
		if ($Security->AllowList('expenses')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("expenses", "TblCaption");
			$oListOpt->Body = "<a href=\"expenseslist.php?" . EW_TABLE_SHOW_MASTER . "=bookings&id=" . urlencode(strval($bookings->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_booking_helpers"
		$oListOpt =& $this->ListOptions->Items["detail_booking_helpers"];
		if ($Security->AllowList('booking_helpers')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("booking_helpers", "TblCaption");
			$oListOpt->Body = "<a href=\"booking_helperslist.php?" . EW_TABLE_SHOW_MASTER . "=bookings&id=" . urlencode(strval($bookings->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($bookings->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $bookings;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $bookings;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$bookings->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$bookings->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $bookings->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$bookings->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$bookings->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$bookings->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $bookings;
		$bookings->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$bookings->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $bookings;

		// Load search values
		// id

		$bookings->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$bookings->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Booking_Number
		$bookings->Booking_Number->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Booking_Number"]);
		$bookings->Booking_Number->AdvancedSearch->SearchOperator = @$_GET["z_Booking_Number"];

		// Date
		$bookings->Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Date"]);
		$bookings->Date->AdvancedSearch->SearchOperator = @$_GET["z_Date"];
		$bookings->Date->AdvancedSearch->SearchCondition = @$_GET["v_Date"];
		$bookings->Date->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_Date"]);
		$bookings->Date->AdvancedSearch->SearchOperator2 = @$_GET["w_Date"];

		// Client_ID
		$bookings->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Client_ID"]);
		$bookings->Client_ID->AdvancedSearch->SearchOperator = @$_GET["z_Client_ID"];

		// Origin_ID
		$bookings->Origin_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Origin_ID"]);
		$bookings->Origin_ID->AdvancedSearch->SearchOperator = @$_GET["z_Origin_ID"];

		// Customer_ID
		$bookings->Customer_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Customer_ID"]);
		$bookings->Customer_ID->AdvancedSearch->SearchOperator = @$_GET["z_Customer_ID"];

		// Destination_ID
		$bookings->Destination_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Destination_ID"]);
		$bookings->Destination_ID->AdvancedSearch->SearchOperator = @$_GET["z_Destination_ID"];

		// Subcon_ID
		$bookings->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Subcon_ID"]);
		$bookings->Subcon_ID->AdvancedSearch->SearchOperator = @$_GET["z_Subcon_ID"];

		// Truck_ID
		$bookings->Truck_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Truck_ID"]);
		$bookings->Truck_ID->AdvancedSearch->SearchOperator = @$_GET["z_Truck_ID"];

		// ETD
		$bookings->ETD->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ETD"]);
		$bookings->ETD->AdvancedSearch->SearchOperator = @$_GET["z_ETD"];
		$bookings->ETD->AdvancedSearch->SearchCondition = @$_GET["v_ETD"];
		$bookings->ETD->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_ETD"]);
		$bookings->ETD->AdvancedSearch->SearchOperator2 = @$_GET["w_ETD"];

		// ETA
		$bookings->ETA->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ETA"]);
		$bookings->ETA->AdvancedSearch->SearchOperator = @$_GET["z_ETA"];
		$bookings->ETA->AdvancedSearch->SearchCondition = @$_GET["v_ETA"];
		$bookings->ETA->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_ETA"]);
		$bookings->ETA->AdvancedSearch->SearchOperator2 = @$_GET["w_ETA"];

		// Billing_Type_ID
		$bookings->Billing_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Billing_Type_ID"]);
		$bookings->Billing_Type_ID->AdvancedSearch->SearchOperator = @$_GET["z_Billing_Type_ID"];

		// Doc_Reference_Number
		$bookings->Doc_Reference_Number->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Doc_Reference_Number"]);
		$bookings->Doc_Reference_Number->AdvancedSearch->SearchOperator = @$_GET["z_Doc_Reference_Number"];

		// Truck_Driver_ID
		$bookings->Truck_Driver_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Truck_Driver_ID"]);
		$bookings->Truck_Driver_ID->AdvancedSearch->SearchOperator = @$_GET["z_Truck_Driver_ID"];

		// Status_ID
		$bookings->Status_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Status_ID"]);
		$bookings->Status_ID->AdvancedSearch->SearchOperator = @$_GET["z_Status_ID"];

		// Unit_ID
		$bookings->Unit_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Unit_ID"]);
		$bookings->Unit_ID->AdvancedSearch->SearchOperator = @$_GET["z_Unit_ID"];

		// Quantity
		$bookings->Quantity->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Quantity"]);
		$bookings->Quantity->AdvancedSearch->SearchOperator = @$_GET["z_Quantity"];

		// Freight
		$bookings->Freight->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Freight"]);
		$bookings->Freight->AdvancedSearch->SearchOperator = @$_GET["z_Freight"];

		// Vat
		$bookings->Vat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Vat"]);
		$bookings->Vat->AdvancedSearch->SearchOperator = @$_GET["z_Vat"];

		// Total_Sales
		$bookings->Total_Sales->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Sales"]);
		$bookings->Total_Sales->AdvancedSearch->SearchOperator = @$_GET["z_Total_Sales"];

		// Wtax
		$bookings->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Wtax"]);
		$bookings->Wtax->AdvancedSearch->SearchOperator = @$_GET["z_Wtax"];

		// Total_Amount_Due
		$bookings->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Amount_Due"]);
		$bookings->Total_Amount_Due->AdvancedSearch->SearchOperator = @$_GET["z_Total_Amount_Due"];

		// Date_Delivered
		$bookings->Date_Delivered->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Date_Delivered"]);
		$bookings->Date_Delivered->AdvancedSearch->SearchOperator = @$_GET["z_Date_Delivered"];

		// Date_Updated
		$bookings->Date_Updated->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Date_Updated"]);
		$bookings->Date_Updated->AdvancedSearch->SearchOperator = @$_GET["z_Date_Updated"];

		// Remarks
		$bookings->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$bookings->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];

		// User
		$bookings->User->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_User"]);
		$bookings->User->AdvancedSearch->SearchOperator = @$_GET["z_User"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $bookings;

		// Call Recordset Selecting event
		$bookings->Recordset_Selecting($bookings->CurrentFilter);

		// Load List page SQL
		$sSql = $bookings->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$bookings->Recordset_Selected($rs);
		return $rs;
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
		$this->ViewUrl = $bookings->ViewUrl();
		$this->EditUrl = $bookings->EditUrl();
		$this->InlineEditUrl = $bookings->InlineEditUrl();
		$this->CopyUrl = $bookings->CopyUrl();
		$this->InlineCopyUrl = $bookings->InlineCopyUrl();
		$this->DeleteUrl = $bookings->DeleteUrl();

		// Call Row_Rendering event
		$bookings->Row_Rendering();

		// Common render codes for all row types
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

		// Accumulate aggregate value
		if ($bookings->RowType <> EW_ROWTYPE_AGGREGATEINIT && $bookings->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($bookings->Quantity->CurrentValue))
				$bookings->Quantity->Total += $bookings->Quantity->CurrentValue; // Accumulate total
			if (is_numeric($bookings->Freight->CurrentValue))
				$bookings->Freight->Total += $bookings->Freight->CurrentValue; // Accumulate total
			if (is_numeric($bookings->Vat->CurrentValue))
				$bookings->Vat->Total += $bookings->Vat->CurrentValue; // Accumulate total
			if (is_numeric($bookings->Total_Sales->CurrentValue))
				$bookings->Total_Sales->Total += $bookings->Total_Sales->CurrentValue; // Accumulate total
			if (is_numeric($bookings->Wtax->CurrentValue))
				$bookings->Wtax->Total += $bookings->Wtax->CurrentValue; // Accumulate total
			if (is_numeric($bookings->Total_Amount_Due->CurrentValue))
				$bookings->Total_Amount_Due->Total += $bookings->Total_Amount_Due->CurrentValue; // Accumulate total
		}
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
		} elseif ($bookings->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$bookings->Quantity->Total = 0; // Initialize total
			$bookings->Freight->Total = 0; // Initialize total
			$bookings->Vat->Total = 0; // Initialize total
			$bookings->Total_Sales->Total = 0; // Initialize total
			$bookings->Wtax->Total = 0; // Initialize total
			$bookings->Total_Amount_Due->Total = 0; // Initialize total
		} elseif ($bookings->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$bookings->Quantity->CurrentValue = $bookings->Quantity->Total;
			$bookings->Quantity->ViewValue = $bookings->Quantity->CurrentValue;
			$bookings->Quantity->ViewValue = ew_FormatNumber($bookings->Quantity->ViewValue, 2, -2, -2, -2);
			$bookings->Quantity->CssStyle = "";
			$bookings->Quantity->CssClass = "";
			$bookings->Quantity->ViewCustomAttributes = "";
			$bookings->Quantity->HrefValue = ""; // Clear href value
			$bookings->Freight->CurrentValue = $bookings->Freight->Total;
			$bookings->Freight->ViewValue = $bookings->Freight->CurrentValue;
			$bookings->Freight->ViewValue = ew_FormatNumber($bookings->Freight->ViewValue, 2, -2, -2, -2);
			$bookings->Freight->CssStyle = "";
			$bookings->Freight->CssClass = "";
			$bookings->Freight->ViewCustomAttributes = "";
			$bookings->Freight->HrefValue = ""; // Clear href value
			$bookings->Vat->CurrentValue = $bookings->Vat->Total;
			$bookings->Vat->ViewValue = $bookings->Vat->CurrentValue;
			$bookings->Vat->ViewValue = ew_FormatNumber($bookings->Vat->ViewValue, 2, -2, -2, -2);
			$bookings->Vat->CssStyle = "";
			$bookings->Vat->CssClass = "";
			$bookings->Vat->ViewCustomAttributes = "";
			$bookings->Vat->HrefValue = ""; // Clear href value
			$bookings->Total_Sales->CurrentValue = $bookings->Total_Sales->Total;
			$bookings->Total_Sales->ViewValue = $bookings->Total_Sales->CurrentValue;
			$bookings->Total_Sales->ViewValue = ew_FormatNumber($bookings->Total_Sales->ViewValue, 2, -2, -2, -2);
			$bookings->Total_Sales->CssStyle = "";
			$bookings->Total_Sales->CssClass = "";
			$bookings->Total_Sales->ViewCustomAttributes = "";
			$bookings->Total_Sales->HrefValue = ""; // Clear href value
			$bookings->Wtax->CurrentValue = $bookings->Wtax->Total;
			$bookings->Wtax->ViewValue = $bookings->Wtax->CurrentValue;
			$bookings->Wtax->ViewValue = ew_FormatNumber($bookings->Wtax->ViewValue, 2, -2, -2, -2);
			$bookings->Wtax->CssStyle = "";
			$bookings->Wtax->CssClass = "";
			$bookings->Wtax->ViewCustomAttributes = "";
			$bookings->Wtax->HrefValue = ""; // Clear href value
			$bookings->Total_Amount_Due->CurrentValue = $bookings->Total_Amount_Due->Total;
			$bookings->Total_Amount_Due->ViewValue = $bookings->Total_Amount_Due->CurrentValue;
			$bookings->Total_Amount_Due->ViewValue = ew_FormatNumber($bookings->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$bookings->Total_Amount_Due->CssStyle = "";
			$bookings->Total_Amount_Due->CssClass = "";
			$bookings->Total_Amount_Due->ViewCustomAttributes = "";
			$bookings->Total_Amount_Due->HrefValue = ""; // Clear href value
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $bookings;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $bookings->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Initialize aggregates
		$bookings->RowType = EW_ROWTYPE_AGGREGATEINIT;
		$this->RenderRow();

		// Export all
		if ($bookings->ExportAll) {
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
		if ($bookings->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($bookings, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($bookings->id);
				$ExportDoc->ExportCaption($bookings->Booking_Number);
				$ExportDoc->ExportCaption($bookings->Date);
				$ExportDoc->ExportCaption($bookings->Client_ID);
				$ExportDoc->ExportCaption($bookings->Origin_ID);
				$ExportDoc->ExportCaption($bookings->Customer_ID);
				$ExportDoc->ExportCaption($bookings->Destination_ID);
				$ExportDoc->ExportCaption($bookings->Subcon_ID);
				$ExportDoc->ExportCaption($bookings->Truck_ID);
				$ExportDoc->ExportCaption($bookings->ETD);
				$ExportDoc->ExportCaption($bookings->ETA);
				$ExportDoc->ExportCaption($bookings->Billing_Type_ID);
				$ExportDoc->ExportCaption($bookings->Doc_Reference_Number);
				$ExportDoc->ExportCaption($bookings->Truck_Driver_ID);
				$ExportDoc->ExportCaption($bookings->Status_ID);
				$ExportDoc->ExportCaption($bookings->Unit_ID);
				$ExportDoc->ExportCaption($bookings->Quantity);
				$ExportDoc->ExportCaption($bookings->Freight);
				$ExportDoc->ExportCaption($bookings->Vat);
				$ExportDoc->ExportCaption($bookings->Total_Sales);
				$ExportDoc->ExportCaption($bookings->Wtax);
				$ExportDoc->ExportCaption($bookings->Total_Amount_Due);
				$ExportDoc->ExportCaption($bookings->Date_Delivered);
				$ExportDoc->ExportCaption($bookings->Date_Updated);
				$ExportDoc->ExportCaption($bookings->Remarks);
				$ExportDoc->ExportCaption($bookings->User);
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
				$bookings->CssClass = "";
				$bookings->CssStyle = "";
				$bookings->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($bookings->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $bookings->id->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Booking_Number', $bookings->Booking_Number->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Date', $bookings->Date->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Client_ID', $bookings->Client_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Origin_ID', $bookings->Origin_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Customer_ID', $bookings->Customer_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Destination_ID', $bookings->Destination_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Subcon_ID', $bookings->Subcon_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Truck_ID', $bookings->Truck_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('ETD', $bookings->ETD->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('ETA', $bookings->ETA->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Billing_Type_ID', $bookings->Billing_Type_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Doc_Reference_Number', $bookings->Doc_Reference_Number->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Truck_Driver_ID', $bookings->Truck_Driver_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Status_ID', $bookings->Status_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Unit_ID', $bookings->Unit_ID->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Quantity', $bookings->Quantity->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Freight', $bookings->Freight->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Vat', $bookings->Vat->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Total_Sales', $bookings->Total_Sales->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Wtax', $bookings->Wtax->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Total_Amount_Due', $bookings->Total_Amount_Due->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Date_Delivered', $bookings->Date_Delivered->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Date_Updated', $bookings->Date_Updated->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('Remarks', $bookings->Remarks->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
					$XmlDoc->AddField('User', $bookings->User->ExportValue($bookings->Export, $bookings->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($bookings->id);
					$ExportDoc->ExportField($bookings->Booking_Number);
					$ExportDoc->ExportField($bookings->Date);
					$ExportDoc->ExportField($bookings->Client_ID);
					$ExportDoc->ExportField($bookings->Origin_ID);
					$ExportDoc->ExportField($bookings->Customer_ID);
					$ExportDoc->ExportField($bookings->Destination_ID);
					$ExportDoc->ExportField($bookings->Subcon_ID);
					$ExportDoc->ExportField($bookings->Truck_ID);
					$ExportDoc->ExportField($bookings->ETD);
					$ExportDoc->ExportField($bookings->ETA);
					$ExportDoc->ExportField($bookings->Billing_Type_ID);
					$ExportDoc->ExportField($bookings->Doc_Reference_Number);
					$ExportDoc->ExportField($bookings->Truck_Driver_ID);
					$ExportDoc->ExportField($bookings->Status_ID);
					$ExportDoc->ExportField($bookings->Unit_ID);
					$ExportDoc->ExportField($bookings->Quantity);
					$ExportDoc->ExportField($bookings->Freight);
					$ExportDoc->ExportField($bookings->Vat);
					$ExportDoc->ExportField($bookings->Total_Sales);
					$ExportDoc->ExportField($bookings->Wtax);
					$ExportDoc->ExportField($bookings->Total_Amount_Due);
					$ExportDoc->ExportField($bookings->Date_Delivered);
					$ExportDoc->ExportField($bookings->Date_Updated);
					$ExportDoc->ExportField($bookings->Remarks);
					$ExportDoc->ExportField($bookings->User);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}

		// Export aggregates (non-XML and horizontal format only)
		if ($bookings->Export <> "xml" && $ExportDoc->Horizontal) {
			$bookings->RowType = EW_ROWTYPE_AGGREGATE;
			$this->RenderRow();
			$ExportDoc->BeginExportRow();
			$ExportDoc->ExportAggregate($bookings->id, '');
			$ExportDoc->ExportAggregate($bookings->Booking_Number, '');
			$ExportDoc->ExportAggregate($bookings->Date, '');
			$ExportDoc->ExportAggregate($bookings->Client_ID, '');
			$ExportDoc->ExportAggregate($bookings->Origin_ID, '');
			$ExportDoc->ExportAggregate($bookings->Customer_ID, '');
			$ExportDoc->ExportAggregate($bookings->Destination_ID, '');
			$ExportDoc->ExportAggregate($bookings->Subcon_ID, '');
			$ExportDoc->ExportAggregate($bookings->Truck_ID, '');
			$ExportDoc->ExportAggregate($bookings->ETD, '');
			$ExportDoc->ExportAggregate($bookings->ETA, '');
			$ExportDoc->ExportAggregate($bookings->Billing_Type_ID, '');
			$ExportDoc->ExportAggregate($bookings->Doc_Reference_Number, '');
			$ExportDoc->ExportAggregate($bookings->Truck_Driver_ID, '');
			$ExportDoc->ExportAggregate($bookings->Status_ID, '');
			$ExportDoc->ExportAggregate($bookings->Unit_ID, '');
			$ExportDoc->ExportAggregate($bookings->Quantity, 'TOTAL');
			$ExportDoc->ExportAggregate($bookings->Freight, 'TOTAL');
			$ExportDoc->ExportAggregate($bookings->Vat, 'TOTAL');
			$ExportDoc->ExportAggregate($bookings->Total_Sales, 'TOTAL');
			$ExportDoc->ExportAggregate($bookings->Wtax, 'TOTAL');
			$ExportDoc->ExportAggregate($bookings->Total_Amount_Due, 'TOTAL');
			$ExportDoc->ExportAggregate($bookings->Date_Delivered, '');
			$ExportDoc->ExportAggregate($bookings->Date_Updated, '');
			$ExportDoc->ExportAggregate($bookings->Remarks, '');
			$ExportDoc->ExportAggregate($bookings->User, '');
			$ExportDoc->EndExportRow();
		}
		if ($bookings->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($bookings->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($bookings->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($bookings->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($bookings->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
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
