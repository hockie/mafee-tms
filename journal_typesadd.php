<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "journal_typesinfo.php" ?>
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
$journal_types_add = new cjournal_types_add();
$Page =& $journal_types_add;

// Page init
$journal_types_add->Page_Init();

// Page main
$journal_types_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var journal_types_add = new ew_Page("journal_types_add");

// page properties
journal_types_add.PageID = "add"; // page ID
journal_types_add.FormID = "fjournal_typesadd"; // form ID
var EW_PAGE_ID = journal_types_add.PageID; // for backward compatibility

// extend page with ValidateForm function
journal_types_add.ValidateForm = function(fobj) {
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
journal_types_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
journal_types_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
journal_types_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
journal_types_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 20;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {			
		var inst;			
		for (inst in CKEDITOR.instances)
			CKEDITOR.instances[inst].updateElement();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];		
		if (inst)
			inst.setData(inst.element.value);
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof CKEDITOR != 'undefined') {
		var inst = CKEDITOR.instances[name];	
		if (inst)
			inst.focus();
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $journal_types->TableCaption() ?><br><br>
<a href="<?php echo $journal_types->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$journal_types_add->ShowMessage();
?>
<form name="fjournal_typesadd" id="fjournal_typesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return journal_types_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="journal_types">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($journal_types->Journal_Name->Visible) { // Journal_Name ?>
	<tr<?php echo $journal_types->Journal_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_types->Journal_Name->FldCaption() ?></td>
		<td<?php echo $journal_types->Journal_Name->CellAttributes() ?>><span id="el_Journal_Name">
<input type="text" name="x_Journal_Name" id="x_Journal_Name" title="<?php echo $journal_types->Journal_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $journal_types->Journal_Name->EditValue ?>"<?php echo $journal_types->Journal_Name->EditAttributes() ?>>
</span><?php echo $journal_types->Journal_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($journal_types->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $journal_types->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $journal_types->Remarks->FldCaption() ?></td>
		<td<?php echo $journal_types->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $journal_types->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $journal_types->Remarks->EditAttributes() ?>><?php echo $journal_types->Remarks->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_Remarks", function() {
	var oCKeditor = CKEDITOR.replace('x_Remarks', { width: 35*_width_multiplier, height: 4*_height_multiplier, autoUpdateElement: false, baseHref: 'ckeditor/'});
	this.active = true;
}));
-->
</script>
</span><?php echo $journal_types->Remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$journal_types_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cjournal_types_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'journal_types';

	// Page object name
	var $PageObjName = 'journal_types_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $journal_types;
		if ($journal_types->UseTokenInUrl) $PageUrl .= "t=" . $journal_types->TableVar . "&"; // Add page token
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
		global $objForm, $journal_types;
		if ($journal_types->UseTokenInUrl) {
			if ($objForm)
				return ($journal_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($journal_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cjournal_types_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (journal_types)
		$GLOBALS["journal_types"] = new cjournal_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'journal_types', TRUE);

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
		global $journal_types;

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
			$this->Page_Terminate("journal_typeslist.php");
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
		global $objForm, $Language, $gsFormError, $journal_types;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $journal_types->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $journal_types->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$journal_types->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $journal_types->CurrentAction = "C"; // Copy record
		  } else {
		    $journal_types->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($journal_types->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("journal_typeslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$journal_types->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $journal_types->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$journal_types->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $journal_types;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $journal_types;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $journal_types;
		$journal_types->Journal_Name->setFormValue($objForm->GetValue("x_Journal_Name"));
		$journal_types->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$journal_types->created->setFormValue($objForm->GetValue("x_created"));
		$journal_types->created->CurrentValue = ew_UnFormatDateTime($journal_types->created->CurrentValue, 6);
		$journal_types->User_ID->setFormValue($objForm->GetValue("x_User_ID"));
		$journal_types->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $journal_types;
		$journal_types->id->CurrentValue = $journal_types->id->FormValue;
		$journal_types->Journal_Name->CurrentValue = $journal_types->Journal_Name->FormValue;
		$journal_types->Remarks->CurrentValue = $journal_types->Remarks->FormValue;
		$journal_types->created->CurrentValue = $journal_types->created->FormValue;
		$journal_types->created->CurrentValue = ew_UnFormatDateTime($journal_types->created->CurrentValue, 6);
		$journal_types->User_ID->CurrentValue = $journal_types->User_ID->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $journal_types;
		$sFilter = $journal_types->KeyFilter();

		// Call Row Selecting event
		$journal_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$journal_types->CurrentFilter = $sFilter;
		$sSql = $journal_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$journal_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $journal_types;
		$journal_types->id->setDbValue($rs->fields('id'));
		$journal_types->Journal_Name->setDbValue($rs->fields('Journal_Name'));
		$journal_types->Remarks->setDbValue($rs->fields('Remarks'));
		$journal_types->created->setDbValue($rs->fields('created'));
		$journal_types->modified->setDbValue($rs->fields('modified'));
		$journal_types->User_ID->setDbValue($rs->fields('User_ID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $journal_types;

		// Initialize URLs
		// Call Row_Rendering event

		$journal_types->Row_Rendering();

		// Common render codes for all row types
		// Journal_Name

		$journal_types->Journal_Name->CellCssStyle = ""; $journal_types->Journal_Name->CellCssClass = "";
		$journal_types->Journal_Name->CellAttrs = array(); $journal_types->Journal_Name->ViewAttrs = array(); $journal_types->Journal_Name->EditAttrs = array();

		// Remarks
		$journal_types->Remarks->CellCssStyle = ""; $journal_types->Remarks->CellCssClass = "";
		$journal_types->Remarks->CellAttrs = array(); $journal_types->Remarks->ViewAttrs = array(); $journal_types->Remarks->EditAttrs = array();

		// created
		$journal_types->created->CellCssStyle = ""; $journal_types->created->CellCssClass = "";
		$journal_types->created->CellAttrs = array(); $journal_types->created->ViewAttrs = array(); $journal_types->created->EditAttrs = array();

		// User_ID
		$journal_types->User_ID->CellCssStyle = ""; $journal_types->User_ID->CellCssClass = "";
		$journal_types->User_ID->CellAttrs = array(); $journal_types->User_ID->ViewAttrs = array(); $journal_types->User_ID->EditAttrs = array();
		if ($journal_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$journal_types->id->ViewValue = $journal_types->id->CurrentValue;
			$journal_types->id->CssStyle = "";
			$journal_types->id->CssClass = "";
			$journal_types->id->ViewCustomAttributes = "";

			// Journal_Name
			$journal_types->Journal_Name->ViewValue = $journal_types->Journal_Name->CurrentValue;
			$journal_types->Journal_Name->CssStyle = "";
			$journal_types->Journal_Name->CssClass = "";
			$journal_types->Journal_Name->ViewCustomAttributes = "";

			// Remarks
			$journal_types->Remarks->ViewValue = $journal_types->Remarks->CurrentValue;
			$journal_types->Remarks->CssStyle = "";
			$journal_types->Remarks->CssClass = "";
			$journal_types->Remarks->ViewCustomAttributes = "";

			// created
			$journal_types->created->ViewValue = $journal_types->created->CurrentValue;
			$journal_types->created->ViewValue = ew_FormatDateTime($journal_types->created->ViewValue, 6);
			$journal_types->created->CssStyle = "";
			$journal_types->created->CssClass = "";
			$journal_types->created->ViewCustomAttributes = "";

			// modified
			$journal_types->modified->ViewValue = $journal_types->modified->CurrentValue;
			$journal_types->modified->ViewValue = ew_FormatDateTime($journal_types->modified->ViewValue, 6);
			$journal_types->modified->CssStyle = "";
			$journal_types->modified->CssClass = "";
			$journal_types->modified->ViewCustomAttributes = "";

			// User_ID
			$journal_types->User_ID->ViewValue = $journal_types->User_ID->CurrentValue;
			$journal_types->User_ID->CssStyle = "";
			$journal_types->User_ID->CssClass = "";
			$journal_types->User_ID->ViewCustomAttributes = "";

			// Journal_Name
			$journal_types->Journal_Name->HrefValue = "";
			$journal_types->Journal_Name->TooltipValue = "";

			// Remarks
			$journal_types->Remarks->HrefValue = "";
			$journal_types->Remarks->TooltipValue = "";

			// created
			$journal_types->created->HrefValue = "";
			$journal_types->created->TooltipValue = "";

			// User_ID
			$journal_types->User_ID->HrefValue = "";
			$journal_types->User_ID->TooltipValue = "";
		} elseif ($journal_types->RowType == EW_ROWTYPE_ADD) { // Add row

			// Journal_Name
			$journal_types->Journal_Name->EditCustomAttributes = "";
			$journal_types->Journal_Name->EditValue = ew_HtmlEncode($journal_types->Journal_Name->CurrentValue);

			// Remarks
			$journal_types->Remarks->EditCustomAttributes = "";
			$journal_types->Remarks->EditValue = ew_HtmlEncode($journal_types->Remarks->CurrentValue);

			// created
			// User_ID

		}

		// Call Row Rendered event
		if ($journal_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$journal_types->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $journal_types;

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
		global $conn, $Language, $Security, $journal_types;
		$rsnew = array();

		// Journal_Name
		$journal_types->Journal_Name->SetDbValueDef($rsnew, $journal_types->Journal_Name->CurrentValue, NULL, FALSE);

		// Remarks
		$journal_types->Remarks->SetDbValueDef($rsnew, $journal_types->Remarks->CurrentValue, NULL, FALSE);

		// created
		$journal_types->created->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['created'] =& $journal_types->created->DbValue;

		// User_ID
		$journal_types->User_ID->SetDbValueDef($rsnew, CurrentUserID(), NULL);
		$rsnew['User_ID'] =& $journal_types->User_ID->DbValue;

		// Call Row Inserting event
		$bInsertRow = $journal_types->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($journal_types->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($journal_types->CancelMessage <> "") {
				$this->setMessage($journal_types->CancelMessage);
				$journal_types->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$journal_types->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $journal_types->id->DbValue;

			// Call Row Inserted event
			$journal_types->Row_Inserted($rsnew);
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
