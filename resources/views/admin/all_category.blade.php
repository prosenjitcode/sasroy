@include('admin.header')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row justify-content-center align-items-top g-2">
                <div class="col-9">
                <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    All Category
                </div>
                <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>No. of Books</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="tdata">

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
                </div>
                <div class="col-3">
                <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Add Category
                </div>
                <div class="card-body">
                <form id="category-add-form" onsubmit="return false;">
                        <div class="row mb-3">
                            <div class="col">
                                <div class=" mb-3 mb-md-0">
                                    <label for="name">Category name</label>
                                    <input name="add-cat-name" class="form-control form-control-sm" id="add-cat-name" type="text" required />
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                        <div class="col">
                                <div class="mb-3 mb-md-0">
                                    <label for="img">Image</label>
                                    <input name="add-cat-img" class="form-control form-control-sm" id="add-cat-img" type="file" required />
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" value="Create" /></div>
                        </div>
                    </form>
                </div>
            </div>
                </div>
            </div>
            
        </div>

    </main>
    <!-- Modal add product -->
    <div class="modal fade" id="categoryProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Details</h5>
                    <button onclick="categoryModalClose()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="category-view-form" onsubmit="return false;">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class=" mb-3 mb-md-0">
                                    <label for="name">Category name</label>
                                    <input name="cat-name" class="form-control form-control-sm" id="cat-name" type="text" required />
                                    <input hidden class="form-control form-control-sm" id="cat-id" type="text" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label for="img">Image</label>
                                    <input name="cat-img" class="form-control form-control-sm" id="cat-img" type="file" />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"><input class="btn btn-primary btn-block" type="submit" value="Update" /></div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    @include('admin.footer')
    
    