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
$areas_add = new careas_add();
$Page =& $areas_add;

// Page init
$areas_add->Page_Init();

// Page main
$areas_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var areas_add = new ew_Page("areas_add");

// page properties
areas_add.PageID = "add"; // page ID
areas_add.FormID = "fareasadd"; // form ID
var EW_PAGE_ID = areas_add.PageID; // for backward compatibility

// extend page with ValidateForm function
areas_add.ValidateForm = function(fobj) {
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
areas_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
areas_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
areas_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $areas->TableCaption() ?><br><br>
<a href="<?php echo $areas->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$areas_add->ShowMessage();
?>
<form name="fareasadd" id="fareasadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return areas_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="areas">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
$areas_add->Page_Terminate();
?>
<?php

//
// Page class
//
class careas_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'areas';

	// Page object name
	var $PageObjName = 'areas_add';

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
	function careas_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (areas)
		$GLOBALS["areas"] = new careas();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $areas;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $areas->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $areas->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$areas->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $areas->CurrentAction = "C"; // Copy record
		  } else {
		    $areas->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($areas->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("areaslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$areas->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $areas->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$areas->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $areas;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $areas;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $areas;
		$areas->Area->setFormValue($objForm->GetValue("x_Area"));
		$areas->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $areas;
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

			// Area
			$areas->Area->HrefValue = "";
			$areas->Area->TooltipValue = "";
		} elseif ($areas->RowType == EW_ROWTYPE_ADD) { // Add row

			// Area
			$areas->Area->EditCustomAttributes = "";
			$areas->Area->EditValue = ew_HtmlEncode($areas->Area->CurrentValue);
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $areas;
		$rsnew = array();

		// Area
		$areas->Area->SetDbValueDef($rsnew, $areas->Area->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $areas->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($areas->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($areas->CancelMessage <> "") {
				$this->setMessage($areas->CancelMessage);
				$areas->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$areas->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $areas->id->DbValue;

			// Call Row Inserted event
			$areas->Row_Inserted($rsnew);
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
