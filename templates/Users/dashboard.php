<?php
/**
 * Dashboard template
 *
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Dashboard');
?>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <?= $this->Html->link('More info <i class="fas fa-arrow-circle-right"></i>', ['action' => 'index'], ['class' => 'small-box-footer', 'escape' => false]) ?>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Popularity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">OR9842</a></td>
                                <td>Call of Duty IV</td>
                                <td><span class="badge badge-success">Shipped</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="#">OR1848</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="#">OR7429</a></td>
                                <td>iPhone 13 Pro</td>
                                <td><span class="badge badge-danger">Delivered</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recently Added Products</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                        <div class="product-img">
                            <i class="fas fa-laptop fa-2x text-info"></i>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-title">MacBook Pro
                                <span class="badge badge-warning float-right">$1800</span></a>
                            <span class="product-description">
                                MacBook Pro 2021 with M1 chip
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <i class="fas fa-mobile-alt fa-2x text-success"></i>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-title">Samsung Galaxy S21
                                <span class="badge badge-info float-right">$999</span></a>
                            <span class="product-description">
                                Latest Samsung flagship phone
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book"></i>
                    About This Dashboard
                </h3>
            </div>
            <div class="card-body">
                <p>This is a demo dashboard showcasing AdminLTE integration with CakePHP.</p>
                <p>The data shown here is static for demonstration purposes. In a real application, you would:</p>
                <ul>
                    <li>Create use cases to fetch real data</li>
                    <li>Implement repositories for different entities</li>
                    <li>Add charts and graphs using Chart.js or similar libraries</li>
                    <li>Implement real-time updates with WebSockets</li>
                </ul>
            </div>
        </div>
    </div>
</div>
