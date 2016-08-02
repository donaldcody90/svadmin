<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>users/lists">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>users/add">Thêm mới</a></li>
</ul>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title "> Chỉnh sửa tài khoản</h2>
    <form name="edit" action="" method="POST">
        <div class="group-input">
            <label class="label_input">Username <span class="red">*</span></label>
            <input placeholder="Username" type="text" readonly="" value="<?php echo $data['username']; ?>" name="username" required=""></div>
            <div class="group-input">
            <label class="label_input">Fullname <span class="red">*</span></label>
            <input placeholder="Phone" type="text" value="<?php echo $data['fullname']; ?>" name="fullname" required="">
        </div>
        <div class="group-input">
            <label class="label_input">Phone <span class="red">*</span></label>
            <input placeholder="Phone" type="text" value="<?php echo $data['phone']; ?>" name="phone" required="">
        </div>
        <div class="group-input">
            <label class="label_input">Email <span class="red">*</span></label>
            <input placeholder="Email" type="text" value="<?php echo $data['email']; ?>" name="email" required=""></div>
        <div class="group-input">
            <label class="label_input">Location <span class="red">*</span></label>
            <select name="location" required="">
                <option value="0" <?php echo ($data['location']==0)?'selected':'';  ?>>Hà Nội</option>
                <option value="1" <?php echo ($data['location']==1)?'selected':'';  ?>>Sài Gòn</option>
            </select>
        </div>
        <div class="group-input">
            <label class="label_input">Role <span class="red">*</span></label>
            <select name="role" required="">
                <option value="1" <?php echo ($data['role']==1)?'selected':'';  ?>>Admin</option>
                <option value="2" <?php echo ($data['role']==2)?'selected':'';  ?>>Quản lý</option>
                <option value="3" <?php echo ($data['role']==3)?'selected':'';  ?>>Tư vấn</option>
                <option value="4" <?php echo ($data['role']==4)?'selected':'';  ?>>Mua hàng</option>
                <option value="5" <?php echo ($data['role']==5)?'selected':'';  ?>>Kho - Trung Quốc</option>
                <option value="6" <?php echo ($data['role']==6)?'selected':'';  ?>>Kho - Việt Nam</option>
            </select>
        </div>
        <div class="group-input">
            <label class="label_input">Active <span class="red">*</span></label>
            <select name="isactive" required="">
                <option value="1" <?php echo ($data['isactive']==1)?'selected':'';  ?>>Active</option>
                <option value="0" <?php echo ($data['isactive']==0)?'selected':'';  ?>>Block</option>
            </select>
        </div>
      <!--   <input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Lưu">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>