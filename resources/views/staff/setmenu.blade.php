@extends('layouts.staff')

@section('title',' Resturent Menu ')
    
    @section('main-content') 
        <div class="content-wrapper">
            
            <div class="page-content fade-in-up">
               
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Set Menu of the Day</div>
                            </div>        
                               
                            <div class="ibox-body">
                               
                            <div class="container">
                                
                                {{ Form::open(['url'=>route('setmenu.store'),'files'=>true , 'id'=>'setmenu_form']) }}
                                
                                    @csrf
                                    <div class="form-group col-sm-4">
                                        <label for="">Date for the Menu:</label>
                                        <div class="">
                                            <input class="form-control" id="datepicker" required name="created_date" type="date" >
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label for="">Select Menu:</label>
                                        @if(isset($menuData))
                                            @foreach($menuData as $key=>$menudetail)
                                            <div>
                                                <input class="checkbox" id="menu" name="menu[]"   type="checkbox" value="{{ $menudetail->id }}">{{$menudetail->name}}
                                                


                                            </div>    
                                            @endforeach    
                                        @endif
                                    </div>
                                    
                                    <div class="modal-footer">
                                          <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-paper-plane" ></i>Submit</button>
                                    </div>
                                {{ Form::close()}}    
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