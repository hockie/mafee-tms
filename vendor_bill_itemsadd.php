<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "vendor_bill_itemsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "vendor_billinfo.php" ?>
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
$vendor_bill_items_add = new cvendor_bill_items_add();
$Page =& $vendor_bill_items_add;

// Page init
$vendor_bill_items_add->Page_Init();

// Page main
$vendor_bill_items_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var vendor_bill_items_add = new ew_Page("vendor_bill_items_add");

// page properties
vendor_bill_items_add.PageID = "add"; // page ID
vendor_bill_items_add.FormID = "fvendor_bill_itemsadd"; // form ID
var EW_PAGE_ID = vendor_bill_items_add.PageID; // for backward compatibility

// extend page with ValidateForm function
vendor_bill_items_add.ValidateForm = function(fobj) {
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
vendor_bill_items_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
vendor_bill_items_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
vendor_bill_items_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
vendor_bill_items_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $vendor_bill_items->TableCaption() ?><br><br>
<a href="<?php echo $vendor_bill_items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$vendor_bill_items_add->ShowMessage();
?>
<form name="fvendor_bill_itemsadd" id="fvendor_bill_itemsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return vendor_bill_items_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="vendor_bill_items">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($vendor_bill_items->vendor_bill_id->Visible) { // vendor_bill_id ?>
	<tr<?php echo $vendor_bill_items->vendor_bill_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->vendor_bill_id->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->vendor_bill_id->CellAttributes() ?>><span id="el_vendor_bill_id">
<?php if ($vendor_bill_items->vendor_bill_id->getSessionValue() <> "") { ?>
<div<?php echo $vendor_bill_items->vendor_bill_id->ViewAttributes() ?>><?php echo $vendor_bill_items->vendor_bill_id->ViewValue ?></div>
<input type="hidden" id="x_vendor_bill_id" name="x_vendor_bill_id" value="<?php echo ew_HtmlEncode($vendor_bill_items->vendor_bill_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_vendor_bill_id" name="x_vendor_bill_id" title="<?php echo $vendor_bill_items->vendor_bill_id->FldTitle() ?>"<?php echo $vendor_bill_items->vendor_bill_id->EditAttributes() ?>>
<?php
if (is_array($vendor_bill_items->vendor_bill_id->EditValue)) {
	$arwrk = $vendor_bill_items->vendor_bill_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($vendor_bill_items->vendor_bill_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $vendor_bill_items->vendor_bill_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->vendor_id->Visible) { // vendor_id ?>
	<tr<?php echo $vendor_bill_items->vendor_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->vendor_id->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->vendor_id->CellAttributes() ?>><span id="el_vendor_id">
<?php if ($vendor_bill_items->vendor_id->getSessionValue() <> "") { ?>
<div<?php echo $vendor_bill_items->vendor_id->ViewAttributes() ?>><?php echo $vendor_bill_items->vendor_id->ViewValue ?></div>
<input type="hidden" id="x_vendor_id" name="x_vendor_id" value="<?php echo ew_HtmlEncode($vendor_bill_items->vendor_id->CurrentValue) ?>">
<?php } else { ?>
<?php $vendor_bill_items->vendor_id->EditAttrs["onchange"] = "ew_UpdateOpt('x_booking_id','x_vendor_id',vendor_bill_items_add.ar_x_booking_id); " . @$vendor_bill_items->vendor_id->EditAttrs["onchange"]; ?>
<select id="x_vendor_id" name="x_vendor_id" title="<?php echo $vendor_bill_items->vendor_id->FldTitle() ?>"<?php echo $vendor_bill_items->vendor_id->EditAttributes() ?>>
<?php
if (is_array($vendor_bill_items->vendor_id->EditValue)) {
	$arwrk = $vendor_bill_items->vendor_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($vendor_bill_items->vendor_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $vendor_bill_items->vendor_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->booking_id->Visible) { // booking_id ?>
	<tr<?php echo $vendor_bill_items->booking_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->booking_id->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->booking_id->CellAttributes() ?>><span id="el_booking_id">
<select id="x_booking_id" name="x_booking_id" title="<?php echo $vendor_bill_items->booking_id->FldTitle() ?>"<?php echo $vendor_bill_items->booking_id->EditAttributes() ?>>
<?php
if (is_array($vendor_bill_items->booking_id->EditValue)) {
	$arwrk = $vendor_bill_items->booking_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($vendor_bill_items->booking_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$jswrk = "";
if (is_array($vendor_bill_items->booking_id->EditValue)) {
	$arwrk = $vendor_bill_items->booking_id->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
vendor_bill_items_add.ar_x_booking_id = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $vendor_bill_items->booking_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($vendor_bill_items->remarks->Visible) { // remarks ?>
	<tr<?php echo $vendor_bill_items->remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $vendor_bill_items->remarks->FldCaption() ?></td>
		<td<?php echo $vendor_bill_items->remarks->CellAttributes() ?>><span id="el_remarks">
<textarea name="x_remarks" id="x_remarks" title="<?php echo $vendor_bill_items->remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $vendor_bill_items->remarks->EditAttributes() ?>><?php echo $vendor_bill_items->remarks->EditValue ?></textarea>
</span><?php echo $vendor_bill_items->remarks->CustomMsg ?></td>
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
ew_UpdateOpts([['x_booking_id','x_vendor_id',vendor_bill_items_add.ar_x_booking_id]]);

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$vendor_bill_items_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cvendor_bill_items_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'vendor_bill_items';

	// Page object name
	var $PageObjName = 'vendor_bill_items_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $vendor_bill_items;
		if ($vendor_bill_items->UseTokenInUrl) $PageUrl .= "t=" . $vendor_bill_items->TableVar . "&"; // Add page token
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
		global $objForm, $vendor_bill_items;
		if ($vendor_bill_items->UseTokenInUrl) {
			if ($objForm)
				return ($vendor_bill_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($vendor_bill_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cvendor_bill_items_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (vendor_bill_items)
		$GLOBALS["vendor_bill_items"] = new cvendor_bill_items();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (vendor_bill)
		$GLOBALS['vendor_bill'] = new cvendor_bill();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'vendor_bill_items', TRUE);

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
		global $vendor_bill_items;

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
			$this->Page_Terminate("vendor_bill_itemslist.php");
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
		global $objForm, $Language, $gsFormError, $vendor_bill_items;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $vendor_bill_items->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $vendor_bill_items->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$vendor_bill_items->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $vendor_bill_items->CurrentAction = "C"; // Copy record
		  } else {
		    $vendor_bill_items->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($vendor_bill_items->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("vendor_bill_itemslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$vendor_bill_items->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $vendor_bill_items->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$vendor_bill_items->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $vendor_bill_items;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $vendor_bill_items;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $vendor_bill_items;
		$vendor_bill_items->vendor_bill_id->setFormValue($objForm->GetValue("x_vendor_bill_id"));
		$vendor_bill_items->vendor_id->setFormValue($objForm->GetValue("x_vendor_id"));
		$vendor_bill_items->booking_id->setFormValue($objForm->GetValue("x_booking_id"));
		$vendor_bill_items->remarks->setFormValue($objForm->GetValue("x_remarks"));
		$vendor_bill_items->user_id->setFormValue($objForm->GetValue("x_user_id"));
		$vendor_bill_items->created->setFormValue($objForm->GetValue("x_created"));
		$vendor_bill_items->created->CurrentValue = ew_UnFormatDateTime($vendor_bill_items->created->CurrentValue, 6);
		$vendor_bill_items->modified->setFormValue($objForm->GetValue("x_modified"));
		$vendor_bill_items->modified->CurrentValue = ew_UnFormatDateTime($vendor_bill_items->modified->CurrentValue, 6);
		$vendor_bill_items->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $vendor_bill_items;
		$vendor_bill_items->id->CurrentValue = $vendor_bill_items->id->FormValue;
		$vendor_bill_items->vendor_bill_id->CurrentValue = $vendor_bill_items->vendor_bill_id->FormValue;
		$vendor_bill_items->vendor_id->CurrentValue = $vendor_bill_items->vendor_id->FormValue;
		$vendor_bill_items->booking_id->CurrentValue = $vendor_bill_items->booking_id->FormValue;
		$vendor_bill_items->remarks->CurrentValue = $vendor_bill_items->remarks->FormValue;
		$vendor_bill_items->user_id->CurrentValue = $vendor_bill_items->user_id->FormValue;
		$vendor_bill_items->created->CurrentValue = $vendor_bill_items->created->FormValue;
		$vendor_bill_items->created->CurrentValue = ew_UnFormatDateTime($vendor_bill_items->created->CurrentValue, 6);
		$vendor_bill_items->modified->CurrentValue = $vendor_bill_items->modified->FormValue;
		$vendor_bill_items->modified->CurrentValue = ew_UnFormatDateTime($vendor_bill_items->modified->CurrentValue, 6);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $vendor_bill_items;
		$sFilter = $vendor_bill_items->KeyFilter();

		// Call Row Selecting event
		$vendor_bill_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$vendor_bill_items->CurrentFilter = $sFilter;
		$sSql = $vendor_bill_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$vendor_bill_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $vendor_bill_items;
		$vendor_bill_items->id->setDbValue($rs->fields('id'));
		$vendor_bill_items->vendor_bill_id->setDbValue($rs->fields('vendor_bill_id'));
		$vendor_bill_items->vendor_id->setDbValue($rs->fields('vendor_id'));
		$vendor_bill_items->booking_id->setDbValue($rs->fields('booking_id'));
		$vendor_bill_items->remarks->setDbValue($rs->fields('remarks'));
		$vendor_bill_items->user_id->setDbValue($rs->fields('user_id'));
		$vendor_bill_items->created->setDbValue($rs->fields('created'));
		$vendor_bill_items->modified->setDbValue($rs->fields('modified'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $vendor_bill_items;

		// Initialize URLs
		// Call Row_Rendering event

		$vendor_bill_items->Row_Rendering();

		// Common render codes for all row types
		// vendor_bill_id

		$vendor_bill_items->vendor_bill_id->CellCssStyle = ""; $vendor_bill_items->vendor_bill_id->CellCssClass = "";
		$vendor_bill_items->vendor_bill_id->CellAttrs = array(); $vendor_bill_items->vendor_bill_id->ViewAttrs = array(); $vendor_bill_items->vendor_bill_id->EditAttrs = array();

		// vendor_id
		$vendor_bill_items->vendor_id->CellCssStyle = ""; $vendor_bill_items->vendor_id->CellCssClass = "";
		$vendor_bill_items->vendor_id->CellAttrs = array(); $vendor_bill_items->vendor_id->ViewAttrs = array(); $vendor_bill_items->vendor_id->EditAttrs = array();

		// booking_id
		$vendor_bill_items->booking_id->CellCssStyle = ""; $vendor_bill_items->booking_id->CellCssClass = "";
		$vendor_bill_items->booking_id->CellAttrs = array(); $vendor_bill_items->booking_id->ViewAttrs = array(); $vendor_bill_items->booking_id->EditAttrs = array();

		// remarks
		$vendor_bill_items->remarks->CellCssStyle = ""; $vendor_bill_items->remarks->CellCssClass = "";
		$vendor_bill_items->remarks->CellAttrs = array(); $vendor_bill_items->remarks->ViewAttrs = array(); $vendor_bill_items->remarks->EditAttrs = array();

		// user_id
		$vendor_bill_items->user_id->CellCssStyle = ""; $vendor_bill_items->user_id->CellCssClass = "";
		$vendor_bill_items->user_id->CellAttrs = array(); $vendor_bill_items->user_id->ViewAttrs = array(); $vendor_bill_items->user_id->EditAttrs = array();

		// created
		$vendor_bill_items->created->CellCssStyle = ""; $vendor_bill_items->created->CellCssClass = "";
		$vendor_bill_items->created->CellAttrs = array(); $vendor_bill_items->created->ViewAttrs = array(); $vendor_bill_items->created->EditAttrs = array();

		// modified
		$vendor_bill_items->modified->CellCssStyle = ""; $vendor_bill_items->modified->CellCssClass = "";
		$vendor_bill_items->modified->CellAttrs = array(); $vendor_bill_items->modified->ViewAttrs = array(); $vendor_bill_items->modified->EditAttrs = array();
		if ($vendor_bill_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$vendor_bill_items->id->ViewValue = $vendor_bill_items->id->CurrentValue;
			$vendor_bill_items->id->CssStyle = "";
			$vendor_bill_items->id->CssClass = "";
			$vendor_bill_items->id->ViewCustomAttributes = "";

			// vendor_bill_id
			if (strval($vendor_bill_items->vendor_bill_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_bill_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `vendor_Number` FROM `vendor_bill`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `vendor_Number`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->vendor_bill_id->ViewValue = $rswrk->fields('vendor_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_bill_id->ViewValue = $vendor_bill_items->vendor_bill_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_bill_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_bill_id->CssStyle = "";
			$vendor_bill_items->vendor_bill_id->CssClass = "";
			$vendor_bill_items->vendor_bill_id->ViewCustomAttributes = "";

			// vendor_id
			if (strval($vendor_bill_items->vendor_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_id->CurrentValue) . "";
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
					$vendor_bill_items->vendor_id->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_id->ViewValue = $vendor_bill_items->vendor_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_id->CssStyle = "";
			$vendor_bill_items->vendor_id->CssClass = "";
			$vendor_bill_items->vendor_id->ViewCustomAttributes = "";

			// booking_id
			if (strval($vendor_bill_items->booking_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->booking_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Subcon_ID`=" . $vendor_bill_items->vendor_id->CurrentValue . " AND `billing_type_id`=" . 8 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->booking_id->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->booking_id->ViewValue = $vendor_bill_items->booking_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->booking_id->ViewValue = NULL;
			}
			$vendor_bill_items->booking_id->CssStyle = "";
			$vendor_bill_items->booking_id->CssClass = "";
			$vendor_bill_items->booking_id->ViewCustomAttributes = "";

			// remarks
			$vendor_bill_items->remarks->ViewValue = $vendor_bill_items->remarks->CurrentValue;
			$vendor_bill_items->remarks->CssStyle = "";
			$vendor_bill_items->remarks->CssClass = "";
			$vendor_bill_items->remarks->ViewCustomAttributes = "";

			// user_id
			$vendor_bill_items->user_id->ViewValue = $vendor_bill_items->user_id->CurrentValue;
			$vendor_bill_items->user_id->CssStyle = "";
			$vendor_bill_items->user_id->CssClass = "";
			$vendor_bill_items->user_id->ViewCustomAttributes = "";

			// created
			$vendor_bill_items->created->ViewValue = $vendor_bill_items->created->CurrentValue;
			$vendor_bill_items->created->ViewValue = ew_FormatDateTime($vendor_bill_items->created->ViewValue, 6);
			$vendor_bill_items->created->CssStyle = "";
			$vendor_bill_items->created->CssClass = "";
			$vendor_bill_items->created->ViewCustomAttributes = "";

			// modified
			$vendor_bill_items->modified->ViewValue = $vendor_bill_items->modified->CurrentValue;
			$vendor_bill_items->modified->ViewValue = ew_FormatDateTime($vendor_bill_items->modified->ViewValue, 6);
			$vendor_bill_items->modified->CssStyle = "";
			$vendor_bill_items->modified->CssClass = "";
			$vendor_bill_items->modified->ViewCustomAttributes = "";

			// vendor_bill_id
			$vendor_bill_items->vendor_bill_id->HrefValue = "";
			$vendor_bill_items->vendor_bill_id->TooltipValue = "";

			// vendor_id
			$vendor_bill_items->vendor_id->HrefValue = "";
			$vendor_bill_items->vendor_id->TooltipValue = "";

			// booking_id
			if (!ew_Empty($vendor_bill_items->booking_id->CurrentValue)) {
				$vendor_bill_items->booking_id->HrefValue = $vendor_bill_items->booking_id->CurrentValue;
				if ($vendor_bill_items->Export <> "") $vendor_bill_items->booking_id->HrefValue = ew_ConvertFullUrl($vendor_bill_items->booking_id->HrefValue);
			} else {
				$vendor_bill_items->booking_id->HrefValue = "";
			}
			$vendor_bill_items->booking_id->TooltipValue = "";

			// remarks
			$vendor_bill_items->remarks->HrefValue = "";
			$vendor_bill_items->remarks->TooltipValue = "";

			// user_id
			$vendor_bill_items->user_id->HrefValue = "";
			$vendor_bill_items->user_id->TooltipValue = "";

			// created
			$vendor_bill_items->created->HrefValue = "";
			$vendor_bill_items->created->TooltipValue = "";

			// modified
			$vendor_bill_items->modified->HrefValue = "";
			$vendor_bill_items->modified->TooltipValue = "";
		} elseif ($vendor_bill_items->RowType == EW_ROWTYPE_ADD) { // Add row

			// vendor_bill_id
			$vendor_bill_items->vendor_bill_id->EditCustomAttributes = "";
			if ($vendor_bill_items->vendor_bill_id->getSessionValue() <> "") {
				$vendor_bill_items->vendor_bill_id->CurrentValue = $vendor_bill_items->vendor_bill_id->getSessionValue();
			if (strval($vendor_bill_items->vendor_bill_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_bill_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `vendor_Number` FROM `vendor_bill`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `vendor_Number`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->vendor_bill_id->ViewValue = $rswrk->fields('vendor_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_bill_id->ViewValue = $vendor_bill_items->vendor_bill_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_bill_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_bill_id->CssStyle = "";
			$vendor_bill_items->vendor_bill_id->CssClass = "";
			$vendor_bill_items->vendor_bill_id->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `vendor_Number`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `vendor_bill`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `vendor_Number`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$vendor_bill_items->vendor_bill_id->EditValue = $arwrk;
			}

			// vendor_id
			$vendor_bill_items->vendor_id->EditCustomAttributes = "";
			if ($vendor_bill_items->vendor_id->getSessionValue() <> "") {
				$vendor_bill_items->vendor_id->CurrentValue = $vendor_bill_items->vendor_id->getSessionValue();
			if (strval($vendor_bill_items->vendor_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_id->CurrentValue) . "";
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
					$vendor_bill_items->vendor_id->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_id->ViewValue = $vendor_bill_items->vendor_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_id->CssStyle = "";
			$vendor_bill_items->vendor_id->CssClass = "";
			$vendor_bill_items->vendor_id->ViewCustomAttributes = "";
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
			$vendor_bill_items->vendor_id->EditValue = $arwrk;
			}

			// booking_id
			$vendor_bill_items->booking_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Booking_Number`, '' AS Disp2Fld, `Subcon_ID` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Subcon_ID`=" . $vendor_bill_items->vendor_id->CurrentValue . " AND `billing_type_id`=" . 2 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$vendor_bill_items->booking_id->EditValue = $arwrk;

			// remarks
			$vendor_bill_items->remarks->EditCustomAttributes = "";
			$vendor_bill_items->remarks->EditValue = ew_HtmlEncode($vendor_bill_items->remarks->CurrentValue);

			// user_id
			// created
			// modified

		}

		// Call Row Rendered event
		if ($vendor_bill_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$vendor_bill_items->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $vendor_bill_items;

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
		global $conn, $Language, $Security, $vendor_bill_items;
		$rsnew = array();

		// vendor_bill_id
		$vendor_bill_items->vendor_bill_id->SetDbValueDef($rsnew, $vendor_bill_items->vendor_bill_id->CurrentValue, NULL, FALSE);

		// vendor_id
		$vendor_bill_items->vendor_id->SetDbValueDef($rsnew, $vendor_bill_items->vendor_id->CurrentValue, NULL, FALSE);

		// booking_id
		$vendor_bill_items->booking_id->SetDbValueDef($rsnew, $vendor_bill_items->booking_id->CurrentValue, NULL, FALSE);

		// remarks
		$vendor_bill_items->remarks->SetDbValueDef($rsnew, $vendor_bill_items->remarks->CurrentValue, NULL, FALSE);

		// user_id
		$vendor_bill_items->user_id->SetDbValueDef($rsnew, CurrentUserID(), NULL);
		$rsnew['user_id'] =& $vendor_bill_items->user_id->DbValue;

		// created
		$vendor_bill_items->created->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['created'] =& $vendor_bill_items->created->DbValue;

		// modified
		$vendor_bill_items->modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['modified'] =& $vendor_bill_items->modified->DbValue;

		// Call Row Inserting event
		$bInsertRow = $vendor_bill_items->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($vendor_bill_items->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($vendor_bill_items->CancelMessage <> "") {
				$this->setMessage($vendor_bill_items->CancelMessage);
				$vendor_bill_items->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$vendor_bill_items->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $vendor_bill_items->id->DbValue;

			// Call Row Inserted event
			$vendor_bill_items->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $vendor_bill_items;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "vendor_bill") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $vendor_bill_items->SqlMasterFilter_vendor_bill();
				$this->sDbDetailFilter = $vendor_bill_items->SqlDetailFilter_vendor_bill();
				if (@$_GET["id"] <> "") {
					$GLOBALS["vendor_bill"]->id->setQueryStringValue($_GET["id"]);
					$vendor_bill_items->vendor_bill_id->setQueryStringValue($GLOBALS["vendor_bill"]->id->QueryStringValue);
					$vendor_bill_items->vendor_bill_id->setSessionValue($vendor_bill_items->vendor_bill_id->QueryStringValue);
					if (!is_numeric($GLOBALS["vendor_bill"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["vendor_bill"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@vendor_bill_id@", ew_AdjustSql($GLOBALS["vendor_bill"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["vendor_ID"] <> "") {
					$GLOBALS["vendor_bill"]->vendor_ID->setQueryStringValue($_GET["vendor_ID"]);
					$vendor_bill_items->vendor_id->setQueryStringValue($GLOBALS["vendor_bill"]->vendor_ID->QueryStringValue);
					$vendor_bill_items->vendor_id->setSessionValue($vendor_bill_items->vendor_id->QueryStringValue);
					if (!is_numeric($GLOBALS["vendor_bill"]->vendor_ID->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@vendor_ID@", ew_AdjustSql($GLOBALS["vendor_bill"]->vendor_ID->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@vendor_id@", ew_AdjustSql($GLOBALS["vendor_bill"]->vendor_ID->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$vendor_bill_items->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$vendor_bill_items->setStartRecordNumber($this->lStartRec);
			$vendor_bill_items->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$vendor_bill_items->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "vendor_bill") {
				if ($vendor_bill_items->vendor_bill_id->QueryStringValue == "") $vendor_bill_items->vendor_bill_id->setSessionValue("");
				if ($vendor_bill_items->vendor_id->QueryStringValue == "") $vendor_bill_items->vendor_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $vendor_bill_items->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $vendor_bill_items->getDetailFilter(); // Restore detail filter
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
