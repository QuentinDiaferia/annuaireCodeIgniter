<?php
$this->lang->load(array('contact'));
?>
<div class="col-sm-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $this->lang->line('panel-heading'); ?>
        </div>

        <div class="panel-body">
            <p>
                <?php
                echo $this->lang->line('selected_contact').' : ';
                echo html_escape($contact['lastname']).' '.html_escape($contact['firstname']);
                ?>
            </p>

            <fieldset>
                <legend>
                    <?php echo $this->lang->line('fieldset_general'); ?>
                </legend>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_title'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        switch($contact['title']) {
                            case 'mad':
                                echo 'Madame';
                                break;
                            case 'mle':
                                echo 'Mademoiselle';
                                break;
                            default:
                                echo 'Monsieur';
                                break;
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_lastname'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['lastname']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_firstname'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['firstname']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_telephone'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['telephone']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_mobile'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['mobile']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_fax'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['fax']);
                        ?>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>
                    <?php echo $this->lang->line('fieldset_detail'); ?>
                </legend>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_decisionmaker'); ?>
                    </label>
                    <div class="col-sm-9"">
                        <?php
                        if($contact['decisionmaker'])
                            echo 'Oui';
                        else
                            echo 'Non';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_company'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['company']);
                        ?>
                    </div>
                </div>
                 <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_function_s'); ?> *
                        </label>
                    <div class="col-sm-9">
                        <?php
                        foreach($contact['function_names'] as $function) {
                            echo html_escape($function).'<br />';
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_address'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['address']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_address'); ?> 2
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['address2']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_postcode'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['postcode']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_city'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['city']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_country'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['country']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_website'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['website']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_email'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['email']);
                        ?>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>
                    <?php echo $this->lang->line('fieldset_misc'); ?>
                </legend>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_photo'); ?>
                    </label>
                    <div class="col-sm-9">
                        <?php
                        echo html_escape($contact['photo']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3" style="text-align: right">
                        <?php echo $this->lang->line('label_comment'); ?>
                    </label>
                    <div class="col-sm-9">
                        <p>
                            <?php
                            echo html_escape($contact['comment']);
                            ?>
                        </p>
                    </div>
                </div>
            </fieldset>

        </div>
    </div>
</div>