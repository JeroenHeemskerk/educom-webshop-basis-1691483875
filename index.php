<?php
include 'sessions.php';
include 'login.php';
include 'register.php';
$page = GetRequestedPage();
$data = ProcessRequest($page);
ShowResponsePage($data);

function ProcessRequest($page){
    switch ($page){
        case 'register':
            $data = CheckRegister();
            if($data['registervalid']){
                StoreUser($data['email'], $data['name'], $data['password']);
                $page = 'login';
                $data['loginvalid'] = "";
            }
            break;
        case 'login':
            $data = CheckLogin();
            if($data['loginvalid']){
                LoginUser($data);
                $page = 'home';
            }
            break;
        case 'logout':
            LogoutUser();
            $page = 'home';
            break;
    }
    $data['page'] = $page;
    return $data;
}

function GetRequestedPage(){
    $requested_type = $_SERVER['REQUEST_METHOD']; 
    if ($requested_type == 'POST'){
        $requested_page = GetPostVar('page','home'); 
    }else{
        $requested_page = GetUrlVar('page','home'); 
    } 
    return $requested_page; 
}

function ShowResponsePage($data){
    BeginDocument();
    ShowHeadSection();
    ShowBodySection($data);
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

function ShowBodySection($data) { 
   echo '    <body>' . PHP_EOL; 
   ShowHeader($data);
   ShowMenu(); 
   ShowContent($data); 
   ShowFooter(); 
   echo '    </body>' . PHP_EOL; 
} 

function EndDocument(){
    echo '</html>';
}

function ShowHeader($data){
    switch ($data['page']){
        default:
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
        case 'register':
            Echo '<h1>Register</h1>';
            break;
        case 'login':
            Echo '<h1>Login</h1>';
            break;
    }
}

function ShowMenu(){
    echo '<ul class="menu">';
    Showmenuitem('home', 'Home');
    Showmenuitem('about', 'About');
    Showmenuitem('contact', 'Contact');
    if(IsUserLogIn()){
        Showmenuitem('logout', 'Logout ', getLogInUsername());
    }else{
        Showmenuitem('register', 'Registeer');
        Showmenuitem('login', 'Login');
    }
    echo '</ul>';
}

function Showmenuitem($name, $message, $username = ''){
    echo'<li class="menuitem"><a href="index.php?page=';echo $name; echo'">';echo $message, $username; echo'</a></li>';
}

function ShowContent($data){
    switch ($data['page']){
        default:
            echo '<a>error 404 pagina niet gevonden</a><br>
            <li class="menuitem"><a href="index.php?page=home">Terug gaan naar de homepagina</a></li>';
            break;
        case 'home':
            require('home.php');
            ShowHomeContent();
            break;
        case 'about':
            require('about.php');
            ShowAboutContent();
            break;
        case 'contact':
            require('contact.php');
            ShowContactContent();
            break;
        case 'register':
            ShowRegisterContent($data);
            break;
        case 'login':
            ShowLoginContent($data);
            break;
    }
}

function ShowRegisterContent($data){
    if($data['registervalid'] == false){
        ShowRegisterForm($data);
    }
}

function ShowLoginContent($data){
    if($data['loginvalid'] == false){
        ShowLoginForm($data);
    }
}

function ShowContactContent(){
    $data = ValidateContact();
    if($data['valid'] == false){
        ShowFormContent($data);
    } else {
        ShowThanksContent($data);
    }
}

function ShowFooter(){
    echo '<footer>
    <p>Copyright &copy; 2023 Stijn Engelmoer</p>
    </footer>';
}
?>