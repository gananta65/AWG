<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="admin/includes/prosesCustomer.php?aksi=login" method="POST" enctype="multipart/form-data">
                    <label>Email</label>
                    <input type="text" class="form-control" name="username">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
            <a href="register.php">Register</a>
            </div>
            <div class="modal-footer">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>
            </div>
        </div>
        </div>
</div>