@extends('frontend.layouts.app')

@section('content')
<style>
    .pnr-container {
        max-width: 600px;
        margin: 40px auto;
        background: #f8f9fa;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .pnr-container h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 20px;
        text-align: center;
    }
    .pnr-form input[type="text"] {
        height: 45px;
        font-size: 16px;
    }
    .pnr-result {
        background: #ffffff;
        border-radius: 10px;
        padding: 20px;
        margin-top: 30px;
        display: none;
        border: 1px solid #ddd;
    }
    .pnr-result h4 {
        font-weight: 600;
        margin-bottom: 15px;
        color: #0d6efd;
    }
    .pnr-result table {
        width: 100%;
        font-size: 15px;
    }
    .pnr-result table th,
    .pnr-result table td {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
</style>
<!-- Title -->
<section class="hero">
            <div class="hero-bg">
            <img src="{{asset('frontend/assets/img/tours/bg.jpg')}}" srcset="./frontend/assets/img/tours/bg.jpg 2x"  alt="">

            </div>
            <div class="bg-content container">
                <div class="hero-page-title">
                    <span class="hero-sub-title">Booking Status</span>
                    <h1 class="display-3 hero-title">
                    Booking Status
                    </h1>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking Status</li>
                    </ol>
                </nav>
            </div>
        </section>
        <!-- /Title -->
        <div class="pnr-container">
            <h2>Check Booking Status</h2>
            <form class="pnr-form" id="pnrForm">
                @csrf
                <div class="mb-3">
                    <label for="pnr" class="form-label">Enter Booking Number</label>
                    <input type="text" class="form-control" id="pnr" name="pnr" placeholder="e.g., PT28630HK" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Check Status</button>
            </form>
            <div id="errorMessage" style="display: none; color: red; margin-top: 10px;"></div>

            <div class="pnr-result" id="pnrResult" style="display: none;">
                <h4>Booking Status: <span id="bookingStatusText">Confirmed</span></h4>
                <table>
                    <tr>
                        <th> Name</th>
                        <td id="passengerName"></td>
                    </tr>
                    <tr>
                        <th>Tour Name</th>
                        <td id="trainName"></td>
                    </tr>
                    <tr>
                        <th>Travel Date</th>
                        <td id="travelDate"></td>
                    </tr>
                
                    <tr>
                        <th>Destination</th>
                        <td id="destination"></td>
                    </tr>
                    <tr>
                        <th>Booking Status</th>
                        <td id="bookingStatusTable"></td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td id="status"></td>
                    </tr>
                </table>
            </div>
        </div>

<script>
    document.getElementById('pnrForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let pnr = document.getElementById('pnr').value;
        let token = document.querySelector('input[name="_token"]').value;

        fetch("{{ route('check.booking.status') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ pnr })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('errorMessage').style.display = 'none';
                document.getElementById('pnrResult').style.display = 'block';
                document.getElementById('passengerName').innerText = data.data.name;
                document.getElementById('travelDate').innerText = data.data.travel_date;
                document.getElementById('trainName').innerText = data.data.travel_from + ' to ' + data.data.travel_to;
                document.getElementById('destination').innerText = data.data.travel_to;
                document.getElementById('bookingStatusText').innerText = data.data.booking_status;
                document.getElementById('bookingStatusTable').innerText = data.data.booking_status;

                document.getElementById('status').innerText = data.data.payment_status;
            } else {
                document.getElementById('pnrResult').style.display = 'none';
                document.getElementById('errorMessage').style.display = 'block';
                document.getElementById('errorMessage').innerText = 'Invalid booking ID';
            }

        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong. Please try again.');
        });
    });
</script>

@endsection
