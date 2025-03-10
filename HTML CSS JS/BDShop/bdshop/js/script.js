// AJOUT AU PANIER :


let cart = []; // Ici, une variable cart est initialisée comme un tableau vide. Cette variable va servir à stocker les articles ajoutés au panier (chaque article sera un objet contenant des informations comme l'ID, le nom, la quantité, et l'image).

document.querySelectorAll(".addToCart").forEach(button => { // document.querySelectorAll(".addToCart") sélectionne tous les éléments HTML de la page ayant la classe .addToCart (qui, dans ce cas, sont les boutons "ajouter au panier").
// .forEach(button => { ... }) parcourt chaque bouton et ajoute un écouteur d'événement click. Cela signifie que, chaque fois qu'un utilisateur clique sur l'un des boutons, la fonction à l'intérieur de addEventListener sera exécutée.
    button.addEventListener("click", function() {
        let articleName = this.closest("article").querySelector("h3").innerText; // this.closest("article") : this fait référence au bouton cliqué. La méthode closest("article") permet de remonter dans le DOM jusqu'à l'élément article qui est l'élément parent du produit.
        //querySelector("h3").innerText : Cela récupère le texte du titre du produit (nom) qui se trouve dans un élément <h3> à l'intérieur de cet article.
        let articleId = this.getAttribute("data-id"); // this.getAttribute("data-id") : Cette ligne récupère l'attribut data-id du bouton, qui est supposé être l'identifiant unique du produit.
        let articleImage = this.closest("article").querySelector("img").getAttribute("src"); // this.closest("article").querySelector("img").getAttribute("src") : Cela récupère l'URL de l'image du produit à partir de l'élément <img> à l'intérieur de l'article.

        let item = cart.find(item => item.id === articleId); // cart.find(item => item.id === articleId) : Cette ligne vérifie si l'article est déjà dans le panier. Elle recherche dans le tableau cart un article ayant le même id que l'ID du produit ajouté.
        if (item) {
            item.quantity++; // Si un article est trouvé (c'est-à-dire que item n'est pas undefined), la quantité de cet article est incrémentée de 1 (item.quantity++).
        } else {
            cart.push({ id: articleId, name: articleName, quantity: 1, image: articleImage }); // Si l'article n'est pas encore dans le panier (item est undefined), un nouvel objet est ajouté au tableau cart avec l'ID, le nom, la quantité initiale (1), et l'image du produit.
        }
        updateCart(); // Après avoir ajouté ou mis à jour l'article dans le panier, la fonction updateCart() est appelée pour mettre à jour l'affichage du panier sur la page.
    });
})

function updateCart() {
    let cartList = document.getElementById("cart"); // let cartList = document.getElementById("cart"); : Cette ligne récupère l'élément HTML qui va afficher le panier. On suppose qu'il existe un élément avec l'ID cart dans le HTML.
    cartList.innerHTML = ""; // cartList.innerHTML = ""; : Avant de mettre à jour l'affichage, on vide le contenu de l'élément cart pour ne pas dupliquer les articles à chaque mise à jour.
    
    cart.forEach(item => { // cart.forEach(item => { ... }) : Pour chaque article dans le panier (cart), on crée un élément <li> qui va afficher les informations de l'article.
        let li = document.createElement("li"); // let li = document.createElement("li"); : Crée un élément <li> pour chaque article.
        li.classList.add("cart-item"); // li.classList.add("cart-item"); : Ajoute une classe CSS cart-item à l'élément <li>, permettant ainsi de styliser chaque élément de panier.
        
        // Créer le contenu du panier : image + nom + quantité
        li.innerHTML = ` 
            <img src="${item.image}" alt="${item.name}">
            <span>${item.name} (x${item.quantity})</span>
        `; // li.innerHTML = \<img src="${item.image}" alt="${item.name}"> <span>${item.name} (x${item.quantity})</span>`;: L'HTML de l'élément<li>` est défini avec une image du produit et un texte affichant le nom et la quantité de l'article (exemple : "Nom (x2)").
        
        cartList.appendChild(li); // cartList.appendChild(li); : Enfin, l'élément <li> est ajouté à la liste du panier (cartList).
    });
}
