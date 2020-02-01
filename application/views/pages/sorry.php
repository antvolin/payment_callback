<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>
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