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
    <h2 class="title "> Danh sách khiếu nại Shop</h2>
    <div class="list_status clearfix">
        <ul>
            <li>
                <a href="#" class="black">
                Tòan bộ : <span>(2)</span>
                </a>
            </li>
            <li>
                <a href="#" class="red">
                Đã hủy : <span>(0)</span>
                </a>
            </li>
            <li>
                <a href="#" class="orange">
                Chờ khiếu nại : <span>(1)</span>
                </a>
            </li>
            <li>
                <a href="#" class="blue">
                Đang khiếu nại : <span>(1)</span>
                </a>
            </li>
            <li>
                <a href="#" class="green">
                Khiếu nại thành công: <span>(1)</span>
                </a>
            </li>
            <li>
                <a href="#" class="red">
                Khiếu nại thất bại: <span>(1)</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="filer_box">
         <form action="<?php echo site_url('orders/lists') ?>" method="GET">
            Mã hóa đơn:<input type="text" value="" name="">
            Mã shop:<input type="text" value="" name="">
            Username khách hàng:<input type="text" value="" name="">
            Tư vấn:<input type="text" value="" name="">
            Người tạo:
                <select name="">
                    <option value="">Tất cả</option>
                    <option value="">Demo</option>
                </select>
            Mua hàng:
                <select name="">
                    <option value="">Tất cả</option>
                    <option value="">Demo</option>
                </select>
            <input class="button" type="submit" value="Tìm kiếm" >
        </form> 
    </div>
    <div class="gridtable">
        <table>
            <tbody>
                <tr>
                    <td width="2%">
                        STT
                    </td>
                    <td width="2%">
                        ID
                    </td>
                    <td width="10%">
                        Ngày tạo/Đơn hàng
                    </td>
                    <td width="28%">
                        Thông tin sản phẩm
                    </td>
                    <td width="10%">
                        Giá/Số lượng
                    </td>
                    <td width="30%">
                        Ghi chú
                    </td>
                    <td width="10%">
                        Trạng thái
                    </td>
                    <td width="8%">
                        Chỉnh sửa
                    </td>
                </tr>
                <tr>
                    <td class="align-center">
                       2                       
                    </td>
                    <td>
                        <span class="green">123</span> 
                    </td>
                    <td>
                        <div class="blue">20-6-2016</div> 
                        <div class="orange">TranBa 25-6-2016</div>
                        <div class="green">124234235345345</div>
                        <div>(Vđ: )</div>
                    </td>
                    <td>
                        <div class="clearfix">
                            <div class="image">
                                <img src="//gd4.alicdn.com/bao/uploaded/i4/333626664/TB2YgbSnFXXXXXlXXXXXXXXXXXX_!!333626664.jpg_600x600.jpg" width="100px" height="100px">
                            </div>
                            <div class="info">
                                <div class="link">
                                    <a href="https://world.taobao.com/item/530658793267.htm?spm=a21bp.7806943.topsale_XX.2.3BxFdq" target="_blank" class="orange">
                                       Quấn Kaki Nhật
                                     </a>
                                </div>
                                <div class="title">
                                    S;肌理黑                                       
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>Giá: <span class="red">140</span> NDT</div>
                        <div>SI đặt: <span class="black">1</span> </div>
                        <div>SI mua được: <span class="green">1</span> </div>                                                    
                    </td>
                    <td>
                         <div>
                             <form action="" method="" enctype="multipart/form-data">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload" name="submit">
                             </form>
                         </div>
                         <div class="note">
                             <div>
                                 <b>hien.dc</b> [20-10-2016] : Shop chuyển hàng chậm quá
                             </div>
                             <div>
                                 <b>anh.dc</b> [20-10-2016] : Uk
                             </div>
                             <div>
                                 <b>hien.dc</b> [20-10-2016] : Shop chuyển hàng chậm quá
                             </div>
                             <div>
                                 <b>anh.dc</b> [20-10-2016] : Uk
                             </div>
                             <div>
                                 <b>hien.dc</b> [20-10-2016] : Shop chuyển hàng chậm quá
                             </div>
                             <div>
                                 <b>anh.dc</b> [20-10-2016] : Uk
                             </div>
                         </div>
                    </td>
                    <td>
                        <div class="orange">Chờ khiếu nại</div>
                        <div class="black">hien.dc</div>                   
                    </td>
                    <td>
                        <span>Hàng khá tốt</span>
                    </td>
                </tr>
                <tr>
                    <td class="align-center">
                       1                       
                    </td>
                    <td>
                        <span class="green">123</span> 
                    </td>
                    <td>
                        <div class="blue">20-6-2016</div> 
                        <div class="orange">TranBa 25-6-2016</div>
                        <div class="green">124234235345345</div>
                        <div>(Vđ: )</div>
                    </td>
                    <td>
                        <div class="clearfix">
                            <div class="image">
                                <img src="//gd4.alicdn.com/bao/uploaded/i4/333626664/TB2YgbSnFXXXXXlXXXXXXXXXXXX_!!333626664.jpg_600x600.jpg" width="100px" height="100px">
                            </div>
                            <div class="info">
                                <div class="link">
                                    <a href="https://world.taobao.com/item/530658793267.htm?spm=a21bp.7806943.topsale_XX.2.3BxFdq" target="_blank" class="orange">
                                       Quấn Kaki Nhật
                                     </a>
                                </div>
                                <div class="title">
                                    S;肌理黑                                       
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>Giá: <span class="red">140</span> NDT</div>
                        <div>SI đặt: <span class="black">1</span> </div>
                        <div>SI mua được: <span class="green">1</span> </div>                                                    
                    </td>
                    <td>
                         <div>
                             <form action="" method="" enctype="multipart/form-data">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload" name="submit">
                             </form>
                         </div>
                         <div class="note">
                             <div>
                                 <b>hien.dc</b> [20-10-2016] : Shop chuyển hàng chậm quá
                             </div>
                             <div>
                                 <b>anh.dc</b> [20-10-2016] : Uk
                             </div>
                             <div>
                                 <b>hien.dc</b> [20-10-2016] : Shop chuyển hàng chậm quá
                             </div>
                             <div>
                                 <b>anh.dc</b> [20-10-2016] : Uk
                             </div>
                             <div>
                                 <b>hien.dc</b> [20-10-2016] : Shop chuyển hàng chậm quá
                             </div>
                             <div>
                                 <b>anh.dc</b> [20-10-2016] : Uk
                             </div>
                         </div>
                    </td>
                    <td>
                        <div class="orange">Chờ khiếu nại</div>
                        <div class="black">hien.dc</div>                   
                    </td>
                    <td>
                        <span>Hàng khá tốt</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>


<?php $this->load->view('_base/footer'); ?>