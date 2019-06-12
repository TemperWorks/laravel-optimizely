A wrapper for the Optimizely SDK.

# Webhook
A webhook is exposed at POST /optimizely/webhook to be called by Optimizely when the configuration needs to be reloaded.

# Caching
The activate() call is cached to reduce usage of Optimizely impressions. This drastically reduces the cost in the usage of Optimizely.