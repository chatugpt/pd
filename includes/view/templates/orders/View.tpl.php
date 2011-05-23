<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
		<tr>
			<td>
<!-- Form block start -->
<?php
$outOrdersViewValue = $inData["OrdersViewValue"];
?>

<table class="menutab" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
		<tr>
			<td class="menumaintopon"><?php Language::show("ORDERS.VIEW.LABEL")?></td>
		</tr>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" width="100%" border="0">
<!-- fields start -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.ORDER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->order_id?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.CUSTOMER_NAME.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->customer_name?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.CUSTOMER_ADDRESS.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->customer_address?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.ASSIGN.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->assign?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.AGE.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->age?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.SEX.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->sex?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.PROJECT_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->project_id?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.HIS.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->HIS?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.MOBILE.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->mobile?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.TELEPHONE.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->telephone?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.OPERATE_STATUS.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->operate_status?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.CONTACT_STATUS.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->contact_status?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.CONTACT_TIME.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->contact_time?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.OPERATE_TIME.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->operate_time?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.OPERATE_PRICE.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->operate_price?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.USER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->user_id?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.MODIFYER_ID.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->modifyer_id?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.ADDTIME.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->addtime?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.INFO.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->info?>
						</td>
					</tr>
					<!-- Field end -->
					<tr>
						<td width="194" align="left" valign="top" class="smalltdrow1"><?php Language::show("ORDERS.PRICE.LABEL")?></td>
						<td align="left" class="smalltdrow2"><?php echo $outOrdersViewValue->price?>
						</td>
					</tr>
					<!-- Field end -->
<!-- fields end -->
				</table>
			</td>
		</tr>
		<tr>
			<td height="25" align="center" valign="center" class="tdblue">
			<!-- action blocks start -->
				<input type="button" onclick="history.back();" value="<?php Language::show("COMMON.BACK.LABEL")?>" class="submit" />
			<!-- action blocks end -->
			</td>
		</tr>
	</tbody>
</table>
<!-- Form block end -->
			</td>
		</tr>
	</tbody>
</table>