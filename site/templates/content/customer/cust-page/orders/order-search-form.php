<form action="<?php echo $config->pages->orders."redir/"; ?>" method="post" id="order-search-form" data-loadinto="#orders-panel" data-focus="#orders-panel" data-modal="#ajax-modal" class="fuelux">
   		<input type="hidden" name="custID" value="<?php echo $custID; ?>">  <input type="hidden" name="action" value="search-cust-orders">
        <input type="hidden" name="shipID" value="<?php echo $shipID; ?>">
        <div class="input-group form-group">
            <div class="input-group-btn search-panel">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="showfilter">Filter by</span> <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#ALL" selected="selected" class="searchfilter">All</a></li> <li><a href="#PON" class="searchfilter">Customer PO</a></li>
                    <li><a href="#SON" class="searchfilter">Order / Invoice Number</a></li> <li><a href="#ITM" class="searchfilter">Item ID</a></li>
					<li><a href="#TRK" class="searchfilter">Tracking #</a></li>
                </ul>
            </div>
            <input type="hidden" name="searchtype" value="all" class="search_param">
            <input type="text" class="form-control" name="q" placeholder="Search term...">
            <span class="input-group-btn"> <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button> </span>
        </div>
        <div class="row">
            <div class="form-group col-xs-12 col-sm-4">
                <button class="btn btn-block btn-primary" type="button" data-toggle="collapse" data-target="#order-search-dates" aria-expanded="false" aria-controls="order-search-dates">
                Show Date Search Options
                </button>
            </div>
            <div id="order-search-dates" class="collapse">
                <div class="col-xs-10 col-sm-4 form-group">
                    <label class="control-label">From Date </label>
                    <?php $name = 'date-from'; $value=""; ?>
                    <?php include $config->paths->content."common/date-picker.php"; ?>
                </div>
                <div class="col-xs-10 col-sm-4 form-group">
                    <label class="control-label">Through Date </label>
                    <?php $name = 'date-through'; $value=""; ?>
                    <?php include $config->paths->content."common/date-picker.php"; ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Order Status: </label>
            <select name="orderstatus" class="form-control autowidth" tabindex="1">
            	<option value="H">Shipped</option>  <option value="O">Open Order</option> <option value="B" selected="selected">Both</option>
            </select>
        </div>
        <div class="form-group">
        	<button class="btn btn-success btn-block" type="submit">Search</button>
        </div>
    </form>
