<?php
$this->lang->load(array('users', 'links'));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo lang('panel-heading'); ?>
    </div>

    <div class="panel-body">
        <?php

        if(validation_errors() != null) {
            echo '<div class="alert alert-danger">';
            echo validation_errors();
            echo '</div>';
        }


        if(isset($edit)) {
            echo form_open('admin/editUser/'.$user['id'], array('class' => 'form-horizontal'));
            echo '<p>'.lang('selected_user').' : '.html_escape($user['lastname']).' '.html_escape($user['firstname']).'</p>';
        }
        else
            echo form_open('admin/addUser', array('class' => 'form-horizontal'));
        ?>


            <?php
            if(!isset($user['id']) || $user['id'] != $this->session->id) {
                ?>
                <div class="form-group">
                    <label for="active" class="control-label col-sm-2">
                        <?php echo lang('label_active'); ?> *
                    </label>
                    <div class="radio col-sm-2"">
                        <label><input type="radio" name="active" value="0" required <?php
                        if(validation_errors() != '' || !isset($edit)) {
                            echo set_radio('active', '0');
                        }
                        else {
                            if(!$user['active'])
                                echo 'checked';
                        }
                        ?>>
                        <?php echo lang('label_no'); ?>
                        </label>
                    </div>
                    <div class="radio col-sm-8"">
                        <label><input type="radio" name="active" value="1" required <?php 
                        if(validation_errors() != '' || !isset($edit)) {
                            echo set_radio('active', '1', true);
                        }
                        else {
                            if($user['active'])
                                echo 'checked';
                        }
                        ?>>
                        <?php echo lang('label_yes'); ?>
                        </label>
                    </div>
                </div>
                <?php
            }
            ?>
        
            
            <div class="form-group">
                <label for="title" class="control-label col-sm-2">
                    <?php echo lang('label_title'); ?> *
                </label>
                <div class="radio col-sm-3"">
                    <label>
                        <input type="radio" name="title" value="mle" required <?php
                        if(validation_errors() != '' || !isset($edit)) {
                            echo set_radio('title', 'mle');
                        }
                        else {
                            if($user['title'] == 'mle')
                                echo 'checked';
                        }
                        ?>>
                        <?php echo lang('label_mle'); ?>
                    </label>
                </div>
                <div class="radio col-sm-3"">
                    <label>
                        <input type="radio" name="title" value="mad" required <?php
                        if(validation_errors() != '' || !isset($edit)) {
                            echo set_radio('title', 'mad');
                        }
                        else {
                            if($user['title'] == 'mad')
                                echo 'checked';
                        }
                        ?>>
                        <?php echo lang('label_mad'); ?>
                    </label>
                </div>
                <div class="radio col-sm-4"">
                    <label>
                        <input type="radio" name="title" value="mon" required <?php
                        if(validation_errors() != '' || !isset($edit)) {
                            echo set_radio('title', 'mon', true);
                        }
                        else {
                            if($user['title'] == 'mon')
                                echo 'checked';
                        }
                        ?>>
                        <?php echo lang('label_mon'); ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="control-label col-sm-2">
                    <?php echo lang('label_password'); ?> 
                    <?php if(!isset($edit)) echo '*'; ?>
                </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" <?php if(!isset($edit)) echo 'required'; ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="admin" class="control-label col-sm-2">
                    <?php echo lang('label_statut'); ?> *
                </label>
                <select class="col-sm-10" id="admin" name="admin">
                    <option value="0" <?php
                        if(isset($edit)) {
                            if(!$user['admin'])
                                echo 'selected';
                        }
                        else
                            echo set_select('admin', '0', true);
                        ?>>
                        <?php echo lang('label_client'); ?>
                    </option>
                    <option value="1" <?php
                        if(isset($edit)) {
                            if($user['admin'])
                                echo 'selected';
                        }
                        else
                            echo set_select('admin', '1', true);
                        ?>>
                        <?php echo lang('label_admin'); ?>
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="lastname" class="control-label col-sm-2">
                    <?php echo lang('label_lastname'); ?> *
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php
                    echo set_value('lastname', isset($user['lastname']) ? $user['lastname'] : '');
                    ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="control-label col-sm-2">
                    <?php echo lang('label_firstname'); ?>
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php
                    echo set_value('firstname', isset($user['firstname']) ? $user['firstname'] : '');
                    ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="birthday" class="control-label col-sm-2">
                    <?php echo lang('label_birthday'); ?>
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="birthday" name="birthday" value="<?php
                    echo set_value('birthday', isset($user['birthday']) ? date_create($user['birthday'])->format(lang('date_format')) : '');
                    ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="control-label col-sm-2">
                    <?php echo lang('label_address'); ?> *
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" value="<?php
                    echo set_value('address', isset($user['address']) ? $user['address'] : '');
                    ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address2" class="control-label col-sm-2">
                    <?php echo lang('label_address'); ?> 2
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address2" name="address2" value="<?php
                    echo set_value('address2', isset($user['address2']) ? $user['address2'] : '');
                    ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="postcode" class="control-label col-sm-2">
                    <?php echo lang('label_postcode'); ?> *
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="postcode" name="postcode" value="<?php
                    echo set_value('postcode', isset($user['postcode']) ? $user['postcode'] : '');
                    ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="control-label col-sm-2">
                    <?php echo lang('label_city'); ?> *
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="city" name="city" value="<?php
                    echo set_value('city', isset($user['city']) ? $user['city'] : '');
                    ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="country" class="control-label col-sm-2">
                    <?php echo lang('label_country'); ?> *
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="country" name="country" value="<?php
                    echo set_value('country', isset($user['country']) ? $user['country'] : '');
                    ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="telephone" class="control-label col-sm-2">
                    <?php echo lang('label_telephone'); ?> *
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telephone" name="telephone" value="<?php
                    echo set_value('telephone', isset($user['telephone']) ? $user['telephone'] : '');
                    ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="mobile" class="control-label col-sm-2">
                    <?php echo lang('label_mobile'); ?>
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php
                    echo set_value('mobile', isset($user['mobile']) ? $user['mobile'] : '');
                    ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">
                    <?php echo lang('label_email'); ?> *
                </label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?php
                    echo set_value('email', isset($user['email']) ? $user['email'] : '');
                    ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-default">
                <?php echo lang('button_validate'); ?>
            </button>
            <button type="reset" class="btn btn-default">
                <?php echo lang('button_reset'); ?>
            </button>
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo lang('legend'); ?>
    </div>
    <div class="panel-body">
        * 
        <em>
        <?php echo lang('required_field'); ?>
        </em>
    </div>
</div>