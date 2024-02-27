<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "trucksinfo.php" ?>
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
$trucks_delete = new ctrucks_delete();
$Page =& $trucks_delete;

// Page init
$trucks_delete->Page_Init();

// Page main
$trucks_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var trucks_delete = new ew_Page("trucks_delete");

// page properties
trucks_delete.PageID = "delete"; // page ID
trucks_delete.FormID = "ftrucksdelete"; // form ID
var EW_PAGE_ID = trucks_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
trucks_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
trucks_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
trucks_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trucks_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $trucks_delete->LoadRecordset())
	$trucks_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($trucks_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$trucks_delete->Page_Terminate("truckslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $trucks->TableCaption() ?><br><br>
<a href="<?php echo $trucks->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$trucks_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="trucks">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($trucks_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $trucks->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $trucks->id->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Sub_Con_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Model->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Brand->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Truck_Types_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Plate_Number->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Series->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Truck_Body_Type->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Gross_Weight->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Net_Capacity->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Inland_Marine_Insurance->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Expiration_Date->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->LTFRB_Case_No->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->LTFRB_Expiration->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->File_Upload->FldCaption() ?></td>
		<td valign="top"><?php echo $trucks->Remarks->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$trucks_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$trucks_delete->lRecCnt++;

	// Set row properties
	$trucks->CssClass = "";
	$trucks->CssStyle = "";
	$trucks->RowAttrs = array();
	$trucks->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$trucks_delete->LoadRowValues($rs);

	// Render row
	$trucks_delete->RenderRow();
?>
	<tr<?php echo $trucks->RowAttributes() ?>>
		<td<?php echo $trucks->id->CellAttributes() ?>>
<div<?php echo $trucks->id->ViewAttributes() ?>><?php echo $trucks->id->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Sub_Con_ID->CellAttributes() ?>>
<div<?php echo $trucks->Sub_Con_ID->ViewAttributes() ?>><?php echo $trucks->Sub_Con_ID->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Model->CellAttributes() ?>>
<div<?php echo $trucks->Model->ViewAttributes() ?>><?php echo $trucks->Model->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Brand->CellAttributes() ?>>
<div<?php echo $trucks->Brand->ViewAttributes() ?>><?php echo $trucks->Brand->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Truck_Types_ID->CellAttributes() ?>>
<div<?php echo $trucks->Truck_Types_ID->ViewAttributes() ?>><?php echo $trucks->Truck_Types_ID->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Plate_Number->CellAttributes() ?>>
<div<?php echo $trucks->Plate_Number->ViewAttributes() ?>><?php echo $trucks->Plate_Number->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Series->CellAttributes() ?>>
<div<?php echo $trucks->Series->ViewAttributes() ?>><?php echo $trucks->Series->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Truck_Body_Type->CellAttributes() ?>>
<div<?php echo $trucks->Truck_Body_Type->ViewAttributes() ?>><?php echo $trucks->Truck_Body_Type->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Gross_Weight->CellAttributes() ?>>
<div<?php echo $trucks->Gross_Weight->ViewAttributes() ?>><?php echo $trucks->Gross_Weight->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Net_Capacity->CellAttributes() ?>>
<div<?php echo $trucks->Net_Capacity->ViewAttributes() ?>><?php echo $trucks->Net_Capacity->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Inland_Marine_Insurance->CellAttributes() ?>>
<div<?php echo $trucks->Inland_Marine_Insurance->ViewAttributes() ?>><?php echo $trucks->Inland_Marine_Insurance->ListViewValue() ?></div></td>
		<td<?php echo $trucks->Expiration_Date->CellAttributes() ?>>
<div<?php echo $trucks->Expiration_Date->ViewAttributes() ?>><?php echo $trucks->Expiration_Date->ListViewValue() ?></div></td>
		<td<?php echo $trucks->LTFRB_Case_No->CellAttributes() ?>>
<div<?php echo $trucks->LTFRB_Case_No->ViewAttributes() ?>><?php echo $trucks->LTFRB_Case_No->ListViewValue() ?></div></td>
		<td<?php echo $trucks->LTFRB_Expiration->CellAttributes() ?>>
<div<?php echo $trucks->LTFRB_Expiration->ViewAttributes() ?>><?php echo $trucks->LTFRB_Expiration->ListViewValue() ?></div></td>
		<td<?php echo $trucks->File_Upload->CellAttributes() ?>>
<?php if ($trucks->File_Upload->HrefValue <> "" || $trucks->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $trucks->File_Upload->HrefValue ?>"><?php echo $trucks->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<?php echo $trucks->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $trucks->Remarks->CellAttributes() ?>>
<div<?php echo $trucks->Remarks->ViewAttributes() ?>><?php echo $trucks->Remarks->ListViewValue() ?></div></td>
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
$trucks_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctrucks_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'trucks';

	// Page object name
	var $PageObjName = 'trucks_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trucks;
		if ($trucks->UseTokenInUrl) $PageUrl .= "t=" . $trucks->TableVar . "&"; // Add page token
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
		global $objForm, $trucks;
		if ($trucks->UseTokenInUrl) {
			if ($objForm)
				return ($trucks->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trucks->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctrucks_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (trucks)
		$GLOBALS["trucks"] = new ctrucks();

		// Table object (subcons)
		$GLOBALS['subcons'] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trucks', TRUE);

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
		global $trucks;

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
			$this->Page_Terminate("truckslist.php");
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
		global $Language, $trucks;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$trucks->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($trucks->id->QueryStringValue))
				$this->Page_Terminate("truckslist.php"); // Prevent SQL injection, exit
			$sKey .= $trucks->id->QueryStringValue;
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
			$this->Page_Terminate("truckslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("truckslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in trucks class, trucksinfo.php

		$trucks->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$trucks->CurrentAction = $_POST["a_delete"];
		} else {
			$trucks->CurrentAction = "I"; // Display record
		}
		switch ($trucks->CurrentAction) {
			case "D": // Delete
				$trucks->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($trucks->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $trucks;
		$DeleteRows = TRUE;
		$sWrkFilter = $trucks->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in trucks class, trucksinfo.php

		$trucks->CurrentFilter = $sWrkFilter;
		$sSql = $trucks->SQL();
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
				$DeleteRows = $trucks->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($trucks->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($trucks->CancelMessage <> "") {
				$this->setMessage($trucks->CancelMessage);
				$trucks->CancelMessage = "";
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
				$trucks->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trucks;

		// Call Recordset Selecting event
		$trucks->Recordset_Selecting($trucks->CurrentFilter);

		// Load List page SQL
		$sSql = $trucks->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$trucks->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trucks;
		$sFilter = $trucks->KeyFilter();

		// Call Row Selecting event
		$trucks->Row_Selecting($sFilter);

		// Load SQL based on filter
		$trucks->CurrentFilter = $sFilter;
		$sSql = $trucks->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$trucks->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $trucks;
		$trucks->id->setDbValue($rs->fields('id'));
		$trucks->Sub_Con_ID->setDbValue($rs->fields('Sub_Con_ID'));
		$trucks->Model->setDbValue($rs->fields('Model'));
		$trucks->Brand->setDbValue($rs->fields('Brand'));
		$trucks->Truck_Types_ID->setDbValue($rs->fields('Truck_Types_ID'));
		$trucks->Plate_Number->setDbValue($rs->fields('Plate_Number'));
		$trucks->Series->setDbValue($rs->fields('Series'));
		$trucks->Truck_Body_Type->setDbValue($rs->fields('Truck_Body_Type'));
		$trucks->Gross_Weight->setDbValue($rs->fields('Gross_Weight'));
		$trucks->Net_Capacity->setDbValue($rs->fields('Net_Capacity'));
		$trucks->Inland_Marine_Insurance->setDbValue($rs->fields('Inland_Marine_Insurance'));
		$trucks->Expiration_Date->setDbValue($rs->fields('Expiration_Date'));
		$trucks->LTFRB_Case_No->setDbValue($rs->fields('LTFRB_Case_No'));
		$trucks->LTFRB_Expiration->setDbValue($rs->fields('LTFRB_Expiration'));
		$trucks->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$trucks->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $trucks;

		// Initialize URLs
		// Call Row_Rendering event

		$trucks->Row_Rendering();

		// Common render codes for all row types
		// id

		$trucks->id->CellCssStyle = ""; $trucks->id->CellCssClass = "";
		$trucks->id->CellAttrs = array(); $trucks->id->ViewAttrs = array(); $trucks->id->EditAttrs = array();

		// Sub_Con_ID
		$trucks->Sub_Con_ID->CellCssStyle = ""; $trucks->Sub_Con_ID->CellCssClass = "";
		$trucks->Sub_Con_ID->CellAttrs = array(); $trucks->Sub_Con_ID->ViewAttrs = array(); $trucks->Sub_Con_ID->EditAttrs = array();

		// Model
		$trucks->Model->CellCssStyle = ""; $trucks->Model->CellCssClass = "";
		$trucks->Model->CellAttrs = array(); $trucks->Model->ViewAttrs = array(); $trucks->Model->EditAttrs = array();

		// Brand
		$trucks->Brand->CellCssStyle = ""; $trucks->Brand->CellCssClass = "";
		$trucks->Brand->CellAttrs = array(); $trucks->Brand->ViewAttrs = array(); $trucks->Brand->EditAttrs = array();

		// Truck_Types_ID
		$trucks->Truck_Types_ID->CellCssStyle = ""; $trucks->Truck_Types_ID->CellCssClass = "";
		$trucks->Truck_Types_ID->CellAttrs = array(); $trucks->Truck_Types_ID->ViewAttrs = array(); $trucks->Truck_Types_ID->EditAttrs = array();

		// Plate_Number
		$trucks->Plate_Number->CellCssStyle = ""; $trucks->Plate_Number->CellCssClass = "";
		$trucks->Plate_Number->CellAttrs = array(); $trucks->Plate_Number->ViewAttrs = array(); $trucks->Plate_Number->EditAttrs = array();

		// Series
		$trucks->Series->CellCssStyle = ""; $trucks->Series->CellCssClass = "";
		$trucks->Series->CellAttrs = array(); $trucks->Series->ViewAttrs = array(); $trucks->Series->EditAttrs = array();

		// Truck_Body_Type
		$trucks->Truck_Body_Type->CellCssStyle = ""; $trucks->Truck_Body_Type->CellCssClass = "";
		$trucks->Truck_Body_Type->CellAttrs = array(); $trucks->Truck_Body_Type->ViewAttrs = array(); $trucks->Truck_Body_Type->EditAttrs = array();

		// Gross_Weight
		$trucks->Gross_Weight->CellCssStyle = ""; $trucks->Gross_Weight->CellCssClass = "";
		$trucks->Gross_Weight->CellAttrs = array(); $trucks->Gross_Weight->ViewAttrs = array(); $trucks->Gross_Weight->EditAttrs = array();

		// Net_Capacity
		$trucks->Net_Capacity->CellCssStyle = ""; $trucks->Net_Capacity->CellCssClass = "";
		$trucks->Net_Capacity->CellAttrs = array(); $trucks->Net_Capacity->ViewAttrs = array(); $trucks->Net_Capacity->EditAttrs = array();

		// Inland_Marine_Insurance
		$trucks->Inland_Marine_Insurance->CellCssStyle = ""; $trucks->Inland_Marine_Insurance->CellCssClass = "";
		$trucks->Inland_Marine_Insurance->CellAttrs = array(); $trucks->Inland_Marine_Insurance->ViewAttrs = array(); $trucks->Inland_Marine_Insurance->EditAttrs = array();

		// Expiration_Date
		$trucks->Expiration_Date->CellCssStyle = ""; $trucks->Expiration_Date->CellCssClass = "";
		$trucks->Expiration_Date->CellAttrs = array(); $trucks->Expiration_Date->ViewAttrs = array(); $trucks->Expiration_Date->EditAttrs = array();

		// LTFRB_Case_No
		$trucks->LTFRB_Case_No->CellCssStyle = ""; $trucks->LTFRB_Case_No->CellCssClass = "";
		$trucks->LTFRB_Case_No->CellAttrs = array(); $trucks->LTFRB_Case_No->ViewAttrs = array(); $trucks->LTFRB_Case_No->EditAttrs = array();

		// LTFRB_Expiration
		$trucks->LTFRB_Expiration->CellCssStyle = ""; $trucks->LTFRB_Expiration->CellCssClass = "";
		$trucks->LTFRB_Expiration->CellAttrs = array(); $trucks->LTFRB_Expiration->ViewAttrs = array(); $trucks->LTFRB_Expiration->EditAttrs = array();

		// File_Upload
		$trucks->File_Upload->CellCssStyle = ""; $trucks->File_Upload->CellCssClass = "";
		$trucks->File_Upload->CellAttrs = array(); $trucks->File_Upload->ViewAttrs = array(); $trucks->File_Upload->EditAttrs = array();

		// Remarks
		$trucks->Remarks->CellCssStyle = ""; $trucks->Remarks->CellCssClass = "";
		$trucks->Remarks->CellAttrs = array(); $trucks->Remarks->ViewAttrs = array(); $trucks->Remarks->EditAttrs = array();
		if ($trucks->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$trucks->id->ViewValue = $trucks->id->CurrentValue;
			$trucks->id->CssStyle = "";
			$trucks->id->CssClass = "";
			$trucks->id->ViewCustomAttributes = "";

			// Sub_Con_ID
			if (strval($trucks->Sub_Con_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Sub_Con_ID->CurrentValue) . "";
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
					$trucks->Sub_Con_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$trucks->Sub_Con_ID->ViewValue = $trucks->Sub_Con_ID->CurrentValue;
				}
			} else {
				$trucks->Sub_Con_ID->ViewValue = NULL;
			}
			$trucks->Sub_Con_ID->CssStyle = "";
			$trucks->Sub_Con_ID->CssClass = "";
			$trucks->Sub_Con_ID->ViewCustomAttributes = "";

			// Model
			$trucks->Model->ViewValue = $trucks->Model->CurrentValue;
			$trucks->Model->CssStyle = "";
			$trucks->Model->CssClass = "";
			$trucks->Model->ViewCustomAttributes = "";

			// Brand
			$trucks->Brand->ViewValue = $trucks->Brand->CurrentValue;
			$trucks->Brand->CssStyle = "";
			$trucks->Brand->CssClass = "";
			$trucks->Brand->ViewCustomAttributes = "";

			// Truck_Types_ID
			if (strval($trucks->Truck_Types_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($trucks->Truck_Types_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Truck_Type` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$trucks->Truck_Types_ID->ViewValue = $rswrk->fields('Truck_Type');
					$rswrk->Close();
				} else {
					$trucks->Truck_Types_ID->ViewValue = $trucks->Truck_Types_ID->CurrentValue;
				}
			} else {
				$trucks->Truck_Types_ID->ViewValue = NULL;
			}
			$trucks->Truck_Types_ID->CssStyle = "";
			$trucks->Truck_Types_ID->CssClass = "";
			$trucks->Truck_Types_ID->ViewCustomAttributes = "";

			// Plate_Number
			$trucks->Plate_Number->ViewValue = $trucks->Plate_Number->CurrentValue;
			$trucks->Plate_Number->CssStyle = "";
			$trucks->Plate_Number->CssClass = "";
			$trucks->Plate_Number->ViewCustomAttributes = "";

			// Series
			$trucks->Series->ViewValue = $trucks->Series->CurrentValue;
			$trucks->Series->CssStyle = "";
			$trucks->Series->CssClass = "";
			$trucks->Series->ViewCustomAttributes = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->ViewValue = $trucks->Truck_Body_Type->CurrentValue;
			$trucks->Truck_Body_Type->CssStyle = "";
			$trucks->Truck_Body_Type->CssClass = "";
			$trucks->Truck_Body_Type->ViewCustomAttributes = "";

			// Gross_Weight
			$trucks->Gross_Weight->ViewValue = $trucks->Gross_Weight->CurrentValue;
			$trucks->Gross_Weight->ViewValue = ew_FormatNumber($trucks->Gross_Weight->ViewValue, 0, -2, -2, -2);
			$trucks->Gross_Weight->CssStyle = "";
			$trucks->Gross_Weight->CssClass = "";
			$trucks->Gross_Weight->ViewCustomAttributes = "";

			// Net_Capacity
			$trucks->Net_Capacity->ViewValue = $trucks->Net_Capacity->CurrentValue;
			$trucks->Net_Capacity->ViewValue = ew_FormatNumber($trucks->Net_Capacity->ViewValue, 0, -2, -2, -2);
			$trucks->Net_Capacity->CssStyle = "";
			$trucks->Net_Capacity->CssClass = "";
			$trucks->Net_Capacity->ViewCustomAttributes = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->ViewValue = $trucks->Inland_Marine_Insurance->CurrentValue;
			$trucks->Inland_Marine_Insurance->CssStyle = "";
			$trucks->Inland_Marine_Insurance->CssClass = "";
			$trucks->Inland_Marine_Insurance->ViewCustomAttributes = "";

			// Expiration_Date
			$trucks->Expiration_Date->ViewValue = $trucks->Expiration_Date->CurrentValue;
			$trucks->Expiration_Date->ViewValue = ew_FormatDateTime($trucks->Expiration_Date->ViewValue, 6);
			$trucks->Expiration_Date->CssStyle = "";
			$trucks->Expiration_Date->CssClass = "";
			$trucks->Expiration_Date->ViewCustomAttributes = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->ViewValue = $trucks->LTFRB_Case_No->CurrentValue;
			$trucks->LTFRB_Case_No->CssStyle = "";
			$trucks->LTFRB_Case_No->CssClass = "";
			$trucks->LTFRB_Case_No->ViewCustomAttributes = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->ViewValue = $trucks->LTFRB_Expiration->CurrentValue;
			$trucks->LTFRB_Expiration->ViewValue = ew_FormatDateTime($trucks->LTFRB_Expiration->ViewValue, 6);
			$trucks->LTFRB_Expiration->CssStyle = "";
			$trucks->LTFRB_Expiration->CssClass = "";
			$trucks->LTFRB_Expiration->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->ViewValue = $trucks->File_Upload->Upload->DbValue;
			} else {
				$trucks->File_Upload->ViewValue = "";
			}
			$trucks->File_Upload->CssStyle = "";
			$trucks->File_Upload->CssClass = "";
			$trucks->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$trucks->Remarks->ViewValue = $trucks->Remarks->CurrentValue;
			$trucks->Remarks->CssStyle = "";
			$trucks->Remarks->CssClass = "";
			$trucks->Remarks->ViewCustomAttributes = "";

			// id
			$trucks->id->HrefValue = "";
			$trucks->id->TooltipValue = "";

			// Sub_Con_ID
			$trucks->Sub_Con_ID->HrefValue = "";
			$trucks->Sub_Con_ID->TooltipValue = "";

			// Model
			$trucks->Model->HrefValue = "";
			$trucks->Model->TooltipValue = "";

			// Brand
			$trucks->Brand->HrefValue = "";
			$trucks->Brand->TooltipValue = "";

			// Truck_Types_ID
			$trucks->Truck_Types_ID->HrefValue = "";
			$trucks->Truck_Types_ID->TooltipValue = "";

			// Plate_Number
			$trucks->Plate_Number->HrefValue = "";
			$trucks->Plate_Number->TooltipValue = "";

			// Series
			$trucks->Series->HrefValue = "";
			$trucks->Series->TooltipValue = "";

			// Truck_Body_Type
			$trucks->Truck_Body_Type->HrefValue = "";
			$trucks->Truck_Body_Type->TooltipValue = "";

			// Gross_Weight
			$trucks->Gross_Weight->HrefValue = "";
			$trucks->Gross_Weight->TooltipValue = "";

			// Net_Capacity
			$trucks->Net_Capacity->HrefValue = "";
			$trucks->Net_Capacity->TooltipValue = "";

			// Inland_Marine_Insurance
			$trucks->Inland_Marine_Insurance->HrefValue = "";
			$trucks->Inland_Marine_Insurance->TooltipValue = "";

			// Expiration_Date
			$trucks->Expiration_Date->HrefValue = "";
			$trucks->Expiration_Date->TooltipValue = "";

			// LTFRB_Case_No
			$trucks->LTFRB_Case_No->HrefValue = "";
			$trucks->LTFRB_Case_No->TooltipValue = "";

			// LTFRB_Expiration
			$trucks->LTFRB_Expiration->HrefValue = "";
			$trucks->LTFRB_Expiration->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($trucks->File_Upload->Upload->DbValue)) {
				$trucks->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $trucks->File_Upload->UploadPath) . ((!empty($trucks->File_Upload->ViewValue)) ? $trucks->File_Upload->ViewValue : $trucks->File_Upload->CurrentValue);
				if ($trucks->Export <> "") $trucks->File_Upload->HrefValue = ew_ConvertFullUrl($trucks->File_Upload->HrefValue);
			} else {
				$trucks->File_Upload->HrefValue = "";
			}
			$trucks->File_Upload->TooltipValue = "";

			// Remarks
			$trucks->Remarks->HrefValue = "";
			$trucks->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($trucks->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$trucks->Row_Rendered();
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
