<?php

namespace App\Mastercard;

use App\Mastercard\Common\Environment;

class Env {
    const SANDBOX_KEYSTORE_PASSWORD = "ivonneg12";
    const SANDBOX_KEYSTORE_PATH = "/var/www/master/MCKeyStore.p12";
    const SANDBOX_CONSUMER_KEY = "a8smVxYDpsP9h8EoFCSDx8NCu2a52K0daIWZ2We8d07e9fa6!414f5578705375315177447432647874715763482f2b773d";

    const PRODUCTION_KEYSTORE_PASSWORD = "unreal";
    const PRODUCTION_KEYSTORE_PATH = "C:\\Users\\JBK0718\\dev\\mastercard\\keystore\\production\\546536344e2b647558374a4156382f414644524173673d3d.p12";

    // APP-SPECIFIC PRODUCTION KEYS
    const LOCATION_PRODUCTION_CONSUMER_KEY = "127smNEtFqugoT3Bf4MT1jRfLDcUhOChs1bIviqU74f8b829!4363442b507a4145336a394676564353465a705769673d3d";

    private $environment;

    public function __construct($environment)
    {
        $this->environment = $environment;
    }

    public function getPrivateKey()
    {
        $keystorePath = "";
        $keystorePassword = "";


        if ($this->environment == Environment::PRODUCTION)
        {
            $keystorePath = self::PRODUCTION_KEYSTORE_PATH;
            $keystorePassword = self::PRODUCTION_KEYSTORE_PASSWORD;
        }
        else
        {
            $keystorePath = self::SANDBOX_KEYSTORE_PATH;
            $keystorePassword = self::SANDBOX_KEYSTORE_PASSWORD;
        }


        $path = realpath($keystorePath);
        $keystore = array();
        $pkcs12 = file_get_contents($path);

        trim(openssl_pkcs12_read( $pkcs12, $keystore, $keystorePassword));
        return  $keystore['pkey'];
    }
}