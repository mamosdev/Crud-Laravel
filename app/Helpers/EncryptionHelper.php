<?php

namespace App\Helpers;

class EncryptionHelper {
    public static function encrypt_str($data) {
        $key = "pelatihandisnaker";
        $cipher = "aes-256-cbc";
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
        $encrypted = openssl_encrypt($data, $cipher, $key, 0, $iv);
        return bin2hex($encrypted . '::' . $iv);
    }

    public static function decrypt_str($data) {
        $key = "pelatihandisnaker";
        $cipher = "aes-256-cbc";
        $decoded = hex2bin($data);
        list($encrypted_data, $iv) = explode('::', $decoded, 2);
        return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
    }
}
