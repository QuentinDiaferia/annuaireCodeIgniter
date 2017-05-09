<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Gestion des fonctions
		</div>

		<div class="panel-body">

			<a href="<?php echo site_url('admin/addFunction'); ?>">
				<span class="glyphicon glyphicon-plus-sign"></span> Ajouter
			</a>

			<table class="table table-bordered table-hover table-condensed">
				<thead>
					<tr>
						<th>Fonctions</th>
						<th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($listFunctions as $function) {
						?>

						<tr>
							<td><?php echo html_escape($function['name']); ?></td>
							<td>
								<a href="<?php echo site_url('admin/editFunction/'.$function['id']); ?>">Modifier</a>
							</td>
							<td>
								<?php
								if($function['active'])
									echo '<a href="'.site_url('admin/function/deactivate/'.html_escape($function['id'])).'">Désactiver</a>';
								else
									echo '<a href="'.site_url('admin/function/activate/'.html_escape($function['id'])).'">Activer</a>';
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