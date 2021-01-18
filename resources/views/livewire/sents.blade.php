 @if(count($messages) == 0)
                  <p style="text-align: center;">You have no sent message yet</p>
                  @else
<div class="table-responsive">
          <table id="" class="table">
                <thead>
                <tr>
                  <th>To</th>
                  <th>Subject</th>
                  <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($messages as $user)
                <tr>
                  <td><a href="/view/{{$user->id}}">{{$user->name}} {{$user->othername}}</a></td>
                  <td><a href="/view/{{$user->id}}">{{substr($user->subject, 0, 200)}}</a></td>
                  <td class="text-center"><i class="fa fa-trash text-danger" wire:click='remove({{$user->id}})' style="cursor: pointer;"></i></td>
                </tr>
              
                @endforeach
                </tbody>
                
              </table>
            </div>
            @endif