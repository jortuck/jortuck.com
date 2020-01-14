<?php
require "Bramus/Router/Router.php";
include ("databases/connect.php");
include ("src/libs/functions.php");

$router = new \Bramus\Router\Router();

$router->get('pattern', function() { /* ... */ });
$router->post('pattern', function() { /* ... */ });
$router->put('pattern', function() { /* ... */ });
$router->delete('pattern', function() { /* ... */ });
$router->options('pattern', function() { /* ... */ });
$router->patch('pattern', function() { /* ... */ });

// Define routes
// Errors
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    include('views/404.php');
});
//Indexs
$router->all('/', function () {
    $header = "/";
    include('views/index.php');
});
$router->all('/index.php', function () {
    $header = "/index.php";
    include('views/index.php');
});
$router->all('/home', function () {
    $header = "/home/";
    include('views/index.php');
});
//Static pages
$router->all('/projects/web', function () {
    $header = "/web/";
    include('views/webdesign.php');
});
$router->all('/projects/lua', function () {
    $header = "/lua/";
    include('views/lua.php');
});
//User pages(pages where user can interacts)
$router->all('/advertise', function () {
    $header = "/advertise/";
    include('views/advertise.php');
});
$router->get('/advertise/{action}', function ($action) {
    $header = "/advertise/".$action;
    include('views/advertise.php');
});
$router->all('/feedback', function () {
    $header = "/feedback/";
    include('views/feedback.php');
});
$router->get('/feedback/{action}', function ($action) {
    include('views/feedback.php');
});
$router->all('/verify', function () {
    $header = "/verify/";
    include('views/verify.php');
});
$router->get('/verify/{id}', function ($verify) {
    $header = "/advertise/".$verify;
    include('views/verify.php');
});
//Steam routes
$router->all('/lookup/{id}', function ($id) {
    include('views/controller.php');
});
$router->get('/steam', function () {
    include('views/steam.php');
 });
 $router->post('/lookup/', function () {
    header("Location: /lookup/".$_POST['id']);
 });
 $router->all('/steam/error', function () {
    include('views/steamerror.php');
});
//Management pages
$router->all('/manage', function () {
    include('views/manage/index.php');
});
$router->all('/manage/home', function () {
    include('views/manage/index.php');
});
$router->all('/manage/index.php', function () {
    include('views/manage/index.php');
});
$router->all('/manage/users', function () { //Users Manage
    include('views/manage/users.php');
});
$router->get('/manage/users/{action}', function ($action) { //Users Manage Action
    include('views/manage/users.php');
});
$router->all('/manage/content', function () { //Cotnent Manage
    include('views/manage/content.php');
});
$router->get('/manage/content/{action}', function ($action) { //Content Manage Actions
    include('views/manage/content.php');
});
$router->get('/manage/edit/{pageid}/{action}', function ($pageid,$action) { //Editor Manage Actions
    include('views/manage/editor.php');
});
$router->all('/manage/edit/{pageid}', function ($pageid) { //Editor Manage
    include('views/manage/editor.php');
});

$router->all('/{slug}/', function ($slug) { //Editor Manage
    //include('views/manage/editor.php');
include('views/page.php');
});

// Run it!
$router->run();
?>