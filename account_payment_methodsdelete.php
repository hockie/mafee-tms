<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "account_payment_methodsinfo.php" ?>
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
$account_payment_methods_delete = new caccount_payment_methods_delete();
$Page =& $account_payment_methods_delete;

// Page init
$account_payment_methods_delete->Page_Init();

// Page main
$account_payment_methods_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var account_payment_methods_delete = new ew_Page("account_payment_methods_delete");

// page properties
account_payment_methods_delete.PageID = "delete"; // page ID
account_payment_methods_delete.FormID = "faccount_payment_methodsdelete"; // form ID
var EW_PAGE_ID = account_payment_methods_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
account_payment_methods_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
account_payment_methods_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
account_payment_methods_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
account_payment_methods_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $account_payment_methods_delete->LoadRecordset())
	$account_payment_methods_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($account_payment_methods_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$account_payment_methods_delete->Page_Terminate("account_payment_methodslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $account_payment_methods->TableCaption() ?><br><br>
<a href="<?php echo $account_payment_methods->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$account_payment_methods_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="account_payment_methods">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($account_payment_methods_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $account_payment_methods->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $account_payment_methods->id->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payment_methods->Payment_Method->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payment_methods->created->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payment_methods->modified->FldCaption() ?></td>
		<td valign="top"><?php echo $account_payment_methods->User_ID->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$account_payment_methods_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$account_payment_methods_delete->lRecCnt++;

	// Set row properties
	$account_payment_methods->CssClass = "";
	$account_payment_methods->CssStyle = "";
	$account_payment_methods->RowAttrs = array();
	$account_payment_methods->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$account_payment_methods_delete->LoadRowValues($rs);

	// Render row
	$account_payment_methods_delete->RenderRow();
?>
	<tr<?php echo $account_payment_methods->RowAttributes() ?>>
		<td<?php echo $account_payment_methods->id->CellAttributes() ?>>
<div<?php echo $account_payment_methods->id->ViewAttributes() ?>><?php echo $account_payment_methods->id->ListViewValue() ?></div></td>
		<td<?php echo $account_payment_methods->Payment_Method->CellAttributes() ?>>
<div<?php echo $account_payment_methods->Payment_Method->ViewAttributes() ?>><?php echo $account_payment_methods->Payment_Method->ListViewValue() ?></div></td>
		<td<?php echo $account_payment_methods->created->CellAttributes() ?>>
<div<?php echo $account_payment_methods->created->ViewAttributes() ?>><?php echo $account_payment_methods->created->ListViewValue() ?></div></td>
		<td<?php echo $account_payment_methods->modified->CellAttributes() ?>>
<div<?php echo $account_payment_methods->modified->ViewAttributes() ?>><?php echo $account_payment_methods->modified->ListViewValue() ?></div></td>
		<td<?php echo $account_payment_methods->User_ID->CellAttributes() ?>>
<div<?php echo $account_payment_methods->User_ID->ViewAttributes() ?>><?php echo $account_payment_methods->User_ID->ListViewValue() ?></div></td>
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
$account_payment_methods_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class caccount_payment_methods_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'account_payment_methods';

	// Page object name
	var $PageObjName = 'account_payment_methods_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $account_payment_methods;
		if ($account_payment_methods->UseTokenInUrl) $PageUrl .= "t=" . $account_payment_methods->TableVar . "&"; // Add page token
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
		global $objForm, $account_payment_methods;
		if ($account_payment_methods->UseTokenInUrl) {
			if ($objForm)
				return ($account_payment_methods->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($account_payment_methods->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caccount_payment_methods_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (account_payment_methods)
		$GLOBALS["account_payment_methods"] = new caccount_payment_methods();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'account_payment_methods', TRUE);

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
		global $account_payment_methods;

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
			$this->Page_Terminate("account_payment_methodslist.php");
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
		global $Language, $account_payment_methods;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$account_payment_methods->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($account_payment_methods->id->QueryStringValue))
				$this->Page_Terminate("account_payment_methodslist.php"); // Prevent SQL injection, exit
			$sKey .= $account_payment_methods->id->QueryStringValue;
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
			$this->Page_Terminate("account_payment_methodslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("account_payment_methodslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in account_payment_methods class, account_payment_methodsinfo.php

		$account_payment_methods->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$account_payment_methods->CurrentAction = $_POST["a_delete"];
		} else {
			$account_payment_methods->CurrentAction = "I"; // Display record
		}
		switch ($account_payment_methods->CurrentAction) {
			case "D": // Delete
				$account_payment_methods->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($account_payment_methods->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $account_payment_methods;
		$DeleteRows = TRUE;
		$sWrkFilter = $account_payment_methods->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in account_payment_methods class, account_payment_methodsinfo.php

		$account_payment_methods->CurrentFilter = $sWrkFilter;
		$sSql = $account_payment_methods->SQL();
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
				$DeleteRows = $account_payment_methods->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($account_payment_methods->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($account_payment_methods->CancelMessage <> "") {
				$this->setMessage($account_payment_methods->CancelMessage);
				$account_payment_methods->CancelMessage = "";
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
				$account_payment_methods->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $account_payment_methods;

		// Call Recordset Selecting event
		$account_payment_methods->Recordset_Selecting($account_payment_methods->CurrentFilter);

		// Load List page SQL
		$sSql = $account_payment_methods->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$account_payment_methods->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $account_payment_methods;
		$sFilter = $account_payment_methods->KeyFilter();

		// Call Row Selecting event
		$account_payment_methods->Row_Selecting($sFilter);

		// Load SQL based on filter
		$account_payment_methods->CurrentFilter = $sFilter;
		$sSql = $account_payment_methods->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$account_payment_methods->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $account_payment_methods;
		$account_payment_methods->id->setDbValue($rs->fields('id'));
		$account_payment_methods->Payment_Method->setDbValue($rs->fields('Payment_Method'));
		$account_payment_methods->created->setDbValue($rs->fields('created'));
		$account_payment_methods->modified->setDbValue($rs->fields('modified'));
		$account_payment_methods->User_ID->setDbValue($rs->fields('User_ID'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $account_payment_methods;

		// Initialize URLs
		// Call Row_Rendering event

		$account_payment_methods->Row_Rendering();

		// Common render codes for all row types
		// id

		$account_payment_methods->id->CellCssStyle = ""; $account_payment_methods->id->CellCssClass = "";
		$account_payment_methods->id->CellAttrs = array(); $account_payment_methods->id->ViewAttrs = array(); $account_payment_methods->id->EditAttrs = array();

		// Payment_Method
		$account_payment_methods->Payment_Method->CellCssStyle = ""; $account_payment_methods->Payment_Method->CellCssClass = "";
		$account_payment_methods->Payment_Method->CellAttrs = array(); $account_payment_methods->Payment_Method->ViewAttrs = array(); $account_payment_methods->Payment_Method->EditAttrs = array();

		// created
		$account_payment_methods->created->CellCssStyle = ""; $account_payment_methods->created->CellCssClass = "";
		$account_payment_methods->created->CellAttrs = array(); $account_payment_methods->created->ViewAttrs = array(); $account_payment_methods->created->EditAttrs = array();

		// modified
		$account_payment_methods->modified->CellCssStyle = ""; $account_payment_methods->modified->CellCssClass = "";
		$account_payment_methods->modified->CellAttrs = array(); $account_payment_methods->modified->ViewAttrs = array(); $account_payment_methods->modified->EditAttrs = array();

		// User_ID
		$account_payment_methods->User_ID->CellCssStyle = ""; $account_payment_methods->User_ID->CellCssClass = "";
		$account_payment_methods->User_ID->CellAttrs = array(); $account_payment_methods->User_ID->ViewAttrs = array(); $account_payment_methods->User_ID->EditAttrs = array();
		if ($account_payment_methods->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$account_payment_methods->id->ViewValue = $account_payment_methods->id->CurrentValue;
			$account_payment_methods->id->CssStyle = "";
			$account_payment_methods->id->CssClass = "";
			$account_payment_methods->id->ViewCustomAttributes = "";

			// Payment_Method
			$account_payment_methods->Payment_Method->ViewValue = $account_payment_methods->Payment_Method->CurrentValue;
			$account_payment_methods->Payment_Method->CssStyle = "";
			$account_payment_methods->Payment_Method->CssClass = "";
			$account_payment_methods->Payment_Method->ViewCustomAttributes = "";

			// created
			$account_payment_methods->created->ViewValue = $account_payment_methods->created->CurrentValue;
			$account_payment_methods->created->ViewValue = ew_FormatDateTime($account_payment_methods->created->ViewValue, 6);
			$account_payment_methods->created->CssStyle = "";
			$account_payment_methods->created->CssClass = "";
			$account_payment_methods->created->ViewCustomAttributes = "";

			// modified
			$account_payment_methods->modified->ViewValue = $account_payment_methods->modified->CurrentValue;
			$account_payment_methods->modified->ViewValue = ew_FormatDateTime($account_payment_methods->modified->ViewValue, 6);
			$account_payment_methods->modified->CssStyle = "";
			$account_payment_methods->modified->CssClass = "";
			$account_payment_methods->modified->ViewCustomAttributes = "";

			// User_ID
			$account_payment_methods->User_ID->ViewValue = $account_payment_methods->User_ID->CurrentValue;
			$account_payment_methods->User_ID->CssStyle = "";
			$account_payment_methods->User_ID->CssClass = "";
			$account_payment_methods->User_ID->ViewCustomAttributes = "";

			// id
			$account_payment_methods->id->HrefValue = "";
			$account_payment_methods->id->TooltipValue = "";

			// Payment_Method
			$account_payment_methods->Payment_Method->HrefValue = "";
			$account_payment_methods->Payment_Method->TooltipValue = "";

			// created
			$account_payment_methods->created->HrefValue = "";
			$account_payment_methods->created->TooltipValue = "";

			// modified
			$account_payment_methods->modified->HrefValue = "";
			$account_payment_methods->modified->TooltipValue = "";

			// User_ID
			$account_payment_methods->User_ID->HrefValue = "";
			$account_payment_methods->User_ID->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($account_payment_methods->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$account_payment_methods->Row_Rendered();
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
