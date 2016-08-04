<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>users/list_user">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>users/add">Thêm mới</a></li>
</ul>
<div id="content" class="container fullwidth">
     <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Chỉnh sửa tài khoản</h2>
    <form name="edit" action="<?php echo site_url().'users/update/'.$data['0']->id; ?>" method="POST">
	
        <div class="group-input">
            <label class="label_input">Username <span class="red">*</span></label>
            <input placeholder="Username" type="text" value="<?php echo $data['0']->username; ?>" name="username" required="">
		</div>
        
		<div class="group-input">
            <label class="label_input">Firstname <span class="red">*</span></label>
            <input placeholder="Firstname" type="text" value="<?php echo $data['0']->firstname; ?>" name="firstname" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">Lastname <span class="red">*</span></label>
            <input placeholder="Lastname" type="text" value="<?php echo $data['0']->lastname; ?>" name="lastname" required="">
        </div>
		
        <div class="group-input">
            <label class="label_input">Email <span class="red">*</span></label>
            <input placeholder="Email" type="text" value="<?php echo $data['0']->email; ?>" name="email" required="">
		</div>
		
        <div class="group-input">
            <label class="label_input">Password <span class="red">*</span></label>
            <input placeholder="Password" type="text" value="******" name="password" required="">
		</div>
		
        <!--<div class="group-input">
            <label class="label_input">Role <span class="red">*</span></label>
            <select name="role" required="">
                <option value="Administrator" <?php //echo ($data['0']->role =='Administrator')?'selected':'';  ?>>Administrator</option>
                <option value="Customer" <?php //echo ($data['0']->role =='Customer')?'selected':'';  ?>>Customer</option>
            </select>
        </div>-->
		
      <!--   <input type="hidden" name="uid" value="1"> -->
        
        <input type="submit" name="save" value="Lưu">
    </form>
</div>
<?php $this->load->view('_base/footer'); ?>