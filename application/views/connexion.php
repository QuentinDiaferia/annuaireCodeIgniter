<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			Identification
		</div>

		<div class="panel-body">
			<p>Bienvenue sur l'annuaire GLOBALIS media systems.</p>
			<p>Saisir votre email et mot de passe pour vous connecter.</p>

			<?php
			echo validation_errors();
			echo form_open('connexion');
			?>

				<div class="form-group">
					<label for="email" class="control-label col-sm-2">Email *</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
				</div>
				<div class="form-group">
					<label for="pwd" class="control-label col-sm-2">Mot de passe *</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="pwd" name="pwd" required>
					</div>
				</div>
				<button type="submit" class="btn btn-default">Se connecter</button>
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