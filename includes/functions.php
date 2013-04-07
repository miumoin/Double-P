<?php
/*
 * Project: Double-P Framework
 * Copyright: 2011-2012, Moin Uddin (pay2moin@gmail.com)
 * Version: 1.0
 * Author: Moin Uddin
 */
function heading($title, $description, $keywords)
{
    $base=BASE;
    $flash_message=get_flash_message();
    if($flash_message!=0)
    {
        if($flash_message['type']==1) $display_flash="<font color='green'><strong>".$flash_message['message']."</strong></font>";
        elseif($flash_message['type']==0) $display_flash="<font color='red'><strong>".$flash_message['message']."</strong></font>";
    }
    $menus=top_menus();
    $display_notice=display_notice(3);

    echo <<<html
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
                <meta name='description' content='$description'/>
                <meta name='keywords' content='$keywords'/>
		<title>$title</title>
		<link href="$base/files/css/stylesheet.css" rel="stylesheet" type="text/css"/>
                <script type="text/javascript" src="$base/files/js/javascripts.js"></script>    
    </head>
    <body>

    <div class="container">
        <div class="header">
            <img src='$base/files/images/system/Heading.jpg' width='960'>
            <div align='right' style='padding: 10px'>$menus</div>
        </div>
        <div class="content" align="">
            <div class="contents">
                <div id='message' align='center'>$display_flash</div>
                <div id='notice'>$display_notice</div>

                <div id='body' align=''>
html;
}

function footing()
{
    $base=BASE;
    echo <<<html
            </div>
        </div>
    </div>
    <br><br>
        <img src='$base/files/images/system/Ground.jpg' width='960'>
        <div id='bottom' align='center'>
            <h6>Developed by: <i><a href='http://conceptuallyright.com/portfolios/cm_international' target='_blank'>Concept Lab</a></i></h6>
        </div>
    </body>

</html>
html;
}

function top_menus()
{
    if(logged_in())
    {
        return "Logged In as <strong>".current_user_info("username")."</strong>, <a href='".BASE."/profile'>Profile</a><br><a href='".BASE."/home'>Home</a> | <a href='".BASE."/login/?logout=true'>Logout</a>";
    }
    else return "<a href='".BASE."'>Home</a> | <a href='".BASE."/login'>Login</a>";
}

function set_flash_message($message, $flag)
{
    $_SESSION['flash']['message']=$message;
    $_SESSION['flash']['type']=$flag;
}

function get_flash_message()
{
    if(isset($_SESSION['flash']))
    {
        $message=array('message'=>$_SESSION['flash']['message'], 'type'=>$_SESSION['flash']['type']);
        unset($_SESSION['flash']);
        return $message;
    }
    else return 0;
}

function logged_in()
{
    if(isset($_SESSION['auth_user']))
    {
        return 1;
    }
    else return 0;
}

//following function returns the id of current user
function current_user_info($parameter)
{
    if(isset($_SESSION['auth_user'][$parameter])) return $_SESSION['auth_user'][$parameter];
    else return false;
}

function db_connect()
{
	$link=mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('<h1>Could not connect to database</h1>');
	mysql_select_db(DB_NAME,$link) or die('<h1>Could not connect to database</h1>');
	return $link;
}

function form_processor()
{
	if(isset($_REQUEST['process']))
	{
		$func="process_".$_REQUEST['process'];
		$func();
		die();
	}
}

//following function creates a pagination
function paginate($total, $current_page, $total_every_page, $url)
{

    $total_pages=$total/$total_every_page;
    if($total_page>round($total_page)) $total_pages=round($total_pages)+1;

    if($current_page>1) echo "<a href='".$url."/page/".($current_page-1)."'><input type='submit' value='<<<Previous'></a>";
    if($current_page<($total_pages)) echo "<a href='".$url."/page/".($current_page+1)."'><input type='submit' value='Next>>>'></a>";
}
?>
