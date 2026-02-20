# Localhost Development Environment

A robust, Docker-based local development workspace designed for PHP development. This setup orchestrates Nginx, PHP, MariaDB, PostgreSQL, and Redis services using Docker Compose.

## 🚀 Services

This workspace includes the following services:

- **Nginx**: `nginx:stable` - Web server listening on port `80`.
- **PHP**: Custom build from `./docker/images/php` - PHP FPM handler.
- **MariaDB**: `mariadb:10.11-ubi` - Database server exposed on port `3306`.
- **PostgreSQL**: `postgres:16-alpine` - Database server exposed on port `5432`.
- **Redis**: `redis:latest` - In-memory data structure store exposed on port `6379`.

## 📂 Directory Structure

```text
.
├── compose.yml          # Docker Compose configuration
├── docker/              # Docker images and volume configurations
│   ├── images/          # Dockerfiles for custom builds (e.g., PHP)
│   └── volumes/         # Configuration files mounted to containers
└── www/                 # Web root directory (source code goes here)
```

## 🛠️ Getting Started

### Prerequisites

- Docker
- Docker Compose

### Installation

1.  **Clone the repository**

    ```bash
    git clone <repository-url>
    cd <repository-name>
    ```

2.  **Configure Environment Variables**

    Create a `.env` file in the root directory to define your secrets. The following variables are required by `compose.yml`:

    ```ini
    MYSQL_ROOT_PASSWORD=secret
    MYSQL_ROOT_HOST=%
    POSTGRES_PASSWORD=secret
    ```

3.  **Start the Services**

    ```bash
    docker compose up -d
    ```

## 💻 Usage

- **Web Server**: Place your PHP projects inside the `www/` directory. Nginx is configured to serve from this location. Access your projects at `http://localhost`.
- **Databases**:
    - **MariaDB**: Connect via `127.0.0.1:3306`.
    - **PostgreSQL**: Connect via `127.0.0.1:5432`.
    - To connect to databases in containers, use the database containers' `hostname` declared in `compose.yml`
- **Redis**: Connect via `127.0.0.1:6379`.

## 🔧 Configuration

- **Nginx**: Configuration files are located in `./docker/volumes/nginx/conf.d`.
- **PHP**: Custom `php.ini` settings can be found in `./docker/volumes/php/conf.d`.
- **Data Persistence**: Database data is persisted in named Docker volumes (`mariadb-data` and `postgres-data`).

## 🌐 DNS Configuration

This setup is designed to work with **dnsmasq** to enable wildcard domain mapping. The Nginx configuration (`docker/volumes/nginx/conf.d/test.conf`) is set up to handle requests for `*.test` domains and map them to corresponding folders in the `www/` directory.

For example, accessing `http://project.test` will serve files from `www/project/public`.

To use this feature:

1.  **Install and configure dnsmasq** to resolve `*.test` to `127.0.0.1`.
2.  **Alternatively**, add entries to your `/etc/hosts` file for each project:

    ```text
    127.0.0.1 project.test
    127.0.0.1 another-project.test
    ```