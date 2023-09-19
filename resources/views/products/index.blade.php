@extends('layouts.app')
@section('title', 'Products')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>Products</h1>
            <a href="{{ route('products.create') }}">Add Products</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif
        <div class="table">
            <form method="GET" action="{{ route('products.index') }}" accept-charset="UTF-8" role="search">
                <div class="table-search">
                    <div>
                        <button class="search-select">
                        Search Product
                        </button>
                    </div>
                    <div class="relative">
                        <input class="search-input" type="text" name="search" placeholder="Search product..." value="{{ request('search') }}">
                    </div>
                </div>
            </form>
            <div class="table-product-head">
                <p>Image</p>
                <p>Name</p>
                {{-- <p>Price</p> --}}
                <p>Category</p>
                <p>Inventory</p>
                <p>Actions</p>
            </div>
            <div class="table-product-body">
                @if (count($products)>0)
                    @foreach ($products as $product)
                        <img src="{{ asset('images/' . $product->image) }}"/>
                        <p> {{ $product->name }} </p>
                        {{-- <p>{{ $product->price }}</p> --}}
                        <p>{{ $product->category }}</p>
                        <p>{{ $product->quantity }}</p>
                        <div style="display: flex">
                            <a href="{{ route('products.edit', $product -> id) }}" class="btn btn-success" style="margin: 4px 4px">
                                <i class="fas fa-pencil-alt" ></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('delete')
                                <button class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p>Product Not Found!</p>
                @endif
            </div>
            <div class="table-paginate">
                {{ $products->links('layouts.pagination') }}

            </div>
        </div>
    </section>
</main>
@endsection
