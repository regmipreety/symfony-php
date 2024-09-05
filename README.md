<h3>Getting Started</h3>
1. If not already done, install Docker Compose (v2.10+)
2. Run docker compose build --no-cache to build fresh images
3. Run docker compose up --pull always -d --wait to set up and start a fresh Symfony project
4. Open https://localhost in your favorite web browser and accept the auto-generated TLS certificate
5. Run docker compose down --remove-orphans to stop the Docker containers.
<h4>To rebuild Docker containers</h4>
* docker-compose down
* docker-compose up --build