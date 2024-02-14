<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "userlevelpermissionsinfo.php" ?>
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
$userlevelpermissions_delete = new cuserlevelpermissions_delete();
$Page =& $userlevelpermissions_delete;

// Page init
$userlevelpermissions_delete->Page_Init();

// Page main
$userlevelpermissions_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var userlevelpermissions_delete = new ew_Page("userlevelpermissions_delete");

// page properties
userlevelpermissions_delete.PageID = "delete"; // page ID
userlevelpermissions_delete.FormID = "fuserlevelpermissionsdelete"; // form ID
var EW_PAGE_ID = userlevelpermissions_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
userlevelpermissions_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userlevelpermissions_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userlevelpermissions_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $userlevelpermissions_delete->LoadRecordset())
	$userlevelpermissions_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($userlevelpermissions_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$userlevelpermissions_delete->Page_Terminate("userlevelpermissionslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $userlevelpermissions->TableCaption() ?><br><br>
<a href="<?php echo $userlevelpermissions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userlevelpermissions_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="userlevelpermissions">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($userlevelpermissions_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $userlevelpermissions->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $userlevelpermissions->userlevelid->FldCaption() ?></td>
		<td valign="top"><?php echo $userlevelpermissions->ztablename->FldCaption() ?></td>
		<td valign="top"><?php echo $userlevelpermissions->permission->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$userlevelpermissions_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$userlevelpermissions_delete->lRecCnt++;

	// Set row properties
	$userlevelpermissions->CssClass = "";
	$userlevelpermissions->CssStyle = "";
	$userlevelpermissions->RowAttrs = array();
	$userlevelpermissions->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$userlevelpermissions_delete->LoadRowValues($rs);

	// Render row
	$userlevelpermissions_delete->RenderRow();
?>
	<tr<?php echo $userlevelpermissions->RowAttributes() ?>>
		<td<?php echo $userlevelpermissions->userlevelid->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->userlevelid->ViewAttributes() ?>><?php echo $userlevelpermissions->userlevelid->ListViewValue() ?></div></td>
		<td<?php echo $userlevelpermissions->ztablename->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->ztablename->ViewAttributes() ?>><?php echo $userlevelpermissions->ztablename->ListViewValue() ?></div></td>
		<td<?php echo $userlevelpermissions->permission->CellAttributes() ?>>
<div<?php echo $userlevelpermissions->permission->ViewAttributes() ?>><?php echo $userlevelpermissions->permission->ListViewValue() ?></div></td>
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
$userlevelpermissions_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserlevelpermissions_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'userlevelpermissions';

	// Page object name
	var $PageObjName = 'userlevelpermissions_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) $PageUrl .= "t=" . $userlevelpermissions->TableVar . "&"; // Add page token
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
		global $objForm, $userlevelpermissions;
		if ($userlevelpermissions->UseTokenInUrl) {
			if ($objForm)
				return ($userlevelpermissions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($userlevelpermissions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuserlevelpermissions_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (userlevelpermissions)
		$GLOBALS["userlevelpermissions"] = new cuserlevelpermissions();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'userlevelpermissions', TRUE);

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
		global $userlevelpermissions;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $Language, $userlevelpermissions;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["userlevelid"] <> "") {
			$userlevelpermissions->userlevelid->setQueryStringValue($_GET["userlevelid"]);
			if (!is_numeric($userlevelpermissions->userlevelid->QueryStringValue))
				$this->Page_Terminate("userlevelpermissionslist.php"); // Prevent SQL injection, exit
			$sKey .= $userlevelpermissions->userlevelid->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if (@$_GET["ztablename"] <> "") {
			$userlevelpermissions->ztablename->setQueryStringValue($_GET["ztablename"]);
			if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sKey .= $userlevelpermissions->ztablename->QueryStringValue;
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
			$this->Page_Terminate("userlevelpermissionslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";
			$arKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, trim($sKey)); // Split key by separator
			if (count($arKeyFlds) <> 2)
				$this->Page_Terminate($userlevelpermissions->getReturnUrl()); // Invalid key, exit

			// Set up key field
			$sKeyFld = $arKeyFlds[0];
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("userlevelpermissionslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`userlevelid`=" . ew_AdjustSql($sKeyFld) . " AND ";

			// Set up key field
			$sKeyFld = $arKeyFlds[1];
			$sFilter .= "`tablename`='" . ew_AdjustSql($sKeyFld) . "' AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in userlevelpermissions class, userlevelpermissionsinfo.php

		$userlevelpermissions->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$userlevelpermissions->CurrentAction = $_POST["a_delete"];
		} else {
			$userlevelpermissions->CurrentAction = "I"; // Display record
		}
		switch ($userlevelpermissions->CurrentAction) {
			case "D": // Delete
				$userlevelpermissions->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($userlevelpermissions->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $userlevelpermissions;
		$DeleteRows = TRUE;
		$sWrkFilter = $userlevelpermissions->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in userlevelpermissions class, userlevelpermissionsinfo.php

		$userlevelpermissions->CurrentFilter = $sWrkFilter;
		$sSql = $userlevelpermissions->SQL();
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
				$DeleteRows = $userlevelpermissions->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['userlevelid'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['tablename'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($userlevelpermissions->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($userlevelpermissions->CancelMessage <> "") {
				$this->setMessage($userlevelpermissions->CancelMessage);
				$userlevelpermissions->CancelMessage = "";
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
				$userlevelpermissions->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $userlevelpermissions;

		// Call Recordset Selecting event
		$userlevelpermissions->Recordset_Selecting($userlevelpermissions->CurrentFilter);

		// Load List page SQL
		$sSql = $userlevelpermissions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$userlevelpermissions->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $userlevelpermissions;
		$sFilter = $userlevelpermissions->KeyFilter();

		// Call Row Selecting event
		$userlevelpermissions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$userlevelpermissions->CurrentFilter = $sFilter;
		$sSql = $userlevelpermissions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$userlevelpermissions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $userlevelpermissions;
		$userlevelpermissions->userlevelid->setDbValue($rs->fields('userlevelid'));
		$userlevelpermissions->ztablename->setDbValue($rs->fields('tablename'));
		$userlevelpermissions->permission->setDbValue($rs->fields('permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $userlevelpermissions;

		// Initialize URLs
		// Call Row_Rendering event

		$userlevelpermissions->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$userlevelpermissions->userlevelid->CellCssStyle = ""; $userlevelpermissions->userlevelid->CellCssClass = "";
		$userlevelpermissions->userlevelid->CellAttrs = array(); $userlevelpermissions->userlevelid->ViewAttrs = array(); $userlevelpermissions->userlevelid->EditAttrs = array();

		// tablename
		$userlevelpermissions->ztablename->CellCssStyle = ""; $userlevelpermissions->ztablename->CellCssClass = "";
		$userlevelpermissions->ztablename->CellAttrs = array(); $userlevelpermissions->ztablename->ViewAttrs = array(); $userlevelpermissions->ztablename->EditAttrs = array();

		// permission
		$userlevelpermissions->permission->CellCssStyle = ""; $userlevelpermissions->permission->CellCssClass = "";
		$userlevelpermissions->permission->CellAttrs = array(); $userlevelpermissions->permission->ViewAttrs = array(); $userlevelpermissions->permission->EditAttrs = array();
		if ($userlevelpermissions->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$userlevelpermissions->userlevelid->ViewValue = $userlevelpermissions->userlevelid->CurrentValue;
			$userlevelpermissions->userlevelid->CssStyle = "";
			$userlevelpermissions->userlevelid->CssClass = "";
			$userlevelpermissions->userlevelid->ViewCustomAttributes = "";

			// tablename
			$userlevelpermissions->ztablename->ViewValue = $userlevelpermissions->ztablename->CurrentValue;
			$userlevelpermissions->ztablename->CssStyle = "";
			$userlevelpermissions->ztablename->CssClass = "";
			$userlevelpermissions->ztablename->ViewCustomAttributes = "";

			// permission
			$userlevelpermissions->permission->ViewValue = $userlevelpermissions->permission->CurrentValue;
			$userlevelpermissions->permission->CssStyle = "";
			$userlevelpermissions->permission->CssClass = "";
			$userlevelpermissions->permission->ViewCustomAttributes = "";

			// userlevelid
			$userlevelpermissions->userlevelid->HrefValue = "";
			$userlevelpermissions->userlevelid->TooltipValue = "";

			// tablename
			$userlevelpermissions->ztablename->HrefValue = "";
			$userlevelpermissions->ztablename->TooltipValue = "";

			// permission
			$userlevelpermissions->permission->HrefValue = "";
			$userlevelpermissions->permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($userlevelpermissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$userlevelpermissions->Row_Rendered();
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
