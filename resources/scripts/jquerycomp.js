$(() => {
  let $fav = $("#fav"),
    $must = $("#must");
  let fav = $fav[0],
    must = $must[0];
  var availableTags = [
    "Pulp Fiction",
    "Forrest Gump",
    "Solaris",
    "Stalker",
    "Seven Samurai",
    "Taxi Driver",
    "Twin Peaks",
    "Mulholland Drive",
    "Blue Velvet",
    "Kill Bill",
    "Clockwork Orange",
    "Goodfellas",
    "The Good the Bad and the Ugly",
    192,
  ];
  $([fav, must]).autocomplete({
    source: availableTags,
  });
});
if (window.innerWidth >= 750) {
  $(function () {
    $(document).tooltip();
  });
}
