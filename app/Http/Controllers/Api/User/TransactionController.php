<?php

namespace App\Http\Controllers\Api\User;

use App\Helper\ReferenceNumber;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\TransactionRequest;
use App\{Http\Resources\TransactionResource, Http\Resources\UserResource, Service, Transaction};
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    public function create(Service $service, TransactionRequest $request){
        $transaction  = new Transaction();
        $transaction->price = str_replace(",", "", $request->price);
        $transaction->reference = ReferenceNumber::getHashedToken();
        $transaction->user()->associate($request->user());
        $transaction->service()->associate($service);
        $transaction->save();

        return new TransactionResource($transaction);
    }

    public function verify(Transaction $transaction){
        $response = Http::withToken('sk_test_84af83ec016e6185765733f82cd799bb27d85f43')->get('https://api.paystack.co/transaction/verify/'.$transaction->reference);
        if($response->successful()){
            $data = $response->json();
            if(($data['data']['status'] === 'success') && ($data['data']['amount'] === (int)($transaction->price * 100)) && ((bool)$transaction->paid === false)) {
                $transaction->paid = 1;
                $transaction->user()->associate(request()->user());
                $transaction->save();
                if($authCode = $data['data']['authorization']['authorization_code']){
                    $this->saveAuthCode($authCode);
                }
                return (new TransactionResource($transaction))
                    ->additional([
                        'meta' => [
                            'user' => new UserResource($transaction->user),
                        ]]);
            }

        }
        return response()->json([], 422);
    }

    private function saveAuthCode($code){
        $user = auth()->user();
        $user->auth_code = $code;
        $user->save();
    }
}
