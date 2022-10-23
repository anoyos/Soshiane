<?php $this->load->view('include/header'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"  ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>

<script type="text/javascript">
		$(document).ready(function() {
		$.noConflict();
		$('#coins-nft-table').dataTable( {
          "order": [],
          "pageLength": 100,
          "searching": true,
          "bPaginate":true,
          "bInfo" : false,
          "bProcessing": true,
		 "bDeferRender": true,
          
		} );
		} );
	</script>
<?php
	function custom_number_format($n, $precision = 2) {
        if ($n < 100000) {
        // Default
         $n_format = number_format($n);
        } else if ($n < 9000000) {
        // Thousand
        $n_format = number_format($n / 1000, $precision, '.', ''). 'K';
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
      <div class="col-md-12 text-center">
        <h1>
          Top NFT Coins Ranked by Market Cap
        </h1>
        <h6 class="pb-2">
          List of top Non Fungible Token (NFT) coins ranked by the market cap. View cryptourrency market data, info, trading pairs & information and see when there is an opportunity to buy or sell coin at best price.
        </h6>
        <div class="pb-3">
        <a target = '_blank' href="<?php echo $settingData[0]['buy_sell'] ?>" class="btn btn-outline-dark btn-lg">
            Start Crypto Trading
        </a>
        </div>
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
<!-- Data Table  -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-left">

			<table id="coins-nft-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Price</th>
              <th>Market Cap</th>
              <th>Available Supply</th>
              <th>Volume (24H)</th>
              <th>Change (24H)</th>
            </tr>
          </thead>		
			<tbody>
		 <?php
             setlocale(LC_MONETARY,"en_US");
             foreach ($coinNftData as $res)
				{
					 ?>
				<tr id="NFT_<?php echo strtolower($res->name);?>">
					<td><?php if(isset($res->market_cap_rank)) echo $res->market_cap_rank; else echo 'N/A';?></td>
					<td><img src="<?php echo $res->image;?>"><a href="<?php echo base_url() ?>coin/<?php echo $res->id; ?>"><span class="coin-name"><?php echo $res->name;?></span></a> <span class="badge badge-warning"><?php echo strtoupper($res->symbol); ?></span></td>
					<td data-sort="<?php echo $res->current_price;?>"><span class="price"><?php echo strtok($convertSymbol, " ");?><?php echo custom_prc_format($res->current_price/$convertRate); ?></span></td>
					<td data-sort="<?php echo $res->market_cap;?>"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($res->market_cap/$convertRate); ?></td>
					<td data-sort="<?php echo $res->circulating_supply;?>"><?php echo custom_number_format($res->circulating_supply); ?> <?php echo strtoupper($res->symbol); ?></td>
					<td data-sort="<?php echo $res->total_volume;?>"><?php echo strtok($convertSymbol, " ");?><?php echo custom_number_format($res->total_volume/$convertRate); ?></td>
					<td data-sort="<?php echo $res->price_change_percentage_24h;?>"><span class="p-<?php echo $res->price_change_percentage_24h > 0 ? 'up':'down'?>"><i class="fa fa-caret-<?php echo $res->price_change_percentage_24h > 0 ? 'up':'down'?>"></i> <?php echo str_replace('-','',round($res->price_change_percentage_24h,2));?>%</span></td>
				</tr>
			<?php
		}
				?>
        </tbody>
		   </table>    
		  
        </div>        
    </div>    
</div>
<!-- End Data Table  -->
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
<!-- End Ad Code Bottom  -->   

<!-- News Section Start  -->
<div class="container pt-3 pb-5">
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
<div style="padding-left:0px;padding-right:0px;" class="col-md-4">
<div style="margin-bottom:20px;padding-left:0px;padding-right:0px;min-height:500px;" class="card">
<img src="<?php echo $res->enclosure->{"@attributes"}->url;?>" class="card-img-left">
<div class="card-body">
<span class="badge linking"> <?php echo substr($res->pubDate, 0, 16);?> </span>
<h6 class="card-title"><?php echo $res->title;?></h6>
<p><?php echo strip_tags(substr($res->description, 0, 450));?>...</p>
<a href="<?php echo $res->link;?>" class="btn btn-warning" target="_blank">Read More</a>
</div></div></div>
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
		
<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>