<?php

function pre_var_dump($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
  }