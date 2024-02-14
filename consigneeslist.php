<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "consigneesinfo.php" ?>
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
$consignees_list = new cconsignees_list();
$Page =& $consignees_list;

// Page init
$consignees_list->Page_Init();

// Page main
$consignees_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($consignees->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var consignees_list = new ew_Page("consignees_list");

// page properties
consignees_list.PageID = "list"; // page ID
consignees_list.FormID = "fconsigneeslist"; // form ID
var EW_PAGE_ID = consignees_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
consignees_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
consignees_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consignees_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($consignees->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$consignees_list->lTotalRecs = $consignees->SelectRecordCount();
	} else {
		if ($rs = $consignees_list->LoadRecordset())
			$consignees_list->lTotalRecs = $rs->RecordCount();
	}
	$consignees_list->lStartRec = 1;
	if ($consignees_list->lDisplayRecs <= 0 || ($consignees->Export <> "" && $consignees->ExportAll)) // Display all records
		$consignees_list->lDisplayRecs = $consignees_list->lTotalRecs;
	if (!($consignees->Export <> "" && $consignees->ExportAll))
		$consignees_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $consignees_list->LoadRecordset($consignees_list->lStartRec-1, $consignees_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $consignees->TableCaption() ?>
<?php if ($consignees->Export == "" && $consignees->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $consignees_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $consignees_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $consignees_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($consignees->Export == "" && $consignees->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(consignees_list);" style="text-decoration: none;"><img id="consignees_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="consignees_list_SearchPanel">
<form name="fconsigneeslistsrch" id="fconsigneeslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="consignees">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($consignees->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $consignees_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="consigneessrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($consignees->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($consignees->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($consignees->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$consignees_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($consignees->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($consignees->CurrentAction <> "gridadd" && $consignees->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($consignees_list->Pager)) $consignees_list->Pager = new cPrevNextPager($consignees_list->lStartRec, $consignees_list->lDisplayRecs, $consignees_list->lTotalRecs) ?>
<?php if ($consignees_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($consignees_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $consignees_list->PageUrl() ?>start=<?php echo $consignees_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($consignees_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $consignees_list->PageUrl() ?>start=<?php echo $consignees_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $consignees_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($consignees_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $consignees_list->PageUrl() ?>start=<?php echo $consignees_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($consignees_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $consignees_list->PageUrl() ?>start=<?php echo $consignees_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $consignees_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $consignees_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $consignees_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $consignees_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($consignees_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($consignees_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="consignees">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($consignees_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($consignees_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($consignees_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($consignees_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($consignees_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($consignees_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($consignees->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $consignees_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fconsigneeslist" id="fconsigneeslist" class="ewForm" action="" method="post">
<div id="gmp_consignees" class="ewGridMiddlePanel">
<?php if ($consignees_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $consignees->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$consignees_list->RenderListOptions();

// Render list options (header, left)
$consignees_list->ListOptions->Render("header", "left");
?>
<?php if ($consignees->id->Visible) { // id ?>
	<?php if ($consignees->SortUrl($consignees->id) == "") { ?>
		<td><?php echo $consignees->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consignees->SortUrl($consignees->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $consignees->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($consignees->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consignees->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($consignees->client_id->Visible) { // client_id ?>
	<?php if ($consignees->SortUrl($consignees->client_id) == "") { ?>
		<td><?php echo $consignees->client_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consignees->SortUrl($consignees->client_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $consignees->client_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($consignees->client_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consignees->client_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($consignees->Customer_No->Visible) { // Customer_No ?>
	<?php if ($consignees->SortUrl($consignees->Customer_No) == "") { ?>
		<td><?php echo $consignees->Customer_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consignees->SortUrl($consignees->Customer_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $consignees->Customer_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($consignees->Customer_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consignees->Customer_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($consignees->Customer_Name->Visible) { // Customer_Name ?>
	<?php if ($consignees->SortUrl($consignees->Customer_Name) == "") { ?>
		<td><?php echo $consignees->Customer_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consignees->SortUrl($consignees->Customer_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $consignees->Customer_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($consignees->Customer_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consignees->Customer_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($consignees->Address->Visible) { // Address ?>
	<?php if ($consignees->SortUrl($consignees->Address) == "") { ?>
		<td><?php echo $consignees->Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consignees->SortUrl($consignees->Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $consignees->Address->FldCaption() ?></td><td style="width: 10px;"><?php if ($consignees->Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consignees->Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($consignees->Contact_Person->Visible) { // Contact_Person ?>
	<?php if ($consignees->SortUrl($consignees->Contact_Person) == "") { ?>
		<td><?php echo $consignees->Contact_Person->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consignees->SortUrl($consignees->Contact_Person) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $consignees->Contact_Person->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($consignees->Contact_Person->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consignees->Contact_Person->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($consignees->Contact_No->Visible) { // Contact_No ?>
	<?php if ($consignees->SortUrl($consignees->Contact_No) == "") { ?>
		<td><?php echo $consignees->Contact_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $consignees->SortUrl($consignees->Contact_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $consignees->Contact_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($consignees->Contact_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($consignees->Contact_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$consignees_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($consignees->ExportAll && $consignees->Export <> "") {
	$consignees_list->lStopRec = $consignees_list->lTotalRecs;
} else {
	$consignees_list->lStopRec = $consignees_list->lStartRec + $consignees_list->lDisplayRecs - 1; // Set the last record to display
}
$consignees_list->lRecCount = $consignees_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $consignees_list->lStartRec > 1)
		$rs->Move($consignees_list->lStartRec - 1);
}

// Initialize aggregate
$consignees->RowType = EW_ROWTYPE_AGGREGATEINIT;
$consignees_list->RenderRow();
$consignees_list->lRowCnt = 0;
while (($consignees->CurrentAction == "gridadd" || !$rs->EOF) &&
	$consignees_list->lRecCount < $consignees_list->lStopRec) {
	$consignees_list->lRecCount++;
	if (intval($consignees_list->lRecCount) >= intval($consignees_list->lStartRec)) {
		$consignees_list->lRowCnt++;

	// Init row class and style
	$consignees->CssClass = "";
	$consignees->CssStyle = "";
	$consignees->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($consignees->CurrentAction == "gridadd") {
		$consignees_list->LoadDefaultValues(); // Load default values
	} else {
		$consignees_list->LoadRowValues($rs); // Load row values
	}
	$consignees->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$consignees_list->RenderRow();

	// Render list options
	$consignees_list->RenderListOptions();
?>
	<tr<?php echo $consignees->RowAttributes() ?>>
<?php

// Render list options (body, left)
$consignees_list->ListOptions->Render("body", "left");
?>
	<?php if ($consignees->id->Visible) { // id ?>
		<td<?php echo $consignees->id->CellAttributes() ?>>
<div<?php echo $consignees->id->ViewAttributes() ?>><?php echo $consignees->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consignees->client_id->Visible) { // client_id ?>
		<td<?php echo $consignees->client_id->CellAttributes() ?>>
<div<?php echo $consignees->client_id->ViewAttributes() ?>><?php echo $consignees->client_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consignees->Customer_No->Visible) { // Customer_No ?>
		<td<?php echo $consignees->Customer_No->CellAttributes() ?>>
<div<?php echo $consignees->Customer_No->ViewAttributes() ?>><?php echo $consignees->Customer_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consignees->Customer_Name->Visible) { // Customer_Name ?>
		<td<?php echo $consignees->Customer_Name->CellAttributes() ?>>
<div<?php echo $consignees->Customer_Name->ViewAttributes() ?>><?php echo $consignees->Customer_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consignees->Address->Visible) { // Address ?>
		<td<?php echo $consignees->Address->CellAttributes() ?>>
<div<?php echo $consignees->Address->ViewAttributes() ?>><?php echo $consignees->Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consignees->Contact_Person->Visible) { // Contact_Person ?>
		<td<?php echo $consignees->Contact_Person->CellAttributes() ?>>
<div<?php echo $consignees->Contact_Person->ViewAttributes() ?>><?php echo $consignees->Contact_Person->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($consignees->Contact_No->Visible) { // Contact_No ?>
		<td<?php echo $consignees->Contact_No->CellAttributes() ?>>
<div<?php echo $consignees->Contact_No->ViewAttributes() ?>><?php echo $consignees->Contact_No->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$consignees_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($consignees->CurrentAction <> "gridadd")
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
<?php if ($consignees_list->lTotalRecs > 0) { ?>
<?php if ($consignees->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($consignees->CurrentAction <> "gridadd" && $consignees->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($consignees_list->Pager)) $consignees_list->Pager = new cPrevNextPager($consignees_list->lStartRec, $consignees_list->lDisplayRecs, $consignees_list->lTotalRecs) ?>
<?php if ($consignees_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($consignees_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $consignees_list->PageUrl() ?>start=<?php echo $consignees_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($consignees_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $consignees_list->PageUrl() ?>start=<?php echo $consignees_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $consignees_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($consignees_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $consignees_list->PageUrl() ?>start=<?php echo $consignees_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($consignees_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $consignees_list->PageUrl() ?>start=<?php echo $consignees_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $consignees_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $consignees_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $consignees_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $consignees_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($consignees_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($consignees_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="consignees">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($consignees_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($consignees_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($consignees_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($consignees_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($consignees_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($consignees_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($consignees->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($consignees_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $consignees_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($consignees->Export == "" && $consignees->CurrentAction == "") { ?>
<?php } ?>
<?php if ($consignees->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$consignees_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cconsignees_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'consignees';

	// Page object name
	var $PageObjName = 'consignees_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $consignees;
		if ($consignees->UseTokenInUrl) $PageUrl .= "t=" . $consignees->TableVar . "&"; // Add page token
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
		global $objForm, $consignees;
		if ($consignees->UseTokenInUrl) {
			if ($objForm)
				return ($consignees->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($consignees->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconsignees_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (consignees)
		$GLOBALS["consignees"] = new cconsignees();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["consignees"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "consigneesdelete.php";
		$this->MultiUpdateUrl = "consigneesupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consignees', TRUE);

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
		global $consignees;

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
			$consignees->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$consignees->Export = $_POST["exporttype"];
		} else {
			$consignees->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $consignees->Export; // Get export parameter, used in header
		$gsExportFile = $consignees->TableVar; // Get export file, used in header
		if ($consignees->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $consignees;

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
			$consignees->Recordset_SearchValidated();

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
		if ($consignees->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $consignees->getRecordsPerPage(); // Restore from Session
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
		$consignees->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$consignees->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$consignees->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $consignees->getSearchWhere();
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
		$consignees->setSessionWhere($sFilter);
		$consignees->CurrentFilter = "";

		// Export data only
		if (in_array($consignees->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($consignees->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $consignees;
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
			$consignees->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$consignees->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $consignees;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $consignees->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $consignees->client_id, FALSE); // client_id
		$this->BuildSearchSql($sWhere, $consignees->Customer_No, FALSE); // Customer_No
		$this->BuildSearchSql($sWhere, $consignees->Customer_Name, FALSE); // Customer_Name
		$this->BuildSearchSql($sWhere, $consignees->Address, FALSE); // Address
		$this->BuildSearchSql($sWhere, $consignees->Contact_Person, FALSE); // Contact_Person
		$this->BuildSearchSql($sWhere, $consignees->Contact_No, FALSE); // Contact_No
		$this->BuildSearchSql($sWhere, $consignees->Remarks, FALSE); // Remarks

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($consignees->id); // id
			$this->SetSearchParm($consignees->client_id); // client_id
			$this->SetSearchParm($consignees->Customer_No); // Customer_No
			$this->SetSearchParm($consignees->Customer_Name); // Customer_Name
			$this->SetSearchParm($consignees->Address); // Address
			$this->SetSearchParm($consignees->Contact_Person); // Contact_Person
			$this->SetSearchParm($consignees->Contact_No); // Contact_No
			$this->SetSearchParm($consignees->Remarks); // Remarks
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
		global $consignees;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$consignees->setAdvancedSearch("x_$FldParm", $FldVal);
		$consignees->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$consignees->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$consignees->setAdvancedSearch("y_$FldParm", $FldVal2);
		$consignees->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $consignees;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $consignees->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $consignees->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $consignees->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $consignees->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $consignees->GetAdvancedSearch("w_$FldParm");
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
		global $consignees;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $consignees->Customer_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $consignees->Customer_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $consignees->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $consignees->Contact_Person, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $consignees->Contact_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $consignees->Remarks, $Keyword);
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
		global $Security, $consignees;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $consignees->BasicSearchKeyword;
		$sSearchType = $consignees->BasicSearchType;
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
			$consignees->setSessionBasicSearchKeyword($sSearchKeyword);
			$consignees->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $consignees;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$consignees->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $consignees;
		$consignees->setSessionBasicSearchKeyword("");
		$consignees->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $consignees;
		$consignees->setAdvancedSearch("x_id", "");
		$consignees->setAdvancedSearch("x_client_id", "");
		$consignees->setAdvancedSearch("x_Customer_No", "");
		$consignees->setAdvancedSearch("x_Customer_Name", "");
		$consignees->setAdvancedSearch("x_Address", "");
		$consignees->setAdvancedSearch("x_Contact_Person", "");
		$consignees->setAdvancedSearch("x_Contact_No", "");
		$consignees->setAdvancedSearch("x_Remarks", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $consignees;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_client_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Customer_No"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Customer_Name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Address"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Contact_Person"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Contact_No"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$consignees->BasicSearchKeyword = $consignees->getSessionBasicSearchKeyword();
			$consignees->BasicSearchType = $consignees->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($consignees->id);
			$this->GetSearchParm($consignees->client_id);
			$this->GetSearchParm($consignees->Customer_No);
			$this->GetSearchParm($consignees->Customer_Name);
			$this->GetSearchParm($consignees->Address);
			$this->GetSearchParm($consignees->Contact_Person);
			$this->GetSearchParm($consignees->Contact_No);
			$this->GetSearchParm($consignees->Remarks);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $consignees;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$consignees->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$consignees->CurrentOrderType = @$_GET["ordertype"];
			$consignees->UpdateSort($consignees->id); // id
			$consignees->UpdateSort($consignees->client_id); // client_id
			$consignees->UpdateSort($consignees->Customer_No); // Customer_No
			$consignees->UpdateSort($consignees->Customer_Name); // Customer_Name
			$consignees->UpdateSort($consignees->Address); // Address
			$consignees->UpdateSort($consignees->Contact_Person); // Contact_Person
			$consignees->UpdateSort($consignees->Contact_No); // Contact_No
			$consignees->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $consignees;
		$sOrderBy = $consignees->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($consignees->SqlOrderBy() <> "") {
				$sOrderBy = $consignees->SqlOrderBy();
				$consignees->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $consignees;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$consignees->setSessionOrderBy($sOrderBy);
				$consignees->id->setSort("");
				$consignees->client_id->setSort("");
				$consignees->Customer_No->setSort("");
				$consignees->Customer_Name->setSort("");
				$consignees->Address->setSort("");
				$consignees->Contact_Person->setSort("");
				$consignees->Contact_No->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$consignees->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $consignees;

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
		if ($consignees->Export <> "" ||
			$consignees->CurrentAction == "gridadd" ||
			$consignees->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $consignees;
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
		global $Security, $Language, $consignees;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $consignees;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$consignees->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$consignees->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $consignees->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$consignees->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$consignees->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$consignees->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $consignees;
		$consignees->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$consignees->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $consignees;

		// Load search values
		// id

		$consignees->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$consignees->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// client_id
		$consignees->client_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_client_id"]);
		$consignees->client_id->AdvancedSearch->SearchOperator = @$_GET["z_client_id"];

		// Customer_No
		$consignees->Customer_No->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Customer_No"]);
		$consignees->Customer_No->AdvancedSearch->SearchOperator = @$_GET["z_Customer_No"];

		// Customer_Name
		$consignees->Customer_Name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Customer_Name"]);
		$consignees->Customer_Name->AdvancedSearch->SearchOperator = @$_GET["z_Customer_Name"];

		// Address
		$consignees->Address->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Address"]);
		$consignees->Address->AdvancedSearch->SearchOperator = @$_GET["z_Address"];

		// Contact_Person
		$consignees->Contact_Person->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Contact_Person"]);
		$consignees->Contact_Person->AdvancedSearch->SearchOperator = @$_GET["z_Contact_Person"];

		// Contact_No
		$consignees->Contact_No->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Contact_No"]);
		$consignees->Contact_No->AdvancedSearch->SearchOperator = @$_GET["z_Contact_No"];

		// Remarks
		$consignees->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$consignees->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $consignees;

		// Call Recordset Selecting event
		$consignees->Recordset_Selecting($consignees->CurrentFilter);

		// Load List page SQL
		$sSql = $consignees->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$consignees->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $consignees;
		$sFilter = $consignees->KeyFilter();

		// Call Row Selecting event
		$consignees->Row_Selecting($sFilter);

		// Load SQL based on filter
		$consignees->CurrentFilter = $sFilter;
		$sSql = $consignees->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$consignees->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $consignees;
		$consignees->id->setDbValue($rs->fields('id'));
		$consignees->client_id->setDbValue($rs->fields('client_id'));
		$consignees->Customer_No->setDbValue($rs->fields('Customer_No'));
		$consignees->Customer_Name->setDbValue($rs->fields('Customer_Name'));
		$consignees->Address->setDbValue($rs->fields('Address'));
		$consignees->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$consignees->Contact_No->setDbValue($rs->fields('Contact_No'));
		$consignees->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $consignees;

		// Initialize URLs
		$this->ViewUrl = $consignees->ViewUrl();
		$this->EditUrl = $consignees->EditUrl();
		$this->InlineEditUrl = $consignees->InlineEditUrl();
		$this->CopyUrl = $consignees->CopyUrl();
		$this->InlineCopyUrl = $consignees->InlineCopyUrl();
		$this->DeleteUrl = $consignees->DeleteUrl();

		// Call Row_Rendering event
		$consignees->Row_Rendering();

		// Common render codes for all row types
		// id

		$consignees->id->CellCssStyle = ""; $consignees->id->CellCssClass = "";
		$consignees->id->CellAttrs = array(); $consignees->id->ViewAttrs = array(); $consignees->id->EditAttrs = array();

		// client_id
		$consignees->client_id->CellCssStyle = ""; $consignees->client_id->CellCssClass = "";
		$consignees->client_id->CellAttrs = array(); $consignees->client_id->ViewAttrs = array(); $consignees->client_id->EditAttrs = array();

		// Customer_No
		$consignees->Customer_No->CellCssStyle = ""; $consignees->Customer_No->CellCssClass = "";
		$consignees->Customer_No->CellAttrs = array(); $consignees->Customer_No->ViewAttrs = array(); $consignees->Customer_No->EditAttrs = array();

		// Customer_Name
		$consignees->Customer_Name->CellCssStyle = ""; $consignees->Customer_Name->CellCssClass = "";
		$consignees->Customer_Name->CellAttrs = array(); $consignees->Customer_Name->ViewAttrs = array(); $consignees->Customer_Name->EditAttrs = array();

		// Address
		$consignees->Address->CellCssStyle = ""; $consignees->Address->CellCssClass = "";
		$consignees->Address->CellAttrs = array(); $consignees->Address->ViewAttrs = array(); $consignees->Address->EditAttrs = array();

		// Contact_Person
		$consignees->Contact_Person->CellCssStyle = ""; $consignees->Contact_Person->CellCssClass = "";
		$consignees->Contact_Person->CellAttrs = array(); $consignees->Contact_Person->ViewAttrs = array(); $consignees->Contact_Person->EditAttrs = array();

		// Contact_No
		$consignees->Contact_No->CellCssStyle = ""; $consignees->Contact_No->CellCssClass = "";
		$consignees->Contact_No->CellAttrs = array(); $consignees->Contact_No->ViewAttrs = array(); $consignees->Contact_No->EditAttrs = array();
		if ($consignees->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$consignees->id->ViewValue = $consignees->id->CurrentValue;
			$consignees->id->CssStyle = "";
			$consignees->id->CssClass = "";
			$consignees->id->ViewCustomAttributes = "";

			// client_id
			if (strval($consignees->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($consignees->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$consignees->client_id->ViewValue = $consignees->client_id->CurrentValue;
				}
			} else {
				$consignees->client_id->ViewValue = NULL;
			}
			$consignees->client_id->CssStyle = "";
			$consignees->client_id->CssClass = "";
			$consignees->client_id->ViewCustomAttributes = "";

			// Customer_No
			$consignees->Customer_No->ViewValue = $consignees->Customer_No->CurrentValue;
			$consignees->Customer_No->CssStyle = "";
			$consignees->Customer_No->CssClass = "";
			$consignees->Customer_No->ViewCustomAttributes = "";

			// Customer_Name
			$consignees->Customer_Name->ViewValue = $consignees->Customer_Name->CurrentValue;
			$consignees->Customer_Name->CssStyle = "";
			$consignees->Customer_Name->CssClass = "";
			$consignees->Customer_Name->ViewCustomAttributes = "";

			// Address
			if (strval($consignees->Address->CurrentValue) <> "") {
				$sFilterWrk = "`Destination` = '" . ew_AdjustSql($consignees->Address->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->Address->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$consignees->Address->ViewValue = $consignees->Address->CurrentValue;
				}
			} else {
				$consignees->Address->ViewValue = NULL;
			}
			$consignees->Address->CssStyle = "";
			$consignees->Address->CssClass = "";
			$consignees->Address->ViewCustomAttributes = "";

			// Contact_Person
			$consignees->Contact_Person->ViewValue = $consignees->Contact_Person->CurrentValue;
			$consignees->Contact_Person->CssStyle = "";
			$consignees->Contact_Person->CssClass = "";
			$consignees->Contact_Person->ViewCustomAttributes = "";

			// Contact_No
			$consignees->Contact_No->ViewValue = $consignees->Contact_No->CurrentValue;
			$consignees->Contact_No->CssStyle = "";
			$consignees->Contact_No->CssClass = "";
			$consignees->Contact_No->ViewCustomAttributes = "";

			// id
			$consignees->id->HrefValue = "";
			$consignees->id->TooltipValue = "";

			// client_id
			$consignees->client_id->HrefValue = "";
			$consignees->client_id->TooltipValue = "";

			// Customer_No
			$consignees->Customer_No->HrefValue = "";
			$consignees->Customer_No->TooltipValue = "";

			// Customer_Name
			$consignees->Customer_Name->HrefValue = "";
			$consignees->Customer_Name->TooltipValue = "";

			// Address
			$consignees->Address->HrefValue = "";
			$consignees->Address->TooltipValue = "";

			// Contact_Person
			$consignees->Contact_Person->HrefValue = "";
			$consignees->Contact_Person->TooltipValue = "";

			// Contact_No
			$consignees->Contact_No->HrefValue = "";
			$consignees->Contact_No->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($consignees->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$consignees->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $consignees;

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
		global $consignees;
		$consignees->id->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_id");
		$consignees->client_id->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_client_id");
		$consignees->Customer_No->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Customer_No");
		$consignees->Customer_Name->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Customer_Name");
		$consignees->Address->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Address");
		$consignees->Contact_Person->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Contact_Person");
		$consignees->Contact_No->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Contact_No");
		$consignees->Remarks->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Remarks");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $consignees;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $consignees->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($consignees->ExportAll) {
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
		if ($consignees->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($consignees, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($consignees->id);
				$ExportDoc->ExportCaption($consignees->client_id);
				$ExportDoc->ExportCaption($consignees->Customer_No);
				$ExportDoc->ExportCaption($consignees->Customer_Name);
				$ExportDoc->ExportCaption($consignees->Address);
				$ExportDoc->ExportCaption($consignees->Contact_Person);
				$ExportDoc->ExportCaption($consignees->Contact_No);
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
				$consignees->CssClass = "";
				$consignees->CssStyle = "";
				$consignees->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($consignees->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $consignees->id->ExportValue($consignees->Export, $consignees->ExportOriginalValue));
					$XmlDoc->AddField('client_id', $consignees->client_id->ExportValue($consignees->Export, $consignees->ExportOriginalValue));
					$XmlDoc->AddField('Customer_No', $consignees->Customer_No->ExportValue($consignees->Export, $consignees->ExportOriginalValue));
					$XmlDoc->AddField('Customer_Name', $consignees->Customer_Name->ExportValue($consignees->Export, $consignees->ExportOriginalValue));
					$XmlDoc->AddField('Address', $consignees->Address->ExportValue($consignees->Export, $consignees->ExportOriginalValue));
					$XmlDoc->AddField('Contact_Person', $consignees->Contact_Person->ExportValue($consignees->Export, $consignees->ExportOriginalValue));
					$XmlDoc->AddField('Contact_No', $consignees->Contact_No->ExportValue($consignees->Export, $consignees->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($consignees->id);
					$ExportDoc->ExportField($consignees->client_id);
					$ExportDoc->ExportField($consignees->Customer_No);
					$ExportDoc->ExportField($consignees->Customer_Name);
					$ExportDoc->ExportField($consignees->Address);
					$ExportDoc->ExportField($consignees->Contact_Person);
					$ExportDoc->ExportField($consignees->Contact_No);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($consignees->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($consignees->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($consignees->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($consignees->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($consignees->ExportReturnUrl());
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
