<html>
    <head>
        <title><?php echo $title.' - '.$this->lang->line('main_title'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/annuaire.css"); ?>" />
    </head>
    <body>
        <div class="row" id="header">
            <div class="col-sm-2" id="logo">
                <img src="<?php echo base_url("assets/img/logo.png"); ?>" alt="logo" />
            </div>
            <div class="col-sm-4">
                <h1>
                    <?php echo strtoupper($this->lang->line('main_title')); ?>
                </h1>
                <h2>   
                    <?php echo $this->lang->line('subtitle'); ?>
                </h2>
            </div>
            <div class="col-sm-6" style="text-align: right" id="user_infos">
                <?php
                if(isset($this->session->admin)) {

                    echo '<p>'.$this->lang->line('welcome').' <strong>' . html_escape($this->session->firstname) . ' ' . html_escape($this->session->lastname) . '</strong> <em>';
                    if($this->session->admin)
                        echo '('.$this->lang->line('label_admin').')';
                    else
                        echo '('.$this->lang->line('label_client').')';
                    echo ' <a href="'.site_url('logout').'">[';
                    echo $this->lang->line('logout');
                    echo']</a></em></p><hr /><p>';
                    echo date('d/m/Y - H\hi');
                    echo '</p>';
                }

                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <?php
                if($this->session->flashdata('success') != NULL) {

                    echo '<div class="alert alert-success">';
                    echo $this->session->flashdata('success');
                    echo '</div>';
                }
                if($this->session->flashdata('error') != NULL) {

                    echo '<div class="alert alert-danger">';
                    echo $this->session->flashdata('error');
                    echo '</div>';
                } 
                ?>
            </div>
            <div class="col-sm-3"></div>
        </div>