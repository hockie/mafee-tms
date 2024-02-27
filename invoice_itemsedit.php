<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "invoice_itemsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "invoicesinfo.php" ?>
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
$invoice_items_edit = new cinvoice_items_edit();
$Page =& $invoice_items_edit;

// Page init
$invoice_items_edit->Page_Init();

// Page main
$invoice_items_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var invoice_items_edit = new ew_Page("invoice_items_edit");

// page properties
invoice_items_edit.PageID = "edit"; // page ID
invoice_items_edit.FormID = "finvoice_itemsedit"; // form ID
var EW_PAGE_ID = invoice_items_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
invoice_items_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_invoice_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoice_items->invoice_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_client_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($invoice_items->client_id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
invoice_items_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoice_items_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoice_items_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoice_items_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoice_items->TableCaption() ?><br><br>
<a href="<?php echo $invoice_items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoice_items_edit->ShowMessage();
?>
<form name="finvoice_itemsedit" id="finvoice_itemsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return invoice_items_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="invoice_items">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($invoice_items->id->Visible) { // id ?>
	<tr<?php echo $invoice_items->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->id->FldCaption() ?></td>
		<td<?php echo $invoice_items->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $invoice_items->id->ViewAttributes() ?>><?php echo $invoice_items->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($invoice_items->id->CurrentValue) ?>">
</span><?php echo $invoice_items->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoice_items->invoice_id->Visible) { // invoice_id ?>
	<tr<?php echo $invoice_items->invoice_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->invoice_id->FldCaption() ?></td>
		<td<?php echo $invoice_items->invoice_id->CellAttributes() ?>><span id="el_invoice_id">
<?php if ($invoice_items->invoice_id->getSessionValue() <> "") { ?>
<div<?php echo $invoice_items->invoice_id->ViewAttributes() ?>><?php echo $invoice_items->invoice_id->ViewValue ?></div>
<input type="hidden" id="x_invoice_id" name="x_invoice_id" value="<?php echo ew_HtmlEncode($invoice_items->invoice_id->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_invoice_id" id="x_invoice_id" title="<?php echo $invoice_items->invoice_id->FldTitle() ?>" size="30" value="<?php echo $invoice_items->invoice_id->EditValue ?>"<?php echo $invoice_items->invoice_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $invoice_items->invoice_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoice_items->client_id->Visible) { // client_id ?>
	<tr<?php echo $invoice_items->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->client_id->FldCaption() ?></td>
		<td<?php echo $invoice_items->client_id->CellAttributes() ?>><span id="el_client_id">
<?php if ($invoice_items->client_id->getSessionValue() <> "") { ?>
<div<?php echo $invoice_items->client_id->ViewAttributes() ?>><?php echo $invoice_items->client_id->ViewValue ?></div>
<input type="hidden" id="x_client_id" name="x_client_id" value="<?php echo ew_HtmlEncode($invoice_items->client_id->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_client_id" id="x_client_id" title="<?php echo $invoice_items->client_id->FldTitle() ?>" size="30" value="<?php echo $invoice_items->client_id->EditValue ?>"<?php echo $invoice_items->client_id->EditAttributes() ?>>
<?php } ?>
</span><?php echo $invoice_items->client_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($invoice_items->booking_id->Visible) { // booking_id ?>
	<tr<?php echo $invoice_items->booking_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->booking_id->FldCaption() ?></td>
		<td<?php echo $invoice_items->booking_id->CellAttributes() ?>><span id="el_booking_id">
<select id="x_booking_id" name="x_booking_id" title="<?php echo $invoice_items->booking_id->FldTitle() ?>"<?php echo $invoice_items->booking_id->EditAttributes() ?>>
<?php
if (is_array($invoice_items->booking_id->EditValue)) {
	$arwrk = $invoice_items->booking_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoice_items->booking_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $invoice_items->booking_id->CustomMsg ?></td>
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
$invoice_items_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoice_items_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'invoice_items';

	// Page object name
	var $PageObjName = 'invoice_items_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $invoice_items;
		if ($invoice_items->UseTokenInUrl) $PageUrl .= "t=" . $invoice_items->TableVar . "&"; // Add page token
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
		global $objForm, $invoice_items;
		if ($invoice_items->UseTokenInUrl) {
			if ($objForm)
				return ($invoice_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($invoice_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinvoice_items_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (invoice_items)
		$GLOBALS["invoice_items"] = new cinvoice_items();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoices)
		$GLOBALS['invoices'] = new cinvoices();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'invoice_items', TRUE);

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
		global $invoice_items;

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
			$this->Page_Terminate("invoice_itemslist.php");
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
		global $objForm, $Language, $gsFormError, $invoice_items;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$invoice_items->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$invoice_items->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$invoice_items->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$invoice_items->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$invoice_items->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($invoice_items->id->CurrentValue == "")
			$this->Page_Terminate("invoice_itemslist.php"); // Invalid key, return to list
		switch ($invoice_items->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("invoice_itemslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$invoice_items->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $invoice_items->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$invoice_items->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$invoice_items->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $invoice_items;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $invoice_items;
		$invoice_items->id->setFormValue($objForm->GetValue("x_id"));
		$invoice_items->invoice_id->setFormValue($objForm->GetValue("x_invoice_id"));
		$invoice_items->client_id->setFormValue($objForm->GetValue("x_client_id"));
		$invoice_items->booking_id->setFormValue($objForm->GetValue("x_booking_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $invoice_items;
		$this->LoadRow();
		$invoice_items->id->CurrentValue = $invoice_items->id->FormValue;
		$invoice_items->invoice_id->CurrentValue = $invoice_items->invoice_id->FormValue;
		$invoice_items->client_id->CurrentValue = $invoice_items->client_id->FormValue;
		$invoice_items->booking_id->CurrentValue = $invoice_items->booking_id->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $invoice_items;
		$sFilter = $invoice_items->KeyFilter();

		// Call Row Selecting event
		$invoice_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$invoice_items->CurrentFilter = $sFilter;
		$sSql = $invoice_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$invoice_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $invoice_items;
		$invoice_items->id->setDbValue($rs->fields('id'));
		$invoice_items->invoice_id->setDbValue($rs->fields('invoice_id'));
		$invoice_items->client_id->setDbValue($rs->fields('client_id'));
		$invoice_items->booking_id->setDbValue($rs->fields('booking_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $invoice_items;

		// Initialize URLs
		// Call Row_Rendering event

		$invoice_items->Row_Rendering();

		// Common render codes for all row types
		// id

		$invoice_items->id->CellCssStyle = ""; $invoice_items->id->CellCssClass = "";
		$invoice_items->id->CellAttrs = array(); $invoice_items->id->ViewAttrs = array(); $invoice_items->id->EditAttrs = array();

		// invoice_id
		$invoice_items->invoice_id->CellCssStyle = ""; $invoice_items->invoice_id->CellCssClass = "";
		$invoice_items->invoice_id->CellAttrs = array(); $invoice_items->invoice_id->ViewAttrs = array(); $invoice_items->invoice_id->EditAttrs = array();

		// client_id
		$invoice_items->client_id->CellCssStyle = ""; $invoice_items->client_id->CellCssClass = "";
		$invoice_items->client_id->CellAttrs = array(); $invoice_items->client_id->ViewAttrs = array(); $invoice_items->client_id->EditAttrs = array();

		// booking_id
		$invoice_items->booking_id->CellCssStyle = ""; $invoice_items->booking_id->CellCssClass = "";
		$invoice_items->booking_id->CellAttrs = array(); $invoice_items->booking_id->ViewAttrs = array(); $invoice_items->booking_id->EditAttrs = array();
		if ($invoice_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$invoice_items->id->ViewValue = $invoice_items->id->CurrentValue;
			$invoice_items->id->CssStyle = "";
			$invoice_items->id->CssClass = "";
			$invoice_items->id->ViewCustomAttributes = "";

			// invoice_id
			$invoice_items->invoice_id->ViewValue = $invoice_items->invoice_id->CurrentValue;
			$invoice_items->invoice_id->CssStyle = "";
			$invoice_items->invoice_id->CssClass = "";
			$invoice_items->invoice_id->ViewCustomAttributes = "";

			// client_id
			$invoice_items->client_id->ViewValue = $invoice_items->client_id->CurrentValue;
			$invoice_items->client_id->CssStyle = "";
			$invoice_items->client_id->CssClass = "";
			$invoice_items->client_id->ViewCustomAttributes = "";

			// booking_id
			if (strval($invoice_items->booking_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->booking_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Client_ID`=" . $invoice_items->client_id->ViewValue . " AND `Status_ID`=" . 2 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Booking_Number` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->booking_id->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$invoice_items->booking_id->ViewValue = $invoice_items->booking_id->CurrentValue;
				}
			} else {
				$invoice_items->booking_id->ViewValue = NULL;
			}
			$invoice_items->booking_id->CssStyle = "";
			$invoice_items->booking_id->CssClass = "";
			$invoice_items->booking_id->ViewCustomAttributes = "";

			// id
			$invoice_items->id->HrefValue = "";
			$invoice_items->id->TooltipValue = "";

			// invoice_id
			$invoice_items->invoice_id->HrefValue = "";
			$invoice_items->invoice_id->TooltipValue = "";

			// client_id
			$invoice_items->client_id->HrefValue = "";
			$invoice_items->client_id->TooltipValue = "";

			// booking_id
			if (!ew_Empty($invoice_items->booking_id->CurrentValue)) {
				$invoice_items->booking_id->HrefValue = $invoice_items->booking_id->CurrentValue;
				if ($invoice_items->Export <> "") $invoice_items->booking_id->HrefValue = ew_ConvertFullUrl($invoice_items->booking_id->HrefValue);
			} else {
				$invoice_items->booking_id->HrefValue = "";
			}
			$invoice_items->booking_id->TooltipValue = "";
		} elseif ($invoice_items->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$invoice_items->id->EditCustomAttributes = "";
			$invoice_items->id->EditValue = $invoice_items->id->CurrentValue;
			$invoice_items->id->CssStyle = "";
			$invoice_items->id->CssClass = "";
			$invoice_items->id->ViewCustomAttributes = "";

			// invoice_id
			$invoice_items->invoice_id->EditCustomAttributes = "";
			if ($invoice_items->invoice_id->getSessionValue() <> "") {
				$invoice_items->invoice_id->CurrentValue = $invoice_items->invoice_id->getSessionValue();
			$invoice_items->invoice_id->ViewValue = $invoice_items->invoice_id->CurrentValue;
			$invoice_items->invoice_id->CssStyle = "";
			$invoice_items->invoice_id->CssClass = "";
			$invoice_items->invoice_id->ViewCustomAttributes = "";
			} else {
			$invoice_items->invoice_id->EditValue = ew_HtmlEncode($invoice_items->invoice_id->CurrentValue);
			}

			// client_id
			$invoice_items->client_id->EditCustomAttributes = "";
			if ($invoice_items->client_id->getSessionValue() <> "") {
				$invoice_items->client_id->CurrentValue = $invoice_items->client_id->getSessionValue();
			$invoice_items->client_id->ViewValue = $invoice_items->client_id->CurrentValue;
			$invoice_items->client_id->CssStyle = "";
			$invoice_items->client_id->CssClass = "";
			$invoice_items->client_id->ViewCustomAttributes = "";
			} else {
			$invoice_items->client_id->EditValue = ew_HtmlEncode($invoice_items->client_id->CurrentValue);
			}

			// booking_id
			$invoice_items->booking_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Booking_Number`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Client_ID`=" . $invoice_items->client_id->ViewValue . " AND `Status_ID`=" . 2 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Booking_Number` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$invoice_items->booking_id->EditValue = $arwrk;

			// Edit refer script
			// id

			$invoice_items->id->HrefValue = "";

			// invoice_id
			$invoice_items->invoice_id->HrefValue = "";

			// client_id
			$invoice_items->client_id->HrefValue = "";

			// booking_id
			if (!ew_Empty($invoice_items->booking_id->CurrentValue)) {
				$invoice_items->booking_id->HrefValue = $invoice_items->booking_id->CurrentValue;
				if ($invoice_items->Export <> "") $invoice_items->booking_id->HrefValue = ew_ConvertFullUrl($invoice_items->booking_id->HrefValue);
			} else {
				$invoice_items->booking_id->HrefValue = "";
			}
		}

		// Call Row Rendered event
		if ($invoice_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$invoice_items->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $invoice_items;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($invoice_items->invoice_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $invoice_items->invoice_id->FldErrMsg();
		}
		if (!ew_CheckInteger($invoice_items->client_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $invoice_items->client_id->FldErrMsg();
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
		global $conn, $Security, $Language, $invoice_items;
		$sFilter = $invoice_items->KeyFilter();
		$invoice_items->CurrentFilter = $sFilter;
		$sSql = $invoice_items->SQL();
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

			// invoice_id
			$invoice_items->invoice_id->SetDbValueDef($rsnew, $invoice_items->invoice_id->CurrentValue, NULL, FALSE);

			// client_id
			$invoice_items->client_id->SetDbValueDef($rsnew, $invoice_items->client_id->CurrentValue, NULL, FALSE);

			// booking_id
			$invoice_items->booking_id->SetDbValueDef($rsnew, $invoice_items->booking_id->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $invoice_items->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($invoice_items->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($invoice_items->CancelMessage <> "") {
					$this->setMessage($invoice_items->CancelMessage);
					$invoice_items->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$invoice_items->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $invoice_items;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "invoices") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $invoice_items->SqlMasterFilter_invoices();
				$this->sDbDetailFilter = $invoice_items->SqlDetailFilter_invoices();
				if (@$_GET["id"] <> "") {
					$GLOBALS["invoices"]->id->setQueryStringValue($_GET["id"]);
					$invoice_items->invoice_id->setQueryStringValue($GLOBALS["invoices"]->id->QueryStringValue);
					$invoice_items->invoice_id->setSessionValue($invoice_items->invoice_id->QueryStringValue);
					if (!is_numeric($GLOBALS["invoices"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["invoices"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@invoice_id@", ew_AdjustSql($GLOBALS["invoices"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["Client_ID"] <> "") {
					$GLOBALS["invoices"]->Client_ID->setQueryStringValue($_GET["Client_ID"]);
					$invoice_items->client_id->setQueryStringValue($GLOBALS["invoices"]->Client_ID->QueryStringValue);
					$invoice_items->client_id->setSessionValue($invoice_items->client_id->QueryStringValue);
					if (!is_numeric($GLOBALS["invoices"]->Client_ID->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@Client_ID@", ew_AdjustSql($GLOBALS["invoices"]->Client_ID->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@client_id@", ew_AdjustSql($GLOBALS["invoices"]->Client_ID->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$invoice_items->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$invoice_items->setStartRecordNumber($this->lStartRec);
			$invoice_items->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$invoice_items->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "invoices") {
				if ($invoice_items->invoice_id->QueryStringValue == "") $invoice_items->invoice_id->setSessionValue("");
				if ($invoice_items->client_id->QueryStringValue == "") $invoice_items->client_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $invoice_items->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $invoice_items->getDetailFilter(); // Restore detail filter
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
