<?php


/*USAGE:
 *
 *
 *
$coinigy_api = new coinigy_api_example_v1();
$coinigy_api->exchanges();
$coinigy_api->markets('OK');
 *
 *
 *
 */

class coinigy_api_client  {

    //private class vars set in constructor
    //see API docs for more info
    private $coinigy_api_key;
    private $coinigy_api_secret;
    private $endpoint;


    function __construct($api_key, $api_secret)
    {
        //see API docs for more info
        $this->coinigy_api_key = $api_key;
        $this->coinigy_api_secret = $api_secret;
        $this->endpoint = 'https://api.coinigy.com/api/v1/'; //with trailing slash
    }

     public function accounts_info()
    {
        $post_arr = array();

        return $this->query('accounts', $post_arr);
    }

     public function accounts()
    {
        $res = $this->accounts_info();
        $auth_key = array_column($res, 'auth_key');
        $exch_name = array_column($res, 'exch_name');

        return $this->array_combine_($exch_name, $auth_key);
    }

     public function auth_ids()
    {
        $res = $this->accounts_info();
        $auth_id = array_column($res, 'auth_id');
        $exch_name = array_column($res, 'auth_key');

        return array_combine($exch_name, $auth_id);
    }

    public function activity()
    {
        $post_arr = array();
        return $this->query('activity', $post_arr);
    }

    public function balances($auth_ids)
    {
        $post_arr = array();
        $post_arr["auth_ids"] = $auth_ids;
        $post_arr["show_nils"] = 0;
        return $this->query('balances', $post_arr);
    }

    public function pushNotifications()
    {
        $post_arr = array();
        return $this->query('pushNotifications', $post_arr);
    }

    public function user_orders()
    {
        $post_arr = array();
        return $this->query('orders', $post_arr);
    }

    public function alerts()
    {
        $post_arr = array();
        return $this->query('alerts', $post_arr);

    }

    public function exchanges()
    {
        $post_arr = array();
        return $this->query('exchanges', $post_arr);

    }

    public function markets()
    {
        $post_arr = array();
        $post_arr["exchange_code"] = "KRKN";

        $res = $this->query("markets", $post_arr);
        return array_combine(array_column($res, 'mkt_id'), array_column($res, 'mkt_name'));

    }

    public function history($exchange_code, $exchange_market)
    {
        $post_arr = array();
        $post_arr["exchange_code"] = $exchange_code;
        $post_arr["exchange_market"] = $exchange_market;
        $post_arr["type"] = "history";


        return $this->query('data', $post_arr);

    }

    public function asks($exchange_code, $exchange_market)
    {
        $post_arr = array();
        $post_arr["exchange_code"] = $exchange_code;
        $post_arr["exchange_market"] = $exchange_market;
        $post_arr["type"] = "asks";

        return $this->query('data', $post_arr);

    }

    public function bids($exchange_code, $exchange_market)
    {
        $post_arr = array();
        $post_arr["exchange_code"] = $exchange_code;
        $post_arr["exchange_market"] = $exchange_market;
        $post_arr["type"] = "bids";

        return $this->query('data', $post_arr);

    }

    //asks + bids + history
    public function data($exchange_code, $exchange_market)
    {
        $post_arr = array();
        $post_arr["exchange_code"] = $exchange_code;
        $post_arr["exchange_market"] = $exchange_market;
        $post_arr["type"] = "all";

        return $this->query('data', $post_arr);

    }

    //asks + bids
    public function orders($exchange_code, $exchange_market)
    {

        $post_arr = array();
        $post_arr["exchange_code"] = $exchange_code;
        $post_arr["exchange_market"] = $exchange_market;
        $post_arr["type"] = "orders";

        return $this->query('data', $post_arr);


    }

    public function newsFeed()
    {
        $post_arr = array();

        return $this->query('newsFeed', $post_arr);

    }

    public function orderTypes()
    {
        $post_arr = array();
        return $this->query('orderTypes', $post_arr);

    }

    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    //////////////////////                      ////////////////////////////////////////
    /////////////            ACTION METHODS         ////////////////////////////////////
    /////////////////////                       ////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////

    public function refreshBalance($auth_id)
    {

        $post_arr = array();
        $post_arr["auth_id"] = $auth_id;

        return $this->query('refreshBalance', $post_arr);

    }

    public function addAlert($exchange_code, $exchange_market, $alert_price)
    {
        $post_arr = array();
        $post_arr["exch_code"] = $exchange_code;
        $post_arr["market_name"] = $exchange_market;
        $post_arr["alert_price"] = $alert_price;

        return $this->query('addAlert', $post_arr);

    }

    public function deleteAlert($delete_alert_id)
    {
        $post_arr = array();
        $post_arr["alert_id"] = $delete_alert_id;

        return $this->query('deleteAlert', $post_arr);

    }

    public function addOrder($order_auth_id, $order_mkt_id, $order_type_id, $order_quantity, $price_type_id = 3
    , $limit_price = 755, $order_exch_id=62)
    {
        $post_arr = array();
        $post_arr["auth_id"] = $order_auth_id;
        $post_arr["exch_id"] = $order_exch_id;
        $post_arr["mkt_id"] = $order_mkt_id;
        $post_arr["order_type_id"] = $order_type_id;
        $post_arr["price_type_id"] = $price_type_id;
        $post_arr["limit_price"] =$limit_price;
        $post_arr["order_quantity"] = $order_quantity;

        return $this->query('addOrder', $post_arr);


    }

    public function cancelOrder($cancel_order_id)
    {
        $post_arr = array();
        $post_arr["internal_order_id"] = $cancel_order_id;

        return $this->query('cancelOrder', $post_arr);


    }

    private function query($method, $post_arr)
    {

        $url = $this->endpoint.$method;

        $headers = array('X-API-KEY: ' . $this->coinigy_api_key,
                         'X-API-SECRET: ' . $this->coinigy_api_secret);


        // our curl handle (initialize if required)
        static $ch = null;
        if (is_null($ch)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; Coinigy App Client; '.php_uname('s').'; PHP/'.phpversion().')');
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_arr);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        $res = curl_exec($ch);

        if ($res === false)  {
            echo "CURL Failed - Check URL";
            return false;
        }

        $dec = json_decode($res, true);

        if (!$dec) {

            echo "Invalid JSON returned - Redirect to Login";
            return false;
        }

        return $dec["data"];

    }

    private function output_result($result)
    {
        if($result)
        {
            if(isset($result->error))
                $this->pre($result->error);
            elseif(isset($result))
                return $result;
        }
    }

    function array_combine_($keys, $values)
{
    $results = array();
    foreach ($keys as $i => $k) {
        $results[$k][] = $values[$i];
    }
    return    $results;
}


    private function pre($array) {
        echo "<pre>".print_r($array, true)."</pre>";
    }


}

$api_key = "LALALALALA";
$api_sec = "LALALALALALA";
$coinigy_client = new coinigy_api_client($api_key, $api_sec);
