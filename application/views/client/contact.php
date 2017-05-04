<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Annuaire
		</div>

		<div class="panel-body">
			<p>
				Contact sélectionné : 
				<?php
				echo $contact['lastname'].' '.$contact['firstname'];
				?>
			</p>

			<fieldset>
				<legend>Général</legend>
				<div class="row">
					<label class="col-sm-3">Civilité</label>
					<div class="col-sm-9">
						<?php
						switch($contact['title']) {
							case 'mad':
								echo 'Madame';
								break;
							case 'mle':
								echo 'Mademoiselle';
								break;
							default:
								echo 'Monsieur';
								break;
						}
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Nom</label>
					<div class="col-sm-9">
						<?php
						echo $contact['lastname'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Prénom</label>
					<div class="col-sm-9">
						<?php
						echo $contact['firstname'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Téléphone</label>
					<div class="col-sm-9">
						<?php
						echo $contact['telephone'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Mobile</label>
					<div class="col-sm-9">
						<?php
						echo $contact['mobile'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Fax</label>
					<div class="col-sm-9">
						<?php
						echo $contact['fax'];
						?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Détail</legend>
				<div class="row">
					<label class="col-sm-3">Décideur</label>
					<div class="col-sm-9"">
						Oui
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Société</label>
					<div class="col-sm-9">
						<?php
						echo $contact['company'];
						?>
					</div>
				</div>
				 <div class="row">
					<label class="col-sm-3">Fonction(s) *</label>
					<div class="col-sm-9">
						f1<br />
						f2
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Adresse</label>
					<div class="col-sm-9">
						<?php
						echo $contact['address'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Adresse 2</label>
					<div class="col-sm-9">
						<?php
						echo $contact['address2'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Code postal</label>
					<div class="col-sm-9">
						<?php
						echo $contact['postcode'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Ville</label>
					<div class="col-sm-9">
						<?php
						echo $contact['city'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Pays</label>
					<div class="col-sm-9">
						<?php
						echo $contact['country'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Web</label>
					<div class="col-sm-9">
						<?php
						echo $contact['website'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Email</label>
					<div class="col-sm-9">
						<?php
						echo $contact['email'];
						?>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Divers</legend>
				<div class="row">
					<label class="col-sm-3">Photo</label>
					<div class="col-sm-9">
						<?php
						echo $contact['photo'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3">Commentaire</label>
					<div class="col-sm-9">
						<p>
							<?php
							echo $contact['comment'];
							?>
						</p>
					</div>
				</div>
			</fieldset>

		</div>
	</div>
</div>