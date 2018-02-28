<li class="@if(\Request::is('admin/settings')) active @endif"><a href="{{Route('admin.settings')}}"><i class="fa fa-gears"></i> <span>Settings</span></a></li>

<li class="@if(\Request::is('admin/settings/theme*')) active @endif"><a href="{{Route('admin.settings.theme')}}"><i class="fa fa-file-o "></i> <span>Themes</span></a></li>