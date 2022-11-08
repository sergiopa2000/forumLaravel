let newComment = document.querySelectorAll(".newComment");

for (const btn of newComment) {
    let idPost = btn.dataset.post;
    btn.addEventListener("click", () =>{
        document.getElementById("idPost").value = idPost;
    })
}