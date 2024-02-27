<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "customer_invoicesinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "invoicesinfo.php" ?>
<?php include "account_paymentsinfo.php" ?>
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
$customer_invoices_list = new ccustomer_invoices_list();
$Page =& $customer_invoices_list;

// Page init
$customer_invoices_list->Page_Init();

// Page main
$customer_invoices_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($customer_invoices->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var customer_invoices_list = new ew_Page("customer_invoices_list");

// page properties
customer_invoices_list.PageID = "list"; // page ID
customer_invoices_list.FormID = "fcustomer_invoiceslist"; // form ID
var EW_PAGE_ID = customer_invoices_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
customer_invoices_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
customer_invoices_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
customer_invoices_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customer_invoices_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<?php if ($customer_invoices->Export == "") { ?>
<?php
$gsMasterReturnUrl = "account_paymentslist.php";
if ($customer_invoices_list->sDbMasterFilter <> "" && $customer_invoices->getCurrentMasterTable() == "account_payments") {
	if ($customer_invoices_list->bMasterRecordExists) {
		if ($customer_invoices->getCurrentMasterTable() == $customer_invoices->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "account_paymentsmaster.php" ?>
<?php
	}
}
?>
<?php
$gsMasterReturnUrl = "invoiceslist.php";
if ($customer_invoices_list->sDbMasterFilter <> "" && $customer_invoices->getCurrentMasterTable() == "invoices") {
	if ($customer_invoices_list->bMasterRecordExists) {
		if ($customer_invoices->getCurrentMasterTable() == $customer_invoices->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$customer_invoices_list->lTotalRecs = $customer_invoices->SelectRecordCount();
	} else {
		if ($rs = $customer_invoices_list->LoadRecordset())
			$customer_invoices_list->lTotalRecs = $rs->RecordCount();
	}
	$customer_invoices_list->lStartRec = 1;
	if ($customer_invoices_list->lDisplayRecs <= 0 || ($customer_invoices->Export <> "" && $customer_invoices->ExportAll)) // Display all records
		$customer_invoices_list->lDisplayRecs = $customer_invoices_list->lTotalRecs;
	if (!($customer_invoices->Export <> "" && $customer_invoices->ExportAll))
		$customer_invoices_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $customer_invoices_list->LoadRecordset($customer_invoices_list->lStartRec-1, $customer_invoices_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $customer_invoices->TableCaption() ?>
<?php if ($customer_invoices->Export == "" && $customer_invoices->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $customer_invoices_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $customer_invoices_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $customer_invoices_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($customer_invoices->Export == "" && $customer_invoices->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(customer_invoices_list);" style="text-decoration: none;"><img id="customer_invoices_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="customer_invoices_list_SearchPanel">
<form name="fcustomer_invoiceslistsrch" id="fcustomer_invoiceslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="customer_invoices">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($customer_invoices->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $customer_invoices_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($customer_invoices->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($customer_invoices->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($customer_invoices->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$customer_invoices_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($customer_invoices->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($customer_invoices->CurrentAction <> "gridadd" && $customer_invoices->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($customer_invoices_list->Pager)) $customer_invoices_list->Pager = new cPrevNextPager($customer_invoices_list->lStartRec, $customer_invoices_list->lDisplayRecs, $customer_invoices_list->lTotalRecs) ?>
<?php if ($customer_invoices_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($customer_invoices_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $customer_invoices_list->PageUrl() ?>start=<?php echo $customer_invoices_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($customer_invoices_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $customer_invoices_list->PageUrl() ?>start=<?php echo $customer_invoices_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $customer_invoices_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($customer_invoices_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $customer_invoices_list->PageUrl() ?>start=<?php echo $customer_invoices_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($customer_invoices_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $customer_invoices_list->PageUrl() ?>start=<?php echo $customer_invoices_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $customer_invoices_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $customer_invoices_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $customer_invoices_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $customer_invoices_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($customer_invoices_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($customer_invoices_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="customer_invoices">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($customer_invoices_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($customer_invoices_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($customer_invoices_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($customer_invoices_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($customer_invoices_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($customer_invoices_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($customer_invoices->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $customer_invoices_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($customer_invoices_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fcustomer_invoiceslist, '<?php echo $customer_invoices_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fcustomer_invoiceslist" id="fcustomer_invoiceslist" class="ewForm" action="" method="post">
<div id="gmp_customer_invoices" class="ewGridMiddlePanel">
<?php if ($customer_invoices_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $customer_invoices->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$customer_invoices_list->RenderListOptions();

// Render list options (header, left)
$customer_invoices_list->ListOptions->Render("header", "left");
?>
<?php if ($customer_invoices->id->Visible) { // id ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->id) == "") { ?>
		<td><?php echo $customer_invoices->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->Payment_ID->Visible) { // Payment_ID ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->Payment_ID) == "") { ?>
		<td><?php echo $customer_invoices->Payment_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->Payment_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->Payment_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->Payment_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->Payment_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->Invoice_ID->Visible) { // Invoice_ID ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->Invoice_ID) == "") { ?>
		<td><?php echo $customer_invoices->Invoice_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->Invoice_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->Invoice_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->Invoice_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->Invoice_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->Invoice_Bill_Date->Visible) { // Invoice_Bill_Date ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->Invoice_Bill_Date) == "") { ?>
		<td><?php echo $customer_invoices->Invoice_Bill_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->Invoice_Bill_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->Invoice_Bill_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->Invoice_Bill_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->Invoice_Bill_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->Due_Date->Visible) { // Due_Date ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->Due_Date) == "") { ?>
		<td><?php echo $customer_invoices->Due_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->Due_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->Due_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->Due_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->Due_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->Total_Amount_Due) == "") { ?>
		<td><?php echo $customer_invoices->Total_Amount_Due->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->Total_Amount_Due) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->Total_Amount_Due->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->Total_Amount_Due->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->Total_Amount_Due->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->Payment_Status_ID->Visible) { // Payment_Status_ID ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->Payment_Status_ID) == "") { ?>
		<td><?php echo $customer_invoices->Payment_Status_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->Payment_Status_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->Payment_Status_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->Payment_Status_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->Payment_Status_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->Status_ID->Visible) { // Status_ID ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->Status_ID) == "") { ?>
		<td><?php echo $customer_invoices->Status_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->Status_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->Status_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->Status_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->Status_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->User_ID->Visible) { // User_ID ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->User_ID) == "") { ?>
		<td><?php echo $customer_invoices->User_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->User_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->User_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($customer_invoices->User_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->User_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($customer_invoices->Remarks->Visible) { // Remarks ?>
	<?php if ($customer_invoices->SortUrl($customer_invoices->Remarks) == "") { ?>
		<td><?php echo $customer_invoices->Remarks->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer_invoices->SortUrl($customer_invoices->Remarks) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $customer_invoices->Remarks->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($customer_invoices->Remarks->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer_invoices->Remarks->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$customer_invoices_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($customer_invoices->ExportAll && $customer_invoices->Export <> "") {
	$customer_invoices_list->lStopRec = $customer_invoices_list->lTotalRecs;
} else {
	$customer_invoices_list->lStopRec = $customer_invoices_list->lStartRec + $customer_invoices_list->lDisplayRecs - 1; // Set the last record to display
}
$customer_invoices_list->lRecCount = $customer_invoices_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $customer_invoices_list->lStartRec > 1)
		$rs->Move($customer_invoices_list->lStartRec - 1);
}

// Initialize aggregate
$customer_invoices->RowType = EW_ROWTYPE_AGGREGATEINIT;
$customer_invoices_list->RenderRow();
$customer_invoices_list->lRowCnt = 0;
while (($customer_invoices->CurrentAction == "gridadd" || !$rs->EOF) &&
	$customer_invoices_list->lRecCount < $customer_invoices_list->lStopRec) {
	$customer_invoices_list->lRecCount++;
	if (intval($customer_invoices_list->lRecCount) >= intval($customer_invoices_list->lStartRec)) {
		$customer_invoices_list->lRowCnt++;

	// Init row class and style
	$customer_invoices->CssClass = "";
	$customer_invoices->CssStyle = "";
	$customer_invoices->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($customer_invoices->CurrentAction == "gridadd") {
		$customer_invoices_list->LoadDefaultValues(); // Load default values
	} else {
		$customer_invoices_list->LoadRowValues($rs); // Load row values
	}
	$customer_invoices->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$customer_invoices_list->RenderRow();

	// Render list options
	$customer_invoices_list->RenderListOptions();
?>
	<tr<?php echo $customer_invoices->RowAttributes() ?>>
<?php

// Render list options (body, left)
$customer_invoices_list->ListOptions->Render("body", "left");
?>
	<?php if ($customer_invoices->id->Visible) { // id ?>
		<td<?php echo $customer_invoices->id->CellAttributes() ?>>
<div<?php echo $customer_invoices->id->ViewAttributes() ?>><?php echo $customer_invoices->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->Payment_ID->Visible) { // Payment_ID ?>
		<td<?php echo $customer_invoices->Payment_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->Payment_ID->ViewAttributes() ?>>
<?php if ($customer_invoices->Payment_ID->HrefValue <> "" || $customer_invoices->Payment_ID->TooltipValue <> "") { ?>
<a href="./account_paymentslist.php?x_id=<?php echo $customer_invoices->Payment_ID->HrefValue ?>" target="_self"><?php echo $customer_invoices->Payment_ID->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $customer_invoices->Payment_ID->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->Invoice_ID->Visible) { // Invoice_ID ?>
		<td<?php echo $customer_invoices->Invoice_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->Invoice_ID->ViewAttributes() ?>>
<?php if ($customer_invoices->Invoice_ID->HrefValue <> "" || $customer_invoices->Invoice_ID->TooltipValue <> "") { ?>
<a href="./invoiceslist.php?x_id=<?php echo $customer_invoices->Invoice_ID->HrefValue ?>" target="_self"><?php echo $customer_invoices->Invoice_ID->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $customer_invoices->Invoice_ID->ListViewValue() ?>
<?php } ?>
</div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->Invoice_Bill_Date->Visible) { // Invoice_Bill_Date ?>
		<td<?php echo $customer_invoices->Invoice_Bill_Date->CellAttributes() ?>>
<div<?php echo $customer_invoices->Invoice_Bill_Date->ViewAttributes() ?>><?php echo $customer_invoices->Invoice_Bill_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->Due_Date->Visible) { // Due_Date ?>
		<td<?php echo $customer_invoices->Due_Date->CellAttributes() ?>>
<div<?php echo $customer_invoices->Due_Date->ViewAttributes() ?>><?php echo $customer_invoices->Due_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td<?php echo $customer_invoices->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $customer_invoices->Total_Amount_Due->ViewAttributes() ?>><?php echo $customer_invoices->Total_Amount_Due->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->Payment_Status_ID->Visible) { // Payment_Status_ID ?>
		<td<?php echo $customer_invoices->Payment_Status_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->Payment_Status_ID->ViewAttributes() ?>><?php echo $customer_invoices->Payment_Status_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->Status_ID->Visible) { // Status_ID ?>
		<td<?php echo $customer_invoices->Status_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->Status_ID->ViewAttributes() ?>><?php echo $customer_invoices->Status_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->User_ID->Visible) { // User_ID ?>
		<td<?php echo $customer_invoices->User_ID->CellAttributes() ?>>
<div<?php echo $customer_invoices->User_ID->ViewAttributes() ?>><?php echo $customer_invoices->User_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer_invoices->Remarks->Visible) { // Remarks ?>
		<td<?php echo $customer_invoices->Remarks->CellAttributes() ?>>
<div<?php echo $customer_invoices->Remarks->ViewAttributes() ?>><?php echo $customer_invoices->Remarks->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$customer_invoices_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($customer_invoices->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$customer_invoices->RowType = EW_ROWTYPE_AGGREGATE;
$customer_invoices_list->RenderRow();
?>
<?php if ($customer_invoices_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$customer_invoices_list->RenderListOptions();

// Render list options (footer, left)
$customer_invoices_list->ListOptions->Render("footer", "left");
?>
	<?php if ($customer_invoices->id->Visible) { // id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($customer_invoices->Payment_ID->Visible) { // Payment_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($customer_invoices->Invoice_ID->Visible) { // Invoice_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($customer_invoices->Invoice_Bill_Date->Visible) { // Invoice_Bill_Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($customer_invoices->Due_Date->Visible) { // Due_Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($customer_invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $customer_invoices->Total_Amount_Due->ViewAttributes() ?>><?php echo $customer_invoices->Total_Amount_Due->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($customer_invoices->Payment_Status_ID->Visible) { // Payment_Status_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($customer_invoices->Status_ID->Visible) { // Status_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($customer_invoices->User_ID->Visible) { // User_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($customer_invoices->Remarks->Visible) { // Remarks ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$customer_invoices_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>	
<?php } ?>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($customer_invoices_list->lTotalRecs > 0) { ?>
<?php if ($customer_invoices->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($customer_invoices->CurrentAction <> "gridadd" && $customer_invoices->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($customer_invoices_list->Pager)) $customer_invoices_list->Pager = new cPrevNextPager($customer_invoices_list->lStartRec, $customer_invoices_list->lDisplayRecs, $customer_invoices_list->lTotalRecs) ?>
<?php if ($customer_invoices_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($customer_invoices_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $customer_invoices_list->PageUrl() ?>start=<?php echo $customer_invoices_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($customer_invoices_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $customer_invoices_list->PageUrl() ?>start=<?php echo $customer_invoices_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $customer_invoices_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($customer_invoices_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $customer_invoices_list->PageUrl() ?>start=<?php echo $customer_invoices_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($customer_invoices_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $customer_invoices_list->PageUrl() ?>start=<?php echo $customer_invoices_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $customer_invoices_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $customer_invoices_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $customer_invoices_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $customer_invoices_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($customer_invoices_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($customer_invoices_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="customer_invoices">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($customer_invoices_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($customer_invoices_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($customer_invoices_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($customer_invoices_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($customer_invoices_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($customer_invoices_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($customer_invoices->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($customer_invoices_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $customer_invoices_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($customer_invoices_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.fcustomer_invoiceslist, '<?php echo $customer_invoices_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($customer_invoices->Export == "" && $customer_invoices->CurrentAction == "") { ?>
<?php } ?>
<?php if ($customer_invoices->Export == "") { ?>
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
$customer_invoices_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccustomer_invoices_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'customer_invoices';

	// Page object name
	var $PageObjName = 'customer_invoices_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customer_invoices;
		if ($customer_invoices->UseTokenInUrl) $PageUrl .= "t=" . $customer_invoices->TableVar . "&"; // Add page token
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
		global $objForm, $customer_invoices;
		if ($customer_invoices->UseTokenInUrl) {
			if ($objForm)
				return ($customer_invoices->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customer_invoices->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccustomer_invoices_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (customer_invoices)
		$GLOBALS["customer_invoices"] = new ccustomer_invoices();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["customer_invoices"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "customer_invoicesdelete.php";
		$this->MultiUpdateUrl = "customer_invoicesupdate.php";

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoices)
		$GLOBALS['invoices'] = new cinvoices();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customer_invoices', TRUE);

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
		global $customer_invoices;

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
			$customer_invoices->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$customer_invoices->Export = $_POST["exporttype"];
		} else {
			$customer_invoices->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $customer_invoices->Export; // Get export parameter, used in header
		$gsExportFile = $customer_invoices->TableVar; // Get export file, used in header
		if ($customer_invoices->Export == "excel") {
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
		global $objForm, $Language, $gsSearchError, $Security, $customer_invoices;

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
			$customer_invoices->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($customer_invoices->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $customer_invoices->getRecordsPerPage(); // Restore from Session
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
		$customer_invoices->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$customer_invoices->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$customer_invoices->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $customer_invoices->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $customer_invoices->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $customer_invoices->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($customer_invoices->getMasterFilter() <> "" && $customer_invoices->getCurrentMasterTable() == "account_payments") {
			global $account_payments;
			$rsmaster = $account_payments->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$customer_invoices->setMasterFilter(""); // Clear master filter
				$customer_invoices->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($customer_invoices->getReturnUrl()); // Return to caller
			} else {
				$account_payments->LoadListRowValues($rsmaster);
				$account_payments->RowType = EW_ROWTYPE_MASTER; // Master row
				$account_payments->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($customer_invoices->getMasterFilter() <> "" && $customer_invoices->getCurrentMasterTable() == "invoices") {
			global $invoices;
			$rsmaster = $invoices->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$customer_invoices->setMasterFilter(""); // Clear master filter
				$customer_invoices->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($customer_invoices->getReturnUrl()); // Return to caller
			} else {
				$invoices->LoadListRowValues($rsmaster);
				$invoices->RowType = EW_ROWTYPE_MASTER; // Master row
				$invoices->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$customer_invoices->setSessionWhere($sFilter);
		$customer_invoices->CurrentFilter = "";

		// Export data only
		if (in_array($customer_invoices->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($customer_invoices->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $customer_invoices;
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
			$customer_invoices->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$customer_invoices->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $customer_invoices;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $customer_invoices->Invoice_Number, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $customer_invoices->Remarks, $Keyword);
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
		global $Security, $customer_invoices;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $customer_invoices->BasicSearchKeyword;
		$sSearchType = $customer_invoices->BasicSearchType;
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
			$customer_invoices->setSessionBasicSearchKeyword($sSearchKeyword);
			$customer_invoices->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $customer_invoices;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$customer_invoices->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $customer_invoices;
		$customer_invoices->setSessionBasicSearchKeyword("");
		$customer_invoices->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $customer_invoices;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$customer_invoices->BasicSearchKeyword = $customer_invoices->getSessionBasicSearchKeyword();
			$customer_invoices->BasicSearchType = $customer_invoices->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $customer_invoices;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$customer_invoices->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$customer_invoices->CurrentOrderType = @$_GET["ordertype"];
			$customer_invoices->UpdateSort($customer_invoices->id); // id
			$customer_invoices->UpdateSort($customer_invoices->Payment_ID); // Payment_ID
			$customer_invoices->UpdateSort($customer_invoices->Invoice_ID); // Invoice_ID
			$customer_invoices->UpdateSort($customer_invoices->Invoice_Bill_Date); // Invoice_Bill_Date
			$customer_invoices->UpdateSort($customer_invoices->Due_Date); // Due_Date
			$customer_invoices->UpdateSort($customer_invoices->Total_Amount_Due); // Total_Amount_Due
			$customer_invoices->UpdateSort($customer_invoices->Payment_Status_ID); // Payment_Status_ID
			$customer_invoices->UpdateSort($customer_invoices->Status_ID); // Status_ID
			$customer_invoices->UpdateSort($customer_invoices->User_ID); // User_ID
			$customer_invoices->UpdateSort($customer_invoices->Remarks); // Remarks
			$customer_invoices->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $customer_invoices;
		$sOrderBy = $customer_invoices->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($customer_invoices->SqlOrderBy() <> "") {
				$sOrderBy = $customer_invoices->SqlOrderBy();
				$customer_invoices->setSessionOrderBy($sOrderBy);
				$customer_invoices->Invoice_Bill_Date->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $customer_invoices;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$customer_invoices->getCurrentMasterTable = ""; // Clear master table
				$customer_invoices->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$customer_invoices->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$customer_invoices->Payment_ID->setSessionValue("");
				$customer_invoices->Invoice_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$customer_invoices->setSessionOrderBy($sOrderBy);
				$customer_invoices->id->setSort("");
				$customer_invoices->Payment_ID->setSort("");
				$customer_invoices->Invoice_ID->setSort("");
				$customer_invoices->Invoice_Bill_Date->setSort("");
				$customer_invoices->Due_Date->setSort("");
				$customer_invoices->Total_Amount_Due->setSort("");
				$customer_invoices->Payment_Status_ID->setSort("");
				$customer_invoices->Status_ID->setSort("");
				$customer_invoices->User_ID->setSort("");
				$customer_invoices->Remarks->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$customer_invoices->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $customer_invoices;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"customer_invoices_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($customer_invoices->Export <> "" ||
			$customer_invoices->CurrentAction == "gridadd" ||
			$customer_invoices->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $customer_invoices;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($customer_invoices->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $customer_invoices;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $customer_invoices;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$customer_invoices->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$customer_invoices->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $customer_invoices->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$customer_invoices->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$customer_invoices->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$customer_invoices->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $customer_invoices;
		$customer_invoices->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$customer_invoices->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $customer_invoices;

		// Call Recordset Selecting event
		$customer_invoices->Recordset_Selecting($customer_invoices->CurrentFilter);

		// Load List page SQL
		$sSql = $customer_invoices->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$customer_invoices->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customer_invoices;
		$sFilter = $customer_invoices->KeyFilter();

		// Call Row Selecting event
		$customer_invoices->Row_Selecting($sFilter);

		// Load SQL based on filter
		$customer_invoices->CurrentFilter = $sFilter;
		$sSql = $customer_invoices->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$customer_invoices->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $customer_invoices;
		$customer_invoices->id->setDbValue($rs->fields('id'));
		$customer_invoices->Payment_ID->setDbValue($rs->fields('Payment_ID'));
		$customer_invoices->Invoice_ID->setDbValue($rs->fields('Invoice_ID'));
		$customer_invoices->Client_ID->setDbValue($rs->fields('Client_ID'));
		$customer_invoices->Invoice_Bill_Date->setDbValue($rs->fields('Invoice_Bill_Date'));
		$customer_invoices->Due_Date->setDbValue($rs->fields('Due_Date'));
		$customer_invoices->Invoice_Number->setDbValue($rs->fields('Invoice_Number'));
		$customer_invoices->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$customer_invoices->Payment_Status_ID->setDbValue($rs->fields('Payment_Status_ID'));
		$customer_invoices->Status_ID->setDbValue($rs->fields('Status_ID'));
		$customer_invoices->created->setDbValue($rs->fields('created'));
		$customer_invoices->modified->setDbValue($rs->fields('modified'));
		$customer_invoices->User_ID->setDbValue($rs->fields('User_ID'));
		$customer_invoices->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $customer_invoices;

		// Initialize URLs
		$this->ViewUrl = $customer_invoices->ViewUrl();
		$this->EditUrl = $customer_invoices->EditUrl();
		$this->InlineEditUrl = $customer_invoices->InlineEditUrl();
		$this->CopyUrl = $customer_invoices->CopyUrl();
		$this->InlineCopyUrl = $customer_invoices->InlineCopyUrl();
		$this->DeleteUrl = $customer_invoices->DeleteUrl();

		// Call Row_Rendering event
		$customer_invoices->Row_Rendering();

		// Common render codes for all row types
		// id

		$customer_invoices->id->CellCssStyle = ""; $customer_invoices->id->CellCssClass = "";
		$customer_invoices->id->CellAttrs = array(); $customer_invoices->id->ViewAttrs = array(); $customer_invoices->id->EditAttrs = array();

		// Payment_ID
		$customer_invoices->Payment_ID->CellCssStyle = ""; $customer_invoices->Payment_ID->CellCssClass = "";
		$customer_invoices->Payment_ID->CellAttrs = array(); $customer_invoices->Payment_ID->ViewAttrs = array(); $customer_invoices->Payment_ID->EditAttrs = array();

		// Invoice_ID
		$customer_invoices->Invoice_ID->CellCssStyle = ""; $customer_invoices->Invoice_ID->CellCssClass = "";
		$customer_invoices->Invoice_ID->CellAttrs = array(); $customer_invoices->Invoice_ID->ViewAttrs = array(); $customer_invoices->Invoice_ID->EditAttrs = array();

		// Invoice_Bill_Date
		$customer_invoices->Invoice_Bill_Date->CellCssStyle = ""; $customer_invoices->Invoice_Bill_Date->CellCssClass = "";
		$customer_invoices->Invoice_Bill_Date->CellAttrs = array(); $customer_invoices->Invoice_Bill_Date->ViewAttrs = array(); $customer_invoices->Invoice_Bill_Date->EditAttrs = array();

		// Due_Date
		$customer_invoices->Due_Date->CellCssStyle = ""; $customer_invoices->Due_Date->CellCssClass = "";
		$customer_invoices->Due_Date->CellAttrs = array(); $customer_invoices->Due_Date->ViewAttrs = array(); $customer_invoices->Due_Date->EditAttrs = array();

		// Total_Amount_Due
		$customer_invoices->Total_Amount_Due->CellCssStyle = ""; $customer_invoices->Total_Amount_Due->CellCssClass = "";
		$customer_invoices->Total_Amount_Due->CellAttrs = array(); $customer_invoices->Total_Amount_Due->ViewAttrs = array(); $customer_invoices->Total_Amount_Due->EditAttrs = array();

		// Payment_Status_ID
		$customer_invoices->Payment_Status_ID->CellCssStyle = ""; $customer_invoices->Payment_Status_ID->CellCssClass = "";
		$customer_invoices->Payment_Status_ID->CellAttrs = array(); $customer_invoices->Payment_Status_ID->ViewAttrs = array(); $customer_invoices->Payment_Status_ID->EditAttrs = array();

		// Status_ID
		$customer_invoices->Status_ID->CellCssStyle = ""; $customer_invoices->Status_ID->CellCssClass = "";
		$customer_invoices->Status_ID->CellAttrs = array(); $customer_invoices->Status_ID->ViewAttrs = array(); $customer_invoices->Status_ID->EditAttrs = array();

		// User_ID
		$customer_invoices->User_ID->CellCssStyle = ""; $customer_invoices->User_ID->CellCssClass = "";
		$customer_invoices->User_ID->CellAttrs = array(); $customer_invoices->User_ID->ViewAttrs = array(); $customer_invoices->User_ID->EditAttrs = array();

		// Remarks
		$customer_invoices->Remarks->CellCssStyle = ""; $customer_invoices->Remarks->CellCssClass = "";
		$customer_invoices->Remarks->CellAttrs = array(); $customer_invoices->Remarks->ViewAttrs = array(); $customer_invoices->Remarks->EditAttrs = array();

		// Accumulate aggregate value
		if ($customer_invoices->RowType <> EW_ROWTYPE_AGGREGATEINIT && $customer_invoices->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($customer_invoices->Total_Amount_Due->CurrentValue))
				$customer_invoices->Total_Amount_Due->Total += $customer_invoices->Total_Amount_Due->CurrentValue; // Accumulate total
		}
		if ($customer_invoices->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customer_invoices->id->ViewValue = $customer_invoices->id->CurrentValue;
			$customer_invoices->id->CssStyle = "";
			$customer_invoices->id->CssClass = "";
			$customer_invoices->id->ViewCustomAttributes = "";

			// Payment_ID
			$customer_invoices->Payment_ID->ViewValue = $customer_invoices->Payment_ID->CurrentValue;
			$customer_invoices->Payment_ID->CssStyle = "";
			$customer_invoices->Payment_ID->CssClass = "";
			$customer_invoices->Payment_ID->ViewCustomAttributes = "";

			// Invoice_ID
			if (strval($customer_invoices->Invoice_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customer_invoices->Invoice_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Invoice_Number` FROM `invoices`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Payment_Status` IN (8,10))";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Invoice_Number` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customer_invoices->Invoice_ID->ViewValue = $rswrk->fields('Invoice_Number');
					$rswrk->Close();
				} else {
					$customer_invoices->Invoice_ID->ViewValue = $customer_invoices->Invoice_ID->CurrentValue;
				}
			} else {
				$customer_invoices->Invoice_ID->ViewValue = NULL;
			}
			$customer_invoices->Invoice_ID->CssStyle = "";
			$customer_invoices->Invoice_ID->CssClass = "";
			$customer_invoices->Invoice_ID->ViewCustomAttributes = "";

			// Invoice_Bill_Date
			$customer_invoices->Invoice_Bill_Date->ViewValue = $customer_invoices->Invoice_Bill_Date->CurrentValue;
			$customer_invoices->Invoice_Bill_Date->ViewValue = ew_FormatDateTime($customer_invoices->Invoice_Bill_Date->ViewValue, 6);
			$customer_invoices->Invoice_Bill_Date->CssStyle = "";
			$customer_invoices->Invoice_Bill_Date->CssClass = "";
			$customer_invoices->Invoice_Bill_Date->ViewCustomAttributes = "";

			// Due_Date
			$customer_invoices->Due_Date->ViewValue = $customer_invoices->Due_Date->CurrentValue;
			$customer_invoices->Due_Date->ViewValue = ew_FormatDateTime($customer_invoices->Due_Date->ViewValue, 6);
			$customer_invoices->Due_Date->CssStyle = "";
			$customer_invoices->Due_Date->CssClass = "";
			$customer_invoices->Due_Date->ViewCustomAttributes = "";

			// Total_Amount_Due
			$customer_invoices->Total_Amount_Due->ViewValue = $customer_invoices->Total_Amount_Due->CurrentValue;
			$customer_invoices->Total_Amount_Due->ViewValue = ew_FormatNumber($customer_invoices->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$customer_invoices->Total_Amount_Due->CssStyle = "";
			$customer_invoices->Total_Amount_Due->CssClass = "";
			$customer_invoices->Total_Amount_Due->ViewCustomAttributes = "";

			// Payment_Status_ID
			if (strval($customer_invoices->Payment_Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customer_invoices->Payment_Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customer_invoices->Payment_Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$customer_invoices->Payment_Status_ID->ViewValue = $customer_invoices->Payment_Status_ID->CurrentValue;
				}
			} else {
				$customer_invoices->Payment_Status_ID->ViewValue = NULL;
			}
			$customer_invoices->Payment_Status_ID->CssStyle = "";
			$customer_invoices->Payment_Status_ID->CssClass = "";
			$customer_invoices->Payment_Status_ID->ViewCustomAttributes = "";

			// Status_ID
			if (strval($customer_invoices->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customer_invoices->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customer_invoices->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$customer_invoices->Status_ID->ViewValue = $customer_invoices->Status_ID->CurrentValue;
				}
			} else {
				$customer_invoices->Status_ID->ViewValue = NULL;
			}
			$customer_invoices->Status_ID->CssStyle = "";
			$customer_invoices->Status_ID->CssClass = "";
			$customer_invoices->Status_ID->ViewCustomAttributes = "";

			// created
			$customer_invoices->created->ViewValue = $customer_invoices->created->CurrentValue;
			$customer_invoices->created->ViewValue = ew_FormatDateTime($customer_invoices->created->ViewValue, 6);
			$customer_invoices->created->CssStyle = "";
			$customer_invoices->created->CssClass = "";
			$customer_invoices->created->ViewCustomAttributes = "";

			// modified
			$customer_invoices->modified->ViewValue = $customer_invoices->modified->CurrentValue;
			$customer_invoices->modified->ViewValue = ew_FormatDateTime($customer_invoices->modified->ViewValue, 6);
			$customer_invoices->modified->CssStyle = "";
			$customer_invoices->modified->CssClass = "";
			$customer_invoices->modified->ViewCustomAttributes = "";

			// User_ID
			$customer_invoices->User_ID->ViewValue = $customer_invoices->User_ID->CurrentValue;
			$customer_invoices->User_ID->CssStyle = "";
			$customer_invoices->User_ID->CssClass = "";
			$customer_invoices->User_ID->ViewCustomAttributes = "";

			// Remarks
			$customer_invoices->Remarks->ViewValue = $customer_invoices->Remarks->CurrentValue;
			$customer_invoices->Remarks->CssStyle = "";
			$customer_invoices->Remarks->CssClass = "";
			$customer_invoices->Remarks->ViewCustomAttributes = "";

			// id
			$customer_invoices->id->HrefValue = "";
			$customer_invoices->id->TooltipValue = "";

			// Payment_ID
			if (!ew_Empty($customer_invoices->Payment_ID->CurrentValue)) {
				$customer_invoices->Payment_ID->HrefValue = $customer_invoices->Payment_ID->CurrentValue;
				if ($customer_invoices->Export <> "") $customer_invoices->Payment_ID->HrefValue = ew_ConvertFullUrl($customer_invoices->Payment_ID->HrefValue);
			} else {
				$customer_invoices->Payment_ID->HrefValue = "";
			}
			$customer_invoices->Payment_ID->TooltipValue = "";

			// Invoice_ID
			if (!ew_Empty($customer_invoices->Invoice_ID->CurrentValue)) {
				$customer_invoices->Invoice_ID->HrefValue = $customer_invoices->Invoice_ID->CurrentValue;
				if ($customer_invoices->Export <> "") $customer_invoices->Invoice_ID->HrefValue = ew_ConvertFullUrl($customer_invoices->Invoice_ID->HrefValue);
			} else {
				$customer_invoices->Invoice_ID->HrefValue = "";
			}
			$customer_invoices->Invoice_ID->TooltipValue = "";

			// Invoice_Bill_Date
			$customer_invoices->Invoice_Bill_Date->HrefValue = "";
			$customer_invoices->Invoice_Bill_Date->TooltipValue = "";

			// Due_Date
			$customer_invoices->Due_Date->HrefValue = "";
			$customer_invoices->Due_Date->TooltipValue = "";

			// Total_Amount_Due
			$customer_invoices->Total_Amount_Due->HrefValue = "";
			$customer_invoices->Total_Amount_Due->TooltipValue = "";

			// Payment_Status_ID
			$customer_invoices->Payment_Status_ID->HrefValue = "";
			$customer_invoices->Payment_Status_ID->TooltipValue = "";

			// Status_ID
			$customer_invoices->Status_ID->HrefValue = "";
			$customer_invoices->Status_ID->TooltipValue = "";

			// User_ID
			$customer_invoices->User_ID->HrefValue = "";
			$customer_invoices->User_ID->TooltipValue = "";

			// Remarks
			$customer_invoices->Remarks->HrefValue = "";
			$customer_invoices->Remarks->TooltipValue = "";
		} elseif ($customer_invoices->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$customer_invoices->Total_Amount_Due->Total = 0; // Initialize total
		} elseif ($customer_invoices->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$customer_invoices->Total_Amount_Due->CurrentValue = $customer_invoices->Total_Amount_Due->Total;
			$customer_invoices->Total_Amount_Due->ViewValue = $customer_invoices->Total_Amount_Due->CurrentValue;
			$customer_invoices->Total_Amount_Due->ViewValue = ew_FormatNumber($customer_invoices->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$customer_invoices->Total_Amount_Due->CssStyle = "";
			$customer_invoices->Total_Amount_Due->CssClass = "";
			$customer_invoices->Total_Amount_Due->ViewCustomAttributes = "";
			$customer_invoices->Total_Amount_Due->HrefValue = ""; // Clear href value
		}

		// Call Row Rendered event
		if ($customer_invoices->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$customer_invoices->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $customer_invoices;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $customer_invoices->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Initialize aggregates
		$customer_invoices->RowType = EW_ROWTYPE_AGGREGATEINIT;
		$this->RenderRow();

		// Export all
		if ($customer_invoices->ExportAll) {
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
		if ($customer_invoices->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($customer_invoices, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($customer_invoices->id);
				$ExportDoc->ExportCaption($customer_invoices->Payment_ID);
				$ExportDoc->ExportCaption($customer_invoices->Invoice_ID);
				$ExportDoc->ExportCaption($customer_invoices->Invoice_Bill_Date);
				$ExportDoc->ExportCaption($customer_invoices->Due_Date);
				$ExportDoc->ExportCaption($customer_invoices->Total_Amount_Due);
				$ExportDoc->ExportCaption($customer_invoices->Payment_Status_ID);
				$ExportDoc->ExportCaption($customer_invoices->Status_ID);
				$ExportDoc->ExportCaption($customer_invoices->created);
				$ExportDoc->ExportCaption($customer_invoices->modified);
				$ExportDoc->ExportCaption($customer_invoices->User_ID);
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
				$customer_invoices->CssClass = "";
				$customer_invoices->CssStyle = "";
				$customer_invoices->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($customer_invoices->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $customer_invoices->id->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('Payment_ID', $customer_invoices->Payment_ID->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('Invoice_ID', $customer_invoices->Invoice_ID->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('Invoice_Bill_Date', $customer_invoices->Invoice_Bill_Date->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('Due_Date', $customer_invoices->Due_Date->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('Total_Amount_Due', $customer_invoices->Total_Amount_Due->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('Payment_Status_ID', $customer_invoices->Payment_Status_ID->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('Status_ID', $customer_invoices->Status_ID->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('created', $customer_invoices->created->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('modified', $customer_invoices->modified->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
					$XmlDoc->AddField('User_ID', $customer_invoices->User_ID->ExportValue($customer_invoices->Export, $customer_invoices->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($customer_invoices->id);
					$ExportDoc->ExportField($customer_invoices->Payment_ID);
					$ExportDoc->ExportField($customer_invoices->Invoice_ID);
					$ExportDoc->ExportField($customer_invoices->Invoice_Bill_Date);
					$ExportDoc->ExportField($customer_invoices->Due_Date);
					$ExportDoc->ExportField($customer_invoices->Total_Amount_Due);
					$ExportDoc->ExportField($customer_invoices->Payment_Status_ID);
					$ExportDoc->ExportField($customer_invoices->Status_ID);
					$ExportDoc->ExportField($customer_invoices->created);
					$ExportDoc->ExportField($customer_invoices->modified);
					$ExportDoc->ExportField($customer_invoices->User_ID);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}

		// Export aggregates (non-XML and horizontal format only)
		if ($customer_invoices->Export <> "xml" && $ExportDoc->Horizontal) {
			$customer_invoices->RowType = EW_ROWTYPE_AGGREGATE;
			$this->RenderRow();
			$ExportDoc->BeginExportRow();
			$ExportDoc->ExportAggregate($customer_invoices->id, '');
			$ExportDoc->ExportAggregate($customer_invoices->Payment_ID, '');
			$ExportDoc->ExportAggregate($customer_invoices->Invoice_ID, '');
			$ExportDoc->ExportAggregate($customer_invoices->Invoice_Bill_Date, '');
			$ExportDoc->ExportAggregate($customer_invoices->Due_Date, '');
			$ExportDoc->ExportAggregate($customer_invoices->Total_Amount_Due, 'TOTAL');
			$ExportDoc->ExportAggregate($customer_invoices->Payment_Status_ID, '');
			$ExportDoc->ExportAggregate($customer_invoices->Status_ID, '');
			$ExportDoc->ExportAggregate($customer_invoices->created, '');
			$ExportDoc->ExportAggregate($customer_invoices->modified, '');
			$ExportDoc->ExportAggregate($customer_invoices->User_ID, '');
			$ExportDoc->EndExportRow();
		}
		if ($customer_invoices->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($customer_invoices->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($customer_invoices->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($customer_invoices->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($customer_invoices->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $customer_invoices;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "account_payments") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $customer_invoices->SqlMasterFilter_account_payments();
				$this->sDbDetailFilter = $customer_invoices->SqlDetailFilter_account_payments();
				if (@$_GET["id"] <> "") {
					$GLOBALS["account_payments"]->id->setQueryStringValue($_GET["id"]);
					$customer_invoices->Payment_ID->setQueryStringValue($GLOBALS["account_payments"]->id->QueryStringValue);
					$customer_invoices->Payment_ID->setSessionValue($customer_invoices->Payment_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["account_payments"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["account_payments"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Payment_ID@", ew_AdjustSql($GLOBALS["account_payments"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "invoices") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $customer_invoices->SqlMasterFilter_invoices();
				$this->sDbDetailFilter = $customer_invoices->SqlDetailFilter_invoices();
				if (@$_GET["id"] <> "") {
					$GLOBALS["invoices"]->id->setQueryStringValue($_GET["id"]);
					$customer_invoices->Invoice_ID->setQueryStringValue($GLOBALS["invoices"]->id->QueryStringValue);
					$customer_invoices->Invoice_ID->setSessionValue($customer_invoices->Invoice_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["invoices"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["invoices"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Invoice_ID@", ew_AdjustSql($GLOBALS["invoices"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$customer_invoices->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$customer_invoices->setStartRecordNumber($this->lStartRec);
			$customer_invoices->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$customer_invoices->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "account_payments") {
				if ($customer_invoices->Payment_ID->QueryStringValue == "") $customer_invoices->Payment_ID->setSessionValue("");
			}
			if ($sMasterTblVar <> "invoices") {
				if ($customer_invoices->Invoice_ID->QueryStringValue == "") $customer_invoices->Invoice_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $customer_invoices->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $customer_invoices->getDetailFilter(); // Restore detail filter
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
