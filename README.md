# Summary
Base module for AlibabaCloud support in Magento 2. This module adds basic scaffolding for configuring AlibabaCloud
account information and it adds a mechanism to get and store STS tokens that can be used when consuming different
AlibabaCloud service APIs.

# Installation & Configuration
Install using composer
```
composer require tijsdriven/m2-module-alibabacloud
```

Configure in Magento by adding the AlibabaCloud account credentials, ARN and endpoint. Optionally, set the 
token lifetime.

# Usage
Module handles process of requesting and refreshing token fully automatically. The token is stored in the Redis
cache 
