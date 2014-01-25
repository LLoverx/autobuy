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
  					<input type="radio" name="consoleOption" value="xbox360" checked>
  					Xbox 360
				</label>
				<label class="radio-inline">
  					<input type="radio" name="consoleOption" value="ps3">
  					Playstation 3
				</label>
				<input type="hidden" id="selectedOption" value="360">
			</center>
            	</div>
            	<div class="col-md-12">
            		<form role="form" id="addAccount">
            			<div class="form-group">
    					<label for="email">Email address</label>
    					<input type="email" class="form-control" id="email" placeholder="Enter EA email">
  				</div>
  				<div class="form-group">
    					<label for="password">Password</label>
    					<input type="password" class="form-control" id="password" placeholder="Enter EA password">
  				</div>
  				<div class="form-group">
    					<label for="secret">Secret Answer</label>
    					<input type="text" class="form-control" id="secret" placeholder="Enter EA security answer">
  				</div>
  				<div class="form-group">
    					<button type="submit" class="btn btn-success pull-right">Submit</button>
  				</div>
            		</form>
            	</div>
	</div>
</div>