<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "all_file_uploadsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "account_paymentsinfo.php" ?>
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
$all_file_uploads_delete = new call_file_uploads_delete();
$Page =& $all_file_uploads_delete;

// Page init
$all_file_uploads_delete->Page_Init();

// Page main
$all_file_uploads_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var all_file_uploads_delete = new ew_Page("all_file_uploads_delete");

// page properties
all_file_uploads_delete.PageID = "delete"; // page ID
all_file_uploads_delete.FormID = "fall_file_uploadsdelete"; // form ID
var EW_PAGE_ID = all_file_uploads_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
all_file_uploads_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
all_file_uploads_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
all_file_uploads_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
all_file_uploads_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $all_file_uploads_delete->LoadRecordset())
	$all_file_uploads_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($all_file_uploads_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$all_file_uploads_delete->Page_Terminate("all_file_uploadslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $all_file_uploads->TableCaption() ?><br><br>
<a href="<?php echo $all_file_uploads->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$all_file_uploads_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="all_file_uploads">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($all_file_uploads_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $all_file_uploads->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $all_file_uploads->id->FldCaption() ?></td>
		<td valign="top"><?php echo $all_file_uploads->module->FldCaption() ?></td>
		<td valign="top"><?php echo $all_file_uploads->File_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $all_file_uploads->Remarks->FldCaption() ?></td>
		<td valign="top"><?php echo $all_file_uploads->Created->FldCaption() ?></td>
		<td valign="top"><?php echo $all_file_uploads->Modified->FldCaption() ?></td>
		<td valign="top"><?php echo $all_file_uploads->user_id->FldCaption() ?></td>
		<td valign="top"><?php echo $all_file_uploads->file_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$all_file_uploads_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$all_file_uploads_delete->lRecCnt++;

	// Set row properties
	$all_file_uploads->CssClass = "";
	$all_file_uploads->CssStyle = "";
	$all_file_uploads->RowAttrs = array();
	$all_file_uploads->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$all_file_uploads_delete->LoadRowValues($rs);

	// Render row
	$all_file_uploads_delete->RenderRow();
?>
	<tr<?php echo $all_file_uploads->RowAttributes() ?>>
		<td<?php echo $all_file_uploads->id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->id->ViewAttributes() ?>><?php echo $all_file_uploads->id->ListViewValue() ?></div></td>
		<td<?php echo $all_file_uploads->module->CellAttributes() ?>>
<div<?php echo $all_file_uploads->module->ViewAttributes() ?>><?php echo $all_file_uploads->module->ListViewValue() ?></div></td>
		<td<?php echo $all_file_uploads->File_Name->CellAttributes() ?>>
<?php if ($all_file_uploads->File_Name->HrefValue <> "" || $all_file_uploads->File_Name->TooltipValue <> "") { ?>
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<a href="<?php echo $all_file_uploads->File_Name->HrefValue ?>"><?php echo $all_file_uploads->File_Name->ListViewValue() ?></a>
<?php } elseif (!in_array($all_file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($all_file_uploads->File_Name->Upload->DbValue)) { ?>
<?php echo $all_file_uploads->File_Name->ListViewValue() ?>
<?php } elseif (!in_array($all_file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $all_file_uploads->Remarks->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Remarks->ViewAttributes() ?>><?php echo $all_file_uploads->Remarks->ListViewValue() ?></div></td>
		<td<?php echo $all_file_uploads->Created->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Created->ViewAttributes() ?>><?php echo $all_file_uploads->Created->ListViewValue() ?></div></td>
		<td<?php echo $all_file_uploads->Modified->CellAttributes() ?>>
<div<?php echo $all_file_uploads->Modified->ViewAttributes() ?>><?php echo $all_file_uploads->Modified->ListViewValue() ?></div></td>
		<td<?php echo $all_file_uploads->user_id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->user_id->ViewAttributes() ?>><?php echo $all_file_uploads->user_id->ListViewValue() ?></div></td>
		<td<?php echo $all_file_uploads->file_id->CellAttributes() ?>>
<div<?php echo $all_file_uploads->file_id->ViewAttributes() ?>><?php echo $all_file_uploads->file_id->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$all_file_uploads_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class call_file_uploads_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'all_file_uploads';

	// Page object name
	var $PageObjName = 'all_file_uploads_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $all_file_uploads;
		if ($all_file_uploads->UseTokenInUrl) $PageUrl .= "t=" . $all_file_uploads->TableVar . "&"; // Add page token
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
		global $objForm, $all_file_uploads;
		if ($all_file_uploads->UseTokenInUrl) {
			if ($objForm)
				return ($all_file_uploads->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($all_file_uploads->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function call_file_uploads_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (all_file_uploads)
		$GLOBALS["all_file_uploads"] = new call_file_uploads();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'all_file_uploads', TRUE);

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
		global $all_file_uploads;

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
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("all_file_uploadslist.php");
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $all_file_uploads;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$all_file_uploads->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($all_file_uploads->id->QueryStringValue))
				$this->Page_Terminate("all_file_uploadslist.php"); // Prevent SQL injection, exit
			$sKey .= $all_file_uploads->id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("all_file_uploadslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("all_file_uploadslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in all_file_uploads class, all_file_uploadsinfo.php

		$all_file_uploads->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$all_file_uploads->CurrentAction = $_POST["a_delete"];
		} else {
			$all_file_uploads->CurrentAction = "I"; // Display record
		}
		switch ($all_file_uploads->CurrentAction) {
			case "D": // Delete
				$all_file_uploads->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($all_file_uploads->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $all_file_uploads;
		$DeleteRows = TRUE;
		$sWrkFilter = $all_file_uploads->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in all_file_uploads class, all_file_uploadsinfo.php

		$all_file_uploads->CurrentFilter = $sWrkFilter;
		$sSql = $all_file_uploads->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $all_file_uploads->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($all_file_uploads->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($all_file_uploads->CancelMessage <> "") {
				$this->setMessage($all_file_uploads->CancelMessage);
				$all_file_uploads->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$all_file_uploads->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $all_file_uploads;

		// Call Recordset Selecting event
		$all_file_uploads->Recordset_Selecting($all_file_uploads->CurrentFilter);

		// Load List page SQL
		$sSql = $all_file_uploads->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$all_file_uploads->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $all_file_uploads;
		$sFilter = $all_file_uploads->KeyFilter();

		// Call Row Selecting event
		$all_file_uploads->Row_Selecting($sFilter);

		// Load SQL based on filter
		$all_file_uploads->CurrentFilter = $sFilter;
		$sSql = $all_file_uploads->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$all_file_uploads->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $all_file_uploads;
		$all_file_uploads->id->setDbValue($rs->fields('id'));
		$all_file_uploads->module->setDbValue($rs->fields('module'));
		$all_file_uploads->File_Name->Upload->DbValue = $rs->fields('File_Name');
		$all_file_uploads->Remarks->setDbValue($rs->fields('Remarks'));
		$all_file_uploads->Created->setDbValue($rs->fields('Created'));
		$all_file_uploads->Modified->setDbValue($rs->fields('Modified'));
		$all_file_uploads->user_id->setDbValue($rs->fields('user_id'));
		$all_file_uploads->file_id->setDbValue($rs->fields('file_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $all_file_uploads;

		// Initialize URLs
		// Call Row_Rendering event

		$all_file_uploads->Row_Rendering();

		// Common render codes for all row types
		// id

		$all_file_uploads->id->CellCssStyle = ""; $all_file_uploads->id->CellCssClass = "";
		$all_file_uploads->id->CellAttrs = array(); $all_file_uploads->id->ViewAttrs = array(); $all_file_uploads->id->EditAttrs = array();

		// module
		$all_file_uploads->module->CellCssStyle = ""; $all_file_uploads->module->CellCssClass = "";
		$all_file_uploads->module->CellAttrs = array(); $all_file_uploads->module->ViewAttrs = array(); $all_file_uploads->module->EditAttrs = array();

		// File_Name
		$all_file_uploads->File_Name->CellCssStyle = ""; $all_file_uploads->File_Name->CellCssClass = "";
		$all_file_uploads->File_Name->CellAttrs = array(); $all_file_uploads->File_Name->ViewAttrs = array(); $all_file_uploads->File_Name->EditAttrs = array();

		// Remarks
		$all_file_uploads->Remarks->CellCssStyle = ""; $all_file_uploads->Remarks->CellCssClass = "";
		$all_file_uploads->Remarks->CellAttrs = array(); $all_file_uploads->Remarks->ViewAttrs = array(); $all_file_uploads->Remarks->EditAttrs = array();

		// Created
		$all_file_uploads->Created->CellCssStyle = ""; $all_file_uploads->Created->CellCssClass = "";
		$all_file_uploads->Created->CellAttrs = array(); $all_file_uploads->Created->ViewAttrs = array(); $all_file_uploads->Created->EditAttrs = array();

		// Modified
		$all_file_uploads->Modified->CellCssStyle = ""; $all_file_uploads->Modified->CellCssClass = "";
		$all_file_uploads->Modified->CellAttrs = array(); $all_file_uploads->Modified->ViewAttrs = array(); $all_file_uploads->Modified->EditAttrs = array();

		// user_id
		$all_file_uploads->user_id->CellCssStyle = ""; $all_file_uploads->user_id->CellCssClass = "";
		$all_file_uploads->user_id->CellAttrs = array(); $all_file_uploads->user_id->ViewAttrs = array(); $all_file_uploads->user_id->EditAttrs = array();

		// file_id
		$all_file_uploads->file_id->CellCssStyle = ""; $all_file_uploads->file_id->CellCssClass = "";
		$all_file_uploads->file_id->CellAttrs = array(); $all_file_uploads->file_id->ViewAttrs = array(); $all_file_uploads->file_id->EditAttrs = array();
		if ($all_file_uploads->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$all_file_uploads->id->ViewValue = $all_file_uploads->id->CurrentValue;
			$all_file_uploads->id->CssStyle = "";
			$all_file_uploads->id->CssClass = "";
			$all_file_uploads->id->ViewCustomAttributes = "";

			// module
			$all_file_uploads->module->ViewValue = $all_file_uploads->module->CurrentValue;
			$all_file_uploads->module->CssStyle = "";
			$all_file_uploads->module->CssClass = "";
			$all_file_uploads->module->ViewCustomAttributes = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->ViewValue = $all_file_uploads->File_Name->Upload->DbValue;
			} else {
				$all_file_uploads->File_Name->ViewValue = "";
			}
			$all_file_uploads->File_Name->CssStyle = "";
			$all_file_uploads->File_Name->CssClass = "";
			$all_file_uploads->File_Name->ViewCustomAttributes = "";

			// Remarks
			$all_file_uploads->Remarks->ViewValue = $all_file_uploads->Remarks->CurrentValue;
			$all_file_uploads->Remarks->CssStyle = "";
			$all_file_uploads->Remarks->CssClass = "";
			$all_file_uploads->Remarks->ViewCustomAttributes = "";

			// Created
			$all_file_uploads->Created->ViewValue = $all_file_uploads->Created->CurrentValue;
			$all_file_uploads->Created->ViewValue = ew_FormatDateTime($all_file_uploads->Created->ViewValue, 6);
			$all_file_uploads->Created->CssStyle = "";
			$all_file_uploads->Created->CssClass = "";
			$all_file_uploads->Created->ViewCustomAttributes = "";

			// Modified
			$all_file_uploads->Modified->ViewValue = $all_file_uploads->Modified->CurrentValue;
			$all_file_uploads->Modified->ViewValue = ew_FormatDateTime($all_file_uploads->Modified->ViewValue, 6);
			$all_file_uploads->Modified->CssStyle = "";
			$all_file_uploads->Modified->CssClass = "";
			$all_file_uploads->Modified->ViewCustomAttributes = "";

			// user_id
			$all_file_uploads->user_id->ViewValue = $all_file_uploads->user_id->CurrentValue;
			$all_file_uploads->user_id->CssStyle = "";
			$all_file_uploads->user_id->CssClass = "";
			$all_file_uploads->user_id->ViewCustomAttributes = "";

			// file_id
			$all_file_uploads->file_id->ViewValue = $all_file_uploads->file_id->CurrentValue;
			$all_file_uploads->file_id->CssStyle = "";
			$all_file_uploads->file_id->CssClass = "";
			$all_file_uploads->file_id->ViewCustomAttributes = "";

			// id
			$all_file_uploads->id->HrefValue = "";
			$all_file_uploads->id->TooltipValue = "";

			// module
			$all_file_uploads->module->HrefValue = "";
			$all_file_uploads->module->TooltipValue = "";

			// File_Name
			if (!ew_Empty($all_file_uploads->File_Name->Upload->DbValue)) {
				$all_file_uploads->File_Name->HrefValue = ew_UploadPathEx(FALSE, $all_file_uploads->File_Name->UploadPath) . ((!empty($all_file_uploads->File_Name->ViewValue)) ? $all_file_uploads->File_Name->ViewValue : $all_file_uploads->File_Name->CurrentValue);
				if ($all_file_uploads->Export <> "") $all_file_uploads->File_Name->HrefValue = ew_ConvertFullUrl($all_file_uploads->File_Name->HrefValue);
			} else {
				$all_file_uploads->File_Name->HrefValue = "";
			}
			$all_file_uploads->File_Name->TooltipValue = "";

			// Remarks
			$all_file_uploads->Remarks->HrefValue = "";
			$all_file_uploads->Remarks->TooltipValue = "";

			// Created
			$all_file_uploads->Created->HrefValue = "";
			$all_file_uploads->Created->TooltipValue = "";

			// Modified
			$all_file_uploads->Modified->HrefValue = "";
			$all_file_uploads->Modified->TooltipValue = "";

			// user_id
			$all_file_uploads->user_id->HrefValue = "";
			$all_file_uploads->user_id->TooltipValue = "";

			// file_id
			$all_file_uploads->file_id->HrefValue = "";
			$all_file_uploads->file_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($all_file_uploads->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$all_file_uploads->Row_Rendered();
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
