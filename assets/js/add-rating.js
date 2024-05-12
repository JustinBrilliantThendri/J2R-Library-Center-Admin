let minus_rating = document.getElementById("minus-rating");
let show_rating = document.getElementById("show-rating");
let plus_rating = document.getElementById("plus-rating");

minus_rating.addEventListener("click", () => {
    if(show_rating.value > 0){
        show_rating.value = (Number(show_rating.value) - 0.1).toFixed(1);
    }
})

plus_rating.addEventListener("click", () => {
    if(show_rating.value < 5){
        show_rating.value = (Number(show_rating.value) + 0.1).toFixed(1);
    }
})