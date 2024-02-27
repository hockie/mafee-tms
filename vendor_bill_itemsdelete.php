<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "vendor_bill_itemsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "vendor_billinfo.php" ?>
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
$vendor_bill_items_delete = new cvendor_bill_items_delete();
$Page =& $vendor_bill_items_delete;

// Page init
$vendor_bill_items_delete->Page_Init();

// Page main
$vendor_bill_items_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var vendor_bill_items_delete = new ew_Page("vendor_bill_items_delete");

// page properties
vendor_bill_items_delete.PageID = "delete"; // page ID
vendor_bill_items_delete.FormID = "fvendor_bill_itemsdelete"; // form ID
var EW_PAGE_ID = vendor_bill_items_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
vendor_bill_items_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
vendor_bill_items_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
vendor_bill_items_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
vendor_bill_items_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $vendor_bill_items_delete->LoadRecordset())
	$vendor_bill_items_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($vendor_bill_items_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$vendor_bill_items_delete->Page_Terminate("vendor_bill_itemslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $vendor_bill_items->TableCaption() ?><br><br>
<a href="<?php echo $vendor_bill_items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$vendor_bill_items_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="vendor_bill_items">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($vendor_bill_items_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $vendor_bill_items->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $vendor_bill_items->id->FldCaption() ?></td>
		<td valign="top"><?php echo $vendor_bill_items->vendor_bill_id->FldCaption() ?></td>
		<td valign="top"><?php echo $vendor_bill_items->vendor_id->FldCaption() ?></td>
		<td valign="top"><?php echo $vendor_bill_items->booking_id->FldCaption() ?></td>
		<td valign="top"><?php echo $vendor_bill_items->remarks->FldCaption() ?></td>
		<td valign="top"><?php echo $vendor_bill_items->user_id->FldCaption() ?></td>
		<td valign="top"><?php echo $vendor_bill_items->created->FldCaption() ?></td>
		<td valign="top"><?php echo $vendor_bill_items->modified->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$vendor_bill_items_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$vendor_bill_items_delete->lRecCnt++;

	// Set row properties
	$vendor_bill_items->CssClass = "";
	$vendor_bill_items->CssStyle = "";
	$vendor_bill_items->RowAttrs = array();
	$vendor_bill_items->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$vendor_bill_items_delete->LoadRowValues($rs);

	// Render row
	$vendor_bill_items_delete->RenderRow();
?>
	<tr<?php echo $vendor_bill_items->RowAttributes() ?>>
		<td<?php echo $vendor_bill_items->id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->id->ViewAttributes() ?>><?php echo $vendor_bill_items->id->ListViewValue() ?></div></td>
		<td<?php echo $vendor_bill_items->vendor_bill_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->vendor_bill_id->ViewAttributes() ?>><?php echo $vendor_bill_items->vendor_bill_id->ListViewValue() ?></div></td>
		<td<?php echo $vendor_bill_items->vendor_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->vendor_id->ViewAttributes() ?>><?php echo $vendor_bill_items->vendor_id->ListViewValue() ?></div></td>
		<td<?php echo $vendor_bill_items->booking_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->booking_id->ViewAttributes() ?>>
<?php if ($vendor_bill_items->booking_id->HrefValue <> "" || $vendor_bill_items->booking_id->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_id=<?php echo $vendor_bill_items->booking_id->HrefValue ?>"><?php echo $vendor_bill_items->booking_id->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $vendor_bill_items->booking_id->ListViewValue() ?>
<?php } ?>
</div></td>
		<td<?php echo $vendor_bill_items->remarks->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->remarks->ViewAttributes() ?>><?php echo $vendor_bill_items->remarks->ListViewValue() ?></div></td>
		<td<?php echo $vendor_bill_items->user_id->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->user_id->ViewAttributes() ?>><?php echo $vendor_bill_items->user_id->ListViewValue() ?></div></td>
		<td<?php echo $vendor_bill_items->created->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->created->ViewAttributes() ?>><?php echo $vendor_bill_items->created->ListViewValue() ?></div></td>
		<td<?php echo $vendor_bill_items->modified->CellAttributes() ?>>
<div<?php echo $vendor_bill_items->modified->ViewAttributes() ?>><?php echo $vendor_bill_items->modified->ListViewValue() ?></div></td>
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
$vendor_bill_items_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cvendor_bill_items_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'vendor_bill_items';

	// Page object name
	var $PageObjName = 'vendor_bill_items_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $vendor_bill_items;
		if ($vendor_bill_items->UseTokenInUrl) $PageUrl .= "t=" . $vendor_bill_items->TableVar . "&"; // Add page token
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
		global $objForm, $vendor_bill_items;
		if ($vendor_bill_items->UseTokenInUrl) {
			if ($objForm)
				return ($vendor_bill_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($vendor_bill_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cvendor_bill_items_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (vendor_bill_items)
		$GLOBALS["vendor_bill_items"] = new cvendor_bill_items();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (vendor_bill)
		$GLOBALS['vendor_bill'] = new cvendor_bill();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'vendor_bill_items', TRUE);

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
		global $vendor_bill_items;

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
			$this->Page_Terminate("vendor_bill_itemslist.php");
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
		global $Language, $vendor_bill_items;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$vendor_bill_items->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($vendor_bill_items->id->QueryStringValue))
				$this->Page_Terminate("vendor_bill_itemslist.php"); // Prevent SQL injection, exit
			$sKey .= $vendor_bill_items->id->QueryStringValue;
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
			$this->Page_Terminate("vendor_bill_itemslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("vendor_bill_itemslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in vendor_bill_items class, vendor_bill_itemsinfo.php

		$vendor_bill_items->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$vendor_bill_items->CurrentAction = $_POST["a_delete"];
		} else {
			$vendor_bill_items->CurrentAction = "I"; // Display record
		}
		switch ($vendor_bill_items->CurrentAction) {
			case "D": // Delete
				$vendor_bill_items->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($vendor_bill_items->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $vendor_bill_items;
		$DeleteRows = TRUE;
		$sWrkFilter = $vendor_bill_items->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in vendor_bill_items class, vendor_bill_itemsinfo.php

		$vendor_bill_items->CurrentFilter = $sWrkFilter;
		$sSql = $vendor_bill_items->SQL();
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
				$DeleteRows = $vendor_bill_items->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($vendor_bill_items->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($vendor_bill_items->CancelMessage <> "") {
				$this->setMessage($vendor_bill_items->CancelMessage);
				$vendor_bill_items->CancelMessage = "";
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
				$vendor_bill_items->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $vendor_bill_items;

		// Call Recordset Selecting event
		$vendor_bill_items->Recordset_Selecting($vendor_bill_items->CurrentFilter);

		// Load List page SQL
		$sSql = $vendor_bill_items->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$vendor_bill_items->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $vendor_bill_items;
		$sFilter = $vendor_bill_items->KeyFilter();

		// Call Row Selecting event
		$vendor_bill_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$vendor_bill_items->CurrentFilter = $sFilter;
		$sSql = $vendor_bill_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$vendor_bill_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $vendor_bill_items;
		$vendor_bill_items->id->setDbValue($rs->fields('id'));
		$vendor_bill_items->vendor_bill_id->setDbValue($rs->fields('vendor_bill_id'));
		$vendor_bill_items->vendor_id->setDbValue($rs->fields('vendor_id'));
		$vendor_bill_items->booking_id->setDbValue($rs->fields('booking_id'));
		$vendor_bill_items->remarks->setDbValue($rs->fields('remarks'));
		$vendor_bill_items->user_id->setDbValue($rs->fields('user_id'));
		$vendor_bill_items->created->setDbValue($rs->fields('created'));
		$vendor_bill_items->modified->setDbValue($rs->fields('modified'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $vendor_bill_items;

		// Initialize URLs
		// Call Row_Rendering event

		$vendor_bill_items->Row_Rendering();

		// Common render codes for all row types
		// id

		$vendor_bill_items->id->CellCssStyle = ""; $vendor_bill_items->id->CellCssClass = "";
		$vendor_bill_items->id->CellAttrs = array(); $vendor_bill_items->id->ViewAttrs = array(); $vendor_bill_items->id->EditAttrs = array();

		// vendor_bill_id
		$vendor_bill_items->vendor_bill_id->CellCssStyle = ""; $vendor_bill_items->vendor_bill_id->CellCssClass = "";
		$vendor_bill_items->vendor_bill_id->CellAttrs = array(); $vendor_bill_items->vendor_bill_id->ViewAttrs = array(); $vendor_bill_items->vendor_bill_id->EditAttrs = array();

		// vendor_id
		$vendor_bill_items->vendor_id->CellCssStyle = ""; $vendor_bill_items->vendor_id->CellCssClass = "";
		$vendor_bill_items->vendor_id->CellAttrs = array(); $vendor_bill_items->vendor_id->ViewAttrs = array(); $vendor_bill_items->vendor_id->EditAttrs = array();

		// booking_id
		$vendor_bill_items->booking_id->CellCssStyle = ""; $vendor_bill_items->booking_id->CellCssClass = "";
		$vendor_bill_items->booking_id->CellAttrs = array(); $vendor_bill_items->booking_id->ViewAttrs = array(); $vendor_bill_items->booking_id->EditAttrs = array();

		// remarks
		$vendor_bill_items->remarks->CellCssStyle = ""; $vendor_bill_items->remarks->CellCssClass = "";
		$vendor_bill_items->remarks->CellAttrs = array(); $vendor_bill_items->remarks->ViewAttrs = array(); $vendor_bill_items->remarks->EditAttrs = array();

		// user_id
		$vendor_bill_items->user_id->CellCssStyle = ""; $vendor_bill_items->user_id->CellCssClass = "";
		$vendor_bill_items->user_id->CellAttrs = array(); $vendor_bill_items->user_id->ViewAttrs = array(); $vendor_bill_items->user_id->EditAttrs = array();

		// created
		$vendor_bill_items->created->CellCssStyle = ""; $vendor_bill_items->created->CellCssClass = "";
		$vendor_bill_items->created->CellAttrs = array(); $vendor_bill_items->created->ViewAttrs = array(); $vendor_bill_items->created->EditAttrs = array();

		// modified
		$vendor_bill_items->modified->CellCssStyle = ""; $vendor_bill_items->modified->CellCssClass = "";
		$vendor_bill_items->modified->CellAttrs = array(); $vendor_bill_items->modified->ViewAttrs = array(); $vendor_bill_items->modified->EditAttrs = array();
		if ($vendor_bill_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$vendor_bill_items->id->ViewValue = $vendor_bill_items->id->CurrentValue;
			$vendor_bill_items->id->CssStyle = "";
			$vendor_bill_items->id->CssClass = "";
			$vendor_bill_items->id->ViewCustomAttributes = "";

			// vendor_bill_id
			if (strval($vendor_bill_items->vendor_bill_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_bill_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `vendor_Number` FROM `vendor_bill`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `vendor_Number`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->vendor_bill_id->ViewValue = $rswrk->fields('vendor_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_bill_id->ViewValue = $vendor_bill_items->vendor_bill_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_bill_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_bill_id->CssStyle = "";
			$vendor_bill_items->vendor_bill_id->CssClass = "";
			$vendor_bill_items->vendor_bill_id->ViewCustomAttributes = "";

			// vendor_id
			if (strval($vendor_bill_items->vendor_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->vendor_id->CurrentValue) . "";
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
					$vendor_bill_items->vendor_id->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$vendor_bill_items->vendor_id->ViewValue = $vendor_bill_items->vendor_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->vendor_id->ViewValue = NULL;
			}
			$vendor_bill_items->vendor_id->CssStyle = "";
			$vendor_bill_items->vendor_id->CssClass = "";
			$vendor_bill_items->vendor_id->ViewCustomAttributes = "";

			// booking_id
			if (strval($vendor_bill_items->booking_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($vendor_bill_items->booking_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Subcon_ID`=" . $vendor_bill_items->vendor_id->CurrentValue . " AND `billing_type_id`=" . 8 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$vendor_bill_items->booking_id->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$vendor_bill_items->booking_id->ViewValue = $vendor_bill_items->booking_id->CurrentValue;
				}
			} else {
				$vendor_bill_items->booking_id->ViewValue = NULL;
			}
			$vendor_bill_items->booking_id->CssStyle = "";
			$vendor_bill_items->booking_id->CssClass = "";
			$vendor_bill_items->booking_id->ViewCustomAttributes = "";

			// remarks
			$vendor_bill_items->remarks->ViewValue = $vendor_bill_items->remarks->CurrentValue;
			$vendor_bill_items->remarks->CssStyle = "";
			$vendor_bill_items->remarks->CssClass = "";
			$vendor_bill_items->remarks->ViewCustomAttributes = "";

			// user_id
			$vendor_bill_items->user_id->ViewValue = $vendor_bill_items->user_id->CurrentValue;
			$vendor_bill_items->user_id->CssStyle = "";
			$vendor_bill_items->user_id->CssClass = "";
			$vendor_bill_items->user_id->ViewCustomAttributes = "";

			// created
			$vendor_bill_items->created->ViewValue = $vendor_bill_items->created->CurrentValue;
			$vendor_bill_items->created->ViewValue = ew_FormatDateTime($vendor_bill_items->created->ViewValue, 6);
			$vendor_bill_items->created->CssStyle = "";
			$vendor_bill_items->created->CssClass = "";
			$vendor_bill_items->created->ViewCustomAttributes = "";

			// modified
			$vendor_bill_items->modified->ViewValue = $vendor_bill_items->modified->CurrentValue;
			$vendor_bill_items->modified->ViewValue = ew_FormatDateTime($vendor_bill_items->modified->ViewValue, 6);
			$vendor_bill_items->modified->CssStyle = "";
			$vendor_bill_items->modified->CssClass = "";
			$vendor_bill_items->modified->ViewCustomAttributes = "";

			// id
			$vendor_bill_items->id->HrefValue = "";
			$vendor_bill_items->id->TooltipValue = "";

			// vendor_bill_id
			$vendor_bill_items->vendor_bill_id->HrefValue = "";
			$vendor_bill_items->vendor_bill_id->TooltipValue = "";

			// vendor_id
			$vendor_bill_items->vendor_id->HrefValue = "";
			$vendor_bill_items->vendor_id->TooltipValue = "";

			// booking_id
			if (!ew_Empty($vendor_bill_items->booking_id->CurrentValue)) {
				$vendor_bill_items->booking_id->HrefValue = $vendor_bill_items->booking_id->CurrentValue;
				if ($vendor_bill_items->Export <> "") $vendor_bill_items->booking_id->HrefValue = ew_ConvertFullUrl($vendor_bill_items->booking_id->HrefValue);
			} else {
				$vendor_bill_items->booking_id->HrefValue = "";
			}
			$vendor_bill_items->booking_id->TooltipValue = "";

			// remarks
			$vendor_bill_items->remarks->HrefValue = "";
			$vendor_bill_items->remarks->TooltipValue = "";

			// user_id
			$vendor_bill_items->user_id->HrefValue = "";
			$vendor_bill_items->user_id->TooltipValue = "";

			// created
			$vendor_bill_items->created->HrefValue = "";
			$vendor_bill_items->created->TooltipValue = "";

			// modified
			$vendor_bill_items->modified->HrefValue = "";
			$vendor_bill_items->modified->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($vendor_bill_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$vendor_bill_items->Row_Rendered();
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
