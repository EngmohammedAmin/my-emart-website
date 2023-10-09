@include('layouts.app')

@include('layouts.header')


<div class="d-none">

    <div class="bg-primary p-3 d-flex align-items-center">

        <a class="toggle togglew toggle-2" href="#"><span></span></a>

    </div>

</div>

<div class="siddhi-popular">


    <div class="container">

        <div class="search py-5">

            <div class="input-group mb-4">

            </div>

            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">

                    <a class="nav-link active border-0 bg-light text-dark rounded" id="home-tab" data-toggle="tab"
                       href="#home" role="tab" aria-controls="home" aria-selected="true"><i
                                class="feather-home mr-2"></i><span
                                class="vendor_counts">{{trans('lang.all_store')}}</span></a>

                </li>
            </ul>


            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">

                </li>

            </ul>


            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                    <div class="container mt-4 mb-4 p-0">

                        <div id="append_list1" class="res-search-list-1"></div>

                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                <div class="row d-flex align-items-center justify-content-center py-5">

                    <div class="col-md-4 py-5">


                    </div>

                </div>


            </div>


        </div>


    </div>

</div>


@include('layouts.footer')


@include('layouts.nav')


<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript">
    var firestore = firebase.firestore();
    var geoFirestore = new GeoFirestore(firestore);
    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    var end = null;
    var endarray = [];
    var start = null;
    var vendorsref = database.collection('vendors').where('section_id', '==', section_id);
    var VendorNearBy = '';
    var DriverNearByRef = database.collection('settings').doc('VendorNearBy');
    //var myInterval=setInterval(callStore, 1000);

  	var pagesize = 12;
    var nearestRestauantRefnew = '';
    var append_list = '';
    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');
    var placeholderImageSrc = '';

    placeholderImageRef.get().then(async function (placeholderImageSnapshots) {

        var placeHolderImageData = placeholderImageSnapshots.data();

        placeholderImageSrc = placeHolderImageData.image;

    })

    // function myStopTimer() {
    //        clearInterval(myInterval);
    //    }
    callStore();

    async function callStore() {
        
        jQuery("#overlay").show();

        if (address_lat == '' || address_lng == '' || address_lng == NaN || address_lat == NaN || address_lat == null || address_lng == null) {
            return false;
        }


        DriverNearByRef.get().then(async function (DriverNearByRefSnapshots) {
            var DriverNearByRefData = DriverNearByRefSnapshots.data();
            VendorNearBy = parseInt(DriverNearByRefData.radios);

            address_lat = parseFloat(address_lat);
            address_lng = parseFloat(address_lng);
            //myStopTimer();
            getNearestStores();
        })

    }


    async function getNearestStores() {


        if (VendorNearBy) {
            nearestRestauantRefnew = geoFirestore.collection('vendors').near({
                center: new firebase.firestore.GeoPoint(address_lat, address_lng),
                radius: VendorNearBy
            }).where('section_id', '==', section_id);
        } else {
            nearestRestauantRefnew = geoFirestore.collection('vendors').where('section_id', '==', section_id);
        }

        nearestRestauantRefnew.get().then(async function (nearestRestauantSnapshot) {
            most_popular = document.getElementById('append_list1');
            most_popular.innerHTML = '';
            var popularStorehtml = buildHTMLNearestStore(nearestRestauantSnapshot);
            if (popularStorehtml != '') {

                start = nearestRestauantSnapshot.docs[nearestRestauantSnapshot.docs.length - 1];
                endarray.push(nearestRestauantSnapshot.docs[0]);
                most_popular.innerHTML = popularStorehtml;

            }
            jQuery("#overlay").hide();

        })
    }

    sortArrayOfObjects = (arr, key) => {
        return arr.sort((a, b) => {
            return a[key] - b[key];
        });
    };

    function buildHTMLNearestStore(nearestRestauantSnapshot) {
        var html = '';
        var alldata = [];
        /*  nearestRestauantSnapshot.docs.forEach((listval) => {
              var datas = listval.data();
              datas.id = listval.id;
              alldata.push(datas);
          });*/

        nearestRestauantSnapshot.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            var rating = 0;
            var reviewsCount = 0;

            if ('<?php echo @$_GET['popular'] && @$_GET['popular'] == "yes" ?>') {
                if (datas.hasOwnProperty('reviewsSum') && datas.reviewsSum != 0 && datas.hasOwnProperty('reviewsCount') && datas.reviewsCount != 0) {
                    rating = (datas.reviewsSum / datas.reviewsCount);
                    rating = Math.round(rating * 10) / 10;
                }
                datas.rating = rating;
                alldata.push(datas);
            } else {
                alldata.push(datas);
            }
		});
		
        if ('<?php echo @$_GET['popular'] && @$_GET['popular'] == "yes" ?>') {
            if (alldata.length) {
                alldata = sortArrayOfObjects(alldata, "rating");
                alldata = alldata.reverse();
            }
            $('.vendor_counts').text('{{trans('lang.popular_fashion_store')}}');
        }
        
        var count = 0;
        var popularItemCount = 0;
        html = html + '<div class="row">';
        alldata.forEach((listval) => {
            var val = listval;
            var rating = 0;
            var reviewsCount = 0;
            if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
                rating = (val.reviewsSum / val.reviewsCount);
                rating = Math.round(rating * 10) / 10;
                reviewsCount = val.reviewsCount;
            }

            if (rating >= 4 && alldata.length < 4) {
                datas.id = listval.id;
                alldata.push(datas);
            }

            var status = 'Closed';
            var statusclass = "closed";
            if (val.hasOwnProperty('reststatus') && val.reststatus) {
                status = 'Open';
                statusclass = "open";
            }

            var vendor_id_single = val.id;

                <?php if(isset($_GET['dinein']) && @$_GET['dinein'] == 1){ ?>
            var view_vendor_details = "{{ route('dyiningvendor',':id')}}";
                <?php }else{ ?>
            var view_vendor_details = "{{ route('vendor',':id')}}";
            <?php } ?>

                view_vendor_details = view_vendor_details.replace(':id', 'id=' + vendor_id_single);
            count++;

            html = html + '<div class="col-md-3 pb-3"><div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm"><div class="list-card-image">';


            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }

            html = html + '<div class="member-plan position-absolute"><span class="badge badge-dark ' + statusclass + '">' + status + '</span></div><a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="p-3 position-relative"><div class="list-card-body"><h6 class="mb-1"><a href="' + view_vendor_details + '" class="text-black">' + val.title + '</a></h6>';

            html = html + '<p class="text-gray mb-1 small"><span class="fa fa-map-marker"></span> ' + val.location + '</p>';
            if (rating > 0) {
                html = html + '<div class="star position-relative mt-3"><span class="badge badge-success"><i class="feather-star"></i>' + rating + ' (' + reviewsCount + '+)</span></div>';
            }


            html = html + '</div>';
            html = html + '</div></div></div>';


        });
        
        if(alldata.length == 0){
        	html = html + '<p>{{trans("lang.no_results")}}</p>';
        }
        
        html = html + '</div>';
        return html;
    }


    async function moreload() {
        if (start != undefined || start != null) {
            listener = nearestRestauantRefnew.startAfter(start).limit(pagesize).get();
            listener.then(async (snapshots) => {
                html = '';
                html = await buildHTMLNearestStore(snapshots);
                if (html != '') {
                    most_popular.innerHTML += html;
                    start = snapshots.docs[snapshots.docs.length - 1];

                    if (endarray.indexOf(snapshots.docs[0]) != -1) {
                        endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                    }
                    endarray.push(snapshots.docs[0]);

                    if (snapshots.docs.length < pagesize) {

                        jQuery("#loadmore").hide();
                    } else {
                        jQuery("#loadmore").show();
                    }
                }
            });
        }
    }

    async function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {
            listener = ref.startAt(end).limit(pagesize).get();

            listener.then(async (snapshots) => {
                html = '';
                html = await buildHTML(snapshots);
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                    if (snapshots.docs.length < pagesize) {

                        jQuery("#users_table_previous_btn").hide();
                    }

                }
            });
        }
    }

</script>