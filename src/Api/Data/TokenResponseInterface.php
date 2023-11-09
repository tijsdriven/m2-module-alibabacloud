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

namespace TijsDriven\AlibabaCloud\Api\Data;

interface TokenResponseInterface
{

    const SUCCESS = 'success';
    const ERROR_MESSAGE = 'error_message';
    const ACCESS_KEY_ID = 'access_key_id';
    const ACCESS_KEY_SECRET = 'access_key_secret';
    const SECURITY_TOKEN = 'security_token';
    const EXPIRATION = 'expiration';

    /**
     * @param bool $success
     * @return \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
     */
    public function setSuccess(bool $success): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;

    /**
     * @return bool
     */
    public function getSuccess(): bool;

    /**
     * @param string|null $errorMessage
     * @return \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
     */
    public function setErrorMessage(?string $errorMessage): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string;

    /**
     * @param string|null $accessKeyId
     * @return \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
     */
    public function setAccessKeyId(?string $accessKeyId): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;

    /**
     * @return string|null
     */
    public function getAccessKeyId(): ?string;

    /**
     * @param string|null $accessKeySecret
     * @return \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
     */
    public function setAccessKeySecret(?string $accessKeySecret): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;

    /**
     * @return string|null
     */
    public function getAccessKeySecret(): ?string;

    /**
     * @param string|null $securityToken
     * @return \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
     */
    public function setSecurityToken(?string $securityToken): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;

    /**
     * @return string|null
     */
    public function getSecurityToken(): ?string;

    /**
     * @param string|null $expiration
     * @return \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
     */
    public function setExpiration(?string $expiration): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;

    /**
     * @return string|null
     */
    public function getExpiration(): ?string;
}
