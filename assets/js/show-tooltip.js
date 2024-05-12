let tooltip_trigger_list = [].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']"));
let tooltip_list = tooltip_trigger_list.map((elm) => {
    return new bootstrap.Tooltip(elm);
});