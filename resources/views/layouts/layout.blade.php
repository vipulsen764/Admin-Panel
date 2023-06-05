<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <style>
        html,
        body {
            /* width: 100%; */
            margin: 0;
            padding: 0;
            height: 100%;
        }

        #container {

            min-height: 100%;
            position: relative;
        }

        #header {

            padding: 10px;
        }

        #main {
            padding: 10px;
            padding-bottom: 60px;
            /* Height of the footer */
        }

        #footer {

            bottom: 0;
            width: 100%;
            height: 60px;
            /* Height of the footer */
            /* background;   */
        }
    </style>
</head>

<body>
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src = "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity = "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin = "anonymous" >
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <div class="container">
        <header class="mb-3" id="header">
            @include('layouts.header')
        </header>
        <div id="main" class="" id="main" style="min-height: 100%;">
            <div class="text-center mt-3 mb-3">
                <h2><strong>@yield('heading')</strong></h2>
            </div>
            @include('alert')
            @yield('content')
        </div>
        {{-- <footer class="text-center" id="footer">
            @include('layouts.footer')
        </footer> --}}
    </div>
    <script>
        $(document).ready(function() {

            //to delete row from db

            $(".delete").on("click", function() {
                var el = this;
                var confirmation = confirm("Are you sure you want to delete this?");
                if (confirmation) {
                    console.log('Deleting');
                } else {
                    document.getElementsByClassName('delete').href = '#';
                    return false;
                }
            });


            //crop image

            var $modal = $('#modal');
            var image = document.getElementById('newimage');
            var cropper;

            $("#uimage").on("change", ".image", function(e) {
                // alert('h');
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };

                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];

                    // if (URL) {
                    //     done(URL.createObjectURL(file));
                    // } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                    // }
                }
            });


            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            $("#crop").click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 100,
                    height: 100,
                });

                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $.ajax({
                            headers: {
                                'X-CSRF-Token': '{{ csrf_token() }}'
                            },
                            type: "POST",
                            dataType: "json",
                            url: '{{ route('image_crop1') }}',
                            data: {
                                "image": base64data
                            },
                            success: function(data) {
                                console.log(data.imageName);
                                console.log(data.path);
                                // console.log(data.image_base64);
                                $modal.modal('hide');
                                $('#cimage').val(data.imageName);

                            }
                        });
                    }
                });
            });


        });
    </script>
</body>

</html>
