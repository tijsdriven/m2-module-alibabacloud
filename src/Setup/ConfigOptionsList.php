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

namespace TijsDriven\AlibabaCloud\Setup;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\Config\Data\ConfigData;
use Magento\Framework\Config\File\ConfigFilePool;
use Magento\Framework\Setup\ConfigOptionsListInterface;
use Magento\Framework\Setup\Option\TextConfigOption;
use TijsDriven\AlibabaCloud\Model\Config\DeployConfig;
use function var_dump;

class ConfigOptionsList implements ConfigOptionsListInterface
{
    const OPTION_ALIBABACLOUD_REGION = 'alibabacloud-region';
    const OPTION_ALIBABACLOUD_CONNECTION_TYPE = 'alibabacloud-connection-type';
    const OPTION_ALIBABACLOUD_ACCESS_KEY = 'alibabacloud-access-key';
    const OPTION_ALIBABACLOUD_SECRET_KEY = 'alibabacloud-secret-key';
    const OPTION_ALIBABACLOUD_ARN = 'alibabacloud-arn';
    const OPTION_ALIBABACLOUD_TOKEN_LIFETIME = 'alibabacloud-token-lifetime';
    const OPTION_ALIBABACLOUD_SESSION_NAME = 'alibabacloud-session-name';

    protected static $map = [
        self::OPTION_ALIBABACLOUD_REGION => DeployConfig::PATH_REGION,
        self::OPTION_ALIBABACLOUD_CONNECTION_TYPE => DeployConfig::PATH_CONNECTION_TYPE,
        self::OPTION_ALIBABACLOUD_ACCESS_KEY => DeployConfig::PATH_ACCESS_KEY,
        self::OPTION_ALIBABACLOUD_SECRET_KEY => DeployConfig::PATH_SECRET_KEY,
        self::OPTION_ALIBABACLOUD_ARN => DeployConfig::PATH_ARN_ROLE,
        self::OPTION_ALIBABACLOUD_TOKEN_LIFETIME => DeployConfig::PATH_TOKEN_LIFETIME,
        self::OPTION_ALIBABACLOUD_SESSION_NAME => DeployConfig::PATH_SESSION_NAME,
    ];

    /**
     * @inheritDoc
     */
    public function getOptions()
    {
        return [
            new TextConfigOption(
                self::OPTION_ALIBABACLOUD_REGION,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                DeployConfig::PATH_REGION,
                'AlibabaCloud region id',
                ''
            ),
            new TextConfigOption(
                self::OPTION_ALIBABACLOUD_CONNECTION_TYPE,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                DeployConfig::PATH_CONNECTION_TYPE,
                'AlibabaCloud connection ("external" or "internal")',
                ''
            ),
            new TextConfigOption(
                self::OPTION_ALIBABACLOUD_ACCESS_KEY,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                DeployConfig::PATH_ACCESS_KEY,
                'AlibabaCloud RAM user access key',
                ''
            ),
            new TextConfigOption(
                self::OPTION_ALIBABACLOUD_SECRET_KEY,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                DeployConfig::PATH_SECRET_KEY,
                'AlibabaCloud RAM user secret key',
                ''
            ),
            new TextConfigOption(
                self::OPTION_ALIBABACLOUD_ARN,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                DeployConfig::PATH_ARN_ROLE,
                'AlibabaCloud RAM user ARN',
                ''
            ),
            new TextConfigOption(
                self::OPTION_ALIBABACLOUD_TOKEN_LIFETIME,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                DeployConfig::PATH_TOKEN_LIFETIME,
                'AlibabaCloud STS token lifetime (in seconds)',
                ''
            ),
            new TextConfigOption(
                self::OPTION_ALIBABACLOUD_SESSION_NAME,
                TextConfigOption::FRONTEND_WIZARD_TEXT,
                DeployConfig::PATH_SESSION_NAME,
                'AlibabaCloud session name',
                ''
            ),

        ];
    }

    /**
     * @inheritDoc
     */
    public function createConfig(array $options, DeploymentConfig $deploymentConfig)
    {
//        $alibabaConfigExists = isset($deploymentConfig->getConfigData()['alibabacloud']);
//        if ($alibabaConfigExists && !isset($options['region'])) {
//            return [];
//        }

        $configData = new ConfigData(ConfigFilePool::APP_ENV);
        $configData->setOverrideWhenSave(true);

        foreach (self::$map as $option => $configPath) {
            if (!empty($options[$option])) {
                $configData->set($configPath, $options[$option]);
            }
        }

        return [$configData];
    }

    /**
     * @inheritDoc
     */
    public function validate(array $options, DeploymentConfig $deploymentConfig)
    {
        // deployment configuration existence determines readiness of object manager to resolve remote storage drivers
        $isDeploymentConfigExists = (bool)$deploymentConfig->getConfigData();

        if (!$isDeploymentConfigExists) {
            return [];
        }

        $errors = [];
        if (empty($options[self::OPTION_ALIBABACLOUD_REGION])) {
            $errors[] = 'Region is required';
        }

        if (empty($options[self::OPTION_ALIBABACLOUD_ACCESS_KEY])) {
            $errors[] = 'Access key is required';
        }

        if (empty($options[self::OPTION_ALIBABACLOUD_SECRET_KEY])) {
            $errors[] = 'Secret key is required';
        }

        if (empty($options[self::OPTION_ALIBABACLOUD_ARN])) {
            $errors[] = 'User ARN is required';
        }

        return $errors;
    }
}
