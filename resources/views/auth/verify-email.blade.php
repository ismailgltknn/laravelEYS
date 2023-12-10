<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Giriş yaptığınız için teşekkürler! Başlamadan önce, size gönderdiğimiz bağlantıya tıklayarak email adresinizi doğrulayabilir misiniz? 
            Email size ulaşmadıysa, yeni bir doğrulama linki gönderebiliriz.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Kayıt olurken belirttiğiniz email adresini yeni bir doğrulama linki gönderildi.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Tekrar link gönder') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Çıkış Yap') }}
            </button>
        </form>
    </div>
</x-guest-layout>
