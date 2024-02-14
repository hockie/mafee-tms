<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "clientsinfo.php" ?>
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
$clients_add = new cclients_add();
$Page =& $clients_add;

// Page init
$clients_add->Page_Init();

// Page main
$clients_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var clients_add = new ew_Page("clients_add");

// page properties
clients_add.PageID = "add"; // page ID
clients_add.FormID = "fclientsadd"; // form ID
var EW_PAGE_ID = clients_add.PageID; // for backward compatibility

// extend page with ValidateForm function
clients_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_File_Upload"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
clients_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
clients_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
clients_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
clients_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $clients->TableCaption() ?><br><br>
<a href="<?php echo $clients->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$clients_add->ShowMessage();
?>
<form name="fclientsadd" id="fclientsadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return clients_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="clients">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($clients->Account_No->Visible) { // Account_No ?>
	<tr<?php echo $clients->Account_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Account_No->FldCaption() ?></td>
		<td<?php echo $clients->Account_No->CellAttributes() ?>><span id="el_Account_No">
<input type="text" name="x_Account_No" id="x_Account_No" title="<?php echo $clients->Account_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $clients->Account_No->EditValue ?>"<?php echo $clients->Account_No->EditAttributes() ?>>
</span><?php echo $clients->Account_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->Alias->Visible) { // Alias ?>
	<tr<?php echo $clients->Alias->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Alias->FldCaption() ?></td>
		<td<?php echo $clients->Alias->CellAttributes() ?>><span id="el_Alias">
<input type="text" name="x_Alias" id="x_Alias" title="<?php echo $clients->Alias->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $clients->Alias->EditValue ?>"<?php echo $clients->Alias->EditAttributes() ?>>
</span><?php echo $clients->Alias->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->Client_Name->Visible) { // Client_Name ?>
	<tr<?php echo $clients->Client_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Client_Name->FldCaption() ?></td>
		<td<?php echo $clients->Client_Name->CellAttributes() ?>><span id="el_Client_Name">
<input type="text" name="x_Client_Name" id="x_Client_Name" title="<?php echo $clients->Client_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $clients->Client_Name->EditValue ?>"<?php echo $clients->Client_Name->EditAttributes() ?>>
</span><?php echo $clients->Client_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->Address->Visible) { // Address ?>
	<tr<?php echo $clients->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Address->FldCaption() ?></td>
		<td<?php echo $clients->Address->CellAttributes() ?>><span id="el_Address">
<input type="text" name="x_Address" id="x_Address" title="<?php echo $clients->Address->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $clients->Address->EditValue ?>"<?php echo $clients->Address->EditAttributes() ?>>
</span><?php echo $clients->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $clients->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Contact_No->FldCaption() ?></td>
		<td<?php echo $clients->Contact_No->CellAttributes() ?>><span id="el_Contact_No">
<input type="text" name="x_Contact_No" id="x_Contact_No" title="<?php echo $clients->Contact_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $clients->Contact_No->EditValue ?>"<?php echo $clients->Contact_No->EditAttributes() ?>>
</span><?php echo $clients->Contact_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->Email_Address->Visible) { // Email_Address ?>
	<tr<?php echo $clients->Email_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Email_Address->FldCaption() ?></td>
		<td<?php echo $clients->Email_Address->CellAttributes() ?>><span id="el_Email_Address">
<input type="text" name="x_Email_Address" id="x_Email_Address" title="<?php echo $clients->Email_Address->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $clients->Email_Address->EditValue ?>"<?php echo $clients->Email_Address->EditAttributes() ?>>
</span><?php echo $clients->Email_Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->TIN_No->Visible) { // TIN_No ?>
	<tr<?php echo $clients->TIN_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->TIN_No->FldCaption() ?></td>
		<td<?php echo $clients->TIN_No->CellAttributes() ?>><span id="el_TIN_No">
<input type="text" name="x_TIN_No" id="x_TIN_No" title="<?php echo $clients->TIN_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $clients->TIN_No->EditValue ?>"<?php echo $clients->TIN_No->EditAttributes() ?>>
</span><?php echo $clients->TIN_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->Contact_Person->Visible) { // Contact_Person ?>
	<tr<?php echo $clients->Contact_Person->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Contact_Person->FldCaption() ?></td>
		<td<?php echo $clients->Contact_Person->CellAttributes() ?>><span id="el_Contact_Person">
<input type="text" name="x_Contact_Person" id="x_Contact_Person" title="<?php echo $clients->Contact_Person->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $clients->Contact_Person->EditValue ?>"<?php echo $clients->Contact_Person->EditAttributes() ?>>
</span><?php echo $clients->Contact_Person->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $clients->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->File_Upload->FldCaption() ?></td>
		<td<?php echo $clients->File_Upload->CellAttributes() ?>><span id="el_File_Upload">
<input type="file" name="x_File_Upload" id="x_File_Upload" title="<?php echo $clients->File_Upload->FldTitle() ?>" size="30"<?php echo $clients->File_Upload->EditAttributes() ?>>
</div>
</span><?php echo $clients->File_Upload->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $clients->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $clients->Remarks->FldCaption() ?></td>
		<td<?php echo $clients->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $clients->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $clients->Remarks->EditAttributes() ?>><?php echo $clients->Remarks->EditValue ?></textarea>
</span><?php echo $clients->Remarks->CustomMsg ?></td>
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
$clients_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cclients_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'clients';

	// Page object name
	var $PageObjName = 'clients_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $clients;
		if ($clients->UseTokenInUrl) $PageUrl .= "t=" . $clients->TableVar . "&"; // Add page token
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
		global $objForm, $clients;
		if ($clients->UseTokenInUrl) {
			if ($objForm)
				return ($clients->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($clients->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclients_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (clients)
		$GLOBALS["clients"] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'clients', TRUE);

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
		global $clients;

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
			$this->Page_Terminate("clientslist.php");
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
		global $objForm, $Language, $gsFormError, $clients;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $clients->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $clients->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$clients->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $clients->CurrentAction = "C"; // Copy record
		  } else {
		    $clients->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($clients->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("clientslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$clients->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $clients->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$clients->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $clients;

		// Get upload data
			if ($clients->File_Upload->Upload->UploadFile()) {

				// No action required
			} else {
				echo $clients->File_Upload->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $clients;
		$clients->File_Upload->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $clients;
		$clients->Account_No->setFormValue($objForm->GetValue("x_Account_No"));
		$clients->Alias->setFormValue($objForm->GetValue("x_Alias"));
		$clients->Client_Name->setFormValue($objForm->GetValue("x_Client_Name"));
		$clients->Address->setFormValue($objForm->GetValue("x_Address"));
		$clients->Contact_No->setFormValue($objForm->GetValue("x_Contact_No"));
		$clients->Email_Address->setFormValue($objForm->GetValue("x_Email_Address"));
		$clients->TIN_No->setFormValue($objForm->GetValue("x_TIN_No"));
		$clients->Contact_Person->setFormValue($objForm->GetValue("x_Contact_Person"));
		$clients->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$clients->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $clients;
		$clients->id->CurrentValue = $clients->id->FormValue;
		$clients->Account_No->CurrentValue = $clients->Account_No->FormValue;
		$clients->Alias->CurrentValue = $clients->Alias->FormValue;
		$clients->Client_Name->CurrentValue = $clients->Client_Name->FormValue;
		$clients->Address->CurrentValue = $clients->Address->FormValue;
		$clients->Contact_No->CurrentValue = $clients->Contact_No->FormValue;
		$clients->Email_Address->CurrentValue = $clients->Email_Address->FormValue;
		$clients->TIN_No->CurrentValue = $clients->TIN_No->FormValue;
		$clients->Contact_Person->CurrentValue = $clients->Contact_Person->FormValue;
		$clients->Remarks->CurrentValue = $clients->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();

		// Call Row Selecting event
		$clients->Row_Selecting($sFilter);

		// Load SQL based on filter
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$clients->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $clients;
		$clients->id->setDbValue($rs->fields('id'));
		$clients->Account_No->setDbValue($rs->fields('Account_No'));
		$clients->Alias->setDbValue($rs->fields('Alias'));
		$clients->Client_Name->setDbValue($rs->fields('Client_Name'));
		$clients->Address->setDbValue($rs->fields('Address'));
		$clients->Contact_No->setDbValue($rs->fields('Contact_No'));
		$clients->Email_Address->setDbValue($rs->fields('Email_Address'));
		$clients->TIN_No->setDbValue($rs->fields('TIN_No'));
		$clients->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$clients->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$clients->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $clients;

		// Initialize URLs
		// Call Row_Rendering event

		$clients->Row_Rendering();

		// Common render codes for all row types
		// Account_No

		$clients->Account_No->CellCssStyle = ""; $clients->Account_No->CellCssClass = "";
		$clients->Account_No->CellAttrs = array(); $clients->Account_No->ViewAttrs = array(); $clients->Account_No->EditAttrs = array();

		// Alias
		$clients->Alias->CellCssStyle = ""; $clients->Alias->CellCssClass = "";
		$clients->Alias->CellAttrs = array(); $clients->Alias->ViewAttrs = array(); $clients->Alias->EditAttrs = array();

		// Client_Name
		$clients->Client_Name->CellCssStyle = ""; $clients->Client_Name->CellCssClass = "";
		$clients->Client_Name->CellAttrs = array(); $clients->Client_Name->ViewAttrs = array(); $clients->Client_Name->EditAttrs = array();

		// Address
		$clients->Address->CellCssStyle = ""; $clients->Address->CellCssClass = "";
		$clients->Address->CellAttrs = array(); $clients->Address->ViewAttrs = array(); $clients->Address->EditAttrs = array();

		// Contact_No
		$clients->Contact_No->CellCssStyle = ""; $clients->Contact_No->CellCssClass = "";
		$clients->Contact_No->CellAttrs = array(); $clients->Contact_No->ViewAttrs = array(); $clients->Contact_No->EditAttrs = array();

		// Email_Address
		$clients->Email_Address->CellCssStyle = ""; $clients->Email_Address->CellCssClass = "";
		$clients->Email_Address->CellAttrs = array(); $clients->Email_Address->ViewAttrs = array(); $clients->Email_Address->EditAttrs = array();

		// TIN_No
		$clients->TIN_No->CellCssStyle = ""; $clients->TIN_No->CellCssClass = "";
		$clients->TIN_No->CellAttrs = array(); $clients->TIN_No->ViewAttrs = array(); $clients->TIN_No->EditAttrs = array();

		// Contact_Person
		$clients->Contact_Person->CellCssStyle = ""; $clients->Contact_Person->CellCssClass = "";
		$clients->Contact_Person->CellAttrs = array(); $clients->Contact_Person->ViewAttrs = array(); $clients->Contact_Person->EditAttrs = array();

		// File_Upload
		$clients->File_Upload->CellCssStyle = ""; $clients->File_Upload->CellCssClass = "";
		$clients->File_Upload->CellAttrs = array(); $clients->File_Upload->ViewAttrs = array(); $clients->File_Upload->EditAttrs = array();

		// Remarks
		$clients->Remarks->CellCssStyle = ""; $clients->Remarks->CellCssClass = "";
		$clients->Remarks->CellAttrs = array(); $clients->Remarks->ViewAttrs = array(); $clients->Remarks->EditAttrs = array();
		if ($clients->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$clients->id->ViewValue = $clients->id->CurrentValue;
			$clients->id->CssStyle = "";
			$clients->id->CssClass = "";
			$clients->id->ViewCustomAttributes = "";

			// Account_No
			$clients->Account_No->ViewValue = $clients->Account_No->CurrentValue;
			$clients->Account_No->CssStyle = "";
			$clients->Account_No->CssClass = "";
			$clients->Account_No->ViewCustomAttributes = "";

			// Alias
			$clients->Alias->ViewValue = $clients->Alias->CurrentValue;
			$clients->Alias->CssStyle = "";
			$clients->Alias->CssClass = "";
			$clients->Alias->ViewCustomAttributes = "";

			// Client_Name
			$clients->Client_Name->ViewValue = $clients->Client_Name->CurrentValue;
			$clients->Client_Name->CssStyle = "";
			$clients->Client_Name->CssClass = "";
			$clients->Client_Name->ViewCustomAttributes = "";

			// Address
			$clients->Address->ViewValue = $clients->Address->CurrentValue;
			$clients->Address->CssStyle = "";
			$clients->Address->CssClass = "";
			$clients->Address->ViewCustomAttributes = "";

			// Contact_No
			$clients->Contact_No->ViewValue = $clients->Contact_No->CurrentValue;
			$clients->Contact_No->CssStyle = "";
			$clients->Contact_No->CssClass = "";
			$clients->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$clients->Email_Address->ViewValue = $clients->Email_Address->CurrentValue;
			$clients->Email_Address->CssStyle = "";
			$clients->Email_Address->CssClass = "";
			$clients->Email_Address->ViewCustomAttributes = "";

			// TIN_No
			$clients->TIN_No->ViewValue = $clients->TIN_No->CurrentValue;
			$clients->TIN_No->CssStyle = "";
			$clients->TIN_No->CssClass = "";
			$clients->TIN_No->ViewCustomAttributes = "";

			// Contact_Person
			$clients->Contact_Person->ViewValue = $clients->Contact_Person->CurrentValue;
			$clients->Contact_Person->CssStyle = "";
			$clients->Contact_Person->CssClass = "";
			$clients->Contact_Person->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->ViewValue = $clients->File_Upload->Upload->DbValue;
			} else {
				$clients->File_Upload->ViewValue = "";
			}
			$clients->File_Upload->CssStyle = "";
			$clients->File_Upload->CssClass = "";
			$clients->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$clients->Remarks->ViewValue = $clients->Remarks->CurrentValue;
			$clients->Remarks->CssStyle = "";
			$clients->Remarks->CssClass = "";
			$clients->Remarks->ViewCustomAttributes = "";

			// Account_No
			$clients->Account_No->HrefValue = "";
			$clients->Account_No->TooltipValue = "";

			// Alias
			$clients->Alias->HrefValue = "";
			$clients->Alias->TooltipValue = "";

			// Client_Name
			$clients->Client_Name->HrefValue = "";
			$clients->Client_Name->TooltipValue = "";

			// Address
			$clients->Address->HrefValue = "";
			$clients->Address->TooltipValue = "";

			// Contact_No
			$clients->Contact_No->HrefValue = "";
			$clients->Contact_No->TooltipValue = "";

			// Email_Address
			$clients->Email_Address->HrefValue = "";
			$clients->Email_Address->TooltipValue = "";

			// TIN_No
			$clients->TIN_No->HrefValue = "";
			$clients->TIN_No->TooltipValue = "";

			// Contact_Person
			$clients->Contact_Person->HrefValue = "";
			$clients->Contact_Person->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $clients->File_Upload->UploadPath) . ((!empty($clients->File_Upload->ViewValue)) ? $clients->File_Upload->ViewValue : $clients->File_Upload->CurrentValue);
				if ($clients->Export <> "") $clients->File_Upload->HrefValue = ew_ConvertFullUrl($clients->File_Upload->HrefValue);
			} else {
				$clients->File_Upload->HrefValue = "";
			}
			$clients->File_Upload->TooltipValue = "";

			// Remarks
			$clients->Remarks->HrefValue = "";
			$clients->Remarks->TooltipValue = "";
		} elseif ($clients->RowType == EW_ROWTYPE_ADD) { // Add row

			// Account_No
			$clients->Account_No->EditCustomAttributes = "";
			$clients->Account_No->EditValue = ew_HtmlEncode($clients->Account_No->CurrentValue);

			// Alias
			$clients->Alias->EditCustomAttributes = "";
			$clients->Alias->EditValue = ew_HtmlEncode($clients->Alias->CurrentValue);

			// Client_Name
			$clients->Client_Name->EditCustomAttributes = "";
			$clients->Client_Name->EditValue = ew_HtmlEncode($clients->Client_Name->CurrentValue);

			// Address
			$clients->Address->EditCustomAttributes = "";
			$clients->Address->EditValue = ew_HtmlEncode($clients->Address->CurrentValue);

			// Contact_No
			$clients->Contact_No->EditCustomAttributes = "";
			$clients->Contact_No->EditValue = ew_HtmlEncode($clients->Contact_No->CurrentValue);

			// Email_Address
			$clients->Email_Address->EditCustomAttributes = "";
			$clients->Email_Address->EditValue = ew_HtmlEncode($clients->Email_Address->CurrentValue);

			// TIN_No
			$clients->TIN_No->EditCustomAttributes = "";
			$clients->TIN_No->EditValue = ew_HtmlEncode($clients->TIN_No->CurrentValue);

			// Contact_Person
			$clients->Contact_Person->EditCustomAttributes = "";
			$clients->Contact_Person->EditValue = ew_HtmlEncode($clients->Contact_Person->CurrentValue);

			// File_Upload
			$clients->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->EditValue = $clients->File_Upload->Upload->DbValue;
			} else {
				$clients->File_Upload->EditValue = "";
			}

			// Remarks
			$clients->Remarks->EditCustomAttributes = "";
			$clients->Remarks->EditValue = ew_HtmlEncode($clients->Remarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($clients->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$clients->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $clients;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($clients->File_Upload->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($clients->File_Upload->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $clients->File_Upload->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

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
		global $conn, $Language, $Security, $clients;
		$rsnew = array();

		// Account_No
		$clients->Account_No->SetDbValueDef($rsnew, $clients->Account_No->CurrentValue, NULL, FALSE);

		// Alias
		$clients->Alias->SetDbValueDef($rsnew, $clients->Alias->CurrentValue, NULL, FALSE);

		// Client_Name
		$clients->Client_Name->SetDbValueDef($rsnew, $clients->Client_Name->CurrentValue, NULL, FALSE);

		// Address
		$clients->Address->SetDbValueDef($rsnew, $clients->Address->CurrentValue, NULL, FALSE);

		// Contact_No
		$clients->Contact_No->SetDbValueDef($rsnew, $clients->Contact_No->CurrentValue, NULL, FALSE);

		// Email_Address
		$clients->Email_Address->SetDbValueDef($rsnew, $clients->Email_Address->CurrentValue, NULL, FALSE);

		// TIN_No
		$clients->TIN_No->SetDbValueDef($rsnew, $clients->TIN_No->CurrentValue, NULL, FALSE);

		// Contact_Person
		$clients->Contact_Person->SetDbValueDef($rsnew, $clients->Contact_Person->CurrentValue, NULL, FALSE);

		// File_Upload
		$clients->File_Upload->Upload->SaveToSession(); // Save file value to Session
		if (is_null($clients->File_Upload->Upload->Value)) {
			$rsnew['File_Upload'] = NULL;
		} else {
			$rsnew['File_Upload'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $clients->File_Upload->UploadPath), $clients->File_Upload->Upload->FileName);
		}

		// Remarks
		$clients->Remarks->SetDbValueDef($rsnew, $clients->Remarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $clients->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($clients->File_Upload->Upload->Value)) {
				$clients->File_Upload->Upload->SaveToFile($clients->File_Upload->UploadPath, $rsnew['File_Upload'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($clients->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($clients->CancelMessage <> "") {
				$this->setMessage($clients->CancelMessage);
				$clients->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$clients->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $clients->id->DbValue;

			// Call Row Inserted event
			$clients->Row_Inserted($rsnew);
		}

		// File_Upload
		$clients->File_Upload->Upload->RemoveFromSession(); // Remove file value from Session
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
