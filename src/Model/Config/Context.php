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

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Context
{

    const CONFIG_GENERAL_ACCESS_KEY_ID = 'tijsdriven_alibabacloud/general/access_key_id';
    const CONFIG_GENERAL_ACCESS_KEY_SECRET = 'tijsdriven_alibabacloud/general/access_key_secret';
    const CONFIG_STS_TOKEN_ENDPOINT = 'tijsdriven_alibabacloud/sts_token/endpoint';
    const CONFIG_STS_TOKEN_ROLE_ARN = 'tijsdriven_alibabacloud/sts_token/role_arn';
    const CONFIG_STS_TOKEN_SESSION_NAME = 'tijsdriven_alibabacloud/sts_token/session_name';
    const CONFIG_STS_TOKEN_TOKEN_LIFETIME = 'tijsdriven_alibabacloud/sts_token/token_lifetime';

    public function __construct(
        protected ScopeConfigInterface $scopeConfig
    ) { }

    public function getAccessKey(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_GENERAL_ACCESS_KEY_ID, ScopeInterface::SCOPE_STORE);
    }

    public function getSecretKey(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_GENERAL_ACCESS_KEY_SECRET, ScopeInterface::SCOPE_STORE);
    }

    public function getEndpoint(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_STS_TOKEN_ENDPOINT, ScopeInterface::SCOPE_STORE);
    }

    public function getRoleArn(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_STS_TOKEN_ROLE_ARN, ScopeInterface::SCOPE_STORE);
    }

    public function getSessionName(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_STS_TOKEN_SESSION_NAME, ScopeInterface::SCOPE_STORE);
    }

    public function getTokenLifetime(): ?string
    {
        return $this->scopeConfig->getValue(self::CONFIG_STS_TOKEN_TOKEN_LIFETIME, ScopeInterface::SCOPE_STORE);
    }
}
