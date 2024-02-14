<?php

// Call Row_Rendering event
$clients->Row_Rendering();

// id
$clients->id->CellCssStyle = ""; $clients->id->CellCssClass = "";
$clients->id->CellAttrs = array(); $clients->id->ViewAttrs = array(); $clients->id->EditAttrs = array();

// Account_No
$clients->Account_No->CellCssStyle = ""; $clients->Account_No->CellCssClass = "";
$clients->Account_No->CellAttrs = array(); $clients->Account_No->ViewAttrs = array(); $clients->Account_No->EditAttrs = array();

// Alias
$clients->Alias->CellCssStyle = ""; $clients->Alias->CellCssClass = "";
$clients->Alias->CellAttrs = array(); $clients->Alias->ViewAttrs = array(); $clients->Alias->EditAttrs = array();

// Client_Name
$clients->Client_Name->CellCssStyle = ""; $clients->Client_Name->CellCssClass = "";
$clients->Client_Name->CellAttrs = array(); $clients->Client_Name->ViewAttrs = array(); $clients->Client_Name->EditAttrs = array();

// Address
$clients->Address->CellCssStyle = ""; $clients->Address->CellCssClass = "";
$clients->Address->CellAttrs = array(); $clients->Address->ViewAttrs = array(); $clients->Address->EditAttrs = array();

// Contact_No
$clients->Contact_No->CellCssStyle = ""; $clients->Contact_No->CellCssClass = "";
$clients->Contact_No->CellAttrs = array(); $clients->Contact_No->ViewAttrs = array(); $clients->Contact_No->EditAttrs = array();

// Email_Address
$clients->Email_Address->CellCssStyle = ""; $clients->Email_Address->CellCssClass = "";
$clients->Email_Address->CellAttrs = array(); $clients->Email_Address->ViewAttrs = array(); $clients->Email_Address->EditAttrs = array();

// TIN_No
$clients->TIN_No->CellCssStyle = ""; $clients->TIN_No->CellCssClass = "";
$clients->TIN_No->CellAttrs = array(); $clients->TIN_No->ViewAttrs = array(); $clients->TIN_No->EditAttrs = array();

// Contact_Person
$clients->Contact_Person->CellCssStyle = ""; $clients->Contact_Person->CellCssClass = "";
$clients->Contact_Person->CellAttrs = array(); $clients->Contact_Person->ViewAttrs = array(); $clients->Contact_Person->EditAttrs = array();

// File_Upload
$clients->File_Upload->CellCssStyle = ""; $clients->File_Upload->CellCssClass = "";
$clients->File_Upload->CellAttrs = array(); $clients->File_Upload->ViewAttrs = array(); $clients->File_Upload->EditAttrs = array();

// Call Row_Rendered event
$clients->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $clients->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $clients->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->Account_No->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->Alias->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->Client_Name->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->Address->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->Contact_No->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->Email_Address->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->TIN_No->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->Contact_Person->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $clients->File_Upload->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $clients->id->CellAttributes() ?>>
<div<?php echo $clients->id->ViewAttributes() ?>><?php echo $clients->id->ListViewValue() ?></div></td>
			<td<?php echo $clients->Account_No->CellAttributes() ?>>
<div<?php echo $clients->Account_No->ViewAttributes() ?>><?php echo $clients->Account_No->ListViewValue() ?></div></td>
			<td<?php echo $clients->Alias->CellAttributes() ?>>
<div<?php echo $clients->Alias->ViewAttributes() ?>><?php echo $clients->Alias->ListViewValue() ?></div></td>
			<td<?php echo $clients->Client_Name->CellAttributes() ?>>
<div<?php echo $clients->Client_Name->ViewAttributes() ?>><?php echo $clients->Client_Name->ListViewValue() ?></div></td>
			<td<?php echo $clients->Address->CellAttributes() ?>>
<div<?php echo $clients->Address->ViewAttributes() ?>><?php echo $clients->Address->ListViewValue() ?></div></td>
			<td<?php echo $clients->Contact_No->CellAttributes() ?>>
<div<?php echo $clients->Contact_No->ViewAttributes() ?>><?php echo $clients->Contact_No->ListViewValue() ?></div></td>
			<td<?php echo $clients->Email_Address->CellAttributes() ?>>
<div<?php echo $clients->Email_Address->ViewAttributes() ?>><?php echo $clients->Email_Address->ListViewValue() ?></div></td>
			<td<?php echo $clients->TIN_No->CellAttributes() ?>>
<div<?php echo $clients->TIN_No->ViewAttributes() ?>><?php echo $clients->TIN_No->ListViewValue() ?></div></td>
			<td<?php echo $clients->Contact_Person->CellAttributes() ?>>
<div<?php echo $clients->Contact_Person->ViewAttributes() ?>><?php echo $clients->Contact_Person->ListViewValue() ?></div></td>
			<td<?php echo $clients->File_Upload->CellAttributes() ?>>
<?php if ($clients->File_Upload->HrefValue <> "" || $clients->File_Upload->TooltipValue <> "") { ?>
<?php if (!empty($clients->File_Upload->Upload->DbValue)) { ?>
<a href="<?php echo $clients->File_Upload->HrefValue ?>"><?php echo $clients->File_Upload->ListViewValue() ?></a>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($clients->File_Upload->Upload->DbValue)) { ?>
<?php echo $clients->File_Upload->ListViewValue() ?>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
