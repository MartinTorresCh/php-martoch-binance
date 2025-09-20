<?php

declare(strict_types=1);

namespace MARTOCH\binance;

use MARTOCH\binance\Exceptions\BadRemoteCallException;
use MARTOCH\binance\Traits\HandlesAsync;
use MARTOCH\binance\Traits\ApiSpecialPaths;
use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Promise;
use GuzzleHttp\TransferStats;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Ratchet\Client\WebSocket;
use Ratchet\RFC6455\Messaging\MessageInterface;



class BinanceClient
{
    use HandlesAsync;
    use ApiSpecialPaths;
    
    /**
     * Client configuration.
     *
     * @var \MARTOCH\binance\Config
     */
    protected $config;

    /**
     * Array of GuzzleHttp promises.
     *
     * @var array
     */
    protected $promises = [];

    /**
     * URL path.
     *
     * @var string
     */
    protected $path = '/api/v3/';

    /**
     * api key.
     *
     * @var string
     */
    protected $API_KEY = '';

    /**
     * secret key.
     *
     * @var string
     */
    protected $SECRET_KEY = '';

    /**
     * secret key.
     *
     * @var string
     */
    protected $FILE_KEY = null;

    /**
     * security type.
     *
     * @var string
     */
    protected $security_type = '';

    /**
     * call type. GET, POST, PUT, DELETE
     *
     * @var string
     */
    protected $call_type = '';

    /**
     * cluster api index.
     *
     * @var string
     */
    protected $cluster_index = 0;

    /**
     * api production url.
     *
     * @var array
    */
    protected $cluster_endpoints = [
        "https://api.binance.com",
        "https://api1.binance.com",
        "https://api2.binance.com",
        "https://api3.binance.com"
    ];

    /**
     * api testnet url.
     *
     * @var array
    */
    protected $cluster_endpoints_testnet = [
        "https://testnet.binance.vision",       
    ];

    /**
     * api testnet active.
     *
     * @var bool
    */
    protected $testnet_active = false;

    /**
     *  api websocket active
     *
     * @var bool
    */
    protected $websocket_active = false;
    

    /**
     * socket url.
     *
     * @var array
    */
    protected $websocket_cluster_endpoints = [
        "wss://stream.binance.com:9443/ws/",       
    ];

    /**
     * socket url testnet.
     *
     * @var array
    */
    protected $websocket_cluster_endpoints_testnet = [
        "wss://stream.binance.com:9443/ws/",       
    ];

    

    
    /**
     * api key.
     *
     * @var string
     */
    protected $PROXY_HOST = '';

    /**
     * api key.
     *
     * @var string
     */
    protected $PROXY_TIMEOUT = '';

    /**
     * api key.
     *
     * @var string
     */
    protected $PROXY_VERIFY = '';





    /**
     * Constructs new client.
     *
     * @param array|string $config
     *
     * @return void
     */
    public function __construct($API_KEY,$SECRET_KEY,$PROXY_HOST = NULL,$PROXY_TIMEOUT = NULL,$PROXY_VERIFY = NULL,$FILE_KEY = NULL)
    {
        $this->API_KEY = $API_KEY;
        $this->SECRET_KEY = $SECRET_KEY;

        $this->PROXY_HOST = $PROXY_HOST;
        $this->PROXY_TIMEOUT = $PROXY_TIMEOUT;
        $this->PROXY_VERIFY = $PROXY_VERIFY;
     
        $this->FILE_KEY = $FILE_KEY;
    }

    /**
     * Wait for all promises on object destruction.
     *
     * @return void
     */
    public function __destruct()
    {
        $this->wait();
    }




    /**
     * Makes request to binance api.
     *
     * @param string $method
     * @param mixed  $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $method, ...$params): ResponseInterface
    {
        
        try {
           

            //note if request need timestamp parameter you can use carbon like this: Carbon::now()->format("Uv") 
            


            if(strpos($method,'call') === 0){
                $method = explode('call',$method)[1];
            }elseif(strpos($method,'HYPHEN') >= 0){
                $method = str_replace("HYPHEN", "-", $method);
            }
            
            $params_ = $params[0];

            if($this->testnet_active){
                $url = $this->cluster_endpoints_testnet[$this->cluster_index].$this->path.$method;
            }else{
                $url = $this->cluster_endpoints[$this->cluster_index].$this->path.$method;
                 
            }
           
            $params = [];

            foreach($params_ as $key=>$item){
               
                $params['query'][$key] = $item;
            }

            switch ($this->security_type) {
                default:
                case 'NONE':                    
                    $client = new GuzzleHttp(['http_errors' => false]);                    
                    break;
                case 'TRADE':
                    
                    
                    if($this->FILE_KEY != null){
                        
                        $sign_pair = sodium_crypto_sign_seed_keypair($this->FILE_KEY);

                        $sign_secret = sodium_crypto_sign_secretkey($sign_pair);
                        $sign_public = sodium_crypto_sign_publickey($sign_pair);

                       
                        $payload = http_build_query($params_);

                        $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]); 
                        $params['query']['signature'] = base64_encode(sodium_crypto_sign_detached($payload, $sign_secret));
                        
                    }else{

                        $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]);   
                        $params['query']['signature'] = hash_hmac('SHA256', http_build_query($params_), $this->SECRET_KEY);
                    }

                    break;
                case 'MARGIN':

                    if($this->FILE_KEY != null){
                        
                        $sign_pair = sodium_crypto_sign_seed_keypair($this->FILE_KEY);

                        $sign_secret = sodium_crypto_sign_secretkey($sign_pair);
                        $sign_public = sodium_crypto_sign_publickey($sign_pair);

                       
                        $payload = http_build_query($params_);

                        $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]); 
                        $params['query']['signature'] = base64_encode(sodium_crypto_sign_detached($payload, $sign_secret));
                        
                    }else{

                        $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]);   
                        $params['query']['signature'] = hash_hmac('SHA256', http_build_query($params_), $this->SECRET_KEY);     
                    
                    }

                    break;
                case 'USER_DATA':

                    if($this->FILE_KEY != null){
                        
                        $sign_pair = sodium_crypto_sign_seed_keypair($this->FILE_KEY);

                        $sign_secret = sodium_crypto_sign_secretkey($sign_pair);
                        $sign_public = sodium_crypto_sign_publickey($sign_pair);

                       
                        $payload = http_build_query($params_);

                        $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]); 
                        $params['query']['signature'] = base64_encode(sodium_crypto_sign_detached($payload, $sign_secret));
                        
                    }else{

                        $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]);  
                        $params['query']['signature'] = hash_hmac('SHA256', http_build_query($params_), $this->SECRET_KEY);
                    
                    }

                    break;
                case 'USER_STREAM':
                    $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]);                   
                    break;
                case 'MARKET_DATA':
                    $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]);                   
                    break;
                case 'SIGNED':
                    $client = new GuzzleHttp(['headers' => ['X-MBX-APIKEY' => $this->API_KEY], 'http_errors' => false]);   
                    break;               
            }

           
            
            if($this->PROXY_HOST)$params['proxy'] = $this->PROXY_HOST;
            if($this->PROXY_TIMEOUT)$params['timeout'] = $this->PROXY_TIMEOUT;
            if($this->PROXY_VERIFY)$params['verify'] = $this->PROXY_VERIFY;
            $response = $client->request($this->call_type, $url, $params);
            
            return $response;

        } catch (Throwable $exception) {
            throw new \ErrorException($exception->getMessage());
        }
    }


    /**
     * Opens a websocket connection and transmits received messages until closed.
     *
     * @param string $type   The websocket method.
     * @param array  $params The parameters to send.
     * @param bool   $once   If true, it will close the connection after the first successful message.
     *
     * @return void
     * @throws LarislackersException
     */
    protected function makeWebsocketRequest(string $method, ...$params)
    {

       
        if($this->testnet_active){
            $url = $this->websocket_cluster_endpoints_testnet[$this->cluster_index];
        }else{
            $url = $this->websocket_cluster_endpoints[$this->cluster_index];
             
        }


        switch (strtoupper($method)) {
            default:
            case 'DEPTH':
                $url = $url . strtolower($params[0]['symbol']) . '@depth';
                break;
            case 'KLINE':
                $url = $url . strtolower($params[0]['symbol']) . '@kline_' . $params[0]['interval'];
                break;
            case 'TRADES':
                $url = $url . strtolower($params[0]['symbol']) . '@aggTrade';
                break;
            case 'USER':
                $url = $url . strtolower($params[0]['symbol']);
                break;
        }


        $once = $params[0]['once'];
        
        \Ratchet\Client\connect($url)->then(function (WebSocket $conn) use ($once) {
            
            $conn->on('message', function (MessageInterface $msg) use ($conn, $once) {
                
                echo $msg . "\n";
                if ($once) $conn->close();
            });

            $conn->on('close', function ($code = null, $reason = null) {
                
                echo 'Connection closed (' . $code . ' - ' . $reason . ')';
            });

            $conn->on('error', function () {
                
                throw new LarislackersException('[ERROR|Websocket] Could not establish a connection.');
            });
        });
    }

    

    /**
     * Settle all promises.
     *
     * @return void
     */
    public function wait(): void
    {
        if (!empty($this->promises)) {
            Promise\settle($this->promises)->wait();
        }
    }

    /**
     * Makes request to binance api.
     *
     * @param string $method
     * @param array  $params
     *
     * @return \GuzzleHttp\Promise\Promise|\Psr\Http\Message\ResponseInterface
     */
    public function __call(string $method, array $params = [])
    {
        
        if($this->websocket_active){
            
            $result = $this->makeWebsocketRequest($method, ...$params);

            
        }else{

            $result = $this->request($method, ...$params);

            $result_ = json_decode($result->getBody()->getContents(),true);

            if(isset($result_['code'])){
                return [
                    'api_response' => $result_,   
                    'status'=>false          
                ];
            }else{
                return [
                    'api_response' => $result_,  
                    'status'=>true           
                ];
            }
        }
        
    }

    

    /**
     * Gets response handler class name.
     *
     * @return string
     */
    protected function getResponseHandler(): string
    {
        return 'MARTOCH\\binance\\Responses\\MartochdResponse';
    }

    /**
     * Gets Guzzle handler stack.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function getHandler(): HandlerStack
    {
        $stack = HandlerStack::create();

        $stack->push(
            Middleware::mapResponse(function (ResponseInterface $response) {
                $handler = $this->getResponseHandler();

                return new $handler($response);
            }),
            'martochd_response'
        );

        return $stack;
    }

    
    public function getPath(){        
        return $this->path;
    }


    //set security type
    public function useNONE(){
        $this->security_type = "NONE";
    }

    public function useTRADE(){
        $this->security_type = "TRADE";
    }

    public function useMARGIN(){
        $this->security_type = "MARGIN";
    }

    public function useUSER_DATA(){
        $this->security_type = "USER_DATA";
    }

    public function useUSER_STREAM(){
        $this->security_type = "USER_STREAM";
    }

    public function useMARKET_DATA(){
        $this->security_type = "MARKET_DATA";
    }


    //set TESTNET
    public function useTESTNET(){        
        $this->testnet_active = true;
    }

    //set no testnet
    public function useNOTESTNET(){        
        $this->testnet_active = false;
    }

    //set API path
    public function useAPIV3(){
        $this->path = "/api/v3/";      
    }

    //set FAPI path
    public function useFAPI(){
        $this->path = "/fapi/v1/";      
    }

    //set FAPIV2 path
    public function useFAPIV2(){
        $this->path = "/fapi/v2/";      
    }

    //set SAPI path
    public function useSAPI(){
        $this->path = "/sapi/v1/";        
    }

    //set DAPI path
    public function useDAPI(){
        $this->path = "/dapi/v1/";        
    }

    //set DAPI path
    public function useVAPI(){
        $this->path = "/vapi/v1/";        
    }

    //set DAPI path
    public function useWAPI(){
        $this->path = "/wapi/v3/";        
    }
     

    //set Call Type
    public function useGET(){
        $this->call_type = "GET";
    }

    public function usePOST(){
        $this->call_type = "POST";
    }

    public function usePUT(){
        $this->call_type = "PUT";
    }

    public function useDELETE(){
        $this->call_type = "DELETE";
    }



    //set Cluster URL endopoint
    public function urlClusterConfig($index){

        if(is_int($index)){
            $this->cluster_index = $index;
        }
    }

    //setWebSocket
    public function useWEBSOCKET(){
        $this->websocket_active = true;
    }

    
    
}
