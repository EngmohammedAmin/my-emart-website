@include('auth.default')
<?php
$countries = file_get_contents(asset('countriesdata.json'));
$countries = json_decode($countries);
$countries = (array)$countries;
$newcountries = array();
$newcountriesjs = array();
foreach ($countries as $keycountry => $valuecountry) {
    $newcountries[$valuecountry->phoneCode] = $valuecountry;
    $newcountriesjs[$valuecountry->phoneCode] = $valuecountry->code;
}
?>

<?php if(isset($_COOKIE['section_color'])){ ?>
<style type="text/css">
    .btn-primary {
        background: <?php echo $_COOKIE['section_color']; ?>;
        border-color: <?php echo $_COOKIE['section_color']; ?>;
    }

    .btn-primary:hover, .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:focus {
        background: <?php echo $_COOKIE['section_color']; ?>;
        border-color: <?php echo $_COOKIE['section_color']; ?>;
    }
</style>
<?php } ?>

<link href="{{ asset('vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<link href="{{ asset('/css/font-awesome.min.css')}}" rel="stylesheet">

<div class="login-page vh-100">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="col-md-6">
            <div class="col-10 mx-auto card p-3">
                <h3 class="text-dark my-0 mb-3">{{trans('lang.forgot_password')}}</h3>

                <form class="mt-3 mb-4" action="#" id="login-box">
                    <div class="form-group">
                        <label for="email_address" class="text-dark">{{trans('lang.user_email')}}</label>
                        <input type="email" placeholder="{{trans('lang.user_email_help_2')}}" class="form-control"
                               id="email_address" aria-describedby="emailHelp" name="email">
                        <div class="error" id="email_address_error"></div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-lg btn-block" id="verify_btn"
                                onclick="callForgotPassword()">{{trans('lang.send_link')}}</button>
                    </div>

                    <div class="form-group">
                        <a href="{{route('login')}}"
                           class="btn btn-primary btn-lg btn-block">{{trans('lang.cancel')}}</a>

                    </div>
                    <div class="form-group">
                        <div class="error" id="authentication_error"></div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js"></script>
<script src="{{ asset('js/crypto-js.js') }}"></script>
<script src="{{ asset('js/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>


<script type="text/javascript">
    var database = firebase.firestore();

    function callForgotPassword() {
        var email_address = $('#email_address').val();

        $('.error').html("");
        if (email_address == "") {
            $('#email_address_error').html("{{trans('lang.email_address_error')}}");

        } else {
            database.collection("users").where("email", "==", email_address).where('role', '==', 'customer').get().then(async function (snapshots) {

                if (snapshots.docs.length > 0) {

                    firebase.auth().sendPasswordResetEmail(email_address).then((result) => {

                        $('#authentication_error').html("{{trans('lang.email_sent')}}");

                    }).catch((error) => {

                        $('#authentication_error').html(error.message);

                    });
                } else {

                    $('#authentication_error').html("{{trans('lang.email_user')}}");
                }
            });

        }
    }
</script>

<!--end page-scripts -->
