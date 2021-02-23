<section class="generic">
	<div class="container">

		<form method="POST" action="get_quote.php">
			<div class="form-inline form-light">
				
						<div class="form-group">
							<div class="col-lg-12">
								{if !$result}<h3>Company Quote</h3>{/if}
								<strong>ASX symbol</strong> (or security_id): <input type="text" name="symbol" maxlength="6" class="form-control" style="width: 100px"> <input type="submit" value="Search" class="btn btn-primary">
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-4 text-left">&nbsp;</div>
							<div class="col-lg-8 text-left">&nbsp;</div>
						</div>
							
				{if $smarty.post OR $smarty.get.symbol OR $price_history_results}
				
					{if $result OR $price_history_results}
							<div class="row">
								<div class="col-lg-12">
									<h3>{$result.symbol} - {$result.name}</h3>
								</div>
							</div>

							
							<div class="row">
								<div class="col-lg-12">
									
									<!-- PRICE BAR -->	
									<table class="quote" style="font-size: 10px;" cellspacing="0">
										<tbody>
											<tr>
												<td class="first">{$result.close}</td>
												
											{if $result.direction == 'up'}	
												<td>
													<span class="nospacer market-up">
														<span class="fa fa-quote fa-arrow-up green"></span>
														+{$result.change}
													</span>
												</td>
											{else if $result.direction == 'down'}	
												<td>
													<span class="market-down nospacer">
														<span class="fa fa-quote fa-arrow-down red nospacer"></span>
														<span class="red">{$result.change}</span>
													</span>
												</td>
											{else}
												<!-- no change -->
												<td>
													<span class="nospacer">
														<span class="fa fa-quote black nospacer"></span>
														{$result.change} 
													</span>
												</td>
											{/if}

											{if $result.direction == 'up'}	
												<td class="nospacer">
													<span class="nospacer market-up">
														+{$result.change_percent} %
													</span>
												</td>
											
											{else if $result.direction == 'down'}
												<td class="nospacer">
													<span class="nospacer market-down nospacer">
														<span class="red">{$result.change_percent} %</span>
													</span>
												</td>
											{else}
												<td class="nospacer">
													<span class="nospacer black">
														{$result.change_percent} %
													</span>
												</td>
											{/if}
												
												<td>{$result.open}</td>
												<td class="nospacer">{$result.high}</td>
												<td class="nospacer">{$result.low}</td>
												<td class="nospacer">{$prev_result.close}</td>
												<td>{$result.volume}</td>
												<td class="nospacer">${$result.average_value}</td>
												<td class="nospacer">{$result.date}</td>
											</tr> 
											<tr>
												<th class="first">Last</th>
												<th>Change</th>
												<th class="nospacer">% Change</th>
												<th>Open</th>
												<th class="nospacer">High</th>
												<th class="nospacer">Low</th>
												<th class="nospacer">Last Close</th>
												<th>Volume</th>
												<th class="nospacer">Approx. Daily Value</th>
												<th class="nospacer">Last Updated</th>
											</tr>
										</tbody>
									</table>
											
									<!-- TABS -->
									<div class="tab">
									  <input type="button" class="tablinks{if $tab=='summary'} tab_selected{/if}" onclick="document.location.href='get_quote.php?symbol={$result.symbol}'" value="Summary">
									  <input type="button" class="tablinks{if $tab=='price_history'} tab_selected{/if}" onclick="document.location.href = 'get_quote.php?tab=price_history&security_id={$result.security_id}&symbol={$result.symbol}'" value="Price History">
									</div>
								</div>
							</div>
							
							
						{if $price_history_results}
							<br />
							<table class="price_history">
								 <tr>
									<!--<th>id</th>-->
									<th>Date</th>
									<th>Open</th>
									<th>High</th>
									<th>Low</th>
									<th>Close</th>
									<th>Volume</th>
									<th>Last Updated</th>
								</tr>
							{foreach from=$price_history_results key=i item=row}
								<tr>
									<!--<td>{$row.id}</td>-->
									<td>{$row.date_formatted}</td>
									<td>{$row.open}</td>
									<td>{$row.high}</td>
									<td>{$row.low}</td>
									<td>{$row.close}</td>
									<td>{$row.volume}</td>
									<td>{$row.modified}</td>
								</tr>
							{/foreach}
							</table>
						
						{else}
							<div class="row">
								<div class="col-lg-2 text-left">&nbsp;</div>
								<div class="col-lg-10 text-left"><a href="https://www.cmcmarketsstockbroking.com.au/Market/Summary.aspx?asxcode={$result.symbol}#">CMC Info</a></div>
							</div>
							
							<div class="row">
								<div class="col-lg-2 text-left bold">Security ID</div>
								<div class="col-lg-10 text-left">{$result.security_id}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">Category</div>
								<div class="col-lg-10 text-left">{$result.category}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">Industry</div>
								<div class="col-lg-10 text-left">{$result.industry}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">Market Cap</div>
								<div class="col-lg-10 text-left">${$result.market_cap}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left"><strong>ASX largest rank: </strong></div>
								<div class="col-lg-10 text-left">{$result.top_300_rank} / {$num_securities_total}</div>
							</div>
							<div class="row">
								<div class="col-lg-4 text-left">&nbsp;</div>
								<div class="col-lg-8 text-left">&nbsp;</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12">
									<h3>Statistics</h3>
								</div>
							</div>
							
							<!-- stats -->
							<div class="row">
								<div class="col-lg-2 text-left bold">RSI:</div>
								<div class="col-lg-10 text-left">{$result.rsi}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">RSI Last Updated:</div>
								<div class="col-lg-10 text-left">{$result.rsi_date}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">&nbsp;</div>
								<div class="col-lg-10 text-left">&nbsp;</div>
							</div>
							
							<div class="row">
								<div class="col-lg-2 text-left bold">MACD:</div>
								<div class="col-lg-10 text-left">{$result.macd}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">MACD Signal:</div>
								<div class="col-lg-10 text-left">{$result.macd_signal}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">MACD Histogram:</div>
								<div class="col-lg-10 text-left"><span class="{if $result.macd_hist >= 0}green{else}red{/if}">{$result.macd_hist}</span></div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">MACD Last Updated:</div>
								<div class="col-lg-10 text-left">{$result.macd_date}</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">&nbsp;</div>
								<div class="col-lg-10 text-left">&nbsp;</div>
							</div>
							
							<div class="row">
								<div class="col-lg-2 text-left bold">Year Low:</div>
								<div class="col-lg-10 text-left">{$result.year_low} ({$result.percent_change_from_year_low}% difference)</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">Year High:</div>
								<div class="col-lg-10 text-left">{$result.year_high} ({$result.percent_change_from_year_high}% difference)</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">Year Range:</div>
								<div class="col-lg-10 text-left">x</div>
							</div>
							
							<div class="row">
								<div class="col-lg-4 text-left">&nbsp;</div>
								<div class="col-lg-8 text-left">&nbsp;</div>
							</div>
							
							<div class="row">
								<div class="col-lg-2 text-left bold">50 day moving average:</div>
								<div class="col-lg-10 text-left">x (x% difference)</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">100 day moving average:</div>
								<div class="col-lg-10 text-left">x (x% difference)</div>
							</div>
							<div class="row">
								<div class="col-lg-2 text-left bold">200 day moving average:</div>
								<div class="col-lg-10 text-left">x  (x% difference)</div>
							</div>
							
							<!-- draw a chart for symbol -->
							<div class="row">
								<div class="col-lg-12"><h3>Chart</h3></div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<!--<img src="/charts/draw_chart.php?s={$symbol}&w=900&h=600&rand={rand()}" class="img-responsive" width="900" height="600" />--> 
									<iframe style="width: 90%; height: 900px; border: 2px solid black;" src="https://www.asx.com.au/prices/charting/?code={$result.symbol}&compareCode=&chartType=line&priceMovingAverage1=&priceMovingAverage2=&volumeIndicator=Bar&volumeMovingAverage=&timeframe=Daily" style="overflow:hidden;"></iframe>
									<br />
									<a href="https://www.asx.com.au/prices/charting/?code={$result.symbol}&compareCode=&chartType=line&priceMovingAverage1=&priceMovingAverage2=&volumeIndicator=Bar&volumeMovingAverage=&timeframe=Daily" target="_blank">ASX Graph</a> | 
									<a href="https://www.cmcmarketsstockbroking.com.au/net/UI/Chart/AdvancedChart.aspx?asxcode={$result.symbol}#">CMC Advanced Chart</a>
									 | 
									<a href="https://www.cmcmarketsstockbroking.com.au/Market/Summary.aspx?asxcode={$result.symbol}#">CMC Info</a>
								</div>
							</div>
						{/if}
					{else}
						<div class="row">
								<div class="col-lg-12"><span class="red">Error - Could not find that ASX stock symbol.</span></div>
						</div>
					{/if}
				{/if}
			</div>	
		</form>	

	</div>
</section>