(function($) {
    
    var loadMap = window.openstreetmap = window.openstreetmap || {};
    /**
     * Controller for Map functionality
     *
     * @param {HTMLElement} element
     * @param {loadMap.Data} openstreetmap
     * @constructor
     */

    loadMap = function(element, openstreetmap) {
        var $element = this.element = $(element);
        this.openstreetmap = openstreetmap;
        this.data = openstreetmap;
        var mapID = jQuery("#" + openstreetmap.mapSettings.id);    
        $.each(mapID, function( index, value ) {
            var points = [];
            openstreetmap.mapSettings.heigth!=='' ? $(mapID).height(openstreetmap.mapSettings.height) : $(mapID).height('500px');
            
            $.each(openstreetmap.locations, function( index, value ) {
                points[index] = [value.title,value.latitude,value.longitude,value.infoWindowContent];              
            }); 
            var map  = new L.map(value.id,{scrollWheelZoom: false, dragging:false}).setView([openstreetmap.locations[0].latitude,openstreetmap.locations[0].longitude], 14);                
       
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'})
            .addTo(map);
     
            
             // Placing markers 
             for (var i=0; i < points.length; i++){
                createMarker(points[i][0],points[i][1],points[i][2],points[i][3]);
            }      
            function createMarker(title,lat,lng,infoWindowContent)    {     
                var marker;
                marker = L.marker([lat,lng],{draggable: false});
                marker.title = title;
                marker.bindPopup(`<div class='info-window'>${infoWindowContent}</div>`);    
                marker.addTo(map);
                map.addLayer(marker);      
            }
            $('.map-add').click(function(){                    
                var title = $(this).attr('data-title');
                var lat = $(this).attr('data-lat');
                var lng = $(this).attr('data-lng');                                     
                map.setView([lat,lng], 16);           
            });   
        });
        // open info window
        window.setTimeout(function() {
            $element.trigger("openinfo");
        }, 2000);                        
    };

     // Create a new OpenStreet Map
    $.fn.nsopenstreetmap = function(openstreetmap) {
        var $element = $(this);
        if (!$element.data('openstreetmap')) {
            $element.data('openstreetmap', new loadMap($element, openstreetmap));
        }
    };

}(jQuery));    