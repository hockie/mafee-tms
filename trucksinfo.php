<?php

// Global variable for table object
$trucks = NULL;

//
// Table class for trucks
//
class ctrucks {
	var $TableVar = 'trucks';
	var $TableName = 'trucks';
	var $TableType = 'TABLE';
	var $id;
	var $Sub_Con_ID;
	var $Model;
	var $Brand;
	var $Truck_Types_ID;
	var $Plate_Number;
	var $Series;
	var $Truck_Body_Type;
	var $Gross_Weight;
	var $Net_Capacity;
	var $Inland_Marine_Insurance;
	var $Expiration_Date;
	var $LTFRB_Case_No;
	var $LTFRB_Expiration;
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
	function ctrucks() {
		global $Language;

		// id
		$this->id = new cField('trucks', 'trucks', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Sub_Con_ID
		$this->Sub_Con_ID = new cField('trucks', 'trucks', 'x_Sub_Con_ID', 'Sub_Con_ID', '`Sub_Con_ID`', 3, -1, FALSE, '`Sub_Con_ID`', FALSE);
		$this->Sub_Con_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Sub_Con_ID'] =& $this->Sub_Con_ID;

		// Model
		$this->Model = new cField('trucks', 'trucks', 'x_Model', 'Model', '`Model`', 200, -1, FALSE, '`Model`', FALSE);
		$this->fields['Model'] =& $this->Model;

		// Brand
		$this->Brand = new cField('trucks', 'trucks', 'x_Brand', 'Brand', '`Brand`', 200, -1, FALSE, '`Brand`', FALSE);
		$this->fields['Brand'] =& $this->Brand;

		// Truck_Types_ID
		$this->Truck_Types_ID = new cField('trucks', 'trucks', 'x_Truck_Types_ID', 'Truck_Types_ID', '`Truck_Types_ID`', 3, -1, FALSE, '`Truck_Types_ID`', FALSE);
		$this->Truck_Types_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Truck_Types_ID'] =& $this->Truck_Types_ID;

		// Plate_Number
		$this->Plate_Number = new cField('trucks', 'trucks', 'x_Plate_Number', 'Plate_Number', '`Plate_Number`', 200, -1, FALSE, '`Plate_Number`', FALSE);
		$this->fields['Plate_Number'] =& $this->Plate_Number;

		// Series
		$this->Series = new cField('trucks', 'trucks', 'x_Series', 'Series', '`Series`', 200, -1, FALSE, '`Series`', FALSE);
		$this->fields['Series'] =& $this->Series;

		// Truck_Body_Type
		$this->Truck_Body_Type = new cField('trucks', 'trucks', 'x_Truck_Body_Type', 'Truck_Body_Type', '`Truck_Body_Type`', 200, -1, FALSE, '`Truck_Body_Type`', FALSE);
		$this->fields['Truck_Body_Type'] =& $this->Truck_Body_Type;

		// Gross_Weight
		$this->Gross_Weight = new cField('trucks', 'trucks', 'x_Gross_Weight', 'Gross_Weight', '`Gross_Weight`', 3, -1, FALSE, '`Gross_Weight`', FALSE);
		$this->Gross_Weight->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Gross_Weight'] =& $this->Gross_Weight;

		// Net_Capacity
		$this->Net_Capacity = new cField('trucks', 'trucks', 'x_Net_Capacity', 'Net_Capacity', '`Net_Capacity`', 3, -1, FALSE, '`Net_Capacity`', FALSE);
		$this->Net_Capacity->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Net_Capacity'] =& $this->Net_Capacity;

		// Inland_Marine_Insurance
		$this->Inland_Marine_Insurance = new cField('trucks', 'trucks', 'x_Inland_Marine_Insurance', 'Inland_Marine_Insurance', '`Inland_Marine_Insurance`', 200, -1, FALSE, '`Inland_Marine_Insurance`', FALSE);
		$this->fields['Inland_Marine_Insurance'] =& $this->Inland_Marine_Insurance;

		// Expiration_Date
		$this->Expiration_Date = new cField('trucks', 'trucks', 'x_Expiration_Date', 'Expiration_Date', '`Expiration_Date`', 133, 6, FALSE, '`Expiration_Date`', FALSE);
		$this->Expiration_Date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Expiration_Date'] =& $this->Expiration_Date;

		// LTFRB_Case_No
		$this->LTFRB_Case_No = new cField('trucks', 'trucks', 'x_LTFRB_Case_No', 'LTFRB_Case_No', '`LTFRB_Case_No`', 200, -1, FALSE, '`LTFRB_Case_No`', FALSE);
		$this->fields['LTFRB_Case_No'] =& $this->LTFRB_Case_No;

		// LTFRB_Expiration
		$this->LTFRB_Expiration = new cField('trucks', 'trucks', 'x_LTFRB_Expiration', 'LTFRB_Expiration', '`LTFRB_Expiration`', 133, 6, FALSE, '`LTFRB_Expiration`', FALSE);
		$this->LTFRB_Expiration->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['LTFRB_Expiration'] =& $this->LTFRB_Expiration;

		// File_Upload
		$this->File_Upload = new cField('trucks', 'trucks', 'x_File_Upload', 'File_Upload', '`File_Upload`', 200, -1, TRUE, '`File_Upload`', FALSE);
		$this->File_Upload->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->fields['File_Upload'] =& $this->File_Upload;

		// Remarks
		$this->Remarks = new cField('trucks', 'trucks', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
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
		return "trucks_Highlight";
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
		return "`Sub_Con_ID`=@Sub_Con_ID@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`trucks`";
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
		return "INSERT INTO `trucks` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `trucks` SET ";
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
		$SQL = "DELETE FROM `trucks` WHERE ";
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
			return "truckslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "truckslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("trucksview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "trucksadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("trucksedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("trucksadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("trucksdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=trucks" : "";
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
		$this->Sub_Con_ID->setDbValue($rs->fields('Sub_Con_ID'));
		$this->Model->setDbValue($rs->fields('Model'));
		$this->Brand->setDbValue($rs->fields('Brand'));
		$this->Truck_Types_ID->setDbValue($rs->fields('Truck_Types_ID'));
		$this->Plate_Number->setDbValue($rs->fields('Plate_Number'));
		$this->Series->setDbValue($rs->fields('Series'));
		$this->Truck_Body_Type->setDbValue($rs->fields('Truck_Body_Type'));
		$this->Gross_Weight->setDbValue($rs->fields('Gross_Weight'));
		$this->Net_Capacity->setDbValue($rs->fields('Net_Capacity'));
		$this->Inland_Marine_Insurance->setDbValue($rs->fields('Inland_Marine_Insurance'));
		$this->Expiration_Date->setDbValue($rs->fields('Expiration_Date'));
		$this->LTFRB_Case_No->setDbValue($rs->fields('LTFRB_Case_No'));
		$this->LTFRB_Expiration->setDbValue($rs->fields('LTFRB_Expiration'));
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

		// Sub_Con_ID
		$this->Sub_Con_ID->CellCssStyle = ""; $this->Sub_Con_ID->CellCssClass = "";
		$this->Sub_Con_ID->CellAttrs = array(); $this->Sub_Con_ID->ViewAttrs = array(); $this->Sub_Con_ID->EditAttrs = array();

		// Model
		$this->Model->CellCssStyle = ""; $this->Model->CellCssClass = "";
		$this->Model->CellAttrs = array(); $this->Model->ViewAttrs = array(); $this->Model->EditAttrs = array();

		// Brand
		$this->Brand->CellCssStyle = ""; $this->Brand->CellCssClass = "";
		$this->Brand->CellAttrs = array(); $this->Brand->ViewAttrs = array(); $this->Brand->EditAttrs = array();

		// Truck_Types_ID
		$this->Truck_Types_ID->CellCssStyle = ""; $this->Truck_Types_ID->CellCssClass = "";
		$this->Truck_Types_ID->CellAttrs = array(); $this->Truck_Types_ID->ViewAttrs = array(); $this->Truck_Types_ID->EditAttrs = array();

		// Plate_Number
		$this->Plate_Number->CellCssStyle = ""; $this->Plate_Number->CellCssClass = "";
		$this->Plate_Number->CellAttrs = array(); $this->Plate_Number->ViewAttrs = array(); $this->Plate_Number->EditAttrs = array();

		// Series
		$this->Series->CellCssStyle = ""; $this->Series->CellCssClass = "";
		$this->Series->CellAttrs = array(); $this->Series->ViewAttrs = array(); $this->Series->EditAttrs = array();

		// Truck_Body_Type
		$this->Truck_Body_Type->CellCssStyle = ""; $this->Truck_Body_Type->CellCssClass = "";
		$this->Truck_Body_Type->CellAttrs = array(); $this->Truck_Body_Type->ViewAttrs = array(); $this->Truck_Body_Type->EditAttrs = array();

		// Gross_Weight
		$this->Gross_Weight->CellCssStyle = ""; $this->Gross_Weight->CellCssClass = "";
		$this->Gross_Weight->CellAttrs = array(); $this->Gross_Weight->ViewAttrs = array(); $this->Gross_Weight->EditAttrs = array();

		// Net_Capacity
		$this->Net_Capacity->CellCssStyle = ""; $this->Net_Capacity->CellCssClass = "";
		$this->Net_Capacity->CellAttrs = array(); $this->Net_Capacity->ViewAttrs = array(); $this->Net_Capacity->EditAttrs = array();

		// Inland_Marine_Insurance
		$this->Inland_Marine_Insurance->CellCssStyle = ""; $this->Inland_Marine_Insurance->CellCssClass = "";
		$this->Inland_Marine_Insurance->CellAttrs = array(); $this->Inland_Marine_Insurance->ViewAttrs = array(); $this->Inland_Marine_Insurance->EditAttrs = array();

		// Expiration_Date
		$this->Expiration_Date->CellCssStyle = ""; $this->Expiration_Date->CellCssClass = "";
		$this->Expiration_Date->CellAttrs = array(); $this->Expiration_Date->ViewAttrs = array(); $this->Expiration_Date->EditAttrs = array();

		// LTFRB_Case_No
		$this->LTFRB_Case_No->CellCssStyle = ""; $this->LTFRB_Case_No->CellCssClass = "";
		$this->LTFRB_Case_No->CellAttrs = array(); $this->LTFRB_Case_No->ViewAttrs = array(); $this->LTFRB_Case_No->EditAttrs = array();

		// LTFRB_Expiration
		$this->LTFRB_Expiration->CellCssStyle = ""; $this->LTFRB_Expiration->CellCssClass = "";
		$this->LTFRB_Expiration->CellAttrs = array(); $this->LTFRB_Expiration->ViewAttrs = array(); $this->LTFRB_Expiration->EditAttrs = array();

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

		// Sub_Con_ID
		if (strval($this->Sub_Con_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Sub_Con_ID->CurrentValue) . "";
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
				$this->Sub_Con_ID->ViewValue = $rswrk->fields('Subcon_Name');
				$rswrk->Close();
			} else {
				$this->Sub_Con_ID->ViewValue = $this->Sub_Con_ID->CurrentValue;
			}
		} else {
			$this->Sub_Con_ID->ViewValue = NULL;
		}
		$this->Sub_Con_ID->CssStyle = "";
		$this->Sub_Con_ID->CssClass = "";
		$this->Sub_Con_ID->ViewCustomAttributes = "";

		// Model
		$this->Model->ViewValue = $this->Model->CurrentValue;
		$this->Model->CssStyle = "";
		$this->Model->CssClass = "";
		$this->Model->ViewCustomAttributes = "";

		// Brand
		$this->Brand->ViewValue = $this->Brand->CurrentValue;
		$this->Brand->CssStyle = "";
		$this->Brand->CssClass = "";
		$this->Brand->ViewCustomAttributes = "";

		// Truck_Types_ID
		if (strval($this->Truck_Types_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Truck_Types_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Truck_Type` FROM `truck_types`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Truck_Type` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->Truck_Types_ID->ViewValue = $rswrk->fields('Truck_Type');
				$rswrk->Close();
			} else {
				$this->Truck_Types_ID->ViewValue = $this->Truck_Types_ID->CurrentValue;
			}
		} else {
			$this->Truck_Types_ID->ViewValue = NULL;
		}
		$this->Truck_Types_ID->CssStyle = "";
		$this->Truck_Types_ID->CssClass = "";
		$this->Truck_Types_ID->ViewCustomAttributes = "";

		// Plate_Number
		$this->Plate_Number->ViewValue = $this->Plate_Number->CurrentValue;
		$this->Plate_Number->CssStyle = "";
		$this->Plate_Number->CssClass = "";
		$this->Plate_Number->ViewCustomAttributes = "";

		// Series
		$this->Series->ViewValue = $this->Series->CurrentValue;
		$this->Series->CssStyle = "";
		$this->Series->CssClass = "";
		$this->Series->ViewCustomAttributes = "";

		// Truck_Body_Type
		$this->Truck_Body_Type->ViewValue = $this->Truck_Body_Type->CurrentValue;
		$this->Truck_Body_Type->CssStyle = "";
		$this->Truck_Body_Type->CssClass = "";
		$this->Truck_Body_Type->ViewCustomAttributes = "";

		// Gross_Weight
		$this->Gross_Weight->ViewValue = $this->Gross_Weight->CurrentValue;
		$this->Gross_Weight->ViewValue = ew_FormatNumber($this->Gross_Weight->ViewValue, 0, -2, -2, -2);
		$this->Gross_Weight->CssStyle = "";
		$this->Gross_Weight->CssClass = "";
		$this->Gross_Weight->ViewCustomAttributes = "";

		// Net_Capacity
		$this->Net_Capacity->ViewValue = $this->Net_Capacity->CurrentValue;
		$this->Net_Capacity->ViewValue = ew_FormatNumber($this->Net_Capacity->ViewValue, 0, -2, -2, -2);
		$this->Net_Capacity->CssStyle = "";
		$this->Net_Capacity->CssClass = "";
		$this->Net_Capacity->ViewCustomAttributes = "";

		// Inland_Marine_Insurance
		$this->Inland_Marine_Insurance->ViewValue = $this->Inland_Marine_Insurance->CurrentValue;
		$this->Inland_Marine_Insurance->CssStyle = "";
		$this->Inland_Marine_Insurance->CssClass = "";
		$this->Inland_Marine_Insurance->ViewCustomAttributes = "";

		// Expiration_Date
		$this->Expiration_Date->ViewValue = $this->Expiration_Date->CurrentValue;
		$this->Expiration_Date->ViewValue = ew_FormatDateTime($this->Expiration_Date->ViewValue, 6);
		$this->Expiration_Date->CssStyle = "";
		$this->Expiration_Date->CssClass = "";
		$this->Expiration_Date->ViewCustomAttributes = "";

		// LTFRB_Case_No
		$this->LTFRB_Case_No->ViewValue = $this->LTFRB_Case_No->CurrentValue;
		$this->LTFRB_Case_No->CssStyle = "";
		$this->LTFRB_Case_No->CssClass = "";
		$this->LTFRB_Case_No->ViewCustomAttributes = "";

		// LTFRB_Expiration
		$this->LTFRB_Expiration->ViewValue = $this->LTFRB_Expiration->CurrentValue;
		$this->LTFRB_Expiration->ViewValue = ew_FormatDateTime($this->LTFRB_Expiration->ViewValue, 6);
		$this->LTFRB_Expiration->CssStyle = "";
		$this->LTFRB_Expiration->CssClass = "";
		$this->LTFRB_Expiration->ViewCustomAttributes = "";

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

		// Sub_Con_ID
		$this->Sub_Con_ID->HrefValue = "";
		$this->Sub_Con_ID->TooltipValue = "";

		// Model
		$this->Model->HrefValue = "";
		$this->Model->TooltipValue = "";

		// Brand
		$this->Brand->HrefValue = "";
		$this->Brand->TooltipValue = "";

		// Truck_Types_ID
		$this->Truck_Types_ID->HrefValue = "";
		$this->Truck_Types_ID->TooltipValue = "";

		// Plate_Number
		$this->Plate_Number->HrefValue = "";
		$this->Plate_Number->TooltipValue = "";

		// Series
		$this->Series->HrefValue = "";
		$this->Series->TooltipValue = "";

		// Truck_Body_Type
		$this->Truck_Body_Type->HrefValue = "";
		$this->Truck_Body_Type->TooltipValue = "";

		// Gross_Weight
		$this->Gross_Weight->HrefValue = "";
		$this->Gross_Weight->TooltipValue = "";

		// Net_Capacity
		$this->Net_Capacity->HrefValue = "";
		$this->Net_Capacity->TooltipValue = "";

		// Inland_Marine_Insurance
		$this->Inland_Marine_Insurance->HrefValue = "";
		$this->Inland_Marine_Insurance->TooltipValue = "";

		// Expiration_Date
		$this->Expiration_Date->HrefValue = "";
		$this->Expiration_Date->TooltipValue = "";

		// LTFRB_Case_No
		$this->LTFRB_Case_No->HrefValue = "";
		$this->LTFRB_Case_No->TooltipValue = "";

		// LTFRB_Expiration
		$this->LTFRB_Expiration->HrefValue = "";
		$this->LTFRB_Expiration->TooltipValue = "";

		// File_Upload
		if (!ew_Empty($this->File_Upload->Upload->DbValue)) {
			$this->File_Upload->HrefValue = ew_UploadPathEx(FALSE, $this->File_Upload->UploadPath) . ((!empty($this->File_Upload->ViewValue)) ? $this->File_Upload->ViewValue : $this->File_Upload->CurrentValue);
			if ($this->Export <> "") $trucks->File_Upload->HrefValue = ew_ConvertFullUrl($this->File_Upload->HrefValue);
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
