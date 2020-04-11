@extends('layouts.customer')

@section('title',' Order page ')
    
    @section('main-content') 
        <div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Menu of the Day</div>
                            </div>        
                               
                            <div class="ibox-body">
                               
                            <div class="container">
                             @if(isset($menu))    
                                {{ Form::open() }}

                                    
                                    <div class="form-group col-sm-2">
                                        <label for="">Select Menu:</label>
                                        
                                            @foreach($menu as $key=>$menudetail)
                                            <div>
                                                <input class="checkbox" id="menu" name="menu[]" type="checkbox" value="{{ $menudetail->menu }}">{{$menudetail->menu}}
                                            </div>
                                              <div>
                                                     <input class="form-control"  type="hidden" id="date" name="Ordered_date" value="{{$menudetail->created_date}}" >
                                              </div>
                                            @endforeach    
                                        
                                    </div>
                                    
                                        <div class="modal-footer">
                                          <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" ></i>Order Now</button>
                                      </div>
                                {{ Form::close() }}
                            @endif



                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        @section('scripts')
            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
            <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script> 
        @endsection  
              
        <script>
            $(function() {
                $("#datepicker" ).datepicker();
            });
        </script>

    @endsection        