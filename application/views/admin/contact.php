<div class="col-sm-9">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Gestion de l'annuaire
		</div>

		<div class="panel-body">
			<p>Contact sélectionné :</p>

			<form class="form-horizontal">

				<div class="form-group">
					<label for="active" class="control-label col-sm-2">Actif *</label>
					<div class="radio col-sm-2"">
						<label><input type="radio" name="active">Non</label>
					</div>
					<div class="radio col-sm-8"">
						<label><input type="radio" name="active">Oui</label>
					</div>
				</div>

				<fieldset>
					<legend>Général</legend>
					<div class="form-group">
						<label for="title" class="control-label col-sm-2">Civilité *</label>
						<div class="radio col-sm-2"">
							<label><input type="radio" name="title" required>Mademoiselle</label>
						</div>
						<div class="radio col-sm-2"">
							<label><input type="radio" name="title" required>Madame</label>
						</div>
						<div class="radio col-sm-6"">
							<label><input type="radio" name="title" required>Monsieur</label>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="control-label col-sm-2">Nom *</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name">
						</div>
					</div>
					<div class="form-group">
						<label for="firstname" class="control-label col-sm-2">Prénom *</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="firstname">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="control-label col-sm-2">Téléphone</label>
						<div class="col-sm-10">
							<input type="telephone" class="form-control" id="telephone">
						</div>
					</div>
					<div class="form-group">
						<label for="mobile" class="control-label col-sm-2">Mobile</label>
						<div class="col-sm-10">
							<input type="mobile" class="form-control" id="mobile">
						</div>
					</div>
					<div class="form-group">
						<label for="fax" class="control-label col-sm-2">Fax</label>
						<div class="col-sm-10">
							<input type="fax" class="form-control" id="fax">
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Détail</legend>
					<div class="form-group">
						<label for="decideur" class="control-label col-sm-2">Décideur</label>
						<div class="radio col-sm-2"">
							<label><input type="radio" name="decideur">Non</label>
						</div>
						<div class="radio col-sm-8"">
							<label><input type="radio" name="decideur">Oui</label>
						</div>
					</div>
					<div class="form-group">
						<label for="company" class="control-label col-sm-2">Société *</label>
						<div class="col-sm-10">
							<input type="company" class="form-control" id="company">
						</div>
					</div>
					 <div class="form-group">
						<label for="functions" class="control-label col-sm-2">Fonction(s) *</label>
						<select class="col-sm-10" id="functions" multiple>
							<option>f1</option>
							<option>f2</option>
							<option>f3</option>
						</select>
					</div>
					<div class="form-group">
						<label for="address" class="control-label col-sm-2">Adresse</label>
						<div class="col-sm-10">
							<input type="address" class="form-control" id="address">
						</div>
					</div>
					<div class="form-group">
						<label for="address2" class="control-label col-sm-2">Adresse 2</label>
						<div class="col-sm-10">
							<input type="address2" class="form-control" id="address2">
						</div>
					</div>
					<div class="form-group">
						<label for="postalcode" class="control-label col-sm-2">Code postal</label>
						<div class="col-sm-10">
							<input type="postalcode" class="form-control" id="postalcode">
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="control-label col-sm-2">Ville</label>
						<div class="col-sm-10">
							<input type="city" class="form-control" id="city">
						</div>
					</div>
					<div class="form-group">
						<label for="country" class="control-label col-sm-2">Pays</label>
						<div class="col-sm-10">
							<input type="country" class="form-control" id="country">
						</div>
					</div>
					<div class="form-group">
						<label for="website" class="control-label col-sm-2">Web</label>
						<div class="col-sm-10">
							<input type="website" class="form-control" id="website">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="control-label col-sm-2">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email">
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Divers</legend>
					<div class="form-group">
						<label for="photo" class="control-label col-sm-2">Photo</label>
						<div class="col-sm-10">
							<input type="photo" class="form-control" id="photo">
						</div>
					</div>
					<div class="form-group">
						<label for="comment" class="control-label col-sm-2">Commentaire</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="5" id="comment"></textarea>
						</div>
					</div>
				</fieldset>

				<button type="submit" class="btn btn-default">Valider</button>
				<button type="submit" class="btn btn-default">Effacer</button>
			</form>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			Légende
		</div>
		<div class="panel-body">
			* <em>Champ obligatoire</em>
		</div>
	</div>
</div>