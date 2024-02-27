<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "invoice_itemsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "invoicesinfo.php" ?>
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
$invoice_items_delete = new cinvoice_items_delete();
$Page =& $invoice_items_delete;

// Page init
$invoice_items_delete->Page_Init();

// Page main
$invoice_items_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var invoice_items_delete = new ew_Page("invoice_items_delete");

// page properties
invoice_items_delete.PageID = "delete"; // page ID
invoice_items_delete.FormID = "finvoice_itemsdelete"; // form ID
var EW_PAGE_ID = invoice_items_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
invoice_items_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
invoice_items_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
invoice_items_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
invoice_items_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $invoice_items_delete->LoadRecordset())
	$invoice_items_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($invoice_items_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$invoice_items_delete->Page_Terminate("invoice_itemslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $invoice_items->TableCaption() ?><br><br>
<a href="<?php echo $invoice_items->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$invoice_items_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="invoice_items">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($invoice_items_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $invoice_items->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $invoice_items->id->FldCaption() ?></td>
		<td valign="top"><?php echo $invoice_items->invoice_id->FldCaption() ?></td>
		<td valign="top"><?php echo $invoice_items->client_id->FldCaption() ?></td>
		<td valign="top"><?php echo $invoice_items->booking_id->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$invoice_items_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$invoice_items_delete->lRecCnt++;

	// Set row properties
	$invoice_items->CssClass = "";
	$invoice_items->CssStyle = "";
	$invoice_items->RowAttrs = array();
	$invoice_items->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$invoice_items_delete->LoadRowValues($rs);

	// Render row
	$invoice_items_delete->RenderRow();
?>
	<tr<?php echo $invoice_items->RowAttributes() ?>>
		<td<?php echo $invoice_items->id->CellAttributes() ?>>
<div<?php echo $invoice_items->id->ViewAttributes() ?>><?php echo $invoice_items->id->ListViewValue() ?></div></td>
		<td<?php echo $invoice_items->invoice_id->CellAttributes() ?>>
<div<?php echo $invoice_items->invoice_id->ViewAttributes() ?>><?php echo $invoice_items->invoice_id->ListViewValue() ?></div></td>
		<td<?php echo $invoice_items->client_id->CellAttributes() ?>>
<div<?php echo $invoice_items->client_id->ViewAttributes() ?>><?php echo $invoice_items->client_id->ListViewValue() ?></div></td>
		<td<?php echo $invoice_items->booking_id->CellAttributes() ?>>
<div<?php echo $invoice_items->booking_id->ViewAttributes() ?>>
<?php if ($invoice_items->booking_id->HrefValue <> "" || $invoice_items->booking_id->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_id=<?php echo $invoice_items->booking_id->HrefValue ?>"><?php echo $invoice_items->booking_id->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $invoice_items->booking_id->ListViewValue() ?>
<?php } ?>
</div></td>
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
$invoice_items_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cinvoice_items_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'invoice_items';

	// Page object name
	var $PageObjName = 'invoice_items_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $invoice_items;
		if ($invoice_items->UseTokenInUrl) $PageUrl .= "t=" . $invoice_items->TableVar . "&"; // Add page token
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
		global $objForm, $invoice_items;
		if ($invoice_items->UseTokenInUrl) {
			if ($objForm)
				return ($invoice_items->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($invoice_items->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cinvoice_items_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (invoice_items)
		$GLOBALS["invoice_items"] = new cinvoice_items();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (invoices)
		$GLOBALS['invoices'] = new cinvoices();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'invoice_items', TRUE);

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
		global $invoice_items;

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
			$this->Page_Terminate("invoice_itemslist.php");
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
		global $Language, $invoice_items;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$invoice_items->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($invoice_items->id->QueryStringValue))
				$this->Page_Terminate("invoice_itemslist.php"); // Prevent SQL injection, exit
			$sKey .= $invoice_items->id->QueryStringValue;
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
			$this->Page_Terminate("invoice_itemslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("invoice_itemslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in invoice_items class, invoice_itemsinfo.php

		$invoice_items->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$invoice_items->CurrentAction = $_POST["a_delete"];
		} else {
			$invoice_items->CurrentAction = "I"; // Display record
		}
		switch ($invoice_items->CurrentAction) {
			case "D": // Delete
				$invoice_items->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($invoice_items->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $invoice_items;
		$DeleteRows = TRUE;
		$sWrkFilter = $invoice_items->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in invoice_items class, invoice_itemsinfo.php

		$invoice_items->CurrentFilter = $sWrkFilter;
		$sSql = $invoice_items->SQL();
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
				$DeleteRows = $invoice_items->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($invoice_items->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($invoice_items->CancelMessage <> "") {
				$this->setMessage($invoice_items->CancelMessage);
				$invoice_items->CancelMessage = "";
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
				$invoice_items->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $invoice_items;

		// Call Recordset Selecting event
		$invoice_items->Recordset_Selecting($invoice_items->CurrentFilter);

		// Load List page SQL
		$sSql = $invoice_items->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$invoice_items->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $invoice_items;
		$sFilter = $invoice_items->KeyFilter();

		// Call Row Selecting event
		$invoice_items->Row_Selecting($sFilter);

		// Load SQL based on filter
		$invoice_items->CurrentFilter = $sFilter;
		$sSql = $invoice_items->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$invoice_items->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $invoice_items;
		$invoice_items->id->setDbValue($rs->fields('id'));
		$invoice_items->invoice_id->setDbValue($rs->fields('invoice_id'));
		$invoice_items->client_id->setDbValue($rs->fields('client_id'));
		$invoice_items->booking_id->setDbValue($rs->fields('booking_id'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $invoice_items;

		// Initialize URLs
		// Call Row_Rendering event

		$invoice_items->Row_Rendering();

		// Common render codes for all row types
		// id

		$invoice_items->id->CellCssStyle = ""; $invoice_items->id->CellCssClass = "";
		$invoice_items->id->CellAttrs = array(); $invoice_items->id->ViewAttrs = array(); $invoice_items->id->EditAttrs = array();

		// invoice_id
		$invoice_items->invoice_id->CellCssStyle = ""; $invoice_items->invoice_id->CellCssClass = "";
		$invoice_items->invoice_id->CellAttrs = array(); $invoice_items->invoice_id->ViewAttrs = array(); $invoice_items->invoice_id->EditAttrs = array();

		// client_id
		$invoice_items->client_id->CellCssStyle = ""; $invoice_items->client_id->CellCssClass = "";
		$invoice_items->client_id->CellAttrs = array(); $invoice_items->client_id->ViewAttrs = array(); $invoice_items->client_id->EditAttrs = array();

		// booking_id
		$invoice_items->booking_id->CellCssStyle = ""; $invoice_items->booking_id->CellCssClass = "";
		$invoice_items->booking_id->CellAttrs = array(); $invoice_items->booking_id->ViewAttrs = array(); $invoice_items->booking_id->EditAttrs = array();
		if ($invoice_items->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$invoice_items->id->ViewValue = $invoice_items->id->CurrentValue;
			$invoice_items->id->CssStyle = "";
			$invoice_items->id->CssClass = "";
			$invoice_items->id->ViewCustomAttributes = "";

			// invoice_id
			$invoice_items->invoice_id->ViewValue = $invoice_items->invoice_id->CurrentValue;
			$invoice_items->invoice_id->CssStyle = "";
			$invoice_items->invoice_id->CssClass = "";
			$invoice_items->invoice_id->ViewCustomAttributes = "";

			// client_id
			$invoice_items->client_id->ViewValue = $invoice_items->client_id->CurrentValue;
			$invoice_items->client_id->CssStyle = "";
			$invoice_items->client_id->CssClass = "";
			$invoice_items->client_id->ViewCustomAttributes = "";

			// booking_id
			if (strval($invoice_items->booking_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($invoice_items->booking_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "`Client_ID`=" . $invoice_items->client_id->ViewValue . " AND `Status_ID`=" . 2 . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Booking_Number` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$invoice_items->booking_id->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$invoice_items->booking_id->ViewValue = $invoice_items->booking_id->CurrentValue;
				}
			} else {
				$invoice_items->booking_id->ViewValue = NULL;
			}
			$invoice_items->booking_id->CssStyle = "";
			$invoice_items->booking_id->CssClass = "";
			$invoice_items->booking_id->ViewCustomAttributes = "";

			// id
			$invoice_items->id->HrefValue = "";
			$invoice_items->id->TooltipValue = "";

			// invoice_id
			$invoice_items->invoice_id->HrefValue = "";
			$invoice_items->invoice_id->TooltipValue = "";

			// client_id
			$invoice_items->client_id->HrefValue = "";
			$invoice_items->client_id->TooltipValue = "";

			// booking_id
			if (!ew_Empty($invoice_items->booking_id->CurrentValue)) {
				$invoice_items->booking_id->HrefValue = $invoice_items->booking_id->CurrentValue;
				if ($invoice_items->Export <> "") $invoice_items->booking_id->HrefValue = ew_ConvertFullUrl($invoice_items->booking_id->HrefValue);
			} else {
				$invoice_items->booking_id->HrefValue = "";
			}
			$invoice_items->booking_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($invoice_items->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$invoice_items->Row_Rendered();
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
