<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['s3'] = [
    'version'     => 'latest',
    'region'      => 'idn', // Biznet S3 region
    'endpoint'    => 'https://nos.wjv-1.neo.id', // Biznet S3 endpoint
    'credentials' => [
        'key'    => '00af67f5ae2c251dde06',      // ganti dengan key Anda
        'secret' => 'AYC3ex0EBljy/zgP0bJkG1lr/C94hL+1BZrFuola'     // ganti dengan secret Anda
    ],
    'bucket' => 'certara'         // ganti dengan bucket
];
