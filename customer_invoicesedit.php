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
$customer_invoices_edit = new ccustomer_invoices_edit();
$Page =& $customer_invoices_edit;

// Page init
$customer_invoices_edit->Page_Init();

// Page main
$customer_invoices_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var customer_invoices_edit = new ew_Page("customer_invoices_edit");

// page properties
customer_invoices_edit.PageID = "edit"; // page ID
customer_invoices_edit.FormID = "fcustomer_invoicesedit"; // form ID
var EW_PAGE_ID = customer_invoices_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
customer_invoices_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Payment_ID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($customer_invoices->Payment_ID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Invoice_Bill_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($customer_invoices->Invoice_Bill_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Due_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($customer_invoices->Due_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Total_Amount_Due"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($customer_invoices->Total_Amount_Due->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
customer_invoices_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
customer_invoices_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
customer_invoices_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customer_invoices_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $customer_invoices->TableCaption() ?><br><br>
<a href="<?php echo $customer_invoices->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$customer_invoices_edit->ShowMessage();
?>
<form name="fcustomer_invoicesedit" id="fcustomer_invoicesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return customer_invoices_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="customer_invoices">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($customer_invoices->id->Visible) { // id ?>
	<tr<?php echo $customer_invoices->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->id->FldCaption() ?></td>
		<td<?php echo $customer_invoices->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $customer_invoices->id->ViewAttributes() ?>><?php echo $customer_invoices->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($customer_invoices->id->CurrentValue) ?>">
</span><?php echo $customer_invoices->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Payment_ID->Visible) { // Payment_ID ?>
	<tr<?php echo $customer_invoices->Payment_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Payment_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Payment_ID->CellAttributes() ?>><span id="el_Payment_ID">
<?php if ($customer_invoices->Payment_ID->getSessionValue() <> "") { ?>
<div<?php echo $customer_invoices->Payment_ID->ViewAttributes() ?>>
<?php if ($customer_invoices->Payment_ID->HrefValue <> "" || $customer_invoices->Payment_ID->TooltipValue <> "") { ?>
<a href="./account_paymentslist.php?x_id=<?php echo $customer_invoices->Payment_ID->HrefValue ?>" target="_self"><?php echo $customer_invoices->Payment_ID->ViewValue ?></a>
<?php } else { ?>
<?php echo $customer_invoices->Payment_ID->ViewValue ?>
<?php } ?>
</div>
<input type="hidden" id="x_Payment_ID" name="x_Payment_ID" value="<?php echo ew_HtmlEncode($customer_invoices->Payment_ID->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_Payment_ID" id="x_Payment_ID" title="<?php echo $customer_invoices->Payment_ID->FldTitle() ?>" size="30" value="<?php echo $customer_invoices->Payment_ID->EditValue ?>"<?php echo $customer_invoices->Payment_ID->EditAttributes() ?>>
<?php } ?>
</span><?php echo $customer_invoices->Payment_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Invoice_ID->Visible) { // Invoice_ID ?>
	<tr<?php echo $customer_invoices->Invoice_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Invoice_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Invoice_ID->CellAttributes() ?>><span id="el_Invoice_ID">
<?php if ($customer_invoices->Invoice_ID->getSessionValue() <> "") { ?>
<div<?php echo $customer_invoices->Invoice_ID->ViewAttributes() ?>>
<?php if ($customer_invoices->Invoice_ID->HrefValue <> "" || $customer_invoices->Invoice_ID->TooltipValue <> "") { ?>
<a href="./invoiceslist.php?x_id=<?php echo $customer_invoices->Invoice_ID->HrefValue ?>" target="_self"><?php echo $customer_invoices->Invoice_ID->ViewValue ?></a>
<?php } else { ?>
<?php echo $customer_invoices->Invoice_ID->ViewValue ?>
<?php } ?>
</div>
<input type="hidden" id="x_Invoice_ID" name="x_Invoice_ID" value="<?php echo ew_HtmlEncode($customer_invoices->Invoice_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Invoice_ID" name="x_Invoice_ID" title="<?php echo $customer_invoices->Invoice_ID->FldTitle() ?>"<?php echo $customer_invoices->Invoice_ID->EditAttributes() ?>>
<?php
if (is_array($customer_invoices->Invoice_ID->EditValue)) {
	$arwrk = $customer_invoices->Invoice_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($customer_invoices->Invoice_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $customer_invoices->Invoice_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Invoice_Bill_Date->Visible) { // Invoice_Bill_Date ?>
	<tr<?php echo $customer_invoices->Invoice_Bill_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Invoice_Bill_Date->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Invoice_Bill_Date->CellAttributes() ?>><span id="el_Invoice_Bill_Date">
<input type="text" name="x_Invoice_Bill_Date" id="x_Invoice_Bill_Date" title="<?php echo $customer_invoices->Invoice_Bill_Date->FldTitle() ?>" value="<?php echo $customer_invoices->Invoice_Bill_Date->EditValue ?>"<?php echo $customer_invoices->Invoice_Bill_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Invoice_Bill_Date" name="cal_x_Invoice_Bill_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Invoice_Bill_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Invoice_Bill_Date" // button id
});
</script>
</span><?php echo $customer_invoices->Invoice_Bill_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Due_Date->Visible) { // Due_Date ?>
	<tr<?php echo $customer_invoices->Due_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Due_Date->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Due_Date->CellAttributes() ?>><span id="el_Due_Date">
<input type="text" name="x_Due_Date" id="x_Due_Date" title="<?php echo $customer_invoices->Due_Date->FldTitle() ?>" value="<?php echo $customer_invoices->Due_Date->EditValue ?>"<?php echo $customer_invoices->Due_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Due_Date" name="cal_x_Due_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Due_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Due_Date" // button id
});
</script>
</span><?php echo $customer_invoices->Due_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Total_Amount_Due->Visible) { // Total_Amount_Due ?>
	<tr<?php echo $customer_invoices->Total_Amount_Due->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Total_Amount_Due->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Total_Amount_Due->CellAttributes() ?>><span id="el_Total_Amount_Due">
<input type="text" name="x_Total_Amount_Due" id="x_Total_Amount_Due" title="<?php echo $customer_invoices->Total_Amount_Due->FldTitle() ?>" size="30" value="<?php echo $customer_invoices->Total_Amount_Due->EditValue ?>"<?php echo $customer_invoices->Total_Amount_Due->EditAttributes() ?>>
</span><?php echo $customer_invoices->Total_Amount_Due->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Payment_Status_ID->Visible) { // Payment_Status_ID ?>
	<tr<?php echo $customer_invoices->Payment_Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Payment_Status_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Payment_Status_ID->CellAttributes() ?>><span id="el_Payment_Status_ID">
<select id="x_Payment_Status_ID" name="x_Payment_Status_ID" title="<?php echo $customer_invoices->Payment_Status_ID->FldTitle() ?>"<?php echo $customer_invoices->Payment_Status_ID->EditAttributes() ?>>
<?php
if (is_array($customer_invoices->Payment_Status_ID->EditValue)) {
	$arwrk = $customer_invoices->Payment_Status_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($customer_invoices->Payment_Status_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $customer_invoices->Payment_Status_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Status_ID->Visible) { // Status_ID ?>
	<tr<?php echo $customer_invoices->Status_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Status_ID->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Status_ID->CellAttributes() ?>><span id="el_Status_ID">
<select id="x_Status_ID" name="x_Status_ID" title="<?php echo $customer_invoices->Status_ID->FldTitle() ?>"<?php echo $customer_invoices->Status_ID->EditAttributes() ?>>
<?php
if (is_array($customer_invoices->Status_ID->EditValue)) {
	$arwrk = $customer_invoices->Status_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($customer_invoices->Status_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $customer_invoices->Status_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer_invoices->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $customer_invoices->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customer_invoices->Remarks->FldCaption() ?></td>
		<td<?php echo $customer_invoices->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $customer_invoices->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $customer_invoices->Remarks->EditAttributes() ?>><?php echo $customer_invoices->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $customer_invoices->Remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
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
<?php include "footer.php" ?>
<?php
$customer_invoices_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ccustomer_invoices_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'customer_invoices';

	// Page object name
	var $PageObjName = 'customer_invoices_edit';

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
	function ccustomer_invoices_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (customer_invoices)
		$GLOBALS["customer_invoices"] = new ccustomer_invoices();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoices)
		$GLOBALS['invoices'] = new cinvoices();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customer_invoices', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("customer_invoiceslist.php");
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
		global $objForm, $Language, $gsFormError, $customer_invoices;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$customer_invoices->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$customer_invoices->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$customer_invoices->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$customer_invoices->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$customer_invoices->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($customer_invoices->id->CurrentValue == "")
			$this->Page_Terminate("customer_invoiceslist.php"); // Invalid key, return to list
		switch ($customer_invoices->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("customer_invoiceslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$customer_invoices->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $customer_invoices->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$customer_invoices->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$customer_invoices->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $customer_invoices;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $customer_invoices;
		$customer_invoices->id->setFormValue($objForm->GetValue("x_id"));
		$customer_invoices->Payment_ID->setFormValue($objForm->GetValue("x_Payment_ID"));
		$customer_invoices->Invoice_ID->setFormValue($objForm->GetValue("x_Invoice_ID"));
		$customer_invoices->Invoice_Bill_Date->setFormValue($objForm->GetValue("x_Invoice_Bill_Date"));
		$customer_invoices->Invoice_Bill_Date->CurrentValue = ew_UnFormatDateTime($customer_invoices->Invoice_Bill_Date->CurrentValue, 6);
		$customer_invoices->Due_Date->setFormValue($objForm->GetValue("x_Due_Date"));
		$customer_invoices->Due_Date->CurrentValue = ew_UnFormatDateTime($customer_invoices->Due_Date->CurrentValue, 6);
		$customer_invoices->Total_Amount_Due->setFormValue($objForm->GetValue("x_Total_Amount_Due"));
		$customer_invoices->Payment_Status_ID->setFormValue($objForm->GetValue("x_Payment_Status_ID"));
		$customer_invoices->Status_ID->setFormValue($objForm->GetValue("x_Status_ID"));
		$customer_invoices->modified->setFormValue($objForm->GetValue("x_modified"));
		$customer_invoices->modified->CurrentValue = ew_UnFormatDateTime($customer_invoices->modified->CurrentValue, 6);
		$customer_invoices->User_ID->setFormValue($objForm->GetValue("x_User_ID"));
		$customer_invoices->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $customer_invoices;
		$this->LoadRow();
		$customer_invoices->id->CurrentValue = $customer_invoices->id->FormValue;
		$customer_invoices->Payment_ID->CurrentValue = $customer_invoices->Payment_ID->FormValue;
		$customer_invoices->Invoice_ID->CurrentValue = $customer_invoices->Invoice_ID->FormValue;
		$customer_invoices->Invoice_Bill_Date->CurrentValue = $customer_invoices->Invoice_Bill_Date->FormValue;
		$customer_invoices->Invoice_Bill_Date->CurrentValue = ew_UnFormatDateTime($customer_invoices->Invoice_Bill_Date->CurrentValue, 6);
		$customer_invoices->Due_Date->CurrentValue = $customer_invoices->Due_Date->FormValue;
		$customer_invoices->Due_Date->CurrentValue = ew_UnFormatDateTime($customer_invoices->Due_Date->CurrentValue, 6);
		$customer_invoices->Total_Amount_Due->CurrentValue = $customer_invoices->Total_Amount_Due->FormValue;
		$customer_invoices->Payment_Status_ID->CurrentValue = $customer_invoices->Payment_Status_ID->FormValue;
		$customer_invoices->Status_ID->CurrentValue = $customer_invoices->Status_ID->FormValue;
		$customer_invoices->modified->CurrentValue = $customer_invoices->modified->FormValue;
		$customer_invoices->modified->CurrentValue = ew_UnFormatDateTime($customer_invoices->modified->CurrentValue, 6);
		$customer_invoices->User_ID->CurrentValue = $customer_invoices->User_ID->FormValue;
		$customer_invoices->Remarks->CurrentValue = $customer_invoices->Remarks->FormValue;
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

		// modified
		$customer_invoices->modified->CellCssStyle = ""; $customer_invoices->modified->CellCssClass = "";
		$customer_invoices->modified->CellAttrs = array(); $customer_invoices->modified->ViewAttrs = array(); $customer_invoices->modified->EditAttrs = array();

		// User_ID
		$customer_invoices->User_ID->CellCssStyle = ""; $customer_invoices->User_ID->CellCssClass = "";
		$customer_invoices->User_ID->CellAttrs = array(); $customer_invoices->User_ID->ViewAttrs = array(); $customer_invoices->User_ID->EditAttrs = array();

		// Remarks
		$customer_invoices->Remarks->CellCssStyle = ""; $customer_invoices->Remarks->CellCssClass = "";
		$customer_invoices->Remarks->CellAttrs = array(); $customer_invoices->Remarks->ViewAttrs = array(); $customer_invoices->Remarks->EditAttrs = array();
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
			$sWhereWrk .= "(" . "`Payment_Status`=" . 9 . ")";
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

			// modified
			$customer_invoices->modified->HrefValue = "";
			$customer_invoices->modified->TooltipValue = "";

			// User_ID
			$customer_invoices->User_ID->HrefValue = "";
			$customer_invoices->User_ID->TooltipValue = "";

			// Remarks
			$customer_invoices->Remarks->HrefValue = "";
			$customer_invoices->Remarks->TooltipValue = "";
		} elseif ($customer_invoices->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$customer_invoices->id->EditCustomAttributes = "";
			$customer_invoices->id->EditValue = $customer_invoices->id->CurrentValue;
			$customer_invoices->id->CssStyle = "";
			$customer_invoices->id->CssClass = "";
			$customer_invoices->id->ViewCustomAttributes = "";

			// Payment_ID
			$customer_invoices->Payment_ID->EditCustomAttributes = "";
			if ($customer_invoices->Payment_ID->getSessionValue() <> "") {
				$customer_invoices->Payment_ID->CurrentValue = $customer_invoices->Payment_ID->getSessionValue();
			$customer_invoices->Payment_ID->ViewValue = $customer_invoices->Payment_ID->CurrentValue;
			$customer_invoices->Payment_ID->CssStyle = "";
			$customer_invoices->Payment_ID->CssClass = "";
			$customer_invoices->Payment_ID->ViewCustomAttributes = "";
			} else {
			$customer_invoices->Payment_ID->EditValue = ew_HtmlEncode($customer_invoices->Payment_ID->CurrentValue);
			}

			// Invoice_ID
			$customer_invoices->Invoice_ID->EditCustomAttributes = "";
			if ($customer_invoices->Invoice_ID->getSessionValue() <> "") {
				$customer_invoices->Invoice_ID->CurrentValue = $customer_invoices->Invoice_ID->getSessionValue();
			if (strval($customer_invoices->Invoice_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customer_invoices->Invoice_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Invoice_Number` FROM `invoices`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Payment_Status`=" . 9 . ")";
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
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Invoice_Number`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `invoices`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Payment_Status`=" . 9 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Invoice_Number` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$customer_invoices->Invoice_ID->EditValue = $arwrk;
			}

			// Invoice_Bill_Date
			$customer_invoices->Invoice_Bill_Date->EditCustomAttributes = "";
			$customer_invoices->Invoice_Bill_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($customer_invoices->Invoice_Bill_Date->CurrentValue, 6));

			// Due_Date
			$customer_invoices->Due_Date->EditCustomAttributes = "";
			$customer_invoices->Due_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($customer_invoices->Due_Date->CurrentValue, 6));

			// Total_Amount_Due
			$customer_invoices->Total_Amount_Due->EditCustomAttributes = "";
			$customer_invoices->Total_Amount_Due->EditValue = ew_HtmlEncode($customer_invoices->Total_Amount_Due->CurrentValue);

			// Payment_Status_ID
			$customer_invoices->Payment_Status_ID->EditCustomAttributes = "";
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
			$customer_invoices->Payment_Status_ID->EditValue = $arwrk;

			// Status_ID
			$customer_invoices->Status_ID->EditCustomAttributes = "";
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
			$customer_invoices->Status_ID->EditValue = $arwrk;

			// modified
			// User_ID
			// Remarks

			$customer_invoices->Remarks->EditCustomAttributes = "";
			$customer_invoices->Remarks->EditValue = ew_HtmlEncode($customer_invoices->Remarks->CurrentValue);

			// Edit refer script
			// id

			$customer_invoices->id->HrefValue = "";

			// Payment_ID
			if (!ew_Empty($customer_invoices->Payment_ID->CurrentValue)) {
				$customer_invoices->Payment_ID->HrefValue = $customer_invoices->Payment_ID->CurrentValue;
				if ($customer_invoices->Export <> "") $customer_invoices->Payment_ID->HrefValue = ew_ConvertFullUrl($customer_invoices->Payment_ID->HrefValue);
			} else {
				$customer_invoices->Payment_ID->HrefValue = "";
			}

			// Invoice_ID
			if (!ew_Empty($customer_invoices->Invoice_ID->CurrentValue)) {
				$customer_invoices->Invoice_ID->HrefValue = $customer_invoices->Invoice_ID->CurrentValue;
				if ($customer_invoices->Export <> "") $customer_invoices->Invoice_ID->HrefValue = ew_ConvertFullUrl($customer_invoices->Invoice_ID->HrefValue);
			} else {
				$customer_invoices->Invoice_ID->HrefValue = "";
			}

			// Invoice_Bill_Date
			$customer_invoices->Invoice_Bill_Date->HrefValue = "";

			// Due_Date
			$customer_invoices->Due_Date->HrefValue = "";

			// Total_Amount_Due
			$customer_invoices->Total_Amount_Due->HrefValue = "";

			// Payment_Status_ID
			$customer_invoices->Payment_Status_ID->HrefValue = "";

			// Status_ID
			$customer_invoices->Status_ID->HrefValue = "";

			// modified
			$customer_invoices->modified->HrefValue = "";

			// User_ID
			$customer_invoices->User_ID->HrefValue = "";

			// Remarks
			$customer_invoices->Remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($customer_invoices->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$customer_invoices->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $customer_invoices;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($customer_invoices->Payment_ID->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $customer_invoices->Payment_ID->FldErrMsg();
		}
		if (!ew_CheckUSDate($customer_invoices->Invoice_Bill_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $customer_invoices->Invoice_Bill_Date->FldErrMsg();
		}
		if (!ew_CheckUSDate($customer_invoices->Due_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $customer_invoices->Due_Date->FldErrMsg();
		}
		if (!ew_CheckNumber($customer_invoices->Total_Amount_Due->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $customer_invoices->Total_Amount_Due->FldErrMsg();
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
		global $conn, $Security, $Language, $customer_invoices;
		$sFilter = $customer_invoices->KeyFilter();
		$customer_invoices->CurrentFilter = $sFilter;
		$sSql = $customer_invoices->SQL();
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

			// Payment_ID
			$customer_invoices->Payment_ID->SetDbValueDef($rsnew, $customer_invoices->Payment_ID->CurrentValue, NULL, FALSE);

			// Invoice_ID
			$customer_invoices->Invoice_ID->SetDbValueDef($rsnew, $customer_invoices->Invoice_ID->CurrentValue, NULL, FALSE);

			// Invoice_Bill_Date
			$customer_invoices->Invoice_Bill_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($customer_invoices->Invoice_Bill_Date->CurrentValue, 6, FALSE), NULL);

			// Due_Date
			$customer_invoices->Due_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($customer_invoices->Due_Date->CurrentValue, 6, FALSE), NULL);

			// Total_Amount_Due
			$customer_invoices->Total_Amount_Due->SetDbValueDef($rsnew, $customer_invoices->Total_Amount_Due->CurrentValue, NULL, FALSE);

			// Payment_Status_ID
			$customer_invoices->Payment_Status_ID->SetDbValueDef($rsnew, $customer_invoices->Payment_Status_ID->CurrentValue, NULL, FALSE);

			// Status_ID
			$customer_invoices->Status_ID->SetDbValueDef($rsnew, $customer_invoices->Status_ID->CurrentValue, NULL, FALSE);

			// modified
			$customer_invoices->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['modified'] =& $customer_invoices->modified->DbValue;

			// User_ID
			$customer_invoices->User_ID->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['User_ID'] =& $customer_invoices->User_ID->DbValue;

			// Remarks
			$customer_invoices->Remarks->SetDbValueDef($rsnew, $customer_invoices->Remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $customer_invoices->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($customer_invoices->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($customer_invoices->CancelMessage <> "") {
					$this->setMessage($customer_invoices->CancelMessage);
					$customer_invoices->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$customer_invoices->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
}
?>
