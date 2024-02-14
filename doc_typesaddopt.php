<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "doc_typesinfo.php" ?>
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
$doc_types_addopt = new cdoc_types_addopt();
$Page =& $doc_types_addopt;

// Page init
$doc_types_addopt->Page_Init();

// Page main
$doc_types_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var doc_types_addopt = new ew_Page("doc_types_addopt");

// page properties
doc_types_addopt.PageID = "addopt"; // page ID
doc_types_addopt.FormID = "fdoc_typesaddopt"; // form ID
var EW_PAGE_ID = doc_types_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
doc_types_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$doc_types_addopt->ShowMessage();
?>
<form name="fdoc_typesaddopt" id="fdoc_typesaddopt" action="doc_typesaddopt.php" method="post" onsubmit="return doc_types_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="doc_types">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td><?php echo $doc_types->Doc_Type->FldCaption() ?></td>
		<td><span id="el_Doc_Type">
<input type="text" name="x_Doc_Type" id="x_Doc_Type" title="<?php echo $doc_types->Doc_Type->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $doc_types->Doc_Type->EditValue ?>"<?php echo $doc_types->Doc_Type->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
</form>
<?php
$doc_types_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class cdoc_types_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'doc_types';

	// Page object name
	var $PageObjName = 'doc_types_addopt';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $doc_types;
		if ($doc_types->UseTokenInUrl) $PageUrl .= "t=" . $doc_types->TableVar . "&"; // Add page token
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
		global $objForm, $doc_types;
		if ($doc_types->UseTokenInUrl) {
			if ($objForm)
				return ($doc_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($doc_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdoc_types_addopt() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (doc_types)
		$GLOBALS["doc_types"] = new cdoc_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'doc_types', TRUE);

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
		global $doc_types;

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
			$this->Page_Terminate("doc_typeslist.php");
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
		global $objForm, $Language, $gsFormError, $doc_types;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$doc_types->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$doc_types->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$doc_types->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($doc_types->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$doc_types->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_id", strval($doc_types->id->DbValue));
					$XMLDoc->AddField("x_Doc_Type", strval($doc_types->Doc_Type->FormValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$doc_types->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $doc_types;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $doc_types;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $doc_types;
		$doc_types->Doc_Type->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Doc_Type")));
		$doc_types->id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_id")));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $doc_types;
		$doc_types->id->CurrentValue = ew_ConvertToUtf8($doc_types->id->FormValue);
		$doc_types->Doc_Type->CurrentValue = ew_ConvertToUtf8($doc_types->Doc_Type->FormValue);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $doc_types;
		$sFilter = $doc_types->KeyFilter();

		// Call Row Selecting event
		$doc_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$doc_types->CurrentFilter = $sFilter;
		$sSql = $doc_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$doc_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $doc_types;
		$doc_types->id->setDbValue($rs->fields('id'));
		$doc_types->Doc_Type->setDbValue($rs->fields('Doc_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $doc_types;

		// Initialize URLs
		// Call Row_Rendering event

		$doc_types->Row_Rendering();

		// Common render codes for all row types
		// Doc_Type

		$doc_types->Doc_Type->CellCssStyle = ""; $doc_types->Doc_Type->CellCssClass = "";
		$doc_types->Doc_Type->CellAttrs = array(); $doc_types->Doc_Type->ViewAttrs = array(); $doc_types->Doc_Type->EditAttrs = array();
		if ($doc_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$doc_types->id->ViewValue = $doc_types->id->CurrentValue;
			$doc_types->id->CssStyle = "";
			$doc_types->id->CssClass = "";
			$doc_types->id->ViewCustomAttributes = "";

			// Doc_Type
			$doc_types->Doc_Type->ViewValue = $doc_types->Doc_Type->CurrentValue;
			$doc_types->Doc_Type->CssStyle = "";
			$doc_types->Doc_Type->CssClass = "";
			$doc_types->Doc_Type->ViewCustomAttributes = "";

			// Doc_Type
			$doc_types->Doc_Type->HrefValue = "";
			$doc_types->Doc_Type->TooltipValue = "";
		} elseif ($doc_types->RowType == EW_ROWTYPE_ADD) { // Add row

			// Doc_Type
			$doc_types->Doc_Type->EditCustomAttributes = "";
			$doc_types->Doc_Type->EditValue = ew_HtmlEncode($doc_types->Doc_Type->CurrentValue);
		}

		// Call Row Rendered event
		if ($doc_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$doc_types->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $doc_types;

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
		global $conn, $Language, $Security, $doc_types;
		$rsnew = array();

		// Doc_Type
		$doc_types->Doc_Type->SetDbValueDef($rsnew, $doc_types->Doc_Type->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $doc_types->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($doc_types->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($doc_types->CancelMessage <> "") {
				$this->setMessage($doc_types->CancelMessage);
				$doc_types->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$doc_types->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $doc_types->id->DbValue;

			// Call Row Inserted event
			$doc_types->Row_Inserted($rsnew);
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
