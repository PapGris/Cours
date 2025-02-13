#PHP


Affichage : 

```php
echo "Hello World.";
print_r($tableau);
var_dumb($variable);
die;
```

Type :

```PHP
$nom = "Jean";  string
$age = 25;  integer
$price = 2 . 5;  float
$is0pen = true; boolean
```


On peut y mettre de l'HTML, exemple :


```php
echo "<h1>Bienvenue</h1>";
```


Concaténation :

```php
echo "<h1>Bienvenue $name</h1>";
```

Structures de controle :

```php
if ($name == "Jean") {
   echo "Utilisateur enregistré";
} else {
  echo "Utilisateur inconnu";
} 
```

autres exemples :

![[Pasted image 20250212095313.png]]

![[Pasted image 20250212095211.png]]



Tableaux :

```PHP
$fruits = ["Pomme", "Banane", "Orange"];
```
Tableaux associatifs :
```PHP
$user = ["nom" => "Alice", "age" =>25];
```

Boucles :

```PHP
for ($i = 0; $i < 5; $i++) {
	echo $i;
}

foreach ($fruits as $fruit) {
	echo $fruit;
}
```

Fonctions :

```PHP
function saluer($nom) {
	return "Bonjour, $nom!";
}
```

```PHP
function increaseStock($meubles)
{
	foreach ($meubles as $meuble) {
		$meuble['stock']++;
	}
}
```

Fonctions natives

```PHP
<?php
echo strlen("Bonjour");
echo strtloupper("php");
```







