<?php

// Call Row_Rendering event
$subcons->Row_Rendering();

// id
$subcons->id->CellCssStyle = ""; $subcons->id->CellCssClass = "";
$subcons->id->CellAttrs = array(); $subcons->id->ViewAttrs = array(); $subcons->id->EditAttrs = array();

// Subcon_ID
$subcons->Subcon_ID->CellCssStyle = ""; $subcons->Subcon_ID->CellCssClass = "";
$subcons->Subcon_ID->CellAttrs = array(); $subcons->Subcon_ID->ViewAttrs = array(); $subcons->Subcon_ID->EditAttrs = array();

// Subcon_Name
$subcons->Subcon_Name->CellCssStyle = ""; $subcons->Subcon_Name->CellCssClass = "";
$subcons->Subcon_Name->CellAttrs = array(); $subcons->Subcon_Name->ViewAttrs = array(); $subcons->Subcon_Name->EditAttrs = array();

// Address
$subcons->Address->CellCssStyle = ""; $subcons->Address->CellCssClass = "";
$subcons->Address->CellAttrs = array(); $subcons->Address->ViewAttrs = array(); $subcons->Address->EditAttrs = array();

// ContactNo
$subcons->ContactNo->CellCssStyle = ""; $subcons->ContactNo->CellCssClass = "";
$subcons->ContactNo->CellAttrs = array(); $subcons->ContactNo->ViewAttrs = array(); $subcons->ContactNo->EditAttrs = array();

// Email_Address
$subcons->Email_Address->CellCssStyle = ""; $subcons->Email_Address->CellCssClass = "";
$subcons->Email_Address->CellAttrs = array(); $subcons->Email_Address->ViewAttrs = array(); $subcons->Email_Address->EditAttrs = array();

// TIN_No
$subcons->TIN_No->CellCssStyle = ""; $subcons->TIN_No->CellCssClass = "";
$subcons->TIN_No->CellAttrs = array(); $subcons->TIN_No->ViewAttrs = array(); $subcons->TIN_No->EditAttrs = array();

// ContactPerson
$subcons->ContactPerson->CellCssStyle = ""; $subcons->ContactPerson->CellCssClass = "";
$subcons->ContactPerson->CellAttrs = array(); $subcons->ContactPerson->ViewAttrs = array(); $subcons->ContactPerson->EditAttrs = array();

// File_Upload
$subcons->File_Upload->CellCssStyle = ""; $subcons->File_Upload->CellCssClass = "";
$subcons->File_Upload->CellAttrs = array(); $subcons->File_Upload->ViewAttrs = array(); $subcons->File_Upload->EditAttrs = array();

// Remarks
$subcons->Remarks->CellCssStyle = ""; $subcons->Remarks->CellCssClass = "";
$subcons->Remarks->CellAttrs = array(); $subcons->Remarks->ViewAttrs = array(); $subcons->Remarks->EditAttrs = array();

// Call Row_Rendered event
$subcons->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $subcons->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $subcons->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->Subcon_ID->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->Subcon_Name->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->Address->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->ContactNo->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->Email_Address->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->TIN_No->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->ContactPerson->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->File_Upload->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $subcons->Remarks->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $subcons->id->CellAttributes() ?>>
<div<?php echo $subcons->id->ViewAttributes() ?>><?php echo $subcons->id->ListViewValue() ?></div></td>
			<td<?php echo $subcons->Subcon_ID->CellAttributes() ?>>
<div<?php echo $subcons->Subcon_ID->ViewAttributes() ?>><?php echo $subcons->Subcon_ID->ListViewValue() ?></div></td>
			<td<?php echo $subcons->Subcon_Name->CellAttributes() ?>>
<div<?php echo $subcons->Subcon_Name->ViewAttributes() ?>><?php echo $subcons->Subcon_Name->ListViewValue() ?></div></td>
			<td<?php echo $subcons->Address->CellAttributes() ?>>
<div<?php echo $subcons->Address->ViewAttributes() ?>><?php echo $subcons->Address->ListViewValue() ?></div></td>
			<td<?php echo $subcons->ContactNo->CellAttributes() ?>>
<div<?php echo $subcons->ContactNo->ViewAttributes() ?>><?php echo $subcons->ContactNo->ListViewValue() ?></div></td>
			<td<?php echo $subcons->Email_Address->CellAttributes() ?>>
<div<?php echo $subcons->Email_Address->ViewAttributes() ?>><?php echo $subcons->Email_Address->ListViewValue() ?></div></td>
			<td<?php echo $subcons->TIN_No->CellAttributes() ?>>
<div<?php echo $subcons->TIN_No->ViewAttributes() ?>><?php echo $subcons->TIN_No->ListViewValue() ?></div></td>
			<td<?php echo $subcons->ContactPerson->CellAttributes() ?>>
<div<?php echo $subcons->ContactPerson->ViewAttributes() ?>><?php echo $subcons->ContactPerson->ListViewValue() ?></div></td>
			<td<?php echo $subcons->File_Upload->CellAttributes() ?>>
<?php if ($subcons->File_Upload->HrefValue <> "" || $subcons->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $subcons->File_Upload->HrefValue ?>"><?php echo $subcons->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($subcons->File_Upload->Upload->DbValue)) { ?>
<?php echo $subcons->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($subcons->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
			<td<?php echo $subcons->Remarks->CellAttributes() ?>>
<div<?php echo $subcons->Remarks->ViewAttributes() ?>><?php echo $subcons->Remarks->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
