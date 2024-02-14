<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_typesinfo.php" ?>
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
$file_types_addopt = new cfile_types_addopt();
$Page =& $file_types_addopt;

// Page init
$file_types_addopt->Page_Init();

// Page main
$file_types_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var file_types_addopt = new ew_Page("file_types_addopt");

// page properties
file_types_addopt.PageID = "addopt"; // page ID
file_types_addopt.FormID = "ffile_typesaddopt"; // form ID
var EW_PAGE_ID = file_types_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
file_types_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_types_addopt->ShowMessage();
?>
<form name="ffile_typesaddopt" id="ffile_typesaddopt" action="file_typesaddopt.php" method="post" onsubmit="return file_types_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="file_types">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td><?php echo $file_types->File_Type->FldCaption() ?></td>
		<td><span id="el_File_Type">
<input type="text" name="x_File_Type" id="x_File_Type" title="<?php echo $file_types->File_Type->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $file_types->File_Type->EditValue ?>"<?php echo $file_types->File_Type->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
</form>
<?php
$file_types_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_types_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'file_types';

	// Page object name
	var $PageObjName = 'file_types_addopt';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_types;
		if ($file_types->UseTokenInUrl) $PageUrl .= "t=" . $file_types->TableVar . "&"; // Add page token
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
		global $objForm, $file_types;
		if ($file_types->UseTokenInUrl) {
			if ($objForm)
				return ($file_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_types_addopt() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_types)
		$GLOBALS["file_types"] = new cfile_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_types', TRUE);

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
		global $file_types;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("file_typeslist.php");
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $file_types;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$file_types->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$file_types->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$file_types->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($file_types->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$file_types->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_id", strval($file_types->id->DbValue));
					$XMLDoc->AddField("x_File_Type", strval($file_types->File_Type->FormValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$file_types->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $file_types;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $file_types;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $file_types;
		$file_types->File_Type->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_File_Type")));
		$file_types->id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_id")));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $file_types;
		$file_types->id->CurrentValue = ew_ConvertToUtf8($file_types->id->FormValue);
		$file_types->File_Type->CurrentValue = ew_ConvertToUtf8($file_types->File_Type->FormValue);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_types;
		$sFilter = $file_types->KeyFilter();

		// Call Row Selecting event
		$file_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_types->CurrentFilter = $sFilter;
		$sSql = $file_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_types;
		$file_types->id->setDbValue($rs->fields('id'));
		$file_types->File_Type->setDbValue($rs->fields('File_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_types;

		// Initialize URLs
		// Call Row_Rendering event

		$file_types->Row_Rendering();

		// Common render codes for all row types
		// File_Type

		$file_types->File_Type->CellCssStyle = ""; $file_types->File_Type->CellCssClass = "";
		$file_types->File_Type->CellAttrs = array(); $file_types->File_Type->ViewAttrs = array(); $file_types->File_Type->EditAttrs = array();
		if ($file_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_types->id->ViewValue = $file_types->id->CurrentValue;
			$file_types->id->CssStyle = "";
			$file_types->id->CssClass = "";
			$file_types->id->ViewCustomAttributes = "";

			// File_Type
			$file_types->File_Type->ViewValue = $file_types->File_Type->CurrentValue;
			$file_types->File_Type->CssStyle = "";
			$file_types->File_Type->CssClass = "";
			$file_types->File_Type->ViewCustomAttributes = "";

			// File_Type
			$file_types->File_Type->HrefValue = "";
			$file_types->File_Type->TooltipValue = "";
		} elseif ($file_types->RowType == EW_ROWTYPE_ADD) { // Add row

			// File_Type
			$file_types->File_Type->EditCustomAttributes = "";
			$file_types->File_Type->EditValue = ew_HtmlEncode($file_types->File_Type->CurrentValue);
		}

		// Call Row Rendered event
		if ($file_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_types->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $file_types;

		// Initialize form error message
		$gsFormError = "";

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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $file_types;
		$rsnew = array();

		// File_Type
		$file_types->File_Type->SetDbValueDef($rsnew, $file_types->File_Type->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $file_types->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($file_types->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($file_types->CancelMessage <> "") {
				$this->setMessage($file_types->CancelMessage);
				$file_types->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$file_types->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $file_types->id->DbValue;

			// Call Row Inserted event
			$file_types->Row_Inserted($rsnew);
		}
		return $AddRow;
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

	// Custom validate event
	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
