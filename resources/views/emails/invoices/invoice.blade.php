<x-mail::message>
    @component('mail::message')
    # Invoice for Your Car Purchase

    Dear {{ $invoice->user->name }},

    Thank you for your bid on the **{{ $invoice->car->make }} {{ $invoice->car->model }} ({{ $invoice->car->registration_year }})**. Below are the details of your transaction:

    @component('mail::table')
    | Description | Details |
    | ----------------- | -------------------------------------- |
    | **Invoice ID** | {{ $invoice->id }} |
    | **Car** | {{ $invoice->car->make }} {{ $invoice->car->model }} |
    | **Amount** | ${{ number_format($invoice->amount, 2) }} |
    | **Payment Details** | {{ $invoice->payment_details }} |
    | **Transaction Date** | {{ $invoice->created_at->format('F j, Y') }} |
    @endcomponent

    Please proceed with the payment using the above details. Once the payment is received, we will contact you to finalize the sale.

    If you have any questions, feel free to contact our support team.

    Thanks,<br>
    {{ config('app.name') }}
    @endcomponent

</x-mail::message>