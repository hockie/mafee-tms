<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "expensesinfo.php" ?>
<?php include "bookingsinfo.php" ?>
<?php include "usersinfo.php" ?>
<?php include "accounts_receivableinfo.php" ?>
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
$expenses_delete = new cexpenses_delete();
$Page =& $expenses_delete;

// Page init
$expenses_delete->Page_Init();

// Page main
$expenses_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expenses_delete = new ew_Page("expenses_delete");

// page properties
expenses_delete.PageID = "delete"; // page ID
expenses_delete.FormID = "fexpensesdelete"; // form ID
var EW_PAGE_ID = expenses_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expenses_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenses_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenses_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenses_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $expenses_delete->LoadRecordset())
	$expenses_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($expenses_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$expenses_delete->Page_Terminate("expenseslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenses->TableCaption() ?><br><br>
<a href="<?php echo $expenses->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expenses_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="expenses">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($expenses_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $expenses->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $expenses->id->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Date_Created->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->expense_date->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->expense_category_id->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Reference_No->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Booking_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Description->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Amount->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Vat->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Total_Sales->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Wtax->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Total_Amount_Due->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->File_Upload->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Expenses_Type_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Add_To_Billing->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->approver->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->employee_id->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->modified->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->user_id->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->payment_mode->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->status->FldCaption() ?></td>
		<td valign="top"><?php echo $expenses->Remarks->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$expenses_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$expenses_delete->lRecCnt++;

	// Set row properties
	$expenses->CssClass = "";
	$expenses->CssStyle = "";
	$expenses->RowAttrs = array();
	$expenses->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$expenses_delete->LoadRowValues($rs);

	// Render row
	$expenses_delete->RenderRow();
?>
	<tr<?php echo $expenses->RowAttributes() ?>>
		<td<?php echo $expenses->id->CellAttributes() ?>>
<div<?php echo $expenses->id->ViewAttributes() ?>><?php echo $expenses->id->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Date_Created->CellAttributes() ?>>
<div<?php echo $expenses->Date_Created->ViewAttributes() ?>><?php echo $expenses->Date_Created->ListViewValue() ?></div></td>
		<td<?php echo $expenses->expense_date->CellAttributes() ?>>
<div<?php echo $expenses->expense_date->ViewAttributes() ?>><?php echo $expenses->expense_date->ListViewValue() ?></div></td>
		<td<?php echo $expenses->expense_category_id->CellAttributes() ?>>
<div<?php echo $expenses->expense_category_id->ViewAttributes() ?>><?php echo $expenses->expense_category_id->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Reference_No->CellAttributes() ?>>
<div<?php echo $expenses->Reference_No->ViewAttributes() ?>><?php echo $expenses->Reference_No->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Booking_ID->CellAttributes() ?>>
<div<?php echo $expenses->Booking_ID->ViewAttributes() ?>><?php echo $expenses->Booking_ID->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Description->CellAttributes() ?>>
<div<?php echo $expenses->Description->ViewAttributes() ?>><?php echo $expenses->Description->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Amount->CellAttributes() ?>>
<div<?php echo $expenses->Amount->ViewAttributes() ?>><?php echo $expenses->Amount->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Vat->CellAttributes() ?>>
<div<?php echo $expenses->Vat->ViewAttributes() ?>><?php echo $expenses->Vat->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Total_Sales->CellAttributes() ?>>
<div<?php echo $expenses->Total_Sales->ViewAttributes() ?>><?php echo $expenses->Total_Sales->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Wtax->CellAttributes() ?>>
<div<?php echo $expenses->Wtax->ViewAttributes() ?>><?php echo $expenses->Wtax->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $expenses->Total_Amount_Due->ViewAttributes() ?>><?php echo $expenses->Total_Amount_Due->ListViewValue() ?></div></td>
		<td<?php echo $expenses->File_Upload->CellAttributes() ?>>
<?php if ($expenses->File_Upload->HrefValue <> "" || $expenses->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($expenses->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $expenses->File_Upload->HrefValue ?>"><?php echo $expenses->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($expenses->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($expenses->File_Upload->Upload->DbValue)) { ?>
<?php echo $expenses->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($expenses->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $expenses->Expenses_Type_ID->CellAttributes() ?>>
<div<?php echo $expenses->Expenses_Type_ID->ViewAttributes() ?>><?php echo $expenses->Expenses_Type_ID->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Add_To_Billing->CellAttributes() ?>>
<div<?php echo $expenses->Add_To_Billing->ViewAttributes() ?>><?php echo $expenses->Add_To_Billing->ListViewValue() ?></div></td>
		<td<?php echo $expenses->approver->CellAttributes() ?>>
<div<?php echo $expenses->approver->ViewAttributes() ?>><?php echo $expenses->approver->ListViewValue() ?></div></td>
		<td<?php echo $expenses->employee_id->CellAttributes() ?>>
<div<?php echo $expenses->employee_id->ViewAttributes() ?>><?php echo $expenses->employee_id->ListViewValue() ?></div></td>
		<td<?php echo $expenses->modified->CellAttributes() ?>>
<div<?php echo $expenses->modified->ViewAttributes() ?>><?php echo $expenses->modified->ListViewValue() ?></div></td>
		<td<?php echo $expenses->user_id->CellAttributes() ?>>
<div<?php echo $expenses->user_id->ViewAttributes() ?>><?php echo $expenses->user_id->ListViewValue() ?></div></td>
		<td<?php echo $expenses->payment_mode->CellAttributes() ?>>
<div<?php echo $expenses->payment_mode->ViewAttributes() ?>><?php echo $expenses->payment_mode->ListViewValue() ?></div></td>
		<td<?php echo $expenses->status->CellAttributes() ?>>
<div<?php echo $expenses->status->ViewAttributes() ?>><?php echo $expenses->status->ListViewValue() ?></div></td>
		<td<?php echo $expenses->Remarks->CellAttributes() ?>>
<div<?php echo $expenses->Remarks->ViewAttributes() ?>><?php echo $expenses->Remarks->ListViewValue() ?></div></td>
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
$expenses_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenses_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'expenses';

	// Page object name
	var $PageObjName = 'expenses_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenses;
		if ($expenses->UseTokenInUrl) $PageUrl .= "t=" . $expenses->TableVar . "&"; // Add page token
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
		global $objForm, $expenses;
		if ($expenses->UseTokenInUrl) {
			if ($objForm)
				return ($expenses->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenses->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenses_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expenses)
		$GLOBALS["expenses"] = new cexpenses();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Table object (accounts_receivable)
		$GLOBALS['accounts_receivable'] = new caccounts_receivable();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenses', TRUE);

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
		global $expenses;

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
			$this->Page_Terminate("expenseslist.php");
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
		global $Language, $expenses;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$expenses->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($expenses->id->QueryStringValue))
				$this->Page_Terminate("expenseslist.php"); // Prevent SQL injection, exit
			$sKey .= $expenses->id->QueryStringValue;
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
			$this->Page_Terminate("expenseslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("expenseslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in expenses class, expensesinfo.php

		$expenses->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$expenses->CurrentAction = $_POST["a_delete"];
		} else {
			$expenses->CurrentAction = "I"; // Display record
		}
		switch ($expenses->CurrentAction) {
			case "D": // Delete
				$expenses->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($expenses->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $expenses;
		$DeleteRows = TRUE;
		$sWrkFilter = $expenses->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in expenses class, expensesinfo.php

		$expenses->CurrentFilter = $sWrkFilter;
		$sSql = $expenses->SQL();
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
				$DeleteRows = $expenses->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($expenses->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($expenses->CancelMessage <> "") {
				$this->setMessage($expenses->CancelMessage);
				$expenses->CancelMessage = "";
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
				$expenses->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expenses;

		// Call Recordset Selecting event
		$expenses->Recordset_Selecting($expenses->CurrentFilter);

		// Load List page SQL
		$sSql = $expenses->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expenses->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenses;
		$sFilter = $expenses->KeyFilter();

		// Call Row Selecting event
		$expenses->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenses->CurrentFilter = $sFilter;
		$sSql = $expenses->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$expenses->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expenses;
		$expenses->id->setDbValue($rs->fields('id'));
		$expenses->Date_Created->setDbValue($rs->fields('Date_Created'));
		$expenses->expense_date->setDbValue($rs->fields('expense_date'));
		$expenses->expense_category_id->setDbValue($rs->fields('expense_category_id'));
		$expenses->Reference_No->setDbValue($rs->fields('Reference_No'));
		$expenses->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$expenses->Description->setDbValue($rs->fields('Description'));
		$expenses->Amount->setDbValue($rs->fields('Amount'));
		$expenses->Vat->setDbValue($rs->fields('Vat'));
		$expenses->Total_Sales->setDbValue($rs->fields('Total_Sales'));
		$expenses->Wtax->setDbValue($rs->fields('Wtax'));
		$expenses->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$expenses->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$expenses->Expenses_Type_ID->setDbValue($rs->fields('Expenses_Type_ID'));
		$expenses->Add_To_Billing->setDbValue($rs->fields('Add_To_Billing'));
		$expenses->approver->setDbValue($rs->fields('approver'));
		$expenses->employee_id->setDbValue($rs->fields('employee_id'));
		$expenses->modified->setDbValue($rs->fields('modified'));
		$expenses->user_id->setDbValue($rs->fields('user_id'));
		$expenses->payment_mode->setDbValue($rs->fields('payment_mode'));
		$expenses->status->setDbValue($rs->fields('status'));
		$expenses->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenses;

		// Initialize URLs
		// Call Row_Rendering event

		$expenses->Row_Rendering();

		// Common render codes for all row types
		// id

		$expenses->id->CellCssStyle = ""; $expenses->id->CellCssClass = "";
		$expenses->id->CellAttrs = array(); $expenses->id->ViewAttrs = array(); $expenses->id->EditAttrs = array();

		// Date_Created
		$expenses->Date_Created->CellCssStyle = ""; $expenses->Date_Created->CellCssClass = "";
		$expenses->Date_Created->CellAttrs = array(); $expenses->Date_Created->ViewAttrs = array(); $expenses->Date_Created->EditAttrs = array();

		// expense_date
		$expenses->expense_date->CellCssStyle = ""; $expenses->expense_date->CellCssClass = "";
		$expenses->expense_date->CellAttrs = array(); $expenses->expense_date->ViewAttrs = array(); $expenses->expense_date->EditAttrs = array();

		// expense_category_id
		$expenses->expense_category_id->CellCssStyle = ""; $expenses->expense_category_id->CellCssClass = "";
		$expenses->expense_category_id->CellAttrs = array(); $expenses->expense_category_id->ViewAttrs = array(); $expenses->expense_category_id->EditAttrs = array();

		// Reference_No
		$expenses->Reference_No->CellCssStyle = ""; $expenses->Reference_No->CellCssClass = "";
		$expenses->Reference_No->CellAttrs = array(); $expenses->Reference_No->ViewAttrs = array(); $expenses->Reference_No->EditAttrs = array();

		// Booking_ID
		$expenses->Booking_ID->CellCssStyle = ""; $expenses->Booking_ID->CellCssClass = "";
		$expenses->Booking_ID->CellAttrs = array(); $expenses->Booking_ID->ViewAttrs = array(); $expenses->Booking_ID->EditAttrs = array();

		// Description
		$expenses->Description->CellCssStyle = ""; $expenses->Description->CellCssClass = "";
		$expenses->Description->CellAttrs = array(); $expenses->Description->ViewAttrs = array(); $expenses->Description->EditAttrs = array();

		// Amount
		$expenses->Amount->CellCssStyle = ""; $expenses->Amount->CellCssClass = "";
		$expenses->Amount->CellAttrs = array(); $expenses->Amount->ViewAttrs = array(); $expenses->Amount->EditAttrs = array();

		// Vat
		$expenses->Vat->CellCssStyle = ""; $expenses->Vat->CellCssClass = "";
		$expenses->Vat->CellAttrs = array(); $expenses->Vat->ViewAttrs = array(); $expenses->Vat->EditAttrs = array();

		// Total_Sales
		$expenses->Total_Sales->CellCssStyle = ""; $expenses->Total_Sales->CellCssClass = "";
		$expenses->Total_Sales->CellAttrs = array(); $expenses->Total_Sales->ViewAttrs = array(); $expenses->Total_Sales->EditAttrs = array();

		// Wtax
		$expenses->Wtax->CellCssStyle = ""; $expenses->Wtax->CellCssClass = "";
		$expenses->Wtax->CellAttrs = array(); $expenses->Wtax->ViewAttrs = array(); $expenses->Wtax->EditAttrs = array();

		// Total_Amount_Due
		$expenses->Total_Amount_Due->CellCssStyle = ""; $expenses->Total_Amount_Due->CellCssClass = "";
		$expenses->Total_Amount_Due->CellAttrs = array(); $expenses->Total_Amount_Due->ViewAttrs = array(); $expenses->Total_Amount_Due->EditAttrs = array();

		// File_Upload
		$expenses->File_Upload->CellCssStyle = ""; $expenses->File_Upload->CellCssClass = "";
		$expenses->File_Upload->CellAttrs = array(); $expenses->File_Upload->ViewAttrs = array(); $expenses->File_Upload->EditAttrs = array();

		// Expenses_Type_ID
		$expenses->Expenses_Type_ID->CellCssStyle = ""; $expenses->Expenses_Type_ID->CellCssClass = "";
		$expenses->Expenses_Type_ID->CellAttrs = array(); $expenses->Expenses_Type_ID->ViewAttrs = array(); $expenses->Expenses_Type_ID->EditAttrs = array();

		// Add_To_Billing
		$expenses->Add_To_Billing->CellCssStyle = ""; $expenses->Add_To_Billing->CellCssClass = "";
		$expenses->Add_To_Billing->CellAttrs = array(); $expenses->Add_To_Billing->ViewAttrs = array(); $expenses->Add_To_Billing->EditAttrs = array();

		// approver
		$expenses->approver->CellCssStyle = ""; $expenses->approver->CellCssClass = "";
		$expenses->approver->CellAttrs = array(); $expenses->approver->ViewAttrs = array(); $expenses->approver->EditAttrs = array();

		// employee_id
		$expenses->employee_id->CellCssStyle = ""; $expenses->employee_id->CellCssClass = "";
		$expenses->employee_id->CellAttrs = array(); $expenses->employee_id->ViewAttrs = array(); $expenses->employee_id->EditAttrs = array();

		// modified
		$expenses->modified->CellCssStyle = ""; $expenses->modified->CellCssClass = "";
		$expenses->modified->CellAttrs = array(); $expenses->modified->ViewAttrs = array(); $expenses->modified->EditAttrs = array();

		// user_id
		$expenses->user_id->CellCssStyle = ""; $expenses->user_id->CellCssClass = "";
		$expenses->user_id->CellAttrs = array(); $expenses->user_id->ViewAttrs = array(); $expenses->user_id->EditAttrs = array();

		// payment_mode
		$expenses->payment_mode->CellCssStyle = ""; $expenses->payment_mode->CellCssClass = "";
		$expenses->payment_mode->CellAttrs = array(); $expenses->payment_mode->ViewAttrs = array(); $expenses->payment_mode->EditAttrs = array();

		// status
		$expenses->status->CellCssStyle = ""; $expenses->status->CellCssClass = "";
		$expenses->status->CellAttrs = array(); $expenses->status->ViewAttrs = array(); $expenses->status->EditAttrs = array();

		// Remarks
		$expenses->Remarks->CellCssStyle = ""; $expenses->Remarks->CellCssClass = "";
		$expenses->Remarks->CellAttrs = array(); $expenses->Remarks->ViewAttrs = array(); $expenses->Remarks->EditAttrs = array();
		if ($expenses->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expenses->id->ViewValue = $expenses->id->CurrentValue;
			$expenses->id->CssStyle = "";
			$expenses->id->CssClass = "";
			$expenses->id->ViewCustomAttributes = "";

			// Date_Created
			$expenses->Date_Created->ViewValue = $expenses->Date_Created->CurrentValue;
			$expenses->Date_Created->ViewValue = ew_FormatDateTime($expenses->Date_Created->ViewValue, 6);
			$expenses->Date_Created->CssStyle = "";
			$expenses->Date_Created->CssClass = "";
			$expenses->Date_Created->ViewCustomAttributes = "";

			// expense_date
			$expenses->expense_date->ViewValue = $expenses->expense_date->CurrentValue;
			$expenses->expense_date->ViewValue = ew_FormatDateTime($expenses->expense_date->ViewValue, 6);
			$expenses->expense_date->CssStyle = "";
			$expenses->expense_date->CssClass = "";
			$expenses->expense_date->ViewCustomAttributes = "";

			// expense_category_id
			if (strval($expenses->expense_category_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->expense_category_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `internal_reference`, `category_name` FROM `expense_categories`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `category_name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->expense_category_id->ViewValue = $rswrk->fields('internal_reference');
					$expenses->expense_category_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('category_name');
					$rswrk->Close();
				} else {
					$expenses->expense_category_id->ViewValue = $expenses->expense_category_id->CurrentValue;
				}
			} else {
				$expenses->expense_category_id->ViewValue = NULL;
			}
			$expenses->expense_category_id->CssStyle = "";
			$expenses->expense_category_id->CssClass = "";
			$expenses->expense_category_id->ViewCustomAttributes = "";

			// Reference_No
			$expenses->Reference_No->ViewValue = $expenses->Reference_No->CurrentValue;
			$expenses->Reference_No->CssStyle = "";
			$expenses->Reference_No->CssClass = "";
			$expenses->Reference_No->ViewCustomAttributes = "";

			// Booking_ID
			$expenses->Booking_ID->ViewValue = $expenses->Booking_ID->CurrentValue;
			if (strval($expenses->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$expenses->Booking_ID->ViewValue = $expenses->Booking_ID->CurrentValue;
				}
			} else {
				$expenses->Booking_ID->ViewValue = NULL;
			}
			$expenses->Booking_ID->CssStyle = "";
			$expenses->Booking_ID->CssClass = "";
			$expenses->Booking_ID->ViewCustomAttributes = "";

			// Description
			$expenses->Description->ViewValue = $expenses->Description->CurrentValue;
			$expenses->Description->CssStyle = "";
			$expenses->Description->CssClass = "";
			$expenses->Description->ViewCustomAttributes = "";

			// Amount
			$expenses->Amount->ViewValue = $expenses->Amount->CurrentValue;
			$expenses->Amount->ViewValue = ew_FormatNumber($expenses->Amount->ViewValue, 2, -2, -2, -2);
			$expenses->Amount->CssStyle = "";
			$expenses->Amount->CssClass = "";
			$expenses->Amount->ViewCustomAttributes = "";

			// Vat
			$expenses->Vat->ViewValue = $expenses->Vat->CurrentValue;
			$expenses->Vat->ViewValue = ew_FormatNumber($expenses->Vat->ViewValue, 2, -2, -2, -2);
			$expenses->Vat->CssStyle = "";
			$expenses->Vat->CssClass = "";
			$expenses->Vat->ViewCustomAttributes = "";

			// Total_Sales
			$expenses->Total_Sales->ViewValue = $expenses->Total_Sales->CurrentValue;
			$expenses->Total_Sales->ViewValue = ew_FormatNumber($expenses->Total_Sales->ViewValue, 2, -2, -2, -2);
			$expenses->Total_Sales->CssStyle = "";
			$expenses->Total_Sales->CssClass = "";
			$expenses->Total_Sales->ViewCustomAttributes = "";

			// Wtax
			$expenses->Wtax->ViewValue = $expenses->Wtax->CurrentValue;
			$expenses->Wtax->ViewValue = ew_FormatNumber($expenses->Wtax->ViewValue, 2, -2, -2, -2);
			$expenses->Wtax->CssStyle = "";
			$expenses->Wtax->CssClass = "";
			$expenses->Wtax->ViewCustomAttributes = "";

			// Total_Amount_Due
			$expenses->Total_Amount_Due->ViewValue = $expenses->Total_Amount_Due->CurrentValue;
			$expenses->Total_Amount_Due->ViewValue = ew_FormatNumber($expenses->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$expenses->Total_Amount_Due->CssStyle = "";
			$expenses->Total_Amount_Due->CssClass = "";
			$expenses->Total_Amount_Due->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($expenses->File_Upload->Upload->DbValue)) {
				$expenses->File_Upload->ViewValue = $expenses->File_Upload->Upload->DbValue;
			} else {
				$expenses->File_Upload->ViewValue = "";
			}
			$expenses->File_Upload->CssStyle = "";
			$expenses->File_Upload->CssClass = "";
			$expenses->File_Upload->ViewCustomAttributes = "";

			// Expenses_Type_ID
			if (strval($expenses->Expenses_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->Expenses_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Expenses_Type` FROM `expenses_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->Expenses_Type_ID->ViewValue = $rswrk->fields('Expenses_Type');
					$rswrk->Close();
				} else {
					$expenses->Expenses_Type_ID->ViewValue = $expenses->Expenses_Type_ID->CurrentValue;
				}
			} else {
				$expenses->Expenses_Type_ID->ViewValue = NULL;
			}
			$expenses->Expenses_Type_ID->CssStyle = "";
			$expenses->Expenses_Type_ID->CssClass = "";
			$expenses->Expenses_Type_ID->ViewCustomAttributes = "";

			// Add_To_Billing
			if (strval($expenses->Add_To_Billing->CurrentValue) <> "") {
				switch ($expenses->Add_To_Billing->CurrentValue) {
					case "YES":
						$expenses->Add_To_Billing->ViewValue = "YES";
						break;
					case "NO":
						$expenses->Add_To_Billing->ViewValue = "NO";
						break;
					default:
						$expenses->Add_To_Billing->ViewValue = $expenses->Add_To_Billing->CurrentValue;
				}
			} else {
				$expenses->Add_To_Billing->ViewValue = NULL;
			}
			$expenses->Add_To_Billing->CssStyle = "";
			$expenses->Add_To_Billing->CssClass = "";
			$expenses->Add_To_Billing->ViewCustomAttributes = "";

			// approver
			if (strval($expenses->approver->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->approver->CurrentValue) . "";
			$sSqlWrk = "SELECT `FirstName`, `LastName` FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `FirstName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->approver->ViewValue = $rswrk->fields('FirstName');
					$expenses->approver->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('LastName');
					$rswrk->Close();
				} else {
					$expenses->approver->ViewValue = $expenses->approver->CurrentValue;
				}
			} else {
				$expenses->approver->ViewValue = NULL;
			}
			$expenses->approver->CssStyle = "";
			$expenses->approver->CssClass = "";
			$expenses->approver->ViewCustomAttributes = "";

			// employee_id
			if (strval($expenses->employee_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expenses->employee_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `FirstName`, `LastName` FROM `employees`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `FirstName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenses->employee_id->ViewValue = $rswrk->fields('FirstName');
					$expenses->employee_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('LastName');
					$rswrk->Close();
				} else {
					$expenses->employee_id->ViewValue = $expenses->employee_id->CurrentValue;
				}
			} else {
				$expenses->employee_id->ViewValue = NULL;
			}
			$expenses->employee_id->CssStyle = "";
			$expenses->employee_id->CssClass = "";
			$expenses->employee_id->ViewCustomAttributes = "";

			// modified
			$expenses->modified->ViewValue = $expenses->modified->CurrentValue;
			$expenses->modified->ViewValue = ew_FormatDateTime($expenses->modified->ViewValue, 6);
			$expenses->modified->CssStyle = "";
			$expenses->modified->CssClass = "";
			$expenses->modified->ViewCustomAttributes = "";

			// user_id
			$expenses->user_id->ViewValue = $expenses->user_id->CurrentValue;
			$expenses->user_id->CssStyle = "";
			$expenses->user_id->CssClass = "";
			$expenses->user_id->ViewCustomAttributes = "";

			// payment_mode
			if (strval($expenses->payment_mode->CurrentValue) <> "") {
				switch ($expenses->payment_mode->CurrentValue) {
					case "reimburse":
						$expenses->payment_mode->ViewValue = "Employee (to reimburse)";
						break;
					case "company":
						$expenses->payment_mode->ViewValue = "Company";
						break;
					default:
						$expenses->payment_mode->ViewValue = $expenses->payment_mode->CurrentValue;
				}
			} else {
				$expenses->payment_mode->ViewValue = NULL;
			}
			$expenses->payment_mode->CssStyle = "";
			$expenses->payment_mode->CssClass = "";
			$expenses->payment_mode->ViewCustomAttributes = "";

			// status
			if (strval($expenses->status->CurrentValue) <> "") {
				switch ($expenses->status->CurrentValue) {
					case "for_approval":
						$expenses->status->ViewValue = "For Approval";
						break;
					case "approved":
						$expenses->status->ViewValue = "Approved";
						break;
					case "declined":
						$expenses->status->ViewValue = "Declined";
						break;
					case "done":
						$expenses->status->ViewValue = "Done";
						break;
					default:
						$expenses->status->ViewValue = $expenses->status->CurrentValue;
				}
			} else {
				$expenses->status->ViewValue = NULL;
			}
			$expenses->status->CssStyle = "";
			$expenses->status->CssClass = "";
			$expenses->status->ViewCustomAttributes = "";

			// Remarks
			$expenses->Remarks->ViewValue = $expenses->Remarks->CurrentValue;
			$expenses->Remarks->CssStyle = "";
			$expenses->Remarks->CssClass = "";
			$expenses->Remarks->ViewCustomAttributes = "";

			// id
			$expenses->id->HrefValue = "";
			$expenses->id->TooltipValue = "";

			// Date_Created
			$expenses->Date_Created->HrefValue = "";
			$expenses->Date_Created->TooltipValue = "";

			// expense_date
			$expenses->expense_date->HrefValue = "";
			$expenses->expense_date->TooltipValue = "";

			// expense_category_id
			$expenses->expense_category_id->HrefValue = "";
			$expenses->expense_category_id->TooltipValue = "";

			// Reference_No
			$expenses->Reference_No->HrefValue = "";
			$expenses->Reference_No->TooltipValue = "";

			// Booking_ID
			$expenses->Booking_ID->HrefValue = "";
			$expenses->Booking_ID->TooltipValue = "";

			// Description
			$expenses->Description->HrefValue = "";
			$expenses->Description->TooltipValue = "";

			// Amount
			$expenses->Amount->HrefValue = "";
			$expenses->Amount->TooltipValue = "";

			// Vat
			$expenses->Vat->HrefValue = "";
			$expenses->Vat->TooltipValue = "";

			// Total_Sales
			$expenses->Total_Sales->HrefValue = "";
			$expenses->Total_Sales->TooltipValue = "";

			// Wtax
			$expenses->Wtax->HrefValue = "";
			$expenses->Wtax->TooltipValue = "";

			// Total_Amount_Due
			$expenses->Total_Amount_Due->HrefValue = "";
			$expenses->Total_Amount_Due->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($expenses->File_Upload->Upload->DbValue)) {
				$expenses->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $expenses->File_Upload->UploadPath) . ((!empty($expenses->File_Upload->ViewValue)) ? $expenses->File_Upload->ViewValue : $expenses->File_Upload->CurrentValue);
				if ($expenses->Export <> "") $expenses->File_Upload->HrefValue = ew_ConvertFullUrl($expenses->File_Upload->HrefValue);
			} else {
				$expenses->File_Upload->HrefValue = "";
			}
			$expenses->File_Upload->TooltipValue = "";

			// Expenses_Type_ID
			$expenses->Expenses_Type_ID->HrefValue = "";
			$expenses->Expenses_Type_ID->TooltipValue = "";

			// Add_To_Billing
			$expenses->Add_To_Billing->HrefValue = "";
			$expenses->Add_To_Billing->TooltipValue = "";

			// approver
			$expenses->approver->HrefValue = "";
			$expenses->approver->TooltipValue = "";

			// employee_id
			$expenses->employee_id->HrefValue = "";
			$expenses->employee_id->TooltipValue = "";

			// modified
			$expenses->modified->HrefValue = "";
			$expenses->modified->TooltipValue = "";

			// user_id
			$expenses->user_id->HrefValue = "";
			$expenses->user_id->TooltipValue = "";

			// payment_mode
			$expenses->payment_mode->HrefValue = "";
			$expenses->payment_mode->TooltipValue = "";

			// status
			$expenses->status->HrefValue = "";
			$expenses->status->TooltipValue = "";

			// Remarks
			$expenses->Remarks->HrefValue = "";
			$expenses->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expenses->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenses->Row_Rendered();
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
