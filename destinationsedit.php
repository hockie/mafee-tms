<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "destinationsinfo.php" ?>
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
$destinations_edit = new cdestinations_edit();
$Page =& $destinations_edit;

// Page init
$destinations_edit->Page_Init();

// Page main
$destinations_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var destinations_edit = new ew_Page("destinations_edit");

// page properties
destinations_edit.PageID = "edit"; // page ID
destinations_edit.FormID = "fdestinationsedit"; // form ID
var EW_PAGE_ID = destinations_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
destinations_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Client"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($destinations->Client->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
destinations_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
destinations_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
destinations_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
destinations_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $destinations->TableCaption() ?><br><br>
<a href="<?php echo $destinations->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$destinations_edit->ShowMessage();
?>
<form name="fdestinationsedit" id="fdestinationsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return destinations_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="destinations">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($destinations->id->Visible) { // id ?>
	<tr<?php echo $destinations->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $destinations->id->FldCaption() ?></td>
		<td<?php echo $destinations->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $destinations->id->ViewAttributes() ?>><?php echo $destinations->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($destinations->id->CurrentValue) ?>">
</span><?php echo $destinations->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($destinations->Destination->Visible) { // Destination ?>
	<tr<?php echo $destinations->Destination->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $destinations->Destination->FldCaption() ?></td>
		<td<?php echo $destinations->Destination->CellAttributes() ?>><span id="el_Destination">
<input type="text" name="x_Destination" id="x_Destination" title="<?php echo $destinations->Destination->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $destinations->Destination->EditValue ?>"<?php echo $destinations->Destination->EditAttributes() ?>>
</span><?php echo $destinations->Destination->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($destinations->Client->Visible) { // Client ?>
	<tr<?php echo $destinations->Client->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $destinations->Client->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $destinations->Client->CellAttributes() ?>><span id="el_Client">
<select id="x_Client" name="x_Client" title="<?php echo $destinations->Client->FldTitle() ?>"<?php echo $destinations->Client->EditAttributes() ?>>
<?php
if (is_array($destinations->Client->EditValue)) {
	$arwrk = $destinations->Client->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($destinations->Client->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $destinations->Client->CustomMsg ?></td>
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
$destinations_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cdestinations_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'destinations';

	// Page object name
	var $PageObjName = 'destinations_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $destinations;
		if ($destinations->UseTokenInUrl) $PageUrl .= "t=" . $destinations->TableVar . "&"; // Add page token
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
		global $objForm, $destinations;
		if ($destinations->UseTokenInUrl) {
			if ($objForm)
				return ($destinations->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($destinations->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdestinations_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (destinations)
		$GLOBALS["destinations"] = new cdestinations();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'destinations', TRUE);

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
		global $destinations;

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
			$this->Page_Terminate("destinationslist.php");
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
		global $objForm, $Language, $gsFormError, $destinations;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$destinations->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$destinations->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$destinations->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$destinations->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$destinations->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($destinations->id->CurrentValue == "")
			$this->Page_Terminate("destinationslist.php"); // Invalid key, return to list
		switch ($destinations->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("destinationslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$destinations->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $destinations->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$destinations->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$destinations->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $destinations;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $destinations;
		$destinations->id->setFormValue($objForm->GetValue("x_id"));
		$destinations->Destination->setFormValue($objForm->GetValue("x_Destination"));
		$destinations->Client->setFormValue($objForm->GetValue("x_Client"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $destinations;
		$this->LoadRow();
		$destinations->id->CurrentValue = $destinations->id->FormValue;
		$destinations->Destination->CurrentValue = $destinations->Destination->FormValue;
		$destinations->Client->CurrentValue = $destinations->Client->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $destinations;
		$sFilter = $destinations->KeyFilter();

		// Call Row Selecting event
		$destinations->Row_Selecting($sFilter);

		// Load SQL based on filter
		$destinations->CurrentFilter = $sFilter;
		$sSql = $destinations->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$destinations->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $destinations;
		$destinations->id->setDbValue($rs->fields('id'));
		$destinations->Destination->setDbValue($rs->fields('Destination'));
		$destinations->Client->setDbValue($rs->fields('Client'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $destinations;

		// Initialize URLs
		// Call Row_Rendering event

		$destinations->Row_Rendering();

		// Common render codes for all row types
		// id

		$destinations->id->CellCssStyle = ""; $destinations->id->CellCssClass = "";
		$destinations->id->CellAttrs = array(); $destinations->id->ViewAttrs = array(); $destinations->id->EditAttrs = array();

		// Destination
		$destinations->Destination->CellCssStyle = ""; $destinations->Destination->CellCssClass = "";
		$destinations->Destination->CellAttrs = array(); $destinations->Destination->ViewAttrs = array(); $destinations->Destination->EditAttrs = array();

		// Client
		$destinations->Client->CellCssStyle = ""; $destinations->Client->CellCssClass = "";
		$destinations->Client->CellAttrs = array(); $destinations->Client->ViewAttrs = array(); $destinations->Client->EditAttrs = array();
		if ($destinations->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$destinations->id->ViewValue = $destinations->id->CurrentValue;
			$destinations->id->CssStyle = "";
			$destinations->id->CssClass = "";
			$destinations->id->ViewCustomAttributes = "";

			// Destination
			$destinations->Destination->ViewValue = $destinations->Destination->CurrentValue;
			$destinations->Destination->CssStyle = "";
			$destinations->Destination->CssClass = "";
			$destinations->Destination->ViewCustomAttributes = "";

			// Client
			if (strval($destinations->Client->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($destinations->Client->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$destinations->Client->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$destinations->Client->ViewValue = $destinations->Client->CurrentValue;
				}
			} else {
				$destinations->Client->ViewValue = NULL;
			}
			$destinations->Client->CssStyle = "";
			$destinations->Client->CssClass = "";
			$destinations->Client->ViewCustomAttributes = "";

			// id
			$destinations->id->HrefValue = "";
			$destinations->id->TooltipValue = "";

			// Destination
			$destinations->Destination->HrefValue = "";
			$destinations->Destination->TooltipValue = "";

			// Client
			$destinations->Client->HrefValue = "";
			$destinations->Client->TooltipValue = "";
		} elseif ($destinations->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$destinations->id->EditCustomAttributes = "";
			$destinations->id->EditValue = $destinations->id->CurrentValue;
			$destinations->id->CssStyle = "";
			$destinations->id->CssClass = "";
			$destinations->id->ViewCustomAttributes = "";

			// Destination
			$destinations->Destination->EditCustomAttributes = "";
			$destinations->Destination->EditValue = ew_HtmlEncode($destinations->Destination->CurrentValue);

			// Client
			$destinations->Client->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Client_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$destinations->Client->EditValue = $arwrk;

			// Edit refer script
			// id

			$destinations->id->HrefValue = "";

			// Destination
			$destinations->Destination->HrefValue = "";

			// Client
			$destinations->Client->HrefValue = "";
		}

		// Call Row Rendered event
		if ($destinations->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$destinations->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $destinations;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($destinations->Client->FormValue) && $destinations->Client->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $destinations->Client->FldCaption();
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $destinations;
		$sFilter = $destinations->KeyFilter();
		$destinations->CurrentFilter = $sFilter;
		$sSql = $destinations->SQL();
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

			// Destination
			$destinations->Destination->SetDbValueDef($rsnew, $destinations->Destination->CurrentValue, NULL, FALSE);

			// Client
			$destinations->Client->SetDbValueDef($rsnew, $destinations->Client->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $destinations->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($destinations->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($destinations->CancelMessage <> "") {
					$this->setMessage($destinations->CancelMessage);
					$destinations->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$destinations->Row_Updated($rsold, $rsnew);
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
