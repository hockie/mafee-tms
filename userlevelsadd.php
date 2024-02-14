<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "userlevelsinfo.php" ?>
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
$userlevels_add = new cuserlevels_add();
$Page =& $userlevels_add;

// Page init
$userlevels_add->Page_Init();

// Page main
$userlevels_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var userlevels_add = new ew_Page("userlevels_add");

// page properties
userlevels_add.PageID = "add"; // page ID
userlevels_add.FormID = "fuserlevelsadd"; // form ID
var EW_PAGE_ID = userlevels_add.PageID; // for backward compatibility

// extend page with ValidateForm function
userlevels_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_userlevelid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userlevels->userlevelid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_userlevelid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($userlevels->userlevelid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_userlevelname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userlevels->userlevelname->FldCaption()) ?>");
		elmId = fobj.elements["x" + infix + "_userlevelid"];
		elmName = fobj.elements["x" + infix + "_userlevelname"];
		if (elmId && elmName) {
			elmId.value = elmId.value.replace(/^\s+|\s+$/, '');
			elmName.value = elmName.value.replace(/^\s+|\s+$/, '');
			if (elmId && !ew_CheckInteger(elmId.value))
				return ew_OnError(this, elmId, ewLanguage.Phrase("UserLevelIDInteger"));
			var level = parseInt(elmId.value);
			if (level == 0) {
				if (elmName.value.toLowerCase() != "default")
					return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelDefaultName"));
			} else if (level == -1) { 
				if (elmName.value.toLowerCase() != "administrator")
					return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelAdministratorName"));
			} else if (level < -1) {
				return ew_OnError(this, elmId, ewLanguage.Phrase("UserLevelIDIncorrect"));
			} else if (level > 0) { 
				if (elmName.value.toLowerCase() == "administrator" || elmName.value.toLowerCase() == "default")
					return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelNameIncorrect"));
			}
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
userlevels_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userlevels_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userlevels_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $userlevels->TableCaption() ?><br><br>
<a href="<?php echo $userlevels->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userlevels_add->ShowMessage();
?>
<form name="fuserlevelsadd" id="fuserlevelsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return userlevels_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="userlevels">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($userlevels->userlevelid->Visible) { // userlevelid ?>
	<tr<?php echo $userlevels->userlevelid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userlevels->userlevelid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userlevels->userlevelid->CellAttributes() ?>><span id="el_userlevelid">
<input type="text" name="x_userlevelid" id="x_userlevelid" title="<?php echo $userlevels->userlevelid->FldTitle() ?>" size="30" value="<?php echo $userlevels->userlevelid->EditValue ?>"<?php echo $userlevels->userlevelid->EditAttributes() ?>>
</span><?php echo $userlevels->userlevelid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userlevels->userlevelname->Visible) { // userlevelname ?>
	<tr<?php echo $userlevels->userlevelname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userlevels->userlevelname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userlevels->userlevelname->CellAttributes() ?>><span id="el_userlevelname">
<input type="text" name="x_userlevelname" id="x_userlevelname" title="<?php echo $userlevels->userlevelname->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $userlevels->userlevelname->EditValue ?>"<?php echo $userlevels->userlevelname->EditAttributes() ?>>
</span><?php echo $userlevels->userlevelname->CustomMsg ?></td>
	</tr>
<?php } ?>
	<!-- row for permission values -->
	<tr>
    <td class="ewTableHeader"><?php echo $Language->Phrase("Permission") ?></td>
    <td>
<label><input type="checkbox" name="x_ewAllowAdd" id="Add" value="<?php echo EW_ALLOW_ADD ?>"><?php echo $Language->Phrase("PermissionAddCopy") ?></label>
<label><input type="checkbox" name="x_ewAllowDelete" id="Delete" value="<?php echo EW_ALLOW_DELETE ?>"><?php echo $Language->Phrase("PermissionDelete") ?></label>
<label><input type="checkbox" name="x_ewAllowEdit" id="Edit" value="<?php echo EW_ALLOW_EDIT ?>"><?php echo $Language->Phrase("PermissionEdit") ?></label>
<?php if (defined("EW_USER_LEVEL_COMPAT")) { ?>
<label><input type="checkbox" name="x_ewAllowList" id="List" value="<?php echo EW_ALLOW_LIST ?>"><?php echo $Language->Phrase("PermissionListSearchView") ?></label>
<?php } else { ?>
<label><input type="checkbox" name="x_ewAllowList" id="List" value="<?php echo EW_ALLOW_LIST ?>"><?php echo $Language->Phrase("PermissionList") ?></label>
<label><input type="checkbox" name="x_ewAllowView" id="View" value="<?php echo EW_ALLOW_VIEW ?>"><?php echo $Language->Phrase("PermissionView") ?></label>
<label><input type="checkbox" name="x_ewAllowSearch" id="Search" value="<?php echo EW_ALLOW_SEARCH ?>"><?php echo $Language->Phrase("PermissionSearch") ?></label>
<?php } ?>
</td>
  </tr> 
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
$userlevels_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserlevels_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'userlevels';

	// Page object name
	var $PageObjName = 'userlevels_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $userlevels;
		if ($userlevels->UseTokenInUrl) $PageUrl .= "t=" . $userlevels->TableVar . "&"; // Add page token
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
		global $objForm, $userlevels;
		if ($userlevels->UseTokenInUrl) {
			if ($objForm)
				return ($userlevels->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($userlevels->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuserlevels_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (userlevels)
		$GLOBALS["userlevels"] = new cuserlevels();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'userlevels', TRUE);

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
		global $userlevels;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $objForm, $Language, $gsFormError, $userlevels;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["userlevelid"] != "") {
		  $userlevels->userlevelid->setQueryStringValue($_GET["userlevelid"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $userlevels->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

		  // Load values for user privileges
		  $x_ewAllowAdd = @$_POST["x_ewAllowAdd"];
		  if ($x_ewAllowAdd == "") $x_ewAllowAdd = 0;
		  $x_ewAllowEdit = @$_POST["x_ewAllowEdit"];
		  if ($x_ewAllowEdit == "") $x_ewAllowEdit = 0;
		  $x_ewAllowDelete = @$_POST["x_ewAllowDelete"];
		  if ($x_ewAllowDelete == "") $x_ewAllowDelete = 0;
		  $x_ewAllowList = @$_POST["x_ewAllowList"];
		  if ($x_ewAllowList == "") $x_ewAllowList = 0;
		  if (defined("EW_USER_LEVEL_COMPAT")) {
		    $this->lPriv = intval($x_ewAllowAdd) + intval($x_ewAllowEdit) +
		      intval($x_ewAllowDelete) + intval($x_ewAllowList);
		  } else {
		    $x_ewAllowView = @$_POST["x_ewAllowView"];
		    if ($x_ewAllowView == "") $x_ewAllowView = 0;
		    $x_ewAllowSearch = @$_POST["x_ewAllowSearch"];
		    if ($x_ewAllowSearch == "") $x_ewAllowSearch = 0;
		    $this->lPriv = intval($x_ewAllowAdd) + intval($x_ewAllowEdit) +
		      intval($x_ewAllowDelete) + intval($x_ewAllowList) +
		      intval($x_ewAllowView) + intval($x_ewAllowSearch);
		  }

			// Validate form
			if (!$this->ValidateForm()) {
				$userlevels->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $userlevels->CurrentAction = "C"; // Copy record
		  } else {
		    $userlevels->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($userlevels->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("userlevelslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$userlevels->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $userlevels->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$userlevels->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $userlevels;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $userlevels;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $userlevels;
		$userlevels->userlevelid->setFormValue($objForm->GetValue("x_userlevelid"));
		$userlevels->userlevelname->setFormValue($objForm->GetValue("x_userlevelname"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $userlevels;
		$userlevels->userlevelid->CurrentValue = $userlevels->userlevelid->FormValue;
		$userlevels->userlevelname->CurrentValue = $userlevels->userlevelname->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $userlevels;
		$sFilter = $userlevels->KeyFilter();

		// Call Row Selecting event
		$userlevels->Row_Selecting($sFilter);

		// Load SQL based on filter
		$userlevels->CurrentFilter = $sFilter;
		$sSql = $userlevels->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$userlevels->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $userlevels;
		$userlevels->userlevelid->setDbValue($rs->fields('userlevelid'));
		if (is_null($userlevels->userlevelid->CurrentValue)) {
			$userlevels->userlevelid->CurrentValue = 0;
		} else {
			$userlevels->userlevelid->CurrentValue = intval($userlevels->userlevelid->CurrentValue);
		}
		$userlevels->userlevelname->setDbValue($rs->fields('userlevelname'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $userlevels;

		// Initialize URLs
		// Call Row_Rendering event

		$userlevels->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$userlevels->userlevelid->CellCssStyle = ""; $userlevels->userlevelid->CellCssClass = "";
		$userlevels->userlevelid->CellAttrs = array(); $userlevels->userlevelid->ViewAttrs = array(); $userlevels->userlevelid->EditAttrs = array();

		// userlevelname
		$userlevels->userlevelname->CellCssStyle = ""; $userlevels->userlevelname->CellCssClass = "";
		$userlevels->userlevelname->CellAttrs = array(); $userlevels->userlevelname->ViewAttrs = array(); $userlevels->userlevelname->EditAttrs = array();
		if ($userlevels->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$userlevels->userlevelid->ViewValue = $userlevels->userlevelid->CurrentValue;
			$userlevels->userlevelid->CssStyle = "";
			$userlevels->userlevelid->CssClass = "";
			$userlevels->userlevelid->ViewCustomAttributes = "";

			// userlevelname
			$userlevels->userlevelname->ViewValue = $userlevels->userlevelname->CurrentValue;
			$userlevels->userlevelname->CssStyle = "";
			$userlevels->userlevelname->CssClass = "";
			$userlevels->userlevelname->ViewCustomAttributes = "";

			// userlevelid
			$userlevels->userlevelid->HrefValue = "";
			$userlevels->userlevelid->TooltipValue = "";

			// userlevelname
			$userlevels->userlevelname->HrefValue = "";
			$userlevels->userlevelname->TooltipValue = "";
		} elseif ($userlevels->RowType == EW_ROWTYPE_ADD) { // Add row

			// userlevelid
			$userlevels->userlevelid->EditCustomAttributes = "";
			$userlevels->userlevelid->EditValue = ew_HtmlEncode($userlevels->userlevelid->CurrentValue);

			// userlevelname
			$userlevels->userlevelname->EditCustomAttributes = "";
			$userlevels->userlevelname->EditValue = ew_HtmlEncode($userlevels->userlevelname->CurrentValue);
		}

		// Call Row Rendered event
		if ($userlevels->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$userlevels->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $userlevels;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($userlevels->userlevelid->FormValue) && $userlevels->userlevelid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userlevels->userlevelid->FldCaption();
		}
		if (!ew_CheckInteger($userlevels->userlevelid->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $userlevels->userlevelid->FldErrMsg();
		}
		if (!is_null($userlevels->userlevelname->FormValue) && $userlevels->userlevelname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userlevels->userlevelname->FldCaption();
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
		global $conn, $Language, $Security, $userlevels;
		if (trim(strval($userlevels->userlevelid->CurrentValue)) == "") {
			$this->setMessage($Language->Phrase("MissingUserLevelID"));
		} elseif (trim($userlevels->userlevelname->CurrentValue) == "") {
			$this->setMessage($Language->Phrase("MissingUserLevelName"));
		} elseif (!is_numeric($userlevels->userlevelid->CurrentValue)) {
			$this->setMessage($Language->Phrase("UserLevelIDInteger"));
		} elseif (intval($userlevels->userlevelid->CurrentValue) < -1) {
			$this->setMessage($Language->Phrase("UserLevelIDIncorrect"));
		} elseif (intval($userlevels->userlevelid->CurrentValue) == 0 && strtolower(trim($userlevels->userlevelname->CurrentValue)) <> "default") {
			$this->setMessage($Language->Phrase("UserLevelDefaultName"));
		} elseif (intval($userlevels->userlevelid->CurrentValue) == -1 && strtolower(trim($userlevels->userlevelname->CurrentValue)) <> "administrator") {
			$this->setMessage($Language->Phrase("UserLevelAdministratorName"));
		} elseif (intval($userlevels->userlevelid->CurrentValue) > 0 && (strtolower(trim($userlevels->userlevelname->CurrentValue)) == "administrator" || strtolower(trim($userlevels->userlevelname->CurrentValue)) == "default")) {
			$this->setMessage($Language->Phrase("UserLevelNameIncorrect"));
		}
		if ($this->getMessage() <> "")
			return FALSE;

		// Check if key value entered
		if ($userlevels->userlevelid->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $userlevels->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $userlevels->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// userlevelid
		$userlevels->userlevelid->SetDbValueDef($rsnew, $userlevels->userlevelid->CurrentValue, 0, FALSE);

		// userlevelname
		$userlevels->userlevelname->SetDbValueDef($rsnew, $userlevels->userlevelname->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$bInsertRow = $userlevels->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($userlevels->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($userlevels->CancelMessage <> "") {
				$this->setMessage($userlevels->CancelMessage);
				$userlevels->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$userlevels->Row_Inserted($rsnew);
		}

		// Add User Level priv
		if ($this->lPriv > 0 && is_array($GLOBALS["EW_USER_LEVEL_TABLE_NAME"])) {
			for ($i = 0; $i < count($GLOBALS["EW_USER_LEVEL_TABLE_NAME"]); $i++) {
				$sSql = "INSERT INTO " . EW_USER_LEVEL_PRIV_TABLE . " (" .
					EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD . ", " .
					EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . ", " .
					EW_USER_LEVEL_PRIV_PRIV_FIELD . ") VALUES ('" .
					ew_AdjustSql($GLOBALS["EW_USER_LEVEL_TABLE_NAME"][$i]) .
					"', " . $userlevels->userlevelid->CurrentValue . ", " . $this->lPriv . ")";
				$conn->Execute($sSql);
			}
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
