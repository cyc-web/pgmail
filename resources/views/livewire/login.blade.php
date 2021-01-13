

  
   <div>
        <div class="center">
        <img src="{{asset('images/pg.jpg')}}" alt="logo" width="80" />
                <div class="center">
                  
    <a>POSTGRADUATE COLLEGE MAIL SERVICE</a><hr style="border-bottom:1px solid blue" />


                </div>
    </div>
            <div class="login-center">
                <div class="login-form">
                    <p class="login">Login to start your session</p>
                    @if(session()->has('message'))
            <div class="alert alert-danger" style="color: red;">
                {{session('message')}}
            </div>
            @endif<hr />
                       <div>
            
        </div>
                <form wire:submit.prevent="submit">
                    <div class="form-group">
                        <label class="label"><i class="fas fa-envelope"></i> Email address</label>
                        <input type="email" wire:model.debounce.10000ms="form.email" name="email" class="form-control" placeholder="Enter your email address" aria-describedby="emailHelp" />
                        @error('form.email')
                            <span class="error">{{$message}}</span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label class="label"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" wire:model.debounce.10000ms="form.password" placeholder="Enter your password" class="form-control" />
                        @error('form.password')
                            <span class="error">{{$message}}</span>
                            @enderror
                    </div>
                    <button type="submit" class="button"> 
                        <div wire:loading wire:target="submit">
                            <i class="fas fa-spinner fa-spin"></i>
                            Loading...
                        </div>    
                        <span wire:loading.remove>Login
                    <i class="fas fa-sign-in-alt"></i></span>
                    </button>
                        </form>
                        <p>Dont't have an account? <a href="/register">Click here to register</a></p>
            </div>
                </div>
                </div>

   </div>
