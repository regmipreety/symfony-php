<h3>Getting Started</h3>
1. If not already done, install Docker Compose (v2.10+)</br>
2. Run docker compose build --no-cache to build fresh images</br>
3. Run docker compose up --pull always -d --wait to set up and start a fresh Symfony project</br>
4. Open https://localhost in your favorite web browser and accept the auto-generated TLS certificate</br>
5. Run docker compose down --remove-orphans to stop the Docker containers.</br>
<h4>To rebuild Docker containers</h4></hr>
* docker-compose down</br>
* docker-compose up --build</br>
<p>To check logs of a specific container: <b>docker-compose logs database(container_name)
</b></p></br>
<h4>Basics of Symfony</h4>

* A fresh symfony project consists of 6 main folders: bin, config, public, src, var and vendor. We as developers mainly work in src folder which contains controller, entity and repository. The source folder, SRC for short, is the place where the programming logic is located. This is where we put our PHP controllers and thus our PHP code. In the src folder we will mainly work to create and program the different controllers and entities. The views are stored in the Templates folder, which is not yet created, because we have to install the template engine first. <br>
<p> Routes in Symfony </p><br>
* Routes can be configured in YAML, XML, PHP or using 'Annotations'. All formats provide the same functionality, you can take your pick. Symfony recommends 'Annotations' as it is convenient to have the route and controller in the same place in the code