<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "audittrailinfo.php" ?>
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
$audittrail_search = new caudittrail_search();
$Page =& $audittrail_search;

// Page init
$audittrail_search->Page_Init();

// Page main
$audittrail_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var audittrail_search = new ew_Page("audittrail_search");

// page properties
audittrail_search.PageID = "search"; // page ID
audittrail_search.FormID = "faudittrailsearch"; // form ID
var EW_PAGE_ID = audittrail_search.PageID; // for backward compatibility

// extend page with validate function for search
audittrail_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($audittrail->id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_datetime"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($audittrail->datetime->FldErrMsg()) ?>");

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
audittrail_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
audittrail_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
audittrail_search.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $audittrail->TableCaption() ?><br><br>
<a href="<?php echo $audittrail->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$audittrail_search->ShowMessage();
?>
<form name="faudittrailsearch" id="faudittrailsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return audittrail_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="audittrail">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $audittrail->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->id->FldCaption() ?></td>
		<td<?php echo $audittrail->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $audittrail->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $audittrail->id->FldTitle() ?>" value="<?php echo $audittrail->id->EditValue ?>"<?php echo $audittrail->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->datetime->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->datetime->FldCaption() ?></td>
		<td<?php echo $audittrail->datetime->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_datetime" id="z_datetime" value="="></span></td>
		<td<?php echo $audittrail->datetime->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_datetime" id="x_datetime" title="<?php echo $audittrail->datetime->FldTitle() ?>" value="<?php echo $audittrail->datetime->EditValue ?>"<?php echo $audittrail->datetime->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->script->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->script->FldCaption() ?></td>
		<td<?php echo $audittrail->script->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_script" id="z_script" value="LIKE"></span></td>
		<td<?php echo $audittrail->script->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_script" id="x_script" title="<?php echo $audittrail->script->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->script->EditValue ?>"<?php echo $audittrail->script->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->user->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->user->FldCaption() ?></td>
		<td<?php echo $audittrail->user->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_user" id="z_user" value="LIKE"></span></td>
		<td<?php echo $audittrail->user->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_user" id="x_user" title="<?php echo $audittrail->user->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->user->EditValue ?>"<?php echo $audittrail->user->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->action->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->action->FldCaption() ?></td>
		<td<?php echo $audittrail->action->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_action" id="z_action" value="LIKE"></span></td>
		<td<?php echo $audittrail->action->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_action" id="x_action" title="<?php echo $audittrail->action->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->action->EditValue ?>"<?php echo $audittrail->action->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->table->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->table->FldCaption() ?></td>
		<td<?php echo $audittrail->table->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_table" id="z_table" value="LIKE"></span></td>
		<td<?php echo $audittrail->table->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_table" id="x_table" title="<?php echo $audittrail->table->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->table->EditValue ?>"<?php echo $audittrail->table->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->zfield->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->zfield->FldCaption() ?></td>
		<td<?php echo $audittrail->zfield->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_zfield" id="z_zfield" value="LIKE"></span></td>
		<td<?php echo $audittrail->zfield->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_zfield" id="x_zfield" title="<?php echo $audittrail->zfield->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $audittrail->zfield->EditValue ?>"<?php echo $audittrail->zfield->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->keyvalue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->keyvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->keyvalue->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_keyvalue" id="z_keyvalue" value="LIKE"></span></td>
		<td<?php echo $audittrail->keyvalue->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_keyvalue" id="x_keyvalue" title="<?php echo $audittrail->keyvalue->FldTitle() ?>" cols="35" rows="4"<?php echo $audittrail->keyvalue->EditAttributes() ?>><?php echo $audittrail->keyvalue->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->oldvalue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->oldvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->oldvalue->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_oldvalue" id="z_oldvalue" value="LIKE"></span></td>
		<td<?php echo $audittrail->oldvalue->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_oldvalue" id="x_oldvalue" title="<?php echo $audittrail->oldvalue->FldTitle() ?>" cols="35" rows="4"<?php echo $audittrail->oldvalue->EditAttributes() ?>><?php echo $audittrail->oldvalue->EditValue ?></textarea>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $audittrail->newvalue->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $audittrail->newvalue->FldCaption() ?></td>
		<td<?php echo $audittrail->newvalue->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_newvalue" id="z_newvalue" value="LIKE"></span></td>
		<td<?php echo $audittrail->newvalue->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<textarea name="x_newvalue" id="x_newvalue" title="<?php echo $audittrail->newvalue->FldTitle() ?>" cols="35" rows="4"<?php echo $audittrail->newvalue->EditAttributes() ?>><?php echo $audittrail->newvalue->EditValue ?></textarea>
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
$audittrail_search->Page_Terminate();
?>
<?php

//
// Page class
//
class caudittrail_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'audittrail';

	// Page object name
	var $PageObjName = 'audittrail_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $audittrail;
		if ($audittrail->UseTokenInUrl) $PageUrl .= "t=" . $audittrail->TableVar . "&"; // Add page token
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
		global $objForm, $audittrail;
		if ($audittrail->UseTokenInUrl) {
			if ($objForm)
				return ($audittrail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($audittrail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function caudittrail_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (audittrail)
		$GLOBALS["audittrail"] = new caudittrail();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'audittrail', TRUE);

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
		global $audittrail;

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
			$this->Page_Terminate("audittraillist.php");
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
		global $objForm, $Language, $gsSearchError, $audittrail;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$audittrail->CurrentAction = $objForm->GetValue("a_search");
			switch ($audittrail->CurrentAction) {
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
						$sSrchStr = $audittrail->UrlParm($sSrchStr);
						$this->Page_Terminate("audittraillist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$audittrail->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $audittrail;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $audittrail->id); // id
	$this->BuildSearchUrl($sSrchUrl, $audittrail->datetime); // datetime
	$this->BuildSearchUrl($sSrchUrl, $audittrail->script); // script
	$this->BuildSearchUrl($sSrchUrl, $audittrail->user); // user
	$this->BuildSearchUrl($sSrchUrl, $audittrail->action); // action
	$this->BuildSearchUrl($sSrchUrl, $audittrail->table); // table
	$this->BuildSearchUrl($sSrchUrl, $audittrail->zfield); // field
	$this->BuildSearchUrl($sSrchUrl, $audittrail->keyvalue); // keyvalue
	$this->BuildSearchUrl($sSrchUrl, $audittrail->oldvalue); // oldvalue
	$this->BuildSearchUrl($sSrchUrl, $audittrail->newvalue); // newvalue
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
		global $objForm, $audittrail;

		// Load search values
		// id

		$audittrail->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$audittrail->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// datetime
		$audittrail->datetime->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_datetime"));
		$audittrail->datetime->AdvancedSearch->SearchOperator = $objForm->GetValue("z_datetime");

		// script
		$audittrail->script->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_script"));
		$audittrail->script->AdvancedSearch->SearchOperator = $objForm->GetValue("z_script");

		// user
		$audittrail->user->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_user"));
		$audittrail->user->AdvancedSearch->SearchOperator = $objForm->GetValue("z_user");

		// action
		$audittrail->action->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_action"));
		$audittrail->action->AdvancedSearch->SearchOperator = $objForm->GetValue("z_action");

		// table
		$audittrail->table->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_table"));
		$audittrail->table->AdvancedSearch->SearchOperator = $objForm->GetValue("z_table");

		// field
		$audittrail->zfield->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_zfield"));
		$audittrail->zfield->AdvancedSearch->SearchOperator = $objForm->GetValue("z_zfield");

		// keyvalue
		$audittrail->keyvalue->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_keyvalue"));
		$audittrail->keyvalue->AdvancedSearch->SearchOperator = $objForm->GetValue("z_keyvalue");

		// oldvalue
		$audittrail->oldvalue->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_oldvalue"));
		$audittrail->oldvalue->AdvancedSearch->SearchOperator = $objForm->GetValue("z_oldvalue");

		// newvalue
		$audittrail->newvalue->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_newvalue"));
		$audittrail->newvalue->AdvancedSearch->SearchOperator = $objForm->GetValue("z_newvalue");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $audittrail;

		// Initialize URLs
		// Call Row_Rendering event

		$audittrail->Row_Rendering();

		// Common render codes for all row types
		// id

		$audittrail->id->CellCssStyle = ""; $audittrail->id->CellCssClass = "";
		$audittrail->id->CellAttrs = array(); $audittrail->id->ViewAttrs = array(); $audittrail->id->EditAttrs = array();

		// datetime
		$audittrail->datetime->CellCssStyle = ""; $audittrail->datetime->CellCssClass = "";
		$audittrail->datetime->CellAttrs = array(); $audittrail->datetime->ViewAttrs = array(); $audittrail->datetime->EditAttrs = array();

		// script
		$audittrail->script->CellCssStyle = ""; $audittrail->script->CellCssClass = "";
		$audittrail->script->CellAttrs = array(); $audittrail->script->ViewAttrs = array(); $audittrail->script->EditAttrs = array();

		// user
		$audittrail->user->CellCssStyle = ""; $audittrail->user->CellCssClass = "";
		$audittrail->user->CellAttrs = array(); $audittrail->user->ViewAttrs = array(); $audittrail->user->EditAttrs = array();

		// action
		$audittrail->action->CellCssStyle = ""; $audittrail->action->CellCssClass = "";
		$audittrail->action->CellAttrs = array(); $audittrail->action->ViewAttrs = array(); $audittrail->action->EditAttrs = array();

		// table
		$audittrail->table->CellCssStyle = ""; $audittrail->table->CellCssClass = "";
		$audittrail->table->CellAttrs = array(); $audittrail->table->ViewAttrs = array(); $audittrail->table->EditAttrs = array();

		// field
		$audittrail->zfield->CellCssStyle = ""; $audittrail->zfield->CellCssClass = "";
		$audittrail->zfield->CellAttrs = array(); $audittrail->zfield->ViewAttrs = array(); $audittrail->zfield->EditAttrs = array();

		// keyvalue
		$audittrail->keyvalue->CellCssStyle = ""; $audittrail->keyvalue->CellCssClass = "";
		$audittrail->keyvalue->CellAttrs = array(); $audittrail->keyvalue->ViewAttrs = array(); $audittrail->keyvalue->EditAttrs = array();

		// oldvalue
		$audittrail->oldvalue->CellCssStyle = ""; $audittrail->oldvalue->CellCssClass = "";
		$audittrail->oldvalue->CellAttrs = array(); $audittrail->oldvalue->ViewAttrs = array(); $audittrail->oldvalue->EditAttrs = array();

		// newvalue
		$audittrail->newvalue->CellCssStyle = ""; $audittrail->newvalue->CellCssClass = "";
		$audittrail->newvalue->CellAttrs = array(); $audittrail->newvalue->ViewAttrs = array(); $audittrail->newvalue->EditAttrs = array();
		if ($audittrail->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$audittrail->id->ViewValue = $audittrail->id->CurrentValue;
			$audittrail->id->CssStyle = "";
			$audittrail->id->CssClass = "";
			$audittrail->id->ViewCustomAttributes = "";

			// datetime
			$audittrail->datetime->ViewValue = $audittrail->datetime->CurrentValue;
			$audittrail->datetime->ViewValue = ew_FormatDateTime($audittrail->datetime->ViewValue, 6);
			$audittrail->datetime->CssStyle = "";
			$audittrail->datetime->CssClass = "";
			$audittrail->datetime->ViewCustomAttributes = "";

			// script
			$audittrail->script->ViewValue = $audittrail->script->CurrentValue;
			$audittrail->script->CssStyle = "";
			$audittrail->script->CssClass = "";
			$audittrail->script->ViewCustomAttributes = "";

			// user
			$audittrail->user->ViewValue = $audittrail->user->CurrentValue;
			$audittrail->user->CssStyle = "";
			$audittrail->user->CssClass = "";
			$audittrail->user->ViewCustomAttributes = "";

			// action
			$audittrail->action->ViewValue = $audittrail->action->CurrentValue;
			$audittrail->action->CssStyle = "";
			$audittrail->action->CssClass = "";
			$audittrail->action->ViewCustomAttributes = "";

			// table
			$audittrail->table->ViewValue = $audittrail->table->CurrentValue;
			$audittrail->table->CssStyle = "";
			$audittrail->table->CssClass = "";
			$audittrail->table->ViewCustomAttributes = "";

			// field
			$audittrail->zfield->ViewValue = $audittrail->zfield->CurrentValue;
			$audittrail->zfield->CssStyle = "";
			$audittrail->zfield->CssClass = "";
			$audittrail->zfield->ViewCustomAttributes = "";

			// keyvalue
			$audittrail->keyvalue->ViewValue = $audittrail->keyvalue->CurrentValue;
			$audittrail->keyvalue->CssStyle = "";
			$audittrail->keyvalue->CssClass = "";
			$audittrail->keyvalue->ViewCustomAttributes = "";

			// oldvalue
			$audittrail->oldvalue->ViewValue = $audittrail->oldvalue->CurrentValue;
			$audittrail->oldvalue->CssStyle = "";
			$audittrail->oldvalue->CssClass = "";
			$audittrail->oldvalue->ViewCustomAttributes = "";

			// newvalue
			$audittrail->newvalue->ViewValue = $audittrail->newvalue->CurrentValue;
			$audittrail->newvalue->CssStyle = "";
			$audittrail->newvalue->CssClass = "";
			$audittrail->newvalue->ViewCustomAttributes = "";

			// id
			$audittrail->id->HrefValue = "";
			$audittrail->id->TooltipValue = "";

			// datetime
			$audittrail->datetime->HrefValue = "";
			$audittrail->datetime->TooltipValue = "";

			// script
			$audittrail->script->HrefValue = "";
			$audittrail->script->TooltipValue = "";

			// user
			$audittrail->user->HrefValue = "";
			$audittrail->user->TooltipValue = "";

			// action
			$audittrail->action->HrefValue = "";
			$audittrail->action->TooltipValue = "";

			// table
			$audittrail->table->HrefValue = "";
			$audittrail->table->TooltipValue = "";

			// field
			$audittrail->zfield->HrefValue = "";
			$audittrail->zfield->TooltipValue = "";

			// keyvalue
			$audittrail->keyvalue->HrefValue = "";
			$audittrail->keyvalue->TooltipValue = "";

			// oldvalue
			$audittrail->oldvalue->HrefValue = "";
			$audittrail->oldvalue->TooltipValue = "";

			// newvalue
			$audittrail->newvalue->HrefValue = "";
			$audittrail->newvalue->TooltipValue = "";
		} elseif ($audittrail->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$audittrail->id->EditCustomAttributes = "";
			$audittrail->id->EditValue = ew_HtmlEncode($audittrail->id->AdvancedSearch->SearchValue);

			// datetime
			$audittrail->datetime->EditCustomAttributes = "";
			$audittrail->datetime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($audittrail->datetime->AdvancedSearch->SearchValue, 6), 6));

			// script
			$audittrail->script->EditCustomAttributes = "";
			$audittrail->script->EditValue = ew_HtmlEncode($audittrail->script->AdvancedSearch->SearchValue);

			// user
			$audittrail->user->EditCustomAttributes = "";
			$audittrail->user->EditValue = ew_HtmlEncode($audittrail->user->AdvancedSearch->SearchValue);

			// action
			$audittrail->action->EditCustomAttributes = "";
			$audittrail->action->EditValue = ew_HtmlEncode($audittrail->action->AdvancedSearch->SearchValue);

			// table
			$audittrail->table->EditCustomAttributes = "";
			$audittrail->table->EditValue = ew_HtmlEncode($audittrail->table->AdvancedSearch->SearchValue);

			// field
			$audittrail->zfield->EditCustomAttributes = "";
			$audittrail->zfield->EditValue = ew_HtmlEncode($audittrail->zfield->AdvancedSearch->SearchValue);

			// keyvalue
			$audittrail->keyvalue->EditCustomAttributes = "";
			$audittrail->keyvalue->EditValue = ew_HtmlEncode($audittrail->keyvalue->AdvancedSearch->SearchValue);

			// oldvalue
			$audittrail->oldvalue->EditCustomAttributes = "";
			$audittrail->oldvalue->EditValue = ew_HtmlEncode($audittrail->oldvalue->AdvancedSearch->SearchValue);

			// newvalue
			$audittrail->newvalue->EditCustomAttributes = "";
			$audittrail->newvalue->EditValue = ew_HtmlEncode($audittrail->newvalue->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($audittrail->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$audittrail->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $audittrail;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($audittrail->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $audittrail->id->FldErrMsg();
		}
		if (!ew_CheckUSDate($audittrail->datetime->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $audittrail->datetime->FldErrMsg();
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
		global $audittrail;
		$audittrail->id->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_id");
		$audittrail->datetime->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_datetime");
		$audittrail->script->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_script");
		$audittrail->user->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_user");
		$audittrail->action->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_action");
		$audittrail->table->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_table");
		$audittrail->zfield->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_zfield");
		$audittrail->keyvalue->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_keyvalue");
		$audittrail->oldvalue->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_oldvalue");
		$audittrail->newvalue->AdvancedSearch->SearchValue = $audittrail->getAdvancedSearch("x_newvalue");
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
