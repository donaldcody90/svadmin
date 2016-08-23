<?php $this->load->view('_base/head'); ?>
<ul id="dropdow_menu">
    <li><a href="<?php echo site_url('support'); ?>">Tikets</a></li>
    <li><a href="<?php echo site_url('support/categories'); ?>">Categories</a></li>
    <li><a href="<?php echo site_url('support/add'); ?>">Add category</a></li>
</ul>
<div class="ticket_page">
    <?php $this->load->view('_base/message'); ?>
	
    <div class="ticket_title">
		<div class="title">
			<span><?php echo $info['title']; ?><br></span>
			<p class="conv-info">
				Ticket #<?php echo $info['cid']; ?>&nbsp;&nbsp;
				Opened <?php echo $info['openingdate']; ?>&nbsp;&nbsp;
				Status: <?php echo getStatusConversation($info['status']); ?>
			</p>
		</div>
		
		<?php echo form_open(current_url()); ?>
			<textarea type="text" placeholder="Reply..." name="reply" required ></textarea><br>
			<button type="submit" class="reply">Post Reply</button>
		</form>
		
		<?php echo form_open(base_url().'support/closeTicket/'.$info['cid'], 'class="close-ticket"'); ?>
			<?php if($info['status'] == 1){ echo '<button>Close ticket</button>'; } ?>
		</form>
	</div>
	
	<div class="ticketcontent">
		<?php foreach($result as $row) { ?>
			<div class="<?php echo $row->role== null ? 'message1' : 'message2'; ?>">
				<span><b><?php echo $row->username; ?>&nbsp;</b></span>
				<img class="image2" src="<?php echo $row->role== null ? '' : site_url('static/images/logo2.png') ; ?>" />
				<span class="date"><?php echo $row->date; ?></span><br>
				<p class="content"><?php echo $row->content; ?></p>
			</div>
		<?php } ?>
	</div>
	
    <?php echo $this->pagination->create_links(); ?>
    
</div>
<?php $this->load->view('_base/footer'); ?>