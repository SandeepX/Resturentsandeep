@extends('layouts.admin')

@section('title',' Reporting ')
    
    @section('main-content') 
        <div class="content-wrapper">
            
            <div class="page-content fade-in-up">
               
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Total sales</div>
                                    <a href="" class="btn  btn-success add_btn">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Menu</th>
                                            <th>Price</th>
                                            <th>Ordered_date</th>
                                            <th>Ordered_By</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        @if(isset($order))
                                            @foreach($order as $key=>$orderdetail)
                                        <tr>

                                            <td>{{ ++$key }}
                                            <td>{{$orderdetail->item}}</td>
                                            <td>NRP.{{$orderdetail->cost}}</td>
                                            <td>{{$orderdetail->ordered_date}}</td>
                                            <td>{{$orderdetail->ordered_by}}</td>
                                            
                                        </tr>
                                        @endforeach        
                                    @endif
                                    </tbody>
                                </table>
                                <div class="col-sm-2 form-group">
                                    <label for="Total">Total sales IN NRP.</label>
                                    <div class="">
                                        <input id="" class="form-control" type="text" name="" placeholder="" value ="{{ $total = $order->sum('cost') }}">
                                    </div>
                                </div>
                                {{ $order->links() }}
                            </div>
                        </div>
                    </div>
                   
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Menu sales Reporting</div>
                                    <a href="" class="btn  btn-success add_btn">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Menu </th>
                                            <th>Price</th>
                                            
                                        </tr>
                                    </thead>
                                     <tbody>
                                        @if(isset($collection))
                                            @foreach($collection as $key=>$orderdetail)
                                        <tr>

                                            <td>{{ ++$key }}
                                            <td>{{$orderdetail->item}}</td>
                                            <td>NRP.{{$orderdetail->total}}</td>
                                            
                                            
                                        </tr>
                                        @endforeach        
                                    @endif
                                    </tbody>
                                </table>
                                <div class="col-sm-2 form-group">
                                    <label for="Total">Total sales IN NRP.</label>
                                    <div class="">
                                        <input id="" class="form-control" type="text" name="" placeholder="" value ="{{ $total = $collection->sum('total') }}">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                   
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">customer Based Reporting</div>
                                    <a href="" class="btn  btn-success add_btn">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>customer </th>
                                            <th>Amount Invested</th>
                                            
                                        </tr>
                                    </thead>
                                     <tbody>
                                        @if(isset($customer))
                                            @foreach($customer as $key=>$orderdetail)
                                        <tr>

                                            <td>{{ ++$key }}
                                            <td>{{$orderdetail->ordered_by}}</td>
                                            <td>NRP.{{$orderdetail->purchase}}</td>
                                            
                                            
                                        </tr>
                                        @endforeach        
                                    @endif
                                    </tbody>
                                </table>
                                <div class="col-sm-2 form-group">
                                    <label for="Total">Total sales IN NRP.</label>
                                    <div class="">
                                        <input id="" class="form-control" type="text" name="" placeholder="" value ="{{ $total = $customer->sum('purchase') }}">
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                   
                </div>


                
            </div>
            <!-- END PAGE CONTENT-->
@section('scripts')
    <script>
        $('.add_btn').click(function(e){
            e.preventDefault();
           
        });

    </script>
@endsection

    @endsection        