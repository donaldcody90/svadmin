<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Danh sách</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Thêm mới</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title "> Danh sách khách hàng</h2>
    <div class="filer_box">
        <?php
            $filter_cid = $this->input->get('filter_cid');
            $filter_c_username = $this->input->get('filter_c_username');
            $filter_c_fullname = $this->input->get('filter_c_fullname');
            $filter_c_phone = $this->input->get('filter_c_phone');
            $filter_c_email = $this->input->get('filter_c_email');
            $filter_yahoo = $this->input->get('filter_yahoo');
            $filter_skype = $this->input->get('filter_skype');
            $filter_store = $this->input->get('filter_store');
        ?>
        <form name="filter_form" action="<?php echo site_url("customers/lists"); ?>" method="GET">
            CID:<input type="text" value="<?php echo isset($filter_cid)?$filter_cid:''; ?>" name="filter_cid">
            Username:<input type="text" value="<?php echo isset($filter_c_username)?$_GET['filter_c_username']:''; ?>" name="filter_c_username">
            Họ Tên:<input type="text" value="<?php echo isset($filter_c_fullname)?$_GET['filter_c_fullname']:''; ?>" name="filter_c_fullname">
            Phone:<input type="text" value="<?php echo isset($filter_c_phone)?$_GET['filter_c_phone']:''; ?>" name="filter_c_phone">
            Email:<input type="text" value="<?php echo isset($filter_c_email)?$filter_c_email:''; ?>" name="filter_c_email">
            Yahoo:<input type="text" value="<?php echo isset($filter_yahoo)?$filter_yahoo:''; ?>" name="filter_yahoo" />
            Skype:<input type="text" value="<?php echo isset($filter_skype)?$filter_skype:''; ?>" name="filter_skype" />
            Kho hàng:<select name="filter_store">
                        <option value="">Chọn kho hàng</option>
                        <option value="0" <?php echo (isset($filter_store) && $filter_store==0 )?'selected':''; ?> >Hà Nội</option>
                        <option value="1" <?php echo (isset($filter_store) && $filter_store==1 )?'selected':''; ?> >Sài Gòn</option>
                    </select>
            
            <input class="button" type="submit" value="Tìm kiếm" />
        </form>
    </div>
    <div class="gridtable">
        <table>
            <tr>
				<td>ID</td>
				<td>Customer Name</td>
				<td>Title</td>
				<td>Last reply</td>
				<td>Status</td>
			</tr>
			<?php foreach($data as $key => $row){ ?>
			<tr>
				<td><?php echo $row->; ?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->username; ?></td>
			</tr>
			<?php } ?>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>