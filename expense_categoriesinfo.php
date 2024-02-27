<?php

// Global variable for table object
$expense_categories = NULL;

//
// Table class for expense_categories
//
class cexpense_categories {
	var $TableVar = 'expense_categories';
	var $TableName = 'expense_categories';
	var $TableType = 'TABLE';
	var $id;
	var $company_id;
	var $category_name;
	var $cost;
	var $internal_reference;
	var $re_invoice_expenses;
	var $vendor_taxes;
	var $customer_taxes;
	var $created;
	var $modified;
	var $user_id;
	var $remarks;
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
	function cexpense_categories() {
		global $Language;

		// id
		$this->id = new cField('expense_categories', 'expense_categories', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// company_id
		$this->company_id = new cField('expense_categories', 'expense_categories', 'x_company_id', 'company_id', '`company_id`', 3, -1, FALSE, '`company_id`', FALSE);
		$this->company_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['company_id'] =& $this->company_id;

		// category_name
		$this->category_name = new cField('expense_categories', 'expense_categories', 'x_category_name', 'category_name', '`category_name`', 200, -1, FALSE, '`category_name`', FALSE);
		$this->fields['category_name'] =& $this->category_name;

		// cost
		$this->cost = new cField('expense_categories', 'expense_categories', 'x_cost', 'cost', '`cost`', 131, -1, FALSE, '`cost`', FALSE);
		$this->cost->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['cost'] =& $this->cost;

		// internal_reference
		$this->internal_reference = new cField('expense_categories', 'expense_categories', 'x_internal_reference', 'internal_reference', '`internal_reference`', 200, -1, FALSE, '`internal_reference`', FALSE);
		$this->fields['internal_reference'] =& $this->internal_reference;

		// re_invoice_expenses
		$this->re_invoice_expenses = new cField('expense_categories', 'expense_categories', 'x_re_invoice_expenses', 're_invoice_expenses', '`re_invoice_expenses`', 200, -1, FALSE, '`re_invoice_expenses`', FALSE);
		$this->fields['re_invoice_expenses'] =& $this->re_invoice_expenses;

		// vendor_taxes
		$this->vendor_taxes = new cField('expense_categories', 'expense_categories', 'x_vendor_taxes', 'vendor_taxes', '`vendor_taxes`', 131, -1, FALSE, '`vendor_taxes`', FALSE);
		$this->vendor_taxes->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['vendor_taxes'] =& $this->vendor_taxes;

		// customer_taxes
		$this->customer_taxes = new cField('expense_categories', 'expense_categories', 'x_customer_taxes', 'customer_taxes', '`customer_taxes`', 131, -1, FALSE, '`customer_taxes`', FALSE);
		$this->customer_taxes->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['customer_taxes'] =& $this->customer_taxes;

		// created
		$this->created = new cField('expense_categories', 'expense_categories', 'x_created', 'created', '`created`', 135, 6, FALSE, '`created`', FALSE);
		$this->created->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['created'] =& $this->created;

		// modified
		$this->modified = new cField('expense_categories', 'expense_categories', 'x_modified', 'modified', '`modified`', 135, 6, FALSE, '`modified`', FALSE);
		$this->modified->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateMDY"));
		$this->fields['modified'] =& $this->modified;

		// user_id
		$this->user_id = new cField('expense_categories', 'expense_categories', 'x_user_id', 'user_id', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE);
		$this->user_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] =& $this->user_id;

		// remarks
		$this->remarks = new cField('expense_categories', 'expense_categories', 'x_remarks', 'remarks', '`remarks`', 201, -1, FALSE, '`remarks`', FALSE);
		$this->remarks->TruncateMemoRemoveHtml = TRUE;
		$this->fields['remarks'] =& $this->remarks;
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
		return "expense_categories_Highlight";
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
		return "`expense_categories`";
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
		return "INSERT INTO `expense_categories` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `expense_categories` SET ";
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
		$SQL = "DELETE FROM `expense_categories` WHERE ";
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
			return "expense_categorieslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "expense_categorieslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("expense_categoriesview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "expense_categoriesadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("expense_categoriesedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("expense_categoriesadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("expense_categoriesdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=expense_categories" : "";
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
		$this->company_id->setDbValue($rs->fields('company_id'));
		$this->category_name->setDbValue($rs->fields('category_name'));
		$this->cost->setDbValue($rs->fields('cost'));
		$this->internal_reference->setDbValue($rs->fields('internal_reference'));
		$this->re_invoice_expenses->setDbValue($rs->fields('re_invoice_expenses'));
		$this->vendor_taxes->setDbValue($rs->fields('vendor_taxes'));
		$this->customer_taxes->setDbValue($rs->fields('customer_taxes'));
		$this->created->setDbValue($rs->fields('created'));
		$this->modified->setDbValue($rs->fields('modified'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->remarks->setDbValue($rs->fields('remarks'));
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

		// company_id
		$this->company_id->CellCssStyle = ""; $this->company_id->CellCssClass = "";
		$this->company_id->CellAttrs = array(); $this->company_id->ViewAttrs = array(); $this->company_id->EditAttrs = array();

		// category_name
		$this->category_name->CellCssStyle = ""; $this->category_name->CellCssClass = "";
		$this->category_name->CellAttrs = array(); $this->category_name->ViewAttrs = array(); $this->category_name->EditAttrs = array();

		// cost
		$this->cost->CellCssStyle = ""; $this->cost->CellCssClass = "";
		$this->cost->CellAttrs = array(); $this->cost->ViewAttrs = array(); $this->cost->EditAttrs = array();

		// internal_reference
		$this->internal_reference->CellCssStyle = ""; $this->internal_reference->CellCssClass = "";
		$this->internal_reference->CellAttrs = array(); $this->internal_reference->ViewAttrs = array(); $this->internal_reference->EditAttrs = array();

		// re_invoice_expenses
		$this->re_invoice_expenses->CellCssStyle = ""; $this->re_invoice_expenses->CellCssClass = "";
		$this->re_invoice_expenses->CellAttrs = array(); $this->re_invoice_expenses->ViewAttrs = array(); $this->re_invoice_expenses->EditAttrs = array();

		// vendor_taxes
		$this->vendor_taxes->CellCssStyle = ""; $this->vendor_taxes->CellCssClass = "";
		$this->vendor_taxes->CellAttrs = array(); $this->vendor_taxes->ViewAttrs = array(); $this->vendor_taxes->EditAttrs = array();

		// customer_taxes
		$this->customer_taxes->CellCssStyle = ""; $this->customer_taxes->CellCssClass = "";
		$this->customer_taxes->CellAttrs = array(); $this->customer_taxes->ViewAttrs = array(); $this->customer_taxes->EditAttrs = array();

		// created
		$this->created->CellCssStyle = ""; $this->created->CellCssClass = "";
		$this->created->CellAttrs = array(); $this->created->ViewAttrs = array(); $this->created->EditAttrs = array();

		// modified
		$this->modified->CellCssStyle = ""; $this->modified->CellCssClass = "";
		$this->modified->CellAttrs = array(); $this->modified->ViewAttrs = array(); $this->modified->EditAttrs = array();

		// user_id
		$this->user_id->CellCssStyle = ""; $this->user_id->CellCssClass = "";
		$this->user_id->CellAttrs = array(); $this->user_id->ViewAttrs = array(); $this->user_id->EditAttrs = array();

		// remarks
		$this->remarks->CellCssStyle = ""; $this->remarks->CellCssClass = "";
		$this->remarks->CellAttrs = array(); $this->remarks->ViewAttrs = array(); $this->remarks->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// company_id
		if (strval($this->company_id->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->company_id->CurrentValue) . "";
		$sSqlWrk = "SELECT `Company_Name` FROM `company`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
		$sSqlWrk .= " ORDER BY `Company_Name` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->company_id->ViewValue = $rswrk->fields('Company_Name');
				$rswrk->Close();
			} else {
				$this->company_id->ViewValue = $this->company_id->CurrentValue;
			}
		} else {
			$this->company_id->ViewValue = NULL;
		}
		$this->company_id->CssStyle = "";
		$this->company_id->CssClass = "";
		$this->company_id->ViewCustomAttributes = "";

		// category_name
		$this->category_name->ViewValue = $this->category_name->CurrentValue;
		$this->category_name->CssStyle = "";
		$this->category_name->CssClass = "";
		$this->category_name->ViewCustomAttributes = "";

		// cost
		$this->cost->ViewValue = $this->cost->CurrentValue;
		$this->cost->ViewValue = ew_FormatNumber($this->cost->ViewValue, 2, -2, -2, -2);
		$this->cost->CssStyle = "";
		$this->cost->CssClass = "";
		$this->cost->ViewCustomAttributes = "";

		// internal_reference
		$this->internal_reference->ViewValue = $this->internal_reference->CurrentValue;
		$this->internal_reference->CssStyle = "";
		$this->internal_reference->CssClass = "";
		$this->internal_reference->ViewCustomAttributes = "";

		// re_invoice_expenses
		if (strval($this->re_invoice_expenses->CurrentValue) <> "") {
			switch ($this->re_invoice_expenses->CurrentValue) {
				case "yes":
					$this->re_invoice_expenses->ViewValue = "At Invoice";
					break;
				case "no":
					$this->re_invoice_expenses->ViewValue = "No";
					break;
				default:
					$this->re_invoice_expenses->ViewValue = $this->re_invoice_expenses->CurrentValue;
			}
		} else {
			$this->re_invoice_expenses->ViewValue = NULL;
		}
		$this->re_invoice_expenses->CssStyle = "";
		$this->re_invoice_expenses->CssClass = "";
		$this->re_invoice_expenses->ViewCustomAttributes = "";

		// vendor_taxes
		$this->vendor_taxes->ViewValue = $this->vendor_taxes->CurrentValue;
		$this->vendor_taxes->CssStyle = "";
		$this->vendor_taxes->CssClass = "";
		$this->vendor_taxes->ViewCustomAttributes = "";

		// customer_taxes
		$this->customer_taxes->ViewValue = $this->customer_taxes->CurrentValue;
		$this->customer_taxes->CssStyle = "";
		$this->customer_taxes->CssClass = "";
		$this->customer_taxes->ViewCustomAttributes = "";

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

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->CssStyle = "";
		$this->user_id->CssClass = "";
		$this->user_id->ViewCustomAttributes = "";

		// remarks
		$this->remarks->ViewValue = $this->remarks->CurrentValue;
		$this->remarks->CssStyle = "";
		$this->remarks->CssClass = "";
		$this->remarks->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// company_id
		$this->company_id->HrefValue = "";
		$this->company_id->TooltipValue = "";

		// category_name
		$this->category_name->HrefValue = "";
		$this->category_name->TooltipValue = "";

		// cost
		$this->cost->HrefValue = "";
		$this->cost->TooltipValue = "";

		// internal_reference
		$this->internal_reference->HrefValue = "";
		$this->internal_reference->TooltipValue = "";

		// re_invoice_expenses
		$this->re_invoice_expenses->HrefValue = "";
		$this->re_invoice_expenses->TooltipValue = "";

		// vendor_taxes
		$this->vendor_taxes->HrefValue = "";
		$this->vendor_taxes->TooltipValue = "";

		// customer_taxes
		$this->customer_taxes->HrefValue = "";
		$this->customer_taxes->TooltipValue = "";

		// created
		$this->created->HrefValue = "";
		$this->created->TooltipValue = "";

		// modified
		$this->modified->HrefValue = "";
		$this->modified->TooltipValue = "";

		// user_id
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// remarks
		$this->remarks->HrefValue = "";
		$this->remarks->TooltipValue = "";

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
