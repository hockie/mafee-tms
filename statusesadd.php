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
$statuses_add = new cstatuses_add();
$Page =& $statuses_add;

// Page init
$statuses_add->Page_Init();

// Page main
$statuses_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var statuses_add = new ew_Page("statuses_add");

// page properties
statuses_add.PageID = "add"; // page ID
statuses_add.FormID = "fstatusesadd"; // form ID
var EW_PAGE_ID = statuses_add.PageID; // for backward compatibility

// extend page with ValidateForm function
statuses_add.ValidateForm = function(fobj) {
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
statuses_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
statuses_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
statuses_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
statuses_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $statuses->TableCaption() ?><br><br>
<a href="<?php echo $statuses->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$statuses_add->ShowMessage();
?>
<form name="fstatusesadd" id="fstatusesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return statuses_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="statuses">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$statuses_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cstatuses_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'statuses';

	// Page object name
	var $PageObjName = 'statuses_add';

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
	function cstatuses_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (statuses)
		$GLOBALS["statuses"] = new cstatuses();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $statuses;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $statuses->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $statuses->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$statuses->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $statuses->CurrentAction = "C"; // Copy record
		  } else {
		    $statuses->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($statuses->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("statuseslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$statuses->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $statuses->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$statuses->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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
		$statuses->Status->setFormValue($objForm->GetValue("x_Status"));
		$statuses->Modules->setFormValue($objForm->GetValue("x_Modules"));
		$statuses->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $statuses;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
