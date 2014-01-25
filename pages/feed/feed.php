<div class="content-header">
	<h1>
		<a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            	<?=ucfirst($page);?>
	</h1>
</div>
<div class="page-content inset">
	<div class="row">
            	<div class="col-md-12">
              		<table class="table table-bordered table-striped" id="accounts">
              			<thead>
              				<tr>
              					<th>Player name</th>
              					<th>Account</th>
              					<th>Buy BIN</th>
              					<th>Sell BIN</th>
              					<th>Profit</th>
              					<th>Status</th>
              				</tr>
              			</thead>
              			<tbody>
              				<?
              					if($rec_count > 0) {
              						foreach($arrayTransactions as $transaction) {
              							echo "<tr>";
              								echo "<td>".$transaction['player_name']."</td>";
              								echo "<td>".$transaction['personaName']."</td>";
              								echo "<td>".number_format($transaction['buy_bin'])."</td>";
              								echo "<td>".number_format($transaction['sell_bin'])."</td>";
              								$profit = ($transaction['sell_bin']*0.95) - $transaction['buy_bin'];
              								echo "<td>".number_format($profit)."</td>";
              								switch($transaction['sold_time']) {
              									case "0000-00-00 00:00:00":
              										$status = "<label class='label label-info'>Selling</label>";
              									break;
              									default:
              										$status = "<label class='label label-success'>Sold</label>";
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