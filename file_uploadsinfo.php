<?php

// Global variable for table object
$file_uploads = NULL;

//
// Table class for file_uploads
//
class cfile_uploads {
	var $TableVar = 'file_uploads';
	var $TableName = 'file_uploads';
	var $TableType = 'TABLE';
	var $id;
	var $Booking_ID;
	var $Filename;
	var $File_Type_ID;
	var $Document_Pages;
	var $Date_Received_Subcon;
	var $Date_Submitted_Client;
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
	function cfile_uploads() {
		global $Language;

		// id
		$this->id = new cField('file_uploads', 'file_uploads', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// Booking_ID
		$this->Booking_ID = new cField('file_uploads', 'file_uploads', 'x_Booking_ID', 'Booking_ID', '`Booking_ID`', 3, -1, FALSE, '`Booking_ID`', FALSE);
		$this->Booking_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Booking_ID'] =& $this->Booking_ID;

		// Filename
		$this->Filename = new cField('file_uploads', 'file_uploads', 'x_Filename', 'Filename', '`Filename`', 200, -1, TRUE, '`Filename`', FALSE);
		$this->Filename->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->fields['Filename'] =& $this->Filename;

		// File_Type_ID
		$this->File_Type_ID = new cField('file_uploads', 'file_uploads', 'x_File_Type_ID', 'File_Type_ID', '`File_Type_ID`', 3, -1, FALSE, '`File_Type_ID`', FALSE);
		$this->File_Type_ID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['File_Type_ID'] =& $this->File_Type_ID;

		// Document_Pages
		$this->Document_Pages = new cField('file_uploads', 'file_uploads', 'x_Document_Pages', 'Document_Pages', '`Document_Pages`', 3, -1, FALSE, '`Document_Pages`', FALSE);
		$this->Document_Pages->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Document_Pages'] =& $this->Document_Pages;

		// Date_Received_Subcon
		$this->Date_Received_Subcon = new cField('file_uploads', 'file_uploads', 'x_Date_Received_Subcon', 'Date_Received_Subcon', '`Date_Received_Subcon`', 135, 6, FALSE, '`Date_Received_Subcon`', FALSE);
		$this->Date_Received_Subcon->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date_Received_Subcon'] =& $this->Date_Received_Subcon;

		// Date_Submitted_Client
		$this->Date_Submitted_Client = new cField('file_uploads', 'file_uploads', 'x_Date_Submitted_Client', 'Date_Submitted_Client', '`Date_Submitted_Client`', 135, 6, FALSE, '`Date_Submitted_Client`', FALSE);
		$this->Date_Submitted_Client->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['Date_Submitted_Client'] =& $this->Date_Submitted_Client;

		// Remarks
		$this->Remarks = new cField('file_uploads', 'file_uploads', 'x_Remarks', 'Remarks', '`Remarks`', 201, -1, FALSE, '`Remarks`', FALSE);
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
		return "file_uploads_Highlight";
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

	// Table level SQL
	function SqlFrom() { // From
		return "`file_uploads`";
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
		return "`id` DESC";
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
		return "INSERT INTO `file_uploads` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `file_uploads` SET ";
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
		$SQL = "DELETE FROM `file_uploads` WHERE ";
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
			return "file_uploadslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "file_uploadslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("file_uploadsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "file_uploadsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("file_uploadsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("file_uploadsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("file_uploadsdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=file_uploads" : "";
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
		$this->Booking_ID->setDbValue($rs->fields('Booking_ID'));
		$this->Filename->Upload->DbValue = $rs->fields('Filename');
		$this->File_Type_ID->setDbValue($rs->fields('File_Type_ID'));
		$this->Document_Pages->setDbValue($rs->fields('Document_Pages'));
		$this->Date_Received_Subcon->setDbValue($rs->fields('Date_Received_Subcon'));
		$this->Date_Submitted_Client->setDbValue($rs->fields('Date_Submitted_Client'));
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

		// Booking_ID
		$this->Booking_ID->CellCssStyle = ""; $this->Booking_ID->CellCssClass = "";
		$this->Booking_ID->CellAttrs = array(); $this->Booking_ID->ViewAttrs = array(); $this->Booking_ID->EditAttrs = array();

		// Filename
		$this->Filename->CellCssStyle = ""; $this->Filename->CellCssClass = "";
		$this->Filename->CellAttrs = array(); $this->Filename->ViewAttrs = array(); $this->Filename->EditAttrs = array();

		// File_Type_ID
		$this->File_Type_ID->CellCssStyle = ""; $this->File_Type_ID->CellCssClass = "";
		$this->File_Type_ID->CellAttrs = array(); $this->File_Type_ID->ViewAttrs = array(); $this->File_Type_ID->EditAttrs = array();

		// Document_Pages
		$this->Document_Pages->CellCssStyle = ""; $this->Document_Pages->CellCssClass = "";
		$this->Document_Pages->CellAttrs = array(); $this->Document_Pages->ViewAttrs = array(); $this->Document_Pages->EditAttrs = array();

		// Date_Received_Subcon
		$this->Date_Received_Subcon->CellCssStyle = ""; $this->Date_Received_Subcon->CellCssClass = "";
		$this->Date_Received_Subcon->CellAttrs = array(); $this->Date_Received_Subcon->ViewAttrs = array(); $this->Date_Received_Subcon->EditAttrs = array();

		// Date_Submitted_Client
		$this->Date_Submitted_Client->CellCssStyle = ""; $this->Date_Submitted_Client->CellCssClass = "";
		$this->Date_Submitted_Client->CellAttrs = array(); $this->Date_Submitted_Client->ViewAttrs = array(); $this->Date_Submitted_Client->EditAttrs = array();

		// Remarks
		$this->Remarks->CellCssStyle = ""; $this->Remarks->CellCssClass = "";
		$this->Remarks->CellAttrs = array(); $this->Remarks->ViewAttrs = array(); $this->Remarks->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// Booking_ID
		if (strval($this->Booking_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->Booking_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Date` Desc";
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

		// Filename
		if (!ew_Empty($this->Filename->Upload->DbValue)) {
			$this->Filename->ViewValue = $this->Filename->Upload->DbValue;
		} else {
			$this->Filename->ViewValue = "";
		}
		$this->Filename->CssStyle = "";
		$this->Filename->CssClass = "";
		$this->Filename->ViewCustomAttributes = "";

		// File_Type_ID
		if (strval($this->File_Type_ID->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->File_Type_ID->CurrentValue) . "";
		$sSqlWrk = "SELECT `File_Type` FROM `file_types`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `File_Type` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->File_Type_ID->ViewValue = $rswrk->fields('File_Type');
				$rswrk->Close();
			} else {
				$this->File_Type_ID->ViewValue = $this->File_Type_ID->CurrentValue;
			}
		} else {
			$this->File_Type_ID->ViewValue = NULL;
		}
		$this->File_Type_ID->CssStyle = "";
		$this->File_Type_ID->CssClass = "";
		$this->File_Type_ID->ViewCustomAttributes = "";

		// Document_Pages
		$this->Document_Pages->ViewValue = $this->Document_Pages->CurrentValue;
		$this->Document_Pages->CssStyle = "";
		$this->Document_Pages->CssClass = "";
		$this->Document_Pages->ViewCustomAttributes = "";

		// Date_Received_Subcon
		$this->Date_Received_Subcon->ViewValue = $this->Date_Received_Subcon->CurrentValue;
		$this->Date_Received_Subcon->ViewValue = ew_FormatDateTime($this->Date_Received_Subcon->ViewValue, 6);
		$this->Date_Received_Subcon->CssStyle = "";
		$this->Date_Received_Subcon->CssClass = "";
		$this->Date_Received_Subcon->ViewCustomAttributes = "";

		// Date_Submitted_Client
		$this->Date_Submitted_Client->ViewValue = $this->Date_Submitted_Client->CurrentValue;
		$this->Date_Submitted_Client->ViewValue = ew_FormatDateTime($this->Date_Submitted_Client->ViewValue, 6);
		$this->Date_Submitted_Client->CssStyle = "";
		$this->Date_Submitted_Client->CssClass = "";
		$this->Date_Submitted_Client->ViewCustomAttributes = "";

		// Remarks
		$this->Remarks->ViewValue = $this->Remarks->CurrentValue;
		$this->Remarks->CssStyle = "";
		$this->Remarks->CssClass = "";
		$this->Remarks->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// Booking_ID
		$this->Booking_ID->HrefValue = "";
		$this->Booking_ID->TooltipValue = "";

		// Filename
		if (!ew_Empty($this->Filename->Upload->DbValue)) {
			$this->Filename->HrefValue = ew_UploadPathEx(FALSE, $this->Filename->UploadPath) . ((!empty($this->Filename->ViewValue)) ? $this->Filename->ViewValue : $this->Filename->CurrentValue);
			if ($this->Export <> "") $file_uploads->Filename->HrefValue = ew_ConvertFullUrl($this->Filename->HrefValue);
		} else {
			$this->Filename->HrefValue = "";
		}
		$this->Filename->TooltipValue = "";

		// File_Type_ID
		$this->File_Type_ID->HrefValue = "";
		$this->File_Type_ID->TooltipValue = "";

		// Document_Pages
		$this->Document_Pages->HrefValue = "";
		$this->Document_Pages->TooltipValue = "";

		// Date_Received_Subcon
		$this->Date_Received_Subcon->HrefValue = "";
		$this->Date_Received_Subcon->TooltipValue = "";

		// Date_Submitted_Client
		$this->Date_Submitted_Client->HrefValue = "";
		$this->Date_Submitted_Client->TooltipValue = "";

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
