<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Bid;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TransactionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the transactions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', Transaction::class);

        $transactions = Transaction::with(['bid.user', 'bid.car', 'admin'])
            ->latest()
            ->paginate(20);

        return view('admin.transactions.index', compact('transactions'));
    }


    /**
     * Handle the selling of a transaction (approve and generate invoice).
     *
     * @param  \App\Models\Transaction  $transaction
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sell(Transaction $transaction, Request $request)
    {
        $this->authorize('sell', $transaction);

        if ($transaction->status !== 'pending') {
            return redirect()->back()->withErrors(['status' => 'Only pending transactions can be processed.']);
        }

        // Update transaction status
        $transaction->status = 'approved';
        $transaction->admin_id = Auth::id();
        $transaction->save();

        // Create an invoice
        $invoice = Invoice::create([
            'transaction_id' => $transaction->id,
            'user_id' => $transaction->bid->user_id,
            'car_id' => $transaction->bid->car_id,
            'amount' => $transaction->bid->amount,
            'payment_details' => 'Please transfer the amount to ABC Cars\' bank account: 123-456-7890 at XYZ Bank.',
        ]);

        // Send the invoice via email
        Mail::to($transaction->bid->user->email)->send(new InvoiceMail($invoice));

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction approved and invoice sent.');
    }

    /**
     * Deny the specified transaction.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deny(Transaction $transaction)
    {
        $this->authorize('deny', $transaction);

        if ($transaction->status !== 'pending') {
            return redirect()->back()->withErrors(['status' => 'Only pending transactions can be denied.']);
        }

        // Update transaction status
        $transaction->status = 'denied';
        $transaction->admin_id = Auth::id();
        $transaction->save();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction denied successfully.');
    }

    public function adminIndex()
    {
        $transactions = Transaction::with(['bid.user', 'bid.car', 'admin'])->latest()->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }
}
