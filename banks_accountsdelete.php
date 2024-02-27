<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "banks_accountsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "companyinfo.php" ?>
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
$banks_accounts_delete = new cbanks_accounts_delete();
$Page =& $banks_accounts_delete;

// Page init
$banks_accounts_delete->Page_Init();

// Page main
$banks_accounts_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var banks_accounts_delete = new ew_Page("banks_accounts_delete");

// page properties
banks_accounts_delete.PageID = "delete"; // page ID
banks_accounts_delete.FormID = "fbanks_accountsdelete"; // form ID
var EW_PAGE_ID = banks_accounts_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
banks_accounts_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
banks_accounts_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
banks_accounts_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
banks_accounts_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $banks_accounts_delete->LoadRecordset())
	$banks_accounts_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($banks_accounts_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$banks_accounts_delete->Page_Terminate("banks_accountslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $banks_accounts->TableCaption() ?><br><br>
<a href="<?php echo $banks_accounts->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$banks_accounts_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="banks_accounts">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($banks_accounts_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $banks_accounts->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $banks_accounts->id->FldCaption() ?></td>
		<td valign="top"><?php echo $banks_accounts->Bank_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $banks_accounts->Branch->FldCaption() ?></td>
		<td valign="top"><?php echo $banks_accounts->Account_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $banks_accounts->Account_Number->FldCaption() ?></td>
		<td valign="top"><?php echo $banks_accounts->Account_Type->FldCaption() ?></td>
		<td valign="top"><?php echo $banks_accounts->Remarks->FldCaption() ?></td>
		<td valign="top"><?php echo $banks_accounts->Company->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$banks_accounts_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$banks_accounts_delete->lRecCnt++;

	// Set row properties
	$banks_accounts->CssClass = "";
	$banks_accounts->CssStyle = "";
	$banks_accounts->RowAttrs = array();
	$banks_accounts->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$banks_accounts_delete->LoadRowValues($rs);

	// Render row
	$banks_accounts_delete->RenderRow();
?>
	<tr<?php echo $banks_accounts->RowAttributes() ?>>
		<td<?php echo $banks_accounts->id->CellAttributes() ?>>
<div<?php echo $banks_accounts->id->ViewAttributes() ?>><?php echo $banks_accounts->id->ListViewValue() ?></div></td>
		<td<?php echo $banks_accounts->Bank_Name->CellAttributes() ?>>
<div<?php echo $banks_accounts->Bank_Name->ViewAttributes() ?>><?php echo $banks_accounts->Bank_Name->ListViewValue() ?></div></td>
		<td<?php echo $banks_accounts->Branch->CellAttributes() ?>>
<div<?php echo $banks_accounts->Branch->ViewAttributes() ?>><?php echo $banks_accounts->Branch->ListViewValue() ?></div></td>
		<td<?php echo $banks_accounts->Account_Name->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Name->ViewAttributes() ?>><?php echo $banks_accounts->Account_Name->ListViewValue() ?></div></td>
		<td<?php echo $banks_accounts->Account_Number->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Number->ViewAttributes() ?>><?php echo $banks_accounts->Account_Number->ListViewValue() ?></div></td>
		<td<?php echo $banks_accounts->Account_Type->CellAttributes() ?>>
<div<?php echo $banks_accounts->Account_Type->ViewAttributes() ?>><?php echo $banks_accounts->Account_Type->ListViewValue() ?></div></td>
		<td<?php echo $banks_accounts->Remarks->CellAttributes() ?>>
<div<?php echo $banks_accounts->Remarks->ViewAttributes() ?>><?php echo $banks_accounts->Remarks->ListViewValue() ?></div></td>
		<td<?php echo $banks_accounts->Company->CellAttributes() ?>>
<div<?php echo $banks_accounts->Company->ViewAttributes() ?>><?php echo $banks_accounts->Company->ListViewValue() ?></div></td>
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
$banks_accounts_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cbanks_accounts_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'banks_accounts';

	// Page object name
	var $PageObjName = 'banks_accounts_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $banks_accounts;
		if ($banks_accounts->UseTokenInUrl) $PageUrl .= "t=" . $banks_accounts->TableVar . "&"; // Add page token
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
		global $objForm, $banks_accounts;
		if ($banks_accounts->UseTokenInUrl) {
			if ($objForm)
				return ($banks_accounts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($banks_accounts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cbanks_accounts_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (banks_accounts)
		$GLOBALS["banks_accounts"] = new cbanks_accounts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (company)
		$GLOBALS['company'] = new ccompany();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'banks_accounts', TRUE);

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
		global $banks_accounts;

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
			$this->Page_Terminate("banks_accountslist.php");
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
		global $Language, $banks_accounts;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$banks_accounts->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($banks_accounts->id->QueryStringValue))
				$this->Page_Terminate("banks_accountslist.php"); // Prevent SQL injection, exit
			$sKey .= $banks_accounts->id->QueryStringValue;
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
			$this->Page_Terminate("banks_accountslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("banks_accountslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in banks_accounts class, banks_accountsinfo.php

		$banks_accounts->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$banks_accounts->CurrentAction = $_POST["a_delete"];
		} else {
			$banks_accounts->CurrentAction = "I"; // Display record
		}
		switch ($banks_accounts->CurrentAction) {
			case "D": // Delete
				$banks_accounts->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($banks_accounts->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $banks_accounts;
		$DeleteRows = TRUE;
		$sWrkFilter = $banks_accounts->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in banks_accounts class, banks_accountsinfo.php

		$banks_accounts->CurrentFilter = $sWrkFilter;
		$sSql = $banks_accounts->SQL();
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
				$DeleteRows = $banks_accounts->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($banks_accounts->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($banks_accounts->CancelMessage <> "") {
				$this->setMessage($banks_accounts->CancelMessage);
				$banks_accounts->CancelMessage = "";
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
				$banks_accounts->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $banks_accounts;

		// Call Recordset Selecting event
		$banks_accounts->Recordset_Selecting($banks_accounts->CurrentFilter);

		// Load List page SQL
		$sSql = $banks_accounts->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$banks_accounts->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $banks_accounts;
		$sFilter = $banks_accounts->KeyFilter();

		// Call Row Selecting event
		$banks_accounts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$banks_accounts->CurrentFilter = $sFilter;
		$sSql = $banks_accounts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$banks_accounts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $banks_accounts;
		$banks_accounts->id->setDbValue($rs->fields('id'));
		$banks_accounts->Bank_Name->setDbValue($rs->fields('Bank_Name'));
		$banks_accounts->Branch->setDbValue($rs->fields('Branch'));
		$banks_accounts->Address->setDbValue($rs->fields('Address'));
		$banks_accounts->Account_Name->setDbValue($rs->fields('Account_Name'));
		$banks_accounts->Account_Number->setDbValue($rs->fields('Account_Number'));
		$banks_accounts->Account_Type->setDbValue($rs->fields('Account_Type'));
		$banks_accounts->Remarks->setDbValue($rs->fields('Remarks'));
		$banks_accounts->Company->setDbValue($rs->fields('Company'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $banks_accounts;

		// Initialize URLs
		// Call Row_Rendering event

		$banks_accounts->Row_Rendering();

		// Common render codes for all row types
		// id

		$banks_accounts->id->CellCssStyle = ""; $banks_accounts->id->CellCssClass = "";
		$banks_accounts->id->CellAttrs = array(); $banks_accounts->id->ViewAttrs = array(); $banks_accounts->id->EditAttrs = array();

		// Bank_Name
		$banks_accounts->Bank_Name->CellCssStyle = ""; $banks_accounts->Bank_Name->CellCssClass = "";
		$banks_accounts->Bank_Name->CellAttrs = array(); $banks_accounts->Bank_Name->ViewAttrs = array(); $banks_accounts->Bank_Name->EditAttrs = array();

		// Branch
		$banks_accounts->Branch->CellCssStyle = ""; $banks_accounts->Branch->CellCssClass = "";
		$banks_accounts->Branch->CellAttrs = array(); $banks_accounts->Branch->ViewAttrs = array(); $banks_accounts->Branch->EditAttrs = array();

		// Account_Name
		$banks_accounts->Account_Name->CellCssStyle = ""; $banks_accounts->Account_Name->CellCssClass = "";
		$banks_accounts->Account_Name->CellAttrs = array(); $banks_accounts->Account_Name->ViewAttrs = array(); $banks_accounts->Account_Name->EditAttrs = array();

		// Account_Number
		$banks_accounts->Account_Number->CellCssStyle = ""; $banks_accounts->Account_Number->CellCssClass = "";
		$banks_accounts->Account_Number->CellAttrs = array(); $banks_accounts->Account_Number->ViewAttrs = array(); $banks_accounts->Account_Number->EditAttrs = array();

		// Account_Type
		$banks_accounts->Account_Type->CellCssStyle = ""; $banks_accounts->Account_Type->CellCssClass = "";
		$banks_accounts->Account_Type->CellAttrs = array(); $banks_accounts->Account_Type->ViewAttrs = array(); $banks_accounts->Account_Type->EditAttrs = array();

		// Remarks
		$banks_accounts->Remarks->CellCssStyle = ""; $banks_accounts->Remarks->CellCssClass = "";
		$banks_accounts->Remarks->CellAttrs = array(); $banks_accounts->Remarks->ViewAttrs = array(); $banks_accounts->Remarks->EditAttrs = array();

		// Company
		$banks_accounts->Company->CellCssStyle = ""; $banks_accounts->Company->CellCssClass = "";
		$banks_accounts->Company->CellAttrs = array(); $banks_accounts->Company->ViewAttrs = array(); $banks_accounts->Company->EditAttrs = array();
		if ($banks_accounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$banks_accounts->id->ViewValue = $banks_accounts->id->CurrentValue;
			$banks_accounts->id->CssStyle = "";
			$banks_accounts->id->CssClass = "";
			$banks_accounts->id->ViewCustomAttributes = "";

			// Bank_Name
			$banks_accounts->Bank_Name->ViewValue = $banks_accounts->Bank_Name->CurrentValue;
			$banks_accounts->Bank_Name->CssStyle = "";
			$banks_accounts->Bank_Name->CssClass = "";
			$banks_accounts->Bank_Name->ViewCustomAttributes = "";

			// Branch
			$banks_accounts->Branch->ViewValue = $banks_accounts->Branch->CurrentValue;
			$banks_accounts->Branch->CssStyle = "";
			$banks_accounts->Branch->CssClass = "";
			$banks_accounts->Branch->ViewCustomAttributes = "";

			// Account_Name
			$banks_accounts->Account_Name->ViewValue = $banks_accounts->Account_Name->CurrentValue;
			$banks_accounts->Account_Name->CssStyle = "";
			$banks_accounts->Account_Name->CssClass = "";
			$banks_accounts->Account_Name->ViewCustomAttributes = "";

			// Account_Number
			$banks_accounts->Account_Number->ViewValue = $banks_accounts->Account_Number->CurrentValue;
			$banks_accounts->Account_Number->CssStyle = "";
			$banks_accounts->Account_Number->CssClass = "";
			$banks_accounts->Account_Number->ViewCustomAttributes = "";

			// Account_Type
			$banks_accounts->Account_Type->ViewValue = $banks_accounts->Account_Type->CurrentValue;
			$banks_accounts->Account_Type->CssStyle = "";
			$banks_accounts->Account_Type->CssClass = "";
			$banks_accounts->Account_Type->ViewCustomAttributes = "";

			// Remarks
			$banks_accounts->Remarks->ViewValue = $banks_accounts->Remarks->CurrentValue;
			$banks_accounts->Remarks->CssStyle = "";
			$banks_accounts->Remarks->CssClass = "";
			$banks_accounts->Remarks->ViewCustomAttributes = "";

			// Company
			if (strval($banks_accounts->Company->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($banks_accounts->Company->CurrentValue) . "";
			$sSqlWrk = "SELECT `Company_Name` FROM `company`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Company_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$banks_accounts->Company->ViewValue = $rswrk->fields('Company_Name');
					$rswrk->Close();
				} else {
					$banks_accounts->Company->ViewValue = $banks_accounts->Company->CurrentValue;
				}
			} else {
				$banks_accounts->Company->ViewValue = NULL;
			}
			$banks_accounts->Company->CssStyle = "";
			$banks_accounts->Company->CssClass = "";
			$banks_accounts->Company->ViewCustomAttributes = "";

			// id
			$banks_accounts->id->HrefValue = "";
			$banks_accounts->id->TooltipValue = "";

			// Bank_Name
			$banks_accounts->Bank_Name->HrefValue = "";
			$banks_accounts->Bank_Name->TooltipValue = "";

			// Branch
			$banks_accounts->Branch->HrefValue = "";
			$banks_accounts->Branch->TooltipValue = "";

			// Account_Name
			$banks_accounts->Account_Name->HrefValue = "";
			$banks_accounts->Account_Name->TooltipValue = "";

			// Account_Number
			$banks_accounts->Account_Number->HrefValue = "";
			$banks_accounts->Account_Number->TooltipValue = "";

			// Account_Type
			$banks_accounts->Account_Type->HrefValue = "";
			$banks_accounts->Account_Type->TooltipValue = "";

			// Remarks
			$banks_accounts->Remarks->HrefValue = "";
			$banks_accounts->Remarks->TooltipValue = "";

			// Company
			$banks_accounts->Company->HrefValue = "";
			$banks_accounts->Company->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($banks_accounts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$banks_accounts->Row_Rendered();
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
