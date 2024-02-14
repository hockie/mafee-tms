<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "client_payment_periodinfo.php" ?>
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
$client_payment_period_list = new cclient_payment_period_list();
$Page =& $client_payment_period_list;

// Page init
$client_payment_period_list->Page_Init();

// Page main
$client_payment_period_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($client_payment_period->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var client_payment_period_list = new ew_Page("client_payment_period_list");

// page properties
client_payment_period_list.PageID = "list"; // page ID
client_payment_period_list.FormID = "fclient_payment_periodlist"; // form ID
var EW_PAGE_ID = client_payment_period_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
client_payment_period_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
client_payment_period_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
client_payment_period_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($client_payment_period->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$client_payment_period_list->lTotalRecs = $client_payment_period->SelectRecordCount();
	} else {
		if ($rs = $client_payment_period_list->LoadRecordset())
			$client_payment_period_list->lTotalRecs = $rs->RecordCount();
	}
	$client_payment_period_list->lStartRec = 1;
	if ($client_payment_period_list->lDisplayRecs <= 0 || ($client_payment_period->Export <> "" && $client_payment_period->ExportAll)) // Display all records
		$client_payment_period_list->lDisplayRecs = $client_payment_period_list->lTotalRecs;
	if (!($client_payment_period->Export <> "" && $client_payment_period->ExportAll))
		$client_payment_period_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $client_payment_period_list->LoadRecordset($client_payment_period_list->lStartRec-1, $client_payment_period_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $client_payment_period->TableCaption() ?>
<?php if ($client_payment_period->Export == "" && $client_payment_period->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $client_payment_period_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $client_payment_period_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $client_payment_period_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($client_payment_period->Export == "" && $client_payment_period->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(client_payment_period_list);" style="text-decoration: none;"><img id="client_payment_period_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="client_payment_period_list_SearchPanel">
<form name="fclient_payment_periodlistsrch" id="fclient_payment_periodlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="client_payment_period">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($client_payment_period->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $client_payment_period_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($client_payment_period->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($client_payment_period->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($client_payment_period->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$client_payment_period_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($client_payment_period->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($client_payment_period->CurrentAction <> "gridadd" && $client_payment_period->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($client_payment_period_list->Pager)) $client_payment_period_list->Pager = new cPrevNextPager($client_payment_period_list->lStartRec, $client_payment_period_list->lDisplayRecs, $client_payment_period_list->lTotalRecs) ?>
<?php if ($client_payment_period_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($client_payment_period_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $client_payment_period_list->PageUrl() ?>start=<?php echo $client_payment_period_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($client_payment_period_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $client_payment_period_list->PageUrl() ?>start=<?php echo $client_payment_period_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $client_payment_period_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($client_payment_period_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $client_payment_period_list->PageUrl() ?>start=<?php echo $client_payment_period_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($client_payment_period_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $client_payment_period_list->PageUrl() ?>start=<?php echo $client_payment_period_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $client_payment_period_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $client_payment_period_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $client_payment_period_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $client_payment_period_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($client_payment_period_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($client_payment_period_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="client_payment_period">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($client_payment_period_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($client_payment_period_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($client_payment_period_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($client_payment_period_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($client_payment_period_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($client_payment_period_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($client_payment_period->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $client_payment_period_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fclient_payment_periodlist" id="fclient_payment_periodlist" class="ewForm" action="" method="post">
<div id="gmp_client_payment_period" class="ewGridMiddlePanel">
<?php if ($client_payment_period_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $client_payment_period->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$client_payment_period_list->RenderListOptions();

// Render list options (header, left)
$client_payment_period_list->ListOptions->Render("header", "left");
?>
<?php if ($client_payment_period->id->Visible) { // id ?>
	<?php if ($client_payment_period->SortUrl($client_payment_period->id) == "") { ?>
		<td><?php echo $client_payment_period->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $client_payment_period->SortUrl($client_payment_period->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $client_payment_period->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($client_payment_period->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($client_payment_period->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($client_payment_period->client_id->Visible) { // client_id ?>
	<?php if ($client_payment_period->SortUrl($client_payment_period->client_id) == "") { ?>
		<td><?php echo $client_payment_period->client_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $client_payment_period->SortUrl($client_payment_period->client_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $client_payment_period->client_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($client_payment_period->client_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($client_payment_period->client_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($client_payment_period->payment_period->Visible) { // payment_period ?>
	<?php if ($client_payment_period->SortUrl($client_payment_period->payment_period) == "") { ?>
		<td><?php echo $client_payment_period->payment_period->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $client_payment_period->SortUrl($client_payment_period->payment_period) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $client_payment_period->payment_period->FldCaption() ?></td><td style="width: 10px;"><?php if ($client_payment_period->payment_period->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($client_payment_period->payment_period->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($client_payment_period->Remarks->Visible) { // Remarks ?>
	<?php if ($client_payment_period->SortUrl($client_payment_period->Remarks) == "") { ?>
		<td><?php echo $client_payment_period->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $client_payment_period->SortUrl($client_payment_period->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $client_payment_period->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($client_payment_period->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($client_payment_period->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$client_payment_period_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($client_payment_period->ExportAll && $client_payment_period->Export <> "") {
	$client_payment_period_list->lStopRec = $client_payment_period_list->lTotalRecs;
} else {
	$client_payment_period_list->lStopRec = $client_payment_period_list->lStartRec + $client_payment_period_list->lDisplayRecs - 1; // Set the last record to display
}
$client_payment_period_list->lRecCount = $client_payment_period_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $client_payment_period_list->lStartRec > 1)
		$rs->Move($client_payment_period_list->lStartRec - 1);
}

// Initialize aggregate
$client_payment_period->RowType = EW_ROWTYPE_AGGREGATEINIT;
$client_payment_period_list->RenderRow();
$client_payment_period_list->lRowCnt = 0;
while (($client_payment_period->CurrentAction == "gridadd" || !$rs->EOF) &&
	$client_payment_period_list->lRecCount < $client_payment_period_list->lStopRec) {
	$client_payment_period_list->lRecCount++;
	if (intval($client_payment_period_list->lRecCount) >= intval($client_payment_period_list->lStartRec)) {
		$client_payment_period_list->lRowCnt++;

	// Init row class and style
	$client_payment_period->CssClass = "";
	$client_payment_period->CssStyle = "";
	$client_payment_period->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($client_payment_period->CurrentAction == "gridadd") {
		$client_payment_period_list->LoadDefaultValues(); // Load default values
	} else {
		$client_payment_period_list->LoadRowValues($rs); // Load row values
	}
	$client_payment_period->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$client_payment_period_list->RenderRow();

	// Render list options
	$client_payment_period_list->RenderListOptions();
?>
	<tr<?php echo $client_payment_period->RowAttributes() ?>>
<?php

// Render list options (body, left)
$client_payment_period_list->ListOptions->Render("body", "left");
?>
	<?php if ($client_payment_period->id->Visible) { // id ?>
		<td<?php echo $client_payment_period->id->CellAttributes() ?>>
<div<?php echo $client_payment_period->id->ViewAttributes() ?>><?php echo $client_payment_period->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($client_payment_period->client_id->Visible) { // client_id ?>
		<td<?php echo $client_payment_period->client_id->CellAttributes() ?>>
<div<?php echo $client_payment_period->client_id->ViewAttributes() ?>><?php echo $client_payment_period->client_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($client_payment_period->payment_period->Visible) { // payment_period ?>
		<td<?php echo $client_payment_period->payment_period->CellAttributes() ?>>
<div<?php echo $client_payment_period->payment_period->ViewAttributes() ?>><?php echo $client_payment_period->payment_period->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($client_payment_period->Remarks->Visible) { // Remarks ?>
		<td<?php echo $client_payment_period->Remarks->CellAttributes() ?>>
<div<?php echo $client_payment_period->Remarks->ViewAttributes() ?>><?php echo $client_payment_period->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$client_payment_period_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($client_payment_period->CurrentAction <> "gridadd")
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
<?php if ($client_payment_period_list->lTotalRecs > 0) { ?>
<?php if ($client_payment_period->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($client_payment_period->CurrentAction <> "gridadd" && $client_payment_period->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($client_payment_period_list->Pager)) $client_payment_period_list->Pager = new cPrevNextPager($client_payment_period_list->lStartRec, $client_payment_period_list->lDisplayRecs, $client_payment_period_list->lTotalRecs) ?>
<?php if ($client_payment_period_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($client_payment_period_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $client_payment_period_list->PageUrl() ?>start=<?php echo $client_payment_period_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($client_payment_period_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $client_payment_period_list->PageUrl() ?>start=<?php echo $client_payment_period_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $client_payment_period_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($client_payment_period_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $client_payment_period_list->PageUrl() ?>start=<?php echo $client_payment_period_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($client_payment_period_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $client_payment_period_list->PageUrl() ?>start=<?php echo $client_payment_period_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $client_payment_period_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $client_payment_period_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $client_payment_period_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $client_payment_period_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($client_payment_period_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($client_payment_period_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="client_payment_period">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($client_payment_period_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($client_payment_period_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($client_payment_period_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($client_payment_period_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($client_payment_period_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($client_payment_period_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($client_payment_period->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($client_payment_period_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $client_payment_period_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($client_payment_period->Export == "" && $client_payment_period->CurrentAction == "") { ?>
<?php } ?>
<?php if ($client_payment_period->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$client_payment_period_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cclient_payment_period_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'client_payment_period';

	// Page object name
	var $PageObjName = 'client_payment_period_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $client_payment_period;
		if ($client_payment_period->UseTokenInUrl) $PageUrl .= "t=" . $client_payment_period->TableVar . "&"; // Add page token
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
		global $objForm, $client_payment_period;
		if ($client_payment_period->UseTokenInUrl) {
			if ($objForm)
				return ($client_payment_period->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($client_payment_period->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclient_payment_period_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (client_payment_period)
		$GLOBALS["client_payment_period"] = new cclient_payment_period();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["client_payment_period"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "client_payment_perioddelete.php";
		$this->MultiUpdateUrl = "client_payment_periodupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'client_payment_period', TRUE);

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
		global $client_payment_period;

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
			$client_payment_period->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$client_payment_period->Export = $_POST["exporttype"];
		} else {
			$client_payment_period->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $client_payment_period->Export; // Get export parameter, used in header
		$gsExportFile = $client_payment_period->TableVar; // Get export file, used in header
		if ($client_payment_period->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $client_payment_period;

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
			$client_payment_period->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($client_payment_period->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $client_payment_period->getRecordsPerPage(); // Restore from Session
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
		$client_payment_period->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$client_payment_period->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$client_payment_period->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $client_payment_period->getSearchWhere();
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
		$client_payment_period->setSessionWhere($sFilter);
		$client_payment_period->CurrentFilter = "";

		// Export data only
		if (in_array($client_payment_period->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($client_payment_period->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $client_payment_period;
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
			$client_payment_period->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$client_payment_period->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $client_payment_period;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $client_payment_period->Remarks, $Keyword);
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
		global $Security, $client_payment_period;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $client_payment_period->BasicSearchKeyword;
		$sSearchType = $client_payment_period->BasicSearchType;
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
			$client_payment_period->setSessionBasicSearchKeyword($sSearchKeyword);
			$client_payment_period->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $client_payment_period;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$client_payment_period->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $client_payment_period;
		$client_payment_period->setSessionBasicSearchKeyword("");
		$client_payment_period->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $client_payment_period;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$client_payment_period->BasicSearchKeyword = $client_payment_period->getSessionBasicSearchKeyword();
			$client_payment_period->BasicSearchType = $client_payment_period->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $client_payment_period;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$client_payment_period->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$client_payment_period->CurrentOrderType = @$_GET["ordertype"];
			$client_payment_period->UpdateSort($client_payment_period->id); // id
			$client_payment_period->UpdateSort($client_payment_period->client_id); // client_id
			$client_payment_period->UpdateSort($client_payment_period->payment_period); // payment_period
			$client_payment_period->UpdateSort($client_payment_period->Remarks); // Remarks
			$client_payment_period->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $client_payment_period;
		$sOrderBy = $client_payment_period->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($client_payment_period->SqlOrderBy() <> "") {
				$sOrderBy = $client_payment_period->SqlOrderBy();
				$client_payment_period->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $client_payment_period;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$client_payment_period->setSessionOrderBy($sOrderBy);
				$client_payment_period->id->setSort("");
				$client_payment_period->client_id->setSort("");
				$client_payment_period->payment_period->setSort("");
				$client_payment_period->Remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$client_payment_period->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $client_payment_period;

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

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($client_payment_period->Export <> "" ||
			$client_payment_period->CurrentAction == "gridadd" ||
			$client_payment_period->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $client_payment_period;
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

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $client_payment_period;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $client_payment_period;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$client_payment_period->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$client_payment_period->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $client_payment_period->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$client_payment_period->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$client_payment_period->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$client_payment_period->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $client_payment_period;
		$client_payment_period->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$client_payment_period->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $client_payment_period;

		// Call Recordset Selecting event
		$client_payment_period->Recordset_Selecting($client_payment_period->CurrentFilter);

		// Load List page SQL
		$sSql = $client_payment_period->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$client_payment_period->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $client_payment_period;
		$sFilter = $client_payment_period->KeyFilter();

		// Call Row Selecting event
		$client_payment_period->Row_Selecting($sFilter);

		// Load SQL based on filter
		$client_payment_period->CurrentFilter = $sFilter;
		$sSql = $client_payment_period->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$client_payment_period->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $client_payment_period;
		$client_payment_period->id->setDbValue($rs->fields('id'));
		$client_payment_period->client_id->setDbValue($rs->fields('client_id'));
		$client_payment_period->payment_period->setDbValue($rs->fields('payment_period'));
		$client_payment_period->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $client_payment_period;

		// Initialize URLs
		$this->ViewUrl = $client_payment_period->ViewUrl();
		$this->EditUrl = $client_payment_period->EditUrl();
		$this->InlineEditUrl = $client_payment_period->InlineEditUrl();
		$this->CopyUrl = $client_payment_period->CopyUrl();
		$this->InlineCopyUrl = $client_payment_period->InlineCopyUrl();
		$this->DeleteUrl = $client_payment_period->DeleteUrl();

		// Call Row_Rendering event
		$client_payment_period->Row_Rendering();

		// Common render codes for all row types
		// id

		$client_payment_period->id->CellCssStyle = ""; $client_payment_period->id->CellCssClass = "";
		$client_payment_period->id->CellAttrs = array(); $client_payment_period->id->ViewAttrs = array(); $client_payment_period->id->EditAttrs = array();

		// client_id
		$client_payment_period->client_id->CellCssStyle = ""; $client_payment_period->client_id->CellCssClass = "";
		$client_payment_period->client_id->CellAttrs = array(); $client_payment_period->client_id->ViewAttrs = array(); $client_payment_period->client_id->EditAttrs = array();

		// payment_period
		$client_payment_period->payment_period->CellCssStyle = ""; $client_payment_period->payment_period->CellCssClass = "";
		$client_payment_period->payment_period->CellAttrs = array(); $client_payment_period->payment_period->ViewAttrs = array(); $client_payment_period->payment_period->EditAttrs = array();

		// Remarks
		$client_payment_period->Remarks->CellCssStyle = ""; $client_payment_period->Remarks->CellCssClass = "";
		$client_payment_period->Remarks->CellAttrs = array(); $client_payment_period->Remarks->ViewAttrs = array(); $client_payment_period->Remarks->EditAttrs = array();
		if ($client_payment_period->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$client_payment_period->id->ViewValue = $client_payment_period->id->CurrentValue;
			$client_payment_period->id->CssStyle = "";
			$client_payment_period->id->CssClass = "";
			$client_payment_period->id->ViewCustomAttributes = "";

			// client_id
			if (strval($client_payment_period->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($client_payment_period->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$client_payment_period->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$client_payment_period->client_id->ViewValue = $client_payment_period->client_id->CurrentValue;
				}
			} else {
				$client_payment_period->client_id->ViewValue = NULL;
			}
			$client_payment_period->client_id->CssStyle = "";
			$client_payment_period->client_id->CssClass = "";
			$client_payment_period->client_id->ViewCustomAttributes = "";

			// payment_period
			$client_payment_period->payment_period->ViewValue = $client_payment_period->payment_period->CurrentValue;
			$client_payment_period->payment_period->CssStyle = "";
			$client_payment_period->payment_period->CssClass = "";
			$client_payment_period->payment_period->ViewCustomAttributes = "";

			// Remarks
			$client_payment_period->Remarks->ViewValue = $client_payment_period->Remarks->CurrentValue;
			$client_payment_period->Remarks->CssStyle = "";
			$client_payment_period->Remarks->CssClass = "";
			$client_payment_period->Remarks->ViewCustomAttributes = "";

			// id
			$client_payment_period->id->HrefValue = "";
			$client_payment_period->id->TooltipValue = "";

			// client_id
			$client_payment_period->client_id->HrefValue = "";
			$client_payment_period->client_id->TooltipValue = "";

			// payment_period
			$client_payment_period->payment_period->HrefValue = "";
			$client_payment_period->payment_period->TooltipValue = "";

			// Remarks
			$client_payment_period->Remarks->HrefValue = "";
			$client_payment_period->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($client_payment_period->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$client_payment_period->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $client_payment_period;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $client_payment_period->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($client_payment_period->ExportAll) {
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
		if ($client_payment_period->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($client_payment_period, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($client_payment_period->id);
				$ExportDoc->ExportCaption($client_payment_period->client_id);
				$ExportDoc->ExportCaption($client_payment_period->payment_period);
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
				$client_payment_period->CssClass = "";
				$client_payment_period->CssStyle = "";
				$client_payment_period->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($client_payment_period->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $client_payment_period->id->ExportValue($client_payment_period->Export, $client_payment_period->ExportOriginalValue));
					$XmlDoc->AddField('client_id', $client_payment_period->client_id->ExportValue($client_payment_period->Export, $client_payment_period->ExportOriginalValue));
					$XmlDoc->AddField('payment_period', $client_payment_period->payment_period->ExportValue($client_payment_period->Export, $client_payment_period->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($client_payment_period->id);
					$ExportDoc->ExportField($client_payment_period->client_id);
					$ExportDoc->ExportField($client_payment_period->payment_period);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($client_payment_period->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($client_payment_period->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($client_payment_period->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($client_payment_period->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($client_payment_period->ExportReturnUrl());
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
