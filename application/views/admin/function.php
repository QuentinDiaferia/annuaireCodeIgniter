<?php
$this->lang->load(array('functions', 'links'));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $this->lang->line('panel-heading'); ?>
    </div>

    <div class="panel-body">
        <?php

        if(validation_errors() != null) {
            echo '<div class="alert alert-danger">';
            echo validation_errors();
            echo '</div>';
        }


        if(isset($edit)) {
            echo form_open('admin/editFunction/'.$function['id'], array('class' => 'form-horizontal'));
            echo '<p>'.$this->lang->line('selected_function').' : '.html_escape($function['name']).'</p>';
        }
        else
            echo form_open('admin/addFunction', array('class' => 'form-horizontal'));

        ?>
            <div class="form-group">
                <label for="active" class="control-label col-sm-2">
                    <?php echo $this->lang->line('label_active'); ?> *
                </label>
                <div class="radio col-sm-2"">
                    <label><input type="radio" name="active" value="0" required <?php
                    if(validation_errors() != '' || !isset($edit)) {
                        echo set_radio('active', '0');
                    }
                    else {
                        if(!$function['active'])
                            echo 'checked';
                    }
                    ?>>
                    <?php echo $this->lang->line('label_no'); ?>
                    </label>
                </div>
                <div class="radio col-sm-8"">
                    <label><input type="radio" name="active" value="1" required <?php 
                    if(validation_errors() != '' || !isset($edit)) {
                        echo set_radio('active', '1', true);
                    }
                    else {
                        if($function['active'])
                            echo 'checked';
                    }
                    ?>>
                    <?php echo $this->lang->line('label_yes'); ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-sm-2">
                    <?php echo $this->lang->line('label_name'); ?> *
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" 
                    value="<?php
                    echo set_value('name', isset($function['name']) ? $function['name'] : '');
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