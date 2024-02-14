<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$clients_delete = new cclients_delete();
$Page =& $clients_delete;

// Page init
$clients_delete->Page_Init();

// Page main
$clients_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var clients_delete = new ew_Page("clients_delete");

// page properties
clients_delete.PageID = "delete"; // page ID
clients_delete.FormID = "fclientsdelete"; // form ID
var EW_PAGE_ID = clients_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
clients_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
clients_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
clients_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
clients_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $clients_delete->LoadRecordset())
	$clients_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($clients_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$clients_delete->Page_Terminate("clientslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $clients->TableCaption() ?><br><br>
<a href="<?php echo $clients->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$clients_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="clients">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($clients_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $clients->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $clients->id->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->Account_No->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->Alias->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->Client_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->Address->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->Contact_No->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->Email_Address->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->TIN_No->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->Contact_Person->FldCaption() ?></td>
		<td valign="top"><?php echo $clients->File_Upload->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$clients_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$clients_delete->lRecCnt++;

	// Set row properties
	$clients->CssClass = "";
	$clients->CssStyle = "";
	$clients->RowAttrs = array();
	$clients->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$clients_delete->LoadRowValues($rs);

	// Render row
	$clients_delete->RenderRow();
?>
	<tr<?php echo $clients->RowAttributes() ?>>
		<td<?php echo $clients->id->CellAttributes() ?>>
<div<?php echo $clients->id->ViewAttributes() ?>><?php echo $clients->id->ListViewValue() ?></div></td>
		<td<?php echo $clients->Account_No->CellAttributes() ?>>
<div<?php echo $clients->Account_No->ViewAttributes() ?>><?php echo $clients->Account_No->ListViewValue() ?></div></td>
		<td<?php echo $clients->Alias->CellAttributes() ?>>
<div<?php echo $clients->Alias->ViewAttributes() ?>><?php echo $clients->Alias->ListViewValue() ?></div></td>
		<td<?php echo $clients->Client_Name->CellAttributes() ?>>
<div<?php echo $clients->Client_Name->ViewAttributes() ?>><?php echo $clients->Client_Name->ListViewValue() ?></div></td>
		<td<?php echo $clients->Address->CellAttributes() ?>>
<div<?php echo $clients->Address->ViewAttributes() ?>><?php echo $clients->Address->ListViewValue() ?></div></td>
		<td<?php echo $clients->Contact_No->CellAttributes() ?>>
<div<?php echo $clients->Contact_No->ViewAttributes() ?>><?php echo $clients->Contact_No->ListViewValue() ?></div></td>
		<td<?php echo $clients->Email_Address->CellAttributes() ?>>
<div<?php echo $clients->Email_Address->ViewAttributes() ?>><?php echo $clients->Email_Address->ListViewValue() ?></div></td>
		<td<?php echo $clients->TIN_No->CellAttributes() ?>>
<div<?php echo $clients->TIN_No->ViewAttributes() ?>><?php echo $clients->TIN_No->ListViewValue() ?></div></td>
		<td<?php echo $clients->Contact_Person->CellAttributes() ?>>
<div<?php echo $clients->Contact_Person->ViewAttributes() ?>><?php echo $clients->Contact_Person->ListViewValue() ?></div></td>
		<td<?php echo $clients->File_Upload->CellAttributes() ?>>
<?php if ($clients->File_Upload->HrefValue <> "" || $clients->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($clients->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $clients->File_Upload->HrefValue ?>"><?php echo $clients->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($clients->File_Upload->Upload->DbValue)) { ?>
<?php echo $clients->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
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
$clients_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cclients_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'clients';

	// Page object name
	var $PageObjName = 'clients_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $clients;
		if ($clients->UseTokenInUrl) $PageUrl .= "t=" . $clients->TableVar . "&"; // Add page token
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
		global $objForm, $clients;
		if ($clients->UseTokenInUrl) {
			if ($objForm)
				return ($clients->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($clients->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclients_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (clients)
		$GLOBALS["clients"] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'clients', TRUE);

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
		global $clients;

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
			$this->Page_Terminate("clientslist.php");
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
		global $Language, $clients;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$clients->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($clients->id->QueryStringValue))
				$this->Page_Terminate("clientslist.php"); // Prevent SQL injection, exit
			$sKey .= $clients->id->QueryStringValue;
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
			$this->Page_Terminate("clientslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("clientslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in clients class, clientsinfo.php

		$clients->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$clients->CurrentAction = $_POST["a_delete"];
		} else {
			$clients->CurrentAction = "I"; // Display record
		}
		switch ($clients->CurrentAction) {
			case "D": // Delete
				$clients->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($clients->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $clients;
		$DeleteRows = TRUE;
		$sWrkFilter = $clients->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in clients class, clientsinfo.php

		$clients->CurrentFilter = $sWrkFilter;
		$sSql = $clients->SQL();
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
				$DeleteRows = $clients->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($clients->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($clients->CancelMessage <> "") {
				$this->setMessage($clients->CancelMessage);
				$clients->CancelMessage = "";
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
				$clients->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $clients;

		// Call Recordset Selecting event
		$clients->Recordset_Selecting($clients->CurrentFilter);

		// Load List page SQL
		$sSql = $clients->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$clients->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();

		// Call Row Selecting event
		$clients->Row_Selecting($sFilter);

		// Load SQL based on filter
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$clients->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $clients;
		$clients->id->setDbValue($rs->fields('id'));
		$clients->Account_No->setDbValue($rs->fields('Account_No'));
		$clients->Alias->setDbValue($rs->fields('Alias'));
		$clients->Client_Name->setDbValue($rs->fields('Client_Name'));
		$clients->Address->setDbValue($rs->fields('Address'));
		$clients->Contact_No->setDbValue($rs->fields('Contact_No'));
		$clients->Email_Address->setDbValue($rs->fields('Email_Address'));
		$clients->TIN_No->setDbValue($rs->fields('TIN_No'));
		$clients->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$clients->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$clients->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $clients;

		// Initialize URLs
		// Call Row_Rendering event

		$clients->Row_Rendering();

		// Common render codes for all row types
		// id

		$clients->id->CellCssStyle = ""; $clients->id->CellCssClass = "";
		$clients->id->CellAttrs = array(); $clients->id->ViewAttrs = array(); $clients->id->EditAttrs = array();

		// Account_No
		$clients->Account_No->CellCssStyle = ""; $clients->Account_No->CellCssClass = "";
		$clients->Account_No->CellAttrs = array(); $clients->Account_No->ViewAttrs = array(); $clients->Account_No->EditAttrs = array();

		// Alias
		$clients->Alias->CellCssStyle = ""; $clients->Alias->CellCssClass = "";
		$clients->Alias->CellAttrs = array(); $clients->Alias->ViewAttrs = array(); $clients->Alias->EditAttrs = array();

		// Client_Name
		$clients->Client_Name->CellCssStyle = ""; $clients->Client_Name->CellCssClass = "";
		$clients->Client_Name->CellAttrs = array(); $clients->Client_Name->ViewAttrs = array(); $clients->Client_Name->EditAttrs = array();

		// Address
		$clients->Address->CellCssStyle = ""; $clients->Address->CellCssClass = "";
		$clients->Address->CellAttrs = array(); $clients->Address->ViewAttrs = array(); $clients->Address->EditAttrs = array();

		// Contact_No
		$clients->Contact_No->CellCssStyle = ""; $clients->Contact_No->CellCssClass = "";
		$clients->Contact_No->CellAttrs = array(); $clients->Contact_No->ViewAttrs = array(); $clients->Contact_No->EditAttrs = array();

		// Email_Address
		$clients->Email_Address->CellCssStyle = ""; $clients->Email_Address->CellCssClass = "";
		$clients->Email_Address->CellAttrs = array(); $clients->Email_Address->ViewAttrs = array(); $clients->Email_Address->EditAttrs = array();

		// TIN_No
		$clients->TIN_No->CellCssStyle = ""; $clients->TIN_No->CellCssClass = "";
		$clients->TIN_No->CellAttrs = array(); $clients->TIN_No->ViewAttrs = array(); $clients->TIN_No->EditAttrs = array();

		// Contact_Person
		$clients->Contact_Person->CellCssStyle = ""; $clients->Contact_Person->CellCssClass = "";
		$clients->Contact_Person->CellAttrs = array(); $clients->Contact_Person->ViewAttrs = array(); $clients->Contact_Person->EditAttrs = array();

		// File_Upload
		$clients->File_Upload->CellCssStyle = ""; $clients->File_Upload->CellCssClass = "";
		$clients->File_Upload->CellAttrs = array(); $clients->File_Upload->ViewAttrs = array(); $clients->File_Upload->EditAttrs = array();
		if ($clients->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$clients->id->ViewValue = $clients->id->CurrentValue;
			$clients->id->CssStyle = "";
			$clients->id->CssClass = "";
			$clients->id->ViewCustomAttributes = "";

			// Account_No
			$clients->Account_No->ViewValue = $clients->Account_No->CurrentValue;
			$clients->Account_No->CssStyle = "";
			$clients->Account_No->CssClass = "";
			$clients->Account_No->ViewCustomAttributes = "";

			// Alias
			$clients->Alias->ViewValue = $clients->Alias->CurrentValue;
			$clients->Alias->CssStyle = "";
			$clients->Alias->CssClass = "";
			$clients->Alias->ViewCustomAttributes = "";

			// Client_Name
			$clients->Client_Name->ViewValue = $clients->Client_Name->CurrentValue;
			$clients->Client_Name->CssStyle = "";
			$clients->Client_Name->CssClass = "";
			$clients->Client_Name->ViewCustomAttributes = "";

			// Address
			$clients->Address->ViewValue = $clients->Address->CurrentValue;
			$clients->Address->CssStyle = "";
			$clients->Address->CssClass = "";
			$clients->Address->ViewCustomAttributes = "";

			// Contact_No
			$clients->Contact_No->ViewValue = $clients->Contact_No->CurrentValue;
			$clients->Contact_No->CssStyle = "";
			$clients->Contact_No->CssClass = "";
			$clients->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$clients->Email_Address->ViewValue = $clients->Email_Address->CurrentValue;
			$clients->Email_Address->CssStyle = "";
			$clients->Email_Address->CssClass = "";
			$clients->Email_Address->ViewCustomAttributes = "";

			// TIN_No
			$clients->TIN_No->ViewValue = $clients->TIN_No->CurrentValue;
			$clients->TIN_No->CssStyle = "";
			$clients->TIN_No->CssClass = "";
			$clients->TIN_No->ViewCustomAttributes = "";

			// Contact_Person
			$clients->Contact_Person->ViewValue = $clients->Contact_Person->CurrentValue;
			$clients->Contact_Person->CssStyle = "";
			$clients->Contact_Person->CssClass = "";
			$clients->Contact_Person->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->ViewValue = $clients->File_Upload->Upload->DbValue;
			} else {
				$clients->File_Upload->ViewValue = "";
			}
			$clients->File_Upload->CssStyle = "";
			$clients->File_Upload->CssClass = "";
			$clients->File_Upload->ViewCustomAttributes = "";

			// id
			$clients->id->HrefValue = "";
			$clients->id->TooltipValue = "";

			// Account_No
			$clients->Account_No->HrefValue = "";
			$clients->Account_No->TooltipValue = "";

			// Alias
			$clients->Alias->HrefValue = "";
			$clients->Alias->TooltipValue = "";

			// Client_Name
			$clients->Client_Name->HrefValue = "";
			$clients->Client_Name->TooltipValue = "";

			// Address
			$clients->Address->HrefValue = "";
			$clients->Address->TooltipValue = "";

			// Contact_No
			$clients->Contact_No->HrefValue = "";
			$clients->Contact_No->TooltipValue = "";

			// Email_Address
			$clients->Email_Address->HrefValue = "";
			$clients->Email_Address->TooltipValue = "";

			// TIN_No
			$clients->TIN_No->HrefValue = "";
			$clients->TIN_No->TooltipValue = "";

			// Contact_Person
			$clients->Contact_Person->HrefValue = "";
			$clients->Contact_Person->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($clients->File_Upload->Upload->DbValue)) {
				$clients->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $clients->File_Upload->UploadPath) . ((!empty($clients->File_Upload->ViewValue)) ? $clients->File_Upload->ViewValue : $clients->File_Upload->CurrentValue);
				if ($clients->Export <> "") $clients->File_Upload->HrefValue = ew_ConvertFullUrl($clients->File_Upload->HrefValue);
			} else {
				$clients->File_Upload->HrefValue = "";
			}
			$clients->File_Upload->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($clients->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$clients->Row_Rendered();
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
