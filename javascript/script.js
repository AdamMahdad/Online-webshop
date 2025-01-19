const page1 = document.querySelector(".page-1");

window.addEventListener("scroll", () => {
    if (window.scrollY > 0) {
        page1.classList.remove("page-fade");
    } else {
        page1.classList.add("page-fade");
    }
});

document.getElementById("cards").onmousemove = e => {
    for(const card of document.getElementsByClassName("card")) {
      const rect = card.getBoundingClientRect(),
            x = e.clientX - rect.left,
            y = e.clientY - rect.top;
  
      card.style.setProperty("--mouse-x", `${x}px`);
      card.style.setProperty("--mouse-y", `${y}px`);
    };
  }
