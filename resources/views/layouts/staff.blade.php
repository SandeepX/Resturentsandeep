
@include('staff.section2.header')
    @include('staff.section2.nav')
		
            	<div class="row">
                    <div class="col-12">
                        @include('staff.section2.notify')
                    </div>
                </div>
                
        	       @yield('main-content')
                  
           
@include('staff.section2.footer')



           