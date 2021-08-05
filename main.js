/* const prijsSchetsOntwerp = event => {
    document.getElementById('prijs-schets-ontwerp').value = event.target.value;
}; */

function totaalSchetsOntwerp() {
    d = document.getElementById("dienst1").value;
    document.getElementById("SchetsOntwerpPrijs").innerHTML = d;
}

function totaalVoorlopigOntwerp() {
    d = document.getElementById("dienst2").value;
    document.getElementById("voorlopigOntwerpPrijs").innerHTML = d;
}

function totaalUitvoeringOntwerp() {
    d = document.getElementById("dienst3").value;
    document.getElementById("uitvoeringOntwerpPrijs").innerHTML = d;
}
