@extends('admin.layout.app')

@section('body')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Blank Page</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Morvin</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                    <li class="breadcrumb-item active">Blank Page</li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="container-fluid">

                <div class="page-content-wrapper">




                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Add Category</h4>
                                    <p class="card-title-desc">You can easily add category with slug from here.
                                    </p>

                                    <form action="{{ route('category.store') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="name" class="col-sm-1 col-form-label"><strong>Name:
                                                </strong></label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" placeholder="Enter Category Name" name="name"
                                                    id="name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="slug" class="col-sm-1 col-form-label"><strong>Slug:
                                                </strong></label>
                                            <div class="col-sm-4">
                                                <input class="form-control" placeholder="Enter slug" name="slug" id="slug">
                                            </div>
                                        </div>
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    @endsection

    @section('script')
        <script>
            $('#name').on('input', function() {
                var slug = $(this).val().toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $('#slug').val(slug)
            })

        </script>
    @endsection