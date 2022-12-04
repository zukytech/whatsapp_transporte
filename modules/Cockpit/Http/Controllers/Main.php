<?php

namespace Modules\Cockpit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Services\ConfChanger;
use App\Order;
use Spatie\Geocoder\Geocoder;
use Spatie\Geocoder\Exceptions\CouldNotGeocode;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Support\Facades\Redirect;

class Main extends Controller
{
    public function live($md){
        $order=Order::where('md',$md)->first();
        if($order!=null){
            return view('taxilanding.live',['order' => $order]);
        }else{
            return view('restorants.error_location', ['message'=>'Location not found']);
        }
    }


    public function livelocationapi($md){
        $order=Order::where('md',$md)->first();
        return response()->json(
            [
                'status'=>'tracing',
                'lat'=>$order->driver->lat,
                'lng'=>$order->driver->lng,
                ]
        );
    }

    public function pickup($md){
        $order=Order::where('md',$md)->first();
        if($order!=null){
            return Redirect::to('https://www.google.com/maps/dir/?api=1&destination='.$order->pickup_lat.','.$order->pickup_lng.'&travelmode=driving
            ');
        }else{
            return view('restorants.error_location', ['message'=>'Location not found']);
        }
    }

    public function directions($md){
        $order=Order::where('md',$md)->first();
        if($order!=null){
            return Redirect::to('https://www.google.com/maps/dir/?api=1&origin='.$order->pickup_lat.','.$order->pickup_lng.'&destination='.$order->delivery_lat.','.$order->delivery_lng.'&travelmode=driving

            ');
        }else{
            return view('restorants.error_location', ['message'=>'Location not found']);
        }
    }

    public function findtaxi(){
        $setup=[
            'title'=>__('Find taxi')
        ];

        //LOCATION BASED SEARCH CASE 4 and 5
            //First, find the provided location, convert it to lat/lng
            $client = new \GuzzleHttp\Client();
            $geocoder = new Geocoder($client);
            $geocoder->setApiKey(config('geocoder.key'));

            try {
                $geoResultsStart = $geocoder->getCoordinatesForAddress(\Request::input('start'));
                $geoResultsEnd = $geocoder->getCoordinatesForAddress(\Request::input('end'));
            } catch (CouldNotGeocode $e) {
                report($e);
                return view('restorants.error_location', ['message'=>'The provided api key GOOGLE_MAPS_API_KEY has restrictions and we can not geocode the address. Please look into the documentation of this product to see what APIs are required to be enabled.']);
            }

            //distance in metters
            $distanceAndTime=$this->getDistanceStartToEnd($geoResultsStart['lat'],$geoResultsStart['lng'],$geoResultsEnd['lat'],$geoResultsEnd['lng']);
            if($distanceAndTime==null){
                return view('restorants.error_location', ['message'=>'The distancematrix API in your Google project is not enabled .']); return view('restorants.error_location', ['message'=>'The distancematrix API in your Google project is not enabled .']);
            }

            $drivers=$this->getNearestDrivers($geoResultsStart['lat'],$geoResultsStart['lng'],$distanceAndTime);
            if($drivers==null){
                return view('restorants.error_location', ['message'=>'The distancematrix API in your Google project is not enabled .']); return view('restorants.error_location', ['message'=>'The distancematrix API in your Google project is not enabled .']);
            }



           // dd($distanceAndTime);
           

        return view('taxilanding.directory',[
            'start'=>[
                'name'=>\Request::input('start'),
                'lat'=>$geoResultsStart['lat'],
                'lng'=>$geoResultsStart['lng']
            ],
            'end'=>[
                'name'=>\Request::input('end'),
                'lat'=>$geoResultsEnd['lat'],
                'lng'=>$geoResultsEnd['lng']
            ],
            'setup' => $setup,
            'drivers'=>$drivers,
            'drivercategories'=>Posts::where('post_type','driver')->get(),
            'distanceAndTime'=>$distanceAndTime,
            'canDoOrdering'=>false
        ]);
    }


    private function getDistanceStartToEnd($lat,$lng,$destinationLat,$destinationLng){
        try {
            $urlForStartToEnd='https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations='.$destinationLat.','.$destinationLng.'&origins='.$lat.','.$lng.'&key='.config('settings.google_maps_api_key');
          
            $responseForStartToEnd = Http::get($urlForStartToEnd);
            return $responseForStartToEnd['rows'][0]['elements'][0];
        } catch (\Throwable $th) {
           
            return null;
        }

    }
    public function getNearestDrivers($lat,$lng,$distanceAndTime){
        try {
            $distance=$distanceAndTime['distance']['value'];
        } catch (\Throwable $th) {
            return  $drivers = User::whereIn('id', [])->get();
        }
        
        $time=$distanceAndTime['duration']['text'];
        $driversQuery = User::role('driver')->where(['working' => 1,'active'=>1]);
        $driversWithGeoIDS = $this->scopeIsWithinMaxDistance($driversQuery, $lat,$lng, 100,'users')->pluck('id');
        $drivers = User::whereIn('id', $driversWithGeoIDS)->get();
        //dd($drivers);

        $googleOrgins="";
        foreach($drivers->pluck('lng','lat') as $latOfDriver => $lngOfDriver) {
            if(strlen($googleOrgins)>0){
                $googleOrgins.="|";
            }
            $googleOrgins.=$latOfDriver.",".$lngOfDriver;
        }
        

        try {
            //Try to find google calculated distance
            $url='https://maps.googleapis.com/maps/api/distancematrix/json?departure_time=now&destinations='.$lat.','.$lng.'&origins='.$googleOrgins.'&key='.config('settings.google_maps_api_key');
            //dd( $url);
            $response = Http::get($url);

            $index=0;
            foreach ($drivers as $key => $driver) {
                $driver->duration_text=$response['rows'][$index]['elements'][0]['duration_in_traffic']['text'];
                $driver->duration_value=$response['rows'][$index]['elements'][0]['duration_in_traffic']['value'];
                $driver->distance=$response['rows'][$index]['elements'][0]['distance']['text'];

                //Set 
                $cost_per_kilometer=config('settings.cost_per_kilometer',2);
                $cost_for_start=config('settings.cost_per_kilometer',5);
                $currency=config('settings.cashier_currency');
                $doConvert=config('settings.do_convertion');
                if($driver->restorant){
                    $cost_per_kilometer=$driver->restorant->getConfig('cost_per_kilometer',2);
                    $cost_for_start=$driver->restorant->getConfig('cost_for_start',5);
                    if(strlen($driver->restorant->currency)>1){
                        $currency=$driver->restorant->currency;
                    }
                    $doConvert=$driver->restorant->do_covertion.""=="1";
                }

                $ridecost=(($distance/1000)*$cost_per_kilometer+$cost_for_start);
                $driver->ride_cost=$ridecost;
               
                $driver->ride_cost_formated=Money($ridecost,$currency,$doConvert.""=="1")->format();
                $driver->ride_time=$time;
                $index++;
            }
            $drivers=$drivers->sortBy('duration_value');
            return $drivers;
           

        } catch (\Throwable $th) {
            dd($th);
            report($th);
            return null;
           
        }
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc');
        if(auth()->user()->restorant){
            //Change currency
            ConfChanger::switchCurrency(auth()->user()->restorant);
            $orders = $orders->where(['restorant_id'=>auth()->user()->restorant->id]);
        }
        
        $setup=[
            'title'=>__('Cockpit')
        ];
        return view('cockpit::index',['setup' => $setup,'orders'=>$orders->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $setup=[
            'title'=>__('Order test')
        ];
        return view('cockpit::create',['setup' => $setup]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cockpit::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cockpit::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
