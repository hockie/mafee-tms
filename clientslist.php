<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "clientsinfo.php" ?>
<?php include "bookingsinfo.php" ?>
<?php include "ratesinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "invoicesinfo.php" ?>
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
$clients_list = new cclients_list();
$Page =& $clients_list;

// Page init
$clients_list->Page_Init();

// Page main
$clients_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($clients->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var clients_list = new ew_Page("clients_list");

// page properties
clients_list.PageID = "list"; // page ID
clients_list.FormID = "fclientslist"; // form ID
var EW_PAGE_ID = clients_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
clients_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
clients_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
clients_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
clients_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($clients->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$clients_list->lTotalRecs = $clients->SelectRecordCount();
	} else {
		if ($rs = $clients_list->LoadRecordset())
			$clients_list->lTotalRecs = $rs->RecordCount();
	}
	$clients_list->lStartRec = 1;
	if ($clients_list->lDisplayRecs <= 0 || ($clients->Export <> "" && $clients->ExportAll)) // Display all records
		$clients_list->lDisplayRecs = $clients_list->lTotalRecs;
	if (!($clients->Export <> "" && $clients->ExportAll))
		$clients_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $clients_list->LoadRecordset($clients_list->lStartRec-1, $clients_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $clients->TableCaption() ?>
<?php if ($clients->Export == "" && $clients->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $clients_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $clients_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $clients_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($clients->Export == "" && $clients->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(clients_list);" style="text-decoration: none;"><img id="clients_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="clients_list_SearchPanel">
<form name="fclientslistsrch" id="fclientslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="clients">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($clients->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $clients_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($clients->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($clients->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($clients->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$clients_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($clients->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($clients->CurrentAction <> "gridadd" && $clients->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($clients_list->Pager)) $clients_list->Pager = new cPrevNextPager($clients_list->lStartRec, $clients_list->lDisplayRecs, $clients_list->lTotalRecs) ?>
<?php if ($clients_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($clients_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($clients_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $clients_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($clients_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($clients_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $clients_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $clients_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $clients_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $clients_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($clients_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($clients_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="clients">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($clients_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($clients_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($clients_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($clients_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($clients_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($clients_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($clients->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $clients_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($clients_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fclientslist, '<?php echo $clients_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fclientslist" id="fclientslist" class="ewForm" action="" method="post">
<div id="gmp_clients" class="ewGridMiddlePanel">
<?php if ($clients_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $clients->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$clients_list->RenderListOptions();

// Render list options (header, left)
$clients_list->ListOptions->Render("header", "left");
?>
<?php if ($clients->id->Visible) { // id ?>
	<?php if ($clients->SortUrl($clients->id) == "") { ?>
		<td><?php echo $clients->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($clients->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->Account_No->Visible) { // Account_No ?>
	<?php if ($clients->SortUrl($clients->Account_No) == "") { ?>
		<td><?php echo $clients->Account_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->Account_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->Account_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($clients->Account_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->Account_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->Alias->Visible) { // Alias ?>
	<?php if ($clients->SortUrl($clients->Alias) == "") { ?>
		<td><?php echo $clients->Alias->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->Alias) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->Alias->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($clients->Alias->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->Alias->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->Client_Name->Visible) { // Client_Name ?>
	<?php if ($clients->SortUrl($clients->Client_Name) == "") { ?>
		<td><?php echo $clients->Client_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->Client_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->Client_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($clients->Client_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->Client_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->Address->Visible) { // Address ?>
	<?php if ($clients->SortUrl($clients->Address) == "") { ?>
		<td><?php echo $clients->Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($clients->Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->Contact_No->Visible) { // Contact_No ?>
	<?php if ($clients->SortUrl($clients->Contact_No) == "") { ?>
		<td><?php echo $clients->Contact_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->Contact_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->Contact_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($clients->Contact_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->Contact_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->Email_Address->Visible) { // Email_Address ?>
	<?php if ($clients->SortUrl($clients->Email_Address) == "") { ?>
		<td><?php echo $clients->Email_Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->Email_Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->Email_Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($clients->Email_Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->Email_Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->TIN_No->Visible) { // TIN_No ?>
	<?php if ($clients->SortUrl($clients->TIN_No) == "") { ?>
		<td><?php echo $clients->TIN_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->TIN_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->TIN_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($clients->TIN_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->TIN_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->Contact_Person->Visible) { // Contact_Person ?>
	<?php if ($clients->SortUrl($clients->Contact_Person) == "") { ?>
		<td><?php echo $clients->Contact_Person->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->Contact_Person) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->Contact_Person->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($clients->Contact_Person->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->Contact_Person->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($clients->File_Upload->Visible) { // File_Upload ?>
	<?php if ($clients->SortUrl($clients->File_Upload) == "") { ?>
		<td><?php echo $clients->File_Upload->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->File_Upload) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $clients->File_Upload->FldCaption() ?></td><td style="width: 10px;"><?php if ($clients->File_Upload->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->File_Upload->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$clients_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($clients->ExportAll && $clients->Export <> "") {
	$clients_list->lStopRec = $clients_list->lTotalRecs;
} else {
	$clients_list->lStopRec = $clients_list->lStartRec + $clients_list->lDisplayRecs - 1; // Set the last record to display
}
$clients_list->lRecCount = $clients_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $clients_list->lStartRec > 1)
		$rs->Move($clients_list->lStartRec - 1);
}

// Initialize aggregate
$clients->RowType = EW_ROWTYPE_AGGREGATEINIT;
$clients_list->RenderRow();
$clients_list->lRowCnt = 0;
while (($clients->CurrentAction == "gridadd" || !$rs->EOF) &&
	$clients_list->lRecCount < $clients_list->lStopRec) {
	$clients_list->lRecCount++;
	if (intval($clients_list->lRecCount) >= intval($clients_list->lStartRec)) {
		$clients_list->lRowCnt++;

	// Init row class and style
	$clients->CssClass = "";
	$clients->CssStyle = "";
	$clients->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($clients->CurrentAction == "gridadd") {
		$clients_list->LoadDefaultValues(); // Load default values
	} else {
		$clients_list->LoadRowValues($rs); // Load row values
	}
	$clients->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$clients_list->RenderRow();

	// Render list options
	$clients_list->RenderListOptions();
?>
	<tr<?php echo $clients->RowAttributes() ?>>
<?php

// Render list options (body, left)
$clients_list->ListOptions->Render("body", "left");
?>
	<?php if ($clients->id->Visible) { // id ?>
		<td<?php echo $clients->id->CellAttributes() ?>>
<div<?php echo $clients->id->ViewAttributes() ?>><?php echo $clients->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->Account_No->Visible) { // Account_No ?>
		<td<?php echo $clients->Account_No->CellAttributes() ?>>
<div<?php echo $clients->Account_No->ViewAttributes() ?>><?php echo $clients->Account_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->Alias->Visible) { // Alias ?>
		<td<?php echo $clients->Alias->CellAttributes() ?>>
<div<?php echo $clients->Alias->ViewAttributes() ?>><?php echo $clients->Alias->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->Client_Name->Visible) { // Client_Name ?>
		<td<?php echo $clients->Client_Name->CellAttributes() ?>>
<div<?php echo $clients->Client_Name->ViewAttributes() ?>><?php echo $clients->Client_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->Address->Visible) { // Address ?>
		<td<?php echo $clients->Address->CellAttributes() ?>>
<div<?php echo $clients->Address->ViewAttributes() ?>><?php echo $clients->Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->Contact_No->Visible) { // Contact_No ?>
		<td<?php echo $clients->Contact_No->CellAttributes() ?>>
<div<?php echo $clients->Contact_No->ViewAttributes() ?>><?php echo $clients->Contact_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->Email_Address->Visible) { // Email_Address ?>
		<td<?php echo $clients->Email_Address->CellAttributes() ?>>
<div<?php echo $clients->Email_Address->ViewAttributes() ?>><?php echo $clients->Email_Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->TIN_No->Visible) { // TIN_No ?>
		<td<?php echo $clients->TIN_No->CellAttributes() ?>>
<div<?php echo $clients->TIN_No->ViewAttributes() ?>><?php echo $clients->TIN_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->Contact_Person->Visible) { // Contact_Person ?>
		<td<?php echo $clients->Contact_Person->CellAttributes() ?>>
<div<?php echo $clients->Contact_Person->ViewAttributes() ?>><?php echo $clients->Contact_Person->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($clients->File_Upload->Visible) { // File_Upload ?>
		<td<?php echo $clients->File_Upload->CellAttributes() ?>>
<?php if ($clients->File_Upload->HrefValue <> "" || $clients->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($clients->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $clients->File_Upload->HrefValue ?>"><?php echo $clients->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($clients->File_Upload->Upload->DbValue)) { ?>
<?php echo $clients->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$clients_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($clients->CurrentAction <> "gridadd")
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
<?php if ($clients_list->lTotalRecs > 0) { ?>
<?php if ($clients->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($clients->CurrentAction <> "gridadd" && $clients->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($clients_list->Pager)) $clients_list->Pager = new cPrevNextPager($clients_list->lStartRec, $clients_list->lDisplayRecs, $clients_list->lTotalRecs) ?>
<?php if ($clients_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($clients_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($clients_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $clients_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($clients_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($clients_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $clients_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $clients_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $clients_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $clients_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($clients_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($clients_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="clients">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($clients_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($clients_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($clients_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($clients_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($clients_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($clients_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($clients->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($clients_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $clients_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($clients_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fclientslist, '<?php echo $clients_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($clients->Export == "" && $clients->CurrentAction == "") { ?>
<?php } ?>
<?php if ($clients->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$clients_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cclients_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'clients';

	// Page object name
	var $PageObjName = 'clients_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $clients;
		if ($clients->UseTokenInUrl) $PageUrl .= "t=" . $clients->TableVar . "&"; // Add page token
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
		global $objForm, $clients;
		if ($clients->UseTokenInUrl) {
			if ($objForm)
				return ($clients->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($clients->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclients_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (clients)
		$GLOBALS["clients"] = new cclients();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["clients"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "clientsdelete.php";
		$this->MultiUpdateUrl = "clientsupdate.php";

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (rates)
		$GLOBALS['rates'] = new crates();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoices)
		$GLOBALS['invoices'] = new cinvoices();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'clients', TRUE);

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
		global $clients;

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
			$clients->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$clients->Export = $_POST["exporttype"];
		} else {
			$clients->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $clients->Export; // Get export parameter, used in header
		$gsExportFile = $clients->TableVar; // Get export file, used in header
		if ($clients->Export == "excel") {
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
	var $lbookings_Count;
	var $linvoices_Count;
	var $lrates_Count;
	var $laccount_payments_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $clients;

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
			$clients->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($clients->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $clients->getRecordsPerPage(); // Restore from Session
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
		$clients->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$clients->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$clients->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $clients->getSearchWhere();
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
		$clients->setSessionWhere($sFilter);
		$clients->CurrentFilter = "";

		// Export data only
		if (in_array($clients->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($clients->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $clients;
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
			$clients->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$clients->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $clients;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $clients->Account_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->Alias, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->Client_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->Contact_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->Email_Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->TIN_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->Contact_Person, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->File_Upload, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $clients->Remarks, $Keyword);
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
		global $Security, $clients;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $clients->BasicSearchKeyword;
		$sSearchType = $clients->BasicSearchType;
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
			$clients->setSessionBasicSearchKeyword($sSearchKeyword);
			$clients->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $clients;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$clients->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $clients;
		$clients->setSessionBasicSearchKeyword("");
		$clients->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $clients;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$clients->BasicSearchKeyword = $clients->getSessionBasicSearchKeyword();
			$clients->BasicSearchType = $clients->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $clients;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$clients->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$clients->CurrentOrderType = @$_GET["ordertype"];
			$clients->UpdateSort($clients->id); // id
			$clients->UpdateSort($clients->Account_No); // Account_No
			$clients->UpdateSort($clients->Alias); // Alias
			$clients->UpdateSort($clients->Client_Name); // Client_Name
			$clients->UpdateSort($clients->Address); // Address
			$clients->UpdateSort($clients->Contact_No); // Contact_No
			$clients->UpdateSort($clients->Email_Address); // Email_Address
			$clients->UpdateSort($clients->TIN_No); // TIN_No
			$clients->UpdateSort($clients->Contact_Person); // Contact_Person
			$clients->UpdateSort($clients->File_Upload); // File_Upload
			$clients->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $clients;
		$sOrderBy = $clients->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($clients->SqlOrderBy() <> "") {
				$sOrderBy = $clients->SqlOrderBy();
				$clients->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $clients;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$clients->setSessionOrderBy($sOrderBy);
				$clients->id->setSort("");
				$clients->Account_No->setSort("");
				$clients->Alias->setSort("");
				$clients->Client_Name->setSort("");
				$clients->Address->setSort("");
				$clients->Contact_No->setSort("");
				$clients->Email_Address->setSort("");
				$clients->TIN_No->setSort("");
				$clients->Contact_Person->setSort("");
				$clients->File_Upload->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$clients->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $clients;

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

		// "detail_bookings"
		$this->ListOptions->Add("detail_bookings");
		$item =& $this->ListOptions->Items["detail_bookings"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('bookings');
		$item->OnLeft = FALSE;

		// "detail_invoices"
		$this->ListOptions->Add("detail_invoices");
		$item =& $this->ListOptions->Items["detail_invoices"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('invoices');
		$item->OnLeft = FALSE;

		// "detail_rates"
		$this->ListOptions->Add("detail_rates");
		$item =& $this->ListOptions->Items["detail_rates"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('rates');
		$item->OnLeft = FALSE;

		// "detail_account_payments"
		$this->ListOptions->Add("detail_account_payments");
		$item =& $this->ListOptions->Items["detail_account_payments"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('account_payments');
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"clients_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($clients->Export <> "" ||
			$clients->CurrentAction == "gridadd" ||
			$clients->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $clients;
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

		// "detail_bookings"
		$oListOpt =& $this->ListOptions->Items["detail_bookings"];
		if ($Security->AllowList('bookings')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("bookings", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lbookings_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"bookingslist.php?" . EW_TABLE_SHOW_MASTER . "=clients&id=" . urlencode(strval($clients->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_invoices"
		$oListOpt =& $this->ListOptions->Items["detail_invoices"];
		if ($Security->AllowList('invoices')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("invoices", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->linvoices_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"invoiceslist.php?" . EW_TABLE_SHOW_MASTER . "=clients&id=" . urlencode(strval($clients->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_rates"
		$oListOpt =& $this->ListOptions->Items["detail_rates"];
		if ($Security->AllowList('rates')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("rates", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lrates_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"rateslist.php?" . EW_TABLE_SHOW_MASTER . "=clients&id=" . urlencode(strval($clients->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_account_payments"
		$oListOpt =& $this->ListOptions->Items["detail_account_payments"];
		if ($Security->AllowList('account_payments')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("account_payments", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->laccount_payments_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"account_paymentslist.php?" . EW_TABLE_SHOW_MASTER . "=clients&id=" . urlencode(strval($clients->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($clients->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $clients;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $clients;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$clients->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$clients->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $clients->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$clients->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$clients->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$clients->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $clients;
		$clients->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$clients->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $clients;

		// Call Recordset Selecting event
		$clients->Recordset_Selecting($clients->CurrentFilter);

		// Load List page SQL
		$sSql = $clients->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$clients->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();

		// Call Row Selecting event
		$clients->Row_Selecting($sFilter);

		// Load SQL based on filter
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$clients->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $clients;
		$clients->id->setDbValue($rs->fields('id'));
		$clients->Account_No->setDbValue($rs->fields('Account_No'));
		$clients->Alias->setDbValue($rs->fields('Alias'));
		$clients->Client_Name->setDbValue($rs->fields('Client_Name'));
		$clients->Address->setDbValue($rs->fields('Address'));
		$clients->Contact_No->setDbValue($rs->fields('Contact_No'));
		$clients->Email_Address->setDbValue($rs->fields('Email_Address'));
		$clients->TIN_No->setDbValue($rs->fields('TIN_No'));
		$clients->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$clients->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$clients->Remarks->setDbValue($rs->fields('Remarks'));
		$sDetailFilter = $GLOBALS["bookings"]->SqlDetailFilter_clients();
		$sDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($clients->id->DbValue), $sDetailFilter);
		$this->lbookings_Count = $GLOBALS["bookings"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["invoices"]->SqlDetailFilter_clients();
		$sDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($clients->id->DbValue), $sDetailFilter);
		$this->linvoices_Count = $GLOBALS["invoices"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["rates"]->SqlDetailFilter_clients();
		$sDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($clients->id->DbValue), $sDetailFilter);
		$this->lrates_Count = $GLOBALS["rates"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["account_payments"]->SqlDetailFilter_clients();
		$sDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($clients->id->DbValue), $sDetailFilter);
		$this->laccount_payments_Count = $GLOBALS["account_payments"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $clients;

		// Initialize URLs
		$this->ViewUrl = $clients->ViewUrl();
		$this->EditUrl = $clients->EditUrl();
		$this->InlineEditUrl = $clients->InlineEditUrl();
		$this->CopyUrl = $clients->CopyUrl();
		$this->InlineCopyUrl = $clients->InlineCopyUrl();
		$this->DeleteUrl = $clients->DeleteUrl();

		// Call Row_Rendering event
		$clients->Row_Rendering();

		// Common render codes for all row types
		// id

		$clients->id->CellCssStyle = ""; $clients->id->CellCssClass = "";
		$clients->id->CellAttrs = array(); $clients->id->ViewAttrs = array(); $clients->id->EditAttrs = array();

		// Account_No
		$clients->Account_No->CellCssStyle = ""; $clients->Account_No->CellCssClass = "";
		$clients->Account_No->CellAttrs = array(); $clients->Account_No->ViewAttrs = array(); $clients->Account_No->EditAttrs = array();

		// Alias
		$clients->Alias->CellCssStyle = ""; $clients->Alias->CellCssClass = "";
		$clients->Alias->CellAttrs = array(); $clients->Alias->ViewAttrs = array(); $clients->Alias->EditAttrs = array();

		// Client_Name
		$clients->Client_Name->CellCssStyle = ""; $clients->Client_Name->CellCssClass = "";
		$clients->Client_Name->CellAttrs = array(); $clients->Client_Name->ViewAttrs = array(); $clients->Client_Name->EditAttrs = array();

		// Address
		$clients->Address->CellCssStyle = ""; $clients->Address->CellCssClass = "";
		$clients->Address->CellAttrs = array(); $clients->Address->ViewAttrs = array(); $clients->Address->EditAttrs = array();

		// Contact_No
		$clients->Contact_No->CellCssStyle = ""; $clients->Contact_No->CellCssClass = "";
		$clients->Contact_No->CellAttrs = array(); $clients->Contact_No->ViewAttrs = array(); $clients->Contact_No->EditAttrs = array();

		// Email_Address
		$clients->Email_Address->CellCssStyle = ""; $clients->Email_Address->CellCssClass = "";
		$clients->Email_Address->CellAttrs = array(); $clients->Email_Address->ViewAttrs = array(); $clients->Email_Address->EditAttrs = array();

		// TIN_No
		$clients->TIN_No->CellCssStyle = ""; $clients->TIN_No->CellCssClass = "";
		$clients->TIN_No->CellAttrs = array(); $clients->TIN_No->ViewAttrs = array(); $clients->TIN_No->EditAttrs = array();

		// Contact_Person
		$clients->Contact_Person->CellCssStyle = ""; $clients->Contact_Person->CellCssClass = "";
		$clients->Contact_Person->CellAttrs = array(); $clients->Contact_Person->ViewAttrs = array(); $clients->Contact_Person->EditAttrs = array();

		// File_Upload
		$clients->File_Upload->CellCssStyle = ""; $clients->File_Upload->CellCssClass = "";
		$clients->File_Upload->CellAttrs = array(); $clients->File_Upload->ViewAttrs = array(); $clients->File_Upload->EditAttrs = array();
		if ($clients->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$clients->id->ViewValue = $clients->id->CurrentValue;
			$clients->id->CssStyle = "";
			$clients->id->CssClass = "";
			$clients->id->ViewCustomAttributes = "";

			// Account_No
			$clients->Account_No->ViewValue = $clients->Account_No->CurrentValue;
			$clients->Account_No->CssStyle = "";
			$clients->Account_No->CssClass = "";
			$clients->Account_No->ViewCustomAttributes = "";

			// Alias
			$clients->Alias->ViewValue = $clients->Alias->CurrentValue;
			$clients->Alias->CssStyle = "";
			$clients->Alias->CssClass = "";
			$clients->Alias->ViewCustomAttributes = "";

			// Client_Name
			$clients->Client_Name->ViewValue = $clients->Client_Name->CurrentValue;
			$clients->Client_Name->CssStyle = "";
			$clients->Client_Name->CssClass = "";
			$clients->Client_Name->ViewCustomAttributes = "";

			// Address
			$clients->Address->ViewValue = $clients->Address->CurrentValue;
			$clients->Address->CssStyle = "";
			$clients->Address->CssClass = "";
			$clients->Address->ViewCustomAttributes = "";

			// Contact_No
			$clients->Contact_No->ViewValue = $clients->Contact_No->CurrentValue;
			$clients->Contact_No->CssStyle = "";
			$clients->Contact_No->CssClass = "";
			$clients->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$clients->Email_Address->ViewValue = $clients->Email_Address->CurrentValue;
			$clients->Email_Address->CssStyle = "";
			$clients->Email_Address->CssClass = "";
			$clients->Email_Address->ViewCustomAttributes = "";

			// TIN_No
			$clients->TIN_No->ViewValue = $clients->TIN_No->CurrentValue;
			$clients->TIN_No->CssStyle = "";
			$clients->TIN_No->CssClass = "";
			$clients->TIN_No->ViewCustomAttributes = "";

			// Contact_Person
			$clients->Contact_Person->ViewValue = $clients->Contact_Person->CurrentValue;
			$clients->Contact_Person->CssStyle = "";
			$clients->Contact_Person->CssClass = "";
			$clients->Contact_Person->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->ViewValue = $clients->File_Upload->Upload->DbValue;
			} else {
				$clients->File_Upload->ViewValue = "";
			}
			$clients->File_Upload->CssStyle = "";
			$clients->File_Upload->CssClass = "";
			$clients->File_Upload->ViewCustomAttributes = "";

			// id
			$clients->id->HrefValue = "";
			$clients->id->TooltipValue = "";

			// Account_No
			$clients->Account_No->HrefValue = "";
			$clients->Account_No->TooltipValue = "";

			// Alias
			$clients->Alias->HrefValue = "";
			$clients->Alias->TooltipValue = "";

			// Client_Name
			$clients->Client_Name->HrefValue = "";
			$clients->Client_Name->TooltipValue = "";

			// Address
			$clients->Address->HrefValue = "";
			$clients->Address->TooltipValue = "";

			// Contact_No
			$clients->Contact_No->HrefValue = "";
			$clients->Contact_No->TooltipValue = "";

			// Email_Address
			$clients->Email_Address->HrefValue = "";
			$clients->Email_Address->TooltipValue = "";

			// TIN_No
			$clients->TIN_No->HrefValue = "";
			$clients->TIN_No->TooltipValue = "";

			// Contact_Person
			$clients->Contact_Person->HrefValue = "";
			$clients->Contact_Person->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $clients->File_Upload->UploadPath) . ((!empty($clients->File_Upload->ViewValue)) ? $clients->File_Upload->ViewValue : $clients->File_Upload->CurrentValue);
				if ($clients->Export <> "") $clients->File_Upload->HrefValue = ew_ConvertFullUrl($clients->File_Upload->HrefValue);
			} else {
				$clients->File_Upload->HrefValue = "";
			}
			$clients->File_Upload->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($clients->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$clients->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $clients;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $clients->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($clients->ExportAll) {
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
		if ($clients->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($clients, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($clients->id);
				$ExportDoc->ExportCaption($clients->Account_No);
				$ExportDoc->ExportCaption($clients->Alias);
				$ExportDoc->ExportCaption($clients->Client_Name);
				$ExportDoc->ExportCaption($clients->Address);
				$ExportDoc->ExportCaption($clients->Contact_No);
				$ExportDoc->ExportCaption($clients->Email_Address);
				$ExportDoc->ExportCaption($clients->TIN_No);
				$ExportDoc->ExportCaption($clients->Contact_Person);
				$ExportDoc->ExportCaption($clients->File_Upload);
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
				$clients->CssClass = "";
				$clients->CssStyle = "";
				$clients->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($clients->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $clients->id->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('Account_No', $clients->Account_No->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('Alias', $clients->Alias->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('Client_Name', $clients->Client_Name->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('Address', $clients->Address->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('Contact_No', $clients->Contact_No->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('Email_Address', $clients->Email_Address->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('TIN_No', $clients->TIN_No->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('Contact_Person', $clients->Contact_Person->ExportValue($clients->Export, $clients->ExportOriginalValue));
					$XmlDoc->AddField('File_Upload', $clients->File_Upload->ExportValue($clients->Export, $clients->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($clients->id);
					$ExportDoc->ExportField($clients->Account_No);
					$ExportDoc->ExportField($clients->Alias);
					$ExportDoc->ExportField($clients->Client_Name);
					$ExportDoc->ExportField($clients->Address);
					$ExportDoc->ExportField($clients->Contact_No);
					$ExportDoc->ExportField($clients->Email_Address);
					$ExportDoc->ExportField($clients->TIN_No);
					$ExportDoc->ExportField($clients->Contact_Person);
					$ExportDoc->ExportField($clients->File_Upload);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($clients->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($clients->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($clients->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($clients->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($clients->ExportReturnUrl());
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
