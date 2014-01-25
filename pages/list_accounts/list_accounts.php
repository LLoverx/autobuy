<div class="content-header">
	<h1>
		<a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            	<?=ucfirst(str_replace("_", " ", $page));?>
	</h1>
</div>
<div class="page-content inset">
	<div class="row">
            	<div class="col-md-12">
              		<table class="table table-bordered table-striped" id="list_accounts">
              			<thead>
              				<tr>
              					<th>Account</th>
              					<th>Last used</th>
              					<th>Date Created</th>
              					<th>Status</th>
              				</tr>
              			</thead>
              			<tbody>
              				<?
              					if($results['rows'] > 0) {
              						foreach($arrayAccounts as $account) {
              							switch($account['status']) {
              								case "0":
              									$status = "<label class='label label-info'>Spoofing</label>";
              								break;
              								case "1":
              									$status = "<label class='label label-success'>Online</label>";
              								break;
              								case "2":
              									$status = "<label class='label label-danger'>Disabled</label>";
              								break;
              								case "3":
              									$status = "<label class='label label-danger'>Checkpoint</label>";
              								break;
              								case "6":
              									$status = "<label class='label label-danger'>Disabled</label>";
              								break;
              							}
              				?>
              							<tr>
              								<td><?=$account['username'].":".$account['password'];?></td>
              								<td><?=$functions->newTime($account['last_used']);?></td>
              								<td><?=$functions->newTime($account['date_created']);?></td>
              								<td><?=$status;?></td>
              							</tr>
              				<?
              						}
              					}
              				?>
              			</tbody>
              		</table>
            	</div>
	</div>
</div>