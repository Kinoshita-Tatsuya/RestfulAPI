<?php
require_once('Player.php');
if(isset($_SERVER['HTTP_ORIGIN']))
{
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
{
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    {
        header('Access-Control-Allow-Methods:GET,POST,PUT,DELETE,OPTIONS');         
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    {
       header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }

    exit(0);
}

preg_match('|' . dirname($_SERVER['SCRIPT_NAME']) . '/([\w%/]*)|', $_SERVER['REQUEST_URI'], $matches);
$paths = explode('/', $matches[1]);

$name = isset($paths[1])? urldecode(htmlspecialchars($paths[1])) : null;
$prevName = isset($paths[2])? urldecode(htmlspecialchars($paths[2])) : null;

$instance = new Player();

switch(strtolower($_SERVER['REQUEST_METHOD']))
{
    case 'get':
        $instance->Get(); 
        break;

    case 'post':
        $instance->Post($name);
        break;

    case 'delete':
        $instance->Delete($name);
        break;
    
    case 'put':
        $instance->Put($name,$prevName);
        break;
}

?>