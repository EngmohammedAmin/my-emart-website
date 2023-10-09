@include('layouts.app');


@include('layouts.header');

<div class="siddhi-checkout">


    <div class="container position-relative">

        <div class="py-5 row">

            <div class="col-md-12 mb-3">

                <div>


                    <div class="siddhi-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">

                        <div class="siddhi-cart-item-profile bg-white p-3">

                            <div class="card card-default">


                                <?php

                                $authorName = @$rentalCarsData['cart_order']['authorName'];
                                ?>

                                @if($message = Session::get('success'))

                                    <div class="py-5 linus-coming-soon d-flex justify-content-center align-items-center">

                                        <div class="col-md-6">

                                            <div class="text-center pb-3">

                                                <h1 class="font-weight-bold"><?php if (@$authorName) {
                                                        echo @strtoupper($authorName) . ",";
                                                    } ?> Your Car Booked Successfully</h1>


                                            </div>


                                            <div class="bg-white rounded text-center p-4 shadow-sm">

                                                <h1 class="display-1 mb-4">{{trans('lang.emoji')}}</h1>
                                                <a href="{{route('rental_orders')}}"
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
    {{trans('lang.processing')}}
</div>

@include('layouts.footer');


@include('layouts.nav');


@if($message = Session::get('success'))

    <script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>

    <script type="text/javascript">

        var fcmToken = '';

        var id_order = "<?php echo uniqid();?>";

        var userId = "<?php echo $id; ?>";

        var userDetailsRef = database.collection('users').where('id', "==", userId);

        var firestore = firebase.firestore();

        var geoFirestore = new GeoFirestore(firestore);

        var email_templates = database.collection('email_templates').where('type', '==', 'new_car_book');

        var emailTemplatesData = null;

        <?php

        if(@$rentalCarsData['payment_status'] == true && !empty(@$rentalCarsData['cart_order']['order_json'])){ ?>


        $("#data-table_processing_order").show();
        var order_json = '<?php echo json_encode($rentalCarsData['cart_order']['order_json']); ?>';

        order_json = JSON.parse(order_json);

        finalCheckout();

        function finalCheckout() {

            userDetailsRef.get().then(async function (userSnapshots) {

                var driver = '';
                await database.collection('users').where('id', "==", order_json.driverID).get().then(async function (snapShots) {

                    driver = snapShots.docs[0].data();
                });

                var userDetails = userSnapshots.docs[0].data();

                var authorName = userDetails.firstName + ' ' + userDetails.lastName;
                var userEmail = userDetails.email;

                var payment_method = '<?php echo $payment_method; ?>';

                var createdAt = firebase.firestore.FieldValue.serverTimestamp();

                var discount = "";
                var discountLabel = "";
                var discountType = "";
                var dropAddress = "";
                var dropLatLong = {};
                var pickUpLatLong = {};

                /* var company = {};
                 var companyID = "";

                 let companyData = "";

                 if (order_json.companyID && order_json.companyID != null) {

                     var companyDetailsRef = database.collection('users').where('id', "==", order_json.companyID);

                     companyData = companyDetailsRef.get().then(async function (companySnapshots) {

                         var company = companySnapshots.docs[0].data();
                         fcmToken = company.fcmToken;

                         if (companySnapshots.docs.length == 0) {

                             return;

                         }

                         return companySnapshots.docs[0].data();

                     });

                     company = await companyData.then(function (response) {

                         return response;
                     });
                     companyID = order_json.companyID;

                 } else {*/
                fcmToken = driver.fcmToken;
                /*}*/

                if (order_json.discount != null) {
                    discount = order_json.discount;
                }

                if (order_json.discountLabel != null) {
                    discountLabel = order_json.discountLabel;
                }

                if (order_json.discountType != null) {
                    discountType = order_json.discountType;
                }

                if (order_json.dropAddress != null) {
                    dropAddress = order_json.dropAddress;
                }

                if (order_json.dropLatLong) {

                    dropLatLong = {
                        'latitude': parseFloat(order_json.dropLatLong.latitude),
                        'longitude': parseFloat(order_json.dropLatLong.longitude),
                    };

                }

                pickUpLatLong = {
                    'latitude': parseFloat(order_json.pickUpLatLong.latitude),
                    'longitude': parseFloat(order_json.pickUpLatLong.longitude),
                };

                var taxSetting = [];

                if (order_json.taxSetting && order_json.taxSetting != null && order_json.taxSetting != "null" && order_json.taxSetting != undefined) {
                    taxSetting = order_json.taxSetting;
                }

                for (var i = 0; i < taxSetting.length; i++) {
                    var data = taxSetting[i];

                    data.enable = Boolean(data.enable);

                    taxSetting[i] = data;
                }

                database.collection('rental_orders').doc(id_order).set({
                    'id': id_order,
                    'author': userDetails,
                    'authorID': order_json.authorID,
                    'bookWithDriver': Boolean(order_json.bookWithDriver),
                    /*'company': company,
                    'companyID': companyID,*/
                    'driver': driver,
                    'driverID': order_json.driverID,
                    'createdAt': createdAt,
                    'discount': discount,
                    'discountLabel': discountLabel,
                    'discountType': discountType,
                    'dropAddress': dropAddress,
                    'dropDateTime': new Date(order_json.dropDateTime),
                    'dropLatLong': dropLatLong,
                    'pickupAddress': order_json.pickUpAddress,
                    'pickupDateTime': new Date(order_json.pickUpDateTime),
                    'pickupLatLong': pickUpLatLong,
                    'payment_method': payment_method,
                    'status': order_json.status,
                    'subTotal': order_json.subTotal,
                    'taxSetting': taxSetting,
                    'adminCommission': order_json.adminCommission,
                    'adminCommissionType': order_json.adminCommissionType,
                    'driverRate': order_json.driverRate,

                }).then(function (result) {

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('rental_order_complete'); ?>",

                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'fcm': fcmToken,
                            'authorName': authorName,
                            'subject': order_json.subject,
                            'message': order_json.message
                        },

                        success: async function (data) {

                            if (dropAddress == "") {
                                dropAddress = order_json.pickUpAddress;
                            }
                            var checkMailToCustomer = await sendMailToRental(userEmail, authorName, authorName, order_json.pickUpAddress, dropAddress, new Date(order_json.pickUpDateTime), driver);

                            var checkMailToDriver = await sendMailToRental(driver.email, driver.firstName + ' ' + driver.lastName, authorName, order_json.pickUpAddress, dropAddress, new Date(order_json.pickUpDateTime), driver);

                            data = JSON.parse(data);
                            $("#data-table_processing_order").hide();

                        }

                    });

                });

            });

        }

        async function sendMailToRental(userEmail, userName, passengerName, pickupLocation, dropoffLocation, pickUpDateTime, driverData) {

            await email_templates.get().then(async function (snapshots) {
                emailTemplatesData = snapshots.docs[0].data();

            });

            var formattedDate = new Date(pickUpDateTime);
            var month = formattedDate.getMonth() + 1;
            var day = formattedDate.getDate();
            var year = formattedDate.getFullYear();

            month = month < 10 ? '0' + month : month;
            day = day < 10 ? '0' + day : day;

            var time = formattedDate.getHours() + ":" + formattedDate.getMinutes();

            formattedDate = day + '-' + month + '-' + year;
            var message = emailTemplatesData.message;
            message = message.replace(/{username}/g, userName);
            message = message.replace(/{passengername}/g, passengerName);
            message = message.replace(/{date}/g, formattedDate);
            message = message.replace(/{time}/g, time);
            message = message.replace(/{pickuplocation}/g, pickupLocation);
            message = message.replace(/{dropofflocation}/g, dropoffLocation);
            message = message.replace(/{model}/g, driverData.carName);
            message = message.replace(/{carnumber}/g, driverData.carNumber);
            message = message.replace(/{drivername}/g, driverData.firstName + ' ' + driverData.lastName);
            message = message.replace(/{driverphone}/g, driverData.phoneNumber);

            emailTemplatesData.message = message;

            var url = "{{url('send-email')}}";

            return await sendEmail(url, emailTemplatesData.subject, emailTemplatesData.message, [userEmail]);
        }


        <?php } ?>

    </script>


@endif