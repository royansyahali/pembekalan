<!DOCTYPE html>

<html>

<head>

	<title>Laporan RentCar</title>

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


<h2>Laporan RentCar {{$data["start_date"]}} sampai {{$data["end_date"]}}</h2>

<table>

	<thead>
        <tr>
            <th>No</th>
            <th>Booking Code</th>
            <th>Order Date</th>
            <th>Clients Name</th>
            <th>Car Name</th>
            <th>Order Duration</th>
            <th>Return Date Supposed</th>
            <th>Return Date</th>
            <th>Total Price</th>
            <th>Order Status</th>
            <th>Order Fine</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $row)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row['booking_code'] }}</td>
            <td>{{ $row['order_date'] }}</td>
            <td>{{ $row['name'] }}</td>
            <td>{{ $row['car_name'] }}</td>
            <td>{{ $row['duration'] }}</td>
            <td>{{ $row['return_date_supposed'] }}</td>
            <td>{{ $row['return_date'] }}</td>
            <td>{{ $row['price'] }}</td>
            <td>{{ $row['status'] }}</td>
            <td>{{ $row['fine'] }}</td>


        </tr>
        @endforeach
    </tbody>


</table>


</body>

</html>
