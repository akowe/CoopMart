<p>Hi, new payment alert from <strong>{{ $data['name'] }}</strong></p>
<p>Payment Details: <br>
<strong>Order Number:</strong> {{ $data['order_number'] }}<br>
<strong>Amount:</strong>{{number_format($data['amount'])}}<br>
<!-- <strong>Product:</strong> {{ $data['product'] }}, <br> -->
</p>
<p>Login <a href="{{ route('superadmin') }}">here</a> to see more.</p>

