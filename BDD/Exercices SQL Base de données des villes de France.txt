Exercice BDD Requetes SQL :

1 : SELECT `ville_nom` 
FROM `villes_france_free` 
ORDER BY `ville_population_2012` DESC LIMIT 10;

2 : SELECT `ville_nom` 
FROM `villes_france_free` 
ORDER BY `ville_surface` ASC LIMIT 50;

3 : SELECT `ville_nom` 
FROM `departement` 
WHERE `departement_code`LIKE '97%';

4 : SELECT `ville_nom`,`departement_nom` 
FROM `villes_france_free`,`departement` 
WHERE `ville_departement`=`departement_code` 
ORDER BY `ville_population_2012` DESC LIMIT 10;

5 : SELECT ville_departement, departement_nom, 
COUNT(ville_commune) AS nb_communes,ville_code_commune 
FROM villes_france_free 
LEFT JOIN departement ON departement_code = ville_departement 
GROUP BY ville_departement 
ORDER BY nb_communes DESC;

6 : SELECT `departement_nom`, `ville_departement`, SUM(`ville_surface`) AS departement_surface 
FROM `villes_france_free` 
LEFT JOIN `departement` ON `departement_code` = `ville_departement` 
GROUP BY `ville_departement` 
ORDER BY `departement_surface` DESC LIMIT 10;

7 : SELECT COUNT(*) AS nombre_de_ville_en_Saint 
FROM `villes_france_free` 
WHERE `ville_nom` 
LIKE 'SAint%';

8 : SELECT `ville_nom`, COUNT(*) AS Nombre_de_ville 
FROM `villes_france_free` 
GROUP BY `ville_nom` 
ORDER BY Nombre_de_ville DESC;

9 : SELECT `ville_nom` 
FROM `villes_france_free` 
WHERE `ville_surface`> (SELECT AVG(`ville_surface`) 
                        FROM `villes_france_free`);

10 : SELECT ville_departement, SUM(`ville_population_2012`) AS population 
FROM `villes_france_free` 
GROUP BY `ville_departement` 
HAVING population > 2000000 
ORDER BY population DESC;

11 : UPDATE `villes_france_free` 
SET `ville_nom` = 'saint %' 
WHERE `ville_nom` 
LIKE 'saint-%'; 
(A NE PAS FAIRE)

11 : SELECT REPLACE (ville_nom,'-','')
FROM france_ville_free
WHERE ville_nom LIKE 'saint-%';



1 : Nombre d'habitants par Pays
SELECT p.nom_pays, SUM(v.habitants_ville) AS Nombre_Total_d_Habitants
FROM pays p
LEFT JOIN ville v ON p.id_pays = v.id_pays
GROUP BY p.nom_pays
ORDER BY Nombre_Total_d_Habitants DESC;

2 : Nombre de villes par Pays
SELECT p.nom_pays, COUNT(v.id_ville) AS Nombre_de_Villes
FROM pays p
LEFT JOIN ville v ON p.id_pays = v.id_pays
GROUP BY p.nom_pays
ORDER BY Nombre_de_Villes DESC;

3: Ville la plus grande
SELECT v.nom_ville, v.superficie_ville
FROM ville v
ORDER BY v.superficie_ville DESC LIMIT 1;

4 : 10 Villes les plus peuplées
SELECT v.nom_ville, v.habitants_ville
FROM ville v
ORDER BY v.habitants_ville DESC LIMIT 10;





























