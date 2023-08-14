<?php
$page = GetRequestedPage();
ShowResponsePage($page);

function GetRequestedPage(){
    $requested_type = $_SERVER['REQUEST_METHOD']; 
    if ($requested_type == 'POST'){
        $requested_page = getPostVar('page','contact'); 
    } 
    else{ 
        $requested_page = getUrlVar('page','home'); 
    } 
    return $requested_page; 
}

function ShowResponsePage($page){
    BeginDocument();
    ShowHeadSection();
    ShowBodySection($page);
    EndDocument();
}

function GetArrayVar($array, $key, $default=''){
    return isset($array[$key]) ? $array[$key] : $default;
}

function GetPostVar($key, $default=''){
    return GetArrayVar($_POST, $key, $default);
}

function GetUrlVar($key, $default=''){
    return GetArrayVar($_GET, $key, $default);
}

function BeginDocument(){
    echo '<!doctype html>
    <html>';
}

function ShowHeadSection(){
    echo '<head>
    <link rel="stylesheet" href="CSS/stylesheet.css">
    <title>About</title>
    </head>';
}

function ShowBodySection($page) { 
   echo '    <body>' . PHP_EOL; 
   ShowHeader($page);
   ShowMenu(); 
   ShowContent($page); 
   ShowFooter(); 
   echo '    </body>' . PHP_EOL; 
} 

function EndDocument(){
    echo '</html>';
}

function ShowHeader($page){
    switch ($page){
        case '':
            echo '<h1>gefaald</h1>';
            break;
        case 'home':
            Echo '<h1>Home</h1>';
            break;
        case 'about':
            Echo '<h1>About</h1>';
            break;
        case 'contact':
            Echo '<h1>Contact</h1>';
            break;
    }
}

function ShowMenu(){
    echo '<ul class="menu">
    <li class="menuitem"><a href="index.php?page=home">Home</a></li>
    <li class="menuitem"><a href="index.php?page=about">About</a></li>
    <li class="menuitem"><a href="index.php?page=contact">Contact</a></li>
    </ul>';
}

function ShowContent($page){
    switch ($page){
        case 'home':
            require('home.php');
            #ShowHomeContent();
            break;
        case 'about':
            require('about.php');
            #ShowAboutContent();
            break;
        case 'contact':
            require('contact.php');
            #ShowContactContent();
            break;
    }
}

function ShowFooter(){
    echo '<footer>
    <p>Copyright &copy; 2023 Stijn Engelmoer</p>
    </footer>';
}
?>