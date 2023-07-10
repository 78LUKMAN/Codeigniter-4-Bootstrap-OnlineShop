<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img src="<?php echo base_url() ?>public/NiceAdmin/assets/img/profile-img.jpg" alt="Profile"
            class="rounded-circle">
          <h2>
            <?= session()->get('username') ?>
          </h2>
          <h3>
            <?= session()->get('role') ?>
          </h3>
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8">
      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                Password</button>
            </li>
          </ul>
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">
            <?php if (session()->has('pro-success')): ?>
                  <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pro-success') ?>
                  </div>
                <?php endif; ?>
  
                <?php if (session()->has('pro-error')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('pro-error') ?>
                  </div>
                <?php endif; ?>
  
                <?php if (session()->has('pro-errors')): ?>
                  <div class="alert alert-danger" role="alert">
                    <?php foreach (session()->getFlashdata('pro-errors') as $error): ?>
                      <p>
                        <?= $error ?>
                      </p>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
              <h5 class="card-title">Profile Details</h5>
              <?php foreach ($userData as $key => $value) {
                if ($value['username'] == session()->get('username')) { ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">
                      <?= $value['username'] ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">
                      <?= $value['address'] ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">
                      <?= $value['phone'] ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">
                      <?= $value['email'] ?>
                    </div>
                  </div>
                  <?php
                }
              } ?>
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
              <!-- Profile Edit Form -->
              <form action="<?= base_url('profile/edit') ?>" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="<?php echo base_url() ?>public/NiceAdmin/assets/img/profile-img.jpg" alt="Profile">
                    <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i
                          class="bi bi-upload"></i></a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                          class="bi bi-trash"></i></a>
                    </div>
                  </div>
                </div>
                <?php foreach ($userData as $key => $value) {
                  if ($value['username'] == session()->get('username')) {
                    ?>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control" id="username"
                          value="<?= $value['username'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="address"
                        value="<?= $value['address'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="phone"
                        value="<?= $value['phone'] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="email"
                        value="<?= $value['email'] ?>">
                      </div>
                    </div>
                    <?php
                  }
                }
                ?>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End Profile Edit Form -->
            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">
            </div>

            <div class="tab-pane fade pt-3" id="profile-change-password">
              <?php if (session()->has('pwd-success')): ?>
                <div class="alert alert-success" role="alert">
                  <?= session()->getFlashdata('pwd-success') ?>
                </div>
              <?php endif; ?>

              <?php if (session()->has('error')): ?>
                <div class="alert alert-danger" role="alert">
                  <?= session()->getFlashdata('pwd-error') ?>
                </div>
              <?php endif; ?>

              <?php if (session()->has('pwd-errors')): ?>
                <div class="alert alert-danger" role="alert">
                  <?php foreach (session()->getFlashdata('pwd-errors') as $error): ?>
                    <p>
                      <?= $error ?>
                    </p>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <!-- Change Password Form -->
              <form action="<?= base_url('profile/update') ?>" method="post">
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newPassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewPassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->
            </div>
          </div><!-- End Bordered Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>