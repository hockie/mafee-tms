<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "originsinfo.php" ?>
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
$origins_delete = new corigins_delete();
$Page =& $origins_delete;

// Page init
$origins_delete->Page_Init();

// Page main
$origins_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var origins_delete = new ew_Page("origins_delete");

// page properties
origins_delete.PageID = "delete"; // page ID
origins_delete.FormID = "foriginsdelete"; // form ID
var EW_PAGE_ID = origins_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
origins_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
origins_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
origins_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
origins_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $origins_delete->LoadRecordset())
	$origins_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($origins_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$origins_delete->Page_Terminate("originslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $origins->TableCaption() ?><br><br>
<a href="<?php echo $origins->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$origins_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="origins">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($origins_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $origins->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $origins->id->FldCaption() ?></td>
		<td valign="top"><?php echo $origins->Client->FldCaption() ?></td>
		<td valign="top"><?php echo $origins->Origin->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$origins_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$origins_delete->lRecCnt++;

	// Set row properties
	$origins->CssClass = "";
	$origins->CssStyle = "";
	$origins->RowAttrs = array();
	$origins->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$origins_delete->LoadRowValues($rs);

	// Render row
	$origins_delete->RenderRow();
?>
	<tr<?php echo $origins->RowAttributes() ?>>
		<td<?php echo $origins->id->CellAttributes() ?>>
<div<?php echo $origins->id->ViewAttributes() ?>><?php echo $origins->id->ListViewValue() ?></div></td>
		<td<?php echo $origins->Client->CellAttributes() ?>>
<div<?php echo $origins->Client->ViewAttributes() ?>><?php echo $origins->Client->ListViewValue() ?></div></td>
		<td<?php echo $origins->Origin->CellAttributes() ?>>
<div<?php echo $origins->Origin->ViewAttributes() ?>><?php echo $origins->Origin->ListViewValue() ?></div></td>
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
$origins_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class corigins_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'origins';

	// Page object name
	var $PageObjName = 'origins_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $origins;
		if ($origins->UseTokenInUrl) $PageUrl .= "t=" . $origins->TableVar . "&"; // Add page token
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
		global $objForm, $origins;
		if ($origins->UseTokenInUrl) {
			if ($objForm)
				return ($origins->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($origins->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function corigins_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (origins)
		$GLOBALS["origins"] = new corigins();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'origins', TRUE);

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
		global $origins;

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
			$this->Page_Terminate("originslist.php");
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
		global $Language, $origins;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$origins->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($origins->id->QueryStringValue))
				$this->Page_Terminate("originslist.php"); // Prevent SQL injection, exit
			$sKey .= $origins->id->QueryStringValue;
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
			$this->Page_Terminate("originslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("originslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in origins class, originsinfo.php

		$origins->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$origins->CurrentAction = $_POST["a_delete"];
		} else {
			$origins->CurrentAction = "I"; // Display record
		}
		switch ($origins->CurrentAction) {
			case "D": // Delete
				$origins->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($origins->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $origins;
		$DeleteRows = TRUE;
		$sWrkFilter = $origins->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in origins class, originsinfo.php

		$origins->CurrentFilter = $sWrkFilter;
		$sSql = $origins->SQL();
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
				$DeleteRows = $origins->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($origins->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($origins->CancelMessage <> "") {
				$this->setMessage($origins->CancelMessage);
				$origins->CancelMessage = "";
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
				$origins->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $origins;

		// Call Recordset Selecting event
		$origins->Recordset_Selecting($origins->CurrentFilter);

		// Load List page SQL
		$sSql = $origins->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$origins->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $origins;
		$sFilter = $origins->KeyFilter();

		// Call Row Selecting event
		$origins->Row_Selecting($sFilter);

		// Load SQL based on filter
		$origins->CurrentFilter = $sFilter;
		$sSql = $origins->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$origins->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $origins;
		$origins->id->setDbValue($rs->fields('id'));
		$origins->Client->setDbValue($rs->fields('Client'));
		$origins->Origin->setDbValue($rs->fields('Origin'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $origins;

		// Initialize URLs
		// Call Row_Rendering event

		$origins->Row_Rendering();

		// Common render codes for all row types
		// id

		$origins->id->CellCssStyle = ""; $origins->id->CellCssClass = "";
		$origins->id->CellAttrs = array(); $origins->id->ViewAttrs = array(); $origins->id->EditAttrs = array();

		// Client
		$origins->Client->CellCssStyle = ""; $origins->Client->CellCssClass = "";
		$origins->Client->CellAttrs = array(); $origins->Client->ViewAttrs = array(); $origins->Client->EditAttrs = array();

		// Origin
		$origins->Origin->CellCssStyle = ""; $origins->Origin->CellCssClass = "";
		$origins->Origin->CellAttrs = array(); $origins->Origin->ViewAttrs = array(); $origins->Origin->EditAttrs = array();
		if ($origins->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$origins->id->ViewValue = $origins->id->CurrentValue;
			$origins->id->CssStyle = "";
			$origins->id->CssClass = "";
			$origins->id->ViewCustomAttributes = "";

			// Client
			if (strval($origins->Client->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($origins->Client->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$origins->Client->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$origins->Client->ViewValue = $origins->Client->CurrentValue;
				}
			} else {
				$origins->Client->ViewValue = NULL;
			}
			$origins->Client->CssStyle = "";
			$origins->Client->CssClass = "";
			$origins->Client->ViewCustomAttributes = "";

			// Origin
			$origins->Origin->ViewValue = $origins->Origin->CurrentValue;
			$origins->Origin->CssStyle = "";
			$origins->Origin->CssClass = "";
			$origins->Origin->ViewCustomAttributes = "";

			// id
			$origins->id->HrefValue = "";
			$origins->id->TooltipValue = "";

			// Client
			$origins->Client->HrefValue = "";
			$origins->Client->TooltipValue = "";

			// Origin
			$origins->Origin->HrefValue = "";
			$origins->Origin->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($origins->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$origins->Row_Rendered();
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
