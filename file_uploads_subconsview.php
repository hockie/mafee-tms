<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_uploads_subconsinfo.php" ?>
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
$file_uploads_subcons_view = new cfile_uploads_subcons_view();
$Page =& $file_uploads_subcons_view;

// Page init
$file_uploads_subcons_view->Page_Init();

// Page main
$file_uploads_subcons_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($file_uploads_subcons->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var file_uploads_subcons_view = new ew_Page("file_uploads_subcons_view");

// page properties
file_uploads_subcons_view.PageID = "view"; // page ID
file_uploads_subcons_view.FormID = "ffile_uploads_subconsview"; // form ID
var EW_PAGE_ID = file_uploads_subcons_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
file_uploads_subcons_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
file_uploads_subcons_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
file_uploads_subcons_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_uploads_subcons_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_uploads_subcons->TableCaption() ?>
<br><br>
<?php if ($file_uploads_subcons->Export == "") { ?>
<a href="<?php echo $file_uploads_subcons_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $file_uploads_subcons_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $file_uploads_subcons_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $file_uploads_subcons_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a href="<?php echo $file_uploads_subcons_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_uploads_subcons_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($file_uploads_subcons->id->Visible) { // id ?>
	<tr<?php echo $file_uploads_subcons->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->id->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->id->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->id->ViewAttributes() ?>><?php echo $file_uploads_subcons->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Subcon_ID->Visible) { // Subcon_ID ?>
	<tr<?php echo $file_uploads_subcons->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Subcon_ID->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->Subcon_ID->ViewAttributes() ?>><?php echo $file_uploads_subcons->Subcon_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Filename->Visible) { // Filename ?>
	<tr<?php echo $file_uploads_subcons->Filename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Filename->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Filename->CellAttributes() ?>>
<?php if ($file_uploads_subcons->Filename->HrefValue <> "" || $file_uploads_subcons->Filename->TooltipValue <> "") { ?>
<?php if (!empty($file_uploads_subcons->Filename->Upload->DbValue)) { ?>
<a href="<?php echo $file_uploads_subcons->Filename->HrefValue ?>"><?php echo $file_uploads_subcons->Filename->ViewValue ?></a>
<?php } elseif (!in_array($file_uploads_subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($file_uploads_subcons->Filename->Upload->DbValue)) { ?>
<?php echo $file_uploads_subcons->Filename->ViewValue ?>
<?php } elseif (!in_array($file_uploads_subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->File_Type_ID->Visible) { // File_Type_ID ?>
	<tr<?php echo $file_uploads_subcons->File_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->File_Type_ID->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->File_Type_ID->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->File_Type_ID->ViewAttributes() ?>><?php echo $file_uploads_subcons->File_Type_ID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Created->Visible) { // Created ?>
	<tr<?php echo $file_uploads_subcons->Created->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Created->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Created->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->Created->ViewAttributes() ?>><?php echo $file_uploads_subcons->Created->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Modified->Visible) { // Modified ?>
	<tr<?php echo $file_uploads_subcons->Modified->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Modified->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Modified->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->Modified->ViewAttributes() ?>><?php echo $file_uploads_subcons->Modified->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($file_uploads_subcons->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $file_uploads_subcons->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $file_uploads_subcons->Remarks->FldCaption() ?></td>
		<td<?php echo $file_uploads_subcons->Remarks->CellAttributes() ?>>
<div<?php echo $file_uploads_subcons->Remarks->ViewAttributes() ?>><?php echo $file_uploads_subcons->Remarks->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($file_uploads_subcons->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$file_uploads_subcons_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_uploads_subcons_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'file_uploads_subcons';

	// Page object name
	var $PageObjName = 'file_uploads_subcons_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_uploads_subcons;
		if ($file_uploads_subcons->UseTokenInUrl) $PageUrl .= "t=" . $file_uploads_subcons->TableVar . "&"; // Add page token
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
		global $objForm, $file_uploads_subcons;
		if ($file_uploads_subcons->UseTokenInUrl) {
			if ($objForm)
				return ($file_uploads_subcons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_uploads_subcons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_uploads_subcons_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_uploads_subcons)
		$GLOBALS["file_uploads_subcons"] = new cfile_uploads_subcons();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_uploads_subcons', TRUE);

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
		global $file_uploads_subcons;

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("file_uploads_subconslist.php");
		}

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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $file_uploads_subcons;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$file_uploads_subcons->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $file_uploads_subcons->id->QueryStringValue;
			} else {
				$sReturnUrl = "file_uploads_subconslist.php"; // Return to list
			}

			// Get action
			$file_uploads_subcons->CurrentAction = "I"; // Display form
			switch ($file_uploads_subcons->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "file_uploads_subconslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "file_uploads_subconslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$file_uploads_subcons->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $file_uploads_subcons;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $file_uploads_subcons->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$file_uploads_subcons->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_uploads_subcons;
		$sFilter = $file_uploads_subcons->KeyFilter();

		// Call Row Selecting event
		$file_uploads_subcons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_uploads_subcons->CurrentFilter = $sFilter;
		$sSql = $file_uploads_subcons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_uploads_subcons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_uploads_subcons;
		$file_uploads_subcons->id->setDbValue($rs->fields('id'));
		$file_uploads_subcons->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$file_uploads_subcons->Filename->Upload->DbValue = $rs->fields('Filename');
		$file_uploads_subcons->File_Type_ID->setDbValue($rs->fields('File_Type_ID'));
		$file_uploads_subcons->Created->setDbValue($rs->fields('Created'));
		$file_uploads_subcons->Modified->setDbValue($rs->fields('Modified'));
		$file_uploads_subcons->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_uploads_subcons;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($file_uploads_subcons->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($file_uploads_subcons->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($file_uploads_subcons->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($file_uploads_subcons->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($file_uploads_subcons->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($file_uploads_subcons->id->CurrentValue);
		$this->AddUrl = $file_uploads_subcons->AddUrl();
		$this->EditUrl = $file_uploads_subcons->EditUrl();
		$this->CopyUrl = $file_uploads_subcons->CopyUrl();
		$this->DeleteUrl = $file_uploads_subcons->DeleteUrl();
		$this->ListUrl = $file_uploads_subcons->ListUrl();

		// Call Row_Rendering event
		$file_uploads_subcons->Row_Rendering();

		// Common render codes for all row types
		// id

		$file_uploads_subcons->id->CellCssStyle = ""; $file_uploads_subcons->id->CellCssClass = "";
		$file_uploads_subcons->id->CellAttrs = array(); $file_uploads_subcons->id->ViewAttrs = array(); $file_uploads_subcons->id->EditAttrs = array();

		// Subcon_ID
		$file_uploads_subcons->Subcon_ID->CellCssStyle = ""; $file_uploads_subcons->Subcon_ID->CellCssClass = "";
		$file_uploads_subcons->Subcon_ID->CellAttrs = array(); $file_uploads_subcons->Subcon_ID->ViewAttrs = array(); $file_uploads_subcons->Subcon_ID->EditAttrs = array();

		// Filename
		$file_uploads_subcons->Filename->CellCssStyle = ""; $file_uploads_subcons->Filename->CellCssClass = "";
		$file_uploads_subcons->Filename->CellAttrs = array(); $file_uploads_subcons->Filename->ViewAttrs = array(); $file_uploads_subcons->Filename->EditAttrs = array();

		// File_Type_ID
		$file_uploads_subcons->File_Type_ID->CellCssStyle = ""; $file_uploads_subcons->File_Type_ID->CellCssClass = "";
		$file_uploads_subcons->File_Type_ID->CellAttrs = array(); $file_uploads_subcons->File_Type_ID->ViewAttrs = array(); $file_uploads_subcons->File_Type_ID->EditAttrs = array();

		// Created
		$file_uploads_subcons->Created->CellCssStyle = ""; $file_uploads_subcons->Created->CellCssClass = "";
		$file_uploads_subcons->Created->CellAttrs = array(); $file_uploads_subcons->Created->ViewAttrs = array(); $file_uploads_subcons->Created->EditAttrs = array();

		// Modified
		$file_uploads_subcons->Modified->CellCssStyle = ""; $file_uploads_subcons->Modified->CellCssClass = "";
		$file_uploads_subcons->Modified->CellAttrs = array(); $file_uploads_subcons->Modified->ViewAttrs = array(); $file_uploads_subcons->Modified->EditAttrs = array();

		// Remarks
		$file_uploads_subcons->Remarks->CellCssStyle = ""; $file_uploads_subcons->Remarks->CellCssClass = "";
		$file_uploads_subcons->Remarks->CellAttrs = array(); $file_uploads_subcons->Remarks->ViewAttrs = array(); $file_uploads_subcons->Remarks->EditAttrs = array();
		if ($file_uploads_subcons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_uploads_subcons->id->ViewValue = $file_uploads_subcons->id->CurrentValue;
			$file_uploads_subcons->id->CssStyle = "";
			$file_uploads_subcons->id->CssClass = "";
			$file_uploads_subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($file_uploads_subcons->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads_subcons->Subcon_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads_subcons->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$file_uploads_subcons->Subcon_ID->ViewValue = $file_uploads_subcons->Subcon_ID->CurrentValue;
				}
			} else {
				$file_uploads_subcons->Subcon_ID->ViewValue = NULL;
			}
			$file_uploads_subcons->Subcon_ID->CssStyle = "";
			$file_uploads_subcons->Subcon_ID->CssClass = "";
			$file_uploads_subcons->Subcon_ID->ViewCustomAttributes = "";

			// Filename
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->ViewValue = $file_uploads_subcons->Filename->Upload->DbValue;
			} else {
				$file_uploads_subcons->Filename->ViewValue = "";
			}
			$file_uploads_subcons->Filename->CssStyle = "";
			$file_uploads_subcons->Filename->CssClass = "";
			$file_uploads_subcons->Filename->ViewCustomAttributes = "";

			// File_Type_ID
			if (strval($file_uploads_subcons->File_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads_subcons->File_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `File_Type` FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads_subcons->File_Type_ID->ViewValue = $rswrk->fields('File_Type');
					$rswrk->Close();
				} else {
					$file_uploads_subcons->File_Type_ID->ViewValue = $file_uploads_subcons->File_Type_ID->CurrentValue;
				}
			} else {
				$file_uploads_subcons->File_Type_ID->ViewValue = NULL;
			}
			$file_uploads_subcons->File_Type_ID->CssStyle = "";
			$file_uploads_subcons->File_Type_ID->CssClass = "";
			$file_uploads_subcons->File_Type_ID->ViewCustomAttributes = "";

			// Created
			$file_uploads_subcons->Created->ViewValue = $file_uploads_subcons->Created->CurrentValue;
			$file_uploads_subcons->Created->ViewValue = ew_FormatDateTime($file_uploads_subcons->Created->ViewValue, 6);
			$file_uploads_subcons->Created->CssStyle = "";
			$file_uploads_subcons->Created->CssClass = "";
			$file_uploads_subcons->Created->ViewCustomAttributes = "";

			// Modified
			$file_uploads_subcons->Modified->ViewValue = $file_uploads_subcons->Modified->CurrentValue;
			$file_uploads_subcons->Modified->ViewValue = ew_FormatDateTime($file_uploads_subcons->Modified->ViewValue, 6);
			$file_uploads_subcons->Modified->CssStyle = "";
			$file_uploads_subcons->Modified->CssClass = "";
			$file_uploads_subcons->Modified->ViewCustomAttributes = "";

			// Remarks
			$file_uploads_subcons->Remarks->ViewValue = $file_uploads_subcons->Remarks->CurrentValue;
			$file_uploads_subcons->Remarks->CssStyle = "";
			$file_uploads_subcons->Remarks->CssClass = "";
			$file_uploads_subcons->Remarks->ViewCustomAttributes = "";

			// id
			$file_uploads_subcons->id->HrefValue = "";
			$file_uploads_subcons->id->TooltipValue = "";

			// Subcon_ID
			$file_uploads_subcons->Subcon_ID->HrefValue = "";
			$file_uploads_subcons->Subcon_ID->TooltipValue = "";

			// Filename
			if (!ew_Empty($file_uploads_subcons->Filename->Upload->DbValue)) {
				$file_uploads_subcons->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads_subcons->Filename->UploadPath) . ((!empty($file_uploads_subcons->Filename->ViewValue)) ? $file_uploads_subcons->Filename->ViewValue : $file_uploads_subcons->Filename->CurrentValue);
				if ($file_uploads_subcons->Export <> "") $file_uploads_subcons->Filename->HrefValue = ew_ConvertFullUrl($file_uploads_subcons->Filename->HrefValue);
			} else {
				$file_uploads_subcons->Filename->HrefValue = "";
			}
			$file_uploads_subcons->Filename->TooltipValue = "";

			// File_Type_ID
			$file_uploads_subcons->File_Type_ID->HrefValue = "";
			$file_uploads_subcons->File_Type_ID->TooltipValue = "";

			// Created
			$file_uploads_subcons->Created->HrefValue = "";
			$file_uploads_subcons->Created->TooltipValue = "";

			// Modified
			$file_uploads_subcons->Modified->HrefValue = "";
			$file_uploads_subcons->Modified->TooltipValue = "";

			// Remarks
			$file_uploads_subcons->Remarks->HrefValue = "";
			$file_uploads_subcons->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($file_uploads_subcons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_uploads_subcons->Row_Rendered();
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
}
?>
