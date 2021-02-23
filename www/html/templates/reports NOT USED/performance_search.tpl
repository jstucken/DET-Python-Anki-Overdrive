<section class="generic">
	<div class="container">
	
	<form method="POST" action="{$smarty.server.PHP_SELF}" class="">
		<div class="form-inline form-dark">
			<h2>RSI Search</h2>
			<br />
			<div class="form-group">
				<strong>Find the top {$limit} securities based on their:</strong>
				<br>
				<br>
				<select name="criteria" class="form-inline form-control">
					<option value="stats.rsi"{if $smarty.session.search.criteria == 'stats.rsi'}selected{/if}>RSI</option>
					<option value="stats.rsi"{if $smarty.session.search.criteria == 'stats.stochtastic'}selected{/if}>Stochtastic level</option>
					<option value="stats.average_growth"{if $smarty.session.search.criteria == 'stats.average_growth'}selected{/if}>Short term average beating long term average</option>
					<option value="stats.average_growth_long"{if $smarty.session.search.criteria == 'stats.average_growth_long'}selected{/if}>Medium term average beating extra long term average</option>
					<option value="stats.percent_change"{if $smarty.session.search.criteria == 'stats.percent_change'}selected{/if}>Percentage change recently</option>
					<option value="stats.percent_change_from_fifty_day_moving_average"{if $smarty.session.search.criteria == 'stats.percent_change_from_fifty_day_moving_average'}selected{/if}>Change from 50 day moving average</option>
					<option value="stats.percent_change_from_two_hundred_day_moving_average"{if $smarty.session.search.criteria == 'stats.percent_change_from_two_hundred_day_moving_average'}selected{/if}>Change from 200 day moving average</option>
					<option value="stats.percent_change_from_year_low"{if $smarty.session.search.criteria == 'stats.percent_change_from_year_low'}selected{/if}>Difference between year low and current price</option>
					<option value="stats.percent_change_from_year_high"{if $smarty.session.search.criteria == 'stats.percent_change_from_year_high'}selected{/if}>Difference between year high and current price</option>
					<option value="stats.year_range_percent"{if $smarty.session.search.criteria == 'stats.year_range_percent'}selected{/if}>Volatility</option>
					<option value="historicals.volume"{if $smarty.session.search.criteria == 'historicals.volume'}selected{/if}>Daily Volume</option>
					<option value="stats.market_cap"{if $smarty.session.search.criteria == 'stats.market_cap'}selected{/if}>Market Capitalisation</option>
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
				<strong>With a market capilisation of at least: &nbsp;&nbsp;<input type="text" name="user_market_cap" class="form-control" id="user_market_cap" placeholder="$ million" maxlength="8" max="9999999" style="width: 100px" value="{if $smarty.session.search.user_market_cap}{$smarty.session.search.user_market_cap}{/if}"> (does not apply to ETF's, REIT's and LIC's)
			</div>
			<br />
			<div class="form-group">
				<strong>Having a last trading volume of at least: &nbsp;&nbsp;<input type="text" name="user_volume" class="form-control" id="user_volume" placeholder="Enter volume" maxlength="10" max="9999999999" style="width: 130px" value="{if $smarty.session.search.user_volume}{$smarty.session.search.user_volume}{/if}">
			</div>
			<br />
			<br />
			<div class="form-group">
				<strong>Further restrictions:
				<br />
				<br />
				<input type="checkbox" name="top_300" id="top_300" value="1" {if $smarty.session.search.top_300}checked{/if} /><label for="top_300"><i><strong>Securities must be in the top 300 largest in ASX (Based on market cap)</strong></i></label>
			</div>
			<br />
			<br />
			<div class="form-group">
				<input type="checkbox" name="etf_only" id="etf_only" value="1" {if $smarty.session.search.etf_only}checked{/if} /><label for="etf_only"><i><strong>Results must be ETF's or REIT's only</strong></i></label> 
			</div>
			<br />
			<br />
			<div class="form-group">
				<strong>Sort results by:</strong>
				<br />
				<br />
				<input type="radio" name="order_by" id="order_by1" value="default" {if $smarty.session.search.order_by=='default' OR empty($smarty.session.search.order_by)}checked{/if} /><label for="order_by1"><i><strong>Search default</strong></i></label> 
				
				<input type="radio" name="order_by" id="order_by2" value="rsi" {if $smarty.session.search.order_by=='rsi'}checked{/if} /><label for="order_by2"><i><strong>Lowest RSI</strong></i></label>
				
				<input type="radio" name="order_by" id="order_by3" value="macd" {if $smarty.session.search.order_by=='macd'}checked{/if} /><label for="order_by3"><i><strong>Lowest MACD</strong></i></label> 				
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
						 <h4>Based on their <span class="{$smarty.post.order_direction}">{str_replace('_',' ',{str_replace('stats.','',$smarty.post.criteria)})}</span></h4>
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
			{foreach from=$results key=i item=result}
				<div class="row-result">
					<div class="row">
						<h3>{$i+1}. <a href="get_quote.php?symbol={$result.symbol}">{$result.symbol}</a> - {$result.name}</h3>
						<div class="col-lg-2 text-left"><strong>security_id: </strong></div>
						<div class="col-lg-10 text-left">{$result.security_id}</div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 text-left"><strong>RSI: </strong></div>
						<div class="col-lg-10 text-left">
						{if $smarty.post.criteria == 'stats.rsi'}
							<span class="{$smarty.post.order_direction}">{round($result.rsi,2)}</span>
						{else}
							{round($result.rsi,2)}
						{/if}
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 text-left"><strong>RSI last updated: </strong></div>
						<div class="col-lg-10 text-left">{$result.rsi_date}</div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Category: </strong></div>
						<div class="col-lg-10 text-left">{$result.category}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Industry: </strong></div>
						<div class="col-lg-10 text-left">{$result.industry}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Market Cap: </strong></div>
						<div class="col-lg-10 text-left">{db::addNumberShorthand($result.market_cap)}</div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 text-left"><strong>ASX largest rank: </strong></div>
						<div class="col-lg-10 text-left">{$result.top_300_rank} / 300</div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 text-left">&nbsp;</div>
						<div class="col-lg-10 text-left">&nbsp;</div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 text-left"><strong>MACD: </strong></div>
						<div class="col-lg-10 text-left">{$result.macd}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>MACD Signal: </strong></div>
						<div class="col-lg-10 text-left">{$result.macd_signal}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>MACD Histogram: </strong></div>
						<div class="col-lg-10 text-left">{$result.macd_hist}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>MACD Last Updated: </strong></div>
						<div class="col-lg-10 text-left">{$result.macd_date}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left">&nbsp;</div>
						<div class="col-lg-10 text-left">&nbsp;</div>
					</div>
					
					
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Price: </strong></div>
						<div class="col-lg-10 text-left">{$result.close}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Last Volume: </strong></div>
						<div class="col-lg-10 text-left">
						{if $smarty.post.criteria == 'historicals.volume'}
							<span class="{$smarty.post.order_direction}">{$result.volume}</span>
						{else}
							{$result.volume}
						{/if}
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Last Price/Volume Date: </strong></div>
						<div class="col-lg-10 text-left">{$result.historicals_date}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Year Range: </strong></div>
						<div class="col-lg-10 text-left">
						{if $smarty.post.criteria == 'stats.percent_change_from_year_low'}
							<span class="{$smarty.post.order_direction}">{$result.year_low}</span> - {$result.year_high} ({$result.year_range_percent}% volatility)
						{else if $smarty.post.criteria == 'stats.percent_change_from_year_high'}
							{$result.year_low} - <span class="{$smarty.post.order_direction}">{$result.year_high}</span> ({$result.year_range_percent}% volatility)
						{else if $smarty.post.criteria == 'stats.year_range_percent'}
							<h4>{$result.year_low} - {$result.year_high} <span class="{$smarty.post.order_direction}">({$result.year_range_percent}% volatility)</h4>
						{else}
							{$result.year_low} - {$result.year_high} ({$result.year_range_percent}% volatility)
						{/if}
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 text-left">&nbsp;</div>
						<div class="col-lg-10 text-left">&nbsp;</div>
					</div>
					
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Average Growth: </strong></div>
						<div class="col-lg-10 text-left">{if $smarty.post.criteria == 'stats.average_growth'}
							<span class="{$smarty.post.order_direction}">{$result.average_growth}</span>{else}{$result.average_growth}{/if}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>Average Growth Longterm: </strong></div>
						<div class="col-lg-10 text-left">{if $smarty.post.criteria == 'stats.average_growth_long'}
							<span class="{$smarty.post.order_direction}">{$result.average_growth_long}</span>{else}{$result.average_growth_long}{/if}</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>3 day moving average: </strong></div>
						<div class="col-lg-10 text-left">{$result.3_day_avg} ({$result.percent_change_from_3_day_avg}% difference)</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>5 day moving average: </strong></div>
						<div class="col-lg-10 text-left">{$result.5_day_avg} ({$result.percent_change_from_5_day_avg}% difference)</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>10 day moving average: </strong></div>
						<div class="col-lg-10 text-left">{$result.10_day_avg} ({$result.percent_change_from_10_day_avg}% difference)</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>50 day moving average: </strong></div>
						<div class="col-lg-10 text-left">{$result.50_day_avg} ({$result.percent_change_from_50_day_avg}% difference)</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>100 day moving average: </strong></div>
						<div class="col-lg-10 text-left">{$result.100_day_avg} ({$result.percent_change_from_100_day_avg}% difference)</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>200 day moving average: </strong></div>
						<div class="col-lg-10 text-left">{$result.200_day_avg} ({$result.percent_change_from_200_day_avg}% difference)</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>365 day moving average: </strong></div>
						<div class="col-lg-10 text-left">{$result.365_day_avg} ({$result.percent_change_from_365_day_avg}% difference)</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left"><strong>730 day moving average: </strong></div>
						<div class="col-lg-10 text-left">{$result.730_day_avg} ({$result.percent_change_from_730_day_avg}% difference)</div>
					</div>
					
					{if $smarty.post.criteria == 'stats.percent_change_from_fifty_day_moving_average'}
						
						<div class="row">
							<div class="col-lg-2 text-left"><strong>Change from 50 day moving average: </strong></div>
							<div class="col-lg-10 text-left"><span class="{$smarty.post.order_direction}">{round($result.percent_change_from_fifty_day_moving_average,1)}%</span>
							</div>
						</div>
					
					{/if}
						
					{if $smarty.post.criteria == 'stats.percent_change_from_year_low'}
					
						<div class="row">
							<div class="col-lg-2 text-left"><strong>Change from year low: </strong></div>
							<div class="col-lg-10 text-left"><span class="{$smarty.post.order_direction}">{round($result.percent_change_from_year_low,1)}%</span></div>
						</div>
						
					{else if $smarty.post.criteria == 'stats.percent_change_from_year_high'}
					
						<div class="row">
							<div class="col-lg-2 text-left"><strong>Change from year high: </strong></div>
							<div class="col-lg-10 text-left"><span class="{$smarty.post.order_direction}">{round($result.percent_change_from_year_high,1)}%</span></div>
						</div>
					{/if}
					
					
					<div class="row">
						<div class="col-lg-0 text-left"><strong></strong></div>
						<div class="col-lg-12 text-left">
							
							<a href="https://www.alphavantage.co/query?function=RSI&interval=daily&time_period=10&series_type=open&datatype=csv&apikey=CAQP338X5AJYKX35&outputsize=compact&symbol={$result.symbol}.ax#">
							Alpha Vantage CSV</a> | 
							
							<a href="http://www.asx.com.au/prices/charting/?code={$result.symbol}&compareCode=&chartType=&priceMovingAverage1=&priceMovingAverage2=&volumeIndicator=&volumeMovingAverage=&timeframe=">
							ASX Graph</a> | 
							
							<a href="https://www.cmcmarketsstockbroking.com.au/net/UI/Chart/AdvancedChart.aspx?asxcode={$result.symbol}#">
							CMC Advanced Chart</a> | 
							<a href="https://www.cmcmarketsstockbroking.com.au/Market/Summary.aspx?asxcode={$result.symbol}#">CMC Info</a>
						
						</div>
					</div>
					<div class="row">
						<div class="col-lg-2 text-left">&nbsp;</div>
						<div class="col-lg-10 text-left">&nbsp;</div>
					</div>
					
					<!-- draw a chart for symbol -->
					<!--
					<div class="row">
						<div class="col-lg-12"><h3>Chart</h3></div>
					</div>
					-->
					<div class="row">
						<div class="col-lg-12">
						<!--
						 <iframe src="/charts/draw_chart.php?s={$result.symbol}&w=450&h=450&rand={rand()}" style="margin: 0; padding: 0; width: 500px; height: 500px;"></iframe> 
						 -->
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
	<br />
	<br />
	<br />
	<br />
	This page executed in {$execution_time} seconds.
	</div>
</section>