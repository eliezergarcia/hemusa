<?php
$resultado='';
$fecha_tc='';
$tc='';
$client = new SoapClient(null, array('location' => 'http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL',
                            'uri'      => 'http://DgieWSWeb/DgieWS?WSDL',
                            'encoding' => 'ISO-8859-1',
                            'trace'    => 1) );
try
{
   $resultado = $client->tiposDeCambioBanxico();
}
catch (SoapFault $exception)
{
}
if(!empty($resultado))
{
   $dom = new DomDocument();
   $dom->loadXML($resultado);
   $xmlDatos = $dom->getElementsByTagName( "Obs" );
   if($xmlDatos->length>1)
   {
       $item = $xmlDatos->item(1);
       // $fecha_tc = ffecha($item->getAttribute('TIME_PERIOD'));
       $tc = $item->getAttribute('OBS_VALUE');
   }
}
echo $tc;
?>
