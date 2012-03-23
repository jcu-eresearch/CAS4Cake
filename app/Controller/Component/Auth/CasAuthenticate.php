<?php

App::uses('BaseAuthenticate', 'Controller/Component/Auth');
App::import('Vendor', 'CAS/CAS');

class CasAuthenticate /* extends BaseAuthenticate */ {
    private $_Collection = NULL;

    function __construct($collection, $settings) {
        $this->_Collection = $collection;

        // Uncomment to enable debugging
        phpCAS::setDebug('/Users/tom/Sites/cake/app/tmp/phpcas.log.txt');

        // Initialize phpCAS
        phpCAS::client(CAS_VERSION_2_0,
                       Configure::read('CAS.hostname'),
                       Configure::read('CAS.port'),
                       Configure::read('CAS.uri'));

        // For production use set the CA certificate that is the issuer of the cert
        // on the CAS server and uncomment the line below
        // TODO: enable this
        // phpCAS::setCasServerCACert(Configure::read('CAS.cert_path'));

        // For quick testing you can disable SSL validation of the CAS server.
        // THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
        // VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
        // TODO: disable this
        phpCAS::setNoCasServerValidation();

        // single sign out (not sure if we want this)
        //phpCAS::handleLogoutRequests(true);
    }

    public function authenticate(CakeRequest $request, CakeResponse $response) {
        // force CAS authentication
        phpCAS::forceAuthentication();

        //the following is possibly from an old version of cake
        //$model =& $this->getModel();
        //$controller->data[$model->alias][$this->fields['username']] = phpCAS::getUser(); 
        //$controller->data[$model->alias][$this->fields['password']] = ''; 

        // at this step, the user has been authenticated by the CAS server
        // and the user's login name can be read with phpCAS::getUser().
        return array('username' => phpCAS::getUser());
    }

    public function getUser($request) {
        return FALSE;
    }

    public function logout($user) {
        CakeSession::start();
        //echo '<pre>';
        //debug_print_backtrace();
        //echo '</pre>';
        //pr('sess name:' . session_name());
        //pr($_SESSION);

        if(phpCAS::isAuthenticated()){
          //will redirect browser to cas logout url
          //after logout, will redirect back to the logout action here
          phpCAS::logout(array('url'=>Router::url(null, true)));
        } else {
          //not logged in
          //this will happen when CAS has just logged out and has redirected the client
            //back to here.
        }
    }
}
