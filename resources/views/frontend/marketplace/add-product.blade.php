@extends('layouts.layout')

@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner3.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Add Products</h1>
                </div>
            </div>
        </div>
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('marketplace') }}">Marketplace</a></li>
                    <li>Add Marketplace</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->

        <!-- inner page banner -->
        <div class="page-banner contact-page section-sp2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 offset-md-3">
                        <form class="contact-bx ajax-form" method="post" action="{{ route('marketplace.product.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="ajax-message"></div>
                            <div class="heading-bx left">
                                <h2 class="title-head">Add Your <span>Products</span></h2>
                            </div>
                            <div class="row placeani">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group" style="display: grid !important">
                                            <label>Product Name</label>
                                            <input name="name" type="text" class="form-control valid-character">
                                        </div>
                                        @error('name')
                                            <div class="text-red" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group" style="display: grid !important">
                                            <label>Product Category</label>
                                            <select name="category" style="wdith:100%" id="">
                                                <li class="active">
                                                    <option value="">Select a value</option>
                                                    @foreach ($category as $data)
                                                        <option value="{{ $data->marketplace_category_uuid }}">
                                                            {{ $data->marketplace_category_name }}</option>
                                                    @endforeach
                                                </li>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        @error('category')
                                            <div class="text-red" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Product Description</label>
                                            <textarea name="description" rows="4" class="form-control"></textarea>
                                        </div>
                                        @error('description')
                                            <div class="text-red" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group" style="display: grid !important">
                                            <label>Product Price</label>
                                            <input name="price" type="text" class="form-control valid-character">
                                        </div>
                                        @error('price')
                                            <div class="text-red" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="file" name="photo"
                                                class="w-full rounded-md border border-stroke p-3 outline-none transition file:mr-4 file:rounded file:border-[0.5px] file:border-stroke file:bg-[#EEEEEE] file:py-1 file:px-2.5 file:text-sm file:font-medium focus:border-primary file:focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-strokedark dark:file:bg-white/30 dark:file:text-white"
                                                style="width:100%">
                                        </div>
                                        @error('message')
                                            <div class="text-red" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button name="submit" type="submit" value="Submit" class="btn button-md"> Add
                                        Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
    </div>
@endsection
