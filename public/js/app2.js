
var search = instantsearch({
    // Replace with your own values
    appId: '6URACH1V5V',
    apiKey: '5a4da4475cf2e131f7c0d5821e06c807', // search only API key, no ADMIN key
    indexName: 'dev_events',
    urlSync: true,
    searchParameters: {
        hitsPerPage: 1000
    }
});


//SEARCH WIDGET

search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#search-input',
        magnifier: false,    /** supprime l'icone recherche **/
        reset:false,         /** supprime l'icone reset **/
        wrapInput:false     /** bouton submit **/
    })
);

//DISPLAY RESULT WIDGET
search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            item: document.getElementById('hit-template').innerHTML,
            empty: "Nous n'avons trouvé aucun résultat correspondant à votre recherche <em>\"{{query}}\"</em>."
        },   
        cssClasses: {
           root: "row",
           item: "col-lg-3 col-md-4 col-sm-6 col-xs-6"
        }            
    })
);

////PAGINATION WIDGET
//search.addWidget(
//    instantsearch.widgets.pagination({
//        container: '#pagination',
//        cssClasses:{
//            root: "row",
//            item: "m-1"
//        }
//    })
//);

search.start();
