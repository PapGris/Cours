document.getElementById("btn").addEventListener("click",function(){
    let h1 = document.querySelector("h1");
    if (h1.innerText == "Bonjour") {
        h1.innerText = "Hello World !";
        h1.classList.remove("error");
    h1.classList.toggle("error");
}
else {
    h1.innerText = "Bonjour"
    h1.classList.add("error");
}
});

document.getElementById("btn").addEventListener("click",function(){
    let li = document.createElement("li");
    let text = document.createTextNode("test");
    li.appendChild(text);
    document.getElementById("list").appendChild(li);
});