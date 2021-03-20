/*
 * MapToolbar
 * a literal object
 *  - act as a container that will share one or more Feature instance
 *  - act as a namespace
 */ 

var MapToolbar = {

    //reorder index of a poly markers array

    reindex:function(markers){
        markers.forEach(function(marker, index){
            marker.index = index;
        });			
    },

    //get point at middle distance between 2 point

    getMidPoint: function(){
        var lat = (arguments[0].lat() + arguments[1].lat()) / 2;
        var lng = (arguments[0].lng() + arguments[1].lng()) / 2;		
        return new google.maps.LatLng(lat, lng);		
    },

    //currently edited feature

    currentFeature: null,

    //add a point to a poly, 'e' can be a click event or a latLng object

    addPoint : function(e, poly, index) {
        var e = (typeof e.latLng != "undefined")? e.latLng : e,
        image = new google.maps.MarkerImage('js/plugin/mapToolbar/images/marker-edition.png',
            new google.maps.Size(9, 9),
            new google.maps.Point(0, 0),
            new google.maps.Point(5, 5)),
        imageover = new google.maps.MarkerImage('js/plugin/mapToolbar/images/marker-edition-over.png',
            new google.maps.Size(9, 9),
            new google.maps.Point(0, 0),
            new google.maps.Point(5, 5)),
        path = poly.getPath(),
        index = (typeof index != "undefined")? index : path.length,
        markers = (poly.markers)? poly.markers : new google.maps.MVCArray, 
        marker = new google.maps.Marker({
            position: e,
            map: map,
            draggable: true,
            icon: image
        });

        marker.index = index;    
        path.insertAt(index, e);
        markers.insertAt(index, marker)
        if(arguments[2]){
            MapToolbar.reindex(markers);	
        }

        //click on a polymarker will delete it

        google.maps.event.addListener(marker, 'click', function() {
            marker.setMap(null);
            markers.removeAt(marker.index);
            path.removeAt(marker.index);
            MapToolbar.reindex(markers);				
            if(markers.getLength() == 0){
                MapToolbar.removeFeature(poly.id);
            }
        });

        /*
      google.maps.event.addListener(marker, 'dragstart', function() {
				MapToolbar.currentlyDragging = true;
	  	})
*/		
        google.maps.event.addListener(marker, 'position_changed', function() {
            path.setAt(marker.index, marker.getPosition());
        })
				
        google.maps.event.addListener(marker, 'dragend', function() {
            //MapToolbar.currentlyDragging = false;
            path.setAt(marker.index, marker.getPosition());
            var position = marker.getPosition(),
            p;

            //get previous point

            if(typeof path.getAt(marker.index-1) != "undefined"){
                var m1 = path.getAt(marker.index -1);
                p = MapToolbar.getMidPoint(position, m1);		
                MapToolbar.addPoint(p, poly, marker.index);						
            }

            // get next point

            if(typeof path.getAt(marker.index+1) != "undefined"){
                var m2 = path.getAt(marker.index+1);
                p = MapToolbar.getMidPoint(position, m2);		
                MapToolbar.addPoint(p, poly, marker.index+1);						
            }			
        });

        google.maps.event.addListener(marker, 'mouseover', function() {
            this.setIcon(imageover);
        });   
	    
        google.maps.event.addListener(marker, 'mouseout', function() {
            this.setIcon(image);
        });       
    },	
	    
    //edition buttons
 
    buttons: {
        $hand: null,
        $shape: null
    },

    //click event for line and shape edition

    polyClickEvent: null,

    //contains list of overlay that were added to the map
    //and that are displayed on the sidebar

    Feature: function(){
        this['poly']("shape");
    },

    //contains reference for all features added on the map

    features:{
        placemarkTab: {},
        lineTab: {},
        shapeTab: {},
        overlayTab:{}
    },
    
    getIcon: function(color) { 
        var icon = new google.maps.MarkerImage("http://google.com/mapfiles/ms/micons/" + color + ".png",
            new google.maps.Size(32, 32),
            new google.maps.Point(0,0),
            new google.maps.Point(15, 32)
            );
        return icon;
    },
    
    //instanciate a new Feature instance and create a reference 

    initFeature: function(){
        new MapToolbar.Feature("shape");
    },

    //check if a toolbar button is selected

    isSelected: function(el){
        return (el.className == "seleccionado"); 
    },
 
    //the map DOM node container

    placemarkCounter: 0,
    lineCounter:0,
    shapeCounter:0,
    
    //remove click events used for poly edition/update

    removeClickEvent: function(){   
    },

    // remove feature from map

    removeFeature : function(id){
        var feature = MapToolbar.features['shapeTab'][id];
        delete  MapToolbar.features['shapeTab'][id];
        MapToolbar.currentFeature = null;
        feature.markers.forEach(function(marker, index){
            marker.setMap(null);
        });
        feature.setMap(null);
        MapToolbar.select('hand_b');
        new MapToolbar.Feature("shape");
    },

    //toolbar buttons selection

    select: function (buttonId){
        MapToolbar.buttons.$hand.className="unseleccionado";
        MapToolbar.buttons.$shape.className="unseleccionado";
        document.getElementById(buttonId).className="seleccionado";
    },

    setMapCenter: function(featureName){
        MapToolbar.currentFeature = MapToolbar.features['shapeTab'][featureName]; 
        var point = MapToolbar.currentFeature.getPath().getAt(0);
        MapToolbar.select('shape_b');
        map.setCenter(point);
    },

    //select hand button

    stopEditing: function() {
        this.removeClickEvent();
        this.select("hand_b");
    },

    //change marker icon 

    updateMarker: function(marker, cells, color) {
        if (color) {
            marker.setIcon( MapToolbar.getIcon(color) );
        }
        var latlng = marker.getPosition();
        cells.desc.innerHTML = "(" + Math.round(latlng.b * 100) / 100 + ", " + Math.round(latlng.c * 100) / 100 + ")";
    }
}

MapToolbar.Feature.prototype.poly = function() {
    
    if (MapToolbar.currentFeature) {
        MapToolbar.select("shape_b");
        return;
    }
    var color = '#19b99a',
    path = new google.maps.MVCArray,
    poly,
    self = this,
    el = "shape_b";
    poly = self.createShape( {
            strokeWeight: 3, 
            fillColor: color
        }, path );
    google.maps.event.addListener(poly, 'click', function (event) {
        if( !MapToolbar.isSelected(MapToolbar.buttons.$shape) ) return;
        if(MapToolbar.currentFeature){
            MapToolbar.addPoint(event, MapToolbar.currentFeature);
        }
    });
	
    poly.markers = new google.maps.MVCArray; 
    if(MapToolbar.isSelected(document.getElementById(el))) return;
    MapToolbar.select(el);
    MapToolbar.currentFeature = poly;	
    poly.setMap(map);	  
    if(!poly.$el){
        poly.id = 'shape_1' 	
        MapToolbar.features["shapeTab"][poly.id] = poly;
    }
}

MapToolbar.Feature.prototype.createShape = function(opts, path) {
    var poly;
    poly = new google.maps.Polygon({
        strokeWeight: opts.strokeWeight,
        fillColor: opts.fillColor
    });
    poly.setPaths(new google.maps.MVCArray([path]));
    return poly;
}