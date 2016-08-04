<?php $this->load->view('_base/head'); ?>
<?php
    // echo "<pre>";
    // print_r($data);
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
	    <h2 class="float-left">Danh sách đóng bao tại kho Trung Quốc</h2>
	    <div class="float-right"><a href="<?php echo site_url('storecn/packages'); ?>" class="button-link special">Đóng bao từ tập Excel</a></div>
    </div>
    <div class="filer_box">
         <form action="<?php echo site_url('storecn/lists_package') ?>" method="GET">
            <?php
                $filter_package_cn_status = $this->input->get('filter_package_cn_status');
                $filter_name = $this->input->get('filter_name');
                $startdate = $this->input->get('filter_startdate_cn_package_receive_date');
                $enddate = $this->input->get('filter_enddate_cn_package_receive_date');
            ?>
            Nhãn:<input type="text" value="<?php echo isset($filter_name)?$filter_name:''; ?>" name="filter_name">
            Ngày:<input type="text" value="<?php echo isset($startdate )?$startdate:''; ?>" name="filter_startdate_cn_package_receive_date"> - <input type="text" value="<?php echo isset($enddate )?$enddate:''; ?>" name="filter_enddate_cn_package_receive_date	">
            Tình trạng :
            <select name="filter_package_cn_status">
                <option value="" selected>Tất cả</option>
                <option value="0" <?php echo (isset($filter_package_cn_status) && $filter_package_cn_status==0 && $filter_package_cn_status!=NULL)?'selected':''; ?>>Chưa gửi</option>
                <option value="1" <?php echo (isset($filter_package_cn_status) && $filter_package_cn_status==1 )?'selected':''; ?>>Đã gửi</option>
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
                        ID
                    </td>
                    <td>
                        Đóng bao
                    </td>
                    <td>
                        Nhãn
                    </td>
                    <td>
                        Cân nặng(kg)
                    </td>
                    <td>
                        Trạng thái
                    </td>
                    <td>
                        Chỉnh sửa
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
                        <div class="green">
                           <?php echo $value['id']; ?>
                        </div>
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
                        <div class="green">
                            <?php echo $value['name']; ?>
                        </div>
                        (<spam class="red"><?php echo count( $value['listShips_by_Package'] ); ?></span> mã) <a href="<?php echo site_url('storecn/lists_ship?&filter_pid='.$value['id']); ?>">Danh sách mã</a>
                    </td>
                    <td>
                       <span class="red">
                           <?php echo $value['weight']; ?>
                       </span>
                    </td>
                    <td>
                        <span class="blue">
                            <?php echo $result = getStorecnShipsText($value['package_cn_status']); ?>
                            
                        </span>
                    </td>
                    <td>
                        <?php
                            if( $value['package_cn_status']==0 ){
                        ?>
                            <form action="" class="ajaxFormPackages" method="POST" >
                                <input type="hidden" name="id" value="<?php echo $value['id']; ?>" />
                                <input type="hidden" name="controller" value="storecn" />
                                <input type="hidden" name="task" value="send_package" />
                                <a class="button-link special-green" onClick="submitAjax(this)"> Gửi hàng </a>
                                <div class="ajax_response alert dismissable"></div>
                            </form>
                        <?php
                            }
                        ?>
                        <?php
                            if( $value['package_cn_status']==1 ){
                        ?>
                                <span class="black"><?php echo $value['receive_name_cn']; ?></span> 
                                <?php echo ( $value['package_cn_status']==1 )?($value['cn_package_receive_date']):''; ?>
                        <?php
                            }
                        ?>
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