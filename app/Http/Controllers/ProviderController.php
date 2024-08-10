<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ProviderController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'provider_x' => 'file|mimes:json',
            'provider_y' => 'file|mimes:json',
        ]);

        $flag = false;

        if($request->file('provider_x')) {
            $jsonData = file_get_contents($request->file('provider_x')->getRealPath());
            $data = json_decode($jsonData, true);

            foreach ($data as $item) {
                $itemStatus = 'decline';
                switch ($item['statusCode']) {
                    case 1:
                        $itemStatus = 'authorised';
                        break;
                    case 2:
                        $itemStatus = 'decline';
                        break;
                    case 3:
                        $itemStatus = 'refunded';
                        break;
                    
                    default:
                        $itemStatus = 'decline';
                        break;
                }

                Provider::updateOrCreate(
                ['identification' => $item['parentIdentification']],
                [
                    'balance' => $item['parentAmount'],
                    'currency' => $item['Currency'],
                    'email' => $item['parentEmail'],
                    'status' => $itemStatus,
                    'registration_date' => $item['registerationDate'],
                    'identification' => $item['parentIdentification'],
                    'reference' => 'DataProviderX',
                ]);
            }

            $flag = true;
        }

        if($request->file('provider_y')) {
            $jsonData = file_get_contents($request->file('provider_y')->getRealPath());
            $data = json_decode($jsonData, true);

            foreach ($data as $item) {
                $date = Carbon::createFromFormat('d/m/Y', $item['created_at']);
                $formattedDate = $date->format('Y-m-d');

                $itemStatus = 'decline';
                switch ($item['status']) {
                    case 100:
                        $itemStatus = 'authorised';
                        break;
                    case 200:
                        $itemStatus = 'decline';
                        break;
                    case 300:
                        $itemStatus = 'refunded';
                        break;
                    
                    default:
                        $itemStatus = 'decline';
                        break;
                }

                Provider::updateOrCreate(
                ['identification' => $item['id']],
                [
                    'balance' => $item['balance'],
                    'currency' => $item['currency'],
                    'email' => $item['email'],
                    'status' => $itemStatus,
                    'registration_date' => $formattedDate,
                    'identification' => $item['id'],
                    'reference' => 'DataProviderY',
                ]);
            }

            $flag = true;
        }

        if($flag) {
            $notification = array(
                'message' => 'Data inserted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }

        return redirect()->back();
    }

    public function clearData(Request $request)
    {
        Artisan::call('clear:data');
        $notification = array(
            'message' => 'Data cleared successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
