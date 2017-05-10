    <?php
    if(isset($this->session->admin)) {
    ?>

    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php
                if($this->session->admin) {

                    echo $this->lang->line('menu_admin').'</div>
                    <div class="panel-body">
                    <a href="'.site_url('admin/users').'">'.$this->lang->line('menu_users').'</a><br />
                    <a href="'.site_url('admin/functions').'">'.$this->lang->line('menu_functions').'</a><br />';

                }
                else {

                    echo $this->lang->line('menu_client').'</div>
                    <div class="panel-body">';
                }
                ?>
            
                <a href="<?php echo site_url('annuaire'); ?>">
                    <?php echo $this->lang->line('menu_directory'); ?>
                </a>
                <br />
                <a href="<?php echo site_url('logout'); ?>">
                    <?php echo $this->lang->line('logout'); ?>
                </a>
            </div>
        </div>
    </div>

    <?php
    }
    ?>