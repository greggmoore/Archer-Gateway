<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author  Gregg Moore, blumoocreative.com
 * @package System\Cms\Modules\Changeme\Models
 * copyright Copyright (c) 2020, Blumoo Creative, LLC
 */

// ------------------------------------------------------------------------


class SoapClient {
	
	
	function __construct(string|null $wsdl , array $options = []){
    }
	
	public __call ( string $name , array $args ) : mixed
	public __doRequest ( string $request , string $location , string $action , int $version , bool $oneWay = false ) : string|null
	public __getCookies ( ) : array
	public __getFunctions ( ) : array|null
	public __getLastRequest ( ) : string|null
	public __getLastRequestHeaders ( ) : string|null
	public __getLastResponse ( ) : string|null
	public __getLastResponseHeaders ( ) : string|null
	public __getTypes ( ) : array|null
	public __setCookie ( string $name , string|null $value = null ) : void
	public __setLocation ( string $location = "" ) : string|null
	public __setSoapHeaders ( SoapHeader|array|null $headers = null ) : bool
	public __soapCall ( string $name , array $args , array|null $options = null , SoapHeader|array|null $inputHeaders = null , array &$outputHeaders = null ) : mixed

}
