<html>
    <head>
        <title>
            <?php
            if($this->session->admin === '1')
                echo $this->lang->line('label_admin').' - ';
            elseif($this->session->admin === '0')
                echo $this->lang->line('label_client').' - ';
            echo $title;
            ?>
        </title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/annuaire.css"); ?>" />
        <script src="<?php echo base_url("assets/js/jquery-3.2.1.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
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
                    echo date($this->lang->line('date_format').' - H\hi');
                    echo '</p>';
                }

                ?>
            </div>
        </div>

        <div class="row" id="body">