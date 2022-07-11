<footer class="footer py-4  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                    for a better web.
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade" id="info-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@{{ title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @{{ message }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="position-fixed bottom-1 end-1 z-index-2">
    <div class="toast fade p-2 bg-white hide" role="alert" aria-live="assertive" id="whiteToast" aria-atomic="true">
        <div class="toast-header border-0">
            <i class="material-icons text-success me-2">check</i>
            <span class="toast-title me-auto font-weight-bold">Material Dashboard </span>
            <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close" aria-hidden="true"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
            Hello, world! This is a notification message.
        </div>
    </div>
    <div class="toast fade p-2 mt-2 bg-gradient-success hide" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
        <div class="toast-header bg-transparent border-0">
            <i class="material-icons text-white me-2">notifications</i>
            <span class="toast-title me-auto text-white font-weight-bold">Material Dashboard </span>
            <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close" aria-hidden="true"></i>
        </div>
        <hr class="horizontal light m-0">
        <div class="toast-body text-white">
            Hello, world! This is a notification message.
        </div>
    </div>
    <div class="toast fade p-2 mt-2 bg-gradient-info hide" role="alert" aria-live="assertive" id="infoToast" aria-atomic="true">
        <div class="toast-header bg-transparent border-0">
            <i class="material-icons text-white me-2">notifications</i>
            <span class="toast-title me-auto text-white font-weight-bold">Material Dashboard </span>
            <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close" aria-hidden="true"></i>
        </div>
        <hr class="horizontal light m-0">
        <div class="toast-body text-white">
            Hello, world! This is a notification message.
        </div>
    </div>
    <div class="toast fade p-2 mt-2 bg-gradient-warning hide" role="alert" aria-live="assertive" id="warningToast" aria-atomic="true">
        <div class="toast-header bg-transparent border-0">
            <i class="material-icons text-white me-2">notifications</i>
            <span class="toast-title me-auto text-white font-weight-bold">Material Dashboard </span>
            <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close" aria-hidden="true"></i>
        </div>
        <hr class="horizontal light m-0">
        <div class="toast-body text-white">
            Hello, world! This is a notification message.
        </div>
    </div>
    <div class="toast fade p-2 mt-2 bg-gradient-danger hide" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
        <div class="toast-header bg-transparent border-0">
            <i class="material-icons text-white me-2">notifications</i>
            <span class="toast-title me-auto text-white font-weight-bold">Material Dashboard </span>
            <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close" aria-hidden="true"></i>
        </div>
        <hr class="horizontal light m-0">
        <div class="toast-body text-white">
            Hello, world! This is a notification message.
        </div>
    </div>
</div>
