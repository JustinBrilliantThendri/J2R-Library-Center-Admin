let cover = document.getElementById("cover");;
let change_cover = document.getElementById("change-cover");

change_cover.addEventListener("change", (e) => {
    let url = URL.createObjectURL(e.target.files[0]);
    cover.src = url;
})