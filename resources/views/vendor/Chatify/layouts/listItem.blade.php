<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
    .material-symbols-outlined {
        font-variation-settings:
            'FILL' 0,
            'wght' 800,
            'GRAD' 0,
            'opsz' 24
    }
</style>

{{-- -------------------- Get Help -------------------- --}}
@if ($get == 'help')
    @php
        // Get random staff member ID
        $randomStaffId = \App\Models\User::where('role', 'staff')
            ->inRandomOrder()
            ->value('id');
    @endphp

    <table class="messenger-list-item" data-contact="{{ $randomStaffId }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="saved-messages avatar av-m">
                    <span class="material-symbols-outlined">
                        support_agent
                    </span>
                    <span class="fas fa-help">

                    </span>

                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $randomStaffId }}" data-type="user">Get Staff Help</p>
                <span>Click to be connected to a staff</span>
            </td>
        </tr>
    </table>
@endif


{{-- -------------------- Saved Messages -------------------- --}}
@if ($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="saved-messages avatar av-m">
                    <span class="far fa-bookmark"></span>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Your Notes</p>
                <span>Write your notes or remainders here.</span>
            </td>
        </tr>
    </table>
@endif


{{-- -------------------- Contact list -------------------- --}}
@if ($get == 'users' && !!$lastMessage)
    <?php
    $lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
    $lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8') . '..' : $lastMessageBody;
    ?>
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td style="position: relative">
                @if ($user->active_status)
                    <span class="activeStatus"></span>
                @endif
                <div class="avatar av-m" style="background-image: url('{{ $user->avatar }}');">
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $user->id }}" data-type="user">
                    {{ strlen($user->name) > 12 ? trim(substr($user->name, 0, 12)) . '..' : $user->name }}
                    <span class="contact-item-time"
                        data-time="{{ $lastMessage->created_at }}">{{ $lastMessage->timeAgo }}</span>
                </p>
                <span>
                    {{-- Last Message user indicator --}}
                    {!! $lastMessage->from_id == Auth::user()->id ? '<span class="lastMessageIndicator">You :</span>' : '' !!}
                    {{-- Last message body --}}
                    @if ($lastMessage->attachment == null)
                        {!! $lastMessageBody !!}
                    @else
                        <span class="fas fa-file"></span> Attachment
                    @endif
                </span>
                {{-- New messages counter --}}
                {!! $unseenCounter > 0 ? '<b>' . $unseenCounter . '</b>' : '' !!}
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@php
    if (auth()->user()->role == 'customer') {
        // search for staff
        $search_for = 'staff';
    } else {
        $search_for = 'customer';
    }
@endphp
@if ($get == 'search_item' && $user->role == $search_for)
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="avatar av-m" style="background-image: url('{{ $user->avatar }}');">
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $user->id }}" data-type="user">
                    {{ strlen($user->name) > 12 ? trim(substr($user->name, 0, 12)) . '..' : $user->name }}
            </td>

        </tr>
    </table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if ($get == 'sharedPhoto')
    <div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif