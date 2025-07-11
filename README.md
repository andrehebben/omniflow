# Omniflow

Omniflow is a Dockerized PHP service that synchronizes tasks, habits and projects across multiple productivity platforms such as Todoist, Habitica, YouTrack, GitHub, Hardcover, Home Assistant and Google Calendar.

The GitHub integration creates matching YouTrack projects, keeps issues in sync and mirrors milestone releases. Synchronization state is persisted so the process can recover if it falls out of sync.

## Requirements
- Docker
- PHP 8.3 (for local development)
- Composer

## Installation
```bash
composer install
cp .env.example .env
```

Fill in the `.env` file with your API keys and preferences.
`SYNC_STATE_FILE` stores the path for tracking the last sync time so the service can resume if it becomes out of sync.

## Running
### Docker
Build the Docker image and run the container:
```bash
docker build -t omniflow ./docker
```
The container sets up a cron job based on `SYNC_INTERVAL_MINUTES` to run the sync service.

### Local
To run the sync manually:
```bash
php src/Util/CronRunner.php
```

## Tests
Run unit tests using PHPUnit:
```bash
composer test
```

## Folder Structure
```
/src
  /Api          API clients for external services
  /Sync         Sync services orchestrating the workflow
  /Model        Domain models
  /Util         Utilities such as logging and cron runner
/tests          PHPUnit tests
/docker         Dockerfile and cron configuration
```
