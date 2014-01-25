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
              					<th>Persona</th>
              					<th>Platform</th>
              					<th>Coins</th>
              					<th>Status</th>
              				</tr>
              			</thead>
              			<tbody>
              				<?
              					if($rec_count > 0) {
              						foreach($arrayAccounts as $account) {
              							echo "<tr>";
              								echo "<td><a href='/manage_account/".$account['id']."'>".$account['personaName']."</a></td>";
              								switch(strtolower($account['platform'])) {
              									case "360":
              										$console = "Xbox 360";
              									break;
              									case "ps3":
              										$console = "PS3";
              									break;
              									case "xboxone":
              										$console = "Xbox One";
              									break;
              									case "ps4":
              										$console = "PS4";
              									break;
              								}
              								echo "<td>".$console."</td>";
              								echo "<td>".number_format($account['coins'])."</td>";
              								switch($account['status']) {
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