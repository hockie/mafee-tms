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
$sales_list = new csales_list();
$Page =& $sales_list;

// Page init
$sales_list->Page_Init();

// Page main
$sales_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($sales->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var sales_list = new ew_Page("sales_list");

// page properties
sales_list.PageID = "list"; // page ID
sales_list.FormID = "fsaleslist"; // form ID
var EW_PAGE_ID = sales_list.PageID; // for backward compatibility

// extend page with validate function for search
sales_list.ValidateSearch = function(fobj) {
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
sales_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
sales_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
sales_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($sales->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$sales_list->lTotalRecs = $sales->SelectRecordCount();
	} else {
		if ($rs = $sales_list->LoadRecordset())
			$sales_list->lTotalRecs = $rs->RecordCount();
	}
	$sales_list->lStartRec = 1;
	if ($sales_list->lDisplayRecs <= 0 || ($sales->Export <> "" && $sales->ExportAll)) // Display all records
		$sales_list->lDisplayRecs = $sales_list->lTotalRecs;
	if (!($sales->Export <> "" && $sales->ExportAll))
		$sales_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $sales_list->LoadRecordset($sales_list->lStartRec-1, $sales_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $sales->TableCaption() ?>
<?php if ($sales->Export == "" && $sales->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $sales_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $sales_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $sales_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($sales->Export == "" && $sales->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(sales_list);" style="text-decoration: none;"><img id="sales_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="sales_list_SearchPanel">
<form name="fsaleslistsrch" id="fsaleslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return sales_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="sales">
<?php
if ($gsSearchError == "")
	$sales_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$sales->RowType = EW_ROWTYPE_SEARCH;

// Render row
$sales_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $sales->Date->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Date" id="z_Date" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sales->Client_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sales->Origin_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Origin_ID" id="z_Origin_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sales->Destination_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Destination_ID" id="z_Destination_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sales->Customer_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Customer_ID" id="z_Customer_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sales->Subcon_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sales->Truck_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_ID" id="z_Truck_ID" value="="></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sales->ETA->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETA" id="z_ETA" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $sales->ETD->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_ETD" id="z_ETD" value="BETWEEN"></span></td>
		<td>			
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
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($sales->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $sales_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="salessrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($sales->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($sales->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($sales->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$sales_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($sales->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($sales->CurrentAction <> "gridadd" && $sales->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($sales_list->Pager)) $sales_list->Pager = new cPrevNextPager($sales_list->lStartRec, $sales_list->lDisplayRecs, $sales_list->lTotalRecs) ?>
<?php if ($sales_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($sales_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $sales_list->PageUrl() ?>start=<?php echo $sales_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($sales_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $sales_list->PageUrl() ?>start=<?php echo $sales_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $sales_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($sales_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $sales_list->PageUrl() ?>start=<?php echo $sales_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($sales_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $sales_list->PageUrl() ?>start=<?php echo $sales_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $sales_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $sales_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $sales_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $sales_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($sales_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($sales_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="sales">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($sales_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($sales_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($sales_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($sales_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($sales_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($sales_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($sales->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
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
<form name="fsaleslist" id="fsaleslist" class="ewForm" action="" method="post">
<div id="gmp_sales" class="ewGridMiddlePanel">
<?php if ($sales_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $sales->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$sales_list->RenderListOptions();

// Render list options (header, left)
$sales_list->ListOptions->Render("header", "left");
?>
<?php if ($sales->Booking_Number->Visible) { // Booking_Number ?>
	<?php if ($sales->SortUrl($sales->Booking_Number) == "") { ?>
		<td><?php echo $sales->Booking_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Booking_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Booking_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($sales->Booking_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Booking_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Date->Visible) { // Date ?>
	<?php if ($sales->SortUrl($sales->Date) == "") { ?>
		<td><?php echo $sales->Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Client_ID->Visible) { // Client_ID ?>
	<?php if ($sales->SortUrl($sales->Client_ID) == "") { ?>
		<td><?php echo $sales->Client_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Client_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Client_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Client_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Client_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Origin_ID->Visible) { // Origin_ID ?>
	<?php if ($sales->SortUrl($sales->Origin_ID) == "") { ?>
		<td><?php echo $sales->Origin_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Origin_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Origin_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Origin_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Origin_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Destination_ID->Visible) { // Destination_ID ?>
	<?php if ($sales->SortUrl($sales->Destination_ID) == "") { ?>
		<td><?php echo $sales->Destination_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Destination_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Destination_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Destination_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Destination_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Customer_ID->Visible) { // Customer_ID ?>
	<?php if ($sales->SortUrl($sales->Customer_ID) == "") { ?>
		<td><?php echo $sales->Customer_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Customer_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Customer_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Customer_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Customer_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Subcon_ID->Visible) { // Subcon_ID ?>
	<?php if ($sales->SortUrl($sales->Subcon_ID) == "") { ?>
		<td><?php echo $sales->Subcon_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Subcon_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Subcon_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Subcon_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Subcon_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Truck_ID->Visible) { // Truck_ID ?>
	<?php if ($sales->SortUrl($sales->Truck_ID) == "") { ?>
		<td><?php echo $sales->Truck_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Truck_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Truck_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Truck_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Truck_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->ETA->Visible) { // ETA ?>
	<?php if ($sales->SortUrl($sales->ETA) == "") { ?>
		<td><?php echo $sales->ETA->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->ETA) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->ETA->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->ETA->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->ETA->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->ETD->Visible) { // ETD ?>
	<?php if ($sales->SortUrl($sales->ETD) == "") { ?>
		<td><?php echo $sales->ETD->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->ETD) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->ETD->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->ETD->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->ETD->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Billing_Type_ID->Visible) { // Billing_Type_ID ?>
	<?php if ($sales->SortUrl($sales->Billing_Type_ID) == "") { ?>
		<td><?php echo $sales->Billing_Type_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Billing_Type_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Billing_Type_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Billing_Type_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Billing_Type_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Total_Sales->Visible) { // Total_Sales ?>
	<?php if ($sales->SortUrl($sales->Total_Sales) == "") { ?>
		<td><?php echo $sales->Total_Sales->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Total_Sales) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Total_Sales->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Total_Sales->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Total_Sales->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Wtax->Visible) { // Wtax ?>
	<?php if ($sales->SortUrl($sales->Wtax) == "") { ?>
		<td><?php echo $sales->Wtax->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Wtax) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Wtax->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Wtax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Wtax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($sales->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<?php if ($sales->SortUrl($sales->Total_Amount_Due) == "") { ?>
		<td><?php echo $sales->Total_Amount_Due->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $sales->SortUrl($sales->Total_Amount_Due) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $sales->Total_Amount_Due->FldCaption() ?></td><td style="width: 10px;"><?php if ($sales->Total_Amount_Due->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($sales->Total_Amount_Due->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$sales_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($sales->ExportAll && $sales->Export <> "") {
	$sales_list->lStopRec = $sales_list->lTotalRecs;
} else {
	$sales_list->lStopRec = $sales_list->lStartRec + $sales_list->lDisplayRecs - 1; // Set the last record to display
}
$sales_list->lRecCount = $sales_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $sales_list->lStartRec > 1)
		$rs->Move($sales_list->lStartRec - 1);
}

// Initialize aggregate
$sales->RowType = EW_ROWTYPE_AGGREGATEINIT;
$sales_list->RenderRow();
$sales_list->lRowCnt = 0;
while (($sales->CurrentAction == "gridadd" || !$rs->EOF) &&
	$sales_list->lRecCount < $sales_list->lStopRec) {
	$sales_list->lRecCount++;
	if (intval($sales_list->lRecCount) >= intval($sales_list->lStartRec)) {
		$sales_list->lRowCnt++;

	// Init row class and style
	$sales->CssClass = "";
	$sales->CssStyle = "";
	$sales->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($sales->CurrentAction == "gridadd") {
		$sales_list->LoadDefaultValues(); // Load default values
	} else {
		$sales_list->LoadRowValues($rs); // Load row values
	}
	$sales->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$sales_list->RenderRow();

	// Render list options
	$sales_list->RenderListOptions();
?>
	<tr<?php echo $sales->RowAttributes() ?>>
<?php

// Render list options (body, left)
$sales_list->ListOptions->Render("body", "left");
?>
	<?php if ($sales->Booking_Number->Visible) { // Booking_Number ?>
		<td<?php echo $sales->Booking_Number->CellAttributes() ?>>
<div<?php echo $sales->Booking_Number->ViewAttributes() ?>><?php echo $sales->Booking_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Date->Visible) { // Date ?>
		<td<?php echo $sales->Date->CellAttributes() ?>>
<div<?php echo $sales->Date->ViewAttributes() ?>><?php echo $sales->Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Client_ID->Visible) { // Client_ID ?>
		<td<?php echo $sales->Client_ID->CellAttributes() ?>>
<div<?php echo $sales->Client_ID->ViewAttributes() ?>><?php echo $sales->Client_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Origin_ID->Visible) { // Origin_ID ?>
		<td<?php echo $sales->Origin_ID->CellAttributes() ?>>
<div<?php echo $sales->Origin_ID->ViewAttributes() ?>><?php echo $sales->Origin_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Destination_ID->Visible) { // Destination_ID ?>
		<td<?php echo $sales->Destination_ID->CellAttributes() ?>>
<div<?php echo $sales->Destination_ID->ViewAttributes() ?>><?php echo $sales->Destination_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Customer_ID->Visible) { // Customer_ID ?>
		<td<?php echo $sales->Customer_ID->CellAttributes() ?>>
<div<?php echo $sales->Customer_ID->ViewAttributes() ?>><?php echo $sales->Customer_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Subcon_ID->Visible) { // Subcon_ID ?>
		<td<?php echo $sales->Subcon_ID->CellAttributes() ?>>
<div<?php echo $sales->Subcon_ID->ViewAttributes() ?>><?php echo $sales->Subcon_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Truck_ID->Visible) { // Truck_ID ?>
		<td<?php echo $sales->Truck_ID->CellAttributes() ?>>
<div<?php echo $sales->Truck_ID->ViewAttributes() ?>><?php echo $sales->Truck_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->ETA->Visible) { // ETA ?>
		<td<?php echo $sales->ETA->CellAttributes() ?>>
<div<?php echo $sales->ETA->ViewAttributes() ?>><?php echo $sales->ETA->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->ETD->Visible) { // ETD ?>
		<td<?php echo $sales->ETD->CellAttributes() ?>>
<div<?php echo $sales->ETD->ViewAttributes() ?>><?php echo $sales->ETD->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Billing_Type_ID->Visible) { // Billing_Type_ID ?>
		<td<?php echo $sales->Billing_Type_ID->CellAttributes() ?>>
<div<?php echo $sales->Billing_Type_ID->ViewAttributes() ?>><?php echo $sales->Billing_Type_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Total_Sales->Visible) { // Total_Sales ?>
		<td<?php echo $sales->Total_Sales->CellAttributes() ?>>
<div<?php echo $sales->Total_Sales->ViewAttributes() ?>><?php echo $sales->Total_Sales->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Wtax->Visible) { // Wtax ?>
		<td<?php echo $sales->Wtax->CellAttributes() ?>>
<div<?php echo $sales->Wtax->ViewAttributes() ?>><?php echo $sales->Wtax->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($sales->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td<?php echo $sales->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $sales->Total_Amount_Due->ViewAttributes() ?>><?php echo $sales->Total_Amount_Due->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sales_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($sales->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$sales->RowType = EW_ROWTYPE_AGGREGATE;
$sales_list->RenderRow();
?>
<?php if ($sales_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$sales_list->RenderListOptions();

// Render list options (footer, left)
$sales_list->ListOptions->Render("footer", "left");
?>
	<?php if ($sales->Booking_Number->Visible) { // Booking_Number ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Date->Visible) { // Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Client_ID->Visible) { // Client_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Origin_ID->Visible) { // Origin_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Destination_ID->Visible) { // Destination_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Customer_ID->Visible) { // Customer_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Subcon_ID->Visible) { // Subcon_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Truck_ID->Visible) { // Truck_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->ETA->Visible) { // ETA ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->ETD->Visible) { // ETD ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Billing_Type_ID->Visible) { // Billing_Type_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($sales->Total_Sales->Visible) { // Total_Sales ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $sales->Total_Sales->ViewAttributes() ?>><?php echo $sales->Total_Sales->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($sales->Wtax->Visible) { // Wtax ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $sales->Wtax->ViewAttributes() ?>><?php echo $sales->Wtax->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($sales->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $sales->Total_Amount_Due->ViewAttributes() ?>><?php echo $sales->Total_Amount_Due->ViewValue ?></span> 
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$sales_list->ListOptions->Render("footer", "right");
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
<?php if ($sales_list->lTotalRecs > 0) { ?>
<?php if ($sales->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($sales->CurrentAction <> "gridadd" && $sales->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($sales_list->Pager)) $sales_list->Pager = new cPrevNextPager($sales_list->lStartRec, $sales_list->lDisplayRecs, $sales_list->lTotalRecs) ?>
<?php if ($sales_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($sales_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $sales_list->PageUrl() ?>start=<?php echo $sales_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($sales_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $sales_list->PageUrl() ?>start=<?php echo $sales_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $sales_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($sales_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $sales_list->PageUrl() ?>start=<?php echo $sales_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($sales_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $sales_list->PageUrl() ?>start=<?php echo $sales_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $sales_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $sales_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $sales_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $sales_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($sales_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($sales_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="sales">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($sales_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($sales_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($sales_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($sales_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($sales_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($sales_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($sales->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($sales_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($sales->Export == "" && $sales->CurrentAction == "") { ?>
<?php } ?>
<?php if ($sales->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$sales_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csales_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'sales';

	// Page object name
	var $PageObjName = 'sales_list';

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
	function csales_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (sales)
		$GLOBALS["sales"] = new csales();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["sales"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "salesdelete.php";
		$this->MultiUpdateUrl = "salesupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'sales', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$sales->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$sales->Export = $_POST["exporttype"];
		} else {
			$sales->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $sales->Export; // Get export parameter, used in header
		$gsExportFile = $sales->TableVar; // Get export file, used in header
		if ($sales->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $sales;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

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
			$sales->Recordset_SearchValidated();

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
		if ($sales->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $sales->getRecordsPerPage(); // Restore from Session
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
		$sales->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$sales->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$sales->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $sales->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$sales->setSessionWhere($sFilter);
		$sales->CurrentFilter = "";

		// Export data only
		if (in_array($sales->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($sales->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $sales;
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
			$sales->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$sales->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $sales;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $sales->Booking_Number, FALSE); // Booking_Number
		$this->BuildSearchSql($sWhere, $sales->Date, FALSE); // Date
		$this->BuildSearchSql($sWhere, $sales->Client_ID, FALSE); // Client_ID
		$this->BuildSearchSql($sWhere, $sales->Origin_ID, FALSE); // Origin_ID
		$this->BuildSearchSql($sWhere, $sales->Destination_ID, FALSE); // Destination_ID
		$this->BuildSearchSql($sWhere, $sales->Customer_ID, FALSE); // Customer_ID
		$this->BuildSearchSql($sWhere, $sales->Subcon_ID, FALSE); // Subcon_ID
		$this->BuildSearchSql($sWhere, $sales->Truck_ID, FALSE); // Truck_ID
		$this->BuildSearchSql($sWhere, $sales->ETA, FALSE); // ETA
		$this->BuildSearchSql($sWhere, $sales->ETD, FALSE); // ETD
		$this->BuildSearchSql($sWhere, $sales->Billing_Type_ID, FALSE); // Billing_Type_ID
		$this->BuildSearchSql($sWhere, $sales->Total_Sales, FALSE); // Total_Sales
		$this->BuildSearchSql($sWhere, $sales->Wtax, FALSE); // Wtax
		$this->BuildSearchSql($sWhere, $sales->Total_Amount_Due, FALSE); // Total_Amount_Due

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($sales->Booking_Number); // Booking_Number
			$this->SetSearchParm($sales->Date); // Date
			$this->SetSearchParm($sales->Client_ID); // Client_ID
			$this->SetSearchParm($sales->Origin_ID); // Origin_ID
			$this->SetSearchParm($sales->Destination_ID); // Destination_ID
			$this->SetSearchParm($sales->Customer_ID); // Customer_ID
			$this->SetSearchParm($sales->Subcon_ID); // Subcon_ID
			$this->SetSearchParm($sales->Truck_ID); // Truck_ID
			$this->SetSearchParm($sales->ETA); // ETA
			$this->SetSearchParm($sales->ETD); // ETD
			$this->SetSearchParm($sales->Billing_Type_ID); // Billing_Type_ID
			$this->SetSearchParm($sales->Total_Sales); // Total_Sales
			$this->SetSearchParm($sales->Wtax); // Wtax
			$this->SetSearchParm($sales->Total_Amount_Due); // Total_Amount_Due
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
		global $sales;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$sales->setAdvancedSearch("x_$FldParm", $FldVal);
		$sales->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$sales->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$sales->setAdvancedSearch("y_$FldParm", $FldVal2);
		$sales->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $sales;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $sales->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $sales->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $sales->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $sales->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $sales->GetAdvancedSearch("w_$FldParm");
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
		global $sales;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $sales->Booking_Number, $Keyword);
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
		global $Security, $sales;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $sales->BasicSearchKeyword;
		$sSearchType = $sales->BasicSearchType;
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
			$sales->setSessionBasicSearchKeyword($sSearchKeyword);
			$sales->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $sales;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$sales->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $sales;
		$sales->setSessionBasicSearchKeyword("");
		$sales->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $sales;
		$sales->setAdvancedSearch("x_Booking_Number", "");
		$sales->setAdvancedSearch("x_Date", "");
		$sales->setAdvancedSearch("y_Date", "");
		$sales->setAdvancedSearch("x_Client_ID", "");
		$sales->setAdvancedSearch("x_Origin_ID", "");
		$sales->setAdvancedSearch("x_Destination_ID", "");
		$sales->setAdvancedSearch("x_Customer_ID", "");
		$sales->setAdvancedSearch("x_Subcon_ID", "");
		$sales->setAdvancedSearch("x_Truck_ID", "");
		$sales->setAdvancedSearch("x_ETA", "");
		$sales->setAdvancedSearch("y_ETA", "");
		$sales->setAdvancedSearch("x_ETD", "");
		$sales->setAdvancedSearch("y_ETD", "");
		$sales->setAdvancedSearch("x_Billing_Type_ID", "");
		$sales->setAdvancedSearch("x_Total_Sales", "");
		$sales->setAdvancedSearch("x_Wtax", "");
		$sales->setAdvancedSearch("x_Total_Amount_Due", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $sales;
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
		if (@$_GET["x_Billing_Type_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Sales"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Wtax"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Amount_Due"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$sales->BasicSearchKeyword = $sales->getSessionBasicSearchKeyword();
			$sales->BasicSearchType = $sales->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($sales->Booking_Number);
			$this->GetSearchParm($sales->Date);
			$this->GetSearchParm($sales->Client_ID);
			$this->GetSearchParm($sales->Origin_ID);
			$this->GetSearchParm($sales->Destination_ID);
			$this->GetSearchParm($sales->Customer_ID);
			$this->GetSearchParm($sales->Subcon_ID);
			$this->GetSearchParm($sales->Truck_ID);
			$this->GetSearchParm($sales->ETA);
			$this->GetSearchParm($sales->ETD);
			$this->GetSearchParm($sales->Billing_Type_ID);
			$this->GetSearchParm($sales->Total_Sales);
			$this->GetSearchParm($sales->Wtax);
			$this->GetSearchParm($sales->Total_Amount_Due);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $sales;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$sales->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$sales->CurrentOrderType = @$_GET["ordertype"];
			$sales->UpdateSort($sales->Booking_Number); // Booking_Number
			$sales->UpdateSort($sales->Date); // Date
			$sales->UpdateSort($sales->Client_ID); // Client_ID
			$sales->UpdateSort($sales->Origin_ID); // Origin_ID
			$sales->UpdateSort($sales->Destination_ID); // Destination_ID
			$sales->UpdateSort($sales->Customer_ID); // Customer_ID
			$sales->UpdateSort($sales->Subcon_ID); // Subcon_ID
			$sales->UpdateSort($sales->Truck_ID); // Truck_ID
			$sales->UpdateSort($sales->ETA); // ETA
			$sales->UpdateSort($sales->ETD); // ETD
			$sales->UpdateSort($sales->Billing_Type_ID); // Billing_Type_ID
			$sales->UpdateSort($sales->Total_Sales); // Total_Sales
			$sales->UpdateSort($sales->Wtax); // Wtax
			$sales->UpdateSort($sales->Total_Amount_Due); // Total_Amount_Due
			$sales->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $sales;
		$sOrderBy = $sales->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($sales->SqlOrderBy() <> "") {
				$sOrderBy = $sales->SqlOrderBy();
				$sales->setSessionOrderBy($sOrderBy);
				$sales->Date->setSort("DESC");
				$sales->Client_ID->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $sales;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$sales->setSessionOrderBy($sOrderBy);
				$sales->Booking_Number->setSort("");
				$sales->Date->setSort("");
				$sales->Client_ID->setSort("");
				$sales->Origin_ID->setSort("");
				$sales->Destination_ID->setSort("");
				$sales->Customer_ID->setSort("");
				$sales->Subcon_ID->setSort("");
				$sales->Truck_ID->setSort("");
				$sales->ETA->setSort("");
				$sales->ETD->setSort("");
				$sales->Billing_Type_ID->setSort("");
				$sales->Total_Sales->setSort("");
				$sales->Wtax->setSort("");
				$sales->Total_Amount_Due->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$sales->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $sales;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($sales->Export <> "" ||
			$sales->CurrentAction == "gridadd" ||
			$sales->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $sales;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $sales;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $sales;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$sales->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$sales->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $sales->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$sales->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$sales->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$sales->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $sales;
		$sales->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$sales->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $sales;

		// Load search values
		// Booking_Number

		$sales->Booking_Number->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Booking_Number"]);
		$sales->Booking_Number->AdvancedSearch->SearchOperator = @$_GET["z_Booking_Number"];

		// Date
		$sales->Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Date"]);
		$sales->Date->AdvancedSearch->SearchOperator = @$_GET["z_Date"];
		$sales->Date->AdvancedSearch->SearchCondition = @$_GET["v_Date"];
		$sales->Date->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_Date"]);
		$sales->Date->AdvancedSearch->SearchOperator2 = @$_GET["w_Date"];

		// Client_ID
		$sales->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Client_ID"]);
		$sales->Client_ID->AdvancedSearch->SearchOperator = @$_GET["z_Client_ID"];

		// Origin_ID
		$sales->Origin_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Origin_ID"]);
		$sales->Origin_ID->AdvancedSearch->SearchOperator = @$_GET["z_Origin_ID"];

		// Destination_ID
		$sales->Destination_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Destination_ID"]);
		$sales->Destination_ID->AdvancedSearch->SearchOperator = @$_GET["z_Destination_ID"];

		// Customer_ID
		$sales->Customer_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Customer_ID"]);
		$sales->Customer_ID->AdvancedSearch->SearchOperator = @$_GET["z_Customer_ID"];

		// Subcon_ID
		$sales->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Subcon_ID"]);
		$sales->Subcon_ID->AdvancedSearch->SearchOperator = @$_GET["z_Subcon_ID"];

		// Truck_ID
		$sales->Truck_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Truck_ID"]);
		$sales->Truck_ID->AdvancedSearch->SearchOperator = @$_GET["z_Truck_ID"];

		// ETA
		$sales->ETA->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ETA"]);
		$sales->ETA->AdvancedSearch->SearchOperator = @$_GET["z_ETA"];
		$sales->ETA->AdvancedSearch->SearchCondition = @$_GET["v_ETA"];
		$sales->ETA->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_ETA"]);
		$sales->ETA->AdvancedSearch->SearchOperator2 = @$_GET["w_ETA"];

		// ETD
		$sales->ETD->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ETD"]);
		$sales->ETD->AdvancedSearch->SearchOperator = @$_GET["z_ETD"];
		$sales->ETD->AdvancedSearch->SearchCondition = @$_GET["v_ETD"];
		$sales->ETD->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_ETD"]);
		$sales->ETD->AdvancedSearch->SearchOperator2 = @$_GET["w_ETD"];

		// Billing_Type_ID
		$sales->Billing_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Billing_Type_ID"]);
		$sales->Billing_Type_ID->AdvancedSearch->SearchOperator = @$_GET["z_Billing_Type_ID"];

		// Total_Sales
		$sales->Total_Sales->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Sales"]);
		$sales->Total_Sales->AdvancedSearch->SearchOperator = @$_GET["z_Total_Sales"];

		// Wtax
		$sales->Wtax->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Wtax"]);
		$sales->Wtax->AdvancedSearch->SearchOperator = @$_GET["z_Wtax"];

		// Total_Amount_Due
		$sales->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Amount_Due"]);
		$sales->Total_Amount_Due->AdvancedSearch->SearchOperator = @$_GET["z_Total_Amount_Due"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $sales;

		// Call Recordset Selecting event
		$sales->Recordset_Selecting($sales->CurrentFilter);

		// Load List page SQL
		$sSql = $sales->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$sales->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $sales;
		$sFilter = $sales->KeyFilter();

		// Call Row Selecting event
		$sales->Row_Selecting($sFilter);

		// Load SQL based on filter
		$sales->CurrentFilter = $sFilter;
		$sSql = $sales->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$sales->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $sales;
		$sales->Booking_Number->setDbValue($rs->fields('Booking_Number'));
		$sales->Date->setDbValue($rs->fields('Date'));
		$sales->Client_ID->setDbValue($rs->fields('Client_ID'));
		$sales->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$sales->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$sales->Customer_ID->setDbValue($rs->fields('Customer_ID'));
		$sales->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$sales->Truck_ID->setDbValue($rs->fields('Truck_ID'));
		$sales->ETA->setDbValue($rs->fields('ETA'));
		$sales->ETD->setDbValue($rs->fields('ETD'));
		$sales->Billing_Type_ID->setDbValue($rs->fields('Billing_Type_ID'));
		$sales->Total_Sales->setDbValue($rs->fields('Total_Sales'));
		$sales->Wtax->setDbValue($rs->fields('Wtax'));
		$sales->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $sales;

		// Initialize URLs
		$this->ViewUrl = $sales->ViewUrl();
		$this->EditUrl = $sales->EditUrl();
		$this->InlineEditUrl = $sales->InlineEditUrl();
		$this->CopyUrl = $sales->CopyUrl();
		$this->InlineCopyUrl = $sales->InlineCopyUrl();
		$this->DeleteUrl = $sales->DeleteUrl();

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

		// Accumulate aggregate value
		if ($sales->RowType <> EW_ROWTYPE_AGGREGATEINIT && $sales->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($sales->Total_Sales->CurrentValue))
				$sales->Total_Sales->Total += $sales->Total_Sales->CurrentValue; // Accumulate total
			if (is_numeric($sales->Wtax->CurrentValue))
				$sales->Wtax->Total += $sales->Wtax->CurrentValue; // Accumulate total
			if (is_numeric($sales->Total_Amount_Due->CurrentValue))
				$sales->Total_Amount_Due->Total += $sales->Total_Amount_Due->CurrentValue; // Accumulate total
		}
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

			// Total_Sales
			$sales->Total_Sales->EditCustomAttributes = "";
			$sales->Total_Sales->EditValue = ew_HtmlEncode($sales->Total_Sales->AdvancedSearch->SearchValue);

			// Wtax
			$sales->Wtax->EditCustomAttributes = "";
			$sales->Wtax->EditValue = ew_HtmlEncode($sales->Wtax->AdvancedSearch->SearchValue);

			// Total_Amount_Due
			$sales->Total_Amount_Due->EditCustomAttributes = "";
			$sales->Total_Amount_Due->EditValue = ew_HtmlEncode($sales->Total_Amount_Due->AdvancedSearch->SearchValue);
		} elseif ($sales->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$sales->Total_Sales->Total = 0; // Initialize total
			$sales->Wtax->Total = 0; // Initialize total
			$sales->Total_Amount_Due->Total = 0; // Initialize total
		} elseif ($sales->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$sales->Total_Sales->CurrentValue = $sales->Total_Sales->Total;
			$sales->Total_Sales->ViewValue = $sales->Total_Sales->CurrentValue;
			$sales->Total_Sales->ViewValue = ew_FormatNumber($sales->Total_Sales->ViewValue, 2, -2, -2, -2);
			$sales->Total_Sales->CssStyle = "";
			$sales->Total_Sales->CssClass = "";
			$sales->Total_Sales->ViewCustomAttributes = "";
			$sales->Total_Sales->HrefValue = ""; // Clear href value
			$sales->Wtax->CurrentValue = $sales->Wtax->Total;
			$sales->Wtax->ViewValue = $sales->Wtax->CurrentValue;
			$sales->Wtax->ViewValue = ew_FormatNumber($sales->Wtax->ViewValue, 2, -2, -2, -2);
			$sales->Wtax->CssStyle = "";
			$sales->Wtax->CssClass = "";
			$sales->Wtax->ViewCustomAttributes = "";
			$sales->Wtax->HrefValue = ""; // Clear href value
			$sales->Total_Amount_Due->CurrentValue = $sales->Total_Amount_Due->Total;
			$sales->Total_Amount_Due->ViewValue = $sales->Total_Amount_Due->CurrentValue;
			$sales->Total_Amount_Due->ViewValue = ew_FormatNumber($sales->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$sales->Total_Amount_Due->CssStyle = "";
			$sales->Total_Amount_Due->CssClass = "";
			$sales->Total_Amount_Due->ViewCustomAttributes = "";
			$sales->Total_Amount_Due->HrefValue = ""; // Clear href value
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $sales;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $sales->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Initialize aggregates
		$sales->RowType = EW_ROWTYPE_AGGREGATEINIT;
		$this->RenderRow();

		// Export all
		if ($sales->ExportAll) {
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
		if ($sales->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($sales, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($sales->Booking_Number);
				$ExportDoc->ExportCaption($sales->Date);
				$ExportDoc->ExportCaption($sales->Client_ID);
				$ExportDoc->ExportCaption($sales->Origin_ID);
				$ExportDoc->ExportCaption($sales->Destination_ID);
				$ExportDoc->ExportCaption($sales->Customer_ID);
				$ExportDoc->ExportCaption($sales->Subcon_ID);
				$ExportDoc->ExportCaption($sales->Truck_ID);
				$ExportDoc->ExportCaption($sales->ETA);
				$ExportDoc->ExportCaption($sales->ETD);
				$ExportDoc->ExportCaption($sales->Billing_Type_ID);
				$ExportDoc->ExportCaption($sales->Total_Sales);
				$ExportDoc->ExportCaption($sales->Wtax);
				$ExportDoc->ExportCaption($sales->Total_Amount_Due);
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
				$sales->CssClass = "";
				$sales->CssStyle = "";
				$sales->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($sales->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('Booking_Number', $sales->Booking_Number->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Date', $sales->Date->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Client_ID', $sales->Client_ID->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Origin_ID', $sales->Origin_ID->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Destination_ID', $sales->Destination_ID->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Customer_ID', $sales->Customer_ID->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Subcon_ID', $sales->Subcon_ID->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Truck_ID', $sales->Truck_ID->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('ETA', $sales->ETA->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('ETD', $sales->ETD->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Billing_Type_ID', $sales->Billing_Type_ID->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Total_Sales', $sales->Total_Sales->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Wtax', $sales->Wtax->ExportValue($sales->Export, $sales->ExportOriginalValue));
					$XmlDoc->AddField('Total_Amount_Due', $sales->Total_Amount_Due->ExportValue($sales->Export, $sales->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($sales->Booking_Number);
					$ExportDoc->ExportField($sales->Date);
					$ExportDoc->ExportField($sales->Client_ID);
					$ExportDoc->ExportField($sales->Origin_ID);
					$ExportDoc->ExportField($sales->Destination_ID);
					$ExportDoc->ExportField($sales->Customer_ID);
					$ExportDoc->ExportField($sales->Subcon_ID);
					$ExportDoc->ExportField($sales->Truck_ID);
					$ExportDoc->ExportField($sales->ETA);
					$ExportDoc->ExportField($sales->ETD);
					$ExportDoc->ExportField($sales->Billing_Type_ID);
					$ExportDoc->ExportField($sales->Total_Sales);
					$ExportDoc->ExportField($sales->Wtax);
					$ExportDoc->ExportField($sales->Total_Amount_Due);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}

		// Export aggregates (non-XML and horizontal format only)
		if ($sales->Export <> "xml" && $ExportDoc->Horizontal) {
			$sales->RowType = EW_ROWTYPE_AGGREGATE;
			$this->RenderRow();
			$ExportDoc->BeginExportRow();
			$ExportDoc->ExportAggregate($sales->Booking_Number, '');
			$ExportDoc->ExportAggregate($sales->Date, '');
			$ExportDoc->ExportAggregate($sales->Client_ID, '');
			$ExportDoc->ExportAggregate($sales->Origin_ID, '');
			$ExportDoc->ExportAggregate($sales->Destination_ID, '');
			$ExportDoc->ExportAggregate($sales->Customer_ID, '');
			$ExportDoc->ExportAggregate($sales->Subcon_ID, '');
			$ExportDoc->ExportAggregate($sales->Truck_ID, '');
			$ExportDoc->ExportAggregate($sales->ETA, '');
			$ExportDoc->ExportAggregate($sales->ETD, '');
			$ExportDoc->ExportAggregate($sales->Billing_Type_ID, '');
			$ExportDoc->ExportAggregate($sales->Total_Sales, 'TOTAL');
			$ExportDoc->ExportAggregate($sales->Wtax, 'TOTAL');
			$ExportDoc->ExportAggregate($sales->Total_Amount_Due, 'TOTAL');
			$ExportDoc->EndExportRow();
		}
		if ($sales->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($sales->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($sales->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($sales->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($sales->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
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
