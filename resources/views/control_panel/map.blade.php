@extends('control_panel.control_panel_master')

@section('title')
    <title>Map</title>
@endsection


@section('style')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
        /* CSS for the Delete Button. */
        .deleteOverlayButton {
            background: #dee0df;
            color: #000;
            /* font-family: 'Helvetica', 'Arial', sans-serif; */
            font-size: 11.4px;
            font-weight: bold;
            text-align: center;
            width: 14px;
            height: 15px;
            border-radius: 8px;
            box-shadow: 1px 0px 1px rgba(0, 0, 0, 0.3);
            position: absolute;
            padding: 0px 0px 0px 0px;
            margin-top: 7px;
            margin-left: 8px;
            border: 1px solid #999;
            cursor: pointer;
        }

        .deleteOverlayButton:hover {
            background: #eee;
        }
    </style>
@endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    @foreach($trace_keys as $key => $value)
                        @if(($value))
                            <li class="breadcrumb-item"><a href="{{ route($trace_values[$key],$value) }}">{{ $trace_words[$key] }}</a></li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ route($trace_values[$key]) }}">{{ $trace_words[$key] }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <label>city</label>
                                <select id="city_id" class="form-control">
                                    <option selected value="null"></option>
                                    @foreach($cities as $city)
                                        <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select><br>
                            </div>
                            <div class="row">
                                <label>details</label>
                                <textarea rows="5" class="form-control" id="detailed_address" placeholder="details"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>My Google Maps Demo</h3>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        {{--console.log('App\\'+'{{$addressable_type}}','{{$addressable_id}}')--}}
        function initMap() {
            setInitialMapOptions();
            map = getMapObject(mapOptions);
            if(!parseInt('{{$marker}}')) {
                drawingManager = getDrawingManagerObject();
                google.maps.event.addListener(drawingManager, 'overlaycomplete', onOverlayComplete);
            }
            initializeDeleteOverlayButtonLibrary();
            mapOnInitLocations();
        }
        function mapOnInitLocations(){
            // console.log(JSON.parse(document.getElementById('location').innerHTML));
            // setShapes(JSON.parse(document.getElementById('location').innerHTML));
        }
        function setShapes(data) {
            for(var x in data) {
                var shapeObject = {};
                if (data[x].type === 'circle') {
                    var circleObject = new google.maps.Circle({
                        center: {'lat': data[x].points[0]['lat'], 'lng': data[x].points[0]['lng']},
                        radius: data[x].radius,
                        map: map,
                        fillColor: "#e20000",
                        fillOpacity: 0,
                        strokeColor: "#e20000",
                        strokeWeight: 4,
                        strokeOpacity: 1,
                        clickable: false,
                        editable: true,
                        suppressUndo: true,
                        zIndex: 999
                    });
                    // Object.assign(circleObject,circleOptions);
                    shapeObject.type = data[x].type;
                    shapeObject.id = data[x].id;
                    shapeObject.overlay = circleObject;
                    // console.log(shapeObject);
                    shapeObject = {};
                    onOverlayComplete(shapeObject);
                }else{
                    var polygonObject = new google.maps.Polygon({
                        paths: data[x].points,
                        map: map,
                        editable: true,
                        fillColor: "#e20000",
                        fillOpacity: 0,
                        strokeColor: "#e20000",
                        strokeWeight: 4,
                        strokeOpacity: 1,
                        suppressUndo: true,
                        zIndex: 999
                    });
                    // console.log(data[x]);
                    shapeObject.type = data[x].type;
                    shapeObject.id = data[x].id;
                    shapeObject.overlay = polygonObject;
                    // shapeObject.overlay.latLngs.j[0].j = data[x].points;
                    console.log(shapeObject);
                    onOverlayComplete(shapeObject);
                }
            }
        }
        // Get Map Geo Center Denver, USA Coordinates
        var center = {lat: 30.044281, lng: 31.340002};
        var map, drawingManager, mapOptions = {};
        var listenerFiltersApplied = false;
        var circleOptions = {
            fillColor: "#e20000",
            fillOpacity: 0,
            strokeColor: "#e20000",
            strokeWeight: 4,
            strokeOpacity: 1,
            clickable: false,
            editable: true,
            suppressUndo: true,
            zIndex: 999
        };
        var polygonOptions = {
            editable: true,
            fillColor: "#e20000",
            fillOpacity: 0,
            strokeColor: "#e20000",
            strokeWeight: 4,
            strokeOpacity: 1,
            suppressUndo: true,
            zIndex: 999
        };

        function setInitialMapOptions() {
            mapOptions = {
                zoom: 8,
                center: center,
                styles: [
                    // {"featureType":"road", elementType:"geometry", stylers: [{visibility:"off"}]},	//turns off roads geometry
                    // {"featureType":"road", elementType:"labels", stylers: [{visibility:"off"}]},	//turns off roads labels
                    // {"featureType":"poi", elementType:"labels", stylers: [{visibility:"off"}]},  //turns off points of interest lines
                    // {"featureType":"poi", elementType:"geometry", stylers: [{visibility:"off"}]},  //turns off points of interest geometry
                    // {"featureType":"transit", elementType:"labels", stylers: [{visibility:"off"}]},  //turns off transit lines labels
                    // {"featureType":"transit", elementType:"geometry", stylers: [{visibility:"off"}]},	//turns off transit lines geometry
                    // {"featureType":"administrative.land_parcel", elementType:"labels", stylers: [{visibility:"off"}]},  //turns off administrative land parcel labels
                    // {"featureType":"administrative.land_parcel", elementType:"geometry", stylers: [{visibility:"off"}]},  //turns off administrative land parcel geometry
                    // {"featureType":"water", elementType:"geometry", stylers: [{color: '#d1e1ff'}]},  //sets water color to a very light blue
                    // {"featureType":"landscape", elementType:"geometry", stylers: [{color: '#fffffa'}]},  //sets landscape color to a light white color
                ],
                mapTypeControl: false,
                panControl: true,
                panControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_CENTER
                },
                streetViewControl: false,
                scaleControl: false,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL,
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },
                minZoom: 2
            };
        }

        function getMapObject(mapOptions) {
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            return map;
        }

        function getDrawingManagerObject(drawingManagerOptions) {
            var drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: null,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT,
                    drawingModes: [
                        google.maps.drawing.OverlayType.CIRCLE,
                        google.maps.drawing.OverlayType.POLYGON
                    ]
                },
                circleOptions: circleOptions,
                polygonOptions: polygonOptions
            });
            drawingManager.setMap(map);
            return drawingManager;
        }

        /* -- Overlay Functions Begin Here -- */
        function onOverlayComplete(shape) {
            myOnOverlayComplete(shape);
            addDeleteButtonToOverlay(shape);
            addOverlayListeners(shape);
            if(listenerFiltersApplied) {
                listenerFiltersApplied = false;
            }
        }
        const getCircularReplacer = () => {
            const seen = new WeakSet();
            return (key, value) => {
                if (typeof value === "object" && value !== null) {
                    if (seen.has(value)) {
                        return;
                    }
                    seen.add(value);
                }
                return value;
            };
        };
        function myOnOverlayComplete(shape) {
            // console.log(shape);
            var form_data = new FormData();
            if(shape.type == google.maps.drawing.OverlayType.CIRCLE) {
                form_data.append('_token', "{{ csrf_token() }}");
                // form_data.append('shape',JSON.stringify(shape, getCircularReplacer()));
                form_data.append('radius',shape.overlay.getRadius());
                form_data.append('type','circle');
{{--                form_data.append('provider','{{$provider->user->id}}');--}}
                form_data.append('center',JSON.stringify({'lat':shape.overlay.getCenter().lat(),'lng':shape.overlay.getCenter().lng()}));

                if(shape.id){
                    form_data.append('id',shape.id);
                    $.ajax(
                        {
{{--                            url: "{{route('updateCircle')}}", // point to server-side PHP script--}}
                            // dataType: 'text',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function (data, status) {
                                // console.log(data);
                            }
                        });
                }else{
                    $.ajax(
                        {
{{--                            url: "{{route('addNewCircle')}}", // point to server-side PHP script--}}
                            // dataType: 'text',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function (data, status) {
                                shape.id = data;
                                // console.log(shape);
                            }
                        });
                }
            } else if (shape.type == google.maps.drawing.OverlayType.POLYGON) {
                var new_polygon = [];
                for(var x in shape.overlay.getPath().getArray()){
                    new_polygon.push({'lat':shape.overlay.getPath().getArray()[x].lat(),'lng':shape.overlay.getPath().getArray()[x].lng()});
                }
                form_data.append('_token', "{{ csrf_token() }}");
                form_data.append('type','polygon');
                {{--form_data.append('provider','{{$provider->user->id}}');--}}
                form_data.append('points',JSON.stringify(new_polygon,getCircularReplacer()));
                if(shape.id){
                    form_data.append('id',shape.id);
                    $.ajax(
                        {
{{--                            url: "{{route('updateShape')}}", // point to server-side PHP script--}}
                            // dataType: 'text',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function (data, status) {
                                // shape.id = data;
                                // console.log(data);
                            }
                        });
                }else{
                    $.ajax(
                        {
{{--                            url: "{{route('addNewShape')}}", // point to server-side PHP script--}}
                            // dataType: 'text',  // what to expect back from the PHP script, if anything
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function (data, status) {
                                shape.id = data;
                                // console.log(data);
                            }
                        });
                }
            }
        }
        function addOverlayListeners(shape) {
            // Filters already applied.
            if(listenerFiltersApplied) {
                return;
            }
            if (shape.type == google.maps.drawing.OverlayType.POLYGON) {
                setBoundsChangedListener(shape);
            }
            if (shape.type == google.maps.drawing.OverlayType.CIRCLE) {
                setCenterChangedListener(shape);
                setRadiusChangedListener(shape);
            }
        }

        function setBoundsChangedListener(shape) {
            // Add listeners for each path of the polygon.
            shape.overlay.getPaths().forEach(function(path, index){
                // New point
                google.maps.event.addListener(path, 'insert_at', function(){
                    listenerFiltersApplied = true;
                    onOverlayComplete(shape);
                });
                // Point was removed
                google.maps.event.addListener(path, 'remove_at', function(){
                    listenerFiltersApplied = true;
                    onOverlayComplete(shape);
                });
                // Point was moved
                google.maps.event.addListener(path, 'set_at', function(){
                    listenerFiltersApplied = true;
                    onOverlayComplete(shape);
                });
            });
        }

        function setCenterChangedListener(shape) {
            google.maps.event.addListener(shape.overlay, 'center_changed', function() {
                listenerFiltersApplied = true;
                onOverlayComplete(shape);
            });
        }

        function setRadiusChangedListener(shape) {
            google.maps.event.addListener(shape.overlay, 'radius_changed', function() {
                listenerFiltersApplied = true;
                onOverlayComplete(shape);
            });
        }

        function addDeleteButtonToOverlay(shape) {
            var deleteOverlayButton = new DeleteOverlayButton();
            if(("deleteButton" in shape) && (shape.deleteButton != null)) {
                shape.deleteButton.div.remove();
                shape.deleteButton = deleteOverlayButton;
            } else {
                shape.deleteButton = deleteOverlayButton;
            }
            if(shape.type == google.maps.drawing.OverlayType.CIRCLE) {
                var radiusInKms = convertDistance(Math.round(shape.overlay.getRadius()), "metres", "kms");
                var circleCenter = new google.maps.LatLng(shape.overlay.getCenter().lat(), shape.overlay.getCenter().lng());
                var deleteOverlayButtonPosition = circleCenter.destinationPoint(30, radiusInKms);
                deleteOverlayButton.open(map, deleteOverlayButtonPosition, shape);
            } else if (shape.type == google.maps.drawing.OverlayType.POLYGON) {
                deleteOverlayButton.open(map, shape.overlay.getPath().getArray()[0], shape);
            }
        }
        /* -- Overlay Functions End Here -- */

        function convertDistance(distanceValue, actualDistanceUnit, expectedDistanceUnit) {
            var distanceInKms = 0;
            switch(actualDistanceUnit) {
                case "miles":
                    distanceInKms = distanceValue/0.62137;
                    break;
                case "kms":
                    distanceInKms = distanceValue;
                    break;
                case "metres":
                    distanceInKms = distanceValue/1000;
                    break;
                default:
                    distanceInKms = undefined;
            }

            switch(expectedDistanceUnit) {
                case "miles":
                    return distanceInKms * 0.62137;
                case "kms":
                    return distanceInKms;
                case "metres":
                    return distanceInKms * 1000;
                default:
                    return undefined;
            }
        }

        /**
         * author: Loy Alvares
         * This utility was written to handle deletion of circles and polygons in Google Maps V3.
         *
         * Also thanks to Chris Veness for the distance calculation formulae from pointA to pointB
         * ( Latitude/Longitude spherical geodesy formulae & scripts )
         at http://www.movable-type.co.uk/scripts/latlong.html
         (c) Chris Veness 2002-2010
         */

        /* ***** Custom Library for Delete Overlay Button (Start) ***** */

        /**
         * A HTML Button that lets a user delete a component.
         * @constructor
         * @author: Loy Alvares
         */
        function DeleteOverlayButton() {
            this.div = document.createElement('div');
            this.div.id = 'deleteOverlayButton';
            this.div.className = 'deleteOverlayButton';
            this.div.title = 'Delete';
            this.div.innerHTML = '<span id="x">X</span>';
            var button = this;
            google.maps.event.addDomListener(this.div, 'click', function(e) {
                button.removeShape();
                button.div.remove();
            });
        }

        function initializeDeleteOverlayButtonLibrary() {

            /* This needs to be initialized by initMap() */
            DeleteOverlayButton.prototype = new google.maps.OverlayView();

            /**
             * Add component to map.
             * @author: Loy Alvares
             */
            DeleteOverlayButton.prototype.onAdd = function() {
                var deleteOverlayButton = this;
                var map = this.getMap();
                this.getPanes().floatPane.appendChild(this.div);
            };

            /**
             * Clear data.
             * @author: Loy Alvares
             */
            DeleteOverlayButton.prototype.onRemove = function() {
                google.maps.event.removeListener(this.divListener_);
                this.div.parentNode.removeChild(this.div);
                // Clear data
                this.set('position');
                this.set('overlay');
            };

            /**
             * Deletes an overlay.
             * @author: Loy Alvares
             */
            DeleteOverlayButton.prototype.close = function() {
                this.setMap(null);
            };

            /**
             * Displays the Button at the position(in degrees) on the circle's circumference.
             * @author: Loy Alvares
             */
            DeleteOverlayButton.prototype.draw = function() {
                var position = this.get('position');
                var projection = this.getProjection();
                if (!position || !projection) {
                    return;
                }
                var point = projection.fromLatLngToDivPixel(position);
                this.div.style.top = point.y + 'px';
                this.div.style.left = point.x + 'px';
                if(this.get('overlay').type == google.maps.drawing.OverlayType.POLYGON) {
                    this.div.style.marginTop = '-16px';
                    this.div.style.marginLeft = '0px';
                }
            };

            /**
             * Displays the Button at the position(in degrees) on the circle's circumference.
             * @author: Loy Alvares
             */
            DeleteOverlayButton.prototype.open = function(map, deleteOverlayButtonPosition, overlay) {
                this.set('position', deleteOverlayButtonPosition);
                this.set('overlay', overlay);
                this.setMap(map);
                this.draw();
            };

            /**
             * Deletes the shape it is associated with.
             * @author: Loy Alvares
             */
            DeleteOverlayButton.prototype.removeShape = function() {
                var position = this.get('position');
                var shape = this.get('overlay');
                console.log('delete '+shape.type);
                $.get("/deleteCircle/" +shape.id, function (data, status) {

                });
                    if (shape != null) {
                    shape.overlay.setMap(null);
                    return;
                }
                this.close();
            };

            Number.prototype.toRadians = function() {
                return this * Math.PI / 180;
            };

            Number.prototype.toDegrees = function() {
                return this * 180 / Math.PI;
            };

            /* Based the on the Latitude/Longitude spherical geodesy formulae & scripts
               at http://www.movable-type.co.uk/scripts/latlong.html
               (c) Chris Veness 2002-2010
            */
            google.maps.LatLng.prototype.destinationPoint = function(bearing, distance) {
                distance = distance / 6371;
                bearing = bearing.toRadians();
                var latitude1 = this.lat().toRadians(), longitude1 = this.lng().toRadians();
                var latitude2 = Math.asin(Math.sin(latitude1) * Math.cos(distance) + Math.cos(latitude1) * Math.sin(distance) * Math.cos(bearing));
                var longitude2 = longitude1 + Math.atan2(Math.sin(bearing) * Math.sin(distance) * Math.cos(latitude1), Math.cos(distance) - Math.sin(latitude1) * Math.sin(latitude2));
                if (isNaN(latitude2) || isNaN(longitude2)) return null;
                return new google.maps.LatLng(latitude2.toDegrees(), longitude2.toDegrees());
            }
        }

        /* ***** Custom Library for Delete Overlay Button (End) ***** */

    </script>
    <!--AIzaSyAzPYbomJTL-BsrRLcyTylji67B55_q_3Q-->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=key&language=ar&region=EG&libraries=drawing&callback=initMap">
    </script>
    <!-- end - This is for export functionality only -->
    <script>
        var marker;
        var form_data = new FormData();
        form_data.append('_token', "{{ csrf_token() }}");
        form_data.append('type','marker');
        form_data.append('addressable_type','App\\'+'{{$addressable_type}}');
        form_data.append('addressable_id','{{$addressable_id}}');
        window.onload = function() {
            if (document.getElementById('{{$selected_side_item}}')) {
                document.getElementById('{{$selected_side_item}}').classList.add('selected');
            }
            if (parseInt('{{$address_trigger}}')) {
                // console.log('dd');
                marker = new google.maps.Marker({
                    position: {
                        'lat': parseFloat('{{$branch->address_lat}}'),
                        'lng': parseFloat('{{$branch->address_lng}}')
                    },
                    map: map,
                    title: 'Click to zoom',
                    draggable: true,
                    id: '{{$branch->address_id}}'
                });
                // console.log(marker);
                map.setCenter({
                    'lat': parseFloat('{{$branch->address_lat}}'),
                    'lng': parseFloat('{{$branch->address_lng}}')
                });
                marker.addListener('dragend', function (e) {
                    // console.log('dragend');
                    map.setCenter(new google.maps.LatLng(e.latLng.lat(), e.latLng.lng()));
                    if(marker.id){
                        console.log(document.getElementById('detailed_address').value);
                        form_data.append('id',marker.id);
                        form_data.append('city_id',document.getElementById('city_id').value);
                        form_data.append('detailed_address',document.getElementById('detailed_address').value);
                        form_data.append('points',JSON.stringify({'lat': e.latLng.lat(),'lng': e.latLng.lng()}));
                        $.ajax(
                            {
                                url: "{{route('updateMarker')}}", // point to server-side PHP script
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function (data, status) {
                                    // marker.id = data.id;
                                    console.log(data);
                                }
                            });
                    }
                });
            }
            map.addListener('click', function(e) {
                if(!marker && !parseInt('{{$address_trigger}}')) {
                    {{--console.log(!marker,!parseInt('{{$address_trigger}}'));--}}
                        marker = new google.maps.Marker({
                        position: {'lat': e.latLng.lat(), 'lng': e.latLng.lng()},
                        map: map,
                        title: 'Click to zoom',
                        draggable:true,
                    });
                    // console.log(document.getElementById('detailed_address').value);
                    form_data.append('city_id',document.getElementById('city_id').value);
                    form_data.append('detailed_address',document.getElementById('detailed_address').value);
                    form_data.append('points',JSON.stringify({'lat': e.latLng.lat(),'lng': e.latLng.lng()}));
                    $.ajax(
                        {
                            url: "{{route('addMarker')}}", // point to server-side PHP script
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function (data, status) {
                                marker.id = data;
                                console.log(data);
                            }
                        });
                    marker.addListener('dragend', function(e) {
                        map.setCenter(new google.maps.LatLng(e.latLng.lat(), e.latLng.lng()));
                        if(marker.id){
                            // console.log(document.getElementById('detailed_address').value);
                            form_data.append('id',marker.id);
                            form_data.append('city_id',document.getElementById('city_id').value);
                            form_data.append('detailed_address',document.getElementById('detailed_address').value);
                            form_data.append('points',JSON.stringify({'lat': e.latLng.lat(),'lng': e.latLng.lng()}));
                            $.ajax(
                                {
                                    url: "{{route('updateMarker')}}", // point to server-side PHP script
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,
                                    type: 'post',
                                    success: function (data, status) {
                                        // marker.id = data.id;
                                        // console.log(data);
                                    }
                                });
                        }
                    });
                }else{
                    {{--console.log('no address', parseInt('{{$address_trigger}}'));--}}
                    marker.setPosition({'lat': e.latLng.lat(), 'lng': e.latLng.lng()});
                    if(marker.id){
                        console.log(document.getElementById('detailed_address').value);
                        form_data.append('id',marker.id);
                        form_data.append('city_id',document.getElementById('city_id').value);
                        form_data.append('detailed_address',document.getElementById('detailed_address').value);
                        form_data.append('points',JSON.stringify({'lat': e.latLng.lat(),'lng': e.latLng.lng()}));
                        $.ajax(
                            {
                                url: "{{route('updateMarker')}}", // point to server-side PHP script
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function (data, status) {
                                    // marker.id = data.id;
                                    console.log(data);
                                }
                            });
                    }
                }
                map.setCenter(new google.maps.LatLng(e.latLng.lat(), e.latLng.lng()));
                console.log('map-click');
            });
        };

    </script>
@endsection

