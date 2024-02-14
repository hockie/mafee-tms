<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "audittrailinfo.php" ?>
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
$audittrail_list = new caudittrail_list();
$Page =& $audittrail_list;

// Page init
$audittrail_list->Page_Init();

// Page main
$audittrail_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($audittrail->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var audittrail_list = new ew_Page("audittrail_list");

// page properties
audittrail_list.PageID = "list"; // page ID
audittrail_list.FormID = "faudittraillist"; // form ID
var EW_PAGE_ID = audittrail_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
audittrail_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
audittrail_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
audittrail_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($audittrail->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$audittrail_list->lTotalRecs = $audittrail->SelectRecordCount();
	} else {
		if ($rs = $audittrail_list->LoadRecordset())
			$audittrail_list->lTotalRecs = $rs->RecordCount();
	}
	$audittrail_list->lStartRec = 1;
	if ($audittrail_list->lDisplayRecs <= 0 || ($audittrail->Export <> "" && $audittrail->ExportAll)) // Display all records
		$audittrail_list->lDisplayRecs = $audittrail_list->lTotalRecs;
	if (!($audittrail->Export <> "" && $audittrail->ExportAll))
		$audittrail_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $audittrail_list->LoadRecordset($audittrail_list->lStartRec-1, $audittrail_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $audittrail->TableCaption() ?>
<?php if ($audittrail->Export == "" && $audittrail->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $audittrail_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $audittrail_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $audittrail_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($audittrail->Export == "" && $audittrail->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(audittrail_list);" style="text-decoration: none;"><img id="audittrail_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="audittrail_list_SearchPanel">
<form name="faudittraillistsrch" id="faudittraillistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="audittrail">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($audittrail->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $audittrail_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="audittrailsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($audittrail->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($audittrail->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($audittrail->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$audittrail_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($audittrail->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($audittrail->CurrentAction <> "gridadd" && $audittrail->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($audittrail_list->Pager)) $audittrail_list->Pager = new cPrevNextPager($audittrail_list->lStartRec, $audittrail_list->lDisplayRecs, $audittrail_list->lTotalRecs) ?>
<?php if ($audittrail_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($audittrail_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $audittrail_list->PageUrl() ?>start=<?php echo $audittrail_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($audittrail_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $audittrail_list->PageUrl() ?>start=<?php echo $audittrail_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $audittrail_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($audittrail_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $audittrail_list->PageUrl() ?>start=<?php echo $audittrail_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($audittrail_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $audittrail_list->PageUrl() ?>start=<?php echo $audittrail_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $audittrail_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $audittrail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $audittrail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $audittrail_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($audittrail_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($audittrail_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="audittrail">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($audittrail_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($audittrail_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($audittrail_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($audittrail_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($audittrail_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($audittrail_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($audittrail->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $audittrail_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="faudittraillist" id="faudittraillist" class="ewForm" action="" method="post">
<div id="gmp_audittrail" class="ewGridMiddlePanel">
<?php if ($audittrail_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $audittrail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$audittrail_list->RenderListOptions();

// Render list options (header, left)
$audittrail_list->ListOptions->Render("header", "left");
?>
<?php if ($audittrail->id->Visible) { // id ?>
	<?php if ($audittrail->SortUrl($audittrail->id) == "") { ?>
		<td><?php echo $audittrail->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $audittrail->SortUrl($audittrail->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $audittrail->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($audittrail->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($audittrail->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($audittrail->datetime->Visible) { // datetime ?>
	<?php if ($audittrail->SortUrl($audittrail->datetime) == "") { ?>
		<td><?php echo $audittrail->datetime->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $audittrail->SortUrl($audittrail->datetime) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $audittrail->datetime->FldCaption() ?></td><td style="width: 10px;"><?php if ($audittrail->datetime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($audittrail->datetime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($audittrail->script->Visible) { // script ?>
	<?php if ($audittrail->SortUrl($audittrail->script) == "") { ?>
		<td><?php echo $audittrail->script->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $audittrail->SortUrl($audittrail->script) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $audittrail->script->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($audittrail->script->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($audittrail->script->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($audittrail->user->Visible) { // user ?>
	<?php if ($audittrail->SortUrl($audittrail->user) == "") { ?>
		<td><?php echo $audittrail->user->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $audittrail->SortUrl($audittrail->user) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $audittrail->user->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($audittrail->user->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($audittrail->user->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($audittrail->action->Visible) { // action ?>
	<?php if ($audittrail->SortUrl($audittrail->action) == "") { ?>
		<td><?php echo $audittrail->action->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $audittrail->SortUrl($audittrail->action) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $audittrail->action->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($audittrail->action->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($audittrail->action->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($audittrail->table->Visible) { // table ?>
	<?php if ($audittrail->SortUrl($audittrail->table) == "") { ?>
		<td><?php echo $audittrail->table->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $audittrail->SortUrl($audittrail->table) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $audittrail->table->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($audittrail->table->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($audittrail->table->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($audittrail->zfield->Visible) { // field ?>
	<?php if ($audittrail->SortUrl($audittrail->zfield) == "") { ?>
		<td><?php echo $audittrail->zfield->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $audittrail->SortUrl($audittrail->zfield) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $audittrail->zfield->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($audittrail->zfield->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($audittrail->zfield->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$audittrail_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($audittrail->ExportAll && $audittrail->Export <> "") {
	$audittrail_list->lStopRec = $audittrail_list->lTotalRecs;
} else {
	$audittrail_list->lStopRec = $audittrail_list->lStartRec + $audittrail_list->lDisplayRecs - 1; // Set the last record to display
}
$audittrail_list->lRecCount = $audittrail_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $audittrail_list->lStartRec > 1)
		$rs->Move($audittrail_list->lStartRec - 1);
}

// Initialize aggregate
$audittrail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$audittrail_list->RenderRow();
$audittrail_list->lRowCnt = 0;
while (($audittrail->CurrentAction == "gridadd" || !$rs->EOF) &&
	$audittrail_list->lRecCount < $audittrail_list->lStopRec) {
	$audittrail_list->lRecCount++;
	if (intval($audittrail_list->lRecCount) >= intval($audittrail_list->lStartRec)) {
		$audittrail_list->lRowCnt++;

	// Init row class and style
	$audittrail->CssClass = "";
	$audittrail->CssStyle = "";
	$audittrail->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($audittrail->CurrentAction == "gridadd") {
		$audittrail_list->LoadDefaultValues(); // Load default values
	} else {
		$audittrail_list->LoadRowValues($rs); // Load row values
	}
	$audittrail->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$audittrail_list->RenderRow();

	// Render list options
	$audittrail_list->RenderListOptions();
?>
	<tr<?php echo $audittrail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$audittrail_list->ListOptions->Render("body", "left");
?>
	<?php if ($audittrail->id->Visible) { // id ?>
		<td<?php echo $audittrail->id->CellAttributes() ?>>
<div<?php echo $audittrail->id->ViewAttributes() ?>><?php echo $audittrail->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($audittrail->datetime->Visible) { // datetime ?>
		<td<?php echo $audittrail->datetime->CellAttributes() ?>>
<div<?php echo $audittrail->datetime->ViewAttributes() ?>><?php echo $audittrail->datetime->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($audittrail->script->Visible) { // script ?>
		<td<?php echo $audittrail->script->CellAttributes() ?>>
<div<?php echo $audittrail->script->ViewAttributes() ?>><?php echo $audittrail->script->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($audittrail->user->Visible) { // user ?>
		<td<?php echo $audittrail->user->CellAttributes() ?>>
<div<?php echo $audittrail->user->ViewAttributes() ?>><?php echo $audittrail->user->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($audittrail->action->Visible) { // action ?>
		<td<?php echo $audittrail->action->CellAttributes() ?>>
<div<?php echo $audittrail->action->ViewAttributes() ?>><?php echo $audittrail->action->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($audittrail->table->Visible) { // table ?>
		<td<?php echo $audittrail->table->CellAttributes() ?>>
<div<?php echo $audittrail->table->ViewAttributes() ?>><?php echo $audittrail->table->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($audittrail->zfield->Visible) { // field ?>
		<td<?php echo $audittrail->zfield->CellAttributes() ?>>
<div<?php echo $audittrail->zfield->ViewAttributes() ?>><?php echo $audittrail->zfield->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$audittrail_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($audittrail->CurrentAction <> "gridadd")
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
<?php if ($audittrail_list->lTotalRecs > 0) { ?>
<?php if ($audittrail->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($audittrail->CurrentAction <> "gridadd" && $audittrail->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($audittrail_list->Pager)) $audittrail_list->Pager = new cPrevNextPager($audittrail_list->lStartRec, $audittrail_list->lDisplayRecs, $audittrail_list->lTotalRecs) ?>
<?php if ($audittrail_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($audittrail_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $audittrail_list->PageUrl() ?>start=<?php echo $audittrail_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($audittrail_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $audittrail_list->PageUrl() ?>start=<?php echo $audittrail_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $audittrail_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($audittrail_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $audittrail_list->PageUrl() ?>start=<?php echo $audittrail_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($audittrail_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $audittrail_list->PageUrl() ?>start=<?php echo $audittrail_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $audittrail_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $audittrail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $audittrail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $audittrail_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($audittrail_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($audittrail_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="audittrail">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($audittrail_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($audittrail_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($audittrail_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($audittrail_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($audittrail_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($audittrail_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($audittrail->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($audittrail_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $audittrail_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($audittrail->Export == "" && $audittrail->CurrentAction == "") { ?>
<?php } ?>
<?php if ($audittrail->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$audittrail_list->Page_Terminate();
?>
<?php

//
// Page class
//
class caudittrail_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'audittrail';

	// Page object name
	var $PageObjName = 'audittrail_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $audittrail;
		if ($audittrail->UseTokenInUrl) $PageUrl .= "t=" . $audittrail->TableVar . "&"; // Add page token
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
		global $objForm, $audittrail;
		if ($audittrail->UseTokenInUrl) {
			if ($objForm)
				return ($audittrail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($audittrail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caudittrail_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (audittrail)
		$GLOBALS["audittrail"] = new caudittrail();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["audittrail"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "audittraildelete.php";
		$this->MultiUpdateUrl = "audittrailupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'audittrail', TRUE);

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
		global $audittrail;

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
			$audittrail->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$audittrail->Export = $_POST["exporttype"];
		} else {
			$audittrail->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $audittrail->Export; // Get export parameter, used in header
		$gsExportFile = $audittrail->TableVar; // Get export file, used in header
		if ($audittrail->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $audittrail;

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
			$audittrail->Recordset_SearchValidated();

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
		if ($audittrail->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $audittrail->getRecordsPerPage(); // Restore from Session
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
		$audittrail->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$audittrail->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$audittrail->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $audittrail->getSearchWhere();
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
		$audittrail->setSessionWhere($sFilter);
		$audittrail->CurrentFilter = "";

		// Export data only
		if (in_array($audittrail->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($audittrail->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $audittrail;
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
			$audittrail->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$audittrail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $audittrail;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $audittrail->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $audittrail->datetime, FALSE); // datetime
		$this->BuildSearchSql($sWhere, $audittrail->script, FALSE); // script
		$this->BuildSearchSql($sWhere, $audittrail->user, FALSE); // user
		$this->BuildSearchSql($sWhere, $audittrail->action, FALSE); // action
		$this->BuildSearchSql($sWhere, $audittrail->table, FALSE); // table
		$this->BuildSearchSql($sWhere, $audittrail->zfield, FALSE); // field
		$this->BuildSearchSql($sWhere, $audittrail->keyvalue, FALSE); // keyvalue
		$this->BuildSearchSql($sWhere, $audittrail->oldvalue, FALSE); // oldvalue
		$this->BuildSearchSql($sWhere, $audittrail->newvalue, FALSE); // newvalue

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($audittrail->id); // id
			$this->SetSearchParm($audittrail->datetime); // datetime
			$this->SetSearchParm($audittrail->script); // script
			$this->SetSearchParm($audittrail->user); // user
			$this->SetSearchParm($audittrail->action); // action
			$this->SetSearchParm($audittrail->table); // table
			$this->SetSearchParm($audittrail->zfield); // field
			$this->SetSearchParm($audittrail->keyvalue); // keyvalue
			$this->SetSearchParm($audittrail->oldvalue); // oldvalue
			$this->SetSearchParm($audittrail->newvalue); // newvalue
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
		global $audittrail;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$audittrail->setAdvancedSearch("x_$FldParm", $FldVal);
		$audittrail->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$audittrail->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$audittrail->setAdvancedSearch("y_$FldParm", $FldVal2);
		$audittrail->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $audittrail;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $audittrail->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $audittrail->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $audittrail->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $audittrail->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $audittrail->GetAdvancedSearch("w_$FldParm");
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
		global $audittrail;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $audittrail->script, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $audittrail->user, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $audittrail->action, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $audittrail->table, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $audittrail->zfield, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $audittrail->keyvalue, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $audittrail->oldvalue, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $audittrail->newvalue, $Keyword);
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
		global $Security, $audittrail;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $audittrail->BasicSearchKeyword;
		$sSearchType = $audittrail->BasicSearchType;
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
			$audittrail->setSessionBasicSearchKeyword($sSearchKeyword);
			$audittrail->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $audittrail;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$audittrail->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $audittrail;
		$audittrail->setSessionBasicSearchKeyword("");
		$audittrail->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $audittrail;
		$audittrail->setAdvancedSearch("x_id", "");
		$audittrail->setAdvancedSearch("x_datetime", "");
		$audittrail->setAdvancedSearch("x_script", "");
		$audittrail->setAdvancedSearch("x_user", "");
		$audittrail->setAdvancedSearch("x_action", "");
		$audittrail->setAdvancedSearch("x_table", "");
		$audittrail->setAdvancedSearch("x_zfield", "");
		$audittrail->setAdvancedSearch("x_keyvalue", "");
		$audittrail->setAdvancedSearch("x_oldvalue", "");
		$audittrail->setAdvancedSearch("x_newvalue", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $audittrail;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_datetime"] <> "") $bRestore = FALSE;
		if (@$_GET["x_script"] <> "") $bRestore = FALSE;
		if (@$_GET["x_user"] <> "") $bRestore = FALSE;
		if (@$_GET["x_action"] <> "") $bRestore = FALSE;
		if (@$_GET["x_table"] <> "") $bRestore = FALSE;
		if (@$_GET["x_zfield"] <> "") $bRestore = FALSE;
		if (@$_GET["x_keyvalue"] <> "") $bRestore = FALSE;
		if (@$_GET["x_oldvalue"] <> "") $bRestore = FALSE;
		if (@$_GET["x_newvalue"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$audittrail->BasicSearchKeyword = $audittrail->getSessionBasicSearchKeyword();
			$audittrail->BasicSearchType = $audittrail->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($audittrail->id);
			$this->GetSearchParm($audittrail->datetime);
			$this->GetSearchParm($audittrail->script);
			$this->GetSearchParm($audittrail->user);
			$this->GetSearchParm($audittrail->action);
			$this->GetSearchParm($audittrail->table);
			$this->GetSearchParm($audittrail->zfield);
			$this->GetSearchParm($audittrail->keyvalue);
			$this->GetSearchParm($audittrail->oldvalue);
			$this->GetSearchParm($audittrail->newvalue);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $audittrail;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$audittrail->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$audittrail->CurrentOrderType = @$_GET["ordertype"];
			$audittrail->UpdateSort($audittrail->id); // id
			$audittrail->UpdateSort($audittrail->datetime); // datetime
			$audittrail->UpdateSort($audittrail->script); // script
			$audittrail->UpdateSort($audittrail->user); // user
			$audittrail->UpdateSort($audittrail->action); // action
			$audittrail->UpdateSort($audittrail->table); // table
			$audittrail->UpdateSort($audittrail->zfield); // field
			$audittrail->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $audittrail;
		$sOrderBy = $audittrail->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($audittrail->SqlOrderBy() <> "") {
				$sOrderBy = $audittrail->SqlOrderBy();
				$audittrail->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $audittrail;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$audittrail->setSessionOrderBy($sOrderBy);
				$audittrail->id->setSort("");
				$audittrail->datetime->setSort("");
				$audittrail->script->setSort("");
				$audittrail->user->setSort("");
				$audittrail->action->setSort("");
				$audittrail->table->setSort("");
				$audittrail->zfield->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$audittrail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $audittrail;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($audittrail->Export <> "" ||
			$audittrail->CurrentAction == "gridadd" ||
			$audittrail->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $audittrail;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $audittrail;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $audittrail;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$audittrail->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$audittrail->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $audittrail->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$audittrail->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$audittrail->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$audittrail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $audittrail;
		$audittrail->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$audittrail->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $audittrail;

		// Load search values
		// id

		$audittrail->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$audittrail->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// datetime
		$audittrail->datetime->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_datetime"]);
		$audittrail->datetime->AdvancedSearch->SearchOperator = @$_GET["z_datetime"];

		// script
		$audittrail->script->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_script"]);
		$audittrail->script->AdvancedSearch->SearchOperator = @$_GET["z_script"];

		// user
		$audittrail->user->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_user"]);
		$audittrail->user->AdvancedSearch->SearchOperator = @$_GET["z_user"];

		// action
		$audittrail->action->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_action"]);
		$audittrail->action->AdvancedSearch->SearchOperator = @$_GET["z_action"];

		// table
		$audittrail->table->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_table"]);
		$audittrail->table->AdvancedSearch->SearchOperator = @$_GET["z_table"];

		// field
		$audittrail->zfield->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_zfield"]);
		$audittrail->zfield->AdvancedSearch->SearchOperator = @$_GET["z_zfield"];

		// keyvalue
		$audittrail->keyvalue->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_keyvalue"]);
		$audittrail->keyvalue->AdvancedSearch->SearchOperator = @$_GET["z_keyvalue"];

		// oldvalue
		$audittrail->oldvalue->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_oldvalue"]);
		$audittrail->oldvalue->AdvancedSearch->SearchOperator = @$_GET["z_oldvalue"];

		// newvalue
		$audittrail->newvalue->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_newvalue"]);
		$audittrail->newvalue->AdvancedSearch->SearchOperator = @$_GET["z_newvalue"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $audittrail;

		// Call Recordset Selecting event
		$audittrail->Recordset_Selecting($audittrail->CurrentFilter);

		// Load List page SQL
		$sSql = $audittrail->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$audittrail->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $audittrail;
		$sFilter = $audittrail->KeyFilter();

		// Call Row Selecting event
		$audittrail->Row_Selecting($sFilter);

		// Load SQL based on filter
		$audittrail->CurrentFilter = $sFilter;
		$sSql = $audittrail->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$audittrail->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $audittrail;
		$audittrail->id->setDbValue($rs->fields('id'));
		$audittrail->datetime->setDbValue($rs->fields('datetime'));
		$audittrail->script->setDbValue($rs->fields('script'));
		$audittrail->user->setDbValue($rs->fields('user'));
		$audittrail->action->setDbValue($rs->fields('action'));
		$audittrail->table->setDbValue($rs->fields('table'));
		$audittrail->zfield->setDbValue($rs->fields('field'));
		$audittrail->keyvalue->setDbValue($rs->fields('keyvalue'));
		$audittrail->oldvalue->setDbValue($rs->fields('oldvalue'));
		$audittrail->newvalue->setDbValue($rs->fields('newvalue'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $audittrail;

		// Initialize URLs
		$this->ViewUrl = $audittrail->ViewUrl();
		$this->EditUrl = $audittrail->EditUrl();
		$this->InlineEditUrl = $audittrail->InlineEditUrl();
		$this->CopyUrl = $audittrail->CopyUrl();
		$this->InlineCopyUrl = $audittrail->InlineCopyUrl();
		$this->DeleteUrl = $audittrail->DeleteUrl();

		// Call Row_Rendering event
		$audittrail->Row_Rendering();

		// Common render codes for all row types
		// id

		$audittrail->id->CellCssStyle = ""; $audittrail->id->CellCssClass = "";
		$audittrail->id->CellAttrs = array(); $audittrail->id->ViewAttrs = array(); $audittrail->id->EditAttrs = array();

		// datetime
		$audittrail->datetime->CellCssStyle = ""; $audittrail->datetime->CellCssClass = "";
		$audittrail->datetime->CellAttrs = array(); $audittrail->datetime->ViewAttrs = array(); $audittrail->datetime->EditAttrs = array();

		// script
		$audittrail->script->CellCssStyle = ""; $audittrail->script->CellCssClass = "";
		$audittrail->script->CellAttrs = array(); $audittrail->script->ViewAttrs = array(); $audittrail->script->EditAttrs = array();

		// user
		$audittrail->user->CellCssStyle = ""; $audittrail->user->CellCssClass = "";
		$audittrail->user->CellAttrs = array(); $audittrail->user->ViewAttrs = array(); $audittrail->user->EditAttrs = array();

		// action
		$audittrail->action->CellCssStyle = ""; $audittrail->action->CellCssClass = "";
		$audittrail->action->CellAttrs = array(); $audittrail->action->ViewAttrs = array(); $audittrail->action->EditAttrs = array();

		// table
		$audittrail->table->CellCssStyle = ""; $audittrail->table->CellCssClass = "";
		$audittrail->table->CellAttrs = array(); $audittrail->table->ViewAttrs = array(); $audittrail->table->EditAttrs = array();

		// field
		$audittrail->zfield->CellCssStyle = ""; $audittrail->zfield->CellCssClass = "";
		$audittrail->zfield->CellAttrs = array(); $audittrail->zfield->ViewAttrs = array(); $audittrail->zfield->EditAttrs = array();
		if ($audittrail->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$audittrail->id->ViewValue = $audittrail->id->CurrentValue;
			$audittrail->id->CssStyle = "";
			$audittrail->id->CssClass = "";
			$audittrail->id->ViewCustomAttributes = "";

			// datetime
			$audittrail->datetime->ViewValue = $audittrail->datetime->CurrentValue;
			$audittrail->datetime->ViewValue = ew_FormatDateTime($audittrail->datetime->ViewValue, 6);
			$audittrail->datetime->CssStyle = "";
			$audittrail->datetime->CssClass = "";
			$audittrail->datetime->ViewCustomAttributes = "";

			// script
			$audittrail->script->ViewValue = $audittrail->script->CurrentValue;
			$audittrail->script->CssStyle = "";
			$audittrail->script->CssClass = "";
			$audittrail->script->ViewCustomAttributes = "";

			// user
			$audittrail->user->ViewValue = $audittrail->user->CurrentValue;
			$audittrail->user->CssStyle = "";
			$audittrail->user->CssClass = "";
			$audittrail->user->ViewCustomAttributes = "";

			// action
			$audittrail->action->ViewValue = $audittrail->action->CurrentValue;
			$audittrail->action->CssStyle = "";
			$audittrail->action->CssClass = "";
			$audittrail->action->ViewCustomAttributes = "";

			// table
			$audittrail->table->ViewValue = $audittrail->table->CurrentValue;
			$audittrail->table->CssStyle = "";
			$audittrail->table->CssClass = "";
			$audittrail->table->ViewCustomAttributes = "";

			// field
			$audittrail->zfield->ViewValue = $audittrail->zfield->CurrentValue;
			$audittrail->zfield->CssStyle = "";
			$audittrail->zfield->CssClass = "";
			$audittrail->zfield->ViewCustomAttributes = "";

			// id
			$audittrail->id->HrefValue = "";
			$audittrail->id->TooltipValue = "";

			// datetime
			$audittrail->datetime->HrefValue = "";
			$audittrail->datetime->TooltipValue = "";

			// script
			$audittrail->script->HrefValue = "";
			$audittrail->script->TooltipValue = "";

			// user
			$audittrail->user->HrefValue = "";
			$audittrail->user->TooltipValue = "";

			// action
			$audittrail->action->HrefValue = "";
			$audittrail->action->TooltipValue = "";

			// table
			$audittrail->table->HrefValue = "";
			$audittrail->table->TooltipValue = "";

			// field
			$audittrail->zfield->HrefValue = "";
			$audittrail->zfield->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($audittrail->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$audittrail->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $audittrail;

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
		global $audittrail;
		$audittrail->id->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_id");
		$audittrail->datetime->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_datetime");
		$audittrail->script->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_script");
		$audittrail->user->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_user");
		$audittrail->action->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_action");
		$audittrail->table->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_table");
		$audittrail->zfield->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_zfield");
		$audittrail->keyvalue->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_keyvalue");
		$audittrail->oldvalue->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_oldvalue");
		$audittrail->newvalue->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_newvalue");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $audittrail;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $audittrail->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($audittrail->ExportAll) {
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
		if ($audittrail->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($audittrail, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($audittrail->id);
				$ExportDoc->ExportCaption($audittrail->datetime);
				$ExportDoc->ExportCaption($audittrail->script);
				$ExportDoc->ExportCaption($audittrail->user);
				$ExportDoc->ExportCaption($audittrail->action);
				$ExportDoc->ExportCaption($audittrail->table);
				$ExportDoc->ExportCaption($audittrail->zfield);
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
				$audittrail->CssClass = "";
				$audittrail->CssStyle = "";
				$audittrail->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($audittrail->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $audittrail->id->ExportValue($audittrail->Export, $audittrail->ExportOriginalValue));
					$XmlDoc->AddField('datetime', $audittrail->datetime->ExportValue($audittrail->Export, $audittrail->ExportOriginalValue));
					$XmlDoc->AddField('script', $audittrail->script->ExportValue($audittrail->Export, $audittrail->ExportOriginalValue));
					$XmlDoc->AddField('user', $audittrail->user->ExportValue($audittrail->Export, $audittrail->ExportOriginalValue));
					$XmlDoc->AddField('action', $audittrail->action->ExportValue($audittrail->Export, $audittrail->ExportOriginalValue));
					$XmlDoc->AddField('table', $audittrail->table->ExportValue($audittrail->Export, $audittrail->ExportOriginalValue));
					$XmlDoc->AddField('zfield', $audittrail->zfield->ExportValue($audittrail->Export, $audittrail->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($audittrail->id);
					$ExportDoc->ExportField($audittrail->datetime);
					$ExportDoc->ExportField($audittrail->script);
					$ExportDoc->ExportField($audittrail->user);
					$ExportDoc->ExportField($audittrail->action);
					$ExportDoc->ExportField($audittrail->table);
					$ExportDoc->ExportField($audittrail->zfield);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($audittrail->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($audittrail->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($audittrail->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($audittrail->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($audittrail->ExportReturnUrl());
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
