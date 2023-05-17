let images = document.getElementsByClassName("image")
let current = images.length-1;
let started = false;

window.addEventListener("scroll", start_animation);

function start_animation() {
  let text_div_bounds = document.getElementById("text_div").getBoundingClientRect();
  
  if (text_div_bounds.top < this.window.innerHeight) {
    started = true;
    window.removeEventListener("scroll", start_animation);
  }
}

check_started();

function check_started() {
  if (started) {
    change_image();
  } else {
    setTimeout(check_started, 200);
  }
}

function change_image() {
  images[current].style.display = "none";

  current++;
  if (current > images.length-1) {
    current = 0;
  }

  if (images[current].src == "") {
    images[current].src = images[current].dataset.src;
  }

  images[current].style.display = "block";

  setTimeout(change_image, 5000);
}