let containers = document.querySelectorAll("#container");

setInterval(() => {
    containers.forEach((container) => {
        let code = container.getAttribute("data-code");
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4 && xhr.status == 200){
                container.innerHTML = xhr.responseText;
            }
        }
        xhr.open("get", `returned-date.php?code=${code}`, true);
        xhr.send();
    });
}, 1000);