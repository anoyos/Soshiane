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
		$('#coins-info-table').dataTable( {
          "order": [],
          "pageLength": 100,
          "searching": false,
          "bPaginate":false,
          "bInfo" : false,
          "bProcessing": true,
		 "bDeferRender": true,
          
		} );
		} );
	</script>
<?php
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
          Top Cryptocurrency Spot Exchanges List
        </h1>
        <h6 class="pb-3">
          List of top crypto exchanges platform. The exchange rank is based on based on traffic, liquidity, trading volumes, and confidence in the legitimacy of trading volumes reported. View live cryptourrency exchanges rank, markets data, 24h volume, trading pairs and info.
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
            <input type="input" class="form-control" id="txt-search" placeholder="Search Exchange">
	        <div id="filter-records"></div>
			<table id="coins-info-table" class="table table-striped table-bordered dt-responsive wrap" cellspacing="0" width="100%">
			<thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Trust Score</th>
                <th>Volume 24(H)</th>
                <th>Country</th>
                <!-- <th>Established</th> -->
				<th>Official Website</th>
            </tr>
			</thead>
			<tbody>
		 <?php
             setlocale(LC_MONETARY,"en_US");
             foreach ($coinExchangesData as $res)
				{
					 ?>
				<tr id="CN_<?php echo strtolower($res->name);?>">
					<td><?php if(isset($res->trust_score_rank)) echo $res->trust_score_rank; else echo 'N/A';?></td>
					<td><img src="<?php echo $res->image;?>"><a href="<?php echo base_url() ?>exchange/<?php echo $res->id; ?>"><span class="coin-name"><?php echo $res->name;?></span></a></td>
					<td data-sort="<?php echo $res->trust_score;?>"><div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $res->trust_score;?>0%;" aria-valuenow="<?php echo $res->trust_score;?>" aria-valuemin="0" aria-valuemax="10"><?php if(isset($res->trust_score)) echo $res->trust_score; else echo '<span style="color:#000;">N/A</span>';?></div></div></td>
					<td data-sort="<?php echo $res->trade_volume_24h_btc;?>"><?php echo custom_prc_format($res->trade_volume_24h_btc); ?> BTC</td>
					<td><?php if(isset($res->country)) echo $res->country; else echo 'N/A'; ?></td>
				<!--	<td><?php if(isset($res->year_established)) echo $res->year_established; else echo 'N/A'; ?></td> -->
					<td><a href="<?php echo $res->url; ?>" target="_blank"><center><i class="fa fa-external-link"></i></center></a></td>
				</tr>
			<?php
		}
				?>
        </tbody>
		   </table>      
		   		   <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
  <?php if($page>1) {
	$pn = $page - 1;	  ?>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $pn;?>" tabindex="-1">Previous</a>
    </li>
  <?php } else { ?>
  <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
  <?php } ?>
  <?php if($total_pages > $page) {
		$pn = $page + 1; ?>
    <li class="page-item">
      <a class="page-link" href="?page=<?php echo $pn;?>">Next</a>
    </li>
    <?php } else { ?>
  <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Next</a>
    </li>
  <?php } ?>
  </ul>
</nav>
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
<script type="text/javascript">
 $('#txt-search').keyup(function(){
var searchField = $('#txt-search').val();
if(searchField === '')  {
				$('#filter-records').html('');
				return;
			}
var myExp = new RegExp(searchField, 'i');
$.getJSON('https://api.coingecko.com/api/v3/search', function(res){
var output = '<ul class="searchresult">';
$.each(res.exchanges, function(key, val){
if((val.name.search(myExp) != -1)) {
	output += '<li><a href="<?php echo base_url(); ?>exchange/' + val.id + '"> ' + val.name + '</a></li>';
}
});
output += '</ul>';
$('#filter-records').html(output);
});
});
</script>
<script src="<?php echo base_url(); ?>assets/js/front/jquery-3.3.1.slim.min.js"></script>
<?php $this->load->view('include/footer'); ?>
