<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "journal_accountsinfo.php" ?>
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
$journal_accounts_list = new cjournal_accounts_list();
$Page =& $journal_accounts_list;

// Page init
$journal_accounts_list->Page_Init();

// Page main
$journal_accounts_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($journal_accounts->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var journal_accounts_list = new ew_Page("journal_accounts_list");

// page properties
journal_accounts_list.PageID = "list"; // page ID
journal_accounts_list.FormID = "fjournal_accountslist"; // form ID
var EW_PAGE_ID = journal_accounts_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
journal_accounts_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
journal_accounts_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
journal_accounts_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
journal_accounts_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($journal_accounts->Export == "") { ?>
<?php
$gsMasterReturnUrl = "account_paymentslist.php";
if ($journal_accounts_list->sDbMasterFilter <> "" && $journal_accounts->getCurrentMasterTable() == "account_payments") {
	if ($journal_accounts_list->bMasterRecordExists) {
		if ($journal_accounts->getCurrentMasterTable() == $journal_accounts->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$journal_accounts_list->lTotalRecs = $journal_accounts->SelectRecordCount();
	} else {
		if ($rs = $journal_accounts_list->LoadRecordset())
			$journal_accounts_list->lTotalRecs = $rs->RecordCount();
	}
	$journal_accounts_list->lStartRec = 1;
	if ($journal_accounts_list->lDisplayRecs <= 0 || ($journal_accounts->Export <> "" && $journal_accounts->ExportAll)) // Display all records
		$journal_accounts_list->lDisplayRecs = $journal_accounts_list->lTotalRecs;
	if (!($journal_accounts->Export <> "" && $journal_accounts->ExportAll))
		$journal_accounts_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $journal_accounts_list->LoadRecordset($journal_accounts_list->lStartRec-1, $journal_accounts_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $journal_accounts->TableCaption() ?>
<?php if ($journal_accounts->Export == "" && $journal_accounts->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $journal_accounts_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $journal_accounts_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $journal_accounts_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($journal_accounts->Export == "" && $journal_accounts->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(journal_accounts_list);" style="text-decoration: none;"><img id="journal_accounts_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="journal_accounts_list_SearchPanel">
<form name="fjournal_accountslistsrch" id="fjournal_accountslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="journal_accounts">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($journal_accounts->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $journal_accounts_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($journal_accounts->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($journal_accounts->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($journal_accounts->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$journal_accounts_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($journal_accounts->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($journal_accounts->CurrentAction <> "gridadd" && $journal_accounts->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($journal_accounts_list->Pager)) $journal_accounts_list->Pager = new cPrevNextPager($journal_accounts_list->lStartRec, $journal_accounts_list->lDisplayRecs, $journal_accounts_list->lTotalRecs) ?>
<?php if ($journal_accounts_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($journal_accounts_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $journal_accounts_list->PageUrl() ?>start=<?php echo $journal_accounts_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($journal_accounts_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $journal_accounts_list->PageUrl() ?>start=<?php echo $journal_accounts_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $journal_accounts_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($journal_accounts_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $journal_accounts_list->PageUrl() ?>start=<?php echo $journal_accounts_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($journal_accounts_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $journal_accounts_list->PageUrl() ?>start=<?php echo $journal_accounts_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $journal_accounts_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $journal_accounts_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $journal_accounts_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $journal_accounts_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($journal_accounts_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($journal_accounts_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="journal_accounts">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($journal_accounts_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($journal_accounts_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($journal_accounts_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($journal_accounts_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($journal_accounts_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($journal_accounts_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($journal_accounts->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $journal_accounts_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($journal_accounts_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fjournal_accountslist, '<?php echo $journal_accounts_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fjournal_accountslist" id="fjournal_accountslist" class="ewForm" action="" method="post">
<div id="gmp_journal_accounts" class="ewGridMiddlePanel">
<?php if ($journal_accounts_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $journal_accounts->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$journal_accounts_list->RenderListOptions();

// Render list options (header, left)
$journal_accounts_list->ListOptions->Render("header", "left");
?>
<?php if ($journal_accounts->id->Visible) { // id ?>
	<?php if ($journal_accounts->SortUrl($journal_accounts->id) == "") { ?>
		<td><?php echo $journal_accounts->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $journal_accounts->SortUrl($journal_accounts->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $journal_accounts->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($journal_accounts->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($journal_accounts->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($journal_accounts->journal_type_id->Visible) { // journal_type_id ?>
	<?php if ($journal_accounts->SortUrl($journal_accounts->journal_type_id) == "") { ?>
		<td><?php echo $journal_accounts->journal_type_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $journal_accounts->SortUrl($journal_accounts->journal_type_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $journal_accounts->journal_type_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($journal_accounts->journal_type_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($journal_accounts->journal_type_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($journal_accounts->Account_Name->Visible) { // Account_Name ?>
	<?php if ($journal_accounts->SortUrl($journal_accounts->Account_Name) == "") { ?>
		<td><?php echo $journal_accounts->Account_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $journal_accounts->SortUrl($journal_accounts->Account_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $journal_accounts->Account_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($journal_accounts->Account_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($journal_accounts->Account_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($journal_accounts->Account_Reference_No->Visible) { // Account_Reference_No ?>
	<?php if ($journal_accounts->SortUrl($journal_accounts->Account_Reference_No) == "") { ?>
		<td><?php echo $journal_accounts->Account_Reference_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $journal_accounts->SortUrl($journal_accounts->Account_Reference_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $journal_accounts->Account_Reference_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($journal_accounts->Account_Reference_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($journal_accounts->Account_Reference_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($journal_accounts->Business_Name->Visible) { // Business_Name ?>
	<?php if ($journal_accounts->SortUrl($journal_accounts->Business_Name) == "") { ?>
		<td><?php echo $journal_accounts->Business_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $journal_accounts->SortUrl($journal_accounts->Business_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $journal_accounts->Business_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($journal_accounts->Business_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($journal_accounts->Business_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($journal_accounts->User_ID->Visible) { // User_ID ?>
	<?php if ($journal_accounts->SortUrl($journal_accounts->User_ID) == "") { ?>
		<td><?php echo $journal_accounts->User_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $journal_accounts->SortUrl($journal_accounts->User_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $journal_accounts->User_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($journal_accounts->User_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($journal_accounts->User_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$journal_accounts_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($journal_accounts->ExportAll && $journal_accounts->Export <> "") {
	$journal_accounts_list->lStopRec = $journal_accounts_list->lTotalRecs;
} else {
	$journal_accounts_list->lStopRec = $journal_accounts_list->lStartRec + $journal_accounts_list->lDisplayRecs - 1; // Set the last record to display
}
$journal_accounts_list->lRecCount = $journal_accounts_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $journal_accounts_list->lStartRec > 1)
		$rs->Move($journal_accounts_list->lStartRec - 1);
}

// Initialize aggregate
$journal_accounts->RowType = EW_ROWTYPE_AGGREGATEINIT;
$journal_accounts_list->RenderRow();
$journal_accounts_list->lRowCnt = 0;
while (($journal_accounts->CurrentAction == "gridadd" || !$rs->EOF) &&
	$journal_accounts_list->lRecCount < $journal_accounts_list->lStopRec) {
	$journal_accounts_list->lRecCount++;
	if (intval($journal_accounts_list->lRecCount) >= intval($journal_accounts_list->lStartRec)) {
		$journal_accounts_list->lRowCnt++;

	// Init row class and style
	$journal_accounts->CssClass = "";
	$journal_accounts->CssStyle = "";
	$journal_accounts->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($journal_accounts->CurrentAction == "gridadd") {
		$journal_accounts_list->LoadDefaultValues(); // Load default values
	} else {
		$journal_accounts_list->LoadRowValues($rs); // Load row values
	}
	$journal_accounts->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$journal_accounts_list->RenderRow();

	// Render list options
	$journal_accounts_list->RenderListOptions();
?>
	<tr<?php echo $journal_accounts->RowAttributes() ?>>
<?php

// Render list options (body, left)
$journal_accounts_list->ListOptions->Render("body", "left");
?>
	<?php if ($journal_accounts->id->Visible) { // id ?>
		<td<?php echo $journal_accounts->id->CellAttributes() ?>>
<div<?php echo $journal_accounts->id->ViewAttributes() ?>><?php echo $journal_accounts->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($journal_accounts->journal_type_id->Visible) { // journal_type_id ?>
		<td<?php echo $journal_accounts->journal_type_id->CellAttributes() ?>>
<div<?php echo $journal_accounts->journal_type_id->ViewAttributes() ?>><?php echo $journal_accounts->journal_type_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($journal_accounts->Account_Name->Visible) { // Account_Name ?>
		<td<?php echo $journal_accounts->Account_Name->CellAttributes() ?>>
<div<?php echo $journal_accounts->Account_Name->ViewAttributes() ?>><?php echo $journal_accounts->Account_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($journal_accounts->Account_Reference_No->Visible) { // Account_Reference_No ?>
		<td<?php echo $journal_accounts->Account_Reference_No->CellAttributes() ?>>
<div<?php echo $journal_accounts->Account_Reference_No->ViewAttributes() ?>><?php echo $journal_accounts->Account_Reference_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($journal_accounts->Business_Name->Visible) { // Business_Name ?>
		<td<?php echo $journal_accounts->Business_Name->CellAttributes() ?>>
<div<?php echo $journal_accounts->Business_Name->ViewAttributes() ?>><?php echo $journal_accounts->Business_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($journal_accounts->User_ID->Visible) { // User_ID ?>
		<td<?php echo $journal_accounts->User_ID->CellAttributes() ?>>
<div<?php echo $journal_accounts->User_ID->ViewAttributes() ?>><?php echo $journal_accounts->User_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$journal_accounts_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($journal_accounts->CurrentAction <> "gridadd")
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
<?php if ($journal_accounts_list->lTotalRecs > 0) { ?>
<?php if ($journal_accounts->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($journal_accounts->CurrentAction <> "gridadd" && $journal_accounts->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($journal_accounts_list->Pager)) $journal_accounts_list->Pager = new cPrevNextPager($journal_accounts_list->lStartRec, $journal_accounts_list->lDisplayRecs, $journal_accounts_list->lTotalRecs) ?>
<?php if ($journal_accounts_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($journal_accounts_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $journal_accounts_list->PageUrl() ?>start=<?php echo $journal_accounts_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($journal_accounts_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $journal_accounts_list->PageUrl() ?>start=<?php echo $journal_accounts_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $journal_accounts_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($journal_accounts_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $journal_accounts_list->PageUrl() ?>start=<?php echo $journal_accounts_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($journal_accounts_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $journal_accounts_list->PageUrl() ?>start=<?php echo $journal_accounts_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $journal_accounts_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $journal_accounts_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $journal_accounts_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $journal_accounts_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($journal_accounts_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($journal_accounts_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="journal_accounts">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($journal_accounts_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($journal_accounts_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($journal_accounts_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($journal_accounts_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($journal_accounts_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($journal_accounts_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($journal_accounts->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($journal_accounts_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $journal_accounts_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($journal_accounts_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fjournal_accountslist, '<?php echo $journal_accounts_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($journal_accounts->Export == "" && $journal_accounts->CurrentAction == "") { ?>
<?php } ?>
<?php if ($journal_accounts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$journal_accounts_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cjournal_accounts_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'journal_accounts';

	// Page object name
	var $PageObjName = 'journal_accounts_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $journal_accounts;
		if ($journal_accounts->UseTokenInUrl) $PageUrl .= "t=" . $journal_accounts->TableVar . "&"; // Add page token
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
		global $objForm, $journal_accounts;
		if ($journal_accounts->UseTokenInUrl) {
			if ($objForm)
				return ($journal_accounts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($journal_accounts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cjournal_accounts_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (journal_accounts)
		$GLOBALS["journal_accounts"] = new cjournal_accounts();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["journal_accounts"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "journal_accountsdelete.php";
		$this->MultiUpdateUrl = "journal_accountsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'journal_accounts', TRUE);

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
		global $journal_accounts;

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
			$journal_accounts->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$journal_accounts->Export = $_POST["exporttype"];
		} else {
			$journal_accounts->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $journal_accounts->Export; // Get export parameter, used in header
		$gsExportFile = $journal_accounts->TableVar; // Get export file, used in header
		if ($journal_accounts->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $journal_accounts;

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
			$journal_accounts->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($journal_accounts->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $journal_accounts->getRecordsPerPage(); // Restore from Session
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
		$journal_accounts->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$journal_accounts->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$journal_accounts->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $journal_accounts->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $journal_accounts->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $journal_accounts->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($journal_accounts->getMasterFilter() <> "" && $journal_accounts->getCurrentMasterTable() == "account_payments") {
			global $account_payments;
			$rsmaster = $account_payments->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$journal_accounts->setMasterFilter(""); // Clear master filter
				$journal_accounts->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($journal_accounts->getReturnUrl()); // Return to caller
			} else {
				$account_payments->LoadListRowValues($rsmaster);
				$account_payments->RowType = EW_ROWTYPE_MASTER; // Master row
				$account_payments->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$journal_accounts->setSessionWhere($sFilter);
		$journal_accounts->CurrentFilter = "";

		// Export data only
		if (in_array($journal_accounts->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($journal_accounts->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $journal_accounts;
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
			$journal_accounts->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$journal_accounts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $journal_accounts;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $journal_accounts->Account_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $journal_accounts->Account_Reference_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $journal_accounts->Business_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $journal_accounts->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $journal_accounts->Remarks, $Keyword);
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
		global $Security, $journal_accounts;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $journal_accounts->BasicSearchKeyword;
		$sSearchType = $journal_accounts->BasicSearchType;
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
			$journal_accounts->setSessionBasicSearchKeyword($sSearchKeyword);
			$journal_accounts->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $journal_accounts;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$journal_accounts->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $journal_accounts;
		$journal_accounts->setSessionBasicSearchKeyword("");
		$journal_accounts->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $journal_accounts;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$journal_accounts->BasicSearchKeyword = $journal_accounts->getSessionBasicSearchKeyword();
			$journal_accounts->BasicSearchType = $journal_accounts->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $journal_accounts;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$journal_accounts->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$journal_accounts->CurrentOrderType = @$_GET["ordertype"];
			$journal_accounts->UpdateSort($journal_accounts->id); // id
			$journal_accounts->UpdateSort($journal_accounts->journal_type_id); // journal_type_id
			$journal_accounts->UpdateSort($journal_accounts->Account_Name); // Account_Name
			$journal_accounts->UpdateSort($journal_accounts->Account_Reference_No); // Account_Reference_No
			$journal_accounts->UpdateSort($journal_accounts->Business_Name); // Business_Name
			$journal_accounts->UpdateSort($journal_accounts->User_ID); // User_ID
			$journal_accounts->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $journal_accounts;
		$sOrderBy = $journal_accounts->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($journal_accounts->SqlOrderBy() <> "") {
				$sOrderBy = $journal_accounts->SqlOrderBy();
				$journal_accounts->setSessionOrderBy($sOrderBy);
				$journal_accounts->Account_Name->setSort("ASC");
				$journal_accounts->Business_Name->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $journal_accounts;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$journal_accounts->getCurrentMasterTable = ""; // Clear master table
				$journal_accounts->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$journal_accounts->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$journal_accounts->id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$journal_accounts->setSessionOrderBy($sOrderBy);
				$journal_accounts->id->setSort("");
				$journal_accounts->journal_type_id->setSort("");
				$journal_accounts->Account_Name->setSort("");
				$journal_accounts->Account_Reference_No->setSort("");
				$journal_accounts->Business_Name->setSort("");
				$journal_accounts->User_ID->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$journal_accounts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $journal_accounts;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"journal_accounts_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($journal_accounts->Export <> "" ||
			$journal_accounts->CurrentAction == "gridadd" ||
			$journal_accounts->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $journal_accounts;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($journal_accounts->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $journal_accounts;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $journal_accounts;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$journal_accounts->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$journal_accounts->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $journal_accounts->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$journal_accounts->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$journal_accounts->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$journal_accounts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $journal_accounts;
		$journal_accounts->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$journal_accounts->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $journal_accounts;

		// Call Recordset Selecting event
		$journal_accounts->Recordset_Selecting($journal_accounts->CurrentFilter);

		// Load List page SQL
		$sSql = $journal_accounts->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$journal_accounts->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $journal_accounts;
		$sFilter = $journal_accounts->KeyFilter();

		// Call Row Selecting event
		$journal_accounts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$journal_accounts->CurrentFilter = $sFilter;
		$sSql = $journal_accounts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$journal_accounts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $journal_accounts;
		$journal_accounts->id->setDbValue($rs->fields('id'));
		$journal_accounts->journal_type_id->setDbValue($rs->fields('journal_type_id'));
		$journal_accounts->Account_Name->setDbValue($rs->fields('Account_Name'));
		$journal_accounts->Account_Reference_No->setDbValue($rs->fields('Account_Reference_No'));
		$journal_accounts->Business_Name->setDbValue($rs->fields('Business_Name'));
		$journal_accounts->Address->setDbValue($rs->fields('Address'));
		$journal_accounts->Remarks->setDbValue($rs->fields('Remarks'));
		$journal_accounts->created->setDbValue($rs->fields('created'));
		$journal_accounts->modified->setDbValue($rs->fields('modified'));
		$journal_accounts->User_ID->setDbValue($rs->fields('User_ID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $journal_accounts;

		// Initialize URLs
		$this->ViewUrl = $journal_accounts->ViewUrl();
		$this->EditUrl = $journal_accounts->EditUrl();
		$this->InlineEditUrl = $journal_accounts->InlineEditUrl();
		$this->CopyUrl = $journal_accounts->CopyUrl();
		$this->InlineCopyUrl = $journal_accounts->InlineCopyUrl();
		$this->DeleteUrl = $journal_accounts->DeleteUrl();

		// Call Row_Rendering event
		$journal_accounts->Row_Rendering();

		// Common render codes for all row types
		// id

		$journal_accounts->id->CellCssStyle = ""; $journal_accounts->id->CellCssClass = "";
		$journal_accounts->id->CellAttrs = array(); $journal_accounts->id->ViewAttrs = array(); $journal_accounts->id->EditAttrs = array();

		// journal_type_id
		$journal_accounts->journal_type_id->CellCssStyle = ""; $journal_accounts->journal_type_id->CellCssClass = "";
		$journal_accounts->journal_type_id->CellAttrs = array(); $journal_accounts->journal_type_id->ViewAttrs = array(); $journal_accounts->journal_type_id->EditAttrs = array();

		// Account_Name
		$journal_accounts->Account_Name->CellCssStyle = ""; $journal_accounts->Account_Name->CellCssClass = "";
		$journal_accounts->Account_Name->CellAttrs = array(); $journal_accounts->Account_Name->ViewAttrs = array(); $journal_accounts->Account_Name->EditAttrs = array();

		// Account_Reference_No
		$journal_accounts->Account_Reference_No->CellCssStyle = ""; $journal_accounts->Account_Reference_No->CellCssClass = "";
		$journal_accounts->Account_Reference_No->CellAttrs = array(); $journal_accounts->Account_Reference_No->ViewAttrs = array(); $journal_accounts->Account_Reference_No->EditAttrs = array();

		// Business_Name
		$journal_accounts->Business_Name->CellCssStyle = ""; $journal_accounts->Business_Name->CellCssClass = "";
		$journal_accounts->Business_Name->CellAttrs = array(); $journal_accounts->Business_Name->ViewAttrs = array(); $journal_accounts->Business_Name->EditAttrs = array();

		// User_ID
		$journal_accounts->User_ID->CellCssStyle = ""; $journal_accounts->User_ID->CellCssClass = "";
		$journal_accounts->User_ID->CellAttrs = array(); $journal_accounts->User_ID->ViewAttrs = array(); $journal_accounts->User_ID->EditAttrs = array();
		if ($journal_accounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$journal_accounts->id->ViewValue = $journal_accounts->id->CurrentValue;
			$journal_accounts->id->CssStyle = "";
			$journal_accounts->id->CssClass = "";
			$journal_accounts->id->ViewCustomAttributes = "";

			// journal_type_id
			if (strval($journal_accounts->journal_type_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($journal_accounts->journal_type_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$journal_accounts->journal_type_id->ViewValue = $rswrk->fields('Journal_Name');
					$rswrk->Close();
				} else {
					$journal_accounts->journal_type_id->ViewValue = $journal_accounts->journal_type_id->CurrentValue;
				}
			} else {
				$journal_accounts->journal_type_id->ViewValue = NULL;
			}
			$journal_accounts->journal_type_id->CssStyle = "";
			$journal_accounts->journal_type_id->CssClass = "";
			$journal_accounts->journal_type_id->ViewCustomAttributes = "";

			// Account_Name
			$journal_accounts->Account_Name->ViewValue = $journal_accounts->Account_Name->CurrentValue;
			$journal_accounts->Account_Name->CssStyle = "";
			$journal_accounts->Account_Name->CssClass = "";
			$journal_accounts->Account_Name->ViewCustomAttributes = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->ViewValue = $journal_accounts->Account_Reference_No->CurrentValue;
			$journal_accounts->Account_Reference_No->CssStyle = "";
			$journal_accounts->Account_Reference_No->CssClass = "";
			$journal_accounts->Account_Reference_No->ViewCustomAttributes = "";

			// Business_Name
			$journal_accounts->Business_Name->ViewValue = $journal_accounts->Business_Name->CurrentValue;
			$journal_accounts->Business_Name->CssStyle = "";
			$journal_accounts->Business_Name->CssClass = "";
			$journal_accounts->Business_Name->ViewCustomAttributes = "";

			// created
			$journal_accounts->created->ViewValue = $journal_accounts->created->CurrentValue;
			$journal_accounts->created->ViewValue = ew_FormatDateTime($journal_accounts->created->ViewValue, 6);
			$journal_accounts->created->CssStyle = "";
			$journal_accounts->created->CssClass = "";
			$journal_accounts->created->ViewCustomAttributes = "";

			// modified
			$journal_accounts->modified->ViewValue = $journal_accounts->modified->CurrentValue;
			$journal_accounts->modified->ViewValue = ew_FormatDateTime($journal_accounts->modified->ViewValue, 6);
			$journal_accounts->modified->CssStyle = "";
			$journal_accounts->modified->CssClass = "";
			$journal_accounts->modified->ViewCustomAttributes = "";

			// User_ID
			$journal_accounts->User_ID->ViewValue = $journal_accounts->User_ID->CurrentValue;
			$journal_accounts->User_ID->CssStyle = "";
			$journal_accounts->User_ID->CssClass = "";
			$journal_accounts->User_ID->ViewCustomAttributes = "";

			// id
			$journal_accounts->id->HrefValue = "";
			$journal_accounts->id->TooltipValue = "";

			// journal_type_id
			$journal_accounts->journal_type_id->HrefValue = "";
			$journal_accounts->journal_type_id->TooltipValue = "";

			// Account_Name
			$journal_accounts->Account_Name->HrefValue = "";
			$journal_accounts->Account_Name->TooltipValue = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->HrefValue = "";
			$journal_accounts->Account_Reference_No->TooltipValue = "";

			// Business_Name
			$journal_accounts->Business_Name->HrefValue = "";
			$journal_accounts->Business_Name->TooltipValue = "";

			// User_ID
			$journal_accounts->User_ID->HrefValue = "";
			$journal_accounts->User_ID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($journal_accounts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$journal_accounts->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $journal_accounts;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $journal_accounts->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($journal_accounts->ExportAll) {
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
		if ($journal_accounts->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($journal_accounts, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($journal_accounts->id);
				$ExportDoc->ExportCaption($journal_accounts->journal_type_id);
				$ExportDoc->ExportCaption($journal_accounts->Account_Name);
				$ExportDoc->ExportCaption($journal_accounts->Account_Reference_No);
				$ExportDoc->ExportCaption($journal_accounts->Business_Name);
				$ExportDoc->ExportCaption($journal_accounts->created);
				$ExportDoc->ExportCaption($journal_accounts->modified);
				$ExportDoc->ExportCaption($journal_accounts->User_ID);
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
				$journal_accounts->CssClass = "";
				$journal_accounts->CssStyle = "";
				$journal_accounts->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($journal_accounts->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $journal_accounts->id->ExportValue($journal_accounts->Export, $journal_accounts->ExportOriginalValue));
					$XmlDoc->AddField('journal_type_id', $journal_accounts->journal_type_id->ExportValue($journal_accounts->Export, $journal_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Account_Name', $journal_accounts->Account_Name->ExportValue($journal_accounts->Export, $journal_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Account_Reference_No', $journal_accounts->Account_Reference_No->ExportValue($journal_accounts->Export, $journal_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Business_Name', $journal_accounts->Business_Name->ExportValue($journal_accounts->Export, $journal_accounts->ExportOriginalValue));
					$XmlDoc->AddField('created', $journal_accounts->created->ExportValue($journal_accounts->Export, $journal_accounts->ExportOriginalValue));
					$XmlDoc->AddField('modified', $journal_accounts->modified->ExportValue($journal_accounts->Export, $journal_accounts->ExportOriginalValue));
					$XmlDoc->AddField('User_ID', $journal_accounts->User_ID->ExportValue($journal_accounts->Export, $journal_accounts->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($journal_accounts->id);
					$ExportDoc->ExportField($journal_accounts->journal_type_id);
					$ExportDoc->ExportField($journal_accounts->Account_Name);
					$ExportDoc->ExportField($journal_accounts->Account_Reference_No);
					$ExportDoc->ExportField($journal_accounts->Business_Name);
					$ExportDoc->ExportField($journal_accounts->created);
					$ExportDoc->ExportField($journal_accounts->modified);
					$ExportDoc->ExportField($journal_accounts->User_ID);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($journal_accounts->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($journal_accounts->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($journal_accounts->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($journal_accounts->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($journal_accounts->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $journal_accounts;
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
				$this->sDbMasterFilter = $journal_accounts->SqlMasterFilter_account_payments();
				$this->sDbDetailFilter = $journal_accounts->SqlDetailFilter_account_payments();
				if (@$_GET["Journal_Account_ID"] <> "") {
					$GLOBALS["account_payments"]->Journal_Account_ID->setQueryStringValue($_GET["Journal_Account_ID"]);
					$journal_accounts->id->setQueryStringValue($GLOBALS["account_payments"]->Journal_Account_ID->QueryStringValue);
					$journal_accounts->id->setSessionValue($journal_accounts->id->QueryStringValue);
					if (!is_numeric($GLOBALS["account_payments"]->Journal_Account_ID->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@Journal_Account_ID@", ew_AdjustSql($GLOBALS["account_payments"]->Journal_Account_ID->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["account_payments"]->Journal_Account_ID->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$journal_accounts->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$journal_accounts->setStartRecordNumber($this->lStartRec);
			$journal_accounts->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$journal_accounts->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "account_payments") {
				if ($journal_accounts->id->QueryStringValue == "") $journal_accounts->id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $journal_accounts->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $journal_accounts->getDetailFilter(); // Restore detail filter
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
