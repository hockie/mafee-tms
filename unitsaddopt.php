<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "unitsinfo.php" ?>
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
$units_addopt = new cunits_addopt();
$Page =& $units_addopt;

// Page init
$units_addopt->Page_Init();

// Page main
$units_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var units_addopt = new ew_Page("units_addopt");

// page properties
units_addopt.PageID = "addopt"; // page ID
units_addopt.FormID = "funitsaddopt"; // form ID
var EW_PAGE_ID = units_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
units_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$units_addopt->ShowMessage();
?>
<form name="funitsaddopt" id="funitsaddopt" action="unitsaddopt.php" method="post" onsubmit="return units_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="units">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td><?php echo $units->Units->FldCaption() ?></td>
		<td><span id="el_Units">
<input type="text" name="x_Units" id="x_Units" title="<?php echo $units->Units->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $units->Units->EditValue ?>"<?php echo $units->Units->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
</form>
<?php
$units_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class cunits_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'units';

	// Page object name
	var $PageObjName = 'units_addopt';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $units;
		if ($units->UseTokenInUrl) $PageUrl .= "t=" . $units->TableVar . "&"; // Add page token
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
		global $objForm, $units;
		if ($units->UseTokenInUrl) {
			if ($objForm)
				return ($units->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($units->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cunits_addopt() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (units)
		$GLOBALS["units"] = new cunits();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'units', TRUE);

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
		global $units;

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
			$this->Page_Terminate("unitslist.php");
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
		global $objForm, $Language, $gsFormError, $units;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$units->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$units->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$units->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($units->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$units->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_id", strval($units->id->DbValue));
					$XMLDoc->AddField("x_Units", strval($units->Units->FormValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$units->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $units;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $units;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $units;
		$units->Units->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Units")));
		$units->id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_id")));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $units;
		$units->id->CurrentValue = ew_ConvertToUtf8($units->id->FormValue);
		$units->Units->CurrentValue = ew_ConvertToUtf8($units->Units->FormValue);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $units;
		$sFilter = $units->KeyFilter();

		// Call Row Selecting event
		$units->Row_Selecting($sFilter);

		// Load SQL based on filter
		$units->CurrentFilter = $sFilter;
		$sSql = $units->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$units->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $units;
		$units->id->setDbValue($rs->fields('id'));
		$units->Units->setDbValue($rs->fields('Units'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $units;

		// Initialize URLs
		// Call Row_Rendering event

		$units->Row_Rendering();

		// Common render codes for all row types
		// Units

		$units->Units->CellCssStyle = ""; $units->Units->CellCssClass = "";
		$units->Units->CellAttrs = array(); $units->Units->ViewAttrs = array(); $units->Units->EditAttrs = array();
		if ($units->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$units->id->ViewValue = $units->id->CurrentValue;
			$units->id->CssStyle = "";
			$units->id->CssClass = "";
			$units->id->ViewCustomAttributes = "";

			// Units
			$units->Units->ViewValue = $units->Units->CurrentValue;
			$units->Units->CssStyle = "";
			$units->Units->CssClass = "";
			$units->Units->ViewCustomAttributes = "";

			// Units
			$units->Units->HrefValue = "";
			$units->Units->TooltipValue = "";
		} elseif ($units->RowType == EW_ROWTYPE_ADD) { // Add row

			// Units
			$units->Units->EditCustomAttributes = "";
			$units->Units->EditValue = ew_HtmlEncode($units->Units->CurrentValue);
		}

		// Call Row Rendered event
		if ($units->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$units->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $units;

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
		global $conn, $Language, $Security, $units;
		$rsnew = array();

		// Units
		$units->Units->SetDbValueDef($rsnew, $units->Units->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $units->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($units->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($units->CancelMessage <> "") {
				$this->setMessage($units->CancelMessage);
				$units->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$units->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $units->id->DbValue;

			// Call Row Inserted event
			$units->Row_Inserted($rsnew);
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
