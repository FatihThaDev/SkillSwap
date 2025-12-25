<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config
{
  public static function DB_NAME()
  {
    return 'if0_40734021_skillswap'; // enter your database name here
  }
  public static function DB_PORT()
  {
    return  3306;
  }
  public static function DB_USER()
  {
    return 'if0_40734021'; // add your database username here
  }
  public static function DB_PASSWORD()
  {
    return 'FcFbSV7pUEsOm68'; // add your database password here
  }
  public static function DB_HOST()
  {
    return 'sql305.infinityfree.com';
  }

  public static function JWT_SECRET()
  {
    return 'P4IUvoPc3P9MErMl3Fbu+p/YsLQfvSVDxRvWRpyI0p4=';
  }
}
