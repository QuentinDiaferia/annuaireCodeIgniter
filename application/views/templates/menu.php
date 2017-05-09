    <?php
    if(isset($this->session->admin)) {
    ?>

    <div class="col-sm-3">
        <div class="panel panel-default">
            <div class="panel-heading">
            <?php
            if($this->session->admin) {

                echo 'Menu Administrateur</div>
                <div class="panel-body">
                <a href="'.site_url('admin/users').'">Utilisateurs</a><br />
                <a href="'.site_url('admin/functions').'">Fonctions</a><br />';

            }
            else {

                echo 'Menu Client</div>
                <div class="panel-body">';
            }
            ?>
            
                <a href="<?php echo site_url('annuaire'); ?>">Annuaire</a><br />
                <a href="<?php echo site_url('logout'); ?>">Déconnexion</a>
            </div>
        </div>
    </div>

    <?php
    }
    ?>