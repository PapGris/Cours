[[GIT Remote]]
#GIT #control

- ==git commit== : créer un commit
- ==git add== : ajouter un fichier, ajouter une modification de fichier, préparer le fichier a être committé
- ==git branch== : créer une branche 
    Possible de créer un branche plus en arriere en remontant les parents. 
    ex : git branch [nom branch2]  [nom branch1]^^ : Créer une branche [branch2]  sur le grand parent de [branch1]
- ==git checkout [nom]== : passer le HEAD sur le commit (ou la branche)
- ==git branch -d [nom]== : Delete la branche
- ==git checkout -b [nom]== :passer le HEAD dessus et créer une branche 
- ==git merge [nom]== : fusionner la branche 
- ==git rebase [nom]== : transférer vers la branche (peut aussi être git rebase [nom]  [nom] : transfert vers [nom] la branche [nom])
- ==git checkout [nom]^ (ou ^^)== : passer le HEAD sur le premier parent du [nom] (ou grand parent) (possible avec HEAD directement, plutôt que [nom])
- ==git checkout HEAD~[nombre]== : reculer le HEAD de x [nombre]
- ==git branch -f [nom] HEAD~[nombre]== : réassigner une branche a un commit précèdent ([nombre])
- ==git reset== : annule le changement en délaçant la ref en arrière sur un précédent commit (fonctionne pour le locale)
- ==git revert== : annuler un changement, et le partager avec d'autres (fonctionne donc en distanciel)
- ==git cherry-pick [commit1]  [commit2]  [etc..]== : copier une sélections de commit sur une branche (ou le HEAD est présent)
- ==git rebase -i HEAD~[nombre]== : Ouvrir un interface avec le [nombre] de commit, pour les sélectionner et les réorganiser
- ==git commit --amend== : effectuer une modification sur le commit
- ==git tag [nom du tag]  [nom du commit]== : Marquer un commit avec un tag en tant qu'"étape clé". 
    Non modifiable ou retour arrière impossible sur un commit tagué. Les tags marquent à jamais certains commits comme "milestone" (étape clé) auxquels vous pouvez vous référer comme à des branches. Encore plus important, ils sont définitifs. Vous ne pouvez donc pas rajouter de commit dans un tag : les tags sont un peu comme un pointeur définitif dans l'arbre des commits. Si vous ne spécifiez pas le commit, le tag pointera là où se trouve `HEAD`.
- ==git describe [nom]== : décrire le contenu jusqu'au tag le plus récent a partir du [nom]
      Git describe s'écrit comme suit :
      `git describe <ref>`

    où `<ref>` est n'importe quelle chose que Git peut résoudre en un commit. Si vous ne spécifiez pas de ref, `HEAD` est pris par défaut.

    Le résultat de la commande ressemble à :

    `<tag>_<numCommits>_g<hash>`

    où `tag` est le tag le plus proche dans l'historique, `numCommits` le nombre de commits appartenant au tag, et `<hash>` le hash/identifiant du commit décrit.
- 

- ==git show== : inventaire des modifications
- ==git log== : liste des commits


- ==cat== :

- ==git stash== : Mettre de coté le travail récupéré a distance, avant le push
  
