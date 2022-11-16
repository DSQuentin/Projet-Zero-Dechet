# Projet Zéro Déchet
Ce projet est un projet de site web de fin de deuxième année de notre DUT Informatique.

## Table des matières
1.  [Objectif du site](#objectif)
2.  [Comment démarrer le projet ?](#comment-demarrer)
    1.  [Installer Composer](#composer)
    2.  [Executer Composer](#composer-exec)
    3.  [Création de la base de donnée](#create-db)
    4.  [Lancement du projet](#launch)



## Objectif du site <a name="objectif"></a>
Ce site à pour objectif de tester les compétences que nous avons acquises tout au long de notre
formation. Que ce soit nos compétences en informatique ou bien en gestion de projet.  
Il s'agit d'un site qui dans le cadre du recyclage et du zéro déchet, mets en 
relation des personnes souhaitant se débarrasser de ce qui les encombres ou dont ils
n'ont plus besoin. Les utilisateurs peuvent alors effectué des échanges gratuitement.

## Quelles technologies ?
Ce projet a été développé entièrement en PHP avec l'aide du framework Symfony pour le back.
Nous avons utilisé une base de donnée MySql.
Pour le front, nous avons utilisé le framework CSS TailwindCSS.

## Comment démarrer le projet ? <a name="comment-demarrer"></a>
Nous avons développé notre projet avec le langage PHP. Pour démarrer notre projet vous devez
donc posséder PHP avec une version >= à 7.4.

Notre projet fonctionne avec Composer qui est un logiciel de dépendance libre écrit en PHP.
Il permet notamment de déclarer et d'installer des bibliothèques dont le projet à besoin.
Il faut donc l'installer pour que le projet fonctionne.

### Installer composer <a name="composer"></a>
En premier lieu, il faut télécharger composer. Vous trouverez ici : https://getcomposer.org/download/ 
le lien pour le télécharger. Suivez la procédure d'installation qui vous est indiquée pour votre système d'exploitation.

### Executer composer <a name="composer-exec"></a>
Pour démarrer le projet sur votre machine, il vous suffit de récupérer les fichiers.
Ensuite, il faut récupérer les fichiers composés. Pour cela, dans un terminal dans le dossier du projet, on exécute la commande suivante :
* composer install 

### Création de la base de donnée  <a name="create-db"></a>
Il faut maintenant créer la base de données et y injecter les données. Tout d'abord, il faut modifier les informations de connexions à MySQL. 
Dans le fichier .env, il faut modifier la ligne *DATABASE_URL=mysql://root:root@127.0.0.1:3306/database*.  
Le premier root correspond au nom d'utilisateur, le second au mot de passe. 
Ensuite on peut donne un nom a notre base de données a la place de "database".
Enfin, on exécute les commandes suivantes :
* php bin/console doctrine:database:create
* php bin/console make:migration
* php bin/console doctrine:migrations:migrate
* php bin/console doctrine:fixtures:load

### Lancement du projet <a name="launch"></a>
Le projet est près à être utilisé. Il n'y a plus qu'à exécuter la commande :
* php -S localhost:8000 -t public

Dans un navigateur, on accède au lien http://localhost:8000/ et voilà !

