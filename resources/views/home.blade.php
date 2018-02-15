@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Billing</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="/charge" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $amount * 100 }}">
                        <input 
                            type="submit"
                            class="btn btn-success"
                            value="Pay with Card"
                            data-key="{{ env('STRIPE_PUB_KEY') }}"
                            data-amount="{{ $amount }}"
                            data-currency="usd"
                            data-locale="auto"
                            data-name="Laravel Stripe"
                            data-description="Stripe random amount payment"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    $(function() {
        $(':submit').on('click', function(event) {
            event.preventDefault();
            var $button = $(this),
                $form = $button.parents('form');
            var opts = $.extend({}, $button.data(), {
                token: function(result) {
                    $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                }
            });
            StripeCheckout.open(opts);
        });
    });
</script>
@endpush