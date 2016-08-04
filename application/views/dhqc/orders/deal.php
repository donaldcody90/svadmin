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
    <h2 class="title "> Danh sách giao dịch</h2>
    <div class="filer_box">
         <form action="<?php echo site_url('orders/lists') ?>" method="GET">
            <?php
                $filter_invoiceid = $this->input->get('filter_invoiceid');
                $filter_username = $this->input->get('filter_username');
                $filter_fullname = $this->input->get('filter_fullname');
                // $filter_status = $this->input->get('filter_status');
            ?>
            Mã hóa đơn:<input type="text" value="<?php echo isset($filter_invoiceid)?$filter_invoiceid:''; ?>" name="filter_invoiceid">
            Username:<input type="text" value="<?php echo isset($filter_username)?$filter_username:''; ?>" name="filter_username">
            Họ Tên:<input type="text" value="<?php echo isset($filter_fullname)?$filter_fullname:''; ?>" name="filter_fullname">
            Người duyệt:<input type="text" value="" name="filter_phone">
            Kiểu giao dịch:
                <select name="">
                    <option value="">Tất cả</option>
                    <option value="">Demo</option>
                </select>
            Trạng thái:
                <select name="">
                    <option value="">Tất cả</option>
                    <option value="">Demo trạng thái</option>
                </select>
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
                        Ngày giao dịch
                    </td>
                    <td>
                        Khách hàng
                    </td>
                    <td>
                        Đơn hàng    
                    </td>
                    <td>
                        Thông tin giao dịch
                    </td>
                    <td>
                        Số tiền
                    </td>
                    <td>
                        Mô tả ngắn
                    </td>
                    <td>
                        Tình trạng
                    </td>
                    <td>
                        Chỉnh sửa
                    </td>
                </tr>
                <tr>
                    <td class="align-center">
                       1                       
                    </td>
                    <td>
                        <span class="green">20-6-2016</span> 
                    </td>
                    <td>
                        <div class="green">Akira Phan</div> 
                        <span>Phan Em</span>  
                    </td>
                    <td>
                        <span class="blue">tranba-20-6-2016</span>                     
                    </td>
                    <td>
                        <div class="green">Thanh toán đơn hàng</div>
                        <div>Chuyển khoản( VP Bank )</div>
                        <div class="black">1654654154</div>                                                              
                    </td>
                    <td>
                         <span class="red">1.250.000</span> VNĐ
                    </td>
                    <td>
                        <span>Tiền còn tồn lại</span>                    
                    </td>
                    <td>
                        <div class="green">Đã duyệt</div> 
                        <div class="black">TranBa</div>
                        <div class="red">12h00 14-02-2016</div>                        
                    </td>
                    <td>
                        Chỉnh sửa                       
                    </td>
                </tr>
                <tr>
                    <td class="align-center">
                       1                       
                    </td>
                    <td>
                        <span class="green">20-6-2016</span> 
                    </td>
                    <td>
                        <div class="green">Akira Phan</div> 
                        <span>Phan Em</span>  
                    </td>
                    <td>
                        <span class="blue">tranba-20-6-2016</span>                     
                    </td>
                    <td>
                        <div class="green">Thanh toán đơn hàng</div>
                        <div>Chuyển khoản( VP Bank )</div>
                        <div class="black">1654654154</div>                                                              
                    </td>
                    <td>
                         <span class="red">1.250.000</span> VNĐ
                    </td>
                    <td>
                        <span>Tiền còn tồn lại</span>                    
                    </td>
                    <td>
                        <div class="red">Chưa duyệt</div> 
                    </td>
                    <td>
                        Chỉnh sửa                       
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>


<?php $this->load->view('_base/footer'); ?>