@extends('admin.layouts.master')

@section('title','Places')

@section('content')

@component('admin.components.navbar')
@slot('title',"Places")
@slot('right_comp')
<a href="{{ route('admin.places.create') }}" class="btn btn-primary btn-sm">Add Place</a>
@endslot
@endcomponent

<div class="container-fluid">

    <!-- Page Heading -->

        <div class="card-body">

            @if(session('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Places</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($places as $place)
                        <tr>
                            <td>{{ $place->id }}</td>
                            <td>{{ $place->places }}</td>
                           
                            
                            <td>
                                <a href="{{ route('admin.places.edit', $place) }}" class="btn btn-info">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <form  class="d-inline" action="{{ route('admin.places.destroy', $place) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onClick="return confirm('Are you sure !')" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Empty</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection