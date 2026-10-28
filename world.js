document.addEventListener("DOMContentLoaded", function () {
    const button =document.getElementById('lookup');
    const button3 = document.getElementById('lookupcity');
    const country =document.getElementById('country');


    button.addEventListener("click", () => {
        
        const countryInput = country.value.trim();
        
        fetch("world.php?country=" + encodeURIComponent(countryInput))
        .then (response => {
            return response.text(); 
        })
        .then (data => {
            document.getElementById('result').innerHTML = data; 
        })

    })

    button3.addEventListener("click", () =>{
        const countryInput = country.value.trim();
        fetch("world.php?country=" + encodeURIComponent(countryInput) + "&lookup=cities")
        .then (response => {
            return response.text(); 
        })
        .then (data => {
            document.getElementById('result').innerHTML = data; 
        })

    })















});