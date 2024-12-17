document.addEventListener('DOMContentLoaded', function() {
    fetch('backend/get_centros.php')
        .then(response => response.json())
        .then(data => {
            let centrosList = document.getElementById('centros-list');
            data.forEach(centro => {
                let div = document.createElement('div');
                div.innerHTML = `
                    <h4>${centro.Direccion}</h4>
                    <p>${centro.Provincia}</p>
                `;
                centrosList.appendChild(div);
            });
        })
        .catch(error => console.log('Error:', error));
});
