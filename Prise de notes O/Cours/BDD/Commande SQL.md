#BDD #SQL

Table = Tableau --> lignes + colonnes --> Represente une entité [Collection d'objets]
Une table ne peut contenir qu'un seul type de donnée

MySQL / MariaDB 
(SGBDR) Système de gestion de Bases de Données Relationnelles

# SQL SELECT

L’utilisation la plus courante de SQL consiste à lire des données issues de la base de données. Cela s’effectue grâce à la commande SELECT, qui retourne des enregistrements dans un tableau de résultat. Cette commande peut sélectionner une ou plusieurs colonnes d’une table.

SELECT *
FROM table 
WHERE condition
     LIKE 'a%','%a' ou '%a%' (commence, fini ou contient a)
GROUP BY expression
HAVING condition
{ UNION | INTERSECT | EXCEPT }
ORDER BY expression
LIMIT count
OFFSET start
DESC LIMIT `[nombre]`

## Commande basique

L’utilisation basique de cette commande s’effectue de la manière suivante:

SELECT nom_du_champ FROM nom_du_tableau

Cette requête SQL va **sélectionner** (SELECT) le champ “nom_du_champ” **provenant** (FROM) du tableau appelé “nom_du_tableau”.



==CREER UNE BASE DE DONNEE== :
CREATE DATABASE `[NOM_PRENOM]`
->
-> ;

use `[NOM_PRENOM]`
mysql>


==CREER UNE TABLE== :
CREATE TABLE utilisateur (
   -> id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, *(AUTO_INCREMENT important pour ne pas oublier l'id)*
  ->  nom VARCHAR(50),
  ->  prenom VARCHAR(50),
  ->  email VARCHAR(50)
  -> );

==ATTENTION== !!! En cas d'oubli d'id, il faudra recommencer TOUTE la table ! 
Supprimer la TABLE = DROP TABLE utilisateur;

Afficher le tableau + selectionner dans la table
SELECT * FROM utilisateur; 

[[Drawing 2025-01-06 08.40.58.excalidraw]]





