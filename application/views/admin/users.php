<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Gestion des utilisateurs
		</div>

		<div class="panel-body">
			
			<a href="<?php echo site_url('admin/addUser'); ?>">
				<span class="glyphicon glyphicon-plus-sign"></span> Ajouter
			</a>

			<table class="table table-bordered table-hover table-condensed">
				<thead>
					<tr>
						<th>Membres</th>
						<th colspan="3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($listUsers as $user) {
						?>

						<tr>
							<td>
								<?php echo html_escape($user['lastname']).' '.html_escape($user['firstname']); ?>
							</td>
							<td>
								<?php
								echo '<a href="'.site_url('admin/editUser/'.html_escape($user['id'])).'">Modifier</a>';
								?>
							</td>
							<td>
								<?php
								if($user['active'])
									echo '<a href="'.site_url('admin/user/deactivate/'.html_escape($user['id'])).'">Désactiver</a>';
								else
									echo '<a href="'.site_url('admin/user/activate/'.html_escape($user['id'])).'">Activer</a>';
								?>
							</td>
							<td>
								<?php echo '<a href="'.site_url('admin/user/delete/'.html_escape($user['id'])).'">Supprimer</a>';
								?>
							</td>
						</tr>

						<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>