<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "billinglistinfo.php" ?>
<?php include "clientsinfo.php" ?>
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
$billinglist_list = new cbillinglist_list();
$Page =& $billinglist_list;

// Page init
$billinglist_list->Page_Init();

// Page main
$billinglist_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($billinglist->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var billinglist_list = new ew_Page("billinglist_list");

// page properties
billinglist_list.PageID = "list"; // page ID
billinglist_list.FormID = "fbillinglistlist"; // form ID
var EW_PAGE_ID = billinglist_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
billinglist_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
billinglist_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
billinglist_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($billinglist->Export == "") { ?>
<?php
$gsMasterReturnUrl = "clientslist.php";
if ($billinglist_list->sDbMasterFilter <> "" && $billinglist->getCurrentMasterTable() == "clients") {
	if ($billinglist_list->bMasterRecordExists) {
		if ($billinglist->getCurrentMasterTable() == $billinglist->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "clientsmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$billinglist_list->lTotalRecs = $billinglist->SelectRecordCount();
	} else {
		if ($rs = $billinglist_list->LoadRecordset())
			$billinglist_list->lTotalRecs = $rs->RecordCount();
	}
	$billinglist_list->lStartRec = 1;
	if ($billinglist_list->lDisplayRecs <= 0 || ($billinglist->Export <> "" && $billinglist->ExportAll)) // Display all records
		$billinglist_list->lDisplayRecs = $billinglist_list->lTotalRecs;
	if (!($billinglist->Export <> "" && $billinglist->ExportAll))
		$billinglist_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $billinglist_list->LoadRecordset($billinglist_list->lStartRec-1, $billinglist_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $billinglist->TableCaption() ?>
<?php if ($billinglist->Export == "" && $billinglist->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $billinglist_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $billinglist_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $billinglist_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($billinglist->Export == "" && $billinglist->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(billinglist_list);" style="text-decoration: none;"><img id="billinglist_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="billinglist_list_SearchPanel">
<form name="fbillinglistlistsrch" id="fbillinglistlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="billinglist">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($billinglist->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $billinglist_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($billinglist->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($billinglist->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($billinglist->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$billinglist_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($billinglist->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($billinglist->CurrentAction <> "gridadd" && $billinglist->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($billinglist_list->Pager)) $billinglist_list->Pager = new cPrevNextPager($billinglist_list->lStartRec, $billinglist_list->lDisplayRecs, $billinglist_list->lTotalRecs) ?>
<?php if ($billinglist_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($billinglist_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $billinglist_list->PageUrl() ?>start=<?php echo $billinglist_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($billinglist_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $billinglist_list->PageUrl() ?>start=<?php echo $billinglist_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $billinglist_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($billinglist_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $billinglist_list->PageUrl() ?>start=<?php echo $billinglist_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($billinglist_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $billinglist_list->PageUrl() ?>start=<?php echo $billinglist_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $billinglist_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $billinglist_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $billinglist_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $billinglist_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($billinglist_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($billinglist_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="billinglist">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($billinglist_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($billinglist_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($billinglist_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($billinglist_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($billinglist_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($billinglist_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($billinglist->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
<form name="fbillinglistlist" id="fbillinglistlist" class="ewForm" action="" method="post">
<div id="gmp_billinglist" class="ewGridMiddlePanel">
<?php if ($billinglist_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $billinglist->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$billinglist_list->RenderListOptions();

// Render list options (header, left)
$billinglist_list->ListOptions->Render("header", "left");
?>
<?php if ($billinglist->Booking_ID->Visible) { // Booking ID ?>
	<?php if ($billinglist->SortUrl($billinglist->Booking_ID) == "") { ?>
		<td><?php echo $billinglist->Booking_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Booking_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Booking_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($billinglist->Booking_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Booking_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Client_ID->Visible) { // Client ID ?>
	<?php if ($billinglist->SortUrl($billinglist->Client_ID) == "") { ?>
		<td><?php echo $billinglist->Client_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Client_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Client_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($billinglist->Client_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Client_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Booking_Date->Visible) { // Booking Date ?>
	<?php if ($billinglist->SortUrl($billinglist->Booking_Date) == "") { ?>
		<td><?php echo $billinglist->Booking_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Booking_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Booking_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($billinglist->Booking_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Booking_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Booking_Number->Visible) { // Booking Number ?>
	<?php if ($billinglist->SortUrl($billinglist->Booking_Number) == "") { ?>
		<td><?php echo $billinglist->Booking_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Booking_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Booking_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($billinglist->Booking_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Booking_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Date_Delivered->Visible) { // Date Delivered ?>
	<?php if ($billinglist->SortUrl($billinglist->Date_Delivered) == "") { ?>
		<td><?php echo $billinglist->Date_Delivered->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Date_Delivered) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Date_Delivered->FldCaption() ?></td><td style="width: 10px;"><?php if ($billinglist->Date_Delivered->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Date_Delivered->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Origin->Visible) { // Origin ?>
	<?php if ($billinglist->SortUrl($billinglist->Origin) == "") { ?>
		<td><?php echo $billinglist->Origin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Origin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Origin->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($billinglist->Origin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Origin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Customer->Visible) { // Customer ?>
	<?php if ($billinglist->SortUrl($billinglist->Customer) == "") { ?>
		<td><?php echo $billinglist->Customer->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Customer) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Customer->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($billinglist->Customer->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Customer->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Destination->Visible) { // Destination ?>
	<?php if ($billinglist->SortUrl($billinglist->Destination) == "") { ?>
		<td><?php echo $billinglist->Destination->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Destination) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Destination->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($billinglist->Destination->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Destination->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Plate_Number->Visible) { // Plate Number ?>
	<?php if ($billinglist->SortUrl($billinglist->Plate_Number) == "") { ?>
		<td><?php echo $billinglist->Plate_Number->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Plate_Number) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Plate_Number->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($billinglist->Plate_Number->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Plate_Number->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Truck_Type->Visible) { // Truck_Type ?>
	<?php if ($billinglist->SortUrl($billinglist->Truck_Type) == "") { ?>
		<td><?php echo $billinglist->Truck_Type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Truck_Type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Truck_Type->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($billinglist->Truck_Type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Truck_Type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($billinglist->Freight->Visible) { // Freight ?>
	<?php if ($billinglist->SortUrl($billinglist->Freight) == "") { ?>
		<td><?php echo $billinglist->Freight->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $billinglist->SortUrl($billinglist->Freight) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $billinglist->Freight->FldCaption() ?></td><td style="width: 10px;"><?php if ($billinglist->Freight->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($billinglist->Freight->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$billinglist_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($billinglist->ExportAll && $billinglist->Export <> "") {
	$billinglist_list->lStopRec = $billinglist_list->lTotalRecs;
} else {
	$billinglist_list->lStopRec = $billinglist_list->lStartRec + $billinglist_list->lDisplayRecs - 1; // Set the last record to display
}
$billinglist_list->lRecCount = $billinglist_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $billinglist_list->lStartRec > 1)
		$rs->Move($billinglist_list->lStartRec - 1);
}

// Initialize aggregate
$billinglist->RowType = EW_ROWTYPE_AGGREGATEINIT;
$billinglist_list->RenderRow();
$billinglist_list->lRowCnt = 0;
while (($billinglist->CurrentAction == "gridadd" || !$rs->EOF) &&
	$billinglist_list->lRecCount < $billinglist_list->lStopRec) {
	$billinglist_list->lRecCount++;
	if (intval($billinglist_list->lRecCount) >= intval($billinglist_list->lStartRec)) {
		$billinglist_list->lRowCnt++;

	// Init row class and style
	$billinglist->CssClass = "";
	$billinglist->CssStyle = "";
	$billinglist->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($billinglist->CurrentAction == "gridadd") {
		$billinglist_list->LoadDefaultValues(); // Load default values
	} else {
		$billinglist_list->LoadRowValues($rs); // Load row values
	}
	$billinglist->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$billinglist_list->RenderRow();

	// Render list options
	$billinglist_list->RenderListOptions();
?>
	<tr<?php echo $billinglist->RowAttributes() ?>>
<?php

// Render list options (body, left)
$billinglist_list->ListOptions->Render("body", "left");
?>
	<?php if ($billinglist->Booking_ID->Visible) { // Booking ID ?>
		<td<?php echo $billinglist->Booking_ID->CellAttributes() ?>>
<div<?php echo $billinglist->Booking_ID->ViewAttributes() ?>><?php echo $billinglist->Booking_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Client_ID->Visible) { // Client ID ?>
		<td<?php echo $billinglist->Client_ID->CellAttributes() ?>>
<div<?php echo $billinglist->Client_ID->ViewAttributes() ?>><?php echo $billinglist->Client_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Booking_Date->Visible) { // Booking Date ?>
		<td<?php echo $billinglist->Booking_Date->CellAttributes() ?>>
<div<?php echo $billinglist->Booking_Date->ViewAttributes() ?>><?php echo $billinglist->Booking_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Booking_Number->Visible) { // Booking Number ?>
		<td<?php echo $billinglist->Booking_Number->CellAttributes() ?>>
<div<?php echo $billinglist->Booking_Number->ViewAttributes() ?>><?php echo $billinglist->Booking_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Date_Delivered->Visible) { // Date Delivered ?>
		<td<?php echo $billinglist->Date_Delivered->CellAttributes() ?>>
<div<?php echo $billinglist->Date_Delivered->ViewAttributes() ?>><?php echo $billinglist->Date_Delivered->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Origin->Visible) { // Origin ?>
		<td<?php echo $billinglist->Origin->CellAttributes() ?>>
<div<?php echo $billinglist->Origin->ViewAttributes() ?>><?php echo $billinglist->Origin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Customer->Visible) { // Customer ?>
		<td<?php echo $billinglist->Customer->CellAttributes() ?>>
<div<?php echo $billinglist->Customer->ViewAttributes() ?>><?php echo $billinglist->Customer->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Destination->Visible) { // Destination ?>
		<td<?php echo $billinglist->Destination->CellAttributes() ?>>
<div<?php echo $billinglist->Destination->ViewAttributes() ?>><?php echo $billinglist->Destination->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Plate_Number->Visible) { // Plate Number ?>
		<td<?php echo $billinglist->Plate_Number->CellAttributes() ?>>
<div<?php echo $billinglist->Plate_Number->ViewAttributes() ?>><?php echo $billinglist->Plate_Number->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Truck_Type->Visible) { // Truck_Type ?>
		<td<?php echo $billinglist->Truck_Type->CellAttributes() ?>>
<div<?php echo $billinglist->Truck_Type->ViewAttributes() ?>><?php echo $billinglist->Truck_Type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($billinglist->Freight->Visible) { // Freight ?>
		<td<?php echo $billinglist->Freight->CellAttributes() ?>>
<div<?php echo $billinglist->Freight->ViewAttributes() ?>><?php echo $billinglist->Freight->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$billinglist_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($billinglist->CurrentAction <> "gridadd")
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
<?php if ($billinglist_list->lTotalRecs > 0) { ?>
<?php if ($billinglist->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($billinglist->CurrentAction <> "gridadd" && $billinglist->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($billinglist_list->Pager)) $billinglist_list->Pager = new cPrevNextPager($billinglist_list->lStartRec, $billinglist_list->lDisplayRecs, $billinglist_list->lTotalRecs) ?>
<?php if ($billinglist_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($billinglist_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $billinglist_list->PageUrl() ?>start=<?php echo $billinglist_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($billinglist_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $billinglist_list->PageUrl() ?>start=<?php echo $billinglist_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $billinglist_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($billinglist_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $billinglist_list->PageUrl() ?>start=<?php echo $billinglist_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($billinglist_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $billinglist_list->PageUrl() ?>start=<?php echo $billinglist_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $billinglist_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $billinglist_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $billinglist_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $billinglist_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($billinglist_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($billinglist_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="billinglist">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($billinglist_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($billinglist_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($billinglist_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($billinglist_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($billinglist_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($billinglist_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($billinglist->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($billinglist_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($billinglist->Export == "" && $billinglist->CurrentAction == "") { ?>
<?php } ?>
<?php if ($billinglist->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$billinglist_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cbillinglist_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'billinglist';

	// Page object name
	var $PageObjName = 'billinglist_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $billinglist;
		if ($billinglist->UseTokenInUrl) $PageUrl .= "t=" . $billinglist->TableVar . "&"; // Add page token
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
		global $objForm, $billinglist;
		if ($billinglist->UseTokenInUrl) {
			if ($objForm)
				return ($billinglist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($billinglist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbillinglist_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (billinglist)
		$GLOBALS["billinglist"] = new cbillinglist();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["billinglist"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "billinglistdelete.php";
		$this->MultiUpdateUrl = "billinglistupdate.php";

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'billinglist', TRUE);

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
		global $billinglist;

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
			$billinglist->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$billinglist->Export = $_POST["exporttype"];
		} else {
			$billinglist->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $billinglist->Export; // Get export parameter, used in header
		$gsExportFile = $billinglist->TableVar; // Get export file, used in header
		if ($billinglist->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $billinglist;

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
			$billinglist->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($billinglist->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $billinglist->getRecordsPerPage(); // Restore from Session
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
		$billinglist->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$billinglist->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$billinglist->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $billinglist->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $billinglist->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $billinglist->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($billinglist->getMasterFilter() <> "" && $billinglist->getCurrentMasterTable() == "clients") {
			global $clients;
			$rsmaster = $clients->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$billinglist->setMasterFilter(""); // Clear master filter
				$billinglist->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($billinglist->getReturnUrl()); // Return to caller
			} else {
				$clients->LoadListRowValues($rsmaster);
				$clients->RowType = EW_ROWTYPE_MASTER; // Master row
				$clients->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$billinglist->setSessionWhere($sFilter);
		$billinglist->CurrentFilter = "";

		// Export data only
		if (in_array($billinglist->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($billinglist->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $billinglist;
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
			$billinglist->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$billinglist->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $billinglist;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $billinglist->Booking_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $billinglist->Origin, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $billinglist->Customer, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $billinglist->Destination, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $billinglist->Reference_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $billinglist->Plate_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $billinglist->Truck_Type, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $billinglist->Remarks, $Keyword);
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
		global $Security, $billinglist;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $billinglist->BasicSearchKeyword;
		$sSearchType = $billinglist->BasicSearchType;
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
			$billinglist->setSessionBasicSearchKeyword($sSearchKeyword);
			$billinglist->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $billinglist;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$billinglist->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $billinglist;
		$billinglist->setSessionBasicSearchKeyword("");
		$billinglist->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $billinglist;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$billinglist->BasicSearchKeyword = $billinglist->getSessionBasicSearchKeyword();
			$billinglist->BasicSearchType = $billinglist->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $billinglist;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$billinglist->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$billinglist->CurrentOrderType = @$_GET["ordertype"];
			$billinglist->UpdateSort($billinglist->Booking_ID); // Booking ID
			$billinglist->UpdateSort($billinglist->Client_ID); // Client ID
			$billinglist->UpdateSort($billinglist->Booking_Date); // Booking Date
			$billinglist->UpdateSort($billinglist->Booking_Number); // Booking Number
			$billinglist->UpdateSort($billinglist->Date_Delivered); // Date Delivered
			$billinglist->UpdateSort($billinglist->Origin); // Origin
			$billinglist->UpdateSort($billinglist->Customer); // Customer
			$billinglist->UpdateSort($billinglist->Destination); // Destination
			$billinglist->UpdateSort($billinglist->Plate_Number); // Plate Number
			$billinglist->UpdateSort($billinglist->Truck_Type); // Truck_Type
			$billinglist->UpdateSort($billinglist->Freight); // Freight
			$billinglist->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $billinglist;
		$sOrderBy = $billinglist->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($billinglist->SqlOrderBy() <> "") {
				$sOrderBy = $billinglist->SqlOrderBy();
				$billinglist->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $billinglist;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$billinglist->getCurrentMasterTable = ""; // Clear master table
				$billinglist->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$billinglist->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$billinglist->Client_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$billinglist->setSessionOrderBy($sOrderBy);
				$billinglist->Booking_ID->setSort("");
				$billinglist->Client_ID->setSort("");
				$billinglist->Booking_Date->setSort("");
				$billinglist->Booking_Number->setSort("");
				$billinglist->Date_Delivered->setSort("");
				$billinglist->Origin->setSort("");
				$billinglist->Customer->setSort("");
				$billinglist->Destination->setSort("");
				$billinglist->Plate_Number->setSort("");
				$billinglist->Truck_Type->setSort("");
				$billinglist->Freight->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$billinglist->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $billinglist;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($billinglist->Export <> "" ||
			$billinglist->CurrentAction == "gridadd" ||
			$billinglist->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $billinglist;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $billinglist;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $billinglist;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$billinglist->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$billinglist->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $billinglist->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$billinglist->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$billinglist->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$billinglist->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $billinglist;
		$billinglist->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$billinglist->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $billinglist;

		// Call Recordset Selecting event
		$billinglist->Recordset_Selecting($billinglist->CurrentFilter);

		// Load List page SQL
		$sSql = $billinglist->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$billinglist->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $billinglist;
		$sFilter = $billinglist->KeyFilter();

		// Call Row Selecting event
		$billinglist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$billinglist->CurrentFilter = $sFilter;
		$sSql = $billinglist->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$billinglist->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $billinglist;
		$billinglist->Booking_ID->setDbValue($rs->fields('Booking ID'));
		$billinglist->Client_ID->setDbValue($rs->fields('Client ID'));
		$billinglist->Booking_Date->setDbValue($rs->fields('Booking Date'));
		$billinglist->Booking_Number->setDbValue($rs->fields('Booking Number'));
		$billinglist->Date_Delivered->setDbValue($rs->fields('Date Delivered'));
		$billinglist->Origin->setDbValue($rs->fields('Origin'));
		$billinglist->Customer->setDbValue($rs->fields('Customer'));
		$billinglist->Destination->setDbValue($rs->fields('Destination'));
		$billinglist->Reference_Number->setDbValue($rs->fields('Reference Number'));
		$billinglist->Plate_Number->setDbValue($rs->fields('Plate Number'));
		$billinglist->Truck_Type->setDbValue($rs->fields('Truck_Type'));
		$billinglist->Freight->setDbValue($rs->fields('Freight'));
		$billinglist->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $billinglist;

		// Initialize URLs
		$this->ViewUrl = $billinglist->ViewUrl();
		$this->EditUrl = $billinglist->EditUrl();
		$this->InlineEditUrl = $billinglist->InlineEditUrl();
		$this->CopyUrl = $billinglist->CopyUrl();
		$this->InlineCopyUrl = $billinglist->InlineCopyUrl();
		$this->DeleteUrl = $billinglist->DeleteUrl();

		// Call Row_Rendering event
		$billinglist->Row_Rendering();

		// Common render codes for all row types
		// Booking ID

		$billinglist->Booking_ID->CellCssStyle = ""; $billinglist->Booking_ID->CellCssClass = "";
		$billinglist->Booking_ID->CellAttrs = array(); $billinglist->Booking_ID->ViewAttrs = array(); $billinglist->Booking_ID->EditAttrs = array();

		// Client ID
		$billinglist->Client_ID->CellCssStyle = ""; $billinglist->Client_ID->CellCssClass = "";
		$billinglist->Client_ID->CellAttrs = array(); $billinglist->Client_ID->ViewAttrs = array(); $billinglist->Client_ID->EditAttrs = array();

		// Booking Date
		$billinglist->Booking_Date->CellCssStyle = ""; $billinglist->Booking_Date->CellCssClass = "";
		$billinglist->Booking_Date->CellAttrs = array(); $billinglist->Booking_Date->ViewAttrs = array(); $billinglist->Booking_Date->EditAttrs = array();

		// Booking Number
		$billinglist->Booking_Number->CellCssStyle = ""; $billinglist->Booking_Number->CellCssClass = "";
		$billinglist->Booking_Number->CellAttrs = array(); $billinglist->Booking_Number->ViewAttrs = array(); $billinglist->Booking_Number->EditAttrs = array();

		// Date Delivered
		$billinglist->Date_Delivered->CellCssStyle = ""; $billinglist->Date_Delivered->CellCssClass = "";
		$billinglist->Date_Delivered->CellAttrs = array(); $billinglist->Date_Delivered->ViewAttrs = array(); $billinglist->Date_Delivered->EditAttrs = array();

		// Origin
		$billinglist->Origin->CellCssStyle = ""; $billinglist->Origin->CellCssClass = "";
		$billinglist->Origin->CellAttrs = array(); $billinglist->Origin->ViewAttrs = array(); $billinglist->Origin->EditAttrs = array();

		// Customer
		$billinglist->Customer->CellCssStyle = ""; $billinglist->Customer->CellCssClass = "";
		$billinglist->Customer->CellAttrs = array(); $billinglist->Customer->ViewAttrs = array(); $billinglist->Customer->EditAttrs = array();

		// Destination
		$billinglist->Destination->CellCssStyle = ""; $billinglist->Destination->CellCssClass = "";
		$billinglist->Destination->CellAttrs = array(); $billinglist->Destination->ViewAttrs = array(); $billinglist->Destination->EditAttrs = array();

		// Plate Number
		$billinglist->Plate_Number->CellCssStyle = ""; $billinglist->Plate_Number->CellCssClass = "";
		$billinglist->Plate_Number->CellAttrs = array(); $billinglist->Plate_Number->ViewAttrs = array(); $billinglist->Plate_Number->EditAttrs = array();

		// Truck_Type
		$billinglist->Truck_Type->CellCssStyle = ""; $billinglist->Truck_Type->CellCssClass = "";
		$billinglist->Truck_Type->CellAttrs = array(); $billinglist->Truck_Type->ViewAttrs = array(); $billinglist->Truck_Type->EditAttrs = array();

		// Freight
		$billinglist->Freight->CellCssStyle = ""; $billinglist->Freight->CellCssClass = "";
		$billinglist->Freight->CellAttrs = array(); $billinglist->Freight->ViewAttrs = array(); $billinglist->Freight->EditAttrs = array();
		if ($billinglist->RowType == EW_ROWTYPE_VIEW) { // View row

			// Booking ID
			$billinglist->Booking_ID->ViewValue = $billinglist->Booking_ID->CurrentValue;
			$billinglist->Booking_ID->CssStyle = "";
			$billinglist->Booking_ID->CssClass = "";
			$billinglist->Booking_ID->ViewCustomAttributes = "";

			// Client ID
			$billinglist->Client_ID->ViewValue = $billinglist->Client_ID->CurrentValue;
			$billinglist->Client_ID->CssStyle = "";
			$billinglist->Client_ID->CssClass = "";
			$billinglist->Client_ID->ViewCustomAttributes = "";

			// Booking Date
			$billinglist->Booking_Date->ViewValue = $billinglist->Booking_Date->CurrentValue;
			$billinglist->Booking_Date->ViewValue = ew_FormatDateTime($billinglist->Booking_Date->ViewValue, 6);
			$billinglist->Booking_Date->CssStyle = "";
			$billinglist->Booking_Date->CssClass = "";
			$billinglist->Booking_Date->ViewCustomAttributes = "";

			// Booking Number
			$billinglist->Booking_Number->ViewValue = $billinglist->Booking_Number->CurrentValue;
			$billinglist->Booking_Number->CssStyle = "";
			$billinglist->Booking_Number->CssClass = "";
			$billinglist->Booking_Number->ViewCustomAttributes = "";

			// Date Delivered
			$billinglist->Date_Delivered->ViewValue = $billinglist->Date_Delivered->CurrentValue;
			$billinglist->Date_Delivered->ViewValue = ew_FormatDateTime($billinglist->Date_Delivered->ViewValue, 6);
			$billinglist->Date_Delivered->CssStyle = "";
			$billinglist->Date_Delivered->CssClass = "";
			$billinglist->Date_Delivered->ViewCustomAttributes = "";

			// Origin
			$billinglist->Origin->ViewValue = $billinglist->Origin->CurrentValue;
			$billinglist->Origin->CssStyle = "";
			$billinglist->Origin->CssClass = "";
			$billinglist->Origin->ViewCustomAttributes = "";

			// Customer
			$billinglist->Customer->ViewValue = $billinglist->Customer->CurrentValue;
			$billinglist->Customer->CssStyle = "";
			$billinglist->Customer->CssClass = "";
			$billinglist->Customer->ViewCustomAttributes = "";

			// Destination
			$billinglist->Destination->ViewValue = $billinglist->Destination->CurrentValue;
			$billinglist->Destination->CssStyle = "";
			$billinglist->Destination->CssClass = "";
			$billinglist->Destination->ViewCustomAttributes = "";

			// Plate Number
			$billinglist->Plate_Number->ViewValue = $billinglist->Plate_Number->CurrentValue;
			$billinglist->Plate_Number->CssStyle = "";
			$billinglist->Plate_Number->CssClass = "";
			$billinglist->Plate_Number->ViewCustomAttributes = "";

			// Truck_Type
			$billinglist->Truck_Type->ViewValue = $billinglist->Truck_Type->CurrentValue;
			$billinglist->Truck_Type->CssStyle = "";
			$billinglist->Truck_Type->CssClass = "";
			$billinglist->Truck_Type->ViewCustomAttributes = "";

			// Freight
			$billinglist->Freight->ViewValue = $billinglist->Freight->CurrentValue;
			$billinglist->Freight->ViewValue = ew_FormatNumber($billinglist->Freight->ViewValue, 2, -2, -1, -2);
			$billinglist->Freight->CssStyle = "";
			$billinglist->Freight->CssClass = "";
			$billinglist->Freight->ViewCustomAttributes = "";

			// Booking ID
			$billinglist->Booking_ID->HrefValue = "";
			$billinglist->Booking_ID->TooltipValue = "";

			// Client ID
			$billinglist->Client_ID->HrefValue = "";
			$billinglist->Client_ID->TooltipValue = "";

			// Booking Date
			$billinglist->Booking_Date->HrefValue = "";
			$billinglist->Booking_Date->TooltipValue = "";

			// Booking Number
			$billinglist->Booking_Number->HrefValue = "";
			$billinglist->Booking_Number->TooltipValue = "";

			// Date Delivered
			$billinglist->Date_Delivered->HrefValue = "";
			$billinglist->Date_Delivered->TooltipValue = "";

			// Origin
			$billinglist->Origin->HrefValue = "";
			$billinglist->Origin->TooltipValue = "";

			// Customer
			$billinglist->Customer->HrefValue = "";
			$billinglist->Customer->TooltipValue = "";

			// Destination
			$billinglist->Destination->HrefValue = "";
			$billinglist->Destination->TooltipValue = "";

			// Plate Number
			$billinglist->Plate_Number->HrefValue = "";
			$billinglist->Plate_Number->TooltipValue = "";

			// Truck_Type
			$billinglist->Truck_Type->HrefValue = "";
			$billinglist->Truck_Type->TooltipValue = "";

			// Freight
			$billinglist->Freight->HrefValue = "";
			$billinglist->Freight->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($billinglist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$billinglist->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $billinglist;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $billinglist->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($billinglist->ExportAll) {
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
		if ($billinglist->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($billinglist, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($billinglist->Booking_ID);
				$ExportDoc->ExportCaption($billinglist->Client_ID);
				$ExportDoc->ExportCaption($billinglist->Booking_Date);
				$ExportDoc->ExportCaption($billinglist->Booking_Number);
				$ExportDoc->ExportCaption($billinglist->Date_Delivered);
				$ExportDoc->ExportCaption($billinglist->Origin);
				$ExportDoc->ExportCaption($billinglist->Customer);
				$ExportDoc->ExportCaption($billinglist->Destination);
				$ExportDoc->ExportCaption($billinglist->Plate_Number);
				$ExportDoc->ExportCaption($billinglist->Truck_Type);
				$ExportDoc->ExportCaption($billinglist->Freight);
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
				$billinglist->CssClass = "";
				$billinglist->CssStyle = "";
				$billinglist->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($billinglist->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('Booking_ID', $billinglist->Booking_ID->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Client_ID', $billinglist->Client_ID->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Booking_Date', $billinglist->Booking_Date->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Booking_Number', $billinglist->Booking_Number->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Date_Delivered', $billinglist->Date_Delivered->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Origin', $billinglist->Origin->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Customer', $billinglist->Customer->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Destination', $billinglist->Destination->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Plate_Number', $billinglist->Plate_Number->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Truck_Type', $billinglist->Truck_Type->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
					$XmlDoc->AddField('Freight', $billinglist->Freight->ExportValue($billinglist->Export, $billinglist->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($billinglist->Booking_ID);
					$ExportDoc->ExportField($billinglist->Client_ID);
					$ExportDoc->ExportField($billinglist->Booking_Date);
					$ExportDoc->ExportField($billinglist->Booking_Number);
					$ExportDoc->ExportField($billinglist->Date_Delivered);
					$ExportDoc->ExportField($billinglist->Origin);
					$ExportDoc->ExportField($billinglist->Customer);
					$ExportDoc->ExportField($billinglist->Destination);
					$ExportDoc->ExportField($billinglist->Plate_Number);
					$ExportDoc->ExportField($billinglist->Truck_Type);
					$ExportDoc->ExportField($billinglist->Freight);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($billinglist->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($billinglist->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($billinglist->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($billinglist->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($billinglist->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $billinglist;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "clients") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $billinglist->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $billinglist->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$billinglist->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$billinglist->Client_ID->setSessionValue($billinglist->Client_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["clients"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["clients"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($GLOBALS["clients"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$billinglist->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$billinglist->setStartRecordNumber($this->lStartRec);
			$billinglist->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$billinglist->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($billinglist->Client_ID->QueryStringValue == "") $billinglist->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $billinglist->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $billinglist->getDetailFilter(); // Restore detail filter
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
