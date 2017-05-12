<?php
$this->lang->load(array('users', 'links'));
?>
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
                    <th>
                    <?php
                    echo $this->lang->line('label_members');
                    if($direction == 'ASC') {
                        ?>
                        <a href="<?php echo site_url('admin/users/desc'); ?>">
                            <span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span>
                        </a>
                        <?php
                    }
                    else {
                        ?>
                        <a href="<?php echo site_url('admin/users'); ?>">
                            <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>
                        </a>
                        <?php
                    }
                    ?>
                    </th>
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
                        <td class="actions">
                            <?php
                            echo '<a href="'.site_url('admin/editUser/'.html_escape($user['id'])).'">'.$this->lang->line('link_edit').'</a>';
                            ?>
                        </td>
                        <?php
                        if($user['id'] != $this->session->id) {
                            ?>
                            <td class="actions">
                                <?php
                                if($user['active'])
                                    echo '<a href="'.site_url('admin/user/deactivate/'.html_escape($user['id'])).'?t='.$this->session->token.'">'.$this->lang->line('link_deactivate').'</a>';
                                else
                                    echo '<a href="'.site_url('admin/user/activate/'.html_escape($user['id'])).'?t='.$this->session->token.'">'.$this->lang->line('link_activate').'</a>';
                                ?>
                            </td>
                            <td class="actions">
                                <?php
                                echo '<a href="#" onclick="deleteConfirmation(\''.site_url('admin/user/delete/'.html_escape($user['id'])).'?t='.$this->session->token.'\')">'.$this->lang->line('link_delete').'</a>';
                                ?>
                            </td>
                            <?php
                        }
                        else {
                            ?>

                            <td class="actions" colspan="2">
                            </td>
                            
                            <?php
                        }
                        ?>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function deleteConfirmation(link) {
    var txt;
    var r = confirm("<?php echo $this->lang->line('delete_confirmation'); ?>");
    if (r == true) {
        document.location.href = link;
    }
}
</script>