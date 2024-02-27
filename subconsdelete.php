<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$subcons_delete = new csubcons_delete();
$Page =& $subcons_delete;

// Page init
$subcons_delete->Page_Init();

// Page main
$subcons_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subcons_delete = new ew_Page("subcons_delete");

// page properties
subcons_delete.PageID = "delete"; // page ID
subcons_delete.FormID = "fsubconsdelete"; // form ID
var EW_PAGE_ID = subcons_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subcons_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subcons_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subcons_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subcons_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $subcons_delete->LoadRecordset())
	$subcons_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($subcons_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$subcons_delete->Page_Terminate("subconslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subcons->TableCaption() ?><br><br>
<a href="<?php echo $subcons->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subcons_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="subcons">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($subcons_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $subcons->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $subcons->id->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->Subcon_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->Subcon_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->Address->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->ContactNo->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->Email_Address->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->TIN_No->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->ContactPerson->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->File_Upload->FldCaption() ?></td>
		<td valign="top"><?php echo $subcons->Remarks->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$subcons_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$subcons_delete->lRecCnt++;

	// Set row properties
	$subcons->CssClass = "";
	$subcons->CssStyle = "";
	$subcons->RowAttrs = array();
	$subcons->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$subcons_delete->LoadRowValues($rs);

	// Render row
	$subcons_delete->RenderRow();
?>
	<tr<?php echo $subcons->RowAttributes() ?>>
		<td<?php echo $subcons->id->CellAttributes() ?>>
<div<?php echo $subcons->id->ViewAttributes() ?>><?php echo $subcons->id->ListViewValue() ?></div></td>
		<td<?php echo $subcons->Subcon_ID->CellAttributes() ?>>
<div<?php echo $subcons->Subcon_ID->ViewAttributes() ?>><?php echo $subcons->Subcon_ID->ListViewValue() ?></div></td>
		<td<?php echo $subcons->Subcon_Name->CellAttributes() ?>>
<div<?php echo $subcons->Subcon_Name->ViewAttributes() ?>><?php echo $subcons->Subcon_Name->ListViewValue() ?></div></td>
		<td<?php echo $subcons->Address->CellAttributes() ?>>
<div<?php echo $subcons->Address->ViewAttributes() ?>><?php echo $subcons->Address->ListViewValue() ?></div></td>
		<td<?php echo $subcons->ContactNo->CellAttributes() ?>>
<div<?php echo $subcons->ContactNo->ViewAttributes() ?>><?php echo $subcons->ContactNo->ListViewValue() ?></div></td>
		<td<?php echo $subcons->Email_Address->CellAttributes() ?>>
<div<?php echo $subcons->Email_Address->ViewAttributes() ?>><?php echo $subcons->Email_Address->ListViewValue() ?></div></td>
		<td<?php echo $subcons->TIN_No->CellAttributes() ?>>
<div<?php echo $subcons->TIN_No->ViewAttributes() ?>><?php echo $subcons->TIN_No->ListViewValue() ?></div></td>
		<td<?php echo $subcons->ContactPerson->CellAttributes() ?>>
<div<?php echo $subcons->ContactPerson->ViewAttributes() ?>><?php echo $subcons->ContactPerson->ListViewValue() ?></div></td>
		<td<?php echo $subcons->File_Upload->CellAttributes() ?>>
<?php if ($subcons->File_Upload->HrefValue <> "" || $subcons->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $subcons->File_Upload->HrefValue ?>"><?php echo $subcons->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<?php echo $subcons->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $subcons->Remarks->CellAttributes() ?>>
<div<?php echo $subcons->Remarks->ViewAttributes() ?>><?php echo $subcons->Remarks->ListViewValue() ?></div></td>
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
$subcons_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csubcons_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'subcons';

	// Page object name
	var $PageObjName = 'subcons_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subcons;
		if ($subcons->UseTokenInUrl) $PageUrl .= "t=" . $subcons->TableVar . "&"; // Add page token
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
		global $objForm, $subcons;
		if ($subcons->UseTokenInUrl) {
			if ($objForm)
				return ($subcons->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subcons->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubcons_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subcons)
		$GLOBALS["subcons"] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subcons', TRUE);

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
		global $subcons;

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
			$this->Page_Terminate("subconslist.php");
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
		global $Language, $subcons;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$subcons->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($subcons->id->QueryStringValue))
				$this->Page_Terminate("subconslist.php"); // Prevent SQL injection, exit
			$sKey .= $subcons->id->QueryStringValue;
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
			$this->Page_Terminate("subconslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("subconslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in subcons class, subconsinfo.php

		$subcons->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$subcons->CurrentAction = $_POST["a_delete"];
		} else {
			$subcons->CurrentAction = "I"; // Display record
		}
		switch ($subcons->CurrentAction) {
			case "D": // Delete
				$subcons->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($subcons->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $subcons;
		$DeleteRows = TRUE;
		$sWrkFilter = $subcons->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in subcons class, subconsinfo.php

		$subcons->CurrentFilter = $sWrkFilter;
		$sSql = $subcons->SQL();
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
				$DeleteRows = $subcons->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($subcons->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($subcons->CancelMessage <> "") {
				$this->setMessage($subcons->CancelMessage);
				$subcons->CancelMessage = "";
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
				$subcons->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subcons;

		// Call Recordset Selecting event
		$subcons->Recordset_Selecting($subcons->CurrentFilter);

		// Load List page SQL
		$sSql = $subcons->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subcons->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subcons;
		$sFilter = $subcons->KeyFilter();

		// Call Row Selecting event
		$subcons->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subcons->CurrentFilter = $sFilter;
		$sSql = $subcons->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subcons->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subcons;
		$subcons->id->setDbValue($rs->fields('id'));
		$subcons->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$subcons->Subcon_Name->setDbValue($rs->fields('Subcon_Name'));
		$subcons->Address->setDbValue($rs->fields('Address'));
		$subcons->ContactNo->setDbValue($rs->fields('ContactNo'));
		$subcons->Email_Address->setDbValue($rs->fields('Email_Address'));
		$subcons->TIN_No->setDbValue($rs->fields('TIN_No'));
		$subcons->ContactPerson->setDbValue($rs->fields('ContactPerson'));
		$subcons->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$subcons->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subcons;

		// Initialize URLs
		// Call Row_Rendering event

		$subcons->Row_Rendering();

		// Common render codes for all row types
		// id

		$subcons->id->CellCssStyle = ""; $subcons->id->CellCssClass = "";
		$subcons->id->CellAttrs = array(); $subcons->id->ViewAttrs = array(); $subcons->id->EditAttrs = array();

		// Subcon_ID
		$subcons->Subcon_ID->CellCssStyle = ""; $subcons->Subcon_ID->CellCssClass = "";
		$subcons->Subcon_ID->CellAttrs = array(); $subcons->Subcon_ID->ViewAttrs = array(); $subcons->Subcon_ID->EditAttrs = array();

		// Subcon_Name
		$subcons->Subcon_Name->CellCssStyle = ""; $subcons->Subcon_Name->CellCssClass = "";
		$subcons->Subcon_Name->CellAttrs = array(); $subcons->Subcon_Name->ViewAttrs = array(); $subcons->Subcon_Name->EditAttrs = array();

		// Address
		$subcons->Address->CellCssStyle = ""; $subcons->Address->CellCssClass = "";
		$subcons->Address->CellAttrs = array(); $subcons->Address->ViewAttrs = array(); $subcons->Address->EditAttrs = array();

		// ContactNo
		$subcons->ContactNo->CellCssStyle = ""; $subcons->ContactNo->CellCssClass = "";
		$subcons->ContactNo->CellAttrs = array(); $subcons->ContactNo->ViewAttrs = array(); $subcons->ContactNo->EditAttrs = array();

		// Email_Address
		$subcons->Email_Address->CellCssStyle = ""; $subcons->Email_Address->CellCssClass = "";
		$subcons->Email_Address->CellAttrs = array(); $subcons->Email_Address->ViewAttrs = array(); $subcons->Email_Address->EditAttrs = array();

		// TIN_No
		$subcons->TIN_No->CellCssStyle = ""; $subcons->TIN_No->CellCssClass = "";
		$subcons->TIN_No->CellAttrs = array(); $subcons->TIN_No->ViewAttrs = array(); $subcons->TIN_No->EditAttrs = array();

		// ContactPerson
		$subcons->ContactPerson->CellCssStyle = ""; $subcons->ContactPerson->CellCssClass = "";
		$subcons->ContactPerson->CellAttrs = array(); $subcons->ContactPerson->ViewAttrs = array(); $subcons->ContactPerson->EditAttrs = array();

		// File_Upload
		$subcons->File_Upload->CellCssStyle = ""; $subcons->File_Upload->CellCssClass = "";
		$subcons->File_Upload->CellAttrs = array(); $subcons->File_Upload->ViewAttrs = array(); $subcons->File_Upload->EditAttrs = array();

		// Remarks
		$subcons->Remarks->CellCssStyle = ""; $subcons->Remarks->CellCssClass = "";
		$subcons->Remarks->CellAttrs = array(); $subcons->Remarks->ViewAttrs = array(); $subcons->Remarks->EditAttrs = array();
		if ($subcons->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$subcons->id->ViewValue = $subcons->id->CurrentValue;
			$subcons->id->CssStyle = "";
			$subcons->id->CssClass = "";
			$subcons->id->ViewCustomAttributes = "";

			// Subcon_ID
			$subcons->Subcon_ID->ViewValue = $subcons->Subcon_ID->CurrentValue;
			$subcons->Subcon_ID->CssStyle = "";
			$subcons->Subcon_ID->CssClass = "";
			$subcons->Subcon_ID->ViewCustomAttributes = "";

			// Subcon_Name
			$subcons->Subcon_Name->ViewValue = $subcons->Subcon_Name->CurrentValue;
			$subcons->Subcon_Name->CssStyle = "";
			$subcons->Subcon_Name->CssClass = "";
			$subcons->Subcon_Name->ViewCustomAttributes = "";

			// Address
			$subcons->Address->ViewValue = $subcons->Address->CurrentValue;
			$subcons->Address->CssStyle = "";
			$subcons->Address->CssClass = "";
			$subcons->Address->ViewCustomAttributes = "";

			// ContactNo
			$subcons->ContactNo->ViewValue = $subcons->ContactNo->CurrentValue;
			$subcons->ContactNo->CssStyle = "";
			$subcons->ContactNo->CssClass = "";
			$subcons->ContactNo->ViewCustomAttributes = "";

			// Email_Address
			$subcons->Email_Address->ViewValue = $subcons->Email_Address->CurrentValue;
			$subcons->Email_Address->CssStyle = "";
			$subcons->Email_Address->CssClass = "";
			$subcons->Email_Address->ViewCustomAttributes = "";

			// TIN_No
			$subcons->TIN_No->ViewValue = $subcons->TIN_No->CurrentValue;
			$subcons->TIN_No->CssStyle = "";
			$subcons->TIN_No->CssClass = "";
			$subcons->TIN_No->ViewCustomAttributes = "";

			// ContactPerson
			$subcons->ContactPerson->ViewValue = $subcons->ContactPerson->CurrentValue;
			$subcons->ContactPerson->CssStyle = "";
			$subcons->ContactPerson->CssClass = "";
			$subcons->ContactPerson->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->ViewValue = $subcons->File_Upload->Upload->DbValue;
			} else {
				$subcons->File_Upload->ViewValue = "";
			}
			$subcons->File_Upload->CssStyle = "";
			$subcons->File_Upload->CssClass = "";
			$subcons->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$subcons->Remarks->ViewValue = $subcons->Remarks->CurrentValue;
			$subcons->Remarks->CssStyle = "";
			$subcons->Remarks->CssClass = "";
			$subcons->Remarks->ViewCustomAttributes = "";

			// id
			$subcons->id->HrefValue = "";
			$subcons->id->TooltipValue = "";

			// Subcon_ID
			$subcons->Subcon_ID->HrefValue = "";
			$subcons->Subcon_ID->TooltipValue = "";

			// Subcon_Name
			$subcons->Subcon_Name->HrefValue = "";
			$subcons->Subcon_Name->TooltipValue = "";

			// Address
			$subcons->Address->HrefValue = "";
			$subcons->Address->TooltipValue = "";

			// ContactNo
			$subcons->ContactNo->HrefValue = "";
			$subcons->ContactNo->TooltipValue = "";

			// Email_Address
			$subcons->Email_Address->HrefValue = "";
			$subcons->Email_Address->TooltipValue = "";

			// TIN_No
			$subcons->TIN_No->HrefValue = "";
			$subcons->TIN_No->TooltipValue = "";

			// ContactPerson
			$subcons->ContactPerson->HrefValue = "";
			$subcons->ContactPerson->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $subcons->File_Upload->UploadPath) . ((!empty($subcons->File_Upload->ViewValue)) ? $subcons->File_Upload->ViewValue : $subcons->File_Upload->CurrentValue);
				if ($subcons->Export <> "") $subcons->File_Upload->HrefValue = ew_ConvertFullUrl($subcons->File_Upload->HrefValue);
			} else {
				$subcons->File_Upload->HrefValue = "";
			}
			$subcons->File_Upload->TooltipValue = "";

			// Remarks
			$subcons->Remarks->HrefValue = "";
			$subcons->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subcons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subcons->Row_Rendered();
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
