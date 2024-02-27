<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "subconsinfo.php" ?>
<?php include "bookingsinfo.php" ?>
<?php include "truck_driversinfo.php" ?>
<?php include "helpersinfo.php" ?>
<?php include "trucksinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "file_uploads_subconsinfo.php" ?>
<?php include "vendor_billinfo.php" ?>
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
$subcons_list = new csubcons_list();
$Page =& $subcons_list;

// Page init
$subcons_list->Page_Init();

// Page main
$subcons_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($subcons->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subcons_list = new ew_Page("subcons_list");

// page properties
subcons_list.PageID = "list"; // page ID
subcons_list.FormID = "fsubconslist"; // form ID
var EW_PAGE_ID = subcons_list.PageID; // for backward compatibility

// extend page with validate function for search
subcons_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
subcons_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subcons_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subcons_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subcons_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($subcons->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subcons_list->lTotalRecs = $subcons->SelectRecordCount();
	} else {
		if ($rs = $subcons_list->LoadRecordset())
			$subcons_list->lTotalRecs = $rs->RecordCount();
	}
	$subcons_list->lStartRec = 1;
	if ($subcons_list->lDisplayRecs <= 0 || ($subcons->Export <> "" && $subcons->ExportAll)) // Display all records
		$subcons_list->lDisplayRecs = $subcons_list->lTotalRecs;
	if (!($subcons->Export <> "" && $subcons->ExportAll))
		$subcons_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $subcons_list->LoadRecordset($subcons_list->lStartRec-1, $subcons_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subcons->TableCaption() ?>
<?php if ($subcons->Export == "" && $subcons->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $subcons_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $subcons_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $subcons_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($subcons->Export == "" && $subcons->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(subcons_list);" style="text-decoration: none;"><img id="subcons_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="subcons_list_SearchPanel">
<form name="fsubconslistsrch" id="fsubconslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return subcons_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="subcons">
<?php
if ($gsSearchError == "")
	$subcons_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$subcons->RowType = EW_ROWTYPE_SEARCH;

// Render row
$subcons_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $subcons->Subcon_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Subcon_ID" id="x_Subcon_ID" title="<?php echo $subcons->Subcon_ID->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->Subcon_ID->EditValue ?>"<?php echo $subcons->Subcon_ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $subcons->Subcon_Name->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Subcon_Name" id="z_Subcon_Name" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Subcon_Name" id="x_Subcon_Name" title="<?php echo $subcons->Subcon_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->Subcon_Name->EditValue ?>"<?php echo $subcons->Subcon_Name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($subcons->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $subcons_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="subconssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($subcons->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($subcons->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($subcons->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subcons_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($subcons->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($subcons->CurrentAction <> "gridadd" && $subcons->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subcons_list->Pager)) $subcons_list->Pager = new cPrevNextPager($subcons_list->lStartRec, $subcons_list->lDisplayRecs, $subcons_list->lTotalRecs) ?>
<?php if ($subcons_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subcons_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subcons_list->PageUrl() ?>start=<?php echo $subcons_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subcons_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subcons_list->PageUrl() ?>start=<?php echo $subcons_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subcons_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subcons_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subcons_list->PageUrl() ?>start=<?php echo $subcons_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subcons_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subcons_list->PageUrl() ?>start=<?php echo $subcons_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subcons_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subcons_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subcons_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subcons_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($subcons_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($subcons_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subcons">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($subcons_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($subcons_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subcons_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($subcons_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($subcons_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($subcons_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($subcons->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $subcons_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($subcons_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fsubconslist, '<?php echo $subcons_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fsubconslist" id="fsubconslist" class="ewForm" action="" method="post">
<div id="gmp_subcons" class="ewGridMiddlePanel">
<?php if ($subcons_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subcons->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subcons_list->RenderListOptions();

// Render list options (header, left)
$subcons_list->ListOptions->Render("header", "left");
?>
<?php if ($subcons->id->Visible) { // id ?>
	<?php if ($subcons->SortUrl($subcons->id) == "") { ?>
		<td><?php echo $subcons->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($subcons->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->Subcon_ID->Visible) { // Subcon_ID ?>
	<?php if ($subcons->SortUrl($subcons->Subcon_ID) == "") { ?>
		<td><?php echo $subcons->Subcon_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->Subcon_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->Subcon_ID->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subcons->Subcon_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->Subcon_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->Subcon_Name->Visible) { // Subcon_Name ?>
	<?php if ($subcons->SortUrl($subcons->Subcon_Name) == "") { ?>
		<td><?php echo $subcons->Subcon_Name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->Subcon_Name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->Subcon_Name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subcons->Subcon_Name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->Subcon_Name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->Address->Visible) { // Address ?>
	<?php if ($subcons->SortUrl($subcons->Address) == "") { ?>
		<td><?php echo $subcons->Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subcons->Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->ContactNo->Visible) { // ContactNo ?>
	<?php if ($subcons->SortUrl($subcons->ContactNo) == "") { ?>
		<td><?php echo $subcons->ContactNo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->ContactNo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->ContactNo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subcons->ContactNo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->ContactNo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->Email_Address->Visible) { // Email_Address ?>
	<?php if ($subcons->SortUrl($subcons->Email_Address) == "") { ?>
		<td><?php echo $subcons->Email_Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->Email_Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->Email_Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subcons->Email_Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->Email_Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->TIN_No->Visible) { // TIN_No ?>
	<?php if ($subcons->SortUrl($subcons->TIN_No) == "") { ?>
		<td><?php echo $subcons->TIN_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->TIN_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->TIN_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subcons->TIN_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->TIN_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->ContactPerson->Visible) { // ContactPerson ?>
	<?php if ($subcons->SortUrl($subcons->ContactPerson) == "") { ?>
		<td><?php echo $subcons->ContactPerson->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->ContactPerson) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->ContactPerson->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subcons->ContactPerson->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->ContactPerson->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->File_Upload->Visible) { // File_Upload ?>
	<?php if ($subcons->SortUrl($subcons->File_Upload) == "") { ?>
		<td><?php echo $subcons->File_Upload->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->File_Upload) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->File_Upload->FldCaption() ?></td><td style="width: 10px;"><?php if ($subcons->File_Upload->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->File_Upload->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subcons->Remarks->Visible) { // Remarks ?>
	<?php if ($subcons->SortUrl($subcons->Remarks) == "") { ?>
		<td><?php echo $subcons->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subcons->SortUrl($subcons->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subcons->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($subcons->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subcons->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subcons_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($subcons->ExportAll && $subcons->Export <> "") {
	$subcons_list->lStopRec = $subcons_list->lTotalRecs;
} else {
	$subcons_list->lStopRec = $subcons_list->lStartRec + $subcons_list->lDisplayRecs - 1; // Set the last record to display
}
$subcons_list->lRecCount = $subcons_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $subcons_list->lStartRec > 1)
		$rs->Move($subcons_list->lStartRec - 1);
}

// Initialize aggregate
$subcons->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subcons_list->RenderRow();
$subcons_list->lRowCnt = 0;
while (($subcons->CurrentAction == "gridadd" || !$rs->EOF) &&
	$subcons_list->lRecCount < $subcons_list->lStopRec) {
	$subcons_list->lRecCount++;
	if (intval($subcons_list->lRecCount) >= intval($subcons_list->lStartRec)) {
		$subcons_list->lRowCnt++;

	// Init row class and style
	$subcons->CssClass = "";
	$subcons->CssStyle = "";
	$subcons->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($subcons->CurrentAction == "gridadd") {
		$subcons_list->LoadDefaultValues(); // Load default values
	} else {
		$subcons_list->LoadRowValues($rs); // Load row values
	}
	$subcons->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$subcons_list->RenderRow();

	// Render list options
	$subcons_list->RenderListOptions();
?>
	<tr<?php echo $subcons->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subcons_list->ListOptions->Render("body", "left");
?>
	<?php if ($subcons->id->Visible) { // id ?>
		<td<?php echo $subcons->id->CellAttributes() ?>>
<div<?php echo $subcons->id->ViewAttributes() ?>><?php echo $subcons->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subcons->Subcon_ID->Visible) { // Subcon_ID ?>
		<td<?php echo $subcons->Subcon_ID->CellAttributes() ?>>
<div<?php echo $subcons->Subcon_ID->ViewAttributes() ?>><?php echo $subcons->Subcon_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subcons->Subcon_Name->Visible) { // Subcon_Name ?>
		<td<?php echo $subcons->Subcon_Name->CellAttributes() ?>>
<div<?php echo $subcons->Subcon_Name->ViewAttributes() ?>><?php echo $subcons->Subcon_Name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subcons->Address->Visible) { // Address ?>
		<td<?php echo $subcons->Address->CellAttributes() ?>>
<div<?php echo $subcons->Address->ViewAttributes() ?>><?php echo $subcons->Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subcons->ContactNo->Visible) { // ContactNo ?>
		<td<?php echo $subcons->ContactNo->CellAttributes() ?>>
<div<?php echo $subcons->ContactNo->ViewAttributes() ?>><?php echo $subcons->ContactNo->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subcons->Email_Address->Visible) { // Email_Address ?>
		<td<?php echo $subcons->Email_Address->CellAttributes() ?>>
<div<?php echo $subcons->Email_Address->ViewAttributes() ?>><?php echo $subcons->Email_Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subcons->TIN_No->Visible) { // TIN_No ?>
		<td<?php echo $subcons->TIN_No->CellAttributes() ?>>
<div<?php echo $subcons->TIN_No->ViewAttributes() ?>><?php echo $subcons->TIN_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subcons->ContactPerson->Visible) { // ContactPerson ?>
		<td<?php echo $subcons->ContactPerson->CellAttributes() ?>>
<div<?php echo $subcons->ContactPerson->ViewAttributes() ?>><?php echo $subcons->ContactPerson->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subcons->File_Upload->Visible) { // File_Upload ?>
		<td<?php echo $subcons->File_Upload->CellAttributes() ?>>
<?php if ($subcons->File_Upload->HrefValue <> "" || $subcons->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $subcons->File_Upload->HrefValue ?>"><?php echo $subcons->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<?php echo $subcons->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($subcons->Remarks->Visible) { // Remarks ?>
		<td<?php echo $subcons->Remarks->CellAttributes() ?>>
<div<?php echo $subcons->Remarks->ViewAttributes() ?>><?php echo $subcons->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subcons_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($subcons->CurrentAction <> "gridadd")
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
<?php if ($subcons_list->lTotalRecs > 0) { ?>
<?php if ($subcons->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($subcons->CurrentAction <> "gridadd" && $subcons->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subcons_list->Pager)) $subcons_list->Pager = new cPrevNextPager($subcons_list->lStartRec, $subcons_list->lDisplayRecs, $subcons_list->lTotalRecs) ?>
<?php if ($subcons_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subcons_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subcons_list->PageUrl() ?>start=<?php echo $subcons_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subcons_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subcons_list->PageUrl() ?>start=<?php echo $subcons_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subcons_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subcons_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subcons_list->PageUrl() ?>start=<?php echo $subcons_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subcons_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subcons_list->PageUrl() ?>start=<?php echo $subcons_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subcons_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subcons_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subcons_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subcons_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($subcons_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($subcons_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="subcons">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($subcons_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($subcons_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($subcons_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($subcons_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($subcons_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($subcons_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($subcons->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($subcons_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $subcons_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($subcons_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fsubconslist, '<?php echo $subcons_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($subcons->Export == "" && $subcons->CurrentAction == "") { ?>
<?php } ?>
<?php if ($subcons->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$subcons_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csubcons_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'subcons';

	// Page object name
	var $PageObjName = 'subcons_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subcons;
		if ($subcons->UseTokenInUrl) $PageUrl .= "t=" . $subcons->TableVar . "&"; // Add page token
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
		global $objForm, $subcons;
		if ($subcons->UseTokenInUrl) {
			if ($objForm)
				return ($subcons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subcons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubcons_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subcons)
		$GLOBALS["subcons"] = new csubcons();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["subcons"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "subconsdelete.php";
		$this->MultiUpdateUrl = "subconsupdate.php";

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (truck_drivers)
		$GLOBALS['truck_drivers'] = new ctruck_drivers();

		// Table object (helpers)
		$GLOBALS['helpers'] = new chelpers();

		// Table object (trucks)
		$GLOBALS['trucks'] = new ctrucks();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (file_uploads_subcons)
		$GLOBALS['file_uploads_subcons'] = new cfile_uploads_subcons();

		// Table object (vendor_bill)
		$GLOBALS['vendor_bill'] = new cvendor_bill();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subcons', TRUE);

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
		global $subcons;

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
			$subcons->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$subcons->Export = $_POST["exporttype"];
		} else {
			$subcons->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $subcons->Export; // Get export parameter, used in header
		$gsExportFile = $subcons->TableVar; // Get export file, used in header
		if ($subcons->Export == "excel") {
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
	var $ltruck_drivers_Count;
	var $lhelpers_Count;
	var $lfile_uploads_subcons_Count;
	var $ltrucks_Count;
	var $lvendor_bill_Count;
	var $lbookings_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $subcons;

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
			$subcons->Recordset_SearchValidated();

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
		if ($subcons->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $subcons->getRecordsPerPage(); // Restore from Session
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
		$subcons->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$subcons->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$subcons->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $subcons->getSearchWhere();
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
		$subcons->setSessionWhere($sFilter);
		$subcons->CurrentFilter = "";

		// Export data only
		if (in_array($subcons->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($subcons->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $subcons;
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
			$subcons->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$subcons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $subcons;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $subcons->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $subcons->Subcon_ID, FALSE); // Subcon_ID
		$this->BuildSearchSql($sWhere, $subcons->Subcon_Name, FALSE); // Subcon_Name
		$this->BuildSearchSql($sWhere, $subcons->Address, FALSE); // Address
		$this->BuildSearchSql($sWhere, $subcons->ContactNo, FALSE); // ContactNo
		$this->BuildSearchSql($sWhere, $subcons->Email_Address, FALSE); // Email_Address
		$this->BuildSearchSql($sWhere, $subcons->TIN_No, FALSE); // TIN_No
		$this->BuildSearchSql($sWhere, $subcons->ContactPerson, FALSE); // ContactPerson
		$this->BuildSearchSql($sWhere, $subcons->Remarks, FALSE); // Remarks

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($subcons->id); // id
			$this->SetSearchParm($subcons->Subcon_ID); // Subcon_ID
			$this->SetSearchParm($subcons->Subcon_Name); // Subcon_Name
			$this->SetSearchParm($subcons->Address); // Address
			$this->SetSearchParm($subcons->ContactNo); // ContactNo
			$this->SetSearchParm($subcons->Email_Address); // Email_Address
			$this->SetSearchParm($subcons->TIN_No); // TIN_No
			$this->SetSearchParm($subcons->ContactPerson); // ContactPerson
			$this->SetSearchParm($subcons->Remarks); // Remarks
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
		global $subcons;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$subcons->setAdvancedSearch("x_$FldParm", $FldVal);
		$subcons->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$subcons->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$subcons->setAdvancedSearch("y_$FldParm", $FldVal2);
		$subcons->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $subcons;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $subcons->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $subcons->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $subcons->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $subcons->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $subcons->GetAdvancedSearch("w_$FldParm");
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
		global $subcons;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $subcons->Subcon_ID, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subcons->Subcon_Name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subcons->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subcons->ContactNo, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subcons->Email_Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subcons->TIN_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subcons->ContactPerson, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subcons->File_Upload, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $subcons->Remarks, $Keyword);
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
		global $Security, $subcons;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $subcons->BasicSearchKeyword;
		$sSearchType = $subcons->BasicSearchType;
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
			$subcons->setSessionBasicSearchKeyword($sSearchKeyword);
			$subcons->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $subcons;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$subcons->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $subcons;
		$subcons->setSessionBasicSearchKeyword("");
		$subcons->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $subcons;
		$subcons->setAdvancedSearch("x_id", "");
		$subcons->setAdvancedSearch("x_Subcon_ID", "");
		$subcons->setAdvancedSearch("x_Subcon_Name", "");
		$subcons->setAdvancedSearch("x_Address", "");
		$subcons->setAdvancedSearch("x_ContactNo", "");
		$subcons->setAdvancedSearch("x_Email_Address", "");
		$subcons->setAdvancedSearch("x_TIN_No", "");
		$subcons->setAdvancedSearch("x_ContactPerson", "");
		$subcons->setAdvancedSearch("x_Remarks", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $subcons;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Subcon_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Subcon_Name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Address"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ContactNo"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Email_Address"] <> "") $bRestore = FALSE;
		if (@$_GET["x_TIN_No"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ContactPerson"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$subcons->BasicSearchKeyword = $subcons->getSessionBasicSearchKeyword();
			$subcons->BasicSearchType = $subcons->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($subcons->id);
			$this->GetSearchParm($subcons->Subcon_ID);
			$this->GetSearchParm($subcons->Subcon_Name);
			$this->GetSearchParm($subcons->Address);
			$this->GetSearchParm($subcons->ContactNo);
			$this->GetSearchParm($subcons->Email_Address);
			$this->GetSearchParm($subcons->TIN_No);
			$this->GetSearchParm($subcons->ContactPerson);
			$this->GetSearchParm($subcons->Remarks);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subcons;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subcons->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subcons->CurrentOrderType = @$_GET["ordertype"];
			$subcons->UpdateSort($subcons->id); // id
			$subcons->UpdateSort($subcons->Subcon_ID); // Subcon_ID
			$subcons->UpdateSort($subcons->Subcon_Name); // Subcon_Name
			$subcons->UpdateSort($subcons->Address); // Address
			$subcons->UpdateSort($subcons->ContactNo); // ContactNo
			$subcons->UpdateSort($subcons->Email_Address); // Email_Address
			$subcons->UpdateSort($subcons->TIN_No); // TIN_No
			$subcons->UpdateSort($subcons->ContactPerson); // ContactPerson
			$subcons->UpdateSort($subcons->File_Upload); // File_Upload
			$subcons->UpdateSort($subcons->Remarks); // Remarks
			$subcons->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subcons;
		$sOrderBy = $subcons->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subcons->SqlOrderBy() <> "") {
				$sOrderBy = $subcons->SqlOrderBy();
				$subcons->setSessionOrderBy($sOrderBy);
				$subcons->Subcon_Name->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subcons;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subcons->setSessionOrderBy($sOrderBy);
				$subcons->id->setSort("");
				$subcons->Subcon_ID->setSort("");
				$subcons->Subcon_Name->setSort("");
				$subcons->Address->setSort("");
				$subcons->ContactNo->setSort("");
				$subcons->Email_Address->setSort("");
				$subcons->TIN_No->setSort("");
				$subcons->ContactPerson->setSort("");
				$subcons->File_Upload->setSort("");
				$subcons->Remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$subcons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $subcons;

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

		// "detail_truck_drivers"
		$this->ListOptions->Add("detail_truck_drivers");
		$item =& $this->ListOptions->Items["detail_truck_drivers"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('truck_drivers');
		$item->OnLeft = FALSE;

		// "detail_helpers"
		$this->ListOptions->Add("detail_helpers");
		$item =& $this->ListOptions->Items["detail_helpers"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('helpers');
		$item->OnLeft = FALSE;

		// "detail_file_uploads_subcons"
		$this->ListOptions->Add("detail_file_uploads_subcons");
		$item =& $this->ListOptions->Items["detail_file_uploads_subcons"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('file_uploads_subcons');
		$item->OnLeft = FALSE;

		// "detail_trucks"
		$this->ListOptions->Add("detail_trucks");
		$item =& $this->ListOptions->Items["detail_trucks"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('trucks');
		$item->OnLeft = FALSE;

		// "detail_vendor_bill"
		$this->ListOptions->Add("detail_vendor_bill");
		$item =& $this->ListOptions->Items["detail_vendor_bill"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('vendor_bill');
		$item->OnLeft = FALSE;

		// "detail_bookings"
		$this->ListOptions->Add("detail_bookings");
		$item =& $this->ListOptions->Items["detail_bookings"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('bookings');
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"subcons_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($subcons->Export <> "" ||
			$subcons->CurrentAction == "gridadd" ||
			$subcons->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $subcons;
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

		// "detail_truck_drivers"
		$oListOpt =& $this->ListOptions->Items["detail_truck_drivers"];
		if ($Security->AllowList('truck_drivers')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("truck_drivers", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->ltruck_drivers_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"truck_driverslist.php?" . EW_TABLE_SHOW_MASTER . "=subcons&id=" . urlencode(strval($subcons->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_helpers"
		$oListOpt =& $this->ListOptions->Items["detail_helpers"];
		if ($Security->AllowList('helpers')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("helpers", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lhelpers_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"helperslist.php?" . EW_TABLE_SHOW_MASTER . "=subcons&id=" . urlencode(strval($subcons->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_file_uploads_subcons"
		$oListOpt =& $this->ListOptions->Items["detail_file_uploads_subcons"];
		if ($Security->AllowList('file_uploads_subcons')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("file_uploads_subcons", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lfile_uploads_subcons_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"file_uploads_subconslist.php?" . EW_TABLE_SHOW_MASTER . "=subcons&id=" . urlencode(strval($subcons->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_trucks"
		$oListOpt =& $this->ListOptions->Items["detail_trucks"];
		if ($Security->AllowList('trucks')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("trucks", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->ltrucks_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"truckslist.php?" . EW_TABLE_SHOW_MASTER . "=subcons&id=" . urlencode(strval($subcons->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_vendor_bill"
		$oListOpt =& $this->ListOptions->Items["detail_vendor_bill"];
		if ($Security->AllowList('vendor_bill')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("vendor_bill", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lvendor_bill_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"vendor_billlist.php?" . EW_TABLE_SHOW_MASTER . "=subcons&id=" . urlencode(strval($subcons->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_bookings"
		$oListOpt =& $this->ListOptions->Items["detail_bookings"];
		if ($Security->AllowList('bookings')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("bookings", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lbookings_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"bookingslist.php?" . EW_TABLE_SHOW_MASTER . "=subcons&id=" . urlencode(strval($subcons->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($subcons->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $subcons;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subcons;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$subcons->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$subcons->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $subcons->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$subcons->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$subcons->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$subcons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $subcons;
		$subcons->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$subcons->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $subcons;

		// Load search values
		// id

		$subcons->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$subcons->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Subcon_ID
		$subcons->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Subcon_ID"]);
		$subcons->Subcon_ID->AdvancedSearch->SearchOperator = @$_GET["z_Subcon_ID"];

		// Subcon_Name
		$subcons->Subcon_Name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Subcon_Name"]);
		$subcons->Subcon_Name->AdvancedSearch->SearchOperator = @$_GET["z_Subcon_Name"];

		// Address
		$subcons->Address->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Address"]);
		$subcons->Address->AdvancedSearch->SearchOperator = @$_GET["z_Address"];

		// ContactNo
		$subcons->ContactNo->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ContactNo"]);
		$subcons->ContactNo->AdvancedSearch->SearchOperator = @$_GET["z_ContactNo"];

		// Email_Address
		$subcons->Email_Address->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Email_Address"]);
		$subcons->Email_Address->AdvancedSearch->SearchOperator = @$_GET["z_Email_Address"];

		// TIN_No
		$subcons->TIN_No->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_TIN_No"]);
		$subcons->TIN_No->AdvancedSearch->SearchOperator = @$_GET["z_TIN_No"];

		// ContactPerson
		$subcons->ContactPerson->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ContactPerson"]);
		$subcons->ContactPerson->AdvancedSearch->SearchOperator = @$_GET["z_ContactPerson"];

		// Remarks
		$subcons->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$subcons->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subcons;

		// Call Recordset Selecting event
		$subcons->Recordset_Selecting($subcons->CurrentFilter);

		// Load List page SQL
		$sSql = $subcons->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subcons->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subcons;
		$sFilter = $subcons->KeyFilter();

		// Call Row Selecting event
		$subcons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subcons->CurrentFilter = $sFilter;
		$sSql = $subcons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subcons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subcons;
		$subcons->id->setDbValue($rs->fields('id'));
		$subcons->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$subcons->Subcon_Name->setDbValue($rs->fields('Subcon_Name'));
		$subcons->Address->setDbValue($rs->fields('Address'));
		$subcons->ContactNo->setDbValue($rs->fields('ContactNo'));
		$subcons->Email_Address->setDbValue($rs->fields('Email_Address'));
		$subcons->TIN_No->setDbValue($rs->fields('TIN_No'));
		$subcons->ContactPerson->setDbValue($rs->fields('ContactPerson'));
		$subcons->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$subcons->Remarks->setDbValue($rs->fields('Remarks'));
		$sDetailFilter = $GLOBALS["truck_drivers"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->ltruck_drivers_Count = $GLOBALS["truck_drivers"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["helpers"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->lhelpers_Count = $GLOBALS["helpers"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["file_uploads_subcons"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->lfile_uploads_subcons_Count = $GLOBALS["file_uploads_subcons"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["trucks"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Sub_Con_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->ltrucks_Count = $GLOBALS["trucks"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["vendor_bill"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@vendor_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->lvendor_bill_Count = $GLOBALS["vendor_bill"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["bookings"]->SqlDetailFilter_subcons();
		$sDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($subcons->id->DbValue), $sDetailFilter);
		$this->lbookings_Count = $GLOBALS["bookings"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subcons;

		// Initialize URLs
		$this->ViewUrl = $subcons->ViewUrl();
		$this->EditUrl = $subcons->EditUrl();
		$this->InlineEditUrl = $subcons->InlineEditUrl();
		$this->CopyUrl = $subcons->CopyUrl();
		$this->InlineCopyUrl = $subcons->InlineCopyUrl();
		$this->DeleteUrl = $subcons->DeleteUrl();

		// Call Row_Rendering event
		$subcons->Row_Rendering();

		// Common render codes for all row types
		// id

		$subcons->id->CellCssStyle = ""; $subcons->id->CellCssClass = "";
		$subcons->id->CellAttrs = array(); $subcons->id->ViewAttrs = array(); $subcons->id->EditAttrs = array();

		// Subcon_ID
		$subcons->Subcon_ID->CellCssStyle = ""; $subcons->Subcon_ID->CellCssClass = "";
		$subcons->Subcon_ID->CellAttrs = array(); $subcons->Subcon_ID->ViewAttrs = array(); $subcons->Subcon_ID->EditAttrs = array();

		// Subcon_Name
		$subcons->Subcon_Name->CellCssStyle = ""; $subcons->Subcon_Name->CellCssClass = "";
		$subcons->Subcon_Name->CellAttrs = array(); $subcons->Subcon_Name->ViewAttrs = array(); $subcons->Subcon_Name->EditAttrs = array();

		// Address
		$subcons->Address->CellCssStyle = ""; $subcons->Address->CellCssClass = "";
		$subcons->Address->CellAttrs = array(); $subcons->Address->ViewAttrs = array(); $subcons->Address->EditAttrs = array();

		// ContactNo
		$subcons->ContactNo->CellCssStyle = ""; $subcons->ContactNo->CellCssClass = "";
		$subcons->ContactNo->CellAttrs = array(); $subcons->ContactNo->ViewAttrs = array(); $subcons->ContactNo->EditAttrs = array();

		// Email_Address
		$subcons->Email_Address->CellCssStyle = ""; $subcons->Email_Address->CellCssClass = "";
		$subcons->Email_Address->CellAttrs = array(); $subcons->Email_Address->ViewAttrs = array(); $subcons->Email_Address->EditAttrs = array();

		// TIN_No
		$subcons->TIN_No->CellCssStyle = ""; $subcons->TIN_No->CellCssClass = "";
		$subcons->TIN_No->CellAttrs = array(); $subcons->TIN_No->ViewAttrs = array(); $subcons->TIN_No->EditAttrs = array();

		// ContactPerson
		$subcons->ContactPerson->CellCssStyle = ""; $subcons->ContactPerson->CellCssClass = "";
		$subcons->ContactPerson->CellAttrs = array(); $subcons->ContactPerson->ViewAttrs = array(); $subcons->ContactPerson->EditAttrs = array();

		// File_Upload
		$subcons->File_Upload->CellCssStyle = ""; $subcons->File_Upload->CellCssClass = "";
		$subcons->File_Upload->CellAttrs = array(); $subcons->File_Upload->ViewAttrs = array(); $subcons->File_Upload->EditAttrs = array();

		// Remarks
		$subcons->Remarks->CellCssStyle = ""; $subcons->Remarks->CellCssClass = "";
		$subcons->Remarks->CellAttrs = array(); $subcons->Remarks->ViewAttrs = array(); $subcons->Remarks->EditAttrs = array();
		if ($subcons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$subcons->id->ViewValue = $subcons->id->CurrentValue;
			$subcons->id->CssStyle = "";
			$subcons->id->CssClass = "";
			$subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			$subcons->Subcon_ID->ViewValue = $subcons->Subcon_ID->CurrentValue;
			$subcons->Subcon_ID->CssStyle = "";
			$subcons->Subcon_ID->CssClass = "";
			$subcons->Subcon_ID->ViewCustomAttributes = "";

			// Subcon_Name
			$subcons->Subcon_Name->ViewValue = $subcons->Subcon_Name->CurrentValue;
			$subcons->Subcon_Name->CssStyle = "";
			$subcons->Subcon_Name->CssClass = "";
			$subcons->Subcon_Name->ViewCustomAttributes = "";

			// Address
			$subcons->Address->ViewValue = $subcons->Address->CurrentValue;
			$subcons->Address->CssStyle = "";
			$subcons->Address->CssClass = "";
			$subcons->Address->ViewCustomAttributes = "";

			// ContactNo
			$subcons->ContactNo->ViewValue = $subcons->ContactNo->CurrentValue;
			$subcons->ContactNo->CssStyle = "";
			$subcons->ContactNo->CssClass = "";
			$subcons->ContactNo->ViewCustomAttributes = "";

			// Email_Address
			$subcons->Email_Address->ViewValue = $subcons->Email_Address->CurrentValue;
			$subcons->Email_Address->CssStyle = "";
			$subcons->Email_Address->CssClass = "";
			$subcons->Email_Address->ViewCustomAttributes = "";

			// TIN_No
			$subcons->TIN_No->ViewValue = $subcons->TIN_No->CurrentValue;
			$subcons->TIN_No->CssStyle = "";
			$subcons->TIN_No->CssClass = "";
			$subcons->TIN_No->ViewCustomAttributes = "";

			// ContactPerson
			$subcons->ContactPerson->ViewValue = $subcons->ContactPerson->CurrentValue;
			$subcons->ContactPerson->CssStyle = "";
			$subcons->ContactPerson->CssClass = "";
			$subcons->ContactPerson->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->ViewValue = $subcons->File_Upload->Upload->DbValue;
			} else {
				$subcons->File_Upload->ViewValue = "";
			}
			$subcons->File_Upload->CssStyle = "";
			$subcons->File_Upload->CssClass = "";
			$subcons->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$subcons->Remarks->ViewValue = $subcons->Remarks->CurrentValue;
			$subcons->Remarks->CssStyle = "";
			$subcons->Remarks->CssClass = "";
			$subcons->Remarks->ViewCustomAttributes = "";

			// id
			$subcons->id->HrefValue = "";
			$subcons->id->TooltipValue = "";

			// Subcon_ID
			$subcons->Subcon_ID->HrefValue = "";
			$subcons->Subcon_ID->TooltipValue = "";

			// Subcon_Name
			$subcons->Subcon_Name->HrefValue = "";
			$subcons->Subcon_Name->TooltipValue = "";

			// Address
			$subcons->Address->HrefValue = "";
			$subcons->Address->TooltipValue = "";

			// ContactNo
			$subcons->ContactNo->HrefValue = "";
			$subcons->ContactNo->TooltipValue = "";

			// Email_Address
			$subcons->Email_Address->HrefValue = "";
			$subcons->Email_Address->TooltipValue = "";

			// TIN_No
			$subcons->TIN_No->HrefValue = "";
			$subcons->TIN_No->TooltipValue = "";

			// ContactPerson
			$subcons->ContactPerson->HrefValue = "";
			$subcons->ContactPerson->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $subcons->File_Upload->UploadPath) . ((!empty($subcons->File_Upload->ViewValue)) ? $subcons->File_Upload->ViewValue : $subcons->File_Upload->CurrentValue);
				if ($subcons->Export <> "") $subcons->File_Upload->HrefValue = ew_ConvertFullUrl($subcons->File_Upload->HrefValue);
			} else {
				$subcons->File_Upload->HrefValue = "";
			}
			$subcons->File_Upload->TooltipValue = "";

			// Remarks
			$subcons->Remarks->HrefValue = "";
			$subcons->Remarks->TooltipValue = "";
		} elseif ($subcons->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$subcons->id->EditCustomAttributes = "";
			$subcons->id->EditValue = ew_HtmlEncode($subcons->id->AdvancedSearch->SearchValue);

			// Subcon_ID
			$subcons->Subcon_ID->EditCustomAttributes = "";
			$subcons->Subcon_ID->EditValue = ew_HtmlEncode($subcons->Subcon_ID->AdvancedSearch->SearchValue);

			// Subcon_Name
			$subcons->Subcon_Name->EditCustomAttributes = "";
			$subcons->Subcon_Name->EditValue = ew_HtmlEncode($subcons->Subcon_Name->AdvancedSearch->SearchValue);

			// Address
			$subcons->Address->EditCustomAttributes = "";
			$subcons->Address->EditValue = ew_HtmlEncode($subcons->Address->AdvancedSearch->SearchValue);

			// ContactNo
			$subcons->ContactNo->EditCustomAttributes = "";
			$subcons->ContactNo->EditValue = ew_HtmlEncode($subcons->ContactNo->AdvancedSearch->SearchValue);

			// Email_Address
			$subcons->Email_Address->EditCustomAttributes = "";
			$subcons->Email_Address->EditValue = ew_HtmlEncode($subcons->Email_Address->AdvancedSearch->SearchValue);

			// TIN_No
			$subcons->TIN_No->EditCustomAttributes = "";
			$subcons->TIN_No->EditValue = ew_HtmlEncode($subcons->TIN_No->AdvancedSearch->SearchValue);

			// ContactPerson
			$subcons->ContactPerson->EditCustomAttributes = "";
			$subcons->ContactPerson->EditValue = ew_HtmlEncode($subcons->ContactPerson->AdvancedSearch->SearchValue);

			// File_Upload
			$subcons->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->EditValue = $subcons->File_Upload->Upload->DbValue;
			} else {
				$subcons->File_Upload->EditValue = "";
			}

			// Remarks
			$subcons->Remarks->EditCustomAttributes = "";
			$subcons->Remarks->EditValue = ew_HtmlEncode($subcons->Remarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($subcons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subcons->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $subcons;

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
		global $subcons;
		$subcons->id->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_id");
		$subcons->Subcon_ID->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Subcon_ID");
		$subcons->Subcon_Name->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Subcon_Name");
		$subcons->Address->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Address");
		$subcons->ContactNo->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_ContactNo");
		$subcons->Email_Address->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Email_Address");
		$subcons->TIN_No->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_TIN_No");
		$subcons->ContactPerson->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_ContactPerson");
		$subcons->Remarks->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Remarks");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $subcons;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $subcons->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($subcons->ExportAll) {
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
		if ($subcons->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($subcons, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($subcons->id);
				$ExportDoc->ExportCaption($subcons->Subcon_ID);
				$ExportDoc->ExportCaption($subcons->Subcon_Name);
				$ExportDoc->ExportCaption($subcons->Address);
				$ExportDoc->ExportCaption($subcons->ContactNo);
				$ExportDoc->ExportCaption($subcons->Email_Address);
				$ExportDoc->ExportCaption($subcons->TIN_No);
				$ExportDoc->ExportCaption($subcons->ContactPerson);
				$ExportDoc->ExportCaption($subcons->File_Upload);
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
				$subcons->CssClass = "";
				$subcons->CssStyle = "";
				$subcons->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($subcons->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $subcons->id->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
					$XmlDoc->AddField('Subcon_ID', $subcons->Subcon_ID->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
					$XmlDoc->AddField('Subcon_Name', $subcons->Subcon_Name->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
					$XmlDoc->AddField('Address', $subcons->Address->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
					$XmlDoc->AddField('ContactNo', $subcons->ContactNo->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
					$XmlDoc->AddField('Email_Address', $subcons->Email_Address->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
					$XmlDoc->AddField('TIN_No', $subcons->TIN_No->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
					$XmlDoc->AddField('ContactPerson', $subcons->ContactPerson->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
					$XmlDoc->AddField('File_Upload', $subcons->File_Upload->ExportValue($subcons->Export, $subcons->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($subcons->id);
					$ExportDoc->ExportField($subcons->Subcon_ID);
					$ExportDoc->ExportField($subcons->Subcon_Name);
					$ExportDoc->ExportField($subcons->Address);
					$ExportDoc->ExportField($subcons->ContactNo);
					$ExportDoc->ExportField($subcons->Email_Address);
					$ExportDoc->ExportField($subcons->TIN_No);
					$ExportDoc->ExportField($subcons->ContactPerson);
					$ExportDoc->ExportField($subcons->File_Upload);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($subcons->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($subcons->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($subcons->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($subcons->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($subcons->ExportReturnUrl());
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
