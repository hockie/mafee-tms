<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "employeesinfo.php" ?>
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
$employees_list = new cemployees_list();
$Page =& $employees_list;

// Page init
$employees_list->Page_Init();

// Page main
$employees_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($employees->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var employees_list = new ew_Page("employees_list");

// page properties
employees_list.PageID = "list"; // page ID
employees_list.FormID = "femployeeslist"; // form ID
var EW_PAGE_ID = employees_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
employees_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
employees_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
employees_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
employees_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<?php if ($employees->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$employees_list->lTotalRecs = $employees->SelectRecordCount();
	} else {
		if ($rs = $employees_list->LoadRecordset())
			$employees_list->lTotalRecs = $rs->RecordCount();
	}
	$employees_list->lStartRec = 1;
	if ($employees_list->lDisplayRecs <= 0 || ($employees->Export <> "" && $employees->ExportAll)) // Display all records
		$employees_list->lDisplayRecs = $employees_list->lTotalRecs;
	if (!($employees->Export <> "" && $employees->ExportAll))
		$employees_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $employees_list->LoadRecordset($employees_list->lStartRec-1, $employees_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $employees->TableCaption() ?>
<?php if ($employees->Export == "" && $employees->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $employees_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $employees_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $employees_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($employees->Export == "" && $employees->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(employees_list);" style="text-decoration: none;"><img id="employees_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="employees_list_SearchPanel">
<form name="femployeeslistsrch" id="femployeeslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="employees">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($employees->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $employees_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($employees->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($employees->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($employees->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$employees_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($employees->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($employees->CurrentAction <> "gridadd" && $employees->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($employees_list->Pager)) $employees_list->Pager = new cPrevNextPager($employees_list->lStartRec, $employees_list->lDisplayRecs, $employees_list->lTotalRecs) ?>
<?php if ($employees_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($employees_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $employees_list->PageUrl() ?>start=<?php echo $employees_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($employees_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $employees_list->PageUrl() ?>start=<?php echo $employees_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $employees_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($employees_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $employees_list->PageUrl() ?>start=<?php echo $employees_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($employees_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $employees_list->PageUrl() ?>start=<?php echo $employees_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $employees_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $employees_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $employees_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($employees_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($employees_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="employees">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($employees_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($employees_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($employees_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($employees_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($employees_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($employees_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($employees->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $employees_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($employees_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.femployeeslist, '<?php echo $employees_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="femployeeslist" id="femployeeslist" class="ewForm" action="" method="post">
<div id="gmp_employees" class="ewGridMiddlePanel">
<?php if ($employees_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $employees->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$employees_list->RenderListOptions();

// Render list options (header, left)
$employees_list->ListOptions->Render("header", "left");
?>
<?php if ($employees->id->Visible) { // id ?>
	<?php if ($employees->SortUrl($employees->id) == "") { ?>
		<td><?php echo $employees->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($employees->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employees->SortUrl($employees->EmployeeID) == "") { ?>
		<td><?php echo $employees->EmployeeID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->EmployeeID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->EmployeeID->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->EmployeeID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->EmployeeID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->FirstName->Visible) { // FirstName ?>
	<?php if ($employees->SortUrl($employees->FirstName) == "") { ?>
		<td><?php echo $employees->FirstName->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->FirstName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->FirstName->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->FirstName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->FirstName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->MiddleName->Visible) { // MiddleName ?>
	<?php if ($employees->SortUrl($employees->MiddleName) == "") { ?>
		<td><?php echo $employees->MiddleName->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->MiddleName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->MiddleName->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->MiddleName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->MiddleName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->LastName->Visible) { // LastName ?>
	<?php if ($employees->SortUrl($employees->LastName) == "") { ?>
		<td><?php echo $employees->LastName->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->LastName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->LastName->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->LastName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->LastName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->Username->Visible) { // Username ?>
	<?php if ($employees->SortUrl($employees->Username) == "") { ?>
		<td><?php echo $employees->Username->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->Username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->Username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->Username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->Username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->EmailAddress->Visible) { // EmailAddress ?>
	<?php if ($employees->SortUrl($employees->EmailAddress) == "") { ?>
		<td><?php echo $employees->EmailAddress->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->EmailAddress) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->EmailAddress->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->EmailAddress->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->EmailAddress->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->Address->Visible) { // Address ?>
	<?php if ($employees->SortUrl($employees->Address) == "") { ?>
		<td><?php echo $employees->Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->MobileNumber->Visible) { // MobileNumber ?>
	<?php if ($employees->SortUrl($employees->MobileNumber) == "") { ?>
		<td><?php echo $employees->MobileNumber->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->MobileNumber) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->MobileNumber->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->MobileNumber->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->MobileNumber->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->SubconID->Visible) { // SubconID ?>
	<?php if ($employees->SortUrl($employees->SubconID) == "") { ?>
		<td><?php echo $employees->SubconID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->SubconID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->SubconID->FldCaption() ?></td><td style="width: 10px;"><?php if ($employees->SubconID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->SubconID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->manager->Visible) { // manager ?>
	<?php if ($employees->SortUrl($employees->manager) == "") { ?>
		<td><?php echo $employees->manager->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->manager) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->manager->FldCaption() ?></td><td style="width: 10px;"><?php if ($employees->manager->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->manager->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->Designation->Visible) { // Designation ?>
	<?php if ($employees->SortUrl($employees->Designation) == "") { ?>
		<td><?php echo $employees->Designation->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->Designation) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->Designation->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->Designation->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->Designation->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->EmpRateId->Visible) { // EmpRateId ?>
	<?php if ($employees->SortUrl($employees->EmpRateId) == "") { ?>
		<td><?php echo $employees->EmpRateId->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->EmpRateId) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->EmpRateId->FldCaption() ?></td><td style="width: 10px;"><?php if ($employees->EmpRateId->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->EmpRateId->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->DateHired->Visible) { // DateHired ?>
	<?php if ($employees->SortUrl($employees->DateHired) == "") { ?>
		<td><?php echo $employees->DateHired->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->DateHired) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->DateHired->FldCaption() ?></td><td style="width: 10px;"><?php if ($employees->DateHired->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->DateHired->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->DateTerminated->Visible) { // DateTerminated ?>
	<?php if ($employees->SortUrl($employees->DateTerminated) == "") { ?>
		<td><?php echo $employees->DateTerminated->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->DateTerminated) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->DateTerminated->FldCaption() ?></td><td style="width: 10px;"><?php if ($employees->DateTerminated->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->DateTerminated->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->EmpStatusId->Visible) { // EmpStatusId ?>
	<?php if ($employees->SortUrl($employees->EmpStatusId) == "") { ?>
		<td><?php echo $employees->EmpStatusId->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->EmpStatusId) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->EmpStatusId->FldCaption() ?></td><td style="width: 10px;"><?php if ($employees->EmpStatusId->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->EmpStatusId->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($employees->Password->Visible) { // Password ?>
	<?php if ($employees->SortUrl($employees->Password) == "") { ?>
		<td><?php echo $employees->Password->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $employees->SortUrl($employees->Password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $employees->Password->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($employees->Password->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($employees->Password->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$employees_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($employees->ExportAll && $employees->Export <> "") {
	$employees_list->lStopRec = $employees_list->lTotalRecs;
} else {
	$employees_list->lStopRec = $employees_list->lStartRec + $employees_list->lDisplayRecs - 1; // Set the last record to display
}
$employees_list->lRecCount = $employees_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $employees_list->lStartRec > 1)
		$rs->Move($employees_list->lStartRec - 1);
}

// Initialize aggregate
$employees->RowType = EW_ROWTYPE_AGGREGATEINIT;
$employees_list->RenderRow();
$employees_list->lRowCnt = 0;
while (($employees->CurrentAction == "gridadd" || !$rs->EOF) &&
	$employees_list->lRecCount < $employees_list->lStopRec) {
	$employees_list->lRecCount++;
	if (intval($employees_list->lRecCount) >= intval($employees_list->lStartRec)) {
		$employees_list->lRowCnt++;

	// Init row class and style
	$employees->CssClass = "";
	$employees->CssStyle = "";
	$employees->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($employees->CurrentAction == "gridadd") {
		$employees_list->LoadDefaultValues(); // Load default values
	} else {
		$employees_list->LoadRowValues($rs); // Load row values
	}
	$employees->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$employees_list->RenderRow();

	// Render list options
	$employees_list->RenderListOptions();
?>
	<tr<?php echo $employees->RowAttributes() ?>>
<?php

// Render list options (body, left)
$employees_list->ListOptions->Render("body", "left");
?>
	<?php if ($employees->id->Visible) { // id ?>
		<td<?php echo $employees->id->CellAttributes() ?>>
<div<?php echo $employees->id->ViewAttributes() ?>><?php echo $employees->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
		<td<?php echo $employees->EmployeeID->CellAttributes() ?>>
<div<?php echo $employees->EmployeeID->ViewAttributes() ?>><?php echo $employees->EmployeeID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->FirstName->Visible) { // FirstName ?>
		<td<?php echo $employees->FirstName->CellAttributes() ?>>
<div<?php echo $employees->FirstName->ViewAttributes() ?>><?php echo $employees->FirstName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->MiddleName->Visible) { // MiddleName ?>
		<td<?php echo $employees->MiddleName->CellAttributes() ?>>
<div<?php echo $employees->MiddleName->ViewAttributes() ?>><?php echo $employees->MiddleName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->LastName->Visible) { // LastName ?>
		<td<?php echo $employees->LastName->CellAttributes() ?>>
<div<?php echo $employees->LastName->ViewAttributes() ?>><?php echo $employees->LastName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->Username->Visible) { // Username ?>
		<td<?php echo $employees->Username->CellAttributes() ?>>
<div<?php echo $employees->Username->ViewAttributes() ?>><?php echo $employees->Username->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->EmailAddress->Visible) { // EmailAddress ?>
		<td<?php echo $employees->EmailAddress->CellAttributes() ?>>
<div<?php echo $employees->EmailAddress->ViewAttributes() ?>><?php echo $employees->EmailAddress->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->Address->Visible) { // Address ?>
		<td<?php echo $employees->Address->CellAttributes() ?>>
<div<?php echo $employees->Address->ViewAttributes() ?>><?php echo $employees->Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->MobileNumber->Visible) { // MobileNumber ?>
		<td<?php echo $employees->MobileNumber->CellAttributes() ?>>
<div<?php echo $employees->MobileNumber->ViewAttributes() ?>><?php echo $employees->MobileNumber->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->SubconID->Visible) { // SubconID ?>
		<td<?php echo $employees->SubconID->CellAttributes() ?>>
<div<?php echo $employees->SubconID->ViewAttributes() ?>><?php echo $employees->SubconID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->manager->Visible) { // manager ?>
		<td<?php echo $employees->manager->CellAttributes() ?>>
<div<?php echo $employees->manager->ViewAttributes() ?>><?php echo $employees->manager->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->Designation->Visible) { // Designation ?>
		<td<?php echo $employees->Designation->CellAttributes() ?>>
<div<?php echo $employees->Designation->ViewAttributes() ?>><?php echo $employees->Designation->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->EmpRateId->Visible) { // EmpRateId ?>
		<td<?php echo $employees->EmpRateId->CellAttributes() ?>>
<div<?php echo $employees->EmpRateId->ViewAttributes() ?>><?php echo $employees->EmpRateId->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->DateHired->Visible) { // DateHired ?>
		<td<?php echo $employees->DateHired->CellAttributes() ?>>
<div<?php echo $employees->DateHired->ViewAttributes() ?>><?php echo $employees->DateHired->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->DateTerminated->Visible) { // DateTerminated ?>
		<td<?php echo $employees->DateTerminated->CellAttributes() ?>>
<div<?php echo $employees->DateTerminated->ViewAttributes() ?>><?php echo $employees->DateTerminated->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->EmpStatusId->Visible) { // EmpStatusId ?>
		<td<?php echo $employees->EmpStatusId->CellAttributes() ?>>
<div<?php echo $employees->EmpStatusId->ViewAttributes() ?>><?php echo $employees->EmpStatusId->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($employees->Password->Visible) { // Password ?>
		<td<?php echo $employees->Password->CellAttributes() ?>>
<div<?php echo $employees->Password->ViewAttributes() ?>><?php echo $employees->Password->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employees_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($employees->CurrentAction <> "gridadd")
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
<?php if ($employees_list->lTotalRecs > 0) { ?>
<?php if ($employees->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($employees->CurrentAction <> "gridadd" && $employees->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($employees_list->Pager)) $employees_list->Pager = new cPrevNextPager($employees_list->lStartRec, $employees_list->lDisplayRecs, $employees_list->lTotalRecs) ?>
<?php if ($employees_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($employees_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $employees_list->PageUrl() ?>start=<?php echo $employees_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($employees_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $employees_list->PageUrl() ?>start=<?php echo $employees_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $employees_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($employees_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $employees_list->PageUrl() ?>start=<?php echo $employees_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($employees_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $employees_list->PageUrl() ?>start=<?php echo $employees_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $employees_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $employees_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $employees_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $employees_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($employees_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($employees_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="employees">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($employees_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($employees_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($employees_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($employees_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($employees_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($employees_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($employees->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($employees_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $employees_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($employees_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.femployeeslist, '<?php echo $employees_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($employees->Export == "" && $employees->CurrentAction == "") { ?>
<?php } ?>
<?php if ($employees->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$employees_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cemployees_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'employees';

	// Page object name
	var $PageObjName = 'employees_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $employees;
		if ($employees->UseTokenInUrl) $PageUrl .= "t=" . $employees->TableVar . "&"; // Add page token
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
		global $objForm, $employees;
		if ($employees->UseTokenInUrl) {
			if ($objForm)
				return ($employees->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($employees->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cemployees_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (employees)
		$GLOBALS["employees"] = new cemployees();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["employees"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "employeesdelete.php";
		$this->MultiUpdateUrl = "employeesupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'employees', TRUE);

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
		global $employees;

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
			$employees->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$employees->Export = $_POST["exporttype"];
		} else {
			$employees->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $employees->Export; // Get export parameter, used in header
		$gsExportFile = $employees->TableVar; // Get export file, used in header
		if ($employees->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $employees;

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
			$employees->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($employees->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $employees->getRecordsPerPage(); // Restore from Session
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
		$employees->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$employees->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$employees->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $employees->getSearchWhere();
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
		$employees->setSessionWhere($sFilter);
		$employees->CurrentFilter = "";

		// Export data only
		if (in_array($employees->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($employees->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $employees;
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
			$employees->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$employees->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $employees;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $employees->EmployeeID, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->FirstName, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->MiddleName, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->LastName, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->Username, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->EmailAddress, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->MobileNumber, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->Designation, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->Remarks, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $employees->Password, $Keyword);
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
		global $Security, $employees;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $employees->BasicSearchKeyword;
		$sSearchType = $employees->BasicSearchType;
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
			$employees->setSessionBasicSearchKeyword($sSearchKeyword);
			$employees->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $employees;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$employees->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $employees;
		$employees->setSessionBasicSearchKeyword("");
		$employees->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $employees;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$employees->BasicSearchKeyword = $employees->getSessionBasicSearchKeyword();
			$employees->BasicSearchType = $employees->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $employees;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$employees->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$employees->CurrentOrderType = @$_GET["ordertype"];
			$employees->UpdateSort($employees->id); // id
			$employees->UpdateSort($employees->EmployeeID); // EmployeeID
			$employees->UpdateSort($employees->FirstName); // FirstName
			$employees->UpdateSort($employees->MiddleName); // MiddleName
			$employees->UpdateSort($employees->LastName); // LastName
			$employees->UpdateSort($employees->Username); // Username
			$employees->UpdateSort($employees->EmailAddress); // EmailAddress
			$employees->UpdateSort($employees->Address); // Address
			$employees->UpdateSort($employees->MobileNumber); // MobileNumber
			$employees->UpdateSort($employees->SubconID); // SubconID
			$employees->UpdateSort($employees->manager); // manager
			$employees->UpdateSort($employees->Designation); // Designation
			$employees->UpdateSort($employees->EmpRateId); // EmpRateId
			$employees->UpdateSort($employees->DateHired); // DateHired
			$employees->UpdateSort($employees->DateTerminated); // DateTerminated
			$employees->UpdateSort($employees->EmpStatusId); // EmpStatusId
			$employees->UpdateSort($employees->Password); // Password
			$employees->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $employees;
		$sOrderBy = $employees->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($employees->SqlOrderBy() <> "") {
				$sOrderBy = $employees->SqlOrderBy();
				$employees->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $employees;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$employees->setSessionOrderBy($sOrderBy);
				$employees->id->setSort("");
				$employees->EmployeeID->setSort("");
				$employees->FirstName->setSort("");
				$employees->MiddleName->setSort("");
				$employees->LastName->setSort("");
				$employees->Username->setSort("");
				$employees->EmailAddress->setSort("");
				$employees->Address->setSort("");
				$employees->MobileNumber->setSort("");
				$employees->SubconID->setSort("");
				$employees->manager->setSort("");
				$employees->Designation->setSort("");
				$employees->EmpRateId->setSort("");
				$employees->DateHired->setSort("");
				$employees->DateTerminated->setSort("");
				$employees->EmpStatusId->setSort("");
				$employees->Password->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$employees->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $employees;

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

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"employees_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($employees->Export <> "" ||
			$employees->CurrentAction == "gridadd" ||
			$employees->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $employees;
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

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($employees->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $employees;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $employees;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$employees->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$employees->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $employees->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$employees->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$employees->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$employees->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $employees;
		$employees->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$employees->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $employees;

		// Call Recordset Selecting event
		$employees->Recordset_Selecting($employees->CurrentFilter);

		// Load List page SQL
		$sSql = $employees->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$employees->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $employees;
		$sFilter = $employees->KeyFilter();

		// Call Row Selecting event
		$employees->Row_Selecting($sFilter);

		// Load SQL based on filter
		$employees->CurrentFilter = $sFilter;
		$sSql = $employees->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$employees->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $employees;
		$employees->id->setDbValue($rs->fields('id'));
		$employees->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$employees->FirstName->setDbValue($rs->fields('FirstName'));
		$employees->MiddleName->setDbValue($rs->fields('MiddleName'));
		$employees->LastName->setDbValue($rs->fields('LastName'));
		$employees->Username->setDbValue($rs->fields('Username'));
		$employees->EmailAddress->setDbValue($rs->fields('EmailAddress'));
		$employees->Address->setDbValue($rs->fields('Address'));
		$employees->MobileNumber->setDbValue($rs->fields('MobileNumber'));
		$employees->SubconID->setDbValue($rs->fields('SubconID'));
		$employees->manager->setDbValue($rs->fields('manager'));
		$employees->Designation->setDbValue($rs->fields('Designation'));
		$employees->EmpRateId->setDbValue($rs->fields('EmpRateId'));
		$employees->DateHired->setDbValue($rs->fields('DateHired'));
		$employees->DateTerminated->setDbValue($rs->fields('DateTerminated'));
		$employees->EmpStatusId->setDbValue($rs->fields('EmpStatusId'));
		$employees->Remarks->setDbValue($rs->fields('Remarks'));
		$employees->Password->setDbValue($rs->fields('Password'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $employees;

		// Initialize URLs
		$this->ViewUrl = $employees->ViewUrl();
		$this->EditUrl = $employees->EditUrl();
		$this->InlineEditUrl = $employees->InlineEditUrl();
		$this->CopyUrl = $employees->CopyUrl();
		$this->InlineCopyUrl = $employees->InlineCopyUrl();
		$this->DeleteUrl = $employees->DeleteUrl();

		// Call Row_Rendering event
		$employees->Row_Rendering();

		// Common render codes for all row types
		// id

		$employees->id->CellCssStyle = ""; $employees->id->CellCssClass = "";
		$employees->id->CellAttrs = array(); $employees->id->ViewAttrs = array(); $employees->id->EditAttrs = array();

		// EmployeeID
		$employees->EmployeeID->CellCssStyle = ""; $employees->EmployeeID->CellCssClass = "";
		$employees->EmployeeID->CellAttrs = array(); $employees->EmployeeID->ViewAttrs = array(); $employees->EmployeeID->EditAttrs = array();

		// FirstName
		$employees->FirstName->CellCssStyle = ""; $employees->FirstName->CellCssClass = "";
		$employees->FirstName->CellAttrs = array(); $employees->FirstName->ViewAttrs = array(); $employees->FirstName->EditAttrs = array();

		// MiddleName
		$employees->MiddleName->CellCssStyle = ""; $employees->MiddleName->CellCssClass = "";
		$employees->MiddleName->CellAttrs = array(); $employees->MiddleName->ViewAttrs = array(); $employees->MiddleName->EditAttrs = array();

		// LastName
		$employees->LastName->CellCssStyle = ""; $employees->LastName->CellCssClass = "";
		$employees->LastName->CellAttrs = array(); $employees->LastName->ViewAttrs = array(); $employees->LastName->EditAttrs = array();

		// Username
		$employees->Username->CellCssStyle = ""; $employees->Username->CellCssClass = "";
		$employees->Username->CellAttrs = array(); $employees->Username->ViewAttrs = array(); $employees->Username->EditAttrs = array();

		// EmailAddress
		$employees->EmailAddress->CellCssStyle = ""; $employees->EmailAddress->CellCssClass = "";
		$employees->EmailAddress->CellAttrs = array(); $employees->EmailAddress->ViewAttrs = array(); $employees->EmailAddress->EditAttrs = array();

		// Address
		$employees->Address->CellCssStyle = ""; $employees->Address->CellCssClass = "";
		$employees->Address->CellAttrs = array(); $employees->Address->ViewAttrs = array(); $employees->Address->EditAttrs = array();

		// MobileNumber
		$employees->MobileNumber->CellCssStyle = ""; $employees->MobileNumber->CellCssClass = "";
		$employees->MobileNumber->CellAttrs = array(); $employees->MobileNumber->ViewAttrs = array(); $employees->MobileNumber->EditAttrs = array();

		// SubconID
		$employees->SubconID->CellCssStyle = ""; $employees->SubconID->CellCssClass = "";
		$employees->SubconID->CellAttrs = array(); $employees->SubconID->ViewAttrs = array(); $employees->SubconID->EditAttrs = array();

		// manager
		$employees->manager->CellCssStyle = ""; $employees->manager->CellCssClass = "";
		$employees->manager->CellAttrs = array(); $employees->manager->ViewAttrs = array(); $employees->manager->EditAttrs = array();

		// Designation
		$employees->Designation->CellCssStyle = ""; $employees->Designation->CellCssClass = "";
		$employees->Designation->CellAttrs = array(); $employees->Designation->ViewAttrs = array(); $employees->Designation->EditAttrs = array();

		// EmpRateId
		$employees->EmpRateId->CellCssStyle = ""; $employees->EmpRateId->CellCssClass = "";
		$employees->EmpRateId->CellAttrs = array(); $employees->EmpRateId->ViewAttrs = array(); $employees->EmpRateId->EditAttrs = array();

		// DateHired
		$employees->DateHired->CellCssStyle = ""; $employees->DateHired->CellCssClass = "";
		$employees->DateHired->CellAttrs = array(); $employees->DateHired->ViewAttrs = array(); $employees->DateHired->EditAttrs = array();

		// DateTerminated
		$employees->DateTerminated->CellCssStyle = ""; $employees->DateTerminated->CellCssClass = "";
		$employees->DateTerminated->CellAttrs = array(); $employees->DateTerminated->ViewAttrs = array(); $employees->DateTerminated->EditAttrs = array();

		// EmpStatusId
		$employees->EmpStatusId->CellCssStyle = ""; $employees->EmpStatusId->CellCssClass = "";
		$employees->EmpStatusId->CellAttrs = array(); $employees->EmpStatusId->ViewAttrs = array(); $employees->EmpStatusId->EditAttrs = array();

		// Password
		$employees->Password->CellCssStyle = ""; $employees->Password->CellCssClass = "";
		$employees->Password->CellAttrs = array(); $employees->Password->ViewAttrs = array(); $employees->Password->EditAttrs = array();
		if ($employees->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$employees->id->ViewValue = $employees->id->CurrentValue;
			$employees->id->CssStyle = "";
			$employees->id->CssClass = "";
			$employees->id->ViewCustomAttributes = "";

			// EmployeeID
			$employees->EmployeeID->ViewValue = $employees->EmployeeID->CurrentValue;
			$employees->EmployeeID->CssStyle = "";
			$employees->EmployeeID->CssClass = "";
			$employees->EmployeeID->ViewCustomAttributes = "";

			// FirstName
			$employees->FirstName->ViewValue = $employees->FirstName->CurrentValue;
			$employees->FirstName->CssStyle = "";
			$employees->FirstName->CssClass = "";
			$employees->FirstName->ViewCustomAttributes = "";

			// MiddleName
			$employees->MiddleName->ViewValue = $employees->MiddleName->CurrentValue;
			$employees->MiddleName->CssStyle = "";
			$employees->MiddleName->CssClass = "";
			$employees->MiddleName->ViewCustomAttributes = "";

			// LastName
			$employees->LastName->ViewValue = $employees->LastName->CurrentValue;
			$employees->LastName->CssStyle = "";
			$employees->LastName->CssClass = "";
			$employees->LastName->ViewCustomAttributes = "";

			// Username
			$employees->Username->ViewValue = $employees->Username->CurrentValue;
			$employees->Username->CssStyle = "";
			$employees->Username->CssClass = "";
			$employees->Username->ViewCustomAttributes = "";

			// EmailAddress
			$employees->EmailAddress->ViewValue = $employees->EmailAddress->CurrentValue;
			$employees->EmailAddress->CssStyle = "";
			$employees->EmailAddress->CssClass = "";
			$employees->EmailAddress->ViewCustomAttributes = "";

			// Address
			$employees->Address->ViewValue = $employees->Address->CurrentValue;
			$employees->Address->CssStyle = "";
			$employees->Address->CssClass = "";
			$employees->Address->ViewCustomAttributes = "";

			// MobileNumber
			$employees->MobileNumber->ViewValue = $employees->MobileNumber->CurrentValue;
			$employees->MobileNumber->CssStyle = "";
			$employees->MobileNumber->CssClass = "";
			$employees->MobileNumber->ViewCustomAttributes = "";

			// SubconID
			if (strval($employees->SubconID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($employees->SubconID->CurrentValue) . "";
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
					$employees->SubconID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$employees->SubconID->ViewValue = $employees->SubconID->CurrentValue;
				}
			} else {
				$employees->SubconID->ViewValue = NULL;
			}
			$employees->SubconID->CssStyle = "";
			$employees->SubconID->CssClass = "";
			$employees->SubconID->ViewCustomAttributes = "";

			// manager
			if (strval($employees->manager->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($employees->manager->CurrentValue) . "";
			$sSqlWrk = "SELECT `LastName`, `FirstName` FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `LastName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$employees->manager->ViewValue = $rswrk->fields('LastName');
					$employees->manager->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('FirstName');
					$rswrk->Close();
				} else {
					$employees->manager->ViewValue = $employees->manager->CurrentValue;
				}
			} else {
				$employees->manager->ViewValue = NULL;
			}
			$employees->manager->CssStyle = "";
			$employees->manager->CssClass = "";
			$employees->manager->ViewCustomAttributes = "";

			// Designation
			$employees->Designation->ViewValue = $employees->Designation->CurrentValue;
			$employees->Designation->CssStyle = "";
			$employees->Designation->CssClass = "";
			$employees->Designation->ViewCustomAttributes = "";

			// EmpRateId
			$employees->EmpRateId->ViewValue = $employees->EmpRateId->CurrentValue;
			$employees->EmpRateId->CssStyle = "";
			$employees->EmpRateId->CssClass = "";
			$employees->EmpRateId->ViewCustomAttributes = "";

			// DateHired
			$employees->DateHired->ViewValue = $employees->DateHired->CurrentValue;
			$employees->DateHired->ViewValue = ew_FormatDateTime($employees->DateHired->ViewValue, 6);
			$employees->DateHired->CssStyle = "";
			$employees->DateHired->CssClass = "";
			$employees->DateHired->ViewCustomAttributes = "";

			// DateTerminated
			$employees->DateTerminated->ViewValue = $employees->DateTerminated->CurrentValue;
			$employees->DateTerminated->ViewValue = ew_FormatDateTime($employees->DateTerminated->ViewValue, 6);
			$employees->DateTerminated->CssStyle = "";
			$employees->DateTerminated->CssClass = "";
			$employees->DateTerminated->ViewCustomAttributes = "";

			// EmpStatusId
			if (strval($employees->EmpStatusId->CurrentValue) <> "") {
				switch ($employees->EmpStatusId->CurrentValue) {
					case "regular":
						$employees->EmpStatusId->ViewValue = "Regular";
						break;
					case "contractual":
						$employees->EmpStatusId->ViewValue = "Contractual";
						break;
					default:
						$employees->EmpStatusId->ViewValue = $employees->EmpStatusId->CurrentValue;
				}
			} else {
				$employees->EmpStatusId->ViewValue = NULL;
			}
			$employees->EmpStatusId->CssStyle = "";
			$employees->EmpStatusId->CssClass = "";
			$employees->EmpStatusId->ViewCustomAttributes = "";

			// Password
			$employees->Password->ViewValue = $employees->Password->CurrentValue;
			$employees->Password->CssStyle = "";
			$employees->Password->CssClass = "";
			$employees->Password->ViewCustomAttributes = "";

			// id
			$employees->id->HrefValue = "";
			$employees->id->TooltipValue = "";

			// EmployeeID
			$employees->EmployeeID->HrefValue = "";
			$employees->EmployeeID->TooltipValue = "";

			// FirstName
			$employees->FirstName->HrefValue = "";
			$employees->FirstName->TooltipValue = "";

			// MiddleName
			$employees->MiddleName->HrefValue = "";
			$employees->MiddleName->TooltipValue = "";

			// LastName
			$employees->LastName->HrefValue = "";
			$employees->LastName->TooltipValue = "";

			// Username
			$employees->Username->HrefValue = "";
			$employees->Username->TooltipValue = "";

			// EmailAddress
			$employees->EmailAddress->HrefValue = "";
			$employees->EmailAddress->TooltipValue = "";

			// Address
			$employees->Address->HrefValue = "";
			$employees->Address->TooltipValue = "";

			// MobileNumber
			$employees->MobileNumber->HrefValue = "";
			$employees->MobileNumber->TooltipValue = "";

			// SubconID
			$employees->SubconID->HrefValue = "";
			$employees->SubconID->TooltipValue = "";

			// manager
			$employees->manager->HrefValue = "";
			$employees->manager->TooltipValue = "";

			// Designation
			$employees->Designation->HrefValue = "";
			$employees->Designation->TooltipValue = "";

			// EmpRateId
			$employees->EmpRateId->HrefValue = "";
			$employees->EmpRateId->TooltipValue = "";

			// DateHired
			$employees->DateHired->HrefValue = "";
			$employees->DateHired->TooltipValue = "";

			// DateTerminated
			$employees->DateTerminated->HrefValue = "";
			$employees->DateTerminated->TooltipValue = "";

			// EmpStatusId
			$employees->EmpStatusId->HrefValue = "";
			$employees->EmpStatusId->TooltipValue = "";

			// Password
			$employees->Password->HrefValue = "";
			$employees->Password->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($employees->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$employees->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $employees;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $employees->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($employees->ExportAll) {
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
		if ($employees->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($employees, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($employees->id);
				$ExportDoc->ExportCaption($employees->EmployeeID);
				$ExportDoc->ExportCaption($employees->FirstName);
				$ExportDoc->ExportCaption($employees->MiddleName);
				$ExportDoc->ExportCaption($employees->LastName);
				$ExportDoc->ExportCaption($employees->Username);
				$ExportDoc->ExportCaption($employees->EmailAddress);
				$ExportDoc->ExportCaption($employees->Address);
				$ExportDoc->ExportCaption($employees->MobileNumber);
				$ExportDoc->ExportCaption($employees->SubconID);
				$ExportDoc->ExportCaption($employees->manager);
				$ExportDoc->ExportCaption($employees->Designation);
				$ExportDoc->ExportCaption($employees->EmpRateId);
				$ExportDoc->ExportCaption($employees->DateHired);
				$ExportDoc->ExportCaption($employees->DateTerminated);
				$ExportDoc->ExportCaption($employees->EmpStatusId);
				$ExportDoc->ExportCaption($employees->Password);
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
				$employees->CssClass = "";
				$employees->CssStyle = "";
				$employees->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($employees->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $employees->id->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('EmployeeID', $employees->EmployeeID->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('FirstName', $employees->FirstName->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('MiddleName', $employees->MiddleName->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('LastName', $employees->LastName->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('Username', $employees->Username->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('EmailAddress', $employees->EmailAddress->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('Address', $employees->Address->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('MobileNumber', $employees->MobileNumber->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('SubconID', $employees->SubconID->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('manager', $employees->manager->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('Designation', $employees->Designation->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('EmpRateId', $employees->EmpRateId->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('DateHired', $employees->DateHired->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('DateTerminated', $employees->DateTerminated->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('EmpStatusId', $employees->EmpStatusId->ExportValue($employees->Export, $employees->ExportOriginalValue));
					$XmlDoc->AddField('Password', $employees->Password->ExportValue($employees->Export, $employees->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($employees->id);
					$ExportDoc->ExportField($employees->EmployeeID);
					$ExportDoc->ExportField($employees->FirstName);
					$ExportDoc->ExportField($employees->MiddleName);
					$ExportDoc->ExportField($employees->LastName);
					$ExportDoc->ExportField($employees->Username);
					$ExportDoc->ExportField($employees->EmailAddress);
					$ExportDoc->ExportField($employees->Address);
					$ExportDoc->ExportField($employees->MobileNumber);
					$ExportDoc->ExportField($employees->SubconID);
					$ExportDoc->ExportField($employees->manager);
					$ExportDoc->ExportField($employees->Designation);
					$ExportDoc->ExportField($employees->EmpRateId);
					$ExportDoc->ExportField($employees->DateHired);
					$ExportDoc->ExportField($employees->DateTerminated);
					$ExportDoc->ExportField($employees->EmpStatusId);
					$ExportDoc->ExportField($employees->Password);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($employees->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($employees->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($employees->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($employees->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($employees->ExportReturnUrl());
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
