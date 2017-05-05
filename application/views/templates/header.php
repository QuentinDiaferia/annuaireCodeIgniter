<html>
	<head>
		<title><?php echo $title; ?> - Annuaire</title>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	</head>
	<body>
		<div class="row">
			<div class="col-sm-2">
				Logo
			</div>
			<div class="col-sm-4">
				<h1>ANNUAIRE</h1>
				<h2>Projet de formation</h2>
			</div>
			<div class="col-sm-6">
				<?php
				if(isset($this->session->admin)) {

					echo '<p>Bienvenue ' . $this->session->firstname . ' ' . $this->session->lastname;
					if($this->session->admin)
						echo ' (Administrateur) ';
					else
						echo ' (Client) ';
					echo '<a href="'.site_url('logout').'">Déconnexion</a></p><hr /><p>';
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

					echo '<div class="alert alert-danger"><strong>Erreur !</strong> ';
					echo $this->session->flashdata('error');
					echo '</div>';
				} 
				?>
			</div>
			<div class="col-sm-3"></div>
		</div>