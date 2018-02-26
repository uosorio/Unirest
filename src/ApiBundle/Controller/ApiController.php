<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Unirest;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $prueba=1;
          return $this->render('api/apiresult1.html.twig', array(
            'res' => $prueba
        ));
    }
    /**
     * @Route("/Api")
     */
    public function Api2Action()
    {
        
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
    
        $headers = array('Accept' => 'application/json');
        $query = array('q' => 'Frank sinatra', 'type' => 'track');

        $response = Unirest\Request::get('http://api.sbif.cl/api-sbifv3/recursos_api/uf/2018/01?apikey=d8093171162117c0c6e8da895b00978d4e2b6a0e&formato=json',$headers);
        
        $response1= array($response->body);

        $json1=json_encode($response1);
        $json = json_decode($json1,true);
     
        $jsonContent = $serializer->serialize(array("data"=>$json[0]["UFs"]), 'json');

         return new response($jsonContent);
      
     }
}
