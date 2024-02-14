<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "expenses_typesinfo.php" ?>
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
$expenses_types_list = new cexpenses_types_list();
$Page =& $expenses_types_list;

// Page init
$expenses_types_list->Page_Init();

// Page main
$expenses_types_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($expenses_types->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expenses_types_list = new ew_Page("expenses_types_list");

// page properties
expenses_types_list.PageID = "list"; // page ID
expenses_types_list.FormID = "fexpenses_typeslist"; // form ID
var EW_PAGE_ID = expenses_types_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expenses_types_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
expenses_types_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenses_types_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($expenses_types->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$expenses_types_list->lTotalRecs = $expenses_types->SelectRecordCount();
	} else {
		if ($rs = $expenses_types_list->LoadRecordset())
			$expenses_types_list->lTotalRecs = $rs->RecordCount();
	}
	$expenses_types_list->lStartRec = 1;
	if ($expenses_types_list->lDisplayRecs <= 0 || ($expenses_types->Export <> "" && $expenses_types->ExportAll)) // Display all records
		$expenses_types_list->lDisplayRecs = $expenses_types_list->lTotalRecs;
	if (!($expenses_types->Export <> "" && $expenses_types->ExportAll))
		$expenses_types_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $expenses_types_list->LoadRecordset($expenses_types_list->lStartRec-1, $expenses_types_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenses_types->TableCaption() ?>
<?php if ($expenses_types->Export == "" && $expenses_types->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $expenses_types_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $expenses_types_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $expenses_types_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($expenses_types->Export == "" && $expenses_types->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(expenses_types_list);" style="text-decoration: none;"><img id="expenses_types_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="expenses_types_list_SearchPanel">
<form name="fexpenses_typeslistsrch" id="fexpenses_typeslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="expenses_types">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($expenses_types->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $expenses_types_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($expenses_types->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($expenses_types->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($expenses_types->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expenses_types_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($expenses_types->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($expenses_types->CurrentAction <> "gridadd" && $expenses_types->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expenses_types_list->Pager)) $expenses_types_list->Pager = new cPrevNextPager($expenses_types_list->lStartRec, $expenses_types_list->lDisplayRecs, $expenses_types_list->lTotalRecs) ?>
<?php if ($expenses_types_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expenses_types_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_types_list->PageUrl() ?>start=<?php echo $expenses_types_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expenses_types_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_types_list->PageUrl() ?>start=<?php echo $expenses_types_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expenses_types_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expenses_types_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_types_list->PageUrl() ?>start=<?php echo $expenses_types_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expenses_types_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_types_list->PageUrl() ?>start=<?php echo $expenses_types_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expenses_types_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expenses_types_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expenses_types_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expenses_types_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($expenses_types_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expenses_types_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expenses_types">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($expenses_types_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expenses_types_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expenses_types_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($expenses_types_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($expenses_types_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($expenses_types_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($expenses_types->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expenses_types_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fexpenses_typeslist" id="fexpenses_typeslist" class="ewForm" action="" method="post">
<div id="gmp_expenses_types" class="ewGridMiddlePanel">
<?php if ($expenses_types_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $expenses_types->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$expenses_types_list->RenderListOptions();

// Render list options (header, left)
$expenses_types_list->ListOptions->Render("header", "left");
?>
<?php if ($expenses_types->id->Visible) { // id ?>
	<?php if ($expenses_types->SortUrl($expenses_types->id) == "") { ?>
		<td><?php echo $expenses_types->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses_types->SortUrl($expenses_types->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses_types->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenses_types->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses_types->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenses_types->Expenses_Type->Visible) { // Expenses_Type ?>
	<?php if ($expenses_types->SortUrl($expenses_types->Expenses_Type) == "") { ?>
		<td><?php echo $expenses_types->Expenses_Type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expenses_types->SortUrl($expenses_types->Expenses_Type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenses_types->Expenses_Type->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($expenses_types->Expenses_Type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenses_types->Expenses_Type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$expenses_types_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($expenses_types->ExportAll && $expenses_types->Export <> "") {
	$expenses_types_list->lStopRec = $expenses_types_list->lTotalRecs;
} else {
	$expenses_types_list->lStopRec = $expenses_types_list->lStartRec + $expenses_types_list->lDisplayRecs - 1; // Set the last record to display
}
$expenses_types_list->lRecCount = $expenses_types_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $expenses_types_list->lStartRec > 1)
		$rs->Move($expenses_types_list->lStartRec - 1);
}

// Initialize aggregate
$expenses_types->RowType = EW_ROWTYPE_AGGREGATEINIT;
$expenses_types_list->RenderRow();
$expenses_types_list->lRowCnt = 0;
while (($expenses_types->CurrentAction == "gridadd" || !$rs->EOF) &&
	$expenses_types_list->lRecCount < $expenses_types_list->lStopRec) {
	$expenses_types_list->lRecCount++;
	if (intval($expenses_types_list->lRecCount) >= intval($expenses_types_list->lStartRec)) {
		$expenses_types_list->lRowCnt++;

	// Init row class and style
	$expenses_types->CssClass = "";
	$expenses_types->CssStyle = "";
	$expenses_types->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($expenses_types->CurrentAction == "gridadd") {
		$expenses_types_list->LoadDefaultValues(); // Load default values
	} else {
		$expenses_types_list->LoadRowValues($rs); // Load row values
	}
	$expenses_types->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$expenses_types_list->RenderRow();

	// Render list options
	$expenses_types_list->RenderListOptions();
?>
	<tr<?php echo $expenses_types->RowAttributes() ?>>
<?php

// Render list options (body, left)
$expenses_types_list->ListOptions->Render("body", "left");
?>
	<?php if ($expenses_types->id->Visible) { // id ?>
		<td<?php echo $expenses_types->id->CellAttributes() ?>>
<div<?php echo $expenses_types->id->ViewAttributes() ?>><?php echo $expenses_types->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expenses_types->Expenses_Type->Visible) { // Expenses_Type ?>
		<td<?php echo $expenses_types->Expenses_Type->CellAttributes() ?>>
<div<?php echo $expenses_types->Expenses_Type->ViewAttributes() ?>><?php echo $expenses_types->Expenses_Type->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$expenses_types_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($expenses_types->CurrentAction <> "gridadd")
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
<?php if ($expenses_types_list->lTotalRecs > 0) { ?>
<?php if ($expenses_types->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($expenses_types->CurrentAction <> "gridadd" && $expenses_types->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expenses_types_list->Pager)) $expenses_types_list->Pager = new cPrevNextPager($expenses_types_list->lStartRec, $expenses_types_list->lDisplayRecs, $expenses_types_list->lTotalRecs) ?>
<?php if ($expenses_types_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expenses_types_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_types_list->PageUrl() ?>start=<?php echo $expenses_types_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expenses_types_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_types_list->PageUrl() ?>start=<?php echo $expenses_types_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expenses_types_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expenses_types_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_types_list->PageUrl() ?>start=<?php echo $expenses_types_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expenses_types_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expenses_types_list->PageUrl() ?>start=<?php echo $expenses_types_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expenses_types_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expenses_types_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expenses_types_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expenses_types_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($expenses_types_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expenses_types_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expenses_types">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($expenses_types_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expenses_types_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expenses_types_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($expenses_types_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($expenses_types_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($expenses_types_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($expenses_types->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($expenses_types_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expenses_types_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($expenses_types->Export == "" && $expenses_types->CurrentAction == "") { ?>
<?php } ?>
<?php if ($expenses_types->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$expenses_types_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenses_types_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'expenses_types';

	// Page object name
	var $PageObjName = 'expenses_types_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenses_types;
		if ($expenses_types->UseTokenInUrl) $PageUrl .= "t=" . $expenses_types->TableVar . "&"; // Add page token
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
		global $objForm, $expenses_types;
		if ($expenses_types->UseTokenInUrl) {
			if ($objForm)
				return ($expenses_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenses_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenses_types_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expenses_types)
		$GLOBALS["expenses_types"] = new cexpenses_types();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["expenses_types"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "expenses_typesdelete.php";
		$this->MultiUpdateUrl = "expenses_typesupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenses_types', TRUE);

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
		global $expenses_types;

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
			$expenses_types->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$expenses_types->Export = $_POST["exporttype"];
		} else {
			$expenses_types->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $expenses_types->Export; // Get export parameter, used in header
		$gsExportFile = $expenses_types->TableVar; // Get export file, used in header
		if ($expenses_types->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $expenses_types;

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

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$expenses_types->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($expenses_types->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $expenses_types->getRecordsPerPage(); // Restore from Session
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
		$expenses_types->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$expenses_types->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$expenses_types->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $expenses_types->getSearchWhere();
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
		$expenses_types->setSessionWhere($sFilter);
		$expenses_types->CurrentFilter = "";

		// Export data only
		if (in_array($expenses_types->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($expenses_types->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $expenses_types;
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
			$expenses_types->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$expenses_types->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $expenses_types;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $expenses_types->Expenses_Type, $Keyword);
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
		global $Security, $expenses_types;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $expenses_types->BasicSearchKeyword;
		$sSearchType = $expenses_types->BasicSearchType;
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
			$expenses_types->setSessionBasicSearchKeyword($sSearchKeyword);
			$expenses_types->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $expenses_types;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$expenses_types->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $expenses_types;
		$expenses_types->setSessionBasicSearchKeyword("");
		$expenses_types->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $expenses_types;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$expenses_types->BasicSearchKeyword = $expenses_types->getSessionBasicSearchKeyword();
			$expenses_types->BasicSearchType = $expenses_types->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $expenses_types;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$expenses_types->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$expenses_types->CurrentOrderType = @$_GET["ordertype"];
			$expenses_types->UpdateSort($expenses_types->id); // id
			$expenses_types->UpdateSort($expenses_types->Expenses_Type); // Expenses_Type
			$expenses_types->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $expenses_types;
		$sOrderBy = $expenses_types->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($expenses_types->SqlOrderBy() <> "") {
				$sOrderBy = $expenses_types->SqlOrderBy();
				$expenses_types->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $expenses_types;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$expenses_types->setSessionOrderBy($sOrderBy);
				$expenses_types->id->setSort("");
				$expenses_types->Expenses_Type->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$expenses_types->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $expenses_types;

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

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($expenses_types->Export <> "" ||
			$expenses_types->CurrentAction == "gridadd" ||
			$expenses_types->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $expenses_types;
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

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $expenses_types;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expenses_types;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$expenses_types->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$expenses_types->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $expenses_types->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$expenses_types->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$expenses_types->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$expenses_types->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $expenses_types;
		$expenses_types->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$expenses_types->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expenses_types;

		// Call Recordset Selecting event
		$expenses_types->Recordset_Selecting($expenses_types->CurrentFilter);

		// Load List page SQL
		$sSql = $expenses_types->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expenses_types->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenses_types;
		$sFilter = $expenses_types->KeyFilter();

		// Call Row Selecting event
		$expenses_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenses_types->CurrentFilter = $sFilter;
		$sSql = $expenses_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$expenses_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expenses_types;
		$expenses_types->id->setDbValue($rs->fields('id'));
		$expenses_types->Expenses_Type->setDbValue($rs->fields('Expenses_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenses_types;

		// Initialize URLs
		$this->ViewUrl = $expenses_types->ViewUrl();
		$this->EditUrl = $expenses_types->EditUrl();
		$this->InlineEditUrl = $expenses_types->InlineEditUrl();
		$this->CopyUrl = $expenses_types->CopyUrl();
		$this->InlineCopyUrl = $expenses_types->InlineCopyUrl();
		$this->DeleteUrl = $expenses_types->DeleteUrl();

		// Call Row_Rendering event
		$expenses_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$expenses_types->id->CellCssStyle = ""; $expenses_types->id->CellCssClass = "";
		$expenses_types->id->CellAttrs = array(); $expenses_types->id->ViewAttrs = array(); $expenses_types->id->EditAttrs = array();

		// Expenses_Type
		$expenses_types->Expenses_Type->CellCssStyle = ""; $expenses_types->Expenses_Type->CellCssClass = "";
		$expenses_types->Expenses_Type->CellAttrs = array(); $expenses_types->Expenses_Type->ViewAttrs = array(); $expenses_types->Expenses_Type->EditAttrs = array();
		if ($expenses_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expenses_types->id->ViewValue = $expenses_types->id->CurrentValue;
			$expenses_types->id->CssStyle = "";
			$expenses_types->id->CssClass = "";
			$expenses_types->id->ViewCustomAttributes = "";

			// Expenses_Type
			$expenses_types->Expenses_Type->ViewValue = $expenses_types->Expenses_Type->CurrentValue;
			$expenses_types->Expenses_Type->CssStyle = "";
			$expenses_types->Expenses_Type->CssClass = "";
			$expenses_types->Expenses_Type->ViewCustomAttributes = "";

			// id
			$expenses_types->id->HrefValue = "";
			$expenses_types->id->TooltipValue = "";

			// Expenses_Type
			$expenses_types->Expenses_Type->HrefValue = "";
			$expenses_types->Expenses_Type->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expenses_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenses_types->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $expenses_types;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $expenses_types->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($expenses_types->ExportAll) {
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
		if ($expenses_types->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($expenses_types, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($expenses_types->id);
				$ExportDoc->ExportCaption($expenses_types->Expenses_Type);
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
				$expenses_types->CssClass = "";
				$expenses_types->CssStyle = "";
				$expenses_types->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($expenses_types->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $expenses_types->id->ExportValue($expenses_types->Export, $expenses_types->ExportOriginalValue));
					$XmlDoc->AddField('Expenses_Type', $expenses_types->Expenses_Type->ExportValue($expenses_types->Export, $expenses_types->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($expenses_types->id);
					$ExportDoc->ExportField($expenses_types->Expenses_Type);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($expenses_types->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($expenses_types->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($expenses_types->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($expenses_types->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($expenses_types->ExportReturnUrl());
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
