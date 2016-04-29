
                        <script>
                              var map;
                              function initMap() {
                                    var search = document.getElementById('search');
                              map = new google.maps.Map(document.getElementById('map'), {
                                    center: {lat: 32.77922868714283, lng: -96.80276870727539},
                                    zoom: 14
                                    });
                                    //check for geolocation
                                    var initialLocation;
                                    var Dallas = new google.maps.LatLng(32.77922868714283, -96.80276870727539);
                                    var browserSupportFlag = new Boolean();
                                    if(navigator.geolocation){
                                          browserSupportFlag = true;
                                          navigator.geolocation.getCurrentPosition(function(position){
                                                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                                                map.setCenter(initialLocation);
                                          }, function() {
                                                handleNoGeolocation(browserSupportFlag);
                                          });
                                    }
                                          //Browser doesn't support Geolocation
                                    else{
                                          browserSupportFlag = false;
                                          handleNoGeolocation(browserSupportFlag);
                                    }
                                    function handleNoGeolocation(errorFlag){
                                          if(errorFlag == true){
                                                alert("Geolocation service failed.");
                                                initialLocation = Dallas;
                                          }else{
                                                alert("Your brower doesn't support geolocation.  We've placed you in Dallas, TX.");
                                                initialLocation = Dallas;
                                          }
                                          map.setCenter(initialLocation);
                                    }
                                    //set initial map markers
                                    <?php if(isset($maps))
                                    {
                                          foreach ($maps as $map)
                                          { ?>

                                                var myString = "";
                                                myString += "<form class='update' action='/Spots/show/<?=$map['map_id']?>' method='post'><button type='submit' class='btn btn-link'><?=$map['title']?></button><p class='map_p'><?=$map['description']?></p>";
                                                var marker = new google.maps.Marker ({
                                                map: map,
                                                draggable: false,
                                                position: {lat: <?= $map['lat'] ?> , lng: <?=$map['lng']?> }
                                                });
                                                attachMessage(marker, myString);

                                    <?php 
                                          } 
                                    }  ?>
                                    //event listener for adding a new marker
                                    google.maps.event.addListener(map, 'click', function(event){
                                          addMarker(event.latLng, map);
                                          document.getElementById('spots').style.display = 'block';
                                          var lat = event.latLng.lat();
                                          var lng = event.latLng.lng();
                                          $("#lng").val(lng);
                                          $("#lat").val(lat);
                                    });
                                    //event listener for centering map on search
                                    google.maps.event.addDomListener(search, 'submit', function(){
                                          $.post($(this).attr('action'), $(this).serialize(), function(res){
                                                var latlng = new google.maps.LatLng(res.spots[0].lat, res.spots[0].lng);
                                                map.setCenter(latlng);
                                                map.setZoom(16);
                                          }, 'json')
                                    });
                              }
                              function addMarker(location, map){
                                    var marker = new google.maps.Marker({
                                          position: location,
                                          map: map
                                    });
                              }
                              function attachMessage(marker, message){
                                    var infowindow = new google.maps.InfoWindow({
                                          content: message,
                                          maxWidth: 200
                                    });
                                    marker.addListener('click', function(){
                                          infowindow.open(marker.get('map'), marker);
                                    });
                              }
                  </script>
                  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0E2tDWYMSlINxLAqJKWhLPvy9LsWBrtM&callback=initMap" async defer></script>