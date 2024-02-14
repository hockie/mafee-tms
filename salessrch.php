<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "salesinfo.php" ?>
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
$sales_search = new csales_search();
$Page =& $sales_search;

// Page init
$sales_search->Page_Init();

// Page main
$sales_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var sales_search = new ew_Page("sales_search");

// page properties
sales_search.PageID = "search"; // page ID
sales_search.FormID = "fsalessearch"; // form ID
var EW_PAGE_ID = sales_search.PageID; // for backward compatibility

// extend page with validate function for search
sales_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sales->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETA"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sales->ETA->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETD"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sales->ETD->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Sales"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sales->Total_Sales->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Wtax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sales->Wtax->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Amount_Due"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($sales->Total_Amount_Due->FldErrMsg()) ?>");

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
sales_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sales_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sales_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $sales->TableCaption() ?><br><br>
<a href="<?php echo $sales->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sales_search->ShowMessage();
?>
<form name="fsalessearch" id="fsalessearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return sales_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="sales">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $sales->Booking_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Booking_Number->FldCaption() ?></td>
		<td<?php echo $sales->Booking_Number->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Booking_Number" id="z_Booking_Number" value="LIKE"></span></td>
		<td<?php echo $sales->Booking_Number->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Booking_Number" id="x_Booking_Number" title="<?php echo $sales->Booking_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $sales->Booking_Number->EditValue ?>"<?php echo $sales->Booking_Number->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sales->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Date->FldCaption() ?></td>
		<td<?php echo $sales->Date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Date" id="z_Date" value="BETWEEN"></span></td>
		<td<?php echo $sales->Date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Date" id="x_Date" title="<?php echo $sales->Date->FldTitle() ?>" value="<?php echo $sales->Date->EditValue ?>"<?php echo $sales->Date->EditAttributes() ?>>
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
<input type="text" name="y_Date" id="y_Date" title="<?php echo $sales->Date->FldTitle() ?>" value="<?php echo $sales->Date->EditValue2 ?>"<?php echo $sales->Date->EditAttributes() ?>>
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
	<tr<?php echo $sales->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Client_ID->FldCaption() ?></td>
		<td<?php echo $sales->Client_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td<?php echo $sales->Client_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $sales->Client_ID->FldTitle() ?>"<?php echo $sales->Client_ID->EditAttributes() ?>>
<?php
if (is_array($sales->Client_ID->EditValue)) {
	$arwrk = $sales->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sales->Client_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sales->Origin_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Origin_ID->FldCaption() ?></td>
		<td<?php echo $sales->Origin_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Origin_ID" id="z_Origin_ID" value="="></span></td>
		<td<?php echo $sales->Origin_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Origin_ID" name="x_Origin_ID" title="<?php echo $sales->Origin_ID->FldTitle() ?>"<?php echo $sales->Origin_ID->EditAttributes() ?>>
<?php
if (is_array($sales->Origin_ID->EditValue)) {
	$arwrk = $sales->Origin_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sales->Origin_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sales->Destination_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Destination_ID->FldCaption() ?></td>
		<td<?php echo $sales->Destination_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Destination_ID" id="z_Destination_ID" value="="></span></td>
		<td<?php echo $sales->Destination_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Destination_ID" name="x_Destination_ID" title="<?php echo $sales->Destination_ID->FldTitle() ?>"<?php echo $sales->Destination_ID->EditAttributes() ?>>
<?php
if (is_array($sales->Destination_ID->EditValue)) {
	$arwrk = $sales->Destination_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sales->Destination_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sales->Customer_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Customer_ID->FldCaption() ?></td>
		<td<?php echo $sales->Customer_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Customer_ID" id="z_Customer_ID" value="="></span></td>
		<td<?php echo $sales->Customer_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Customer_ID" name="x_Customer_ID" title="<?php echo $sales->Customer_ID->FldTitle() ?>"<?php echo $sales->Customer_ID->EditAttributes() ?>>
<?php
if (is_array($sales->Customer_ID->EditValue)) {
	$arwrk = $sales->Customer_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sales->Customer_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sales->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $sales->Subcon_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="="></span></td>
		<td<?php echo $sales->Subcon_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Subcon_ID" name="x_Subcon_ID" title="<?php echo $sales->Subcon_ID->FldTitle() ?>"<?php echo $sales->Subcon_ID->EditAttributes() ?>>
<?php
if (is_array($sales->Subcon_ID->EditValue)) {
	$arwrk = $sales->Subcon_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sales->Subcon_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sales->Truck_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Truck_ID->FldCaption() ?></td>
		<td<?php echo $sales->Truck_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_ID" id="z_Truck_ID" value="="></span></td>
		<td<?php echo $sales->Truck_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Truck_ID" name="x_Truck_ID" title="<?php echo $sales->Truck_ID->FldTitle() ?>"<?php echo $sales->Truck_ID->EditAttributes() ?>>
<?php
if (is_array($sales->Truck_ID->EditValue)) {
	$arwrk = $sales->Truck_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sales->Truck_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sales->ETA->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->ETA->FldCaption() ?></td>
		<td<?php echo $sales->ETA->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETA" id="z_ETA" value="BETWEEN"></span></td>
		<td<?php echo $sales->ETA->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ETA" id="x_ETA" title="<?php echo $sales->ETA->FldTitle() ?>" value="<?php echo $sales->ETA->EditValue ?>"<?php echo $sales->ETA->EditAttributes() ?>>
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
<input type="text" name="y_ETA" id="y_ETA" title="<?php echo $sales->ETA->FldTitle() ?>" value="<?php echo $sales->ETA->EditValue2 ?>"<?php echo $sales->ETA->EditAttributes() ?>>
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
	<tr<?php echo $sales->ETD->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->ETD->FldCaption() ?></td>
		<td<?php echo $sales->ETD->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETD" id="z_ETD" value="BETWEEN"></span></td>
		<td<?php echo $sales->ETD->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ETD" id="x_ETD" title="<?php echo $sales->ETD->FldTitle() ?>" value="<?php echo $sales->ETD->EditValue ?>"<?php echo $sales->ETD->EditAttributes() ?>>
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
<input type="text" name="y_ETD" id="y_ETD" title="<?php echo $sales->ETD->FldTitle() ?>" value="<?php echo $sales->ETD->EditValue2 ?>"<?php echo $sales->ETD->EditAttributes() ?>>
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
	<tr<?php echo $sales->Billing_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Billing_Type_ID->FldCaption() ?></td>
		<td<?php echo $sales->Billing_Type_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Billing_Type_ID" id="z_Billing_Type_ID" value="="></span></td>
		<td<?php echo $sales->Billing_Type_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Billing_Type_ID" name="x_Billing_Type_ID" title="<?php echo $sales->Billing_Type_ID->FldTitle() ?>"<?php echo $sales->Billing_Type_ID->EditAttributes() ?>>
<?php
if (is_array($sales->Billing_Type_ID->EditValue)) {
	$arwrk = $sales->Billing_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($sales->Billing_Type_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $sales->Total_Sales->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Total_Sales->FldCaption() ?></td>
		<td<?php echo $sales->Total_Sales->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Sales" id="z_Total_Sales" value="="></span></td>
		<td<?php echo $sales->Total_Sales->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Sales" id="x_Total_Sales" title="<?php echo $sales->Total_Sales->FldTitle() ?>" size="30" value="<?php echo $sales->Total_Sales->EditValue ?>"<?php echo $sales->Total_Sales->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sales->Wtax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Wtax->FldCaption() ?></td>
		<td<?php echo $sales->Wtax->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Wtax" id="z_Wtax" value="="></span></td>
		<td<?php echo $sales->Wtax->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Wtax" id="x_Wtax" title="<?php echo $sales->Wtax->FldTitle() ?>" size="30" value="<?php echo $sales->Wtax->EditValue ?>"<?php echo $sales->Wtax->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $sales->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $sales->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $sales->Total_Amount_Due->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Amount_Due" id="z_Total_Amount_Due" value="="></span></td>
		<td<?php echo $sales->Total_Amount_Due->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $sales->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $sales->Total_Amount_Due->EditValue ?>"<?php echo $sales->Total_Amount_Due->EditAttributes() ?>>
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

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$sales_search->Page_Terminate();
?>
<?php

//
// Page class
//
class csales_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'sales';

	// Page object name
	var $PageObjName = 'sales_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $sales;
		if ($sales->UseTokenInUrl) $PageUrl .= "t=" . $sales->TableVar . "&"; // Add page token
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
		global $objForm, $sales;
		if ($sales->UseTokenInUrl) {
			if ($objForm)
				return ($sales->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($sales->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csales_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sales)
		$GLOBALS["sales"] = new csales();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sales', TRUE);

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
		global $sales;

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
			$this->Page_Terminate("saleslist.php");
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
		global $objForm, $Language, $gsSearchError, $sales;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$sales->CurrentAction = $objForm->GetValue("a_search");
			switch ($sales->CurrentAction) {
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
						$sSrchStr = $sales->UrlParm($sSrchStr);
						$this->Page_Terminate("saleslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$sales->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $sales;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $sales->Booking_Number); // Booking_Number
	$this->BuildSearchUrl($sSrchUrl, $sales->Date); // Date
	$this->BuildSearchUrl($sSrchUrl, $sales->Client_ID); // Client_ID
	$this->BuildSearchUrl($sSrchUrl, $sales->Origin_ID); // Origin_ID
	$this->BuildSearchUrl($sSrchUrl, $sales->Destination_ID); // Destination_ID
	$this->BuildSearchUrl($sSrchUrl, $sales->Customer_ID); // Customer_ID
	$this->BuildSearchUrl($sSrchUrl, $sales->Subcon_ID); // Subcon_ID
	$this->BuildSearchUrl($sSrchUrl, $sales->Truck_ID); // Truck_ID
	$this->BuildSearchUrl($sSrchUrl, $sales->ETA); // ETA
	$this->BuildSearchUrl($sSrchUrl, $sales->ETD); // ETD
	$this->BuildSearchUrl($sSrchUrl, $sales->Billing_Type_ID); // Billing_Type_ID
	$this->BuildSearchUrl($sSrchUrl, $sales->Total_Sales); // Total_Sales
	$this->BuildSearchUrl($sSrchUrl, $sales->Wtax); // Wtax
	$this->BuildSearchUrl($sSrchUrl, $sales->Total_Amount_Due); // Total_Amount_Due
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
		global $objForm, $sales;

		// Load search values
		// Booking_Number

		$sales->Booking_Number->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Booking_Number"));
		$sales->Booking_Number->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Booking_Number");

		// Date
		$sales->Date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Date"));
		$sales->Date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Date");
		$sales->Date->AdvancedSearch->SearchCondition = $objForm->GetValue("v_Date");
		$sales->Date->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_Date"));
		$sales->Date->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_Date");

		// Client_ID
		$sales->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Client_ID"));
		$sales->Client_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Client_ID");

		// Origin_ID
		$sales->Origin_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Origin_ID"));
		$sales->Origin_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Origin_ID");

		// Destination_ID
		$sales->Destination_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Destination_ID"));
		$sales->Destination_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Destination_ID");

		// Customer_ID
		$sales->Customer_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Customer_ID"));
		$sales->Customer_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Customer_ID");

		// Subcon_ID
		$sales->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Subcon_ID"));
		$sales->Subcon_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Subcon_ID");

		// Truck_ID
		$sales->Truck_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Truck_ID"));
		$sales->Truck_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Truck_ID");

		// ETA
		$sales->ETA->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ETA"));
		$sales->ETA->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ETA");
		$sales->ETA->AdvancedSearch->SearchCondition = $objForm->GetValue("v_ETA");
		$sales->ETA->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_ETA"));
		$sales->ETA->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_ETA");

		// ETD
		$sales->ETD->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ETD"));
		$sales->ETD->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ETD");
		$sales->ETD->AdvancedSearch->SearchCondition = $objForm->GetValue("v_ETD");
		$sales->ETD->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_ETD"));
		$sales->ETD->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_ETD");

		// Billing_Type_ID
		$sales->Billing_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Billing_Type_ID"));
		$sales->Billing_Type_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Billing_Type_ID");

		// Total_Sales
		$sales->Total_Sales->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Sales"));
		$sales->Total_Sales->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Sales");

		// Wtax
		$sales->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Wtax"));
		$sales->Wtax->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Wtax");

		// Total_Amount_Due
		$sales->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Amount_Due"));
		$sales->Total_Amount_Due->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Amount_Due");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sales;

		// Initialize URLs
		// Call Row_Rendering event

		$sales->Row_Rendering();

		// Common render codes for all row types
		// Booking_Number

		$sales->Booking_Number->CellCssStyle = ""; $sales->Booking_Number->CellCssClass = "";
		$sales->Booking_Number->CellAttrs = array(); $sales->Booking_Number->ViewAttrs = array(); $sales->Booking_Number->EditAttrs = array();

		// Date
		$sales->Date->CellCssStyle = ""; $sales->Date->CellCssClass = "";
		$sales->Date->CellAttrs = array(); $sales->Date->ViewAttrs = array(); $sales->Date->EditAttrs = array();

		// Client_ID
		$sales->Client_ID->CellCssStyle = ""; $sales->Client_ID->CellCssClass = "";
		$sales->Client_ID->CellAttrs = array(); $sales->Client_ID->ViewAttrs = array(); $sales->Client_ID->EditAttrs = array();

		// Origin_ID
		$sales->Origin_ID->CellCssStyle = ""; $sales->Origin_ID->CellCssClass = "";
		$sales->Origin_ID->CellAttrs = array(); $sales->Origin_ID->ViewAttrs = array(); $sales->Origin_ID->EditAttrs = array();

		// Destination_ID
		$sales->Destination_ID->CellCssStyle = ""; $sales->Destination_ID->CellCssClass = "";
		$sales->Destination_ID->CellAttrs = array(); $sales->Destination_ID->ViewAttrs = array(); $sales->Destination_ID->EditAttrs = array();

		// Customer_ID
		$sales->Customer_ID->CellCssStyle = ""; $sales->Customer_ID->CellCssClass = "";
		$sales->Customer_ID->CellAttrs = array(); $sales->Customer_ID->ViewAttrs = array(); $sales->Customer_ID->EditAttrs = array();

		// Subcon_ID
		$sales->Subcon_ID->CellCssStyle = ""; $sales->Subcon_ID->CellCssClass = "";
		$sales->Subcon_ID->CellAttrs = array(); $sales->Subcon_ID->ViewAttrs = array(); $sales->Subcon_ID->EditAttrs = array();

		// Truck_ID
		$sales->Truck_ID->CellCssStyle = ""; $sales->Truck_ID->CellCssClass = "";
		$sales->Truck_ID->CellAttrs = array(); $sales->Truck_ID->ViewAttrs = array(); $sales->Truck_ID->EditAttrs = array();

		// ETA
		$sales->ETA->CellCssStyle = ""; $sales->ETA->CellCssClass = "";
		$sales->ETA->CellAttrs = array(); $sales->ETA->ViewAttrs = array(); $sales->ETA->EditAttrs = array();

		// ETD
		$sales->ETD->CellCssStyle = ""; $sales->ETD->CellCssClass = "";
		$sales->ETD->CellAttrs = array(); $sales->ETD->ViewAttrs = array(); $sales->ETD->EditAttrs = array();

		// Billing_Type_ID
		$sales->Billing_Type_ID->CellCssStyle = ""; $sales->Billing_Type_ID->CellCssClass = "";
		$sales->Billing_Type_ID->CellAttrs = array(); $sales->Billing_Type_ID->ViewAttrs = array(); $sales->Billing_Type_ID->EditAttrs = array();

		// Total_Sales
		$sales->Total_Sales->CellCssStyle = ""; $sales->Total_Sales->CellCssClass = "";
		$sales->Total_Sales->CellAttrs = array(); $sales->Total_Sales->ViewAttrs = array(); $sales->Total_Sales->EditAttrs = array();

		// Wtax
		$sales->Wtax->CellCssStyle = ""; $sales->Wtax->CellCssClass = "";
		$sales->Wtax->CellAttrs = array(); $sales->Wtax->ViewAttrs = array(); $sales->Wtax->EditAttrs = array();

		// Total_Amount_Due
		$sales->Total_Amount_Due->CellCssStyle = ""; $sales->Total_Amount_Due->CellCssClass = "";
		$sales->Total_Amount_Due->CellAttrs = array(); $sales->Total_Amount_Due->ViewAttrs = array(); $sales->Total_Amount_Due->EditAttrs = array();
		if ($sales->RowType == EW_ROWTYPE_VIEW) { // View row

			// Booking_Number
			$sales->Booking_Number->ViewValue = $sales->Booking_Number->CurrentValue;
			$sales->Booking_Number->CssStyle = "";
			$sales->Booking_Number->CssClass = "";
			$sales->Booking_Number->ViewCustomAttributes = "";

			// Date
			$sales->Date->ViewValue = $sales->Date->CurrentValue;
			$sales->Date->ViewValue = ew_FormatDateTime($sales->Date->ViewValue, 6);
			$sales->Date->CssStyle = "";
			$sales->Date->CssClass = "";
			$sales->Date->ViewCustomAttributes = "";

			// Client_ID
			if (strval($sales->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($sales->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sales->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$sales->Client_ID->ViewValue = $sales->Client_ID->CurrentValue;
				}
			} else {
				$sales->Client_ID->ViewValue = NULL;
			}
			$sales->Client_ID->CssStyle = "";
			$sales->Client_ID->CssClass = "";
			$sales->Client_ID->ViewCustomAttributes = "";

			// Origin_ID
			if (strval($sales->Origin_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($sales->Origin_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Origin` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sales->Origin_ID->ViewValue = $rswrk->fields('Origin');
					$rswrk->Close();
				} else {
					$sales->Origin_ID->ViewValue = $sales->Origin_ID->CurrentValue;
				}
			} else {
				$sales->Origin_ID->ViewValue = NULL;
			}
			$sales->Origin_ID->CssStyle = "";
			$sales->Origin_ID->CssClass = "";
			$sales->Origin_ID->ViewCustomAttributes = "";

			// Destination_ID
			if (strval($sales->Destination_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($sales->Destination_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sales->Destination_ID->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$sales->Destination_ID->ViewValue = $sales->Destination_ID->CurrentValue;
				}
			} else {
				$sales->Destination_ID->ViewValue = NULL;
			}
			$sales->Destination_ID->CssStyle = "";
			$sales->Destination_ID->CssClass = "";
			$sales->Destination_ID->ViewCustomAttributes = "";

			// Customer_ID
			if (strval($sales->Customer_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($sales->Customer_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Customer_Name` FROM `consignees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sales->Customer_ID->ViewValue = $rswrk->fields('Customer_Name');
					$rswrk->Close();
				} else {
					$sales->Customer_ID->ViewValue = $sales->Customer_ID->CurrentValue;
				}
			} else {
				$sales->Customer_ID->ViewValue = NULL;
			}
			$sales->Customer_ID->CssStyle = "";
			$sales->Customer_ID->CssClass = "";
			$sales->Customer_ID->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($sales->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($sales->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sales->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$sales->Subcon_ID->ViewValue = $sales->Subcon_ID->CurrentValue;
				}
			} else {
				$sales->Subcon_ID->ViewValue = NULL;
			}
			$sales->Subcon_ID->CssStyle = "";
			$sales->Subcon_ID->CssClass = "";
			$sales->Subcon_ID->ViewCustomAttributes = "";

			// Truck_ID
			if (strval($sales->Truck_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($sales->Truck_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Plate_Number` FROM `trucks`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sales->Truck_ID->ViewValue = $rswrk->fields('Plate_Number');
					$rswrk->Close();
				} else {
					$sales->Truck_ID->ViewValue = $sales->Truck_ID->CurrentValue;
				}
			} else {
				$sales->Truck_ID->ViewValue = NULL;
			}
			$sales->Truck_ID->CssStyle = "";
			$sales->Truck_ID->CssClass = "";
			$sales->Truck_ID->ViewCustomAttributes = "";

			// ETA
			$sales->ETA->ViewValue = $sales->ETA->CurrentValue;
			$sales->ETA->ViewValue = ew_FormatDateTime($sales->ETA->ViewValue, 6);
			$sales->ETA->CssStyle = "";
			$sales->ETA->CssClass = "";
			$sales->ETA->ViewCustomAttributes = "";

			// ETD
			$sales->ETD->ViewValue = $sales->ETD->CurrentValue;
			$sales->ETD->ViewValue = ew_FormatDateTime($sales->ETD->ViewValue, 6);
			$sales->ETD->CssStyle = "";
			$sales->ETD->CssClass = "";
			$sales->ETD->ViewCustomAttributes = "";

			// Billing_Type_ID
			if (strval($sales->Billing_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($sales->Billing_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Billing_Types` FROM `billing_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$sales->Billing_Type_ID->ViewValue = $rswrk->fields('Billing_Types');
					$rswrk->Close();
				} else {
					$sales->Billing_Type_ID->ViewValue = $sales->Billing_Type_ID->CurrentValue;
				}
			} else {
				$sales->Billing_Type_ID->ViewValue = NULL;
			}
			$sales->Billing_Type_ID->CssStyle = "";
			$sales->Billing_Type_ID->CssClass = "";
			$sales->Billing_Type_ID->ViewCustomAttributes = "";

			// Total_Sales
			$sales->Total_Sales->ViewValue = $sales->Total_Sales->CurrentValue;
			$sales->Total_Sales->ViewValue = ew_FormatNumber($sales->Total_Sales->ViewValue, 2, -2, -2, -2);
			$sales->Total_Sales->CssStyle = "";
			$sales->Total_Sales->CssClass = "";
			$sales->Total_Sales->ViewCustomAttributes = "";

			// Wtax
			$sales->Wtax->ViewValue = $sales->Wtax->CurrentValue;
			$sales->Wtax->ViewValue = ew_FormatNumber($sales->Wtax->ViewValue, 2, -2, -2, -2);
			$sales->Wtax->CssStyle = "";
			$sales->Wtax->CssClass = "";
			$sales->Wtax->ViewCustomAttributes = "";

			// Total_Amount_Due
			$sales->Total_Amount_Due->ViewValue = $sales->Total_Amount_Due->CurrentValue;
			$sales->Total_Amount_Due->ViewValue = ew_FormatNumber($sales->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$sales->Total_Amount_Due->CssStyle = "";
			$sales->Total_Amount_Due->CssClass = "";
			$sales->Total_Amount_Due->ViewCustomAttributes = "";

			// Booking_Number
			$sales->Booking_Number->HrefValue = "";
			$sales->Booking_Number->TooltipValue = "";

			// Date
			$sales->Date->HrefValue = "";
			$sales->Date->TooltipValue = "";

			// Client_ID
			$sales->Client_ID->HrefValue = "";
			$sales->Client_ID->TooltipValue = "";

			// Origin_ID
			$sales->Origin_ID->HrefValue = "";
			$sales->Origin_ID->TooltipValue = "";

			// Destination_ID
			$sales->Destination_ID->HrefValue = "";
			$sales->Destination_ID->TooltipValue = "";

			// Customer_ID
			$sales->Customer_ID->HrefValue = "";
			$sales->Customer_ID->TooltipValue = "";

			// Subcon_ID
			$sales->Subcon_ID->HrefValue = "";
			$sales->Subcon_ID->TooltipValue = "";

			// Truck_ID
			$sales->Truck_ID->HrefValue = "";
			$sales->Truck_ID->TooltipValue = "";

			// ETA
			$sales->ETA->HrefValue = "";
			$sales->ETA->TooltipValue = "";

			// ETD
			$sales->ETD->HrefValue = "";
			$sales->ETD->TooltipValue = "";

			// Billing_Type_ID
			$sales->Billing_Type_ID->HrefValue = "";
			$sales->Billing_Type_ID->TooltipValue = "";

			// Total_Sales
			$sales->Total_Sales->HrefValue = "";
			$sales->Total_Sales->TooltipValue = "";

			// Wtax
			$sales->Wtax->HrefValue = "";
			$sales->Wtax->TooltipValue = "";

			// Total_Amount_Due
			$sales->Total_Amount_Due->HrefValue = "";
			$sales->Total_Amount_Due->TooltipValue = "";
		} elseif ($sales->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// Booking_Number
			$sales->Booking_Number->EditCustomAttributes = "";
			$sales->Booking_Number->EditValue = ew_HtmlEncode($sales->Booking_Number->AdvancedSearch->SearchValue);

			// Date
			$sales->Date->EditCustomAttributes = "";
			$sales->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($sales->Date->AdvancedSearch->SearchValue, 6), 6));
			$sales->Date->EditCustomAttributes = "";
			$sales->Date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($sales->Date->AdvancedSearch->SearchValue2, 6), 6));

			// Client_ID
			$sales->Client_ID->EditCustomAttributes = "";
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
			$sales->Client_ID->EditValue = $arwrk;

			// Origin_ID
			$sales->Origin_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Origin`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `origins`";
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
			$sales->Origin_ID->EditValue = $arwrk;

			// Destination_ID
			$sales->Destination_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Destination`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `destinations`";
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
			$sales->Destination_ID->EditValue = $arwrk;

			// Customer_ID
			$sales->Customer_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Customer_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `consignees`";
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
			$sales->Customer_ID->EditValue = $arwrk;

			// Subcon_ID
			$sales->Subcon_ID->EditCustomAttributes = "";
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
			$sales->Subcon_ID->EditValue = $arwrk;

			// Truck_ID
			$sales->Truck_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Plate_Number`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `trucks`";
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
			$sales->Truck_ID->EditValue = $arwrk;

			// ETA
			$sales->ETA->EditCustomAttributes = "";
			$sales->ETA->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($sales->ETA->AdvancedSearch->SearchValue, 6), 6));
			$sales->ETA->EditCustomAttributes = "";
			$sales->ETA->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($sales->ETA->AdvancedSearch->SearchValue2, 6), 6));

			// ETD
			$sales->ETD->EditCustomAttributes = "";
			$sales->ETD->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($sales->ETD->AdvancedSearch->SearchValue, 6), 6));
			$sales->ETD->EditCustomAttributes = "";
			$sales->ETD->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($sales->ETD->AdvancedSearch->SearchValue2, 6), 6));

			// Billing_Type_ID
			$sales->Billing_Type_ID->EditCustomAttributes = "";
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
			$sales->Billing_Type_ID->EditValue = $arwrk;

			// Total_Sales
			$sales->Total_Sales->EditCustomAttributes = "";
			$sales->Total_Sales->EditValue = ew_HtmlEncode($sales->Total_Sales->AdvancedSearch->SearchValue);

			// Wtax
			$sales->Wtax->EditCustomAttributes = "";
			$sales->Wtax->EditValue = ew_HtmlEncode($sales->Wtax->AdvancedSearch->SearchValue);

			// Total_Amount_Due
			$sales->Total_Amount_Due->EditCustomAttributes = "";
			$sales->Total_Amount_Due->EditValue = ew_HtmlEncode($sales->Total_Amount_Due->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($sales->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$sales->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $sales;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckUSDate($sales->Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($sales->Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($sales->ETA->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->ETA->FldErrMsg();
		}
		if (!ew_CheckUSDate($sales->ETA->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->ETA->FldErrMsg();
		}
		if (!ew_CheckUSDate($sales->ETD->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->ETD->FldErrMsg();
		}
		if (!ew_CheckUSDate($sales->ETD->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->ETD->FldErrMsg();
		}
		if (!ew_CheckNumber($sales->Total_Sales->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->Total_Sales->FldErrMsg();
		}
		if (!ew_CheckNumber($sales->Wtax->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->Wtax->FldErrMsg();
		}
		if (!ew_CheckNumber($sales->Total_Amount_Due->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sales->Total_Amount_Due->FldErrMsg();
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
		global $sales;
		$sales->Booking_Number->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Booking_Number");
		$sales->Date->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Date");
		$sales->Date->AdvancedSearch->SearchValue2 = $sales->getAdvancedSearch("y_Date");
		$sales->Client_ID->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Client_ID");
		$sales->Origin_ID->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Origin_ID");
		$sales->Destination_ID->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Destination_ID");
		$sales->Customer_ID->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Customer_ID");
		$sales->Subcon_ID->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Subcon_ID");
		$sales->Truck_ID->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Truck_ID");
		$sales->ETA->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_ETA");
		$sales->ETA->AdvancedSearch->SearchValue2 = $sales->getAdvancedSearch("y_ETA");
		$sales->ETD->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_ETD");
		$sales->ETD->AdvancedSearch->SearchValue2 = $sales->getAdvancedSearch("y_ETD");
		$sales->Billing_Type_ID->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Billing_Type_ID");
		$sales->Total_Sales->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Total_Sales");
		$sales->Wtax->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Wtax");
		$sales->Total_Amount_Due->AdvancedSearch->SearchValue = $sales->getAdvancedSearch("x_Total_Amount_Due");
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
