<?php
require __DIR__ .  '/vendor/autoload.php';

use MercadoPago\SDK;
use MercadoPago\Preapproval;
use MercadoPago\Preapproval\Plan;


SDK::setAccessToken('SEU_ACCESS_TOKEN');
SDK::setIntegratorId('SEU_INTEGRATOR_ID');

?>