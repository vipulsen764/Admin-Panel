@extends('layouts.layout')
@section('title','Add Emplyoee')
    

@section('content')
@section('heading','Add Employee')

<form action="{{ route('addemployeedata') }}" method="POST">
@csrf
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">First Name</label>
          <input type="text" class="form-control" id="inputFirst_name" name="First_name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Last Name </label>
          <input type="text" class="form-control" id="inputFirst_name" name="last_name" required>
        </div>
      </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" class="form-control" id="inputEmail4" name="email">
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Phone</label>
        <input type="text" minlength="10" maxlength="12" class="form-control" id="inputEmail4" name="phone">
      </div>
    </div>
    <div class="form-row">
      
        
        <div class="form-group col-md-6">
          <label for="inputPassword4">Comapny</label>
          <select name="company_id" id="" class="form-control" required>
            <option >Select one</option>
            @forelse ($companies as $item)
                
            <option value="{{ $item->id }}">{{ $item->Name }}</option>
            @empty
            <option value="">No company</option>
                
            @endforelse
          </select>
        </div>
      </div>
   
      
    <button type="submit"  class="btn btn-primary" style="float: right;">Submit</button>
  </form>
@endsection
