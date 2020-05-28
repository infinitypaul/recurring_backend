<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RecurringRequest;
use App\Http\Resources\RecuringResource;
use App\Recurring;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecurringController extends Controller
{
    public function createPlan(Transaction $transaction, RecurringRequest $request){
        $plan = Http::withToken('sk_test_84af83ec016e6185765733f82cd799bb27d85f43')
            ->post('https://api.paystack.co/plan', [
                'name' => $request->user()->name.' '.rand(1234, 9876),
                'amount' => $transaction->price * 100,
                'interval' => $request->interval,
        ]);

        if($plan->successful()){
            $data = $plan->json();
            $subscriber = Http::withToken('sk_test_84af83ec016e6185765733f82cd799bb27d85f43')
                ->post('https://api.paystack.co/subscription', [
                    'customer' => $request->user()->email,
                    'plan' => $data['data']['plan_code'],
                    'authorization' => request()->user()->auth_code
            ]);
            if($subscriber->successful()){
                $subscribe = $subscriber->json();
                $recurring = new Recurring();
                $recurring->plan = $data['data'];
                $recurring->subscribe = $subscribe['data'];
                $recurring->user()->associate(request()->user());
                $recurring->transaction()->associate($transaction);
                $recurring->save();

                return new RecuringResource($recurring);
            }
        }
    }

    protected function createSubscription(){

    }
}
