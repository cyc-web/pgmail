@if(count($users) == 0)
                  <p style="text-align: center;">You have nothing yet</p>
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
                 <tr>
                  <td><a href="/read/{{$user->id}}">{{$user->name}} {{$user->othername}}</a></td>
                  <td><a href="/read/{{$user->id}}">{{substr($user->subject, 0, 200)}}</a></td>
                  <td class="text-center"><i class="fa fa-trash text-danger" wire:click='remove({{$user->id}})' style="cursor: pointer;"></i></td>
                </tr>
               
                @endforeach
                </tbody>
                
              </table>
              </div>
              @endif