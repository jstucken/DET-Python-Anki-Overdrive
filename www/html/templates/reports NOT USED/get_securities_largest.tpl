
<form method="POST" action="">

    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<h1>Listing all ASX companies ranked by Market Cap</h1>
				</div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <!--<a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>-->
                </div>
            </div>
			
			
		{foreach from=$results key=field item=row}
			
				<div class="row">
					<h3>{$row.id}. <a href="get_quote.php?symbol={$row.symbol}">{$row.symbol}</a> - {$row.name}</h3>
					<div class="col-lg-2 text-left"><strong>security_id: </strong></div>
					<div class="col-lg-10 text-left">{$row.security_id}</div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-left"><strong>Category: </strong></div>
					<div class="col-lg-10 text-left">{$row.category}</div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-left"><strong>Industry: </strong></div>
					<div class="col-lg-10 text-left">{$row.industry}</div>
				</div>
				<div class="row">
					<div class="col-lg-2 text-left"><strong>Market Cap: </strong></div>
					<div class="col-lg-10 text-left">{$row.market_cap}</div>
				</div>
				
				<div class="row">
					<div class="col-lg-1 text-left">&nbsp;</div>
					<div class="col-lg-11 text-left">&nbsp;</div>
				</div>
				
				<div class="row">
					<div class="col-lg-0 text-left"><strong></strong></div>
					<div class="col-lg-12 text-left">
						
						<a href="https://www.alphavantage.co/query?function=RSI&interval=daily&time_period=10&series_type=open&datatype=csv&apikey=CAQP338X5AJYKX35&outputsize=compact&symbol={$row.symbol}.ax#">
						Alpha Vantage CSV</a> | 
						
						<a href="http://www.asx.com.au/prices/charting/?code={$row.symbol}&compareCode=&chartType=&priceMovingAverage1=&priceMovingAverage2=&volumeIndicator=&volumeMovingAverage=&timeframe=">
						ASX Graph</a> | 
						
						<a href="https://www.cmcmarketsstockbroking.com.au/net/UI/Chart/AdvancedChart.aspx?asxcode={$row.symbol}#">
						CMC Advanced Chart</a> | 
						<a href="https://www.cmcmarketsstockbroking.com.au/Market/Summary.aspx?asxcode={$row.symbol}#">CMC Info</a>
					
					</div>
				</div>
				
			
				<hr>
		{/foreach}

			
        </div>
    </section>
	
</form>	