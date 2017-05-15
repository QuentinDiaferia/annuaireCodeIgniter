<div class="row" id="flashdata">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <?php
        if($this->session->flashdata('success') != NULL) {

            echo '<div id="flash-alert" class="alert alert-success">';
            echo '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> ';
            echo $this->session->flashdata('success');
            echo '</div>';
        }
        if($this->session->flashdata('error') != NULL) {

            echo '<div id="flash-alert" class="alert alert-danger">';
            echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
            echo $this->session->flashdata('error');
            echo '</div>';
        } 
        ?>
    </div>
    <div class="col-sm-3"></div>
</div>