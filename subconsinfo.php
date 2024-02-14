<?php

// Global variable for table object
$subcons = NULL;

//
// Table class for subcons
//
class csubcons {
	var $TableVar = 'subcons';
	var $TableName = 'subcons';
	var $TableType = 'TABLE';
	var $id;
	var $Subcon_ID;
	var $Subcon_Name;
	var $Address;
	var $ContactNo;
	var $Email_Address;
	var $TIN_No;
	var $ContactPerson;
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
	function csubcons() {
		global $Language;

		// id
		$this->id = new cField('subcons', 'subcons', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Subcon_ID
		$this->Subcon_ID = new cField('subcons', 'subcons', 'x_Subcon_ID', 'Subcon_ID', '`Subcon_ID`', 200, -1, FALSE, '`Subcon_ID`', FALSE);
		$this->fields['Subcon_ID'] =& $this->Subcon_ID;

		// Subcon_Name
		$this->Subcon_Name = new cField('subcons', 'subcons', 'x_Subcon_Name', 'Subcon_Name', '`Subcon_Name`', 200, -1, FALSE, '`Subcon_Name`', FALSE);
		$this->fields['Subcon_Name'] =& $this->Subcon_Name;

		// Address
		$this->Address = new cField('subcons', 'subcons', 'x_Address', 'Address', '`Address`', 200, -1, FALSE, '`Address`', FALSE);
		$this->fields['Address'] =& $this->Address;

		// ContactNo
		$this->ContactNo = new cField('subcons', 'subcons', 'x_ContactNo', 'ContactNo', '`ContactNo`', 200, -1, FALSE, '`ContactNo`', FALSE);
		$this->fields['ContactNo'] =& $this->ContactNo;

		// Email_Address
		$this->Email_Address = new cField('subcons', 'subcons', 'x_Email_Address', 'Email_Address', '`Email_Address`', 200, -1, FALSE, '`Email_Address`', FALSE);
		$this->fields['Email_Address'] =& $this->Email_Address;

		// TIN_No
		$this->TIN_No = new cField('subcons', 'subcons', 'x_TIN_No', 'TIN_No', '`TIN_No`', 200, -1, FALSE, '`TIN_No`', FALSE);
		$this->fields['TIN_No'] =& $this->TIN_No;

		// ContactPerson
		$this->ContactPerson = new cField('subcons', 'subcons', 'x_ContactPerson', 'ContactPerson', '`ContactPerson`', 200, -1, FALSE, '`ContactPerson`', FALSE);
		$this->fields['ContactPerson'] =& $this->ContactPerson;

		// File_Upload
		$this->File_Upload = new cField('subcons', 'subcons', 'x_File_Upload', 'File_Upload', '`File_Upload`', 200, -1, TRUE, '`File_Upload`', FALSE);
		$this->File_Upload->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->fields['File_Upload'] =& $this->File_Upload;

		// Remarks
		$this->Remarks = new cField('subcons', 'subcons', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
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
		return "subcons_Highlight";
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
		return "`subcons`";
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
		return "`Subcon_Name` ASC";
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
		return "INSERT INTO `subcons` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `subcons` SET ";
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
		$SQL = "DELETE FROM `subcons` WHERE ";
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
			return "subconslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "subconslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("subconsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "subconsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("subconsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("subconsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("subconsdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=subcons" : "";
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
		$this->Subcon_ID->setDbValue($rs->fields('Subcon_ID'));
		$this->Subcon_Name->setDbValue($rs->fields('Subcon_Name'));
		$this->Address->setDbValue($rs->fields('Address'));
		$this->ContactNo->setDbValue($rs->fields('ContactNo'));
		$this->Email_Address->setDbValue($rs->fields('Email_Address'));
		$this->TIN_No->setDbValue($rs->fields('TIN_No'));
		$this->ContactPerson->setDbValue($rs->fields('ContactPerson'));
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

		// Subcon_ID
		$this->Subcon_ID->CellCssStyle = ""; $this->Subcon_ID->CellCssClass = "";
		$this->Subcon_ID->CellAttrs = array(); $this->Subcon_ID->ViewAttrs = array(); $this->Subcon_ID->EditAttrs = array();

		// Subcon_Name
		$this->Subcon_Name->CellCssStyle = ""; $this->Subcon_Name->CellCssClass = "";
		$this->Subcon_Name->CellAttrs = array(); $this->Subcon_Name->ViewAttrs = array(); $this->Subcon_Name->EditAttrs = array();

		// Address
		$this->Address->CellCssStyle = ""; $this->Address->CellCssClass = "";
		$this->Address->CellAttrs = array(); $this->Address->ViewAttrs = array(); $this->Address->EditAttrs = array();

		// ContactNo
		$this->ContactNo->CellCssStyle = ""; $this->ContactNo->CellCssClass = "";
		$this->ContactNo->CellAttrs = array(); $this->ContactNo->ViewAttrs = array(); $this->ContactNo->EditAttrs = array();

		// Email_Address
		$this->Email_Address->CellCssStyle = ""; $this->Email_Address->CellCssClass = "";
		$this->Email_Address->CellAttrs = array(); $this->Email_Address->ViewAttrs = array(); $this->Email_Address->EditAttrs = array();

		// TIN_No
		$this->TIN_No->CellCssStyle = ""; $this->TIN_No->CellCssClass = "";
		$this->TIN_No->CellAttrs = array(); $this->TIN_No->ViewAttrs = array(); $this->TIN_No->EditAttrs = array();

		// ContactPerson
		$this->ContactPerson->CellCssStyle = ""; $this->ContactPerson->CellCssClass = "";
		$this->ContactPerson->CellAttrs = array(); $this->ContactPerson->ViewAttrs = array(); $this->ContactPerson->EditAttrs = array();

		// File_Upload
		$this->File_Upload->CellCssStyle = ""; $this->File_Upload->CellCssClass = "";
		$this->File_Upload->CellAttrs = array(); $this->File_Upload->ViewAttrs = array(); $this->File_Upload->EditAttrs = array();

		// Remarks
		$this->Remarks->CellCssStyle = ""; $this->Remarks->CellCssClass = "";
		$this->Remarks->CellAttrs = array(); $this->Remarks->ViewAttrs = array(); $this->Remarks->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// Subcon_ID
		$this->Subcon_ID->ViewValue = $this->Subcon_ID->CurrentValue;
		$this->Subcon_ID->CssStyle = "";
		$this->Subcon_ID->CssClass = "";
		$this->Subcon_ID->ViewCustomAttributes = "";

		// Subcon_Name
		$this->Subcon_Name->ViewValue = $this->Subcon_Name->CurrentValue;
		$this->Subcon_Name->CssStyle = "";
		$this->Subcon_Name->CssClass = "";
		$this->Subcon_Name->ViewCustomAttributes = "";

		// Address
		$this->Address->ViewValue = $this->Address->CurrentValue;
		$this->Address->CssStyle = "";
		$this->Address->CssClass = "";
		$this->Address->ViewCustomAttributes = "";

		// ContactNo
		$this->ContactNo->ViewValue = $this->ContactNo->CurrentValue;
		$this->ContactNo->CssStyle = "";
		$this->ContactNo->CssClass = "";
		$this->ContactNo->ViewCustomAttributes = "";

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

		// ContactPerson
		$this->ContactPerson->ViewValue = $this->ContactPerson->CurrentValue;
		$this->ContactPerson->CssStyle = "";
		$this->ContactPerson->CssClass = "";
		$this->ContactPerson->ViewCustomAttributes = "";

		// File_Upload
		if (!ew_Empty($this->File_Upload->Upload->DbValue)) {
			$this->File_Upload->ViewValue = $this->File_Upload->Upload->DbValue;
		} else {
			$this->File_Upload->ViewValue = "";
		}
		$this->File_Upload->CssStyle = "";
		$this->File_Upload->CssClass = "";
		$this->File_Upload->ViewCustomAttributes = "";

		// Remarks
		$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
		$this->Remarks->CssStyle = "";
		$this->Remarks->CssClass = "";
		$this->Remarks->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// Subcon_ID
		$this->Subcon_ID->HrefValue = "";
		$this->Subcon_ID->TooltipValue = "";

		// Subcon_Name
		$this->Subcon_Name->HrefValue = "";
		$this->Subcon_Name->TooltipValue = "";

		// Address
		$this->Address->HrefValue = "";
		$this->Address->TooltipValue = "";

		// ContactNo
		$this->ContactNo->HrefValue = "";
		$this->ContactNo->TooltipValue = "";

		// Email_Address
		$this->Email_Address->HrefValue = "";
		$this->Email_Address->TooltipValue = "";

		// TIN_No
		$this->TIN_No->HrefValue = "";
		$this->TIN_No->TooltipValue = "";

		// ContactPerson
		$this->ContactPerson->HrefValue = "";
		$this->ContactPerson->TooltipValue = "";

		// File_Upload
		if (!ew_Empty($this->File_Upload->Upload->DbValue)) {
			$this->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $this->File_Upload->UploadPath) . ((!empty($this->File_Upload->ViewValue)) ? $this->File_Upload->ViewValue : $this->File_Upload->CurrentValue);
			if ($this->Export <> "") $subcons->File_Upload->HrefValue = ew_ConvertFullUrl($this->File_Upload->HrefValue);
		} else {
			$this->File_Upload->HrefValue = "";
		}
		$this->File_Upload->TooltipValue = "";

		// Remarks
		$this->Remarks->HrefValue = "";
		$this->Remarks->TooltipValue = "";

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
