<div class="content-header">
	<h1>
		<a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            	<?=ucfirst(str_replace("_"," ",$page));?>
	</h1>
</div>
<div class="page-content inset">
	<div class="row">
            	<div class="col-md-12">
            		<div id="ajaxResponse"></div>
            	</div>
            	<div class="col-md-12">
              		<div class="btn-group btn-group-justified">
        			<a class="btn btn-success" role="button" id="updateCoins" data-id="<?=$uri[1];?>">Update Coins</a>
        			<a class="btn btn-default" role="button" id="updateSession" data-id="<?=$uri[1];?>">Reset Session</a>
        			<a class="btn btn-danger" role="button" id="deleteAccount" data-id="<?=$uri[1];?>">Delete Account</a>
      			</div>
            	</div>
            	<div class="col-md-12" style="margin-top:10px;">
            		
            		<ul class="nav nav-tabs">
  				<li class="active"><a href="#purchases" data-toggle="tab">Last 50 Purchases</a></li>
  				<li><a href="#sales" data-toggle="tab">Last 50 Sales</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
  				<div class="tab-pane fade in active" id="purchases">
  					<table class="table table-bordered table-striped">
              					<thead>
              						<tr>
              							<th>Player</th>
              							<th>Rating</th>
              							<th>Price Purchased</th>
              							<th>Price Selling</th>
              							<th>Status</th>
              						</tr>
              					</thead>
              					<tbody>
              						<tr>
              							<td colspan="5">Currently no data to display</td>
              						</tr>
              					</tbody>
              				</table>
  				</div>
  				<div class="tab-pane fade in" id="sales">
  					<table class="table table-bordered table-striped">
              					<thead>
              						<tr>
              							<th>Player</th>
              							<th>Rating</th>
              							<th>Price Purchased</th>
              							<th>Price Sold</th>
              							<th>Profit</th>
              						</tr>
              					</thead>
              					<tbody>
              						<tr>
              							<td colspan="5">Currently no data to display</td>
              						</tr>
              					</tbody>
              				</table>
  				</div>	
  			</div>
            	</div>
	</div>
</div>