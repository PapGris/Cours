1. Obtenir l’utilisateur ayant le prénom “Muriel” et le mot de passe “test11”, sachant que l’encodage du mot de passe est effectué avec l’algorithme Sha1.

SELECT `prenom`,SHA1('test11')
FROM client
WHERE `prenom` = 'muriel';

2. Obtenir la liste de tous les produits qui sont présent sur plusieurs commandes.

SELECT nom, COUNT(*) AS nbr_produits 
FROM `commande_ligne` 
GROUP BY nom 
HAVING nbr_produits > 1
ORDER BY nbr_produits DESC;

3. Obtenir la liste de tous les produits qui sont présent sur plusieurs commandes et y ajouter une colonne qui liste les identifiants des commandes associées.

SELECT nom, COUNT(*) AS nbr_produits, GROUP_CONCAT(`commande_id`) 
FROM `commande_ligne` 
GROUP BY nom 
HAVING nbr_produits > 1
ORDER BY nbr_produits DESC;

4. Enregistrer le prix total à l’intérieur de chaque ligne des commandes, en fonction du prix unitaire et de la quantité

UPDATE commande_ligne
SET prix_total = quantite*prix_unitaire;

5. Obtenir le montant total pour chaque commande et y voir facilement la date associée à cette commande ainsi que le prénom et nom du client associé

SELECT client.prenom, client.nom, commande.date_achat, commande_id, ROUND(SUM(prix_total), 2) AS prix_commande 
FROM commande_ligne 
LEFT JOIN commande ON commande.id = commande_ligne.commande_id
LEFT JOIN client ON client.id = commande.client_id
GROUP BY commande_id;

6. (difficulté très haute) Enregistrer le montant total de chaque commande dans le champ intitulé “cache_prix_total”

UPDATE commande AS t1 
INNER JOIN 
    ( SELECT commande_id, SUM(commande_ligne.prix_total) AS p_total 
      FROM commande_ligne 
      GROUP BY commande_id ) t2 
          ON  t1.id = t2.commande_id 
SET t1.cache_prix_total = t2.p_total

7. Obtenir le montant global de toutes les commandes, pour chaque mois

8. Obtenir la liste des 10 clients qui ont effectué le plus grand montant de commandes, et obtenir ce montant total pour chaque client.

9. Obtenir le montant total des commandes pour chaque date

10. Ajouter une colonne intitulée “category” à la table contenant les commandes. Cette colonne contiendra une valeur numérique

11. Enregistrer la valeur de la catégorie, en suivant les règles suivantes :
  “1” pour les commandes de moins de 200€
  “2” pour les commandes entre 200€ et 500€
  “3” pour les commandes entre 500€ et 1.000€
  “4” pour les commandes supérieures à 1.000€

12. Créer une table intitulée “commande_category” qui contiendra le descriptif de ces catégories

13. Insérer les 4 descriptifs de chaque catégorie au sein de la table précédemment créée

14. Supprimer toutes les commandes (et les lignes des commandes) inférieur au 1er février 2019. Cela doit être effectué en 2 requêtes maximum