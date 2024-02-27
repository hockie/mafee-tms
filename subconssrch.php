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
$subcons_search = new csubcons_search();
$Page =& $subcons_search;

// Page init
$subcons_search->Page_Init();

// Page main
$subcons_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subcons_search = new ew_Page("subcons_search");

// page properties
subcons_search.PageID = "search"; // page ID
subcons_search.FormID = "fsubconssearch"; // form ID
var EW_PAGE_ID = subcons_search.PageID; // for backward compatibility

// extend page with validate function for search
subcons_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subcons->id->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
subcons_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subcons_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subcons_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subcons_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subcons->TableCaption() ?><br><br>
<a href="<?php echo $subcons->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subcons_search->ShowMessage();
?>
<form name="fsubconssearch" id="fsubconssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subcons_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="subcons">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $subcons->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->id->FldCaption() ?></td>
		<td<?php echo $subcons->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $subcons->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $subcons->id->FldTitle() ?>" value="<?php echo $subcons->id->EditValue ?>"<?php echo $subcons->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $subcons->Subcon_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Subcon_ID->FldCaption() ?></td>
		<td<?php echo $subcons->Subcon_ID->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Subcon_ID" id="z_Subcon_ID" value="LIKE"></span></td>
		<td<?php echo $subcons->Subcon_ID->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Subcon_ID" id="x_Subcon_ID" title="<?php echo $subcons->Subcon_ID->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->Subcon_ID->EditValue ?>"<?php echo $subcons->Subcon_ID->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $subcons->Subcon_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Subcon_Name->FldCaption() ?></td>
		<td<?php echo $subcons->Subcon_Name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Subcon_Name" id="z_Subcon_Name" value="LIKE"></span></td>
		<td<?php echo $subcons->Subcon_Name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Subcon_Name" id="x_Subcon_Name" title="<?php echo $subcons->Subcon_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->Subcon_Name->EditValue ?>"<?php echo $subcons->Subcon_Name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $subcons->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Address->FldCaption() ?></td>
		<td<?php echo $subcons->Address->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Address" id="z_Address" value="LIKE"></span></td>
		<td<?php echo $subcons->Address->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Address" id="x_Address" title="<?php echo $subcons->Address->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $subcons->Address->EditValue ?>"<?php echo $subcons->Address->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $subcons->ContactNo->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->ContactNo->FldCaption() ?></td>
		<td<?php echo $subcons->ContactNo->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ContactNo" id="z_ContactNo" value="LIKE"></span></td>
		<td<?php echo $subcons->ContactNo->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ContactNo" id="x_ContactNo" title="<?php echo $subcons->ContactNo->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->ContactNo->EditValue ?>"<?php echo $subcons->ContactNo->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $subcons->Email_Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Email_Address->FldCaption() ?></td>
		<td<?php echo $subcons->Email_Address->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Email_Address" id="z_Email_Address" value="LIKE"></span></td>
		<td<?php echo $subcons->Email_Address->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Email_Address" id="x_Email_Address" title="<?php echo $subcons->Email_Address->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->Email_Address->EditValue ?>"<?php echo $subcons->Email_Address->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $subcons->TIN_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->TIN_No->FldCaption() ?></td>
		<td<?php echo $subcons->TIN_No->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_TIN_No" id="z_TIN_No" value="LIKE"></span></td>
		<td<?php echo $subcons->TIN_No->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_TIN_No" id="x_TIN_No" title="<?php echo $subcons->TIN_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->TIN_No->EditValue ?>"<?php echo $subcons->TIN_No->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $subcons->ContactPerson->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->ContactPerson->FldCaption() ?></td>
		<td<?php echo $subcons->ContactPerson->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ContactPerson" id="z_ContactPerson" value="LIKE"></span></td>
		<td<?php echo $subcons->ContactPerson->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ContactPerson" id="x_ContactPerson" title="<?php echo $subcons->ContactPerson->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $subcons->ContactPerson->EditValue ?>"<?php echo $subcons->ContactPerson->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $subcons->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subcons->Remarks->FldCaption() ?></td>
		<td<?php echo $subcons->Remarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE"></span></td>
		<td<?php echo $subcons->Remarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $subcons->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $subcons->Remarks->EditAttributes() ?>><?php echo $subcons->Remarks->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$subcons_search->Page_Terminate();
?>
<?php

//
// Page class
//
class csubcons_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'subcons';

	// Page object name
	var $PageObjName = 'subcons_search';

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
	function csubcons_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subcons)
		$GLOBALS["subcons"] = new csubcons();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("subconslist.php");
		}

		// Create form object
		$objForm = new cFormObj();

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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $subcons;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$subcons->CurrentAction = $objForm->GetValue("a_search");
			switch ($subcons->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $subcons->UrlParm($sSrchStr);
						$this->Page_Terminate("subconslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$subcons->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $subcons;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $subcons->id); // id
	$this->BuildSearchUrl($sSrchUrl, $subcons->Subcon_ID); // Subcon_ID
	$this->BuildSearchUrl($sSrchUrl, $subcons->Subcon_Name); // Subcon_Name
	$this->BuildSearchUrl($sSrchUrl, $subcons->Address); // Address
	$this->BuildSearchUrl($sSrchUrl, $subcons->ContactNo); // ContactNo
	$this->BuildSearchUrl($sSrchUrl, $subcons->Email_Address); // Email_Address
	$this->BuildSearchUrl($sSrchUrl, $subcons->TIN_No); // TIN_No
	$this->BuildSearchUrl($sSrchUrl, $subcons->ContactPerson); // ContactPerson
	$this->BuildSearchUrl($sSrchUrl, $subcons->Remarks); // Remarks
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $subcons;

		// Load search values
		// id

		$subcons->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$subcons->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// Subcon_ID
		$subcons->Subcon_ID->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Subcon_ID"));
		$subcons->Subcon_ID->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Subcon_ID");

		// Subcon_Name
		$subcons->Subcon_Name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Subcon_Name"));
		$subcons->Subcon_Name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Subcon_Name");

		// Address
		$subcons->Address->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Address"));
		$subcons->Address->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Address");

		// ContactNo
		$subcons->ContactNo->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ContactNo"));
		$subcons->ContactNo->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ContactNo");

		// Email_Address
		$subcons->Email_Address->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Email_Address"));
		$subcons->Email_Address->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Email_Address");

		// TIN_No
		$subcons->TIN_No->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_TIN_No"));
		$subcons->TIN_No->AdvancedSearch->SearchOperator = $objForm->GetValue("z_TIN_No");

		// ContactPerson
		$subcons->ContactPerson->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ContactPerson"));
		$subcons->ContactPerson->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ContactPerson");

		// Remarks
		$subcons->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Remarks"));
		$subcons->Remarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Remarks");
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
		} elseif ($subcons->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$subcons->id->EditCustomAttributes = "";
			$subcons->id->EditValue = ew_HtmlEncode($subcons->id->AdvancedSearch->SearchValue);

			// Subcon_ID
			$subcons->Subcon_ID->EditCustomAttributes = "";
			$subcons->Subcon_ID->EditValue = ew_HtmlEncode($subcons->Subcon_ID->AdvancedSearch->SearchValue);

			// Subcon_Name
			$subcons->Subcon_Name->EditCustomAttributes = "";
			$subcons->Subcon_Name->EditValue = ew_HtmlEncode($subcons->Subcon_Name->AdvancedSearch->SearchValue);

			// Address
			$subcons->Address->EditCustomAttributes = "";
			$subcons->Address->EditValue = ew_HtmlEncode($subcons->Address->AdvancedSearch->SearchValue);

			// ContactNo
			$subcons->ContactNo->EditCustomAttributes = "";
			$subcons->ContactNo->EditValue = ew_HtmlEncode($subcons->ContactNo->AdvancedSearch->SearchValue);

			// Email_Address
			$subcons->Email_Address->EditCustomAttributes = "";
			$subcons->Email_Address->EditValue = ew_HtmlEncode($subcons->Email_Address->AdvancedSearch->SearchValue);

			// TIN_No
			$subcons->TIN_No->EditCustomAttributes = "";
			$subcons->TIN_No->EditValue = ew_HtmlEncode($subcons->TIN_No->AdvancedSearch->SearchValue);

			// ContactPerson
			$subcons->ContactPerson->EditCustomAttributes = "";
			$subcons->ContactPerson->EditValue = ew_HtmlEncode($subcons->ContactPerson->AdvancedSearch->SearchValue);

			// File_Upload
			$subcons->File_Upload->EditCustomAttributes = "";
			if (!ew_Empty($subcons->File_Upload->Upload->DbValue)) {
				$subcons->File_Upload->EditValue = $subcons->File_Upload->Upload->DbValue;
			} else {
				$subcons->File_Upload->EditValue = "";
			}

			// Remarks
			$subcons->Remarks->EditCustomAttributes = "";
			$subcons->Remarks->EditValue = ew_HtmlEncode($subcons->Remarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($subcons->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subcons->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $subcons;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($subcons->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $subcons->id->FldErrMsg();
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $subcons;
		$subcons->id->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_id");
		$subcons->Subcon_ID->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Subcon_ID");
		$subcons->Subcon_Name->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Subcon_Name");
		$subcons->Address->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Address");
		$subcons->ContactNo->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_ContactNo");
		$subcons->Email_Address->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Email_Address");
		$subcons->TIN_No->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_TIN_No");
		$subcons->ContactPerson->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_ContactPerson");
		$subcons->Remarks->AdvancedSearch->SearchValue = $subcons->getAdvancedSearch("x_Remarks");
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
