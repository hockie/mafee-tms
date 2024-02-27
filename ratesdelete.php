<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "ratesinfo.php" ?>
<?php include "clientsinfo.php" ?>
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
$rates_delete = new crates_delete();
$Page =& $rates_delete;

// Page init
$rates_delete->Page_Init();

// Page main
$rates_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var rates_delete = new ew_Page("rates_delete");

// page properties
rates_delete.PageID = "delete"; // page ID
rates_delete.FormID = "fratesdelete"; // form ID
var EW_PAGE_ID = rates_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
rates_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
rates_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
rates_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rates_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $rates_delete->LoadRecordset())
	$rates_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($rates_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$rates_delete->Page_Terminate("rateslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rates->TableCaption() ?><br><br>
<a href="<?php echo $rates->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$rates_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="rates">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($rates_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $rates->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $rates->id->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Date->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Client_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Area_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Origin_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Destination_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Distance->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Truck_Type_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Unit_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Freight_Rate->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Vat->FldCaption() ?></td>
		<td valign="top"><?php echo $rates->Wtax->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$rates_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$rates_delete->lRecCnt++;

	// Set row properties
	$rates->CssClass = "";
	$rates->CssStyle = "";
	$rates->RowAttrs = array();
	$rates->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$rates_delete->LoadRowValues($rs);

	// Render row
	$rates_delete->RenderRow();
?>
	<tr<?php echo $rates->RowAttributes() ?>>
		<td<?php echo $rates->id->CellAttributes() ?>>
<div<?php echo $rates->id->ViewAttributes() ?>><?php echo $rates->id->ListViewValue() ?></div></td>
		<td<?php echo $rates->Date->CellAttributes() ?>>
<div<?php echo $rates->Date->ViewAttributes() ?>><?php echo $rates->Date->ListViewValue() ?></div></td>
		<td<?php echo $rates->Client_ID->CellAttributes() ?>>
<div<?php echo $rates->Client_ID->ViewAttributes() ?>><?php echo $rates->Client_ID->ListViewValue() ?></div></td>
		<td<?php echo $rates->Area_ID->CellAttributes() ?>>
<div<?php echo $rates->Area_ID->ViewAttributes() ?>><?php echo $rates->Area_ID->ListViewValue() ?></div></td>
		<td<?php echo $rates->Origin_ID->CellAttributes() ?>>
<div<?php echo $rates->Origin_ID->ViewAttributes() ?>><?php echo $rates->Origin_ID->ListViewValue() ?></div></td>
		<td<?php echo $rates->Destination_ID->CellAttributes() ?>>
<div<?php echo $rates->Destination_ID->ViewAttributes() ?>><?php echo $rates->Destination_ID->ListViewValue() ?></div></td>
		<td<?php echo $rates->Distance->CellAttributes() ?>>
<div<?php echo $rates->Distance->ViewAttributes() ?>><?php echo $rates->Distance->ListViewValue() ?></div></td>
		<td<?php echo $rates->Truck_Type_ID->CellAttributes() ?>>
<div<?php echo $rates->Truck_Type_ID->ViewAttributes() ?>><?php echo $rates->Truck_Type_ID->ListViewValue() ?></div></td>
		<td<?php echo $rates->Unit_ID->CellAttributes() ?>>
<div<?php echo $rates->Unit_ID->ViewAttributes() ?>><?php echo $rates->Unit_ID->ListViewValue() ?></div></td>
		<td<?php echo $rates->Freight_Rate->CellAttributes() ?>>
<div<?php echo $rates->Freight_Rate->ViewAttributes() ?>><?php echo $rates->Freight_Rate->ListViewValue() ?></div></td>
		<td<?php echo $rates->Vat->CellAttributes() ?>>
<div<?php echo $rates->Vat->ViewAttributes() ?>><?php echo $rates->Vat->ListViewValue() ?></div></td>
		<td<?php echo $rates->Wtax->CellAttributes() ?>>
<div<?php echo $rates->Wtax->ViewAttributes() ?>><?php echo $rates->Wtax->ListViewValue() ?></div></td>
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
$rates_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class crates_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'rates';

	// Page object name
	var $PageObjName = 'rates_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rates;
		if ($rates->UseTokenInUrl) $PageUrl .= "t=" . $rates->TableVar . "&"; // Add page token
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
		global $objForm, $rates;
		if ($rates->UseTokenInUrl) {
			if ($objForm)
				return ($rates->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rates->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crates_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (rates)
		$GLOBALS["rates"] = new crates();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rates', TRUE);

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
		global $rates;

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
			$this->Page_Terminate("rateslist.php");
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
		global $Language, $rates;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$rates->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($rates->id->QueryStringValue))
				$this->Page_Terminate("rateslist.php"); // Prevent SQL injection, exit
			$sKey .= $rates->id->QueryStringValue;
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
			$this->Page_Terminate("rateslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("rateslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in rates class, ratesinfo.php

		$rates->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$rates->CurrentAction = $_POST["a_delete"];
		} else {
			$rates->CurrentAction = "I"; // Display record
		}
		switch ($rates->CurrentAction) {
			case "D": // Delete
				$rates->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($rates->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $rates;
		$DeleteRows = TRUE;
		$sWrkFilter = $rates->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in rates class, ratesinfo.php

		$rates->CurrentFilter = $sWrkFilter;
		$sSql = $rates->SQL();
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
				$DeleteRows = $rates->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($rates->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($rates->CancelMessage <> "") {
				$this->setMessage($rates->CancelMessage);
				$rates->CancelMessage = "";
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
				$rates->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $rates;

		// Call Recordset Selecting event
		$rates->Recordset_Selecting($rates->CurrentFilter);

		// Load List page SQL
		$sSql = $rates->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$rates->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rates;
		$sFilter = $rates->KeyFilter();

		// Call Row Selecting event
		$rates->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rates->CurrentFilter = $sFilter;
		$sSql = $rates->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$rates->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $rates;
		$rates->id->setDbValue($rs->fields('id'));
		$rates->Date->setDbValue($rs->fields('Date'));
		$rates->Client_ID->setDbValue($rs->fields('Client_ID'));
		$rates->Area_ID->setDbValue($rs->fields('Area_ID'));
		$rates->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$rates->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$rates->Distance->setDbValue($rs->fields('Distance'));
		$rates->Truck_Type_ID->setDbValue($rs->fields('Truck_Type_ID'));
		$rates->Unit_ID->setDbValue($rs->fields('Unit_ID'));
		$rates->Freight_Rate->setDbValue($rs->fields('Freight_Rate'));
		$rates->Vat->setDbValue($rs->fields('Vat'));
		$rates->Wtax->setDbValue($rs->fields('Wtax'));
		$rates->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rates;

		// Initialize URLs
		// Call Row_Rendering event

		$rates->Row_Rendering();

		// Common render codes for all row types
		// id

		$rates->id->CellCssStyle = ""; $rates->id->CellCssClass = "";
		$rates->id->CellAttrs = array(); $rates->id->ViewAttrs = array(); $rates->id->EditAttrs = array();

		// Date
		$rates->Date->CellCssStyle = ""; $rates->Date->CellCssClass = "";
		$rates->Date->CellAttrs = array(); $rates->Date->ViewAttrs = array(); $rates->Date->EditAttrs = array();

		// Client_ID
		$rates->Client_ID->CellCssStyle = ""; $rates->Client_ID->CellCssClass = "";
		$rates->Client_ID->CellAttrs = array(); $rates->Client_ID->ViewAttrs = array(); $rates->Client_ID->EditAttrs = array();

		// Area_ID
		$rates->Area_ID->CellCssStyle = ""; $rates->Area_ID->CellCssClass = "";
		$rates->Area_ID->CellAttrs = array(); $rates->Area_ID->ViewAttrs = array(); $rates->Area_ID->EditAttrs = array();

		// Origin_ID
		$rates->Origin_ID->CellCssStyle = ""; $rates->Origin_ID->CellCssClass = "";
		$rates->Origin_ID->CellAttrs = array(); $rates->Origin_ID->ViewAttrs = array(); $rates->Origin_ID->EditAttrs = array();

		// Destination_ID
		$rates->Destination_ID->CellCssStyle = ""; $rates->Destination_ID->CellCssClass = "";
		$rates->Destination_ID->CellAttrs = array(); $rates->Destination_ID->ViewAttrs = array(); $rates->Destination_ID->EditAttrs = array();

		// Distance
		$rates->Distance->CellCssStyle = ""; $rates->Distance->CellCssClass = "";
		$rates->Distance->CellAttrs = array(); $rates->Distance->ViewAttrs = array(); $rates->Distance->EditAttrs = array();

		// Truck_Type_ID
		$rates->Truck_Type_ID->CellCssStyle = ""; $rates->Truck_Type_ID->CellCssClass = "";
		$rates->Truck_Type_ID->CellAttrs = array(); $rates->Truck_Type_ID->ViewAttrs = array(); $rates->Truck_Type_ID->EditAttrs = array();

		// Unit_ID
		$rates->Unit_ID->CellCssStyle = ""; $rates->Unit_ID->CellCssClass = "";
		$rates->Unit_ID->CellAttrs = array(); $rates->Unit_ID->ViewAttrs = array(); $rates->Unit_ID->EditAttrs = array();

		// Freight_Rate
		$rates->Freight_Rate->CellCssStyle = ""; $rates->Freight_Rate->CellCssClass = "";
		$rates->Freight_Rate->CellAttrs = array(); $rates->Freight_Rate->ViewAttrs = array(); $rates->Freight_Rate->EditAttrs = array();

		// Vat
		$rates->Vat->CellCssStyle = ""; $rates->Vat->CellCssClass = "";
		$rates->Vat->CellAttrs = array(); $rates->Vat->ViewAttrs = array(); $rates->Vat->EditAttrs = array();

		// Wtax
		$rates->Wtax->CellCssStyle = ""; $rates->Wtax->CellCssClass = "";
		$rates->Wtax->CellAttrs = array(); $rates->Wtax->ViewAttrs = array(); $rates->Wtax->EditAttrs = array();
		if ($rates->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$rates->id->ViewValue = $rates->id->CurrentValue;
			$rates->id->CssStyle = "";
			$rates->id->CssClass = "";
			$rates->id->ViewCustomAttributes = "";

			// Date
			$rates->Date->ViewValue = $rates->Date->CurrentValue;
			$rates->Date->ViewValue = ew_FormatDateTime($rates->Date->ViewValue, 6);
			$rates->Date->CssStyle = "";
			$rates->Date->CssClass = "";
			$rates->Date->ViewCustomAttributes = "";

			// Client_ID
			if (strval($rates->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$rates->Client_ID->ViewValue = $rates->Client_ID->CurrentValue;
				}
			} else {
				$rates->Client_ID->ViewValue = NULL;
			}
			$rates->Client_ID->CssStyle = "";
			$rates->Client_ID->CssClass = "";
			$rates->Client_ID->ViewCustomAttributes = "";

			// Area_ID
			if (strval($rates->Area_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Area_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Area` FROM `areas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Area_ID->ViewValue = $rswrk->fields('Area');
					$rswrk->Close();
				} else {
					$rates->Area_ID->ViewValue = $rates->Area_ID->CurrentValue;
				}
			} else {
				$rates->Area_ID->ViewValue = NULL;
			}
			$rates->Area_ID->CssStyle = "";
			$rates->Area_ID->CssClass = "";
			$rates->Area_ID->ViewCustomAttributes = "";

			// Origin_ID
			if (strval($rates->Origin_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Origin_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Origin` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Origin_ID->ViewValue = $rswrk->fields('Origin');
					$rswrk->Close();
				} else {
					$rates->Origin_ID->ViewValue = $rates->Origin_ID->CurrentValue;
				}
			} else {
				$rates->Origin_ID->ViewValue = NULL;
			}
			$rates->Origin_ID->CssStyle = "";
			$rates->Origin_ID->CssClass = "";
			$rates->Origin_ID->ViewCustomAttributes = "";

			// Destination_ID
			if (strval($rates->Destination_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Destination_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Destination_ID->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$rates->Destination_ID->ViewValue = $rates->Destination_ID->CurrentValue;
				}
			} else {
				$rates->Destination_ID->ViewValue = NULL;
			}
			$rates->Destination_ID->CssStyle = "";
			$rates->Destination_ID->CssClass = "";
			$rates->Destination_ID->ViewCustomAttributes = "";

			// Distance
			$rates->Distance->ViewValue = $rates->Distance->CurrentValue;
			$rates->Distance->CssStyle = "";
			$rates->Distance->CssClass = "";
			$rates->Distance->ViewCustomAttributes = "";

			// Truck_Type_ID
			if (strval($rates->Truck_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Truck_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Truck_Type_ID->ViewValue = $rswrk->fields('Truck_Type');
					$rswrk->Close();
				} else {
					$rates->Truck_Type_ID->ViewValue = $rates->Truck_Type_ID->CurrentValue;
				}
			} else {
				$rates->Truck_Type_ID->ViewValue = NULL;
			}
			$rates->Truck_Type_ID->CssStyle = "";
			$rates->Truck_Type_ID->CssClass = "";
			$rates->Truck_Type_ID->ViewCustomAttributes = "";

			// Unit_ID
			if (strval($rates->Unit_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Unit_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Units` FROM `units`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Unit_ID->ViewValue = $rswrk->fields('Units');
					$rswrk->Close();
				} else {
					$rates->Unit_ID->ViewValue = $rates->Unit_ID->CurrentValue;
				}
			} else {
				$rates->Unit_ID->ViewValue = NULL;
			}
			$rates->Unit_ID->CssStyle = "";
			$rates->Unit_ID->CssClass = "";
			$rates->Unit_ID->ViewCustomAttributes = "";

			// Freight_Rate
			$rates->Freight_Rate->ViewValue = $rates->Freight_Rate->CurrentValue;
			$rates->Freight_Rate->CssStyle = "";
			$rates->Freight_Rate->CssClass = "";
			$rates->Freight_Rate->ViewCustomAttributes = "";

			// Vat
			$rates->Vat->ViewValue = $rates->Vat->CurrentValue;
			$rates->Vat->CssStyle = "";
			$rates->Vat->CssClass = "";
			$rates->Vat->ViewCustomAttributes = "";

			// Wtax
			$rates->Wtax->ViewValue = $rates->Wtax->CurrentValue;
			$rates->Wtax->CssStyle = "";
			$rates->Wtax->CssClass = "";
			$rates->Wtax->ViewCustomAttributes = "";

			// id
			$rates->id->HrefValue = "";
			$rates->id->TooltipValue = "";

			// Date
			$rates->Date->HrefValue = "";
			$rates->Date->TooltipValue = "";

			// Client_ID
			$rates->Client_ID->HrefValue = "";
			$rates->Client_ID->TooltipValue = "";

			// Area_ID
			$rates->Area_ID->HrefValue = "";
			$rates->Area_ID->TooltipValue = "";

			// Origin_ID
			$rates->Origin_ID->HrefValue = "";
			$rates->Origin_ID->TooltipValue = "";

			// Destination_ID
			$rates->Destination_ID->HrefValue = "";
			$rates->Destination_ID->TooltipValue = "";

			// Distance
			$rates->Distance->HrefValue = "";
			$rates->Distance->TooltipValue = "";

			// Truck_Type_ID
			$rates->Truck_Type_ID->HrefValue = "";
			$rates->Truck_Type_ID->TooltipValue = "";

			// Unit_ID
			$rates->Unit_ID->HrefValue = "";
			$rates->Unit_ID->TooltipValue = "";

			// Freight_Rate
			$rates->Freight_Rate->HrefValue = "";
			$rates->Freight_Rate->TooltipValue = "";

			// Vat
			$rates->Vat->HrefValue = "";
			$rates->Vat->TooltipValue = "";

			// Wtax
			$rates->Wtax->HrefValue = "";
			$rates->Wtax->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($rates->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rates->Row_Rendered();
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
