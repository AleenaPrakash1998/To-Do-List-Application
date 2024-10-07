<x-guest-layout>
    <div class="">
        <div class="authentication-inner d-flex justify-content-center align-items-center margin-auto vh-100">
            <!-- First Card (Login Form) -->
            <div class="card border-0 shadow-none" style="max-width: 700px;">
                <div class="card-body mt-2 d-flex">
                    <div class="mt-4">
                        <div class="app-brand justify-content-center text-center">
                            <span class="app-brand-text demo text-body fw-bold">
                                <h1 class="text-uppercase">To-Do List</h1>
                        <hr/>
                            </span>
                        </div>
                        <form method="POST" action="{{ route('register') }}" id="formRegistration">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')"/>
                                <br>
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                              :value="old('name')" autocomplete="name"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger"/>
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')"/>
                                <br>
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                              :value="old('email')" autocomplete="username"/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger"/>
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')"/>
                                <br>
                                <x-text-input id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              autocomplete="new-password"/>

                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger"/>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
                                <br>
                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                              type="password"
                                              name="password_confirmation" autocomplete="new-password"/>

                                <x-input-error :messages="$errors->get('password_confirmation')"
                                               class="mt-2 text-danger"/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                   href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-primary-button class="btn btn-secondary d-grid w-100 mt-4">
                                    {{ __('Register') }}
                                </x-primary-button>
                            </div>
                        </form>

                    </div>
                    <div class="px-2 ms-4">
                        <img src="{{ asset('assets/img/banners/banner.jpg') }}" class="w-100 h-100">
                    </div>
                </div>

            </div>
            <!-- Second Card (Banner) -->

        </div>
    </div>
    <script>

        $(function () {
            $('#formRegistration').validate({
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true,
                    },
                    name: {
                        required: true,
                    }
                },
            })
        })
        document.getElementById('email').blur();
    </script>
</x-guest-layout>
