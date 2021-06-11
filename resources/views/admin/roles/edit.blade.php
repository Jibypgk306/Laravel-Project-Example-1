<x-admin-master>
    @section('content')
    <div class="row">
@if(session()->has('role-updated'))
            <div class="alert alert-success">{{session('role-updated')}}</div>
            @endif
</div>
<div class="row">
<div class="col-sm-6">
        <h1>Edit Role{{$role->name}}</h1>

        <form method="post" action="{{route('role.update', $role->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$role->name}}">
            </div>
            <button class="btn btn-info">Update</button>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-12">
            @if($permissions->isNotEmpty())
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%"
                     cellspacing="0">
                        <thead>
                        <tr>
                        <th>Options</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Dettach</th>
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                        <th>Options</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                         <th>Attach</th>  
                         <th>Dettach</th> 
                            
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($permissions as $permission)
<tr>
<td><input type="checkbox"
                        @foreach($role->permissions as $role_permission)
                        @if ($role_permission->slug==$permission->slug)
                        checked
                        @endif

                        @endforeach
                        ></td>
<td><input type="checkbox"></td>
<td>{{$permission->id}}</td>
<td>{{$permission->name}}</td>
<td>{{$permission->slug}}</td>
<td>

<form method="post" action="{{route('role.permission.attach',$role)}}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="permission" value="{{$permission->id}}">
                            <td><button type="submit"class="btn-primary"
                            @if($role->permissions->contains($permission))
                            disabled

                            @endif
                            
                            
                            >Attached</button>
                           
                            </form>
                            </td>
                           <td>
                           
                           <form method="post" action="{{route('role.permission.detach',$role)}}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="permission" value="{{$permission->id}}">
                            <td><button type="submit"class="btn-danger"
                            @if(!$role->permissions->contains($permission))
                            disabled

                            @endif
                            
                            
                            >Detached</button>
                           
                            </form>
                           
                           
                           </td> 


</tr>
@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        
        </div>
            
            </div>
    @endsection
</x-admin-master>