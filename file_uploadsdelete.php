<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "file_uploadsinfo.php" ?>
<?php include "bookingsinfo.php" ?>
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
$file_uploads_delete = new cfile_uploads_delete();
$Page =& $file_uploads_delete;

// Page init
$file_uploads_delete->Page_Init();

// Page main
$file_uploads_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var file_uploads_delete = new ew_Page("file_uploads_delete");

// page properties
file_uploads_delete.PageID = "delete"; // page ID
file_uploads_delete.FormID = "ffile_uploadsdelete"; // form ID
var EW_PAGE_ID = file_uploads_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
file_uploads_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
file_uploads_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
file_uploads_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
file_uploads_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $file_uploads_delete->LoadRecordset())
	$file_uploads_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($file_uploads_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$file_uploads_delete->Page_Terminate("file_uploadslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $file_uploads->TableCaption() ?><br><br>
<a href="<?php echo $file_uploads->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$file_uploads_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="file_uploads">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($file_uploads_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $file_uploads->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $file_uploads->id->FldCaption() ?></td>
		<td valign="top"><?php echo $file_uploads->Booking_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $file_uploads->Filename->FldCaption() ?></td>
		<td valign="top"><?php echo $file_uploads->File_Type_ID->FldCaption() ?></td>
		<td valign="top"><?php echo $file_uploads->Document_Pages->FldCaption() ?></td>
		<td valign="top"><?php echo $file_uploads->Date_Received_Subcon->FldCaption() ?></td>
		<td valign="top"><?php echo $file_uploads->Date_Submitted_Client->FldCaption() ?></td>
		<td valign="top"><?php echo $file_uploads->Remarks->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$file_uploads_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$file_uploads_delete->lRecCnt++;

	// Set row properties
	$file_uploads->CssClass = "";
	$file_uploads->CssStyle = "";
	$file_uploads->RowAttrs = array();
	$file_uploads->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$file_uploads_delete->LoadRowValues($rs);

	// Render row
	$file_uploads_delete->RenderRow();
?>
	<tr<?php echo $file_uploads->RowAttributes() ?>>
		<td<?php echo $file_uploads->id->CellAttributes() ?>>
<div<?php echo $file_uploads->id->ViewAttributes() ?>><?php echo $file_uploads->id->ListViewValue() ?></div></td>
		<td<?php echo $file_uploads->Booking_ID->CellAttributes() ?>>
<div<?php echo $file_uploads->Booking_ID->ViewAttributes() ?>><?php echo $file_uploads->Booking_ID->ListViewValue() ?></div></td>
		<td<?php echo $file_uploads->Filename->CellAttributes() ?>>
<?php if ($file_uploads->Filename->HrefValue <> "" || $file_uploads->Filename->TooltipValue <> "") { ?>
<?php if (!empty($file_uploads->Filename->Upload->DbValue)) { ?>
<a href="<?php echo $file_uploads->Filename->HrefValue ?>"><?php echo $file_uploads->Filename->ListViewValue() ?></a>
<?php } elseif (!in_array($file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($file_uploads->Filename->Upload->DbValue)) { ?>
<?php echo $file_uploads->Filename->ListViewValue() ?>
<?php } elseif (!in_array($file_uploads->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $file_uploads->File_Type_ID->CellAttributes() ?>>
<div<?php echo $file_uploads->File_Type_ID->ViewAttributes() ?>><?php echo $file_uploads->File_Type_ID->ListViewValue() ?></div></td>
		<td<?php echo $file_uploads->Document_Pages->CellAttributes() ?>>
<div<?php echo $file_uploads->Document_Pages->ViewAttributes() ?>><?php echo $file_uploads->Document_Pages->ListViewValue() ?></div></td>
		<td<?php echo $file_uploads->Date_Received_Subcon->CellAttributes() ?>>
<div<?php echo $file_uploads->Date_Received_Subcon->ViewAttributes() ?>><?php echo $file_uploads->Date_Received_Subcon->ListViewValue() ?></div></td>
		<td<?php echo $file_uploads->Date_Submitted_Client->CellAttributes() ?>>
<div<?php echo $file_uploads->Date_Submitted_Client->ViewAttributes() ?>><?php echo $file_uploads->Date_Submitted_Client->ListViewValue() ?></div></td>
		<td<?php echo $file_uploads->Remarks->CellAttributes() ?>>
<div<?php echo $file_uploads->Remarks->ViewAttributes() ?>><?php echo $file_uploads->Remarks->ListViewValue() ?></div></td>
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
$file_uploads_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cfile_uploads_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'file_uploads';

	// Page object name
	var $PageObjName = 'file_uploads_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $file_uploads;
		if ($file_uploads->UseTokenInUrl) $PageUrl .= "t=" . $file_uploads->TableVar . "&"; // Add page token
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
		global $objForm, $file_uploads;
		if ($file_uploads->UseTokenInUrl) {
			if ($objForm)
				return ($file_uploads->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($file_uploads->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfile_uploads_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (file_uploads)
		$GLOBALS["file_uploads"] = new cfile_uploads();

		// Table object (bookings)
		$GLOBALS['bookings'] = new cbookings();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'file_uploads', TRUE);

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
		global $file_uploads;

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
			$this->Page_Terminate("file_uploadslist.php");
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
		global $Language, $file_uploads;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$file_uploads->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($file_uploads->id->QueryStringValue))
				$this->Page_Terminate("file_uploadslist.php"); // Prevent SQL injection, exit
			$sKey .= $file_uploads->id->QueryStringValue;
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
			$this->Page_Terminate("file_uploadslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("file_uploadslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in file_uploads class, file_uploadsinfo.php

		$file_uploads->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$file_uploads->CurrentAction = $_POST["a_delete"];
		} else {
			$file_uploads->CurrentAction = "I"; // Display record
		}
		switch ($file_uploads->CurrentAction) {
			case "D": // Delete
				$file_uploads->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($file_uploads->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $file_uploads;
		$DeleteRows = TRUE;
		$sWrkFilter = $file_uploads->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in file_uploads class, file_uploadsinfo.php

		$file_uploads->CurrentFilter = $sWrkFilter;
		$sSql = $file_uploads->SQL();
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
				$DeleteRows = $file_uploads->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($file_uploads->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($file_uploads->CancelMessage <> "") {
				$this->setMessage($file_uploads->CancelMessage);
				$file_uploads->CancelMessage = "";
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
				$file_uploads->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $file_uploads;

		// Call Recordset Selecting event
		$file_uploads->Recordset_Selecting($file_uploads->CurrentFilter);

		// Load List page SQL
		$sSql = $file_uploads->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$file_uploads->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $file_uploads;
		$sFilter = $file_uploads->KeyFilter();

		// Call Row Selecting event
		$file_uploads->Row_Selecting($sFilter);

		// Load SQL based on filter
		$file_uploads->CurrentFilter = $sFilter;
		$sSql = $file_uploads->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$file_uploads->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $file_uploads;
		$file_uploads->id->setDbValue($rs->fields('id'));
		$file_uploads->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$file_uploads->Filename->Upload->DbValue = $rs->fields('Filename');
		$file_uploads->File_Type_ID->setDbValue($rs->fields('File_Type_ID'));
		$file_uploads->Document_Pages->setDbValue($rs->fields('Document_Pages'));
		$file_uploads->Date_Received_Subcon->setDbValue($rs->fields('Date_Received_Subcon'));
		$file_uploads->Date_Submitted_Client->setDbValue($rs->fields('Date_Submitted_Client'));
		$file_uploads->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $file_uploads;

		// Initialize URLs
		// Call Row_Rendering event

		$file_uploads->Row_Rendering();

		// Common render codes for all row types
		// id

		$file_uploads->id->CellCssStyle = ""; $file_uploads->id->CellCssClass = "";
		$file_uploads->id->CellAttrs = array(); $file_uploads->id->ViewAttrs = array(); $file_uploads->id->EditAttrs = array();

		// Booking_ID
		$file_uploads->Booking_ID->CellCssStyle = ""; $file_uploads->Booking_ID->CellCssClass = "";
		$file_uploads->Booking_ID->CellAttrs = array(); $file_uploads->Booking_ID->ViewAttrs = array(); $file_uploads->Booking_ID->EditAttrs = array();

		// Filename
		$file_uploads->Filename->CellCssStyle = ""; $file_uploads->Filename->CellCssClass = "";
		$file_uploads->Filename->CellAttrs = array(); $file_uploads->Filename->ViewAttrs = array(); $file_uploads->Filename->EditAttrs = array();

		// File_Type_ID
		$file_uploads->File_Type_ID->CellCssStyle = ""; $file_uploads->File_Type_ID->CellCssClass = "";
		$file_uploads->File_Type_ID->CellAttrs = array(); $file_uploads->File_Type_ID->ViewAttrs = array(); $file_uploads->File_Type_ID->EditAttrs = array();

		// Document_Pages
		$file_uploads->Document_Pages->CellCssStyle = ""; $file_uploads->Document_Pages->CellCssClass = "";
		$file_uploads->Document_Pages->CellAttrs = array(); $file_uploads->Document_Pages->ViewAttrs = array(); $file_uploads->Document_Pages->EditAttrs = array();

		// Date_Received_Subcon
		$file_uploads->Date_Received_Subcon->CellCssStyle = ""; $file_uploads->Date_Received_Subcon->CellCssClass = "";
		$file_uploads->Date_Received_Subcon->CellAttrs = array(); $file_uploads->Date_Received_Subcon->ViewAttrs = array(); $file_uploads->Date_Received_Subcon->EditAttrs = array();

		// Date_Submitted_Client
		$file_uploads->Date_Submitted_Client->CellCssStyle = ""; $file_uploads->Date_Submitted_Client->CellCssClass = "";
		$file_uploads->Date_Submitted_Client->CellAttrs = array(); $file_uploads->Date_Submitted_Client->ViewAttrs = array(); $file_uploads->Date_Submitted_Client->EditAttrs = array();

		// Remarks
		$file_uploads->Remarks->CellCssStyle = ""; $file_uploads->Remarks->CellCssClass = "";
		$file_uploads->Remarks->CellAttrs = array(); $file_uploads->Remarks->ViewAttrs = array(); $file_uploads->Remarks->EditAttrs = array();
		if ($file_uploads->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$file_uploads->id->ViewValue = $file_uploads->id->CurrentValue;
			$file_uploads->id->CssStyle = "";
			$file_uploads->id->CssClass = "";
			$file_uploads->id->ViewCustomAttributes = "";

			// Booking_ID
			if (strval($file_uploads->Booking_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads->Booking_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `Date` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
					$rswrk->Close();
				} else {
					$file_uploads->Booking_ID->ViewValue = $file_uploads->Booking_ID->CurrentValue;
				}
			} else {
				$file_uploads->Booking_ID->ViewValue = NULL;
			}
			$file_uploads->Booking_ID->CssStyle = "";
			$file_uploads->Booking_ID->CssClass = "";
			$file_uploads->Booking_ID->ViewCustomAttributes = "";

			// Filename
			if (!ew_Empty($file_uploads->Filename->Upload->DbValue)) {
				$file_uploads->Filename->ViewValue = $file_uploads->Filename->Upload->DbValue;
			} else {
				$file_uploads->Filename->ViewValue = "";
			}
			$file_uploads->Filename->CssStyle = "";
			$file_uploads->Filename->CssClass = "";
			$file_uploads->Filename->ViewCustomAttributes = "";

			// File_Type_ID
			if (strval($file_uploads->File_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($file_uploads->File_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `File_Type` FROM `file_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `File_Type` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$file_uploads->File_Type_ID->ViewValue = $rswrk->fields('File_Type');
					$rswrk->Close();
				} else {
					$file_uploads->File_Type_ID->ViewValue = $file_uploads->File_Type_ID->CurrentValue;
				}
			} else {
				$file_uploads->File_Type_ID->ViewValue = NULL;
			}
			$file_uploads->File_Type_ID->CssStyle = "";
			$file_uploads->File_Type_ID->CssClass = "";
			$file_uploads->File_Type_ID->ViewCustomAttributes = "";

			// Document_Pages
			$file_uploads->Document_Pages->ViewValue = $file_uploads->Document_Pages->CurrentValue;
			$file_uploads->Document_Pages->CssStyle = "";
			$file_uploads->Document_Pages->CssClass = "";
			$file_uploads->Document_Pages->ViewCustomAttributes = "";

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->ViewValue = $file_uploads->Date_Received_Subcon->CurrentValue;
			$file_uploads->Date_Received_Subcon->ViewValue = ew_FormatDateTime($file_uploads->Date_Received_Subcon->ViewValue, 6);
			$file_uploads->Date_Received_Subcon->CssStyle = "";
			$file_uploads->Date_Received_Subcon->CssClass = "";
			$file_uploads->Date_Received_Subcon->ViewCustomAttributes = "";

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->ViewValue = $file_uploads->Date_Submitted_Client->CurrentValue;
			$file_uploads->Date_Submitted_Client->ViewValue = ew_FormatDateTime($file_uploads->Date_Submitted_Client->ViewValue, 6);
			$file_uploads->Date_Submitted_Client->CssStyle = "";
			$file_uploads->Date_Submitted_Client->CssClass = "";
			$file_uploads->Date_Submitted_Client->ViewCustomAttributes = "";

			// Remarks
			$file_uploads->Remarks->ViewValue = $file_uploads->Remarks->CurrentValue;
			$file_uploads->Remarks->CssStyle = "";
			$file_uploads->Remarks->CssClass = "";
			$file_uploads->Remarks->ViewCustomAttributes = "";

			// id
			$file_uploads->id->HrefValue = "";
			$file_uploads->id->TooltipValue = "";

			// Booking_ID
			$file_uploads->Booking_ID->HrefValue = "";
			$file_uploads->Booking_ID->TooltipValue = "";

			// Filename
			if (!ew_Empty($file_uploads->Filename->Upload->DbValue)) {
				$file_uploads->Filename->HrefValue = ew_UploadPathEx(FALSE, $file_uploads->Filename->UploadPath) . ((!empty($file_uploads->Filename->ViewValue)) ? $file_uploads->Filename->ViewValue : $file_uploads->Filename->CurrentValue);
				if ($file_uploads->Export <> "") $file_uploads->Filename->HrefValue = ew_ConvertFullUrl($file_uploads->Filename->HrefValue);
			} else {
				$file_uploads->Filename->HrefValue = "";
			}
			$file_uploads->Filename->TooltipValue = "";

			// File_Type_ID
			$file_uploads->File_Type_ID->HrefValue = "";
			$file_uploads->File_Type_ID->TooltipValue = "";

			// Document_Pages
			$file_uploads->Document_Pages->HrefValue = "";
			$file_uploads->Document_Pages->TooltipValue = "";

			// Date_Received_Subcon
			$file_uploads->Date_Received_Subcon->HrefValue = "";
			$file_uploads->Date_Received_Subcon->TooltipValue = "";

			// Date_Submitted_Client
			$file_uploads->Date_Submitted_Client->HrefValue = "";
			$file_uploads->Date_Submitted_Client->TooltipValue = "";

			// Remarks
			$file_uploads->Remarks->HrefValue = "";
			$file_uploads->Remarks->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($file_uploads->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$file_uploads->Row_Rendered();
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
