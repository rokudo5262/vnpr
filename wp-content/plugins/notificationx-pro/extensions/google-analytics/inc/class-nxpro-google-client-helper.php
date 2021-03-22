<?php
// if( ! class_exists( 'NxPro_Google_Client' ) ) {
//     require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/vendor/google/apiclient/src/Google/Client.php';
// }
use \NxPro_Google_Client as GoogleClient;
class NotificationXPro_Google_Client{

    public $client;
    private static $instance = null;
    // Developer Made
    // public $client_id = '1050489600494-ra373okj96upq19575o33alm8aqlj0i9.apps.googleusercontent.com';
    // public $client_secret = 'W5bNchxKQVoEMYxJ82myiGoU';
    // public $redirect_uri = 'https://dev.notificationx.com/api.php';
    // Official Made
    public $client_id = '928694219401-b9njpjh55ha3vgepku2269kas5kd9a5c.apps.googleusercontent.com';
    public $client_secret = 'dFIdF-7Sqn8yCBsAmxLBsOcr';
    public $redirect_uri = 'https://dev.notificationx.com/api.php';

    public function __construct()
    {
        $this->set_user_credentials();
        $this->client = $this->getClient();

    }

    public function set_user_credentials()
    {
        $settings = NotificationX_DB::get_settings();
        if(!empty($settings['ga_redirect_uri']) && !empty($settings['ga_client_id']) && !empty($settings['ga_client_secret'])){
            $this->client_id = $settings['ga_client_id'];
            $this->client_secret = $settings['ga_client_secret'];
            $this->redirect_uri = $settings['ga_redirect_uri'];
        }
    }

    public static function getInstance()
    {
        if(self::$instance == null){
            self::$instance = new NotificationXPro_Google_Client();
        }
        return self::$instance;
    }

    /**
     * Get instance of google client
     * @return NxPro_Google_Client
     */
    public function getClient()
    {
        if(!empty($this->client)){
            return $this->client;
        }
        $googleClient = new GoogleClient();
        $googleClient->setApplicationName ( 'NotificationX' );
        $googleClient->setScopes ( array('https://www.googleapis.com/auth/analytics.readonly') );
        $googleClient->setClientId($this->client_id);
        $googleClient->setClientSecret($this->client_secret);
        $googleClient->setAccessType ( 'offline' );
        $googleClient->setRedirectUri($this->redirect_uri);
        $googleClient->setState(admin_url('admin.php'));
        $googleClient->setApprovalPrompt('force');
        return $googleClient;
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getTokenWithAuthCode($code){
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        return $token;
    }
    /**
     * set access token for use
     * if token expired set a new one
     * @param array $token
     * @return mixed
     */
    public function setAccessToken($token){
        try{
            if($this->client->isAccessTokenExpired()){
                $token = $this->_updateToken();
            }
            $this->client->setAccessToken($token);
            return true;
        }catch(\Exception $e){
            return 'Set access token failed. Details: '.$e->getMessage();
        }
    }
    public function revokeToken(){
        return $this->client->revokeToken();
    }
    /**
     * get access token
     * @return mixed
     */

    public function getToken(){
        return $this->client->getAccessToken();
    }

    public function getRedirectUri()
    {
        return $this->client->getRedirectUri();
    }
    /**
     * update token with refresh code
     * @return array|bool
     */
    private function _updateToken(){
        $pa_options = get_option('nx_pa_settings');
        if(!empty($pa_options['token_info']['refresh_token'])){
            $new_token = $this->client->refreshToken($pa_options['token_info']['refresh_token']);
            if(is_array($new_token)){
                $pa_options['token_info'] = $new_token;
                update_option('nx_pa_settings',$pa_options);
                return $new_token;
            }
        }
        return false;
    }

}
