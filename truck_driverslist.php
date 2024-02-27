<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "truck_driversinfo.php" ?>
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
$truck_drivers_list = new ctruck_drivers_list();
$Page =& $truck_drivers_list;

// Page init
$truck_drivers_list->Page_Init();

// Page main
$truck_drivers_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($truck_drivers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var truck_drivers_list = new ew_Page("truck_drivers_list");

// page properties
truck_drivers_list.PageID = "list"; // page ID
truck_drivers_list.FormID = "ftruck_driverslist"; // form ID
var EW_PAGE_ID = truck_drivers_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
truck_drivers_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
truck_drivers_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
truck_drivers_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($truck_drivers->Export == "") { ?>
<?php
$gsMasterReturnUrl = "subconslist.php";
if ($truck_drivers_list->sDbMasterFilter <> "" && $truck_drivers->getCurrentMasterTable() == "subcons") {
	if ($truck_drivers_list->bMasterRecordExists) {
		if ($truck_drivers->getCurrentMasterTable() == $truck_drivers->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$truck_drivers_list->lTotalRecs = $truck_drivers->SelectRecordCount();
	} else {
		if ($rs = $truck_drivers_list->LoadRecordset())
			$truck_drivers_list->lTotalRecs = $rs->RecordCount();
	}
	$truck_drivers_list->lStartRec = 1;
	if ($truck_drivers_list->lDisplayRecs <= 0 || ($truck_drivers->Export <> "" && $truck_drivers->ExportAll)) // Display all records
		$truck_drivers_list->lDisplayRecs = $truck_drivers_list->lTotalRecs;
	if (!($truck_drivers->Export <> "" && $truck_drivers->ExportAll))
		$truck_drivers_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $truck_drivers_list->LoadRecordset($truck_drivers_list->lStartRec-1, $truck_drivers_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $truck_drivers->TableCaption() ?>
<?php if ($truck_drivers->Export == "" && $truck_drivers->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $truck_drivers_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $truck_drivers_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $truck_drivers_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($truck_drivers->Export == "" && $truck_drivers->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(truck_drivers_list);" style="text-decoration: none;"><img id="truck_drivers_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="truck_drivers_list_SearchPanel">
<form name="ftruck_driverslistsrch" id="ftruck_driverslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="truck_drivers">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($truck_drivers->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $truck_drivers_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($truck_drivers->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($truck_drivers->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($truck_drivers->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$truck_drivers_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($truck_drivers->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($truck_drivers->CurrentAction <> "gridadd" && $truck_drivers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($truck_drivers_list->Pager)) $truck_drivers_list->Pager = new cPrevNextPager($truck_drivers_list->lStartRec, $truck_drivers_list->lDisplayRecs, $truck_drivers_list->lTotalRecs) ?>
<?php if ($truck_drivers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($truck_drivers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $truck_drivers_list->PageUrl() ?>start=<?php echo $truck_drivers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($truck_drivers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $truck_drivers_list->PageUrl() ?>start=<?php echo $truck_drivers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $truck_drivers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($truck_drivers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $truck_drivers_list->PageUrl() ?>start=<?php echo $truck_drivers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($truck_drivers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $truck_drivers_list->PageUrl() ?>start=<?php echo $truck_drivers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $truck_drivers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $truck_drivers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $truck_drivers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $truck_drivers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($truck_drivers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($truck_drivers_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="truck_drivers">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($truck_drivers_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($truck_drivers_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($truck_drivers_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($truck_drivers_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($truck_drivers_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($truck_drivers_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($truck_drivers->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $truck_drivers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftruck_driverslist" id="ftruck_driverslist" class="ewForm" action="" method="post">
<div id="gmp_truck_drivers" class="ewGridMiddlePanel">
<?php if ($truck_drivers_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $truck_drivers->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$truck_drivers_list->RenderListOptions();

// Render list options (header, left)
$truck_drivers_list->ListOptions->Render("header", "left");
?>
<?php if ($truck_drivers->id->Visible) { // id ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->id) == "") { ?>
		<td><?php echo $truck_drivers->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($truck_drivers->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->Subcon_ID->Visible) { // Subcon_ID ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->Subcon_ID) == "") { ?>
		<td><?php echo $truck_drivers->Subcon_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->Subcon_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->Subcon_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($truck_drivers->Subcon_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->Subcon_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->Truck_Driver->Visible) { // Truck_Driver ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->Truck_Driver) == "") { ?>
		<td><?php echo $truck_drivers->Truck_Driver->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->Truck_Driver) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->Truck_Driver->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($truck_drivers->Truck_Driver->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->Truck_Driver->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->Address->Visible) { // Address ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->Address) == "") { ?>
		<td><?php echo $truck_drivers->Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($truck_drivers->Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->Contact_No->Visible) { // Contact_No ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->Contact_No) == "") { ?>
		<td><?php echo $truck_drivers->Contact_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->Contact_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->Contact_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($truck_drivers->Contact_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->Contact_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->Email_Address->Visible) { // Email_Address ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->Email_Address) == "") { ?>
		<td><?php echo $truck_drivers->Email_Address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->Email_Address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->Email_Address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($truck_drivers->Email_Address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->Email_Address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->Driver_License_No->Visible) { // Driver_License_No ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->Driver_License_No) == "") { ?>
		<td><?php echo $truck_drivers->Driver_License_No->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->Driver_License_No) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->Driver_License_No->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($truck_drivers->Driver_License_No->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->Driver_License_No->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->License_Expiration_Date->Visible) { // License_Expiration_Date ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->License_Expiration_Date) == "") { ?>
		<td><?php echo $truck_drivers->License_Expiration_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->License_Expiration_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->License_Expiration_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($truck_drivers->License_Expiration_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->License_Expiration_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->File_Upload->Visible) { // File_Upload ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->File_Upload) == "") { ?>
		<td><?php echo $truck_drivers->File_Upload->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->File_Upload) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->File_Upload->FldCaption() ?></td><td style="width: 10px;"><?php if ($truck_drivers->File_Upload->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->File_Upload->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($truck_drivers->Remarks->Visible) { // Remarks ?>
	<?php if ($truck_drivers->SortUrl($truck_drivers->Remarks) == "") { ?>
		<td><?php echo $truck_drivers->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $truck_drivers->SortUrl($truck_drivers->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $truck_drivers->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($truck_drivers->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($truck_drivers->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$truck_drivers_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($truck_drivers->ExportAll && $truck_drivers->Export <> "") {
	$truck_drivers_list->lStopRec = $truck_drivers_list->lTotalRecs;
} else {
	$truck_drivers_list->lStopRec = $truck_drivers_list->lStartRec + $truck_drivers_list->lDisplayRecs - 1; // Set the last record to display
}
$truck_drivers_list->lRecCount = $truck_drivers_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $truck_drivers_list->lStartRec > 1)
		$rs->Move($truck_drivers_list->lStartRec - 1);
}

// Initialize aggregate
$truck_drivers->RowType = EW_ROWTYPE_AGGREGATEINIT;
$truck_drivers_list->RenderRow();
$truck_drivers_list->lRowCnt = 0;
while (($truck_drivers->CurrentAction == "gridadd" || !$rs->EOF) &&
	$truck_drivers_list->lRecCount < $truck_drivers_list->lStopRec) {
	$truck_drivers_list->lRecCount++;
	if (intval($truck_drivers_list->lRecCount) >= intval($truck_drivers_list->lStartRec)) {
		$truck_drivers_list->lRowCnt++;

	// Init row class and style
	$truck_drivers->CssClass = "";
	$truck_drivers->CssStyle = "";
	$truck_drivers->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($truck_drivers->CurrentAction == "gridadd") {
		$truck_drivers_list->LoadDefaultValues(); // Load default values
	} else {
		$truck_drivers_list->LoadRowValues($rs); // Load row values
	}
	$truck_drivers->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$truck_drivers_list->RenderRow();

	// Render list options
	$truck_drivers_list->RenderListOptions();
?>
	<tr<?php echo $truck_drivers->RowAttributes() ?>>
<?php

// Render list options (body, left)
$truck_drivers_list->ListOptions->Render("body", "left");
?>
	<?php if ($truck_drivers->id->Visible) { // id ?>
		<td<?php echo $truck_drivers->id->CellAttributes() ?>>
<div<?php echo $truck_drivers->id->ViewAttributes() ?>><?php echo $truck_drivers->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($truck_drivers->Subcon_ID->Visible) { // Subcon_ID ?>
		<td<?php echo $truck_drivers->Subcon_ID->CellAttributes() ?>>
<div<?php echo $truck_drivers->Subcon_ID->ViewAttributes() ?>><?php echo $truck_drivers->Subcon_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($truck_drivers->Truck_Driver->Visible) { // Truck_Driver ?>
		<td<?php echo $truck_drivers->Truck_Driver->CellAttributes() ?>>
<div<?php echo $truck_drivers->Truck_Driver->ViewAttributes() ?>><?php echo $truck_drivers->Truck_Driver->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($truck_drivers->Address->Visible) { // Address ?>
		<td<?php echo $truck_drivers->Address->CellAttributes() ?>>
<div<?php echo $truck_drivers->Address->ViewAttributes() ?>><?php echo $truck_drivers->Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($truck_drivers->Contact_No->Visible) { // Contact_No ?>
		<td<?php echo $truck_drivers->Contact_No->CellAttributes() ?>>
<div<?php echo $truck_drivers->Contact_No->ViewAttributes() ?>><?php echo $truck_drivers->Contact_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($truck_drivers->Email_Address->Visible) { // Email_Address ?>
		<td<?php echo $truck_drivers->Email_Address->CellAttributes() ?>>
<div<?php echo $truck_drivers->Email_Address->ViewAttributes() ?>><?php echo $truck_drivers->Email_Address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($truck_drivers->Driver_License_No->Visible) { // Driver_License_No ?>
		<td<?php echo $truck_drivers->Driver_License_No->CellAttributes() ?>>
<div<?php echo $truck_drivers->Driver_License_No->ViewAttributes() ?>><?php echo $truck_drivers->Driver_License_No->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($truck_drivers->License_Expiration_Date->Visible) { // License_Expiration_Date ?>
		<td<?php echo $truck_drivers->License_Expiration_Date->CellAttributes() ?>>
<div<?php echo $truck_drivers->License_Expiration_Date->ViewAttributes() ?>><?php echo $truck_drivers->License_Expiration_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($truck_drivers->File_Upload->Visible) { // File_Upload ?>
		<td<?php echo $truck_drivers->File_Upload->CellAttributes() ?>>
<?php if ($truck_drivers->File_Upload->HrefValue <> "" || $truck_drivers->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($truck_drivers->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $truck_drivers->File_Upload->HrefValue ?>"><?php echo $truck_drivers->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($truck_drivers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($truck_drivers->File_Upload->Upload->DbValue)) { ?>
<?php echo $truck_drivers->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($truck_drivers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($truck_drivers->Remarks->Visible) { // Remarks ?>
		<td<?php echo $truck_drivers->Remarks->CellAttributes() ?>>
<div<?php echo $truck_drivers->Remarks->ViewAttributes() ?>><?php echo $truck_drivers->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$truck_drivers_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($truck_drivers->CurrentAction <> "gridadd")
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
<?php if ($truck_drivers_list->lTotalRecs > 0) { ?>
<?php if ($truck_drivers->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($truck_drivers->CurrentAction <> "gridadd" && $truck_drivers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($truck_drivers_list->Pager)) $truck_drivers_list->Pager = new cPrevNextPager($truck_drivers_list->lStartRec, $truck_drivers_list->lDisplayRecs, $truck_drivers_list->lTotalRecs) ?>
<?php if ($truck_drivers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($truck_drivers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $truck_drivers_list->PageUrl() ?>start=<?php echo $truck_drivers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($truck_drivers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $truck_drivers_list->PageUrl() ?>start=<?php echo $truck_drivers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $truck_drivers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($truck_drivers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $truck_drivers_list->PageUrl() ?>start=<?php echo $truck_drivers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($truck_drivers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $truck_drivers_list->PageUrl() ?>start=<?php echo $truck_drivers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $truck_drivers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $truck_drivers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $truck_drivers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $truck_drivers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($truck_drivers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($truck_drivers_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="truck_drivers">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($truck_drivers_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($truck_drivers_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($truck_drivers_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($truck_drivers_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($truck_drivers_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($truck_drivers_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($truck_drivers->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($truck_drivers_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $truck_drivers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($truck_drivers->Export == "" && $truck_drivers->CurrentAction == "") { ?>
<?php } ?>
<?php if ($truck_drivers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$truck_drivers_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctruck_drivers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'truck_drivers';

	// Page object name
	var $PageObjName = 'truck_drivers_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $truck_drivers;
		if ($truck_drivers->UseTokenInUrl) $PageUrl .= "t=" . $truck_drivers->TableVar . "&"; // Add page token
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
		global $objForm, $truck_drivers;
		if ($truck_drivers->UseTokenInUrl) {
			if ($objForm)
				return ($truck_drivers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($truck_drivers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctruck_drivers_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (truck_drivers)
		$GLOBALS["truck_drivers"] = new ctruck_drivers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["truck_drivers"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "truck_driversdelete.php";
		$this->MultiUpdateUrl = "truck_driversupdate.php";

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'truck_drivers', TRUE);

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
		global $truck_drivers;

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
			$truck_drivers->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$truck_drivers->Export = $_POST["exporttype"];
		} else {
			$truck_drivers->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $truck_drivers->Export; // Get export parameter, used in header
		$gsExportFile = $truck_drivers->TableVar; // Get export file, used in header
		if ($truck_drivers->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $truck_drivers;

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
			$truck_drivers->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($truck_drivers->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $truck_drivers->getRecordsPerPage(); // Restore from Session
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
		$truck_drivers->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$truck_drivers->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$truck_drivers->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $truck_drivers->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $truck_drivers->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $truck_drivers->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($truck_drivers->getMasterFilter() <> "" && $truck_drivers->getCurrentMasterTable() == "subcons") {
			global $subcons;
			$rsmaster = $subcons->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$truck_drivers->setMasterFilter(""); // Clear master filter
				$truck_drivers->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($truck_drivers->getReturnUrl()); // Return to caller
			} else {
				$subcons->LoadListRowValues($rsmaster);
				$subcons->RowType = EW_ROWTYPE_MASTER; // Master row
				$subcons->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$truck_drivers->setSessionWhere($sFilter);
		$truck_drivers->CurrentFilter = "";

		// Export data only
		if (in_array($truck_drivers->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($truck_drivers->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $truck_drivers;
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
			$truck_drivers->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$truck_drivers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $truck_drivers;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $truck_drivers->Truck_Driver, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $truck_drivers->Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $truck_drivers->Contact_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $truck_drivers->Email_Address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $truck_drivers->Driver_License_No, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $truck_drivers->File_Upload, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $truck_drivers->Remarks, $Keyword);
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
		global $Security, $truck_drivers;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $truck_drivers->BasicSearchKeyword;
		$sSearchType = $truck_drivers->BasicSearchType;
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
			$truck_drivers->setSessionBasicSearchKeyword($sSearchKeyword);
			$truck_drivers->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $truck_drivers;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$truck_drivers->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $truck_drivers;
		$truck_drivers->setSessionBasicSearchKeyword("");
		$truck_drivers->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $truck_drivers;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$truck_drivers->BasicSearchKeyword = $truck_drivers->getSessionBasicSearchKeyword();
			$truck_drivers->BasicSearchType = $truck_drivers->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $truck_drivers;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$truck_drivers->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$truck_drivers->CurrentOrderType = @$_GET["ordertype"];
			$truck_drivers->UpdateSort($truck_drivers->id); // id
			$truck_drivers->UpdateSort($truck_drivers->Subcon_ID); // Subcon_ID
			$truck_drivers->UpdateSort($truck_drivers->Truck_Driver); // Truck_Driver
			$truck_drivers->UpdateSort($truck_drivers->Address); // Address
			$truck_drivers->UpdateSort($truck_drivers->Contact_No); // Contact_No
			$truck_drivers->UpdateSort($truck_drivers->Email_Address); // Email_Address
			$truck_drivers->UpdateSort($truck_drivers->Driver_License_No); // Driver_License_No
			$truck_drivers->UpdateSort($truck_drivers->License_Expiration_Date); // License_Expiration_Date
			$truck_drivers->UpdateSort($truck_drivers->File_Upload); // File_Upload
			$truck_drivers->UpdateSort($truck_drivers->Remarks); // Remarks
			$truck_drivers->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $truck_drivers;
		$sOrderBy = $truck_drivers->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($truck_drivers->SqlOrderBy() <> "") {
				$sOrderBy = $truck_drivers->SqlOrderBy();
				$truck_drivers->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $truck_drivers;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$truck_drivers->getCurrentMasterTable = ""; // Clear master table
				$truck_drivers->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$truck_drivers->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$truck_drivers->Subcon_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$truck_drivers->setSessionOrderBy($sOrderBy);
				$truck_drivers->id->setSort("");
				$truck_drivers->Subcon_ID->setSort("");
				$truck_drivers->Truck_Driver->setSort("");
				$truck_drivers->Address->setSort("");
				$truck_drivers->Contact_No->setSort("");
				$truck_drivers->Email_Address->setSort("");
				$truck_drivers->Driver_License_No->setSort("");
				$truck_drivers->License_Expiration_Date->setSort("");
				$truck_drivers->File_Upload->setSort("");
				$truck_drivers->Remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$truck_drivers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $truck_drivers;

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
		if ($truck_drivers->Export <> "" ||
			$truck_drivers->CurrentAction == "gridadd" ||
			$truck_drivers->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $truck_drivers;
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
		global $Security, $Language, $truck_drivers;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $truck_drivers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$truck_drivers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$truck_drivers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $truck_drivers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$truck_drivers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$truck_drivers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$truck_drivers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $truck_drivers;
		$truck_drivers->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$truck_drivers->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $truck_drivers;

		// Call Recordset Selecting event
		$truck_drivers->Recordset_Selecting($truck_drivers->CurrentFilter);

		// Load List page SQL
		$sSql = $truck_drivers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$truck_drivers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $truck_drivers;
		$sFilter = $truck_drivers->KeyFilter();

		// Call Row Selecting event
		$truck_drivers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$truck_drivers->CurrentFilter = $sFilter;
		$sSql = $truck_drivers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$truck_drivers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $truck_drivers;
		$truck_drivers->id->setDbValue($rs->fields('id'));
		$truck_drivers->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$truck_drivers->Truck_Driver->setDbValue($rs->fields('Truck_Driver'));
		$truck_drivers->Address->setDbValue($rs->fields('Address'));
		$truck_drivers->Contact_No->setDbValue($rs->fields('Contact_No'));
		$truck_drivers->Email_Address->setDbValue($rs->fields('Email_Address'));
		$truck_drivers->Driver_License_No->setDbValue($rs->fields('Driver_License_No'));
		$truck_drivers->License_Expiration_Date->setDbValue($rs->fields('License_Expiration_Date'));
		$truck_drivers->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$truck_drivers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $truck_drivers;

		// Initialize URLs
		$this->ViewUrl = $truck_drivers->ViewUrl();
		$this->EditUrl = $truck_drivers->EditUrl();
		$this->InlineEditUrl = $truck_drivers->InlineEditUrl();
		$this->CopyUrl = $truck_drivers->CopyUrl();
		$this->InlineCopyUrl = $truck_drivers->InlineCopyUrl();
		$this->DeleteUrl = $truck_drivers->DeleteUrl();

		// Call Row_Rendering event
		$truck_drivers->Row_Rendering();

		// Common render codes for all row types
		// id

		$truck_drivers->id->CellCssStyle = ""; $truck_drivers->id->CellCssClass = "";
		$truck_drivers->id->CellAttrs = array(); $truck_drivers->id->ViewAttrs = array(); $truck_drivers->id->EditAttrs = array();

		// Subcon_ID
		$truck_drivers->Subcon_ID->CellCssStyle = ""; $truck_drivers->Subcon_ID->CellCssClass = "";
		$truck_drivers->Subcon_ID->CellAttrs = array(); $truck_drivers->Subcon_ID->ViewAttrs = array(); $truck_drivers->Subcon_ID->EditAttrs = array();

		// Truck_Driver
		$truck_drivers->Truck_Driver->CellCssStyle = ""; $truck_drivers->Truck_Driver->CellCssClass = "";
		$truck_drivers->Truck_Driver->CellAttrs = array(); $truck_drivers->Truck_Driver->ViewAttrs = array(); $truck_drivers->Truck_Driver->EditAttrs = array();

		// Address
		$truck_drivers->Address->CellCssStyle = ""; $truck_drivers->Address->CellCssClass = "";
		$truck_drivers->Address->CellAttrs = array(); $truck_drivers->Address->ViewAttrs = array(); $truck_drivers->Address->EditAttrs = array();

		// Contact_No
		$truck_drivers->Contact_No->CellCssStyle = ""; $truck_drivers->Contact_No->CellCssClass = "";
		$truck_drivers->Contact_No->CellAttrs = array(); $truck_drivers->Contact_No->ViewAttrs = array(); $truck_drivers->Contact_No->EditAttrs = array();

		// Email_Address
		$truck_drivers->Email_Address->CellCssStyle = ""; $truck_drivers->Email_Address->CellCssClass = "";
		$truck_drivers->Email_Address->CellAttrs = array(); $truck_drivers->Email_Address->ViewAttrs = array(); $truck_drivers->Email_Address->EditAttrs = array();

		// Driver_License_No
		$truck_drivers->Driver_License_No->CellCssStyle = ""; $truck_drivers->Driver_License_No->CellCssClass = "";
		$truck_drivers->Driver_License_No->CellAttrs = array(); $truck_drivers->Driver_License_No->ViewAttrs = array(); $truck_drivers->Driver_License_No->EditAttrs = array();

		// License_Expiration_Date
		$truck_drivers->License_Expiration_Date->CellCssStyle = ""; $truck_drivers->License_Expiration_Date->CellCssClass = "";
		$truck_drivers->License_Expiration_Date->CellAttrs = array(); $truck_drivers->License_Expiration_Date->ViewAttrs = array(); $truck_drivers->License_Expiration_Date->EditAttrs = array();

		// File_Upload
		$truck_drivers->File_Upload->CellCssStyle = ""; $truck_drivers->File_Upload->CellCssClass = "";
		$truck_drivers->File_Upload->CellAttrs = array(); $truck_drivers->File_Upload->ViewAttrs = array(); $truck_drivers->File_Upload->EditAttrs = array();

		// Remarks
		$truck_drivers->Remarks->CellCssStyle = ""; $truck_drivers->Remarks->CellCssClass = "";
		$truck_drivers->Remarks->CellAttrs = array(); $truck_drivers->Remarks->ViewAttrs = array(); $truck_drivers->Remarks->EditAttrs = array();
		if ($truck_drivers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$truck_drivers->id->ViewValue = $truck_drivers->id->CurrentValue;
			$truck_drivers->id->CssStyle = "";
			$truck_drivers->id->CssClass = "";
			$truck_drivers->id->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($truck_drivers->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($truck_drivers->Subcon_ID->CurrentValue) . "";
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
					$truck_drivers->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$truck_drivers->Subcon_ID->ViewValue = $truck_drivers->Subcon_ID->CurrentValue;
				}
			} else {
				$truck_drivers->Subcon_ID->ViewValue = NULL;
			}
			$truck_drivers->Subcon_ID->CssStyle = "";
			$truck_drivers->Subcon_ID->CssClass = "";
			$truck_drivers->Subcon_ID->ViewCustomAttributes = "";

			// Truck_Driver
			$truck_drivers->Truck_Driver->ViewValue = $truck_drivers->Truck_Driver->CurrentValue;
			$truck_drivers->Truck_Driver->CssStyle = "";
			$truck_drivers->Truck_Driver->CssClass = "";
			$truck_drivers->Truck_Driver->ViewCustomAttributes = "";

			// Address
			$truck_drivers->Address->ViewValue = $truck_drivers->Address->CurrentValue;
			$truck_drivers->Address->CssStyle = "";
			$truck_drivers->Address->CssClass = "";
			$truck_drivers->Address->ViewCustomAttributes = "";

			// Contact_No
			$truck_drivers->Contact_No->ViewValue = $truck_drivers->Contact_No->CurrentValue;
			$truck_drivers->Contact_No->CssStyle = "";
			$truck_drivers->Contact_No->CssClass = "";
			$truck_drivers->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$truck_drivers->Email_Address->ViewValue = $truck_drivers->Email_Address->CurrentValue;
			$truck_drivers->Email_Address->CssStyle = "";
			$truck_drivers->Email_Address->CssClass = "";
			$truck_drivers->Email_Address->ViewCustomAttributes = "";

			// Driver_License_No
			$truck_drivers->Driver_License_No->ViewValue = $truck_drivers->Driver_License_No->CurrentValue;
			$truck_drivers->Driver_License_No->CssStyle = "";
			$truck_drivers->Driver_License_No->CssClass = "";
			$truck_drivers->Driver_License_No->ViewCustomAttributes = "";

			// License_Expiration_Date
			$truck_drivers->License_Expiration_Date->ViewValue = $truck_drivers->License_Expiration_Date->CurrentValue;
			$truck_drivers->License_Expiration_Date->ViewValue = ew_FormatDateTime($truck_drivers->License_Expiration_Date->ViewValue, 6);
			$truck_drivers->License_Expiration_Date->CssStyle = "";
			$truck_drivers->License_Expiration_Date->CssClass = "";
			$truck_drivers->License_Expiration_Date->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($truck_drivers->File_Upload->Upload->DbValue)) {
				$truck_drivers->File_Upload->ViewValue = $truck_drivers->File_Upload->Upload->DbValue;
			} else {
				$truck_drivers->File_Upload->ViewValue = "";
			}
			$truck_drivers->File_Upload->CssStyle = "";
			$truck_drivers->File_Upload->CssClass = "";
			$truck_drivers->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$truck_drivers->Remarks->ViewValue = $truck_drivers->Remarks->CurrentValue;
			$truck_drivers->Remarks->CssStyle = "";
			$truck_drivers->Remarks->CssClass = "";
			$truck_drivers->Remarks->ViewCustomAttributes = "";

			// id
			$truck_drivers->id->HrefValue = "";
			$truck_drivers->id->TooltipValue = "";

			// Subcon_ID
			$truck_drivers->Subcon_ID->HrefValue = "";
			$truck_drivers->Subcon_ID->TooltipValue = "";

			// Truck_Driver
			$truck_drivers->Truck_Driver->HrefValue = "";
			$truck_drivers->Truck_Driver->TooltipValue = "";

			// Address
			$truck_drivers->Address->HrefValue = "";
			$truck_drivers->Address->TooltipValue = "";

			// Contact_No
			$truck_drivers->Contact_No->HrefValue = "";
			$truck_drivers->Contact_No->TooltipValue = "";

			// Email_Address
			$truck_drivers->Email_Address->HrefValue = "";
			$truck_drivers->Email_Address->TooltipValue = "";

			// Driver_License_No
			$truck_drivers->Driver_License_No->HrefValue = "";
			$truck_drivers->Driver_License_No->TooltipValue = "";

			// License_Expiration_Date
			$truck_drivers->License_Expiration_Date->HrefValue = "";
			$truck_drivers->License_Expiration_Date->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($truck_drivers->File_Upload->Upload->DbValue)) {
				$truck_drivers->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $truck_drivers->File_Upload->UploadPath) . ((!empty($truck_drivers->File_Upload->ViewValue)) ? $truck_drivers->File_Upload->ViewValue : $truck_drivers->File_Upload->CurrentValue);
				if ($truck_drivers->Export <> "") $truck_drivers->File_Upload->HrefValue = ew_ConvertFullUrl($truck_drivers->File_Upload->HrefValue);
			} else {
				$truck_drivers->File_Upload->HrefValue = "";
			}
			$truck_drivers->File_Upload->TooltipValue = "";

			// Remarks
			$truck_drivers->Remarks->HrefValue = "";
			$truck_drivers->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($truck_drivers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$truck_drivers->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $truck_drivers;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $truck_drivers->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($truck_drivers->ExportAll) {
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
		if ($truck_drivers->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($truck_drivers, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($truck_drivers->id);
				$ExportDoc->ExportCaption($truck_drivers->Subcon_ID);
				$ExportDoc->ExportCaption($truck_drivers->Truck_Driver);
				$ExportDoc->ExportCaption($truck_drivers->Address);
				$ExportDoc->ExportCaption($truck_drivers->Contact_No);
				$ExportDoc->ExportCaption($truck_drivers->Email_Address);
				$ExportDoc->ExportCaption($truck_drivers->Driver_License_No);
				$ExportDoc->ExportCaption($truck_drivers->License_Expiration_Date);
				$ExportDoc->ExportCaption($truck_drivers->File_Upload);
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
				$truck_drivers->CssClass = "";
				$truck_drivers->CssStyle = "";
				$truck_drivers->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($truck_drivers->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $truck_drivers->id->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
					$XmlDoc->AddField('Subcon_ID', $truck_drivers->Subcon_ID->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
					$XmlDoc->AddField('Truck_Driver', $truck_drivers->Truck_Driver->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
					$XmlDoc->AddField('Address', $truck_drivers->Address->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
					$XmlDoc->AddField('Contact_No', $truck_drivers->Contact_No->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
					$XmlDoc->AddField('Email_Address', $truck_drivers->Email_Address->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
					$XmlDoc->AddField('Driver_License_No', $truck_drivers->Driver_License_No->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
					$XmlDoc->AddField('License_Expiration_Date', $truck_drivers->License_Expiration_Date->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
					$XmlDoc->AddField('File_Upload', $truck_drivers->File_Upload->ExportValue($truck_drivers->Export, $truck_drivers->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($truck_drivers->id);
					$ExportDoc->ExportField($truck_drivers->Subcon_ID);
					$ExportDoc->ExportField($truck_drivers->Truck_Driver);
					$ExportDoc->ExportField($truck_drivers->Address);
					$ExportDoc->ExportField($truck_drivers->Contact_No);
					$ExportDoc->ExportField($truck_drivers->Email_Address);
					$ExportDoc->ExportField($truck_drivers->Driver_License_No);
					$ExportDoc->ExportField($truck_drivers->License_Expiration_Date);
					$ExportDoc->ExportField($truck_drivers->File_Upload);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($truck_drivers->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($truck_drivers->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($truck_drivers->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($truck_drivers->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($truck_drivers->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $truck_drivers;
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
				$this->sDbMasterFilter = $truck_drivers->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $truck_drivers->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$truck_drivers->Subcon_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$truck_drivers->Subcon_ID->setSessionValue($truck_drivers->Subcon_ID->QueryStringValue);
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
			$truck_drivers->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$truck_drivers->setStartRecordNumber($this->lStartRec);
			$truck_drivers->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$truck_drivers->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($truck_drivers->Subcon_ID->QueryStringValue == "") $truck_drivers->Subcon_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $truck_drivers->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $truck_drivers->getDetailFilter(); // Restore detail filter
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
