<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>storecn/lists_ship">Danh sách vận đơn nhập kho</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/ships">Nhập kho Trung Quốc</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/lists_package">Danh sách đóng bao</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/packages">Đóng bao kho Trung Quốc</a></li>
</ul>
<div id="content" class="container fullwidth">
<?php 
    // echo "<pre>";
    // print_r($data);
?>
    <?php $this->load->view('_base/message'); ?>

    <h2 class="title align-center"> Lưu mã nhập kho Trung Quốc </h2>
    <div class="frame_excel clearfix">
        <div class="desc">
            <p>
                1. Mỗi ngày lưa 1 file Excel viết liền không dấu(ví dụ hkt_20_10_2016.xls)
            </p>
            <p>
               2. <a href="<?php echo site_url('static/files_example/vandon.xls'); ?>"> Dowload bản mẫu </a>
            </p>
        </div>
        <form action="<?php echo base_url('storecn/upload_ship')?>" method="post" 
            enctype="multipart/form-data"> 
            <b>Chọn file Excel: </b>
            <input type="file" id="upload" name="upload"/>
            <input type="submit" name="upoad_file" value="Upload"/> 

            <?php
                if(isset($data) ){
            ?>
                    <div class="detail_storecn">
                        <div class="title">
                            Tổng số mã vận đơn :<span class="red"><?php echo count($data); ?></span>
                        <?php if( isset($status) && $status==1 ){ ?>
                               <input type="submit" name="save" class="button_special" value="Nhập kho"/> 
                        <?php } ?>
                        </div> 
                        <div class="gridtable">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>STT</td>
                                        <td>Mã vận đơn</td>
                                    </tr>
                                <?php
                                    $stt  = 0;
                                    foreach ($data as $key => $value) {
                                            $stt = $stt+1;
                                ?>
                                        <input type="hidden" name="shipid<?php echo $stt; ?>" value="<?php echo $value['A'] ?>">
                                        <tr>
                                            <td class="align-center"><?php echo $stt; ?></td>
                                            <td class="align-center"><?php echo $value['A']; ?></td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

            <?php
                }
            ?>
            <?php 
                if(isset($stt)){
            ?>
                    <input type="hidden" name="count" value="<?php echo $stt; ?>">
            <?php
                }
            ?>
        </form>
    </div>
</div>


<?php $this->load->view('_base/footer'); ?>