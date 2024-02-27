<?php

// Call Row_Rendering event
$trucks->Row_Rendering();

// id
$trucks->id->CellCssStyle = ""; $trucks->id->CellCssClass = "";
$trucks->id->CellAttrs = array(); $trucks->id->ViewAttrs = array(); $trucks->id->EditAttrs = array();

// Sub_Con_ID
$trucks->Sub_Con_ID->CellCssStyle = ""; $trucks->Sub_Con_ID->CellCssClass = "";
$trucks->Sub_Con_ID->CellAttrs = array(); $trucks->Sub_Con_ID->ViewAttrs = array(); $trucks->Sub_Con_ID->EditAttrs = array();

// Model
$trucks->Model->CellCssStyle = ""; $trucks->Model->CellCssClass = "";
$trucks->Model->CellAttrs = array(); $trucks->Model->ViewAttrs = array(); $trucks->Model->EditAttrs = array();

// Brand
$trucks->Brand->CellCssStyle = ""; $trucks->Brand->CellCssClass = "";
$trucks->Brand->CellAttrs = array(); $trucks->Brand->ViewAttrs = array(); $trucks->Brand->EditAttrs = array();

// Truck_Types_ID
$trucks->Truck_Types_ID->CellCssStyle = ""; $trucks->Truck_Types_ID->CellCssClass = "";
$trucks->Truck_Types_ID->CellAttrs = array(); $trucks->Truck_Types_ID->ViewAttrs = array(); $trucks->Truck_Types_ID->EditAttrs = array();

// Plate_Number
$trucks->Plate_Number->CellCssStyle = ""; $trucks->Plate_Number->CellCssClass = "";
$trucks->Plate_Number->CellAttrs = array(); $trucks->Plate_Number->ViewAttrs = array(); $trucks->Plate_Number->EditAttrs = array();

// Series
$trucks->Series->CellCssStyle = ""; $trucks->Series->CellCssClass = "";
$trucks->Series->CellAttrs = array(); $trucks->Series->ViewAttrs = array(); $trucks->Series->EditAttrs = array();

// Truck_Body_Type
$trucks->Truck_Body_Type->CellCssStyle = ""; $trucks->Truck_Body_Type->CellCssClass = "";
$trucks->Truck_Body_Type->CellAttrs = array(); $trucks->Truck_Body_Type->ViewAttrs = array(); $trucks->Truck_Body_Type->EditAttrs = array();

// Gross_Weight
$trucks->Gross_Weight->CellCssStyle = ""; $trucks->Gross_Weight->CellCssClass = "";
$trucks->Gross_Weight->CellAttrs = array(); $trucks->Gross_Weight->ViewAttrs = array(); $trucks->Gross_Weight->EditAttrs = array();

// Net_Capacity
$trucks->Net_Capacity->CellCssStyle = ""; $trucks->Net_Capacity->CellCssClass = "";
$trucks->Net_Capacity->CellAttrs = array(); $trucks->Net_Capacity->ViewAttrs = array(); $trucks->Net_Capacity->EditAttrs = array();

// Inland_Marine_Insurance
$trucks->Inland_Marine_Insurance->CellCssStyle = ""; $trucks->Inland_Marine_Insurance->CellCssClass = "";
$trucks->Inland_Marine_Insurance->CellAttrs = array(); $trucks->Inland_Marine_Insurance->ViewAttrs = array(); $trucks->Inland_Marine_Insurance->EditAttrs = array();

// Expiration_Date
$trucks->Expiration_Date->CellCssStyle = ""; $trucks->Expiration_Date->CellCssClass = "";
$trucks->Expiration_Date->CellAttrs = array(); $trucks->Expiration_Date->ViewAttrs = array(); $trucks->Expiration_Date->EditAttrs = array();

// LTFRB_Case_No
$trucks->LTFRB_Case_No->CellCssStyle = ""; $trucks->LTFRB_Case_No->CellCssClass = "";
$trucks->LTFRB_Case_No->CellAttrs = array(); $trucks->LTFRB_Case_No->ViewAttrs = array(); $trucks->LTFRB_Case_No->EditAttrs = array();

// LTFRB_Expiration
$trucks->LTFRB_Expiration->CellCssStyle = ""; $trucks->LTFRB_Expiration->CellCssClass = "";
$trucks->LTFRB_Expiration->CellAttrs = array(); $trucks->LTFRB_Expiration->ViewAttrs = array(); $trucks->LTFRB_Expiration->EditAttrs = array();

// File_Upload
$trucks->File_Upload->CellCssStyle = ""; $trucks->File_Upload->CellCssClass = "";
$trucks->File_Upload->CellAttrs = array(); $trucks->File_Upload->ViewAttrs = array(); $trucks->File_Upload->EditAttrs = array();

// Remarks
$trucks->Remarks->CellCssStyle = ""; $trucks->Remarks->CellCssClass = "";
$trucks->Remarks->CellAttrs = array(); $trucks->Remarks->ViewAttrs = array(); $trucks->Remarks->EditAttrs = array();

// Call Row_Rendered event
$trucks->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $trucks->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $trucks->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Sub_Con_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Model->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Brand->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Truck_Types_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Plate_Number->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Series->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Truck_Body_Type->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Gross_Weight->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Net_Capacity->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Inland_Marine_Insurance->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Expiration_Date->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->LTFRB_Case_No->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->LTFRB_Expiration->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->File_Upload->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $trucks->Remarks->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $trucks->id->CellAttributes() ?>>
<div<?php echo $trucks->id->ViewAttributes() ?>><?php echo $trucks->id->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Sub_Con_ID->CellAttributes() ?>>
<div<?php echo $trucks->Sub_Con_ID->ViewAttributes() ?>><?php echo $trucks->Sub_Con_ID->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Model->CellAttributes() ?>>
<div<?php echo $trucks->Model->ViewAttributes() ?>><?php echo $trucks->Model->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Brand->CellAttributes() ?>>
<div<?php echo $trucks->Brand->ViewAttributes() ?>><?php echo $trucks->Brand->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Truck_Types_ID->CellAttributes() ?>>
<div<?php echo $trucks->Truck_Types_ID->ViewAttributes() ?>><?php echo $trucks->Truck_Types_ID->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Plate_Number->CellAttributes() ?>>
<div<?php echo $trucks->Plate_Number->ViewAttributes() ?>><?php echo $trucks->Plate_Number->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Series->CellAttributes() ?>>
<div<?php echo $trucks->Series->ViewAttributes() ?>><?php echo $trucks->Series->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Truck_Body_Type->CellAttributes() ?>>
<div<?php echo $trucks->Truck_Body_Type->ViewAttributes() ?>><?php echo $trucks->Truck_Body_Type->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Gross_Weight->CellAttributes() ?>>
<div<?php echo $trucks->Gross_Weight->ViewAttributes() ?>><?php echo $trucks->Gross_Weight->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Net_Capacity->CellAttributes() ?>>
<div<?php echo $trucks->Net_Capacity->ViewAttributes() ?>><?php echo $trucks->Net_Capacity->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Inland_Marine_Insurance->CellAttributes() ?>>
<div<?php echo $trucks->Inland_Marine_Insurance->ViewAttributes() ?>><?php echo $trucks->Inland_Marine_Insurance->ListViewValue() ?></div></td>
			<td<?php echo $trucks->Expiration_Date->CellAttributes() ?>>
<div<?php echo $trucks->Expiration_Date->ViewAttributes() ?>><?php echo $trucks->Expiration_Date->ListViewValue() ?></div></td>
			<td<?php echo $trucks->LTFRB_Case_No->CellAttributes() ?>>
<div<?php echo $trucks->LTFRB_Case_No->ViewAttributes() ?>><?php echo $trucks->LTFRB_Case_No->ListViewValue() ?></div></td>
			<td<?php echo $trucks->LTFRB_Expiration->CellAttributes() ?>>
<div<?php echo $trucks->LTFRB_Expiration->ViewAttributes() ?>><?php echo $trucks->LTFRB_Expiration->ListViewValue() ?></div></td>
			<td<?php echo $trucks->File_Upload->CellAttributes() ?>>
<?php if ($trucks->File_Upload->HrefValue <> "" || $trucks->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $trucks->File_Upload->HrefValue ?>"><?php echo $trucks->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($trucks->File_Upload->Upload->DbValue)) { ?>
<?php echo $trucks->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($trucks->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
			<td<?php echo $trucks->Remarks->CellAttributes() ?>>
<div<?php echo $trucks->Remarks->ViewAttributes() ?>><?php echo $trucks->Remarks->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
