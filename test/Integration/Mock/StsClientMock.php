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

namespace TijsDriven\AlibabaCloud\Test\Integration\Mock;

use AlibabaCloud\SDK\Sts\V20150401\Models\AssumeRoleResponse;
use AlibabaCloud\SDK\Sts\V20150401\Sts;
use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Exception\TeaUnableRetryError;

class StsClientMock extends Sts
{

    protected array $response = [];
    protected bool $exception = false;
    protected ?int $exceptionCode;
    protected ?string $exceptionMessage;

    /**
     * @var StsClientMock|null
     */
    protected static StsClientMock|null $mock;

    public function __construct(
        array $config = []
    ) {
    }

    public static function getInstance($config = []): StsClientMock
    {
        if(empty(static::$mock)) {
            static::$mock = new StsClientMock($config);
        }
        return static::$mock;
    }
    public function assumeRoleWithOptions($request, $runtime)
    {
        if($this->exception) {
            throw new TeaUnableRetryError(new \AlibabaCloud\Tea\Request(), new TeaError([], $this->exceptionMessage, $this->exceptionCode));
        }
        return AssumeRoleResponse::fromMap($this->response);
    }

    public function setMockResponse(array $response): void
    {
        $this->response = $response;
    }

    public function setMockException(int $code, string $message)
    {
        $this->exception = true;
        $this->exceptionCode = $code;
        $this->exceptionMessage = $message;
    }

    public function reset()
    {
        $this->exception = false;
        $this->response = [];
        unset($this->exceptionCode);
        unset($this->exceptionMessage);
    }
}
