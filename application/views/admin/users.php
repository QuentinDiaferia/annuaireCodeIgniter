<?php
$this->lang->load(array('users', 'links'));
?>
<div class="col-sm-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $this->lang->line('panel-heading'); ?>
        </div>

        <div class="panel-body">
            
            <a href="<?php echo site_url('admin/addUser'); ?>">
                <span class="glyphicon glyphicon-plus-sign"></span> 
                <?php echo $this->lang->line('link_add'); ?>
            </a>

            <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('label_members'); ?></th>
                        <th colspan="3"><?php echo $this->lang->line('label_actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($listUsers as $user) {
                        ?>

                        <tr>
                            <td>
                                <?php echo html_escape($user['lastname']).' '.html_escape($user['firstname']); ?>
                            </td>
                            <td>
                                <?php
                                echo '<a href="'.site_url('admin/editUser/'.html_escape($user['id'])).'">'.$this->lang->line('link_edit').'</a>';
                                ?>
                            </td>
                            <td>
                                <?php
                                if($user['active'])
                                    echo '<a href="'.site_url('admin/user/deactivate/'.html_escape($user['id'])).'">'.$this->lang->line('link_deactivate').'</a>';
                                else
                                    echo '<a href="'.site_url('admin/user/activate/'.html_escape($user['id'])).'">'.$this->lang->line('link_activate').'</a>';
                                ?>
                            </td>
                            <td>
                                <?php echo '<a href="'.site_url('admin/user/delete/'.html_escape($user['id'])).'">Supprimer</a>';
                                ?>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>