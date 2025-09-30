$(document).ready(function () {
  function positionnerBackground(rattachement, taille1, taille2, emplacement) {
    // Sélectionner les éléments cibles
    var elementsCibles = $(rattachement);

    // Parcourir chaque élément cible
    elementsCibles.each(function () {
      var elementCible = $(this);

      // Créer une nouvelle div pour le fond d'écran
      var sparklesDiv = $("<div>")
        .attr("id", "sparkles-" + elementCible.attr("id"))
        .addClass("sparkles")
        .attr("aria-hidden", "true")
        .attr("tabindex", "-1");

      // Vérifier l'emplacement et ajouter la classe appropriée
      if (emplacement === "left") {
        sparklesDiv.addClass("left");
      }

      // Insérer la nouvelle div après la balise <main>
      $("main").after(sparklesDiv);

      // Positionner la div sparkles par rapport à l'élément cible
      var cibleOffset = elementCible.offset();
      var cibleTop = cibleOffset.top;

      // Définir la position de la div sparkles en fonction de l'emplacement
      var sparklesRight = emplacement === "right" ? "0" : "auto";
      var sparklesLeft = emplacement === "left" ? "0" : "auto";

      // Fonction pour ajuster la taille de la div sparkles en fonction de la largeur de l'écran
      function ajusterTailleSparkles() {
        var largeurFenetre = $(window).width();
        var sparklesWidth;

        if (largeurFenetre < 1000) {
          sparklesWidth = (parseFloat(taille2) / 100) * largeurFenetre;
        } else {
          sparklesWidth = (parseFloat(taille1) / 100) * largeurFenetre;
        }

        var sparklesHeight = sparklesWidth; // Hauteur égale à la largeur

        // Appliquer les styles CSS pour la div sparkles
        sparklesDiv.css({
          top: cibleTop + "px",
          width: sparklesWidth + "px",
          height: sparklesHeight + "px",
          right: sparklesRight,
          left: sparklesLeft,
        });
      }

      // Appeler la fonction d'ajustement de taille au chargement de la page
      ajusterTailleSparkles();

      // Appeler la fonction d'ajustement de taille à chaque changement de taille de la fenêtre
      $(window).resize(ajusterTailleSparkles);
    });
  }

  // Appeler la fonction avec les valeurs appropriées
  positionnerBackground("div#deroulement", 50, 100, "left");
  positionnerBackground("section#principale", 50, 120, "right");
});
