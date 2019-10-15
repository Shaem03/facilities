<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Cookie;

class FacilityBooking extends Controller
{
    //
  public function show(Request $request)
    {
    	$facilities = [
    		1 => 'Fitness Center',
    		2 => 'Club House',
    		3 => 'Tennis Court'
    	];

    	$time = [
    		1 => '10am to 4pm',
    		2 => '4pm to 10 pm',
    	];

    	$data = [
    		'facilty' => $facilities,
    		'time' => $time
    	];

		return view('facility_booking', $data);
    }

   public function sub(Request $request){
	    	$name = $request->name;
	    	$date = $request->date;
	    	$time = $request->time;
   			$val = Cookie::get('fac_data'.$name.$time.$date);
   			if ($val){
   				if ($val == $name.$time.$date){
					return array(
	                    'failed' => "Alredy Booked",
	                    'data'   => 'Already Booked'
	                ); 
   				}
   			}
   			else{
				$response = new Response('facility');
				$cook_name = 'fac_data'.$name.$time.$date;
		        $response->withCookie(cookie($cook_name, $name.$time.$date));
		        return $response;
   			}
   }
}
