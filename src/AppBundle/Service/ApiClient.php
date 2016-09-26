<?php

/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 26/09/2016
 * Time: 10:00
 */
namespace AppBundle\Service;

use AppBundle\Exceptions\ThirdPartyResponseException;
use JMS\Serializer\Serializer;
use Psr\Log\LoggerAwareTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * This Service is an API Client for the JSONPlaceholder Fake Online REST API
 *
 * Class ApiClient
 * @package AppBundle\Service
 */
class ApiClient
{
    use LoggerAwareTrait;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var string
     */
    protected $apiBaseUrl;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * ApiClient constructor.
     * @param Serializer $serializer
     * @param $apiBaseUrl
     */
    public function __construct(Serializer $serializer, $apiBaseUrl)
    {
        $this->serializer = $serializer;
        $this->apiBaseUrl = $apiBaseUrl;
        $this->httpClient  = $this->getHttpClient();
    }

    /**
     * @param array $ids
     * @param int $limit
     * @param int $page
     * @param array $e
     * @return mixed
     */
    public function getPosts($ids = [35, 48, 91, 150])
    {
        $p = array(
            "id" => $ids
        );
        $q = $this->buildQuery($p);
        $response = $this->request('GET', "/posts?{$q}");
        $data = $this->serializer->deserialize($response, 'array<AppBundle\Model\Post>', 'json');

        return $data;
    }

    /**
     * @return Client
     */
    protected function getHttpClient()
    {
        if (!($this->httpClient instanceof Client)) {
            $this->httpClient = new Client(
                array(
                    'base_uri' => $this->apiBaseUrl
                )
            );
        }

        return $this->httpClient;
    }

    /**
     * @param Response $response
     *
     * @return Response
     * @throws ThirdPartyResponseException
     */
    protected function getResponse(Response $response)
    {
        $code   = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK

        if ($code !== 200) {
            throw new ThirdPartyResponseException(sprintf('%s() 3rd Party API response exception: %s', __METHOD__, $reason));
        }

        return $response;
    }

    /**
     * @param Response $response
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getContent(Response $response)
    {
        $content = $response->getBody()->getContents();

        return $content;
    }

    /**
     * @param $queryParams
     */
    protected function buildQuery($queryParams = array())
    {
        return http_build_query($queryParams);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $headers
     * @param string $body
     *
     * @return Request
     */
    protected function request($method = 'GET', $uri = '', $headers = [], $body = '')
    {
        $headers = array_merge($headers, ['content-type' => 'application/json', 'content-length' => strlen($body)]);
        $request = new Request($method, $this->apiBaseUrl.$uri, $headers, $body);

        try {
            $response   = $this->httpClient->send($request, ['verify' => false]);
            $this->logger->debug(sprintf('[3rd Party API] [%s] %s', $request->getMethod(), $request->getUri()));
        } catch (ClientException $e) {
            throw new ThirdPartyResponseException($e->getMessage(), $e->getCode());
        }

        $response       = $this->getResponse($response);
        $content        = $this->getContent($response);

        return $content;
    }
}
