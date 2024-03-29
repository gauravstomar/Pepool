<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Captcha
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Captcha_Base */
require_once 'Zend/Captcha/Base.php';

/** Zend_Service_ReCaptcha */
require_once 'Zend/Service/ReCaptcha.php';

/**
 * ReCaptcha adapter
 * 
 * Allows to insert captchas driven by ReCaptcha service
 * 
 * @see http://recaptcha.net/apidocs/captcha/
 *
 * @category   Zend
 * @package    Zend_Captcha
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: $
 */
class Zend_Captcha_ReCaptcha extends Zend_Captcha_Base 
{
    /**
     * Recaptcha public key
     *
     * @var string
     */
    protected $_pubkey;

    /**
     * Recaptcha private key
     *
     * @var string
     */
    protected $_privkey;
    
    /**@+
     * ReCaptcha Field names 
     * @var string
     */
    protected $_CHALLENGE = 'recaptcha_challenge_field';
    protected $_RESPONSE  = 'recaptcha_response_field';
    /**@-*/
     
    /**
     * Recaptcha service object
     *
     * @var Zend_Service_Recaptcha
     */
    protected $_service;

    /**
     * Parameters defined by the service
     * 
     * @var array
     */
    protected $_serviceParams = array();

    /**#@+
     * Error codes
     * @const string
     */
    const MISSING_VALUE = 'missingValue';
    const ERR_CAPTCHA   = 'errCaptcha';
    const BAD_CAPTCHA   = 'badCaptcha';
    /**#@-*/

    /**
     * Error messages
     * @var array
     */
    protected $_messageTemplates = array(
        self::MISSING_VALUE => 'Missing captcha fields',
        self::ERR_CAPTCHA   => 'Failed to validate captcha',
        self::BAD_CAPTCHA   => 'Captcha value is wrong: %value%',
    );
    
    /**
     * Retrieve ReCaptcha Private key
     *
     * @return string
     */
    public function getPrivkey() 
    {
        return $this->_privkey;
    }
    
    /**
     * Retrieve ReCaptcha Public key
     *
     * @return string
     */
    public function getPubkey() 
    {
        return $this->_pubkey;
    }
    
    /**
     * Set ReCaptcha Private key
     *
     * @param string $_privkey
     * @return Zend_Captcha_ReCaptcha
     */
    public function setPrivkey($privkey) 
    {
        $this->_privkey = $privkey;
        return $this;
    }
    
    /**
     * Set ReCaptcha public key
     *
     * @param string $_pubkey
     * @return Zend_Captcha_ReCaptcha
     */
    public function setPubkey($pubkey) 
    {
        $this->_pubkey = $pubkey;
        return $this;
    }
    
    /**
     * Constructor
     *
     * @param  array|Zend_Config $options 
     * @return void
     */
    public function __construct($options = null)
    {
        parent::__construct($options);

        $this->setService(new Zend_Service_ReCaptcha($this->getPubKey(), $this->getPrivKey()));
        $this->_serviceParams = $this->getService()->getParams();

        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }
        if (!empty($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set service object
     * 
     * @param  Zend_Service_ReCaptcha $service 
     * @return Zend_Captcha_ReCaptcha
     */
    public function setService(Zend_Service_ReCaptcha $service)
    {
        $this->_service = $service;
        return $this;
    }

    /**
     * Retrieve ReCaptcha service object
     * 
     * @return Zend_Service_ReCaptcha
     */
    public function getService()
    {
        return $this->_service;
    }

    /**
     * Set option
     *
     * If option is a service parameter, proxies to the service.
     * 
     * @param  string $key 
     * @param  mixed $value 
     * @return Zend_Captcha_ReCaptcha
     */
    public function setOption($key, $value)
    {
        $service = $this->getService();
        if (isset($this->_serviceParams[$key])) {
            $service->setParam($key, $value);
            return $this;
        }
        return parent::setOption($key, $value);
    }
    
    /**
     * Generate captcha
     *
     * @see Zend_Form_Captcha_Adapter::generate()
     * @return string
     */
    public function generate()
    {
        return "";
    }

    /**
     * Validate captcha
     *
     * @see    Zend_Validate_Interface::isValid()
     * @param  mixed $value
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
        if (empty($context[$this->_CHALLENGE]) || empty($context[$this->_RESPONSE])) {
            $this->_error(self::MISSING_VALUE);
            return false;
        }

        $service = $this->getService();
        
        $res = $service->verify($context[$this->_CHALLENGE], $context[$this->_RESPONSE]); 
        
        if (!$res) {
            $this->_error(self::ERR_CAPTCHA);
            return false;
        }
        
        if (!$res->isValid()) {
            $this->_error(self::BAD_CAPTCHA, $res->getErrorCode());
            $service->setParam('error', $res->getErrorCode());
            return false;
        }

        return true;
    }
    
    /**
     * Render captcha
     * 
     * @param  Zend_View $view 
     * @param  mixed $element 
     * @return string
     */
    public function render(Zend_View_Interface $view, $element = null)
    {
        return $this->getService()->getHTML();
    }
}
