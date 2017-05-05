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
					<label class="col-sm-3" style="text-align: right">Civilité</label>
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
					<label class="col-sm-3" style="text-align: right">Nom</label>
					<div class="col-sm-9">
						<?php
						echo $contact['lastname'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Prénom</label>
					<div class="col-sm-9">
						<?php
						echo $contact['firstname'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Téléphone</label>
					<div class="col-sm-9">
						<?php
						echo $contact['telephone'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Mobile</label>
					<div class="col-sm-9">
						<?php
						echo $contact['mobile'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Fax</label>
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
					<label class="col-sm-3" style="text-align: right">Décideur</label>
					<div class="col-sm-9"">
						Oui
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Société</label>
					<div class="col-sm-9">
						<?php
						echo $contact['company'];
						?>
					</div>
				</div>
				 <div class="row">
					<label class="col-sm-3" style="text-align: right">Fonction(s) *</label>
					<div class="col-sm-9">
						f1<br />
						f2
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Adresse</label>
					<div class="col-sm-9">
						<?php
						echo $contact['address'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Adresse 2</label>
					<div class="col-sm-9">
						<?php
						echo $contact['address2'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Code postal</label>
					<div class="col-sm-9">
						<?php
						echo $contact['postcode'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Ville</label>
					<div class="col-sm-9">
						<?php
						echo $contact['city'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Pays</label>
					<div class="col-sm-9">
						<?php
						echo $contact['country'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Web</label>
					<div class="col-sm-9">
						<?php
						echo $contact['website'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Email</label>
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
					<label class="col-sm-3" style="text-align: right">Photo</label>
					<div class="col-sm-9">
						<?php
						echo $contact['photo'];
						?>
					</div>
				</div>
				<div class="row">
					<label class="col-sm-3" style="text-align: right">Commentaire</label>
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