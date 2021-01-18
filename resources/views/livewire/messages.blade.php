
    @if(count($users) == 0)
                  <p style="text-align: center;">You have no message yet</p>
                  @else
  <div class="table-responsive">
            <table id="" class="table">
                <thead>
                <tr>
                  <th>From </th>
                  <th>Subject</th>
                  <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                 
                @foreach($users as $user)
                @if($user->message_status == 0)
                 <tr style="background-color: rgb(235, 230, 230);">
                  <td><a href="/read/{{$user->id}}" style="text-decoration: none; color:black">{{$user->name}} {{$user->othername}}</a></td>
                  <td><a href="/read/{{$user->id}}" style="text-decoration: none; color:black">{{substr($user->subject, 0, 200)}}</a></td>
                  <td class="text-center"><i class="fa fa-archive" wire:click='archive({{$user->id}})' style="cursor: pointer;"></i>&nbsp; &nbsp;&nbsp; &nbsp; <i class="fa fa-trash text-danger" wire:click="remove({{$user->id}})" style="cursor: pointer;"></i> </td>
                </tr>
                @else
                <tr>
                  <td><a href="/read/{{$user->id}}" style="text-decoration: none;">{{$user->name}} {{$user->othername}}</a></td>
                  <td><a href="/read/{{$user->id}}" style="text-decoration: none;">{{substr($user->subject, 0, 200)}}</a></td>
                  <td class="text-center"><i class="fa fa-archive" wire:click='archive({{$user->id}})' style="cursor: pointer;"></i>&nbsp; &nbsp;&nbsp; &nbsp; <i class="fa fa-trash text-danger" wire:click="remove({{$user->id}})" style="cursor: pointer;"></i> </td>
                </tr>
                @endif
                @endforeach
              
                </tbody>
                
              </table>
              </div>
                @endif