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
$invoice_items_add = new cinvoice_items_add();
$Page =& $invoice_items_add;

// Page init
$invoice_items_add->Page_Init();

// Page main
$invoice_items_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var invoice_items_add = new ew_Page("invoice_items_add");

// page properties
invoice_items_add.PageID = "add"; // page ID
invoice_items_add.FormID = "finvoice_itemsadd"; // form ID
var EW_PAGE_ID = invoice_items_add.PageID; // for backward compatibility

// extend page with ValidateForm function
invoice_items_add.ValidateForm = function(fobj) {
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
invoice_items_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoice_items_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoice_items_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoice_items_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoice_items->TableCaption() ?><br><br>
<a href="<?php echo $invoice_items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoice_items_add->ShowMessage();
?>
<form name="finvoice_itemsadd" id="finvoice_itemsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return invoice_items_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="invoice_items">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($invoice_items->invoice_id->Visible) { // invoice_id ?>
	<tr<?php echo $invoice_items->invoice_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $invoice_items->invoice_id->FldCaption() ?></td>
		<td<?php echo $invoice_items->invoice_id->CellAttributes() ?>><span id="el_invoice_id">
<?php if ($invoice_items->invoice_id->getSessionValue() <> "") { ?>
<div<?php echo $invoice_items->invoice_id->ViewAttributes() ?>><?php echo $invoice_items->invoice_id->ViewValue ?></div>
<input type="hidden" id="x_invoice_id" name="x_invoice_id" value="<?php echo ew_HtmlEncode($invoice_items->invoice_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_invoice_id" name="x_invoice_id" title="<?php echo $invoice_items->invoice_id->FldTitle() ?>"<?php echo $invoice_items->invoice_id->EditAttributes() ?>>
<?php
if (is_array($invoice_items->invoice_id->EditValue)) {
	$arwrk = $invoice_items->invoice_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoice_items->invoice_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<select id="x_client_id" name="x_client_id" title="<?php echo $invoice_items->client_id->FldTitle() ?>"<?php echo $invoice_items->client_id->EditAttributes() ?>>
<?php
if (is_array($invoice_items->client_id->EditValue)) {
	$arwrk = $invoice_items->client_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($invoice_items->client_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$invoice_items_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoice_items_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'invoice_items';

	// Page object name
	var $PageObjName = 'invoice_items_add';

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
	function cinvoice_items_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $invoice_items;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $invoice_items->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $invoice_items->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$invoice_items->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $invoice_items->CurrentAction = "C"; // Copy record
		  } else {
		    $invoice_items->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($invoice_items->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("invoice_itemslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$invoice_items->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $invoice_items->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$invoice_items->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $invoice_items;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $invoice_items;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $invoice_items;
		$invoice_items->invoice_id->setFormValue($objForm->GetValue("x_invoice_id"));
		$invoice_items->client_id->setFormValue($objForm->GetValue("x_client_id"));
		$invoice_items->booking_id->setFormValue($objForm->GetValue("x_booking_id"));
		$invoice_items->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $invoice_items;
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
			if (strval($invoice_items->invoice_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->invoice_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Invoice_Number` FROM `invoices`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->invoice_id->ViewValue = $rswrk->fields('Invoice_Number');
					$rswrk->Close();
				} else {
					$invoice_items->invoice_id->ViewValue = $invoice_items->invoice_id->CurrentValue;
				}
			} else {
				$invoice_items->invoice_id->ViewValue = NULL;
			}
			$invoice_items->invoice_id->CssStyle = "";
			$invoice_items->invoice_id->CssClass = "";
			$invoice_items->invoice_id->ViewCustomAttributes = "";

			// client_id
			if (strval($invoice_items->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$invoice_items->client_id->ViewValue = $invoice_items->client_id->CurrentValue;
				}
			} else {
				$invoice_items->client_id->ViewValue = NULL;
			}
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
		} elseif ($invoice_items->RowType == EW_ROWTYPE_ADD) { // Add row

			// invoice_id
			$invoice_items->invoice_id->EditCustomAttributes = "";
			if ($invoice_items->invoice_id->getSessionValue() <> "") {
				$invoice_items->invoice_id->CurrentValue = $invoice_items->invoice_id->getSessionValue();
			if (strval($invoice_items->invoice_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->invoice_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Invoice_Number` FROM `invoices`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->invoice_id->ViewValue = $rswrk->fields('Invoice_Number');
					$rswrk->Close();
				} else {
					$invoice_items->invoice_id->ViewValue = $invoice_items->invoice_id->CurrentValue;
				}
			} else {
				$invoice_items->invoice_id->ViewValue = NULL;
			}
			$invoice_items->invoice_id->CssStyle = "";
			$invoice_items->invoice_id->CssClass = "";
			$invoice_items->invoice_id->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Invoice_Number`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `invoices`";
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
			$invoice_items->invoice_id->EditValue = $arwrk;
			}

			// client_id
			$invoice_items->client_id->EditCustomAttributes = "";
			if ($invoice_items->client_id->getSessionValue() <> "") {
				$invoice_items->client_id->CurrentValue = $invoice_items->client_id->getSessionValue();
			if (strval($invoice_items->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$invoice_items->client_id->ViewValue = $invoice_items->client_id->CurrentValue;
				}
			} else {
				$invoice_items->client_id->ViewValue = NULL;
			}
			$invoice_items->client_id->CssStyle = "";
			$invoice_items->client_id->CssClass = "";
			$invoice_items->client_id->ViewCustomAttributes = "";
			} else {
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
			$invoice_items->client_id->EditValue = $arwrk;
			}

			// booking_id
			$invoice_items->booking_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Booking_Number`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`client_id`=" . $invoice_items->client_id->CurrentValue . " AND `status_id`=" . 2 .  " AND `billing_type_id`=" . 1 . ")";
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
		global $conn, $Language, $Security, $invoice_items;
		$rsnew = array();

		// invoice_id
		$invoice_items->invoice_id->SetDbValueDef($rsnew, $invoice_items->invoice_id->CurrentValue, NULL, FALSE);

		// client_id
		$invoice_items->client_id->SetDbValueDef($rsnew, $invoice_items->client_id->CurrentValue, NULL, FALSE);

		// booking_id
		$invoice_items->booking_id->SetDbValueDef($rsnew, $invoice_items->booking_id->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $invoice_items->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($invoice_items->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($invoice_items->CancelMessage <> "") {
				$this->setMessage($invoice_items->CancelMessage);
				$invoice_items->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$invoice_items->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $invoice_items->id->DbValue;

			// Call Row Inserted event
			$invoice_items->Row_Inserted($rsnew);
		}
		return $AddRow;
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
