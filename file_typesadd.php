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
$file_types_add = new cfile_types_add();
$Page =& $file_types_add;

// Page init
$file_types_add->Page_Init();

// Page main
$file_types_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var file_types_add = new ew_Page("file_types_add");

// page properties
file_types_add.PageID = "add"; // page ID
file_types_add.FormID = "ffile_typesadd"; // form ID
var EW_PAGE_ID = file_types_add.PageID; // for backward compatibility

// extend page with ValidateForm function
file_types_add.ValidateForm = function(fobj) {
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
file_types_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
file_types_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_types_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_types->TableCaption() ?><br><br>
<a href="<?php echo $file_types->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_types_add->ShowMessage();
?>
<form name="ffile_typesadd" id="ffile_typesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return file_types_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="file_types">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($file_types->File_Type->Visible) { // File_Type ?>
	<tr<?php echo $file_types->File_Type->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_types->File_Type->FldCaption() ?></td>
		<td<?php echo $file_types->File_Type->CellAttributes() ?>><span id="el_File_Type">
<input type="text" name="x_File_Type" id="x_File_Type" title="<?php echo $file_types->File_Type->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $file_types->File_Type->EditValue ?>"<?php echo $file_types->File_Type->EditAttributes() ?>>
</span><?php echo $file_types->File_Type->CustomMsg ?></td>
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
$file_types_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_types_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'file_types';

	// Page object name
	var $PageObjName = 'file_types_add';

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
	function cfile_types_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_types)
		$GLOBALS["file_types"] = new cfile_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $file_types;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $file_types->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $file_types->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$file_types->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $file_types->CurrentAction = "C"; // Copy record
		  } else {
		    $file_types->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($file_types->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("file_typeslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$file_types->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $file_types->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$file_types->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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
		$file_types->File_Type->setFormValue($objForm->GetValue("x_File_Type"));
		$file_types->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $file_types;
		$file_types->id->CurrentValue = $file_types->id->FormValue;
		$file_types->File_Type->CurrentValue = $file_types->File_Type->FormValue;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
