<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "helpersinfo.php" ?>
<?php include "subconsinfo.php" ?>
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
$helpers_add = new chelpers_add();
$Page =& $helpers_add;

// Page init
$helpers_add->Page_Init();

// Page main
$helpers_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var helpers_add = new ew_Page("helpers_add");

// page properties
helpers_add.PageID = "add"; // page ID
helpers_add.FormID = "fhelpersadd"; // form ID
var EW_PAGE_ID = helpers_add.PageID; // for backward compatibility

// extend page with ValidateForm function
helpers_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Uploads"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
helpers_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
helpers_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
helpers_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $helpers->TableCaption() ?><br><br>
<a href="<?php echo $helpers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$helpers_add->ShowMessage();
?>
<form name="fhelpersadd" id="fhelpersadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return helpers_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="helpers">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($helpers->Helper_Name->Visible) { // Helper_Name ?>
	<tr<?php echo $helpers->Helper_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Helper_Name->FldCaption() ?></td>
		<td<?php echo $helpers->Helper_Name->CellAttributes() ?>><span id="el_Helper_Name">
<input type="text" name="x_Helper_Name" id="x_Helper_Name" title="<?php echo $helpers->Helper_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $helpers->Helper_Name->EditValue ?>"<?php echo $helpers->Helper_Name->EditAttributes() ?>>
</span><?php echo $helpers->Helper_Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($helpers->Subcon_ID->Visible) { // Subcon_ID ?>
	<tr<?php echo $helpers->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $helpers->Subcon_ID->CellAttributes() ?>><span id="el_Subcon_ID">
<?php if ($helpers->Subcon_ID->getSessionValue() <> "") { ?>
<div<?php echo $helpers->Subcon_ID->ViewAttributes() ?>><?php echo $helpers->Subcon_ID->ViewValue ?></div>
<input type="hidden" id="x_Subcon_ID" name="x_Subcon_ID" value="<?php echo ew_HtmlEncode($helpers->Subcon_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Subcon_ID" name="x_Subcon_ID" title="<?php echo $helpers->Subcon_ID->FldTitle() ?>"<?php echo $helpers->Subcon_ID->EditAttributes() ?>>
<?php
if (is_array($helpers->Subcon_ID->EditValue)) {
	$arwrk = $helpers->Subcon_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($helpers->Subcon_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $helpers->Subcon_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($helpers->Address->Visible) { // Address ?>
	<tr<?php echo $helpers->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Address->FldCaption() ?></td>
		<td<?php echo $helpers->Address->CellAttributes() ?>><span id="el_Address">
<input type="text" name="x_Address" id="x_Address" title="<?php echo $helpers->Address->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $helpers->Address->EditValue ?>"<?php echo $helpers->Address->EditAttributes() ?>>
</span><?php echo $helpers->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($helpers->Phone->Visible) { // Phone ?>
	<tr<?php echo $helpers->Phone->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Phone->FldCaption() ?></td>
		<td<?php echo $helpers->Phone->CellAttributes() ?>><span id="el_Phone">
<input type="text" name="x_Phone" id="x_Phone" title="<?php echo $helpers->Phone->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $helpers->Phone->EditValue ?>"<?php echo $helpers->Phone->EditAttributes() ?>>
</span><?php echo $helpers->Phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($helpers->Uploads->Visible) { // Uploads ?>
	<tr<?php echo $helpers->Uploads->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Uploads->FldCaption() ?></td>
		<td<?php echo $helpers->Uploads->CellAttributes() ?>><span id="el_Uploads">
<input type="file" name="x_Uploads" id="x_Uploads" title="<?php echo $helpers->Uploads->FldTitle() ?>" size="30"<?php echo $helpers->Uploads->EditAttributes() ?>>
</div>
</span><?php echo $helpers->Uploads->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($helpers->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $helpers->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $helpers->Remarks->FldCaption() ?></td>
		<td<?php echo $helpers->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $helpers->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $helpers->Remarks->EditAttributes() ?>><?php echo $helpers->Remarks->EditValue ?></textarea>
</span><?php echo $helpers->Remarks->CustomMsg ?></td>
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
$helpers_add->Page_Terminate();
?>
<?php

//
// Page class
//
class chelpers_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'helpers';

	// Page object name
	var $PageObjName = 'helpers_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $helpers;
		if ($helpers->UseTokenInUrl) $PageUrl .= "t=" . $helpers->TableVar . "&"; // Add page token
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
		global $objForm, $helpers;
		if ($helpers->UseTokenInUrl) {
			if ($objForm)
				return ($helpers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($helpers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function chelpers_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (helpers)
		$GLOBALS["helpers"] = new chelpers();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'helpers', TRUE);

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
		global $helpers;

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
			$this->Page_Terminate("helperslist.php");
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
		global $objForm, $Language, $gsFormError, $helpers;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $helpers->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $helpers->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$helpers->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $helpers->CurrentAction = "C"; // Copy record
		  } else {
		    $helpers->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($helpers->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("helperslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$helpers->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $helpers->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$helpers->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $helpers;

		// Get upload data
			if ($helpers->Uploads->Upload->UploadFile()) {

				// No action required
			} else {
				echo $helpers->Uploads->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $helpers;
		$helpers->Uploads->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $helpers;
		$helpers->Helper_Name->setFormValue($objForm->GetValue("x_Helper_Name"));
		$helpers->Subcon_ID->setFormValue($objForm->GetValue("x_Subcon_ID"));
		$helpers->Address->setFormValue($objForm->GetValue("x_Address"));
		$helpers->Phone->setFormValue($objForm->GetValue("x_Phone"));
		$helpers->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$helpers->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $helpers;
		$helpers->id->CurrentValue = $helpers->id->FormValue;
		$helpers->Helper_Name->CurrentValue = $helpers->Helper_Name->FormValue;
		$helpers->Subcon_ID->CurrentValue = $helpers->Subcon_ID->FormValue;
		$helpers->Address->CurrentValue = $helpers->Address->FormValue;
		$helpers->Phone->CurrentValue = $helpers->Phone->FormValue;
		$helpers->Remarks->CurrentValue = $helpers->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $helpers;
		$sFilter = $helpers->KeyFilter();

		// Call Row Selecting event
		$helpers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$helpers->CurrentFilter = $sFilter;
		$sSql = $helpers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$helpers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $helpers;
		$helpers->id->setDbValue($rs->fields('id'));
		$helpers->Helper_Name->setDbValue($rs->fields('Helper_Name'));
		$helpers->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$helpers->Address->setDbValue($rs->fields('Address'));
		$helpers->Phone->setDbValue($rs->fields('Phone'));
		$helpers->Uploads->Upload->DbValue = $rs->fields('Uploads');
		$helpers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $helpers;

		// Initialize URLs
		// Call Row_Rendering event

		$helpers->Row_Rendering();

		// Common render codes for all row types
		// Helper_Name

		$helpers->Helper_Name->CellCssStyle = ""; $helpers->Helper_Name->CellCssClass = "";
		$helpers->Helper_Name->CellAttrs = array(); $helpers->Helper_Name->ViewAttrs = array(); $helpers->Helper_Name->EditAttrs = array();

		// Subcon_ID
		$helpers->Subcon_ID->CellCssStyle = ""; $helpers->Subcon_ID->CellCssClass = "";
		$helpers->Subcon_ID->CellAttrs = array(); $helpers->Subcon_ID->ViewAttrs = array(); $helpers->Subcon_ID->EditAttrs = array();

		// Address
		$helpers->Address->CellCssStyle = ""; $helpers->Address->CellCssClass = "";
		$helpers->Address->CellAttrs = array(); $helpers->Address->ViewAttrs = array(); $helpers->Address->EditAttrs = array();

		// Phone
		$helpers->Phone->CellCssStyle = ""; $helpers->Phone->CellCssClass = "";
		$helpers->Phone->CellAttrs = array(); $helpers->Phone->ViewAttrs = array(); $helpers->Phone->EditAttrs = array();

		// Uploads
		$helpers->Uploads->CellCssStyle = ""; $helpers->Uploads->CellCssClass = "";
		$helpers->Uploads->CellAttrs = array(); $helpers->Uploads->ViewAttrs = array(); $helpers->Uploads->EditAttrs = array();

		// Remarks
		$helpers->Remarks->CellCssStyle = ""; $helpers->Remarks->CellCssClass = "";
		$helpers->Remarks->CellAttrs = array(); $helpers->Remarks->ViewAttrs = array(); $helpers->Remarks->EditAttrs = array();
		if ($helpers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$helpers->id->ViewValue = $helpers->id->CurrentValue;
			$helpers->id->CssStyle = "";
			$helpers->id->CssClass = "";
			$helpers->id->ViewCustomAttributes = "";

			// Helper_Name
			$helpers->Helper_Name->ViewValue = $helpers->Helper_Name->CurrentValue;
			$helpers->Helper_Name->CssStyle = "";
			$helpers->Helper_Name->CssClass = "";
			$helpers->Helper_Name->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($helpers->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($helpers->Subcon_ID->CurrentValue) . "";
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
					$helpers->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$helpers->Subcon_ID->ViewValue = $helpers->Subcon_ID->CurrentValue;
				}
			} else {
				$helpers->Subcon_ID->ViewValue = NULL;
			}
			$helpers->Subcon_ID->CssStyle = "";
			$helpers->Subcon_ID->CssClass = "";
			$helpers->Subcon_ID->ViewCustomAttributes = "";

			// Address
			$helpers->Address->ViewValue = $helpers->Address->CurrentValue;
			$helpers->Address->CssStyle = "";
			$helpers->Address->CssClass = "";
			$helpers->Address->ViewCustomAttributes = "";

			// Phone
			$helpers->Phone->ViewValue = $helpers->Phone->CurrentValue;
			$helpers->Phone->CssStyle = "";
			$helpers->Phone->CssClass = "";
			$helpers->Phone->ViewCustomAttributes = "";

			// Uploads
			if (!ew_Empty($helpers->Uploads->Upload->DbValue)) {
				$helpers->Uploads->ViewValue = $helpers->Uploads->Upload->DbValue;
			} else {
				$helpers->Uploads->ViewValue = "";
			}
			$helpers->Uploads->CssStyle = "";
			$helpers->Uploads->CssClass = "";
			$helpers->Uploads->ViewCustomAttributes = "";

			// Remarks
			$helpers->Remarks->ViewValue = $helpers->Remarks->CurrentValue;
			$helpers->Remarks->CssStyle = "";
			$helpers->Remarks->CssClass = "";
			$helpers->Remarks->ViewCustomAttributes = "";

			// Helper_Name
			$helpers->Helper_Name->HrefValue = "";
			$helpers->Helper_Name->TooltipValue = "";

			// Subcon_ID
			$helpers->Subcon_ID->HrefValue = "";
			$helpers->Subcon_ID->TooltipValue = "";

			// Address
			$helpers->Address->HrefValue = "";
			$helpers->Address->TooltipValue = "";

			// Phone
			$helpers->Phone->HrefValue = "";
			$helpers->Phone->TooltipValue = "";

			// Uploads
			if (!ew_Empty($helpers->Uploads->Upload->DbValue)) {
				$helpers->Uploads->HrefValue = ew_UploadPathEx(FALSE, $helpers->Uploads->UploadPath) . ((!empty($helpers->Uploads->ViewValue)) ? $helpers->Uploads->ViewValue : $helpers->Uploads->CurrentValue);
				if ($helpers->Export <> "") $helpers->Uploads->HrefValue = ew_ConvertFullUrl($helpers->Uploads->HrefValue);
			} else {
				$helpers->Uploads->HrefValue = "";
			}
			$helpers->Uploads->TooltipValue = "";

			// Remarks
			$helpers->Remarks->HrefValue = "";
			$helpers->Remarks->TooltipValue = "";
		} elseif ($helpers->RowType == EW_ROWTYPE_ADD) { // Add row

			// Helper_Name
			$helpers->Helper_Name->EditCustomAttributes = "";
			$helpers->Helper_Name->EditValue = ew_HtmlEncode($helpers->Helper_Name->CurrentValue);

			// Subcon_ID
			$helpers->Subcon_ID->EditCustomAttributes = "";
			if ($helpers->Subcon_ID->getSessionValue() <> "") {
				$helpers->Subcon_ID->CurrentValue = $helpers->Subcon_ID->getSessionValue();
			if (strval($helpers->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($helpers->Subcon_ID->CurrentValue) . "";
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
					$helpers->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$helpers->Subcon_ID->ViewValue = $helpers->Subcon_ID->CurrentValue;
				}
			} else {
				$helpers->Subcon_ID->ViewValue = NULL;
			}
			$helpers->Subcon_ID->CssStyle = "";
			$helpers->Subcon_ID->CssClass = "";
			$helpers->Subcon_ID->ViewCustomAttributes = "";
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
			$helpers->Subcon_ID->EditValue = $arwrk;
			}

			// Address
			$helpers->Address->EditCustomAttributes = "";
			$helpers->Address->EditValue = ew_HtmlEncode($helpers->Address->CurrentValue);

			// Phone
			$helpers->Phone->EditCustomAttributes = "";
			$helpers->Phone->EditValue = ew_HtmlEncode($helpers->Phone->CurrentValue);

			// Uploads
			$helpers->Uploads->EditCustomAttributes = "";
			if (!ew_Empty($helpers->Uploads->Upload->DbValue)) {
				$helpers->Uploads->EditValue = $helpers->Uploads->Upload->DbValue;
			} else {
				$helpers->Uploads->EditValue = "";
			}

			// Remarks
			$helpers->Remarks->EditCustomAttributes = "";
			$helpers->Remarks->EditValue = ew_HtmlEncode($helpers->Remarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($helpers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$helpers->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $helpers;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($helpers->Uploads->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($helpers->Uploads->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $helpers->Uploads->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}

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
		global $conn, $Language, $Security, $helpers;
		$rsnew = array();

		// Helper_Name
		$helpers->Helper_Name->SetDbValueDef($rsnew, $helpers->Helper_Name->CurrentValue, NULL, FALSE);

		// Subcon_ID
		$helpers->Subcon_ID->SetDbValueDef($rsnew, $helpers->Subcon_ID->CurrentValue, NULL, FALSE);

		// Address
		$helpers->Address->SetDbValueDef($rsnew, $helpers->Address->CurrentValue, NULL, FALSE);

		// Phone
		$helpers->Phone->SetDbValueDef($rsnew, $helpers->Phone->CurrentValue, NULL, FALSE);

		// Uploads
		$helpers->Uploads->Upload->SaveToSession(); // Save file value to Session
		if (is_null($helpers->Uploads->Upload->Value)) {
			$rsnew['Uploads'] = NULL;
		} else {
			$rsnew['Uploads'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $helpers->Uploads->UploadPath), $helpers->Uploads->Upload->FileName);
		}

		// Remarks
		$helpers->Remarks->SetDbValueDef($rsnew, $helpers->Remarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $helpers->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($helpers->Uploads->Upload->Value)) {
				$helpers->Uploads->Upload->SaveToFile($helpers->Uploads->UploadPath, $rsnew['Uploads'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($helpers->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($helpers->CancelMessage <> "") {
				$this->setMessage($helpers->CancelMessage);
				$helpers->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$helpers->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $helpers->id->DbValue;

			// Call Row Inserted event
			$helpers->Row_Inserted($rsnew);
		}

		// Uploads
		$helpers->Uploads->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $helpers;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "subcons") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $helpers->SqlMasterFilter_subcons();
				$this->sDbDetailFilter = $helpers->SqlDetailFilter_subcons();
				if (@$_GET["id"] <> "") {
					$GLOBALS["subcons"]->id->setQueryStringValue($_GET["id"]);
					$helpers->Subcon_ID->setQueryStringValue($GLOBALS["subcons"]->id->QueryStringValue);
					$helpers->Subcon_ID->setSessionValue($helpers->Subcon_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["subcons"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Subcon_ID@", ew_AdjustSql($GLOBALS["subcons"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$helpers->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$helpers->setStartRecordNumber($this->lStartRec);
			$helpers->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$helpers->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "subcons") {
				if ($helpers->Subcon_ID->QueryStringValue == "") $helpers->Subcon_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $helpers->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $helpers->getDetailFilter(); // Restore detail filter
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
