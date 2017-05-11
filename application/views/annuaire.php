<?php
$this->lang->load(array('annuaire', 'forms', 'links'));
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->lang->line('panel-heading'); ?>
    </div>

    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $this->lang->line('reset'); ?>
                <a href="<?php echo site_url('annuaire/reset'); ?>">
                    <button type="submit" class="btn btn-default">Reset</button>
                </a>
            </div>
            <div class="panel-body">
                <?php
                echo form_open('filterBy/lastname', array('class' => 'form-horizontal'));
                ?>
                    <div class="form-group">
                        <label for="lastname" class="control-label col-sm-2">
                            <?php echo $this->lang->line('label_lastname'); ?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php
                            if($this->session->filter == 'lastname')
                                echo html_escape($this->session->value);
                            ?>">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-default">
                                <?php echo $this->lang->line('button_validate'); ?>
                            </button>
                            <button type="reset" class="btn btn-default">
                                <?php echo $this->lang->line('button_reset'); ?>
                            </button>
                        </div>
                    </div>
                </form>
                <?php
                echo form_open('filterBy//firstname', array('class' => 'form-horizontal'));
                ?>
                    <div class="form-group">
                        <label for="firstname" class="control-label col-sm-2">
                            <?php echo $this->lang->line('label_firstname'); ?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php
                            if($this->session->filter == 'firstname')
                                echo html_escape($this->session->value);
                            ?>">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-default">
                                <?php echo $this->lang->line('button_validate'); ?>
                            </button>
                            <button type="reset" class="btn btn-default">
                                <?php echo $this->lang->line('button_reset'); ?>
                            </button>
                        </div>  
                    </div>
                </form>
                <div class="row">
                    <label class="control-label col-sm-2" style="text-align: right">
                        <?php echo $this->lang->line('label_lastname'); ?>
                    </label>
                    <div class="col-sm-10">
                        <?php
                        foreach(range('A','Z') as $i) {
                            echo '<a href="'.site_url('filterBy/initial/'.$i).'">'.$i.'</a> ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <p>
            <strong>
                <?php echo $this->lang->line('nb_contacts'); ?> :
            </strong> 
            <?php echo $nbContacts; ?>
        </p>

        <?php
        if($this->session->admin) {
            ?>
            <a href="<?php echo site_url('admin/addContact'); ?>">
                <span class="glyphicon glyphicon-plus-sign"></span> 
                <?php echo $this->lang->line('link_add'); ?>
            </a>
            <?php
        }
        ?>

        <table class="table table-bordered table-hover table-condensed" id="annuaireTable">
            <thead>
                <tr>
                    <th>
                        <?php
                        echo $this->lang->line('label_company');
                        if($this->session->orderBy == 'company' && $this->session->direction == 'ASC') {
                            echo ' <a href="'.site_url('orderBy/company/DESC').'"><span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span></a>';
                        }
                        else {
                            echo ' <a href="'.site_url('orderBy/company/ASC').'"><span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span></a>';
                        }
                        ?>
                    </th>
                    <th>
                        <?php echo $this->lang->line('label_lastname');
                        if($this->session->orderBy == 'lastname' && $this->session->direction == 'ASC') {
                            echo ' <a href="'.site_url('orderBy/lastname/DESC').'"><span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span></a>';
                        }
                        else {
                            echo ' <a href="'.site_url('orderBy/lastname/ASC').'"><span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span></a>';
                        }
                        ?>
                    </th>
                    <th>
                        <?php echo $this->lang->line('label_firstname');
                        if($this->session->orderBy == 'firstname' && $this->session->direction == 'ASC') {
                            echo ' <a href="'.site_url('orderBy/firstname/DESC').'"><span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span></a>';
                        }
                        else {
                            echo ' <a href="'.site_url('orderBy/firstname/ASC').'"><span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span></a>';
                        }
                        ?>
                    </th>
                    <th>
                        <?php echo $this->lang->line('label_telephone');
                        if($this->session->orderBy == 'telephone' && $this->session->direction == 'ASC') {
                            echo ' <a href="'.site_url('orderBy/telephone/DESC').'"><span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span></a>';
                        }
                        else {
                            echo ' <a href="'.site_url('orderBy/telephone/ASC').'"><span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span></a>';
                        }
                        ?>
                    </th>
                    <th colspan="3"><?php echo $this->lang->line('label_actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($listContacts as $contact) {
                    ?>

                    <tr>
                        <td><?php echo html_escape($contact['company']); ?></td>
                        <td><?php echo html_escape($contact['lastname']); ?></td>
                        <td><?php echo html_escape($contact['firstname']); ?></td>
                        <td><?php echo html_escape($contact['telephone']); ?></td>
                        <?php
                        if($this->session->admin) {
                            ?>

                            <td class="actions">
                                <a href="<?php echo site_url('admin/editContact/'.html_escape($contact['id'])); ?>">
                                    <?php echo $this->lang->line('link_edit'); ?>
                                </a>
                            </td>
                            <td class="actions">
                                <?php
                                if($contact['active'])
                                    echo '<a href="'.site_url('admin/contact/deactivate/'.html_escape($contact['id'])).'?t='.$this->session->token.'">'.$this->lang->line('link_deactivate').'</a>';
                                else
                                    echo '<a href="'.site_url('admin/contact/activate/'.html_escape($contact['id'])).'?t='.$this->session->token.'">'.$this->lang->line('link_activate').'</a>';
                                ?>
                            </td>
                            <td class="actions">
                                <a href="#" onclick="deleteConfirmation('<?php echo site_url('admin/contact/delete/'.html_escape($contact['id'])).'?t='.$this->session->token; ?>')">
                                    <?php echo $this->lang->line('link_delete'); ?>
                                </a>
                            </td>

                            <?php
                        }
                        else {
                            ?>

                            <td colspan="3" class="actions">
                                <a href="<?php echo site_url('contact/'.html_escape($contact['id'])); ?>">
                                    <?php echo $this->lang->line('link_view'); ?>
                                </a>
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

        <?php
        if(isset($pagination))
            echo $pagination;
        ?>

        <?php
        if($this->session->admin) {
            ?>
            <a href="<?php echo site_url('admin/addContact'); ?>">
                <span class="glyphicon glyphicon-plus-sign"></span> 
                <?php echo $this->lang->line('link_add'); ?>
            </a>
            <?php
        }
        ?>
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