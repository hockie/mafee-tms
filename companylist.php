<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "companyinfo.php" ?>
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
$company_list = new ccompany_list();
$Page =& $company_list;

// Page init
$company_list->Page_Init();

// Page main
$company_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($company->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var company_list = new ew_Page("company_list");

// page properties
company_list.PageID = "list"; // page ID
company_list.FormID = "fcompanylist"; // form ID
var EW_PAGE_ID = company_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
company_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
company_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
company_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
company_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($company->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$company_list->lTotalRecs = $company->SelectRecordCount();
	} else {
		if ($rs = $company_list->LoadRecordset())
			$company_list->lTotalRecs = $rs->RecordCount();
	}
	$company_list->lStartRec = 1;
	if ($company_list->lDisplayRecs <= 0 || ($company->Export <> "" && $company->ExportAll)) // Display all records
		$company_list->lDisplayRecs = $company_list->lTotalRecs;
	if (!($company->Export <> "" && $company->ExportAll))
		$company_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $company_list->LoadRecordset($company_list->lStartRec-1, $company_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $company->TableCaption() ?>
<?php if ($company->Export == "" && $company->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $company_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $company_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $company_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($company->Export == "" && $company->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(company_list);" style="text-decoration: none;"><img id="company_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="company_list_SearchPanel">
<form name="fcompanylistsrch" id="fcompanylistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="company">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($company->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $company_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($company->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($company->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($company->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$company_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($company->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($company->CurrentAction <> "gridadd" && $company->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($company_list->Pager)) $company_list->Pager = new cPrevNextPager($company_list->lStartRec, $company_list->lDisplayRecs, $company_list->lTotalRecs) ?>
<?php if ($company_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($company_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $company_list->PageUrl() ?>start=<?php echo $company_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($company_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $company_list->PageUrl() ?>start=<?php echo $company_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $company_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($company_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $company_list->PageUrl() ?>start=<?php echo $company_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($company_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $company_list->PageUrl() ?>start=<?php echo $company_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $company_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $company_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $company_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $company_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($company_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($company_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="company">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($company_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($company_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($company_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($company_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($company_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($company_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($company->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $company_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($company_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fcompanylist, '<?php echo $company_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fcompanylist" id="fcompanylist" class="ewForm" action="" method="post">
<div id="gmp_company" class="ewGridMiddlePanel">
<?php if ($company_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $company->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$company_list->RenderListOptions();

// Render list options (header, left)
$company_list->ListOptions->Render("header", "left");
?>
<?php if ($company->id->Visible) { // id ?>
	<?php if ($company->SortUrl($company->id) == "") { ?>
		<td><?php echo $company->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $company->SortUrl($company->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $company->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($company->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($company->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($company->Company_Name->Visible) { // Company_Name ?>
	<?php if ($company->SortUrl($company->Company_Name) == "") { ?>
		<td><?php echo $company->Company_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $company->SortUrl($company->Company_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $company->Company_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($company->Company_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($company->Company_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($company->Contact_No->Visible) { // Contact_No ?>
	<?php if ($company->SortUrl($company->Contact_No) == "") { ?>
		<td><?php echo $company->Contact_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $company->SortUrl($company->Contact_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $company->Contact_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($company->Contact_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($company->Contact_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($company->Email_Address->Visible) { // Email_Address ?>
	<?php if ($company->SortUrl($company->Email_Address) == "") { ?>
		<td><?php echo $company->Email_Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $company->SortUrl($company->Email_Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $company->Email_Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($company->Email_Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($company->Email_Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($company->Website->Visible) { // Website ?>
	<?php if ($company->SortUrl($company->Website) == "") { ?>
		<td><?php echo $company->Website->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $company->SortUrl($company->Website) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $company->Website->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($company->Website->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($company->Website->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($company->TIN_No->Visible) { // TIN_No ?>
	<?php if ($company->SortUrl($company->TIN_No) == "") { ?>
		<td><?php echo $company->TIN_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $company->SortUrl($company->TIN_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $company->TIN_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($company->TIN_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($company->TIN_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($company->File_Upload->Visible) { // File_Upload ?>
	<?php if ($company->SortUrl($company->File_Upload) == "") { ?>
		<td><?php echo $company->File_Upload->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $company->SortUrl($company->File_Upload) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $company->File_Upload->FldCaption() ?></td><td style="width: 10px;"><?php if ($company->File_Upload->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($company->File_Upload->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($company->Remarks->Visible) { // Remarks ?>
	<?php if ($company->SortUrl($company->Remarks) == "") { ?>
		<td><?php echo $company->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $company->SortUrl($company->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $company->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($company->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($company->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$company_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($company->ExportAll && $company->Export <> "") {
	$company_list->lStopRec = $company_list->lTotalRecs;
} else {
	$company_list->lStopRec = $company_list->lStartRec + $company_list->lDisplayRecs - 1; // Set the last record to display
}
$company_list->lRecCount = $company_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $company_list->lStartRec > 1)
		$rs->Move($company_list->lStartRec - 1);
}

// Initialize aggregate
$company->RowType = EW_ROWTYPE_AGGREGATEINIT;
$company_list->RenderRow();
$company_list->lRowCnt = 0;
while (($company->CurrentAction == "gridadd" || !$rs->EOF) &&
	$company_list->lRecCount < $company_list->lStopRec) {
	$company_list->lRecCount++;
	if (intval($company_list->lRecCount) >= intval($company_list->lStartRec)) {
		$company_list->lRowCnt++;

	// Init row class and style
	$company->CssClass = "";
	$company->CssStyle = "";
	$company->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($company->CurrentAction == "gridadd") {
		$company_list->LoadDefaultValues(); // Load default values
	} else {
		$company_list->LoadRowValues($rs); // Load row values
	}
	$company->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$company_list->RenderRow();

	// Render list options
	$company_list->RenderListOptions();
?>
	<tr<?php echo $company->RowAttributes() ?>>
<?php

// Render list options (body, left)
$company_list->ListOptions->Render("body", "left");
?>
	<?php if ($company->id->Visible) { // id ?>
		<td<?php echo $company->id->CellAttributes() ?>>
<div<?php echo $company->id->ViewAttributes() ?>><?php echo $company->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($company->Company_Name->Visible) { // Company_Name ?>
		<td<?php echo $company->Company_Name->CellAttributes() ?>>
<div<?php echo $company->Company_Name->ViewAttributes() ?>><?php echo $company->Company_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($company->Contact_No->Visible) { // Contact_No ?>
		<td<?php echo $company->Contact_No->CellAttributes() ?>>
<div<?php echo $company->Contact_No->ViewAttributes() ?>><?php echo $company->Contact_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($company->Email_Address->Visible) { // Email_Address ?>
		<td<?php echo $company->Email_Address->CellAttributes() ?>>
<div<?php echo $company->Email_Address->ViewAttributes() ?>><?php echo $company->Email_Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($company->Website->Visible) { // Website ?>
		<td<?php echo $company->Website->CellAttributes() ?>>
<div<?php echo $company->Website->ViewAttributes() ?>><?php echo $company->Website->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($company->TIN_No->Visible) { // TIN_No ?>
		<td<?php echo $company->TIN_No->CellAttributes() ?>>
<div<?php echo $company->TIN_No->ViewAttributes() ?>><?php echo $company->TIN_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($company->File_Upload->Visible) { // File_Upload ?>
		<td<?php echo $company->File_Upload->CellAttributes() ?>>
<?php if ($company->File_Upload->HrefValue <> "" || $company->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($company->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $company->File_Upload->HrefValue ?>"><?php echo $company->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($company->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($company->File_Upload->Upload->DbValue)) { ?>
<?php echo $company->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($company->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($company->Remarks->Visible) { // Remarks ?>
		<td<?php echo $company->Remarks->CellAttributes() ?>>
<div<?php echo $company->Remarks->ViewAttributes() ?>><?php echo $company->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$company_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($company->CurrentAction <> "gridadd")
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
<?php if ($company_list->lTotalRecs > 0) { ?>
<?php if ($company->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($company->CurrentAction <> "gridadd" && $company->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($company_list->Pager)) $company_list->Pager = new cPrevNextPager($company_list->lStartRec, $company_list->lDisplayRecs, $company_list->lTotalRecs) ?>
<?php if ($company_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($company_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $company_list->PageUrl() ?>start=<?php echo $company_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($company_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $company_list->PageUrl() ?>start=<?php echo $company_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $company_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($company_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $company_list->PageUrl() ?>start=<?php echo $company_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($company_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $company_list->PageUrl() ?>start=<?php echo $company_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $company_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $company_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $company_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $company_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($company_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($company_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="company">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($company_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($company_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($company_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($company_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($company_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($company_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($company->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($company_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $company_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($company_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fcompanylist, '<?php echo $company_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($company->Export == "" && $company->CurrentAction == "") { ?>
<?php } ?>
<?php if ($company->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$company_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccompany_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'company';

	// Page object name
	var $PageObjName = 'company_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $company;
		if ($company->UseTokenInUrl) $PageUrl .= "t=" . $company->TableVar . "&"; // Add page token
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
		global $objForm, $company;
		if ($company->UseTokenInUrl) {
			if ($objForm)
				return ($company->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($company->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccompany_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (company)
		$GLOBALS["company"] = new ccompany();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["company"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "companydelete.php";
		$this->MultiUpdateUrl = "companyupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'company', TRUE);

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
		global $company;

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
			$company->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$company->Export = $_POST["exporttype"];
		} else {
			$company->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $company->Export; // Get export parameter, used in header
		$gsExportFile = $company->TableVar; // Get export file, used in header
		if ($company->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $company;

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
			$company->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($company->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $company->getRecordsPerPage(); // Restore from Session
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
		$company->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$company->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$company->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $company->getSearchWhere();
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
		$company->setSessionWhere($sFilter);
		$company->CurrentFilter = "";

		// Export data only
		if (in_array($company->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($company->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $company;
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
			$company->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$company->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $company;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $company->Company_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $company->Main_Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $company->Contact_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $company->Email_Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $company->Website, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $company->TIN_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $company->File_Upload, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $company->Remarks, $Keyword);
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
		global $Security, $company;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $company->BasicSearchKeyword;
		$sSearchType = $company->BasicSearchType;
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
			$company->setSessionBasicSearchKeyword($sSearchKeyword);
			$company->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $company;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$company->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $company;
		$company->setSessionBasicSearchKeyword("");
		$company->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $company;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$company->BasicSearchKeyword = $company->getSessionBasicSearchKeyword();
			$company->BasicSearchType = $company->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $company;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$company->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$company->CurrentOrderType = @$_GET["ordertype"];
			$company->UpdateSort($company->id); // id
			$company->UpdateSort($company->Company_Name); // Company_Name
			$company->UpdateSort($company->Contact_No); // Contact_No
			$company->UpdateSort($company->Email_Address); // Email_Address
			$company->UpdateSort($company->Website); // Website
			$company->UpdateSort($company->TIN_No); // TIN_No
			$company->UpdateSort($company->File_Upload); // File_Upload
			$company->UpdateSort($company->Remarks); // Remarks
			$company->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $company;
		$sOrderBy = $company->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($company->SqlOrderBy() <> "") {
				$sOrderBy = $company->SqlOrderBy();
				$company->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $company;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$company->setSessionOrderBy($sOrderBy);
				$company->id->setSort("");
				$company->Company_Name->setSort("");
				$company->Contact_No->setSort("");
				$company->Email_Address->setSort("");
				$company->Website->setSort("");
				$company->TIN_No->setSort("");
				$company->File_Upload->setSort("");
				$company->Remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$company->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $company;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "detail_banks_accounts"
		$this->ListOptions->Add("detail_banks_accounts");
		$item =& $this->ListOptions->Items["detail_banks_accounts"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('banks_accounts');
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"company_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($company->Export <> "" ||
			$company->CurrentAction == "gridadd" ||
			$company->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $company;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "detail_banks_accounts"
		$oListOpt =& $this->ListOptions->Items["detail_banks_accounts"];
		if ($Security->AllowList('banks_accounts')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("banks_accounts", "TblCaption");
			$oListOpt->Body = "<a href=\"banks_accountslist.php?" . EW_TABLE_SHOW_MASTER . "=company&id=" . urlencode(strval($company->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($company->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $company;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $company;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$company->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$company->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $company->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$company->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$company->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$company->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $company;
		$company->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$company->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $company;

		// Call Recordset Selecting event
		$company->Recordset_Selecting($company->CurrentFilter);

		// Load List page SQL
		$sSql = $company->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$company->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $company;
		$sFilter = $company->KeyFilter();

		// Call Row Selecting event
		$company->Row_Selecting($sFilter);

		// Load SQL based on filter
		$company->CurrentFilter = $sFilter;
		$sSql = $company->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$company->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $company;
		$company->id->setDbValue($rs->fields('id'));
		$company->Company_Name->setDbValue($rs->fields('Company_Name'));
		$company->Main_Address->setDbValue($rs->fields('Main_Address'));
		$company->Contact_No->setDbValue($rs->fields('Contact_No'));
		$company->Email_Address->setDbValue($rs->fields('Email_Address'));
		$company->Website->setDbValue($rs->fields('Website'));
		$company->TIN_No->setDbValue($rs->fields('TIN_No'));
		$company->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$company->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $company;

		// Initialize URLs
		$this->ViewUrl = $company->ViewUrl();
		$this->EditUrl = $company->EditUrl();
		$this->InlineEditUrl = $company->InlineEditUrl();
		$this->CopyUrl = $company->CopyUrl();
		$this->InlineCopyUrl = $company->InlineCopyUrl();
		$this->DeleteUrl = $company->DeleteUrl();

		// Call Row_Rendering event
		$company->Row_Rendering();

		// Common render codes for all row types
		// id

		$company->id->CellCssStyle = ""; $company->id->CellCssClass = "";
		$company->id->CellAttrs = array(); $company->id->ViewAttrs = array(); $company->id->EditAttrs = array();

		// Company_Name
		$company->Company_Name->CellCssStyle = ""; $company->Company_Name->CellCssClass = "";
		$company->Company_Name->CellAttrs = array(); $company->Company_Name->ViewAttrs = array(); $company->Company_Name->EditAttrs = array();

		// Contact_No
		$company->Contact_No->CellCssStyle = ""; $company->Contact_No->CellCssClass = "";
		$company->Contact_No->CellAttrs = array(); $company->Contact_No->ViewAttrs = array(); $company->Contact_No->EditAttrs = array();

		// Email_Address
		$company->Email_Address->CellCssStyle = ""; $company->Email_Address->CellCssClass = "";
		$company->Email_Address->CellAttrs = array(); $company->Email_Address->ViewAttrs = array(); $company->Email_Address->EditAttrs = array();

		// Website
		$company->Website->CellCssStyle = ""; $company->Website->CellCssClass = "";
		$company->Website->CellAttrs = array(); $company->Website->ViewAttrs = array(); $company->Website->EditAttrs = array();

		// TIN_No
		$company->TIN_No->CellCssStyle = ""; $company->TIN_No->CellCssClass = "";
		$company->TIN_No->CellAttrs = array(); $company->TIN_No->ViewAttrs = array(); $company->TIN_No->EditAttrs = array();

		// File_Upload
		$company->File_Upload->CellCssStyle = ""; $company->File_Upload->CellCssClass = "";
		$company->File_Upload->CellAttrs = array(); $company->File_Upload->ViewAttrs = array(); $company->File_Upload->EditAttrs = array();

		// Remarks
		$company->Remarks->CellCssStyle = ""; $company->Remarks->CellCssClass = "";
		$company->Remarks->CellAttrs = array(); $company->Remarks->ViewAttrs = array(); $company->Remarks->EditAttrs = array();
		if ($company->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$company->id->ViewValue = $company->id->CurrentValue;
			$company->id->CssStyle = "";
			$company->id->CssClass = "";
			$company->id->ViewCustomAttributes = "";

			// Company_Name
			$company->Company_Name->ViewValue = $company->Company_Name->CurrentValue;
			$company->Company_Name->CssStyle = "";
			$company->Company_Name->CssClass = "";
			$company->Company_Name->ViewCustomAttributes = "";

			// Contact_No
			$company->Contact_No->ViewValue = $company->Contact_No->CurrentValue;
			$company->Contact_No->CssStyle = "";
			$company->Contact_No->CssClass = "";
			$company->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$company->Email_Address->ViewValue = $company->Email_Address->CurrentValue;
			$company->Email_Address->CssStyle = "";
			$company->Email_Address->CssClass = "";
			$company->Email_Address->ViewCustomAttributes = "";

			// Website
			$company->Website->ViewValue = $company->Website->CurrentValue;
			$company->Website->CssStyle = "";
			$company->Website->CssClass = "";
			$company->Website->ViewCustomAttributes = "";

			// TIN_No
			$company->TIN_No->ViewValue = $company->TIN_No->CurrentValue;
			$company->TIN_No->CssStyle = "";
			$company->TIN_No->CssClass = "";
			$company->TIN_No->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->ViewValue = $company->File_Upload->Upload->DbValue;
			} else {
				$company->File_Upload->ViewValue = "";
			}
			$company->File_Upload->CssStyle = "";
			$company->File_Upload->CssClass = "";
			$company->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$company->Remarks->ViewValue = $company->Remarks->CurrentValue;
			$company->Remarks->CssStyle = "";
			$company->Remarks->CssClass = "";
			$company->Remarks->ViewCustomAttributes = "";

			// id
			$company->id->HrefValue = "";
			$company->id->TooltipValue = "";

			// Company_Name
			$company->Company_Name->HrefValue = "";
			$company->Company_Name->TooltipValue = "";

			// Contact_No
			$company->Contact_No->HrefValue = "";
			$company->Contact_No->TooltipValue = "";

			// Email_Address
			$company->Email_Address->HrefValue = "";
			$company->Email_Address->TooltipValue = "";

			// Website
			$company->Website->HrefValue = "";
			$company->Website->TooltipValue = "";

			// TIN_No
			$company->TIN_No->HrefValue = "";
			$company->TIN_No->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $company->File_Upload->UploadPath) . ((!empty($company->File_Upload->ViewValue)) ? $company->File_Upload->ViewValue : $company->File_Upload->CurrentValue);
				if ($company->Export <> "") $company->File_Upload->HrefValue = ew_ConvertFullUrl($company->File_Upload->HrefValue);
			} else {
				$company->File_Upload->HrefValue = "";
			}
			$company->File_Upload->TooltipValue = "";

			// Remarks
			$company->Remarks->HrefValue = "";
			$company->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($company->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$company->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $company;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $company->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($company->ExportAll) {
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
		if ($company->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($company, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($company->id);
				$ExportDoc->ExportCaption($company->Company_Name);
				$ExportDoc->ExportCaption($company->Contact_No);
				$ExportDoc->ExportCaption($company->Email_Address);
				$ExportDoc->ExportCaption($company->Website);
				$ExportDoc->ExportCaption($company->TIN_No);
				$ExportDoc->ExportCaption($company->File_Upload);
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
				$company->CssClass = "";
				$company->CssStyle = "";
				$company->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($company->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $company->id->ExportValue($company->Export, $company->ExportOriginalValue));
					$XmlDoc->AddField('Company_Name', $company->Company_Name->ExportValue($company->Export, $company->ExportOriginalValue));
					$XmlDoc->AddField('Contact_No', $company->Contact_No->ExportValue($company->Export, $company->ExportOriginalValue));
					$XmlDoc->AddField('Email_Address', $company->Email_Address->ExportValue($company->Export, $company->ExportOriginalValue));
					$XmlDoc->AddField('Website', $company->Website->ExportValue($company->Export, $company->ExportOriginalValue));
					$XmlDoc->AddField('TIN_No', $company->TIN_No->ExportValue($company->Export, $company->ExportOriginalValue));
					$XmlDoc->AddField('File_Upload', $company->File_Upload->ExportValue($company->Export, $company->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($company->id);
					$ExportDoc->ExportField($company->Company_Name);
					$ExportDoc->ExportField($company->Contact_No);
					$ExportDoc->ExportField($company->Email_Address);
					$ExportDoc->ExportField($company->Website);
					$ExportDoc->ExportField($company->TIN_No);
					$ExportDoc->ExportField($company->File_Upload);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($company->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($company->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($company->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($company->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($company->ExportReturnUrl());
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
