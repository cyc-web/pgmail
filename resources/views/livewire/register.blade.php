<div>
    
    <div class="center">
        <img src="{{asset('images/pg.jpg')}}" alt="logo" width="80" />
            <div class="center">              
                <a>POSTGRADUATE COLLEGE MAIL SERVICE</a><hr style="border-bottom:1px solid blue" />
            </div>
    </div>
            <div class="login-center">
                <div class="create-form">
                    <p class="login">Register to have your account</p><hr />
                    <div class="container">
                        <form wire:submit.prevent="submit">
                            <div class="form-row">
                                <div class="col">
                                    <label class=""><i class="fas fa-tag"></i> Title</label>
                                    <select wire:model.debounce.50000ms="form.title" class="form-control">
                                        <option></option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof.">Prof.</option>
                                    
                                    </select>
                                    @error('form.title')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        <div class="form-row">
                            <div class="col">
                                <label><i class="fas fa-user-circle"></i> Surname</label>
                                <input type="text" wire:model.debounce.50000ms="form.name" name="name" class="form-control" placeholder="Enter your surname" aria-describedby="emailHelp" />
                                @error('form.name')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                            </div>
                            <div class="col-md-12">
                                <label><i class="fas fa-user-plus"></i> Othernames</label>
                                <input type="text" wire:model.debounce.50000ms="form.othername" name="othername" class="form-control" placeholder="Enter your othernames" />
                                @error('form.othername')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label class=""><i class="fas fa-home"></i> Unit</label>
                                <select wire:model.debounce.50000ms="form.unit" class="form-control">
                                    <option></option>
                                    <option value="Admission">Admission</option>
                                    <option value="Audit">Audit</option>
                                    <option value="Committee">Committee</option>
                                    <option value="Deputy Provost">Deputy Provost</option>
                                    <option value="Deputy Registrar">Deputy Registrar</option>
                                    <option value="Exams">Exams</option>
                                    <option value="Finance">Finance</option>
                                    <option value="ICT">ICT</option>
                                    <option value="Provost">Provost</option>
                                    <option value="Records">Records</option>
                                </select>
                                @error('form.unit')
                            <span class="error">{{$message}}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label class=""><i class="fas fa-envelope"></i> Email address </label>
                                <input type="email" wire:model.debounce.50000ms="form.email" name="email" class="form-control" placeholder="Enter your email address" aria-describedby="emailHelp" />
                                @error('form.email')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                            </div>
                            <div class="col">
                                <label class=""> <i class="fas fa-phone-alt"></i> Telephone</label>
                                <input type="text" wire:model.debounce.50000ms="form.telephone" name="telephone" class="form-control" placeholder="Enter your telephone number" aria-describedby="emailHelp" />
                                @error('form.telephone')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                            </div>
                        </div>
                            
                        <div class="form-row">
                            <div class="col">
                                <label class=""><i class="fas fa-lock"></i> Password </label>
                                <input type="password" wire:model.debounce.50000ms="form.password" name="password" placeholder="Enter your password" class="form-control" />
                                @error('form.password')
                                    <span class="error">{{$message}}</span>
                                    @enderror
                            </div>
                            <div class="col">
                                <label class=""><i class="fas fa-lock"></i> Confirm Password </label>
                                <input type="password" name="password" wire:model.debounce.50000ms="form.password_confirmation" placeholder="Enter your password again" class="form-control" />
                            </div>
                        </div>
                   
                        <div class="form-row">
                            <button type="submit" class="button">
                                <div wire:loading wire:target="submit">
                            <i class="fas fa-spinner fa-spin"></i>
                            Loading...
                        </div>    
                        <span wire:loading.remove>
                            Register <i class="fas fa-registered"></i>
                        </span>
                    </button>
                        </div>
                    </form>
                    </div>
                        <p>Already have an account? <a href="/">Click here to login</a></p>
            </div>
                </div>
                </div>


</div>