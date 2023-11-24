## Summary

Base module for AlibabaCloud support in Magento 2. This module adds basic scaffolding for configuring AlibabaCloud
account information and it adds a mechanism to get and store STS tokens that can be used when consuming different
AlibabaCloud service APIs.

## Installation & Configuration
Install using composer
```
composer require tijsdriven/m2-module-alibabacloud
```

## Configuration
Add the following config to  `app/code/env.php`. Make sure to set up AlibabaCloud RAM user and proper permissions
and access according to AlibabaCloud documentation. The STS token can then be used to connect to different services,
for example OSS. Make sure your services run in the same AlibabaCloud region. 
```php 
'alibabacloud' => [
    'region' => 'ALIBABACLOUD_REGION',
    'connection_type' => 'external', // can be 'external' or 'internal' 
    'access_key' => 'ACCESS_KEY',
    'secret_key' => 'SECRET_KEY',
    'arn_role' => 'ARN_ROLE',
    'sts_token_lifetime' => '3600', 
    'session_name' => 'SESSION_NAME',
]
```

Or use the CLI `setup:config:set` command to configure module. Config options are:
- `--alibabacloud-region`
- `--alibabacloud-connection-type`
- `--alibabacloud-access-key`
- `--alibabacloud-secret-key`
- `--alibabacloud-arn`
- `--alibabacloud-token-lifetime`
- `--alibabacloud-session-name`

### Notes
* `region`: AlibabaCloud Region ID (for example: `eu-central-1`)
* `connection_type`: `external` for public endpoint, `internal` for private endpoint in internal network or VPC
* `access_key`: AlibabaCloud user account access key
* `secret_key`: AlibabaCloud user account secret
* `arn_role`: AlibabaCloud ARN assigned to user
* `sts_token_lifetime`: token lifetime in seconds
* `session_name`: unique session name used for identification

## Usage
Module handles process of requesting and refreshing token fully automatically. The token is stored in the Redis
cache 

## AlibabaCloud Resources
- [AlibabaCloud RAM](https://www.alibabacloud.com/help/en/ram/)
- [RAM + STS + OSS example](https://www.alibabacloud.com/help/en/oss/developer-reference/authorize-access-2)
