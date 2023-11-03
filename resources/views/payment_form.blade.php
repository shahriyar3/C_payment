<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>Payment</h3>
                    <p>Select one of the option</p>

                    @if (\Session::has('message'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <form class="requires-validation" novalidate name="payment_form" id="payment_form" action="{{ route('store_payment') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="payment_id" value="{{ $payment->payment_id }}" readonly>

                        <div class="col-md-12">
                            <input class="form-control" type="text" name="user_name" readonly disabled value="{{ $payment->user_name }}">
                        </div>

                        <div class="col-md-12">
                            <select name="amount" class="form-select mt-3" required>
                                <option selected value="100">100</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label">I confirm that all data are correct</label>
                        </div>


                        <div class="form-button mt-3">
                            <button id="submit" type="submit" class="btn btn-primary">Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
