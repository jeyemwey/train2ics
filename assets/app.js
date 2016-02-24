$(document).ready(function() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var hh = today.getHours();
    var ii = today.getMinutes();

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd}
    if(mm<10){mm='0'+mm}
    if(hh<10){hh='0'+hh}
    if(ii<10){ii='0'+ii}
    date = yyyy+'-'+mm+'-'+dd;
    time = hh+":"+ii;

    $('input[type="date"]').val(date);
    $('input[type="time"]').val(time);


    //Piwik
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
    var u="//piwik.iamjannik.me/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 6]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();

});

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
    _paq.push(['trackEvent', 'GetConnections', 'From', $("input#from").val(), $("input#to").val()]);
    _paq.push(['trackEvent', 'GetConnections', 'To', $("input#to").val(), $("input#to").val()]);

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