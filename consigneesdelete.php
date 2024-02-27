<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "consigneesinfo.php" ?>
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
$consignees_delete = new cconsignees_delete();
$Page =& $consignees_delete;

// Page init
$consignees_delete->Page_Init();

// Page main
$consignees_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var consignees_delete = new ew_Page("consignees_delete");

// page properties
consignees_delete.PageID = "delete"; // page ID
consignees_delete.FormID = "fconsigneesdelete"; // form ID
var EW_PAGE_ID = consignees_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
consignees_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
consignees_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consignees_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $consignees_delete->LoadRecordset())
	$consignees_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($consignees_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$consignees_delete->Page_Terminate("consigneeslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $consignees->TableCaption() ?><br><br>
<a href="<?php echo $consignees->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$consignees_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="consignees">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($consignees_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $consignees->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $consignees->id->FldCaption() ?></td>
		<td valign="top"><?php echo $consignees->client_id->FldCaption() ?></td>
		<td valign="top"><?php echo $consignees->Customer_No->FldCaption() ?></td>
		<td valign="top"><?php echo $consignees->Customer_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $consignees->Address->FldCaption() ?></td>
		<td valign="top"><?php echo $consignees->Contact_Person->FldCaption() ?></td>
		<td valign="top"><?php echo $consignees->Contact_No->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$consignees_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$consignees_delete->lRecCnt++;

	// Set row properties
	$consignees->CssClass = "";
	$consignees->CssStyle = "";
	$consignees->RowAttrs = array();
	$consignees->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$consignees_delete->LoadRowValues($rs);

	// Render row
	$consignees_delete->RenderRow();
?>
	<tr<?php echo $consignees->RowAttributes() ?>>
		<td<?php echo $consignees->id->CellAttributes() ?>>
<div<?php echo $consignees->id->ViewAttributes() ?>><?php echo $consignees->id->ListViewValue() ?></div></td>
		<td<?php echo $consignees->client_id->CellAttributes() ?>>
<div<?php echo $consignees->client_id->ViewAttributes() ?>><?php echo $consignees->client_id->ListViewValue() ?></div></td>
		<td<?php echo $consignees->Customer_No->CellAttributes() ?>>
<div<?php echo $consignees->Customer_No->ViewAttributes() ?>><?php echo $consignees->Customer_No->ListViewValue() ?></div></td>
		<td<?php echo $consignees->Customer_Name->CellAttributes() ?>>
<div<?php echo $consignees->Customer_Name->ViewAttributes() ?>><?php echo $consignees->Customer_Name->ListViewValue() ?></div></td>
		<td<?php echo $consignees->Address->CellAttributes() ?>>
<div<?php echo $consignees->Address->ViewAttributes() ?>><?php echo $consignees->Address->ListViewValue() ?></div></td>
		<td<?php echo $consignees->Contact_Person->CellAttributes() ?>>
<div<?php echo $consignees->Contact_Person->ViewAttributes() ?>><?php echo $consignees->Contact_Person->ListViewValue() ?></div></td>
		<td<?php echo $consignees->Contact_No->CellAttributes() ?>>
<div<?php echo $consignees->Contact_No->ViewAttributes() ?>><?php echo $consignees->Contact_No->ListViewValue() ?></div></td>
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
$consignees_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cconsignees_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'consignees';

	// Page object name
	var $PageObjName = 'consignees_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $consignees;
		if ($consignees->UseTokenInUrl) $PageUrl .= "t=" . $consignees->TableVar . "&"; // Add page token
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
		global $objForm, $consignees;
		if ($consignees->UseTokenInUrl) {
			if ($objForm)
				return ($consignees->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($consignees->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconsignees_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (consignees)
		$GLOBALS["consignees"] = new cconsignees();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consignees', TRUE);

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
		global $consignees;

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
			$this->Page_Terminate("consigneeslist.php");
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
		global $Language, $consignees;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$consignees->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($consignees->id->QueryStringValue))
				$this->Page_Terminate("consigneeslist.php"); // Prevent SQL injection, exit
			$sKey .= $consignees->id->QueryStringValue;
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
			$this->Page_Terminate("consigneeslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("consigneeslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in consignees class, consigneesinfo.php

		$consignees->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$consignees->CurrentAction = $_POST["a_delete"];
		} else {
			$consignees->CurrentAction = "I"; // Display record
		}
		switch ($consignees->CurrentAction) {
			case "D": // Delete
				$consignees->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($consignees->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $consignees;
		$DeleteRows = TRUE;
		$sWrkFilter = $consignees->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in consignees class, consigneesinfo.php

		$consignees->CurrentFilter = $sWrkFilter;
		$sSql = $consignees->SQL();
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
				$DeleteRows = $consignees->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($consignees->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($consignees->CancelMessage <> "") {
				$this->setMessage($consignees->CancelMessage);
				$consignees->CancelMessage = "";
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
				$consignees->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $consignees;

		// Call Recordset Selecting event
		$consignees->Recordset_Selecting($consignees->CurrentFilter);

		// Load List page SQL
		$sSql = $consignees->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$consignees->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $consignees;
		$sFilter = $consignees->KeyFilter();

		// Call Row Selecting event
		$consignees->Row_Selecting($sFilter);

		// Load SQL based on filter
		$consignees->CurrentFilter = $sFilter;
		$sSql = $consignees->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$consignees->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $consignees;
		$consignees->id->setDbValue($rs->fields('id'));
		$consignees->client_id->setDbValue($rs->fields('client_id'));
		$consignees->Customer_No->setDbValue($rs->fields('Customer_No'));
		$consignees->Customer_Name->setDbValue($rs->fields('Customer_Name'));
		$consignees->Address->setDbValue($rs->fields('Address'));
		$consignees->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$consignees->Contact_No->setDbValue($rs->fields('Contact_No'));
		$consignees->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $consignees;

		// Initialize URLs
		// Call Row_Rendering event

		$consignees->Row_Rendering();

		// Common render codes for all row types
		// id

		$consignees->id->CellCssStyle = ""; $consignees->id->CellCssClass = "";
		$consignees->id->CellAttrs = array(); $consignees->id->ViewAttrs = array(); $consignees->id->EditAttrs = array();

		// client_id
		$consignees->client_id->CellCssStyle = ""; $consignees->client_id->CellCssClass = "";
		$consignees->client_id->CellAttrs = array(); $consignees->client_id->ViewAttrs = array(); $consignees->client_id->EditAttrs = array();

		// Customer_No
		$consignees->Customer_No->CellCssStyle = ""; $consignees->Customer_No->CellCssClass = "";
		$consignees->Customer_No->CellAttrs = array(); $consignees->Customer_No->ViewAttrs = array(); $consignees->Customer_No->EditAttrs = array();

		// Customer_Name
		$consignees->Customer_Name->CellCssStyle = ""; $consignees->Customer_Name->CellCssClass = "";
		$consignees->Customer_Name->CellAttrs = array(); $consignees->Customer_Name->ViewAttrs = array(); $consignees->Customer_Name->EditAttrs = array();

		// Address
		$consignees->Address->CellCssStyle = ""; $consignees->Address->CellCssClass = "";
		$consignees->Address->CellAttrs = array(); $consignees->Address->ViewAttrs = array(); $consignees->Address->EditAttrs = array();

		// Contact_Person
		$consignees->Contact_Person->CellCssStyle = ""; $consignees->Contact_Person->CellCssClass = "";
		$consignees->Contact_Person->CellAttrs = array(); $consignees->Contact_Person->ViewAttrs = array(); $consignees->Contact_Person->EditAttrs = array();

		// Contact_No
		$consignees->Contact_No->CellCssStyle = ""; $consignees->Contact_No->CellCssClass = "";
		$consignees->Contact_No->CellAttrs = array(); $consignees->Contact_No->ViewAttrs = array(); $consignees->Contact_No->EditAttrs = array();
		if ($consignees->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$consignees->id->ViewValue = $consignees->id->CurrentValue;
			$consignees->id->CssStyle = "";
			$consignees->id->CssClass = "";
			$consignees->id->ViewCustomAttributes = "";

			// client_id
			if (strval($consignees->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($consignees->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$consignees->client_id->ViewValue = $consignees->client_id->CurrentValue;
				}
			} else {
				$consignees->client_id->ViewValue = NULL;
			}
			$consignees->client_id->CssStyle = "";
			$consignees->client_id->CssClass = "";
			$consignees->client_id->ViewCustomAttributes = "";

			// Customer_No
			$consignees->Customer_No->ViewValue = $consignees->Customer_No->CurrentValue;
			$consignees->Customer_No->CssStyle = "";
			$consignees->Customer_No->CssClass = "";
			$consignees->Customer_No->ViewCustomAttributes = "";

			// Customer_Name
			$consignees->Customer_Name->ViewValue = $consignees->Customer_Name->CurrentValue;
			$consignees->Customer_Name->CssStyle = "";
			$consignees->Customer_Name->CssClass = "";
			$consignees->Customer_Name->ViewCustomAttributes = "";

			// Address
			if (strval($consignees->Address->CurrentValue) <> "") {
				$sFilterWrk = "`Destination` = '" . ew_AdjustSql($consignees->Address->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->Address->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$consignees->Address->ViewValue = $consignees->Address->CurrentValue;
				}
			} else {
				$consignees->Address->ViewValue = NULL;
			}
			$consignees->Address->CssStyle = "";
			$consignees->Address->CssClass = "";
			$consignees->Address->ViewCustomAttributes = "";

			// Contact_Person
			$consignees->Contact_Person->ViewValue = $consignees->Contact_Person->CurrentValue;
			$consignees->Contact_Person->CssStyle = "";
			$consignees->Contact_Person->CssClass = "";
			$consignees->Contact_Person->ViewCustomAttributes = "";

			// Contact_No
			$consignees->Contact_No->ViewValue = $consignees->Contact_No->CurrentValue;
			$consignees->Contact_No->CssStyle = "";
			$consignees->Contact_No->CssClass = "";
			$consignees->Contact_No->ViewCustomAttributes = "";

			// id
			$consignees->id->HrefValue = "";
			$consignees->id->TooltipValue = "";

			// client_id
			$consignees->client_id->HrefValue = "";
			$consignees->client_id->TooltipValue = "";

			// Customer_No
			$consignees->Customer_No->HrefValue = "";
			$consignees->Customer_No->TooltipValue = "";

			// Customer_Name
			$consignees->Customer_Name->HrefValue = "";
			$consignees->Customer_Name->TooltipValue = "";

			// Address
			$consignees->Address->HrefValue = "";
			$consignees->Address->TooltipValue = "";

			// Contact_Person
			$consignees->Contact_Person->HrefValue = "";
			$consignees->Contact_Person->TooltipValue = "";

			// Contact_No
			$consignees->Contact_No->HrefValue = "";
			$consignees->Contact_No->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($consignees->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$consignees->Row_Rendered();
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
