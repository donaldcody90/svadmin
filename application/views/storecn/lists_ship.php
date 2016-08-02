<?php $this->load->view('_base/head'); ?>
<?php
    // echo "<pre>";
    // print_r($data);die;
?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>storecn/lists_ship">Danh sách vận đơn nhập kho</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/ships">Nhập kho Trung Quốc</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/lists_package">Danh sách đóng bao</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/packages">Đóng bao kho Trung Quốc</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <div class="lists_ship clearfix">
	    <h2 class="float-left">Danh sách vận đơn đã nhập  kho Trung Quốc</h2>
	    <div class="float-right"><a href="<?php echo site_url('storecn/ships'); ?>" class="button-link special">Upload File nhập kho Trung Quốc</a></div>
    </div>
    <div class="filer_box">
         <form action="<?php echo site_url('storecn/lists_ship') ?>" method="GET">
            <?php
                $filter_name = $this->input->get('filter_name');
                $filter_shipid = $this->input->get('filter_shipid');
                $filter_pid = $this->input->get('filter_pid');
                $filter_ship_cn_status = $this->input->get('filter_ship_cn_status');
                $startdate = $this->input->get('filter_startdate_cn_ship_receive_date');
                $enddate = $this->input->get('filter_enddate_cn_ship_receive_date	');
            ?>
            Nhãn:<input type="text" value="<?php echo isset($filter_name)?$filter_name:''; ?>" name="filter_name">
            Mã vận đơn:<input type="text" value="<?php echo isset($filter_shipid)?$filter_shipid:''; ?>" name="filter_shipid">
            ID bao hàng:<input type="text" value="<?php echo isset($filter_pid)?$filter_pid:''; ?>" name="filter_pid">
            Ngày:<input type="text" value="<?php echo isset($startdate )?$startdate:''; ?>" name="filter_startdate_cn_ship_receive_date"> - <input type="text" value="<?php echo isset($enddate )?$enddate:''; ?>" name="filter_enddate_cn_ship_receive_date	">
            Tình trạng :
            <select name="filter_ship_cn_status">
                <option value="" selected>Tất cả</option>
                <option value="0" <?php echo (isset($filter_ship_cn_status) && $filter_ship_cn_status==0 && $filter_ship_cn_status!=NULL)?'selected':''; ?>>Chưa gửi</option>
                <option value="1" <?php echo (isset($filter_ship_cn_status) && $filter_ship_cn_status==1 )?'selected':''; ?>>Đã gửi</option>
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
                        Ngày nhập
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
                            <?php echo $value['receive_name_cn']; ?>
                        </div>
                        <div class="blue">
                            <?php echo $value['cn_package_receive_date']; ?>
                        </div>
                    </td>
                    <td>
                        <span class="green">
                            <?php echo $value['shipid']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="red">
                            <?php echo getStorecnShipsText($value['ship_cn_status']); ?>
                        </span>
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