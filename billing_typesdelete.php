<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "billing_typesinfo.php" ?>
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
$billing_types_delete = new cbilling_types_delete();
$Page =& $billing_types_delete;

// Page init
$billing_types_delete->Page_Init();

// Page main
$billing_types_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var billing_types_delete = new ew_Page("billing_types_delete");

// page properties
billing_types_delete.PageID = "delete"; // page ID
billing_types_delete.FormID = "fbilling_typesdelete"; // form ID
var EW_PAGE_ID = billing_types_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
billing_types_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
billing_types_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
billing_types_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $billing_types_delete->LoadRecordset())
	$billing_types_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($billing_types_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$billing_types_delete->Page_Terminate("billing_typeslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $billing_types->TableCaption() ?><br><br>
<a href="<?php echo $billing_types->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$billing_types_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="billing_types">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($billing_types_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $billing_types->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $billing_types->id->FldCaption() ?></td>
		<td valign="top"><?php echo $billing_types->Billing_Types->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$billing_types_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$billing_types_delete->lRecCnt++;

	// Set row properties
	$billing_types->CssClass = "";
	$billing_types->CssStyle = "";
	$billing_types->RowAttrs = array();
	$billing_types->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$billing_types_delete->LoadRowValues($rs);

	// Render row
	$billing_types_delete->RenderRow();
?>
	<tr<?php echo $billing_types->RowAttributes() ?>>
		<td<?php echo $billing_types->id->CellAttributes() ?>>
<div<?php echo $billing_types->id->ViewAttributes() ?>><?php echo $billing_types->id->ListViewValue() ?></div></td>
		<td<?php echo $billing_types->Billing_Types->CellAttributes() ?>>
<div<?php echo $billing_types->Billing_Types->ViewAttributes() ?>><?php echo $billing_types->Billing_Types->ListViewValue() ?></div></td>
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
$billing_types_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cbilling_types_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'billing_types';

	// Page object name
	var $PageObjName = 'billing_types_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $billing_types;
		if ($billing_types->UseTokenInUrl) $PageUrl .= "t=" . $billing_types->TableVar . "&"; // Add page token
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
		global $objForm, $billing_types;
		if ($billing_types->UseTokenInUrl) {
			if ($objForm)
				return ($billing_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($billing_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbilling_types_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (billing_types)
		$GLOBALS["billing_types"] = new cbilling_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'billing_types', TRUE);

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
		global $billing_types;

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
			$this->Page_Terminate("billing_typeslist.php");
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
		global $Language, $billing_types;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$billing_types->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($billing_types->id->QueryStringValue))
				$this->Page_Terminate("billing_typeslist.php"); // Prevent SQL injection, exit
			$sKey .= $billing_types->id->QueryStringValue;
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
			$this->Page_Terminate("billing_typeslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("billing_typeslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in billing_types class, billing_typesinfo.php

		$billing_types->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$billing_types->CurrentAction = $_POST["a_delete"];
		} else {
			$billing_types->CurrentAction = "I"; // Display record
		}
		switch ($billing_types->CurrentAction) {
			case "D": // Delete
				$billing_types->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($billing_types->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $billing_types;
		$DeleteRows = TRUE;
		$sWrkFilter = $billing_types->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in billing_types class, billing_typesinfo.php

		$billing_types->CurrentFilter = $sWrkFilter;
		$sSql = $billing_types->SQL();
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
				$DeleteRows = $billing_types->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($billing_types->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($billing_types->CancelMessage <> "") {
				$this->setMessage($billing_types->CancelMessage);
				$billing_types->CancelMessage = "";
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
				$billing_types->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $billing_types;

		// Call Recordset Selecting event
		$billing_types->Recordset_Selecting($billing_types->CurrentFilter);

		// Load List page SQL
		$sSql = $billing_types->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$billing_types->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $billing_types;
		$sFilter = $billing_types->KeyFilter();

		// Call Row Selecting event
		$billing_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$billing_types->CurrentFilter = $sFilter;
		$sSql = $billing_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$billing_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $billing_types;
		$billing_types->id->setDbValue($rs->fields('id'));
		$billing_types->Billing_Types->setDbValue($rs->fields('Billing_Types'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $billing_types;

		// Initialize URLs
		// Call Row_Rendering event

		$billing_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$billing_types->id->CellCssStyle = ""; $billing_types->id->CellCssClass = "";
		$billing_types->id->CellAttrs = array(); $billing_types->id->ViewAttrs = array(); $billing_types->id->EditAttrs = array();

		// Billing_Types
		$billing_types->Billing_Types->CellCssStyle = ""; $billing_types->Billing_Types->CellCssClass = "";
		$billing_types->Billing_Types->CellAttrs = array(); $billing_types->Billing_Types->ViewAttrs = array(); $billing_types->Billing_Types->EditAttrs = array();
		if ($billing_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$billing_types->id->ViewValue = $billing_types->id->CurrentValue;
			$billing_types->id->CssStyle = "";
			$billing_types->id->CssClass = "";
			$billing_types->id->ViewCustomAttributes = "";

			// Billing_Types
			$billing_types->Billing_Types->ViewValue = $billing_types->Billing_Types->CurrentValue;
			$billing_types->Billing_Types->CssStyle = "";
			$billing_types->Billing_Types->CssClass = "";
			$billing_types->Billing_Types->ViewCustomAttributes = "";

			// id
			$billing_types->id->HrefValue = "";
			$billing_types->id->TooltipValue = "";

			// Billing_Types
			$billing_types->Billing_Types->HrefValue = "";
			$billing_types->Billing_Types->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($billing_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$billing_types->Row_Rendered();
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
