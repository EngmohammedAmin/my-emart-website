@include('layouts.app')

@include('layouts.header')

<div class="siddhi-home-page">
    <div class="bg-primary px-3 d-none mobile-filter pb-3">
        <div class="row align-items-center">
            <div class="input-group rounded shadow-sm overflow-hidden col-md-9 col-sm-9">
                <div class="input-group-prepend">
                    <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block">
                        <i class="feather-search"></i>
                    </button>
                </div>
                <input type="text" class="shadow-none border-0 form-control" placeholder="Search for vendors or dishes">
            </div>
            <div class="text-white col-md-3 col-sm-3">
                <div class="title d-flex align-items-center">
                    <a class="text-white font-weight-bold ml-auto" data-toggle="modal" data-target="#exampleModal"
                        href="#">{{ trans('lang.filter') }}</a>
                </div>
            </div>

        </div>
    </div>

    {{--  <div class="cabLandingPage">

    </div>  --}}
    <div class="car-landing-page">

        <div class="car-landing-banner">
            <img src="https://emartweb.siswebapp.com/img/car-banner.png">
            <div class="car-banner-content">
                <h1 class="mb-4">{{ trans('lang.best_way_to_get') }}<br> {{ trans('lang.wherever_you_going') }}</h1>
                <p class="text-light">{{ trans('lang.we_will_bring_you_uickly') }}</p>
            </div>
        </div>


        <section class="car-lan-about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content-block">
                            <div class="block-title">
                                <div class="dot-line"></div>
                                <p>{{ trans('lang.words_about_our_cab_service') }}</p>
                                <h2>{{ trans('lang.learn_about_our') }}<br>{{ trans('lang.taxi_company') }}</h2>
                            </div>
                            <p>{{ trans('lang.cab_service_has_provided_car') }}</p>
                            <a href="" class="about-btn">{{ trans('lang.discover_more') }}</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hvr-float-shadow">
                            <div class="image-block">
                                <img src="https://emartweb.siswebapp.com/img/car-about.jpg" alt="Image">
                                <div class="bubble-block">
                                    <div class="inner-block">
                                        <p>{{ trans('lang.trusted_by') }}</p>
                                        <span class="counter">4880</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="car-whychoose-sec">

            <div class="container">
                <div class="block-title text-center mb-5">
                    <div class="dot-line"></div>
                    <p>{{ trans('lang.conexi_benefit_list') }}</p>
                    <h2 class="text-light">{{ trans('lang.why_choose_us') }}</h2>
                </div>
                <div class="row">


                    <div class="col-lg-4">
                        <div class="single-feature-one text-center">
                            <div class="icon-block mb-4">
                                <img src="https://emartweb.siswebapp.com/img/ic1.png">
                            </div>
                            <h3>{{ trans('lang.safety_guarantee') }}</h3>
                            <p>{{ trans('lang.as_a_defensive_driver') }}</p>

                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="single-feature-one text-center">
                            <div class="icon-block mb-4">
                                <img src="https://emartweb.siswebapp.com/img/ic2.png">
                            </div>
                            <h3>{{ trans('lang.cleared_drivers') }}</h3>
                            <p>{{ trans('lang.we_only_hire_dubs') }}</p>

                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="single-feature-one text-center">
                            <div class="icon-block mb-4">
                                <img src="https://emartweb.siswebapp.com/img/ic3.png">
                            </div>
                            <h3>{{ trans('lang.free_quotation') }}</h3>
                            <p>{{ trans('lang.we_can_offer_you_the_right_vehicle') }}</p>

                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="car-our-adenture bg-white">

            <div class="container">

                <div class="block-title text-center mb-5">

                    <h5>{{ trans('lang.whe_clients') }}</h5>
                    <h2 class="pb-2 mb-2">{{ trans('lang.our_advantages') }}</h2>
                    <p>{{ trans('lang.we_created_our_taxi_to_help') }}</p>
                </div>
                <div class="row">
                    <div class="col-md-3 our-adenture-col">
                        <div class="our-adenture-list">
                            <ul class="block-icon">
                                <li>
                                    <span class="icon-image"><img src="https://emartweb.siswebapp.com/img/taxi.png"
                                            class="icon-image"></span>
                                    <div class="block-right">
                                        <h5>{{ trans('lang.luxury_cars') }}</h5>
                                        <div class="descr">{{ trans('lang.we_provide_high_quality') }}

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <span class="icon-image"><img
                                            src="https://emartweb.siswebapp.com/img/carlocation-icon.png"
                                            class="icon-image"></span>
                                    <div class="block-right">
                                        <h5>{{ trans('lang.lots_of_locations') }} </h5>
                                        <div class="descr">{{ trans('lang.we_provide_our_transportation') }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 our-adenture-col-center">
                        <div class="our-adenture-img mb-4">
                            <img src="https://emartweb.siswebapp.com/img/texi-car.jpg">
                        </div>
                    </div>
                    <div class="col-md-3 our-adenture-col">
                        <div class="our-adenture-list adenture-list-rg">
                            <ul class="block-icon">
                                <li>
                                    <span class="icon-image"><img
                                            src="https://emartweb.siswebapp.com/img/navigation.png"
                                            class="icon-image"></span>
                                    <div class="block-right">
                                        <h5>{{ trans('lang.amazing_app') }}</h5>
                                        <div class="descr">{{ trans('lang.download_our_amazing_app') }}
                                        </div>
                                    </div>
                                </li>
                                <li>

                                    <span class="icon-image bg-transparent"><img
                                            src="https://emartweb.siswebapp.com/img/suitcase-bag.png"
                                            class="icon-image"></span>
                                    <div class="block-right">
                                        <h5>{{ trans('lang.additional_services') }} </h5>
                                        <div class="descr">{{ trans('lang.we_offer_vehicles_including_sedans') }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="car-download-sec position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-lg-start">
                        <div class="block-title mb-4">
                            <p class="sub-title">{{ trans('lang.download_eMart') }}</p>
                            <h2 class="sec-title text-white fw-semibold">
                                {{ trans('lang.get_free_eMart_app') }}<br>{{ trans('lang.on_online_store') }}</h2>
                        </div>
                        <p class="text-light mb-4">{{ trans('lang.our_app_we_are_sure_to_have_a_ride') }}</p>
                        <div class="download-btn-wrap">
                            <a target="_blank" href="https://play.google.com/" class="download-btn">
                                <img src="https://emartweb.siswebapp.com/img/cab_google_play.png">
                            </a>
                            <a target="_blank" href="https://www.apple.com/store" class="download-btn">
                                <img src="https://emartweb.siswebapp.com/img/cab_app_store.png">

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="app-mockup">
                            <img src="https://emartweb.siswebapp.com/img/down-mobile_img.png" alt="app mockup">
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

</div>
@include('layouts.footer')

<script src="https://unpkg.com/geofirestore@5.2.0/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/slick/slick.min.js') }}"></script>

<script type="text/javascript">
    var database = firebase.firestore();

    var cabLandingPageRef = database.collection('sections').where('id', '==', section_id);

    jQuery("#overlay").show();

    cabLandingPageRef.get().then(async function(snapshots) {

        var cabLandingPageData = snapshots.docs[0].data();

        if (cabLandingPageData.cab_service_template && cabLandingPageData.cab_service_template != "" &&
            cabLandingPageData.cab_service_template != undefined) {
            $('.cabLandingPage').html(cabLandingPageData.cab_service_template);
            jQuery("#overlay").hide();

        }
    });
</script>
@include('layouts.nav')
