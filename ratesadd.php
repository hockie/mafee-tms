<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "ratesinfo.php" ?>
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
$rates_add = new crates_add();
$Page =& $rates_add;

// Page init
$rates_add->Page_Init();

// Page main
$rates_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var rates_add = new ew_Page("rates_add");

// page properties
rates_add.PageID = "add"; // page ID
rates_add.FormID = "fratesadd"; // form ID
var EW_PAGE_ID = rates_add.PageID; // for backward compatibility

// extend page with ValidateForm function
rates_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Date"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Freight_Rate"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Freight_Rate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Vat"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Vat->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_Wtax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($rates->Wtax->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
rates_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
rates_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
rates_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
rates_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $rates->TableCaption() ?><br><br>
<a href="<?php echo $rates->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$rates_add->ShowMessage();
?>
<form name="fratesadd" id="fratesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return rates_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="rates">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($rates->Date->Visible) { // Date ?>
	<tr<?php echo $rates->Date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Date->FldCaption() ?></td>
		<td<?php echo $rates->Date->CellAttributes() ?>><span id="el_Date">
<input type="text" name="x_Date" id="x_Date" title="<?php echo $rates->Date->FldTitle() ?>" value="<?php echo $rates->Date->EditValue ?>"<?php echo $rates->Date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_Date" name="cal_x_Date" alt="<?php echo  $Language->Phrase("PickDate") ?>" style="cursor: pointer; cursor: hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_Date", // input field id
	ifFormat: "%m/%d/%Y", // date format
	button: "cal_x_Date" // button id
});
</script>
</span><?php echo $rates->Date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Client_ID->Visible) { // Client_ID ?>
	<tr<?php echo $rates->Client_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Client_ID->FldCaption() ?></td>
		<td<?php echo $rates->Client_ID->CellAttributes() ?>><span id="el_Client_ID">
<?php if ($rates->Client_ID->getSessionValue() <> "") { ?>
<div<?php echo $rates->Client_ID->ViewAttributes() ?>><?php echo $rates->Client_ID->ViewValue ?></div>
<input type="hidden" id="x_Client_ID" name="x_Client_ID" value="<?php echo ew_HtmlEncode($rates->Client_ID->CurrentValue) ?>">
<?php } else { ?>
<?php $rates->Client_ID->EditAttrs["onchange"] = "ew_UpdateOpt('x_Origin_ID','x_Client_ID',rates_add.ar_x_Origin_ID);ew_UpdateOpt('x_Destination_ID','x_Client_ID',rates_add.ar_x_Destination_ID); " . @$rates->Client_ID->EditAttrs["onchange"]; ?>
<select id="x_Client_ID" name="x_Client_ID" title="<?php echo $rates->Client_ID->FldTitle() ?>"<?php echo $rates->Client_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Client_ID->EditValue)) {
	$arwrk = $rates->Client_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Client_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
</span><?php echo $rates->Client_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Area_ID->Visible) { // Area_ID ?>
	<tr<?php echo $rates->Area_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Area_ID->FldCaption() ?></td>
		<td<?php echo $rates->Area_ID->CellAttributes() ?>><span id="el_Area_ID">
<select id="x_Area_ID" name="x_Area_ID" title="<?php echo $rates->Area_ID->FldTitle() ?>"<?php echo $rates->Area_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Area_ID->EditValue)) {
	$arwrk = $rates->Area_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Area_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $rates->Area_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Origin_ID->Visible) { // Origin_ID ?>
	<tr<?php echo $rates->Origin_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Origin_ID->FldCaption() ?></td>
		<td<?php echo $rates->Origin_ID->CellAttributes() ?>><span id="el_Origin_ID">
<select id="x_Origin_ID" name="x_Origin_ID" title="<?php echo $rates->Origin_ID->FldTitle() ?>"<?php echo $rates->Origin_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Origin_ID->EditValue)) {
	$arwrk = $rates->Origin_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Origin_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$jswrk = "";
if (is_array($rates->Origin_ID->EditValue)) {
	$arwrk = $rates->Origin_ID->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
rates_add.ar_x_Origin_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $rates->Origin_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Destination_ID->Visible) { // Destination_ID ?>
	<tr<?php echo $rates->Destination_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Destination_ID->FldCaption() ?></td>
		<td<?php echo $rates->Destination_ID->CellAttributes() ?>><span id="el_Destination_ID">
<select id="x_Destination_ID" name="x_Destination_ID" title="<?php echo $rates->Destination_ID->FldTitle() ?>"<?php echo $rates->Destination_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Destination_ID->EditValue)) {
	$arwrk = $rates->Destination_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Destination_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$jswrk = "";
if (is_array($rates->Destination_ID->EditValue)) {
	$arwrk = $rates->Destination_ID->EditValue;
	$arwrkcnt = count($arwrk);
	for ($rowcntwrk = 1; $rowcntwrk < $arwrkcnt; $rowcntwrk++) {
		if ($jswrk <> "") $jswrk .= ",";
		$jswrk .= "['" . ew_JsEncode($arwrk[$rowcntwrk][0]) . "',"; // Value
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][1]) . "',"; // Display field 1
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][2]) . "',"; // Display field 2
		$jswrk .= "'" . ew_JsEncode($arwrk[$rowcntwrk][3]) . "']"; // Filter field
	}
}
?>
<script type="text/javascript">
<!--
rates_add.ar_x_Destination_ID = [<?php echo $jswrk ?>];

//-->
</script>
</span><?php echo $rates->Destination_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Distance->Visible) { // Distance ?>
	<tr<?php echo $rates->Distance->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Distance->FldCaption() ?></td>
		<td<?php echo $rates->Distance->CellAttributes() ?>><span id="el_Distance">
<input type="text" name="x_Distance" id="x_Distance" title="<?php echo $rates->Distance->FldTitle() ?>" size="30" maxlength="45" value="<?php echo $rates->Distance->EditValue ?>"<?php echo $rates->Distance->EditAttributes() ?>>
</span><?php echo $rates->Distance->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Truck_Type_ID->Visible) { // Truck_Type_ID ?>
	<tr<?php echo $rates->Truck_Type_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Truck_Type_ID->FldCaption() ?></td>
		<td<?php echo $rates->Truck_Type_ID->CellAttributes() ?>><span id="el_Truck_Type_ID">
<select id="x_Truck_Type_ID" name="x_Truck_Type_ID" title="<?php echo $rates->Truck_Type_ID->FldTitle() ?>"<?php echo $rates->Truck_Type_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Truck_Type_ID->EditValue)) {
	$arwrk = $rates->Truck_Type_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Truck_Type_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $rates->Truck_Type_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Unit_ID->Visible) { // Unit_ID ?>
	<tr<?php echo $rates->Unit_ID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Unit_ID->FldCaption() ?></td>
		<td<?php echo $rates->Unit_ID->CellAttributes() ?>><span id="el_Unit_ID">
<select id="x_Unit_ID" name="x_Unit_ID" title="<?php echo $rates->Unit_ID->FldTitle() ?>"<?php echo $rates->Unit_ID->EditAttributes() ?>>
<?php
if (is_array($rates->Unit_ID->EditValue)) {
	$arwrk = $rates->Unit_ID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($rates->Unit_ID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $rates->Unit_ID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Freight_Rate->Visible) { // Freight_Rate ?>
	<tr<?php echo $rates->Freight_Rate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Freight_Rate->FldCaption() ?></td>
		<td<?php echo $rates->Freight_Rate->CellAttributes() ?>><span id="el_Freight_Rate">
<input type="text" name="x_Freight_Rate" id="x_Freight_Rate" title="<?php echo $rates->Freight_Rate->FldTitle() ?>" size="30" value="<?php echo $rates->Freight_Rate->EditValue ?>"<?php echo $rates->Freight_Rate->EditAttributes() ?>>
</span><?php echo $rates->Freight_Rate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Vat->Visible) { // Vat ?>
	<tr<?php echo $rates->Vat->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Vat->FldCaption() ?></td>
		<td<?php echo $rates->Vat->CellAttributes() ?>><span id="el_Vat">
<input type="text" name="x_Vat" id="x_Vat" title="<?php echo $rates->Vat->FldTitle() ?>" size="30" maxlength="5" value="<?php echo $rates->Vat->EditValue ?>"<?php echo $rates->Vat->EditAttributes() ?>>
</span><?php echo $rates->Vat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Wtax->Visible) { // Wtax ?>
	<tr<?php echo $rates->Wtax->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Wtax->FldCaption() ?></td>
		<td<?php echo $rates->Wtax->CellAttributes() ?>><span id="el_Wtax">
<input type="text" name="x_Wtax" id="x_Wtax" title="<?php echo $rates->Wtax->FldTitle() ?>" size="30" value="<?php echo $rates->Wtax->EditValue ?>"<?php echo $rates->Wtax->EditAttributes() ?>>
</span><?php echo $rates->Wtax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($rates->Remarks->Visible) { // Remarks ?>
	<tr<?php echo $rates->Remarks->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $rates->Remarks->FldCaption() ?></td>
		<td<?php echo $rates->Remarks->CellAttributes() ?>><span id="el_Remarks">
<textarea name="x_Remarks" id="x_Remarks" title="<?php echo $rates->Remarks->FldTitle() ?>" cols="35" rows="4"<?php echo $rates->Remarks->EditAttributes() ?>><?php echo $rates->Remarks->EditValue ?></textarea>
</span><?php echo $rates->Remarks->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_Origin_ID','x_Client_ID',rates_add.ar_x_Origin_ID],
['x_Destination_ID','x_Client_ID',rates_add.ar_x_Destination_ID]]);

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$rates_add->Page_Terminate();
?>
<?php

//
// Page class
//
class crates_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'rates';

	// Page object name
	var $PageObjName = 'rates_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $rates;
		if ($rates->UseTokenInUrl) $PageUrl .= "t=" . $rates->TableVar . "&"; // Add page token
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
		global $objForm, $rates;
		if ($rates->UseTokenInUrl) {
			if ($objForm)
				return ($rates->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($rates->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crates_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (rates)
		$GLOBALS["rates"] = new crates();

		// Table object (clients)
		$GLOBALS['clients'] = new cclients();

		// Table object (users)
		$GLOBALS['users'] = new cusers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rates', TRUE);

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
		global $rates;

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rateslist.php");
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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $rates;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $rates->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Set up master/detail parameters
		$this->SetUpMasterDetail();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $rates->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$rates->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $rates->CurrentAction = "C"; // Copy record
		  } else {
		    $rates->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($rates->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("rateslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$rates->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $rates->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$rates->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $rates;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $rates;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $rates;
		$rates->Date->setFormValue($objForm->GetValue("x_Date"));
		$rates->Date->CurrentValue = ew_UnFormatDateTime($rates->Date->CurrentValue, 6);
		$rates->Client_ID->setFormValue($objForm->GetValue("x_Client_ID"));
		$rates->Area_ID->setFormValue($objForm->GetValue("x_Area_ID"));
		$rates->Origin_ID->setFormValue($objForm->GetValue("x_Origin_ID"));
		$rates->Destination_ID->setFormValue($objForm->GetValue("x_Destination_ID"));
		$rates->Distance->setFormValue($objForm->GetValue("x_Distance"));
		$rates->Truck_Type_ID->setFormValue($objForm->GetValue("x_Truck_Type_ID"));
		$rates->Unit_ID->setFormValue($objForm->GetValue("x_Unit_ID"));
		$rates->Freight_Rate->setFormValue($objForm->GetValue("x_Freight_Rate"));
		$rates->Vat->setFormValue($objForm->GetValue("x_Vat"));
		$rates->Wtax->setFormValue($objForm->GetValue("x_Wtax"));
		$rates->Remarks->setFormValue($objForm->GetValue("x_Remarks"));
		$rates->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $rates;
		$rates->id->CurrentValue = $rates->id->FormValue;
		$rates->Date->CurrentValue = $rates->Date->FormValue;
		$rates->Date->CurrentValue = ew_UnFormatDateTime($rates->Date->CurrentValue, 6);
		$rates->Client_ID->CurrentValue = $rates->Client_ID->FormValue;
		$rates->Area_ID->CurrentValue = $rates->Area_ID->FormValue;
		$rates->Origin_ID->CurrentValue = $rates->Origin_ID->FormValue;
		$rates->Destination_ID->CurrentValue = $rates->Destination_ID->FormValue;
		$rates->Distance->CurrentValue = $rates->Distance->FormValue;
		$rates->Truck_Type_ID->CurrentValue = $rates->Truck_Type_ID->FormValue;
		$rates->Unit_ID->CurrentValue = $rates->Unit_ID->FormValue;
		$rates->Freight_Rate->CurrentValue = $rates->Freight_Rate->FormValue;
		$rates->Vat->CurrentValue = $rates->Vat->FormValue;
		$rates->Wtax->CurrentValue = $rates->Wtax->FormValue;
		$rates->Remarks->CurrentValue = $rates->Remarks->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $rates;
		$sFilter = $rates->KeyFilter();

		// Call Row Selecting event
		$rates->Row_Selecting($sFilter);

		// Load SQL based on filter
		$rates->CurrentFilter = $sFilter;
		$sSql = $rates->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$rates->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $rates;
		$rates->id->setDbValue($rs->fields('id'));
		$rates->Date->setDbValue($rs->fields('Date'));
		$rates->Client_ID->setDbValue($rs->fields('Client_ID'));
		$rates->Area_ID->setDbValue($rs->fields('Area_ID'));
		$rates->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$rates->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$rates->Distance->setDbValue($rs->fields('Distance'));
		$rates->Truck_Type_ID->setDbValue($rs->fields('Truck_Type_ID'));
		$rates->Unit_ID->setDbValue($rs->fields('Unit_ID'));
		$rates->Freight_Rate->setDbValue($rs->fields('Freight_Rate'));
		$rates->Vat->setDbValue($rs->fields('Vat'));
		$rates->Wtax->setDbValue($rs->fields('Wtax'));
		$rates->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $rates;

		// Initialize URLs
		// Call Row_Rendering event

		$rates->Row_Rendering();

		// Common render codes for all row types
		// Date

		$rates->Date->CellCssStyle = ""; $rates->Date->CellCssClass = "";
		$rates->Date->CellAttrs = array(); $rates->Date->ViewAttrs = array(); $rates->Date->EditAttrs = array();

		// Client_ID
		$rates->Client_ID->CellCssStyle = ""; $rates->Client_ID->CellCssClass = "";
		$rates->Client_ID->CellAttrs = array(); $rates->Client_ID->ViewAttrs = array(); $rates->Client_ID->EditAttrs = array();

		// Area_ID
		$rates->Area_ID->CellCssStyle = ""; $rates->Area_ID->CellCssClass = "";
		$rates->Area_ID->CellAttrs = array(); $rates->Area_ID->ViewAttrs = array(); $rates->Area_ID->EditAttrs = array();

		// Origin_ID
		$rates->Origin_ID->CellCssStyle = ""; $rates->Origin_ID->CellCssClass = "";
		$rates->Origin_ID->CellAttrs = array(); $rates->Origin_ID->ViewAttrs = array(); $rates->Origin_ID->EditAttrs = array();

		// Destination_ID
		$rates->Destination_ID->CellCssStyle = ""; $rates->Destination_ID->CellCssClass = "";
		$rates->Destination_ID->CellAttrs = array(); $rates->Destination_ID->ViewAttrs = array(); $rates->Destination_ID->EditAttrs = array();

		// Distance
		$rates->Distance->CellCssStyle = ""; $rates->Distance->CellCssClass = "";
		$rates->Distance->CellAttrs = array(); $rates->Distance->ViewAttrs = array(); $rates->Distance->EditAttrs = array();

		// Truck_Type_ID
		$rates->Truck_Type_ID->CellCssStyle = ""; $rates->Truck_Type_ID->CellCssClass = "";
		$rates->Truck_Type_ID->CellAttrs = array(); $rates->Truck_Type_ID->ViewAttrs = array(); $rates->Truck_Type_ID->EditAttrs = array();

		// Unit_ID
		$rates->Unit_ID->CellCssStyle = ""; $rates->Unit_ID->CellCssClass = "";
		$rates->Unit_ID->CellAttrs = array(); $rates->Unit_ID->ViewAttrs = array(); $rates->Unit_ID->EditAttrs = array();

		// Freight_Rate
		$rates->Freight_Rate->CellCssStyle = ""; $rates->Freight_Rate->CellCssClass = "";
		$rates->Freight_Rate->CellAttrs = array(); $rates->Freight_Rate->ViewAttrs = array(); $rates->Freight_Rate->EditAttrs = array();

		// Vat
		$rates->Vat->CellCssStyle = ""; $rates->Vat->CellCssClass = "";
		$rates->Vat->CellAttrs = array(); $rates->Vat->ViewAttrs = array(); $rates->Vat->EditAttrs = array();

		// Wtax
		$rates->Wtax->CellCssStyle = ""; $rates->Wtax->CellCssClass = "";
		$rates->Wtax->CellAttrs = array(); $rates->Wtax->ViewAttrs = array(); $rates->Wtax->EditAttrs = array();

		// Remarks
		$rates->Remarks->CellCssStyle = ""; $rates->Remarks->CellCssClass = "";
		$rates->Remarks->CellAttrs = array(); $rates->Remarks->ViewAttrs = array(); $rates->Remarks->EditAttrs = array();
		if ($rates->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$rates->id->ViewValue = $rates->id->CurrentValue;
			$rates->id->CssStyle = "";
			$rates->id->CssClass = "";
			$rates->id->ViewCustomAttributes = "";

			// Date
			$rates->Date->ViewValue = $rates->Date->CurrentValue;
			$rates->Date->ViewValue = ew_FormatDateTime($rates->Date->ViewValue, 6);
			$rates->Date->CssStyle = "";
			$rates->Date->CssClass = "";
			$rates->Date->ViewCustomAttributes = "";

			// Client_ID
			if (strval($rates->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$rates->Client_ID->ViewValue = $rates->Client_ID->CurrentValue;
				}
			} else {
				$rates->Client_ID->ViewValue = NULL;
			}
			$rates->Client_ID->CssStyle = "";
			$rates->Client_ID->CssClass = "";
			$rates->Client_ID->ViewCustomAttributes = "";

			// Area_ID
			if (strval($rates->Area_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Area_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Area` FROM `areas`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Area_ID->ViewValue = $rswrk->fields('Area');
					$rswrk->Close();
				} else {
					$rates->Area_ID->ViewValue = $rates->Area_ID->CurrentValue;
				}
			} else {
				$rates->Area_ID->ViewValue = NULL;
			}
			$rates->Area_ID->CssStyle = "";
			$rates->Area_ID->CssClass = "";
			$rates->Area_ID->ViewCustomAttributes = "";

			// Origin_ID
			if (strval($rates->Origin_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Origin_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Origin` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Origin_ID->ViewValue = $rswrk->fields('Origin');
					$rswrk->Close();
				} else {
					$rates->Origin_ID->ViewValue = $rates->Origin_ID->CurrentValue;
				}
			} else {
				$rates->Origin_ID->ViewValue = NULL;
			}
			$rates->Origin_ID->CssStyle = "";
			$rates->Origin_ID->CssClass = "";
			$rates->Origin_ID->ViewCustomAttributes = "";

			// Destination_ID
			if (strval($rates->Destination_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Destination_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Destination` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Destination_ID->ViewValue = $rswrk->fields('Destination');
					$rswrk->Close();
				} else {
					$rates->Destination_ID->ViewValue = $rates->Destination_ID->CurrentValue;
				}
			} else {
				$rates->Destination_ID->ViewValue = NULL;
			}
			$rates->Destination_ID->CssStyle = "";
			$rates->Destination_ID->CssClass = "";
			$rates->Destination_ID->ViewCustomAttributes = "";

			// Distance
			$rates->Distance->ViewValue = $rates->Distance->CurrentValue;
			$rates->Distance->CssStyle = "";
			$rates->Distance->CssClass = "";
			$rates->Distance->ViewCustomAttributes = "";

			// Truck_Type_ID
			if (strval($rates->Truck_Type_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Truck_Type_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Truck_Type_ID->ViewValue = $rswrk->fields('Truck_Type');
					$rswrk->Close();
				} else {
					$rates->Truck_Type_ID->ViewValue = $rates->Truck_Type_ID->CurrentValue;
				}
			} else {
				$rates->Truck_Type_ID->ViewValue = NULL;
			}
			$rates->Truck_Type_ID->CssStyle = "";
			$rates->Truck_Type_ID->CssClass = "";
			$rates->Truck_Type_ID->ViewCustomAttributes = "";

			// Unit_ID
			if (strval($rates->Unit_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Unit_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Units` FROM `units`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Unit_ID->ViewValue = $rswrk->fields('Units');
					$rswrk->Close();
				} else {
					$rates->Unit_ID->ViewValue = $rates->Unit_ID->CurrentValue;
				}
			} else {
				$rates->Unit_ID->ViewValue = NULL;
			}
			$rates->Unit_ID->CssStyle = "";
			$rates->Unit_ID->CssClass = "";
			$rates->Unit_ID->ViewCustomAttributes = "";

			// Freight_Rate
			$rates->Freight_Rate->ViewValue = $rates->Freight_Rate->CurrentValue;
			$rates->Freight_Rate->CssStyle = "";
			$rates->Freight_Rate->CssClass = "";
			$rates->Freight_Rate->ViewCustomAttributes = "";

			// Vat
			$rates->Vat->ViewValue = $rates->Vat->CurrentValue;
			$rates->Vat->CssStyle = "";
			$rates->Vat->CssClass = "";
			$rates->Vat->ViewCustomAttributes = "";

			// Wtax
			$rates->Wtax->ViewValue = $rates->Wtax->CurrentValue;
			$rates->Wtax->CssStyle = "";
			$rates->Wtax->CssClass = "";
			$rates->Wtax->ViewCustomAttributes = "";

			// Remarks
			$rates->Remarks->ViewValue = $rates->Remarks->CurrentValue;
			$rates->Remarks->CssStyle = "";
			$rates->Remarks->CssClass = "";
			$rates->Remarks->ViewCustomAttributes = "";

			// Date
			$rates->Date->HrefValue = "";
			$rates->Date->TooltipValue = "";

			// Client_ID
			$rates->Client_ID->HrefValue = "";
			$rates->Client_ID->TooltipValue = "";

			// Area_ID
			$rates->Area_ID->HrefValue = "";
			$rates->Area_ID->TooltipValue = "";

			// Origin_ID
			$rates->Origin_ID->HrefValue = "";
			$rates->Origin_ID->TooltipValue = "";

			// Destination_ID
			$rates->Destination_ID->HrefValue = "";
			$rates->Destination_ID->TooltipValue = "";

			// Distance
			$rates->Distance->HrefValue = "";
			$rates->Distance->TooltipValue = "";

			// Truck_Type_ID
			$rates->Truck_Type_ID->HrefValue = "";
			$rates->Truck_Type_ID->TooltipValue = "";

			// Unit_ID
			$rates->Unit_ID->HrefValue = "";
			$rates->Unit_ID->TooltipValue = "";

			// Freight_Rate
			$rates->Freight_Rate->HrefValue = "";
			$rates->Freight_Rate->TooltipValue = "";

			// Vat
			$rates->Vat->HrefValue = "";
			$rates->Vat->TooltipValue = "";

			// Wtax
			$rates->Wtax->HrefValue = "";
			$rates->Wtax->TooltipValue = "";

			// Remarks
			$rates->Remarks->HrefValue = "";
			$rates->Remarks->TooltipValue = "";
		} elseif ($rates->RowType == EW_ROWTYPE_ADD) { // Add row

			// Date
			$rates->Date->EditCustomAttributes = "";
			$rates->Date->EditValue = ew_HtmlEncode(ew_FormatDateTime($rates->Date->CurrentValue, 6));

			// Client_ID
			$rates->Client_ID->EditCustomAttributes = "";
			if ($rates->Client_ID->getSessionValue() <> "") {
				$rates->Client_ID->CurrentValue = $rates->Client_ID->getSessionValue();
			if (strval($rates->Client_ID->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($rates->Client_ID->CurrentValue) . "";
			$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$rates->Client_ID->ViewValue = $rswrk->fields('Client_Name');
					$rswrk->Close();
				} else {
					$rates->Client_ID->ViewValue = $rates->Client_ID->CurrentValue;
				}
			} else {
				$rates->Client_ID->ViewValue = NULL;
			}
			$rates->Client_ID->CssStyle = "";
			$rates->Client_ID->CssClass = "";
			$rates->Client_ID->ViewCustomAttributes = "";
			} else {
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
			$rates->Client_ID->EditValue = $arwrk;
			}

			// Area_ID
			$rates->Area_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Area`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `areas`";
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
			$rates->Area_ID->EditValue = $arwrk;

			// Origin_ID
			$rates->Origin_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Origin`, '' AS Disp2Fld, `Client` FROM `origins`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$rates->Origin_ID->EditValue = $arwrk;

			// Destination_ID
			$rates->Destination_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Destination`, '' AS Disp2Fld, `Client` FROM `destinations`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$rates->Destination_ID->EditValue = $arwrk;

			// Distance
			$rates->Distance->EditCustomAttributes = "";
			$rates->Distance->EditValue = ew_HtmlEncode($rates->Distance->CurrentValue);

			// Truck_Type_ID
			$rates->Truck_Type_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Truck_Type`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `truck_types`";
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
			$rates->Truck_Type_ID->EditValue = $arwrk;

			// Unit_ID
			$rates->Unit_ID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `id`, `Units`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `units`";
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
			$rates->Unit_ID->EditValue = $arwrk;

			// Freight_Rate
			$rates->Freight_Rate->EditCustomAttributes = "";
			$rates->Freight_Rate->EditValue = ew_HtmlEncode($rates->Freight_Rate->CurrentValue);

			// Vat
			$rates->Vat->EditCustomAttributes = "";
			$rates->Vat->EditValue = ew_HtmlEncode($rates->Vat->CurrentValue);

			// Wtax
			$rates->Wtax->EditCustomAttributes = "";
			$rates->Wtax->EditValue = ew_HtmlEncode($rates->Wtax->CurrentValue);

			// Remarks
			$rates->Remarks->EditCustomAttributes = "";
			$rates->Remarks->EditValue = ew_HtmlEncode($rates->Remarks->CurrentValue);
		}

		// Call Row Rendered event
		if ($rates->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$rates->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $rates;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckUSDate($rates->Date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $rates->Date->FldErrMsg();
		}
		if (!ew_CheckNumber($rates->Freight_Rate->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $rates->Freight_Rate->FldErrMsg();
		}
		if (!ew_CheckNumber($rates->Vat->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $rates->Vat->FldErrMsg();
		}
		if (!ew_CheckNumber($rates->Wtax->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $rates->Wtax->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $rates;
		$rsnew = array();

		// Date
		$rates->Date->SetDbValueDef($rsnew, ew_UnFormatDateTime($rates->Date->CurrentValue, 6, FALSE), NULL);

		// Client_ID
		$rates->Client_ID->SetDbValueDef($rsnew, $rates->Client_ID->CurrentValue, NULL, FALSE);

		// Area_ID
		$rates->Area_ID->SetDbValueDef($rsnew, $rates->Area_ID->CurrentValue, NULL, FALSE);

		// Origin_ID
		$rates->Origin_ID->SetDbValueDef($rsnew, $rates->Origin_ID->CurrentValue, NULL, FALSE);

		// Destination_ID
		$rates->Destination_ID->SetDbValueDef($rsnew, $rates->Destination_ID->CurrentValue, NULL, FALSE);

		// Distance
		$rates->Distance->SetDbValueDef($rsnew, $rates->Distance->CurrentValue, NULL, FALSE);

		// Truck_Type_ID
		$rates->Truck_Type_ID->SetDbValueDef($rsnew, $rates->Truck_Type_ID->CurrentValue, NULL, FALSE);

		// Unit_ID
		$rates->Unit_ID->SetDbValueDef($rsnew, $rates->Unit_ID->CurrentValue, NULL, FALSE);

		// Freight_Rate
		$rates->Freight_Rate->SetDbValueDef($rsnew, $rates->Freight_Rate->CurrentValue, NULL, FALSE);

		// Vat
		$rates->Vat->SetDbValueDef($rsnew, $rates->Vat->CurrentValue, NULL, FALSE);

		// Wtax
		$rates->Wtax->SetDbValueDef($rsnew, $rates->Wtax->CurrentValue, NULL, FALSE);

		// Remarks
		$rates->Remarks->SetDbValueDef($rsnew, $rates->Remarks->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $rates->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($rates->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($rates->CancelMessage <> "") {
				$this->setMessage($rates->CancelMessage);
				$rates->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$rates->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $rates->id->DbValue;

			// Call Row Inserted event
			$rates->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterDetail() {
		global $rates;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "clients") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $rates->SqlMasterFilter_clients();
				$this->sDbDetailFilter = $rates->SqlDetailFilter_clients();
				if (@$_GET["id"] <> "") {
					$GLOBALS["clients"]->id->setQueryStringValue($_GET["id"]);
					$rates->Client_ID->setQueryStringValue($GLOBALS["clients"]->id->QueryStringValue);
					$rates->Client_ID->setSessionValue($rates->Client_ID->QueryStringValue);
					if (!is_numeric($GLOBALS["clients"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["clients"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@Client_ID@", ew_AdjustSql($GLOBALS["clients"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$rates->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$rates->setStartRecordNumber($this->lStartRec);
			$rates->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$rates->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master key from Session
			if ($sMasterTblVar <> "clients") {
				if ($rates->Client_ID->QueryStringValue == "") $rates->Client_ID->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $rates->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $rates->getDetailFilter(); // Restore detail filter
		}
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
