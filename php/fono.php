<?php
	include_once("fonoapi-v1.php");
	include_once('resapi.php');
	$apiKey = "ff5518d3668f76a42ca6f96977b082a2e350aec508b9f916"; 
	$fonoapi = fonoApi::init($apiKey);
    if(isset($_POST['opdata'])){
		if(empty($_POST['opdata'])){
			echo'fill box';
		}else{
			$rqu_data=$_POST['opdata'];
			mydata($rqu_data);
		}
	}
	if(isset($_POST['opone']) && isset($_POST['optwo'])){
		if(!empty($_POST['opone']) && !empty($_POST['optwo'])){
			$opo=$_POST['opone'];
			$opt=$_POST['optwo'];
			comdata($opo,$opt) ;
		}else{
			echo 'fill all two box';
		}
	}
	if(isset($_POST['loaded'])){
		showLatestD();
	}
	//for ima and price
	if(isset($_POST['pname'])){
		 queryData($_POST['pname']);
	}
	if(isset($_POST['prename'])){
		queryData($_POST['prename']);
   }
	function comdata($o,$t){
		try {
			$res_o = $GLOBALS['fonoapi']::getDevice($o); 
			$res_t = $GLOBALS['fonoapi']::getDevice($t); 
			//echo'<pre>';
			$d_data1=[];
			$d_data2=[];
            foreach($res_o[0] as $mobilefea=>$value){
				array_push($d_data1,[
					 $mobilefea=>$value
				]);
			}
			foreach($res_t[0] as $mobilefea=>$value){
				array_push($d_data2,[
					$mobilefea=>$value
				]);
			}
			
			echo json_encode(array('d1'=>$d_data1,'d2'=>$d_data2));
			} catch (Exception $e){
			echo "ERROR : " . $e->getMessage();
		}
	}
	function mydata($ph){
		try {
			$res = $GLOBALS['fonoapi']::getDevice($ph); 
			 echo'<pre>';
            foreach($res[0] as $mobilefea=>$value){
				echo '<tr><td>'.$mobilefea.'</td><td>'.$value.'</td></tr>';
					//print_r($value);
			}
			//queryData($ph);
			//	print_r($res);
			// foreach($res as $mobilefea){
			// 	if($mobilefea->status!='Discontinued'){
			// 		echo "<td>'".$mobilefea->DeviceName."',</td>";
			// 	}
			// }
		} catch (Exception $e) {
			echo "ERROR : " . $e->getMessage();
		}
	}
	function showLatestD(){
		$res=$GLOBALS['fonoapi']->latestData("https://fonoapi.freshpixl.com/v1/getlatest");
		//print_r($res);
		foreach($res as $mobilefea){
			if($mobilefea->status!='Discontinued'){
				$name[]= $mobilefea->DeviceName;
			}
		}
		//print_r($name);
		echo json_encode($name);
	}
	function queryData($qe){ 
		$qu=strtolower($qe);
		 $datalist=array();
		 $data_in='';
		  $qURL='https://affiliate-api.flipkart.net/affiliate/1.0/search.json?query='.urlencode($qu).'&resultCount=10';
		  $mobil_result=$GLOBALS['fkObj']->getData($qURL,'json');
		  //print_r($mobil_result);
		  //echo urlencode($qu);
		  for ($i=0; $i <count($mobil_result['products']); $i++) { 
			# code...
			$temp=$mobil_result['products'][$i]['productBaseInfoV1']['title'];
			$myward= str_replace(substr($temp,strpos("$temp","(")),"",$temp);
			//echo strtolower($myward).'===='.str_replace(substr($temp,strpos("$temp","(")),"",$temp).'<br>';
			if(strlen($qu)== similar_text($qu,strtolower($myward)) && empty($data_in)){
			  //echo 'yeee <br>';
			  array_push($datalist,[
				'm_name'=>$temp,
				'm_img'=>$mobil_result['products'][$i]['productBaseInfoV1']['imageUrls']['400x400'],
				'm_formore'=>$mobil_result['products'][$i]['productBaseInfoV1']['productFamily'],
				'm_flipkardprice'=>$mobil_result['products'][$i]['productBaseInfoV1']['flipkartSellingPrice'],
				'm_producturl'=>$mobil_result['products'][$i]['productBaseInfoV1']['productUrl'],
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
				'producturl'=>$mobil_result['products'][$i]['productBaseInfoV1']['productUrl'],
				'availeble'=>$mobil_result['products'][$i]['productBaseInfoV1']['codAvailable'],
				'discount'=>$mobil_result['products'][$i]['productBaseInfoV1']['discountPercentage']
			  ]);
			}
		  }
		 echo json_encode($datalist);
	   }
	  // showLatestD();
	  // echo'<br>';
	 //  queryData("redmi 8a");
	  // queryData('Sony Xperia SL');
?>