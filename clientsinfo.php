<?php

// Global variable for table object
$clients = NULL;

//
// Table class for clients
//
class cclients {
	var $TableVar = 'clients';
	var $TableName = 'clients';
	var $TableType = 'TABLE';
	var $id;
	var $Account_No;
	var $Alias;
	var $Client_Name;
	var $Address;
	var $Contact_No;
	var $Email_Address;
	var $TIN_No;
	var $Contact_Person;
	var $File_Upload;
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
	function cclients() {
		global $Language;

		// id
		$this->id = new cField('clients', 'clients', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Account_No
		$this->Account_No = new cField('clients', 'clients', 'x_Account_No', 'Account_No', '`Account_No`', 200, -1, FALSE, '`Account_No`', FALSE);
		$this->fields['Account_No'] =& $this->Account_No;

		// Alias
		$this->Alias = new cField('clients', 'clients', 'x_Alias', 'Alias', '`Alias`', 200, -1, FALSE, '`Alias`', FALSE);
		$this->fields['Alias'] =& $this->Alias;

		// Client_Name
		$this->Client_Name = new cField('clients', 'clients', 'x_Client_Name', 'Client_Name', '`Client_Name`', 200, -1, FALSE, '`Client_Name`', FALSE);
		$this->fields['Client_Name'] =& $this->Client_Name;

		// Address
		$this->Address = new cField('clients', 'clients', 'x_Address', 'Address', '`Address`', 200, -1, FALSE, '`Address`', FALSE);
		$this->fields['Address'] =& $this->Address;

		// Contact_No
		$this->Contact_No = new cField('clients', 'clients', 'x_Contact_No', 'Contact_No', '`Contact_No`', 200, -1, FALSE, '`Contact_No`', FALSE);
		$this->fields['Contact_No'] =& $this->Contact_No;

		// Email_Address
		$this->Email_Address = new cField('clients', 'clients', 'x_Email_Address', 'Email_Address', '`Email_Address`', 200, -1, FALSE, '`Email_Address`', FALSE);
		$this->fields['Email_Address'] =& $this->Email_Address;

		// TIN_No
		$this->TIN_No = new cField('clients', 'clients', 'x_TIN_No', 'TIN_No', '`TIN_No`', 200, -1, FALSE, '`TIN_No`', FALSE);
		$this->fields['TIN_No'] =& $this->TIN_No;

		// Contact_Person
		$this->Contact_Person = new cField('clients', 'clients', 'x_Contact_Person', 'Contact_Person', '`Contact_Person`', 200, -1, FALSE, '`Contact_Person`', FALSE);
		$this->fields['Contact_Person'] =& $this->Contact_Person;

		// File_Upload
		$this->File_Upload = new cField('clients', 'clients', 'x_File_Upload', 'File_Upload', '`File_Upload`', 200, -1, TRUE, '`File_Upload`', FALSE);
		$this->File_Upload->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->fields['File_Upload'] =& $this->File_Upload;

		// Remarks
		$this->Remarks = new cField('clients', 'clients', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
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
		return "clients_Highlight";
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
		return "`clients`";
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
		return "INSERT INTO `clients` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `clients` SET ";
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
		$SQL = "DELETE FROM `clients` WHERE ";
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
			return "clientslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "clientslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("clientsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "clientsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("clientsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("clientsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("clientsdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=clients" : "";
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
		$this->Account_No->setDbValue($rs->fields('Account_No'));
		$this->Alias->setDbValue($rs->fields('Alias'));
		$this->Client_Name->setDbValue($rs->fields('Client_Name'));
		$this->Address->setDbValue($rs->fields('Address'));
		$this->Contact_No->setDbValue($rs->fields('Contact_No'));
		$this->Email_Address->setDbValue($rs->fields('Email_Address'));
		$this->TIN_No->setDbValue($rs->fields('TIN_No'));
		$this->Contact_Person->setDbValue($rs->fields('Contact_Person'));
		$this->File_Upload->Upload->DbValue = $rs->fields('File_Upload');
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

		// Account_No
		$this->Account_No->CellCssStyle = ""; $this->Account_No->CellCssClass = "";
		$this->Account_No->CellAttrs = array(); $this->Account_No->ViewAttrs = array(); $this->Account_No->EditAttrs = array();

		// Alias
		$this->Alias->CellCssStyle = ""; $this->Alias->CellCssClass = "";
		$this->Alias->CellAttrs = array(); $this->Alias->ViewAttrs = array(); $this->Alias->EditAttrs = array();

		// Client_Name
		$this->Client_Name->CellCssStyle = ""; $this->Client_Name->CellCssClass = "";
		$this->Client_Name->CellAttrs = array(); $this->Client_Name->ViewAttrs = array(); $this->Client_Name->EditAttrs = array();

		// Address
		$this->Address->CellCssStyle = ""; $this->Address->CellCssClass = "";
		$this->Address->CellAttrs = array(); $this->Address->ViewAttrs = array(); $this->Address->EditAttrs = array();

		// Contact_No
		$this->Contact_No->CellCssStyle = ""; $this->Contact_No->CellCssClass = "";
		$this->Contact_No->CellAttrs = array(); $this->Contact_No->ViewAttrs = array(); $this->Contact_No->EditAttrs = array();

		// Email_Address
		$this->Email_Address->CellCssStyle = ""; $this->Email_Address->CellCssClass = "";
		$this->Email_Address->CellAttrs = array(); $this->Email_Address->ViewAttrs = array(); $this->Email_Address->EditAttrs = array();

		// TIN_No
		$this->TIN_No->CellCssStyle = ""; $this->TIN_No->CellCssClass = "";
		$this->TIN_No->CellAttrs = array(); $this->TIN_No->ViewAttrs = array(); $this->TIN_No->EditAttrs = array();

		// Contact_Person
		$this->Contact_Person->CellCssStyle = ""; $this->Contact_Person->CellCssClass = "";
		$this->Contact_Person->CellAttrs = array(); $this->Contact_Person->ViewAttrs = array(); $this->Contact_Person->EditAttrs = array();

		// File_Upload
		$this->File_Upload->CellCssStyle = ""; $this->File_Upload->CellCssClass = "";
		$this->File_Upload->CellAttrs = array(); $this->File_Upload->ViewAttrs = array(); $this->File_Upload->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// Account_No
		$this->Account_No->ViewValue = $this->Account_No->CurrentValue;
		$this->Account_No->CssStyle = "";
		$this->Account_No->CssClass = "";
		$this->Account_No->ViewCustomAttributes = "";

		// Alias
		$this->Alias->ViewValue = $this->Alias->CurrentValue;
		$this->Alias->CssStyle = "";
		$this->Alias->CssClass = "";
		$this->Alias->ViewCustomAttributes = "";

		// Client_Name
		$this->Client_Name->ViewValue = $this->Client_Name->CurrentValue;
		$this->Client_Name->CssStyle = "";
		$this->Client_Name->CssClass = "";
		$this->Client_Name->ViewCustomAttributes = "";

		// Address
		$this->Address->ViewValue = $this->Address->CurrentValue;
		$this->Address->CssStyle = "";
		$this->Address->CssClass = "";
		$this->Address->ViewCustomAttributes = "";

		// Contact_No
		$this->Contact_No->ViewValue = $this->Contact_No->CurrentValue;
		$this->Contact_No->CssStyle = "";
		$this->Contact_No->CssClass = "";
		$this->Contact_No->ViewCustomAttributes = "";

		// Email_Address
		$this->Email_Address->ViewValue = $this->Email_Address->CurrentValue;
		$this->Email_Address->CssStyle = "";
		$this->Email_Address->CssClass = "";
		$this->Email_Address->ViewCustomAttributes = "";

		// TIN_No
		$this->TIN_No->ViewValue = $this->TIN_No->CurrentValue;
		$this->TIN_No->CssStyle = "";
		$this->TIN_No->CssClass = "";
		$this->TIN_No->ViewCustomAttributes = "";

		// Contact_Person
		$this->Contact_Person->ViewValue = $this->Contact_Person->CurrentValue;
		$this->Contact_Person->CssStyle = "";
		$this->Contact_Person->CssClass = "";
		$this->Contact_Person->ViewCustomAttributes = "";

		// File_Upload
		if (!ew_Empty($this->File_Upload->Upload->DbValue)) {
			$this->File_Upload->ViewValue = $this->File_Upload->Upload->DbValue;
		} else {
			$this->File_Upload->ViewValue = "";
		}
		$this->File_Upload->CssStyle = "";
		$this->File_Upload->CssClass = "";
		$this->File_Upload->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// Account_No
		$this->Account_No->HrefValue = "";
		$this->Account_No->TooltipValue = "";

		// Alias
		$this->Alias->HrefValue = "";
		$this->Alias->TooltipValue = "";

		// Client_Name
		$this->Client_Name->HrefValue = "";
		$this->Client_Name->TooltipValue = "";

		// Address
		$this->Address->HrefValue = "";
		$this->Address->TooltipValue = "";

		// Contact_No
		$this->Contact_No->HrefValue = "";
		$this->Contact_No->TooltipValue = "";

		// Email_Address
		$this->Email_Address->HrefValue = "";
		$this->Email_Address->TooltipValue = "";

		// TIN_No
		$this->TIN_No->HrefValue = "";
		$this->TIN_No->TooltipValue = "";

		// Contact_Person
		$this->Contact_Person->HrefValue = "";
		$this->Contact_Person->TooltipValue = "";

		// File_Upload
		if (!ew_Empty($this->File_Upload->Upload->DbValue)) {
			$this->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $this->File_Upload->UploadPath) . ((!empty($this->File_Upload->ViewValue)) ? $this->File_Upload->ViewValue : $this->File_Upload->CurrentValue);
			if ($this->Export <> "") $clients->File_Upload->HrefValue = ew_ConvertFullUrl($this->File_Upload->HrefValue);
		} else {
			$this->File_Upload->HrefValue = "";
		}
		$this->File_Upload->TooltipValue = "";

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
