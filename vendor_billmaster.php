<?php

// Call Row_Rendering event
$vendor_bill->Row_Rendering();

// id
$vendor_bill->id->CellCssStyle = ""; $vendor_bill->id->CellCssClass = "";
$vendor_bill->id->CellAttrs = array(); $vendor_bill->id->ViewAttrs = array(); $vendor_bill->id->EditAttrs = array();

// vendor_ID
$vendor_bill->vendor_ID->CellCssStyle = ""; $vendor_bill->vendor_ID->CellCssClass = "";
$vendor_bill->vendor_ID->CellAttrs = array(); $vendor_bill->vendor_ID->ViewAttrs = array(); $vendor_bill->vendor_ID->EditAttrs = array();

// vendor_Number
$vendor_bill->vendor_Number->CellCssStyle = ""; $vendor_bill->vendor_Number->CellCssClass = "";
$vendor_bill->vendor_Number->CellAttrs = array(); $vendor_bill->vendor_Number->ViewAttrs = array(); $vendor_bill->vendor_Number->EditAttrs = array();

// Billing_Date
$vendor_bill->Billing_Date->CellCssStyle = ""; $vendor_bill->Billing_Date->CellCssClass = "";
$vendor_bill->Billing_Date->CellAttrs = array(); $vendor_bill->Billing_Date->ViewAttrs = array(); $vendor_bill->Billing_Date->EditAttrs = array();

// Due_Date
$vendor_bill->Due_Date->CellCssStyle = ""; $vendor_bill->Due_Date->CellCssClass = "";
$vendor_bill->Due_Date->CellAttrs = array(); $vendor_bill->Due_Date->ViewAttrs = array(); $vendor_bill->Due_Date->EditAttrs = array();

// Total_Amount_Due
$vendor_bill->Total_Amount_Due->CellCssStyle = ""; $vendor_bill->Total_Amount_Due->CellCssClass = "";
$vendor_bill->Total_Amount_Due->CellAttrs = array(); $vendor_bill->Total_Amount_Due->ViewAttrs = array(); $vendor_bill->Total_Amount_Due->EditAttrs = array();

// Bill_Reference
$vendor_bill->Bill_Reference->CellCssStyle = ""; $vendor_bill->Bill_Reference->CellCssClass = "";
$vendor_bill->Bill_Reference->CellAttrs = array(); $vendor_bill->Bill_Reference->ViewAttrs = array(); $vendor_bill->Bill_Reference->EditAttrs = array();

// payment_method_id
$vendor_bill->payment_method_id->CellCssStyle = ""; $vendor_bill->payment_method_id->CellCssClass = "";
$vendor_bill->payment_method_id->CellAttrs = array(); $vendor_bill->payment_method_id->ViewAttrs = array(); $vendor_bill->payment_method_id->EditAttrs = array();

// Payment_Status
$vendor_bill->Payment_Status->CellCssStyle = ""; $vendor_bill->Payment_Status->CellCssClass = "";
$vendor_bill->Payment_Status->CellAttrs = array(); $vendor_bill->Payment_Status->ViewAttrs = array(); $vendor_bill->Payment_Status->EditAttrs = array();

// Status
$vendor_bill->Status->CellCssStyle = ""; $vendor_bill->Status->CellCssClass = "";
$vendor_bill->Status->CellAttrs = array(); $vendor_bill->Status->ViewAttrs = array(); $vendor_bill->Status->EditAttrs = array();

// Remarks
$vendor_bill->Remarks->CellCssStyle = ""; $vendor_bill->Remarks->CellCssClass = "";
$vendor_bill->Remarks->CellAttrs = array(); $vendor_bill->Remarks->ViewAttrs = array(); $vendor_bill->Remarks->EditAttrs = array();

// User_ID
$vendor_bill->User_ID->CellCssStyle = ""; $vendor_bill->User_ID->CellCssClass = "";
$vendor_bill->User_ID->CellAttrs = array(); $vendor_bill->User_ID->ViewAttrs = array(); $vendor_bill->User_ID->EditAttrs = array();

// created
$vendor_bill->created->CellCssStyle = ""; $vendor_bill->created->CellCssClass = "";
$vendor_bill->created->CellAttrs = array(); $vendor_bill->created->ViewAttrs = array(); $vendor_bill->created->EditAttrs = array();

// modified
$vendor_bill->modified->CellCssStyle = ""; $vendor_bill->modified->CellCssClass = "";
$vendor_bill->modified->CellAttrs = array(); $vendor_bill->modified->ViewAttrs = array(); $vendor_bill->modified->EditAttrs = array();

// Call Row_Rendered event
$vendor_bill->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $vendor_bill->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $vendor_bill->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->vendor_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->vendor_Number->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->Billing_Date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->Due_Date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->Total_Amount_Due->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->Bill_Reference->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->payment_method_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->Payment_Status->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->Status->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->Remarks->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->User_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->created->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $vendor_bill->modified->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $vendor_bill->id->CellAttributes() ?>>
<div<?php echo $vendor_bill->id->ViewAttributes() ?>><?php echo $vendor_bill->id->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->vendor_ID->CellAttributes() ?>>
<div<?php echo $vendor_bill->vendor_ID->ViewAttributes() ?>><?php echo $vendor_bill->vendor_ID->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->vendor_Number->CellAttributes() ?>>
<div<?php echo $vendor_bill->vendor_Number->ViewAttributes() ?>><?php echo $vendor_bill->vendor_Number->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->Billing_Date->CellAttributes() ?>>
<div<?php echo $vendor_bill->Billing_Date->ViewAttributes() ?>><?php echo $vendor_bill->Billing_Date->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->Due_Date->CellAttributes() ?>>
<div<?php echo $vendor_bill->Due_Date->ViewAttributes() ?>><?php echo $vendor_bill->Due_Date->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $vendor_bill->Total_Amount_Due->ViewAttributes() ?>><?php echo $vendor_bill->Total_Amount_Due->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->Bill_Reference->CellAttributes() ?>>
<div<?php echo $vendor_bill->Bill_Reference->ViewAttributes() ?>><?php echo $vendor_bill->Bill_Reference->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->payment_method_id->CellAttributes() ?>>
<div<?php echo $vendor_bill->payment_method_id->ViewAttributes() ?>><?php echo $vendor_bill->payment_method_id->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->Payment_Status->CellAttributes() ?>>
<div<?php echo $vendor_bill->Payment_Status->ViewAttributes() ?>><?php echo $vendor_bill->Payment_Status->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->Status->CellAttributes() ?>>
<div<?php echo $vendor_bill->Status->ViewAttributes() ?>><?php echo $vendor_bill->Status->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->Remarks->CellAttributes() ?>>
<div<?php echo $vendor_bill->Remarks->ViewAttributes() ?>><?php echo $vendor_bill->Remarks->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->User_ID->CellAttributes() ?>>
<div<?php echo $vendor_bill->User_ID->ViewAttributes() ?>><?php echo $vendor_bill->User_ID->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->created->CellAttributes() ?>>
<div<?php echo $vendor_bill->created->ViewAttributes() ?>><?php echo $vendor_bill->created->ListViewValue() ?></div></td>
			<td<?php echo $vendor_bill->modified->CellAttributes() ?>>
<div<?php echo $vendor_bill->modified->ViewAttributes() ?>><?php echo $vendor_bill->modified->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
