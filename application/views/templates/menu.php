<?php
if (isset($this->session->admin)) {
?>

<div class="col-sm-3">
    <div class="panel panel-default" id="menu">
        <div class="panel-heading">
            <?php
            if ($this->session->admin) {
                echo lang('menu_admin').'</div>
                <div class="panel-body">
                <a href="'.site_url('admin/users').'">'.lang('menu_users').'</a><br />
                <a href="'.site_url('admin/functions').'">'.lang('menu_functions').'</a><br />';
            } else {
                echo lang('menu_client').'</div>
                <div class="panel-body">';
            }
            ?>
        
            <a href="<?php echo site_url('annuaire'); ?>">
                <?php echo lang('menu_directory'); ?>
            </a>
            <br />
            <a href="<?php echo site_url('logout'); ?>">
                <?php echo lang('logout'); ?>
            </a>
        </div>
    </div>
</div>

<div class="col-sm-9">

<?php
}
?>