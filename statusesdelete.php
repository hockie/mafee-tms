<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "statusesinfo.php" ?>
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
$statuses_delete = new cstatuses_delete();
$Page =& $statuses_delete;

// Page init
$statuses_delete->Page_Init();

// Page main
$statuses_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var statuses_delete = new ew_Page("statuses_delete");

// page properties
statuses_delete.PageID = "delete"; // page ID
statuses_delete.FormID = "fstatusesdelete"; // form ID
var EW_PAGE_ID = statuses_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
statuses_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
statuses_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
statuses_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
statuses_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $statuses_delete->LoadRecordset())
	$statuses_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($statuses_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$statuses_delete->Page_Terminate("statuseslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $statuses->TableCaption() ?><br><br>
<a href="<?php echo $statuses->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$statuses_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="statuses">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($statuses_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $statuses->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $statuses->id->FldCaption() ?></td>
		<td valign="top"><?php echo $statuses->Status->FldCaption() ?></td>
		<td valign="top"><?php echo $statuses->Modules->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$statuses_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$statuses_delete->lRecCnt++;

	// Set row properties
	$statuses->CssClass = "";
	$statuses->CssStyle = "";
	$statuses->RowAttrs = array();
	$statuses->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$statuses_delete->LoadRowValues($rs);

	// Render row
	$statuses_delete->RenderRow();
?>
	<tr<?php echo $statuses->RowAttributes() ?>>
		<td<?php echo $statuses->id->CellAttributes() ?>>
<div<?php echo $statuses->id->ViewAttributes() ?>><?php echo $statuses->id->ListViewValue() ?></div></td>
		<td<?php echo $statuses->Status->CellAttributes() ?>>
<div<?php echo $statuses->Status->ViewAttributes() ?>><?php echo $statuses->Status->ListViewValue() ?></div></td>
		<td<?php echo $statuses->Modules->CellAttributes() ?>>
<div<?php echo $statuses->Modules->ViewAttributes() ?>><?php echo $statuses->Modules->ListViewValue() ?></div></td>
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
$statuses_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cstatuses_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'statuses';

	// Page object name
	var $PageObjName = 'statuses_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $statuses;
		if ($statuses->UseTokenInUrl) $PageUrl .= "t=" . $statuses->TableVar . "&"; // Add page token
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
		global $objForm, $statuses;
		if ($statuses->UseTokenInUrl) {
			if ($objForm)
				return ($statuses->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($statuses->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstatuses_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (statuses)
		$GLOBALS["statuses"] = new cstatuses();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'statuses', TRUE);

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
		global $statuses;

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
			$this->Page_Terminate("statuseslist.php");
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
		global $Language, $statuses;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$statuses->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($statuses->id->QueryStringValue))
				$this->Page_Terminate("statuseslist.php"); // Prevent SQL injection, exit
			$sKey .= $statuses->id->QueryStringValue;
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
			$this->Page_Terminate("statuseslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("statuseslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in statuses class, statusesinfo.php

		$statuses->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$statuses->CurrentAction = $_POST["a_delete"];
		} else {
			$statuses->CurrentAction = "I"; // Display record
		}
		switch ($statuses->CurrentAction) {
			case "D": // Delete
				$statuses->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($statuses->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $statuses;
		$DeleteRows = TRUE;
		$sWrkFilter = $statuses->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in statuses class, statusesinfo.php

		$statuses->CurrentFilter = $sWrkFilter;
		$sSql = $statuses->SQL();
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
				$DeleteRows = $statuses->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($statuses->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($statuses->CancelMessage <> "") {
				$this->setMessage($statuses->CancelMessage);
				$statuses->CancelMessage = "";
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
				$statuses->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $statuses;

		// Call Recordset Selecting event
		$statuses->Recordset_Selecting($statuses->CurrentFilter);

		// Load List page SQL
		$sSql = $statuses->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$statuses->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $statuses;
		$sFilter = $statuses->KeyFilter();

		// Call Row Selecting event
		$statuses->Row_Selecting($sFilter);

		// Load SQL based on filter
		$statuses->CurrentFilter = $sFilter;
		$sSql = $statuses->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$statuses->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $statuses;
		$statuses->id->setDbValue($rs->fields('id'));
		$statuses->Status->setDbValue($rs->fields('Status'));
		$statuses->Modules->setDbValue($rs->fields('Modules'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $statuses;

		// Initialize URLs
		// Call Row_Rendering event

		$statuses->Row_Rendering();

		// Common render codes for all row types
		// id

		$statuses->id->CellCssStyle = ""; $statuses->id->CellCssClass = "";
		$statuses->id->CellAttrs = array(); $statuses->id->ViewAttrs = array(); $statuses->id->EditAttrs = array();

		// Status
		$statuses->Status->CellCssStyle = ""; $statuses->Status->CellCssClass = "";
		$statuses->Status->CellAttrs = array(); $statuses->Status->ViewAttrs = array(); $statuses->Status->EditAttrs = array();

		// Modules
		$statuses->Modules->CellCssStyle = ""; $statuses->Modules->CellCssClass = "";
		$statuses->Modules->CellAttrs = array(); $statuses->Modules->ViewAttrs = array(); $statuses->Modules->EditAttrs = array();
		if ($statuses->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$statuses->id->ViewValue = $statuses->id->CurrentValue;
			$statuses->id->CssStyle = "";
			$statuses->id->CssClass = "";
			$statuses->id->ViewCustomAttributes = "";

			// Status
			$statuses->Status->ViewValue = $statuses->Status->CurrentValue;
			$statuses->Status->CssStyle = "";
			$statuses->Status->CssClass = "";
			$statuses->Status->ViewCustomAttributes = "";

			// Modules
			$statuses->Modules->ViewValue = $statuses->Modules->CurrentValue;
			$statuses->Modules->CssStyle = "";
			$statuses->Modules->CssClass = "";
			$statuses->Modules->ViewCustomAttributes = "";

			// id
			$statuses->id->HrefValue = "";
			$statuses->id->TooltipValue = "";

			// Status
			$statuses->Status->HrefValue = "";
			$statuses->Status->TooltipValue = "";

			// Modules
			$statuses->Modules->HrefValue = "";
			$statuses->Modules->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($statuses->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$statuses->Row_Rendered();
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
