<div class="content-header">
	<h1>
		<a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            	<?=ucfirst($page);?>
	</h1>
</div>
<div class="page-content inset">
	<div class="row">
            	<div class="col-md-12">
              		<table class="table table-bordered table-striped">
              			<legend>Sitewide statistics</legend>
              			<thead>
              				<tr>
              					<th>Active Players</th>
              					<th>Active Accounts</th>
              					<th>Profit today</th>
              					<th>Profit in total</th>
              					<th>Total sales</th>
              					<th>Total buys</th>
              				</tr>
              			</thead>
              			<tbody>
              				<tr>
              					<td><?=$grab_active_players['rows'];?></td>
              					<td><?=$grab_active_accounts['rows'];?></td>
              					<td>0</td>
              					<td>0</td>
              					<td><?=$grab_total_sales['rows'];?></td>
              					<td><?=$grab_total_buys['rows'];?></td>
              				</tr>
              			</tbody>
              		</table>
            	</div>
            	<div class="col-md-12">
              		<table class="table table-bordered table-striped">
              			<legend>Last 50 added players</legend>
              			<thead>
              				<tr>
              					<th>Console</th>
              					<th>Account</th>
              					<th>Player</th>
              					<th>Rating</th>
              					<th>Max BIN</th>
              					<th>Date added</th>
              					<th>Status</th>
              				</tr>
              			</thead>
              			<tbody>
              				<?
              					if($last_50_players['rows'] > 0) {
              						foreach($last_50_players['results'] as $player) {
              							echo "<tr>";
              								echo "<td>".strtoupper($player['platform'])."</td>";
              								echo "<td>".$player['personaName']."</td>";
              								echo "<td>".$player['player_name']."</td>";
              								echo "<td>".$player['player_rating']."</td>";
              								echo "<td>".number_format($player['max_bin'])."</td>";
              								echo "<td>".$functions->newTime($player['player_added'])."</td>";
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
              					} else {
              						echo "<tr>";
              							echo "<td colspan='7'>No recently added players</td>";
              						echo "</tr>";
              					}
              				?>
              			</tbody>
              		</table>
            	</div>
	</div>
</div>