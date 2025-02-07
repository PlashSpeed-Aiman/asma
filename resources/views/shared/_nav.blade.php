<div class="navbar bg-base-100 justify-between">

    <div class="flex">
        <div class="">
            <a href="/" class="btn btn-ghost normal-case text-xl">Home</a>
        </div>
        <div class="">
            <a href="{{ route('loan.list') }}" class="btn btn-ghost normal-case text-xl">Asset List</a>
        </div>
        @if(Auth::check())
            <div class="">
                <a href="{{ route('asset-management.index') }}" class="btn btn-ghost normal-case text-xl">Asset
                    Management</a>
            </div>
        @endif
    </div>
    @if(Auth::check())
        <div>
            <div  class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost">
                    <div class="font-bold">{{ Auth::user()->name }}</div>
                </label>
                <div>
                    <div class="dropdown-content bg-base-100 rounded-box w-52 shadow">
                        <div class="dropdown-item ">
                            <div class="w-full">
                                <div class="p-2 w-full flex flex-col">
                                    <div class="px-2 font-bold">{{ Auth::user()->name }}</div>
                                    <a href="{{ route('logout') }}" class=" px-2 w-full rounded hover:bg-accent">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            @else

                <div class="">
                    <a href="{{ route('login') }}" class="btn btn-ghost normal-case text-xl">Login</a>
                </div>

            @endif
        </div>
        @push('scripts')
            <script>

            </script>
@endpush
