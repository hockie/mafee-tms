<?php

// Global variable for table object
$invoices = NULL;

//
// Table class for invoices
//
class cinvoices {
	var $TableVar = 'invoices';
	var $TableName = 'invoices';
	var $TableType = 'TABLE';
	var $id;
	var $Invoice_Number;
	var $Client_ID;
	var $Invoice_Date;
	var $Due_Date;
	var $payment_period;
	var $Total_Vat;
	var $Total_WTax;
	var $Total_Freight;
	var $Total_Amount_Due;
	var $Payment_Reference;
	var $Payment_Status;
	var $Status;
	var $Recipient_Bank;
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
	function cinvoices() {
		global $Language;

		// id
		$this->id = new cField('invoices', 'invoices', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Invoice_Number
		$this->Invoice_Number = new cField('invoices', 'invoices', 'x_Invoice_Number', 'Invoice_Number', '`Invoice_Number`', 200, -1, FALSE, '`Invoice_Number`', FALSE);
		$this->fields['Invoice_Number'] =& $this->Invoice_Number;

		// Client_ID
		$this->Client_ID = new cField('invoices', 'invoices', 'x_Client_ID', 'Client_ID', '`Client_ID`', 3, -1, FALSE, '`Client_ID`', FALSE);
		$this->Client_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Client_ID'] =& $this->Client_ID;

		// Invoice_Date
		$this->Invoice_Date = new cField('invoices', 'invoices', 'x_Invoice_Date', 'Invoice_Date', '`Invoice_Date`', 135, 6, FALSE, '`Invoice_Date`', FALSE);
		$this->Invoice_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Invoice_Date'] =& $this->Invoice_Date;

		// Due_Date
		$this->Due_Date = new cField('invoices', 'invoices', 'x_Due_Date', 'Due_Date', '`Due_Date`', 135, 6, FALSE, '`Due_Date`', FALSE);
		$this->Due_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Due_Date'] =& $this->Due_Date;

		// payment_period
		$this->payment_period = new cField('invoices', 'invoices', 'x_payment_period', 'payment_period', '`payment_period`', 3, -1, FALSE, '`payment_period`', FALSE);
		$this->payment_period->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['payment_period'] =& $this->payment_period;

		// Total_Vat
		$this->Total_Vat = new cField('invoices', 'invoices', 'x_Total_Vat', 'Total_Vat', '`Total_Vat`', 4, -1, FALSE, '`Total_Vat`', FALSE);
		$this->Total_Vat->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Vat'] =& $this->Total_Vat;

		// Total_WTax
		$this->Total_WTax = new cField('invoices', 'invoices', 'x_Total_WTax', 'Total_WTax', '`Total_WTax`', 4, -1, FALSE, '`Total_WTax`', FALSE);
		$this->Total_WTax->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_WTax'] =& $this->Total_WTax;

		// Total_Freight
		$this->Total_Freight = new cField('invoices', 'invoices', 'x_Total_Freight', 'Total_Freight', '`Total_Freight`', 4, -1, FALSE, '`Total_Freight`', FALSE);
		$this->Total_Freight->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Freight'] =& $this->Total_Freight;

		// Total_Amount_Due
		$this->Total_Amount_Due = new cField('invoices', 'invoices', 'x_Total_Amount_Due', 'Total_Amount_Due', '`Total_Amount_Due`', 4, -1, FALSE, '`Total_Amount_Due`', FALSE);
		$this->Total_Amount_Due->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Amount_Due'] =& $this->Total_Amount_Due;

		// Payment_Reference
		$this->Payment_Reference = new cField('invoices', 'invoices', 'x_Payment_Reference', 'Payment_Reference', '`Payment_Reference`', 200, -1, FALSE, '`Payment_Reference`', FALSE);
		$this->fields['Payment_Reference'] =& $this->Payment_Reference;

		// Payment_Status
		$this->Payment_Status = new cField('invoices', 'invoices', 'x_Payment_Status', 'Payment_Status', '`Payment_Status`', 3, -1, FALSE, '`Payment_Status`', FALSE);
		$this->Payment_Status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Payment_Status'] =& $this->Payment_Status;

		// Status
		$this->Status = new cField('invoices', 'invoices', 'x_Status', 'Status', '`Status`', 3, -1, FALSE, '`Status`', FALSE);
		$this->Status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Status'] =& $this->Status;

		// Recipient_Bank
		$this->Recipient_Bank = new cField('invoices', 'invoices', 'x_Recipient_Bank', 'Recipient_Bank', '`Recipient_Bank`', 3, -1, FALSE, '`Recipient_Bank`', FALSE);
		$this->Recipient_Bank->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Recipient_Bank'] =& $this->Recipient_Bank;

		// Remarks
		$this->Remarks = new cField('invoices', 'invoices', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
		$this->fields['Remarks'] =& $this->Remarks;

		// User_ID
		$this->User_ID = new cField('invoices', 'invoices', 'x_User_ID', 'User_ID', '`User_ID`', 3, -1, FALSE, '`User_ID`', FALSE);
		$this->User_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['User_ID'] =& $this->User_ID;

		// created
		$this->created = new cField('invoices', 'invoices', 'x_created', 'created', '`created`', 135, 6, FALSE, '`created`', FALSE);
		$this->created->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['created'] =& $this->created;

		// modified
		$this->modified = new cField('invoices', 'invoices', 'x_modified', 'modified', '`modified`', 135, 6, FALSE, '`modified`', FALSE);
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
		return "invoices_Highlight";
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
		return "`invoices`";
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
		return "`Invoice_Number` ASC";
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
		return "INSERT INTO `invoices` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `invoices` SET ";
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
		$SQL = "DELETE FROM `invoices` WHERE ";
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
			return "invoiceslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "invoiceslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("invoicesview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "invoicesadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("invoicesedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("invoicesadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("invoicesdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=invoices" : "";
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
		$this->Invoice_Number->setDbValue($rs->fields('Invoice_Number'));
		$this->Client_ID->setDbValue($rs->fields('Client_ID'));
		$this->Invoice_Date->setDbValue($rs->fields('Invoice_Date'));
		$this->Due_Date->setDbValue($rs->fields('Due_Date'));
		$this->payment_period->setDbValue($rs->fields('payment_period'));
		$this->Total_Vat->setDbValue($rs->fields('Total_Vat'));
		$this->Total_WTax->setDbValue($rs->fields('Total_WTax'));
		$this->Total_Freight->setDbValue($rs->fields('Total_Freight'));
		$this->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$this->Payment_Reference->setDbValue($rs->fields('Payment_Reference'));
		$this->Payment_Status->setDbValue($rs->fields('Payment_Status'));
		$this->Status->setDbValue($rs->fields('Status'));
		$this->Recipient_Bank->setDbValue($rs->fields('Recipient_Bank'));
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

		// Invoice_Number
		$this->Invoice_Number->CellCssStyle = ""; $this->Invoice_Number->CellCssClass = "";
		$this->Invoice_Number->CellAttrs = array(); $this->Invoice_Number->ViewAttrs = array(); $this->Invoice_Number->EditAttrs = array();

		// Client_ID
		$this->Client_ID->CellCssStyle = ""; $this->Client_ID->CellCssClass = "";
		$this->Client_ID->CellAttrs = array(); $this->Client_ID->ViewAttrs = array(); $this->Client_ID->EditAttrs = array();

		// Invoice_Date
		$this->Invoice_Date->CellCssStyle = ""; $this->Invoice_Date->CellCssClass = "";
		$this->Invoice_Date->CellAttrs = array(); $this->Invoice_Date->ViewAttrs = array(); $this->Invoice_Date->EditAttrs = array();

		// Due_Date
		$this->Due_Date->CellCssStyle = ""; $this->Due_Date->CellCssClass = "";
		$this->Due_Date->CellAttrs = array(); $this->Due_Date->ViewAttrs = array(); $this->Due_Date->EditAttrs = array();

		// payment_period
		$this->payment_period->CellCssStyle = ""; $this->payment_period->CellCssClass = "";
		$this->payment_period->CellAttrs = array(); $this->payment_period->ViewAttrs = array(); $this->payment_period->EditAttrs = array();

		// Total_Vat
		$this->Total_Vat->CellCssStyle = ""; $this->Total_Vat->CellCssClass = "";
		$this->Total_Vat->CellAttrs = array(); $this->Total_Vat->ViewAttrs = array(); $this->Total_Vat->EditAttrs = array();

		// Total_WTax
		$this->Total_WTax->CellCssStyle = ""; $this->Total_WTax->CellCssClass = "";
		$this->Total_WTax->CellAttrs = array(); $this->Total_WTax->ViewAttrs = array(); $this->Total_WTax->EditAttrs = array();

		// Total_Freight
		$this->Total_Freight->CellCssStyle = ""; $this->Total_Freight->CellCssClass = "";
		$this->Total_Freight->CellAttrs = array(); $this->Total_Freight->ViewAttrs = array(); $this->Total_Freight->EditAttrs = array();

		// Total_Amount_Due
		$this->Total_Amount_Due->CellCssStyle = ""; $this->Total_Amount_Due->CellCssClass = "";
		$this->Total_Amount_Due->CellAttrs = array(); $this->Total_Amount_Due->ViewAttrs = array(); $this->Total_Amount_Due->EditAttrs = array();

		// Payment_Reference
		$this->Payment_Reference->CellCssStyle = ""; $this->Payment_Reference->CellCssClass = "";
		$this->Payment_Reference->CellAttrs = array(); $this->Payment_Reference->ViewAttrs = array(); $this->Payment_Reference->EditAttrs = array();

		// Payment_Status
		$this->Payment_Status->CellCssStyle = ""; $this->Payment_Status->CellCssClass = "";
		$this->Payment_Status->CellAttrs = array(); $this->Payment_Status->ViewAttrs = array(); $this->Payment_Status->EditAttrs = array();

		// Status
		$this->Status->CellCssStyle = ""; $this->Status->CellCssClass = "";
		$this->Status->CellAttrs = array(); $this->Status->ViewAttrs = array(); $this->Status->EditAttrs = array();

		// Recipient_Bank
		$this->Recipient_Bank->CellCssStyle = ""; $this->Recipient_Bank->CellCssClass = "";
		$this->Recipient_Bank->CellAttrs = array(); $this->Recipient_Bank->ViewAttrs = array(); $this->Recipient_Bank->EditAttrs = array();

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

		// Invoice_Number
		$this->Invoice_Number->ViewValue = $this->Invoice_Number->CurrentValue;
		$this->Invoice_Number->CssStyle = "";
		$this->Invoice_Number->CssClass = "";
		$this->Invoice_Number->ViewCustomAttributes = "";

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

		// Invoice_Date
		$this->Invoice_Date->ViewValue = $this->Invoice_Date->CurrentValue;
		$this->Invoice_Date->ViewValue = ew_FormatDateTime($this->Invoice_Date->ViewValue, 6);
		$this->Invoice_Date->CssStyle = "";
		$this->Invoice_Date->CssClass = "";
		$this->Invoice_Date->ViewCustomAttributes = "";

		// Due_Date
		$this->Due_Date->ViewValue = $this->Due_Date->CurrentValue;
		$this->Due_Date->ViewValue = ew_FormatDateTime($this->Due_Date->ViewValue, 6);
		$this->Due_Date->CssStyle = "";
		$this->Due_Date->CssClass = "";
		$this->Due_Date->ViewCustomAttributes = "";

		// payment_period
		if (strval($this->payment_period->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->payment_period->CurrentValue) . "";
		$sSqlWrk = "SELECT `payment_period` FROM `client_payment_period`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->payment_period->ViewValue = $rswrk->fields('payment_period');
				$rswrk->Close();
			} else {
				$this->payment_period->ViewValue = $this->payment_period->CurrentValue;
			}
		} else {
			$this->payment_period->ViewValue = NULL;
		}
		$this->payment_period->CssStyle = "";
		$this->payment_period->CssClass = "";
		$this->payment_period->ViewCustomAttributes = "";

		// Total_Vat
		$this->Total_Vat->ViewValue = $this->Total_Vat->CurrentValue;
		$this->Total_Vat->ViewValue = ew_FormatNumber($this->Total_Vat->ViewValue, 2, -2, -2, -2);
		$this->Total_Vat->CssStyle = "";
		$this->Total_Vat->CssClass = "";
		$this->Total_Vat->ViewCustomAttributes = "";

		// Total_WTax
		$this->Total_WTax->ViewValue = $this->Total_WTax->CurrentValue;
		$this->Total_WTax->ViewValue = ew_FormatNumber($this->Total_WTax->ViewValue, 2, -2, -2, -2);
		$this->Total_WTax->CssStyle = "";
		$this->Total_WTax->CssClass = "";
		$this->Total_WTax->ViewCustomAttributes = "";

		// Total_Freight
		$this->Total_Freight->ViewValue = $this->Total_Freight->CurrentValue;
		$this->Total_Freight->ViewValue = ew_FormatNumber($this->Total_Freight->ViewValue, 2, -2, -2, -2);
		$this->Total_Freight->CssStyle = "";
		$this->Total_Freight->CssClass = "";
		$this->Total_Freight->ViewCustomAttributes = "";

		// Total_Amount_Due
		$this->Total_Amount_Due->ViewValue = $this->Total_Amount_Due->CurrentValue;
		$this->Total_Amount_Due->ViewValue = ew_FormatNumber($this->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
		$this->Total_Amount_Due->CssStyle = "";
		$this->Total_Amount_Due->CssClass = "";
		$this->Total_Amount_Due->ViewCustomAttributes = "";

		// Payment_Reference
		$this->Payment_Reference->ViewValue = $this->Payment_Reference->CurrentValue;
		$this->Payment_Reference->CssStyle = "";
		$this->Payment_Reference->CssClass = "";
		$this->Payment_Reference->ViewCustomAttributes = "";

		// Payment_Status
		if (strval($this->Payment_Status->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Payment_Status->CurrentValue) . "";
		$sSqlWrk = "SELECT `Status` FROM `statuses`";
		$sWhereWrk = "";
		if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
		$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
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
		if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
		$sWhereWrk .= "(" . "`Modules` = 'Invoice'" . ")";
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

		// Recipient_Bank
		if (strval($this->Recipient_Bank->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Recipient_Bank->CurrentValue) . "";
		$sSqlWrk = "SELECT `Bank_Name`, `Account_Number` FROM `banks_accounts`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Bank_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Recipient_Bank->ViewValue = $rswrk->fields('Bank_Name');
				$this->Recipient_Bank->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('Account_Number');
				$rswrk->Close();
			} else {
				$this->Recipient_Bank->ViewValue = $this->Recipient_Bank->CurrentValue;
			}
		} else {
			$this->Recipient_Bank->ViewValue = NULL;
		}
		$this->Recipient_Bank->CssStyle = "";
		$this->Recipient_Bank->CssClass = "";
		$this->Recipient_Bank->ViewCustomAttributes = "";

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

		// Invoice_Number
		$this->Invoice_Number->HrefValue = "";
		$this->Invoice_Number->TooltipValue = "";

		// Client_ID
		$this->Client_ID->HrefValue = "";
		$this->Client_ID->TooltipValue = "";

		// Invoice_Date
		$this->Invoice_Date->HrefValue = "";
		$this->Invoice_Date->TooltipValue = "";

		// Due_Date
		$this->Due_Date->HrefValue = "";
		$this->Due_Date->TooltipValue = "";

		// payment_period
		$this->payment_period->HrefValue = "";
		$this->payment_period->TooltipValue = "";

		// Total_Vat
		$this->Total_Vat->HrefValue = "";
		$this->Total_Vat->TooltipValue = "";

		// Total_WTax
		$this->Total_WTax->HrefValue = "";
		$this->Total_WTax->TooltipValue = "";

		// Total_Freight
		$this->Total_Freight->HrefValue = "";
		$this->Total_Freight->TooltipValue = "";

		// Total_Amount_Due
		$this->Total_Amount_Due->HrefValue = "";
		$this->Total_Amount_Due->TooltipValue = "";

		// Payment_Reference
		$this->Payment_Reference->HrefValue = "";
		$this->Payment_Reference->TooltipValue = "";

		// Payment_Status
		$this->Payment_Status->HrefValue = "";
		$this->Payment_Status->TooltipValue = "";

		// Status
		$this->Status->HrefValue = "";
		$this->Status->TooltipValue = "";

		// Recipient_Bank
		$this->Recipient_Bank->HrefValue = "";
		$this->Recipient_Bank->TooltipValue = "";

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
			if (is_numeric($this->Total_Vat->CurrentValue))
				$this->Total_Vat->Total += $this->Total_Vat->CurrentValue; // Accumulate total
			if (is_numeric($this->Total_WTax->CurrentValue))
				$this->Total_WTax->Total += $this->Total_WTax->CurrentValue; // Accumulate total
			if (is_numeric($this->Total_Freight->CurrentValue))
				$this->Total_Freight->Total += $this->Total_Freight->CurrentValue; // Accumulate total
			if (is_numeric($this->Total_Amount_Due->CurrentValue))
				$this->Total_Amount_Due->Total += $this->Total_Amount_Due->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->Total_Vat->CurrentValue = $this->Total_Vat->Total;
			$this->Total_Vat->ViewValue = $this->Total_Vat->CurrentValue;
			$this->Total_Vat->ViewValue = ew_FormatNumber($this->Total_Vat->ViewValue, 2, -2, -2, -2);
			$this->Total_Vat->CssStyle = "";
			$this->Total_Vat->CssClass = "";
			$this->Total_Vat->ViewCustomAttributes = "";
			$this->Total_Vat->HrefValue = ""; // Clear href value
			$this->Total_WTax->CurrentValue = $this->Total_WTax->Total;
			$this->Total_WTax->ViewValue = $this->Total_WTax->CurrentValue;
			$this->Total_WTax->ViewValue = ew_FormatNumber($this->Total_WTax->ViewValue, 2, -2, -2, -2);
			$this->Total_WTax->CssStyle = "";
			$this->Total_WTax->CssClass = "";
			$this->Total_WTax->ViewCustomAttributes = "";
			$this->Total_WTax->HrefValue = ""; // Clear href value
			$this->Total_Freight->CurrentValue = $this->Total_Freight->Total;
			$this->Total_Freight->ViewValue = $this->Total_Freight->CurrentValue;
			$this->Total_Freight->ViewValue = ew_FormatNumber($this->Total_Freight->ViewValue, 2, -2, -2, -2);
			$this->Total_Freight->CssStyle = "";
			$this->Total_Freight->CssClass = "";
			$this->Total_Freight->ViewCustomAttributes = "";
			$this->Total_Freight->HrefValue = ""; // Clear href value
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
$sSql = "SELECT id FROM invoices order by id desc limit 1";
        $rsLastID = $conn->Execute($sSql);
        $last_id = $rsLastID->fields('id');
        $date_today = date("Y-m-d");
                $inv_no = "INV" . "-" . date("mdY",strtotime($date_today)) . "-" . $last_id;
                $rs["Invoice_Number"] = $inv_no;
              //  echo CurrentUserID();


            $rs["Status"] = 14;
            $rs["Payment_Status"] = 9;
            
                // Enter your code here
                // To cancel, set return value to FALSE

                return TRUE;       
}                                     

		// Row Inserted event
function Row_Inserted(&$rs) {
   
//$date_today = date("Y-m-d");
//$inv_no = "INV" . date("mdY",strtotime($date_today)). "=" . $rs["ID"];
                               
//echo "Row Inserted";

}                       



                                        

		// Row Updating event
function Row_Updating(&$rsold, &$rsnew) {
    // Enter your code here
    // To cancel, set return value to FALSE
    $invoice_status_ = $rsnew['Payment_Status'];
        $invoice_id_ = $rsold['id'];
        
        //update booking Status
        //echo $invoice_status_;
         global $conn;
         $booking_billing_type = 0;
        
        if($invoice_status_ == 8) //paid
        {
            $booking_billing_type = 2; //paid
        }
        elseif ($invoice_status_ == 9) {
            $booking_billing_type = 3; //not paid
        }
        elseif ($invoice_status_ == 10)// partial payment 
        {
            $booking_billing_type = 4; //partial payment 
        }
        elseif ($invoice_status_ == 12)// posted 
        {
            $booking_billing_type = 5; // posted 
        }
        elseif ($invoice_status_ == 13)// overdue 
        {
            $booking_billing_type = 6; // posted 
        }
        else 
        {    
            $booking_billing_type = 0; // posted 
        }


        $aSql = "SELECT  booking_id FROM invoice_items where invoice_id = " . $invoice_id_ ;

        $bookIds = $conn->Execute($aSql);
        $bookId = $bookIds->GetRows();    
        
        if(count($bookId)>0){
            for( $i= 0; $i< count($bookId); $i++){
            $x = $bookId[$i]['booking_id'];
            $sSql = "UPDATE bookings SET billing_type_ID = " . $booking_billing_type  . " WHERE id = " . $x;
            
            $conn->Execute($sSql);
            }
        }
        
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
	        $invoice_id_ = $rs['id'];
	        $invoice_number_ = $rs['Invoice_Number'];
	        $sSql = "SELECT id FROM invoice_items where invoice_id = " . $invoice_id_;
	        $inv_items = $conn->Execute($sSql);
	        $inv_item_row = $inv_items->GetRows();
			$xSql = "SELECT id FROM customer_invoices where invoice_id = " . $invoice_id_;
			$inv_payments = $conn->Execute($xSql);
	        $inv_payment = $inv_payments->GetRows();

	        if(count($inv_item_row)>0 || count($inv_payment)>0){ //check for existing invoice items before deleting
	        echo "<script>";
	        echo "alert('Invoice: ". $invoice_number_ ."  has existing Items. Please delete Items first before deleting the current Invoice.')";
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
