
//initialize instantsearch.js with your only search api key

var search = instantsearch({
    // Replace with your own values
    appId: '6URACH1V5V',
    apiKey: '5a4da4475cf2e131f7c0d5821e06c807', // search only API key, no ADMIN key
    indexName: 'dev_events',
    urlSync: true,
    searchParameters: {
        hitsPerPage: 10
    }
});

//SEARCH WIDGET

search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#search-input',
        magnifier: false,    /** supprime l'icone recherche **/
        wrapInput:false      /** bouton submit **/
        
    })
);

//DISPLAY RESULT WIDGET
search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            item: document.getElementById('hit-template').innerHTML,
            empty: "We didn't find any results for the search <em>\"{{query}}\"</em>"
        },   
        cssClasses: {
           root: "row",
           item: "col-sm-3 col-md-3 col-lg-3 col-xs-6"
        }            
    })
);

//PAGINATION WIDGET
search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination',
        cssClass: {
            root: "row",
            item:""
        }
    })
);


//START THE WHOLE WIDGETS
search.start();
