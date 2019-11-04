<?php
/**
 * @author Bc. Marek Fajfr <mfajfr90(at)gmail.com>
 * Created at: 10:26 16.08.2019
 */

namespace Daktela;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Connection
{
    /**
     * @var Client|null
     */
    protected static $client = null;
    /**
     * @var Client|null
     */
    protected static $baseClient = null;
    /**
     * @var string
     */
    public static $subdomain;
    /**
     * @var string
     */
    public static $accessToken;
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

    public static function getBaseClient()
    {
        if (is_null(self::$baseClient)) {
            self::$baseClient = new \GuzzleHttp\Client([
                'base_uri' => 'https://' . self::$subdomain . '.daktela.com/'
            ]);
        }
        return self::$baseClient;
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
     * @param array $params
     * @return ResponseInterface
     */
    public static function get($uri, $params = [])
    {
        return self::getClient()->get($uri . '?' . self::queryParams($params));
    }

    public static function post($uri, $data)
    {
        return self::getClient()->post($uri . '?' . self::queryParams(), $data);
    }

    /**
     * @param array $params
     * @return string
     */
    public static function queryParams($params = []) : string
    {
        return http_build_query(['accessToken' => self::$accessToken] + $params);
    }
}