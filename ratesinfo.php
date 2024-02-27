<?php

// Global variable for table object
$rates = NULL;

//
// Table class for rates
//
class crates {
	var $TableVar = 'rates';
	var $TableName = 'rates';
	var $TableType = 'TABLE';
	var $id;
	var $Date;
	var $Client_ID;
	var $Area_ID;
	var $Origin_ID;
	var $Destination_ID;
	var $Distance;
	var $Truck_Type_ID;
	var $Unit_ID;
	var $Freight_Rate;
	var $Vat;
	var $Wtax;
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
	function crates() {
		global $Language;

		// id
		$this->id = new cField('rates', 'rates', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Date
		$this->Date = new cField('rates', 'rates', 'x_Date', 'Date', '`Date`', 135, 6, FALSE, '`Date`', FALSE);
		$this->Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date'] =& $this->Date;

		// Client_ID
		$this->Client_ID = new cField('rates', 'rates', 'x_Client_ID', 'Client_ID', '`Client_ID`', 3, -1, FALSE, '`Client_ID`', FALSE);
		$this->Client_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Client_ID'] =& $this->Client_ID;

		// Area_ID
		$this->Area_ID = new cField('rates', 'rates', 'x_Area_ID', 'Area_ID', '`Area_ID`', 3, -1, FALSE, '`Area_ID`', FALSE);
		$this->Area_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Area_ID'] =& $this->Area_ID;

		// Origin_ID
		$this->Origin_ID = new cField('rates', 'rates', 'x_Origin_ID', 'Origin_ID', '`Origin_ID`', 3, -1, FALSE, '`Origin_ID`', FALSE);
		$this->Origin_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Origin_ID'] =& $this->Origin_ID;

		// Destination_ID
		$this->Destination_ID = new cField('rates', 'rates', 'x_Destination_ID', 'Destination_ID', '`Destination_ID`', 3, -1, FALSE, '`Destination_ID`', FALSE);
		$this->Destination_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Destination_ID'] =& $this->Destination_ID;

		// Distance
		$this->Distance = new cField('rates', 'rates', 'x_Distance', 'Distance', '`Distance`', 200, -1, FALSE, '`Distance`', FALSE);
		$this->fields['Distance'] =& $this->Distance;

		// Truck_Type_ID
		$this->Truck_Type_ID = new cField('rates', 'rates', 'x_Truck_Type_ID', 'Truck_Type_ID', '`Truck_Type_ID`', 3, -1, FALSE, '`Truck_Type_ID`', FALSE);
		$this->Truck_Type_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Truck_Type_ID'] =& $this->Truck_Type_ID;

		// Unit_ID
		$this->Unit_ID = new cField('rates', 'rates', 'x_Unit_ID', 'Unit_ID', '`Unit_ID`', 3, -1, FALSE, '`Unit_ID`', FALSE);
		$this->Unit_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Unit_ID'] =& $this->Unit_ID;

		// Freight_Rate
		$this->Freight_Rate = new cField('rates', 'rates', 'x_Freight_Rate', 'Freight_Rate', '`Freight_Rate`', 4, -1, FALSE, '`Freight_Rate`', FALSE);
		$this->Freight_Rate->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Freight_Rate'] =& $this->Freight_Rate;

		// Vat
		$this->Vat = new cField('rates', 'rates', 'x_Vat', 'Vat', '`Vat`', 4, -1, FALSE, '`Vat`', FALSE);
		$this->Vat->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Vat'] =& $this->Vat;

		// Wtax
		$this->Wtax = new cField('rates', 'rates', 'x_Wtax', 'Wtax', '`Wtax`', 4, -1, FALSE, '`Wtax`', FALSE);
		$this->Wtax->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Wtax'] =& $this->Wtax;

		// Remarks
		$this->Remarks = new cField('rates', 'rates', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
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
		return "rates_Highlight";
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

	// Table level SQL
	function SqlFrom() { // From
		return "`rates`";
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
		return "INSERT INTO `rates` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `rates` SET ";
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
		$SQL = "DELETE FROM `rates` WHERE ";
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
			return "rateslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "rateslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("ratesview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "ratesadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("ratesedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("ratesadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("ratesdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=rates" : "";
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
		$this->Date->setDbValue($rs->fields('Date'));
		$this->Client_ID->setDbValue($rs->fields('Client_ID'));
		$this->Area_ID->setDbValue($rs->fields('Area_ID'));
		$this->Origin_ID->setDbValue($rs->fields('Origin_ID'));
		$this->Destination_ID->setDbValue($rs->fields('Destination_ID'));
		$this->Distance->setDbValue($rs->fields('Distance'));
		$this->Truck_Type_ID->setDbValue($rs->fields('Truck_Type_ID'));
		$this->Unit_ID->setDbValue($rs->fields('Unit_ID'));
		$this->Freight_Rate->setDbValue($rs->fields('Freight_Rate'));
		$this->Vat->setDbValue($rs->fields('Vat'));
		$this->Wtax->setDbValue($rs->fields('Wtax'));
		$this->Remarks->setDbValue($rs->fields('Remarks'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id

		$this->id->CellCssStyle = ""; $this->id->CellCssClass = "";
		$this->id->CellAttrs = array(); $this->id->ViewAttrs = array(); $this->id->EditAttrs = array();

		// Date
		$this->Date->CellCssStyle = ""; $this->Date->CellCssClass = "";
		$this->Date->CellAttrs = array(); $this->Date->ViewAttrs = array(); $this->Date->EditAttrs = array();

		// Client_ID
		$this->Client_ID->CellCssStyle = ""; $this->Client_ID->CellCssClass = "";
		$this->Client_ID->CellAttrs = array(); $this->Client_ID->ViewAttrs = array(); $this->Client_ID->EditAttrs = array();

		// Area_ID
		$this->Area_ID->CellCssStyle = ""; $this->Area_ID->CellCssClass = "";
		$this->Area_ID->CellAttrs = array(); $this->Area_ID->ViewAttrs = array(); $this->Area_ID->EditAttrs = array();

		// Origin_ID
		$this->Origin_ID->CellCssStyle = ""; $this->Origin_ID->CellCssClass = "";
		$this->Origin_ID->CellAttrs = array(); $this->Origin_ID->ViewAttrs = array(); $this->Origin_ID->EditAttrs = array();

		// Destination_ID
		$this->Destination_ID->CellCssStyle = ""; $this->Destination_ID->CellCssClass = "";
		$this->Destination_ID->CellAttrs = array(); $this->Destination_ID->ViewAttrs = array(); $this->Destination_ID->EditAttrs = array();

		// Distance
		$this->Distance->CellCssStyle = ""; $this->Distance->CellCssClass = "";
		$this->Distance->CellAttrs = array(); $this->Distance->ViewAttrs = array(); $this->Distance->EditAttrs = array();

		// Truck_Type_ID
		$this->Truck_Type_ID->CellCssStyle = ""; $this->Truck_Type_ID->CellCssClass = "";
		$this->Truck_Type_ID->CellAttrs = array(); $this->Truck_Type_ID->ViewAttrs = array(); $this->Truck_Type_ID->EditAttrs = array();

		// Unit_ID
		$this->Unit_ID->CellCssStyle = ""; $this->Unit_ID->CellCssClass = "";
		$this->Unit_ID->CellAttrs = array(); $this->Unit_ID->ViewAttrs = array(); $this->Unit_ID->EditAttrs = array();

		// Freight_Rate
		$this->Freight_Rate->CellCssStyle = ""; $this->Freight_Rate->CellCssClass = "";
		$this->Freight_Rate->CellAttrs = array(); $this->Freight_Rate->ViewAttrs = array(); $this->Freight_Rate->EditAttrs = array();

		// Vat
		$this->Vat->CellCssStyle = ""; $this->Vat->CellCssClass = "";
		$this->Vat->CellAttrs = array(); $this->Vat->ViewAttrs = array(); $this->Vat->EditAttrs = array();

		// Wtax
		$this->Wtax->CellCssStyle = ""; $this->Wtax->CellCssClass = "";
		$this->Wtax->CellAttrs = array(); $this->Wtax->ViewAttrs = array(); $this->Wtax->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// Date
		$this->Date->ViewValue = $this->Date->CurrentValue;
		$this->Date->ViewValue = ew_FormatDateTime($this->Date->ViewValue, 6);
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

		// Area_ID
		if (strval($this->Area_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Area_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Area` FROM `areas`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Area_ID->ViewValue = $rswrk->fields('Area');
				$rswrk->Close();
			} else {
				$this->Area_ID->ViewValue = $this->Area_ID->CurrentValue;
			}
		} else {
			$this->Area_ID->ViewValue = NULL;
		}
		$this->Area_ID->CssStyle = "";
		$this->Area_ID->CssClass = "";
		$this->Area_ID->ViewCustomAttributes = "";

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

		// Distance
		$this->Distance->ViewValue = $this->Distance->CurrentValue;
		$this->Distance->CssStyle = "";
		$this->Distance->CssClass = "";
		$this->Distance->ViewCustomAttributes = "";

		// Truck_Type_ID
		if (strval($this->Truck_Type_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Truck_Type_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Truck_Type_ID->ViewValue = $rswrk->fields('Truck_Type');
				$rswrk->Close();
			} else {
				$this->Truck_Type_ID->ViewValue = $this->Truck_Type_ID->CurrentValue;
			}
		} else {
			$this->Truck_Type_ID->ViewValue = NULL;
		}
		$this->Truck_Type_ID->CssStyle = "";
		$this->Truck_Type_ID->CssClass = "";
		$this->Truck_Type_ID->ViewCustomAttributes = "";

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

		// Freight_Rate
		$this->Freight_Rate->ViewValue = $this->Freight_Rate->CurrentValue;
		$this->Freight_Rate->CssStyle = "";
		$this->Freight_Rate->CssClass = "";
		$this->Freight_Rate->ViewCustomAttributes = "";

		// Vat
		$this->Vat->ViewValue = $this->Vat->CurrentValue;
		$this->Vat->CssStyle = "";
		$this->Vat->CssClass = "";
		$this->Vat->ViewCustomAttributes = "";

		// Wtax
		$this->Wtax->ViewValue = $this->Wtax->CurrentValue;
		$this->Wtax->CssStyle = "";
		$this->Wtax->CssClass = "";
		$this->Wtax->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// Date
		$this->Date->HrefValue = "";
		$this->Date->TooltipValue = "";

		// Client_ID
		$this->Client_ID->HrefValue = "";
		$this->Client_ID->TooltipValue = "";

		// Area_ID
		$this->Area_ID->HrefValue = "";
		$this->Area_ID->TooltipValue = "";

		// Origin_ID
		$this->Origin_ID->HrefValue = "";
		$this->Origin_ID->TooltipValue = "";

		// Destination_ID
		$this->Destination_ID->HrefValue = "";
		$this->Destination_ID->TooltipValue = "";

		// Distance
		$this->Distance->HrefValue = "";
		$this->Distance->TooltipValue = "";

		// Truck_Type_ID
		$this->Truck_Type_ID->HrefValue = "";
		$this->Truck_Type_ID->TooltipValue = "";

		// Unit_ID
		$this->Unit_ID->HrefValue = "";
		$this->Unit_ID->TooltipValue = "";

		// Freight_Rate
		$this->Freight_Rate->HrefValue = "";
		$this->Freight_Rate->TooltipValue = "";

		// Vat
		$this->Vat->HrefValue = "";
		$this->Vat->TooltipValue = "";

		// Wtax
		$this->Wtax->HrefValue = "";
		$this->Wtax->TooltipValue = "";

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
