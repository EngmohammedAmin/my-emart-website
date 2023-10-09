@include('layouts.app')


@include('layouts.header')
@php
    $cityToCountry= file_get_contents(asset('tz-cities-to-countries.json'));
    $cityToCountry=json_decode($cityToCountry,true);
    $countriesJs=array();
    foreach($cityToCountry as $key=>$value){
    $countriesJs[$key]=$value;
    }
@endphp

<div class="siddhi-checkout">


    <div class="container position-relative">

        <div class="py-5 row">

            <div class="col-md-12 mb-3">

                <div>


                    <div class="siddhi-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">

                        <div class="siddhi-cart-item-profile bg-white p-3">

                            <div class="card card-default">


                                <?php $authorName = @$cart['cart_order']['authorName']; ?>


                                @if($message = Session::get('success'))

                                    <div class="py-5 linus-coming-soon d-flex justify-content-center align-items-center">

                                        <div class="col-md-6">

                                            <div class="text-center pb-3">

                                                <h1 class="font-weight-bold"><?php if (@$authorName) {
                                                        echo @strtoupper($authorName) . ",";
                                                    } ?> {{trans('lang.your_order_has_been_successful')}}</h1>

                                                <p>Check your order status in <a href="{{route('my_order')}}"
                                                                                 class="font-weight-bold text-decoration-none text-primary">{{trans('lang.my_orders')}}</a>
                                                    {{trans('lang.about_next_steps_information')}}</p>
                                            </div>


                                            <div class="bg-white rounded text-center p-4 shadow-sm">

                                                <h1 class="display-1 mb-4">{{trans('lang.emoji')}}</h1>

                                                <h6 class="font-weight-bold mb-2">
                                                    {{trans('lang.preparing_your_order')}}</h6>

                                                <p class="small text-muted">{{trans('lang.your_order_will_prepared')}}</p>

                                                <a href="{{route('my_order')}}"
                                                   class="btn rounded btn-primary btn-lg btn-block">{{trans('lang.view_order')}}</a>

                                            </div>

                                        </div>

                                    </div>


                                @endif

                            </div>


                        </div>

                    </div>


                </div>

            </div>

        </div>


    </div>

</div>

<div id="data-table_processing_order" class="dataTables_processing panel panel-default" style="display: none;">
    {{trans('lang.processing_success')}}
</div>


@include('layouts.footer')


@include('layouts.nav')


@if($message = Session::get('success'))

    <script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>

    <script type="text/javascript">

        var fcmToken = '';

        var id_order = "<?php echo uniqid();?>";

        var userId = "<?php echo $id; ?>";

        var userDetailsRef = database.collection('users').where('id', "==", userId);

        var vendorDetailsRef = database.collection('vendors');

        var uservendorDetailsRef = database.collection('users');

        var AdminCommission = database.collection('settings').doc('AdminCommission');

        var razorpaySettings = database.collection('settings').doc('razorpaySettings');

        var firestore = firebase.firestore();

        var geoFirestore = new GeoFirestore(firestore);

        var cityToCountry = '<?php echo json_encode($countriesJs);?>';

        cityToCountry = JSON.parse(cityToCountry);
        var userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        var userCity = userTimeZone.split('/')[1];
        var userCountry = cityToCountry[userCity];

        var taxSetting = [];

        var reftaxSetting = database.collection('tax').where('country', '==', userCountry).where('enable', '==', true).where('sectionId', '==', section_id);
        reftaxSetting.get().then(async function (snapshots) {
            if (snapshots.docs.length > 0) {
                snapshots.docs.forEach((val) => {
                    val = val.data();
                    var obj = '';
                    obj = {
                        'country': val.country,
                        'enable': val.enable,
                        'id': val.id,
                        'tax': val.tax,
                        'title': val.title,
                        'type': val.type,
                    };
                    taxSetting.push(obj);

                })
            }
        });

        <?php if(@$cart['payment_status'] == true && !empty(@$cart['cart_order']['order_json'])){ ?>


        $("#data-table_processing_order").show();
        var order_json = '<?php echo json_encode($cart['cart_order']['order_json']); ?>';

        order_json = JSON.parse(order_json);

        main_vendor_id = $("#main_vendor_id").val();

        uservendorDetailsRef.where('vendorID', "==", order_json.vendorID).get().then(async function (uservendorSnapshots) {
            var userVendorDetails = uservendorSnapshots.docs[0].data();
            if (userVendorDetails && userVendorDetails.fcmToken) {
                fcmToken = userVendorDetails.fcmToken;
            }


        });

        finalCheckout();


        function finalCheckout() {

            userDetailsRef.get().then(async function (userSnapshots) {


                var userDetails = userSnapshots.docs[0].data();

                var payment_method = '<?php echo $payment_method; ?>';

                var vendorID = order_json.vendorID;

                vendorDetailsRef.where('id', "==", vendorID).get().then(async function (vendorSnapshots) {

                    var vendorDetails = vendorSnapshots.docs[0].data();

                    var vendorUser = await getVendorUser(vendorDetails.author);

                    var createdAt = firebase.firestore.FieldValue.serverTimestamp();

                    if (order_json.take_away == 'true') {
                        order_json.take_away = true;
                    }
                    if (order_json.take_away == 'false') {
                        order_json.take_away = false;
                    }
                    for (var n = 0; n < order_json.products.length; n++) {
                        if (order_json.products[n].photo == null) {
                            order_json.products[n].photo = "";
                        }
                        if (order_json.products[n].size == null) {
                            order_json.products[n].size = "";
                        }
                        order_json.products[n].quantity = parseInt(order_json.products[n].quantity);
                    }

                    var discount = 0;
                    if (order_json.discount) {
                        discount = parseInt(order_json.discount);
                    }

                    order_json.specialDiscount.special_discount = parseInt(order_json.specialDiscount.special_discount);
                    order_json.specialDiscount.special_discount_label = parseInt(order_json.specialDiscount.special_discount_label);

                    console.log(order_json);
                    var scheduleTime = null;

                    if (order_json.scheduleTime && order_json.scheduleTime != '' && order_json.scheduleTime != undefined) {
                        scheduleTime = new Date(order_json.scheduleTime);
                    }

                    database.collection('vendor_orders').doc(id_order).set({
                        'address': userDetails.shippingAddress,
                        'author': userDetails,
                        'authorID': order_json.authorID,
                        'couponCode': order_json.couponCode,
                        'couponId': order_json.couponId,
                        'discount': parseFloat(discount),
                        "createdAt": createdAt, 'id': id_order,
                        'products': order_json.products,
                        'status': order_json.status,
                        'vendor': vendorDetails,
                        'vendorID': vendorDetails.id,
                        'deliveryCharge': order_json.deliveryCharge,
                        'tip_amount': order_json.tip_amount,
                        'adminCommission': order_json.adminCommission,
                        'adminCommissionType': order_json.adminCommissionType,
                        'payment_method': payment_method,
                        'takeAway': order_json.take_away,
                        'taxSetting': taxSetting,
                        "notes": order_json.notes,
                        'specialDiscount': order_json.specialDiscount,
                        'section_id': order_json.section_id,
                        "scheduleTime": scheduleTime,

                    }).then(function (result) {

                        $.ajax({

                            type: 'POST',

                            url: "<?php echo route('order-complete'); ?>",

                            data: {
                                _token: '<?php echo csrf_token() ?>',
                                'fcm': fcmToken,
                                'authorName': userDetails.firstName,
                                'subject': order_json.subject,
                                'message': order_json.message
                            },

                            success: async function (data) {

                                $("#data-table_processing_order").hide();

                                var emailUserData = await sendMailData(userDetails.email, userDetails.firstName, id_order, userDetails.shippingAddress, payment_method, order_json.products, order_json.couponCode, discount, order_json.specialDiscount, taxSetting, order_json.deliveryCharge, order_json.tip_amount);
                                if (vendorUser && vendorUser != undefined) {
                                    var emailVendorData = await sendMailData(vendorUser.email, vendorUser.firstName + ' ' + vendorUser.lastName, id_order, userDetails.shippingAddress, payment_method, order_json.products, order_json.couponCode, discount, order_json.specialDiscount, taxSetting, order_json.deliveryCharge, order_json.tip_amount);

                                }

                                data = JSON.parse(data);

                            }

                        });


                    });


                });

            });

        }

        async function getVendorUser(vendorUserId) {

            var vendorUSerData = '';

            await database.collection('users').where('id', "==", vendorUserId).get().then(async function (uservendorSnapshots) {
                if (uservendorSnapshots.docs.length) {
                    vendorUSerData = uservendorSnapshots.docs[0].data();

                }
            });

            return vendorUSerData;

        }
        <?php } ?>

    </script>


@endif