#GIT #control #remote

- ==git clone== : créé un dépôt locale d'un dépôt distants (qui s'appellera origin/main (ou origin/[nom]))
- ==git fetch== : rapporter des données depuis un dépôt distant vers notre dépôt
    `git fetch` procède en deux étapes principales, ni plus ni moins. Cela :

    - télécharge les commits que le dépôt distant possède mais qui ne sont pas dans le nôtre, puis...
    - met à jour nos branches distantes (par exemple, `o/main`).

    `git fetch` prend en fait notre représentation _locale_ du dépôt distant pour la synchroniser avec ce à quoi le dépôt distant ressemble _réellement_ (à ce moment-là).

    Si vous vous rappelez de la précédente leçon, nous avons dit que les branches distantes reflètent l'état du dépôt distant _depuis_ la dernière fois où vous avez parlé à ces branches distantes. `git fetch` est le moyen de parler à ces branches distantes ! La relation entre `git fetch` et les branches distantes devrait vous sembler claire maintenant.

    `git fetch` contacte le dépôt distant par Internet (via un protocole comme `http://` ou `git://`).
- ==git pull== : `git pull` est surtout un raccourci pour `git fetch` suivi d'un merge de toutes les branches qui viennent d'avoir un fetch. (git fetch; git rebase o/main (ou [nom]) = git pull)
