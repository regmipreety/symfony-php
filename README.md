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
<h3>Basics of Symfony</h3>
* A fresh symfony project consists of 6 main folders: bin, config, public, src, var and vendor. We as developers mainly work in src folder which contains controller, entity and repository. The source folder, SRC for short, is the place where the programming logic is located. This is where we put our PHP controllers and thus our PHP code. In the src folder we will mainly work to create and program the different controllers and entities. The views are stored in the Templates folder, which is not yet created, because we have to install the template engine first. <br>
<p> Routes in Symfony </p>
* Routes can be configured in YAML, XML, PHP or using 'Annotations'. All formats provide the same functionality, you can take your pick. Symfony recommends 'Annotations' as it is convenient to have the route and controller in the same place in the code. <br>
<p>Databse in Symfony</p>
* Doctrine is usually implemented to handle database communication in Symfony. Doctrine is a framework that provides object-relational mapping capabilities and a database abstraction layer of PHP. With Doctrine, simplified access to different database types is possible than would be feasible with pure PHP. Database queries can be formulated in Doctrine's own intermediate language, Doctrine Query Language (DQL). <br>
* In Symfony, entities are called Entity. Each entity is mapped as a table in our database. So, an entity lives both as a model in our application and as a table in the database. First we have to create this new entity with "php bin/console make:entity". The individual fields and types are also determined. The Entity Manager manages the models and serves as an interface to the database. $em = $this->getDOctrine()->getManager();<br>
* For each entity we create, Symfony automatically creates a repository for us. A repository is effectively a file with a collection of read-made queries. You can also create your own queries for the database here. The predefined functions for each entity are find, findOneBy, findBy and findAll.