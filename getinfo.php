<?php


require_once("data.php");


//$ArrayURL = split('/', $_SERVER[REQUEST_URI]);
$ArrayURL = explode('/', $_SERVER['REQUEST_URI']);

//Alan : Use of DEPRECATED function : split
//This function has been DEPRECATED as of PHP 5.3.0. Relying on this feature is highly discouraged.
//Use of explode function is more appropriate

//Alan : Syntax Error : new To remove ')'
//Parse error: parse error in /Library/Server/Web/Data/Sites/Default/getInfo.php on line 4

//Alan : Variable naming conversion
//Camel case should be more appropriate : $arrayURL;

//Alan : use of undefined constant REQUEST_URI , use of string value = 'REQUEST_URI' instead
//Notice: Use of undefined constant REQUEST_URI - assumed 'REQUEST_URI' in /Library/Server/Web/Data/Sites/Default/getInfo.php on line 4 Deprecated: Function split() is deprecated in /Library/Server/Web/Data/Sites/Default/getInfo.php on line 4 /getInfo.php Fatal error: Class 'dataObj' not found in /Library/Server/Web/Data/Sites/Default/getInfo.php on line 12


//$id = $ArrayURL[1];
$id = array_pop($ArrayURL);
            
//Object ID may not be in index = 1
//safer to retrieve from last index instead
//use rof array_pop() pops and returns the last value of the array , shortening the array by one element. If array is empty (or is not an array), NULL will be returned.

//$data = new dataObj();
$data = new propertyData();


# Invalid Class, there is not dataObj Class
# Assumption : for the purpose of testing, hdbData class has been assumpted.

//	if (is_object($data) = true) $status = '200 OK';
	if (is_object($data) == true) $status = '200 OK';        
//Should be '==' for equality, instead of '=', which is a assignment operator
//Fatal error: Can't use function return value in write context in /Library/Server/Web/Data/Sites/Default/getInfo.php on line 10

//$status_header = 'HTTP/1.1 $status';
$status_header = "HTTP/1.1 $status";
# alan
# should use " instead of '

header($status_header);


//echo "<pre>";
//print_r( json_encode($data->getAll($id)));
//echo "</pre>";


echo json_encode( $data->getAll($id) );

?>