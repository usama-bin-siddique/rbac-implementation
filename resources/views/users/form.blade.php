<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                {{--                {{isset($variable) ? $variable->name : old('username')}}--}}

                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ ucwords(str_replace('.', ' ', request()->route()->getName())) }}
                        </h2>
                    </header>

                    <form method="post"
                          action="{{ request()->route()->getName() === 'users.create' ? route('users.store') : route('users.update',$user->id) }}"
                          class="mt-6 space-y-6">
                        @csrf
                        @method(request()->route()->getName() === 'users.create'?'POST' :'PUT')
                        <div>
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name', $user->name ?? '')" required autofocus
                                          placeholder="Enter user name"
                                          autocomplete="name"/>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Phone')"/>
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                                          :value="old('phone', $user->phone ?? '')" required autofocus
                                          placeholder="Enter phone number"
                                          autocomplete="phone"/>
                            <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                          :value="old('email', $user->email ?? '')" required placeholder="Enter email"
                                          autocomplete="username"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Password')"/>
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                          :value="old('password', '')"
                                          autofocus placeholder="Enter password"
                                          autocomplete="password"/>
                            <x-input-error class="mt-2" :messages="$errors->get('password')"/>
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                          class="mt-1 block w-full"
                                          :value="old('password_confirmation', '')"
                                          autofocus placeholder="Re-enter password"
                                          autocomplete="password_confirmation"/>
                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')"/>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-secondary-button type="button"
                                                onclick="window.location.href='{{ route('users.index') }}'">{{ __('Back') }}</x-secondary-button>
                            <x-primary-button
                                type="submit">{{ __(request()->route()->getName() === 'users.create'? 'Save' : 'Update') }}</x-primary-button>

                            @if (session('status') === 'data-saved')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
