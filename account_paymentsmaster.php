<?php

// Call Row_Rendering event
$account_payments->Row_Rendering();

// id
$account_payments->id->CellCssStyle = ""; $account_payments->id->CellCssClass = "";
$account_payments->id->CellAttrs = array(); $account_payments->id->ViewAttrs = array(); $account_payments->id->EditAttrs = array();

// Date
$account_payments->Date->CellCssStyle = ""; $account_payments->Date->CellCssClass = "";
$account_payments->Date->CellAttrs = array(); $account_payments->Date->ViewAttrs = array(); $account_payments->Date->EditAttrs = array();

// Payment_Reference
$account_payments->Payment_Reference->CellCssStyle = ""; $account_payments->Payment_Reference->CellCssClass = "";
$account_payments->Payment_Reference->CellAttrs = array(); $account_payments->Payment_Reference->ViewAttrs = array(); $account_payments->Payment_Reference->EditAttrs = array();

// Payment_Date
$account_payments->Payment_Date->CellCssStyle = ""; $account_payments->Payment_Date->CellCssClass = "";
$account_payments->Payment_Date->CellAttrs = array(); $account_payments->Payment_Date->ViewAttrs = array(); $account_payments->Payment_Date->EditAttrs = array();

// Payment_Type
$account_payments->Payment_Type->CellCssStyle = ""; $account_payments->Payment_Type->CellCssClass = "";
$account_payments->Payment_Type->CellAttrs = array(); $account_payments->Payment_Type->ViewAttrs = array(); $account_payments->Payment_Type->EditAttrs = array();

// Journal_Type_ID
$account_payments->Journal_Type_ID->CellCssStyle = ""; $account_payments->Journal_Type_ID->CellCssClass = "";
$account_payments->Journal_Type_ID->CellAttrs = array(); $account_payments->Journal_Type_ID->ViewAttrs = array(); $account_payments->Journal_Type_ID->EditAttrs = array();

// Journal_Account_ID
$account_payments->Journal_Account_ID->CellCssStyle = ""; $account_payments->Journal_Account_ID->CellCssClass = "";
$account_payments->Journal_Account_ID->CellAttrs = array(); $account_payments->Journal_Account_ID->ViewAttrs = array(); $account_payments->Journal_Account_ID->EditAttrs = array();

// Payment_Method_ID
$account_payments->Payment_Method_ID->CellCssStyle = ""; $account_payments->Payment_Method_ID->CellCssClass = "";
$account_payments->Payment_Method_ID->CellAttrs = array(); $account_payments->Payment_Method_ID->ViewAttrs = array(); $account_payments->Payment_Method_ID->EditAttrs = array();

// Vendor_ID
$account_payments->Vendor_ID->CellCssStyle = ""; $account_payments->Vendor_ID->CellCssClass = "";
$account_payments->Vendor_ID->CellAttrs = array(); $account_payments->Vendor_ID->ViewAttrs = array(); $account_payments->Vendor_ID->EditAttrs = array();

// Client_ID
$account_payments->Client_ID->CellCssStyle = ""; $account_payments->Client_ID->CellCssClass = "";
$account_payments->Client_ID->CellAttrs = array(); $account_payments->Client_ID->ViewAttrs = array(); $account_payments->Client_ID->EditAttrs = array();

// Amount
$account_payments->Amount->CellCssStyle = ""; $account_payments->Amount->CellCssClass = "";
$account_payments->Amount->CellAttrs = array(); $account_payments->Amount->ViewAttrs = array(); $account_payments->Amount->EditAttrs = array();

// Status_ID
$account_payments->Status_ID->CellCssStyle = ""; $account_payments->Status_ID->CellCssClass = "";
$account_payments->Status_ID->CellAttrs = array(); $account_payments->Status_ID->ViewAttrs = array(); $account_payments->Status_ID->EditAttrs = array();

// User_ID
$account_payments->User_ID->CellCssStyle = ""; $account_payments->User_ID->CellCssClass = "";
$account_payments->User_ID->CellAttrs = array(); $account_payments->User_ID->ViewAttrs = array(); $account_payments->User_ID->EditAttrs = array();

// total_invoice_items
$account_payments->total_invoice_items->CellCssStyle = ""; $account_payments->total_invoice_items->CellCssClass = "";
$account_payments->total_invoice_items->CellAttrs = array(); $account_payments->total_invoice_items->ViewAttrs = array(); $account_payments->total_invoice_items->EditAttrs = array();

// Call Row_Rendered event
$account_payments->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $account_payments->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $account_payments->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Payment_Reference->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Payment_Date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Payment_Type->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Journal_Type_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Journal_Account_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Payment_Method_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Vendor_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Client_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Amount->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->Status_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->User_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $account_payments->total_invoice_items->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $account_payments->id->CellAttributes() ?>>
<div<?php echo $account_payments->id->ViewAttributes() ?>><?php echo $account_payments->id->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Date->CellAttributes() ?>>
<div<?php echo $account_payments->Date->ViewAttributes() ?>><?php echo $account_payments->Date->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Payment_Reference->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Reference->ViewAttributes() ?>><?php echo $account_payments->Payment_Reference->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Payment_Date->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Date->ViewAttributes() ?>><?php echo $account_payments->Payment_Date->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Payment_Type->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Type->ViewAttributes() ?>><?php echo $account_payments->Payment_Type->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Journal_Type_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Journal_Type_ID->ViewAttributes() ?>><?php echo $account_payments->Journal_Type_ID->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Journal_Account_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Journal_Account_ID->ViewAttributes() ?>><?php echo $account_payments->Journal_Account_ID->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Payment_Method_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Payment_Method_ID->ViewAttributes() ?>><?php echo $account_payments->Payment_Method_ID->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Vendor_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Vendor_ID->ViewAttributes() ?>><?php echo $account_payments->Vendor_ID->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Client_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Client_ID->ViewAttributes() ?>><?php echo $account_payments->Client_ID->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Amount->CellAttributes() ?>>
<div<?php echo $account_payments->Amount->ViewAttributes() ?>><?php echo $account_payments->Amount->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->Status_ID->CellAttributes() ?>>
<div<?php echo $account_payments->Status_ID->ViewAttributes() ?>><?php echo $account_payments->Status_ID->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->User_ID->CellAttributes() ?>>
<div<?php echo $account_payments->User_ID->ViewAttributes() ?>><?php echo $account_payments->User_ID->ListViewValue() ?></div></td>
			<td<?php echo $account_payments->total_invoice_items->CellAttributes() ?>>
<div<?php echo $account_payments->total_invoice_items->ViewAttributes() ?>><?php echo $account_payments->total_invoice_items->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
