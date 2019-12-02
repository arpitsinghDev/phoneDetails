<?php 
class flipkartApi {
 
  private static $affiliateID;

  private static $token;

  private static $timeout = 45;

  //Set filpkart affilate id and token at the time of class init.

   public function __construct($affiliateID, $token) {
     self::$affiliateID = $affiliateID;
     self::$token = $token;
    }


   public static function getData($url, $dataType) {

       try {

         if(!isset($url) && !empty($url)) {
           throw new exception("URL is not available.");
         }

         if(!isset($dataType) && !empty($dataType)) {
           throw new exception("Please set datatype json or xml");
         }

         if (!function_exists('curl_init')){
              throw new exception("Curl is not available.");
         }
          // Set header to make authentication
        $headers = array(
            'Cache-Control: no-cache',
            'Fk-Affiliate-Id: '.self::$affiliateID,
            'Fk-Affiliate-Token: '.self::$token
            );

        $cObj = curl_init();
        curl_setopt($cObj, CURLOPT_URL, $url);
        curl_setopt($cObj, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($cObj, CURLOPT_TIMEOUT, self::$timeout);
        curl_setopt($cObj, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($cObj,CURLOPT_SSL_VERIFYPEER,false);
        $result = curl_exec($cObj);
        curl_close($cObj);
           // render result as per format.
           if($dataType == 'json') {
             return $result ? json_decode($result, true) : false;
           } else if($dataType == 'xml') {
              return $result ? new SimpleXMLElement($result) : false;
           } else {
             return false;
           }

       }  catch (Exception $e) {
          return $e->getMessage();
       }
    }
}
$affiliateID = 'arpitsing5';
$token = 'b1b88e8838d84421b15f841038787f5b';
$fkObj = new flipkartApi($affiliateID, $token);
// queryData('Samsung Galaxy j7 nxt');

/*
function queryData($qe){ 
  $qu=strtolower($qe);
   $datalist=array();
   $data_in='';
    $qURL='https://affiliate-api.flipkart.net/affiliate/1.0/search.json?query='.urlencode($qu).'+mobiles&resultCount=10';
    echo "<h4>".$qURL."</h4>";
    $mobil_result=$GLOBALS['fkObj']->getData($qURL,'json');
    //print_r($mobil_result);
    //echo urlencode($qu);
    for ($i=0; $i <count($mobil_result['products']); $i++) { 
    # code...
    $temp=$mobil_result['products'][$i]['productBaseInfoV1']['title'];
    $myward= rtrim($temp,substr($temp,strpos("$temp","(")));
    //echo strtolower($temp).'<br>'.$qu;
    if(strlen($qu)== similar_text($qu,strtolower($myward)) && empty($data_in)){
      //echo 'yeee <br>';
      array_push($datalist,[
      'm_name'=>$temp,
      'm_img'=>$mobil_result['products'][$i]['productBaseInfoV1']['imageUrls']['400x400'],
      'm_formore'=>$mobil_result['products'][$i]['productBaseInfoV1']['productFamily'],
      'm_flipkardprice'=>$mobil_result['products'][$i]['productBaseInfoV1']['flipkartSellingPrice'],
      'm_prodacturl'=>$mobil_result['products'][$i]['productBaseInfoV1']['productUrl'],
      'm_availeble'=>$mobil_result['products'][$i]['productBaseInfoV1']['codAvailable'],
      'm_discount'=>$mobil_result['products'][$i]['productBaseInfoV1']['discountPercentage']
      ]);
      $data_in='yes';
    }else{
      //echo 'opp <br>';
      array_push($datalist,[
      'name'=>$temp,
      'img'=>$mobil_result['products'][$i]['productBaseInfoV1']['imageUrls']['400x400'],
      'formore'=>$mobil_result['products'][$i]['productBaseInfoV1']['productFamily'],
      'flipkardprice'=>$mobil_result['products'][$i]['productBaseInfoV1']['flipkartSellingPrice'],
      'prodacturl'=>$mobil_result['products'][$i]['productBaseInfoV1']['productUrl'],
      'availeble'=>$mobil_result['products'][$i]['productBaseInfoV1']['codAvailable'],
      'discount'=>$mobil_result['products'][$i]['productBaseInfoV1']['discountPercentage']
      ]);
    }
    }
   echo json_encode($datalist);
   }
queryData('samsung galaxy j7');

function forimg_price(){
$mytest='https://affiliate-api.flipkart.net/affiliate/1.0/feeds/arpitsing5/category/tyy-4io.json?expiresAt=1574037908906&sig=49a07e809f9ef8fca9d268fbcdf8fefa';
//$mobil_result=$fkObj->getData($for_mobile_url,'json');
$mobi=flipkartApi::getData($mytest,'json');
$nextmobo=$mobi['nextUrl'];
$me=$mobi['products'];
print_r($me);
  for ($i=0; $i < 500; $i++) { 
    # code...
    echo $me[$i];
    echo '<img src='.$me[$i]['productBaseInfoV1']['imageUrls']['200x200'].'>';
  }
}
//var_dump($mobil_result);
*/
?>