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

namespace TijsDriven\AlibabaCloud\Test\Integration\Model\Usecase;

use Magento\Framework\Exception\LocalizedException;
use PHPUnit\Framework\TestCase;
use TijsDriven\AlibabaCloud\Api\Data\TokenResponseInterface;
use TijsDriven\AlibabaCloud\Api\GetTokenInterface;
use TijsDriven\AlibabaCloud\Test\Integration\Mock\StsClientMock;

class GetTokenTest extends TestCase
{
    protected \Magento\Framework\ObjectManagerInterface|null $objectManager = null;

    protected GetTokenInterface|null $getToken = null;

    /** @setUp */
    public function setUp(): void {
        $this->objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        StsClientMock::getInstance()->reset();

        $this->getToken = $this->objectManager->create(GetTokenInterface::class);
    }

    /**
     * @test
     */
    public function missingConfig_throwsException() {
        $this->expectException(LocalizedException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Config parameter(s) missing');

        $this->getToken->execute();
    }

    /**
     * @test
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/general/access_key_id some-id-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/general/access_key_secret some-secret-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/sts_token/endpoint some-endpoint-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/sts_token/role_arn some-arn-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/sts_token/session_name some-session-name-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/sts_token/token_lifetime 1234
     */
    public function alibabaCloudReturnsError() {
        StsClientMock::getInstance()->setMockException(400, 'InvalidParameter.DurationSeconds');

        $result = $this->getToken->execute();

        $this->isInstanceOf(TokenResponseInterface::class);
        $this->assertFalse($result->getSuccess());
        $this->assertEquals('InvalidParameter.DurationSeconds', $result->getErrorMessage());
        $this->assertNull($result->getAccessKeyId());
        $this->assertNull($result->getAccessKeySecret());
        $this->assertNull($result->getExpiration());
        $this->assertNull($result->getSecurityToken());
    }

    /**
     * @test
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/general/access_key_id some-id-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/general/access_key_secret some-secret-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/sts_token/endpoint some-endpoint-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/sts_token/role_arn some-arn-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/sts_token/session_name some-session-name-123
     * @magentoConfigFixture current_store tijsdriven_alibabacloud/sts_token/token_lifetime 1234
     */
    public function alibabaCloudReturnsToken() {
        StsClientMock::getInstance()->setMockResponse([
            'body' => [
                'RequestId' => '123',
                'AssumedRoleUser' => [
                    'AssumedRoleId' => '123',
                    'Arn' => '123',
                ],
                'Credentials' => [
                    'AccessKeyId' => 'test-access-key-id',
                    'AccessKeySecret' => 'test-access-key-secret',
                    'Expiration' => 'test-expiration',
                    'SecurityToken' => 'test-security-token',
                ]
            ]
        ]);

        $result = $this->getToken->execute();

        $this->isInstanceOf(TokenResponseInterface::class);
        $this->assertTrue($result->getSuccess());
        $this->assertNull($result->getErrorMessage());
        $this->assertEquals('test-access-key-id', $result->getAccessKeyId());
        $this->assertEquals('test-access-key-secret', $result->getAccessKeySecret());
        $this->assertEquals('test-expiration', $result->getExpiration());
        $this->assertEquals('test-security-token', $result->getSecurityToken());
    }
}
