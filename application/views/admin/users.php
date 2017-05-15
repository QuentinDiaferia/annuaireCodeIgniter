<?php
$this->lang->load(array('users', 'links'));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo lang('panel-heading'); ?>
    </div>

    <div class="panel-body">
        
        <a href="<?php echo site_url('admin/addUser'); ?>">
            <span class="glyphicon glyphicon-plus-sign"></span> 
            <?php echo lang('link_add'); ?>
        </a>

        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>
                    <?php
                    echo lang('label_members');
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
                    <th colspan="3"><?php echo lang('label_actions'); ?></th>
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
                            echo '<a href="'.site_url('admin/editUser/'.html_escape($user['id'])).'" role="button" class="btn btn-link">'.lang('link_edit').'</a>';
                            ?>
                        </td>
                        <?php
                        if($user['id'] != $this->session->id) {
                            ?>
                            <td class="actions">
                                <?php
                                if($user['active']) {
                                    echo form_open('admin/user/deactivate/'.$user['id']);
                                    echo '<button type="submit" class="btn btn-link">';
                                    echo lang('link_deactivate');
                                    echo '</button>';
                                    echo form_close();
                                }
                                else {
                                    echo form_open('admin/user/activate/'.$user['id']);
                                    echo '<button type="submit" class="btn btn-link">';
                                    echo lang('link_activate');
                                    echo '</button>';
                                    echo form_close();
                                }
                                ?>
                            </td>
                            <td class="actions">
                                <?php
                                echo form_open('admin/user/delete/'.$user['id'], array(
                                    'onsubmit' => 'return confirm(\''.lang('delete_confirmation').'\');')
                                );
                                echo '<button type="submit" class="btn btn-link">';
                                echo lang('link_delete');
                                echo '</button>';
                                echo form_close();
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