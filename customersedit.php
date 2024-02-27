<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "customersinfo.php" ?>
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
$customers_edit = new ccustomers_edit();
$Page =& $customers_edit;

// Page init
$customers_edit->Page_Init();

// Page main
$customers_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var customers_edit = new ew_Page("customers_edit");

// page properties
customers_edit.PageID = "edit"; // page ID
customers_edit.FormID = "fcustomersedit"; // form ID
var EW_PAGE_ID = customers_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
customers_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
customers_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
customers_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customers_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $customers->TableCaption() ?><br><br>
<a href="<?php echo $customers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$customers_edit->ShowMessage();
?>
<form name="fcustomersedit" id="fcustomersedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return customers_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="customers">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($customers->id->Visible) { // id ?>
	<tr<?php echo $customers->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->id->FldCaption() ?></td>
		<td<?php echo $customers->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $customers->id->ViewAttributes() ?>><?php echo $customers->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($customers->id->CurrentValue) ?>">
</span><?php echo $customers->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customers->client_id->Visible) { // client_id ?>
	<tr<?php echo $customers->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->client_id->FldCaption() ?></td>
		<td<?php echo $customers->client_id->CellAttributes() ?>><span id="el_client_id">
<select id="x_client_id" name="x_client_id" title="<?php echo $customers->client_id->FldTitle() ?>"<?php echo $customers->client_id->EditAttributes() ?>>
<?php
if (is_array($customers->client_id->EditValue)) {
	$arwrk = $customers->client_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($customers->client_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $customers->client_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customers->Customer_No->Visible) { // Customer_No ?>
	<tr<?php echo $customers->Customer_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Customer_No->FldCaption() ?></td>
		<td<?php echo $customers->Customer_No->CellAttributes() ?>><span id="el_Customer_No">
<input type="text" name="x_Customer_No" id="x_Customer_No" title="<?php echo $customers->Customer_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $customers->Customer_No->EditValue ?>"<?php echo $customers->Customer_No->EditAttributes() ?>>
</span><?php echo $customers->Customer_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customers->Customer_Name->Visible) { // Customer_Name ?>
	<tr<?php echo $customers->Customer_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Customer_Name->FldCaption() ?></td>
		<td<?php echo $customers->Customer_Name->CellAttributes() ?>><span id="el_Customer_Name">
<input type="text" name="x_Customer_Name" id="x_Customer_Name" title="<?php echo $customers->Customer_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $customers->Customer_Name->EditValue ?>"<?php echo $customers->Customer_Name->EditAttributes() ?>>
</span><?php echo $customers->Customer_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customers->Address->Visible) { // Address ?>
	<tr<?php echo $customers->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Address->FldCaption() ?></td>
		<td<?php echo $customers->Address->CellAttributes() ?>><span id="el_Address">
<select id="x_Address" name="x_Address" title="<?php echo $customers->Address->FldTitle() ?>"<?php echo $customers->Address->EditAttributes() ?>>
<?php
if (is_array($customers->Address->EditValue)) {
	$arwrk = $customers->Address->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($customers->Address->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $customers->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customers->Contact_Person->Visible) { // Contact_Person ?>
	<tr<?php echo $customers->Contact_Person->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Contact_Person->FldCaption() ?></td>
		<td<?php echo $customers->Contact_Person->CellAttributes() ?>><span id="el_Contact_Person">
<input type="text" name="x_Contact_Person" id="x_Contact_Person" title="<?php echo $customers->Contact_Person->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $customers->Contact_Person->EditValue ?>"<?php echo $customers->Contact_Person->EditAttributes() ?>>
</span><?php echo $customers->Contact_Person->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customers->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $customers->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Contact_No->FldCaption() ?></td>
		<td<?php echo $customers->Contact_No->CellAttributes() ?>><span id="el_Contact_No">
<input type="text" name="x_Contact_No" id="x_Contact_No" title="<?php echo $customers->Contact_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $customers->Contact_No->EditValue ?>"<?php echo $customers->Contact_No->EditAttributes() ?>>
</span><?php echo $customers->Contact_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customers->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $customers->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $customers->Remarks->FldCaption() ?></td>
		<td<?php echo $customers->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $customers->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $customers->Remarks->EditAttributes() ?>><?php echo $customers->Remarks->EditValue ?></textarea>
</span><?php echo $customers->Remarks->CustomMsg ?></td>
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
$customers_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ccustomers_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'customers';

	// Page object name
	var $PageObjName = 'customers_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customers;
		if ($customers->UseTokenInUrl) $PageUrl .= "t=" . $customers->TableVar . "&"; // Add page token
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
		global $objForm, $customers;
		if ($customers->UseTokenInUrl) {
			if ($objForm)
				return ($customers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccustomers_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (customers)
		$GLOBALS["customers"] = new ccustomers();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customers', TRUE);

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
		global $customers;

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
			$this->Page_Terminate("customerslist.php");
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
		global $objForm, $Language, $gsFormError, $customers;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$customers->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$customers->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$customers->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$customers->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$customers->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($customers->id->CurrentValue == "")
			$this->Page_Terminate("customerslist.php"); // Invalid key, return to list
		switch ($customers->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("customerslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$customers->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $customers->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$customers->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$customers->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $customers;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $customers;
		$customers->id->setFormValue($objForm->GetValue("x_id"));
		$customers->client_id->setFormValue($objForm->GetValue("x_client_id"));
		$customers->Customer_No->setFormValue($objForm->GetValue("x_Customer_No"));
		$customers->Customer_Name->setFormValue($objForm->GetValue("x_Customer_Name"));
		$customers->Address->setFormValue($objForm->GetValue("x_Address"));
		$customers->Contact_Person->setFormValue($objForm->GetValue("x_Contact_Person"));
		$customers->Contact_No->setFormValue($objForm->GetValue("x_Contact_No"));
		$customers->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $customers;
		$this->LoadRow();
		$customers->id->CurrentValue = $customers->id->FormValue;
		$customers->client_id->CurrentValue = $customers->client_id->FormValue;
		$customers->Customer_No->CurrentValue = $customers->Customer_No->FormValue;
		$customers->Customer_Name->CurrentValue = $customers->Customer_Name->FormValue;
		$customers->Address->CurrentValue = $customers->Address->FormValue;
		$customers->Contact_Person->CurrentValue = $customers->Contact_Person->FormValue;
		$customers->Contact_No->CurrentValue = $customers->Contact_No->FormValue;
		$customers->Remarks->CurrentValue = $customers->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customers;
		$sFilter = $customers->KeyFilter();

		// Call Row Selecting event
		$customers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$customers->CurrentFilter = $sFilter;
		$sSql = $customers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$customers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $customers;
		$customers->id->setDbValue($rs->fields('id'));
		$customers->client_id->setDbValue($rs->fields('client_id'));
		$customers->Customer_No->setDbValue($rs->fields('Customer_No'));
		$customers->Customer_Name->setDbValue($rs->fields('Customer_Name'));
		$customers->Address->setDbValue($rs->fields('Address'));
		$customers->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$customers->Contact_No->setDbValue($rs->fields('Contact_No'));
		$customers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $customers;

		// Initialize URLs
		// Call Row_Rendering event

		$customers->Row_Rendering();

		// Common render codes for all row types
		// id

		$customers->id->CellCssStyle = ""; $customers->id->CellCssClass = "";
		$customers->id->CellAttrs = array(); $customers->id->ViewAttrs = array(); $customers->id->EditAttrs = array();

		// client_id
		$customers->client_id->CellCssStyle = ""; $customers->client_id->CellCssClass = "";
		$customers->client_id->CellAttrs = array(); $customers->client_id->ViewAttrs = array(); $customers->client_id->EditAttrs = array();

		// Customer_No
		$customers->Customer_No->CellCssStyle = ""; $customers->Customer_No->CellCssClass = "";
		$customers->Customer_No->CellAttrs = array(); $customers->Customer_No->ViewAttrs = array(); $customers->Customer_No->EditAttrs = array();

		// Customer_Name
		$customers->Customer_Name->CellCssStyle = ""; $customers->Customer_Name->CellCssClass = "";
		$customers->Customer_Name->CellAttrs = array(); $customers->Customer_Name->ViewAttrs = array(); $customers->Customer_Name->EditAttrs = array();

		// Address
		$customers->Address->CellCssStyle = ""; $customers->Address->CellCssClass = "";
		$customers->Address->CellAttrs = array(); $customers->Address->ViewAttrs = array(); $customers->Address->EditAttrs = array();

		// Contact_Person
		$customers->Contact_Person->CellCssStyle = ""; $customers->Contact_Person->CellCssClass = "";
		$customers->Contact_Person->CellAttrs = array(); $customers->Contact_Person->ViewAttrs = array(); $customers->Contact_Person->EditAttrs = array();

		// Contact_No
		$customers->Contact_No->CellCssStyle = ""; $customers->Contact_No->CellCssClass = "";
		$customers->Contact_No->CellAttrs = array(); $customers->Contact_No->ViewAttrs = array(); $customers->Contact_No->EditAttrs = array();

		// Remarks
		$customers->Remarks->CellCssStyle = ""; $customers->Remarks->CellCssClass = "";
		$customers->Remarks->CellAttrs = array(); $customers->Remarks->ViewAttrs = array(); $customers->Remarks->EditAttrs = array();
		if ($customers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customers->id->ViewValue = $customers->id->CurrentValue;
			$customers->id->CssStyle = "";
			$customers->id->CssClass = "";
			$customers->id->ViewCustomAttributes = "";

			// client_id
			if (strval($customers->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($customers->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customers->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$customers->client_id->ViewValue = $customers->client_id->CurrentValue;
				}
			} else {
				$customers->client_id->ViewValue = NULL;
			}
			$customers->client_id->CssStyle = "";
			$customers->client_id->CssClass = "";
			$customers->client_id->ViewCustomAttributes = "";

			// Customer_No
			$customers->Customer_No->ViewValue = $customers->Customer_No->CurrentValue;
			$customers->Customer_No->CssStyle = "";
			$customers->Customer_No->CssClass = "";
			$customers->Customer_No->ViewCustomAttributes = "";

			// Customer_Name
			$customers->Customer_Name->ViewValue = $customers->Customer_Name->CurrentValue;
			$customers->Customer_Name->CssStyle = "";
			$customers->Customer_Name->CssClass = "";
			$customers->Customer_Name->ViewCustomAttributes = "";

			// Address
			if (strval($customers->Address->CurrentValue) <> "") {
				$sFilterWrk = "`Destination` = '" . ew_AdjustSql($customers->Address->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$customers->Address->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$customers->Address->ViewValue = $customers->Address->CurrentValue;
				}
			} else {
				$customers->Address->ViewValue = NULL;
			}
			$customers->Address->CssStyle = "";
			$customers->Address->CssClass = "";
			$customers->Address->ViewCustomAttributes = "";

			// Contact_Person
			$customers->Contact_Person->ViewValue = $customers->Contact_Person->CurrentValue;
			$customers->Contact_Person->CssStyle = "";
			$customers->Contact_Person->CssClass = "";
			$customers->Contact_Person->ViewCustomAttributes = "";

			// Contact_No
			$customers->Contact_No->ViewValue = $customers->Contact_No->CurrentValue;
			$customers->Contact_No->CssStyle = "";
			$customers->Contact_No->CssClass = "";
			$customers->Contact_No->ViewCustomAttributes = "";

			// Remarks
			$customers->Remarks->ViewValue = $customers->Remarks->CurrentValue;
			$customers->Remarks->CssStyle = "";
			$customers->Remarks->CssClass = "";
			$customers->Remarks->ViewCustomAttributes = "";

			// id
			$customers->id->HrefValue = "";
			$customers->id->TooltipValue = "";

			// client_id
			$customers->client_id->HrefValue = "";
			$customers->client_id->TooltipValue = "";

			// Customer_No
			$customers->Customer_No->HrefValue = "";
			$customers->Customer_No->TooltipValue = "";

			// Customer_Name
			$customers->Customer_Name->HrefValue = "";
			$customers->Customer_Name->TooltipValue = "";

			// Address
			$customers->Address->HrefValue = "";
			$customers->Address->TooltipValue = "";

			// Contact_Person
			$customers->Contact_Person->HrefValue = "";
			$customers->Contact_Person->TooltipValue = "";

			// Contact_No
			$customers->Contact_No->HrefValue = "";
			$customers->Contact_No->TooltipValue = "";

			// Remarks
			$customers->Remarks->HrefValue = "";
			$customers->Remarks->TooltipValue = "";
		} elseif ($customers->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$customers->id->EditCustomAttributes = "";
			$customers->id->EditValue = $customers->id->CurrentValue;
			$customers->id->CssStyle = "";
			$customers->id->CssClass = "";
			$customers->id->ViewCustomAttributes = "";

			// client_id
			$customers->client_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Client_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `clients`";
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
			$customers->client_id->EditValue = $arwrk;

			// Customer_No
			$customers->Customer_No->EditCustomAttributes = "";
			$customers->Customer_No->EditValue = ew_HtmlEncode($customers->Customer_No->CurrentValue);

			// Customer_Name
			$customers->Customer_Name->EditCustomAttributes = "";
			$customers->Customer_Name->EditValue = ew_HtmlEncode($customers->Customer_Name->CurrentValue);

			// Address
			$customers->Address->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Destination`, `Destination`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `destinations`";
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
			$customers->Address->EditValue = $arwrk;

			// Contact_Person
			$customers->Contact_Person->EditCustomAttributes = "";
			$customers->Contact_Person->EditValue = ew_HtmlEncode($customers->Contact_Person->CurrentValue);

			// Contact_No
			$customers->Contact_No->EditCustomAttributes = "";
			$customers->Contact_No->EditValue = ew_HtmlEncode($customers->Contact_No->CurrentValue);

			// Remarks
			$customers->Remarks->EditCustomAttributes = "";
			$customers->Remarks->EditValue = ew_HtmlEncode($customers->Remarks->CurrentValue);

			// Edit refer script
			// id

			$customers->id->HrefValue = "";

			// client_id
			$customers->client_id->HrefValue = "";

			// Customer_No
			$customers->Customer_No->HrefValue = "";

			// Customer_Name
			$customers->Customer_Name->HrefValue = "";

			// Address
			$customers->Address->HrefValue = "";

			// Contact_Person
			$customers->Contact_Person->HrefValue = "";

			// Contact_No
			$customers->Contact_No->HrefValue = "";

			// Remarks
			$customers->Remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($customers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$customers->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $customers;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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
		global $conn, $Security, $Language, $customers;
		$sFilter = $customers->KeyFilter();
		$customers->CurrentFilter = $sFilter;
		$sSql = $customers->SQL();
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

			// client_id
			$customers->client_id->SetDbValueDef($rsnew, $customers->client_id->CurrentValue, NULL, FALSE);

			// Customer_No
			$customers->Customer_No->SetDbValueDef($rsnew, $customers->Customer_No->CurrentValue, NULL, FALSE);

			// Customer_Name
			$customers->Customer_Name->SetDbValueDef($rsnew, $customers->Customer_Name->CurrentValue, NULL, FALSE);

			// Address
			$customers->Address->SetDbValueDef($rsnew, $customers->Address->CurrentValue, NULL, FALSE);

			// Contact_Person
			$customers->Contact_Person->SetDbValueDef($rsnew, $customers->Contact_Person->CurrentValue, NULL, FALSE);

			// Contact_No
			$customers->Contact_No->SetDbValueDef($rsnew, $customers->Contact_No->CurrentValue, NULL, FALSE);

			// Remarks
			$customers->Remarks->SetDbValueDef($rsnew, $customers->Remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $customers->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($customers->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($customers->CancelMessage <> "") {
					$this->setMessage($customers->CancelMessage);
					$customers->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$customers->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
