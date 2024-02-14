<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "consigneesinfo.php" ?>
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
$consignees_search = new cconsignees_search();
$Page =& $consignees_search;

// Page init
$consignees_search->Page_Init();

// Page main
$consignees_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var consignees_search = new ew_Page("consignees_search");

// page properties
consignees_search.PageID = "search"; // page ID
consignees_search.FormID = "fconsigneessearch"; // form ID
var EW_PAGE_ID = consignees_search.PageID; // for backward compatibility

// extend page with validate function for search
consignees_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($consignees->id->FldErrMsg()) ?>");

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
consignees_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
consignees_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
consignees_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $consignees->TableCaption() ?><br><br>
<a href="<?php echo $consignees->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$consignees_search->ShowMessage();
?>
<form name="fconsigneessearch" id="fconsigneessearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return consignees_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="consignees">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $consignees->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->id->FldCaption() ?></td>
		<td<?php echo $consignees->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $consignees->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $consignees->id->FldTitle() ?>" value="<?php echo $consignees->id->EditValue ?>"<?php echo $consignees->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $consignees->client_id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->client_id->FldCaption() ?></td>
		<td<?php echo $consignees->client_id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_client_id" id="z_client_id" value="="></span></td>
		<td<?php echo $consignees->client_id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_client_id" name="x_client_id" title="<?php echo $consignees->client_id->FldTitle() ?>"<?php echo $consignees->client_id->EditAttributes() ?>>
<?php
if (is_array($consignees->client_id->EditValue)) {
	$arwrk = $consignees->client_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($consignees->client_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $consignees->Customer_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Customer_No->FldCaption() ?></td>
		<td<?php echo $consignees->Customer_No->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Customer_No" id="z_Customer_No" value="LIKE"></span></td>
		<td<?php echo $consignees->Customer_No->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Customer_No" id="x_Customer_No" title="<?php echo $consignees->Customer_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $consignees->Customer_No->EditValue ?>"<?php echo $consignees->Customer_No->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $consignees->Customer_Name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Customer_Name->FldCaption() ?></td>
		<td<?php echo $consignees->Customer_Name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Customer_Name" id="z_Customer_Name" value="LIKE"></span></td>
		<td<?php echo $consignees->Customer_Name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Customer_Name" id="x_Customer_Name" title="<?php echo $consignees->Customer_Name->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $consignees->Customer_Name->EditValue ?>"<?php echo $consignees->Customer_Name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $consignees->Address->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Address->FldCaption() ?></td>
		<td<?php echo $consignees->Address->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Address" id="z_Address" value="LIKE"></span></td>
		<td<?php echo $consignees->Address->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_Address" name="x_Address" title="<?php echo $consignees->Address->FldTitle() ?>"<?php echo $consignees->Address->EditAttributes() ?>>
<?php
if (is_array($consignees->Address->EditValue)) {
	$arwrk = $consignees->Address->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($consignees->Address->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $consignees->Contact_Person->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Contact_Person->FldCaption() ?></td>
		<td<?php echo $consignees->Contact_Person->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Contact_Person" id="z_Contact_Person" value="LIKE"></span></td>
		<td<?php echo $consignees->Contact_Person->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Contact_Person" id="x_Contact_Person" title="<?php echo $consignees->Contact_Person->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $consignees->Contact_Person->EditValue ?>"<?php echo $consignees->Contact_Person->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $consignees->Contact_No->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Contact_No->FldCaption() ?></td>
		<td<?php echo $consignees->Contact_No->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Contact_No" id="z_Contact_No" value="LIKE"></span></td>
		<td<?php echo $consignees->Contact_No->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_Contact_No" id="x_Contact_No" title="<?php echo $consignees->Contact_No->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $consignees->Contact_No->EditValue ?>"<?php echo $consignees->Contact_No->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $consignees->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $consignees->Remarks->FldCaption() ?></td>
		<td<?php echo $consignees->Remarks->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_Remarks" id="z_Remarks" value="LIKE"></span></td>
		<td<?php echo $consignees->Remarks->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $consignees->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $consignees->Remarks->EditAttributes() ?>><?php echo $consignees->Remarks->EditValue ?></textarea>
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
$consignees_search->Page_Terminate();
?>
<?php

//
// Page class
//
class cconsignees_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'consignees';

	// Page object name
	var $PageObjName = 'consignees_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $consignees;
		if ($consignees->UseTokenInUrl) $PageUrl .= "t=" . $consignees->TableVar . "&"; // Add page token
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
		global $objForm, $consignees;
		if ($consignees->UseTokenInUrl) {
			if ($objForm)
				return ($consignees->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($consignees->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cconsignees_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (consignees)
		$GLOBALS["consignees"] = new cconsignees();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'consignees', TRUE);

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
		global $consignees;

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
			$this->Page_Terminate("consigneeslist.php");
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
		global $objForm, $Language, $gsSearchError, $consignees;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$consignees->CurrentAction = $objForm->GetValue("a_search");
			switch ($consignees->CurrentAction) {
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
						$sSrchStr = $consignees->UrlParm($sSrchStr);
						$this->Page_Terminate("consigneeslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$consignees->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $consignees;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $consignees->id); // id
	$this->BuildSearchUrl($sSrchUrl, $consignees->client_id); // client_id
	$this->BuildSearchUrl($sSrchUrl, $consignees->Customer_No); // Customer_No
	$this->BuildSearchUrl($sSrchUrl, $consignees->Customer_Name); // Customer_Name
	$this->BuildSearchUrl($sSrchUrl, $consignees->Address); // Address
	$this->BuildSearchUrl($sSrchUrl, $consignees->Contact_Person); // Contact_Person
	$this->BuildSearchUrl($sSrchUrl, $consignees->Contact_No); // Contact_No
	$this->BuildSearchUrl($sSrchUrl, $consignees->Remarks); // Remarks
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
		global $objForm, $consignees;

		// Load search values
		// id

		$consignees->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$consignees->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// client_id
		$consignees->client_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_client_id"));
		$consignees->client_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_client_id");

		// Customer_No
		$consignees->Customer_No->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Customer_No"));
		$consignees->Customer_No->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Customer_No");

		// Customer_Name
		$consignees->Customer_Name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Customer_Name"));
		$consignees->Customer_Name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Customer_Name");

		// Address
		$consignees->Address->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Address"));
		$consignees->Address->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Address");

		// Contact_Person
		$consignees->Contact_Person->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Contact_Person"));
		$consignees->Contact_Person->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Contact_Person");

		// Contact_No
		$consignees->Contact_No->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Contact_No"));
		$consignees->Contact_No->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Contact_No");

		// Remarks
		$consignees->Remarks->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Remarks"));
		$consignees->Remarks->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Remarks");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $consignees;

		// Initialize URLs
		// Call Row_Rendering event

		$consignees->Row_Rendering();

		// Common render codes for all row types
		// id

		$consignees->id->CellCssStyle = ""; $consignees->id->CellCssClass = "";
		$consignees->id->CellAttrs = array(); $consignees->id->ViewAttrs = array(); $consignees->id->EditAttrs = array();

		// client_id
		$consignees->client_id->CellCssStyle = ""; $consignees->client_id->CellCssClass = "";
		$consignees->client_id->CellAttrs = array(); $consignees->client_id->ViewAttrs = array(); $consignees->client_id->EditAttrs = array();

		// Customer_No
		$consignees->Customer_No->CellCssStyle = ""; $consignees->Customer_No->CellCssClass = "";
		$consignees->Customer_No->CellAttrs = array(); $consignees->Customer_No->ViewAttrs = array(); $consignees->Customer_No->EditAttrs = array();

		// Customer_Name
		$consignees->Customer_Name->CellCssStyle = ""; $consignees->Customer_Name->CellCssClass = "";
		$consignees->Customer_Name->CellAttrs = array(); $consignees->Customer_Name->ViewAttrs = array(); $consignees->Customer_Name->EditAttrs = array();

		// Address
		$consignees->Address->CellCssStyle = ""; $consignees->Address->CellCssClass = "";
		$consignees->Address->CellAttrs = array(); $consignees->Address->ViewAttrs = array(); $consignees->Address->EditAttrs = array();

		// Contact_Person
		$consignees->Contact_Person->CellCssStyle = ""; $consignees->Contact_Person->CellCssClass = "";
		$consignees->Contact_Person->CellAttrs = array(); $consignees->Contact_Person->ViewAttrs = array(); $consignees->Contact_Person->EditAttrs = array();

		// Contact_No
		$consignees->Contact_No->CellCssStyle = ""; $consignees->Contact_No->CellCssClass = "";
		$consignees->Contact_No->CellAttrs = array(); $consignees->Contact_No->ViewAttrs = array(); $consignees->Contact_No->EditAttrs = array();

		// Remarks
		$consignees->Remarks->CellCssStyle = ""; $consignees->Remarks->CellCssClass = "";
		$consignees->Remarks->CellAttrs = array(); $consignees->Remarks->ViewAttrs = array(); $consignees->Remarks->EditAttrs = array();
		if ($consignees->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$consignees->id->ViewValue = $consignees->id->CurrentValue;
			$consignees->id->CssStyle = "";
			$consignees->id->CssClass = "";
			$consignees->id->ViewCustomAttributes = "";

			// client_id
			if (strval($consignees->client_id->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($consignees->client_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->client_id->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$consignees->client_id->ViewValue = $consignees->client_id->CurrentValue;
				}
			} else {
				$consignees->client_id->ViewValue = NULL;
			}
			$consignees->client_id->CssStyle = "";
			$consignees->client_id->CssClass = "";
			$consignees->client_id->ViewCustomAttributes = "";

			// Customer_No
			$consignees->Customer_No->ViewValue = $consignees->Customer_No->CurrentValue;
			$consignees->Customer_No->CssStyle = "";
			$consignees->Customer_No->CssClass = "";
			$consignees->Customer_No->ViewCustomAttributes = "";

			// Customer_Name
			$consignees->Customer_Name->ViewValue = $consignees->Customer_Name->CurrentValue;
			$consignees->Customer_Name->CssStyle = "";
			$consignees->Customer_Name->CssClass = "";
			$consignees->Customer_Name->ViewCustomAttributes = "";

			// Address
			if (strval($consignees->Address->CurrentValue) <> "") {
				$sFilterWrk = "`Destination` = '" . ew_AdjustSql($consignees->Address->CurrentValue) . "'";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$consignees->Address->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$consignees->Address->ViewValue = $consignees->Address->CurrentValue;
				}
			} else {
				$consignees->Address->ViewValue = NULL;
			}
			$consignees->Address->CssStyle = "";
			$consignees->Address->CssClass = "";
			$consignees->Address->ViewCustomAttributes = "";

			// Contact_Person
			$consignees->Contact_Person->ViewValue = $consignees->Contact_Person->CurrentValue;
			$consignees->Contact_Person->CssStyle = "";
			$consignees->Contact_Person->CssClass = "";
			$consignees->Contact_Person->ViewCustomAttributes = "";

			// Contact_No
			$consignees->Contact_No->ViewValue = $consignees->Contact_No->CurrentValue;
			$consignees->Contact_No->CssStyle = "";
			$consignees->Contact_No->CssClass = "";
			$consignees->Contact_No->ViewCustomAttributes = "";

			// Remarks
			$consignees->Remarks->ViewValue = $consignees->Remarks->CurrentValue;
			$consignees->Remarks->CssStyle = "";
			$consignees->Remarks->CssClass = "";
			$consignees->Remarks->ViewCustomAttributes = "";

			// id
			$consignees->id->HrefValue = "";
			$consignees->id->TooltipValue = "";

			// client_id
			$consignees->client_id->HrefValue = "";
			$consignees->client_id->TooltipValue = "";

			// Customer_No
			$consignees->Customer_No->HrefValue = "";
			$consignees->Customer_No->TooltipValue = "";

			// Customer_Name
			$consignees->Customer_Name->HrefValue = "";
			$consignees->Customer_Name->TooltipValue = "";

			// Address
			$consignees->Address->HrefValue = "";
			$consignees->Address->TooltipValue = "";

			// Contact_Person
			$consignees->Contact_Person->HrefValue = "";
			$consignees->Contact_Person->TooltipValue = "";

			// Contact_No
			$consignees->Contact_No->HrefValue = "";
			$consignees->Contact_No->TooltipValue = "";

			// Remarks
			$consignees->Remarks->HrefValue = "";
			$consignees->Remarks->TooltipValue = "";
		} elseif ($consignees->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$consignees->id->EditCustomAttributes = "";
			$consignees->id->EditValue = ew_HtmlEncode($consignees->id->AdvancedSearch->SearchValue);

			// client_id
			$consignees->client_id->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Client_Name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$consignees->client_id->EditValue = $arwrk;

			// Customer_No
			$consignees->Customer_No->EditCustomAttributes = "";
			$consignees->Customer_No->EditValue = ew_HtmlEncode($consignees->Customer_No->AdvancedSearch->SearchValue);

			// Customer_Name
			$consignees->Customer_Name->EditCustomAttributes = "";
			$consignees->Customer_Name->EditValue = ew_HtmlEncode($consignees->Customer_Name->AdvancedSearch->SearchValue);

			// Address
			$consignees->Address->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `Destination`, `Destination`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$consignees->Address->EditValue = $arwrk;

			// Contact_Person
			$consignees->Contact_Person->EditCustomAttributes = "";
			$consignees->Contact_Person->EditValue = ew_HtmlEncode($consignees->Contact_Person->AdvancedSearch->SearchValue);

			// Contact_No
			$consignees->Contact_No->EditCustomAttributes = "";
			$consignees->Contact_No->EditValue = ew_HtmlEncode($consignees->Contact_No->AdvancedSearch->SearchValue);

			// Remarks
			$consignees->Remarks->EditCustomAttributes = "";
			$consignees->Remarks->EditValue = ew_HtmlEncode($consignees->Remarks->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($consignees->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$consignees->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $consignees;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($consignees->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $consignees->id->FldErrMsg();
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
		global $consignees;
		$consignees->id->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_id");
		$consignees->client_id->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_client_id");
		$consignees->Customer_No->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Customer_No");
		$consignees->Customer_Name->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Customer_Name");
		$consignees->Address->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Address");
		$consignees->Contact_Person->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Contact_Person");
		$consignees->Contact_No->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Contact_No");
		$consignees->Remarks->AdvancedSearch->SearchValue = $consignees->getAdvancedSearch("x_Remarks");
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
