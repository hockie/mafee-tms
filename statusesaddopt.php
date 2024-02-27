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
$statuses_addopt = new cstatuses_addopt();
$Page =& $statuses_addopt;

// Page init
$statuses_addopt->Page_Init();

// Page main
$statuses_addopt->Page_Main();
?>
<script type="text/javascript">
<!--
var statuses_addopt = new ew_Page("statuses_addopt");

// page properties
statuses_addopt.PageID = "addopt"; // page ID
statuses_addopt.FormID = "fstatusesaddopt"; // form ID
var EW_PAGE_ID = statuses_addopt.PageID; // for backward compatibility

// extend page with ValidateForm function
statuses_addopt.ValidateForm = function(fobj) {
	return true; // ignore validation
}

//-->
</script>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$statuses_addopt->ShowMessage();
?>
<form name="fstatusesaddopt" id="fstatusesaddopt" action="statusesaddopt.php" method="post" onsubmit="return statuses_addopt.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="statuses">
<input type="hidden" name="a_addopt" id="a_addopt" value="A">
<table class="ewTableAddOpt">
	<tr>
		<td><?php echo $statuses->Status->FldCaption() ?></td>
		<td><span id="el_Status">
<input type="text" name="x_Status" id="x_Status" title="<?php echo $statuses->Status->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $statuses->Status->EditValue ?>"<?php echo $statuses->Status->EditAttributes() ?>>
</span></td>
	</tr>
	<tr>
		<td><?php echo $statuses->Modules->FldCaption() ?></td>
		<td><span id="el_Modules">
<input type="text" name="x_Modules" id="x_Modules" title="<?php echo $statuses->Modules->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $statuses->Modules->EditValue ?>"<?php echo $statuses->Modules->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
</form>
<?php
$statuses_addopt->Page_Terminate();
?>
<?php

//
// Page class
//
class cstatuses_addopt {

	// Page ID
	var $PageID = 'addopt';

	// Table name
	var $TableName = 'statuses';

	// Page object name
	var $PageObjName = 'statuses_addopt';

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
	function cstatuses_addopt() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (statuses)
		$GLOBALS["statuses"] = new cstatuses();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'addopt', TRUE);

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
		if (!$Security->CanAdd()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $statuses;

		// Process form if post back
		if ($objForm->GetValue("a_addopt") <> "") {
			$statuses->CurrentAction = $objForm->GetValue("a_addopt"); // Get form action
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$statuses->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
			$statuses->CurrentAction = "I"; // Display blank record
			$this->LoadDefaultValues(); // Load default values
		}

		// Perform action based on action code
		switch ($statuses->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add new record
				$statuses->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow()) { // Add successful
					$XMLDoc = new cXMLDocument("utf-8");
					$XMLDoc->AddRoot("root");
					$XMLDoc->AddRow("result");
					$XMLDoc->AddField("x_id", strval($statuses->id->DbValue));
					$XMLDoc->AddField("x_Status", strval($statuses->Status->FormValue));
					$XMLDoc->AddField("x_Modules", strval($statuses->Modules->FormValue));
					header("Content-Type: text/xml");
					echo $XMLDoc->XML();
					$this->Page_Terminate();
					exit();
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row
		$statuses->RowType = EW_ROWTYPE_ADD; // Render add type
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $statuses;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $statuses;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $statuses;
		$statuses->Status->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Status")));
		$statuses->Modules->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_Modules")));
		$statuses->id->setFormValue(ew_ConvertFromUtf8($objForm->GetValue("x_id")));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $statuses;
		$statuses->id->CurrentValue = ew_ConvertToUtf8($statuses->id->FormValue);
		$statuses->Status->CurrentValue = ew_ConvertToUtf8($statuses->Status->FormValue);
		$statuses->Modules->CurrentValue = ew_ConvertToUtf8($statuses->Modules->FormValue);
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

			// Status
			$statuses->Status->HrefValue = "";
			$statuses->Status->TooltipValue = "";

			// Modules
			$statuses->Modules->HrefValue = "";
			$statuses->Modules->TooltipValue = "";
		} elseif ($statuses->RowType == EW_ROWTYPE_ADD) { // Add row

			// Status
			$statuses->Status->EditCustomAttributes = "";
			$statuses->Status->EditValue = ew_HtmlEncode($statuses->Status->CurrentValue);

			// Modules
			$statuses->Modules->EditCustomAttributes = "";
			$statuses->Modules->EditValue = ew_HtmlEncode($statuses->Modules->CurrentValue);
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
		global $conn, $Language, $Security, $statuses;
		$rsnew = array();

		// Status
		$statuses->Status->SetDbValueDef($rsnew, $statuses->Status->CurrentValue, NULL, FALSE);

		// Modules
		$statuses->Modules->SetDbValueDef($rsnew, $statuses->Modules->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $statuses->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($statuses->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($statuses->CancelMessage <> "") {
				$this->setMessage($statuses->CancelMessage);
				$statuses->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$statuses->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $statuses->id->DbValue;

			// Call Row Inserted event
			$statuses->Row_Inserted($rsnew);
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
