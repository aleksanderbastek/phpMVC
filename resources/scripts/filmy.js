function favfilm() {
  let favmovie = document.getElementById("fav").value;
  localStorage.favfilm = favmovie;
  let result = document.getElementById("rfav");
  result.innerHTML = "Moj ulubiony film to " + localStorage.favfilm;
}
function mustfilm() {
  let mustmovie = document.getElementById("must").value;
  sessionStorage.mustsee = mustmovie;
  let resultSession = document.getElementById("rms");
  resultSession.innerHTML =
    "Film ktory musze obejrzec  " + sessionStorage.mustsee;
}
function favfilmol() {
  let result = document.getElementById("rfav");
  if (localStorage.favfilm)
    result.innerHTML = "Moj ulubiony film to " + localStorage.favfilm;
  else result.innerHTML = "Nie wybrano ulubionego";
  let resultSession = document.getElementById("rms");
  if (sessionStorage.mustsee)
    resultSession.innerHTML =
      "Film ktory musze obejrzec " + sessionStorage.mustsee;
  else resultSession.innerHTML = "Nie wybrano";
}

function addTable() {
  let c, r, t;
  let l = [
    { title: "Tytuł", rating: "Ocena" },
    { title: "The Shawshank Redemption", rating: "9.2" },
    { title: "The Godfather", rating: "9.1" },
    { title: "The Dark Knight", rating: "9.0" },
    { title: "12 Angry Men", rating: "8.9" },
    { title: "Schindler's List", rating: "8.9" },
    { title: "The Lord of the Rings: The Return of the King", rating: "8.9" },
    { title: "Pulp Fiction", rating: "8.8" },
  ];
  t = document.createElement("table");
  for (let i = 0; i < l.length; i++) {
    r = t.insertRow(i);
    c = r.insertCell(0);
    c.innerHTML = l[i].title;
    c = r.insertCell(1);
    c.innerHTML = l[i].rating;
  }
  document.getElementById("addtable").appendChild(t);
}

$(window).load(() => {
  if (document.getElementById("addtable")) addTable();
  if (document.getElementById("interaction"))
    document.getElementById("interaction").style.visibility = "visible";
});
