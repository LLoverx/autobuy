<?php
$total_profit = 0;
foreach($arrayTransactions as $trans){
	$total_profit += $trans['profit'];
}
?>

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
              					<th width="30%">Player name</th>
              					<th width="25%">Buy BIN</th>
              					<th width="20%">Profit (<?=$total_profit;?>)</th>
              					<th width="15%">Sold</th>
              					<th width="5%">Status</th>
              				</tr>
              			</thead>
              			<tbody>
              				<?
          					if($rec_count > 0) {
          						foreach($arrayTransactions as $transaction) {
          							$ago = strtotime($transaction['sold_time']);
          							$ago = time()-$ago;
          							$ago = $functions->secondsToWords($ago);
          							echo "<tr>";
          								echo "<td>".$transaction['player_name']."</td>";
          								echo "<td>".number_format($transaction['buy_bin'])."</td>";
          								$profit = $transaction['profit'];
          								echo "<td>".number_format($profit)."</td>";
          								echo "<td>".$ago."</td>";
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