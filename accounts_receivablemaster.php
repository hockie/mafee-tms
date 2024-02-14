<?php

// Call Row_Rendering event
$accounts_receivable->Row_Rendering();

// Booking_Number
$accounts_receivable->Booking_Number->CellCssStyle = ""; $accounts_receivable->Booking_Number->CellCssClass = "";
$accounts_receivable->Booking_Number->CellAttrs = array(); $accounts_receivable->Booking_Number->ViewAttrs = array(); $accounts_receivable->Booking_Number->EditAttrs = array();

// Date
$accounts_receivable->Date->CellCssStyle = ""; $accounts_receivable->Date->CellCssClass = "";
$accounts_receivable->Date->CellAttrs = array(); $accounts_receivable->Date->ViewAttrs = array(); $accounts_receivable->Date->EditAttrs = array();

// Client_ID
$accounts_receivable->Client_ID->CellCssStyle = ""; $accounts_receivable->Client_ID->CellCssClass = "";
$accounts_receivable->Client_ID->CellAttrs = array(); $accounts_receivable->Client_ID->ViewAttrs = array(); $accounts_receivable->Client_ID->EditAttrs = array();

// Origin_ID
$accounts_receivable->Origin_ID->CellCssStyle = ""; $accounts_receivable->Origin_ID->CellCssClass = "";
$accounts_receivable->Origin_ID->CellAttrs = array(); $accounts_receivable->Origin_ID->ViewAttrs = array(); $accounts_receivable->Origin_ID->EditAttrs = array();

// Destination_ID
$accounts_receivable->Destination_ID->CellCssStyle = ""; $accounts_receivable->Destination_ID->CellCssClass = "";
$accounts_receivable->Destination_ID->CellAttrs = array(); $accounts_receivable->Destination_ID->ViewAttrs = array(); $accounts_receivable->Destination_ID->EditAttrs = array();

// Customer_ID
$accounts_receivable->Customer_ID->CellCssStyle = ""; $accounts_receivable->Customer_ID->CellCssClass = "";
$accounts_receivable->Customer_ID->CellAttrs = array(); $accounts_receivable->Customer_ID->ViewAttrs = array(); $accounts_receivable->Customer_ID->EditAttrs = array();

// Subcon_ID
$accounts_receivable->Subcon_ID->CellCssStyle = ""; $accounts_receivable->Subcon_ID->CellCssClass = "";
$accounts_receivable->Subcon_ID->CellAttrs = array(); $accounts_receivable->Subcon_ID->ViewAttrs = array(); $accounts_receivable->Subcon_ID->EditAttrs = array();

// Truck_ID
$accounts_receivable->Truck_ID->CellCssStyle = ""; $accounts_receivable->Truck_ID->CellCssClass = "";
$accounts_receivable->Truck_ID->CellAttrs = array(); $accounts_receivable->Truck_ID->ViewAttrs = array(); $accounts_receivable->Truck_ID->EditAttrs = array();

// ETA
$accounts_receivable->ETA->CellCssStyle = ""; $accounts_receivable->ETA->CellCssClass = "";
$accounts_receivable->ETA->CellAttrs = array(); $accounts_receivable->ETA->ViewAttrs = array(); $accounts_receivable->ETA->EditAttrs = array();

// ETD
$accounts_receivable->ETD->CellCssStyle = ""; $accounts_receivable->ETD->CellCssClass = "";
$accounts_receivable->ETD->CellAttrs = array(); $accounts_receivable->ETD->ViewAttrs = array(); $accounts_receivable->ETD->EditAttrs = array();

// Status_ID
$accounts_receivable->Status_ID->CellCssStyle = ""; $accounts_receivable->Status_ID->CellCssClass = "";
$accounts_receivable->Status_ID->CellAttrs = array(); $accounts_receivable->Status_ID->ViewAttrs = array(); $accounts_receivable->Status_ID->EditAttrs = array();

// Vat
$accounts_receivable->Vat->CellCssStyle = ""; $accounts_receivable->Vat->CellCssClass = "";
$accounts_receivable->Vat->CellAttrs = array(); $accounts_receivable->Vat->ViewAttrs = array(); $accounts_receivable->Vat->EditAttrs = array();

// Total_Sales
$accounts_receivable->Total_Sales->CellCssStyle = ""; $accounts_receivable->Total_Sales->CellCssClass = "";
$accounts_receivable->Total_Sales->CellAttrs = array(); $accounts_receivable->Total_Sales->ViewAttrs = array(); $accounts_receivable->Total_Sales->EditAttrs = array();

// Wtax
$accounts_receivable->Wtax->CellCssStyle = ""; $accounts_receivable->Wtax->CellCssClass = "";
$accounts_receivable->Wtax->CellAttrs = array(); $accounts_receivable->Wtax->ViewAttrs = array(); $accounts_receivable->Wtax->EditAttrs = array();

// Total_Amount_Due
$accounts_receivable->Total_Amount_Due->CellCssStyle = ""; $accounts_receivable->Total_Amount_Due->CellCssClass = "";
$accounts_receivable->Total_Amount_Due->CellAttrs = array(); $accounts_receivable->Total_Amount_Due->ViewAttrs = array(); $accounts_receivable->Total_Amount_Due->EditAttrs = array();

// id
$accounts_receivable->id->CellCssStyle = ""; $accounts_receivable->id->CellCssClass = "";
$accounts_receivable->id->CellAttrs = array(); $accounts_receivable->id->ViewAttrs = array(); $accounts_receivable->id->EditAttrs = array();

// Call Row_Rendered event
$accounts_receivable->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $accounts_receivable->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Booking_Number->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Client_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Origin_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Destination_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Customer_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Subcon_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Truck_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->ETA->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->ETD->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Status_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Vat->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Total_Sales->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Wtax->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->Total_Amount_Due->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $accounts_receivable->id->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $accounts_receivable->Booking_Number->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Booking_Number->ViewAttributes() ?>>
<?php if ($accounts_receivable->Booking_Number->HrefValue <> "" || $accounts_receivable->Booking_Number->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_Booking_Number=<?php echo $accounts_receivable->Booking_Number->HrefValue ?>"><?php echo $accounts_receivable->Booking_Number->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $accounts_receivable->Booking_Number->ListViewValue() ?>
<?php } ?>
</div></td>
			<td<?php echo $accounts_receivable->Date->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Date->ViewAttributes() ?>><?php echo $accounts_receivable->Date->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Client_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Client_ID->ViewAttributes() ?>>
<?php if ($accounts_receivable->Client_ID->HrefValue <> "" || $accounts_receivable->Client_ID->TooltipValue <> "") { ?>
<a href="./clientsview.php?id=<?php echo $accounts_receivable->Client_ID->HrefValue ?>"><?php echo $accounts_receivable->Client_ID->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $accounts_receivable->Client_ID->ListViewValue() ?>
<?php } ?>
</div></td>
			<td<?php echo $accounts_receivable->Origin_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Origin_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Origin_ID->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Destination_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Destination_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Destination_ID->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Customer_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Customer_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Customer_ID->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Subcon_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Subcon_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Subcon_ID->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Truck_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Truck_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Truck_ID->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->ETA->CellAttributes() ?>>
<div<?php echo $accounts_receivable->ETA->ViewAttributes() ?>><?php echo $accounts_receivable->ETA->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->ETD->CellAttributes() ?>>
<div<?php echo $accounts_receivable->ETD->ViewAttributes() ?>><?php echo $accounts_receivable->ETD->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Status_ID->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Status_ID->ViewAttributes() ?>><?php echo $accounts_receivable->Status_ID->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Vat->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Vat->ViewAttributes() ?>><?php echo $accounts_receivable->Vat->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Total_Sales->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Total_Sales->ViewAttributes() ?>><?php echo $accounts_receivable->Total_Sales->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Wtax->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Wtax->ViewAttributes() ?>><?php echo $accounts_receivable->Wtax->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->Total_Amount_Due->CellAttributes() ?>>
<div<?php echo $accounts_receivable->Total_Amount_Due->ViewAttributes() ?>><?php echo $accounts_receivable->Total_Amount_Due->ListViewValue() ?></div></td>
			<td<?php echo $accounts_receivable->id->CellAttributes() ?>>
<div<?php echo $accounts_receivable->id->ViewAttributes() ?>>
<?php if ($accounts_receivable->id->HrefValue <> "" || $accounts_receivable->id->TooltipValue <> "") { ?>
<a href="./bookingsbilling.php?id=<?php echo $accounts_receivable->id->HrefValue ?>"><?php echo $accounts_receivable->id->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $accounts_receivable->id->ListViewValue() ?>
<?php } ?>
</div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
