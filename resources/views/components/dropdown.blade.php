<div class="dropdown-basic">
    <div class="dropdown">
        <button class="btn dropbtn btn-primary btn-round dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi {{ $icon ?? 'mdi-dots-vertical' }}"></i>
        </button>
        <div class="dropdown-menu">
            {{ $slot }}
        </div>
    </div>
</div>
