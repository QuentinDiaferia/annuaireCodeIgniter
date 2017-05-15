<?php
$this->lang->load(array('connexion', 'forms'));
?>
<div id="login">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo lang('panel-heading'); ?>
        </div>

        <div class="panel-body">
            <p><?php echo lang('welcome'); ?></p>
            <p><?php echo lang('connect'); ?></p>

            <?php
            if(validation_errors() != null) {
                echo '<div class="alert alert-danger">';
                echo validation_errors();
                echo '</div>';
            }

            echo form_open('connexion', array('class' => 'form-horizontal'));
            ?>

                <div class="form-group">
                    <label for="email" class="control-label col-sm-3">
                        <?php echo lang('label_email'); ?> *
                    </label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" required value="quentin.diaferia@globalis-ms.com">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd" class="control-label col-sm-3">
                        <?php echo lang('label_password'); ?> *
                    </label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="pwd" name="pwd" required value="globalis">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-default">
                            <?php echo lang('button_connect'); ?>
                        </button>
                    </div>
                </div>
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
</div>