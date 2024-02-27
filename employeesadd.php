<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "employeesinfo.php" ?>
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
$employees_add = new cemployees_add();
$Page =& $employees_add;

// Page init
$employees_add->Page_Init();

// Page main
$employees_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var employees_add = new ew_Page("employees_add");

// page properties
employees_add.PageID = "add"; // page ID
employees_add.FormID = "femployeesadd"; // form ID
var EW_PAGE_ID = employees_add.PageID; // for backward compatibility

// extend page with ValidateForm function
employees_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_EmployeeID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($employees->EmployeeID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_FirstName"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($employees->FirstName->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_LastName"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($employees->LastName->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_EmpRateId"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($employees->EmpRateId->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_DateHired"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($employees->DateHired->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_DateTerminated"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($employees->DateTerminated->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
employees_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
employees_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
employees_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
employees_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $employees->TableCaption() ?><br><br>
<a href="<?php echo $employees->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$employees_add->ShowMessage();
?>
<form name="femployeesadd" id="femployeesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return employees_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="employees">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
	<tr<?php echo $employees->EmployeeID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->EmployeeID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->EmployeeID->CellAttributes() ?>><span id="el_EmployeeID">
<input type="text" name="x_EmployeeID" id="x_EmployeeID" title="<?php echo $employees->EmployeeID->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $employees->EmployeeID->EditValue ?>"<?php echo $employees->EmployeeID->EditAttributes() ?>>
</span><?php echo $employees->EmployeeID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->FirstName->Visible) { // FirstName ?>
	<tr<?php echo $employees->FirstName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->FirstName->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->FirstName->CellAttributes() ?>><span id="el_FirstName">
<input type="text" name="x_FirstName" id="x_FirstName" title="<?php echo $employees->FirstName->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $employees->FirstName->EditValue ?>"<?php echo $employees->FirstName->EditAttributes() ?>>
</span><?php echo $employees->FirstName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->MiddleName->Visible) { // MiddleName ?>
	<tr<?php echo $employees->MiddleName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->MiddleName->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->MiddleName->CellAttributes() ?>><span id="el_MiddleName">
<input type="text" name="x_MiddleName" id="x_MiddleName" title="<?php echo $employees->MiddleName->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $employees->MiddleName->EditValue ?>"<?php echo $employees->MiddleName->EditAttributes() ?>>
</span><?php echo $employees->MiddleName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->LastName->Visible) { // LastName ?>
	<tr<?php echo $employees->LastName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->LastName->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->LastName->CellAttributes() ?>><span id="el_LastName">
<input type="text" name="x_LastName" id="x_LastName" title="<?php echo $employees->LastName->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $employees->LastName->EditValue ?>"<?php echo $employees->LastName->EditAttributes() ?>>
</span><?php echo $employees->LastName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->Username->Visible) { // Username ?>
	<tr<?php echo $employees->Username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->Username->CellAttributes() ?>><span id="el_Username">
<input type="text" name="x_Username" id="x_Username" title="<?php echo $employees->Username->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $employees->Username->EditValue ?>"<?php echo $employees->Username->EditAttributes() ?>>
</span><?php echo $employees->Username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->EmailAddress->Visible) { // EmailAddress ?>
	<tr<?php echo $employees->EmailAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->EmailAddress->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->EmailAddress->CellAttributes() ?>><span id="el_EmailAddress">
<input type="text" name="x_EmailAddress" id="x_EmailAddress" title="<?php echo $employees->EmailAddress->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $employees->EmailAddress->EditValue ?>"<?php echo $employees->EmailAddress->EditAttributes() ?>>
</span><?php echo $employees->EmailAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->Address->Visible) { // Address ?>
	<tr<?php echo $employees->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Address->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->Address->CellAttributes() ?>><span id="el_Address">
<input type="text" name="x_Address" id="x_Address" title="<?php echo $employees->Address->FldTitle() ?>" size="30" maxlength="150" value="<?php echo $employees->Address->EditValue ?>"<?php echo $employees->Address->EditAttributes() ?>>
</span><?php echo $employees->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->MobileNumber->Visible) { // MobileNumber ?>
	<tr<?php echo $employees->MobileNumber->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->MobileNumber->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->MobileNumber->CellAttributes() ?>><span id="el_MobileNumber">
<input type="text" name="x_MobileNumber" id="x_MobileNumber" title="<?php echo $employees->MobileNumber->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $employees->MobileNumber->EditValue ?>"<?php echo $employees->MobileNumber->EditAttributes() ?>>
</span><?php echo $employees->MobileNumber->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->SubconID->Visible) { // SubconID ?>
	<tr<?php echo $employees->SubconID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->SubconID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->SubconID->CellAttributes() ?>><span id="el_SubconID">
<select id="x_SubconID" name="x_SubconID" title="<?php echo $employees->SubconID->FldTitle() ?>"<?php echo $employees->SubconID->EditAttributes() ?>>
<?php
if (is_array($employees->SubconID->EditValue)) {
	$arwrk = $employees->SubconID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($employees->SubconID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $employees->SubconID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->manager->Visible) { // manager ?>
	<tr<?php echo $employees->manager->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->manager->FldCaption() ?></td>
		<td<?php echo $employees->manager->CellAttributes() ?>><span id="el_manager">
<select id="x_manager" name="x_manager" title="<?php echo $employees->manager->FldTitle() ?>"<?php echo $employees->manager->EditAttributes() ?>>
<?php
if (is_array($employees->manager->EditValue)) {
	$arwrk = $employees->manager->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($employees->manager->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $employees->manager->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->Designation->Visible) { // Designation ?>
	<tr<?php echo $employees->Designation->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Designation->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->Designation->CellAttributes() ?>><span id="el_Designation">
<input type="text" name="x_Designation" id="x_Designation" title="<?php echo $employees->Designation->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $employees->Designation->EditValue ?>"<?php echo $employees->Designation->EditAttributes() ?>>
</span><?php echo $employees->Designation->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->EmpRateId->Visible) { // EmpRateId ?>
	<tr<?php echo $employees->EmpRateId->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->EmpRateId->FldCaption() ?></td>
		<td<?php echo $employees->EmpRateId->CellAttributes() ?>><span id="el_EmpRateId">
<input type="text" name="x_EmpRateId" id="x_EmpRateId" title="<?php echo $employees->EmpRateId->FldTitle() ?>" size="30" value="<?php echo $employees->EmpRateId->EditValue ?>"<?php echo $employees->EmpRateId->EditAttributes() ?>>
</span><?php echo $employees->EmpRateId->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->DateHired->Visible) { // DateHired ?>
	<tr<?php echo $employees->DateHired->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->DateHired->FldCaption() ?></td>
		<td<?php echo $employees->DateHired->CellAttributes() ?>><span id="el_DateHired">
<input type="text" name="x_DateHired" id="x_DateHired" title="<?php echo $employees->DateHired->FldTitle() ?>" value="<?php echo $employees->DateHired->EditValue ?>"<?php echo $employees->DateHired->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_DateHired" name="cal_x_DateHired" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_DateHired", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_DateHired" // button id
});
</script>
</span><?php echo $employees->DateHired->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->DateTerminated->Visible) { // DateTerminated ?>
	<tr<?php echo $employees->DateTerminated->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->DateTerminated->FldCaption() ?></td>
		<td<?php echo $employees->DateTerminated->CellAttributes() ?>><span id="el_DateTerminated">
<input type="text" name="x_DateTerminated" id="x_DateTerminated" title="<?php echo $employees->DateTerminated->FldTitle() ?>" value="<?php echo $employees->DateTerminated->EditValue ?>"<?php echo $employees->DateTerminated->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_DateTerminated" name="cal_x_DateTerminated" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_DateTerminated", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_DateTerminated" // button id
});
</script>
</span><?php echo $employees->DateTerminated->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->EmpStatusId->Visible) { // EmpStatusId ?>
	<tr<?php echo $employees->EmpStatusId->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->EmpStatusId->FldCaption() ?></td>
		<td<?php echo $employees->EmpStatusId->CellAttributes() ?>><span id="el_EmpStatusId">
<select id="x_EmpStatusId" name="x_EmpStatusId" title="<?php echo $employees->EmpStatusId->FldTitle() ?>"<?php echo $employees->EmpStatusId->EditAttributes() ?>>
<?php
if (is_array($employees->EmpStatusId->EditValue)) {
	$arwrk = $employees->EmpStatusId->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($employees->EmpStatusId->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $employees->EmpStatusId->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $employees->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Remarks->FldCaption() ?></td>
		<td<?php echo $employees->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $employees->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $employees->Remarks->EditAttributes() ?>><?php echo $employees->Remarks->EditValue ?></textarea>
</span><?php echo $employees->Remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($employees->Password->Visible) { // Password ?>
	<tr<?php echo $employees->Password->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $employees->Password->CellAttributes() ?>><span id="el_Password">
<input type="text" name="x_Password" id="x_Password" title="<?php echo $employees->Password->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $employees->Password->EditValue ?>"<?php echo $employees->Password->EditAttributes() ?>>
</span><?php echo $employees->Password->CustomMsg ?></td>
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
$employees_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cemployees_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'employees';

	// Page object name
	var $PageObjName = 'employees_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $employees;
		if ($employees->UseTokenInUrl) $PageUrl .= "t=" . $employees->TableVar . "&"; // Add page token
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
		global $objForm, $employees;
		if ($employees->UseTokenInUrl) {
			if ($objForm)
				return ($employees->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($employees->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cemployees_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (employees)
		$GLOBALS["employees"] = new cemployees();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'employees', TRUE);

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
		global $employees;

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
			$this->Page_Terminate("employeeslist.php");
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
		global $objForm, $Language, $gsFormError, $employees;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $employees->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $employees->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$employees->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $employees->CurrentAction = "C"; // Copy record
		  } else {
		    $employees->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($employees->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("employeeslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$employees->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $employees->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$employees->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $employees;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $employees;
		$employees->SubconID->CurrentValue = 0;
		$employees->EmpRateId->CurrentValue = 0;
		$employees->EmpStatusId->CurrentValue = 0;
		$employees->Remarks->CurrentValue = "''";
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $employees;
		$employees->EmployeeID->setFormValue($objForm->GetValue("x_EmployeeID"));
		$employees->FirstName->setFormValue($objForm->GetValue("x_FirstName"));
		$employees->MiddleName->setFormValue($objForm->GetValue("x_MiddleName"));
		$employees->LastName->setFormValue($objForm->GetValue("x_LastName"));
		$employees->Username->setFormValue($objForm->GetValue("x_Username"));
		$employees->EmailAddress->setFormValue($objForm->GetValue("x_EmailAddress"));
		$employees->Address->setFormValue($objForm->GetValue("x_Address"));
		$employees->MobileNumber->setFormValue($objForm->GetValue("x_MobileNumber"));
		$employees->SubconID->setFormValue($objForm->GetValue("x_SubconID"));
		$employees->manager->setFormValue($objForm->GetValue("x_manager"));
		$employees->Designation->setFormValue($objForm->GetValue("x_Designation"));
		$employees->EmpRateId->setFormValue($objForm->GetValue("x_EmpRateId"));
		$employees->DateHired->setFormValue($objForm->GetValue("x_DateHired"));
		$employees->DateHired->CurrentValue = ew_UnFormatDateTime($employees->DateHired->CurrentValue, 6);
		$employees->DateTerminated->setFormValue($objForm->GetValue("x_DateTerminated"));
		$employees->DateTerminated->CurrentValue = ew_UnFormatDateTime($employees->DateTerminated->CurrentValue, 6);
		$employees->EmpStatusId->setFormValue($objForm->GetValue("x_EmpStatusId"));
		$employees->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$employees->Password->setFormValue($objForm->GetValue("x_Password"));
		$employees->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $employees;
		$employees->id->CurrentValue = $employees->id->FormValue;
		$employees->EmployeeID->CurrentValue = $employees->EmployeeID->FormValue;
		$employees->FirstName->CurrentValue = $employees->FirstName->FormValue;
		$employees->MiddleName->CurrentValue = $employees->MiddleName->FormValue;
		$employees->LastName->CurrentValue = $employees->LastName->FormValue;
		$employees->Username->CurrentValue = $employees->Username->FormValue;
		$employees->EmailAddress->CurrentValue = $employees->EmailAddress->FormValue;
		$employees->Address->CurrentValue = $employees->Address->FormValue;
		$employees->MobileNumber->CurrentValue = $employees->MobileNumber->FormValue;
		$employees->SubconID->CurrentValue = $employees->SubconID->FormValue;
		$employees->manager->CurrentValue = $employees->manager->FormValue;
		$employees->Designation->CurrentValue = $employees->Designation->FormValue;
		$employees->EmpRateId->CurrentValue = $employees->EmpRateId->FormValue;
		$employees->DateHired->CurrentValue = $employees->DateHired->FormValue;
		$employees->DateHired->CurrentValue = ew_UnFormatDateTime($employees->DateHired->CurrentValue, 6);
		$employees->DateTerminated->CurrentValue = $employees->DateTerminated->FormValue;
		$employees->DateTerminated->CurrentValue = ew_UnFormatDateTime($employees->DateTerminated->CurrentValue, 6);
		$employees->EmpStatusId->CurrentValue = $employees->EmpStatusId->FormValue;
		$employees->Remarks->CurrentValue = $employees->Remarks->FormValue;
		$employees->Password->CurrentValue = $employees->Password->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $employees;
		$sFilter = $employees->KeyFilter();

		// Call Row Selecting event
		$employees->Row_Selecting($sFilter);

		// Load SQL based on filter
		$employees->CurrentFilter = $sFilter;
		$sSql = $employees->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$employees->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $employees;
		$employees->id->setDbValue($rs->fields('id'));
		$employees->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$employees->FirstName->setDbValue($rs->fields('FirstName'));
		$employees->MiddleName->setDbValue($rs->fields('MiddleName'));
		$employees->LastName->setDbValue($rs->fields('LastName'));
		$employees->Username->setDbValue($rs->fields('Username'));
		$employees->EmailAddress->setDbValue($rs->fields('EmailAddress'));
		$employees->Address->setDbValue($rs->fields('Address'));
		$employees->MobileNumber->setDbValue($rs->fields('MobileNumber'));
		$employees->SubconID->setDbValue($rs->fields('SubconID'));
		$employees->manager->setDbValue($rs->fields('manager'));
		$employees->Designation->setDbValue($rs->fields('Designation'));
		$employees->EmpRateId->setDbValue($rs->fields('EmpRateId'));
		$employees->DateHired->setDbValue($rs->fields('DateHired'));
		$employees->DateTerminated->setDbValue($rs->fields('DateTerminated'));
		$employees->EmpStatusId->setDbValue($rs->fields('EmpStatusId'));
		$employees->Remarks->setDbValue($rs->fields('Remarks'));
		$employees->Password->setDbValue($rs->fields('Password'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $employees;

		// Initialize URLs
		// Call Row_Rendering event

		$employees->Row_Rendering();

		// Common render codes for all row types
		// EmployeeID

		$employees->EmployeeID->CellCssStyle = ""; $employees->EmployeeID->CellCssClass = "";
		$employees->EmployeeID->CellAttrs = array(); $employees->EmployeeID->ViewAttrs = array(); $employees->EmployeeID->EditAttrs = array();

		// FirstName
		$employees->FirstName->CellCssStyle = ""; $employees->FirstName->CellCssClass = "";
		$employees->FirstName->CellAttrs = array(); $employees->FirstName->ViewAttrs = array(); $employees->FirstName->EditAttrs = array();

		// MiddleName
		$employees->MiddleName->CellCssStyle = ""; $employees->MiddleName->CellCssClass = "";
		$employees->MiddleName->CellAttrs = array(); $employees->MiddleName->ViewAttrs = array(); $employees->MiddleName->EditAttrs = array();

		// LastName
		$employees->LastName->CellCssStyle = ""; $employees->LastName->CellCssClass = "";
		$employees->LastName->CellAttrs = array(); $employees->LastName->ViewAttrs = array(); $employees->LastName->EditAttrs = array();

		// Username
		$employees->Username->CellCssStyle = ""; $employees->Username->CellCssClass = "";
		$employees->Username->CellAttrs = array(); $employees->Username->ViewAttrs = array(); $employees->Username->EditAttrs = array();

		// EmailAddress
		$employees->EmailAddress->CellCssStyle = ""; $employees->EmailAddress->CellCssClass = "";
		$employees->EmailAddress->CellAttrs = array(); $employees->EmailAddress->ViewAttrs = array(); $employees->EmailAddress->EditAttrs = array();

		// Address
		$employees->Address->CellCssStyle = ""; $employees->Address->CellCssClass = "";
		$employees->Address->CellAttrs = array(); $employees->Address->ViewAttrs = array(); $employees->Address->EditAttrs = array();

		// MobileNumber
		$employees->MobileNumber->CellCssStyle = ""; $employees->MobileNumber->CellCssClass = "";
		$employees->MobileNumber->CellAttrs = array(); $employees->MobileNumber->ViewAttrs = array(); $employees->MobileNumber->EditAttrs = array();

		// SubconID
		$employees->SubconID->CellCssStyle = ""; $employees->SubconID->CellCssClass = "";
		$employees->SubconID->CellAttrs = array(); $employees->SubconID->ViewAttrs = array(); $employees->SubconID->EditAttrs = array();

		// manager
		$employees->manager->CellCssStyle = ""; $employees->manager->CellCssClass = "";
		$employees->manager->CellAttrs = array(); $employees->manager->ViewAttrs = array(); $employees->manager->EditAttrs = array();

		// Designation
		$employees->Designation->CellCssStyle = ""; $employees->Designation->CellCssClass = "";
		$employees->Designation->CellAttrs = array(); $employees->Designation->ViewAttrs = array(); $employees->Designation->EditAttrs = array();

		// EmpRateId
		$employees->EmpRateId->CellCssStyle = ""; $employees->EmpRateId->CellCssClass = "";
		$employees->EmpRateId->CellAttrs = array(); $employees->EmpRateId->ViewAttrs = array(); $employees->EmpRateId->EditAttrs = array();

		// DateHired
		$employees->DateHired->CellCssStyle = ""; $employees->DateHired->CellCssClass = "";
		$employees->DateHired->CellAttrs = array(); $employees->DateHired->ViewAttrs = array(); $employees->DateHired->EditAttrs = array();

		// DateTerminated
		$employees->DateTerminated->CellCssStyle = ""; $employees->DateTerminated->CellCssClass = "";
		$employees->DateTerminated->CellAttrs = array(); $employees->DateTerminated->ViewAttrs = array(); $employees->DateTerminated->EditAttrs = array();

		// EmpStatusId
		$employees->EmpStatusId->CellCssStyle = ""; $employees->EmpStatusId->CellCssClass = "";
		$employees->EmpStatusId->CellAttrs = array(); $employees->EmpStatusId->ViewAttrs = array(); $employees->EmpStatusId->EditAttrs = array();

		// Remarks
		$employees->Remarks->CellCssStyle = ""; $employees->Remarks->CellCssClass = "";
		$employees->Remarks->CellAttrs = array(); $employees->Remarks->ViewAttrs = array(); $employees->Remarks->EditAttrs = array();

		// Password
		$employees->Password->CellCssStyle = ""; $employees->Password->CellCssClass = "";
		$employees->Password->CellAttrs = array(); $employees->Password->ViewAttrs = array(); $employees->Password->EditAttrs = array();
		if ($employees->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$employees->id->ViewValue = $employees->id->CurrentValue;
			$employees->id->CssStyle = "";
			$employees->id->CssClass = "";
			$employees->id->ViewCustomAttributes = "";

			// EmployeeID
			$employees->EmployeeID->ViewValue = $employees->EmployeeID->CurrentValue;
			$employees->EmployeeID->CssStyle = "";
			$employees->EmployeeID->CssClass = "";
			$employees->EmployeeID->ViewCustomAttributes = "";

			// FirstName
			$employees->FirstName->ViewValue = $employees->FirstName->CurrentValue;
			$employees->FirstName->CssStyle = "";
			$employees->FirstName->CssClass = "";
			$employees->FirstName->ViewCustomAttributes = "";

			// MiddleName
			$employees->MiddleName->ViewValue = $employees->MiddleName->CurrentValue;
			$employees->MiddleName->CssStyle = "";
			$employees->MiddleName->CssClass = "";
			$employees->MiddleName->ViewCustomAttributes = "";

			// LastName
			$employees->LastName->ViewValue = $employees->LastName->CurrentValue;
			$employees->LastName->CssStyle = "";
			$employees->LastName->CssClass = "";
			$employees->LastName->ViewCustomAttributes = "";

			// Username
			$employees->Username->ViewValue = $employees->Username->CurrentValue;
			$employees->Username->CssStyle = "";
			$employees->Username->CssClass = "";
			$employees->Username->ViewCustomAttributes = "";

			// EmailAddress
			$employees->EmailAddress->ViewValue = $employees->EmailAddress->CurrentValue;
			$employees->EmailAddress->CssStyle = "";
			$employees->EmailAddress->CssClass = "";
			$employees->EmailAddress->ViewCustomAttributes = "";

			// Address
			$employees->Address->ViewValue = $employees->Address->CurrentValue;
			$employees->Address->CssStyle = "";
			$employees->Address->CssClass = "";
			$employees->Address->ViewCustomAttributes = "";

			// MobileNumber
			$employees->MobileNumber->ViewValue = $employees->MobileNumber->CurrentValue;
			$employees->MobileNumber->CssStyle = "";
			$employees->MobileNumber->CssClass = "";
			$employees->MobileNumber->ViewCustomAttributes = "";

			// SubconID
			if (strval($employees->SubconID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($employees->SubconID->CurrentValue) . "";
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
					$employees->SubconID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$employees->SubconID->ViewValue = $employees->SubconID->CurrentValue;
				}
			} else {
				$employees->SubconID->ViewValue = NULL;
			}
			$employees->SubconID->CssStyle = "";
			$employees->SubconID->CssClass = "";
			$employees->SubconID->ViewCustomAttributes = "";

			// manager
			if (strval($employees->manager->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($employees->manager->CurrentValue) . "";
			$sSqlWrk = "SELECT `LastName`, `FirstName` FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `LastName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$employees->manager->ViewValue = $rswrk->fields('LastName');
					$employees->manager->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('FirstName');
					$rswrk->Close();
				} else {
					$employees->manager->ViewValue = $employees->manager->CurrentValue;
				}
			} else {
				$employees->manager->ViewValue = NULL;
			}
			$employees->manager->CssStyle = "";
			$employees->manager->CssClass = "";
			$employees->manager->ViewCustomAttributes = "";

			// Designation
			$employees->Designation->ViewValue = $employees->Designation->CurrentValue;
			$employees->Designation->CssStyle = "";
			$employees->Designation->CssClass = "";
			$employees->Designation->ViewCustomAttributes = "";

			// EmpRateId
			$employees->EmpRateId->ViewValue = $employees->EmpRateId->CurrentValue;
			$employees->EmpRateId->CssStyle = "";
			$employees->EmpRateId->CssClass = "";
			$employees->EmpRateId->ViewCustomAttributes = "";

			// DateHired
			$employees->DateHired->ViewValue = $employees->DateHired->CurrentValue;
			$employees->DateHired->ViewValue = ew_FormatDateTime($employees->DateHired->ViewValue, 6);
			$employees->DateHired->CssStyle = "";
			$employees->DateHired->CssClass = "";
			$employees->DateHired->ViewCustomAttributes = "";

			// DateTerminated
			$employees->DateTerminated->ViewValue = $employees->DateTerminated->CurrentValue;
			$employees->DateTerminated->ViewValue = ew_FormatDateTime($employees->DateTerminated->ViewValue, 6);
			$employees->DateTerminated->CssStyle = "";
			$employees->DateTerminated->CssClass = "";
			$employees->DateTerminated->ViewCustomAttributes = "";

			// EmpStatusId
			if (strval($employees->EmpStatusId->CurrentValue) <> "") {
				switch ($employees->EmpStatusId->CurrentValue) {
					case "regular":
						$employees->EmpStatusId->ViewValue = "Regular";
						break;
					case "contractual":
						$employees->EmpStatusId->ViewValue = "Contractual";
						break;
					default:
						$employees->EmpStatusId->ViewValue = $employees->EmpStatusId->CurrentValue;
				}
			} else {
				$employees->EmpStatusId->ViewValue = NULL;
			}
			$employees->EmpStatusId->CssStyle = "";
			$employees->EmpStatusId->CssClass = "";
			$employees->EmpStatusId->ViewCustomAttributes = "";

			// Remarks
			$employees->Remarks->ViewValue = $employees->Remarks->CurrentValue;
			$employees->Remarks->CssStyle = "";
			$employees->Remarks->CssClass = "";
			$employees->Remarks->ViewCustomAttributes = "";

			// Password
			$employees->Password->ViewValue = $employees->Password->CurrentValue;
			$employees->Password->CssStyle = "";
			$employees->Password->CssClass = "";
			$employees->Password->ViewCustomAttributes = "";

			// EmployeeID
			$employees->EmployeeID->HrefValue = "";
			$employees->EmployeeID->TooltipValue = "";

			// FirstName
			$employees->FirstName->HrefValue = "";
			$employees->FirstName->TooltipValue = "";

			// MiddleName
			$employees->MiddleName->HrefValue = "";
			$employees->MiddleName->TooltipValue = "";

			// LastName
			$employees->LastName->HrefValue = "";
			$employees->LastName->TooltipValue = "";

			// Username
			$employees->Username->HrefValue = "";
			$employees->Username->TooltipValue = "";

			// EmailAddress
			$employees->EmailAddress->HrefValue = "";
			$employees->EmailAddress->TooltipValue = "";

			// Address
			$employees->Address->HrefValue = "";
			$employees->Address->TooltipValue = "";

			// MobileNumber
			$employees->MobileNumber->HrefValue = "";
			$employees->MobileNumber->TooltipValue = "";

			// SubconID
			$employees->SubconID->HrefValue = "";
			$employees->SubconID->TooltipValue = "";

			// manager
			$employees->manager->HrefValue = "";
			$employees->manager->TooltipValue = "";

			// Designation
			$employees->Designation->HrefValue = "";
			$employees->Designation->TooltipValue = "";

			// EmpRateId
			$employees->EmpRateId->HrefValue = "";
			$employees->EmpRateId->TooltipValue = "";

			// DateHired
			$employees->DateHired->HrefValue = "";
			$employees->DateHired->TooltipValue = "";

			// DateTerminated
			$employees->DateTerminated->HrefValue = "";
			$employees->DateTerminated->TooltipValue = "";

			// EmpStatusId
			$employees->EmpStatusId->HrefValue = "";
			$employees->EmpStatusId->TooltipValue = "";

			// Remarks
			$employees->Remarks->HrefValue = "";
			$employees->Remarks->TooltipValue = "";

			// Password
			$employees->Password->HrefValue = "";
			$employees->Password->TooltipValue = "";
		} elseif ($employees->RowType == EW_ROWTYPE_ADD) { // Add row

			// EmployeeID
			$employees->EmployeeID->EditCustomAttributes = "";
			$employees->EmployeeID->EditValue = ew_HtmlEncode($employees->EmployeeID->CurrentValue);

			// FirstName
			$employees->FirstName->EditCustomAttributes = "";
			$employees->FirstName->EditValue = ew_HtmlEncode($employees->FirstName->CurrentValue);

			// MiddleName
			$employees->MiddleName->EditCustomAttributes = "";
			$employees->MiddleName->EditValue = ew_HtmlEncode($employees->MiddleName->CurrentValue);

			// LastName
			$employees->LastName->EditCustomAttributes = "";
			$employees->LastName->EditValue = ew_HtmlEncode($employees->LastName->CurrentValue);

			// Username
			$employees->Username->EditCustomAttributes = "";
			$employees->Username->EditValue = ew_HtmlEncode($employees->Username->CurrentValue);

			// EmailAddress
			$employees->EmailAddress->EditCustomAttributes = "";
			$employees->EmailAddress->EditValue = ew_HtmlEncode($employees->EmailAddress->CurrentValue);

			// Address
			$employees->Address->EditCustomAttributes = "";
			$employees->Address->EditValue = ew_HtmlEncode($employees->Address->CurrentValue);

			// MobileNumber
			$employees->MobileNumber->EditCustomAttributes = "";
			$employees->MobileNumber->EditValue = ew_HtmlEncode($employees->MobileNumber->CurrentValue);

			// SubconID
			$employees->SubconID->EditCustomAttributes = "";
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
			$employees->SubconID->EditValue = $arwrk;

			// manager
			$employees->manager->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `LastName`, `FirstName`, '' AS SelectFilterFld FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `LastName` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$employees->manager->EditValue = $arwrk;

			// Designation
			$employees->Designation->EditCustomAttributes = "";
			$employees->Designation->EditValue = ew_HtmlEncode($employees->Designation->CurrentValue);

			// EmpRateId
			$employees->EmpRateId->EditCustomAttributes = "";
			$employees->EmpRateId->EditValue = ew_HtmlEncode($employees->EmpRateId->CurrentValue);

			// DateHired
			$employees->DateHired->EditCustomAttributes = "";
			$employees->DateHired->EditValue = ew_HtmlEncode(ew_FormatDateTime($employees->DateHired->CurrentValue, 6));

			// DateTerminated
			$employees->DateTerminated->EditCustomAttributes = "";
			$employees->DateTerminated->EditValue = ew_HtmlEncode(ew_FormatDateTime($employees->DateTerminated->CurrentValue, 6));

			// EmpStatusId
			$employees->EmpStatusId->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("regular", "Regular");
			$arwrk[] = array("contractual", "Contractual");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$employees->EmpStatusId->EditValue = $arwrk;

			// Remarks
			$employees->Remarks->EditCustomAttributes = "";
			$employees->Remarks->EditValue = ew_HtmlEncode($employees->Remarks->CurrentValue);

			// Password
			$employees->Password->EditCustomAttributes = "";
			$employees->Password->EditValue = ew_HtmlEncode($employees->Password->CurrentValue);
		}

		// Call Row Rendered event
		if ($employees->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$employees->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $employees;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($employees->EmployeeID->FormValue) && $employees->EmployeeID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $employees->EmployeeID->FldCaption();
		}
		if (!is_null($employees->FirstName->FormValue) && $employees->FirstName->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $employees->FirstName->FldCaption();
		}
		if (!is_null($employees->LastName->FormValue) && $employees->LastName->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $employees->LastName->FldCaption();
		}
		if (!ew_CheckInteger($employees->EmpRateId->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $employees->EmpRateId->FldErrMsg();
		}
		if (!ew_CheckUSDate($employees->DateHired->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $employees->DateHired->FldErrMsg();
		}
		if (!ew_CheckUSDate($employees->DateTerminated->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $employees->DateTerminated->FldErrMsg();
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
		global $conn, $Language, $Security, $employees;
		$rsnew = array();

		// EmployeeID
		$employees->EmployeeID->SetDbValueDef($rsnew, $employees->EmployeeID->CurrentValue, "", FALSE);

		// FirstName
		$employees->FirstName->SetDbValueDef($rsnew, $employees->FirstName->CurrentValue, "", FALSE);

		// MiddleName
		$employees->MiddleName->SetDbValueDef($rsnew, $employees->MiddleName->CurrentValue, "", FALSE);

		// LastName
		$employees->LastName->SetDbValueDef($rsnew, $employees->LastName->CurrentValue, "", FALSE);

		// Username
		$employees->Username->SetDbValueDef($rsnew, $employees->Username->CurrentValue, "", FALSE);

		// EmailAddress
		$employees->EmailAddress->SetDbValueDef($rsnew, $employees->EmailAddress->CurrentValue, "", FALSE);

		// Address
		$employees->Address->SetDbValueDef($rsnew, $employees->Address->CurrentValue, "", FALSE);

		// MobileNumber
		$employees->MobileNumber->SetDbValueDef($rsnew, $employees->MobileNumber->CurrentValue, "", FALSE);

		// SubconID
		$employees->SubconID->SetDbValueDef($rsnew, $employees->SubconID->CurrentValue, 0, TRUE);

		// manager
		$employees->manager->SetDbValueDef($rsnew, $employees->manager->CurrentValue, NULL, FALSE);

		// Designation
		$employees->Designation->SetDbValueDef($rsnew, $employees->Designation->CurrentValue, "", FALSE);

		// EmpRateId
		$employees->EmpRateId->SetDbValueDef($rsnew, $employees->EmpRateId->CurrentValue, 0, TRUE);

		// DateHired
		$employees->DateHired->SetDbValueDef($rsnew, ew_UnFormatDateTime($employees->DateHired->CurrentValue, 6, FALSE), NULL);

		// DateTerminated
		$employees->DateTerminated->SetDbValueDef($rsnew, ew_UnFormatDateTime($employees->DateTerminated->CurrentValue, 6, FALSE), NULL);

		// EmpStatusId
		$employees->EmpStatusId->SetDbValueDef($rsnew, $employees->EmpStatusId->CurrentValue, 0, TRUE);

		// Remarks
		$employees->Remarks->SetDbValueDef($rsnew, $employees->Remarks->CurrentValue, "", TRUE);

		// Password
		$employees->Password->SetDbValueDef($rsnew, $employees->Password->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$bInsertRow = $employees->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($employees->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($employees->CancelMessage <> "") {
				$this->setMessage($employees->CancelMessage);
				$employees->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$employees->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $employees->id->DbValue;

			// Call Row Inserted event
			$employees->Row_Inserted($rsnew);
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
