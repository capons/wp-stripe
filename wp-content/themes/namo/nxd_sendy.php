<?php

    function request($url, $data){
        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, $url);
            //curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // ������ ��� ����� "�����" ���������� ����� � ������� cUrl*a
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // ������ ��� ����� "�����" ���������� ����� � ������� cUrl*a
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curl, CURLOPT_POST, true);
		$postvars = '';	
  foreach($data as $key=>$value) {
	if (is_array($value))
		foreach($value as $k => $v)
			$postvars .= $key . "[" . $k . "]=" . urlencode($v) . "&";
	else
		$postvars .= $key . "=" . urlencode($value) . "&";
  }			
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postvars);
            return curl_exec($curl);
        } else return null;
    }

	$api_url = 'http://sendy.newslettera.com/subscribe';
//
	$api_key = '57abe39b0020d4dc14b497b2d8aa2fbd-us2';

//<input type="hidden" value="4e9be923e9e7120a354f0ba64" name="u">
//<input type="hidden" value="6d08f1e8a2" name="id">
	$url = $api_url ;//. 'lists/subscribe' . '.json';
	
	$select1 = Array('1' => 'Music Publisher', '2' => 'Record Label', '3' => 'Artist / Band',
					'4' => 'Manager', '5' => 'Producer/ Songwriter', '6' => 'Other');
	$select2 = Array('1' => 'less than 100', '2' => '100-200', '3' => '200+');
	$select3 = Array('1' => 'Yes, I have extensive experience', '2' => 'Yes, I have some experience', 
					'3' => 'No, but I&#39;d like to start', '4' => 'No, I prefer someone else to do this for me');
	$select3 = Array('1' => 'a', '2' => 'b', 
					'3' => 'c', '4' => 'd');
					
					
	if (!(isset($select1[$_POST['Q1']]) && isset($select2[$_POST['Q2']]) && isset($select3[$_POST['Q3']]))){
		header('Location: /reminder/'); 
		exit;
	}
	
	$email = $_POST['email'];
	
	$lists = Array('VIP-A' => 'QdMcCm1oURkwuhJMjKGWSA', 'VIP-P' => 'xZFTS6FFCK892t5L892YdOE3uA', 'VIP-SP' => 'c4763uk56uArYU45FsbMiU1w');
	$list = 'VIP-A';
	if (in_array($_POST['Q1'], Array('1', '2', '4', '5', '6'))) {
		if (in_array($_POST['Q2'], Array('1', '2')))
			$list = 'VIP-A';
		if ($_POST['Q2'] == '3'){
			if (in_array($_POST['Q3'], Array('3', '4')))
				$list = 'VIP-A';
			if ($_POST['Q3'] == '1')
				$list = 'VIP-P';
			if ($_POST['Q3'] == '2')
				$list = 'VIP-SP';
		}
	}
	
	if ($_POST['Q1'] == '3') {
		if (in_array($_POST['Q2'], Array('1', '2')))
			$list = 'VIP-A';
		if ($_POST['Q2'] == '3'){
			if (in_array($_POST['Q3'], Array('2', '3', '4')))
				$list = 'VIP-A';
			if ($_POST['Q3'] == '1')
				$list = 'VIP-SP';
		}
	} 

		$data = array(
//			'apikey' => $api_key,
			'list' => $lists[$list],
			'email' => $email,
			'Q1' => $select1[$_POST['Q1']],
			'Q2' => $select2[$_POST['Q2']],
			'Q3' => $select3[$_POST['Q3']]
			);

		$response = request($url, $data);
		//echo $response;
		//$x = json_decode($response);
//		print_r($x);
		
		header('Location: /reminder/'); 
		
		//$result = $this->call( 'lists/subscribe', $data );		