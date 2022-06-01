@extends('commonmodule::layouts.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/material-design-icon.css')}}">


<div class="btn-create">
    <button class="btn btn-primary mb-2 mr-1" data-toggle="modal" data-target="#create-vehicle"> <i
            class="icon-plus pr-1"></i> Create transfer vehicle</button>
    
</div>
<div class="vehicle-page all-pages">
    <div class="card-header">

        <h5>Transfer vehicle</h5><span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">
                <div class="dataTables_length mb-2" id="basic-1_length"><label>Show <select name="basic-1_length"
                            aria-controls="basic-1" class="">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> entries</label></div>
                <div id="basic-1_filter" class="dataTables_filter mb-2"><label>Search:<input type="search" class=""
                            placeholder="" aria-controls="basic-1"></label></div>
                <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 229px;">Old driver id</th>
                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 137.203px;">
                                Car id
                            </th>

                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 174.406px;">
                                Km-number
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-label="Position: activate to sort column ascending" style="width: 174.406px;">
                                New driver id
                            </th>

                            <th class="sorting_asc" tabindex="0" aria-controls="basic-1" rowspan="1" colspan="1"
                                aria-sort="ascending" aria-label="Name: activate to sort column descending"
                                style="width: 100px">Settings</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" class="odd">
                            <td class="sorting_1">74287247</td>
                            <td class="sorting_1">8784</td>
                            <td class="sorting_1">234</td>
                            <td class="sorting_1">5323524</td>
                            <td>
                                <div class="dropdown-basic">
                                    <div class="dropdown">
                                        <button class="btn dropbtn btn-primary btn-round dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target=".edit-vehicle">
                                                <i class="mdi mdi-square-edit-outline mr-1"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline mr-1"></i>
                                                Show</a></a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target=".user-icon">
                                                <i class="mdi mdi-account-circle-outline mr-1"></i> User</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" data-toggle="modal"
                                                data-target=".popup-delete">
                                                <i class="mdi mdi-delete-outline mr-1"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr role="row" class="odd">
                            <td class="sorting_1">74287247</td>
                            <td class="sorting_1">8784</td>
                            <td class="sorting_1">234</td>
                            <td class="sorting_1">5323524</td>
                            <td>
                                <div class="dropdown-basic">
                                    <div class="dropdown">
                                        <button class="btn dropbtn btn-primary btn-round dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target=".edit-vehicle">
                                                <i class="mdi mdi-square-edit-outline mr-1"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline mr-1"></i>
                                                Show</a></a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target=".user-icon">
                                                <i class="mdi mdi-account-circle-outline mr-1"></i> User</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" data-toggle="modal"
                                                data-target=".popup-delete">
                                                <i class="mdi mdi-delete-outline mr-1"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr role="row" class="odd">
                            <td class="sorting_1">74287247</td>
                            <td class="sorting_1">8784</td>
                            <td class="sorting_1">234</td>
                            <td class="sorting_1">5323524</td>
                            <td>
                                <div class="dropdown-basic">
                                    <div class="dropdown">
                                        <button class="btn dropbtn btn-primary btn-round dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target=".edit-vehicle">
                                                <i class="mdi mdi-square-edit-outline mr-1"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline mr-1"></i>
                                                Show</a></a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target=".user-icon">
                                                <i class="mdi mdi-account-circle-outline mr-1"></i> User</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" data-toggle="modal"
                                                data-target=".popup-delete">
                                                <i class="mdi mdi-delete-outline mr-1"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                       


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

</div>

<!-- Modal delete item -->
<div class="modal fade popup-delete" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to confirm delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">yes, i'sure</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal user icon -->
<div class="modal fade popup-delete user-icon" id="user-icon" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="">
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input class="form-control" id="username" name="username" type="text"
                            placeholder="Enter username" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" name="password" type="password"
                            placeholder="Enter password" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="mb-3">
                        <label for="role">Role</label>
                        <select class="custom-select" id="role" name="role" required="">
                            <option selected="" value="">Choose...</option>
                            <option>admin</option>
                            <option>superviser</option>

                        </select>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>



<!-- Modal create vehicle -->
<div class="modal fade bd-example-modal-lg create-vehicle" id="create-vehicle" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="old_driver">Old driver</label>
                            <select class="form-control custom-select" id="old_driver">
                                <option>Choose..</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="car_id">Choose car id</label>
                            <select class="form-control custom-select" id="car_id">
                                <option>Choose..</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="km_number">Km number</label>
                            <input class="form-control" id="km_number" type="number" name="km_number"
                                placeholder="Enter km number" required="">
                            <div class="invalid-feedback">Please.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Km picture</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="km_picture" name="km_picture"
                                    data-original-title="" title="">
                                <label class="custom-file-label" for="km_picture">Choose image</label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                        
                            <label for="validationCustom03">Car picture</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="car_picture" name="car_picture"
                                    data-original-title="" title="">
                                <label class="custom-file-label" for="car_picture">Choose image</label>
                            </div>
                        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="km_number">Old driver dec</label>
                            <input class="form-control" id="old_driver_dec" type="number" name="old_driver_dec"
                                placeholder="Enter old driver" required="">
                            <div class="invalid-feedback">Please.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="km_number">New driver id</label>
                            <input class="form-control" id="new_driver_id" type="number" name="new_driver_id"
                                placeholder="Enter new driver" required="">
                            <div class="invalid-feedback">Please.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-floating">
                                <label for="floatingTextarea2">Notes</label>
                                <textarea class="form-control" placeholder="Enter notes" id="floatingTextarea2"
                                    style="height: 80px"></textarea>

                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit vehicle -->
<div class="modal fade bd-example-modal-lg edit-vehicle" id="edit-vehicle" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sel1">Choose car</label>
                            <select class="form-control custom-select" id="sel1">
                                <option>Choose..</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Car picture</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="car_picture" name="car_picture"
                                    data-original-title="" title="">
                                <label class="custom-file-label" for="car_picture">Choose image</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="km_number">Km number</label>
                            <input class="form-control" id="km_number" type="number" name="km_number"
                                placeholder="Enter km number" required="">
                            <div class="invalid-feedback">Please.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Km picture</label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="km_picture" name="km_picture"
                                    data-original-title="" title="">
                                <label class="custom-file-label" for="km_picture">Choose image</label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="sel2">Choose driver</label>
                            <select class="form-control custom-select" id="sel2">
                                <option>Choose..</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-floating">
                                <label for="floatingTextarea2">Notes</label>
                                <textarea class="form-control" placeholder="Enter notes" id="floatingTextarea2"
                                    style="height: 80px"></textarea>

                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




@endsection