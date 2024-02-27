<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "invoicesinfo.php" ?>
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
$invoices_edit = new cinvoices_edit();
$Page =& $invoices_edit;

// Page init
$invoices_edit->Page_Init();

// Page main
$invoices_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var invoices_edit = new ew_Page("invoices_edit");

// page properties
invoices_edit.PageID = "edit"; // page ID
invoices_edit.FormID = "finvoicesedit"; // form ID
var EW_PAGE_ID = invoices_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
invoices_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Client_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($invoices->Client_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Invoice_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Invoice_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Due_Date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($invoices->Due_Date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Due_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Due_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Vat"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Total_Vat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_WTax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Total_WTax->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Freight"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Total_Freight->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Amount_Due"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoices->Total_Amount_Due->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Recipient_Bank"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($invoices->Recipient_Bank->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
invoices_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoices_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoices_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoices_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoices->TableCaption() ?><br><br>
<a href="<?php echo $invoices->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoices_edit->ShowMessage();
?>
<form name="finvoicesedit" id="finvoicesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return invoices_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="invoices">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($invoices->id->Visible) { // id ?>
	<tr<?php echo $invoices->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->id->FldCaption() ?></td>
		<td<?php echo $invoices->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $invoices->id->ViewAttributes() ?>><?php echo $invoices->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($invoices->id->CurrentValue) ?>">
</span><?php echo $invoices->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Client_ID->Visible) { // Client_ID ?>
	<tr<?php echo $invoices->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Client_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $invoices->Client_ID->CellAttributes() ?>><span id="el_Client_ID">
<?php if ($invoices->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $invoices->Client_ID->ViewAttributes() ?>><?php echo $invoices->Client_ID->ViewValue ?></div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($invoices->Client_ID->CurrentValue) ?>">
<?php } else { ?>
<?php $invoices->Client_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_payment_period','x_Client_ID',invoices_edit.ar_x_payment_period); " . @$invoices->Client_ID->EditAttrs["onchange"]; ?>
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $invoices->Client_ID->FldTitle() ?>"<?php echo $invoices->Client_ID->EditAttributes() ?>>
<?php
if (is_array($invoices->Client_ID->EditValue)) {
	$arwrk = $invoices->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->Client_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $invoices->Client_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Invoice_Date->Visible) { // Invoice_Date ?>
	<tr<?php echo $invoices->Invoice_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Invoice_Date->FldCaption() ?></td>
		<td<?php echo $invoices->Invoice_Date->CellAttributes() ?>><span id="el_Invoice_Date">
<input type="text" name="x_Invoice_Date" id="x_Invoice_Date" title="<?php echo $invoices->Invoice_Date->FldTitle() ?>" value="<?php echo $invoices->Invoice_Date->EditValue ?>"<?php echo $invoices->Invoice_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Invoice_Date" name="cal_x_Invoice_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Invoice_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Invoice_Date" // button id
});
</script>
</span><?php echo $invoices->Invoice_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Due_Date->Visible) { // Due_Date ?>
	<tr<?php echo $invoices->Due_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Due_Date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $invoices->Due_Date->CellAttributes() ?>><span id="el_Due_Date">
<input type="text" name="x_Due_Date" id="x_Due_Date" title="<?php echo $invoices->Due_Date->FldTitle() ?>" value="<?php echo $invoices->Due_Date->EditValue ?>"<?php echo $invoices->Due_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Due_Date" name="cal_x_Due_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Due_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Due_Date" // button id
});
</script>
</span><?php echo $invoices->Due_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->payment_period->Visible) { // payment_period ?>
	<tr<?php echo $invoices->payment_period->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->payment_period->FldCaption() ?></td>
		<td<?php echo $invoices->payment_period->CellAttributes() ?>><span id="el_payment_period">
<select id="x_payment_period" name="x_payment_period" title="<?php echo $invoices->payment_period->FldTitle() ?>"<?php echo $invoices->payment_period->EditAttributes() ?>>
<?php
if (is_array($invoices->payment_period->EditValue)) {
	$arwrk = $invoices->payment_period->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->payment_period->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if (is_array($invoices->payment_period->EditValue)) {
	$arwrk = $invoices->payment_period->EditValue;
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
invoices_edit.ar_x_payment_period = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $invoices->payment_period->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Total_Vat->Visible) { // Total_Vat ?>
	<tr<?php echo $invoices->Total_Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Vat->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Vat->CellAttributes() ?>><span id="el_Total_Vat">
<input type="text" name="x_Total_Vat" id="x_Total_Vat" title="<?php echo $invoices->Total_Vat->FldTitle() ?>" size="30" value="<?php echo $invoices->Total_Vat->EditValue ?>"<?php echo $invoices->Total_Vat->EditAttributes() ?>>
</span><?php echo $invoices->Total_Vat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Total_WTax->Visible) { // Total_WTax ?>
	<tr<?php echo $invoices->Total_WTax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_WTax->FldCaption() ?></td>
		<td<?php echo $invoices->Total_WTax->CellAttributes() ?>><span id="el_Total_WTax">
<input type="text" name="x_Total_WTax" id="x_Total_WTax" title="<?php echo $invoices->Total_WTax->FldTitle() ?>" size="30" value="<?php echo $invoices->Total_WTax->EditValue ?>"<?php echo $invoices->Total_WTax->EditAttributes() ?>>
</span><?php echo $invoices->Total_WTax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Total_Freight->Visible) { // Total_Freight ?>
	<tr<?php echo $invoices->Total_Freight->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Freight->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Freight->CellAttributes() ?>><span id="el_Total_Freight">
<input type="text" name="x_Total_Freight" id="x_Total_Freight" title="<?php echo $invoices->Total_Freight->FldTitle() ?>" size="30" value="<?php echo $invoices->Total_Freight->EditValue ?>"<?php echo $invoices->Total_Freight->EditAttributes() ?>>
</span><?php echo $invoices->Total_Freight->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<tr<?php echo $invoices->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $invoices->Total_Amount_Due->CellAttributes() ?>><span id="el_Total_Amount_Due">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $invoices->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $invoices->Total_Amount_Due->EditValue ?>"<?php echo $invoices->Total_Amount_Due->EditAttributes() ?>>
</span><?php echo $invoices->Total_Amount_Due->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Payment_Reference->Visible) { // Payment_Reference ?>
	<tr<?php echo $invoices->Payment_Reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Payment_Reference->FldCaption() ?></td>
		<td<?php echo $invoices->Payment_Reference->CellAttributes() ?>><span id="el_Payment_Reference">
<input type="text" name="x_Payment_Reference" id="x_Payment_Reference" title="<?php echo $invoices->Payment_Reference->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $invoices->Payment_Reference->EditValue ?>"<?php echo $invoices->Payment_Reference->EditAttributes() ?>>
</span><?php echo $invoices->Payment_Reference->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Payment_Status->Visible) { // Payment_Status ?>
	<tr<?php echo $invoices->Payment_Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Payment_Status->FldCaption() ?></td>
		<td<?php echo $invoices->Payment_Status->CellAttributes() ?>><span id="el_Payment_Status">
<select id="x_Payment_Status" name="x_Payment_Status" title="<?php echo $invoices->Payment_Status->FldTitle() ?>"<?php echo $invoices->Payment_Status->EditAttributes() ?>>
<?php
if (is_array($invoices->Payment_Status->EditValue)) {
	$arwrk = $invoices->Payment_Status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->Payment_Status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $invoices->Payment_Status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Status->Visible) { // Status ?>
	<tr<?php echo $invoices->Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Status->FldCaption() ?></td>
		<td<?php echo $invoices->Status->CellAttributes() ?>><span id="el_Status">
<select id="x_Status" name="x_Status" title="<?php echo $invoices->Status->FldTitle() ?>"<?php echo $invoices->Status->EditAttributes() ?>>
<?php
if (is_array($invoices->Status->EditValue)) {
	$arwrk = $invoices->Status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->Status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $invoices->Status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Recipient_Bank->Visible) { // Recipient_Bank ?>
	<tr<?php echo $invoices->Recipient_Bank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Recipient_Bank->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $invoices->Recipient_Bank->CellAttributes() ?>><span id="el_Recipient_Bank">
<select id="x_Recipient_Bank" name="x_Recipient_Bank" title="<?php echo $invoices->Recipient_Bank->FldTitle() ?>"<?php echo $invoices->Recipient_Bank->EditAttributes() ?>>
<?php
if (is_array($invoices->Recipient_Bank->EditValue)) {
	$arwrk = $invoices->Recipient_Bank->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoices->Recipient_Bank->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $invoices->Recipient_Bank->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoices->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $invoices->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoices->Remarks->FldCaption() ?></td>
		<td<?php echo $invoices->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $invoices->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $invoices->Remarks->EditAttributes() ?>><?php echo $invoices->Remarks->EditValue ?></textarea>
</span><?php echo $invoices->Remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_payment_period','x_Client_ID',invoices_edit.ar_x_payment_period]]);

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$invoices_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoices_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'invoices';

	// Page object name
	var $PageObjName = 'invoices_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $invoices;
		if ($invoices->UseTokenInUrl) $PageUrl .= "t=" . $invoices->TableVar . "&"; // Add page token
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
		global $objForm, $invoices;
		if ($invoices->UseTokenInUrl) {
			if ($objForm)
				return ($invoices->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($invoices->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinvoices_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (invoices)
		$GLOBALS["invoices"] = new cinvoices();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'invoices', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $invoices;

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("invoiceslist.php");
		}

		// Create form object
		$objForm = new cFormObj();

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $invoices;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$invoices->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$invoices->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$invoices->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$invoices->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$invoices->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($invoices->id->CurrentValue == "")
			$this->Page_Terminate("invoiceslist.php"); // Invalid key, return to list
		switch ($invoices->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("invoiceslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$invoices->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $invoices->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$invoices->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$invoices->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $invoices;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $invoices;
		$invoices->id->setFormValue($objForm->GetValue("x_id"));
		$invoices->Client_ID->setFormValue($objForm->GetValue("x_Client_ID"));
		$invoices->Invoice_Date->setFormValue($objForm->GetValue("x_Invoice_Date"));
		$invoices->Invoice_Date->CurrentValue = ew_UnFormatDateTime($invoices->Invoice_Date->CurrentValue, 6);
		$invoices->Due_Date->setFormValue($objForm->GetValue("x_Due_Date"));
		$invoices->Due_Date->CurrentValue = ew_UnFormatDateTime($invoices->Due_Date->CurrentValue, 6);
		$invoices->payment_period->setFormValue($objForm->GetValue("x_payment_period"));
		$invoices->Total_Vat->setFormValue($objForm->GetValue("x_Total_Vat"));
		$invoices->Total_WTax->setFormValue($objForm->GetValue("x_Total_WTax"));
		$invoices->Total_Freight->setFormValue($objForm->GetValue("x_Total_Freight"));
		$invoices->Total_Amount_Due->setFormValue($objForm->GetValue("x_Total_Amount_Due"));
		$invoices->Payment_Reference->setFormValue($objForm->GetValue("x_Payment_Reference"));
		$invoices->Payment_Status->setFormValue($objForm->GetValue("x_Payment_Status"));
		$invoices->Status->setFormValue($objForm->GetValue("x_Status"));
		$invoices->Recipient_Bank->setFormValue($objForm->GetValue("x_Recipient_Bank"));
		$invoices->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$invoices->User_ID->setFormValue($objForm->GetValue("x_User_ID"));
		$invoices->modified->setFormValue($objForm->GetValue("x_modified"));
		$invoices->modified->CurrentValue = ew_UnFormatDateTime($invoices->modified->CurrentValue, 6);
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $invoices;
		$this->LoadRow();
		$invoices->id->CurrentValue = $invoices->id->FormValue;
		$invoices->Client_ID->CurrentValue = $invoices->Client_ID->FormValue;
		$invoices->Invoice_Date->CurrentValue = $invoices->Invoice_Date->FormValue;
		$invoices->Invoice_Date->CurrentValue = ew_UnFormatDateTime($invoices->Invoice_Date->CurrentValue, 6);
		$invoices->Due_Date->CurrentValue = $invoices->Due_Date->FormValue;
		$invoices->Due_Date->CurrentValue = ew_UnFormatDateTime($invoices->Due_Date->CurrentValue, 6);
		$invoices->payment_period->CurrentValue = $invoices->payment_period->FormValue;
		$invoices->Total_Vat->CurrentValue = $invoices->Total_Vat->FormValue;
		$invoices->Total_WTax->CurrentValue = $invoices->Total_WTax->FormValue;
		$invoices->Total_Freight->CurrentValue = $invoices->Total_Freight->FormValue;
		$invoices->Total_Amount_Due->CurrentValue = $invoices->Total_Amount_Due->FormValue;
		$invoices->Payment_Reference->CurrentValue = $invoices->Payment_Reference->FormValue;
		$invoices->Payment_Status->CurrentValue = $invoices->Payment_Status->FormValue;
		$invoices->Status->CurrentValue = $invoices->Status->FormValue;
		$invoices->Recipient_Bank->CurrentValue = $invoices->Recipient_Bank->FormValue;
		$invoices->Remarks->CurrentValue = $invoices->Remarks->FormValue;
		$invoices->User_ID->CurrentValue = $invoices->User_ID->FormValue;
		$invoices->modified->CurrentValue = $invoices->modified->FormValue;
		$invoices->modified->CurrentValue = ew_UnFormatDateTime($invoices->modified->CurrentValue, 6);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $invoices;
		$sFilter = $invoices->KeyFilter();

		// Call Row Selecting event
		$invoices->Row_Selecting($sFilter);

		// Load SQL based on filter
		$invoices->CurrentFilter = $sFilter;
		$sSql = $invoices->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$invoices->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $invoices;
		$invoices->id->setDbValue($rs->fields('id'));
		$invoices->Invoice_Number->setDbValue($rs->fields('Invoice_Number'));
		$invoices->Client_ID->setDbValue($rs->fields('Client_ID'));
		$invoices->Invoice_Date->setDbValue($rs->fields('Invoice_Date'));
		$invoices->Due_Date->setDbValue($rs->fields('Due_Date'));
		$invoices->payment_period->setDbValue($rs->fields('payment_period'));
		$invoices->Total_Vat->setDbValue($rs->fields('Total_Vat'));
		$invoices->Total_WTax->setDbValue($rs->fields('Total_WTax'));
		$invoices->Total_Freight->setDbValue($rs->fields('Total_Freight'));
		$invoices->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$invoices->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$invoices->Payment_Status->setDbValue($rs->fields('Payment_Status'));
		$invoices->Status->setDbValue($rs->fields('Status'));
		$invoices->Recipient_Bank->setDbValue($rs->fields('Recipient_Bank'));
		$invoices->Remarks->setDbValue($rs->fields('Remarks'));
		$invoices->User_ID->setDbValue($rs->fields('User_ID'));
		$invoices->created->setDbValue($rs->fields('created'));
		$invoices->modified->setDbValue($rs->fields('modified'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $invoices;

		// Initialize URLs
		// Call Row_Rendering event

		$invoices->Row_Rendering();

		// Common render codes for all row types
		// id

		$invoices->id->CellCssStyle = ""; $invoices->id->CellCssClass = "";
		$invoices->id->CellAttrs = array(); $invoices->id->ViewAttrs = array(); $invoices->id->EditAttrs = array();

		// Client_ID
		$invoices->Client_ID->CellCssStyle = ""; $invoices->Client_ID->CellCssClass = "";
		$invoices->Client_ID->CellAttrs = array(); $invoices->Client_ID->ViewAttrs = array(); $invoices->Client_ID->EditAttrs = array();

		// Invoice_Date
		$invoices->Invoice_Date->CellCssStyle = ""; $invoices->Invoice_Date->CellCssClass = "";
		$invoices->Invoice_Date->CellAttrs = array(); $invoices->Invoice_Date->ViewAttrs = array(); $invoices->Invoice_Date->EditAttrs = array();

		// Due_Date
		$invoices->Due_Date->CellCssStyle = ""; $invoices->Due_Date->CellCssClass = "";
		$invoices->Due_Date->CellAttrs = array(); $invoices->Due_Date->ViewAttrs = array(); $invoices->Due_Date->EditAttrs = array();

		// payment_period
		$invoices->payment_period->CellCssStyle = ""; $invoices->payment_period->CellCssClass = "";
		$invoices->payment_period->CellAttrs = array(); $invoices->payment_period->ViewAttrs = array(); $invoices->payment_period->EditAttrs = array();

		// Total_Vat
		$invoices->Total_Vat->CellCssStyle = ""; $invoices->Total_Vat->CellCssClass = "";
		$invoices->Total_Vat->CellAttrs = array(); $invoices->Total_Vat->ViewAttrs = array(); $invoices->Total_Vat->EditAttrs = array();

		// Total_WTax
		$invoices->Total_WTax->CellCssStyle = ""; $invoices->Total_WTax->CellCssClass = "";
		$invoices->Total_WTax->CellAttrs = array(); $invoices->Total_WTax->ViewAttrs = array(); $invoices->Total_WTax->EditAttrs = array();

		// Total_Freight
		$invoices->Total_Freight->CellCssStyle = ""; $invoices->Total_Freight->CellCssClass = "";
		$invoices->Total_Freight->CellAttrs = array(); $invoices->Total_Freight->ViewAttrs = array(); $invoices->Total_Freight->EditAttrs = array();

		// Total_Amount_Due
		$invoices->Total_Amount_Due->CellCssStyle = ""; $invoices->Total_Amount_Due->CellCssClass = "";
		$invoices->Total_Amount_Due->CellAttrs = array(); $invoices->Total_Amount_Due->ViewAttrs = array(); $invoices->Total_Amount_Due->EditAttrs = array();

		// Payment_Reference
		$invoices->Payment_Reference->CellCssStyle = ""; $invoices->Payment_Reference->CellCssClass = "";
		$invoices->Payment_Reference->CellAttrs = array(); $invoices->Payment_Reference->ViewAttrs = array(); $invoices->Payment_Reference->EditAttrs = array();

		// Payment_Status
		$invoices->Payment_Status->CellCssStyle = ""; $invoices->Payment_Status->CellCssClass = "";
		$invoices->Payment_Status->CellAttrs = array(); $invoices->Payment_Status->ViewAttrs = array(); $invoices->Payment_Status->EditAttrs = array();

		// Status
		$invoices->Status->CellCssStyle = ""; $invoices->Status->CellCssClass = "";
		$invoices->Status->CellAttrs = array(); $invoices->Status->ViewAttrs = array(); $invoices->Status->EditAttrs = array();

		// Recipient_Bank
		$invoices->Recipient_Bank->CellCssStyle = ""; $invoices->Recipient_Bank->CellCssClass = "";
		$invoices->Recipient_Bank->CellAttrs = array(); $invoices->Recipient_Bank->ViewAttrs = array(); $invoices->Recipient_Bank->EditAttrs = array();

		// Remarks
		$invoices->Remarks->CellCssStyle = ""; $invoices->Remarks->CellCssClass = "";
		$invoices->Remarks->CellAttrs = array(); $invoices->Remarks->ViewAttrs = array(); $invoices->Remarks->EditAttrs = array();

		// User_ID
		$invoices->User_ID->CellCssStyle = ""; $invoices->User_ID->CellCssClass = "";
		$invoices->User_ID->CellAttrs = array(); $invoices->User_ID->ViewAttrs = array(); $invoices->User_ID->EditAttrs = array();

		// modified
		$invoices->modified->CellCssStyle = ""; $invoices->modified->CellCssClass = "";
		$invoices->modified->CellAttrs = array(); $invoices->modified->ViewAttrs = array(); $invoices->modified->EditAttrs = array();
		if ($invoices->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$invoices->id->ViewValue = $invoices->id->CurrentValue;
			$invoices->id->CssStyle = "";
			$invoices->id->CssClass = "";
			$invoices->id->ViewCustomAttributes = "";

			// Invoice_Number
			$invoices->Invoice_Number->ViewValue = $invoices->Invoice_Number->CurrentValue;
			$invoices->Invoice_Number->CssStyle = "";
			$invoices->Invoice_Number->CssClass = "";
			$invoices->Invoice_Number->ViewCustomAttributes = "";

			// Client_ID
			if (strval($invoices->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Client_ID->CurrentValue) . "";
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
					$invoices->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$invoices->Client_ID->ViewValue = $invoices->Client_ID->CurrentValue;
				}
			} else {
				$invoices->Client_ID->ViewValue = NULL;
			}
			$invoices->Client_ID->CssStyle = "";
			$invoices->Client_ID->CssClass = "";
			$invoices->Client_ID->ViewCustomAttributes = "";

			// Invoice_Date
			$invoices->Invoice_Date->ViewValue = $invoices->Invoice_Date->CurrentValue;
			$invoices->Invoice_Date->ViewValue = ew_FormatDateTime($invoices->Invoice_Date->ViewValue, 6);
			$invoices->Invoice_Date->CssStyle = "";
			$invoices->Invoice_Date->CssClass = "";
			$invoices->Invoice_Date->ViewCustomAttributes = "";

			// Due_Date
			$invoices->Due_Date->ViewValue = $invoices->Due_Date->CurrentValue;
			$invoices->Due_Date->ViewValue = ew_FormatDateTime($invoices->Due_Date->ViewValue, 6);
			$invoices->Due_Date->CssStyle = "";
			$invoices->Due_Date->CssClass = "";
			$invoices->Due_Date->ViewCustomAttributes = "";

			// payment_period
			if (strval($invoices->payment_period->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->payment_period->CurrentValue) . "";
			$sSqlWrk = "SELECT `payment_period` FROM `client_payment_period`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->payment_period->ViewValue = $rswrk->fields('payment_period');
					$rswrk->Close();
				} else {
					$invoices->payment_period->ViewValue = $invoices->payment_period->CurrentValue;
				}
			} else {
				$invoices->payment_period->ViewValue = NULL;
			}
			$invoices->payment_period->CssStyle = "";
			$invoices->payment_period->CssClass = "";
			$invoices->payment_period->ViewCustomAttributes = "";

			// Total_Vat
			$invoices->Total_Vat->ViewValue = $invoices->Total_Vat->CurrentValue;
			$invoices->Total_Vat->ViewValue = ew_FormatNumber($invoices->Total_Vat->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Vat->CssStyle = "";
			$invoices->Total_Vat->CssClass = "";
			$invoices->Total_Vat->ViewCustomAttributes = "";

			// Total_WTax
			$invoices->Total_WTax->ViewValue = $invoices->Total_WTax->CurrentValue;
			$invoices->Total_WTax->ViewValue = ew_FormatNumber($invoices->Total_WTax->ViewValue, 2, -2, -2, -2);
			$invoices->Total_WTax->CssStyle = "";
			$invoices->Total_WTax->CssClass = "";
			$invoices->Total_WTax->ViewCustomAttributes = "";

			// Total_Freight
			$invoices->Total_Freight->ViewValue = $invoices->Total_Freight->CurrentValue;
			$invoices->Total_Freight->ViewValue = ew_FormatNumber($invoices->Total_Freight->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Freight->CssStyle = "";
			$invoices->Total_Freight->CssClass = "";
			$invoices->Total_Freight->ViewCustomAttributes = "";

			// Total_Amount_Due
			$invoices->Total_Amount_Due->ViewValue = $invoices->Total_Amount_Due->CurrentValue;
			$invoices->Total_Amount_Due->ViewValue = ew_FormatNumber($invoices->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$invoices->Total_Amount_Due->CssStyle = "";
			$invoices->Total_Amount_Due->CssClass = "";
			$invoices->Total_Amount_Due->ViewCustomAttributes = "";

			// Payment_Reference
			$invoices->Payment_Reference->ViewValue = $invoices->Payment_Reference->CurrentValue;
			$invoices->Payment_Reference->CssStyle = "";
			$invoices->Payment_Reference->CssClass = "";
			$invoices->Payment_Reference->ViewCustomAttributes = "";

			// Payment_Status
			if (strval($invoices->Payment_Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Payment_Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Payment_Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$invoices->Payment_Status->ViewValue = $invoices->Payment_Status->CurrentValue;
				}
			} else {
				$invoices->Payment_Status->ViewValue = NULL;
			}
			$invoices->Payment_Status->CssStyle = "";
			$invoices->Payment_Status->CssClass = "";
			$invoices->Payment_Status->ViewCustomAttributes = "";

			// Status
			if (strval($invoices->Status->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Status->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Status->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$invoices->Status->ViewValue = $invoices->Status->CurrentValue;
				}
			} else {
				$invoices->Status->ViewValue = NULL;
			}
			$invoices->Status->CssStyle = "";
			$invoices->Status->CssClass = "";
			$invoices->Status->ViewCustomAttributes = "";

			// Recipient_Bank
			if (strval($invoices->Recipient_Bank->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Recipient_Bank->CurrentValue) . "";
			$sSqlWrk = "SELECT `Bank_Name`, `Account_Number` FROM `banks_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Bank_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoices->Recipient_Bank->ViewValue = $rswrk->fields('Bank_Name');
					$invoices->Recipient_Bank->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('Account_Number');
					$rswrk->Close();
				} else {
					$invoices->Recipient_Bank->ViewValue = $invoices->Recipient_Bank->CurrentValue;
				}
			} else {
				$invoices->Recipient_Bank->ViewValue = NULL;
			}
			$invoices->Recipient_Bank->CssStyle = "";
			$invoices->Recipient_Bank->CssClass = "";
			$invoices->Recipient_Bank->ViewCustomAttributes = "";

			// Remarks
			$invoices->Remarks->ViewValue = $invoices->Remarks->CurrentValue;
			$invoices->Remarks->CssStyle = "";
			$invoices->Remarks->CssClass = "";
			$invoices->Remarks->ViewCustomAttributes = "";

			// User_ID
			$invoices->User_ID->ViewValue = $invoices->User_ID->CurrentValue;
			$invoices->User_ID->CssStyle = "";
			$invoices->User_ID->CssClass = "";
			$invoices->User_ID->ViewCustomAttributes = "";

			// created
			$invoices->created->ViewValue = $invoices->created->CurrentValue;
			$invoices->created->ViewValue = ew_FormatDateTime($invoices->created->ViewValue, 6);
			$invoices->created->CssStyle = "";
			$invoices->created->CssClass = "";
			$invoices->created->ViewCustomAttributes = "";

			// modified
			$invoices->modified->ViewValue = $invoices->modified->CurrentValue;
			$invoices->modified->ViewValue = ew_FormatDateTime($invoices->modified->ViewValue, 6);
			$invoices->modified->CssStyle = "";
			$invoices->modified->CssClass = "";
			$invoices->modified->ViewCustomAttributes = "";

			// id
			$invoices->id->HrefValue = "";
			$invoices->id->TooltipValue = "";

			// Client_ID
			$invoices->Client_ID->HrefValue = "";
			$invoices->Client_ID->TooltipValue = "";

			// Invoice_Date
			$invoices->Invoice_Date->HrefValue = "";
			$invoices->Invoice_Date->TooltipValue = "";

			// Due_Date
			$invoices->Due_Date->HrefValue = "";
			$invoices->Due_Date->TooltipValue = "";

			// payment_period
			$invoices->payment_period->HrefValue = "";
			$invoices->payment_period->TooltipValue = "";

			// Total_Vat
			$invoices->Total_Vat->HrefValue = "";
			$invoices->Total_Vat->TooltipValue = "";

			// Total_WTax
			$invoices->Total_WTax->HrefValue = "";
			$invoices->Total_WTax->TooltipValue = "";

			// Total_Freight
			$invoices->Total_Freight->HrefValue = "";
			$invoices->Total_Freight->TooltipValue = "";

			// Total_Amount_Due
			$invoices->Total_Amount_Due->HrefValue = "";
			$invoices->Total_Amount_Due->TooltipValue = "";

			// Payment_Reference
			$invoices->Payment_Reference->HrefValue = "";
			$invoices->Payment_Reference->TooltipValue = "";

			// Payment_Status
			$invoices->Payment_Status->HrefValue = "";
			$invoices->Payment_Status->TooltipValue = "";

			// Status
			$invoices->Status->HrefValue = "";
			$invoices->Status->TooltipValue = "";

			// Recipient_Bank
			$invoices->Recipient_Bank->HrefValue = "";
			$invoices->Recipient_Bank->TooltipValue = "";

			// Remarks
			$invoices->Remarks->HrefValue = "";
			$invoices->Remarks->TooltipValue = "";

			// User_ID
			$invoices->User_ID->HrefValue = "";
			$invoices->User_ID->TooltipValue = "";

			// modified
			$invoices->modified->HrefValue = "";
			$invoices->modified->TooltipValue = "";
		} elseif ($invoices->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$invoices->id->EditCustomAttributes = "";
			$invoices->id->EditValue = $invoices->id->CurrentValue;
			$invoices->id->CssStyle = "";
			$invoices->id->CssClass = "";
			$invoices->id->ViewCustomAttributes = "";

			// Client_ID
			$invoices->Client_ID->EditCustomAttributes = "";
			if ($invoices->Client_ID->getSessionValue() <> "") {
				$invoices->Client_ID->CurrentValue = $invoices->Client_ID->getSessionValue();
			if (strval($invoices->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoices->Client_ID->CurrentValue) . "";
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
					$invoices->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$invoices->Client_ID->ViewValue = $invoices->Client_ID->CurrentValue;
				}
			} else {
				$invoices->Client_ID->ViewValue = NULL;
			}
			$invoices->Client_ID->CssStyle = "";
			$invoices->Client_ID->CssClass = "";
			$invoices->Client_ID->ViewCustomAttributes = "";
			} else {
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
			$invoices->Client_ID->EditValue = $arwrk;
			}

			// Invoice_Date
			$invoices->Invoice_Date->EditCustomAttributes = "";
			$invoices->Invoice_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($invoices->Invoice_Date->CurrentValue, 6));

			// Due_Date
			$invoices->Due_Date->EditCustomAttributes = "";
			$invoices->Due_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($invoices->Due_Date->CurrentValue, 6));

			// payment_period
			$invoices->payment_period->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `payment_period`, '' AS Disp2Fld, `client_id` FROM `client_payment_period`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$invoices->payment_period->EditValue = $arwrk;

			// Total_Vat
			$invoices->Total_Vat->EditCustomAttributes = "";
			$invoices->Total_Vat->EditValue = ew_HtmlEncode($invoices->Total_Vat->CurrentValue);

			// Total_WTax
			$invoices->Total_WTax->EditCustomAttributes = "";
			$invoices->Total_WTax->EditValue = ew_HtmlEncode($invoices->Total_WTax->CurrentValue);

			// Total_Freight
			$invoices->Total_Freight->EditCustomAttributes = "";
			$invoices->Total_Freight->EditValue = ew_HtmlEncode($invoices->Total_Freight->CurrentValue);

			// Total_Amount_Due
			$invoices->Total_Amount_Due->EditCustomAttributes = "";
			$invoices->Total_Amount_Due->EditValue = ew_HtmlEncode($invoices->Total_Amount_Due->CurrentValue);

			// Payment_Reference
			$invoices->Payment_Reference->EditCustomAttributes = "";
			$invoices->Payment_Reference->EditValue = ew_HtmlEncode($invoices->Payment_Reference->CurrentValue);

			// Payment_Status
			$invoices->Payment_Status->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Status`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$invoices->Payment_Status->EditValue = $arwrk;

			// Status
			$invoices->Status->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Status`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `statuses`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$invoices->Status->EditValue = $arwrk;

			// Recipient_Bank
			$invoices->Recipient_Bank->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Bank_Name`, `Account_Number`, '' AS SelectFilterFld FROM `banks_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Bank_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$invoices->Recipient_Bank->EditValue = $arwrk;

			// Remarks
			$invoices->Remarks->EditCustomAttributes = "";
			$invoices->Remarks->EditValue = ew_HtmlEncode($invoices->Remarks->CurrentValue);

			// User_ID
			// modified
			// Edit refer script
			// id

			$invoices->id->HrefValue = "";

			// Client_ID
			$invoices->Client_ID->HrefValue = "";

			// Invoice_Date
			$invoices->Invoice_Date->HrefValue = "";

			// Due_Date
			$invoices->Due_Date->HrefValue = "";

			// payment_period
			$invoices->payment_period->HrefValue = "";

			// Total_Vat
			$invoices->Total_Vat->HrefValue = "";

			// Total_WTax
			$invoices->Total_WTax->HrefValue = "";

			// Total_Freight
			$invoices->Total_Freight->HrefValue = "";

			// Total_Amount_Due
			$invoices->Total_Amount_Due->HrefValue = "";

			// Payment_Reference
			$invoices->Payment_Reference->HrefValue = "";

			// Payment_Status
			$invoices->Payment_Status->HrefValue = "";

			// Status
			$invoices->Status->HrefValue = "";

			// Recipient_Bank
			$invoices->Recipient_Bank->HrefValue = "";

			// Remarks
			$invoices->Remarks->HrefValue = "";

			// User_ID
			$invoices->User_ID->HrefValue = "";

			// modified
			$invoices->modified->HrefValue = "";
		}

		// Call Row Rendered event
		if ($invoices->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$invoices->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $invoices;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($invoices->Client_ID->FormValue) && $invoices->Client_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $invoices->Client_ID->FldCaption();
		}
		if (!ew_CheckUSDate($invoices->Invoice_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $invoices->Invoice_Date->FldErrMsg();
		}
		if (!is_null($invoices->Due_Date->FormValue) && $invoices->Due_Date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $invoices->Due_Date->FldCaption();
		}
		if (!ew_CheckUSDate($invoices->Due_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $invoices->Due_Date->FldErrMsg();
		}
		if (!ew_CheckNumber($invoices->Total_Vat->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $invoices->Total_Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($invoices->Total_WTax->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $invoices->Total_WTax->FldErrMsg();
		}
		if (!ew_CheckNumber($invoices->Total_Freight->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $invoices->Total_Freight->FldErrMsg();
		}
		if (!ew_CheckNumber($invoices->Total_Amount_Due->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $invoices->Total_Amount_Due->FldErrMsg();
		}
		if (!is_null($invoices->Recipient_Bank->FormValue) && $invoices->Recipient_Bank->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $invoices->Recipient_Bank->FldCaption();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $invoices;
		$sFilter = $invoices->KeyFilter();
		$invoices->CurrentFilter = $sFilter;
		$sSql = $invoices->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Client_ID
			$invoices->Client_ID->SetDbValueDef($rsnew, $invoices->Client_ID->CurrentValue, NULL, FALSE);

			// Invoice_Date
			$invoices->Invoice_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($invoices->Invoice_Date->CurrentValue, 6, FALSE), NULL);

			// Due_Date
			$invoices->Due_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($invoices->Due_Date->CurrentValue, 6, FALSE), NULL);

			// payment_period
			$invoices->payment_period->SetDbValueDef($rsnew, $invoices->payment_period->CurrentValue, NULL, FALSE);

			// Total_Vat
			$invoices->Total_Vat->SetDbValueDef($rsnew, $invoices->Total_Vat->CurrentValue, NULL, FALSE);

			// Total_WTax
			$invoices->Total_WTax->SetDbValueDef($rsnew, $invoices->Total_WTax->CurrentValue, NULL, FALSE);

			// Total_Freight
			$invoices->Total_Freight->SetDbValueDef($rsnew, $invoices->Total_Freight->CurrentValue, NULL, FALSE);

			// Total_Amount_Due
			$invoices->Total_Amount_Due->SetDbValueDef($rsnew, $invoices->Total_Amount_Due->CurrentValue, NULL, FALSE);

			// Payment_Reference
			$invoices->Payment_Reference->SetDbValueDef($rsnew, $invoices->Payment_Reference->CurrentValue, NULL, FALSE);

			// Payment_Status
			$invoices->Payment_Status->SetDbValueDef($rsnew, $invoices->Payment_Status->CurrentValue, NULL, FALSE);

			// Status
			$invoices->Status->SetDbValueDef($rsnew, $invoices->Status->CurrentValue, NULL, FALSE);

			// Recipient_Bank
			$invoices->Recipient_Bank->SetDbValueDef($rsnew, $invoices->Recipient_Bank->CurrentValue, 0, FALSE);

			// Remarks
			$invoices->Remarks->SetDbValueDef($rsnew, $invoices->Remarks->CurrentValue, NULL, FALSE);

			// User_ID
			$invoices->User_ID->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['User_ID'] =& $invoices->User_ID->DbValue;

			// modified
			$invoices->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['modified'] =& $invoices->modified->DbValue;

			// Call Row Updating event
			$bUpdateRow = $invoices->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($invoices->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($invoices->CancelMessage <> "") {
					$this->setMessage($invoices->CancelMessage);
					$invoices->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$invoices->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $invoices;
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
				$this->sDbMasterFilter = $invoices->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $invoices->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$invoices->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$invoices->Client_ID->setSessionValue($invoices->Client_ID->QueryStringValue);
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
			$invoices->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$invoices->setStartRecordNumber($this->lStartRec);
			$invoices->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$invoices->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($invoices->Client_ID->QueryStringValue == "") $invoices->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $invoices->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $invoices->getDetailFilter(); // Restore detail filter
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'invoices';
	  $usr = CurrentUserName();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $invoices;
		$table = 'invoices';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
	  $usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if ($invoices->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($invoices->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($invoices->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} elseif ($invoices->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "<XML>";
						$newvalue = "<XML>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
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
}
?>
