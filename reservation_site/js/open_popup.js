function open_popup(element) {
  element.style.display = "block";
  document.body.classList.add("blur");
  document.body.style.overflow = "hidden";

  document.addEventListener("keydown", (e) => close_on_esc(e, element));
}

function close_popup(element) {
  element.style.display = "none";
  document.body.classList.remove("blur");
  document.body.style.overflow = "";

  document.removeEventListener("keydown", (e) => close_on_esc(e, element));
}

function close_on_esc(e, element) {
  if (e.code == "Escape") {
    close_popup(element)
  }
}
