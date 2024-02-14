<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "client_payment_periodinfo.php" ?>
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
$client_payment_period_edit = new cclient_payment_period_edit();
$Page =& $client_payment_period_edit;

// Page init
$client_payment_period_edit->Page_Init();

// Page main
$client_payment_period_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var client_payment_period_edit = new ew_Page("client_payment_period_edit");

// page properties
client_payment_period_edit.PageID = "edit"; // page ID
client_payment_period_edit.FormID = "fclient_payment_periodedit"; // form ID
var EW_PAGE_ID = client_payment_period_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
client_payment_period_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_payment_period"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($client_payment_period->payment_period->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
client_payment_period_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
client_payment_period_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
client_payment_period_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $client_payment_period->TableCaption() ?><br><br>
<a href="<?php echo $client_payment_period->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$client_payment_period_edit->ShowMessage();
?>
<form name="fclient_payment_periodedit" id="fclient_payment_periodedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return client_payment_period_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="client_payment_period">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($client_payment_period->id->Visible) { // id ?>
	<tr<?php echo $client_payment_period->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $client_payment_period->id->FldCaption() ?></td>
		<td<?php echo $client_payment_period->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $client_payment_period->id->ViewAttributes() ?>><?php echo $client_payment_period->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($client_payment_period->id->CurrentValue) ?>">
</span><?php echo $client_payment_period->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($client_payment_period->client_id->Visible) { // client_id ?>
	<tr<?php echo $client_payment_period->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $client_payment_period->client_id->FldCaption() ?></td>
		<td<?php echo $client_payment_period->client_id->CellAttributes() ?>><span id="el_client_id">
<select id="x_client_id" name="x_client_id" title="<?php echo $client_payment_period->client_id->FldTitle() ?>"<?php echo $client_payment_period->client_id->EditAttributes() ?>>
<?php
if (is_array($client_payment_period->client_id->EditValue)) {
	$arwrk = $client_payment_period->client_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($client_payment_period->client_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $client_payment_period->client_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($client_payment_period->payment_period->Visible) { // payment_period ?>
	<tr<?php echo $client_payment_period->payment_period->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $client_payment_period->payment_period->FldCaption() ?></td>
		<td<?php echo $client_payment_period->payment_period->CellAttributes() ?>><span id="el_payment_period">
<input type="text" name="x_payment_period" id="x_payment_period" title="<?php echo $client_payment_period->payment_period->FldTitle() ?>" size="30" value="<?php echo $client_payment_period->payment_period->EditValue ?>"<?php echo $client_payment_period->payment_period->EditAttributes() ?>>
</span><?php echo $client_payment_period->payment_period->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($client_payment_period->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $client_payment_period->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $client_payment_period->Remarks->FldCaption() ?></td>
		<td<?php echo $client_payment_period->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $client_payment_period->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $client_payment_period->Remarks->EditAttributes() ?>><?php echo $client_payment_period->Remarks->EditValue ?></textarea>
</span><?php echo $client_payment_period->Remarks->CustomMsg ?></td>
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
$client_payment_period_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cclient_payment_period_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'client_payment_period';

	// Page object name
	var $PageObjName = 'client_payment_period_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $client_payment_period;
		if ($client_payment_period->UseTokenInUrl) $PageUrl .= "t=" . $client_payment_period->TableVar . "&"; // Add page token
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
		global $objForm, $client_payment_period;
		if ($client_payment_period->UseTokenInUrl) {
			if ($objForm)
				return ($client_payment_period->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($client_payment_period->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclient_payment_period_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (client_payment_period)
		$GLOBALS["client_payment_period"] = new cclient_payment_period();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'client_payment_period', TRUE);

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
		global $client_payment_period;

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
			$this->Page_Terminate("client_payment_periodlist.php");
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
		global $objForm, $Language, $gsFormError, $client_payment_period;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$client_payment_period->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$client_payment_period->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$client_payment_period->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$client_payment_period->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$client_payment_period->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($client_payment_period->id->CurrentValue == "")
			$this->Page_Terminate("client_payment_periodlist.php"); // Invalid key, return to list
		switch ($client_payment_period->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("client_payment_periodlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$client_payment_period->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $client_payment_period->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$client_payment_period->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$client_payment_period->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $client_payment_period;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $client_payment_period;
		$client_payment_period->id->setFormValue($objForm->GetValue("x_id"));
		$client_payment_period->client_id->setFormValue($objForm->GetValue("x_client_id"));
		$client_payment_period->payment_period->setFormValue($objForm->GetValue("x_payment_period"));
		$client_payment_period->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $client_payment_period;
		$this->LoadRow();
		$client_payment_period->id->CurrentValue = $client_payment_period->id->FormValue;
		$client_payment_period->client_id->CurrentValue = $client_payment_period->client_id->FormValue;
		$client_payment_period->payment_period->CurrentValue = $client_payment_period->payment_period->FormValue;
		$client_payment_period->Remarks->CurrentValue = $client_payment_period->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $client_payment_period;
		$sFilter = $client_payment_period->KeyFilter();

		// Call Row Selecting event
		$client_payment_period->Row_Selecting($sFilter);

		// Load SQL based on filter
		$client_payment_period->CurrentFilter = $sFilter;
		$sSql = $client_payment_period->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$client_payment_period->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $client_payment_period;
		$client_payment_period->id->setDbValue($rs->fields('id'));
		$client_payment_period->client_id->setDbValue($rs->fields('client_id'));
		$client_payment_period->payment_period->setDbValue($rs->fields('payment_period'));
		$client_payment_period->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $client_payment_period;

		// Initialize URLs
		// Call Row_Rendering event

		$client_payment_period->Row_Rendering();

		// Common render codes for all row types
		// id

		$client_payment_period->id->CellCssStyle = ""; $client_payment_period->id->CellCssClass = "";
		$client_payment_period->id->CellAttrs = array(); $client_payment_period->id->ViewAttrs = array(); $client_payment_period->id->EditAttrs = array();

		// client_id
		$client_payment_period->client_id->CellCssStyle = ""; $client_payment_period->client_id->CellCssClass = "";
		$client_payment_period->client_id->CellAttrs = array(); $client_payment_period->client_id->ViewAttrs = array(); $client_payment_period->client_id->EditAttrs = array();

		// payment_period
		$client_payment_period->payment_period->CellCssStyle = ""; $client_payment_period->payment_period->CellCssClass = "";
		$client_payment_period->payment_period->CellAttrs = array(); $client_payment_period->payment_period->ViewAttrs = array(); $client_payment_period->payment_period->EditAttrs = array();

		// Remarks
		$client_payment_period->Remarks->CellCssStyle = ""; $client_payment_period->Remarks->CellCssClass = "";
		$client_payment_period->Remarks->CellAttrs = array(); $client_payment_period->Remarks->ViewAttrs = array(); $client_payment_period->Remarks->EditAttrs = array();
		if ($client_payment_period->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$client_payment_period->id->ViewValue = $client_payment_period->id->CurrentValue;
			$client_payment_period->id->CssStyle = "";
			$client_payment_period->id->CssClass = "";
			$client_payment_period->id->ViewCustomAttributes = "";

			// client_id
			if (strval($client_payment_period->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($client_payment_period->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$client_payment_period->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$client_payment_period->client_id->ViewValue = $client_payment_period->client_id->CurrentValue;
				}
			} else {
				$client_payment_period->client_id->ViewValue = NULL;
			}
			$client_payment_period->client_id->CssStyle = "";
			$client_payment_period->client_id->CssClass = "";
			$client_payment_period->client_id->ViewCustomAttributes = "";

			// payment_period
			$client_payment_period->payment_period->ViewValue = $client_payment_period->payment_period->CurrentValue;
			$client_payment_period->payment_period->CssStyle = "";
			$client_payment_period->payment_period->CssClass = "";
			$client_payment_period->payment_period->ViewCustomAttributes = "";

			// Remarks
			$client_payment_period->Remarks->ViewValue = $client_payment_period->Remarks->CurrentValue;
			$client_payment_period->Remarks->CssStyle = "";
			$client_payment_period->Remarks->CssClass = "";
			$client_payment_period->Remarks->ViewCustomAttributes = "";

			// id
			$client_payment_period->id->HrefValue = "";
			$client_payment_period->id->TooltipValue = "";

			// client_id
			$client_payment_period->client_id->HrefValue = "";
			$client_payment_period->client_id->TooltipValue = "";

			// payment_period
			$client_payment_period->payment_period->HrefValue = "";
			$client_payment_period->payment_period->TooltipValue = "";

			// Remarks
			$client_payment_period->Remarks->HrefValue = "";
			$client_payment_period->Remarks->TooltipValue = "";
		} elseif ($client_payment_period->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$client_payment_period->id->EditCustomAttributes = "";
			$client_payment_period->id->EditValue = $client_payment_period->id->CurrentValue;
			$client_payment_period->id->CssStyle = "";
			$client_payment_period->id->CssClass = "";
			$client_payment_period->id->ViewCustomAttributes = "";

			// client_id
			$client_payment_period->client_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Client_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$client_payment_period->client_id->EditValue = $arwrk;

			// payment_period
			$client_payment_period->payment_period->EditCustomAttributes = "";
			$client_payment_period->payment_period->EditValue = ew_HtmlEncode($client_payment_period->payment_period->CurrentValue);

			// Remarks
			$client_payment_period->Remarks->EditCustomAttributes = "";
			$client_payment_period->Remarks->EditValue = ew_HtmlEncode($client_payment_period->Remarks->CurrentValue);

			// Edit refer script
			// id

			$client_payment_period->id->HrefValue = "";

			// client_id
			$client_payment_period->client_id->HrefValue = "";

			// payment_period
			$client_payment_period->payment_period->HrefValue = "";

			// Remarks
			$client_payment_period->Remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($client_payment_period->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$client_payment_period->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $client_payment_period;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($client_payment_period->payment_period->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $client_payment_period->payment_period->FldErrMsg();
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
		global $conn, $Security, $Language, $client_payment_period;
		$sFilter = $client_payment_period->KeyFilter();
		$client_payment_period->CurrentFilter = $sFilter;
		$sSql = $client_payment_period->SQL();
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

			// client_id
			$client_payment_period->client_id->SetDbValueDef($rsnew, $client_payment_period->client_id->CurrentValue, NULL, FALSE);

			// payment_period
			$client_payment_period->payment_period->SetDbValueDef($rsnew, $client_payment_period->payment_period->CurrentValue, NULL, FALSE);

			// Remarks
			$client_payment_period->Remarks->SetDbValueDef($rsnew, $client_payment_period->Remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $client_payment_period->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($client_payment_period->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($client_payment_period->CancelMessage <> "") {
					$this->setMessage($client_payment_period->CancelMessage);
					$client_payment_period->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$client_payment_period->Row_Updated($rsold, $rsnew);
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
