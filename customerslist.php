<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "customersinfo.php" ?>
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
$customers_list = new ccustomers_list();
$Page =& $customers_list;

// Page init
$customers_list->Page_Init();

// Page main
$customers_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($customers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var customers_list = new ew_Page("customers_list");

// page properties
customers_list.PageID = "list"; // page ID
customers_list.FormID = "fcustomerslist"; // form ID
var EW_PAGE_ID = customers_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
customers_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
customers_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customers_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($customers->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$customers_list->lTotalRecs = $customers->SelectRecordCount();
	} else {
		if ($rs = $customers_list->LoadRecordset())
			$customers_list->lTotalRecs = $rs->RecordCount();
	}
	$customers_list->lStartRec = 1;
	if ($customers_list->lDisplayRecs <= 0 || ($customers->Export <> "" && $customers->ExportAll)) // Display all records
		$customers_list->lDisplayRecs = $customers_list->lTotalRecs;
	if (!($customers->Export <> "" && $customers->ExportAll))
		$customers_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $customers_list->LoadRecordset($customers_list->lStartRec-1, $customers_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $customers->TableCaption() ?>
<?php if ($customers->Export == "" && $customers->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $customers_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $customers_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $customers_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($customers->Export == "" && $customers->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(customers_list);" style="text-decoration: none;"><img id="customers_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="customers_list_SearchPanel">
<form name="fcustomerslistsrch" id="fcustomerslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="customers">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($customers->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $customers_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($customers->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($customers->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($customers->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$customers_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($customers->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($customers->CurrentAction <> "gridadd" && $customers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($customers_list->Pager)) $customers_list->Pager = new cPrevNextPager($customers_list->lStartRec, $customers_list->lDisplayRecs, $customers_list->lTotalRecs) ?>
<?php if ($customers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($customers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $customers_list->PageUrl() ?>start=<?php echo $customers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($customers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $customers_list->PageUrl() ?>start=<?php echo $customers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $customers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($customers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $customers_list->PageUrl() ?>start=<?php echo $customers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($customers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $customers_list->PageUrl() ?>start=<?php echo $customers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $customers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $customers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $customers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $customers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($customers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($customers_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="customers">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($customers_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($customers_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($customers_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($customers_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($customers_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($customers_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($customers->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $customers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fcustomerslist" id="fcustomerslist" class="ewForm" action="" method="post">
<div id="gmp_customers" class="ewGridMiddlePanel">
<?php if ($customers_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $customers->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$customers_list->RenderListOptions();

// Render list options (header, left)
$customers_list->ListOptions->Render("header", "left");
?>
<?php if ($customers->id->Visible) { // id ?>
	<?php if ($customers->SortUrl($customers->id) == "") { ?>
		<td><?php echo $customers->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customers->SortUrl($customers->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customers->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($customers->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customers->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customers->client_id->Visible) { // client_id ?>
	<?php if ($customers->SortUrl($customers->client_id) == "") { ?>
		<td><?php echo $customers->client_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customers->SortUrl($customers->client_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customers->client_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($customers->client_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customers->client_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customers->Customer_No->Visible) { // Customer_No ?>
	<?php if ($customers->SortUrl($customers->Customer_No) == "") { ?>
		<td><?php echo $customers->Customer_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customers->SortUrl($customers->Customer_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customers->Customer_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($customers->Customer_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customers->Customer_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customers->Customer_Name->Visible) { // Customer_Name ?>
	<?php if ($customers->SortUrl($customers->Customer_Name) == "") { ?>
		<td><?php echo $customers->Customer_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customers->SortUrl($customers->Customer_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customers->Customer_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($customers->Customer_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customers->Customer_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customers->Address->Visible) { // Address ?>
	<?php if ($customers->SortUrl($customers->Address) == "") { ?>
		<td><?php echo $customers->Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customers->SortUrl($customers->Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customers->Address->FldCaption() ?></td><td style="width: 10px;"><?php if ($customers->Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customers->Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customers->Contact_Person->Visible) { // Contact_Person ?>
	<?php if ($customers->SortUrl($customers->Contact_Person) == "") { ?>
		<td><?php echo $customers->Contact_Person->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customers->SortUrl($customers->Contact_Person) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customers->Contact_Person->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($customers->Contact_Person->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customers->Contact_Person->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customers->Contact_No->Visible) { // Contact_No ?>
	<?php if ($customers->SortUrl($customers->Contact_No) == "") { ?>
		<td><?php echo $customers->Contact_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customers->SortUrl($customers->Contact_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customers->Contact_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($customers->Contact_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customers->Contact_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$customers_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($customers->ExportAll && $customers->Export <> "") {
	$customers_list->lStopRec = $customers_list->lTotalRecs;
} else {
	$customers_list->lStopRec = $customers_list->lStartRec + $customers_list->lDisplayRecs - 1; // Set the last record to display
}
$customers_list->lRecCount = $customers_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $customers_list->lStartRec > 1)
		$rs->Move($customers_list->lStartRec - 1);
}

// Initialize aggregate
$customers->RowType = EW_ROWTYPE_AGGREGATEINIT;
$customers_list->RenderRow();
$customers_list->lRowCnt = 0;
while (($customers->CurrentAction == "gridadd" || !$rs->EOF) &&
	$customers_list->lRecCount < $customers_list->lStopRec) {
	$customers_list->lRecCount++;
	if (intval($customers_list->lRecCount) >= intval($customers_list->lStartRec)) {
		$customers_list->lRowCnt++;

	// Init row class and style
	$customers->CssClass = "";
	$customers->CssStyle = "";
	$customers->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($customers->CurrentAction == "gridadd") {
		$customers_list->LoadDefaultValues(); // Load default values
	} else {
		$customers_list->LoadRowValues($rs); // Load row values
	}
	$customers->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$customers_list->RenderRow();

	// Render list options
	$customers_list->RenderListOptions();
?>
	<tr<?php echo $customers->RowAttributes() ?>>
<?php

// Render list options (body, left)
$customers_list->ListOptions->Render("body", "left");
?>
	<?php if ($customers->id->Visible) { // id ?>
		<td<?php echo $customers->id->CellAttributes() ?>>
<div<?php echo $customers->id->ViewAttributes() ?>><?php echo $customers->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customers->client_id->Visible) { // client_id ?>
		<td<?php echo $customers->client_id->CellAttributes() ?>>
<div<?php echo $customers->client_id->ViewAttributes() ?>><?php echo $customers->client_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customers->Customer_No->Visible) { // Customer_No ?>
		<td<?php echo $customers->Customer_No->CellAttributes() ?>>
<div<?php echo $customers->Customer_No->ViewAttributes() ?>><?php echo $customers->Customer_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customers->Customer_Name->Visible) { // Customer_Name ?>
		<td<?php echo $customers->Customer_Name->CellAttributes() ?>>
<div<?php echo $customers->Customer_Name->ViewAttributes() ?>><?php echo $customers->Customer_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customers->Address->Visible) { // Address ?>
		<td<?php echo $customers->Address->CellAttributes() ?>>
<div<?php echo $customers->Address->ViewAttributes() ?>><?php echo $customers->Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customers->Contact_Person->Visible) { // Contact_Person ?>
		<td<?php echo $customers->Contact_Person->CellAttributes() ?>>
<div<?php echo $customers->Contact_Person->ViewAttributes() ?>><?php echo $customers->Contact_Person->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customers->Contact_No->Visible) { // Contact_No ?>
		<td<?php echo $customers->Contact_No->CellAttributes() ?>>
<div<?php echo $customers->Contact_No->ViewAttributes() ?>><?php echo $customers->Contact_No->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$customers_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($customers->CurrentAction <> "gridadd")
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
<?php if ($customers_list->lTotalRecs > 0) { ?>
<?php if ($customers->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($customers->CurrentAction <> "gridadd" && $customers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($customers_list->Pager)) $customers_list->Pager = new cPrevNextPager($customers_list->lStartRec, $customers_list->lDisplayRecs, $customers_list->lTotalRecs) ?>
<?php if ($customers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($customers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $customers_list->PageUrl() ?>start=<?php echo $customers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($customers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $customers_list->PageUrl() ?>start=<?php echo $customers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $customers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($customers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $customers_list->PageUrl() ?>start=<?php echo $customers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($customers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $customers_list->PageUrl() ?>start=<?php echo $customers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $customers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $customers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $customers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $customers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($customers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($customers_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="customers">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($customers_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($customers_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($customers_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($customers_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($customers_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($customers_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($customers->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($customers_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $customers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($customers->Export == "" && $customers->CurrentAction == "") { ?>
<?php } ?>
<?php if ($customers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$customers_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccustomers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'customers';

	// Page object name
	var $PageObjName = 'customers_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customers;
		if ($customers->UseTokenInUrl) $PageUrl .= "t=" . $customers->TableVar . "&"; // Add page token
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
		global $objForm, $customers;
		if ($customers->UseTokenInUrl) {
			if ($objForm)
				return ($customers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccustomers_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (customers)
		$GLOBALS["customers"] = new ccustomers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["customers"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "customersdelete.php";
		$this->MultiUpdateUrl = "customersupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customers', TRUE);

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
		global $customers;

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
			$customers->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$customers->Export = $_POST["exporttype"];
		} else {
			$customers->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $customers->Export; // Get export parameter, used in header
		$gsExportFile = $customers->TableVar; // Get export file, used in header
		if ($customers->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $customers;

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
			$customers->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($customers->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $customers->getRecordsPerPage(); // Restore from Session
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
		$customers->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$customers->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$customers->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $customers->getSearchWhere();
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
		$customers->setSessionWhere($sFilter);
		$customers->CurrentFilter = "";

		// Export data only
		if (in_array($customers->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($customers->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $customers;
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
			$customers->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$customers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $customers;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $customers->Customer_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $customers->Customer_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $customers->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $customers->Contact_Person, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $customers->Contact_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $customers->Remarks, $Keyword);
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
		global $Security, $customers;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $customers->BasicSearchKeyword;
		$sSearchType = $customers->BasicSearchType;
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
			$customers->setSessionBasicSearchKeyword($sSearchKeyword);
			$customers->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $customers;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$customers->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $customers;
		$customers->setSessionBasicSearchKeyword("");
		$customers->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $customers;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$customers->BasicSearchKeyword = $customers->getSessionBasicSearchKeyword();
			$customers->BasicSearchType = $customers->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $customers;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$customers->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$customers->CurrentOrderType = @$_GET["ordertype"];
			$customers->UpdateSort($customers->id); // id
			$customers->UpdateSort($customers->client_id); // client_id
			$customers->UpdateSort($customers->Customer_No); // Customer_No
			$customers->UpdateSort($customers->Customer_Name); // Customer_Name
			$customers->UpdateSort($customers->Address); // Address
			$customers->UpdateSort($customers->Contact_Person); // Contact_Person
			$customers->UpdateSort($customers->Contact_No); // Contact_No
			$customers->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $customers;
		$sOrderBy = $customers->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($customers->SqlOrderBy() <> "") {
				$sOrderBy = $customers->SqlOrderBy();
				$customers->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $customers;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$customers->setSessionOrderBy($sOrderBy);
				$customers->id->setSort("");
				$customers->client_id->setSort("");
				$customers->Customer_No->setSort("");
				$customers->Customer_Name->setSort("");
				$customers->Address->setSort("");
				$customers->Contact_Person->setSort("");
				$customers->Contact_No->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$customers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $customers;

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
		if ($customers->Export <> "" ||
			$customers->CurrentAction == "gridadd" ||
			$customers->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $customers;
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
		global $Security, $Language, $customers;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $customers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$customers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$customers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $customers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$customers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$customers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$customers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $customers;
		$customers->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$customers->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $customers;

		// Call Recordset Selecting event
		$customers->Recordset_Selecting($customers->CurrentFilter);

		// Load List page SQL
		$sSql = $customers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$customers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customers;
		$sFilter = $customers->KeyFilter();

		// Call Row Selecting event
		$customers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$customers->CurrentFilter = $sFilter;
		$sSql = $customers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$customers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $customers;
		$customers->id->setDbValue($rs->fields('id'));
		$customers->client_id->setDbValue($rs->fields('client_id'));
		$customers->Customer_No->setDbValue($rs->fields('Customer_No'));
		$customers->Customer_Name->setDbValue($rs->fields('Customer_Name'));
		$customers->Address->setDbValue($rs->fields('Address'));
		$customers->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$customers->Contact_No->setDbValue($rs->fields('Contact_No'));
		$customers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $customers;

		// Initialize URLs
		$this->ViewUrl = $customers->ViewUrl();
		$this->EditUrl = $customers->EditUrl();
		$this->InlineEditUrl = $customers->InlineEditUrl();
		$this->CopyUrl = $customers->CopyUrl();
		$this->InlineCopyUrl = $customers->InlineCopyUrl();
		$this->DeleteUrl = $customers->DeleteUrl();

		// Call Row_Rendering event
		$customers->Row_Rendering();

		// Common render codes for all row types
		// id

		$customers->id->CellCssStyle = ""; $customers->id->CellCssClass = "";
		$customers->id->CellAttrs = array(); $customers->id->ViewAttrs = array(); $customers->id->EditAttrs = array();

		// client_id
		$customers->client_id->CellCssStyle = ""; $customers->client_id->CellCssClass = "";
		$customers->client_id->CellAttrs = array(); $customers->client_id->ViewAttrs = array(); $customers->client_id->EditAttrs = array();

		// Customer_No
		$customers->Customer_No->CellCssStyle = ""; $customers->Customer_No->CellCssClass = "";
		$customers->Customer_No->CellAttrs = array(); $customers->Customer_No->ViewAttrs = array(); $customers->Customer_No->EditAttrs = array();

		// Customer_Name
		$customers->Customer_Name->CellCssStyle = ""; $customers->Customer_Name->CellCssClass = "";
		$customers->Customer_Name->CellAttrs = array(); $customers->Customer_Name->ViewAttrs = array(); $customers->Customer_Name->EditAttrs = array();

		// Address
		$customers->Address->CellCssStyle = ""; $customers->Address->CellCssClass = "";
		$customers->Address->CellAttrs = array(); $customers->Address->ViewAttrs = array(); $customers->Address->EditAttrs = array();

		// Contact_Person
		$customers->Contact_Person->CellCssStyle = ""; $customers->Contact_Person->CellCssClass = "";
		$customers->Contact_Person->CellAttrs = array(); $customers->Contact_Person->ViewAttrs = array(); $customers->Contact_Person->EditAttrs = array();

		// Contact_No
		$customers->Contact_No->CellCssStyle = ""; $customers->Contact_No->CellCssClass = "";
		$customers->Contact_No->CellAttrs = array(); $customers->Contact_No->ViewAttrs = array(); $customers->Contact_No->EditAttrs = array();
		if ($customers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customers->id->ViewValue = $customers->id->CurrentValue;
			$customers->id->CssStyle = "";
			$customers->id->CssClass = "";
			$customers->id->ViewCustomAttributes = "";

			// client_id
			if (strval($customers->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customers->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customers->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$customers->client_id->ViewValue = $customers->client_id->CurrentValue;
				}
			} else {
				$customers->client_id->ViewValue = NULL;
			}
			$customers->client_id->CssStyle = "";
			$customers->client_id->CssClass = "";
			$customers->client_id->ViewCustomAttributes = "";

			// Customer_No
			$customers->Customer_No->ViewValue = $customers->Customer_No->CurrentValue;
			$customers->Customer_No->CssStyle = "";
			$customers->Customer_No->CssClass = "";
			$customers->Customer_No->ViewCustomAttributes = "";

			// Customer_Name
			$customers->Customer_Name->ViewValue = $customers->Customer_Name->CurrentValue;
			$customers->Customer_Name->CssStyle = "";
			$customers->Customer_Name->CssClass = "";
			$customers->Customer_Name->ViewCustomAttributes = "";

			// Address
			if (strval($customers->Address->CurrentValue) <> "") {
				$sFilterWrk = "`Destination` = '" . ew_AdjustSql($customers->Address->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customers->Address->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$customers->Address->ViewValue = $customers->Address->CurrentValue;
				}
			} else {
				$customers->Address->ViewValue = NULL;
			}
			$customers->Address->CssStyle = "";
			$customers->Address->CssClass = "";
			$customers->Address->ViewCustomAttributes = "";

			// Contact_Person
			$customers->Contact_Person->ViewValue = $customers->Contact_Person->CurrentValue;
			$customers->Contact_Person->CssStyle = "";
			$customers->Contact_Person->CssClass = "";
			$customers->Contact_Person->ViewCustomAttributes = "";

			// Contact_No
			$customers->Contact_No->ViewValue = $customers->Contact_No->CurrentValue;
			$customers->Contact_No->CssStyle = "";
			$customers->Contact_No->CssClass = "";
			$customers->Contact_No->ViewCustomAttributes = "";

			// id
			$customers->id->HrefValue = "";
			$customers->id->TooltipValue = "";

			// client_id
			$customers->client_id->HrefValue = "";
			$customers->client_id->TooltipValue = "";

			// Customer_No
			$customers->Customer_No->HrefValue = "";
			$customers->Customer_No->TooltipValue = "";

			// Customer_Name
			$customers->Customer_Name->HrefValue = "";
			$customers->Customer_Name->TooltipValue = "";

			// Address
			$customers->Address->HrefValue = "";
			$customers->Address->TooltipValue = "";

			// Contact_Person
			$customers->Contact_Person->HrefValue = "";
			$customers->Contact_Person->TooltipValue = "";

			// Contact_No
			$customers->Contact_No->HrefValue = "";
			$customers->Contact_No->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($customers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$customers->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $customers;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $customers->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($customers->ExportAll) {
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
		if ($customers->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($customers, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($customers->id);
				$ExportDoc->ExportCaption($customers->client_id);
				$ExportDoc->ExportCaption($customers->Customer_No);
				$ExportDoc->ExportCaption($customers->Customer_Name);
				$ExportDoc->ExportCaption($customers->Address);
				$ExportDoc->ExportCaption($customers->Contact_Person);
				$ExportDoc->ExportCaption($customers->Contact_No);
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
				$customers->CssClass = "";
				$customers->CssStyle = "";
				$customers->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($customers->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $customers->id->ExportValue($customers->Export, $customers->ExportOriginalValue));
					$XmlDoc->AddField('client_id', $customers->client_id->ExportValue($customers->Export, $customers->ExportOriginalValue));
					$XmlDoc->AddField('Customer_No', $customers->Customer_No->ExportValue($customers->Export, $customers->ExportOriginalValue));
					$XmlDoc->AddField('Customer_Name', $customers->Customer_Name->ExportValue($customers->Export, $customers->ExportOriginalValue));
					$XmlDoc->AddField('Address', $customers->Address->ExportValue($customers->Export, $customers->ExportOriginalValue));
					$XmlDoc->AddField('Contact_Person', $customers->Contact_Person->ExportValue($customers->Export, $customers->ExportOriginalValue));
					$XmlDoc->AddField('Contact_No', $customers->Contact_No->ExportValue($customers->Export, $customers->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($customers->id);
					$ExportDoc->ExportField($customers->client_id);
					$ExportDoc->ExportField($customers->Customer_No);
					$ExportDoc->ExportField($customers->Customer_Name);
					$ExportDoc->ExportField($customers->Address);
					$ExportDoc->ExportField($customers->Contact_Person);
					$ExportDoc->ExportField($customers->Contact_No);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($customers->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($customers->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($customers->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($customers->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($customers->ExportReturnUrl());
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
