<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "accounts_receivableinfo.php" ?>
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
$accounts_receivable_search = new caccounts_receivable_search();
$Page =& $accounts_receivable_search;

// Page init
$accounts_receivable_search->Page_Init();

// Page main
$accounts_receivable_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var accounts_receivable_search = new ew_Page("accounts_receivable_search");

// page properties
accounts_receivable_search.PageID = "search"; // page ID
accounts_receivable_search.FormID = "faccounts_receivablesearch"; // form ID
var EW_PAGE_ID = accounts_receivable_search.PageID; // for backward compatibility

// extend page with validate function for search
accounts_receivable_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Destination_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->Destination_ID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETA"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->ETA->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ETD"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->ETD->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Vat"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->Vat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Sales"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->Total_Sales->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Wtax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->Wtax->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Amount_Due"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->Total_Amount_Due->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($accounts_receivable->id->FldErrMsg()) ?>");

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
accounts_receivable_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
accounts_receivable_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
accounts_receivable_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $accounts_receivable->TableCaption() ?><br><br>
<a href="<?php echo $accounts_receivable->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$accounts_receivable_search->ShowMessage();
?>
<form name="faccounts_receivablesearch" id="faccounts_receivablesearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return accounts_receivable_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="accounts_receivable">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $accounts_receivable->Booking_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Booking_Number->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Booking_Number->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Booking_Number" id="z_Booking_Number" value="LIKE"></span></td>
		<td<?php echo $accounts_receivable->Booking_Number->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Booking_Number" id="x_Booking_Number" title="<?php echo $accounts_receivable->Booking_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $accounts_receivable->Booking_Number->EditValue ?>"<?php echo $accounts_receivable->Booking_Number->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $accounts_receivable->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Date->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Date" id="z_Date" value="BETWEEN"></span></td>
		<td<?php echo $accounts_receivable->Date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Date" id="x_Date" title="<?php echo $accounts_receivable->Date->FldTitle() ?>" value="<?php echo $accounts_receivable->Date->EditValue ?>"<?php echo $accounts_receivable->Date->EditAttributes() ?>>
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
<input type="text" name="y_Date" id="y_Date" title="<?php echo $accounts_receivable->Date->FldTitle() ?>" value="<?php echo $accounts_receivable->Date->EditValue2 ?>"<?php echo $accounts_receivable->Date->EditAttributes() ?>>
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
	<tr<?php echo $accounts_receivable->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Client_ID->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Client_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td<?php echo $accounts_receivable->Client_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $accounts_receivable->Client_ID->FldTitle() ?>"<?php echo $accounts_receivable->Client_ID->EditAttributes() ?>>
<?php
if (is_array($accounts_receivable->Client_ID->EditValue)) {
	$arwrk = $accounts_receivable->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($accounts_receivable->Client_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $accounts_receivable->Origin_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Origin_ID->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Origin_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Origin_ID" id="z_Origin_ID" value="="></span></td>
		<td<?php echo $accounts_receivable->Origin_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Origin_ID" name="x_Origin_ID" title="<?php echo $accounts_receivable->Origin_ID->FldTitle() ?>"<?php echo $accounts_receivable->Origin_ID->EditAttributes() ?>>
<?php
if (is_array($accounts_receivable->Origin_ID->EditValue)) {
	$arwrk = $accounts_receivable->Origin_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($accounts_receivable->Origin_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $accounts_receivable->Destination_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Destination_ID->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Destination_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Destination_ID" id="z_Destination_ID" value="="></span></td>
		<td<?php echo $accounts_receivable->Destination_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="as_x_Destination_ID" style="z-index: 8950">
	<input type="text" name="sv_x_Destination_ID" id="sv_x_Destination_ID" value="<?php echo $accounts_receivable->Destination_ID->EditValue ?>" title="<?php echo $accounts_receivable->Destination_ID->FldTitle() ?>" size="30"<?php echo $accounts_receivable->Destination_ID->EditAttributes() ?>>&nbsp;<span id="em_x_Destination_ID" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_Destination_ID"></div>
</div>
<input type="hidden" name="x_Destination_ID" id="x_Destination_ID" value="<?php echo $accounts_receivable->Destination_ID->AdvancedSearch->SearchValue ?>">
<?php
$sSqlWrk = "SELECT `id`, `Destination` FROM `destinations`";
$sWhereWrk = "`Destination` LIKE '{query_value}%'";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_Destination_ID" id="s_x_Destination_ID" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_Destination_ID = new ew_AutoSuggest("sv_x_Destination_ID", "sc_x_Destination_ID", "s_x_Destination_ID", "em_x_Destination_ID", "x_Destination_ID", "", false);
oas_x_Destination_ID.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_Destination_ID.ac.typeAhead = false;

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $accounts_receivable->Customer_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Customer_ID->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Customer_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Customer_ID" id="z_Customer_ID" value="="></span></td>
		<td<?php echo $accounts_receivable->Customer_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Customer_ID" name="x_Customer_ID" title="<?php echo $accounts_receivable->Customer_ID->FldTitle() ?>"<?php echo $accounts_receivable->Customer_ID->EditAttributes() ?>>
<?php
if (is_array($accounts_receivable->Customer_ID->EditValue)) {
	$arwrk = $accounts_receivable->Customer_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($accounts_receivable->Customer_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $accounts_receivable->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Subcon_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="="></span></td>
		<td<?php echo $accounts_receivable->Subcon_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Subcon_ID" name="x_Subcon_ID" title="<?php echo $accounts_receivable->Subcon_ID->FldTitle() ?>"<?php echo $accounts_receivable->Subcon_ID->EditAttributes() ?>>
<?php
if (is_array($accounts_receivable->Subcon_ID->EditValue)) {
	$arwrk = $accounts_receivable->Subcon_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($accounts_receivable->Subcon_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $accounts_receivable->Truck_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Truck_ID->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Truck_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_ID" id="z_Truck_ID" value="="></span></td>
		<td<?php echo $accounts_receivable->Truck_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Truck_ID" name="x_Truck_ID" title="<?php echo $accounts_receivable->Truck_ID->FldTitle() ?>"<?php echo $accounts_receivable->Truck_ID->EditAttributes() ?>>
<?php
if (is_array($accounts_receivable->Truck_ID->EditValue)) {
	$arwrk = $accounts_receivable->Truck_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($accounts_receivable->Truck_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $accounts_receivable->ETA->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->ETA->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->ETA->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETA" id="z_ETA" value="BETWEEN"></span></td>
		<td<?php echo $accounts_receivable->ETA->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ETA" id="x_ETA" title="<?php echo $accounts_receivable->ETA->FldTitle() ?>" value="<?php echo $accounts_receivable->ETA->EditValue ?>"<?php echo $accounts_receivable->ETA->EditAttributes() ?>>
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
<input type="text" name="y_ETA" id="y_ETA" title="<?php echo $accounts_receivable->ETA->FldTitle() ?>" value="<?php echo $accounts_receivable->ETA->EditValue2 ?>"<?php echo $accounts_receivable->ETA->EditAttributes() ?>>
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
	<tr<?php echo $accounts_receivable->ETD->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->ETD->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->ETD->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETD" id="z_ETD" value="BETWEEN"></span></td>
		<td<?php echo $accounts_receivable->ETD->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ETD" id="x_ETD" title="<?php echo $accounts_receivable->ETD->FldTitle() ?>" value="<?php echo $accounts_receivable->ETD->EditValue ?>"<?php echo $accounts_receivable->ETD->EditAttributes() ?>>
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
<input type="text" name="y_ETD" id="y_ETD" title="<?php echo $accounts_receivable->ETD->FldTitle() ?>" value="<?php echo $accounts_receivable->ETD->EditValue2 ?>"<?php echo $accounts_receivable->ETD->EditAttributes() ?>>
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
	<tr<?php echo $accounts_receivable->Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Status_ID->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Status_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Status_ID" id="z_Status_ID" value="="></span></td>
		<td<?php echo $accounts_receivable->Status_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Status_ID" name="x_Status_ID" title="<?php echo $accounts_receivable->Status_ID->FldTitle() ?>"<?php echo $accounts_receivable->Status_ID->EditAttributes() ?>>
<?php
if (is_array($accounts_receivable->Status_ID->EditValue)) {
	$arwrk = $accounts_receivable->Status_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($accounts_receivable->Status_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $accounts_receivable->Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Vat->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Vat->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Vat" id="z_Vat" value="="></span></td>
		<td<?php echo $accounts_receivable->Vat->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Vat" id="x_Vat" title="<?php echo $accounts_receivable->Vat->FldTitle() ?>" size="30" value="<?php echo $accounts_receivable->Vat->EditValue ?>"<?php echo $accounts_receivable->Vat->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $accounts_receivable->Total_Sales->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Total_Sales->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Total_Sales->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Sales" id="z_Total_Sales" value="="></span></td>
		<td<?php echo $accounts_receivable->Total_Sales->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Sales" id="x_Total_Sales" title="<?php echo $accounts_receivable->Total_Sales->FldTitle() ?>" size="30" value="<?php echo $accounts_receivable->Total_Sales->EditValue ?>"<?php echo $accounts_receivable->Total_Sales->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $accounts_receivable->Wtax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Wtax->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Wtax->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Wtax" id="z_Wtax" value="="></span></td>
		<td<?php echo $accounts_receivable->Wtax->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Wtax" id="x_Wtax" title="<?php echo $accounts_receivable->Wtax->FldTitle() ?>" size="30" value="<?php echo $accounts_receivable->Wtax->EditValue ?>"<?php echo $accounts_receivable->Wtax->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $accounts_receivable->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->Total_Amount_Due->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Total_Amount_Due" id="z_Total_Amount_Due" value="="></span></td>
		<td<?php echo $accounts_receivable->Total_Amount_Due->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $accounts_receivable->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $accounts_receivable->Total_Amount_Due->EditValue ?>"<?php echo $accounts_receivable->Total_Amount_Due->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $accounts_receivable->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $accounts_receivable->id->FldCaption() ?></td>
		<td<?php echo $accounts_receivable->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $accounts_receivable->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $accounts_receivable->id->FldTitle() ?>" value="<?php echo $accounts_receivable->id->EditValue ?>"<?php echo $accounts_receivable->id->EditAttributes() ?>>
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
$accounts_receivable_search->Page_Terminate();
?>
<?php

//
// Page class
//
class caccounts_receivable_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'accounts_receivable';

	// Page object name
	var $PageObjName = 'accounts_receivable_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $accounts_receivable;
		if ($accounts_receivable->UseTokenInUrl) $PageUrl .= "t=" . $accounts_receivable->TableVar . "&"; // Add page token
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
		global $objForm, $accounts_receivable;
		if ($accounts_receivable->UseTokenInUrl) {
			if ($objForm)
				return ($accounts_receivable->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($accounts_receivable->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caccounts_receivable_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (accounts_receivable)
		$GLOBALS["accounts_receivable"] = new caccounts_receivable();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'accounts_receivable', TRUE);

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
		global $accounts_receivable;

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
			$this->Page_Terminate("accounts_receivablelist.php");
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
		global $objForm, $Language, $gsSearchError, $accounts_receivable;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$accounts_receivable->CurrentAction = $objForm->GetValue("a_search");
			switch ($accounts_receivable->CurrentAction) {
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
						$sSrchStr = $accounts_receivable->UrlParm($sSrchStr);
						$this->Page_Terminate("accounts_receivablelist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$accounts_receivable->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $accounts_receivable;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Booking_Number); // Booking_Number
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Date); // Date
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Client_ID); // Client_ID
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Origin_ID); // Origin_ID
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Destination_ID); // Destination_ID
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Customer_ID); // Customer_ID
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Subcon_ID); // Subcon_ID
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Truck_ID); // Truck_ID
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->ETA); // ETA
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->ETD); // ETD
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Status_ID); // Status_ID
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Vat); // Vat
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Total_Sales); // Total_Sales
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Wtax); // Wtax
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->Total_Amount_Due); // Total_Amount_Due
	$this->BuildSearchUrl($sSrchUrl, $accounts_receivable->id); // id
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
		global $objForm, $accounts_receivable;

		// Load search values
		// Booking_Number

		$accounts_receivable->Booking_Number->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Booking_Number"));
		$accounts_receivable->Booking_Number->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Booking_Number");

		// Date
		$accounts_receivable->Date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Date"));
		$accounts_receivable->Date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Date");
		$accounts_receivable->Date->AdvancedSearch->SearchCondition = $objForm->GetValue("v_Date");
		$accounts_receivable->Date->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_Date"));
		$accounts_receivable->Date->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_Date");

		// Client_ID
		$accounts_receivable->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Client_ID"));
		$accounts_receivable->Client_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Client_ID");

		// Origin_ID
		$accounts_receivable->Origin_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Origin_ID"));
		$accounts_receivable->Origin_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Origin_ID");

		// Destination_ID
		$accounts_receivable->Destination_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Destination_ID"));
		$accounts_receivable->Destination_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Destination_ID");

		// Customer_ID
		$accounts_receivable->Customer_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Customer_ID"));
		$accounts_receivable->Customer_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Customer_ID");

		// Subcon_ID
		$accounts_receivable->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Subcon_ID"));
		$accounts_receivable->Subcon_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Subcon_ID");

		// Truck_ID
		$accounts_receivable->Truck_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Truck_ID"));
		$accounts_receivable->Truck_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Truck_ID");

		// ETA
		$accounts_receivable->ETA->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ETA"));
		$accounts_receivable->ETA->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ETA");
		$accounts_receivable->ETA->AdvancedSearch->SearchCondition = $objForm->GetValue("v_ETA");
		$accounts_receivable->ETA->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_ETA"));
		$accounts_receivable->ETA->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_ETA");

		// ETD
		$accounts_receivable->ETD->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ETD"));
		$accounts_receivable->ETD->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ETD");
		$accounts_receivable->ETD->AdvancedSearch->SearchCondition = $objForm->GetValue("v_ETD");
		$accounts_receivable->ETD->AdvancedSearch->SearchValue2 = ew_StripSlashes($objForm->GetValue("y_ETD"));
		$accounts_receivable->ETD->AdvancedSearch->SearchOperator2 = $objForm->GetValue("w_ETD");

		// Status_ID
		$accounts_receivable->Status_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Status_ID"));
		$accounts_receivable->Status_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Status_ID");

		// Vat
		$accounts_receivable->Vat->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Vat"));
		$accounts_receivable->Vat->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Vat");

		// Total_Sales
		$accounts_receivable->Total_Sales->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Sales"));
		$accounts_receivable->Total_Sales->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Sales");

		// Wtax
		$accounts_receivable->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Wtax"));
		$accounts_receivable->Wtax->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Wtax");

		// Total_Amount_Due
		$accounts_receivable->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Total_Amount_Due"));
		$accounts_receivable->Total_Amount_Due->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Total_Amount_Due");

		// id
		$accounts_receivable->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$accounts_receivable->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $accounts_receivable;

		// Initialize URLs
		// Call Row_Rendering event

		$accounts_receivable->Row_Rendering();

		// Common render codes for all row types
		// Booking_Number

		$accounts_receivable->Booking_Number->CellCssStyle = ""; $accounts_receivable->Booking_Number->CellCssClass = "";
		$accounts_receivable->Booking_Number->CellAttrs = array(); $accounts_receivable->Booking_Number->ViewAttrs = array(); $accounts_receivable->Booking_Number->EditAttrs = array();

		// Date
		$accounts_receivable->Date->CellCssStyle = ""; $accounts_receivable->Date->CellCssClass = "";
		$accounts_receivable->Date->CellAttrs = array(); $accounts_receivable->Date->ViewAttrs = array(); $accounts_receivable->Date->EditAttrs = array();

		// Client_ID
		$accounts_receivable->Client_ID->CellCssStyle = ""; $accounts_receivable->Client_ID->CellCssClass = "";
		$accounts_receivable->Client_ID->CellAttrs = array(); $accounts_receivable->Client_ID->ViewAttrs = array(); $accounts_receivable->Client_ID->EditAttrs = array();

		// Origin_ID
		$accounts_receivable->Origin_ID->CellCssStyle = ""; $accounts_receivable->Origin_ID->CellCssClass = "";
		$accounts_receivable->Origin_ID->CellAttrs = array(); $accounts_receivable->Origin_ID->ViewAttrs = array(); $accounts_receivable->Origin_ID->EditAttrs = array();

		// Destination_ID
		$accounts_receivable->Destination_ID->CellCssStyle = ""; $accounts_receivable->Destination_ID->CellCssClass = "";
		$accounts_receivable->Destination_ID->CellAttrs = array(); $accounts_receivable->Destination_ID->ViewAttrs = array(); $accounts_receivable->Destination_ID->EditAttrs = array();

		// Customer_ID
		$accounts_receivable->Customer_ID->CellCssStyle = ""; $accounts_receivable->Customer_ID->CellCssClass = "";
		$accounts_receivable->Customer_ID->CellAttrs = array(); $accounts_receivable->Customer_ID->ViewAttrs = array(); $accounts_receivable->Customer_ID->EditAttrs = array();

		// Subcon_ID
		$accounts_receivable->Subcon_ID->CellCssStyle = ""; $accounts_receivable->Subcon_ID->CellCssClass = "";
		$accounts_receivable->Subcon_ID->CellAttrs = array(); $accounts_receivable->Subcon_ID->ViewAttrs = array(); $accounts_receivable->Subcon_ID->EditAttrs = array();

		// Truck_ID
		$accounts_receivable->Truck_ID->CellCssStyle = ""; $accounts_receivable->Truck_ID->CellCssClass = "";
		$accounts_receivable->Truck_ID->CellAttrs = array(); $accounts_receivable->Truck_ID->ViewAttrs = array(); $accounts_receivable->Truck_ID->EditAttrs = array();

		// ETA
		$accounts_receivable->ETA->CellCssStyle = ""; $accounts_receivable->ETA->CellCssClass = "";
		$accounts_receivable->ETA->CellAttrs = array(); $accounts_receivable->ETA->ViewAttrs = array(); $accounts_receivable->ETA->EditAttrs = array();

		// ETD
		$accounts_receivable->ETD->CellCssStyle = ""; $accounts_receivable->ETD->CellCssClass = "";
		$accounts_receivable->ETD->CellAttrs = array(); $accounts_receivable->ETD->ViewAttrs = array(); $accounts_receivable->ETD->EditAttrs = array();

		// Status_ID
		$accounts_receivable->Status_ID->CellCssStyle = ""; $accounts_receivable->Status_ID->CellCssClass = "";
		$accounts_receivable->Status_ID->CellAttrs = array(); $accounts_receivable->Status_ID->ViewAttrs = array(); $accounts_receivable->Status_ID->EditAttrs = array();

		// Vat
		$accounts_receivable->Vat->CellCssStyle = ""; $accounts_receivable->Vat->CellCssClass = "";
		$accounts_receivable->Vat->CellAttrs = array(); $accounts_receivable->Vat->ViewAttrs = array(); $accounts_receivable->Vat->EditAttrs = array();

		// Total_Sales
		$accounts_receivable->Total_Sales->CellCssStyle = ""; $accounts_receivable->Total_Sales->CellCssClass = "";
		$accounts_receivable->Total_Sales->CellAttrs = array(); $accounts_receivable->Total_Sales->ViewAttrs = array(); $accounts_receivable->Total_Sales->EditAttrs = array();

		// Wtax
		$accounts_receivable->Wtax->CellCssStyle = ""; $accounts_receivable->Wtax->CellCssClass = "";
		$accounts_receivable->Wtax->CellAttrs = array(); $accounts_receivable->Wtax->ViewAttrs = array(); $accounts_receivable->Wtax->EditAttrs = array();

		// Total_Amount_Due
		$accounts_receivable->Total_Amount_Due->CellCssStyle = ""; $accounts_receivable->Total_Amount_Due->CellCssClass = "";
		$accounts_receivable->Total_Amount_Due->CellAttrs = array(); $accounts_receivable->Total_Amount_Due->ViewAttrs = array(); $accounts_receivable->Total_Amount_Due->EditAttrs = array();

		// id
		$accounts_receivable->id->CellCssStyle = ""; $accounts_receivable->id->CellCssClass = "";
		$accounts_receivable->id->CellAttrs = array(); $accounts_receivable->id->ViewAttrs = array(); $accounts_receivable->id->EditAttrs = array();
		if ($accounts_receivable->RowType == EW_ROWTYPE_VIEW) { // View row

			// Booking_Number
			$accounts_receivable->Booking_Number->ViewValue = $accounts_receivable->Booking_Number->CurrentValue;
			$accounts_receivable->Booking_Number->CssStyle = "";
			$accounts_receivable->Booking_Number->CssClass = "";
			$accounts_receivable->Booking_Number->ViewCustomAttributes = "";

			// Date
			$accounts_receivable->Date->ViewValue = $accounts_receivable->Date->CurrentValue;
			$accounts_receivable->Date->ViewValue = ew_FormatDateTime($accounts_receivable->Date->ViewValue, 6);
			$accounts_receivable->Date->CssStyle = "";
			$accounts_receivable->Date->CssClass = "";
			$accounts_receivable->Date->ViewCustomAttributes = "";

			// Client_ID
			if (strval($accounts_receivable->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($accounts_receivable->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$accounts_receivable->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$accounts_receivable->Client_ID->ViewValue = $accounts_receivable->Client_ID->CurrentValue;
				}
			} else {
				$accounts_receivable->Client_ID->ViewValue = NULL;
			}
			$accounts_receivable->Client_ID->CssStyle = "";
			$accounts_receivable->Client_ID->CssClass = "";
			$accounts_receivable->Client_ID->ViewCustomAttributes = "";

			// Origin_ID
			if (strval($accounts_receivable->Origin_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($accounts_receivable->Origin_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Origin` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$accounts_receivable->Origin_ID->ViewValue = $rswrk->fields('Origin');
					$rswrk->Close();
				} else {
					$accounts_receivable->Origin_ID->ViewValue = $accounts_receivable->Origin_ID->CurrentValue;
				}
			} else {
				$accounts_receivable->Origin_ID->ViewValue = NULL;
			}
			$accounts_receivable->Origin_ID->CssStyle = "";
			$accounts_receivable->Origin_ID->CssClass = "";
			$accounts_receivable->Origin_ID->ViewCustomAttributes = "";

			// Destination_ID
			$accounts_receivable->Destination_ID->ViewValue = $accounts_receivable->Destination_ID->CurrentValue;
			if (strval($accounts_receivable->Destination_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($accounts_receivable->Destination_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$accounts_receivable->Destination_ID->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$accounts_receivable->Destination_ID->ViewValue = $accounts_receivable->Destination_ID->CurrentValue;
				}
			} else {
				$accounts_receivable->Destination_ID->ViewValue = NULL;
			}
			$accounts_receivable->Destination_ID->CssStyle = "";
			$accounts_receivable->Destination_ID->CssClass = "";
			$accounts_receivable->Destination_ID->ViewCustomAttributes = "";

			// Customer_ID
			if (strval($accounts_receivable->Customer_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($accounts_receivable->Customer_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Customer_Name` FROM `consignees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$accounts_receivable->Customer_ID->ViewValue = $rswrk->fields('Customer_Name');
					$rswrk->Close();
				} else {
					$accounts_receivable->Customer_ID->ViewValue = $accounts_receivable->Customer_ID->CurrentValue;
				}
			} else {
				$accounts_receivable->Customer_ID->ViewValue = NULL;
			}
			$accounts_receivable->Customer_ID->CssStyle = "";
			$accounts_receivable->Customer_ID->CssClass = "";
			$accounts_receivable->Customer_ID->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($accounts_receivable->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($accounts_receivable->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$accounts_receivable->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$accounts_receivable->Subcon_ID->ViewValue = $accounts_receivable->Subcon_ID->CurrentValue;
				}
			} else {
				$accounts_receivable->Subcon_ID->ViewValue = NULL;
			}
			$accounts_receivable->Subcon_ID->CssStyle = "";
			$accounts_receivable->Subcon_ID->CssClass = "";
			$accounts_receivable->Subcon_ID->ViewCustomAttributes = "";

			// Truck_ID
			if (strval($accounts_receivable->Truck_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($accounts_receivable->Truck_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Plate_Number` FROM `trucks`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$accounts_receivable->Truck_ID->ViewValue = $rswrk->fields('Plate_Number');
					$rswrk->Close();
				} else {
					$accounts_receivable->Truck_ID->ViewValue = $accounts_receivable->Truck_ID->CurrentValue;
				}
			} else {
				$accounts_receivable->Truck_ID->ViewValue = NULL;
			}
			$accounts_receivable->Truck_ID->CssStyle = "";
			$accounts_receivable->Truck_ID->CssClass = "";
			$accounts_receivable->Truck_ID->ViewCustomAttributes = "";

			// ETA
			$accounts_receivable->ETA->ViewValue = $accounts_receivable->ETA->CurrentValue;
			$accounts_receivable->ETA->ViewValue = ew_FormatDateTime($accounts_receivable->ETA->ViewValue, 6);
			$accounts_receivable->ETA->CssStyle = "";
			$accounts_receivable->ETA->CssClass = "";
			$accounts_receivable->ETA->ViewCustomAttributes = "";

			// ETD
			$accounts_receivable->ETD->ViewValue = $accounts_receivable->ETD->CurrentValue;
			$accounts_receivable->ETD->ViewValue = ew_FormatDateTime($accounts_receivable->ETD->ViewValue, 6);
			$accounts_receivable->ETD->CssStyle = "";
			$accounts_receivable->ETD->CssClass = "";
			$accounts_receivable->ETD->ViewCustomAttributes = "";

			// Status_ID
			if (strval($accounts_receivable->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($accounts_receivable->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$accounts_receivable->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$accounts_receivable->Status_ID->ViewValue = $accounts_receivable->Status_ID->CurrentValue;
				}
			} else {
				$accounts_receivable->Status_ID->ViewValue = NULL;
			}
			$accounts_receivable->Status_ID->CssStyle = "";
			$accounts_receivable->Status_ID->CssClass = "";
			$accounts_receivable->Status_ID->ViewCustomAttributes = "";

			// Vat
			$accounts_receivable->Vat->ViewValue = $accounts_receivable->Vat->CurrentValue;
			$accounts_receivable->Vat->ViewValue = ew_FormatNumber($accounts_receivable->Vat->ViewValue, 2, -2, -2, -2);
			$accounts_receivable->Vat->CssStyle = "";
			$accounts_receivable->Vat->CssClass = "";
			$accounts_receivable->Vat->ViewCustomAttributes = "";

			// Total_Sales
			$accounts_receivable->Total_Sales->ViewValue = $accounts_receivable->Total_Sales->CurrentValue;
			$accounts_receivable->Total_Sales->ViewValue = ew_FormatNumber($accounts_receivable->Total_Sales->ViewValue, 2, -2, -2, -2);
			$accounts_receivable->Total_Sales->CssStyle = "";
			$accounts_receivable->Total_Sales->CssClass = "";
			$accounts_receivable->Total_Sales->ViewCustomAttributes = "";

			// Wtax
			$accounts_receivable->Wtax->ViewValue = $accounts_receivable->Wtax->CurrentValue;
			$accounts_receivable->Wtax->ViewValue = ew_FormatNumber($accounts_receivable->Wtax->ViewValue, 2, -2, -2, -2);
			$accounts_receivable->Wtax->CssStyle = "";
			$accounts_receivable->Wtax->CssClass = "";
			$accounts_receivable->Wtax->ViewCustomAttributes = "";

			// Total_Amount_Due
			$accounts_receivable->Total_Amount_Due->ViewValue = $accounts_receivable->Total_Amount_Due->CurrentValue;
			$accounts_receivable->Total_Amount_Due->ViewValue = ew_FormatNumber($accounts_receivable->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$accounts_receivable->Total_Amount_Due->CssStyle = "";
			$accounts_receivable->Total_Amount_Due->CssClass = "";
			$accounts_receivable->Total_Amount_Due->ViewCustomAttributes = "";

			// id
			$accounts_receivable->id->ViewValue = $accounts_receivable->id->CurrentValue;
			$accounts_receivable->id->CssStyle = "";
			$accounts_receivable->id->CssClass = "";
			$accounts_receivable->id->ViewCustomAttributes = "";

			// Booking_Number
			if (!ew_Empty($accounts_receivable->Booking_Number->CurrentValue)) {
				$accounts_receivable->Booking_Number->HrefValue = $accounts_receivable->Booking_Number->CurrentValue;
				if ($accounts_receivable->Export <> "") $accounts_receivable->Booking_Number->HrefValue = ew_ConvertFullUrl($accounts_receivable->Booking_Number->HrefValue);
			} else {
				$accounts_receivable->Booking_Number->HrefValue = "";
			}
			$accounts_receivable->Booking_Number->TooltipValue = "";

			// Date
			$accounts_receivable->Date->HrefValue = "";
			$accounts_receivable->Date->TooltipValue = "";

			// Client_ID
			if (!ew_Empty($accounts_receivable->Client_ID->CurrentValue)) {
				$accounts_receivable->Client_ID->HrefValue = $accounts_receivable->Client_ID->CurrentValue;
				if ($accounts_receivable->Export <> "") $accounts_receivable->Client_ID->HrefValue = ew_ConvertFullUrl($accounts_receivable->Client_ID->HrefValue);
			} else {
				$accounts_receivable->Client_ID->HrefValue = "";
			}
			$accounts_receivable->Client_ID->TooltipValue = "";

			// Origin_ID
			$accounts_receivable->Origin_ID->HrefValue = "";
			$accounts_receivable->Origin_ID->TooltipValue = "";

			// Destination_ID
			$accounts_receivable->Destination_ID->HrefValue = "";
			$accounts_receivable->Destination_ID->TooltipValue = "";

			// Customer_ID
			$accounts_receivable->Customer_ID->HrefValue = "";
			$accounts_receivable->Customer_ID->TooltipValue = "";

			// Subcon_ID
			$accounts_receivable->Subcon_ID->HrefValue = "";
			$accounts_receivable->Subcon_ID->TooltipValue = "";

			// Truck_ID
			$accounts_receivable->Truck_ID->HrefValue = "";
			$accounts_receivable->Truck_ID->TooltipValue = "";

			// ETA
			$accounts_receivable->ETA->HrefValue = "";
			$accounts_receivable->ETA->TooltipValue = "";

			// ETD
			$accounts_receivable->ETD->HrefValue = "";
			$accounts_receivable->ETD->TooltipValue = "";

			// Status_ID
			$accounts_receivable->Status_ID->HrefValue = "";
			$accounts_receivable->Status_ID->TooltipValue = "";

			// Vat
			$accounts_receivable->Vat->HrefValue = "";
			$accounts_receivable->Vat->TooltipValue = "";

			// Total_Sales
			$accounts_receivable->Total_Sales->HrefValue = "";
			$accounts_receivable->Total_Sales->TooltipValue = "";

			// Wtax
			$accounts_receivable->Wtax->HrefValue = "";
			$accounts_receivable->Wtax->TooltipValue = "";

			// Total_Amount_Due
			$accounts_receivable->Total_Amount_Due->HrefValue = "";
			$accounts_receivable->Total_Amount_Due->TooltipValue = "";

			// id
			if (!ew_Empty($accounts_receivable->id->CurrentValue)) {
				$accounts_receivable->id->HrefValue = $accounts_receivable->id->CurrentValue;
				if ($accounts_receivable->Export <> "") $accounts_receivable->id->HrefValue = ew_ConvertFullUrl($accounts_receivable->id->HrefValue);
			} else {
				$accounts_receivable->id->HrefValue = "";
			}
			$accounts_receivable->id->TooltipValue = "";
		} elseif ($accounts_receivable->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// Booking_Number
			$accounts_receivable->Booking_Number->EditCustomAttributes = "";
			$accounts_receivable->Booking_Number->EditValue = ew_HtmlEncode($accounts_receivable->Booking_Number->AdvancedSearch->SearchValue);

			// Date
			$accounts_receivable->Date->EditCustomAttributes = "";
			$accounts_receivable->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($accounts_receivable->Date->AdvancedSearch->SearchValue, 6), 6));
			$accounts_receivable->Date->EditCustomAttributes = "";
			$accounts_receivable->Date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($accounts_receivable->Date->AdvancedSearch->SearchValue2, 6), 6));

			// Client_ID
			$accounts_receivable->Client_ID->EditCustomAttributes = "";
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
			$accounts_receivable->Client_ID->EditValue = $arwrk;

			// Origin_ID
			$accounts_receivable->Origin_ID->EditCustomAttributes = "";
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
			$accounts_receivable->Origin_ID->EditValue = $arwrk;

			// Destination_ID
			$accounts_receivable->Destination_ID->EditCustomAttributes = "";
			$accounts_receivable->Destination_ID->EditValue = ew_HtmlEncode($accounts_receivable->Destination_ID->AdvancedSearch->SearchValue);
			if (strval($accounts_receivable->Destination_ID->AdvancedSearch->SearchValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($accounts_receivable->Destination_ID->AdvancedSearch->SearchValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$accounts_receivable->Destination_ID->EditValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$accounts_receivable->Destination_ID->EditValue = $accounts_receivable->Destination_ID->AdvancedSearch->SearchValue;
				}
			} else {
				$accounts_receivable->Destination_ID->EditValue = NULL;
			}

			// Customer_ID
			$accounts_receivable->Customer_ID->EditCustomAttributes = "";
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
			$accounts_receivable->Customer_ID->EditValue = $arwrk;

			// Subcon_ID
			$accounts_receivable->Subcon_ID->EditCustomAttributes = "";
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
			$accounts_receivable->Subcon_ID->EditValue = $arwrk;

			// Truck_ID
			$accounts_receivable->Truck_ID->EditCustomAttributes = "";
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
			$accounts_receivable->Truck_ID->EditValue = $arwrk;

			// ETA
			$accounts_receivable->ETA->EditCustomAttributes = "";
			$accounts_receivable->ETA->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($accounts_receivable->ETA->AdvancedSearch->SearchValue, 6), 6));
			$accounts_receivable->ETA->EditCustomAttributes = "";
			$accounts_receivable->ETA->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($accounts_receivable->ETA->AdvancedSearch->SearchValue2, 6), 6));

			// ETD
			$accounts_receivable->ETD->EditCustomAttributes = "";
			$accounts_receivable->ETD->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($accounts_receivable->ETD->AdvancedSearch->SearchValue, 6), 6));
			$accounts_receivable->ETD->EditCustomAttributes = "";
			$accounts_receivable->ETD->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($accounts_receivable->ETD->AdvancedSearch->SearchValue2, 6), 6));

			// Status_ID
			$accounts_receivable->Status_ID->EditCustomAttributes = "";
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
			$accounts_receivable->Status_ID->EditValue = $arwrk;

			// Vat
			$accounts_receivable->Vat->EditCustomAttributes = "";
			$accounts_receivable->Vat->EditValue = ew_HtmlEncode($accounts_receivable->Vat->AdvancedSearch->SearchValue);

			// Total_Sales
			$accounts_receivable->Total_Sales->EditCustomAttributes = "";
			$accounts_receivable->Total_Sales->EditValue = ew_HtmlEncode($accounts_receivable->Total_Sales->AdvancedSearch->SearchValue);

			// Wtax
			$accounts_receivable->Wtax->EditCustomAttributes = "";
			$accounts_receivable->Wtax->EditValue = ew_HtmlEncode($accounts_receivable->Wtax->AdvancedSearch->SearchValue);

			// Total_Amount_Due
			$accounts_receivable->Total_Amount_Due->EditCustomAttributes = "";
			$accounts_receivable->Total_Amount_Due->EditValue = ew_HtmlEncode($accounts_receivable->Total_Amount_Due->AdvancedSearch->SearchValue);

			// id
			$accounts_receivable->id->EditCustomAttributes = "";
			$accounts_receivable->id->EditValue = ew_HtmlEncode($accounts_receivable->id->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($accounts_receivable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$accounts_receivable->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $accounts_receivable;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckUSDate($accounts_receivable->Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($accounts_receivable->Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->Date->FldErrMsg();
		}
		if (!ew_CheckInteger($accounts_receivable->Destination_ID->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->Destination_ID->FldErrMsg();
		}
		if (!ew_CheckUSDate($accounts_receivable->ETA->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->ETA->FldErrMsg();
		}
		if (!ew_CheckUSDate($accounts_receivable->ETA->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->ETA->FldErrMsg();
		}
		if (!ew_CheckUSDate($accounts_receivable->ETD->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->ETD->FldErrMsg();
		}
		if (!ew_CheckUSDate($accounts_receivable->ETD->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->ETD->FldErrMsg();
		}
		if (!ew_CheckNumber($accounts_receivable->Vat->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($accounts_receivable->Total_Sales->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->Total_Sales->FldErrMsg();
		}
		if (!ew_CheckNumber($accounts_receivable->Wtax->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->Wtax->FldErrMsg();
		}
		if (!ew_CheckNumber($accounts_receivable->Total_Amount_Due->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->Total_Amount_Due->FldErrMsg();
		}
		if (!ew_CheckInteger($accounts_receivable->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $accounts_receivable->id->FldErrMsg();
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
		global $accounts_receivable;
		$accounts_receivable->Booking_Number->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Booking_Number");
		$accounts_receivable->Date->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Date");
		$accounts_receivable->Date->AdvancedSearch->SearchValue2 = $accounts_receivable->getAdvancedSearch("y_Date");
		$accounts_receivable->Client_ID->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Client_ID");
		$accounts_receivable->Origin_ID->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Origin_ID");
		$accounts_receivable->Destination_ID->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Destination_ID");
		$accounts_receivable->Customer_ID->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Customer_ID");
		$accounts_receivable->Subcon_ID->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Subcon_ID");
		$accounts_receivable->Truck_ID->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Truck_ID");
		$accounts_receivable->ETA->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_ETA");
		$accounts_receivable->ETA->AdvancedSearch->SearchValue2 = $accounts_receivable->getAdvancedSearch("y_ETA");
		$accounts_receivable->ETD->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_ETD");
		$accounts_receivable->ETD->AdvancedSearch->SearchValue2 = $accounts_receivable->getAdvancedSearch("y_ETD");
		$accounts_receivable->Status_ID->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Status_ID");
		$accounts_receivable->Vat->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Vat");
		$accounts_receivable->Total_Sales->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Total_Sales");
		$accounts_receivable->Wtax->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Wtax");
		$accounts_receivable->Total_Amount_Due->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_Total_Amount_Due");
		$accounts_receivable->id->AdvancedSearch->SearchValue = $accounts_receivable->getAdvancedSearch("x_id");
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
