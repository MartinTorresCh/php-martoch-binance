# php-martoch-binance
PHP library to use Binance api

## Instalation
Run ```composer require martoch/php-martoch-binance```

## Requirements
PHP 7.3 or higher

## Usage

### Example 1
for more information about Binance api see: https://binance-docs.github.io/apidocs/  
it will be your guide to use this library

1. require BinanceClient class inside your proyect where you will work

```use MARTOCH\binance\BinanceClient;```  

2. create a new instance of the object, you will need your Binance api key and your Binance secret key


```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
```

3. set the correct configuration for your call, you can see the correct configuration reading the api documentation

for example, lets see **Check Server Time** method (https://binance-docs.github.io/apidocs/spot/en/#check-server-time)

As we can see, the correct path and call type is: **GET /api/v3/time**, Likewise, we observe that it is a public method, so the security type is **NONE** (you can see more information about the security types in the following url: https://binance-docs.github.io/apidocs/spot/en/#endpoint-security-type)  

then the configuration must be set as:

```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->useNONE(); //object will use NONE as security type
$binance->useGET(); //object will use GET as call method
```

**Notes**:  
-you can use diferent security type using the following methods (the security type is displayed inside the method you want to use by reading the binance api documentation):

```
$binance->useNONE(); //NONE
$binance->useTRADE(); //TRADE
$binance->useMARGIN(); //MARGIN
$binance->useUSER_DATA(); //USER_DATA
$binance->useUSER_STREAM(); //USER_STREAM
$binance->useMARKET_DATA(); //MARKET_DATA
```

-for default **BinanceCliente** use **/api/v3/** as primary path, however, binance uses different endpoints for all its functionality, therefore you can configure them using the following methods:


```
$binance->useAPIV3(); //path: /api/v3/
$binance->useFAPI(); //path: /fapi/v1/
$binance->useFAPIV2(); //path: /fapi/v2/
$binance->useSAPI(); //path: /sapi/v1/
$binance->useDAPI(); //path: /dapi/v1/
$binance->useVAPI(); //path: /vapi/v1/
$binance->useWAPI(); //path: /wapi/v3/
```

example usaing endpoint path **/fapi/v1/** | **NONE** as security type | **GET** as call method:
```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->useFAPI();
$binance->useNONE();
$binance->useGET();
```

4. call the method you want to use, in this example **Check Server Time** (**GET /api/v3/time**)  

**Note:** this methos does not require parameters, therefore you must send an empty array

```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->useNONE();
$binance->useGET();

$response = $binance->time([]);
```

5. use the response as you need, it will be return an array like this:  
```
[
  "api_response" =>[
    "serverTime" => 1654802108489
  ]
  "status" => true
]
```

**Note:**  
-if everything is ok you will receive a status: true  
-if api responses with an error you will be receive a status:false with the response like this (for more information about errors check the api documentation in the errors section):
```
[
  "api_response" =>[
    "code" => -1101
    "msg" => "Too many parameters; expected '0' and received '1'."
  ]
  "status" => false
]
```

### Example 2
In some cases the binance api uses paths for its methods with more than one element within its url   
for example, lets see **System Status (System)** method (https://binance-docs.github.io/apidocs/spot/en/#system-status-system)

1. declare your object and set the configuracion (**GET /sapi/v1/system/status**)
```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->useSAPI(); //object will use /sapi/v1/
$binance->useNONE(); //object will use NONE as security type
$binance->useGET(); //object will use GET as call method
```

2. call **status** method  
**Note:** this methos does not require parameters, therefore you must send an empty array
```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->useSAPI(); //object will use /sapi/v1/
$binance->useNONE(); //object will use NONE as security type
$binance->useGET(); //object will use GET as call method

$result = $binance->_system()->status([]);  
```
-As we can see we concatenate the method called **system** before the final call to the method **status**  
-All path methods declared before the final method must contain an underscore **_**, in this example:
```
->_system()
```

-in some cases the path or the final methods contains hyphens for example **Create a Virtual Sub-account(For Master Account):**    
**POST /sapi/v1/sub-account/virtualSubAccount** 

then you need to replace hyphen symbol with the word **HYPHEN** and declare as:

```
->_subHYPHENaccount()->virtualSubAccount([]);
```
-in some cases the path or the final method start with a number for example **24hr Ticker Price Change Statistics:**  
**GET /api/v3/ticker/24hr**

then you need to add the word **call** at the beginning:

```
->_ticker()->call24hr([]);
```

3. use the response as you need


### Example 3
Same as **example 2** but with a method that uses more than one subpath  
for example, lets see **Withdraw(USER_DATA)** method (https://binance-docs.github.io/apidocs/spot/en/#withdraw-user_data)  

1. declare your object and set the configuracion (**POST /sapi/v1/capital/withdraw/apply (HMAC SHA256)**)
```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->useSAPI(); //object will use /sapi/v1/
$binance->useUSER_DATA(); //object will use USER_DATA as security type
$binance->usePOST(); //object will use POST as call method
```

2. call **apply** method


**Note:**  
-that path contains **capital** and **withdraw**  
-in this example the method requires some parameter, then you need to declare an array with all parameters you need (for more information about the parameters you need see the api documentation for every method you want to use)


```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->useSAPI(); //object will use /sapi/v1/
$binance->useUSER_DATA(); //object will use USER_DATA as security type
$binance->usePOST(); //object will use POST as call method

$params = [
  'coin'=>'BNB'
  'timestamp'=>1654732800011,
  'otherparam'=>'something here',
  'otherparam2'=>'something here',
  ....
];

$result = $binance->_capital()->_withdraw()->apply($params);
```


3. use the response as you need


## Additional Information

1. Binance has a **TESTNET**, to use this api you need to call **useTESTNET()** when you configure your object, this method change the endpoint URL of binance api to the testnet endpoint:

**https://api.binance.com** -> **https://testnet.binancefuture.com**

**Note:** testnet use generaly **/fapi/v1/** path, but can be another diferent, remember set it when config your object
```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->useTESTNET();
$binance->useFAPI();

```

2. Binance api contains multiple endpoints for its API (cluster), you can switch beetween them using the method **urlClusterConfig($index)** (more information in api documentation page)

where **$index** is the array position of the of the following arrays (remember that if you have testnet enabled, the index will be for the testnet cluster, otherwise it will be for the normal api cluster) 

**Note:** for default $index is 0 when you create the BiananceClient object

**Normal api Cluster**
```
    [
        "https://api.binance.com", // index = 0
        "https://api1.binance.com", // index = 1
        "https://api2.binance.com", // index = 2
        "https://api3.binance.com" // index = 3
    ]
```

**Testnet api Cluster**
```
    [
        "https://testnet.binancefuture.com", // index = 0
        
    ]
```

example:  
```
$my_api_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$my_secret_key = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$binance = new BinanceClient($my_api_key,$my_secret_key);
$binance->urlClusterConfig(1); //this will change the endpoint for: https://api1.binance.com
$binance->useFAPI();

```

## Licence
This product is distributed under MIT license.

