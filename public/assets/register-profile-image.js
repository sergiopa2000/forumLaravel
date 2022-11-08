let circles = document.querySelectorAll('.rounded-circle');

for (const circle of circles) {
    let url = circle.getAttribute('src');
    circle.addEventListener("click", () =>{
        deleteClassToAll();
        circle.classList.add('selected')
        
        document.getElementById('registerImg').value = url;
        console.log(document.getElementById('registerImg').value);
    })
}

function deleteClassToAll(){
    let circles = document.querySelectorAll('.rounded-circle');
    for (const circle of circles) {
        circle.classList.remove("selected");
    }
}