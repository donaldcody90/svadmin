<?php $this->load->view('_base/head'); ?>

<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>storecn/lists_ship">Danh sách vận đơn nhập kho</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/ships">Nhập kho Trung Quốc</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/lists_package">Danh sách đóng bao</a></li>
    <li><a href="<?php echo site_url(); ?>storecn/packages">Đóng bao kho Trung Quốc</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>

    <h2 class="title align-center">Đóng bao</h2>
    <div class="frame_excel clearfix">
        <div class="desc">
            <p>
                1. Mỗi ngày lưa 1 file Excel viết liền không dấu(ví dụ vandon_20_10_2016.xls)
            </p>
            <p>
                2. Trong mỗi file lưa mã mỗi bao trên mỗi cột
            </p>
            <p>
                3. Trong mỗi cột lưu <b>HÀNG 1</b> là <b>NHÃN GHI TRÊN BAO,HÀNG 2 </b> là <b>CÂN NẶNG</b> của bao
            </p>
            <p>
               4. <a href="<?php echo site_url('static/files_example/dongbao.xls'); ?>">Dowload bản mẫu </a>
            </p>
        </div>
        <form action="<?php echo base_url('storecn/upload_package')?>" method="post" 
            enctype="multipart/form-data"> 
            <input type="file" id="upload" name="upload"/>
            <input type="submit" name="upoad_file" value="Upload"/> 
            <?php if( isset($status) && $status==1 ){ ?>
                   <input type="submit" name="save" class="button_special" value="Đóng bao"/> 
            <?php } ?>
    <?php 
       // echo "<pre>";
       //  print_r($data);
    ?>
            <?php
                if(isset($data) ){
            ?>
                    <div class="detail_storecn">
                        <div class="gridtable">
                            <table>
                                <tbody>
                                    <input type="hidden" name="name_1" value="<?php echo $data[1]['A'] ?>">
                                    <input type="hidden" name="name_2" value="<?php echo $data[1]['B'] ?>">
                                    <input type="hidden" name="name_3" value="<?php echo $data[1]['C'] ?>">
                                    <tr>
                                        <td class="background-green"><?php echo $data[1]['A']; ?></td>
                                        <td class="background-orange"><?php echo $data[1]['B']; ?></td>
                                        <td class="background-red"><?php echo $data[1]['C']; ?></td>
                                    </tr>

                                    <input type="hidden" name="weight_1" value="<?php echo $data[2]['A'] ?>">
                                    <input type="hidden" name="weight_2" value="<?php echo $data[2]['B'] ?>">
                                    <input type="hidden" name="weight_3" value="<?php echo $data[2]['C'] ?>">
                                    <tr>
                                        <td class="background-green"><?php echo $data[2]['A']; ?> <span class="red">(kg)</span></td>
                                        <td class="background-orange"><?php echo $data[2]['B']; ?> <span class="red">(kg)</span></td>
                                        <td class="background-red"><?php echo $data[2]['C']; ?> <span class="red">(kg)</span></td>
                                    </tr>

                                    <?php
                                        $key = 1;
                                        foreach ($data as $key => $value) {

                                    ?>
                                    <?php
                                            if( $key>2 ){
                                    ?>
                                                <input type="hidden" name="label_A<?php echo $key; ?>" value="<?php echo ( isset($value['A']) )?$value['A']:'';  ?>">
                                                <input type="hidden" name="label_B<?php echo $key; ?>" value="<?php echo ( isset($value['B']) )?$value['B']:'';  ?>">
                                                <input type="hidden" name="label_C<?php echo $key; ?>" value="<?php echo ( isset($value['C']) )?$value['C']:'';  ?>">
                                                <tr>
                                                    <td class="background-green"><?php echo ( isset($value['A']) )?$value['A']:'';  ?></td>
                                                    <td class="background-orange"> <?php echo ( isset($value['B']) )?$value['B']:'';  ?></td>
                                                    <td class="background-red"><?php echo ( isset($value['C']) )?$value['C']:'';  ?></td>
                                                </tr>
                                    <?php
                                            }
                                        $key++;
                                        }
                                    ?>
                                    <input type="hidden" name="count_shipid" value="<?php echo ($key-3); ?>">
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
                    }
                ?>
        </form>
    </div>
</div>


<?php $this->load->view('_base/footer'); ?>