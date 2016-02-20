$('#from, #to').autocomplete({
    source: function (request, response) {
    	$.get('https://transport.opendata.ch/v1/locations', {query: request.term, type: 'station'}, function(data) {
    		response($.map(data.stations, function(station) {
    			return {
    				label: station.name,
    				station: station
    			}
    		}));
    	}, 'json');
    },
    select: function (event, ui) {
        station = ui.item.station.id;
    }
});

var v = new Vue({
    el: '#app',
    data: {
        "connections": []
    } 
});

$("#updateTable").click(function() {
    $.get("index.php",
        {fn: "getConnections",
         from: $("input#from").val(),
         to: $("input#to").val(),
         departureDate: $("input#departureDate").val(),
         departureTime: $("input#departureTime").val()
     },
     function(data) {
        v.$set("connections", data);
     },
     "json"
    );
});