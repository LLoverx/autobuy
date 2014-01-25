<div class="content-header">
	<h1>
		<a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            	<?=ucfirst(str_replace("_"," ",$page));?>
	</h1>
</div>
<div class="page-content inset">
	<div class="row">
            	<div class="col-md-12">
            		<div id="loadingHolder" class="loadingHolder">
				<img src="/design/images/loading.gif" alt="Loading.."/>
				<h3>Loading data</h3>
				<i>Please wait</i>
			</div>
            	</div>
            	<div class="col-md-12">
            		<div id="ajaxResponse"></div>
            	</div>
            	<div class="col-md-12">
              		<center>
              			<label class="radio-inline">
  					<input type="radio" name="consoleOption" value="xbox360">
  					Xbox 360
				</label>
				<label class="radio-inline">
  					<input type="radio" name="consoleOption" value="ps3" checked>
  					Playstation 3
				</label>
			</center>
            	</div>
            	<div class="col-md-12" style="margin-top:10px;">
            		<form role="form" id="searchPlayer" class="well">
            			<div class="input-group">
      					<span class="input-group-addon">
      						<select id="player_position">
							<option value="any">Select position</option>
							<option value="Defenders">Defenders</option>
							<option value="Midfielders">Midfielders</option>
							<option value="Attackers">Attackers</option>
							<option value="GK">GK</option>
							<option value="LWB">LWB</option>
							<option value="LB">LB</option>
							<option value="CB">CB</option>
							<option value="RB">RB</option>
							<option value="RWB">RWB</option>
							<option value="CDM">CDM</option>
							<option value="LM">LM</option>
							<option value="CM">CM</option>
							<option value="RM">RM</option>
							<option value="CAM">CAM</option>
							<option value="LW">LW</option>
							<option value="RW">RW</option>
							<option value="LF">LF</option>
							<option value="CF">CF</option>
							<option value="RF">RF</option>
							<option value="ST">ST</option>
						</select>
      					</span>
      					<input type="hidden" id="selectedOption" value="360">
      					<input type="text" class="form-control" id="name_display" value="" style="display:none;" disabled>
      					<input type="text" class="form-control" id="player_search" placeholder="Start to type for dropdown to appear">
      					<input type="hidden" id="flevel" name="flevel" value="">
              				<input type="hidden" id="fid" name="fid" value="">
              				<input type="hidden" id="frating" name="frating" value="">
              				<input type="hidden" id="fnation" name="fnation" value="">
              				<input type="hidden" id="fclub" name="fclub" value="">
      					<span class="input-group-btn">
        					<button class="btn btn-success" id="submitSearch" type="submit">Search!</button>
      					</span>
    				</div>
            		</form>
            	</div>
            	<div class="col-md-12">
            		<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Platform</th>
						<th>Chemistry Style</th>
						<th>Position</th>
						<th>Start price</th>
						<th>Current price</th>
						<th>Time remaining</th>
						<th>Buy now price</th>
					</tr>
				</thead>
				<tbody id="responseResult">
					<tr>
						<td colspan="7">Please search for a player...</td>
					</tr>
				</tbody>
			</table>
            	</div>
	</div>
</div>