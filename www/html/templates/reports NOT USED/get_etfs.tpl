
<form method="POST" action="">

    <!-- About Section -->
    <section class="generic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<h3>ETF's and REIT's</h3>
				</div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <!--<a href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-download"></i> Download Theme
                    </a>-->
                </div>
            </div>
			
			
		{foreach from=$results key=field item=row}
			
				<div class="row">
					<div class="col-lg-3 text-left"><strong>Symbol: </strong></div>
					<div class="col-lg-9 text-left">{$row.symbol}</div>
				</div>
				<div class="row">
					<div class="col-lg-3 text-left"><strong>Category: </strong></div>
					<div class="col-lg-9 text-left">{$row.category}</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<iframe style="width: 1000px; height: 800px; border: 2px solid black; padding-top: -200px" src="https://www.asx.com.au/prices/charting/?code={$row.symbol}&compareCode=&chartType=line&priceMovingAverage1=&priceMovingAverage2=&volumeIndicator=Bar&volumeMovingAverage=&timeframe=Daily"></iframe>
						<a href="https://www.asx.com.au/prices/charting/?code={$row.symbol}&compareCode=&chartType=line&priceMovingAverage1=&priceMovingAverage2=&volumeIndicator=Bar&volumeMovingAverage=&timeframe=Daily" target="_blank">ASX Graph</a>
					</div>
				</div>
			
				<hr>
		{/foreach}

			
        </div>
    </section>
	
</form>
	
	
	