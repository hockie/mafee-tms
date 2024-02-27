<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "account_paymentsinfo.php" ?>
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
$account_payments_delete = new caccount_payments_delete();
$Page =& $account_payments_delete;

// Page init
$account_payments_delete->Page_Init();

// Page main
$account_payments_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var account_payments_delete = new ew_Page("account_payments_delete");

// page properties
account_payments_delete.PageID = "delete"; // page ID
account_payments_delete.FormID = "faccount_paymentsdelete"; // form ID
var EW_PAGE_ID = account_payments_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
account_payments_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
account_payments_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
account_payments_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
account_payments_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $account_payments_delete->LoadRecordset())
	$account_payments_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($account_payments_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$account_payments_delete->Page_Terminate("account_paymentslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $account_payments->TableCaption() ?><br><br>
<a href="<?php echo $account_payments->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payments_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="account_payments">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($account_payments_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $account_payments->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $account_payments->id->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Date->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Payment_Reference->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Payment_Date->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Payment_Type->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Journal_Type_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Journal_Account_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Payment_Method_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Vendor_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Client_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Amount->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->Status_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->User_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payments->total_invoice_items->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$account_payments_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$account_payments_delete->lRecCnt++;

	// Set row properties
	$account_payments->CssClass = "";
	$account_payments->CssStyle = "";
	$account_payments->RowAttrs = array();
	$account_payments->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$account_payments_delete->LoadRowValues($rs);

	// Render row
	$account_payments_delete->RenderRow();
?>
	<tr<?php echo $account_payments->RowAttributes() ?>>
		<td<?php echo $account_payments->id->CellAttributes() ?>>
<div<?php echo $account_payments->id->ViewAttributes() ?>><?php echo $account_payments->id->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Date->CellAttributes() ?>>
<div<?php echo $account_payments->Date->ViewAttributes() ?>><?php echo $account_payments->Date->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Payment_Reference->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Reference->ViewAttributes() ?>><?php echo $account_payments->Payment_Reference->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Payment_Date->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Date->ViewAttributes() ?>><?php echo $account_payments->Payment_Date->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Payment_Type->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Type->ViewAttributes() ?>><?php echo $account_payments->Payment_Type->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Journal_Type_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Journal_Type_ID->ViewAttributes() ?>><?php echo $account_payments->Journal_Type_ID->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Journal_Account_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Journal_Account_ID->ViewAttributes() ?>><?php echo $account_payments->Journal_Account_ID->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Payment_Method_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Method_ID->ViewAttributes() ?>><?php echo $account_payments->Payment_Method_ID->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Vendor_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Vendor_ID->ViewAttributes() ?>><?php echo $account_payments->Vendor_ID->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Client_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Client_ID->ViewAttributes() ?>><?php echo $account_payments->Client_ID->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Amount->CellAttributes() ?>>
<div<?php echo $account_payments->Amount->ViewAttributes() ?>><?php echo $account_payments->Amount->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->Status_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Status_ID->ViewAttributes() ?>><?php echo $account_payments->Status_ID->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->User_ID->CellAttributes() ?>>
<div<?php echo $account_payments->User_ID->ViewAttributes() ?>><?php echo $account_payments->User_ID->ListViewValue() ?></div></td>
		<td<?php echo $account_payments->total_invoice_items->CellAttributes() ?>>
<div<?php echo $account_payments->total_invoice_items->ViewAttributes() ?>><?php echo $account_payments->total_invoice_items->ListViewValue() ?></div></td>
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
$account_payments_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payments_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'account_payments';

	// Page object name
	var $PageObjName = 'account_payments_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $account_payments;
		if ($account_payments->UseTokenInUrl) $PageUrl .= "t=" . $account_payments->TableVar . "&"; // Add page token
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
		global $objForm, $account_payments;
		if ($account_payments->UseTokenInUrl) {
			if ($objForm)
				return ($account_payments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($account_payments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caccount_payments_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (account_payments)
		$GLOBALS["account_payments"] = new caccount_payments();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'account_payments', TRUE);

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
		global $account_payments;

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
			$this->Page_Terminate("account_paymentslist.php");
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
		global $Language, $account_payments;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$account_payments->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($account_payments->id->QueryStringValue))
				$this->Page_Terminate("account_paymentslist.php"); // Prevent SQL injection, exit
			$sKey .= $account_payments->id->QueryStringValue;
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
			$this->Page_Terminate("account_paymentslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("account_paymentslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in account_payments class, account_paymentsinfo.php

		$account_payments->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$account_payments->CurrentAction = $_POST["a_delete"];
		} else {
			$account_payments->CurrentAction = "I"; // Display record
		}
		switch ($account_payments->CurrentAction) {
			case "D": // Delete
				$account_payments->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($account_payments->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $account_payments;
		$DeleteRows = TRUE;
		$sWrkFilter = $account_payments->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in account_payments class, account_paymentsinfo.php

		$account_payments->CurrentFilter = $sWrkFilter;
		$sSql = $account_payments->SQL();
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
				$DeleteRows = $account_payments->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($account_payments->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($account_payments->CancelMessage <> "") {
				$this->setMessage($account_payments->CancelMessage);
				$account_payments->CancelMessage = "";
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
				$account_payments->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $account_payments;

		// Call Recordset Selecting event
		$account_payments->Recordset_Selecting($account_payments->CurrentFilter);

		// Load List page SQL
		$sSql = $account_payments->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$account_payments->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $account_payments;
		$sFilter = $account_payments->KeyFilter();

		// Call Row Selecting event
		$account_payments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$account_payments->CurrentFilter = $sFilter;
		$sSql = $account_payments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$account_payments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $account_payments;
		$account_payments->id->setDbValue($rs->fields('id'));
		$account_payments->Date->setDbValue($rs->fields('Date'));
		$account_payments->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$account_payments->Payment_Date->setDbValue($rs->fields('Payment_Date'));
		$account_payments->Payment_Type->setDbValue($rs->fields('Payment_Type'));
		$account_payments->Journal_Type_ID->setDbValue($rs->fields('Journal_Type_ID'));
		$account_payments->Journal_Account_ID->setDbValue($rs->fields('Journal_Account_ID'));
		$account_payments->Payment_Method_ID->setDbValue($rs->fields('Payment_Method_ID'));
		$account_payments->Vendor_ID->setDbValue($rs->fields('Vendor_ID'));
		$account_payments->Client_ID->setDbValue($rs->fields('Client_ID'));
		$account_payments->Amount->setDbValue($rs->fields('Amount'));
		$account_payments->Status_ID->setDbValue($rs->fields('Status_ID'));
		$account_payments->Description->setDbValue($rs->fields('Description'));
		$account_payments->Remarks->setDbValue($rs->fields('Remarks'));
		$account_payments->User_ID->setDbValue($rs->fields('User_ID'));
		$account_payments->Created->setDbValue($rs->fields('Created'));
		$account_payments->Modified->setDbValue($rs->fields('Modified'));
		$account_payments->total_invoice_items->setDbValue($rs->fields('total_invoice_items'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $account_payments;

		// Initialize URLs
		// Call Row_Rendering event

		$account_payments->Row_Rendering();

		// Common render codes for all row types
		// id

		$account_payments->id->CellCssStyle = ""; $account_payments->id->CellCssClass = "";
		$account_payments->id->CellAttrs = array(); $account_payments->id->ViewAttrs = array(); $account_payments->id->EditAttrs = array();

		// Date
		$account_payments->Date->CellCssStyle = ""; $account_payments->Date->CellCssClass = "";
		$account_payments->Date->CellAttrs = array(); $account_payments->Date->ViewAttrs = array(); $account_payments->Date->EditAttrs = array();

		// Payment_Reference
		$account_payments->Payment_Reference->CellCssStyle = ""; $account_payments->Payment_Reference->CellCssClass = "";
		$account_payments->Payment_Reference->CellAttrs = array(); $account_payments->Payment_Reference->ViewAttrs = array(); $account_payments->Payment_Reference->EditAttrs = array();

		// Payment_Date
		$account_payments->Payment_Date->CellCssStyle = ""; $account_payments->Payment_Date->CellCssClass = "";
		$account_payments->Payment_Date->CellAttrs = array(); $account_payments->Payment_Date->ViewAttrs = array(); $account_payments->Payment_Date->EditAttrs = array();

		// Payment_Type
		$account_payments->Payment_Type->CellCssStyle = ""; $account_payments->Payment_Type->CellCssClass = "";
		$account_payments->Payment_Type->CellAttrs = array(); $account_payments->Payment_Type->ViewAttrs = array(); $account_payments->Payment_Type->EditAttrs = array();

		// Journal_Type_ID
		$account_payments->Journal_Type_ID->CellCssStyle = ""; $account_payments->Journal_Type_ID->CellCssClass = "";
		$account_payments->Journal_Type_ID->CellAttrs = array(); $account_payments->Journal_Type_ID->ViewAttrs = array(); $account_payments->Journal_Type_ID->EditAttrs = array();

		// Journal_Account_ID
		$account_payments->Journal_Account_ID->CellCssStyle = ""; $account_payments->Journal_Account_ID->CellCssClass = "";
		$account_payments->Journal_Account_ID->CellAttrs = array(); $account_payments->Journal_Account_ID->ViewAttrs = array(); $account_payments->Journal_Account_ID->EditAttrs = array();

		// Payment_Method_ID
		$account_payments->Payment_Method_ID->CellCssStyle = ""; $account_payments->Payment_Method_ID->CellCssClass = "";
		$account_payments->Payment_Method_ID->CellAttrs = array(); $account_payments->Payment_Method_ID->ViewAttrs = array(); $account_payments->Payment_Method_ID->EditAttrs = array();

		// Vendor_ID
		$account_payments->Vendor_ID->CellCssStyle = ""; $account_payments->Vendor_ID->CellCssClass = "";
		$account_payments->Vendor_ID->CellAttrs = array(); $account_payments->Vendor_ID->ViewAttrs = array(); $account_payments->Vendor_ID->EditAttrs = array();

		// Client_ID
		$account_payments->Client_ID->CellCssStyle = ""; $account_payments->Client_ID->CellCssClass = "";
		$account_payments->Client_ID->CellAttrs = array(); $account_payments->Client_ID->ViewAttrs = array(); $account_payments->Client_ID->EditAttrs = array();

		// Amount
		$account_payments->Amount->CellCssStyle = ""; $account_payments->Amount->CellCssClass = "";
		$account_payments->Amount->CellAttrs = array(); $account_payments->Amount->ViewAttrs = array(); $account_payments->Amount->EditAttrs = array();

		// Status_ID
		$account_payments->Status_ID->CellCssStyle = ""; $account_payments->Status_ID->CellCssClass = "";
		$account_payments->Status_ID->CellAttrs = array(); $account_payments->Status_ID->ViewAttrs = array(); $account_payments->Status_ID->EditAttrs = array();

		// User_ID
		$account_payments->User_ID->CellCssStyle = ""; $account_payments->User_ID->CellCssClass = "";
		$account_payments->User_ID->CellAttrs = array(); $account_payments->User_ID->ViewAttrs = array(); $account_payments->User_ID->EditAttrs = array();

		// total_invoice_items
		$account_payments->total_invoice_items->CellCssStyle = ""; $account_payments->total_invoice_items->CellCssClass = "";
		$account_payments->total_invoice_items->CellAttrs = array(); $account_payments->total_invoice_items->ViewAttrs = array(); $account_payments->total_invoice_items->EditAttrs = array();
		if ($account_payments->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$account_payments->id->ViewValue = $account_payments->id->CurrentValue;
			$account_payments->id->CssStyle = "";
			$account_payments->id->CssClass = "";
			$account_payments->id->ViewCustomAttributes = "";

			// Date
			$account_payments->Date->ViewValue = $account_payments->Date->CurrentValue;
			$account_payments->Date->ViewValue = ew_FormatDateTime($account_payments->Date->ViewValue, 6);
			$account_payments->Date->CssStyle = "";
			$account_payments->Date->CssClass = "";
			$account_payments->Date->ViewCustomAttributes = "";

			// Payment_Reference
			$account_payments->Payment_Reference->ViewValue = $account_payments->Payment_Reference->CurrentValue;
			$account_payments->Payment_Reference->CssStyle = "";
			$account_payments->Payment_Reference->CssClass = "";
			$account_payments->Payment_Reference->ViewCustomAttributes = "";

			// Payment_Date
			$account_payments->Payment_Date->ViewValue = $account_payments->Payment_Date->CurrentValue;
			$account_payments->Payment_Date->ViewValue = ew_FormatDateTime($account_payments->Payment_Date->ViewValue, 6);
			$account_payments->Payment_Date->CssStyle = "";
			$account_payments->Payment_Date->CssClass = "";
			$account_payments->Payment_Date->ViewCustomAttributes = "";

			// Payment_Type
			if (strval($account_payments->Payment_Type->CurrentValue) <> "") {
				switch ($account_payments->Payment_Type->CurrentValue) {
					case "payment_send":
						$account_payments->Payment_Type->ViewValue = "Payment Send";
						break;
					case "payment_received":
						$account_payments->Payment_Type->ViewValue = "Payment Received";
						break;
					default:
						$account_payments->Payment_Type->ViewValue = $account_payments->Payment_Type->CurrentValue;
				}
			} else {
				$account_payments->Payment_Type->ViewValue = NULL;
			}
			$account_payments->Payment_Type->CssStyle = "";
			$account_payments->Payment_Type->CssClass = "";
			$account_payments->Payment_Type->ViewCustomAttributes = "";

			// Journal_Type_ID
			if (strval($account_payments->Journal_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Journal_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Journal_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Journal_Type_ID->ViewValue = $rswrk->fields('Journal_Name');
					$rswrk->Close();
				} else {
					$account_payments->Journal_Type_ID->ViewValue = $account_payments->Journal_Type_ID->CurrentValue;
				}
			} else {
				$account_payments->Journal_Type_ID->ViewValue = NULL;
			}
			$account_payments->Journal_Type_ID->CssStyle = "";
			$account_payments->Journal_Type_ID->CssClass = "";
			$account_payments->Journal_Type_ID->ViewCustomAttributes = "";

			// Journal_Account_ID
			if (strval($account_payments->Journal_Account_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Journal_Account_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Account_Reference_No` FROM `journal_accounts`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Business_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Journal_Account_ID->ViewValue = $rswrk->fields('Account_Reference_No');
					$rswrk->Close();
				} else {
					$account_payments->Journal_Account_ID->ViewValue = $account_payments->Journal_Account_ID->CurrentValue;
				}
			} else {
				$account_payments->Journal_Account_ID->ViewValue = NULL;
			}
			$account_payments->Journal_Account_ID->CssStyle = "";
			$account_payments->Journal_Account_ID->CssClass = "";
			$account_payments->Journal_Account_ID->ViewCustomAttributes = "";

			// Payment_Method_ID
			if (strval($account_payments->Payment_Method_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Payment_Method_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Payment_Method` FROM `account_payment_methods`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Payment_Method_ID->ViewValue = $rswrk->fields('Payment_Method');
					$rswrk->Close();
				} else {
					$account_payments->Payment_Method_ID->ViewValue = $account_payments->Payment_Method_ID->CurrentValue;
				}
			} else {
				$account_payments->Payment_Method_ID->ViewValue = NULL;
			}
			$account_payments->Payment_Method_ID->CssStyle = "";
			$account_payments->Payment_Method_ID->CssClass = "";
			$account_payments->Payment_Method_ID->ViewCustomAttributes = "";

			// Vendor_ID
			if (strval($account_payments->Vendor_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Vendor_ID->CurrentValue) . "";
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
					$account_payments->Vendor_ID->ViewValue = $rswrk->fields('Subcon_Name');
					$rswrk->Close();
				} else {
					$account_payments->Vendor_ID->ViewValue = $account_payments->Vendor_ID->CurrentValue;
				}
			} else {
				$account_payments->Vendor_ID->ViewValue = NULL;
			}
			$account_payments->Vendor_ID->CssStyle = "";
			$account_payments->Vendor_ID->CssClass = "";
			$account_payments->Vendor_ID->ViewCustomAttributes = "";

			// Client_ID
			if (strval($account_payments->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Client_Name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$account_payments->Client_ID->ViewValue = $account_payments->Client_ID->CurrentValue;
				}
			} else {
				$account_payments->Client_ID->ViewValue = NULL;
			}
			$account_payments->Client_ID->CssStyle = "";
			$account_payments->Client_ID->CssClass = "";
			$account_payments->Client_ID->ViewCustomAttributes = "";

			// Amount
			$account_payments->Amount->ViewValue = $account_payments->Amount->CurrentValue;
			$account_payments->Amount->ViewValue = ew_FormatNumber($account_payments->Amount->ViewValue, 2, -2, -2, -2);
			$account_payments->Amount->CssStyle = "";
			$account_payments->Amount->CssClass = "";
			$account_payments->Amount->ViewCustomAttributes = "";

			// Status_ID
			if (strval($account_payments->Status_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($account_payments->Status_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Status` FROM `statuses`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$account_payments->Status_ID->ViewValue = $rswrk->fields('Status');
					$rswrk->Close();
				} else {
					$account_payments->Status_ID->ViewValue = $account_payments->Status_ID->CurrentValue;
				}
			} else {
				$account_payments->Status_ID->ViewValue = NULL;
			}
			$account_payments->Status_ID->CssStyle = "";
			$account_payments->Status_ID->CssClass = "";
			$account_payments->Status_ID->ViewCustomAttributes = "";

			// User_ID
			$account_payments->User_ID->ViewValue = $account_payments->User_ID->CurrentValue;
			$account_payments->User_ID->CssStyle = "";
			$account_payments->User_ID->CssClass = "";
			$account_payments->User_ID->ViewCustomAttributes = "";

			// Created
			$account_payments->Created->ViewValue = $account_payments->Created->CurrentValue;
			$account_payments->Created->ViewValue = ew_FormatDateTime($account_payments->Created->ViewValue, 6);
			$account_payments->Created->CssStyle = "";
			$account_payments->Created->CssClass = "";
			$account_payments->Created->ViewCustomAttributes = "";

			// Modified
			$account_payments->Modified->ViewValue = $account_payments->Modified->CurrentValue;
			$account_payments->Modified->ViewValue = ew_FormatDateTime($account_payments->Modified->ViewValue, 6);
			$account_payments->Modified->CssStyle = "";
			$account_payments->Modified->CssClass = "";
			$account_payments->Modified->ViewCustomAttributes = "";

			// total_invoice_items
			$account_payments->total_invoice_items->ViewValue = $account_payments->total_invoice_items->CurrentValue;
			$account_payments->total_invoice_items->CssStyle = "";
			$account_payments->total_invoice_items->CssClass = "";
			$account_payments->total_invoice_items->ViewCustomAttributes = "";

			// id
			$account_payments->id->HrefValue = "";
			$account_payments->id->TooltipValue = "";

			// Date
			$account_payments->Date->HrefValue = "";
			$account_payments->Date->TooltipValue = "";

			// Payment_Reference
			$account_payments->Payment_Reference->HrefValue = "";
			$account_payments->Payment_Reference->TooltipValue = "";

			// Payment_Date
			$account_payments->Payment_Date->HrefValue = "";
			$account_payments->Payment_Date->TooltipValue = "";

			// Payment_Type
			$account_payments->Payment_Type->HrefValue = "";
			$account_payments->Payment_Type->TooltipValue = "";

			// Journal_Type_ID
			$account_payments->Journal_Type_ID->HrefValue = "";
			$account_payments->Journal_Type_ID->TooltipValue = "";

			// Journal_Account_ID
			$account_payments->Journal_Account_ID->HrefValue = "";
			$account_payments->Journal_Account_ID->TooltipValue = "";

			// Payment_Method_ID
			$account_payments->Payment_Method_ID->HrefValue = "";
			$account_payments->Payment_Method_ID->TooltipValue = "";

			// Vendor_ID
			$account_payments->Vendor_ID->HrefValue = "";
			$account_payments->Vendor_ID->TooltipValue = "";

			// Client_ID
			$account_payments->Client_ID->HrefValue = "";
			$account_payments->Client_ID->TooltipValue = "";

			// Amount
			$account_payments->Amount->HrefValue = "";
			$account_payments->Amount->TooltipValue = "";

			// Status_ID
			$account_payments->Status_ID->HrefValue = "";
			$account_payments->Status_ID->TooltipValue = "";

			// User_ID
			$account_payments->User_ID->HrefValue = "";
			$account_payments->User_ID->TooltipValue = "";

			// total_invoice_items
			$account_payments->total_invoice_items->HrefValue = "";
			$account_payments->total_invoice_items->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($account_payments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$account_payments->Row_Rendered();
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
