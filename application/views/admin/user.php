<?php
$this->lang->load(array('users', 'forms', 'links'));
?>
<div class="col-sm-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $this->lang->line('panel-heading'); ?>
        </div>

        <div class="panel-body">
            <?php

            echo validation_errors();

            if(isset($edit)) {
                echo form_open('admin/editUser/'.html_escape($user['id']), array('class' => 'form-horizontal'));
                echo '<p>'.$this->lang->line('selected_user').' : '.html_escape($user['lastname']).' '.html_escape($user['firstname']).'</p>';
            }
            else
                echo form_open('admin/addUser', array('class' => 'form-horizontal'));

            ?>
                <div class="form-group">
                    <label for="active" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_active'); ?> *
                    </label>
                    <div class="radio col-sm-2"">
                        <label><input type="radio" name="active" value="0" required <?php
                        echo !$user['active'] ? set_radio('active', $user['active'], true) : set_radio('active', '0');
                        ?>>
                        <?php echo $this->lang->line('label_no'); ?>
                        </label>
                    </div>
                    <div class="radio col-sm-8"">
                        <label><input type="radio" name="active" value="1" required <?php 
                        echo $user['active'] ? set_radio('active', $user['active'], true) : set_radio('active', '1');
                        ?>>
                        <?php echo $this->lang->line('label_yes'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_title'); ?> *
                    </label>
                    <div class="radio col-sm-3"">
                        <label>
                            <input type="radio" name="title" value="mle" required <?php
                            echo ($user['title'] == 'mle') ? set_radio('title', $user['title'], true) : set_radio('title', 'mle');
                            ?>>
                            <?php echo $this->lang->line('label_mle'); ?>
                        </label>
                    </div>
                    <div class="radio col-sm-3"">
                        <label>
                            <input type="radio" name="title" value="mad" required <?php
                            echo ($user['title'] == 'mad') ? set_radio('title', $user['title'], true) : set_radio('title', 'mad');
                            ?>>
                            <?php echo $this->lang->line('label_mad'); ?>
                        </label>
                    </div>
                    <div class="radio col-sm-4"">
                        <label>
                            <input type="radio" name="title" value="mon" required <?php
                            echo ($user['title'] == 'mon') ? set_radio('title', $user['title'], true) : set_radio('title', 'mon');
                            ?>>
                            <?php echo $this->lang->line('label_mon'); ?>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_password'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="admin" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_statut'); ?> *
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
                            <?php echo $this->lang->line('label_client'); ?>
                        </option>
                        <option value="1" <?php
                            if(isset($edit)) {
                                if($user['admin'])
                                    echo 'selected';
                            }
                            else
                                echo set_select('admin', '1', true);
                            ?>>
                            <?php echo $this->lang->line('label_admin'); ?>
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lastname" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_lastname'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php
                        echo set_value('lastname', isset($user['lastname']) ? $user['lastname'] : '');
                        ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_firstname'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php
                        echo set_value('firstname', isset($user['firstname']) ? $user['firstname'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthday" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_birthday'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="birthday" name="birthday" value="<?php
                        echo set_value('birthday', isset($user['birthday']) ? $user['birthday'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_address'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address" name="address" value="<?php
                        echo set_value('address', isset($user['address']) ? $user['address'] : '');
                        ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address2" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_address'); ?> 2
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="address2" name="address2" value="<?php
                        echo set_value('address2', isset($user['address2']) ? $user['address2'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="postcode" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_postcode'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="postcode" name="postcode" value="<?php
                        echo set_value('postcode', isset($user['postcode']) ? $user['postcode'] : '');
                        ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_city'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="city" name="city" value="<?php
                        echo set_value('city', isset($user['city']) ? $user['city'] : '');
                        ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_country'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="country" name="country" value="<?php
                        echo set_value('country', isset($user['country']) ? $user['country'] : '');
                        ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telephone" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_telephone'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?php
                        echo set_value('telephone', isset($user['telephone']) ? $user['telephone'] : '');
                        ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_mobile'); ?>
                    </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php
                        echo set_value('mobile', isset($user['mobile']) ? $user['mobile'] : '');
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_email'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?php
                        echo set_value('email', isset($user['email']) ? $user['email'] : '');
                        ?>" required>
                    </div>
                </div>
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
</div>