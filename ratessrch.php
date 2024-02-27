<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "ratesinfo.php" ?>
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
$rates_search = new crates_search();
$Page =& $rates_search;

// Page init
$rates_search->Page_Init();

// Page main
$rates_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var rates_search = new ew_Page("rates_search");

// page properties
rates_search.PageID = "search"; // page ID
rates_search.FormID = "fratessearch"; // form ID
var EW_PAGE_ID = rates_search.PageID; // for backward compatibility

// extend page with validate function for search
rates_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Freight_Rate"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Freight_Rate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Vat"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Vat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Wtax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Wtax->FldErrMsg()) ?>");

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
rates_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
rates_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
rates_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rates_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rates->TableCaption() ?><br><br>
<a href="<?php echo $rates->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$rates_search->ShowMessage();
?>
<form name="fratessearch" id="fratessearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return rates_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="rates">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $rates->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->id->FldCaption() ?></td>
		<td<?php echo $rates->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $rates->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $rates->id->FldTitle() ?>" value="<?php echo $rates->id->EditValue ?>"<?php echo $rates->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $rates->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Date->FldCaption() ?></td>
		<td<?php echo $rates->Date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Date" id="z_Date" value="BETWEEN"></span></td>
		<td<?php echo $rates->Date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Date" id="x_Date" title="<?php echo $rates->Date->FldTitle() ?>" value="<?php echo $rates->Date->EditValue ?>"<?php echo $rates->Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date" name="cal_x_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Date" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw1_Date" name="btw1_Date">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_Date" name="btw1_Date">
<input type="text" name="y_Date" id="y_Date" title="<?php echo $rates->Date->FldTitle() ?>" value="<?php echo $rates->Date->EditValue2 ?>"<?php echo $rates->Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_Date" name="cal_y_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_y_Date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $rates->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Client_ID->FldCaption() ?></td>
		<td<?php echo $rates->Client_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td<?php echo $rates->Client_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php $rates->Client_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Origin_ID','x_Client_ID',rates_search.ar_x_Origin_ID);ew_UpdateOpt('x_Destination_ID','x_Client_ID',rates_search.ar_x_Destination_ID); " . @$rates->Client_ID->EditAttrs["onchange"]; ?>
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $rates->Client_ID->FldTitle() ?>"<?php echo $rates->Client_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Client_ID->EditValue)) {
	$arwrk = $rates->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Client_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $rates->Area_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Area_ID->FldCaption() ?></td>
		<td<?php echo $rates->Area_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Area_ID" id="z_Area_ID" value="="></span></td>
		<td<?php echo $rates->Area_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Area_ID" name="x_Area_ID" title="<?php echo $rates->Area_ID->FldTitle() ?>"<?php echo $rates->Area_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Area_ID->EditValue)) {
	$arwrk = $rates->Area_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Area_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $rates->Origin_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Origin_ID->FldCaption() ?></td>
		<td<?php echo $rates->Origin_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Origin_ID" id="z_Origin_ID" value="="></span></td>
		<td<?php echo $rates->Origin_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Origin_ID" name="x_Origin_ID" title="<?php echo $rates->Origin_ID->FldTitle() ?>"<?php echo $rates->Origin_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Origin_ID->EditValue)) {
	$arwrk = $rates->Origin_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Origin_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($rates->Origin_ID->EditValue)) {
	$arwrk = $rates->Origin_ID->EditValue;
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
rates_search.ar_x_Origin_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $rates->Destination_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Destination_ID->FldCaption() ?></td>
		<td<?php echo $rates->Destination_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Destination_ID" id="z_Destination_ID" value="="></span></td>
		<td<?php echo $rates->Destination_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Destination_ID" name="x_Destination_ID" title="<?php echo $rates->Destination_ID->FldTitle() ?>"<?php echo $rates->Destination_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Destination_ID->EditValue)) {
	$arwrk = $rates->Destination_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Destination_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($rates->Destination_ID->EditValue)) {
	$arwrk = $rates->Destination_ID->EditValue;
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
rates_search.ar_x_Destination_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $rates->Distance->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Distance->FldCaption() ?></td>
		<td<?php echo $rates->Distance->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Distance" id="z_Distance" value="LIKE"></span></td>
		<td<?php echo $rates->Distance->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Distance" id="x_Distance" title="<?php echo $rates->Distance->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $rates->Distance->EditValue ?>"<?php echo $rates->Distance->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $rates->Truck_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Truck_Type_ID->FldCaption() ?></td>
		<td<?php echo $rates->Truck_Type_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_Type_ID" id="z_Truck_Type_ID" value="="></span></td>
		<td<?php echo $rates->Truck_Type_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Truck_Type_ID" name="x_Truck_Type_ID" title="<?php echo $rates->Truck_Type_ID->FldTitle() ?>"<?php echo $rates->Truck_Type_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Truck_Type_ID->EditValue)) {
	$arwrk = $rates->Truck_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Truck_Type_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $rates->Unit_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Unit_ID->FldCaption() ?></td>
		<td<?php echo $rates->Unit_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Unit_ID" id="z_Unit_ID" value="="></span></td>
		<td<?php echo $rates->Unit_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Unit_ID" name="x_Unit_ID" title="<?php echo $rates->Unit_ID->FldTitle() ?>"<?php echo $rates->Unit_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Unit_ID->EditValue)) {
	$arwrk = $rates->Unit_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Unit_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $rates->Freight_Rate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Freight_Rate->FldCaption() ?></td>
		<td<?php echo $rates->Freight_Rate->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Freight_Rate" id="z_Freight_Rate" value="="></span></td>
		<td<?php echo $rates->Freight_Rate->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Freight_Rate" id="x_Freight_Rate" title="<?php echo $rates->Freight_Rate->FldTitle() ?>" size="30" value="<?php echo $rates->Freight_Rate->EditValue ?>"<?php echo $rates->Freight_Rate->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $rates->Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Vat->FldCaption() ?></td>
		<td<?php echo $rates->Vat->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Vat" id="z_Vat" value="="></span></td>
		<td<?php echo $rates->Vat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Vat" id="x_Vat" title="<?php echo $rates->Vat->FldTitle() ?>" size="30" maxlength="5" value="<?php echo $rates->Vat->EditValue ?>"<?php echo $rates->Vat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $rates->Wtax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Wtax->FldCaption() ?></td>
		<td<?php echo $rates->Wtax->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Wtax" id="z_Wtax" value="="></span></td>
		<td<?php echo $rates->Wtax->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Wtax" id="x_Wtax" title="<?php echo $rates->Wtax->FldTitle() ?>" size="30" value="<?php echo $rates->Wtax->EditValue ?>"<?php echo $rates->Wtax->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $rates->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Remarks->FldCaption() ?></td>
		<td<?php echo $rates->Remarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE"></span></td>
		<td<?php echo $rates->Remarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $rates->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $rates->Remarks->EditAttributes() ?>><?php echo $rates->Remarks->EditValue ?></textarea>
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
ew_UpdateOpts([['x_Origin_ID','x_Client_ID',rates_search.ar_x_Origin_ID],
['x_Destination_ID','x_Client_ID',rates_search.ar_x_Destination_ID]]);

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
$rates_search->Page_Terminate();
?>
<?php

//
// Page class
//
class crates_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'rates';

	// Page object name
	var $PageObjName = 'rates_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rates;
		if ($rates->UseTokenInUrl) $PageUrl .= "t=" . $rates->TableVar . "&"; // Add page token
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
		global $objForm, $rates;
		if ($rates->UseTokenInUrl) {
			if ($objForm)
				return ($rates->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rates->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crates_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (rates)
		$GLOBALS["rates"] = new crates();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rates', TRUE);

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
		global $rates;

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
			$this->Page_Terminate("rateslist.php");
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
		global $objForm, $Language, $gsSearchError, $rates;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$rates->CurrentAction = $objForm->GetValue("a_search");
			switch ($rates->CurrentAction) {
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
						$sSrchStr = $rates->UrlParm($sSrchStr);
						$this->Page_Terminate("rateslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$rates->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $rates;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $rates->id); // id
	$this->BuildSearchUrl($sSrchUrl, $rates->Date); // Date
	$this->BuildSearchUrl($sSrchUrl, $rates->Client_ID); // Client_ID
	$this->BuildSearchUrl($sSrchUrl, $rates->Area_ID); // Area_ID
	$this->BuildSearchUrl($sSrchUrl, $rates->Origin_ID); // Origin_ID
	$this->BuildSearchUrl($sSrchUrl, $rates->Destination_ID); // Destination_ID
	$this->BuildSearchUrl($sSrchUrl, $rates->Distance); // Distance
	$this->BuildSearchUrl($sSrchUrl, $rates->Truck_Type_ID); // Truck_Type_ID
	$this->BuildSearchUrl($sSrchUrl, $rates->Unit_ID); // Unit_ID
	$this->BuildSearchUrl($sSrchUrl, $rates->Freight_Rate); // Freight_Rate
	$this->BuildSearchUrl($sSrchUrl, $rates->Vat); // Vat
	$this->BuildSearchUrl($sSrchUrl, $rates->Wtax); // Wtax
	$this->BuildSearchUrl($sSrchUrl, $rates->Remarks); // Remarks
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
		global $objForm, $rates;

		// Load search values
		// id

		$rates->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$rates->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// Date
		$rates->Date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Date"));
		$rates->Date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Date");
		$rates->Date->AdvancedSearch->SearchCondition = $objForm->GetValue("v_Date");
		$rates->Date->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_Date"));
		$rates->Date->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_Date");

		// Client_ID
		$rates->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Client_ID"));
		$rates->Client_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Client_ID");

		// Area_ID
		$rates->Area_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Area_ID"));
		$rates->Area_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Area_ID");

		// Origin_ID
		$rates->Origin_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Origin_ID"));
		$rates->Origin_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Origin_ID");

		// Destination_ID
		$rates->Destination_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Destination_ID"));
		$rates->Destination_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Destination_ID");

		// Distance
		$rates->Distance->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Distance"));
		$rates->Distance->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Distance");

		// Truck_Type_ID
		$rates->Truck_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Truck_Type_ID"));
		$rates->Truck_Type_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Truck_Type_ID");

		// Unit_ID
		$rates->Unit_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Unit_ID"));
		$rates->Unit_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Unit_ID");

		// Freight_Rate
		$rates->Freight_Rate->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Freight_Rate"));
		$rates->Freight_Rate->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Freight_Rate");

		// Vat
		$rates->Vat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Vat"));
		$rates->Vat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Vat");

		// Wtax
		$rates->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Wtax"));
		$rates->Wtax->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Wtax");

		// Remarks
		$rates->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Remarks"));
		$rates->Remarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Remarks");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rates;

		// Initialize URLs
		// Call Row_Rendering event

		$rates->Row_Rendering();

		// Common render codes for all row types
		// id

		$rates->id->CellCssStyle = ""; $rates->id->CellCssClass = "";
		$rates->id->CellAttrs = array(); $rates->id->ViewAttrs = array(); $rates->id->EditAttrs = array();

		// Date
		$rates->Date->CellCssStyle = ""; $rates->Date->CellCssClass = "";
		$rates->Date->CellAttrs = array(); $rates->Date->ViewAttrs = array(); $rates->Date->EditAttrs = array();

		// Client_ID
		$rates->Client_ID->CellCssStyle = ""; $rates->Client_ID->CellCssClass = "";
		$rates->Client_ID->CellAttrs = array(); $rates->Client_ID->ViewAttrs = array(); $rates->Client_ID->EditAttrs = array();

		// Area_ID
		$rates->Area_ID->CellCssStyle = ""; $rates->Area_ID->CellCssClass = "";
		$rates->Area_ID->CellAttrs = array(); $rates->Area_ID->ViewAttrs = array(); $rates->Area_ID->EditAttrs = array();

		// Origin_ID
		$rates->Origin_ID->CellCssStyle = ""; $rates->Origin_ID->CellCssClass = "";
		$rates->Origin_ID->CellAttrs = array(); $rates->Origin_ID->ViewAttrs = array(); $rates->Origin_ID->EditAttrs = array();

		// Destination_ID
		$rates->Destination_ID->CellCssStyle = ""; $rates->Destination_ID->CellCssClass = "";
		$rates->Destination_ID->CellAttrs = array(); $rates->Destination_ID->ViewAttrs = array(); $rates->Destination_ID->EditAttrs = array();

		// Distance
		$rates->Distance->CellCssStyle = ""; $rates->Distance->CellCssClass = "";
		$rates->Distance->CellAttrs = array(); $rates->Distance->ViewAttrs = array(); $rates->Distance->EditAttrs = array();

		// Truck_Type_ID
		$rates->Truck_Type_ID->CellCssStyle = ""; $rates->Truck_Type_ID->CellCssClass = "";
		$rates->Truck_Type_ID->CellAttrs = array(); $rates->Truck_Type_ID->ViewAttrs = array(); $rates->Truck_Type_ID->EditAttrs = array();

		// Unit_ID
		$rates->Unit_ID->CellCssStyle = ""; $rates->Unit_ID->CellCssClass = "";
		$rates->Unit_ID->CellAttrs = array(); $rates->Unit_ID->ViewAttrs = array(); $rates->Unit_ID->EditAttrs = array();

		// Freight_Rate
		$rates->Freight_Rate->CellCssStyle = ""; $rates->Freight_Rate->CellCssClass = "";
		$rates->Freight_Rate->CellAttrs = array(); $rates->Freight_Rate->ViewAttrs = array(); $rates->Freight_Rate->EditAttrs = array();

		// Vat
		$rates->Vat->CellCssStyle = ""; $rates->Vat->CellCssClass = "";
		$rates->Vat->CellAttrs = array(); $rates->Vat->ViewAttrs = array(); $rates->Vat->EditAttrs = array();

		// Wtax
		$rates->Wtax->CellCssStyle = ""; $rates->Wtax->CellCssClass = "";
		$rates->Wtax->CellAttrs = array(); $rates->Wtax->ViewAttrs = array(); $rates->Wtax->EditAttrs = array();

		// Remarks
		$rates->Remarks->CellCssStyle = ""; $rates->Remarks->CellCssClass = "";
		$rates->Remarks->CellAttrs = array(); $rates->Remarks->ViewAttrs = array(); $rates->Remarks->EditAttrs = array();
		if ($rates->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$rates->id->ViewValue = $rates->id->CurrentValue;
			$rates->id->CssStyle = "";
			$rates->id->CssClass = "";
			$rates->id->ViewCustomAttributes = "";

			// Date
			$rates->Date->ViewValue = $rates->Date->CurrentValue;
			$rates->Date->ViewValue = ew_FormatDateTime($rates->Date->ViewValue, 6);
			$rates->Date->CssStyle = "";
			$rates->Date->CssClass = "";
			$rates->Date->ViewCustomAttributes = "";

			// Client_ID
			if (strval($rates->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$rates->Client_ID->ViewValue = $rates->Client_ID->CurrentValue;
				}
			} else {
				$rates->Client_ID->ViewValue = NULL;
			}
			$rates->Client_ID->CssStyle = "";
			$rates->Client_ID->CssClass = "";
			$rates->Client_ID->ViewCustomAttributes = "";

			// Area_ID
			if (strval($rates->Area_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Area_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Area` FROM `areas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Area_ID->ViewValue = $rswrk->fields('Area');
					$rswrk->Close();
				} else {
					$rates->Area_ID->ViewValue = $rates->Area_ID->CurrentValue;
				}
			} else {
				$rates->Area_ID->ViewValue = NULL;
			}
			$rates->Area_ID->CssStyle = "";
			$rates->Area_ID->CssClass = "";
			$rates->Area_ID->ViewCustomAttributes = "";

			// Origin_ID
			if (strval($rates->Origin_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Origin_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Origin` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Origin_ID->ViewValue = $rswrk->fields('Origin');
					$rswrk->Close();
				} else {
					$rates->Origin_ID->ViewValue = $rates->Origin_ID->CurrentValue;
				}
			} else {
				$rates->Origin_ID->ViewValue = NULL;
			}
			$rates->Origin_ID->CssStyle = "";
			$rates->Origin_ID->CssClass = "";
			$rates->Origin_ID->ViewCustomAttributes = "";

			// Destination_ID
			if (strval($rates->Destination_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Destination_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Destination_ID->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$rates->Destination_ID->ViewValue = $rates->Destination_ID->CurrentValue;
				}
			} else {
				$rates->Destination_ID->ViewValue = NULL;
			}
			$rates->Destination_ID->CssStyle = "";
			$rates->Destination_ID->CssClass = "";
			$rates->Destination_ID->ViewCustomAttributes = "";

			// Distance
			$rates->Distance->ViewValue = $rates->Distance->CurrentValue;
			$rates->Distance->CssStyle = "";
			$rates->Distance->CssClass = "";
			$rates->Distance->ViewCustomAttributes = "";

			// Truck_Type_ID
			if (strval($rates->Truck_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Truck_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Truck_Type_ID->ViewValue = $rswrk->fields('Truck_Type');
					$rswrk->Close();
				} else {
					$rates->Truck_Type_ID->ViewValue = $rates->Truck_Type_ID->CurrentValue;
				}
			} else {
				$rates->Truck_Type_ID->ViewValue = NULL;
			}
			$rates->Truck_Type_ID->CssStyle = "";
			$rates->Truck_Type_ID->CssClass = "";
			$rates->Truck_Type_ID->ViewCustomAttributes = "";

			// Unit_ID
			if (strval($rates->Unit_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Unit_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Units` FROM `units`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Unit_ID->ViewValue = $rswrk->fields('Units');
					$rswrk->Close();
				} else {
					$rates->Unit_ID->ViewValue = $rates->Unit_ID->CurrentValue;
				}
			} else {
				$rates->Unit_ID->ViewValue = NULL;
			}
			$rates->Unit_ID->CssStyle = "";
			$rates->Unit_ID->CssClass = "";
			$rates->Unit_ID->ViewCustomAttributes = "";

			// Freight_Rate
			$rates->Freight_Rate->ViewValue = $rates->Freight_Rate->CurrentValue;
			$rates->Freight_Rate->CssStyle = "";
			$rates->Freight_Rate->CssClass = "";
			$rates->Freight_Rate->ViewCustomAttributes = "";

			// Vat
			$rates->Vat->ViewValue = $rates->Vat->CurrentValue;
			$rates->Vat->CssStyle = "";
			$rates->Vat->CssClass = "";
			$rates->Vat->ViewCustomAttributes = "";

			// Wtax
			$rates->Wtax->ViewValue = $rates->Wtax->CurrentValue;
			$rates->Wtax->CssStyle = "";
			$rates->Wtax->CssClass = "";
			$rates->Wtax->ViewCustomAttributes = "";

			// Remarks
			$rates->Remarks->ViewValue = $rates->Remarks->CurrentValue;
			$rates->Remarks->CssStyle = "";
			$rates->Remarks->CssClass = "";
			$rates->Remarks->ViewCustomAttributes = "";

			// id
			$rates->id->HrefValue = "";
			$rates->id->TooltipValue = "";

			// Date
			$rates->Date->HrefValue = "";
			$rates->Date->TooltipValue = "";

			// Client_ID
			$rates->Client_ID->HrefValue = "";
			$rates->Client_ID->TooltipValue = "";

			// Area_ID
			$rates->Area_ID->HrefValue = "";
			$rates->Area_ID->TooltipValue = "";

			// Origin_ID
			$rates->Origin_ID->HrefValue = "";
			$rates->Origin_ID->TooltipValue = "";

			// Destination_ID
			$rates->Destination_ID->HrefValue = "";
			$rates->Destination_ID->TooltipValue = "";

			// Distance
			$rates->Distance->HrefValue = "";
			$rates->Distance->TooltipValue = "";

			// Truck_Type_ID
			$rates->Truck_Type_ID->HrefValue = "";
			$rates->Truck_Type_ID->TooltipValue = "";

			// Unit_ID
			$rates->Unit_ID->HrefValue = "";
			$rates->Unit_ID->TooltipValue = "";

			// Freight_Rate
			$rates->Freight_Rate->HrefValue = "";
			$rates->Freight_Rate->TooltipValue = "";

			// Vat
			$rates->Vat->HrefValue = "";
			$rates->Vat->TooltipValue = "";

			// Wtax
			$rates->Wtax->HrefValue = "";
			$rates->Wtax->TooltipValue = "";

			// Remarks
			$rates->Remarks->HrefValue = "";
			$rates->Remarks->TooltipValue = "";
		} elseif ($rates->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$rates->id->EditCustomAttributes = "";
			$rates->id->EditValue = ew_HtmlEncode($rates->id->AdvancedSearch->SearchValue);

			// Date
			$rates->Date->EditCustomAttributes = "";
			$rates->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($rates->Date->AdvancedSearch->SearchValue, 6), 6));
			$rates->Date->EditCustomAttributes = "";
			$rates->Date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($rates->Date->AdvancedSearch->SearchValue2, 6), 6));

			// Client_ID
			$rates->Client_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Client_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `clients`";
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
			$rates->Client_ID->EditValue = $arwrk;

			// Area_ID
			$rates->Area_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Area`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `areas`";
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
			$rates->Area_ID->EditValue = $arwrk;

			// Origin_ID
			$rates->Origin_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Origin`, '' AS Disp2Fld, `Client` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$rates->Origin_ID->EditValue = $arwrk;

			// Destination_ID
			$rates->Destination_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Destination`, '' AS Disp2Fld, `Client` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$rates->Destination_ID->EditValue = $arwrk;

			// Distance
			$rates->Distance->EditCustomAttributes = "";
			$rates->Distance->EditValue = ew_HtmlEncode($rates->Distance->AdvancedSearch->SearchValue);

			// Truck_Type_ID
			$rates->Truck_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Truck_Type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `truck_types`";
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
			$rates->Truck_Type_ID->EditValue = $arwrk;

			// Unit_ID
			$rates->Unit_ID->EditCustomAttributes = "";
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
			$rates->Unit_ID->EditValue = $arwrk;

			// Freight_Rate
			$rates->Freight_Rate->EditCustomAttributes = "";
			$rates->Freight_Rate->EditValue = ew_HtmlEncode($rates->Freight_Rate->AdvancedSearch->SearchValue);

			// Vat
			$rates->Vat->EditCustomAttributes = "";
			$rates->Vat->EditValue = ew_HtmlEncode($rates->Vat->AdvancedSearch->SearchValue);

			// Wtax
			$rates->Wtax->EditCustomAttributes = "";
			$rates->Wtax->EditValue = ew_HtmlEncode($rates->Wtax->AdvancedSearch->SearchValue);

			// Remarks
			$rates->Remarks->EditCustomAttributes = "";
			$rates->Remarks->EditValue = ew_HtmlEncode($rates->Remarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($rates->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rates->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $rates;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($rates->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $rates->id->FldErrMsg();
		}
		if (!ew_CheckUSDate($rates->Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $rates->Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($rates->Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $rates->Date->FldErrMsg();
		}
		if (!ew_CheckNumber($rates->Freight_Rate->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $rates->Freight_Rate->FldErrMsg();
		}
		if (!ew_CheckNumber($rates->Vat->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $rates->Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($rates->Wtax->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $rates->Wtax->FldErrMsg();
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
		global $rates;
		$rates->id->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_id");
		$rates->Date->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Date");
		$rates->Date->AdvancedSearch->SearchValue2 = $rates->getAdvancedSearch("y_Date");
		$rates->Client_ID->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Client_ID");
		$rates->Area_ID->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Area_ID");
		$rates->Origin_ID->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Origin_ID");
		$rates->Destination_ID->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Destination_ID");
		$rates->Distance->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Distance");
		$rates->Truck_Type_ID->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Truck_Type_ID");
		$rates->Unit_ID->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Unit_ID");
		$rates->Freight_Rate->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Freight_Rate");
		$rates->Vat->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Vat");
		$rates->Wtax->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Wtax");
		$rates->Remarks->AdvancedSearch->SearchValue = $rates->getAdvancedSearch("x_Remarks");
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
