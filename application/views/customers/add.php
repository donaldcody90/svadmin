<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Thêm mới</a></li>
</ul>
<?php
    // echo "<pre>";
    // print_r($data);die;
?>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Thêm mới khách hàng</h2>
    <form name="edit" action="" method="POST">
        <div class="group-input">
            <label class="label_input">Username <span class="red"></span></label>
            <input placeholder="Username" type="text" value="" name="c_username" required="">
        </div>
        <div class="group-input">
            <label class="label_input">Fullname <span class="red"></span></label>
            <input placeholder="Phone" type="text" value="" name="c_fullname" required="">
        </div>
        <div class="group-input">
            <label class="label_input">Phone <span class="red"></span></label>
            <input placeholder="Phone" type="text" value="" name="c_phone" required="">
        </div>
        <div class="group-input">
            <label class="label_input">Email <span class="red"></span></label>
            <input placeholder="Email" type="text" value="" name="c_email" required="">
        </div>
        <div class="group-input">
            <label class="label_input">Yahoo <span class="red"></span></label>
            <input placeholder="Yahoo" type="text" value="" name="yahoo">
        </div>
        <div class="group-input">
            <label class="label_input">Skype <span class="red"></span></label>
            <input placeholder="Skype" type="text" value="" name="skype">
        </div>
        <div class="group-input">
            <label class="label_input">Address <span class="red"></span></label>
            <textarea name="address" rows="4" cols="25">
            </textarea>
        </div>
         <div class="group-input">
            <label class="label_input">Chọn kho hàng : <span class="red"></span></label>
            <select name="store" class="form-control" required="">
                <option value="">Chọn kho hàng</option>
                <option value="0" <?php echo (isset($data['store']) && $data['store']==0)?'selected':''; ?>>Kho Hà Nội</option>
                <option value="1" <?php echo (isset($data['store']) && $data['store']==1)?'selected':''; ?>>Kho Sài Gòn</option>
            </select>
        </div>
         <div class="group-input">
            <label class="label_input">Chọn dịch vụ : <span class="red"></span></label>
            <select name="onlyship" class="form-control" required="">
                <option value="">Chọn dịch vụ :</option>
                <option value="0" <?php echo (isset($data['onlyship']) && $data['onlyship']==0)?'selected':''; ?>>ORDER HÀNG - ĐHQC MUA và SHIP từ QC về VN</option>
                <option value="1" <?php echo (isset($data['onlyship']) && $data['onlyship']==1)?'selected':''; ?>>SHIP HỘ - Khách tự mua hàng, ĐHQC chỉ ship từ QC về VN</option>
            </select>
        </div>
         <div class="group-input">
            <label class="label_input">Chọn tư vấn : <span class="red">*</span></label>
            <select name="uid" required="">
                <option value="">Chọn tư vấn</option>
                <?php
                    foreach ($advisory as $key => $value) {
                ?>
                    <option value="<?php echo $value['uid']; ?>" <?php echo (isset($data['uid']) && $data['uid']==$value['uid'])?'selected':''; ?>><?php echo $value['username']; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
      <!--   <input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Lưu">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>