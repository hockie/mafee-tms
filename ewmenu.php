<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "", TRUE);
?>
<?php

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(33, $Language->MenuPhrase("33", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(30, $Language->MenuPhrase("30", "MenuText"), "./bookingsadd.php", 33, "", IsLoggedIn());
$RootMenu->AddMenuItem(13, $Language->MenuPhrase("13", "MenuText"), "bookingslist.php?cmd=resetall", 33, "", AllowListMenu('bookings'));
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "file_uploadslist.php?cmd=resetall", 33, "", AllowListMenu('file_uploads'));
$RootMenu->AddMenuItem(50, $Language->MenuPhrase("50", "MenuText"), "", -1, "", True);
$RootMenu->AddMenuItem(14, $Language->MenuPhrase("14", "MenuText"), "clientslist.php", 50, "", AllowListMenu('clients'));
$RootMenu->AddMenuItem(41, $Language->MenuPhrase("41", "MenuText"), "invoiceslist.php?cmd=resetall", 14, "", AllowListMenu('invoices'));
$RootMenu->AddMenuItem(36, $Language->MenuPhrase("36", "MenuText"), "client_payment_periodlist.php", 14, "", AllowListMenu('client_payment_period'));
$RootMenu->AddMenuItem(16, $Language->MenuPhrase("16", "MenuText"), "rateslist.php?cmd=resetall", 14, "", AllowListMenu('rates'));
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "areaslist.php", 14, "", AllowListMenu('areas'));
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "originslist.php", 14, "", AllowListMenu('origins'));
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "destinationslist.php", 14, "", AllowListMenu('destinations'));
$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "consigneeslist.php", 14, "", AllowListMenu('consignees'));
$RootMenu->AddMenuItem(17, $Language->MenuPhrase("17", "MenuText"), "subconslist.php", 50, "", AllowListMenu('subcons'));
$RootMenu->AddMenuItem(18, $Language->MenuPhrase("18", "MenuText"), "truckslist.php?cmd=resetall", 17, "", AllowListMenu('trucks'));
$RootMenu->AddMenuItem(12, $Language->MenuPhrase("12", "MenuText"), "truck_typeslist.php", 17, "", AllowListMenu('truck_types'));
$RootMenu->AddMenuItem(37, $Language->MenuPhrase("37", "MenuText"), "file_uploads_subconslist.php?cmd=resetall", 17, "", AllowListMenu('file_uploads_subcons'));
$RootMenu->AddMenuItem(11, $Language->MenuPhrase("11", "MenuText"), "truck_driverslist.php?cmd=resetall", 17, "", AllowListMenu('truck_drivers'));
$RootMenu->AddMenuItem(40, $Language->MenuPhrase("40", "MenuText"), "file_uploads_truckslist.php?cmd=resetall", 17, "", AllowListMenu('file_uploads_trucks'));
$RootMenu->AddMenuItem(49, $Language->MenuPhrase("49", "MenuText"), "", -1, "", True);
$RootMenu->AddMenuItem(44, $Language->MenuPhrase("44", "MenuText"), "account_paymentslist.php?cmd=resetall", 49, "", AllowListMenu('account_payments'));
$RootMenu->AddMenuItem(45, $Language->MenuPhrase("45", "MenuText"), "customer_invoiceslist.php?cmd=resetall", 49, "", AllowListMenu('customer_invoices'));
$RootMenu->AddMenuItem(54, $Language->MenuPhrase("54", "MenuText"), "vendor_billlist.php?cmd=resetall", 49, "", AllowListMenu('vendor_bill'));
$RootMenu->AddMenuItem(55, $Language->MenuPhrase("55", "MenuText"), "vendor_bill_itemslist.php?cmd=resetall", 54, "", AllowListMenu('vendor_bill_items'));
$RootMenu->AddMenuItem(24, $Language->MenuPhrase("24", "MenuText"), "expenseslist.php?cmd=resetall", 49, "", AllowListMenu('expenses'));
$RootMenu->AddMenuItem(52, $Language->MenuPhrase("52", "MenuText"), "expense_categorieslist.php", 24, "", AllowListMenu('expense_categories'));
$RootMenu->AddMenuItem(46, $Language->MenuPhrase("46", "MenuText"), "journal_accountslist.php?cmd=resetall", 49, "", AllowListMenu('journal_accounts'));
$RootMenu->AddMenuItem(47, $Language->MenuPhrase("47", "MenuText"), "journal_typeslist.php", 46, "", AllowListMenu('journal_types'));
$RootMenu->AddMenuItem(48, $Language->MenuPhrase("48", "MenuText"), "account_payment_methodslist.php", 46, "", AllowListMenu('account_payment_methods'));
$RootMenu->AddMenuItem(22, $Language->MenuPhrase("22", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(34, $Language->MenuPhrase("34", "MenuText"), "companylist.php", 22, "", AllowListMenu('company'));
$RootMenu->AddMenuItem(43, $Language->MenuPhrase("43", "MenuText"), "banks_accountslist.php?cmd=resetall", 34, "", AllowListMenu('banks_accounts'));
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "employeeslist.php", 22, "", AllowListMenu('employees'));
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "userslist.php", 22, "", AllowListMenu('users'));
$RootMenu->AddMenuItem(23, $Language->MenuPhrase("23", "MenuText"), "helperslist.php?cmd=resetall", 22, "", AllowListMenu('helpers'));
$RootMenu->AddMenuItem(27, $Language->MenuPhrase("27", "MenuText"), "booking_helperslist.php?cmd=resetall", 22, "", AllowListMenu('booking_helpers'));
$RootMenu->AddMenuItem(32, $Language->MenuPhrase("32", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(4, $Language->MenuPhrase("4", "MenuText"), "billing_typeslist.php", 32, "", AllowListMenu('billing_types'));
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "doc_typeslist.php", 32, "", AllowListMenu('doc_types'));
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "file_typeslist.php", 32, "", AllowListMenu('file_types'));
$RootMenu->AddMenuItem(10, $Language->MenuPhrase("10", "MenuText"), "statuseslist.php", 32, "", AllowListMenu('statuses'));
$RootMenu->AddMenuItem(19, $Language->MenuPhrase("19", "MenuText"), "unitslist.php", 32, "", AllowListMenu('units'));
$RootMenu->AddMenuItem(25, $Language->MenuPhrase("25", "MenuText"), "expenses_typeslist.php", 32, "", AllowListMenu('expenses_types'));
$RootMenu->AddMenuItem(21, $Language->MenuPhrase("21", "MenuText"), "userlevelslist.php", 32, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN);
$RootMenu->AddMenuItem(20, $Language->MenuPhrase("20", "MenuText"), "userlevelpermissionslist.php", 32, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN);
$RootMenu->AddMenuItem(31, $Language->MenuPhrase("31", "MenuText"), "audittraillist.php", 32, "", AllowListMenu('audittrail'));
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
