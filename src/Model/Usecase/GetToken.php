<?php
/*
 * 2022-2023 Tijs Driven Development
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is available
 * through the world-wide-web at this URL: http://www.opensource.org/licenses/OSL-3.0
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to magento@tijsdriven.dev so a copy can be sent immediately.
 *
 * @author Tijs van Raaij
 * @copyright 2022-2023 Tijs Driven Development
 * @license http://www.opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace TijsDriven\AlibabaCloud\Model\Usecase;

use AlibabaCloud\Tea\Exception\TeaUnableRetryError;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;
use TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;
use TijsDriven\AlibabaCloud\Api\GetTokenInterface;
use TijsDriven\AlibabaCloud\Model\Factory\AssumeRoleRequestFactory;
use TijsDriven\AlibabaCloud\Model\Factory\RuntimeOptionsFactory;
use TijsDriven\AlibabaCloud\Model\Factory\StsClientFactory;
use TijsDriven\AlibabaCloud\Model\Factory\StsConfigFactory;
use TijsDriven\AlibabaCloud\Model\Entity\TokenResponseFactory;
use TijsDriven\AlibabaCloud\Model\Config\Context;
use function print_r;

class GetToken implements GetTokenInterface
{

    const DEFAULT_TOKEN_LIFETIME_IN_SECONDS = 3600;
    const CACHE_TAG = 'TIJSDRIVEN_ALIBABACLOUD_STS_TOKEN';

    public function __construct(
        protected StsClientFactory         $stsFactory,
        protected StsConfigFactory         $stsConfigFactory,
        protected AssumeRoleRequestFactory $roleRequestFactory,
        protected RuntimeOptionsFactory    $optionsFactory,
        protected TokenResponseFactory     $tokenResponseFactory,
        protected CacheInterface           $cache,
        protected DataObjectHelper         $dataObjectHelper,
        protected DataObjectProcessor      $objectProcessor,
        protected SerializerInterface      $serializer,
        protected Context                  $context,
        protected LoggerInterface          $logger
    )
    {
    }

    /**
     * @inheritDoc
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
    {
        $accessKey = $this->context->getAccessKey();
        $secretKey = $this->context->getSecretKey();
        $endpoint = $this->context->getEndpoint();
        $arn = $this->context->getRoleArn();
        $lifetime = $this->context->getTokenLifetime() ?: self::DEFAULT_TOKEN_LIFETIME_IN_SECONDS;

        if (empty($accessKey) ||
            empty($secretKey) ||
            empty($endpoint) ||
            empty($arn)
        ) {
            throw new LocalizedException(__('Config parameter(s) missing'), null, 500);
        }

        $response = $this->tokenResponseFactory->create();
        if ($this->cache->load(self::CACHE_TAG)) {
            $tokenData = $this->serializer->unserialize($this->cache->load(self::CACHE_TAG));
            $this->dataObjectHelper->populateWithArray($response, $tokenData, TokenResponseInterface::class);
            $response->setSuccess(true);
        } else {
            try {
                $config = $this->stsConfigFactory->create(
                    [
                        'accessKeyId' => $accessKey,
                        'accessKeySecret' => $secretKey,
                        'endpoint' => $endpoint
                    ]
                );
                $stsClient = $this->stsFactory->create($config);
                $assumeRoleRequest = $this->roleRequestFactory->create([
                    'roleArn' => $arn,
                    'roleSessionName' => $this->context->getSessionName(),
                    'durationSeconds' => $lifetime
                ]);
                $runtimeOptions = $this->optionsFactory->create();

                $tokenResponse = $stsClient->assumeRoleWithOptions($assumeRoleRequest, $runtimeOptions);
                $response->setSuccess(true);
                $response->setAccessKeyId($tokenResponse->body->credentials->accessKeyId);
                $response->setAccessKeySecret($tokenResponse->body->credentials->accessKeySecret);
                $response->setSecurityToken($tokenResponse->body->credentials->securityToken);
                $response->setExpiration($tokenResponse->body->credentials->expiration);

                $responseArray = $this->objectProcessor->buildOutputDataArray($response, TokenResponseInterface::class);
                $this->cache->save(
                    $this->serializer->serialize($responseArray),
                    self::CACHE_TAG,
                    [self::CACHE_TAG],
                    $lifetime - 10
                );
            } catch (TeaUnableRetryError $e) {
                $response->setSuccess(false);
                $response->setErrorMessage($e->getMessage());
                $this->logger->error(__METHOD__ . ' >> Alibabacloud error: ' . print_r($e->getMessage(), true) . ' (' . print_r($e->getCode(), true) . ')');
            } catch (\Exception $e) {
                $response->setSuccess(false);
                $response->setErrorMessage($e->getMessage());
                $this->logger->error(__METHOD__ . ' >> ' . print_r($e->getMessage(), true) . ' (' . print_r($e->getCode(), true) . ')');
            }
        }
        return $response;
    }
}
