@extends('layouts.layout')
@section('title','Edit Emplyoee')
    

@section('content')
@section('heading','Edit Employee')
<form action="{{ route('editemployeedata') }}" method="POST">
@csrf
    <div class="form-row">
      <input type="hidden" name="id" value="{{ $employee->id }}">
        <div class="form-group col-md-6">
          <label for="inputEmail4">First Name</label>
          <input type="text" class="form-control" id="inputFirst_name" value="{{ $employee->First_name }}" name="First_name" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Last Name </label>
          <input type="text" class="form-control" id="inputFirst_name" value="{{ $employee->last_name }}" name="last_name" required>
        </div>
      </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" class="form-control" id="inputEmail4" value="{{ $employee->email }}" name="email">
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Phone</label>
        <input type="text" minlength="10" maxlength="12" class="form-control" value="{{ $employee->phone }}" id="inputEmail4" name="phone">
      </div>
    </div>
    <div class="form-row">
      
        <div class="form-group col-md-6">
          <label for="inputPassword4">Comapny</label>
          <select name="company_id" id="" class="form-control">
            <option >Select one</option>
            @forelse ($companies as $item)
                
            <option value="{{ $item->id }}" <?php if($item->id == $employee->company_id){ echo 'selected';} ?>>{{ $item->Name }}</option>
            @empty
            <option value="">No company</option>
                
            @endforelse
          </select>
        </div>
      </div>
   
      
    <button type="submit"  class="btn btn-primary" style="float: right;">Update</button>
  </form>
@endsection