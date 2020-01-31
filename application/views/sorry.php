<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Transaction failed</title>
    <style type="text/css">
        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }
        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }
        #body {
            margin: 0 15px 0 15px;
        }
        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>Sorry, the transaction failed!</h1>
    <div id="body">
        <p>Transaction #:<?php echo $transactionId; ?></p>
        <p>Transaction operation:<?php echo $transactionOperation; ?></p>
        <p>Transaction status:<?php echo $transactionStatus; ?></p>
    </div>
</div>
</body>
</html>