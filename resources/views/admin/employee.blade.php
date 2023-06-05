@extends('layouts.layout')
@section('title', 'Emplyoees')


@section('content')
@section('heading','Employees')
    <div class="col-12">
        <a href="{{ route('addemployee') }}" class="btn btn-primary mb-3" style="float:right;">Add Employee</a>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sr.No.</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Company</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $key => $item)
                <tr>
                    <th scope="row">{{ $key+$employees->firstitem() }}</th>
                    <td>{{ $item->First_name }}</td>
                    <td>{{ $item->last_name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>@php
                        if (isset($item->companyname->Name)) {
                            echo $item->companyname->Name;
                        } else {
                            echo 'Not Available';
                        }
                        
                    @endphp</td>
                     <td><a href="{{ route('editemployee',$item->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('deleteemployee',$item->id) }}" class="btn btn-danger delete"
                                        data-id="{{ $item->id }}">Delete</a>
                    </td>


                </tr>

            @empty
                <tr>No Results Found</tr>
            @endforelse
        </tbody>
      
    </table>
    <div class="mb-4 d-flex justify-content-center" >

        {{ $employees->links() }}
    </div>


@stop
