<?php 

if(!defined('NO')) define('NO', 0);
if(!defined('YES')) define('YES', 1);

if(!defined('PAID')) define('PAID',1);
if(!defined('UNPAID')) define('UNPAID', 0);

if(!defined('APPROVED')) define('APPROVED', 1);
if(!defined('DECLINED')) define('DECLINED', 0);

if(!defined('DEFAULT_TRUE')) define('DEFAULT_TRUE', true);
if(!defined('DEFAULT_FALSE')) define('DEFAULT_FALSE', false);

if(!defined('ADMIN')) define('ADMIN', 'admin');
if(!defined('USER')) define('USER', 'user');
if(!defined('PROVIDER')) define('PROVIDER', 'provider');


if(!defined('COMPLETED')) define('COMPLETED', 1);
if(!defined('DECLINED')) define('DECLINED', 0);

if(!defined('BOOKING_NONE')) define('BOOKING_NONE', 0);
if(!defined('BOOKING_CREATED')) define('BOOKING_CREATED', 1);
if(!defined('BOOKING_CHECKIN')) define('BOOKING_CHECKIN', 2);
if(!defined('BOOKING_CHECKOUT')) define('BOOKING_CHECKOUT', 3);
if(!defined('BOOKING_COMPLETED')) define('BOOKING_COMPLETED', 4);
if(!defined('BOOKING_USER_CANCEL')) define('BOOKING_USER_CANCEL', 5);
if(!defined('BOOKING_PROVIDER_CANCEL')) define('BOOKING_PROVIDER_CANCEL', 6);
