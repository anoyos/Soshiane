<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends G_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library('session');
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
        $data['pageTitle']       = $data['pageData'][0]['meta_title'];
        $data['pageDescription'] = $data['pageData'][0]['meta_description'];
		
		//table data code start
		
		//pagination
		if(isset($_GET['page']))
		$page=$_GET['page'];
		else
		$page=1;
		$total_records=14000;
		$total_pages=ceil($total_records / 100);
		
		
		 $filename=FCPATH . 'upload/json/home.json';
		 $create_time=date ("Y-m-d H:i:s", filemtime($filename));
		 $current_time=date ("Y-m-d H:i:s");
		 $to_time = strtotime($current_time);
		 $from_time = strtotime($create_time);
		 $duration= round(abs($to_time - $from_time) / 60,2);
		 if($duration<=5 && $page==1)
		 $results = file_get_contents($filename, true);
	     else
		 {	
		    $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=100&page='.$page; // path to your JSON file
		    $results = $this->request($url); //call curl function for getting api results
		
		 if($page==1) {
	        $file = fopen(FCPATH.'upload/json/home.json','w');
            fwrite($file, $results);
            fclose($file);
	        }
		 }

		$data['coinHomeData']   = json_decode($results);
		$data['page']=$page;
		$data['total_pages']=$total_pages;
		//end
		
        $this->load->view('home', $data);
    }
    
    /* function for coin detail page */
    public function coin()
    {
        //coin single page
        $coin           = $this->uri->segment(2); //get coin name from url
        $url            = 'https://api.coingecko.com/api/v3/coins/' . $coin . '?localization=false&community_data=false&developer_data=false&sparkline=false&include_exchange_logo=true'; // path to your JSON file
        $results        = $this->request($url); //call curl function for getting api results
        $data['coinData']              = json_decode($results);
        
        $data['settingData']           = $this->home_model->list_data('settings');
        $data['pageData']              = $this->home_model->list_data('cms');
        $data['donations']             = $this->home_model->list_data('donation');
        $data['ads']                   = $this->home_model->list_data('ads');
        $data['call2Action']           = $this->home_model->list_data('call2action');
        
        //history data of last 7 days
        //$url                           = 'https://api.coingecko.com/api/v3/coins/' . $coin . '/market_chart?vs_currency=usd&days=365'; // path to your JSON file
        //$results                       = $this->request($url); // put the contents of the file into a variable
        //$data['coinHistoryMarketData'] = json_decode($results);
        
        $data['pageTitle']             = $data['coinData']->name . ' (' . strtoupper($data['coinData']->symbol) . ') Live Price, MarketCap & Info';
        $data['pageDescription']       = 'Live ' . $data['coinData']->name . ' prices, market Capitalization, historical data chart, volume & supply. Stay up to date with the latest ' . $data['coinData']->name . ' info & markets data. Check our coins stats data to see when there is an opportunity to buy or sell ' . $data['coinData']->symbol. ' at best price.';
		$data['coin']       = $coin;
		
		$this->load->view('coin', $data);
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
	 
	 public function set_rate()
	 {
		 $rate=$this->input->post('rate');
		 $this->session->set_userdata('convert_rate', $rate);
		
		 
		 $symbol=$this->input->post('symbol');
		 $this->session->set_userdata('convert_symbol', $symbol);
	 }
}