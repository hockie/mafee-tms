<?php

// Global variable for table object
$account_payments = NULL;

//
// Table class for account_payments
//
class caccount_payments {
	var $TableVar = 'account_payments';
	var $TableName = 'account_payments';
	var $TableType = 'TABLE';
	var $id;
	var $Date;
	var $Payment_Reference;
	var $Payment_Date;
	var $Payment_Type;
	var $Journal_Type_ID;
	var $Journal_Account_ID;
	var $Payment_Method_ID;
	var $Vendor_ID;
	var $Client_ID;
	var $Amount;
	var $Status_ID;
	var $Description;
	var $Remarks;
	var $User_ID;
	var $Created;
	var $Modified;
	var $total_invoice_items;
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
	function caccount_payments() {
		global $Language;

		// id
		$this->id = new cField('account_payments', 'account_payments', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Date
		$this->Date = new cField('account_payments', 'account_payments', 'x_Date', 'Date', '`Date`', 135, 6, FALSE, '`Date`', FALSE);
		$this->Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date'] =& $this->Date;

		// Payment_Reference
		$this->Payment_Reference = new cField('account_payments', 'account_payments', 'x_Payment_Reference', 'Payment_Reference', '`Payment_Reference`', 200, -1, FALSE, '`Payment_Reference`', FALSE);
		$this->fields['Payment_Reference'] =& $this->Payment_Reference;

		// Payment_Date
		$this->Payment_Date = new cField('account_payments', 'account_payments', 'x_Payment_Date', 'Payment_Date', '`Payment_Date`', 135, 6, FALSE, '`Payment_Date`', FALSE);
		$this->Payment_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Payment_Date'] =& $this->Payment_Date;

		// Payment_Type
		$this->Payment_Type = new cField('account_payments', 'account_payments', 'x_Payment_Type', 'Payment_Type', '`Payment_Type`', 200, -1, FALSE, '`Payment_Type`', FALSE);
		$this->fields['Payment_Type'] =& $this->Payment_Type;

		// Journal_Type_ID
		$this->Journal_Type_ID = new cField('account_payments', 'account_payments', 'x_Journal_Type_ID', 'Journal_Type_ID', '`Journal_Type_ID`', 3, -1, FALSE, '`Journal_Type_ID`', FALSE);
		$this->Journal_Type_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Journal_Type_ID'] =& $this->Journal_Type_ID;

		// Journal_Account_ID
		$this->Journal_Account_ID = new cField('account_payments', 'account_payments', 'x_Journal_Account_ID', 'Journal_Account_ID', '`Journal_Account_ID`', 3, -1, FALSE, '`Journal_Account_ID`', FALSE);
		$this->Journal_Account_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Journal_Account_ID'] =& $this->Journal_Account_ID;

		// Payment_Method_ID
		$this->Payment_Method_ID = new cField('account_payments', 'account_payments', 'x_Payment_Method_ID', 'Payment_Method_ID', '`Payment_Method_ID`', 3, -1, FALSE, '`Payment_Method_ID`', FALSE);
		$this->Payment_Method_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Payment_Method_ID'] =& $this->Payment_Method_ID;

		// Vendor_ID
		$this->Vendor_ID = new cField('account_payments', 'account_payments', 'x_Vendor_ID', 'Vendor_ID', '`Vendor_ID`', 3, -1, FALSE, '`Vendor_ID`', FALSE);
		$this->Vendor_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Vendor_ID'] =& $this->Vendor_ID;

		// Client_ID
		$this->Client_ID = new cField('account_payments', 'account_payments', 'x_Client_ID', 'Client_ID', '`Client_ID`', 3, -1, FALSE, '`Client_ID`', FALSE);
		$this->Client_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Client_ID'] =& $this->Client_ID;

		// Amount
		$this->Amount = new cField('account_payments', 'account_payments', 'x_Amount', 'Amount', '`Amount`', 131, -1, FALSE, '`Amount`', FALSE);
		$this->fields['Amount'] =& $this->Amount;

		// Status_ID
		$this->Status_ID = new cField('account_payments', 'account_payments', 'x_Status_ID', 'Status_ID', '`Status_ID`', 3, -1, FALSE, '`Status_ID`', FALSE);
		$this->Status_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Status_ID'] =& $this->Status_ID;

		// Description
		$this->Description = new cField('account_payments', 'account_payments', 'x_Description', 'Description', '`Description`', 201, -1, FALSE, '`Description`', FALSE);
		$this->Description->TruncateMemoRemoveHtml = TRUE;
		$this->fields['Description'] =& $this->Description;

		// Remarks
		$this->Remarks = new cField('account_payments', 'account_payments', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
		$this->Remarks->TruncateMemoRemoveHtml = TRUE;
		$this->fields['Remarks'] =& $this->Remarks;

		// User_ID
		$this->User_ID = new cField('account_payments', 'account_payments', 'x_User_ID', 'User_ID', '`User_ID`', 3, -1, FALSE, '`User_ID`', FALSE);
		$this->User_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['User_ID'] =& $this->User_ID;

		// Created
		$this->Created = new cField('account_payments', 'account_payments', 'x_Created', 'Created', '`Created`', 135, 6, FALSE, '`Created`', FALSE);
		$this->Created->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Created'] =& $this->Created;

		// Modified
		$this->Modified = new cField('account_payments', 'account_payments', 'x_Modified', 'Modified', '`Modified`', 135, 6, FALSE, '`Modified`', FALSE);
		$this->Modified->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Modified'] =& $this->Modified;

		// total_invoice_items
		$this->total_invoice_items = new cField('account_payments', 'account_payments', 'x_total_invoice_items', 'total_invoice_items', '`total_invoice_items`', 4, -1, FALSE, '`total_invoice_items`', FALSE);
		$this->total_invoice_items->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['total_invoice_items'] =& $this->total_invoice_items;
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
		return "account_payments_Highlight";
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
		return "`account_payments`";
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
		return "`Payment_Date` DESC,`Date` DESC,`Journal_Account_ID` ASC";
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
		return "INSERT INTO `account_payments` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `account_payments` SET ";
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
		$SQL = "DELETE FROM `account_payments` WHERE ";
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
			return "account_paymentslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "account_paymentslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("account_paymentsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "account_paymentsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("account_paymentsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("account_paymentsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("account_paymentsdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=account_payments" : "";
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
		$this->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$this->Payment_Date->setDbValue($rs->fields('Payment_Date'));
		$this->Payment_Type->setDbValue($rs->fields('Payment_Type'));
		$this->Journal_Type_ID->setDbValue($rs->fields('Journal_Type_ID'));
		$this->Journal_Account_ID->setDbValue($rs->fields('Journal_Account_ID'));
		$this->Payment_Method_ID->setDbValue($rs->fields('Payment_Method_ID'));
		$this->Vendor_ID->setDbValue($rs->fields('Vendor_ID'));
		$this->Client_ID->setDbValue($rs->fields('Client_ID'));
		$this->Amount->setDbValue($rs->fields('Amount'));
		$this->Status_ID->setDbValue($rs->fields('Status_ID'));
		$this->Description->setDbValue($rs->fields('Description'));
		$this->Remarks->setDbValue($rs->fields('Remarks'));
		$this->User_ID->setDbValue($rs->fields('User_ID'));
		$this->Created->setDbValue($rs->fields('Created'));
		$this->Modified->setDbValue($rs->fields('Modified'));
		$this->total_invoice_items->setDbValue($rs->fields('total_invoice_items'));
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

		// Payment_Reference
		$this->Payment_Reference->CellCssStyle = ""; $this->Payment_Reference->CellCssClass = "";
		$this->Payment_Reference->CellAttrs = array(); $this->Payment_Reference->ViewAttrs = array(); $this->Payment_Reference->EditAttrs = array();

		// Payment_Date
		$this->Payment_Date->CellCssStyle = ""; $this->Payment_Date->CellCssClass = "";
		$this->Payment_Date->CellAttrs = array(); $this->Payment_Date->ViewAttrs = array(); $this->Payment_Date->EditAttrs = array();

		// Payment_Type
		$this->Payment_Type->CellCssStyle = ""; $this->Payment_Type->CellCssClass = "";
		$this->Payment_Type->CellAttrs = array(); $this->Payment_Type->ViewAttrs = array(); $this->Payment_Type->EditAttrs = array();

		// Journal_Type_ID
		$this->Journal_Type_ID->CellCssStyle = ""; $this->Journal_Type_ID->CellCssClass = "";
		$this->Journal_Type_ID->CellAttrs = array(); $this->Journal_Type_ID->ViewAttrs = array(); $this->Journal_Type_ID->EditAttrs = array();

		// Journal_Account_ID
		$this->Journal_Account_ID->CellCssStyle = ""; $this->Journal_Account_ID->CellCssClass = "";
		$this->Journal_Account_ID->CellAttrs = array(); $this->Journal_Account_ID->ViewAttrs = array(); $this->Journal_Account_ID->EditAttrs = array();

		// Payment_Method_ID
		$this->Payment_Method_ID->CellCssStyle = ""; $this->Payment_Method_ID->CellCssClass = "";
		$this->Payment_Method_ID->CellAttrs = array(); $this->Payment_Method_ID->ViewAttrs = array(); $this->Payment_Method_ID->EditAttrs = array();

		// Vendor_ID
		$this->Vendor_ID->CellCssStyle = ""; $this->Vendor_ID->CellCssClass = "";
		$this->Vendor_ID->CellAttrs = array(); $this->Vendor_ID->ViewAttrs = array(); $this->Vendor_ID->EditAttrs = array();

		// Client_ID
		$this->Client_ID->CellCssStyle = ""; $this->Client_ID->CellCssClass = "";
		$this->Client_ID->CellAttrs = array(); $this->Client_ID->ViewAttrs = array(); $this->Client_ID->EditAttrs = array();

		// Amount
		$this->Amount->CellCssStyle = ""; $this->Amount->CellCssClass = "";
		$this->Amount->CellAttrs = array(); $this->Amount->ViewAttrs = array(); $this->Amount->EditAttrs = array();

		// Status_ID
		$this->Status_ID->CellCssStyle = ""; $this->Status_ID->CellCssClass = "";
		$this->Status_ID->CellAttrs = array(); $this->Status_ID->ViewAttrs = array(); $this->Status_ID->EditAttrs = array();

		// User_ID
		$this->User_ID->CellCssStyle = ""; $this->User_ID->CellCssClass = "";
		$this->User_ID->CellAttrs = array(); $this->User_ID->ViewAttrs = array(); $this->User_ID->EditAttrs = array();

		// total_invoice_items
		$this->total_invoice_items->CellCssStyle = ""; $this->total_invoice_items->CellCssClass = "";
		$this->total_invoice_items->CellAttrs = array(); $this->total_invoice_items->ViewAttrs = array(); $this->total_invoice_items->EditAttrs = array();

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

		// Payment_Reference
		$this->Payment_Reference->ViewValue = $this->Payment_Reference->CurrentValue;
		$this->Payment_Reference->CssStyle = "";
		$this->Payment_Reference->CssClass = "";
		$this->Payment_Reference->ViewCustomAttributes = "";

		// Payment_Date
		$this->Payment_Date->ViewValue = $this->Payment_Date->CurrentValue;
		$this->Payment_Date->ViewValue = ew_FormatDateTime($this->Payment_Date->ViewValue, 6);
		$this->Payment_Date->CssStyle = "";
		$this->Payment_Date->CssClass = "";
		$this->Payment_Date->ViewCustomAttributes = "";

		// Payment_Type
		if (strval($this->Payment_Type->CurrentValue) <> "") {
			switch ($this->Payment_Type->CurrentValue) {
				case "payment_send":
					$this->Payment_Type->ViewValue = "Payment Send";
					break;
				case "payment_received":
					$this->Payment_Type->ViewValue = "Payment Received";
					break;
				default:
					$this->Payment_Type->ViewValue = $this->Payment_Type->CurrentValue;
			}
		} else {
			$this->Payment_Type->ViewValue = NULL;
		}
		$this->Payment_Type->CssStyle = "";
		$this->Payment_Type->CssClass = "";
		$this->Payment_Type->ViewCustomAttributes = "";

		// Journal_Type_ID
		if (strval($this->Journal_Type_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Journal_Type_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Journal_Name` FROM `journal_types`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Journal_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Journal_Type_ID->ViewValue = $rswrk->fields('Journal_Name');
				$rswrk->Close();
			} else {
				$this->Journal_Type_ID->ViewValue = $this->Journal_Type_ID->CurrentValue;
			}
		} else {
			$this->Journal_Type_ID->ViewValue = NULL;
		}
		$this->Journal_Type_ID->CssStyle = "";
		$this->Journal_Type_ID->CssClass = "";
		$this->Journal_Type_ID->ViewCustomAttributes = "";

		// Journal_Account_ID
		if (strval($this->Journal_Account_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Journal_Account_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Account_Reference_No` FROM `journal_accounts`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Business_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Journal_Account_ID->ViewValue = $rswrk->fields('Account_Reference_No');
				$rswrk->Close();
			} else {
				$this->Journal_Account_ID->ViewValue = $this->Journal_Account_ID->CurrentValue;
			}
		} else {
			$this->Journal_Account_ID->ViewValue = NULL;
		}
		$this->Journal_Account_ID->CssStyle = "";
		$this->Journal_Account_ID->CssClass = "";
		$this->Journal_Account_ID->ViewCustomAttributes = "";

		// Payment_Method_ID
		if (strval($this->Payment_Method_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Payment_Method_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Payment_Method` FROM `account_payment_methods`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Payment_Method_ID->ViewValue = $rswrk->fields('Payment_Method');
				$rswrk->Close();
			} else {
				$this->Payment_Method_ID->ViewValue = $this->Payment_Method_ID->CurrentValue;
			}
		} else {
			$this->Payment_Method_ID->ViewValue = NULL;
		}
		$this->Payment_Method_ID->CssStyle = "";
		$this->Payment_Method_ID->CssClass = "";
		$this->Payment_Method_ID->ViewCustomAttributes = "";

		// Vendor_ID
		if (strval($this->Vendor_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Vendor_ID->CurrentValue) . "";
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
				$this->Vendor_ID->ViewValue = $rswrk->fields('Subcon_Name');
				$rswrk->Close();
			} else {
				$this->Vendor_ID->ViewValue = $this->Vendor_ID->CurrentValue;
			}
		} else {
			$this->Vendor_ID->ViewValue = NULL;
		}
		$this->Vendor_ID->CssStyle = "";
		$this->Vendor_ID->CssClass = "";
		$this->Vendor_ID->ViewCustomAttributes = "";

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

		// Amount
		$this->Amount->ViewValue = $this->Amount->CurrentValue;
		$this->Amount->ViewValue = ew_FormatNumber($this->Amount->ViewValue, 2, -2, -2, -2);
		$this->Amount->CssStyle = "";
		$this->Amount->CssClass = "";
		$this->Amount->ViewCustomAttributes = "";

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

		// User_ID
		$this->User_ID->ViewValue = $this->User_ID->CurrentValue;
		$this->User_ID->CssStyle = "";
		$this->User_ID->CssClass = "";
		$this->User_ID->ViewCustomAttributes = "";

		// total_invoice_items
		$this->total_invoice_items->ViewValue = $this->total_invoice_items->CurrentValue;
		$this->total_invoice_items->ViewValue = ew_FormatNumber($this->total_invoice_items->ViewValue, 2, -2, -2, -2);
		$this->total_invoice_items->CssStyle = "";
		$this->total_invoice_items->CssClass = "";
		$this->total_invoice_items->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// Date
		$this->Date->HrefValue = "";
		$this->Date->TooltipValue = "";

		// Payment_Reference
		$this->Payment_Reference->HrefValue = "";
		$this->Payment_Reference->TooltipValue = "";

		// Payment_Date
		$this->Payment_Date->HrefValue = "";
		$this->Payment_Date->TooltipValue = "";

		// Payment_Type
		$this->Payment_Type->HrefValue = "";
		$this->Payment_Type->TooltipValue = "";

		// Journal_Type_ID
		$this->Journal_Type_ID->HrefValue = "";
		$this->Journal_Type_ID->TooltipValue = "";

		// Journal_Account_ID
		$this->Journal_Account_ID->HrefValue = "";
		$this->Journal_Account_ID->TooltipValue = "";

		// Payment_Method_ID
		$this->Payment_Method_ID->HrefValue = "";
		$this->Payment_Method_ID->TooltipValue = "";

		// Vendor_ID
		$this->Vendor_ID->HrefValue = "";
		$this->Vendor_ID->TooltipValue = "";

		// Client_ID
		$this->Client_ID->HrefValue = "";
		$this->Client_ID->TooltipValue = "";

		// Amount
		$this->Amount->HrefValue = "";
		$this->Amount->TooltipValue = "";

		// Status_ID
		$this->Status_ID->HrefValue = "";
		$this->Status_ID->TooltipValue = "";

		// User_ID
		$this->User_ID->HrefValue = "";
		$this->User_ID->TooltipValue = "";

		// total_invoice_items
		$this->total_invoice_items->HrefValue = "";
		$this->total_invoice_items->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->Amount->CurrentValue))
				$this->Amount->Total += $this->Amount->CurrentValue; // Accumulate total
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

	    global $conn;
	    $account_payments_id = $rs['id'];
	    $Payment_Reference_ = $rs['Payment_Reference'];
	    $xSql = "SELECT id FROM customer_invoices where payment_id = " . $account_payments_id;
	    $payment_items = $conn->Execute($xSql);
	    $payment_item = $payment_items->GetRows();
	    if(count($payment_item)>0){ //check for existing invoice items before deleting
	    echo "<script>";
	    echo "alert('Payment Reference: ". $Payment_Reference_ ."  has existing Items. Please delete Items first before deleting the current record.')";
	    echo "</script>";
	    return FALSE;
	    }else{
	    return TRUE;
	    }
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
