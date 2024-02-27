<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "all_file_uploadsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "account_paymentsinfo.php" ?>
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
$all_file_uploads_list = new call_file_uploads_list();
$Page =& $all_file_uploads_list;

// Page init
$all_file_uploads_list->Page_Init();

// Page main
$all_file_uploads_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($all_file_uploads->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var all_file_uploads_list = new ew_Page("all_file_uploads_list");

// page properties
all_file_uploads_list.PageID = "list"; // page ID
all_file_uploads_list.FormID = "fall_file_uploadslist"; // form ID
var EW_PAGE_ID = all_file_uploads_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
all_file_uploads_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
all_file_uploads_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
all_file_uploads_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
all_file_uploads_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
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
<?php if ($all_file_uploads->Export == "") { ?>
<?php
$gsMasterReturnUrl = "account_paymentslist.php";
if ($all_file_uploads_list->sDbMasterFilter <> "" && $all_file_uploads->getCurrentMasterTable() == "account_payments") {
	if ($all_file_uploads_list->bMasterRecordExists) {
		if ($all_file_uploads->getCurrentMasterTable() == $all_file_uploads->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "account_paymentsmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$all_file_uploads_list->lTotalRecs = $all_file_uploads->SelectRecordCount();
	} else {
		if ($rs = $all_file_uploads_list->LoadRecordset())
			$all_file_uploads_list->lTotalRecs = $rs->RecordCount();
	}
	$all_file_uploads_list->lStartRec = 1;
	if ($all_file_uploads_list->lDisplayRecs <= 0 || ($all_file_uploads->Export <> "" && $all_file_uploads->ExportAll)) // Display all records
		$all_file_uploads_list->lDisplayRecs = $all_file_uploads_list->lTotalRecs;
	if (!($all_file_uploads->Export <> "" && $all_file_uploads->ExportAll))
		$all_file_uploads_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $all_file_uploads_list->LoadRecordset($all_file_uploads_list->lStartRec-1, $all_file_uploads_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $all_file_uploads->TableCaption() ?>
<?php if ($all_file_uploads->Export == "" && $all_file_uploads->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $all_file_uploads_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $all_file_uploads_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $all_file_uploads_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($all_file_uploads->Export == "" && $all_file_uploads->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(all_file_uploads_list);" style="text-decoration: none;"><img id="all_file_uploads_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="all_file_uploads_list_SearchPanel">
<form name="fall_file_uploadslistsrch" id="fall_file_uploadslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="all_file_uploads">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($all_file_uploads->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $all_file_uploads_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($all_file_uploads->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($all_file_uploads->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($all_file_uploads->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$all_file_uploads_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($all_file_uploads->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($all_file_uploads->CurrentAction <> "gridadd" && $all_file_uploads->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($all_file_uploads_list->Pager)) $all_file_uploads_list->Pager = new cPrevNextPager($all_file_uploads_list->lStartRec, $all_file_uploads_list->lDisplayRecs, $all_file_uploads_list->lTotalRecs) ?>
<?php if ($all_file_uploads_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($all_file_uploads_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $all_file_uploads_list->PageUrl() ?>start=<?php echo $all_file_uploads_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($all_file_uploads_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $all_file_uploads_list->PageUrl() ?>start=<?php echo $all_file_uploads_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $all_file_uploads_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($all_file_uploads_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $all_file_uploads_list->PageUrl() ?>start=<?php echo $all_file_uploads_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($all_file_uploads_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $all_file_uploads_list->PageUrl() ?>start=<?php echo $all_file_uploads_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $all_file_uploads_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $all_file_uploads_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $all_file_uploads_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $all_file_uploads_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($all_file_uploads_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($all_file_uploads_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="all_file_uploads">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($all_file_uploads_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($all_file_uploads_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($all_file_uploads_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($all_file_uploads_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($all_file_uploads_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($all_file_uploads_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($all_file_uploads->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $all_file_uploads_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($all_file_uploads_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fall_file_uploadslist, '<?php echo $all_file_uploads_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fall_file_uploadslist" id="fall_file_uploadslist" class="ewForm" action="" method="post">
<div id="gmp_all_file_uploads" class="ewGridMiddlePanel">
<?php if ($all_file_uploads_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $all_file_uploads->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$all_file_uploads_list->RenderListOptions();

// Render list options (header, left)
$all_file_uploads_list->ListOptions->Render("header", "left");
?>
<?php if ($all_file_uploads->id->Visible) { // id ?>
	<?php if ($all_file_uploads->SortUrl($all_file_uploads->id) == "") { ?>
		<td><?php echo $all_file_uploads->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $all_file_uploads->SortUrl($all_file_uploads->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $all_file_uploads->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($all_file_uploads->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($all_file_uploads->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($all_file_uploads->module->Visible) { // module ?>
	<?php if ($all_file_uploads->SortUrl($all_file_uploads->module) == "") { ?>
		<td><?php echo $all_file_uploads->module->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $all_file_uploads->SortUrl($all_file_uploads->module) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $all_file_uploads->module->FldCaption() ?></td><td style="width: 10px;"><?php if ($all_file_uploads->module->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($all_file_uploads->module->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($all_file_uploads->File_Name->Visible) { // File_Name ?>
	<?php if ($all_file_uploads->SortUrl($all_file_uploads->File_Name) == "") { ?>
		<td><?php echo $all_file_uploads->File_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $all_file_uploads->SortUrl($all_file_uploads->File_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $all_file_uploads->File_Name->FldCaption() ?></td><td style="width: 10px;"><?php if ($all_file_uploads->File_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($all_file_uploads->File_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($all_file_uploads->Remarks->Visible) { // Remarks ?>
	<?php if ($all_file_uploads->SortUrl($all_file_uploads->Remarks) == "") { ?>
		<td><?php echo $all_file_uploads->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $all_file_uploads->SortUrl($all_file_uploads->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $all_file_uploads->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($all_file_uploads->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($all_file_uploads->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($all_file_uploads->Created->Visible) { // Created ?>
	<?php if ($all_file_uploads->SortUrl($all_file_uploads->Created) == "") { ?>
		<td><?php echo $all_file_uploads->Created->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $all_file_uploads->SortUrl($all_file_uploads->Created) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $all_file_uploads->Created->FldCaption() ?></td><td style="width: 10px;"><?php if ($all_file_uploads->Created->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($all_file_uploads->Created->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($all_file_uploads->Modified->Visible) { // Modified ?>
	<?php if ($all_file_uploads->SortUrl($all_file_uploads->Modified) == "") { ?>
		<td><?php echo $all_file_uploads->Modified->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $all_file_uploads->SortUrl($all_file_uploads->Modified) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $all_file_uploads->Modified->FldCaption() ?></td><td style="width: 10px;"><?php if ($all_file_uploads->Modified->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($all_file_uploads->Modified->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($all_file_uploads->user_id->Visible) { // user_id ?>
	<?php if ($all_file_uploads->SortUrl($all_file_uploads->user_id) == "") { ?>
		<td><?php echo $all_file_uploads->user_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $all_file_uploads->SortUrl($all_file_uploads->user_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $all_file_uploads->user_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($all_file_uploads->user_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($all_file_uploads->user_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($all_file_uploads->file_id->Visible) { // file_id ?>
	<?php if ($all_file_uploads->SortUrl($all_file_uploads->file_id) == "") { ?>
		<td><?php echo $all_file_uploads->file_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $all_file_uploads->SortUrl($all_file_uploads->file_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $all_file_uploads->file_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($all_file_uploads->file_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($all_file_uploads->file_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$all_file_uploads_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($all_file_uploads->ExportAll && $all_file_uploads->Export <> "") {
	$all_file_uploads_list->lStopRec = $all_file_uploads_list->lTotalRecs;
} else {
	$all_file_uploads_list->lStopRec = $all_file_uploads_list->lStartRec + $all_file_uploads_list->lDisplayRecs - 1; // Set the last record to display
}
$all_file_uploads_list->lRecCount = $all_file_uploads_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $all_file_uploads_list->lStartRec > 1)
		$rs->Move($all_file_uploads_list->lStartRec - 1);
}

// Initialize aggregate
$all_file_uploads->RowType = EW_ROWTYPE_AGGREGATEINIT;
$all_file_uploads_list->RenderRow();
$all_file_uploads_list->lRowCnt = 0;
while (($all_file_uploads->CurrentAction == "gridadd" || !$rs->EOF) &&
	$all_file_uploads_list->lRecCount < $all_file_uploads_list->lStopRec) {
	$all_file_uploads_list->lRecCount++;
	if (intval($all_file_uploads_list->lRecCount) >= intval($all_file_uploads_list->lStartRec)) {
		$all_file_uploads_list->lRowCnt++;

	// Init row class and style
	$all_file_uploads->CssClass = "";
	$all_file_uploads->CssStyle = "";
	$all_file_uploads->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($all_file_uploads->CurrentAction == "gridadd") {
		$all_file_uploads_list->LoadDefaultValues(); // Load default values
	} else {
		$all_file_uploads_list->LoadRowValues($rs); // Load row values
	}
	$all_file_uploads->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$all_file_uploads_list->RenderRow();

	// Render list options
	$all_file_uploads_list->RenderListOptions();
?>
	<tr<?php echo $all_file_uploads->RowAttributes() ?>>
<?php

// Render list options (body, left)
$all_file_uploads_list->ListOptions->Render("body", "left");
?>
	<?php if ($all_file_uploads->id->Visible) { // id ?>
		<td<?php echo $all_file_uploads->id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->id->ViewAttributes() ?>><?php echo $all_file_uploads->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($all_file_uploads->module->Visible) { // module ?>
		<td<?php echo $all_file_uploads->module->CellAttributes() ?>>
<div<?php echo $all_file_uploads->module->ViewAttributes() ?>><?php echo $all_file_uploads->module->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($all_file_uploads->File_Name->Visible) { // File_Name ?>
		<td<?php echo $all_file_uploads->File_Name->CellAttributes() ?>>
<?php if ($all_file_uploads->File_Name->HrefValue <> "" || $all_file_uploads->File_Name->TooltipValue <> "") { ?>
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<a href="<?php echo $all_file_uploads->File_Name->HrefValue ?>"><?php echo $all_file_uploads->File_Name->ListViewValue() ?></a>
<?php } elseif (!in_array($all_file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<?php echo $all_file_uploads->File_Name->ListViewValue() ?>
<?php } elseif (!in_array($all_file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($all_file_uploads->Remarks->Visible) { // Remarks ?>
		<td<?php echo $all_file_uploads->Remarks->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Remarks->ViewAttributes() ?>><?php echo $all_file_uploads->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($all_file_uploads->Created->Visible) { // Created ?>
		<td<?php echo $all_file_uploads->Created->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Created->ViewAttributes() ?>><?php echo $all_file_uploads->Created->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($all_file_uploads->Modified->Visible) { // Modified ?>
		<td<?php echo $all_file_uploads->Modified->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Modified->ViewAttributes() ?>><?php echo $all_file_uploads->Modified->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($all_file_uploads->user_id->Visible) { // user_id ?>
		<td<?php echo $all_file_uploads->user_id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->user_id->ViewAttributes() ?>><?php echo $all_file_uploads->user_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($all_file_uploads->file_id->Visible) { // file_id ?>
		<td<?php echo $all_file_uploads->file_id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->file_id->ViewAttributes() ?>><?php echo $all_file_uploads->file_id->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$all_file_uploads_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($all_file_uploads->CurrentAction <> "gridadd")
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
<?php if ($all_file_uploads_list->lTotalRecs > 0) { ?>
<?php if ($all_file_uploads->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($all_file_uploads->CurrentAction <> "gridadd" && $all_file_uploads->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($all_file_uploads_list->Pager)) $all_file_uploads_list->Pager = new cPrevNextPager($all_file_uploads_list->lStartRec, $all_file_uploads_list->lDisplayRecs, $all_file_uploads_list->lTotalRecs) ?>
<?php if ($all_file_uploads_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($all_file_uploads_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $all_file_uploads_list->PageUrl() ?>start=<?php echo $all_file_uploads_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($all_file_uploads_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $all_file_uploads_list->PageUrl() ?>start=<?php echo $all_file_uploads_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $all_file_uploads_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($all_file_uploads_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $all_file_uploads_list->PageUrl() ?>start=<?php echo $all_file_uploads_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($all_file_uploads_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $all_file_uploads_list->PageUrl() ?>start=<?php echo $all_file_uploads_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $all_file_uploads_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $all_file_uploads_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $all_file_uploads_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $all_file_uploads_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($all_file_uploads_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($all_file_uploads_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="all_file_uploads">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($all_file_uploads_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($all_file_uploads_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($all_file_uploads_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($all_file_uploads_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($all_file_uploads_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($all_file_uploads_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($all_file_uploads->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($all_file_uploads_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $all_file_uploads_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($all_file_uploads_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fall_file_uploadslist, '<?php echo $all_file_uploads_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($all_file_uploads->Export == "" && $all_file_uploads->CurrentAction == "") { ?>
<?php } ?>
<?php if ($all_file_uploads->Export == "") { ?>
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
$all_file_uploads_list->Page_Terminate();
?>
<?php

//
// Page class
//
class call_file_uploads_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'all_file_uploads';

	// Page object name
	var $PageObjName = 'all_file_uploads_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $all_file_uploads;
		if ($all_file_uploads->UseTokenInUrl) $PageUrl .= "t=" . $all_file_uploads->TableVar . "&"; // Add page token
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
		global $objForm, $all_file_uploads;
		if ($all_file_uploads->UseTokenInUrl) {
			if ($objForm)
				return ($all_file_uploads->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($all_file_uploads->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function call_file_uploads_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (all_file_uploads)
		$GLOBALS["all_file_uploads"] = new call_file_uploads();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["all_file_uploads"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "all_file_uploadsdelete.php";
		$this->MultiUpdateUrl = "all_file_uploadsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'all_file_uploads', TRUE);

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
		global $all_file_uploads;

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
			$all_file_uploads->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$all_file_uploads->Export = $_POST["exporttype"];
		} else {
			$all_file_uploads->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $all_file_uploads->Export; // Get export parameter, used in header
		$gsExportFile = $all_file_uploads->TableVar; // Get export file, used in header
		if ($all_file_uploads->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $all_file_uploads;

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

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$all_file_uploads->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($all_file_uploads->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $all_file_uploads->getRecordsPerPage(); // Restore from Session
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
		$all_file_uploads->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$all_file_uploads->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$all_file_uploads->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $all_file_uploads->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $all_file_uploads->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $all_file_uploads->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($all_file_uploads->getMasterFilter() <> "" && $all_file_uploads->getCurrentMasterTable() == "account_payments") {
			global $account_payments;
			$rsmaster = $account_payments->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$all_file_uploads->setMasterFilter(""); // Clear master filter
				$all_file_uploads->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($all_file_uploads->getReturnUrl()); // Return to caller
			} else {
				$account_payments->LoadListRowValues($rsmaster);
				$account_payments->RowType = EW_ROWTYPE_MASTER; // Master row
				$account_payments->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$all_file_uploads->setSessionWhere($sFilter);
		$all_file_uploads->CurrentFilter = "";

		// Export data only
		if (in_array($all_file_uploads->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($all_file_uploads->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $all_file_uploads;
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
			$all_file_uploads->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $all_file_uploads;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $all_file_uploads->module, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $all_file_uploads->File_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $all_file_uploads->Remarks, $Keyword);
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
		global $Security, $all_file_uploads;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $all_file_uploads->BasicSearchKeyword;
		$sSearchType = $all_file_uploads->BasicSearchType;
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
			$all_file_uploads->setSessionBasicSearchKeyword($sSearchKeyword);
			$all_file_uploads->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $all_file_uploads;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$all_file_uploads->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $all_file_uploads;
		$all_file_uploads->setSessionBasicSearchKeyword("");
		$all_file_uploads->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $all_file_uploads;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$all_file_uploads->BasicSearchKeyword = $all_file_uploads->getSessionBasicSearchKeyword();
			$all_file_uploads->BasicSearchType = $all_file_uploads->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $all_file_uploads;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$all_file_uploads->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$all_file_uploads->CurrentOrderType = @$_GET["ordertype"];
			$all_file_uploads->UpdateSort($all_file_uploads->id); // id
			$all_file_uploads->UpdateSort($all_file_uploads->module); // module
			$all_file_uploads->UpdateSort($all_file_uploads->File_Name); // File_Name
			$all_file_uploads->UpdateSort($all_file_uploads->Remarks); // Remarks
			$all_file_uploads->UpdateSort($all_file_uploads->Created); // Created
			$all_file_uploads->UpdateSort($all_file_uploads->Modified); // Modified
			$all_file_uploads->UpdateSort($all_file_uploads->user_id); // user_id
			$all_file_uploads->UpdateSort($all_file_uploads->file_id); // file_id
			$all_file_uploads->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $all_file_uploads;
		$sOrderBy = $all_file_uploads->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($all_file_uploads->SqlOrderBy() <> "") {
				$sOrderBy = $all_file_uploads->SqlOrderBy();
				$all_file_uploads->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $all_file_uploads;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$all_file_uploads->getCurrentMasterTable = ""; // Clear master table
				$all_file_uploads->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$all_file_uploads->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$all_file_uploads->file_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$all_file_uploads->setSessionOrderBy($sOrderBy);
				$all_file_uploads->id->setSort("");
				$all_file_uploads->module->setSort("");
				$all_file_uploads->File_Name->setSort("");
				$all_file_uploads->Remarks->setSort("");
				$all_file_uploads->Created->setSort("");
				$all_file_uploads->Modified->setSort("");
				$all_file_uploads->user_id->setSort("");
				$all_file_uploads->file_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $all_file_uploads;

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

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"all_file_uploads_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($all_file_uploads->Export <> "" ||
			$all_file_uploads->CurrentAction == "gridadd" ||
			$all_file_uploads->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $all_file_uploads;
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

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($all_file_uploads->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $all_file_uploads;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $all_file_uploads;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$all_file_uploads->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$all_file_uploads->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $all_file_uploads->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $all_file_uploads;
		$all_file_uploads->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$all_file_uploads->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $all_file_uploads;

		// Call Recordset Selecting event
		$all_file_uploads->Recordset_Selecting($all_file_uploads->CurrentFilter);

		// Load List page SQL
		$sSql = $all_file_uploads->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$all_file_uploads->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $all_file_uploads;
		$sFilter = $all_file_uploads->KeyFilter();

		// Call Row Selecting event
		$all_file_uploads->Row_Selecting($sFilter);

		// Load SQL based on filter
		$all_file_uploads->CurrentFilter = $sFilter;
		$sSql = $all_file_uploads->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$all_file_uploads->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $all_file_uploads;
		$all_file_uploads->id->setDbValue($rs->fields('id'));
		$all_file_uploads->module->setDbValue($rs->fields('module'));
		$all_file_uploads->File_Name->Upload->DbValue = $rs->fields('File_Name');
		$all_file_uploads->Remarks->setDbValue($rs->fields('Remarks'));
		$all_file_uploads->Created->setDbValue($rs->fields('Created'));
		$all_file_uploads->Modified->setDbValue($rs->fields('Modified'));
		$all_file_uploads->user_id->setDbValue($rs->fields('user_id'));
		$all_file_uploads->file_id->setDbValue($rs->fields('file_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $all_file_uploads;

		// Initialize URLs
		$this->ViewUrl = $all_file_uploads->ViewUrl();
		$this->EditUrl = $all_file_uploads->EditUrl();
		$this->InlineEditUrl = $all_file_uploads->InlineEditUrl();
		$this->CopyUrl = $all_file_uploads->CopyUrl();
		$this->InlineCopyUrl = $all_file_uploads->InlineCopyUrl();
		$this->DeleteUrl = $all_file_uploads->DeleteUrl();

		// Call Row_Rendering event
		$all_file_uploads->Row_Rendering();

		// Common render codes for all row types
		// id

		$all_file_uploads->id->CellCssStyle = ""; $all_file_uploads->id->CellCssClass = "";
		$all_file_uploads->id->CellAttrs = array(); $all_file_uploads->id->ViewAttrs = array(); $all_file_uploads->id->EditAttrs = array();

		// module
		$all_file_uploads->module->CellCssStyle = ""; $all_file_uploads->module->CellCssClass = "";
		$all_file_uploads->module->CellAttrs = array(); $all_file_uploads->module->ViewAttrs = array(); $all_file_uploads->module->EditAttrs = array();

		// File_Name
		$all_file_uploads->File_Name->CellCssStyle = ""; $all_file_uploads->File_Name->CellCssClass = "";
		$all_file_uploads->File_Name->CellAttrs = array(); $all_file_uploads->File_Name->ViewAttrs = array(); $all_file_uploads->File_Name->EditAttrs = array();

		// Remarks
		$all_file_uploads->Remarks->CellCssStyle = ""; $all_file_uploads->Remarks->CellCssClass = "";
		$all_file_uploads->Remarks->CellAttrs = array(); $all_file_uploads->Remarks->ViewAttrs = array(); $all_file_uploads->Remarks->EditAttrs = array();

		// Created
		$all_file_uploads->Created->CellCssStyle = ""; $all_file_uploads->Created->CellCssClass = "";
		$all_file_uploads->Created->CellAttrs = array(); $all_file_uploads->Created->ViewAttrs = array(); $all_file_uploads->Created->EditAttrs = array();

		// Modified
		$all_file_uploads->Modified->CellCssStyle = ""; $all_file_uploads->Modified->CellCssClass = "";
		$all_file_uploads->Modified->CellAttrs = array(); $all_file_uploads->Modified->ViewAttrs = array(); $all_file_uploads->Modified->EditAttrs = array();

		// user_id
		$all_file_uploads->user_id->CellCssStyle = ""; $all_file_uploads->user_id->CellCssClass = "";
		$all_file_uploads->user_id->CellAttrs = array(); $all_file_uploads->user_id->ViewAttrs = array(); $all_file_uploads->user_id->EditAttrs = array();

		// file_id
		$all_file_uploads->file_id->CellCssStyle = ""; $all_file_uploads->file_id->CellCssClass = "";
		$all_file_uploads->file_id->CellAttrs = array(); $all_file_uploads->file_id->ViewAttrs = array(); $all_file_uploads->file_id->EditAttrs = array();
		if ($all_file_uploads->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$all_file_uploads->id->ViewValue = $all_file_uploads->id->CurrentValue;
			$all_file_uploads->id->CssStyle = "";
			$all_file_uploads->id->CssClass = "";
			$all_file_uploads->id->ViewCustomAttributes = "";

			// module
			$all_file_uploads->module->ViewValue = $all_file_uploads->module->CurrentValue;
			$all_file_uploads->module->CssStyle = "";
			$all_file_uploads->module->CssClass = "";
			$all_file_uploads->module->ViewCustomAttributes = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->ViewValue = $all_file_uploads->File_Name->Upload->DbValue;
			} else {
				$all_file_uploads->File_Name->ViewValue = "";
			}
			$all_file_uploads->File_Name->CssStyle = "";
			$all_file_uploads->File_Name->CssClass = "";
			$all_file_uploads->File_Name->ViewCustomAttributes = "";

			// Remarks
			$all_file_uploads->Remarks->ViewValue = $all_file_uploads->Remarks->CurrentValue;
			$all_file_uploads->Remarks->CssStyle = "";
			$all_file_uploads->Remarks->CssClass = "";
			$all_file_uploads->Remarks->ViewCustomAttributes = "";

			// Created
			$all_file_uploads->Created->ViewValue = $all_file_uploads->Created->CurrentValue;
			$all_file_uploads->Created->ViewValue = ew_FormatDateTime($all_file_uploads->Created->ViewValue, 6);
			$all_file_uploads->Created->CssStyle = "";
			$all_file_uploads->Created->CssClass = "";
			$all_file_uploads->Created->ViewCustomAttributes = "";

			// Modified
			$all_file_uploads->Modified->ViewValue = $all_file_uploads->Modified->CurrentValue;
			$all_file_uploads->Modified->ViewValue = ew_FormatDateTime($all_file_uploads->Modified->ViewValue, 6);
			$all_file_uploads->Modified->CssStyle = "";
			$all_file_uploads->Modified->CssClass = "";
			$all_file_uploads->Modified->ViewCustomAttributes = "";

			// user_id
			$all_file_uploads->user_id->ViewValue = $all_file_uploads->user_id->CurrentValue;
			$all_file_uploads->user_id->CssStyle = "";
			$all_file_uploads->user_id->CssClass = "";
			$all_file_uploads->user_id->ViewCustomAttributes = "";

			// file_id
			$all_file_uploads->file_id->ViewValue = $all_file_uploads->file_id->CurrentValue;
			$all_file_uploads->file_id->CssStyle = "";
			$all_file_uploads->file_id->CssClass = "";
			$all_file_uploads->file_id->ViewCustomAttributes = "";

			// id
			$all_file_uploads->id->HrefValue = "";
			$all_file_uploads->id->TooltipValue = "";

			// module
			$all_file_uploads->module->HrefValue = "";
			$all_file_uploads->module->TooltipValue = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->HrefValue = ew_UploadPathEx(FALSE, $all_file_uploads->File_Name->UploadPath) . ((!empty($all_file_uploads->File_Name->ViewValue)) ? $all_file_uploads->File_Name->ViewValue : $all_file_uploads->File_Name->CurrentValue);
				if ($all_file_uploads->Export <> "") $all_file_uploads->File_Name->HrefValue = ew_ConvertFullUrl($all_file_uploads->File_Name->HrefValue);
			} else {
				$all_file_uploads->File_Name->HrefValue = "";
			}
			$all_file_uploads->File_Name->TooltipValue = "";

			// Remarks
			$all_file_uploads->Remarks->HrefValue = "";
			$all_file_uploads->Remarks->TooltipValue = "";

			// Created
			$all_file_uploads->Created->HrefValue = "";
			$all_file_uploads->Created->TooltipValue = "";

			// Modified
			$all_file_uploads->Modified->HrefValue = "";
			$all_file_uploads->Modified->TooltipValue = "";

			// user_id
			$all_file_uploads->user_id->HrefValue = "";
			$all_file_uploads->user_id->TooltipValue = "";

			// file_id
			$all_file_uploads->file_id->HrefValue = "";
			$all_file_uploads->file_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($all_file_uploads->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$all_file_uploads->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $all_file_uploads;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $all_file_uploads->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($all_file_uploads->ExportAll) {
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
		if ($all_file_uploads->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($all_file_uploads, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($all_file_uploads->id);
				$ExportDoc->ExportCaption($all_file_uploads->module);
				$ExportDoc->ExportCaption($all_file_uploads->File_Name);
				$ExportDoc->ExportCaption($all_file_uploads->Remarks);
				$ExportDoc->ExportCaption($all_file_uploads->Created);
				$ExportDoc->ExportCaption($all_file_uploads->Modified);
				$ExportDoc->ExportCaption($all_file_uploads->user_id);
				$ExportDoc->ExportCaption($all_file_uploads->file_id);
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
				$all_file_uploads->CssClass = "";
				$all_file_uploads->CssStyle = "";
				$all_file_uploads->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($all_file_uploads->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $all_file_uploads->id->ExportValue($all_file_uploads->Export, $all_file_uploads->ExportOriginalValue));
					$XmlDoc->AddField('module', $all_file_uploads->module->ExportValue($all_file_uploads->Export, $all_file_uploads->ExportOriginalValue));
					$XmlDoc->AddField('File_Name', $all_file_uploads->File_Name->ExportValue($all_file_uploads->Export, $all_file_uploads->ExportOriginalValue));
					$XmlDoc->AddField('Remarks', $all_file_uploads->Remarks->ExportValue($all_file_uploads->Export, $all_file_uploads->ExportOriginalValue));
					$XmlDoc->AddField('Created', $all_file_uploads->Created->ExportValue($all_file_uploads->Export, $all_file_uploads->ExportOriginalValue));
					$XmlDoc->AddField('Modified', $all_file_uploads->Modified->ExportValue($all_file_uploads->Export, $all_file_uploads->ExportOriginalValue));
					$XmlDoc->AddField('user_id', $all_file_uploads->user_id->ExportValue($all_file_uploads->Export, $all_file_uploads->ExportOriginalValue));
					$XmlDoc->AddField('file_id', $all_file_uploads->file_id->ExportValue($all_file_uploads->Export, $all_file_uploads->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($all_file_uploads->id);
					$ExportDoc->ExportField($all_file_uploads->module);
					$ExportDoc->ExportField($all_file_uploads->File_Name);
					$ExportDoc->ExportField($all_file_uploads->Remarks);
					$ExportDoc->ExportField($all_file_uploads->Created);
					$ExportDoc->ExportField($all_file_uploads->Modified);
					$ExportDoc->ExportField($all_file_uploads->user_id);
					$ExportDoc->ExportField($all_file_uploads->file_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($all_file_uploads->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($all_file_uploads->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($all_file_uploads->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($all_file_uploads->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($all_file_uploads->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $all_file_uploads;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "account_payments") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $all_file_uploads->SqlMasterFilter_account_payments();
				$this->sDbDetailFilter = $all_file_uploads->SqlDetailFilter_account_payments();
				if (@$_GET["id"] <> "") {
					$GLOBALS["account_payments"]->id->setQueryStringValue($_GET["id"]);
					$all_file_uploads->file_id->setQueryStringValue($GLOBALS["account_payments"]->id->QueryStringValue);
					$all_file_uploads->file_id->setSessionValue($all_file_uploads->file_id->QueryStringValue);
					if (!is_numeric($GLOBALS["account_payments"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["account_payments"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@file_id@", ew_AdjustSql($GLOBALS["account_payments"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$all_file_uploads->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$all_file_uploads->setStartRecordNumber($this->lStartRec);
			$all_file_uploads->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$all_file_uploads->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "account_payments") {
				if ($all_file_uploads->file_id->QueryStringValue == "") $all_file_uploads->file_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $all_file_uploads->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $all_file_uploads->getDetailFilter(); // Restore detail filter
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
