<?php

session_start();
include_once('php/https.php');
SSLon();

?>

<!DOCTYPE HTML>

<html lang="en" data-ng-app="tori">

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Tori</title>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="stylesheet" href="/css/normalize.css"/>
        <link rel="stylesheet" href="/css/ngDialog.min.css"/>
        <link rel="stylesheet" href="/css/ngDialog-theme-default.css"/>
        <link rel="stylesheet" href="/css/ngDialog-theme-plain.css"/>
        <link rel="stylesheet" href="/css/main.css"/>
		<link rel="stylesheet" href="/css/manual.css"/>
        <link rel="stylesheet" href="/css/style.css"/>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Londrina+Solid' rel='stylesheet' type='text/css'>
        <base href="/">
    </head>

    <body>

        <div class="wrapper">

            <header data-ng-controller="navController">
                <div class="logo"><a data-ng-href="#">Tori.io</a></div>
                <nav>
                    <ul>
			            <li data-ng-click="goLogout()" data-ng-if="isLogged()"><a data-icon="&#xe603;">sign out</a></li>
                        <li data-ng-click="gogogo('/action/place')" data-ng-hide="isLogged()"><a data-icon="&#xe605;">place an ad</a></li>
			            <li data-ng-click="goLogin()" data-ng-hide="isLogged()"><a data-icon="&#xe601;">sign in</a></li>
                    </ul>
                </nav>
            </header>
	
	        <div class="top_container" data-ng-controller="filterController" data-ng-show="checkRoute()">
                <ul>
                    <li data-ng-class="getClass('/index')" data-ng-click="gogogo('/')">all</li>
                    <li data-ng-class="getClass('/items/cars')" data-ng-click="gogogo('/items/cars')" data-icon="&#xe604;">cars</li>
                    <li data-ng-class="getClass('/items/houses')" data-ng-click="gogogo('/items/houses')" data-icon="&#xe600;">houses</li>
                </ul>
                <ul class="right">
                    <li data-ng-class="getClass('/admin')" data-ng-click="gogogo('/admin')" data-ng-if="isLogged()" data-icon="&#xe602;">unapproved</li>
                </ul>
            </div>

            <section data-ng-view=""></section>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.27/angular.min.js"></script>
        <script src="https://code.angularjs.org/1.2.27/angular-route.min.js"></script>
        <script src="/js/angular-file-upload.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="/js/controllers.js"></script>
        <script src="/js/ngDialog.min.js"></script>
    </body>

</html>
