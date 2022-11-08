let deleteButtons = document.querySelectorAll('.deleteButton');

for (const button of deleteButtons) {
    let url = button.dataset.url;
    button.addEventListener("click", () =>{
        document.getElementById("deleteForm").action = url;
    })
}