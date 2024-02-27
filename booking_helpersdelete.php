<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "booking_helpersinfo.php" ?>
<?php include "bookingsinfo.php" ?>
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
$booking_helpers_delete = new cbooking_helpers_delete();
$Page =& $booking_helpers_delete;

// Page init
$booking_helpers_delete->Page_Init();

// Page main
$booking_helpers_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var booking_helpers_delete = new ew_Page("booking_helpers_delete");

// page properties
booking_helpers_delete.PageID = "delete"; // page ID
booking_helpers_delete.FormID = "fbooking_helpersdelete"; // form ID
var EW_PAGE_ID = booking_helpers_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
booking_helpers_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
booking_helpers_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
booking_helpers_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $booking_helpers_delete->LoadRecordset())
	$booking_helpers_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($booking_helpers_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$booking_helpers_delete->Page_Terminate("booking_helperslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $booking_helpers->TableCaption() ?><br><br>
<a href="<?php echo $booking_helpers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$booking_helpers_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="booking_helpers">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($booking_helpers_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $booking_helpers->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $booking_helpers->id->FldCaption() ?></td>
		<td valign="top"><?php echo $booking_helpers->Booking_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $booking_helpers->Helper_ID->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$booking_helpers_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$booking_helpers_delete->lRecCnt++;

	// Set row properties
	$booking_helpers->CssClass = "";
	$booking_helpers->CssStyle = "";
	$booking_helpers->RowAttrs = array();
	$booking_helpers->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$booking_helpers_delete->LoadRowValues($rs);

	// Render row
	$booking_helpers_delete->RenderRow();
?>
	<tr<?php echo $booking_helpers->RowAttributes() ?>>
		<td<?php echo $booking_helpers->id->CellAttributes() ?>>
<div<?php echo $booking_helpers->id->ViewAttributes() ?>><?php echo $booking_helpers->id->ListViewValue() ?></div></td>
		<td<?php echo $booking_helpers->Booking_ID->CellAttributes() ?>>
<div<?php echo $booking_helpers->Booking_ID->ViewAttributes() ?>><?php echo $booking_helpers->Booking_ID->ListViewValue() ?></div></td>
		<td<?php echo $booking_helpers->Helper_ID->CellAttributes() ?>>
<div<?php echo $booking_helpers->Helper_ID->ViewAttributes() ?>><?php echo $booking_helpers->Helper_ID->ListViewValue() ?></div></td>
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
$booking_helpers_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cbooking_helpers_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'booking_helpers';

	// Page object name
	var $PageObjName = 'booking_helpers_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $booking_helpers;
		if ($booking_helpers->UseTokenInUrl) $PageUrl .= "t=" . $booking_helpers->TableVar . "&"; // Add page token
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
		global $objForm, $booking_helpers;
		if ($booking_helpers->UseTokenInUrl) {
			if ($objForm)
				return ($booking_helpers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($booking_helpers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbooking_helpers_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (booking_helpers)
		$GLOBALS["booking_helpers"] = new cbooking_helpers();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'booking_helpers', TRUE);

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
		global $booking_helpers;

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
			$this->Page_Terminate("booking_helperslist.php");
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
		global $Language, $booking_helpers;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$booking_helpers->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($booking_helpers->id->QueryStringValue))
				$this->Page_Terminate("booking_helperslist.php"); // Prevent SQL injection, exit
			$sKey .= $booking_helpers->id->QueryStringValue;
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
			$this->Page_Terminate("booking_helperslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("booking_helperslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in booking_helpers class, booking_helpersinfo.php

		$booking_helpers->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$booking_helpers->CurrentAction = $_POST["a_delete"];
		} else {
			$booking_helpers->CurrentAction = "I"; // Display record
		}
		switch ($booking_helpers->CurrentAction) {
			case "D": // Delete
				$booking_helpers->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($booking_helpers->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $booking_helpers;
		$DeleteRows = TRUE;
		$sWrkFilter = $booking_helpers->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in booking_helpers class, booking_helpersinfo.php

		$booking_helpers->CurrentFilter = $sWrkFilter;
		$sSql = $booking_helpers->SQL();
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
				$DeleteRows = $booking_helpers->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($booking_helpers->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($booking_helpers->CancelMessage <> "") {
				$this->setMessage($booking_helpers->CancelMessage);
				$booking_helpers->CancelMessage = "";
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
				$booking_helpers->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $booking_helpers;

		// Call Recordset Selecting event
		$booking_helpers->Recordset_Selecting($booking_helpers->CurrentFilter);

		// Load List page SQL
		$sSql = $booking_helpers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$booking_helpers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $booking_helpers;
		$sFilter = $booking_helpers->KeyFilter();

		// Call Row Selecting event
		$booking_helpers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$booking_helpers->CurrentFilter = $sFilter;
		$sSql = $booking_helpers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$booking_helpers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $booking_helpers;
		$booking_helpers->id->setDbValue($rs->fields('id'));
		$booking_helpers->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$booking_helpers->Helper_ID->setDbValue($rs->fields('Helper_ID'));
		$booking_helpers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $booking_helpers;

		// Initialize URLs
		// Call Row_Rendering event

		$booking_helpers->Row_Rendering();

		// Common render codes for all row types
		// id

		$booking_helpers->id->CellCssStyle = ""; $booking_helpers->id->CellCssClass = "";
		$booking_helpers->id->CellAttrs = array(); $booking_helpers->id->ViewAttrs = array(); $booking_helpers->id->EditAttrs = array();

		// Booking_ID
		$booking_helpers->Booking_ID->CellCssStyle = ""; $booking_helpers->Booking_ID->CellCssClass = "";
		$booking_helpers->Booking_ID->CellAttrs = array(); $booking_helpers->Booking_ID->ViewAttrs = array(); $booking_helpers->Booking_ID->EditAttrs = array();

		// Helper_ID
		$booking_helpers->Helper_ID->CellCssStyle = ""; $booking_helpers->Helper_ID->CellCssClass = "";
		$booking_helpers->Helper_ID->CellAttrs = array(); $booking_helpers->Helper_ID->ViewAttrs = array(); $booking_helpers->Helper_ID->EditAttrs = array();
		if ($booking_helpers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$booking_helpers->id->ViewValue = $booking_helpers->id->CurrentValue;
			$booking_helpers->id->CssStyle = "";
			$booking_helpers->id->CssClass = "";
			$booking_helpers->id->ViewCustomAttributes = "";

			// Booking_ID
			if (strval($booking_helpers->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$booking_helpers->Booking_ID->ViewValue = $booking_helpers->Booking_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Booking_ID->ViewValue = NULL;
			}
			$booking_helpers->Booking_ID->CssStyle = "";
			$booking_helpers->Booking_ID->CssClass = "";
			$booking_helpers->Booking_ID->ViewCustomAttributes = "";

			// Helper_ID
			if (strval($booking_helpers->Helper_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($booking_helpers->Helper_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Helper_Name` FROM `helpers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Helper_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$booking_helpers->Helper_ID->ViewValue = $rswrk->fields('Helper_Name');
					$rswrk->Close();
				} else {
					$booking_helpers->Helper_ID->ViewValue = $booking_helpers->Helper_ID->CurrentValue;
				}
			} else {
				$booking_helpers->Helper_ID->ViewValue = NULL;
			}
			$booking_helpers->Helper_ID->CssStyle = "";
			$booking_helpers->Helper_ID->CssClass = "";
			$booking_helpers->Helper_ID->ViewCustomAttributes = "";

			// id
			$booking_helpers->id->HrefValue = "";
			$booking_helpers->id->TooltipValue = "";

			// Booking_ID
			$booking_helpers->Booking_ID->HrefValue = "";
			$booking_helpers->Booking_ID->TooltipValue = "";

			// Helper_ID
			$booking_helpers->Helper_ID->HrefValue = "";
			$booking_helpers->Helper_ID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($booking_helpers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$booking_helpers->Row_Rendered();
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
