<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "booking_helpersinfo.php" ?>
<?php include "bookingsinfo.php" ?>
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
$booking_helpers_list = new cbooking_helpers_list();
$Page =& $booking_helpers_list;

// Page init
$booking_helpers_list->Page_Init();

// Page main
$booking_helpers_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($booking_helpers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var booking_helpers_list = new ew_Page("booking_helpers_list");

// page properties
booking_helpers_list.PageID = "list"; // page ID
booking_helpers_list.FormID = "fbooking_helperslist"; // form ID
var EW_PAGE_ID = booking_helpers_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
booking_helpers_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
booking_helpers_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
booking_helpers_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($booking_helpers->Export == "") { ?>
<?php
$gsMasterReturnUrl = "bookingslist.php";
if ($booking_helpers_list->sDbMasterFilter <> "" && $booking_helpers->getCurrentMasterTable() == "bookings") {
	if ($booking_helpers_list->bMasterRecordExists) {
		if ($booking_helpers->getCurrentMasterTable() == $booking_helpers->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "bookingsmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$booking_helpers_list->lTotalRecs = $booking_helpers->SelectRecordCount();
	} else {
		if ($rs = $booking_helpers_list->LoadRecordset())
			$booking_helpers_list->lTotalRecs = $rs->RecordCount();
	}
	$booking_helpers_list->lStartRec = 1;
	if ($booking_helpers_list->lDisplayRecs <= 0 || ($booking_helpers->Export <> "" && $booking_helpers->ExportAll)) // Display all records
		$booking_helpers_list->lDisplayRecs = $booking_helpers_list->lTotalRecs;
	if (!($booking_helpers->Export <> "" && $booking_helpers->ExportAll))
		$booking_helpers_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $booking_helpers_list->LoadRecordset($booking_helpers_list->lStartRec-1, $booking_helpers_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $booking_helpers->TableCaption() ?>
<?php if ($booking_helpers->Export == "" && $booking_helpers->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $booking_helpers_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $booking_helpers_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $booking_helpers_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$booking_helpers_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($booking_helpers->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($booking_helpers->CurrentAction <> "gridadd" && $booking_helpers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($booking_helpers_list->Pager)) $booking_helpers_list->Pager = new cPrevNextPager($booking_helpers_list->lStartRec, $booking_helpers_list->lDisplayRecs, $booking_helpers_list->lTotalRecs) ?>
<?php if ($booking_helpers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($booking_helpers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $booking_helpers_list->PageUrl() ?>start=<?php echo $booking_helpers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($booking_helpers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $booking_helpers_list->PageUrl() ?>start=<?php echo $booking_helpers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $booking_helpers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($booking_helpers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $booking_helpers_list->PageUrl() ?>start=<?php echo $booking_helpers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($booking_helpers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $booking_helpers_list->PageUrl() ?>start=<?php echo $booking_helpers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $booking_helpers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $booking_helpers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $booking_helpers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $booking_helpers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($booking_helpers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($booking_helpers_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="booking_helpers">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($booking_helpers_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($booking_helpers_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($booking_helpers_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($booking_helpers_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($booking_helpers_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($booking_helpers_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($booking_helpers->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $booking_helpers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fbooking_helperslist" id="fbooking_helperslist" class="ewForm" action="" method="post">
<div id="gmp_booking_helpers" class="ewGridMiddlePanel">
<?php if ($booking_helpers_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $booking_helpers->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$booking_helpers_list->RenderListOptions();

// Render list options (header, left)
$booking_helpers_list->ListOptions->Render("header", "left");
?>
<?php if ($booking_helpers->id->Visible) { // id ?>
	<?php if ($booking_helpers->SortUrl($booking_helpers->id) == "") { ?>
		<td><?php echo $booking_helpers->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $booking_helpers->SortUrl($booking_helpers->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $booking_helpers->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($booking_helpers->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($booking_helpers->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($booking_helpers->Booking_ID->Visible) { // Booking_ID ?>
	<?php if ($booking_helpers->SortUrl($booking_helpers->Booking_ID) == "") { ?>
		<td><?php echo $booking_helpers->Booking_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $booking_helpers->SortUrl($booking_helpers->Booking_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $booking_helpers->Booking_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($booking_helpers->Booking_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($booking_helpers->Booking_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($booking_helpers->Helper_ID->Visible) { // Helper_ID ?>
	<?php if ($booking_helpers->SortUrl($booking_helpers->Helper_ID) == "") { ?>
		<td><?php echo $booking_helpers->Helper_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $booking_helpers->SortUrl($booking_helpers->Helper_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $booking_helpers->Helper_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($booking_helpers->Helper_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($booking_helpers->Helper_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$booking_helpers_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($booking_helpers->ExportAll && $booking_helpers->Export <> "") {
	$booking_helpers_list->lStopRec = $booking_helpers_list->lTotalRecs;
} else {
	$booking_helpers_list->lStopRec = $booking_helpers_list->lStartRec + $booking_helpers_list->lDisplayRecs - 1; // Set the last record to display
}
$booking_helpers_list->lRecCount = $booking_helpers_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $booking_helpers_list->lStartRec > 1)
		$rs->Move($booking_helpers_list->lStartRec - 1);
}

// Initialize aggregate
$booking_helpers->RowType = EW_ROWTYPE_AGGREGATEINIT;
$booking_helpers_list->RenderRow();
$booking_helpers_list->lRowCnt = 0;
while (($booking_helpers->CurrentAction == "gridadd" || !$rs->EOF) &&
	$booking_helpers_list->lRecCount < $booking_helpers_list->lStopRec) {
	$booking_helpers_list->lRecCount++;
	if (intval($booking_helpers_list->lRecCount) >= intval($booking_helpers_list->lStartRec)) {
		$booking_helpers_list->lRowCnt++;

	// Init row class and style
	$booking_helpers->CssClass = "";
	$booking_helpers->CssStyle = "";
	$booking_helpers->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($booking_helpers->CurrentAction == "gridadd") {
		$booking_helpers_list->LoadDefaultValues(); // Load default values
	} else {
		$booking_helpers_list->LoadRowValues($rs); // Load row values
	}
	$booking_helpers->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$booking_helpers_list->RenderRow();

	// Render list options
	$booking_helpers_list->RenderListOptions();
?>
	<tr<?php echo $booking_helpers->RowAttributes() ?>>
<?php

// Render list options (body, left)
$booking_helpers_list->ListOptions->Render("body", "left");
?>
	<?php if ($booking_helpers->id->Visible) { // id ?>
		<td<?php echo $booking_helpers->id->CellAttributes() ?>>
<div<?php echo $booking_helpers->id->ViewAttributes() ?>><?php echo $booking_helpers->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($booking_helpers->Booking_ID->Visible) { // Booking_ID ?>
		<td<?php echo $booking_helpers->Booking_ID->CellAttributes() ?>>
<div<?php echo $booking_helpers->Booking_ID->ViewAttributes() ?>><?php echo $booking_helpers->Booking_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($booking_helpers->Helper_ID->Visible) { // Helper_ID ?>
		<td<?php echo $booking_helpers->Helper_ID->CellAttributes() ?>>
<div<?php echo $booking_helpers->Helper_ID->ViewAttributes() ?>><?php echo $booking_helpers->Helper_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$booking_helpers_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($booking_helpers->CurrentAction <> "gridadd")
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
<?php if ($booking_helpers_list->lTotalRecs > 0) { ?>
<?php if ($booking_helpers->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($booking_helpers->CurrentAction <> "gridadd" && $booking_helpers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($booking_helpers_list->Pager)) $booking_helpers_list->Pager = new cPrevNextPager($booking_helpers_list->lStartRec, $booking_helpers_list->lDisplayRecs, $booking_helpers_list->lTotalRecs) ?>
<?php if ($booking_helpers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($booking_helpers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $booking_helpers_list->PageUrl() ?>start=<?php echo $booking_helpers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($booking_helpers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $booking_helpers_list->PageUrl() ?>start=<?php echo $booking_helpers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $booking_helpers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($booking_helpers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $booking_helpers_list->PageUrl() ?>start=<?php echo $booking_helpers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($booking_helpers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $booking_helpers_list->PageUrl() ?>start=<?php echo $booking_helpers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $booking_helpers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $booking_helpers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $booking_helpers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $booking_helpers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($booking_helpers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($booking_helpers_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="booking_helpers">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($booking_helpers_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($booking_helpers_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($booking_helpers_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($booking_helpers_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($booking_helpers_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($booking_helpers_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($booking_helpers->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($booking_helpers_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $booking_helpers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($booking_helpers->Export == "" && $booking_helpers->CurrentAction == "") { ?>
<?php } ?>
<?php if ($booking_helpers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$booking_helpers_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cbooking_helpers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'booking_helpers';

	// Page object name
	var $PageObjName = 'booking_helpers_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $booking_helpers;
		if ($booking_helpers->UseTokenInUrl) $PageUrl .= "t=" . $booking_helpers->TableVar . "&"; // Add page token
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
		global $objForm, $booking_helpers;
		if ($booking_helpers->UseTokenInUrl) {
			if ($objForm)
				return ($booking_helpers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($booking_helpers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbooking_helpers_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (booking_helpers)
		$GLOBALS["booking_helpers"] = new cbooking_helpers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["booking_helpers"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "booking_helpersdelete.php";
		$this->MultiUpdateUrl = "booking_helpersupdate.php";

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'booking_helpers', TRUE);

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
		global $booking_helpers;

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
			$booking_helpers->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$booking_helpers->Export = $_POST["exporttype"];
		} else {
			$booking_helpers->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $booking_helpers->Export; // Get export parameter, used in header
		$gsExportFile = $booking_helpers->TableVar; // Get export file, used in header
		if ($booking_helpers->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $booking_helpers;

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

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($booking_helpers->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $booking_helpers->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $booking_helpers->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $booking_helpers->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($booking_helpers->getMasterFilter() <> "" && $booking_helpers->getCurrentMasterTable() == "bookings") {
			global $bookings;
			$rsmaster = $bookings->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$booking_helpers->setMasterFilter(""); // Clear master filter
				$booking_helpers->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($booking_helpers->getReturnUrl()); // Return to caller
			} else {
				$bookings->LoadListRowValues($rsmaster);
				$bookings->RowType = EW_ROWTYPE_MASTER; // Master row
				$bookings->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$booking_helpers->setSessionWhere($sFilter);
		$booking_helpers->CurrentFilter = "";

		// Export data only
		if (in_array($booking_helpers->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($booking_helpers->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $booking_helpers;
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
			$booking_helpers->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$booking_helpers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $booking_helpers;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$booking_helpers->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$booking_helpers->CurrentOrderType = @$_GET["ordertype"];
			$booking_helpers->UpdateSort($booking_helpers->id); // id
			$booking_helpers->UpdateSort($booking_helpers->Booking_ID); // Booking_ID
			$booking_helpers->UpdateSort($booking_helpers->Helper_ID); // Helper_ID
			$booking_helpers->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $booking_helpers;
		$sOrderBy = $booking_helpers->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($booking_helpers->SqlOrderBy() <> "") {
				$sOrderBy = $booking_helpers->SqlOrderBy();
				$booking_helpers->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $booking_helpers;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$booking_helpers->getCurrentMasterTable = ""; // Clear master table
				$booking_helpers->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$booking_helpers->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$booking_helpers->Booking_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$booking_helpers->setSessionOrderBy($sOrderBy);
				$booking_helpers->id->setSort("");
				$booking_helpers->Booking_ID->setSort("");
				$booking_helpers->Helper_ID->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$booking_helpers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $booking_helpers;

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
		if ($booking_helpers->Export <> "" ||
			$booking_helpers->CurrentAction == "gridadd" ||
			$booking_helpers->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $booking_helpers;
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
		global $Security, $Language, $booking_helpers;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $booking_helpers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$booking_helpers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$booking_helpers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $booking_helpers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$booking_helpers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$booking_helpers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$booking_helpers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $booking_helpers;

		// Call Recordset Selecting event
		$booking_helpers->Recordset_Selecting($booking_helpers->CurrentFilter);

		// Load List page SQL
		$sSql = $booking_helpers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$booking_helpers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $booking_helpers;
		$sFilter = $booking_helpers->KeyFilter();

		// Call Row Selecting event
		$booking_helpers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$booking_helpers->CurrentFilter = $sFilter;
		$sSql = $booking_helpers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$booking_helpers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $booking_helpers;
		$booking_helpers->id->setDbValue($rs->fields('id'));
		$booking_helpers->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$booking_helpers->Helper_ID->setDbValue($rs->fields('Helper_ID'));
		$booking_helpers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $booking_helpers;

		// Initialize URLs
		$this->ViewUrl = $booking_helpers->ViewUrl();
		$this->EditUrl = $booking_helpers->EditUrl();
		$this->InlineEditUrl = $booking_helpers->InlineEditUrl();
		$this->CopyUrl = $booking_helpers->CopyUrl();
		$this->InlineCopyUrl = $booking_helpers->InlineCopyUrl();
		$this->DeleteUrl = $booking_helpers->DeleteUrl();

		// Call Row_Rendering event
		$booking_helpers->Row_Rendering();

		// Common render codes for all row types
		// id

		$booking_helpers->id->CellCssStyle = ""; $booking_helpers->id->CellCssClass = "";
		$booking_helpers->id->CellAttrs = array(); $booking_helpers->id->ViewAttrs = array(); $booking_helpers->id->EditAttrs = array();

		// Booking_ID
		$booking_helpers->Booking_ID->CellCssStyle = ""; $booking_helpers->Booking_ID->CellCssClass = "";
		$booking_helpers->Booking_ID->CellAttrs = array(); $booking_helpers->Booking_ID->ViewAttrs = array(); $booking_helpers->Booking_ID->EditAttrs = array();

		// Helper_ID
		$booking_helpers->Helper_ID->CellCssStyle = ""; $booking_helpers->Helper_ID->CellCssClass = "";
		$booking_helpers->Helper_ID->CellAttrs = array(); $booking_helpers->Helper_ID->ViewAttrs = array(); $booking_helpers->Helper_ID->EditAttrs = array();
		if ($booking_helpers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$booking_helpers->id->ViewValue = $booking_helpers->id->CurrentValue;
			$booking_helpers->id->CssStyle = "";
			$booking_helpers->id->CssClass = "";
			$booking_helpers->id->ViewCustomAttributes = "";

			// Booking_ID
			if (strval($booking_helpers->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$booking_helpers->Booking_ID->ViewValue = $booking_helpers->Booking_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Booking_ID->ViewValue = NULL;
			}
			$booking_helpers->Booking_ID->CssStyle = "";
			$booking_helpers->Booking_ID->CssClass = "";
			$booking_helpers->Booking_ID->ViewCustomAttributes = "";

			// Helper_ID
			if (strval($booking_helpers->Helper_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Helper_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Helper_Name` FROM `helpers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Helper_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Helper_ID->ViewValue = $rswrk->fields('Helper_Name');
					$rswrk->Close();
				} else {
					$booking_helpers->Helper_ID->ViewValue = $booking_helpers->Helper_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Helper_ID->ViewValue = NULL;
			}
			$booking_helpers->Helper_ID->CssStyle = "";
			$booking_helpers->Helper_ID->CssClass = "";
			$booking_helpers->Helper_ID->ViewCustomAttributes = "";

			// id
			$booking_helpers->id->HrefValue = "";
			$booking_helpers->id->TooltipValue = "";

			// Booking_ID
			$booking_helpers->Booking_ID->HrefValue = "";
			$booking_helpers->Booking_ID->TooltipValue = "";

			// Helper_ID
			$booking_helpers->Helper_ID->HrefValue = "";
			$booking_helpers->Helper_ID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($booking_helpers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$booking_helpers->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $booking_helpers;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $booking_helpers->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($booking_helpers->ExportAll) {
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
		if ($booking_helpers->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($booking_helpers, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($booking_helpers->id);
				$ExportDoc->ExportCaption($booking_helpers->Booking_ID);
				$ExportDoc->ExportCaption($booking_helpers->Helper_ID);
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
				$booking_helpers->CssClass = "";
				$booking_helpers->CssStyle = "";
				$booking_helpers->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($booking_helpers->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $booking_helpers->id->ExportValue($booking_helpers->Export, $booking_helpers->ExportOriginalValue));
					$XmlDoc->AddField('Booking_ID', $booking_helpers->Booking_ID->ExportValue($booking_helpers->Export, $booking_helpers->ExportOriginalValue));
					$XmlDoc->AddField('Helper_ID', $booking_helpers->Helper_ID->ExportValue($booking_helpers->Export, $booking_helpers->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($booking_helpers->id);
					$ExportDoc->ExportField($booking_helpers->Booking_ID);
					$ExportDoc->ExportField($booking_helpers->Helper_ID);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($booking_helpers->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($booking_helpers->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($booking_helpers->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($booking_helpers->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($booking_helpers->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $booking_helpers;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "bookings") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $booking_helpers->SqlMasterFilter_bookings();
				$this->sDbDetailFilter = $booking_helpers->SqlDetailFilter_bookings();
				if (@$_GET["id"] <> "") {
					$GLOBALS["bookings"]->id->setQueryStringValue($_GET["id"]);
					$booking_helpers->Booking_ID->setQueryStringValue($GLOBALS["bookings"]->id->QueryStringValue);
					$booking_helpers->Booking_ID->setSessionValue($booking_helpers->Booking_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["bookings"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["bookings"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Booking_ID@", ew_AdjustSql($GLOBALS["bookings"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$booking_helpers->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$booking_helpers->setStartRecordNumber($this->lStartRec);
			$booking_helpers->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$booking_helpers->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "bookings") {
				if ($booking_helpers->Booking_ID->QueryStringValue == "") $booking_helpers->Booking_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $booking_helpers->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $booking_helpers->getDetailFilter(); // Restore detail filter
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
