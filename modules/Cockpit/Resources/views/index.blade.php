@extends('general.master', $setup);

@section('thecontent')
<div class="actions">
    <h2 class="text-white">{{ __('Orders') }}</h2>
</div><br />
<div class="table-responsive">

    <div>
        <table class="table align-items-center table-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="sort" data-sort="status">{{ __('ID')}}</th>
                    <th scope="col" class="sort" data-sort="phone">{{ __('Client phone')}}</th>
                    <th scope="col" class="sort" data-sort="budget">{{ __('Time')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{ __('Status')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{ __('From')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{ __('To')}}</th>
                    <th scope="col" class="sort" data-sort="driver">{{ __('Driver')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{ __('Distance')}}</th>
                    <th scope="col" class="sort" data-sort="status">{{ __('Price')}}</th>
                    
                    
                   
                </tr>
            </thead>
            <tbody class="list">
               @foreach ($orders as $order)
                   
              
               <tr>
                <td class="action">
                    <a href="{{ route('orders.show',$order->id ) }}" class="text-white">#{{ $order->id }}</a>
                </td>
                <th scope="row">
                    <div class="media align-items-center">
                            <span class="name mb-0 text-sm"><a href="tel:{{$order->phone}}" class="text-white">{{ $order->phone }}</a></span>   
                    </div>
                </th>
                <td class="time">
                    {{ $order->created_at->diffForHumans()}}
                </td>
                <td>
                    <span class="badge badge-dot mr-4">
                      <i class="bg-warning"></i>
                      <span class="status">{{ __($order->displayLastStatus()) }}</span>
                    </span>
                </td>
                <td class="from">
                    {{ $order->pickup_address }}
                </td>
                <td class="to">
                    {{ $order->delivery_address }}
                </td>
                <td class="driver">
                    @if ($order->driver)
                    <a target="_blank" href="{{ route('drivers.edit',$order->driver->id) }}" class="text-white">{{ $order->driver->name }}</a>
                    @endif
                </td>
                <td class="from">
                    {{ $order->distance }} km
                </td>
                <td class="to">
                     @money( $order->delivery_price, config('settings.cashier_currency'),config('settings.do_convertion'))
                </td>
                
                
            </tr>
            @endforeach
               
                
               
                
            </tbody>
        </table>
        <div class="card-footer py-4">
            @if(count($orders))
            <nav class="d-flex justify-content-end" aria-label="...">
                {{ $orders->appends(Request::all())->links() }}
            </nav>
            @else
                <h4>{{ __('You don`t have any orders') }} ...</h4>
            @endif
        </div>
    </div>
    
    </div>
@endsection
