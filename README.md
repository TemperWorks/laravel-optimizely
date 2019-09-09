A wrapper for the Optimizely SDK.

# Webhook
A webhook is exposed at POST /optimizely/webhook to be called by Optimizely when the configuration needs to be reloaded.

# Caching
The activate() call is cached to reduce usage of Optimizely impressions.

# Basic usage in TemperWeb
```
use Optimizely

...

$variant = Optimizely::activate($experimentName, Auth::user()->getRouteKey(), $params);
---- OR
$isFeatureEnabled = Optimizely::isFeatureEnabled($experimentName, Auth::user()->getRouteKey(), $params);

```
