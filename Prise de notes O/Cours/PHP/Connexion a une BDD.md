#BDD #PHP 


![[Pasted image 20250225102933.png]]


![[Pasted image 20250225102948.png]]


1. Préparation de la requête SQL :

  - $pdo->prepare(...) : Prépare une requête SQL paramétrée pour une insertion dans la table booking.

  - (:beginDate, :endDate, :nbRooms, :userId, :price) : Ce sont des paramètres nommés (placeholders), qui seront remplacés par de vraies valeurs plus tard.

2. Association des paramètres avec les valeurs :

  - bindParam(':nom_du_paramètre', $variable) : Associe chaque paramètre nommé à une variable PHP.
  
  - Chaque appel bindParam assure que lorsque la requête s'exécute, la valeur contenue dans $variable est utilisée.

3. Exécution de la requête :

  - execute() envoie la requête préparée avec les valeurs associées pour l'exécuter dans la base de données.

**Pourquoi utiliser PDO et des requêtes préparées ?**
Sécurité accrue : Protège contre les injections SQL en séparant la structure SQL des données.
Performance : Une requête préparée peut être réutilisée plusieurs fois avec différentes valeurs.
Lisibilité et maintenabilité : Le code est plus organisé et modifiable facilement.

ex:
![[Pasted image 20250225103001.png]]


![[Pasted image 20250225103013.png]]

