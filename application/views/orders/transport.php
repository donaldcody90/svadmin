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
    <h2 class="title "> Danh sách vận đơn</h2>
    <div class="filer_box">
         <form action="<?php echo site_url('orders/lists') ?>" method="GET">
            <?php
                $filter_username = $this->input->get('filter_username');
                $filter_fullname = $this->input->get('filter_fullname');
                // $filter_status = $this->input->get('filter_status');
            ?>
            Mã vận đơn:<input type="text" value="" name="">
            Username:<input type="text" value="<?php echo isset($filter_username)?$filter_username:''; ?>" name="filter_username">
            Họ Tên:<input type="text" value="<?php echo isset($filter_fullname)?$filter_fullname:''; ?>" name="filter_fullname">
            Trạng thái:
                <select name="">
                    <option value="">Tất cả</option>
                    <option value="">Demo trạng thái</option>
                </select>
            <input class="button" type="submit" value="Tìm kiếm" >
            <input class="button" type="submit" value="Tạo vận đơn" >
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
                        Ngày tạo / Ngày vận đơn
                    </td>
                    <td>
                        Mã Vận đơn
                    </td>
                    <td>
                        Khách hàng    
                    </td>
                    <td>
                        Khối lượng(kg)
                    </td>
                    <td>
                        Số tiền(VNĐ)
                    </td>
                    <td>
                        Đã thanh toán( VNĐ )
                    </td>
                    <td>
                        Mô tả ngắn
                    </td>
                    <td>
                        Trạng thái
                    </td>
                    <td>
                        Chỉnh sửa
                    </td>
                </tr>
                <tr>
                    <td class="align-center">
                       2                       
                    </td>
                    <td>
                        <div class="green">20-6-2016</div>
                        <div class="red">20-6-2016</div>  
                    </td>
                    <td>
                        <div class="black">tranba-20-6-2016</div> 
                    </td>
                    <td>
                        <div class="blue">akiraphan</div>
                        <div>Phan</div>                
                    </td>
                    <td>
                        <span>0.2</span>                                                            
                    </td>
                    <td>
                         <span class="red">1.250.000</span>
                    </td>
                    <td>
                        <span class="red">1.000.000</span>                   
                    </td>
                    <td>
                        <span>Hàng khá tốt</span>
                    </td>
                    <td>
                        <span class="green">Đã duyệt</span>                      
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
                        <div class="green">20-6-2016</div>
                        <div class="red">20-6-2016</div>  
                    </td>
                    <td>
                        <div class="black">tranba-20-6-2016</div> 
                    </td>
                    <td>
                        <div class="blue">akiraphan</div>
                        <div>Phan</div>                
                    </td>
                    <td>
                        <span>0.2</span>                                                            
                    </td>
                    <td>
                         <span class="red">1.250.000</span>
                    </td>
                    <td>
                        <span class="red">1.000.000</span>                   
                    </td>
                    <td>
                        <span>Hàng khá tốt</span>
                    </td>
                    <td>
                        <span class="green">Đã duyệt</span>                      
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