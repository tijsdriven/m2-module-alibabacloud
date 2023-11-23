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

namespace TijsDriven\AlibabaCloud\Model\Config\Sts;

use Magento\Framework\Exception\RuntimeException;

class Endpoint
{

    const ENDPOINTS = [
        'cn-qingdao' => [
            'external' => 'sts.cn-qingdao.aliyuncs.com',
            'internal' => 'sts-vpc.cn-qingdao.aliyuncs.com'
        ],
        'cn-beijing' => [
            'external' => 'sts.cn-beijing.aliyuncs.com',
            'internal' => 'sts-vpc.cn-beijing.aliyuncs.com'
        ],
        'cn-zhangjiakou' => [
            'external' => 'sts.cn-zhangjiakou.aliyuncs.com',
            'internal' => 'sts-vpc.cn-zhangjiakou.aliyuncs.com'
        ],
        'cn-huhehaote' => [
            'external' => 'sts.cn-huhehaote.aliyuncs.com',
            'internal' => 'sts-vpc.cn-huhehaote.aliyuncs.com'
        ],
        'cn-wulanchabu' => [
            'external' => 'sts.cn-wulanchabu.aliyuncs.com',
            'internal' => 'sts-vpc.cn-wulanchabu.aliyuncs.com'
        ],
        'cn-hangzhou' => [
            'external' => 'sts.cn-hangzhou.aliyuncs.com',
            'internal' => 'sts-vpc.cn-hangzhou.aliyuncs.com'
        ],
        'cn-shanghai' => [
            'external' => 'sts.cn-shanghai.aliyuncs.com',
            'internal' => 'sts-vpc.cn-shanghai.aliyuncs.com'
        ],
        'cn-nanjing' => [
            'external' => 'sts.cn-nanjing.aliyuncs.com',
            'internal' => 'sts-vpc.cn-nanjing.aliyuncs.com'
        ],
        'cn-fuzhou' => [
            'external' => 'sts.cn-fuzhou.aliyuncs.com',
            'internal' => 'sts-vpc.cn-fuzhou.aliyuncs.com'
        ],
        'cn-shenzhen' => [
            'external' => 'sts.cn-shenzhen.aliyuncs.com',
            'internal' => 'sts-vpc.cn-shenzhen.aliyuncs.com'
        ],
        'cn-heyuan' => [
            'external' => 'sts.cn-heyuan.aliyuncs.com',
            'internal' => 'sts-vpc.cn-heyuan.aliyuncs.com'
        ],
        'cn-guangzhou' => [
            'external' => 'sts.cn-guangzhou.aliyuncs.com',
            'internal' => 'sts-vpc.cn-guangzhou.aliyuncs.com'
        ],
        'cn-hongkong' => [
            'external' => 'sts.cn-hongkong.aliyuncs.com',
            'internal' => 'sts-vpc.cn-hongkong.aliyuncs.com'
        ],
        'ap-northeast-1' => [
            'external' => 'sts.ap-northeast-1.aliyuncs.com',
            'internal' => 'sts-vpc.ap-northeast-1.aliyuncs.com'
        ],
        'ap-northeast-2' => [
            'external' => 'sts.ap-northeast-2.aliyuncs.com',
            'internal' => 'sts-vpc.ap-northeast-2.aliyuncs.com'
        ],
        'ap-southeast-1' => [
            'external' => 'sts.ap-southeast-1.aliyuncs.com',
            'internal' => 'sts-vpc.ap-southeast-1.aliyuncs.com'
        ],
        'ap-southeast-2' => [
            'external' => 'sts.ap-southeast-2.aliyuncs.com',
            'internal' => 'sts-vpc.ap-southeast-2.aliyuncs.com'
        ],
        'ap-southeast-5' => [
            'external' => 'sts.ap-southeast-5.aliyuncs.com',
            'internal' => 'sts-vpc.ap-southeast-5.aliyuncs.com'
        ],
        'ap-southeast-7' => [
            'external' => 'sts.ap-southeast-7.aliyuncs.com',
            'internal' => 'sts-vpc.ap-southeast-7.aliyuncs.com'
        ],
        'cn-wuhan-lr' => [
            'external' => 'sts.cn-wuhan-lr.aliyuncs.com',
            'internal' => 'sts-vpc.cn-wuhan-lr.aliyuncs.com'
        ],
        'us-east-1' => [
            'external' => 'sts.us-east-1.aliyuncs.com',
            'internal' => 'sts-vpc.us-east-1.aliyuncs.com'
        ],
        'us-west-1' => [
            'external' => 'sts.us-west-1.aliyuncs.com',
            'internal' => 'sts-vpc.us-west-1.aliyuncs.com'
        ],
        'eu-west-1' => [
            'external' => 'sts.eu-west-1.aliyuncs.com',
            'internal' => 'sts-vpc.eu-west-1.aliyuncs.com'
        ],
        'eu-central-1' => [
            'external' => 'sts.eu-central-1.aliyuncs.com',
            'internal' => 'sts-vpc.eu-central-1.aliyuncs.com'
        ],
        'ap-south-1' => [
            'external' => 'sts.ap-south-1.aliyuncs.com',
            'internal' => 'sts-vpc.ap-south-1.aliyuncs.com'
        ],
        'me-east-1' => [
            'external' => 'sts.me-east-1.aliyuncs.com',
            'internal' => 'sts-vpc.me-east-1.aliyuncs.com'
        ],
        'cn-hangzhou-finance' => [
            'external' => 'sts.aliyuncs.com'
        ],
        'cn-shanghai-finance-1' => [
            'external' => 'sts.cn-shanghai-finance-1.aliyuncs.com',
            'internal' => 'sts-vpc.cn-shanghai-finance-1.aliyuncs.com'
        ],
        'cn-shenzhen-finance-1' => [
            'external' => 'sts.aliyuncs.com',
            'internal' => 'sts-vpc.cn-shenzhen-finance-1.aliyuncs.com'
        ],
        'cn-beijing-finance-1' => [
            'external' => 'sts.cn-beijing-finance-1.aliyuncs.com',
            'internal' => 'sts-vpc.cn-beijing-finance-1.aliyuncs.com'
        ],
    ];

    /**
     * @throws \Magento\Framework\Exception\RuntimeException
     */
    public function get(string $region, string $type): string
    {
        if (!isset(self::ENDPOINTS[$region]) || !isset(self::ENDPOINTS[$region][$type])) {
            throw new RuntimeException(__('Invalid region or connection type configured.'));
        }

        return self::ENDPOINTS[$region][$type];
    }
}
