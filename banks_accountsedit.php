<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "banks_accountsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "companyinfo.php" ?>
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
$banks_accounts_edit = new cbanks_accounts_edit();
$Page =& $banks_accounts_edit;

// Page init
$banks_accounts_edit->Page_Init();

// Page main
$banks_accounts_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var banks_accounts_edit = new ew_Page("banks_accounts_edit");

// page properties
banks_accounts_edit.PageID = "edit"; // page ID
banks_accounts_edit.FormID = "fbanks_accountsedit"; // form ID
var EW_PAGE_ID = banks_accounts_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
banks_accounts_edit.ValidateForm = function(fobj) {
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
banks_accounts_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
banks_accounts_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
banks_accounts_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banks_accounts_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banks_accounts->TableCaption() ?><br><br>
<a href="<?php echo $banks_accounts->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$banks_accounts_edit->ShowMessage();
?>
<form name="fbanks_accountsedit" id="fbanks_accountsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return banks_accounts_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="banks_accounts">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($banks_accounts->id->Visible) { // id ?>
	<tr<?php echo $banks_accounts->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->id->FldCaption() ?></td>
		<td<?php echo $banks_accounts->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $banks_accounts->id->ViewAttributes() ?>><?php echo $banks_accounts->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($banks_accounts->id->CurrentValue) ?>">
</span><?php echo $banks_accounts->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Bank_Name->Visible) { // Bank_Name ?>
	<tr<?php echo $banks_accounts->Bank_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Bank_Name->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Bank_Name->CellAttributes() ?>><span id="el_Bank_Name">
<input type="text" name="x_Bank_Name" id="x_Bank_Name" title="<?php echo $banks_accounts->Bank_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $banks_accounts->Bank_Name->EditValue ?>"<?php echo $banks_accounts->Bank_Name->EditAttributes() ?>>
</span><?php echo $banks_accounts->Bank_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Branch->Visible) { // Branch ?>
	<tr<?php echo $banks_accounts->Branch->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Branch->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Branch->CellAttributes() ?>><span id="el_Branch">
<input type="text" name="x_Branch" id="x_Branch" title="<?php echo $banks_accounts->Branch->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $banks_accounts->Branch->EditValue ?>"<?php echo $banks_accounts->Branch->EditAttributes() ?>>
</span><?php echo $banks_accounts->Branch->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Address->Visible) { // Address ?>
	<tr<?php echo $banks_accounts->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Address->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Address->CellAttributes() ?>><span id="el_Address">
<textarea name="x_Address" id="x_Address" title="<?php echo $banks_accounts->Address->FldTitle() ?>" cols="35" rows="4"<?php echo $banks_accounts->Address->EditAttributes() ?>><?php echo $banks_accounts->Address->EditValue ?></textarea>
</span><?php echo $banks_accounts->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Account_Name->Visible) { // Account_Name ?>
	<tr<?php echo $banks_accounts->Account_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Account_Name->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Account_Name->CellAttributes() ?>><span id="el_Account_Name">
<input type="text" name="x_Account_Name" id="x_Account_Name" title="<?php echo $banks_accounts->Account_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $banks_accounts->Account_Name->EditValue ?>"<?php echo $banks_accounts->Account_Name->EditAttributes() ?>>
</span><?php echo $banks_accounts->Account_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Account_Number->Visible) { // Account_Number ?>
	<tr<?php echo $banks_accounts->Account_Number->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Account_Number->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Account_Number->CellAttributes() ?>><span id="el_Account_Number">
<input type="text" name="x_Account_Number" id="x_Account_Number" title="<?php echo $banks_accounts->Account_Number->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $banks_accounts->Account_Number->EditValue ?>"<?php echo $banks_accounts->Account_Number->EditAttributes() ?>>
</span><?php echo $banks_accounts->Account_Number->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Account_Type->Visible) { // Account_Type ?>
	<tr<?php echo $banks_accounts->Account_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Account_Type->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Account_Type->CellAttributes() ?>><span id="el_Account_Type">
<input type="text" name="x_Account_Type" id="x_Account_Type" title="<?php echo $banks_accounts->Account_Type->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $banks_accounts->Account_Type->EditValue ?>"<?php echo $banks_accounts->Account_Type->EditAttributes() ?>>
</span><?php echo $banks_accounts->Account_Type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $banks_accounts->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Remarks->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $banks_accounts->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $banks_accounts->Remarks->EditAttributes() ?>><?php echo $banks_accounts->Remarks->EditValue ?></textarea>
</span><?php echo $banks_accounts->Remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($banks_accounts->Company->Visible) { // Company ?>
	<tr<?php echo $banks_accounts->Company->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $banks_accounts->Company->FldCaption() ?></td>
		<td<?php echo $banks_accounts->Company->CellAttributes() ?>><span id="el_Company">
<?php if ($banks_accounts->Company->getSessionValue() <> "") { ?>
<div<?php echo $banks_accounts->Company->ViewAttributes() ?>><?php echo $banks_accounts->Company->ViewValue ?></div>
<input type="hidden" id="x_Company" name="x_Company" value="<?php echo ew_HtmlEncode($banks_accounts->Company->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Company" name="x_Company" title="<?php echo $banks_accounts->Company->FldTitle() ?>"<?php echo $banks_accounts->Company->EditAttributes() ?>>
<?php
if (is_array($banks_accounts->Company->EditValue)) {
	$arwrk = $banks_accounts->Company->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($banks_accounts->Company->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $banks_accounts->Company->CustomMsg ?></td>
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
$banks_accounts_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanks_accounts_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'banks_accounts';

	// Page object name
	var $PageObjName = 'banks_accounts_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banks_accounts;
		if ($banks_accounts->UseTokenInUrl) $PageUrl .= "t=" . $banks_accounts->TableVar . "&"; // Add page token
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
		global $objForm, $banks_accounts;
		if ($banks_accounts->UseTokenInUrl) {
			if ($objForm)
				return ($banks_accounts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banks_accounts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanks_accounts_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (banks_accounts)
		$GLOBALS["banks_accounts"] = new cbanks_accounts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (company)
		$GLOBALS['company'] = new ccompany();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banks_accounts', TRUE);

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
		global $banks_accounts;

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
			$this->Page_Terminate("banks_accountslist.php");
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
		global $objForm, $Language, $gsFormError, $banks_accounts;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$banks_accounts->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$banks_accounts->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$banks_accounts->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$banks_accounts->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$banks_accounts->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($banks_accounts->id->CurrentValue == "")
			$this->Page_Terminate("banks_accountslist.php"); // Invalid key, return to list
		switch ($banks_accounts->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("banks_accountslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$banks_accounts->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $banks_accounts->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$banks_accounts->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$banks_accounts->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $banks_accounts;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $banks_accounts;
		$banks_accounts->id->setFormValue($objForm->GetValue("x_id"));
		$banks_accounts->Bank_Name->setFormValue($objForm->GetValue("x_Bank_Name"));
		$banks_accounts->Branch->setFormValue($objForm->GetValue("x_Branch"));
		$banks_accounts->Address->setFormValue($objForm->GetValue("x_Address"));
		$banks_accounts->Account_Name->setFormValue($objForm->GetValue("x_Account_Name"));
		$banks_accounts->Account_Number->setFormValue($objForm->GetValue("x_Account_Number"));
		$banks_accounts->Account_Type->setFormValue($objForm->GetValue("x_Account_Type"));
		$banks_accounts->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$banks_accounts->Company->setFormValue($objForm->GetValue("x_Company"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $banks_accounts;
		$this->LoadRow();
		$banks_accounts->id->CurrentValue = $banks_accounts->id->FormValue;
		$banks_accounts->Bank_Name->CurrentValue = $banks_accounts->Bank_Name->FormValue;
		$banks_accounts->Branch->CurrentValue = $banks_accounts->Branch->FormValue;
		$banks_accounts->Address->CurrentValue = $banks_accounts->Address->FormValue;
		$banks_accounts->Account_Name->CurrentValue = $banks_accounts->Account_Name->FormValue;
		$banks_accounts->Account_Number->CurrentValue = $banks_accounts->Account_Number->FormValue;
		$banks_accounts->Account_Type->CurrentValue = $banks_accounts->Account_Type->FormValue;
		$banks_accounts->Remarks->CurrentValue = $banks_accounts->Remarks->FormValue;
		$banks_accounts->Company->CurrentValue = $banks_accounts->Company->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banks_accounts;
		$sFilter = $banks_accounts->KeyFilter();

		// Call Row Selecting event
		$banks_accounts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banks_accounts->CurrentFilter = $sFilter;
		$sSql = $banks_accounts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$banks_accounts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $banks_accounts;
		$banks_accounts->id->setDbValue($rs->fields('id'));
		$banks_accounts->Bank_Name->setDbValue($rs->fields('Bank_Name'));
		$banks_accounts->Branch->setDbValue($rs->fields('Branch'));
		$banks_accounts->Address->setDbValue($rs->fields('Address'));
		$banks_accounts->Account_Name->setDbValue($rs->fields('Account_Name'));
		$banks_accounts->Account_Number->setDbValue($rs->fields('Account_Number'));
		$banks_accounts->Account_Type->setDbValue($rs->fields('Account_Type'));
		$banks_accounts->Remarks->setDbValue($rs->fields('Remarks'));
		$banks_accounts->Company->setDbValue($rs->fields('Company'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banks_accounts;

		// Initialize URLs
		// Call Row_Rendering event

		$banks_accounts->Row_Rendering();

		// Common render codes for all row types
		// id

		$banks_accounts->id->CellCssStyle = ""; $banks_accounts->id->CellCssClass = "";
		$banks_accounts->id->CellAttrs = array(); $banks_accounts->id->ViewAttrs = array(); $banks_accounts->id->EditAttrs = array();

		// Bank_Name
		$banks_accounts->Bank_Name->CellCssStyle = ""; $banks_accounts->Bank_Name->CellCssClass = "";
		$banks_accounts->Bank_Name->CellAttrs = array(); $banks_accounts->Bank_Name->ViewAttrs = array(); $banks_accounts->Bank_Name->EditAttrs = array();

		// Branch
		$banks_accounts->Branch->CellCssStyle = ""; $banks_accounts->Branch->CellCssClass = "";
		$banks_accounts->Branch->CellAttrs = array(); $banks_accounts->Branch->ViewAttrs = array(); $banks_accounts->Branch->EditAttrs = array();

		// Address
		$banks_accounts->Address->CellCssStyle = ""; $banks_accounts->Address->CellCssClass = "";
		$banks_accounts->Address->CellAttrs = array(); $banks_accounts->Address->ViewAttrs = array(); $banks_accounts->Address->EditAttrs = array();

		// Account_Name
		$banks_accounts->Account_Name->CellCssStyle = ""; $banks_accounts->Account_Name->CellCssClass = "";
		$banks_accounts->Account_Name->CellAttrs = array(); $banks_accounts->Account_Name->ViewAttrs = array(); $banks_accounts->Account_Name->EditAttrs = array();

		// Account_Number
		$banks_accounts->Account_Number->CellCssStyle = ""; $banks_accounts->Account_Number->CellCssClass = "";
		$banks_accounts->Account_Number->CellAttrs = array(); $banks_accounts->Account_Number->ViewAttrs = array(); $banks_accounts->Account_Number->EditAttrs = array();

		// Account_Type
		$banks_accounts->Account_Type->CellCssStyle = ""; $banks_accounts->Account_Type->CellCssClass = "";
		$banks_accounts->Account_Type->CellAttrs = array(); $banks_accounts->Account_Type->ViewAttrs = array(); $banks_accounts->Account_Type->EditAttrs = array();

		// Remarks
		$banks_accounts->Remarks->CellCssStyle = ""; $banks_accounts->Remarks->CellCssClass = "";
		$banks_accounts->Remarks->CellAttrs = array(); $banks_accounts->Remarks->ViewAttrs = array(); $banks_accounts->Remarks->EditAttrs = array();

		// Company
		$banks_accounts->Company->CellCssStyle = ""; $banks_accounts->Company->CellCssClass = "";
		$banks_accounts->Company->CellAttrs = array(); $banks_accounts->Company->ViewAttrs = array(); $banks_accounts->Company->EditAttrs = array();
		if ($banks_accounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$banks_accounts->id->ViewValue = $banks_accounts->id->CurrentValue;
			$banks_accounts->id->CssStyle = "";
			$banks_accounts->id->CssClass = "";
			$banks_accounts->id->ViewCustomAttributes = "";

			// Bank_Name
			$banks_accounts->Bank_Name->ViewValue = $banks_accounts->Bank_Name->CurrentValue;
			$banks_accounts->Bank_Name->CssStyle = "";
			$banks_accounts->Bank_Name->CssClass = "";
			$banks_accounts->Bank_Name->ViewCustomAttributes = "";

			// Branch
			$banks_accounts->Branch->ViewValue = $banks_accounts->Branch->CurrentValue;
			$banks_accounts->Branch->CssStyle = "";
			$banks_accounts->Branch->CssClass = "";
			$banks_accounts->Branch->ViewCustomAttributes = "";

			// Address
			$banks_accounts->Address->ViewValue = $banks_accounts->Address->CurrentValue;
			$banks_accounts->Address->CssStyle = "";
			$banks_accounts->Address->CssClass = "";
			$banks_accounts->Address->ViewCustomAttributes = "";

			// Account_Name
			$banks_accounts->Account_Name->ViewValue = $banks_accounts->Account_Name->CurrentValue;
			$banks_accounts->Account_Name->CssStyle = "";
			$banks_accounts->Account_Name->CssClass = "";
			$banks_accounts->Account_Name->ViewCustomAttributes = "";

			// Account_Number
			$banks_accounts->Account_Number->ViewValue = $banks_accounts->Account_Number->CurrentValue;
			$banks_accounts->Account_Number->CssStyle = "";
			$banks_accounts->Account_Number->CssClass = "";
			$banks_accounts->Account_Number->ViewCustomAttributes = "";

			// Account_Type
			$banks_accounts->Account_Type->ViewValue = $banks_accounts->Account_Type->CurrentValue;
			$banks_accounts->Account_Type->CssStyle = "";
			$banks_accounts->Account_Type->CssClass = "";
			$banks_accounts->Account_Type->ViewCustomAttributes = "";

			// Remarks
			$banks_accounts->Remarks->ViewValue = $banks_accounts->Remarks->CurrentValue;
			$banks_accounts->Remarks->CssStyle = "";
			$banks_accounts->Remarks->CssClass = "";
			$banks_accounts->Remarks->ViewCustomAttributes = "";

			// Company
			if (strval($banks_accounts->Company->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($banks_accounts->Company->CurrentValue) . "";
			$sSqlWrk = "SELECT `Company_Name` FROM `company`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Company_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banks_accounts->Company->ViewValue = $rswrk->fields('Company_Name');
					$rswrk->Close();
				} else {
					$banks_accounts->Company->ViewValue = $banks_accounts->Company->CurrentValue;
				}
			} else {
				$banks_accounts->Company->ViewValue = NULL;
			}
			$banks_accounts->Company->CssStyle = "";
			$banks_accounts->Company->CssClass = "";
			$banks_accounts->Company->ViewCustomAttributes = "";

			// id
			$banks_accounts->id->HrefValue = "";
			$banks_accounts->id->TooltipValue = "";

			// Bank_Name
			$banks_accounts->Bank_Name->HrefValue = "";
			$banks_accounts->Bank_Name->TooltipValue = "";

			// Branch
			$banks_accounts->Branch->HrefValue = "";
			$banks_accounts->Branch->TooltipValue = "";

			// Address
			$banks_accounts->Address->HrefValue = "";
			$banks_accounts->Address->TooltipValue = "";

			// Account_Name
			$banks_accounts->Account_Name->HrefValue = "";
			$banks_accounts->Account_Name->TooltipValue = "";

			// Account_Number
			$banks_accounts->Account_Number->HrefValue = "";
			$banks_accounts->Account_Number->TooltipValue = "";

			// Account_Type
			$banks_accounts->Account_Type->HrefValue = "";
			$banks_accounts->Account_Type->TooltipValue = "";

			// Remarks
			$banks_accounts->Remarks->HrefValue = "";
			$banks_accounts->Remarks->TooltipValue = "";

			// Company
			$banks_accounts->Company->HrefValue = "";
			$banks_accounts->Company->TooltipValue = "";
		} elseif ($banks_accounts->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$banks_accounts->id->EditCustomAttributes = "";
			$banks_accounts->id->EditValue = $banks_accounts->id->CurrentValue;
			$banks_accounts->id->CssStyle = "";
			$banks_accounts->id->CssClass = "";
			$banks_accounts->id->ViewCustomAttributes = "";

			// Bank_Name
			$banks_accounts->Bank_Name->EditCustomAttributes = "";
			$banks_accounts->Bank_Name->EditValue = ew_HtmlEncode($banks_accounts->Bank_Name->CurrentValue);

			// Branch
			$banks_accounts->Branch->EditCustomAttributes = "";
			$banks_accounts->Branch->EditValue = ew_HtmlEncode($banks_accounts->Branch->CurrentValue);

			// Address
			$banks_accounts->Address->EditCustomAttributes = "";
			$banks_accounts->Address->EditValue = ew_HtmlEncode($banks_accounts->Address->CurrentValue);

			// Account_Name
			$banks_accounts->Account_Name->EditCustomAttributes = "";
			$banks_accounts->Account_Name->EditValue = ew_HtmlEncode($banks_accounts->Account_Name->CurrentValue);

			// Account_Number
			$banks_accounts->Account_Number->EditCustomAttributes = "";
			$banks_accounts->Account_Number->EditValue = ew_HtmlEncode($banks_accounts->Account_Number->CurrentValue);

			// Account_Type
			$banks_accounts->Account_Type->EditCustomAttributes = "";
			$banks_accounts->Account_Type->EditValue = ew_HtmlEncode($banks_accounts->Account_Type->CurrentValue);

			// Remarks
			$banks_accounts->Remarks->EditCustomAttributes = "";
			$banks_accounts->Remarks->EditValue = ew_HtmlEncode($banks_accounts->Remarks->CurrentValue);

			// Company
			$banks_accounts->Company->EditCustomAttributes = "";
			if ($banks_accounts->Company->getSessionValue() <> "") {
				$banks_accounts->Company->CurrentValue = $banks_accounts->Company->getSessionValue();
			if (strval($banks_accounts->Company->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($banks_accounts->Company->CurrentValue) . "";
			$sSqlWrk = "SELECT `Company_Name` FROM `company`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Company_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banks_accounts->Company->ViewValue = $rswrk->fields('Company_Name');
					$rswrk->Close();
				} else {
					$banks_accounts->Company->ViewValue = $banks_accounts->Company->CurrentValue;
				}
			} else {
				$banks_accounts->Company->ViewValue = NULL;
			}
			$banks_accounts->Company->CssStyle = "";
			$banks_accounts->Company->CssClass = "";
			$banks_accounts->Company->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Company_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `company`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Company_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$banks_accounts->Company->EditValue = $arwrk;
			}

			// Edit refer script
			// id

			$banks_accounts->id->HrefValue = "";

			// Bank_Name
			$banks_accounts->Bank_Name->HrefValue = "";

			// Branch
			$banks_accounts->Branch->HrefValue = "";

			// Address
			$banks_accounts->Address->HrefValue = "";

			// Account_Name
			$banks_accounts->Account_Name->HrefValue = "";

			// Account_Number
			$banks_accounts->Account_Number->HrefValue = "";

			// Account_Type
			$banks_accounts->Account_Type->HrefValue = "";

			// Remarks
			$banks_accounts->Remarks->HrefValue = "";

			// Company
			$banks_accounts->Company->HrefValue = "";
		}

		// Call Row Rendered event
		if ($banks_accounts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banks_accounts->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $banks_accounts;

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
		global $conn, $Security, $Language, $banks_accounts;
		$sFilter = $banks_accounts->KeyFilter();
		$banks_accounts->CurrentFilter = $sFilter;
		$sSql = $banks_accounts->SQL();
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

			// Bank_Name
			$banks_accounts->Bank_Name->SetDbValueDef($rsnew, $banks_accounts->Bank_Name->CurrentValue, NULL, FALSE);

			// Branch
			$banks_accounts->Branch->SetDbValueDef($rsnew, $banks_accounts->Branch->CurrentValue, NULL, FALSE);

			// Address
			$banks_accounts->Address->SetDbValueDef($rsnew, $banks_accounts->Address->CurrentValue, NULL, FALSE);

			// Account_Name
			$banks_accounts->Account_Name->SetDbValueDef($rsnew, $banks_accounts->Account_Name->CurrentValue, NULL, FALSE);

			// Account_Number
			$banks_accounts->Account_Number->SetDbValueDef($rsnew, $banks_accounts->Account_Number->CurrentValue, NULL, FALSE);

			// Account_Type
			$banks_accounts->Account_Type->SetDbValueDef($rsnew, $banks_accounts->Account_Type->CurrentValue, NULL, FALSE);

			// Remarks
			$banks_accounts->Remarks->SetDbValueDef($rsnew, $banks_accounts->Remarks->CurrentValue, NULL, FALSE);

			// Company
			$banks_accounts->Company->SetDbValueDef($rsnew, $banks_accounts->Company->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $banks_accounts->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($banks_accounts->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($banks_accounts->CancelMessage <> "") {
					$this->setMessage($banks_accounts->CancelMessage);
					$banks_accounts->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$banks_accounts->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $banks_accounts;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "company") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $banks_accounts->SqlMasterFilter_company();
				$this->sDbDetailFilter = $banks_accounts->SqlDetailFilter_company();
				if (@$_GET["id"] <> "") {
					$GLOBALS["company"]->id->setQueryStringValue($_GET["id"]);
					$banks_accounts->Company->setQueryStringValue($GLOBALS["company"]->id->QueryStringValue);
					$banks_accounts->Company->setSessionValue($banks_accounts->Company->QueryStringValue);
					if (!is_numeric($GLOBALS["company"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["company"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Company@", ew_AdjustSql($GLOBALS["company"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$banks_accounts->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$banks_accounts->setStartRecordNumber($this->lStartRec);
			$banks_accounts->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$banks_accounts->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "company") {
				if ($banks_accounts->Company->QueryStringValue == "") $banks_accounts->Company->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $banks_accounts->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $banks_accounts->getDetailFilter(); // Restore detail filter
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
