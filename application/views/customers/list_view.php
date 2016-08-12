<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Customer List</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Add new</a></li>
</ul>
<script>
$(document).ready(function(){
    $(".changepass-window").click(function(){
		$(".overlay").fadeIn();
        $(".contentPopup").fadeIn();
    });
	$(".overlay").click(function(){
		$(".overlay").fadeOut();
		$(".contentPopup").fadeOut();
	});
});
</script>
<div id="content" class="container fullwidth">
    <?php $this->load->view('_base/message'); ?>
    <h2 class="title ">Customer List</h2>
    <div class="filer_box">
         <form action="<?php echo site_url('customers/lists') ?>" method="GET">
            ID:<input type="text" value="<?php echo isset($_GET['filter_id'])?$_GET['filter_id']:''; ?>" name="filter_id">
            Username:<input type="text" value="<?php echo isset($_GET['filter_username'])?$_GET['filter_username']:''; ?>" name="filter_username">
            Fullname:<input type="text" value="<?php echo isset($_GET['filter_fullname'])?$_GET['filter_fullname']:''; ?>" name="filter_fullname">
            Email:<input type="text" value="<?php echo isset($_GET['filter_email'])?$_GET['filter_email']:''; ?>" name="filter_email">
            
            <input class="button" type="submit" value="Search">
            <a href="<?php echo site_url('customers/lists') ?>"><input class="button" type="button" value="Clear"></a>
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
					<td>Action</td>
                </tr>
                <?php foreach ($result as $key => $value) { ?>
					<tr>
						<td><?php echo $value->id ; ?></td>
						<td><?php echo $value->username ; ?></td>
						<td><?php echo $value->fullname ; ?></td>
						<td><?php echo $value->email ; ?></td>
						<td>
							<a class="edit" href="<?php echo site_url() . 'customers/update/' . $value->id; ?>">Edit</a>
							<a class="delete" href="<?php echo site_url() . 'customers/delete_user/' . $value->id; ?>" onclick="return confirm('Are you sure you want to delete?')">
								Delete
							</a>
							<button class="link_ajax" onclick="openPopup('<?php echo site_url('customers/changepassword'); ?>',{cid:<?php echo  $value->id; ?>},600,500)">
								Change password
							</button>
						</td>
					</tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
    <p><strong>Total: <span class="green"><?php if( isset($total_rows) && count($total_rows)>0 ){ echo $total_rows; } ?></span> (Items)</strong></p>
</div>

<?php //$this->load->view('ajax/changepass'); ?>


<?php $this->load->view('_base/footer'); ?>