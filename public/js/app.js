
//initialize instantsearch.js with your only search api key

var search = instantsearch({
    // Replace with your own values
    appId: 'latency',
    apiKey: '5a4da4475cf2e131f7c0d5821e06c807', // search only API key, no ADMIN key
    indexName: 'instant_search',
    urlSync: true,
    searchParameters: {
        hitsPerPage: 10
    }
});

//SEARCH WIDGET
search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#search-input'
    })
);

//DISPLAY RESULT WIDGET
search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            item: document.getElementById('hit-template').innerHTML,
            empty: "We didn't find any results for the search <em>\"{{query}}\"</em>"
        }
    })
);

//PAGINATION WIDGET
search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination'
    })
);


//START THE WHOLE WIDGETS
search.start();
