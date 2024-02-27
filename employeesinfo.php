<?php

// Global variable for table object
$employees = NULL;

//
// Table class for employees
//
class cemployees {
	var $TableVar = 'employees';
	var $TableName = 'employees';
	var $TableType = 'TABLE';
	var $id;
	var $EmployeeID;
	var $FirstName;
	var $MiddleName;
	var $LastName;
	var $Username;
	var $EmailAddress;
	var $Address;
	var $MobileNumber;
	var $SubconID;
	var $manager;
	var $Designation;
	var $EmpRateId;
	var $DateHired;
	var $DateTerminated;
	var $EmpStatusId;
	var $Remarks;
	var $Password;
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
	function cemployees() {
		global $Language;

		// id
		$this->id = new cField('employees', 'employees', 'x_id', 'id', '`id`', 19, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// EmployeeID
		$this->EmployeeID = new cField('employees', 'employees', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', 200, -1, FALSE, '`EmployeeID`', FALSE);
		$this->fields['EmployeeID'] =& $this->EmployeeID;

		// FirstName
		$this->FirstName = new cField('employees', 'employees', 'x_FirstName', 'FirstName', '`FirstName`', 200, -1, FALSE, '`FirstName`', FALSE);
		$this->fields['FirstName'] =& $this->FirstName;

		// MiddleName
		$this->MiddleName = new cField('employees', 'employees', 'x_MiddleName', 'MiddleName', '`MiddleName`', 200, -1, FALSE, '`MiddleName`', FALSE);
		$this->fields['MiddleName'] =& $this->MiddleName;

		// LastName
		$this->LastName = new cField('employees', 'employees', 'x_LastName', 'LastName', '`LastName`', 200, -1, FALSE, '`LastName`', FALSE);
		$this->fields['LastName'] =& $this->LastName;

		// Username
		$this->Username = new cField('employees', 'employees', 'x_Username', 'Username', '`Username`', 200, -1, FALSE, '`Username`', FALSE);
		$this->fields['Username'] =& $this->Username;

		// EmailAddress
		$this->EmailAddress = new cField('employees', 'employees', 'x_EmailAddress', 'EmailAddress', '`EmailAddress`', 200, -1, FALSE, '`EmailAddress`', FALSE);
		$this->fields['EmailAddress'] =& $this->EmailAddress;

		// Address
		$this->Address = new cField('employees', 'employees', 'x_Address', 'Address', '`Address`', 200, -1, FALSE, '`Address`', FALSE);
		$this->fields['Address'] =& $this->Address;

		// MobileNumber
		$this->MobileNumber = new cField('employees', 'employees', 'x_MobileNumber', 'MobileNumber', '`MobileNumber`', 200, -1, FALSE, '`MobileNumber`', FALSE);
		$this->fields['MobileNumber'] =& $this->MobileNumber;

		// SubconID
		$this->SubconID = new cField('employees', 'employees', 'x_SubconID', 'SubconID', '`SubconID`', 19, -1, FALSE, '`SubconID`', FALSE);
		$this->SubconID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['SubconID'] =& $this->SubconID;

		// manager
		$this->manager = new cField('employees', 'employees', 'x_manager', 'manager', '`manager`', 3, -1, FALSE, '`manager`', FALSE);
		$this->manager->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['manager'] =& $this->manager;

		// Designation
		$this->Designation = new cField('employees', 'employees', 'x_Designation', 'Designation', '`Designation`', 200, -1, FALSE, '`Designation`', FALSE);
		$this->fields['Designation'] =& $this->Designation;

		// EmpRateId
		$this->EmpRateId = new cField('employees', 'employees', 'x_EmpRateId', 'EmpRateId', '`EmpRateId`', 19, -1, FALSE, '`EmpRateId`', FALSE);
		$this->EmpRateId->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['EmpRateId'] =& $this->EmpRateId;

		// DateHired
		$this->DateHired = new cField('employees', 'employees', 'x_DateHired', 'DateHired', '`DateHired`', 135, 6, FALSE, '`DateHired`', FALSE);
		$this->DateHired->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['DateHired'] =& $this->DateHired;

		// DateTerminated
		$this->DateTerminated = new cField('employees', 'employees', 'x_DateTerminated', 'DateTerminated', '`DateTerminated`', 135, 6, FALSE, '`DateTerminated`', FALSE);
		$this->DateTerminated->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['DateTerminated'] =& $this->DateTerminated;

		// EmpStatusId
		$this->EmpStatusId = new cField('employees', 'employees', 'x_EmpStatusId', 'EmpStatusId', '`EmpStatusId`', 19, -1, FALSE, '`EmpStatusId`', FALSE);
		$this->EmpStatusId->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['EmpStatusId'] =& $this->EmpStatusId;

		// Remarks
		$this->Remarks = new cField('employees', 'employees', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
		$this->fields['Remarks'] =& $this->Remarks;

		// Password
		$this->Password = new cField('employees', 'employees', 'x_Password', 'Password', '`Password`', 200, -1, FALSE, '`Password`', FALSE);
		$this->fields['Password'] =& $this->Password;
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
		return "employees_Highlight";
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

	// Table level SQL
	function SqlFrom() { // From
		return "`employees`";
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
		return "INSERT INTO `employees` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `employees` SET ";
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
		$SQL = "DELETE FROM `employees` WHERE ";
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
			return "employeeslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "employeeslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("employeesview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "employeesadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("employeesedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("employeesadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("employeesdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=employees" : "";
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
		$this->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$this->FirstName->setDbValue($rs->fields('FirstName'));
		$this->MiddleName->setDbValue($rs->fields('MiddleName'));
		$this->LastName->setDbValue($rs->fields('LastName'));
		$this->Username->setDbValue($rs->fields('Username'));
		$this->EmailAddress->setDbValue($rs->fields('EmailAddress'));
		$this->Address->setDbValue($rs->fields('Address'));
		$this->MobileNumber->setDbValue($rs->fields('MobileNumber'));
		$this->SubconID->setDbValue($rs->fields('SubconID'));
		$this->manager->setDbValue($rs->fields('manager'));
		$this->Designation->setDbValue($rs->fields('Designation'));
		$this->EmpRateId->setDbValue($rs->fields('EmpRateId'));
		$this->DateHired->setDbValue($rs->fields('DateHired'));
		$this->DateTerminated->setDbValue($rs->fields('DateTerminated'));
		$this->EmpStatusId->setDbValue($rs->fields('EmpStatusId'));
		$this->Remarks->setDbValue($rs->fields('Remarks'));
		$this->Password->setDbValue($rs->fields('Password'));
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

		// EmployeeID
		$this->EmployeeID->CellCssStyle = ""; $this->EmployeeID->CellCssClass = "";
		$this->EmployeeID->CellAttrs = array(); $this->EmployeeID->ViewAttrs = array(); $this->EmployeeID->EditAttrs = array();

		// FirstName
		$this->FirstName->CellCssStyle = ""; $this->FirstName->CellCssClass = "";
		$this->FirstName->CellAttrs = array(); $this->FirstName->ViewAttrs = array(); $this->FirstName->EditAttrs = array();

		// MiddleName
		$this->MiddleName->CellCssStyle = ""; $this->MiddleName->CellCssClass = "";
		$this->MiddleName->CellAttrs = array(); $this->MiddleName->ViewAttrs = array(); $this->MiddleName->EditAttrs = array();

		// LastName
		$this->LastName->CellCssStyle = ""; $this->LastName->CellCssClass = "";
		$this->LastName->CellAttrs = array(); $this->LastName->ViewAttrs = array(); $this->LastName->EditAttrs = array();

		// Username
		$this->Username->CellCssStyle = ""; $this->Username->CellCssClass = "";
		$this->Username->CellAttrs = array(); $this->Username->ViewAttrs = array(); $this->Username->EditAttrs = array();

		// EmailAddress
		$this->EmailAddress->CellCssStyle = ""; $this->EmailAddress->CellCssClass = "";
		$this->EmailAddress->CellAttrs = array(); $this->EmailAddress->ViewAttrs = array(); $this->EmailAddress->EditAttrs = array();

		// Address
		$this->Address->CellCssStyle = ""; $this->Address->CellCssClass = "";
		$this->Address->CellAttrs = array(); $this->Address->ViewAttrs = array(); $this->Address->EditAttrs = array();

		// MobileNumber
		$this->MobileNumber->CellCssStyle = ""; $this->MobileNumber->CellCssClass = "";
		$this->MobileNumber->CellAttrs = array(); $this->MobileNumber->ViewAttrs = array(); $this->MobileNumber->EditAttrs = array();

		// SubconID
		$this->SubconID->CellCssStyle = ""; $this->SubconID->CellCssClass = "";
		$this->SubconID->CellAttrs = array(); $this->SubconID->ViewAttrs = array(); $this->SubconID->EditAttrs = array();

		// manager
		$this->manager->CellCssStyle = ""; $this->manager->CellCssClass = "";
		$this->manager->CellAttrs = array(); $this->manager->ViewAttrs = array(); $this->manager->EditAttrs = array();

		// Designation
		$this->Designation->CellCssStyle = ""; $this->Designation->CellCssClass = "";
		$this->Designation->CellAttrs = array(); $this->Designation->ViewAttrs = array(); $this->Designation->EditAttrs = array();

		// EmpRateId
		$this->EmpRateId->CellCssStyle = ""; $this->EmpRateId->CellCssClass = "";
		$this->EmpRateId->CellAttrs = array(); $this->EmpRateId->ViewAttrs = array(); $this->EmpRateId->EditAttrs = array();

		// DateHired
		$this->DateHired->CellCssStyle = ""; $this->DateHired->CellCssClass = "";
		$this->DateHired->CellAttrs = array(); $this->DateHired->ViewAttrs = array(); $this->DateHired->EditAttrs = array();

		// DateTerminated
		$this->DateTerminated->CellCssStyle = ""; $this->DateTerminated->CellCssClass = "";
		$this->DateTerminated->CellAttrs = array(); $this->DateTerminated->ViewAttrs = array(); $this->DateTerminated->EditAttrs = array();

		// EmpStatusId
		$this->EmpStatusId->CellCssStyle = ""; $this->EmpStatusId->CellCssClass = "";
		$this->EmpStatusId->CellAttrs = array(); $this->EmpStatusId->ViewAttrs = array(); $this->EmpStatusId->EditAttrs = array();

		// Password
		$this->Password->CellCssStyle = ""; $this->Password->CellCssClass = "";
		$this->Password->CellAttrs = array(); $this->Password->ViewAttrs = array(); $this->Password->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->CssStyle = "";
		$this->EmployeeID->CssClass = "";
		$this->EmployeeID->ViewCustomAttributes = "";

		// FirstName
		$this->FirstName->ViewValue = $this->FirstName->CurrentValue;
		$this->FirstName->CssStyle = "";
		$this->FirstName->CssClass = "";
		$this->FirstName->ViewCustomAttributes = "";

		// MiddleName
		$this->MiddleName->ViewValue = $this->MiddleName->CurrentValue;
		$this->MiddleName->CssStyle = "";
		$this->MiddleName->CssClass = "";
		$this->MiddleName->ViewCustomAttributes = "";

		// LastName
		$this->LastName->ViewValue = $this->LastName->CurrentValue;
		$this->LastName->CssStyle = "";
		$this->LastName->CssClass = "";
		$this->LastName->ViewCustomAttributes = "";

		// Username
		$this->Username->ViewValue = $this->Username->CurrentValue;
		$this->Username->CssStyle = "";
		$this->Username->CssClass = "";
		$this->Username->ViewCustomAttributes = "";

		// EmailAddress
		$this->EmailAddress->ViewValue = $this->EmailAddress->CurrentValue;
		$this->EmailAddress->CssStyle = "";
		$this->EmailAddress->CssClass = "";
		$this->EmailAddress->ViewCustomAttributes = "";

		// Address
		$this->Address->ViewValue = $this->Address->CurrentValue;
		$this->Address->CssStyle = "";
		$this->Address->CssClass = "";
		$this->Address->ViewCustomAttributes = "";

		// MobileNumber
		$this->MobileNumber->ViewValue = $this->MobileNumber->CurrentValue;
		$this->MobileNumber->CssStyle = "";
		$this->MobileNumber->CssClass = "";
		$this->MobileNumber->ViewCustomAttributes = "";

		// SubconID
		if (strval($this->SubconID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->SubconID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Subcon_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->SubconID->ViewValue = $rswrk->fields('Subcon_Name');
				$rswrk->Close();
			} else {
				$this->SubconID->ViewValue = $this->SubconID->CurrentValue;
			}
		} else {
			$this->SubconID->ViewValue = NULL;
		}
		$this->SubconID->CssStyle = "";
		$this->SubconID->CssClass = "";
		$this->SubconID->ViewCustomAttributes = "";

		// manager
		if (strval($this->manager->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->manager->CurrentValue) . "";
		$sSqlWrk = "SELECT `LastName`, `FirstName` FROM `employees`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `LastName` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->manager->ViewValue = $rswrk->fields('LastName');
				$this->manager->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('FirstName');
				$rswrk->Close();
			} else {
				$this->manager->ViewValue = $this->manager->CurrentValue;
			}
		} else {
			$this->manager->ViewValue = NULL;
		}
		$this->manager->CssStyle = "";
		$this->manager->CssClass = "";
		$this->manager->ViewCustomAttributes = "";

		// Designation
		$this->Designation->ViewValue = $this->Designation->CurrentValue;
		$this->Designation->CssStyle = "";
		$this->Designation->CssClass = "";
		$this->Designation->ViewCustomAttributes = "";

		// EmpRateId
		$this->EmpRateId->ViewValue = $this->EmpRateId->CurrentValue;
		$this->EmpRateId->CssStyle = "";
		$this->EmpRateId->CssClass = "";
		$this->EmpRateId->ViewCustomAttributes = "";

		// DateHired
		$this->DateHired->ViewValue = $this->DateHired->CurrentValue;
		$this->DateHired->ViewValue = ew_FormatDateTime($this->DateHired->ViewValue, 6);
		$this->DateHired->CssStyle = "";
		$this->DateHired->CssClass = "";
		$this->DateHired->ViewCustomAttributes = "";

		// DateTerminated
		$this->DateTerminated->ViewValue = $this->DateTerminated->CurrentValue;
		$this->DateTerminated->ViewValue = ew_FormatDateTime($this->DateTerminated->ViewValue, 6);
		$this->DateTerminated->CssStyle = "";
		$this->DateTerminated->CssClass = "";
		$this->DateTerminated->ViewCustomAttributes = "";

		// EmpStatusId
		if (strval($this->EmpStatusId->CurrentValue) <> "") {
			switch ($this->EmpStatusId->CurrentValue) {
				case "regular":
					$this->EmpStatusId->ViewValue = "Regular";
					break;
				case "contractual":
					$this->EmpStatusId->ViewValue = "Contractual";
					break;
				default:
					$this->EmpStatusId->ViewValue = $this->EmpStatusId->CurrentValue;
			}
		} else {
			$this->EmpStatusId->ViewValue = NULL;
		}
		$this->EmpStatusId->CssStyle = "";
		$this->EmpStatusId->CssClass = "";
		$this->EmpStatusId->ViewCustomAttributes = "";

		// Password
		$this->Password->ViewValue = $this->Password->CurrentValue;
		$this->Password->CssStyle = "";
		$this->Password->CssClass = "";
		$this->Password->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// EmployeeID
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// FirstName
		$this->FirstName->HrefValue = "";
		$this->FirstName->TooltipValue = "";

		// MiddleName
		$this->MiddleName->HrefValue = "";
		$this->MiddleName->TooltipValue = "";

		// LastName
		$this->LastName->HrefValue = "";
		$this->LastName->TooltipValue = "";

		// Username
		$this->Username->HrefValue = "";
		$this->Username->TooltipValue = "";

		// EmailAddress
		$this->EmailAddress->HrefValue = "";
		$this->EmailAddress->TooltipValue = "";

		// Address
		$this->Address->HrefValue = "";
		$this->Address->TooltipValue = "";

		// MobileNumber
		$this->MobileNumber->HrefValue = "";
		$this->MobileNumber->TooltipValue = "";

		// SubconID
		$this->SubconID->HrefValue = "";
		$this->SubconID->TooltipValue = "";

		// manager
		$this->manager->HrefValue = "";
		$this->manager->TooltipValue = "";

		// Designation
		$this->Designation->HrefValue = "";
		$this->Designation->TooltipValue = "";

		// EmpRateId
		$this->EmpRateId->HrefValue = "";
		$this->EmpRateId->TooltipValue = "";

		// DateHired
		$this->DateHired->HrefValue = "";
		$this->DateHired->TooltipValue = "";

		// DateTerminated
		$this->DateTerminated->HrefValue = "";
		$this->DateTerminated->TooltipValue = "";

		// EmpStatusId
		$this->EmpStatusId->HrefValue = "";
		$this->EmpStatusId->TooltipValue = "";

		// Password
		$this->Password->HrefValue = "";
		$this->Password->TooltipValue = "";

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
