<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "truck_typesinfo.php" ?>
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
$truck_types_edit = new ctruck_types_edit();
$Page =& $truck_types_edit;

// Page init
$truck_types_edit->Page_Init();

// Page main
$truck_types_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var truck_types_edit = new ew_Page("truck_types_edit");

// page properties
truck_types_edit.PageID = "edit"; // page ID
truck_types_edit.FormID = "ftruck_typesedit"; // form ID
var EW_PAGE_ID = truck_types_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
truck_types_edit.ValidateForm = function(fobj) {
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
truck_types_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
truck_types_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
truck_types_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $truck_types->TableCaption() ?><br><br>
<a href="<?php echo $truck_types->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$truck_types_edit->ShowMessage();
?>
<form name="ftruck_typesedit" id="ftruck_typesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return truck_types_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="truck_types">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($truck_types->id->Visible) { // id ?>
	<tr<?php echo $truck_types->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_types->id->FldCaption() ?></td>
		<td<?php echo $truck_types->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $truck_types->id->ViewAttributes() ?>><?php echo $truck_types->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($truck_types->id->CurrentValue) ?>">
</span><?php echo $truck_types->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_types->Truck_Type->Visible) { // Truck_Type ?>
	<tr<?php echo $truck_types->Truck_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_types->Truck_Type->FldCaption() ?></td>
		<td<?php echo $truck_types->Truck_Type->CellAttributes() ?>><span id="el_Truck_Type">
<input type="text" name="x_Truck_Type" id="x_Truck_Type" title="<?php echo $truck_types->Truck_Type->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $truck_types->Truck_Type->EditValue ?>"<?php echo $truck_types->Truck_Type->EditAttributes() ?>>
</span><?php echo $truck_types->Truck_Type->CustomMsg ?></td>
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
$truck_types_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctruck_types_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'truck_types';

	// Page object name
	var $PageObjName = 'truck_types_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $truck_types;
		if ($truck_types->UseTokenInUrl) $PageUrl .= "t=" . $truck_types->TableVar . "&"; // Add page token
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
		global $objForm, $truck_types;
		if ($truck_types->UseTokenInUrl) {
			if ($objForm)
				return ($truck_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($truck_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctruck_types_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (truck_types)
		$GLOBALS["truck_types"] = new ctruck_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'truck_types', TRUE);

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
		global $truck_types;

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
			$this->Page_Terminate("truck_typeslist.php");
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
		global $objForm, $Language, $gsFormError, $truck_types;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$truck_types->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$truck_types->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$truck_types->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$truck_types->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$truck_types->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($truck_types->id->CurrentValue == "")
			$this->Page_Terminate("truck_typeslist.php"); // Invalid key, return to list
		switch ($truck_types->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("truck_typeslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$truck_types->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $truck_types->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$truck_types->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$truck_types->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $truck_types;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $truck_types;
		$truck_types->id->setFormValue($objForm->GetValue("x_id"));
		$truck_types->Truck_Type->setFormValue($objForm->GetValue("x_Truck_Type"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $truck_types;
		$this->LoadRow();
		$truck_types->id->CurrentValue = $truck_types->id->FormValue;
		$truck_types->Truck_Type->CurrentValue = $truck_types->Truck_Type->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $truck_types;
		$sFilter = $truck_types->KeyFilter();

		// Call Row Selecting event
		$truck_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$truck_types->CurrentFilter = $sFilter;
		$sSql = $truck_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$truck_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $truck_types;
		$truck_types->id->setDbValue($rs->fields('id'));
		$truck_types->Truck_Type->setDbValue($rs->fields('Truck_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $truck_types;

		// Initialize URLs
		// Call Row_Rendering event

		$truck_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$truck_types->id->CellCssStyle = ""; $truck_types->id->CellCssClass = "";
		$truck_types->id->CellAttrs = array(); $truck_types->id->ViewAttrs = array(); $truck_types->id->EditAttrs = array();

		// Truck_Type
		$truck_types->Truck_Type->CellCssStyle = ""; $truck_types->Truck_Type->CellCssClass = "";
		$truck_types->Truck_Type->CellAttrs = array(); $truck_types->Truck_Type->ViewAttrs = array(); $truck_types->Truck_Type->EditAttrs = array();
		if ($truck_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$truck_types->id->ViewValue = $truck_types->id->CurrentValue;
			$truck_types->id->CssStyle = "";
			$truck_types->id->CssClass = "";
			$truck_types->id->ViewCustomAttributes = "";

			// Truck_Type
			$truck_types->Truck_Type->ViewValue = $truck_types->Truck_Type->CurrentValue;
			$truck_types->Truck_Type->CssStyle = "";
			$truck_types->Truck_Type->CssClass = "";
			$truck_types->Truck_Type->ViewCustomAttributes = "";

			// id
			$truck_types->id->HrefValue = "";
			$truck_types->id->TooltipValue = "";

			// Truck_Type
			$truck_types->Truck_Type->HrefValue = "";
			$truck_types->Truck_Type->TooltipValue = "";
		} elseif ($truck_types->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$truck_types->id->EditCustomAttributes = "";
			$truck_types->id->EditValue = $truck_types->id->CurrentValue;
			$truck_types->id->CssStyle = "";
			$truck_types->id->CssClass = "";
			$truck_types->id->ViewCustomAttributes = "";

			// Truck_Type
			$truck_types->Truck_Type->EditCustomAttributes = "";
			$truck_types->Truck_Type->EditValue = ew_HtmlEncode($truck_types->Truck_Type->CurrentValue);

			// Edit refer script
			// id

			$truck_types->id->HrefValue = "";

			// Truck_Type
			$truck_types->Truck_Type->HrefValue = "";
		}

		// Call Row Rendered event
		if ($truck_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$truck_types->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $truck_types;

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
		global $conn, $Security, $Language, $truck_types;
		$sFilter = $truck_types->KeyFilter();
		$truck_types->CurrentFilter = $sFilter;
		$sSql = $truck_types->SQL();
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

			// Truck_Type
			$truck_types->Truck_Type->SetDbValueDef($rsnew, $truck_types->Truck_Type->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $truck_types->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($truck_types->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($truck_types->CancelMessage <> "") {
					$this->setMessage($truck_types->CancelMessage);
					$truck_types->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$truck_types->Row_Updated($rsold, $rsnew);
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
