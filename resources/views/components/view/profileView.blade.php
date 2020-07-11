@if (auth()->user()->user_type == 2)

@php
    if (isset($app->frontPayment)) {
        $user = $app->appointment->user;
        $address = $app->appointment->address;
    } else {
        $user = $app->user;
        $address = $app->address;
    }
@endphp

<div class="text-center">
    <img src="{{$user->image()}}" alt="" class="rounded-circle mb-2" width="150">
    <h5>{{$user->name}}</h5>
    <div class="d-flex justify-content-between align-items-center my-4">
        <i class="fa fa-comments" aria-hidden="true"></i>
        <i class="fa fa-file-text" aria-hidden="true"></i>
        <i class="fa fa-users" aria-hidden="true"></i>
        <i class="fa fa-handshake-o" aria-hidden="true"></i>
        <i class="fa fa-map-o" aria-hidden="true"></i>
    </div>
</div>

<div class="mt-5">
    <h4 class="text-muted">Visit Details</h4>
    <div class="my-3">
        <p class="text-muted mb-0">Location</p>
        <h6>{{cityName($address)}}</h6>

        <p class="text-muted mb-0">Address</p>
        <h6>{{cityName($user->address)}}</h6>
    </div>
</div>

@else

<div class="text-center">
    <img src="{{$app->doctor->image()}}" alt="" class="rounded-circle mb-2" width="150">
    <h5>{{$app->doctor->name}}</h5>
    <div class="d-flex justify-content-between align-items-center my-4">
        <i class="fa fa-comments" aria-hidden="true"></i>
        <i class="fa fa-file-text" aria-hidden="true"></i>
        <i class="fa fa-users" aria-hidden="true"></i>
        <i class="fa fa-handshake-o" aria-hidden="true"></i>
        <i class="fa fa-map-o" aria-hidden="true"></i>
    </div>
</div>

<div class="mt-5">
    <h4 class="text-muted">Visit Details</h4>
    <div class="my-3">
        <p class="text-muted mb-0">Category</p>
        <h6>
            @if ($app->doctor->category)
            {{$app->doctor->categories->name}}
            @else
                General
            @endif
        </h6>
    </div>
    <div class="my-3">
        <p class="text-muted mb-0">Payment</p>
        <h6>
            @if ($app->frontPayment == 0)
                <span class="text-danger">None</span>
            @else
                <span class="text-success">{{$app->paymentValue}}</span>
            @endif
        </h6>
    </div>
    <div class="my-3">
        <p class="text-muted mb-0">Location</p>
        <h6>{{cityName($app->doctor->address)}}</h6>
    </div>
</div>

@endif


