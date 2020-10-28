<?php

// $owner = $_POST['repository']['owner']['login'];
// $req = file_get_contents("php://input");
// $req = json_decode($req);
$output = exec('./hooks/post-receive');
var_dump($output);
