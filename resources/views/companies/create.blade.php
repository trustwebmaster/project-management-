@extends('layouts.app')
@section('content')

 <div class="row col-md-9 cok-lg-9 col-sm-9  pull-left" style="background:white;">
       <h1>Create New Company</h1>
    <div class="row  col-md-12 col-lg-12 col-sm-12" >

    <form method="post" action ="{{ route('companies.store') }}">
                {{  csrf_field() }}


          <div class="form-group">
              <label for ="company-name">Name<span class="required">*</span></label>
                <input placeholder="Enter Name"
                     id="company-name"
                     required
                     name="name"
                     spellcheck="false"
                     class="form-control"

                     />
          </div>

      <div class="form-group">
          <label for="company-content">Description</label>
                <textarea placeholder="Enter Descrition"
                    style="resize:vertical"
                    id="company-content"
                    name="description"
                    rows="5" spellcheck="false"
                    class="form-control autosize-target text-left">
                </textarea>
      </div>
      <div class="form-group">
          <input type="submit" class="btn btn-primary"
                  value="Submit"/>
      </div>
    </form>

    </div>
 </div>

 <div class="col-sm-3 col-md-4 col-lg-3 pull-right">
     <div class="sidebar-module">
         <h4>Actions</h4>
          <ol class ="list-unstyled">
          <li><a href="/companies">My Companies</a></li>

          </ol>
     </div>

@endsection



