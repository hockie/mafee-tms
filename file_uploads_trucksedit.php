<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_uploads_trucksinfo.php" ?>
<?php include "trucksinfo.php" ?>
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
$file_uploads_trucks_edit = new cfile_uploads_trucks_edit();
$Page =& $file_uploads_trucks_edit;

// Page init
$file_uploads_trucks_edit->Page_Init();

// Page main
$file_uploads_trucks_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var file_uploads_trucks_edit = new ew_Page("file_uploads_trucks_edit");

// page properties
file_uploads_trucks_edit.PageID = "edit"; // page ID
file_uploads_trucks_edit.FormID = "ffile_uploads_trucksedit"; // form ID
var EW_PAGE_ID = file_uploads_trucks_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
file_uploads_trucks_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Trucks"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($file_uploads_trucks->Trucks->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Filename"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
file_uploads_trucks_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
file_uploads_trucks_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
file_uploads_trucks_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_uploads_trucks_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_uploads_trucks->TableCaption() ?><br><br>
<a href="<?php echo $file_uploads_trucks->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_uploads_trucks_edit->ShowMessage();
?>
<form name="ffile_uploads_trucksedit" id="ffile_uploads_trucksedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return file_uploads_trucks_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="file_uploads_trucks">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($file_uploads_trucks->id->Visible) { // id ?>
	<tr<?php echo $file_uploads_trucks->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_trucks->id->FldCaption() ?></td>
		<td<?php echo $file_uploads_trucks->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $file_uploads_trucks->id->ViewAttributes() ?>><?php echo $file_uploads_trucks->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($file_uploads_trucks->id->CurrentValue) ?>">
</span><?php echo $file_uploads_trucks->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_trucks->Trucks->Visible) { // Trucks ?>
	<tr<?php echo $file_uploads_trucks->Trucks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_trucks->Trucks->FldCaption() ?></td>
		<td<?php echo $file_uploads_trucks->Trucks->CellAttributes() ?>><span id="el_Trucks">
<?php if ($file_uploads_trucks->Trucks->getSessionValue() <> "") { ?>
<div<?php echo $file_uploads_trucks->Trucks->ViewAttributes() ?>><?php echo $file_uploads_trucks->Trucks->ViewValue ?></div>
<input type="hidden" id="x_Trucks" name="x_Trucks" value="<?php echo ew_HtmlEncode($file_uploads_trucks->Trucks->CurrentValue) ?>">
<?php } else { ?>
<input type="text" name="x_Trucks" id="x_Trucks" title="<?php echo $file_uploads_trucks->Trucks->FldTitle() ?>" size="30" value="<?php echo $file_uploads_trucks->Trucks->EditValue ?>"<?php echo $file_uploads_trucks->Trucks->EditAttributes() ?>>
<?php } ?>
</span><?php echo $file_uploads_trucks->Trucks->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_trucks->Filename->Visible) { // Filename ?>
	<tr<?php echo $file_uploads_trucks->Filename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_trucks->Filename->FldCaption() ?></td>
		<td<?php echo $file_uploads_trucks->Filename->CellAttributes() ?>><span id="el_Filename">
<div id="old_x_Filename">
<?php if ($file_uploads_trucks->Filename->HrefValue <> "" || $file_uploads_trucks->Filename->TooltipValue <> "") { ?>
<?php if (!empty($file_uploads_trucks->Filename->Upload->DbValue)) { ?>
<a href="<?php echo $file_uploads_trucks->Filename->HrefValue ?>"><?php echo $file_uploads_trucks->Filename->EditValue ?></a>
<?php } elseif (!in_array($file_uploads_trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($file_uploads_trucks->Filename->Upload->DbValue)) { ?>
<?php echo $file_uploads_trucks->Filename->EditValue ?>
<?php } elseif (!in_array($file_uploads_trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_Filename">
<?php if (!empty($file_uploads_trucks->Filename->Upload->DbValue)) { ?>
<label><input type="radio" name="a_Filename" id="a_Filename" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_Filename" id="a_Filename" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_Filename" id="a_Filename" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $file_uploads_trucks->Filename->EditAttrs["onchange"] = "this.form.a_Filename[2].checked=true;" . @$file_uploads_trucks->Filename->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_Filename" id="a_Filename" value="3">
<?php } ?>
<input type="file" name="x_Filename" id="x_Filename" title="<?php echo $file_uploads_trucks->Filename->FldTitle() ?>" size="30"<?php echo $file_uploads_trucks->Filename->EditAttributes() ?>>
</div>
</span><?php echo $file_uploads_trucks->Filename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_trucks->File_Type_ID->Visible) { // File_Type_ID ?>
	<tr<?php echo $file_uploads_trucks->File_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_trucks->File_Type_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads_trucks->File_Type_ID->CellAttributes() ?>><span id="el_File_Type_ID">
<select id="x_File_Type_ID" name="x_File_Type_ID" title="<?php echo $file_uploads_trucks->File_Type_ID->FldTitle() ?>"<?php echo $file_uploads_trucks->File_Type_ID->EditAttributes() ?>>
<?php
if (is_array($file_uploads_trucks->File_Type_ID->EditValue)) {
	$arwrk = $file_uploads_trucks->File_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($file_uploads_trucks->File_Type_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $file_uploads_trucks->File_Type_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_trucks->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $file_uploads_trucks->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_trucks->Remarks->FldCaption() ?></td>
		<td<?php echo $file_uploads_trucks->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $file_uploads_trucks->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $file_uploads_trucks->Remarks->EditAttributes() ?>><?php echo $file_uploads_trucks->Remarks->EditValue ?></textarea>
</span><?php echo $file_uploads_trucks->Remarks->CustomMsg ?></td>
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
$file_uploads_trucks_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_uploads_trucks_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'file_uploads_trucks';

	// Page object name
	var $PageObjName = 'file_uploads_trucks_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_uploads_trucks;
		if ($file_uploads_trucks->UseTokenInUrl) $PageUrl .= "t=" . $file_uploads_trucks->TableVar . "&"; // Add page token
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
		global $objForm, $file_uploads_trucks;
		if ($file_uploads_trucks->UseTokenInUrl) {
			if ($objForm)
				return ($file_uploads_trucks->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_uploads_trucks->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_uploads_trucks_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_uploads_trucks)
		$GLOBALS["file_uploads_trucks"] = new cfile_uploads_trucks();

		// Table object (trucks)
		$GLOBALS['trucks'] = new ctrucks();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_uploads_trucks', TRUE);

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
		global $file_uploads_trucks;

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
			$this->Page_Terminate("file_uploads_truckslist.php");
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
		global $objForm, $Language, $gsFormError, $file_uploads_trucks;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$file_uploads_trucks->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$file_uploads_trucks->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$file_uploads_trucks->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$file_uploads_trucks->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$file_uploads_trucks->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($file_uploads_trucks->id->CurrentValue == "")
			$this->Page_Terminate("file_uploads_truckslist.php"); // Invalid key, return to list
		switch ($file_uploads_trucks->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("file_uploads_truckslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$file_uploads_trucks->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $file_uploads_trucks->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$file_uploads_trucks->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$file_uploads_trucks->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $file_uploads_trucks;

		// Get upload data
			if ($file_uploads_trucks->Filename->Upload->UploadFile()) {

				// No action required
			} else {
				echo $file_uploads_trucks->Filename->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $file_uploads_trucks;
		$file_uploads_trucks->id->setFormValue($objForm->GetValue("x_id"));
		$file_uploads_trucks->Trucks->setFormValue($objForm->GetValue("x_Trucks"));
		$file_uploads_trucks->File_Type_ID->setFormValue($objForm->GetValue("x_File_Type_ID"));
		$file_uploads_trucks->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$file_uploads_trucks->Created->setFormValue($objForm->GetValue("x_Created"));
		$file_uploads_trucks->Created->CurrentValue = ew_UnFormatDateTime($file_uploads_trucks->Created->CurrentValue, 6);
		$file_uploads_trucks->Modified->setFormValue($objForm->GetValue("x_Modified"));
		$file_uploads_trucks->Modified->CurrentValue = ew_UnFormatDateTime($file_uploads_trucks->Modified->CurrentValue, 6);
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $file_uploads_trucks;
		$this->LoadRow();
		$file_uploads_trucks->id->CurrentValue = $file_uploads_trucks->id->FormValue;
		$file_uploads_trucks->Trucks->CurrentValue = $file_uploads_trucks->Trucks->FormValue;
		$file_uploads_trucks->File_Type_ID->CurrentValue = $file_uploads_trucks->File_Type_ID->FormValue;
		$file_uploads_trucks->Remarks->CurrentValue = $file_uploads_trucks->Remarks->FormValue;
		$file_uploads_trucks->Created->CurrentValue = $file_uploads_trucks->Created->FormValue;
		$file_uploads_trucks->Created->CurrentValue = ew_UnFormatDateTime($file_uploads_trucks->Created->CurrentValue, 6);
		$file_uploads_trucks->Modified->CurrentValue = $file_uploads_trucks->Modified->FormValue;
		$file_uploads_trucks->Modified->CurrentValue = ew_UnFormatDateTime($file_uploads_trucks->Modified->CurrentValue, 6);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_uploads_trucks;
		$sFilter = $file_uploads_trucks->KeyFilter();

		// Call Row Selecting event
		$file_uploads_trucks->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_uploads_trucks->CurrentFilter = $sFilter;
		$sSql = $file_uploads_trucks->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_uploads_trucks->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_uploads_trucks;
		$file_uploads_trucks->id->setDbValue($rs->fields('id'));
		$file_uploads_trucks->Trucks->setDbValue($rs->fields('Trucks'));
		$file_uploads_trucks->Filename->Upload->DbValue = $rs->fields('Filename');
		$file_uploads_trucks->File_Type_ID->setDbValue($rs->fields('File_Type_ID'));
		$file_uploads_trucks->Remarks->setDbValue($rs->fields('Remarks'));
		$file_uploads_trucks->Created->setDbValue($rs->fields('Created'));
		$file_uploads_trucks->Modified->setDbValue($rs->fields('Modified'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_uploads_trucks;

		// Initialize URLs
		// Call Row_Rendering event

		$file_uploads_trucks->Row_Rendering();

		// Common render codes for all row types
		// id

		$file_uploads_trucks->id->CellCssStyle = ""; $file_uploads_trucks->id->CellCssClass = "";
		$file_uploads_trucks->id->CellAttrs = array(); $file_uploads_trucks->id->ViewAttrs = array(); $file_uploads_trucks->id->EditAttrs = array();

		// Trucks
		$file_uploads_trucks->Trucks->CellCssStyle = ""; $file_uploads_trucks->Trucks->CellCssClass = "";
		$file_uploads_trucks->Trucks->CellAttrs = array(); $file_uploads_trucks->Trucks->ViewAttrs = array(); $file_uploads_trucks->Trucks->EditAttrs = array();

		// Filename
		$file_uploads_trucks->Filename->CellCssStyle = ""; $file_uploads_trucks->Filename->CellCssClass = "";
		$file_uploads_trucks->Filename->CellAttrs = array(); $file_uploads_trucks->Filename->ViewAttrs = array(); $file_uploads_trucks->Filename->EditAttrs = array();

		// File_Type_ID
		$file_uploads_trucks->File_Type_ID->CellCssStyle = ""; $file_uploads_trucks->File_Type_ID->CellCssClass = "";
		$file_uploads_trucks->File_Type_ID->CellAttrs = array(); $file_uploads_trucks->File_Type_ID->ViewAttrs = array(); $file_uploads_trucks->File_Type_ID->EditAttrs = array();

		// Remarks
		$file_uploads_trucks->Remarks->CellCssStyle = ""; $file_uploads_trucks->Remarks->CellCssClass = "";
		$file_uploads_trucks->Remarks->CellAttrs = array(); $file_uploads_trucks->Remarks->ViewAttrs = array(); $file_uploads_trucks->Remarks->EditAttrs = array();

		// Created
		$file_uploads_trucks->Created->CellCssStyle = ""; $file_uploads_trucks->Created->CellCssClass = "";
		$file_uploads_trucks->Created->CellAttrs = array(); $file_uploads_trucks->Created->ViewAttrs = array(); $file_uploads_trucks->Created->EditAttrs = array();

		// Modified
		$file_uploads_trucks->Modified->CellCssStyle = ""; $file_uploads_trucks->Modified->CellCssClass = "";
		$file_uploads_trucks->Modified->CellAttrs = array(); $file_uploads_trucks->Modified->ViewAttrs = array(); $file_uploads_trucks->Modified->EditAttrs = array();
		if ($file_uploads_trucks->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_uploads_trucks->id->ViewValue = $file_uploads_trucks->id->CurrentValue;
			$file_uploads_trucks->id->CssStyle = "";
			$file_uploads_trucks->id->CssClass = "";
			$file_uploads_trucks->id->ViewCustomAttributes = "";

			// Trucks
			$file_uploads_trucks->Trucks->ViewValue = $file_uploads_trucks->Trucks->CurrentValue;
			$file_uploads_trucks->Trucks->CssStyle = "";
			$file_uploads_trucks->Trucks->CssClass = "";
			$file_uploads_trucks->Trucks->ViewCustomAttributes = "";

			// Filename
			if (!ew_Empty($file_uploads_trucks->Filename->Upload->DbValue)) {
				$file_uploads_trucks->Filename->ViewValue = $file_uploads_trucks->Filename->Upload->DbValue;
			} else {
				$file_uploads_trucks->Filename->ViewValue = "";
			}
			$file_uploads_trucks->Filename->CssStyle = "";
			$file_uploads_trucks->Filename->CssClass = "";
			$file_uploads_trucks->Filename->ViewCustomAttributes = "";

			// File_Type_ID
			if (strval($file_uploads_trucks->File_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads_trucks->File_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `File_Type` FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `File_Type` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads_trucks->File_Type_ID->ViewValue = $rswrk->fields('File_Type');
					$rswrk->Close();
				} else {
					$file_uploads_trucks->File_Type_ID->ViewValue = $file_uploads_trucks->File_Type_ID->CurrentValue;
				}
			} else {
				$file_uploads_trucks->File_Type_ID->ViewValue = NULL;
			}
			$file_uploads_trucks->File_Type_ID->CssStyle = "";
			$file_uploads_trucks->File_Type_ID->CssClass = "";
			$file_uploads_trucks->File_Type_ID->ViewCustomAttributes = "";

			// Remarks
			$file_uploads_trucks->Remarks->ViewValue = $file_uploads_trucks->Remarks->CurrentValue;
			$file_uploads_trucks->Remarks->CssStyle = "";
			$file_uploads_trucks->Remarks->CssClass = "";
			$file_uploads_trucks->Remarks->ViewCustomAttributes = "";

			// Created
			$file_uploads_trucks->Created->ViewValue = $file_uploads_trucks->Created->CurrentValue;
			$file_uploads_trucks->Created->ViewValue = ew_FormatDateTime($file_uploads_trucks->Created->ViewValue, 6);
			$file_uploads_trucks->Created->CssStyle = "";
			$file_uploads_trucks->Created->CssClass = "";
			$file_uploads_trucks->Created->ViewCustomAttributes = "";

			// Modified
			$file_uploads_trucks->Modified->ViewValue = $file_uploads_trucks->Modified->CurrentValue;
			$file_uploads_trucks->Modified->ViewValue = ew_FormatDateTime($file_uploads_trucks->Modified->ViewValue, 6);
			$file_uploads_trucks->Modified->CssStyle = "";
			$file_uploads_trucks->Modified->CssClass = "";
			$file_uploads_trucks->Modified->ViewCustomAttributes = "";

			// id
			$file_uploads_trucks->id->HrefValue = "";
			$file_uploads_trucks->id->TooltipValue = "";

			// Trucks
			$file_uploads_trucks->Trucks->HrefValue = "";
			$file_uploads_trucks->Trucks->TooltipValue = "";

			// Filename
			if (!ew_Empty($file_uploads_trucks->Filename->Upload->DbValue)) {
				$file_uploads_trucks->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads_trucks->Filename->UploadPath) . ((!empty($file_uploads_trucks->Filename->ViewValue)) ? $file_uploads_trucks->Filename->ViewValue : $file_uploads_trucks->Filename->CurrentValue);
				if ($file_uploads_trucks->Export <> "") $file_uploads_trucks->Filename->HrefValue = ew_ConvertFullUrl($file_uploads_trucks->Filename->HrefValue);
			} else {
				$file_uploads_trucks->Filename->HrefValue = "";
			}
			$file_uploads_trucks->Filename->TooltipValue = "";

			// File_Type_ID
			$file_uploads_trucks->File_Type_ID->HrefValue = "";
			$file_uploads_trucks->File_Type_ID->TooltipValue = "";

			// Remarks
			$file_uploads_trucks->Remarks->HrefValue = "";
			$file_uploads_trucks->Remarks->TooltipValue = "";

			// Created
			$file_uploads_trucks->Created->HrefValue = "";
			$file_uploads_trucks->Created->TooltipValue = "";

			// Modified
			$file_uploads_trucks->Modified->HrefValue = "";
			$file_uploads_trucks->Modified->TooltipValue = "";
		} elseif ($file_uploads_trucks->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$file_uploads_trucks->id->EditCustomAttributes = "";
			$file_uploads_trucks->id->EditValue = $file_uploads_trucks->id->CurrentValue;
			$file_uploads_trucks->id->CssStyle = "";
			$file_uploads_trucks->id->CssClass = "";
			$file_uploads_trucks->id->ViewCustomAttributes = "";

			// Trucks
			$file_uploads_trucks->Trucks->EditCustomAttributes = "";
			if ($file_uploads_trucks->Trucks->getSessionValue() <> "") {
				$file_uploads_trucks->Trucks->CurrentValue = $file_uploads_trucks->Trucks->getSessionValue();
			$file_uploads_trucks->Trucks->ViewValue = $file_uploads_trucks->Trucks->CurrentValue;
			$file_uploads_trucks->Trucks->CssStyle = "";
			$file_uploads_trucks->Trucks->CssClass = "";
			$file_uploads_trucks->Trucks->ViewCustomAttributes = "";
			} else {
			$file_uploads_trucks->Trucks->EditValue = ew_HtmlEncode($file_uploads_trucks->Trucks->CurrentValue);
			}

			// Filename
			$file_uploads_trucks->Filename->EditCustomAttributes = "";
			if (!ew_Empty($file_uploads_trucks->Filename->Upload->DbValue)) {
				$file_uploads_trucks->Filename->EditValue = $file_uploads_trucks->Filename->Upload->DbValue;
			} else {
				$file_uploads_trucks->Filename->EditValue = "";
			}

			// File_Type_ID
			$file_uploads_trucks->File_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `File_Type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `File_Type` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$file_uploads_trucks->File_Type_ID->EditValue = $arwrk;

			// Remarks
			$file_uploads_trucks->Remarks->EditCustomAttributes = "";
			$file_uploads_trucks->Remarks->EditValue = ew_HtmlEncode($file_uploads_trucks->Remarks->CurrentValue);

			// Created
			// Modified
			// Edit refer script
			// id

			$file_uploads_trucks->id->HrefValue = "";

			// Trucks
			$file_uploads_trucks->Trucks->HrefValue = "";

			// Filename
			if (!ew_Empty($file_uploads_trucks->Filename->Upload->DbValue)) {
				$file_uploads_trucks->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads_trucks->Filename->UploadPath) . ((!empty($file_uploads_trucks->Filename->EditValue)) ? $file_uploads_trucks->Filename->EditValue : $file_uploads_trucks->Filename->CurrentValue);
				if ($file_uploads_trucks->Export <> "") $file_uploads_trucks->Filename->HrefValue = ew_ConvertFullUrl($file_uploads_trucks->Filename->HrefValue);
			} else {
				$file_uploads_trucks->Filename->HrefValue = "";
			}

			// File_Type_ID
			$file_uploads_trucks->File_Type_ID->HrefValue = "";

			// Remarks
			$file_uploads_trucks->Remarks->HrefValue = "";

			// Created
			$file_uploads_trucks->Created->HrefValue = "";

			// Modified
			$file_uploads_trucks->Modified->HrefValue = "";
		}

		// Call Row Rendered event
		if ($file_uploads_trucks->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_uploads_trucks->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $file_uploads_trucks;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($file_uploads_trucks->Filename->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($file_uploads_trucks->Filename->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $file_uploads_trucks->Filename->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($file_uploads_trucks->Trucks->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $file_uploads_trucks->Trucks->FldErrMsg();
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
		global $conn, $Security, $Language, $file_uploads_trucks;
		$sFilter = $file_uploads_trucks->KeyFilter();
		$file_uploads_trucks->CurrentFilter = $sFilter;
		$sSql = $file_uploads_trucks->SQL();
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

			// Trucks
			$file_uploads_trucks->Trucks->SetDbValueDef($rsnew, $file_uploads_trucks->Trucks->CurrentValue, NULL, FALSE);

			// Filename
			$file_uploads_trucks->Filename->Upload->SaveToSession(); // Save file value to Session
						if ($file_uploads_trucks->Filename->Upload->Action == "2" || $file_uploads_trucks->Filename->Upload->Action == "3") { // Update/Remove
			$file_uploads_trucks->Filename->Upload->DbValue = $rs->fields('Filename'); // Get original value
			if (is_null($file_uploads_trucks->Filename->Upload->Value)) {
				$rsnew['Filename'] = NULL;
			} else {
				$rsnew['Filename'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $file_uploads_trucks->Filename->UploadPath), $file_uploads_trucks->Filename->Upload->FileName);
			}
			}

			// File_Type_ID
			$file_uploads_trucks->File_Type_ID->SetDbValueDef($rsnew, $file_uploads_trucks->File_Type_ID->CurrentValue, NULL, FALSE);

			// Remarks
			$file_uploads_trucks->Remarks->SetDbValueDef($rsnew, $file_uploads_trucks->Remarks->CurrentValue, NULL, FALSE);

			// Created
			$file_uploads_trucks->Created->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['Created'] =& $file_uploads_trucks->Created->DbValue;

			// Modified
			$file_uploads_trucks->Modified->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['Modified'] =& $file_uploads_trucks->Modified->DbValue;

			// Call Row Updating event
			$bUpdateRow = $file_uploads_trucks->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($file_uploads_trucks->Filename->Upload->Value)) {
				$file_uploads_trucks->Filename->Upload->SaveToFile($file_uploads_trucks->Filename->UploadPath, $rsnew['Filename'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($file_uploads_trucks->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($file_uploads_trucks->CancelMessage <> "") {
					$this->setMessage($file_uploads_trucks->CancelMessage);
					$file_uploads_trucks->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$file_uploads_trucks->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Filename
		$file_uploads_trucks->Filename->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $file_uploads_trucks;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "trucks") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $file_uploads_trucks->SqlMasterFilter_trucks();
				$this->sDbDetailFilter = $file_uploads_trucks->SqlDetailFilter_trucks();
				if (@$_GET["id"] <> "") {
					$GLOBALS["trucks"]->id->setQueryStringValue($_GET["id"]);
					$file_uploads_trucks->Trucks->setQueryStringValue($GLOBALS["trucks"]->id->QueryStringValue);
					$file_uploads_trucks->Trucks->setSessionValue($file_uploads_trucks->Trucks->QueryStringValue);
					if (!is_numeric($GLOBALS["trucks"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["trucks"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Trucks@", ew_AdjustSql($GLOBALS["trucks"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$file_uploads_trucks->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$file_uploads_trucks->setStartRecordNumber($this->lStartRec);
			$file_uploads_trucks->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$file_uploads_trucks->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "trucks") {
				if ($file_uploads_trucks->Trucks->QueryStringValue == "") $file_uploads_trucks->Trucks->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $file_uploads_trucks->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $file_uploads_trucks->getDetailFilter(); // Restore detail filter
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
