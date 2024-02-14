<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "helpersinfo.php" ?>
<?php include "subconsinfo.php" ?>
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
$helpers_list = new chelpers_list();
$Page =& $helpers_list;

// Page init
$helpers_list->Page_Init();

// Page main
$helpers_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($helpers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var helpers_list = new ew_Page("helpers_list");

// page properties
helpers_list.PageID = "list"; // page ID
helpers_list.FormID = "fhelperslist"; // form ID
var EW_PAGE_ID = helpers_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
helpers_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
helpers_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
helpers_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($helpers->Export == "") { ?>
<?php
$gsMasterReturnUrl = "subconslist.php";
if ($helpers_list->sDbMasterFilter <> "" && $helpers->getCurrentMasterTable() == "subcons") {
	if ($helpers_list->bMasterRecordExists) {
		if ($helpers->getCurrentMasterTable() == $helpers->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "subconsmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$helpers_list->lTotalRecs = $helpers->SelectRecordCount();
	} else {
		if ($rs = $helpers_list->LoadRecordset())
			$helpers_list->lTotalRecs = $rs->RecordCount();
	}
	$helpers_list->lStartRec = 1;
	if ($helpers_list->lDisplayRecs <= 0 || ($helpers->Export <> "" && $helpers->ExportAll)) // Display all records
		$helpers_list->lDisplayRecs = $helpers_list->lTotalRecs;
	if (!($helpers->Export <> "" && $helpers->ExportAll))
		$helpers_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $helpers_list->LoadRecordset($helpers_list->lStartRec-1, $helpers_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $helpers->TableCaption() ?>
<?php if ($helpers->Export == "" && $helpers->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $helpers_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $helpers_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $helpers_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($helpers->Export == "" && $helpers->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(helpers_list);" style="text-decoration: none;"><img id="helpers_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="helpers_list_SearchPanel">
<form name="fhelperslistsrch" id="fhelperslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="helpers">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($helpers->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $helpers_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($helpers->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($helpers->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($helpers->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$helpers_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($helpers->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($helpers->CurrentAction <> "gridadd" && $helpers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($helpers_list->Pager)) $helpers_list->Pager = new cPrevNextPager($helpers_list->lStartRec, $helpers_list->lDisplayRecs, $helpers_list->lTotalRecs) ?>
<?php if ($helpers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($helpers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $helpers_list->PageUrl() ?>start=<?php echo $helpers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($helpers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $helpers_list->PageUrl() ?>start=<?php echo $helpers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $helpers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($helpers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $helpers_list->PageUrl() ?>start=<?php echo $helpers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($helpers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $helpers_list->PageUrl() ?>start=<?php echo $helpers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $helpers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $helpers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $helpers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $helpers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($helpers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($helpers_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="helpers">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($helpers_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($helpers_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($helpers_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($helpers_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($helpers_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($helpers_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($helpers->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $helpers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fhelperslist" id="fhelperslist" class="ewForm" action="" method="post">
<div id="gmp_helpers" class="ewGridMiddlePanel">
<?php if ($helpers_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $helpers->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$helpers_list->RenderListOptions();

// Render list options (header, left)
$helpers_list->ListOptions->Render("header", "left");
?>
<?php if ($helpers->id->Visible) { // id ?>
	<?php if ($helpers->SortUrl($helpers->id) == "") { ?>
		<td><?php echo $helpers->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $helpers->SortUrl($helpers->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $helpers->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($helpers->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($helpers->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($helpers->Helper_Name->Visible) { // Helper_Name ?>
	<?php if ($helpers->SortUrl($helpers->Helper_Name) == "") { ?>
		<td><?php echo $helpers->Helper_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $helpers->SortUrl($helpers->Helper_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $helpers->Helper_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($helpers->Helper_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($helpers->Helper_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($helpers->Subcon_ID->Visible) { // Subcon_ID ?>
	<?php if ($helpers->SortUrl($helpers->Subcon_ID) == "") { ?>
		<td><?php echo $helpers->Subcon_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $helpers->SortUrl($helpers->Subcon_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $helpers->Subcon_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($helpers->Subcon_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($helpers->Subcon_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($helpers->Address->Visible) { // Address ?>
	<?php if ($helpers->SortUrl($helpers->Address) == "") { ?>
		<td><?php echo $helpers->Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $helpers->SortUrl($helpers->Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $helpers->Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($helpers->Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($helpers->Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($helpers->Phone->Visible) { // Phone ?>
	<?php if ($helpers->SortUrl($helpers->Phone) == "") { ?>
		<td><?php echo $helpers->Phone->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $helpers->SortUrl($helpers->Phone) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $helpers->Phone->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($helpers->Phone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($helpers->Phone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($helpers->Uploads->Visible) { // Uploads ?>
	<?php if ($helpers->SortUrl($helpers->Uploads) == "") { ?>
		<td><?php echo $helpers->Uploads->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $helpers->SortUrl($helpers->Uploads) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $helpers->Uploads->FldCaption() ?></td><td style="width: 10px;"><?php if ($helpers->Uploads->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($helpers->Uploads->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$helpers_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($helpers->ExportAll && $helpers->Export <> "") {
	$helpers_list->lStopRec = $helpers_list->lTotalRecs;
} else {
	$helpers_list->lStopRec = $helpers_list->lStartRec + $helpers_list->lDisplayRecs - 1; // Set the last record to display
}
$helpers_list->lRecCount = $helpers_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $helpers_list->lStartRec > 1)
		$rs->Move($helpers_list->lStartRec - 1);
}

// Initialize aggregate
$helpers->RowType = EW_ROWTYPE_AGGREGATEINIT;
$helpers_list->RenderRow();
$helpers_list->lRowCnt = 0;
while (($helpers->CurrentAction == "gridadd" || !$rs->EOF) &&
	$helpers_list->lRecCount < $helpers_list->lStopRec) {
	$helpers_list->lRecCount++;
	if (intval($helpers_list->lRecCount) >= intval($helpers_list->lStartRec)) {
		$helpers_list->lRowCnt++;

	// Init row class and style
	$helpers->CssClass = "";
	$helpers->CssStyle = "";
	$helpers->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($helpers->CurrentAction == "gridadd") {
		$helpers_list->LoadDefaultValues(); // Load default values
	} else {
		$helpers_list->LoadRowValues($rs); // Load row values
	}
	$helpers->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$helpers_list->RenderRow();

	// Render list options
	$helpers_list->RenderListOptions();
?>
	<tr<?php echo $helpers->RowAttributes() ?>>
<?php

// Render list options (body, left)
$helpers_list->ListOptions->Render("body", "left");
?>
	<?php if ($helpers->id->Visible) { // id ?>
		<td<?php echo $helpers->id->CellAttributes() ?>>
<div<?php echo $helpers->id->ViewAttributes() ?>><?php echo $helpers->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($helpers->Helper_Name->Visible) { // Helper_Name ?>
		<td<?php echo $helpers->Helper_Name->CellAttributes() ?>>
<div<?php echo $helpers->Helper_Name->ViewAttributes() ?>><?php echo $helpers->Helper_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($helpers->Subcon_ID->Visible) { // Subcon_ID ?>
		<td<?php echo $helpers->Subcon_ID->CellAttributes() ?>>
<div<?php echo $helpers->Subcon_ID->ViewAttributes() ?>><?php echo $helpers->Subcon_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($helpers->Address->Visible) { // Address ?>
		<td<?php echo $helpers->Address->CellAttributes() ?>>
<div<?php echo $helpers->Address->ViewAttributes() ?>><?php echo $helpers->Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($helpers->Phone->Visible) { // Phone ?>
		<td<?php echo $helpers->Phone->CellAttributes() ?>>
<div<?php echo $helpers->Phone->ViewAttributes() ?>><?php echo $helpers->Phone->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($helpers->Uploads->Visible) { // Uploads ?>
		<td<?php echo $helpers->Uploads->CellAttributes() ?>>
<?php if ($helpers->Uploads->HrefValue <> "" || $helpers->Uploads->TooltipValue <> "") { ?>
<?php if (!empty($helpers->Uploads->Upload->DbValue)) { ?>
<a href="<?php echo $helpers->Uploads->HrefValue ?>"><?php echo $helpers->Uploads->ListViewValue() ?></a>
<?php } elseif (!in_array($helpers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($helpers->Uploads->Upload->DbValue)) { ?>
<?php echo $helpers->Uploads->ListViewValue() ?>
<?php } elseif (!in_array($helpers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$helpers_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($helpers->CurrentAction <> "gridadd")
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
<?php if ($helpers_list->lTotalRecs > 0) { ?>
<?php if ($helpers->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($helpers->CurrentAction <> "gridadd" && $helpers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($helpers_list->Pager)) $helpers_list->Pager = new cPrevNextPager($helpers_list->lStartRec, $helpers_list->lDisplayRecs, $helpers_list->lTotalRecs) ?>
<?php if ($helpers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($helpers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $helpers_list->PageUrl() ?>start=<?php echo $helpers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($helpers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $helpers_list->PageUrl() ?>start=<?php echo $helpers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $helpers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($helpers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $helpers_list->PageUrl() ?>start=<?php echo $helpers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($helpers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $helpers_list->PageUrl() ?>start=<?php echo $helpers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $helpers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $helpers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $helpers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $helpers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($helpers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($helpers_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="helpers">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($helpers_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($helpers_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($helpers_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($helpers_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($helpers_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($helpers_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($helpers->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($helpers_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $helpers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($helpers->Export == "" && $helpers->CurrentAction == "") { ?>
<?php } ?>
<?php if ($helpers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$helpers_list->Page_Terminate();
?>
<?php

//
// Page class
//
class chelpers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'helpers';

	// Page object name
	var $PageObjName = 'helpers_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $helpers;
		if ($helpers->UseTokenInUrl) $PageUrl .= "t=" . $helpers->TableVar . "&"; // Add page token
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
		global $objForm, $helpers;
		if ($helpers->UseTokenInUrl) {
			if ($objForm)
				return ($helpers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($helpers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function chelpers_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (helpers)
		$GLOBALS["helpers"] = new chelpers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["helpers"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "helpersdelete.php";
		$this->MultiUpdateUrl = "helpersupdate.php";

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'helpers', TRUE);

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
		global $helpers;

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
			$helpers->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$helpers->Export = $_POST["exporttype"];
		} else {
			$helpers->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $helpers->Export; // Get export parameter, used in header
		$gsExportFile = $helpers->TableVar; // Get export file, used in header
		if ($helpers->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $helpers;

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
			$helpers->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($helpers->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $helpers->getRecordsPerPage(); // Restore from Session
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
		$helpers->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$helpers->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$helpers->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $helpers->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $helpers->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $helpers->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($helpers->getMasterFilter() <> "" && $helpers->getCurrentMasterTable() == "subcons") {
			global $subcons;
			$rsmaster = $subcons->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$helpers->setMasterFilter(""); // Clear master filter
				$helpers->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($helpers->getReturnUrl()); // Return to caller
			} else {
				$subcons->LoadListRowValues($rsmaster);
				$subcons->RowType = EW_ROWTYPE_MASTER; // Master row
				$subcons->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$helpers->setSessionWhere($sFilter);
		$helpers->CurrentFilter = "";

		// Export data only
		if (in_array($helpers->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($helpers->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $helpers;
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
			$helpers->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$helpers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $helpers;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $helpers->Helper_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $helpers->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $helpers->Phone, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $helpers->Uploads, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $helpers->Remarks, $Keyword);
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
		global $Security, $helpers;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $helpers->BasicSearchKeyword;
		$sSearchType = $helpers->BasicSearchType;
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
			$helpers->setSessionBasicSearchKeyword($sSearchKeyword);
			$helpers->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $helpers;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$helpers->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $helpers;
		$helpers->setSessionBasicSearchKeyword("");
		$helpers->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $helpers;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$helpers->BasicSearchKeyword = $helpers->getSessionBasicSearchKeyword();
			$helpers->BasicSearchType = $helpers->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $helpers;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$helpers->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$helpers->CurrentOrderType = @$_GET["ordertype"];
			$helpers->UpdateSort($helpers->id); // id
			$helpers->UpdateSort($helpers->Helper_Name); // Helper_Name
			$helpers->UpdateSort($helpers->Subcon_ID); // Subcon_ID
			$helpers->UpdateSort($helpers->Address); // Address
			$helpers->UpdateSort($helpers->Phone); // Phone
			$helpers->UpdateSort($helpers->Uploads); // Uploads
			$helpers->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $helpers;
		$sOrderBy = $helpers->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($helpers->SqlOrderBy() <> "") {
				$sOrderBy = $helpers->SqlOrderBy();
				$helpers->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $helpers;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$helpers->getCurrentMasterTable = ""; // Clear master table
				$helpers->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$helpers->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$helpers->Subcon_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$helpers->setSessionOrderBy($sOrderBy);
				$helpers->id->setSort("");
				$helpers->Helper_Name->setSort("");
				$helpers->Subcon_ID->setSort("");
				$helpers->Address->setSort("");
				$helpers->Phone->setSort("");
				$helpers->Uploads->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$helpers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $helpers;

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
		if ($helpers->Export <> "" ||
			$helpers->CurrentAction == "gridadd" ||
			$helpers->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $helpers;
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
		global $Security, $Language, $helpers;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $helpers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$helpers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$helpers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $helpers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$helpers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$helpers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$helpers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $helpers;
		$helpers->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$helpers->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $helpers;

		// Call Recordset Selecting event
		$helpers->Recordset_Selecting($helpers->CurrentFilter);

		// Load List page SQL
		$sSql = $helpers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$helpers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $helpers;
		$sFilter = $helpers->KeyFilter();

		// Call Row Selecting event
		$helpers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$helpers->CurrentFilter = $sFilter;
		$sSql = $helpers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$helpers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $helpers;
		$helpers->id->setDbValue($rs->fields('id'));
		$helpers->Helper_Name->setDbValue($rs->fields('Helper_Name'));
		$helpers->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$helpers->Address->setDbValue($rs->fields('Address'));
		$helpers->Phone->setDbValue($rs->fields('Phone'));
		$helpers->Uploads->Upload->DbValue = $rs->fields('Uploads');
		$helpers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $helpers;

		// Initialize URLs
		$this->ViewUrl = $helpers->ViewUrl();
		$this->EditUrl = $helpers->EditUrl();
		$this->InlineEditUrl = $helpers->InlineEditUrl();
		$this->CopyUrl = $helpers->CopyUrl();
		$this->InlineCopyUrl = $helpers->InlineCopyUrl();
		$this->DeleteUrl = $helpers->DeleteUrl();

		// Call Row_Rendering event
		$helpers->Row_Rendering();

		// Common render codes for all row types
		// id

		$helpers->id->CellCssStyle = ""; $helpers->id->CellCssClass = "";
		$helpers->id->CellAttrs = array(); $helpers->id->ViewAttrs = array(); $helpers->id->EditAttrs = array();

		// Helper_Name
		$helpers->Helper_Name->CellCssStyle = ""; $helpers->Helper_Name->CellCssClass = "";
		$helpers->Helper_Name->CellAttrs = array(); $helpers->Helper_Name->ViewAttrs = array(); $helpers->Helper_Name->EditAttrs = array();

		// Subcon_ID
		$helpers->Subcon_ID->CellCssStyle = ""; $helpers->Subcon_ID->CellCssClass = "";
		$helpers->Subcon_ID->CellAttrs = array(); $helpers->Subcon_ID->ViewAttrs = array(); $helpers->Subcon_ID->EditAttrs = array();

		// Address
		$helpers->Address->CellCssStyle = ""; $helpers->Address->CellCssClass = "";
		$helpers->Address->CellAttrs = array(); $helpers->Address->ViewAttrs = array(); $helpers->Address->EditAttrs = array();

		// Phone
		$helpers->Phone->CellCssStyle = ""; $helpers->Phone->CellCssClass = "";
		$helpers->Phone->CellAttrs = array(); $helpers->Phone->ViewAttrs = array(); $helpers->Phone->EditAttrs = array();

		// Uploads
		$helpers->Uploads->CellCssStyle = ""; $helpers->Uploads->CellCssClass = "";
		$helpers->Uploads->CellAttrs = array(); $helpers->Uploads->ViewAttrs = array(); $helpers->Uploads->EditAttrs = array();
		if ($helpers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$helpers->id->ViewValue = $helpers->id->CurrentValue;
			$helpers->id->CssStyle = "";
			$helpers->id->CssClass = "";
			$helpers->id->ViewCustomAttributes = "";

			// Helper_Name
			$helpers->Helper_Name->ViewValue = $helpers->Helper_Name->CurrentValue;
			$helpers->Helper_Name->CssStyle = "";
			$helpers->Helper_Name->CssClass = "";
			$helpers->Helper_Name->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($helpers->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($helpers->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$helpers->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$helpers->Subcon_ID->ViewValue = $helpers->Subcon_ID->CurrentValue;
				}
			} else {
				$helpers->Subcon_ID->ViewValue = NULL;
			}
			$helpers->Subcon_ID->CssStyle = "";
			$helpers->Subcon_ID->CssClass = "";
			$helpers->Subcon_ID->ViewCustomAttributes = "";

			// Address
			$helpers->Address->ViewValue = $helpers->Address->CurrentValue;
			$helpers->Address->CssStyle = "";
			$helpers->Address->CssClass = "";
			$helpers->Address->ViewCustomAttributes = "";

			// Phone
			$helpers->Phone->ViewValue = $helpers->Phone->CurrentValue;
			$helpers->Phone->CssStyle = "";
			$helpers->Phone->CssClass = "";
			$helpers->Phone->ViewCustomAttributes = "";

			// Uploads
			if (!ew_Empty($helpers->Uploads->Upload->DbValue)) {
				$helpers->Uploads->ViewValue = $helpers->Uploads->Upload->DbValue;
			} else {
				$helpers->Uploads->ViewValue = "";
			}
			$helpers->Uploads->CssStyle = "";
			$helpers->Uploads->CssClass = "";
			$helpers->Uploads->ViewCustomAttributes = "";

			// id
			$helpers->id->HrefValue = "";
			$helpers->id->TooltipValue = "";

			// Helper_Name
			$helpers->Helper_Name->HrefValue = "";
			$helpers->Helper_Name->TooltipValue = "";

			// Subcon_ID
			$helpers->Subcon_ID->HrefValue = "";
			$helpers->Subcon_ID->TooltipValue = "";

			// Address
			$helpers->Address->HrefValue = "";
			$helpers->Address->TooltipValue = "";

			// Phone
			$helpers->Phone->HrefValue = "";
			$helpers->Phone->TooltipValue = "";

			// Uploads
			if (!ew_Empty($helpers->Uploads->Upload->DbValue)) {
				$helpers->Uploads->HrefValue = ew_UploadPathEx(FALSE, $helpers->Uploads->UploadPath) . ((!empty($helpers->Uploads->ViewValue)) ? $helpers->Uploads->ViewValue : $helpers->Uploads->CurrentValue);
				if ($helpers->Export <> "") $helpers->Uploads->HrefValue = ew_ConvertFullUrl($helpers->Uploads->HrefValue);
			} else {
				$helpers->Uploads->HrefValue = "";
			}
			$helpers->Uploads->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($helpers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$helpers->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $helpers;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $helpers->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($helpers->ExportAll) {
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
		if ($helpers->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($helpers, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($helpers->id);
				$ExportDoc->ExportCaption($helpers->Helper_Name);
				$ExportDoc->ExportCaption($helpers->Subcon_ID);
				$ExportDoc->ExportCaption($helpers->Address);
				$ExportDoc->ExportCaption($helpers->Phone);
				$ExportDoc->ExportCaption($helpers->Uploads);
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
				$helpers->CssClass = "";
				$helpers->CssStyle = "";
				$helpers->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($helpers->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $helpers->id->ExportValue($helpers->Export, $helpers->ExportOriginalValue));
					$XmlDoc->AddField('Helper_Name', $helpers->Helper_Name->ExportValue($helpers->Export, $helpers->ExportOriginalValue));
					$XmlDoc->AddField('Subcon_ID', $helpers->Subcon_ID->ExportValue($helpers->Export, $helpers->ExportOriginalValue));
					$XmlDoc->AddField('Address', $helpers->Address->ExportValue($helpers->Export, $helpers->ExportOriginalValue));
					$XmlDoc->AddField('Phone', $helpers->Phone->ExportValue($helpers->Export, $helpers->ExportOriginalValue));
					$XmlDoc->AddField('Uploads', $helpers->Uploads->ExportValue($helpers->Export, $helpers->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($helpers->id);
					$ExportDoc->ExportField($helpers->Helper_Name);
					$ExportDoc->ExportField($helpers->Subcon_ID);
					$ExportDoc->ExportField($helpers->Address);
					$ExportDoc->ExportField($helpers->Phone);
					$ExportDoc->ExportField($helpers->Uploads);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($helpers->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($helpers->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($helpers->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($helpers->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($helpers->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $helpers;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "subcons") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $helpers->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $helpers->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$helpers->Subcon_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$helpers->Subcon_ID->setSessionValue($helpers->Subcon_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["subcons"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$helpers->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$helpers->setStartRecordNumber($this->lStartRec);
			$helpers->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$helpers->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($helpers->Subcon_ID->QueryStringValue == "") $helpers->Subcon_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $helpers->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $helpers->getDetailFilter(); // Restore detail filter
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
