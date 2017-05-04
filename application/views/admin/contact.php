<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Gestion de l'annuaire
		</div>

		<div class="panel-body">

				<?php

				echo validation_errors();

				if(isset($edit)) {
					echo form_open('admin/editContact/'.$contact['id'], array('class' => 'form-horizontal'));
					echo '<p>Contact sélectionné : '.$contact['lastname'].' '.$contact['firstname'].'</p>';
				}
				else
					echo form_open('admin/addContact', array('class' => 'form-horizontal'));

				?>

				<div class="form-group">
					<label for="active" class="control-label col-sm-2">Actif *</label>
					<div class="radio col-sm-2"">
						<label><input type="radio" name="active" value="0" required <?php
						if(isset($edit)) {
							if(!$contact['active'])
								echo 'checked';
						}
						else
							echo set_radio('active', '0');
						?>>Non</label>
					</div>
					<div class="radio col-sm-8"">
						<label><input type="radio" name="active" value="1" required <?php 
						if(isset($edit)) {
							if($contact['active'])
								echo 'checked';
						}
						else
							echo set_radio('active', '1', true);
						 ?>>Oui</label>
					</div>
				</div>

				<fieldset>
					<legend>Général</legend>
					<div class="form-group">
						<label for="title" class="control-label col-sm-2">Civilité *</label>
						<div class="radio col-sm-3"">
							<label>
								<input type="radio" name="title" value="mle" required <?php
								if(isset($edit)) {
									if($contact['title'] == 'mle')
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
									if($contact['title'] == 'mad')
										echo 'checked';
								}
								else
									echo set_radio('title', 'mad');
								?>>
								Madame
							</label>
						</div>
						<div class="radio col-sm-4"">
							<label>
								<input type="radio" name="title" value="mon" required <?php
								if(isset($edit)) {
									if($contact['title'] == 'mon')
										echo 'checked';
								}
								else
									echo set_radio('title', 'mon', true);
								?>>
								Monsieur
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="control-label col-sm-2">Nom *</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="lastname" name="lastname" value="<?php
							echo set_value('lastname', isset($contact['lastname']) ? $contact['lastname'] : '');
							?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="firstname" class="control-label col-sm-2">Prénom *</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="firstname" name="firstname" value="<?php
							echo set_value('firstname', isset($contact['firstname']) ? $contact['firstname'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="control-label col-sm-2">Téléphone</label>
						<div class="col-sm-10">
							<input type="telephone" class="form-control" id="telephone" name="telephone" value="<?php
							echo set_value('telephone', isset($contact['telephone']) ? $contact['telephone'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="mobile" class="control-label col-sm-2">Mobile</label>
						<div class="col-sm-10">
							<input type="mobile" class="form-control" id="mobile" name="mobile" value="<?php
							echo set_value('mobile', isset($contact['mobile']) ? $contact['mobile'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="fax" class="control-label col-sm-2">Fax</label>
						<div class="col-sm-10">
							<input type="fax" class="form-control" id="fax" name="fax" value="<?php
							echo set_value('fax', isset($contact['fax']) ? $contact['fax'] : '');
							?>">
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Détail</legend>
					<div class="form-group">
						<label for="decisionmaker" class="control-label col-sm-2">Décideur</label>
						<div class="radio col-sm-2"">
							<label><input type="radio" name="decisionmaker" value="0" <?php
							if(isset($edit)) {
								if(!$contact['decisionmaker'])
									echo 'checked';
							}
							else
								echo set_radio('decisionmaker', '0');
							?>>Non</label>
						</div>
						<div class="radio col-sm-8"">
							<label><input type="radio" name="decisionmaker" value="1" <?php 
							if(isset($edit)) {
								if($contact['decisionmaker'])
									echo 'checked';
							}
							else
								echo set_radio('decisionmaker', '1');
							 ?>>Oui</label>
						</div>
					</div>
					<div class="form-group">
						<label for="company" class="control-label col-sm-2">Société *</label>
						<div class="col-sm-10">
							<input type="company" class="form-control" id="company" name="company" value="<?php
							echo set_value('company', isset($contact['company']) ? $contact['company'] : '');
							?>" required>
						</div>
					</div>
					 <div class="form-group">
						<label for="functions" class="control-label col-sm-2">Fonction(s) *</label>
						<select class="col-sm-10" id="functions" name="functions[]" multiple>
							<?php
							foreach($functions as $function) {
								echo '<option value="'.$function['id'].'"';
								if(isset($edit)) {
									if(in_array($function['id'], $contact['functions']))
										echo ' selected';
								}
								echo set_select('functions[]', $function['id']);
								echo '>'.$function['name'].'</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="address" class="control-label col-sm-2">Adresse</label>
						<div class="col-sm-10">
							<input type="address" class="form-control" id="address" name="address" value="<?php
							echo set_value('address', isset($contact['address']) ? $contact['address'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="address2" class="control-label col-sm-2">Adresse 2</label>
						<div class="col-sm-10">
							<input type="address2" class="form-control" id="address2" name="address2" value="<?php
							echo set_value('address2', isset($contact['address2']) ? $contact['address2'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="postalcode" class="control-label col-sm-2">Code postal</label>
						<div class="col-sm-10">
							<input type="postalcode" class="form-control" id="postcode" name="postcode" value="<?php
							echo set_value('postcode', isset($contact['postcode']) ? $contact['postcode'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="city" class="control-label col-sm-2">Ville</label>
						<div class="col-sm-10">
							<input type="city" class="form-control" id="city" name="city" value="<?php
							echo set_value('city', isset($contact['city']) ? $contact['city'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="country" class="control-label col-sm-2">Pays</label>
						<div class="col-sm-10">
							<input type="country" class="form-control" id="country" name="country" value="<?php
							echo set_value('country', isset($contact['country']) ? $contact['country'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="website" class="control-label col-sm-2">Web</label>
						<div class="col-sm-10">
							<input type="website" class="form-control" id="website" name="website" value="<?php
							echo set_value('website', isset($contact['website']) ? $contact['website'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="control-label col-sm-2">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" value="<?php
							echo set_value('email', isset($contact['email']) ? $contact['email'] : '');
							?>">
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Divers</legend>
					<div class="form-group">
						<label for="photo" class="control-label col-sm-2">Photo</label>
						<div class="col-sm-10">
							<input type="photo" class="form-control" id="photo" name="photo" value="<?php
							echo set_value('photo', isset($contact['photo']) ? $contact['photo'] : '');
							?>">
						</div>
					</div>
					<div class="form-group">
						<label for="comment" class="control-label col-sm-2">Commentaire</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="5" id="comment" name="comment"><?php
								echo set_value('comment', isset($contact['comment']) ? $contact['comment'] : '');
							?></textarea>
						</div>
					</div>
				</fieldset>

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