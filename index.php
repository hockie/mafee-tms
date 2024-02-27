<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$default = new cdefault();
$Page =& $default;

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php
$default->Page_Terminate();
?>
<?php

//
// Page class
//
class cdefault {

	// Page ID
	var $PageID = 'default';

	// Page object name
	var $PageObjName = 'default';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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
		return TRUE;
	}

	//
	// Page class constructor
	//
	function cdefault() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// User table object (users)
		$GLOBALS["users"] = new cusers;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

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
		global $users;

		// Security
		$Security = new cAdvancedSecurity();

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
		global $Security, $Language;
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // load User Level
		if ($Security->AllowList('bookings'))
		$this->Page_Terminate("bookingslist.php"); // Exit and go to default page
		if ($Security->AllowList('clients'))
			$this->Page_Terminate("clientslist.php");
		if ($Security->AllowList('consignees'))
			$this->Page_Terminate("consigneeslist.php");
		if ($Security->AllowList('subcons'))
			$this->Page_Terminate("subconslist.php");
		if ($Security->AllowList('file_uploads'))
			$this->Page_Terminate("file_uploadslist.php");
		if ($Security->AllowList('rates'))
			$this->Page_Terminate("rateslist.php");
		if ($Security->AllowList('truck_drivers'))
			$this->Page_Terminate("truck_driverslist.php");
		if ($Security->AllowList('helpers'))
			$this->Page_Terminate("helperslist.php");
		if ($Security->AllowList('origins'))
			$this->Page_Terminate("originslist.php");
		if ($Security->AllowList('areas'))
			$this->Page_Terminate("areaslist.php");
		if ($Security->AllowList('destinations'))
			$this->Page_Terminate("destinationslist.php");
		if ($Security->AllowList('statuses'))
			$this->Page_Terminate("statuseslist.php");
		if ($Security->AllowList('trucks'))
			$this->Page_Terminate("truckslist.php");
		if ($Security->AllowList('billing_types'))
			$this->Page_Terminate("billing_typeslist.php");
		if ($Security->AllowList('expenses'))
			$this->Page_Terminate("expenseslist.php");
		if ($Security->AllowList('doc_types'))
			$this->Page_Terminate("doc_typeslist.php");
		if ($Security->AllowList('file_types'))
			$this->Page_Terminate("file_typeslist.php");
		if ($Security->AllowList('truck_types'))
			$this->Page_Terminate("truck_typeslist.php");
		if ($Security->AllowList('units'))
			$this->Page_Terminate("unitslist.php");
		if ($Security->AllowList('employees'))
			$this->Page_Terminate("employeeslist.php");
		if ($Security->AllowList('users'))
			$this->Page_Terminate("userslist.php");
		if ($Security->AllowList('userlevelpermissions'))
			$this->Page_Terminate("userlevelpermissionslist.php");
		if ($Security->AllowList('userlevels'))
			$this->Page_Terminate("userlevelslist.php");
		if ($Security->AllowList('expenses_types'))
			$this->Page_Terminate("expenses_typeslist.php");
		if ($Security->AllowList('booking_helpers'))
			$this->Page_Terminate("booking_helperslist.php");
		if ($Security->AllowList('accounts_receivable'))
			$this->Page_Terminate("accounts_receivablelist.php");
		if ($Security->AllowList('sales'))
			$this->Page_Terminate("saleslist.php");
		if ($Security->AllowList('audittrail'))
			$this->Page_Terminate("audittraillist.php");
		if ($Security->AllowList('company'))
			$this->Page_Terminate("companylist.php");
		if ($Security->AllowList('billinglist'))
			$this->Page_Terminate("billinglistlist.php");
		if ($Security->AllowList('client_payment_period'))
			$this->Page_Terminate("client_payment_periodlist.php");
		if ($Security->AllowList('file_uploads_subcons'))
			$this->Page_Terminate("file_uploads_subconslist.php");
		if ($Security->AllowList('file_uploads_trucks'))
			$this->Page_Terminate("file_uploads_truckslist.php");
		if ($Security->AllowList('invoices'))
			$this->Page_Terminate("invoiceslist.php");
		if ($Security->IsLoggedIn()) {
			echo $Language->Phrase("NoPermission");
			echo "<br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>";
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
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
}
?>
