
    <div class="container-fluids">
                <div class="center">
                    <div class="login-logo">
                        <img src="{{asset('images/pg.jpg')}}" alt="logo" width="80" /> &nbsp;&nbsp;&nbsp;
    <a>POSTGRADUATE COLLEGE MAIL SERVICE</a><hr style="border-bottom:1px solid blue" />
  </div>

                </div>
            <div class="login-center">
                <div class="login-form">
                    <p class="login">Login to start your session</p><hr />
                <form wire:submit.prevent="submit">
                    <div class="form-group">
                        <label><i class="fas fa-envelope" /> Email address</label>
                        <input type="email" wire:model="form.email" class="form-control" placeholder="Enter your email address" aria-describedby="emailHelp" />
                        @error('form.email')
                            <span class="error">{{$message}}</span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-lock" /> Password</label>
                        <input type="password" wire:model="form.password" placeholder="Enter your password" class="form-control" />
                        @error('form.email')
                            <span class="error">{{$message}}</span>
                            @enderror
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Login <i class="fas fa-sign-in-alt" /></button>
                        </form>
                        <p>Dont't have an account? <a href="/register">Click here to register</a></p>
            </div>
                </div>
                </div>

