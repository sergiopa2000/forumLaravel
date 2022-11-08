let comments = document.querySelectorAll(".comments");

for (const comment of comments) {
    let idPost = comment.dataset.post
    comment.addEventListener("click", () =>{
        document.getElementById("comments" + idPost).classList.toggle("hidden");
    })
}