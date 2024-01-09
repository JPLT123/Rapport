<!-- public/download-page-pdf.html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page avec Bouton de Téléchargement PDF</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script></head>
<body>
    <h1>Contenu de votre page</h1>
    <!-- Ajoutez le bouton de téléchargement PDF -->
    <button onclick="downloadPDF()">Télécharger en tant que PDF</button>

    <script>
        function downloadPDF() {
            // Créez une instance de jsPDF
            const doc = new jsPDF();

            // Ajoutez le contenu de la page au PDF
            doc.text("Hello world!", 10, 10);

            // Téléchargez le PDF avec le nom "ma-page.pdf"
            doc.save('ma-page.pdf');
        }
    </script>
</body>
</html>


