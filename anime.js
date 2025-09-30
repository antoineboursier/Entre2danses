$(document).ready(function () {
  var elementSets = [
    // $("div.cours-similaires a.cours-similaire-item"),
    // $("div.list_cards a.card"),
  ];

  elementSets.forEach(function (elements) {
    var maxHeight = 0;

    elements.each(function () {
      var itemHeight = $(this).outerHeight();
      if (itemHeight > maxHeight) {
        maxHeight = itemHeight;
      }
    });

    elements.css("height", maxHeight + "px");
  });
});
