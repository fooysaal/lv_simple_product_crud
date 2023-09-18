@extends('layouts.app')
@section('title', 'Edit Products')
@section('content')
    <main class="container">
        <section>
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="titlebar">
                    <h1>Edit Product</h1>
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
                        <input type="text" name="name" value="{{ $product->name }}">
                        <label>Description (optional)</label>
                        <textarea cols="10" rows="5" name="description" value="{{ $product->description }}"></textarea>
                        <label>Add Image</label>
                        <img src="{{ asset('images/' . $product->image) }}" alt="" class="img-product" id="file-preview"/>
                        <input type="hidden" name="hidden_product_image" value="{{ $product->image }}">
                        <input type="file" name="image" accept="image/*" onchange="showFile(event)">
                    </div>
                    <div>
                        <label>Category</label>
                        <select  name="category">

                            @foreach (json_decode('{"Smartphone":"Smartphone","SmartTV":"Smart TV", "Computer":"Computer"}', true) as $optionKey => $optionValue)
                                <option value="{{ $optionKey }}" {{ (null !== $product->category && $product->category == $optionKey) ? 'selected' : '' }}>
                                    {{ $optionValue }}
                                </option>
                            @endforeach


                        </select>
                        <hr>
                        <label>Inventory</label>
                        <input type="text" class="input" name="quantity" value="{{ $product->quantity }}">
                        <hr>
                        <label>Price</label>
                        <input type="text" class="input" name="price" value=" {{ $product->price }}">
                </div>
                </div>
                <div class="titlebar">
                    <span></span>
                    <input type="hidden" name="hidden_id" value="{{ $product->id }}">
                    <button name="save" type="submit">Save</button>
                </div>
            </form>
        </section>
    </main>
    <script>
        function showFile(event){
            var input = event.target;
            var = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;
                var output = document.getElementByID('file-preview');
                output.src = dataURL;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
