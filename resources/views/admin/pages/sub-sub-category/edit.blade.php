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
                                <h4>Update Item</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('sub-category.index', 'cat_id=' . $sub_category->category->id) }}">{{ $sub_category->category->name }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('sub-sub-category.index','sub_cat_id='.$sub_category->id) }}">{{ $sub_category->name }}</a></li>
                                    <li class="breadcrumb-item active">Update Item</li>
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
                                    <h4 class="header-title">Add {{ $sub_category->name }}'s Items</h4>
                                    <p class="card-title-desc">You can easily add category with slug from here.
                                    </p>

                                    <form action="{{ route('sub-sub-category.update',$sub_sub_category->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3">
                                            <label for="name" class="col-sm-1 col-form-label"><strong>Name:
                                                </strong></label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" placeholder="Enter Category Name" name="name"
                                                    id="name" value="{{ $sub_sub_category->name }}" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="slug" class="col-sm-1 col-form-label"><strong>Slug:
                                                </strong></label>
                                            <div class="col-sm-4">
                                                <input class="form-control" placeholder="Enter slug"  value="{{ $sub_sub_category->slug }}" name="slug" id="slug">
                                            </div>
                                        </div>
                                        <input type="hidden" name="sub_category_id" value="{{ request('sub_cat_id') }}">
                                        <button class="btn btn-primary" name="submit" value="0" type="submit">Update</button>
                                        <a  class="btn btn-secondary" href="{{ route('sub-sub-category.index','sub_cat_id='.$sub_category->id) }}">Cancel</a>
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
              $('#slug').val(slugify($(this).val()));
          })
      </script>
    @endsection
