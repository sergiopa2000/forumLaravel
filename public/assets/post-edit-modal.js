/*let editButton = document.querySelectorAll('.editButton');

for (const button of editButton) {
    let url = button.dataset.url;
    let title = button.dataset.title;
    let message = button.dataset.message;
    button.addEventListener("click", () =>{
        document.getElementById("editPostForm").action = url;
        document.getElementById("title").value = title;
        document.getElementById("message").innerHTML = message;
    })
}*/

(function () {

    $(document).on('show.bs.modal','#editPostModal', function (event) {
        console.log("cargado");
        let button = event.relatedTarget;
        let url = button.dataset.url;
        let title = button.dataset.title;
        let message = button.dataset.message;
        
        
        document.getElementById("editPostForm").action = url;
        document.getElementById("title").value = title;
        document.getElementById("message").innerHTML = message;
    });

})();