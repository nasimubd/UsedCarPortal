<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class InvoiceController extends Controller
{
    use AuthorizesRequests;

    public function resend(Invoice $invoice)
    {
        $this->authorize('resend', $invoice);

        Mail::to($invoice->user->email)->send(new InvoiceMail($invoice));

        return back()->with('success', 'Invoice resent successfully.');
    }


    public function index()
    {
        $this->authorize('viewAny', Invoice::class);

        $invoices = Invoice::with(['user', 'car', 'transaction'])
            ->latest()
            ->paginate(20);

        return view('admin.invoices.index', compact('invoices'));
    }
    /**
     * Display the specified invoice.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\View\View
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        return view('invoices.show', compact('invoice'));
    }
}
