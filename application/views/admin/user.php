<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Gestion des utilisateurs
		</div>

		<div class="panel-body">
			<?php

			echo validation_errors();

			if(isset($edit)) {
				echo form_open('admin/editUser/'.$user['id'], array('class' => 'form-horizontal'));
				echo '<p>Utilisateur sélectionné : '.$user['lastname'].' '.$user['firstname'].'</p>';
			}
			else
				echo form_open('admin/addUser', array('class' => 'form-horizontal'));

			?>
				<div class="form-group">
					<label for="active" class="control-label col-sm-2">Actif *</label>
					<div class="radio col-sm-2"">
						<label><input type="radio" name="active" value="0" required <?php
						if(isset($edit)) {
							if(!$user['active'])
								echo 'checked';
						}
						else
							echo set_radio('active', '0');
						?>>Non</label>
					</div>
					<div class="radio col-sm-8"">
						<label><input type="radio" name="active" value="1" required <?php 
						if(isset($edit)) {
							if($user['active'])
								echo 'checked';
						}
						else
							echo set_radio('active', '1', true);
						 ?>>Oui</label>
					</div>
				</div>
				<div class="form-group">
					<label for="title" class="control-label col-sm-2">Civilité *</label>
					<div class="radio col-sm-3"">
						<label>
							<input type="radio" name="title" value="mle" required <?php
							if(isset($edit)) {
								if($user['title'] == 'mle')
									echo 'checked';
							}
							else
								echo set_radio('title', 'mle');
							?>>
							Mademoiselle
						</label>
					</div>
					<div class="radio col-sm-3"">
						<label>
							<input type="radio" name="title" value="mad" required <?php
							if(isset($edit)) {
								if($user['title'] == 'mad')
									echo 'checked';
							}
							else
								echo set_radio('title', 'mle');
							?>>
							Madame
						</label>
					</div>
					<div class="radio col-sm-4"">
						<label>
							<input type="radio" name="title" value="mon" required <?php
							if(isset($edit)) {
								if($user['title'] == 'mon')
									echo 'checked';
							}
							else
								echo set_radio('title', 'mle', true);
							?>>
							Monsieur
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-sm-2">Mot de passe *</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
				</div>
				<div class="form-group">
					<label for="admin" class="control-label col-sm-2">Statut *</label>
					<select class="col-sm-10" id="admin" name="admin">
						<option value="0" <?php
							if(isset($edit)) {
								if(!$user['admin'])
									echo 'selected';
							}
							else
								echo set_select('admin', '0', true);
							?>>
							Client
						</option>
						<option value="1" <?php
							if(isset($edit)) {
								if($user['admin'])
									echo 'selected';
							}
							else
								echo set_select('admin', '1', true);
							?>>
							Administrateur
						</option>
					</select>
				</div>
				<div class="form-group">
					<label for="lastname" class="control-label col-sm-2">Nom *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="lastname" name="lastname" value="<?php
						echo set_value('lastname', isset($user['lastname']) ? $user['lastname'] : '');
						?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="firstname" class="control-label col-sm-2">Prénom</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="firstname" name="firstname" value="<?php
						echo set_value('firstname', isset($user['firstname']) ? $user['firstname'] : '');
						?>">
					</div>
				</div>
				<div class="form-group">
					<label for="birthday" class="control-label col-sm-2">Date de naissance</label>
					<div class="col-sm-10">
						<input type="birthday" class="form-control" id="birthday" name="birthday">
					</div>
				</div>
				<div class="form-group">
					<label for="address" class="control-label col-sm-2">Adresse *</label>
					<div class="col-sm-10">
						<input type="address" class="form-control" id="address" name="address" value="<?php
						echo set_value('address', isset($user['address']) ? $user['address'] : '');
						?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="address2" class="control-label col-sm-2">Adresse 2</label>
					<div class="col-sm-10">
						<input type="address2" class="form-control" id="address2" name="address2" value="<?php
						echo set_value('address2', isset($user['address2']) ? $user['address2'] : '');
						?>">
					</div>
				</div>
				<div class="form-group">
					<label for="postcode" class="control-label col-sm-2">Code postal *</label>
					<div class="col-sm-10">
						<input type="postcode" class="form-control" id="postcode" name="postcode" value="<?php
						echo set_value('postcode', isset($user['postcode']) ? $user['postcode'] : '');
						?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="city" class="control-label col-sm-2">Ville *</label>
					<div class="col-sm-10">
						<input type="city" class="form-control" id="city" name="city" value="<?php
						echo set_value('city', isset($user['city']) ? $user['city'] : '');
						?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="country" class="control-label col-sm-2">Pays *</label>
					<div class="col-sm-10">
						<input type="country" class="form-control" id="country" name="country" value="<?php
						echo set_value('country', isset($user['country']) ? $user['country'] : '');
						?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="telephone" class="control-label col-sm-2">Téléphone *</label>
					<div class="col-sm-10">
						<input type="telephone" class="form-control" id="telephone" name="telephone" value="<?php
						echo set_value('telephone', isset($user['telephone']) ? $user['telephone'] : '');
						?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="mobile" class="control-label col-sm-2">Mobile</label>
					<div class="col-sm-10">
						<input type="mobile" class="form-control" id="mobile" name="mobile" value="<?php
						echo set_value('mobile', isset($user['mobile']) ? $user['mobile'] : '');
						?>">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-sm-2">Email *</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" name="email" value="<?php
						echo set_value('email', isset($user['email']) ? $user['email'] : '');
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