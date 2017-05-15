<?php
$this->lang->load(array('functions', 'links'));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo lang('panel-heading'); ?>
    </div>

    <div class="panel-body">

        <a href="<?php echo site_url('admin/addFunction'); ?>">
            <span class="glyphicon glyphicon-plus-sign"></span> 
            <?php echo lang('link_add'); ?>
        </a>

        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>
                        <?php 
                        echo lang('label_functions');
                        if($direction == 'ASC') {
                            ?>
                            <a href="<?php echo site_url('admin/functions/desc'); ?>">
                                <span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span>
                            </a>
                            <?php
                        }
                        else {
                            ?>
                            <a href="<?php echo site_url('admin/functions'); ?>">
                                <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>
                            </a>
                            <?php
                        }
                        ?>
                        
                    </th>
                    <th colspan="2"><?php echo lang('label_actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($listFunctions as $function) {
                    ?>

                    <tr>
                        <td><?php echo html_escape($function['name']); ?></td>
                        <td class="actions">
                            <?php
                            echo '<a href="'.site_url('admin/editFunction/'.$function['id']).'" role="button" class="btn btn-link">';
                            echo lang('link_edit');
                            echo '</a>';
                            ?>
                        </td>
                        <td class="actions">
                            <?php
                            if($function['active']) {
                                echo form_open('admin/function/deactivate/'.$function['id']);
                                echo '<button type="submit" class="btn btn-link">';
                                echo lang('link_deactivate');
                                echo '</button>';
                                echo form_close();
                            }
                            else {
                                echo form_open('admin/function/activate/'.$function['id']);
                                echo '<button type="submit" class="btn btn-link">';
                                echo lang('link_activate');
                                echo '</button>';
                                echo form_close();
                            }
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