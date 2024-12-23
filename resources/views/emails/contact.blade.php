<p>You have received a new contact message:</p>

<p><strong>Name:</strong> {{ $name }}</p>
<p><strong>Email:</strong> {{ $email }}</p>
@if($subject)
<p><strong>Subject:</strong> {{ $subject }}</p>
@endif
<p><strong>Message:</strong></p>
<p>{{ $message }}</p>