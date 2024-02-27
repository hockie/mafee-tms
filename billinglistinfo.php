<?php

// Global variable for table object
$billinglist = NULL;

//
// Table class for billinglist
//
class cbillinglist {
	var $TableVar = 'billinglist';
	var $TableName = 'billinglist';
	var $TableType = 'VIEW';
	var $Booking_ID;
	var $Client_ID;
	var $Booking_Date;
	var $Booking_Number;
	var $Date_Delivered;
	var $Origin;
	var $Customer;
	var $Destination;
	var $Reference_Number;
	var $Plate_Number;
	var $Truck_Type;
	var $Freight;
	var $Remarks;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function cbillinglist() {
		global $Language;

		// Booking ID
		$this->Booking_ID = new cField('billinglist', 'billinglist', 'x_Booking_ID', 'Booking ID', '`Booking ID`', 3, -1, FALSE, '`Booking ID`', FALSE);
		$this->Booking_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Booking ID'] =& $this->Booking_ID;

		// Client ID
		$this->Client_ID = new cField('billinglist', 'billinglist', 'x_Client_ID', 'Client ID', '`Client ID`', 3, -1, FALSE, '`Client ID`', FALSE);
		$this->Client_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Client ID'] =& $this->Client_ID;

		// Booking Date
		$this->Booking_Date = new cField('billinglist', 'billinglist', 'x_Booking_Date', 'Booking Date', '`Booking Date`', 135, 6, FALSE, '`Booking Date`', FALSE);
		$this->Booking_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Booking Date'] =& $this->Booking_Date;

		// Booking Number
		$this->Booking_Number = new cField('billinglist', 'billinglist', 'x_Booking_Number', 'Booking Number', '`Booking Number`', 200, -1, FALSE, '`Booking Number`', FALSE);
		$this->fields['Booking Number'] =& $this->Booking_Number;

		// Date Delivered
		$this->Date_Delivered = new cField('billinglist', 'billinglist', 'x_Date_Delivered', 'Date Delivered', '`Date Delivered`', 135, 6, FALSE, '`Date Delivered`', FALSE);
		$this->Date_Delivered->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date Delivered'] =& $this->Date_Delivered;

		// Origin
		$this->Origin = new cField('billinglist', 'billinglist', 'x_Origin', 'Origin', '`Origin`', 200, -1, FALSE, '`Origin`', FALSE);
		$this->fields['Origin'] =& $this->Origin;

		// Customer
		$this->Customer = new cField('billinglist', 'billinglist', 'x_Customer', 'Customer', '`Customer`', 200, -1, FALSE, '`Customer`', FALSE);
		$this->fields['Customer'] =& $this->Customer;

		// Destination
		$this->Destination = new cField('billinglist', 'billinglist', 'x_Destination', 'Destination', '`Destination`', 200, -1, FALSE, '`Destination`', FALSE);
		$this->fields['Destination'] =& $this->Destination;

		// Reference Number
		$this->Reference_Number = new cField('billinglist', 'billinglist', 'x_Reference_Number', 'Reference Number', '`Reference Number`', 201, -1, FALSE, '`Reference Number`', FALSE);
		$this->fields['Reference Number'] =& $this->Reference_Number;

		// Plate Number
		$this->Plate_Number = new cField('billinglist', 'billinglist', 'x_Plate_Number', 'Plate Number', '`Plate Number`', 200, -1, FALSE, '`Plate Number`', FALSE);
		$this->fields['Plate Number'] =& $this->Plate_Number;

		// Truck_Type
		$this->Truck_Type = new cField('billinglist', 'billinglist', 'x_Truck_Type', 'Truck_Type', '`Truck_Type`', 200, -1, FALSE, '`Truck_Type`', FALSE);
		$this->fields['Truck_Type'] =& $this->Truck_Type;

		// Freight
		$this->Freight = new cField('billinglist', 'billinglist', 'x_Freight', 'Freight', '`Freight`', 4, -1, FALSE, '`Freight`', FALSE);
		$this->Freight->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Freight'] =& $this->Freight;

		// Remarks
		$this->Remarks = new cField('billinglist', 'billinglist', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
		$this->fields['Remarks'] =& $this->Remarks;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "billinglist_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER];
	}

	function setMasterFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER] = $v;
	}

	// Session detail WHERE clause
	function getDetailFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER];
	}

	function setDetailFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER] = $v;
	}

	// Master filter
	function SqlMasterFilter_clients() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_clients() {
		return "`Client ID`=@Client_ID@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`billinglist`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere .= "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `billinglist` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `billinglist` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `billinglist` WHERE ";
		$SQL .= ew_QuotedName('Booking ID') . '=' . ew_QuotedValue($rs['Booking ID'], $this->Booking_ID->FldDataType) . ' AND ';
		$SQL .= ew_QuotedName('Client ID') . '=' . ew_QuotedValue($rs['Client ID'], $this->Client_ID->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`Booking ID` = @Booking_ID@ AND `Client ID` = @Client_ID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->Booking_ID->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@Booking_ID@", ew_AdjustSql($this->Booking_ID->CurrentValue), $sKeyFilter); // Replace key value
		if (!is_numeric($this->Client_ID->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@Client_ID@", ew_AdjustSql($this->Client_ID->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "billinglistlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "billinglistlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("billinglistview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "billinglistadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("billinglistedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("billinglistadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("billinglistdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->Booking_ID->CurrentValue)) {
			$sUrl .= "Booking_ID=" . urlencode($this->Booking_ID->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		if (!is_null($this->Client_ID->CurrentValue)) {
			$sUrl .= "&Client_ID=" . urlencode($this->Client_ID->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=billinglist" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->Booking_ID->setDbValue($rs->fields('Booking ID'));
		$this->Client_ID->setDbValue($rs->fields('Client ID'));
		$this->Booking_Date->setDbValue($rs->fields('Booking Date'));
		$this->Booking_Number->setDbValue($rs->fields('Booking Number'));
		$this->Date_Delivered->setDbValue($rs->fields('Date Delivered'));
		$this->Origin->setDbValue($rs->fields('Origin'));
		$this->Customer->setDbValue($rs->fields('Customer'));
		$this->Destination->setDbValue($rs->fields('Destination'));
		$this->Reference_Number->setDbValue($rs->fields('Reference Number'));
		$this->Plate_Number->setDbValue($rs->fields('Plate Number'));
		$this->Truck_Type->setDbValue($rs->fields('Truck_Type'));
		$this->Freight->setDbValue($rs->fields('Freight'));
		$this->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// Booking ID

		$this->Booking_ID->CellCssStyle = ""; $this->Booking_ID->CellCssClass = "";
		$this->Booking_ID->CellAttrs = array(); $this->Booking_ID->ViewAttrs = array(); $this->Booking_ID->EditAttrs = array();

		// Client ID
		$this->Client_ID->CellCssStyle = ""; $this->Client_ID->CellCssClass = "";
		$this->Client_ID->CellAttrs = array(); $this->Client_ID->ViewAttrs = array(); $this->Client_ID->EditAttrs = array();

		// Booking Date
		$this->Booking_Date->CellCssStyle = ""; $this->Booking_Date->CellCssClass = "";
		$this->Booking_Date->CellAttrs = array(); $this->Booking_Date->ViewAttrs = array(); $this->Booking_Date->EditAttrs = array();

		// Booking Number
		$this->Booking_Number->CellCssStyle = ""; $this->Booking_Number->CellCssClass = "";
		$this->Booking_Number->CellAttrs = array(); $this->Booking_Number->ViewAttrs = array(); $this->Booking_Number->EditAttrs = array();

		// Date Delivered
		$this->Date_Delivered->CellCssStyle = ""; $this->Date_Delivered->CellCssClass = "";
		$this->Date_Delivered->CellAttrs = array(); $this->Date_Delivered->ViewAttrs = array(); $this->Date_Delivered->EditAttrs = array();

		// Origin
		$this->Origin->CellCssStyle = ""; $this->Origin->CellCssClass = "";
		$this->Origin->CellAttrs = array(); $this->Origin->ViewAttrs = array(); $this->Origin->EditAttrs = array();

		// Customer
		$this->Customer->CellCssStyle = ""; $this->Customer->CellCssClass = "";
		$this->Customer->CellAttrs = array(); $this->Customer->ViewAttrs = array(); $this->Customer->EditAttrs = array();

		// Destination
		$this->Destination->CellCssStyle = ""; $this->Destination->CellCssClass = "";
		$this->Destination->CellAttrs = array(); $this->Destination->ViewAttrs = array(); $this->Destination->EditAttrs = array();

		// Plate Number
		$this->Plate_Number->CellCssStyle = ""; $this->Plate_Number->CellCssClass = "";
		$this->Plate_Number->CellAttrs = array(); $this->Plate_Number->ViewAttrs = array(); $this->Plate_Number->EditAttrs = array();

		// Truck_Type
		$this->Truck_Type->CellCssStyle = ""; $this->Truck_Type->CellCssClass = "";
		$this->Truck_Type->CellAttrs = array(); $this->Truck_Type->ViewAttrs = array(); $this->Truck_Type->EditAttrs = array();

		// Freight
		$this->Freight->CellCssStyle = ""; $this->Freight->CellCssClass = "";
		$this->Freight->CellAttrs = array(); $this->Freight->ViewAttrs = array(); $this->Freight->EditAttrs = array();

		// Booking ID
		$this->Booking_ID->ViewValue = $this->Booking_ID->CurrentValue;
		$this->Booking_ID->CssStyle = "";
		$this->Booking_ID->CssClass = "";
		$this->Booking_ID->ViewCustomAttributes = "";

		// Client ID
		$this->Client_ID->ViewValue = $this->Client_ID->CurrentValue;
		$this->Client_ID->CssStyle = "";
		$this->Client_ID->CssClass = "";
		$this->Client_ID->ViewCustomAttributes = "";

		// Booking Date
		$this->Booking_Date->ViewValue = $this->Booking_Date->CurrentValue;
		$this->Booking_Date->ViewValue = ew_FormatDateTime($this->Booking_Date->ViewValue, 6);
		$this->Booking_Date->CssStyle = "";
		$this->Booking_Date->CssClass = "";
		$this->Booking_Date->ViewCustomAttributes = "";

		// Booking Number
		$this->Booking_Number->ViewValue = $this->Booking_Number->CurrentValue;
		$this->Booking_Number->CssStyle = "";
		$this->Booking_Number->CssClass = "";
		$this->Booking_Number->ViewCustomAttributes = "";

		// Date Delivered
		$this->Date_Delivered->ViewValue = $this->Date_Delivered->CurrentValue;
		$this->Date_Delivered->ViewValue = ew_FormatDateTime($this->Date_Delivered->ViewValue, 6);
		$this->Date_Delivered->CssStyle = "";
		$this->Date_Delivered->CssClass = "";
		$this->Date_Delivered->ViewCustomAttributes = "";

		// Origin
		$this->Origin->ViewValue = $this->Origin->CurrentValue;
		$this->Origin->CssStyle = "";
		$this->Origin->CssClass = "";
		$this->Origin->ViewCustomAttributes = "";

		// Customer
		$this->Customer->ViewValue = $this->Customer->CurrentValue;
		$this->Customer->CssStyle = "";
		$this->Customer->CssClass = "";
		$this->Customer->ViewCustomAttributes = "";

		// Destination
		$this->Destination->ViewValue = $this->Destination->CurrentValue;
		$this->Destination->CssStyle = "";
		$this->Destination->CssClass = "";
		$this->Destination->ViewCustomAttributes = "";

		// Plate Number
		$this->Plate_Number->ViewValue = $this->Plate_Number->CurrentValue;
		$this->Plate_Number->CssStyle = "";
		$this->Plate_Number->CssClass = "";
		$this->Plate_Number->ViewCustomAttributes = "";

		// Truck_Type
		$this->Truck_Type->ViewValue = $this->Truck_Type->CurrentValue;
		$this->Truck_Type->CssStyle = "";
		$this->Truck_Type->CssClass = "";
		$this->Truck_Type->ViewCustomAttributes = "";

		// Freight
		$this->Freight->ViewValue = $this->Freight->CurrentValue;
		$this->Freight->ViewValue = ew_FormatNumber($this->Freight->ViewValue, 2, -2, -1, -2);
		$this->Freight->CssStyle = "";
		$this->Freight->CssClass = "";
		$this->Freight->ViewCustomAttributes = "";

		// Booking ID
		$this->Booking_ID->HrefValue = "";
		$this->Booking_ID->TooltipValue = "";

		// Client ID
		$this->Client_ID->HrefValue = "";
		$this->Client_ID->TooltipValue = "";

		// Booking Date
		$this->Booking_Date->HrefValue = "";
		$this->Booking_Date->TooltipValue = "";

		// Booking Number
		$this->Booking_Number->HrefValue = "";
		$this->Booking_Number->TooltipValue = "";

		// Date Delivered
		$this->Date_Delivered->HrefValue = "";
		$this->Date_Delivered->TooltipValue = "";

		// Origin
		$this->Origin->HrefValue = "";
		$this->Origin->TooltipValue = "";

		// Customer
		$this->Customer->HrefValue = "";
		$this->Customer->TooltipValue = "";

		// Destination
		$this->Destination->HrefValue = "";
		$this->Destination->TooltipValue = "";

		// Plate Number
		$this->Plate_Number->HrefValue = "";
		$this->Plate_Number->TooltipValue = "";

		// Truck_Type
		$this->Truck_Type->HrefValue = "";
		$this->Truck_Type->TooltipValue = "";

		// Freight
		$this->Freight->HrefValue = "";
		$this->Freight->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//global $MyTable;
		//$MyTable->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
