<?php

// Call Row_Rendering event
$invoices->Row_Rendering();

// id
$invoices->id->CellCssStyle = ""; $invoices->id->CellCssClass = "";
$invoices->id->CellAttrs = array(); $invoices->id->ViewAttrs = array(); $invoices->id->EditAttrs = array();

// Invoice_Number
$invoices->Invoice_Number->CellCssStyle = ""; $invoices->Invoice_Number->CellCssClass = "";
$invoices->Invoice_Number->CellAttrs = array(); $invoices->Invoice_Number->ViewAttrs = array(); $invoices->Invoice_Number->EditAttrs = array();

// Client_ID
$invoices->Client_ID->CellCssStyle = ""; $invoices->Client_ID->CellCssClass = "";
$invoices->Client_ID->CellAttrs = array(); $invoices->Client_ID->ViewAttrs = array(); $invoices->Client_ID->EditAttrs = array();

// Invoice_Date
$invoices->Invoice_Date->CellCssStyle = ""; $invoices->Invoice_Date->CellCssClass = "";
$invoices->Invoice_Date->CellAttrs = array(); $invoices->Invoice_Date->ViewAttrs = array(); $invoices->Invoice_Date->EditAttrs = array();

// Due_Date
$invoices->Due_Date->CellCssStyle = ""; $invoices->Due_Date->CellCssClass = "";
$invoices->Due_Date->CellAttrs = array(); $invoices->Due_Date->ViewAttrs = array(); $invoices->Due_Date->EditAttrs = array();

// payment_period
$invoices->payment_period->CellCssStyle = ""; $invoices->payment_period->CellCssClass = "";
$invoices->payment_period->CellAttrs = array(); $invoices->payment_period->ViewAttrs = array(); $invoices->payment_period->EditAttrs = array();

// Total_Vat
$invoices->Total_Vat->CellCssStyle = ""; $invoices->Total_Vat->CellCssClass = "";
$invoices->Total_Vat->CellAttrs = array(); $invoices->Total_Vat->ViewAttrs = array(); $invoices->Total_Vat->EditAttrs = array();

// Total_WTax
$invoices->Total_WTax->CellCssStyle = ""; $invoices->Total_WTax->CellCssClass = "";
$invoices->Total_WTax->CellAttrs = array(); $invoices->Total_WTax->ViewAttrs = array(); $invoices->Total_WTax->EditAttrs = array();

// Total_Freight
$invoices->Total_Freight->CellCssStyle = ""; $invoices->Total_Freight->CellCssClass = "";
$invoices->Total_Freight->CellAttrs = array(); $invoices->Total_Freight->ViewAttrs = array(); $invoices->Total_Freight->EditAttrs = array();

// Total_Amount_Due
$invoices->Total_Amount_Due->CellCssStyle = ""; $invoices->Total_Amount_Due->CellCssClass = "";
$invoices->Total_Amount_Due->CellAttrs = array(); $invoices->Total_Amount_Due->ViewAttrs = array(); $invoices->Total_Amount_Due->EditAttrs = array();

// Payment_Reference
$invoices->Payment_Reference->CellCssStyle = ""; $invoices->Payment_Reference->CellCssClass = "";
$invoices->Payment_Reference->CellAttrs = array(); $invoices->Payment_Reference->ViewAttrs = array(); $invoices->Payment_Reference->EditAttrs = array();

// Payment_Status
$invoices->Payment_Status->CellCssStyle = ""; $invoices->Payment_Status->CellCssClass = "";
$invoices->Payment_Status->CellAttrs = array(); $invoices->Payment_Status->ViewAttrs = array(); $invoices->Payment_Status->EditAttrs = array();

// Status
$invoices->Status->CellCssStyle = ""; $invoices->Status->CellCssClass = "";
$invoices->Status->CellAttrs = array(); $invoices->Status->ViewAttrs = array(); $invoices->Status->EditAttrs = array();

// Recipient_Bank
$invoices->Recipient_Bank->CellCssStyle = ""; $invoices->Recipient_Bank->CellCssClass = "";
$invoices->Recipient_Bank->CellAttrs = array(); $invoices->Recipient_Bank->ViewAttrs = array(); $invoices->Recipient_Bank->EditAttrs = array();

// Remarks
$invoices->Remarks->CellCssStyle = ""; $invoices->Remarks->CellCssClass = "";
$invoices->Remarks->CellAttrs = array(); $invoices->Remarks->ViewAttrs = array(); $invoices->Remarks->EditAttrs = array();

// User_ID
$invoices->User_ID->CellCssStyle = ""; $invoices->User_ID->CellCssClass = "";
$invoices->User_ID->CellAttrs = array(); $invoices->User_ID->ViewAttrs = array(); $invoices->User_ID->EditAttrs = array();

// created
$invoices->created->CellCssStyle = ""; $invoices->created->CellCssClass = "";
$invoices->created->CellAttrs = array(); $invoices->created->ViewAttrs = array(); $invoices->created->EditAttrs = array();

// modified
$invoices->modified->CellCssStyle = ""; $invoices->modified->CellCssClass = "";
$invoices->modified->CellAttrs = array(); $invoices->modified->ViewAttrs = array(); $invoices->modified->EditAttrs = array();

// Call Row_Rendered event
$invoices->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $invoices->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $invoices->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Invoice_Number->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Client_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Invoice_Date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Due_Date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->payment_period->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Total_Vat->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Total_WTax->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Total_Freight->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Total_Amount_Due->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Payment_Reference->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Payment_Status->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Status->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Recipient_Bank->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->Remarks->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->User_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->created->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoices->modified->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $invoices->id->CellAttributes() ?>>
<div<?php echo $invoices->id->ViewAttributes() ?>><?php echo $invoices->id->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Invoice_Number->CellAttributes() ?>>
<div<?php echo $invoices->Invoice_Number->ViewAttributes() ?>><?php echo $invoices->Invoice_Number->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Client_ID->CellAttributes() ?>>
<div<?php echo $invoices->Client_ID->ViewAttributes() ?>><?php echo $invoices->Client_ID->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Invoice_Date->CellAttributes() ?>>
<div<?php echo $invoices->Invoice_Date->ViewAttributes() ?>><?php echo $invoices->Invoice_Date->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Due_Date->CellAttributes() ?>>
<div<?php echo $invoices->Due_Date->ViewAttributes() ?>><?php echo $invoices->Due_Date->ListViewValue() ?></div></td>
			<td<?php echo $invoices->payment_period->CellAttributes() ?>>
<div<?php echo $invoices->payment_period->ViewAttributes() ?>><?php echo $invoices->payment_period->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Total_Vat->CellAttributes() ?>>
<div<?php echo $invoices->Total_Vat->ViewAttributes() ?>><?php echo $invoices->Total_Vat->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Total_WTax->CellAttributes() ?>>
<div<?php echo $invoices->Total_WTax->ViewAttributes() ?>><?php echo $invoices->Total_WTax->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Total_Freight->CellAttributes() ?>>
<div<?php echo $invoices->Total_Freight->ViewAttributes() ?>><?php echo $invoices->Total_Freight->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $invoices->Total_Amount_Due->ViewAttributes() ?>><?php echo $invoices->Total_Amount_Due->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Payment_Reference->CellAttributes() ?>>
<div<?php echo $invoices->Payment_Reference->ViewAttributes() ?>><?php echo $invoices->Payment_Reference->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Payment_Status->CellAttributes() ?>>
<div<?php echo $invoices->Payment_Status->ViewAttributes() ?>><?php echo $invoices->Payment_Status->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Status->CellAttributes() ?>>
<div<?php echo $invoices->Status->ViewAttributes() ?>><?php echo $invoices->Status->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Recipient_Bank->CellAttributes() ?>>
<div<?php echo $invoices->Recipient_Bank->ViewAttributes() ?>><?php echo $invoices->Recipient_Bank->ListViewValue() ?></div></td>
			<td<?php echo $invoices->Remarks->CellAttributes() ?>>
<div<?php echo $invoices->Remarks->ViewAttributes() ?>><?php echo $invoices->Remarks->ListViewValue() ?></div></td>
			<td<?php echo $invoices->User_ID->CellAttributes() ?>>
<div<?php echo $invoices->User_ID->ViewAttributes() ?>><?php echo $invoices->User_ID->ListViewValue() ?></div></td>
			<td<?php echo $invoices->created->CellAttributes() ?>>
<div<?php echo $invoices->created->ViewAttributes() ?>><?php echo $invoices->created->ListViewValue() ?></div></td>
			<td<?php echo $invoices->modified->CellAttributes() ?>>
<div<?php echo $invoices->modified->ViewAttributes() ?>><?php echo $invoices->modified->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
