<?php 
$users = [
    [
        'image' => 'user-list1.png',
        'name' => 'Kathryn Murphy',
        'email' => 'kathrynmurphy@gmail.com',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main',
        'role' => '',
        'permission' => '',
        'location' => 'Mikel Roads, Port Arnoldo, ID',
        'actionButton' => 'Deactivate'
    ],
    [
        'image' => 'user-list3.png',
        'name' => 'Kathryn Murphy',
        'email' => 'kathryn.murphy@example.com',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main',
        'role' => 'Employee',
        'permission' => 'Full Access',
        'location' => 'New York, USA',
        'actionButton' => 'Deactivate'
    ],
    [
        'image' => 'user-list2.png',
        'name' => 'Devon Lane',
        'email' => 'devon.lane@example.com',
        'status' => 'Inactive',
        'statusClass' => 'bg-danger-focus text-danger-main',
        'role' => 'Admin',
        'permission' => 'Hosts',
        'location' => 'Los Angeles, USA',
        'actionButton' => 'Activate'
    ],
    [
        'image' => 'user-list5.png',
        'name' => 'Leslie Alexander',
        'email' => 'leslie.alexander@example.com',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main',
        'role' => 'Employee',
        'permission' => 'View Only',
        'location' => 'New York, USA',
        'actionButton' => 'Deactivate'
    ],
    [
        'image' => 'user-list4.png',
        'name' => 'Cameron Williamson',
        'email' => 'cameron.williamson@example.com',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main',
        'role' => 'Owner',
        'permission' => 'Accounting',
        'location' => 'Chicago, USA',
        'actionButton' => 'Approve'
    ],
    [
        'image' => 'user-list6.png',
        'name' => 'Eleanor Pena',
        'email' => 'eleanor.pena@example.com',
        'status' => 'Active',
        'statusClass' => 'bg-success-focus text-success-main',
        'role' => 'Employee',
        'permission' => 'Hosts',
        'location' => 'Miami, USA',
        'actionButton' => 'Deactivate'
    ],
    [
        'image' => 'user-list7.png',
        'name' => 'Robert Fox',
        'email' => 'robert.fox@example.com',
        'status' => 'Inactive',
        'statusClass' => 'bg-danger-focus text-danger-main',
        'role' => 'Manager',
        'permission' => 'Full Access',
        'location' => 'Dallas, USA',
        'actionButton' => 'Activate'
    ],
    [
        'image' => 'user-list8.png',
        'name' => 'Kristin Watson',
        'email' => 'kristin.watson@example.com',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main',
        'role' => 'Staff',
        'permission' => 'Accounting',
        'location' => 'Seattle, USA',
        'actionButton' => 'Approve'
    ]
];

$roles = ['Manager', 'Admin', 'Employee', 'Owner', 'Staff', 'Host', 'Analyst'];
$permissions = ['Full Access', 'Hosts', 'View Only', 'Accounting', 'Management'];

$script = '<script>
  let table = new DataTable(\'#dataTable\');
</script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">User Roles & Permissions</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">User Roles & Permissions</li>
        </ul>
    </div>
    
    <div class="card basic-data-table">
      <div class="card-body">
        <div class="overflow-x-auto">
          <table class="table bordered-table mb-0 mx-0" id="dataTable" data-page-length='10'>
            <thead>
              <tr>
                <th scope="col">User</th>
                <th scope="col">Status</th>
                <th scope="col">Role</th>
                <th scope="col">Permission Group</th>
                <th scope="col">Location</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="assets/images/user-list/<?php echo $user['image']; ?>" alt="Image" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                    <div class="flex-grow-1">
                      <span class="text-md mb-0 fw-bolder text-primary-light d-block"><?php echo $user['name']; ?></span>
                      <span class="text-sm mb-0 fw-normal text-secondary-light d-block"><?php echo $user['email']; ?></span>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="<?php echo $user['statusClass']; ?> px-20 py-4 rounded fw-medium text-sm"><?php echo $user['status']; ?></span>
                </td>
                <td>
                  <select class="form-control w-auto border border-neutral-900 fw-semibold text-primary-light text-sm">
                    <?php foreach ($roles as $role): ?>
                    <option <?php echo ($user['role'] === $role) ? 'selected' : ''; ?>><?php echo $role; ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td>
                  <select class="form-control w-auto border border-neutral-900 fw-semibold text-primary-light text-sm">
                    <?php foreach ($permissions as $permission): ?>
                    <option <?php echo ($user['permission'] === $permission) ? 'selected' : ''; ?>><?php echo $permission; ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td>
                  <span class="text-sm mb-0 fw-normal text-secondary-light d-block"><?php echo $user['location']; ?></span>
                </td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn rounded border text-neutral-500 border-neutral-500 radius px-4 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1"><?php echo $user['actionButton']; ?></button>
                    <button type="button" class="btn rounded border text-info-500 border-info-500 radius px-4 py-6 bg-hover-info-500 text-hover-white flex-grow-1">Edit</button>
                    <button type="button" class="btn rounded border text-danger-500 border-danger-500 radius px-4 py-6 bg-hover-danger-500 text-hover-white flex-grow-1">Delete</button>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>