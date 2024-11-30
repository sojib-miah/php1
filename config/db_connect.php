<?php

$conn = mysqli_connect('localhost', 'sojib', '12345', 'data_one');
if (!$conn) {
    echo 'Connection Error : ' . mysqli_connect_error();
}
