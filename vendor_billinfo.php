<?php

// Global variable for table object
$vendor_bill = NULL;

//
// Table class for vendor_bill
//
class cvendor_bill {
	var $TableVar = 'vendor_bill';
	var $TableName = 'vendor_bill';
	var $TableType = 'TABLE';
	var $id;
	var $vendor_ID;
	var $vendor_Number;
	var $Billing_Date;
	var $Due_Date;
	var $Total_Vat;
	var $Total_WTax;
	var $Total_Freight;
	var $Total_Amount_Due;
	var $Bill_Reference;
	var $payment_method_id;
	var $Payment_Status;
	var $Status;
	var $Remarks;
	var $User_ID;
	var $created;
	var $modified;
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
	function cvendor_bill() {
		global $Language;

		// id
		$this->id = new cField('vendor_bill', 'vendor_bill', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// vendor_ID
		$this->vendor_ID = new cField('vendor_bill', 'vendor_bill', 'x_vendor_ID', 'vendor_ID', '`vendor_ID`', 3, -1, FALSE, '`vendor_ID`', FALSE);
		$this->vendor_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['vendor_ID'] =& $this->vendor_ID;

		// vendor_Number
		$this->vendor_Number = new cField('vendor_bill', 'vendor_bill', 'x_vendor_Number', 'vendor_Number', '`vendor_Number`', 200, -1, FALSE, '`vendor_Number`', FALSE);
		$this->fields['vendor_Number'] =& $this->vendor_Number;

		// Billing_Date
		$this->Billing_Date = new cField('vendor_bill', 'vendor_bill', 'x_Billing_Date', 'Billing_Date', '`Billing_Date`', 135, 6, FALSE, '`Billing_Date`', FALSE);
		$this->Billing_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Billing_Date'] =& $this->Billing_Date;

		// Due_Date
		$this->Due_Date = new cField('vendor_bill', 'vendor_bill', 'x_Due_Date', 'Due_Date', '`Due_Date`', 135, 6, FALSE, '`Due_Date`', FALSE);
		$this->Due_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Due_Date'] =& $this->Due_Date;

		// Total_Vat
		$this->Total_Vat = new cField('vendor_bill', 'vendor_bill', 'x_Total_Vat', 'Total_Vat', '`Total_Vat`', 131, -1, FALSE, '`Total_Vat`', FALSE);
		$this->Total_Vat->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Vat'] =& $this->Total_Vat;

		// Total_WTax
		$this->Total_WTax = new cField('vendor_bill', 'vendor_bill', 'x_Total_WTax', 'Total_WTax', '`Total_WTax`', 131, -1, FALSE, '`Total_WTax`', FALSE);
		$this->Total_WTax->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_WTax'] =& $this->Total_WTax;

		// Total_Freight
		$this->Total_Freight = new cField('vendor_bill', 'vendor_bill', 'x_Total_Freight', 'Total_Freight', '`Total_Freight`', 131, -1, FALSE, '`Total_Freight`', FALSE);
		$this->Total_Freight->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Freight'] =& $this->Total_Freight;

		// Total_Amount_Due
		$this->Total_Amount_Due = new cField('vendor_bill', 'vendor_bill', 'x_Total_Amount_Due', 'Total_Amount_Due', '`Total_Amount_Due`', 131, -1, FALSE, '`Total_Amount_Due`', FALSE);
		$this->Total_Amount_Due->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Amount_Due'] =& $this->Total_Amount_Due;

		// Bill_Reference
		$this->Bill_Reference = new cField('vendor_bill', 'vendor_bill', 'x_Bill_Reference', 'Bill_Reference', '`Bill_Reference`', 200, -1, FALSE, '`Bill_Reference`', FALSE);
		$this->fields['Bill_Reference'] =& $this->Bill_Reference;

		// payment_method_id
		$this->payment_method_id = new cField('vendor_bill', 'vendor_bill', 'x_payment_method_id', 'payment_method_id', '`payment_method_id`', 3, -1, FALSE, '`payment_method_id`', FALSE);
		$this->payment_method_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['payment_method_id'] =& $this->payment_method_id;

		// Payment_Status
		$this->Payment_Status = new cField('vendor_bill', 'vendor_bill', 'x_Payment_Status', 'Payment_Status', '`Payment_Status`', 3, -1, FALSE, '`Payment_Status`', FALSE);
		$this->Payment_Status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Payment_Status'] =& $this->Payment_Status;

		// Status
		$this->Status = new cField('vendor_bill', 'vendor_bill', 'x_Status', 'Status', '`Status`', 3, -1, FALSE, '`Status`', FALSE);
		$this->Status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Status'] =& $this->Status;

		// Remarks
		$this->Remarks = new cField('vendor_bill', 'vendor_bill', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
		$this->fields['Remarks'] =& $this->Remarks;

		// User_ID
		$this->User_ID = new cField('vendor_bill', 'vendor_bill', 'x_User_ID', 'User_ID', '`User_ID`', 3, -1, FALSE, '`User_ID`', FALSE);
		$this->User_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['User_ID'] =& $this->User_ID;

		// created
		$this->created = new cField('vendor_bill', 'vendor_bill', 'x_created', 'created', '`created`', 135, 6, FALSE, '`created`', FALSE);
		$this->created->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['created'] =& $this->created;

		// modified
		$this->modified = new cField('vendor_bill', 'vendor_bill', 'x_modified', 'modified', '`modified`', 135, 6, FALSE, '`modified`', FALSE);
		$this->modified->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['modified'] =& $this->modified;
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
		return "vendor_bill_Highlight";
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
	function SqlMasterFilter_subcons() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_subcons() {
		return "`vendor_ID`=@vendor_ID@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`vendor_bill`";
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
		return "`Billing_Date` DESC,`Due_Date` DESC";
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
		return "INSERT INTO `vendor_bill` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `vendor_bill` SET ";
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
		$SQL = "DELETE FROM `vendor_bill` WHERE ";
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
			return "vendor_billlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "vendor_billlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("vendor_billview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "vendor_billadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("vendor_billedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("vendor_billadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("vendor_billdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=vendor_bill" : "";
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
		$this->vendor_ID->setDbValue($rs->fields('vendor_ID'));
		$this->vendor_Number->setDbValue($rs->fields('vendor_Number'));
		$this->Billing_Date->setDbValue($rs->fields('Billing_Date'));
		$this->Due_Date->setDbValue($rs->fields('Due_Date'));
		$this->Total_Vat->setDbValue($rs->fields('Total_Vat'));
		$this->Total_WTax->setDbValue($rs->fields('Total_WTax'));
		$this->Total_Freight->setDbValue($rs->fields('Total_Freight'));
		$this->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$this->Bill_Reference->setDbValue($rs->fields('Bill_Reference'));
		$this->payment_method_id->setDbValue($rs->fields('payment_method_id'));
		$this->Payment_Status->setDbValue($rs->fields('Payment_Status'));
		$this->Status->setDbValue($rs->fields('Status'));
		$this->Remarks->setDbValue($rs->fields('Remarks'));
		$this->User_ID->setDbValue($rs->fields('User_ID'));
		$this->created->setDbValue($rs->fields('created'));
		$this->modified->setDbValue($rs->fields('modified'));
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

		// vendor_ID
		$this->vendor_ID->CellCssStyle = ""; $this->vendor_ID->CellCssClass = "";
		$this->vendor_ID->CellAttrs = array(); $this->vendor_ID->ViewAttrs = array(); $this->vendor_ID->EditAttrs = array();

		// vendor_Number
		$this->vendor_Number->CellCssStyle = ""; $this->vendor_Number->CellCssClass = "";
		$this->vendor_Number->CellAttrs = array(); $this->vendor_Number->ViewAttrs = array(); $this->vendor_Number->EditAttrs = array();

		// Billing_Date
		$this->Billing_Date->CellCssStyle = ""; $this->Billing_Date->CellCssClass = "";
		$this->Billing_Date->CellAttrs = array(); $this->Billing_Date->ViewAttrs = array(); $this->Billing_Date->EditAttrs = array();

		// Due_Date
		$this->Due_Date->CellCssStyle = ""; $this->Due_Date->CellCssClass = "";
		$this->Due_Date->CellAttrs = array(); $this->Due_Date->ViewAttrs = array(); $this->Due_Date->EditAttrs = array();

		// Total_Amount_Due
		$this->Total_Amount_Due->CellCssStyle = ""; $this->Total_Amount_Due->CellCssClass = "";
		$this->Total_Amount_Due->CellAttrs = array(); $this->Total_Amount_Due->ViewAttrs = array(); $this->Total_Amount_Due->EditAttrs = array();

		// Bill_Reference
		$this->Bill_Reference->CellCssStyle = ""; $this->Bill_Reference->CellCssClass = "";
		$this->Bill_Reference->CellAttrs = array(); $this->Bill_Reference->ViewAttrs = array(); $this->Bill_Reference->EditAttrs = array();

		// payment_method_id
		$this->payment_method_id->CellCssStyle = ""; $this->payment_method_id->CellCssClass = "";
		$this->payment_method_id->CellAttrs = array(); $this->payment_method_id->ViewAttrs = array(); $this->payment_method_id->EditAttrs = array();

		// Payment_Status
		$this->Payment_Status->CellCssStyle = ""; $this->Payment_Status->CellCssClass = "";
		$this->Payment_Status->CellAttrs = array(); $this->Payment_Status->ViewAttrs = array(); $this->Payment_Status->EditAttrs = array();

		// Status
		$this->Status->CellCssStyle = ""; $this->Status->CellCssClass = "";
		$this->Status->CellAttrs = array(); $this->Status->ViewAttrs = array(); $this->Status->EditAttrs = array();

		// Remarks
		$this->Remarks->CellCssStyle = ""; $this->Remarks->CellCssClass = "";
		$this->Remarks->CellAttrs = array(); $this->Remarks->ViewAttrs = array(); $this->Remarks->EditAttrs = array();

		// User_ID
		$this->User_ID->CellCssStyle = ""; $this->User_ID->CellCssClass = "";
		$this->User_ID->CellAttrs = array(); $this->User_ID->ViewAttrs = array(); $this->User_ID->EditAttrs = array();

		// created
		$this->created->CellCssStyle = ""; $this->created->CellCssClass = "";
		$this->created->CellAttrs = array(); $this->created->ViewAttrs = array(); $this->created->EditAttrs = array();

		// modified
		$this->modified->CellCssStyle = ""; $this->modified->CellCssClass = "";
		$this->modified->CellAttrs = array(); $this->modified->ViewAttrs = array(); $this->modified->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// vendor_ID
		if (strval($this->vendor_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->vendor_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Subcon_Name` FROM `subcons`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->vendor_ID->ViewValue = $rswrk->fields('Subcon_Name');
				$rswrk->Close();
			} else {
				$this->vendor_ID->ViewValue = $this->vendor_ID->CurrentValue;
			}
		} else {
			$this->vendor_ID->ViewValue = NULL;
		}
		$this->vendor_ID->CssStyle = "";
		$this->vendor_ID->CssClass = "";
		$this->vendor_ID->ViewCustomAttributes = "";

		// vendor_Number
		$this->vendor_Number->ViewValue = $this->vendor_Number->CurrentValue;
		$this->vendor_Number->CssStyle = "";
		$this->vendor_Number->CssClass = "";
		$this->vendor_Number->ViewCustomAttributes = "";

		// Billing_Date
		$this->Billing_Date->ViewValue = $this->Billing_Date->CurrentValue;
		$this->Billing_Date->ViewValue = ew_FormatDateTime($this->Billing_Date->ViewValue, 6);
		$this->Billing_Date->CssStyle = "";
		$this->Billing_Date->CssClass = "";
		$this->Billing_Date->ViewCustomAttributes = "";

		// Due_Date
		$this->Due_Date->ViewValue = $this->Due_Date->CurrentValue;
		$this->Due_Date->ViewValue = ew_FormatDateTime($this->Due_Date->ViewValue, 6);
		$this->Due_Date->CssStyle = "";
		$this->Due_Date->CssClass = "";
		$this->Due_Date->ViewCustomAttributes = "";

		// Total_Amount_Due
		$this->Total_Amount_Due->ViewValue = $this->Total_Amount_Due->CurrentValue;
		$this->Total_Amount_Due->CssStyle = "";
		$this->Total_Amount_Due->CssClass = "";
		$this->Total_Amount_Due->ViewCustomAttributes = "";

		// Bill_Reference
		$this->Bill_Reference->ViewValue = $this->Bill_Reference->CurrentValue;
		$this->Bill_Reference->CssStyle = "";
		$this->Bill_Reference->CssClass = "";
		$this->Bill_Reference->ViewCustomAttributes = "";

		// payment_method_id
		if (strval($this->payment_method_id->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->payment_method_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `Payment_Method` FROM `account_payment_methods`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->payment_method_id->ViewValue = $rswrk->fields('Payment_Method');
				$rswrk->Close();
			} else {
				$this->payment_method_id->ViewValue = $this->payment_method_id->CurrentValue;
			}
		} else {
			$this->payment_method_id->ViewValue = NULL;
		}
		$this->payment_method_id->CssStyle = "";
		$this->payment_method_id->CssClass = "";
		$this->payment_method_id->ViewCustomAttributes = "";

		// Payment_Status
		if (strval($this->Payment_Status->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Payment_Status->CurrentValue) . "";
		$sSqlWrk = "SELECT `Status` FROM `statuses`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Payment_Status->ViewValue = $rswrk->fields('Status');
				$rswrk->Close();
			} else {
				$this->Payment_Status->ViewValue = $this->Payment_Status->CurrentValue;
			}
		} else {
			$this->Payment_Status->ViewValue = NULL;
		}
		$this->Payment_Status->CssStyle = "";
		$this->Payment_Status->CssClass = "";
		$this->Payment_Status->ViewCustomAttributes = "";

		// Status
		if (strval($this->Status->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Status->CurrentValue) . "";
		$sSqlWrk = "SELECT `Status` FROM `statuses`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Status->ViewValue = $rswrk->fields('Status');
				$rswrk->Close();
			} else {
				$this->Status->ViewValue = $this->Status->CurrentValue;
			}
		} else {
			$this->Status->ViewValue = NULL;
		}
		$this->Status->CssStyle = "";
		$this->Status->CssClass = "";
		$this->Status->ViewCustomAttributes = "";

		// Remarks
		$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
		$this->Remarks->CssStyle = "";
		$this->Remarks->CssClass = "";
		$this->Remarks->ViewCustomAttributes = "";

		// User_ID
		$this->User_ID->ViewValue = $this->User_ID->CurrentValue;
		$this->User_ID->CssStyle = "";
		$this->User_ID->CssClass = "";
		$this->User_ID->ViewCustomAttributes = "";

		// created
		$this->created->ViewValue = $this->created->CurrentValue;
		$this->created->ViewValue = ew_FormatDateTime($this->created->ViewValue, 6);
		$this->created->CssStyle = "";
		$this->created->CssClass = "";
		$this->created->ViewCustomAttributes = "";

		// modified
		$this->modified->ViewValue = $this->modified->CurrentValue;
		$this->modified->ViewValue = ew_FormatDateTime($this->modified->ViewValue, 6);
		$this->modified->CssStyle = "";
		$this->modified->CssClass = "";
		$this->modified->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// vendor_ID
		$this->vendor_ID->HrefValue = "";
		$this->vendor_ID->TooltipValue = "";

		// vendor_Number
		$this->vendor_Number->HrefValue = "";
		$this->vendor_Number->TooltipValue = "";

		// Billing_Date
		$this->Billing_Date->HrefValue = "";
		$this->Billing_Date->TooltipValue = "";

		// Due_Date
		$this->Due_Date->HrefValue = "";
		$this->Due_Date->TooltipValue = "";

		// Total_Amount_Due
		$this->Total_Amount_Due->HrefValue = "";
		$this->Total_Amount_Due->TooltipValue = "";

		// Bill_Reference
		$this->Bill_Reference->HrefValue = "";
		$this->Bill_Reference->TooltipValue = "";

		// payment_method_id
		$this->payment_method_id->HrefValue = "";
		$this->payment_method_id->TooltipValue = "";

		// Payment_Status
		$this->Payment_Status->HrefValue = "";
		$this->Payment_Status->TooltipValue = "";

		// Status
		$this->Status->HrefValue = "";
		$this->Status->TooltipValue = "";

		// Remarks
		$this->Remarks->HrefValue = "";
		$this->Remarks->TooltipValue = "";

		// User_ID
		$this->User_ID->HrefValue = "";
		$this->User_ID->TooltipValue = "";

		// created
		$this->created->HrefValue = "";
		$this->created->TooltipValue = "";

		// modified
		$this->modified->HrefValue = "";
		$this->modified->TooltipValue = "";

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
