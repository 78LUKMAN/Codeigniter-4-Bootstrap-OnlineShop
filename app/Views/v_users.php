<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php if (session()->getFlashData('success')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUser">
    &nbsp;<i class="bi bi-plus-square"></i>&nbsp;Tambah User&nbsp;
</button>


<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Number</th>
            <th scope="col">Address</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $index => $user): ?>
            <tr>
                <th scope="row">
                    <?= $index + 1 ?>
                </th>
                <td>
                    <?= $user['username'] ?>
                </td>
                <td>
                    <?= $user['email'] ?>
                </td>
                <td>
                    <?= $user['phone'] ?>
                </td>
                <td style="max-width:150px">
                    <?= $user['address'] ?>
                </td>
                <td>
                    <div class="d-flex">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal-<?= $user['id'] ?>">
                            &nbsp;<i class="bi bi-pencil-square"></i>&nbsp;Ubah Password&nbsp;
                        </button>
                        &nbsp;
    
                        <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this user?')"><i class="bi bi-trash">&nbsp;</i>Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>

            <div class="modal fade" id="editModal-<?= $user['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= site_url('users/edit/' . $user['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="password"
                                        placeholder="New Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password" placeholder="Confirm Password" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            
            <?php endforeach; ?>
            <div class="modal fade" id="newUser">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah User Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= site_url('users/tambah')?>" method="post">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Username</label>
                                    <input type="text" class="form-control" id="new_username" name="username"
                                        placeholder="New Username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="password"
                                        placeholder="New Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password" placeholder="Confirm Password" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </tbody>
</table>


<?= $this->endSection() ?>