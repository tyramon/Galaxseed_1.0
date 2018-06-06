USE `nains`;

#1 Trouver toutes les tavernes servant de la bière brune

SELECT *
FROM `taverne`
WHERE `t_brune`=1;




#2 Trouver tous les nains du groupe 2

SELECT *
FROM `nain`
WHERE `n_groupe_fk`=2;





#3 Trouver les horaires de travail du nain Kapabl (nain 13)

SELECT `g_debuttravail`, `g_fintravail`
FROM `groupe`
INNER JOIN `nain`
ON g_id = `n_groupe_fk`
WHERE `n_id` = 13;





#4 Trouver tout les nains qui boivent dans les tavernes de Svakungor (ville 1)

SELECT `n_id`, `n_nom`, `n_barbe`, `n_groupe_fk`, `n_ville_fk`
FROM `nain`
INNER JOIN `groupe`
ON `n_groupe_fk` = `g_id`
WHERE `g_taverne_fk` IN ( 
SELECT `taverne`.`t_id`
FROM `taverne`
INNER JOIN `ville`
ON `taverne`.`t_ville_fk` = `v_id`
WHERE `v_nom` = 'Svarkungor')
ORDER BY `n_id`;





#5 Trouver, pour toutes les tavernes, le nom de leur ville

SELECT `taverne`.`t_id`, `taverne`.`t_nom`, `t_chambres`, `t_blonde`, `t_brune`, `t_rousse`, `t_ville_fk`, `v_nom`
FROM `taverne`
INNER JOIN `ville`
ON `taverne`.`t_ville_fk` = `v_id`;




#6 Trouver tout les nains en vacances

SELECT `n_id`, `n_nom`, `n_barbe`, `n_groupe_fk`, `n_ville_fk`
FROM `nain` 
WHERE `n_groupe_fk` IS NULL;





#7  Trouver tout les nains qui viennent de la ville où La bonne pioche (taverne 7) est située

SELECT `n_id`, `n_nom`, `n_barbe`, `n_groupe_fk`, `n_ville_fk` 
FROM `nain` 
INNER JOIN `ville` 
ON `v_id` = `n_ville_fk` 
WHERE `n_ville_fk` IN ( 
SELECT `v_id` 
FROM `ville` 
INNER JOIN `taverne` 
ON `v_id` = `taverne`.`t_ville_fk` 
WHERE `taverne`.`t_id` = 7);




#8 Trouver tout les tunnels dont les travailleurs peuvent boire de la bière blonde

SELECT `tunnel`.`t_id`, `t_progres`, `t_villedepart_fk`, `t_villearrivee_fk`  
FROM `tunnel` 
INNER JOIN `groupe` 
ON `g_tunnel_fk` = `tunnel`.`t_id` 
INNER JOIN `taverne` 
ON `g_taverne_fk` = `taverne`.`t_id` 
WHERE `t_blonde` =1 
GROUP BY `tunnel`.`t_id`; 




#9 Trouver, pour toutes les tavernes, le nombre de nains y logeant

SELECT `taverne`.`t_id`, `taverne`.`t_nom`, `t_chambres`, `t_blonde`, `t_brune`, `t_rousse`, `t_ville_fk`, COUNT(`n_id`) AS nbNains 
FROM `taverne` 
LEFT JOIN `groupe` 
ON `g_taverne_fk` = `taverne`.`t_id` 
LEFT JOIN `nain` 
ON `n_groupe_fk` = `g_id` 
GROUP BY `taverne`.`t_id`;




#10 Trouver, pour toutes les tavernes, le nombre de chambres libres

SELECT `taverne`.`t_id`, `taverne`.`t_nom`, `t_chambres`, `t_blonde`, `t_brune`, `t_rousse`, `t_ville_fk`, (`t_chambres` - COUNT(`n_id`)) AS chambresLibres 
FROM `taverne` 
LEFT JOIN `groupe` 
ON `g_taverne_fk` = `taverne`.`t_id` 
LEFT JOIN `nain` 
ON `n_groupe_fk` = `g_id` 
GROUP BY `taverne`.`t_id`;

















SELECT taverne.t_nom 
FROM taverne 
WHERE t_ville_fk IN ( 
SELECT t_villedepart_fk, t_villearrivee_fk 
FROM tunnel 
INNER JOIN groupe 
ON tunnel.t_id=g_tunnel_fk 
WHERE g_id='3'); 































