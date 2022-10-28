@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add booking</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.bookings.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Place</label>
                        <select name="place_id" class="form-control" >
                        @foreach($places as $place)
                    <option value="{{ $place->id }}">{{ $place->name }}</option>
                       @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Start Date</label>
                        <input type="date" class="form-control" id="start_date" format="" name="start_date" value="{{ old('start_date') }}" />
                    </div>
                    <div class="form-group">
                        <label for="location">End date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" />
                    </div>
                    
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection