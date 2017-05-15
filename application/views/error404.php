<?php
$this->lang->load(array('error', 'links'));
?>
<div id="login">
	<div class="panel-panel-default">
		<div class="panel-body">
		    <div class="alert alert-danger">
		        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> 
		        <?php echo lang('error_404'); ?>
		    </div>

		    <p>
		        <a href="<?php echo site_url('/'); ?>"><?php echo lang('link_index'); ?></a>
		    </p>
		</div>
	</div>
</div>