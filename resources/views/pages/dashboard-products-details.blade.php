@extends('layouts.dashboard')

@section('title')
    Dashboard Products Details
@endsection

@section('content')
    <section class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Shirup Marzan</h2>
                <p class="dashboard-subtitle">Product Details</p>
            </div>
            <div class="dashboard-content">
                <div class="row mt-3">
                    <div class="col-12 mt-2">
                        <form action="">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="text" class="form-control" value="$100.0" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" v-if="is_store_open">
                                                <label>Category</label>
                                                <select name="category" class="form-control">
                                                    <option value="" disabled>
                                                        Select category
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <div id="editor">
                                                    This is some sample content.
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button class="btn btn-success w-100">
                                                Update Product
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="gallery-container">
                                            <img src="/images/product-card-1.png" alt="" class="w-100" />
                                            <a href="" class="delete-gallery">
                                                <img src="/images/icon-delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="gallery-container">
                                            <img src="/images/product-card-2.png" alt="" class="w-100" />
                                            <a href="" class="delete-gallery">
                                                <img src="/images/icon-delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="file" id="file" multiple style="display: none" />
                                        <button class="btn btn-secondary btn-block mt-3" onclick="thisFileUpload()">
                                            Add Photo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#editor"))
            .then((editor) => {
                console.log(editor);
            })
            .catch((error) => {
                console.error(error);
            });
    </script>

    <script>
        function thisFileUpload() {
            $("#file").click();
        }
    </script>
    
@endpush
