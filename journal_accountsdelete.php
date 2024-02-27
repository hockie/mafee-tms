<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "journal_accountsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "account_paymentsinfo.php" ?>
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
$journal_accounts_delete = new cjournal_accounts_delete();
$Page =& $journal_accounts_delete;

// Page init
$journal_accounts_delete->Page_Init();

// Page main
$journal_accounts_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var journal_accounts_delete = new ew_Page("journal_accounts_delete");

// page properties
journal_accounts_delete.PageID = "delete"; // page ID
journal_accounts_delete.FormID = "fjournal_accountsdelete"; // form ID
var EW_PAGE_ID = journal_accounts_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
journal_accounts_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
journal_accounts_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
journal_accounts_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
journal_accounts_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $journal_accounts_delete->LoadRecordset())
	$journal_accounts_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($journal_accounts_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$journal_accounts_delete->Page_Terminate("journal_accountslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $journal_accounts->TableCaption() ?><br><br>
<a href="<?php echo $journal_accounts->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$journal_accounts_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="journal_accounts">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($journal_accounts_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $journal_accounts->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $journal_accounts->id->FldCaption() ?></td>
		<td valign="top"><?php echo $journal_accounts->journal_type_id->FldCaption() ?></td>
		<td valign="top"><?php echo $journal_accounts->Account_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $journal_accounts->Account_Reference_No->FldCaption() ?></td>
		<td valign="top"><?php echo $journal_accounts->Business_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $journal_accounts->User_ID->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$journal_accounts_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$journal_accounts_delete->lRecCnt++;

	// Set row properties
	$journal_accounts->CssClass = "";
	$journal_accounts->CssStyle = "";
	$journal_accounts->RowAttrs = array();
	$journal_accounts->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$journal_accounts_delete->LoadRowValues($rs);

	// Render row
	$journal_accounts_delete->RenderRow();
?>
	<tr<?php echo $journal_accounts->RowAttributes() ?>>
		<td<?php echo $journal_accounts->id->CellAttributes() ?>>
<div<?php echo $journal_accounts->id->ViewAttributes() ?>><?php echo $journal_accounts->id->ListViewValue() ?></div></td>
		<td<?php echo $journal_accounts->journal_type_id->CellAttributes() ?>>
<div<?php echo $journal_accounts->journal_type_id->ViewAttributes() ?>><?php echo $journal_accounts->journal_type_id->ListViewValue() ?></div></td>
		<td<?php echo $journal_accounts->Account_Name->CellAttributes() ?>>
<div<?php echo $journal_accounts->Account_Name->ViewAttributes() ?>><?php echo $journal_accounts->Account_Name->ListViewValue() ?></div></td>
		<td<?php echo $journal_accounts->Account_Reference_No->CellAttributes() ?>>
<div<?php echo $journal_accounts->Account_Reference_No->ViewAttributes() ?>><?php echo $journal_accounts->Account_Reference_No->ListViewValue() ?></div></td>
		<td<?php echo $journal_accounts->Business_Name->CellAttributes() ?>>
<div<?php echo $journal_accounts->Business_Name->ViewAttributes() ?>><?php echo $journal_accounts->Business_Name->ListViewValue() ?></div></td>
		<td<?php echo $journal_accounts->User_ID->CellAttributes() ?>>
<div<?php echo $journal_accounts->User_ID->ViewAttributes() ?>><?php echo $journal_accounts->User_ID->ListViewValue() ?></div></td>
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
$journal_accounts_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cjournal_accounts_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'journal_accounts';

	// Page object name
	var $PageObjName = 'journal_accounts_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $journal_accounts;
		if ($journal_accounts->UseTokenInUrl) $PageUrl .= "t=" . $journal_accounts->TableVar . "&"; // Add page token
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
		global $objForm, $journal_accounts;
		if ($journal_accounts->UseTokenInUrl) {
			if ($objForm)
				return ($journal_accounts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($journal_accounts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cjournal_accounts_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (journal_accounts)
		$GLOBALS["journal_accounts"] = new cjournal_accounts();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (account_payments)
		$GLOBALS['account_payments'] = new caccount_payments();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'journal_accounts', TRUE);

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
		global $journal_accounts;

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
			$this->Page_Terminate("journal_accountslist.php");
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
		global $Language, $journal_accounts;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$journal_accounts->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($journal_accounts->id->QueryStringValue))
				$this->Page_Terminate("journal_accountslist.php"); // Prevent SQL injection, exit
			$sKey .= $journal_accounts->id->QueryStringValue;
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
			$this->Page_Terminate("journal_accountslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("journal_accountslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in journal_accounts class, journal_accountsinfo.php

		$journal_accounts->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$journal_accounts->CurrentAction = $_POST["a_delete"];
		} else {
			$journal_accounts->CurrentAction = "I"; // Display record
		}
		switch ($journal_accounts->CurrentAction) {
			case "D": // Delete
				$journal_accounts->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($journal_accounts->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $journal_accounts;
		$DeleteRows = TRUE;
		$sWrkFilter = $journal_accounts->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in journal_accounts class, journal_accountsinfo.php

		$journal_accounts->CurrentFilter = $sWrkFilter;
		$sSql = $journal_accounts->SQL();
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
				$DeleteRows = $journal_accounts->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($journal_accounts->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($journal_accounts->CancelMessage <> "") {
				$this->setMessage($journal_accounts->CancelMessage);
				$journal_accounts->CancelMessage = "";
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
				$journal_accounts->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $journal_accounts;

		// Call Recordset Selecting event
		$journal_accounts->Recordset_Selecting($journal_accounts->CurrentFilter);

		// Load List page SQL
		$sSql = $journal_accounts->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$journal_accounts->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $journal_accounts;
		$sFilter = $journal_accounts->KeyFilter();

		// Call Row Selecting event
		$journal_accounts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$journal_accounts->CurrentFilter = $sFilter;
		$sSql = $journal_accounts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$journal_accounts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $journal_accounts;
		$journal_accounts->id->setDbValue($rs->fields('id'));
		$journal_accounts->journal_type_id->setDbValue($rs->fields('journal_type_id'));
		$journal_accounts->Account_Name->setDbValue($rs->fields('Account_Name'));
		$journal_accounts->Account_Reference_No->setDbValue($rs->fields('Account_Reference_No'));
		$journal_accounts->Business_Name->setDbValue($rs->fields('Business_Name'));
		$journal_accounts->Address->setDbValue($rs->fields('Address'));
		$journal_accounts->Remarks->setDbValue($rs->fields('Remarks'));
		$journal_accounts->created->setDbValue($rs->fields('created'));
		$journal_accounts->modified->setDbValue($rs->fields('modified'));
		$journal_accounts->User_ID->setDbValue($rs->fields('User_ID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $journal_accounts;

		// Initialize URLs
		// Call Row_Rendering event

		$journal_accounts->Row_Rendering();

		// Common render codes for all row types
		// id

		$journal_accounts->id->CellCssStyle = ""; $journal_accounts->id->CellCssClass = "";
		$journal_accounts->id->CellAttrs = array(); $journal_accounts->id->ViewAttrs = array(); $journal_accounts->id->EditAttrs = array();

		// journal_type_id
		$journal_accounts->journal_type_id->CellCssStyle = ""; $journal_accounts->journal_type_id->CellCssClass = "";
		$journal_accounts->journal_type_id->CellAttrs = array(); $journal_accounts->journal_type_id->ViewAttrs = array(); $journal_accounts->journal_type_id->EditAttrs = array();

		// Account_Name
		$journal_accounts->Account_Name->CellCssStyle = ""; $journal_accounts->Account_Name->CellCssClass = "";
		$journal_accounts->Account_Name->CellAttrs = array(); $journal_accounts->Account_Name->ViewAttrs = array(); $journal_accounts->Account_Name->EditAttrs = array();

		// Account_Reference_No
		$journal_accounts->Account_Reference_No->CellCssStyle = ""; $journal_accounts->Account_Reference_No->CellCssClass = "";
		$journal_accounts->Account_Reference_No->CellAttrs = array(); $journal_accounts->Account_Reference_No->ViewAttrs = array(); $journal_accounts->Account_Reference_No->EditAttrs = array();

		// Business_Name
		$journal_accounts->Business_Name->CellCssStyle = ""; $journal_accounts->Business_Name->CellCssClass = "";
		$journal_accounts->Business_Name->CellAttrs = array(); $journal_accounts->Business_Name->ViewAttrs = array(); $journal_accounts->Business_Name->EditAttrs = array();

		// User_ID
		$journal_accounts->User_ID->CellCssStyle = ""; $journal_accounts->User_ID->CellCssClass = "";
		$journal_accounts->User_ID->CellAttrs = array(); $journal_accounts->User_ID->ViewAttrs = array(); $journal_accounts->User_ID->EditAttrs = array();
		if ($journal_accounts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$journal_accounts->id->ViewValue = $journal_accounts->id->CurrentValue;
			$journal_accounts->id->CssStyle = "";
			$journal_accounts->id->CssClass = "";
			$journal_accounts->id->ViewCustomAttributes = "";

			// journal_type_id
			if (strval($journal_accounts->journal_type_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($journal_accounts->journal_type_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$journal_accounts->journal_type_id->ViewValue = $rswrk->fields('Journal_Name');
					$rswrk->Close();
				} else {
					$journal_accounts->journal_type_id->ViewValue = $journal_accounts->journal_type_id->CurrentValue;
				}
			} else {
				$journal_accounts->journal_type_id->ViewValue = NULL;
			}
			$journal_accounts->journal_type_id->CssStyle = "";
			$journal_accounts->journal_type_id->CssClass = "";
			$journal_accounts->journal_type_id->ViewCustomAttributes = "";

			// Account_Name
			$journal_accounts->Account_Name->ViewValue = $journal_accounts->Account_Name->CurrentValue;
			$journal_accounts->Account_Name->CssStyle = "";
			$journal_accounts->Account_Name->CssClass = "";
			$journal_accounts->Account_Name->ViewCustomAttributes = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->ViewValue = $journal_accounts->Account_Reference_No->CurrentValue;
			$journal_accounts->Account_Reference_No->CssStyle = "";
			$journal_accounts->Account_Reference_No->CssClass = "";
			$journal_accounts->Account_Reference_No->ViewCustomAttributes = "";

			// Business_Name
			$journal_accounts->Business_Name->ViewValue = $journal_accounts->Business_Name->CurrentValue;
			$journal_accounts->Business_Name->CssStyle = "";
			$journal_accounts->Business_Name->CssClass = "";
			$journal_accounts->Business_Name->ViewCustomAttributes = "";

			// created
			$journal_accounts->created->ViewValue = $journal_accounts->created->CurrentValue;
			$journal_accounts->created->ViewValue = ew_FormatDateTime($journal_accounts->created->ViewValue, 6);
			$journal_accounts->created->CssStyle = "";
			$journal_accounts->created->CssClass = "";
			$journal_accounts->created->ViewCustomAttributes = "";

			// modified
			$journal_accounts->modified->ViewValue = $journal_accounts->modified->CurrentValue;
			$journal_accounts->modified->ViewValue = ew_FormatDateTime($journal_accounts->modified->ViewValue, 6);
			$journal_accounts->modified->CssStyle = "";
			$journal_accounts->modified->CssClass = "";
			$journal_accounts->modified->ViewCustomAttributes = "";

			// User_ID
			$journal_accounts->User_ID->ViewValue = $journal_accounts->User_ID->CurrentValue;
			$journal_accounts->User_ID->CssStyle = "";
			$journal_accounts->User_ID->CssClass = "";
			$journal_accounts->User_ID->ViewCustomAttributes = "";

			// id
			$journal_accounts->id->HrefValue = "";
			$journal_accounts->id->TooltipValue = "";

			// journal_type_id
			$journal_accounts->journal_type_id->HrefValue = "";
			$journal_accounts->journal_type_id->TooltipValue = "";

			// Account_Name
			$journal_accounts->Account_Name->HrefValue = "";
			$journal_accounts->Account_Name->TooltipValue = "";

			// Account_Reference_No
			$journal_accounts->Account_Reference_No->HrefValue = "";
			$journal_accounts->Account_Reference_No->TooltipValue = "";

			// Business_Name
			$journal_accounts->Business_Name->HrefValue = "";
			$journal_accounts->Business_Name->TooltipValue = "";

			// User_ID
			$journal_accounts->User_ID->HrefValue = "";
			$journal_accounts->User_ID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($journal_accounts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$journal_accounts->Row_Rendered();
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
