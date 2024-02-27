<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "vendor_bill_itemsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "vendor_billinfo.php" ?>
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
$vendor_bill_items_list = new cvendor_bill_items_list();
$Page =& $vendor_bill_items_list;

// Page init
$vendor_bill_items_list->Page_Init();

// Page main
$vendor_bill_items_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($vendor_bill_items->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var vendor_bill_items_list = new ew_Page("vendor_bill_items_list");

// page properties
vendor_bill_items_list.PageID = "list"; // page ID
vendor_bill_items_list.FormID = "fvendor_bill_itemslist"; // form ID
var EW_PAGE_ID = vendor_bill_items_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
vendor_bill_items_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
vendor_bill_items_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
vendor_bill_items_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
vendor_bill_items_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
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
<?php if ($vendor_bill_items->Export == "") { ?>
<?php
$gsMasterReturnUrl = "vendor_billlist.php";
if ($vendor_bill_items_list->sDbMasterFilter <> "" && $vendor_bill_items->getCurrentMasterTable() == "vendor_bill") {
	if ($vendor_bill_items_list->bMasterRecordExists) {
		if ($vendor_bill_items->getCurrentMasterTable() == $vendor_bill_items->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "vendor_billmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$vendor_bill_items_list->lTotalRecs = $vendor_bill_items->SelectRecordCount();
	} else {
		if ($rs = $vendor_bill_items_list->LoadRecordset())
			$vendor_bill_items_list->lTotalRecs = $rs->RecordCount();
	}
	$vendor_bill_items_list->lStartRec = 1;
	if ($vendor_bill_items_list->lDisplayRecs <= 0 || ($vendor_bill_items->Export <> "" && $vendor_bill_items->ExportAll)) // Display all records
		$vendor_bill_items_list->lDisplayRecs = $vendor_bill_items_list->lTotalRecs;
	if (!($vendor_bill_items->Export <> "" && $vendor_bill_items->ExportAll))
		$vendor_bill_items_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $vendor_bill_items_list->LoadRecordset($vendor_bill_items_list->lStartRec-1, $vendor_bill_items_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $vendor_bill_items->TableCaption() ?>
<?php if ($vendor_bill_items->Export == "" && $vendor_bill_items->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $vendor_bill_items_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $vendor_bill_items_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $vendor_bill_items_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($vendor_bill_items->Export == "" && $vendor_bill_items->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(vendor_bill_items_list);" style="text-decoration: none;"><img id="vendor_bill_items_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="vendor_bill_items_list_SearchPanel">
<form name="fvendor_bill_itemslistsrch" id="fvendor_bill_itemslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="vendor_bill_items">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($vendor_bill_items->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $vendor_bill_items_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($vendor_bill_items->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($vendor_bill_items->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($vendor_bill_items->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$vendor_bill_items_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($vendor_bill_items->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($vendor_bill_items->CurrentAction <> "gridadd" && $vendor_bill_items->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($vendor_bill_items_list->Pager)) $vendor_bill_items_list->Pager = new cPrevNextPager($vendor_bill_items_list->lStartRec, $vendor_bill_items_list->lDisplayRecs, $vendor_bill_items_list->lTotalRecs) ?>
<?php if ($vendor_bill_items_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($vendor_bill_items_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_items_list->PageUrl() ?>start=<?php echo $vendor_bill_items_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($vendor_bill_items_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_items_list->PageUrl() ?>start=<?php echo $vendor_bill_items_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $vendor_bill_items_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($vendor_bill_items_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_items_list->PageUrl() ?>start=<?php echo $vendor_bill_items_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($vendor_bill_items_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_items_list->PageUrl() ?>start=<?php echo $vendor_bill_items_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vendor_bill_items_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vendor_bill_items_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vendor_bill_items_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vendor_bill_items_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($vendor_bill_items_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($vendor_bill_items_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="vendor_bill_items">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($vendor_bill_items_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($vendor_bill_items_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($vendor_bill_items_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($vendor_bill_items_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($vendor_bill_items_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($vendor_bill_items_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($vendor_bill_items->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $vendor_bill_items_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($vendor_bill_items_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fvendor_bill_itemslist, '<?php echo $vendor_bill_items_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fvendor_bill_itemslist" id="fvendor_bill_itemslist" class="ewForm" action="" method="post">
<div id="gmp_vendor_bill_items" class="ewGridMiddlePanel">
<?php if ($vendor_bill_items_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $vendor_bill_items->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$vendor_bill_items_list->RenderListOptions();

// Render list options (header, left)
$vendor_bill_items_list->ListOptions->Render("header", "left");
?>
<?php if ($vendor_bill_items->id->Visible) { // id ?>
	<?php if ($vendor_bill_items->SortUrl($vendor_bill_items->id) == "") { ?>
		<td><?php echo $vendor_bill_items->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill_items->SortUrl($vendor_bill_items->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill_items->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill_items->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill_items->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill_items->vendor_bill_id->Visible) { // vendor_bill_id ?>
	<?php if ($vendor_bill_items->SortUrl($vendor_bill_items->vendor_bill_id) == "") { ?>
		<td><?php echo $vendor_bill_items->vendor_bill_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill_items->SortUrl($vendor_bill_items->vendor_bill_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill_items->vendor_bill_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill_items->vendor_bill_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill_items->vendor_bill_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill_items->vendor_id->Visible) { // vendor_id ?>
	<?php if ($vendor_bill_items->SortUrl($vendor_bill_items->vendor_id) == "") { ?>
		<td><?php echo $vendor_bill_items->vendor_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill_items->SortUrl($vendor_bill_items->vendor_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill_items->vendor_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill_items->vendor_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill_items->vendor_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill_items->booking_id->Visible) { // booking_id ?>
	<?php if ($vendor_bill_items->SortUrl($vendor_bill_items->booking_id) == "") { ?>
		<td><?php echo $vendor_bill_items->booking_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill_items->SortUrl($vendor_bill_items->booking_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill_items->booking_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill_items->booking_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill_items->booking_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill_items->remarks->Visible) { // remarks ?>
	<?php if ($vendor_bill_items->SortUrl($vendor_bill_items->remarks) == "") { ?>
		<td><?php echo $vendor_bill_items->remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill_items->SortUrl($vendor_bill_items->remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill_items->remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($vendor_bill_items->remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill_items->remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill_items->user_id->Visible) { // user_id ?>
	<?php if ($vendor_bill_items->SortUrl($vendor_bill_items->user_id) == "") { ?>
		<td><?php echo $vendor_bill_items->user_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill_items->SortUrl($vendor_bill_items->user_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill_items->user_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill_items->user_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill_items->user_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill_items->created->Visible) { // created ?>
	<?php if ($vendor_bill_items->SortUrl($vendor_bill_items->created) == "") { ?>
		<td><?php echo $vendor_bill_items->created->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill_items->SortUrl($vendor_bill_items->created) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill_items->created->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill_items->created->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill_items->created->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill_items->modified->Visible) { // modified ?>
	<?php if ($vendor_bill_items->SortUrl($vendor_bill_items->modified) == "") { ?>
		<td><?php echo $vendor_bill_items->modified->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill_items->SortUrl($vendor_bill_items->modified) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill_items->modified->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill_items->modified->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill_items->modified->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$vendor_bill_items_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($vendor_bill_items->ExportAll && $vendor_bill_items->Export <> "") {
	$vendor_bill_items_list->lStopRec = $vendor_bill_items_list->lTotalRecs;
} else {
	$vendor_bill_items_list->lStopRec = $vendor_bill_items_list->lStartRec + $vendor_bill_items_list->lDisplayRecs - 1; // Set the last record to display
}
$vendor_bill_items_list->lRecCount = $vendor_bill_items_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $vendor_bill_items_list->lStartRec > 1)
		$rs->Move($vendor_bill_items_list->lStartRec - 1);
}

// Initialize aggregate
$vendor_bill_items->RowType = EW_ROWTYPE_AGGREGATEINIT;
$vendor_bill_items_list->RenderRow();
$vendor_bill_items_list->lRowCnt = 0;
while (($vendor_bill_items->CurrentAction == "gridadd" || !$rs->EOF) &&
	$vendor_bill_items_list->lRecCount < $vendor_bill_items_list->lStopRec) {
	$vendor_bill_items_list->lRecCount++;
	if (intval($vendor_bill_items_list->lRecCount) >= intval($vendor_bill_items_list->lStartRec)) {
		$vendor_bill_items_list->lRowCnt++;

	// Init row class and style
	$vendor_bill_items->CssClass = "";
	$vendor_bill_items->CssStyle = "";
	$vendor_bill_items->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($vendor_bill_items->CurrentAction == "gridadd") {
		$vendor_bill_items_list->LoadDefaultValues(); // Load default values
	} else {
		$vendor_bill_items_list->LoadRowValues($rs); // Load row values
	}
	$vendor_bill_items->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$vendor_bill_items_list->RenderRow();

	// Render list options
	$vendor_bill_items_list->RenderListOptions();
?>
	<tr<?php echo $vendor_bill_items->RowAttributes() ?>>
<?php

// Render list options (body, left)
$vendor_bill_items_list->ListOptions->Render("body", "left");
?>
	<?php if ($vendor_bill_items->id->Visible) { // id ?>
		<td<?php echo $vendor_bill_items->id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->id->ViewAttributes() ?>><?php echo $vendor_bill_items->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill_items->vendor_bill_id->Visible) { // vendor_bill_id ?>
		<td<?php echo $vendor_bill_items->vendor_bill_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->vendor_bill_id->ViewAttributes() ?>><?php echo $vendor_bill_items->vendor_bill_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill_items->vendor_id->Visible) { // vendor_id ?>
		<td<?php echo $vendor_bill_items->vendor_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->vendor_id->ViewAttributes() ?>><?php echo $vendor_bill_items->vendor_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill_items->booking_id->Visible) { // booking_id ?>
		<td<?php echo $vendor_bill_items->booking_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->booking_id->ViewAttributes() ?>>
<?php if ($vendor_bill_items->booking_id->HrefValue <> "" || $vendor_bill_items->booking_id->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_id=<?php echo $vendor_bill_items->booking_id->HrefValue ?>"><?php echo $vendor_bill_items->booking_id->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $vendor_bill_items->booking_id->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
	<?php if ($vendor_bill_items->remarks->Visible) { // remarks ?>
		<td<?php echo $vendor_bill_items->remarks->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->remarks->ViewAttributes() ?>><?php echo $vendor_bill_items->remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill_items->user_id->Visible) { // user_id ?>
		<td<?php echo $vendor_bill_items->user_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->user_id->ViewAttributes() ?>><?php echo $vendor_bill_items->user_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill_items->created->Visible) { // created ?>
		<td<?php echo $vendor_bill_items->created->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->created->ViewAttributes() ?>><?php echo $vendor_bill_items->created->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill_items->modified->Visible) { // modified ?>
		<td<?php echo $vendor_bill_items->modified->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->modified->ViewAttributes() ?>><?php echo $vendor_bill_items->modified->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vendor_bill_items_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($vendor_bill_items->CurrentAction <> "gridadd")
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
<?php if ($vendor_bill_items_list->lTotalRecs > 0) { ?>
<?php if ($vendor_bill_items->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($vendor_bill_items->CurrentAction <> "gridadd" && $vendor_bill_items->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($vendor_bill_items_list->Pager)) $vendor_bill_items_list->Pager = new cPrevNextPager($vendor_bill_items_list->lStartRec, $vendor_bill_items_list->lDisplayRecs, $vendor_bill_items_list->lTotalRecs) ?>
<?php if ($vendor_bill_items_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($vendor_bill_items_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_items_list->PageUrl() ?>start=<?php echo $vendor_bill_items_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($vendor_bill_items_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_items_list->PageUrl() ?>start=<?php echo $vendor_bill_items_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $vendor_bill_items_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($vendor_bill_items_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_items_list->PageUrl() ?>start=<?php echo $vendor_bill_items_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($vendor_bill_items_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_items_list->PageUrl() ?>start=<?php echo $vendor_bill_items_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vendor_bill_items_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vendor_bill_items_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vendor_bill_items_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vendor_bill_items_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($vendor_bill_items_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($vendor_bill_items_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="vendor_bill_items">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($vendor_bill_items_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($vendor_bill_items_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($vendor_bill_items_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($vendor_bill_items_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($vendor_bill_items_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($vendor_bill_items_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($vendor_bill_items->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($vendor_bill_items_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $vendor_bill_items_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($vendor_bill_items_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fvendor_bill_itemslist, '<?php echo $vendor_bill_items_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($vendor_bill_items->Export == "" && $vendor_bill_items->CurrentAction == "") { ?>
<?php } ?>
<?php if ($vendor_bill_items->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$vendor_bill_items_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cvendor_bill_items_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'vendor_bill_items';

	// Page object name
	var $PageObjName = 'vendor_bill_items_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $vendor_bill_items;
		if ($vendor_bill_items->UseTokenInUrl) $PageUrl .= "t=" . $vendor_bill_items->TableVar . "&"; // Add page token
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
		global $objForm, $vendor_bill_items;
		if ($vendor_bill_items->UseTokenInUrl) {
			if ($objForm)
				return ($vendor_bill_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($vendor_bill_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cvendor_bill_items_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (vendor_bill_items)
		$GLOBALS["vendor_bill_items"] = new cvendor_bill_items();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["vendor_bill_items"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "vendor_bill_itemsdelete.php";
		$this->MultiUpdateUrl = "vendor_bill_itemsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (vendor_bill)
		$GLOBALS['vendor_bill'] = new cvendor_bill();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'vendor_bill_items', TRUE);

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
		global $vendor_bill_items;

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
			$vendor_bill_items->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$vendor_bill_items->Export = $_POST["exporttype"];
		} else {
			$vendor_bill_items->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $vendor_bill_items->Export; // Get export parameter, used in header
		$gsExportFile = $vendor_bill_items->TableVar; // Get export file, used in header
		if ($vendor_bill_items->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $vendor_bill_items;

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
			$vendor_bill_items->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($vendor_bill_items->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $vendor_bill_items->getRecordsPerPage(); // Restore from Session
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
		$vendor_bill_items->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$vendor_bill_items->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$vendor_bill_items->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $vendor_bill_items->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $vendor_bill_items->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $vendor_bill_items->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($vendor_bill_items->getMasterFilter() <> "" && $vendor_bill_items->getCurrentMasterTable() == "vendor_bill") {
			global $vendor_bill;
			$rsmaster = $vendor_bill->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$vendor_bill_items->setMasterFilter(""); // Clear master filter
				$vendor_bill_items->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($vendor_bill_items->getReturnUrl()); // Return to caller
			} else {
				$vendor_bill->LoadListRowValues($rsmaster);
				$vendor_bill->RowType = EW_ROWTYPE_MASTER; // Master row
				$vendor_bill->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$vendor_bill_items->setSessionWhere($sFilter);
		$vendor_bill_items->CurrentFilter = "";

		// Export data only
		if (in_array($vendor_bill_items->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($vendor_bill_items->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $vendor_bill_items;
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
			$vendor_bill_items->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $vendor_bill_items;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $vendor_bill_items->remarks, $Keyword);
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
		global $Security, $vendor_bill_items;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $vendor_bill_items->BasicSearchKeyword;
		$sSearchType = $vendor_bill_items->BasicSearchType;
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
			$vendor_bill_items->setSessionBasicSearchKeyword($sSearchKeyword);
			$vendor_bill_items->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $vendor_bill_items;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$vendor_bill_items->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $vendor_bill_items;
		$vendor_bill_items->setSessionBasicSearchKeyword("");
		$vendor_bill_items->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $vendor_bill_items;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$vendor_bill_items->BasicSearchKeyword = $vendor_bill_items->getSessionBasicSearchKeyword();
			$vendor_bill_items->BasicSearchType = $vendor_bill_items->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $vendor_bill_items;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$vendor_bill_items->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$vendor_bill_items->CurrentOrderType = @$_GET["ordertype"];
			$vendor_bill_items->UpdateSort($vendor_bill_items->id); // id
			$vendor_bill_items->UpdateSort($vendor_bill_items->vendor_bill_id); // vendor_bill_id
			$vendor_bill_items->UpdateSort($vendor_bill_items->vendor_id); // vendor_id
			$vendor_bill_items->UpdateSort($vendor_bill_items->booking_id); // booking_id
			$vendor_bill_items->UpdateSort($vendor_bill_items->remarks); // remarks
			$vendor_bill_items->UpdateSort($vendor_bill_items->user_id); // user_id
			$vendor_bill_items->UpdateSort($vendor_bill_items->created); // created
			$vendor_bill_items->UpdateSort($vendor_bill_items->modified); // modified
			$vendor_bill_items->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $vendor_bill_items;
		$sOrderBy = $vendor_bill_items->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($vendor_bill_items->SqlOrderBy() <> "") {
				$sOrderBy = $vendor_bill_items->SqlOrderBy();
				$vendor_bill_items->setSessionOrderBy($sOrderBy);
				$vendor_bill_items->id->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $vendor_bill_items;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$vendor_bill_items->getCurrentMasterTable = ""; // Clear master table
				$vendor_bill_items->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$vendor_bill_items->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$vendor_bill_items->vendor_bill_id->setSessionValue("");
				$vendor_bill_items->vendor_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$vendor_bill_items->setSessionOrderBy($sOrderBy);
				$vendor_bill_items->id->setSort("");
				$vendor_bill_items->vendor_bill_id->setSort("");
				$vendor_bill_items->vendor_id->setSort("");
				$vendor_bill_items->booking_id->setSort("");
				$vendor_bill_items->remarks->setSort("");
				$vendor_bill_items->user_id->setSort("");
				$vendor_bill_items->created->setSort("");
				$vendor_bill_items->modified->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $vendor_bill_items;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"vendor_bill_items_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($vendor_bill_items->Export <> "" ||
			$vendor_bill_items->CurrentAction == "gridadd" ||
			$vendor_bill_items->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $vendor_bill_items;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($vendor_bill_items->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $vendor_bill_items;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $vendor_bill_items;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$vendor_bill_items->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$vendor_bill_items->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $vendor_bill_items->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $vendor_bill_items;
		$vendor_bill_items->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$vendor_bill_items->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $vendor_bill_items;

		// Call Recordset Selecting event
		$vendor_bill_items->Recordset_Selecting($vendor_bill_items->CurrentFilter);

		// Load List page SQL
		$sSql = $vendor_bill_items->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$vendor_bill_items->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $vendor_bill_items;
		$sFilter = $vendor_bill_items->KeyFilter();

		// Call Row Selecting event
		$vendor_bill_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$vendor_bill_items->CurrentFilter = $sFilter;
		$sSql = $vendor_bill_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$vendor_bill_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $vendor_bill_items;
		$vendor_bill_items->id->setDbValue($rs->fields('id'));
		$vendor_bill_items->vendor_bill_id->setDbValue($rs->fields('vendor_bill_id'));
		$vendor_bill_items->vendor_id->setDbValue($rs->fields('vendor_id'));
		$vendor_bill_items->booking_id->setDbValue($rs->fields('booking_id'));
		$vendor_bill_items->remarks->setDbValue($rs->fields('remarks'));
		$vendor_bill_items->user_id->setDbValue($rs->fields('user_id'));
		$vendor_bill_items->created->setDbValue($rs->fields('created'));
		$vendor_bill_items->modified->setDbValue($rs->fields('modified'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $vendor_bill_items;

		// Initialize URLs
		$this->ViewUrl = $vendor_bill_items->ViewUrl();
		$this->EditUrl = $vendor_bill_items->EditUrl();
		$this->InlineEditUrl = $vendor_bill_items->InlineEditUrl();
		$this->CopyUrl = $vendor_bill_items->CopyUrl();
		$this->InlineCopyUrl = $vendor_bill_items->InlineCopyUrl();
		$this->DeleteUrl = $vendor_bill_items->DeleteUrl();

		// Call Row_Rendering event
		$vendor_bill_items->Row_Rendering();

		// Common render codes for all row types
		// id

		$vendor_bill_items->id->CellCssStyle = ""; $vendor_bill_items->id->CellCssClass = "";
		$vendor_bill_items->id->CellAttrs = array(); $vendor_bill_items->id->ViewAttrs = array(); $vendor_bill_items->id->EditAttrs = array();

		// vendor_bill_id
		$vendor_bill_items->vendor_bill_id->CellCssStyle = ""; $vendor_bill_items->vendor_bill_id->CellCssClass = "";
		$vendor_bill_items->vendor_bill_id->CellAttrs = array(); $vendor_bill_items->vendor_bill_id->ViewAttrs = array(); $vendor_bill_items->vendor_bill_id->EditAttrs = array();

		// vendor_id
		$vendor_bill_items->vendor_id->CellCssStyle = ""; $vendor_bill_items->vendor_id->CellCssClass = "";
		$vendor_bill_items->vendor_id->CellAttrs = array(); $vendor_bill_items->vendor_id->ViewAttrs = array(); $vendor_bill_items->vendor_id->EditAttrs = array();

		// booking_id
		$vendor_bill_items->booking_id->CellCssStyle = ""; $vendor_bill_items->booking_id->CellCssClass = "";
		$vendor_bill_items->booking_id->CellAttrs = array(); $vendor_bill_items->booking_id->ViewAttrs = array(); $vendor_bill_items->booking_id->EditAttrs = array();

		// remarks
		$vendor_bill_items->remarks->CellCssStyle = ""; $vendor_bill_items->remarks->CellCssClass = "";
		$vendor_bill_items->remarks->CellAttrs = array(); $vendor_bill_items->remarks->ViewAttrs = array(); $vendor_bill_items->remarks->EditAttrs = array();

		// user_id
		$vendor_bill_items->user_id->CellCssStyle = ""; $vendor_bill_items->user_id->CellCssClass = "";
		$vendor_bill_items->user_id->CellAttrs = array(); $vendor_bill_items->user_id->ViewAttrs = array(); $vendor_bill_items->user_id->EditAttrs = array();

		// created
		$vendor_bill_items->created->CellCssStyle = ""; $vendor_bill_items->created->CellCssClass = "";
		$vendor_bill_items->created->CellAttrs = array(); $vendor_bill_items->created->ViewAttrs = array(); $vendor_bill_items->created->EditAttrs = array();

		// modified
		$vendor_bill_items->modified->CellCssStyle = ""; $vendor_bill_items->modified->CellCssClass = "";
		$vendor_bill_items->modified->CellAttrs = array(); $vendor_bill_items->modified->ViewAttrs = array(); $vendor_bill_items->modified->EditAttrs = array();
		if ($vendor_bill_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$vendor_bill_items->id->ViewValue = $vendor_bill_items->id->CurrentValue;
			$vendor_bill_items->id->CssStyle = "";
			$vendor_bill_items->id->CssClass = "";
			$vendor_bill_items->id->ViewCustomAttributes = "";

			// vendor_bill_id
			if (strval($vendor_bill_items->vendor_bill_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_bill_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `vendor_Number` FROM `vendor_bill`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `vendor_Number`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->vendor_bill_id->ViewValue = $rswrk->fields('vendor_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_bill_id->ViewValue = $vendor_bill_items->vendor_bill_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_bill_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_bill_id->CssStyle = "";
			$vendor_bill_items->vendor_bill_id->CssClass = "";
			$vendor_bill_items->vendor_bill_id->ViewCustomAttributes = "";

			// vendor_id
			if (strval($vendor_bill_items->vendor_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_id->CurrentValue) . "";
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
					$vendor_bill_items->vendor_id->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_id->ViewValue = $vendor_bill_items->vendor_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_id->CssStyle = "";
			$vendor_bill_items->vendor_id->CssClass = "";
			$vendor_bill_items->vendor_id->ViewCustomAttributes = "";

			// booking_id
			if (strval($vendor_bill_items->booking_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->booking_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Subcon_ID`=" . $vendor_bill_items->vendor_id->CurrentValue . " AND `billing_type_id`=" . 8 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->booking_id->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->booking_id->ViewValue = $vendor_bill_items->booking_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->booking_id->ViewValue = NULL;
			}
			$vendor_bill_items->booking_id->CssStyle = "";
			$vendor_bill_items->booking_id->CssClass = "";
			$vendor_bill_items->booking_id->ViewCustomAttributes = "";

			// remarks
			$vendor_bill_items->remarks->ViewValue = $vendor_bill_items->remarks->CurrentValue;
			$vendor_bill_items->remarks->CssStyle = "";
			$vendor_bill_items->remarks->CssClass = "";
			$vendor_bill_items->remarks->ViewCustomAttributes = "";

			// user_id
			$vendor_bill_items->user_id->ViewValue = $vendor_bill_items->user_id->CurrentValue;
			$vendor_bill_items->user_id->CssStyle = "";
			$vendor_bill_items->user_id->CssClass = "";
			$vendor_bill_items->user_id->ViewCustomAttributes = "";

			// created
			$vendor_bill_items->created->ViewValue = $vendor_bill_items->created->CurrentValue;
			$vendor_bill_items->created->ViewValue = ew_FormatDateTime($vendor_bill_items->created->ViewValue, 6);
			$vendor_bill_items->created->CssStyle = "";
			$vendor_bill_items->created->CssClass = "";
			$vendor_bill_items->created->ViewCustomAttributes = "";

			// modified
			$vendor_bill_items->modified->ViewValue = $vendor_bill_items->modified->CurrentValue;
			$vendor_bill_items->modified->ViewValue = ew_FormatDateTime($vendor_bill_items->modified->ViewValue, 6);
			$vendor_bill_items->modified->CssStyle = "";
			$vendor_bill_items->modified->CssClass = "";
			$vendor_bill_items->modified->ViewCustomAttributes = "";

			// id
			$vendor_bill_items->id->HrefValue = "";
			$vendor_bill_items->id->TooltipValue = "";

			// vendor_bill_id
			$vendor_bill_items->vendor_bill_id->HrefValue = "";
			$vendor_bill_items->vendor_bill_id->TooltipValue = "";

			// vendor_id
			$vendor_bill_items->vendor_id->HrefValue = "";
			$vendor_bill_items->vendor_id->TooltipValue = "";

			// booking_id
			if (!ew_Empty($vendor_bill_items->booking_id->CurrentValue)) {
				$vendor_bill_items->booking_id->HrefValue = $vendor_bill_items->booking_id->CurrentValue;
				if ($vendor_bill_items->Export <> "") $vendor_bill_items->booking_id->HrefValue = ew_ConvertFullUrl($vendor_bill_items->booking_id->HrefValue);
			} else {
				$vendor_bill_items->booking_id->HrefValue = "";
			}
			$vendor_bill_items->booking_id->TooltipValue = "";

			// remarks
			$vendor_bill_items->remarks->HrefValue = "";
			$vendor_bill_items->remarks->TooltipValue = "";

			// user_id
			$vendor_bill_items->user_id->HrefValue = "";
			$vendor_bill_items->user_id->TooltipValue = "";

			// created
			$vendor_bill_items->created->HrefValue = "";
			$vendor_bill_items->created->TooltipValue = "";

			// modified
			$vendor_bill_items->modified->HrefValue = "";
			$vendor_bill_items->modified->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($vendor_bill_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$vendor_bill_items->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $vendor_bill_items;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $vendor_bill_items->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($vendor_bill_items->ExportAll) {
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
		if ($vendor_bill_items->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($vendor_bill_items, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($vendor_bill_items->id);
				$ExportDoc->ExportCaption($vendor_bill_items->vendor_bill_id);
				$ExportDoc->ExportCaption($vendor_bill_items->vendor_id);
				$ExportDoc->ExportCaption($vendor_bill_items->booking_id);
				$ExportDoc->ExportCaption($vendor_bill_items->user_id);
				$ExportDoc->ExportCaption($vendor_bill_items->created);
				$ExportDoc->ExportCaption($vendor_bill_items->modified);
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
				$vendor_bill_items->CssClass = "";
				$vendor_bill_items->CssStyle = "";
				$vendor_bill_items->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($vendor_bill_items->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $vendor_bill_items->id->ExportValue($vendor_bill_items->Export, $vendor_bill_items->ExportOriginalValue));
					$XmlDoc->AddField('vendor_bill_id', $vendor_bill_items->vendor_bill_id->ExportValue($vendor_bill_items->Export, $vendor_bill_items->ExportOriginalValue));
					$XmlDoc->AddField('vendor_id', $vendor_bill_items->vendor_id->ExportValue($vendor_bill_items->Export, $vendor_bill_items->ExportOriginalValue));
					$XmlDoc->AddField('booking_id', $vendor_bill_items->booking_id->ExportValue($vendor_bill_items->Export, $vendor_bill_items->ExportOriginalValue));
					$XmlDoc->AddField('user_id', $vendor_bill_items->user_id->ExportValue($vendor_bill_items->Export, $vendor_bill_items->ExportOriginalValue));
					$XmlDoc->AddField('created', $vendor_bill_items->created->ExportValue($vendor_bill_items->Export, $vendor_bill_items->ExportOriginalValue));
					$XmlDoc->AddField('modified', $vendor_bill_items->modified->ExportValue($vendor_bill_items->Export, $vendor_bill_items->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($vendor_bill_items->id);
					$ExportDoc->ExportField($vendor_bill_items->vendor_bill_id);
					$ExportDoc->ExportField($vendor_bill_items->vendor_id);
					$ExportDoc->ExportField($vendor_bill_items->booking_id);
					$ExportDoc->ExportField($vendor_bill_items->user_id);
					$ExportDoc->ExportField($vendor_bill_items->created);
					$ExportDoc->ExportField($vendor_bill_items->modified);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($vendor_bill_items->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($vendor_bill_items->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($vendor_bill_items->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($vendor_bill_items->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($vendor_bill_items->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $vendor_bill_items;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "vendor_bill") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $vendor_bill_items->SqlMasterFilter_vendor_bill();
				$this->sDbDetailFilter = $vendor_bill_items->SqlDetailFilter_vendor_bill();
				if (@$_GET["id"] <> "") {
					$GLOBALS["vendor_bill"]->id->setQueryStringValue($_GET["id"]);
					$vendor_bill_items->vendor_bill_id->setQueryStringValue($GLOBALS["vendor_bill"]->id->QueryStringValue);
					$vendor_bill_items->vendor_bill_id->setSessionValue($vendor_bill_items->vendor_bill_id->QueryStringValue);
					if (!is_numeric($GLOBALS["vendor_bill"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["vendor_bill"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@vendor_bill_id@", ew_AdjustSql($GLOBALS["vendor_bill"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["vendor_ID"] <> "") {
					$GLOBALS["vendor_bill"]->vendor_ID->setQueryStringValue($_GET["vendor_ID"]);
					$vendor_bill_items->vendor_id->setQueryStringValue($GLOBALS["vendor_bill"]->vendor_ID->QueryStringValue);
					$vendor_bill_items->vendor_id->setSessionValue($vendor_bill_items->vendor_id->QueryStringValue);
					if (!is_numeric($GLOBALS["vendor_bill"]->vendor_ID->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@vendor_ID@", ew_AdjustSql($GLOBALS["vendor_bill"]->vendor_ID->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@vendor_id@", ew_AdjustSql($GLOBALS["vendor_bill"]->vendor_ID->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$vendor_bill_items->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
			$vendor_bill_items->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$vendor_bill_items->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "vendor_bill") {
				if ($vendor_bill_items->vendor_bill_id->QueryStringValue == "") $vendor_bill_items->vendor_bill_id->setSessionValue("");
				if ($vendor_bill_items->vendor_id->QueryStringValue == "") $vendor_bill_items->vendor_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $vendor_bill_items->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $vendor_bill_items->getDetailFilter(); // Restore detail filter
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
