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
                    Orders
                </div>
                <div class="card-body">
                    <!-- <table id="datatablesSimple"> -->
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-sm table-hover">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Buyer Name</th>
                                    <th>Item Name</th>
                                    <th>Oder Date</th>
                                    <th>Payment</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="orders-table">
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </main>

    <!-- Modal add product -->
    <div class="modal fade " id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Details</h5>
                    <button onclick="orderModalClose()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid" id="order-details">
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

 
    <!-- Modal -->



    @include('admin.footer')