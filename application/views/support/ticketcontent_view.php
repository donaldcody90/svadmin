<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url(); ?>customers">Support List</a></li>
    <li><a href="<?php echo site_url(); ?>customers/add">Add new</a></li>
</ul>
<div class="ticket_page">
    <?php $this->load->view('_base/message'); ?>
	
    <div class="ticket_title">
		<div class="title">
			<span><?php echo $info[0]->c_title; ?><br></span>
			<p class="conv-info">
				Ticket #<?php echo $info[0]->c_id; ?>&nbsp;&nbsp;
				Opened <?php echo $info[0]->c_openingdate; ?>&nbsp;&nbsp;
				Status: <?php echo $info[0]->c_status; ?>
			</p>
		</div>
		
		<?php echo form_open(current_url()); ?>
			<textarea type="text" placeholder="Reply..." name="reply" ></textarea><br>
			<button type="submit" class="reply">Post Reply</button>
		</form>
		
		<?php echo form_open(base_url().'support/close_ticket/'.$info[0]->c_id, 'class="close-ticket"'); ?>
			<?php if($info[0]->c_status == 'opening'){ echo '<button>Close ticket</button>'; } ?>
		</form>
	</div>
	
	<div class="ticketcontent">
		<?php foreach($result as $row) { ?>
			<div class="<?php echo $row->role== 'Customer' ? 'message1' : 'message2'; ?>">
				<span><b><?php echo $row->username; ?>&nbsp;</b></span>
				<img class="image2" src="<?php echo $row->role== 'Administrator' ? site_url('static/images/logo2.png') : '' ; ?>" />
				<span class="date"><?php echo $row->m_date; ?></span><br>
				<p class="content"><?php echo $row->m_content; ?></p>
			</div>
		<?php } ?>
	</div>
	
    <?php echo $this->pagination->create_links(); ?>
    
</div>
<?php $this->load->view('_base/footer'); ?>