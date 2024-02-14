<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "areasinfo.php" ?>
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
$areas_edit = new careas_edit();
$Page =& $areas_edit;

// Page init
$areas_edit->Page_Init();

// Page main
$areas_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var areas_edit = new ew_Page("areas_edit");

// page properties
areas_edit.PageID = "edit"; // page ID
areas_edit.FormID = "fareasedit"; // form ID
var EW_PAGE_ID = areas_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
areas_edit.ValidateForm = function(fobj) {
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
areas_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
areas_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
areas_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $areas->TableCaption() ?><br><br>
<a href="<?php echo $areas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$areas_edit->ShowMessage();
?>
<form name="fareasedit" id="fareasedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return areas_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="areas">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($areas->id->Visible) { // id ?>
	<tr<?php echo $areas->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $areas->id->FldCaption() ?></td>
		<td<?php echo $areas->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $areas->id->ViewAttributes() ?>><?php echo $areas->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($areas->id->CurrentValue) ?>">
</span><?php echo $areas->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($areas->Area->Visible) { // Area ?>
	<tr<?php echo $areas->Area->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $areas->Area->FldCaption() ?></td>
		<td<?php echo $areas->Area->CellAttributes() ?>><span id="el_Area">
<input type="text" name="x_Area" id="x_Area" title="<?php echo $areas->Area->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $areas->Area->EditValue ?>"<?php echo $areas->Area->EditAttributes() ?>>
</span><?php echo $areas->Area->CustomMsg ?></td>
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
$areas_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class careas_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'areas';

	// Page object name
	var $PageObjName = 'areas_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $areas;
		if ($areas->UseTokenInUrl) $PageUrl .= "t=" . $areas->TableVar . "&"; // Add page token
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
		global $objForm, $areas;
		if ($areas->UseTokenInUrl) {
			if ($objForm)
				return ($areas->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($areas->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function careas_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (areas)
		$GLOBALS["areas"] = new careas();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'areas', TRUE);

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
		global $areas;

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
			$this->Page_Terminate("areaslist.php");
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
		global $objForm, $Language, $gsFormError, $areas;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$areas->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$areas->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$areas->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$areas->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$areas->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($areas->id->CurrentValue == "")
			$this->Page_Terminate("areaslist.php"); // Invalid key, return to list
		switch ($areas->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("areaslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$areas->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $areas->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$areas->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$areas->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $areas;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $areas;
		$areas->id->setFormValue($objForm->GetValue("x_id"));
		$areas->Area->setFormValue($objForm->GetValue("x_Area"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $areas;
		$this->LoadRow();
		$areas->id->CurrentValue = $areas->id->FormValue;
		$areas->Area->CurrentValue = $areas->Area->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $areas;
		$sFilter = $areas->KeyFilter();

		// Call Row Selecting event
		$areas->Row_Selecting($sFilter);

		// Load SQL based on filter
		$areas->CurrentFilter = $sFilter;
		$sSql = $areas->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$areas->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $areas;
		$areas->id->setDbValue($rs->fields('id'));
		$areas->Area->setDbValue($rs->fields('Area'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $areas;

		// Initialize URLs
		// Call Row_Rendering event

		$areas->Row_Rendering();

		// Common render codes for all row types
		// id

		$areas->id->CellCssStyle = ""; $areas->id->CellCssClass = "";
		$areas->id->CellAttrs = array(); $areas->id->ViewAttrs = array(); $areas->id->EditAttrs = array();

		// Area
		$areas->Area->CellCssStyle = ""; $areas->Area->CellCssClass = "";
		$areas->Area->CellAttrs = array(); $areas->Area->ViewAttrs = array(); $areas->Area->EditAttrs = array();
		if ($areas->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$areas->id->ViewValue = $areas->id->CurrentValue;
			$areas->id->CssStyle = "";
			$areas->id->CssClass = "";
			$areas->id->ViewCustomAttributes = "";

			// Area
			$areas->Area->ViewValue = $areas->Area->CurrentValue;
			$areas->Area->CssStyle = "";
			$areas->Area->CssClass = "";
			$areas->Area->ViewCustomAttributes = "";

			// id
			$areas->id->HrefValue = "";
			$areas->id->TooltipValue = "";

			// Area
			$areas->Area->HrefValue = "";
			$areas->Area->TooltipValue = "";
		} elseif ($areas->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$areas->id->EditCustomAttributes = "";
			$areas->id->EditValue = $areas->id->CurrentValue;
			$areas->id->CssStyle = "";
			$areas->id->CssClass = "";
			$areas->id->ViewCustomAttributes = "";

			// Area
			$areas->Area->EditCustomAttributes = "";
			$areas->Area->EditValue = ew_HtmlEncode($areas->Area->CurrentValue);

			// Edit refer script
			// id

			$areas->id->HrefValue = "";

			// Area
			$areas->Area->HrefValue = "";
		}

		// Call Row Rendered event
		if ($areas->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$areas->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $areas;

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
		global $conn, $Security, $Language, $areas;
		$sFilter = $areas->KeyFilter();
		$areas->CurrentFilter = $sFilter;
		$sSql = $areas->SQL();
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

			// Area
			$areas->Area->SetDbValueDef($rsnew, $areas->Area->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $areas->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($areas->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($areas->CancelMessage <> "") {
					$this->setMessage($areas->CancelMessage);
					$areas->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$areas->Row_Updated($rsold, $rsnew);
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
