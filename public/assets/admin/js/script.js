function generatePDF()
{
    const element = document.getElementById("invoce");

    html2pdf()
    .from(element)
    .save();
}
