<?php 
// Default Table data
$invoiceData = [
    [
        'invoice' => '#526534',
        'name' => 'Kathryn Murphy',
        'date' => '25 Jan 2024',
        'amount' => '$200.00'
    ],
    [
        'invoice' => '#696589',
        'name' => 'Annette Black',
        'date' => '25 Jan 2024',
        'amount' => '$200.00'
    ],
    [
        'invoice' => '#256584',
        'name' => 'Ronald Richards',
        'date' => '10 Feb 2024',
        'amount' => '$200.00'
    ],
    [
        'invoice' => '#526587',
        'name' => 'Eleanor Pena',
        'date' => '10 Feb 2024',
        'amount' => '$150.00'
    ],
    [
        'invoice' => '#105986',
        'name' => 'Leslie Alexander',
        'date' => '15 Mar 2024',
        'amount' => '$150.00'
    ]
];

// Bordered Tables data (different name for third row)
$borderedTableData = [
    [
        'invoice' => '#526534',
        'name' => 'Kathryn Murphy',
        'date' => '25 Jan 2024',
        'amount' => '$200.00'
    ],
    [
        'invoice' => '#696589',
        'name' => 'Annette Black',
        'date' => '25 Jan 2024',
        'amount' => '$200.00'
    ],
    [
        'invoice' => '#256584',
        'name' => '256584',
        'date' => '10 Feb 2024',
        'amount' => '$200.00'
    ],
    [
        'invoice' => '#526587',
        'name' => 'Eleanor Pena',
        'date' => '10 Feb 2024',
        'amount' => '$150.00'
    ],
    [
        'invoice' => '#105986',
        'name' => 'Leslie Alexander',
        'date' => '15 Mar 2024',
        'amount' => '$150.00'
    ]
];

// Striped Rows data (with images)
$productData = [
    [
        'image' => 'product-img1.png',
        'name' => 'Blue t-shirt',
        'category' => 'Fashion',
        'price' => '$500.00',
        'discount' => '15%',
        'sold' => '300',
        'totalOrders' => '70'
    ],
    [
        'image' => 'product-img2.png',
        'name' => 'Nike Air Shoe',
        'category' => 'Fashion',
        'price' => '$150.00',
        'discount' => 'N/A',
        'sold' => '200',
        'totalOrders' => '70'
    ],
    [
        'image' => 'product-img3.png',
        'name' => 'Woman Dresses',
        'category' => 'Fashion',
        'price' => '$300.00',
        'discount' => '$50.00',
        'sold' => '1500',
        'totalOrders' => '70'
    ],
    [
        'image' => 'product-img4.png',
        'name' => 'Smart Watch',
        'category' => 'Fashion',
        'price' => '$400.00',
        'discount' => '$50.00',
        'sold' => '700',
        'totalOrders' => '70'
    ],
    [
        'image' => 'product-img5.png',
        'name' => 'Hoodie Rose',
        'category' => 'Fashion',
        'price' => '$300.00',
        'discount' => '25%',
        'sold' => '500',
        'totalOrders' => '70'
    ]
];

// Vertical Striped Rows data (without images)
$verticalProductData = [
    [
        'name' => 'Blue t-shirt',
        'category' => 'Fashion',
        'price' => '$500.00',
        'discount' => '15%',
        'sold' => '300',
        'totalOrders' => '70'
    ],
    [
        'name' => 'Blue t-shirt',
        'category' => 'Fashion',
        'price' => '$150.00',
        'discount' => 'N/A',
        'sold' => '200',
        'totalOrders' => '70'
    ],
    [
        'name' => 'Blue t-shirt',
        'category' => 'Fashion',
        'price' => '$300.00',
        'discount' => '$50.00',
        'sold' => '1500',
        'totalOrders' => '70'
    ],
    [
        'name' => 'Blue t-shirt',
        'category' => 'Fashion',
        'price' => '$400.00',
        'discount' => '$50.00',
        'sold' => '700',
        'totalOrders' => '70'
    ],
    [
        'name' => 'Blue t-shirt',
        'category' => 'Fashion',
        'price' => '$300.00',
        'discount' => '25%',
        'sold' => '500',
        'totalOrders' => '70'
    ]
];

// Tables Border Colors data
$transactionData = [
    [
        'transactionId' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main',
        'amount' => '$20,000.00'
    ],
    [
        'transactionId' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Rejected',
        'statusClass' => 'bg-danger-focus text-danger-main',
        'amount' => '$20,000.00'
    ],
    [
        'transactionId' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Completed',
        'statusClass' => 'bg-success-focus text-success-main',
        'amount' => '$20,000.00'
    ],
    [
        'transactionId' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Completed',
        'statusClass' => 'bg-success-focus text-success-main',
        'amount' => '$20,000.00'
    ],
    [
        'transactionId' => '5986124445445',
        'date' => '27 Mar 2024',
        'status' => 'Completed',
        'statusClass' => 'bg-success-focus text-success-main',
        'amount' => '$20,000.00'
    ]
];

// Colored Row Table data
$coloredRowData = [
    [
        'date' => '27 Mar 2024',
        'userImage' => 'user1.png',
        'userName' => 'Dianne Russell',
        'email' => 'random@gmail.com',
        'plan' => 'Free',
        'bgClass' => 'bg-primary-light'
    ],
    [
        'date' => '27 Mar 2024',
        'userImage' => 'user2.png',
        'userName' => 'Wade Warren',
        'email' => 'random@gmail.com',
        'plan' => 'Basic',
        'bgClass' => 'bg-success-focus'
    ],
    [
        'date' => '27 Mar 2024',
        'userImage' => 'user3.png',
        'userName' => 'Albert Flores',
        'email' => 'random@gmail.com',
        'plan' => 'Standard ',
        'bgClass' => 'bg-info-focus'
    ],
    [
        'date' => '27 Mar 2024',
        'userImage' => 'user4.png',
        'userName' => 'Bessie Cooper',
        'email' => 'random@gmail.com',
        'plan' => 'Business ',
        'bgClass' => 'bg-warning-focus'
    ],
    [
        'date' => '27 Mar 2024',
        'userImage' => 'user5.png',
        'userName' => 'Arlene McCoy',
        'email' => 'random@gmail.com',
        'plan' => 'Enterprise ',
        'bgClass' => 'bg-danger-focus'
    ]
];

// Bordered Table data (last table)
$orderData = [
    [
        'userImage' => 'user1.png',
        'userName' => 'Dianne Russell',
        'invoice' => '#6352148',
        'item' => 'iPhone 14 max',
        'qty' => '2',
        'amount' => '$5,000.00',
        'status' => 'Paid',
        'statusClass' => 'bg-success-focus text-success-main'
    ],
    [
        'userImage' => 'user2.png',
        'userName' => 'Wade Warren',
        'invoice' => '#6352148',
        'item' => 'Laptop HPH ',
        'qty' => '3',
        'amount' => '$1,000.00',
        'status' => 'Pending',
        'statusClass' => 'bg-warning-focus text-warning-main'
    ],
    [
        'userImage' => 'user3.png',
        'userName' => 'Albert Flores',
        'invoice' => '#6352148',
        'item' => 'Smart Watch ',
        'qty' => '7',
        'amount' => '$1,000.00',
        'status' => 'Shipped',
        'statusClass' => 'bg-info-focus text-info-main'
    ],
    [
        'userImage' => 'user4.png',
        'userName' => 'Bessie Cooper',
        'invoice' => '#6352148',
        'item' => 'Nike Air Shoe',
        'qty' => '1',
        'amount' => '$3,000.00',
        'status' => 'Canceled',
        'statusClass' => 'bg-danger-focus text-danger-main'
    ],
    [
        'userImage' => 'user5.png',
        'userName' => 'Arlene McCoy',
        'invoice' => '#6352148',
        'item' => 'New Headphone ',
        'qty' => '5',
        'amount' => '$4,000.00',
        'status' => 'Canceled',
        'statusClass' => 'bg-danger-focus text-danger-main'
    ]
];

$script = '';?>

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

            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Default Table</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table basic-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>S.L</th>
                                            <th>Invoice</th>
                                            <th>Name</th>
                                            <th>Issued Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($invoiceData as $index => $invoice): ?>
                                        <tr>
                                            <td><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600"><?php echo $invoice['invoice']; ?></a>
                                            </td>
                                            <td><?php echo $invoice['name']; ?></td>
                                            <td><?php echo $invoice['date']; ?></td>
                                            <td><?php echo $invoice['amount']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Bordered Tables</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table basic-border-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Invoice </th>
                                            <th>Name</th>
                                            <th>Issued Date</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($borderedTableData as $invoice): ?>
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600"><?php echo $invoice['invoice']; ?></a>
                                            </td>
                                            <td><?php echo $invoice['name']; ?></td>
                                            <td><?php echo $invoice['date']; ?></td>
                                            <td><?php echo $invoice['amount']; ?></td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-primary-600">View More ></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Striped Rows</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table striped-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Items</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount </th>
                                            <th scope="col">Sold</th>
                                            <th scope="col" class="text-center">Total Orders</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($productData as $product): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/product/<?php echo $product['image']; ?>" alt="" class="flex-shrink-0 me-12 radius-8 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-normal"><?php echo $product['name']; ?></h6>
                                                        <span class="text-sm text-secondary-light fw-normal"><?php echo $product['category']; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $product['price']; ?></td>
                                            <td><?php echo $product['discount']; ?></td>
                                            <td><?php echo $product['sold']; ?></td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm"><?php echo $product['totalOrders']; ?></span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Striped Rows</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table vertical-striped-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Items</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount </th>
                                            <th scope="col">Sold</th>
                                            <th scope="col" class="text-center">Total Orders</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($verticalProductData as $product): ?>
                                        <tr>
                                            <td>
                                                <h6 class="text-md mb-0 fw-normal"><?php echo $product['name']; ?></h6>
                                                <span class="text-sm text-secondary-light fw-normal"><?php echo $product['category']; ?></span>
                                            </td>
                                            <td><?php echo $product['price']; ?></td>
                                            <td><?php echo $product['discount']; ?></td>
                                            <td><?php echo $product['sold']; ?></td>
                                            <td class="text-center">
                                                <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm"><?php echo $product['totalOrders']; ?></span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tables Border Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table border-primary-table mb-0">
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
                                            <th scope="col">Transaction ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transactionData as $index => $transaction): ?>
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox">
                                                    <label class="form-check-label">
                                                        <?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><?php echo $transaction['transactionId']; ?></td>
                                            <td><?php echo $transaction['date']; ?></td>
                                            <td>
                                                <span class="<?php echo $transaction['statusClass']; ?> px-32 py-4 rounded-pill fw-medium text-sm"><?php echo $transaction['status']; ?></span>
                                            </td>
                                            <td><?php echo $transaction['amount']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tables Border Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table colored-row-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-base">Registered On</th>
                                            <th scope="col" class="bg-base">Users</th>
                                            <th scope="col" class="bg-base">Email</th>
                                            <th scope="col" class="bg-base">Plan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($coloredRowData as $row): ?>
                                        <tr>
                                            <td class="<?php echo $row['bgClass']; ?>"><?php echo $row['date']; ?></td>
                                            <td class="<?php echo $row['bgClass']; ?>">
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/<?php echo $row['userImage']; ?>" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <h6 class="text-md mb-0 fw-medium flex-grow-1"><?php echo $row['userName']; ?></h6>
                                                </div>
                                            </td>
                                            <td class="<?php echo $row['bgClass']; ?>"><?php echo $row['email']; ?></td>
                                            <td class="<?php echo $row['bgClass']; ?>"><?php echo $row['plan']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tables Border Colors</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Users</th>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Items</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orderData as $order): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/users/<?php echo $order['userImage']; ?>" alt="" class="flex-shrink-0 me-12 radius-8">
                                                    <span class="text-lg text-secondary-light fw-semibold flex-grow-1"><?php echo $order['userName']; ?></span>
                                                </div>
                                            </td>
                                            <td><?php echo $order['invoice']; ?></td>
                                            <td><?php echo $order['item']; ?></td>
                                            <td><?php echo $order['qty']; ?></td>
                                            <td><?php echo $order['amount']; ?></td>
                                            <td class="text-center"> <span class="<?php echo $order['statusClass']; ?> px-24 py-4 rounded-pill fw-medium text-sm"><?php echo $order['status']; ?></span> </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- card end -->
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>