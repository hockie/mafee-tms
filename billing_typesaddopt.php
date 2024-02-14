<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "billing_typesinfo.php" ?>
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
$billing_types_addopt = new cbilling_types_addopt();
$Page =& $billing_types_addopt;

// Page init
$billing_types_addopt->Page_Init();

// Page main
$billing_types_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var billing_types_addopt = new ew_Page("billing_types_addopt");

// page properties
billing_types_addopt.PageID = "addopt"; // page ID
billing_types_addopt.FormID = "fbilling_typesaddopt"; // form ID
var EW_PAGE_ID = billing_types_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
billing_types_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$billing_types_addopt->ShowMessage();
?>
<form name="fbilling_typesaddopt" id="fbilling_typesaddopt" action="billing_typesaddopt.php" method="post" onsubmit="return billing_types_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="billing_types">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td><?php echo $billing_types->Billing_Types->FldCaption() ?></td>
		<td><span id="el_Billing_Types">
<input type="text" name="x_Billing_Types" id="x_Billing_Types" title="<?php echo $billing_types->Billing_Types->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $billing_types->Billing_Types->EditValue ?>"<?php echo $billing_types->Billing_Types->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
</form>
<?php
$billing_types_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class cbilling_types_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'billing_types';

	// Page object name
	var $PageObjName = 'billing_types_addopt';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $billing_types;
		if ($billing_types->UseTokenInUrl) $PageUrl .= "t=" . $billing_types->TableVar . "&"; // Add page token
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
		global $objForm, $billing_types;
		if ($billing_types->UseTokenInUrl) {
			if ($objForm)
				return ($billing_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($billing_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbilling_types_addopt() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (billing_types)
		$GLOBALS["billing_types"] = new cbilling_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'billing_types', TRUE);

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
		global $billing_types;

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
			$this->Page_Terminate("billing_typeslist.php");
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
		global $objForm, $Language, $gsFormError, $billing_types;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$billing_types->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$billing_types->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$billing_types->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($billing_types->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$billing_types->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_id", strval($billing_types->id->DbValue));
					$XMLDoc->AddField("x_Billing_Types", strval($billing_types->Billing_Types->FormValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$billing_types->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $billing_types;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $billing_types;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $billing_types;
		$billing_types->Billing_Types->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Billing_Types")));
		$billing_types->id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_id")));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $billing_types;
		$billing_types->id->CurrentValue = ew_ConvertToUtf8($billing_types->id->FormValue);
		$billing_types->Billing_Types->CurrentValue = ew_ConvertToUtf8($billing_types->Billing_Types->FormValue);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $billing_types;
		$sFilter = $billing_types->KeyFilter();

		// Call Row Selecting event
		$billing_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$billing_types->CurrentFilter = $sFilter;
		$sSql = $billing_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$billing_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $billing_types;
		$billing_types->id->setDbValue($rs->fields('id'));
		$billing_types->Billing_Types->setDbValue($rs->fields('Billing_Types'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $billing_types;

		// Initialize URLs
		// Call Row_Rendering event

		$billing_types->Row_Rendering();

		// Common render codes for all row types
		// Billing_Types

		$billing_types->Billing_Types->CellCssStyle = ""; $billing_types->Billing_Types->CellCssClass = "";
		$billing_types->Billing_Types->CellAttrs = array(); $billing_types->Billing_Types->ViewAttrs = array(); $billing_types->Billing_Types->EditAttrs = array();
		if ($billing_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$billing_types->id->ViewValue = $billing_types->id->CurrentValue;
			$billing_types->id->CssStyle = "";
			$billing_types->id->CssClass = "";
			$billing_types->id->ViewCustomAttributes = "";

			// Billing_Types
			$billing_types->Billing_Types->ViewValue = $billing_types->Billing_Types->CurrentValue;
			$billing_types->Billing_Types->CssStyle = "";
			$billing_types->Billing_Types->CssClass = "";
			$billing_types->Billing_Types->ViewCustomAttributes = "";

			// Billing_Types
			$billing_types->Billing_Types->HrefValue = "";
			$billing_types->Billing_Types->TooltipValue = "";
		} elseif ($billing_types->RowType == EW_ROWTYPE_ADD) { // Add row

			// Billing_Types
			$billing_types->Billing_Types->EditCustomAttributes = "";
			$billing_types->Billing_Types->EditValue = ew_HtmlEncode($billing_types->Billing_Types->CurrentValue);
		}

		// Call Row Rendered event
		if ($billing_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$billing_types->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $billing_types;

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
		global $conn, $Language, $Security, $billing_types;
		$rsnew = array();

		// Billing_Types
		$billing_types->Billing_Types->SetDbValueDef($rsnew, $billing_types->Billing_Types->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $billing_types->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($billing_types->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($billing_types->CancelMessage <> "") {
				$this->setMessage($billing_types->CancelMessage);
				$billing_types->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$billing_types->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $billing_types->id->DbValue;

			// Call Row Inserted event
			$billing_types->Row_Inserted($rsnew);
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
