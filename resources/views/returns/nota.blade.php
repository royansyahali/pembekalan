<!DOCTYPE html>

<html>

<head>

	<title>Nota RentCar</title>

	<style type="text/css">

		table{

			width: 100%;

			border:1px solid black;

		}

		td, th{

			border:1px solid black;

		}

	</style>

</head>

<body>


<h2>Nota RentCar</h2>

<table class="table">
    <tr>
        <td> Name</td>

        <td>{{ $client->name }}</td>
        <input type="hidden" name="client_id" value="{{$client->client_id}}" required>
    </tr>
    <tr>
        <td>Car Name </td>

        <td>{{ $car->car_name }}</td>
        <input type="hidden" name="car_id" value="{{ $car->car_id }}" required>
    </tr>
    <tr>
        <td>Booking Code </td>

        <td>{{ $data['booking_code'] }}</td>
        <input type="hidden" name="booking_code" value="{{$data['booking_code']}}" required>
    </tr>
    <tr>
        <td>Order Date</td>
        <td>{{ $data['order_date'] }}</td>
        <input type="hidden" name="order_date" value="{{$data['order_date']}}" required>
    </tr>
    <tr>
        <td>Order Duration</td>
        <td>{{ $data['duration'] }} Days</td>
        <input type="hidden" name="duration" value="{{ $data['duration'] }}" required>
    </tr>
    <tr>
        <td>Return Date Supposed</td>
        <td>{{ $data['return_date_supposed'] }}</td>
        <input type="hidden" name="return_date_supposed" value="{{ $data['return_date_supposed'] }}" required>
    </tr>
    <tr>
        <td>Price a day</td>
        <td>Rp. {{ number_format($car->price) }}</td>
    </tr>
    <tr>
        <td>Total Price</td>
        <td>Rp. {{ number_format($data['price']) }}</td>
        <input type="hidden" name="price" value="{{ $data['price'] }}" required>
    </tr>
    <tr>
        <td>Fine</td>
        @if($fine != null)
        <td style="color:red">Rp. {{ number_format($fine) }} (Late {{$late}} Days)</td>
        @else
        <td>0</td>
        @endif
        <input type="hidden" name="fine" value="{{ $fine }}" required>
    </tr>
    <tr>
        <td>DP</td>
        <td>Rp. {{ number_format($payment->amount) }}</td>
    </tr>
    <tr>
        <th colspan="1">TOTAL</th>
        <input type="hidden" name="total" id="total" value="{{ $total }}" >
        <td>Rp. {{ number_format($total) }}</td>
    </tr>
</table>


</body>

</html>
