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
$accounts_receivable_list = new caccounts_receivable_list();
$Page =& $accounts_receivable_list;

// Page init
$accounts_receivable_list->Page_Init();

// Page main
$accounts_receivable_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($accounts_receivable->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var accounts_receivable_list = new ew_Page("accounts_receivable_list");

// page properties
accounts_receivable_list.PageID = "list"; // page ID
accounts_receivable_list.FormID = "faccounts_receivablelist"; // form ID
var EW_PAGE_ID = accounts_receivable_list.PageID; // for backward compatibility

// extend page with validate function for search
accounts_receivable_list.ValidateSearch = function(fobj) {
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
accounts_receivable_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
accounts_receivable_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
accounts_receivable_list.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<?php if ($accounts_receivable->Export == "") { ?>
<?php
$gsMasterReturnUrl = "clientslist.php";
if ($accounts_receivable_list->sDbMasterFilter <> "" && $accounts_receivable->getCurrentMasterTable() == "clients") {
	if ($accounts_receivable_list->bMasterRecordExists) {
		if ($accounts_receivable->getCurrentMasterTable() == $accounts_receivable->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$accounts_receivable_list->lTotalRecs = $accounts_receivable->SelectRecordCount();
	} else {
		if ($rs = $accounts_receivable_list->LoadRecordset())
			$accounts_receivable_list->lTotalRecs = $rs->RecordCount();
	}
	$accounts_receivable_list->lStartRec = 1;
	if ($accounts_receivable_list->lDisplayRecs <= 0 || ($accounts_receivable->Export <> "" && $accounts_receivable->ExportAll)) // Display all records
		$accounts_receivable_list->lDisplayRecs = $accounts_receivable_list->lTotalRecs;
	if (!($accounts_receivable->Export <> "" && $accounts_receivable->ExportAll))
		$accounts_receivable_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $accounts_receivable_list->LoadRecordset($accounts_receivable_list->lStartRec-1, $accounts_receivable_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $accounts_receivable->TableCaption() ?>
<?php if ($accounts_receivable->Export == "" && $accounts_receivable->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $accounts_receivable_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $accounts_receivable_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $accounts_receivable_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($accounts_receivable->Export == "" && $accounts_receivable->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(accounts_receivable_list);" style="text-decoration: none;"><img id="accounts_receivable_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="accounts_receivable_list_SearchPanel">
<form name="faccounts_receivablelistsrch" id="faccounts_receivablelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return accounts_receivable_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="accounts_receivable">
<?php
if ($gsSearchError == "")
	$accounts_receivable_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$accounts_receivable->RowType = EW_ROWTYPE_SEARCH;

// Render row
$accounts_receivable_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->Date->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Date" id="z_Date" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->Client_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($accounts_receivable->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $accounts_receivable->Client_ID->ViewAttributes() ?>>
<?php if ($accounts_receivable->Client_ID->HrefValue <> "" || $accounts_receivable->Client_ID->TooltipValue <> "") { ?>
<a href="./clientsview.php?id=<?php echo $accounts_receivable->Client_ID->HrefValue ?>"><?php echo $accounts_receivable->Client_ID->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $accounts_receivable->Client_ID->ListViewValue() ?>
<?php } ?>
</div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($accounts_receivable->Client_ID->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->Origin_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Origin_ID" id="z_Origin_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->Destination_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Destination_ID" id="z_Destination_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->Customer_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Customer_ID" id="z_Customer_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->Subcon_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->Truck_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_ID" id="z_Truck_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->ETA->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETA" id="z_ETA" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $accounts_receivable->ETD->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETD" id="z_ETD" value="BETWEEN"></span></td>
		<td>			
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
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($accounts_receivable->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $accounts_receivable_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="accounts_receivablesrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($accounts_receivable->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($accounts_receivable->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($accounts_receivable->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$accounts_receivable_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($accounts_receivable->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($accounts_receivable->CurrentAction <> "gridadd" && $accounts_receivable->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($accounts_receivable_list->Pager)) $accounts_receivable_list->Pager = new cPrevNextPager($accounts_receivable_list->lStartRec, $accounts_receivable_list->lDisplayRecs, $accounts_receivable_list->lTotalRecs) ?>
<?php if ($accounts_receivable_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($accounts_receivable_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $accounts_receivable_list->PageUrl() ?>start=<?php echo $accounts_receivable_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($accounts_receivable_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $accounts_receivable_list->PageUrl() ?>start=<?php echo $accounts_receivable_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $accounts_receivable_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($accounts_receivable_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $accounts_receivable_list->PageUrl() ?>start=<?php echo $accounts_receivable_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($accounts_receivable_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $accounts_receivable_list->PageUrl() ?>start=<?php echo $accounts_receivable_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $accounts_receivable_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $accounts_receivable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $accounts_receivable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $accounts_receivable_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($accounts_receivable_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($accounts_receivable_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="accounts_receivable">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($accounts_receivable_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($accounts_receivable_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($accounts_receivable_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($accounts_receivable_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($accounts_receivable_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($accounts_receivable_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($accounts_receivable->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
<form name="faccounts_receivablelist" id="faccounts_receivablelist" class="ewForm" action="" method="post">
<div id="gmp_accounts_receivable" class="ewGridMiddlePanel">
<?php if ($accounts_receivable_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $accounts_receivable->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$accounts_receivable_list->RenderListOptions();

// Render list options (header, left)
$accounts_receivable_list->ListOptions->Render("header", "left");
?>
<?php if ($accounts_receivable->Booking_Number->Visible) { // Booking_Number ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Booking_Number) == "") { ?>
		<td><?php echo $accounts_receivable->Booking_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Booking_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Booking_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Booking_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Booking_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Date->Visible) { // Date ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Date) == "") { ?>
		<td><?php echo $accounts_receivable->Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Client_ID->Visible) { // Client_ID ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Client_ID) == "") { ?>
		<td><?php echo $accounts_receivable->Client_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Client_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Client_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Client_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Client_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Origin_ID->Visible) { // Origin_ID ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Origin_ID) == "") { ?>
		<td><?php echo $accounts_receivable->Origin_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Origin_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Origin_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Origin_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Origin_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Destination_ID->Visible) { // Destination_ID ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Destination_ID) == "") { ?>
		<td><?php echo $accounts_receivable->Destination_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Destination_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Destination_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Destination_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Destination_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Customer_ID->Visible) { // Customer_ID ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Customer_ID) == "") { ?>
		<td><?php echo $accounts_receivable->Customer_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Customer_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Customer_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Customer_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Customer_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Subcon_ID->Visible) { // Subcon_ID ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Subcon_ID) == "") { ?>
		<td><?php echo $accounts_receivable->Subcon_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Subcon_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Subcon_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Subcon_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Subcon_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Truck_ID->Visible) { // Truck_ID ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Truck_ID) == "") { ?>
		<td><?php echo $accounts_receivable->Truck_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Truck_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Truck_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Truck_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Truck_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->ETA->Visible) { // ETA ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->ETA) == "") { ?>
		<td><?php echo $accounts_receivable->ETA->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->ETA) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->ETA->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->ETA->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->ETA->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->ETD->Visible) { // ETD ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->ETD) == "") { ?>
		<td><?php echo $accounts_receivable->ETD->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->ETD) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->ETD->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->ETD->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->ETD->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Status_ID->Visible) { // Status_ID ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Status_ID) == "") { ?>
		<td><?php echo $accounts_receivable->Status_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Status_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Status_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Status_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Status_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Vat->Visible) { // Vat ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Vat) == "") { ?>
		<td><?php echo $accounts_receivable->Vat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Vat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Vat->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Vat->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Vat->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Total_Sales->Visible) { // Total_Sales ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Total_Sales) == "") { ?>
		<td><?php echo $accounts_receivable->Total_Sales->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Total_Sales) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Total_Sales->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Total_Sales->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Total_Sales->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Wtax->Visible) { // Wtax ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Wtax) == "") { ?>
		<td><?php echo $accounts_receivable->Wtax->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Wtax) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Wtax->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Wtax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Wtax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->Total_Amount_Due) == "") { ?>
		<td><?php echo $accounts_receivable->Total_Amount_Due->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->Total_Amount_Due) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->Total_Amount_Due->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->Total_Amount_Due->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->Total_Amount_Due->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($accounts_receivable->id->Visible) { // id ?>
	<?php if ($accounts_receivable->SortUrl($accounts_receivable->id) == "") { ?>
		<td><?php echo $accounts_receivable->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $accounts_receivable->SortUrl($accounts_receivable->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $accounts_receivable->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($accounts_receivable->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($accounts_receivable->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$accounts_receivable_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($accounts_receivable->ExportAll && $accounts_receivable->Export <> "") {
	$accounts_receivable_list->lStopRec = $accounts_receivable_list->lTotalRecs;
} else {
	$accounts_receivable_list->lStopRec = $accounts_receivable_list->lStartRec + $accounts_receivable_list->lDisplayRecs - 1; // Set the last record to display
}
$accounts_receivable_list->lRecCount = $accounts_receivable_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $accounts_receivable_list->lStartRec > 1)
		$rs->Move($accounts_receivable_list->lStartRec - 1);
}

// Initialize aggregate
$accounts_receivable->RowType = EW_ROWTYPE_AGGREGATEINIT;
$accounts_receivable_list->RenderRow();
$accounts_receivable_list->lRowCnt = 0;
while (($accounts_receivable->CurrentAction == "gridadd" || !$rs->EOF) &&
	$accounts_receivable_list->lRecCount < $accounts_receivable_list->lStopRec) {
	$accounts_receivable_list->lRecCount++;
	if (intval($accounts_receivable_list->lRecCount) >= intval($accounts_receivable_list->lStartRec)) {
		$accounts_receivable_list->lRowCnt++;

	// Init row class and style
	$accounts_receivable->CssClass = "";
	$accounts_receivable->CssStyle = "";
	$accounts_receivable->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($accounts_receivable->CurrentAction == "gridadd") {
		$accounts_receivable_list->LoadDefaultValues(); // Load default values
	} else {
		$accounts_receivable_list->LoadRowValues($rs); // Load row values
	}
	$accounts_receivable->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$accounts_receivable_list->RenderRow();

	// Render list options
	$accounts_receivable_list->RenderListOptions();
?>
	<tr<?php echo $accounts_receivable->RowAttributes() ?>>
<?php

// Render list options (body, left)
$accounts_receivable_list->ListOptions->Render("body", "left");
?>
	<?php if ($accounts_receivable->Booking_Number->Visible) { // Booking_Number ?>
		<td<?php echo $accounts_receivable->Booking_Number->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Booking_Number->ViewAttributes() ?>>
<?php if ($accounts_receivable->Booking_Number->HrefValue <> "" || $accounts_receivable->Booking_Number->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_Booking_Number=<?php echo $accounts_receivable->Booking_Number->HrefValue ?>"><?php echo $accounts_receivable->Booking_Number->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $accounts_receivable->Booking_Number->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Date->Visible) { // Date ?>
		<td<?php echo $accounts_receivable->Date->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Date->ViewAttributes() ?>><?php echo $accounts_receivable->Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Client_ID->Visible) { // Client_ID ?>
		<td<?php echo $accounts_receivable->Client_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Client_ID->ViewAttributes() ?>>
<?php if ($accounts_receivable->Client_ID->HrefValue <> "" || $accounts_receivable->Client_ID->TooltipValue <> "") { ?>
<a href="./clientsview.php?id=<?php echo $accounts_receivable->Client_ID->HrefValue ?>"><?php echo $accounts_receivable->Client_ID->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $accounts_receivable->Client_ID->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Origin_ID->Visible) { // Origin_ID ?>
		<td<?php echo $accounts_receivable->Origin_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Origin_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Origin_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Destination_ID->Visible) { // Destination_ID ?>
		<td<?php echo $accounts_receivable->Destination_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Destination_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Destination_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Customer_ID->Visible) { // Customer_ID ?>
		<td<?php echo $accounts_receivable->Customer_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Customer_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Customer_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Subcon_ID->Visible) { // Subcon_ID ?>
		<td<?php echo $accounts_receivable->Subcon_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Subcon_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Subcon_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Truck_ID->Visible) { // Truck_ID ?>
		<td<?php echo $accounts_receivable->Truck_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Truck_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Truck_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->ETA->Visible) { // ETA ?>
		<td<?php echo $accounts_receivable->ETA->CellAttributes() ?>>
<div<?php echo $accounts_receivable->ETA->ViewAttributes() ?>><?php echo $accounts_receivable->ETA->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->ETD->Visible) { // ETD ?>
		<td<?php echo $accounts_receivable->ETD->CellAttributes() ?>>
<div<?php echo $accounts_receivable->ETD->ViewAttributes() ?>><?php echo $accounts_receivable->ETD->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Status_ID->Visible) { // Status_ID ?>
		<td<?php echo $accounts_receivable->Status_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Status_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Status_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Vat->Visible) { // Vat ?>
		<td<?php echo $accounts_receivable->Vat->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Vat->ViewAttributes() ?>><?php echo $accounts_receivable->Vat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Total_Sales->Visible) { // Total_Sales ?>
		<td<?php echo $accounts_receivable->Total_Sales->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Total_Sales->ViewAttributes() ?>><?php echo $accounts_receivable->Total_Sales->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Wtax->Visible) { // Wtax ?>
		<td<?php echo $accounts_receivable->Wtax->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Wtax->ViewAttributes() ?>><?php echo $accounts_receivable->Wtax->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td<?php echo $accounts_receivable->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Total_Amount_Due->ViewAttributes() ?>><?php echo $accounts_receivable->Total_Amount_Due->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($accounts_receivable->id->Visible) { // id ?>
		<td<?php echo $accounts_receivable->id->CellAttributes() ?>>
<div<?php echo $accounts_receivable->id->ViewAttributes() ?>>
<?php if ($accounts_receivable->id->HrefValue <> "" || $accounts_receivable->id->TooltipValue <> "") { ?>
<a href="./bookingsbilling.php?id=<?php echo $accounts_receivable->id->HrefValue ?>"><?php echo "View Statement";//echo $accounts_receivable->id->ListViewValue() ?></a>
<?php } else { ?>
<?php echo "View Statement";//echo $accounts_receivable->id->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$accounts_receivable_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($accounts_receivable->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$accounts_receivable->RowType = EW_ROWTYPE_AGGREGATE;
$accounts_receivable_list->RenderRow();
?>
<?php if ($accounts_receivable_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$accounts_receivable_list->RenderListOptions();

// Render list options (footer, left)
$accounts_receivable_list->ListOptions->Render("footer", "left");
?>
	<?php if ($accounts_receivable->Booking_Number->Visible) { // Booking_Number ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Date->Visible) { // Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Client_ID->Visible) { // Client_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Origin_ID->Visible) { // Origin_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Destination_ID->Visible) { // Destination_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Customer_ID->Visible) { // Customer_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Subcon_ID->Visible) { // Subcon_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Truck_ID->Visible) { // Truck_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->ETA->Visible) { // ETA ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->ETD->Visible) { // ETD ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Status_ID->Visible) { // Status_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Vat->Visible) { // Vat ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $accounts_receivable->Vat->ViewAttributes() ?>><?php echo $accounts_receivable->Vat->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Total_Sales->Visible) { // Total_Sales ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $accounts_receivable->Total_Sales->ViewAttributes() ?>><?php echo $accounts_receivable->Total_Sales->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Wtax->Visible) { // Wtax ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $accounts_receivable->Wtax->ViewAttributes() ?>><?php echo $accounts_receivable->Wtax->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $accounts_receivable->Total_Amount_Due->ViewAttributes() ?>><?php echo $accounts_receivable->Total_Amount_Due->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($accounts_receivable->id->Visible) { // id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$accounts_receivable_list->ListOptions->Render("footer", "right");
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
<?php if ($accounts_receivable_list->lTotalRecs > 0) { ?>
<?php if ($accounts_receivable->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($accounts_receivable->CurrentAction <> "gridadd" && $accounts_receivable->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($accounts_receivable_list->Pager)) $accounts_receivable_list->Pager = new cPrevNextPager($accounts_receivable_list->lStartRec, $accounts_receivable_list->lDisplayRecs, $accounts_receivable_list->lTotalRecs) ?>
<?php if ($accounts_receivable_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($accounts_receivable_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $accounts_receivable_list->PageUrl() ?>start=<?php echo $accounts_receivable_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($accounts_receivable_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $accounts_receivable_list->PageUrl() ?>start=<?php echo $accounts_receivable_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $accounts_receivable_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($accounts_receivable_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $accounts_receivable_list->PageUrl() ?>start=<?php echo $accounts_receivable_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($accounts_receivable_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $accounts_receivable_list->PageUrl() ?>start=<?php echo $accounts_receivable_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $accounts_receivable_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $accounts_receivable_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $accounts_receivable_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $accounts_receivable_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($accounts_receivable_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($accounts_receivable_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="accounts_receivable">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($accounts_receivable_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($accounts_receivable_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($accounts_receivable_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($accounts_receivable_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($accounts_receivable_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($accounts_receivable_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($accounts_receivable->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($accounts_receivable_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($accounts_receivable->Export == "" && $accounts_receivable->CurrentAction == "") { ?>
<?php } ?>
<?php if ($accounts_receivable->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$accounts_receivable_list->Page_Terminate();
?>
<?php

//
// Page class
//
class caccounts_receivable_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'accounts_receivable';

	// Page object name
	var $PageObjName = 'accounts_receivable_list';

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
	function caccounts_receivable_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (accounts_receivable)
		$GLOBALS["accounts_receivable"] = new caccounts_receivable();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["accounts_receivable"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "accounts_receivabledelete.php";
		$this->MultiUpdateUrl = "accounts_receivableupdate.php";

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'accounts_receivable', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$accounts_receivable->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$accounts_receivable->Export = $_POST["exporttype"];
		} else {
			$accounts_receivable->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $accounts_receivable->Export; // Get export parameter, used in header
		$gsExportFile = $accounts_receivable->TableVar; // Get export file, used in header
		if ($accounts_receivable->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $accounts_receivable;

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
			$accounts_receivable->Recordset_SearchValidated();

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
		if ($accounts_receivable->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $accounts_receivable->getRecordsPerPage(); // Restore from Session
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
		$accounts_receivable->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$accounts_receivable->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$accounts_receivable->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $accounts_receivable->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $accounts_receivable->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $accounts_receivable->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($accounts_receivable->getMasterFilter() <> "" && $accounts_receivable->getCurrentMasterTable() == "clients") {
			global $clients;
			$rsmaster = $clients->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$accounts_receivable->setMasterFilter(""); // Clear master filter
				$accounts_receivable->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($accounts_receivable->getReturnUrl()); // Return to caller
			} else {
				$clients->LoadListRowValues($rsmaster);
				$clients->RowType = EW_ROWTYPE_MASTER; // Master row
				$clients->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$accounts_receivable->setSessionWhere($sFilter);
		$accounts_receivable->CurrentFilter = "";

		// Export data only
		if (in_array($accounts_receivable->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($accounts_receivable->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $accounts_receivable;
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
			$accounts_receivable->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$accounts_receivable->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $accounts_receivable;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $accounts_receivable->Booking_Number, FALSE); // Booking_Number
		$this->BuildSearchSql($sWhere, $accounts_receivable->Date, FALSE); // Date
		$this->BuildSearchSql($sWhere, $accounts_receivable->Client_ID, FALSE); // Client_ID
		$this->BuildSearchSql($sWhere, $accounts_receivable->Origin_ID, FALSE); // Origin_ID
		$this->BuildSearchSql($sWhere, $accounts_receivable->Destination_ID, FALSE); // Destination_ID
		$this->BuildSearchSql($sWhere, $accounts_receivable->Customer_ID, FALSE); // Customer_ID
		$this->BuildSearchSql($sWhere, $accounts_receivable->Subcon_ID, FALSE); // Subcon_ID
		$this->BuildSearchSql($sWhere, $accounts_receivable->Truck_ID, FALSE); // Truck_ID
		$this->BuildSearchSql($sWhere, $accounts_receivable->ETA, FALSE); // ETA
		$this->BuildSearchSql($sWhere, $accounts_receivable->ETD, FALSE); // ETD
		$this->BuildSearchSql($sWhere, $accounts_receivable->Status_ID, FALSE); // Status_ID
		$this->BuildSearchSql($sWhere, $accounts_receivable->Vat, FALSE); // Vat
		$this->BuildSearchSql($sWhere, $accounts_receivable->Total_Sales, FALSE); // Total_Sales
		$this->BuildSearchSql($sWhere, $accounts_receivable->Wtax, FALSE); // Wtax
		$this->BuildSearchSql($sWhere, $accounts_receivable->Total_Amount_Due, FALSE); // Total_Amount_Due
		$this->BuildSearchSql($sWhere, $accounts_receivable->id, FALSE); // id

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($accounts_receivable->Booking_Number); // Booking_Number
			$this->SetSearchParm($accounts_receivable->Date); // Date
			$this->SetSearchParm($accounts_receivable->Client_ID); // Client_ID
			$this->SetSearchParm($accounts_receivable->Origin_ID); // Origin_ID
			$this->SetSearchParm($accounts_receivable->Destination_ID); // Destination_ID
			$this->SetSearchParm($accounts_receivable->Customer_ID); // Customer_ID
			$this->SetSearchParm($accounts_receivable->Subcon_ID); // Subcon_ID
			$this->SetSearchParm($accounts_receivable->Truck_ID); // Truck_ID
			$this->SetSearchParm($accounts_receivable->ETA); // ETA
			$this->SetSearchParm($accounts_receivable->ETD); // ETD
			$this->SetSearchParm($accounts_receivable->Status_ID); // Status_ID
			$this->SetSearchParm($accounts_receivable->Vat); // Vat
			$this->SetSearchParm($accounts_receivable->Total_Sales); // Total_Sales
			$this->SetSearchParm($accounts_receivable->Wtax); // Wtax
			$this->SetSearchParm($accounts_receivable->Total_Amount_Due); // Total_Amount_Due
			$this->SetSearchParm($accounts_receivable->id); // id
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
		global $accounts_receivable;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$accounts_receivable->setAdvancedSearch("x_$FldParm", $FldVal);
		$accounts_receivable->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$accounts_receivable->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$accounts_receivable->setAdvancedSearch("y_$FldParm", $FldVal2);
		$accounts_receivable->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $accounts_receivable;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $accounts_receivable->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $accounts_receivable->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $accounts_receivable->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $accounts_receivable->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $accounts_receivable->GetAdvancedSearch("w_$FldParm");
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
		global $accounts_receivable;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $accounts_receivable->Booking_Number, $Keyword);
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
		global $Security, $accounts_receivable;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $accounts_receivable->BasicSearchKeyword;
		$sSearchType = $accounts_receivable->BasicSearchType;
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
			$accounts_receivable->setSessionBasicSearchKeyword($sSearchKeyword);
			$accounts_receivable->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $accounts_receivable;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$accounts_receivable->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $accounts_receivable;
		$accounts_receivable->setSessionBasicSearchKeyword("");
		$accounts_receivable->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $accounts_receivable;
		$accounts_receivable->setAdvancedSearch("x_Booking_Number", "");
		$accounts_receivable->setAdvancedSearch("x_Date", "");
		$accounts_receivable->setAdvancedSearch("y_Date", "");
		$accounts_receivable->setAdvancedSearch("x_Client_ID", "");
		$accounts_receivable->setAdvancedSearch("x_Origin_ID", "");
		$accounts_receivable->setAdvancedSearch("x_Destination_ID", "");
		$accounts_receivable->setAdvancedSearch("x_Customer_ID", "");
		$accounts_receivable->setAdvancedSearch("x_Subcon_ID", "");
		$accounts_receivable->setAdvancedSearch("x_Truck_ID", "");
		$accounts_receivable->setAdvancedSearch("x_ETA", "");
		$accounts_receivable->setAdvancedSearch("y_ETA", "");
		$accounts_receivable->setAdvancedSearch("x_ETD", "");
		$accounts_receivable->setAdvancedSearch("y_ETD", "");
		$accounts_receivable->setAdvancedSearch("x_Status_ID", "");
		$accounts_receivable->setAdvancedSearch("x_Vat", "");
		$accounts_receivable->setAdvancedSearch("x_Total_Sales", "");
		$accounts_receivable->setAdvancedSearch("x_Wtax", "");
		$accounts_receivable->setAdvancedSearch("x_Total_Amount_Due", "");
		$accounts_receivable->setAdvancedSearch("x_id", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $accounts_receivable;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_Booking_Number"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["y_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Client_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Origin_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Destination_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Customer_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Subcon_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Truck_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ETA"] <> "") $bRestore = FALSE;
		if (@$_GET["y_ETA"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ETD"] <> "") $bRestore = FALSE;
		if (@$_GET["y_ETD"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Status_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Vat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Sales"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Wtax"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Amount_Due"] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$accounts_receivable->BasicSearchKeyword = $accounts_receivable->getSessionBasicSearchKeyword();
			$accounts_receivable->BasicSearchType = $accounts_receivable->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($accounts_receivable->Booking_Number);
			$this->GetSearchParm($accounts_receivable->Date);
			$this->GetSearchParm($accounts_receivable->Client_ID);
			$this->GetSearchParm($accounts_receivable->Origin_ID);
			$this->GetSearchParm($accounts_receivable->Destination_ID);
			$this->GetSearchParm($accounts_receivable->Customer_ID);
			$this->GetSearchParm($accounts_receivable->Subcon_ID);
			$this->GetSearchParm($accounts_receivable->Truck_ID);
			$this->GetSearchParm($accounts_receivable->ETA);
			$this->GetSearchParm($accounts_receivable->ETD);
			$this->GetSearchParm($accounts_receivable->Status_ID);
			$this->GetSearchParm($accounts_receivable->Vat);
			$this->GetSearchParm($accounts_receivable->Total_Sales);
			$this->GetSearchParm($accounts_receivable->Wtax);
			$this->GetSearchParm($accounts_receivable->Total_Amount_Due);
			$this->GetSearchParm($accounts_receivable->id);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $accounts_receivable;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$accounts_receivable->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$accounts_receivable->CurrentOrderType = @$_GET["ordertype"];
			$accounts_receivable->UpdateSort($accounts_receivable->Booking_Number); // Booking_Number
			$accounts_receivable->UpdateSort($accounts_receivable->Date); // Date
			$accounts_receivable->UpdateSort($accounts_receivable->Client_ID); // Client_ID
			$accounts_receivable->UpdateSort($accounts_receivable->Origin_ID); // Origin_ID
			$accounts_receivable->UpdateSort($accounts_receivable->Destination_ID); // Destination_ID
			$accounts_receivable->UpdateSort($accounts_receivable->Customer_ID); // Customer_ID
			$accounts_receivable->UpdateSort($accounts_receivable->Subcon_ID); // Subcon_ID
			$accounts_receivable->UpdateSort($accounts_receivable->Truck_ID); // Truck_ID
			$accounts_receivable->UpdateSort($accounts_receivable->ETA); // ETA
			$accounts_receivable->UpdateSort($accounts_receivable->ETD); // ETD
			$accounts_receivable->UpdateSort($accounts_receivable->Status_ID); // Status_ID
			$accounts_receivable->UpdateSort($accounts_receivable->Vat); // Vat
			$accounts_receivable->UpdateSort($accounts_receivable->Total_Sales); // Total_Sales
			$accounts_receivable->UpdateSort($accounts_receivable->Wtax); // Wtax
			$accounts_receivable->UpdateSort($accounts_receivable->Total_Amount_Due); // Total_Amount_Due
			$accounts_receivable->UpdateSort($accounts_receivable->id); // id
			$accounts_receivable->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $accounts_receivable;
		$sOrderBy = $accounts_receivable->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($accounts_receivable->SqlOrderBy() <> "") {
				$sOrderBy = $accounts_receivable->SqlOrderBy();
				$accounts_receivable->setSessionOrderBy($sOrderBy);
				$accounts_receivable->Date->setSort("DESC");
				$accounts_receivable->Client_ID->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $accounts_receivable;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$accounts_receivable->getCurrentMasterTable = ""; // Clear master table
				$accounts_receivable->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$accounts_receivable->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$accounts_receivable->Client_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$accounts_receivable->setSessionOrderBy($sOrderBy);
				$accounts_receivable->Booking_Number->setSort("");
				$accounts_receivable->Date->setSort("");
				$accounts_receivable->Client_ID->setSort("");
				$accounts_receivable->Origin_ID->setSort("");
				$accounts_receivable->Destination_ID->setSort("");
				$accounts_receivable->Customer_ID->setSort("");
				$accounts_receivable->Subcon_ID->setSort("");
				$accounts_receivable->Truck_ID->setSort("");
				$accounts_receivable->ETA->setSort("");
				$accounts_receivable->ETD->setSort("");
				$accounts_receivable->Status_ID->setSort("");
				$accounts_receivable->Vat->setSort("");
				$accounts_receivable->Total_Sales->setSort("");
				$accounts_receivable->Wtax->setSort("");
				$accounts_receivable->Total_Amount_Due->setSort("");
				$accounts_receivable->id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$accounts_receivable->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $accounts_receivable;

		// "detail_expenses"
		$this->ListOptions->Add("detail_expenses");
		$item =& $this->ListOptions->Items["detail_expenses"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('expenses');
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($accounts_receivable->Export <> "" ||
			$accounts_receivable->CurrentAction == "gridadd" ||
			$accounts_receivable->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $accounts_receivable;
		$this->ListOptions->LoadDefault();

		// "detail_expenses"
		$oListOpt =& $this->ListOptions->Items["detail_expenses"];
		if ($Security->AllowList('expenses')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("expenses", "TblCaption");
			$oListOpt->Body = "<a href=\"expenseslist.php?" . EW_TABLE_SHOW_MASTER . "=accounts_receivable&id=" . urlencode(strval($accounts_receivable->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $accounts_receivable;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $accounts_receivable;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$accounts_receivable->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$accounts_receivable->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $accounts_receivable->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$accounts_receivable->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$accounts_receivable->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$accounts_receivable->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $accounts_receivable;
		$accounts_receivable->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$accounts_receivable->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $accounts_receivable;

		// Load search values
		// Booking_Number

		$accounts_receivable->Booking_Number->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Booking_Number"]);
		$accounts_receivable->Booking_Number->AdvancedSearch->SearchOperator = @$_GET["z_Booking_Number"];

		// Date
		$accounts_receivable->Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Date"]);
		$accounts_receivable->Date->AdvancedSearch->SearchOperator = @$_GET["z_Date"];
		$accounts_receivable->Date->AdvancedSearch->SearchCondition = @$_GET["v_Date"];
		$accounts_receivable->Date->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_Date"]);
		$accounts_receivable->Date->AdvancedSearch->SearchOperator2 = @$_GET["w_Date"];

		// Client_ID
		$accounts_receivable->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Client_ID"]);
		$accounts_receivable->Client_ID->AdvancedSearch->SearchOperator = @$_GET["z_Client_ID"];

		// Origin_ID
		$accounts_receivable->Origin_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Origin_ID"]);
		$accounts_receivable->Origin_ID->AdvancedSearch->SearchOperator = @$_GET["z_Origin_ID"];

		// Destination_ID
		$accounts_receivable->Destination_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Destination_ID"]);
		$accounts_receivable->Destination_ID->AdvancedSearch->SearchOperator = @$_GET["z_Destination_ID"];

		// Customer_ID
		$accounts_receivable->Customer_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Customer_ID"]);
		$accounts_receivable->Customer_ID->AdvancedSearch->SearchOperator = @$_GET["z_Customer_ID"];

		// Subcon_ID
		$accounts_receivable->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Subcon_ID"]);
		$accounts_receivable->Subcon_ID->AdvancedSearch->SearchOperator = @$_GET["z_Subcon_ID"];

		// Truck_ID
		$accounts_receivable->Truck_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Truck_ID"]);
		$accounts_receivable->Truck_ID->AdvancedSearch->SearchOperator = @$_GET["z_Truck_ID"];

		// ETA
		$accounts_receivable->ETA->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ETA"]);
		$accounts_receivable->ETA->AdvancedSearch->SearchOperator = @$_GET["z_ETA"];
		$accounts_receivable->ETA->AdvancedSearch->SearchCondition = @$_GET["v_ETA"];
		$accounts_receivable->ETA->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_ETA"]);
		$accounts_receivable->ETA->AdvancedSearch->SearchOperator2 = @$_GET["w_ETA"];

		// ETD
		$accounts_receivable->ETD->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ETD"]);
		$accounts_receivable->ETD->AdvancedSearch->SearchOperator = @$_GET["z_ETD"];
		$accounts_receivable->ETD->AdvancedSearch->SearchCondition = @$_GET["v_ETD"];
		$accounts_receivable->ETD->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_ETD"]);
		$accounts_receivable->ETD->AdvancedSearch->SearchOperator2 = @$_GET["w_ETD"];

		// Status_ID
		$accounts_receivable->Status_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Status_ID"]);
		$accounts_receivable->Status_ID->AdvancedSearch->SearchOperator = @$_GET["z_Status_ID"];

		// Vat
		$accounts_receivable->Vat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Vat"]);
		$accounts_receivable->Vat->AdvancedSearch->SearchOperator = @$_GET["z_Vat"];

		// Total_Sales
		$accounts_receivable->Total_Sales->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Sales"]);
		$accounts_receivable->Total_Sales->AdvancedSearch->SearchOperator = @$_GET["z_Total_Sales"];

		// Wtax
		$accounts_receivable->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Wtax"]);
		$accounts_receivable->Wtax->AdvancedSearch->SearchOperator = @$_GET["z_Wtax"];

		// Total_Amount_Due
		$accounts_receivable->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Amount_Due"]);
		$accounts_receivable->Total_Amount_Due->AdvancedSearch->SearchOperator = @$_GET["z_Total_Amount_Due"];

		// id
		$accounts_receivable->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$accounts_receivable->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $accounts_receivable;

		// Call Recordset Selecting event
		$accounts_receivable->Recordset_Selecting($accounts_receivable->CurrentFilter);

		// Load List page SQL
		$sSql = $accounts_receivable->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$accounts_receivable->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $accounts_receivable;
		$sFilter = $accounts_receivable->KeyFilter();

		// Call Row Selecting event
		$accounts_receivable->Row_Selecting($sFilter);

		// Load SQL based on filter
		$accounts_receivable->CurrentFilter = $sFilter;
		$sSql = $accounts_receivable->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$accounts_receivable->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $accounts_receivable;
		$accounts_receivable->Booking_Number->setDbValue($rs->fields('Booking_Number'));
		$accounts_receivable->Date->setDbValue($rs->fields('Date'));
		$accounts_receivable->Client_ID->setDbValue($rs->fields('Client_ID'));
		$accounts_receivable->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$accounts_receivable->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$accounts_receivable->Customer_ID->setDbValue($rs->fields('Customer_ID'));
		$accounts_receivable->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$accounts_receivable->Truck_ID->setDbValue($rs->fields('Truck_ID'));
		$accounts_receivable->ETA->setDbValue($rs->fields('ETA'));
		$accounts_receivable->ETD->setDbValue($rs->fields('ETD'));
		$accounts_receivable->Status_ID->setDbValue($rs->fields('Status_ID'));
		$accounts_receivable->Vat->setDbValue($rs->fields('Vat'));
		$accounts_receivable->Total_Sales->setDbValue($rs->fields('Total_Sales'));
		$accounts_receivable->Wtax->setDbValue($rs->fields('Wtax'));
		$accounts_receivable->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$accounts_receivable->id->setDbValue($rs->fields('id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $accounts_receivable;

		// Initialize URLs
		$this->ViewUrl = $accounts_receivable->ViewUrl();
		$this->EditUrl = $accounts_receivable->EditUrl();
		$this->InlineEditUrl = $accounts_receivable->InlineEditUrl();
		$this->CopyUrl = $accounts_receivable->CopyUrl();
		$this->InlineCopyUrl = $accounts_receivable->InlineCopyUrl();
		$this->DeleteUrl = $accounts_receivable->DeleteUrl();

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

		// Accumulate aggregate value
		if ($accounts_receivable->RowType <> EW_ROWTYPE_AGGREGATEINIT && $accounts_receivable->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($accounts_receivable->Vat->CurrentValue))
				$accounts_receivable->Vat->Total += $accounts_receivable->Vat->CurrentValue; // Accumulate total
			if (is_numeric($accounts_receivable->Total_Sales->CurrentValue))
				$accounts_receivable->Total_Sales->Total += $accounts_receivable->Total_Sales->CurrentValue; // Accumulate total
			if (is_numeric($accounts_receivable->Wtax->CurrentValue))
				$accounts_receivable->Wtax->Total += $accounts_receivable->Wtax->CurrentValue; // Accumulate total
			if (is_numeric($accounts_receivable->Total_Amount_Due->CurrentValue))
				$accounts_receivable->Total_Amount_Due->Total += $accounts_receivable->Total_Amount_Due->CurrentValue; // Accumulate total
		}
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
		} elseif ($accounts_receivable->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$accounts_receivable->Vat->Total = 0; // Initialize total
			$accounts_receivable->Total_Sales->Total = 0; // Initialize total
			$accounts_receivable->Wtax->Total = 0; // Initialize total
			$accounts_receivable->Total_Amount_Due->Total = 0; // Initialize total
		} elseif ($accounts_receivable->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$accounts_receivable->Vat->CurrentValue = $accounts_receivable->Vat->Total;
			$accounts_receivable->Vat->ViewValue = $accounts_receivable->Vat->CurrentValue;
			$accounts_receivable->Vat->ViewValue = ew_FormatNumber($accounts_receivable->Vat->ViewValue, 2, -2, -2, -2);
			$accounts_receivable->Vat->CssStyle = "";
			$accounts_receivable->Vat->CssClass = "";
			$accounts_receivable->Vat->ViewCustomAttributes = "";
			$accounts_receivable->Vat->HrefValue = ""; // Clear href value
			$accounts_receivable->Total_Sales->CurrentValue = $accounts_receivable->Total_Sales->Total;
			$accounts_receivable->Total_Sales->ViewValue = $accounts_receivable->Total_Sales->CurrentValue;
			$accounts_receivable->Total_Sales->ViewValue = ew_FormatNumber($accounts_receivable->Total_Sales->ViewValue, 2, -2, -2, -2);
			$accounts_receivable->Total_Sales->CssStyle = "";
			$accounts_receivable->Total_Sales->CssClass = "";
			$accounts_receivable->Total_Sales->ViewCustomAttributes = "";
			$accounts_receivable->Total_Sales->HrefValue = ""; // Clear href value
			$accounts_receivable->Wtax->CurrentValue = $accounts_receivable->Wtax->Total;
			$accounts_receivable->Wtax->ViewValue = $accounts_receivable->Wtax->CurrentValue;
			$accounts_receivable->Wtax->ViewValue = ew_FormatNumber($accounts_receivable->Wtax->ViewValue, 2, -2, -2, -2);
			$accounts_receivable->Wtax->CssStyle = "";
			$accounts_receivable->Wtax->CssClass = "";
			$accounts_receivable->Wtax->ViewCustomAttributes = "";
			$accounts_receivable->Wtax->HrefValue = ""; // Clear href value
			$accounts_receivable->Total_Amount_Due->CurrentValue = $accounts_receivable->Total_Amount_Due->Total;
			$accounts_receivable->Total_Amount_Due->ViewValue = $accounts_receivable->Total_Amount_Due->CurrentValue;
			$accounts_receivable->Total_Amount_Due->ViewValue = ew_FormatNumber($accounts_receivable->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$accounts_receivable->Total_Amount_Due->CssStyle = "";
			$accounts_receivable->Total_Amount_Due->CssClass = "";
			$accounts_receivable->Total_Amount_Due->ViewCustomAttributes = "";
			$accounts_receivable->Total_Amount_Due->HrefValue = ""; // Clear href value
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $accounts_receivable;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $accounts_receivable->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Initialize aggregates
		$accounts_receivable->RowType = EW_ROWTYPE_AGGREGATEINIT;
		$this->RenderRow();

		// Export all
		if ($accounts_receivable->ExportAll) {
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
		if ($accounts_receivable->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($accounts_receivable, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($accounts_receivable->Booking_Number);
				$ExportDoc->ExportCaption($accounts_receivable->Date);
				$ExportDoc->ExportCaption($accounts_receivable->Client_ID);
				$ExportDoc->ExportCaption($accounts_receivable->Origin_ID);
				$ExportDoc->ExportCaption($accounts_receivable->Destination_ID);
				$ExportDoc->ExportCaption($accounts_receivable->Customer_ID);
				$ExportDoc->ExportCaption($accounts_receivable->Subcon_ID);
				$ExportDoc->ExportCaption($accounts_receivable->Truck_ID);
				$ExportDoc->ExportCaption($accounts_receivable->ETA);
				$ExportDoc->ExportCaption($accounts_receivable->ETD);
				$ExportDoc->ExportCaption($accounts_receivable->Status_ID);
				$ExportDoc->ExportCaption($accounts_receivable->Vat);
				$ExportDoc->ExportCaption($accounts_receivable->Total_Sales);
				$ExportDoc->ExportCaption($accounts_receivable->Wtax);
				$ExportDoc->ExportCaption($accounts_receivable->Total_Amount_Due);
				$ExportDoc->ExportCaption($accounts_receivable->id);
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
				$accounts_receivable->CssClass = "";
				$accounts_receivable->CssStyle = "";
				$accounts_receivable->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($accounts_receivable->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('Booking_Number', $accounts_receivable->Booking_Number->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Date', $accounts_receivable->Date->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Client_ID', $accounts_receivable->Client_ID->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Origin_ID', $accounts_receivable->Origin_ID->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Destination_ID', $accounts_receivable->Destination_ID->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Customer_ID', $accounts_receivable->Customer_ID->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Subcon_ID', $accounts_receivable->Subcon_ID->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Truck_ID', $accounts_receivable->Truck_ID->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('ETA', $accounts_receivable->ETA->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('ETD', $accounts_receivable->ETD->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Status_ID', $accounts_receivable->Status_ID->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Vat', $accounts_receivable->Vat->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Total_Sales', $accounts_receivable->Total_Sales->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Wtax', $accounts_receivable->Wtax->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('Total_Amount_Due', $accounts_receivable->Total_Amount_Due->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
					$XmlDoc->AddField('id', $accounts_receivable->id->ExportValue($accounts_receivable->Export, $accounts_receivable->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($accounts_receivable->Booking_Number);
					$ExportDoc->ExportField($accounts_receivable->Date);
					$ExportDoc->ExportField($accounts_receivable->Client_ID);
					$ExportDoc->ExportField($accounts_receivable->Origin_ID);
					$ExportDoc->ExportField($accounts_receivable->Destination_ID);
					$ExportDoc->ExportField($accounts_receivable->Customer_ID);
					$ExportDoc->ExportField($accounts_receivable->Subcon_ID);
					$ExportDoc->ExportField($accounts_receivable->Truck_ID);
					$ExportDoc->ExportField($accounts_receivable->ETA);
					$ExportDoc->ExportField($accounts_receivable->ETD);
					$ExportDoc->ExportField($accounts_receivable->Status_ID);
					$ExportDoc->ExportField($accounts_receivable->Vat);
					$ExportDoc->ExportField($accounts_receivable->Total_Sales);
					$ExportDoc->ExportField($accounts_receivable->Wtax);
					$ExportDoc->ExportField($accounts_receivable->Total_Amount_Due);
					$ExportDoc->ExportField($accounts_receivable->id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}

		// Export aggregates (non-XML and horizontal format only)
		if ($accounts_receivable->Export <> "xml" && $ExportDoc->Horizontal) {
			$accounts_receivable->RowType = EW_ROWTYPE_AGGREGATE;
			$this->RenderRow();
			$ExportDoc->BeginExportRow();
			$ExportDoc->ExportAggregate($accounts_receivable->Booking_Number, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Date, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Client_ID, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Origin_ID, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Destination_ID, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Customer_ID, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Subcon_ID, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Truck_ID, '');
			$ExportDoc->ExportAggregate($accounts_receivable->ETA, '');
			$ExportDoc->ExportAggregate($accounts_receivable->ETD, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Status_ID, '');
			$ExportDoc->ExportAggregate($accounts_receivable->Vat, 'TOTAL');
			$ExportDoc->ExportAggregate($accounts_receivable->Total_Sales, 'TOTAL');
			$ExportDoc->ExportAggregate($accounts_receivable->Wtax, 'TOTAL');
			$ExportDoc->ExportAggregate($accounts_receivable->Total_Amount_Due, 'TOTAL');
			$ExportDoc->ExportAggregate($accounts_receivable->id, '');
			$ExportDoc->EndExportRow();
		}
		if ($accounts_receivable->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($accounts_receivable->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($accounts_receivable->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($accounts_receivable->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($accounts_receivable->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $accounts_receivable;
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
				$this->sDbMasterFilter = $accounts_receivable->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $accounts_receivable->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$accounts_receivable->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$accounts_receivable->Client_ID->setSessionValue($accounts_receivable->Client_ID->QueryStringValue);
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
			$accounts_receivable->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$accounts_receivable->setStartRecordNumber($this->lStartRec);
			$accounts_receivable->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$accounts_receivable->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($accounts_receivable->Client_ID->QueryStringValue == "") $accounts_receivable->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $accounts_receivable->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $accounts_receivable->getDetailFilter(); // Restore detail filter
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
