

document.getElementById("pseudo").addEventListener("keyup",function(){
    this.classList.remove("error");
    let formData = new FormData();
    formData.append("pseudo",this.value);
    fetch("checkPseudoJson.php",{
        method:"POST",
        body:formData
    })
    .then(response => response.json())
    .then(data => { 
        if(data['status']=="succes") {
            console.log("Déjà pris par "+data["data"]["user_name"]);
            this.classList.add("error");
        }              
    });
});