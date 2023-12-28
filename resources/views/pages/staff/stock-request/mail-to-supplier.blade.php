<x-errors></x-errors>
<x-fail-message></x-fail-message>
<x-success-message></x-success-message>
<form method="POST" action="{{ route('send.email') }}">
    @csrf

    <h1>I Love Designing 😎</h1>
    <input type="hidden" name="supplierId" value="{{ $supplier->id }}"><br>
    <input type="hidden" name="productId" value="{{ $productId }}"><br>
    <span>To: {{ $supplier->company_name }}</span><br>
    <span>Subject:</span>
    <input size="100" type="text" name="subject" value="{{ $subject }}" readonly><br><br><br>
    <br>
    <br>
    <span>Email Body</span><br>
    <textarea name="emailBody" rows="5" cols="40" placeholder="Type your email content here">{{old('emailBody')}}</textarea><br>
    <button type="submit">Send</button>
</form>
