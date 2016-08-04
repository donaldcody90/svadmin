<?php $this->load->view('_base/head'); ?>
<?php
    // echo "<pre>";
    // print_r($data);die;
?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>storevn/lists_ship">Danh sách vận đơn nhập kho</a></li>
    <li><a href="<?php echo site_url(); ?>storevn/lists_package">Danh sách đóng bao</a></li>
    <li><a href="<?php echo site_url(); ?>storevn/check_order">Kiểm hàng</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <div class="lists_ship clearfix">
	    <h2 class="float-left">Danh sách vận đơn đã nhận kho Việt Nam</h2>
    </div>
    <div class="filer_box">
         <form action="<?php echo site_url('storevn/lists_ship') ?>" method="GET">
            <?php
                $filter_name = $this->input->get('filter_name');
                $filter_shipid = $this->input->get('filter_shipid');
                $filter_pid = $this->input->get('filter_pid');
                $filter_ship_vn_status = $this->input->get('filter_ship_vn_status');
                $startdate = $this->input->get('filter_startdate_vn_ship_receive_date');
                $enddate = $this->input->get('filter_enddate_vn_ship_receive_date');
            ?>
            Nhãn:<input type="text" value="<?php echo isset($filter_name)?$filter_name:''; ?>" name="filter_name">
            Mã vận đơn:<input type="text" value="<?php echo isset($filter_shipid)?$filter_shipid:''; ?>" name="filter_shipid">
            ID bao hàng:<input type="text" value="<?php echo isset($filter_pid)?$filter_pid:''; ?>" name="filter_pid">
            Ngày:<input type="text" value="<?php echo isset($startdate )?$startdate:''; ?>" name="filter_startdate_vn_ship_receive_date"> - <input type="text" value="<?php echo isset($enddate )?$enddate:''; ?>" name="filter_enddate_vn_ship_receive_date">
            Tình trạng :
            <select name="filter_ship_vn_status">
                <option value="" selected>Tất cả</option>
                <option value="0" <?php echo (isset($filter_ship_vn_status) && $filter_ship_vn_status==0 && $filter_ship_vn_status!=NULL)?'selected':''; ?>>Chưa nhận</option>
                <option value="1" <?php echo (isset($filter_ship_vn_status) && $filter_ship_vn_status==1 )?'selected':''; ?>>Đã nhận</option>
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
                        Ngày nhận
                    </td>
                    <td>
                        Mã vận đơn
                    </td>
                    <td>
                        Trạng thái
                    </td>
                    <td>
                        Bao đã đóng
                    </td>
                    <td>
                        Ghi chú
                    </td>
                </tr>
    <?php
        if( isset($data) && count($data)>0  ){
            $stt = $this->input->get('page');
            if( $stt==NULL){
                $stt = 1;
            }else{
                $stt = $this->input->get('page') +1;
            }
            foreach ($data as $key => $value) {
    ?>
                <tr>
                    <td>
                        <?php echo $stt; ?> 
                    </td>
                    <td>
                        <div class="black">
                            <?php echo $value['receive_name_vn']; ?>
                        </div>
                        <div class="blue">
                            <?php echo $value['vn_ship_receive_date']; ?>
                        </div>
                    </td>
                    <td>
                        <span class="green">
                            <?php echo $value['shipid']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="black"><?php echo $value['receive_name_cn']; ?></span> 
                        <span class=""><?php echo getStorecnShipsText($value['ship_cn_status']); ?></span>
                        <span class="blue"><?php echo $value['cn_ship_receive_date']; ?></span></br>
                            
                            <?php
                                if( isset($value['receive_name_vn']) ){
                            ?>
                                    <span class="black"><?php echo $value['receive_name_vn']; ?></span>
                                    <span class=""><?php echo getStorevnShipsText($value['ship_vn_status']); ?></span> 
                                    <span class="blue"><?php echo $value['vn_ship_receive_date']; ?></span>  
                            <?php
                                }
                            ?>
                    </td>
                    <td>
                        <div class="black">
                            <?php echo $value['name']; ?>
                        </div>
                        <div class="green">
                            <?php
                                if(isset( $value['weight'])){
                                    echo  $value['weight'];
                                    echo '<span class="red">(kg)</span>';
                                }
                            ?> 
                        </div>
                    </td>
                    <td>
                        <?php echo $value['note']; ?>
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