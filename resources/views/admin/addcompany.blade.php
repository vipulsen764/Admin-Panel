@extends('layouts.layout')
@section('title', 'Add Company')


@section('content')

<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }
</style>
@section('heading','Add Company')

    <form action="{{ route('addcompaniesdata') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="inputname4">Name</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Name" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="email">
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="inputPassword4">Website Url</label>
                <input type="text" class="form-control" name="website_url" id="website_url" placeholder="website url">
            </div>
            <div class="form-group col-md-6" id="uimage">
                    <label for="inputLogo">Logo</label>
                    <input type="file" class="form-control image" name="logo" id="logo" placeholder="logo" accept=".jpg, .jpeg, .png">
                    <input type="hidden" class='cropped' id="cimage" name="cimage" value>
            </div>
        </div>
        </div>


        <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
    </form>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="newimage" src="">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    <br>
                </div>
                <p><span style="color:red;">* </span>Cancel this is want to upload image as it is.</p>
            </div>
        </div>
    </div>
@endsection
