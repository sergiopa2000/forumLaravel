let editcommentButtons = document.querySelectorAll(".editButton");


for (const btn of editcommentButtons) {
    let idPost = btn.dataset.post;
    let url = btn.dataset.url;
    let message = btn.dataset.message;
    btn.addEventListener("click", () =>{
        document.getElementById("idPost").value = idPost;
        document.getElementById("editCommentForm").action = url;
        document.getElementById("message").innerHTML = message;
    })
}