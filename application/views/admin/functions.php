<?php
$this->lang->load(array('functions', 'forms', 'links'));
?>
<div class="col-sm-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $this->lang->line('panel-heading'); ?>
        </div>

        <div class="panel-body">

            <a href="<?php echo site_url('admin/addFunction'); ?>">
                <span class="glyphicon glyphicon-plus-sign"></span> 
                <?php echo $this->lang->line('link_add'); ?>
            </a>

            <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('label_functions'); ?></th>
                        <th colspan="2"><?php echo $this->lang->line('label_actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($listFunctions as $function) {
                        ?>

                        <tr>
                            <td><?php echo html_escape($function['name']); ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/editFunction/'.$function['id']); ?>">
                                <?php echo $this->lang->line('link_edit'); ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                if($function['active'])
                                    echo '<a href="'.site_url('admin/function/deactivate/'.html_escape($function['id'])).'">'.$this->lang->line('link_deactivate').'</a>';
                                else
                                    echo '<a href="'.site_url('admin/function/activate/'.html_escape($function['id'])).'">'.$this->lang->line('link_activate').'</a>';
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