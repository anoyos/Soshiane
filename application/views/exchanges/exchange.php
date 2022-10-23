<?php $this->load->view('include/header'); ?>
<?php setlocale(LC_MONETARY,"en_US"); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"  ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
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
		 function custom_vol_format($n) {
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
                                <h1><?php echo $exchangeData->name;?> Exchange & Trading Pairs Info</h1>
                                     
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
			  <img class="mr-3" src="<?php echo $exchangeData->image;?>">
			    <div class="align-self-center media-body">
				  <h2 class="font-weight-bold" style="margin-bottom:0px;"><?php echo $exchangeData->name;?> <span class="badge badge-success align-middle" style="margin-top:-0.3em;">Rank <?php if(isset($exchangeData->trust_score_rank)) echo '#'.$exchangeData->trust_score_rank; else echo 'N/A';?></span></h2>
 				  <h1 style="margin-bottom:0;"><span id="coin_price"><?php echo custom_vol_format($exchangeData->trade_volume_24h_btc);?> BTC</span> <small class="text-muted">(24H Trading Volume)</small></h1>
				</div>
			</div>


	<div class="container"><div class="row pt-4">

<?php if ($exchangeData->centralized == true) { ?>
<span class="badge linking">Centralized</span>
<?php } ?>

<?php if ($exchangeData->centralized == false) { ?>
<span class="badge linking">Decentralized</span>
<?php } ?>

<?php if ($exchangeData->reddit_url != "") { ?>
<a href="<?php echo $exchangeData->reddit_url; ?>" target="_blank"><span class="badge linking"><i class="fa fa-reddit"></i> <?php echo $exchangeData->name;?> Reddit <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if ($exchangeData->telegram_url != "") { ?>
<a href="<?php echo $exchangeData->telegram_url; ?>" target="_blank"><span class="badge linking"><i class="fa fa-telegram"></i> <?php echo $exchangeData->name;?> Telegram <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if ($exchangeData->facebook_url != "") { ?>
<a href="<?php echo $exchangeData->facebook_url; ?>" target="_blank"><span class="badge linking"><i class="fa fa-facebook-official"></i> <?php echo $exchangeData->name;?> Facebook <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if ($exchangeData->twitter_handle != "") { ?>
<a href="https://twitter.com/<?php echo $exchangeData->twitter_handle; ?>" target="_blank"><span class="badge linking"><i class="fa fa-twitter"></i> <?php echo $exchangeData->name;?> Twitter <i class="fa fa-external-link"></i></span></a>
<?php } ?>

<?php if ($exchangeData->other_url_1 != "") { ?>
<a href="<?php echo $exchangeData->other_url_1; ?>" target="_blank"><span class="badge linking"><i class="fa fa-link"></i> <?php echo $exchangeData->other_url_1;?> <i class="fa fa-external-link"></i></span></a>
<?php } ?>

</div></div>

        <div class="pt-3 pb-2">
					<h4><i class="fa fa-eye"></i> Exchange Overview</h4>
					<p><span class="font-weight-bold"><?php echo $exchangeData->name;?></span> exchange 24 hours trading volume is <span class="font-weight-bold" id="price_coin"><?php echo custom_vol_format($exchangeData->trade_volume_24h_btc);?></span> BTC. <span class="font-weight-bold"><?php echo $exchangeData->name;?></span> exchange is established in year <span class="font-weight-bold"><?php if(isset($exchangeData->year_established)) echo $exchangeData->year_established; else echo '(Not Available)';?></span> at country <span class="font-weight-bold"><?php if(isset($exchangeData->country)) echo $exchangeData->country; else echo '(Not Available)';?></span> and secured <span class="font-weight-bold">Rank <?php if(isset($exchangeData->trust_score_rank)) echo $exchangeData->trust_score_rank; else echo '(Not Available)';?></span> in the cryptocurrency exchange market.</p>
					<hr>
					<p>Live <span class="font-weight-bold"><?php echo $exchangeData->name;?></span> exchange markets data. Stay up to date with the latest crypto trading price movements on <span class="font-weight-bold"><?php echo $exchangeData->name;?></span> exchange. Check our exchange market data and see when there is an opportunity to buy or sell <span class="font-weight-bold">cryptocurrency</span> at best price in the market.</p>
				</div>
			
		<div class="row">
			<div class="col-sm">
				<a target = '_blank' href="<?php echo $exchangeData->url; ?>" class="btn btn-dark btn-block mb-1"><i class="fa fa-link"></i> Official <?php echo $exchangeData->name;?> Website</a>
			</div>
			<div class="col-sm">
			<a target = '_blank' href="<?php echo $settingData[0]['buy_sell'] ?>" class="btn btn-warning btn-block"><i class="fa fa-cart-plus"></i> Start Crypto Trading</a>
			</div>
		</div>
		
		<div class="pt-4 pb-3">
			<div class="card-deck">
				<div class="card bg-light">
					<div class="card-body">
						<h5 class="card-title">Trust Score</h5>
					<p class="card-text">	<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $exchangeData->trust_score;?>0%;" aria-valuenow="<?php echo $exchangeData->trust_score;?>" aria-valuemin="0" aria-valuemax="10"><?php if(isset($exchangeData->trust_score)) echo $exchangeData->trust_score; else echo '<span style="color:#000;">N/A</span>';?></div></div></p>
					</div>
				</div>
			<div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">Exchange Name</h5>
      				<p class="card-text"><?php echo $exchangeData->name; ?></p>
    			</div>
			</div>
			<div class="card bg-light">
    			<div class="card-body">
    			 <h5 class="card-title">Volume (24H)</h5>
      				<p class="card-text"><?php echo custom_vol_format($exchangeData->trade_volume_24h_btc);?> BTC</p>
    			</div>
			</div>
      		<div class="card bg-light">
    			<div class="card-body">
      				<h5 class="card-title">Country</h5>
      				<p class="card-text"><?php if(isset($exchangeData->country)) echo $exchangeData->country; else echo '(N/A)';?></p>
    			</div>
			</div>
			      		<div class="card bg-light">
				<div class="card-body">
      				<h5 class="card-title">Established Year</h5>
      				<p class="card-text"><?php if(isset($exchangeData->year_established)) echo $exchangeData->year_established; else echo '(N/A)';?></p>
    			</div>
			</div>

			</div>
		</div>
		<!-- Price Chart  -->
			<h4 class="pt-3 pb-2"><i class="fa fa-area-chart"></i> <?php echo $exchangeData->name;?> Historical Data Volume Chart</h4>
  			<div class="coin-chart" data-coin-period="365day" data-coin-id="<?php echo $exchange; ?>" data-chart-color="
<?php if($settingData[0]['site_layout']==1) echo '#FFBA00';else if($settingData[0]['site_layout']==2)   echo '#65bc7b';else if($settingData[0]['site_layout']==3)   echo '#cc0000';else if($settingData[0]['site_layout']==4)   echo '#4d39e9';else if($settingData[0]['site_layout']==5)   echo '#4fb2aa';else if($settingData[0]['site_layout']==6)   echo '#17a2b8';else if($settingData[0]['site_layout']==7)   echo '#007bff';else if($settingData[0]['site_layout']==8)   echo '#28a745';else if($settingData[0]['site_layout']==9)   echo '#dc3545';else  echo '#343a40'; ?>">
				<div class="cmc-wrp"  id="COIN-CHART-<?php echo $exchange; ?>" style="width:100%; height:100%;" >
				</div>
			</div>
        <!-- End Price Chart  -->
        
		<!-- Ad Code Bottom  -->
		<div class="pt-4 pb-4">
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
        		<div class="pb-5">
        		    <h4 class="py-3"><i class="fa fa-exchange"></i> <?php echo $exchangeData->name; ?> Top Trading Pairs Info</h4>
		<!-- End Coin Data  -->
		<table id="coins-info-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
                <th>#</th>
                <th>Cryptocurrency</th>
                <th>Pair</th>
                <th>Price</th>
                <th>Volume (24H)</th>
                <th>Trust Score</th>
            </tr>
			</thead>
			
						<tbody>
			    <?php
             setlocale(LC_MONETARY,"en_US");
             foreach ($exchangeData->tickers as $res)
				{
				    $ex_nam=strtolower(str_replace('-',' ',$res->coin_id));
				    $ex_id=ucwords($ex_nam);
				    $tex_nam=strtolower(str_replace('-',' ',$res->target_coin_id));
                    $tex_id=ucwords($tex_nam);
					 ?>
				<tr>
					<td></td>
					<td><a href="<?php echo base_url() ?>coin/<?php echo $res->coin_id; ?>"><span class="coin-name"><?php echo $ex_id;?></span></a></td>
					<td><?php echo (strlen($res->base) > 10) ? substr($res->base,0,7).'...' : $res->base; ?>/<?php echo (strlen($res->target) > 10) ? substr($res->target,0,7).'...' : $res->target; ?></td>
					<td data-sort="<?php echo $res->converted_last->usd;?>"><?php echo strtok($convertSymbol, " ");?><?php echo custom_vol_format($res->converted_last->usd/$convertRate); ?></td>
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
                    url: 'https://api.coingecko.com/api/v3/exchanges/'+coinId+'/volume_chart?days=365',
                    method: 'GET',
                    beforeSend: function() {
                        $(this).closest('.cmc-preloader').show();
                    },
                    success: function(history) {
						
						//var hdata=JSON.parse(history.data);
					  
                     $.each(history, function(i, value) {
                          
                            priceData.push( {
                              "date":new Date(value[0]),
                              "value":value[1],
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
var generateChartData = function(coinId,exchangeData,color) {
var chart = AmCharts.makeChart('COIN-CHART-'+coinId, {
      "type": "stock",
      "theme": "light",
      "hideCredits":true,
      "categoryAxesSettings": {
        "minPeriod": "mm"
      },
      "dataSets": [ {
        "title":"BTC",
        "color":color,
        "fieldMappings": [ {
          "fromField": "value",
          "toField": "value"
        }, {
          "fromField": "volume",
          "toField": "volume"
        } ],
        "dataProvider":exchangeData,
        "categoryField": "date"
      } ],
      "panels": [ {
        "showCategoryAxis": false,
        "title": "Volume",
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
        "title": "Volume",
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