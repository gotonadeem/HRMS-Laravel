<!DOCTYPE html>
<html class="fixed">
    <head>
        <meta charset="UTF-8">
        <title>{{ get_option('site_title') }}</title>
        <meta name="keywords" content="{{ get_option('company_name') }}" />
        <meta name="description" content="{{ get_option('company_name') }}">
        <meta name="author" content="{{ get_option('company_name') }}">
        {{-- Mobile Metas --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- Web Fonts  --}}
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        {{-- Vendor CSS --}}
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/font-awesome/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/magnific-popup/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/summernote/summernote.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/bootstrap-datepicker/css/datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/select2/select2.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/stylesheets/datatables.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/stylesheets/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/stylesheets/toastr.css') }}">
        {{-- Specific Page Vendor CSS --}}
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css') }}">
        {{-- Theme CSS --}}
        <link rel="stylesheet" href="{{ asset('public/assets/stylesheets/theme.css') }}">
        {{-- Skin CSS --}}
        <link rel="stylesheet" href="{{ asset('public/assets/stylesheets/skins/default.css') }}">
        {{-- Custom CSS --}}
        @yield('css-stylesheet')
        {{-- Head Libs --}}
        <script src="{{ asset('public/assets/vendor/modernizr/modernizr.js') }}"></script>
    </head>
    <body>
        <div id="preloader" style="display: none;">
            <div class="loader__spin"></div>
        </div>
        <div id="main_modal" class="modal animated bounceInDown" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>  
                    <div class="alert alert-danger" style="display:none; margin: 15px;"></div>
                    <div class="alert alert-success" style="display:none; margin: 15px;"></div>             
                    <div class="modal-body" style="overflow:hidden;"></div>
                </div>
            </div>
        </div>
        <section class="body">
            {{-- start: header --}}
            <header class="header">
                <div class="logo-container">
                    <a href="../" class="logo">
                        <img src="{{ get_logo() }}" height="35" alt="{{ _lang('Logo') }}" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
                {{-- start: search & user box --}}
                <div class="header-right">
                    <span class="separator"></span>
                    <ul class="notifications">
                        <li>
                            <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="badge">
                                    {{ count(notifications(Auth::user()->id)) }}
                                </span>
                            </a>
            
                            <div class="dropdown-menu notification-menu">
                                <div class="notification-title">
                                    <span class="pull-right label label-default">
                                        {{ count(notifications(Auth::user()->id)) }}
                                    </span>
                                    {{ _lang('Notifications') }}
                                </div>
            
                                <div class="content">
                                    <ul>
                                        @foreach (notifications(Auth::user()->id) AS $data)
                                            <li>
                                                <a href="#" class="clearfix">
                                                    <div class="image">
                                                        <i class="fa fa-bell bg-danger"></i>
                                                    </div>
                                                    <span class="title">
                                                        {{ $data->message }}
                                                    </span>
                                                    <span class="message">
                                                        {{ time_elapsed_string($data->created_at) }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <span class="separator"></span>
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="{{ asset('public/uploads/images/' . Auth::user()->profile) }}" alt="{{ _lang('Profile') }}" class="img-circle"/>
                            </figure>
                            <div class="profile-info">
                                <span class="name">{{ _lang('Hi') }}, {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                            </div>
                            <i class="fa custom-caret"></i>
                        </a>
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" class="ajax-modal" tabindex="-1" href="{{ route('profile.show') }}" data-title="{{ _lang('Details') }}"><i class="fa fa-user"></i>{{ _lang('My Profile') }}</a>
                                </li>
                                <li>
                                    <a role="menuitem" class="ajax-modal" tabindex="-1" href="{{ route('profile.edit') }}" data-title="{{ _lang('Edit') }}"><i class="fa fa-cog"></i>{{ _lang('Edit Profile') }}</a>
                                </li>
                                <li>
                                    <a role="menuitem" class="ajax-modal" tabindex="-1" href="{{ route('password.change') }}" data-title="{{ _lang('Password Change') }}"><i class="fa fa-lock"></i>{{ _lang('Password Change') }}</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> {{ _lang('Logout') }}
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- end: search & user box --}}
            </header>
            {{-- end: header --}}
            <div class="inner-wrapper">
                {{-- start: sidebar --}}
                <aside id="sidebar-left" class="sidebar-left">
                    <div class="sidebar-header">
                        {{-- <div class="sidebar-title">
                            Navigation
                        </div> --}}
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>
                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    <li>
                                        <a href="{{ url('/dashboard') }}">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>{{ _lang('Dashboard') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/departments') }}">
                                            <i class="fa fa-building-o" aria-hidden="true"></i>
                                            <span>{{ _lang('Departments') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/clients') }}">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>{{ _lang('Clients') }}</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{ url('/employees') }}">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>{{ _lang('Employees') }}</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{ url('/notices') }}">
                                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                            <span>{{ _lang('Notices') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/projects') }}">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>{{ _lang('Projects') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/users') }}">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <span>{{ _lang('User Management') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-cogs" aria-hidden="true"></i>
                                            <span>{{ _lang('Administration') }}</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="{{ url('administration/settings/general') }}">
                                                     {{ _lang('General Settings') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('administration/languages') }}">
                                                     {{ _lang('Languages') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('administration/datatable_backup') }}">
                                                     {{ _lang('Database Backup') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </aside>
                {{-- end: sidebar --}}
                <section role="main" class="content-body">
                    <header class="page-header">
                        <h2 class="page-title">{{ _lang('Dashboard') }}</h2>
                        <div class="right-wrapper pull-right">
                            <ol class="breadcrumbs">
                                <li>
                                    <a href="{{ url('/dashboard') }}">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                @php $segments = ''; @endphp
                                @foreach(Request::segments() as $segment)
                                    @php $segments .= '/' . $segment; @endphp
                                    <li>
                                        <a href="{{ url($segments) }}"><span>{{ ucwords(str_replace('_', ' ', $segment)) }}</span></a>
                                    </li>
                                @endforeach
                            </ol>
                           
                        </div>
                    </header>
                    {{-- start: page --}}
                    @yield('content')
                    {{-- end: page --}}
                </section>
            </div>
        </section>
        {{-- Vendor --}}
        <script src="{{ asset('public/assets/vendor/jquery/jquery.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/summernote/summernote.js') }}"></script>
        <script src="{{ asset('public/assets/javascripts/datatables.min.js') }}"></script>
        <script src="{{ asset('public/assets/javascripts/dropify.min.js') }}"></script>
        <script src="{{ asset('public/assets/javascripts/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('public/assets/javascripts/toastr.js') }}"></script>
        {{-- Specific Page Vendor --}}
        <script src="{{ asset('public/assets/vendor/jquery-autosize/jquery.autosize.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js') }}"></script>
        <script src="{{ asset('public/assets/vendor/select2/select2.min.js') }}"></script>
        {{-- Theme Base, Components and Settings --}}
        <script src="{{ asset('public/assets/javascripts/theme.js') }}"></script>
        {{-- Theme Custom --}}
        <script src="{{ asset('public/assets/javascripts/theme.custom.js') }}"></script>
        {{-- Theme Initialization Files --}}
        <script src="{{ asset('public/assets/javascripts/theme.init.js') }}"></script>
        {{-- app --}}
        <script src="{{ asset('public/assets/javascripts/app.js') }}"></script>
        {{-- extra js --}}
        @yield('js-script')
        <script type="text/javascript">
            $(document).ready(function(){
                @if( ! Request::is('dashboard'))
                    $(".page-title").html($(".panel-title").html());
                @endif
                $(".data-table").DataTable({
                    responsive: true,
                    "bAutoWidth":false,
                    "ordering": false,
                    "language": {
                        "decimal":        "",
                        "emptyTable":     "{{ _lang('No Data Found') }}",
                        "info":           "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
                        "infoEmpty":      "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
                        "infoFiltered":   "(filtered from _MAX_ total entries)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
                        "loadingRecords": "{{ _lang('Loading...') }}",
                        "processing":     "{{ _lang('Processing...') }}",
                        "search":         "{{ _lang('Search') }}",
                        "zeroRecords":    "{{ _lang('No matching records found') }}",
                        "paginate": {
                           "first":      "{{ _lang('First') }}",
                           "last":       "{{ _lang('Last') }}",
                           "next":       "{{ _lang('Next') }}",
                           "previous":   "{{ _lang('Previous') }}"
                        },
                        "aria": {
                           "sortAscending":  ": activate to sort column ascending",
                           "sortDescending": ": activate to sort column descending"
                        }    
                    },   
                });
                @if(Session::has('success'))
                    Command: toastr["success"]("{{session('success')}}")
                @endif
                @if(Session::has('error'))
                    Command: toastr["error"]("{{session('error')}}")
                @endif
                @foreach ($errors->all() as $error)
                    Command: toastr["error"]("{{ $error }}");
                @endforeach
           });
       </script>
    </body>
</html>