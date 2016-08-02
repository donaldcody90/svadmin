<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Thêm mới</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title "> Danh sách khách hàng</h2>
    <div class="filer_box">
        <?php
            $filter_cid = $this->input->get('filter_cid');
            $filter_c_username = $this->input->get('filter_c_username');
            $filter_c_fullname = $this->input->get('filter_c_fullname');
            $filter_c_phone = $this->input->get('filter_c_phone');
            $filter_c_email = $this->input->get('filter_c_email');
            $filter_yahoo = $this->input->get('filter_yahoo');
            $filter_skype = $this->input->get('filter_skype');
            $filter_store = $this->input->get('filter_store');
        ?>
        <form name="filter_form" action="<?php echo site_url("customers/lists"); ?>" method="GET">
            CID:<input type="text" value="<?php echo isset($filter_cid)?$filter_cid:''; ?>" name="filter_cid">
            Username:<input type="text" value="<?php echo isset($filter_c_username)?$_GET['filter_c_username']:''; ?>" name="filter_c_username">
            Họ Tên:<input type="text" value="<?php echo isset($filter_c_fullname)?$_GET['filter_c_fullname']:''; ?>" name="filter_c_fullname">
            Phone:<input type="text" value="<?php echo isset($filter_c_phone)?$_GET['filter_c_phone']:''; ?>" name="filter_c_phone">
            Email:<input type="text" value="<?php echo isset($filter_c_email)?$filter_c_email:''; ?>" name="filter_c_email">
            Yahoo:<input type="text" value="<?php echo isset($filter_yahoo)?$filter_yahoo:''; ?>" name="filter_yahoo" />
            Skype:<input type="text" value="<?php echo isset($filter_skype)?$filter_skype:''; ?>" name="filter_skype" />
            Kho hàng:<select name="filter_store">
                        <option value="">Chọn kho hàng</option>
                        <option value="0" <?php echo (isset($filter_store) && $filter_store==0 )?'selected':''; ?> >Hà Nội</option>
                        <option value="1" <?php echo (isset($filter_store) && $filter_store==1 )?'selected':''; ?> >Sài Gòn</option>
                    </select>
            
            <input class="button" type="submit" value="Tìm kiếm" />
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
                        Thông tin cá nhân
                    </td>
                    <td>
                        Đăng ký nhận<br>hàng tại kho
                    </td>
                    <td>
                        Ngày GD đầu <br> Ngày GD cuối
                    </td>
                    <td>
                        Tiền hàng
                    </td>
                    <td>
                        Thiếu tiền hàng
                    </td>
                    <td>
                        Tiền vận đơn
                    </td>
                    <td>
                        Thiếu vận đơn
                    </td>
                    <td>
                        Tư vấn
                    </td>
                    <td>
                        Thao tác
                    </td>
                </tr>
        <?php
            if( isset($data) && count($data)>0 ){

                $stt = $this->input->get('page');
                if( $stt==NULL){
                    $stt = 1;
                }else{
                    $stt = $this->input->get('page') +1;
                }

                foreach ($data as $key => $value) {
        ?>   
                <tr>
                    <td class="align-center">
                       <span class="bold green"><?php echo $stt; ?></span>
						<?php if($value['onlyship']){
							echo '<p class="bold red"><b>SHIP HỘ</b></p>';
						} ?>
                    </td>
                    <td>
                        <p><strong>Username:</strong><?php echo $value['c_username']; ?></p>
                        <p><strong>Họ tên:</strong><?php echo $value['c_fullname']; ?></p>
                        <p><strong>Email:</strong><?php echo $value['c_email']; ?> </p>
                        <p><strong>Phone:</strong><?php echo $value['c_phone']; ?> </p>
                        <p><strong>Yahoo:</strong><?php echo $value['yahoo']; ?> </p>
                        <p><strong>Skype:</strong><?php echo $value['skype']; ?> </p>
                        <p><strong>Địa chỉ:</strong><?php echo $value['address']; ?> </p>
                    </td>
                    <td>
						<?php
						  echo getStoreText($value['store']);
						?>                  
					</td>
                    <td>
                        <p><strong>Đầu: <?php echo $value['first_order_date']; ?></strong> </p>
                        <p><strong>Cuối: <?php echo $value['last_order_date']; ?></strong></p>
                    </td>
                    <td>
                        0
                    </td>
                    <td>
                        0
                    </td>
                    <td>
                        0
                    </td>
                    <td>
                        0
                    </td>
                    <td>

                            <?php echo $value['advisori_username']; ?>

                    </td>
                    <td>
						<a href="<?php echo site_url('customers/edit/'.$value['cid']); ?>" >Sửa</a> 
						|
                        <a href="<?php echo site_url('customers/delete/'.$value['cid']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')">Xóa</a> 
						|
						<button class="link_ajax" onclick="openPopup('<?php echo site_url('customers/changepassword'); ?>',{cid:<?php echo $value['cid']; ?>},600,500)">
 Đổi mật khẩu</button>
                        |
                        <button class="link_ajax" onclick="openPopup('<?php echo site_url('customers/support'); ?>',{cid:<?php echo $value['cid']; ?>},600,500)">
 Chọn tư vấn</button>
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