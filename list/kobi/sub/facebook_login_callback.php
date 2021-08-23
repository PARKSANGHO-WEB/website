<?
require_once '../Facebook/autoload.php';
if(!session_id()) { 
	session_start(); 
} 
$fb = new Facebook\Facebook([ 'app_id' => '697544030876697', 'app_secret' => 'a503a1da29611637e69d8f92e8950ca4', 'default_graph_version' => 'v8.0', ]); 
$helper = $fb->getRedirectLoginHelper(); //state 에러가 발생하는 경우 추가 
if (isset($_GET['state'])) { 
	$helper->getPersistentDataHandler()->set('state', $_GET['state']); 
	} // 사용자 액세스 토큰 획득 
	try { $accessToken = $helper->getAccessToken(); 
	} catch(Facebook\Exceptions\FacebookResponseException $e) { 
		echo 'Graph returned an error: ' . $e->getMessage(); 
		exit; 
	} catch(Facebook\Exceptions\FacebookSDKException $e) { 
		echo 'Facebook SDK returned an erro: '.$e->getMessage(); 
		exit; 
		} //각종 에러 처리 
		if(!isset($accessToken)) { 
			if($helper->getError()) { 
				header('HTTP/1.1 401 Unauthorized'); echo "Error: " . $helper->getError()."\n"; 
				echo "Error Code: " . $helper->getErrorCode()."\n"; 
				echo "Error Reason: " . $helper->getErrorReason()."\n"; 
				echo "Error Description: " . $helper->getErrorDescription()."\n"; 
				} else { 
					header('HTTP/1.1 400 Bad Request'); 
					echo 'Bad request'; 
				} 
				exit; 
				} //사용자 액세스토큰 출력 
				echo '<h3>Access Token</h3>'; 
				var_dump($accessToken->getValue()); 
				$oAuth2Client = $fb->getOAuth2Client(); 
				$tokenMetadata = $oAuth2Client->debugToken($accessToken); //사용자 토큰 정보 출력 
				echo '<h3>Metadata</h3>'; 
				var_dump($tokenMetadata); 
				$tokenMetadata->validateAppId('{app_id}'); 
				$tokenMetadata->validateExpiration(); //장기 토큰 변환 
				if(!$accessToken->isLongLived()) { 
					try{ 
						$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken); $response = $fb->get('/me', $accessToken); 
					} catch(Facebook\Exceptions\FacebookSDKException $e) { 
							echo "<p>Error getting long-lived access token: " . $e->getMessage()."</p>\n\n"; 
							exit; 
					} $graphNode = $response->getGraphNode(); 
				} //변환된 장기 토큰 출력 
				echo '<h3>Long-lived</h3>'; 
				var_dump($accessToken->getValue()); //액세스 토큰 세션에 저장 
				$_SESSION['fb_access_token'] = (string) $accessToken;

?>