@extends('layouts.layout')

@section('title', 'Companies')



@section('content')
@section('heading','Companies')
    <div class="col-12">
        <a href="{{ route('addcompanies') }}" class="btn btn-primary mb-3" style="float:right;">Add Company</a>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sr.No.</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Website Url</th>
                <th scope="col">Logo</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($companies as $key => $item)
                <tr>
                    <th scope="row">{{ $key+$companies->firstitem()  }}</th>
                    <td>{{ $item->Name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->website_url }}</td>
                    <td> <a href="{{ asset('storage/'.$item->logo) }}" target="_blank" rel="noopener noreferrer"> <img src="{{ asset('storage/'.$item->logo) }}" width="100px" alt=""></a></td>
                    <td><a href="{{ route('editcompany',$item->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('deletecompany',$item->id) }}" class="btn btn-danger delete"
                                        data-id="{{ $item->id }}">Delete</a>
                    </td>


                </tr>

            @empty
                <tr>No Results Found</tr>
            @endforelse
        </tbody>
    </table>

    <div class="mb-4 d-flex justify-content-center" >

        {{ $companies->links() }}
    </div>



@stop
