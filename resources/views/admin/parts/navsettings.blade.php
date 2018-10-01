<li class="nav-item @if(\Request::is('admin/settings')) active @endif"><a href="{{Route('admin.settings')}}" class="nav-link"><i class="fa fa-gears nav-icon"></i> <span>Settings</span></a></li>

<li class="nav-item @if(\Request::is('admin/settings/theme*')) active @endif"><a href="{{Route('admin.settings.theme')}}" class="nav-link"><i class="fa fa-file-o nav-icon"></i> <span>Themes</span></a></li>

<li class="nav-item @if(\Request::is('admin/settings/pterodactyl*')) active @endif"><a href="{{Route('admin.settings.pterodactyl')}}" class="nav-link"><i class="fa fa-gamepad nav-icon"></i> <span>Pterodactyl</span></a></li>

<li class="nav-item @if(\Request::is('admin/settings/payments*')) active @endif"><a href="{{Route('admin.settings.payments')}}" class="nav-link"><i class="fa fa-paypal nav-icon"></i> <span>Payments</span></a></li>

<li class="nav-item @if(\Request::is('admin/settings/discord*')) active @endif"><a href="{{Route('admin.settings.discord')}}" class="nav-link"><i class="fa fa-question nav-icon" aria-hidden="true"></i>
</i> <span>Discord</span></a></li>

<li class="nav-item @if(\Request::is('admin/settings/update*')) active @endif"><a href="{{Route('admin.settings.update')}}" class="nav-link"><i class="fa fa-wrench nav-icon" aria-hidden="true"></i>
</i> <span>Update</span></a></li>