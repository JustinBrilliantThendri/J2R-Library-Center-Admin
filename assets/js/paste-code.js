let paste_button = document.getElementById("paste");
let kode_peminjaman = document.getElementById("kode-peminjaman")

paste_button.addEventListener("click", async () => {
    let code = await navigator.clipboard.readText();
    kode_peminjaman.value = code;
});