@extends('layouts.admin')

@section('title','Users')
    
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
                                <div class="ibox-title">User List</div>
                                    <a href="" class="btn btn-success add_btn">
                                        <i class="fa fa-plus"></i>Add User
                                    </a>
                                </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th> UserID</th>
                                            <th> User Name</th>
                                            <th>Email</th><th>Role</th><th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>@if(isset( $userData))
                                                @foreach( $userData as $key=>$userdetail)
                                        <tr>
                                            <td>
                                             {{$userdetail->id}} 
                                            </td>
                                            <td>{{ucfirst($userdetail->name)}}</td>
                                            <td>{{$userdetail->email}}</td>
                                            <td>{{ucfirst($userdetail->role)}}</td>
                                            <td>{{ucfirst($userdetail->status)}}</td> <td>
                                                <a href="" class="btn btn-success pull-left edit_user" style="border-radius:50%;"      data-id="{{ $userdetail->id  }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>


                                                {{ Form::open(['url'=>route('user.destroy', $userdetail->id),'onsubmit'=>'return confirm("Are you sure you want to delete this user ?")','class'=>'form pull-left' ]) }}

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
            <!-- END PAGE CONTENT--><div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="                                     userModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id=" userModalLabel"> User Add</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>

                                        {{  Form::open(['url'=>route('user.store'),'files'=>true , 'id'=>'user_form']) }}
                                        <div class="modal-body">
                                            
                                            <div class="form-group row">
                                                {{ Form::label('title',"Name:",['class'=>'col-md-3'])}}
                                                <div class="col-md-9">
                                                    {{ Form::text('name','',['class'=>'form-control form-control-sm','id'=>'name','placeholder'=>'Enter  User name','required'=>true]) }}
                                                </div>
                                             </div>
                                            
                                            <div class="form-group row">
                                            {{ Form::label('Email',"Email:",['class'=>'col-md-3'])}}
                                                <div class="col-md-9">
                                                {{ Form::email('email','',['class'=>'form-control form-control-sm','id'=>'email','placeholder'=>'Enter  User email','required'=>true]) }}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                            {{ Form::label('Password',"Password:",['class'=>'col-md-3'])}}
                                                <div class="col-md-9">
                                                {{ Form::password('password',['class'=>'form-control form-control-sm','id'=>'password','placeholder'=>'Enter  password','required'=>true]) }}
                                                </div>
                                            </div>
                                            


                                             
                                            <div class="form-group row">
                                                {{ Form::label('status',"Status:",['class'=>'col-md-3'])}}
                                                <div class="col-md-9">
                                                    {{ Form::select('status',['active'=>'Active','inactive'=>'Inactive'],null, ['class'=>'form-control form-control-sm','id'=>'status','required'=> true]) }}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {{ Form::label('role',"Role:",['class'=>'col-md-3'])}}
                                                <div class="col-md-9">
                                                    {{ Form::select('role',['admin'=>'Admin','staff'=>'Staff','customer'=>'Customer'],null,['class'=>'form-control form-control-sm','id'=>'role','required'=> true]) }}
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
            $('.modal-title').html('User Add');
            $('#name').val('');
            $('#email').val('');
            //$('password').val('');
            $('#role').val('');
            $('#status').val('');
            $('#user_form').attr('action',"{{ route('user.store') }}");
            $('#method').attr('method','post');
            $('#userModal').modal('show');
        });

         $('.edit_user').click( function(e){
             e.preventDefault();
             var user_id = $(this).data('id');
             
             $.ajax({
                url: "{{route('user-detail')}}",
                type: "post",
                data:{
                    user_id: user_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                   if (typeof(response)!='object') {
                    response = $.parseJSON(response);
                   }

                   if(response.status){
                        $('.modal-title').html('User Update');
                        $('#name').val(response.data.name);
                        $('#email').val(response.data.email);
                        
                        $('#role').val(response.data.role);
                        $('#status').val(response.data.status);
                        $('#user_form').attr('action',"/admin/user/"+ response.data.id);
                        $('#method').val('put');
                        $('#userModal').modal('show');
                    }

                }
             });
        });
        
    </script>
@endsection
    @endsection        