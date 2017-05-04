<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Gestion des utilisateurs
		</div>

		<div class="panel-body">
			<?php
			echo validation_errors();
			echo form_open('admin/addUser', array('class' => 'form-horizontal'));
			?>
				<div class="form-group">
					<label for="active" class="control-label col-sm-2">Actif *</label>
					<div class="radio col-sm-2"">
						<label><input type="radio" name="active" required>Non</label>
					</div>
					<div class="radio col-sm-8"">
						<label><input type="radio" name="active" required>Oui</label>
					</div>
				</div>
				<div class="form-group">
					<label for="title" class="control-label col-sm-2">Civilité *</label>
					<div class="radio col-sm-3"">
						<label><input type="radio" name="title" required>Mademoiselle</label>
					</div>
					<div class="radio col-sm-3"">
						<label><input type="radio" name="title" required>Madame</label>
					</div>
					<div class="radio col-sm-4"">
						<label><input type="radio" name="title" required>Monsieur</label>
					</div>
				</div>
				<div class="form-group">
					<label for="pawd" class="control-label col-sm-2">Mot de passe *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="pawd" required>
					</div>
				</div>
				<div class="form-group">
					<label for="admin" class="control-label col-sm-2">Statut *</label>
					<select class="col-sm-10" id="admin">
						<option value=0>Client</option>
						<option value=1>Administrateur</option>
					</select>
				</div>
				<div class="form-group">
					<label for="lastname" class="control-label col-sm-2">Nom *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="lastname" required>
					</div>
				</div>
				<div class="form-group">
					<label for="firstname" class="control-label col-sm-2">Prénom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="firstname">
					</div>
				</div>
				<div class="form-group">
					<label for="birthday" class="control-label col-sm-2">Date de naissance</label>
					<div class="col-sm-10">
						<input type="birthday" class="form-control" id="birthday">
					</div>
				</div>
				<div class="form-group">
					<label for="address" class="control-label col-sm-2">Adresse *</label>
					<div class="col-sm-10">
						<input type="address" class="form-control" id="address" required>
					</div>
				</div>
				<div class="form-group">
					<label for="address2" class="control-label col-sm-2">Adresse 2</label>
					<div class="col-sm-10">
						<input type="address2" class="form-control" id="address2">
					</div>
				</div>
				<div class="form-group">
					<label for="postalcode" class="control-label col-sm-2">Code postal *</label>
					<div class="col-sm-10">
						<input type="postalcode" class="form-control" id="postalcode" required>
					</div>
				</div>
				<div class="form-group">
					<label for="city" class="control-label col-sm-2">Ville *</label>
					<div class="col-sm-10">
						<input type="city" class="form-control" id="city" required>
					</div>
				</div>
				<div class="form-group">
					<label for="country" class="control-label col-sm-2">Pays *</label>
					<div class="col-sm-10">
						<input type="country" class="form-control" id="country" required>
					</div>
				</div>
				<div class="form-group">
					<label for="telephone" class="control-label col-sm-2">Téléphone *</label>
					<div class="col-sm-10">
						<input type="telephone" class="form-control" id="telephone" required>
					</div>
				</div>
				<div class="form-group">
					<label for="mobile" class="control-label col-sm-2">Mobile</label>
					<div class="col-sm-10">
						<input type="mobile" class="form-control" id="mobile">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-sm-2">Email *</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" required>
					</div>
				</div>
				<button type="submit" class="btn btn-default">Valider</button>
				<button type="reset" class="btn btn-default">Effacer</button>
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