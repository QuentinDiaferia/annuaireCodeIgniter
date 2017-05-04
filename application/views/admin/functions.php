<div class="col-sm-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			Gestion des fonctions
		</div>

		<div class="panel-body">
		
			<?php
			if($this->session->flashdata('success') != NULL) {

				echo '<div class="alert alert-success">';
				echo $this->session->flashdata('success');
				echo '</div>';
			} 
			?>

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
							<td><?php echo $function['name']; ?></td>
							<td>
								<a href="<?php echo site_url('admin/editFunction/'.$function['id']); ?>">Modifier</a>
							</td>
							<td>
								<?php
								if($function['active'])
									echo '<a href="'.site_url('admin/function/deactivate/'.$function['id']).'">Désactiver</a>';
								else
									echo '<a href="'.site_url('admin/function/activate/'.$function['id']).'">Activer</a>';
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