<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nft extends G_Controller
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
        
        $data['pageTitle']       = 'Top Non Fungible Token (NFT) Coins List | '. $data['pageData'][0]['meta_title'] .'';
        $data['pageDescription'] = 'List of top NFT coins ranked by market cap. View cryptourrency market data, info, trading pairs and information.';
		
		
        $filename=FCPATH . 'upload/json/nft.json';
		 $create_time=date ("Y-m-d H:i:s", filemtime($filename));
		 $current_time=date ("Y-m-d H:i:s");
		 $to_time = strtotime($current_time);
		 $from_time = strtotime($create_time);
		 $duration= round(abs($to_time - $from_time) / 60,2);
		 if($duration<=5)
		 $nft_results = file_get_contents($filename, true);
	     else
		 {		
		 $nurl  = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&category=non-fungible-tokens-nft&order=market_cap_desc&per_page=250&sparkline=false'; // path to your JSON file
	     $nft_results  = $this->request($nurl);
		 $file = fopen(FCPATH.'upload/json/nft.json','w');
         fwrite($file, $nft_results);
         fclose($file);
		 }
		
		$data['coinNftData']   = json_decode($nft_results);
		
        $this->load->view('nft/index', $data);
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