@extends('dashboard.templates.main')

@section('content')
    <!-- Total earning & Recent Sales  -->
    <div class="row">
        <div id="recent-sales" class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Sales</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="invoice-summary.html" target="_blank">View all</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content mt-1">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Product</th>
                                    <th class="border-top-0">Customers</th>
                                    <th class="border-top-0">Categories</th>
                                    <th class="border-top-0">Popularity</th>
                                    <th class="border-top-0">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-truncate">iPhone X</td>
                                    <td class="text-truncate p-1">
                                        <ul class="list-unstyled users-list m-0">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-4.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-5.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-6.png" alt="Avatar">
                                            </li>
                                            <li class="avatar avatar-sm">
                                                <span class="badge badge-info">+8 more</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger round">Mobile</button>
                                    </td>
                                    <td>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-truncate">$ 1200.00</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate">iPad</td>
                                    <td class="text-truncate p-1">
                                        <ul class="list-unstyled users-list m-0">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-7.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-8.png" alt="Avatar">
                                            </li>
                                            <li class="avatar avatar-sm">
                                                <span class="badge badge-info">+5 more</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-success round">Tablet</button>
                                    </td>
                                    <td>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-truncate">$ 1190.00</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate">OnePlus</td>
                                    <td class="text-truncate p-1">
                                        <ul class="list-unstyled users-list m-0">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-1.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-2.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-3.png" alt="Avatar">
                                            </li>
                                            <li class="avatar avatar-sm">
                                                <span class="badge badge-info">+3 more</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger round">Mobile</button>
                                    </td>
                                    <td>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-truncate">$ 999.00</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate">ZenPad</td>
                                    <td class="text-truncate p-1">
                                        <ul class="list-unstyled users-list m-0">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-11.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-12.png" alt="Avatar">
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-success round">Tablet</button>
                                    </td>
                                    <td>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-truncate">$ 1150.00</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate">Pixel 2</td>
                                    <td class="text-truncate p-1">
                                        <ul class="list-unstyled users-list m-0">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-6.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="/dashboard/app-assets/images/portrait/small/avatar-s-4.png" alt="Avatar">
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger round">Mobile</button>
                                    </td>
                                    <td>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td class="text-truncate">$ 1180.00</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Total earning & Recent Sales  -->
@endsection
