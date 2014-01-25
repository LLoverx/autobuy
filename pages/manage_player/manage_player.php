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
            		<form role="form" id="updatePlayer">
  				<input type="hidden" name="myplayer_id" value="<?=$uri[1];?>">
  				<legend><?=$player_datails['player_name'];?></legend>
  				<div class="form-group">
    					<label for="account">Account</label>
    					<select class="form-control" name="account_id">
    						<?
    							$db->connect();
    							$accounts = $db->get("accounts");
    							foreach($accounts as $account) {
    								if($player_datails['account_id'] == $account['id']) {
    									echo "<option value='".$account['id']."' selected>".$account['personaName']."</option>";
    								} else {
    									echo "<option value='".$account['id']."'>".$account['personaName']."</option>";
    								}
    							}
    							$db->disconnect();
    						?>
    					</select>
  				</div>
  				<div class="form-group">
    					<label for="player_pos">Player Position</label>
    					<select class="form-control" name="player_pos">
    						<?
    							$positions = array(
    								"GK","LWB","LB","CB","RB","RWB","CDM","CM","CAM","CF","ST","RM","RW","RF","LM","LW","LF"
    							);
    							foreach($positions as $position) {
    								if($position == $player_datails['player_pos']) {
    									echo "<option value='".$position."' selected>".$position."</option>";
    								} else {
    									echo "<option value='".$position."'>".$position."</option>";
    								}
    							}
    						?>
    					</select>
  				</div>
  				<div class="form-group">
    					<label for="status">Auto update prices</label>
    					<select class="form-control" name="price_update" id="autoupdate">
    						<option value="1" <?=($player_datails['price_update'] == 1) ? 'selected' : ''?>>Yes</option>
    						<option value="0" <?=($player_datails['price_update'] == 0) ? 'selected' : ''?>>No</option>
    					</select>
  				</div>
  				<div class="form-group" style="display:none;" id="max_bin">
    					<label for="max_bin">Max BIN</label>
    					<input type="text" class="form-control" name="max_bin" value="<?=$player_datails['max_bin'];?>">
  				</div>
  				<div class="form-group" style="display:none;" id="sell_bin">
    					<label for="max_bin">Sell BIN</label>
    					<input type="text" class="form-control" name="sell_bin" value="<?=$player_datails['sell_bin'];?>">
  				</div>
  				<div class="form-group">
    					<label for="status">Status</label>
    					<select class="form-control" name="player_status">
    						<option value="0" <?=($player_datails['player_status'] == 0) ? 'selected' : ''?>>Disabled</option>
    						<option value="1" <?=($player_datails['player_status'] == 1) ? 'selected' : ''?>>Enabled</option>
    					</select>
  				</div>
  				<div class="form-group">
    					<button type="submit" class="btn btn-success pull-right">Update</button>
  				</div>
            		</form>
            	</div>
	</div>
</div>