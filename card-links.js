document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".card").forEach(function (card) {
    if (card.closest(".sidebar")) return;
    const links = Array.from(card.querySelectorAll("a[href]")).filter(a => !a.closest(".sidebar"));
    const hrefs = [...new Set(links.map(a => a.href))];
    if (hrefs.length !== 1 || card.querySelector("form")) return;
    card.classList.add("card-clickable");
    card.setAttribute("role", "link");
    card.setAttribute("tabindex", "0");
    card.addEventListener("click", function (event) {
      if (event.target.closest("a,button,input,textarea,select,label")) return;
      window.location.href = hrefs[0];
    });
    card.addEventListener("keydown", function (event) {
      if ((event.key === "Enter" || event.key === " ") && !event.target.closest("a,button,input,textarea,select,label")) { event.preventDefault(); window.location.href = hrefs[0]; }
    });
  });
});
