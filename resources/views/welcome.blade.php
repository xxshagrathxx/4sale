<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Uploads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Toastr --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
            color: #555;
        }
        .btn-primary {
            width: 100%;
        }
        .custom-file-input:lang(en)~.custom-file-label::after {
            content: "Browse";
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Upload Your Files</h2>
        <form action="{{ route('provider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="provider_x" class="form-label">Provider X</label>
                <input class="form-control" type="file" name="provider_x" id="provider_x">
                @error('provider_x')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="provider_y" class="form-label">Provider Y</label>
                <input class="form-control" type="file" name="provider_y" id="provider_y">
                @error('provider_y')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Upload Files</button>
        </form>

        <hr>

        {{-- <form action="{{ route('provider.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Clear Data</button>
        </form> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}";
            switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }
        @endif
    </script>
</body>
</html>
