
<?php
//echo 'Display';

session_start();
$_SESSION['getin_role'] = 'Administrator';
require_once 'functions/functions.php';
include 'core/init.php';
$date_today=  date('Y-m-d');
error_reporting(0);
//$passwordHasher=new PBKDF2PasswordHasher();
$crypt = new Encryption();
//echo date("Y-m-d h:i:s");
// Current / default page
//$encoded_page = isset($_GET['page']) ? $_GET['page'] : $crypt->encode('login');
$encoded_page = isset($_GET['page']) ? $_GET['page'] : ('login');
//$page = $crypt->decode($encoded_page);
$page=$encoded_page;

switch ($page) {
    default:
        $page = "error";
        //check_login_status();
        include 'pages/error.php';
        break;

    case 'index':
        //check_login_status();
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    case 'login':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'dashboard':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'users':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'demographics':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'cug':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'vht_follow':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'midwife_follow':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'midwives_count':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'logout':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'slider':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'list_products':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'list_users':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'scheduled_appointments':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'completed_visits':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'expected_visits':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'attended_today':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'missed_attendance':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'broadcast_message':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'vht_count':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'demographics_statistics':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'bulk_sms_send':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;
        
    case 'ambulance_drivers':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break; 
        
    case 'messages':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break; 
        
    case 'change_password':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break; 
        
    case 'demograhics_details':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break; 
        
    case 'download_excel':
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break; 
        
    
}
?>
