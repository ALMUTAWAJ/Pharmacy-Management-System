<script>
    // Password validation logic
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    const submitButton = document.querySelector('button[type="submit"]');

    confirmPasswordInput.addEventListener('input', validatePassword);

    function validatePassword() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password === confirmPassword) {
            confirmPasswordInput.setCustomValidity('');
            confirmPasswordError.textContent = '';
            submitButton.disabled = false;
        } else {
            confirmPasswordInput.setCustomValidity('Passwords do not match');
            confirmPasswordError.textContent = 'Passwords do not match';
            submitButton.disabled = true;
        }
    }
</script> 

<div class="block rounded-lg p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
    <form>
        @csrf
        @isset($isEditing)
            @if ($isEditing)
                @method('PUT')
            @endif
        @else
            @php
                $isEditing = false;
            @endphp
        @endisset

        <!-- First name input -->
        <div class="mb-6">
            <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" id="firstName" name="firstName" placeholder="First name" value="{{ old('firstName', $user->firstName ?? '') }}" @if (!$isEditing) required @endif>
        </div>

        <!-- Last name input -->
        <div class="mb-6">
            <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" id="lastName" name="lastName" placeholder="Last name" value="{{ old('lastName', $user->lastName ?? '') }}" @if (!$isEditing) required @endif>
        </div>

        <!-- Email input -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Email address" value="{{ old('email', $user->email ?? '') }}" @if (!$isEditing) required @endif>
        </div>

        <!-- Position input -->
        <div class="mb-6">
            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
            <input type="text" id="position" name="position" placeholder="Position" value="{{ old('position', $user->position ?? '') }}" @if (!$isEditing) required @endif>
        </div>

        <!-- Password input -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" @if (!$isEditing) required @endif>
        </div>

        <!-- Confirm Password input -->
        <div class="mb-6">
            <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" @if (!$isEditing) required @endif>
            <p id="confirmPasswordError" class="text-red-500"></p>
        </div>

        <!-- Submit button -->
        <a href="{{route('admin.users')}}" class="mr-2">
            <x-secondary-button>Cancel</x-secondary-button>
        </a>
        <x-primary-button type="submit">@if ($isEditing) Update @else Add Member @endif</x-primary-button>
    </form>
</div>