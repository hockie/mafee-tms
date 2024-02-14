<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "truck_typesinfo.php" ?>
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
$truck_types_delete = new ctruck_types_delete();
$Page =& $truck_types_delete;

// Page init
$truck_types_delete->Page_Init();

// Page main
$truck_types_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var truck_types_delete = new ew_Page("truck_types_delete");

// page properties
truck_types_delete.PageID = "delete"; // page ID
truck_types_delete.FormID = "ftruck_typesdelete"; // form ID
var EW_PAGE_ID = truck_types_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
truck_types_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
truck_types_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
truck_types_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $truck_types_delete->LoadRecordset())
	$truck_types_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($truck_types_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$truck_types_delete->Page_Terminate("truck_typeslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $truck_types->TableCaption() ?><br><br>
<a href="<?php echo $truck_types->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$truck_types_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="truck_types">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($truck_types_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $truck_types->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $truck_types->id->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_types->Truck_Type->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$truck_types_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$truck_types_delete->lRecCnt++;

	// Set row properties
	$truck_types->CssClass = "";
	$truck_types->CssStyle = "";
	$truck_types->RowAttrs = array();
	$truck_types->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$truck_types_delete->LoadRowValues($rs);

	// Render row
	$truck_types_delete->RenderRow();
?>
	<tr<?php echo $truck_types->RowAttributes() ?>>
		<td<?php echo $truck_types->id->CellAttributes() ?>>
<div<?php echo $truck_types->id->ViewAttributes() ?>><?php echo $truck_types->id->ListViewValue() ?></div></td>
		<td<?php echo $truck_types->Truck_Type->CellAttributes() ?>>
<div<?php echo $truck_types->Truck_Type->ViewAttributes() ?>><?php echo $truck_types->Truck_Type->ListViewValue() ?></div></td>
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
$truck_types_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctruck_types_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'truck_types';

	// Page object name
	var $PageObjName = 'truck_types_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $truck_types;
		if ($truck_types->UseTokenInUrl) $PageUrl .= "t=" . $truck_types->TableVar . "&"; // Add page token
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
		global $objForm, $truck_types;
		if ($truck_types->UseTokenInUrl) {
			if ($objForm)
				return ($truck_types->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($truck_types->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctruck_types_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (truck_types)
		$GLOBALS["truck_types"] = new ctruck_types();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'truck_types', TRUE);

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
		global $truck_types;

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
			$this->Page_Terminate("truck_typeslist.php");
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
		global $Language, $truck_types;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$truck_types->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($truck_types->id->QueryStringValue))
				$this->Page_Terminate("truck_typeslist.php"); // Prevent SQL injection, exit
			$sKey .= $truck_types->id->QueryStringValue;
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
			$this->Page_Terminate("truck_typeslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("truck_typeslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in truck_types class, truck_typesinfo.php

		$truck_types->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$truck_types->CurrentAction = $_POST["a_delete"];
		} else {
			$truck_types->CurrentAction = "I"; // Display record
		}
		switch ($truck_types->CurrentAction) {
			case "D": // Delete
				$truck_types->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($truck_types->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $truck_types;
		$DeleteRows = TRUE;
		$sWrkFilter = $truck_types->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in truck_types class, truck_typesinfo.php

		$truck_types->CurrentFilter = $sWrkFilter;
		$sSql = $truck_types->SQL();
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
				$DeleteRows = $truck_types->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($truck_types->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($truck_types->CancelMessage <> "") {
				$this->setMessage($truck_types->CancelMessage);
				$truck_types->CancelMessage = "";
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
				$truck_types->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $truck_types;

		// Call Recordset Selecting event
		$truck_types->Recordset_Selecting($truck_types->CurrentFilter);

		// Load List page SQL
		$sSql = $truck_types->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$truck_types->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $truck_types;
		$sFilter = $truck_types->KeyFilter();

		// Call Row Selecting event
		$truck_types->Row_Selecting($sFilter);

		// Load SQL based on filter
		$truck_types->CurrentFilter = $sFilter;
		$sSql = $truck_types->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$truck_types->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $truck_types;
		$truck_types->id->setDbValue($rs->fields('id'));
		$truck_types->Truck_Type->setDbValue($rs->fields('Truck_Type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $truck_types;

		// Initialize URLs
		// Call Row_Rendering event

		$truck_types->Row_Rendering();

		// Common render codes for all row types
		// id

		$truck_types->id->CellCssStyle = ""; $truck_types->id->CellCssClass = "";
		$truck_types->id->CellAttrs = array(); $truck_types->id->ViewAttrs = array(); $truck_types->id->EditAttrs = array();

		// Truck_Type
		$truck_types->Truck_Type->CellCssStyle = ""; $truck_types->Truck_Type->CellCssClass = "";
		$truck_types->Truck_Type->CellAttrs = array(); $truck_types->Truck_Type->ViewAttrs = array(); $truck_types->Truck_Type->EditAttrs = array();
		if ($truck_types->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$truck_types->id->ViewValue = $truck_types->id->CurrentValue;
			$truck_types->id->CssStyle = "";
			$truck_types->id->CssClass = "";
			$truck_types->id->ViewCustomAttributes = "";

			// Truck_Type
			$truck_types->Truck_Type->ViewValue = $truck_types->Truck_Type->CurrentValue;
			$truck_types->Truck_Type->CssStyle = "";
			$truck_types->Truck_Type->CssClass = "";
			$truck_types->Truck_Type->ViewCustomAttributes = "";

			// id
			$truck_types->id->HrefValue = "";
			$truck_types->id->TooltipValue = "";

			// Truck_Type
			$truck_types->Truck_Type->HrefValue = "";
			$truck_types->Truck_Type->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($truck_types->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$truck_types->Row_Rendered();
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
