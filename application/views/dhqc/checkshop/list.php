<?php $this->load->view('_base/head'); ?>
<?php 
    // echo "<pre>";
    // print_r($data_shipid_null);
?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>checkshop">Danh sách chờ mua hàng</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>

    <!-- Danh sách đơn chờ mua hàngp -->
    <div class="box_order_pending clearfix">
        <h2 class="title "> Danh sách đơn chờ mua hàng</h2>
        <div class="checkshop clearfix">
            <div class="store_hn">
                <h2 class="title align-center green">Kho Hà Nội</h2>
                <div class="gridtable">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   STT
                                </td>
                                <td>    
                                   Mã đơn
                                </td>
                            </tr>
                        <?php
                        $stt=1;
                        foreach ($data_order_pending as $key_order_pending => $value_order_pending) {
                            if( $value_order_pending['store'] ==0){
                        ?>
                            <tr>
                                <td>
                                    <?php echo  $stt; ?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('orders/detail/'.$value_order_pending['id']); ?>"><?php echo $value_order_pending['invoiceid'] ?></a>
                                </td>
                            </tr>
                        <?php
                            $stt++;
                            }//end if
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="store_sg">
                <h2 class="title align-center black">Kho Sài Gòn</h2>
                <div class="gridtable">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   STT
                                </td>
                                <td>    
                                   Mã đơn
                                </td>
                            </tr>
                        <?php
                        $stt=1;
                        foreach ($data_order_pending as $key_order_pending => $value_order_pending) {
                            if( $value_order_pending['store'] ==1){
                        ?>
                            <tr>
                                <td>
                                    <?php echo  $stt; ?>
                                </td>
                                <td>
                                   <a href="<?php echo site_url('orders/detail/'.$value_order_pending['id']); ?>"><?php echo $value_order_pending['invoiceid'] ?></a>
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
            </div>
    </div>
    

    <!-- Danh sách các đơn chưa đủ má Shop -->
    <div class="box_shop clearfix">
        <h2 class="title "> Danh sách các đơn chưa đủ mã shop</h2>
        <div class="checkshop clearfix">
            <div class="store_hn">
                <h2 class="title align-center green">Kho Hà Nội</h2>
                <div class="gridtable">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   STT
                                </td>
                                <td>    
                                   Mã đơn
                                </td>
                            </tr>
                        <?php
                        $stt=1;
                        foreach ($data_shopid_null as $key_shop => $value_shop) {
                            if( $value_shop['store'] ==0){
                        ?>
                            <tr>
                                <td>
                                    <?php echo  $stt; ?>
                                </td>
                                <td>
                                    <div class="orange">
                                         <a href="<?php echo site_url('orders/detail/'.$value_shop['oid']); ?>"><?php echo $value_shop['invoiceid'] ?></a>
                                    </div>
                                    <div class="black">
                                        (<?php echo $value_shop['sellername'] ?>)
                                    </div>
                                    <div class="update_shopid">
                                        <form action="" class="ajaxFormShopid" method="POST" >
                                            <div class="ghost">
                                                <input type="text" value="<?php echo $value_shop['shopid']; ?>" size="6" name="shopid">
                                                <a class="button-link" onClick="submitAjax(this)">Cập nhật</a>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $value_shop['id']; ?>" />
                                            <input type="hidden" name="controller" value="checkshop" />
                                            <input type="hidden" name="task" value="updateShopid" />
                                            
                                            <div class="ajax_response alert dismissable"></div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $stt++;
                            }//end if
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="store_sg">
                <h2 class="title align-center black">Kho Sài Gòn</h2>
                <div class="gridtable">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   STT
                                </td>
                                <td>    
                                   Mã đơn
                                </td>
                            </tr>
                        <?php
                        $stt=1;
                        foreach ($data_shopid_null as $key_shop => $value_shop) {
                            if( $value_shop['store'] ==1){
                        ?>
                            <tr>
                                <td>
                                    <?php echo  $stt; ?>
                                </td>
                                <td>
                                    <div class="orange">
                                         <a href="<?php echo site_url('orders/detail/'.$value_shop['oid']); ?>"><?php echo $value_shop['invoiceid'] ?></a>
                                    </div>
                                    <div class="black">
                                        (<?php echo $value_shop['sellername'] ?>)
                                    </div>
                                    <div class="update_shopid">
                                        <form action="" class="ajaxFormShopid" method="POST" >
                                            <div class="ghost">
                                                <input type="text" value="<?php echo $value_shop['shopid']; ?>" size="6" name="shopid">
                                                <a class="button-link" onClick="submitAjax(this)">Cập nhật</a>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $value_shop['id']; ?>" />
                                            <input type="hidden" name="controller" value="checkshop" />
                                            <input type="hidden" name="task" value="updateShopid" />
                                            
                                            <div class="ajax_response alert dismissable"></div>
                                        </form>
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
            </div>
        </div>
    </div>

    <!-- Danh sách các Shop chưa có phí nội địa -->
    <div class="box_shop clearfix">
        <h2 class="title ">Danh sách các Shop chưa có phí nội địa</h2>
        <div class="checkshop clearfix">
            <div class="store_hn">
                <h2 class="title align-center green">Kho Hà Nội</h2>
                <div class="gridtable">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   STT
                                </td>
                                <td>    
                                   Mã đơn
                                </td>
                            </tr>
                        <?php
                        $stt=1;
                        foreach ($data_freeshipnd_null as $key_shop => $value_shop) {
                            if( $value_shop['store'] ==0){
                        ?>
                            <tr>
                                <td>
                                    <?php echo  $stt; ?>
                                </td>
                                <td>
                                    <div class="orange">
                                         <a href="<?php echo site_url('orders/detail/'.$value_shop['oid']); ?>"><?php echo $value_shop['invoiceid'] ?></a>
                                    </div>
                                    <div class="black">
                                        (<?php echo $value_shop['sellername'] ?>)
                                    </div>
                                    <div class="update_freeship">
                                        <form action="" class="ajaxFormFreeShip" method="POST" >
                                            <div class="ghost">
                                                <input type="text" value="<?php echo $value_shop['fee_shipnd']; ?>" size="6" name="fee_shipnd">
                                                <a class="button-link" onClick="submitAjax(this)">Cập nhật</a>
                                            </div>
                                            <input type="checkbox" name="check_free_shipnd" value="0"> Free ship
                                            <input type="hidden" name="id" value="<?php echo $value_shop['id']; ?>" />
                                            <input type="hidden" name="controller" value="checkshop" />
                                            <input type="hidden" name="task" value="updateFreeShip" />
                                            
                                            <div class="ajax_response alert dismissable"></div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $stt++;
                            }//end if
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="store_sg">
                <h2 class="title align-center black">Kho Sài Gòn</h2>
                <div class="gridtable">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   STT
                                </td>
                                <td>    
                                   Mã đơn
                                </td>
                            </tr>
                        <?php
                        $stt=1;
                        foreach ($data_freeshipnd_null as $key_shop => $value_shop) {
                            if( $value_shop['store'] ==1){
                        ?>
                            <tr>
                                <td>
                                    <?php echo  $stt; ?>
                                </td>
                                <td>
                                    <div class="orange">
                                         <a href="<?php echo site_url('orders/detail/'.$value_shop['oid']); ?>"><?php echo $value_shop['invoiceid'] ?></a>
                                    </div>
                                    <div class="black">
                                        (<?php echo $value_shop['sellername'] ?>)
                                    </div>
                                    <div class="update_freeship">
                                        <form action="" class="ajaxFormFreeShip" method="POST" >
                                            <div class="ghost">
                                                <input type="text" value="<?php echo $value_shop['fee_shipnd']; ?>" size="6" name="fee_shipnd">
                                                <a class="button-link" onClick="submitAjax(this)">Cập nhật</a>
                                            </div>
                                            <input type="checkbox" name="check_free_shipnd" value="0"> Free ship
                                            <input type="hidden" name="id" value="<?php echo $value_shop['id']; ?>" />
                                            <input type="hidden" name="controller" value="checkshop" />
                                            <input type="hidden" name="task" value="updateFreeShip" />
                                            
                                            <div class="ajax_response alert dismissable"></div>
                                        </form>
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
            </div>
        </div>
    </div>


    <!-- Danh sách các Shop chưa có mã vận đơn -->
    <div class="box_shop clearfix">
        <h2 class="title ">Danh sách các Shop chưa có mã vận đơn</h2>
        <div class="checkshop clearfix">
            <div class="store">
                <div class="gridtable">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                   STT
                                </td>
                                <td>    
                                   Đơn hàng
                                </td>
                               <td>
                                   Kho hàng
                                </td>
                                <td>    
                                   Mã shop
                                </td>
                               <td>
                                   Mã vận đơn
                                </td>
                            </tr>
                        <?php
                        $stt=1;
                        foreach ($data_shipid_null as $key_shipid_null => $value_shipid_null) {
                        ?>
                            <tr>
                                <td>
                                   <?php echo $stt; ?>
                                </td>
                                <td>    
                                  <div class="orange"><?php echo $value_shipid_null['invoiceid'] ?></div>
                                  <div class="black"><?php echo $value_shipid_null['sellername'] ?></div>
                                </td>
                               <td>
                                   <?php echo getStoreText($value_shipid_null['store']); ?>
                                </td>
                                <td>    
                                   <?php echo $value_shipid_null['shopid'] ?>
                                </td>
                               <td>
                                    <div class="update_shipid">
                                        <form action="" class="ajaxFormShipid" method="POST" >
                                            <div class="ghost">
                                                <input type="text" value="<?php echo $value_shipid_null['shipid']; ?>" size="6" name="shipid">
                                                <a class="button-link" onClick="submitAjax(this)">Cập nhật</a>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $value_shipid_null['id_table_ships']; ?>" />
                                            <input type="hidden" name="controller" value="checkshop" />
                                            <input type="hidden" name="task" value="updateShipid" />
                                            
                                            <div class="ajax_response alert dismissable"></div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $stt++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>


<?php $this->load->view('_base/footer'); ?>