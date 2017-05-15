<?php
$this->lang->load(array('contact'));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo lang('panel-heading'); ?>
    </div>

    <div class="panel-body">

        <div class="row">
            <label class="col-sm-3" style="text-align: right">
                <?php echo lang('selected_contact'); ?>
            </label>
            <div class="col-sm-9">
                <?php
                echo html_escape($contact['lastname']).' '.html_escape($contact['firstname']);
                ?>
            </div>
        </div>

        <br />

        <fieldset>
            <legend>
                <?php echo lang('fieldset_general'); ?>
            </legend>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_title'); ?>
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
                    <?php echo lang('label_lastname'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['lastname']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_firstname'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['firstname']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_telephone'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['telephone']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_mobile'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['mobile']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_fax'); ?>
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
                <?php echo lang('fieldset_detail'); ?>
            </legend>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_decisionmaker'); ?>
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
                    <?php echo lang('label_company'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['company']);
                    ?>
                </div>
            </div>
             <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_function_s'); ?>
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
                    <?php echo lang('label_address'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['address']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_address'); ?> 2
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['address2']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_postcode'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['postcode']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_city'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['city']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_country'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['country']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_website'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    echo html_escape($contact['website']);
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_email'); ?>
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
                <?php echo lang('fieldset_misc'); ?>
            </legend>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_photo'); ?>
                </label>
                <div class="col-sm-9">
                    <?php
                    if($contact['photo'] != null) {
                        echo '<a href="#" data-toggle="modal" data-target="#myModal"><img src="'.base_url('assets/img/picto.png').'" alt="picto" /></a>';
                        ?>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">
                                            <?php
                                            echo html_escape($contact['photo']);
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="<?php
                                        echo base_url('upload/'.html_escape($contact['photo']));
                                        ?>" alt=" <?php
                                        echo html_escape($contact['photo']);
                                        ?>" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Fermer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3" style="text-align: right">
                    <?php echo lang('label_comment'); ?>
                </label>
                <div class="col-sm-9">
                    <p>
                        <?php
                        echo nl2br(html_escape($contact['comment']));
                        ?>
                    </p>
                </div>
            </div>
        </fieldset>
    </div>
</div>