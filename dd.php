<?php

function dd()
{
  array_map(fn ($x) => var_dump($x), func_get_args());
  die();
}
