<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Braintree-Demo</title>
    <script src="https://js.braintreegateway.com/web/dropin/1.41.0/js/dropin.js"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="dropin-container"></div>
    <button id="submit-button" class="button button--small button--green">Purchase</button>

    <script>
        var button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
            selector: '#dropin-container'
        }, function(err, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    console.log('ciao');
                });
            })
        });
    </script>
</body>

</html>
