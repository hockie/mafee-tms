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
$units_add = new cunits_add();
$Page =& $units_add;

// Page init
$units_add->Page_Init();

// Page main
$units_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var units_add = new ew_Page("units_add");

// page properties
units_add.PageID = "add"; // page ID
units_add.FormID = "funitsadd"; // form ID
var EW_PAGE_ID = units_add.PageID; // for backward compatibility

// extend page with ValidateForm function
units_add.ValidateForm = function(fobj) {
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
units_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
units_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
units_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $units->TableCaption() ?><br><br>
<a href="<?php echo $units->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$units_add->ShowMessage();
?>
<form name="funitsadd" id="funitsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return units_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="units">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($units->Units->Visible) { // Units ?>
	<tr<?php echo $units->Units->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $units->Units->FldCaption() ?></td>
		<td<?php echo $units->Units->CellAttributes() ?>><span id="el_Units">
<input type="text" name="x_Units" id="x_Units" title="<?php echo $units->Units->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $units->Units->EditValue ?>"<?php echo $units->Units->EditAttributes() ?>>
</span><?php echo $units->Units->CustomMsg ?></td>
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
$units_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cunits_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'units';

	// Page object name
	var $PageObjName = 'units_add';

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
	function cunits_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (units)
		$GLOBALS["units"] = new cunits();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $units;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $units->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $units->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$units->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $units->CurrentAction = "C"; // Copy record
		  } else {
		    $units->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($units->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("unitslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$units->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $units->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$units->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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
		$units->Units->setFormValue($objForm->GetValue("x_Units"));
		$units->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $units;
		$units->id->CurrentValue = $units->id->FormValue;
		$units->Units->CurrentValue = $units->Units->FormValue;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
