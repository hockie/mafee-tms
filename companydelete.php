<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "companyinfo.php" ?>
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
$company_delete = new ccompany_delete();
$Page =& $company_delete;

// Page init
$company_delete->Page_Init();

// Page main
$company_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var company_delete = new ew_Page("company_delete");

// page properties
company_delete.PageID = "delete"; // page ID
company_delete.FormID = "fcompanydelete"; // form ID
var EW_PAGE_ID = company_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
company_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
company_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
company_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
company_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $company_delete->LoadRecordset())
	$company_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($company_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$company_delete->Page_Terminate("companylist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $company->TableCaption() ?><br><br>
<a href="<?php echo $company->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$company_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="company">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($company_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $company->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $company->id->FldCaption() ?></td>
		<td valign="top"><?php echo $company->Company_Name->FldCaption() ?></td>
		<td valign="top"><?php echo $company->Contact_No->FldCaption() ?></td>
		<td valign="top"><?php echo $company->Email_Address->FldCaption() ?></td>
		<td valign="top"><?php echo $company->Website->FldCaption() ?></td>
		<td valign="top"><?php echo $company->TIN_No->FldCaption() ?></td>
		<td valign="top"><?php echo $company->File_Upload->FldCaption() ?></td>
		<td valign="top"><?php echo $company->Remarks->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$company_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$company_delete->lRecCnt++;

	// Set row properties
	$company->CssClass = "";
	$company->CssStyle = "";
	$company->RowAttrs = array();
	$company->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$company_delete->LoadRowValues($rs);

	// Render row
	$company_delete->RenderRow();
?>
	<tr<?php echo $company->RowAttributes() ?>>
		<td<?php echo $company->id->CellAttributes() ?>>
<div<?php echo $company->id->ViewAttributes() ?>><?php echo $company->id->ListViewValue() ?></div></td>
		<td<?php echo $company->Company_Name->CellAttributes() ?>>
<div<?php echo $company->Company_Name->ViewAttributes() ?>><?php echo $company->Company_Name->ListViewValue() ?></div></td>
		<td<?php echo $company->Contact_No->CellAttributes() ?>>
<div<?php echo $company->Contact_No->ViewAttributes() ?>><?php echo $company->Contact_No->ListViewValue() ?></div></td>
		<td<?php echo $company->Email_Address->CellAttributes() ?>>
<div<?php echo $company->Email_Address->ViewAttributes() ?>><?php echo $company->Email_Address->ListViewValue() ?></div></td>
		<td<?php echo $company->Website->CellAttributes() ?>>
<div<?php echo $company->Website->ViewAttributes() ?>><?php echo $company->Website->ListViewValue() ?></div></td>
		<td<?php echo $company->TIN_No->CellAttributes() ?>>
<div<?php echo $company->TIN_No->ViewAttributes() ?>><?php echo $company->TIN_No->ListViewValue() ?></div></td>
		<td<?php echo $company->File_Upload->CellAttributes() ?>>
<?php if ($company->File_Upload->HrefValue <> "" || $company->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($company->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $company->File_Upload->HrefValue ?>"><?php echo $company->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($company->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($company->File_Upload->Upload->DbValue)) { ?>
<?php echo $company->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($company->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $company->Remarks->CellAttributes() ?>>
<div<?php echo $company->Remarks->ViewAttributes() ?>><?php echo $company->Remarks->ListViewValue() ?></div></td>
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
$company_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccompany_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'company';

	// Page object name
	var $PageObjName = 'company_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $company;
		if ($company->UseTokenInUrl) $PageUrl .= "t=" . $company->TableVar . "&"; // Add page token
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
		global $objForm, $company;
		if ($company->UseTokenInUrl) {
			if ($objForm)
				return ($company->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($company->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccompany_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (company)
		$GLOBALS["company"] = new ccompany();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'company', TRUE);

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
		global $company;

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
			$this->Page_Terminate("companylist.php");
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
		global $Language, $company;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$company->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($company->id->QueryStringValue))
				$this->Page_Terminate("companylist.php"); // Prevent SQL injection, exit
			$sKey .= $company->id->QueryStringValue;
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
			$this->Page_Terminate("companylist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("companylist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in company class, companyinfo.php

		$company->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$company->CurrentAction = $_POST["a_delete"];
		} else {
			$company->CurrentAction = "I"; // Display record
		}
		switch ($company->CurrentAction) {
			case "D": // Delete
				$company->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($company->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $company;
		$DeleteRows = TRUE;
		$sWrkFilter = $company->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in company class, companyinfo.php

		$company->CurrentFilter = $sWrkFilter;
		$sSql = $company->SQL();
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
				$DeleteRows = $company->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($company->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($company->CancelMessage <> "") {
				$this->setMessage($company->CancelMessage);
				$company->CancelMessage = "";
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
				$company->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $company;

		// Call Recordset Selecting event
		$company->Recordset_Selecting($company->CurrentFilter);

		// Load List page SQL
		$sSql = $company->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$company->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $company;
		$sFilter = $company->KeyFilter();

		// Call Row Selecting event
		$company->Row_Selecting($sFilter);

		// Load SQL based on filter
		$company->CurrentFilter = $sFilter;
		$sSql = $company->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$company->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $company;
		$company->id->setDbValue($rs->fields('id'));
		$company->Company_Name->setDbValue($rs->fields('Company_Name'));
		$company->Main_Address->setDbValue($rs->fields('Main_Address'));
		$company->Contact_No->setDbValue($rs->fields('Contact_No'));
		$company->Email_Address->setDbValue($rs->fields('Email_Address'));
		$company->Website->setDbValue($rs->fields('Website'));
		$company->TIN_No->setDbValue($rs->fields('TIN_No'));
		$company->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$company->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $company;

		// Initialize URLs
		// Call Row_Rendering event

		$company->Row_Rendering();

		// Common render codes for all row types
		// id

		$company->id->CellCssStyle = ""; $company->id->CellCssClass = "";
		$company->id->CellAttrs = array(); $company->id->ViewAttrs = array(); $company->id->EditAttrs = array();

		// Company_Name
		$company->Company_Name->CellCssStyle = ""; $company->Company_Name->CellCssClass = "";
		$company->Company_Name->CellAttrs = array(); $company->Company_Name->ViewAttrs = array(); $company->Company_Name->EditAttrs = array();

		// Contact_No
		$company->Contact_No->CellCssStyle = ""; $company->Contact_No->CellCssClass = "";
		$company->Contact_No->CellAttrs = array(); $company->Contact_No->ViewAttrs = array(); $company->Contact_No->EditAttrs = array();

		// Email_Address
		$company->Email_Address->CellCssStyle = ""; $company->Email_Address->CellCssClass = "";
		$company->Email_Address->CellAttrs = array(); $company->Email_Address->ViewAttrs = array(); $company->Email_Address->EditAttrs = array();

		// Website
		$company->Website->CellCssStyle = ""; $company->Website->CellCssClass = "";
		$company->Website->CellAttrs = array(); $company->Website->ViewAttrs = array(); $company->Website->EditAttrs = array();

		// TIN_No
		$company->TIN_No->CellCssStyle = ""; $company->TIN_No->CellCssClass = "";
		$company->TIN_No->CellAttrs = array(); $company->TIN_No->ViewAttrs = array(); $company->TIN_No->EditAttrs = array();

		// File_Upload
		$company->File_Upload->CellCssStyle = ""; $company->File_Upload->CellCssClass = "";
		$company->File_Upload->CellAttrs = array(); $company->File_Upload->ViewAttrs = array(); $company->File_Upload->EditAttrs = array();

		// Remarks
		$company->Remarks->CellCssStyle = ""; $company->Remarks->CellCssClass = "";
		$company->Remarks->CellAttrs = array(); $company->Remarks->ViewAttrs = array(); $company->Remarks->EditAttrs = array();
		if ($company->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$company->id->ViewValue = $company->id->CurrentValue;
			$company->id->CssStyle = "";
			$company->id->CssClass = "";
			$company->id->ViewCustomAttributes = "";

			// Company_Name
			$company->Company_Name->ViewValue = $company->Company_Name->CurrentValue;
			$company->Company_Name->CssStyle = "";
			$company->Company_Name->CssClass = "";
			$company->Company_Name->ViewCustomAttributes = "";

			// Contact_No
			$company->Contact_No->ViewValue = $company->Contact_No->CurrentValue;
			$company->Contact_No->CssStyle = "";
			$company->Contact_No->CssClass = "";
			$company->Contact_No->ViewCustomAttributes = "";

			// Email_Address
			$company->Email_Address->ViewValue = $company->Email_Address->CurrentValue;
			$company->Email_Address->CssStyle = "";
			$company->Email_Address->CssClass = "";
			$company->Email_Address->ViewCustomAttributes = "";

			// Website
			$company->Website->ViewValue = $company->Website->CurrentValue;
			$company->Website->CssStyle = "";
			$company->Website->CssClass = "";
			$company->Website->ViewCustomAttributes = "";

			// TIN_No
			$company->TIN_No->ViewValue = $company->TIN_No->CurrentValue;
			$company->TIN_No->CssStyle = "";
			$company->TIN_No->CssClass = "";
			$company->TIN_No->ViewCustomAttributes = "";

			// File_Upload
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->ViewValue = $company->File_Upload->Upload->DbValue;
			} else {
				$company->File_Upload->ViewValue = "";
			}
			$company->File_Upload->CssStyle = "";
			$company->File_Upload->CssClass = "";
			$company->File_Upload->ViewCustomAttributes = "";

			// Remarks
			$company->Remarks->ViewValue = $company->Remarks->CurrentValue;
			$company->Remarks->CssStyle = "";
			$company->Remarks->CssClass = "";
			$company->Remarks->ViewCustomAttributes = "";

			// id
			$company->id->HrefValue = "";
			$company->id->TooltipValue = "";

			// Company_Name
			$company->Company_Name->HrefValue = "";
			$company->Company_Name->TooltipValue = "";

			// Contact_No
			$company->Contact_No->HrefValue = "";
			$company->Contact_No->TooltipValue = "";

			// Email_Address
			$company->Email_Address->HrefValue = "";
			$company->Email_Address->TooltipValue = "";

			// Website
			$company->Website->HrefValue = "";
			$company->Website->TooltipValue = "";

			// TIN_No
			$company->TIN_No->HrefValue = "";
			$company->TIN_No->TooltipValue = "";

			// File_Upload
			if (!ew_Empty($company->File_Upload->Upload->DbValue)) {
				$company->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $company->File_Upload->UploadPath) . ((!empty($company->File_Upload->ViewValue)) ? $company->File_Upload->ViewValue : $company->File_Upload->CurrentValue);
				if ($company->Export <> "") $company->File_Upload->HrefValue = ew_ConvertFullUrl($company->File_Upload->HrefValue);
			} else {
				$company->File_Upload->HrefValue = "";
			}
			$company->File_Upload->TooltipValue = "";

			// Remarks
			$company->Remarks->HrefValue = "";
			$company->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($company->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$company->Row_Rendered();
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
