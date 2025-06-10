<?php
declare(strict_types=1);
namespace App\Classes\Flitt;
/**
 * Class Signature
 * @package Ipsp
 */
class Signature {
    /**
     * @params string $password
     */
    private static string $password;
    /**
     * @params string $merchant
     */
    private static string $merchant;

    public static function setPassword(): void
    {
        $secretKey = config('flitt.secret_key');
        if (!is_string($secretKey) || empty($secretKey)) {
            throw new \InvalidArgumentException('Invalid or missing secret key configuration');
        }
        self::$password = $secretKey;
    }

    public static function setMerchant(): void
    {
        $merchantId = config('flitt.merchant_id');
        if (!is_string($merchantId) || empty($merchantId)) {
            throw new \InvalidArgumentException('Invalid or missing merchant id configuration');
        }
        self::$merchant = $merchantId;
    }

    /**
     * Generate request params signature
     * @param array $params
     * @return string
     */
    public static function generate(Array $params): string
    {
        $params['merchant_id'] = self::$merchant;
        $params = array_filter($params,'strlen');
        ksort($params);
        $params = array_values($params);
        array_unshift( $params , self::$password );
        $params = join('|',$params);
        return(sha1($params));
    }

    public static function generateString(Array $params): string
    {
        $params['merchant_id'] = self::$merchant;
        $params = array_filter($params,'strlen');
        ksort($params);
        $params = array_values($params);
        array_unshift( $params , self::$password );
        return join('|',$params);
    }

    /**
     * Sign params with signature
     * @param array $params
     * @return array
     */
    public static function sign(array $params): array
    {
        if(array_key_exists('signature',$params)) return $params;
        $params['signature'] = self::generate($params);
        return $params;
    }
    /**
     * Clean array params
     * @param array $data
     * @return array
     */
    public static function clean(array $data): array
    {
        if( array_key_exists('response_signature_string',$data) )
            unset( $data['response_signature_string'] );
        unset( $data['signature'] );
        return $data;
    }
    /**
     * Check response params signature
     * @param array $response
     * @return bool
     */
    public static function check(array $response)
    {
        if(!array_key_exists('signature',$response)) return false;
        $signature = $response['signature'];
        $response  = self::clean($response);
        return $signature == self::generate($response);
    }
}
