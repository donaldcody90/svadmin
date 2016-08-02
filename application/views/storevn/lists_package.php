<?php $this->load->view('_base/head'); ?>
<?php
    // echo "<pre>";
    // print_r($data);
?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>storevn/lists_ship">Danh sách vận đơn nhập kho</a></li>
    <li><a href="<?php echo site_url(); ?>storevn/lists_package">Danh sách đóng bao</a></li>
    <li><a href="<?php echo site_url(); ?>storevn/check_order">Kiểm hàng</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <div class="lists_ship clearfix">
	    <h2 class="float-left">Danh sách đóng bao tại kho Việt Nam</h2>
    </div>
    <div class="filer_box">
         <form action="<?php echo site_url('storevn/lists_package') ?>" method="GET">
            <?php
                $filter_package_cn_status = $this->input->get('filter_package_cn_status');
                $filter_name = $this->input->get('filter_name');
                $startdate = $this->input->get('filter_startdate_vn_package_receive_date');
                $enddate = $this->input->get('filter_enddate_vn_package_receive_date');
                $filter_package_vn_status = $this->input->get('filter_package_vn_status');
            ?>
            Nhãn:<input type="text" value="<?php echo isset($filter_name)?$filter_name:''; ?>" name="filter_name">
            Ngày:<input type="text" value="<?php echo isset($startdate )?$startdate:''; ?>" name="filter_startdate_vn_package_receive_date"> - <input type="text" value="<?php echo isset($enddate )?$enddate:''; ?>" name="filter_enddate_vn_package_receive_date">
            Tình trạng :
            <select name="filter_package_vn_status">
                <option value="" selected>Tất cả</option>
                <option value="0" <?php echo (isset($filter_package_vn_status) && $filter_package_vn_status==0 && $filter_package_vn_status!=NULL)?'selected':''; ?>>Chưa nhận</option>
                <option value="1" <?php echo (isset($filter_package_vn_status) && $filter_package_vn_status==1 )?'selected':''; ?>>Đã nhận</option>
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
                        Nhãn
                    </td>
                    <td>
                        Cân nặng(kg)
                    </td>
                    <td>
                        Trạng thái
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
                        <div class="green">
                           <?php echo $value['id']; ?>
                        </div>
                    </td>
                    </td>
                    <td>
                        <div class="green">
                            <?php echo $value['name']; ?>
                        </div>
                        (<spam class="red"><?php echo count( $value['listShips_by_Package'] ); ?></span> mã) <a href="<?php echo site_url('storevn/lists_ship?&filter_pid='.$value['id']); ?>">Danh sách mã</a>
                    </td>
                    <td>
                       <span class="red">
                           <?php echo $value['weight']; ?>
                       </span>
                    </td>
                    <td>
                        <span class="black"><?php echo $value['receive_name_cn']; ?></span> 
                        <span class="green"><?php echo getStorecnShipsText($value['package_cn_status']); ?></span>
                        <span class="blue"> <?php echo $value['cn_package_receive_date']; ?></span></br>
                        <?php
                            if( $value['package_cn_status']==1 && !isset($value['receive_name_vn'])){
                        ?>
                            <form action="" class="ajaxFormPackage" method="POST" >
                                <input type="hidden" name="id" value="<?php echo $value['id']; ?>" />
                                <input type="hidden" name="controller" value="storevn" />
                                <input type="hidden" name="task" value="send_package" />
                                <div class="button-check">
                                    <a class="button-link special-green" onClick="submitAjax(this)">Nhận hàng</a>
                                </div>
                                <div class="ajax_response alert dismissable"></div>
                            </form>
                        <?php
                            }
                        ?>

                        <?php

                            if( isset($value['receive_name_vn']) ){
                        ?>
                                <span class="black"><?php echo $value['receive_name_vn']; ?></span><span class="green">
                                <span class=""><?php echo getStorevnShipsText($value['package_cn_status']); ?></span>
                                <span class="blue"><?php echo $value['vn_package_receive_date']; ?></span>  
                        <?php
                            }
                        ?>
                    </td>
                    <td>
                        <form name="" action="" class="ajaxFormNotePackage" method="POST" >
                            <textarea name="order_note" rows="4" cols="35" placeholder=" Ghi chú"><?php echo $value['note']; ?></textarea>
                                <input type="hidden" name="id" value="<?php echo $value['id']; ?>" />
                                <input type="hidden" name="controller" value="storevn" />
                                <input type="hidden" name="task" value="updateNotePackage" />
                                <div class="button-note">
                                    <a class="button-link" onClick="submitAjax(this)">Lưu</a>
                                </div>
                                <div class="ajax_response alert dismissable"></div>
                        </form>
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