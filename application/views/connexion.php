<?php
$this->lang->load(array('connexion', 'forms'));
?>
<div class="col-sm-12" id="login">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo $this->lang->line('panel-heading'); ?>
        </div>

        <div class="panel-body">
            <p><?php echo $this->lang->line('welcome'); ?></p>
            <p><?php echo $this->lang->line('connect'); ?></p>

            <?php
            echo validation_errors();
            echo form_open('connexion');
            ?>

                <div class="form-group">
                    <label for="email" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_email'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" required value="quentin.diaferia@globalis-ms.com">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pwd" class="control-label col-sm-2">
                        <?php echo $this->lang->line('label_password'); ?> *
                    </label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="pwd" name="pwd" required value="globalis">
                    </div>
                </div>
                <button type="submit" class="btn btn-default">
                    <?php echo $this->lang->line('button_connect'); ?>
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