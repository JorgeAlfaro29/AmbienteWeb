function enviarFormulario(event) {
    event.preventDefault(); // Evita el envío tradicional del formulario

    // Obtener datos del formulario
    const formData = new FormData(document.getElementById("contactForm"));

    // Enviar datos al servidor usando fetch
    fetch("backend/contacto.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (response.ok) {
            alert("Formulario enviado con éxito.");
            document.getElementById("contactForm").reset();
        } else {
            alert("Hubo un problema al enviar el formulario.");
        }
    })
    .catch(error => {
        console.error("Error al enviar el formulario:", error);
        alert("Error de conexión al servidor.");
    });
}

// Asociar la función al evento submit del formulario
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("contactForm").addEventListener("submit", enviarFormulario);
});