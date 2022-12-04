@extends('general.master', $setup);

@section('thecontent')
<div class="actions">
    <h2 class="text-white">{{ __('Test order') }}</h2>
</div><br />

<div class="card bg-secondary shadow border-0">
    <div class="card-body px-lg-5 py-lg-5">
        <form id="form-assing-driver" method="POST" action="{{ route('order.store')}}">
            @csrf 
            <p>{{ __('Create new test order.')}}</p>
            @include('partials.input',['id'=>'issd','name'=>'Is Social Drive','placeholder'=>'Social drive','value'=>'1', 'required'=>true])
            @include('partials.input',['id'=>'driver_id','name'=>'Driver id','placeholder'=>'Driver id','value'=>'', 'required'=>true])
            @include('partials.input',['id'=>'phone','name'=>'Phone','placeholder'=>'Phone','value'=>'', 'required'=>true])
            @include('partials.input',['id'=>'comment','name'=>'Comment','placeholder'=>'Comment','value'=>'', 'required'=>true])
            @include('partials.input',['id'=>'pickup_address','name'=>'Pickup address','placeholder'=>'','value'=>'', 'required'=>true])
            @include('partials.input',['id'=>'delivery_address','name'=>'Delivery address','placeholder'=>'','value'=>'', 'required'=>true])
            
            @include('partials.input',['id'=>'delivery_lat','name'=>'delivery_lat','placeholder'=>'','value'=>'', 'required'=>true])
            @include('partials.input',['id'=>'delivery_lng','name'=>'delivery_lng','placeholder'=>'','value'=>'', 'required'=>true])
            
            @include('partials.input',['id'=>'pickup_lat','name'=>'pickup_lat','placeholder'=>'','value'=>'', 'required'=>true])
            @include('partials.input',['id'=>'pickup_lng','name'=>'pickup_lng','placeholder'=>'','value'=>'', 'required'=>true])
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
            </div>
        </form>
    </div>
</div>

@endsection
