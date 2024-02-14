<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "booking_helpersinfo.php" ?>
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
$booking_helpers_add = new cbooking_helpers_add();
$Page =& $booking_helpers_add;

// Page init
$booking_helpers_add->Page_Init();

// Page main
$booking_helpers_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var booking_helpers_add = new ew_Page("booking_helpers_add");

// page properties
booking_helpers_add.PageID = "add"; // page ID
booking_helpers_add.FormID = "fbooking_helpersadd"; // form ID
var EW_PAGE_ID = booking_helpers_add.PageID; // for backward compatibility

// extend page with ValidateForm function
booking_helpers_add.ValidateForm = function(fobj) {
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
booking_helpers_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
booking_helpers_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
booking_helpers_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $booking_helpers->TableCaption() ?><br><br>
<a href="<?php echo $booking_helpers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$booking_helpers_add->ShowMessage();
?>
<form name="fbooking_helpersadd" id="fbooking_helpersadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return booking_helpers_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="booking_helpers">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($booking_helpers->Booking_ID->Visible) { // Booking_ID ?>
	<tr<?php echo $booking_helpers->Booking_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $booking_helpers->Booking_ID->FldCaption() ?></td>
		<td<?php echo $booking_helpers->Booking_ID->CellAttributes() ?>><span id="el_Booking_ID">
<?php if ($booking_helpers->Booking_ID->getSessionValue() <> "") { ?>
<div<?php echo $booking_helpers->Booking_ID->ViewAttributes() ?>><?php echo $booking_helpers->Booking_ID->ViewValue ?></div>
<input type="hidden" id="x_Booking_ID" name="x_Booking_ID" value="<?php echo ew_HtmlEncode($booking_helpers->Booking_ID->CurrentValue) ?>">
<?php } else { ?>
<select id="x_Booking_ID" name="x_Booking_ID" title="<?php echo $booking_helpers->Booking_ID->FldTitle() ?>"<?php echo $booking_helpers->Booking_ID->EditAttributes() ?>>
<?php
if (is_array($booking_helpers->Booking_ID->EditValue)) {
	$arwrk = $booking_helpers->Booking_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($booking_helpers->Booking_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $booking_helpers->Booking_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($booking_helpers->Helper_ID->Visible) { // Helper_ID ?>
	<tr<?php echo $booking_helpers->Helper_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $booking_helpers->Helper_ID->FldCaption() ?></td>
		<td<?php echo $booking_helpers->Helper_ID->CellAttributes() ?>><span id="el_Helper_ID">
<select id="x_Helper_ID" name="x_Helper_ID" title="<?php echo $booking_helpers->Helper_ID->FldTitle() ?>"<?php echo $booking_helpers->Helper_ID->EditAttributes() ?>>
<?php
if (is_array($booking_helpers->Helper_ID->EditValue)) {
	$arwrk = $booking_helpers->Helper_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($booking_helpers->Helper_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $booking_helpers->Helper_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($booking_helpers->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $booking_helpers->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $booking_helpers->Remarks->FldCaption() ?></td>
		<td<?php echo $booking_helpers->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $booking_helpers->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $booking_helpers->Remarks->EditAttributes() ?>><?php echo $booking_helpers->Remarks->EditValue ?></textarea>
</span><?php echo $booking_helpers->Remarks->CustomMsg ?></td>
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
$booking_helpers_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cbooking_helpers_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'booking_helpers';

	// Page object name
	var $PageObjName = 'booking_helpers_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $booking_helpers;
		if ($booking_helpers->UseTokenInUrl) $PageUrl .= "t=" . $booking_helpers->TableVar . "&"; // Add page token
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
		global $objForm, $booking_helpers;
		if ($booking_helpers->UseTokenInUrl) {
			if ($objForm)
				return ($booking_helpers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($booking_helpers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbooking_helpers_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (booking_helpers)
		$GLOBALS["booking_helpers"] = new cbooking_helpers();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'booking_helpers', TRUE);

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
		global $booking_helpers;

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
			$this->Page_Terminate("booking_helperslist.php");
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
		global $objForm, $Language, $gsFormError, $booking_helpers;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $booking_helpers->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $booking_helpers->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$booking_helpers->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $booking_helpers->CurrentAction = "C"; // Copy record
		  } else {
		    $booking_helpers->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($booking_helpers->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("booking_helperslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$booking_helpers->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $booking_helpers->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$booking_helpers->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $booking_helpers;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $booking_helpers;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $booking_helpers;
		$booking_helpers->Booking_ID->setFormValue($objForm->GetValue("x_Booking_ID"));
		$booking_helpers->Helper_ID->setFormValue($objForm->GetValue("x_Helper_ID"));
		$booking_helpers->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$booking_helpers->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $booking_helpers;
		$booking_helpers->id->CurrentValue = $booking_helpers->id->FormValue;
		$booking_helpers->Booking_ID->CurrentValue = $booking_helpers->Booking_ID->FormValue;
		$booking_helpers->Helper_ID->CurrentValue = $booking_helpers->Helper_ID->FormValue;
		$booking_helpers->Remarks->CurrentValue = $booking_helpers->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $booking_helpers;
		$sFilter = $booking_helpers->KeyFilter();

		// Call Row Selecting event
		$booking_helpers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$booking_helpers->CurrentFilter = $sFilter;
		$sSql = $booking_helpers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$booking_helpers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $booking_helpers;
		$booking_helpers->id->setDbValue($rs->fields('id'));
		$booking_helpers->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$booking_helpers->Helper_ID->setDbValue($rs->fields('Helper_ID'));
		$booking_helpers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $booking_helpers;

		// Initialize URLs
		// Call Row_Rendering event

		$booking_helpers->Row_Rendering();

		// Common render codes for all row types
		// Booking_ID

		$booking_helpers->Booking_ID->CellCssStyle = ""; $booking_helpers->Booking_ID->CellCssClass = "";
		$booking_helpers->Booking_ID->CellAttrs = array(); $booking_helpers->Booking_ID->ViewAttrs = array(); $booking_helpers->Booking_ID->EditAttrs = array();

		// Helper_ID
		$booking_helpers->Helper_ID->CellCssStyle = ""; $booking_helpers->Helper_ID->CellCssClass = "";
		$booking_helpers->Helper_ID->CellAttrs = array(); $booking_helpers->Helper_ID->ViewAttrs = array(); $booking_helpers->Helper_ID->EditAttrs = array();

		// Remarks
		$booking_helpers->Remarks->CellCssStyle = ""; $booking_helpers->Remarks->CellCssClass = "";
		$booking_helpers->Remarks->CellAttrs = array(); $booking_helpers->Remarks->ViewAttrs = array(); $booking_helpers->Remarks->EditAttrs = array();
		if ($booking_helpers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$booking_helpers->id->ViewValue = $booking_helpers->id->CurrentValue;
			$booking_helpers->id->CssStyle = "";
			$booking_helpers->id->CssClass = "";
			$booking_helpers->id->ViewCustomAttributes = "";

			// Booking_ID
			if (strval($booking_helpers->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$booking_helpers->Booking_ID->ViewValue = $booking_helpers->Booking_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Booking_ID->ViewValue = NULL;
			}
			$booking_helpers->Booking_ID->CssStyle = "";
			$booking_helpers->Booking_ID->CssClass = "";
			$booking_helpers->Booking_ID->ViewCustomAttributes = "";

			// Helper_ID
			if (strval($booking_helpers->Helper_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Helper_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Helper_Name` FROM `helpers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Helper_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Helper_ID->ViewValue = $rswrk->fields('Helper_Name');
					$rswrk->Close();
				} else {
					$booking_helpers->Helper_ID->ViewValue = $booking_helpers->Helper_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Helper_ID->ViewValue = NULL;
			}
			$booking_helpers->Helper_ID->CssStyle = "";
			$booking_helpers->Helper_ID->CssClass = "";
			$booking_helpers->Helper_ID->ViewCustomAttributes = "";

			// Remarks
			$booking_helpers->Remarks->ViewValue = $booking_helpers->Remarks->CurrentValue;
			$booking_helpers->Remarks->CssStyle = "";
			$booking_helpers->Remarks->CssClass = "";
			$booking_helpers->Remarks->ViewCustomAttributes = "";

			// Booking_ID
			$booking_helpers->Booking_ID->HrefValue = "";
			$booking_helpers->Booking_ID->TooltipValue = "";

			// Helper_ID
			$booking_helpers->Helper_ID->HrefValue = "";
			$booking_helpers->Helper_ID->TooltipValue = "";

			// Remarks
			$booking_helpers->Remarks->HrefValue = "";
			$booking_helpers->Remarks->TooltipValue = "";
		} elseif ($booking_helpers->RowType == EW_ROWTYPE_ADD) { // Add row

			// Booking_ID
			$booking_helpers->Booking_ID->EditCustomAttributes = "";
			if ($booking_helpers->Booking_ID->getSessionValue() <> "") {
				$booking_helpers->Booking_ID->CurrentValue = $booking_helpers->Booking_ID->getSessionValue();
			if (strval($booking_helpers->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$booking_helpers->Booking_ID->ViewValue = $booking_helpers->Booking_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Booking_ID->ViewValue = NULL;
			}
			$booking_helpers->Booking_ID->CssStyle = "";
			$booking_helpers->Booking_ID->CssClass = "";
			$booking_helpers->Booking_ID->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Booking_Number`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `bookings`";
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
			$booking_helpers->Booking_ID->EditValue = $arwrk;
			}

			// Helper_ID
			$booking_helpers->Helper_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Helper_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `helpers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Helper_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$booking_helpers->Helper_ID->EditValue = $arwrk;

			// Remarks
			$booking_helpers->Remarks->EditCustomAttributes = "";
			$booking_helpers->Remarks->EditValue = ew_HtmlEncode($booking_helpers->Remarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($booking_helpers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$booking_helpers->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $booking_helpers;

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
		global $conn, $Language, $Security, $booking_helpers;
		$rsnew = array();

		// Booking_ID
		$booking_helpers->Booking_ID->SetDbValueDef($rsnew, $booking_helpers->Booking_ID->CurrentValue, NULL, FALSE);

		// Helper_ID
		$booking_helpers->Helper_ID->SetDbValueDef($rsnew, $booking_helpers->Helper_ID->CurrentValue, NULL, FALSE);

		// Remarks
		$booking_helpers->Remarks->SetDbValueDef($rsnew, $booking_helpers->Remarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $booking_helpers->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($booking_helpers->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($booking_helpers->CancelMessage <> "") {
				$this->setMessage($booking_helpers->CancelMessage);
				$booking_helpers->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$booking_helpers->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $booking_helpers->id->DbValue;

			// Call Row Inserted event
			$booking_helpers->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $booking_helpers;
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
				$this->sDbMasterFilter = $booking_helpers->SqlMasterFilter_bookings();
				$this->sDbDetailFilter = $booking_helpers->SqlDetailFilter_bookings();
				if (@$_GET["id"] <> "") {
					$GLOBALS["bookings"]->id->setQueryStringValue($_GET["id"]);
					$booking_helpers->Booking_ID->setQueryStringValue($GLOBALS["bookings"]->id->QueryStringValue);
					$booking_helpers->Booking_ID->setSessionValue($booking_helpers->Booking_ID->QueryStringValue);
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
			$booking_helpers->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$booking_helpers->setStartRecordNumber($this->lStartRec);
			$booking_helpers->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$booking_helpers->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "bookings") {
				if ($booking_helpers->Booking_ID->QueryStringValue == "") $booking_helpers->Booking_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $booking_helpers->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $booking_helpers->getDetailFilter(); // Restore detail filter
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
