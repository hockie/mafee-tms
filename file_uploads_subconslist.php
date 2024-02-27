<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_uploads_subconsinfo.php" ?>
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
$file_uploads_subcons_list = new cfile_uploads_subcons_list();
$Page =& $file_uploads_subcons_list;

// Page init
$file_uploads_subcons_list->Page_Init();

// Page main
$file_uploads_subcons_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($file_uploads_subcons->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var file_uploads_subcons_list = new ew_Page("file_uploads_subcons_list");

// page properties
file_uploads_subcons_list.PageID = "list"; // page ID
file_uploads_subcons_list.FormID = "ffile_uploads_subconslist"; // form ID
var EW_PAGE_ID = file_uploads_subcons_list.PageID; // for backward compatibility

// extend page with validate function for search
file_uploads_subcons_list.ValidateSearch = function(fobj) {
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
file_uploads_subcons_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
file_uploads_subcons_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
file_uploads_subcons_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_uploads_subcons_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($file_uploads_subcons->Export == "") { ?>
<?php
$gsMasterReturnUrl = "subconslist.php";
if ($file_uploads_subcons_list->sDbMasterFilter <> "" && $file_uploads_subcons->getCurrentMasterTable() == "subcons") {
	if ($file_uploads_subcons_list->bMasterRecordExists) {
		if ($file_uploads_subcons->getCurrentMasterTable() == $file_uploads_subcons->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$file_uploads_subcons_list->lTotalRecs = $file_uploads_subcons->SelectRecordCount();
	} else {
		if ($rs = $file_uploads_subcons_list->LoadRecordset())
			$file_uploads_subcons_list->lTotalRecs = $rs->RecordCount();
	}
	$file_uploads_subcons_list->lStartRec = 1;
	if ($file_uploads_subcons_list->lDisplayRecs <= 0 || ($file_uploads_subcons->Export <> "" && $file_uploads_subcons->ExportAll)) // Display all records
		$file_uploads_subcons_list->lDisplayRecs = $file_uploads_subcons_list->lTotalRecs;
	if (!($file_uploads_subcons->Export <> "" && $file_uploads_subcons->ExportAll))
		$file_uploads_subcons_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $file_uploads_subcons_list->LoadRecordset($file_uploads_subcons_list->lStartRec-1, $file_uploads_subcons_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_uploads_subcons->TableCaption() ?>
<?php if ($file_uploads_subcons->Export == "" && $file_uploads_subcons->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $file_uploads_subcons_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $file_uploads_subcons_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $file_uploads_subcons_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($file_uploads_subcons->Export == "" && $file_uploads_subcons->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(file_uploads_subcons_list);" style="text-decoration: none;"><img id="file_uploads_subcons_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="file_uploads_subcons_list_SearchPanel">
<form name="ffile_uploads_subconslistsrch" id="ffile_uploads_subconslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return file_uploads_subcons_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="file_uploads_subcons">
<?php
if ($gsSearchError == "")
	$file_uploads_subcons_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$file_uploads_subcons->RowType = EW_ROWTYPE_SEARCH;

// Render row
$file_uploads_subcons_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $file_uploads_subcons->Subcon_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($file_uploads_subcons->Subcon_ID->getSessionValue() <> "") { ?>
<div<?php echo $file_uploads_subcons->Subcon_ID->ViewAttributes() ?>><?php echo $file_uploads_subcons->Subcon_ID->ListViewValue() ?></div>
<input type="hidden" id="x_Subcon_ID" name="x_Subcon_ID" value="<?php echo ew_HtmlEncode($file_uploads_subcons->Subcon_ID->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<select id="x_Subcon_ID" name="x_Subcon_ID" title="<?php echo $file_uploads_subcons->Subcon_ID->FldTitle() ?>"<?php echo $file_uploads_subcons->Subcon_ID->EditAttributes() ?>>
<?php
if (is_array($file_uploads_subcons->Subcon_ID->EditValue)) {
	$arwrk = $file_uploads_subcons->Subcon_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($file_uploads_subcons->Subcon_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $file_uploads_subcons->Filename->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Filename" id="z_Filename" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="file" name="x_Filename" id="x_Filename" title="<?php echo $file_uploads_subcons->Filename->FldTitle() ?>" size="30"<?php echo $file_uploads_subcons->Filename->EditAttributes() ?>>
</div>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $file_uploads_subcons->File_Type_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_File_Type_ID" id="z_File_Type_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_File_Type_ID" name="x_File_Type_ID" title="<?php echo $file_uploads_subcons->File_Type_ID->FldTitle() ?>"<?php echo $file_uploads_subcons->File_Type_ID->EditAttributes() ?>>
<?php
if (is_array($file_uploads_subcons->File_Type_ID->EditValue)) {
	$arwrk = $file_uploads_subcons->File_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($file_uploads_subcons->File_Type_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($file_uploads_subcons->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($file_uploads_subcons->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($file_uploads_subcons->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($file_uploads_subcons->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_uploads_subcons_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($file_uploads_subcons->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($file_uploads_subcons->CurrentAction <> "gridadd" && $file_uploads_subcons->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($file_uploads_subcons_list->Pager)) $file_uploads_subcons_list->Pager = new cPrevNextPager($file_uploads_subcons_list->lStartRec, $file_uploads_subcons_list->lDisplayRecs, $file_uploads_subcons_list->lTotalRecs) ?>
<?php if ($file_uploads_subcons_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($file_uploads_subcons_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>start=<?php echo $file_uploads_subcons_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($file_uploads_subcons_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>start=<?php echo $file_uploads_subcons_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $file_uploads_subcons_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($file_uploads_subcons_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>start=<?php echo $file_uploads_subcons_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($file_uploads_subcons_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>start=<?php echo $file_uploads_subcons_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $file_uploads_subcons_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $file_uploads_subcons_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $file_uploads_subcons_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $file_uploads_subcons_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($file_uploads_subcons_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($file_uploads_subcons_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="file_uploads_subcons">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($file_uploads_subcons_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($file_uploads_subcons_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($file_uploads_subcons_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($file_uploads_subcons_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($file_uploads_subcons_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($file_uploads_subcons_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($file_uploads_subcons->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $file_uploads_subcons_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($file_uploads_subcons_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ffile_uploads_subconslist, '<?php echo $file_uploads_subcons_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ffile_uploads_subconslist" id="ffile_uploads_subconslist" class="ewForm" action="" method="post">
<div id="gmp_file_uploads_subcons" class="ewGridMiddlePanel">
<?php if ($file_uploads_subcons_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $file_uploads_subcons->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$file_uploads_subcons_list->RenderListOptions();

// Render list options (header, left)
$file_uploads_subcons_list->ListOptions->Render("header", "left");
?>
<?php if ($file_uploads_subcons->id->Visible) { // id ?>
	<?php if ($file_uploads_subcons->SortUrl($file_uploads_subcons->id) == "") { ?>
		<td><?php echo $file_uploads_subcons->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $file_uploads_subcons->SortUrl($file_uploads_subcons->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $file_uploads_subcons->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($file_uploads_subcons->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($file_uploads_subcons->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($file_uploads_subcons->Subcon_ID->Visible) { // Subcon_ID ?>
	<?php if ($file_uploads_subcons->SortUrl($file_uploads_subcons->Subcon_ID) == "") { ?>
		<td><?php echo $file_uploads_subcons->Subcon_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $file_uploads_subcons->SortUrl($file_uploads_subcons->Subcon_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $file_uploads_subcons->Subcon_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($file_uploads_subcons->Subcon_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($file_uploads_subcons->Subcon_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($file_uploads_subcons->Filename->Visible) { // Filename ?>
	<?php if ($file_uploads_subcons->SortUrl($file_uploads_subcons->Filename) == "") { ?>
		<td><?php echo $file_uploads_subcons->Filename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $file_uploads_subcons->SortUrl($file_uploads_subcons->Filename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $file_uploads_subcons->Filename->FldCaption() ?></td><td style="width: 10px;"><?php if ($file_uploads_subcons->Filename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($file_uploads_subcons->Filename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($file_uploads_subcons->File_Type_ID->Visible) { // File_Type_ID ?>
	<?php if ($file_uploads_subcons->SortUrl($file_uploads_subcons->File_Type_ID) == "") { ?>
		<td><?php echo $file_uploads_subcons->File_Type_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $file_uploads_subcons->SortUrl($file_uploads_subcons->File_Type_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $file_uploads_subcons->File_Type_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($file_uploads_subcons->File_Type_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($file_uploads_subcons->File_Type_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($file_uploads_subcons->Created->Visible) { // Created ?>
	<?php if ($file_uploads_subcons->SortUrl($file_uploads_subcons->Created) == "") { ?>
		<td><?php echo $file_uploads_subcons->Created->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $file_uploads_subcons->SortUrl($file_uploads_subcons->Created) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $file_uploads_subcons->Created->FldCaption() ?></td><td style="width: 10px;"><?php if ($file_uploads_subcons->Created->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($file_uploads_subcons->Created->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($file_uploads_subcons->Modified->Visible) { // Modified ?>
	<?php if ($file_uploads_subcons->SortUrl($file_uploads_subcons->Modified) == "") { ?>
		<td><?php echo $file_uploads_subcons->Modified->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $file_uploads_subcons->SortUrl($file_uploads_subcons->Modified) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $file_uploads_subcons->Modified->FldCaption() ?></td><td style="width: 10px;"><?php if ($file_uploads_subcons->Modified->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($file_uploads_subcons->Modified->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($file_uploads_subcons->Remarks->Visible) { // Remarks ?>
	<?php if ($file_uploads_subcons->SortUrl($file_uploads_subcons->Remarks) == "") { ?>
		<td><?php echo $file_uploads_subcons->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $file_uploads_subcons->SortUrl($file_uploads_subcons->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $file_uploads_subcons->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($file_uploads_subcons->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($file_uploads_subcons->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$file_uploads_subcons_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($file_uploads_subcons->ExportAll && $file_uploads_subcons->Export <> "") {
	$file_uploads_subcons_list->lStopRec = $file_uploads_subcons_list->lTotalRecs;
} else {
	$file_uploads_subcons_list->lStopRec = $file_uploads_subcons_list->lStartRec + $file_uploads_subcons_list->lDisplayRecs - 1; // Set the last record to display
}
$file_uploads_subcons_list->lRecCount = $file_uploads_subcons_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $file_uploads_subcons_list->lStartRec > 1)
		$rs->Move($file_uploads_subcons_list->lStartRec - 1);
}

// Initialize aggregate
$file_uploads_subcons->RowType = EW_ROWTYPE_AGGREGATEINIT;
$file_uploads_subcons_list->RenderRow();
$file_uploads_subcons_list->lRowCnt = 0;
while (($file_uploads_subcons->CurrentAction == "gridadd" || !$rs->EOF) &&
	$file_uploads_subcons_list->lRecCount < $file_uploads_subcons_list->lStopRec) {
	$file_uploads_subcons_list->lRecCount++;
	if (intval($file_uploads_subcons_list->lRecCount) >= intval($file_uploads_subcons_list->lStartRec)) {
		$file_uploads_subcons_list->lRowCnt++;

	// Init row class and style
	$file_uploads_subcons->CssClass = "";
	$file_uploads_subcons->CssStyle = "";
	$file_uploads_subcons->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($file_uploads_subcons->CurrentAction == "gridadd") {
		$file_uploads_subcons_list->LoadDefaultValues(); // Load default values
	} else {
		$file_uploads_subcons_list->LoadRowValues($rs); // Load row values
	}
	$file_uploads_subcons->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$file_uploads_subcons_list->RenderRow();

	// Render list options
	$file_uploads_subcons_list->RenderListOptions();
?>
	<tr<?php echo $file_uploads_subcons->RowAttributes() ?>>
<?php

// Render list options (body, left)
$file_uploads_subcons_list->ListOptions->Render("body", "left");
?>
	<?php if ($file_uploads_subcons->id->Visible) { // id ?>
		<td<?php echo $file_uploads_subcons->id->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->id->ViewAttributes() ?>><?php echo $file_uploads_subcons->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($file_uploads_subcons->Subcon_ID->Visible) { // Subcon_ID ?>
		<td<?php echo $file_uploads_subcons->Subcon_ID->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->Subcon_ID->ViewAttributes() ?>><?php echo $file_uploads_subcons->Subcon_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($file_uploads_subcons->Filename->Visible) { // Filename ?>
		<td<?php echo $file_uploads_subcons->Filename->CellAttributes() ?>>
<?php if ($file_uploads_subcons->Filename->HrefValue <> "" || $file_uploads_subcons->Filename->TooltipValue <> "") { ?>
<?php if (!empty($file_uploads_subcons->Filename->Upload->DbValue)) { ?>
<a href="<?php echo $file_uploads_subcons->Filename->HrefValue ?>"><?php echo $file_uploads_subcons->Filename->ListViewValue() ?></a>
<?php } elseif (!in_array($file_uploads_subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($file_uploads_subcons->Filename->Upload->DbValue)) { ?>
<?php echo $file_uploads_subcons->Filename->ListViewValue() ?>
<?php } elseif (!in_array($file_uploads_subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($file_uploads_subcons->File_Type_ID->Visible) { // File_Type_ID ?>
		<td<?php echo $file_uploads_subcons->File_Type_ID->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->File_Type_ID->ViewAttributes() ?>><?php echo $file_uploads_subcons->File_Type_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($file_uploads_subcons->Created->Visible) { // Created ?>
		<td<?php echo $file_uploads_subcons->Created->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->Created->ViewAttributes() ?>><?php echo $file_uploads_subcons->Created->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($file_uploads_subcons->Modified->Visible) { // Modified ?>
		<td<?php echo $file_uploads_subcons->Modified->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->Modified->ViewAttributes() ?>><?php echo $file_uploads_subcons->Modified->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($file_uploads_subcons->Remarks->Visible) { // Remarks ?>
		<td<?php echo $file_uploads_subcons->Remarks->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->Remarks->ViewAttributes() ?>><?php echo $file_uploads_subcons->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$file_uploads_subcons_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($file_uploads_subcons->CurrentAction <> "gridadd")
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
<?php if ($file_uploads_subcons_list->lTotalRecs > 0) { ?>
<?php if ($file_uploads_subcons->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($file_uploads_subcons->CurrentAction <> "gridadd" && $file_uploads_subcons->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($file_uploads_subcons_list->Pager)) $file_uploads_subcons_list->Pager = new cPrevNextPager($file_uploads_subcons_list->lStartRec, $file_uploads_subcons_list->lDisplayRecs, $file_uploads_subcons_list->lTotalRecs) ?>
<?php if ($file_uploads_subcons_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($file_uploads_subcons_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>start=<?php echo $file_uploads_subcons_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($file_uploads_subcons_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>start=<?php echo $file_uploads_subcons_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $file_uploads_subcons_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($file_uploads_subcons_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>start=<?php echo $file_uploads_subcons_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($file_uploads_subcons_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $file_uploads_subcons_list->PageUrl() ?>start=<?php echo $file_uploads_subcons_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $file_uploads_subcons_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $file_uploads_subcons_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $file_uploads_subcons_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $file_uploads_subcons_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($file_uploads_subcons_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($file_uploads_subcons_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="file_uploads_subcons">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($file_uploads_subcons_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($file_uploads_subcons_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($file_uploads_subcons_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($file_uploads_subcons_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($file_uploads_subcons_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($file_uploads_subcons_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($file_uploads_subcons->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($file_uploads_subcons_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $file_uploads_subcons_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($file_uploads_subcons_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ffile_uploads_subconslist, '<?php echo $file_uploads_subcons_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($file_uploads_subcons->Export == "" && $file_uploads_subcons->CurrentAction == "") { ?>
<?php } ?>
<?php if ($file_uploads_subcons->Export == "") { ?>
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
$file_uploads_subcons_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_uploads_subcons_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'file_uploads_subcons';

	// Page object name
	var $PageObjName = 'file_uploads_subcons_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_uploads_subcons;
		if ($file_uploads_subcons->UseTokenInUrl) $PageUrl .= "t=" . $file_uploads_subcons->TableVar . "&"; // Add page token
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
		global $objForm, $file_uploads_subcons;
		if ($file_uploads_subcons->UseTokenInUrl) {
			if ($objForm)
				return ($file_uploads_subcons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_uploads_subcons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_uploads_subcons_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_uploads_subcons)
		$GLOBALS["file_uploads_subcons"] = new cfile_uploads_subcons();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["file_uploads_subcons"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "file_uploads_subconsdelete.php";
		$this->MultiUpdateUrl = "file_uploads_subconsupdate.php";

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_uploads_subcons', TRUE);

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
		global $file_uploads_subcons;

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
			$file_uploads_subcons->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$file_uploads_subcons->Export = $_POST["exporttype"];
		} else {
			$file_uploads_subcons->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $file_uploads_subcons->Export; // Get export parameter, used in header
		$gsExportFile = $file_uploads_subcons->TableVar; // Get export file, used in header
		if ($file_uploads_subcons->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $file_uploads_subcons;

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

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$file_uploads_subcons->Recordset_SearchValidated();

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
		if ($file_uploads_subcons->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $file_uploads_subcons->getRecordsPerPage(); // Restore from Session
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
		$file_uploads_subcons->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$file_uploads_subcons->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $file_uploads_subcons->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $file_uploads_subcons->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $file_uploads_subcons->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($file_uploads_subcons->getMasterFilter() <> "" && $file_uploads_subcons->getCurrentMasterTable() == "subcons") {
			global $subcons;
			$rsmaster = $subcons->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$file_uploads_subcons->setMasterFilter(""); // Clear master filter
				$file_uploads_subcons->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($file_uploads_subcons->getReturnUrl()); // Return to caller
			} else {
				$subcons->LoadListRowValues($rsmaster);
				$subcons->RowType = EW_ROWTYPE_MASTER; // Master row
				$subcons->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$file_uploads_subcons->setSessionWhere($sFilter);
		$file_uploads_subcons->CurrentFilter = "";

		// Export data only
		if (in_array($file_uploads_subcons->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($file_uploads_subcons->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $file_uploads_subcons;
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
			$file_uploads_subcons->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $file_uploads_subcons;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $file_uploads_subcons->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $file_uploads_subcons->Subcon_ID, FALSE); // Subcon_ID
		$this->BuildSearchSql($sWhere, $file_uploads_subcons->File_Type_ID, FALSE); // File_Type_ID
		$this->BuildSearchSql($sWhere, $file_uploads_subcons->Created, FALSE); // Created
		$this->BuildSearchSql($sWhere, $file_uploads_subcons->Modified, FALSE); // Modified
		$this->BuildSearchSql($sWhere, $file_uploads_subcons->Remarks, FALSE); // Remarks

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($file_uploads_subcons->id); // id
			$this->SetSearchParm($file_uploads_subcons->Subcon_ID); // Subcon_ID
			$this->SetSearchParm($file_uploads_subcons->File_Type_ID); // File_Type_ID
			$this->SetSearchParm($file_uploads_subcons->Created); // Created
			$this->SetSearchParm($file_uploads_subcons->Modified); // Modified
			$this->SetSearchParm($file_uploads_subcons->Remarks); // Remarks
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
		global $file_uploads_subcons;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$file_uploads_subcons->setAdvancedSearch("x_$FldParm", $FldVal);
		$file_uploads_subcons->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$file_uploads_subcons->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$file_uploads_subcons->setAdvancedSearch("y_$FldParm", $FldVal2);
		$file_uploads_subcons->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $file_uploads_subcons;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $file_uploads_subcons->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $file_uploads_subcons->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $file_uploads_subcons->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $file_uploads_subcons->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $file_uploads_subcons->GetAdvancedSearch("w_$FldParm");
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
		global $file_uploads_subcons;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $file_uploads_subcons->Filename, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $file_uploads_subcons->Remarks, $Keyword);
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
		global $Security, $file_uploads_subcons;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $file_uploads_subcons->BasicSearchKeyword;
		$sSearchType = $file_uploads_subcons->BasicSearchType;
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
			$file_uploads_subcons->setSessionBasicSearchKeyword($sSearchKeyword);
			$file_uploads_subcons->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $file_uploads_subcons;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$file_uploads_subcons->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $file_uploads_subcons;
		$file_uploads_subcons->setSessionBasicSearchKeyword("");
		$file_uploads_subcons->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $file_uploads_subcons;
		$file_uploads_subcons->setAdvancedSearch("x_id", "");
		$file_uploads_subcons->setAdvancedSearch("x_Subcon_ID", "");
		$file_uploads_subcons->setAdvancedSearch("x_File_Type_ID", "");
		$file_uploads_subcons->setAdvancedSearch("x_Created", "");
		$file_uploads_subcons->setAdvancedSearch("x_Modified", "");
		$file_uploads_subcons->setAdvancedSearch("x_Remarks", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $file_uploads_subcons;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Subcon_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_File_Type_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Created"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Modified"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$file_uploads_subcons->BasicSearchKeyword = $file_uploads_subcons->getSessionBasicSearchKeyword();
			$file_uploads_subcons->BasicSearchType = $file_uploads_subcons->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($file_uploads_subcons->id);
			$this->GetSearchParm($file_uploads_subcons->Subcon_ID);
			$this->GetSearchParm($file_uploads_subcons->File_Type_ID);
			$this->GetSearchParm($file_uploads_subcons->Created);
			$this->GetSearchParm($file_uploads_subcons->Modified);
			$this->GetSearchParm($file_uploads_subcons->Remarks);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $file_uploads_subcons;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$file_uploads_subcons->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$file_uploads_subcons->CurrentOrderType = @$_GET["ordertype"];
			$file_uploads_subcons->UpdateSort($file_uploads_subcons->id); // id
			$file_uploads_subcons->UpdateSort($file_uploads_subcons->Subcon_ID); // Subcon_ID
			$file_uploads_subcons->UpdateSort($file_uploads_subcons->Filename); // Filename
			$file_uploads_subcons->UpdateSort($file_uploads_subcons->File_Type_ID); // File_Type_ID
			$file_uploads_subcons->UpdateSort($file_uploads_subcons->Created); // Created
			$file_uploads_subcons->UpdateSort($file_uploads_subcons->Modified); // Modified
			$file_uploads_subcons->UpdateSort($file_uploads_subcons->Remarks); // Remarks
			$file_uploads_subcons->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $file_uploads_subcons;
		$sOrderBy = $file_uploads_subcons->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($file_uploads_subcons->SqlOrderBy() <> "") {
				$sOrderBy = $file_uploads_subcons->SqlOrderBy();
				$file_uploads_subcons->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $file_uploads_subcons;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$file_uploads_subcons->getCurrentMasterTable = ""; // Clear master table
				$file_uploads_subcons->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$file_uploads_subcons->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$file_uploads_subcons->Subcon_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$file_uploads_subcons->setSessionOrderBy($sOrderBy);
				$file_uploads_subcons->id->setSort("");
				$file_uploads_subcons->Subcon_ID->setSort("");
				$file_uploads_subcons->Filename->setSort("");
				$file_uploads_subcons->File_Type_ID->setSort("");
				$file_uploads_subcons->Created->setSort("");
				$file_uploads_subcons->Modified->setSort("");
				$file_uploads_subcons->Remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $file_uploads_subcons;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"file_uploads_subcons_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($file_uploads_subcons->Export <> "" ||
			$file_uploads_subcons->CurrentAction == "gridadd" ||
			$file_uploads_subcons->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $file_uploads_subcons;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($file_uploads_subcons->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $file_uploads_subcons;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $file_uploads_subcons;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $file_uploads_subcons->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $file_uploads_subcons;
		$file_uploads_subcons->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$file_uploads_subcons->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $file_uploads_subcons;

		// Load search values
		// id

		$file_uploads_subcons->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$file_uploads_subcons->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Subcon_ID
		$file_uploads_subcons->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Subcon_ID"]);
		$file_uploads_subcons->Subcon_ID->AdvancedSearch->SearchOperator = @$_GET["z_Subcon_ID"];

		// File_Type_ID
		$file_uploads_subcons->File_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_File_Type_ID"]);
		$file_uploads_subcons->File_Type_ID->AdvancedSearch->SearchOperator = @$_GET["z_File_Type_ID"];

		// Created
		$file_uploads_subcons->Created->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Created"]);
		$file_uploads_subcons->Created->AdvancedSearch->SearchOperator = @$_GET["z_Created"];

		// Modified
		$file_uploads_subcons->Modified->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Modified"]);
		$file_uploads_subcons->Modified->AdvancedSearch->SearchOperator = @$_GET["z_Modified"];

		// Remarks
		$file_uploads_subcons->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$file_uploads_subcons->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $file_uploads_subcons;

		// Call Recordset Selecting event
		$file_uploads_subcons->Recordset_Selecting($file_uploads_subcons->CurrentFilter);

		// Load List page SQL
		$sSql = $file_uploads_subcons->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$file_uploads_subcons->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_uploads_subcons;
		$sFilter = $file_uploads_subcons->KeyFilter();

		// Call Row Selecting event
		$file_uploads_subcons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_uploads_subcons->CurrentFilter = $sFilter;
		$sSql = $file_uploads_subcons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_uploads_subcons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_uploads_subcons;
		$file_uploads_subcons->id->setDbValue($rs->fields('id'));
		$file_uploads_subcons->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$file_uploads_subcons->Filename->Upload->DbValue = $rs->fields('Filename');
		$file_uploads_subcons->File_Type_ID->setDbValue($rs->fields('File_Type_ID'));
		$file_uploads_subcons->Created->setDbValue($rs->fields('Created'));
		$file_uploads_subcons->Modified->setDbValue($rs->fields('Modified'));
		$file_uploads_subcons->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_uploads_subcons;

		// Initialize URLs
		$this->ViewUrl = $file_uploads_subcons->ViewUrl();
		$this->EditUrl = $file_uploads_subcons->EditUrl();
		$this->InlineEditUrl = $file_uploads_subcons->InlineEditUrl();
		$this->CopyUrl = $file_uploads_subcons->CopyUrl();
		$this->InlineCopyUrl = $file_uploads_subcons->InlineCopyUrl();
		$this->DeleteUrl = $file_uploads_subcons->DeleteUrl();

		// Call Row_Rendering event
		$file_uploads_subcons->Row_Rendering();

		// Common render codes for all row types
		// id

		$file_uploads_subcons->id->CellCssStyle = ""; $file_uploads_subcons->id->CellCssClass = "";
		$file_uploads_subcons->id->CellAttrs = array(); $file_uploads_subcons->id->ViewAttrs = array(); $file_uploads_subcons->id->EditAttrs = array();

		// Subcon_ID
		$file_uploads_subcons->Subcon_ID->CellCssStyle = ""; $file_uploads_subcons->Subcon_ID->CellCssClass = "";
		$file_uploads_subcons->Subcon_ID->CellAttrs = array(); $file_uploads_subcons->Subcon_ID->ViewAttrs = array(); $file_uploads_subcons->Subcon_ID->EditAttrs = array();

		// Filename
		$file_uploads_subcons->Filename->CellCssStyle = ""; $file_uploads_subcons->Filename->CellCssClass = "";
		$file_uploads_subcons->Filename->CellAttrs = array(); $file_uploads_subcons->Filename->ViewAttrs = array(); $file_uploads_subcons->Filename->EditAttrs = array();

		// File_Type_ID
		$file_uploads_subcons->File_Type_ID->CellCssStyle = ""; $file_uploads_subcons->File_Type_ID->CellCssClass = "";
		$file_uploads_subcons->File_Type_ID->CellAttrs = array(); $file_uploads_subcons->File_Type_ID->ViewAttrs = array(); $file_uploads_subcons->File_Type_ID->EditAttrs = array();

		// Created
		$file_uploads_subcons->Created->CellCssStyle = ""; $file_uploads_subcons->Created->CellCssClass = "";
		$file_uploads_subcons->Created->CellAttrs = array(); $file_uploads_subcons->Created->ViewAttrs = array(); $file_uploads_subcons->Created->EditAttrs = array();

		// Modified
		$file_uploads_subcons->Modified->CellCssStyle = ""; $file_uploads_subcons->Modified->CellCssClass = "";
		$file_uploads_subcons->Modified->CellAttrs = array(); $file_uploads_subcons->Modified->ViewAttrs = array(); $file_uploads_subcons->Modified->EditAttrs = array();

		// Remarks
		$file_uploads_subcons->Remarks->CellCssStyle = ""; $file_uploads_subcons->Remarks->CellCssClass = "";
		$file_uploads_subcons->Remarks->CellAttrs = array(); $file_uploads_subcons->Remarks->ViewAttrs = array(); $file_uploads_subcons->Remarks->EditAttrs = array();
		if ($file_uploads_subcons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_uploads_subcons->id->ViewValue = $file_uploads_subcons->id->CurrentValue;
			$file_uploads_subcons->id->CssStyle = "";
			$file_uploads_subcons->id->CssClass = "";
			$file_uploads_subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($file_uploads_subcons->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads_subcons->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads_subcons->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$file_uploads_subcons->Subcon_ID->ViewValue = $file_uploads_subcons->Subcon_ID->CurrentValue;
				}
			} else {
				$file_uploads_subcons->Subcon_ID->ViewValue = NULL;
			}
			$file_uploads_subcons->Subcon_ID->CssStyle = "";
			$file_uploads_subcons->Subcon_ID->CssClass = "";
			$file_uploads_subcons->Subcon_ID->ViewCustomAttributes = "";

			// Filename
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->ViewValue = $file_uploads_subcons->Filename->Upload->DbValue;
			} else {
				$file_uploads_subcons->Filename->ViewValue = "";
			}
			$file_uploads_subcons->Filename->CssStyle = "";
			$file_uploads_subcons->Filename->CssClass = "";
			$file_uploads_subcons->Filename->ViewCustomAttributes = "";

			// File_Type_ID
			if (strval($file_uploads_subcons->File_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads_subcons->File_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `File_Type` FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads_subcons->File_Type_ID->ViewValue = $rswrk->fields('File_Type');
					$rswrk->Close();
				} else {
					$file_uploads_subcons->File_Type_ID->ViewValue = $file_uploads_subcons->File_Type_ID->CurrentValue;
				}
			} else {
				$file_uploads_subcons->File_Type_ID->ViewValue = NULL;
			}
			$file_uploads_subcons->File_Type_ID->CssStyle = "";
			$file_uploads_subcons->File_Type_ID->CssClass = "";
			$file_uploads_subcons->File_Type_ID->ViewCustomAttributes = "";

			// Created
			$file_uploads_subcons->Created->ViewValue = $file_uploads_subcons->Created->CurrentValue;
			$file_uploads_subcons->Created->ViewValue = ew_FormatDateTime($file_uploads_subcons->Created->ViewValue, 6);
			$file_uploads_subcons->Created->CssStyle = "";
			$file_uploads_subcons->Created->CssClass = "";
			$file_uploads_subcons->Created->ViewCustomAttributes = "";

			// Modified
			$file_uploads_subcons->Modified->ViewValue = $file_uploads_subcons->Modified->CurrentValue;
			$file_uploads_subcons->Modified->ViewValue = ew_FormatDateTime($file_uploads_subcons->Modified->ViewValue, 6);
			$file_uploads_subcons->Modified->CssStyle = "";
			$file_uploads_subcons->Modified->CssClass = "";
			$file_uploads_subcons->Modified->ViewCustomAttributes = "";

			// Remarks
			$file_uploads_subcons->Remarks->ViewValue = $file_uploads_subcons->Remarks->CurrentValue;
			$file_uploads_subcons->Remarks->CssStyle = "";
			$file_uploads_subcons->Remarks->CssClass = "";
			$file_uploads_subcons->Remarks->ViewCustomAttributes = "";

			// id
			$file_uploads_subcons->id->HrefValue = "";
			$file_uploads_subcons->id->TooltipValue = "";

			// Subcon_ID
			$file_uploads_subcons->Subcon_ID->HrefValue = "";
			$file_uploads_subcons->Subcon_ID->TooltipValue = "";

			// Filename
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads_subcons->Filename->UploadPath) . ((!empty($file_uploads_subcons->Filename->ViewValue)) ? $file_uploads_subcons->Filename->ViewValue : $file_uploads_subcons->Filename->CurrentValue);
				if ($file_uploads_subcons->Export <> "") $file_uploads_subcons->Filename->HrefValue = ew_ConvertFullUrl($file_uploads_subcons->Filename->HrefValue);
			} else {
				$file_uploads_subcons->Filename->HrefValue = "";
			}
			$file_uploads_subcons->Filename->TooltipValue = "";

			// File_Type_ID
			$file_uploads_subcons->File_Type_ID->HrefValue = "";
			$file_uploads_subcons->File_Type_ID->TooltipValue = "";

			// Created
			$file_uploads_subcons->Created->HrefValue = "";
			$file_uploads_subcons->Created->TooltipValue = "";

			// Modified
			$file_uploads_subcons->Modified->HrefValue = "";
			$file_uploads_subcons->Modified->TooltipValue = "";

			// Remarks
			$file_uploads_subcons->Remarks->HrefValue = "";
			$file_uploads_subcons->Remarks->TooltipValue = "";
		} elseif ($file_uploads_subcons->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$file_uploads_subcons->id->EditCustomAttributes = "";
			$file_uploads_subcons->id->EditValue = ew_HtmlEncode($file_uploads_subcons->id->AdvancedSearch->SearchValue);

			// Subcon_ID
			$file_uploads_subcons->Subcon_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Subcon_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$file_uploads_subcons->Subcon_ID->EditValue = $arwrk;

			// Filename
			$file_uploads_subcons->Filename->EditCustomAttributes = "";
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->EditValue = $file_uploads_subcons->Filename->Upload->DbValue;
			} else {
				$file_uploads_subcons->Filename->EditValue = "";
			}

			// File_Type_ID
			$file_uploads_subcons->File_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `File_Type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$file_uploads_subcons->File_Type_ID->EditValue = $arwrk;

			// Created
			$file_uploads_subcons->Created->EditCustomAttributes = "";
			$file_uploads_subcons->Created->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($file_uploads_subcons->Created->AdvancedSearch->SearchValue, 6), 6));

			// Modified
			$file_uploads_subcons->Modified->EditCustomAttributes = "";
			$file_uploads_subcons->Modified->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($file_uploads_subcons->Modified->AdvancedSearch->SearchValue, 6), 6));

			// Remarks
			$file_uploads_subcons->Remarks->EditCustomAttributes = "";
			$file_uploads_subcons->Remarks->EditValue = ew_HtmlEncode($file_uploads_subcons->Remarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($file_uploads_subcons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_uploads_subcons->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $file_uploads_subcons;

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
		global $file_uploads_subcons;
		$file_uploads_subcons->id->AdvancedSearch->SearchValue = $file_uploads_subcons->getAdvancedSearch("x_id");
		$file_uploads_subcons->Subcon_ID->AdvancedSearch->SearchValue = $file_uploads_subcons->getAdvancedSearch("x_Subcon_ID");
		$file_uploads_subcons->File_Type_ID->AdvancedSearch->SearchValue = $file_uploads_subcons->getAdvancedSearch("x_File_Type_ID");
		$file_uploads_subcons->Created->AdvancedSearch->SearchValue = $file_uploads_subcons->getAdvancedSearch("x_Created");
		$file_uploads_subcons->Modified->AdvancedSearch->SearchValue = $file_uploads_subcons->getAdvancedSearch("x_Modified");
		$file_uploads_subcons->Remarks->AdvancedSearch->SearchValue = $file_uploads_subcons->getAdvancedSearch("x_Remarks");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $file_uploads_subcons;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $file_uploads_subcons->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($file_uploads_subcons->ExportAll) {
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
		if ($file_uploads_subcons->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($file_uploads_subcons, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($file_uploads_subcons->id);
				$ExportDoc->ExportCaption($file_uploads_subcons->Subcon_ID);
				$ExportDoc->ExportCaption($file_uploads_subcons->Filename);
				$ExportDoc->ExportCaption($file_uploads_subcons->File_Type_ID);
				$ExportDoc->ExportCaption($file_uploads_subcons->Created);
				$ExportDoc->ExportCaption($file_uploads_subcons->Modified);
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
				$file_uploads_subcons->CssClass = "";
				$file_uploads_subcons->CssStyle = "";
				$file_uploads_subcons->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($file_uploads_subcons->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $file_uploads_subcons->id->ExportValue($file_uploads_subcons->Export, $file_uploads_subcons->ExportOriginalValue));
					$XmlDoc->AddField('Subcon_ID', $file_uploads_subcons->Subcon_ID->ExportValue($file_uploads_subcons->Export, $file_uploads_subcons->ExportOriginalValue));
					$XmlDoc->AddField('Filename', $file_uploads_subcons->Filename->ExportValue($file_uploads_subcons->Export, $file_uploads_subcons->ExportOriginalValue));
					$XmlDoc->AddField('File_Type_ID', $file_uploads_subcons->File_Type_ID->ExportValue($file_uploads_subcons->Export, $file_uploads_subcons->ExportOriginalValue));
					$XmlDoc->AddField('Created', $file_uploads_subcons->Created->ExportValue($file_uploads_subcons->Export, $file_uploads_subcons->ExportOriginalValue));
					$XmlDoc->AddField('Modified', $file_uploads_subcons->Modified->ExportValue($file_uploads_subcons->Export, $file_uploads_subcons->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($file_uploads_subcons->id);
					$ExportDoc->ExportField($file_uploads_subcons->Subcon_ID);
					$ExportDoc->ExportField($file_uploads_subcons->Filename);
					$ExportDoc->ExportField($file_uploads_subcons->File_Type_ID);
					$ExportDoc->ExportField($file_uploads_subcons->Created);
					$ExportDoc->ExportField($file_uploads_subcons->Modified);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($file_uploads_subcons->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($file_uploads_subcons->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($file_uploads_subcons->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($file_uploads_subcons->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($file_uploads_subcons->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $file_uploads_subcons;
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
				$this->sDbMasterFilter = $file_uploads_subcons->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $file_uploads_subcons->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$file_uploads_subcons->Subcon_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$file_uploads_subcons->Subcon_ID->setSessionValue($file_uploads_subcons->Subcon_ID->QueryStringValue);
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
			$file_uploads_subcons->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
			$file_uploads_subcons->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$file_uploads_subcons->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($file_uploads_subcons->Subcon_ID->QueryStringValue == "") $file_uploads_subcons->Subcon_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $file_uploads_subcons->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $file_uploads_subcons->getDetailFilter(); // Restore detail filter
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
