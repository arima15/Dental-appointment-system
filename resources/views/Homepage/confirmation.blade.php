<section class="payment-section">
    <h2>Payment Details</h2>
    <form id="payment-form" action="{{ route('payments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" value="{{ $appointment->service->price }}" readonly>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="cash">Cash</option>
        </select>

        <button type="submit" class="submit-btn">Pay Now</button>
    </form>
</section> 