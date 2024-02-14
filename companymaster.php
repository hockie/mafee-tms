<?php

// Call Row_Rendering event
$company->Row_Rendering();

// id
$company->id->CellCssStyle = ""; $company->id->CellCssClass = "";
$company->id->CellAttrs = array(); $company->id->ViewAttrs = array(); $company->id->EditAttrs = array();

// Company_Name
$company->Company_Name->CellCssStyle = ""; $company->Company_Name->CellCssClass = "";
$company->Company_Name->CellAttrs = array(); $company->Company_Name->ViewAttrs = array(); $company->Company_Name->EditAttrs = array();

// Contact_No
$company->Contact_No->CellCssStyle = ""; $company->Contact_No->CellCssClass = "";
$company->Contact_No->CellAttrs = array(); $company->Contact_No->ViewAttrs = array(); $company->Contact_No->EditAttrs = array();

// Email_Address
$company->Email_Address->CellCssStyle = ""; $company->Email_Address->CellCssClass = "";
$company->Email_Address->CellAttrs = array(); $company->Email_Address->ViewAttrs = array(); $company->Email_Address->EditAttrs = array();

// Website
$company->Website->CellCssStyle = ""; $company->Website->CellCssClass = "";
$company->Website->CellAttrs = array(); $company->Website->ViewAttrs = array(); $company->Website->EditAttrs = array();

// TIN_No
$company->TIN_No->CellCssStyle = ""; $company->TIN_No->CellCssClass = "";
$company->TIN_No->CellAttrs = array(); $company->TIN_No->ViewAttrs = array(); $company->TIN_No->EditAttrs = array();

// File_Upload
$company->File_Upload->CellCssStyle = ""; $company->File_Upload->CellCssClass = "";
$company->File_Upload->CellAttrs = array(); $company->File_Upload->ViewAttrs = array(); $company->File_Upload->EditAttrs = array();

// Remarks
$company->Remarks->CellCssStyle = ""; $company->Remarks->CellCssClass = "";
$company->Remarks->CellAttrs = array(); $company->Remarks->ViewAttrs = array(); $company->Remarks->EditAttrs = array();

// Call Row_Rendered event
$company->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $company->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $company->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $company->Company_Name->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $company->Contact_No->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $company->Email_Address->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $company->Website->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $company->TIN_No->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $company->File_Upload->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $company->Remarks->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $company->id->CellAttributes() ?>>
<div<?php echo $company->id->ViewAttributes() ?>><?php echo $company->id->ListViewValue() ?></div></td>
			<td<?php echo $company->Company_Name->CellAttributes() ?>>
<div<?php echo $company->Company_Name->ViewAttributes() ?>><?php echo $company->Company_Name->ListViewValue() ?></div></td>
			<td<?php echo $company->Contact_No->CellAttributes() ?>>
<div<?php echo $company->Contact_No->ViewAttributes() ?>><?php echo $company->Contact_No->ListViewValue() ?></div></td>
			<td<?php echo $company->Email_Address->CellAttributes() ?>>
<div<?php echo $company->Email_Address->ViewAttributes() ?>><?php echo $company->Email_Address->ListViewValue() ?></div></td>
			<td<?php echo $company->Website->CellAttributes() ?>>
<div<?php echo $company->Website->ViewAttributes() ?>><?php echo $company->Website->ListViewValue() ?></div></td>
			<td<?php echo $company->TIN_No->CellAttributes() ?>>
<div<?php echo $company->TIN_No->ViewAttributes() ?>><?php echo $company->TIN_No->ListViewValue() ?></div></td>
			<td<?php echo $company->File_Upload->CellAttributes() ?>>
<?php if ($company->File_Upload->HrefValue <> "" || $company->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($company->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $company->File_Upload->HrefValue ?>"><?php echo $company->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($company->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($company->File_Upload->Upload->DbValue)) { ?>
<?php echo $company->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($company->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
			<td<?php echo $company->Remarks->CellAttributes() ?>>
<div<?php echo $company->Remarks->ViewAttributes() ?>><?php echo $company->Remarks->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
