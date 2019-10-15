<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:26 16.08.2019
 */

namespace Daktela;

use GuzzleHttp\Client;

class Connection
{
    /**
     * @var Client|null
     */
    protected static $client = null;
    /**
     * @var string
     */
    protected static $subdomain;
    /**
     * @var string
     */
    protected static $accessToken;
    /**
     * @var string
     */
    protected static $version = 'v6';
    /**
     * @var []
     */
    protected static $params;

    public static function setSubDomain($subdomain)
    {
        self::$subdomain = $subdomain;
    }

    public static function setVersion($version)
    {
        self::$version = $version;
    }

    public static function setAccessToken($accessToken)
    {
        self::$accessToken = $accessToken;
    }

    public static function getClient()
    {
        if (is_null(self::$client)) {
            self::$client = new \GuzzleHttp\Client([
                'base_uri' => 'https://' . self::$subdomain . '.daktela.com/api/' . self::$version . '/'
            ]);
        }
        return self::$client;
    }

    /**
     * @param $uri
     * @return \Psr\Http\Message\ResponseInterface
     */
    public static function get($uri)
    {
        return self::getClient()->get($uri . '?' . self::queryParams());
    }

    public static function post($uri, $data)
    {
        return self::getClient()->post($uri . '?' . self::queryParams(), $data);
    }

    /**
     * @return string
     */
    public static function queryParams() : string
    {
        self::$params['accessToken'] = self::$accessToken;
        return http_build_query(self::$params);
    }
}