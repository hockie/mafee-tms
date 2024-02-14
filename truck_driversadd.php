<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "truck_driversinfo.php" ?>
<?php include "subconsinfo.php" ?>
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
$truck_drivers_add = new ctruck_drivers_add();
$Page =& $truck_drivers_add;

// Page init
$truck_drivers_add->Page_Init();

// Page main
$truck_drivers_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var truck_drivers_add = new ew_Page("truck_drivers_add");

// page properties
truck_drivers_add.PageID = "add"; // page ID
truck_drivers_add.FormID = "ftruck_driversadd"; // form ID
var EW_PAGE_ID = truck_drivers_add.PageID; // for backward compatibility

// extend page with ValidateForm function
truck_drivers_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Subcon_ID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($truck_drivers->Subcon_ID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Truck_Driver"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($truck_drivers->Truck_Driver->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Address"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($truck_drivers->Address->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Contact_No"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($truck_drivers->Contact_No->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Email_Address"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($truck_drivers->Email_Address->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_Driver_License_No"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($truck_drivers->Driver_License_No->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_License_Expiration_Date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($truck_drivers->License_Expiration_Date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_License_Expiration_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($truck_drivers->License_Expiration_Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_File_Upload"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
truck_drivers_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
truck_drivers_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
truck_drivers_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $truck_drivers->TableCaption() ?><br><br>
<a href="<?php echo $truck_drivers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$truck_drivers_add->ShowMessage();
?>
<form name="ftruck_driversadd" id="ftruck_driversadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return truck_drivers_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="truck_drivers">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($truck_drivers->Subcon_ID->Visible) { // Subcon_ID ?>
	<tr<?php echo $truck_drivers->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->Subcon_ID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $truck_drivers->Subcon_ID->CellAttributes() ?>><span id="el_Subcon_ID">
<?php if ($truck_drivers->Subcon_ID->getSessionValue() <> "") { ?>
<div<?php echo $truck_drivers->Subcon_ID->ViewAttributes() ?>><?php echo $truck_drivers->Subcon_ID->ViewValue ?></div>
<input type="hidden" id="x_Subcon_ID" name="x_Subcon_ID" value="<?php echo ew_HtmlEncode($truck_drivers->Subcon_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Subcon_ID" name="x_Subcon_ID" title="<?php echo $truck_drivers->Subcon_ID->FldTitle() ?>"<?php echo $truck_drivers->Subcon_ID->EditAttributes() ?>>
<?php
if (is_array($truck_drivers->Subcon_ID->EditValue)) {
	$arwrk = $truck_drivers->Subcon_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($truck_drivers->Subcon_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span><?php echo $truck_drivers->Subcon_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_drivers->Truck_Driver->Visible) { // Truck_Driver ?>
	<tr<?php echo $truck_drivers->Truck_Driver->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->Truck_Driver->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $truck_drivers->Truck_Driver->CellAttributes() ?>><span id="el_Truck_Driver">
<input type="text" name="x_Truck_Driver" id="x_Truck_Driver" title="<?php echo $truck_drivers->Truck_Driver->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $truck_drivers->Truck_Driver->EditValue ?>"<?php echo $truck_drivers->Truck_Driver->EditAttributes() ?>>
</span><?php echo $truck_drivers->Truck_Driver->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_drivers->Address->Visible) { // Address ?>
	<tr<?php echo $truck_drivers->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->Address->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $truck_drivers->Address->CellAttributes() ?>><span id="el_Address">
<input type="text" name="x_Address" id="x_Address" title="<?php echo $truck_drivers->Address->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $truck_drivers->Address->EditValue ?>"<?php echo $truck_drivers->Address->EditAttributes() ?>>
</span><?php echo $truck_drivers->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_drivers->Contact_No->Visible) { // Contact_No ?>
	<tr<?php echo $truck_drivers->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->Contact_No->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $truck_drivers->Contact_No->CellAttributes() ?>><span id="el_Contact_No">
<input type="text" name="x_Contact_No" id="x_Contact_No" title="<?php echo $truck_drivers->Contact_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $truck_drivers->Contact_No->EditValue ?>"<?php echo $truck_drivers->Contact_No->EditAttributes() ?>>
</span><?php echo $truck_drivers->Contact_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_drivers->Email_Address->Visible) { // Email_Address ?>
	<tr<?php echo $truck_drivers->Email_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->Email_Address->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $truck_drivers->Email_Address->CellAttributes() ?>><span id="el_Email_Address">
<input type="text" name="x_Email_Address" id="x_Email_Address" title="<?php echo $truck_drivers->Email_Address->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $truck_drivers->Email_Address->EditValue ?>"<?php echo $truck_drivers->Email_Address->EditAttributes() ?>>
</span><?php echo $truck_drivers->Email_Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_drivers->Driver_License_No->Visible) { // Driver_License_No ?>
	<tr<?php echo $truck_drivers->Driver_License_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->Driver_License_No->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $truck_drivers->Driver_License_No->CellAttributes() ?>><span id="el_Driver_License_No">
<input type="text" name="x_Driver_License_No" id="x_Driver_License_No" title="<?php echo $truck_drivers->Driver_License_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $truck_drivers->Driver_License_No->EditValue ?>"<?php echo $truck_drivers->Driver_License_No->EditAttributes() ?>>
</span><?php echo $truck_drivers->Driver_License_No->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_drivers->License_Expiration_Date->Visible) { // License_Expiration_Date ?>
	<tr<?php echo $truck_drivers->License_Expiration_Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->License_Expiration_Date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $truck_drivers->License_Expiration_Date->CellAttributes() ?>><span id="el_License_Expiration_Date">
<input type="text" name="x_License_Expiration_Date" id="x_License_Expiration_Date" title="<?php echo $truck_drivers->License_Expiration_Date->FldTitle() ?>" value="<?php echo $truck_drivers->License_Expiration_Date->EditValue ?>"<?php echo $truck_drivers->License_Expiration_Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_License_Expiration_Date" name="cal_x_License_Expiration_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_License_Expiration_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_License_Expiration_Date" // button id
});
</script>
</span><?php echo $truck_drivers->License_Expiration_Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_drivers->File_Upload->Visible) { // File_Upload ?>
	<tr<?php echo $truck_drivers->File_Upload->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->File_Upload->FldCaption() ?></td>
		<td<?php echo $truck_drivers->File_Upload->CellAttributes() ?>><span id="el_File_Upload">
<input type="file" name="x_File_Upload" id="x_File_Upload" title="<?php echo $truck_drivers->File_Upload->FldTitle() ?>" size="30"<?php echo $truck_drivers->File_Upload->EditAttributes() ?>>
</div>
</span><?php echo $truck_drivers->File_Upload->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($truck_drivers->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $truck_drivers->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $truck_drivers->Remarks->FldCaption() ?></td>
		<td<?php echo $truck_drivers->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $truck_drivers->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $truck_drivers->Remarks->EditAttributes() ?>><?php echo $truck_drivers->Remarks->EditValue ?></textarea>
</span><?php echo $truck_drivers->Remarks->CustomMsg ?></td>
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
$truck_drivers_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctruck_drivers_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'truck_drivers';

	// Page object name
	var $PageObjName = 'truck_drivers_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $truck_drivers;
		if ($truck_drivers->UseTokenInUrl) $PageUrl .= "t=" . $truck_drivers->TableVar . "&"; // Add page token
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
		global $objForm, $truck_drivers;
		if ($truck_drivers->UseTokenInUrl) {
			if ($objForm)
				return ($truck_drivers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($truck_drivers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctruck_drivers_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (truck_drivers)
		$GLOBALS["truck_drivers"] = new ctruck_drivers();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'truck_drivers', TRUE);

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
		global $truck_drivers;

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
			$this->Page_Terminate("truck_driverslist.php");
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
		global $objForm, $Language, $gsFormError, $truck_drivers;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $truck_drivers->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $truck_drivers->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$truck_drivers->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $truck_drivers->CurrentAction = "C"; // Copy record
		  } else {
		    $truck_drivers->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($truck_drivers->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("truck_driverslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$truck_drivers->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $truck_drivers->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$truck_drivers->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $truck_drivers;

		// Get upload data
			if ($truck_drivers->File_Upload->Upload->UploadFile()) {

				// No action required
			} else {
				echo $truck_drivers->File_Upload->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $truck_drivers;
		$truck_drivers->File_Upload->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $truck_drivers;
		$truck_drivers->Subcon_ID->setFormValue($objForm->GetValue("x_Subcon_ID"));
		$truck_drivers->Truck_Driver->setFormValue($objForm->GetValue("x_Truck_Driver"));
		$truck_drivers->Address->setFormValue($objForm->GetValue("x_Address"));
		$truck_drivers->Contact_No->setFormValue($objForm->GetValue("x_Contact_No"));
		$truck_drivers->Email_Address->setFormValue($objForm->GetValue("x_Email_Address"));
		$truck_drivers->Driver_License_No->setFormValue($objForm->GetValue("x_Driver_License_No"));
		$truck_drivers->License_Expiration_Date->setFormValue($objForm->GetValue("x_License_Expiration_Date"));
		$truck_drivers->License_Expiration_Date->CurrentValue = ew_UnFormatDateTime($truck_drivers->License_Expiration_Date->CurrentValue, 6);
		$truck_drivers->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$truck_drivers->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $truck_drivers;
		$truck_drivers->id->CurrentValue = $truck_drivers->id->FormValue;
		$truck_drivers->Subcon_ID->CurrentValue = $truck_drivers->Subcon_ID->FormValue;
		$truck_drivers->Truck_Driver->CurrentValue = $truck_drivers->Truck_Driver->FormValue;
		$truck_drivers->Address->CurrentValue = $truck_drivers->Address->FormValue;
		$truck_drivers->Contact_No->CurrentValue = $truck_drivers->Contact_No->FormValue;
		$truck_drivers->Email_Address->CurrentValue = $truck_drivers->Email_Address->FormValue;
		$truck_drivers->Driver_License_No->CurrentValue = $truck_drivers->Driver_License_No->FormValue;
		$truck_drivers->License_Expiration_Date->CurrentValue = $truck_drivers->License_Expiration_Date->FormValue;
		$truck_drivers->License_Expiration_Date->CurrentValue = ew_UnFormatDateTime($truck_drivers->License_Expiration_Date->CurrentValue, 6);
		$truck_drivers->Remarks->CurrentValue = $truck_drivers->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $truck_drivers;
		$sFilter = $truck_drivers->KeyFilter();

		// Call Row Selecting event
		$truck_drivers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$truck_drivers->CurrentFilter = $sFilter;
		$sSql = $truck_drivers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$truck_drivers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $truck_drivers;
		$truck_drivers->id->setDbValue($rs->fields('id'));
		$truck_drivers->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$truck_drivers->Truck_Driver->setDbValue($rs->fields('Truck_Driver'));
		$truck_drivers->Address->setDbValue($rs->fields('Address'));
		$truck_drivers->Contact_No->setDbValue($rs->fields('Contact_No'));
		$truck_drivers->Email_Address->setDbValue($rs->fields('Email_Address'));
		$truck_drivers->Driver_License_No->setDbValue($rs->fields('Driver_License_No'));
		$truck_drivers->License_Expiration_Date->setDbValue($rs->fields('License_Expiration_Date'));
		$truck_drivers->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$truck_drivers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $truck_drivers;

		// Initialize URLs
		// Call Row_Rendering event

		$truck_drivers->Row_Rendering();

		// Common render codes for all row types
		// Subcon_ID

		$truck_drivers->Subcon_ID->CellCssStyle = ""; $truck_drivers->Subcon_ID->CellCssClass = "";
		$truck_drivers->Subcon_ID->CellAttrs = array(); $truck_drivers->Subcon_ID->ViewAttrs = array(); $truck_drivers->Subcon_ID->EditAttrs = array();

		// Truck_Driver
		$truck_drivers->Truck_Driver->CellCssStyle = ""; $truck_drivers->Truck_Driver->CellCssClass = "";
		$truck_drivers->Truck_Driver->CellAttrs = array(); $truck_drivers->Truck_Driver->ViewAttrs = array(); $truck_drivers->Truck_Driver->EditAttrs = array();

		// Address
		$truck_drivers->Address->CellCssStyle = ""; $truck_drivers->Address->CellCssClass = "";
		$truck_drivers->Address->CellAttrs = array(); $truck_drivers->Address->ViewAttrs = array(); $truck_drivers->Address->EditAttrs = array();

		// Contact_No
		$truck_drivers->Contact_No->CellCssStyle = ""; $truck_drivers->Contact_No->CellCssClass = "";
		$truck_drivers->Contact_No->CellAttrs = array(); $truck_drivers->Contact_No->ViewAttrs = array(); $truck_drivers->Contact_No->EditAttrs = array();

		// Email_Address
		$truck_drivers->Email_Address->CellCssStyle = ""; $truck_drivers->Email_Address->CellCssClass = "";
		$truck_drivers->Email_Address->CellAttrs = array(); $truck_drivers->Email_Address->ViewAttrs = array(); $truck_drivers->Email_Address->EditAttrs = array();

		// Driver_License_No
		$truck_drivers->Driver_License_No->CellCssStyle = ""; $truck_drivers->Driver_License_No->CellCssClass = "";
		$truck_drivers->Driver_License_No->CellAttrs = array(); $truck_drivers->Driver_License_No->ViewAttrs = array(); $truck_drivers->Driver_License_No->EditAttrs = array();

		// License_Expiration_Date
		$truck_drivers->License_Expiration_Date->CellCssStyle = ""; $truck_drivers->License_Expiration_Date->CellCssClass = "";
		$truck_drivers->License_Expiration_Date->CellAttrs = array(); $truck_drivers->License_Expiration_Date->ViewAttrs = array(); $truck_drivers->License_Expiration_Date->EditAttrs = array();

		// File_Upload
		$truck_drivers->File_Upload->CellCssStyle = ""; $truck_drivers->File_Upload->CellCssClass = "";
		$truck_drivers->File_Upload->CellAttrs = array(); $truck_drivers->File_Upload->ViewAttrs = array(); $truck_drivers->File_Upload->EditAttrs = array();

		// Remarks
		$truck_drivers->Remarks->CellCssStyle = ""; $truck_drivers->Remarks->CellCssClass = "";
		$truck_drivers->Remarks->CellAttrs = array(); $truck_drivers->Remarks->ViewAttrs = array(); $truck_drivers->Remarks->EditAttrs = array();
		if ($truck_drivers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$truck_drivers->id->ViewValue = $truck_drivers->id->CurrentValue;
			$truck_drivers->id->CssStyle = "";
			$truck_drivers->id->CssClass = "";
			$truck_drivers->id->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($truck_drivers->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($truck_drivers->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$truck_drivers->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$truck_drivers->Subcon_ID->ViewValue = $truck_drivers->Subcon_ID->CurrentValue;
				}
			} else {
				$truck_drivers->Subcon_ID->ViewValue = NULL;
			}
			$truck_drivers->Subcon_ID->CssStyle = "";
			$truck_drivers->Subcon_ID->CssClass = "";
			$truck_drivers->Subcon_ID->ViewCustomAttributes = "";

			// Truck_Driver
			$truck_drivers->Truck_Driver->ViewValue = $truck_drivers->Truck_Driver->CurrentValue;
			$truck_drivers->Truck_Driver->CssStyle = "";
			$truck_drivers->Truck_Driver->CssClass = "";
			$truck_drivers->Truck_Driver->ViewCustomAttributes = "";

			// Address
			$truck_drivers->Address->ViewValue = $truck_drivers->Address->CurrentValue;
			$truck_drivers->Address->CssStyle = "";
			$truck_drivers->Address->CssClass = "";
			$truck_drivers->Address->ViewCustomAttributes = "";

			// Contact_No
			$truck_drivers->Contact_No->ViewValue = $truck_drivers->Contact_No->CurrentValue;
			$truck_drivers->Contact_No->CssStyle = "";
			$truck_drivers->Contact_No->CssClass = "";
			$truck_drivers->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$truck_drivers->Email_Address->ViewValue = $truck_drivers->Email_Address->CurrentValue;
			$truck_drivers->Email_Address->CssStyle = "";
			$truck_drivers->Email_Address->CssClass = "";
			$truck_drivers->Email_Address->ViewCustomAttributes = "";

			// Driver_License_No
			$truck_drivers->Driver_License_No->ViewValue = $truck_drivers->Driver_License_No->CurrentValue;
			$truck_drivers->Driver_License_No->CssStyle = "";
			$truck_drivers->Driver_License_No->CssClass = "";
			$truck_drivers->Driver_License_No->ViewCustomAttributes = "";

			// License_Expiration_Date
			$truck_drivers->License_Expiration_Date->ViewValue = $truck_drivers->License_Expiration_Date->CurrentValue;
			$truck_drivers->License_Expiration_Date->ViewValue = ew_FormatDateTime($truck_drivers->License_Expiration_Date->ViewValue, 6);
			$truck_drivers->License_Expiration_Date->CssStyle = "";
			$truck_drivers->License_Expiration_Date->CssClass = "";
			$truck_drivers->License_Expiration_Date->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($truck_drivers->File_Upload->Upload->DbValue)) {
				$truck_drivers->File_Upload->ViewValue = $truck_drivers->File_Upload->Upload->DbValue;
			} else {
				$truck_drivers->File_Upload->ViewValue = "";
			}
			$truck_drivers->File_Upload->CssStyle = "";
			$truck_drivers->File_Upload->CssClass = "";
			$truck_drivers->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$truck_drivers->Remarks->ViewValue = $truck_drivers->Remarks->CurrentValue;
			$truck_drivers->Remarks->CssStyle = "";
			$truck_drivers->Remarks->CssClass = "";
			$truck_drivers->Remarks->ViewCustomAttributes = "";

			// Subcon_ID
			$truck_drivers->Subcon_ID->HrefValue = "";
			$truck_drivers->Subcon_ID->TooltipValue = "";

			// Truck_Driver
			$truck_drivers->Truck_Driver->HrefValue = "";
			$truck_drivers->Truck_Driver->TooltipValue = "";

			// Address
			$truck_drivers->Address->HrefValue = "";
			$truck_drivers->Address->TooltipValue = "";

			// Contact_No
			$truck_drivers->Contact_No->HrefValue = "";
			$truck_drivers->Contact_No->TooltipValue = "";

			// Email_Address
			$truck_drivers->Email_Address->HrefValue = "";
			$truck_drivers->Email_Address->TooltipValue = "";

			// Driver_License_No
			$truck_drivers->Driver_License_No->HrefValue = "";
			$truck_drivers->Driver_License_No->TooltipValue = "";

			// License_Expiration_Date
			$truck_drivers->License_Expiration_Date->HrefValue = "";
			$truck_drivers->License_Expiration_Date->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($truck_drivers->File_Upload->Upload->DbValue)) {
				$truck_drivers->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $truck_drivers->File_Upload->UploadPath) . ((!empty($truck_drivers->File_Upload->ViewValue)) ? $truck_drivers->File_Upload->ViewValue : $truck_drivers->File_Upload->CurrentValue);
				if ($truck_drivers->Export <> "") $truck_drivers->File_Upload->HrefValue = ew_ConvertFullUrl($truck_drivers->File_Upload->HrefValue);
			} else {
				$truck_drivers->File_Upload->HrefValue = "";
			}
			$truck_drivers->File_Upload->TooltipValue = "";

			// Remarks
			$truck_drivers->Remarks->HrefValue = "";
			$truck_drivers->Remarks->TooltipValue = "";
		} elseif ($truck_drivers->RowType == EW_ROWTYPE_ADD) { // Add row

			// Subcon_ID
			$truck_drivers->Subcon_ID->EditCustomAttributes = "";
			if ($truck_drivers->Subcon_ID->getSessionValue() <> "") {
				$truck_drivers->Subcon_ID->CurrentValue = $truck_drivers->Subcon_ID->getSessionValue();
			if (strval($truck_drivers->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($truck_drivers->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$truck_drivers->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$truck_drivers->Subcon_ID->ViewValue = $truck_drivers->Subcon_ID->CurrentValue;
				}
			} else {
				$truck_drivers->Subcon_ID->ViewValue = NULL;
			}
			$truck_drivers->Subcon_ID->CssStyle = "";
			$truck_drivers->Subcon_ID->CssClass = "";
			$truck_drivers->Subcon_ID->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Subcon_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$truck_drivers->Subcon_ID->EditValue = $arwrk;
			}

			// Truck_Driver
			$truck_drivers->Truck_Driver->EditCustomAttributes = "";
			$truck_drivers->Truck_Driver->EditValue = ew_HtmlEncode($truck_drivers->Truck_Driver->CurrentValue);

			// Address
			$truck_drivers->Address->EditCustomAttributes = "";
			$truck_drivers->Address->EditValue = ew_HtmlEncode($truck_drivers->Address->CurrentValue);

			// Contact_No
			$truck_drivers->Contact_No->EditCustomAttributes = "";
			$truck_drivers->Contact_No->EditValue = ew_HtmlEncode($truck_drivers->Contact_No->CurrentValue);

			// Email_Address
			$truck_drivers->Email_Address->EditCustomAttributes = "";
			$truck_drivers->Email_Address->EditValue = ew_HtmlEncode($truck_drivers->Email_Address->CurrentValue);

			// Driver_License_No
			$truck_drivers->Driver_License_No->EditCustomAttributes = "";
			$truck_drivers->Driver_License_No->EditValue = ew_HtmlEncode($truck_drivers->Driver_License_No->CurrentValue);

			// License_Expiration_Date
			$truck_drivers->License_Expiration_Date->EditCustomAttributes = "";
			$truck_drivers->License_Expiration_Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($truck_drivers->License_Expiration_Date->CurrentValue, 6));

			// File_Upload
			$truck_drivers->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($truck_drivers->File_Upload->Upload->DbValue)) {
				$truck_drivers->File_Upload->EditValue = $truck_drivers->File_Upload->Upload->DbValue;
			} else {
				$truck_drivers->File_Upload->EditValue = "";
			}

			// Remarks
			$truck_drivers->Remarks->EditCustomAttributes = "";
			$truck_drivers->Remarks->EditValue = ew_HtmlEncode($truck_drivers->Remarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($truck_drivers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$truck_drivers->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $truck_drivers;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($truck_drivers->File_Upload->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($truck_drivers->File_Upload->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $truck_drivers->File_Upload->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($truck_drivers->Subcon_ID->FormValue) && $truck_drivers->Subcon_ID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $truck_drivers->Subcon_ID->FldCaption();
		}
		if (!is_null($truck_drivers->Truck_Driver->FormValue) && $truck_drivers->Truck_Driver->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $truck_drivers->Truck_Driver->FldCaption();
		}
		if (!is_null($truck_drivers->Address->FormValue) && $truck_drivers->Address->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $truck_drivers->Address->FldCaption();
		}
		if (!is_null($truck_drivers->Contact_No->FormValue) && $truck_drivers->Contact_No->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $truck_drivers->Contact_No->FldCaption();
		}
		if (!is_null($truck_drivers->Email_Address->FormValue) && $truck_drivers->Email_Address->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $truck_drivers->Email_Address->FldCaption();
		}
		if (!is_null($truck_drivers->Driver_License_No->FormValue) && $truck_drivers->Driver_License_No->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $truck_drivers->Driver_License_No->FldCaption();
		}
		if (!is_null($truck_drivers->License_Expiration_Date->FormValue) && $truck_drivers->License_Expiration_Date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $truck_drivers->License_Expiration_Date->FldCaption();
		}
		if (!ew_CheckUSDate($truck_drivers->License_Expiration_Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $truck_drivers->License_Expiration_Date->FldErrMsg();
		}

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
		global $conn, $Language, $Security, $truck_drivers;
		$rsnew = array();

		// Subcon_ID
		$truck_drivers->Subcon_ID->SetDbValueDef($rsnew, $truck_drivers->Subcon_ID->CurrentValue, NULL, FALSE);

		// Truck_Driver
		$truck_drivers->Truck_Driver->SetDbValueDef($rsnew, $truck_drivers->Truck_Driver->CurrentValue, NULL, FALSE);

		// Address
		$truck_drivers->Address->SetDbValueDef($rsnew, $truck_drivers->Address->CurrentValue, NULL, FALSE);

		// Contact_No
		$truck_drivers->Contact_No->SetDbValueDef($rsnew, $truck_drivers->Contact_No->CurrentValue, NULL, FALSE);

		// Email_Address
		$truck_drivers->Email_Address->SetDbValueDef($rsnew, $truck_drivers->Email_Address->CurrentValue, NULL, FALSE);

		// Driver_License_No
		$truck_drivers->Driver_License_No->SetDbValueDef($rsnew, $truck_drivers->Driver_License_No->CurrentValue, NULL, FALSE);

		// License_Expiration_Date
		$truck_drivers->License_Expiration_Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($truck_drivers->License_Expiration_Date->CurrentValue, 6, FALSE), NULL);

		// File_Upload
		$truck_drivers->File_Upload->Upload->SaveToSession(); // Save file value to Session
		if (is_null($truck_drivers->File_Upload->Upload->Value)) {
			$rsnew['File_Upload'] = NULL;
		} else {
			$rsnew['File_Upload'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $truck_drivers->File_Upload->UploadPath), $truck_drivers->File_Upload->Upload->FileName);
		}

		// Remarks
		$truck_drivers->Remarks->SetDbValueDef($rsnew, $truck_drivers->Remarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $truck_drivers->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($truck_drivers->File_Upload->Upload->Value)) {
				$truck_drivers->File_Upload->Upload->SaveToFile($truck_drivers->File_Upload->UploadPath, $rsnew['File_Upload'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($truck_drivers->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($truck_drivers->CancelMessage <> "") {
				$this->setMessage($truck_drivers->CancelMessage);
				$truck_drivers->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$truck_drivers->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $truck_drivers->id->DbValue;

			// Call Row Inserted event
			$truck_drivers->Row_Inserted($rsnew);
		}

		// File_Upload
		$truck_drivers->File_Upload->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $truck_drivers;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "subcons") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $truck_drivers->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $truck_drivers->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$truck_drivers->Subcon_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$truck_drivers->Subcon_ID->setSessionValue($truck_drivers->Subcon_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["subcons"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$truck_drivers->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$truck_drivers->setStartRecordNumber($this->lStartRec);
			$truck_drivers->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$truck_drivers->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($truck_drivers->Subcon_ID->QueryStringValue == "") $truck_drivers->Subcon_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $truck_drivers->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $truck_drivers->getDetailFilter(); // Restore detail filter
		}
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
