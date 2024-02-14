<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "trucksinfo.php" ?>
<?php include "subconsinfo.php" ?>
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
$trucks_list = new ctrucks_list();
$Page =& $trucks_list;

// Page init
$trucks_list->Page_Init();

// Page main
$trucks_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($trucks->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trucks_list = new ew_Page("trucks_list");

// page properties
trucks_list.PageID = "list"; // page ID
trucks_list.FormID = "ftruckslist"; // form ID
var EW_PAGE_ID = trucks_list.PageID; // for backward compatibility

// extend page with validate function for search
trucks_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

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
trucks_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
trucks_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
trucks_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trucks_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($trucks->Export == "") { ?>
<?php
$gsMasterReturnUrl = "subconslist.php";
if ($trucks_list->sDbMasterFilter <> "" && $trucks->getCurrentMasterTable() == "subcons") {
	if ($trucks_list->bMasterRecordExists) {
		if ($trucks->getCurrentMasterTable() == $trucks->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "subconsmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$trucks_list->lTotalRecs = $trucks->SelectRecordCount();
	} else {
		if ($rs = $trucks_list->LoadRecordset())
			$trucks_list->lTotalRecs = $rs->RecordCount();
	}
	$trucks_list->lStartRec = 1;
	if ($trucks_list->lDisplayRecs <= 0 || ($trucks->Export <> "" && $trucks->ExportAll)) // Display all records
		$trucks_list->lDisplayRecs = $trucks_list->lTotalRecs;
	if (!($trucks->Export <> "" && $trucks->ExportAll))
		$trucks_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $trucks_list->LoadRecordset($trucks_list->lStartRec-1, $trucks_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $trucks->TableCaption() ?>
<?php if ($trucks->Export == "" && $trucks->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $trucks_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $trucks_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $trucks_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($trucks->Export == "" && $trucks->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(trucks_list);" style="text-decoration: none;"><img id="trucks_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="trucks_list_SearchPanel">
<form name="ftruckslistsrch" id="ftruckslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return trucks_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="trucks">
<?php
if ($gsSearchError == "")
	$trucks_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$trucks->RowType = EW_ROWTYPE_SEARCH;

// Render row
$trucks_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $trucks->Sub_Con_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Sub_Con_ID" id="z_Sub_Con_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($trucks->Sub_Con_ID->getSessionValue() <> "") { ?>
<div<?php echo $trucks->Sub_Con_ID->ViewAttributes() ?>><?php echo $trucks->Sub_Con_ID->ListViewValue() ?></div>
<input type="hidden" id="x_Sub_Con_ID" name="x_Sub_Con_ID" value="<?php echo ew_HtmlEncode($trucks->Sub_Con_ID->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<select id="x_Sub_Con_ID" name="x_Sub_Con_ID" title="<?php echo $trucks->Sub_Con_ID->FldTitle() ?>"<?php echo $trucks->Sub_Con_ID->EditAttributes() ?>>
<?php
if (is_array($trucks->Sub_Con_ID->EditValue)) {
	$arwrk = $trucks->Sub_Con_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trucks->Sub_Con_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker"><?php echo $trucks->Model->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Model" id="z_Model" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Model" id="x_Model" title="<?php echo $trucks->Model->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->Model->EditValue ?>"<?php echo $trucks->Model->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $trucks->Brand->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Brand" id="z_Brand" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Brand" id="x_Brand" title="<?php echo $trucks->Brand->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $trucks->Brand->EditValue ?>"<?php echo $trucks->Brand->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $trucks->Truck_Types_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Truck_Types_ID" id="z_Truck_Types_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Truck_Types_ID" name="x_Truck_Types_ID" title="<?php echo $trucks->Truck_Types_ID->FldTitle() ?>"<?php echo $trucks->Truck_Types_ID->EditAttributes() ?>>
<?php
if (is_array($trucks->Truck_Types_ID->EditValue)) {
	$arwrk = $trucks->Truck_Types_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trucks->Truck_Types_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($trucks->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $trucks_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($trucks->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($trucks->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($trucks->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$trucks_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($trucks->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($trucks->CurrentAction <> "gridadd" && $trucks->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($trucks_list->Pager)) $trucks_list->Pager = new cPrevNextPager($trucks_list->lStartRec, $trucks_list->lDisplayRecs, $trucks_list->lTotalRecs) ?>
<?php if ($trucks_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($trucks_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $trucks_list->PageUrl() ?>start=<?php echo $trucks_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($trucks_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $trucks_list->PageUrl() ?>start=<?php echo $trucks_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $trucks_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($trucks_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $trucks_list->PageUrl() ?>start=<?php echo $trucks_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($trucks_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $trucks_list->PageUrl() ?>start=<?php echo $trucks_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trucks_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $trucks_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $trucks_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $trucks_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($trucks_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($trucks_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="trucks">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($trucks_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($trucks_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($trucks_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($trucks_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($trucks_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($trucks_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($trucks->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $trucks_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($trucks_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftruckslist, '<?php echo $trucks_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftruckslist" id="ftruckslist" class="ewForm" action="" method="post">
<div id="gmp_trucks" class="ewGridMiddlePanel">
<?php if ($trucks_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $trucks->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$trucks_list->RenderListOptions();

// Render list options (header, left)
$trucks_list->ListOptions->Render("header", "left");
?>
<?php if ($trucks->id->Visible) { // id ?>
	<?php if ($trucks->SortUrl($trucks->id) == "") { ?>
		<td><?php echo $trucks->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($trucks->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Sub_Con_ID->Visible) { // Sub_Con_ID ?>
	<?php if ($trucks->SortUrl($trucks->Sub_Con_ID) == "") { ?>
		<td><?php echo $trucks->Sub_Con_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Sub_Con_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Sub_Con_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($trucks->Sub_Con_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Sub_Con_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Model->Visible) { // Model ?>
	<?php if ($trucks->SortUrl($trucks->Model) == "") { ?>
		<td><?php echo $trucks->Model->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Model) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Model->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($trucks->Model->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Model->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Brand->Visible) { // Brand ?>
	<?php if ($trucks->SortUrl($trucks->Brand) == "") { ?>
		<td><?php echo $trucks->Brand->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Brand) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Brand->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($trucks->Brand->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Brand->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Truck_Types_ID->Visible) { // Truck_Types_ID ?>
	<?php if ($trucks->SortUrl($trucks->Truck_Types_ID) == "") { ?>
		<td><?php echo $trucks->Truck_Types_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Truck_Types_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Truck_Types_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($trucks->Truck_Types_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Truck_Types_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Plate_Number->Visible) { // Plate_Number ?>
	<?php if ($trucks->SortUrl($trucks->Plate_Number) == "") { ?>
		<td><?php echo $trucks->Plate_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Plate_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Plate_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($trucks->Plate_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Plate_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Series->Visible) { // Series ?>
	<?php if ($trucks->SortUrl($trucks->Series) == "") { ?>
		<td><?php echo $trucks->Series->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Series) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Series->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($trucks->Series->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Series->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Truck_Body_Type->Visible) { // Truck_Body_Type ?>
	<?php if ($trucks->SortUrl($trucks->Truck_Body_Type) == "") { ?>
		<td><?php echo $trucks->Truck_Body_Type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Truck_Body_Type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Truck_Body_Type->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($trucks->Truck_Body_Type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Truck_Body_Type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Gross_Weight->Visible) { // Gross_Weight ?>
	<?php if ($trucks->SortUrl($trucks->Gross_Weight) == "") { ?>
		<td><?php echo $trucks->Gross_Weight->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Gross_Weight) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Gross_Weight->FldCaption() ?></td><td style="width: 10px;"><?php if ($trucks->Gross_Weight->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Gross_Weight->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Net_Capacity->Visible) { // Net_Capacity ?>
	<?php if ($trucks->SortUrl($trucks->Net_Capacity) == "") { ?>
		<td><?php echo $trucks->Net_Capacity->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Net_Capacity) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Net_Capacity->FldCaption() ?></td><td style="width: 10px;"><?php if ($trucks->Net_Capacity->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Net_Capacity->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Inland_Marine_Insurance->Visible) { // Inland_Marine_Insurance ?>
	<?php if ($trucks->SortUrl($trucks->Inland_Marine_Insurance) == "") { ?>
		<td><?php echo $trucks->Inland_Marine_Insurance->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Inland_Marine_Insurance) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Inland_Marine_Insurance->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($trucks->Inland_Marine_Insurance->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Inland_Marine_Insurance->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Expiration_Date->Visible) { // Expiration_Date ?>
	<?php if ($trucks->SortUrl($trucks->Expiration_Date) == "") { ?>
		<td><?php echo $trucks->Expiration_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Expiration_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Expiration_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($trucks->Expiration_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Expiration_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->LTFRB_Case_No->Visible) { // LTFRB_Case_No ?>
	<?php if ($trucks->SortUrl($trucks->LTFRB_Case_No) == "") { ?>
		<td><?php echo $trucks->LTFRB_Case_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->LTFRB_Case_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->LTFRB_Case_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($trucks->LTFRB_Case_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->LTFRB_Case_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->LTFRB_Expiration->Visible) { // LTFRB_Expiration ?>
	<?php if ($trucks->SortUrl($trucks->LTFRB_Expiration) == "") { ?>
		<td><?php echo $trucks->LTFRB_Expiration->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->LTFRB_Expiration) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->LTFRB_Expiration->FldCaption() ?></td><td style="width: 10px;"><?php if ($trucks->LTFRB_Expiration->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->LTFRB_Expiration->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->File_Upload->Visible) { // File_Upload ?>
	<?php if ($trucks->SortUrl($trucks->File_Upload) == "") { ?>
		<td><?php echo $trucks->File_Upload->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->File_Upload) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->File_Upload->FldCaption() ?></td><td style="width: 10px;"><?php if ($trucks->File_Upload->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->File_Upload->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($trucks->Remarks->Visible) { // Remarks ?>
	<?php if ($trucks->SortUrl($trucks->Remarks) == "") { ?>
		<td><?php echo $trucks->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trucks->SortUrl($trucks->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $trucks->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($trucks->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trucks->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$trucks_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($trucks->ExportAll && $trucks->Export <> "") {
	$trucks_list->lStopRec = $trucks_list->lTotalRecs;
} else {
	$trucks_list->lStopRec = $trucks_list->lStartRec + $trucks_list->lDisplayRecs - 1; // Set the last record to display
}
$trucks_list->lRecCount = $trucks_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $trucks_list->lStartRec > 1)
		$rs->Move($trucks_list->lStartRec - 1);
}

// Initialize aggregate
$trucks->RowType = EW_ROWTYPE_AGGREGATEINIT;
$trucks_list->RenderRow();
$trucks_list->lRowCnt = 0;
while (($trucks->CurrentAction == "gridadd" || !$rs->EOF) &&
	$trucks_list->lRecCount < $trucks_list->lStopRec) {
	$trucks_list->lRecCount++;
	if (intval($trucks_list->lRecCount) >= intval($trucks_list->lStartRec)) {
		$trucks_list->lRowCnt++;

	// Init row class and style
	$trucks->CssClass = "";
	$trucks->CssStyle = "";
	$trucks->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($trucks->CurrentAction == "gridadd") {
		$trucks_list->LoadDefaultValues(); // Load default values
	} else {
		$trucks_list->LoadRowValues($rs); // Load row values
	}
	$trucks->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$trucks_list->RenderRow();

	// Render list options
	$trucks_list->RenderListOptions();
?>
	<tr<?php echo $trucks->RowAttributes() ?>>
<?php

// Render list options (body, left)
$trucks_list->ListOptions->Render("body", "left");
?>
	<?php if ($trucks->id->Visible) { // id ?>
		<td<?php echo $trucks->id->CellAttributes() ?>>
<div<?php echo $trucks->id->ViewAttributes() ?>><?php echo $trucks->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Sub_Con_ID->Visible) { // Sub_Con_ID ?>
		<td<?php echo $trucks->Sub_Con_ID->CellAttributes() ?>>
<div<?php echo $trucks->Sub_Con_ID->ViewAttributes() ?>><?php echo $trucks->Sub_Con_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Model->Visible) { // Model ?>
		<td<?php echo $trucks->Model->CellAttributes() ?>>
<div<?php echo $trucks->Model->ViewAttributes() ?>><?php echo $trucks->Model->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Brand->Visible) { // Brand ?>
		<td<?php echo $trucks->Brand->CellAttributes() ?>>
<div<?php echo $trucks->Brand->ViewAttributes() ?>><?php echo $trucks->Brand->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Truck_Types_ID->Visible) { // Truck_Types_ID ?>
		<td<?php echo $trucks->Truck_Types_ID->CellAttributes() ?>>
<div<?php echo $trucks->Truck_Types_ID->ViewAttributes() ?>><?php echo $trucks->Truck_Types_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Plate_Number->Visible) { // Plate_Number ?>
		<td<?php echo $trucks->Plate_Number->CellAttributes() ?>>
<div<?php echo $trucks->Plate_Number->ViewAttributes() ?>><?php echo $trucks->Plate_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Series->Visible) { // Series ?>
		<td<?php echo $trucks->Series->CellAttributes() ?>>
<div<?php echo $trucks->Series->ViewAttributes() ?>><?php echo $trucks->Series->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Truck_Body_Type->Visible) { // Truck_Body_Type ?>
		<td<?php echo $trucks->Truck_Body_Type->CellAttributes() ?>>
<div<?php echo $trucks->Truck_Body_Type->ViewAttributes() ?>><?php echo $trucks->Truck_Body_Type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Gross_Weight->Visible) { // Gross_Weight ?>
		<td<?php echo $trucks->Gross_Weight->CellAttributes() ?>>
<div<?php echo $trucks->Gross_Weight->ViewAttributes() ?>><?php echo $trucks->Gross_Weight->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Net_Capacity->Visible) { // Net_Capacity ?>
		<td<?php echo $trucks->Net_Capacity->CellAttributes() ?>>
<div<?php echo $trucks->Net_Capacity->ViewAttributes() ?>><?php echo $trucks->Net_Capacity->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Inland_Marine_Insurance->Visible) { // Inland_Marine_Insurance ?>
		<td<?php echo $trucks->Inland_Marine_Insurance->CellAttributes() ?>>
<div<?php echo $trucks->Inland_Marine_Insurance->ViewAttributes() ?>><?php echo $trucks->Inland_Marine_Insurance->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->Expiration_Date->Visible) { // Expiration_Date ?>
		<td<?php echo $trucks->Expiration_Date->CellAttributes() ?>>
<div<?php echo $trucks->Expiration_Date->ViewAttributes() ?>><?php echo $trucks->Expiration_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->LTFRB_Case_No->Visible) { // LTFRB_Case_No ?>
		<td<?php echo $trucks->LTFRB_Case_No->CellAttributes() ?>>
<div<?php echo $trucks->LTFRB_Case_No->ViewAttributes() ?>><?php echo $trucks->LTFRB_Case_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->LTFRB_Expiration->Visible) { // LTFRB_Expiration ?>
		<td<?php echo $trucks->LTFRB_Expiration->CellAttributes() ?>>
<div<?php echo $trucks->LTFRB_Expiration->ViewAttributes() ?>><?php echo $trucks->LTFRB_Expiration->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trucks->File_Upload->Visible) { // File_Upload ?>
		<td<?php echo $trucks->File_Upload->CellAttributes() ?>>
<?php if ($trucks->File_Upload->HrefValue <> "" || $trucks->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $trucks->File_Upload->HrefValue ?>"><?php echo $trucks->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<?php echo $trucks->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trucks->Remarks->Visible) { // Remarks ?>
		<td<?php echo $trucks->Remarks->CellAttributes() ?>>
<div<?php echo $trucks->Remarks->ViewAttributes() ?>><?php echo $trucks->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trucks_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($trucks->CurrentAction <> "gridadd")
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
<?php if ($trucks_list->lTotalRecs > 0) { ?>
<?php if ($trucks->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($trucks->CurrentAction <> "gridadd" && $trucks->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($trucks_list->Pager)) $trucks_list->Pager = new cPrevNextPager($trucks_list->lStartRec, $trucks_list->lDisplayRecs, $trucks_list->lTotalRecs) ?>
<?php if ($trucks_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($trucks_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $trucks_list->PageUrl() ?>start=<?php echo $trucks_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($trucks_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $trucks_list->PageUrl() ?>start=<?php echo $trucks_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $trucks_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($trucks_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $trucks_list->PageUrl() ?>start=<?php echo $trucks_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($trucks_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $trucks_list->PageUrl() ?>start=<?php echo $trucks_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $trucks_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $trucks_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $trucks_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $trucks_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($trucks_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($trucks_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="trucks">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($trucks_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($trucks_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($trucks_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($trucks_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($trucks_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($trucks_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($trucks->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($trucks_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $trucks_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($trucks_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftruckslist, '<?php echo $trucks_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($trucks->Export == "" && $trucks->CurrentAction == "") { ?>
<?php } ?>
<?php if ($trucks->Export == "") { ?>
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
$trucks_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctrucks_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'trucks';

	// Page object name
	var $PageObjName = 'trucks_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trucks;
		if ($trucks->UseTokenInUrl) $PageUrl .= "t=" . $trucks->TableVar . "&"; // Add page token
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
		global $objForm, $trucks;
		if ($trucks->UseTokenInUrl) {
			if ($objForm)
				return ($trucks->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trucks->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctrucks_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (trucks)
		$GLOBALS["trucks"] = new ctrucks();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["trucks"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "trucksdelete.php";
		$this->MultiUpdateUrl = "trucksupdate.php";

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trucks', TRUE);

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
		global $trucks;

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
			$trucks->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$trucks->Export = $_POST["exporttype"];
		} else {
			$trucks->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $trucks->Export; // Get export parameter, used in header
		$gsExportFile = $trucks->TableVar; // Get export file, used in header
		if ($trucks->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $trucks;

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
			$trucks->Recordset_SearchValidated();

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
		if ($trucks->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $trucks->getRecordsPerPage(); // Restore from Session
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
		$trucks->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$trucks->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$trucks->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $trucks->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $trucks->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $trucks->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($trucks->getMasterFilter() <> "" && $trucks->getCurrentMasterTable() == "subcons") {
			global $subcons;
			$rsmaster = $subcons->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$trucks->setMasterFilter(""); // Clear master filter
				$trucks->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($trucks->getReturnUrl()); // Return to caller
			} else {
				$subcons->LoadListRowValues($rsmaster);
				$subcons->RowType = EW_ROWTYPE_MASTER; // Master row
				$subcons->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$trucks->setSessionWhere($sFilter);
		$trucks->CurrentFilter = "";

		// Export data only
		if (in_array($trucks->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($trucks->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $trucks;
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
			$trucks->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$trucks->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $trucks;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $trucks->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $trucks->Sub_Con_ID, FALSE); // Sub_Con_ID
		$this->BuildSearchSql($sWhere, $trucks->Model, FALSE); // Model
		$this->BuildSearchSql($sWhere, $trucks->Brand, FALSE); // Brand
		$this->BuildSearchSql($sWhere, $trucks->Truck_Types_ID, FALSE); // Truck_Types_ID
		$this->BuildSearchSql($sWhere, $trucks->Plate_Number, FALSE); // Plate_Number
		$this->BuildSearchSql($sWhere, $trucks->Series, FALSE); // Series
		$this->BuildSearchSql($sWhere, $trucks->Truck_Body_Type, FALSE); // Truck_Body_Type
		$this->BuildSearchSql($sWhere, $trucks->Gross_Weight, FALSE); // Gross_Weight
		$this->BuildSearchSql($sWhere, $trucks->Net_Capacity, FALSE); // Net_Capacity
		$this->BuildSearchSql($sWhere, $trucks->Inland_Marine_Insurance, FALSE); // Inland_Marine_Insurance
		$this->BuildSearchSql($sWhere, $trucks->Expiration_Date, FALSE); // Expiration_Date
		$this->BuildSearchSql($sWhere, $trucks->LTFRB_Case_No, FALSE); // LTFRB_Case_No
		$this->BuildSearchSql($sWhere, $trucks->LTFRB_Expiration, FALSE); // LTFRB_Expiration
		$this->BuildSearchSql($sWhere, $trucks->Remarks, FALSE); // Remarks

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($trucks->id); // id
			$this->SetSearchParm($trucks->Sub_Con_ID); // Sub_Con_ID
			$this->SetSearchParm($trucks->Model); // Model
			$this->SetSearchParm($trucks->Brand); // Brand
			$this->SetSearchParm($trucks->Truck_Types_ID); // Truck_Types_ID
			$this->SetSearchParm($trucks->Plate_Number); // Plate_Number
			$this->SetSearchParm($trucks->Series); // Series
			$this->SetSearchParm($trucks->Truck_Body_Type); // Truck_Body_Type
			$this->SetSearchParm($trucks->Gross_Weight); // Gross_Weight
			$this->SetSearchParm($trucks->Net_Capacity); // Net_Capacity
			$this->SetSearchParm($trucks->Inland_Marine_Insurance); // Inland_Marine_Insurance
			$this->SetSearchParm($trucks->Expiration_Date); // Expiration_Date
			$this->SetSearchParm($trucks->LTFRB_Case_No); // LTFRB_Case_No
			$this->SetSearchParm($trucks->LTFRB_Expiration); // LTFRB_Expiration
			$this->SetSearchParm($trucks->Remarks); // Remarks
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
		global $trucks;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$trucks->setAdvancedSearch("x_$FldParm", $FldVal);
		$trucks->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$trucks->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$trucks->setAdvancedSearch("y_$FldParm", $FldVal2);
		$trucks->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $trucks;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $trucks->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $trucks->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $trucks->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $trucks->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $trucks->GetAdvancedSearch("w_$FldParm");
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
		global $trucks;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $trucks->Model, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $trucks->Brand, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $trucks->Plate_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $trucks->Series, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $trucks->Truck_Body_Type, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $trucks->Inland_Marine_Insurance, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $trucks->LTFRB_Case_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $trucks->File_Upload, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $trucks->Remarks, $Keyword);
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
		global $Security, $trucks;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $trucks->BasicSearchKeyword;
		$sSearchType = $trucks->BasicSearchType;
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
			$trucks->setSessionBasicSearchKeyword($sSearchKeyword);
			$trucks->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $trucks;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$trucks->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $trucks;
		$trucks->setSessionBasicSearchKeyword("");
		$trucks->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $trucks;
		$trucks->setAdvancedSearch("x_id", "");
		$trucks->setAdvancedSearch("x_Sub_Con_ID", "");
		$trucks->setAdvancedSearch("x_Model", "");
		$trucks->setAdvancedSearch("x_Brand", "");
		$trucks->setAdvancedSearch("x_Truck_Types_ID", "");
		$trucks->setAdvancedSearch("x_Plate_Number", "");
		$trucks->setAdvancedSearch("x_Series", "");
		$trucks->setAdvancedSearch("x_Truck_Body_Type", "");
		$trucks->setAdvancedSearch("x_Gross_Weight", "");
		$trucks->setAdvancedSearch("x_Net_Capacity", "");
		$trucks->setAdvancedSearch("x_Inland_Marine_Insurance", "");
		$trucks->setAdvancedSearch("x_Expiration_Date", "");
		$trucks->setAdvancedSearch("x_LTFRB_Case_No", "");
		$trucks->setAdvancedSearch("x_LTFRB_Expiration", "");
		$trucks->setAdvancedSearch("x_Remarks", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $trucks;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Sub_Con_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Model"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Brand"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Truck_Types_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Plate_Number"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Series"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Truck_Body_Type"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Gross_Weight"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Net_Capacity"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Inland_Marine_Insurance"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Expiration_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_LTFRB_Case_No"] <> "") $bRestore = FALSE;
		if (@$_GET["x_LTFRB_Expiration"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$trucks->BasicSearchKeyword = $trucks->getSessionBasicSearchKeyword();
			$trucks->BasicSearchType = $trucks->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($trucks->id);
			$this->GetSearchParm($trucks->Sub_Con_ID);
			$this->GetSearchParm($trucks->Model);
			$this->GetSearchParm($trucks->Brand);
			$this->GetSearchParm($trucks->Truck_Types_ID);
			$this->GetSearchParm($trucks->Plate_Number);
			$this->GetSearchParm($trucks->Series);
			$this->GetSearchParm($trucks->Truck_Body_Type);
			$this->GetSearchParm($trucks->Gross_Weight);
			$this->GetSearchParm($trucks->Net_Capacity);
			$this->GetSearchParm($trucks->Inland_Marine_Insurance);
			$this->GetSearchParm($trucks->Expiration_Date);
			$this->GetSearchParm($trucks->LTFRB_Case_No);
			$this->GetSearchParm($trucks->LTFRB_Expiration);
			$this->GetSearchParm($trucks->Remarks);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $trucks;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$trucks->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$trucks->CurrentOrderType = @$_GET["ordertype"];
			$trucks->UpdateSort($trucks->id); // id
			$trucks->UpdateSort($trucks->Sub_Con_ID); // Sub_Con_ID
			$trucks->UpdateSort($trucks->Model); // Model
			$trucks->UpdateSort($trucks->Brand); // Brand
			$trucks->UpdateSort($trucks->Truck_Types_ID); // Truck_Types_ID
			$trucks->UpdateSort($trucks->Plate_Number); // Plate_Number
			$trucks->UpdateSort($trucks->Series); // Series
			$trucks->UpdateSort($trucks->Truck_Body_Type); // Truck_Body_Type
			$trucks->UpdateSort($trucks->Gross_Weight); // Gross_Weight
			$trucks->UpdateSort($trucks->Net_Capacity); // Net_Capacity
			$trucks->UpdateSort($trucks->Inland_Marine_Insurance); // Inland_Marine_Insurance
			$trucks->UpdateSort($trucks->Expiration_Date); // Expiration_Date
			$trucks->UpdateSort($trucks->LTFRB_Case_No); // LTFRB_Case_No
			$trucks->UpdateSort($trucks->LTFRB_Expiration); // LTFRB_Expiration
			$trucks->UpdateSort($trucks->File_Upload); // File_Upload
			$trucks->UpdateSort($trucks->Remarks); // Remarks
			$trucks->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $trucks;
		$sOrderBy = $trucks->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($trucks->SqlOrderBy() <> "") {
				$sOrderBy = $trucks->SqlOrderBy();
				$trucks->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $trucks;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$trucks->getCurrentMasterTable = ""; // Clear master table
				$trucks->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$trucks->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$trucks->Sub_Con_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$trucks->setSessionOrderBy($sOrderBy);
				$trucks->id->setSort("");
				$trucks->Sub_Con_ID->setSort("");
				$trucks->Model->setSort("");
				$trucks->Brand->setSort("");
				$trucks->Truck_Types_ID->setSort("");
				$trucks->Plate_Number->setSort("");
				$trucks->Series->setSort("");
				$trucks->Truck_Body_Type->setSort("");
				$trucks->Gross_Weight->setSort("");
				$trucks->Net_Capacity->setSort("");
				$trucks->Inland_Marine_Insurance->setSort("");
				$trucks->Expiration_Date->setSort("");
				$trucks->LTFRB_Case_No->setSort("");
				$trucks->LTFRB_Expiration->setSort("");
				$trucks->File_Upload->setSort("");
				$trucks->Remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$trucks->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $trucks;

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

		// "detail_file_uploads_trucks"
		$this->ListOptions->Add("detail_file_uploads_trucks");
		$item =& $this->ListOptions->Items["detail_file_uploads_trucks"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('file_uploads_trucks');
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"trucks_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($trucks->Export <> "" ||
			$trucks->CurrentAction == "gridadd" ||
			$trucks->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $trucks;
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

		// "detail_file_uploads_trucks"
		$oListOpt =& $this->ListOptions->Items["detail_file_uploads_trucks"];
		if ($Security->AllowList('file_uploads_trucks')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("file_uploads_trucks", "TblCaption");
			$oListOpt->Body = "<a href=\"file_uploads_truckslist.php?" . EW_TABLE_SHOW_MASTER . "=trucks&id=" . urlencode(strval($trucks->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($trucks->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $trucks;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $trucks;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$trucks->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$trucks->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $trucks->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$trucks->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$trucks->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$trucks->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $trucks;
		$trucks->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$trucks->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $trucks;

		// Load search values
		// id

		$trucks->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$trucks->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Sub_Con_ID
		$trucks->Sub_Con_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Sub_Con_ID"]);
		$trucks->Sub_Con_ID->AdvancedSearch->SearchOperator = @$_GET["z_Sub_Con_ID"];

		// Model
		$trucks->Model->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Model"]);
		$trucks->Model->AdvancedSearch->SearchOperator = @$_GET["z_Model"];

		// Brand
		$trucks->Brand->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Brand"]);
		$trucks->Brand->AdvancedSearch->SearchOperator = @$_GET["z_Brand"];

		// Truck_Types_ID
		$trucks->Truck_Types_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Truck_Types_ID"]);
		$trucks->Truck_Types_ID->AdvancedSearch->SearchOperator = @$_GET["z_Truck_Types_ID"];

		// Plate_Number
		$trucks->Plate_Number->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Plate_Number"]);
		$trucks->Plate_Number->AdvancedSearch->SearchOperator = @$_GET["z_Plate_Number"];

		// Series
		$trucks->Series->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Series"]);
		$trucks->Series->AdvancedSearch->SearchOperator = @$_GET["z_Series"];

		// Truck_Body_Type
		$trucks->Truck_Body_Type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Truck_Body_Type"]);
		$trucks->Truck_Body_Type->AdvancedSearch->SearchOperator = @$_GET["z_Truck_Body_Type"];

		// Gross_Weight
		$trucks->Gross_Weight->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Gross_Weight"]);
		$trucks->Gross_Weight->AdvancedSearch->SearchOperator = @$_GET["z_Gross_Weight"];

		// Net_Capacity
		$trucks->Net_Capacity->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Net_Capacity"]);
		$trucks->Net_Capacity->AdvancedSearch->SearchOperator = @$_GET["z_Net_Capacity"];

		// Inland_Marine_Insurance
		$trucks->Inland_Marine_Insurance->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Inland_Marine_Insurance"]);
		$trucks->Inland_Marine_Insurance->AdvancedSearch->SearchOperator = @$_GET["z_Inland_Marine_Insurance"];

		// Expiration_Date
		$trucks->Expiration_Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Expiration_Date"]);
		$trucks->Expiration_Date->AdvancedSearch->SearchOperator = @$_GET["z_Expiration_Date"];

		// LTFRB_Case_No
		$trucks->LTFRB_Case_No->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_LTFRB_Case_No"]);
		$trucks->LTFRB_Case_No->AdvancedSearch->SearchOperator = @$_GET["z_LTFRB_Case_No"];

		// LTFRB_Expiration
		$trucks->LTFRB_Expiration->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_LTFRB_Expiration"]);
		$trucks->LTFRB_Expiration->AdvancedSearch->SearchOperator = @$_GET["z_LTFRB_Expiration"];

		// Remarks
		$trucks->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$trucks->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trucks;

		// Call Recordset Selecting event
		$trucks->Recordset_Selecting($trucks->CurrentFilter);

		// Load List page SQL
		$sSql = $trucks->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$trucks->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trucks;
		$sFilter = $trucks->KeyFilter();

		// Call Row Selecting event
		$trucks->Row_Selecting($sFilter);

		// Load SQL based on filter
		$trucks->CurrentFilter = $sFilter;
		$sSql = $trucks->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$trucks->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $trucks;
		$trucks->id->setDbValue($rs->fields('id'));
		$trucks->Sub_Con_ID->setDbValue($rs->fields('Sub_Con_ID'));
		$trucks->Model->setDbValue($rs->fields('Model'));
		$trucks->Brand->setDbValue($rs->fields('Brand'));
		$trucks->Truck_Types_ID->setDbValue($rs->fields('Truck_Types_ID'));
		$trucks->Plate_Number->setDbValue($rs->fields('Plate_Number'));
		$trucks->Series->setDbValue($rs->fields('Series'));
		$trucks->Truck_Body_Type->setDbValue($rs->fields('Truck_Body_Type'));
		$trucks->Gross_Weight->setDbValue($rs->fields('Gross_Weight'));
		$trucks->Net_Capacity->setDbValue($rs->fields('Net_Capacity'));
		$trucks->Inland_Marine_Insurance->setDbValue($rs->fields('Inland_Marine_Insurance'));
		$trucks->Expiration_Date->setDbValue($rs->fields('Expiration_Date'));
		$trucks->LTFRB_Case_No->setDbValue($rs->fields('LTFRB_Case_No'));
		$trucks->LTFRB_Expiration->setDbValue($rs->fields('LTFRB_Expiration'));
		$trucks->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$trucks->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $trucks;

		// Initialize URLs
		$this->ViewUrl = $trucks->ViewUrl();
		$this->EditUrl = $trucks->EditUrl();
		$this->InlineEditUrl = $trucks->InlineEditUrl();
		$this->CopyUrl = $trucks->CopyUrl();
		$this->InlineCopyUrl = $trucks->InlineCopyUrl();
		$this->DeleteUrl = $trucks->DeleteUrl();

		// Call Row_Rendering event
		$trucks->Row_Rendering();

		// Common render codes for all row types
		// id

		$trucks->id->CellCssStyle = ""; $trucks->id->CellCssClass = "";
		$trucks->id->CellAttrs = array(); $trucks->id->ViewAttrs = array(); $trucks->id->EditAttrs = array();

		// Sub_Con_ID
		$trucks->Sub_Con_ID->CellCssStyle = ""; $trucks->Sub_Con_ID->CellCssClass = "";
		$trucks->Sub_Con_ID->CellAttrs = array(); $trucks->Sub_Con_ID->ViewAttrs = array(); $trucks->Sub_Con_ID->EditAttrs = array();

		// Model
		$trucks->Model->CellCssStyle = ""; $trucks->Model->CellCssClass = "";
		$trucks->Model->CellAttrs = array(); $trucks->Model->ViewAttrs = array(); $trucks->Model->EditAttrs = array();

		// Brand
		$trucks->Brand->CellCssStyle = ""; $trucks->Brand->CellCssClass = "";
		$trucks->Brand->CellAttrs = array(); $trucks->Brand->ViewAttrs = array(); $trucks->Brand->EditAttrs = array();

		// Truck_Types_ID
		$trucks->Truck_Types_ID->CellCssStyle = ""; $trucks->Truck_Types_ID->CellCssClass = "";
		$trucks->Truck_Types_ID->CellAttrs = array(); $trucks->Truck_Types_ID->ViewAttrs = array(); $trucks->Truck_Types_ID->EditAttrs = array();

		// Plate_Number
		$trucks->Plate_Number->CellCssStyle = ""; $trucks->Plate_Number->CellCssClass = "";
		$trucks->Plate_Number->CellAttrs = array(); $trucks->Plate_Number->ViewAttrs = array(); $trucks->Plate_Number->EditAttrs = array();

		// Series
		$trucks->Series->CellCssStyle = ""; $trucks->Series->CellCssClass = "";
		$trucks->Series->CellAttrs = array(); $trucks->Series->ViewAttrs = array(); $trucks->Series->EditAttrs = array();

		// Truck_Body_Type
		$trucks->Truck_Body_Type->CellCssStyle = ""; $trucks->Truck_Body_Type->CellCssClass = "";
		$trucks->Truck_Body_Type->CellAttrs = array(); $trucks->Truck_Body_Type->ViewAttrs = array(); $trucks->Truck_Body_Type->EditAttrs = array();

		// Gross_Weight
		$trucks->Gross_Weight->CellCssStyle = ""; $trucks->Gross_Weight->CellCssClass = "";
		$trucks->Gross_Weight->CellAttrs = array(); $trucks->Gross_Weight->ViewAttrs = array(); $trucks->Gross_Weight->EditAttrs = array();

		// Net_Capacity
		$trucks->Net_Capacity->CellCssStyle = ""; $trucks->Net_Capacity->CellCssClass = "";
		$trucks->Net_Capacity->CellAttrs = array(); $trucks->Net_Capacity->ViewAttrs = array(); $trucks->Net_Capacity->EditAttrs = array();

		// Inland_Marine_Insurance
		$trucks->Inland_Marine_Insurance->CellCssStyle = ""; $trucks->Inland_Marine_Insurance->CellCssClass = "";
		$trucks->Inland_Marine_Insurance->CellAttrs = array(); $trucks->Inland_Marine_Insurance->ViewAttrs = array(); $trucks->Inland_Marine_Insurance->EditAttrs = array();

		// Expiration_Date
		$trucks->Expiration_Date->CellCssStyle = ""; $trucks->Expiration_Date->CellCssClass = "";
		$trucks->Expiration_Date->CellAttrs = array(); $trucks->Expiration_Date->ViewAttrs = array(); $trucks->Expiration_Date->EditAttrs = array();

		// LTFRB_Case_No
		$trucks->LTFRB_Case_No->CellCssStyle = ""; $trucks->LTFRB_Case_No->CellCssClass = "";
		$trucks->LTFRB_Case_No->CellAttrs = array(); $trucks->LTFRB_Case_No->ViewAttrs = array(); $trucks->LTFRB_Case_No->EditAttrs = array();

		// LTFRB_Expiration
		$trucks->LTFRB_Expiration->CellCssStyle = ""; $trucks->LTFRB_Expiration->CellCssClass = "";
		$trucks->LTFRB_Expiration->CellAttrs = array(); $trucks->LTFRB_Expiration->ViewAttrs = array(); $trucks->LTFRB_Expiration->EditAttrs = array();

		// File_Upload
		$trucks->File_Upload->CellCssStyle = ""; $trucks->File_Upload->CellCssClass = "";
		$trucks->File_Upload->CellAttrs = array(); $trucks->File_Upload->ViewAttrs = array(); $trucks->File_Upload->EditAttrs = array();

		// Remarks
		$trucks->Remarks->CellCssStyle = ""; $trucks->Remarks->CellCssClass = "";
		$trucks->Remarks->CellAttrs = array(); $trucks->Remarks->ViewAttrs = array(); $trucks->Remarks->EditAttrs = array();
		if ($trucks->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$trucks->id->ViewValue = $trucks->id->CurrentValue;
			$trucks->id->CssStyle = "";
			$trucks->id->CssClass = "";
			$trucks->id->ViewCustomAttributes = "";

			// Sub_Con_ID
			if (strval($trucks->Sub_Con_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Sub_Con_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$trucks->Sub_Con_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$trucks->Sub_Con_ID->ViewValue = $trucks->Sub_Con_ID->CurrentValue;
				}
			} else {
				$trucks->Sub_Con_ID->ViewValue = NULL;
			}
			$trucks->Sub_Con_ID->CssStyle = "";
			$trucks->Sub_Con_ID->CssClass = "";
			$trucks->Sub_Con_ID->ViewCustomAttributes = "";

			// Model
			$trucks->Model->ViewValue = $trucks->Model->CurrentValue;
			$trucks->Model->CssStyle = "";
			$trucks->Model->CssClass = "";
			$trucks->Model->ViewCustomAttributes = "";

			// Brand
			$trucks->Brand->ViewValue = $trucks->Brand->CurrentValue;
			$trucks->Brand->CssStyle = "";
			$trucks->Brand->CssClass = "";
			$trucks->Brand->ViewCustomAttributes = "";

			// Truck_Types_ID
			if (strval($trucks->Truck_Types_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Truck_Types_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Truck_Type` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$trucks->Truck_Types_ID->ViewValue = $rswrk->fields('Truck_Type');
					$rswrk->Close();
				} else {
					$trucks->Truck_Types_ID->ViewValue = $trucks->Truck_Types_ID->CurrentValue;
				}
			} else {
				$trucks->Truck_Types_ID->ViewValue = NULL;
			}
			$trucks->Truck_Types_ID->CssStyle = "";
			$trucks->Truck_Types_ID->CssClass = "";
			$trucks->Truck_Types_ID->ViewCustomAttributes = "";

			// Plate_Number
			$trucks->Plate_Number->ViewValue = $trucks->Plate_Number->CurrentValue;
			$trucks->Plate_Number->CssStyle = "";
			$trucks->Plate_Number->CssClass = "";
			$trucks->Plate_Number->ViewCustomAttributes = "";

			// Series
			$trucks->Series->ViewValue = $trucks->Series->CurrentValue;
			$trucks->Series->CssStyle = "";
			$trucks->Series->CssClass = "";
			$trucks->Series->ViewCustomAttributes = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->ViewValue = $trucks->Truck_Body_Type->CurrentValue;
			$trucks->Truck_Body_Type->CssStyle = "";
			$trucks->Truck_Body_Type->CssClass = "";
			$trucks->Truck_Body_Type->ViewCustomAttributes = "";

			// Gross_Weight
			$trucks->Gross_Weight->ViewValue = $trucks->Gross_Weight->CurrentValue;
			$trucks->Gross_Weight->ViewValue = ew_FormatNumber($trucks->Gross_Weight->ViewValue, 0, -2, -2, -2);
			$trucks->Gross_Weight->CssStyle = "";
			$trucks->Gross_Weight->CssClass = "";
			$trucks->Gross_Weight->ViewCustomAttributes = "";

			// Net_Capacity
			$trucks->Net_Capacity->ViewValue = $trucks->Net_Capacity->CurrentValue;
			$trucks->Net_Capacity->ViewValue = ew_FormatNumber($trucks->Net_Capacity->ViewValue, 0, -2, -2, -2);
			$trucks->Net_Capacity->CssStyle = "";
			$trucks->Net_Capacity->CssClass = "";
			$trucks->Net_Capacity->ViewCustomAttributes = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->ViewValue = $trucks->Inland_Marine_Insurance->CurrentValue;
			$trucks->Inland_Marine_Insurance->CssStyle = "";
			$trucks->Inland_Marine_Insurance->CssClass = "";
			$trucks->Inland_Marine_Insurance->ViewCustomAttributes = "";

			// Expiration_Date
			$trucks->Expiration_Date->ViewValue = $trucks->Expiration_Date->CurrentValue;
			$trucks->Expiration_Date->ViewValue = ew_FormatDateTime($trucks->Expiration_Date->ViewValue, 6);
			$trucks->Expiration_Date->CssStyle = "";
			$trucks->Expiration_Date->CssClass = "";
			$trucks->Expiration_Date->ViewCustomAttributes = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->ViewValue = $trucks->LTFRB_Case_No->CurrentValue;
			$trucks->LTFRB_Case_No->CssStyle = "";
			$trucks->LTFRB_Case_No->CssClass = "";
			$trucks->LTFRB_Case_No->ViewCustomAttributes = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->ViewValue = $trucks->LTFRB_Expiration->CurrentValue;
			$trucks->LTFRB_Expiration->ViewValue = ew_FormatDateTime($trucks->LTFRB_Expiration->ViewValue, 6);
			$trucks->LTFRB_Expiration->CssStyle = "";
			$trucks->LTFRB_Expiration->CssClass = "";
			$trucks->LTFRB_Expiration->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->ViewValue = $trucks->File_Upload->Upload->DbValue;
			} else {
				$trucks->File_Upload->ViewValue = "";
			}
			$trucks->File_Upload->CssStyle = "";
			$trucks->File_Upload->CssClass = "";
			$trucks->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$trucks->Remarks->ViewValue = $trucks->Remarks->CurrentValue;
			$trucks->Remarks->CssStyle = "";
			$trucks->Remarks->CssClass = "";
			$trucks->Remarks->ViewCustomAttributes = "";

			// id
			$trucks->id->HrefValue = "";
			$trucks->id->TooltipValue = "";

			// Sub_Con_ID
			$trucks->Sub_Con_ID->HrefValue = "";
			$trucks->Sub_Con_ID->TooltipValue = "";

			// Model
			$trucks->Model->HrefValue = "";
			$trucks->Model->TooltipValue = "";

			// Brand
			$trucks->Brand->HrefValue = "";
			$trucks->Brand->TooltipValue = "";

			// Truck_Types_ID
			$trucks->Truck_Types_ID->HrefValue = "";
			$trucks->Truck_Types_ID->TooltipValue = "";

			// Plate_Number
			$trucks->Plate_Number->HrefValue = "";
			$trucks->Plate_Number->TooltipValue = "";

			// Series
			$trucks->Series->HrefValue = "";
			$trucks->Series->TooltipValue = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->HrefValue = "";
			$trucks->Truck_Body_Type->TooltipValue = "";

			// Gross_Weight
			$trucks->Gross_Weight->HrefValue = "";
			$trucks->Gross_Weight->TooltipValue = "";

			// Net_Capacity
			$trucks->Net_Capacity->HrefValue = "";
			$trucks->Net_Capacity->TooltipValue = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->HrefValue = "";
			$trucks->Inland_Marine_Insurance->TooltipValue = "";

			// Expiration_Date
			$trucks->Expiration_Date->HrefValue = "";
			$trucks->Expiration_Date->TooltipValue = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->HrefValue = "";
			$trucks->LTFRB_Case_No->TooltipValue = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->HrefValue = "";
			$trucks->LTFRB_Expiration->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $trucks->File_Upload->UploadPath) . ((!empty($trucks->File_Upload->ViewValue)) ? $trucks->File_Upload->ViewValue : $trucks->File_Upload->CurrentValue);
				if ($trucks->Export <> "") $trucks->File_Upload->HrefValue = ew_ConvertFullUrl($trucks->File_Upload->HrefValue);
			} else {
				$trucks->File_Upload->HrefValue = "";
			}
			$trucks->File_Upload->TooltipValue = "";

			// Remarks
			$trucks->Remarks->HrefValue = "";
			$trucks->Remarks->TooltipValue = "";
		} elseif ($trucks->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$trucks->id->EditCustomAttributes = "";
			$trucks->id->EditValue = ew_HtmlEncode($trucks->id->AdvancedSearch->SearchValue);

			// Sub_Con_ID
			$trucks->Sub_Con_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Subcon_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$trucks->Sub_Con_ID->EditValue = $arwrk;

			// Model
			$trucks->Model->EditCustomAttributes = "";
			$trucks->Model->EditValue = ew_HtmlEncode($trucks->Model->AdvancedSearch->SearchValue);

			// Brand
			$trucks->Brand->EditCustomAttributes = "";
			$trucks->Brand->EditValue = ew_HtmlEncode($trucks->Brand->AdvancedSearch->SearchValue);

			// Truck_Types_ID
			$trucks->Truck_Types_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Truck_Type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Truck_Type` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$trucks->Truck_Types_ID->EditValue = $arwrk;

			// Plate_Number
			$trucks->Plate_Number->EditCustomAttributes = "";
			$trucks->Plate_Number->EditValue = ew_HtmlEncode($trucks->Plate_Number->AdvancedSearch->SearchValue);

			// Series
			$trucks->Series->EditCustomAttributes = "";
			$trucks->Series->EditValue = ew_HtmlEncode($trucks->Series->AdvancedSearch->SearchValue);

			// Truck_Body_Type
			$trucks->Truck_Body_Type->EditCustomAttributes = "";
			$trucks->Truck_Body_Type->EditValue = ew_HtmlEncode($trucks->Truck_Body_Type->AdvancedSearch->SearchValue);

			// Gross_Weight
			$trucks->Gross_Weight->EditCustomAttributes = "";
			$trucks->Gross_Weight->EditValue = ew_HtmlEncode($trucks->Gross_Weight->AdvancedSearch->SearchValue);

			// Net_Capacity
			$trucks->Net_Capacity->EditCustomAttributes = "";
			$trucks->Net_Capacity->EditValue = ew_HtmlEncode($trucks->Net_Capacity->AdvancedSearch->SearchValue);

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->EditCustomAttributes = "";
			$trucks->Inland_Marine_Insurance->EditValue = ew_HtmlEncode($trucks->Inland_Marine_Insurance->AdvancedSearch->SearchValue);

			// Expiration_Date
			$trucks->Expiration_Date->EditCustomAttributes = "";
			$trucks->Expiration_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trucks->Expiration_Date->AdvancedSearch->SearchValue, 6), 6));

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->EditCustomAttributes = "";
			$trucks->LTFRB_Case_No->EditValue = ew_HtmlEncode($trucks->LTFRB_Case_No->AdvancedSearch->SearchValue);

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->EditCustomAttributes = "";
			$trucks->LTFRB_Expiration->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trucks->LTFRB_Expiration->AdvancedSearch->SearchValue, 6), 6));

			// File_Upload
			$trucks->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->EditValue = $trucks->File_Upload->Upload->DbValue;
			} else {
				$trucks->File_Upload->EditValue = "";
			}

			// Remarks
			$trucks->Remarks->EditCustomAttributes = "";
			$trucks->Remarks->EditValue = ew_HtmlEncode($trucks->Remarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($trucks->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$trucks->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $trucks;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

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
		global $trucks;
		$trucks->id->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_id");
		$trucks->Sub_Con_ID->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Sub_Con_ID");
		$trucks->Model->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Model");
		$trucks->Brand->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Brand");
		$trucks->Truck_Types_ID->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Truck_Types_ID");
		$trucks->Plate_Number->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Plate_Number");
		$trucks->Series->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Series");
		$trucks->Truck_Body_Type->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Truck_Body_Type");
		$trucks->Gross_Weight->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Gross_Weight");
		$trucks->Net_Capacity->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Net_Capacity");
		$trucks->Inland_Marine_Insurance->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Inland_Marine_Insurance");
		$trucks->Expiration_Date->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Expiration_Date");
		$trucks->LTFRB_Case_No->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_LTFRB_Case_No");
		$trucks->LTFRB_Expiration->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_LTFRB_Expiration");
		$trucks->Remarks->AdvancedSearch->SearchValue = $trucks->getAdvancedSearch("x_Remarks");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $trucks;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $trucks->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($trucks->ExportAll) {
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
		if ($trucks->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($trucks, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($trucks->id);
				$ExportDoc->ExportCaption($trucks->Sub_Con_ID);
				$ExportDoc->ExportCaption($trucks->Model);
				$ExportDoc->ExportCaption($trucks->Brand);
				$ExportDoc->ExportCaption($trucks->Truck_Types_ID);
				$ExportDoc->ExportCaption($trucks->Plate_Number);
				$ExportDoc->ExportCaption($trucks->Series);
				$ExportDoc->ExportCaption($trucks->Truck_Body_Type);
				$ExportDoc->ExportCaption($trucks->Gross_Weight);
				$ExportDoc->ExportCaption($trucks->Net_Capacity);
				$ExportDoc->ExportCaption($trucks->Inland_Marine_Insurance);
				$ExportDoc->ExportCaption($trucks->Expiration_Date);
				$ExportDoc->ExportCaption($trucks->LTFRB_Case_No);
				$ExportDoc->ExportCaption($trucks->LTFRB_Expiration);
				$ExportDoc->ExportCaption($trucks->File_Upload);
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
				$trucks->CssClass = "";
				$trucks->CssStyle = "";
				$trucks->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($trucks->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $trucks->id->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Sub_Con_ID', $trucks->Sub_Con_ID->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Model', $trucks->Model->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Brand', $trucks->Brand->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Truck_Types_ID', $trucks->Truck_Types_ID->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Plate_Number', $trucks->Plate_Number->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Series', $trucks->Series->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Truck_Body_Type', $trucks->Truck_Body_Type->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Gross_Weight', $trucks->Gross_Weight->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Net_Capacity', $trucks->Net_Capacity->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Inland_Marine_Insurance', $trucks->Inland_Marine_Insurance->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('Expiration_Date', $trucks->Expiration_Date->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('LTFRB_Case_No', $trucks->LTFRB_Case_No->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('LTFRB_Expiration', $trucks->LTFRB_Expiration->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
					$XmlDoc->AddField('File_Upload', $trucks->File_Upload->ExportValue($trucks->Export, $trucks->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($trucks->id);
					$ExportDoc->ExportField($trucks->Sub_Con_ID);
					$ExportDoc->ExportField($trucks->Model);
					$ExportDoc->ExportField($trucks->Brand);
					$ExportDoc->ExportField($trucks->Truck_Types_ID);
					$ExportDoc->ExportField($trucks->Plate_Number);
					$ExportDoc->ExportField($trucks->Series);
					$ExportDoc->ExportField($trucks->Truck_Body_Type);
					$ExportDoc->ExportField($trucks->Gross_Weight);
					$ExportDoc->ExportField($trucks->Net_Capacity);
					$ExportDoc->ExportField($trucks->Inland_Marine_Insurance);
					$ExportDoc->ExportField($trucks->Expiration_Date);
					$ExportDoc->ExportField($trucks->LTFRB_Case_No);
					$ExportDoc->ExportField($trucks->LTFRB_Expiration);
					$ExportDoc->ExportField($trucks->File_Upload);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($trucks->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($trucks->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($trucks->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($trucks->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($trucks->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $trucks;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "subcons") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $trucks->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $trucks->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$trucks->Sub_Con_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$trucks->Sub_Con_ID->setSessionValue($trucks->Sub_Con_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["subcons"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Sub_Con_ID@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$trucks->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$trucks->setStartRecordNumber($this->lStartRec);
			$trucks->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$trucks->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($trucks->Sub_Con_ID->QueryStringValue == "") $trucks->Sub_Con_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $trucks->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $trucks->getDetailFilter(); // Restore detail filter
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
