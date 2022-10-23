<?php $this->load->view('include/header'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"  ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
<?php setlocale(LC_MONETARY,"en_US"); ?>
<?php
	function custom_number_format($n, $precision = 2) {
        if ($n < 100000) {
        // Default
         $n_format = number_format($n);
        } else if ($n < 9000000) {
        // Thousand
        $n_format = number_format($n / 1000, $precision). 'K';
        } else if ($n < 900000000) {
        // Million
        $n_format = number_format($n / 1000000, $precision). 'M';
        } else if ($n < 900000000000) {
        // Billion
        $n_format = number_format($n / 1000000000, $precision). 'B';
        } else {
        // Trillion
        $n_format = number_format($n / 1000000000000, $precision). 'T';
    }
			return $n_format;
		}
	function custom_prc_format($n) {
        if ($n >= 1) {
        $n_format = number_format($n, 2);
        } else if ($n >= 0.1 && $n < 1) {
        $n_format = number_format($n, 3);
        } else if ($n >= 0.01 && $n < 0.1) {
        $n_format = number_format($n, 4);
        } else if ($n >= 0.001 && $n < 0.01) {
        $n_format = number_format($n, 6);
        } else if ($n >= 0.0001 && $n < 0.001) {
        $n_format = number_format($n, 8);
        }
        else {
        $n_format = number_format($n, 10);
    }
			return $n_format;
		}
?>
                <div class="page-title py-3">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-left">
                                <h1><?php echo $coinData->name;?> Live Price Update & Market Capitalization</h1>
                           </div>
                        </div>        
                    </div>    
                </div>
		<!-- Ad Code Top  -->
		<div class="py-4">
		<?php if($ads[0]['pref']==0 || $ads[0]['pref']==2) { ?>
               <div class="container">
               		<div class="row justify-content-center">
						<?php echo  $ads[0]['header_ads']?>
                    </div>    
				</div>
		<?php } ?>
		</div>
        <!-- End Ad Code Top  -->
        <!-- Coin Data  -->
        <div class="container">
			<div class="media">
			  <img class="mr-3" src="<?php echo $coinData->image->large;?>">
			    <div class="align-self-center media-body">
				  <h2 class="font-weight-bold" style="margin-bottom:5px;"><?php echo $coinData->name;?> <span class="badge badge-secondary align-middle" style="margin-top:-0.3em;" id="bitcode"><?php echo strtoupper($coinData->symbol);?></span> <span class="badge badge-success align-middle" style="margin-top:-0.3em;">Rank <?php if(isset($coinData->market_cap_rank)) echo '#'.$coinData->market_cap_rank; else echo 'N/A';?></span></h2>
 				  <h1 style="margin-bottom:0;"><span id="coin_price"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinData->market_data->current_price->usd/$convertRate); ?></span> <small><span class="p-<?php echo $coinData->market_data->price_change_percentage_24h > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_24h > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_24h,2))?>%</span></small></h1>
				</div>
			</div>
	<div class="container"><div class="row pt-4">

<?php if (current($coinData->links->homepage) != "") { ?>		
<a href="<?php echo current($coinData->links->homepage); ?>" target="_blank"><span class="badge linking"><i class="fa fa-globe"></i> Official Website <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if (current($coinData->links->blockchain_site) != "") { ?>
<a href="<?php echo current($coinData->links->blockchain_site); ?>" target="_blank"><span class="badge linking"><i class="fa fa-search"></i> Block Explorer <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if (current($coinData->links->repos_url->github) != "") { ?>
<a href="<?php echo current($coinData->links->repos_url->github); ?>" target="_blank"><span class="badge linking"><i class="fa fa-github"></i> <?php echo strtoupper($coinData->symbol);?> Github <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if (current($coinData->links->official_forum_url) != "") { ?>
<a href="<?php echo current($coinData->links->official_forum_url); ?>" target="_blank"><span class="badge linking"><i class="fa fa-comments"></i> <?php echo strtoupper($coinData->symbol);?> Forum <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if ($coinData->links->subreddit_url != "") { ?>
<a href="<?php echo $coinData->links->subreddit_url; ?>" target="_blank"><span class="badge linking"><i class="fa fa-reddit"></i> <?php echo strtoupper($coinData->symbol);?> Reddit <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if ($coinData->links->telegram_channel_identifier != "") { ?>
<a href="https://t.me/<?php echo $coinData->links->telegram_channel_identifier; ?>" target="_blank"><span class="badge linking"><i class="fa fa-telegram"></i> <?php echo strtoupper($coinData->symbol);?> Telegram <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if ($coinData->links->facebook_username != "") { ?>
<a href="https://facebook.com/<?php echo $coinData->links->facebook_username; ?>" target="_blank"><span class="badge linking"><i class="fa fa-facebook-official"></i> <?php echo strtoupper($coinData->symbol);?> Facebook <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if ($coinData->links->twitter_screen_name != "") { ?>
<a href="https://twitter.com/<?php echo $coinData->links->twitter_screen_name; ?>" target="_blank"><span class="badge linking"><i class="fa fa-twitter"></i> <?php echo strtoupper($coinData->symbol);?> Twitter <i class="fa fa-external-link"></i></span></a>
<?php } ?>
</div></div>
			
				<div class="pt-3 pb-2">
					<h4><i class="fa fa-eye"></i> Market Overview</h4>
					<p><span class="font-weight-bold"><?php echo $coinData->name;?></span> current market price is <span class="font-weight-bold" id="price_coin"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinData->market_data->current_price->usd/$convertRate);?></span> with a 24 hour trading volume of <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinData->market_data->total_volume->usd/$convertRate);?></span>. The total available supply of <span class="font-weight-bold"><?php echo $coinData->name;?></span> is <span class="font-weight-bold"><?php echo custom_number_format($coinData->market_data->circulating_supply); ?> <?php echo strtoupper($coinData->symbol);?></span><?php if(isset($coinData->market_data->max_supply)) echo " with a maximum supply of "."<b>".custom_number_format($coinData->market_data->max_supply)." ".strtoupper($coinData->symbol)."</b>"; else echo '';?>. It has secured <span class="font-weight-bold">Rank <?php if(isset($coinData->market_cap_rank)) echo $coinData->market_cap_rank; else echo '(Not Available)';?></span> in the cryptocurrency market with a marketcap of <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinData->market_data->market_cap->usd/$convertRate);?></span>. The <span class="font-weight-bold"><?php echo strtoupper($coinData->symbol);?></span> price is <i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_24h > 0 ? 'up':'down'?>"></i><span class="font-weight-bold"><?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_24h,2));?>%</span> <?php if($coinData->market_data->price_change_percentage_24h > 0) echo 'up'; else echo 'down';?> in the last 24 hours.</p>
					<hr>
					<p>The lowest price of the <span class="font-weight-bold"><?php echo $coinData->name;?></span> is <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinData->market_data->low_24h->usd/$convertRate); ?></span> & the highest price is <span class="font-weight-bold"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinData->market_data->high_24h->usd/$convertRate); ?></span> in the last 24 hours. Live <span class="font-weight-bold"><?php echo $coinData->name;?></span> prices from all markets and <span class="font-weight-bold"><?php echo strtoupper($coinData->symbol);?></span> coin market Capitalization. Stay up to date with the latest <span class="font-weight-bold"><?php echo $coinData->name;?></span> price movements. Check our coin stats data and see when there is an opportunity to buy or sell <span class="font-weight-bold"><?php echo $coinData->name;?></span> at best price in the market.</p>
				</div>
		<div class="row">
			<div class="col-sm">
				<a target = '_blank' href="<?php echo $settingData[0]['buy_sell'] ?>" class="btn btn-dark btn-block mb-1"><i class="fa fa-cart-plus"></i> Buy <?php echo $coinData->name;?> (<?php echo strtoupper($coinData->symbol);?>)</a>
			</div>
			<div class="col-sm">
			<a target = '_blank' href="<?php echo $settingData[0]['buy_sell'] ?>" class="btn btn-warning btn-block"><i class="fa fa-cart-arrow-down"></i> Sell <?php echo $coinData->name;?> (<?php echo strtoupper($coinData->symbol);?>)</a>
			</div>
		</div>
		<div class="pt-4">
			<div class="card-deck">
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title"><?php echo $coinData->name;?> Price</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinData->market_data->current_price->usd/$convertRate);?></p>
    			</div>
			</div>
      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Price Change (24h)</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo round($coinData->market_data->price_change_24h/$convertRate,2);?> <span class="p-<?php echo $coinData->market_data->price_change_percentage_24h > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_24h > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_24h,2));?>%</span></p>
    			</div>
			</div>
      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">24h Low / 24h High</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinData->market_data->low_24h->usd/$convertRate); ?> / <?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($coinData->market_data->high_24h->usd/$convertRate); ?> </p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Market Cap</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinData->market_data->market_cap->usd/$convertRate);?> <span class="p-<?php echo $coinData->market_data->market_cap_change_percentage_24h > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->market_cap_change_percentage_24h > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->market_cap_change_percentage_24h,2));?>%</span></p>
    			</div>
			</div>
			</div>
		</div>
<div class="card-space"></div>
		<div class="pb-3">
			<div class="card-deck">
			    				<div class="card bg-light">
					<div class="card-body">
						<h6 class="card-title">Fully Diluted Market Cap</h6>
						<p class="card-text"><?php if(isset($coinData->market_data->fully_diluted_valuation->usd)) echo strtok($convertSymbol, " ").custom_number_format($coinData->market_data->fully_diluted_valuation->usd/$convertRate); else echo '(Not Available)'?></p>
					</div>
				</div>

      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Trading Volume (24H)</h6>
      				<p class="card-text"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($coinData->market_data->total_volume->usd/$convertRate);?></p>
    			</div>
			</div>
      		<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Circulating Supply</h6>
      				<p class="card-text"><?php echo custom_number_format($coinData->market_data->circulating_supply); ?> <?php echo strtoupper($coinData->symbol); ?></p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h6 class="card-title">Max Supply</h6>
      				<p class="card-text"><?php if(isset($coinData->market_data->max_supply)) echo custom_number_format($coinData->market_data->max_supply)." ".strtoupper($coinData->symbol); else echo '(Not Available)';?></p>
    			</div>
			</div>
			</div>
		</div>
		
		<!-- Calculator  -->
		 <h4 class="pt-3 pb-2"><i class="fa fa-calculator"></i> Cryptocurrency <?php echo $coinData->name;?> Calculator</h4>
		 <div class="container bg-donation pt-4 pb-3 px-4">
   
 <div class="row">
<div class="col-md-6 mb-3">
 <input type="number" class="form-control" id="from_ammount" placeholder="Enter Amount To Convert" value=10 />
 </div>
 <div class="col-md-6 mb-3">
     <input type="text" class="form-control" id="from_cryptoc" value="<?php echo $coinData->name;?> (<?php echo strtoupper($coinData->symbol);?>)" disabled/>
     <input type="hidden" class="form-control" id="from_currency" value="<?php echo $coinData->market_data->current_price->usd;?>" />
</div></div>
<div class="row">
<div class="col-md-6">
 <select class="form-control js-example-basic-single" id="to_currency" onchange=calculate();>
<?php foreach ($rateData->data as $res) {
$res->currencySymbol = str_replace("CHF","",$res->currencySymbol);
?>
<option value="<?php echo $res->rateUsd; ?>" <?php if ($res->currencySymbol.' '.$res->symbol == $convertSymbol) echo "Selected"; ?>><?php echo ucwords(str_replace('-',' ',$res->id)); ?> "<?php if($res->currencySymbol==="") echo 'NA'; else echo $res->currencySymbol;?>" (<?php echo $res->symbol; ?>)</option>
 <?php } ?>
 </select>
 </div>
 </div>
<h5 class="pt-4 text-center"><div class="col-md-12"><div id="to_ammount"></div></div></h5>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<script>
const from_currencyEl = document.getElementById('from_currency');
const from_cryptocEl = document.getElementById('from_cryptoc');
const from_ammountEl = document.getElementById('from_ammount');
const to_currencyEl = document.getElementById('to_currency');
const to_ammountEl = document.getElementById('to_ammount');

from_ammountEl.addEventListener('input', calculate);
to_ammountEl.addEventListener('input', calculate);

function calculate() {
 to_ammountEl.innerText = (from_ammountEl.value) + ' ' + (from_cryptocEl.value) + ' ' + '=' + ' ' + Number((from_ammountEl.value * from_currencyEl.value / to_currencyEl.value).toFixed(2)).toLocaleString() + ' ' + $('#to_currency option:selected').text();
}
calculate();
</script>
        </div>
        <div class="cta-box py-4 mb-3">
<p class="lead text-center mb-2">Want to convert more cryptocurrencies?</p>
   <div class="text-center mb-2"> <a href="<?php echo base_url(); ?>calculator" class="btn btn-outline-dark btn-sm"><i class="fa fa-calculator"></i> Use Crypto Calculator</a> </div>
   </div>
        
		<!-- Price Chart  -->
			<h4 class="pt-3 pb-2"><i class="fa fa-area-chart"></i> <?php echo $coinData->name;?> Historical Data Price Chart</h4>
  			<div class="coin-chart" data-coin-period="365day" data-coin-id="<?php echo $coinData->id; ?>" data-chart-color="
			<?php if($settingData[0]['site_layout']==1) echo '#FFBA00';else if($settingData[0]['site_layout']==2)   echo '#65bc7b';else if($settingData[0]['site_layout']==3)   echo '#cc0000';else if($settingData[0]['site_layout']==4)   echo '#4d39e9';else if($settingData[0]['site_layout']==5)   echo '#4fb2aa';else if($settingData[0]['site_layout']==6)   echo '#17a2b8';else if($settingData[0]['site_layout']==7)   echo '#007bff';else if($settingData[0]['site_layout']==8)   echo '#28a745';else if($settingData[0]['site_layout']==9)   echo '#dc3545';else  echo '#343a40'; ?>">
				<div class="cmc-wrp"  id="COIN-CHART-<?php echo $coinData->id; ?>" style="width:100%; height:100%;" >
				</div>
			</div>
        <!-- End Price Chart  -->
        
        	<div class="pt-3 pb-2">
			<div class="card-deck">
      		<div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">24h</h5>
      				<p class="card-text"><span class="p-<?php echo $coinData->market_data->price_change_percentage_24h > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_24h > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_24h,2));?>%</span></p>
    			</div>
			</div>
      		<div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">7d</h5>
      				<p class="card-text"><span class="p-<?php echo $coinData->market_data->price_change_percentage_7d > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_7d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_7d,2));?>%</span></p>
    			</div>
			</div>
      		<div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">14d</h5>
      				<p class="card-text"><span class="p-<?php echo $coinData->market_data->price_change_percentage_14d > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_14d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_14d,2));?>%</span></p>
    			</div>
			</div>
			 <div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">30d</h5>
      				<p class="card-text"><span class="p-<?php echo $coinData->market_data->price_change_percentage_30d > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_30d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_30d,2));?>%</span></p>
    			</div>
			</div>
			 <div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">60d</h5>
      				<p class="card-text"><span class="p-<?php echo $coinData->market_data->price_change_percentage_60d > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_60d > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_60d,2));?>%</span></p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">1y</h5>
      				<p class="card-text"><span class="p-<?php echo $coinData->market_data->price_change_percentage_1y > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $coinData->market_data->price_change_percentage_1y > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($coinData->market_data->price_change_percentage_1y,2));?>%</span></p>
    			</div>
			</div>

			</div>
		</div>
        		<!-- Ad Code Bottom  -->
		<div class="py-4">
		<?php if($ads[0]['pref']==1 || $ads[0]['pref']==2) { ?>
            <div class="container">
               	<div class="row justify-content-center">
					<?php echo  $ads[0]['footer_ads']?>
                </div>    
			</div>
		<?php } ?>
		</div>
		</div>
        <!-- End Ad Code Bottom  -->
        
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-left">
        <div class="pb-4">
            <h4 class="pt-3"><i class="fa fa-exchange"></i> <?php echo $coinData->name;?> Markets Exchange Data</h4>
            <p class="lead pb-3">Compare live prices of <?php echo $coinData->name;?> on top exchanges.</p>
        	<table id="coins-info-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
                <th>#</th>
                <th>Exchange</th>
                <th>Pair</th>
                <th>Price</th>
                <th>Volume (24h)</th>
                <th>Trust Score</th>
            </tr>
			</thead>
			<tbody>
			    <?php
             setlocale(LC_MONETARY,"en_US");
             foreach ($coinData->tickers as $res)
				{
					 ?>
				<tr>
					<td></td>
					<td><img src="<?php echo $res->market->logo;?>" /><a href="<?php echo base_url() ?>exchange/<?php echo $res->market->identifier; ?>"><span class="coin-name"><?php echo $res->market->name;?></span></a></td>
					<td><?php echo (strlen($res->base) > 10) ? substr($res->base,0,7).'...' : $res->base; ?>/<?php echo (strlen($res->target) > 10) ? substr($res->target,0,7).'...' : $res->target; ?></td>
					<td data-sort="<?php echo $res->converted_last->usd;?>"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($res->converted_last->usd/$convertRate); ?></td>
					<td data-sort="<?php echo $res->converted_volume->usd;?>"><?php echo strtok($convertSymbol, " ");?><?php echo number_format($res->converted_volume->usd/$convertRate); ?></td>
					<td data-sort="<?php echo $res->trust_score;?>"><?php if(isset($res->trust_score)) echo str_replace(array('green', 'yellow', 'red'), array('<i style="color:green;" class="fa fa-circle"></i>', '<i style="color:#ffc107;" class="fa fa-circle"></i>', '<i style="color:red;" class="fa fa-circle"></i>'), $res->trust_score); else echo "N/A"; ?></td>
				</tr>
			<?php
		}
				?>
			    
			</tbody>
		   </table>
        </div>
        </div></div></div>
		<!-- End Coin Data  -->
		<div class="container">
		<div class="row justify-content-center">
        <div class="col-md-12 text-left">
        <div class="pb-5">
		<h2>About <?php echo $coinData->name;?> (<?php echo strtoupper ($coinData->symbol);?>) Cryptocurrency</h2>
        <p><?php echo strip_tags($coinData->description->en); ?></p>




<?php
             setlocale(LC_MONETARY,"en_US");
             
             foreach ($coinData->categories as $res)
             
				{
					 ?>
  <span class="badge linking"> <?php echo $res;?> </span>

	<?php
		}
				?>


</div></div></div></div>

<!-- News Section Start  -->
<div class="container pb-5">
<h2 class="pb-2">Cryptocurrency Latest News & Updates</h2>
<div class="card-deck">
   <?php
   $i=1;
             setlocale(LC_MONETARY,"en_US");
             foreach ($newsData->channel->item as $res)
				{
				    if($i>3)
				    continue;
					 ?>
<div style="padding-left:0px;padding-right:0px;" class="col-md-12">
<div style="margin-bottom:20px;" class="card">
<div class="row no-gutters">
<div class="col-md-3">
<img src="<?php echo $res->enclosure->{"@attributes"}->url;?>" width="100%;"></div>
<div class="col-md-9">
<div class="card-body">
<h6 class="card-title"><?php echo $res->title;?></h6>
<p><?php echo strip_tags(substr($res->description, 0, 500));?>...</p>
<a href="<?php echo $res->link;?>" class="btn btn-warning" target="_blank">Read More</a>
</div></div></div></div></div>
	<?php
	++$i;
		}
				?>
</div>  
<a href="<?php echo base_url(); ?>news" class="btn btn-warning btn-block" target="_blank">Read More</a>
</div>   
<!-- News Section End  -->
        
        <!-- Donation Box  -->
        <?php $this->load->view('include/donation'); ?>
        <!-- End Donation Box  -->

<!-- Chart Script  -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/amstock.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
<script>
(function($) {
    'use strict';
    /* Single Page chart js */
      $('.coin-chart').each(function(index)
        {
            var coinId=$(this).data("coin-id");
            var chart_color=$(this).data("chart-color");
            var coinperiod=$(this).data("coin-period");
            var priceData = [];
            var volData = [];
            var price_section =$('#coin_price').val();
            //$(this).find('.CCP').number(true); 
             $.ajax({
                    url: 'https://api.coingecko.com/api/v3/coins/'+coinId+'/market_chart?vs_currency=usd&days=365',
                    method: 'GET',
                    beforeSend: function() {
                        $(this).closest('.cmc-preloader').show();
                    },
                    success: function(history) {
						
						//var hdata=JSON.parse(history.data);
					  
                     $.each(history.prices, function(i, value) {
                          
                            priceData.push( {
                              "date":new Date(value[0]),
                              "value":value[1]/<?php echo $convertRate;?>,
                              //"volume":history.volume[i][1]
                            } ); 
                        });
                    
                    
                        setTimeout(function() {
							generateChartData(coinId,priceData,chart_color);
                            $(this).closest('.cmc-preloader').hide();
                        }, 500);
                    }
                });
        });
var generateChartData = function(coinId,coinData,color) {
var chart = AmCharts.makeChart('COIN-CHART-'+coinId, {
      "type": "stock",
      "theme": "light",
      "hideCredits":true,
      "categoryAxesSettings": {
        "minPeriod": "mm"
      },
      "dataSets": [ {
        "title":"<?php echo substr($convertSymbol, strrpos($convertSymbol, ' ') + 1);?>",
        "color":color,
        "fieldMappings": [ {
          "fromField": "value",
          "toField": "value"
        }, {
          "fromField": "volume",
          "toField": "volume"
        } ],
        "dataProvider":coinData,
        "categoryField": "date"
      } ],
      "panels": [ {
        "showCategoryAxis": false,
        "title": "Price",
        "percentHeight": 70,
        "stockGraphs": [ {
          "id": "g1",
          "valueField": "value",
          "type": "smoothedLine",
          "lineThickness": 2,
          "bullet": "round",
           "comparable": true,
          "compareField": "value",
          "balloonText": "[[title]]:<b>[[value]]</b>",
          "compareGraphBalloonText": "[[title]]:<b>[[value]]</b>"
        } ],
        "stockLegend": {
          "periodValueTextComparing": "[[percents.value.close]]%",
          "periodValueTextRegular": "[[value.close]]"
        },
         "allLabels": [ {
          "x": 200,
          "y": 115,
          "text": "",
          "align": "center",
          "size": 16
        } ],
      "drawingIconsEnabled": true
      }, {
        "title": "Price",
        "percentHeight": 30,
        "stockGraphs": [ {
          "valueField": "volume",
          "type": "column",
           "showBalloon": false,
          "cornerRadiusTop": 2,
          "fillAlphas": 1
        } ],
        "stockLegend": {
          "periodValueTextRegular": "[[value.close]]"
        },
      } ],
      "chartScrollbarSettings": {
        "graph": "g1",
        "usePeriod": "10mm",
        "position": "bottom"
      },
      "chartCursorSettings": {
        "valueBalloonsEnabled": true,
        "fullWidth": true,
        "cursorAlpha": 0.1,
        "valueLineBalloonEnabled": true,
        "valueLineEnabled": true,
        "valueLineAlpha": 0.5
      },
     "periodSelector": {
        "position": "top",
        "periods": [
        {
          "period": "hh",
          "count": 24,
          "label": "24H"
        },
        {
          "period": "DD",
          "selected": true,
          "count":7,
          "label": "7D"
        },
         {
          "period": "MM",
         "count": 1,
          "label": "1M"
        }, 
      {
          "period": "MM",
          "count": 3,
          "label": "3M"
        },
          {
          "period": "MM",
          "count":6,
          "label": "6M"
        },
          {
          "period": "MAX",
          "label": "1Y"
        } ]
      },
      "export": {
        "enabled": true,
        "position": "top-right"
      }
    } );
    }
})($);
</script>

<script type="text/javascript">
		$(document).ready(function() {
		$.noConflict();
		var t = $('#coins-info-table').DataTable( {
		    "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        }, 
        ],
          "order": [[ 4, "desc" ]],
          "pageLength": 25,
          "bInfo" : false,
          "bProcessing": true,
		 "bDeferRender": true,
		} );
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
		} );
	</script>
<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>