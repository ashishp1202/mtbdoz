<?php 
session_start();
define('MTBDOZ_API_URL', 'https://www.synergy-travel.com');
class tourLibrary
{

	//create tour
	function login(){
		$response = new stdClass();
		$url = MTBDOZ_API_URL.'/ride-back/user/login';
		$data = array('email' => $_REQUEST['email'], 'password' => $_REQUEST['password']);
		foreach($data as $key => $field){
			if(empty($field)){
				$error_block[] = $key.' field cannot be blank';
			}
		}
		if(!empty($error_block)){
			$response->data =  $error_block;
			$response->status = false;
			
		} else {
			$result = $this->sendRequest($url, 'GET', $data);
			if(!empty($result)){
				$token = $result->token;
				$_SESSION['rideTourUserData'] = (object) array('token' => urlencode($token), 'detail' => $result->user);	
				$response->data = array('message' => 'User Loggedin successfully', 'data' => $result);
				$response->status = true;
			} else {
				$response->data = array('message' => 'fields not matched');
				$response->status = false;
			}
		}
		return $response;
		#$this->send($response);
	}
	function tourlist(){
		$response = new stdClass();
		
		$url = MTBDOZ_API_URL.'/ride-back/tour/list/';
		$is_admin = $this->checkIsAdmin();
		if($is_admin == 'success'){
			$request = array('status'=>'ACTIVE,INACTIVE');
		}
		else{
			$request = array('status'=>'ACTIVE');
		}
		$result = $this->sendRequest($url,'GET', $request);
		if($result->tours){
			$response->data = $result->tours;
			$response->status = true;
		} else {
			$response->data = array('message' => 'Result not found');
			$response->status = false;
		}
		return $result;
		#$this->send($response);
	}


    function searchTours($totalRecords = null)
	{
		$response = new stdClass();
		$url = MTBDOZ_API_URL.'/ride-back/tour/list';
		$data = array();
		$currency = empty($_SESSION['currentCurrency']) ? 'USD' : $_SESSION['currentCurrency'];
        $pageNo = $_REQUEST['pageNo'];
        if(empty($pageNo)){
            $_SESSION['totalResultSession'] = false;
        }
        $totalResultSession = empty($_SESSION['totalResultSession']) ? false : $_SESSION['totalResultSession'];
		//echo $_REQUEST['pageSize'];
		if(!empty($_REQUEST['pageSize']))
		{
			$pageSize = $_REQUEST['pageSize'];
		}
		else{
			$pageSize = 2;
		}
        if(!empty($pageNo) && !empty($totalResultSession)){
            if($pageNo == 1){
                $data['pageNo'] = 0;
                $data['pageSize'] = $pageSize;
            }
            if($pageNo > 1){
                $nextLog = ($pageNo * $pageSize);
                $prevLog = $nextLog - $pageSize;
                $data['pageNo'] = $prevLog;
                $data['pageSize'] = $pageSize;
            }
            $data['pageNo'] = $pageNo;
        }
		
		$data['currencyCode'] = $currency;
		if(!empty($_REQUEST['tourType'])){
			$data['tourType'] = $_REQUEST['tourType'];
		}
		if(!empty($_REQUEST['endPoint'])){
			$data['destination'] = urlencode(trim($_REQUEST['endPoint']));
		}
		//echo $data['destination']; exit();

        if(!empty($_REQUEST['selecteddate'])){
            $data['startDate'] = $_REQUEST['selecteddate'];
            $data['endDate'] = $_REQUEST['selecteddate'];
        }

        if(!empty( $_REQUEST['sortby'] )){
			$sorted = explode('-',$_REQUEST['sortby']);
			$orderType = $sorted[0];
			$order = $sorted[1];
			$data['orderType'] = $orderType;
			$data['order'] = $order;
		} else {
			$data['orderType'] = 'ratingSum';
			$data['order'] = 'desc';
		}

        if(empty($data['destination'])){

            if(array_key_exists('recentviews', $_COOKIE)) {
                $recentviews = $_COOKIE['recentviews'];
                if(!empty($recentviews)){
                    $recentviews = stripslashes($recentviews);
                    $recentviews = json_decode($recentviews);
                } else {
                    $recentviews = null;
                }
            } else {
                $recentviews = null;
            }

            if(!empty($recentviews) && !isset($pageNo)){
                $data = $recentviews;
            }
        }
        $result = $this->sendRequest($url,'GET', $data);
        $checkRecords = $result->tours;
        if(!empty($checkRecords)){
            $this->setSearchCookie($data);
            if(empty($_SESSION['totalResultSession'])){
                $_SESSION['totalResultSession'] = count($checkRecords);
            }
        }
	 return $result;
		
	}
    function setSearchCookie($data){

        // add the value to the array and serialize

        $cookie = json_encode($data);

        // save the cookie
        $timeout = time() + 60 * 60 * 24 * 7;
        setcookie('recentviews', $cookie, $timeout);

    }

	function getToursByOperatorId(){
		$userdata = $_SESSION['rideTourUserData'];
		$userdetail = $userdata->detail;
		$operatorId = $userdetail->id;
		$url = MTBDOZ_API_URL.'/ride-back/tour/list';
		$result = $this->sendJsonRequest($url,'GET',array('operatorId' => $operatorId));
		return $result;
	}
	
	function tour_detail($tour_id){
		$response = new stdClass();
		//$tour_id=$_REQUEST['id'];
		$currencyCode = empty($_SESSION['currentCurrency']) ? 'USD' : $_SESSION['currentCurrency'];
		$url = MTBDOZ_API_URL.'/ride-back/tour/'.$tour_id.'/details';

		$result = $this->sendRequest($url,'GET',array('currencyCode'=> $currencyCode));
		
		
		return $result;
		#$this->send($response);
	}
	function getTourById($tourId){
		$url = MTBDOZ_API_URL.'/ride-back/tour/'.$tourId.'/details';
		$result = $this->sendJsonRequest($url,'GET',array());
		return $result;
	}
	
	
	
	function createuser(){
	
		$url = MTBDOZ_API_URL.'/ride-back/tour/operator/create';
		$data = array("name"=> $_REQUEST['user_name'], "city" => $_REQUEST['city'], "state" => $_REQUEST['state'], "country" => $_REQUEST['country'], "poc" => $_REQUEST['poc'], "website" => $_REQUEST['website'], "phone" => $_REQUEST['phone'], "mobile" => $_REQUEST['mobile'], "email" => $_REQUEST['user_email'], "zipcode" => $_REQUEST['zipcode'], "address" => $_REQUEST['address'], "password" => $_REQUEST['user_password']);
		
		//print_r($data);
		$result = $this->sendRequest($url,'POST', $data);
		//print_r($result);
		return $result;
	
	}
	
	function book()
	{
		$response = new stdClass();
		$url = MTBDOZ_API_URL.'/ride-back/tour/bookpost';
		$data = array('currency' => $_REQUEST['currency'],'leadEmail' => $_REQUEST['lead_email'], 'tourId' => (int) $_REQUEST['tour_id'],  'leadName' => $_REQUEST['user_name'], 'sapId' => $_REQUEST['sapid'], 'status' => $_REQUEST['status'], 'bookingDate' => date('yyyy-MM-dd'));
		
	
	$result = $this->sendBookRequest($url,'POST', $data);
	/* 	print_r($result);
		die; */
	return $result;
	
	}
	
	function forgotpassword()
	{
	$response = new stdClass();
	$url = MTBDOZ_API_URL.'/ride-back/user/forgotpassword';
	$data = array('email' => $_REQUEST['email'],);
	$result = $this->sendRequest($url, 'GET', $data);
	return $result;	
	}
	
	function delete_tour()
	{	
		 $id = $_REQUEST['id'];
		 $user = $_REQUEST['userhash'];
	$response = new stdClass();
	$url = MTBDOZ_API_URL.'/ride-back/tour/'.$id.'/delete?userHash='.$user.'';
	//print_r($url);
		
	$result = $this->sendRequest($url,'POST',array());
		
		print_r($result);
		die;
	
	}
	function updateOperator(){
        $userdata = $_SESSION['rideTourUserData'];
        $operatorRequest = $_REQUEST['operator'];
        $operatorOpt = $_REQUEST['operatoropt'];

        $error = false;
        if(!empty($operatorOpt['oldpassword']) && !empty($operatorOpt['newpassword']) && !empty($operatorOpt['confirmpassword'])){
            if(($userdata->detail->password == $operatorOpt['oldpassword']) && ($operatorOpt['newpassword'] == $operatorOpt['confirmpassword'] )){
                $operatorRequest['password'] = $operatorOpt['newpassword'];

            } else {
                $error = true;
            }
        }
		//echo "<pre>";print_r($operatorRequest); exit();
        $operatorId = $userdata->detail->id;
		$token = $userdata->token;
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/operator/%d/update?userHash=%s',$operatorId, $token);		
		$result = $this->sendJsonRequest($url,'POST',$operatorRequest);
        if($error == true){
            $result->status = false;
            $result->data = "Password fields not matched. Please try again.";
        }
		return $result;
	}
	
	function createTour(){
		$currency = empty($_SESSION['currentCurrency']) ? 'USD' : $_SESSION['currentCurrency'];
		$tourInfo = array(
			"name" => $_REQUEST['tourname'],
			"city" => $_REQUEST['city'],
			"state" => $_REQUEST['state'],
			"country" => $_REQUEST['country'],
			"price" => -1/* $_REQUEST['price'] */,
			"title" => $_REQUEST['description'],
			"description" => $_REQUEST['message'],
			"startPoint" => $_REQUEST['start_point'],
			"endPoint" => $_REQUEST['end_point'],
			"days" => $_REQUEST['days'],
			"lengthType" => 'KM'/* $_REQUEST['length_type'] */,
			"lengthValue" => -1/* $_REQUEST['length_value'] */,
			"minParticipates" => $_REQUEST['min_participates'],
			"maxParticipates" => $_REQUEST['max_participates'],
			"tourType" => 'ALL_MOUNTAIN',
			"tourTypes" => $_REQUEST['tour_type'],
			"mealPlan" => $_REQUEST['meal_plan'],
			"minAge" => $_REQUEST['minage'],
			"level" => $_REQUEST['level'],
			"guidedTour" => $_REQUEST['guided'],
			"currency" => $currency,
			"hiredBikes" => $_REQUEST['hired_bikes']
		);
		$countGuided = count($tourInfo['guidedTour']);
		if($countGuided > 1){
			$tourInfo['guidedTour'] = 'GUIDED_AND_NOT_GUIDED';
		} else{
			$tourInfo['guidedTour'] = $tourInfo['guidedTour'][0];
		}
		
		
		$userdata = $_SESSION['rideTourUserData'];
		$token = $userdata->token;
		$url = MTBDOZ_API_URL.'/ride-back/tour/create?userHash='.$token;
		$response = $this->sendJsonRequest($url, 'POST', $tourInfo);
		
		if($response->status == true){
			$tourId = $response->data->id;

			if(!empty($_FILES['tour_image'])){
				$countImages = count($_FILES['tour_image']['tmp_name']);
				$imageFiles = $_FILES['tour_image'];
				$imageData = array();
				for($i = 0; $i < $countImages; $i++ ){
					$imageData[$i] = array('name' => $imageFiles['name'][$i], 'tmp_name' => $imageFiles['tmp_name'][$i], 'size' => $imageFiles['size'][$i]);  
				}
				foreach($imageData as $item){
					$filedata = array('name' => $item['name'], 'tmp_name' => $item['tmp_name'], 'size' => $item['size'] );
					$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/image/upload?userHash=%s', $tourId, $token);
					$this->uploadFile($url, $filedata);
				}
					
			}
			if(!empty($_FILES['tour_video'])){
				$countVideos = count($_FILES['tour_video']['tmp_name']);
				$videoFiles = $_FILES['tour_video'];
				$videoData = array();
				for($i = 0; $i < $countVideos; $i++ ){
					$videoData[$i] = array('name' => $videoFiles['name'][$i], 'tmp_name' => $videoFiles['tmp_name'][$i], 'size' => $videoFiles['size'][$i]);  
				}
				foreach($videoData as $item){
					$filedata = array('name' => $item['name'], 'tmp_name' => $item['tmp_name'], 'size' => $item['size'] );
					$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/video/create?userHash=%s', $tourId, $token);
					$this->uploadFile($url, $filedata, 'video');
				}
			}
		}
		return $response;
	}
	
	function editTour(){
		//echo "<pre>"; print_r($_REQUEST);exit();
		$tour_types = array();
		if(isset($_REQUEST['CROSS_COUNTRY']))
			array_push($tour_types,$_REQUEST['CROSS_COUNTRY']);
		if(isset($_REQUEST['ALL_MOUNTAIN']))
			array_push($tour_types,$_REQUEST['ALL_MOUNTAIN']);
		if(isset($_REQUEST['DOWNHILL']))
			array_push($tour_types,$_REQUEST['DOWNHILL']);
		$tourInfo = array(
			"name" => $_REQUEST['tourname'],
			"city" => $_REQUEST['city'],
			"state" => $_REQUEST['state'],
			"country" => $_REQUEST['country'],
			"price" => $_REQUEST['price'],
			"title" => $_REQUEST['description'],
			"description" => $_REQUEST['message'],
			"startPoint" => $_REQUEST['start_point'],
			"endPoint" => $_REQUEST['end_point'],
			"days" => $_REQUEST['days'],
			"lengthType" => $_REQUEST['length_type'],
			"lengthValue" => $_REQUEST['length_value'],
			"minParticipates" => $_REQUEST['min_participates'],
			"maxParticipates" => $_REQUEST['max_participates'],
			"tourType" => 'CROSS_COUNTRY',
			//"tourTypes" => $_REQUEST['tour_type'],
			"tourTypes" => $tour_types,
			"mealPlan" => $_REQUEST['meal_plan'],
			"minAge" => $_REQUEST['minage'],
			"level" => $_REQUEST['level'],
			"guidedTour" => $_REQUEST['guided'],
			"currency" => $_REQUEST['currency'],
			"status" => $_REQUEST['tour_status'],
			"hiredBikes" => $_REQUEST['hired_bikes']
		);
		
		$countGuided = count($tourInfo['guidedTour']);
		if($countGuided > 1){
			$tourInfo['guidedTour'] = 'GUIDED_AND_NOT_GUIDED';
		} else{
			$tourInfo['guidedTour'] = $tourInfo['guidedTour'][0];
		}
		//echo "<pre>";print_r($tourInfo); exit();
		$tourId = $_REQUEST['tourId'];
	
		$userdata = $_SESSION['rideTourUserData'];
		$token = $userdata->token;
		$url = MTBDOZ_API_URL.'/ride-back/tour/'.$tourId.'/update?userHash='.$token;	
		$response = $this->sendJsonRequest($url, 'POST', $tourInfo);
		if(!empty($_FILES['tour_image'])){
			$countImages = count($_FILES['tour_image']['tmp_name']);
			$imageFiles = $_FILES['tour_image'];
			$imageData = array();
			for($i = 0; $i < $countImages; $i++ ){
				$imageData[$i] = array('name' => $imageFiles['name'][$i], 'tmp_name' => $imageFiles['tmp_name'][$i], 'size' => $imageFiles['size'][$i]);  
			}
			foreach($imageData as $item){
				$filedata = array('name' => $item['name'], 'tmp_name' => $item['tmp_name'], 'size' => $item['size'] );
				$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/image/upload?userHash=%s', $tourId, $token);
				$this->uploadFile($url, $filedata);
			}
				
		}
		
/* 		if(!empty($_FILES['tour_video'])){
			$countVideos = count($_FILES['tour_video']['tmp_name']);
			$videoFiles = $_FILES['tour_video'];
			$videoData = array();
			for($i = 0; $i < $countVideos; $i++ ){
				$videoData[$i] = array('name' => $videoFiles['name'][$i], 'tmp_name' => $videoFiles['tmp_name'][$i], 'size' => $videoFiles['size'][$i]);  
			}
			foreach($videoData as $item){
				$filedata = array('name' => $item['name'], 'tmp_name' => $item['tmp_name'], 'size' => $item['size'] );
				$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/video/create?userHash=%s', $tourId, $token);
				$this->uploadFile($url, $filedata, 'video');
			}
		} */
		if(!empty($_REQUEST['tour_youtube_video'])){
			$videoPath = $_REQUEST['tour_youtube_video'];
			$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/video/create?userHash=%s&videoPath=%s', $tourId, $token, $videoPath );
			$result = $this->sendJsonRequest($url, 'POST', array());
		}

		return $response;
	}
	function deleteTour($tourId){
		$userdata = $_SESSION['rideTourUserData'];
		$token = $userdata->token;
		$url = MTBDOZ_API_URL.'/ride-back/tour/'.$tourId.'/delete?userHash='.$token;
		
		
		$response = $this->sendJsonRequest($url, 'POST', array());
		return $response;
	}
	
	function delete_operator()
	{
	 $user = $_REQUEST['userhash'];
	$response = new stdClass();
	$url = MTBDOZ_API_URL.'/ride-back/tour/operator/delete?userHash='.$user.'';
	//print_r($url);
		
		
	$result = $this->sendRequest($url,'POST',array());
		
		print_r($result);
		die;
	
	}
	
	public function uploadTourImage(){
		$filedata = array('name' => $_FILES['tour_image']['name'], 'tmp_name' => $_FILES['tour_image']['tmp_name'], 'size' => $_FILES['tour_image']['size'] );
		$tourId = $_REQUEST['id'];
		$userdata = $_SESSION['rideTourUserData'];
		$userToken = $userdata->token;
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/image/upload?userHash=%s', $tourId, $userToken);
		$response = $this->uploadFile($url, $filedata);
		return $response;
		
	}
	public function getTourImages($tourId){
		$userdata = $_SESSION['rideTourUserData'];
		$request = array('userHash' => $userdata->token);
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/images', $tourId);
		
		$response = $this->sendJsonRequest($url, 'GET', $request);
		return $response;
	}
	
	function deleteTourImage(){
		$userdata = $_SESSION['rideTourUserData'];
		
		$tourId = $_REQUEST['tourId'];
		$imageId = $_REQUEST['imageId'];
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/images/delete/%d?userHash=%s', $tourId, $imageId, $userdata->token);
		$response = $this->sendJsonRequest($url, 'POST', null);
		return $response;
	}
	
	/*Set tour default image*/
	function defaultTourImage(){
		$userdata = $_SESSION['rideTourUserData'];
		
		$tourId = $_REQUEST['tourId'];
		$imageId = $_REQUEST['imageId'];
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/images/default/%d?userHash=%s', $tourId, $imageId, $userdata->token);
		$response = $this->sendJsonRequest($url, 'POST', null);
		return $response;
	}
	
	/* Tour video section*/
	public function uploadTourVideo(){
		$filedata = array('name' => $_FILES['tour_video']['name'], 'tmp_name' => $_FILES['tour_video']['tmp_name'], 'size' => $_FILES['tour_video']['size'] );
		$tourId = $_REQUEST['id'];
		$userdata = $_SESSION['rideTourUserData'];
		$userToken = $userdata->token;
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/video/create?userHash=%s', $tourId, $userToken);
		$response = $this->uploadFile($url, $filedata, 'video');
		return $response;
		
	}
	public function getTourVideos($tourId){
		$userdata = $_SESSION['rideTourUserData'];
		$request = array('userHash' => $userdata->token);
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/videos', $tourId);
		
		$response = $this->sendJsonRequest($url, 'GET', $request);
		return $response;
	}
	
	function deleteTourVideo(){
		$userdata = $_SESSION['rideTourUserData'];
		
		$tourId = $_REQUEST['tourId'];
		$videoId = $_REQUEST['videoId'];
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/video/delete/%d?userHash=%s', $tourId, $videoId, $userdata->token);
		$response = $this->sendJsonRequest($url, 'POST', null);
		return $response;
	}
	function createSap(){
		$saps = $_REQUEST['sap'];
		$tourId = $_REQUEST['tourId'];
		$userdata = $_SESSION['rideTourUserData'];
		
		$sapsArray = array('saps' => $saps);
		echo $url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/sap/create/?userHash=%s', $tourId, $userdata->token );
		$response = $this->sendJsonRequest($url, 'POST', $sapsArray);
	
		return $response;
	}
	function getSapSelectedMonth($currentMonth){
		$currencyCode = empty($_SESSION['currentCurrency']) ? 'USD' : $_SESSION['currentCurrency'];
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/list?currencyCode=%s&monthDate=%s',$currencyCode, $currentMonth);		
		$response = $this->sendJsonRequest($url, 'GET', array());
		return $response;
	}
	function updateSapData(){
		$currentMonth = $_REQUEST['cmonth'];
		$saps = $_REQUEST['saps'];
		$oldSaps = $_REQUEST['saps']['old'];
		$newSaps = $_REQUEST['saps']['new'];
		$checkTourOld = $_REQUEST['checktours']['old'];
		$checkTourNew = $_REQUEST['checktours']['new'];
		$oldTours = $_REQUEST['saps']['oldtours'];
		$oldTours = array_unique($oldTours);
		$userdata = $_SESSION['rideTourUserData'];
		$userToken = $userdata->token;
		$sapOldTable = array();
		if(!empty($oldSaps)){
					
			foreach($oldSaps as $cdate => $sap){				
				$seldate = ($cdate <10) ? '0'.$cdate : $cdate;
				if(!empty($sap)){
					foreach($sap as $tourId => $item){
					$price = $item['price'];	
						if(!empty($price) && in_array($cdate,$checkTourOld)){					
							$setmnth = $currentMonth.'-'.$seldate;
							$sapOldTable[$tourId][] = array('day' => $setmnth, 'cost' => $price);
						}					
					}
				}
			}
					
			if(!empty($sapOldTable)){
				#foreach($sapOldTable as $tourId => $item){
				foreach($oldTours as $tourId){
					$item = empty($sapOldTable[$tourId]) ? array() : $sapOldTable[$tourId];					
					$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/sap/update?userHash=%s&monthDate=%s',$tourId, $userToken, $currentMonth);
					$sapTable = array('saps' => $item);
					
					$response = $this->sendJsonRequest($url, 'POST', $sapTable);
				}
			}
			
			
		}
		if(empty($sapOldTable)){
			$tourId = $_REQUEST['tour_id'];
			$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/sap/update?userHash=%s&monthDate=%s',$tourId, $userToken, $currentMonth);
			$sapTable = array('saps' => array());
			$response = $this->sendJsonRequest($url, 'POST', $sapTable);
		}
		
		if(!empty($newSaps)){
			$tourId = $_REQUEST['tour_id'];
			$sapNewTable = array();
			foreach($newSaps as $cdate => $item){			
				$seldate = ($cdate <10) ? '0'.$cdate : $cdate;
				$price = $item['price'];
				if(!empty($price) && in_array($cdate,$checkTourNew)){					
					$setmnth = $currentMonth.'-'.$seldate;
					$sapNewTable[] = array('day' => $setmnth, 'cost' => $price);
									
				}
					
			}
			$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/%d/sap/create?userHash=%s&monthDate=%s',$tourId, $userToken, $currentMonth);
			if(!empty($sapOldTable[$tourId])){
				$sapNewTable = array_merge($sapNewTable, $sapOldTable[$tourId]);
			}
			$sapNewTable = array('saps' => $sapNewTable);
			$response = $this->sendJsonRequest($url, 'POST', $sapNewTable);			
		}
		
		return $response;
	}
	function topRides($request = null){
		$response = new stdClass();
		$cdate = $request['date'];
		unset($request['date']);

		$currencyCode = empty($_SESSION['currentCurrency']) ? 'USD' : $_SESSION['currentCurrency'];
		$url = MTBDOZ_API_URL.'/ride-back/tour/list';
		$request['currencyCode'] = $currencyCode;
		if(!empty($cdate)){
			$request['startDate'] = $cdate;
			$request['endDate'] = $cdate;
		}
		$result = $this->sendJsonRequest($url,'GET', $request);
		return $result;
	}
	private function sendBookRequest($url, $method = 'GET', $request, $postOther = null){
		$response = false;
		$methodTable = array('get', 'post');
		$method = strtolower($method);
		$setMethod = strtoupper($method);
		if($method == 'get'){
			$request = http_build_query($request);
			$url = $url.'?'.$request;	 
		} else {
			$request = http_build_query($request);
			$url = $url.'?'.$request;
			
		
		}		
		  if(!in_array($method, $methodTable)){
			return false;
		  }
		  
		//echo $url;exit())
		  $ch = curl_init($url);  
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $setMethod);  
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json;charset=UTF-8'));
		  if($method == 'post'){
			#curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
		  }
		  #curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		  $result = curl_exec($ch);
		  curl_close($ch);  // Seems like good practice
		  $result = json_decode($result);
		//print_r($result);
		//die;
		  $status = strtolower($result->code);
		  if($status == 'ok'){
			  $response = $result->payload;
		  } else {
			  $response = $result->error;
		  }
		  
		  return $response;
	}	
	
	
	function sendRequest($url, $method = 'GET', $request){
		$response = false;
		$methodTable = array('get', 'post');
		$method = strtolower($method);
		$setMethod = strtoupper($method);
		if($method == 'get'){
			$request = http_build_query($request);
			$url = $url.'?'.urldecode($request);
		} else {
			$post = json_encode($request);
		}
		
		  if(!in_array($method, $methodTable)){
			return false;
		  }
		  //echo $url;exit();
		  $ch = curl_init($url);  
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $setMethod);  
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json;charset=UTF-8'));
		  if($method == 'post'){
			curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
		  }
		  #curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		  $result = curl_exec($ch);
		  curl_close($ch);  // Seems like good practice
		  $result = json_decode($result);
		//print_r($result);
		//die;
		  $status = strtolower($result->code);
		  if($status == 'ok'){
			  $response = $result->payload;
		  } else {
			  $response = $result->payload;
		  }
		  
		  return $response;
	}
	function sendJsonRequest($url, $method = 'GET', $request){
		$response = new stdClass();
		$post = null;
		$methodTable = array('get', 'post');
		$method = strtolower($method);
		$setMethod = strtoupper($method);
		if($method == 'get'){
			if(!empty($request)){
				$request = http_build_query($request);
				$url = $url.'?'.urldecode($request);
				//echo $url; exit();
			}
		} else {
			if(!empty($request)){
				$post = json_encode($request);
			}
		}
		//echo $url; exit();
		//echo $post; exit();
		if(!in_array($method, $methodTable)){
			$response = (object) array('status' => false, 'data' => 'method not found');   
			return $response;
		  }
		  $ch = curl_init($url);  
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $setMethod);  
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json;charset=UTF-8'));
		  if($method == 'post' && !empty($post)){
			curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
		  }
		  #curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		  $result = curl_exec($ch);
		  curl_close($ch);  // Seems like good practice
		  $result = json_decode($result);
		//print_r($result);
		//die;
		  $status = strtolower($result->code);
		  if($status == 'ok'){
			  $response = (object) array('status' => true, 'data' => $result->payload);
		  } else {
			  $response = (object) array('status' => false, 'data' => $result->payload); 
		  }
		  
		  return $response;
	}
	function uploadFile($url, $filedata, $type = 'image'){
		$result = null;
		if ($filedata != '')
		{
			$headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
			$postfields = array($type => "@".$filedata['tmp_name'].";filename=".uniqid().'.jpg');
			$ch = curl_init();
			$options = array(
				CURLOPT_URL => $url,
				CURLOPT_HEADER => true,
				CURLOPT_POST => 1,
				CURLOPT_HTTPHEADER => $headers,
				CURLOPT_POSTFIELDS => $postfields,
				CURLOPT_INFILESIZE => $filedata['size'],
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SAFE_UPLOAD => false
			); // cURL options
			@curl_setopt_array($ch, $options);
			$result = curl_exec($ch);			
			$response = explode( '{"code":', $result);
			
			$result = '{"code":'.$response[1];
			
		  
		}
		
		return json_decode($result);
	}
	
	/*Get booking detail from tour ID*/
	function getBookingByTourId($tourid){
		$userdata = $_SESSION['rideTourUserData'];
		$userHash = $userdata->token;
		$operatorId = $userdetail->id;
		$url = MTBDOZ_API_URL.'/ride-back/tour/bookings/?userHash='.$userHash.'&tourId='.$tourid.'';
		$result = $this->sendJsonRequest($url,'GET',array());
		//echo "<pre>"; print_r($result);
		return $result;
	}
	
	
	//get operator info
	function getOperatorInfo(){
		$response = new stdClass();
		$url = MTBDOZ_API_URL.'/ride-back/user/login';
		$data = array('email' => $_SESSION['rideTourUserData']->detail->email, 'password' => $_SESSION['rideTourUserData']->detail->password);
		
		foreach($data as $key => $field){
			if(empty($field)){
				$error_block[] = $key.' field cannot be blank';
			}
		}
		if(!empty($error_block)){
			$response->data =  $error_block;
			$response->status = false;
			
		} else {
			$result = $this->sendRequest($url, 'GET', $data);
			if(!empty($result)){
				$token = $result->token;
				$_SESSION['rideTourUserData'] = (object) array('token' => urlencode($token), 'detail' => $result->user);	
				$response->data = array('message' => 'User Loggedin successfully', 'data' => $result);
				$response->status = true;
			} else {
				$response->data = array('message' => 'fields not matched');
				$response->status = false;
			}
		}
		return $response;
		#$this->send($response);
	}
	
	/*
	* @ Client Login
	*/
	function clientLogin(){
		$response = new stdClass();
		$url = MTBDOZ_API_URL.'/ride-back/tour/client/login';
		$data = array('email' => $_REQUEST['email'], 'password' => $_REQUEST['password']);
		foreach($data as $key => $field){
			if(empty($field)){
				$error_block[] = $key.' field cannot be blank';
			}
		}
		if(!empty($error_block)){
			$response->data =  $error_block;
			$response->status = false;
			
		} else {
			$result = $this->sendRequest($url, 'GET', $data);
			if(!empty($result)){
				$token = $result->token;
				$_SESSION['clientUserData'] = (object) array('token' => urlencode($token), 'detail' => $result->user);	
				$response->data = array('message' => 'User Loggedin successfully', 'data' => $result);
				$response->status = true;
			} else {
				$response->data = array('message' => 'fields not matched');
				$response->status = false;
			}
		}
		return $response;
		#$this->send($response);
	}
	
	/*
	* @Register new client
	*/
	function clientRegistration(){
	
		$url = MTBDOZ_API_URL.'/ride-back/tour/client/create';
		$tour_types = array();
		if(isset($_REQUEST['CROSS_COUNTRY']))
			array_push($tour_types,$_REQUEST['CROSS_COUNTRY']);
		if(isset($_REQUEST['ALL_MOUNTAIN']))
			array_push($tour_types,$_REQUEST['ALL_MOUNTAIN']);
		if(isset($_REQUEST['DOWNHILL']))
			array_push($tour_types,$_REQUEST['DOWNHILL']);
		$data = array("firstName"=> $_REQUEST['first_name'], "lastName"=> $_REQUEST['last_name'], "phone" => $_REQUEST['phone'], "mobile" => $_REQUEST['mobile'], "email" => $_REQUEST['email'], "address" => $_REQUEST['address'], "password" => $_REQUEST['password'], "perefferedTourTypes" => $tour_types);
		
		//print_r($data);
		$result = $this->sendRequest($url,'POST', $data);
		//print_r($result);
		return $result;
	
	}
	
	/*
	* @Auto Complete Destination Lists
	*/
	function getAutoCompleteList($term){
	
		$url = MTBDOZ_API_URL.'/ride-back/common/locations';
		$data = array("query"=> $term);
		
		//print_r($data);
		$result = $this->sendRequest($url,'GET', $data);
		//print_r($result);
		return $result;
	
	}
	
	
	function checkIsAdmin(){
		if(strpos($_SESSION['rideTourUserData']->detail->email, 'eyal') !== false){
			$response = 'success';
		} else {
			$response = 'error';
		}
		return $response;
		#$this->send($response);
	}
	
	
	/*
	* @Auto Complete Destination Lists
	*/
	function getOperatorList(){
	
		$url = MTBDOZ_API_URL.'/ride-back/tour/operator/list';
		$userdata = $_SESSION['rideTourUserData'];
		$token = $userdata->token;
		
		$data = array("userHash"=> $token);
		
		//print_r($data);
		$result = $this->sendRequest($url,'GET', $data);
		//print_r($result);
		return $result;
	
	}
	
	function updateOperatorStatus(){
        $userdata = $_SESSION['rideTourUserData'];
        
        
        $operatorId = $_REQUEST['operatorID'];
		$status = $_REQUEST['status'];
		$token = $userdata->token;
		$operatorRequest = array('status'=>$status);
		
		$url = sprintf(MTBDOZ_API_URL.'/ride-back/tour/operator/%d/update?userHash=%s',$operatorId, $token);		
		$result = $this->sendJsonRequest($url,'POST',$operatorRequest);
        if($error == true){
            $result->status = false;
            $result->data = "Password fields not matched. Please try again.";
        }
		return $result;
	}
        
        /*
	* @update booking
	*/
	function bookpostData($total_participant, $detail, $price, $email, $name, $sap_date ,$booking_date, $tourid, $sapid){
                //echo $total_participant."<br>";
                //echo "<pre>"; print_r($detail);exit();
		$url = MTBDOZ_API_URL.'/ride-back/tour/bookpost';
		$data = array("leadEmail"=> $email, "bookingDate"=> $booking_date, "currency" => $detail->data->tour->currency, "leadName" => $name, "note" => "", "numberOfParticipants" => $total_participant, "sapCost" => $price, "sapDate" => $sap_date, "sapId" => $sapid, "status" =>"CONFIRMED", "tourId" =>$tourid);
		
		//echo "<pre>"; print_r($data); exit();
		$result = $this->sendRequest($url,'POST', $data);
		//print_r($result);
		return $result;
	
	}
}
?>