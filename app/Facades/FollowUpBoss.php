<?php

namespace App\Facades;

use App\Http\Requests\StoreLeadRequest;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FollowUpBoss
{
    public static function makeLead(StoreLeadRequest $request)
    {
        $nameArr = explode(' ', trim($request->get('name')));

        $person = [
            'firstName' => $nameArr[0],
            'lastName' => count($nameArr) > 1 ? $nameArr[1] : '',
            'source' => 'MassOffer form',
            'contacted' => false,
            'price' => $request->get('estimatedWorth'),
            'emails' => [
                $request->get('email')
            ],
            'background' =>
                'Looking to sell: ' . $request->get('propertyType') . '. ' .
                'Wants to sell in timeframe: ' . $request->get('timeline') . '. ' .
                'Number of bedrooms: ' . $request->get('bedroomCount') . '. ' .
                'Number of bathrooms: ' . $request->get('bathroomCount') . '. ' .
                'Wants to receive an offer: ' . $request->get('shouldReceiveOffer') . '. ',
        ];

        return Http::timeout(120)
            ->accept('application/json')
            ->withBasicAuth(config('fub.key'), '')
            ->retry(3, 100)
            ->post('https://api.followupboss.com/v1/events', [
                'person' => $person
            ]);
    }
}
