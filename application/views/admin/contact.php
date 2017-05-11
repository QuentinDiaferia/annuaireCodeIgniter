<?php
$this->lang->load(array('contacts', 'links'));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->lang->line('panel-heading'); ?>
    </div>

    <div class="panel-body">

            <?php

            echo validation_errors();
            echo isset($error) ? $error : '';

            if(isset($edit)) {
                echo form_open_multipart('admin/editContact/'.html_escape($contact['id']), array('class' => 'form-horizontal'));
                echo '<p>'.$this->lang->line('selected_contact').' : '.html_escape($contact['lastname']).' '.html_escape($contact['firstname']).'</p>';
                echo '<p>'.$this->lang->line('date_modification').' '.date_create(html_escape($contact['lastmodified']))->format($this->lang->line('date_format')).' '.$this->lang->line('modified_by').' '.html_escape($contact['u_lastname']).' '.$contact['u_firstname'].'</p>';
            }
            else
                echo form_open_multipart('admin/addContact', array('class' => 'form-horizontal'));

            ?>

            <div class="form-group">
                <label for="active" class="control-label col-sm-2">
                    <?php echo $this->lang->line('label_active'); ?> *
                </label>
                <div class="radio col-sm-2">
                    <label><input type="radio" name="active" value="0" required <?php
                    if(validation_errors() != '' || !isset($edit)) {
                        echo set_radio('active', '0');
                    }
                    else {
                        if(!$contact['active'])
                            echo 'checked';
                    }
                    ?>>
                    <?php echo $this->lang->line('label_no'); ?>
                    </label>
                </div>
                <div class="radio col-sm-8">
                    <label><input type="radio" name="active" value="1" required <?php 
                    if(validation_errors() != '' || !isset($edit)) {
                        echo set_radio('active', '1', true);
                    }
                    else {
                        if($contact['active'])
                            echo 'checked';
                    }
                    ?>>
                    <?php echo $this->lang->line('label_yes'); ?>
                    </label>
                </div>
            </div>

            <fieldset>
                <legend>
                    <?php echo $this->lang->line('fieldset_general'); ?>
                </legend>
                <div class="form-group">
                    <label for="title" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_title'); ?> *
                    </label>
                    <div class="radio col-sm-3"">
                        <label>
                            <input type="radio" name="title" value="mle" required <?php
                            if(validation_errors() != '' || !isset($edit)) {
                                echo set_radio('title', 'mle');
                            }
                            else {
                                if($contact['title'] == 'mle')
                                    echo 'checked';
                            }
                            ?>>
                            <?php echo $this->lang->line('label_mle'); ?>
                        </label>
                    </div>
                    <div class="radio col-sm-3"">
                        <label>
                            <input type="radio" name="title" value="mad" required <?php
                            if(validation_errors() != '' || !isset($edit)) {
                                echo set_radio('title', 'mad');
                            }
                            else {
                                if($contact['title'] == 'mad')
                                    echo 'checked';
                            }
                            ?>>
                            <?php echo $this->lang->line('label_mad'); ?>
                        </label>
                    </div>
                    <div class="radio col-sm-4"">
                        <label>
                            <input type="radio" name="title" value="mon" required <?php
                            if(validation_errors() != '' || !isset($edit)) {
                                echo set_radio('title', 'mon', true);
                            }
                            else {
                                if($contact['title'] == 'mon')
                                    echo 'checked';
                            }
                            ?>>
                            <?php echo $this->lang->line('label_mon'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_lastname'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php
                        echo set_value('lastname', isset($contact['lastname']) ? $contact['lastname'] : '');
                        ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_firstname'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php
                        echo set_value('firstname', isset($contact['firstname']) ? $contact['firstname'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="telephone" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_telephone'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?php
                        echo set_value('telephone', isset($contact['telephone']) ? $contact['telephone'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_mobile'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php
                        echo set_value('mobile', isset($contact['mobile']) ? $contact['mobile'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fax" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_fax'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="fax" name="fax" value="<?php
                        echo set_value('fax', isset($contact['fax']) ? $contact['fax'] : '');
                        ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>
                    <?php echo $this->lang->line('fieldset_detail'); ?>
                </legend>
                <div class="form-group">
                    <label for="decisionmaker" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_decisionmaker'); ?>
                    </label>
                    <div class="radio col-sm-2"">
                        <label><input type="radio" name="decisionmaker" value="0" <?php
                        if(validation_errors() != '' || !isset($edit)) {
                            echo set_radio('decisionmaker', '0');
                        }
                        else {
                            if(!$contact['decisionmaker'])
                                echo 'checked';
                        }
                        ?>>
                        <?php echo $this->lang->line('label_no'); ?>
                        </label>
                    </div>
                    <div class="radio col-sm-8"">
                        <label><input type="radio" name="decisionmaker" value="1" <?php 
                        if(validation_errors() != '' || !isset($edit)) {
                            echo set_radio('decisionmaker', '1', true);
                        }
                        else {
                            if($contact['decisionmaker'])
                                echo 'checked';
                        }
                         ?>>
                         <?php echo $this->lang->line('label_yes'); ?>
                         </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="company" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_company'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="company" name="company" value="<?php
                        echo set_value('company', isset($contact['company']) ? $contact['company'] : '');
                        ?>" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="functions" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_function_s'); ?> *
                    </label>
                    <select class="col-sm-10" id="functions" name="functions[]" multiple>
                        <?php
                        foreach($functions as $function) {
                            echo '<option value="'.html_escape($function['id']).'"';
                            if(isset($edit)) {
                                if(in_array($function['id'], $contact['function_ids']))
                                    echo ' selected';
                            }
                            echo set_select('functions[]', $function['id']);
                            echo '>'.html_escape($function['name']).'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_address'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" value="<?php
                        echo set_value('address', isset($contact['address']) ? $contact['address'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address2" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_address'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address2" name="address2" value="<?php
                        echo set_value('address2', isset($contact['address2']) ? $contact['address2'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="postalcode" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_postcode'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="postcode" name="postcode" value="<?php
                        echo set_value('postcode', isset($contact['postcode']) ? $contact['postcode'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_city'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="city" name="city" value="<?php
                        echo set_value('city', isset($contact['city']) ? $contact['city'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_country'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="country" name="country" value="<?php
                        echo set_value('country', isset($contact['country']) ? $contact['country'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="website" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_website'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="website" name="website" value="<?php
                        echo set_value('website', isset($contact['website']) ? $contact['website'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_email'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?php
                        echo set_value('email', isset($contact['email']) ? $contact['email'] : '');
                        ?>">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>
                    <?php echo $this->lang->line('fieldset_misc'); ?>
                </legend>
                <div class="form-group">
                    <label for="photo" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_photo'); ?>
                    </label>
                    <div class="col-sm-10">
                        <div class="row">
                             <?php
                            if(isset($contact) && $contact['photo'] != null) {
                                ?>

                                <input type="hidden" name="oldPhoto" value="<?php
                                echo html_escape($contact['photo']);
                                ?>">

                                <div class="col-sm-2">
                                    <a href="#" data-toggle="modal" data-target="#myModal">
                                        <img src="<?php echo base_url('assets/img/picto.png'); ?>" alt="picto" />
                                    </a>
                                </div>
                                
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

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
                                                    <?php echo $this->lang->line('button_close'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>
                            <div class="col-sm-10">
                                <input type="file" id="photo" name="photo" value="<?php
                                echo set_value('value', isset($contact['value']) ? $contact['value'] : '');
                                ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_comment'); ?>
                    </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="comment" name="comment"><?php
                            echo set_value('comment', isset($contact['comment']) ? $contact['comment'] : '');
                        ?></textarea>
                    </div>
                </div>
            </fieldset>
            
            <button type="submit" class="btn btn-default">
                <?php echo $this->lang->line('button_validate'); ?>
            </button>
            <button type="reset" class="btn btn-default">
                <?php echo $this->lang->line('button_reset'); ?>
            </button>
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->lang->line('legend'); ?>
    </div>
    <div class="panel-body">
        * 
        <em>
        <?php echo $this->lang->line('required_field'); ?>
        </em>
    </div>
</div>