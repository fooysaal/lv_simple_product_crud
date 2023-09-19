@extends('layouts.app')
@section('title', 'Create Products')
@section('content')
<main class="container">
    <section>
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="titlebar">
                <h1>Add Product</h1>
                <a href="{{ route('products.index') }}">Back</a>
            </div>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $errors)
                            <li>{{ $errors }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
            <div>
                    <label>Name</label>
                    <input type="text" name="name">
                    <label>Description (optional)</label>
                    <textarea cols="10" rows="5" name="description"></textarea>
                    <label>Add Image</label>
                    <img src="" alt="Image Preview" class="img-product" id="file-preview" width="200"/>
                    <input type="file" name="image" accept="image/*" onchange="showFile(event)">
                </div>
                <div>
                    <label>Category</label>
                    <select  name="category">

                        @foreach (json_decode('{"Smartphone":"Smartphone","SmartTV":"Smart TV", "Computer":"Computer", "Gadgets":"Gadgets"}', true) as $optionKey => $optionValue)

                            <option value="{{ $optionKey }}" >{{ $optionValue }}</option>

                        @endforeach

                    </select>
                    <hr>
                    <label>Inventory</label>
                    <input type="text" class="input" name="quantity">
                    <hr>
                    <label>Price</label>
                    <input type="text" class="input" name="price">
            </div>
            </div>
            <div class="titlebar">
                <button name="save" type="submit">Save</button>
            </div>
        </form>
    </section>
</main>


    <script>
        function showFile(event) {
            var input = event.target;
            var reader = new FileReader(); // Added the variable name 'reader'

            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('file-preview'); // Corrected the method name 'getElementByID' to 'getElementById'
                output.src = dataURL;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>

@endsection
