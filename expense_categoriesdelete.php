<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "expense_categoriesinfo.php" ?>
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
$expense_categories_delete = new cexpense_categories_delete();
$Page =& $expense_categories_delete;

// Page init
$expense_categories_delete->Page_Init();

// Page main
$expense_categories_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expense_categories_delete = new ew_Page("expense_categories_delete");

// page properties
expense_categories_delete.PageID = "delete"; // page ID
expense_categories_delete.FormID = "fexpense_categoriesdelete"; // form ID
var EW_PAGE_ID = expense_categories_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expense_categories_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expense_categories_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expense_categories_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expense_categories_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $expense_categories_delete->LoadRecordset())
	$expense_categories_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($expense_categories_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$expense_categories_delete->Page_Terminate("expense_categorieslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expense_categories->TableCaption() ?><br><br>
<a href="<?php echo $expense_categories->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$expense_categories_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="expense_categories">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($expense_categories_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $expense_categories->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $expense_categories->id->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->company_id->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->category_name->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->cost->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->internal_reference->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->re_invoice_expenses->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->vendor_taxes->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->customer_taxes->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->created->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->modified->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->user_id->FldCaption() ?></td>
		<td valign="top"><?php echo $expense_categories->remarks->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$expense_categories_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$expense_categories_delete->lRecCnt++;

	// Set row properties
	$expense_categories->CssClass = "";
	$expense_categories->CssStyle = "";
	$expense_categories->RowAttrs = array();
	$expense_categories->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$expense_categories_delete->LoadRowValues($rs);

	// Render row
	$expense_categories_delete->RenderRow();
?>
	<tr<?php echo $expense_categories->RowAttributes() ?>>
		<td<?php echo $expense_categories->id->CellAttributes() ?>>
<div<?php echo $expense_categories->id->ViewAttributes() ?>><?php echo $expense_categories->id->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->company_id->CellAttributes() ?>>
<div<?php echo $expense_categories->company_id->ViewAttributes() ?>><?php echo $expense_categories->company_id->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->category_name->CellAttributes() ?>>
<div<?php echo $expense_categories->category_name->ViewAttributes() ?>><?php echo $expense_categories->category_name->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->cost->CellAttributes() ?>>
<div<?php echo $expense_categories->cost->ViewAttributes() ?>><?php echo $expense_categories->cost->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->internal_reference->CellAttributes() ?>>
<div<?php echo $expense_categories->internal_reference->ViewAttributes() ?>><?php echo $expense_categories->internal_reference->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->re_invoice_expenses->CellAttributes() ?>>
<div<?php echo $expense_categories->re_invoice_expenses->ViewAttributes() ?>><?php echo $expense_categories->re_invoice_expenses->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->vendor_taxes->CellAttributes() ?>>
<div<?php echo $expense_categories->vendor_taxes->ViewAttributes() ?>><?php echo $expense_categories->vendor_taxes->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->customer_taxes->CellAttributes() ?>>
<div<?php echo $expense_categories->customer_taxes->ViewAttributes() ?>><?php echo $expense_categories->customer_taxes->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->created->CellAttributes() ?>>
<div<?php echo $expense_categories->created->ViewAttributes() ?>><?php echo $expense_categories->created->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->modified->CellAttributes() ?>>
<div<?php echo $expense_categories->modified->ViewAttributes() ?>><?php echo $expense_categories->modified->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->user_id->CellAttributes() ?>>
<div<?php echo $expense_categories->user_id->ViewAttributes() ?>><?php echo $expense_categories->user_id->ListViewValue() ?></div></td>
		<td<?php echo $expense_categories->remarks->CellAttributes() ?>>
<div<?php echo $expense_categories->remarks->ViewAttributes() ?>><?php echo $expense_categories->remarks->ListViewValue() ?></div></td>
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
$expense_categories_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpense_categories_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'expense_categories';

	// Page object name
	var $PageObjName = 'expense_categories_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expense_categories;
		if ($expense_categories->UseTokenInUrl) $PageUrl .= "t=" . $expense_categories->TableVar . "&"; // Add page token
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
		global $objForm, $expense_categories;
		if ($expense_categories->UseTokenInUrl) {
			if ($objForm)
				return ($expense_categories->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expense_categories->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpense_categories_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (expense_categories)
		$GLOBALS["expense_categories"] = new cexpense_categories();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expense_categories', TRUE);

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
		global $expense_categories;

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
			$this->Page_Terminate("expense_categorieslist.php");
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
		global $Language, $expense_categories;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$expense_categories->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($expense_categories->id->QueryStringValue))
				$this->Page_Terminate("expense_categorieslist.php"); // Prevent SQL injection, exit
			$sKey .= $expense_categories->id->QueryStringValue;
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
			$this->Page_Terminate("expense_categorieslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("expense_categorieslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in expense_categories class, expense_categoriesinfo.php

		$expense_categories->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$expense_categories->CurrentAction = $_POST["a_delete"];
		} else {
			$expense_categories->CurrentAction = "I"; // Display record
		}
		switch ($expense_categories->CurrentAction) {
			case "D": // Delete
				$expense_categories->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($expense_categories->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $expense_categories;
		$DeleteRows = TRUE;
		$sWrkFilter = $expense_categories->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in expense_categories class, expense_categoriesinfo.php

		$expense_categories->CurrentFilter = $sWrkFilter;
		$sSql = $expense_categories->SQL();
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
				$DeleteRows = $expense_categories->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($expense_categories->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($expense_categories->CancelMessage <> "") {
				$this->setMessage($expense_categories->CancelMessage);
				$expense_categories->CancelMessage = "";
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
				$expense_categories->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expense_categories;

		// Call Recordset Selecting event
		$expense_categories->Recordset_Selecting($expense_categories->CurrentFilter);

		// Load List page SQL
		$sSql = $expense_categories->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expense_categories->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expense_categories;
		$sFilter = $expense_categories->KeyFilter();

		// Call Row Selecting event
		$expense_categories->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expense_categories->CurrentFilter = $sFilter;
		$sSql = $expense_categories->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$expense_categories->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $expense_categories;
		$expense_categories->id->setDbValue($rs->fields('id'));
		$expense_categories->company_id->setDbValue($rs->fields('company_id'));
		$expense_categories->category_name->setDbValue($rs->fields('category_name'));
		$expense_categories->cost->setDbValue($rs->fields('cost'));
		$expense_categories->internal_reference->setDbValue($rs->fields('internal_reference'));
		$expense_categories->re_invoice_expenses->setDbValue($rs->fields('re_invoice_expenses'));
		$expense_categories->vendor_taxes->setDbValue($rs->fields('vendor_taxes'));
		$expense_categories->customer_taxes->setDbValue($rs->fields('customer_taxes'));
		$expense_categories->created->setDbValue($rs->fields('created'));
		$expense_categories->modified->setDbValue($rs->fields('modified'));
		$expense_categories->user_id->setDbValue($rs->fields('user_id'));
		$expense_categories->remarks->setDbValue($rs->fields('remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expense_categories;

		// Initialize URLs
		// Call Row_Rendering event

		$expense_categories->Row_Rendering();

		// Common render codes for all row types
		// id

		$expense_categories->id->CellCssStyle = ""; $expense_categories->id->CellCssClass = "";
		$expense_categories->id->CellAttrs = array(); $expense_categories->id->ViewAttrs = array(); $expense_categories->id->EditAttrs = array();

		// company_id
		$expense_categories->company_id->CellCssStyle = ""; $expense_categories->company_id->CellCssClass = "";
		$expense_categories->company_id->CellAttrs = array(); $expense_categories->company_id->ViewAttrs = array(); $expense_categories->company_id->EditAttrs = array();

		// category_name
		$expense_categories->category_name->CellCssStyle = ""; $expense_categories->category_name->CellCssClass = "";
		$expense_categories->category_name->CellAttrs = array(); $expense_categories->category_name->ViewAttrs = array(); $expense_categories->category_name->EditAttrs = array();

		// cost
		$expense_categories->cost->CellCssStyle = ""; $expense_categories->cost->CellCssClass = "";
		$expense_categories->cost->CellAttrs = array(); $expense_categories->cost->ViewAttrs = array(); $expense_categories->cost->EditAttrs = array();

		// internal_reference
		$expense_categories->internal_reference->CellCssStyle = ""; $expense_categories->internal_reference->CellCssClass = "";
		$expense_categories->internal_reference->CellAttrs = array(); $expense_categories->internal_reference->ViewAttrs = array(); $expense_categories->internal_reference->EditAttrs = array();

		// re_invoice_expenses
		$expense_categories->re_invoice_expenses->CellCssStyle = ""; $expense_categories->re_invoice_expenses->CellCssClass = "";
		$expense_categories->re_invoice_expenses->CellAttrs = array(); $expense_categories->re_invoice_expenses->ViewAttrs = array(); $expense_categories->re_invoice_expenses->EditAttrs = array();

		// vendor_taxes
		$expense_categories->vendor_taxes->CellCssStyle = ""; $expense_categories->vendor_taxes->CellCssClass = "";
		$expense_categories->vendor_taxes->CellAttrs = array(); $expense_categories->vendor_taxes->ViewAttrs = array(); $expense_categories->vendor_taxes->EditAttrs = array();

		// customer_taxes
		$expense_categories->customer_taxes->CellCssStyle = ""; $expense_categories->customer_taxes->CellCssClass = "";
		$expense_categories->customer_taxes->CellAttrs = array(); $expense_categories->customer_taxes->ViewAttrs = array(); $expense_categories->customer_taxes->EditAttrs = array();

		// created
		$expense_categories->created->CellCssStyle = ""; $expense_categories->created->CellCssClass = "";
		$expense_categories->created->CellAttrs = array(); $expense_categories->created->ViewAttrs = array(); $expense_categories->created->EditAttrs = array();

		// modified
		$expense_categories->modified->CellCssStyle = ""; $expense_categories->modified->CellCssClass = "";
		$expense_categories->modified->CellAttrs = array(); $expense_categories->modified->ViewAttrs = array(); $expense_categories->modified->EditAttrs = array();

		// user_id
		$expense_categories->user_id->CellCssStyle = ""; $expense_categories->user_id->CellCssClass = "";
		$expense_categories->user_id->CellAttrs = array(); $expense_categories->user_id->ViewAttrs = array(); $expense_categories->user_id->EditAttrs = array();

		// remarks
		$expense_categories->remarks->CellCssStyle = ""; $expense_categories->remarks->CellCssClass = "";
		$expense_categories->remarks->CellAttrs = array(); $expense_categories->remarks->ViewAttrs = array(); $expense_categories->remarks->EditAttrs = array();
		if ($expense_categories->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$expense_categories->id->ViewValue = $expense_categories->id->CurrentValue;
			$expense_categories->id->CssStyle = "";
			$expense_categories->id->CssClass = "";
			$expense_categories->id->ViewCustomAttributes = "";

			// company_id
			if (strval($expense_categories->company_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($expense_categories->company_id->CurrentValue) . "";
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
					$expense_categories->company_id->ViewValue = $rswrk->fields('Company_Name');
					$rswrk->Close();
				} else {
					$expense_categories->company_id->ViewValue = $expense_categories->company_id->CurrentValue;
				}
			} else {
				$expense_categories->company_id->ViewValue = NULL;
			}
			$expense_categories->company_id->CssStyle = "";
			$expense_categories->company_id->CssClass = "";
			$expense_categories->company_id->ViewCustomAttributes = "";

			// category_name
			$expense_categories->category_name->ViewValue = $expense_categories->category_name->CurrentValue;
			$expense_categories->category_name->CssStyle = "";
			$expense_categories->category_name->CssClass = "";
			$expense_categories->category_name->ViewCustomAttributes = "";

			// cost
			$expense_categories->cost->ViewValue = $expense_categories->cost->CurrentValue;
			$expense_categories->cost->ViewValue = ew_FormatNumber($expense_categories->cost->ViewValue, 2, -2, -2, -2);
			$expense_categories->cost->CssStyle = "";
			$expense_categories->cost->CssClass = "";
			$expense_categories->cost->ViewCustomAttributes = "";

			// internal_reference
			$expense_categories->internal_reference->ViewValue = $expense_categories->internal_reference->CurrentValue;
			$expense_categories->internal_reference->CssStyle = "";
			$expense_categories->internal_reference->CssClass = "";
			$expense_categories->internal_reference->ViewCustomAttributes = "";

			// re_invoice_expenses
			if (strval($expense_categories->re_invoice_expenses->CurrentValue) <> "") {
				switch ($expense_categories->re_invoice_expenses->CurrentValue) {
					case "yes":
						$expense_categories->re_invoice_expenses->ViewValue = "At Invoice";
						break;
					case "no":
						$expense_categories->re_invoice_expenses->ViewValue = "No";
						break;
					default:
						$expense_categories->re_invoice_expenses->ViewValue = $expense_categories->re_invoice_expenses->CurrentValue;
				}
			} else {
				$expense_categories->re_invoice_expenses->ViewValue = NULL;
			}
			$expense_categories->re_invoice_expenses->CssStyle = "";
			$expense_categories->re_invoice_expenses->CssClass = "";
			$expense_categories->re_invoice_expenses->ViewCustomAttributes = "";

			// vendor_taxes
			$expense_categories->vendor_taxes->ViewValue = $expense_categories->vendor_taxes->CurrentValue;
			$expense_categories->vendor_taxes->CssStyle = "";
			$expense_categories->vendor_taxes->CssClass = "";
			$expense_categories->vendor_taxes->ViewCustomAttributes = "";

			// customer_taxes
			$expense_categories->customer_taxes->ViewValue = $expense_categories->customer_taxes->CurrentValue;
			$expense_categories->customer_taxes->CssStyle = "";
			$expense_categories->customer_taxes->CssClass = "";
			$expense_categories->customer_taxes->ViewCustomAttributes = "";

			// created
			$expense_categories->created->ViewValue = $expense_categories->created->CurrentValue;
			$expense_categories->created->ViewValue = ew_FormatDateTime($expense_categories->created->ViewValue, 6);
			$expense_categories->created->CssStyle = "";
			$expense_categories->created->CssClass = "";
			$expense_categories->created->ViewCustomAttributes = "";

			// modified
			$expense_categories->modified->ViewValue = $expense_categories->modified->CurrentValue;
			$expense_categories->modified->ViewValue = ew_FormatDateTime($expense_categories->modified->ViewValue, 6);
			$expense_categories->modified->CssStyle = "";
			$expense_categories->modified->CssClass = "";
			$expense_categories->modified->ViewCustomAttributes = "";

			// user_id
			$expense_categories->user_id->ViewValue = $expense_categories->user_id->CurrentValue;
			$expense_categories->user_id->CssStyle = "";
			$expense_categories->user_id->CssClass = "";
			$expense_categories->user_id->ViewCustomAttributes = "";

			// remarks
			$expense_categories->remarks->ViewValue = $expense_categories->remarks->CurrentValue;
			$expense_categories->remarks->CssStyle = "";
			$expense_categories->remarks->CssClass = "";
			$expense_categories->remarks->ViewCustomAttributes = "";

			// id
			$expense_categories->id->HrefValue = "";
			$expense_categories->id->TooltipValue = "";

			// company_id
			$expense_categories->company_id->HrefValue = "";
			$expense_categories->company_id->TooltipValue = "";

			// category_name
			$expense_categories->category_name->HrefValue = "";
			$expense_categories->category_name->TooltipValue = "";

			// cost
			$expense_categories->cost->HrefValue = "";
			$expense_categories->cost->TooltipValue = "";

			// internal_reference
			$expense_categories->internal_reference->HrefValue = "";
			$expense_categories->internal_reference->TooltipValue = "";

			// re_invoice_expenses
			$expense_categories->re_invoice_expenses->HrefValue = "";
			$expense_categories->re_invoice_expenses->TooltipValue = "";

			// vendor_taxes
			$expense_categories->vendor_taxes->HrefValue = "";
			$expense_categories->vendor_taxes->TooltipValue = "";

			// customer_taxes
			$expense_categories->customer_taxes->HrefValue = "";
			$expense_categories->customer_taxes->TooltipValue = "";

			// created
			$expense_categories->created->HrefValue = "";
			$expense_categories->created->TooltipValue = "";

			// modified
			$expense_categories->modified->HrefValue = "";
			$expense_categories->modified->TooltipValue = "";

			// user_id
			$expense_categories->user_id->HrefValue = "";
			$expense_categories->user_id->TooltipValue = "";

			// remarks
			$expense_categories->remarks->HrefValue = "";
			$expense_categories->remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expense_categories->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expense_categories->Row_Rendered();
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
