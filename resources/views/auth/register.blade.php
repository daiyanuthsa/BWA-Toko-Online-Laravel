@extends('layouts.auth')

@section('content')
    <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center justify-content-center row-login">
                    <div class="col-lg-4">
                        <h2>Memulai untuk jual beli <br />dengan cara terbaru</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input 
                                    id="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    v-model="name" 
                                    name="name" 
                                    required 
                                    autofocus 
                                    autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    v-model="email" 
                                    required 
                                    autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input 
                                    id="password" 
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror" 
                                    v-model="password"
                                    name="password" 
                                    required
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input 
                                    id="password_confirmation" 
                                    type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    v-model="password_confirmation"
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label>Store</label>
                                <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="is_store_open"
                                        id="openStoreTrue" value="true" v-model="is_store_open" />
                                    <label for="openStoreTrue" class="custom-control-label">Iya, Boleh</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="is_store_open"
                                        id="openStoreFalse" value="false" v-model="is_store_open" />
                                    <label for="openStoreFalse" class="custom-control-label">Enggak, Makasih</label>
                                </div>
                            </div>
                            <div class="form-group" v-if="is_store_open === 'true'">
                                <label for="store_name">Nama Toko</label>
                                <input 
                                    id="store_name" 
                                    type="text" 
                                    class="form-control @error('store_name') is-invalid @enderror"
                                    v-model="store_name" 
                                    name="store_name" 
                                    required 
                                    autofocus 
                                    autocomplete="store_name" />
                                <x-input-error :messages="$errors->get('store_name')" class="mt-2" />
                            </div>
                            <div class="form-group" v-if="is_store_open === 'true'">
                                <label for="categories_id">Category</label>
                                <select 
                                    id="categories_id" 
                                    name="categories_id" 
                                    class="form-control" 
                                    v-model="categories_id">
                                    <option value="" disabled hidden>Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-4">Sign Up Now</button>
                            <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">Back to Sign In</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
        new Vue({
            el: "#register",
            data: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                is_store_open: null,
                store_name: "",
                categories_id: ""
            },
            mounted() {
                AOS.init();
                // Uncomment this if you need to show error toast
                // this.$toasted.error(
                //     "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
                //         position: "top-center",
                //         className: "rounded",
                //         duration: 1000,
                //     }
                // );
            }
        });
    </script>
@endpush


{{-- <x-guest-layout class="">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout> --}}
