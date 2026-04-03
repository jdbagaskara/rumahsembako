<?php 
$tableData = [
    [
        'invoice' => '#526534',
        'userImage' => 'user-list1.png',
        'userName' => 'Kathryn Murphy',
        'date' => '25 Jan 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#696589',
        'userImage' => 'user-list2.png',
        'userName' => 'Annette Black',
        'date' => '25 Jan 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#256584',
        'userImage' => 'user-list3.png',
        'userName' => 'Ronald Richards',
        'date' => '10 Feb 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#526587',
        'userImage' => 'user-list4.png',
        'userName' => 'Eleanor Pena',
        'date' => '10 Feb 2024',
        'amount' => '$150.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#105986',
        'userImage' => 'user-list5.png',
        'userName' => 'Leslie Alexander',
        'date' => '15 March 2024',
        'amount' => '$150.00',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main'
    ],
    [
        'invoice' => '#526589',
        'userImage' => 'user-list6.png',
        'userName' => 'Albert Flores',
        'date' => '15 March 2024',
        'amount' => '$150.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#526520',
        'userImage' => 'user-list7.png',
        'userName' => 'Jacob Jones',
        'date' => '27 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#256584',
        'userImage' => 'user-list8.png',
        'userName' => 'Jerome Bell',
        'date' => '27 April 2024',
        'amount' => '$250.00',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main'
    ],
    [
        'invoice' => '#200257',
        'userImage' => 'user-list9.png',
        'userName' => 'Marvin McKinney',
        'date' => '30 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#526525',
        'userImage' => 'user-list10.png',
        'userName' => 'Cameron Williamson',
        'date' => '30 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    // Duplicate entries for rows 11-20
    [
        'invoice' => '#526534',
        'userImage' => 'user-list1.png',
        'userName' => 'Kathryn Murphy',
        'date' => '25 Jan 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#696589',
        'userImage' => 'user-list2.png',
        'userName' => 'Annette Black',
        'date' => '25 Jan 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#256584',
        'userImage' => 'user-list3.png',
        'userName' => 'Ronald Richards',
        'date' => '10 Feb 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#526587',
        'userImage' => 'user-list4.png',
        'userName' => 'Eleanor Pena',
        'date' => '10 Feb 2024',
        'amount' => '$150.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#105986',
        'userImage' => 'user-list5.png',
        'userName' => 'Leslie Alexander',
        'date' => '15 March 2024',
        'amount' => '$150.00',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main'
    ],
    [
        'invoice' => '#526589',
        'userImage' => 'user-list6.png',
        'userName' => 'Albert Flores',
        'date' => '15 March 2024',
        'amount' => '$150.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#526520',
        'userImage' => 'user-list7.png',
        'userName' => 'Jacob Jones',
        'date' => '27 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#256584',
        'userImage' => 'user-list8.png',
        'userName' => 'Jerome Bell',
        'date' => '27 April 2024',
        'amount' => '$250.00',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main'
    ],
    [
        'invoice' => '#200257',
        'userImage' => 'user-list9.png',
        'userName' => 'Marvin McKinney',
        'date' => '30 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoice' => '#526525',
        'userImage' => 'user-list10.png',
        'userName' => 'Cameron Williamson',
        'date' => '30 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ]
];

$script = '    <script>
       let table = new DataTable("#dataTable");
    </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Basic Table</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Basic Table</li>
                </ul>
            </div>

            <div class="card basic-data-table">
                <div class="card-header">
                    <h5 class="card-title mb-0">Default Datatables</h5>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">
                                            S.L
                                        </label>
                                    </div>
                                </th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Name</th>
                                <th scope="col">Issued Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tableData as $index => $row): ?>
                            <tr>
                                <td>
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">
                                            <?php echo str_pad(($index % 10) + 1, 2, '0', STR_PAD_LEFT); ?>
                                        </label>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0)" class="text-primary-600"><?php echo $row['invoice']; ?></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="assets/images/user-list/<?php echo $row['userImage']; ?>" alt="" class="flex-shrink-0 me-12 radius-8">
                                        <h6 class="text-md mb-0 fw-medium flex-grow-1"><?php echo $row['userName']; ?></h6>
                                    </div>
                                </td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td> <span class="<?php echo $row['statusClass']; ?> px-24 py-4 rounded-pill fw-medium text-sm"><?php echo $row['status']; ?></span> </td>
                                <td>
                                    <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                    </a>
                                    <a href="javascript:void(0)" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <a href="javascript:void(0)" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>