<div class="content-header">
	<h1>
		<a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            	<?=ucfirst($page);?>
	</h1>
</div>
<div class="page-content inset">
	<div class="row">
            	<div class="col-md-12">
              		<table class="table table-bordered table-striped" id="players">
              			<thead>
              				<tr>
              					<th>Account</th>
              					<th>Player</th>
              					<th>Position</th>
              					<th>Level</th>
              					<th>Max BIN</th>
              					<th>Status</th>
              				</tr>
              			</thead>
              			<tbody>
              				<?
              					if($rec_count > 0) {
              						foreach($arrayPlayers as $player) {
              							echo "<tr>";
              								echo "<td>".$player['personaName']."</td>";
              								echo "<td><a href='/manage_player/".$player['myplayer_id']."'>".$player['player_name']."</a></td>";
              								echo "<td>".$player['player_pos']."</td>";
              								echo "<td>".ucfirst($player['player_level'])."</td>";
              								echo "<td>".number_format($player['max_bin'])."</td>";
              								switch($player['player_status']) {
              									case "0":
              										$status = "<label class='label label-danger'>Disabled</label>";
              									break;
              									case "1":
              										$status = "<label class='label label-success'>Enabled</label>";
              									break;
              								}
              								echo "<td>".$status."</td>";
              							echo "</tr>";
              						}
              					}
              				?>
              			</tbody>
              		</table>
            	</div>
	</div>
</div>