<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_uploadsinfo.php" ?>
<?php include "bookingsinfo.php" ?>
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
$file_uploads_edit = new cfile_uploads_edit();
$Page =& $file_uploads_edit;

// Page init
$file_uploads_edit->Page_Init();

// Page main
$file_uploads_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var file_uploads_edit = new ew_Page("file_uploads_edit");

// page properties
file_uploads_edit.PageID = "edit"; // page ID
file_uploads_edit.FormID = "ffile_uploadsedit"; // form ID
var EW_PAGE_ID = file_uploads_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
file_uploads_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Filename"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_Document_Pages"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($file_uploads->Document_Pages->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Date_Received_Subcon"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($file_uploads->Date_Received_Subcon->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Date_Submitted_Client"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($file_uploads->Date_Submitted_Client->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
file_uploads_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
file_uploads_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
file_uploads_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_uploads_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_uploads->TableCaption() ?><br><br>
<a href="<?php echo $file_uploads->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_uploads_edit->ShowMessage();
?>
<form name="ffile_uploadsedit" id="ffile_uploadsedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return file_uploads_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="file_uploads">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($file_uploads->id->Visible) { // id ?>
	<tr<?php echo $file_uploads->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->id->FldCaption() ?></td>
		<td<?php echo $file_uploads->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $file_uploads->id->ViewAttributes() ?>><?php echo $file_uploads->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($file_uploads->id->CurrentValue) ?>">
</span><?php echo $file_uploads->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Booking_ID->Visible) { // Booking_ID ?>
	<tr<?php echo $file_uploads->Booking_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Booking_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads->Booking_ID->CellAttributes() ?>><span id="el_Booking_ID">
<?php if ($file_uploads->Booking_ID->getSessionValue() <> "") { ?>
<div<?php echo $file_uploads->Booking_ID->ViewAttributes() ?>><?php echo $file_uploads->Booking_ID->ViewValue ?></div>
<input type="hidden" id="x_Booking_ID" name="x_Booking_ID" value="<?php echo ew_HtmlEncode($file_uploads->Booking_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Booking_ID" name="x_Booking_ID" title="<?php echo $file_uploads->Booking_ID->FldTitle() ?>"<?php echo $file_uploads->Booking_ID->EditAttributes() ?>>
<?php
if (is_array($file_uploads->Booking_ID->EditValue)) {
	$arwrk = $file_uploads->Booking_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($file_uploads->Booking_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $file_uploads->Booking_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Filename->Visible) { // Filename ?>
	<tr<?php echo $file_uploads->Filename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Filename->FldCaption() ?></td>
		<td<?php echo $file_uploads->Filename->CellAttributes() ?>><span id="el_Filename">
<div id="old_x_Filename">
<?php if ($file_uploads->Filename->HrefValue <> "" || $file_uploads->Filename->TooltipValue <> "") { ?>
<?php if (!empty($file_uploads->Filename->Upload->DbValue)) { ?>
<a href="<?php echo $file_uploads->Filename->HrefValue ?>"><?php echo $file_uploads->Filename->EditValue ?></a>
<?php } elseif (!in_array($file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($file_uploads->Filename->Upload->DbValue)) { ?>
<?php echo $file_uploads->Filename->EditValue ?>
<?php } elseif (!in_array($file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_Filename">
<?php if (!empty($file_uploads->Filename->Upload->DbValue)) { ?>
<label><input type="radio" name="a_Filename" id="a_Filename" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_Filename" id="a_Filename" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_Filename" id="a_Filename" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $file_uploads->Filename->EditAttrs["onchange"] = "this.form.a_Filename[2].checked=true;" . @$file_uploads->Filename->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_Filename" id="a_Filename" value="3">
<?php } ?>
<input type="file" name="x_Filename" id="x_Filename" title="<?php echo $file_uploads->Filename->FldTitle() ?>" size="30"<?php echo $file_uploads->Filename->EditAttributes() ?>>
</div>
</span><?php echo $file_uploads->Filename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->File_Type_ID->Visible) { // File_Type_ID ?>
	<tr<?php echo $file_uploads->File_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->File_Type_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads->File_Type_ID->CellAttributes() ?>><span id="el_File_Type_ID">
<select id="x_File_Type_ID" name="x_File_Type_ID" title="<?php echo $file_uploads->File_Type_ID->FldTitle() ?>"<?php echo $file_uploads->File_Type_ID->EditAttributes() ?>>
<?php
if (is_array($file_uploads->File_Type_ID->EditValue)) {
	$arwrk = $file_uploads->File_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($file_uploads->File_Type_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php if (AllowAdd("file_types")) { ?>
&nbsp;<a name="aol_x_File_Type_ID" id="aol_x_File_Type_ID" href="javascript:void(0);" onclick="ew_AddOptDialogShow({pg:file_uploads_edit,lnk:'aol_x_File_Type_ID',el:'x_File_Type_ID',hdr:this.innerHTML, url:'file_typesaddopt.php',lf:'x_id',df:'x_File_Type',df2:'',pf:'',ff:''});"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $file_uploads->File_Type_ID->FldCaption() ?></a>
<?php } ?>
</span><?php echo $file_uploads->File_Type_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Document_Pages->Visible) { // Document_Pages ?>
	<tr<?php echo $file_uploads->Document_Pages->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Document_Pages->FldCaption() ?></td>
		<td<?php echo $file_uploads->Document_Pages->CellAttributes() ?>><span id="el_Document_Pages">
<input type="text" name="x_Document_Pages" id="x_Document_Pages" title="<?php echo $file_uploads->Document_Pages->FldTitle() ?>" size="30" value="<?php echo $file_uploads->Document_Pages->EditValue ?>"<?php echo $file_uploads->Document_Pages->EditAttributes() ?>>
</span><?php echo $file_uploads->Document_Pages->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Date_Received_Subcon->Visible) { // Date_Received_Subcon ?>
	<tr<?php echo $file_uploads->Date_Received_Subcon->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Date_Received_Subcon->FldCaption() ?></td>
		<td<?php echo $file_uploads->Date_Received_Subcon->CellAttributes() ?>><span id="el_Date_Received_Subcon">
<input type="text" name="x_Date_Received_Subcon" id="x_Date_Received_Subcon" title="<?php echo $file_uploads->Date_Received_Subcon->FldTitle() ?>" value="<?php echo $file_uploads->Date_Received_Subcon->EditValue ?>"<?php echo $file_uploads->Date_Received_Subcon->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date_Received_Subcon" name="cal_x_Date_Received_Subcon" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date_Received_Subcon", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Date_Received_Subcon" // button id
});
</script>
</span><?php echo $file_uploads->Date_Received_Subcon->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Date_Submitted_Client->Visible) { // Date_Submitted_Client ?>
	<tr<?php echo $file_uploads->Date_Submitted_Client->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Date_Submitted_Client->FldCaption() ?></td>
		<td<?php echo $file_uploads->Date_Submitted_Client->CellAttributes() ?>><span id="el_Date_Submitted_Client">
<input type="text" name="x_Date_Submitted_Client" id="x_Date_Submitted_Client" title="<?php echo $file_uploads->Date_Submitted_Client->FldTitle() ?>" value="<?php echo $file_uploads->Date_Submitted_Client->EditValue ?>"<?php echo $file_uploads->Date_Submitted_Client->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date_Submitted_Client" name="cal_x_Date_Submitted_Client" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date_Submitted_Client", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Date_Submitted_Client" // button id
});
</script>
</span><?php echo $file_uploads->Date_Submitted_Client->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($file_uploads->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $file_uploads->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads->Remarks->FldCaption() ?></td>
		<td<?php echo $file_uploads->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $file_uploads->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $file_uploads->Remarks->EditAttributes() ?>><?php echo $file_uploads->Remarks->EditValue ?></textarea>
</span><?php echo $file_uploads->Remarks->CustomMsg ?></td>
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
$file_uploads_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_uploads_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'file_uploads';

	// Page object name
	var $PageObjName = 'file_uploads_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_uploads;
		if ($file_uploads->UseTokenInUrl) $PageUrl .= "t=" . $file_uploads->TableVar . "&"; // Add page token
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
		global $objForm, $file_uploads;
		if ($file_uploads->UseTokenInUrl) {
			if ($objForm)
				return ($file_uploads->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_uploads->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_uploads_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_uploads)
		$GLOBALS["file_uploads"] = new cfile_uploads();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_uploads', TRUE);

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
		global $file_uploads;

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
			$this->Page_Terminate("file_uploadslist.php");
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
		global $objForm, $Language, $gsFormError, $file_uploads;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$file_uploads->id->setQueryStringValue($_GET["id"]);

		// Set up master detail parameters
		$this->SetUpMasterDetail();
		if (@$_POST["a_edit"] <> "") {
			$file_uploads->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$file_uploads->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$file_uploads->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$file_uploads->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($file_uploads->id->CurrentValue == "")
			$this->Page_Terminate("file_uploadslist.php"); // Invalid key, return to list
		switch ($file_uploads->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("file_uploadslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$file_uploads->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $file_uploads->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$file_uploads->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$file_uploads->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $file_uploads;

		// Get upload data
			if ($file_uploads->Filename->Upload->UploadFile()) {

				// No action required
			} else {
				echo $file_uploads->Filename->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $file_uploads;
		$file_uploads->id->setFormValue($objForm->GetValue("x_id"));
		$file_uploads->Booking_ID->setFormValue($objForm->GetValue("x_Booking_ID"));
		$file_uploads->File_Type_ID->setFormValue($objForm->GetValue("x_File_Type_ID"));
		$file_uploads->Document_Pages->setFormValue($objForm->GetValue("x_Document_Pages"));
		$file_uploads->Date_Received_Subcon->setFormValue($objForm->GetValue("x_Date_Received_Subcon"));
		$file_uploads->Date_Received_Subcon->CurrentValue = ew_UnFormatDateTime($file_uploads->Date_Received_Subcon->CurrentValue, 6);
		$file_uploads->Date_Submitted_Client->setFormValue($objForm->GetValue("x_Date_Submitted_Client"));
		$file_uploads->Date_Submitted_Client->CurrentValue = ew_UnFormatDateTime($file_uploads->Date_Submitted_Client->CurrentValue, 6);
		$file_uploads->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $file_uploads;
		$this->LoadRow();
		$file_uploads->id->CurrentValue = $file_uploads->id->FormValue;
		$file_uploads->Booking_ID->CurrentValue = $file_uploads->Booking_ID->FormValue;
		$file_uploads->File_Type_ID->CurrentValue = $file_uploads->File_Type_ID->FormValue;
		$file_uploads->Document_Pages->CurrentValue = $file_uploads->Document_Pages->FormValue;
		$file_uploads->Date_Received_Subcon->CurrentValue = $file_uploads->Date_Received_Subcon->FormValue;
		$file_uploads->Date_Received_Subcon->CurrentValue = ew_UnFormatDateTime($file_uploads->Date_Received_Subcon->CurrentValue, 6);
		$file_uploads->Date_Submitted_Client->CurrentValue = $file_uploads->Date_Submitted_Client->FormValue;
		$file_uploads->Date_Submitted_Client->CurrentValue = ew_UnFormatDateTime($file_uploads->Date_Submitted_Client->CurrentValue, 6);
		$file_uploads->Remarks->CurrentValue = $file_uploads->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_uploads;
		$sFilter = $file_uploads->KeyFilter();

		// Call Row Selecting event
		$file_uploads->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_uploads->CurrentFilter = $sFilter;
		$sSql = $file_uploads->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_uploads->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_uploads;
		$file_uploads->id->setDbValue($rs->fields('id'));
		$file_uploads->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$file_uploads->Filename->Upload->DbValue = $rs->fields('Filename');
		$file_uploads->File_Type_ID->setDbValue($rs->fields('File_Type_ID'));
		$file_uploads->Document_Pages->setDbValue($rs->fields('Document_Pages'));
		$file_uploads->Date_Received_Subcon->setDbValue($rs->fields('Date_Received_Subcon'));
		$file_uploads->Date_Submitted_Client->setDbValue($rs->fields('Date_Submitted_Client'));
		$file_uploads->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_uploads;

		// Initialize URLs
		// Call Row_Rendering event

		$file_uploads->Row_Rendering();

		// Common render codes for all row types
		// id

		$file_uploads->id->CellCssStyle = ""; $file_uploads->id->CellCssClass = "";
		$file_uploads->id->CellAttrs = array(); $file_uploads->id->ViewAttrs = array(); $file_uploads->id->EditAttrs = array();

		// Booking_ID
		$file_uploads->Booking_ID->CellCssStyle = ""; $file_uploads->Booking_ID->CellCssClass = "";
		$file_uploads->Booking_ID->CellAttrs = array(); $file_uploads->Booking_ID->ViewAttrs = array(); $file_uploads->Booking_ID->EditAttrs = array();

		// Filename
		$file_uploads->Filename->CellCssStyle = ""; $file_uploads->Filename->CellCssClass = "";
		$file_uploads->Filename->CellAttrs = array(); $file_uploads->Filename->ViewAttrs = array(); $file_uploads->Filename->EditAttrs = array();

		// File_Type_ID
		$file_uploads->File_Type_ID->CellCssStyle = ""; $file_uploads->File_Type_ID->CellCssClass = "";
		$file_uploads->File_Type_ID->CellAttrs = array(); $file_uploads->File_Type_ID->ViewAttrs = array(); $file_uploads->File_Type_ID->EditAttrs = array();

		// Document_Pages
		$file_uploads->Document_Pages->CellCssStyle = ""; $file_uploads->Document_Pages->CellCssClass = "";
		$file_uploads->Document_Pages->CellAttrs = array(); $file_uploads->Document_Pages->ViewAttrs = array(); $file_uploads->Document_Pages->EditAttrs = array();

		// Date_Received_Subcon
		$file_uploads->Date_Received_Subcon->CellCssStyle = ""; $file_uploads->Date_Received_Subcon->CellCssClass = "";
		$file_uploads->Date_Received_Subcon->CellAttrs = array(); $file_uploads->Date_Received_Subcon->ViewAttrs = array(); $file_uploads->Date_Received_Subcon->EditAttrs = array();

		// Date_Submitted_Client
		$file_uploads->Date_Submitted_Client->CellCssStyle = ""; $file_uploads->Date_Submitted_Client->CellCssClass = "";
		$file_uploads->Date_Submitted_Client->CellAttrs = array(); $file_uploads->Date_Submitted_Client->ViewAttrs = array(); $file_uploads->Date_Submitted_Client->EditAttrs = array();

		// Remarks
		$file_uploads->Remarks->CellCssStyle = ""; $file_uploads->Remarks->CellCssClass = "";
		$file_uploads->Remarks->CellAttrs = array(); $file_uploads->Remarks->ViewAttrs = array(); $file_uploads->Remarks->EditAttrs = array();
		if ($file_uploads->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_uploads->id->ViewValue = $file_uploads->id->CurrentValue;
			$file_uploads->id->CssStyle = "";
			$file_uploads->id->CssClass = "";
			$file_uploads->id->ViewCustomAttributes = "";

			// Booking_ID
			if (strval($file_uploads->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Date` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$file_uploads->Booking_ID->ViewValue = $file_uploads->Booking_ID->CurrentValue;
				}
			} else {
				$file_uploads->Booking_ID->ViewValue = NULL;
			}
			$file_uploads->Booking_ID->CssStyle = "";
			$file_uploads->Booking_ID->CssClass = "";
			$file_uploads->Booking_ID->ViewCustomAttributes = "";

			// Filename
			if (!ew_Empty($file_uploads->Filename->Upload->DbValue)) {
				$file_uploads->Filename->ViewValue = $file_uploads->Filename->Upload->DbValue;
			} else {
				$file_uploads->Filename->ViewValue = "";
			}
			$file_uploads->Filename->CssStyle = "";
			$file_uploads->Filename->CssClass = "";
			$file_uploads->Filename->ViewCustomAttributes = "";

			// File_Type_ID
			if (strval($file_uploads->File_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads->File_Type_ID->CurrentValue) . "";
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
					$file_uploads->File_Type_ID->ViewValue = $rswrk->fields('File_Type');
					$rswrk->Close();
				} else {
					$file_uploads->File_Type_ID->ViewValue = $file_uploads->File_Type_ID->CurrentValue;
				}
			} else {
				$file_uploads->File_Type_ID->ViewValue = NULL;
			}
			$file_uploads->File_Type_ID->CssStyle = "";
			$file_uploads->File_Type_ID->CssClass = "";
			$file_uploads->File_Type_ID->ViewCustomAttributes = "";

			// Document_Pages
			$file_uploads->Document_Pages->ViewValue = $file_uploads->Document_Pages->CurrentValue;
			$file_uploads->Document_Pages->CssStyle = "";
			$file_uploads->Document_Pages->CssClass = "";
			$file_uploads->Document_Pages->ViewCustomAttributes = "";

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->ViewValue = $file_uploads->Date_Received_Subcon->CurrentValue;
			$file_uploads->Date_Received_Subcon->ViewValue = ew_FormatDateTime($file_uploads->Date_Received_Subcon->ViewValue, 6);
			$file_uploads->Date_Received_Subcon->CssStyle = "";
			$file_uploads->Date_Received_Subcon->CssClass = "";
			$file_uploads->Date_Received_Subcon->ViewCustomAttributes = "";

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->ViewValue = $file_uploads->Date_Submitted_Client->CurrentValue;
			$file_uploads->Date_Submitted_Client->ViewValue = ew_FormatDateTime($file_uploads->Date_Submitted_Client->ViewValue, 6);
			$file_uploads->Date_Submitted_Client->CssStyle = "";
			$file_uploads->Date_Submitted_Client->CssClass = "";
			$file_uploads->Date_Submitted_Client->ViewCustomAttributes = "";

			// Remarks
			$file_uploads->Remarks->ViewValue = $file_uploads->Remarks->CurrentValue;
			$file_uploads->Remarks->CssStyle = "";
			$file_uploads->Remarks->CssClass = "";
			$file_uploads->Remarks->ViewCustomAttributes = "";

			// id
			$file_uploads->id->HrefValue = "";
			$file_uploads->id->TooltipValue = "";

			// Booking_ID
			$file_uploads->Booking_ID->HrefValue = "";
			$file_uploads->Booking_ID->TooltipValue = "";

			// Filename
			if (!ew_Empty($file_uploads->Filename->Upload->DbValue)) {
				$file_uploads->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads->Filename->UploadPath) . ((!empty($file_uploads->Filename->ViewValue)) ? $file_uploads->Filename->ViewValue : $file_uploads->Filename->CurrentValue);
				if ($file_uploads->Export <> "") $file_uploads->Filename->HrefValue = ew_ConvertFullUrl($file_uploads->Filename->HrefValue);
			} else {
				$file_uploads->Filename->HrefValue = "";
			}
			$file_uploads->Filename->TooltipValue = "";

			// File_Type_ID
			$file_uploads->File_Type_ID->HrefValue = "";
			$file_uploads->File_Type_ID->TooltipValue = "";

			// Document_Pages
			$file_uploads->Document_Pages->HrefValue = "";
			$file_uploads->Document_Pages->TooltipValue = "";

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->HrefValue = "";
			$file_uploads->Date_Received_Subcon->TooltipValue = "";

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->HrefValue = "";
			$file_uploads->Date_Submitted_Client->TooltipValue = "";

			// Remarks
			$file_uploads->Remarks->HrefValue = "";
			$file_uploads->Remarks->TooltipValue = "";
		} elseif ($file_uploads->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$file_uploads->id->EditCustomAttributes = "";
			$file_uploads->id->EditValue = $file_uploads->id->CurrentValue;
			$file_uploads->id->CssStyle = "";
			$file_uploads->id->CssClass = "";
			$file_uploads->id->ViewCustomAttributes = "";

			// Booking_ID
			$file_uploads->Booking_ID->EditCustomAttributes = "";
			if ($file_uploads->Booking_ID->getSessionValue() <> "") {
				$file_uploads->Booking_ID->CurrentValue = $file_uploads->Booking_ID->getSessionValue();
			if (strval($file_uploads->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Date` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$file_uploads->Booking_ID->ViewValue = $file_uploads->Booking_ID->CurrentValue;
				}
			} else {
				$file_uploads->Booking_ID->ViewValue = NULL;
			}
			$file_uploads->Booking_ID->CssStyle = "";
			$file_uploads->Booking_ID->CssClass = "";
			$file_uploads->Booking_ID->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Booking_Number`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Date` Desc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$file_uploads->Booking_ID->EditValue = $arwrk;
			}

			// Filename
			$file_uploads->Filename->EditCustomAttributes = "";
			if (!ew_Empty($file_uploads->Filename->Upload->DbValue)) {
				$file_uploads->Filename->EditValue = $file_uploads->Filename->Upload->DbValue;
			} else {
				$file_uploads->Filename->EditValue = "";
			}

			// File_Type_ID
			$file_uploads->File_Type_ID->EditCustomAttributes = "";
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
			$file_uploads->File_Type_ID->EditValue = $arwrk;

			// Document_Pages
			$file_uploads->Document_Pages->EditCustomAttributes = "";
			$file_uploads->Document_Pages->EditValue = ew_HtmlEncode($file_uploads->Document_Pages->CurrentValue);

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->EditCustomAttributes = "";
			$file_uploads->Date_Received_Subcon->EditValue = ew_HtmlEncode(ew_FormatDateTime($file_uploads->Date_Received_Subcon->CurrentValue, 6));

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->EditCustomAttributes = "";
			$file_uploads->Date_Submitted_Client->EditValue = ew_HtmlEncode(ew_FormatDateTime($file_uploads->Date_Submitted_Client->CurrentValue, 6));

			// Remarks
			$file_uploads->Remarks->EditCustomAttributes = "";
			$file_uploads->Remarks->EditValue = ew_HtmlEncode($file_uploads->Remarks->CurrentValue);

			// Edit refer script
			// id

			$file_uploads->id->HrefValue = "";

			// Booking_ID
			$file_uploads->Booking_ID->HrefValue = "";

			// Filename
			if (!ew_Empty($file_uploads->Filename->Upload->DbValue)) {
				$file_uploads->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads->Filename->UploadPath) . ((!empty($file_uploads->Filename->EditValue)) ? $file_uploads->Filename->EditValue : $file_uploads->Filename->CurrentValue);
				if ($file_uploads->Export <> "") $file_uploads->Filename->HrefValue = ew_ConvertFullUrl($file_uploads->Filename->HrefValue);
			} else {
				$file_uploads->Filename->HrefValue = "";
			}

			// File_Type_ID
			$file_uploads->File_Type_ID->HrefValue = "";

			// Document_Pages
			$file_uploads->Document_Pages->HrefValue = "";

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->HrefValue = "";

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->HrefValue = "";

			// Remarks
			$file_uploads->Remarks->HrefValue = "";
		}

		// Call Row Rendered event
		if ($file_uploads->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_uploads->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $file_uploads;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($file_uploads->Filename->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($file_uploads->Filename->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $file_uploads->Filename->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($file_uploads->Document_Pages->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $file_uploads->Document_Pages->FldErrMsg();
		}
		if (!ew_CheckUSDate($file_uploads->Date_Received_Subcon->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $file_uploads->Date_Received_Subcon->FldErrMsg();
		}
		if (!ew_CheckUSDate($file_uploads->Date_Submitted_Client->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $file_uploads->Date_Submitted_Client->FldErrMsg();
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
		global $conn, $Security, $Language, $file_uploads;
		$sFilter = $file_uploads->KeyFilter();
		$file_uploads->CurrentFilter = $sFilter;
		$sSql = $file_uploads->SQL();
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

			// Booking_ID
			$file_uploads->Booking_ID->SetDbValueDef($rsnew, $file_uploads->Booking_ID->CurrentValue, NULL, FALSE);

			// Filename
			$file_uploads->Filename->Upload->SaveToSession(); // Save file value to Session
						if ($file_uploads->Filename->Upload->Action == "2" || $file_uploads->Filename->Upload->Action == "3") { // Update/Remove
			$file_uploads->Filename->Upload->DbValue = $rs->fields('Filename'); // Get original value
			if (is_null($file_uploads->Filename->Upload->Value)) {
				$rsnew['Filename'] = NULL;
			} else {
				$rsnew['Filename'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $file_uploads->Filename->UploadPath), $file_uploads->Filename->Upload->FileName);
			}
			}

			// File_Type_ID
			$file_uploads->File_Type_ID->SetDbValueDef($rsnew, $file_uploads->File_Type_ID->CurrentValue, NULL, FALSE);

			// Document_Pages
			$file_uploads->Document_Pages->SetDbValueDef($rsnew, $file_uploads->Document_Pages->CurrentValue, NULL, FALSE);

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->SetDbValueDef($rsnew, ew_UnFormatDateTime($file_uploads->Date_Received_Subcon->CurrentValue, 6, FALSE), NULL);

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->SetDbValueDef($rsnew, ew_UnFormatDateTime($file_uploads->Date_Submitted_Client->CurrentValue, 6, FALSE), NULL);

			// Remarks
			$file_uploads->Remarks->SetDbValueDef($rsnew, $file_uploads->Remarks->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $file_uploads->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($file_uploads->Filename->Upload->Value)) {
				$file_uploads->Filename->Upload->SaveToFile($file_uploads->Filename->UploadPath, $rsnew['Filename'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($file_uploads->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($file_uploads->CancelMessage <> "") {
					$this->setMessage($file_uploads->CancelMessage);
					$file_uploads->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$file_uploads->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Filename
		$file_uploads->Filename->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $file_uploads;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "bookings") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $file_uploads->SqlMasterFilter_bookings();
				$this->sDbDetailFilter = $file_uploads->SqlDetailFilter_bookings();
				if (@$_GET["id"] <> "") {
					$GLOBALS["bookings"]->id->setQueryStringValue($_GET["id"]);
					$file_uploads->Booking_ID->setQueryStringValue($GLOBALS["bookings"]->id->QueryStringValue);
					$file_uploads->Booking_ID->setSessionValue($file_uploads->Booking_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["bookings"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["bookings"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Booking_ID@", ew_AdjustSql($GLOBALS["bookings"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$file_uploads->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$file_uploads->setStartRecordNumber($this->lStartRec);
			$file_uploads->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$file_uploads->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "bookings") {
				if ($file_uploads->Booking_ID->QueryStringValue == "") $file_uploads->Booking_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $file_uploads->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $file_uploads->getDetailFilter(); // Restore detail filter
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
