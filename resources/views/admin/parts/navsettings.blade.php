<li class="@if(\Request::is('admin/settings')) active @endif"><a href="{{Route('admin.settings')}}"><i class="fa fa-gears"></i> <span>Settings</span></a></li>

<li class="@if(\Request::is('admin/settings/theme*')) active @endif"><a href="{{Route('admin.settings.theme')}}"><i class="fa fa-file-o "></i> <span>Themes</span></a></li>

<li class="@if(\Request::is('admin/settings/pterodactyl*')) active @endif"><a href="{{Route('admin.settings.pterodactyl')}}"><i class="fa fa-gamepad "></i> <span>Pterodactyl</span></a></li>

<li class="@if(\Request::is('admin/settings/payments*')) active @endif"><a href="{{Route('admin.settings.payments')}}"><i class="fa fa-paypal "></i> <span>Payments</span></a></li>