


<button type="button" id="locationModal" data-toggle="modal" data-target="#locationModalAddress" hidden>submit</button>

<div class="modal fade" id="locationModalAddress" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{ trans('lang.delivery_address') }}</h5>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <div class="col-md-12 form-group">

                            <label class="form-label">{{ trans('lang.street_1') }}</label>

                            <div class="input-group">

                                <input placeholder="Delivery Area" type="text" id="address_line1"
                                    class="form-control">

                                <div class="input-group-append">
                                    <button onclick="getCurrentLocationAddress1()" type="button"
                                        class="btn btn-outline-secondary"><i class="feather-map-pin"></i></button>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12 form-group"><label
                                class="form-label">{{ trans('lang.landmark') }}</label><input
                                placeholder="{{ trans('lang.footer') }}" value="" id="address_line2"
                                type="text" class="form-control"></div>

                        <div class="col-md-12 form-group"><label
                                class="form-label">{{ trans('lang.zip_code') }}</label><input placeholder="Zip Code"
                                id="address_zipcode" type="text" class="form-control">
                        </div>

                        <div class="col-md-12 form-group"><label
                                class="form-label">{{ trans('lang.city') }}</label><input
                                placeholder="{{ trans('lang.city') }}" id="address_city" type="text"
                                class="form-control"></div>

                        <div class="col-md-12 form-group"><label
                                class="form-label">{{ trans('lang.country') }}</label><input placeholder="Country"
                                id="address_country" type="text" class="form-control">
                        </div>

                        <input type="hidden" name="address_lat" id="address_lat">
                        <input type="hidden" name="address_lng" id="address_lng">
                    </div>

                </form>

            </div>

            <div class="modal-footer p-0 border-0">

                <div class="col-12 m-0 p-0">
                    <button type="button" id="close_button" class="close" data-dismiss="modal" aria-label="Close"
                        hidden></button>
                    <button type="button" class="btn btn-primary btn-lg btn-block"
                        onclick="saveShippingAddress()">{{ trans('lang.save_changes') }}</button>

                </div>

            </div>

        </div>

    </div>

</div>

<span style="display: none;">
    <button type="button" class="btn btn-primary" id="order_notification_modal" data-toggle="modal"
        data-target="#order_notification">{{ trans('lang.large_modal') }}</button>
</span>
<div class="modal fade" id="order_notification" tabindex="-1" role="dialog"
    aria-labelledby="notification_accepted_order_by_vendor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title order_notification_title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><span id="restaurnat_name" class="order_notification_message"></span></h6>
            </div>
            <div class="modal-footer">
                <?php if(@$_COOKIE['service_type'] == "Parcel Delivery Service"){ ?>
                <button type="button" class="btn btn-primary"><a href="{{ url('parcel_orders') }}"
                        id="order_notification_url">{{ trans('lang.Go') }}</a>
                </button>
                <?php }else if(@$_COOKIE['service_type'] == "Rental Service"){ ?>
                <button type="button" class="btn btn-primary"><a href="{{ url('rental_orders') }}"
                        id="order_notification_url">{{ trans('lang.Go') }}</a>
                </button>
                <?php }else{ ?>
                <button type="button" class="btn btn-primary"><a href="{{ url('my_order') }}"
                        id="order_notification_url">{{ trans('lang.Go') }}</a>
                </button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<span style="display: none;">
    <button type="button" class="btn btn-primary" id="dinein_order_notification_modal" data-toggle="modal"
        data-target="#dinein_order_notification">{{ trans('lang.large_modal') }}</button>
</span>
<div class="modal fade" id="dinein_order_notification" tabindex="-1" role="dialog"
    aria-labelledby="notification_accepted_order_by_vendor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title dinein_order_notification_title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><span id="restaurnat_name" class="dinein_order_notification_message"></span></h6>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary"><a href="{{ url('my_dinein') }}"
                        id="dinein_order_notification_url">{{ trans('lang.go') }}</a>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Store Select Model -->
<div class="modal fade" id="select_store_model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5>{{ trans('lang.select_sections') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="section_list row mt-3" id="section_lists"></div>
            </div>
        </div>
    </div>
</div>


@include('layouts.foot')


<script type="text/javascript" src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<?php if(str_replace('_', '-', app()->getLocale()) == 'ar'){ ?>
<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap-rtl.bundle.min.js') }}"></script>
<?php } ?>

<script type="text/javascript" src="{{ asset('vendor/sidebar/hc-offcanvas-nav.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/slick/slick-lightbox.js') }}"></script>
<script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>


<script type="text/javascript" src="{{ asset('js/siddhi.js') }}"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-firestore.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-storage.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-messaging.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script src="{{ asset('firebase-messaging-sw.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/crypto-js.js') }}"></script>
<script src="{{ asset('js/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>

<script type="text/javascript">
    var database = firebase.firestore();
    <?php $id = null;
    if (Auth::user()) {
        $id = Auth::user()->getvendorId();
    } ?>
    var cuser_id = '<?php echo $id; ?>';
    var dine_in_enable = false;
    var place = [];
    var address_name = getCookie('address_name');
    var address_name1 = getCookie('address_name1');
    var address_name2 = getCookie('address_name2');
    var address_zip = getCookie('address_zip');

    var address_lat = getCookie('address_lat');
    var address_lng = getCookie('address_lng');
    var address_city = getCookie('address_city');
    var address_state = getCookie('address_state');
    var address_country = getCookie('address_country');

    var googleMapKey = '';

    async function loadGoogleMapsScript() {

        await database.collection('settings').doc("googleMapKey").get().then(function(googleMapKeySnapshotsHeader) {

            var placeholderImageHeaderData = googleMapKeySnapshotsHeader.data();
            googleMapKey = placeholderImageHeaderData.key;

            const script = document.createElement('script');
            script.src = "https://maps.googleapis.com/maps/api/js?key=" + googleMapKey +
                "&libraries=places";
            script.onload = function() {

                //if (typeof is_layer == "undefined") {
                initialize();
                //}

                <?php if(@Route::current()->getName() == 'checkout'){ ?>

                initializeCheckout();
                <?php }?>

                if (getCookie('section_name') != null || getCookie('section_name') != "" || getCookie(
                        'section_name') != undefined) {

                    if (getCookie('section_name') == "Rental Service") {
                        pickLocation();
                        dropLocation();
                    } else if (getCookie('section_name') == "Parcel Service") {
                        setParcelLocations();
                    }
                }

            };
            document.head.appendChild(script);

        });

    }

    loadGoogleMapsScript();

    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then(async function(snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    var service_type = getCookie('service_type');


    function pickLocation() {
        var input = document.getElementById('pickLocation');

        console.log(input);
        if (input) {
            var autocomplete = new google.maps.places.Autocomplete(input);

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();

                address_lat = place.geometry.location.lat();
                address_lng = place.geometry.location.lng();

            });
        }


    }

    function dropLocation() {
        var input = document.getElementById('dropLocation');

        if (input) {
            var autocomplete = new google.maps.places.Autocomplete(input);

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();

                drop_address_lat = place.geometry.location.lat();
                drop_address_lng = place.geometry.location.lng();

            });
        }


    }

    function setParcelLocations() {
        var input = document.getElementById('sender_address');

        if (input) {
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {

                var place = autocomplete.getPlace();
                address_name = place.name;
                address_lat = place.geometry.location.lat();
                address_lng = place.geometry.location.lng();

                //  $('#address_lng').val(address_lng);
                //$('#address_lat').val(address_lat);

                $('#sender_address').val(place.name);
            });
        }


        var receiver_address = document.getElementById('receiver_address');

        if (receiver_address) {
            var autocomplete = new google.maps.places.Autocomplete(receiver_address);

            autocomplete.addListener('place_changed', function() {

                var place = autocomplete.getPlace();
                address_name = place.name;
                address_lat = place.geometry.location.lat();
                address_lng = place.geometry.location.lng();

                //  $('#address_lng').val(address_lng);
                //$('#address_lat').val(address_lat);

                $('#receiver_address').val(place.name);

            });
        }

        var sender_address_schedule = document.getElementById('sender_address_schedule');

        if (sender_address_schedule) {
            var autocomplete = new google.maps.places.Autocomplete(sender_address_schedule);

            autocomplete.addListener('place_changed', function() {

                var place = autocomplete.getPlace();
                address_name = place.name;
                address_lat = place.geometry.location.lat();
                address_lng = place.geometry.location.lng();

                //  $('#address_lng').val(address_lng);
                //$('#address_lat').val(address_lat);

                $('#sender_address_schedule').val(place.name);
            });
        }

        var receiver_address_schedule = document.getElementById('receiver_address_schedule');

        if (receiver_address_schedule) {
            var autocomplete = new google.maps.places.Autocomplete(receiver_address_schedule);

            autocomplete.addListener('place_changed', function() {

                var place = autocomplete.getPlace();
                address_name = place.name;
                address_lat = place.geometry.location.lat();
                address_lng = place.geometry.location.lng();

                //  $('#address_lng').val(address_lng);
                //$('#address_lat').val(address_lat);

                $('#receiver_address_schedule').val(place.name);

            });
        }


    }


    if (typeof is_layer != "undefined") {
        $(".select-sec-btn").hide();
    }

    if (address_name == "" || address_name == null) {
        <?php if(Request::path() !== 'terms' && Request::path() !== 'privacy' && Request::path() !== 'contact-us' && Request::path() !== 'faq'){ ?>
        if (typeof is_layer == "undefined") {
            $('#locationModal').trigger('click');
            $('.locationModalTitle').html('{{ trans('lang.find_vendors_items_near_you') }}');
        }
        <?php } ?>
    } else {

        if (getCookie('section_id') == null || getCookie('section_id') == "" || getCookie('section_id') == undefined) {
            <?php if(Request::path() !== 'terms' && Request::path() !== 'privacy' && Request::path() !== 'contact-us' && Request::path() !== 'faq'){ ?>
            if (typeof is_layer == "undefined") {
                $('#select_store_model_call')[0].click();
            }
            <?php } ?>
            if ($("#section_lists").html() == '') {
                var sectionsRef = database.collection('sections').where('isActive', '==', true);

                sectionsRef.get().then(async function(snapshots) {
                    var sections = [];
                    snapshots.docs.forEach((section) => {
                        var datas = section.data();

                        if (datas.sectionImage != '' && datas.sectionImage != undefined) {
                            section_image = datas.sectionImage;
                        } else {
                            section_image = placeholderImage;
                        }

                        html =
                            '<div class="section-list-inner col-md-3 mb-4 select_section" data-color="' +
                            datas.color + '" service_type="' + datas.serviceType + '" data-name="' +
                            datas.name + '" data-dine_in="' + datas.dine_in_active + '" data-id="' +
                            datas.id + '">' +
                            '<div class="section-block bg-white rounded d-block py-3 px-2 text-center shadow-lg">' +
                            '<span class="section-img"><img alt="#" src="' + section_image +
                            '" class="img-fluid item-img w-100"></span>' +
                            '<span class="section-name mt-2 d-block">' + datas.name +
                            '</span></div></div>';
                        $("#section_lists").append(html);

                        sections.push(datas);

                    });
                });

            }

        }
    }

    if (cuser_id != "") {
        var userDetailsRef = database.collection('users').where('id', "==", cuser_id);
    }

    $('#select_store_model_call').bind('click', function() {

        if ($("#section_lists").html() == '') {
            var sectionsRef = database.collection('sections').where('isActive', '==', true);
            var active_section_id = "<?php echo @$_COOKIE['section_id']; ?>";

            sectionsRef.get().then(async function(snapshots) {
                var sections = [];
                snapshots.docs.forEach((section) => {
                    var datas = section.data();

                    if (datas.sectionImage != '' && datas.sectionImage != undefined) {
                        section_image = datas.sectionImage;
                    } else {
                        section_image = placeholderImage;
                    }

                    var active_section = '';
                    if (active_section_id != undefined && active_section_id == datas.id) {
                        active_section = 'section-selected';
                    }

                    html = '<div class="section-list-inner col-md-3 mb-4 select_section ' +
                        active_section + '" service_type="' + datas.serviceType +
                        '"data-color="' + datas.color + '" data-name="' + datas.name +
                        '" data-id="' + datas.id + '" data-dine_in="' + datas
                        .dine_in_active +
                        '"><div class="section-block bg-white rounded d-block py-3 px-2 text-center shadow-lg"><span class="section-img"><img alt="#" src="' +
                        section_image +
                        '" class="img-fluid item-img w-100"></span><span class="section-name mt-2 d-block">' +
                        datas.name + '</span></div></div>';

                    $("#section_lists").append(html);
                    sections.push(datas);

                });
            });

        }
    });

    function initialize() {

        if (address_name != '') {
            document.getElementById('user_locationnew').value = address_name;
        }
        var input = document.getElementById('user_locationnew');

        var autocomplete = new google.maps.places.Autocomplete(input);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();

            address_name = place.name;
            address_lat = place.geometry.location.lat();
            address_lng = place.geometry.location.lng();

            $.each(place.address_components, function(i, address_component) {
                address_name1 = '';
                if (address_component.types[0] == "premise") {
                    if (address_name1 == '') {
                        address_name1 = address_component.long_name;
                    } else {
                        address_name2 = address_component.long_name;
                    }
                } else if (address_component.types[0] == "postal_code") {
                    address_zip = address_component.long_name;
                } else if (address_component.types[0] == "locality") {
                    address_city = address_component.long_name;
                } else if (address_component.types[0] == "administrative_area_level_1") {
                    var address_state = address_component.long_name;
                } else if (address_component.types[0] == "country") {
                    var address_country = address_component.long_name;
                }
            });

            setCookie('address_name1', address_name1, 365);
            setCookie('address_name2', address_name2, 365);
            setCookie('address_name', address_name, 365);
            setCookie('address_lat', address_lat, 365);
            setCookie('address_lng', address_lng, 365);
            setCookie('address_zip', address_zip, 365);
            setCookie('address_city', address_city, 365);
            setCookie('address_state', address_state, 365);
            setCookie('address_country', address_country, 365);
            <?php if(Request::is('/')){ ?>
            if (typeof is_layer == "undefined") {
                callStore();
            }
            <?php } ?>
        });

    }

    async function getCurrentLocationAddress1() {

        var geocoder = new google.maps.Geocoder();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async function(position) {
                    var address_city = "";
                    var address_country = "";
                    var address_state = "";
                    var address_street = "";
                    var address_street2 = "";
                    var address_street3 = "";
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords
                        .longitude);
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });


                    var location = new google.maps.LatLng(pos['lat'], pos[
                        'lng']); // turn coordinates into an object

                    geocoder.geocode({
                        'latLng': location
                    }, async function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {

                            if (results.length > 0) {
                                document.getElementById('user_locationnew').value = results[0]
                                    .formatted_address;
                                address_name1 = '';
                                $.each(results[0].address_components, async function(i,
                                    address_component) {

                                    address_name1 = '';
                                    if (address_component.types[0] == "premise") {
                                        if (address_name1 == '') {
                                            address_name1 = address_component
                                                .long_name;
                                        } else {
                                            address_name2 = address_component
                                                .long_name;
                                        }
                                    } else if (address_component.types[0] ==
                                        "postal_code") {
                                        address_zip = address_component.long_name;
                                    } else if (address_component.types[0] ==
                                        "locality") {
                                        address_city = address_component.long_name;
                                    } else if (address_component.types[0] ==
                                        "administrative_area_level_1") {
                                        address_state = address_component.long_name;
                                    } else if (address_component.types[0] ==
                                        "country") {
                                        address_country = address_component
                                            .long_name;
                                    } else if (address_component.types[0] ==
                                        "street_number") {
                                        address_street = address_component
                                            .long_name;
                                    } else if (address_component.types[0] ==
                                        "route") {
                                        address_street2 = address_component
                                            .long_name;
                                    } else if (address_component.types[0] ==
                                        "political") {
                                        address_street3 = address_component
                                            .long_name;
                                    }
                                });

                                address_lat = results[0].geometry.location.lat();
                                address_lng = results[0].geometry.location.lng();

                                $("#address_lat").val(address_lat);
                                $("#address_lng").val(address_lng);

                                if (results[0].formatted_address) {
                                    $("#address_line1").val(results[0].formatted_address);
                                } else {
                                    $("#address_line1").val(address_street + ", " +
                                        address_street2);
                                }
                                $("#address_line2").val(address_street3);
                                $("#address_city").val(address_city);
                                $("#address_country").val(address_country);
                                $("#address_zipcode").val(address_zip);
                            }

                        }

                    });
                    try {

                    } catch (err) {

                    }

                },
                function() {

                });
        }
    }

    var email_templates = database.collection('email_templates').where('type', '==', 'new_order_placed');

    var emailTemplatesData = null;

    var currentCurrency = "";
    var currencyAtRight = false;
    var decimal_degits = 0;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);

    refCurrency.get().then(async function(snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });

    async function sendMailData(userEmail, userName, orderId, address, paymentMethod, products, couponCode, discount,
        specialDiscount, taxSetting, deliveryCharge, tipAmount) {

        await email_templates.get().then(async function(snapshots) {
            emailTemplatesData = snapshots.docs[0].data();

        });

        var formattedDate = new Date();
        var month = formattedDate.getMonth() + 1;
        var day = formattedDate.getDate();
        var year = formattedDate.getFullYear();

        month = month < 10 ? '0' + month : month;
        day = day < 10 ? '0' + day : day;

        formattedDate = day + '-' + month + '-' + year;

        var shippingddress = '';

        if (address.hasOwnProperty('line1')) {

            if (address.line1 != '') {
                shippingddress = address.line1;
            }

            shippingddress = address.line1;
        }
        if (address.hasOwnProperty('line2')) {

            if (address.line2 != '') {
                shippingddress = shippingddress + ',' + address.line2;
            }

        }
        if (address.hasOwnProperty('city')) {
            if (address.city != '') {
                shippingddress = shippingddress + ',' + address.city;
            }
        }

        if (address.hasOwnProperty('postalCode')) {
            if (address.postalCode != '') {
                shippingddress = shippingddress + ',' + address.postalCode;
            }
        }

        var productDetailsHtml = '';
        var subTotal = 0;

        products.forEach((product) => {


            productDetailsHtml += '<tr>';

            var extra_html = '';
            var extras_price = 0;
            var price_item = parseFloat(product.price).toFixed(decimal_degits);
            var totalProductPrice = parseFloat(price_item) * parseInt(product.quantity);

            if (product.extras != undefined && product.extras != '' && product.extras.length > 0) {
                var extra_count = 1;
                try {

                    var extras_price_item = (parseFloat(product.extras_price) * parseInt(product.quantity))
                        .toFixed(decimal_degits);
                    if (parseFloat(extras_price_item) != NaN && product.extras_price != undefined) {
                        extras_price = extras_price_item;
                    }
                    totalProductPrice = parseFloat(extras_price) + parseFloat(totalProductPrice);

                    product.extras.forEach((extra) => {

                        if (extra_count > 1) {
                            extra_html = extra_html + ',' + extra;
                        } else {
                            extra_html = extra_html + extra;
                        }
                        extra_count++;
                    })
                } catch (error) {

                }
            }

            totalProductPrice = parseFloat(totalProductPrice).toFixed(decimal_degits);

            productDetailsHtml += '<td style="width: 20%; border-top: 1px solid rgb(0, 0, 0);">';

            productDetailsHtml += product.name;

            if (extra_count > 1) {
                productDetailsHtml += '<br> {{ trans('lang.extra_item') }} : ' + extra_html;
            }

            subTotal += parseFloat(totalProductPrice);

            if (currencyAtRight) {
                price_item = parseFloat(price_item).toFixed(decimal_degits) + "" + currentCurrency;
                extras_price = parseFloat(extras_price).toFixed(decimal_degits) + "" + currentCurrency;
                totalProductPrice = parseFloat(totalProductPrice).toFixed(decimal_degits) + "" +
                    currentCurrency;
            } else {
                price_item = currentCurrency + "" + parseFloat(price_item).toFixed(decimal_degits);
                extras_price = currentCurrency + "" + parseFloat(extras_price).toFixed(decimal_degits);
                totalProductPrice = currentCurrency + "" + parseFloat(totalProductPrice).toFixed(
                    decimal_degits);
            }


            productDetailsHtml += '</td>';
            productDetailsHtml += '<td style="width: 20%; border: 1px solid rgb(0, 0, 0);">' + product
                .quantity + '</td><td style="width: 20%; border: 1px solid rgb(0, 0, 0);">' + price_item +
                '</td><td style="width: 20%; border: 1px solid rgb(0, 0, 0);">' + extras_price +
                '</td><td style="width: 20%; border: 1px solid rgb(0, 0, 0);">  ' + totalProductPrice +
                '</td>';

            productDetailsHtml += '</tr>';

        });

        var specialDiscountVal = '';
        var specialDiscountAmount = 0;
        var totalAmount = 0;

        if (specialDiscount.specialType != '') {

            specialDiscountAmount = parseFloat(specialDiscount.special_discount).toFixed(2);

            if (specialDiscount.specialType == "percentage") {
                specialDiscountVal = specialDiscount.special_discount_label + '%';
            } else {
                if (currencyAtRight) {
                    specialDiscountVal = parseFloat(specialDiscount.special_discount_label).toFixed(
                        decimal_degits) + "" + currentCurrency;
                } else {
                    specialDiscountVal = currentCurrency + "" + parseFloat(specialDiscount.special_discount_label)
                        .toFixed(decimal_degits);
                }
            }
        }

        var afterDiscountTotal = subTotal - (specialDiscountAmount + parseFloat(discount));

        var taxDetailsHtml = '';
        var total_tax_amount = 0;

        if (taxSetting.length > 0) {

            for (var i = 0; i < taxSetting.length; i++) {
                var data = taxSetting[i];

                var tax = 0;
                var taxvalue = 0;
                var taxlabel = "";
                var taxlabeltype = "";

                if (data.type && data.tax) {

                    tax = data.tax;
                    taxvalue = data.tax;
                    if (data.type == "percentage") {
                        tax = (data.tax * afterDiscountTotal) / 100;
                        taxlabeltype = "%";
                    }
                    taxlabel = data.title;
                }
                if (!isNaN(tax) && tax != 0) {
                    total_tax_amount += parseFloat(tax);

                    if (currencyAtRight) {
                        tax = parseFloat(tax).toFixed(decimal_degits) + '' + currentCurrency;
                        if (data.type == "fix") {

                            taxvalue = parseFloat(taxvalue).toFixed(decimal_degits) + '' + currentCurrency;

                        }
                    } else {
                        tax = currentCurrency + parseFloat(tax).toFixed(decimal_degits);
                        if (data.type == "fix") {
                            taxvalue = currentCurrency + parseFloat(taxvalue).toFixed(decimal_degits);

                        }
                    }
                    var html = '';

                    if (taxDetailsHtml != '') {
                        html = '<br>';
                    }

                    taxDetailsHtml += html + '<span style="font-size: 1rem;">' + taxlabel + " (" + taxvalue +
                        taxlabeltype + '):' + tax + '</span>';
                }
            }
        }

        totalAmount = parseFloat(subTotal) - (parseFloat(specialDiscountAmount) + parseFloat(discount)) +
            parseFloat(total_tax_amount) + parseFloat(deliveryCharge) + parseFloat(tipAmount);


        if (currencyAtRight) {
            subTotal = parseFloat(subTotal).toFixed(decimal_degits) + "" + currentCurrency;
            discount = parseFloat(discount).toFixed(decimal_degits) + "" + currentCurrency;
            deliveryCharge = parseFloat(deliveryCharge).toFixed(decimal_degits) + "" + currentCurrency;
            tipAmount = parseFloat(tipAmount).toFixed(decimal_degits) + "" + currentCurrency;
            specialDiscountAmount = parseFloat(specialDiscountAmount).toFixed(decimal_degits) + "" +
                currentCurrency;
            totalAmount = parseFloat(totalAmount).toFixed(decimal_degits) + "" + currentCurrency;
        } else {
            subTotal = currentCurrency + "" + parseFloat(subTotal).toFixed(decimal_degits);
            discount = currentCurrency + "" + parseFloat(discount).toFixed(decimal_degits);
            deliveryCharge = currentCurrency + "" + parseFloat(deliveryCharge).toFixed(decimal_degits);
            tipAmount = currentCurrency + "" + parseFloat(tipAmount).toFixed(decimal_degits);
            specialDiscountAmount = currentCurrency + "" + parseFloat(specialDiscountAmount).toFixed(
                decimal_degits);
            totalAmount = currentCurrency + "" + parseFloat(totalAmount).toFixed(decimal_degits);
        }

        var productHtml =
            '<table style="width: 100%; border-collapse: collapse; border: 1px solid rgb(0, 0, 0);">\n' +
            '    <thead>\n' +
            '        <tr>\n' +
            '            <th style="text-align: left; border: 1px solid rgb(0, 0, 0);">{{ trans('lang.product_name') }}<br></th>\n' +
            '            <th style="text-align: left; border: 1px solid rgb(0, 0, 0);">{{ trans('lang.quantity_plural') }}<br></th>\n' +
            '            <th style="text-align: left; border: 1px solid rgb(0, 0, 0);">{{ trans('lang.price') }}<br></th>\n' +
            '            <th style="text-align: left; border: 1px solid rgb(0, 0, 0);">{{ trans('lang.extra_item') }} {{ trans('lang.price') }}<br></th>\n' +
            '            <th style="text-align: left; border: 1px solid rgb(0, 0, 0);">{{ trans('lang.total') }}<br></th>\n' +
            '        </tr>\n' +
            '    </thead>\n' +
            '    <tbody id="productDetails">' + productDetailsHtml + '</tbody>\n' +
            '</table>';


        var subject = emailTemplatesData.subject;

        subject = subject.replace(/{orderid}/g, orderId);
        emailTemplatesData.subject = subject;

        var message = emailTemplatesData.message;
        message = message.replace(/{username}/g, userName);
        message = message.replace(/{date}/g, formattedDate);
        message = message.replace(/{orderid}/g, orderId);
        message = message.replace(/{address}/g, shippingddress);
        message = message.replace(/{paymentmethod}/g, paymentMethod);
        message = message.replace(/{productdetails}/g, productHtml);
        if (couponCode) {
            message = message.replace(/{coupon}/g, '(' + couponCode + ')');
        } else {
            message = message.replace(/{coupon}/g, "");
        }


        message = message.replace(/{discountamount}/g, discount);

        if (specialDiscountVal != '') {
            message = message.replace(/{specialcoupon}/g, '(' + specialDiscountVal + ')');
        } else {
            message = message.replace(/{specialcoupon}/g, "");
        }
        message = message.replace(/{specialdiscountamount}/g, specialDiscountAmount);

        if (taxDetailsHtml != '') {
            message = message.replace(/{taxdetails}/g, taxDetailsHtml);

        } else {
            message = message.replace(/{taxdetails}/g, "");

        }
        message = message.replace(/{shippingcharge}/g, deliveryCharge);
        message = message.replace(/{subtotal}/g, subTotal);
        message = message.replace(/{tipamount}/g, tipAmount);
        message = message.replace(/{totalAmount}/g, totalAmount);

        emailTemplatesData.message = message;

        var url = "{{ url('send-email') }}";

        return await sendEmail(url, emailTemplatesData.subject, emailTemplatesData.message, [userEmail]);
    }

    async function sendEmail(url, subject, message, recipients) {

        var checkFlag = false;

        await $.ajax({

            type: 'POST',
            data: {
                subject: subject,
                message: message,
                recipients: recipients
            },
            url: url,
            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                checkFlag = true;
            },
            error: function(xhr, status, error) {
                checkFlag = true;
            }
        });

        return checkFlag;

    }


    <?php if(@Route::current()->getName() == 'checkout'){ ?>

    //google.maps.event.addDomListener(window, 'load', initializeCheckout);

    function initializeCheckout() {

        if (address_name != '') {
            document.getElementById('address_line1').value = address_name;

        }
        var input = document.getElementById('address_line1');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {

            var place = autocomplete.getPlace();
            address_name = place.name;
            address_lat = place.geometry.location.lat();
            address_lng = place.geometry.location.lng();
            $.each(place.address_components, function(i, address_component) {
                address_name1 = '';

                if (address_component.types[0] == "premise") {
                    if (address_name1 == '') {
                        address_name1 = address_component.long_name;
                    } else {
                        address_name2 = address_component.long_name;
                    }
                } else if (address_component.types[0] == "postal_code") {
                    address_zip = address_component.long_name;
                } else if (address_component.types[0] == "locality") {
                    address_city = address_component.long_name;
                } else if (address_component.types[0] == "administrative_area_level_1") {
                    var address_state = address_component.long_name;
                } else if (address_component.types[0] == "country") {
                    var address_country = address_component.long_name;
                }
            });

            $("#address_line2").val(address_name2);
            $("#address_lat").val(address_lat);
            $("#address_lng").val(address_lng);
            $("#address_line2").val(address_name2);
            $("#address_city").val(address_city);
            $("#address_country").val(address_country);
            $("#address_zipcode").val(address_zip);
        });

    }

    <?php } ?>

    async function getCurrentLocation(type = '') {
        var geocoder = new google.maps.Geocoder();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords
                        .longitude);
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });

                    var location = new google.maps.LatLng(pos['lat'], pos['lng']);
                    geocoder.geocode({
                        'latLng': location
                    }, async function(results, status) {

                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results.length > 0) {

                                document.getElementById('user_locationnew').value = results[0]
                                    .formatted_address;
                                address_name1 = '';
                                $.each(results[0].address_components, async function(i,
                                    address_component) {
                                    address_name1 = '';
                                    if (address_component.types[0] == "premise") {
                                        if (address_name1 == '') {
                                            address_name1 = address_component
                                                .long_name;
                                        } else {
                                            address_name2 = address_component
                                                .long_name;
                                        }
                                    } else if (address_component.types[0] ==
                                        "postal_code") {
                                        address_zip = address_component.long_name;
                                    } else if (address_component.types[0] ==
                                        "locality") {
                                        address_city = address_component.long_name;
                                    } else if (address_component.types[0] ==
                                        "administrative_area_level_1") {
                                        var address_state = address_component
                                            .long_name;
                                    } else if (address_component.types[0] ==
                                        "country") {
                                        var address_country = address_component
                                            .long_name;
                                    }
                                });

                                address_name = results[0].formatted_address;
                                address_lat = results[0].geometry.location.lat();
                                address_lng = results[0].geometry.location.lng();

                                setCookie('address_name1', address_name1, 365);
                                setCookie('address_name2', address_name2, 365);
                                setCookie('address_name', address_name, 365);
                                setCookie('address_lat', address_lat, 365);
                                setCookie('address_lng', address_lng, 365);
                                setCookie('address_zip', address_zip, 365);
                                setCookie('address_city', address_city, 365);
                                setCookie('address_state', address_state, 365);
                                setCookie('address_country', address_country, 365);

                                if (type == 'reload') {
                                    window.location.reload(true);
                                }
                            }
                        }
                    });
                    try {
                        if (autocomplete) {
                            autocomplete.setBounds(circle.getBounds());
                        }
                    } catch (err) {

                    }

                },
                function() {

                });
        } else {
            // Browser doesn't support Geolocation
        }
    }

    function saveShippingAddress() {

        var line1 = $("#address_line1").val();
        var line2 = $("#address_line2").val();
        var city = $("#address_city").val();
        var country = $("#address_country").val();
        var postalCode = $("#address_zipcode").val();
        var full_address = '';

        if (cuser_id != "") {

            userDetailsRef.get().then(async function(userSnapshots) {

                var userDetails = userSnapshots.docs[0].data();

                if (userDetails.hasOwnProperty('shippingAddress')) {
                    var shippingAddress = userDetails.shippingAddress;

                    shippingAddress.line1 = $("#address_line1").val();
                    shippingAddress.line2 = $("#address_line2").val();
                    shippingAddress.city = $("#address_city").val();
                    shippingAddress.country = $("#address_country").val();
                    shippingAddress.postalCode = $("#address_zipcode").val();
                } else {
                    var shippingAddress = [];
                    var shippingAddress = {
                        "line1": line1,
                        "line2": line2,
                        "city": city,
                        "country": country,
                        "postalCode": postalCode
                    };
                }


                setCookie('address_name1', line1, 365);
                setCookie('address_name2', line2, 365);
                setCookie('address_lat', jQuery("#address_lat").val(), 365);
                setCookie('address_lng', jQuery("#address_lng").val(), 365);
                setCookie('address_zip', postalCode, 365);
                setCookie('address_city', city, 365);
                setCookie('address_country', country, 365);
                if (line1 != "") {
                    full_address = line1;
                }
                if (line2 != "") {
                    full_address = full_address + ',' + line2;
                }
                if (postalCode != "") {
                    full_address = full_address + ',' + postalCode;
                }
                if (city != "") {
                    full_address = full_address + ',' + city;
                }
                if (country != "") {
                    full_address = full_address + ',' + country;
                }
                setCookie('address_name', full_address, 365);
                database.collection('users').doc(cuser_id).update({
                    'shippingAddress': shippingAddress
                }).then(function(result) {

                    $('#close_button').trigger("click");
                    location.reload();
                });

            });

        } else {
            setCookie('address_name1', line1, 365);
            setCookie('address_name2', line2, 365);
            setCookie('address_lat', jQuery("#address_lat").val(), 365);
            setCookie('address_lng', jQuery("#address_lng").val(), 365);
            setCookie('address_zip', postalCode, 365);
            setCookie('address_city', city, 365);
            setCookie('address_country', country, 365);

            if (line1 != "") {
                full_address = line1;
            }
            if (line2 != "") {
                full_address = full_address + ',' + line2;
            }
            if (postalCode != "") {
                full_address = full_address + ',' + postalCode;
            }
            if (city != "") {
                full_address = full_address + ',' + city;
            }
            if (country != "") {
                full_address = full_address + ',' + country;
            }
            setCookie('address_name', full_address, 365);
            $('#close_button').trigger("click");
            location.reload();
        }
    }

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function deleteCookie(name) {
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
</script>

<script type="text/javascript">
    <?php
    use App\Models\user;
    use App\Models\VendorUsers;
    $user_email = '';
    $user_uuid = '';
    $auth_id = Auth::id();
    if ($auth_id) {
        $user = user::select('email')
            ->where('id', $auth_id)
            ->first();
        $user_email = $user->email;
        $user_uuid = VendorUsers::select('uuid')
            ->where('email', $user_email)
            ->first();
        $user_uuid = $user_uuid->uuid;
    }
    ?>

    var database = firebase.firestore();

    var placeholderImageHeader = '';
    var googleMapKeySettingHeader = database.collection('settings').doc("googleMapKey");
    googleMapKeySettingHeader.get().then(async function(googleMapKeySnapshotsHeader) {
        var placeholderImageHeaderData = googleMapKeySnapshotsHeader.data();
        placeholderImageHeader = placeholderImageHeaderData.placeHolderImage;
    })

    var user_email = "<?php echo $user_email; ?>";
    var user_ref = '';
    var referral_ref = '';
    if (user_email != '') {
        var user_uuid = "<?php echo $user_uuid; ?>";
        user_ref = database.collection('users').where("id", "==", user_uuid);
        referral_ref = database.collection('referral').doc(user_uuid);
    }

    var ref = database.collection('settings').doc("globalSettings");
    ref.get().then(async function(snapshots) {
        var globalSettings = snapshots.data();
        $("#logo_web").attr('src', globalSettings.appLogo);
        $("#footer_logo_web").attr('src', globalSettings.appLogo);
    });

    $(document).ready(function() {
        jQuery("#data-table_processing").show();
        if (user_ref != '') {
            user_ref.get().then(async function(profileSnapshots) {
                if (profileSnapshots.docs.length) {
                    var profile_user = profileSnapshots.docs[0].data();
                    var profile_name = profile_user.firstName + " " + profile_user.lastName;
                    if (profile_user.profilePictureURL != '') {
                        $("#dropdownMenuButton").append('<img alt="#" src="' + profile_user
                            .profilePictureURL +
                            '" class="img-fluid rounded-circle header-user mr-2 header-user">Hi ' +
                            profile_user.firstName);
                    } else {
                        $("#dropdownMenuButton").append('<img alt="#" src="' + placeholderImage +
                            '" class="img-fluid rounded-circle header-user mr-2 header-user">Hi ' +
                            profile_user.firstName);
                    }

                    if (profile_user.shippingAddress) {
                        $("#user_location").html(profile_user.shippingAddress.city);
                    }
                }
            })
        }


        if (referral_ref) {
            referral_ref.get().then(async function(refSnapshot) {
                var referral_data = refSnapshot.data();
                if (referral_data != undefined && referral_data.referralCode != null &&
                    referral_data.referralCode != undefined) {
                    $(".referral_code").html("<b>{{ trans('lang.your_referral_code') }} : " +
                        referral_data.referralCode + "</b>");
                }
            })
        }
    })


    $(".user-logout-btn").click(async function() {
        firebase.auth().signOut().then(function() {
            var logoutURL = "{{ route('logout') }}";
            $.ajax({
                type: 'POST',
                url: logoutURL,
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data1) {
                    if (data1.logoutuser) {
                        window.location = "{{ route('login') }}";
                    }
                }
            })
        });
    });


    $(document).ready(function() {

        <?php if(isset($_COOKIE['section_id'])){  ?>

        <?php if(isset($_COOKIE['dine_in_active']) && $_COOKIE['dine_in_active'] == 'true'){ ?>
        $(".dine_in_menu").show();
        $(".dine_in_menu").attr('style', 'display: block !important');
        <?php } ?>
        <?php }?>

        $(document).on("click", ".select_section", async function(e) {
            var section_id = $(this).attr('data-id');
            var section_name = $(this).attr('data-name');
            var section_color = $(this).attr('data-color');
            var dine_in_active = $(this).attr('data-dine_in');
            var service_type = $(this).attr('service_type');
            if (dine_in_active != 'true') {
                dine_in_active = 'false';
            }

            if (getCookie('service_type') == "Parcel Delivery Service" || getCookie(
                    'service_type') == "Rental Service" || getCookie('service_type') ==
                "Cab Service") {
                setCookie('section_id', section_id, 365);
                setCookie('section_name', section_name, 365);
                setCookie('section_color', section_color, 365);
                setCookie('dine_in_active', dine_in_active.toString(), 365);
                setCookie('service_type', service_type, 365);

                window.location.href = "<?php echo url('/'); ?>";
            } else {

                await $.ajax({
                    url: 'check-cart-data',
                    type: 'GET',
                    success: async function(result) {

                        //var data = JSON.parse(result);

                        if (result > 0) {

                            var confirmation = confirm(
                                "If you select this Section/Service,your previously added items will be removed from the cart"
                            );
                            if (confirmation) {

                                await $.ajax({
                                    data: {
                                        "_token": "{{ csrf_token() }}",

                                    },
                                    url: 'remove-cart-data',
                                    type: 'POST',
                                    success: function(result) {
                                        setCookie('section_id', section_id,
                                            365);
                                        setCookie('section_name',
                                            section_name, 365);
                                        setCookie('section_color',
                                            section_color, 365);
                                        setCookie('dine_in_active',
                                            dine_in_active.toString(),
                                            365);
                                        setCookie('service_type',
                                            service_type, 365);

                                        window.location.href =
                                            "<?php echo url('/'); ?>";
                                    }
                                });
                            }

                        } else {
                            setCookie('section_id', section_id, 365);
                            setCookie('section_name', section_name, 365);
                            setCookie('section_color', section_color, 365);
                            setCookie('dine_in_active', dine_in_active.toString(), 365);
                            setCookie('service_type', service_type, 365);

                            window.location.href = "<?php echo url('/'); ?>";
                        }
                    }
                });
            }
        });
    });
</script>


<script type="text/javascript" src="{{ asset('js/rocket-loader.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('https://static.cloudflareinsights.com/beacon.min.js') }}"></script>

<?php if(Auth::user()){ ?>

<script type="text/javascript">
    var route1 = '<?php echo route('my_order'); ?>';
    var routeparcel = '<?php echo route('parcel_orders'); ?>';
    var routerental = '<?php echo route('rental_orders'); ?>';

    var orderAcceptedSubject = '';
    var orderAcceptedMsg = '';
    var orderRejectedSubject = '';
    var orderRejectedMsg = '';
    var orderCompletedSubject = '';
    var orderCompletedMsg = '';
    var storeOrderCompletedSubject = '';
    var storeOrderCompletedMsg = '';
    var storeOrderAcceptedSubject = '';
    var storeOrderAcceptedMsg = '';
    var takeAwayOrderCompletedSubject = '';
    var takeAwayOrderCompletedMsg = '';
    var driverAcceptedSubject = '';
    var driverAcceptedMsg = '';
    var dineInAcceptedSubject = '';
    var dineInAcceptedMsg = '';
    var dineInRejectedSubject = '';
    var dineInRejectedMsg = '';

    var parcelCompletedSubject = '';
    var parcelCompletedMsg = '';

    var cabAccepetedSubject = '';
    var cabAccepetedMsg = '';

    var cabCompletedSubject = '';
    var cabCompletedMsg = '';

    var parcelAccepetedSubject = '';
    var parcelAccepetedMsg = '';

    var parcelRejectedSubject = '';
    var parcelRejectedMsg = '';

    var rentalRejectedSubject = '';
    var rentalRejectedMsg = '';

    var rentalAccepetedSubject = '';
    var rentalAccepetedMsg = '';

    var startRideSubject = '';
    var startRideMsg = '';

    var rentalCompletedSubject = '';
    var rentalCompletedMsg = '';

    var storeOrderInTransitSubject = "";
    var storeOrderInTransitMsg = "";

    var database = firebase.firestore();

    database.collection('dynamic_notification').get().then(async function(snapshot) {
        if (snapshot.docs.length > 0) {
            snapshot.docs.map(async (listval) => {
                val = listval.data();


                if (val.type == "driver_accepted") {

                    driverAcceptedSubject = val.subject;
                    driverAcceptedMsg = val.message;

                } else if (val.type == "restaurant_rejected") {

                    orderRejectedSubject = val.subject;
                    orderRejectedMsg = val.message;

                } else if (val.type == "takeaway_completed") {
                    takeAwayOrderCompletedSubject = val.subject;
                    takeAwayOrderCompletedMsg = val.message;

                } else if (val.type == "driver_completed") {
                    orderCompletedSubject = val.subject;
                    orderCompletedMsg = val.message;

                } else if (val.type == "store_completed") {
                    storeOrderCompletedSubject = val.subject;
                    storeOrderCompletedMsg = val.message;

                } else if (val.type == "store_accepted") {
                    storeOrderAcceptedSubject = val.subject;
                    storeOrderAcceptedMsg = val.message;

                } else if (val.type == "store_intransit") {
                    storeOrderInTransitSubject = val.subject;
                    storeOrderInTransitMsg = val.message;

                } else if (val.type == "restaurant_accepted") {

                    orderAcceptedSubject = val.subject;
                    orderAcceptedMsg = val.message;

                } else if (val.type == "dinein_accepted") {
                    dineInAcceptedSubject = val.subject;
                    dineInAcceptedMsg = val.message;

                } else if (val.type == "dinein_canceled") {
                    dineInRejectedSubject = val.subject;
                    dineInRejectedMsg = val.message;
                } else if (val.type == "cab_accepted") {
                    cabAccepetedSubject = val.subject;
                    cabAccepetedMsg = val.message;
                } else if (val.type == "cab_completed") {
                    cabCompletedSubject = val.subject;
                    cabCompletedMsg = val.message;
                } else if (val.type == "parcel_accepted") {

                    parcelAccepetedSubject = val.subject;
                    parcelAccepetedMsg = val.message;
                } else if (val.type == "parcel_rejected") {
                    parcelRejectedSubject = val.subject;
                    parcelRejectedMsg = val.message;
                } else if (val.type == "rental_rejected") {
                    rentalRejectedSubject = val.subject;
                    rentalRejectedMsg = val.message;
                } else if (val.type == "rental_accepted") {
                    rentalAccepetedSubject = val.subject;
                    rentalAccepetedMsg = val.message;
                } else if (val.type == "start_ride") {
                    startRideSubject = val.subject;
                    startRideMsg = val.message;
                } else if (val.type == "rental_completed") {
                    rentalCompletedSubject = val.subject;
                    rentalCompletedMsg = val.message;
                } else if (val.type == "parcel_completed") {

                    parcelCompletedSubject = val.subject;
                    parcelCompletedMsg = val.message;
                }
            });
        }
    });

    var pageloadded = 0;

    database.collection('vendor_orders').where('author.id', "==", cuser_id).onSnapshot(function(doc) {
        if (pageloadded) {
            doc.docChanges().forEach(function(change) {
                val = change.doc.data();

                if (change.type == "modified") {
                    if (val.status == "Order Completed" && val.takeAway == true || val.takeAway ==
                        'true') {

                        $('.order_notification_title').text(takeAwayOrderCompletedSubject);
                        $('.order_notification_message').html(takeAwayOrderCompletedMsg);

                        $("#order_notification_url").attr("href", route1.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");

                    } else if (val.status == "Order Completed" && val.takeAway == false || val
                        .takeAway == 'false') {

                        if (section_id == val.section_id) {

                            if (getCookie('service_type') == "Ecommerce Service") {
                                $('.order_notification_title').text(storeOrderCompletedSubject);
                                $('.order_notification_message').html(storeOrderCompletedMsg);

                            } else if (getCookie('service_type') == "Multivendor Delivery Service") {
                                $('.order_notification_title').text(orderCompletedSubject);
                                $('.order_notification_message').html(orderCompletedMsg);
                            }

                            $("#order_notification_url").attr("href", route1.replace(':id', val.id));

                            $("#order_notification_modal").trigger("click");
                        }
                    } else if (val.status == "In Transit" && getCookie('service_type') ==
                        "Ecommerce Service") {

                        $('.order_notification_title').text(storeOrderInTransitSubject);
                        $('.order_notification_message').html(storeOrderInTransitMsg);

                        $("#order_notification_url").attr("href", route1.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");
                    } else if (val.status == "Order Accepted") {
                        if (section_id == val.section_id) {
                            if (getCookie('service_type') == "Multivendor Delivery Service") {
                                $('.order_notification_title').text(orderAcceptedSubject);
                                $('.order_notification_message').html(orderAcceptedMsg);
                            } else if (getCookie('service_type') == "Ecommerce Service") {
                                $('.order_notification_title').text(storeOrderAcceptedSubject);
                                $('.order_notification_message').html(storeOrderAcceptedMsg);
                            }
                            $("#order_notification_url").attr("href", route1.replace(':id', val.id));

                            $("#order_notification_modal").trigger("click");
                        }

                    } else if (val.status == "Driver Accepted" && getCookie('service_type') ==
                        "Multivendor Delivery Service") {
                        $('.order_notification_title').text(driverAcceptedSubject);
                        $('.order_notification_message').html(driverAcceptedMsg);

                        $("#order_notification_url").attr("href", route1.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");

                    } else if (val.status == "Order Rejected" && getCookie('service_type') ==
                        "Multivendor Delivery Service") {
                        $('.order_notification_title').text(orderRejectedSubject);
                        $('.order_notification_message').html(orderRejectedMsg);

                        $("#order_notification_url").attr("href", route1.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");

                    }
                }

            });
        } else {
            pageloadded = 1;
        }
    });

    var parcel_page_loaded = 0;


    database.collection('parcel_orders').where('author.id', "==", cuser_id).onSnapshot(function(doc) {
        if (parcel_page_loaded) {
            doc.docChanges().forEach(function(change) {
                val = change.doc.data();
                if (change.type == "modified") {
                    if (val.status == "Order Completed") {


                        $('.order_notification_title').text(parcelCompletedSubject);
                        $('.order_notification_message').text(parcelCompletedMsg);

                        $("#order_notification_url").attr("href", routeparcel.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");

                    } else if (val.status == "Driver Accepted") {
                        $('.order_notification_title').text(parcelAccepetedSubject);
                        $('.order_notification_message').text(parcelAccepetedMsg);

                        $("#order_notification_url").attr("href", routeparcel.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");
                    } else if (val.status == "Order Rejected") {
                        $('.order_notification_title').text(parcelRejectedSubject);
                        $('.order_notification_message').text(parcelRejectedMsg);

                        $("#order_notification_url").attr("href", routeparcel.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");
                    }
                }

            });
        } else {
            parcel_page_loaded = 1;
        }
    });

    var rental_page_loaded = 0;


    database.collection('rental_orders').where('author.id', "==", cuser_id).onSnapshot(function(doc) {
        if (rental_page_loaded) {
            doc.docChanges().forEach(function(change) {
                val = change.doc.data();

                if (change.type == "modified") {

                    if (val.status == "Order Completed") {
                        $('.order_notification_title').text(rentalCompletedSubject);
                        $('.order_notification_message').text(rentalCompletedMsg);

                        $("#order_notification_url").attr("href", routerental.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");
                    } else if (val.status == "Driver Accepted") {
                        $('.order_notification_title').text(rentalAccepetedSubject);
                        $('.order_notification_message').text(rentalAccepetedMsg);

                        $("#order_notification_url").attr("href", routerental.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");
                    } else if (val.status == "In Transit") {

                        $('.order_notification_title').text(startRideSubject);
                        $('.order_notification_message').text(startRideMsg);

                        $("#order_notification_url").attr("href", routerental.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");
                    } else if (val.status == "Order Rejected") {
                        $('.order_notification_title').text(rentalRejectedSubject);
                        $('.order_notification_message').text(rentalRejectedMsg);

                        $("#order_notification_url").attr("href", routerental.replace(':id', val.id));

                        $("#order_notification_modal").trigger("click");

                    }
                }

            });
        } else {
            rental_page_loaded = 1;
        }
    });

    var pageloadded_dining = 0;
    database.collection('booked_table').where('author.id', "==", cuser_id).onSnapshot(function(doc) {
        if (pageloadded_dining) {
            doc.docChanges().forEach(function(change) {
                val = change.doc.data();
                if (change.type == "modified") {

                    if (val.status == "Order Accepted") {

                        $('.dinein_order_notification_title').text(dineInAcceptedSubject);
                        $('.dinein_order_notification_message').text(dineInAcceptedMsg);

                        $("#dinein_order_notification_modal").trigger("click");

                    } else if (val.status == "Order Rejected") {

                        $('.dinein_order_notification_title').text(dineInRejectedSubject);
                        $('.dinein_order_notification_message').text(dineInRejectedMsg);

                        $("#dinein_order_notification_modal").trigger("click");

                    }
                }

            });
        } else {
            pageloadded_dining = 1;
        }
    });

    async function getDriver(driverData) {
        var rideDetails = '';
        var client_name = '';
        await database.collection('users').where("id", "==", driverData).get().then(async function(snapshotss) {

            if (snapshotss.docs[0]) {
                var ride_data = snapshotss.docs[0].data();
                client_name = ride_data.firstName;
                $('.accept_name').html($("<span id='np_accept_name'></span>").text(client_name));
                $('.driver_name').html($("<span id='restaurnat_name_1'></span>").text(client_name));
            } else {
                $('.accept_name').html($("<span id='np_accept_name'></span>").text(''));
                $('.driver_name').html($("<span id='restaurnat_name_1'></span>").text(''));


            }
        });
        return client_name;
    }

    async function getRentalDriver(driverData) {
        var rideDetails = '';
        var client_name = '';
        $('.driver_name_').empty('');
        await database.collection('users').where("id", "==", driverData).get().then(async function(snapshotss) {

            if (snapshotss.docs[0]) {
                var ride_data = snapshotss.docs[0].data();
                client_name = ride_data.firstName;
                $('.accept_name_').html($("<span id='np_accept_name'></span>").text(client_name));
                $('.driver_name_').html($("<span id='rental_name_2'></span>").text(client_name));
            } else {
                $('.accept_name_').html($("<span id='np_accept_name'></span>").text(''));
                $('.driver_name_').html($("<span id='restaurnat_name_2'></span>").text(''));
            }
        });
        return client_name;
    }
</script>

<?php } ?>

<script type="text/javascript">
    var langcount = 0;
    var languages_list_main = [];
    var languages_list = database.collection('settings').doc('languages');
    languages_list.get().then(async function(snapshotslang) {
        snapshotslang = snapshotslang.data();
        if (snapshotslang != undefined) {
            snapshotslang = snapshotslang.list;
            languages_list_main = snapshotslang;
            snapshotslang.forEach((data) => {
                if (data.isActive == true) {
                    langcount++;
                    $('#language_dropdown').append($("<option></option>").attr("value", data.slug)
                        .text(data.title));
                }
            });
            if (langcount > 1) {
                $("#language_dropdown_box").css('visibility', 'visible');
            }
            <?php if(session()->get('locale')){ ?>
            $("#language_dropdown").val("<?php echo session()->get('locale'); ?>");
            <?php } ?>

        }
    });

    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function() {
        var slug = $(this).val();
        languages_list_main.forEach((data) => {
            if (slug == data.slug) {
                if (data.is_rtl == undefined) {
                    setCookie('is_rtl', 'false', 365);
                } else {
                    setCookie('is_rtl', data.is_rtl.toString(), 365);
                }
                window.location.href = url + "?lang=" + slug;
            }
        });
    });

    $(document).ready(function() {
        //navigation menu settings
        var $main_nav = $('#main-nav');
        var $toggle = $('.toggle');
        var defaultOptions = {
            disableAt: false,
            customToggle: $toggle,
            levelSpacing: 40,
            navTitle: '<?php echo @$_COOKIE['section_name']; ?> - <?php echo env('APP_NAME'); ?>',
            levelTitles: true,
            levelTitleAsBack: true,
            pushContent: '#container',
            insertClose: 2
        };
        var Nav = $main_nav.hcOffcanvasNav(defaultOptions);
    });
</script>
