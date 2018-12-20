<li class="nav-item"><a href="{{Route('admin.settings')}}" class="nav-link @if(\Request::is('admin/settings')) active @endif"><i class="fa fa-gears nav-icon"></i> <span>Settings</span></a></li>

<li class="nav-item"><a href="{{Route('admin.settings.theme')}}" class="nav-link @if(\Request::is('admin/settings/theme*')) active @endif"><i class="fa fa-file-o nav-icon"></i> <span>Themes</span></a></li>

<li class="nav-item"><a href="{{Route('admin.settings.pterodactyl')}}" class="nav-link @if(\Request::is('admin/settings/pterodactyl*')) active @endif"><i class="fa fa-gamepad nav-icon"></i> <span>Pterodactyl</span></a></li>

<li class="nav-item"><a href="{{Route('admin.settings.payments')}}" class="nav-link @if(\Request::is('admin/settings/payments*')) active @endif"><i class="fa fa-paypal nav-icon"></i> <span>Payments</span></a></li>

<li class="nav-item "><a href="{{Route('admin.settings.virtualcurrencies')}}" class="nav-link @if(\Request::is('admin/settings/virtual-currencies*')) active @endif"><i class="fa fa-money nav-icon"></i> <span>Virtual Currencies</span></a></li>

<li class="nav-item "><a href="{{Route('admin.settings.discord')}}" class="nav-link @if(\Request::is('admin/settings/discord*')) active @endif"><i class="fa fa-question nav-icon" aria-hidden="true"></i>
</i> <span>Discord</span></a></li>

<li class="nav-item"><a href="{{Route('admin.settings.update')}}" class="nav-link @if(\Request::is('admin/settings/update*')) active @endif"><i class="fa fa-wrench nav-icon" aria-hidden="true"></i>
</i> <span>Update</span></a></li>