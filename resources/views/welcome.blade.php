@php
    function generateToken($image, $expiry) {
        $secret = 'your_secret_key';
        return hash('sha256', $image . $expiry . $secret);
    }

    $image = 'image_text.jpg';
    $expiry = time() + 900; // 15 min expiry
    $token = generateToken($image, $expiry);
    $imageUrl = route('serve_image', ['image' => $image, 'token' => $token, 'expiry' => $expiry]);
@endphp

<!DOCTYPE html>
<html>
<body>
    @auth
        <img src="{{ $imageUrl }}" alt="my_image">
        <br>
        Show Images
    @else
        <p>You must be logged in to view images.</p>
    @endauth
</body>
</html>
