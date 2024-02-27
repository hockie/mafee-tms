<?php

// Call Row_Rendering event
$invoice_items->Row_Rendering();

// id
$invoice_items->id->CellCssStyle = ""; $invoice_items->id->CellCssClass = "";
$invoice_items->id->CellAttrs = array(); $invoice_items->id->ViewAttrs = array(); $invoice_items->id->EditAttrs = array();

// invoice_id
$invoice_items->invoice_id->CellCssStyle = ""; $invoice_items->invoice_id->CellCssClass = "";
$invoice_items->invoice_id->CellAttrs = array(); $invoice_items->invoice_id->ViewAttrs = array(); $invoice_items->invoice_id->EditAttrs = array();

// client_id
$invoice_items->client_id->CellCssStyle = ""; $invoice_items->client_id->CellCssClass = "";
$invoice_items->client_id->CellAttrs = array(); $invoice_items->client_id->ViewAttrs = array(); $invoice_items->client_id->EditAttrs = array();

// booking_id
$invoice_items->booking_id->CellCssStyle = ""; $invoice_items->booking_id->CellCssClass = "";
$invoice_items->booking_id->CellAttrs = array(); $invoice_items->booking_id->ViewAttrs = array(); $invoice_items->booking_id->EditAttrs = array();

// Call Row_Rendered event
$invoice_items->Row_Rendered();
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("MasterRecord") ?><?php echo $invoice_items->TableCaption() ?><br>
<a href="<?php echo $gsMasterReturnUrl ?>"><?php echo $Language->Phrase("BackToMasterPage") ?></a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader"><?php echo $invoice_items->id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoice_items->invoice_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoice_items->client_id->FldCaption() ?></td>
			<td class="ewTableHeader"><?php echo $invoice_items->booking_id->FldCaption() ?></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $invoice_items->id->CellAttributes() ?>>
<div<?php echo $invoice_items->id->ViewAttributes() ?>><?php echo $invoice_items->id->ListViewValue() ?></div></td>
			<td<?php echo $invoice_items->invoice_id->CellAttributes() ?>>
<div<?php echo $invoice_items->invoice_id->ViewAttributes() ?>><?php echo $invoice_items->invoice_id->ListViewValue() ?></div></td>
			<td<?php echo $invoice_items->client_id->CellAttributes() ?>>
<div<?php echo $invoice_items->client_id->ViewAttributes() ?>><?php echo $invoice_items->client_id->ListViewValue() ?></div></td>
			<td<?php echo $invoice_items->booking_id->CellAttributes() ?>>
<div<?php echo $invoice_items->booking_id->ViewAttributes() ?>>
<?php if ($invoice_items->booking_id->HrefValue <> "" || $invoice_items->booking_id->TooltipValue <> "") { ?>
<a href="./bookingslist.php?x_id=<?php echo $invoice_items->booking_id->HrefValue ?>"><?php echo $invoice_items->booking_id->ListViewValue() ?></a>
<?php } else { ?>
<?php echo $invoice_items->booking_id->ListViewValue() ?>
<?php } ?>
</div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
