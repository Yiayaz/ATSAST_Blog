<?php

function getIP()
{
    if (@$_SERVER["HTTP_X_FORWARDED_FOR"]) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (@$_SERVER["HTTP_CLIENT_IP"]) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (@$_SERVER["REMOTE_ADDR"]) {
        $ip = $_SERVER["REMOTE_ADDR"];
    } elseif (@getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } elseif (@getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (@getenv("REMOTE_ADDR")) {
        $ip = getenv("REMOTE_ADDR");
    } else {
        $ip = "Unknown";
    }
    return $ip;
}
function is_login()
{
    $is_login=1;
    if ($OPENID=arg("OPENID")) {
        $_SESSION['loginid']=$OPENID;
        $is_login=validateOPENID($OPENID, "app");
    } elseif (!@$_SESSION['OPENID']) {
        $is_login=0;
    } else {
        $is_login=validateOPENID($_SESSION['OPENID'], "browser");
    }
    return $is_login;
}