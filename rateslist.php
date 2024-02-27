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
$rates_list = new crates_list();
$Page =& $rates_list;

// Page init
$rates_list->Page_Init();

// Page main
$rates_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($rates->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var rates_list = new ew_Page("rates_list");

// page properties
rates_list.PageID = "list"; // page ID
rates_list.FormID = "frateslist"; // form ID
var EW_PAGE_ID = rates_list.PageID; // for backward compatibility

// extend page with validate function for search
rates_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Date->FldErrMsg()) ?>");

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
rates_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
rates_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
rates_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rates_list.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<?php if ($rates->Export == "") { ?>
<?php
$gsMasterReturnUrl = "clientslist.php";
if ($rates_list->sDbMasterFilter <> "" && $rates->getCurrentMasterTable() == "clients") {
	if ($rates_list->bMasterRecordExists) {
		if ($rates->getCurrentMasterTable() == $rates->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$rates_list->lTotalRecs = $rates->SelectRecordCount();
	} else {
		if ($rs = $rates_list->LoadRecordset())
			$rates_list->lTotalRecs = $rs->RecordCount();
	}
	$rates_list->lStartRec = 1;
	if ($rates_list->lDisplayRecs <= 0 || ($rates->Export <> "" && $rates->ExportAll)) // Display all records
		$rates_list->lDisplayRecs = $rates_list->lTotalRecs;
	if (!($rates->Export <> "" && $rates->ExportAll))
		$rates_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $rates_list->LoadRecordset($rates_list->lStartRec-1, $rates_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rates->TableCaption() ?>
<?php if ($rates->Export == "" && $rates->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $rates_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $rates_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $rates_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($rates->Export == "" && $rates->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(rates_list);" style="text-decoration: none;"><img id="rates_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="rates_list_SearchPanel">
<form name="frateslistsrch" id="frateslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return rates_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="rates">
<?php
if ($gsSearchError == "")
	$rates_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$rates->RowType = EW_ROWTYPE_SEARCH;

// Render row
$rates_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $rates->Date->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Date" id="z_Date" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $rates->Client_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($rates->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $rates->Client_ID->ViewAttributes() ?>><?php echo $rates->Client_ID->ListViewValue() ?></div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($rates->Client_ID->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<?php $rates->Client_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Origin_ID','x_Client_ID',rates_list.ar_x_Origin_ID);ew_UpdateOpt('x_Destination_ID','x_Client_ID',rates_list.ar_x_Destination_ID); " . @$rates->Client_ID->EditAttrs["onchange"]; ?>
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $rates->Area_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Area_ID" id="z_Area_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $rates->Origin_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Origin_ID" id="z_Origin_ID" value="="></span></td>
		<td>			
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
rates_list.ar_x_Origin_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $rates->Destination_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Destination_ID" id="z_Destination_ID" value="="></span></td>
		<td>			
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
rates_list.ar_x_Destination_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $rates->Truck_Type_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_Type_ID" id="z_Truck_Type_ID" value="="></span></td>
		<td>			
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
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($rates->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $rates_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="ratessrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($rates->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($rates->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($rates->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$rates_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($rates->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($rates->CurrentAction <> "gridadd" && $rates->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($rates_list->Pager)) $rates_list->Pager = new cPrevNextPager($rates_list->lStartRec, $rates_list->lDisplayRecs, $rates_list->lTotalRecs) ?>
<?php if ($rates_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($rates_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $rates_list->PageUrl() ?>start=<?php echo $rates_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($rates_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $rates_list->PageUrl() ?>start=<?php echo $rates_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rates_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($rates_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $rates_list->PageUrl() ?>start=<?php echo $rates_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($rates_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $rates_list->PageUrl() ?>start=<?php echo $rates_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rates_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rates_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rates_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rates_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($rates_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($rates_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="rates">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($rates_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($rates_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($rates_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($rates_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($rates_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($rates_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($rates->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $rates_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($rates_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.frateslist, '<?php echo $rates_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="frateslist" id="frateslist" class="ewForm" action="" method="post">
<div id="gmp_rates" class="ewGridMiddlePanel">
<?php if ($rates_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $rates->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$rates_list->RenderListOptions();

// Render list options (header, left)
$rates_list->ListOptions->Render("header", "left");
?>
<?php if ($rates->id->Visible) { // id ?>
	<?php if ($rates->SortUrl($rates->id) == "") { ?>
		<td><?php echo $rates->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Date->Visible) { // Date ?>
	<?php if ($rates->SortUrl($rates->Date) == "") { ?>
		<td><?php echo $rates->Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Client_ID->Visible) { // Client_ID ?>
	<?php if ($rates->SortUrl($rates->Client_ID) == "") { ?>
		<td><?php echo $rates->Client_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Client_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Client_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Client_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Client_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Area_ID->Visible) { // Area_ID ?>
	<?php if ($rates->SortUrl($rates->Area_ID) == "") { ?>
		<td><?php echo $rates->Area_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Area_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Area_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Area_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Area_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Origin_ID->Visible) { // Origin_ID ?>
	<?php if ($rates->SortUrl($rates->Origin_ID) == "") { ?>
		<td><?php echo $rates->Origin_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Origin_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Origin_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Origin_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Origin_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Destination_ID->Visible) { // Destination_ID ?>
	<?php if ($rates->SortUrl($rates->Destination_ID) == "") { ?>
		<td><?php echo $rates->Destination_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Destination_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Destination_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Destination_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Destination_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Distance->Visible) { // Distance ?>
	<?php if ($rates->SortUrl($rates->Distance) == "") { ?>
		<td><?php echo $rates->Distance->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Distance) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Distance->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($rates->Distance->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Distance->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Truck_Type_ID->Visible) { // Truck_Type_ID ?>
	<?php if ($rates->SortUrl($rates->Truck_Type_ID) == "") { ?>
		<td><?php echo $rates->Truck_Type_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Truck_Type_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Truck_Type_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Truck_Type_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Truck_Type_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Unit_ID->Visible) { // Unit_ID ?>
	<?php if ($rates->SortUrl($rates->Unit_ID) == "") { ?>
		<td><?php echo $rates->Unit_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Unit_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Unit_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Unit_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Unit_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Freight_Rate->Visible) { // Freight_Rate ?>
	<?php if ($rates->SortUrl($rates->Freight_Rate) == "") { ?>
		<td><?php echo $rates->Freight_Rate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Freight_Rate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Freight_Rate->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Freight_Rate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Freight_Rate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Vat->Visible) { // Vat ?>
	<?php if ($rates->SortUrl($rates->Vat) == "") { ?>
		<td><?php echo $rates->Vat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Vat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Vat->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Vat->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Vat->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($rates->Wtax->Visible) { // Wtax ?>
	<?php if ($rates->SortUrl($rates->Wtax) == "") { ?>
		<td><?php echo $rates->Wtax->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $rates->SortUrl($rates->Wtax) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $rates->Wtax->FldCaption() ?></td><td style="width: 10px;"><?php if ($rates->Wtax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($rates->Wtax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$rates_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($rates->ExportAll && $rates->Export <> "") {
	$rates_list->lStopRec = $rates_list->lTotalRecs;
} else {
	$rates_list->lStopRec = $rates_list->lStartRec + $rates_list->lDisplayRecs - 1; // Set the last record to display
}
$rates_list->lRecCount = $rates_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $rates_list->lStartRec > 1)
		$rs->Move($rates_list->lStartRec - 1);
}

// Initialize aggregate
$rates->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rates_list->RenderRow();
$rates_list->lRowCnt = 0;
while (($rates->CurrentAction == "gridadd" || !$rs->EOF) &&
	$rates_list->lRecCount < $rates_list->lStopRec) {
	$rates_list->lRecCount++;
	if (intval($rates_list->lRecCount) >= intval($rates_list->lStartRec)) {
		$rates_list->lRowCnt++;

	// Init row class and style
	$rates->CssClass = "";
	$rates->CssStyle = "";
	$rates->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($rates->CurrentAction == "gridadd") {
		$rates_list->LoadDefaultValues(); // Load default values
	} else {
		$rates_list->LoadRowValues($rs); // Load row values
	}
	$rates->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$rates_list->RenderRow();

	// Render list options
	$rates_list->RenderListOptions();
?>
	<tr<?php echo $rates->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rates_list->ListOptions->Render("body", "left");
?>
	<?php if ($rates->id->Visible) { // id ?>
		<td<?php echo $rates->id->CellAttributes() ?>>
<div<?php echo $rates->id->ViewAttributes() ?>><?php echo $rates->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Date->Visible) { // Date ?>
		<td<?php echo $rates->Date->CellAttributes() ?>>
<div<?php echo $rates->Date->ViewAttributes() ?>><?php echo $rates->Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Client_ID->Visible) { // Client_ID ?>
		<td<?php echo $rates->Client_ID->CellAttributes() ?>>
<div<?php echo $rates->Client_ID->ViewAttributes() ?>><?php echo $rates->Client_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Area_ID->Visible) { // Area_ID ?>
		<td<?php echo $rates->Area_ID->CellAttributes() ?>>
<div<?php echo $rates->Area_ID->ViewAttributes() ?>><?php echo $rates->Area_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Origin_ID->Visible) { // Origin_ID ?>
		<td<?php echo $rates->Origin_ID->CellAttributes() ?>>
<div<?php echo $rates->Origin_ID->ViewAttributes() ?>><?php echo $rates->Origin_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Destination_ID->Visible) { // Destination_ID ?>
		<td<?php echo $rates->Destination_ID->CellAttributes() ?>>
<div<?php echo $rates->Destination_ID->ViewAttributes() ?>><?php echo $rates->Destination_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Distance->Visible) { // Distance ?>
		<td<?php echo $rates->Distance->CellAttributes() ?>>
<div<?php echo $rates->Distance->ViewAttributes() ?>><?php echo $rates->Distance->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Truck_Type_ID->Visible) { // Truck_Type_ID ?>
		<td<?php echo $rates->Truck_Type_ID->CellAttributes() ?>>
<div<?php echo $rates->Truck_Type_ID->ViewAttributes() ?>><?php echo $rates->Truck_Type_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Unit_ID->Visible) { // Unit_ID ?>
		<td<?php echo $rates->Unit_ID->CellAttributes() ?>>
<div<?php echo $rates->Unit_ID->ViewAttributes() ?>><?php echo $rates->Unit_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Freight_Rate->Visible) { // Freight_Rate ?>
		<td<?php echo $rates->Freight_Rate->CellAttributes() ?>>
<div<?php echo $rates->Freight_Rate->ViewAttributes() ?>><?php echo $rates->Freight_Rate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Vat->Visible) { // Vat ?>
		<td<?php echo $rates->Vat->CellAttributes() ?>>
<div<?php echo $rates->Vat->ViewAttributes() ?>><?php echo $rates->Vat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($rates->Wtax->Visible) { // Wtax ?>
		<td<?php echo $rates->Wtax->CellAttributes() ?>>
<div<?php echo $rates->Wtax->ViewAttributes() ?>><?php echo $rates->Wtax->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rates_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($rates->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($rates_list->lTotalRecs > 0) { ?>
<?php if ($rates->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($rates->CurrentAction <> "gridadd" && $rates->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($rates_list->Pager)) $rates_list->Pager = new cPrevNextPager($rates_list->lStartRec, $rates_list->lDisplayRecs, $rates_list->lTotalRecs) ?>
<?php if ($rates_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($rates_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $rates_list->PageUrl() ?>start=<?php echo $rates_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($rates_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $rates_list->PageUrl() ?>start=<?php echo $rates_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rates_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($rates_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $rates_list->PageUrl() ?>start=<?php echo $rates_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($rates_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $rates_list->PageUrl() ?>start=<?php echo $rates_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rates_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rates_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rates_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rates_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($rates_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($rates_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="rates">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($rates_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($rates_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($rates_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($rates_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($rates_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($rates_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($rates->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($rates_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $rates_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($rates_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.frateslist, '<?php echo $rates_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($rates->Export == "" && $rates->CurrentAction == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_Origin_ID','x_Client_ID',rates_list.ar_x_Origin_ID],
['x_Destination_ID','x_Client_ID',rates_list.ar_x_Destination_ID]]);

//-->
</script>
<?php } ?>
<?php if ($rates->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$rates_list->Page_Terminate();
?>
<?php

//
// Page class
//
class crates_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'rates';

	// Page object name
	var $PageObjName = 'rates_list';

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
	function crates_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (rates)
		$GLOBALS["rates"] = new crates();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["rates"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "ratesdelete.php";
		$this->MultiUpdateUrl = "ratesupdate.php";

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rates', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$rates->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$rates->Export = $_POST["exporttype"];
		} else {
			$rates->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $rates->Export; // Get export parameter, used in header
		$gsExportFile = $rates->TableVar; // Get export file, used in header
		if ($rates->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $rates;

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
			$rates->Recordset_SearchValidated();

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
		if ($rates->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $rates->getRecordsPerPage(); // Restore from Session
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
		$rates->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$rates->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$rates->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $rates->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $rates->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $rates->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($rates->getMasterFilter() <> "" && $rates->getCurrentMasterTable() == "clients") {
			global $clients;
			$rsmaster = $clients->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$rates->setMasterFilter(""); // Clear master filter
				$rates->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($rates->getReturnUrl()); // Return to caller
			} else {
				$clients->LoadListRowValues($rsmaster);
				$clients->RowType = EW_ROWTYPE_MASTER; // Master row
				$clients->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$rates->setSessionWhere($sFilter);
		$rates->CurrentFilter = "";

		// Export data only
		if (in_array($rates->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($rates->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $rates;
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
			$rates->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$rates->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $rates;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $rates->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $rates->Date, FALSE); // Date
		$this->BuildSearchSql($sWhere, $rates->Client_ID, FALSE); // Client_ID
		$this->BuildSearchSql($sWhere, $rates->Area_ID, FALSE); // Area_ID
		$this->BuildSearchSql($sWhere, $rates->Origin_ID, FALSE); // Origin_ID
		$this->BuildSearchSql($sWhere, $rates->Destination_ID, FALSE); // Destination_ID
		$this->BuildSearchSql($sWhere, $rates->Distance, FALSE); // Distance
		$this->BuildSearchSql($sWhere, $rates->Truck_Type_ID, FALSE); // Truck_Type_ID
		$this->BuildSearchSql($sWhere, $rates->Unit_ID, FALSE); // Unit_ID
		$this->BuildSearchSql($sWhere, $rates->Freight_Rate, FALSE); // Freight_Rate
		$this->BuildSearchSql($sWhere, $rates->Vat, FALSE); // Vat
		$this->BuildSearchSql($sWhere, $rates->Wtax, FALSE); // Wtax
		$this->BuildSearchSql($sWhere, $rates->Remarks, FALSE); // Remarks

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($rates->id); // id
			$this->SetSearchParm($rates->Date); // Date
			$this->SetSearchParm($rates->Client_ID); // Client_ID
			$this->SetSearchParm($rates->Area_ID); // Area_ID
			$this->SetSearchParm($rates->Origin_ID); // Origin_ID
			$this->SetSearchParm($rates->Destination_ID); // Destination_ID
			$this->SetSearchParm($rates->Distance); // Distance
			$this->SetSearchParm($rates->Truck_Type_ID); // Truck_Type_ID
			$this->SetSearchParm($rates->Unit_ID); // Unit_ID
			$this->SetSearchParm($rates->Freight_Rate); // Freight_Rate
			$this->SetSearchParm($rates->Vat); // Vat
			$this->SetSearchParm($rates->Wtax); // Wtax
			$this->SetSearchParm($rates->Remarks); // Remarks
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
		global $rates;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$rates->setAdvancedSearch("x_$FldParm", $FldVal);
		$rates->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$rates->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$rates->setAdvancedSearch("y_$FldParm", $FldVal2);
		$rates->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $rates;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $rates->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $rates->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $rates->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $rates->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $rates->GetAdvancedSearch("w_$FldParm");
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
		global $rates;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $rates->Distance, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $rates->Remarks, $Keyword);
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
		global $Security, $rates;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $rates->BasicSearchKeyword;
		$sSearchType = $rates->BasicSearchType;
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
			$rates->setSessionBasicSearchKeyword($sSearchKeyword);
			$rates->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $rates;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$rates->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $rates;
		$rates->setSessionBasicSearchKeyword("");
		$rates->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $rates;
		$rates->setAdvancedSearch("x_id", "");
		$rates->setAdvancedSearch("x_Date", "");
		$rates->setAdvancedSearch("y_Date", "");
		$rates->setAdvancedSearch("x_Client_ID", "");
		$rates->setAdvancedSearch("x_Area_ID", "");
		$rates->setAdvancedSearch("x_Origin_ID", "");
		$rates->setAdvancedSearch("x_Destination_ID", "");
		$rates->setAdvancedSearch("x_Distance", "");
		$rates->setAdvancedSearch("x_Truck_Type_ID", "");
		$rates->setAdvancedSearch("x_Unit_ID", "");
		$rates->setAdvancedSearch("x_Freight_Rate", "");
		$rates->setAdvancedSearch("x_Vat", "");
		$rates->setAdvancedSearch("x_Wtax", "");
		$rates->setAdvancedSearch("x_Remarks", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $rates;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["y_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Client_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Area_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Origin_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Destination_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Distance"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Truck_Type_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Unit_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Freight_Rate"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Vat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Wtax"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$rates->BasicSearchKeyword = $rates->getSessionBasicSearchKeyword();
			$rates->BasicSearchType = $rates->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($rates->id);
			$this->GetSearchParm($rates->Date);
			$this->GetSearchParm($rates->Client_ID);
			$this->GetSearchParm($rates->Area_ID);
			$this->GetSearchParm($rates->Origin_ID);
			$this->GetSearchParm($rates->Destination_ID);
			$this->GetSearchParm($rates->Distance);
			$this->GetSearchParm($rates->Truck_Type_ID);
			$this->GetSearchParm($rates->Unit_ID);
			$this->GetSearchParm($rates->Freight_Rate);
			$this->GetSearchParm($rates->Vat);
			$this->GetSearchParm($rates->Wtax);
			$this->GetSearchParm($rates->Remarks);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $rates;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$rates->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$rates->CurrentOrderType = @$_GET["ordertype"];
			$rates->UpdateSort($rates->id); // id
			$rates->UpdateSort($rates->Date); // Date
			$rates->UpdateSort($rates->Client_ID); // Client_ID
			$rates->UpdateSort($rates->Area_ID); // Area_ID
			$rates->UpdateSort($rates->Origin_ID); // Origin_ID
			$rates->UpdateSort($rates->Destination_ID); // Destination_ID
			$rates->UpdateSort($rates->Distance); // Distance
			$rates->UpdateSort($rates->Truck_Type_ID); // Truck_Type_ID
			$rates->UpdateSort($rates->Unit_ID); // Unit_ID
			$rates->UpdateSort($rates->Freight_Rate); // Freight_Rate
			$rates->UpdateSort($rates->Vat); // Vat
			$rates->UpdateSort($rates->Wtax); // Wtax
			$rates->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $rates;
		$sOrderBy = $rates->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($rates->SqlOrderBy() <> "") {
				$sOrderBy = $rates->SqlOrderBy();
				$rates->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $rates;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$rates->getCurrentMasterTable = ""; // Clear master table
				$rates->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$rates->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$rates->Client_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$rates->setSessionOrderBy($sOrderBy);
				$rates->id->setSort("");
				$rates->Date->setSort("");
				$rates->Client_ID->setSort("");
				$rates->Area_ID->setSort("");
				$rates->Origin_ID->setSort("");
				$rates->Destination_ID->setSort("");
				$rates->Distance->setSort("");
				$rates->Truck_Type_ID->setSort("");
				$rates->Unit_ID->setSort("");
				$rates->Freight_Rate->setSort("");
				$rates->Vat->setSort("");
				$rates->Wtax->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$rates->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $rates;

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

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"rates_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($rates->Export <> "" ||
			$rates->CurrentAction == "gridadd" ||
			$rates->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $rates;
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

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->CanAdd() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($rates->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $rates;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $rates;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$rates->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$rates->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $rates->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$rates->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$rates->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$rates->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $rates;
		$rates->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$rates->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $rates;

		// Load search values
		// id

		$rates->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$rates->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Date
		$rates->Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Date"]);
		$rates->Date->AdvancedSearch->SearchOperator = @$_GET["z_Date"];
		$rates->Date->AdvancedSearch->SearchCondition = @$_GET["v_Date"];
		$rates->Date->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_Date"]);
		$rates->Date->AdvancedSearch->SearchOperator2 = @$_GET["w_Date"];

		// Client_ID
		$rates->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Client_ID"]);
		$rates->Client_ID->AdvancedSearch->SearchOperator = @$_GET["z_Client_ID"];

		// Area_ID
		$rates->Area_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Area_ID"]);
		$rates->Area_ID->AdvancedSearch->SearchOperator = @$_GET["z_Area_ID"];

		// Origin_ID
		$rates->Origin_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Origin_ID"]);
		$rates->Origin_ID->AdvancedSearch->SearchOperator = @$_GET["z_Origin_ID"];

		// Destination_ID
		$rates->Destination_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Destination_ID"]);
		$rates->Destination_ID->AdvancedSearch->SearchOperator = @$_GET["z_Destination_ID"];

		// Distance
		$rates->Distance->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Distance"]);
		$rates->Distance->AdvancedSearch->SearchOperator = @$_GET["z_Distance"];

		// Truck_Type_ID
		$rates->Truck_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Truck_Type_ID"]);
		$rates->Truck_Type_ID->AdvancedSearch->SearchOperator = @$_GET["z_Truck_Type_ID"];

		// Unit_ID
		$rates->Unit_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Unit_ID"]);
		$rates->Unit_ID->AdvancedSearch->SearchOperator = @$_GET["z_Unit_ID"];

		// Freight_Rate
		$rates->Freight_Rate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Freight_Rate"]);
		$rates->Freight_Rate->AdvancedSearch->SearchOperator = @$_GET["z_Freight_Rate"];

		// Vat
		$rates->Vat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Vat"]);
		$rates->Vat->AdvancedSearch->SearchOperator = @$_GET["z_Vat"];

		// Wtax
		$rates->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Wtax"]);
		$rates->Wtax->AdvancedSearch->SearchOperator = @$_GET["z_Wtax"];

		// Remarks
		$rates->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$rates->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $rates;

		// Call Recordset Selecting event
		$rates->Recordset_Selecting($rates->CurrentFilter);

		// Load List page SQL
		$sSql = $rates->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$rates->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rates;
		$sFilter = $rates->KeyFilter();

		// Call Row Selecting event
		$rates->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rates->CurrentFilter = $sFilter;
		$sSql = $rates->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$rates->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $rates;
		$rates->id->setDbValue($rs->fields('id'));
		$rates->Date->setDbValue($rs->fields('Date'));
		$rates->Client_ID->setDbValue($rs->fields('Client_ID'));
		$rates->Area_ID->setDbValue($rs->fields('Area_ID'));
		$rates->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$rates->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$rates->Distance->setDbValue($rs->fields('Distance'));
		$rates->Truck_Type_ID->setDbValue($rs->fields('Truck_Type_ID'));
		$rates->Unit_ID->setDbValue($rs->fields('Unit_ID'));
		$rates->Freight_Rate->setDbValue($rs->fields('Freight_Rate'));
		$rates->Vat->setDbValue($rs->fields('Vat'));
		$rates->Wtax->setDbValue($rs->fields('Wtax'));
		$rates->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rates;

		// Initialize URLs
		$this->ViewUrl = $rates->ViewUrl();
		$this->EditUrl = $rates->EditUrl();
		$this->InlineEditUrl = $rates->InlineEditUrl();
		$this->CopyUrl = $rates->CopyUrl();
		$this->InlineCopyUrl = $rates->InlineCopyUrl();
		$this->DeleteUrl = $rates->DeleteUrl();

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

			// Freight_Rate
			$rates->Freight_Rate->EditCustomAttributes = "";
			$rates->Freight_Rate->EditValue = ew_HtmlEncode($rates->Freight_Rate->AdvancedSearch->SearchValue);

			// Vat
			$rates->Vat->EditCustomAttributes = "";
			$rates->Vat->EditValue = ew_HtmlEncode($rates->Vat->AdvancedSearch->SearchValue);

			// Wtax
			$rates->Wtax->EditCustomAttributes = "";
			$rates->Wtax->EditValue = ew_HtmlEncode($rates->Wtax->AdvancedSearch->SearchValue);
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
		if (!ew_CheckUSDate($rates->Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $rates->Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($rates->Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $rates->Date->FldErrMsg();
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $rates;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $rates->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($rates->ExportAll) {
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
		if ($rates->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($rates, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($rates->id);
				$ExportDoc->ExportCaption($rates->Date);
				$ExportDoc->ExportCaption($rates->Client_ID);
				$ExportDoc->ExportCaption($rates->Area_ID);
				$ExportDoc->ExportCaption($rates->Origin_ID);
				$ExportDoc->ExportCaption($rates->Destination_ID);
				$ExportDoc->ExportCaption($rates->Distance);
				$ExportDoc->ExportCaption($rates->Truck_Type_ID);
				$ExportDoc->ExportCaption($rates->Unit_ID);
				$ExportDoc->ExportCaption($rates->Freight_Rate);
				$ExportDoc->ExportCaption($rates->Vat);
				$ExportDoc->ExportCaption($rates->Wtax);
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
				$rates->CssClass = "";
				$rates->CssStyle = "";
				$rates->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($rates->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $rates->id->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Date', $rates->Date->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Client_ID', $rates->Client_ID->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Area_ID', $rates->Area_ID->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Origin_ID', $rates->Origin_ID->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Destination_ID', $rates->Destination_ID->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Distance', $rates->Distance->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Truck_Type_ID', $rates->Truck_Type_ID->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Unit_ID', $rates->Unit_ID->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Freight_Rate', $rates->Freight_Rate->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Vat', $rates->Vat->ExportValue($rates->Export, $rates->ExportOriginalValue));
					$XmlDoc->AddField('Wtax', $rates->Wtax->ExportValue($rates->Export, $rates->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($rates->id);
					$ExportDoc->ExportField($rates->Date);
					$ExportDoc->ExportField($rates->Client_ID);
					$ExportDoc->ExportField($rates->Area_ID);
					$ExportDoc->ExportField($rates->Origin_ID);
					$ExportDoc->ExportField($rates->Destination_ID);
					$ExportDoc->ExportField($rates->Distance);
					$ExportDoc->ExportField($rates->Truck_Type_ID);
					$ExportDoc->ExportField($rates->Unit_ID);
					$ExportDoc->ExportField($rates->Freight_Rate);
					$ExportDoc->ExportField($rates->Vat);
					$ExportDoc->ExportField($rates->Wtax);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($rates->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($rates->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($rates->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($rates->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($rates->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $rates;
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
				$this->sDbMasterFilter = $rates->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $rates->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$rates->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$rates->Client_ID->setSessionValue($rates->Client_ID->QueryStringValue);
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
			$rates->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$rates->setStartRecordNumber($this->lStartRec);
			$rates->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$rates->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($rates->Client_ID->QueryStringValue == "") $rates->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $rates->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $rates->getDetailFilter(); // Restore detail filter
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
