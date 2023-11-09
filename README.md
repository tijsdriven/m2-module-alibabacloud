# Summary
Adds support for AlibabaCloud STS token to Magento to use for authentication with various AlibabaCloud services 
such as OSS.

# Installation & Configuration
Install using composer
```
composer require tijsdriven/m2-module-alibabacloud
```

Configure in Magento by adding the AlibabaCloud account Access Key ID and Access Key Secret. 
Optionally, set the token lifetime.

# Usage
Module handles process of requesting and refreshing token fully automatically. The token is stored in the Redis
cache.
