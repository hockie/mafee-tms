<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "consigneesinfo.php" ?>
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
$consignees_add = new cconsignees_add();
$Page =& $consignees_add;

// Page init
$consignees_add->Page_Init();

// Page main
$consignees_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var consignees_add = new ew_Page("consignees_add");

// page properties
consignees_add.PageID = "add"; // page ID
consignees_add.FormID = "fconsigneesadd"; // form ID
var EW_PAGE_ID = consignees_add.PageID; // for backward compatibility

// extend page with ValidateForm function
consignees_add.ValidateForm = function(fobj) {
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
consignees_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
consignees_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consignees_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $consignees->TableCaption() ?><br><br>
<a href="<?php echo $consignees->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$consignees_add->ShowMessage();
?>
<form name="fconsigneesadd" id="fconsigneesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return consignees_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="consignees">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($consignees->client_id->Visible) { // client_id ?>
	<tr<?php echo $consignees->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->client_id->FldCaption() ?></td>
		<td<?php echo $consignees->client_id->CellAttributes() ?>><span id="el_client_id">
<select id="x_client_id" name="x_client_id" title="<?php echo $consignees->client_id->FldTitle() ?>"<?php echo $consignees->client_id->EditAttributes() ?>>
<?php
if (is_array($consignees->client_id->EditValue)) {
	$arwrk = $consignees->client_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($consignees->client_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $consignees->client_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consignees->Customer_No->Visible) { // Customer_No ?>
	<tr<?php echo $consignees->Customer_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Customer_No->FldCaption() ?></td>
		<td<?php echo $consignees->Customer_No->CellAttributes() ?>><span id="el_Customer_No">
<input type="text" name="x_Customer_No" id="x_Customer_No" title="<?php echo $consignees->Customer_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $consignees->Customer_No->EditValue ?>"<?php echo $consignees->Customer_No->EditAttributes() ?>>
</span><?php echo $consignees->Customer_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consignees->Customer_Name->Visible) { // Customer_Name ?>
	<tr<?php echo $consignees->Customer_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Customer_Name->FldCaption() ?></td>
		<td<?php echo $consignees->Customer_Name->CellAttributes() ?>><span id="el_Customer_Name">
<input type="text" name="x_Customer_Name" id="x_Customer_Name" title="<?php echo $consignees->Customer_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $consignees->Customer_Name->EditValue ?>"<?php echo $consignees->Customer_Name->EditAttributes() ?>>
</span><?php echo $consignees->Customer_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consignees->Address->Visible) { // Address ?>
	<tr<?php echo $consignees->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Address->FldCaption() ?></td>
		<td<?php echo $consignees->Address->CellAttributes() ?>><span id="el_Address">
<select id="x_Address" name="x_Address" title="<?php echo $consignees->Address->FldTitle() ?>"<?php echo $consignees->Address->EditAttributes() ?>>
<?php
if (is_array($consignees->Address->EditValue)) {
	$arwrk = $consignees->Address->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($consignees->Address->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $consignees->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consignees->Contact_Person->Visible) { // Contact_Person ?>
	<tr<?php echo $consignees->Contact_Person->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Contact_Person->FldCaption() ?></td>
		<td<?php echo $consignees->Contact_Person->CellAttributes() ?>><span id="el_Contact_Person">
<input type="text" name="x_Contact_Person" id="x_Contact_Person" title="<?php echo $consignees->Contact_Person->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $consignees->Contact_Person->EditValue ?>"<?php echo $consignees->Contact_Person->EditAttributes() ?>>
</span><?php echo $consignees->Contact_Person->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consignees->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $consignees->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Contact_No->FldCaption() ?></td>
		<td<?php echo $consignees->Contact_No->CellAttributes() ?>><span id="el_Contact_No">
<input type="text" name="x_Contact_No" id="x_Contact_No" title="<?php echo $consignees->Contact_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $consignees->Contact_No->EditValue ?>"<?php echo $consignees->Contact_No->EditAttributes() ?>>
</span><?php echo $consignees->Contact_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($consignees->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $consignees->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Remarks->FldCaption() ?></td>
		<td<?php echo $consignees->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $consignees->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $consignees->Remarks->EditAttributes() ?>><?php echo $consignees->Remarks->EditValue ?></textarea>
</span><?php echo $consignees->Remarks->CustomMsg ?></td>
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
$consignees_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cconsignees_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'consignees';

	// Page object name
	var $PageObjName = 'consignees_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $consignees;
		if ($consignees->UseTokenInUrl) $PageUrl .= "t=" . $consignees->TableVar . "&"; // Add page token
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
		global $objForm, $consignees;
		if ($consignees->UseTokenInUrl) {
			if ($objForm)
				return ($consignees->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($consignees->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconsignees_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (consignees)
		$GLOBALS["consignees"] = new cconsignees();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consignees', TRUE);

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
		global $consignees;

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
			$this->Page_Terminate("consigneeslist.php");
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
		global $objForm, $Language, $gsFormError, $consignees;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $consignees->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $consignees->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$consignees->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $consignees->CurrentAction = "C"; // Copy record
		  } else {
		    $consignees->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($consignees->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("consigneeslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$consignees->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $consignees->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$consignees->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $consignees;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $consignees;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $consignees;
		$consignees->client_id->setFormValue($objForm->GetValue("x_client_id"));
		$consignees->Customer_No->setFormValue($objForm->GetValue("x_Customer_No"));
		$consignees->Customer_Name->setFormValue($objForm->GetValue("x_Customer_Name"));
		$consignees->Address->setFormValue($objForm->GetValue("x_Address"));
		$consignees->Contact_Person->setFormValue($objForm->GetValue("x_Contact_Person"));
		$consignees->Contact_No->setFormValue($objForm->GetValue("x_Contact_No"));
		$consignees->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$consignees->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $consignees;
		$consignees->id->CurrentValue = $consignees->id->FormValue;
		$consignees->client_id->CurrentValue = $consignees->client_id->FormValue;
		$consignees->Customer_No->CurrentValue = $consignees->Customer_No->FormValue;
		$consignees->Customer_Name->CurrentValue = $consignees->Customer_Name->FormValue;
		$consignees->Address->CurrentValue = $consignees->Address->FormValue;
		$consignees->Contact_Person->CurrentValue = $consignees->Contact_Person->FormValue;
		$consignees->Contact_No->CurrentValue = $consignees->Contact_No->FormValue;
		$consignees->Remarks->CurrentValue = $consignees->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $consignees;
		$sFilter = $consignees->KeyFilter();

		// Call Row Selecting event
		$consignees->Row_Selecting($sFilter);

		// Load SQL based on filter
		$consignees->CurrentFilter = $sFilter;
		$sSql = $consignees->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$consignees->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $consignees;
		$consignees->id->setDbValue($rs->fields('id'));
		$consignees->client_id->setDbValue($rs->fields('client_id'));
		$consignees->Customer_No->setDbValue($rs->fields('Customer_No'));
		$consignees->Customer_Name->setDbValue($rs->fields('Customer_Name'));
		$consignees->Address->setDbValue($rs->fields('Address'));
		$consignees->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$consignees->Contact_No->setDbValue($rs->fields('Contact_No'));
		$consignees->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $consignees;

		// Initialize URLs
		// Call Row_Rendering event

		$consignees->Row_Rendering();

		// Common render codes for all row types
		// client_id

		$consignees->client_id->CellCssStyle = ""; $consignees->client_id->CellCssClass = "";
		$consignees->client_id->CellAttrs = array(); $consignees->client_id->ViewAttrs = array(); $consignees->client_id->EditAttrs = array();

		// Customer_No
		$consignees->Customer_No->CellCssStyle = ""; $consignees->Customer_No->CellCssClass = "";
		$consignees->Customer_No->CellAttrs = array(); $consignees->Customer_No->ViewAttrs = array(); $consignees->Customer_No->EditAttrs = array();

		// Customer_Name
		$consignees->Customer_Name->CellCssStyle = ""; $consignees->Customer_Name->CellCssClass = "";
		$consignees->Customer_Name->CellAttrs = array(); $consignees->Customer_Name->ViewAttrs = array(); $consignees->Customer_Name->EditAttrs = array();

		// Address
		$consignees->Address->CellCssStyle = ""; $consignees->Address->CellCssClass = "";
		$consignees->Address->CellAttrs = array(); $consignees->Address->ViewAttrs = array(); $consignees->Address->EditAttrs = array();

		// Contact_Person
		$consignees->Contact_Person->CellCssStyle = ""; $consignees->Contact_Person->CellCssClass = "";
		$consignees->Contact_Person->CellAttrs = array(); $consignees->Contact_Person->ViewAttrs = array(); $consignees->Contact_Person->EditAttrs = array();

		// Contact_No
		$consignees->Contact_No->CellCssStyle = ""; $consignees->Contact_No->CellCssClass = "";
		$consignees->Contact_No->CellAttrs = array(); $consignees->Contact_No->ViewAttrs = array(); $consignees->Contact_No->EditAttrs = array();

		// Remarks
		$consignees->Remarks->CellCssStyle = ""; $consignees->Remarks->CellCssClass = "";
		$consignees->Remarks->CellAttrs = array(); $consignees->Remarks->ViewAttrs = array(); $consignees->Remarks->EditAttrs = array();
		if ($consignees->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$consignees->id->ViewValue = $consignees->id->CurrentValue;
			$consignees->id->CssStyle = "";
			$consignees->id->CssClass = "";
			$consignees->id->ViewCustomAttributes = "";

			// client_id
			if (strval($consignees->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($consignees->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$consignees->client_id->ViewValue = $consignees->client_id->CurrentValue;
				}
			} else {
				$consignees->client_id->ViewValue = NULL;
			}
			$consignees->client_id->CssStyle = "";
			$consignees->client_id->CssClass = "";
			$consignees->client_id->ViewCustomAttributes = "";

			// Customer_No
			$consignees->Customer_No->ViewValue = $consignees->Customer_No->CurrentValue;
			$consignees->Customer_No->CssStyle = "";
			$consignees->Customer_No->CssClass = "";
			$consignees->Customer_No->ViewCustomAttributes = "";

			// Customer_Name
			$consignees->Customer_Name->ViewValue = $consignees->Customer_Name->CurrentValue;
			$consignees->Customer_Name->CssStyle = "";
			$consignees->Customer_Name->CssClass = "";
			$consignees->Customer_Name->ViewCustomAttributes = "";

			// Address
			if (strval($consignees->Address->CurrentValue) <> "") {
				$sFilterWrk = "`Destination` = '" . ew_AdjustSql($consignees->Address->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->Address->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$consignees->Address->ViewValue = $consignees->Address->CurrentValue;
				}
			} else {
				$consignees->Address->ViewValue = NULL;
			}
			$consignees->Address->CssStyle = "";
			$consignees->Address->CssClass = "";
			$consignees->Address->ViewCustomAttributes = "";

			// Contact_Person
			$consignees->Contact_Person->ViewValue = $consignees->Contact_Person->CurrentValue;
			$consignees->Contact_Person->CssStyle = "";
			$consignees->Contact_Person->CssClass = "";
			$consignees->Contact_Person->ViewCustomAttributes = "";

			// Contact_No
			$consignees->Contact_No->ViewValue = $consignees->Contact_No->CurrentValue;
			$consignees->Contact_No->CssStyle = "";
			$consignees->Contact_No->CssClass = "";
			$consignees->Contact_No->ViewCustomAttributes = "";

			// Remarks
			$consignees->Remarks->ViewValue = $consignees->Remarks->CurrentValue;
			$consignees->Remarks->CssStyle = "";
			$consignees->Remarks->CssClass = "";
			$consignees->Remarks->ViewCustomAttributes = "";

			// client_id
			$consignees->client_id->HrefValue = "";
			$consignees->client_id->TooltipValue = "";

			// Customer_No
			$consignees->Customer_No->HrefValue = "";
			$consignees->Customer_No->TooltipValue = "";

			// Customer_Name
			$consignees->Customer_Name->HrefValue = "";
			$consignees->Customer_Name->TooltipValue = "";

			// Address
			$consignees->Address->HrefValue = "";
			$consignees->Address->TooltipValue = "";

			// Contact_Person
			$consignees->Contact_Person->HrefValue = "";
			$consignees->Contact_Person->TooltipValue = "";

			// Contact_No
			$consignees->Contact_No->HrefValue = "";
			$consignees->Contact_No->TooltipValue = "";

			// Remarks
			$consignees->Remarks->HrefValue = "";
			$consignees->Remarks->TooltipValue = "";
		} elseif ($consignees->RowType == EW_ROWTYPE_ADD) { // Add row

			// client_id
			$consignees->client_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Client_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$consignees->client_id->EditValue = $arwrk;

			// Customer_No
			$consignees->Customer_No->EditCustomAttributes = "";
			$consignees->Customer_No->EditValue = ew_HtmlEncode($consignees->Customer_No->CurrentValue);

			// Customer_Name
			$consignees->Customer_Name->EditCustomAttributes = "";
			$consignees->Customer_Name->EditValue = ew_HtmlEncode($consignees->Customer_Name->CurrentValue);

			// Address
			$consignees->Address->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Destination`, `Destination`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$consignees->Address->EditValue = $arwrk;

			// Contact_Person
			$consignees->Contact_Person->EditCustomAttributes = "";
			$consignees->Contact_Person->EditValue = ew_HtmlEncode($consignees->Contact_Person->CurrentValue);

			// Contact_No
			$consignees->Contact_No->EditCustomAttributes = "";
			$consignees->Contact_No->EditValue = ew_HtmlEncode($consignees->Contact_No->CurrentValue);

			// Remarks
			$consignees->Remarks->EditCustomAttributes = "";
			$consignees->Remarks->EditValue = ew_HtmlEncode($consignees->Remarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($consignees->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$consignees->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $consignees;

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
		global $conn, $Language, $Security, $consignees;
		$rsnew = array();

		// client_id
		$consignees->client_id->SetDbValueDef($rsnew, $consignees->client_id->CurrentValue, NULL, FALSE);

		// Customer_No
		$consignees->Customer_No->SetDbValueDef($rsnew, $consignees->Customer_No->CurrentValue, NULL, FALSE);

		// Customer_Name
		$consignees->Customer_Name->SetDbValueDef($rsnew, $consignees->Customer_Name->CurrentValue, NULL, FALSE);

		// Address
		$consignees->Address->SetDbValueDef($rsnew, $consignees->Address->CurrentValue, NULL, FALSE);

		// Contact_Person
		$consignees->Contact_Person->SetDbValueDef($rsnew, $consignees->Contact_Person->CurrentValue, NULL, FALSE);

		// Contact_No
		$consignees->Contact_No->SetDbValueDef($rsnew, $consignees->Contact_No->CurrentValue, NULL, FALSE);

		// Remarks
		$consignees->Remarks->SetDbValueDef($rsnew, $consignees->Remarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $consignees->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($consignees->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($consignees->CancelMessage <> "") {
				$this->setMessage($consignees->CancelMessage);
				$consignees->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$consignees->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $consignees->id->DbValue;

			// Call Row Inserted event
			$consignees->Row_Inserted($rsnew);
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
