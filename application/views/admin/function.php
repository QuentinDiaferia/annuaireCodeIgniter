<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Gestion des fonctions
		</div>

		<div class="panel-body">
			<?php
			echo validation_errors();
			echo form_open('admin/addFunction', array('class' => 'form-horizontal'));
			?>
				<div class="form-group">
					<label for="active" class="control-label col-sm-2">Actif *</label>
					<div class="radio col-sm-2"">
						<label><input type="radio" name="active" value=0 required>Non</label>
					</div>
					<div class="radio col-sm-8"">
						<label><input type="radio" name="active" value=1 required>Oui</label>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-sm-2">Nom *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" required>
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