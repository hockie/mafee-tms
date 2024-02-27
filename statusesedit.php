<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "statusesinfo.php" ?>
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
$statuses_edit = new cstatuses_edit();
$Page =& $statuses_edit;

// Page init
$statuses_edit->Page_Init();

// Page main
$statuses_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var statuses_edit = new ew_Page("statuses_edit");

// page properties
statuses_edit.PageID = "edit"; // page ID
statuses_edit.FormID = "fstatusesedit"; // form ID
var EW_PAGE_ID = statuses_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
statuses_edit.ValidateForm = function(fobj) {
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
statuses_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
statuses_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
statuses_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
statuses_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $statuses->TableCaption() ?><br><br>
<a href="<?php echo $statuses->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$statuses_edit->ShowMessage();
?>
<form name="fstatusesedit" id="fstatusesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return statuses_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="statuses">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($statuses->id->Visible) { // id ?>
	<tr<?php echo $statuses->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $statuses->id->FldCaption() ?></td>
		<td<?php echo $statuses->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $statuses->id->ViewAttributes() ?>><?php echo $statuses->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($statuses->id->CurrentValue) ?>">
</span><?php echo $statuses->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($statuses->Status->Visible) { // Status ?>
	<tr<?php echo $statuses->Status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $statuses->Status->FldCaption() ?></td>
		<td<?php echo $statuses->Status->CellAttributes() ?>><span id="el_Status">
<input type="text" name="x_Status" id="x_Status" title="<?php echo $statuses->Status->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $statuses->Status->EditValue ?>"<?php echo $statuses->Status->EditAttributes() ?>>
</span><?php echo $statuses->Status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($statuses->Modules->Visible) { // Modules ?>
	<tr<?php echo $statuses->Modules->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $statuses->Modules->FldCaption() ?></td>
		<td<?php echo $statuses->Modules->CellAttributes() ?>><span id="el_Modules">
<input type="text" name="x_Modules" id="x_Modules" title="<?php echo $statuses->Modules->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $statuses->Modules->EditValue ?>"<?php echo $statuses->Modules->EditAttributes() ?>>
</span><?php echo $statuses->Modules->CustomMsg ?></td>
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
$statuses_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cstatuses_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'statuses';

	// Page object name
	var $PageObjName = 'statuses_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $statuses;
		if ($statuses->UseTokenInUrl) $PageUrl .= "t=" . $statuses->TableVar . "&"; // Add page token
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
		global $objForm, $statuses;
		if ($statuses->UseTokenInUrl) {
			if ($objForm)
				return ($statuses->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($statuses->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstatuses_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (statuses)
		$GLOBALS["statuses"] = new cstatuses();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'statuses', TRUE);

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
		global $statuses;

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
			$this->Page_Terminate("statuseslist.php");
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
		global $objForm, $Language, $gsFormError, $statuses;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$statuses->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$statuses->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$statuses->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$statuses->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$statuses->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($statuses->id->CurrentValue == "")
			$this->Page_Terminate("statuseslist.php"); // Invalid key, return to list
		switch ($statuses->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("statuseslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$statuses->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $statuses->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$statuses->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$statuses->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $statuses;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $statuses;
		$statuses->id->setFormValue($objForm->GetValue("x_id"));
		$statuses->Status->setFormValue($objForm->GetValue("x_Status"));
		$statuses->Modules->setFormValue($objForm->GetValue("x_Modules"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $statuses;
		$this->LoadRow();
		$statuses->id->CurrentValue = $statuses->id->FormValue;
		$statuses->Status->CurrentValue = $statuses->Status->FormValue;
		$statuses->Modules->CurrentValue = $statuses->Modules->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $statuses;
		$sFilter = $statuses->KeyFilter();

		// Call Row Selecting event
		$statuses->Row_Selecting($sFilter);

		// Load SQL based on filter
		$statuses->CurrentFilter = $sFilter;
		$sSql = $statuses->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$statuses->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $statuses;
		$statuses->id->setDbValue($rs->fields('id'));
		$statuses->Status->setDbValue($rs->fields('Status'));
		$statuses->Modules->setDbValue($rs->fields('Modules'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $statuses;

		// Initialize URLs
		// Call Row_Rendering event

		$statuses->Row_Rendering();

		// Common render codes for all row types
		// id

		$statuses->id->CellCssStyle = ""; $statuses->id->CellCssClass = "";
		$statuses->id->CellAttrs = array(); $statuses->id->ViewAttrs = array(); $statuses->id->EditAttrs = array();

		// Status
		$statuses->Status->CellCssStyle = ""; $statuses->Status->CellCssClass = "";
		$statuses->Status->CellAttrs = array(); $statuses->Status->ViewAttrs = array(); $statuses->Status->EditAttrs = array();

		// Modules
		$statuses->Modules->CellCssStyle = ""; $statuses->Modules->CellCssClass = "";
		$statuses->Modules->CellAttrs = array(); $statuses->Modules->ViewAttrs = array(); $statuses->Modules->EditAttrs = array();
		if ($statuses->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$statuses->id->ViewValue = $statuses->id->CurrentValue;
			$statuses->id->CssStyle = "";
			$statuses->id->CssClass = "";
			$statuses->id->ViewCustomAttributes = "";

			// Status
			$statuses->Status->ViewValue = $statuses->Status->CurrentValue;
			$statuses->Status->CssStyle = "";
			$statuses->Status->CssClass = "";
			$statuses->Status->ViewCustomAttributes = "";

			// Modules
			$statuses->Modules->ViewValue = $statuses->Modules->CurrentValue;
			$statuses->Modules->CssStyle = "";
			$statuses->Modules->CssClass = "";
			$statuses->Modules->ViewCustomAttributes = "";

			// id
			$statuses->id->HrefValue = "";
			$statuses->id->TooltipValue = "";

			// Status
			$statuses->Status->HrefValue = "";
			$statuses->Status->TooltipValue = "";

			// Modules
			$statuses->Modules->HrefValue = "";
			$statuses->Modules->TooltipValue = "";
		} elseif ($statuses->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$statuses->id->EditCustomAttributes = "";
			$statuses->id->EditValue = $statuses->id->CurrentValue;
			$statuses->id->CssStyle = "";
			$statuses->id->CssClass = "";
			$statuses->id->ViewCustomAttributes = "";

			// Status
			$statuses->Status->EditCustomAttributes = "";
			$statuses->Status->EditValue = ew_HtmlEncode($statuses->Status->CurrentValue);

			// Modules
			$statuses->Modules->EditCustomAttributes = "";
			$statuses->Modules->EditValue = ew_HtmlEncode($statuses->Modules->CurrentValue);

			// Edit refer script
			// id

			$statuses->id->HrefValue = "";

			// Status
			$statuses->Status->HrefValue = "";

			// Modules
			$statuses->Modules->HrefValue = "";
		}

		// Call Row Rendered event
		if ($statuses->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$statuses->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $statuses;

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
		global $conn, $Security, $Language, $statuses;
		$sFilter = $statuses->KeyFilter();
		$statuses->CurrentFilter = $sFilter;
		$sSql = $statuses->SQL();
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

			// Status
			$statuses->Status->SetDbValueDef($rsnew, $statuses->Status->CurrentValue, NULL, FALSE);

			// Modules
			$statuses->Modules->SetDbValueDef($rsnew, $statuses->Modules->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $statuses->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($statuses->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($statuses->CancelMessage <> "") {
					$this->setMessage($statuses->CancelMessage);
					$statuses->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$statuses->Row_Updated($rsold, $rsnew);
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
