<?php

// Global variable for table object
$invoice_items = NULL;

//
// Table class for invoice_items
//
class cinvoice_items {
	var $TableVar = 'invoice_items';
	var $TableName = 'invoice_items';
	var $TableType = 'TABLE';
	var $id;
	var $invoice_id;
	var $client_id;
	var $booking_id;
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
	function cinvoice_items() {
		global $Language;

		// id
		$this->id = new cField('invoice_items', 'invoice_items', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// invoice_id
		$this->invoice_id = new cField('invoice_items', 'invoice_items', 'x_invoice_id', 'invoice_id', '`invoice_id`', 3, -1, FALSE, '`invoice_id`', FALSE);
		$this->invoice_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['invoice_id'] =& $this->invoice_id;

		// client_id
		$this->client_id = new cField('invoice_items', 'invoice_items', 'x_client_id', 'client_id', '`client_id`', 3, -1, FALSE, '`client_id`', FALSE);
		$this->client_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['client_id'] =& $this->client_id;

		// booking_id
		$this->booking_id = new cField('invoice_items', 'invoice_items', 'x_booking_id', 'booking_id', '`booking_id`', 3, -1, FALSE, '`booking_id`', FALSE);
		$this->booking_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['booking_id'] =& $this->booking_id;
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
		return "invoice_items_Highlight";
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
	function SqlMasterFilter_invoices() {
		return "`id`=@id@ AND `Client_ID`=@Client_ID@";
	}

	// Detail filter
	function SqlDetailFilter_invoices() {
		return "`invoice_id`=@invoice_id@ AND `client_id`=@client_id@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`invoice_items`";
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
		return "`booking_id` ASC";
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
		return "INSERT INTO `invoice_items` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `invoice_items` SET ";
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
		$SQL = "DELETE FROM `invoice_items` WHERE ";
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
			return "invoice_itemslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "invoice_itemslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("invoice_itemsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "invoice_itemsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("invoice_itemsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("invoice_itemsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("invoice_itemsdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=invoice_items" : "";
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
		$this->invoice_id->setDbValue($rs->fields('invoice_id'));
		$this->client_id->setDbValue($rs->fields('client_id'));
		$this->booking_id->setDbValue($rs->fields('booking_id'));
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

		// invoice_id
		$this->invoice_id->CellCssStyle = ""; $this->invoice_id->CellCssClass = "";
		$this->invoice_id->CellAttrs = array(); $this->invoice_id->ViewAttrs = array(); $this->invoice_id->EditAttrs = array();

		// client_id
		$this->client_id->CellCssStyle = ""; $this->client_id->CellCssClass = "";
		$this->client_id->CellAttrs = array(); $this->client_id->ViewAttrs = array(); $this->client_id->EditAttrs = array();

		// booking_id
		$this->booking_id->CellCssStyle = ""; $this->booking_id->CellCssClass = "";
		$this->booking_id->CellAttrs = array(); $this->booking_id->ViewAttrs = array(); $this->booking_id->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// invoice_id
		$this->invoice_id->ViewValue = $this->invoice_id->CurrentValue;
		$this->invoice_id->CssStyle = "";
		$this->invoice_id->CssClass = "";
		$this->invoice_id->ViewCustomAttributes = "";

		// client_id
		$this->client_id->ViewValue = $this->client_id->CurrentValue;
		$this->client_id->CssStyle = "";
		$this->client_id->CssClass = "";
		$this->client_id->ViewCustomAttributes = "";

		// booking_id
		if (strval($this->booking_id->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->booking_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `Booking_Number` FROM `bookings`";
		$sWhereWrk = "";
		if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
		$sWhereWrk .= "(" . "`Client_ID`=" . $invoice_items->client_id->ViewValue . " AND `Status_ID`=" . 2 . ")";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Booking_Number` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->booking_id->ViewValue = $rswrk->fields('Booking_Number');
				$rswrk->Close();
			} else {
				$this->booking_id->ViewValue = $this->booking_id->CurrentValue;
			}
		} else {
			$this->booking_id->ViewValue = NULL;
		}
		$this->booking_id->CssStyle = "";
		$this->booking_id->CssClass = "";
		$this->booking_id->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// invoice_id
		$this->invoice_id->HrefValue = "";
		$this->invoice_id->TooltipValue = "";

		// client_id
		$this->client_id->HrefValue = "";
		$this->client_id->TooltipValue = "";

		// booking_id
		if (!ew_Empty($this->booking_id->CurrentValue)) {
			$this->booking_id->HrefValue = $this->booking_id->CurrentValue;
			if ($this->Export <> "") $invoice_items->booking_id->HrefValue = ew_ConvertFullUrl($this->booking_id->HrefValue);
		} else {
			$this->booking_id->HrefValue = "";
		}
		$this->booking_id->TooltipValue = "";

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
			global $conn;
	        $booking_id = $rs["booking_id"];
	        $invoice_id = $rs["invoice_id"];

	        //get vat, wtax, freight, amount
	        $sSql = "SELECT VAT, Wtax, Total_Sales, Total_Amount_Due, Freight FROM bookings WHERE id = " . $booking_id;
	        $rswrk = $conn->Execute($sSql);
	         $VAT = $rswrk->fields('VAT');
			 $Wtax = $rswrk->fields('Wtax');
			 $Total_Sales = $rswrk->fields('Total_Sales');
			 $Total_Amount_Due = $rswrk->fields('Total_Amount_Due');
			 $Freight = $rswrk->fields('Freight');
			 
			 //get expenses
			 $esSql = "SELECT 
e.id as 'ID',  
SUM(e.Amount) as 'Amount',
SUM(e.Vat) as 'Vat',
SUM(e.Wtax) as 'WTax',
SUM(e.Total_Sales) as 'Total_Sales',
SUM(e.Total_Amount_Due) as 'Total_Amount_Due'

FROM expenses e
INNER JOIN expenses_types t ON (t.id = e.Expenses_Type_ID)
WHERE e.Add_To_Billing = 'YES' AND e.Booking_ID = " . $booking_id;
 $ewrk = $conn->Execute($esSql);
 if(isset($ewrk)){
$eAmount = $ewrk->fields('Amount');
 $eVat = $ewrk->fields('Vat');
 $eWTax = $ewrk->fields('WTax');
 $eTotal_Sales = $ewrk->fields('Total_Sales');
 $eTotal_Amount_Due = $ewrk->fields('Total_Amount_Due');
 
 
$VAT = $VAT + $eVat;
$Wtax = $Wtax + $eWTax;
$Freight = $Freight + $eAmount;
$Total_Amount_Due = $Total_Amount_Due + $eTotal_Amount_Due;
 }
 

	        //update invoice
	        $xSql = "UPDATE invoices set Total_Vat =  (SELECT  if (Total_Vat IS NULL, 0, Total_Vat )) + " . $VAT . ", Total_WTax =  (SELECT  if (Total_WTax IS NULL, 0, Total_WTax )) + " . $Wtax . ", Total_Freight =  (SELECT  if (Total_Freight IS NULL, 0, Total_Freight )) + " . $Freight . ", Total_Amount_Due =  (SELECT  if (Total_Amount_Due IS NULL, 0, Total_Amount_Due )) + " . round($Total_Amount_Due,1) .  "  where id = " . $invoice_id;
	        $conn->Execute($xSql);
	        
            //update booking status
			$uSql = "UPDATE bookings set Billing_Type_ID = 5 WHERE id = " . $booking_id;
			$conn->Execute($uSql);
	    //echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {
		
		global $conn;
	        $oldbooking_id = $rsold["booking_id"];
			$newbooking_id = $rsnew["booking_id"];
	        $invoice_id = $rsnew["invoice_id"];
		
	        //get vat, wtax, freight, amount
	        $oldsSql = "SELECT ID, Total_Vat, Total_WTax, Total_Freight, Total_Amount_Due FROM invoices WHERE id = " . $invoice_id;
	        $oldrswrk = $conn->Execute($oldsSql);
	         $oldVAT = $oldrswrk->fields('Total_Vat');
			 $oldWtax = $oldrswrk->fields('Total_WTax');
			 $oldFreight = $oldrswrk->fields('Total_Freight');
			 $oldTotal_Amount_Due = $oldrswrk->fields('Total_Amount_Due');
			 
			//update old value
			
			 
			//get vat, wtax, freight, amount
	        $newsSql = "SELECT VAT, Wtax, Total_Sales, Total_Amount_Due, Freight FROM bookings WHERE id = " . $newbooking_id;
	        $newrswrk = $conn->Execute($newsSql);
	        $newVAT = $newrswrk->fields('VAT');
			$newWtax = $newrswrk->fields('Wtax');
			$newTotal_Sales = $newrswrk->fields('Total_Sales');
			$newTotal_Amount_Due = $newrswrk->fields('Total_Amount_Due');
			$newFreight = $newrswrk->fields('Freight');
			 
			 //set value
			 
			 $VAT = $oldVAT - ($oldVAT  - $newVAT);
			  $Wtax = $oldWtax - ($oldWtax  - $newWtax);
			 $Freight =  $oldFreight - ($oldFreight  - $newFreight); 
			 $Total_Amount_Due = $oldTotal_Amount_Due - ($oldTotal_Amount_Due  - $newTotal_Amount_Due);
			 //$VAT = $oldWtax - $newWtax;
			 //$VAT = $oldWtax - $newWtax;
			 
			//update invoice
	        $xSql = "UPDATE invoices set Total_Vat =  " . $VAT . ", Total_WTax =  " . $Wtax . ", Total_Freight =  " . $Freight . ", Total_Amount_Due = " . round($Total_Amount_Due,1) .  "  where id = " . $invoice_id;
			
			$conn->Execute($xSql);
			
            //update booking status
			$uoSql = "UPDATE bookings set Billing_Type_ID = 1, Status_ID = 2 WHERE id = " . $oldbooking_id;
			$conn->Execute($uoSql);
			
		
			$unSql = "UPDATE bookings set Billing_Type_ID = 5 WHERE id = " . $newbooking_id;
			$conn->Execute($unSql);
		// Enter your code here
		// To cancel, set return value to FALSE
		//echo $Freight;
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
		$booking_id = $rs["booking_id"];
		$invoice_id = $rs["invoice_id"];
		
		//get vat, wtax, freight, amount
	        $sSql = "SELECT VAT, Wtax, Total_Sales, Total_Amount_Due, Freight FROM bookings WHERE id = " . $booking_id;
	        $rswrk = $conn->Execute($sSql);
	        $VAT = $rswrk->fields('VAT');
			$Wtax = $rswrk->fields('Wtax');
			$Total_Sales = $rswrk->fields('Total_Sales');
			$Total_Amount_Due = $rswrk->fields('Total_Amount_Due');
			$Freight = $rswrk->fields('Freight');
			
		//update
		$isSql = "UPDATE invoices 
set 
Total_Vat =  (SELECT  if (Total_Vat IS NULL, 0, Total_Vat )) - " . $VAT . " ,
Total_WTax =  (SELECT  if (Total_WTax IS NULL, 0, Total_WTax )) - " . $Wtax . " ,
Total_Freight =  (SELECT  if (Total_Freight IS NULL, 0, Total_Freight ))  - " . $Freight . " ,
Total_Amount_Due =  (SELECT  if (Total_Amount_Due IS NULL, 0, Total_Amount_Due ))  - " . round($Total_Amount_Due,1) . " 
where id = " . $invoice_id;
		
		$conn->Execute($isSql);
		
		$uSql = "UPDATE bookings set Billing_Type_ID = 1, Status_ID = 2 WHERE id = " . $booking_id;
		$conn->Execute($uSql);
		
		
		 //get expenses
			 $esSql = "SELECT 
e.id as 'ID',  
SUM(e.Amount) as 'Amount',
SUM(e.Vat) as 'Vat',
SUM(e.Wtax) as 'WTax',
SUM(e.Total_Sales) as 'Total_Sales',
SUM(e.Total_Amount_Due) as 'Total_Amount_Due'

FROM expenses e
INNER JOIN expenses_types t ON (t.id = e.Expenses_Type_ID)
WHERE e.Add_To_Billing = 'YES' AND e.Booking_ID = " . $booking_id;
 $ewrk = $conn->Execute($esSql);
 if(isset($ewrk)){
$eAmount = $ewrk->fields('Amount');
 $eVat = $ewrk->fields('Vat');
 $eWTax = $ewrk->fields('WTax');
 $eTotal_Sales = $ewrk->fields('Total_Sales');
 $eTotal_Amount_Due = $ewrk->fields('Total_Amount_Due');
 

//update
		$isSql = "UPDATE invoices 
set 
Total_Vat =  (SELECT  if (Total_Vat IS NULL, 0, Total_Vat )) - " . $eVat . " ,
Total_WTax =  (SELECT  if (Total_WTax IS NULL, 0, Total_WTax )) - " . $eWTax . " ,
Total_Freight =  (SELECT  if (Total_Freight IS NULL, 0, Total_Freight ))  - " . $eAmount . " ,
Total_Amount_Due =  (SELECT  if (Total_Amount_Due IS NULL, 0, Total_Amount_Due ))  - " . $eTotal_Amount_Due . " 
where id = " . $invoice_id;
		
		$conn->Execute($isSql);
		
 }
			
			
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
