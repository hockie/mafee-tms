<?php

// Global variable for table object
$customer_invoices = NULL;

//
// Table class for customer_invoices
//
class ccustomer_invoices {
	var $TableVar = 'customer_invoices';
	var $TableName = 'customer_invoices';
	var $TableType = 'TABLE';
	var $id;
	var $Payment_ID;
	var $Invoice_ID;
	var $Client_ID;
	var $Invoice_Bill_Date;
	var $Due_Date;
	var $Invoice_Number;
	var $Total_Amount_Due;
	var $Payment_Status_ID;
	var $Status_ID;
	var $created;
	var $modified;
	var $User_ID;
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
	function ccustomer_invoices() {
		global $Language;

		// id
		$this->id = new cField('customer_invoices', 'customer_invoices', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Payment_ID
		$this->Payment_ID = new cField('customer_invoices', 'customer_invoices', 'x_Payment_ID', 'Payment_ID', '`Payment_ID`', 3, -1, FALSE, '`Payment_ID`', FALSE);
		$this->Payment_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Payment_ID'] =& $this->Payment_ID;

		// Invoice_ID
		$this->Invoice_ID = new cField('customer_invoices', 'customer_invoices', 'x_Invoice_ID', 'Invoice_ID', '`Invoice_ID`', 3, -1, FALSE, '`Invoice_ID`', FALSE);
		$this->Invoice_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Invoice_ID'] =& $this->Invoice_ID;

		// Client_ID
		$this->Client_ID = new cField('customer_invoices', 'customer_invoices', 'x_Client_ID', 'Client_ID', '`Client_ID`', 3, -1, FALSE, '`Client_ID`', FALSE);
		$this->Client_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Client_ID'] =& $this->Client_ID;

		// Invoice_Bill_Date
		$this->Invoice_Bill_Date = new cField('customer_invoices', 'customer_invoices', 'x_Invoice_Bill_Date', 'Invoice_Bill_Date', '`Invoice_Bill_Date`', 135, 6, FALSE, '`Invoice_Bill_Date`', FALSE);
		$this->Invoice_Bill_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Invoice_Bill_Date'] =& $this->Invoice_Bill_Date;

		// Due_Date
		$this->Due_Date = new cField('customer_invoices', 'customer_invoices', 'x_Due_Date', 'Due_Date', '`Due_Date`', 135, 6, FALSE, '`Due_Date`', FALSE);
		$this->Due_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Due_Date'] =& $this->Due_Date;

		// Invoice_Number
		$this->Invoice_Number = new cField('customer_invoices', 'customer_invoices', 'x_Invoice_Number', 'Invoice_Number', '`Invoice_Number`', 200, -1, FALSE, '`Invoice_Number`', FALSE);
		$this->fields['Invoice_Number'] =& $this->Invoice_Number;

		// Total_Amount_Due
		$this->Total_Amount_Due = new cField('customer_invoices', 'customer_invoices', 'x_Total_Amount_Due', 'Total_Amount_Due', '`Total_Amount_Due`', 131, -1, FALSE, '`Total_Amount_Due`', FALSE);
		$this->Total_Amount_Due->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Total_Amount_Due'] =& $this->Total_Amount_Due;

		// Payment_Status_ID
		$this->Payment_Status_ID = new cField('customer_invoices', 'customer_invoices', 'x_Payment_Status_ID', 'Payment_Status_ID', '`Payment_Status_ID`', 3, -1, FALSE, '`Payment_Status_ID`', FALSE);
		$this->Payment_Status_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Payment_Status_ID'] =& $this->Payment_Status_ID;

		// Status_ID
		$this->Status_ID = new cField('customer_invoices', 'customer_invoices', 'x_Status_ID', 'Status_ID', '`Status_ID`', 3, -1, FALSE, '`Status_ID`', FALSE);
		$this->Status_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Status_ID'] =& $this->Status_ID;

		// created
		$this->created = new cField('customer_invoices', 'customer_invoices', 'x_created', 'created', '`created`', 135, 6, FALSE, '`created`', FALSE);
		$this->created->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['created'] =& $this->created;

		// modified
		$this->modified = new cField('customer_invoices', 'customer_invoices', 'x_modified', 'modified', '`modified`', 135, 6, FALSE, '`modified`', FALSE);
		$this->modified->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['modified'] =& $this->modified;

		// User_ID
		$this->User_ID = new cField('customer_invoices', 'customer_invoices', 'x_User_ID', 'User_ID', '`User_ID`', 3, -1, FALSE, '`User_ID`', FALSE);
		$this->User_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['User_ID'] =& $this->User_ID;

		// Remarks
		$this->Remarks = new cField('customer_invoices', 'customer_invoices', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
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
		return "customer_invoices_Highlight";
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
	function SqlMasterFilter_account_payments() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_account_payments() {
		return "`Payment_ID`=@Payment_ID@";
	}

	// Master filter
	function SqlMasterFilter_invoices() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_invoices() {
		return "`Invoice_ID`=@Invoice_ID@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`customer_invoices`";
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
		return "`Invoice_Bill_Date` DESC";
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
		return "INSERT INTO `customer_invoices` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `customer_invoices` SET ";
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
		$SQL = "DELETE FROM `customer_invoices` WHERE ";
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
			return "customer_invoiceslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "customer_invoiceslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("customer_invoicesview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "customer_invoicesadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("customer_invoicesedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("customer_invoicesadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("customer_invoicesdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=customer_invoices" : "";
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
		$this->Payment_ID->setDbValue($rs->fields('Payment_ID'));
		$this->Invoice_ID->setDbValue($rs->fields('Invoice_ID'));
		$this->Client_ID->setDbValue($rs->fields('Client_ID'));
		$this->Invoice_Bill_Date->setDbValue($rs->fields('Invoice_Bill_Date'));
		$this->Due_Date->setDbValue($rs->fields('Due_Date'));
		$this->Invoice_Number->setDbValue($rs->fields('Invoice_Number'));
		$this->Total_Amount_Due->setDbValue($rs->fields('Total_Amount_Due'));
		$this->Payment_Status_ID->setDbValue($rs->fields('Payment_Status_ID'));
		$this->Status_ID->setDbValue($rs->fields('Status_ID'));
		$this->created->setDbValue($rs->fields('created'));
		$this->modified->setDbValue($rs->fields('modified'));
		$this->User_ID->setDbValue($rs->fields('User_ID'));
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

		// Payment_ID
		$this->Payment_ID->CellCssStyle = ""; $this->Payment_ID->CellCssClass = "";
		$this->Payment_ID->CellAttrs = array(); $this->Payment_ID->ViewAttrs = array(); $this->Payment_ID->EditAttrs = array();

		// Invoice_ID
		$this->Invoice_ID->CellCssStyle = ""; $this->Invoice_ID->CellCssClass = "";
		$this->Invoice_ID->CellAttrs = array(); $this->Invoice_ID->ViewAttrs = array(); $this->Invoice_ID->EditAttrs = array();

		// Invoice_Bill_Date
		$this->Invoice_Bill_Date->CellCssStyle = ""; $this->Invoice_Bill_Date->CellCssClass = "";
		$this->Invoice_Bill_Date->CellAttrs = array(); $this->Invoice_Bill_Date->ViewAttrs = array(); $this->Invoice_Bill_Date->EditAttrs = array();

		// Due_Date
		$this->Due_Date->CellCssStyle = ""; $this->Due_Date->CellCssClass = "";
		$this->Due_Date->CellAttrs = array(); $this->Due_Date->ViewAttrs = array(); $this->Due_Date->EditAttrs = array();

		// Total_Amount_Due
		$this->Total_Amount_Due->CellCssStyle = ""; $this->Total_Amount_Due->CellCssClass = "";
		$this->Total_Amount_Due->CellAttrs = array(); $this->Total_Amount_Due->ViewAttrs = array(); $this->Total_Amount_Due->EditAttrs = array();

		// Payment_Status_ID
		$this->Payment_Status_ID->CellCssStyle = ""; $this->Payment_Status_ID->CellCssClass = "";
		$this->Payment_Status_ID->CellAttrs = array(); $this->Payment_Status_ID->ViewAttrs = array(); $this->Payment_Status_ID->EditAttrs = array();

		// Status_ID
		$this->Status_ID->CellCssStyle = ""; $this->Status_ID->CellCssClass = "";
		$this->Status_ID->CellAttrs = array(); $this->Status_ID->ViewAttrs = array(); $this->Status_ID->EditAttrs = array();

		// User_ID
		$this->User_ID->CellCssStyle = ""; $this->User_ID->CellCssClass = "";
		$this->User_ID->CellAttrs = array(); $this->User_ID->ViewAttrs = array(); $this->User_ID->EditAttrs = array();

		// Remarks
		$this->Remarks->CellCssStyle = ""; $this->Remarks->CellCssClass = "";
		$this->Remarks->CellAttrs = array(); $this->Remarks->ViewAttrs = array(); $this->Remarks->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// Payment_ID
		$this->Payment_ID->ViewValue = $this->Payment_ID->CurrentValue;
		$this->Payment_ID->CssStyle = "";
		$this->Payment_ID->CssClass = "";
		$this->Payment_ID->ViewCustomAttributes = "";

		// Invoice_ID
		if (strval($this->Invoice_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Invoice_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Invoice_Number` FROM `invoices`";
		$sWhereWrk = "";
		if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
		$sWhereWrk .= "(" . "`Payment_Status`=" . 9 . ")";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Invoice_Number` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Invoice_ID->ViewValue = $rswrk->fields('Invoice_Number');
				$rswrk->Close();
			} else {
				$this->Invoice_ID->ViewValue = $this->Invoice_ID->CurrentValue;
			}
		} else {
			$this->Invoice_ID->ViewValue = NULL;
		}
		$this->Invoice_ID->CssStyle = "";
		$this->Invoice_ID->CssClass = "";
		$this->Invoice_ID->ViewCustomAttributes = "";

		// Invoice_Bill_Date
		$this->Invoice_Bill_Date->ViewValue = $this->Invoice_Bill_Date->CurrentValue;
		$this->Invoice_Bill_Date->ViewValue = ew_FormatDateTime($this->Invoice_Bill_Date->ViewValue, 6);
		$this->Invoice_Bill_Date->CssStyle = "";
		$this->Invoice_Bill_Date->CssClass = "";
		$this->Invoice_Bill_Date->ViewCustomAttributes = "";

		// Due_Date
		$this->Due_Date->ViewValue = $this->Due_Date->CurrentValue;
		$this->Due_Date->ViewValue = ew_FormatDateTime($this->Due_Date->ViewValue, 6);
		$this->Due_Date->CssStyle = "";
		$this->Due_Date->CssClass = "";
		$this->Due_Date->ViewCustomAttributes = "";

		// Total_Amount_Due
		$this->Total_Amount_Due->ViewValue = $this->Total_Amount_Due->CurrentValue;
		$this->Total_Amount_Due->ViewValue = ew_FormatNumber($this->Total_Amount_Due->ViewValue, 2, -2, -2, -2);
		$this->Total_Amount_Due->CssStyle = "";
		$this->Total_Amount_Due->CssClass = "";
		$this->Total_Amount_Due->ViewCustomAttributes = "";

		// Payment_Status_ID
		if (strval($this->Payment_Status_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Payment_Status_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Status` FROM `statuses`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Payment_Status_ID->ViewValue = $rswrk->fields('Status');
				$rswrk->Close();
			} else {
				$this->Payment_Status_ID->ViewValue = $this->Payment_Status_ID->CurrentValue;
			}
		} else {
			$this->Payment_Status_ID->ViewValue = NULL;
		}
		$this->Payment_Status_ID->CssStyle = "";
		$this->Payment_Status_ID->CssClass = "";
		$this->Payment_Status_ID->ViewCustomAttributes = "";

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

		// Remarks
		$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
		$this->Remarks->CssStyle = "";
		$this->Remarks->CssClass = "";
		$this->Remarks->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// Payment_ID
		if (!ew_Empty($this->Payment_ID->CurrentValue)) {
			$this->Payment_ID->HrefValue = $this->Payment_ID->CurrentValue;
			if ($this->Export <> "") $customer_invoices->Payment_ID->HrefValue = ew_ConvertFullUrl($this->Payment_ID->HrefValue);
		} else {
			$this->Payment_ID->HrefValue = "";
		}
		$this->Payment_ID->TooltipValue = "";

		// Invoice_ID
		if (!ew_Empty($this->Invoice_ID->CurrentValue)) {
			$this->Invoice_ID->HrefValue = $this->Invoice_ID->CurrentValue;
			if ($this->Export <> "") $customer_invoices->Invoice_ID->HrefValue = ew_ConvertFullUrl($this->Invoice_ID->HrefValue);
		} else {
			$this->Invoice_ID->HrefValue = "";
		}
		$this->Invoice_ID->TooltipValue = "";

		// Invoice_Bill_Date
		$this->Invoice_Bill_Date->HrefValue = "";
		$this->Invoice_Bill_Date->TooltipValue = "";

		// Due_Date
		$this->Due_Date->HrefValue = "";
		$this->Due_Date->TooltipValue = "";

		// Total_Amount_Due
		$this->Total_Amount_Due->HrefValue = "";
		$this->Total_Amount_Due->TooltipValue = "";

		// Payment_Status_ID
		$this->Payment_Status_ID->HrefValue = "";
		$this->Payment_Status_ID->TooltipValue = "";

		// Status_ID
		$this->Status_ID->HrefValue = "";
		$this->Status_ID->TooltipValue = "";

		// User_ID
		$this->User_ID->HrefValue = "";
		$this->User_ID->TooltipValue = "";

		// Remarks
		$this->Remarks->HrefValue = "";
		$this->Remarks->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->Total_Amount_Due->CurrentValue))
				$this->Total_Amount_Due->Total += $this->Total_Amount_Due->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
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
    
    $invoice_id = $rs["Invoice_ID"];
        $Payment_ID = $rs["Payment_ID"];
        $Status_ID = NULL;
        $conn = ew_Connect();

        if($Payment_ID){
            $psSql = "SELECT `Date`, Payment_Reference, Payment_Date, Payment_Type, Journal_Account_ID, Payment_Method_ID, Client_ID, Amount, Status_ID, `Description`, Remarks, User_ID, Journal_Type_ID, Vendor_ID FROM account_payments where ID = " . $Payment_ID;
            $pswrk = $conn->Execute($psSql);
            $Status_ID = $pswrk->fields('Status_ID');

        }
        if($invoice_id){
            //retrive invoice record
            $csSql = " SELECT ID, Client_ID, Invoice_Date, Due_Date, Invoice_Number, Total_Amount_Due, Payment_Status, Status FROM invoices where ID = " . $invoice_id;
            $rswrk = $conn->Execute($csSql);
            $Client_ID = $rswrk->fields('Client_ID');
            $Invoice_Date = $rswrk->fields('Invoice_Date');
            $Due_Date = $rswrk->fields('Due_Date');
            $Invoice_Number = $rswrk->fields('Invoice_Number');
            $Total_Amount_Due = $rswrk->fields('Total_Amount_Due');
            $Payment_Status_ID = $rswrk->fields('Payment_Status');
            $Status = $rswrk->fields('Status');
            //$Status_ID = $rswrk->fields('Status_ID');

            //insert values to customer invoice
            $rs["Client_ID"] = $Client_ID;
            $rs["Invoice_Bill_Date"] = $Invoice_Date;
            $rs["Due_Date"] = $Due_Date;
            $rs["Invoice_Number"] = $Invoice_Number;
            $rs["Total_Amount_Due"] = $Total_Amount_Due;
           // $rs["Payment_Status_ID"] = $Status_ID;
           // $rs["Status_ID"] = $Status_ID;
            //echo $csSql;
        }else{
            echo "no invoice id";
            
        }
        
    return TRUE;
}

		// Row Inserted event
	function Row_Inserted(&$rs) {
	  global $Page;
	        $Payment_ID = $rs["Payment_ID"];
	        $tad = $rs["Total_Amount_Due"];
	        $invoice_id = $rs["Invoice_ID"];
	        global $conn;

	        //add the Total_Amount_Due to account_payments table in total_invoice_items field 
	        if(isset($rs["Total_Amount_Due"])){
	            $sSql = "CALL add_parent_payment_amount(" . $Payment_ID . ",". $tad .")";          
	            $conn->Execute($sSql);
	        }

	        //select account_payments TABLE
	        $ap_sql = "SELECT Amount, total_invoice_items FROM account_payments where id = " .  $Payment_ID;
	        $apwrk = $conn->Execute($ap_sql);
	        $amount = $apwrk->fields('Amount');
	        $tii = $apwrk->fields('total_invoice_items');
	        if($amount == $tii){ //paid
	            $rs["Status_ID"] = 8;
	            $invSql = "UPDATE invoices SET Payment_Status = 8 WHERE id = " . $invoice_id;
	            $conn->Execute($invSql);

	            //echo $invSql;
	        }
	        if($amount < $tii){ //partial 
	            $rs["Status_ID"] = 10; 
	            $invSql = "UPDATE invoices SET Payment_Status = 10 WHERE id = " . $invoice_id;
	            $paSql = "UPDATE account_payments SET Status_ID = 10 WHERE id = " . $Payment_ID;
	            $ciSql = "UPDATE customer_invoices SET Status_ID = 10, Payment_Status_ID = 10 WHERE id = " . $rs["id"];
	            $conn->Execute($invSql);
	            $conn->Execute($paSql);
	            $conn->Execute($ciSql);

	            //echo $invSql;
	            //$Page->setMessage($ciSql);

	        }
	        if($amount > $tii){ // overcredit
	            $rs["Status_ID"] = 10; 
	            $invSql = "UPDATE invoices SET Payment_Status = 8 WHERE id = " . $invoice_id;
	            $paSql = "UPDATE account_payments SET Status_ID = 17 WHERE id = " . $Payment_ID;
	            $ciSql = "UPDATE customer_invoices SET Status_ID = 8, Payment_Status_ID = 10 WHERE id = " . $rs["id"];
	            $conn->Execute($invSql);
	            $conn->Execute($paSql);
	            $conn->Execute($ciSql);

	            //echo $invSql;
	           // $Page->setMessage($ciSql);

	        }   

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

	    $invoice_id_ = $rs['Invoice_ID'];
	    $payment_id_ = $rs['Payment_ID'];
	    $total_amount_due_ = $rs['Total_Amount_Due'];
	    global $conn;
	    $sSql = "CALL deduct_parent_payment_amount(" . $payment_id_ . ",". $total_amount_due_ .")";
	    $xSql = "CALL inv_status_notpaid_posted(9,12,". $invoice_id_ .")";  
	    $conn->Execute($sSql);
	    $conn->Execute($xSql);
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
