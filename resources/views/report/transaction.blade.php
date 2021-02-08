@extends('layouts.app')

@section('content')

<section class="content">
	<div class="card card-secondary card-outline">
		<div class="card-header">
            <h3 class="card-title"><a href="{{ route('pdf', ['start' => $data['start_date'],"end" => $data['end_date'],"type" => $data['type']])}}" class="btn btn-primary">PDF </a> </h3>
			Laporan Periode {{ $data['start_date'] }} sampai {{ $data['end_date'] }}
        </div>
		<div class="card-body">
			<table class="table table-sm" id="myTable">
				<thead>
					<tr>
                        <th>No</th>
						<th>Suhu</th>
						<th>Kelembapan</th>
						<th>Gas</th>
						<th>Api</th>
						<th>Status</th>
						<th>Waktu</th>
					</tr>
				</thead>
				<tbody>
					{{-- @foreach($bookings as $row) --}}
					<tr>
                        <td>1</td>
						<td>21°C</td>
						<td>14% RH</td>
						<td>15%</td>
						<td>aman</td>
						<td>normal</td>
						<td>1-10-2020 12.30.00</td>

                    <tr>
                        <td>2</td>
						<td>21°C</td>
						<td>14% RH</td>
						<td>15%</td>
						<td>aman</td>
						<td>normal</td>
						<td>1-10-2020 13.00.00</td>

                    </tr>
                    <tr>
                        <td>3</td>
						<td>21°C</td>
						<td>14% RH</td>
						<td>15%</td>
						<td>aman</td>
						<td>normal</td>
						<td>1-10-2020 13.30.00</td>
                    </tr>
                    <tr>
                        <td>4</td>
						<td>31°C</td>
						<td>14% RH</td>
						<td>15%</td>
						<td>aman</td>
						<td>normal</td>
						<td>1-10-2020 14.00.00</td>
                    </tr>
                    <tr>
                        <td>5</td>
						<td>21°C</td>
						<td>14% RH</td>
						<td>15%</td>
						<td>aman</td>
						<td>normal</td>
						<td>1-10-2020 14.30.00</td>
                    </tr>
                    <tr>
                        <td>6</td>
						<td>21°C</td>
						<td>14% RH</td>
						<td>15%</td>
						<td>aman</td>
						<td>normal</td>
						<td>1-10-2020 15.00.00</td>
					</tr>
					{{-- @endforeach --}}
				</tbody>
			</table>
		</div>
	</div>
</section>

@endsection
