<?php 
$invoices = [
    [
        'invoiceNumber' => '#526534',
        'userImage' => 'user-list1.png',
        'userName' => 'Kathryn Murphy',
        'issuedDate' => '25 Jan 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoiceNumber' => '#696589',
        'userImage' => 'user-list2.png',
        'userName' => 'Annette Black',
        'issuedDate' => '25 Jan 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoiceNumber' => '#256584',
        'userImage' => 'user-list3.png',
        'userName' => 'Ronald Richards',
        'issuedDate' => '10 Feb 2024',
        'amount' => '$200.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoiceNumber' => '#526587',
        'userImage' => 'user-list4.png',
        'userName' => 'Eleanor Pena',
        'issuedDate' => '10 Feb 2024',
        'amount' => '$150.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoiceNumber' => '#105986',
        'userImage' => 'user-list5.png',
        'userName' => 'Leslie Alexander',
        'issuedDate' => '15 March 2024',
        'amount' => '$150.00',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main'
    ],
    [
        'invoiceNumber' => '#526589',
        'userImage' => 'user-list6.png',
        'userName' => 'Albert Flores',
        'issuedDate' => '15 March 2024',
        'amount' => '$150.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoiceNumber' => '#526520',
        'userImage' => 'user-list7.png',
        'userName' => 'Jacob Jones',
        'issuedDate' => '27 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoiceNumber' => '#256584',
        'userImage' => 'user-list8.png',
        'userName' => 'Jerome Bell',
        'issuedDate' => '27 April 2024',
        'amount' => '$250.00',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main'
    ],
    [
        'invoiceNumber' => '#200257',
        'userImage' => 'user-list9.png',
        'userName' => 'Marvin McKinney',
        'issuedDate' => '30 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'invoiceNumber' => '#526525',
        'userImage' => 'user-list10.png',
        'userName' => 'Cameron Williamson',
        'issuedDate' => '30 April 2024',
        'amount' => '$250.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ]
];

$script = '';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Invoice List</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Invoice List</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <span>Show</span>
                            <select class="form-select form-select-sm w-auto">
                                <option>10</option>
                                <option>15</option>
                                <option>20</option>
                            </select>
                        </div>
                        <div class="icon-field">
                            <input type="text" name="#0" class="form-control form-control-sm w-auto" placeholder="Search">
                            <span class="icon">
                                <iconify-icon icon="ion:search-outline"></iconify-icon>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <select class="form-select form-select-sm w-auto">
                            <option>Satatus</option>
                            <option>Paid</option>
                            <option>Pending</option>
                        </select>
                        <a href="invoice-add.php" class="btn btn-sm btn-primary-600"><i class="ri-add-line"></i> Create Invoice</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                        <label class="form-check-label" for="checkAll">
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
                            <?php foreach ($invoices as $index => $invoice): ?>
                            <tr>
                                <td>
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" value="" id="check<?php echo $index + 1; ?>">
                                        <label class="form-check-label" for="check<?php echo $index + 1; ?>">
                                            <?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                                        </label>
                                    </div>
                                </td>
                                <td><a href="javascript:void(0)" class="text-primary-600"><?php echo $invoice['invoiceNumber']; ?></a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="assets/images/user-list/<?php echo $invoice['userImage']; ?>" alt="" class="flex-shrink-0 me-12 radius-8">
                                        <h6 class="text-md mb-0 fw-medium flex-grow-1"><?php echo $invoice['userName']; ?></h6>
                                    </div>
                                </td>
                                <td><?php echo $invoice['issuedDate']; ?></td>
                                <td><?php echo $invoice['amount']; ?></td>
                                <td> <span class="<?php echo $invoice['statusClass']; ?> px-24 py-4 rounded-pill fw-medium text-sm"><?php echo $invoice['status']; ?></span> </td>
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

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-24">
                        <span>Showing 1 to 10 of 12 entries</span>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            <li class="page-item">
                                <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base" href="javascript:void(0)">
                                    <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-primary-600 text-white fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base" href="javascript:void(0)">
                                    <iconify-icon icon="ep:d-arrow-right" class="text-xl"></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>