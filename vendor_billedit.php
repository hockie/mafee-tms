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
$vendor_bill_edit = new cvendor_bill_edit();
$Page =& $vendor_bill_edit;

// Page init
$vendor_bill_edit->Page_Init();

// Page main
$vendor_bill_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var vendor_bill_edit = new ew_Page("vendor_bill_edit");

// page properties
vendor_bill_edit.PageID = "edit"; // page ID
vendor_bill_edit.FormID = "fvendor_billedit"; // form ID
var EW_PAGE_ID = vendor_bill_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
vendor_bill_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Billing_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($vendor_bill->Billing_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Due_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($vendor_bill->Due_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Vat"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($vendor_bill->Total_Vat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_WTax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($vendor_bill->Total_WTax->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Freight"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($vendor_bill->Total_Freight->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Amount_Due"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($vendor_bill->Total_Amount_Due->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_payment_method_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($vendor_bill->payment_method_id->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
vendor_bill_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
vendor_bill_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
vendor_bill_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
vendor_bill_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $vendor_bill->TableCaption() ?><br><br>
<a href="<?php echo $vendor_bill->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$vendor_bill_edit->ShowMessage();
?>
<form name="fvendor_billedit" id="fvendor_billedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return vendor_bill_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="vendor_bill">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($vendor_bill->id->Visible) { // id ?>
	<tr<?php echo $vendor_bill->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->id->FldCaption() ?></td>
		<td<?php echo $vendor_bill->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $vendor_bill->id->ViewAttributes() ?>><?php echo $vendor_bill->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($vendor_bill->id->CurrentValue) ?>">
</span><?php echo $vendor_bill->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->vendor_ID->Visible) { // vendor_ID ?>
	<tr<?php echo $vendor_bill->vendor_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->vendor_ID->FldCaption() ?></td>
		<td<?php echo $vendor_bill->vendor_ID->CellAttributes() ?>><span id="el_vendor_ID">
<?php if ($vendor_bill->vendor_ID->getSessionValue() <> "") { ?>
<div<?php echo $vendor_bill->vendor_ID->ViewAttributes() ?>><?php echo $vendor_bill->vendor_ID->ViewValue ?></div>
<input type="hidden" id="x_vendor_ID" name="x_vendor_ID" value="<?php echo ew_HtmlEncode($vendor_bill->vendor_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_vendor_ID" name="x_vendor_ID" title="<?php echo $vendor_bill->vendor_ID->FldTitle() ?>"<?php echo $vendor_bill->vendor_ID->EditAttributes() ?>>
<?php
if (is_array($vendor_bill->vendor_ID->EditValue)) {
	$arwrk = $vendor_bill->vendor_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($vendor_bill->vendor_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $vendor_bill->vendor_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->vendor_Number->Visible) { // vendor_Number ?>
	<tr<?php echo $vendor_bill->vendor_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->vendor_Number->FldCaption() ?></td>
		<td<?php echo $vendor_bill->vendor_Number->CellAttributes() ?>><span id="el_vendor_Number">
<input type="text" name="x_vendor_Number" id="x_vendor_Number" title="<?php echo $vendor_bill->vendor_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $vendor_bill->vendor_Number->EditValue ?>"<?php echo $vendor_bill->vendor_Number->EditAttributes() ?>>
</span><?php echo $vendor_bill->vendor_Number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Billing_Date->Visible) { // Billing_Date ?>
	<tr<?php echo $vendor_bill->Billing_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Billing_Date->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Billing_Date->CellAttributes() ?>><span id="el_Billing_Date">
<input type="text" name="x_Billing_Date" id="x_Billing_Date" title="<?php echo $vendor_bill->Billing_Date->FldTitle() ?>" value="<?php echo $vendor_bill->Billing_Date->EditValue ?>"<?php echo $vendor_bill->Billing_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Billing_Date" name="cal_x_Billing_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Billing_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Billing_Date" // button id
});
</script>
</span><?php echo $vendor_bill->Billing_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Due_Date->Visible) { // Due_Date ?>
	<tr<?php echo $vendor_bill->Due_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Due_Date->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Due_Date->CellAttributes() ?>><span id="el_Due_Date">
<input type="text" name="x_Due_Date" id="x_Due_Date" title="<?php echo $vendor_bill->Due_Date->FldTitle() ?>" value="<?php echo $vendor_bill->Due_Date->EditValue ?>"<?php echo $vendor_bill->Due_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Due_Date" name="cal_x_Due_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Due_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Due_Date" // button id
});
</script>
</span><?php echo $vendor_bill->Due_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Total_Vat->Visible) { // Total_Vat ?>
	<tr<?php echo $vendor_bill->Total_Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Total_Vat->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Total_Vat->CellAttributes() ?>><span id="el_Total_Vat">
<input type="text" name="x_Total_Vat" id="x_Total_Vat" title="<?php echo $vendor_bill->Total_Vat->FldTitle() ?>" size="30" value="<?php echo $vendor_bill->Total_Vat->EditValue ?>"<?php echo $vendor_bill->Total_Vat->EditAttributes() ?>>
</span><?php echo $vendor_bill->Total_Vat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Total_WTax->Visible) { // Total_WTax ?>
	<tr<?php echo $vendor_bill->Total_WTax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Total_WTax->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Total_WTax->CellAttributes() ?>><span id="el_Total_WTax">
<input type="text" name="x_Total_WTax" id="x_Total_WTax" title="<?php echo $vendor_bill->Total_WTax->FldTitle() ?>" size="30" value="<?php echo $vendor_bill->Total_WTax->EditValue ?>"<?php echo $vendor_bill->Total_WTax->EditAttributes() ?>>
</span><?php echo $vendor_bill->Total_WTax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Total_Freight->Visible) { // Total_Freight ?>
	<tr<?php echo $vendor_bill->Total_Freight->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Total_Freight->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Total_Freight->CellAttributes() ?>><span id="el_Total_Freight">
<input type="text" name="x_Total_Freight" id="x_Total_Freight" title="<?php echo $vendor_bill->Total_Freight->FldTitle() ?>" size="30" value="<?php echo $vendor_bill->Total_Freight->EditValue ?>"<?php echo $vendor_bill->Total_Freight->EditAttributes() ?>>
</span><?php echo $vendor_bill->Total_Freight->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<tr<?php echo $vendor_bill->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Total_Amount_Due->CellAttributes() ?>><span id="el_Total_Amount_Due">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $vendor_bill->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $vendor_bill->Total_Amount_Due->EditValue ?>"<?php echo $vendor_bill->Total_Amount_Due->EditAttributes() ?>>
</span><?php echo $vendor_bill->Total_Amount_Due->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Bill_Reference->Visible) { // Bill_Reference ?>
	<tr<?php echo $vendor_bill->Bill_Reference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Bill_Reference->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Bill_Reference->CellAttributes() ?>><span id="el_Bill_Reference">
<input type="text" name="x_Bill_Reference" id="x_Bill_Reference" title="<?php echo $vendor_bill->Bill_Reference->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $vendor_bill->Bill_Reference->EditValue ?>"<?php echo $vendor_bill->Bill_Reference->EditAttributes() ?>>
</span><?php echo $vendor_bill->Bill_Reference->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->payment_method_id->Visible) { // payment_method_id ?>
	<tr<?php echo $vendor_bill->payment_method_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->payment_method_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $vendor_bill->payment_method_id->CellAttributes() ?>><span id="el_payment_method_id">
<select id="x_payment_method_id" name="x_payment_method_id" title="<?php echo $vendor_bill->payment_method_id->FldTitle() ?>"<?php echo $vendor_bill->payment_method_id->EditAttributes() ?>>
<?php
if (is_array($vendor_bill->payment_method_id->EditValue)) {
	$arwrk = $vendor_bill->payment_method_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($vendor_bill->payment_method_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $vendor_bill->payment_method_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Payment_Status->Visible) { // Payment_Status ?>
	<tr<?php echo $vendor_bill->Payment_Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Payment_Status->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Payment_Status->CellAttributes() ?>><span id="el_Payment_Status">
<select id="x_Payment_Status" name="x_Payment_Status" title="<?php echo $vendor_bill->Payment_Status->FldTitle() ?>"<?php echo $vendor_bill->Payment_Status->EditAttributes() ?>>
<?php
if (is_array($vendor_bill->Payment_Status->EditValue)) {
	$arwrk = $vendor_bill->Payment_Status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($vendor_bill->Payment_Status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $vendor_bill->Payment_Status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Status->Visible) { // Status ?>
	<tr<?php echo $vendor_bill->Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Status->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Status->CellAttributes() ?>><span id="el_Status">
<select id="x_Status" name="x_Status" title="<?php echo $vendor_bill->Status->FldTitle() ?>"<?php echo $vendor_bill->Status->EditAttributes() ?>>
<?php
if (is_array($vendor_bill->Status->EditValue)) {
	$arwrk = $vendor_bill->Status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($vendor_bill->Status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $vendor_bill->Status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $vendor_bill->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill->Remarks->FldCaption() ?></td>
		<td<?php echo $vendor_bill->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $vendor_bill->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $vendor_bill->Remarks->EditAttributes() ?>><?php echo $vendor_bill->Remarks->EditValue ?></textarea>
</span><?php echo $vendor_bill->Remarks->CustomMsg ?></td>
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

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$vendor_bill_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cvendor_bill_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'vendor_bill';

	// Page object name
	var $PageObjName = 'vendor_bill_edit';

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
	function cvendor_bill_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (vendor_bill)
		$GLOBALS["vendor_bill"] = new cvendor_bill();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'vendor_bill', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("vendor_billlist.php");
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
		global $objForm, $Language, $gsFormError, $vendor_bill;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$vendor_bill->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$vendor_bill->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$vendor_bill->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$vendor_bill->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$vendor_bill->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($vendor_bill->id->CurrentValue == "")
			$this->Page_Terminate("vendor_billlist.php"); // Invalid key, return to list
		switch ($vendor_bill->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("vendor_billlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$vendor_bill->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $vendor_bill->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$vendor_bill->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$vendor_bill->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $vendor_bill;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $vendor_bill;
		$vendor_bill->id->setFormValue($objForm->GetValue("x_id"));
		$vendor_bill->vendor_ID->setFormValue($objForm->GetValue("x_vendor_ID"));
		$vendor_bill->vendor_Number->setFormValue($objForm->GetValue("x_vendor_Number"));
		$vendor_bill->Billing_Date->setFormValue($objForm->GetValue("x_Billing_Date"));
		$vendor_bill->Billing_Date->CurrentValue = ew_UnFormatDateTime($vendor_bill->Billing_Date->CurrentValue, 6);
		$vendor_bill->Due_Date->setFormValue($objForm->GetValue("x_Due_Date"));
		$vendor_bill->Due_Date->CurrentValue = ew_UnFormatDateTime($vendor_bill->Due_Date->CurrentValue, 6);
		$vendor_bill->Total_Vat->setFormValue($objForm->GetValue("x_Total_Vat"));
		$vendor_bill->Total_WTax->setFormValue($objForm->GetValue("x_Total_WTax"));
		$vendor_bill->Total_Freight->setFormValue($objForm->GetValue("x_Total_Freight"));
		$vendor_bill->Total_Amount_Due->setFormValue($objForm->GetValue("x_Total_Amount_Due"));
		$vendor_bill->Bill_Reference->setFormValue($objForm->GetValue("x_Bill_Reference"));
		$vendor_bill->payment_method_id->setFormValue($objForm->GetValue("x_payment_method_id"));
		$vendor_bill->Payment_Status->setFormValue($objForm->GetValue("x_Payment_Status"));
		$vendor_bill->Status->setFormValue($objForm->GetValue("x_Status"));
		$vendor_bill->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$vendor_bill->User_ID->setFormValue($objForm->GetValue("x_User_ID"));
		$vendor_bill->modified->setFormValue($objForm->GetValue("x_modified"));
		$vendor_bill->modified->CurrentValue = ew_UnFormatDateTime($vendor_bill->modified->CurrentValue, 6);
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $vendor_bill;
		$this->LoadRow();
		$vendor_bill->id->CurrentValue = $vendor_bill->id->FormValue;
		$vendor_bill->vendor_ID->CurrentValue = $vendor_bill->vendor_ID->FormValue;
		$vendor_bill->vendor_Number->CurrentValue = $vendor_bill->vendor_Number->FormValue;
		$vendor_bill->Billing_Date->CurrentValue = $vendor_bill->Billing_Date->FormValue;
		$vendor_bill->Billing_Date->CurrentValue = ew_UnFormatDateTime($vendor_bill->Billing_Date->CurrentValue, 6);
		$vendor_bill->Due_Date->CurrentValue = $vendor_bill->Due_Date->FormValue;
		$vendor_bill->Due_Date->CurrentValue = ew_UnFormatDateTime($vendor_bill->Due_Date->CurrentValue, 6);
		$vendor_bill->Total_Vat->CurrentValue = $vendor_bill->Total_Vat->FormValue;
		$vendor_bill->Total_WTax->CurrentValue = $vendor_bill->Total_WTax->FormValue;
		$vendor_bill->Total_Freight->CurrentValue = $vendor_bill->Total_Freight->FormValue;
		$vendor_bill->Total_Amount_Due->CurrentValue = $vendor_bill->Total_Amount_Due->FormValue;
		$vendor_bill->Bill_Reference->CurrentValue = $vendor_bill->Bill_Reference->FormValue;
		$vendor_bill->payment_method_id->CurrentValue = $vendor_bill->payment_method_id->FormValue;
		$vendor_bill->Payment_Status->CurrentValue = $vendor_bill->Payment_Status->FormValue;
		$vendor_bill->Status->CurrentValue = $vendor_bill->Status->FormValue;
		$vendor_bill->Remarks->CurrentValue = $vendor_bill->Remarks->FormValue;
		$vendor_bill->User_ID->CurrentValue = $vendor_bill->User_ID->FormValue;
		$vendor_bill->modified->CurrentValue = $vendor_bill->modified->FormValue;
		$vendor_bill->modified->CurrentValue = ew_UnFormatDateTime($vendor_bill->modified->CurrentValue, 6);
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
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $vendor_bill;

		// Initialize URLs
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

		// Total_Vat
		$vendor_bill->Total_Vat->CellCssStyle = ""; $vendor_bill->Total_Vat->CellCssClass = "";
		$vendor_bill->Total_Vat->CellAttrs = array(); $vendor_bill->Total_Vat->ViewAttrs = array(); $vendor_bill->Total_Vat->EditAttrs = array();

		// Total_WTax
		$vendor_bill->Total_WTax->CellCssStyle = ""; $vendor_bill->Total_WTax->CellCssClass = "";
		$vendor_bill->Total_WTax->CellAttrs = array(); $vendor_bill->Total_WTax->ViewAttrs = array(); $vendor_bill->Total_WTax->EditAttrs = array();

		// Total_Freight
		$vendor_bill->Total_Freight->CellCssStyle = ""; $vendor_bill->Total_Freight->CellCssClass = "";
		$vendor_bill->Total_Freight->CellAttrs = array(); $vendor_bill->Total_Freight->ViewAttrs = array(); $vendor_bill->Total_Freight->EditAttrs = array();

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

			// Total_Vat
			$vendor_bill->Total_Vat->HrefValue = "";
			$vendor_bill->Total_Vat->TooltipValue = "";

			// Total_WTax
			$vendor_bill->Total_WTax->HrefValue = "";
			$vendor_bill->Total_WTax->TooltipValue = "";

			// Total_Freight
			$vendor_bill->Total_Freight->HrefValue = "";
			$vendor_bill->Total_Freight->TooltipValue = "";

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

			// modified
			$vendor_bill->modified->HrefValue = "";
			$vendor_bill->modified->TooltipValue = "";
		} elseif ($vendor_bill->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$vendor_bill->id->EditCustomAttributes = "";
			$vendor_bill->id->EditValue = $vendor_bill->id->CurrentValue;
			$vendor_bill->id->CssStyle = "";
			$vendor_bill->id->CssClass = "";
			$vendor_bill->id->ViewCustomAttributes = "";

			// vendor_ID
			$vendor_bill->vendor_ID->EditCustomAttributes = "";
			if ($vendor_bill->vendor_ID->getSessionValue() <> "") {
				$vendor_bill->vendor_ID->CurrentValue = $vendor_bill->vendor_ID->getSessionValue();
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
			} else {
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
			$vendor_bill->vendor_ID->EditValue = $arwrk;
			}

			// vendor_Number
			$vendor_bill->vendor_Number->EditCustomAttributes = "";
			$vendor_bill->vendor_Number->EditValue = ew_HtmlEncode($vendor_bill->vendor_Number->CurrentValue);

			// Billing_Date
			$vendor_bill->Billing_Date->EditCustomAttributes = "";
			$vendor_bill->Billing_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($vendor_bill->Billing_Date->CurrentValue, 6));

			// Due_Date
			$vendor_bill->Due_Date->EditCustomAttributes = "";
			$vendor_bill->Due_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($vendor_bill->Due_Date->CurrentValue, 6));

			// Total_Vat
			$vendor_bill->Total_Vat->EditCustomAttributes = "";
			$vendor_bill->Total_Vat->EditValue = ew_HtmlEncode($vendor_bill->Total_Vat->CurrentValue);

			// Total_WTax
			$vendor_bill->Total_WTax->EditCustomAttributes = "";
			$vendor_bill->Total_WTax->EditValue = ew_HtmlEncode($vendor_bill->Total_WTax->CurrentValue);

			// Total_Freight
			$vendor_bill->Total_Freight->EditCustomAttributes = "";
			$vendor_bill->Total_Freight->EditValue = ew_HtmlEncode($vendor_bill->Total_Freight->CurrentValue);

			// Total_Amount_Due
			$vendor_bill->Total_Amount_Due->EditCustomAttributes = "";
			$vendor_bill->Total_Amount_Due->EditValue = ew_HtmlEncode($vendor_bill->Total_Amount_Due->CurrentValue);

			// Bill_Reference
			$vendor_bill->Bill_Reference->EditCustomAttributes = "";
			$vendor_bill->Bill_Reference->EditValue = ew_HtmlEncode($vendor_bill->Bill_Reference->CurrentValue);

			// payment_method_id
			$vendor_bill->payment_method_id->EditCustomAttributes = "";
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
			$vendor_bill->payment_method_id->EditValue = $arwrk;

			// Payment_Status
			$vendor_bill->Payment_Status->EditCustomAttributes = "";
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
			$vendor_bill->Payment_Status->EditValue = $arwrk;

			// Status
			$vendor_bill->Status->EditCustomAttributes = "";
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
			$vendor_bill->Status->EditValue = $arwrk;

			// Remarks
			$vendor_bill->Remarks->EditCustomAttributes = "";
			$vendor_bill->Remarks->EditValue = ew_HtmlEncode($vendor_bill->Remarks->CurrentValue);

			// User_ID
			// modified
			// Edit refer script
			// id

			$vendor_bill->id->HrefValue = "";

			// vendor_ID
			$vendor_bill->vendor_ID->HrefValue = "";

			// vendor_Number
			$vendor_bill->vendor_Number->HrefValue = "";

			// Billing_Date
			$vendor_bill->Billing_Date->HrefValue = "";

			// Due_Date
			$vendor_bill->Due_Date->HrefValue = "";

			// Total_Vat
			$vendor_bill->Total_Vat->HrefValue = "";

			// Total_WTax
			$vendor_bill->Total_WTax->HrefValue = "";

			// Total_Freight
			$vendor_bill->Total_Freight->HrefValue = "";

			// Total_Amount_Due
			$vendor_bill->Total_Amount_Due->HrefValue = "";

			// Bill_Reference
			$vendor_bill->Bill_Reference->HrefValue = "";

			// payment_method_id
			$vendor_bill->payment_method_id->HrefValue = "";

			// Payment_Status
			$vendor_bill->Payment_Status->HrefValue = "";

			// Status
			$vendor_bill->Status->HrefValue = "";

			// Remarks
			$vendor_bill->Remarks->HrefValue = "";

			// User_ID
			$vendor_bill->User_ID->HrefValue = "";

			// modified
			$vendor_bill->modified->HrefValue = "";
		}

		// Call Row Rendered event
		if ($vendor_bill->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$vendor_bill->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $vendor_bill;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckUSDate($vendor_bill->Billing_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $vendor_bill->Billing_Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($vendor_bill->Due_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $vendor_bill->Due_Date->FldErrMsg();
		}
		if (!ew_CheckNumber($vendor_bill->Total_Vat->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $vendor_bill->Total_Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($vendor_bill->Total_WTax->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $vendor_bill->Total_WTax->FldErrMsg();
		}
		if (!ew_CheckNumber($vendor_bill->Total_Freight->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $vendor_bill->Total_Freight->FldErrMsg();
		}
		if (!ew_CheckNumber($vendor_bill->Total_Amount_Due->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $vendor_bill->Total_Amount_Due->FldErrMsg();
		}
		if (!is_null($vendor_bill->payment_method_id->FormValue) && $vendor_bill->payment_method_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $vendor_bill->payment_method_id->FldCaption();
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
		global $conn, $Security, $Language, $vendor_bill;
		$sFilter = $vendor_bill->KeyFilter();
		$vendor_bill->CurrentFilter = $sFilter;
		$sSql = $vendor_bill->SQL();
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

			// vendor_ID
			$vendor_bill->vendor_ID->SetDbValueDef($rsnew, $vendor_bill->vendor_ID->CurrentValue, NULL, FALSE);

			// vendor_Number
			$vendor_bill->vendor_Number->SetDbValueDef($rsnew, $vendor_bill->vendor_Number->CurrentValue, NULL, FALSE);

			// Billing_Date
			$vendor_bill->Billing_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($vendor_bill->Billing_Date->CurrentValue, 6, FALSE), NULL);

			// Due_Date
			$vendor_bill->Due_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($vendor_bill->Due_Date->CurrentValue, 6, FALSE), NULL);

			// Total_Vat
			$vendor_bill->Total_Vat->SetDbValueDef($rsnew, $vendor_bill->Total_Vat->CurrentValue, NULL, FALSE);

			// Total_WTax
			$vendor_bill->Total_WTax->SetDbValueDef($rsnew, $vendor_bill->Total_WTax->CurrentValue, NULL, FALSE);

			// Total_Freight
			$vendor_bill->Total_Freight->SetDbValueDef($rsnew, $vendor_bill->Total_Freight->CurrentValue, NULL, FALSE);

			// Total_Amount_Due
			$vendor_bill->Total_Amount_Due->SetDbValueDef($rsnew, $vendor_bill->Total_Amount_Due->CurrentValue, NULL, FALSE);

			// Bill_Reference
			$vendor_bill->Bill_Reference->SetDbValueDef($rsnew, $vendor_bill->Bill_Reference->CurrentValue, NULL, FALSE);

			// payment_method_id
			$vendor_bill->payment_method_id->SetDbValueDef($rsnew, $vendor_bill->payment_method_id->CurrentValue, 0, FALSE);

			// Payment_Status
			$vendor_bill->Payment_Status->SetDbValueDef($rsnew, $vendor_bill->Payment_Status->CurrentValue, NULL, FALSE);

			// Status
			$vendor_bill->Status->SetDbValueDef($rsnew, $vendor_bill->Status->CurrentValue, NULL, FALSE);

			// Remarks
			$vendor_bill->Remarks->SetDbValueDef($rsnew, $vendor_bill->Remarks->CurrentValue, NULL, FALSE);

			// User_ID
			$vendor_bill->User_ID->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['User_ID'] =& $vendor_bill->User_ID->DbValue;

			// modified
			$vendor_bill->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['modified'] =& $vendor_bill->modified->DbValue;

			// Call Row Updating event
			$bUpdateRow = $vendor_bill->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($vendor_bill->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($vendor_bill->CancelMessage <> "") {
					$this->setMessage($vendor_bill->CancelMessage);
					$vendor_bill->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$vendor_bill->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
}
?>
