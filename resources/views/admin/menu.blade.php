@extends('layouts.admin')

@section('title',' Resturent Menu ')
    
    @section('main-content') 
        <div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-12">
                        @include('admin.section.notify')
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Menu List</div>
                                    <a href="" class="btn  btn-success add_btn">
                                        <i class="fa fa-plus"></i>Add Menu
                                    </a>
                                </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Menu ID</th>
                                            <th>Menu Name</th>
                                            <th>Price</th><th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>@if(isset($menuData))
                                                @foreach($menuData as $key=>$menudetail)
                                        <tr>
                                            <td>
                                              {{$menudetail->id}}  
                                            </td>
                                            <td>{{$menudetail->name}}</td>
                                            <td>NRP.{{$menudetail->price}}</td>
                                            <td>
                                                <a href="" class="btn btn-success pull-left edit_menu" style="border-radius:50%;"      data-id="{{ $menudetail->id  }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>


                                                {{ Form::open(['url'=>route('menu.destroy', $menudetail->id),'onsubmit'=>'return confirm("Are you sure you want to delete this menu ?")','class'=>'form pull-left' ]) }}

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
                
                
            </div>
            <!-- END PAGE CONTENT--><div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="                                    menuModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="menuModalLabel">Menu Add</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>

                                        {{  Form::open(['url'=>route('menu.store'),'files'=>true , 'id'=>'menu_form']) }}
                                        <div class="modal-body">
                                            
                                            <div class="form-group row">
                                                {{ Form::label('title',"Name:",['class'=>'col-md-3'])}}
                                                <div class="col-md-9">
                                                    {{ Form::text('name','',['class'=>'form-control form-control-sm','id'=>'name','placeholder'=>'Enter menu name','required'=>true]) }}
                                                </div>
                                             </div>
                                            
                                            <div class="form-group row">
                                                {{ Form:: label('price','Price(NRP): ', ['class'=>'col-sm-3'])}}
                                                <div class="col-sm-9">
                                                    {{ Form::number('price','', ['class'=>'form-control form-control-sm' ,'id'=>'price', 'required'=>true, 'placeholder'=>'Enter  Price...',]) }}

                                                    @error('price')
                                                        <span class="alert-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                            
                                        </div>
                                          <div class="modal-footer">
                                            <input type="hidden" name="_method" id="method" value="post">
                                            <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash" ></i>Reset</button>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" ></i>Submit</button>
                                          </div>
                                        {{ Form::close() }}

                                        </div>
                                      </div>
                                    </div>

@section('scripts')
    <script>
        $('.add_btn').click(function(e){
            e.preventDefault();
            $('.modal-title').html('Menu Add');
            $('#name').val('');
            $('#price').val('');
            $('#menu_form').attr('action',"{{ route('menu.store') }}");
            $('#method').attr('method','post');
            $('#menuModal').modal('show');
        });
        $('.edit_menu').click( function(e){
             e.preventDefault();
             var menu_id = $(this).data('id');
             
             $.ajax({
                url: "{{ route('menu-detail')}}",
                type: "post",
                data:{
                    menu_id: menu_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                   if (typeof(response)!='object') {
                    response = $.parseJSON(response);
                   }

                   if(response.status){
                        $('.modal-title').html('Menu Update');
                        $('#name').val(response.data.name);
                        $('#price').val(response.data.price);
                        $('#menu_form').attr('action',"/admin/menu/"+ response.data.id);
                        $('#method').val('put');
                        $('#menuModal').modal('show');
                    }

                }
             });
        });
    </script>
@endsection
    @endsection        