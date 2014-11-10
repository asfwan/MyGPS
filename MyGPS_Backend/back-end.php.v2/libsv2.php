<?php

/*
	ASFWAN LIBS V2
*/

$DEV_MODE = false;

function getvar($var){
	if(isset($_GET[$var])) return $_GET[$var];
	else return "";
}

function Q_($q){
	return mysql_query($q);
}

function getArrayFromQuery($q){
    return mysql_fetch_array( mysql_query($q) );
}

function getArrayFromRes($res){
    return mysql_fetch_array( $res );
}

function getJSONFromQuery($q){
    $res = mysql_query($q);
    
    while($row = mysql_fetch_assoc( $res )){
        $rows[]= $row;
    }
    
    return json_encode($rows);
    
}

function ASFWAN_DEV_AUTH_APP_QUERY($auth_table){
	
		$AUTH_KEY = getvar("AUTH-KEY");
		$APP_NAME = getvar("APP-NAME");
		
		$AUTH = getArrayFromQuery("select * from $auth_table");
			
		if($DEV_MODE) {
			if( $AUTH_KEY != $AUTH['auth_key']) echo "$AUTH_KEY != ".$AUTH['auth_key']."     ";
			if( $APP_NAME != $AUTH['app_name']) echo "$APP_NAME != ".$AUTH['app_name'];
			echo "     ";
		}
		
		if( $AUTH_KEY != $AUTH['auth_key'] || $APP_NAME != $AUTH['app_name']) die("UNAUTHORIZED!");
		
		return getJSONFromQuery(getvar("ASFWAN-DEV-AUTH-APP-QUERY"));
	
}

function echotest(){
	echo "ECHO FROM ASF LIBS V2 [WORKS!]";
}

function argtest($arg){
	echo "ARG: [$arg]";
}

include($path_to_essentials."mcrypt.php");


/* * *
*  Make sure that the db_name, auth_table are correct to use this function
*/
function ASFWAN_DEV_AUTH_APP_QUERY_SECURED($auth_table){ 

	/*
		base-64 encoded:
			IV, KEY
		encrypted:
			AUTH-KEY, APP-NAME, ASFWAN-DEV-AUTH-APP-QUERY
	*/
		
		$iv_64 = getvar("IV");
		$key_64 = getvar("KEY");
		
		if($iv_64 == "" || $key_64 == "") die("NULL KEY FOUND!");
		
		$iv = base64_decode($iv_64);
		$key = base64_decode($key_64);
		
		//echo("IV:".$iv."<p>KEY:".$key);
				
		$mcrypt = new Mcrypt($iv,$key);
		
		$AUTH_KEY_CR = getvar("AUTH-KEY");
		$APP_NAME_CR = getvar("APP-NAME");
		
		$AUTH_KEY = $mcrypt->decrypt($AUTH_KEY_CR);
		$APP_NAME = $mcrypt->decrypt($APP_NAME_CR);
		
		$AUTH = getArrayFromQuery("select * from $auth_table");
			
		if( $AUTH_KEY != $AUTH['auth_key'] || $APP_NAME != $AUTH['app_name']) die("UNAUTHORIZED!");
		
		//echo $mcrypt->decrypt(getvar("ASFWAN-DEV-AUTH-APP-QUERY"));
		
		return getJSONFromQuery($mcrypt->decrypt(getvar("ASFWAN-DEV-AUTH-APP-QUERY")));
	
}

?>