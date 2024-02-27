<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "originsinfo.php" ?>
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
$origins_edit = new corigins_edit();
$Page =& $origins_edit;

// Page init
$origins_edit->Page_Init();

// Page main
$origins_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var origins_edit = new ew_Page("origins_edit");

// page properties
origins_edit.PageID = "edit"; // page ID
origins_edit.FormID = "foriginsedit"; // form ID
var EW_PAGE_ID = origins_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
origins_edit.ValidateForm = function(fobj) {
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
origins_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
origins_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
origins_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
origins_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $origins->TableCaption() ?><br><br>
<a href="<?php echo $origins->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$origins_edit->ShowMessage();
?>
<form name="foriginsedit" id="foriginsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return origins_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="origins">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($origins->id->Visible) { // id ?>
	<tr<?php echo $origins->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $origins->id->FldCaption() ?></td>
		<td<?php echo $origins->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $origins->id->ViewAttributes() ?>><?php echo $origins->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($origins->id->CurrentValue) ?>">
</span><?php echo $origins->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($origins->Client->Visible) { // Client ?>
	<tr<?php echo $origins->Client->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $origins->Client->FldCaption() ?></td>
		<td<?php echo $origins->Client->CellAttributes() ?>><span id="el_Client">
<select id="x_Client" name="x_Client" title="<?php echo $origins->Client->FldTitle() ?>"<?php echo $origins->Client->EditAttributes() ?>>
<?php
if (is_array($origins->Client->EditValue)) {
	$arwrk = $origins->Client->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($origins->Client->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $origins->Client->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($origins->Origin->Visible) { // Origin ?>
	<tr<?php echo $origins->Origin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $origins->Origin->FldCaption() ?></td>
		<td<?php echo $origins->Origin->CellAttributes() ?>><span id="el_Origin">
<input type="text" name="x_Origin" id="x_Origin" title="<?php echo $origins->Origin->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $origins->Origin->EditValue ?>"<?php echo $origins->Origin->EditAttributes() ?>>
</span><?php echo $origins->Origin->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$origins_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class corigins_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'origins';

	// Page object name
	var $PageObjName = 'origins_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $origins;
		if ($origins->UseTokenInUrl) $PageUrl .= "t=" . $origins->TableVar . "&"; // Add page token
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
		global $objForm, $origins;
		if ($origins->UseTokenInUrl) {
			if ($objForm)
				return ($origins->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($origins->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function corigins_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (origins)
		$GLOBALS["origins"] = new corigins();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'origins', TRUE);

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
		global $origins;

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("originslist.php");
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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $origins;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$origins->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$origins->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$origins->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$origins->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$origins->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($origins->id->CurrentValue == "")
			$this->Page_Terminate("originslist.php"); // Invalid key, return to list
		switch ($origins->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("originslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$origins->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $origins->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$origins->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$origins->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $origins;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $origins;
		$origins->id->setFormValue($objForm->GetValue("x_id"));
		$origins->Client->setFormValue($objForm->GetValue("x_Client"));
		$origins->Origin->setFormValue($objForm->GetValue("x_Origin"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $origins;
		$this->LoadRow();
		$origins->id->CurrentValue = $origins->id->FormValue;
		$origins->Client->CurrentValue = $origins->Client->FormValue;
		$origins->Origin->CurrentValue = $origins->Origin->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $origins;
		$sFilter = $origins->KeyFilter();

		// Call Row Selecting event
		$origins->Row_Selecting($sFilter);

		// Load SQL based on filter
		$origins->CurrentFilter = $sFilter;
		$sSql = $origins->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$origins->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $origins;
		$origins->id->setDbValue($rs->fields('id'));
		$origins->Client->setDbValue($rs->fields('Client'));
		$origins->Origin->setDbValue($rs->fields('Origin'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $origins;

		// Initialize URLs
		// Call Row_Rendering event

		$origins->Row_Rendering();

		// Common render codes for all row types
		// id

		$origins->id->CellCssStyle = ""; $origins->id->CellCssClass = "";
		$origins->id->CellAttrs = array(); $origins->id->ViewAttrs = array(); $origins->id->EditAttrs = array();

		// Client
		$origins->Client->CellCssStyle = ""; $origins->Client->CellCssClass = "";
		$origins->Client->CellAttrs = array(); $origins->Client->ViewAttrs = array(); $origins->Client->EditAttrs = array();

		// Origin
		$origins->Origin->CellCssStyle = ""; $origins->Origin->CellCssClass = "";
		$origins->Origin->CellAttrs = array(); $origins->Origin->ViewAttrs = array(); $origins->Origin->EditAttrs = array();
		if ($origins->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$origins->id->ViewValue = $origins->id->CurrentValue;
			$origins->id->CssStyle = "";
			$origins->id->CssClass = "";
			$origins->id->ViewCustomAttributes = "";

			// Client
			if (strval($origins->Client->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($origins->Client->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$origins->Client->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$origins->Client->ViewValue = $origins->Client->CurrentValue;
				}
			} else {
				$origins->Client->ViewValue = NULL;
			}
			$origins->Client->CssStyle = "";
			$origins->Client->CssClass = "";
			$origins->Client->ViewCustomAttributes = "";

			// Origin
			$origins->Origin->ViewValue = $origins->Origin->CurrentValue;
			$origins->Origin->CssStyle = "";
			$origins->Origin->CssClass = "";
			$origins->Origin->ViewCustomAttributes = "";

			// id
			$origins->id->HrefValue = "";
			$origins->id->TooltipValue = "";

			// Client
			$origins->Client->HrefValue = "";
			$origins->Client->TooltipValue = "";

			// Origin
			$origins->Origin->HrefValue = "";
			$origins->Origin->TooltipValue = "";
		} elseif ($origins->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$origins->id->EditCustomAttributes = "";
			$origins->id->EditValue = $origins->id->CurrentValue;
			$origins->id->CssStyle = "";
			$origins->id->CssClass = "";
			$origins->id->ViewCustomAttributes = "";

			// Client
			$origins->Client->EditCustomAttributes = "";
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
			$origins->Client->EditValue = $arwrk;

			// Origin
			$origins->Origin->EditCustomAttributes = "";
			$origins->Origin->EditValue = ew_HtmlEncode($origins->Origin->CurrentValue);

			// Edit refer script
			// id

			$origins->id->HrefValue = "";

			// Client
			$origins->Client->HrefValue = "";

			// Origin
			$origins->Origin->HrefValue = "";
		}

		// Call Row Rendered event
		if ($origins->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$origins->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $origins;

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $origins;
		$sFilter = $origins->KeyFilter();
		$origins->CurrentFilter = $sFilter;
		$sSql = $origins->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Client
			$origins->Client->SetDbValueDef($rsnew, $origins->Client->CurrentValue, NULL, FALSE);

			// Origin
			$origins->Origin->SetDbValueDef($rsnew, $origins->Origin->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $origins->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($origins->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($origins->CancelMessage <> "") {
					$this->setMessage($origins->CancelMessage);
					$origins->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$origins->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
