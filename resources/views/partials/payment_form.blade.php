<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Braintree-Demo</title>
    <script src="https://js.braintreegateway.com/web/dropin/1.41.0/js/dropin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"
        integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <form action="{{ route('payment.process') }}" method="post" id="payment-form">
        @csrf
        <input type="hidden" id="nonce" name="nonce">
        <input type="hidden" id="sponsorship" name="sponsorship" value="1">
        <input type="hidden" id="apartmentid" name="apartmentid">
        <div id="dropin-container"></div>
        <button id="submit-button" class="button button--small button--green">Purchase</button>
    </form>


    <script>
        var button = document.querySelector('#submit-button');

        axios.get('{{ route('payment.token') }}')
            .then(response => {
                //console.log(response.data.client_token);
                braintree.dropin.create({
                    authorization: response.data.client_token,
                    selector: '#dropin-container'
                }, function(err, instance) {
                    button.addEventListener('click', function() {

                        instance.requestPaymentMethod(function(err, payload) {

                            document.querySelector('#nonce').value = payload.nonce;
                            document.querySelector('#apartmentid').value = 5;
                            document.querySelector('#payment-form').submit();
                        });
                    });
                });

            });
    </script>
</body>

</html>
