<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "journal_accountsinfo.php" ?>
<?php include "usersinfo.php" ?>
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
$journal_accounts_edit = new cjournal_accounts_edit();
$Page =& $journal_accounts_edit;

// Page init
$journal_accounts_edit->Page_Init();

// Page main
$journal_accounts_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var journal_accounts_edit = new ew_Page("journal_accounts_edit");

// page properties
journal_accounts_edit.PageID = "edit"; // page ID
journal_accounts_edit.FormID = "fjournal_accountsedit"; // form ID
var EW_PAGE_ID = journal_accounts_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
journal_accounts_edit.ValidateForm = function(fobj) {
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
journal_accounts_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
journal_accounts_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
journal_accounts_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
journal_accounts_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $journal_accounts->TableCaption() ?><br><br>
<a href="<?php echo $journal_accounts->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$journal_accounts_edit->ShowMessage();
?>
<form name="fjournal_accountsedit" id="fjournal_accountsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return journal_accounts_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="journal_accounts">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($journal_accounts->id->Visible) { // id ?>
	<tr<?php echo $journal_accounts->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->id->FldCaption() ?></td>
		<td<?php echo $journal_accounts->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $journal_accounts->id->ViewAttributes() ?>><?php echo $journal_accounts->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($journal_accounts->id->CurrentValue) ?>">
</span><?php echo $journal_accounts->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->journal_type_id->Visible) { // journal_type_id ?>
	<tr<?php echo $journal_accounts->journal_type_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->journal_type_id->FldCaption() ?></td>
		<td<?php echo $journal_accounts->journal_type_id->CellAttributes() ?>><span id="el_journal_type_id">
<select id="x_journal_type_id" name="x_journal_type_id" title="<?php echo $journal_accounts->journal_type_id->FldTitle() ?>"<?php echo $journal_accounts->journal_type_id->EditAttributes() ?>>
<?php
if (is_array($journal_accounts->journal_type_id->EditValue)) {
	$arwrk = $journal_accounts->journal_type_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($journal_accounts->journal_type_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $journal_accounts->journal_type_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Account_Name->Visible) { // Account_Name ?>
	<tr<?php echo $journal_accounts->Account_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Account_Name->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Account_Name->CellAttributes() ?>><span id="el_Account_Name">
<input type="text" name="x_Account_Name" id="x_Account_Name" title="<?php echo $journal_accounts->Account_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $journal_accounts->Account_Name->EditValue ?>"<?php echo $journal_accounts->Account_Name->EditAttributes() ?>>
</span><?php echo $journal_accounts->Account_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Account_Reference_No->Visible) { // Account_Reference_No ?>
	<tr<?php echo $journal_accounts->Account_Reference_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Account_Reference_No->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Account_Reference_No->CellAttributes() ?>><span id="el_Account_Reference_No">
<input type="text" name="x_Account_Reference_No" id="x_Account_Reference_No" title="<?php echo $journal_accounts->Account_Reference_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $journal_accounts->Account_Reference_No->EditValue ?>"<?php echo $journal_accounts->Account_Reference_No->EditAttributes() ?>>
</span><?php echo $journal_accounts->Account_Reference_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Business_Name->Visible) { // Business_Name ?>
	<tr<?php echo $journal_accounts->Business_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Business_Name->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Business_Name->CellAttributes() ?>><span id="el_Business_Name">
<input type="text" name="x_Business_Name" id="x_Business_Name" title="<?php echo $journal_accounts->Business_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $journal_accounts->Business_Name->EditValue ?>"<?php echo $journal_accounts->Business_Name->EditAttributes() ?>>
</span><?php echo $journal_accounts->Business_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Address->Visible) { // Address ?>
	<tr<?php echo $journal_accounts->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Address->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Address->CellAttributes() ?>><span id="el_Address">
<textarea name="x_Address" id="x_Address" title="<?php echo $journal_accounts->Address->FldTitle() ?>" cols="35" rows="4"<?php echo $journal_accounts->Address->EditAttributes() ?>><?php echo $journal_accounts->Address->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Address", function() {
	var oCKeditor = CKEDITOR.replace('x_Address', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $journal_accounts->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($journal_accounts->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $journal_accounts->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_accounts->Remarks->FldCaption() ?></td>
		<td<?php echo $journal_accounts->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $journal_accounts->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $journal_accounts->Remarks->EditAttributes() ?>><?php echo $journal_accounts->Remarks->EditValue ?></textarea>
</span><?php echo $journal_accounts->Remarks->CustomMsg ?></td>
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
$journal_accounts_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cjournal_accounts_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'journal_accounts';

	// Page object name
	var $PageObjName = 'journal_accounts_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $journal_accounts;
		if ($journal_accounts->UseTokenInUrl) $PageUrl .= "t=" . $journal_accounts->TableVar . "&"; // Add page token
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
		global $objForm, $journal_accounts;
		if ($journal_accounts->UseTokenInUrl) {
			if ($objForm)
				return ($journal_accounts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($journal_accounts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cjournal_accounts_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (journal_accounts)
		$GLOBALS["journal_accounts"] = new cjournal_accounts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'journal_accounts', TRUE);

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
		global $journal_accounts;

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
			$this->Page_Terminate("journal_accountslist.php");
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
		global $objForm, $Language, $gsFormError, $journal_accounts;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$journal_accounts->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$journal_accounts->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$journal_accounts->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$journal_accounts->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$journal_accounts->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($journal_accounts->id->CurrentValue == "")
			$this->Page_Terminate("journal_accountslist.php"); // Invalid key, return to list
		switch ($journal_accounts->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("journal_accountslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$journal_accounts->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $journal_accounts->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$journal_accounts->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$journal_accounts->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $journal_accounts;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $journal_accounts;
		$journal_accounts->id->setFormValue($objForm->GetValue("x_id"));
		$journal_accounts->journal_type_id->setFormValue($objForm->GetValue("x_journal_type_id"));
		$journal_accounts->Account_Name->setFormValue($objForm->GetValue("x_Account_Name"));
		$journal_accounts->Account_Reference_No->setFormValue($objForm->GetValue("x_Account_Reference_No"));
		$journal_accounts->Business_Name->setFormValue($objForm->GetValue("x_Business_Name"));
		$journal_accounts->Address->setFormValue($objForm->GetValue("x_Address"));
		$journal_accounts->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$journal_accounts->modified->setFormValue($objForm->GetValue("x_modified"));
		$journal_accounts->modified->CurrentValue = ew_UnFormatDateTime($journal_accounts->modified->CurrentValue, 6);
		$journal_accounts->User_ID->setFormValue($objForm->GetValue("x_User_ID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $journal_accounts;
		$this->LoadRow();
		$journal_accounts->id->CurrentValue = $journal_accounts->id->FormValue;
		$journal_accounts->journal_type_id->CurrentValue = $journal_accounts->journal_type_id->FormValue;
		$journal_accounts->Account_Name->CurrentValue = $journal_accounts->Account_Name->FormValue;
		$journal_accounts->Account_Reference_No->CurrentValue = $journal_accounts->Account_Reference_No->FormValue;
		$journal_accounts->Business_Name->CurrentValue = $journal_accounts->Business_Name->FormValue;
		$journal_accounts->Address->CurrentValue = $journal_accounts->Address->FormValue;
		$journal_accounts->Remarks->CurrentValue = $journal_accounts->Remarks->FormValue;
		$journal_accounts->modified->CurrentValue = $journal_accounts->modified->FormValue;
		$journal_accounts->modified->CurrentValue = ew_UnFormatDateTime($journal_accounts->modified->CurrentValue, 6);
		$journal_accounts->User_ID->CurrentValue = $journal_accounts->User_ID->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $journal_accounts;
		$sFilter = $journal_accounts->KeyFilter();

		// Call Row Selecting event
		$journal_accounts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$journal_accounts->CurrentFilter = $sFilter;
		$sSql = $journal_accounts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$journal_accounts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $journal_accounts;
		$journal_accounts->id->setDbValue($rs->fields('id'));
		$journal_accounts->journal_type_id->setDbValue($rs->fields('journal_type_id'));
		$journal_accounts->Account_Name->setDbValue($rs->fields('Account_Name'));
		$journal_accounts->Account_Reference_No->setDbValue($rs->fields('Account_Reference_No'));
		$journal_accounts->Business_Name->setDbValue($rs->fields('Business_Name'));
		$journal_accounts->Address->setDbValue($rs->fields('Address'));
		$journal_accounts->Remarks->setDbValue($rs->fields('Remarks'));
		$journal_accounts->created->setDbValue($rs->fields('created'));
		$journal_accounts->modified->setDbValue($rs->fields('modified'));
		$journal_accounts->User_ID->setDbValue($rs->fields('User_ID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $journal_accounts;

		// Initialize URLs
		// Call Row_Rendering event

		$journal_accounts->Row_Rendering();

		// Common render codes for all row types
		// id

		$journal_accounts->id->CellCssStyle = ""; $journal_accounts->id->CellCssClass = "";
		$journal_accounts->id->CellAttrs = array(); $journal_accounts->id->ViewAttrs = array(); $journal_accounts->id->EditAttrs = array();

		// journal_type_id
		$journal_accounts->journal_type_id->CellCssStyle = ""; $journal_accounts->journal_type_id->CellCssClass = "";
		$journal_accounts->journal_type_id->CellAttrs = array(); $journal_accounts->journal_type_id->ViewAttrs = array(); $journal_accounts->journal_type_id->EditAttrs = array();

		// Account_Name
		$journal_accounts->Account_Name->CellCssStyle = ""; $journal_accounts->Account_Name->CellCssClass = "";
		$journal_accounts->Account_Name->CellAttrs = array(); $journal_accounts->Account_Name->ViewAttrs = array(); $journal_accounts->Account_Name->EditAttrs = array();

		// Account_Reference_No
		$journal_accounts->Account_Reference_No->CellCssStyle = ""; $journal_accounts->Account_Reference_No->CellCssClass = "";
		$journal_accounts->Account_Reference_No->CellAttrs = array(); $journal_accounts->Account_Reference_No->ViewAttrs = array(); $journal_accounts->Account_Reference_No->EditAttrs = array();

		// Business_Name
		$journal_accounts->Business_Name->CellCssStyle = ""; $journal_accounts->Business_Name->CellCssClass = "";
		$journal_accounts->Business_Name->CellAttrs = array(); $journal_accounts->Business_Name->ViewAttrs = array(); $journal_accounts->Business_Name->EditAttrs = array();

		// Address
		$journal_accounts->Address->CellCssStyle = ""; $journal_accounts->Address->CellCssClass = "";
		$journal_accounts->Address->CellAttrs = array(); $journal_accounts->Address->ViewAttrs = array(); $journal_accounts->Address->EditAttrs = array();

		// Remarks
		$journal_accounts->Remarks->CellCssStyle = ""; $journal_accounts->Remarks->CellCssClass = "";
		$journal_accounts->Remarks->CellAttrs = array(); $journal_accounts->Remarks->ViewAttrs = array(); $journal_accounts->Remarks->EditAttrs = array();

		// modified
		$journal_accounts->modified->CellCssStyle = ""; $journal_accounts->modified->CellCssClass = "";
		$journal_accounts->modified->CellAttrs = array(); $journal_accounts->modified->ViewAttrs = array(); $journal_accounts->modified->EditAttrs = array();

		// User_ID
		$journal_accounts->User_ID->CellCssStyle = ""; $journal_accounts->User_ID->CellCssClass = "";
		$journal_accounts->User_ID->CellAttrs = array(); $journal_accounts->User_ID->ViewAttrs = array(); $journal_accounts->User_ID->EditAttrs = array();
		if ($journal_accounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$journal_accounts->id->ViewValue = $journal_accounts->id->CurrentValue;
			$journal_accounts->id->CssStyle = "";
			$journal_accounts->id->CssClass = "";
			$journal_accounts->id->ViewCustomAttributes = "";

			// journal_type_id
			if (strval($journal_accounts->journal_type_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($journal_accounts->journal_type_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$journal_accounts->journal_type_id->ViewValue = $rswrk->fields('Journal_Name');
					$rswrk->Close();
				} else {
					$journal_accounts->journal_type_id->ViewValue = $journal_accounts->journal_type_id->CurrentValue;
				}
			} else {
				$journal_accounts->journal_type_id->ViewValue = NULL;
			}
			$journal_accounts->journal_type_id->CssStyle = "";
			$journal_accounts->journal_type_id->CssClass = "";
			$journal_accounts->journal_type_id->ViewCustomAttributes = "";

			// Account_Name
			$journal_accounts->Account_Name->ViewValue = $journal_accounts->Account_Name->CurrentValue;
			$journal_accounts->Account_Name->CssStyle = "";
			$journal_accounts->Account_Name->CssClass = "";
			$journal_accounts->Account_Name->ViewCustomAttributes = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->ViewValue = $journal_accounts->Account_Reference_No->CurrentValue;
			$journal_accounts->Account_Reference_No->CssStyle = "";
			$journal_accounts->Account_Reference_No->CssClass = "";
			$journal_accounts->Account_Reference_No->ViewCustomAttributes = "";

			// Business_Name
			$journal_accounts->Business_Name->ViewValue = $journal_accounts->Business_Name->CurrentValue;
			$journal_accounts->Business_Name->CssStyle = "";
			$journal_accounts->Business_Name->CssClass = "";
			$journal_accounts->Business_Name->ViewCustomAttributes = "";

			// Address
			$journal_accounts->Address->ViewValue = $journal_accounts->Address->CurrentValue;
			$journal_accounts->Address->CssStyle = "";
			$journal_accounts->Address->CssClass = "";
			$journal_accounts->Address->ViewCustomAttributes = "";

			// Remarks
			$journal_accounts->Remarks->ViewValue = $journal_accounts->Remarks->CurrentValue;
			$journal_accounts->Remarks->CssStyle = "";
			$journal_accounts->Remarks->CssClass = "";
			$journal_accounts->Remarks->ViewCustomAttributes = "";

			// created
			$journal_accounts->created->ViewValue = $journal_accounts->created->CurrentValue;
			$journal_accounts->created->ViewValue = ew_FormatDateTime($journal_accounts->created->ViewValue, 6);
			$journal_accounts->created->CssStyle = "";
			$journal_accounts->created->CssClass = "";
			$journal_accounts->created->ViewCustomAttributes = "";

			// modified
			$journal_accounts->modified->ViewValue = $journal_accounts->modified->CurrentValue;
			$journal_accounts->modified->ViewValue = ew_FormatDateTime($journal_accounts->modified->ViewValue, 6);
			$journal_accounts->modified->CssStyle = "";
			$journal_accounts->modified->CssClass = "";
			$journal_accounts->modified->ViewCustomAttributes = "";

			// User_ID
			$journal_accounts->User_ID->ViewValue = $journal_accounts->User_ID->CurrentValue;
			$journal_accounts->User_ID->CssStyle = "";
			$journal_accounts->User_ID->CssClass = "";
			$journal_accounts->User_ID->ViewCustomAttributes = "";

			// id
			$journal_accounts->id->HrefValue = "";
			$journal_accounts->id->TooltipValue = "";

			// journal_type_id
			$journal_accounts->journal_type_id->HrefValue = "";
			$journal_accounts->journal_type_id->TooltipValue = "";

			// Account_Name
			$journal_accounts->Account_Name->HrefValue = "";
			$journal_accounts->Account_Name->TooltipValue = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->HrefValue = "";
			$journal_accounts->Account_Reference_No->TooltipValue = "";

			// Business_Name
			$journal_accounts->Business_Name->HrefValue = "";
			$journal_accounts->Business_Name->TooltipValue = "";

			// Address
			$journal_accounts->Address->HrefValue = "";
			$journal_accounts->Address->TooltipValue = "";

			// Remarks
			$journal_accounts->Remarks->HrefValue = "";
			$journal_accounts->Remarks->TooltipValue = "";

			// modified
			$journal_accounts->modified->HrefValue = "";
			$journal_accounts->modified->TooltipValue = "";

			// User_ID
			$journal_accounts->User_ID->HrefValue = "";
			$journal_accounts->User_ID->TooltipValue = "";
		} elseif ($journal_accounts->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$journal_accounts->id->EditCustomAttributes = "";
			$journal_accounts->id->EditValue = $journal_accounts->id->CurrentValue;
			$journal_accounts->id->CssStyle = "";
			$journal_accounts->id->CssClass = "";
			$journal_accounts->id->ViewCustomAttributes = "";

			// journal_type_id
			$journal_accounts->journal_type_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Journal_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `journal_types`";
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
			$journal_accounts->journal_type_id->EditValue = $arwrk;

			// Account_Name
			$journal_accounts->Account_Name->EditCustomAttributes = "";
			$journal_accounts->Account_Name->EditValue = ew_HtmlEncode($journal_accounts->Account_Name->CurrentValue);

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->EditCustomAttributes = "";
			$journal_accounts->Account_Reference_No->EditValue = ew_HtmlEncode($journal_accounts->Account_Reference_No->CurrentValue);

			// Business_Name
			$journal_accounts->Business_Name->EditCustomAttributes = "";
			$journal_accounts->Business_Name->EditValue = ew_HtmlEncode($journal_accounts->Business_Name->CurrentValue);

			// Address
			$journal_accounts->Address->EditCustomAttributes = "";
			$journal_accounts->Address->EditValue = ew_HtmlEncode($journal_accounts->Address->CurrentValue);

			// Remarks
			$journal_accounts->Remarks->EditCustomAttributes = "";
			$journal_accounts->Remarks->EditValue = ew_HtmlEncode($journal_accounts->Remarks->CurrentValue);

			// modified
			// User_ID
			// Edit refer script
			// id

			$journal_accounts->id->HrefValue = "";

			// journal_type_id
			$journal_accounts->journal_type_id->HrefValue = "";

			// Account_Name
			$journal_accounts->Account_Name->HrefValue = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->HrefValue = "";

			// Business_Name
			$journal_accounts->Business_Name->HrefValue = "";

			// Address
			$journal_accounts->Address->HrefValue = "";

			// Remarks
			$journal_accounts->Remarks->HrefValue = "";

			// modified
			$journal_accounts->modified->HrefValue = "";

			// User_ID
			$journal_accounts->User_ID->HrefValue = "";
		}

		// Call Row Rendered event
		if ($journal_accounts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$journal_accounts->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $journal_accounts;

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
		global $conn, $Security, $Language, $journal_accounts;
		$sFilter = $journal_accounts->KeyFilter();
		$journal_accounts->CurrentFilter = $sFilter;
		$sSql = $journal_accounts->SQL();
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

			// journal_type_id
			$journal_accounts->journal_type_id->SetDbValueDef($rsnew, $journal_accounts->journal_type_id->CurrentValue, NULL, FALSE);

			// Account_Name
			$journal_accounts->Account_Name->SetDbValueDef($rsnew, $journal_accounts->Account_Name->CurrentValue, NULL, FALSE);

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->SetDbValueDef($rsnew, $journal_accounts->Account_Reference_No->CurrentValue, NULL, FALSE);

			// Business_Name
			$journal_accounts->Business_Name->SetDbValueDef($rsnew, $journal_accounts->Business_Name->CurrentValue, NULL, FALSE);

			// Address
			$journal_accounts->Address->SetDbValueDef($rsnew, $journal_accounts->Address->CurrentValue, NULL, FALSE);

			// Remarks
			$journal_accounts->Remarks->SetDbValueDef($rsnew, $journal_accounts->Remarks->CurrentValue, NULL, FALSE);

			// modified
			$journal_accounts->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['modified'] =& $journal_accounts->modified->DbValue;

			// User_ID
			$journal_accounts->User_ID->SetDbValueDef($rsnew, CurrentUserID(), NULL);
			$rsnew['User_ID'] =& $journal_accounts->User_ID->DbValue;

			// Call Row Updating event
			$bUpdateRow = $journal_accounts->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($journal_accounts->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($journal_accounts->CancelMessage <> "") {
					$this->setMessage($journal_accounts->CancelMessage);
					$journal_accounts->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$journal_accounts->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $journal_accounts;
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
				$this->sDbMasterFilter = $journal_accounts->SqlMasterFilter_account_payments();
				$this->sDbDetailFilter = $journal_accounts->SqlDetailFilter_account_payments();
				if (@$_GET["Journal_Account_ID"] <> "") {
					$GLOBALS["account_payments"]->Journal_Account_ID->setQueryStringValue($_GET["Journal_Account_ID"]);
					$journal_accounts->id->setQueryStringValue($GLOBALS["account_payments"]->Journal_Account_ID->QueryStringValue);
					$journal_accounts->id->setSessionValue($journal_accounts->id->QueryStringValue);
					if (!is_numeric($GLOBALS["account_payments"]->Journal_Account_ID->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@Journal_Account_ID@", ew_AdjustSql($GLOBALS["account_payments"]->Journal_Account_ID->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["account_payments"]->Journal_Account_ID->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$journal_accounts->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$journal_accounts->setStartRecordNumber($this->lStartRec);
			$journal_accounts->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$journal_accounts->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "account_payments") {
				if ($journal_accounts->id->QueryStringValue == "") $journal_accounts->id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $journal_accounts->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $journal_accounts->getDetailFilter(); // Restore detail filter
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
