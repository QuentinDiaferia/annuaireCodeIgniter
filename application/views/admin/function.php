<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Gestion des fonctions
		</div>

		<div class="panel-body">
			<?php

			echo validation_errors();

			if(isset($edit)) {
				echo form_open('admin/editFunction/'.$function['id'], array('class' => 'form-horizontal'));
				echo '<p>Fonction sélectionnée : ' . $function['name'] . '</p>';
			}
			else
				echo form_open('admin/addFunction', array('class' => 'form-horizontal'));

			?>
				<div class="form-group">
					<label for="active" class="control-label col-sm-2">Actif *</label>
					<div class="radio col-sm-2"">
						<label><input type="radio" name="active" value=0 required <?php
						if(isset($edit) && !$function['active'])
							echo 'checked';
						else
							echo set_radio('active', 0);
						?>>Non</label>
					</div>
					<div class="radio col-sm-8"">
						<label><input type="radio" name="active" value=1 required <?php 
						if(!isset($edit) || $function['active'])
							echo 'checked';
						else
							echo set_radio('active', 1, true);
						 ?>>Oui</label>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-sm-2">Nom *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" 
						value="<?php
						if(isset($edit))
							echo $function['name'];
						else
							echo set_value('name');
						?>" required>
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