<?php
	// echo "<pre>";
	// print_r($order);
?>

<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>orders">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>orders/deal">Giao dịch</a></li>
    <li><a href="<?php echo site_url(); ?>orders/transport">Vận đơn Quảng Châu - Việt Nam</a></li>
    <li><a href="<?php echo site_url(); ?>orders/complain">Khiếu nại Shop</a></li>
</ul>
<?php $this->load->view('_base/message'); ?>

		<div id="response_ajax"></div>
		<div class="information clearfix">
			<h3 class="blue">
				<?php echo $order['invoiceid']; ?>
			</h3>
			
			<div class="detail">
				<div class="left">
					<div class="item">
						<b>Tên khách : </b> <?php echo $order['fullname']; ?>
					</div>
					<div class="item">
						<b>Địa chỉ : </b> <?php echo $order['address']; ?>
					</div>
					<div class="item">
						<b>Kho nhận hàng : </b> <?php echo getStoreText($order['store']); ?> 
					</div>
					<div class="item">
						<b>Tài chính hiện tại : </b> <span class="red">nợ</span> 1890.000 <span class="red">nợ</span> ( Ship : 120.999 )
					</div>
				</div>
				<div class="right">
					<div class="item">
						<b>Tổng tiền : </b> <span class="red"><?php echo $order['order_summary']['total_price']; ?></span> NDT(<span class="red"><?php echo vst_showPrice( ($order['order_summary']['total_price'])*( $order['order_summary']['currency_rate']) ); ?></span> <span class="small">đ</span>)
					</div class="item">
					
					<div class="item">
						<b>Đã thanh toán : </b> <span class="red">0</span> <span class="small">đ</span>
					</div>	
					
					<div class="item">
						<b>Còn thiếu : </b> <span class="red">0</span> <span class="small">đ</span>
					</div>
					
					<div class="item">
						<b>Tỷ giá : </b> <span class="red"><?php echo $order['currency_rate']; ?></span>
					</div>
					<div class="item">
						<b>Tình trạng đơn : </b> <?php echo getStatusOrder($order['status']); ?>
					</div>
					<div class="item">
						<form name="FormOrder" action="" class="ajaxFormOrder" method="POST" >
							<div style="padding:10px 0px;"> 
								<b>Duyệt đơn :</b>
								<select name="status">
									<option value="0" <?php echo ( isset($order['status']) && $order['status']==0 )?'selected':''; ?>>Chưa duyệt</option>
									<option value="1" <?php echo ( isset($order['status']) && $order['status']==1 )?'selected':''; ?>>Đã duyệt</option>
									<option value="2" <?php echo ( isset($order['status']) && $order['status']==2 )?'selected':''; ?>>Đã thanh toán - chờ mua hàng</option>
									<option value="3" <?php echo ( isset($order['status']) && $order['status']==3 )?'selected':''; ?>>Đã mua hàng</option>
									<option value="4" <?php echo ( isset($order['status']) && $order['status']==4 )?'selected':''; ?>>Hàng đã về - chờ giao hàng</option>
									<option value="5" <?php echo ( isset($order['status']) && $order['status']==5 )?'selected':''; ?>>Đã kết thúc</option>
									<option value="-1" <?php echo ( isset($order['status']) && $order['status']==-1 )?'selected':''; ?>>Đã hủy</option>
								</select>
								<a class="button-link" onClick="submitAjax(this)">Lưu</a>
							</div>
							<div><b class="float-left">Ghi chú :</b><textarea name="order_note" rows="4" cols="35" placeholder=" Ghi chú"><?php echo $order['order_note']; ?></textarea></div>
							<b>Phần trăm dịch vụ (%): </b><input type="text" name="fee_service_percent" value="<?php echo $order['fee_service_percent']; ?>" size="3" required >
								<input type="hidden" name="oid" value="<?php echo $order['id']; ?>" />
								<input type="hidden" name="controller" value="orders" />
								<input type="hidden" name="task" value="updateOrder" />
								<a class="button-link" onClick="submitAjax(this)">Lưu</a>
								<div class="ajax_response alert dismissable"></div>
						</form>
					</div>
				</div>
			</div>
		</div>


		<div class="gridtable">
			<table>
			    <tbody>
			        <tr>
			            <td width="1%">
			                STT
			            </td>
			            <td width="34%">
			                Sản phẩm
			            </td>
			            <td width="15%">
			                Giá(NDT)
			            </td>
			            <td width="20%">
			                Số lượng
			            </td>
			            <td width="10%">
			                Tổng tiền (NDT)
			            </td>
			            <td width="20%">
			                
			            </td>
			        </tr>
		    <?php
		    	// echo "<pre>";
		    	// print_r($order['detail']);die;
		    	foreach ($order['detail'] as $key_sellers => $value_sellers) {
		    ?>
			        <tr>
						<td colspan="8">
							Người bán : <span class="blue"> <?php echo $value_sellers['sellername']; ?></span>
						</td>
			        </tr>
		    	<?php
		    		$tmp = 1;
		    		foreach ($value_sellers['items'] as $key_items_by_seller => $value_items_by_seller) {
		    		
		    	?>
					        <tr>
					            <td>
					            	<?php echo $tmp; ?>
					            </td>
					            <td>
					                <div class="image">
					                	<a href="<?php echo $value_items_by_seller['item_link'] ?>" target="_blank"><img src="<?php echo $value_items_by_seller['item_image']; ?>" width="100px" height="100px"></a>
					                </div>
					                <div class="info">
					                	<div class="price">
					                		<a href="<?php echo $value_items_by_seller['item_link'] ?>" target="_blank">
					                			<span style="font-size:15px;font-weight:600;"><i class="fa fa-jpy" aria-hidden="true"></i> <?php echo $value_items_by_seller['item_price']; ?> </span>
					                			- <?php echo $value_items_by_seller['item_title']; ?>
				                			</a>
					                	</div>
					                	<div class="title">
					                		<?php echo $value_items_by_seller['item_attrs']; ?>
					                	</div>
					                </div>
					            </td>
					            <td>
					                <div class="red"><?php echo $value_items_by_seller['item_price']; ?></div> 
					                <div class="red"><?php echo $value_items_by_seller['item_price'] * ($order['fee_service_percent']/100); ?> <span class="green">(tiền công)</span></div> 
					                
					            </td>
					            <td>
									<form action="" class="ajaxFormItem" method="POST" >
										<input type="text" value="<?php echo $value_items_by_seller['item_quantity']; ?>" size="6" name="item_quantity">
										<input type="hidden" name="id_item" value="<?php echo $value_items_by_seller['id']; ?>" />
										<input type="hidden" name="controller" value="orders" />
										<input type="hidden" name="task" value="update_item_quantity" />
										<a class="button-link" onClick="submitAjax(this)">Lưu</a>
										<div class="ajax_response alert dismissable"></div>
									</form>
					            </td>
					            <td>
					               <div class="red">
					               		<?php echo number_format( $value_items_by_seller['item_quantity']*$value_items_by_seller['item_price'] ); ?>
					               </div>                                                            
					            </td>
								<?php if($tmp==1){ ?>
								<td rowspan="<?php echo (count($value_sellers['items']) +1); ?>">
									<div class="hethang">
										<form action="" class="ajaxFormReset"  method="post">
											<input type="hidden" name="sid" value="<?php echo $value_sellers['id']; ?>" />
											<input type="hidden" name="controller" value="orders" />
											<input type="hidden" name="task" value="hethang" />
											<a class="button-link special" onClick="submitAjax(this)">Hết hàng</a>
											<div class="ajax_response alert dismissable"></div>
										</form>
									</div>
									
									<form action="" class="ajaxFormSeller" method="POST" >
										<div class="ghost">

												Phí nội địa: <input type="text" value="<?php echo $value_sellers['fee_shipnd']; ?>" size="6" name="fee_shipnd">
												<a class="button-link" onClick="submitAjax(this)">Lưu</a>
										</div>
										<div class="ghost">
												Mã Shop: <input type="text" size="6" value="<?php echo  $value_sellers['shopid']; ?>" name="shopid">
												<a class="button-link" onClick="submitAjax(this)">Lưu</a>
										</div>
										<input type="hidden" name="id" value="<?php echo $value_sellers['id']; ?>" />
										<input type="hidden" name="controller" value="orders" />
										<input type="hidden" name="task" value="updateSeller" />
										
										<div class="ajax_response alert dismissable"></div>
									</form>
								   <hr/>
								   <h3>Danh sách vận đơn</h3>

									<form action="" class="ajaxFormShip" method="POST" >
										<div class="vandon_form">
										<input type="text" name="shipid" value="" placeholder="Mã vận đơn" size="10">
										<a class="button-link" onClick="submitAjax(this)">Thêm</a>
										</div>
										<input type="hidden" name="sid" value="<?php echo $value_sellers['id']; ?>" />
										<input type="hidden" name="oid" value="<?php echo $value_sellers['oid']; ?>" />
										<input type="hidden" name="controller" value="orders" />
										<input type="hidden" name="task" value="insertShip" />

										<div class="ajax_response alert dismissable"></div>
									</form>

									   <div class="list_vandon<?php echo $value_sellers['id']; ?>">
									   		<ul>
							               		<?php
						               				foreach ($value_sellers['ships'] as $key_shipid => $value_shipid) {
						               			?>
														<li class="clearfix itemVandon<?php echo $value_shipid['id']; ?>">
															<div class="formVandonUpdate clearfix">
																<form action="" class="formVandonUpdate" method="post">
																	<input type="hidden" name="id" value="<?php echo $value_shipid['id']; ?>" />
																	<input type="text" value="<?php echo $value_shipid['shipid']; ?>" size="1" name="shipid">
																	<?php 
																		if( $value_shipid['weight']!='' ){
																	?>
																	 		(<?php echo $value_shipid['weight']; ?> <span class="small">kg</span>)
																	<?php
																		}
																	?>
																	<a class="button-link small" onClick="submitAjax(this)">Update</a>
																	<input type="hidden" name="controller" value="orders" />
																	<input type="hidden" name="task" value="updateVandon" />
															   		<div class="ajax_response alert dismissable"></div>
														   		</form>
													   		</div>
													   		<div class="formVandonDelete clearfix">
																<form action="" class="formVandonDelete" method="post">
																	<input type="hidden" name="shipid" value="<?php echo $value_shipid['id']; ?>" />
																	<a class="button-link small" onClick="submitAjax(this)">Delete</a>
																	<input type="hidden" name="controller" value="orders" />
																	<input type="hidden" name="task" value="deleteVandon" />
															   		<div class="ajax_response alert dismissable"></div>
														   		</form>
													   		</div>
														</li>
						               			<?php
						               				}
							               		?>
						               		</ul>
									   </div>
					            </td>
								<?php } ?>
					        </tr>
		        
				<?php
		        		
		        		$tmp++;
				    }
			    ?>
					<tr>
						<td colspan="5" class="total">
							<div>
								
								<div class="right">
									Sản phẩm : <span class="green"><?php echo $value_sellers['order_seller_summary']['total_quantity'] ; ?></span> |
									Tổng tiền : <span class="red"><?php echo $value_sellers['order_seller_summary']['total_price'] ; ?></span>
									( Thực mua : <span class="green"><?php echo $value_sellers['order_seller_summary']['total_real_price'] ; ?></span> )
									( Tiền Công :<span class="green"><?php echo $value_sellers['order_seller_summary']['total_fee_service'] ; ?></span> ) 
									 |
									Phí nội địa : <span class="green"><?php echo $value_sellers['fee_shipnd']; ?></span>
								</div>
							</div>
						</td>
					</tr>
		    <?php
		    	}
		    ?>

			    </tbody>
			</table>
		</div>
		
		
		
		<div class="result">
			<div class="item">
				<b>Tổng số sản phẩm :</b><span class="red"><?php echo $order['order_summary']['total_quantity']; ?></span>
			</div>
			<div class="item">
				<b>Tổng số tiền hàng :</b><span class="red"><?php echo $order['order_summary']['total_real_price']; ?></span> NDT
			</div>
			<div class="item">
				<b>Tổng tiền công :</b><span class="red"><?php echo $order['order_summary']['total_fee_service'] ?></span> NDT
			</div>
			<div class="item">
				<b>Tổng phí nội địa :</b><span class="red"><?php echo $order['order_summary']['total_fee_shipnd']; ?></span> NDT
			</div>
			<div class="item">
				<b>Tổng giá trị đơn hàng :</b><span class="red big"><?php echo $order['order_summary']['total_price'] ?></span> NDT (<span class="red big"><?php echo vst_showPrice($order['order_summary']['total_price']* $order['order_summary']['currency_rate']) ?></span> <span class="small">đ</span>)
			</div>
			
		</div>
		
<?php $this->load->view('_base/footer'); ?>