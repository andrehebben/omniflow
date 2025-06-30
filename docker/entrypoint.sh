#!/bin/sh
set -e
CRON_INTERVAL="*/${SYNC_INTERVAL_MINUTES:-5} * * * *"
echo "$CRON_INTERVAL root cd /app && php src/Util/CronRunner.php >> /proc/1/fd/1 2>&1" > /etc/cron.d/omniflow
chmod 0644 /etc/cron.d/omniflow
crontab /etc/cron.d/omniflow
exec "$@"
