<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>users">Users</a></li>
    <li><a href="<?php echo site_url(); ?>users/add">Add user</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">User List</h2>
    <div class="filer_box">
         <form action="<?php echo site_url('users/lists') ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($_GET['filter_id'])?$_GET['filter_id']:''; ?>" name="filter_id">
            Username:<input type="text" value="<?php echo isset($_GET['filter_username'])?$_GET['filter_username']:''; ?>" name="filter_username">
            Fullname:<input type="text" value="<?php echo isset($_GET['filter_fullname'])?$_GET['filter_fullname']:''; ?>" name="filter_fullname">
            Email:<input type="text" value="<?php echo isset($_GET['filter_email'])?$_GET['filter_email']:''; ?>" name="filter_email">
            Role:
            <select name="filter_role">
                <option value="">Choose user role</option>
                <option value=0 <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']==0 )?'selected':''; ?>>Admin</option>
                <option value=1 <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']==1 )?'selected':''; ?>>Staff</option>
            </select>
            <input class="button" type="submit" value="Search">
            <a href="<?php echo site_url('users/lists') ?>"><input class="button" type="button" value="Clear"></a>
        </form> 
    </div>
    <div class="gridtable">
        <table>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>Username</td>
                    <td>Fullname</td>
                    <td>Email</td>
                    <td>Role</td>
					<td>Action</td>
                </tr>
                <?php foreach ($result as $key => $value) { ?>
					<tr>
						<td><?php echo $value->id ; ?></td>
						<td><?php echo $value->username ; ?></td>
						<td><?php echo $value->fullname ; ?></td>
						<td><?php echo $value->email ; ?></td>
						<td><?php echo getRoleText($value->role); ?></td>
						<td>
							<a class="edit" href="<?php echo site_url() . 'users/update/' . $value->id; ?>">Edit</a>
							<a class="delete" href="<?php echo site_url() . 'users/delete_user/' . $value->id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
							<button class="link_ajax" onclick="openPopup('<?php echo site_url('users/changepassword'); ?>',{cid:<?php echo  $value->id; ?>},600,500)">
								Change password
							</button>
						</td>
					</tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php   if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>
<?php $this->load->view('_base/footer'); ?>