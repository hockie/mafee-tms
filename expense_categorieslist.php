<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "expense_categoriesinfo.php" ?>
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
$expense_categories_list = new cexpense_categories_list();
$Page =& $expense_categories_list;

// Page init
$expense_categories_list->Page_Init();

// Page main
$expense_categories_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($expense_categories->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expense_categories_list = new ew_Page("expense_categories_list");

// page properties
expense_categories_list.PageID = "list"; // page ID
expense_categories_list.FormID = "fexpense_categorieslist"; // form ID
var EW_PAGE_ID = expense_categories_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expense_categories_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expense_categories_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expense_categories_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expense_categories_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 20;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {			
		var inst;			
		for (inst in CKEDITOR.instances)
			CKEDITOR.instances[inst].updateElement();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];		
		if (inst)
			inst.setData(inst.element.value);
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];	
		if (inst)
			inst.focus();
	}
}

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
<?php if ($expense_categories->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$expense_categories_list->lTotalRecs = $expense_categories->SelectRecordCount();
	} else {
		if ($rs = $expense_categories_list->LoadRecordset())
			$expense_categories_list->lTotalRecs = $rs->RecordCount();
	}
	$expense_categories_list->lStartRec = 1;
	if ($expense_categories_list->lDisplayRecs <= 0 || ($expense_categories->Export <> "" && $expense_categories->ExportAll)) // Display all records
		$expense_categories_list->lDisplayRecs = $expense_categories_list->lTotalRecs;
	if (!($expense_categories->Export <> "" && $expense_categories->ExportAll))
		$expense_categories_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $expense_categories_list->LoadRecordset($expense_categories_list->lStartRec-1, $expense_categories_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expense_categories->TableCaption() ?>
<?php if ($expense_categories->Export == "" && $expense_categories->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $expense_categories_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $expense_categories_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $expense_categories_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($expense_categories->Export == "" && $expense_categories->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(expense_categories_list);" style="text-decoration: none;"><img id="expense_categories_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="expense_categories_list_SearchPanel">
<form name="fexpense_categorieslistsrch" id="fexpense_categorieslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="expense_categories">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($expense_categories->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $expense_categories_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($expense_categories->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($expense_categories->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($expense_categories->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expense_categories_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($expense_categories->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($expense_categories->CurrentAction <> "gridadd" && $expense_categories->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expense_categories_list->Pager)) $expense_categories_list->Pager = new cPrevNextPager($expense_categories_list->lStartRec, $expense_categories_list->lDisplayRecs, $expense_categories_list->lTotalRecs) ?>
<?php if ($expense_categories_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expense_categories_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expense_categories_list->PageUrl() ?>start=<?php echo $expense_categories_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expense_categories_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expense_categories_list->PageUrl() ?>start=<?php echo $expense_categories_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expense_categories_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expense_categories_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expense_categories_list->PageUrl() ?>start=<?php echo $expense_categories_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expense_categories_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expense_categories_list->PageUrl() ?>start=<?php echo $expense_categories_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expense_categories_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expense_categories_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expense_categories_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expense_categories_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($expense_categories_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expense_categories_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expense_categories">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($expense_categories_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expense_categories_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expense_categories_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($expense_categories_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($expense_categories_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($expense_categories_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($expense_categories->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expense_categories_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expense_categories_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fexpense_categorieslist, '<?php echo $expense_categories_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fexpense_categorieslist" id="fexpense_categorieslist" class="ewForm" action="" method="post">
<div id="gmp_expense_categories" class="ewGridMiddlePanel">
<?php if ($expense_categories_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $expense_categories->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$expense_categories_list->RenderListOptions();

// Render list options (header, left)
$expense_categories_list->ListOptions->Render("header", "left");
?>
<?php if ($expense_categories->id->Visible) { // id ?>
	<?php if ($expense_categories->SortUrl($expense_categories->id) == "") { ?>
		<td><?php echo $expense_categories->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->company_id->Visible) { // company_id ?>
	<?php if ($expense_categories->SortUrl($expense_categories->company_id) == "") { ?>
		<td><?php echo $expense_categories->company_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->company_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->company_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->company_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->company_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->category_name->Visible) { // category_name ?>
	<?php if ($expense_categories->SortUrl($expense_categories->category_name) == "") { ?>
		<td><?php echo $expense_categories->category_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->category_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->category_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($expense_categories->category_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->category_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->cost->Visible) { // cost ?>
	<?php if ($expense_categories->SortUrl($expense_categories->cost) == "") { ?>
		<td><?php echo $expense_categories->cost->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->cost) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->cost->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->cost->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->cost->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->internal_reference->Visible) { // internal_reference ?>
	<?php if ($expense_categories->SortUrl($expense_categories->internal_reference) == "") { ?>
		<td><?php echo $expense_categories->internal_reference->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->internal_reference) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->internal_reference->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($expense_categories->internal_reference->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->internal_reference->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->re_invoice_expenses->Visible) { // re_invoice_expenses ?>
	<?php if ($expense_categories->SortUrl($expense_categories->re_invoice_expenses) == "") { ?>
		<td><?php echo $expense_categories->re_invoice_expenses->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->re_invoice_expenses) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->re_invoice_expenses->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->re_invoice_expenses->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->re_invoice_expenses->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->vendor_taxes->Visible) { // vendor_taxes ?>
	<?php if ($expense_categories->SortUrl($expense_categories->vendor_taxes) == "") { ?>
		<td><?php echo $expense_categories->vendor_taxes->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->vendor_taxes) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->vendor_taxes->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->vendor_taxes->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->vendor_taxes->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->customer_taxes->Visible) { // customer_taxes ?>
	<?php if ($expense_categories->SortUrl($expense_categories->customer_taxes) == "") { ?>
		<td><?php echo $expense_categories->customer_taxes->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->customer_taxes) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->customer_taxes->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->customer_taxes->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->customer_taxes->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->created->Visible) { // created ?>
	<?php if ($expense_categories->SortUrl($expense_categories->created) == "") { ?>
		<td><?php echo $expense_categories->created->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->created) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->created->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->created->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->created->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->modified->Visible) { // modified ?>
	<?php if ($expense_categories->SortUrl($expense_categories->modified) == "") { ?>
		<td><?php echo $expense_categories->modified->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->modified) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->modified->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->modified->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->modified->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->user_id->Visible) { // user_id ?>
	<?php if ($expense_categories->SortUrl($expense_categories->user_id) == "") { ?>
		<td><?php echo $expense_categories->user_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->user_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->user_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($expense_categories->user_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->user_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expense_categories->remarks->Visible) { // remarks ?>
	<?php if ($expense_categories->SortUrl($expense_categories->remarks) == "") { ?>
		<td><?php echo $expense_categories->remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expense_categories->SortUrl($expense_categories->remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expense_categories->remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($expense_categories->remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expense_categories->remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$expense_categories_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($expense_categories->ExportAll && $expense_categories->Export <> "") {
	$expense_categories_list->lStopRec = $expense_categories_list->lTotalRecs;
} else {
	$expense_categories_list->lStopRec = $expense_categories_list->lStartRec + $expense_categories_list->lDisplayRecs - 1; // Set the last record to display
}
$expense_categories_list->lRecCount = $expense_categories_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $expense_categories_list->lStartRec > 1)
		$rs->Move($expense_categories_list->lStartRec - 1);
}

// Initialize aggregate
$expense_categories->RowType = EW_ROWTYPE_AGGREGATEINIT;
$expense_categories_list->RenderRow();
$expense_categories_list->lRowCnt = 0;
while (($expense_categories->CurrentAction == "gridadd" || !$rs->EOF) &&
	$expense_categories_list->lRecCount < $expense_categories_list->lStopRec) {
	$expense_categories_list->lRecCount++;
	if (intval($expense_categories_list->lRecCount) >= intval($expense_categories_list->lStartRec)) {
		$expense_categories_list->lRowCnt++;

	// Init row class and style
	$expense_categories->CssClass = "";
	$expense_categories->CssStyle = "";
	$expense_categories->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($expense_categories->CurrentAction == "gridadd") {
		$expense_categories_list->LoadDefaultValues(); // Load default values
	} else {
		$expense_categories_list->LoadRowValues($rs); // Load row values
	}
	$expense_categories->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$expense_categories_list->RenderRow();

	// Render list options
	$expense_categories_list->RenderListOptions();
?>
	<tr<?php echo $expense_categories->RowAttributes() ?>>
<?php

// Render list options (body, left)
$expense_categories_list->ListOptions->Render("body", "left");
?>
	<?php if ($expense_categories->id->Visible) { // id ?>
		<td<?php echo $expense_categories->id->CellAttributes() ?>>
<div<?php echo $expense_categories->id->ViewAttributes() ?>><?php echo $expense_categories->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->company_id->Visible) { // company_id ?>
		<td<?php echo $expense_categories->company_id->CellAttributes() ?>>
<div<?php echo $expense_categories->company_id->ViewAttributes() ?>><?php echo $expense_categories->company_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->category_name->Visible) { // category_name ?>
		<td<?php echo $expense_categories->category_name->CellAttributes() ?>>
<div<?php echo $expense_categories->category_name->ViewAttributes() ?>><?php echo $expense_categories->category_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->cost->Visible) { // cost ?>
		<td<?php echo $expense_categories->cost->CellAttributes() ?>>
<div<?php echo $expense_categories->cost->ViewAttributes() ?>><?php echo $expense_categories->cost->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->internal_reference->Visible) { // internal_reference ?>
		<td<?php echo $expense_categories->internal_reference->CellAttributes() ?>>
<div<?php echo $expense_categories->internal_reference->ViewAttributes() ?>><?php echo $expense_categories->internal_reference->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->re_invoice_expenses->Visible) { // re_invoice_expenses ?>
		<td<?php echo $expense_categories->re_invoice_expenses->CellAttributes() ?>>
<div<?php echo $expense_categories->re_invoice_expenses->ViewAttributes() ?>><?php echo $expense_categories->re_invoice_expenses->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->vendor_taxes->Visible) { // vendor_taxes ?>
		<td<?php echo $expense_categories->vendor_taxes->CellAttributes() ?>>
<div<?php echo $expense_categories->vendor_taxes->ViewAttributes() ?>><?php echo $expense_categories->vendor_taxes->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->customer_taxes->Visible) { // customer_taxes ?>
		<td<?php echo $expense_categories->customer_taxes->CellAttributes() ?>>
<div<?php echo $expense_categories->customer_taxes->ViewAttributes() ?>><?php echo $expense_categories->customer_taxes->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->created->Visible) { // created ?>
		<td<?php echo $expense_categories->created->CellAttributes() ?>>
<div<?php echo $expense_categories->created->ViewAttributes() ?>><?php echo $expense_categories->created->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->modified->Visible) { // modified ?>
		<td<?php echo $expense_categories->modified->CellAttributes() ?>>
<div<?php echo $expense_categories->modified->ViewAttributes() ?>><?php echo $expense_categories->modified->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->user_id->Visible) { // user_id ?>
		<td<?php echo $expense_categories->user_id->CellAttributes() ?>>
<div<?php echo $expense_categories->user_id->ViewAttributes() ?>><?php echo $expense_categories->user_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($expense_categories->remarks->Visible) { // remarks ?>
		<td<?php echo $expense_categories->remarks->CellAttributes() ?>>
<div<?php echo $expense_categories->remarks->ViewAttributes() ?>><?php echo $expense_categories->remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$expense_categories_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($expense_categories->CurrentAction <> "gridadd")
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
<?php if ($expense_categories_list->lTotalRecs > 0) { ?>
<?php if ($expense_categories->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($expense_categories->CurrentAction <> "gridadd" && $expense_categories->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expense_categories_list->Pager)) $expense_categories_list->Pager = new cPrevNextPager($expense_categories_list->lStartRec, $expense_categories_list->lDisplayRecs, $expense_categories_list->lTotalRecs) ?>
<?php if ($expense_categories_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expense_categories_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expense_categories_list->PageUrl() ?>start=<?php echo $expense_categories_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expense_categories_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expense_categories_list->PageUrl() ?>start=<?php echo $expense_categories_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expense_categories_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expense_categories_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expense_categories_list->PageUrl() ?>start=<?php echo $expense_categories_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expense_categories_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expense_categories_list->PageUrl() ?>start=<?php echo $expense_categories_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expense_categories_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expense_categories_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expense_categories_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expense_categories_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($expense_categories_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expense_categories_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expense_categories">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($expense_categories_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expense_categories_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expense_categories_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($expense_categories_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($expense_categories_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($expense_categories_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($expense_categories->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($expense_categories_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $expense_categories_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($expense_categories_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fexpense_categorieslist, '<?php echo $expense_categories_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($expense_categories->Export == "" && $expense_categories->CurrentAction == "") { ?>
<?php } ?>
<?php if ($expense_categories->Export == "") { ?>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$expense_categories_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpense_categories_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'expense_categories';

	// Page object name
	var $PageObjName = 'expense_categories_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expense_categories;
		if ($expense_categories->UseTokenInUrl) $PageUrl .= "t=" . $expense_categories->TableVar . "&"; // Add page token
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
		global $objForm, $expense_categories;
		if ($expense_categories->UseTokenInUrl) {
			if ($objForm)
				return ($expense_categories->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expense_categories->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpense_categories_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expense_categories)
		$GLOBALS["expense_categories"] = new cexpense_categories();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["expense_categories"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "expense_categoriesdelete.php";
		$this->MultiUpdateUrl = "expense_categoriesupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expense_categories', TRUE);

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
		global $expense_categories;

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
			$expense_categories->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$expense_categories->Export = $_POST["exporttype"];
		} else {
			$expense_categories->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $expense_categories->Export; // Get export parameter, used in header
		$gsExportFile = $expense_categories->TableVar; // Get export file, used in header
		if ($expense_categories->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $expense_categories;

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
			$expense_categories->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($expense_categories->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $expense_categories->getRecordsPerPage(); // Restore from Session
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
		$expense_categories->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$expense_categories->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$expense_categories->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $expense_categories->getSearchWhere();
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
		$expense_categories->setSessionWhere($sFilter);
		$expense_categories->CurrentFilter = "";

		// Export data only
		if (in_array($expense_categories->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($expense_categories->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $expense_categories;
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
			$expense_categories->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$expense_categories->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $expense_categories;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $expense_categories->category_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expense_categories->internal_reference, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expense_categories->re_invoice_expenses, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $expense_categories->remarks, $Keyword);
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
		global $Security, $expense_categories;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $expense_categories->BasicSearchKeyword;
		$sSearchType = $expense_categories->BasicSearchType;
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
			$expense_categories->setSessionBasicSearchKeyword($sSearchKeyword);
			$expense_categories->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $expense_categories;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$expense_categories->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $expense_categories;
		$expense_categories->setSessionBasicSearchKeyword("");
		$expense_categories->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $expense_categories;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$expense_categories->BasicSearchKeyword = $expense_categories->getSessionBasicSearchKeyword();
			$expense_categories->BasicSearchType = $expense_categories->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $expense_categories;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$expense_categories->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$expense_categories->CurrentOrderType = @$_GET["ordertype"];
			$expense_categories->UpdateSort($expense_categories->id); // id
			$expense_categories->UpdateSort($expense_categories->company_id); // company_id
			$expense_categories->UpdateSort($expense_categories->category_name); // category_name
			$expense_categories->UpdateSort($expense_categories->cost); // cost
			$expense_categories->UpdateSort($expense_categories->internal_reference); // internal_reference
			$expense_categories->UpdateSort($expense_categories->re_invoice_expenses); // re_invoice_expenses
			$expense_categories->UpdateSort($expense_categories->vendor_taxes); // vendor_taxes
			$expense_categories->UpdateSort($expense_categories->customer_taxes); // customer_taxes
			$expense_categories->UpdateSort($expense_categories->created); // created
			$expense_categories->UpdateSort($expense_categories->modified); // modified
			$expense_categories->UpdateSort($expense_categories->user_id); // user_id
			$expense_categories->UpdateSort($expense_categories->remarks); // remarks
			$expense_categories->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $expense_categories;
		$sOrderBy = $expense_categories->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($expense_categories->SqlOrderBy() <> "") {
				$sOrderBy = $expense_categories->SqlOrderBy();
				$expense_categories->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $expense_categories;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$expense_categories->setSessionOrderBy($sOrderBy);
				$expense_categories->id->setSort("");
				$expense_categories->company_id->setSort("");
				$expense_categories->category_name->setSort("");
				$expense_categories->cost->setSort("");
				$expense_categories->internal_reference->setSort("");
				$expense_categories->re_invoice_expenses->setSort("");
				$expense_categories->vendor_taxes->setSort("");
				$expense_categories->customer_taxes->setSort("");
				$expense_categories->created->setSort("");
				$expense_categories->modified->setSort("");
				$expense_categories->user_id->setSort("");
				$expense_categories->remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$expense_categories->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $expense_categories;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"expense_categories_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($expense_categories->Export <> "" ||
			$expense_categories->CurrentAction == "gridadd" ||
			$expense_categories->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $expense_categories;
		$this->ListOptions->LoadDefault();

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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($expense_categories->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $expense_categories;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expense_categories;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$expense_categories->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$expense_categories->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $expense_categories->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$expense_categories->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$expense_categories->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$expense_categories->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $expense_categories;
		$expense_categories->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$expense_categories->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expense_categories;

		// Call Recordset Selecting event
		$expense_categories->Recordset_Selecting($expense_categories->CurrentFilter);

		// Load List page SQL
		$sSql = $expense_categories->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expense_categories->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expense_categories;
		$sFilter = $expense_categories->KeyFilter();

		// Call Row Selecting event
		$expense_categories->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expense_categories->CurrentFilter = $sFilter;
		$sSql = $expense_categories->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$expense_categories->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expense_categories;
		$expense_categories->id->setDbValue($rs->fields('id'));
		$expense_categories->company_id->setDbValue($rs->fields('company_id'));
		$expense_categories->category_name->setDbValue($rs->fields('category_name'));
		$expense_categories->cost->setDbValue($rs->fields('cost'));
		$expense_categories->internal_reference->setDbValue($rs->fields('internal_reference'));
		$expense_categories->re_invoice_expenses->setDbValue($rs->fields('re_invoice_expenses'));
		$expense_categories->vendor_taxes->setDbValue($rs->fields('vendor_taxes'));
		$expense_categories->customer_taxes->setDbValue($rs->fields('customer_taxes'));
		$expense_categories->created->setDbValue($rs->fields('created'));
		$expense_categories->modified->setDbValue($rs->fields('modified'));
		$expense_categories->user_id->setDbValue($rs->fields('user_id'));
		$expense_categories->remarks->setDbValue($rs->fields('remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expense_categories;

		// Initialize URLs
		$this->ViewUrl = $expense_categories->ViewUrl();
		$this->EditUrl = $expense_categories->EditUrl();
		$this->InlineEditUrl = $expense_categories->InlineEditUrl();
		$this->CopyUrl = $expense_categories->CopyUrl();
		$this->InlineCopyUrl = $expense_categories->InlineCopyUrl();
		$this->DeleteUrl = $expense_categories->DeleteUrl();

		// Call Row_Rendering event
		$expense_categories->Row_Rendering();

		// Common render codes for all row types
		// id

		$expense_categories->id->CellCssStyle = ""; $expense_categories->id->CellCssClass = "";
		$expense_categories->id->CellAttrs = array(); $expense_categories->id->ViewAttrs = array(); $expense_categories->id->EditAttrs = array();

		// company_id
		$expense_categories->company_id->CellCssStyle = ""; $expense_categories->company_id->CellCssClass = "";
		$expense_categories->company_id->CellAttrs = array(); $expense_categories->company_id->ViewAttrs = array(); $expense_categories->company_id->EditAttrs = array();

		// category_name
		$expense_categories->category_name->CellCssStyle = ""; $expense_categories->category_name->CellCssClass = "";
		$expense_categories->category_name->CellAttrs = array(); $expense_categories->category_name->ViewAttrs = array(); $expense_categories->category_name->EditAttrs = array();

		// cost
		$expense_categories->cost->CellCssStyle = ""; $expense_categories->cost->CellCssClass = "";
		$expense_categories->cost->CellAttrs = array(); $expense_categories->cost->ViewAttrs = array(); $expense_categories->cost->EditAttrs = array();

		// internal_reference
		$expense_categories->internal_reference->CellCssStyle = ""; $expense_categories->internal_reference->CellCssClass = "";
		$expense_categories->internal_reference->CellAttrs = array(); $expense_categories->internal_reference->ViewAttrs = array(); $expense_categories->internal_reference->EditAttrs = array();

		// re_invoice_expenses
		$expense_categories->re_invoice_expenses->CellCssStyle = ""; $expense_categories->re_invoice_expenses->CellCssClass = "";
		$expense_categories->re_invoice_expenses->CellAttrs = array(); $expense_categories->re_invoice_expenses->ViewAttrs = array(); $expense_categories->re_invoice_expenses->EditAttrs = array();

		// vendor_taxes
		$expense_categories->vendor_taxes->CellCssStyle = ""; $expense_categories->vendor_taxes->CellCssClass = "";
		$expense_categories->vendor_taxes->CellAttrs = array(); $expense_categories->vendor_taxes->ViewAttrs = array(); $expense_categories->vendor_taxes->EditAttrs = array();

		// customer_taxes
		$expense_categories->customer_taxes->CellCssStyle = ""; $expense_categories->customer_taxes->CellCssClass = "";
		$expense_categories->customer_taxes->CellAttrs = array(); $expense_categories->customer_taxes->ViewAttrs = array(); $expense_categories->customer_taxes->EditAttrs = array();

		// created
		$expense_categories->created->CellCssStyle = ""; $expense_categories->created->CellCssClass = "";
		$expense_categories->created->CellAttrs = array(); $expense_categories->created->ViewAttrs = array(); $expense_categories->created->EditAttrs = array();

		// modified
		$expense_categories->modified->CellCssStyle = ""; $expense_categories->modified->CellCssClass = "";
		$expense_categories->modified->CellAttrs = array(); $expense_categories->modified->ViewAttrs = array(); $expense_categories->modified->EditAttrs = array();

		// user_id
		$expense_categories->user_id->CellCssStyle = ""; $expense_categories->user_id->CellCssClass = "";
		$expense_categories->user_id->CellAttrs = array(); $expense_categories->user_id->ViewAttrs = array(); $expense_categories->user_id->EditAttrs = array();

		// remarks
		$expense_categories->remarks->CellCssStyle = ""; $expense_categories->remarks->CellCssClass = "";
		$expense_categories->remarks->CellAttrs = array(); $expense_categories->remarks->ViewAttrs = array(); $expense_categories->remarks->EditAttrs = array();
		if ($expense_categories->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expense_categories->id->ViewValue = $expense_categories->id->CurrentValue;
			$expense_categories->id->CssStyle = "";
			$expense_categories->id->CssClass = "";
			$expense_categories->id->ViewCustomAttributes = "";

			// company_id
			if (strval($expense_categories->company_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expense_categories->company_id->CurrentValue) . "";
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
					$expense_categories->company_id->ViewValue = $rswrk->fields('Company_Name');
					$rswrk->Close();
				} else {
					$expense_categories->company_id->ViewValue = $expense_categories->company_id->CurrentValue;
				}
			} else {
				$expense_categories->company_id->ViewValue = NULL;
			}
			$expense_categories->company_id->CssStyle = "";
			$expense_categories->company_id->CssClass = "";
			$expense_categories->company_id->ViewCustomAttributes = "";

			// category_name
			$expense_categories->category_name->ViewValue = $expense_categories->category_name->CurrentValue;
			$expense_categories->category_name->CssStyle = "";
			$expense_categories->category_name->CssClass = "";
			$expense_categories->category_name->ViewCustomAttributes = "";

			// cost
			$expense_categories->cost->ViewValue = $expense_categories->cost->CurrentValue;
			$expense_categories->cost->ViewValue = ew_FormatNumber($expense_categories->cost->ViewValue, 2, -2, -2, -2);
			$expense_categories->cost->CssStyle = "";
			$expense_categories->cost->CssClass = "";
			$expense_categories->cost->ViewCustomAttributes = "";

			// internal_reference
			$expense_categories->internal_reference->ViewValue = $expense_categories->internal_reference->CurrentValue;
			$expense_categories->internal_reference->CssStyle = "";
			$expense_categories->internal_reference->CssClass = "";
			$expense_categories->internal_reference->ViewCustomAttributes = "";

			// re_invoice_expenses
			if (strval($expense_categories->re_invoice_expenses->CurrentValue) <> "") {
				switch ($expense_categories->re_invoice_expenses->CurrentValue) {
					case "yes":
						$expense_categories->re_invoice_expenses->ViewValue = "At Invoice";
						break;
					case "no":
						$expense_categories->re_invoice_expenses->ViewValue = "No";
						break;
					default:
						$expense_categories->re_invoice_expenses->ViewValue = $expense_categories->re_invoice_expenses->CurrentValue;
				}
			} else {
				$expense_categories->re_invoice_expenses->ViewValue = NULL;
			}
			$expense_categories->re_invoice_expenses->CssStyle = "";
			$expense_categories->re_invoice_expenses->CssClass = "";
			$expense_categories->re_invoice_expenses->ViewCustomAttributes = "";

			// vendor_taxes
			$expense_categories->vendor_taxes->ViewValue = $expense_categories->vendor_taxes->CurrentValue;
			$expense_categories->vendor_taxes->CssStyle = "";
			$expense_categories->vendor_taxes->CssClass = "";
			$expense_categories->vendor_taxes->ViewCustomAttributes = "";

			// customer_taxes
			$expense_categories->customer_taxes->ViewValue = $expense_categories->customer_taxes->CurrentValue;
			$expense_categories->customer_taxes->CssStyle = "";
			$expense_categories->customer_taxes->CssClass = "";
			$expense_categories->customer_taxes->ViewCustomAttributes = "";

			// created
			$expense_categories->created->ViewValue = $expense_categories->created->CurrentValue;
			$expense_categories->created->ViewValue = ew_FormatDateTime($expense_categories->created->ViewValue, 6);
			$expense_categories->created->CssStyle = "";
			$expense_categories->created->CssClass = "";
			$expense_categories->created->ViewCustomAttributes = "";

			// modified
			$expense_categories->modified->ViewValue = $expense_categories->modified->CurrentValue;
			$expense_categories->modified->ViewValue = ew_FormatDateTime($expense_categories->modified->ViewValue, 6);
			$expense_categories->modified->CssStyle = "";
			$expense_categories->modified->CssClass = "";
			$expense_categories->modified->ViewCustomAttributes = "";

			// user_id
			$expense_categories->user_id->ViewValue = $expense_categories->user_id->CurrentValue;
			$expense_categories->user_id->CssStyle = "";
			$expense_categories->user_id->CssClass = "";
			$expense_categories->user_id->ViewCustomAttributes = "";

			// remarks
			$expense_categories->remarks->ViewValue = $expense_categories->remarks->CurrentValue;
			$expense_categories->remarks->CssStyle = "";
			$expense_categories->remarks->CssClass = "";
			$expense_categories->remarks->ViewCustomAttributes = "";

			// id
			$expense_categories->id->HrefValue = "";
			$expense_categories->id->TooltipValue = "";

			// company_id
			$expense_categories->company_id->HrefValue = "";
			$expense_categories->company_id->TooltipValue = "";

			// category_name
			$expense_categories->category_name->HrefValue = "";
			$expense_categories->category_name->TooltipValue = "";

			// cost
			$expense_categories->cost->HrefValue = "";
			$expense_categories->cost->TooltipValue = "";

			// internal_reference
			$expense_categories->internal_reference->HrefValue = "";
			$expense_categories->internal_reference->TooltipValue = "";

			// re_invoice_expenses
			$expense_categories->re_invoice_expenses->HrefValue = "";
			$expense_categories->re_invoice_expenses->TooltipValue = "";

			// vendor_taxes
			$expense_categories->vendor_taxes->HrefValue = "";
			$expense_categories->vendor_taxes->TooltipValue = "";

			// customer_taxes
			$expense_categories->customer_taxes->HrefValue = "";
			$expense_categories->customer_taxes->TooltipValue = "";

			// created
			$expense_categories->created->HrefValue = "";
			$expense_categories->created->TooltipValue = "";

			// modified
			$expense_categories->modified->HrefValue = "";
			$expense_categories->modified->TooltipValue = "";

			// user_id
			$expense_categories->user_id->HrefValue = "";
			$expense_categories->user_id->TooltipValue = "";

			// remarks
			$expense_categories->remarks->HrefValue = "";
			$expense_categories->remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expense_categories->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expense_categories->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $expense_categories;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $expense_categories->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($expense_categories->ExportAll) {
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
		if ($expense_categories->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($expense_categories, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($expense_categories->id);
				$ExportDoc->ExportCaption($expense_categories->company_id);
				$ExportDoc->ExportCaption($expense_categories->category_name);
				$ExportDoc->ExportCaption($expense_categories->cost);
				$ExportDoc->ExportCaption($expense_categories->internal_reference);
				$ExportDoc->ExportCaption($expense_categories->re_invoice_expenses);
				$ExportDoc->ExportCaption($expense_categories->vendor_taxes);
				$ExportDoc->ExportCaption($expense_categories->customer_taxes);
				$ExportDoc->ExportCaption($expense_categories->created);
				$ExportDoc->ExportCaption($expense_categories->modified);
				$ExportDoc->ExportCaption($expense_categories->user_id);
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
				$expense_categories->CssClass = "";
				$expense_categories->CssStyle = "";
				$expense_categories->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($expense_categories->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $expense_categories->id->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('company_id', $expense_categories->company_id->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('category_name', $expense_categories->category_name->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('cost', $expense_categories->cost->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('internal_reference', $expense_categories->internal_reference->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('re_invoice_expenses', $expense_categories->re_invoice_expenses->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('vendor_taxes', $expense_categories->vendor_taxes->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('customer_taxes', $expense_categories->customer_taxes->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('created', $expense_categories->created->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('modified', $expense_categories->modified->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
					$XmlDoc->AddField('user_id', $expense_categories->user_id->ExportValue($expense_categories->Export, $expense_categories->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($expense_categories->id);
					$ExportDoc->ExportField($expense_categories->company_id);
					$ExportDoc->ExportField($expense_categories->category_name);
					$ExportDoc->ExportField($expense_categories->cost);
					$ExportDoc->ExportField($expense_categories->internal_reference);
					$ExportDoc->ExportField($expense_categories->re_invoice_expenses);
					$ExportDoc->ExportField($expense_categories->vendor_taxes);
					$ExportDoc->ExportField($expense_categories->customer_taxes);
					$ExportDoc->ExportField($expense_categories->created);
					$ExportDoc->ExportField($expense_categories->modified);
					$ExportDoc->ExportField($expense_categories->user_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($expense_categories->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($expense_categories->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($expense_categories->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($expense_categories->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($expense_categories->ExportReturnUrl());
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
