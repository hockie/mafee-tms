<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "truck_driversinfo.php" ?>
<?php include "subconsinfo.php" ?>
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
$truck_drivers_delete = new ctruck_drivers_delete();
$Page =& $truck_drivers_delete;

// Page init
$truck_drivers_delete->Page_Init();

// Page main
$truck_drivers_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var truck_drivers_delete = new ew_Page("truck_drivers_delete");

// page properties
truck_drivers_delete.PageID = "delete"; // page ID
truck_drivers_delete.FormID = "ftruck_driversdelete"; // form ID
var EW_PAGE_ID = truck_drivers_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
truck_drivers_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
truck_drivers_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
truck_drivers_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $truck_drivers_delete->LoadRecordset())
	$truck_drivers_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($truck_drivers_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$truck_drivers_delete->Page_Terminate("truck_driverslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $truck_drivers->TableCaption() ?><br><br>
<a href="<?php echo $truck_drivers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$truck_drivers_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="truck_drivers">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($truck_drivers_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $truck_drivers->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $truck_drivers->id->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->Subcon_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->Truck_Driver->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->Address->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->Contact_No->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->Email_Address->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->Driver_License_No->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->License_Expiration_Date->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->File_Upload->FldCaption() ?></td>
		<td valign="top"><?php echo $truck_drivers->Remarks->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$truck_drivers_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$truck_drivers_delete->lRecCnt++;

	// Set row properties
	$truck_drivers->CssClass = "";
	$truck_drivers->CssStyle = "";
	$truck_drivers->RowAttrs = array();
	$truck_drivers->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$truck_drivers_delete->LoadRowValues($rs);

	// Render row
	$truck_drivers_delete->RenderRow();
?>
	<tr<?php echo $truck_drivers->RowAttributes() ?>>
		<td<?php echo $truck_drivers->id->CellAttributes() ?>>
<div<?php echo $truck_drivers->id->ViewAttributes() ?>><?php echo $truck_drivers->id->ListViewValue() ?></div></td>
		<td<?php echo $truck_drivers->Subcon_ID->CellAttributes() ?>>
<div<?php echo $truck_drivers->Subcon_ID->ViewAttributes() ?>><?php echo $truck_drivers->Subcon_ID->ListViewValue() ?></div></td>
		<td<?php echo $truck_drivers->Truck_Driver->CellAttributes() ?>>
<div<?php echo $truck_drivers->Truck_Driver->ViewAttributes() ?>><?php echo $truck_drivers->Truck_Driver->ListViewValue() ?></div></td>
		<td<?php echo $truck_drivers->Address->CellAttributes() ?>>
<div<?php echo $truck_drivers->Address->ViewAttributes() ?>><?php echo $truck_drivers->Address->ListViewValue() ?></div></td>
		<td<?php echo $truck_drivers->Contact_No->CellAttributes() ?>>
<div<?php echo $truck_drivers->Contact_No->ViewAttributes() ?>><?php echo $truck_drivers->Contact_No->ListViewValue() ?></div></td>
		<td<?php echo $truck_drivers->Email_Address->CellAttributes() ?>>
<div<?php echo $truck_drivers->Email_Address->ViewAttributes() ?>><?php echo $truck_drivers->Email_Address->ListViewValue() ?></div></td>
		<td<?php echo $truck_drivers->Driver_License_No->CellAttributes() ?>>
<div<?php echo $truck_drivers->Driver_License_No->ViewAttributes() ?>><?php echo $truck_drivers->Driver_License_No->ListViewValue() ?></div></td>
		<td<?php echo $truck_drivers->License_Expiration_Date->CellAttributes() ?>>
<div<?php echo $truck_drivers->License_Expiration_Date->ViewAttributes() ?>><?php echo $truck_drivers->License_Expiration_Date->ListViewValue() ?></div></td>
		<td<?php echo $truck_drivers->File_Upload->CellAttributes() ?>>
<?php if ($truck_drivers->File_Upload->HrefValue <> "" || $truck_drivers->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($truck_drivers->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $truck_drivers->File_Upload->HrefValue ?>"><?php echo $truck_drivers->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($truck_drivers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($truck_drivers->File_Upload->Upload->DbValue)) { ?>
<?php echo $truck_drivers->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($truck_drivers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $truck_drivers->Remarks->CellAttributes() ?>>
<div<?php echo $truck_drivers->Remarks->ViewAttributes() ?>><?php echo $truck_drivers->Remarks->ListViewValue() ?></div></td>
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
$truck_drivers_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctruck_drivers_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'truck_drivers';

	// Page object name
	var $PageObjName = 'truck_drivers_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $truck_drivers;
		if ($truck_drivers->UseTokenInUrl) $PageUrl .= "t=" . $truck_drivers->TableVar . "&"; // Add page token
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
		global $objForm, $truck_drivers;
		if ($truck_drivers->UseTokenInUrl) {
			if ($objForm)
				return ($truck_drivers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($truck_drivers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctruck_drivers_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (truck_drivers)
		$GLOBALS["truck_drivers"] = new ctruck_drivers();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'truck_drivers', TRUE);

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
		global $truck_drivers;

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
			$this->Page_Terminate("truck_driverslist.php");
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
		global $Language, $truck_drivers;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$truck_drivers->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($truck_drivers->id->QueryStringValue))
				$this->Page_Terminate("truck_driverslist.php"); // Prevent SQL injection, exit
			$sKey .= $truck_drivers->id->QueryStringValue;
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
			$this->Page_Terminate("truck_driverslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("truck_driverslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in truck_drivers class, truck_driversinfo.php

		$truck_drivers->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$truck_drivers->CurrentAction = $_POST["a_delete"];
		} else {
			$truck_drivers->CurrentAction = "I"; // Display record
		}
		switch ($truck_drivers->CurrentAction) {
			case "D": // Delete
				$truck_drivers->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($truck_drivers->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $truck_drivers;
		$DeleteRows = TRUE;
		$sWrkFilter = $truck_drivers->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in truck_drivers class, truck_driversinfo.php

		$truck_drivers->CurrentFilter = $sWrkFilter;
		$sSql = $truck_drivers->SQL();
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
				$DeleteRows = $truck_drivers->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($truck_drivers->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($truck_drivers->CancelMessage <> "") {
				$this->setMessage($truck_drivers->CancelMessage);
				$truck_drivers->CancelMessage = "";
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
				$truck_drivers->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $truck_drivers;

		// Call Recordset Selecting event
		$truck_drivers->Recordset_Selecting($truck_drivers->CurrentFilter);

		// Load List page SQL
		$sSql = $truck_drivers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$truck_drivers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $truck_drivers;
		$sFilter = $truck_drivers->KeyFilter();

		// Call Row Selecting event
		$truck_drivers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$truck_drivers->CurrentFilter = $sFilter;
		$sSql = $truck_drivers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$truck_drivers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $truck_drivers;
		$truck_drivers->id->setDbValue($rs->fields('id'));
		$truck_drivers->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$truck_drivers->Truck_Driver->setDbValue($rs->fields('Truck_Driver'));
		$truck_drivers->Address->setDbValue($rs->fields('Address'));
		$truck_drivers->Contact_No->setDbValue($rs->fields('Contact_No'));
		$truck_drivers->Email_Address->setDbValue($rs->fields('Email_Address'));
		$truck_drivers->Driver_License_No->setDbValue($rs->fields('Driver_License_No'));
		$truck_drivers->License_Expiration_Date->setDbValue($rs->fields('License_Expiration_Date'));
		$truck_drivers->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$truck_drivers->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $truck_drivers;

		// Initialize URLs
		// Call Row_Rendering event

		$truck_drivers->Row_Rendering();

		// Common render codes for all row types
		// id

		$truck_drivers->id->CellCssStyle = ""; $truck_drivers->id->CellCssClass = "";
		$truck_drivers->id->CellAttrs = array(); $truck_drivers->id->ViewAttrs = array(); $truck_drivers->id->EditAttrs = array();

		// Subcon_ID
		$truck_drivers->Subcon_ID->CellCssStyle = ""; $truck_drivers->Subcon_ID->CellCssClass = "";
		$truck_drivers->Subcon_ID->CellAttrs = array(); $truck_drivers->Subcon_ID->ViewAttrs = array(); $truck_drivers->Subcon_ID->EditAttrs = array();

		// Truck_Driver
		$truck_drivers->Truck_Driver->CellCssStyle = ""; $truck_drivers->Truck_Driver->CellCssClass = "";
		$truck_drivers->Truck_Driver->CellAttrs = array(); $truck_drivers->Truck_Driver->ViewAttrs = array(); $truck_drivers->Truck_Driver->EditAttrs = array();

		// Address
		$truck_drivers->Address->CellCssStyle = ""; $truck_drivers->Address->CellCssClass = "";
		$truck_drivers->Address->CellAttrs = array(); $truck_drivers->Address->ViewAttrs = array(); $truck_drivers->Address->EditAttrs = array();

		// Contact_No
		$truck_drivers->Contact_No->CellCssStyle = ""; $truck_drivers->Contact_No->CellCssClass = "";
		$truck_drivers->Contact_No->CellAttrs = array(); $truck_drivers->Contact_No->ViewAttrs = array(); $truck_drivers->Contact_No->EditAttrs = array();

		// Email_Address
		$truck_drivers->Email_Address->CellCssStyle = ""; $truck_drivers->Email_Address->CellCssClass = "";
		$truck_drivers->Email_Address->CellAttrs = array(); $truck_drivers->Email_Address->ViewAttrs = array(); $truck_drivers->Email_Address->EditAttrs = array();

		// Driver_License_No
		$truck_drivers->Driver_License_No->CellCssStyle = ""; $truck_drivers->Driver_License_No->CellCssClass = "";
		$truck_drivers->Driver_License_No->CellAttrs = array(); $truck_drivers->Driver_License_No->ViewAttrs = array(); $truck_drivers->Driver_License_No->EditAttrs = array();

		// License_Expiration_Date
		$truck_drivers->License_Expiration_Date->CellCssStyle = ""; $truck_drivers->License_Expiration_Date->CellCssClass = "";
		$truck_drivers->License_Expiration_Date->CellAttrs = array(); $truck_drivers->License_Expiration_Date->ViewAttrs = array(); $truck_drivers->License_Expiration_Date->EditAttrs = array();

		// File_Upload
		$truck_drivers->File_Upload->CellCssStyle = ""; $truck_drivers->File_Upload->CellCssClass = "";
		$truck_drivers->File_Upload->CellAttrs = array(); $truck_drivers->File_Upload->ViewAttrs = array(); $truck_drivers->File_Upload->EditAttrs = array();

		// Remarks
		$truck_drivers->Remarks->CellCssStyle = ""; $truck_drivers->Remarks->CellCssClass = "";
		$truck_drivers->Remarks->CellAttrs = array(); $truck_drivers->Remarks->ViewAttrs = array(); $truck_drivers->Remarks->EditAttrs = array();
		if ($truck_drivers->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$truck_drivers->id->ViewValue = $truck_drivers->id->CurrentValue;
			$truck_drivers->id->CssStyle = "";
			$truck_drivers->id->CssClass = "";
			$truck_drivers->id->ViewCustomAttributes = "";

			// Subcon_ID
			if (strval($truck_drivers->Subcon_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($truck_drivers->Subcon_ID->CurrentValue) . "";
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
					$truck_drivers->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$truck_drivers->Subcon_ID->ViewValue = $truck_drivers->Subcon_ID->CurrentValue;
				}
			} else {
				$truck_drivers->Subcon_ID->ViewValue = NULL;
			}
			$truck_drivers->Subcon_ID->CssStyle = "";
			$truck_drivers->Subcon_ID->CssClass = "";
			$truck_drivers->Subcon_ID->ViewCustomAttributes = "";

			// Truck_Driver
			$truck_drivers->Truck_Driver->ViewValue = $truck_drivers->Truck_Driver->CurrentValue;
			$truck_drivers->Truck_Driver->CssStyle = "";
			$truck_drivers->Truck_Driver->CssClass = "";
			$truck_drivers->Truck_Driver->ViewCustomAttributes = "";

			// Address
			$truck_drivers->Address->ViewValue = $truck_drivers->Address->CurrentValue;
			$truck_drivers->Address->CssStyle = "";
			$truck_drivers->Address->CssClass = "";
			$truck_drivers->Address->ViewCustomAttributes = "";

			// Contact_No
			$truck_drivers->Contact_No->ViewValue = $truck_drivers->Contact_No->CurrentValue;
			$truck_drivers->Contact_No->CssStyle = "";
			$truck_drivers->Contact_No->CssClass = "";
			$truck_drivers->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$truck_drivers->Email_Address->ViewValue = $truck_drivers->Email_Address->CurrentValue;
			$truck_drivers->Email_Address->CssStyle = "";
			$truck_drivers->Email_Address->CssClass = "";
			$truck_drivers->Email_Address->ViewCustomAttributes = "";

			// Driver_License_No
			$truck_drivers->Driver_License_No->ViewValue = $truck_drivers->Driver_License_No->CurrentValue;
			$truck_drivers->Driver_License_No->CssStyle = "";
			$truck_drivers->Driver_License_No->CssClass = "";
			$truck_drivers->Driver_License_No->ViewCustomAttributes = "";

			// License_Expiration_Date
			$truck_drivers->License_Expiration_Date->ViewValue = $truck_drivers->License_Expiration_Date->CurrentValue;
			$truck_drivers->License_Expiration_Date->ViewValue = ew_FormatDateTime($truck_drivers->License_Expiration_Date->ViewValue, 6);
			$truck_drivers->License_Expiration_Date->CssStyle = "";
			$truck_drivers->License_Expiration_Date->CssClass = "";
			$truck_drivers->License_Expiration_Date->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($truck_drivers->File_Upload->Upload->DbValue)) {
				$truck_drivers->File_Upload->ViewValue = $truck_drivers->File_Upload->Upload->DbValue;
			} else {
				$truck_drivers->File_Upload->ViewValue = "";
			}
			$truck_drivers->File_Upload->CssStyle = "";
			$truck_drivers->File_Upload->CssClass = "";
			$truck_drivers->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$truck_drivers->Remarks->ViewValue = $truck_drivers->Remarks->CurrentValue;
			$truck_drivers->Remarks->CssStyle = "";
			$truck_drivers->Remarks->CssClass = "";
			$truck_drivers->Remarks->ViewCustomAttributes = "";

			// id
			$truck_drivers->id->HrefValue = "";
			$truck_drivers->id->TooltipValue = "";

			// Subcon_ID
			$truck_drivers->Subcon_ID->HrefValue = "";
			$truck_drivers->Subcon_ID->TooltipValue = "";

			// Truck_Driver
			$truck_drivers->Truck_Driver->HrefValue = "";
			$truck_drivers->Truck_Driver->TooltipValue = "";

			// Address
			$truck_drivers->Address->HrefValue = "";
			$truck_drivers->Address->TooltipValue = "";

			// Contact_No
			$truck_drivers->Contact_No->HrefValue = "";
			$truck_drivers->Contact_No->TooltipValue = "";

			// Email_Address
			$truck_drivers->Email_Address->HrefValue = "";
			$truck_drivers->Email_Address->TooltipValue = "";

			// Driver_License_No
			$truck_drivers->Driver_License_No->HrefValue = "";
			$truck_drivers->Driver_License_No->TooltipValue = "";

			// License_Expiration_Date
			$truck_drivers->License_Expiration_Date->HrefValue = "";
			$truck_drivers->License_Expiration_Date->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($truck_drivers->File_Upload->Upload->DbValue)) {
				$truck_drivers->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $truck_drivers->File_Upload->UploadPath) . ((!empty($truck_drivers->File_Upload->ViewValue)) ? $truck_drivers->File_Upload->ViewValue : $truck_drivers->File_Upload->CurrentValue);
				if ($truck_drivers->Export <> "") $truck_drivers->File_Upload->HrefValue = ew_ConvertFullUrl($truck_drivers->File_Upload->HrefValue);
			} else {
				$truck_drivers->File_Upload->HrefValue = "";
			}
			$truck_drivers->File_Upload->TooltipValue = "";

			// Remarks
			$truck_drivers->Remarks->HrefValue = "";
			$truck_drivers->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($truck_drivers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$truck_drivers->Row_Rendered();
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
