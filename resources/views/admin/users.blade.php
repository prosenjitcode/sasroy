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
                    All users
                   
                </div>
                <div class="card-body">
                    <!-- <table id="datatablesSimple"> -->
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="user-table">
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <nav aria-label="..." >
                        <ul class="pagination pagination-sm" id="page-ul">

                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </main>



    
    @include('admin.footer')