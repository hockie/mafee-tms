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
<?php include "invoice_itemsinfo.php" ?>
<?php include "customer_invoicesinfo.php" ?>
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
$invoices_list = new cinvoices_list();
$Page =& $invoices_list;

// Page init
$invoices_list->Page_Init();

// Page main
$invoices_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($invoices->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var invoices_list = new ew_Page("invoices_list");

// page properties
invoices_list.PageID = "list"; // page ID
invoices_list.FormID = "finvoiceslist"; // form ID
var EW_PAGE_ID = invoices_list.PageID; // for backward compatibility

// extend page with validate function for search
invoices_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_Invoice_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Invoice_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Due_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Due_Date->FldErrMsg()) ?>");

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
invoices_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoices_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoices_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoices_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($invoices->Export == "") { ?>
<?php
$gsMasterReturnUrl = "clientslist.php";
if ($invoices_list->sDbMasterFilter <> "" && $invoices->getCurrentMasterTable() == "clients") {
	if ($invoices_list->bMasterRecordExists) {
		if ($invoices->getCurrentMasterTable() == $invoices->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$invoices_list->lTotalRecs = $invoices->SelectRecordCount();
	} else {
		if ($rs = $invoices_list->LoadRecordset())
			$invoices_list->lTotalRecs = $rs->RecordCount();
	}
	$invoices_list->lStartRec = 1;
	if ($invoices_list->lDisplayRecs <= 0 || ($invoices->Export <> "" && $invoices->ExportAll)) // Display all records
		$invoices_list->lDisplayRecs = $invoices_list->lTotalRecs;
	if (!($invoices->Export <> "" && $invoices->ExportAll))
		$invoices_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $invoices_list->LoadRecordset($invoices_list->lStartRec-1, $invoices_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoices->TableCaption() ?>
<?php if ($invoices->Export == "" && $invoices->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $invoices_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $invoices_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $invoices_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($invoices->Export == "" && $invoices->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(invoices_list);" style="text-decoration: none;"><img id="invoices_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="invoices_list_SearchPanel">
<form name="finvoiceslistsrch" id="finvoiceslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return invoices_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="invoices">
<?php
if ($gsSearchError == "")
	$invoices_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$invoices->RowType = EW_ROWTYPE_SEARCH;

// Render row
$invoices_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $invoices->Invoice_Number->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Invoice_Number" id="z_Invoice_Number" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Invoice_Number" id="x_Invoice_Number" title="<?php echo $invoices->Invoice_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $invoices->Invoice_Number->EditValue ?>"<?php echo $invoices->Invoice_Number->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $invoices->Client_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($invoices->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $invoices->Client_ID->ViewAttributes() ?>><?php echo $invoices->Client_ID->ListViewValue() ?></div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($invoices->Client_ID->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
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
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $invoices->Invoice_Date->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Invoice_Date" id="z_Invoice_Date" value="BETWEEN"></span></td>
		<td>			
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
	<tr>
		<td><span class="phpmaker"><?php echo $invoices->Due_Date->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Due_Date" id="z_Due_Date" value="BETWEEN"></span></td>
		<td>			
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
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($invoices->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $invoices_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="invoicessrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($invoices->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($invoices->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($invoices->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoices_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($invoices->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($invoices->CurrentAction <> "gridadd" && $invoices->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($invoices_list->Pager)) $invoices_list->Pager = new cPrevNextPager($invoices_list->lStartRec, $invoices_list->lDisplayRecs, $invoices_list->lTotalRecs) ?>
<?php if ($invoices_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($invoices_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $invoices_list->PageUrl() ?>start=<?php echo $invoices_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($invoices_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $invoices_list->PageUrl() ?>start=<?php echo $invoices_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $invoices_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($invoices_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $invoices_list->PageUrl() ?>start=<?php echo $invoices_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($invoices_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $invoices_list->PageUrl() ?>start=<?php echo $invoices_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $invoices_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $invoices_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $invoices_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $invoices_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($invoices_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($invoices_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="invoices">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($invoices_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($invoices_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($invoices_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($invoices_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($invoices_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($invoices_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($invoices->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $invoices_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($invoices_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.finvoiceslist, '<?php echo $invoices_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="finvoiceslist" id="finvoiceslist" class="ewForm" action="" method="post">
<div id="gmp_invoices" class="ewGridMiddlePanel">
<?php if ($invoices_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $invoices->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$invoices_list->RenderListOptions();

// Render list options (header, left)
$invoices_list->ListOptions->Render("header", "left");
?>
<?php if ($invoices->id->Visible) { // id ?>
	<?php if ($invoices->SortUrl($invoices->id) == "") { ?>
		<td><?php echo $invoices->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Invoice_Number->Visible) { // Invoice_Number ?>
	<?php if ($invoices->SortUrl($invoices->Invoice_Number) == "") { ?>
		<td><?php echo $invoices->Invoice_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Invoice_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Invoice_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($invoices->Invoice_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Invoice_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Client_ID->Visible) { // Client_ID ?>
	<?php if ($invoices->SortUrl($invoices->Client_ID) == "") { ?>
		<td><?php echo $invoices->Client_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Client_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Client_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Client_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Client_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Invoice_Date->Visible) { // Invoice_Date ?>
	<?php if ($invoices->SortUrl($invoices->Invoice_Date) == "") { ?>
		<td><?php echo $invoices->Invoice_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Invoice_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Invoice_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Invoice_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Invoice_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Due_Date->Visible) { // Due_Date ?>
	<?php if ($invoices->SortUrl($invoices->Due_Date) == "") { ?>
		<td><?php echo $invoices->Due_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Due_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Due_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Due_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Due_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->payment_period->Visible) { // payment_period ?>
	<?php if ($invoices->SortUrl($invoices->payment_period) == "") { ?>
		<td><?php echo $invoices->payment_period->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->payment_period) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->payment_period->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->payment_period->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->payment_period->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Total_Vat->Visible) { // Total_Vat ?>
	<?php if ($invoices->SortUrl($invoices->Total_Vat) == "") { ?>
		<td><?php echo $invoices->Total_Vat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Total_Vat) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Total_Vat->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Total_Vat->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Total_Vat->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Total_WTax->Visible) { // Total_WTax ?>
	<?php if ($invoices->SortUrl($invoices->Total_WTax) == "") { ?>
		<td><?php echo $invoices->Total_WTax->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Total_WTax) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Total_WTax->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Total_WTax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Total_WTax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Total_Freight->Visible) { // Total_Freight ?>
	<?php if ($invoices->SortUrl($invoices->Total_Freight) == "") { ?>
		<td><?php echo $invoices->Total_Freight->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Total_Freight) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Total_Freight->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Total_Freight->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Total_Freight->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<?php if ($invoices->SortUrl($invoices->Total_Amount_Due) == "") { ?>
		<td><?php echo $invoices->Total_Amount_Due->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Total_Amount_Due) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Total_Amount_Due->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Total_Amount_Due->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Total_Amount_Due->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Payment_Reference->Visible) { // Payment_Reference ?>
	<?php if ($invoices->SortUrl($invoices->Payment_Reference) == "") { ?>
		<td><?php echo $invoices->Payment_Reference->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Payment_Reference) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Payment_Reference->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($invoices->Payment_Reference->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Payment_Reference->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Payment_Status->Visible) { // Payment_Status ?>
	<?php if ($invoices->SortUrl($invoices->Payment_Status) == "") { ?>
		<td><?php echo $invoices->Payment_Status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Payment_Status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Payment_Status->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Payment_Status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Payment_Status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Status->Visible) { // Status ?>
	<?php if ($invoices->SortUrl($invoices->Status) == "") { ?>
		<td><?php echo $invoices->Status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Status->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Recipient_Bank->Visible) { // Recipient_Bank ?>
	<?php if ($invoices->SortUrl($invoices->Recipient_Bank) == "") { ?>
		<td><?php echo $invoices->Recipient_Bank->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Recipient_Bank) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Recipient_Bank->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->Recipient_Bank->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Recipient_Bank->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->Remarks->Visible) { // Remarks ?>
	<?php if ($invoices->SortUrl($invoices->Remarks) == "") { ?>
		<td><?php echo $invoices->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($invoices->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->User_ID->Visible) { // User_ID ?>
	<?php if ($invoices->SortUrl($invoices->User_ID) == "") { ?>
		<td><?php echo $invoices->User_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->User_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->User_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->User_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->User_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->created->Visible) { // created ?>
	<?php if ($invoices->SortUrl($invoices->created) == "") { ?>
		<td><?php echo $invoices->created->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->created) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->created->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->created->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->created->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoices->modified->Visible) { // modified ?>
	<?php if ($invoices->SortUrl($invoices->modified) == "") { ?>
		<td><?php echo $invoices->modified->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoices->SortUrl($invoices->modified) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoices->modified->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoices->modified->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoices->modified->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$invoices_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($invoices->ExportAll && $invoices->Export <> "") {
	$invoices_list->lStopRec = $invoices_list->lTotalRecs;
} else {
	$invoices_list->lStopRec = $invoices_list->lStartRec + $invoices_list->lDisplayRecs - 1; // Set the last record to display
}
$invoices_list->lRecCount = $invoices_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $invoices_list->lStartRec > 1)
		$rs->Move($invoices_list->lStartRec - 1);
}

// Initialize aggregate
$invoices->RowType = EW_ROWTYPE_AGGREGATEINIT;
$invoices_list->RenderRow();
$invoices_list->lRowCnt = 0;
while (($invoices->CurrentAction == "gridadd" || !$rs->EOF) &&
	$invoices_list->lRecCount < $invoices_list->lStopRec) {
	$invoices_list->lRecCount++;
	if (intval($invoices_list->lRecCount) >= intval($invoices_list->lStartRec)) {
		$invoices_list->lRowCnt++;

	// Init row class and style
	$invoices->CssClass = "";
	$invoices->CssStyle = "";
	$invoices->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($invoices->CurrentAction == "gridadd") {
		$invoices_list->LoadDefaultValues(); // Load default values
	} else {
		$invoices_list->LoadRowValues($rs); // Load row values
	}
	$invoices->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$invoices_list->RenderRow();

	// Render list options
	$invoices_list->RenderListOptions();
?>
	<tr<?php echo $invoices->RowAttributes() ?>>
<?php

// Render list options (body, left)
$invoices_list->ListOptions->Render("body", "left");
?>
	<?php if ($invoices->id->Visible) { // id ?>
		<td<?php echo $invoices->id->CellAttributes() ?>>
<div<?php echo $invoices->id->ViewAttributes() ?>><?php echo $invoices->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Invoice_Number->Visible) { // Invoice_Number ?>
		<td<?php echo $invoices->Invoice_Number->CellAttributes() ?>>
<div<?php echo $invoices->Invoice_Number->ViewAttributes() ?>><?php echo $invoices->Invoice_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Client_ID->Visible) { // Client_ID ?>
		<td<?php echo $invoices->Client_ID->CellAttributes() ?>>
<div<?php echo $invoices->Client_ID->ViewAttributes() ?>><?php echo $invoices->Client_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Invoice_Date->Visible) { // Invoice_Date ?>
		<td<?php echo $invoices->Invoice_Date->CellAttributes() ?>>
<div<?php echo $invoices->Invoice_Date->ViewAttributes() ?>><?php echo $invoices->Invoice_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Due_Date->Visible) { // Due_Date ?>
		<td<?php echo $invoices->Due_Date->CellAttributes() ?>>
<div<?php echo $invoices->Due_Date->ViewAttributes() ?>><?php echo $invoices->Due_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->payment_period->Visible) { // payment_period ?>
		<td<?php echo $invoices->payment_period->CellAttributes() ?>>
<div<?php echo $invoices->payment_period->ViewAttributes() ?>><?php echo $invoices->payment_period->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Total_Vat->Visible) { // Total_Vat ?>
		<td<?php echo $invoices->Total_Vat->CellAttributes() ?>>
<div<?php echo $invoices->Total_Vat->ViewAttributes() ?>><?php echo $invoices->Total_Vat->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Total_WTax->Visible) { // Total_WTax ?>
		<td<?php echo $invoices->Total_WTax->CellAttributes() ?>>
<div<?php echo $invoices->Total_WTax->ViewAttributes() ?>><?php echo $invoices->Total_WTax->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Total_Freight->Visible) { // Total_Freight ?>
		<td<?php echo $invoices->Total_Freight->CellAttributes() ?>>
<div<?php echo $invoices->Total_Freight->ViewAttributes() ?>><?php echo $invoices->Total_Freight->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td<?php echo $invoices->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $invoices->Total_Amount_Due->ViewAttributes() ?>><?php echo $invoices->Total_Amount_Due->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Payment_Reference->Visible) { // Payment_Reference ?>
		<td<?php echo $invoices->Payment_Reference->CellAttributes() ?>>
<div<?php echo $invoices->Payment_Reference->ViewAttributes() ?>><?php echo $invoices->Payment_Reference->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Payment_Status->Visible) { // Payment_Status ?>
		<td<?php echo $invoices->Payment_Status->CellAttributes() ?>>
<div<?php echo $invoices->Payment_Status->ViewAttributes() ?>><?php echo $invoices->Payment_Status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Status->Visible) { // Status ?>
		<td<?php echo $invoices->Status->CellAttributes() ?>>
<div<?php echo $invoices->Status->ViewAttributes() ?>><?php echo $invoices->Status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Recipient_Bank->Visible) { // Recipient_Bank ?>
		<td<?php echo $invoices->Recipient_Bank->CellAttributes() ?>>
<div<?php echo $invoices->Recipient_Bank->ViewAttributes() ?>><?php echo $invoices->Recipient_Bank->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->Remarks->Visible) { // Remarks ?>
		<td<?php echo $invoices->Remarks->CellAttributes() ?>>
<div<?php echo $invoices->Remarks->ViewAttributes() ?>><?php echo $invoices->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->User_ID->Visible) { // User_ID ?>
		<td<?php echo $invoices->User_ID->CellAttributes() ?>>
<div<?php echo $invoices->User_ID->ViewAttributes() ?>><?php echo $invoices->User_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->created->Visible) { // created ?>
		<td<?php echo $invoices->created->CellAttributes() ?>>
<div<?php echo $invoices->created->ViewAttributes() ?>><?php echo $invoices->created->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoices->modified->Visible) { // modified ?>
		<td<?php echo $invoices->modified->CellAttributes() ?>>
<div<?php echo $invoices->modified->ViewAttributes() ?>><?php echo $invoices->modified->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$invoices_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($invoices->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$invoices->RowType = EW_ROWTYPE_AGGREGATE;
$invoices_list->RenderRow();
?>
<?php if ($invoices_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$invoices_list->RenderListOptions();

// Render list options (footer, left)
$invoices_list->ListOptions->Render("footer", "left");
?>
	<?php if ($invoices->id->Visible) { // id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Invoice_Number->Visible) { // Invoice_Number ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Client_ID->Visible) { // Client_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Invoice_Date->Visible) { // Invoice_Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Due_Date->Visible) { // Due_Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->payment_period->Visible) { // payment_period ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Total_Vat->Visible) { // Total_Vat ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $invoices->Total_Vat->ViewAttributes() ?>><?php echo $invoices->Total_Vat->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($invoices->Total_WTax->Visible) { // Total_WTax ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $invoices->Total_WTax->ViewAttributes() ?>><?php echo $invoices->Total_WTax->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($invoices->Total_Freight->Visible) { // Total_Freight ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $invoices->Total_Freight->ViewAttributes() ?>><?php echo $invoices->Total_Freight->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $invoices->Total_Amount_Due->ViewAttributes() ?>><?php echo $invoices->Total_Amount_Due->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($invoices->Payment_Reference->Visible) { // Payment_Reference ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Payment_Status->Visible) { // Payment_Status ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Status->Visible) { // Status ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Recipient_Bank->Visible) { // Recipient_Bank ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->Remarks->Visible) { // Remarks ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->User_ID->Visible) { // User_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->created->Visible) { // created ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($invoices->modified->Visible) { // modified ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$invoices_list->ListOptions->Render("footer", "right");
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
<?php if ($invoices_list->lTotalRecs > 0) { ?>
<?php if ($invoices->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($invoices->CurrentAction <> "gridadd" && $invoices->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($invoices_list->Pager)) $invoices_list->Pager = new cPrevNextPager($invoices_list->lStartRec, $invoices_list->lDisplayRecs, $invoices_list->lTotalRecs) ?>
<?php if ($invoices_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($invoices_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $invoices_list->PageUrl() ?>start=<?php echo $invoices_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($invoices_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $invoices_list->PageUrl() ?>start=<?php echo $invoices_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $invoices_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($invoices_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $invoices_list->PageUrl() ?>start=<?php echo $invoices_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($invoices_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $invoices_list->PageUrl() ?>start=<?php echo $invoices_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $invoices_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $invoices_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $invoices_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $invoices_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($invoices_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($invoices_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="invoices">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($invoices_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($invoices_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($invoices_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($invoices_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($invoices_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($invoices_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($invoices->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($invoices_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $invoices_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($invoices_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.finvoiceslist, '<?php echo $invoices_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($invoices->Export == "" && $invoices->CurrentAction == "") { ?>
<?php } ?>
<?php if ($invoices->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$invoices_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoices_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'invoices';

	// Page object name
	var $PageObjName = 'invoices_list';

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
	function cinvoices_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (invoices)
		$GLOBALS["invoices"] = new cinvoices();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["invoices"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "invoicesdelete.php";
		$this->MultiUpdateUrl = "invoicesupdate.php";

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoice_items)
		$GLOBALS['invoice_items'] = new cinvoice_items();

		// Table object (customer_invoices)
		$GLOBALS['customer_invoices'] = new ccustomer_invoices();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'invoices', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$invoices->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$invoices->Export = $_POST["exporttype"];
		} else {
			$invoices->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $invoices->Export; // Get export parameter, used in header
		$gsExportFile = $invoices->TableVar; // Get export file, used in header
		if ($invoices->Export == "excel") {
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
	var $linvoice_items_Count;
	var $lcustomer_invoices_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $invoices;

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
			$invoices->Recordset_SearchValidated();

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
		if ($invoices->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $invoices->getRecordsPerPage(); // Restore from Session
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
		$invoices->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$invoices->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$invoices->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $invoices->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $invoices->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $invoices->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($invoices->getMasterFilter() <> "" && $invoices->getCurrentMasterTable() == "clients") {
			global $clients;
			$rsmaster = $clients->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$invoices->setMasterFilter(""); // Clear master filter
				$invoices->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($invoices->getReturnUrl()); // Return to caller
			} else {
				$clients->LoadListRowValues($rsmaster);
				$clients->RowType = EW_ROWTYPE_MASTER; // Master row
				$clients->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$invoices->setSessionWhere($sFilter);
		$invoices->CurrentFilter = "";

		// Export data only
		if (in_array($invoices->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($invoices->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $invoices;
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
			$invoices->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$invoices->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $invoices;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $invoices->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $invoices->Invoice_Number, FALSE); // Invoice_Number
		$this->BuildSearchSql($sWhere, $invoices->Client_ID, FALSE); // Client_ID
		$this->BuildSearchSql($sWhere, $invoices->Invoice_Date, FALSE); // Invoice_Date
		$this->BuildSearchSql($sWhere, $invoices->Due_Date, FALSE); // Due_Date
		$this->BuildSearchSql($sWhere, $invoices->payment_period, FALSE); // payment_period
		$this->BuildSearchSql($sWhere, $invoices->Total_Vat, FALSE); // Total_Vat
		$this->BuildSearchSql($sWhere, $invoices->Total_WTax, FALSE); // Total_WTax
		$this->BuildSearchSql($sWhere, $invoices->Total_Freight, FALSE); // Total_Freight
		$this->BuildSearchSql($sWhere, $invoices->Total_Amount_Due, FALSE); // Total_Amount_Due
		$this->BuildSearchSql($sWhere, $invoices->Payment_Reference, FALSE); // Payment_Reference
		$this->BuildSearchSql($sWhere, $invoices->Payment_Status, FALSE); // Payment_Status
		$this->BuildSearchSql($sWhere, $invoices->Status, FALSE); // Status
		$this->BuildSearchSql($sWhere, $invoices->Recipient_Bank, FALSE); // Recipient_Bank
		$this->BuildSearchSql($sWhere, $invoices->Remarks, FALSE); // Remarks
		$this->BuildSearchSql($sWhere, $invoices->User_ID, FALSE); // User_ID
		$this->BuildSearchSql($sWhere, $invoices->created, FALSE); // created
		$this->BuildSearchSql($sWhere, $invoices->modified, FALSE); // modified

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($invoices->id); // id
			$this->SetSearchParm($invoices->Invoice_Number); // Invoice_Number
			$this->SetSearchParm($invoices->Client_ID); // Client_ID
			$this->SetSearchParm($invoices->Invoice_Date); // Invoice_Date
			$this->SetSearchParm($invoices->Due_Date); // Due_Date
			$this->SetSearchParm($invoices->payment_period); // payment_period
			$this->SetSearchParm($invoices->Total_Vat); // Total_Vat
			$this->SetSearchParm($invoices->Total_WTax); // Total_WTax
			$this->SetSearchParm($invoices->Total_Freight); // Total_Freight
			$this->SetSearchParm($invoices->Total_Amount_Due); // Total_Amount_Due
			$this->SetSearchParm($invoices->Payment_Reference); // Payment_Reference
			$this->SetSearchParm($invoices->Payment_Status); // Payment_Status
			$this->SetSearchParm($invoices->Status); // Status
			$this->SetSearchParm($invoices->Recipient_Bank); // Recipient_Bank
			$this->SetSearchParm($invoices->Remarks); // Remarks
			$this->SetSearchParm($invoices->User_ID); // User_ID
			$this->SetSearchParm($invoices->created); // created
			$this->SetSearchParm($invoices->modified); // modified
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
		global $invoices;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$invoices->setAdvancedSearch("x_$FldParm", $FldVal);
		$invoices->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$invoices->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$invoices->setAdvancedSearch("y_$FldParm", $FldVal2);
		$invoices->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $invoices;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $invoices->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $invoices->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $invoices->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $invoices->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $invoices->GetAdvancedSearch("w_$FldParm");
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
		global $invoices;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $invoices->Invoice_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $invoices->Payment_Reference, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $invoices->Remarks, $Keyword);
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
		global $Security, $invoices;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $invoices->BasicSearchKeyword;
		$sSearchType = $invoices->BasicSearchType;
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
			$invoices->setSessionBasicSearchKeyword($sSearchKeyword);
			$invoices->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $invoices;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$invoices->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $invoices;
		$invoices->setSessionBasicSearchKeyword("");
		$invoices->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $invoices;
		$invoices->setAdvancedSearch("x_id", "");
		$invoices->setAdvancedSearch("x_Invoice_Number", "");
		$invoices->setAdvancedSearch("x_Client_ID", "");
		$invoices->setAdvancedSearch("x_Invoice_Date", "");
		$invoices->setAdvancedSearch("y_Invoice_Date", "");
		$invoices->setAdvancedSearch("x_Due_Date", "");
		$invoices->setAdvancedSearch("y_Due_Date", "");
		$invoices->setAdvancedSearch("x_payment_period", "");
		$invoices->setAdvancedSearch("x_Total_Vat", "");
		$invoices->setAdvancedSearch("x_Total_WTax", "");
		$invoices->setAdvancedSearch("x_Total_Freight", "");
		$invoices->setAdvancedSearch("x_Total_Amount_Due", "");
		$invoices->setAdvancedSearch("x_Payment_Reference", "");
		$invoices->setAdvancedSearch("x_Payment_Status", "");
		$invoices->setAdvancedSearch("x_Status", "");
		$invoices->setAdvancedSearch("x_Recipient_Bank", "");
		$invoices->setAdvancedSearch("x_Remarks", "");
		$invoices->setAdvancedSearch("x_User_ID", "");
		$invoices->setAdvancedSearch("x_created", "");
		$invoices->setAdvancedSearch("x_modified", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $invoices;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Invoice_Number"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Client_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Invoice_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["y_Invoice_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Due_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["y_Due_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_payment_period"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Vat"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_WTax"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Freight"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Total_Amount_Due"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Payment_Reference"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Payment_Status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Status"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Recipient_Bank"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		if (@$_GET["x_User_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_created"] <> "") $bRestore = FALSE;
		if (@$_GET["x_modified"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$invoices->BasicSearchKeyword = $invoices->getSessionBasicSearchKeyword();
			$invoices->BasicSearchType = $invoices->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($invoices->id);
			$this->GetSearchParm($invoices->Invoice_Number);
			$this->GetSearchParm($invoices->Client_ID);
			$this->GetSearchParm($invoices->Invoice_Date);
			$this->GetSearchParm($invoices->Due_Date);
			$this->GetSearchParm($invoices->payment_period);
			$this->GetSearchParm($invoices->Total_Vat);
			$this->GetSearchParm($invoices->Total_WTax);
			$this->GetSearchParm($invoices->Total_Freight);
			$this->GetSearchParm($invoices->Total_Amount_Due);
			$this->GetSearchParm($invoices->Payment_Reference);
			$this->GetSearchParm($invoices->Payment_Status);
			$this->GetSearchParm($invoices->Status);
			$this->GetSearchParm($invoices->Recipient_Bank);
			$this->GetSearchParm($invoices->Remarks);
			$this->GetSearchParm($invoices->User_ID);
			$this->GetSearchParm($invoices->created);
			$this->GetSearchParm($invoices->modified);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $invoices;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$invoices->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$invoices->CurrentOrderType = @$_GET["ordertype"];
			$invoices->UpdateSort($invoices->id); // id
			$invoices->UpdateSort($invoices->Invoice_Number); // Invoice_Number
			$invoices->UpdateSort($invoices->Client_ID); // Client_ID
			$invoices->UpdateSort($invoices->Invoice_Date); // Invoice_Date
			$invoices->UpdateSort($invoices->Due_Date); // Due_Date
			$invoices->UpdateSort($invoices->payment_period); // payment_period
			$invoices->UpdateSort($invoices->Total_Vat); // Total_Vat
			$invoices->UpdateSort($invoices->Total_WTax); // Total_WTax
			$invoices->UpdateSort($invoices->Total_Freight); // Total_Freight
			$invoices->UpdateSort($invoices->Total_Amount_Due); // Total_Amount_Due
			$invoices->UpdateSort($invoices->Payment_Reference); // Payment_Reference
			$invoices->UpdateSort($invoices->Payment_Status); // Payment_Status
			$invoices->UpdateSort($invoices->Status); // Status
			$invoices->UpdateSort($invoices->Recipient_Bank); // Recipient_Bank
			$invoices->UpdateSort($invoices->Remarks); // Remarks
			$invoices->UpdateSort($invoices->User_ID); // User_ID
			$invoices->UpdateSort($invoices->created); // created
			$invoices->UpdateSort($invoices->modified); // modified
			$invoices->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $invoices;
		$sOrderBy = $invoices->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($invoices->SqlOrderBy() <> "") {
				$sOrderBy = $invoices->SqlOrderBy();
				$invoices->setSessionOrderBy($sOrderBy);
				$invoices->Invoice_Number->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $invoices;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$invoices->getCurrentMasterTable = ""; // Clear master table
				$invoices->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$invoices->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$invoices->Client_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$invoices->setSessionOrderBy($sOrderBy);
				$invoices->id->setSort("");
				$invoices->Invoice_Number->setSort("");
				$invoices->Client_ID->setSort("");
				$invoices->Invoice_Date->setSort("");
				$invoices->Due_Date->setSort("");
				$invoices->payment_period->setSort("");
				$invoices->Total_Vat->setSort("");
				$invoices->Total_WTax->setSort("");
				$invoices->Total_Freight->setSort("");
				$invoices->Total_Amount_Due->setSort("");
				$invoices->Payment_Reference->setSort("");
				$invoices->Payment_Status->setSort("");
				$invoices->Status->setSort("");
				$invoices->Recipient_Bank->setSort("");
				$invoices->Remarks->setSort("");
				$invoices->User_ID->setSort("");
				$invoices->created->setSort("");
				$invoices->modified->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$invoices->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $invoices;

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

		// "detail_invoice_items"
		$this->ListOptions->Add("detail_invoice_items");
		$item =& $this->ListOptions->Items["detail_invoice_items"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('invoice_items');
		$item->OnLeft = FALSE;

		// "detail_customer_invoices"
		$this->ListOptions->Add("detail_customer_invoices");
		$item =& $this->ListOptions->Items["detail_customer_invoices"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('customer_invoices');
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"invoices_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($invoices->Export <> "" ||
			$invoices->CurrentAction == "gridadd" ||
			$invoices->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $invoices;
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

		// "detail_invoice_items"
		$oListOpt =& $this->ListOptions->Items["detail_invoice_items"];
		if ($Security->AllowList('invoice_items')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("invoice_items", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->linvoice_items_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"invoice_itemslist.php?" . EW_TABLE_SHOW_MASTER . "=invoices&id=" . urlencode(strval($invoices->id->CurrentValue)) . "&Client_ID=" . urlencode(strval($invoices->Client_ID->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_customer_invoices"
		$oListOpt =& $this->ListOptions->Items["detail_customer_invoices"];
		if ($Security->AllowList('customer_invoices')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("customer_invoices", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lcustomer_invoices_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"customer_invoiceslist.php?" . EW_TABLE_SHOW_MASTER . "=invoices&id=" . urlencode(strval($invoices->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($invoices->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $invoices;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $invoices;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$invoices->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$invoices->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $invoices->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$invoices->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$invoices->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$invoices->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $invoices;
		$invoices->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$invoices->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $invoices;

		// Load search values
		// id

		$invoices->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$invoices->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Invoice_Number
		$invoices->Invoice_Number->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Invoice_Number"]);
		$invoices->Invoice_Number->AdvancedSearch->SearchOperator = @$_GET["z_Invoice_Number"];

		// Client_ID
		$invoices->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Client_ID"]);
		$invoices->Client_ID->AdvancedSearch->SearchOperator = @$_GET["z_Client_ID"];

		// Invoice_Date
		$invoices->Invoice_Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Invoice_Date"]);
		$invoices->Invoice_Date->AdvancedSearch->SearchOperator = @$_GET["z_Invoice_Date"];
		$invoices->Invoice_Date->AdvancedSearch->SearchCondition = @$_GET["v_Invoice_Date"];
		$invoices->Invoice_Date->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_Invoice_Date"]);
		$invoices->Invoice_Date->AdvancedSearch->SearchOperator2 = @$_GET["w_Invoice_Date"];

		// Due_Date
		$invoices->Due_Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Due_Date"]);
		$invoices->Due_Date->AdvancedSearch->SearchOperator = @$_GET["z_Due_Date"];
		$invoices->Due_Date->AdvancedSearch->SearchCondition = @$_GET["v_Due_Date"];
		$invoices->Due_Date->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_Due_Date"]);
		$invoices->Due_Date->AdvancedSearch->SearchOperator2 = @$_GET["w_Due_Date"];

		// payment_period
		$invoices->payment_period->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_payment_period"]);
		$invoices->payment_period->AdvancedSearch->SearchOperator = @$_GET["z_payment_period"];

		// Total_Vat
		$invoices->Total_Vat->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Vat"]);
		$invoices->Total_Vat->AdvancedSearch->SearchOperator = @$_GET["z_Total_Vat"];

		// Total_WTax
		$invoices->Total_WTax->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_WTax"]);
		$invoices->Total_WTax->AdvancedSearch->SearchOperator = @$_GET["z_Total_WTax"];

		// Total_Freight
		$invoices->Total_Freight->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Freight"]);
		$invoices->Total_Freight->AdvancedSearch->SearchOperator = @$_GET["z_Total_Freight"];

		// Total_Amount_Due
		$invoices->Total_Amount_Due->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Total_Amount_Due"]);
		$invoices->Total_Amount_Due->AdvancedSearch->SearchOperator = @$_GET["z_Total_Amount_Due"];

		// Payment_Reference
		$invoices->Payment_Reference->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Payment_Reference"]);
		$invoices->Payment_Reference->AdvancedSearch->SearchOperator = @$_GET["z_Payment_Reference"];

		// Payment_Status
		$invoices->Payment_Status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Payment_Status"]);
		$invoices->Payment_Status->AdvancedSearch->SearchOperator = @$_GET["z_Payment_Status"];

		// Status
		$invoices->Status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Status"]);
		$invoices->Status->AdvancedSearch->SearchOperator = @$_GET["z_Status"];

		// Recipient_Bank
		$invoices->Recipient_Bank->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Recipient_Bank"]);
		$invoices->Recipient_Bank->AdvancedSearch->SearchOperator = @$_GET["z_Recipient_Bank"];

		// Remarks
		$invoices->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$invoices->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];

		// User_ID
		$invoices->User_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_User_ID"]);
		$invoices->User_ID->AdvancedSearch->SearchOperator = @$_GET["z_User_ID"];

		// created
		$invoices->created->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_created"]);
		$invoices->created->AdvancedSearch->SearchOperator = @$_GET["z_created"];

		// modified
		$invoices->modified->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_modified"]);
		$invoices->modified->AdvancedSearch->SearchOperator = @$_GET["z_modified"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $invoices;

		// Call Recordset Selecting event
		$invoices->Recordset_Selecting($invoices->CurrentFilter);

		// Load List page SQL
		$sSql = $invoices->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$invoices->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $invoices;
		$sFilter = $invoices->KeyFilter();

		// Call Row Selecting event
		$invoices->Row_Selecting($sFilter);

		// Load SQL based on filter
		$invoices->CurrentFilter = $sFilter;
		$sSql = $invoices->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$invoices->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $invoices;
		$invoices->id->setDbValue($rs->fields('id'));
		$invoices->Invoice_Number->setDbValue($rs->fields('Invoice_Number'));
		$invoices->Client_ID->setDbValue($rs->fields('Client_ID'));
		$invoices->Invoice_Date->setDbValue($rs->fields('Invoice_Date'));
		$invoices->Due_Date->setDbValue($rs->fields('Due_Date'));
		$invoices->payment_period->setDbValue($rs->fields('payment_period'));
		$invoices->Total_Vat->setDbValue($rs->fields('Total_Vat'));
		$invoices->Total_WTax->setDbValue($rs->fields('Total_WTax'));
		$invoices->Total_Freight->setDbValue($rs->fields('Total_Freight'));
		$invoices->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$invoices->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$invoices->Payment_Status->setDbValue($rs->fields('Payment_Status'));
		$invoices->Status->setDbValue($rs->fields('Status'));
		$invoices->Recipient_Bank->setDbValue($rs->fields('Recipient_Bank'));
		$invoices->Remarks->setDbValue($rs->fields('Remarks'));
		$invoices->User_ID->setDbValue($rs->fields('User_ID'));
		$invoices->created->setDbValue($rs->fields('created'));
		$invoices->modified->setDbValue($rs->fields('modified'));
		$sDetailFilter = $GLOBALS["invoice_items"]->SqlDetailFilter_invoices();
		$sDetailFilter = str_replace("@invoice_id@", ew_AdjustSql($invoices->id->DbValue), $sDetailFilter);
		$sDetailFilter = str_replace("@client_id@", ew_AdjustSql($invoices->Client_ID->DbValue), $sDetailFilter);
		$this->linvoice_items_Count = $GLOBALS["invoice_items"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["customer_invoices"]->SqlDetailFilter_invoices();
		$sDetailFilter = str_replace("@Invoice_ID@", ew_AdjustSql($invoices->id->DbValue), $sDetailFilter);
		$this->lcustomer_invoices_Count = $GLOBALS["customer_invoices"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $invoices;

		// Initialize URLs
		$this->ViewUrl = $invoices->ViewUrl();
		$this->EditUrl = $invoices->EditUrl();
		$this->InlineEditUrl = $invoices->InlineEditUrl();
		$this->CopyUrl = $invoices->CopyUrl();
		$this->InlineCopyUrl = $invoices->InlineCopyUrl();
		$this->DeleteUrl = $invoices->DeleteUrl();

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

		// Accumulate aggregate value
		if ($invoices->RowType <> EW_ROWTYPE_AGGREGATEINIT && $invoices->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($invoices->Total_Vat->CurrentValue))
				$invoices->Total_Vat->Total += $invoices->Total_Vat->CurrentValue; // Accumulate total
			if (is_numeric($invoices->Total_WTax->CurrentValue))
				$invoices->Total_WTax->Total += $invoices->Total_WTax->CurrentValue; // Accumulate total
			if (is_numeric($invoices->Total_Freight->CurrentValue))
				$invoices->Total_Freight->Total += $invoices->Total_Freight->CurrentValue; // Accumulate total
			if (is_numeric($invoices->Total_Amount_Due->CurrentValue))
				$invoices->Total_Amount_Due->Total += $invoices->Total_Amount_Due->CurrentValue; // Accumulate total
		}
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

			// Status
			$invoices->Status->EditCustomAttributes = "";

			// Recipient_Bank
			$invoices->Recipient_Bank->EditCustomAttributes = "";

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
		} elseif ($invoices->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$invoices->Total_Vat->Total = 0; // Initialize total
			$invoices->Total_WTax->Total = 0; // Initialize total
			$invoices->Total_Freight->Total = 0; // Initialize total
			$invoices->Total_Amount_Due->Total = 0; // Initialize total
		} elseif ($invoices->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$invoices->Total_Vat->CurrentValue = $invoices->Total_Vat->Total;
			$invoices->Total_Vat->ViewValue = $invoices->Total_Vat->CurrentValue;
			$invoices->Total_Vat->ViewValue = ew_FormatNumber($invoices->Total_Vat->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Vat->CssStyle = "";
			$invoices->Total_Vat->CssClass = "";
			$invoices->Total_Vat->ViewCustomAttributes = "";
			$invoices->Total_Vat->HrefValue = ""; // Clear href value
			$invoices->Total_WTax->CurrentValue = $invoices->Total_WTax->Total;
			$invoices->Total_WTax->ViewValue = $invoices->Total_WTax->CurrentValue;
			$invoices->Total_WTax->ViewValue = ew_FormatNumber($invoices->Total_WTax->ViewValue, 2, -2, -2, -2);
			$invoices->Total_WTax->CssStyle = "";
			$invoices->Total_WTax->CssClass = "";
			$invoices->Total_WTax->ViewCustomAttributes = "";
			$invoices->Total_WTax->HrefValue = ""; // Clear href value
			$invoices->Total_Freight->CurrentValue = $invoices->Total_Freight->Total;
			$invoices->Total_Freight->ViewValue = $invoices->Total_Freight->CurrentValue;
			$invoices->Total_Freight->ViewValue = ew_FormatNumber($invoices->Total_Freight->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Freight->CssStyle = "";
			$invoices->Total_Freight->CssClass = "";
			$invoices->Total_Freight->ViewCustomAttributes = "";
			$invoices->Total_Freight->HrefValue = ""; // Clear href value
			$invoices->Total_Amount_Due->CurrentValue = $invoices->Total_Amount_Due->Total;
			$invoices->Total_Amount_Due->ViewValue = $invoices->Total_Amount_Due->CurrentValue;
			$invoices->Total_Amount_Due->ViewValue = ew_FormatNumber($invoices->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Amount_Due->CssStyle = "";
			$invoices->Total_Amount_Due->CssClass = "";
			$invoices->Total_Amount_Due->ViewCustomAttributes = "";
			$invoices->Total_Amount_Due->HrefValue = ""; // Clear href value
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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $invoices;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $invoices->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Initialize aggregates
		$invoices->RowType = EW_ROWTYPE_AGGREGATEINIT;
		$this->RenderRow();

		// Export all
		if ($invoices->ExportAll) {
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
		if ($invoices->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($invoices, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($invoices->id);
				$ExportDoc->ExportCaption($invoices->Invoice_Number);
				$ExportDoc->ExportCaption($invoices->Client_ID);
				$ExportDoc->ExportCaption($invoices->Invoice_Date);
				$ExportDoc->ExportCaption($invoices->Due_Date);
				$ExportDoc->ExportCaption($invoices->payment_period);
				$ExportDoc->ExportCaption($invoices->Total_Vat);
				$ExportDoc->ExportCaption($invoices->Total_WTax);
				$ExportDoc->ExportCaption($invoices->Total_Freight);
				$ExportDoc->ExportCaption($invoices->Total_Amount_Due);
				$ExportDoc->ExportCaption($invoices->Payment_Reference);
				$ExportDoc->ExportCaption($invoices->Payment_Status);
				$ExportDoc->ExportCaption($invoices->Status);
				$ExportDoc->ExportCaption($invoices->Recipient_Bank);
				$ExportDoc->ExportCaption($invoices->User_ID);
				$ExportDoc->ExportCaption($invoices->created);
				$ExportDoc->ExportCaption($invoices->modified);
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
				$invoices->CssClass = "";
				$invoices->CssStyle = "";
				$invoices->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($invoices->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $invoices->id->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Invoice_Number', $invoices->Invoice_Number->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Client_ID', $invoices->Client_ID->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Invoice_Date', $invoices->Invoice_Date->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Due_Date', $invoices->Due_Date->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('payment_period', $invoices->payment_period->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Total_Vat', $invoices->Total_Vat->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Total_WTax', $invoices->Total_WTax->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Total_Freight', $invoices->Total_Freight->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Total_Amount_Due', $invoices->Total_Amount_Due->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Payment_Reference', $invoices->Payment_Reference->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Payment_Status', $invoices->Payment_Status->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Status', $invoices->Status->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('Recipient_Bank', $invoices->Recipient_Bank->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('User_ID', $invoices->User_ID->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('created', $invoices->created->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
					$XmlDoc->AddField('modified', $invoices->modified->ExportValue($invoices->Export, $invoices->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($invoices->id);
					$ExportDoc->ExportField($invoices->Invoice_Number);
					$ExportDoc->ExportField($invoices->Client_ID);
					$ExportDoc->ExportField($invoices->Invoice_Date);
					$ExportDoc->ExportField($invoices->Due_Date);
					$ExportDoc->ExportField($invoices->payment_period);
					$ExportDoc->ExportField($invoices->Total_Vat);
					$ExportDoc->ExportField($invoices->Total_WTax);
					$ExportDoc->ExportField($invoices->Total_Freight);
					$ExportDoc->ExportField($invoices->Total_Amount_Due);
					$ExportDoc->ExportField($invoices->Payment_Reference);
					$ExportDoc->ExportField($invoices->Payment_Status);
					$ExportDoc->ExportField($invoices->Status);
					$ExportDoc->ExportField($invoices->Recipient_Bank);
					$ExportDoc->ExportField($invoices->User_ID);
					$ExportDoc->ExportField($invoices->created);
					$ExportDoc->ExportField($invoices->modified);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}

		// Export aggregates (non-XML and horizontal format only)
		if ($invoices->Export <> "xml" && $ExportDoc->Horizontal) {
			$invoices->RowType = EW_ROWTYPE_AGGREGATE;
			$this->RenderRow();
			$ExportDoc->BeginExportRow();
			$ExportDoc->ExportAggregate($invoices->id, '');
			$ExportDoc->ExportAggregate($invoices->Invoice_Number, '');
			$ExportDoc->ExportAggregate($invoices->Client_ID, '');
			$ExportDoc->ExportAggregate($invoices->Invoice_Date, '');
			$ExportDoc->ExportAggregate($invoices->Due_Date, '');
			$ExportDoc->ExportAggregate($invoices->payment_period, '');
			$ExportDoc->ExportAggregate($invoices->Total_Vat, 'TOTAL');
			$ExportDoc->ExportAggregate($invoices->Total_WTax, 'TOTAL');
			$ExportDoc->ExportAggregate($invoices->Total_Freight, 'TOTAL');
			$ExportDoc->ExportAggregate($invoices->Total_Amount_Due, 'TOTAL');
			$ExportDoc->ExportAggregate($invoices->Payment_Reference, '');
			$ExportDoc->ExportAggregate($invoices->Payment_Status, '');
			$ExportDoc->ExportAggregate($invoices->Status, '');
			$ExportDoc->ExportAggregate($invoices->Recipient_Bank, '');
			$ExportDoc->ExportAggregate($invoices->User_ID, '');
			$ExportDoc->ExportAggregate($invoices->created, '');
			$ExportDoc->ExportAggregate($invoices->modified, '');
			$ExportDoc->EndExportRow();
		}
		if ($invoices->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($invoices->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($invoices->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($invoices->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($invoices->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $invoices;
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
				$this->sDbMasterFilter = $invoices->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $invoices->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$invoices->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$invoices->Client_ID->setSessionValue($invoices->Client_ID->QueryStringValue);
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
			$invoices->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$invoices->setStartRecordNumber($this->lStartRec);
			$invoices->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$invoices->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($invoices->Client_ID->QueryStringValue == "") $invoices->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $invoices->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $invoices->getDetailFilter(); // Restore detail filter
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'invoices';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
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
