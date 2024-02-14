<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "banks_accountsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "companyinfo.php" ?>
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
$banks_accounts_list = new cbanks_accounts_list();
$Page =& $banks_accounts_list;

// Page init
$banks_accounts_list->Page_Init();

// Page main
$banks_accounts_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($banks_accounts->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var banks_accounts_list = new ew_Page("banks_accounts_list");

// page properties
banks_accounts_list.PageID = "list"; // page ID
banks_accounts_list.FormID = "fbanks_accountslist"; // form ID
var EW_PAGE_ID = banks_accounts_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
banks_accounts_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
banks_accounts_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
banks_accounts_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banks_accounts_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($banks_accounts->Export == "") { ?>
<?php
$gsMasterReturnUrl = "companylist.php";
if ($banks_accounts_list->sDbMasterFilter <> "" && $banks_accounts->getCurrentMasterTable() == "company") {
	if ($banks_accounts_list->bMasterRecordExists) {
		if ($banks_accounts->getCurrentMasterTable() == $banks_accounts->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "companymaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$banks_accounts_list->lTotalRecs = $banks_accounts->SelectRecordCount();
	} else {
		if ($rs = $banks_accounts_list->LoadRecordset())
			$banks_accounts_list->lTotalRecs = $rs->RecordCount();
	}
	$banks_accounts_list->lStartRec = 1;
	if ($banks_accounts_list->lDisplayRecs <= 0 || ($banks_accounts->Export <> "" && $banks_accounts->ExportAll)) // Display all records
		$banks_accounts_list->lDisplayRecs = $banks_accounts_list->lTotalRecs;
	if (!($banks_accounts->Export <> "" && $banks_accounts->ExportAll))
		$banks_accounts_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $banks_accounts_list->LoadRecordset($banks_accounts_list->lStartRec-1, $banks_accounts_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banks_accounts->TableCaption() ?>
<?php if ($banks_accounts->Export == "" && $banks_accounts->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $banks_accounts_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $banks_accounts_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $banks_accounts_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($banks_accounts->Export == "" && $banks_accounts->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(banks_accounts_list);" style="text-decoration: none;"><img id="banks_accounts_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="banks_accounts_list_SearchPanel">
<form name="fbanks_accountslistsrch" id="fbanks_accountslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="banks_accounts">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($banks_accounts->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $banks_accounts_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($banks_accounts->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($banks_accounts->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($banks_accounts->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$banks_accounts_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($banks_accounts->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($banks_accounts->CurrentAction <> "gridadd" && $banks_accounts->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($banks_accounts_list->Pager)) $banks_accounts_list->Pager = new cPrevNextPager($banks_accounts_list->lStartRec, $banks_accounts_list->lDisplayRecs, $banks_accounts_list->lTotalRecs) ?>
<?php if ($banks_accounts_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($banks_accounts_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $banks_accounts_list->PageUrl() ?>start=<?php echo $banks_accounts_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($banks_accounts_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $banks_accounts_list->PageUrl() ?>start=<?php echo $banks_accounts_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $banks_accounts_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($banks_accounts_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $banks_accounts_list->PageUrl() ?>start=<?php echo $banks_accounts_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($banks_accounts_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $banks_accounts_list->PageUrl() ?>start=<?php echo $banks_accounts_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $banks_accounts_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $banks_accounts_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $banks_accounts_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $banks_accounts_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($banks_accounts_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($banks_accounts_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="banks_accounts">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($banks_accounts_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($banks_accounts_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($banks_accounts_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($banks_accounts_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($banks_accounts_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($banks_accounts_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($banks_accounts->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $banks_accounts_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($banks_accounts_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fbanks_accountslist, '<?php echo $banks_accounts_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fbanks_accountslist" id="fbanks_accountslist" class="ewForm" action="" method="post">
<div id="gmp_banks_accounts" class="ewGridMiddlePanel">
<?php if ($banks_accounts_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $banks_accounts->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$banks_accounts_list->RenderListOptions();

// Render list options (header, left)
$banks_accounts_list->ListOptions->Render("header", "left");
?>
<?php if ($banks_accounts->id->Visible) { // id ?>
	<?php if ($banks_accounts->SortUrl($banks_accounts->id) == "") { ?>
		<td><?php echo $banks_accounts->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banks_accounts->SortUrl($banks_accounts->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banks_accounts->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($banks_accounts->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banks_accounts->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banks_accounts->Bank_Name->Visible) { // Bank_Name ?>
	<?php if ($banks_accounts->SortUrl($banks_accounts->Bank_Name) == "") { ?>
		<td><?php echo $banks_accounts->Bank_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banks_accounts->SortUrl($banks_accounts->Bank_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banks_accounts->Bank_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($banks_accounts->Bank_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banks_accounts->Bank_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banks_accounts->Branch->Visible) { // Branch ?>
	<?php if ($banks_accounts->SortUrl($banks_accounts->Branch) == "") { ?>
		<td><?php echo $banks_accounts->Branch->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banks_accounts->SortUrl($banks_accounts->Branch) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banks_accounts->Branch->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($banks_accounts->Branch->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banks_accounts->Branch->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banks_accounts->Account_Name->Visible) { // Account_Name ?>
	<?php if ($banks_accounts->SortUrl($banks_accounts->Account_Name) == "") { ?>
		<td><?php echo $banks_accounts->Account_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banks_accounts->SortUrl($banks_accounts->Account_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banks_accounts->Account_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($banks_accounts->Account_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banks_accounts->Account_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banks_accounts->Account_Number->Visible) { // Account_Number ?>
	<?php if ($banks_accounts->SortUrl($banks_accounts->Account_Number) == "") { ?>
		<td><?php echo $banks_accounts->Account_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banks_accounts->SortUrl($banks_accounts->Account_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banks_accounts->Account_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($banks_accounts->Account_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banks_accounts->Account_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banks_accounts->Account_Type->Visible) { // Account_Type ?>
	<?php if ($banks_accounts->SortUrl($banks_accounts->Account_Type) == "") { ?>
		<td><?php echo $banks_accounts->Account_Type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banks_accounts->SortUrl($banks_accounts->Account_Type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banks_accounts->Account_Type->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($banks_accounts->Account_Type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banks_accounts->Account_Type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banks_accounts->Remarks->Visible) { // Remarks ?>
	<?php if ($banks_accounts->SortUrl($banks_accounts->Remarks) == "") { ?>
		<td><?php echo $banks_accounts->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banks_accounts->SortUrl($banks_accounts->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banks_accounts->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($banks_accounts->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banks_accounts->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($banks_accounts->Company->Visible) { // Company ?>
	<?php if ($banks_accounts->SortUrl($banks_accounts->Company) == "") { ?>
		<td><?php echo $banks_accounts->Company->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $banks_accounts->SortUrl($banks_accounts->Company) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $banks_accounts->Company->FldCaption() ?></td><td style="width: 10px;"><?php if ($banks_accounts->Company->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($banks_accounts->Company->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$banks_accounts_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($banks_accounts->ExportAll && $banks_accounts->Export <> "") {
	$banks_accounts_list->lStopRec = $banks_accounts_list->lTotalRecs;
} else {
	$banks_accounts_list->lStopRec = $banks_accounts_list->lStartRec + $banks_accounts_list->lDisplayRecs - 1; // Set the last record to display
}
$banks_accounts_list->lRecCount = $banks_accounts_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $banks_accounts_list->lStartRec > 1)
		$rs->Move($banks_accounts_list->lStartRec - 1);
}

// Initialize aggregate
$banks_accounts->RowType = EW_ROWTYPE_AGGREGATEINIT;
$banks_accounts_list->RenderRow();
$banks_accounts_list->lRowCnt = 0;
while (($banks_accounts->CurrentAction == "gridadd" || !$rs->EOF) &&
	$banks_accounts_list->lRecCount < $banks_accounts_list->lStopRec) {
	$banks_accounts_list->lRecCount++;
	if (intval($banks_accounts_list->lRecCount) >= intval($banks_accounts_list->lStartRec)) {
		$banks_accounts_list->lRowCnt++;

	// Init row class and style
	$banks_accounts->CssClass = "";
	$banks_accounts->CssStyle = "";
	$banks_accounts->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($banks_accounts->CurrentAction == "gridadd") {
		$banks_accounts_list->LoadDefaultValues(); // Load default values
	} else {
		$banks_accounts_list->LoadRowValues($rs); // Load row values
	}
	$banks_accounts->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$banks_accounts_list->RenderRow();

	// Render list options
	$banks_accounts_list->RenderListOptions();
?>
	<tr<?php echo $banks_accounts->RowAttributes() ?>>
<?php

// Render list options (body, left)
$banks_accounts_list->ListOptions->Render("body", "left");
?>
	<?php if ($banks_accounts->id->Visible) { // id ?>
		<td<?php echo $banks_accounts->id->CellAttributes() ?>>
<div<?php echo $banks_accounts->id->ViewAttributes() ?>><?php echo $banks_accounts->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banks_accounts->Bank_Name->Visible) { // Bank_Name ?>
		<td<?php echo $banks_accounts->Bank_Name->CellAttributes() ?>>
<div<?php echo $banks_accounts->Bank_Name->ViewAttributes() ?>><?php echo $banks_accounts->Bank_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banks_accounts->Branch->Visible) { // Branch ?>
		<td<?php echo $banks_accounts->Branch->CellAttributes() ?>>
<div<?php echo $banks_accounts->Branch->ViewAttributes() ?>><?php echo $banks_accounts->Branch->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banks_accounts->Account_Name->Visible) { // Account_Name ?>
		<td<?php echo $banks_accounts->Account_Name->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Name->ViewAttributes() ?>><?php echo $banks_accounts->Account_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banks_accounts->Account_Number->Visible) { // Account_Number ?>
		<td<?php echo $banks_accounts->Account_Number->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Number->ViewAttributes() ?>><?php echo $banks_accounts->Account_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banks_accounts->Account_Type->Visible) { // Account_Type ?>
		<td<?php echo $banks_accounts->Account_Type->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Type->ViewAttributes() ?>><?php echo $banks_accounts->Account_Type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banks_accounts->Remarks->Visible) { // Remarks ?>
		<td<?php echo $banks_accounts->Remarks->CellAttributes() ?>>
<div<?php echo $banks_accounts->Remarks->ViewAttributes() ?>><?php echo $banks_accounts->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($banks_accounts->Company->Visible) { // Company ?>
		<td<?php echo $banks_accounts->Company->CellAttributes() ?>>
<div<?php echo $banks_accounts->Company->ViewAttributes() ?>><?php echo $banks_accounts->Company->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$banks_accounts_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($banks_accounts->CurrentAction <> "gridadd")
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
<?php if ($banks_accounts_list->lTotalRecs > 0) { ?>
<?php if ($banks_accounts->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($banks_accounts->CurrentAction <> "gridadd" && $banks_accounts->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($banks_accounts_list->Pager)) $banks_accounts_list->Pager = new cPrevNextPager($banks_accounts_list->lStartRec, $banks_accounts_list->lDisplayRecs, $banks_accounts_list->lTotalRecs) ?>
<?php if ($banks_accounts_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($banks_accounts_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $banks_accounts_list->PageUrl() ?>start=<?php echo $banks_accounts_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($banks_accounts_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $banks_accounts_list->PageUrl() ?>start=<?php echo $banks_accounts_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $banks_accounts_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($banks_accounts_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $banks_accounts_list->PageUrl() ?>start=<?php echo $banks_accounts_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($banks_accounts_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $banks_accounts_list->PageUrl() ?>start=<?php echo $banks_accounts_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $banks_accounts_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $banks_accounts_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $banks_accounts_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $banks_accounts_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($banks_accounts_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($banks_accounts_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="banks_accounts">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($banks_accounts_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($banks_accounts_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($banks_accounts_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($banks_accounts_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($banks_accounts_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($banks_accounts_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($banks_accounts->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($banks_accounts_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $banks_accounts_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($banks_accounts_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fbanks_accountslist, '<?php echo $banks_accounts_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($banks_accounts->Export == "" && $banks_accounts->CurrentAction == "") { ?>
<?php } ?>
<?php if ($banks_accounts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$banks_accounts_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanks_accounts_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'banks_accounts';

	// Page object name
	var $PageObjName = 'banks_accounts_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banks_accounts;
		if ($banks_accounts->UseTokenInUrl) $PageUrl .= "t=" . $banks_accounts->TableVar . "&"; // Add page token
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
		global $objForm, $banks_accounts;
		if ($banks_accounts->UseTokenInUrl) {
			if ($objForm)
				return ($banks_accounts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banks_accounts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanks_accounts_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (banks_accounts)
		$GLOBALS["banks_accounts"] = new cbanks_accounts();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["banks_accounts"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "banks_accountsdelete.php";
		$this->MultiUpdateUrl = "banks_accountsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (company)
		$GLOBALS['company'] = new ccompany();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banks_accounts', TRUE);

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
		global $banks_accounts;

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
			$banks_accounts->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$banks_accounts->Export = $_POST["exporttype"];
		} else {
			$banks_accounts->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $banks_accounts->Export; // Get export parameter, used in header
		$gsExportFile = $banks_accounts->TableVar; // Get export file, used in header
		if ($banks_accounts->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $banks_accounts;

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
			$banks_accounts->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($banks_accounts->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $banks_accounts->getRecordsPerPage(); // Restore from Session
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
		$banks_accounts->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$banks_accounts->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$banks_accounts->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $banks_accounts->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $banks_accounts->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $banks_accounts->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($banks_accounts->getMasterFilter() <> "" && $banks_accounts->getCurrentMasterTable() == "company") {
			global $company;
			$rsmaster = $company->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$banks_accounts->setMasterFilter(""); // Clear master filter
				$banks_accounts->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($banks_accounts->getReturnUrl()); // Return to caller
			} else {
				$company->LoadListRowValues($rsmaster);
				$company->RowType = EW_ROWTYPE_MASTER; // Master row
				$company->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$banks_accounts->setSessionWhere($sFilter);
		$banks_accounts->CurrentFilter = "";

		// Export data only
		if (in_array($banks_accounts->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($banks_accounts->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $banks_accounts;
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
			$banks_accounts->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$banks_accounts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $banks_accounts;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $banks_accounts->Bank_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $banks_accounts->Branch, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $banks_accounts->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $banks_accounts->Account_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $banks_accounts->Account_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $banks_accounts->Account_Type, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $banks_accounts->Remarks, $Keyword);
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
		global $Security, $banks_accounts;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $banks_accounts->BasicSearchKeyword;
		$sSearchType = $banks_accounts->BasicSearchType;
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
			$banks_accounts->setSessionBasicSearchKeyword($sSearchKeyword);
			$banks_accounts->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $banks_accounts;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$banks_accounts->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $banks_accounts;
		$banks_accounts->setSessionBasicSearchKeyword("");
		$banks_accounts->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $banks_accounts;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$banks_accounts->BasicSearchKeyword = $banks_accounts->getSessionBasicSearchKeyword();
			$banks_accounts->BasicSearchType = $banks_accounts->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $banks_accounts;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$banks_accounts->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$banks_accounts->CurrentOrderType = @$_GET["ordertype"];
			$banks_accounts->UpdateSort($banks_accounts->id); // id
			$banks_accounts->UpdateSort($banks_accounts->Bank_Name); // Bank_Name
			$banks_accounts->UpdateSort($banks_accounts->Branch); // Branch
			$banks_accounts->UpdateSort($banks_accounts->Account_Name); // Account_Name
			$banks_accounts->UpdateSort($banks_accounts->Account_Number); // Account_Number
			$banks_accounts->UpdateSort($banks_accounts->Account_Type); // Account_Type
			$banks_accounts->UpdateSort($banks_accounts->Remarks); // Remarks
			$banks_accounts->UpdateSort($banks_accounts->Company); // Company
			$banks_accounts->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $banks_accounts;
		$sOrderBy = $banks_accounts->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($banks_accounts->SqlOrderBy() <> "") {
				$sOrderBy = $banks_accounts->SqlOrderBy();
				$banks_accounts->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $banks_accounts;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$banks_accounts->getCurrentMasterTable = ""; // Clear master table
				$banks_accounts->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$banks_accounts->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$banks_accounts->Company->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$banks_accounts->setSessionOrderBy($sOrderBy);
				$banks_accounts->id->setSort("");
				$banks_accounts->Bank_Name->setSort("");
				$banks_accounts->Branch->setSort("");
				$banks_accounts->Account_Name->setSort("");
				$banks_accounts->Account_Number->setSort("");
				$banks_accounts->Account_Type->setSort("");
				$banks_accounts->Remarks->setSort("");
				$banks_accounts->Company->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$banks_accounts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $banks_accounts;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"banks_accounts_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($banks_accounts->Export <> "" ||
			$banks_accounts->CurrentAction == "gridadd" ||
			$banks_accounts->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $banks_accounts;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($banks_accounts->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $banks_accounts;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $banks_accounts;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$banks_accounts->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$banks_accounts->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $banks_accounts->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$banks_accounts->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$banks_accounts->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$banks_accounts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $banks_accounts;
		$banks_accounts->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$banks_accounts->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $banks_accounts;

		// Call Recordset Selecting event
		$banks_accounts->Recordset_Selecting($banks_accounts->CurrentFilter);

		// Load List page SQL
		$sSql = $banks_accounts->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$banks_accounts->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banks_accounts;
		$sFilter = $banks_accounts->KeyFilter();

		// Call Row Selecting event
		$banks_accounts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banks_accounts->CurrentFilter = $sFilter;
		$sSql = $banks_accounts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$banks_accounts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $banks_accounts;
		$banks_accounts->id->setDbValue($rs->fields('id'));
		$banks_accounts->Bank_Name->setDbValue($rs->fields('Bank_Name'));
		$banks_accounts->Branch->setDbValue($rs->fields('Branch'));
		$banks_accounts->Address->setDbValue($rs->fields('Address'));
		$banks_accounts->Account_Name->setDbValue($rs->fields('Account_Name'));
		$banks_accounts->Account_Number->setDbValue($rs->fields('Account_Number'));
		$banks_accounts->Account_Type->setDbValue($rs->fields('Account_Type'));
		$banks_accounts->Remarks->setDbValue($rs->fields('Remarks'));
		$banks_accounts->Company->setDbValue($rs->fields('Company'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banks_accounts;

		// Initialize URLs
		$this->ViewUrl = $banks_accounts->ViewUrl();
		$this->EditUrl = $banks_accounts->EditUrl();
		$this->InlineEditUrl = $banks_accounts->InlineEditUrl();
		$this->CopyUrl = $banks_accounts->CopyUrl();
		$this->InlineCopyUrl = $banks_accounts->InlineCopyUrl();
		$this->DeleteUrl = $banks_accounts->DeleteUrl();

		// Call Row_Rendering event
		$banks_accounts->Row_Rendering();

		// Common render codes for all row types
		// id

		$banks_accounts->id->CellCssStyle = ""; $banks_accounts->id->CellCssClass = "";
		$banks_accounts->id->CellAttrs = array(); $banks_accounts->id->ViewAttrs = array(); $banks_accounts->id->EditAttrs = array();

		// Bank_Name
		$banks_accounts->Bank_Name->CellCssStyle = ""; $banks_accounts->Bank_Name->CellCssClass = "";
		$banks_accounts->Bank_Name->CellAttrs = array(); $banks_accounts->Bank_Name->ViewAttrs = array(); $banks_accounts->Bank_Name->EditAttrs = array();

		// Branch
		$banks_accounts->Branch->CellCssStyle = ""; $banks_accounts->Branch->CellCssClass = "";
		$banks_accounts->Branch->CellAttrs = array(); $banks_accounts->Branch->ViewAttrs = array(); $banks_accounts->Branch->EditAttrs = array();

		// Account_Name
		$banks_accounts->Account_Name->CellCssStyle = ""; $banks_accounts->Account_Name->CellCssClass = "";
		$banks_accounts->Account_Name->CellAttrs = array(); $banks_accounts->Account_Name->ViewAttrs = array(); $banks_accounts->Account_Name->EditAttrs = array();

		// Account_Number
		$banks_accounts->Account_Number->CellCssStyle = ""; $banks_accounts->Account_Number->CellCssClass = "";
		$banks_accounts->Account_Number->CellAttrs = array(); $banks_accounts->Account_Number->ViewAttrs = array(); $banks_accounts->Account_Number->EditAttrs = array();

		// Account_Type
		$banks_accounts->Account_Type->CellCssStyle = ""; $banks_accounts->Account_Type->CellCssClass = "";
		$banks_accounts->Account_Type->CellAttrs = array(); $banks_accounts->Account_Type->ViewAttrs = array(); $banks_accounts->Account_Type->EditAttrs = array();

		// Remarks
		$banks_accounts->Remarks->CellCssStyle = ""; $banks_accounts->Remarks->CellCssClass = "";
		$banks_accounts->Remarks->CellAttrs = array(); $banks_accounts->Remarks->ViewAttrs = array(); $banks_accounts->Remarks->EditAttrs = array();

		// Company
		$banks_accounts->Company->CellCssStyle = ""; $banks_accounts->Company->CellCssClass = "";
		$banks_accounts->Company->CellAttrs = array(); $banks_accounts->Company->ViewAttrs = array(); $banks_accounts->Company->EditAttrs = array();
		if ($banks_accounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$banks_accounts->id->ViewValue = $banks_accounts->id->CurrentValue;
			$banks_accounts->id->CssStyle = "";
			$banks_accounts->id->CssClass = "";
			$banks_accounts->id->ViewCustomAttributes = "";

			// Bank_Name
			$banks_accounts->Bank_Name->ViewValue = $banks_accounts->Bank_Name->CurrentValue;
			$banks_accounts->Bank_Name->CssStyle = "";
			$banks_accounts->Bank_Name->CssClass = "";
			$banks_accounts->Bank_Name->ViewCustomAttributes = "";

			// Branch
			$banks_accounts->Branch->ViewValue = $banks_accounts->Branch->CurrentValue;
			$banks_accounts->Branch->CssStyle = "";
			$banks_accounts->Branch->CssClass = "";
			$banks_accounts->Branch->ViewCustomAttributes = "";

			// Account_Name
			$banks_accounts->Account_Name->ViewValue = $banks_accounts->Account_Name->CurrentValue;
			$banks_accounts->Account_Name->CssStyle = "";
			$banks_accounts->Account_Name->CssClass = "";
			$banks_accounts->Account_Name->ViewCustomAttributes = "";

			// Account_Number
			$banks_accounts->Account_Number->ViewValue = $banks_accounts->Account_Number->CurrentValue;
			$banks_accounts->Account_Number->CssStyle = "";
			$banks_accounts->Account_Number->CssClass = "";
			$banks_accounts->Account_Number->ViewCustomAttributes = "";

			// Account_Type
			$banks_accounts->Account_Type->ViewValue = $banks_accounts->Account_Type->CurrentValue;
			$banks_accounts->Account_Type->CssStyle = "";
			$banks_accounts->Account_Type->CssClass = "";
			$banks_accounts->Account_Type->ViewCustomAttributes = "";

			// Remarks
			$banks_accounts->Remarks->ViewValue = $banks_accounts->Remarks->CurrentValue;
			$banks_accounts->Remarks->CssStyle = "";
			$banks_accounts->Remarks->CssClass = "";
			$banks_accounts->Remarks->ViewCustomAttributes = "";

			// Company
			if (strval($banks_accounts->Company->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($banks_accounts->Company->CurrentValue) . "";
			$sSqlWrk = "SELECT `Company_Name` FROM `company`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Company_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banks_accounts->Company->ViewValue = $rswrk->fields('Company_Name');
					$rswrk->Close();
				} else {
					$banks_accounts->Company->ViewValue = $banks_accounts->Company->CurrentValue;
				}
			} else {
				$banks_accounts->Company->ViewValue = NULL;
			}
			$banks_accounts->Company->CssStyle = "";
			$banks_accounts->Company->CssClass = "";
			$banks_accounts->Company->ViewCustomAttributes = "";

			// id
			$banks_accounts->id->HrefValue = "";
			$banks_accounts->id->TooltipValue = "";

			// Bank_Name
			$banks_accounts->Bank_Name->HrefValue = "";
			$banks_accounts->Bank_Name->TooltipValue = "";

			// Branch
			$banks_accounts->Branch->HrefValue = "";
			$banks_accounts->Branch->TooltipValue = "";

			// Account_Name
			$banks_accounts->Account_Name->HrefValue = "";
			$banks_accounts->Account_Name->TooltipValue = "";

			// Account_Number
			$banks_accounts->Account_Number->HrefValue = "";
			$banks_accounts->Account_Number->TooltipValue = "";

			// Account_Type
			$banks_accounts->Account_Type->HrefValue = "";
			$banks_accounts->Account_Type->TooltipValue = "";

			// Remarks
			$banks_accounts->Remarks->HrefValue = "";
			$banks_accounts->Remarks->TooltipValue = "";

			// Company
			$banks_accounts->Company->HrefValue = "";
			$banks_accounts->Company->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($banks_accounts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banks_accounts->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $banks_accounts;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $banks_accounts->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($banks_accounts->ExportAll) {
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
		if ($banks_accounts->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($banks_accounts, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($banks_accounts->id);
				$ExportDoc->ExportCaption($banks_accounts->Bank_Name);
				$ExportDoc->ExportCaption($banks_accounts->Branch);
				$ExportDoc->ExportCaption($banks_accounts->Account_Name);
				$ExportDoc->ExportCaption($banks_accounts->Account_Number);
				$ExportDoc->ExportCaption($banks_accounts->Account_Type);
				$ExportDoc->ExportCaption($banks_accounts->Company);
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
				$banks_accounts->CssClass = "";
				$banks_accounts->CssStyle = "";
				$banks_accounts->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($banks_accounts->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $banks_accounts->id->ExportValue($banks_accounts->Export, $banks_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Bank_Name', $banks_accounts->Bank_Name->ExportValue($banks_accounts->Export, $banks_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Branch', $banks_accounts->Branch->ExportValue($banks_accounts->Export, $banks_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Account_Name', $banks_accounts->Account_Name->ExportValue($banks_accounts->Export, $banks_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Account_Number', $banks_accounts->Account_Number->ExportValue($banks_accounts->Export, $banks_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Account_Type', $banks_accounts->Account_Type->ExportValue($banks_accounts->Export, $banks_accounts->ExportOriginalValue));
					$XmlDoc->AddField('Company', $banks_accounts->Company->ExportValue($banks_accounts->Export, $banks_accounts->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($banks_accounts->id);
					$ExportDoc->ExportField($banks_accounts->Bank_Name);
					$ExportDoc->ExportField($banks_accounts->Branch);
					$ExportDoc->ExportField($banks_accounts->Account_Name);
					$ExportDoc->ExportField($banks_accounts->Account_Number);
					$ExportDoc->ExportField($banks_accounts->Account_Type);
					$ExportDoc->ExportField($banks_accounts->Company);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($banks_accounts->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($banks_accounts->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($banks_accounts->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($banks_accounts->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($banks_accounts->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $banks_accounts;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "company") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $banks_accounts->SqlMasterFilter_company();
				$this->sDbDetailFilter = $banks_accounts->SqlDetailFilter_company();
				if (@$_GET["id"] <> "") {
					$GLOBALS["company"]->id->setQueryStringValue($_GET["id"]);
					$banks_accounts->Company->setQueryStringValue($GLOBALS["company"]->id->QueryStringValue);
					$banks_accounts->Company->setSessionValue($banks_accounts->Company->QueryStringValue);
					if (!is_numeric($GLOBALS["company"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["company"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Company@", ew_AdjustSql($GLOBALS["company"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$banks_accounts->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$banks_accounts->setStartRecordNumber($this->lStartRec);
			$banks_accounts->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$banks_accounts->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "company") {
				if ($banks_accounts->Company->QueryStringValue == "") $banks_accounts->Company->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $banks_accounts->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $banks_accounts->getDetailFilter(); // Restore detail filter
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
