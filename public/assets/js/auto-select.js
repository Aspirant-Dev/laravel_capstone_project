// Map your choices to your option value
var lookup = {

    // Marilao Barangay Options
    'Marilao': [
        'Abangan Norte',
        'Abangan Sur',
        'Ibayo',
        'Lambakin',
        'Lias',
        'Loma de Gato',
        'Nagbalon',
        'Patubig',
        'Poblacion I',
        'Poblacion II',
        'Prenza I',
        'Prenza II',
        'Saog',
        'Sta. Rosa I',
        'Sta. Rosa II',
        'Tabing-Ilog'
    ],

    // Bocaue Barangay Options
    'Bocaue': [
        'Antipona',
        'Bagumbayan',
        'Bambang',
        'Batia',
        'Biñang 1st',
        'Biñang 2nd',
        'Bolacan',
        'Bundukan',
        'Bunlo',
        'Caingin',
        'Duhat',
        'Igulot',
        'Lolomboy',
        'Poblacion',
        'Sulucan',
        'Taal',
        'Tambobong',
        'Turo',
        'Wakas',
    ],

    // Meycauyan Barangay Options
    'Meycauayan': [
        'Bagbaguin',
        'Bahay Pare',
        'Bancal',
        'Banga',
        'Bayugo',
        'Caingin',
        'Calvario',
        'Camalig',
        'Hulo',
        'Iba',
        'Langka',
        'Lawa',
        'Libtong',
        'Liputan',
        'Longos',
        'Malhacan',
        'Pajo',
        'Pandayan',
        'Pantoc',
        'Perez',
        'Poblacion',
        'Saint Francis',
        'Saluysoy',
        'Tugatog',
        'Ubihan',
        'Zamora',
    ],
};
var lookup1 = {
    'Bocaue': ['3018'],
    'Marilao': ['3019'],
    'Meycauayan': ['3020'],
};

// When an option is changed, search the above for matching choices
$('#options').on('change', function() {
    // Set selected option as variable
    var selectValue = $(this).val();

    // Empty the target field
    $('#choices').empty();
    $('#pc').empty();

    // For each chocie in the selected option
    for (i = 0; i < lookup[selectValue].length; i++) {
        //Output choice in the target field
        $('#choices').append("<option value='" + lookup[selectValue][i] + "'>" + lookup[selectValue][i] + "</option>");
    }
    for (i = 0; i < lookup1[selectValue].length; i++) {
        // Output choice in the target field
        $('#pc').append("<option value='" + lookup1[selectValue][i] + "'>" + lookup1[selectValue][i] + "</option>");
    }
});