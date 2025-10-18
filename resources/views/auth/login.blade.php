<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CLSU LMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-green': '#006400',
                        'forest-green': '#228B22',
                    },
                    animation: {
                        fadeIn: 'fadeIn 1s ease-in-out',
                        slideIn: 'slideIn 1s ease-in-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(-20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideIn: {
                            '0%': { opacity: '0', transform: 'translateX(50px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                    },
                },
            },
        };
    </script>
</head>
<body class="font-sans bg-gradient-to-br from-dark-green to-forest-green flex justify-center items-center h-screen text-white p-5 overflow-hidden">
    <div class="flex bg-white rounded-2xl overflow-hidden shadow-2xl max-w-4xl w-full animate-fadeIn md:flex-row flex-col">
        <div class="bg-dark-green p-10 md:p-16 text-white md:w-2/5 w-full text-center flex flex-col justify-center items-center flex-shrink-0">
            <div class="w-32 md:w-40 mb-5 transition-transform duration-300 hover:scale-110 bg-white rounded-full p-4 flex items-center justify-center">
                <i class="fas fa-graduation-cap text-dark-green text-4xl md:text-5xl"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold mb-2 text-center">Central Luzon State University</h1>
            <p class="sub-text text-lg md:text-xl font-light">Nueva Ecija, Philippines</p>
        </div>
        <div class="p-8 md:p-12 md:w-3/5 w-full flex flex-col justify-center animate-slideIn">
            <h2 class="text-3xl md:text-4xl text-dark-green mb-8 text-center font-bold">Online Learning Management System</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block text-lg font-bold text-gray-800 mb-2">Email or ID Number</label>
                    <input type="text" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           placeholder="Enter your email or ID number" 
                           required 
                           class="w-full p-4 border-2 border-gray-300 rounded-lg text-lg text-gray-800 transition duration-300 focus:border-dark-green focus:scale-102 outline-none hover:border-gray-400 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6 relative">
                    <label for="password" class="block text-lg font-bold text-gray-800 mb-2">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="Enter your password" 
                           required 
                           class="w-full p-4 border-2 border-gray-300 rounded-lg text-lg text-gray-800 transition duration-300 focus:border-dark-green focus:scale-102 outline-none hover:border-gray-400 @error('password') border-red-500 @enderror">
                    <button type="button" class="absolute right-4 top-12 text-gray-500 hover:text-gray-700" onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <a href="#" class="block text-base text-dark-green no-underline text-right mb-8 transition duration-300 hover:text-forest-green">Forgot Password?</a>
                <button type="submit" class="w-full p-4 bg-dark-green text-white border-none rounded-lg text-lg font-bold cursor-pointer transition duration-300 hover:bg-forest-green hover:-translate-y-1 active:translate-y-0">Login</button>
            </form>
            
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600 mb-3">Demo Accounts:</p>
                <div class="space-y-1 text-xs text-gray-500">
                    <p><strong>Admin:</strong> admin@clsu.edu.ph / password</p>
                    <p><strong>Instructor:</strong> maria.santos@clsu.edu.ph / password</p>
                    <p><strong>Student:</strong> john.smith@student.clsu.edu.ph / password</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
