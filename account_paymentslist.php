<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "account_paymentsinfo.php" ?>
<?php include "clientsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "customer_invoicesinfo.php" ?>
<?php include "journal_accountsinfo.php" ?>
<?php include "all_file_uploadsinfo.php" ?>
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
$account_payments_list = new caccount_payments_list();
$Page =& $account_payments_list;

// Page init
$account_payments_list->Page_Init();

// Page main
$account_payments_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($account_payments->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var account_payments_list = new ew_Page("account_payments_list");

// page properties
account_payments_list.PageID = "list"; // page ID
account_payments_list.FormID = "faccount_paymentslist"; // form ID
var EW_PAGE_ID = account_payments_list.PageID; // for backward compatibility

// extend page with validate function for search
account_payments_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_Payment_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($account_payments->Payment_Date->FldErrMsg()) ?>");

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
account_payments_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
account_payments_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
account_payments_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
account_payments_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($account_payments->Export == "") { ?>
<?php
$gsMasterReturnUrl = "clientslist.php";
if ($account_payments_list->sDbMasterFilter <> "" && $account_payments->getCurrentMasterTable() == "clients") {
	if ($account_payments_list->bMasterRecordExists) {
		if ($account_payments->getCurrentMasterTable() == $account_payments->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
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
		$account_payments_list->lTotalRecs = $account_payments->SelectRecordCount();
	} else {
		if ($rs = $account_payments_list->LoadRecordset())
			$account_payments_list->lTotalRecs = $rs->RecordCount();
	}
	$account_payments_list->lStartRec = 1;
	if ($account_payments_list->lDisplayRecs <= 0 || ($account_payments->Export <> "" && $account_payments->ExportAll)) // Display all records
		$account_payments_list->lDisplayRecs = $account_payments_list->lTotalRecs;
	if (!($account_payments->Export <> "" && $account_payments->ExportAll))
		$account_payments_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $account_payments_list->LoadRecordset($account_payments_list->lStartRec-1, $account_payments_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $account_payments->TableCaption() ?>
<?php if ($account_payments->Export == "" && $account_payments->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $account_payments_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $account_payments_list->ExportHtmlUrl ?>"><?php echo $Language->Phrase("ExportToHtml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $account_payments_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($account_payments->Export == "" && $account_payments->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(account_payments_list);" style="text-decoration: none;"><img id="account_payments_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="account_payments_list_SearchPanel">
<form name="faccount_paymentslistsrch" id="faccount_paymentslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return account_payments_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="account_payments">
<?php
if ($gsSearchError == "")
	$account_payments_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$account_payments->RowType = EW_ROWTYPE_SEARCH;

// Render row
$account_payments_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker"><?php echo $account_payments->Payment_Date->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("BETWEEN") ?><input type="hidden" name="z_Payment_Date" id="z_Payment_Date" value="BETWEEN"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Payment_Date" id="x_Payment_Date" title="<?php echo $account_payments->Payment_Date->FldTitle() ?>" value="<?php echo $account_payments->Payment_Date->EditValue ?>"<?php echo $account_payments->Payment_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Payment_Date" name="cal_x_Payment_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Payment_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Payment_Date" // button id
});
</script>
</span>
				<span class="ewSearchOpr" id="btw1_Payment_Date" name="btw1_Payment_Date">&nbsp;<?php echo $Language->Phrase("AND") ?>&nbsp;</span>
				<span class="phpmaker" style="float: left;" id="btw1_Payment_Date" name="btw1_Payment_Date">
<input type="text" name="y_Payment_Date" id="y_Payment_Date" title="<?php echo $account_payments->Payment_Date->FldTitle() ?>" value="<?php echo $account_payments->Payment_Date->EditValue2 ?>"<?php echo $account_payments->Payment_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_y_Payment_Date" name="cal_y_Payment_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "y_Payment_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_y_Payment_Date" // button id
});
</script>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $account_payments->Payment_Type->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Payment_Type" id="z_Payment_Type" value="LIKE"></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_Payment_Type" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_Payment_Type" id="x_Payment_Type" title="<?php echo $account_payments->Payment_Type->FldTitle() ?>" value="{value}"<?php echo $account_payments->Payment_Type->EditAttributes() ?>></label></div>
<div id="dsl_x_Payment_Type" repeatcolumn="5">
<?php
$arwrk = $account_payments->Payment_Type->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Payment_Type->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_Payment_Type" id="x_Payment_Type" title="<?php echo $account_payments->Payment_Type->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $account_payments->Payment_Type->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $account_payments->Journal_Type_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Journal_Type_ID" id="z_Journal_Type_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php $account_payments->Journal_Type_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Journal_Account_ID','x_Journal_Type_ID',account_payments_list.ar_x_Journal_Account_ID); " . @$account_payments->Journal_Type_ID->EditAttrs["onchange"]; ?>
<select id="x_Journal_Type_ID" name="x_Journal_Type_ID" title="<?php echo $account_payments->Journal_Type_ID->FldTitle() ?>"<?php echo $account_payments->Journal_Type_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Journal_Type_ID->EditValue)) {
	$arwrk = $account_payments->Journal_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Journal_Type_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr>
		<td><span class="phpmaker"><?php echo $account_payments->Journal_Account_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Journal_Account_ID" id="z_Journal_Account_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Journal_Account_ID" name="x_Journal_Account_ID" title="<?php echo $account_payments->Journal_Account_ID->FldTitle() ?>"<?php echo $account_payments->Journal_Account_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Journal_Account_ID->EditValue)) {
	$arwrk = $account_payments->Journal_Account_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Journal_Account_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$jswrk = "";
if (is_array($account_payments->Journal_Account_ID->EditValue)) {
	$arwrk = $account_payments->Journal_Account_ID->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
account_payments_list.ar_x_Journal_Account_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span>
			</div>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $account_payments->Payment_Method_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Payment_Method_ID" id="z_Payment_Method_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Payment_Method_ID" name="x_Payment_Method_ID" title="<?php echo $account_payments->Payment_Method_ID->FldTitle() ?>"<?php echo $account_payments->Payment_Method_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Payment_Method_ID->EditValue)) {
	$arwrk = $account_payments->Payment_Method_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Payment_Method_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr>
		<td><span class="phpmaker"><?php echo $account_payments->Vendor_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Vendor_ID" id="z_Vendor_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Vendor_ID" name="x_Vendor_ID" title="<?php echo $account_payments->Vendor_ID->FldTitle() ?>"<?php echo $account_payments->Vendor_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Vendor_ID->EditValue)) {
	$arwrk = $account_payments->Vendor_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Vendor_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr>
		<td><span class="phpmaker"><?php echo $account_payments->Client_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Client_ID" id="z_Client_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<?php if ($account_payments->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $account_payments->Client_ID->ViewAttributes() ?>><?php echo $account_payments->Client_ID->ListViewValue() ?></div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($account_payments->Client_ID->AdvancedSearch->SearchValue) ?>">
<?php } else { ?>
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $account_payments->Client_ID->FldTitle() ?>"<?php echo $account_payments->Client_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Client_ID->EditValue)) {
	$arwrk = $account_payments->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Client_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker"><?php echo $account_payments->Status_ID->FldCaption() ?></span></td>
		<td><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Status_ID" id="z_Status_ID" value="="></span></td>
		<td>			
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Status_ID" name="x_Status_ID" title="<?php echo $account_payments->Status_ID->FldTitle() ?>"<?php echo $account_payments->Status_ID->EditAttributes() ?>>
<?php
if (is_array($account_payments->Status_ID->EditValue)) {
	$arwrk = $account_payments->Status_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($account_payments->Status_ID->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($account_payments->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $account_payments_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="account_paymentssrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($account_payments->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($account_payments->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($account_payments->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payments_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($account_payments->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($account_payments->CurrentAction <> "gridadd" && $account_payments->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($account_payments_list->Pager)) $account_payments_list->Pager = new cPrevNextPager($account_payments_list->lStartRec, $account_payments_list->lDisplayRecs, $account_payments_list->lTotalRecs) ?>
<?php if ($account_payments_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($account_payments_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $account_payments_list->PageUrl() ?>start=<?php echo $account_payments_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($account_payments_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $account_payments_list->PageUrl() ?>start=<?php echo $account_payments_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $account_payments_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($account_payments_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $account_payments_list->PageUrl() ?>start=<?php echo $account_payments_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($account_payments_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $account_payments_list->PageUrl() ?>start=<?php echo $account_payments_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $account_payments_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $account_payments_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $account_payments_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $account_payments_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($account_payments_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($account_payments_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="account_payments">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($account_payments_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($account_payments_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($account_payments_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($account_payments_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($account_payments_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($account_payments_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($account_payments->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $account_payments_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($account_payments_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.faccount_paymentslist, '<?php echo $account_payments_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="faccount_paymentslist" id="faccount_paymentslist" class="ewForm" action="" method="post">
<div id="gmp_account_payments" class="ewGridMiddlePanel">
<?php if ($account_payments_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $account_payments->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$account_payments_list->RenderListOptions();

// Render list options (header, left)
$account_payments_list->ListOptions->Render("header", "left");
?>
<?php if ($account_payments->id->Visible) { // id ?>
	<?php if ($account_payments->SortUrl($account_payments->id) == "") { ?>
		<td><?php echo $account_payments->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Date->Visible) { // Date ?>
	<?php if ($account_payments->SortUrl($account_payments->Date) == "") { ?>
		<td><?php echo $account_payments->Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Payment_Reference->Visible) { // Payment_Reference ?>
	<?php if ($account_payments->SortUrl($account_payments->Payment_Reference) == "") { ?>
		<td><?php echo $account_payments->Payment_Reference->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Payment_Reference) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Payment_Reference->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($account_payments->Payment_Reference->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Payment_Reference->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Payment_Date->Visible) { // Payment_Date ?>
	<?php if ($account_payments->SortUrl($account_payments->Payment_Date) == "") { ?>
		<td><?php echo $account_payments->Payment_Date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Payment_Date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Payment_Date->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Payment_Date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Payment_Date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Payment_Type->Visible) { // Payment_Type ?>
	<?php if ($account_payments->SortUrl($account_payments->Payment_Type) == "") { ?>
		<td><?php echo $account_payments->Payment_Type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Payment_Type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Payment_Type->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Payment_Type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Payment_Type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Journal_Type_ID->Visible) { // Journal_Type_ID ?>
	<?php if ($account_payments->SortUrl($account_payments->Journal_Type_ID) == "") { ?>
		<td><?php echo $account_payments->Journal_Type_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Journal_Type_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Journal_Type_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Journal_Type_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Journal_Type_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Journal_Account_ID->Visible) { // Journal_Account_ID ?>
	<?php if ($account_payments->SortUrl($account_payments->Journal_Account_ID) == "") { ?>
		<td><?php echo $account_payments->Journal_Account_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Journal_Account_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Journal_Account_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Journal_Account_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Journal_Account_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Payment_Method_ID->Visible) { // Payment_Method_ID ?>
	<?php if ($account_payments->SortUrl($account_payments->Payment_Method_ID) == "") { ?>
		<td><?php echo $account_payments->Payment_Method_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Payment_Method_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Payment_Method_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Payment_Method_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Payment_Method_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Vendor_ID->Visible) { // Vendor_ID ?>
	<?php if ($account_payments->SortUrl($account_payments->Vendor_ID) == "") { ?>
		<td><?php echo $account_payments->Vendor_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Vendor_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Vendor_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Vendor_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Vendor_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Client_ID->Visible) { // Client_ID ?>
	<?php if ($account_payments->SortUrl($account_payments->Client_ID) == "") { ?>
		<td><?php echo $account_payments->Client_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Client_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Client_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Client_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Client_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Amount->Visible) { // Amount ?>
	<?php if ($account_payments->SortUrl($account_payments->Amount) == "") { ?>
		<td><?php echo $account_payments->Amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->Status_ID->Visible) { // Status_ID ?>
	<?php if ($account_payments->SortUrl($account_payments->Status_ID) == "") { ?>
		<td><?php echo $account_payments->Status_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->Status_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->Status_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->Status_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->Status_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->User_ID->Visible) { // User_ID ?>
	<?php if ($account_payments->SortUrl($account_payments->User_ID) == "") { ?>
		<td><?php echo $account_payments->User_ID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->User_ID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->User_ID->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->User_ID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->User_ID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($account_payments->total_invoice_items->Visible) { // total_invoice_items ?>
	<?php if ($account_payments->SortUrl($account_payments->total_invoice_items) == "") { ?>
		<td><?php echo $account_payments->total_invoice_items->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $account_payments->SortUrl($account_payments->total_invoice_items) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $account_payments->total_invoice_items->FldCaption() ?></td><td style="width: 10px;"><?php if ($account_payments->total_invoice_items->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($account_payments->total_invoice_items->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$account_payments_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($account_payments->ExportAll && $account_payments->Export <> "") {
	$account_payments_list->lStopRec = $account_payments_list->lTotalRecs;
} else {
	$account_payments_list->lStopRec = $account_payments_list->lStartRec + $account_payments_list->lDisplayRecs - 1; // Set the last record to display
}
$account_payments_list->lRecCount = $account_payments_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $account_payments_list->lStartRec > 1)
		$rs->Move($account_payments_list->lStartRec - 1);
}

// Initialize aggregate
$account_payments->RowType = EW_ROWTYPE_AGGREGATEINIT;
$account_payments_list->RenderRow();
$account_payments_list->lRowCnt = 0;
while (($account_payments->CurrentAction == "gridadd" || !$rs->EOF) &&
	$account_payments_list->lRecCount < $account_payments_list->lStopRec) {
	$account_payments_list->lRecCount++;
	if (intval($account_payments_list->lRecCount) >= intval($account_payments_list->lStartRec)) {
		$account_payments_list->lRowCnt++;

	// Init row class and style
	$account_payments->CssClass = "";
	$account_payments->CssStyle = "";
	$account_payments->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($account_payments->CurrentAction == "gridadd") {
		$account_payments_list->LoadDefaultValues(); // Load default values
	} else {
		$account_payments_list->LoadRowValues($rs); // Load row values
	}
	$account_payments->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$account_payments_list->RenderRow();

	// Render list options
	$account_payments_list->RenderListOptions();
?>
	<tr<?php echo $account_payments->RowAttributes() ?>>
<?php

// Render list options (body, left)
$account_payments_list->ListOptions->Render("body", "left");
?>
	<?php if ($account_payments->id->Visible) { // id ?>
		<td<?php echo $account_payments->id->CellAttributes() ?>>
<div<?php echo $account_payments->id->ViewAttributes() ?>><?php echo $account_payments->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Date->Visible) { // Date ?>
		<td<?php echo $account_payments->Date->CellAttributes() ?>>
<div<?php echo $account_payments->Date->ViewAttributes() ?>><?php echo $account_payments->Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Payment_Reference->Visible) { // Payment_Reference ?>
		<td<?php echo $account_payments->Payment_Reference->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Reference->ViewAttributes() ?>><?php echo $account_payments->Payment_Reference->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Payment_Date->Visible) { // Payment_Date ?>
		<td<?php echo $account_payments->Payment_Date->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Date->ViewAttributes() ?>><?php echo $account_payments->Payment_Date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Payment_Type->Visible) { // Payment_Type ?>
		<td<?php echo $account_payments->Payment_Type->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Type->ViewAttributes() ?>><?php echo $account_payments->Payment_Type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Journal_Type_ID->Visible) { // Journal_Type_ID ?>
		<td<?php echo $account_payments->Journal_Type_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Journal_Type_ID->ViewAttributes() ?>><?php echo $account_payments->Journal_Type_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Journal_Account_ID->Visible) { // Journal_Account_ID ?>
		<td<?php echo $account_payments->Journal_Account_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Journal_Account_ID->ViewAttributes() ?>><?php echo $account_payments->Journal_Account_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Payment_Method_ID->Visible) { // Payment_Method_ID ?>
		<td<?php echo $account_payments->Payment_Method_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Method_ID->ViewAttributes() ?>><?php echo $account_payments->Payment_Method_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Vendor_ID->Visible) { // Vendor_ID ?>
		<td<?php echo $account_payments->Vendor_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Vendor_ID->ViewAttributes() ?>><?php echo $account_payments->Vendor_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Client_ID->Visible) { // Client_ID ?>
		<td<?php echo $account_payments->Client_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Client_ID->ViewAttributes() ?>><?php echo $account_payments->Client_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Amount->Visible) { // Amount ?>
		<td<?php echo $account_payments->Amount->CellAttributes() ?>>
<div<?php echo $account_payments->Amount->ViewAttributes() ?>><?php echo $account_payments->Amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->Status_ID->Visible) { // Status_ID ?>
		<td<?php echo $account_payments->Status_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Status_ID->ViewAttributes() ?>><?php echo $account_payments->Status_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->User_ID->Visible) { // User_ID ?>
		<td<?php echo $account_payments->User_ID->CellAttributes() ?>>
<div<?php echo $account_payments->User_ID->ViewAttributes() ?>><?php echo $account_payments->User_ID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($account_payments->total_invoice_items->Visible) { // total_invoice_items ?>
		<td<?php echo $account_payments->total_invoice_items->CellAttributes() ?>>
<div<?php echo $account_payments->total_invoice_items->ViewAttributes() ?>><?php echo $account_payments->total_invoice_items->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$account_payments_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($account_payments->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$account_payments->RowType = EW_ROWTYPE_AGGREGATE;
$account_payments_list->RenderRow();
?>
<?php if ($account_payments_list->lTotalRecs > 0) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$account_payments_list->RenderListOptions();

// Render list options (footer, left)
$account_payments_list->ListOptions->Render("footer", "left");
?>
	<?php if ($account_payments->id->Visible) { // id ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Date->Visible) { // Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Payment_Reference->Visible) { // Payment_Reference ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Payment_Date->Visible) { // Payment_Date ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Payment_Type->Visible) { // Payment_Type ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Journal_Type_ID->Visible) { // Journal_Type_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Journal_Account_ID->Visible) { // Journal_Account_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Payment_Method_ID->Visible) { // Payment_Method_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Vendor_ID->Visible) { // Vendor_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Client_ID->Visible) { // Client_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->Amount->Visible) { // Amount ?>
		<td>
		<?php echo $Language->Phrase("TOTAL") ?>: 
<span<?php echo $account_payments->Amount->ViewAttributes() ?>><?php echo $account_payments->Amount->ViewValue ?></span> 
		</td>
	<?php } ?>
	<?php if ($account_payments->Status_ID->Visible) { // Status_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->User_ID->Visible) { // User_ID ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
	<?php if ($account_payments->total_invoice_items->Visible) { // total_invoice_items ?>
		<td>
		&nbsp;
		</td>
	<?php } ?>
<?php

// Render list options (footer, right)
$account_payments_list->ListOptions->Render("footer", "right");
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
<?php if ($account_payments_list->lTotalRecs > 0) { ?>
<?php if ($account_payments->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($account_payments->CurrentAction <> "gridadd" && $account_payments->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($account_payments_list->Pager)) $account_payments_list->Pager = new cPrevNextPager($account_payments_list->lStartRec, $account_payments_list->lDisplayRecs, $account_payments_list->lTotalRecs) ?>
<?php if ($account_payments_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($account_payments_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $account_payments_list->PageUrl() ?>start=<?php echo $account_payments_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($account_payments_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $account_payments_list->PageUrl() ?>start=<?php echo $account_payments_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $account_payments_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($account_payments_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $account_payments_list->PageUrl() ?>start=<?php echo $account_payments_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($account_payments_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $account_payments_list->PageUrl() ?>start=<?php echo $account_payments_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $account_payments_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $account_payments_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $account_payments_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $account_payments_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($account_payments_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($account_payments_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="account_payments">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($account_payments_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($account_payments_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($account_payments_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="150"<?php if ($account_payments_list->lDisplayRecs == 150) { ?> selected="selected"<?php } ?>>150</option>
<option value="200"<?php if ($account_payments_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="500"<?php if ($account_payments_list->lDisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="ALL"<?php if ($account_payments->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($account_payments_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $account_payments_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($account_payments_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.faccount_paymentslist, '<?php echo $account_payments_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($account_payments->Export == "" && $account_payments->CurrentAction == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_Journal_Account_ID','x_Journal_Type_ID',account_payments_list.ar_x_Journal_Account_ID]]);

//-->
</script>
<?php } ?>
<?php if ($account_payments->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$account_payments_list->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payments_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'account_payments';

	// Page object name
	var $PageObjName = 'account_payments_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $account_payments;
		if ($account_payments->UseTokenInUrl) $PageUrl .= "t=" . $account_payments->TableVar . "&"; // Add page token
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
		global $objForm, $account_payments;
		if ($account_payments->UseTokenInUrl) {
			if ($objForm)
				return ($account_payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($account_payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caccount_payments_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (account_payments)
		$GLOBALS["account_payments"] = new caccount_payments();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["account_payments"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "account_paymentsdelete.php";
		$this->MultiUpdateUrl = "account_paymentsupdate.php";

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (customer_invoices)
		$GLOBALS['customer_invoices'] = new ccustomer_invoices();

		// Table object (journal_accounts)
		$GLOBALS['journal_accounts'] = new cjournal_accounts();

		// Table object (all_file_uploads)
		$GLOBALS['all_file_uploads'] = new call_file_uploads();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'account_payments', TRUE);

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
		global $account_payments;

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
			$account_payments->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$account_payments->Export = $_POST["exporttype"];
		} else {
			$account_payments->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $account_payments->Export; // Get export parameter, used in header
		$gsExportFile = $account_payments->TableVar; // Get export file, used in header
		if ($account_payments->Export == "excel") {
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
	var $ljournal_accounts_Count;
	var $lcustomer_invoices_Count;
	var $lall_file_uploads_Count;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $account_payments;

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
			$account_payments->Recordset_SearchValidated();

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
		if ($account_payments->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $account_payments->getRecordsPerPage(); // Restore from Session
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
		$account_payments->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$account_payments->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$account_payments->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $account_payments->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->sDbMasterFilter = $account_payments->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $account_payments->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($account_payments->getMasterFilter() <> "" && $account_payments->getCurrentMasterTable() == "clients") {
			global $clients;
			$rsmaster = $clients->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$account_payments->setMasterFilter(""); // Clear master filter
				$account_payments->setDetailFilter(""); // Clear detail filter
				$this->setMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($account_payments->getReturnUrl()); // Return to caller
			} else {
				$clients->LoadListRowValues($rsmaster);
				$clients->RowType = EW_ROWTYPE_MASTER; // Master row
				$clients->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$account_payments->setSessionWhere($sFilter);
		$account_payments->CurrentFilter = "";

		// Export data only
		if (in_array($account_payments->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($account_payments->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $account_payments;
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
			$account_payments->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$account_payments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $account_payments;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $account_payments->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $account_payments->Date, FALSE); // Date
		$this->BuildSearchSql($sWhere, $account_payments->Payment_Reference, FALSE); // Payment_Reference
		$this->BuildSearchSql($sWhere, $account_payments->Payment_Date, FALSE); // Payment_Date
		$this->BuildSearchSql($sWhere, $account_payments->Payment_Type, FALSE); // Payment_Type
		$this->BuildSearchSql($sWhere, $account_payments->Journal_Type_ID, FALSE); // Journal_Type_ID
		$this->BuildSearchSql($sWhere, $account_payments->Journal_Account_ID, FALSE); // Journal_Account_ID
		$this->BuildSearchSql($sWhere, $account_payments->Payment_Method_ID, FALSE); // Payment_Method_ID
		$this->BuildSearchSql($sWhere, $account_payments->Vendor_ID, FALSE); // Vendor_ID
		$this->BuildSearchSql($sWhere, $account_payments->Client_ID, FALSE); // Client_ID
		$this->BuildSearchSql($sWhere, $account_payments->Amount, FALSE); // Amount
		$this->BuildSearchSql($sWhere, $account_payments->Status_ID, FALSE); // Status_ID
		$this->BuildSearchSql($sWhere, $account_payments->Description, FALSE); // Description
		$this->BuildSearchSql($sWhere, $account_payments->Remarks, FALSE); // Remarks
		$this->BuildSearchSql($sWhere, $account_payments->User_ID, FALSE); // User_ID
		$this->BuildSearchSql($sWhere, $account_payments->Created, FALSE); // Created
		$this->BuildSearchSql($sWhere, $account_payments->Modified, FALSE); // Modified
		$this->BuildSearchSql($sWhere, $account_payments->total_invoice_items, FALSE); // total_invoice_items

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($account_payments->id); // id
			$this->SetSearchParm($account_payments->Date); // Date
			$this->SetSearchParm($account_payments->Payment_Reference); // Payment_Reference
			$this->SetSearchParm($account_payments->Payment_Date); // Payment_Date
			$this->SetSearchParm($account_payments->Payment_Type); // Payment_Type
			$this->SetSearchParm($account_payments->Journal_Type_ID); // Journal_Type_ID
			$this->SetSearchParm($account_payments->Journal_Account_ID); // Journal_Account_ID
			$this->SetSearchParm($account_payments->Payment_Method_ID); // Payment_Method_ID
			$this->SetSearchParm($account_payments->Vendor_ID); // Vendor_ID
			$this->SetSearchParm($account_payments->Client_ID); // Client_ID
			$this->SetSearchParm($account_payments->Amount); // Amount
			$this->SetSearchParm($account_payments->Status_ID); // Status_ID
			$this->SetSearchParm($account_payments->Description); // Description
			$this->SetSearchParm($account_payments->Remarks); // Remarks
			$this->SetSearchParm($account_payments->User_ID); // User_ID
			$this->SetSearchParm($account_payments->Created); // Created
			$this->SetSearchParm($account_payments->Modified); // Modified
			$this->SetSearchParm($account_payments->total_invoice_items); // total_invoice_items
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
		global $account_payments;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$account_payments->setAdvancedSearch("x_$FldParm", $FldVal);
		$account_payments->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$account_payments->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$account_payments->setAdvancedSearch("y_$FldParm", $FldVal2);
		$account_payments->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $account_payments;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $account_payments->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $account_payments->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $account_payments->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $account_payments->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $account_payments->GetAdvancedSearch("w_$FldParm");
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
		global $account_payments;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $account_payments->Payment_Reference, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $account_payments->Payment_Type, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $account_payments->Description, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $account_payments->Remarks, $Keyword);
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
		global $Security, $account_payments;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $account_payments->BasicSearchKeyword;
		$sSearchType = $account_payments->BasicSearchType;
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
			$account_payments->setSessionBasicSearchKeyword($sSearchKeyword);
			$account_payments->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $account_payments;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$account_payments->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $account_payments;
		$account_payments->setSessionBasicSearchKeyword("");
		$account_payments->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $account_payments;
		$account_payments->setAdvancedSearch("x_id", "");
		$account_payments->setAdvancedSearch("x_Date", "");
		$account_payments->setAdvancedSearch("x_Payment_Reference", "");
		$account_payments->setAdvancedSearch("x_Payment_Date", "");
		$account_payments->setAdvancedSearch("y_Payment_Date", "");
		$account_payments->setAdvancedSearch("x_Payment_Type", "");
		$account_payments->setAdvancedSearch("x_Journal_Type_ID", "");
		$account_payments->setAdvancedSearch("x_Journal_Account_ID", "");
		$account_payments->setAdvancedSearch("x_Payment_Method_ID", "");
		$account_payments->setAdvancedSearch("x_Vendor_ID", "");
		$account_payments->setAdvancedSearch("x_Client_ID", "");
		$account_payments->setAdvancedSearch("x_Amount", "");
		$account_payments->setAdvancedSearch("x_Status_ID", "");
		$account_payments->setAdvancedSearch("x_Description", "");
		$account_payments->setAdvancedSearch("x_Remarks", "");
		$account_payments->setAdvancedSearch("x_User_ID", "");
		$account_payments->setAdvancedSearch("x_Created", "");
		$account_payments->setAdvancedSearch("x_Modified", "");
		$account_payments->setAdvancedSearch("x_total_invoice_items", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $account_payments;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Payment_Reference"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Payment_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["y_Payment_Date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Payment_Type"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Journal_Type_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Journal_Account_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Payment_Method_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Vendor_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Client_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Amount"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Status_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Description"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Remarks"] <> "") $bRestore = FALSE;
		if (@$_GET["x_User_ID"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Created"] <> "") $bRestore = FALSE;
		if (@$_GET["x_Modified"] <> "") $bRestore = FALSE;
		if (@$_GET["x_total_invoice_items"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$account_payments->BasicSearchKeyword = $account_payments->getSessionBasicSearchKeyword();
			$account_payments->BasicSearchType = $account_payments->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($account_payments->id);
			$this->GetSearchParm($account_payments->Date);
			$this->GetSearchParm($account_payments->Payment_Reference);
			$this->GetSearchParm($account_payments->Payment_Date);
			$this->GetSearchParm($account_payments->Payment_Type);
			$this->GetSearchParm($account_payments->Journal_Type_ID);
			$this->GetSearchParm($account_payments->Journal_Account_ID);
			$this->GetSearchParm($account_payments->Payment_Method_ID);
			$this->GetSearchParm($account_payments->Vendor_ID);
			$this->GetSearchParm($account_payments->Client_ID);
			$this->GetSearchParm($account_payments->Amount);
			$this->GetSearchParm($account_payments->Status_ID);
			$this->GetSearchParm($account_payments->Description);
			$this->GetSearchParm($account_payments->Remarks);
			$this->GetSearchParm($account_payments->User_ID);
			$this->GetSearchParm($account_payments->Created);
			$this->GetSearchParm($account_payments->Modified);
			$this->GetSearchParm($account_payments->total_invoice_items);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $account_payments;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$account_payments->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$account_payments->CurrentOrderType = @$_GET["ordertype"];
			$account_payments->UpdateSort($account_payments->id); // id
			$account_payments->UpdateSort($account_payments->Date); // Date
			$account_payments->UpdateSort($account_payments->Payment_Reference); // Payment_Reference
			$account_payments->UpdateSort($account_payments->Payment_Date); // Payment_Date
			$account_payments->UpdateSort($account_payments->Payment_Type); // Payment_Type
			$account_payments->UpdateSort($account_payments->Journal_Type_ID); // Journal_Type_ID
			$account_payments->UpdateSort($account_payments->Journal_Account_ID); // Journal_Account_ID
			$account_payments->UpdateSort($account_payments->Payment_Method_ID); // Payment_Method_ID
			$account_payments->UpdateSort($account_payments->Vendor_ID); // Vendor_ID
			$account_payments->UpdateSort($account_payments->Client_ID); // Client_ID
			$account_payments->UpdateSort($account_payments->Amount); // Amount
			$account_payments->UpdateSort($account_payments->Status_ID); // Status_ID
			$account_payments->UpdateSort($account_payments->User_ID); // User_ID
			$account_payments->UpdateSort($account_payments->total_invoice_items); // total_invoice_items
			$account_payments->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $account_payments;
		$sOrderBy = $account_payments->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($account_payments->SqlOrderBy() <> "") {
				$sOrderBy = $account_payments->SqlOrderBy();
				$account_payments->setSessionOrderBy($sOrderBy);
				$account_payments->Payment_Date->setSort("DESC");
				$account_payments->Date->setSort("DESC");
				$account_payments->Journal_Account_ID->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $account_payments;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$account_payments->getCurrentMasterTable = ""; // Clear master table
				$account_payments->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$account_payments->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$account_payments->Client_ID->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$account_payments->setSessionOrderBy($sOrderBy);
				$account_payments->id->setSort("");
				$account_payments->Date->setSort("");
				$account_payments->Payment_Reference->setSort("");
				$account_payments->Payment_Date->setSort("");
				$account_payments->Payment_Type->setSort("");
				$account_payments->Journal_Type_ID->setSort("");
				$account_payments->Journal_Account_ID->setSort("");
				$account_payments->Payment_Method_ID->setSort("");
				$account_payments->Vendor_ID->setSort("");
				$account_payments->Client_ID->setSort("");
				$account_payments->Amount->setSort("");
				$account_payments->Status_ID->setSort("");
				$account_payments->User_ID->setSort("");
				$account_payments->total_invoice_items->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$account_payments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $account_payments;

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

		// "detail_journal_accounts"
		$this->ListOptions->Add("detail_journal_accounts");
		$item =& $this->ListOptions->Items["detail_journal_accounts"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('journal_accounts');
		$item->OnLeft = FALSE;

		// "detail_customer_invoices"
		$this->ListOptions->Add("detail_customer_invoices");
		$item =& $this->ListOptions->Items["detail_customer_invoices"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('customer_invoices');
		$item->OnLeft = FALSE;

		// "detail_all_file_uploads"
		$this->ListOptions->Add("detail_all_file_uploads");
		$item =& $this->ListOptions->Items["detail_all_file_uploads"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList('all_file_uploads');
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"account_payments_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($account_payments->Export <> "" ||
			$account_payments->CurrentAction == "gridadd" ||
			$account_payments->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $account_payments;
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

		// "detail_journal_accounts"
		$oListOpt =& $this->ListOptions->Items["detail_journal_accounts"];
		if ($Security->AllowList('journal_accounts')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("journal_accounts", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->ljournal_accounts_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"journal_accountslist.php?" . EW_TABLE_SHOW_MASTER . "=account_payments&Journal_Account_ID=" . urlencode(strval($account_payments->Journal_Account_ID->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_customer_invoices"
		$oListOpt =& $this->ListOptions->Items["detail_customer_invoices"];
		if ($Security->AllowList('customer_invoices')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("customer_invoices", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lcustomer_invoices_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"customer_invoiceslist.php?" . EW_TABLE_SHOW_MASTER . "=account_payments&id=" . urlencode(strval($account_payments->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "detail_all_file_uploads"
		$oListOpt =& $this->ListOptions->Items["detail_all_file_uploads"];
		if ($Security->AllowList('all_file_uploads')) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("all_file_uploads", "TblCaption");
			$oListOpt->Body .= str_replace("%c", $this->lall_file_uploads_Count, $Language->Phrase("DetailCount"));
			$oListOpt->Body = "<a href=\"all_file_uploadslist.php?" . EW_TABLE_SHOW_MASTER . "=account_payments&id=" . urlencode(strval($account_payments->id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($account_payments->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $account_payments;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $account_payments;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$account_payments->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$account_payments->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $account_payments->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$account_payments->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$account_payments->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$account_payments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $account_payments;
		$account_payments->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$account_payments->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $account_payments;

		// Load search values
		// id

		$account_payments->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$account_payments->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// Date
		$account_payments->Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Date"]);
		$account_payments->Date->AdvancedSearch->SearchOperator = @$_GET["z_Date"];

		// Payment_Reference
		$account_payments->Payment_Reference->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Payment_Reference"]);
		$account_payments->Payment_Reference->AdvancedSearch->SearchOperator = @$_GET["z_Payment_Reference"];

		// Payment_Date
		$account_payments->Payment_Date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Payment_Date"]);
		$account_payments->Payment_Date->AdvancedSearch->SearchOperator = @$_GET["z_Payment_Date"];
		$account_payments->Payment_Date->AdvancedSearch->SearchCondition = @$_GET["v_Payment_Date"];
		$account_payments->Payment_Date->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_Payment_Date"]);
		$account_payments->Payment_Date->AdvancedSearch->SearchOperator2 = @$_GET["w_Payment_Date"];

		// Payment_Type
		$account_payments->Payment_Type->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Payment_Type"]);
		$account_payments->Payment_Type->AdvancedSearch->SearchOperator = @$_GET["z_Payment_Type"];

		// Journal_Type_ID
		$account_payments->Journal_Type_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Journal_Type_ID"]);
		$account_payments->Journal_Type_ID->AdvancedSearch->SearchOperator = @$_GET["z_Journal_Type_ID"];

		// Journal_Account_ID
		$account_payments->Journal_Account_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Journal_Account_ID"]);
		$account_payments->Journal_Account_ID->AdvancedSearch->SearchOperator = @$_GET["z_Journal_Account_ID"];

		// Payment_Method_ID
		$account_payments->Payment_Method_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Payment_Method_ID"]);
		$account_payments->Payment_Method_ID->AdvancedSearch->SearchOperator = @$_GET["z_Payment_Method_ID"];

		// Vendor_ID
		$account_payments->Vendor_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Vendor_ID"]);
		$account_payments->Vendor_ID->AdvancedSearch->SearchOperator = @$_GET["z_Vendor_ID"];

		// Client_ID
		$account_payments->Client_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Client_ID"]);
		$account_payments->Client_ID->AdvancedSearch->SearchOperator = @$_GET["z_Client_ID"];

		// Amount
		$account_payments->Amount->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Amount"]);
		$account_payments->Amount->AdvancedSearch->SearchOperator = @$_GET["z_Amount"];

		// Status_ID
		$account_payments->Status_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Status_ID"]);
		$account_payments->Status_ID->AdvancedSearch->SearchOperator = @$_GET["z_Status_ID"];

		// Description
		$account_payments->Description->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Description"]);
		$account_payments->Description->AdvancedSearch->SearchOperator = @$_GET["z_Description"];

		// Remarks
		$account_payments->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Remarks"]);
		$account_payments->Remarks->AdvancedSearch->SearchOperator = @$_GET["z_Remarks"];

		// User_ID
		$account_payments->User_ID->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_User_ID"]);
		$account_payments->User_ID->AdvancedSearch->SearchOperator = @$_GET["z_User_ID"];

		// Created
		$account_payments->Created->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Created"]);
		$account_payments->Created->AdvancedSearch->SearchOperator = @$_GET["z_Created"];

		// Modified
		$account_payments->Modified->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Modified"]);
		$account_payments->Modified->AdvancedSearch->SearchOperator = @$_GET["z_Modified"];

		// total_invoice_items
		$account_payments->total_invoice_items->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_total_invoice_items"]);
		$account_payments->total_invoice_items->AdvancedSearch->SearchOperator = @$_GET["z_total_invoice_items"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $account_payments;

		// Call Recordset Selecting event
		$account_payments->Recordset_Selecting($account_payments->CurrentFilter);

		// Load List page SQL
		$sSql = $account_payments->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$account_payments->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $account_payments;
		$sFilter = $account_payments->KeyFilter();

		// Call Row Selecting event
		$account_payments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$account_payments->CurrentFilter = $sFilter;
		$sSql = $account_payments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$account_payments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $account_payments;
		$account_payments->id->setDbValue($rs->fields('id'));
		$account_payments->Date->setDbValue($rs->fields('Date'));
		$account_payments->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$account_payments->Payment_Date->setDbValue($rs->fields('Payment_Date'));
		$account_payments->Payment_Type->setDbValue($rs->fields('Payment_Type'));
		$account_payments->Journal_Type_ID->setDbValue($rs->fields('Journal_Type_ID'));
		$account_payments->Journal_Account_ID->setDbValue($rs->fields('Journal_Account_ID'));
		$account_payments->Payment_Method_ID->setDbValue($rs->fields('Payment_Method_ID'));
		$account_payments->Vendor_ID->setDbValue($rs->fields('Vendor_ID'));
		$account_payments->Client_ID->setDbValue($rs->fields('Client_ID'));
		$account_payments->Amount->setDbValue($rs->fields('Amount'));
		$account_payments->Status_ID->setDbValue($rs->fields('Status_ID'));
		$account_payments->Description->setDbValue($rs->fields('Description'));
		$account_payments->Remarks->setDbValue($rs->fields('Remarks'));
		$account_payments->User_ID->setDbValue($rs->fields('User_ID'));
		$account_payments->Created->setDbValue($rs->fields('Created'));
		$account_payments->Modified->setDbValue($rs->fields('Modified'));
		$account_payments->total_invoice_items->setDbValue($rs->fields('total_invoice_items'));
		$sDetailFilter = $GLOBALS["journal_accounts"]->SqlDetailFilter_account_payments();
		$sDetailFilter = str_replace("@id@", ew_AdjustSql($account_payments->Journal_Account_ID->DbValue), $sDetailFilter);
		$this->ljournal_accounts_Count = $GLOBALS["journal_accounts"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["customer_invoices"]->SqlDetailFilter_account_payments();
		$sDetailFilter = str_replace("@Payment_ID@", ew_AdjustSql($account_payments->id->DbValue), $sDetailFilter);
		$this->lcustomer_invoices_Count = $GLOBALS["customer_invoices"]->LoadRecordCount($sDetailFilter);
		$sDetailFilter = $GLOBALS["all_file_uploads"]->SqlDetailFilter_account_payments();
		$sDetailFilter = str_replace("@file_id@", ew_AdjustSql($account_payments->id->DbValue), $sDetailFilter);
		$this->lall_file_uploads_Count = $GLOBALS["all_file_uploads"]->LoadRecordCount($sDetailFilter);
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $account_payments;

		// Initialize URLs
		$this->ViewUrl = $account_payments->ViewUrl();
		$this->EditUrl = $account_payments->EditUrl();
		$this->InlineEditUrl = $account_payments->InlineEditUrl();
		$this->CopyUrl = $account_payments->CopyUrl();
		$this->InlineCopyUrl = $account_payments->InlineCopyUrl();
		$this->DeleteUrl = $account_payments->DeleteUrl();

		// Call Row_Rendering event
		$account_payments->Row_Rendering();

		// Common render codes for all row types
		// id

		$account_payments->id->CellCssStyle = ""; $account_payments->id->CellCssClass = "";
		$account_payments->id->CellAttrs = array(); $account_payments->id->ViewAttrs = array(); $account_payments->id->EditAttrs = array();

		// Date
		$account_payments->Date->CellCssStyle = ""; $account_payments->Date->CellCssClass = "";
		$account_payments->Date->CellAttrs = array(); $account_payments->Date->ViewAttrs = array(); $account_payments->Date->EditAttrs = array();

		// Payment_Reference
		$account_payments->Payment_Reference->CellCssStyle = ""; $account_payments->Payment_Reference->CellCssClass = "";
		$account_payments->Payment_Reference->CellAttrs = array(); $account_payments->Payment_Reference->ViewAttrs = array(); $account_payments->Payment_Reference->EditAttrs = array();

		// Payment_Date
		$account_payments->Payment_Date->CellCssStyle = ""; $account_payments->Payment_Date->CellCssClass = "";
		$account_payments->Payment_Date->CellAttrs = array(); $account_payments->Payment_Date->ViewAttrs = array(); $account_payments->Payment_Date->EditAttrs = array();

		// Payment_Type
		$account_payments->Payment_Type->CellCssStyle = ""; $account_payments->Payment_Type->CellCssClass = "";
		$account_payments->Payment_Type->CellAttrs = array(); $account_payments->Payment_Type->ViewAttrs = array(); $account_payments->Payment_Type->EditAttrs = array();

		// Journal_Type_ID
		$account_payments->Journal_Type_ID->CellCssStyle = ""; $account_payments->Journal_Type_ID->CellCssClass = "";
		$account_payments->Journal_Type_ID->CellAttrs = array(); $account_payments->Journal_Type_ID->ViewAttrs = array(); $account_payments->Journal_Type_ID->EditAttrs = array();

		// Journal_Account_ID
		$account_payments->Journal_Account_ID->CellCssStyle = ""; $account_payments->Journal_Account_ID->CellCssClass = "";
		$account_payments->Journal_Account_ID->CellAttrs = array(); $account_payments->Journal_Account_ID->ViewAttrs = array(); $account_payments->Journal_Account_ID->EditAttrs = array();

		// Payment_Method_ID
		$account_payments->Payment_Method_ID->CellCssStyle = ""; $account_payments->Payment_Method_ID->CellCssClass = "";
		$account_payments->Payment_Method_ID->CellAttrs = array(); $account_payments->Payment_Method_ID->ViewAttrs = array(); $account_payments->Payment_Method_ID->EditAttrs = array();

		// Vendor_ID
		$account_payments->Vendor_ID->CellCssStyle = ""; $account_payments->Vendor_ID->CellCssClass = "";
		$account_payments->Vendor_ID->CellAttrs = array(); $account_payments->Vendor_ID->ViewAttrs = array(); $account_payments->Vendor_ID->EditAttrs = array();

		// Client_ID
		$account_payments->Client_ID->CellCssStyle = ""; $account_payments->Client_ID->CellCssClass = "";
		$account_payments->Client_ID->CellAttrs = array(); $account_payments->Client_ID->ViewAttrs = array(); $account_payments->Client_ID->EditAttrs = array();

		// Amount
		$account_payments->Amount->CellCssStyle = ""; $account_payments->Amount->CellCssClass = "";
		$account_payments->Amount->CellAttrs = array(); $account_payments->Amount->ViewAttrs = array(); $account_payments->Amount->EditAttrs = array();

		// Status_ID
		$account_payments->Status_ID->CellCssStyle = ""; $account_payments->Status_ID->CellCssClass = "";
		$account_payments->Status_ID->CellAttrs = array(); $account_payments->Status_ID->ViewAttrs = array(); $account_payments->Status_ID->EditAttrs = array();

		// User_ID
		$account_payments->User_ID->CellCssStyle = ""; $account_payments->User_ID->CellCssClass = "";
		$account_payments->User_ID->CellAttrs = array(); $account_payments->User_ID->ViewAttrs = array(); $account_payments->User_ID->EditAttrs = array();

		// total_invoice_items
		$account_payments->total_invoice_items->CellCssStyle = ""; $account_payments->total_invoice_items->CellCssClass = "";
		$account_payments->total_invoice_items->CellAttrs = array(); $account_payments->total_invoice_items->ViewAttrs = array(); $account_payments->total_invoice_items->EditAttrs = array();

		// Accumulate aggregate value
		if ($account_payments->RowType <> EW_ROWTYPE_AGGREGATEINIT && $account_payments->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($account_payments->Amount->CurrentValue))
				$account_payments->Amount->Total += $account_payments->Amount->CurrentValue; // Accumulate total
		}
		if ($account_payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$account_payments->id->ViewValue = $account_payments->id->CurrentValue;
			$account_payments->id->CssStyle = "";
			$account_payments->id->CssClass = "";
			$account_payments->id->ViewCustomAttributes = "";

			// Date
			$account_payments->Date->ViewValue = $account_payments->Date->CurrentValue;
			$account_payments->Date->ViewValue = ew_FormatDateTime($account_payments->Date->ViewValue, 6);
			$account_payments->Date->CssStyle = "";
			$account_payments->Date->CssClass = "";
			$account_payments->Date->ViewCustomAttributes = "";

			// Payment_Reference
			$account_payments->Payment_Reference->ViewValue = $account_payments->Payment_Reference->CurrentValue;
			$account_payments->Payment_Reference->CssStyle = "";
			$account_payments->Payment_Reference->CssClass = "";
			$account_payments->Payment_Reference->ViewCustomAttributes = "";

			// Payment_Date
			$account_payments->Payment_Date->ViewValue = $account_payments->Payment_Date->CurrentValue;
			$account_payments->Payment_Date->ViewValue = ew_FormatDateTime($account_payments->Payment_Date->ViewValue, 6);
			$account_payments->Payment_Date->CssStyle = "";
			$account_payments->Payment_Date->CssClass = "";
			$account_payments->Payment_Date->ViewCustomAttributes = "";

			// Payment_Type
			if (strval($account_payments->Payment_Type->CurrentValue) <> "") {
				switch ($account_payments->Payment_Type->CurrentValue) {
					case "payment_send":
						$account_payments->Payment_Type->ViewValue = "Payment Send";
						break;
					case "payment_received":
						$account_payments->Payment_Type->ViewValue = "Payment Received";
						break;
					default:
						$account_payments->Payment_Type->ViewValue = $account_payments->Payment_Type->CurrentValue;
				}
			} else {
				$account_payments->Payment_Type->ViewValue = NULL;
			}
			$account_payments->Payment_Type->CssStyle = "";
			$account_payments->Payment_Type->CssClass = "";
			$account_payments->Payment_Type->ViewCustomAttributes = "";

			// Journal_Type_ID
			if (strval($account_payments->Journal_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Journal_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Journal_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Journal_Type_ID->ViewValue = $rswrk->fields('Journal_Name');
					$rswrk->Close();
				} else {
					$account_payments->Journal_Type_ID->ViewValue = $account_payments->Journal_Type_ID->CurrentValue;
				}
			} else {
				$account_payments->Journal_Type_ID->ViewValue = NULL;
			}
			$account_payments->Journal_Type_ID->CssStyle = "";
			$account_payments->Journal_Type_ID->CssClass = "";
			$account_payments->Journal_Type_ID->ViewCustomAttributes = "";

			// Journal_Account_ID
			if (strval($account_payments->Journal_Account_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Journal_Account_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Account_Reference_No` FROM `journal_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Business_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Journal_Account_ID->ViewValue = $rswrk->fields('Account_Reference_No');
					$rswrk->Close();
				} else {
					$account_payments->Journal_Account_ID->ViewValue = $account_payments->Journal_Account_ID->CurrentValue;
				}
			} else {
				$account_payments->Journal_Account_ID->ViewValue = NULL;
			}
			$account_payments->Journal_Account_ID->CssStyle = "";
			$account_payments->Journal_Account_ID->CssClass = "";
			$account_payments->Journal_Account_ID->ViewCustomAttributes = "";

			// Payment_Method_ID
			if (strval($account_payments->Payment_Method_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Payment_Method_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Payment_Method` FROM `account_payment_methods`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Payment_Method_ID->ViewValue = $rswrk->fields('Payment_Method');
					$rswrk->Close();
				} else {
					$account_payments->Payment_Method_ID->ViewValue = $account_payments->Payment_Method_ID->CurrentValue;
				}
			} else {
				$account_payments->Payment_Method_ID->ViewValue = NULL;
			}
			$account_payments->Payment_Method_ID->CssStyle = "";
			$account_payments->Payment_Method_ID->CssClass = "";
			$account_payments->Payment_Method_ID->ViewCustomAttributes = "";

			// Vendor_ID
			if (strval($account_payments->Vendor_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Vendor_ID->CurrentValue) . "";
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
					$account_payments->Vendor_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$account_payments->Vendor_ID->ViewValue = $account_payments->Vendor_ID->CurrentValue;
				}
			} else {
				$account_payments->Vendor_ID->ViewValue = NULL;
			}
			$account_payments->Vendor_ID->CssStyle = "";
			$account_payments->Vendor_ID->CssClass = "";
			$account_payments->Vendor_ID->ViewCustomAttributes = "";

			// Client_ID
			if (strval($account_payments->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$account_payments->Client_ID->ViewValue = $account_payments->Client_ID->CurrentValue;
				}
			} else {
				$account_payments->Client_ID->ViewValue = NULL;
			}
			$account_payments->Client_ID->CssStyle = "";
			$account_payments->Client_ID->CssClass = "";
			$account_payments->Client_ID->ViewCustomAttributes = "";

			// Amount
			$account_payments->Amount->ViewValue = $account_payments->Amount->CurrentValue;
			$account_payments->Amount->ViewValue = ew_FormatNumber($account_payments->Amount->ViewValue, 2, -2, -2, -2);
			$account_payments->Amount->CssStyle = "";
			$account_payments->Amount->CssClass = "";
			$account_payments->Amount->ViewCustomAttributes = "";

			// Status_ID
			if (strval($account_payments->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$account_payments->Status_ID->ViewValue = $account_payments->Status_ID->CurrentValue;
				}
			} else {
				$account_payments->Status_ID->ViewValue = NULL;
			}
			$account_payments->Status_ID->CssStyle = "";
			$account_payments->Status_ID->CssClass = "";
			$account_payments->Status_ID->ViewCustomAttributes = "";

			// User_ID
			$account_payments->User_ID->ViewValue = $account_payments->User_ID->CurrentValue;
			$account_payments->User_ID->CssStyle = "";
			$account_payments->User_ID->CssClass = "";
			$account_payments->User_ID->ViewCustomAttributes = "";

			// Created
			$account_payments->Created->ViewValue = $account_payments->Created->CurrentValue;
			$account_payments->Created->ViewValue = ew_FormatDateTime($account_payments->Created->ViewValue, 6);
			$account_payments->Created->CssStyle = "";
			$account_payments->Created->CssClass = "";
			$account_payments->Created->ViewCustomAttributes = "";

			// Modified
			$account_payments->Modified->ViewValue = $account_payments->Modified->CurrentValue;
			$account_payments->Modified->ViewValue = ew_FormatDateTime($account_payments->Modified->ViewValue, 6);
			$account_payments->Modified->CssStyle = "";
			$account_payments->Modified->CssClass = "";
			$account_payments->Modified->ViewCustomAttributes = "";

			// total_invoice_items
			$account_payments->total_invoice_items->ViewValue = $account_payments->total_invoice_items->CurrentValue;
			$account_payments->total_invoice_items->CssStyle = "";
			$account_payments->total_invoice_items->CssClass = "";
			$account_payments->total_invoice_items->ViewCustomAttributes = "";

			// id
			$account_payments->id->HrefValue = "";
			$account_payments->id->TooltipValue = "";

			// Date
			$account_payments->Date->HrefValue = "";
			$account_payments->Date->TooltipValue = "";

			// Payment_Reference
			$account_payments->Payment_Reference->HrefValue = "";
			$account_payments->Payment_Reference->TooltipValue = "";

			// Payment_Date
			$account_payments->Payment_Date->HrefValue = "";
			$account_payments->Payment_Date->TooltipValue = "";

			// Payment_Type
			$account_payments->Payment_Type->HrefValue = "";
			$account_payments->Payment_Type->TooltipValue = "";

			// Journal_Type_ID
			$account_payments->Journal_Type_ID->HrefValue = "";
			$account_payments->Journal_Type_ID->TooltipValue = "";

			// Journal_Account_ID
			$account_payments->Journal_Account_ID->HrefValue = "";
			$account_payments->Journal_Account_ID->TooltipValue = "";

			// Payment_Method_ID
			$account_payments->Payment_Method_ID->HrefValue = "";
			$account_payments->Payment_Method_ID->TooltipValue = "";

			// Vendor_ID
			$account_payments->Vendor_ID->HrefValue = "";
			$account_payments->Vendor_ID->TooltipValue = "";

			// Client_ID
			$account_payments->Client_ID->HrefValue = "";
			$account_payments->Client_ID->TooltipValue = "";

			// Amount
			$account_payments->Amount->HrefValue = "";
			$account_payments->Amount->TooltipValue = "";

			// Status_ID
			$account_payments->Status_ID->HrefValue = "";
			$account_payments->Status_ID->TooltipValue = "";

			// User_ID
			$account_payments->User_ID->HrefValue = "";
			$account_payments->User_ID->TooltipValue = "";

			// total_invoice_items
			$account_payments->total_invoice_items->HrefValue = "";
			$account_payments->total_invoice_items->TooltipValue = "";
		} elseif ($account_payments->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$account_payments->id->EditCustomAttributes = "";
			$account_payments->id->EditValue = ew_HtmlEncode($account_payments->id->AdvancedSearch->SearchValue);

			// Date
			$account_payments->Date->EditCustomAttributes = "";
			$account_payments->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($account_payments->Date->AdvancedSearch->SearchValue, 6), 6));

			// Payment_Reference
			$account_payments->Payment_Reference->EditCustomAttributes = "";
			$account_payments->Payment_Reference->EditValue = ew_HtmlEncode($account_payments->Payment_Reference->AdvancedSearch->SearchValue);

			// Payment_Date
			$account_payments->Payment_Date->EditCustomAttributes = "";
			$account_payments->Payment_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($account_payments->Payment_Date->AdvancedSearch->SearchValue, 6), 6));
			$account_payments->Payment_Date->EditCustomAttributes = "";
			$account_payments->Payment_Date->EditValue2 = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($account_payments->Payment_Date->AdvancedSearch->SearchValue2, 6), 6));

			// Payment_Type
			$account_payments->Payment_Type->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("payment_send", "Payment Send");
			$arwrk[] = array("payment_received", "Payment Received");
			$account_payments->Payment_Type->EditValue = $arwrk;

			// Journal_Type_ID
			$account_payments->Journal_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Journal_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Journal_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$account_payments->Journal_Type_ID->EditValue = $arwrk;

			// Journal_Account_ID
			$account_payments->Journal_Account_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Account_Reference_No`, '' AS Disp2Fld, `journal_type_id` FROM `journal_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Business_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$account_payments->Journal_Account_ID->EditValue = $arwrk;

			// Payment_Method_ID
			$account_payments->Payment_Method_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Payment_Method`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `account_payment_methods`";
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
			$account_payments->Payment_Method_ID->EditValue = $arwrk;

			// Vendor_ID
			$account_payments->Vendor_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Subcon_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$account_payments->Vendor_ID->EditValue = $arwrk;

			// Client_ID
			$account_payments->Client_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Client_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$account_payments->Client_ID->EditValue = $arwrk;

			// Amount
			$account_payments->Amount->EditCustomAttributes = "";
			$account_payments->Amount->EditValue = ew_HtmlEncode($account_payments->Amount->AdvancedSearch->SearchValue);

			// Status_ID
			$account_payments->Status_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Status`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `statuses`";
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
			$account_payments->Status_ID->EditValue = $arwrk;

			// User_ID
			$account_payments->User_ID->EditCustomAttributes = "";
			$account_payments->User_ID->EditValue = ew_HtmlEncode($account_payments->User_ID->AdvancedSearch->SearchValue);

			// total_invoice_items
			$account_payments->total_invoice_items->EditCustomAttributes = "";
			$account_payments->total_invoice_items->EditValue = ew_HtmlEncode($account_payments->total_invoice_items->AdvancedSearch->SearchValue);
		} elseif ($account_payments->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$account_payments->Amount->Total = 0; // Initialize total
		} elseif ($account_payments->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$account_payments->Amount->CurrentValue = $account_payments->Amount->Total;
			$account_payments->Amount->ViewValue = $account_payments->Amount->CurrentValue;
			$account_payments->Amount->ViewValue = ew_FormatNumber($account_payments->Amount->ViewValue, 2, -2, -2, -2);
			$account_payments->Amount->CssStyle = "";
			$account_payments->Amount->CssClass = "";
			$account_payments->Amount->ViewCustomAttributes = "";
			$account_payments->Amount->HrefValue = ""; // Clear href value
		}

		// Call Row Rendered event
		if ($account_payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$account_payments->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $account_payments;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckUSDate($account_payments->Payment_Date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->Payment_Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($account_payments->Payment_Date->AdvancedSearch->SearchValue2)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $account_payments->Payment_Date->FldErrMsg();
		}

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
		global $account_payments;
		$account_payments->id->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_id");
		$account_payments->Date->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Date");
		$account_payments->Payment_Reference->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Payment_Reference");
		$account_payments->Payment_Date->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Payment_Date");
		$account_payments->Payment_Date->AdvancedSearch->SearchValue2 = $account_payments->getAdvancedSearch("y_Payment_Date");
		$account_payments->Payment_Type->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Payment_Type");
		$account_payments->Journal_Type_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Journal_Type_ID");
		$account_payments->Journal_Account_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Journal_Account_ID");
		$account_payments->Payment_Method_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Payment_Method_ID");
		$account_payments->Vendor_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Vendor_ID");
		$account_payments->Client_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Client_ID");
		$account_payments->Amount->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Amount");
		$account_payments->Status_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Status_ID");
		$account_payments->Description->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Description");
		$account_payments->Remarks->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Remarks");
		$account_payments->User_ID->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_User_ID");
		$account_payments->Created->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Created");
		$account_payments->Modified->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_Modified");
		$account_payments->total_invoice_items->AdvancedSearch->SearchValue = $account_payments->getAdvancedSearch("x_total_invoice_items");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $account_payments;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $account_payments->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Initialize aggregates
		$account_payments->RowType = EW_ROWTYPE_AGGREGATEINIT;
		$this->RenderRow();

		// Export all
		if ($account_payments->ExportAll) {
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
		if ($account_payments->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($account_payments, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($account_payments->id);
				$ExportDoc->ExportCaption($account_payments->Date);
				$ExportDoc->ExportCaption($account_payments->Payment_Reference);
				$ExportDoc->ExportCaption($account_payments->Payment_Date);
				$ExportDoc->ExportCaption($account_payments->Payment_Type);
				$ExportDoc->ExportCaption($account_payments->Journal_Type_ID);
				$ExportDoc->ExportCaption($account_payments->Journal_Account_ID);
				$ExportDoc->ExportCaption($account_payments->Payment_Method_ID);
				$ExportDoc->ExportCaption($account_payments->Vendor_ID);
				$ExportDoc->ExportCaption($account_payments->Client_ID);
				$ExportDoc->ExportCaption($account_payments->Amount);
				$ExportDoc->ExportCaption($account_payments->Status_ID);
				$ExportDoc->ExportCaption($account_payments->User_ID);
				$ExportDoc->ExportCaption($account_payments->Created);
				$ExportDoc->ExportCaption($account_payments->Modified);
				$ExportDoc->ExportCaption($account_payments->total_invoice_items);
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
				$account_payments->CssClass = "";
				$account_payments->CssStyle = "";
				$account_payments->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($account_payments->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $account_payments->id->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Date', $account_payments->Date->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Payment_Reference', $account_payments->Payment_Reference->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Payment_Date', $account_payments->Payment_Date->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Payment_Type', $account_payments->Payment_Type->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Journal_Type_ID', $account_payments->Journal_Type_ID->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Journal_Account_ID', $account_payments->Journal_Account_ID->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Payment_Method_ID', $account_payments->Payment_Method_ID->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Vendor_ID', $account_payments->Vendor_ID->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Client_ID', $account_payments->Client_ID->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Amount', $account_payments->Amount->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Status_ID', $account_payments->Status_ID->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('User_ID', $account_payments->User_ID->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Created', $account_payments->Created->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('Modified', $account_payments->Modified->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
					$XmlDoc->AddField('total_invoice_items', $account_payments->total_invoice_items->ExportValue($account_payments->Export, $account_payments->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($account_payments->id);
					$ExportDoc->ExportField($account_payments->Date);
					$ExportDoc->ExportField($account_payments->Payment_Reference);
					$ExportDoc->ExportField($account_payments->Payment_Date);
					$ExportDoc->ExportField($account_payments->Payment_Type);
					$ExportDoc->ExportField($account_payments->Journal_Type_ID);
					$ExportDoc->ExportField($account_payments->Journal_Account_ID);
					$ExportDoc->ExportField($account_payments->Payment_Method_ID);
					$ExportDoc->ExportField($account_payments->Vendor_ID);
					$ExportDoc->ExportField($account_payments->Client_ID);
					$ExportDoc->ExportField($account_payments->Amount);
					$ExportDoc->ExportField($account_payments->Status_ID);
					$ExportDoc->ExportField($account_payments->User_ID);
					$ExportDoc->ExportField($account_payments->Created);
					$ExportDoc->ExportField($account_payments->Modified);
					$ExportDoc->ExportField($account_payments->total_invoice_items);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}

		// Export aggregates (non-XML and horizontal format only)
		if ($account_payments->Export <> "xml" && $ExportDoc->Horizontal) {
			$account_payments->RowType = EW_ROWTYPE_AGGREGATE;
			$this->RenderRow();
			$ExportDoc->BeginExportRow();
			$ExportDoc->ExportAggregate($account_payments->id, '');
			$ExportDoc->ExportAggregate($account_payments->Date, '');
			$ExportDoc->ExportAggregate($account_payments->Payment_Reference, '');
			$ExportDoc->ExportAggregate($account_payments->Payment_Date, '');
			$ExportDoc->ExportAggregate($account_payments->Payment_Type, '');
			$ExportDoc->ExportAggregate($account_payments->Journal_Type_ID, '');
			$ExportDoc->ExportAggregate($account_payments->Journal_Account_ID, '');
			$ExportDoc->ExportAggregate($account_payments->Payment_Method_ID, '');
			$ExportDoc->ExportAggregate($account_payments->Vendor_ID, '');
			$ExportDoc->ExportAggregate($account_payments->Client_ID, '');
			$ExportDoc->ExportAggregate($account_payments->Amount, 'TOTAL');
			$ExportDoc->ExportAggregate($account_payments->Status_ID, '');
			$ExportDoc->ExportAggregate($account_payments->User_ID, '');
			$ExportDoc->ExportAggregate($account_payments->Created, '');
			$ExportDoc->ExportAggregate($account_payments->Modified, '');
			$ExportDoc->ExportAggregate($account_payments->total_invoice_items, '');
			$ExportDoc->EndExportRow();
		}
		if ($account_payments->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($account_payments->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($account_payments->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($account_payments->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($account_payments->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $account_payments;
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
				$this->sDbMasterFilter = $account_payments->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $account_payments->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$account_payments->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$account_payments->Client_ID->setSessionValue($account_payments->Client_ID->QueryStringValue);
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
			$account_payments->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$account_payments->setStartRecordNumber($this->lStartRec);
			$account_payments->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$account_payments->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($account_payments->Client_ID->QueryStringValue == "") $account_payments->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $account_payments->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $account_payments->getDetailFilter(); // Restore detail filter
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
