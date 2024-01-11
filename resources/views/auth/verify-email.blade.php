<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <!-- end row -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body">

                        <div class="p-2">
                            <div class="text-center">

                                <div class="avatar-md mx-auto">
                                    <div class="avatar-title rounded-circle bg-light">
                                        <i class="bx bxs-envelope h1 mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <div class="p-2 mt-4">

                                    <h4>Verify your email</h4>
                                    <p class="mb-4">Please enter the 6 digit code sent to <span
                                            class="fw-semibold">{{$email}}</span></p>

                                        <form wire:submit.prevent="verifyCode">
                                            <div class="row">
                                                <div class="col-6 mx-auto">
                                                    <input type="text" class="form-control form-control-lg text-center two-step"
                                                    name="code" wire:model="code" required>
                                                    @error('code') <span class="text-red-300 text-danger">{{ $message }}</span> @enderror                                        
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-success w-md">Confirm</button>
                                            </div>
                                        </form>
                                        {{-- <form wire:submit.prevent="verifyCode">
                                            <div class="row">
                                                @for ($i = 1; $i <= 6; $i++)
                                                    <div class="col-2">
                                                        <div class="mb-3">
                                                            <label for="digit{{ $i }}-input" class="visually-hidden">Digit {{ $i }}</label>
                                                            <input
                                                                type="text"
                                                                class="form-control form-control-lg text-center two-step"
                                                                maxLength="1"
                                                                wire:model="code.{{ $i }}"
                                                                id="digit{{ $i }}-input"
                                                                required
                                                            >
                                                        </div>
                                                        @error("code.$i")
                                                            <span class="text-red-300 text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endfor
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-success w-md">Confirm</button>
                                            </div>
                                        </form> --}}
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-4 text-center">
                    <p>Didn't receive a code ? <a href="#" wire:click="resendVerificationCode" class=" fw-medium text-primary"> Resend </a> </p>
                    
                </div>

            </div>
        </div>
    </div>
</div>