<section class="generic">
	<div class="container">
	
	<form method="POST" action="{$smarty.server.PHP_SELF}" class="">
		<div class="form-inline form-dark">
			<h2>Search for top performers</h2>
			<br />
			<div class="form-group">
				<strong>Find the top {$limit} performing securities based on their:</strong>
				<br>
				<br>
				<select name="criteria" class="form-inline form-control">
					<option value="q.percent_change"{if $smarty.session.search.criteria == 'q.percent_change'}selected{/if}>Percentage change today</option>
					<option value="q.percent_change_from_fifty_day_moving_average"{if $smarty.session.search.criteria == 'q.percent_change_from_fifty_day_moving_average'}selected{/if}>Change from 50 day moving average</option>
					<option value="q.percent_change_from_two_hundred_day_moving_average"{if $smarty.session.search.criteria == 'q.percent_change_from_two_hundred_day_moving_average'}selected{/if}>Change from 200 day moving average</option>
					<option value="q.percent_change_from_year_low"{if $smarty.session.search.criteria == 'q.percent_change_from_year_low'}selected{/if}>Difference between year low and current price</option>
					<option value="q.percent_change_from_year_high"{if $smarty.session.search.criteria == 'q.percent_change_from_year_high'}selected{/if}>Difference between year high and current price</option>
					<option value="q.year_range_percent"{if $smarty.session.search.criteria == 'q.year_range_percent'}selected{/if}>Volatility</option>
					<option value="q.volume"{if $smarty.session.search.criteria == 'q.volume'}selected{/if}>Daily Volume</option>
					<option value="q.market_cap"{if $smarty.session.search.criteria == 'q.market_cap'}selected{/if}>Market Capitalisation</option>
					<option>3 month ROAR</option>
					<option>6 month ROAR</option>
					<option>12 month ROAR</option>
				</select>
			</div>
			<br />
			<br />
			<div class="form-group">
				<strong>Sort results:</strong>
				<br />
				
				<input type="radio" id="order_direction_DESC" name="order_direction" value="DESC" class="form-inline form-control" {if $smarty.session.search.order_direction == 'DESC' OR empty($smarty.session.search.order_direction)}checked{/if}><label for="order_direction_DESC" class="form-inline" style="color: green">Highest to Lowest&nbsp;&nbsp;&nbsp;&nbsp;</label>
				
				<input type="radio" id="order_direction_ASC" name="order_direction" value="ASC" class="form-inline form-control" {if $smarty.session.search.order_direction == 'ASC'}checked{/if}> <label for="order_direction_ASC" class="form-inline" style="color: red">Lowest to Highest</label>
				<br />
				<br />
			</div>
			<div class="form-group">
				<strong>Within the following industries:</strong>
				<br />
				<br />
				<input type="checkbox" id="select_all" name="select_all" value="1" {if $smarty.session.search.select_all}checked{else if !$smarty.session.search}checked{/if}/><label for="select_all"><i><strong>Select All</strong></i></label>
				<ul class="checkbox-grid clearfix">
					{foreach from=$industries key=i item=row}
						<li><input type="checkbox" name="industry[{$i}]" value="{$row.industry}" class="checkbox" id="industry_{$i}"{if $smarty.session.search.industry[{$i}]}checked{else if !$smarty.session.search}checked{/if}><label for="industry_{$i}">{$row.industry}</label></li>
					{/foreach}
				</ul>
			</div>
			
			<div class="form-group">
				<strong>With a market capilisation of at least: &nbsp;&nbsp;<input type="text" name="user_market_cap" class="form-control" id="user_market_cap" placeholder="$ million" maxlength="6" max="999999" style="width: 100px" value="{if $smarty.session.search.user_market_cap}{$smarty.session.search.user_market_cap}{/if}"> (does not apply to ETF's, REIT's and LIC's)
			</div>
			<br />
			<br />
			<div class="form-group">
				<strong>Further restrictions:
				<br />
				<br />
				<input type="checkbox" name="roths_top_stocks" id="roths_top_stocks" value="1" {if $smarty.session.search.roths_top_stocks}checked{/if} /><label for="roths_top_stocks"><i><strong>Results must be in Martin Roth's Top Stocks List 2017</strong></i></label>
			</div>
			<br />
			<br />
			<div class="form-group">
				<input type="checkbox" name="etf_only" id="etf_only" value="1" {if $smarty.session.search.etf_only}checked{/if} /><label for="etf_only"><i><strong>Results must be ETF's, REIT's, or LIC's only</strong></i></label> 
			</div>
			<br />
			<br />
			<input type="submit" value="Search" class="btn btn-primary">&nbsp;&nbsp;<input type="submit" name="reset" value="Reset" class="btn btn-warning">
			<br>
			<br>
			
			
		</div>
	</form>
	<hr class="star-primary">	
	
	{if $smarty.post}
	
		<!-- About Section -->
				<div class="row">
					<div class="col-lg-12">
						<h3>Top {$limit} performing ASX securities for {$date}</h3>
						<br />
						 <h4>Based on their <span class="{$smarty.post.order_direction}">{str_replace('_',' ',{str_replace('q.','',$smarty.post.criteria)})}</span></h4>
						<br />
						<strong><i>{count($results)} results found.</i></strong>
						<br />
						<br />
					</div>
					<div class="col-lg-8 col-lg-offset-2 text-center">
						<!--<a href="#" class="btn btn-lg btn-outline">
							<i class="fa fa-download"></i> Download Theme
						</a>-->
					</div>
				</div>
				
				
		{if $results}
			{foreach from=$results key=i item=row}
				<div class="row-result">
					<div class="row">
						<h3>{$i+1}</h3>
						<div class="col-lg-3 text-left"><strong>security_id: </strong></div>
						<div class="col-lg-9 text-left">{$row.security_id}</div>
					</div>
					
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Name: </strong></div>
						<div class="col-lg-9 text-left">{$row.name}</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Symbol: </strong></div>
						<div class="col-lg-9 text-left">{$row.symbol}</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Last updated: </strong></div>
						<div class="col-lg-9 text-left">{$row.last_trade_date}</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Percent change today: </strong></div>
						<div class="col-lg-9 text-left">
						{if $smarty.post.criteria == 'q.percent_change'}
							<span class="{$smarty.post.order_direction}">{round($row.percent_change,2)}%</span>
						{else}
							<strong>{round($row.percent_change,2)}%</strong>
						{/if}
						
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Price: </strong></div>
						<div class="col-lg-9 text-left">
						{if $smarty.post.criteria == 'q.percent_change_from_year_low' OR $smarty.post.criteria == 'q.percent_change_from_year_high'}
							<span class="{$smarty.post.order_direction}">{$row.last_trade_price}</span>
						{else}
							{$row.last_trade_price}
						{/if}
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Volume: </strong></div>
						<div class="col-lg-9 text-left">{yahooData::addNumberShorthand($row.volume)}</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Year Range: </strong></div>
						<div class="col-lg-9 text-left">
						{if $smarty.post.criteria == 'q.percent_change_from_year_low'}
							<span class="{$smarty.post.order_direction}">{$row.year_low}</span> - {$row.year_high} ({$row.year_range_percent}% volatility)
						{else if $smarty.post.criteria == 'q.percent_change_from_year_high'}
							{$row.year_low} - <span class="{$smarty.post.order_direction}">{$row.year_high}</span> ({$row.year_range_percent}% volatility)
						{else if $smarty.post.criteria == 'q.year_range_percent'}
							<h4>{$row.year_low} - {$row.year_high} <span class="{$smarty.post.order_direction}">({$row.year_range_percent}% volatility)</h4>
						{else}
							{$row.year_low} - {$row.year_high} ({$row.year_range_percent}% volatility)
						{/if}
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>50 day moving average: </strong></div>
						<div class="col-lg-9 text-left">{round($row.fifty_day_moving_average,2)}</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>200 day moving average: </strong></div>
						<div class="col-lg-9 text-left">{round($row.two_hundred_day_moving_average,2)}</div>
					</div>
					
					{if $smarty.post.criteria == 'q.percent_change_from_fifty_day_moving_average'}
						
						<div class="row">
							<div class="col-lg-3 text-left"><strong>Change from 50 day moving average: </strong></div>
							<div class="col-lg-9 text-left"><span class="{$smarty.post.order_direction}">{round($row.percent_change_from_fifty_day_moving_average,1)}%</span>
							</div>
						</div>
					
					{else if $smarty.post.criteria == 'q.percent_change_from_two_hundred_day_moving_average'}
						
						<div class="row">
							<div class="col-lg-3 text-left"><strong>Change from 200 day moving average: </strong></div>
							<div class="col-lg-9 text-left"><span class="{$smarty.post.order_direction}">{round($row.percent_change_from_two_hundred_day_moving_average,1)}%</span></div>
						</div>
						
					{else if $smarty.post.criteria == 'q.percent_change_from_year_low'}
					
						<div class="row">
							<div class="col-lg-3 text-left"><strong>Change from year low: </strong></div>
							<div class="col-lg-9 text-left"><span class="{$smarty.post.order_direction}">{round($row.percent_change_from_year_low,1)}%</span></div>
						</div>
						
					{else if $smarty.post.criteria == 'q.percent_change_from_year_high'}
					
						<div class="row">
							<div class="col-lg-3 text-left"><strong>Change from year high: </strong></div>
							<div class="col-lg-9 text-left"><span class="{$smarty.post.order_direction}">{round($row.percent_change_from_year_high,1)}%</span></div>
						</div>
					{/if}
					
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Market Cap: </strong></div>
						<div class="col-lg-9 text-left">{yahooData::addNumberShorthand($row.market_cap)}</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong>Industry: </strong></div>
						<div class="col-lg-9 text-left">{$row.industry}</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left"><strong></strong></div>
						<div class="col-lg-9 text-left">
						<a href="http://www.asx.com.au/prices/charting/?code={$row.symbol}&compareCode=&chartType=&priceMovingAverage1=&priceMovingAverage2=&volumeIndicator=&volumeMovingAverage=&timeframe=">
						ASX Graph</a> | 
						<a href="https://www.cmcmarketsstockbroking.com.au/net/ui/Research/Research.aspx?asxcode={$row.symbol}#">
						CMC Graph</a>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 text-left">&nbsp;</div>
						<div class="col-lg-9 text-left">&nbsp;</div>
					</div>
					
					<!-- draw a chart for symbol -->
					<div class="row">
						<div class="col-lg-12"><h3>Chart</h3></div>
					</div>
					<div class="row">
						<div class="col-lg-12">
						
						 <iframe src="/charts/draw_chart.php?s={$row.symbol}&w=450&h=450&rand={rand()}" style="margin: 0; padding: 0; width: 500px; height: 500px;"></iframe> 
						
						</div>
						</div>
					</div>
					
				</div>
			{/foreach}
					
		{/if}
	{/if}
	
	{if !$smarty.post}
		
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	{/if}
	
	</div>
</section>