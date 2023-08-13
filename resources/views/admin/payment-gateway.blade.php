@include('admin.header')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row justify-content-center align-items-top g-2">
                
                <div class="col-6">
                <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Payment gateway setup
                </div>
                <div class="card-body">
                <form id="pg-form" onsubmit="return false;">
                        <div class="row mb-3">
                            <div class="col">
                                <div class=" mb-3 mb-md-0">
                                    <label for="name">Razorpay key id</label>
                                    <input name="key-id" class="form-control form-control-sm" id="key-id" type="text" required />
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class=" mb-3 mb-md-0">
                                    <label for="name">Razorpay key secret</label>
                                    <input name="key-secret" class="form-control form-control-sm" id="key-secret" type="text" required />
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
   
    @include('admin.footer')
    
    