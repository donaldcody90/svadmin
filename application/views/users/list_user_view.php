<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>users">User List</a></li>
    <li><a href="<?php echo site_url(); ?>users/add">Add new</a></li>
</ul>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">User List</h2>
    <div class="filer_box">
         <form action="<?php echo site_url('users/list_user') ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($_GET['filter_id'])?$_GET['filter_id']:''; ?>" name="filter_id">
            Username:<input type="text" value="<?php echo isset($_GET['filter_username'])?$_GET['filter_username']:''; ?>" name="filter_username">
            Firstname:<input type="text" value="<?php echo isset($_GET['filter_firstname'])?$_GET['filter_firstname']:''; ?>" name="filter_firstname">
            Lastname:<input type="text" value="<?php echo isset($_GET['filter_lastname'])?$_GET['filter_lastname']:''; ?>" name="filter_lastname">
            Email:<input type="text" value="<?php echo isset($_GET['filter_email'])?$_GET['filter_email']:''; ?>" name="filter_email">
            Role:
            <select name="filter_role">
                <option value="">Choose user role</option>
                <option value="Administrator" <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']=='Administrator' )?'selected':''; ?>>Administrator</option>
                <option value="Customer" <?php echo (isset($_GET['filter_role']) && $_GET['filter_role']=='Customer' )?'selected':''; ?>>Customer</option>
            </select>
            <input class="button" type="submit" value="Search">
        </form> 
    </div>
    <div class="gridtable">
        <table>
            <tbody>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                        Username
                    </td>
                    <td>
                        Firstname
                    </td>
                    <td>
                        Lastname
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        Role
                    </td>
					<td>Action</td>
                </tr>
                <?php foreach ($result as $key => $value) { ?>
					<tr>
						<td><?php echo $value->id ; ?></td>
						<td><?php echo $value->username ; ?></td>
						<td><?php echo $value->firstname ; ?></td>
						<td><?php echo $value->lastname ; ?></td>
						<td><?php echo $value->email ; ?></td>
						<td><?php echo $value->role ; ?></td>
						<td>
							<a href="<?php echo site_url() . 'users/update/' . $value->id; ?>">Edit</a>
							<a href="<?php echo site_url() . 'users/delete_user/' . $value->id; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
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