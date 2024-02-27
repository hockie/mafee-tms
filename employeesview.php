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
$employees_view = new cemployees_view();
$Page =& $employees_view;

// Page init
$employees_view->Page_Init();

// Page main
$employees_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($employees->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var employees_view = new ew_Page("employees_view");

// page properties
employees_view.PageID = "view"; // page ID
employees_view.FormID = "femployeesview"; // form ID
var EW_PAGE_ID = employees_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
employees_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
employees_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
employees_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
employees_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $employees->TableCaption() ?>
<br><br>
<?php if ($employees->Export == "") { ?>
<a href="<?php echo $employees_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $employees_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $employees_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $employees_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$employees_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($employees->id->Visible) { // id ?>
	<tr<?php echo $employees->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->id->FldCaption() ?></td>
		<td<?php echo $employees->id->CellAttributes() ?>>
<div<?php echo $employees->id->ViewAttributes() ?>><?php echo $employees->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
	<tr<?php echo $employees->EmployeeID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->EmployeeID->FldCaption() ?></td>
		<td<?php echo $employees->EmployeeID->CellAttributes() ?>>
<div<?php echo $employees->EmployeeID->ViewAttributes() ?>><?php echo $employees->EmployeeID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->FirstName->Visible) { // FirstName ?>
	<tr<?php echo $employees->FirstName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->FirstName->FldCaption() ?></td>
		<td<?php echo $employees->FirstName->CellAttributes() ?>>
<div<?php echo $employees->FirstName->ViewAttributes() ?>><?php echo $employees->FirstName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->MiddleName->Visible) { // MiddleName ?>
	<tr<?php echo $employees->MiddleName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->MiddleName->FldCaption() ?></td>
		<td<?php echo $employees->MiddleName->CellAttributes() ?>>
<div<?php echo $employees->MiddleName->ViewAttributes() ?>><?php echo $employees->MiddleName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->LastName->Visible) { // LastName ?>
	<tr<?php echo $employees->LastName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->LastName->FldCaption() ?></td>
		<td<?php echo $employees->LastName->CellAttributes() ?>>
<div<?php echo $employees->LastName->ViewAttributes() ?>><?php echo $employees->LastName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->Username->Visible) { // Username ?>
	<tr<?php echo $employees->Username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Username->FldCaption() ?></td>
		<td<?php echo $employees->Username->CellAttributes() ?>>
<div<?php echo $employees->Username->ViewAttributes() ?>><?php echo $employees->Username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->EmailAddress->Visible) { // EmailAddress ?>
	<tr<?php echo $employees->EmailAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->EmailAddress->FldCaption() ?></td>
		<td<?php echo $employees->EmailAddress->CellAttributes() ?>>
<div<?php echo $employees->EmailAddress->ViewAttributes() ?>><?php echo $employees->EmailAddress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->Address->Visible) { // Address ?>
	<tr<?php echo $employees->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Address->FldCaption() ?></td>
		<td<?php echo $employees->Address->CellAttributes() ?>>
<div<?php echo $employees->Address->ViewAttributes() ?>><?php echo $employees->Address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->MobileNumber->Visible) { // MobileNumber ?>
	<tr<?php echo $employees->MobileNumber->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->MobileNumber->FldCaption() ?></td>
		<td<?php echo $employees->MobileNumber->CellAttributes() ?>>
<div<?php echo $employees->MobileNumber->ViewAttributes() ?>><?php echo $employees->MobileNumber->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->SubconID->Visible) { // SubconID ?>
	<tr<?php echo $employees->SubconID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->SubconID->FldCaption() ?></td>
		<td<?php echo $employees->SubconID->CellAttributes() ?>>
<div<?php echo $employees->SubconID->ViewAttributes() ?>><?php echo $employees->SubconID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->manager->Visible) { // manager ?>
	<tr<?php echo $employees->manager->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->manager->FldCaption() ?></td>
		<td<?php echo $employees->manager->CellAttributes() ?>>
<div<?php echo $employees->manager->ViewAttributes() ?>><?php echo $employees->manager->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->Designation->Visible) { // Designation ?>
	<tr<?php echo $employees->Designation->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Designation->FldCaption() ?></td>
		<td<?php echo $employees->Designation->CellAttributes() ?>>
<div<?php echo $employees->Designation->ViewAttributes() ?>><?php echo $employees->Designation->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->EmpRateId->Visible) { // EmpRateId ?>
	<tr<?php echo $employees->EmpRateId->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->EmpRateId->FldCaption() ?></td>
		<td<?php echo $employees->EmpRateId->CellAttributes() ?>>
<div<?php echo $employees->EmpRateId->ViewAttributes() ?>><?php echo $employees->EmpRateId->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->DateHired->Visible) { // DateHired ?>
	<tr<?php echo $employees->DateHired->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->DateHired->FldCaption() ?></td>
		<td<?php echo $employees->DateHired->CellAttributes() ?>>
<div<?php echo $employees->DateHired->ViewAttributes() ?>><?php echo $employees->DateHired->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->DateTerminated->Visible) { // DateTerminated ?>
	<tr<?php echo $employees->DateTerminated->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->DateTerminated->FldCaption() ?></td>
		<td<?php echo $employees->DateTerminated->CellAttributes() ?>>
<div<?php echo $employees->DateTerminated->ViewAttributes() ?>><?php echo $employees->DateTerminated->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->EmpStatusId->Visible) { // EmpStatusId ?>
	<tr<?php echo $employees->EmpStatusId->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->EmpStatusId->FldCaption() ?></td>
		<td<?php echo $employees->EmpStatusId->CellAttributes() ?>>
<div<?php echo $employees->EmpStatusId->ViewAttributes() ?>><?php echo $employees->EmpStatusId->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $employees->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Remarks->FldCaption() ?></td>
		<td<?php echo $employees->Remarks->CellAttributes() ?>>
<div<?php echo $employees->Remarks->ViewAttributes() ?>><?php echo $employees->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($employees->Password->Visible) { // Password ?>
	<tr<?php echo $employees->Password->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $employees->Password->FldCaption() ?></td>
		<td<?php echo $employees->Password->CellAttributes() ?>>
<div<?php echo $employees->Password->ViewAttributes() ?>><?php echo $employees->Password->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($employees->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$employees_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cemployees_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'employees';

	// Page object name
	var $PageObjName = 'employees_view';

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
	function cemployees_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (employees)
		$GLOBALS["employees"] = new cemployees();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("employeeslist.php");
		}

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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $employees;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$employees->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $employees->id->QueryStringValue;
			} else {
				$sReturnUrl = "employeeslist.php"; // Return to list
			}

			// Get action
			$employees->CurrentAction = "I"; // Display form
			switch ($employees->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "employeeslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "employeeslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$employees->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $employees;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$employees->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$employees->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $employees->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$employees->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$employees->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$employees->setStartRecordNumber($this->lStartRec);
		}
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($employees->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($employees->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($employees->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($employees->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($employees->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($employees->id->CurrentValue);
		$this->AddUrl = $employees->AddUrl();
		$this->EditUrl = $employees->EditUrl();
		$this->CopyUrl = $employees->CopyUrl();
		$this->DeleteUrl = $employees->DeleteUrl();
		$this->ListUrl = $employees->ListUrl();

		// Call Row_Rendering event
		$employees->Row_Rendering();

		// Common render codes for all row types
		// id

		$employees->id->CellCssStyle = ""; $employees->id->CellCssClass = "";
		$employees->id->CellAttrs = array(); $employees->id->ViewAttrs = array(); $employees->id->EditAttrs = array();

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

			// id
			$employees->id->HrefValue = "";
			$employees->id->TooltipValue = "";

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
		}

		// Call Row Rendered event
		if ($employees->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$employees->Row_Rendered();
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
}
?>
