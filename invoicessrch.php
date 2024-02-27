<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "invoicesinfo.php" ?>
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
$invoices_search = new cinvoices_search();
$Page =& $invoices_search;

// Page init
$invoices_search->Page_Init();

// Page main
$invoices_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var invoices_search = new ew_Page("invoices_search");

// page properties
invoices_search.PageID = "search"; // page ID
invoices_search.FormID = "finvoicessearch"; // form ID
var EW_PAGE_ID = invoices_search.PageID; // for backward compatibility

// extend page with validate function for search
invoices_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Invoice_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Invoice_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Due_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Due_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Vat"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Total_Vat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_WTax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Total_WTax->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Freight"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Total_Freight->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Amount_Due"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Total_Amount_Due->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_User_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->User_ID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_created"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->created->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_modified"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->modified->FldErrMsg()) ?>");

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
invoices_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoices_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoices_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoices_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoices->TableCaption() ?><br><br>
<a href="<?php echo $invoices->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoices_search->ShowMessage();
?>
<form name="finvoicessearch" id="finvoicessearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return invoices_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="invoices">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $invoices->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->id->FldCaption() ?></td>
		<td<?php echo $invoices->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $invoices->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $invoices->id->FldTitle() ?>" value="<?php echo $invoices->id->EditValue ?>"<?php echo $invoices->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Invoice_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Invoice_Number->FldCaption() ?></td>
		<td<?php echo $invoices->Invoice_Number->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Invoice_Number" id="z_Invoice_Number" value="LIKE"></span></td>
		<td<?php echo $invoices->Invoice_Number->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Invoice_Number" id="x_Invoice_Number" title="<?php echo $invoices->Invoice_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $invoices->Invoice_Number->EditValue ?>"<?php echo $invoices->Invoice_Number->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Client_ID->FldCaption() ?></td>
		<td<?php echo $invoices->Client_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td<?php echo $invoices->Client_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php $invoices->Client_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_payment_period','x_Client_ID',invoices_search.ar_x_payment_period); " . @$invoices->Client_ID->EditAttrs["onchange"]; ?>
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $invoices->Client_ID->FldTitle() ?>"<?php echo $invoices->Client_ID->EditAttributes() ?>>
<?php
if (is_array($invoices->Client_ID->EditValue)) {
	$arwrk = $invoices->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->Client_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $invoices->Invoice_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Invoice_Date->FldCaption() ?></td>
		<td<?php echo $invoices->Invoice_Date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Invoice_Date" id="z_Invoice_Date" value="BETWEEN"></span></td>
		<td<?php echo $invoices->Invoice_Date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Invoice_Date" id="x_Invoice_Date" title="<?php echo $invoices->Invoice_Date->FldTitle() ?>" value="<?php echo $invoices->Invoice_Date->EditValue ?>"<?php echo $invoices->Invoice_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Invoice_Date" name="cal_x_Invoice_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Invoice_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Invoice_Date" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw1_Invoice_Date" name="btw1_Invoice_Date">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_Invoice_Date" name="btw1_Invoice_Date">
<input type="text" name="y_Invoice_Date" id="y_Invoice_Date" title="<?php echo $invoices->Invoice_Date->FldTitle() ?>" value="<?php echo $invoices->Invoice_Date->EditValue2 ?>"<?php echo $invoices->Invoice_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_Invoice_Date" name="cal_y_Invoice_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_Invoice_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_y_Invoice_Date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Due_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Due_Date->FldCaption() ?></td>
		<td<?php echo $invoices->Due_Date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Due_Date" id="z_Due_Date" value="BETWEEN"></span></td>
		<td<?php echo $invoices->Due_Date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Due_Date" id="x_Due_Date" title="<?php echo $invoices->Due_Date->FldTitle() ?>" value="<?php echo $invoices->Due_Date->EditValue ?>"<?php echo $invoices->Due_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Due_Date" name="cal_x_Due_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Due_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Due_Date" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw1_Due_Date" name="btw1_Due_Date">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_Due_Date" name="btw1_Due_Date">
<input type="text" name="y_Due_Date" id="y_Due_Date" title="<?php echo $invoices->Due_Date->FldTitle() ?>" value="<?php echo $invoices->Due_Date->EditValue2 ?>"<?php echo $invoices->Due_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_Due_Date" name="cal_y_Due_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_Due_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_y_Due_Date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->payment_period->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->payment_period->FldCaption() ?></td>
		<td<?php echo $invoices->payment_period->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_payment_period" id="z_payment_period" value="="></span></td>
		<td<?php echo $invoices->payment_period->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_payment_period" name="x_payment_period" title="<?php echo $invoices->payment_period->FldTitle() ?>"<?php echo $invoices->payment_period->EditAttributes() ?>>
<?php
if (is_array($invoices->payment_period->EditValue)) {
	$arwrk = $invoices->payment_period->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->payment_period->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($invoices->payment_period->EditValue)) {
	$arwrk = $invoices->payment_period->EditValue;
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
invoices_search.ar_x_payment_period = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Total_Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Vat->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Vat->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Vat" id="z_Total_Vat" value="="></span></td>
		<td<?php echo $invoices->Total_Vat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Vat" id="x_Total_Vat" title="<?php echo $invoices->Total_Vat->FldTitle() ?>" size="30" value="<?php echo $invoices->Total_Vat->EditValue ?>"<?php echo $invoices->Total_Vat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Total_WTax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_WTax->FldCaption() ?></td>
		<td<?php echo $invoices->Total_WTax->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_WTax" id="z_Total_WTax" value="="></span></td>
		<td<?php echo $invoices->Total_WTax->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_WTax" id="x_Total_WTax" title="<?php echo $invoices->Total_WTax->FldTitle() ?>" size="30" value="<?php echo $invoices->Total_WTax->EditValue ?>"<?php echo $invoices->Total_WTax->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Total_Freight->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Freight->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Freight->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Freight" id="z_Total_Freight" value="="></span></td>
		<td<?php echo $invoices->Total_Freight->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Freight" id="x_Total_Freight" title="<?php echo $invoices->Total_Freight->FldTitle() ?>" size="30" value="<?php echo $invoices->Total_Freight->EditValue ?>"<?php echo $invoices->Total_Freight->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Amount_Due->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Amount_Due" id="z_Total_Amount_Due" value="="></span></td>
		<td<?php echo $invoices->Total_Amount_Due->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $invoices->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $invoices->Total_Amount_Due->EditValue ?>"<?php echo $invoices->Total_Amount_Due->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Payment_Reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Payment_Reference->FldCaption() ?></td>
		<td<?php echo $invoices->Payment_Reference->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Payment_Reference" id="z_Payment_Reference" value="LIKE"></span></td>
		<td<?php echo $invoices->Payment_Reference->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Payment_Reference" id="x_Payment_Reference" title="<?php echo $invoices->Payment_Reference->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $invoices->Payment_Reference->EditValue ?>"<?php echo $invoices->Payment_Reference->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->Payment_Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Payment_Status->FldCaption() ?></td>
		<td<?php echo $invoices->Payment_Status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Payment_Status" id="z_Payment_Status" value="="></span></td>
		<td<?php echo $invoices->Payment_Status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Payment_Status" name="x_Payment_Status" title="<?php echo $invoices->Payment_Status->FldTitle() ?>"<?php echo $invoices->Payment_Status->EditAttributes() ?>>
<?php
if (is_array($invoices->Payment_Status->EditValue)) {
	$arwrk = $invoices->Payment_Status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->Payment_Status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $invoices->Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Status->FldCaption() ?></td>
		<td<?php echo $invoices->Status->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Status" id="z_Status" value="="></span></td>
		<td<?php echo $invoices->Status->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Status" name="x_Status" title="<?php echo $invoices->Status->FldTitle() ?>"<?php echo $invoices->Status->EditAttributes() ?>>
<?php
if (is_array($invoices->Status->EditValue)) {
	$arwrk = $invoices->Status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->Status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $invoices->Recipient_Bank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Recipient_Bank->FldCaption() ?></td>
		<td<?php echo $invoices->Recipient_Bank->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Recipient_Bank" id="z_Recipient_Bank" value="="></span></td>
		<td<?php echo $invoices->Recipient_Bank->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Recipient_Bank" name="x_Recipient_Bank" title="<?php echo $invoices->Recipient_Bank->FldTitle() ?>"<?php echo $invoices->Recipient_Bank->EditAttributes() ?>>
<?php
if (is_array($invoices->Recipient_Bank->EditValue)) {
	$arwrk = $invoices->Recipient_Bank->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->Recipient_Bank->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $invoices->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Remarks->FldCaption() ?></td>
		<td<?php echo $invoices->Remarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE"></span></td>
		<td<?php echo $invoices->Remarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $invoices->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $invoices->Remarks->EditAttributes() ?>><?php echo $invoices->Remarks->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->User_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->User_ID->FldCaption() ?></td>
		<td<?php echo $invoices->User_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_User_ID" id="z_User_ID" value="="></span></td>
		<td<?php echo $invoices->User_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_User_ID" id="x_User_ID" title="<?php echo $invoices->User_ID->FldTitle() ?>" size="30" value="<?php echo $invoices->User_ID->EditValue ?>"<?php echo $invoices->User_ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->created->FldCaption() ?></td>
		<td<?php echo $invoices->created->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_created" id="z_created" value="="></span></td>
		<td<?php echo $invoices->created->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_created" id="x_created" title="<?php echo $invoices->created->FldTitle() ?>" value="<?php echo $invoices->created->EditValue ?>"<?php echo $invoices->created->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $invoices->modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->modified->FldCaption() ?></td>
		<td<?php echo $invoices->modified->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_modified" id="z_modified" value="="></span></td>
		<td<?php echo $invoices->modified->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_modified" id="x_modified" title="<?php echo $invoices->modified->FldTitle() ?>" value="<?php echo $invoices->modified->EditValue ?>"<?php echo $invoices->modified->EditAttributes() ?>>
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
ew_UpdateOpts([['x_payment_period','x_Client_ID',invoices_search.ar_x_payment_period]]);

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
$invoices_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoices_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'invoices';

	// Page object name
	var $PageObjName = 'invoices_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $invoices;
		if ($invoices->UseTokenInUrl) $PageUrl .= "t=" . $invoices->TableVar . "&"; // Add page token
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
		global $objForm, $invoices;
		if ($invoices->UseTokenInUrl) {
			if ($objForm)
				return ($invoices->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($invoices->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinvoices_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (invoices)
		$GLOBALS["invoices"] = new cinvoices();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'invoices', TRUE);

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
		global $invoices;

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
			$this->Page_Terminate("invoiceslist.php");
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
		global $objForm, $Language, $gsSearchError, $invoices;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$invoices->CurrentAction = $objForm->GetValue("a_search");
			switch ($invoices->CurrentAction) {
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
						$sSrchStr = $invoices->UrlParm($sSrchStr);
						$this->Page_Terminate("invoiceslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$invoices->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $invoices;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $invoices->id); // id
	$this->BuildSearchUrl($sSrchUrl, $invoices->Invoice_Number); // Invoice_Number
	$this->BuildSearchUrl($sSrchUrl, $invoices->Client_ID); // Client_ID
	$this->BuildSearchUrl($sSrchUrl, $invoices->Invoice_Date); // Invoice_Date
	$this->BuildSearchUrl($sSrchUrl, $invoices->Due_Date); // Due_Date
	$this->BuildSearchUrl($sSrchUrl, $invoices->payment_period); // payment_period
	$this->BuildSearchUrl($sSrchUrl, $invoices->Total_Vat); // Total_Vat
	$this->BuildSearchUrl($sSrchUrl, $invoices->Total_WTax); // Total_WTax
	$this->BuildSearchUrl($sSrchUrl, $invoices->Total_Freight); // Total_Freight
	$this->BuildSearchUrl($sSrchUrl, $invoices->Total_Amount_Due); // Total_Amount_Due
	$this->BuildSearchUrl($sSrchUrl, $invoices->Payment_Reference); // Payment_Reference
	$this->BuildSearchUrl($sSrchUrl, $invoices->Payment_Status); // Payment_Status
	$this->BuildSearchUrl($sSrchUrl, $invoices->Status); // Status
	$this->BuildSearchUrl($sSrchUrl, $invoices->Recipient_Bank); // Recipient_Bank
	$this->BuildSearchUrl($sSrchUrl, $invoices->Remarks); // Remarks
	$this->BuildSearchUrl($sSrchUrl, $invoices->User_ID); // User_ID
	$this->BuildSearchUrl($sSrchUrl, $invoices->created); // created
	$this->BuildSearchUrl($sSrchUrl, $invoices->modified); // modified
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
		global $objForm, $invoices;

		// Load search values
		// id

		$invoices->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$invoices->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// Invoice_Number
		$invoices->Invoice_Number->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Invoice_Number"));
		$invoices->Invoice_Number->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Invoice_Number");

		// Client_ID
		$invoices->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Client_ID"));
		$invoices->Client_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Client_ID");

		// Invoice_Date
		$invoices->Invoice_Date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Invoice_Date"));
		$invoices->Invoice_Date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Invoice_Date");
		$invoices->Invoice_Date->AdvancedSearch->SearchCondition = $objForm->GetValue("v_Invoice_Date");
		$invoices->Invoice_Date->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_Invoice_Date"));
		$invoices->Invoice_Date->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_Invoice_Date");

		// Due_Date
		$invoices->Due_Date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Due_Date"));
		$invoices->Due_Date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Due_Date");
		$invoices->Due_Date->AdvancedSearch->SearchCondition = $objForm->GetValue("v_Due_Date");
		$invoices->Due_Date->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_Due_Date"));
		$invoices->Due_Date->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_Due_Date");

		// payment_period
		$invoices->payment_period->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_payment_period"));
		$invoices->payment_period->AdvancedSearch->SearchOperator = $objForm->GetValue("z_payment_period");

		// Total_Vat
		$invoices->Total_Vat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Vat"));
		$invoices->Total_Vat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Vat");

		// Total_WTax
		$invoices->Total_WTax->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_WTax"));
		$invoices->Total_WTax->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_WTax");

		// Total_Freight
		$invoices->Total_Freight->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Freight"));
		$invoices->Total_Freight->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Freight");

		// Total_Amount_Due
		$invoices->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Amount_Due"));
		$invoices->Total_Amount_Due->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Amount_Due");

		// Payment_Reference
		$invoices->Payment_Reference->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Payment_Reference"));
		$invoices->Payment_Reference->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Payment_Reference");

		// Payment_Status
		$invoices->Payment_Status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Payment_Status"));
		$invoices->Payment_Status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Payment_Status");

		// Status
		$invoices->Status->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Status"));
		$invoices->Status->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Status");

		// Recipient_Bank
		$invoices->Recipient_Bank->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Recipient_Bank"));
		$invoices->Recipient_Bank->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Recipient_Bank");

		// Remarks
		$invoices->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Remarks"));
		$invoices->Remarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Remarks");

		// User_ID
		$invoices->User_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_User_ID"));
		$invoices->User_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_User_ID");

		// created
		$invoices->created->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_created"));
		$invoices->created->AdvancedSearch->SearchOperator = $objForm->GetValue("z_created");

		// modified
		$invoices->modified->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_modified"));
		$invoices->modified->AdvancedSearch->SearchOperator = $objForm->GetValue("z_modified");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $invoices;

		// Initialize URLs
		// Call Row_Rendering event

		$invoices->Row_Rendering();

		// Common render codes for all row types
		// id

		$invoices->id->CellCssStyle = ""; $invoices->id->CellCssClass = "";
		$invoices->id->CellAttrs = array(); $invoices->id->ViewAttrs = array(); $invoices->id->EditAttrs = array();

		// Invoice_Number
		$invoices->Invoice_Number->CellCssStyle = ""; $invoices->Invoice_Number->CellCssClass = "";
		$invoices->Invoice_Number->CellAttrs = array(); $invoices->Invoice_Number->ViewAttrs = array(); $invoices->Invoice_Number->EditAttrs = array();

		// Client_ID
		$invoices->Client_ID->CellCssStyle = ""; $invoices->Client_ID->CellCssClass = "";
		$invoices->Client_ID->CellAttrs = array(); $invoices->Client_ID->ViewAttrs = array(); $invoices->Client_ID->EditAttrs = array();

		// Invoice_Date
		$invoices->Invoice_Date->CellCssStyle = ""; $invoices->Invoice_Date->CellCssClass = "";
		$invoices->Invoice_Date->CellAttrs = array(); $invoices->Invoice_Date->ViewAttrs = array(); $invoices->Invoice_Date->EditAttrs = array();

		// Due_Date
		$invoices->Due_Date->CellCssStyle = ""; $invoices->Due_Date->CellCssClass = "";
		$invoices->Due_Date->CellAttrs = array(); $invoices->Due_Date->ViewAttrs = array(); $invoices->Due_Date->EditAttrs = array();

		// payment_period
		$invoices->payment_period->CellCssStyle = ""; $invoices->payment_period->CellCssClass = "";
		$invoices->payment_period->CellAttrs = array(); $invoices->payment_period->ViewAttrs = array(); $invoices->payment_period->EditAttrs = array();

		// Total_Vat
		$invoices->Total_Vat->CellCssStyle = ""; $invoices->Total_Vat->CellCssClass = "";
		$invoices->Total_Vat->CellAttrs = array(); $invoices->Total_Vat->ViewAttrs = array(); $invoices->Total_Vat->EditAttrs = array();

		// Total_WTax
		$invoices->Total_WTax->CellCssStyle = ""; $invoices->Total_WTax->CellCssClass = "";
		$invoices->Total_WTax->CellAttrs = array(); $invoices->Total_WTax->ViewAttrs = array(); $invoices->Total_WTax->EditAttrs = array();

		// Total_Freight
		$invoices->Total_Freight->CellCssStyle = ""; $invoices->Total_Freight->CellCssClass = "";
		$invoices->Total_Freight->CellAttrs = array(); $invoices->Total_Freight->ViewAttrs = array(); $invoices->Total_Freight->EditAttrs = array();

		// Total_Amount_Due
		$invoices->Total_Amount_Due->CellCssStyle = ""; $invoices->Total_Amount_Due->CellCssClass = "";
		$invoices->Total_Amount_Due->CellAttrs = array(); $invoices->Total_Amount_Due->ViewAttrs = array(); $invoices->Total_Amount_Due->EditAttrs = array();

		// Payment_Reference
		$invoices->Payment_Reference->CellCssStyle = ""; $invoices->Payment_Reference->CellCssClass = "";
		$invoices->Payment_Reference->CellAttrs = array(); $invoices->Payment_Reference->ViewAttrs = array(); $invoices->Payment_Reference->EditAttrs = array();

		// Payment_Status
		$invoices->Payment_Status->CellCssStyle = ""; $invoices->Payment_Status->CellCssClass = "";
		$invoices->Payment_Status->CellAttrs = array(); $invoices->Payment_Status->ViewAttrs = array(); $invoices->Payment_Status->EditAttrs = array();

		// Status
		$invoices->Status->CellCssStyle = ""; $invoices->Status->CellCssClass = "";
		$invoices->Status->CellAttrs = array(); $invoices->Status->ViewAttrs = array(); $invoices->Status->EditAttrs = array();

		// Recipient_Bank
		$invoices->Recipient_Bank->CellCssStyle = ""; $invoices->Recipient_Bank->CellCssClass = "";
		$invoices->Recipient_Bank->CellAttrs = array(); $invoices->Recipient_Bank->ViewAttrs = array(); $invoices->Recipient_Bank->EditAttrs = array();

		// Remarks
		$invoices->Remarks->CellCssStyle = ""; $invoices->Remarks->CellCssClass = "";
		$invoices->Remarks->CellAttrs = array(); $invoices->Remarks->ViewAttrs = array(); $invoices->Remarks->EditAttrs = array();

		// User_ID
		$invoices->User_ID->CellCssStyle = ""; $invoices->User_ID->CellCssClass = "";
		$invoices->User_ID->CellAttrs = array(); $invoices->User_ID->ViewAttrs = array(); $invoices->User_ID->EditAttrs = array();

		// created
		$invoices->created->CellCssStyle = ""; $invoices->created->CellCssClass = "";
		$invoices->created->CellAttrs = array(); $invoices->created->ViewAttrs = array(); $invoices->created->EditAttrs = array();

		// modified
		$invoices->modified->CellCssStyle = ""; $invoices->modified->CellCssClass = "";
		$invoices->modified->CellAttrs = array(); $invoices->modified->ViewAttrs = array(); $invoices->modified->EditAttrs = array();
		if ($invoices->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$invoices->id->ViewValue = $invoices->id->CurrentValue;
			$invoices->id->CssStyle = "";
			$invoices->id->CssClass = "";
			$invoices->id->ViewCustomAttributes = "";

			// Invoice_Number
			$invoices->Invoice_Number->ViewValue = $invoices->Invoice_Number->CurrentValue;
			$invoices->Invoice_Number->CssStyle = "";
			$invoices->Invoice_Number->CssClass = "";
			$invoices->Invoice_Number->ViewCustomAttributes = "";

			// Client_ID
			if (strval($invoices->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Client_ID->CurrentValue) . "";
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
					$invoices->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$invoices->Client_ID->ViewValue = $invoices->Client_ID->CurrentValue;
				}
			} else {
				$invoices->Client_ID->ViewValue = NULL;
			}
			$invoices->Client_ID->CssStyle = "";
			$invoices->Client_ID->CssClass = "";
			$invoices->Client_ID->ViewCustomAttributes = "";

			// Invoice_Date
			$invoices->Invoice_Date->ViewValue = $invoices->Invoice_Date->CurrentValue;
			$invoices->Invoice_Date->ViewValue = ew_FormatDateTime($invoices->Invoice_Date->ViewValue, 6);
			$invoices->Invoice_Date->CssStyle = "";
			$invoices->Invoice_Date->CssClass = "";
			$invoices->Invoice_Date->ViewCustomAttributes = "";

			// Due_Date
			$invoices->Due_Date->ViewValue = $invoices->Due_Date->CurrentValue;
			$invoices->Due_Date->ViewValue = ew_FormatDateTime($invoices->Due_Date->ViewValue, 6);
			$invoices->Due_Date->CssStyle = "";
			$invoices->Due_Date->CssClass = "";
			$invoices->Due_Date->ViewCustomAttributes = "";

			// payment_period
			if (strval($invoices->payment_period->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->payment_period->CurrentValue) . "";
			$sSqlWrk = "SELECT `payment_period` FROM `client_payment_period`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->payment_period->ViewValue = $rswrk->fields('payment_period');
					$rswrk->Close();
				} else {
					$invoices->payment_period->ViewValue = $invoices->payment_period->CurrentValue;
				}
			} else {
				$invoices->payment_period->ViewValue = NULL;
			}
			$invoices->payment_period->CssStyle = "";
			$invoices->payment_period->CssClass = "";
			$invoices->payment_period->ViewCustomAttributes = "";

			// Total_Vat
			$invoices->Total_Vat->ViewValue = $invoices->Total_Vat->CurrentValue;
			$invoices->Total_Vat->ViewValue = ew_FormatNumber($invoices->Total_Vat->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Vat->CssStyle = "";
			$invoices->Total_Vat->CssClass = "";
			$invoices->Total_Vat->ViewCustomAttributes = "";

			// Total_WTax
			$invoices->Total_WTax->ViewValue = $invoices->Total_WTax->CurrentValue;
			$invoices->Total_WTax->ViewValue = ew_FormatNumber($invoices->Total_WTax->ViewValue, 2, -2, -2, -2);
			$invoices->Total_WTax->CssStyle = "";
			$invoices->Total_WTax->CssClass = "";
			$invoices->Total_WTax->ViewCustomAttributes = "";

			// Total_Freight
			$invoices->Total_Freight->ViewValue = $invoices->Total_Freight->CurrentValue;
			$invoices->Total_Freight->ViewValue = ew_FormatNumber($invoices->Total_Freight->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Freight->CssStyle = "";
			$invoices->Total_Freight->CssClass = "";
			$invoices->Total_Freight->ViewCustomAttributes = "";

			// Total_Amount_Due
			$invoices->Total_Amount_Due->ViewValue = $invoices->Total_Amount_Due->CurrentValue;
			$invoices->Total_Amount_Due->ViewValue = ew_FormatNumber($invoices->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Amount_Due->CssStyle = "";
			$invoices->Total_Amount_Due->CssClass = "";
			$invoices->Total_Amount_Due->ViewCustomAttributes = "";

			// Payment_Reference
			$invoices->Payment_Reference->ViewValue = $invoices->Payment_Reference->CurrentValue;
			$invoices->Payment_Reference->CssStyle = "";
			$invoices->Payment_Reference->CssClass = "";
			$invoices->Payment_Reference->ViewCustomAttributes = "";

			// Payment_Status
			if (strval($invoices->Payment_Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Payment_Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Payment_Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$invoices->Payment_Status->ViewValue = $invoices->Payment_Status->CurrentValue;
				}
			} else {
				$invoices->Payment_Status->ViewValue = NULL;
			}
			$invoices->Payment_Status->CssStyle = "";
			$invoices->Payment_Status->CssClass = "";
			$invoices->Payment_Status->ViewCustomAttributes = "";

			// Status
			if (strval($invoices->Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$invoices->Status->ViewValue = $invoices->Status->CurrentValue;
				}
			} else {
				$invoices->Status->ViewValue = NULL;
			}
			$invoices->Status->CssStyle = "";
			$invoices->Status->CssClass = "";
			$invoices->Status->ViewCustomAttributes = "";

			// Recipient_Bank
			if (strval($invoices->Recipient_Bank->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Recipient_Bank->CurrentValue) . "";
			$sSqlWrk = "SELECT `Bank_Name`, `Account_Number` FROM `banks_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Bank_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Recipient_Bank->ViewValue = $rswrk->fields('Bank_Name');
					$invoices->Recipient_Bank->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('Account_Number');
					$rswrk->Close();
				} else {
					$invoices->Recipient_Bank->ViewValue = $invoices->Recipient_Bank->CurrentValue;
				}
			} else {
				$invoices->Recipient_Bank->ViewValue = NULL;
			}
			$invoices->Recipient_Bank->CssStyle = "";
			$invoices->Recipient_Bank->CssClass = "";
			$invoices->Recipient_Bank->ViewCustomAttributes = "";

			// Remarks
			$invoices->Remarks->ViewValue = $invoices->Remarks->CurrentValue;
			$invoices->Remarks->CssStyle = "";
			$invoices->Remarks->CssClass = "";
			$invoices->Remarks->ViewCustomAttributes = "";

			// User_ID
			$invoices->User_ID->ViewValue = $invoices->User_ID->CurrentValue;
			$invoices->User_ID->CssStyle = "";
			$invoices->User_ID->CssClass = "";
			$invoices->User_ID->ViewCustomAttributes = "";

			// created
			$invoices->created->ViewValue = $invoices->created->CurrentValue;
			$invoices->created->ViewValue = ew_FormatDateTime($invoices->created->ViewValue, 6);
			$invoices->created->CssStyle = "";
			$invoices->created->CssClass = "";
			$invoices->created->ViewCustomAttributes = "";

			// modified
			$invoices->modified->ViewValue = $invoices->modified->CurrentValue;
			$invoices->modified->ViewValue = ew_FormatDateTime($invoices->modified->ViewValue, 6);
			$invoices->modified->CssStyle = "";
			$invoices->modified->CssClass = "";
			$invoices->modified->ViewCustomAttributes = "";

			// id
			$invoices->id->HrefValue = "";
			$invoices->id->TooltipValue = "";

			// Invoice_Number
			$invoices->Invoice_Number->HrefValue = "";
			$invoices->Invoice_Number->TooltipValue = "";

			// Client_ID
			$invoices->Client_ID->HrefValue = "";
			$invoices->Client_ID->TooltipValue = "";

			// Invoice_Date
			$invoices->Invoice_Date->HrefValue = "";
			$invoices->Invoice_Date->TooltipValue = "";

			// Due_Date
			$invoices->Due_Date->HrefValue = "";
			$invoices->Due_Date->TooltipValue = "";

			// payment_period
			$invoices->payment_period->HrefValue = "";
			$invoices->payment_period->TooltipValue = "";

			// Total_Vat
			$invoices->Total_Vat->HrefValue = "";
			$invoices->Total_Vat->TooltipValue = "";

			// Total_WTax
			$invoices->Total_WTax->HrefValue = "";
			$invoices->Total_WTax->TooltipValue = "";

			// Total_Freight
			$invoices->Total_Freight->HrefValue = "";
			$invoices->Total_Freight->TooltipValue = "";

			// Total_Amount_Due
			$invoices->Total_Amount_Due->HrefValue = "";
			$invoices->Total_Amount_Due->TooltipValue = "";

			// Payment_Reference
			$invoices->Payment_Reference->HrefValue = "";
			$invoices->Payment_Reference->TooltipValue = "";

			// Payment_Status
			$invoices->Payment_Status->HrefValue = "";
			$invoices->Payment_Status->TooltipValue = "";

			// Status
			$invoices->Status->HrefValue = "";
			$invoices->Status->TooltipValue = "";

			// Recipient_Bank
			$invoices->Recipient_Bank->HrefValue = "";
			$invoices->Recipient_Bank->TooltipValue = "";

			// Remarks
			$invoices->Remarks->HrefValue = "";
			$invoices->Remarks->TooltipValue = "";

			// User_ID
			$invoices->User_ID->HrefValue = "";
			$invoices->User_ID->TooltipValue = "";

			// created
			$invoices->created->HrefValue = "";
			$invoices->created->TooltipValue = "";

			// modified
			$invoices->modified->HrefValue = "";
			$invoices->modified->TooltipValue = "";
		} elseif ($invoices->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$invoices->id->EditCustomAttributes = "";
			$invoices->id->EditValue = ew_HtmlEncode($invoices->id->AdvancedSearch->SearchValue);

			// Invoice_Number
			$invoices->Invoice_Number->EditCustomAttributes = "";
			$invoices->Invoice_Number->EditValue = ew_HtmlEncode($invoices->Invoice_Number->AdvancedSearch->SearchValue);

			// Client_ID
			$invoices->Client_ID->EditCustomAttributes = "";
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
			$invoices->Client_ID->EditValue = $arwrk;

			// Invoice_Date
			$invoices->Invoice_Date->EditCustomAttributes = "";
			$invoices->Invoice_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($invoices->Invoice_Date->AdvancedSearch->SearchValue, 6), 6));
			$invoices->Invoice_Date->EditCustomAttributes = "";
			$invoices->Invoice_Date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($invoices->Invoice_Date->AdvancedSearch->SearchValue2, 6), 6));

			// Due_Date
			$invoices->Due_Date->EditCustomAttributes = "";
			$invoices->Due_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($invoices->Due_Date->AdvancedSearch->SearchValue, 6), 6));
			$invoices->Due_Date->EditCustomAttributes = "";
			$invoices->Due_Date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($invoices->Due_Date->AdvancedSearch->SearchValue2, 6), 6));

			// payment_period
			$invoices->payment_period->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `payment_period`, '' AS Disp2Fld, `client_id` FROM `client_payment_period`";
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
			$invoices->payment_period->EditValue = $arwrk;

			// Total_Vat
			$invoices->Total_Vat->EditCustomAttributes = "";
			$invoices->Total_Vat->EditValue = ew_HtmlEncode($invoices->Total_Vat->AdvancedSearch->SearchValue);

			// Total_WTax
			$invoices->Total_WTax->EditCustomAttributes = "";
			$invoices->Total_WTax->EditValue = ew_HtmlEncode($invoices->Total_WTax->AdvancedSearch->SearchValue);

			// Total_Freight
			$invoices->Total_Freight->EditCustomAttributes = "";
			$invoices->Total_Freight->EditValue = ew_HtmlEncode($invoices->Total_Freight->AdvancedSearch->SearchValue);

			// Total_Amount_Due
			$invoices->Total_Amount_Due->EditCustomAttributes = "";
			$invoices->Total_Amount_Due->EditValue = ew_HtmlEncode($invoices->Total_Amount_Due->AdvancedSearch->SearchValue);

			// Payment_Reference
			$invoices->Payment_Reference->EditCustomAttributes = "";
			$invoices->Payment_Reference->EditValue = ew_HtmlEncode($invoices->Payment_Reference->AdvancedSearch->SearchValue);

			// Payment_Status
			$invoices->Payment_Status->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Status`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$invoices->Payment_Status->EditValue = $arwrk;

			// Status
			$invoices->Status->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Status`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$invoices->Status->EditValue = $arwrk;

			// Recipient_Bank
			$invoices->Recipient_Bank->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Bank_Name`, `Account_Number`, '' AS SelectFilterFld FROM `banks_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Bank_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$invoices->Recipient_Bank->EditValue = $arwrk;

			// Remarks
			$invoices->Remarks->EditCustomAttributes = "";
			$invoices->Remarks->EditValue = ew_HtmlEncode($invoices->Remarks->AdvancedSearch->SearchValue);

			// User_ID
			$invoices->User_ID->EditCustomAttributes = "";
			$invoices->User_ID->EditValue = ew_HtmlEncode($invoices->User_ID->AdvancedSearch->SearchValue);

			// created
			$invoices->created->EditCustomAttributes = "";
			$invoices->created->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($invoices->created->AdvancedSearch->SearchValue, 6), 6));

			// modified
			$invoices->modified->EditCustomAttributes = "";
			$invoices->modified->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($invoices->modified->AdvancedSearch->SearchValue, 6), 6));
		}

		// Call Row Rendered event
		if ($invoices->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$invoices->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $invoices;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($invoices->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->id->FldErrMsg();
		}
		if (!ew_CheckUSDate($invoices->Invoice_Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->Invoice_Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($invoices->Invoice_Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->Invoice_Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($invoices->Due_Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->Due_Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($invoices->Due_Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->Due_Date->FldErrMsg();
		}
		if (!ew_CheckNumber($invoices->Total_Vat->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->Total_Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($invoices->Total_WTax->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->Total_WTax->FldErrMsg();
		}
		if (!ew_CheckNumber($invoices->Total_Freight->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->Total_Freight->FldErrMsg();
		}
		if (!ew_CheckNumber($invoices->Total_Amount_Due->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->Total_Amount_Due->FldErrMsg();
		}
		if (!ew_CheckInteger($invoices->User_ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->User_ID->FldErrMsg();
		}
		if (!ew_CheckUSDate($invoices->created->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->created->FldErrMsg();
		}
		if (!ew_CheckUSDate($invoices->modified->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $invoices->modified->FldErrMsg();
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
		global $invoices;
		$invoices->id->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_id");
		$invoices->Invoice_Number->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Invoice_Number");
		$invoices->Client_ID->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Client_ID");
		$invoices->Invoice_Date->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Invoice_Date");
		$invoices->Invoice_Date->AdvancedSearch->SearchValue2 = $invoices->getAdvancedSearch("y_Invoice_Date");
		$invoices->Due_Date->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Due_Date");
		$invoices->Due_Date->AdvancedSearch->SearchValue2 = $invoices->getAdvancedSearch("y_Due_Date");
		$invoices->payment_period->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_payment_period");
		$invoices->Total_Vat->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Total_Vat");
		$invoices->Total_WTax->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Total_WTax");
		$invoices->Total_Freight->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Total_Freight");
		$invoices->Total_Amount_Due->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Total_Amount_Due");
		$invoices->Payment_Reference->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Payment_Reference");
		$invoices->Payment_Status->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Payment_Status");
		$invoices->Status->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Status");
		$invoices->Recipient_Bank->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Recipient_Bank");
		$invoices->Remarks->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_Remarks");
		$invoices->User_ID->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_User_ID");
		$invoices->created->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_created");
		$invoices->modified->AdvancedSearch->SearchValue = $invoices->getAdvancedSearch("x_modified");
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
