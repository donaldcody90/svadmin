<?php $this->load->view('_base/head'); ?>
<?php 
    // echo "<pre>";
    // print_r($data);die;
?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>orders">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>orders/deal">Giao dịch</a></li>
    <li><a href="<?php echo site_url(); ?>orders/transport">Vận đơn Quảng Châu - Việt Nam</a></li>
    <li><a href="<?php echo site_url(); ?>orders/complain">Khiếu nại Shop</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title "> Danh sách đơn hàng</h2>
    <div class="list_status clearfix">
        <ul>
			<?php 
				if(isset($order_status_list))
				{
					foreach($order_status_list as $key=>$item){
					
						?>
						 <li>
							<?php if($key =="-99"){ ?>
								<a href="<?php echo site_url('orders/lists') ?>" class="<?php echo $item['class']; ?>">
								 <?php echo $item['title'] ?> : <span>(<?php echo $item['count'] ?>)</span>
								 </a>
							<?php }else{  ?>								  
								  <a href="<?php echo site_url('orders/lists?filter_status='.$key); ?>" class="<?php echo $item['class']; ?>">
								 <?php echo $item['title'] ?> : <span>(<?php echo $item['count'] ?>)</span>
								 </a>
							<?php } ?>
							 
						</li> 
						<?php
					}
				}
			
			?>
        </ul>
    </div>
    <div class="filer_box">
         <form action="<?php echo site_url('orders/lists') ?>" method="GET">
            <?php
                $filter_invoiceid = $this->input->get('filter_invoiceid');
                $filter_username = $this->input->get('filter_c_username');
                $filter_fullname = $this->input->get('filter_c_fullname');
                $filter_phone = $this->input->get('filter_c_phone');
                $filter_email = $this->input->get('filter_c_email');
                // $filter_status = $this->input->get('filter_status');
            ?>
            Mã hóa đơn:<input type="text" value="<?php echo isset($filter_invoiceid)?$filter_invoiceid:''; ?>" name="filter_invoiceid">
            Username:<input type="text" value="<?php echo isset($filter_username)?$filter_username:''; ?>" name="filter_c_username">
            Họ Tên:<input type="text" value="<?php echo isset($filter_fullname)?$filter_fullname:''; ?>" name="filter_c_fullname">
            Phone:<input type="text" value="<?php echo isset($filter_phone)?$filter_phone:''; ?>" name="filter_c_phone">
            Email:<input type="text" value="<?php echo isset($filter_email)?$filter_email:''; ?>" name="filter_c_email">
            <input class="button" type="submit" value="Tìm kiếm" >
        </form> 
    </div>
    <div class="gridtable">
        <table>
            <tbody>
                <tr>
                    <td>
                        STT
                    </td>
                    <td>
                        Mã hóa đơn/Ngày mua hàng
                    </td>
                    <td>
                        Tên khách
                    </td>
                    <td>
                        Thông tin liên hệ
                    </td>
                    <td>
                        Nhận hàng tại kho
                    </td>
                    <td>
                        Thông tin sản phẩm
                    </td>
                    <td>
                        Đã thanh toán
                    </td>
                    <td>
                        Trạng thái
                    </td>
                </tr>
    <?php
        if( isset($data) && count($data)>0 ){
            $stt = $this->input->get('page');
            if( $stt==NULL){
                $stt = 1;
            }else{
                $stt = $this->input->get('page')+1;
            }
            foreach ($data as $key => $value) {
			

    ?>
                <tr>
                    <td class="align-center">
                        <?php echo $stt; ?>                        
                    </td>
                    <td>
                        <span class="blue">
                            <a href="<?php echo site_url('orders/detail/'.$value['id']); ?>">
                                <?php echo $value['invoiceid']; ?>
                            </a>        
                        </span>
                    </td>
                    <td>
                        <?php echo $value['c_fullname'].'<br>'; ?>
                        <span class="blue">
                            <?php echo $value['c_username']; ?>
                        </span>  
                    </td>
                    <td>
                        <b>Địa chỉ :</b> <?php echo $value['address']; ?>                        
                    </td>
                    <td>
                        <?php
                            echo getStoreText($value['store']);
                        ?>                                                                  
                    </td>
                    <td>
                         <div>Tổng số SP: <span class="red"><?php echo $value['order_summary']['total_quantity']; ?></span></div>
                           <div>Tổng tiền: 
                                <span class="red">
                                        <?php echo $value['order_summary']['total_price']; ?>
                                </span>
                           </div>
                    </td>
                    <td>
                        Da thanh toan                    
                    </td>
                    <td>
                        <?php echo getStatusOrder($value['status']); ?>                       
                    </td>
                </tr>
    <?php
            $stt++;
            }
        }
    ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>


<?php $this->load->view('_base/footer'); ?>