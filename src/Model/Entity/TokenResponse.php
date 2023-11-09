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

namespace TijsDriven\AlibabaCloud\Model\Entity;

use Magento\Framework\DataObject;
use TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;

class TokenResponse extends DataObject implements TokenResponseInterface
{

    /**
     * @inheritDoc
     */
    public function setSuccess(bool $success): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
    {
        return $this->setData(self::SUCCESS, $success);
    }

    /**
     * @inheritDoc
     */
    public function getSuccess(): bool
    {
        return $this->getData(self::SUCCESS);
    }

    /**
     * @inheritDoc
     */
    public function setErrorMessage(?string $errorMessage): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
    {
        return $this->setData(self::ERROR_MESSAGE, $errorMessage);
    }

    /**
     * @inheritDoc
     */
    public function getErrorMessage(): ?string
    {
        return $this->getData(self::ERROR_MESSAGE);
    }

    /**
     * @inheritDoc
     */
    public function setAccessKeyId(?string $accessKeyId): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
    {
        return $this->setData(self::ACCESS_KEY_ID, $accessKeyId);
    }

    /**
     * @inheritDoc
     */
    public function getAccessKeyId(): ?string
    {
        return $this->getData(self::ACCESS_KEY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setAccessKeySecret(?string $accessKeySecret): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
    {
        return $this->setData(self::ACCESS_KEY_SECRET, $accessKeySecret);
    }

    /**
     * @inheritDoc
     */
    public function getAccessKeySecret(): ?string
    {
        return $this->getData(self::ACCESS_KEY_SECRET);
    }

    /**
     * @inheritDoc
     */
    public function setSecurityToken(?string $securityToken): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
    {
        return $this->setData(self::SECURITY_TOKEN, $securityToken);
    }

    /**
     * @inheritDoc
     */
    public function getSecurityToken(): ?string
    {
        return $this->getData(self::SECURITY_TOKEN);
    }

    /**
     * @inheritDoc
     */
    public function setExpiration(?string $expiration): \TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface
    {
        return $this->setData(self::EXPIRATION, $expiration);
    }

    /**
     * @inheritDoc
     */
    public function getExpiration(): ?string
    {
        return $this->getData(self::EXPIRATION);
    }
}
