<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "invoice_itemsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "invoicesinfo.php" ?>
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
$invoice_items_list = new cinvoice_items_list();
$Page =& $invoice_items_list;

// Page init
$invoice_items_list->Page_Init();

// Page main
$invoice_items_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($invoice_items->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var invoice_items_list = new ew_Page("invoice_items_list");

// page properties
invoice_items_list.PageID = "list"; // page ID
invoice_items_list.FormID = "finvoice_itemslist"; // form ID
var EW_PAGE_ID = invoice_items_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
invoice_items_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoice_items_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoice_items_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoice_items_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($invoice_items->Export == "") { ?>
<?php
$gsMasterReturnUrl = "invoiceslist.php";
if ($invoice_items_list->sDbMasterFilter <> "" && $invoice_items->getCurrentMasterTable() == "invoices") {
	if ($invoice_items_list->bMasterRecordExists) {
		if ($invoice_items->getCurrentMasterTable() == $invoice_items->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "invoicesmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$invoice_items_list->lTotalRecs = $invoice_items->SelectRecordCount();
	} else {
		if ($rs = $invoice_items_list->LoadRecordset())
			$invoice_items_list->lTotalRecs = $rs->RecordCount();
	}
	$invoice_items_list->lStartRec = 1;
	if ($invoice_items_list->lDisplayRecs <= 0 || ($invoice_items->Export <> "" && $invoice_items->ExportAll)) // Display all records
		$invoice_items_list->lDisplayRecs = $invoice_items_list->lTotalRecs;
	if (!($invoice_items->Export <> "" && $invoice_items->ExportAll))
		$invoice_items_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $invoice_items_list->LoadRecordset($invoice_items_list->lStartRec-1, $invoice_items_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoice_items->TableCaption() ?>
<?php if ($invoice_items->Export == "" && $invoice_items->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $invoice_items_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $invoice_items_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $invoice_items_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoice_items_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($invoice_items->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($invoice_items->CurrentAction <> "gridadd" && $invoice_items->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($invoice_items_list->Pager)) $invoice_items_list->Pager = new cPrevNextPager($invoice_items_list->lStartRec, $invoice_items_list->lDisplayRecs, $invoice_items_list->lTotalRecs) ?>
<?php if ($invoice_items_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($invoice_items_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $invoice_items_list->PageUrl() ?>start=<?php echo $invoice_items_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($invoice_items_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $invoice_items_list->PageUrl() ?>start=<?php echo $invoice_items_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $invoice_items_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($invoice_items_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $invoice_items_list->PageUrl() ?>start=<?php echo $invoice_items_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($invoice_items_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $invoice_items_list->PageUrl() ?>start=<?php echo $invoice_items_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $invoice_items_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $invoice_items_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $invoice_items_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $invoice_items_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($invoice_items_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($invoice_items_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="invoice_items">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($invoice_items_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($invoice_items_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($invoice_items_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($invoice_items_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($invoice_items_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($invoice_items_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($invoice_items->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $invoice_items_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($invoice_items_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.finvoice_itemslist, '<?php echo $invoice_items_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="finvoice_itemslist" id="finvoice_itemslist" class="ewForm" action="" method="post">
<div id="gmp_invoice_items" class="ewGridMiddlePanel">
<?php if ($invoice_items_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $invoice_items->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$invoice_items_list->RenderListOptions();

// Render list options (header, left)
$invoice_items_list->ListOptions->Render("header", "left");
?>
<?php if ($invoice_items->id->Visible) { // id ?>
	<?php if ($invoice_items->SortUrl($invoice_items->id) == "") { ?>
		<td><?php echo $invoice_items->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoice_items->SortUrl($invoice_items->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoice_items->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoice_items->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoice_items->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoice_items->invoice_id->Visible) { // invoice_id ?>
	<?php if ($invoice_items->SortUrl($invoice_items->invoice_id) == "") { ?>
		<td><?php echo $invoice_items->invoice_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoice_items->SortUrl($invoice_items->invoice_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoice_items->invoice_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoice_items->invoice_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoice_items->invoice_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoice_items->client_id->Visible) { // client_id ?>
	<?php if ($invoice_items->SortUrl($invoice_items->client_id) == "") { ?>
		<td><?php echo $invoice_items->client_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoice_items->SortUrl($invoice_items->client_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoice_items->client_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoice_items->client_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoice_items->client_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($invoice_items->booking_id->Visible) { // booking_id ?>
	<?php if ($invoice_items->SortUrl($invoice_items->booking_id) == "") { ?>
		<td><?php echo $invoice_items->booking_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $invoice_items->SortUrl($invoice_items->booking_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $invoice_items->booking_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($invoice_items->booking_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($invoice_items->booking_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$invoice_items_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($invoice_items->ExportAll && $invoice_items->Export <> "") {
	$invoice_items_list->lStopRec = $invoice_items_list->lTotalRecs;
} else {
	$invoice_items_list->lStopRec = $invoice_items_list->lStartRec + $invoice_items_list->lDisplayRecs - 1; // Set the last record to display
}
$invoice_items_list->lRecCount = $invoice_items_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $invoice_items_list->lStartRec > 1)
		$rs->Move($invoice_items_list->lStartRec - 1);
}

// Initialize aggregate
$invoice_items->RowType = EW_ROWTYPE_AGGREGATEINIT;
$invoice_items_list->RenderRow();
$invoice_items_list->lRowCnt = 0;
while (($invoice_items->CurrentAction == "gridadd" || !$rs->EOF) &&
	$invoice_items_list->lRecCount < $invoice_items_list->lStopRec) {
	$invoice_items_list->lRecCount++;
	if (intval($invoice_items_list->lRecCount) >= intval($invoice_items_list->lStartRec)) {
		$invoice_items_list->lRowCnt++;

	// Init row class and style
	$invoice_items->CssClass = "";
	$invoice_items->CssStyle = "";
	$invoice_items->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($invoice_items->CurrentAction == "gridadd") {
		$invoice_items_list->LoadDefaultValues(); // Load default values
	} else {
		$invoice_items_list->LoadRowValues($rs); // Load row values
	}
	$invoice_items->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$invoice_items_list->RenderRow();

	// Render list options
	$invoice_items_list->RenderListOptions();
?>
	<tr<?php echo $invoice_items->RowAttributes() ?>>
<?php

// Render list options (body, left)
$invoice_items_list->ListOptions->Render("body", "left");
?>
	<?php if ($invoice_items->id->Visible) { // id ?>
		<td<?php echo $invoice_items->id->CellAttributes() ?>>
<div<?php echo $invoice_items->id->ViewAttributes() ?>><?php echo $invoice_items->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoice_items->invoice_id->Visible) { // invoice_id ?>
		<td<?php echo $invoice_items->invoice_id->CellAttributes() ?>>
<div<?php echo $invoice_items->invoice_id->ViewAttributes() ?>><?php echo $invoice_items->invoice_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoice_items->client_id->Visible) { // client_id ?>
		<td<?php echo $invoice_items->client_id->CellAttributes() ?>>
<div<?php echo $invoice_items->client_id->ViewAttributes() ?>><?php echo $invoice_items->client_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($invoice_items->booking_id->Visible) { // booking_id ?>
		<td<?php echo $invoice_items->booking_id->CellAttributes() ?>>
<div<?php echo $invoice_items->booking_id->ViewAttributes() ?>>
<?php if ($invoice_items->booking_id->HrefValue <> "" || $invoice_items->booking_id->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_id=<?php echo $invoice_items->booking_id->HrefValue ?>"><?php echo $invoice_items->booking_id->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $invoice_items->booking_id->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$invoice_items_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($invoice_items->CurrentAction <> "gridadd")
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
<?php if ($invoice_items_list->lTotalRecs > 0) { ?>
<?php if ($invoice_items->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($invoice_items->CurrentAction <> "gridadd" && $invoice_items->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($invoice_items_list->Pager)) $invoice_items_list->Pager = new cPrevNextPager($invoice_items_list->lStartRec, $invoice_items_list->lDisplayRecs, $invoice_items_list->lTotalRecs) ?>
<?php if ($invoice_items_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($invoice_items_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $invoice_items_list->PageUrl() ?>start=<?php echo $invoice_items_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($invoice_items_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $invoice_items_list->PageUrl() ?>start=<?php echo $invoice_items_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $invoice_items_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($invoice_items_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $invoice_items_list->PageUrl() ?>start=<?php echo $invoice_items_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($invoice_items_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $invoice_items_list->PageUrl() ?>start=<?php echo $invoice_items_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $invoice_items_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $invoice_items_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $invoice_items_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $invoice_items_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($invoice_items_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($invoice_items_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="invoice_items">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($invoice_items_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($invoice_items_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($invoice_items_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($invoice_items_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($invoice_items_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($invoice_items_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($invoice_items->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($invoice_items_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $invoice_items_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($invoice_items_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.finvoice_itemslist, '<?php echo $invoice_items_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>

<!-- print invoice -->
<br><br>
<div class="container-fluid">
<div class="row">
<?php 

		$clientid = $_GET['Client_ID'];
		$invoiceid = $_GET['id'];
?>
	<div class="col-12">
		<a class="btn btn-primary"  href="./ajax_info.php?clientid=<?php echo $clientid; ?>&invoiceid=<?php echo $invoiceid; ?>" target="_blank">PRINT TO PDF</a>
	</div>
</div>

	<div class="row">
		<div class="col-12">
			<div id="viewinvoice" style="font-size:1vw!important;line-height:1.5vw;"> </div>
		</div>
	</div>
</div>

<?php if ($invoice_items->Export == "" && $invoice_items->CurrentAction == "") { ?>
<?php } ?>
<?php if ($invoice_items->Export == "") { ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script language="JavaScript" type="text/javascript">
<?php $date_today = date("Y-m-d"); ?>
$(function(){
		
	$("#topdf").on("click", function(){
	
		html2canvas($('#billingstatement')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("INV-<?php echo date("m/d/Y",strtotime($date_today)); ?>.pdf");
                }
            }); 
});
});
</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$invoice_items_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoice_items_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'invoice_items';

	// Page object name
	var $PageObjName = 'invoice_items_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $invoice_items;
		if ($invoice_items->UseTokenInUrl) $PageUrl .= "t=" . $invoice_items->TableVar . "&"; // Add page token
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
		global $objForm, $invoice_items;
		if ($invoice_items->UseTokenInUrl) {
			if ($objForm)
				return ($invoice_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($invoice_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinvoice_items_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (invoice_items)
		$GLOBALS["invoice_items"] = new cinvoice_items();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["invoice_items"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "invoice_itemsdelete.php";
		$this->MultiUpdateUrl = "invoice_itemsupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoices)
		$GLOBALS['invoices'] = new cinvoices();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'invoice_items', TRUE);

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
		global $invoice_items;

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
			$invoice_items->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$invoice_items->Export = $_POST["exporttype"];
		} else {
			$invoice_items->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $invoice_items->Export; // Get export parameter, used in header
		$gsExportFile = $invoice_items->TableVar; // Get export file, used in header
		if ($invoice_items->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $invoice_items;

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
		if ($invoice_items->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $invoice_items->getRecordsPerPage(); // Restore from Session
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
		$this->sDbMasterFilter = $invoice_items->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $invoice_items->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($invoice_items->getMasterFilter() <> "" && $invoice_items->getCurrentMasterTable() == "invoices") {
			global $invoices;
			$rsmaster = $invoices->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$invoice_items->setMasterFilter(""); // Clear master filter
				$invoice_items->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($invoice_items->getReturnUrl()); // Return to caller
			} else {
				$invoices->LoadListRowValues($rsmaster);
				$invoices->RowType = EW_ROWTYPE_MASTER; // Master row
				$invoices->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$invoice_items->setSessionWhere($sFilter);
		$invoice_items->CurrentFilter = "";

		// Export data only
		if (in_array($invoice_items->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($invoice_items->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $invoice_items;
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
			$invoice_items->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$invoice_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $invoice_items;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$invoice_items->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$invoice_items->CurrentOrderType = @$_GET["ordertype"];
			$invoice_items->UpdateSort($invoice_items->id); // id
			$invoice_items->UpdateSort($invoice_items->invoice_id); // invoice_id
			$invoice_items->UpdateSort($invoice_items->client_id); // client_id
			$invoice_items->UpdateSort($invoice_items->booking_id); // booking_id
			$invoice_items->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $invoice_items;
		$sOrderBy = $invoice_items->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($invoice_items->SqlOrderBy() <> "") {
				$sOrderBy = $invoice_items->SqlOrderBy();
				$invoice_items->setSessionOrderBy($sOrderBy);
				$invoice_items->booking_id->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $invoice_items;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$invoice_items->getCurrentMasterTable = ""; // Clear master table
				$invoice_items->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$invoice_items->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$invoice_items->invoice_id->setSessionValue("");
				$invoice_items->client_id->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$invoice_items->setSessionOrderBy($sOrderBy);
				$invoice_items->id->setSort("");
				$invoice_items->invoice_id->setSort("");
				$invoice_items->client_id->setSort("");
				$invoice_items->booking_id->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$invoice_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $invoice_items;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"invoice_items_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($invoice_items->Export <> "" ||
			$invoice_items->CurrentAction == "gridadd" ||
			$invoice_items->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $invoice_items;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($invoice_items->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $invoice_items;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $invoice_items;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$invoice_items->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$invoice_items->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $invoice_items->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$invoice_items->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$invoice_items->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$invoice_items->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $invoice_items;

		// Call Recordset Selecting event
		$invoice_items->Recordset_Selecting($invoice_items->CurrentFilter);

		// Load List page SQL
		$sSql = $invoice_items->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$invoice_items->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $invoice_items;
		$sFilter = $invoice_items->KeyFilter();

		// Call Row Selecting event
		$invoice_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$invoice_items->CurrentFilter = $sFilter;
		$sSql = $invoice_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$invoice_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $invoice_items;
		$invoice_items->id->setDbValue($rs->fields('id'));
		$invoice_items->invoice_id->setDbValue($rs->fields('invoice_id'));
		$invoice_items->client_id->setDbValue($rs->fields('client_id'));
		$invoice_items->booking_id->setDbValue($rs->fields('booking_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $invoice_items;

		// Initialize URLs
		$this->ViewUrl = $invoice_items->ViewUrl();
		$this->EditUrl = $invoice_items->EditUrl();
		$this->InlineEditUrl = $invoice_items->InlineEditUrl();
		$this->CopyUrl = $invoice_items->CopyUrl();
		$this->InlineCopyUrl = $invoice_items->InlineCopyUrl();
		$this->DeleteUrl = $invoice_items->DeleteUrl();

		// Call Row_Rendering event
		$invoice_items->Row_Rendering();

		// Common render codes for all row types
		// id

		$invoice_items->id->CellCssStyle = ""; $invoice_items->id->CellCssClass = "";
		$invoice_items->id->CellAttrs = array(); $invoice_items->id->ViewAttrs = array(); $invoice_items->id->EditAttrs = array();

		// invoice_id
		$invoice_items->invoice_id->CellCssStyle = ""; $invoice_items->invoice_id->CellCssClass = "";
		$invoice_items->invoice_id->CellAttrs = array(); $invoice_items->invoice_id->ViewAttrs = array(); $invoice_items->invoice_id->EditAttrs = array();

		// client_id
		$invoice_items->client_id->CellCssStyle = ""; $invoice_items->client_id->CellCssClass = "";
		$invoice_items->client_id->CellAttrs = array(); $invoice_items->client_id->ViewAttrs = array(); $invoice_items->client_id->EditAttrs = array();

		// booking_id
		$invoice_items->booking_id->CellCssStyle = ""; $invoice_items->booking_id->CellCssClass = "";
		$invoice_items->booking_id->CellAttrs = array(); $invoice_items->booking_id->ViewAttrs = array(); $invoice_items->booking_id->EditAttrs = array();
		if ($invoice_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$invoice_items->id->ViewValue = $invoice_items->id->CurrentValue;
			$invoice_items->id->CssStyle = "";
			$invoice_items->id->CssClass = "";
			$invoice_items->id->ViewCustomAttributes = "";

			// invoice_id
			if (strval($invoice_items->invoice_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->invoice_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Invoice_Number` FROM `invoices`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->invoice_id->ViewValue = $rswrk->fields('Invoice_Number');
					$rswrk->Close();
				} else {
					$invoice_items->invoice_id->ViewValue = $invoice_items->invoice_id->CurrentValue;
				}
			} else {
				$invoice_items->invoice_id->ViewValue = NULL;
			}
			$invoice_items->invoice_id->CssStyle = "";
			$invoice_items->invoice_id->CssClass = "";
			$invoice_items->invoice_id->ViewCustomAttributes = "";

			// client_id
			if (strval($invoice_items->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$invoice_items->client_id->ViewValue = $invoice_items->client_id->CurrentValue;
				}
			} else {
				$invoice_items->client_id->ViewValue = NULL;
			}
			$invoice_items->client_id->CssStyle = "";
			$invoice_items->client_id->CssClass = "";
			$invoice_items->client_id->ViewCustomAttributes = "";

			// booking_id
			if (strval($invoice_items->booking_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->booking_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`client_id`=" . $invoice_items->client_id->CurrentValue . " AND `status_id`=" . 2 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Booking_Number` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->booking_id->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$invoice_items->booking_id->ViewValue = $invoice_items->booking_id->CurrentValue;
				}
			} else {
				$invoice_items->booking_id->ViewValue = NULL;
			}
			$invoice_items->booking_id->CssStyle = "";
			$invoice_items->booking_id->CssClass = "";
			$invoice_items->booking_id->ViewCustomAttributes = "";

			// id
			$invoice_items->id->HrefValue = "";
			$invoice_items->id->TooltipValue = "";

			// invoice_id
			$invoice_items->invoice_id->HrefValue = "";
			$invoice_items->invoice_id->TooltipValue = "";

			// client_id
			$invoice_items->client_id->HrefValue = "";
			$invoice_items->client_id->TooltipValue = "";

			// booking_id
			if (!ew_Empty($invoice_items->booking_id->CurrentValue)) {
				$invoice_items->booking_id->HrefValue = $invoice_items->booking_id->CurrentValue;
				if ($invoice_items->Export <> "") $invoice_items->booking_id->HrefValue = ew_ConvertFullUrl($invoice_items->booking_id->HrefValue);
			} else {
				$invoice_items->booking_id->HrefValue = "";
			}
			$invoice_items->booking_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($invoice_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$invoice_items->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $invoice_items;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $invoice_items->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($invoice_items->ExportAll) {
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
		if ($invoice_items->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($invoice_items, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($invoice_items->id);
				$ExportDoc->ExportCaption($invoice_items->invoice_id);
				$ExportDoc->ExportCaption($invoice_items->client_id);
				$ExportDoc->ExportCaption($invoice_items->booking_id);
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
				$invoice_items->CssClass = "";
				$invoice_items->CssStyle = "";
				$invoice_items->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($invoice_items->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $invoice_items->id->ExportValue($invoice_items->Export, $invoice_items->ExportOriginalValue));
					$XmlDoc->AddField('invoice_id', $invoice_items->invoice_id->ExportValue($invoice_items->Export, $invoice_items->ExportOriginalValue));
					$XmlDoc->AddField('client_id', $invoice_items->client_id->ExportValue($invoice_items->Export, $invoice_items->ExportOriginalValue));
					$XmlDoc->AddField('booking_id', $invoice_items->booking_id->ExportValue($invoice_items->Export, $invoice_items->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($invoice_items->id);
					$ExportDoc->ExportField($invoice_items->invoice_id);
					$ExportDoc->ExportField($invoice_items->client_id);
					$ExportDoc->ExportField($invoice_items->booking_id);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($invoice_items->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($invoice_items->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($invoice_items->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($invoice_items->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($invoice_items->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $invoice_items;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "invoices") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $invoice_items->SqlMasterFilter_invoices();
				$this->sDbDetailFilter = $invoice_items->SqlDetailFilter_invoices();
				if (@$_GET["id"] <> "") {
					$GLOBALS["invoices"]->id->setQueryStringValue($_GET["id"]);
					$invoice_items->invoice_id->setQueryStringValue($GLOBALS["invoices"]->id->QueryStringValue);
					$invoice_items->invoice_id->setSessionValue($invoice_items->invoice_id->QueryStringValue);
					if (!is_numeric($GLOBALS["invoices"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["invoices"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@invoice_id@", ew_AdjustSql($GLOBALS["invoices"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["Client_ID"] <> "") {
					$GLOBALS["invoices"]->Client_ID->setQueryStringValue($_GET["Client_ID"]);
					$invoice_items->client_id->setQueryStringValue($GLOBALS["invoices"]->Client_ID->QueryStringValue);
					$invoice_items->client_id->setSessionValue($invoice_items->client_id->QueryStringValue);
					if (!is_numeric($GLOBALS["invoices"]->Client_ID->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@Client_ID@", ew_AdjustSql($GLOBALS["invoices"]->Client_ID->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@client_id@", ew_AdjustSql($GLOBALS["invoices"]->Client_ID->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$invoice_items->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$invoice_items->setStartRecordNumber($this->lStartRec);
			$invoice_items->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$invoice_items->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "invoices") {
				if ($invoice_items->invoice_id->QueryStringValue == "") $invoice_items->invoice_id->setSessionValue("");
				if ($invoice_items->client_id->QueryStringValue == "") $invoice_items->client_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $invoice_items->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $invoice_items->getDetailFilter(); // Restore detail filter
		}
	}

		// Page Load event
function Page_Load() {
   $clientid = $_GET['Client_ID'];
        $invoiceid = $_GET['id'];
    //    echo $_GET['Client_ID'];
        
echo "<script> 
 
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById('viewinvoice').innerHTML = this.responseText;
    }
  };
  xhttp.open('GET', 'ajax_info.php?clientid=" . $clientid . "&invoiceid=" . $invoiceid ."' , true);
  xhttp.send();

 
 
 </script> ";

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
