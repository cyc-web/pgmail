
    @if(count($users) == 0)
                  <p style="text-align: center;">You have no message yet</p>
                  @else
  <div class="table-responsive">
            <table id="" class="table">
                <thead>
                <tr>
                  <th>From </th>
                  <th>Subject</th>
                  <th>Status</th>
                  <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                 
                @foreach($users as $user)
                @if($user->status != 1)
                 <tr style="background-color: rgb(235, 230, 230);">
                 
                  <td><a href="/show/{{$user->id}}" style="text-decoration: none; color:black">{{$user->sender}}</a></td>
                  <td><a href="/show/{{$user->id}}" style="text-decoration: none; color:black">{{substr($user->subject, 0, 100)}}</a></td>
                  <td>
                    @if($user->status != 2)
                    <p class="text-success">Active</p>
                    @else
                    <p >Replied</p>
                    @endif
                  </td>
                  <td class="text-center"><a href="/response/{{$user->id}}" title="Reply"><i class="fa fa-edit"></i></a></td>
                </tr>
                @else
                <tr>
                  
                  <td><a href="/show/{{$user->id}}" style="text-decoration: none;">{{$user->sender}}</a></td>
                  <td><a href="/show/{{$user->id}}" style="text-decoration: none;">{{substr($user->subject, 0, 100)}}</a></td>
                  <td>
                    @if($user->status != 2)
                    <p class="text-success">Active</p>
                    @else
                    <p >Replied</p>
                    @endif
                  </td>
                  <td class="text-center"><a href="/response/{{$user->id}}" title="Reply"><i class="fa fa-edit"></i></a> </td>
                </tr>
                @endif
                @endforeach
              
                </tbody>
                
              </table>
              </div>
                @endif