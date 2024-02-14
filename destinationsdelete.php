<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "destinationsinfo.php" ?>
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
$destinations_delete = new cdestinations_delete();
$Page =& $destinations_delete;

// Page init
$destinations_delete->Page_Init();

// Page main
$destinations_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var destinations_delete = new ew_Page("destinations_delete");

// page properties
destinations_delete.PageID = "delete"; // page ID
destinations_delete.FormID = "fdestinationsdelete"; // form ID
var EW_PAGE_ID = destinations_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
destinations_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
destinations_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
destinations_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
destinations_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $destinations_delete->LoadRecordset())
	$destinations_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($destinations_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$destinations_delete->Page_Terminate("destinationslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $destinations->TableCaption() ?><br><br>
<a href="<?php echo $destinations->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$destinations_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="destinations">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($destinations_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $destinations->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $destinations->id->FldCaption() ?></td>
		<td valign="top"><?php echo $destinations->Destination->FldCaption() ?></td>
		<td valign="top"><?php echo $destinations->Client->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$destinations_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$destinations_delete->lRecCnt++;

	// Set row properties
	$destinations->CssClass = "";
	$destinations->CssStyle = "";
	$destinations->RowAttrs = array();
	$destinations->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$destinations_delete->LoadRowValues($rs);

	// Render row
	$destinations_delete->RenderRow();
?>
	<tr<?php echo $destinations->RowAttributes() ?>>
		<td<?php echo $destinations->id->CellAttributes() ?>>
<div<?php echo $destinations->id->ViewAttributes() ?>><?php echo $destinations->id->ListViewValue() ?></div></td>
		<td<?php echo $destinations->Destination->CellAttributes() ?>>
<div<?php echo $destinations->Destination->ViewAttributes() ?>><?php echo $destinations->Destination->ListViewValue() ?></div></td>
		<td<?php echo $destinations->Client->CellAttributes() ?>>
<div<?php echo $destinations->Client->ViewAttributes() ?>><?php echo $destinations->Client->ListViewValue() ?></div></td>
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
$destinations_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cdestinations_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'destinations';

	// Page object name
	var $PageObjName = 'destinations_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $destinations;
		if ($destinations->UseTokenInUrl) $PageUrl .= "t=" . $destinations->TableVar . "&"; // Add page token
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
		global $objForm, $destinations;
		if ($destinations->UseTokenInUrl) {
			if ($objForm)
				return ($destinations->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($destinations->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdestinations_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (destinations)
		$GLOBALS["destinations"] = new cdestinations();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'destinations', TRUE);

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
		global $destinations;

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
			$this->Page_Terminate("destinationslist.php");
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
		global $Language, $destinations;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$destinations->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($destinations->id->QueryStringValue))
				$this->Page_Terminate("destinationslist.php"); // Prevent SQL injection, exit
			$sKey .= $destinations->id->QueryStringValue;
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
			$this->Page_Terminate("destinationslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("destinationslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in destinations class, destinationsinfo.php

		$destinations->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$destinations->CurrentAction = $_POST["a_delete"];
		} else {
			$destinations->CurrentAction = "I"; // Display record
		}
		switch ($destinations->CurrentAction) {
			case "D": // Delete
				$destinations->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($destinations->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $destinations;
		$DeleteRows = TRUE;
		$sWrkFilter = $destinations->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in destinations class, destinationsinfo.php

		$destinations->CurrentFilter = $sWrkFilter;
		$sSql = $destinations->SQL();
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
				$DeleteRows = $destinations->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($destinations->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($destinations->CancelMessage <> "") {
				$this->setMessage($destinations->CancelMessage);
				$destinations->CancelMessage = "";
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
				$destinations->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $destinations;

		// Call Recordset Selecting event
		$destinations->Recordset_Selecting($destinations->CurrentFilter);

		// Load List page SQL
		$sSql = $destinations->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$destinations->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $destinations;
		$sFilter = $destinations->KeyFilter();

		// Call Row Selecting event
		$destinations->Row_Selecting($sFilter);

		// Load SQL based on filter
		$destinations->CurrentFilter = $sFilter;
		$sSql = $destinations->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$destinations->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $destinations;
		$destinations->id->setDbValue($rs->fields('id'));
		$destinations->Destination->setDbValue($rs->fields('Destination'));
		$destinations->Client->setDbValue($rs->fields('Client'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $destinations;

		// Initialize URLs
		// Call Row_Rendering event

		$destinations->Row_Rendering();

		// Common render codes for all row types
		// id

		$destinations->id->CellCssStyle = ""; $destinations->id->CellCssClass = "";
		$destinations->id->CellAttrs = array(); $destinations->id->ViewAttrs = array(); $destinations->id->EditAttrs = array();

		// Destination
		$destinations->Destination->CellCssStyle = ""; $destinations->Destination->CellCssClass = "";
		$destinations->Destination->CellAttrs = array(); $destinations->Destination->ViewAttrs = array(); $destinations->Destination->EditAttrs = array();

		// Client
		$destinations->Client->CellCssStyle = ""; $destinations->Client->CellCssClass = "";
		$destinations->Client->CellAttrs = array(); $destinations->Client->ViewAttrs = array(); $destinations->Client->EditAttrs = array();
		if ($destinations->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$destinations->id->ViewValue = $destinations->id->CurrentValue;
			$destinations->id->CssStyle = "";
			$destinations->id->CssClass = "";
			$destinations->id->ViewCustomAttributes = "";

			// Destination
			$destinations->Destination->ViewValue = $destinations->Destination->CurrentValue;
			$destinations->Destination->CssStyle = "";
			$destinations->Destination->CssClass = "";
			$destinations->Destination->ViewCustomAttributes = "";

			// Client
			if (strval($destinations->Client->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($destinations->Client->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$destinations->Client->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$destinations->Client->ViewValue = $destinations->Client->CurrentValue;
				}
			} else {
				$destinations->Client->ViewValue = NULL;
			}
			$destinations->Client->CssStyle = "";
			$destinations->Client->CssClass = "";
			$destinations->Client->ViewCustomAttributes = "";

			// id
			$destinations->id->HrefValue = "";
			$destinations->id->TooltipValue = "";

			// Destination
			$destinations->Destination->HrefValue = "";
			$destinations->Destination->TooltipValue = "";

			// Client
			$destinations->Client->HrefValue = "";
			$destinations->Client->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($destinations->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$destinations->Row_Rendered();
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
