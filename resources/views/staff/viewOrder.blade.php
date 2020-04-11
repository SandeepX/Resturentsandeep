@extends('layouts.staff')
    @section('title','View Order')
        @section('main-content')
    
    @section('scripts')
    <script>
         $('.edit_order').click( function(e){
             e.preventDefault();
             var order_id = $(this).data('id');
             var status = 'completed';

             // alert(status);



             $.ajax({
                url: "{{ route('order-update')}}",
                type: "post",
                data:{
                    order_id:order_id, newdata:status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                
                     if(response['status']=="success"){
                        alert('Updated');
                        location.reload();
                     }   
                   

                }
             });
             return false;
        });
       
             
           
            
             
        
    </script>
@endsection




        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-12">
                        @include('staff.section2.notify')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Latest Orders</div>
                                <div class="ibox-tools">
                                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    
                                </div>
                            </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Menu</th>
                                            <th>Costs</th>
                                            <th>Status</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                         @if(isset($OrderData)) 
                                            @foreach($OrderData as $key => $Orderdetail) 
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$Orderdetail->ordered_by}}</td>
                                                    <td>{{$Orderdetail->item}}</td>
                                                    <td>
                                                        Total cost Rs.{{$Orderdetail->cost }}
                                                    </td>
                                                    <td>{{$Orderdetail->status}}</td>

                                                     <td>
                                                <a href="" class="btn btn-success pull-left edit_order" style="border-radius:50%;"      data-id="{{$Orderdetail->id}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>


                                                {{ Form::open(['url'=>route('viewOrder.destroy', $Orderdetail->id),'onsubmit'=>'return confirm("Are you sure you want to cancel this order ?")','class'=>'form pull-left' ]) }}

                                                    @method('delete')

                                                  {{Form::button('<i class= "fa fa-trash"></i>',['class'=>'btn btn-danger', 'style'=>'border-radius:50%','type'=>'submit'])  }} 

                                                {{ Form::close() }}
                                    
                                            </td>
                                                </tr>
                                            @endforeach  
                                        @endif    
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <style>
                    .visitors-table tbody tr td:last-child {
                        display: flex;
                        align-items: center;
                    }

                    .visitors-table .progress {
                        flex: 1;
                    }

                    .visitors-table .progress-parcent {
                        text-align: right;
                        margin-left: 10px;
                    }
                </style>
                
            </div>


    








       
        
    @endsection        