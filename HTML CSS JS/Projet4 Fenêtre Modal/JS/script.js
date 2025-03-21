

document.getElementById("displayModal").addEventListener("click",function(){ //when the button is clicked, the modal will be displayed
    document.getElementById("modal").style.display="flex";  //display the modal
    document.querySelector("#modal > div").focus(); //  focus on the first element in the modal
});

document.getElementById("closeModal").addEventListener("click",function(){ //when the close button is clicked, the modal will be hidden
    document.getElementById("modal").style.display="none"; //hide the modal
});

document.getElementById("backModal").addEventListener("focus",function(){ //when the back button is focused, the focus will be on the close button
    document.querySelector("#modal > div").focus(); //focus on the close button
    
});                         