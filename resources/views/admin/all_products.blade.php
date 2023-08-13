@include('admin.header')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    All Products
                    <a id="AddProduct" class="btn btn-primary btn-block float-end">create</a>
                </div>
                <div class="card-body">
                    <!-- <table id="datatablesSimple"> -->
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="product-table">
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <nav aria-label="...">
                        <ul class="pagination pagination-sm">


                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </main>



    <!-- Modal update product -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                    <button onclick="modalClose()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="view-form" onsubmit="return false;">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class=" mb-3 mb-md-0">
                                    <label for="name">Book name</label>
                                    <input name="name" class="form-control form-control-sm" id="name" type="text" required />

                                    <input name="id" hidden class="form-control form-control-sm" id="name" type="text" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="author">Author name</label>
                                    <input name="author" class="form-control form-control-sm" id="author" type="text" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="language">Language</label>
                                    <input name="language" class="form-control form-control-sm" id="language" type="text" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="catId">Category</label>
                                    <select name="cat-id" class="form-control form-control-sm form-select" id="catId" required>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="price">Price</label>
                                    <input name="price" class="form-control form-control-sm" id="price" type="text" required />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="img">Image</label>
                                    <input name="img" class="form-control form-control-sm" id="img" type="file" />

                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="catId">Publishing date</label>
                                    <input name="pdate" class="form-control form-control-sm" id="pdate" type="text" required />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="price">No. of Pages</label>
                                    <input name="pages" class="form-control form-control-sm" id="pages" type="text" required />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="img">Discount</label>
                                    <input name="discount" class="form-control form-control-sm" id="discount" type="text" required />

                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="description">Description</label>
                            <textarea name="description" cols="30" rows="5" class="form-control" required></textarea>

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

     <!-- Modal add product -->
     <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                    <button onclick="AddModalClose()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-form" onsubmit="return false;">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class=" mb-3 mb-md-0">
                                    <label for="name">Book name</label>
                                    <input name="name1" class="form-control form-control-sm" id="name" type="text" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="author">Author name</label>
                                    <input name="author2" class="form-control form-control-sm" id="author" type="text" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="language">Language</label>
                                    <input name="language3" class="form-control form-control-sm" id="language" type="text" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="catId">Category</label>
                                    <select name="cat-id4" class="form-control form-control-sm form-select" id="catId" required>


                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="price">Price</label>
                                    <input name="price5" class="form-control form-control-sm" id="price" type="text" required />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="img">Image</label>
                                    <input name="addimg" class="form-control form-control-sm" id="addimg" type="file"required />

                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="catId">Publishing date</label>
                                    <input name="pdate6" class="form-control form-control-sm" id="pdate" type="text" required />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="price">No. of Pages</label>
                                    <input name="pages7" class="form-control form-control-sm" id="pages" type="text" required />

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 mb-md-0">
                                    <label for="img">Discount</label>
                                    <input name="discount8" class="form-control form-control-sm" id="discount" type="text" required />

                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <label for="description">Description</label>
                            <textarea name="description9" cols="30" rows="5" class="form-control" required></textarea>

                        </div>

                        <div class="mt-4 mb-0">
                            <div class="d-grid"><input name="add-book" class="btn btn-primary btn-block" type="submit" value="Create" /></div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    
    @include('admin.footer')