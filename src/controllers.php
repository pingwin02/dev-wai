<?php
require_once 'business.php';
require_once 'controller_utils.php';

function clear(&$model) {
    if (isset($_SESSION["account_id"])&&$_SESSION["account_id"]=='admin'){
        clear_base();
        return 'redirect:galeria';
    }
    
    $model['clearError'] = "failed";
    return 'galeria';
}

function clear_users(&$model) {

    if (isset($_SESSION["account_id"])&&$_SESSION["account_id"]=='admin'){
        clear_users_base();
        return 'redirect:login?logout=passed';
    }
    $model['clearError'] = "failed";
    return 'galeria';
}

function upload(&$model) {
    if(isset($_POST["submit"]))
    {
    $resultCode=upload_photo();
    $model['resultCode'] = $resultCode;
    }
    return 'przeslij';
}
function galeria(&$model) {

    if(isset($_GET['page'])) {
        $page = $_GET['page'];
        $model['page'] = $page;
    }
    return 'galeria';
}

function index() {
    return 'index';
}
function omnie() {
    return 'omnie';
}
function gal_2020() {
    return '2020';
}
function gal_2019() {
    return '2019';
}

function wyszukaj(&$model) {
    if (isset($_POST['search'])) {
        $model['search'] =$_POST['search'];
    }
    return 'wyszukaj';
}

function login(&$model) {
    
    if(isset($_GET['logout'])) {
        $model['logout'] = $_GET['logout'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
             $model['account'] = getAccount($_SESSION['account_id']);
            return 'galeria';
        } else {
            return 'galeria';
        }
    } else {
        if(isset($_POST['register'])) {
            $regResult = verifyRegistrationForm($_POST);
            $model['regResult'] = $regResult;
            return 'galeria';
        } else {
            if(verifyLoginForm($_POST)) {
                $model['account'] = getAccount($_SESSION['account_id']);
                return 'galeria';
            } else {
                $model['logError'] = true;
                return 'galeria';
            }

        }
    }

}
function logout() {
    if(isset($_SESSION['logged_in'])) {
        session_unset();
        session_destroy();
        $params = session_get_cookie_params();
        setcookie(session_name(),'', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
        );
        return 'redirect:login?logout=passed';
    } 
    return 'redirect:login?logout=failed';
}

function save() {

    save_checked();

    return 'redirect:' .$_SERVER['HTTP_REFERER'];
}

function delete() {

    delete_checked();

    return 'galeria_wybrane';
}

function clear_cart()
{
    $_SESSION['cart'] = [];

    return 'galeria_wybrane';
}

function gal_wyb() {
    return 'galeria_wybrane';
}

function search() {
    ajax_search();
    exit;
}