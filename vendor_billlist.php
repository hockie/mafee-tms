<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "vendor_billinfo.php" ?>
<?php include "subconsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "vendor_bill_itemsinfo.php" ?>
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
$vendor_bill_list = new cvendor_bill_list();
$Page =& $vendor_bill_list;

// Page init
$vendor_bill_list->Page_Init();

// Page main
$vendor_bill_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($vendor_bill->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var vendor_bill_list = new ew_Page("vendor_bill_list");

// page properties
vendor_bill_list.PageID = "list"; // page ID
vendor_bill_list.FormID = "fvendor_billlist"; // form ID
var EW_PAGE_ID = vendor_bill_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
vendor_bill_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
vendor_bill_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
vendor_bill_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
vendor_bill_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($vendor_bill->Export == "") { ?>
<?php
$gsMasterReturnUrl = "subconslist.php";
if ($vendor_bill_list->sDbMasterFilter <> "" && $vendor_bill->getCurrentMasterTable() == "subcons") {
	if ($vendor_bill_list->bMasterRecordExists) {
		if ($vendor_bill->getCurrentMasterTable() == $vendor_bill->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$vendor_bill_list->lTotalRecs = $vendor_bill->SelectRecordCount();
	} else {
		if ($rs = $vendor_bill_list->LoadRecordset())
			$vendor_bill_list->lTotalRecs = $rs->RecordCount();
	}
	$vendor_bill_list->lStartRec = 1;
	if ($vendor_bill_list->lDisplayRecs <= 0 || ($vendor_bill->Export <> "" && $vendor_bill->ExportAll)) // Display all records
		$vendor_bill_list->lDisplayRecs = $vendor_bill_list->lTotalRecs;
	if (!($vendor_bill->Export <> "" && $vendor_bill->ExportAll))
		$vendor_bill_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $vendor_bill_list->LoadRecordset($vendor_bill_list->lStartRec-1, $vendor_bill_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $vendor_bill->TableCaption() ?>
<?php if ($vendor_bill->Export == "" && $vendor_bill->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $vendor_bill_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $vendor_bill_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $vendor_bill_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($vendor_bill->Export == "" && $vendor_bill->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(vendor_bill_list);" style="text-decoration: none;"><img id="vendor_bill_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="vendor_bill_list_SearchPanel">
<form name="fvendor_billlistsrch" id="fvendor_billlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="vendor_bill">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($vendor_bill->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $vendor_bill_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($vendor_bill->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($vendor_bill->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($vendor_bill->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$vendor_bill_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($vendor_bill->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($vendor_bill->CurrentAction <> "gridadd" && $vendor_bill->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($vendor_bill_list->Pager)) $vendor_bill_list->Pager = new cPrevNextPager($vendor_bill_list->lStartRec, $vendor_bill_list->lDisplayRecs, $vendor_bill_list->lTotalRecs) ?>
<?php if ($vendor_bill_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($vendor_bill_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_list->PageUrl() ?>start=<?php echo $vendor_bill_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($vendor_bill_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_list->PageUrl() ?>start=<?php echo $vendor_bill_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $vendor_bill_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($vendor_bill_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_list->PageUrl() ?>start=<?php echo $vendor_bill_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($vendor_bill_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_list->PageUrl() ?>start=<?php echo $vendor_bill_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vendor_bill_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vendor_bill_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vendor_bill_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vendor_bill_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($vendor_bill_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($vendor_bill_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="vendor_bill">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($vendor_bill_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($vendor_bill_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($vendor_bill_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($vendor_bill_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($vendor_bill_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($vendor_bill_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($vendor_bill->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $vendor_bill_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($vendor_bill_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fvendor_billlist, '<?php echo $vendor_bill_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fvendor_billlist" id="fvendor_billlist" class="ewForm" action="" method="post">
<div id="gmp_vendor_bill" class="ewGridMiddlePanel">
<?php if ($vendor_bill_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $vendor_bill->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$vendor_bill_list->RenderListOptions();

// Render list options (header, left)
$vendor_bill_list->ListOptions->Render("header", "left");
?>
<?php if ($vendor_bill->id->Visible) { // id ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->id) == "") { ?>
		<td><?php echo $vendor_bill->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->vendor_ID->Visible) { // vendor_ID ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->vendor_ID) == "") { ?>
		<td><?php echo $vendor_bill->vendor_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->vendor_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->vendor_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->vendor_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->vendor_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->vendor_Number->Visible) { // vendor_Number ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->vendor_Number) == "") { ?>
		<td><?php echo $vendor_bill->vendor_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->vendor_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->vendor_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($vendor_bill->vendor_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->vendor_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->Billing_Date->Visible) { // Billing_Date ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->Billing_Date) == "") { ?>
		<td><?php echo $vendor_bill->Billing_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->Billing_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->Billing_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->Billing_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->Billing_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->Due_Date->Visible) { // Due_Date ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->Due_Date) == "") { ?>
		<td><?php echo $vendor_bill->Due_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->Due_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->Due_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->Due_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->Due_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->Total_Amount_Due) == "") { ?>
		<td><?php echo $vendor_bill->Total_Amount_Due->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->Total_Amount_Due) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->Total_Amount_Due->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->Total_Amount_Due->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->Total_Amount_Due->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->Bill_Reference->Visible) { // Bill_Reference ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->Bill_Reference) == "") { ?>
		<td><?php echo $vendor_bill->Bill_Reference->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->Bill_Reference) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->Bill_Reference->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($vendor_bill->Bill_Reference->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->Bill_Reference->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->payment_method_id->Visible) { // payment_method_id ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->payment_method_id) == "") { ?>
		<td><?php echo $vendor_bill->payment_method_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->payment_method_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->payment_method_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->payment_method_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->payment_method_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->Payment_Status->Visible) { // Payment_Status ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->Payment_Status) == "") { ?>
		<td><?php echo $vendor_bill->Payment_Status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->Payment_Status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->Payment_Status->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->Payment_Status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->Payment_Status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->Status->Visible) { // Status ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->Status) == "") { ?>
		<td><?php echo $vendor_bill->Status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->Status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->Status->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->Status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->Status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->Remarks->Visible) { // Remarks ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->Remarks) == "") { ?>
		<td><?php echo $vendor_bill->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($vendor_bill->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->User_ID->Visible) { // User_ID ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->User_ID) == "") { ?>
		<td><?php echo $vendor_bill->User_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->User_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->User_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->User_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->User_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->created->Visible) { // created ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->created) == "") { ?>
		<td><?php echo $vendor_bill->created->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->created) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->created->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->created->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->created->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($vendor_bill->modified->Visible) { // modified ?>
	<?php if ($vendor_bill->SortUrl($vendor_bill->modified) == "") { ?>
		<td><?php echo $vendor_bill->modified->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $vendor_bill->SortUrl($vendor_bill->modified) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $vendor_bill->modified->FldCaption() ?></td><td style="width: 10px;"><?php if ($vendor_bill->modified->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vendor_bill->modified->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$vendor_bill_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($vendor_bill->ExportAll && $vendor_bill->Export <> "") {
	$vendor_bill_list->lStopRec = $vendor_bill_list->lTotalRecs;
} else {
	$vendor_bill_list->lStopRec = $vendor_bill_list->lStartRec + $vendor_bill_list->lDisplayRecs - 1; // Set the last record to display
}
$vendor_bill_list->lRecCount = $vendor_bill_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $vendor_bill_list->lStartRec > 1)
		$rs->Move($vendor_bill_list->lStartRec - 1);
}

// Initialize aggregate
$vendor_bill->RowType = EW_ROWTYPE_AGGREGATEINIT;
$vendor_bill_list->RenderRow();
$vendor_bill_list->lRowCnt = 0;
while (($vendor_bill->CurrentAction == "gridadd" || !$rs->EOF) &&
	$vendor_bill_list->lRecCount < $vendor_bill_list->lStopRec) {
	$vendor_bill_list->lRecCount++;
	if (intval($vendor_bill_list->lRecCount) >= intval($vendor_bill_list->lStartRec)) {
		$vendor_bill_list->lRowCnt++;

	// Init row class and style
	$vendor_bill->CssClass = "";
	$vendor_bill->CssStyle = "";
	$vendor_bill->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($vendor_bill->CurrentAction == "gridadd") {
		$vendor_bill_list->LoadDefaultValues(); // Load default values
	} else {
		$vendor_bill_list->LoadRowValues($rs); // Load row values
	}
	$vendor_bill->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$vendor_bill_list->RenderRow();

	// Render list options
	$vendor_bill_list->RenderListOptions();
?>
	<tr<?php echo $vendor_bill->RowAttributes() ?>>
<?php

// Render list options (body, left)
$vendor_bill_list->ListOptions->Render("body", "left");
?>
	<?php if ($vendor_bill->id->Visible) { // id ?>
		<td<?php echo $vendor_bill->id->CellAttributes() ?>>
<div<?php echo $vendor_bill->id->ViewAttributes() ?>><?php echo $vendor_bill->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->vendor_ID->Visible) { // vendor_ID ?>
		<td<?php echo $vendor_bill->vendor_ID->CellAttributes() ?>>
<div<?php echo $vendor_bill->vendor_ID->ViewAttributes() ?>><?php echo $vendor_bill->vendor_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->vendor_Number->Visible) { // vendor_Number ?>
		<td<?php echo $vendor_bill->vendor_Number->CellAttributes() ?>>
<div<?php echo $vendor_bill->vendor_Number->ViewAttributes() ?>><?php echo $vendor_bill->vendor_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->Billing_Date->Visible) { // Billing_Date ?>
		<td<?php echo $vendor_bill->Billing_Date->CellAttributes() ?>>
<div<?php echo $vendor_bill->Billing_Date->ViewAttributes() ?>><?php echo $vendor_bill->Billing_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->Due_Date->Visible) { // Due_Date ?>
		<td<?php echo $vendor_bill->Due_Date->CellAttributes() ?>>
<div<?php echo $vendor_bill->Due_Date->ViewAttributes() ?>><?php echo $vendor_bill->Due_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td<?php echo $vendor_bill->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $vendor_bill->Total_Amount_Due->ViewAttributes() ?>><?php echo $vendor_bill->Total_Amount_Due->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->Bill_Reference->Visible) { // Bill_Reference ?>
		<td<?php echo $vendor_bill->Bill_Reference->CellAttributes() ?>>
<div<?php echo $vendor_bill->Bill_Reference->ViewAttributes() ?>><?php echo $vendor_bill->Bill_Reference->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->payment_method_id->Visible) { // payment_method_id ?>
		<td<?php echo $vendor_bill->payment_method_id->CellAttributes() ?>>
<div<?php echo $vendor_bill->payment_method_id->ViewAttributes() ?>><?php echo $vendor_bill->payment_method_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->Payment_Status->Visible) { // Payment_Status ?>
		<td<?php echo $vendor_bill->Payment_Status->CellAttributes() ?>>
<div<?php echo $vendor_bill->Payment_Status->ViewAttributes() ?>><?php echo $vendor_bill->Payment_Status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->Status->Visible) { // Status ?>
		<td<?php echo $vendor_bill->Status->CellAttributes() ?>>
<div<?php echo $vendor_bill->Status->ViewAttributes() ?>><?php echo $vendor_bill->Status->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->Remarks->Visible) { // Remarks ?>
		<td<?php echo $vendor_bill->Remarks->CellAttributes() ?>>
<div<?php echo $vendor_bill->Remarks->ViewAttributes() ?>><?php echo $vendor_bill->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->User_ID->Visible) { // User_ID ?>
		<td<?php echo $vendor_bill->User_ID->CellAttributes() ?>>
<div<?php echo $vendor_bill->User_ID->ViewAttributes() ?>><?php echo $vendor_bill->User_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->created->Visible) { // created ?>
		<td<?php echo $vendor_bill->created->CellAttributes() ?>>
<div<?php echo $vendor_bill->created->ViewAttributes() ?>><?php echo $vendor_bill->created->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($vendor_bill->modified->Visible) { // modified ?>
		<td<?php echo $vendor_bill->modified->CellAttributes() ?>>
<div<?php echo $vendor_bill->modified->ViewAttributes() ?>><?php echo $vendor_bill->modified->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vendor_bill_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($vendor_bill->CurrentAction <> "gridadd")
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
<?php if ($vendor_bill_list->lTotalRecs > 0) { ?>
<?php if ($vendor_bill->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($vendor_bill->CurrentAction <> "gridadd" && $vendor_bill->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($vendor_bill_list->Pager)) $vendor_bill_list->Pager = new cPrevNextPager($vendor_bill_list->lStartRec, $vendor_bill_list->lDisplayRecs, $vendor_bill_list->lTotalRecs) ?>
<?php if ($vendor_bill_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($vendor_bill_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_list->PageUrl() ?>start=<?php echo $vendor_bill_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($vendor_bill_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_list->PageUrl() ?>start=<?php echo $vendor_bill_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $vendor_bill_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($vendor_bill_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_list->PageUrl() ?>start=<?php echo $vendor_bill_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($vendor_bill_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $vendor_bill_list->PageUrl() ?>start=<?php echo $vendor_bill_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $vendor_bill_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vendor_bill_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vendor_bill_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vendor_bill_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($vendor_bill_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($vendor_bill_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="vendor_bill">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($vendor_bill_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($vendor_bill_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($vendor_bill_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($vendor_bill_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($vendor_bill_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($vendor_bill_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($vendor_bill->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($vendor_bill_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $vendor_bill_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($vendor_bill_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fvendor_billlist, '<?php echo $vendor_bill_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($vendor_bill->Export == "" && $vendor_bill->CurrentAction == "") { ?>
<?php } ?>
<?php if ($vendor_bill->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$vendor_bill_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cvendor_bill_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'vendor_bill';

	// Page object name
	var $PageObjName = 'vendor_bill_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $vendor_bill;
		if ($vendor_bill->UseTokenInUrl) $PageUrl .= "t=" . $vendor_bill->TableVar . "&"; // Add page token
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
		global $objForm, $vendor_bill;
		if ($vendor_bill->UseTokenInUrl) {
			if ($objForm)
				return ($vendor_bill->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($vendor_bill->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cvendor_bill_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (vendor_bill)
		$GLOBALS["vendor_bill"] = new cvendor_bill();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["vendor_bill"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "vendor_billdelete.php";
		$this->MultiUpdateUrl = "vendor_billupdate.php";

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (vendor_bill_items)
		$GLOBALS['vendor_bill_items'] = new cvendor_bill_items();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'vendor_bill', TRUE);

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
		global $vendor_bill;

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
			$vendor_bill->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$vendor_bill->Export = $_POST["exporttype"];
		} else {
			$vendor_bill->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $vendor_bill->Export; // Get export parameter, used in header
		$gsExportFile = $vendor_bill->TableVar; // Get export file, used in header
		if ($vendor_bill->Export == "excel") {
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
	var $lvendor_bill_items_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $vendor_bill;

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
			$vendor_bill->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($vendor_bill->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $vendor_bill->getRecordsPerPage(); // Restore from Session
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
		$vendor_bill->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$vendor_bill->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$vendor_bill->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $vendor_bill->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $vendor_bill->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $vendor_bill->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($vendor_bill->getMasterFilter() <> "" && $vendor_bill->getCurrentMasterTable() == "subcons") {
			global $subcons;
			$rsmaster = $subcons->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$vendor_bill->setMasterFilter(""); // Clear master filter
				$vendor_bill->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($vendor_bill->getReturnUrl()); // Return to caller
			} else {
				$subcons->LoadListRowValues($rsmaster);
				$subcons->RowType = EW_ROWTYPE_MASTER; // Master row
				$subcons->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$vendor_bill->setSessionWhere($sFilter);
		$vendor_bill->CurrentFilter = "";

		// Export data only
		if (in_array($vendor_bill->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($vendor_bill->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $vendor_bill;
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
			$vendor_bill->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$vendor_bill->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $vendor_bill;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $vendor_bill->vendor_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $vendor_bill->Bill_Reference, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $vendor_bill->Remarks, $Keyword);
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
		global $Security, $vendor_bill;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $vendor_bill->BasicSearchKeyword;
		$sSearchType = $vendor_bill->BasicSearchType;
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
			$vendor_bill->setSessionBasicSearchKeyword($sSearchKeyword);
			$vendor_bill->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $vendor_bill;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$vendor_bill->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $vendor_bill;
		$vendor_bill->setSessionBasicSearchKeyword("");
		$vendor_bill->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $vendor_bill;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$vendor_bill->BasicSearchKeyword = $vendor_bill->getSessionBasicSearchKeyword();
			$vendor_bill->BasicSearchType = $vendor_bill->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $vendor_bill;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$vendor_bill->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$vendor_bill->CurrentOrderType = @$_GET["ordertype"];
			$vendor_bill->UpdateSort($vendor_bill->id); // id
			$vendor_bill->UpdateSort($vendor_bill->vendor_ID); // vendor_ID
			$vendor_bill->UpdateSort($vendor_bill->vendor_Number); // vendor_Number
			$vendor_bill->UpdateSort($vendor_bill->Billing_Date); // Billing_Date
			$vendor_bill->UpdateSort($vendor_bill->Due_Date); // Due_Date
			$vendor_bill->UpdateSort($vendor_bill->Total_Amount_Due); // Total_Amount_Due
			$vendor_bill->UpdateSort($vendor_bill->Bill_Reference); // Bill_Reference
			$vendor_bill->UpdateSort($vendor_bill->payment_method_id); // payment_method_id
			$vendor_bill->UpdateSort($vendor_bill->Payment_Status); // Payment_Status
			$vendor_bill->UpdateSort($vendor_bill->Status); // Status
			$vendor_bill->UpdateSort($vendor_bill->Remarks); // Remarks
			$vendor_bill->UpdateSort($vendor_bill->User_ID); // User_ID
			$vendor_bill->UpdateSort($vendor_bill->created); // created
			$vendor_bill->UpdateSort($vendor_bill->modified); // modified
			$vendor_bill->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $vendor_bill;
		$sOrderBy = $vendor_bill->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($vendor_bill->SqlOrderBy() <> "") {
				$sOrderBy = $vendor_bill->SqlOrderBy();
				$vendor_bill->setSessionOrderBy($sOrderBy);
				$vendor_bill->Billing_Date->setSort("DESC");
				$vendor_bill->Due_Date->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $vendor_bill;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$vendor_bill->getCurrentMasterTable = ""; // Clear master table
				$vendor_bill->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$vendor_bill->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$vendor_bill->vendor_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$vendor_bill->setSessionOrderBy($sOrderBy);
				$vendor_bill->id->setSort("");
				$vendor_bill->vendor_ID->setSort("");
				$vendor_bill->vendor_Number->setSort("");
				$vendor_bill->Billing_Date->setSort("");
				$vendor_bill->Due_Date->setSort("");
				$vendor_bill->Total_Amount_Due->setSort("");
				$vendor_bill->Bill_Reference->setSort("");
				$vendor_bill->payment_method_id->setSort("");
				$vendor_bill->Payment_Status->setSort("");
				$vendor_bill->Status->setSort("");
				$vendor_bill->Remarks->setSort("");
				$vendor_bill->User_ID->setSort("");
				$vendor_bill->created->setSort("");
				$vendor_bill->modified->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$vendor_bill->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $vendor_bill;

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

		// "detail_vendor_bill_items"
		$this->ListOptions->Add("detail_vendor_bill_items");
		$item =& $this->ListOptions->Items["detail_vendor_bill_items"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('vendor_bill_items');
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"vendor_bill_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($vendor_bill->Export <> "" ||
			$vendor_bill->CurrentAction == "gridadd" ||
			$vendor_bill->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $vendor_bill;
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

		// "detail_vendor_bill_items"
		$oListOpt =& $this->ListOptions->Items["detail_vendor_bill_items"];
		if ($Security->AllowList('vendor_bill_items')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("vendor_bill_items", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lvendor_bill_items_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"vendor_bill_itemslist.php?" . EW_TABLE_SHOW_MASTER . "=vendor_bill&id=" . urlencode(strval($vendor_bill->id->CurrentValue)) . "&vendor_ID=" . urlencode(strval($vendor_bill->vendor_ID->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($vendor_bill->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $vendor_bill;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $vendor_bill;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$vendor_bill->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$vendor_bill->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $vendor_bill->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$vendor_bill->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$vendor_bill->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$vendor_bill->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $vendor_bill;
		$vendor_bill->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$vendor_bill->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $vendor_bill;

		// Call Recordset Selecting event
		$vendor_bill->Recordset_Selecting($vendor_bill->CurrentFilter);

		// Load List page SQL
		$sSql = $vendor_bill->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$vendor_bill->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $vendor_bill;
		$sFilter = $vendor_bill->KeyFilter();

		// Call Row Selecting event
		$vendor_bill->Row_Selecting($sFilter);

		// Load SQL based on filter
		$vendor_bill->CurrentFilter = $sFilter;
		$sSql = $vendor_bill->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$vendor_bill->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $vendor_bill;
		$vendor_bill->id->setDbValue($rs->fields('id'));
		$vendor_bill->vendor_ID->setDbValue($rs->fields('vendor_ID'));
		$vendor_bill->vendor_Number->setDbValue($rs->fields('vendor_Number'));
		$vendor_bill->Billing_Date->setDbValue($rs->fields('Billing_Date'));
		$vendor_bill->Due_Date->setDbValue($rs->fields('Due_Date'));
		$vendor_bill->Total_Vat->setDbValue($rs->fields('Total_Vat'));
		$vendor_bill->Total_WTax->setDbValue($rs->fields('Total_WTax'));
		$vendor_bill->Total_Freight->setDbValue($rs->fields('Total_Freight'));
		$vendor_bill->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$vendor_bill->Bill_Reference->setDbValue($rs->fields('Bill_Reference'));
		$vendor_bill->payment_method_id->setDbValue($rs->fields('payment_method_id'));
		$vendor_bill->Payment_Status->setDbValue($rs->fields('Payment_Status'));
		$vendor_bill->Status->setDbValue($rs->fields('Status'));
		$vendor_bill->Remarks->setDbValue($rs->fields('Remarks'));
		$vendor_bill->User_ID->setDbValue($rs->fields('User_ID'));
		$vendor_bill->created->setDbValue($rs->fields('created'));
		$vendor_bill->modified->setDbValue($rs->fields('modified'));
		$sDetailFilter = $GLOBALS["vendor_bill_items"]->SqlDetailFilter_vendor_bill();
		$sDetailFilter = str_replace("@vendor_bill_id@", ew_AdjustSql($vendor_bill->id->DbValue), $sDetailFilter);
		$sDetailFilter = str_replace("@vendor_id@", ew_AdjustSql($vendor_bill->vendor_ID->DbValue), $sDetailFilter);
		$this->lvendor_bill_items_Count = $GLOBALS["vendor_bill_items"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $vendor_bill;

		// Initialize URLs
		$this->ViewUrl = $vendor_bill->ViewUrl();
		$this->EditUrl = $vendor_bill->EditUrl();
		$this->InlineEditUrl = $vendor_bill->InlineEditUrl();
		$this->CopyUrl = $vendor_bill->CopyUrl();
		$this->InlineCopyUrl = $vendor_bill->InlineCopyUrl();
		$this->DeleteUrl = $vendor_bill->DeleteUrl();

		// Call Row_Rendering event
		$vendor_bill->Row_Rendering();

		// Common render codes for all row types
		// id

		$vendor_bill->id->CellCssStyle = ""; $vendor_bill->id->CellCssClass = "";
		$vendor_bill->id->CellAttrs = array(); $vendor_bill->id->ViewAttrs = array(); $vendor_bill->id->EditAttrs = array();

		// vendor_ID
		$vendor_bill->vendor_ID->CellCssStyle = ""; $vendor_bill->vendor_ID->CellCssClass = "";
		$vendor_bill->vendor_ID->CellAttrs = array(); $vendor_bill->vendor_ID->ViewAttrs = array(); $vendor_bill->vendor_ID->EditAttrs = array();

		// vendor_Number
		$vendor_bill->vendor_Number->CellCssStyle = ""; $vendor_bill->vendor_Number->CellCssClass = "";
		$vendor_bill->vendor_Number->CellAttrs = array(); $vendor_bill->vendor_Number->ViewAttrs = array(); $vendor_bill->vendor_Number->EditAttrs = array();

		// Billing_Date
		$vendor_bill->Billing_Date->CellCssStyle = ""; $vendor_bill->Billing_Date->CellCssClass = "";
		$vendor_bill->Billing_Date->CellAttrs = array(); $vendor_bill->Billing_Date->ViewAttrs = array(); $vendor_bill->Billing_Date->EditAttrs = array();

		// Due_Date
		$vendor_bill->Due_Date->CellCssStyle = ""; $vendor_bill->Due_Date->CellCssClass = "";
		$vendor_bill->Due_Date->CellAttrs = array(); $vendor_bill->Due_Date->ViewAttrs = array(); $vendor_bill->Due_Date->EditAttrs = array();

		// Total_Amount_Due
		$vendor_bill->Total_Amount_Due->CellCssStyle = ""; $vendor_bill->Total_Amount_Due->CellCssClass = "";
		$vendor_bill->Total_Amount_Due->CellAttrs = array(); $vendor_bill->Total_Amount_Due->ViewAttrs = array(); $vendor_bill->Total_Amount_Due->EditAttrs = array();

		// Bill_Reference
		$vendor_bill->Bill_Reference->CellCssStyle = ""; $vendor_bill->Bill_Reference->CellCssClass = "";
		$vendor_bill->Bill_Reference->CellAttrs = array(); $vendor_bill->Bill_Reference->ViewAttrs = array(); $vendor_bill->Bill_Reference->EditAttrs = array();

		// payment_method_id
		$vendor_bill->payment_method_id->CellCssStyle = ""; $vendor_bill->payment_method_id->CellCssClass = "";
		$vendor_bill->payment_method_id->CellAttrs = array(); $vendor_bill->payment_method_id->ViewAttrs = array(); $vendor_bill->payment_method_id->EditAttrs = array();

		// Payment_Status
		$vendor_bill->Payment_Status->CellCssStyle = ""; $vendor_bill->Payment_Status->CellCssClass = "";
		$vendor_bill->Payment_Status->CellAttrs = array(); $vendor_bill->Payment_Status->ViewAttrs = array(); $vendor_bill->Payment_Status->EditAttrs = array();

		// Status
		$vendor_bill->Status->CellCssStyle = ""; $vendor_bill->Status->CellCssClass = "";
		$vendor_bill->Status->CellAttrs = array(); $vendor_bill->Status->ViewAttrs = array(); $vendor_bill->Status->EditAttrs = array();

		// Remarks
		$vendor_bill->Remarks->CellCssStyle = ""; $vendor_bill->Remarks->CellCssClass = "";
		$vendor_bill->Remarks->CellAttrs = array(); $vendor_bill->Remarks->ViewAttrs = array(); $vendor_bill->Remarks->EditAttrs = array();

		// User_ID
		$vendor_bill->User_ID->CellCssStyle = ""; $vendor_bill->User_ID->CellCssClass = "";
		$vendor_bill->User_ID->CellAttrs = array(); $vendor_bill->User_ID->ViewAttrs = array(); $vendor_bill->User_ID->EditAttrs = array();

		// created
		$vendor_bill->created->CellCssStyle = ""; $vendor_bill->created->CellCssClass = "";
		$vendor_bill->created->CellAttrs = array(); $vendor_bill->created->ViewAttrs = array(); $vendor_bill->created->EditAttrs = array();

		// modified
		$vendor_bill->modified->CellCssStyle = ""; $vendor_bill->modified->CellCssClass = "";
		$vendor_bill->modified->CellAttrs = array(); $vendor_bill->modified->ViewAttrs = array(); $vendor_bill->modified->EditAttrs = array();
		if ($vendor_bill->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$vendor_bill->id->ViewValue = $vendor_bill->id->CurrentValue;
			$vendor_bill->id->CssStyle = "";
			$vendor_bill->id->CssClass = "";
			$vendor_bill->id->ViewCustomAttributes = "";

			// vendor_ID
			if (strval($vendor_bill->vendor_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill->vendor_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill->vendor_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$vendor_bill->vendor_ID->ViewValue = $vendor_bill->vendor_ID->CurrentValue;
				}
			} else {
				$vendor_bill->vendor_ID->ViewValue = NULL;
			}
			$vendor_bill->vendor_ID->CssStyle = "";
			$vendor_bill->vendor_ID->CssClass = "";
			$vendor_bill->vendor_ID->ViewCustomAttributes = "";

			// vendor_Number
			$vendor_bill->vendor_Number->ViewValue = $vendor_bill->vendor_Number->CurrentValue;
			$vendor_bill->vendor_Number->CssStyle = "";
			$vendor_bill->vendor_Number->CssClass = "";
			$vendor_bill->vendor_Number->ViewCustomAttributes = "";

			// Billing_Date
			$vendor_bill->Billing_Date->ViewValue = $vendor_bill->Billing_Date->CurrentValue;
			$vendor_bill->Billing_Date->ViewValue = ew_FormatDateTime($vendor_bill->Billing_Date->ViewValue, 6);
			$vendor_bill->Billing_Date->CssStyle = "";
			$vendor_bill->Billing_Date->CssClass = "";
			$vendor_bill->Billing_Date->ViewCustomAttributes = "";

			// Due_Date
			$vendor_bill->Due_Date->ViewValue = $vendor_bill->Due_Date->CurrentValue;
			$vendor_bill->Due_Date->ViewValue = ew_FormatDateTime($vendor_bill->Due_Date->ViewValue, 6);
			$vendor_bill->Due_Date->CssStyle = "";
			$vendor_bill->Due_Date->CssClass = "";
			$vendor_bill->Due_Date->ViewCustomAttributes = "";

			// Total_Vat
			$vendor_bill->Total_Vat->ViewValue = $vendor_bill->Total_Vat->CurrentValue;
			$vendor_bill->Total_Vat->CssStyle = "";
			$vendor_bill->Total_Vat->CssClass = "";
			$vendor_bill->Total_Vat->ViewCustomAttributes = "";

			// Total_WTax
			$vendor_bill->Total_WTax->ViewValue = $vendor_bill->Total_WTax->CurrentValue;
			$vendor_bill->Total_WTax->CssStyle = "";
			$vendor_bill->Total_WTax->CssClass = "";
			$vendor_bill->Total_WTax->ViewCustomAttributes = "";

			// Total_Freight
			$vendor_bill->Total_Freight->ViewValue = $vendor_bill->Total_Freight->CurrentValue;
			$vendor_bill->Total_Freight->CssStyle = "";
			$vendor_bill->Total_Freight->CssClass = "";
			$vendor_bill->Total_Freight->ViewCustomAttributes = "";

			// Total_Amount_Due
			$vendor_bill->Total_Amount_Due->ViewValue = $vendor_bill->Total_Amount_Due->CurrentValue;
			$vendor_bill->Total_Amount_Due->CssStyle = "";
			$vendor_bill->Total_Amount_Due->CssClass = "";
			$vendor_bill->Total_Amount_Due->ViewCustomAttributes = "";

			// Bill_Reference
			$vendor_bill->Bill_Reference->ViewValue = $vendor_bill->Bill_Reference->CurrentValue;
			$vendor_bill->Bill_Reference->CssStyle = "";
			$vendor_bill->Bill_Reference->CssClass = "";
			$vendor_bill->Bill_Reference->ViewCustomAttributes = "";

			// payment_method_id
			if (strval($vendor_bill->payment_method_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill->payment_method_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Payment_Method` FROM `account_payment_methods`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill->payment_method_id->ViewValue = $rswrk->fields('Payment_Method');
					$rswrk->Close();
				} else {
					$vendor_bill->payment_method_id->ViewValue = $vendor_bill->payment_method_id->CurrentValue;
				}
			} else {
				$vendor_bill->payment_method_id->ViewValue = NULL;
			}
			$vendor_bill->payment_method_id->CssStyle = "";
			$vendor_bill->payment_method_id->CssClass = "";
			$vendor_bill->payment_method_id->ViewCustomAttributes = "";

			// Payment_Status
			if (strval($vendor_bill->Payment_Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill->Payment_Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill->Payment_Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$vendor_bill->Payment_Status->ViewValue = $vendor_bill->Payment_Status->CurrentValue;
				}
			} else {
				$vendor_bill->Payment_Status->ViewValue = NULL;
			}
			$vendor_bill->Payment_Status->CssStyle = "";
			$vendor_bill->Payment_Status->CssClass = "";
			$vendor_bill->Payment_Status->ViewCustomAttributes = "";

			// Status
			if (strval($vendor_bill->Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill->Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill->Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$vendor_bill->Status->ViewValue = $vendor_bill->Status->CurrentValue;
				}
			} else {
				$vendor_bill->Status->ViewValue = NULL;
			}
			$vendor_bill->Status->CssStyle = "";
			$vendor_bill->Status->CssClass = "";
			$vendor_bill->Status->ViewCustomAttributes = "";

			// Remarks
			$vendor_bill->Remarks->ViewValue = $vendor_bill->Remarks->CurrentValue;
			$vendor_bill->Remarks->CssStyle = "";
			$vendor_bill->Remarks->CssClass = "";
			$vendor_bill->Remarks->ViewCustomAttributes = "";

			// User_ID
			$vendor_bill->User_ID->ViewValue = $vendor_bill->User_ID->CurrentValue;
			$vendor_bill->User_ID->CssStyle = "";
			$vendor_bill->User_ID->CssClass = "";
			$vendor_bill->User_ID->ViewCustomAttributes = "";

			// created
			$vendor_bill->created->ViewValue = $vendor_bill->created->CurrentValue;
			$vendor_bill->created->ViewValue = ew_FormatDateTime($vendor_bill->created->ViewValue, 6);
			$vendor_bill->created->CssStyle = "";
			$vendor_bill->created->CssClass = "";
			$vendor_bill->created->ViewCustomAttributes = "";

			// modified
			$vendor_bill->modified->ViewValue = $vendor_bill->modified->CurrentValue;
			$vendor_bill->modified->ViewValue = ew_FormatDateTime($vendor_bill->modified->ViewValue, 6);
			$vendor_bill->modified->CssStyle = "";
			$vendor_bill->modified->CssClass = "";
			$vendor_bill->modified->ViewCustomAttributes = "";

			// id
			$vendor_bill->id->HrefValue = "";
			$vendor_bill->id->TooltipValue = "";

			// vendor_ID
			$vendor_bill->vendor_ID->HrefValue = "";
			$vendor_bill->vendor_ID->TooltipValue = "";

			// vendor_Number
			$vendor_bill->vendor_Number->HrefValue = "";
			$vendor_bill->vendor_Number->TooltipValue = "";

			// Billing_Date
			$vendor_bill->Billing_Date->HrefValue = "";
			$vendor_bill->Billing_Date->TooltipValue = "";

			// Due_Date
			$vendor_bill->Due_Date->HrefValue = "";
			$vendor_bill->Due_Date->TooltipValue = "";

			// Total_Amount_Due
			$vendor_bill->Total_Amount_Due->HrefValue = "";
			$vendor_bill->Total_Amount_Due->TooltipValue = "";

			// Bill_Reference
			$vendor_bill->Bill_Reference->HrefValue = "";
			$vendor_bill->Bill_Reference->TooltipValue = "";

			// payment_method_id
			$vendor_bill->payment_method_id->HrefValue = "";
			$vendor_bill->payment_method_id->TooltipValue = "";

			// Payment_Status
			$vendor_bill->Payment_Status->HrefValue = "";
			$vendor_bill->Payment_Status->TooltipValue = "";

			// Status
			$vendor_bill->Status->HrefValue = "";
			$vendor_bill->Status->TooltipValue = "";

			// Remarks
			$vendor_bill->Remarks->HrefValue = "";
			$vendor_bill->Remarks->TooltipValue = "";

			// User_ID
			$vendor_bill->User_ID->HrefValue = "";
			$vendor_bill->User_ID->TooltipValue = "";

			// created
			$vendor_bill->created->HrefValue = "";
			$vendor_bill->created->TooltipValue = "";

			// modified
			$vendor_bill->modified->HrefValue = "";
			$vendor_bill->modified->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($vendor_bill->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$vendor_bill->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $vendor_bill;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $vendor_bill->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($vendor_bill->ExportAll) {
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
		if ($vendor_bill->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($vendor_bill, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($vendor_bill->id);
				$ExportDoc->ExportCaption($vendor_bill->vendor_ID);
				$ExportDoc->ExportCaption($vendor_bill->vendor_Number);
				$ExportDoc->ExportCaption($vendor_bill->Billing_Date);
				$ExportDoc->ExportCaption($vendor_bill->Due_Date);
				$ExportDoc->ExportCaption($vendor_bill->Total_Vat);
				$ExportDoc->ExportCaption($vendor_bill->Total_WTax);
				$ExportDoc->ExportCaption($vendor_bill->Total_Freight);
				$ExportDoc->ExportCaption($vendor_bill->Total_Amount_Due);
				$ExportDoc->ExportCaption($vendor_bill->Bill_Reference);
				$ExportDoc->ExportCaption($vendor_bill->payment_method_id);
				$ExportDoc->ExportCaption($vendor_bill->Payment_Status);
				$ExportDoc->ExportCaption($vendor_bill->Status);
				$ExportDoc->ExportCaption($vendor_bill->User_ID);
				$ExportDoc->ExportCaption($vendor_bill->created);
				$ExportDoc->ExportCaption($vendor_bill->modified);
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
				$vendor_bill->CssClass = "";
				$vendor_bill->CssStyle = "";
				$vendor_bill->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($vendor_bill->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $vendor_bill->id->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('vendor_ID', $vendor_bill->vendor_ID->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('vendor_Number', $vendor_bill->vendor_Number->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Billing_Date', $vendor_bill->Billing_Date->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Due_Date', $vendor_bill->Due_Date->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Total_Vat', $vendor_bill->Total_Vat->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Total_WTax', $vendor_bill->Total_WTax->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Total_Freight', $vendor_bill->Total_Freight->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Total_Amount_Due', $vendor_bill->Total_Amount_Due->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Bill_Reference', $vendor_bill->Bill_Reference->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('payment_method_id', $vendor_bill->payment_method_id->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Payment_Status', $vendor_bill->Payment_Status->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('Status', $vendor_bill->Status->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('User_ID', $vendor_bill->User_ID->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('created', $vendor_bill->created->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
					$XmlDoc->AddField('modified', $vendor_bill->modified->ExportValue($vendor_bill->Export, $vendor_bill->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($vendor_bill->id);
					$ExportDoc->ExportField($vendor_bill->vendor_ID);
					$ExportDoc->ExportField($vendor_bill->vendor_Number);
					$ExportDoc->ExportField($vendor_bill->Billing_Date);
					$ExportDoc->ExportField($vendor_bill->Due_Date);
					$ExportDoc->ExportField($vendor_bill->Total_Vat);
					$ExportDoc->ExportField($vendor_bill->Total_WTax);
					$ExportDoc->ExportField($vendor_bill->Total_Freight);
					$ExportDoc->ExportField($vendor_bill->Total_Amount_Due);
					$ExportDoc->ExportField($vendor_bill->Bill_Reference);
					$ExportDoc->ExportField($vendor_bill->payment_method_id);
					$ExportDoc->ExportField($vendor_bill->Payment_Status);
					$ExportDoc->ExportField($vendor_bill->Status);
					$ExportDoc->ExportField($vendor_bill->User_ID);
					$ExportDoc->ExportField($vendor_bill->created);
					$ExportDoc->ExportField($vendor_bill->modified);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($vendor_bill->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($vendor_bill->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($vendor_bill->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($vendor_bill->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($vendor_bill->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $vendor_bill;
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
				$this->sDbMasterFilter = $vendor_bill->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $vendor_bill->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$vendor_bill->vendor_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$vendor_bill->vendor_ID->setSessionValue($vendor_bill->vendor_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["subcons"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@vendor_ID@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$vendor_bill->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$vendor_bill->setStartRecordNumber($this->lStartRec);
			$vendor_bill->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$vendor_bill->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($vendor_bill->vendor_ID->QueryStringValue == "") $vendor_bill->vendor_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $vendor_bill->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $vendor_bill->getDetailFilter(); // Restore detail filter
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
