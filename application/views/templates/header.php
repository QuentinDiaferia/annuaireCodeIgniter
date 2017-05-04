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