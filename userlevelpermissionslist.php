<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "userlevelpermissionsinfo.php" ?>
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
$userlevelpermissions_list = new cuserlevelpermissions_list();
$Page =& $userlevelpermissions_list;

// Page init
$userlevelpermissions_list->Page_Init();

// Page main
$userlevelpermissions_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($userlevelpermissions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var userlevelpermissions_list = new ew_Page("userlevelpermissions_list");

// page properties
userlevelpermissions_list.PageID = "list"; // page ID
userlevelpermissions_list.FormID = "fuserlevelpermissionslist"; // form ID
var EW_PAGE_ID = userlevelpermissions_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
userlevelpermissions_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userlevelpermissions_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userlevelpermissions_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($userlevelpermissions->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$userlevelpermissions_list->lTotalRecs = $userlevelpermissions->SelectRecordCount();
	} else {
		if ($rs = $userlevelpermissions_list->LoadRecordset())
			$userlevelpermissions_list->lTotalRecs = $rs->RecordCount();
	}
	$userlevelpermissions_list->lStartRec = 1;
	if ($userlevelpermissions_list->lDisplayRecs <= 0 || ($userlevelpermissions->Export <> "" && $userlevelpermissions->ExportAll)) // Display all records
		$userlevelpermissions_list->lDisplayRecs = $userlevelpermissions_list->lTotalRecs;
	if (!($userlevelpermissions->Export <> "" && $userlevelpermissions->ExportAll))
		$userlevelpermissions_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $userlevelpermissions_list->LoadRecordset($userlevelpermissions_list->lStartRec-1, $userlevelpermissions_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $userlevelpermissions->TableCaption() ?>
<?php if ($userlevelpermissions->Export == "" && $userlevelpermissions->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $userlevelpermissions_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $userlevelpermissions_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $userlevelpermissions_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($userlevelpermissions->Export == "" && $userlevelpermissions->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(userlevelpermissions_list);" style="text-decoration: none;"><img id="userlevelpermissions_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="userlevelpermissions_list_SearchPanel">
<form name="fuserlevelpermissionslistsrch" id="fuserlevelpermissionslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="userlevelpermissions">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($userlevelpermissions->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $userlevelpermissions_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($userlevelpermissions->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($userlevelpermissions->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($userlevelpermissions->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userlevelpermissions_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($userlevelpermissions->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($userlevelpermissions->CurrentAction <> "gridadd" && $userlevelpermissions->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($userlevelpermissions_list->Pager)) $userlevelpermissions_list->Pager = new cPrevNextPager($userlevelpermissions_list->lStartRec, $userlevelpermissions_list->lDisplayRecs, $userlevelpermissions_list->lTotalRecs) ?>
<?php if ($userlevelpermissions_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($userlevelpermissions_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $userlevelpermissions_list->PageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($userlevelpermissions_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $userlevelpermissions_list->PageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $userlevelpermissions_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($userlevelpermissions_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $userlevelpermissions_list->PageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($userlevelpermissions_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $userlevelpermissions_list->PageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($userlevelpermissions_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($userlevelpermissions_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="userlevelpermissions">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($userlevelpermissions_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($userlevelpermissions_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($userlevelpermissions_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($userlevelpermissions_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($userlevelpermissions_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($userlevelpermissions_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($userlevelpermissions->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $userlevelpermissions_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fuserlevelpermissionslist" id="fuserlevelpermissionslist" class="ewForm" action="" method="post">
<div id="gmp_userlevelpermissions" class="ewGridMiddlePanel">
<?php if ($userlevelpermissions_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $userlevelpermissions->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$userlevelpermissions_list->RenderListOptions();

// Render list options (header, left)
$userlevelpermissions_list->ListOptions->Render("header", "left");
?>
<?php if ($userlevelpermissions->userlevelid->Visible) { // userlevelid ?>
	<?php if ($userlevelpermissions->SortUrl($userlevelpermissions->userlevelid) == "") { ?>
		<td><?php echo $userlevelpermissions->userlevelid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $userlevelpermissions->SortUrl($userlevelpermissions->userlevelid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $userlevelpermissions->userlevelid->FldCaption() ?></td><td style="width: 10px;"><?php if ($userlevelpermissions->userlevelid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($userlevelpermissions->userlevelid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($userlevelpermissions->ztablename->Visible) { // tablename ?>
	<?php if ($userlevelpermissions->SortUrl($userlevelpermissions->ztablename) == "") { ?>
		<td><?php echo $userlevelpermissions->ztablename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $userlevelpermissions->SortUrl($userlevelpermissions->ztablename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $userlevelpermissions->ztablename->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($userlevelpermissions->ztablename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($userlevelpermissions->ztablename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
	<?php if ($userlevelpermissions->SortUrl($userlevelpermissions->permission) == "") { ?>
		<td><?php echo $userlevelpermissions->permission->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $userlevelpermissions->SortUrl($userlevelpermissions->permission) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $userlevelpermissions->permission->FldCaption() ?></td><td style="width: 10px;"><?php if ($userlevelpermissions->permission->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($userlevelpermissions->permission->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$userlevelpermissions_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($userlevelpermissions->ExportAll && $userlevelpermissions->Export <> "") {
	$userlevelpermissions_list->lStopRec = $userlevelpermissions_list->lTotalRecs;
} else {
	$userlevelpermissions_list->lStopRec = $userlevelpermissions_list->lStartRec + $userlevelpermissions_list->lDisplayRecs - 1; // Set the last record to display
}
$userlevelpermissions_list->lRecCount = $userlevelpermissions_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $userlevelpermissions_list->lStartRec > 1)
		$rs->Move($userlevelpermissions_list->lStartRec - 1);
}

// Initialize aggregate
$userlevelpermissions->RowType = EW_ROWTYPE_AGGREGATEINIT;
$userlevelpermissions_list->RenderRow();
$userlevelpermissions_list->lRowCnt = 0;
while (($userlevelpermissions->CurrentAction == "gridadd" || !$rs->EOF) &&
	$userlevelpermissions_list->lRecCount < $userlevelpermissions_list->lStopRec) {
	$userlevelpermissions_list->lRecCount++;
	if (intval($userlevelpermissions_list->lRecCount) >= intval($userlevelpermissions_list->lStartRec)) {
		$userlevelpermissions_list->lRowCnt++;

	// Init row class and style
	$userlevelpermissions->CssClass = "";
	$userlevelpermissions->CssStyle = "";
	$userlevelpermissions->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($userlevelpermissions->CurrentAction == "gridadd") {
		$userlevelpermissions_list->LoadDefaultValues(); // Load default values
	} else {
		$userlevelpermissions_list->LoadRowValues($rs); // Load row values
	}
	$userlevelpermissions->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$userlevelpermissions_list->RenderRow();

	// Render list options
	$userlevelpermissions_list->RenderListOptions();
?>
	<tr<?php echo $userlevelpermissions->RowAttributes() ?>>
<?php

// Render list options (body, left)
$userlevelpermissions_list->ListOptions->Render("body", "left");
?>
	<?php if ($userlevelpermissions->userlevelid->Visible) { // userlevelid ?>
		<td<?php echo $userlevelpermissions->userlevelid->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->userlevelid->ViewAttributes() ?>><?php echo $userlevelpermissions->userlevelid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($userlevelpermissions->ztablename->Visible) { // tablename ?>
		<td<?php echo $userlevelpermissions->ztablename->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->ztablename->ViewAttributes() ?>><?php echo $userlevelpermissions->ztablename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
		<td<?php echo $userlevelpermissions->permission->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->permission->ViewAttributes() ?>><?php echo $userlevelpermissions->permission->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$userlevelpermissions_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($userlevelpermissions->CurrentAction <> "gridadd")
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
<?php if ($userlevelpermissions_list->lTotalRecs > 0) { ?>
<?php if ($userlevelpermissions->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($userlevelpermissions->CurrentAction <> "gridadd" && $userlevelpermissions->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($userlevelpermissions_list->Pager)) $userlevelpermissions_list->Pager = new cPrevNextPager($userlevelpermissions_list->lStartRec, $userlevelpermissions_list->lDisplayRecs, $userlevelpermissions_list->lTotalRecs) ?>
<?php if ($userlevelpermissions_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($userlevelpermissions_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $userlevelpermissions_list->PageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($userlevelpermissions_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $userlevelpermissions_list->PageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $userlevelpermissions_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($userlevelpermissions_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $userlevelpermissions_list->PageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($userlevelpermissions_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $userlevelpermissions_list->PageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($userlevelpermissions_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($userlevelpermissions_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="userlevelpermissions">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($userlevelpermissions_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($userlevelpermissions_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($userlevelpermissions_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($userlevelpermissions_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($userlevelpermissions_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($userlevelpermissions_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($userlevelpermissions->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($userlevelpermissions_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $userlevelpermissions_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($userlevelpermissions->Export == "" && $userlevelpermissions->CurrentAction == "") { ?>
<?php } ?>
<?php if ($userlevelpermissions->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$userlevelpermissions_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserlevelpermissions_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'userlevelpermissions';

	// Page object name
	var $PageObjName = 'userlevelpermissions_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) $PageUrl .= "t=" . $userlevelpermissions->TableVar . "&"; // Add page token
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
		global $objForm, $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) {
			if ($objForm)
				return ($userlevelpermissions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($userlevelpermissions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuserlevelpermissions_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (userlevelpermissions)
		$GLOBALS["userlevelpermissions"] = new cuserlevelpermissions();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["userlevelpermissions"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "userlevelpermissionsdelete.php";
		$this->MultiUpdateUrl = "userlevelpermissionsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'userlevelpermissions', TRUE);

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
		global $userlevelpermissions;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$userlevelpermissions->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$userlevelpermissions->Export = $_POST["exporttype"];
		} else {
			$userlevelpermissions->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $userlevelpermissions->Export; // Get export parameter, used in header
		$gsExportFile = $userlevelpermissions->TableVar; // Get export file, used in header
		if ($userlevelpermissions->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $userlevelpermissions;

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
			$userlevelpermissions->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($userlevelpermissions->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $userlevelpermissions->getRecordsPerPage(); // Restore from Session
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
		$userlevelpermissions->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$userlevelpermissions->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$userlevelpermissions->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $userlevelpermissions->getSearchWhere();
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
		$userlevelpermissions->setSessionWhere($sFilter);
		$userlevelpermissions->CurrentFilter = "";

		// Export data only
		if (in_array($userlevelpermissions->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($userlevelpermissions->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $userlevelpermissions;
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
			$userlevelpermissions->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$userlevelpermissions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $userlevelpermissions;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $userlevelpermissions->ztablename, $Keyword);
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
		global $Security, $userlevelpermissions;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $userlevelpermissions->BasicSearchKeyword;
		$sSearchType = $userlevelpermissions->BasicSearchType;
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
			$userlevelpermissions->setSessionBasicSearchKeyword($sSearchKeyword);
			$userlevelpermissions->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $userlevelpermissions;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$userlevelpermissions->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $userlevelpermissions;
		$userlevelpermissions->setSessionBasicSearchKeyword("");
		$userlevelpermissions->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $userlevelpermissions;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$userlevelpermissions->BasicSearchKeyword = $userlevelpermissions->getSessionBasicSearchKeyword();
			$userlevelpermissions->BasicSearchType = $userlevelpermissions->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $userlevelpermissions;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$userlevelpermissions->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$userlevelpermissions->CurrentOrderType = @$_GET["ordertype"];
			$userlevelpermissions->UpdateSort($userlevelpermissions->userlevelid); // userlevelid
			$userlevelpermissions->UpdateSort($userlevelpermissions->ztablename); // tablename
			$userlevelpermissions->UpdateSort($userlevelpermissions->permission); // permission
			$userlevelpermissions->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $userlevelpermissions;
		$sOrderBy = $userlevelpermissions->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($userlevelpermissions->SqlOrderBy() <> "") {
				$sOrderBy = $userlevelpermissions->SqlOrderBy();
				$userlevelpermissions->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $userlevelpermissions;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$userlevelpermissions->setSessionOrderBy($sOrderBy);
				$userlevelpermissions->userlevelid->setSort("");
				$userlevelpermissions->ztablename->setSort("");
				$userlevelpermissions->permission->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$userlevelpermissions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $userlevelpermissions;

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
		if ($userlevelpermissions->Export <> "" ||
			$userlevelpermissions->CurrentAction == "gridadd" ||
			$userlevelpermissions->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $userlevelpermissions;
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
		global $Security, $Language, $userlevelpermissions;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $userlevelpermissions;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$userlevelpermissions->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$userlevelpermissions->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $userlevelpermissions->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$userlevelpermissions->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$userlevelpermissions->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$userlevelpermissions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $userlevelpermissions;
		$userlevelpermissions->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$userlevelpermissions->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $userlevelpermissions;

		// Call Recordset Selecting event
		$userlevelpermissions->Recordset_Selecting($userlevelpermissions->CurrentFilter);

		// Load List page SQL
		$sSql = $userlevelpermissions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$userlevelpermissions->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $userlevelpermissions;
		$sFilter = $userlevelpermissions->KeyFilter();

		// Call Row Selecting event
		$userlevelpermissions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$userlevelpermissions->CurrentFilter = $sFilter;
		$sSql = $userlevelpermissions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$userlevelpermissions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $userlevelpermissions;
		$userlevelpermissions->userlevelid->setDbValue($rs->fields('userlevelid'));
		$userlevelpermissions->ztablename->setDbValue($rs->fields('tablename'));
		$userlevelpermissions->permission->setDbValue($rs->fields('permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $userlevelpermissions;

		// Initialize URLs
		$this->ViewUrl = $userlevelpermissions->ViewUrl();
		$this->EditUrl = $userlevelpermissions->EditUrl();
		$this->InlineEditUrl = $userlevelpermissions->InlineEditUrl();
		$this->CopyUrl = $userlevelpermissions->CopyUrl();
		$this->InlineCopyUrl = $userlevelpermissions->InlineCopyUrl();
		$this->DeleteUrl = $userlevelpermissions->DeleteUrl();

		// Call Row_Rendering event
		$userlevelpermissions->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$userlevelpermissions->userlevelid->CellCssStyle = ""; $userlevelpermissions->userlevelid->CellCssClass = "";
		$userlevelpermissions->userlevelid->CellAttrs = array(); $userlevelpermissions->userlevelid->ViewAttrs = array(); $userlevelpermissions->userlevelid->EditAttrs = array();

		// tablename
		$userlevelpermissions->ztablename->CellCssStyle = ""; $userlevelpermissions->ztablename->CellCssClass = "";
		$userlevelpermissions->ztablename->CellAttrs = array(); $userlevelpermissions->ztablename->ViewAttrs = array(); $userlevelpermissions->ztablename->EditAttrs = array();

		// permission
		$userlevelpermissions->permission->CellCssStyle = ""; $userlevelpermissions->permission->CellCssClass = "";
		$userlevelpermissions->permission->CellAttrs = array(); $userlevelpermissions->permission->ViewAttrs = array(); $userlevelpermissions->permission->EditAttrs = array();
		if ($userlevelpermissions->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$userlevelpermissions->userlevelid->ViewValue = $userlevelpermissions->userlevelid->CurrentValue;
			$userlevelpermissions->userlevelid->CssStyle = "";
			$userlevelpermissions->userlevelid->CssClass = "";
			$userlevelpermissions->userlevelid->ViewCustomAttributes = "";

			// tablename
			$userlevelpermissions->ztablename->ViewValue = $userlevelpermissions->ztablename->CurrentValue;
			$userlevelpermissions->ztablename->CssStyle = "";
			$userlevelpermissions->ztablename->CssClass = "";
			$userlevelpermissions->ztablename->ViewCustomAttributes = "";

			// permission
			$userlevelpermissions->permission->ViewValue = $userlevelpermissions->permission->CurrentValue;
			$userlevelpermissions->permission->CssStyle = "";
			$userlevelpermissions->permission->CssClass = "";
			$userlevelpermissions->permission->ViewCustomAttributes = "";

			// userlevelid
			$userlevelpermissions->userlevelid->HrefValue = "";
			$userlevelpermissions->userlevelid->TooltipValue = "";

			// tablename
			$userlevelpermissions->ztablename->HrefValue = "";
			$userlevelpermissions->ztablename->TooltipValue = "";

			// permission
			$userlevelpermissions->permission->HrefValue = "";
			$userlevelpermissions->permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($userlevelpermissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$userlevelpermissions->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $userlevelpermissions;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $userlevelpermissions->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($userlevelpermissions->ExportAll) {
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
		if ($userlevelpermissions->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($userlevelpermissions, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($userlevelpermissions->userlevelid);
				$ExportDoc->ExportCaption($userlevelpermissions->ztablename);
				$ExportDoc->ExportCaption($userlevelpermissions->permission);
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
				$userlevelpermissions->CssClass = "";
				$userlevelpermissions->CssStyle = "";
				$userlevelpermissions->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($userlevelpermissions->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('userlevelid', $userlevelpermissions->userlevelid->ExportValue($userlevelpermissions->Export, $userlevelpermissions->ExportOriginalValue));
					$XmlDoc->AddField('ztablename', $userlevelpermissions->ztablename->ExportValue($userlevelpermissions->Export, $userlevelpermissions->ExportOriginalValue));
					$XmlDoc->AddField('permission', $userlevelpermissions->permission->ExportValue($userlevelpermissions->Export, $userlevelpermissions->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($userlevelpermissions->userlevelid);
					$ExportDoc->ExportField($userlevelpermissions->ztablename);
					$ExportDoc->ExportField($userlevelpermissions->permission);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($userlevelpermissions->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($userlevelpermissions->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($userlevelpermissions->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($userlevelpermissions->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($userlevelpermissions->ExportReturnUrl());
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
