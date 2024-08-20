document.addEventListener("DOMContentLoaded", function () {
  let acryliquesBtn = document.getElementById("acryliques");
  let aquarellesBtn = document.getElementById("aquarelles");
  let boutonActif = document.getElementById("boutonactif");
  let screenSize = window.screen.width;

  let allPeintures = [...document.getElementsByClassName("peinture")];
  let popupBg = document.getElementById("popup-bg");
  let popupImg = document.getElementById("popup-img");
  let popupContent = document.getElementById("popup-content");
  let nomPeinture = document.getElementById("nom-peinture");
  let dimensionsEtTechniquePeinture = document.getElementById(
    "technique-dimensions-peinture"
  );
  let ventePeinture = document.getElementById("vente-peinture");
  let supprimerPeinture = document.getElementById("supprimer-peinture");

  // Champ caché pour l'ID de la peinture dans la popup
  let peintureIdInput = document.getElementById("peinture_id");

  const checkboxes = document.querySelectorAll(
    '.filtre input[type="checkbox"]'
  );
  const peintures = document.querySelectorAll(".peinture");

  function filtrerPeintures() {
    const themesSelectionnes = Array.from(checkboxes)
      .filter((checkbox) => checkbox.checked)
      .map((checkbox) => checkbox.name);

    peintures.forEach((peinture) => {
      const themePeinture = peinture.dataset.theme;

      if (
        themesSelectionnes.length === 0 ||
        themesSelectionnes.includes(themePeinture)
      ) {
        peinture.classList.remove("hidden");
      } else {
        peinture.classList.add("hidden");
      }
    });
  }

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", filtrerPeintures);
  });

  filtrerPeintures(); // Appeler la fonction de filtrage au chargement de la page

  acryliquesBtn.addEventListener("click", () => {
    if (!acryliquesBtn.classList.contains("active")) {
      acryliquesBtn.classList.add("active");
      aquarellesBtn.classList.remove("active");
      boutonActif.style.transform = "translateX(0)";
    }

    allPeintures.forEach((peinture) => {
      let technique = peinture.dataset.technique;

      if (technique === "Acrylique" || technique === "Huile") {
        peinture.classList.remove("cacher");
      } else {
        peinture.classList.add("cacher");
      }
    });
  });

  aquarellesBtn.addEventListener("click", () => {
    if (!aquarellesBtn.classList.contains("active")) {
      aquarellesBtn.classList.add("active");
      acryliquesBtn.classList.remove("active");
      boutonActif.style.transform = "translateX(100%)";
    }

    allPeintures.forEach((peinture) => {
      let technique = peinture.dataset.technique;

      if (technique === "Aquarelle") {
        peinture.classList.remove("cacher");
      } else {
        peinture.classList.add("cacher");
      }
    });
  });

  const openPopup = (e) => {
    let peintureClicked = e.target.closest(".peinture");
    let clickedPeinture = peintureClicked.id;
    popupBg.classList.add("popup-active");
    popupImg.src = clickedPeinture;
    let nom = peintureClicked.dataset.nom;
    let dimensions = peintureClicked.dataset.dimensions;
    let technique = peintureClicked.dataset.technique;
    let vente = peintureClicked.dataset.vente;
    let id = peintureClicked.dataset.id;

    // Remplir le champ caché avec l'ID de la peinture
    peintureIdInput.value = id;

    nomPeinture.innerHTML = `${nom}`;
    dimensionsEtTechniquePeinture.innerHTML = `${technique}, ${dimensions}`;
    ventePeinture.innerHTML = `${vente}`;

    if (supprimerPeinture) {
      supprimerPeinture.setAttribute(
        "href",
        "supprimer-peinture.php?id=" + encodeURIComponent(id)
      );
    }
  };

  const closePopup = () => {
    popupBg.classList.remove("popup-active");
  };

  allPeintures.forEach((el) => el.addEventListener("click", openPopup));
  popupContent.addEventListener("click", (e) => e.stopPropagation());
  popupBg.addEventListener("click", closePopup);

  function supprimerHeaderBottom() {
    var monHeader = document.getElementById("header");
    if (window.innerWidth <= 950) {
      monHeader.classList.remove("header-bottom");
    } else {
      monHeader.classList.add("header-bottom");
    }
  }

  const menuToggle = document.querySelector(".burger");
  const navLinks = document.querySelector(".navlinks");
  const bodyHidden = document.querySelector(".body");

  menuToggle.addEventListener("click", () => {
    menuToggle.classList.toggle("active");
    navLinks.classList.toggle("mobile-menu");
    bodyHidden.classList.toggle("bodyactive");
  });

  function supprimerImageEntete() {
    let imageEntete = document.getElementById("imageentete");
    if (window.innerWidth <= 600) {
      imageEntete.classList.add("hidden");
    } else {
      imageEntete.classList.remove("hidden");
    }
  }

  window.onresize = function () {
    supprimerHeaderBottom();
    supprimerImageEntete();
  };

  window.onload = function () {
    acryliquesBtn.classList.add("active");
    aquarellesBtn.classList.remove("active");
    supprimerHeaderBottom();
    supprimerImageEntete();
  };

  window.addEventListener("resize", () => {
    screenSize = window.screen.width;
  });

  function exitMenu() {
    const lienMenu1 = document.getElementById("lien-menu1");
    const lienMenu2 = document.getElementById("lien-menu2");
    const lienMenu3 = document.getElementById("lien-menu3");

    [lienMenu1, lienMenu2, lienMenu3].forEach((lien) => {
      lien.addEventListener("click", () => {
        if (screenSize <= 780) {
          bodyHidden.classList.toggle("bodyactive");
        }
        menuToggle.classList.toggle("active");
        navLinks.classList.toggle("mobile-menu");
      });
    });
  }

  exitMenu();
});
