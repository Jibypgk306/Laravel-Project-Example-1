

<x-admin-master>
    @section('content')
<div class="row">
@if(session()->has('role-deleted'))
            <div class="alert alert-danger">{{session('role-deleted')}}</div>
            @endif
</div>
        <h1>Roles</h1>
        <div class="row">
        <div class="col-sm-3">
        <form method="post" action="{{route('role.store')}}">
        @csrf
        <div class="form-group">
        <label for="name">Name</label>
        <input type="text"id="name"  name="name" class="form-control">


        <div>
        
        @error('name')
        <span><b>{{$message}}<b></span>
        @enderror
        
        </div>
        </div>
        <button class="btn btn-primary" type="submit">Create</button>
        
        </form>
        
        </div>
        <div class="col-sm-9">
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%"
                     cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Delete</th>
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                         <th>Delete</th>   
                            
                        </tr>
                        </tfoot>
                        <tbody>
@foreach($roles as $role)
<tr>
<td>{{$role->id}}</td>
<td><a href="{{route('roles.edit',$role->id)}}">{{$role->name}}</a></td>
<td>{{$role->slug}}</td>
<td><form method="post" action="{{route('roles.destroy',$role->id)}}">
@csrf
@method("DELETE")
<button class="btn btn-danger" type="submit">DELETE</button>
</form></td>

</tr>
@endforeach
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        </div>
        </div>
    @endsection

</x-admin-master>