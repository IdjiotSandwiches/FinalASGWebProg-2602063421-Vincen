<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $registrationFee = $user->price;
        return view('payment.index', compact('registrationFee'));
    }

    public function update(PaymentRequest $paymentRequest)
    {
        $validated = $paymentRequest->validated();

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $wallet = $validated['balance'] - $user->price;

            if ($validated['balance'] > $user->price && !$validated['overpaid']) {
                return back()->withInput()
                    ->with('message' , 'Sorry you overpaid Rp ' . number_format($wallet, 0, ',', '.') .', would you like to enter a balance? or We will enter the rest of your money in the wallet balance');
            } elseif ($wallet < 0) throw new \Exception('You are still underpaid Rp ' . number_format(abs($wallet), 0, ',', '.') . '.');

            $user->wallet = $wallet;
            $user->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['balance' => $e->getMessage()])
                ->withInput();
        }

        return to_route('home');
    }
}
