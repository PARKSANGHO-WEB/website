<?
require_once "../Google/Client.php";


$this->load->library("curl");
$this->curl->create("https://accounts.google.com/o/oauth2/token");
$headers = array("Host"=>"accounts.google.com","Content-Type"=>"application/x-www-form-urlencoded");
$this->curl->options(array(CURLOPT_HTTPHEADER => $headers));

$post = array("code"=>"임시로 발급받은 코드"
,"client_id"=>"160067170486-c1dpr5o2fb94li486urr24bhuftcomp6.apps.googleusercontent.com"
,"client_secret"=>"4HNWW-xLOKXgKtfihH5tSuCw"
,"redirect_uri"=>"160067170486-c1dpr5o2fb94li486urr24bhuftcomp6.apps.googleusercontent.com"
,"grant_type"=>"authorization_code");


$this->session->set_userdata("access_token", $arrResult["access_token"]);

//사용자정보조회
$this->curl->http_header("Authorization", "Bearer ".$arrResult["access_token"]);
$this->curl->create("https://www.googleapis.com/oauth2/v2/userinfo");
$this->curl->execute();
$arrResult = $this->curl->lastResponseRaw();
$arrResult = json_decode($arrResult, true);

?>