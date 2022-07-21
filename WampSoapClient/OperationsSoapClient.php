<?php
function displayRequestResponse($soapClient)
{
    echo 'Request : <br/><xmp>',
    $soapClient->__getLastRequestHeaders(), $soapClient->__getLastRequest(),
    '</xmp>';
    echo 'Response : <br/><xmp>',
    $soapClient->__getLastResponseHeaders(), $soapClient->__getLastResponse(),
    '</xmp>';
}

include 'ProductSoap.php';
use App\Soap\ProductSoap;

include 'CommandSoap.php';
use \App\Soap\CommandSoap;


$soapClient = null;
try {

    ini_set("soap.wsdl_cache_enabled", "0");

    /*$opts = array(
        'http' => array(
            'user_agent' => 'PHPSoapClient',
			//'header' => 'Content-Type: text/xml'
        )
    );
    $context = stream_context_create($opts);*/

    $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_1,
        //'stream_context' => $context,
        'cache_wsdl' => WSDL_CACHE_NONE/*,
		'use' => SOAP_LITERAL,
		'style' => SOAP_DOCUMENT*/
    );

    $soapClient =  new \SoapClient('http://localhost:8000/soap?wsdl', $options);
    //header('Content-Type: text/xml');
    //$soapClient->__setSoapHeaders(new SoapHeader('Content-Type','text/xml'));

    $functions = $soapClient->__getFunctions();
    echo '<p>' . var_dump($functions) . '</p>';

    displayRequestResponse($soapClient);

    //header('Content-Type: text/xml');
    //$soapClient->__setSoapHeaders(new SoapHeader('Content-Type','text/xml'));

    
    //* getProductNameById
    /*     
    $product = new ProductSoap(1, ''); // créer produit sans nom
    echo '<p>' . var_dump($product) . '</p>';
    $result =  $soapClient->getProductNameById($product);
    echo '<p>' . var_dump($result) . '</p>'; // produit avec nom 
    */
    
    //* get_product_name_by_id
    $product = new ProductSoap(1, ''); // créer produit sans nom
    echo '<p>' . var_dump($product) . '</p>';
    $result =  $soapClient->get_product_name_by_id($product);
    echo '<p>' . var_dump($result) . '</p>'; // produit avec nom

    //* getUserCommands
    /* 
    $result =  $soapClient->getUserCommands(4); 
    echo '<p>' . var_dump($result) . '</p>'; // Commandes de l'user 4
    */

    //* get_user_commands
    $result =  $soapClient->get_user_commands(4); 
    echo '<p>' . var_dump($result) . '</p>'; // Commandes de l'user 4

    
} catch (SoapFault $fault) {
    displayRequestResponse($soapClient);
    // <xmp> tag displays xml output in html
    echo '<p><br/> Error Message : <p/>';
    echo '<p>' . $fault->getMessage() . '</p>';
    echo '<p>' . $fault->getTraceAsString() . '</p>';
    echo '<p>' . var_dump($fault) . '</p>';
}
