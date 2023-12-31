<?php
class BaseController
{
    /** 
* __call magic method. 
*/
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
    /** 
* Get URI elements. 
* 
* @return array 
*/
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }
    /** 
* Get querystring params. 
* 
* @return array 
*/
    protected function getQueryStringParams()
    {
       return $_GET;
    }
    /** 
* Send API output. 
* 
* @param mixed $data 
* @param string $httpHeader 
*/
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
              }
              header('Access-Control-Allow-Origin: *'); // Replace * with the specific origin you want to allow.
              header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
              header('Access-Control-Allow-Headers: Content-Type');
             
        }
        echo $data;
        exit;
    }
}