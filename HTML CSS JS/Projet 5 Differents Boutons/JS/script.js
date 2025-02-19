document.querySelectorAll(".addCart").forEach(function(button){
        button.addEventListener("click", function(){
            console.log(this.closest("article").querySelector("h3").innerText);
            console.log(this.getAttribute("data-id"));
        });
});


let cart = [];

document.querySelectorAll(".addCart").forEach(button => {
    button.addEventListener("click", function() {
        let articleName = this.closest("article").querySelector("h3").innerText;
        let articleId = this.getAttribute("data-id");
        
        let item = cart.find(item => item.id === articleId);
        if (item) {
            item.quantity++;
        } else {
            cart.push({ id: articleId, name: articleName, quantity: 1 });
        }
        updateCart();
    });
})
function updateCart() {
    let cartList = document.getElementById("cart");
    cartList.innerHTML = "";
    cart.forEach(item => {
        let li = document.createElement("li");
        li.innerText = `${item.name} (x${item.quantity})`;
        cartList.appendChild(li);
    });
}