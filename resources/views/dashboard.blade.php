<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <!-- Bell Icon -->
<div>
    <button onclick="toggleNoti()" style="position: relative; border: none; background-color: transparent; font-size: 18px;">
        <i class="bi bi-bell-fill "   ></i>
        @if ($unreadCount > 0)
            <span style="color: red; position: absolute; top: 0; right: 0; font-weight: bold;">
                {{ $unreadCount }}
            </span>
        @endif
    </button>


</div>

<!-- Notification List (hidden by default) -->
<div id="notiList" style="display: none; border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
    @forelse ($notifications as $noti)
        <div style="margin-bottom: 5px;">
            @if (!$noti->viewed)
                <strong>[NEW]</strong>
            @endif
            <a href="{{ route('noti.view', $noti->id) }}">{{ $noti->title }}</a>
        </div>
    @empty
        <div>No notifications.</div>
    @endforelse
</div>

<!-- JS to toggle -->
<script>
    function toggleNoti() {
        const box = document.getElementById('notiList');
        box.style.display = (box.style.display === 'none') ? 'block' : 'none';
    }
</script>
 🔔
</body>
</html>
