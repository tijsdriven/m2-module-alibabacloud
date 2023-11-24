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

namespace TijsDriven\AlibabaCloud\Model\Config;

use Magento\Framework\App\DeploymentConfig;

class DeployConfig
{

    public const PATH_REGION = 'alibabacloud/region';
    public const PATH_CONNECTION_TYPE = 'alibabacloud/connection_type';
    public const PATH_ACCESS_KEY = 'alibabacloud/access_key';
    public const PATH_SECRET_KEY = 'alibabacloud/secret_key';
    public const PATH_ARN_ROLE = 'alibabacloud/arn_role';
    public const PATH_TOKEN_LIFETIME = 'alibabacloud/sts_token_lifetime';
    public const PATH_SESSION_NAME = 'alibabacloud/session_name';

    public function __construct(
        private DeploymentConfig $config,
        private Sts\Endpoint     $stsEndpoint
    )
    {
    }

    public function getStsEndpoint(): string
    {
        return $this->stsEndpoint->get(
            (string)$this->config->get(self::PATH_REGION),
            (string)$this->config->get(self::PATH_CONNECTION_TYPE)
        );
    }

    public function getRegion(): string
    {
        return (string)$this->config->get(self::PATH_REGION);
    }

    public function getConnectionType(): string
    {
        return (string)$this->config->get(self::PATH_CONNECTION_TYPE);
    }

    public function getAccessKey(): string
    {
        return (string)$this->config->get(self::PATH_ACCESS_KEY);
    }

    public function getSecretKey(): string
    {
        return (string)$this->config->get(self::PATH_SECRET_KEY);
    }

    public function getArnRole(): string
    {
        return (string)$this->config->get(self::PATH_ARN_ROLE);
    }

    public function getTokenLifetime(): string
    {
        return (string)$this->config->get(self::PATH_TOKEN_LIFETIME);
    }

    public function getSessionName(): string
    {
        return (string)$this->config->get(self::PATH_SESSION_NAME);
    }
}
