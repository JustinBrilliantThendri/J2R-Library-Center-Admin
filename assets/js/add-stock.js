let minus_stock = document.getElementById("minus-stock");
let show_stock = document.getElementById("show-stock");
let plus_stock = document.getElementById("plus-stock");

minus_stock.addEventListener("click", () => {
    if(show_stock.value > 1){
        show_stock.value = parseInt(show_stock.value) - 1;
    }
})

plus_stock.addEventListener("click", () => {
    show_stock.value = parseInt(show_stock.value) + 1;
})