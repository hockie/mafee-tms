<?php

// Global variable for table object
$expenses = NULL;

//
// Table class for expenses
//
class cexpenses {
	var $TableVar = 'expenses';
	var $TableName = 'expenses';
	var $TableType = 'TABLE';
	var $id;
	var $Date_Created;
	var $expense_date;
	var $expense_category_id;
	var $Reference_No;
	var $Booking_ID;
	var $Description;
	var $Amount;
	var $Vat;
	var $Total_Sales;
	var $Wtax;
	var $Total_Amount_Due;
	var $File_Upload;
	var $Expenses_Type_ID;
	var $Add_To_Billing;
	var $approver;
	var $employee_id;
	var $modified;
	var $user_id;
	var $payment_mode;
	var $status;
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
	function cexpenses() {
		global $Language;

		// id
		$this->id = new cField('expenses', 'expenses', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Date_Created
		$this->Date_Created = new cField('expenses', 'expenses', 'x_Date_Created', 'Date_Created', '`Date_Created`', 133, 6, FALSE, '`Date_Created`', FALSE);
		$this->Date_Created->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date_Created'] =& $this->Date_Created;

		// expense_date
		$this->expense_date = new cField('expenses', 'expenses', 'x_expense_date', 'expense_date', '`expense_date`', 133, 6, FALSE, '`expense_date`', FALSE);
		$this->expense_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['expense_date'] =& $this->expense_date;

		// expense_category_id
		$this->expense_category_id = new cField('expenses', 'expenses', 'x_expense_category_id', 'expense_category_id', '`expense_category_id`', 3, -1, FALSE, '`expense_category_id`', FALSE);
		$this->expense_category_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['expense_category_id'] =& $this->expense_category_id;

		// Reference_No
		$this->Reference_No = new cField('expenses', 'expenses', 'x_Reference_No', 'Reference_No', '`Reference_No`', 200, -1, FALSE, '`Reference_No`', FALSE);
		$this->fields['Reference_No'] =& $this->Reference_No;

		// Booking_ID
		$this->Booking_ID = new cField('expenses', 'expenses', 'x_Booking_ID', 'Booking_ID', '`Booking_ID`', 3, -1, FALSE, '`Booking_ID`', FALSE);
		$this->Booking_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Booking_ID'] =& $this->Booking_ID;

		// Description
		$this->Description = new cField('expenses', 'expenses', 'x_Description', 'Description', '`Description`', 201, -1, FALSE, '`Description`', FALSE);
		$this->Description->TruncateMemoRemoveHtml = TRUE;
		$this->fields['Description'] =& $this->Description;

		// Amount
		$this->Amount = new cField('expenses', 'expenses', 'x_Amount', 'Amount', '`Amount`', 131, -1, FALSE, '`Amount`', FALSE);
		$this->Amount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Amount'] =& $this->Amount;

		// Vat
		$this->Vat = new cField('expenses', 'expenses', 'x_Vat', 'Vat', '`Vat`', 131, -1, FALSE, '`Vat`', FALSE);
		$this->Vat->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Vat'] =& $this->Vat;

		// Total_Sales
		$this->Total_Sales = new cField('expenses', 'expenses', 'x_Total_Sales', 'Total_Sales', '`Total_Sales`', 131, -1, FALSE, '`Total_Sales`', FALSE);
		$this->Total_Sales->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Sales'] =& $this->Total_Sales;

		// Wtax
		$this->Wtax = new cField('expenses', 'expenses', 'x_Wtax', 'Wtax', '`Wtax`', 131, -1, FALSE, '`Wtax`', FALSE);
		$this->Wtax->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Wtax'] =& $this->Wtax;

		// Total_Amount_Due
		$this->Total_Amount_Due = new cField('expenses', 'expenses', 'x_Total_Amount_Due', 'Total_Amount_Due', '`Total_Amount_Due`', 131, -1, FALSE, '`Total_Amount_Due`', FALSE);
		$this->Total_Amount_Due->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Amount_Due'] =& $this->Total_Amount_Due;

		// File_Upload
		$this->File_Upload = new cField('expenses', 'expenses', 'x_File_Upload', 'File_Upload', '`File_Upload`', 200, -1, TRUE, '`File_Upload`', FALSE);
		$this->File_Upload->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->fields['File_Upload'] =& $this->File_Upload;

		// Expenses_Type_ID
		$this->Expenses_Type_ID = new cField('expenses', 'expenses', 'x_Expenses_Type_ID', 'Expenses_Type_ID', '`Expenses_Type_ID`', 3, -1, FALSE, '`Expenses_Type_ID`', FALSE);
		$this->Expenses_Type_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Expenses_Type_ID'] =& $this->Expenses_Type_ID;

		// Add_To_Billing
		$this->Add_To_Billing = new cField('expenses', 'expenses', 'x_Add_To_Billing', 'Add_To_Billing', '`Add_To_Billing`', 200, -1, FALSE, '`Add_To_Billing`', FALSE);
		$this->fields['Add_To_Billing'] =& $this->Add_To_Billing;

		// approver
		$this->approver = new cField('expenses', 'expenses', 'x_approver', 'approver', '`approver`', 3, -1, FALSE, '`approver`', FALSE);
		$this->approver->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['approver'] =& $this->approver;

		// employee_id
		$this->employee_id = new cField('expenses', 'expenses', 'x_employee_id', 'employee_id', '`employee_id`', 3, -1, FALSE, '`employee_id`', FALSE);
		$this->employee_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['employee_id'] =& $this->employee_id;

		// modified
		$this->modified = new cField('expenses', 'expenses', 'x_modified', 'modified', '`modified`', 135, 6, FALSE, '`modified`', FALSE);
		$this->modified->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['modified'] =& $this->modified;

		// user_id
		$this->user_id = new cField('expenses', 'expenses', 'x_user_id', 'user_id', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE);
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] =& $this->user_id;

		// payment_mode
		$this->payment_mode = new cField('expenses', 'expenses', 'x_payment_mode', 'payment_mode', '`payment_mode`', 200, -1, FALSE, '`payment_mode`', FALSE);
		$this->fields['payment_mode'] =& $this->payment_mode;

		// status
		$this->status = new cField('expenses', 'expenses', 'x_status', 'status', '`status`', 200, -1, FALSE, '`status`', FALSE);
		$this->fields['status'] =& $this->status;

		// Remarks
		$this->Remarks = new cField('expenses', 'expenses', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
		$this->Remarks->TruncateMemoRemoveHtml = TRUE;
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
		return "expenses_Highlight";
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
	function SqlMasterFilter_bookings() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_bookings() {
		return "`Booking_ID`=@Booking_ID@";
	}

	// Master filter
	function SqlMasterFilter_accounts_receivable() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_accounts_receivable() {
		return "`Booking_ID`=@Booking_ID@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`expenses`";
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
		return "`Date_Created` DESC";
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
		return "INSERT INTO `expenses` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `expenses` SET ";
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
		$SQL = "DELETE FROM `expenses` WHERE ";
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
			return "expenseslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "expenseslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("expensesview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "expensesadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("expensesedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("expensesadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("expensesdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=expenses" : "";
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
		$this->Date_Created->setDbValue($rs->fields('Date_Created'));
		$this->expense_date->setDbValue($rs->fields('expense_date'));
		$this->expense_category_id->setDbValue($rs->fields('expense_category_id'));
		$this->Reference_No->setDbValue($rs->fields('Reference_No'));
		$this->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$this->Description->setDbValue($rs->fields('Description'));
		$this->Amount->setDbValue($rs->fields('Amount'));
		$this->Vat->setDbValue($rs->fields('Vat'));
		$this->Total_Sales->setDbValue($rs->fields('Total_Sales'));
		$this->Wtax->setDbValue($rs->fields('Wtax'));
		$this->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$this->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
		$this->Expenses_Type_ID->setDbValue($rs->fields('Expenses_Type_ID'));
		$this->Add_To_Billing->setDbValue($rs->fields('Add_To_Billing'));
		$this->approver->setDbValue($rs->fields('approver'));
		$this->employee_id->setDbValue($rs->fields('employee_id'));
		$this->modified->setDbValue($rs->fields('modified'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->payment_mode->setDbValue($rs->fields('payment_mode'));
		$this->status->setDbValue($rs->fields('status'));
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

		// Date_Created
		$this->Date_Created->CellCssStyle = ""; $this->Date_Created->CellCssClass = "";
		$this->Date_Created->CellAttrs = array(); $this->Date_Created->ViewAttrs = array(); $this->Date_Created->EditAttrs = array();

		// expense_date
		$this->expense_date->CellCssStyle = ""; $this->expense_date->CellCssClass = "";
		$this->expense_date->CellAttrs = array(); $this->expense_date->ViewAttrs = array(); $this->expense_date->EditAttrs = array();

		// expense_category_id
		$this->expense_category_id->CellCssStyle = ""; $this->expense_category_id->CellCssClass = "";
		$this->expense_category_id->CellAttrs = array(); $this->expense_category_id->ViewAttrs = array(); $this->expense_category_id->EditAttrs = array();

		// Reference_No
		$this->Reference_No->CellCssStyle = ""; $this->Reference_No->CellCssClass = "";
		$this->Reference_No->CellAttrs = array(); $this->Reference_No->ViewAttrs = array(); $this->Reference_No->EditAttrs = array();

		// Booking_ID
		$this->Booking_ID->CellCssStyle = ""; $this->Booking_ID->CellCssClass = "";
		$this->Booking_ID->CellAttrs = array(); $this->Booking_ID->ViewAttrs = array(); $this->Booking_ID->EditAttrs = array();

		// Description
		$this->Description->CellCssStyle = ""; $this->Description->CellCssClass = "";
		$this->Description->CellAttrs = array(); $this->Description->ViewAttrs = array(); $this->Description->EditAttrs = array();

		// Amount
		$this->Amount->CellCssStyle = ""; $this->Amount->CellCssClass = "";
		$this->Amount->CellAttrs = array(); $this->Amount->ViewAttrs = array(); $this->Amount->EditAttrs = array();

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

		// File_Upload
		$this->File_Upload->CellCssStyle = ""; $this->File_Upload->CellCssClass = "";
		$this->File_Upload->CellAttrs = array(); $this->File_Upload->ViewAttrs = array(); $this->File_Upload->EditAttrs = array();

		// Expenses_Type_ID
		$this->Expenses_Type_ID->CellCssStyle = ""; $this->Expenses_Type_ID->CellCssClass = "";
		$this->Expenses_Type_ID->CellAttrs = array(); $this->Expenses_Type_ID->ViewAttrs = array(); $this->Expenses_Type_ID->EditAttrs = array();

		// Add_To_Billing
		$this->Add_To_Billing->CellCssStyle = ""; $this->Add_To_Billing->CellCssClass = "";
		$this->Add_To_Billing->CellAttrs = array(); $this->Add_To_Billing->ViewAttrs = array(); $this->Add_To_Billing->EditAttrs = array();

		// approver
		$this->approver->CellCssStyle = ""; $this->approver->CellCssClass = "";
		$this->approver->CellAttrs = array(); $this->approver->ViewAttrs = array(); $this->approver->EditAttrs = array();

		// employee_id
		$this->employee_id->CellCssStyle = ""; $this->employee_id->CellCssClass = "";
		$this->employee_id->CellAttrs = array(); $this->employee_id->ViewAttrs = array(); $this->employee_id->EditAttrs = array();

		// modified
		$this->modified->CellCssStyle = ""; $this->modified->CellCssClass = "";
		$this->modified->CellAttrs = array(); $this->modified->ViewAttrs = array(); $this->modified->EditAttrs = array();

		// user_id
		$this->user_id->CellCssStyle = ""; $this->user_id->CellCssClass = "";
		$this->user_id->CellAttrs = array(); $this->user_id->ViewAttrs = array(); $this->user_id->EditAttrs = array();

		// payment_mode
		$this->payment_mode->CellCssStyle = ""; $this->payment_mode->CellCssClass = "";
		$this->payment_mode->CellAttrs = array(); $this->payment_mode->ViewAttrs = array(); $this->payment_mode->EditAttrs = array();

		// status
		$this->status->CellCssStyle = ""; $this->status->CellCssClass = "";
		$this->status->CellAttrs = array(); $this->status->ViewAttrs = array(); $this->status->EditAttrs = array();

		// Remarks
		$this->Remarks->CellCssStyle = ""; $this->Remarks->CellCssClass = "";
		$this->Remarks->CellAttrs = array(); $this->Remarks->ViewAttrs = array(); $this->Remarks->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// Date_Created
		$this->Date_Created->ViewValue = $this->Date_Created->CurrentValue;
		$this->Date_Created->ViewValue = ew_FormatDateTime($this->Date_Created->ViewValue, 6);
		$this->Date_Created->CssStyle = "";
		$this->Date_Created->CssClass = "";
		$this->Date_Created->ViewCustomAttributes = "";

		// expense_date
		$this->expense_date->ViewValue = $this->expense_date->CurrentValue;
		$this->expense_date->ViewValue = ew_FormatDateTime($this->expense_date->ViewValue, 6);
		$this->expense_date->CssStyle = "";
		$this->expense_date->CssClass = "";
		$this->expense_date->ViewCustomAttributes = "";

		// expense_category_id
		if (strval($this->expense_category_id->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->expense_category_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `internal_reference`, `category_name` FROM `expense_categories`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `category_name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->expense_category_id->ViewValue = $rswrk->fields('internal_reference');
				$this->expense_category_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('category_name');
				$rswrk->Close();
			} else {
				$this->expense_category_id->ViewValue = $this->expense_category_id->CurrentValue;
			}
		} else {
			$this->expense_category_id->ViewValue = NULL;
		}
		$this->expense_category_id->CssStyle = "";
		$this->expense_category_id->CssClass = "";
		$this->expense_category_id->ViewCustomAttributes = "";

		// Reference_No
		$this->Reference_No->ViewValue = $this->Reference_No->CurrentValue;
		$this->Reference_No->CssStyle = "";
		$this->Reference_No->CssClass = "";
		$this->Reference_No->ViewCustomAttributes = "";

		// Booking_ID
		$this->Booking_ID->ViewValue = $this->Booking_ID->CurrentValue;
		if (strval($this->Booking_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Booking_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Booking_ID->ViewValue = $rswrk->fields('Booking_Number');
				$rswrk->Close();
			} else {
				$this->Booking_ID->ViewValue = $this->Booking_ID->CurrentValue;
			}
		} else {
			$this->Booking_ID->ViewValue = NULL;
		}
		$this->Booking_ID->CssStyle = "";
		$this->Booking_ID->CssClass = "";
		$this->Booking_ID->ViewCustomAttributes = "";

		// Description
		$this->Description->ViewValue = $this->Description->CurrentValue;
		$this->Description->CssStyle = "";
		$this->Description->CssClass = "";
		$this->Description->ViewCustomAttributes = "";

		// Amount
		$this->Amount->ViewValue = $this->Amount->CurrentValue;
		$this->Amount->ViewValue = ew_FormatNumber($this->Amount->ViewValue, 2, -2, -2, -2);
		$this->Amount->CssStyle = "";
		$this->Amount->CssClass = "";
		$this->Amount->ViewCustomAttributes = "";

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

		// File_Upload
		if (!ew_Empty($this->File_Upload->Upload->DbValue)) {
			$this->File_Upload->ViewValue = $this->File_Upload->Upload->DbValue;
		} else {
			$this->File_Upload->ViewValue = "";
		}
		$this->File_Upload->CssStyle = "";
		$this->File_Upload->CssClass = "";
		$this->File_Upload->ViewCustomAttributes = "";

		// Expenses_Type_ID
		if (strval($this->Expenses_Type_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Expenses_Type_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Expenses_Type` FROM `expenses_types`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Expenses_Type_ID->ViewValue = $rswrk->fields('Expenses_Type');
				$rswrk->Close();
			} else {
				$this->Expenses_Type_ID->ViewValue = $this->Expenses_Type_ID->CurrentValue;
			}
		} else {
			$this->Expenses_Type_ID->ViewValue = NULL;
		}
		$this->Expenses_Type_ID->CssStyle = "";
		$this->Expenses_Type_ID->CssClass = "";
		$this->Expenses_Type_ID->ViewCustomAttributes = "";

		// Add_To_Billing
		if (strval($this->Add_To_Billing->CurrentValue) <> "") {
			switch ($this->Add_To_Billing->CurrentValue) {
				case "YES":
					$this->Add_To_Billing->ViewValue = "YES";
					break;
				case "NO":
					$this->Add_To_Billing->ViewValue = "NO";
					break;
				default:
					$this->Add_To_Billing->ViewValue = $this->Add_To_Billing->CurrentValue;
			}
		} else {
			$this->Add_To_Billing->ViewValue = NULL;
		}
		$this->Add_To_Billing->CssStyle = "";
		$this->Add_To_Billing->CssClass = "";
		$this->Add_To_Billing->ViewCustomAttributes = "";

		// approver
		if (strval($this->approver->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->approver->CurrentValue) . "";
		$sSqlWrk = "SELECT `FirstName`, `LastName` FROM `employees`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `FirstName` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->approver->ViewValue = $rswrk->fields('FirstName');
				$this->approver->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('LastName');
				$rswrk->Close();
			} else {
				$this->approver->ViewValue = $this->approver->CurrentValue;
			}
		} else {
			$this->approver->ViewValue = NULL;
		}
		$this->approver->CssStyle = "";
		$this->approver->CssClass = "";
		$this->approver->ViewCustomAttributes = "";

		// employee_id
		if (strval($this->employee_id->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->employee_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `FirstName`, `LastName` FROM `employees`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `FirstName` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->employee_id->ViewValue = $rswrk->fields('FirstName');
				$this->employee_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('LastName');
				$rswrk->Close();
			} else {
				$this->employee_id->ViewValue = $this->employee_id->CurrentValue;
			}
		} else {
			$this->employee_id->ViewValue = NULL;
		}
		$this->employee_id->CssStyle = "";
		$this->employee_id->CssClass = "";
		$this->employee_id->ViewCustomAttributes = "";

		// modified
		$this->modified->ViewValue = $this->modified->CurrentValue;
		$this->modified->ViewValue = ew_FormatDateTime($this->modified->ViewValue, 6);
		$this->modified->CssStyle = "";
		$this->modified->CssClass = "";
		$this->modified->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->CssStyle = "";
		$this->user_id->CssClass = "";
		$this->user_id->ViewCustomAttributes = "";

		// payment_mode
		if (strval($this->payment_mode->CurrentValue) <> "") {
			switch ($this->payment_mode->CurrentValue) {
				case "reimburse":
					$this->payment_mode->ViewValue = "Employee (to reimburse)";
					break;
				case "company":
					$this->payment_mode->ViewValue = "Company";
					break;
				default:
					$this->payment_mode->ViewValue = $this->payment_mode->CurrentValue;
			}
		} else {
			$this->payment_mode->ViewValue = NULL;
		}
		$this->payment_mode->CssStyle = "";
		$this->payment_mode->CssClass = "";
		$this->payment_mode->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) <> "") {
			switch ($this->status->CurrentValue) {
				case "for_approval":
					$this->status->ViewValue = "For Approval";
					break;
				case "approved":
					$this->status->ViewValue = "Approved";
					break;
				case "declined":
					$this->status->ViewValue = "Declined";
					break;
				case "done":
					$this->status->ViewValue = "Done";
					break;
				default:
					$this->status->ViewValue = $this->status->CurrentValue;
			}
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->CssStyle = "";
		$this->status->CssClass = "";
		$this->status->ViewCustomAttributes = "";

		// Remarks
		$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
		$this->Remarks->CssStyle = "";
		$this->Remarks->CssClass = "";
		$this->Remarks->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// Date_Created
		$this->Date_Created->HrefValue = "";
		$this->Date_Created->TooltipValue = "";

		// expense_date
		$this->expense_date->HrefValue = "";
		$this->expense_date->TooltipValue = "";

		// expense_category_id
		$this->expense_category_id->HrefValue = "";
		$this->expense_category_id->TooltipValue = "";

		// Reference_No
		$this->Reference_No->HrefValue = "";
		$this->Reference_No->TooltipValue = "";

		// Booking_ID
		$this->Booking_ID->HrefValue = "";
		$this->Booking_ID->TooltipValue = "";

		// Description
		$this->Description->HrefValue = "";
		$this->Description->TooltipValue = "";

		// Amount
		$this->Amount->HrefValue = "";
		$this->Amount->TooltipValue = "";

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

		// File_Upload
		if (!ew_Empty($this->File_Upload->Upload->DbValue)) {
			$this->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $this->File_Upload->UploadPath) . ((!empty($this->File_Upload->ViewValue)) ? $this->File_Upload->ViewValue : $this->File_Upload->CurrentValue);
			if ($this->Export <> "") $expenses->File_Upload->HrefValue = ew_ConvertFullUrl($this->File_Upload->HrefValue);
		} else {
			$this->File_Upload->HrefValue = "";
		}
		$this->File_Upload->TooltipValue = "";

		// Expenses_Type_ID
		$this->Expenses_Type_ID->HrefValue = "";
		$this->Expenses_Type_ID->TooltipValue = "";

		// Add_To_Billing
		$this->Add_To_Billing->HrefValue = "";
		$this->Add_To_Billing->TooltipValue = "";

		// approver
		$this->approver->HrefValue = "";
		$this->approver->TooltipValue = "";

		// employee_id
		$this->employee_id->HrefValue = "";
		$this->employee_id->TooltipValue = "";

		// modified
		$this->modified->HrefValue = "";
		$this->modified->TooltipValue = "";

		// user_id
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// payment_mode
		$this->payment_mode->HrefValue = "";
		$this->payment_mode->TooltipValue = "";

		// status
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// Remarks
		$this->Remarks->HrefValue = "";
		$this->Remarks->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->Amount->CurrentValue))
				$this->Amount->Total += $this->Amount->CurrentValue; // Accumulate total
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
			$this->Amount->CurrentValue = $this->Amount->Total;
			$this->Amount->ViewValue = $this->Amount->CurrentValue;
			$this->Amount->ViewValue = ew_FormatNumber($this->Amount->ViewValue, 2, -2, -2, -2);
			$this->Amount->CssStyle = "";
			$this->Amount->CssClass = "";
			$this->Amount->ViewCustomAttributes = "";
			$this->Amount->HrefValue = ""; // Clear href value
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

		// Row Inserting event
function Row_Inserting(&$rs) {
  // Enter your code here
    // To cancel, set return value to FALSE
     global $conn;
        $vat_value = 0;
        $wtax_value = 0;
        $vatinc = 1.12;
        $vatable = 0;
        $vat = 0;
        $whtax = 0;
        
        if($rs['Booking_ID']){
        //SQL To select booking details
        $sSql = "SELECT ID, Client_ID, Destination_ID, Origin_ID, Truck_ID FROM bookings WHERE id = " . $this->Booking_ID->CurrentValue;
        $rswrk = $conn->Execute($sSql);
        $booking_id = $rswrk->fields('ID');
        $client_id = $rswrk->fields('Client_ID');
        $destination_id = $rswrk->fields('Destination_ID');
        $origin_id = $rswrk->fields('Origin_ID');
        $truck_id = $rswrk->fields('Truck_ID');
        
        //get truck ID in trucks`
        $truck_id_sSql = "SELECT Truck_Types_ID FROM trucks where id = ". $truck_id;
        $truck_id_rswrk = $conn->Execute($truck_id_sSql);
        $truck_type_id = $truck_id_rswrk->fields('Truck_Types_ID');        
        
        //get rates from rates table 
       // $ratesSql = "SELECT vat, wtax from rates where client_id = " . $client_id . " and destination_id = " . $destination_id;
      $ratesSql = " SELECT ID, Client_ID, Destination_ID, Origin_ID, Freight_Rate, vat, wtax FROM rates where Client_ID = " . $client_id . " and Origin_ID = ".$origin_id." and Truck_Type_ID = ".$truck_type_id."  and Destination_ID = ".$destination_id." order by ID limit 1";
        $rswrk1 = $conn->Execute($ratesSql);
        $vat_rate = $rswrk1->fields('vat');
        $wtax_rate = $rswrk1->fields('wtax');
        
        //vatable
        if($rs["Expenses_Type_ID"] == 1){
            if($vat_rate > 0){
                $vat_value = ($rs["Amount"] * $vat_rate)/100;
                $vat = $vat_value;
            }else{
                $vat_value = $vat_rate;
                $vat = $vat_rate;
            }
            
            //compute wtax 
            if($wtax_rate > 0){
                $wtax_value = ($rs["Amount"] * $wtax_rate)/100;
                $whtax = $wtax_value;
            }else{
                $wtax_value = $wtax_rate;
                $whtax = $wtax_rate;
            }
        }
        
        if($rs["Expenses_Type_ID"] == 2){
            $vat_value = $vat_rate;
            $wtax_value = $wtax_value;
        }
        
        
        // vat inclusive
        
        if($rs["Expenses_Type_ID"] == 5){
            
            $vatable = $rs["Amount"] / $vatinc;
            $vat = ($vatable * $vat_rate)/100;
             $whtax = ($vatable * $wtax_rate)/100;
             $total_amount_due = $vatable - ($vatable * $vat_rate)/100;
             $total_sales = $vatable;
        }
        
        //Add to Bill (NO)
        if($rs["Add_To_Billing"] == "YES"){
            $total_sales = $rs["Amount"] + $vat_value;
            $total_amount_due = $total_sales - $wtax_value;
            /* $vat = $vat_value;
            $whtax = $wtax_value; */
        }else{
            $total_sales = $rs["Amount"];
            $total_amount_due = $total_sales;
            /* $vat = $vat_value;
            $whtax = $wtax_value; */
        }
        
        
        $rs["Vat"] = $vat;
        $rs["Wtax"] = $whtax;
        $rs["Total_Sales"] = $total_sales;
        $rs["Total_Amount_Due"] = $total_amount_due;
        }
        
       // echo $rs["Expenses_Type_ID"];
        // Enter your code here
        // To cancel, set return value to FALSE
        //echo $total_amount_due;
        //echo $vat;
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
