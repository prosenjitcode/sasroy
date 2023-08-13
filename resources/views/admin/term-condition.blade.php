@include('admin.header')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row justify-content-center align-items-top g-2">
                
                <div class="col">
                <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                   Term and  condition
                </div>
                <div class="card-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <form onsubmit="return false;" id="term_form" data-parsley-validate class="form-horizontal form-label-left">
                                    <input type="hidden" id="update_policy" name="update_policy" required value='1'/>
                                    <div class="form-group">
                                       
                                        <div class="col-md-9">
                                            <textarea name='message' id='message' class='form-control' ></textarea>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 mt-4">
                                            <button type="submit" id="submit_privacy_btn" class="btn btn-success">Update Policy</button>
                                        </div>

                                    </div>
                                </form>
                                <div class="row">
                                    <div  class="col-md-offset-3 col-md-4" style ="display:none;" id="privacy_result">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                </div>
            </div>
            
        </div>

    </main>
    <script>
        tinymce.init({
            selector: '#message',
            height: 400,
            menubar: true,
            plugins: [
                'advlist autolink lists link charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime table contextmenu paste code help wordcount'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            setup: function (editor) {
                editor.on("change keyup", function (e) {
                    //tinyMCE.triggerSave(); // updates all instances
                    editor.save(); // updates this instance's textarea
                    $(editor.getElement()).trigger('change'); // for garlic to detect change
                });
            }
        });
    </script>
    @include('admin.footer')
    
    