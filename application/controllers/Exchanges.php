<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exchanges extends G_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('public/home_model');
        
    }
    
    /**
     * Index Page for this controller.
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     */
    
    public function index()
    {
	    $data['donations']       = $this->home_model->list_data('donation');
        $data['settingData']     = $this->home_model->list_data('settings');
        $data['pageData']        = $this->home_model->list_data('cms');
        $data['ads']             = $this->home_model->list_data('ads');
        $data['call2Action']     = $this->home_model->list_data('call2action');
        
        $data['pageTitle']       = 'Top Cryptocurrency Exchanges List | '. $data['pageData'][0]['meta_title'] .'';
        $data['pageDescription'] = 'List of top crypto exchanges ranked by 24 hours trading volume. View cryptourrency exchanges market data, info, trading pairs and information.';
        
        //pagination
		if(isset($_GET['page']))
		$page=$_GET['page'];
		else
		$page=1;
		$total_records=500;
		$total_pages=ceil($total_records / 100);
		
		
		$filename=FCPATH . 'upload/json/exchange.json';
		$create_time=date ("Y-m-d H:i:s", filemtime($filename));
		$current_time=date ("Y-m-d H:i:s");
		$to_time = strtotime($current_time);
		$from_time = strtotime($create_time);
		$duration= round(abs($to_time - $from_time) / 60,2);
		if($duration<=10 && $page==1)
		$exchanges_results = file_get_contents($filename, true);
	    else
		 {	
			$url  = 'https://api.coingecko.com/api/v3/exchanges?per_page=100&page='.$page; // path to your JSON file
	        $exchanges_results  = $this->request($url);
	        
	        if($page==1) {
	        $file = fopen(FCPATH.'upload/json/exchange.json','w');
            fwrite($file, $exchanges_results);
            fclose($file);
	        }
		 }
		
		$data['coinExchangesData']   = json_decode($exchanges_results);
		$data['page']=$page;
		$data['total_pages']=$total_pages;
		
        $this->load->view('exchanges/index', $data);
    }

    /* function for derivatives exchange */
        public function derivatives()
    {
	    $data['donations']       = $this->home_model->list_data('donation');
        $data['settingData']     = $this->home_model->list_data('settings');
        $data['pageData']        = $this->home_model->list_data('cms');
        $data['ads']             = $this->home_model->list_data('ads');
        $data['call2Action']     = $this->home_model->list_data('call2action');
        
        $data['pageTitle']       = 'Top Cryptocurrency Derivatives Exchanges List | '. $data['pageData'][0]['meta_title'] .'';
        $data['pageDescription'] = 'List of top crypto derivatives exchanges ranked by open interest and trade volume. View cryptourrency exchanges market data, info, trading pairs and information.';
		
		
	 $filename=FCPATH . 'upload/json/derivatives.json';
		 $create_time=date ("Y-m-d H:i:s", filemtime($filename));
		 $current_time=date ("Y-m-d H:i:s");
		 $to_time = strtotime($current_time);
		 $from_time = strtotime($create_time);
		 $duration= round(abs($to_time - $from_time) / 60,2);
		 if($duration<=360)
		 $derivatives_results = file_get_contents($filename, true);
	     else
		 {		
		 $durl  = 'https://api.coingecko.com/api/v3/derivatives/exchanges?per_page=250'; // path to your JSON file
	     $derivatives_results  = $this->request($durl);
		 $file = fopen(FCPATH.'upload/json/derivatives.json','w');
         fwrite($file, $derivatives_results);
         fclose($file);
		 }
		
		$data['coinDerivativesData']   = json_decode($derivatives_results);
		
        $this->load->view('exchanges/derivatives', $data);
    }
    
    
  
    /* function for exchange detail page */
    public function detail()
    {
        $exchange       = strtolower($this->uri->segment(2)); //
        $url            = 'https://api.coingecko.com/api/v3/exchanges/' . $exchange; // path to your JSON file
        $results        = $this->request($url); //call curl function for getting api results
        $data['exchangeData'] = json_decode($results);
        
        $data['settingData']           = $this->home_model->list_data('settings');
        $data['pageData']              = $this->home_model->list_data('cms');
        $data['donations']             = $this->home_model->list_data('donation');
        $data['ads']                   = $this->home_model->list_data('ads');
        $data['call2Action']           = $this->home_model->list_data('call2action');

        $data['pageTitle']             = $data['exchangeData']->name . ' Markets, Trade Volume, Pairs & Info';
        $data['pageDescription']       = 'Checkout ' . $data['exchangeData']->name . ' 24 hours trading volume & pairs info. Stay up to date with the latest ' . $data['exchangeData']->name . ' info. Stay up to date with the latest crypto trading price movements on ' . $data['exchangeData']->name. ' platform.';
		
		$data['exchange']       = $exchange;
       
		$this->load->view('exchanges/exchange', $data);
    }
    
    //curl call function 
    public function request($url)
     {


        $curl = curl_init();

         curl_setopt_array($curl, array(
		 CURLOPT_URL => $url,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,
         CURLOPT_FOLLOWLOCATION => false,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
          ));

        $response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

	if ($err) {
        return "cURL Error #:" . $err;
	} else {
       return $response;
      }

     }

}