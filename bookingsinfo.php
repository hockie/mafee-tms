<?php

// Global variable for table object
$bookings = NULL;

//
// Table class for bookings
//
class cbookings {
	var $TableVar = 'bookings';
	var $TableName = 'bookings';
	var $TableType = 'TABLE';
	var $id;
	var $Booking_Number;
	var $Date;
	var $Client_ID;
	var $Origin_ID;
	var $Customer_ID;
	var $Destination_ID;
	var $Subcon_ID;
	var $Truck_ID;
	var $ETD;
	var $ETA;
	var $Billing_Type_ID;
	var $Doc_Reference_Number;
	var $Truck_Driver_ID;
	var $Status_ID;
	var $Unit_ID;
	var $Quantity;
	var $Freight;
	var $Vat;
	var $Total_Sales;
	var $Wtax;
	var $Total_Amount_Due;
	var $Date_Delivered;
	var $Date_Updated;
	var $Remarks;
	var $User;
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
	function cbookings() {
		global $Language;

		// id
		$this->id = new cField('bookings', 'bookings', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Booking_Number
		$this->Booking_Number = new cField('bookings', 'bookings', 'x_Booking_Number', 'Booking_Number', '`Booking_Number`', 200, -1, FALSE, '`Booking_Number`', FALSE);
		$this->fields['Booking_Number'] =& $this->Booking_Number;

		// Date
		$this->Date = new cField('bookings', 'bookings', 'x_Date', 'Date', '`Date`', 135, 10, FALSE, '`Date`', FALSE);
		$this->Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date'] =& $this->Date;

		// Client_ID
		$this->Client_ID = new cField('bookings', 'bookings', 'x_Client_ID', 'Client_ID', '`Client_ID`', 3, -1, FALSE, '`Client_ID`', FALSE);
		$this->Client_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Client_ID'] =& $this->Client_ID;

		// Origin_ID
		$this->Origin_ID = new cField('bookings', 'bookings', 'x_Origin_ID', 'Origin_ID', '`Origin_ID`', 3, -1, FALSE, '`Origin_ID`', FALSE);
		$this->Origin_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Origin_ID'] =& $this->Origin_ID;

		// Customer_ID
		$this->Customer_ID = new cField('bookings', 'bookings', 'x_Customer_ID', 'Customer_ID', '`Customer_ID`', 3, -1, FALSE, '`Customer_ID`', FALSE);
		$this->Customer_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Customer_ID'] =& $this->Customer_ID;

		// Destination_ID
		$this->Destination_ID = new cField('bookings', 'bookings', 'x_Destination_ID', 'Destination_ID', '`Destination_ID`', 3, -1, FALSE, '`Destination_ID`', FALSE);
		$this->Destination_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Destination_ID'] =& $this->Destination_ID;

		// Subcon_ID
		$this->Subcon_ID = new cField('bookings', 'bookings', 'x_Subcon_ID', 'Subcon_ID', '`Subcon_ID`', 3, -1, FALSE, '`Subcon_ID`', FALSE);
		$this->Subcon_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Subcon_ID'] =& $this->Subcon_ID;

		// Truck_ID
		$this->Truck_ID = new cField('bookings', 'bookings', 'x_Truck_ID', 'Truck_ID', '`Truck_ID`', 3, -1, FALSE, '`Truck_ID`', FALSE);
		$this->Truck_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Truck_ID'] =& $this->Truck_ID;

		// ETD
		$this->ETD = new cField('bookings', 'bookings', 'x_ETD', 'ETD', '`ETD`', 135, 6, FALSE, '`ETD`', FALSE);
		$this->ETD->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['ETD'] =& $this->ETD;

		// ETA
		$this->ETA = new cField('bookings', 'bookings', 'x_ETA', 'ETA', '`ETA`', 135, 6, FALSE, '`ETA`', FALSE);
		$this->ETA->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['ETA'] =& $this->ETA;

		// Billing_Type_ID
		$this->Billing_Type_ID = new cField('bookings', 'bookings', 'x_Billing_Type_ID', 'Billing_Type_ID', '`Billing_Type_ID`', 3, -1, FALSE, '`Billing_Type_ID`', FALSE);
		$this->Billing_Type_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Billing_Type_ID'] =& $this->Billing_Type_ID;

		// Doc_Reference_Number
		$this->Doc_Reference_Number = new cField('bookings', 'bookings', 'x_Doc_Reference_Number', 'Doc_Reference_Number', '`Doc_Reference_Number`', 201, -1, FALSE, '`Doc_Reference_Number`', FALSE);
		$this->Doc_Reference_Number->TruncateMemoRemoveHtml = TRUE;
		$this->fields['Doc_Reference_Number'] =& $this->Doc_Reference_Number;

		// Truck_Driver_ID
		$this->Truck_Driver_ID = new cField('bookings', 'bookings', 'x_Truck_Driver_ID', 'Truck_Driver_ID', '`Truck_Driver_ID`', 3, -1, FALSE, '`Truck_Driver_ID`', FALSE);
		$this->Truck_Driver_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Truck_Driver_ID'] =& $this->Truck_Driver_ID;

		// Status_ID
		$this->Status_ID = new cField('bookings', 'bookings', 'x_Status_ID', 'Status_ID', '`Status_ID`', 3, -1, FALSE, '`Status_ID`', FALSE);
		$this->Status_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Status_ID'] =& $this->Status_ID;

		// Unit_ID
		$this->Unit_ID = new cField('bookings', 'bookings', 'x_Unit_ID', 'Unit_ID', '`Unit_ID`', 3, -1, FALSE, '`Unit_ID`', FALSE);
		$this->Unit_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Unit_ID'] =& $this->Unit_ID;

		// Quantity
		$this->Quantity = new cField('bookings', 'bookings', 'x_Quantity', 'Quantity', '`Quantity`', 4, -1, FALSE, '`Quantity`', FALSE);
		$this->Quantity->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Quantity'] =& $this->Quantity;

		// Freight
		$this->Freight = new cField('bookings', 'bookings', 'x_Freight', 'Freight', '`Freight`', 4, -1, FALSE, '`Freight`', FALSE);
		$this->Freight->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Freight'] =& $this->Freight;

		// Vat
		$this->Vat = new cField('bookings', 'bookings', 'x_Vat', 'Vat', '`Vat`', 4, -1, FALSE, '`Vat`', FALSE);
		$this->Vat->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Vat'] =& $this->Vat;

		// Total_Sales
		$this->Total_Sales = new cField('bookings', 'bookings', 'x_Total_Sales', 'Total_Sales', '`Total_Sales`', 4, -1, FALSE, '`Total_Sales`', FALSE);
		$this->Total_Sales->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Sales'] =& $this->Total_Sales;

		// Wtax
		$this->Wtax = new cField('bookings', 'bookings', 'x_Wtax', 'Wtax', '`Wtax`', 4, -1, FALSE, '`Wtax`', FALSE);
		$this->Wtax->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Wtax'] =& $this->Wtax;

		// Total_Amount_Due
		$this->Total_Amount_Due = new cField('bookings', 'bookings', 'x_Total_Amount_Due', 'Total_Amount_Due', '`Total_Amount_Due`', 4, -1, FALSE, '`Total_Amount_Due`', FALSE);
		$this->Total_Amount_Due->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Amount_Due'] =& $this->Total_Amount_Due;

		// Date_Delivered
		$this->Date_Delivered = new cField('bookings', 'bookings', 'x_Date_Delivered', 'Date_Delivered', '`Date_Delivered`', 135, 10, FALSE, '`Date_Delivered`', FALSE);
		$this->Date_Delivered->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date_Delivered'] =& $this->Date_Delivered;

		// Date_Updated
		$this->Date_Updated = new cField('bookings', 'bookings', 'x_Date_Updated', 'Date_Updated', '`Date_Updated`', 135, 6, FALSE, '`Date_Updated`', FALSE);
		$this->Date_Updated->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date_Updated'] =& $this->Date_Updated;

		// Remarks
		$this->Remarks = new cField('bookings', 'bookings', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
		$this->Remarks->TruncateMemoRemoveHtml = TRUE;
		$this->fields['Remarks'] =& $this->Remarks;

		// User
		$this->User = new cField('bookings', 'bookings', 'x_User', 'User', '`User`', 3, -1, FALSE, '`User`', FALSE);
		$this->User->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['User'] =& $this->User;
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
		return "bookings_Highlight";
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
		return "`Client_ID`=@Client_ID@";
	}

	// Master filter
	function SqlMasterFilter_subcons() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_subcons() {
		return "`Subcon_ID`=@Subcon_ID@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`bookings`";
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
		return "`Date` DESC";
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
		return "INSERT INTO `bookings` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `bookings` SET ";
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
		$SQL = "DELETE FROM `bookings` WHERE ";
		$SQL .= ew_QuotedName('id') . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "bookingslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "bookingslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("bookingsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "bookingsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("bookingsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("bookingsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("bookingsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=bookings" : "";
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
		$this->id->setDbValue($rs->fields('id'));
		$this->Booking_Number->setDbValue($rs->fields('Booking_Number'));
		$this->Date->setDbValue($rs->fields('Date'));
		$this->Client_ID->setDbValue($rs->fields('Client_ID'));
		$this->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$this->Customer_ID->setDbValue($rs->fields('Customer_ID'));
		$this->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$this->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$this->Truck_ID->setDbValue($rs->fields('Truck_ID'));
		$this->ETD->setDbValue($rs->fields('ETD'));
		$this->ETA->setDbValue($rs->fields('ETA'));
		$this->Billing_Type_ID->setDbValue($rs->fields('Billing_Type_ID'));
		$this->Doc_Reference_Number->setDbValue($rs->fields('Doc_Reference_Number'));
		$this->Truck_Driver_ID->setDbValue($rs->fields('Truck_Driver_ID'));
		$this->Status_ID->setDbValue($rs->fields('Status_ID'));
		$this->Unit_ID->setDbValue($rs->fields('Unit_ID'));
		$this->Quantity->setDbValue($rs->fields('Quantity'));
		$this->Freight->setDbValue($rs->fields('Freight'));
		$this->Vat->setDbValue($rs->fields('Vat'));
		$this->Total_Sales->setDbValue($rs->fields('Total_Sales'));
		$this->Wtax->setDbValue($rs->fields('Wtax'));
		$this->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$this->Date_Delivered->setDbValue($rs->fields('Date_Delivered'));
		$this->Date_Updated->setDbValue($rs->fields('Date_Updated'));
		$this->Remarks->setDbValue($rs->fields('Remarks'));
		$this->User->setDbValue($rs->fields('User'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// Booking_Number

		$this->Booking_Number->CellCssStyle = ""; $this->Booking_Number->CellCssClass = "";
		$this->Booking_Number->CellAttrs = array(); $this->Booking_Number->ViewAttrs = array(); $this->Booking_Number->EditAttrs = array();

		// Date
		$this->Date->CellCssStyle = ""; $this->Date->CellCssClass = "";
		$this->Date->CellAttrs = array(); $this->Date->ViewAttrs = array(); $this->Date->EditAttrs = array();

		// Client_ID
		$this->Client_ID->CellCssStyle = ""; $this->Client_ID->CellCssClass = "";
		$this->Client_ID->CellAttrs = array(); $this->Client_ID->ViewAttrs = array(); $this->Client_ID->EditAttrs = array();

		// Origin_ID
		$this->Origin_ID->CellCssStyle = ""; $this->Origin_ID->CellCssClass = "";
		$this->Origin_ID->CellAttrs = array(); $this->Origin_ID->ViewAttrs = array(); $this->Origin_ID->EditAttrs = array();

		// Customer_ID
		$this->Customer_ID->CellCssStyle = ""; $this->Customer_ID->CellCssClass = "";
		$this->Customer_ID->CellAttrs = array(); $this->Customer_ID->ViewAttrs = array(); $this->Customer_ID->EditAttrs = array();

		// Destination_ID
		$this->Destination_ID->CellCssStyle = ""; $this->Destination_ID->CellCssClass = "";
		$this->Destination_ID->CellAttrs = array(); $this->Destination_ID->ViewAttrs = array(); $this->Destination_ID->EditAttrs = array();

		// Subcon_ID
		$this->Subcon_ID->CellCssStyle = ""; $this->Subcon_ID->CellCssClass = "";
		$this->Subcon_ID->CellAttrs = array(); $this->Subcon_ID->ViewAttrs = array(); $this->Subcon_ID->EditAttrs = array();

		// Truck_ID
		$this->Truck_ID->CellCssStyle = ""; $this->Truck_ID->CellCssClass = "";
		$this->Truck_ID->CellAttrs = array(); $this->Truck_ID->ViewAttrs = array(); $this->Truck_ID->EditAttrs = array();

		// ETD
		$this->ETD->CellCssStyle = ""; $this->ETD->CellCssClass = "";
		$this->ETD->CellAttrs = array(); $this->ETD->ViewAttrs = array(); $this->ETD->EditAttrs = array();

		// ETA
		$this->ETA->CellCssStyle = ""; $this->ETA->CellCssClass = "";
		$this->ETA->CellAttrs = array(); $this->ETA->ViewAttrs = array(); $this->ETA->EditAttrs = array();

		// Billing_Type_ID
		$this->Billing_Type_ID->CellCssStyle = ""; $this->Billing_Type_ID->CellCssClass = "";
		$this->Billing_Type_ID->CellAttrs = array(); $this->Billing_Type_ID->ViewAttrs = array(); $this->Billing_Type_ID->EditAttrs = array();

		// Doc_Reference_Number
		$this->Doc_Reference_Number->CellCssStyle = ""; $this->Doc_Reference_Number->CellCssClass = "";
		$this->Doc_Reference_Number->CellAttrs = array(); $this->Doc_Reference_Number->ViewAttrs = array(); $this->Doc_Reference_Number->EditAttrs = array();

		// Truck_Driver_ID
		$this->Truck_Driver_ID->CellCssStyle = ""; $this->Truck_Driver_ID->CellCssClass = "";
		$this->Truck_Driver_ID->CellAttrs = array(); $this->Truck_Driver_ID->ViewAttrs = array(); $this->Truck_Driver_ID->EditAttrs = array();

		// Status_ID
		$this->Status_ID->CellCssStyle = ""; $this->Status_ID->CellCssClass = "";
		$this->Status_ID->CellAttrs = array(); $this->Status_ID->ViewAttrs = array(); $this->Status_ID->EditAttrs = array();

		// Unit_ID
		$this->Unit_ID->CellCssStyle = ""; $this->Unit_ID->CellCssClass = "";
		$this->Unit_ID->CellAttrs = array(); $this->Unit_ID->ViewAttrs = array(); $this->Unit_ID->EditAttrs = array();

		// Quantity
		$this->Quantity->CellCssStyle = ""; $this->Quantity->CellCssClass = "";
		$this->Quantity->CellAttrs = array(); $this->Quantity->ViewAttrs = array(); $this->Quantity->EditAttrs = array();

		// Freight
		$this->Freight->CellCssStyle = ""; $this->Freight->CellCssClass = "";
		$this->Freight->CellAttrs = array(); $this->Freight->ViewAttrs = array(); $this->Freight->EditAttrs = array();

		// Vat
		$this->Vat->CellCssStyle = ""; $this->Vat->CellCssClass = "";
		$this->Vat->CellAttrs = array(); $this->Vat->ViewAttrs = array(); $this->Vat->EditAttrs = array();

		// Total_Sales
		$this->Total_Sales->CellCssStyle = ""; $this->Total_Sales->CellCssClass = "";
		$this->Total_Sales->CellAttrs = array(); $this->Total_Sales->ViewAttrs = array(); $this->Total_Sales->EditAttrs = array();

		// Wtax
		$this->Wtax->CellCssStyle = ""; $this->Wtax->CellCssClass = "";
		$this->Wtax->CellAttrs = array(); $this->Wtax->ViewAttrs = array(); $this->Wtax->EditAttrs = array();

		// Total_Amount_Due
		$this->Total_Amount_Due->CellCssStyle = ""; $this->Total_Amount_Due->CellCssClass = "";
		$this->Total_Amount_Due->CellAttrs = array(); $this->Total_Amount_Due->ViewAttrs = array(); $this->Total_Amount_Due->EditAttrs = array();

		// Date_Delivered
		$this->Date_Delivered->CellCssStyle = ""; $this->Date_Delivered->CellCssClass = "";
		$this->Date_Delivered->CellAttrs = array(); $this->Date_Delivered->ViewAttrs = array(); $this->Date_Delivered->EditAttrs = array();

		// Date_Updated
		$this->Date_Updated->CellCssStyle = ""; $this->Date_Updated->CellCssClass = "";
		$this->Date_Updated->CellAttrs = array(); $this->Date_Updated->ViewAttrs = array(); $this->Date_Updated->EditAttrs = array();

		// Remarks
		$this->Remarks->CellCssStyle = ""; $this->Remarks->CellCssClass = "";
		$this->Remarks->CellAttrs = array(); $this->Remarks->ViewAttrs = array(); $this->Remarks->EditAttrs = array();

		// User
		$this->User->CellCssStyle = ""; $this->User->CellCssClass = "";
		$this->User->CellAttrs = array(); $this->User->ViewAttrs = array(); $this->User->EditAttrs = array();

		// Booking_Number
		$this->Booking_Number->ViewValue = $this->Booking_Number->CurrentValue;
		$this->Booking_Number->CssStyle = "";
		$this->Booking_Number->CssClass = "";
		$this->Booking_Number->ViewCustomAttributes = "";

		// Date
		$this->Date->ViewValue = $this->Date->CurrentValue;
		$this->Date->ViewValue = ew_FormatDateTime($this->Date->ViewValue, 10);
		$this->Date->CssStyle = "";
		$this->Date->CssClass = "";
		$this->Date->ViewCustomAttributes = "";

		// Client_ID
		if (strval($this->Client_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Client_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Client_Name` FROM `clients`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Client_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Client_ID->ViewValue = $rswrk->fields('Client_Name');
				$rswrk->Close();
			} else {
				$this->Client_ID->ViewValue = $this->Client_ID->CurrentValue;
			}
		} else {
			$this->Client_ID->ViewValue = NULL;
		}
		$this->Client_ID->CssStyle = "";
		$this->Client_ID->CssClass = "";
		$this->Client_ID->ViewCustomAttributes = "";

		// Origin_ID
		if (strval($this->Origin_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Origin_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Origin` FROM `origins`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Origin` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Origin_ID->ViewValue = $rswrk->fields('Origin');
				$rswrk->Close();
			} else {
				$this->Origin_ID->ViewValue = $this->Origin_ID->CurrentValue;
			}
		} else {
			$this->Origin_ID->ViewValue = NULL;
		}
		$this->Origin_ID->CssStyle = "";
		$this->Origin_ID->CssClass = "";
		$this->Origin_ID->ViewCustomAttributes = "";

		// Customer_ID
		if (strval($this->Customer_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Customer_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Customer_Name` FROM `consignees`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Customer_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Customer_ID->ViewValue = $rswrk->fields('Customer_Name');
				$rswrk->Close();
			} else {
				$this->Customer_ID->ViewValue = $this->Customer_ID->CurrentValue;
			}
		} else {
			$this->Customer_ID->ViewValue = NULL;
		}
		$this->Customer_ID->CssStyle = "";
		$this->Customer_ID->CssClass = "";
		$this->Customer_ID->ViewCustomAttributes = "";

		// Destination_ID
		if (strval($this->Destination_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Destination_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Destination` FROM `destinations`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Destination` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Destination_ID->ViewValue = $rswrk->fields('Destination');
				$rswrk->Close();
			} else {
				$this->Destination_ID->ViewValue = $this->Destination_ID->CurrentValue;
			}
		} else {
			$this->Destination_ID->ViewValue = NULL;
		}
		$this->Destination_ID->CssStyle = "";
		$this->Destination_ID->CssClass = "";
		$this->Destination_ID->ViewCustomAttributes = "";

		// Subcon_ID
		if (strval($this->Subcon_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Subcon_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Subcon_ID->ViewValue = $rswrk->fields('Subcon_Name');
				$rswrk->Close();
			} else {
				$this->Subcon_ID->ViewValue = $this->Subcon_ID->CurrentValue;
			}
		} else {
			$this->Subcon_ID->ViewValue = NULL;
		}
		$this->Subcon_ID->CssStyle = "";
		$this->Subcon_ID->CssClass = "";
		$this->Subcon_ID->ViewCustomAttributes = "";

		// Truck_ID
		if (strval($this->Truck_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Truck_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Plate_Number` FROM `trucks`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Plate_Number` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Truck_ID->ViewValue = $rswrk->fields('Plate_Number');
				$rswrk->Close();
			} else {
				$this->Truck_ID->ViewValue = $this->Truck_ID->CurrentValue;
			}
		} else {
			$this->Truck_ID->ViewValue = NULL;
		}
		$this->Truck_ID->CssStyle = "";
		$this->Truck_ID->CssClass = "";
		$this->Truck_ID->ViewCustomAttributes = "";

		// ETD
		$this->ETD->ViewValue = $this->ETD->CurrentValue;
		$this->ETD->ViewValue = ew_FormatDateTime($this->ETD->ViewValue, 6);
		$this->ETD->CssStyle = "";
		$this->ETD->CssClass = "";
		$this->ETD->ViewCustomAttributes = "";

		// ETA
		$this->ETA->ViewValue = $this->ETA->CurrentValue;
		$this->ETA->ViewValue = ew_FormatDateTime($this->ETA->ViewValue, 6);
		$this->ETA->CssStyle = "";
		$this->ETA->CssClass = "";
		$this->ETA->ViewCustomAttributes = "";

		// Billing_Type_ID
		if (strval($this->Billing_Type_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Billing_Type_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Billing_Types` FROM `billing_types`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Billing_Type_ID->ViewValue = $rswrk->fields('Billing_Types');
				$rswrk->Close();
			} else {
				$this->Billing_Type_ID->ViewValue = $this->Billing_Type_ID->CurrentValue;
			}
		} else {
			$this->Billing_Type_ID->ViewValue = NULL;
		}
		$this->Billing_Type_ID->CssStyle = "";
		$this->Billing_Type_ID->CssClass = "";
		$this->Billing_Type_ID->ViewCustomAttributes = "";

		// Doc_Reference_Number
		$this->Doc_Reference_Number->ViewValue = $this->Doc_Reference_Number->CurrentValue;
		$this->Doc_Reference_Number->CssStyle = "";
		$this->Doc_Reference_Number->CssClass = "";
		$this->Doc_Reference_Number->ViewCustomAttributes = "";

		// Truck_Driver_ID
		if (strval($this->Truck_Driver_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Truck_Driver_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Truck_Driver` FROM `truck_drivers`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Truck_Driver` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Truck_Driver_ID->ViewValue = $rswrk->fields('Truck_Driver');
				$rswrk->Close();
			} else {
				$this->Truck_Driver_ID->ViewValue = $this->Truck_Driver_ID->CurrentValue;
			}
		} else {
			$this->Truck_Driver_ID->ViewValue = NULL;
		}
		$this->Truck_Driver_ID->CssStyle = "";
		$this->Truck_Driver_ID->CssClass = "";
		$this->Truck_Driver_ID->ViewCustomAttributes = "";

		// Status_ID
		if (strval($this->Status_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Status_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Status` FROM `statuses`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Status_ID->ViewValue = $rswrk->fields('Status');
				$rswrk->Close();
			} else {
				$this->Status_ID->ViewValue = $this->Status_ID->CurrentValue;
			}
		} else {
			$this->Status_ID->ViewValue = NULL;
		}
		$this->Status_ID->CssStyle = "";
		$this->Status_ID->CssClass = "";
		$this->Status_ID->ViewCustomAttributes = "";

		// Unit_ID
		if (strval($this->Unit_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Unit_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Units` FROM `units`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Unit_ID->ViewValue = $rswrk->fields('Units');
				$rswrk->Close();
			} else {
				$this->Unit_ID->ViewValue = $this->Unit_ID->CurrentValue;
			}
		} else {
			$this->Unit_ID->ViewValue = NULL;
		}
		$this->Unit_ID->CssStyle = "";
		$this->Unit_ID->CssClass = "";
		$this->Unit_ID->ViewCustomAttributes = "";

		// Quantity
		$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
		$this->Quantity->ViewValue = ew_FormatNumber($this->Quantity->ViewValue, 2, -2, -2, -2);
		$this->Quantity->CssStyle = "";
		$this->Quantity->CssClass = "";
		$this->Quantity->ViewCustomAttributes = "";

		// Freight
		$this->Freight->ViewValue = $this->Freight->CurrentValue;
		$this->Freight->ViewValue = ew_FormatNumber($this->Freight->ViewValue, 2, -2, -2, -2);
		$this->Freight->CssStyle = "";
		$this->Freight->CssClass = "";
		$this->Freight->ViewCustomAttributes = "";

		// Vat
		$this->Vat->ViewValue = $this->Vat->CurrentValue;
		$this->Vat->ViewValue = ew_FormatNumber($this->Vat->ViewValue, 2, -2, -2, -2);
		$this->Vat->CssStyle = "";
		$this->Vat->CssClass = "";
		$this->Vat->ViewCustomAttributes = "";

		// Total_Sales
		$this->Total_Sales->ViewValue = $this->Total_Sales->CurrentValue;
		$this->Total_Sales->ViewValue = ew_FormatNumber($this->Total_Sales->ViewValue, 2, -2, -2, -2);
		$this->Total_Sales->CssStyle = "";
		$this->Total_Sales->CssClass = "";
		$this->Total_Sales->ViewCustomAttributes = "";

		// Wtax
		$this->Wtax->ViewValue = $this->Wtax->CurrentValue;
		$this->Wtax->ViewValue = ew_FormatNumber($this->Wtax->ViewValue, 2, -2, -2, -2);
		$this->Wtax->CssStyle = "";
		$this->Wtax->CssClass = "";
		$this->Wtax->ViewCustomAttributes = "";

		// Total_Amount_Due
		$this->Total_Amount_Due->ViewValue = $this->Total_Amount_Due->CurrentValue;
		$this->Total_Amount_Due->ViewValue = ew_FormatNumber($this->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
		$this->Total_Amount_Due->CssStyle = "";
		$this->Total_Amount_Due->CssClass = "";
		$this->Total_Amount_Due->ViewCustomAttributes = "";

		// Date_Delivered
		$this->Date_Delivered->ViewValue = $this->Date_Delivered->CurrentValue;
		$this->Date_Delivered->ViewValue = ew_FormatDateTime($this->Date_Delivered->ViewValue, 10);
		$this->Date_Delivered->CssStyle = "";
		$this->Date_Delivered->CssClass = "";
		$this->Date_Delivered->ViewCustomAttributes = "";

		// Date_Updated
		$this->Date_Updated->ViewValue = $this->Date_Updated->CurrentValue;
		$this->Date_Updated->ViewValue = ew_FormatDateTime($this->Date_Updated->ViewValue, 6);
		$this->Date_Updated->CssStyle = "";
		$this->Date_Updated->CssClass = "";
		$this->Date_Updated->ViewCustomAttributes = "";

		// Remarks
		$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
		$this->Remarks->CssStyle = "";
		$this->Remarks->CssClass = "";
		$this->Remarks->ViewCustomAttributes = "";

		// User
		if (strval($this->User->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->User->CurrentValue) . "";
		$sSqlWrk = "SELECT `username` FROM `users`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->User->ViewValue = $rswrk->fields('username');
				$rswrk->Close();
			} else {
				$this->User->ViewValue = $this->User->CurrentValue;
			}
		} else {
			$this->User->ViewValue = NULL;
		}
		$this->User->CssStyle = "";
		$this->User->CssClass = "";
		$this->User->ViewCustomAttributes = "";

		// Booking_Number
		$this->Booking_Number->HrefValue = "";
		$this->Booking_Number->TooltipValue = "";

		// Date
		$this->Date->HrefValue = "";
		$this->Date->TooltipValue = "";

		// Client_ID
		$this->Client_ID->HrefValue = "";
		$this->Client_ID->TooltipValue = "";

		// Origin_ID
		$this->Origin_ID->HrefValue = "";
		$this->Origin_ID->TooltipValue = "";

		// Customer_ID
		$this->Customer_ID->HrefValue = "";
		$this->Customer_ID->TooltipValue = "";

		// Destination_ID
		$this->Destination_ID->HrefValue = "";
		$this->Destination_ID->TooltipValue = "";

		// Subcon_ID
		$this->Subcon_ID->HrefValue = "";
		$this->Subcon_ID->TooltipValue = "";

		// Truck_ID
		$this->Truck_ID->HrefValue = "";
		$this->Truck_ID->TooltipValue = "";

		// ETD
		$this->ETD->HrefValue = "";
		$this->ETD->TooltipValue = "";

		// ETA
		$this->ETA->HrefValue = "";
		$this->ETA->TooltipValue = "";

		// Billing_Type_ID
		$this->Billing_Type_ID->HrefValue = "";
		$this->Billing_Type_ID->TooltipValue = "";

		// Doc_Reference_Number
		$this->Doc_Reference_Number->HrefValue = "";
		$this->Doc_Reference_Number->TooltipValue = "";

		// Truck_Driver_ID
		$this->Truck_Driver_ID->HrefValue = "";
		$this->Truck_Driver_ID->TooltipValue = "";

		// Status_ID
		$this->Status_ID->HrefValue = "";
		$this->Status_ID->TooltipValue = "";

		// Unit_ID
		$this->Unit_ID->HrefValue = "";
		$this->Unit_ID->TooltipValue = "";

		// Quantity
		$this->Quantity->HrefValue = "";
		$this->Quantity->TooltipValue = "";

		// Freight
		$this->Freight->HrefValue = "";
		$this->Freight->TooltipValue = "";

		// Vat
		$this->Vat->HrefValue = "";
		$this->Vat->TooltipValue = "";

		// Total_Sales
		$this->Total_Sales->HrefValue = "";
		$this->Total_Sales->TooltipValue = "";

		// Wtax
		$this->Wtax->HrefValue = "";
		$this->Wtax->TooltipValue = "";

		// Total_Amount_Due
		$this->Total_Amount_Due->HrefValue = "";
		$this->Total_Amount_Due->TooltipValue = "";

		// Date_Delivered
		$this->Date_Delivered->HrefValue = "";
		$this->Date_Delivered->TooltipValue = "";

		// Date_Updated
		$this->Date_Updated->HrefValue = "";
		$this->Date_Updated->TooltipValue = "";

		// Remarks
		$this->Remarks->HrefValue = "";
		$this->Remarks->TooltipValue = "";

		// User
		$this->User->HrefValue = "";
		$this->User->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->Quantity->CurrentValue))
				$this->Quantity->Total += $this->Quantity->CurrentValue; // Accumulate total
			if (is_numeric($this->Freight->CurrentValue))
				$this->Freight->Total += $this->Freight->CurrentValue; // Accumulate total
			if (is_numeric($this->Vat->CurrentValue))
				$this->Vat->Total += $this->Vat->CurrentValue; // Accumulate total
			if (is_numeric($this->Total_Sales->CurrentValue))
				$this->Total_Sales->Total += $this->Total_Sales->CurrentValue; // Accumulate total
			if (is_numeric($this->Wtax->CurrentValue))
				$this->Wtax->Total += $this->Wtax->CurrentValue; // Accumulate total
			if (is_numeric($this->Total_Amount_Due->CurrentValue))
				$this->Total_Amount_Due->Total += $this->Total_Amount_Due->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->Quantity->CurrentValue = $this->Quantity->Total;
			$this->Quantity->ViewValue = $this->Quantity->CurrentValue;
			$this->Quantity->ViewValue = ew_FormatNumber($this->Quantity->ViewValue, 2, -2, -2, -2);
			$this->Quantity->CssStyle = "";
			$this->Quantity->CssClass = "";
			$this->Quantity->ViewCustomAttributes = "";
			$this->Quantity->HrefValue = ""; // Clear href value
			$this->Freight->CurrentValue = $this->Freight->Total;
			$this->Freight->ViewValue = $this->Freight->CurrentValue;
			$this->Freight->ViewValue = ew_FormatNumber($this->Freight->ViewValue, 2, -2, -2, -2);
			$this->Freight->CssStyle = "";
			$this->Freight->CssClass = "";
			$this->Freight->ViewCustomAttributes = "";
			$this->Freight->HrefValue = ""; // Clear href value
			$this->Vat->CurrentValue = $this->Vat->Total;
			$this->Vat->ViewValue = $this->Vat->CurrentValue;
			$this->Vat->ViewValue = ew_FormatNumber($this->Vat->ViewValue, 2, -2, -2, -2);
			$this->Vat->CssStyle = "";
			$this->Vat->CssClass = "";
			$this->Vat->ViewCustomAttributes = "";
			$this->Vat->HrefValue = ""; // Clear href value
			$this->Total_Sales->CurrentValue = $this->Total_Sales->Total;
			$this->Total_Sales->ViewValue = $this->Total_Sales->CurrentValue;
			$this->Total_Sales->ViewValue = ew_FormatNumber($this->Total_Sales->ViewValue, 2, -2, -2, -2);
			$this->Total_Sales->CssStyle = "";
			$this->Total_Sales->CssClass = "";
			$this->Total_Sales->ViewCustomAttributes = "";
			$this->Total_Sales->HrefValue = ""; // Clear href value
			$this->Wtax->CurrentValue = $this->Wtax->Total;
			$this->Wtax->ViewValue = $this->Wtax->CurrentValue;
			$this->Wtax->ViewValue = ew_FormatNumber($this->Wtax->ViewValue, 2, -2, -2, -2);
			$this->Wtax->CssStyle = "";
			$this->Wtax->CssClass = "";
			$this->Wtax->ViewCustomAttributes = "";
			$this->Wtax->HrefValue = ""; // Clear href value
			$this->Total_Amount_Due->CurrentValue = $this->Total_Amount_Due->Total;
			$this->Total_Amount_Due->ViewValue = $this->Total_Amount_Due->CurrentValue;
			$this->Total_Amount_Due->ViewValue = ew_FormatNumber($this->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
			$this->Total_Amount_Due->CssStyle = "";
			$this->Total_Amount_Due->CssClass = "";
			$this->Total_Amount_Due->ViewCustomAttributes = "";
			$this->Total_Amount_Due->HrefValue = ""; // Clear href value
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

		function Row_Inserting(&$rs) {
  global $conn;
                $vat_value = 0;
                $total_sales = 0;

                    // Enter your code here
                    // To cancel, set return value to FALSE   
                    //get alias and account number of client

                    $sSql = "SELECT alias, account_no FROM clients where id = " . $this->Client_ID->CurrentValue;
                    $rswrk = $conn->Execute($sSql);
                    $client_alias = $rswrk->fields('alias');
                    $client_acc_no = $rswrk->fields('account_no');

                    //get last booking id 
                    $lastID_sSql = "SELECT id FROM bookings order by id desc limit 1";
                    $lastID_rswrk = $conn->Execute($lastID_sSql);
                    $booking_lastID = $lastID_rswrk->fields('id');
                    $booking_number = $client_acc_no."-".$client_alias."-".$booking_lastID; //concat
                    
                    //get truck ID in trucks`
                    $truck_id_sSql = "SELECT Truck_Types_ID FROM trucks where id = '". $this->Truck_ID->CurrentValue ."'";
                     $truck_id_rswrk = $conn->Execute($truck_id_sSql);
                    $truck_type_id = $truck_id_rswrk->fields('Truck_Types_ID');
                                              
                    //get freight rate
                    $rate_sSql = "SELECT Freight_Rate,Vat,Wtax FROM rates where Client_ID = ". $this->Client_ID->CurrentValue ." and Origin_ID = ". $this->Origin_ID->CurrentValue ." and Destination_ID = ". $this->Destination_ID->CurrentValue . " and Truck_Type_ID = " . $truck_type_id . " Order By ID desc LIMIT 1";
                    $rate_rswrk = $conn->Execute($rate_sSql);
                    $rate_value = $rate_rswrk->fields('Freight_Rate');
                    
                    
                    //get total
                    $total = $rate_value * $this->Quantity->CurrentValue;

                    //get VAT and total sales
                    $is_vat = $rate_rswrk->fields('Vat');
                    $is_wtax = $rate_rswrk->fields('Wtax');
                    if($is_vat != 0){
                        $vat_value = ($total * $is_vat)/100;
                        $total_sales = $total + $vat_value;
                    }else{
                        $total_sales = $total;
                    }
                
                    //compute WithHolding Tax
                    if($is_wtax != 0){
                        $wtax = ($total * $is_wtax)/100;
                    }else{
                        $wtax = $is_wtax;
                    }
                    

                    //set values
                    $rs["Booking_Number"] = $booking_number;
                    $rs["Freight"] = $total;
                    $rs["Vat"] = $vat_value;
                    $rs["Total_Sales"] = $total_sales;
                    $rs["Wtax"] = $wtax;
                    $rs["Total_Amount_Due"] = $total_sales - $wtax;
                    $rs["Status_ID"] = 12;
                    $rs["Billing_Type_ID"] = 1;
                    $rs["User"] = $this->CurrentUserID;
                    if(is_null( $rate_value) ){
                        echo "<script> alert('WARNING! Rate not Found'); </script>";
                        return false; 
                    }else{
                        return true; 
                    }                     
                                                 
}                  


	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

		// Row Updating event
function Row_Updating(&$rsold, &$rsnew) {
    // Enter your code here
    // To cancel, set return value to FALSE
    global $conn;
        $vat_value = 0;
        $total_sales = 0;
        $total = 0;
        $is_vat = 0;
        $wtax = 0;
  //get truck ID in trucks`
        $truck_id_sSql = "SELECT Truck_Types_ID FROM trucks where id = '". $this->Truck_ID->CurrentValue ."'";
        $truck_id_rswrk = $conn->Execute($truck_id_sSql);
        $truck_type_id = $truck_id_rswrk->fields('Truck_Types_ID');
        
        //get freight rate
        $rate_sSql = "SELECT Freight_Rate,Vat,Wtax FROM rates where Client_ID = ". $this->Client_ID->CurrentValue ." and Origin_ID = ". $this->Origin_ID->CurrentValue ." and Destination_ID = ". $this->Destination_ID->CurrentValue . " and Truck_Type_ID = " . $truck_type_id . " Order By ID desc LIMIT 1";
        $rate_rswrk = $conn->Execute($rate_sSql);
        $rate_value = $rate_rswrk->fields('Freight_Rate');
        //get total
        $total = $rate_value * $this->Quantity->CurrentValue;
        
        if(($rsnew["Quantity"] != $rsold["Quantity"]) == true){
        //get VAT and total sales
        $is_vat = $rate_rswrk->fields('Vat');
        $is_wtax = $rate_rswrk->fields('Wtax');
        if($is_vat != 0){
            $vat_value = ($total * $is_vat)/100;
            $total_sales = $total + $vat_value;
        }else{
            $total_sales = $total;
        }
        
        //compute WithHolding Tax
        if($is_wtax != 0){                
            $wtax = ($total * $is_wtax)/100;
        }else{
            $wtax = $is_wtax;
        }
        
        //set values
        //$rs["Booking_Number"] = $booking_number;
        $rsnew["Freight"] = $total;
        $rsnew["Vat"] = $vat_value;
        $rsnew["Total_Sales"] = $total_sales;
        $rsnew["Wtax"] = $wtax;
        $rsnew["Total_Amount_Due"] = $total_sales - $wtax;   
        if(is_null( $rate_value) ){
            echo "<script> alert('WARNING! Rate not Found'); </script>";
        return false; 
        }
        //    echo $vat_value;
        }
        
        return true;
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
