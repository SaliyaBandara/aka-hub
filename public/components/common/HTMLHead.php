<?php

class HTMLHead
{
    public function __construct($title = null, $desc = null)
    {
        $title = $title ? "$title | Aka Hub" : 'Aka Hub';
        $desc = $desc ? $desc : 'Aka Hub is a student collaboration platform for students to share their academic knowledge and skills with each other.';

?>

        <!doctype html>
        <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="author" content="Aka Hub by CS group 24" link-url="" />

            <meta name="description" content="<?= $desc ?>">
            <meta name="keywords" content="Aka Hub, UCSC Student Collaboration platform">
            <meta name="image" content="<?= BASE_URL ?>/public/images/favicon.png">

            <!-- Schema.org for Google -->
            <meta itemprop="name" content="Aka Hub">
            <meta itemprop="description" content="<?= $desc ?>">
            <meta itemprop="image" content="https://akahub.lk/assets/img/logo-large.png">

            <!-- Twitter -->
            <meta name="twitter:site" content="">
            <meta name="twitter:card" content="summary">
            <meta name="twitter:title" content="Aka Hub">
            <meta name="twitter:description" content="<?= $desc ?>">
            <meta name="twitter:image:src" content="https://akahub.lk/assets/img/logo-large.png">

            <!-- Open Graph general (Facebook, Pinterest & Google+) -->
            <meta name="og:title" content="Aka Hub">
            <meta name="og:description" content="<?= $desc ?>">
            <meta name="og:image" content="https://akahub.lk/assets/img/logo-large.png">
            <meta name="og:url" content="https://akahub.lk/">
            <meta name="og:site_name" content="Aka Hub">
            <meta name="fb:app_id" content="">
            <meta name="og:type" content="website">

            <link rel="shortcut icon" href="<?= BASE_URL ?>/public/assets/img/favicon.ico">

            <!-- <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/libs/flickity/dist/flickity.min.css">
            <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/libs/flickity-fade/flickity-fade.css"> -->

            <!-- dropzone -->
            <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
            <link href="<?= BASE_URL ?>/public/assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet" type="text/css" id="dark-style" />

            <link href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/tables.css">
            <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/normalize.css">
            <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/common.css">
            <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/main.css?ver=3.0">

            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

            <title><?= $title ?></title>

        </head>

        <body>


    <?php
    }
}
