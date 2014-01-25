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
              		<center>
              			<label class="radio-inline">
  					<input type="radio" name="purchaseOption" value="buy" checked>
  					Buying
				</label>
				<label class="radio-inline">
  					<input type="radio" name="purchaseOption" value="bid">
  					Bidding
				</label>
				<input type="hidden" id="selectedOption" value="360">
			</center>
            	</div>
            	<div class="col-md-12">
            		<form role="form" id="addPlayer">
            			<div class="form-group">
    					<label for="player_search">Player name</label>
    					<input type="text" class="form-control" id="player_search" placeholder="Start to type for dropdown to appear">
    					<input type="text" class="form-control" id="name_display" value="" style="display:none;" disabled>
  				</div>
  				<div class="form-group">
    					<label for="account">Account</label>
    					<select class="form-control" name="account_id">
    						<?
    							$db->connect();
    							$accounts = $db->get("accounts");
    							foreach($accounts as $account) {
    								echo "<option value='".$account['id']."'>".$account['personaName']."</option>";
    							}
    							$db->disconnect();
    						?>
    					</select>
  				</div>
  				<div class="form-group">
    					<label for="player_pos">Player Position</label>
    					<select class="form-control player_pos_selec" name="player_pos">
    						<?
    							$positions = array(
    								"GK","LWB","LB","CB","RB","RWB","CDM","CM","CAM","CF","ST","RM","RW","RF","LM","LW","LF"
    							);
    							foreach($positions as $position) {
    								echo "<option value='".$position."'>".$position."</option>";
    							}
    						?>
    					</select>
  				</div>
  				<div class="form-group">
    					<label for="status">Auto update prices</label>
    					<select class="form-control" name="price_update" id="autoupdate">
    						<option value="1">Yes</option>
    						<option value="0" selected="">No</option>
    					</select>
  				</div>
  				<div class="form-group" id="max_bin">
    					<label for="max_bin">Max BIN</label>
    					<input type="text" class="form-control" name="max_bin" placeholder="25000" value="600">
  				</div>
  				<div class="form-group" style="display:none;" id="sell_bin">
    					<label for="max_bin">Sell BIN</label>
    					<input type="text" class="form-control" name="sell_bin" placeholder="50000" value="0">
  				</div>
  				<div class="form-group">
    					<label for="status">Status</label>
    					<select class="form-control" name="player_status">
    						<option value="0">Disabled</option>
    						<option value="1" selected="">Enabled</option>
    					</select>
  				</div>
  				<div class="form-group">
    					<input type="hidden" id="player_id" name="player_id" value="">
    					<input type="hidden" id="player_name" name="player_name" value="">
    					<input type="hidden" id="club_id" name="player_clubid" value="">
    					<input type="hidden" id="nation_id" name="player_nationid" value="">
    					<input type="hidden" id="rating" name="player_rating" value="">
    					<input type="hidden" id="level" name="player_level" value="">
    					<input type="hidden" id="revision_type" name="revision_type" value="">
    					<input type="hidden" id="attr1" name="player_attr1" value="">
    					<input type="hidden" id="attr2" name="player_attr2" value="">
    					<input type="hidden" id="attr3" name="player_attr3" value="">
    					<input type="hidden" id="attr4" name="player_attr4" value="">
    					<input type="hidden" id="attr5" name="player_attr5" value="">
    					<input type="hidden" id="attr6" name="player_attr6" value="">
    					<button type="submit" class="btn btn-success pull-right">Submit</button>
  				</div>
            		</form>
            	</div>
	</div>
</div>