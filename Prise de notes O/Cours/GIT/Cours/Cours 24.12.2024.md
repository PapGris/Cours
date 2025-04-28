#CSS #GIT #commit

**CSS** :
BEM = block element modification, moyen de nommer les classes, et de les utiliser dans les balises HTML (ex : un "class=" ne peut être nommé qu'en fonction de son parent)

**commits conventionnels** : La spécification de Commits Conventionnels est une convention basique pour des messages de commit propres. Elle fournit un ensemble simple de règles pour créer un historique de commit explicite, ce qui facilite l’écriture d’outils automatisés. Cette convention suit [SemVer](http://semver.org/lang/fr/), en décrivant les fonctionnalités, les correctifs et les modifications importantes apportées aux messages de commit.
(wwwconventionalcommits.org)

Le message du commit doit être structuré comme suit :

---

```
<type>[étendue optionnelle]: <description>

[corps optionnel]

[pied optionnel]
```

Le commit contient les éléments structurels suivants, permettant de communiquer à l’intention des consommateurs de votre API :

1. **fix:** un commit de _type_ `fix` corrige un bogue dans le code (cela est en corrélation avec [`PATCH`](http://semver.org/#summary) en gestion sémantique de versions).
2. **feat:** un commit de _type_ `feat` introduit une nouvelle fonctionnalité dans le code (cela est en corrélation avec [`MINOR`](http://semver.org/#summary) en gestion sémantique de versions).
3. **BREAKING CHANGE:** un commit qui contient dans son _pied_ le mot-clé `BREAKING CHANGE:`, ou dont le _type_/_étendue_ est suffixé d’un `!`, introduit une rupture de compatibilité dans l’API (cela est en corrélation avec [`MAJOR`](http://semver.org/#summary) en gestion sémantique de versions). Un BREAKING CHANGE peut faire partie des commits de n’importe quel _type_.
4. Les _types_ autre que `fix:` et `feat:` sont autorisés; par exemple, [@commitlint/config-conventional](https://github.com/conventional-changelog/commitlint/tree/master/%40commitlint/config-conventional) (basé sur [the Angular convention](https://github.com/angular/angular/blob/22b96b9/CONTRIBUTING.md#-commit-message-guidelines)) recommande `build:`, `chore:`, `ci:`, `docs:`, `style:`, `refactor:`, `perf:`, `test:`, etc.
5. Les _pieds_ autres que `BREAKING CHANGE: <description>` peuvent être fournis et suivre une convention similaire à [git trailer format](https://git-scm.com/docs/git-interpret-trailers).



