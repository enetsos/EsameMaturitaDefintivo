/*api bing per l'implementazione delle mappe*/
var map;
var directionsManager;

function GetMap() {
    map = new Microsoft.Maps.Map('#map', {});

    //Load the directions module.
    Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function() {
        //Create an instance of the directions manager.
        directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);

        /*
        //Specify where to display the route instructions.
        directionsManager.setRenderOptions({ itineraryContainer: '#directionsItinerary' });

        //Specify the where to display the input panel
        directionsManager.showInputPanel('directionsPanel');
        */
    });
    Microsoft.Maps.loadModule('Microsoft.Maps.AutoSuggest', function() {
        var start = new Microsoft.Maps.AutosuggestManager({ map: map });
        start.attachAutosuggest('#start', '#startAutosuggestion', selectedSuggestion);
        var end = new Microsoft.Maps.AutosuggestManager({ map: map });
        end.attachAutosuggest('#end', '#endAutosuggestion', selectedSuggestion);
    });
}

function loadRoutes() {
    //Clear any previously calculated directions.
    directionsManager.clearAll();
    directionsManager.clearDisplay();

    //Create waypoints to route between.
    var start = new Microsoft.Maps.Directions.Waypoint({ address: document.getElementById('start').value });
    directionsManager.addWaypoint(start);

    var end = new Microsoft.Maps.Directions.Waypoint({ address: document.getElementById('end').value });
    directionsManager.addWaypoint(end);

    //Calculate directions.
    directionsManager.calculateDirections();
}

function selectedSuggestion(result) {
    //Remove previously selected suggestions from the map.
    map.entities.clear();

    //Show the suggestion as a pushpin and center map over it.
    var pin = new Microsoft.Maps.Pushpin(result.location);
    map.entities.push(pin);
    map.setView({ bounds: result.bestView });
}