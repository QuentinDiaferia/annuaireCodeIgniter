<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Annuaire
		</div>

		<div class="panel-body">

			<?php
			if($this->session->flashdata('success') != NULL) {

				echo '<div class="alert alert-success">';
				echo $this->session->flashdata('success');
				echo '</div>';
			} 
			?>

			<div class="panel panel-default">
				<div class="panel-heading">
					Cliquez sur le bouton " Reset " afin de réinitialiser vos options de recherche.
				</div>
				<div class="panel-body">
					<form class="form-horizontal">
						<div class="form-group">
							<label for="lastname" class="control-label col-sm-2">Nom</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="lastname" name="lastname">
							</div>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-default">Valider</button>
								<button type="reset" class="btn btn-default">Effacer</button>
							</div>
						</div>
					</form>
					<form class="form-horizontal">
						<div class="form-group">
							<label for="firstname" class="control-label col-sm-2">Prénom</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="firstname" name="firstname">
							</div>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-default">Valider</button>
								<button type="reset" class="btn btn-default">Effacer</button>
							</div>	
						</div>
					</form>
					<div class="row">
						<label class="control-label col-sm-2" style="text-align: right">Nom</label>
						<div class="col-sm-10">
							<?php
							foreach(range('A','Z') as $i) {
							    echo '<a href="'.site_url('annuaire/'.$i).'">'.$i.'</a> ';
							}
							?>
						</div>
					</div>
				</div>
			</div>

			<?php
			if($this->session->admin) {
				?>
				<a href="<?php echo site_url('admin/addContact'); ?>">
					<span class="glyphicon glyphicon-plus-sign"></span> Ajouter
				</a>
				<?php
			}
			?>

			<table class="table table-bordered table-hover table-condensed">
				<thead>
					<tr>
						<th>Société</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Téléphone</th>
						<th colspan="3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($listContacts as $contact) {
						?>

						<tr>
							<td><?php echo $contact['company']; ?></td>
							<td><?php echo $contact['lastname']; ?></td>
							<td><?php echo $contact['firstname']; ?></td>
							<td><?php echo $contact['telephone']; ?></td>
							<?php
							if($this->session->admin) {
								?>

								<td>
									<a href="<?php echo site_url('admin/editContact/'.$contact['id']); ?>">Modifier</a>
								</td>
								<td>
									<?php
									if($contact['active'])
										echo '<a href="'.site_url('admin/contact/deactivate/'.$contact['id']).'">Désactiver</a>';
									else
										echo '<a href="'.site_url('admin/contact/activate/'.$contact['id']).'">Activer</a>';
									?>
								</td>
								<td>
									<a href="<?php echo site_url('admin/contact/delete/'.$contact['id']); ?>">Supprimer</a>
								</td>

								<?php
							}
							else {
								?>

								<td colspan="3"><a href="">Visualiser</a></td>

								<?php
							}
							?>
							
						</tr>

						<?php
					}
					?>

				</tbody>
			</table>

			<?php
			if($this->session->admin) {
				?>
				<a href="<?php echo site_url('admin/addContact'); ?>">
					<span class="glyphicon glyphicon-plus-sign"></span> Ajouter
				</a>
				<?php
			}
			?>
		</div>
	</div>
</div>