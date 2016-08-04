<?php $this->load->view('_base/head'); ?>
<?php
    // echo "<pre>";
    // print_r($data);die;
    $shipid = $this->input->get('shipid');
?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>storevn/lists_ship">Danh sách vận đơn nhập kho</a></li>
    <li><a href="<?php echo site_url(); ?>storevn/lists_package">Danh sách đóng bao</a></li>
    <li><a href="<?php echo site_url(); ?>storevn/check_order">Kiểm hàng</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <div class="lists_ship clearfix">
	    <h2 class="align-center">Kiểm hàng</h2>
    </div>
    <div class="formSearchVandon">
        <form action="" method="get">
            Mã vận đơn : <input type="text" name="shipid" value="<?php echo isset( $shipid )?$shipid:''; ?>">
            <input class="button-link special-green" type="submit" name="search" value="Tìm kiếm">
        </form>
    </div>

<?php
    if( count($data)>0 ){
?>
        <div class="gridtable">
            <table>
                <tbody>
                    <tr>
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
                    <tr>
                        <td colspan="8">
                            Người bán : <span class="blue"> <?php echo $data['information_by_shipid']['sellername']; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="image">
                                <a href="<?php echo $data['information_by_shipid']['item_link']; ?>" target="_blank"><img src="<?php echo $data['information_by_shipid']['item_image']; ?>" width="100px" height="100px"></a>
                            </div>
                            <div class="info">
                                <div class="price">
                                    <a href="<?php echo $data['information_by_shipid']['item_link']; ?>" target="_blank">
                                    <span style="font-size:15px;font-weight:600;"><i class="fa fa-jpy" aria-hidden="true"></i> <?php echo $data['information_by_shipid']['item_price']; ?> </span>
                                    <?php echo $data['information_by_shipid']['item_title']; ?></a>
                                </div>
                                <div class="title">
                                    <?php echo $data['information_by_shipid']['item_attrs']; ?>
                                </div>
                                <div class="note_store_ship">
                                    <form name="" action="" class="ajaxFormNoteShip" method="POST" >
                                        <textarea name="item_note" rows="4" cols="35" placeholder="Lời nhắn"><?php //echo $value['note']; ?></textarea>
                                            <input type="hidden" name="shipid" value="<?php echo $data['shipid']; ?> ">
                                            <input type="hidden" name="controller" value="storevn" />
                                            <input type="hidden" name="task" value="updateNoteShip" />
                                            <div class="button-note">
                                                <a class="button-link" onClick="submitAjax(this)">Lưu</a>
                                            </div>
                                            <div class="ajax_response alert dismissable"></div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="red"><?php echo $data['information_by_shipid']['item_price']; ?></div>
                            <div class="red"><?php echo $data['total_fee_service']; ?> <span class="green">(tiền công)</span></div>
                        </td>
                        <td>
                            <form action="" class="ajaxFormItem" method="POST">
                                <input type="text" value="<?php echo $data['information_by_shipid']['item_quantity']; ?>" size="6" name="item_quantity">
                                <!--
                                <input type="hidden" name="id_item" value="18">
                                <input type="hidden" name="controller" value="orders">
                                <input type="hidden" name="task" value="update_item_quantity">
                                <a class="button-link" onclick="submitAjax(this)">Lưu</a>
                                <div class="ajax_response alert dismissable"></div>-->
                            </form>
                        </td>
                        <td>
                            <div class="red">
                                <?php echo $data['total_price']; ?>                               
                            </div>
                        </td>
                        <td rowspan="2">
                            <div>
                                <b>Mã shop: </b> <?php echo $data['information_by_shipid']['shopid']; ?>
                            </div>
                            <div>
                                <b>Phí nội địa: </b> <?php echo $data['information_by_shipid']['fee_shipnd']; ?>
                            </div>
                            <div>
                                <b>Mã vận đơn</b>: <?php echo $data['shipid']; ?> 
                                <?php
                                    if( $data['weight']!='' ){
                                ?>
                                        ( <?php echo $data['weight']; ?><span class="red">kg</span>)
                                <?php
                                    }
                                ?>
                            </div>
                            <form action="" class="ajaxForm_Ships" method="POST">
                                <div class="vandon_form">
                                    <b>Cân nặng (kg):</b>
                                    <input type="text" value="<?php echo $data['weight']; ?>" name="weight" size="6">
                                    <a class="button-link" onclick="submitAjax(this)">Lưu</a>
                                </div>
                                <div class="check_order bold">Mục kiểm hàng: </div>
                                <input type="hidden" name="check" value="0" <?php echo (isset($data['is_check']) && $data['is_check']==0 )?'checked':''; ?> >
                                <input type="checkbox" name="check" value="1" <?php echo (isset($data['is_check']) && $data['is_check']==1 )?'checked':''; ?>> 
                                 Đã kiểm hàng <a class="button-link" onclick="submitAjax(this)">Lưu</a>
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?> ">
                                <input type="hidden" name="shipid" value="<?php echo $data['shipid']; ?> ">
                                <input type="hidden" name="controller" value="storevn">
                                <input type="hidden" name="task" value="update_Ships">
                                <div class="ajax_response alert dismissable"></div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="total">
                            <div>
                                <div class="right">
                                    Sản phẩm : <span class="green"><?php echo $data['information_by_shipid']['item_quantity']; ?></span> |
                                    Tổng tiền : <span class="red"><?php echo $data['total_price']; ?></span>
                                    ( Thực mua : <span class="green"><?php echo $data['total_real_price']; ?></span> )
                                    ( Tiền Công :<span class="green"><?php echo $data['total_fee_service']; ?></span> ) 
                                    |
                                    Phí nội địa : <span class="green"><?php echo $data['information_by_shipid']['fee_shipnd']; ?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php 
        }elseif( count($data)==0 && isset($_GET['search']) ){
    ?>
           <div class="alert dismissable alert-error">Không tìm thấy kết quả</div>
    <?php
        }
    ?>
</div>


<?php $this->load->view('_base/footer'); ?>