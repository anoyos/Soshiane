<?php $this->load->view('include/header'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"  ></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>

<script type="text/javascript">
		$(document).ready(function() {
		$.noConflict();
		$('#coins-dvt-table').dataTable( {
          "order": [],
          "pageLength": 100,
          "searching": true,
          "bPaginate":false,
          "bInfo" : false,
          "bProcessing": true,
		 "bDeferRender": true,
          
		} );
		} );
	</script>

<div class="page-title py-3">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <h1>
          Top Cryptocurrency Derivative Exchanges
        </h1>
        <h6 class="pb-2">
          List of top crypto derivatives exchages ranked by open interest and trade volume.
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

			<table id="coins-dvt-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
              <th>#</th>
              <th>Exchange</th>
              <th>24h Open Interest</th>
              <th>24h Volume</th>
              <th>Perpetuals</th>
              <th>Futures</th>
              <th>Official Website</th>
            </tr>
          </thead>		
			<tbody>
			


		 <?php
		 $cnt=0;
             setlocale(LC_MONETARY,"en_US");
             foreach ($coinDerivativesData as $res)
				{
					 ?>
				<tr id="DVT_<?php echo strtolower($res->name);?>">
					<td><?php echo ++$cnt;?></td>
					<td><img src="<?php echo $res->image;?>"> <span class="coin-name"><?php echo $res->name;?></span></td>
					<td data-sort="<?php echo $res->open_interest_btc;?>"><span class="price"><?php if(isset($res->open_interest_btc)) echo $res->open_interest_btc." BTC"; else echo 'N/A'; ?></span></td>
					<td data-sort="<?php echo $res->trade_volume_24h_btc;?>"><?php echo $res->trade_volume_24h_btc; ?> BTC</td>
					<td data-sort="<?php echo $res->number_of_perpetual_pairs;?>"><?php echo $res->number_of_perpetual_pairs; ?></td>
					<td data-sort="<?php echo $res->number_of_futures_pairs;?>"><?php echo $res->number_of_futures_pairs; ?></td>
					<td><a href="<?php echo $res->url; ?>" target="_blank"><center><i class="fa fa-external-link"></i></center></a></td>
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