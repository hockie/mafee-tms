<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "companyinfo.php" ?>
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
$company_add = new ccompany_add();
$Page =& $company_add;

// Page init
$company_add->Page_Init();

// Page main
$company_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var company_add = new ew_Page("company_add");

// page properties
company_add.PageID = "add"; // page ID
company_add.FormID = "fcompanyadd"; // form ID
var EW_PAGE_ID = company_add.PageID; // for backward compatibility

// extend page with ValidateForm function
company_add.ValidateForm = function(fobj) {
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
company_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
company_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
company_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
company_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $company->TableCaption() ?><br><br>
<a href="<?php echo $company->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$company_add->ShowMessage();
?>
<form name="fcompanyadd" id="fcompanyadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return company_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="company">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($company->Company_Name->Visible) { // Company_Name ?>
	<tr<?php echo $company->Company_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Company_Name->FldCaption() ?></td>
		<td<?php echo $company->Company_Name->CellAttributes() ?>><span id="el_Company_Name">
<input type="text" name="x_Company_Name" id="x_Company_Name" title="<?php echo $company->Company_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $company->Company_Name->EditValue ?>"<?php echo $company->Company_Name->EditAttributes() ?>>
</span><?php echo $company->Company_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($company->Main_Address->Visible) { // Main_Address ?>
	<tr<?php echo $company->Main_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Main_Address->FldCaption() ?></td>
		<td<?php echo $company->Main_Address->CellAttributes() ?>><span id="el_Main_Address">
<textarea name="x_Main_Address" id="x_Main_Address" title="<?php echo $company->Main_Address->FldTitle() ?>" cols="35" rows="4"<?php echo $company->Main_Address->EditAttributes() ?>><?php echo $company->Main_Address->EditValue ?></textarea>
</span><?php echo $company->Main_Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($company->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $company->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Contact_No->FldCaption() ?></td>
		<td<?php echo $company->Contact_No->CellAttributes() ?>><span id="el_Contact_No">
<input type="text" name="x_Contact_No" id="x_Contact_No" title="<?php echo $company->Contact_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $company->Contact_No->EditValue ?>"<?php echo $company->Contact_No->EditAttributes() ?>>
</span><?php echo $company->Contact_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($company->Email_Address->Visible) { // Email_Address ?>
	<tr<?php echo $company->Email_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Email_Address->FldCaption() ?></td>
		<td<?php echo $company->Email_Address->CellAttributes() ?>><span id="el_Email_Address">
<input type="text" name="x_Email_Address" id="x_Email_Address" title="<?php echo $company->Email_Address->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $company->Email_Address->EditValue ?>"<?php echo $company->Email_Address->EditAttributes() ?>>
</span><?php echo $company->Email_Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($company->Website->Visible) { // Website ?>
	<tr<?php echo $company->Website->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Website->FldCaption() ?></td>
		<td<?php echo $company->Website->CellAttributes() ?>><span id="el_Website">
<input type="text" name="x_Website" id="x_Website" title="<?php echo $company->Website->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $company->Website->EditValue ?>"<?php echo $company->Website->EditAttributes() ?>>
</span><?php echo $company->Website->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($company->TIN_No->Visible) { // TIN_No ?>
	<tr<?php echo $company->TIN_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->TIN_No->FldCaption() ?></td>
		<td<?php echo $company->TIN_No->CellAttributes() ?>><span id="el_TIN_No">
<input type="text" name="x_TIN_No" id="x_TIN_No" title="<?php echo $company->TIN_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $company->TIN_No->EditValue ?>"<?php echo $company->TIN_No->EditAttributes() ?>>
</span><?php echo $company->TIN_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($company->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $company->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->File_Upload->FldCaption() ?></td>
		<td<?php echo $company->File_Upload->CellAttributes() ?>><span id="el_File_Upload">
<input type="file" name="x_File_Upload" id="x_File_Upload" title="<?php echo $company->File_Upload->FldTitle() ?>" size="30"<?php echo $company->File_Upload->EditAttributes() ?>>
</div>
</span><?php echo $company->File_Upload->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($company->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $company->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $company->Remarks->FldCaption() ?></td>
		<td<?php echo $company->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $company->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $company->Remarks->EditAttributes() ?>><?php echo $company->Remarks->EditValue ?></textarea>
</span><?php echo $company->Remarks->CustomMsg ?></td>
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
$company_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccompany_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'company';

	// Page object name
	var $PageObjName = 'company_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $company;
		if ($company->UseTokenInUrl) $PageUrl .= "t=" . $company->TableVar . "&"; // Add page token
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
		global $objForm, $company;
		if ($company->UseTokenInUrl) {
			if ($objForm)
				return ($company->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($company->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccompany_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (company)
		$GLOBALS["company"] = new ccompany();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'company', TRUE);

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
		global $company;

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
			$this->Page_Terminate("companylist.php");
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
		global $objForm, $Language, $gsFormError, $company;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $company->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $company->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$company->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $company->CurrentAction = "C"; // Copy record
		  } else {
		    $company->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($company->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("companylist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$company->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $company->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$company->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $company;

		// Get upload data
			if ($company->File_Upload->Upload->UploadFile()) {

				// No action required
			} else {
				echo $company->File_Upload->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $company;
		$company->File_Upload->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $company;
		$company->Company_Name->setFormValue($objForm->GetValue("x_Company_Name"));
		$company->Main_Address->setFormValue($objForm->GetValue("x_Main_Address"));
		$company->Contact_No->setFormValue($objForm->GetValue("x_Contact_No"));
		$company->Email_Address->setFormValue($objForm->GetValue("x_Email_Address"));
		$company->Website->setFormValue($objForm->GetValue("x_Website"));
		$company->TIN_No->setFormValue($objForm->GetValue("x_TIN_No"));
		$company->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$company->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $company;
		$company->id->CurrentValue = $company->id->FormValue;
		$company->Company_Name->CurrentValue = $company->Company_Name->FormValue;
		$company->Main_Address->CurrentValue = $company->Main_Address->FormValue;
		$company->Contact_No->CurrentValue = $company->Contact_No->FormValue;
		$company->Email_Address->CurrentValue = $company->Email_Address->FormValue;
		$company->Website->CurrentValue = $company->Website->FormValue;
		$company->TIN_No->CurrentValue = $company->TIN_No->FormValue;
		$company->Remarks->CurrentValue = $company->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $company;
		$sFilter = $company->KeyFilter();

		// Call Row Selecting event
		$company->Row_Selecting($sFilter);

		// Load SQL based on filter
		$company->CurrentFilter = $sFilter;
		$sSql = $company->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$company->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $company;
		$company->id->setDbValue($rs->fields('id'));
		$company->Company_Name->setDbValue($rs->fields('Company_Name'));
		$company->Main_Address->setDbValue($rs->fields('Main_Address'));
		$company->Contact_No->setDbValue($rs->fields('Contact_No'));
		$company->Email_Address->setDbValue($rs->fields('Email_Address'));
		$company->Website->setDbValue($rs->fields('Website'));
		$company->TIN_No->setDbValue($rs->fields('TIN_No'));
		$company->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$company->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $company;

		// Initialize URLs
		// Call Row_Rendering event

		$company->Row_Rendering();

		// Common render codes for all row types
		// Company_Name

		$company->Company_Name->CellCssStyle = ""; $company->Company_Name->CellCssClass = "";
		$company->Company_Name->CellAttrs = array(); $company->Company_Name->ViewAttrs = array(); $company->Company_Name->EditAttrs = array();

		// Main_Address
		$company->Main_Address->CellCssStyle = ""; $company->Main_Address->CellCssClass = "";
		$company->Main_Address->CellAttrs = array(); $company->Main_Address->ViewAttrs = array(); $company->Main_Address->EditAttrs = array();

		// Contact_No
		$company->Contact_No->CellCssStyle = ""; $company->Contact_No->CellCssClass = "";
		$company->Contact_No->CellAttrs = array(); $company->Contact_No->ViewAttrs = array(); $company->Contact_No->EditAttrs = array();

		// Email_Address
		$company->Email_Address->CellCssStyle = ""; $company->Email_Address->CellCssClass = "";
		$company->Email_Address->CellAttrs = array(); $company->Email_Address->ViewAttrs = array(); $company->Email_Address->EditAttrs = array();

		// Website
		$company->Website->CellCssStyle = ""; $company->Website->CellCssClass = "";
		$company->Website->CellAttrs = array(); $company->Website->ViewAttrs = array(); $company->Website->EditAttrs = array();

		// TIN_No
		$company->TIN_No->CellCssStyle = ""; $company->TIN_No->CellCssClass = "";
		$company->TIN_No->CellAttrs = array(); $company->TIN_No->ViewAttrs = array(); $company->TIN_No->EditAttrs = array();

		// File_Upload
		$company->File_Upload->CellCssStyle = ""; $company->File_Upload->CellCssClass = "";
		$company->File_Upload->CellAttrs = array(); $company->File_Upload->ViewAttrs = array(); $company->File_Upload->EditAttrs = array();

		// Remarks
		$company->Remarks->CellCssStyle = ""; $company->Remarks->CellCssClass = "";
		$company->Remarks->CellAttrs = array(); $company->Remarks->ViewAttrs = array(); $company->Remarks->EditAttrs = array();
		if ($company->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$company->id->ViewValue = $company->id->CurrentValue;
			$company->id->CssStyle = "";
			$company->id->CssClass = "";
			$company->id->ViewCustomAttributes = "";

			// Company_Name
			$company->Company_Name->ViewValue = $company->Company_Name->CurrentValue;
			$company->Company_Name->CssStyle = "";
			$company->Company_Name->CssClass = "";
			$company->Company_Name->ViewCustomAttributes = "";

			// Main_Address
			$company->Main_Address->ViewValue = $company->Main_Address->CurrentValue;
			$company->Main_Address->CssStyle = "";
			$company->Main_Address->CssClass = "";
			$company->Main_Address->ViewCustomAttributes = "";

			// Contact_No
			$company->Contact_No->ViewValue = $company->Contact_No->CurrentValue;
			$company->Contact_No->CssStyle = "";
			$company->Contact_No->CssClass = "";
			$company->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$company->Email_Address->ViewValue = $company->Email_Address->CurrentValue;
			$company->Email_Address->CssStyle = "";
			$company->Email_Address->CssClass = "";
			$company->Email_Address->ViewCustomAttributes = "";

			// Website
			$company->Website->ViewValue = $company->Website->CurrentValue;
			$company->Website->CssStyle = "";
			$company->Website->CssClass = "";
			$company->Website->ViewCustomAttributes = "";

			// TIN_No
			$company->TIN_No->ViewValue = $company->TIN_No->CurrentValue;
			$company->TIN_No->CssStyle = "";
			$company->TIN_No->CssClass = "";
			$company->TIN_No->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->ViewValue = $company->File_Upload->Upload->DbValue;
			} else {
				$company->File_Upload->ViewValue = "";
			}
			$company->File_Upload->CssStyle = "";
			$company->File_Upload->CssClass = "";
			$company->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$company->Remarks->ViewValue = $company->Remarks->CurrentValue;
			$company->Remarks->CssStyle = "";
			$company->Remarks->CssClass = "";
			$company->Remarks->ViewCustomAttributes = "";

			// Company_Name
			$company->Company_Name->HrefValue = "";
			$company->Company_Name->TooltipValue = "";

			// Main_Address
			$company->Main_Address->HrefValue = "";
			$company->Main_Address->TooltipValue = "";

			// Contact_No
			$company->Contact_No->HrefValue = "";
			$company->Contact_No->TooltipValue = "";

			// Email_Address
			$company->Email_Address->HrefValue = "";
			$company->Email_Address->TooltipValue = "";

			// Website
			$company->Website->HrefValue = "";
			$company->Website->TooltipValue = "";

			// TIN_No
			$company->TIN_No->HrefValue = "";
			$company->TIN_No->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $company->File_Upload->UploadPath) . ((!empty($company->File_Upload->ViewValue)) ? $company->File_Upload->ViewValue : $company->File_Upload->CurrentValue);
				if ($company->Export <> "") $company->File_Upload->HrefValue = ew_ConvertFullUrl($company->File_Upload->HrefValue);
			} else {
				$company->File_Upload->HrefValue = "";
			}
			$company->File_Upload->TooltipValue = "";

			// Remarks
			$company->Remarks->HrefValue = "";
			$company->Remarks->TooltipValue = "";
		} elseif ($company->RowType == EW_ROWTYPE_ADD) { // Add row

			// Company_Name
			$company->Company_Name->EditCustomAttributes = "";
			$company->Company_Name->EditValue = ew_HtmlEncode($company->Company_Name->CurrentValue);

			// Main_Address
			$company->Main_Address->EditCustomAttributes = "";
			$company->Main_Address->EditValue = ew_HtmlEncode($company->Main_Address->CurrentValue);

			// Contact_No
			$company->Contact_No->EditCustomAttributes = "";
			$company->Contact_No->EditValue = ew_HtmlEncode($company->Contact_No->CurrentValue);

			// Email_Address
			$company->Email_Address->EditCustomAttributes = "";
			$company->Email_Address->EditValue = ew_HtmlEncode($company->Email_Address->CurrentValue);

			// Website
			$company->Website->EditCustomAttributes = "";
			$company->Website->EditValue = ew_HtmlEncode($company->Website->CurrentValue);

			// TIN_No
			$company->TIN_No->EditCustomAttributes = "";
			$company->TIN_No->EditValue = ew_HtmlEncode($company->TIN_No->CurrentValue);

			// File_Upload
			$company->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->EditValue = $company->File_Upload->Upload->DbValue;
			} else {
				$company->File_Upload->EditValue = "";
			}

			// Remarks
			$company->Remarks->EditCustomAttributes = "";
			$company->Remarks->EditValue = ew_HtmlEncode($company->Remarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($company->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$company->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $company;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($company->File_Upload->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($company->File_Upload->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $company->File_Upload->Upload->FileSize > EW_MAX_FILE_SIZE) {
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
		global $conn, $Language, $Security, $company;
		$rsnew = array();

		// Company_Name
		$company->Company_Name->SetDbValueDef($rsnew, $company->Company_Name->CurrentValue, NULL, FALSE);

		// Main_Address
		$company->Main_Address->SetDbValueDef($rsnew, $company->Main_Address->CurrentValue, NULL, FALSE);

		// Contact_No
		$company->Contact_No->SetDbValueDef($rsnew, $company->Contact_No->CurrentValue, NULL, FALSE);

		// Email_Address
		$company->Email_Address->SetDbValueDef($rsnew, $company->Email_Address->CurrentValue, NULL, FALSE);

		// Website
		$company->Website->SetDbValueDef($rsnew, $company->Website->CurrentValue, NULL, FALSE);

		// TIN_No
		$company->TIN_No->SetDbValueDef($rsnew, $company->TIN_No->CurrentValue, NULL, FALSE);

		// File_Upload
		$company->File_Upload->Upload->SaveToSession(); // Save file value to Session
		if (is_null($company->File_Upload->Upload->Value)) {
			$rsnew['File_Upload'] = NULL;
		} else {
			$rsnew['File_Upload'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $company->File_Upload->UploadPath), $company->File_Upload->Upload->FileName);
		}

		// Remarks
		$company->Remarks->SetDbValueDef($rsnew, $company->Remarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $company->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($company->File_Upload->Upload->Value)) {
				$company->File_Upload->Upload->SaveToFile($company->File_Upload->UploadPath, $rsnew['File_Upload'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($company->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($company->CancelMessage <> "") {
				$this->setMessage($company->CancelMessage);
				$company->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$company->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $company->id->DbValue;

			// Call Row Inserted event
			$company->Row_Inserted($rsnew);
		}

		// File_Upload
		$company->File_Upload->Upload->RemoveFromSession(); // Remove file value from Session
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
