# Projet Zéro Déchets
Ce projet est un projet de site web de fin de deuxième année de notre DUT Informatique.

## Participants
Pour ce projet, nous sommes en groupe de 5 composés de :  
Malo Miquel (Chef de projet)  
Quentin Da Silva  
Dariusz Nowakowski  
Quentin Filliette  
Cyprien Ferrand

## Objectif du site
Ce site à pour objectif de tester les compétences que nous avons acquises tout au long de notre
formation. Que ce soit nos compétences en informatique ou bien en gestion de projet.  
Il s'agit d'un site qui dans le cadre du recyclage et du zéro déchet, mets en 
relation des personnes souhaitant se débarrasser de ce qui les encombres ou dont ils
n'ont plus besoin. Les utilisateurs peuvent alors effectué des échanges gratuitement.

## Comment démarrer le projet ?
Notre projet fonctionne avec Composer qui est un logiciel de dépendance libre écrit en PHP.
Il permet notamment de déclarer et d'installer des bibliothèques dont le projet à besoin.
Il faut donc l'installer pour que le projet fonctionne.
Vous trouverez dans ce lien : https://getcomposer.org/doc/00-intro.md la démarche à suivre pour l'installer.

Puis, pour démarrer le projet sur votre machine, il vous suffit de récupérer les fichiers.
Ensuite, il faut récupérer les fichiers composés. Pour cela, dans un terminal dans le dossier du projet, on exécute la commande suivante :
* composer install 

Il faut maintenant créer la base de données et y injecter les données. Tout d'abord, il faut modifier les informations de connexions à MySQL. Dans le fichier .env, il faut modifier la ligne DATABASE_URL=mysql://root:root@127.0.0.1:3306/database. Le premier root correspond au nom d'utilisateur, le second au mot de passe. 
Ensuite on peut donne un nom a notre base de données a la place de "database".
Enfin, on exécute les commandes suivantes :
* php bin/console doctrine:database:create
* php bin/console make:migration
* php bin/console doctrine:migrations:migrate
* php bin/console doctrine:fixtures:load

Le projet est près d'être utilisé. Il n'y a plus qu'à exécuter la commande :
* php -S localhost:8000 -t public

Dans un navigateur, on accède au lien http://localhost:8000/ et voilà !

