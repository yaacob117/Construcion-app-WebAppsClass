<!-- Navigation -->
<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="/" class="text-white font-bold text-xl">Construction App</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @auth
                            @if(auth()->user()->hasAnyRole(['Administrator', 'Sales']))
                                <a href="{{ route('customers.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Customers</a>
                                <a href="{{ route('customer_orders.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Customer Orders</a>
                            @endif

                            @if(auth()->user()->hasAnyRole(['Administrator', 'Purchasing']))
                                <a href="{{ route('enterprise_orders.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Enterprise Orders</a>
                            @endif

                            @if(auth()->user()->hasAnyRole(['Administrator', 'Sales', 'Purchasing']))
                                <a href="{{ route('products.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Products</a>
                                <a href="{{ route('order_products.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Order Products</a>
                            @endif

                            @if(auth()->user()->hasAnyRole(['Administrator', 'Warehouse']))
                                <a href="{{ route('evidence_pictures.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Evidence Pictures</a>
                            @endif

                            @if(auth()->user()->hasRole('Administrator'))
                                <a href="{{ route('users.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Users</a>
                                <a href="{{ route('roles.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Roles</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    @auth
                        <span class="text-gray-300 mr-4">{{ auth()->user()->name }} ({{ auth()->user()->role->name }})</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif