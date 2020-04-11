@extends('layouts.customer')

@section('title',' Order page ')
    
@section('main-content') 
    @section('scripts')
        <script>
            $("#item").change(function () {
                var Item = $(this).val();
                //alert(Item);
                    $.ajax({
                         url: "{{ route('get-price') }}",
                         type:"post",
                         data:{ 
                            Item:Item, 
                             _token: "{{ csrf_token() }}"
                         },
                         success:function(response){
                            //console.log(response);
                            $("#rate").val(response.data.price);
                         }
                    });     

            });
        </script>
    @endsection  


<div class="content-wrapper">
            
<div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-12">
                        @include('customer.section3.notify')
                    </div>
                </div>    
                
    
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Menu of the Day</div>
                </div>        
                               
                <div class="ibox-body">
                    
                   







                    <div class="container">
                        @if(isset($menu)) 
                         
                            {{ Form::open(['url'=>route('Makeorder.store'),'id'=>'makeorder_form', 'files'=>true, 'class'=>'form', 'method'=>'post']) }}

                                <div class="col-sm-2 form-group">
                                    <label for="Date">Date</label>
                                    <div class="">
                                        @foreach($menu as $key => $menudetail)

                                         @endforeach
                                        <input class="form-control"  type="text" id="date" name="Ordered_date" value="{{ @$menudetail->created_date }}"  >
                                    </div>
                                </div>





                               
                                <div class="form-group col-sm-2">
                                    <label for="Item">Select Menu</label>
                                    <div class="">
                                        <select type="text" class="form-control" id="item" name="item" value="" >
                                            <option value="" >-Select Menu-</option>
                                                @foreach($menu as $key => $menudetail)
                                                    <option value="{{@$menudetail->menu}} ">{{ $menudetail->menu}}</option>
                                                @endforeach
                                               
                                        </select>
                                    </div>
                                </div>

                               

                                <div class="col-sm-2 form-group">
                                    <label for="Qty"> Qty</label>
                                    <div class="">
                                        <input id="qty" class="form-control" type="text" name="qty" placeholder="Qty" value     ="">
                                    </div>
                                </div>

                                 <div class="col-sm-2 form-group">
                                    <label for="rate">Rate</label>
                                    <div class="">
                                        <input id="rate" class="form-control" type="text" name="rate" placeholder="rate" value="">
                                    </div>
                                </div>
                                
                               
                                
                                <div class="modal-footer">
                                  <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-paper-plane" ></i>Order Now</button>
                                </div>
                            {{ Form::close() }}
                        @endif 
                    </div>

                </div>
            </div>
        
    </div>
</div>
            
@endsection        